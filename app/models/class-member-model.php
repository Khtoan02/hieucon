<?php
namespace Hieucon\Model;

/**
 * Custom Member Model for Hieucon Theme
 * Handles DB queries for members, OTP generation/verification, and sessions.
 */
class Member_Model {

    // --- MEMBER DATABASE ACTIONS ---

    public static function get_table_name() {
        global $wpdb;
        return $wpdb->prefix . 'hieucon_members';
    }

    public static function get_by_email( $email ) {
        global $wpdb;
        $table = self::get_table_name();
        $query = $wpdb->prepare( "SELECT * FROM $table WHERE email = %s LIMIT 1", $email );
        return $wpdb->get_row( $query );
    }

    public static function get_by_id( $id ) {
        global $wpdb;
        $table = self::get_table_name();
        $query = $wpdb->prepare( "SELECT * FROM $table WHERE id = %d LIMIT 1", $id );
        return $wpdb->get_row( $query );
    }

    public static function create( $data ) {
        global $wpdb;
        $table = self::get_table_name();

        $inserted = $wpdb->insert(
            $table,
            [
                'email'         => sanitize_email( $data['email'] ),
                'password_hash' => password_hash( $data['password'], PASSWORD_BCRYPT ),
                'full_name'     => sanitize_text_field( $data['full_name'] ),
                'date_of_birth' => ! empty( $data['date_of_birth'] ) ? sanitize_text_field( $data['date_of_birth'] ) : null,
                'phone_number'  => ! empty( $data['phone_number'] ) ? sanitize_text_field( $data['phone_number'] ) : null,
                'role'          => ! empty( $data['role'] ) ? sanitize_text_field( $data['role'] ) : 'user',
                'status'        => 'active',
                'created_at'    => current_time( 'mysql' ),
                'updated_at'    => current_time( 'mysql' )
            ],
            [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
        );

        if ( $inserted ) {
            return $wpdb->insert_id;
        }
        return false;
    }

    public static function update( $id, $data ) {
        global $wpdb;
        $table = self::get_table_name();

        $update_data = [];
        $format = [];

        if ( isset( $data['full_name'] ) ) {
            $update_data['full_name'] = sanitize_text_field( $data['full_name'] );
            $format[] = '%s';
        }
        if ( isset( $data['date_of_birth'] ) ) {
            $update_data['date_of_birth'] = ! empty( $data['date_of_birth'] ) ? sanitize_text_field( $data['date_of_birth'] ) : null;
            $format[] = '%s';
        }
        if ( isset( $data['phone_number'] ) ) {
            $update_data['phone_number'] = ! empty( $data['phone_number'] ) ? sanitize_text_field( $data['phone_number'] ) : null;
            $format[] = '%s';
        }
        if ( isset( $data['role'] ) ) {
            $update_data['role'] = sanitize_text_field( $data['role'] );
            $format[] = '%s';
        }
        if ( isset( $data['status'] ) ) {
            $update_data['status'] = sanitize_text_field( $data['status'] );
            $format[] = '%s';
        }
        if ( ! empty( $data['password'] ) ) {
            $update_data['password_hash'] = password_hash( $data['password'], PASSWORD_BCRYPT );
            $format[] = '%s';
        }

        if ( empty( $update_data ) ) {
            return false;
        }

        $update_data['updated_at'] = current_time( 'mysql' );
        $format[] = '%s';

        $updated = $wpdb->update(
            $table,
            $update_data,
            [ 'id' => intval( $id ) ],
            $format,
            [ '%d' ]
        );

        return $updated !== false;
    }

    public static function verify_password( $password, $hash ) {
        return password_verify( $password, $hash );
    }


    // --- OTP MANAGEMENT & SECURITY ACTIONS ---

    public static function get_otp_table_name() {
        global $wpdb;
        return $wpdb->prefix . 'hieucon_otps';
    }

    public static function check_otp_rate_limit( $email, $ip ) {
        global $wpdb;
        $table = self::get_otp_table_name();

        // 1. Mỗi Email: Tối đa 1 mã mỗi 60 giây
        $query_email = $wpdb->prepare(
            "SELECT created_at FROM $table WHERE email = %s ORDER BY created_at DESC LIMIT 1",
            $email
        );
        $last_otp_time = $wpdb->get_var( $query_email );
        if ( $last_otp_time ) {
            $diff = current_time( 'timestamp' ) - strtotime( $last_otp_time );
            if ( $diff < 60 ) {
                return [
                    'limited' => true,
                    'message' => 'Bạn phải đợi thêm ' . ( 60 - $diff ) . ' giây trước khi yêu cầu mã OTP mới.'
                ];
            }
        }

        // 2. Mỗi IP: Tối đa 5 mã mỗi 1 giờ (phòng thủ Bot spam)
        $one_hour_ago = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) - 3600 );
        $query_ip = $wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE ip_address = %s AND created_at >= %s",
            $ip,
            $one_hour_ago
        );
        $ip_count = $wpdb->get_var( $query_ip );
        if ( $ip_count >= 5 ) {
            return [
                'limited' => true,
                'message' => 'Địa chỉ IP của bạn đã yêu cầu quá nhiều mã OTP. Hãy thử lại sau 1 giờ.'
            ];
        }

        return [ 'limited' => false ];
    }

    public static function generate_otp( $email, $action, $ip ) {
        global $wpdb;
        $table = self::get_otp_table_name();

        // Kiểm tra rate limit trước
        $rate_check = self::check_otp_rate_limit( $email, $ip );
        if ( $rate_check['limited'] ) {
            return $rate_check;
        }

        // Tạo mã ngẫu nhiên 6 chữ số
        $otp_code = strval( rand( 100000, 999999 ) );
        $expires_at = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) + 300 ); // Hết hạn trong 5 phút

        $inserted = $wpdb->insert(
            $table,
            [
                'email'      => sanitize_email( $email ),
                'otp_code'   => $otp_code,
                'action'     => sanitize_key( $action ),
                'ip_address' => sanitize_text_field( $ip ),
                'expires_at' => $expires_at,
                'created_at' => current_time( 'mysql' )
            ],
            [ '%s', '%s', '%s', '%s', '%s', '%s' ]
        );

        if ( $inserted ) {
            return [
                'success'  => true,
                'otp_code' => $otp_code
            ];
        }

        return [
            'success' => false,
            'message' => 'Lỗi hệ thống khi sinh mã OTP. Vui lòng thử lại.'
        ];
    }

    public static function verify_otp( $email, $code, $action ) {
        global $wpdb;
        $table = self::get_otp_table_name();
        $now = current_time( 'mysql' );

        // Tìm OTP khớp, chưa hết hạn
        $query = $wpdb->prepare(
            "SELECT id FROM $table WHERE email = %s AND otp_code = %s AND action = %s AND expires_at >= %s ORDER BY created_at DESC LIMIT 1",
            $email,
            $code,
            $action,
            $now
        );
        $otp_id = $wpdb->get_var( $query );

        if ( $otp_id ) {
            // Xóa mã OTP đó ngay sau khi sử dụng để tránh việc sử dụng lại (Replay attack)
            $wpdb->delete( $table, [ 'id' => $otp_id ], [ '%d' ] );
            return true;
        }

        return false;
    }


    // --- SESSION & AUTHENTICATION ACTIONS ---

    public static function get_session_table_name() {
        global $wpdb;
        return $wpdb->prefix . 'hieucon_sessions';
    }

    public static function start_session( $member_id, $remember = true ) {
        global $wpdb;
        $table = self::get_session_table_name();

        // Tạo Token ngẫu nhiên cực mạnh
        $session_id = bin2hex( random_bytes( 32 ) );
        
        $duration = $remember ? ( 7 * DAY_IN_SECONDS ) : ( 1 * DAY_IN_SECONDS );
        $expires_at = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) + $duration );

        $ip_address = self::get_client_ip();
        $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : '';

        $wpdb->insert(
            $table,
            [
                'session_id' => $session_id,
                'member_id'  => intval( $member_id ),
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'expires_at' => $expires_at,
                'created_at' => current_time( 'mysql' )
            ],
            [ '%s', '%d', '%s', '%s', '%s', '%s' ]
        );

        // Lưu Cookie bảo mật HttpOnly
        setcookie(
            'hieucon_session_id',
            $session_id,
            time() + $duration,
            COOKIEPATH,
            COOKIE_DOMAIN,
            is_ssl(),
            true // HttpOnly
        );

        return $session_id;
    }

    public static function get_current_member() {
        if ( ! isset( $_COOKIE['hieucon_session_id'] ) ) {
            return false;
        }

        global $wpdb;
        $session_id   = sanitize_text_field( $_COOKIE['hieucon_session_id'] );
        $table_sess   = self::get_session_table_name();
        $table_member = self::get_table_name();
        $now          = current_time( 'mysql' );

        // Truy vấn xem session có khớp và còn hạn không, đồng thời kết nối lấy thông tin member luôn
        $query = $wpdb->prepare(
            "SELECT m.* FROM $table_sess s 
             JOIN $table_member m ON s.member_id = m.id 
             WHERE s.session_id = %s AND s.expires_at >= %s AND m.status = 'active'
             LIMIT 1",
            $session_id,
            $now
        );

        $member = $wpdb->get_row( $query );
        return $member ? $member : false;
    }

    public static function destroy_session() {
        if ( ! isset( $_COOKIE['hieucon_session_id'] ) ) {
            return;
        }

        global $wpdb;
        $session_id = sanitize_text_field( $_COOKIE['hieucon_session_id'] );
        $table = self::get_session_table_name();

        // Xóa trong Database
        $wpdb->delete( $table, [ 'session_id' => $session_id ], [ '%s' ] );

        // Xóa Cookie
        setcookie(
            'hieucon_session_id',
            '',
            time() - 3600,
            COOKIEPATH,
            COOKIE_DOMAIN,
            is_ssl(),
            true
        );
    }

    public static function get_client_ip() {
        if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return sanitize_text_field( $ip );
    }
}
