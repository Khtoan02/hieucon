<?php
namespace Hieucon\Controller;

use Hieucon\Model\Member_Model;

/**
 * Account Controller for Hieucon Theme
 * Handles profile information updates and password changes with mandatory OTP + Turnstile.
 */
class Account_Controller {

    public static function init() {
        // --- AJAX Actions for Logged-In Members ---
        $actions = [
            'send_otp_update',
            'update_profile_info',
            'update_member_password'
        ];

        foreach ( $actions as $action ) {
            add_action( "wp_ajax_hieucon_{$action}", [ self::class, "ajax_{$action}" ] );
        }
    }

    // --- HELPER TO GET LOGGED-IN USER OR RETURN ERROR ---
    private static function get_authenticated_member() {
        $member = Member_Model::get_current_member();
        if ( ! $member ) {
            wp_send_json_error( [ 'message' => 'Phiên làm việc đã hết hạn hoặc bạn chưa đăng nhập.' ] );
        }
        return $member;
    }

    // 1. Gửi OTP Xác thực Sửa đổi Thông tin Tài khoản
    public static function ajax_send_otp_update() {
        check_ajax_referer( 'hieucon_account_nonce', 'nonce' );
        
        $member          = self::get_authenticated_member();
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        // Xác thực Captcha
        if ( ! Auth_Controller::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không chính xác hoặc đã hết hạn.' ] );
        }

        $email = $member->email;
        $ip    = Member_Model::get_client_ip();
        
        // Sinh mã OTP cho hành động cập nhật tài khoản
        $otp_res = Member_Model::generate_otp( $email, 'update_profile', $ip );

        if ( ! isset( $otp_res['success'] ) || ! $otp_res['success'] ) {
            wp_send_json_error( [ 'message' => isset( $otp_res['message'] ) ? $otp_res['message'] : 'Gửi mã OTP thất bại.' ] );
        }

        $otp_code = $otp_res['otp_code'];

        // Gửi Email OTP dạng HTML Premium
        $subject = 'Mã xác thực OTP cập nhật thông tin tài khoản - Hieucon';
        $mail_sent = \Hieucon\Controller\Auth_Controller::send_otp_html_email(
            $email, 
            $subject, 
            $otp_code, 
            'Cập nhật thông tin tài khoản', 
            'Hệ thống nhận được yêu cầu sửa đổi thông tin hồ sơ bảo mật hoặc mật khẩu tài khoản thành viên của bạn.'
        );

        if ( $mail_sent ) {
            wp_send_json_success( [ 'message' => 'Mã xác thực OTP đã được gửi đến email đăng ký của bạn.' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Không thể gửi Email. Vui lòng kiểm tra lại cấu hình hệ thống SMTP.' ] );
        }
    }

    // 2. AJAX cập nhật thông tin cá nhân (Họ tên, SĐT, Ngày sinh)
    public static function ajax_update_profile_info() {
        check_ajax_referer( 'hieucon_account_nonce', 'nonce' );

        $member          = self::get_authenticated_member();
        $full_name       = isset( $_POST['full_name'] ) ? sanitize_text_field( $_POST['full_name'] ) : '';
        $phone_number    = isset( $_POST['phone_number'] ) ? sanitize_text_field( $_POST['phone_number'] ) : '';
        $date_of_birth   = isset( $_POST['date_of_birth'] ) ? sanitize_text_field( $_POST['date_of_birth'] ) : '';
        $otp_code        = isset( $_POST['otp'] ) ? sanitize_text_field( $_POST['otp'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        if ( empty( $full_name ) || empty( $otp_code ) ) {
            wp_send_json_error( [ 'message' => 'Họ và tên và mã OTP là các trường bắt buộc.' ] );
        }

        // Xác thực Captcha Turnstile
        if ( ! Auth_Controller::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha xác thực không đúng.' ] );
        }

        // Xác thực mã OTP
        if ( ! Member_Model::verify_otp( $member->email, $otp_code, 'update_profile' ) ) {
            wp_send_json_error( [ 'message' => 'Mã OTP không chính xác hoặc đã hết hạn.' ] );
        }

        // Lưu thay đổi vào CSDL
        $updated = Member_Model::update( $member->id, [
            'full_name'     => $full_name,
            'phone_number'  => $phone_number,
            'date_of_birth' => $date_of_birth
        ] );

        if ( $updated ) {
            wp_send_json_success( [ 'message' => 'Cập nhật thông tin tài khoản thành công.' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Không có thông tin nào thay đổi hoặc lỗi CSDL.' ] );
        }
    }

    // 3. AJAX đổi Mật khẩu
    public static function ajax_update_member_password() {
        check_ajax_referer( 'hieucon_account_nonce', 'nonce' );

        $member          = self::get_authenticated_member();
        $new_password    = isset( $_POST['password'] ) ? $_POST['password'] : '';
        $otp_code        = isset( $_POST['otp'] ) ? sanitize_text_field( $_POST['otp'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        if ( empty( $new_password ) || empty( $otp_code ) ) {
            wp_send_json_error( [ 'message' => 'Mật khẩu mới và mã OTP không được để trống.' ] );
        }

        if ( strlen( $new_password ) < 8 ) {
            wp_send_json_error( [ 'message' => 'Mật khẩu mới phải chứa ít nhất 8 ký tự.' ] );
        }

        // Xác thực Captcha Turnstile
        if ( ! Auth_Controller::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha xác thực không đúng.' ] );
        }

        // Xác thực mã OTP
        if ( ! Member_Model::verify_otp( $member->email, $otp_code, 'update_profile' ) ) {
            wp_send_json_error( [ 'message' => 'Mã OTP không chính xác hoặc đã hết hạn.' ] );
        }

        // Cập nhật Mật khẩu mới vào CSDL
        $updated = Member_Model::update( $member->id, [
            'password' => $new_password
        ] );

        if ( $updated ) {
            // Khi đổi mật khẩu, đăng xuất các phiên đăng nhập khác của tài khoản này
            // (Chỉ giữ lại session hiện tại hoặc buộc đăng xuất hoàn toàn để đăng nhập lại)
            // Ở đây ta buộc đăng xuất session hiện tại để người dùng đăng nhập lại bằng mật khẩu mới
            Member_Model::destroy_session();
            wp_send_json_success( [ 'message' => 'Thay đổi mật khẩu thành công. Vui lòng đăng nhập lại!' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Thay đổi mật khẩu thất bại. Vui lòng thử lại sau.' ] );
        }
    }
}
