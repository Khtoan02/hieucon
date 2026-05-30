<?php
namespace Hieucon\Controller;

use Hieucon\Model\Member_Model;

/**
 * Authentication Controller for Hieucon Theme
 * Handles Registration, OTP Login, Password Login, and Cloudflare Turnstile Verification.
 */
class Auth_Controller {

    public static function init() {
        // --- AJAX Actions for Registration & Login (Public / No Privileges) ---
        $actions = [
            'send_otp_register',
            'register_member',
            'send_otp_login',
            'login_via_otp',
            'login_via_password',
            'logout_member'
        ];

        foreach ( $actions as $action ) {
            add_action( "wp_ajax_nopriv_hieucon_{$action}", [ self::class, "ajax_{$action}" ] );
            add_action( "wp_ajax_hieucon_{$action}", [ self::class, "ajax_{$action}" ] );
        }
    }

    // --- CLOUDFLARE TURNSTILE CAPTCHA VERIFICATION ---

    public static function verify_turnstile( $token ) {
        // TẠM THỜI TẮT CAPTCHA theo yêu cầu của user
        return true;

        $secret_key = get_option( 'hieucon_turnstile_secret', '' );
        
        // Nếu admin chưa cấu hình Key, tạm thời cho phép bypass trong môi trường local/dev
        if ( empty( $secret_key ) ) {
            return true;
        }

        if ( empty( $token ) ) {
            error_log( 'Hieucon Auth Turnstile: Token is empty or missing.' );
            return false;
        }

        $ip = Member_Model::get_client_ip();
        $args = [
            'body' => [
                'secret'   => $secret_key,
                'response' => $token,
                'remoteip' => $ip
            ]
        ];

        $response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', $args );

        if ( is_wp_error( $response ) ) {
            error_log( 'Hieucon Auth Turnstile: First verification attempt failed due to SSL or network error: ' . $response->get_error_message() . '. Retrying with SSL verification disabled...' );
            
            // Thử lại không xác thực SSL (hữu ích cho môi trường dev/local như ServBay)
            $args['sslverify'] = false;
            $response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', $args );

            if ( is_wp_error( $response ) ) {
                error_log( 'Hieucon Auth Turnstile: Retry failed. Final error: ' . $response->get_error_message() );
                return false;
            }
        }

        $body_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $success = isset( $body_response['success'] ) && $body_response['success'] === true;

        if ( ! $success ) {
            error_log( 'Hieucon Auth Turnstile: Verification failed. Response from Cloudflare: ' . print_r( $body_response, true ) );
        }

        return $success;
    }

    // --- AJAX ROUTE handlers ---

    // 1. Gửi OTP Đăng ký
    public static function ajax_send_otp_register() {
        check_ajax_referer( 'hieucon_auth_nonce', 'nonce' );

        $email           = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        if ( ! is_email( $email ) ) {
            wp_send_json_error( [ 'message' => 'Địa chỉ Email không hợp lệ.' ] );
        }

        // Kiểm tra Turnstile Captcha
        if ( ! self::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không đúng hoặc đã hết hạn.' ] );
        }

        // Kiểm tra Email đã tồn tại chưa
        if ( Member_Model::get_by_email( $email ) ) {
            wp_send_json_error( [ 'message' => 'Địa chỉ Email này đã được đăng ký trước đó.' ] );
        }

        $ip = Member_Model::get_client_ip();
        $otp_res = Member_Model::generate_otp( $email, 'register', $ip );

        if ( ! isset( $otp_res['success'] ) || ! $otp_res['success'] ) {
            wp_send_json_error( [ 'message' => isset( $otp_res['message'] ) ? $otp_res['message'] : 'Gửi mã OTP thất bại.' ] );
        }

        $otp_code = $otp_res['otp_code'];

        // Gửi Email OTP dạng HTML Premium
        $subject = 'Mã xác thực OTP đăng ký tài khoản - Hieucon';
        $mail_sent = self::send_otp_html_email( 
            $email, 
            $subject, 
            $otp_code, 
            'Đăng ký tài khoản mới', 
            'Hệ thống nhận được yêu cầu đăng ký tài khoản thành viên mới bằng địa chỉ Email này từ bạn.' 
        );

        if ( $mail_sent ) {
            wp_send_json_success( [ 'message' => 'Mã xác thực OTP đã được gửi đến email của bạn.' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Không thể gửi email OTP. Vui lòng kiểm tra lại cấu hình SMTP.' ] );
        }
    }

    // 2. Đăng ký thành viên mới
    public static function ajax_register_member() {
        check_ajax_referer( 'hieucon_auth_nonce', 'nonce' );

        $email           = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $password        = isset( $_POST['password'] ) ? $_POST['password'] : '';
        $full_name       = isset( $_POST['full_name'] ) ? sanitize_text_field( $_POST['full_name'] ) : '';
        $phone_number    = isset( $_POST['phone_number'] ) ? sanitize_text_field( $_POST['phone_number'] ) : '';
        $date_of_birth   = isset( $_POST['date_of_birth'] ) ? sanitize_text_field( $_POST['date_of_birth'] ) : '';
        $otp_code        = isset( $_POST['otp'] ) ? sanitize_text_field( $_POST['otp'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        if ( ! is_email( $email ) || empty( $password ) || empty( $full_name ) || empty( $otp_code ) ) {
            wp_send_json_error( [ 'message' => 'Vui lòng nhập đầy đủ các thông tin bắt buộc.' ] );
        }

        if ( strlen( $password ) < 8 ) {
            wp_send_json_error( [ 'message' => 'Mật khẩu phải chứa ít nhất 8 ký tự.' ] );
        }

        // Xác thực Captcha
        if ( ! self::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không đúng.' ] );
        }

        // Xác thực mã OTP
        if ( ! Member_Model::verify_otp( $email, $otp_code, 'register' ) ) {
            wp_send_json_error( [ 'message' => 'Mã OTP không chính xác hoặc đã hết hạn.' ] );
        }

        // Kiểm tra xem email đã được đăng ký chưa (phòng ngừa chạy song song)
        if ( Member_Model::get_by_email( $email ) ) {
            wp_send_json_error( [ 'message' => 'Địa chỉ Email này đã tồn tại.' ] );
        }

        // Tạo hội viên mới
        $member_id = Member_Model::create( [
            'email'         => $email,
            'password'      => $password,
            'full_name'     => $full_name,
            'phone_number'  => $phone_number,
            'date_of_birth' => $date_of_birth,
            'role'          => 'user' // Mặc định là Người dùng thường
        ] );

        if ( $member_id ) {
            // Tự động khởi tạo Session đăng nhập sau khi đăng ký thành công
            Member_Model::start_session( $member_id );
            wp_send_json_success( [ 'message' => 'Đăng ký tài khoản thành công.' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Lỗi lưu thông tin vào cơ sở dữ liệu.' ] );
        }
    }

    // 3. Gửi OTP Đăng nhập (Cho hình thức đăng nhập nhanh)
    public static function ajax_send_otp_login() {
        check_ajax_referer( 'hieucon_auth_nonce', 'nonce' );

        $email           = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';

        if ( ! is_email( $email ) ) {
            wp_send_json_error( [ 'message' => 'Địa chỉ Email không hợp lệ.' ] );
        }

        // Xác thực Turnstile
        if ( ! self::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không đúng.' ] );
        }

        // Kiểm tra tài khoản có tồn tại không
        $member = Member_Model::get_by_email( $email );
        if ( ! $member ) {
            wp_send_json_error( [ 'message' => 'Email này chưa được đăng ký trên hệ thống.' ] );
        }

        if ( $member->status !== 'active' ) {
            wp_send_json_error( [ 'message' => 'Tài khoản của bạn hiện đang bị tạm khóa.' ] );
        }

        $ip = Member_Model::get_client_ip();
        $otp_res = Member_Model::generate_otp( $email, 'login', $ip );

        if ( ! isset( $otp_res['success'] ) || ! $otp_res['success'] ) {
            wp_send_json_error( [ 'message' => isset( $otp_res['message'] ) ? $otp_res['message'] : 'Gửi mã OTP thất bại.' ] );
        }

        $otp_code = $otp_res['otp_code'];

        // Gửi Email OTP dạng HTML Premium
        $subject = 'Mã xác thực OTP đăng nhập nhanh - Hieucon';
        $mail_sent = self::send_otp_html_email( 
            $email, 
            $subject, 
            $otp_code, 
            'Đăng nhập tài khoản', 
            'Hệ thống nhận được yêu cầu xác thực đăng nhập nhanh vào tài khoản của bạn.' 
        );

        if ( $mail_sent ) {
            wp_send_json_success( [ 'message' => 'Mã OTP đăng nhập nhanh đã được gửi tới Email của bạn.' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Lỗi gửi Email OTP. Hãy liên hệ ban quản trị.' ] );
        }
    }

    // 4. Đăng nhập qua OTP
    public static function ajax_login_via_otp() {
        check_ajax_referer( 'hieucon_auth_nonce', 'nonce' );

        $email           = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $otp_code        = isset( $_POST['otp'] ) ? sanitize_text_field( $_POST['otp'] ) : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';
        $remember        = isset( $_POST['remember'] ) && $_POST['remember'] === 'true';

        if ( ! is_email( $email ) || empty( $otp_code ) ) {
            wp_send_json_error( [ 'message' => 'Email và mã OTP không được để trống.' ] );
        }

        // Xác thực Captcha
        if ( ! self::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không đúng.' ] );
        }

        // Kiểm tra hội viên
        $member = Member_Model::get_by_email( $email );
        if ( ! $member ) {
            wp_send_json_error( [ 'message' => 'Tài khoản không tồn tại.' ] );
        }

        if ( $member->status !== 'active' ) {
            wp_send_json_error( [ 'message' => 'Tài khoản hiện đã bị khóa.' ] );
        }

        // Xác thực OTP
        if ( ! Member_Model::verify_otp( $email, $otp_code, 'login' ) ) {
            wp_send_json_error( [ 'message' => 'Mã OTP không chính xác hoặc đã hết hạn.' ] );
        }

        // Tạo phiên đăng nhập
        Member_Model::start_session( $member->id, $remember );
        wp_send_json_success( [ 'message' => 'Đăng nhập thành công!' ] );
    }

    // 5. Đăng nhập qua Mật khẩu (Password Login)
    public static function ajax_login_via_password() {
        check_ajax_referer( 'hieucon_auth_nonce', 'nonce' );

        $email           = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $password        = isset( $_POST['password'] ) ? $_POST['password'] : '';
        $turnstile_token = isset( $_POST['captcha_token'] ) ? sanitize_text_field( $_POST['captcha_token'] ) : '';
        $remember        = isset( $_POST['remember'] ) && $_POST['remember'] === 'true';

        if ( ! is_email( $email ) || empty( $password ) ) {
            wp_send_json_error( [ 'message' => 'Email và Mật khẩu không được bỏ trống.' ] );
        }

        // Xác thực Captcha Turnstile
        if ( ! self::verify_turnstile( $turnstile_token ) ) {
            wp_send_json_error( [ 'message' => 'Mã Captcha không đúng.' ] );
        }

        // Lấy thông tin Member
        $member = Member_Model::get_by_email( $email );
        if ( ! $member ) {
            wp_send_json_error( [ 'message' => 'Sai tài khoản hoặc mật khẩu.' ] );
        }

        if ( $member->status !== 'active' ) {
            wp_send_json_error( [ 'message' => 'Tài khoản hiện đang bị khóa.' ] );
        }

        // Xác thực Mật khẩu
        if ( ! Member_Model::verify_password( $password, $member->password_hash ) ) {
            wp_send_json_error( [ 'message' => 'Sai tài khoản hoặc mật khẩu.' ] );
        }

        // Khởi tạo phiên
        Member_Model::start_session( $member->id, $remember );
        wp_send_json_success( [ 'message' => 'Đăng nhập thành công!' ] );
    }

    // 6. Đăng xuất
    public static function ajax_logout_member() {
        Member_Model::destroy_session();
        wp_send_json_success( [ 'message' => 'Đăng xuất thành công.' ] );
    }

    /**
     * Gửi email OTP dạng HTML cao cấp
     */
    public static function send_otp_html_email( $to, $subject, $otp_code, $action_title, $action_description ) {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $message = self::get_otp_html_template( $otp_code, $action_title, $action_description );
        return wp_mail( $to, $subject, $message, $headers );
    }

    /**
     * Trả về template HTML email OTP cao cấp phong cách Glassmorphism / Premium Card
     */
    private static function get_otp_html_template( $otp_code, $action_title, $action_description ) {
        return '<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực mã OTP - Hieucon</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; padding: 48px 16px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05); overflow: hidden; border-collapse: separate;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 36px 24px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 800; letter-spacing: -0.5px; text-transform: uppercase;">HIEUCON</h1>
                            <p style="margin: 6px 0 0 0; color: #94a3b8; font-size: 13px; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 600;">Hệ Thống Hội Viên Cao Cấp</p>
                        </td>
                    </tr>
                    
                    <!-- Content Body -->
                    <tr>
                        <td style="padding: 40px 32px 32px 32px;">
                            <h2 style="margin: 0 0 16px 0; color: #0f172a; font-size: 20px; font-weight: 700; letter-spacing: -0.3px;">' . esc_html( $action_title ) . '</h2>
                            
                            <p style="margin: 0 0 20px 0; color: #475569; font-size: 15px; line-height: 1.6;">Chào bạn,</p>
                            
                            <p style="margin: 0 0 24px 0; color: #475569; font-size: 15px; line-height: 1.6; font-weight: 500;">
                                ' . esc_html( $action_description ) . '
                            </p>
                            
                            <!-- Action / OTP Code Box -->
                            <div style="background-color: #f1f5f9; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; margin: 32px 0;">
                                <span style="display: block; color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Mã OTP của bạn là</span>
                                <div style="font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, \'Liberation Mono\', \'Courier New\', monospace; font-size: 38px; font-weight: 800; color: #ea580c; letter-spacing: 8px; margin: 0; padding-left: 8px; display: inline-block;">' . esc_html( $otp_code ) . '</div>
                            </div>
                            
                            <!-- Security Warning -->
                            <div style="background-color: #fff7ed; border-left: 4px solid #ea580c; border-radius: 8px; padding: 16px; margin: 32px 0;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="vertical-align: top; width: 24px; padding-top: 2px;">
                                            <span style="color: #ea580c; font-size: 18px; font-weight: bold;">⚠️</span>
                                        </td>
                                        <td style="padding-left: 8px;">
                                            <strong style="display: block; color: #9a3412; font-size: 14px; font-weight: 700; margin-bottom: 4px;">Cảnh báo bảo mật quan trọng:</strong>
                                            <span style="color: #c2410c; font-size: 13px; line-height: 1.5; display: block;">
                                                Mã OTP này có hiệu lực trong vòng <strong>5 phút</strong>. Vui lòng tuyệt đối <strong>KHÔNG cung cấp mã này cho bất kỳ ai</strong>, kể cả nhân viên hỗ trợ từ Hieucon, để tránh rủi ro mất an toàn thông tin tài khoản.
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <p style="margin: 32px 0 0 0; color: #475569; font-size: 14px; line-height: 1.6;">
                                Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email hoặc liên hệ với đội ngũ hỗ trợ của chúng tôi để được trợ giúp.
                            </p>
                            
                            <p style="margin: 24px 0 0 0; color: #475569; font-size: 14px; line-height: 1.6; border-top: 1px solid #e2e8f0; padding-top: 24px;">
                                Trân trọng,<br>
                                <strong style="color: #0f172a;">Ban Quản trị Hieucon</strong>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 24px 32px; text-align: center;">
                            <p style="margin: 0; color: #64748b; font-size: 12px; line-height: 1.5;">
                                Email này được gửi tự động từ hệ thống hội viên của <strong>Hieucon</strong>.<br>
                                Vui lòng không trả lời trực tiếp email này.
                            </p>
                            <p style="margin: 12px 0 0 0; color: #94a3b8; font-size: 11px;">
                                &copy; 2026 Hieucon. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
    }
}
