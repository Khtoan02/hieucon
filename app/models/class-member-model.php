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

    public static function get_by_phone( $phone ) {
        global $wpdb;
        $table = self::get_table_name();
        $query = $wpdb->prepare( "SELECT * FROM $table WHERE phone_number = %s LIMIT 1", $phone );
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
                'email'                   => sanitize_email( $data['email'] ),
                'password_hash'           => ! empty( $data['password'] ) ? password_hash( $data['password'], PASSWORD_BCRYPT ) : '',
                'full_name'               => sanitize_text_field( $data['full_name'] ),
                'date_of_birth'           => ! empty( $data['date_of_birth'] ) ? sanitize_text_field( $data['date_of_birth'] ) : null,
                'phone_number'            => ! empty( $data['phone_number'] ) ? sanitize_text_field( $data['phone_number'] ) : null,
                'role'                    => ! empty( $data['role'] ) ? sanitize_text_field( $data['role'] ) : 'user',
                'status'                  => ! empty( $data['status'] ) ? sanitize_text_field( $data['status'] ) : 'active',
                'child_name'              => ! empty( $data['child_name'] ) ? sanitize_text_field( $data['child_name'] ) : null,
                'child_dob'               => ! empty( $data['child_dob'] ) ? sanitize_text_field( $data['child_dob'] ) : null,
                'child_gender'            => ! empty( $data['child_gender'] ) ? sanitize_text_field( $data['child_gender'] ) : null,
                'child_diagnosis'         => ! empty( $data['child_diagnosis'] ) ? sanitize_text_field( $data['child_diagnosis'] ) : null,
                'participated_checklists' => ! empty( $data['participated_checklists'] ) ? sanitize_text_field( $data['participated_checklists'] ) : null,
                'has_password'            => isset( $data['has_password'] ) ? intval( $data['has_password'] ) : 1,
                'created_at'              => current_time( 'mysql' ),
                'updated_at'              => current_time( 'mysql' )
            ],
            [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s' ]
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
        if ( isset( $data['password'] ) ) {
            $update_data['password_hash'] = ! empty( $data['password'] ) ? password_hash( $data['password'], PASSWORD_BCRYPT ) : '';
            $format[] = '%s';
        }
        if ( isset( $data['child_name'] ) ) {
            $update_data['child_name'] = sanitize_text_field( $data['child_name'] );
            $format[] = '%s';
        }
        if ( isset( $data['child_dob'] ) ) {
            $update_data['child_dob'] = sanitize_text_field( $data['child_dob'] );
            $format[] = '%s';
        }
        if ( isset( $data['child_gender'] ) ) {
            $update_data['child_gender'] = sanitize_text_field( $data['child_gender'] );
            $format[] = '%s';
        }
        if ( isset( $data['child_diagnosis'] ) ) {
            $update_data['child_diagnosis'] = sanitize_text_field( $data['child_diagnosis'] );
            $format[] = '%s';
        }
        if ( isset( $data['participated_checklists'] ) ) {
            $update_data['participated_checklists'] = sanitize_text_field( $data['participated_checklists'] );
            $format[] = '%s';
        }
        if ( isset( $data['has_password'] ) ) {
            $update_data['has_password'] = intval( $data['has_password'] );
            $format[] = '%d';
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

    public static function sync_survey($parent_name, $parent_phone, $parent_email, $child_name, $child_age, $child_gender, $child_diagnosis, $checklist_title) {
        if (empty($parent_phone)) {
            return false;
        }

        // Tìm theo SĐT
        $member = self::get_by_phone($parent_phone);
        
        if ($member) {
            // Đã tồn tại hội viên
            $checklists_array = [];
            if (!empty($member->participated_checklists)) {
                $checklists_array = json_decode($member->participated_checklists, true) ?: [];
            }
            if (!in_array($checklist_title, $checklists_array)) {
                $checklists_array[] = $checklist_title;
            }

            self::update($member->id, [
                'full_name' => $parent_name,
                'email' => !empty($parent_email) ? $parent_email : $member->email,
                'child_name' => $child_name,
                'child_dob' => $child_age,
                'child_gender' => $child_gender,
                'child_diagnosis' => $child_diagnosis,
                'participated_checklists' => json_encode($checklists_array, JSON_UNESCAPED_UNICODE)
            ]);
            return $member->id;
        } else {
            // Chưa có hội viên
            // Tạo email ngẫu nhiên nếu không có email
            $member_email = !empty($parent_email) ? $parent_email : "{$parent_phone}@hieucon.vn";
            
            // Đề phòng email bị trùng (nếu SĐT khác nhưng dùng chung email)
            $existing_by_email = self::get_by_email($member_email);
            if ($existing_by_email) {
                // Nếu trùng email nhưng khác SĐT, ta cập nhật SĐT của họ
                $checklists_array = [];
                if (!empty($existing_by_email->participated_checklists)) {
                    $checklists_array = json_decode($existing_by_email->participated_checklists, true) ?: [];
                }
                if (!in_array($checklist_title, $checklists_array)) {
                    $checklists_array[] = $checklist_title;
                }

                self::update($existing_by_email->id, [
                    'full_name' => $parent_name,
                    'phone_number' => $parent_phone,
                    'child_name' => $child_name,
                    'child_dob' => $child_age,
                    'child_gender' => $child_gender,
                    'child_diagnosis' => $child_diagnosis,
                    'participated_checklists' => json_encode($checklists_array, JSON_UNESCAPED_UNICODE)
                ]);
                return $existing_by_email->id;
            } else {
                // Tạo mới hoàn toàn
                $checklists_array = [$checklist_title];
                return self::create([
                    'email' => $member_email,
                    'password' => '', // Mật khẩu trống
                    'full_name' => $parent_name,
                    'phone_number' => $parent_phone,
                    'child_name' => $child_name,
                    'child_dob' => $child_age,
                    'child_gender' => $child_gender,
                    'child_diagnosis' => $child_diagnosis,
                    'participated_checklists' => json_encode($checklists_array, JSON_UNESCAPED_UNICODE),
                    'has_password' => 0 // Đánh dấu chưa tạo mật khẩu
                ]);
            }
        }
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
