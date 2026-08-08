<?php
/**
 * DocumentingHope Checklist Tracking & Admin Page
 */

// 1. Install Custom Table
function hieucon_install_dh_checklist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_code varchar(10) NOT NULL,
        child_name varchar(255) NOT NULL DEFAULT '',
        parent_name varchar(255) NOT NULL DEFAULT '',
        parent_phone varchar(50) NOT NULL DEFAULT '',
        parent_email varchar(100) NOT NULL DEFAULT '',
        child_age varchar(50) NOT NULL DEFAULT '',
        child_gender varchar(20) DEFAULT NULL,
        child_height varchar(20) DEFAULT NULL,
        child_weight varchar(20) DEFAULT NULL,
        child_diagnosis varchar(255) NOT NULL DEFAULT '',
        child_therapy text DEFAULT NULL,
        child_supplement text DEFAULT NULL,
        parent_concern text DEFAULT NULL,
        scores_json text DEFAULT NULL,
        behaviors_json longtext DEFAULT NULL,
        extra_symptoms text DEFAULT NULL,
        time_spent int(11) NOT NULL DEFAULT 0,
        device_info text DEFAULT NULL,
        deep_analytics longtext DEFAULT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        UNIQUE KEY user_code (user_code)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    // Tự động add column nếu dbDelta không chạy
    $existing_cols = $wpdb->get_col( "SHOW COLUMNS FROM $table_name", 0 );
    if ( ! in_array( 'child_name', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN child_name varchar(255) NOT NULL DEFAULT '' AFTER user_code" );
    }
    if ( ! in_array( 'parent_email', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN parent_email varchar(100) NOT NULL DEFAULT '' AFTER parent_phone" );
    }
    if ( ! in_array( 'time_spent', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN time_spent int(11) NOT NULL DEFAULT 0 AFTER extra_symptoms" );
    }
    if ( ! in_array( 'device_info', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN device_info text DEFAULT NULL AFTER time_spent" );
    }
    if ( ! in_array( 'deep_analytics', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN deep_analytics longtext DEFAULT NULL AFTER device_info" );
    }
    if ( ! in_array( 'child_height', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN child_height varchar(20) DEFAULT NULL AFTER child_age" );
    }
    if ( ! in_array( 'child_weight', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN child_weight varchar(20) DEFAULT NULL AFTER child_height" );
    }
    if ( ! in_array( 'child_gender', $existing_cols ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN child_gender varchar(20) DEFAULT NULL AFTER child_age" );
    }
}
add_action('after_setup_theme', 'hieucon_install_dh_checklist_table');

// 2. Register Admin Menu
function hieucon_dh_checklist_admin_menu() {
    // Đăng ký dưới dạng Submenu của menu chính gộp
    add_submenu_page(
        'hieucon-checklist-main',
        'DocumentingHope',
        'DocumentingHope',
        'manage_options',
        'hieucon-dh-checklist',
        'hieucon_dh_checklist_admin_page'
    );
}
add_action('admin_menu', 'hieucon_dh_checklist_admin_menu', 11);

// 3. Helper Parse User Agent
function hieucon_parse_user_agent($ua) {
    if (empty($ua)) return 'Không rõ thiết bị';
    
    $os = 'Khác';
    if (preg_match('/iphone/i', $ua)) {
        $os = 'iPhone';
    } elseif (preg_match('/ipad/i', $ua)) {
        $os = 'iPad';
    } elseif (preg_match('/android/i', $ua)) {
        $os = 'Android';
    } elseif (preg_match('/macintosh|mac os x/i', $ua)) {
        $os = 'Mac';
    } elseif (preg_match('/windows|win32/i', $ua)) {
        $os = 'Windows';
    } elseif (preg_match('/linux/i', $ua)) {
        $os = 'Linux';
    }

    $browser = 'Khác';
    if (preg_match('/Zalo/i', $ua)) {
        $browser = 'Zalo App';
    } elseif (preg_match('/FBAV|FBAN|FB_IAB/i', $ua)) {
        $browser = 'Facebook App';
    } elseif (preg_match('/CocCoc|coc_coc/i', $ua)) {
        $browser = 'Cốc Cốc';
    } elseif (preg_match('/Edg/i', $ua)) {
        $browser = 'Edge';
    } elseif (preg_match('/Brave/i', $ua)) {
        $browser = 'Brave';
    } elseif (preg_match('/Chrome|CriOS/i', $ua)) {
        $browser = 'Chrome';
    } elseif (preg_match('/Firefox|FxiOS/i', $ua)) {
        $browser = 'Firefox';
    } elseif (preg_match('/Safari/i', $ua)) {
        $browser = 'Safari';
    }

    return "$os - $browser";
}

// 4. Admin Page HTML/PHP
function hieucon_dh_checklist_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    
    // Save password option if posted
    if (isset($_POST['hieucon_save_password'])) {
        check_admin_referer('hieucon_save_password_action');
        $new_pass = sanitize_text_field($_POST['hieucon_checklist_view_password']);
        update_option('hieucon_checklist_view_password', $new_pass);
        echo '<div class="notice notice-success is-dismissible"><p>Đã lưu mật khẩu bảo mật xem kết quả thành công!</p></div>';
    }

    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 500");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Checklist DocumentingHope</h1>
        <a href="<?php echo admin_url('admin-post.php?action=hieucon_dh_export_csv'); ?>" class="page-title-action">Xuất CSV toàn bộ dữ liệu</a>
        <p>Danh sách khách hàng đã điền Checklist Toàn Diện (DocumentingHope).</p>
        
        <!-- Password Settings Form -->
        <div style="background:#ffffff; border:1px solid #ccd0d4; padding:15px; margin-bottom:20px; max-width:600px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <form method="POST" style="margin:0; padding:0;">
                <?php wp_nonce_field('hieucon_save_password_action'); ?>
                <h3 style="margin-top:0; margin-bottom:8px; font-size:14px; color:#1d2327;">Cấu hình Mật khẩu bảo mật xem kết quả</h3>
                <p class="description" style="margin:0 0 12px 0;">Mật khẩu này được sử dụng khi truy cập trực tiếp bằng liên kết không đi kèm mã xác thực (Ví dụ: từ link chia sẻ hoặc truy cập trực tiếp bằng mã hồ sơ).</p>
                <div style="display:flex; gap:10px; align-items:center;">
                    <input type="text" name="hieucon_checklist_view_password" value="<?php echo esc_attr(get_option('hieucon_checklist_view_password', 'hieucon2026')); ?>" style="width:250px; margin:0;" class="regular-text" required>
                    <button type="submit" name="hieucon_save_password" class="button button-secondary">Lưu mật khẩu</button>
                </div>
            </form>
        </div>
        
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th style="width:60px;">ID</th>
                    <th style="width:100px;">Mã KH (8 số)</th>
                    <th style="width:160px;">Phụ huynh</th>
                    <th style="width:120px;">SĐT</th>
                    <th style="width:150px;">Tuổi / Chẩn đoán</th>
                    <th style="width:200px;">Analyst (Hành vi)</th>
                    <th>Thời gian</th>
                    <th style="width:120px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                <tr><td colspan="7">Chưa có kết quả nào.</td></tr>
                <?php else: ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo esc_html($row->id); ?></td>
                            <td><strong><?php echo esc_html($row->user_code); ?></strong></td>
                            <td>
                                <?php echo esc_html($row->parent_name ? $row->parent_name : '---'); ?><br>
                                <span style="font-size:11px; color:#666;"><?php echo esc_html($row->parent_email ? $row->parent_email : '---'); ?></span>
                            </td>
                            <td><?php echo esc_html($row->parent_phone ? $row->parent_phone : '---'); ?></td>
                            <td>
                                Bé: <strong><?php echo esc_html($row->child_name ? $row->child_name : '---'); ?></strong><br>
                                Tuổi: <?php echo esc_html($row->child_age); ?><br>
                                CĐ: <?php echo esc_html($row->child_diagnosis); ?>
                            </td>
                            <td>
                                <span style="font-size:12px;">⏱ <strong><?php echo intval($row->time_spent ?? 0); ?></strong> giây</span><br>
                                <span style="font-size:11px; color:#666;" title="<?php echo esc_attr($row->device_info ?? ''); ?>">📱 <?php echo esc_html(hieucon_parse_user_agent($row->device_info ?? '')); ?></span>
                                
                                <?php if (!empty($row->deep_analytics)): 
                                    $da = json_decode($row->deep_analytics, true);
                                    if (is_string($da)) $da = json_decode($da, true); // Fix cho dữ liệu cũ bị mã hoá 2 lần
                                    if (is_array($da)):
                                ?>
                                <details style="margin-top: 8px; font-size: 11px; background: #f0f0f1; padding: 5px; border-radius: 4px;">
                                    <summary style="cursor:pointer; font-weight:bold; color:#2271b1;">Xem hành vi sâu</summary>
                                    <div style="margin-top:5px; border-top:1px solid #ccc; padding-top:5px;">
                                        <strong>Active Tab:</strong> <?php echo intval($da['activeTime'] ?? 0); ?>s<br>
                                        <strong>Vị trí:</strong> <?php echo esc_html(($da['location'] ?? 'N/A') . ' (IP: ' . ($da['ip'] ?? '') . ')'); ?><br>
                                        <strong>UTM:</strong> <?php echo esc_html(json_encode($da['utms'] ?? [])); ?><br>
                                        
                                        <?php 
                                        $toggles = $da['toggles'] ?? [];
                                        $hesitations = [];
                                        if (is_array($toggles) || is_object($toggles)) {
                                            foreach ($toggles as $itemName => $count) {
                                                if ($count > 1) $hesitations[] = "$itemName ($count lần)";
                                            }
                                        }
                                        if (!empty($hesitations)): ?>
                                        <strong style="color:#d97706;">Lưỡng lự ở:</strong> <?php echo esc_html(implode(' | ', $hesitations)); ?><br>
                                        <?php endif; ?>

                                        <?php if (!empty($da['thinkTimes']) && is_array($da['thinkTimes'])): 
                                            $maxThink = -1; $maxThinkGroup = '';
                                            foreach($da['thinkTimes'] as $grp => $sec) {
                                                if ($sec > $maxThink) { $maxThink = $sec; $maxThinkGroup = $grp; }
                                            }
                                            if ($maxThink >= 0):
                                        ?>
                                        <strong>Suy nghĩ lâu nhất tại:</strong> <?php echo esc_html($maxThinkGroup) . " ($maxThink giây)"; ?><br>
                                        <?php endif; endif; ?>

                                        <strong>Ký tự đã xoá:</strong> <?php echo intval($da['deletedChars'] ?? 0); ?><br>
                                        <?php if(!empty($da['highlighted'])): ?>
                                        <strong>Đã bôi đen:</strong> <?php echo esc_html(implode(', ', $da['highlighted'])); ?>
                                        <?php endif; ?>
                                        <?php if(!empty($da['drop_point'])): ?>
                                        <br><strong style="color:red;">Trạng thái:</strong> <?php echo esc_html($da['drop_point']); ?>
                                        <?php endif; ?>
                                    </div>
                                </details>
                                <?php endif; endif; ?>
                            </td>
                            <td><?php echo esc_html($row->created_at); ?></td>
                            <td>
                                <a href="<?php echo esc_url(site_url('/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap?code=' . $row->user_code . '&auth=' . md5($row->user_code . 'hieucon_secret_salt'))); ?>" target="_blank" class="button button-primary">Xem chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// 4. AJAX Endpoint to receive data
add_action('wp_ajax_hieucon_dh_submit_checklist', 'hieucon_dh_submit_checklist');
add_action('wp_ajax_nopriv_hieucon_dh_submit_checklist', 'hieucon_dh_submit_checklist');
function hieucon_dh_submit_checklist() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    
    $user_code = isset($_POST['user_code']) ? sanitize_text_field($_POST['user_code']) : '';
    if (!$user_code) {
        $user_code = sprintf('%08d', mt_rand(10000000, 99999999));
    }

    $parent_name = isset($_POST['parent_name']) ? sanitize_text_field($_POST['parent_name']) : '';
    $parent_phone = isset($_POST['parent_phone']) ? sanitize_text_field($_POST['parent_phone']) : '';
    $parent_email = isset($_POST['parent_email']) ? sanitize_email($_POST['parent_email']) : '';
    $child_name = isset($_POST['child_name']) ? sanitize_text_field($_POST['child_name']) : '';
    $child_age = isset($_POST['child_age']) ? sanitize_text_field($_POST['child_age']) : '';
    $child_gender = isset($_POST['child_gender']) ? sanitize_text_field($_POST['child_gender']) : '';
    $child_height = isset($_POST['child_height']) ? sanitize_text_field($_POST['child_height']) : '';
    $child_weight = isset($_POST['child_weight']) ? sanitize_text_field($_POST['child_weight']) : '';
    $child_diagnosis = isset($_POST['child_diagnosis']) ? sanitize_text_field($_POST['child_diagnosis']) : '';
    $child_therapy = isset($_POST['child_therapy']) ? sanitize_text_field($_POST['child_therapy']) : '';
    $child_supplement = isset($_POST['child_supplement']) ? sanitize_text_field($_POST['child_supplement']) : '';
    $parent_concern = isset($_POST['parent_concern']) ? sanitize_textarea_field($_POST['parent_concern']) : '';
    $extra_symptoms = isset($_POST['extra_symptoms']) ? sanitize_textarea_field($_POST['extra_symptoms']) : '';
    
    $scores_json = isset($_POST['scores_json']) ? wp_unslash($_POST['scores_json']) : '';
    $behaviors_json = isset($_POST['behaviors_json']) ? wp_unslash($_POST['behaviors_json']) : '';

    $data = [
        'child_name' => $child_name,
        'parent_name' => $parent_name,
        'parent_phone' => $parent_phone,
        'parent_email' => $parent_email,
        'child_age' => $child_age,
        'child_gender' => $child_gender,
        'child_height' => $child_height,
        'child_weight' => $child_weight,
        'child_diagnosis' => $child_diagnosis,
        'child_therapy' => $child_therapy,
        'child_supplement' => $child_supplement,
        'parent_concern' => $parent_concern,
        'extra_symptoms' => $extra_symptoms,
        'scores_json' => $scores_json,
        'behaviors_json' => $behaviors_json,
        'time_spent' => isset($_POST['time_spent']) ? intval($_POST['time_spent']) : 0,
        'device_info' => isset($_POST['device_info']) ? sanitize_text_field($_POST['device_info']) : '',
    ];

    if (isset($_POST['deep_analytics'])) {
        $da = json_decode(wp_unslash($_POST['deep_analytics']), true) ?: [];
        
        // Luôn bắt IP chuẩn từ Server
        $server_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $server_ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        }
        
        if (empty($da['ip'])) {
            $da['ip'] = $server_ip;
        }

        // Nếu JS ngoài frontend bị trình duyệt chặn (Adblocker), Backend sẽ tự động lấy Vị trí
        if (empty($da['location']) || $da['location'] === 'Đang lấy...' || strpos($da['location'], 'Không xác định') !== false) {
            $response = wp_remote_get("http://ip-api.com/json/{$server_ip}?fields=city,regionName");
            if (!is_wp_error($response)) {
                $body = json_decode(wp_remote_retrieve_body($response), true);
                if (!empty($body['city'])) {
                    $da['location'] = $body['city'] . ', ' . $body['regionName'];
                } else {
                    $da['location'] = 'Không xác định';
                }
            } else {
                $da['location'] = 'Không xác định';
            }
        }

        $data['deep_analytics'] = json_encode($da, JSON_UNESCAPED_UNICODE);
    }

    $existing = $wpdb->get_row($wpdb->prepare("SELECT id, parent_email FROM $table_name WHERE user_code = %s", $user_code));

    if ($existing) {
        $wpdb->update($table_name, $data, ['user_code' => $user_code]);
    } else {
        $data['user_code'] = $user_code;
        $wpdb->insert($table_name, $data);
    }

    // Gửi email tự động nếu nộp kết quả cuối cùng và chưa được gửi trước đó
    $is_final = !empty($parent_email) && !empty($scores_json);
    $already_sent = ($existing && !empty($existing->parent_email));
    if ($is_final && !$already_sent) {
        hieucon_send_checklist_email($user_code, $parent_name, $parent_email, $child_name, $child_age, $child_gender, $scores_json);
    }

    wp_send_json_success(['user_code' => $user_code, 'auth' => md5($user_code . 'hieucon_secret_salt')]);
}

// 5. Export CSV
add_action('admin_post_hieucon_dh_export_csv', 'hieucon_dh_export_csv_handler');
function hieucon_dh_export_csv_handler() {
    if (!current_user_can('manage_options')) {
        wp_die('Bạn không có quyền truy cập.');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="dh-checklist-export-' . date('Ymd-His') . '.csv"');
    
    // Add BOM to fix UTF-8 in Excel
    echo "\xEF\xBB\xBF";

    $output = fopen('php://output', 'w');
    
    $headers = [
        'ID', 'Mã KH', 'Tên con', 'Phụ huynh', 'SĐT', 'Email phụ huynh', 'Tuổi', 'Chẩn đoán hiện tại', 'Đang can thiệp', 'Sản phẩm hỗ trợ', 
        'Lo lắng nhất', 'Triệu chứng khác', 'Thời gian làm bài (giây)', 'Thời gian nộp', 'Thiết bị',
        'Vị trí', 'IP', 'Thời gian Active (giây)', 'Tiến trình (Drop-off)', 'Nhóm suy nghĩ lâu nhất', 
        'Lưỡng lự (Tick/Untick)', 'Số ký tự đã xoá', 'Từ khoá bôi đen', 'UTMs', 'Danh sách dấu hiệu chọn'
    ];
    fputcsv($output, $headers);

    foreach ($results as $row) {
        $da = json_decode($row->deep_analytics, true);
        
        $device = hieucon_parse_user_agent($row->device_info ?? '');
        
        $hesitations = [];
        $toggles = $da['toggles'] ?? [];
        if (is_array($toggles) || is_object($toggles)) {
            foreach ($toggles as $itemName => $count) {
                if ($count > 1) $hesitations[] = "$itemName ($count lần)";
            }
        }
        $hesitation_str = implode(' | ', $hesitations);

        $maxThink = 0; $maxThinkGroup = '';
        if (!empty($da['thinkTimes']) && (is_array($da['thinkTimes']) || is_object($da['thinkTimes']))) {
            foreach($da['thinkTimes'] as $grp => $sec) {
                if ($sec > $maxThink) { $maxThink = $sec; $maxThinkGroup = $grp; }
            }
        }
        $think_str = $maxThink > 0 ? "$maxThinkGroup ({$maxThink}s)" : "";

        $behaviors_obj = json_decode($row->behaviors_json, true) ?: [];
        $behaviors_str_arr = [];
        foreach ($behaviors_obj as $gid => $items) {
            if (is_array($items) && !empty($items)) {
                $behaviors_str_arr[] = "- " . $gid . ": " . implode("; ", $items);
            }
        }
        $behaviors_str = implode(" \n", $behaviors_str_arr);

        $line = [
            $row->id,
            $row->user_code,
            $row->child_name,
            $row->parent_name,
            $row->parent_phone,
            $row->parent_email,
            $row->child_age,
            $row->child_diagnosis,
            $row->child_therapy,
            $row->child_supplement,
            $row->parent_concern,
            $row->extra_symptoms,
            $row->time_spent,
            $row->created_at,
            $device,
            $da['location'] ?? '',
            $da['ip'] ?? '',
            $da['activeTime'] ?? 0,
            $da['drop_point'] ?? '',
            $think_str,
            $hesitation_str,
            $da['deletedChars'] ?? 0,
            !empty($da['highlighted']) && is_array($da['highlighted']) ? implode(', ', $da['highlighted']) : '',
            !empty($da['utms']) && is_array($da['utms']) ? json_encode($da['utms'], JSON_UNESCAPED_UNICODE) : '',
            $behaviors_str
        ];
        
        fputcsv($output, $line);
    }
    
    fclose($output);
    exit;
}

// 6. Public Results View - Hiển thị kết quả đẹp (Không chẩn đoán)
add_action('template_redirect', 'hieucon_dh_public_checklist_result');
function hieucon_dh_public_checklist_result() {
    if ( strpos($_SERVER['REQUEST_URI'], '/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap') !== 0 || !isset($_GET['code']) ) return;

    $code = sanitize_text_field($_GET['code']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE user_code = %s OR parent_email = %s OR parent_phone = %s ORDER BY id DESC LIMIT 1",
        $code, $code, $code
    ));

    if (!$row) {
        get_header();
        echo '<div style="padding:40px; text-align:center; font-family:sans-serif; color:#b91c1c;">Không tìm thấy kết quả cho mã hồ sơ này.</div>';
        get_footer();
        exit;
    }

    // Check authentication
    $secret_salt = 'hieucon_secret_salt';
    $expected_hash = md5($row->user_code . $secret_salt);
    $authenticated = false;
    $auth_error = '';

    // 1. Check auth query parameter
    if (isset($_GET['auth']) && $_GET['auth'] === $expected_hash) {
        $authenticated = true;
        setcookie('hieucon_auth_' . $row->user_code, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }
    // 2. Check cookie
    elseif (isset($_COOKIE['hieucon_auth_' . $row->user_code]) && $_COOKIE['hieucon_auth_' . $row->user_code] === $expected_hash) {
        $authenticated = true;
    }
    // 3. Check POST submission
    elseif (isset($_POST['hieucon_pass'])) {
        $pass_input = sanitize_text_field($_POST['hieucon_pass']);
        $configured_pass = get_option('hieucon_checklist_view_password', 'hieucon2026');

        if (trim($pass_input) === trim($configured_pass)) {
            $authenticated = true;
            setcookie('hieucon_auth_' . $row->user_code, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
            wp_safe_redirect(add_query_arg('auth', $expected_hash));
            exit;
        } else {
            $auth_error = 'Mật khẩu bảo mật không chính xác. Vui lòng nhập đúng mật khẩu để mở khóa kết quả.';
        }
    }

    if (!$authenticated) {
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        
        add_filter('pre_get_document_title', function() {
            return 'Xác thực bảo mật kết quả - Hiểu Con Từ Gốc';
        }, 999);

        get_header();
        ?>
        <div class="results-page-body flex items-center justify-center px-4 py-16" style="background-color: #faf9f6; font-family: 'Quicksand', sans-serif; min-height: 70vh; display: flex; align-items: center; justify-content: center; width: 100%;">
            <div style="background: #ffffff; border: 1px solid #D6E2F5; max-width: 480px; width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(13, 42, 120, 0.08); padding: 32px 24px; text-align: center; box-sizing: border-box;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔒</div>
                <h2 style="font-family: 'Oswald', sans-serif; font-size: 22px; color: #0D2A78; margin: 0 0 12px 0; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Xác thực bảo mật</h2>
                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0 0 24px 0;">
                    Báo cáo kết quả của con được bảo mật. Vui lòng nhập <strong>Mật khẩu bảo mật</strong> được cung cấp để mở khóa xem chi tiết:
                </p>
                
                <form method="POST" style="margin: 0; padding: 0;">
                    <?php if (!empty($auth_error)): ?>
                        <div style="background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; font-size: 13px; text-align: left; margin-bottom: 16px; line-height: 1.5; box-sizing: border-box;">
                            ⚠️ <?php echo esc_html($auth_error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div style="margin-bottom: 20px; text-align: left;">
                        <input type="password" name="hieucon_pass" placeholder="Nhập mật khẩu mở khóa..." required 
                            style="width: 100%; padding: 12px 16px; border: 1.5px solid #CBD5E1; border-radius: 8px; font-size: 14px; font-family: 'Quicksand', sans-serif; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='#0D2A78'" onblur="this.style.borderColor='#CBD5E1'">
                    </div>
                    
                    <button type="submit" style="width: 100%; background: linear-gradient(135deg, #0d2a78 0%, #163ca3 100%); color: #ffffff; padding: 12px; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; font-family: 'Quicksand', sans-serif; cursor: pointer; box-shadow: 0 4px 12px rgba(13, 42, 120, 0.2); transition: opacity 0.2s; box-sizing: border-box;"
                        onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Mở khóa kết quả
                    </button>
                </form>
            </div>
        </div>
        <?php
        get_footer();
        exit;
    }

    // Fix 404 status and set page title
    global $wp_query;
    $wp_query->is_404 = false;
    status_header(200);
    
    add_filter('pre_get_document_title', function() use ($row) {
        return esc_html($row->parent_name) . ' - Kết quả Checklist';
    }, 999);

    get_header();

        $name       = esc_html($row->parent_name ?: 'Ẩn danh');
        $phone_disp = esc_html($row->parent_phone);
        $updated    = date('d/m/Y', strtotime($row->updated_at));
        $scores     = json_decode($row->scores_json, true) ?: [];
        $behaviors  = json_decode($row->behaviors_json, true) ?: [];
    ?>
      <!-- Include Tailwind CSS & Chart.js -->
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
      
      <style>
        :root {
          --navy: #002795;
          --yellow: #FFD154;
          --charcoal: #1e293b;
          --bg-body: #faf9f6;
          --white: #FFFFFF;
          --gray: #64748b;
          --border: #e2e8f0;
          --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
          --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .results-page-body {
          background-color: var(--bg-body);
          color: var(--charcoal);
          font-family: 'Quicksand', sans-serif;
          min-height: 100vh;
        }

        .panel-title {
          font-family: 'Oswald', sans-serif;
        }

        /* Alarm Pulse Animation */
        @keyframes pulse-red {
          0%, 100% {
            border-color: #fda4af;
            background-color: #fff1f2;
            box-shadow: 0 0 0 0 rgba(225, 29, 72, 0.2);
          }
          50% {
            border-color: #e11d48;
            background-color: #ffe4e6;
            box-shadow: 0 0 10px 2px rgba(225, 29, 72, 0.15);
          }
        }
        .alarm-pulse {
          animation: pulse-red 2s infinite ease-in-out;
        }
        
        /* Orange Pulse Glow Animation for consult button */
        @keyframes orange-pulse-glow {
          0%, 100% {
            transform: scale(1);
            box-shadow: 0 4px 12px rgba(240, 90, 37, 0.3);
          }
          50% {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(240, 90, 37, 0.5), 0 0 0 4px rgba(240, 90, 37, 0.15);
          }
        }
        .btn-pulse-orange {
          animation: orange-pulse-glow 2s infinite ease-in-out;
        }
        .has-pattern-bg {
          position: relative !important;
          background: transparent !important;
          overflow: hidden !important;
          z-index: 1 !important;
        }
        .has-pattern-bg::before {
          content: "" !important;
          position: absolute !important;
          top: 0 !important;
          left: 0 !important;
          right: 0 !important;
          bottom: 0 !important;
          background-color: #002795 !important;
          z-index: -2 !important;
          pointer-events: none !important;
        }
        .has-pattern-bg::after {
          content: "" !important;
          position: absolute !important;
          top: 0 !important;
          left: 0 !important;
          right: 0 !important;
          bottom: 0 !important;
          background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pattern-hieu-con.png?v=1.2") !important;
          background-size: 200px !important;
          background-position: right 40px center !important;
          background-repeat: no-repeat !important;
          opacity: 0.1 !important;
          z-index: -1 !important;
          pointer-events: none !important;
        }
      </style>

      <div class="results-page-body py-10 antialiased">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header Banner -->
            <div class="bg-[#002795] text-white rounded-2xl p-6 mb-8 text-center shadow-md border border-solid border-white/10 relative overflow-hidden has-pattern-bg">
                <div class="absolute -right-24 -bottom-24 w-64 h-64 bg-white/5 rounded-full pointer-events-none"></div>
                <h1 class="text-xl md:text-2xl font-bold panel-title uppercase tracking-wide m-0" style="color: white; line-height: 1.4;">BẢNG GHI DẤU HIỆU DỰA TRÊN DỮ LIỆU PHỤ HUYNH CUNG CẤP</h1>
            </div>

            <!-- Top Grid Layout: 1/3 Left, 2/3 Right -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-8">
                
                <!-- 1/3 Left Column: Profile Info & Action CTAs -->
                <div class="lg:col-span-1 flex flex-col gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6">
                        <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-4 text-[#002795] font-bold text-base uppercase tracking-wider m-0">Thông Tin Hồ Sơ</h2>
                        
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold tracking-wider m-0">Mã hồ sơ</p>
                                <h3 class="text-sm font-bold text-slate-800 mt-1 m-0">#<?php echo esc_html($row->user_code); ?></h3>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold tracking-wider m-0">Ngày ghi nhận</p>
                                <h3 class="text-sm font-bold text-slate-800 mt-1 m-0"><?php echo esc_html($updated); ?></h3>
                            </div>

                            <!-- Parent Info Section -->
                            <div class="col-span-2 border-t border-solid border-slate-100 pt-3">
                                <p class="text-[11px] text-[#002795] uppercase font-bold tracking-wider mb-2">Thông tin phụ huynh</p>
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Họ tên:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->parent_name ?: '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Số điện thoại:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->parent_phone ?: '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Email:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->parent_email ?: '---'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Child Info Section -->
                            <div class="col-span-2 border-t border-solid border-slate-100 pt-3">
                                <p class="text-[11px] text-[#002795] uppercase font-bold tracking-wider mb-2">Thông tin của con</p>
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Họ tên con:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->child_name ?: '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Tuổi con:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->child_age ?: '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Giới tính:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->child_gender ?: '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Chiều cao:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->child_height ? $row->child_height . ' cm' : '---'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Cân nặng:</span>
                                        <span class="font-bold text-slate-800"><?php echo esc_html($row->child_weight ? $row->child_weight . ' kg' : '---'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Biomedicals & Concerns Section -->
                            <?php if (!empty($row->child_diagnosis) || !empty($row->child_therapy) || !empty($row->child_supplement) || !empty($row->parent_concern)): ?>
                            <div class="col-span-2 border-t border-solid border-slate-100 pt-3">
                                <p class="text-[11px] text-[#002795] uppercase font-bold tracking-wider mb-2">Thông tin bổ sung</p>
                                <div class="flex flex-col gap-2">
                                    <?php if (!empty($row->child_diagnosis)): ?>
                                    <div class="text-xs bg-slate-50 p-2 rounded border border-solid border-slate-100">
                                        <div class="text-[10px] text-gray-500 uppercase font-semibold">Chẩn đoán y tế:</div>
                                        <div class="font-medium text-slate-800 mt-0.5"><?php echo esc_html($row->child_diagnosis); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($row->child_therapy)): ?>
                                    <div class="text-xs bg-slate-50 p-2 rounded border border-solid border-slate-100">
                                        <div class="text-[10px] text-gray-500 uppercase font-semibold">Can thiệp/Trị liệu đang dùng:</div>
                                        <div class="font-medium text-slate-800 mt-0.5"><?php echo esc_html($row->child_therapy); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($row->child_supplement)): ?>
                                    <div class="text-xs bg-slate-50 p-2 rounded border border-solid border-slate-100">
                                        <div class="text-[10px] text-gray-500 uppercase font-semibold">Dinh dưỡng/Bổ sung đang dùng:</div>
                                        <div class="font-medium text-slate-800 mt-0.5"><?php echo esc_html($row->child_supplement); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($row->parent_concern)): ?>
                                    <div class="text-xs bg-slate-50 p-2 rounded border border-solid border-slate-100">
                                        <div class="text-[10px] text-gray-500 uppercase font-semibold">Băn khoăn/Mối bận tâm lớn nhất:</div>
                                        <div class="font-medium text-slate-800 mt-0.5"><?php echo esc_html($row->parent_concern); ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-6 p-4 rounded-xl bg-[#fffbeb] border border-solid border-[#fef08a] text-xs text-[#854d0e] leading-relaxed">
                            <strong>Lưu ý:</strong> Bảng đánh giá dựa trên dữ liệu phụ huynh cung cấp. Không thay thế chẩn đoán y tế chuyên khoa.
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col gap-3">
                        <button onclick="consultAndCopyLink()" class="flex items-center justify-center font-bold py-3.5 px-4 rounded-xl text-white hover:opacity-90 transition-all text-sm text-center border-0 cursor-pointer font-family-inherit btn-pulse-orange" style="background: linear-gradient(135deg, #F05A25 0%, #FF7A45 100%); color: #ffffff !important; outline: none;">
                            💬 Tư vấn
                        </button>
                        <p class="text-[11px] text-gray-500 text-center m-0">(Hệ thống tự động sao chép link kết quả để gửi chuyên gia qua Zalo)</p>
                    </div>
                </div>

                <!-- 2/3 Right Column: Combined Radar Chart & Priority Issues -->
                <div class="lg:col-span-2 flex flex-col h-full">
                    <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 flex flex-col flex-grow">
                        <!-- Card Header -->
                        <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-4 text-[#002795] font-bold text-base uppercase tracking-wider m-0 text-center">
                            Tổng quan dấu hiệu cha mẹ ghi nhận
                        </h2>

                        <!-- 1. Radar Chart (Massive size) -->
                        <div style="position: relative; flex-grow: 1; width: 100%; min-height: 480px;">
                            <canvas id="resultBarChartCanvas"></canvas>
                        </div>
                        <p class="text-[11px] text-gray-500 text-center mt-2 mb-6 leading-relaxed">
                            Tỷ lệ biểu hiện dấu hiệu của từng hệ cơ quan.
                        </p>

                        <!-- 2. Priority Issues (3 items side-by-side below the chart) -->
                        <?php if (!empty($scores)): 
                            usort($scores, function($a, $b) { return $b['pct'] <=> $a['pct']; });
                        ?>
                        <div class="border-t border-solid border-slate-100 pt-6">
                            <h3 class="panel-title text-sm font-bold text-[#002795] uppercase tracking-wider mb-2 mt-0">
                                🚨 Các vấn đề cần ưu tiên hỗ trợ sớm
                            </h3>
                            <p class="text-xs text-gray-500 mb-4 leading-relaxed" style="margin: 0 0 16px 0;">
                                Đây là các nhóm dấu hiệu nổi bật nhất được ghi nhận qua quan sát. Quý phụ huynh vui lòng liên hệ với chuyên gia để nhận phân tích chi tiết và lộ trình hỗ trợ phù hợp cho con.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php 
                                $count = 0;
                                foreach ($scores as $sg): 
                                    if ($count >= 3) break; // Only show top 3
                                    if ($sg['pct'] <= 0) continue; // Skip if 0%
                                    $is_top = true;
                                    $bar_color = '#e11d48';
                                    $wrap_class = 'alarm-pulse border border-solid border-[#fda4af] rounded-xl';
                                    $wrap_style = 'padding:12px; border-radius:12px; border:1.5px solid #fda4af;';
                                    $text_color = '#be123c';
                                ?>
                                    <div class="<?php echo $wrap_class; ?>" style="<?php echo $wrap_style; ?>">
                                        <div style="display:flex; justify-content:space-between; font-size:12.5px; margin-bottom:6px; font-weight:700;">
                                            <span style="color:<?php echo $text_color; ?>;"><?php echo esc_html($sg['name']); ?></span>
                                            <span style="color:<?php echo $bar_color; ?>;"><?php echo intval($sg['pct']); ?>%</span>
                                        </div>
                                        <div style="height:6px; background:#f1f5f9; border-radius:6px; overflow:hidden;">
                                            <div style="height:100%; width:<?php echo intval($sg['pct']); ?>%; background:<?php echo $bar_color; ?>; border-radius:6px;"></div>
                                        </div>
                                        <?php 
                                        $group_descs = hieucon_dh_get_group_descriptions();
                                        $id_or_name = !empty($sg['id']) ? $sg['id'] : $sg['name'];
                                        $desc = isset($group_descs[$id_or_name]) ? $group_descs[$id_or_name] : '';
                                        if ($desc): 
                                        ?>
                                            <div style="font-size:12px; color:#475569; line-height:1.5; margin-top:8px; border-top:1px dashed #fecaca; padding-top:8px; text-align:left;">
                                                <?php echo esc_html($desc); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php 
                                    $count++;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Chi Tiết Dấu Hiệu Ghi Nhận -->
            <?php if (!empty($behaviors)): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 mb-8">
                <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-6 text-[#002795] font-bold text-base uppercase tracking-wider m-0">Chi Tiết Dấu Hiệu Ghi Nhận</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($scores as $sg): 
                        $items = isset($behaviors[$sg['id']]) ? $behaviors[$sg['id']] : (isset($behaviors[$sg['name']]) ? $behaviors[$sg['name']] : []);
                        if (empty($items)) continue;
                    ?>
                      <div class="bg-[#f8fafc] border border-solid border-[#e2e8f0] rounded-xl p-4 transition-all hover:border-[#002795]/20 hover:shadow-sm <?php echo (isset($scores[0]) && $sg['id'] === $scores[0]['id'] && $sg['pct'] > 0) ? 'alarm-pulse border border-solid border-[#fda4af]' : ''; ?>" style="<?php echo (isset($scores[0]) && $sg['id'] === $scores[0]['id'] && $sg['pct'] > 0) ? 'border-radius:12px; border: 1.5px solid #fda4af;' : ''; ?>">
                        <h4 class="text-sm font-bold text-[#002795] pb-2 mb-3 border-b border-solid border-slate-200 flex items-center gap-1.5 mt-0">
                          <span style="font-size: 16px;"><?php echo esc_html(isset($sg['icon']) ? $sg['icon'] : ''); ?></span>
                          <span class="panel-title" style="<?php echo (isset($scores[0]) && $sg['id'] === $scores[0]['id'] && $sg['pct'] > 0) ? 'color:#be123c;' : ''; ?>"><?php echo esc_html($sg['name']); ?></span>
                        </h4>
                        <ul class="list-none p-0 m-0 flex flex-col gap-2">
                          <?php foreach ($items as $item): ?>
                            <li style="font-size:12.5px; color:#334155; padding-left:18px; position:relative; line-height:1.4; text-align: left;">
                              <span style="position:absolute; left:0; color:#d97706; font-weight:900;">✓</span>
                              <span><?php echo esc_html($item); ?></span>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Extra Symptoms Note -->
            <?php if (!empty($row->extra_symptoms)): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 mb-8">
                <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-4 text-[#002795] font-bold text-base uppercase tracking-wider m-0">Ghi chú khác từ phụ huynh</h2>
                <p style="font-size:13.5px; color:#475569; white-space:pre-wrap; margin:0; line-height:1.6; text-align: left;"><?php echo esc_html($row->extra_symptoms); ?></p>
            </div>
            <?php endif; ?>
            
            <p class="text-center text-xs text-gray-400 mt-10">© <?php echo date('Y'); ?> Hiểu Con Từ Gốc.</p>
        </div>
      </div>

      <div id="copy-toast" style="visibility: hidden; min-width: 300px; max-width:400px; background-color: var(--navy); color: #fff; text-align: center; border-radius: 12px; padding: 24px; position: fixed; z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0.9); box-shadow: 0 10px 40px rgba(0,0,0,0.2); font-size: 15px; opacity: 0; transition: opacity 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <div style="font-size:32px; margin-bottom:12px;">✅</div>
        <strong>Đã copy link thành công!</strong><br>
        <div style="opacity:0.9; font-size: 13.5px; margin-top:8px; line-height:1.5;">Hãy gửi link này cho Trợ Lý Nam Khánh hoặc lưu lại link để xem lại kết quả vào lần sau nhé!</div>
      </div>

      <script>
      function consultAndCopyLink() {
        const dummy = document.createElement('input');
        document.body.appendChild(dummy);
        dummy.value = window.location.href;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
        const toast = document.getElementById("copy-toast");
        toast.innerHTML = '<strong>Đã copy link kết quả thành công!</strong><br><div style="opacity:0.9; font-size: 13px; margin-top:8px; line-height:1.5;">Đang tự động chuyển hướng đến Zalo hỗ trợ để bạn gửi link kết quả vừa copy...</div>';
        toast.style.visibility = "visible";
        toast.style.opacity = "1";
        toast.style.transform = "translate(-50%, -50%) scale(1)";
        
        setTimeout(function(){
          toast.style.opacity = "0";
          toast.style.transform = "translate(-50%, -50%) scale(0.9)";
          setTimeout(function(){
            toast.style.visibility = "hidden";
          }, 300);
        }, 4000);
        
        setTimeout(function() {
          window.open("https://zalo.me/0985391881", "_blank");
        }, 1000);
      }

      function copyResultLink() {
        const dummy = document.createElement('input');
        document.body.appendChild(dummy);
        dummy.value = window.location.href;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
        const toast = document.getElementById("copy-toast");
        toast.style.visibility = "visible";
        toast.style.opacity = "1";
        toast.style.transform = "translate(-50%, -50%) scale(1)";
        
        setTimeout(function(){
          toast.style.opacity = "0";
          toast.style.transform = "translate(-50%, -50%) scale(0.9)";
          setTimeout(function(){
            toast.style.visibility = "hidden";
          }, 300);
        }, 4000);
      }

      // Initialize Bar Chart in Result Page
      document.addEventListener('DOMContentLoaded', () => {
          const ctx = document.getElementById('resultBarChartCanvas');
          if (!ctx) return;
          
          const originalOrder = ['tieuHoa', 'anUong', 'giacNgu', 'camGiac', 'tangDong', 'camXuc', 'mienDich', 'vanDong'];
          const scoresMap = {};
          <?php foreach ($scores as $s): ?>
              scoresMap['<?php echo esc_js($s['id']); ?>'] = {
                  name: '<?php echo esc_js($s['name']); ?>',
                  pct: <?php echo intval($s['pct']); ?>
              };
          <?php endforeach; ?>
          
          const labels = [
              ['Rối loạn', 'tiêu hóa'],
              ['Rối loạn', 'ăn uống'],
              ['Rối loạn', 'giấc ngủ'],
              ['Xử lý', 'giác quan'],
              ['Tăng động -', 'Giảm chú ý'],
              ['Cảm xúc -', 'Hành vi'],
              ['Miễn dịch -', 'Dị ứng'],
              ['Chức năng', 'vận động']
          ];
          const chartData = [];
          originalOrder.forEach(id => {
              if (scoresMap[id]) {
                  chartData.push(scoresMap[id].pct);
              }
          });

          // Identify priority groups
          const priorityIds = [];
          <?php 
          $count = 0;
          foreach ($scores as $s) {
              if ($count < 3 && $s['pct'] > 0) {
                  echo "priorityIds.push('" . esc_js($s['id']) . "');\n";
                  $count++;
              }
          }
          ?>

          const pointBgColors = [];
          const pointBorderColors = [];
          const pointRadii = [];
          
          originalOrder.forEach(id => {
              const isPriority = priorityIds.includes(id);
              if (isPriority) {
                  pointBgColors.push('#e11d48'); // Red dot
                  pointBorderColors.push('#ffffff'); // White border
                  pointRadii.push(7.5);
              } else {
                  pointBgColors.push('#FFD154'); // Yellow dot
                  pointBorderColors.push('#002795'); // Navy border
                  pointRadii.push(5.5);
              }
          });

          // Smooth glowing pulse with index-based phase offset
          const startTime = Date.now();
          
          const radarPulsePlugin = {
              id: 'radarPulsePlugin',
              afterDatasetsDraw(chart) {
                  const { ctx } = chart;
                  const meta = chart.getDatasetMeta(0);
                  if (!meta || !meta.data) return;

                  const elapsed = (Date.now() - startTime) / 1000;

                  originalOrder.forEach((id, idx) => {
                      const isPriority = priorityIds.includes(id);
                      if (!isPriority) return;

                      const point = meta.data[idx];
                      if (!point) return;
                      const { x, y } = point;
                      if (typeof x !== 'number' || typeof y !== 'number' || isNaN(x) || isNaN(y)) return;

                      // Phase offset per point to make them out of sync
                      const phase = elapsed * 3.0 + (idx * 1.8);
                      
                      // Draw 2 expanding rings
                      // Ring 1
                      const progress1 = (phase % Math.PI) / Math.PI;
                      const r1 = 7.5 + progress1 * 35; // expand up to 35px
                      const opacity1 = (1 - progress1) * 0.6;

                      ctx.save();
                      ctx.strokeStyle = `rgba(225, 29, 72, ${opacity1})`;
                      ctx.lineWidth = 1.5;
                      ctx.beginPath();
                      ctx.arc(x, y, r1, 0, 2 * Math.PI);
                      ctx.stroke();
                      ctx.restore();

                      // Ring 2 (offset phase)
                      const progress2 = ((phase + Math.PI/2) % Math.PI) / Math.PI;
                      const r2 = 7.5 + progress2 * 35;
                      const opacity2 = (1 - progress2) * 0.3;

                      ctx.save();
                      ctx.strokeStyle = `rgba(225, 29, 72, ${opacity2})`;
                      ctx.lineWidth = 1.0;
                      ctx.beginPath();
                      ctx.arc(x, y, r2, 0, 2 * Math.PI);
                      ctx.stroke();
                      ctx.restore();
                  });
              }
          };

          const chart = new Chart(ctx, {
              type: 'radar',
              plugins: [radarPulsePlugin],
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Tỷ lệ biểu hiện (%)',
                      data: chartData,
                      backgroundColor: 'rgba(0, 39, 149, 0.15)',
                      borderColor: '#002795',
                      borderWidth: 2,
                      pointBackgroundColor: pointBgColors,
                      pointBorderColor: pointBorderColors,
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: '#002795',
                      pointRadius: pointRadii,
                      pointHitRadius: 10
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  layout: {
                      padding: 0
                  },
                  plugins: {
                      legend: {
                          display: false
                      },
                      tooltip: {
                          animation: false,
                          callbacks: {
                              title: function(context) {
                                  if (!context || !context.length || !context[0]) return '';
                                  const label = context[0].label;
                                  if (Array.isArray(label)) {
                                      return label.join(' ');
                                  }
                                  return label;
                              },
                              label: function(context) {
                                  if (!context || context.raw === undefined) return '';
                                  return 'Tỷ lệ biểu hiện: ' + context.raw + '%';
                              }
                          }
                      }
                  },
                  scales: {
                      r: {
                          angleLines: {
                              color: 'rgba(0, 39, 149, 0.18)',
                              lineWidth: 1.8
                          },
                          grid: {
                              color: 'rgba(0, 39, 149, 0.15)',
                              lineWidth: 1.5
                          },
                          pointLabels: {
                              display: true,
                              color: '#0f172a',
                              padding: 4,
                              font: {
                                  family: 'Quicksand, sans-serif',
                                  size: 11,
                                  weight: '800'
                              }
                          },
                          ticks: {
                              backdropColor: 'transparent',
                              color: '#64748b',
                              font: {
                                  size: 9
                              },
                              stepSize: 10
                          },
                          min: 0,
                          max: 100
                      }
                  }
              }
          });

          function pulse() {
              if (!chart) return;
              const elapsed = (Date.now() - startTime) / 1000;
              
              const currentRadii = [];
              const currentHoverRadii = [];
              originalOrder.forEach((id, idx) => {
                  const isPriority = priorityIds.includes(id);
                  if (isPriority) {
                      const phase = elapsed * 3.0 + (idx * 1.8);
                      const currentRadius = 4 + (Math.sin(phase) + 1) * 2; // pulse smoothly between 4px and 8px
                      currentRadii.push(currentRadius);
                      currentHoverRadii.push(currentRadius + 2);
                  } else {
                      currentRadii.push(4);
                      currentHoverRadii.push(6);
                  }
              });
              chart.data.datasets[0].pointRadius = currentRadii;
              chart.data.datasets[0].pointHoverRadius = currentHoverRadii;
              chart.update('none');
              requestAnimationFrame(pulse);
          }
          requestAnimationFrame(pulse);
      });
      </script>    <?php
    get_footer();
    exit;
}

/**
 * Gửi email kết quả Checklist cho phụ huynh dưới dạng HTML đẹp mắt.
 */
function hieucon_send_checklist_email($user_code, $parent_name, $parent_email, $child_name, $child_age, $child_gender, $scores_json) {
    $scores = json_decode($scores_json, true) ?: [];
    
    // Sắp xếp các nhóm theo tỉ lệ % dấu hiệu giảm dần
    usort($scores, function($a, $b) {
        return $b['pct'] <=> $a['pct'];
    });
    
    $group_descs = hieucon_dh_get_group_descriptions();
    
    $top_issues_html = '';
    $count = 0;
    foreach ($scores as $sg) {
        if ($count >= 3) break;
        if ($sg['pct'] > 0) {
            $id_or_name = !empty($sg['id']) ? $sg['id'] : $sg['name'];
            $desc = isset($group_descs[$id_or_name]) ? $group_descs[$id_or_name] : '';
            
            $top_issues_html .= '<div style="margin-bottom: 16px; line-height: 1.6;">';
            $top_issues_html .= '<div class="issue-item-title" style="font-size: 14px; font-weight: 700; color: #0D2A78;">Vấn đề ' . ($count + 1) . ': ' . esc_html($sg['name']) . '</div>';
            if ($desc) {
                $top_issues_html .= '<div class="issue-item-desc" style="font-size: 13.5px; color: #475569; margin-top: 4px; padding-left: 12px; border-left: 2px solid #CBD5E1;">- ' . esc_html($desc) . '</div>';
            }
            $top_issues_html .= '</div>';
            $count++;
        }
    }
    
    if (empty($top_issues_html)) {
        $top_issues_html = '<div style="font-size: 14px; color: #475569; font-style: italic;">Chưa ghi nhận vấn đề sức khỏe nổi bật nào.</div>';
    }

    $auth_token = md5($user_code . 'hieucon_secret_salt');
    $result_url = esc_url(site_url('/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap?code=' . $user_code . '&auth=' . $auth_token));
    $subject = 'Kết quả bộ công cụ nhận diện các vấn đề sức khoẻ thường gặp.';
    
    ob_start();
    include get_template_directory() . '/page-templates/parts-checklist/mail-template.php';
    $message = ob_get_clean();
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($parent_email, $subject, $message, $headers);
}

// 7. Group Descriptions Helper
function hieucon_dh_get_group_descriptions() {
    return [
        'tieuHoa'  => 'Sức khỏe hệ tiêu hóa là nền tảng quan trọng giúp trẻ phát triển thể chất, ổn định hành vi và nâng cao hiệu quả can thiệp. Rối loạn tiêu hóa ảnh hưởng trực tiếp đến dinh dưỡng, giấc ngủ, cảm xúc, khả năng học tập, hành vi của trẻ.',
        'anUong'   => 'Tình trạng rối loạn ăn uống kéo dài có thể dẫn đến thiếu hụt dinh dưỡng, chậm tăng trưởng, suy giảm thể lực, đồng thời làm gia tăng căng thẳng, hành vi chống đối và khó khăn trong sinh hoạt gia đình.',
        'giacNgu'  => 'Rối loạn giấc ngủ khiến trẻ có nhu cầu đặc biệt dễ mệt mỏi, cáu gắt, giảm tập trung và gia tăng hành vi thách thức. Giấc ngủ chất lượng là nền tảng giúp não bộ phục hồi, củng cố khả năng học tập và nâng cao hiệu quả can thiệp.',
        'camGiac'  => 'Rối loạn xử lý giác quan ảnh hưởng đến cảm xúc, hành vi, khả năng tập trung và mức độ tham gia của trẻ trong học tập, vui chơi và sinh hoạt hằng ngày.',
        'tangDong' => 'Rối loạn tăng động - giảm chú ý ảnh hưởng trực tiếp tới sức khỏe tâm - thân - trí của trẻ, khiến trẻ khó khăn trong học tập và hòa nhập, khó kiểm soát hành vi, cảm xúc và tương tác xã hội.',
        'mienDich' => 'Miễn dịch dị ứng ảnh hưởng đến đa cơ quan- tiêu hóa, hệ thần kinh, ảnh hưởng đến giấc ngủ, giảm tập trung và ảnh hưởng đến khả năng học tập, sinh hoạt của trẻ.',
        'vanDong'  => 'Chức năng vận động là nền tảng giúp trẻ giữ thăng bằng, phối hợp cơ thể và thực hiện các hoạt động hằng ngày. Khó khăn về vận động có thể hạn chế khả năng tự lập, vui chơi, học tập và hòa nhập xã hội của trẻ.',
        'camXuc'   => 'Khó khăn trong điều hòa cảm xúc khiến trẻ dễ lo âu, cáu gắt, bùng nổ, hạn chế khả năng giao tiếp xã hội, ảnh hưởng đến khả năng giao tiếp, học tập và sinh hoạt.',
        
        // Fallbacks by exact Vietnamese names to be absolutely robust
        'Rối loạn tiêu hóa' => 'Sức khỏe hệ tiêu hóa là nền tảng quan trọng giúp trẻ phát triển thể chất, ổn định hành vi và nâng cao hiệu quả can thiệp. Rối loạn tiêu hóa ảnh hưởng trực tiếp đến dinh dưỡng, giấc ngủ, cảm xúc, khả năng học tập, hành vi của trẻ.',
        'Rối loạn ăn uống'  => 'Tình trạng rối loạn ăn uống kéo dài có thể dẫn đến thiếu hụt dinh dưỡng, chậm tăng trưởng, suy giảm thể lực, đồng thời làm gia tăng căng thẳng, hành vi chống đối và khó khăn trong sinh hoạt gia đình.',
        'Rối loạn giấc ngủ' => 'Rối loạn giấc ngủ khiến trẻ có nhu cầu đặc biệt dễ mệt mỏi, cáu gắt, giảm tập trung và gia tăng hành vi thách thức. Giấc ngủ chất lượng là nền tảng giúp não bộ phục hồi, củng cố khả năng học tập và nâng cao hiệu quả can thiệp.',
        'Xử lý giác quan'    => 'Rối loạn xử lý giác quan ảnh hưởng đến cảm xúc, hành vi, khả năng tập trung và mức độ tham gia của trẻ trong học tập, vui chơi và sinh hoạt hằng ngày.',
        'Rối loạn xử lý giác quan' => 'Rối loạn xử lý giác quan ảnh hưởng đến cảm xúc, hành vi, khả năng tập trung và mức độ tham gia của trẻ trong học tập, vui chơi và sinh hoạt hằng ngày.',
        'Tăng động - Giảm chú ý' => 'Rối loạn tăng động - giảm chú ý ảnh hưởng trực tiếp tới sức khỏe tâm - thân - trí của trẻ, khiến trẻ khó khăn trong học tập và hòa nhập, khó kiểm soát hành vi, cảm xúc và tương tác xã hội.',
        'Miễn dịch - Dị ứng' => 'Miễn dịch dị ứng ảnh hưởng đến đa cơ quan- tiêu hóa, hệ thần kinh, ảnh hưởng đến giấc ngủ, giảm tập trung và ảnh hưởng đến khả năng học tập, sinh hoạt của trẻ.',
        'Chức năng vận động' => 'Chức năng vận động là nền tảng giúp trẻ giữ thăng bằng, phối hợp cơ thể và thực hiện các hoạt động hằng ngày. Khó khăn về vận động có thể hạn chế khả năng tự lập, vui chơi, học tập và hòa nhập xã hội của trẻ.',
        'Cảm xúc - Hành vi'  => 'Khó khăn trong điều hòa cảm xúc khiến trẻ dễ lo âu, cáu gắt, bùng nổ, hạn chế khả năng giao tiếp xã hội, ảnh hưởng đến khả năng giao tiếp, học tập và sinh hoạt.',
    ];
}
