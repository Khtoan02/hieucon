<?php
/**
 * WP-Admin Integration for Hieucon Member Management & SMTP Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Đăng ký Menu Admin
function hieucon_member_admin_menu() {
    add_menu_page(
        'Hội viên Hieucon',
        'Hội viên Hieucon',
        'manage_options',
        'hieucon-members',
        'hieucon_members_page_html',
        'dashicons-groups',
        30
    );

    add_submenu_page(
        'hieucon-members',
        'Danh sách Hội viên',
        'Danh sách Hội viên',
        'manage_options',
        'hieucon-members',
        'hieucon_members_page_html'
    );

    add_submenu_page(
        'hieucon-members',
        'Cấu hình Hệ thống',
        'Cấu hình Hệ thống',
        'manage_options',
        'hieucon-member-settings',
        'hieucon_member_settings_page_html'
    );
}
add_action( 'admin_menu', 'hieucon_member_admin_menu' );

// 2. Đăng ký các Cài đặt SMTP & Turnstile vào wp_options
function hieucon_register_member_settings() {
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_enabled' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_host' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_port' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_user' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_pass' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_secure' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_from' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_smtp_from_name' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_turnstile_sitekey' );
    register_setting( 'hieucon_member_settings_group', 'hieucon_turnstile_secret' );
}
add_action( 'admin_init', 'hieucon_register_member_settings' );

// 3. Giao diện trang Cấu hình SMTP & Turnstile
function hieucon_member_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Xử lý gửi thư thử nghiệm SMTP
    $test_message = '';
    $test_status  = '';
    if ( isset( $_POST['hieucon_test_smtp_email'] ) && check_admin_referer( 'hieucon_test_smtp_nonce' ) ) {
        $test_email = sanitize_email( $_POST['hieucon_test_smtp_email'] );
        if ( is_email( $test_email ) ) {
            $subject = 'Thư thử nghiệm cấu hình SMTP - Hieucon';
            $body    = 'Chúc mừng! Cấu hình SMTP của bạn đang hoạt động cực kỳ hoàn hảo.';
            
            // Xóa lỗi cũ trước khi test
            delete_option( 'hieucon_smtp_last_error' );
            
            // Buộc tải cấu hình SMTP ngay lập tức để gửi thử
            $mail_sent = wp_mail( $test_email, $subject, $body );
            if ( $mail_sent ) {
                $test_message = 'Email thử nghiệm đã được gửi thành công đến ' . esc_html( $test_email ) . '. Hãy kiểm tra hộp thư (và cả mục Spam/Junk nếu không thấy).';
                $test_status  = 'success';
            } else {
                $last_error = get_option( 'hieucon_smtp_last_error', 'Không rõ nguyên nhân (vui lòng kiểm tra cổng SMTP hoặc SSL/TLS)' );
                $test_message = 'Không thể gửi email thử nghiệm. Chi tiết lỗi: ' . esc_html( $last_error );
                $test_status  = 'error';
            }
        } else {
            $test_message = 'Email thử nghiệm không hợp lệ.';
            $test_status  = 'error';
        }
    }
    ?>
    <div class="wrap">
        <h1>Cấu hình Hệ thống Hội viên</h1>
        <p>Quản lý cấu hình gửi Email mã OTP và Khóa chống Spam Cloudflare Turnstile.</p>

        <?php if ( ! empty( $test_message ) ) : ?>
            <div class="notice notice-<?php echo esc_attr( $test_status ); ?> is-dismissible">
                <p><strong><?php echo esc_html( $test_message ); ?></strong></p>
            </div>
        <?php endif; ?>

        <form action="options.php" method="post" style="max-width: 800px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <?php
            settings_fields( 'hieucon_member_settings_group' );
            do_settings_sections( 'hieucon_member_settings_group' );
            ?>
            <h2>1. Cấu hình SMTP gửi Email OTP</h2>
            <?php
            $last_error = get_option( 'hieucon_smtp_last_error', '' );
            if ( ! empty( $last_error ) ) :
            ?>
                <div class="notice notice-error inline-notice" style="margin: 10px 0 20px 0; padding: 10px 15px; background: #fff0f0; border-left: 4px solid #d63636; border-radius: 4px;">
                    <p style="margin: 0; color: #d63636;"><strong>Lỗi gửi thư gần nhất ghi nhận được:</strong> <?php echo esc_html( $last_error ); ?></p>
                </div>
            <?php endif; ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Bật SMTP Tùy chỉnh</th>
                    <td>
                        <input type="checkbox" name="hieucon_smtp_enabled" value="1" <?php checked( get_option( 'hieucon_smtp_enabled' ), '1' ); ?> />
                        <p class="description">Tích hợp SMTP để gửi mã OTP xác thực qua Email. Nếu tắt, sẽ dùng hàm gửi thư mặc định của server.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">SMTP Server (Host)</th>
                    <td>
                        <input type="text" name="hieucon_smtp_host" value="<?php echo esc_attr( get_option( 'hieucon_smtp_host' ) ); ?>" class="regular-text" placeholder="smtp.example.com" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">SMTP Port</th>
                    <td>
                        <input type="number" name="hieucon_smtp_port" value="<?php echo esc_attr( get_option( 'hieucon_smtp_port', '587' ) ); ?>" class="small-text" />
                        <p class="description">Mặc định: 587 (TLS), 465 (SSL).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Loại Mã hóa (Encryption)</th>
                    <td>
                        <select name="hieucon_smtp_secure">
                            <option value="tls" <?php selected( get_option( 'hieucon_smtp_secure' ), 'tls' ); ?>>TLS (Khuyên dùng)</option>
                            <option value="ssl" <?php selected( get_option( 'hieucon_smtp_secure' ), 'ssl' ); ?>>SSL</option>
                            <option value="none" <?php selected( get_option( 'hieucon_smtp_secure' ), 'none' ); ?>>Không mã hóa (Không an toàn)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tài khoản SMTP</th>
                    <td>
                        <input type="text" name="hieucon_smtp_user" value="<?php echo esc_attr( get_option( 'hieucon_smtp_user' ) ); ?>" class="regular-text" placeholder="user@example.com" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Mật khẩu SMTP</th>
                    <td>
                        <input type="password" name="hieucon_smtp_pass" value="<?php echo esc_attr( get_option( 'hieucon_smtp_pass' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Email người gửi (From Email)</th>
                    <td>
                        <input type="email" name="hieucon_smtp_from" value="<?php echo esc_attr( get_option( 'hieucon_smtp_from' ) ); ?>" class="regular-text" placeholder="noreply@yourdomain.com" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tên người gửi (From Name)</th>
                    <td>
                        <input type="text" name="hieucon_smtp_from_name" value="<?php echo esc_attr( get_option( 'hieucon_smtp_from_name', get_bloginfo( 'name' ) ) ); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <h2>2. Cấu hình Cloudflare Turnstile Captcha</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">Turnstile Site Key</th>
                    <td>
                        <input type="text" name="hieucon_turnstile_sitekey" value="<?php echo esc_attr( get_option( 'hieucon_turnstile_sitekey' ) ); ?>" class="large-text" placeholder="0x4AAAAAA..." />
                        <p class="description">Khóa hiển thị công khai (Site Key) lấy từ bảng điều khiển Cloudflare Turnstile.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Turnstile Secret Key</th>
                    <td>
                        <input type="password" name="hieucon_turnstile_secret" value="<?php echo esc_attr( get_option( 'hieucon_turnstile_secret' ) ); ?>" class="large-text" placeholder="0x4AAAAAA..." />
                        <p class="description">Khóa bí mật (Secret Key) dùng để xác thực API phía Back-end.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button( 'Lưu cấu hình hệ thống' ); ?>
        </form>

        <!-- Form gửi thư thử nghiệm -->
        <div style="max-width: 800px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h2>3. Kiểm tra kết nối SMTP (Gửi thử email)</h2>
            <p>Sau khi lưu cấu hình SMTP, bạn hãy nhập Email để gửi thử một lá thư kiểm tra kết nối xem có hoạt động bình thường không nhé.</p>
            <form action="" method="post" style="display: flex; gap: 10px; align-items: center;">
                <?php wp_nonce_field( 'hieucon_test_smtp_nonce' ); ?>
                <input type="email" name="hieucon_test_smtp_email" required placeholder="email-cua-ban@gmail.com" class="regular-text" style="margin: 0; height: 30px;" />
                <button type="submit" class="button button-secondary">Gửi thư kiểm thử</button>
            </form>
        </div>
    </div>
    <?php
}

// 4. Giao diện trang danh sách Hội viên
function hieucon_members_page_html() {
    global $wpdb;
    $table = $wpdb->prefix . 'hieucon_members';

    $action = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : 'list';
    $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

    // --- Xử lý các hành động Post / Get ---
    
    // A. Xử lý Thêm / Chỉnh sửa Hội viên
    if ( isset( $_POST['hieucon_member_submit'] ) && check_admin_referer( 'hieucon_member_nonce' ) ) {
        $email           = sanitize_email( $_POST['email'] );
        $full_name       = sanitize_text_field( $_POST['full_name'] );
        $phone_number    = sanitize_text_field( $_POST['phone_number'] );
        $date_of_birth   = sanitize_text_field( $_POST['date_of_birth'] );
        $role            = sanitize_text_field( $_POST['role'] );
        $status          = sanitize_text_field( $_POST['status'] );
        $password        = $_POST['password'];
        $child_name      = sanitize_text_field( $_POST['child_name'] );
        $child_dob       = sanitize_text_field( $_POST['child_dob'] );
        $child_gender    = sanitize_text_field( $_POST['child_gender'] );
        $child_diagnosis = sanitize_text_field( $_POST['child_diagnosis'] );
        $has_password    = isset( $_POST['has_password'] ) ? intval( $_POST['has_password'] ) : 1;

        if ( empty( $email ) || empty( $full_name ) ) {
            echo '<div class="notice notice-error"><p><strong>Vui lòng điền Email và Họ tên bắt buộc.</strong></p></div>';
        } else {
            if ( $id > 0 ) {
                // Sửa hội viên
                $update_data = [
                    'full_name'       => $full_name,
                    'phone_number'    => $phone_number,
                    'date_of_birth'   => $date_of_birth,
                    'role'            => $role,
                    'status'          => $status,
                    'child_name'      => $child_name,
                    'child_dob'       => $child_dob,
                    'child_gender'    => $child_gender,
                    'child_diagnosis' => $child_diagnosis,
                    'has_password'    => $has_password,
                ];
                if ( ! empty( $password ) ) {
                    $update_data['password'] = $password;
                }
                
                \Hieucon\Model\Member_Model::update( $id, $update_data );
                echo '<div class="notice notice-success"><p><strong>Cập nhật thông tin hội viên thành công!</strong></p></div>';
            } else {
                // Thêm hội viên mới
                if ( empty( $password ) ) {
                    $password = '12345678a'; // Mật khẩu mặc định
                }
                
                // Kiểm tra email đã có chưa
                if ( \Hieucon\Model\Member_Model::get_by_email( $email ) ) {
                    echo '<div class="notice notice-error"><p><strong>Email này đã tồn tại trên hệ thống.</strong></p></div>';
                } else {
                    $new_id = \Hieucon\Model\Member_Model::create( [
                        'email'           => $email,
                        'password'        => $password,
                        'full_name'       => $full_name,
                        'phone_number'    => $phone_number,
                        'date_of_birth'   => $date_of_birth,
                        'role'            => $role,
                        'child_name'      => $child_name,
                        'child_dob'       => $child_dob,
                        'child_gender'    => $child_gender,
                        'child_diagnosis' => $child_diagnosis,
                        'has_password'    => $has_password,
                    ] );
                    if ( $new_id ) {
                        echo '<div class="notice notice-success"><p><strong>Thêm hội viên mới thành công!</strong> Mật khẩu mặc định: ' . esc_html( $password ) . '</p></div>';
                    }
                }
            }
            $action = 'list';
        }
    }

    // B. Xử lý hành động Toggle Status (Khóa/Mở khóa)
    if ( 'toggle_status' === $action && $id > 0 ) {
        $member = \Hieucon\Model\Member_Model::get_by_id( $id );
        if ( $member ) {
            $new_status = ( $member->status === 'active' ) ? 'blocked' : 'active';
            \Hieucon\Model\Member_Model::update( $id, [ 'status' => $new_status ] );
            echo '<div class="notice notice-success"><p><strong>Đã đổi trạng thái tài khoản thành công!</strong></p></div>';
        }
        $action = 'list';
    }

    // C. Xử lý hành động Xóa hội viên
    if ( 'delete' === $action && $id > 0 ) {
        $wpdb->delete( $table, [ 'id' => $id ], [ '%d' ] );
        echo '<div class="notice notice-success"><p><strong>Đã xóa hội viên khỏi cơ sở dữ liệu thành công!</strong></p></div>';
        $action = 'list';
    }

    // --- HIỂN THỊ GIAO DIỆN ---

    // Giao diện THÊM MỚI / CHỈNH SỬA
    if ( 'add' === $action || 'edit' === $action ) {
        $member = null;
        if ( 'edit' === $action && $id > 0 ) {
            $member = \Hieucon\Model\Member_Model::get_by_id( $id );
        }
        ?>
        <div class="wrap">
            <h1><?php echo $member ? 'Chỉnh sửa Hội viên' : 'Thêm Hội viên Mới'; ?></h1>
            <a href="?page=hieucon-members" class="button button-secondary" style="margin-bottom: 20px;">← Quay lại danh sách</a>
            
            <form action="" method="post" style="max-width: 600px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <?php wp_nonce_field( 'hieucon_member_nonce' ); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="email">Địa chỉ Email</label></th>
                        <td>
                            <input type="email" name="email" id="email" value="<?php echo $member ? esc_attr( $member->email ) : ''; ?>" class="regular-text" <?php echo $member ? 'readonly style="background:#f0f0f0;"' : 'required'; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="full_name">Họ và Tên</label></th>
                        <td>
                            <input type="text" name="full_name" id="full_name" value="<?php echo $member ? esc_attr( $member->full_name ) : ''; ?>" class="regular-text" required />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="phone_number">Số Điện Thoại</label></th>
                        <td>
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo $member ? esc_attr( $member->phone_number ) : ''; ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="date_of_birth">Ngày Sinh</label></th>
                        <td>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $member ? esc_attr( $member->date_of_birth ) : ''; ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="password">Mật khẩu</label></th>
                        <td>
                            <input type="password" name="password" id="password" class="regular-text" <?php echo $member ? '' : 'placeholder="Bỏ trống sẽ là 12345678a"'; ?> />
                            <?php if ( $member ) : ?>
                                <p class="description">Chỉ điền nếu muốn đổi mật khẩu mới cho người dùng này.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="role">Vai Trò (Role)</label></th>
                        <td>
                            <select name="role" id="role">
                                <option value="user" <?php selected( $member ? $member->role : 'user', 'user' ); ?>>Người dùng thường (User)</option>
                                <option value="assistant" <?php selected( $member ? $member->role : '', 'assistant' ); ?>>Trợ lý (Assistant)</option>
                                <option value="expert" <?php selected( $member ? $member->role : '', 'expert' ); ?>>Chuyên gia (Expert)</option>
                            </select>
                        </td>
                    </tr>
                    <?php if ( $member ) : ?>
                        <tr>
                            <th scope="row"><label for="status">Trạng Thái</label></th>
                            <td>
                                <select name="status" id="status">
                                    <option value="active" <?php selected( $member->status, 'active' ); ?>>Đang hoạt động (Active)</option>
                                    <option value="blocked" <?php selected( $member->status, 'blocked' ); ?>>Bị khóa (Blocked)</option>
                                </select>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <tr style="border-top: 1px solid #eee;"><th colspan="2" style="padding-top:20px; padding-bottom:5px;"><h3 style="margin:0;">Thông tin của Con (CRM)</h3></th></tr>
                    <tr>
                        <th scope="row"><label for="child_name">Họ và Tên con</label></th>
                        <td>
                            <input type="text" name="child_name" id="child_name" value="<?php echo $member ? esc_attr( $member->child_name ) : ''; ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="child_dob">Ngày sinh con</label></th>
                        <td>
                            <input type="text" name="child_dob" id="child_dob" value="<?php echo $member ? esc_attr( $member->child_dob ) : ''; ?>" class="regular-text" placeholder="DD/MM/YYYY" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="child_gender">Giới tính con</label></th>
                        <td>
                            <select name="child_gender" id="child_gender">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="Bé Trai" <?php selected( $member ? $member->child_gender : '', 'Bé Trai' ); ?>>Bé Trai</option>
                                <option value="Bé Gái" <?php selected( $member ? $member->child_gender : '', 'Bé Gái' ); ?>>Bé Gái</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="child_diagnosis">Chẩn đoán / Mô tả thêm</label></th>
                        <td>
                            <input type="text" name="child_diagnosis" id="child_diagnosis" value="<?php echo $member ? esc_attr( $member->child_diagnosis ) : ''; ?>" class="regular-text" placeholder="Ví dụ: Tăng động, kén ăn..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="has_password">Trạng thái tài khoản</label></th>
                        <td>
                            <select name="has_password" id="has_password">
                                <option value="1" <?php selected( $member ? $member->has_password : 1, 1 ); ?>>Đã thiết lập mật khẩu</option>
                                <option value="0" <?php selected( $member ? $member->has_password : 1, 0 ); ?>>Chưa thiết lập mật khẩu (Tạo tự động từ khảo sát)</option>
                            </select>
                        </td>
                    </tr>
                    <?php if ( $member && ! empty( $member->participated_checklists ) ) : ?>
                    <tr>
                        <th scope="row">Checklist đã làm</th>
                        <td>
                            <div style="max-height: 120px; overflow-y: auto; background: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 4px; max-width: 350px;">
                                <?php 
                                $chks = json_decode($member->participated_checklists, true) ?: [];
                                if ( ! empty($chks) ) {
                                    echo '<ul style="margin:0; padding-left:15px; list-style-type:disc;">';
                                    foreach ($chks as $chk) {
                                        echo '<li>' . esc_html($chk) . '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo '—';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
                <?php submit_button( $member ? 'Lưu thay đổi' : 'Thêm hội viên mới', 'primary', 'hieucon_member_submit' ); ?>
            </form>
        </div>
        <?php
        return;
    }

    // --- Giao diện DANH SÁCH MẶC ĐỊNH ---
    
    // 1. Phân trang & lọc
    $per_page     = 20;
    $current_page = isset( $_GET['paged'] ) ? max( 1, intval( $_GET['paged'] ) ) : 1;
    $offset       = ( $current_page - 1 ) * $per_page;

    // Phục vụ tìm kiếm & Lọc
    $search = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
    $role   = isset( $_GET['role_filter'] ) ? sanitize_text_field( $_GET['role_filter'] ) : '';
    $status = isset( $_GET['status_filter'] ) ? sanitize_text_field( $_GET['status_filter'] ) : '';

    $where_clauses = [];
    if ( ! empty( $search ) ) {
        $where_clauses[] = $wpdb->prepare( "(email LIKE %s OR full_name LIKE %s OR phone_number LIKE %s)", "%$search%", "%$search%", "%$search%" );
    }
    if ( ! empty( $role ) ) {
        $where_clauses[] = $wpdb->prepare( "role = %s", $role );
    }
    if ( ! empty( $status ) ) {
        $where_clauses[] = $wpdb->prepare( "status = %s", $status );
    }

    $where_sql = '';
    if ( ! empty( $where_clauses ) ) {
        $where_sql = ' WHERE ' . implode( ' AND ', $where_clauses );
    }

    // Lấy danh sách thành viên từ CSDL
    $query_members = "SELECT * FROM $table $where_sql ORDER BY created_at DESC LIMIT $offset, $per_page";
    $members       = $wpdb->get_results( $query_members );

    // Đếm tổng số để chia trang
    $total_query = "SELECT COUNT(*) FROM $table $where_sql";
    $total_items = $wpdb->get_var( $total_query );
    $total_pages = ceil( $total_items / $per_page );

    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Danh sách Hội viên Hieucon</h1>
        <a href="?page=hieucon-members&action=add" class="page-title-action">Thêm Hội viên Mới</a>
        <hr class="wp-header-end">

        <!-- Lọc thành viên -->
        <form method="get" style="margin: 15px 0; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="page" value="hieucon-members" />
            
            <input type="search" name="s" value="<?php echo esc_attr( $search ); ?>" placeholder="Tìm email, họ tên, sđt..." />
            
            <select name="role_filter">
                <option value="">-- Lọc theo Vai Trò --</option>
                <option value="user" <?php selected( $role, 'user' ); ?>>Người dùng thường</option>
                <option value="assistant" <?php selected( $role, 'assistant' ); ?>>Trợ lý</option>
                <option value="expert" <?php selected( $role, 'expert' ); ?>>Chuyên gia</option>
            </select>

            <select name="status_filter">
                <option value="">-- Lọc trạng thái --</option>
                <option value="active" <?php selected( $status, 'active' ); ?>>Đang hoạt động</option>
                <option value="blocked" <?php selected( $status, 'blocked' ); ?>>Bị khóa</option>
            </select>

            <button type="submit" class="button button-secondary">Lọc & Tìm kiếm</button>
            <?php if ( ! empty( $search ) || ! empty( $role ) || ! empty( $status ) ) : ?>
                <a href="?page=hieucon-members" class="button button-link">Xóa bộ lọc</a>
            <?php endif; ?>
        </form>

        <!-- Bảng danh sách hội viên -->
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px;">ID</th>
                    <th scope="col">Họ và Tên phụ huynh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Thông tin Con (CRM)</th>
                    <th scope="col">Checklist tham gia</th>
                    <th scope="col">Vai Trò</th>
                    <th scope="col">Trạng Thái / Mật khẩu</th>
                    <th scope="col">Ngày Tham Gia</th>
                    <th scope="col" style="text-align: right; width: 220px;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( ! empty( $members ) ) : ?>
                    <?php foreach ( $members as $m ) : ?>
                        <tr>
                            <td><?php echo intval( $m->id ); ?></td>
                            <td><strong><?php echo esc_html( $m->full_name ); ?></strong></td>
                            <td><?php echo esc_html( (strpos($m->email, '@hieucon.vn') !== false) ? '—' : $m->email ); ?></td>
                            <td><?php echo esc_html( $m->phone_number ? $m->phone_number : '—' ); ?></td>
                            <td>
                                <?php if ( $m->child_name ) : ?>
                                    <div style="font-size:12px; line-height:1.4;">
                                        <strong>Tên con:</strong> <?php echo esc_html( $m->child_name ); ?><br>
                                        <strong>Sinh:</strong> <?php echo esc_html( $m->child_dob ? $m->child_dob : '—' ); ?> 
                                        <?php if($m->child_gender) echo ' (' . esc_html($m->child_gender) . ')'; ?><br>
                                        <?php if($m->child_diagnosis) : ?>
                                            <strong>Mô tả:</strong> <span class="description" style="font-style:italic;"><?php echo esc_html($m->child_diagnosis); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <span style="color:#aaa;">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $chks = json_decode($m->participated_checklists, true) ?: [];
                                if ( ! empty($chks) ) {
                                    echo '<div style="font-size:11px; max-height: 80px; overflow-y:auto; line-height: 1.3;">';
                                    foreach ($chks as $chk) {
                                        echo '<span style="background:#eaeaea; color:#333; padding:2px 5px; border-radius:3px; display:inline-block; margin-bottom:3px; margin-right:3px;">' . esc_html($chk) . '</span>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo '<span style="color:#aaa;">—</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ( $m->role === 'expert' ) {
                                    echo '<span class="badge" style="background:#22c55e;color:#fff;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:bold;">Chuyên gia</span>';
                                } elseif ( $m->role === 'assistant' ) {
                                    echo '<span class="badge" style="background:#3b82f6;color:#fff;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:bold;">Trợ lý</span>';
                                } else {
                                    echo '<span class="badge" style="background:#6b7280;color:#fff;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:bold;">Người dùng</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <div style="font-size:12px; line-height:1.5;">
                                    <?php if ( $m->status === 'active' ) : ?>
                                        <span style="color: #22c55e; font-weight: bold;">● Hoạt động</span>
                                    <?php else : ?>
                                        <span style="color: #ef4444; font-weight: bold;">● Khóa</span>
                                    <?php endif; ?><br>
                                    
                                    <?php if ( intval($m->has_password) === 1 ) : ?>
                                        <span style="color: #3b82f6; font-size: 11px;">🔒 Đã lập MK</span>
                                    <?php else : ?>
                                        <span style="color: #f59e0b; font-size: 11px;">🔓 Chưa lập MK</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?php echo date( 'H:i d/m/Y', strtotime( $m->created_at ) ); ?></td>
                            <td style="text-align: right;">
                                <a href="?page=hieucon-members&action=edit&id=<?php echo intval( $m->id ); ?>" class="button button-small">Sửa</a>
                                <a href="?page=hieucon-members&action=toggle_status&id=<?php echo intval( $m->id ); ?>" class="button button-small button-secondary">
                                    <?php echo $m->status === 'active' ? 'Khóa' : 'Kích hoạt'; ?>
                                </a>
                                <a href="?page=hieucon-members&action=delete&id=<?php echo intval( $m->id ); ?>" class="button button-small button-link-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa hội viên này vĩnh viễn khỏi CSDL không? Hành động này không thể hoàn tác!');" style="color: #ef4444;">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 20px 0;">Không tìm thấy hội viên nào khớp với bộ lọc.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <?php if ( $total_pages > 1 ) : ?>
            <div class="tablenav bottom">
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo intval( $total_items ); ?> hội viên</span>
                    <span class="pagination-links">
                        <?php if ( $current_page > 1 ) : ?>
                            <a class="prev-page button" href="?page=hieucon-members&paged=<?php echo $current_page - 1; ?>&s=<?php echo esc_attr($search); ?>&role_filter=<?php echo esc_attr($role); ?>&status_filter=<?php echo esc_attr($status); ?>">‹</a>
                        <?php endif; ?>
                        
                        <span class="screen-reader-text">Trang hiện tại</span>
                        <span class="paging-input">
                            <span class="current-page"><?php echo $current_page; ?></span> trong <span class="total-pages"><?php echo $total_pages; ?></span>
                        </span>
                        
                        <?php if ( $current_page < $total_pages ) : ?>
                            <a class="next-page button" href="?page=hieucon-members&paged=<?php echo $current_page + 1; ?>&s=<?php echo esc_attr($search); ?>&role_filter=<?php echo esc_attr($role); ?>&status_filter=<?php echo esc_attr($status); ?>">›</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
