<?php
/**
 * DocumentingHope Checklist Tracking & Admin Page
 */

// 1. Install Custom Table
function hieucon_install_ndsk_checklist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
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
add_action('after_setup_theme', 'hieucon_install_ndsk_checklist_table');

// 2. Register Admin Menu
function hieucon_ndsk_checklist_admin_menu() {
    // Đăng ký dưới dạng Submenu của menu chính gộp
    add_submenu_page(
        'hieucon-checklist-main',
        'Nhận Diện Sức Khỏe',
        'Nhận Diện Sức Khỏe',
        'manage_options',
        'hieucon-ndsk-checklist',
        'hieucon_ndsk_checklist_admin_page'
    );
}
add_action('admin_menu', 'hieucon_ndsk_checklist_admin_menu', 11);

// 3. Helper Parse User Agent
if (!function_exists('hieucon_parse_user_agent')) {
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
}

// 4. Admin Page HTML/PHP
function hieucon_ndsk_checklist_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
    
    // Save password option if posted
    if (isset($_POST['hieucon_save_password'])) {
        check_admin_referer('hieucon_save_password_action');
        $new_pass = sanitize_text_field($_POST['hieucon_ndsk_view_password']);
        update_option('hieucon_ndsk_view_password', $new_pass);
        echo '<div class="notice notice-success is-dismissible"><p>Đã lưu mật khẩu bảo mật xem kết quả thành công!</p></div>';
    }

    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'submissions';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 500");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Nhận Diện Sức Khỏe Thường Gặp</h1>
        <hr class="wp-header-end">
        
        <h2 class="nav-tab-wrapper" style="margin-bottom: 20px;">
            <a href="?page=hieucon-ndsk-checklist&tab=submissions" class="nav-tab <?php echo $active_tab == 'submissions' ? 'nav-tab-active' : ''; ?>">Danh sách hồ sơ</a>
            <a href="?page=hieucon-ndsk-checklist&tab=password" class="nav-tab <?php echo $active_tab == 'password' ? 'nav-tab-active' : ''; ?>">Mật khẩu truy cập</a>
        </h2>

        <?php if ($active_tab == 'password'): ?>
            <!-- Password Settings Form -->
            <div style="background:#ffffff; border:1px solid #ccd0d4; padding:20px; max-width:600px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                <form method="POST" style="margin:0; padding:0;">
                    <?php wp_nonce_field('hieucon_save_password_action'); ?>
                    <h3 style="margin-top:0; margin-bottom:8px; font-size:15px; color:#1d2327;">Cấu hình Mật khẩu bảo mật</h3>
                    <p class="description" style="margin:0 0 16px 0; line-height:1.5;">Mật khẩu này được sử dụng để bảo mật trang kết quả khi phụ huynh truy cập trực tiếp bằng mã hồ sơ, và bảo mật trang Dashboard phân tích số liệu.</p>
                    <div style="display:flex; gap:10px; align-items:center;">
                        <input type="text" name="hieucon_ndsk_view_password" value="<?php echo esc_attr(get_option('hieucon_ndsk_view_password', 'hieucon2026')); ?>" style="width:250px; margin:0; padding: 6px 10px;" class="regular-text" required>
                        <button type="submit" name="hieucon_save_password" class="button button-primary">Lưu mật khẩu</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                <p style="margin:0;">Danh sách khách hàng đã điền Bộ công cụ nhận diện các vấn đề sức khoẻ thường gặp.</p>
                <a href="<?php echo admin_url('admin-post.php?action=hieucon_ndsk_export_csv'); ?>" class="button button-secondary">Xuất CSV toàn bộ dữ liệu</a>
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
                        <th style="width:120px; text-align:right;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($results)): ?>
                    <tr><td colspan="8">Chưa có kết quả nào.</td></tr>
                    <?php else: ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo esc_html($row->id); ?></td>
                                <td><strong>#<?php echo esc_html($row->user_code); ?></strong></td>
                                <td>
                                    <strong><?php echo esc_html($row->parent_name ? $row->parent_name : '---'); ?></strong><br>
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
                                        if (is_string($da)) $da = json_decode($da, true);
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
                                <td style="text-align:right;">
                                    <a href="<?php echo esc_url(site_url('/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap?code=' . $row->user_code . '&auth=' . md5($row->user_code . 'hieucon_secret_salt'))); ?>" target="_blank" class="button button-small">Xem kết quả</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

// 4. AJAX Endpoint to receive data
add_action('wp_ajax_hieucon_ndsk_submit_checklist', 'hieucon_ndsk_submit_checklist');
add_action('wp_ajax_nopriv_hieucon_ndsk_submit_checklist', 'hieucon_ndsk_submit_checklist');
function hieucon_ndsk_submit_checklist() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
    
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

    // Đồng bộ thông tin CRM Hội viên
    \Hieucon\Model\Member_Model::sync_survey(
        $parent_name,
        $parent_phone,
        $parent_email,
        $child_name,
        $child_age,
        $child_gender,
        $child_diagnosis,
        'Nhận diện sức khỏe'
    );

    // Gửi email tự động nếu nộp kết quả cuối cùng và chưa được gửi trước đó
    $is_final = !empty($parent_email) && !empty($scores_json);
    $already_sent = ($existing && !empty($existing->parent_email));
    if ($is_final && !$already_sent) {
        hieucon_ndsk_send_checklist_email($user_code, $parent_name, $parent_email, $child_name, $child_age, $child_gender, $scores_json);
    }

    wp_send_json_success(['user_code' => $user_code, 'auth' => md5($user_code . 'hieucon_secret_salt')]);
}// 4.5 AJAX Tracking Endpoint
add_action('wp_ajax_hieucon_ndsk_track_view', 'hieucon_ndsk_track_view');
add_action('wp_ajax_nopriv_hieucon_ndsk_track_view', 'hieucon_ndsk_track_view');
function hieucon_ndsk_track_view() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
    
    $code = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';
    $track_type = isset($_POST['track_type']) ? sanitize_text_field($_POST['track_type']) : '';
    
    if (empty($code)) {
        wp_send_json_error('Missing code');
    }
    
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE user_code = %s", $code));
    if (!$row) {
        wp_send_json_error('Record not found');
    }
    
    // Decode deep analytics
    $analytics = !empty($row->deep_analytics) ? json_decode($row->deep_analytics, true) : [];
    if (!is_array($analytics)) {
        $analytics = [];
    }
    
    // Initialize default keys
    if (!isset($analytics['pageviews'])) $analytics['pageviews'] = 0;
    if (!isset($analytics['time_on_page'])) $analytics['time_on_page'] = 0;
    if (!isset($analytics['zalo_clicks'])) $analytics['zalo_clicks'] = 0;
    if (!isset($analytics['history'])) $analytics['history'] = [];
    
    if ($track_type === 'init') {
        $analytics['pageviews']++;
        
        $browser = isset($_POST['browser']) ? sanitize_text_field($_POST['browser']) : '';
        $os = isset($_POST['os']) ? sanitize_text_field($_POST['os']) : '';
        $screen = isset($_POST['screen']) ? sanitize_text_field($_POST['screen']) : '';
        $is_mobile = isset($_POST['is_mobile']) ? sanitize_text_field($_POST['is_mobile']) : '';
        $referrer = isset($_POST['referrer']) ? sanitize_text_field($_POST['referrer']) : '';
        $utm_source = isset($_POST['utm_source']) ? sanitize_text_field($_POST['utm_source']) : '';
        $utm_medium = isset($_POST['utm_medium']) ? sanitize_text_field($_POST['utm_medium']) : '';
        $utm_campaign = isset($_POST['utm_campaign']) ? sanitize_text_field($_POST['utm_campaign']) : '';
        
        // Log access history
        $analytics['history'][] = [
            'timestamp' => current_time('mysql'),
            'browser' => $browser,
            'os' => $os,
            'screen' => $screen,
            'is_mobile' => $is_mobile,
            'referrer' => $referrer,
            'utm_source' => $utm_source,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign
        ];
        
        // Update device_info if empty or keep it simple as string
        $device_desc = "$browser on $os ($is_mobile)";
        $wpdb->update(
            $table_name,
            [
                'device_info' => $device_desc,
                'deep_analytics' => json_encode($analytics)
            ],
            ['id' => $row->id]
        );
        
    } elseif ($track_type === 'heartbeat') {
        $analytics['time_on_page'] += 10; // add 10 seconds per heartbeat
        
        $wpdb->update(
            $table_name,
            [
                'deep_analytics' => json_encode($analytics)
            ],
            ['id' => $row->id]
        );
        
    } elseif ($track_type === 'conversion') {
        $analytics['zalo_clicks']++;
        
        $wpdb->update(
            $table_name,
            [
                'deep_analytics' => json_encode($analytics)
            ],
            ['id' => $row->id]
        );
    }
    
    wp_send_json_success();
}

// 5. Export CSV
add_action('admin_post_hieucon_ndsk_export_csv', 'hieucon_ndsk_export_csv_handler');
function hieucon_ndsk_export_csv_handler() {
    if (!current_user_can('manage_options')) {
        wp_die('Bạn không có quyền truy cập.');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
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
add_action('template_redirect', 'hieucon_ndsk_public_checklist_result');
function hieucon_ndsk_public_checklist_result() {
    if ( strpos($_SERVER['REQUEST_URI'], '/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap') !== 0 || !isset($_GET['code']) ) return;

    $code = sanitize_text_field($_GET['code']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
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
        setcookie('hieucon_ndsk_auth_' . $row->user_code, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }
    // 2. Check cookie
    elseif (isset($_COOKIE['hieucon_ndsk_auth_' . $row->user_code]) && $_COOKIE['hieucon_ndsk_auth_' . $row->user_code] === $expected_hash) {
        $authenticated = true;
    }
    // 3. Check POST submission
    elseif (isset($_POST['hieucon_pass'])) {
        $pass_input = sanitize_text_field($_POST['hieucon_pass']);
        $configured_pass = get_option('hieucon_ndsk_view_password', 'hieucon2026');

        if (trim($pass_input) === trim($configured_pass)) {
            $authenticated = true;
            setcookie('hieucon_ndsk_auth_' . $row->user_code, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
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
        foreach ($scores as &$s_item) {
            if (isset($s_item['pct']) && !isset($s_item['percentage'])) $s_item['percentage'] = $s_item['pct'];
            if (isset($s_item['percentage']) && !isset($s_item['pct'])) $s_item['pct'] = $s_item['percentage'];
        }
        unset($s_item);
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

        /* High-Impact Crimson Red Warning Card Glow Animation */
        @keyframes red-glow-pulse {
          0%, 100% {
            box-shadow: 0 4px 10px rgba(190, 18, 60, 0.2);
            transform: scale(1);
          }
          50% {
            box-shadow: 0 10px 25px rgba(190, 18, 60, 0.45);
            transform: scale(1.015);
          }
        }
        .priority-card-red-pulse {
          animation: red-glow-pulse 2.5s infinite ease-in-out;
        }

        /* Tiny White Warning Beacon Pulse for Crimson background */
        @keyframes white-beacon-pulse {
          0%, 100% {
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.6);
          }
          50% {
            transform: scale(1.2);
            opacity: 0.7;
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0);
          }
        }
        .white-beacon-dot {
          display: inline-block;
          width: 8px;
          height: 8px;
          background-color: #ffffff;
          border-radius: 50%;
          animation: white-beacon-pulse 1.8s infinite ease-in-out;
          flex-shrink: 0;
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
        /* Force parent containers to allow sticky positioning */
        html, body, #page, #content, .site-content, .site {
          overflow: visible !important;
          overflow-x: visible !important;
        }
        /* Iframe view hide global layout components */
        body.is-iframe-view #wpadminbar,
        body.is-iframe-view header,
        body.is-iframe-view footer,
        body.is-iframe-view .site-header,
        body.is-iframe-view .site-footer,
        body.is-iframe-view #masthead,
        body.is-iframe-view #colophon {
          display: none !important;
        }
        html.is-iframe-view {
          margin-top: 0 !important;
        }

        @media (min-width: 1024px) {
          .main-grid-container {
            display: grid !important;
            grid-template-columns: 300px 1fr !important;
            gap: 32px !important;
            align-items: start !important;
          }
          .sticky-header-banner {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 16px !important;
            z-index: 999 !important;
          }
          .admin-bar .sticky-header-banner {
            top: 48px !important;
          }
          .sticky-profile-sidebar {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 128px !important;
            align-self: start !important;
          }
          .admin-bar .sticky-profile-sidebar {
            top: 160px !important;
          }
        }
        @media (max-width: 1023px) {
          .results-page-body {
            padding-bottom: 96px !important;
          }
        }
        .mobile-sticky-actions {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          background: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(8px);
          -webkit-backdrop-filter: blur(8px);
          box-shadow: 0 -8px 24px rgba(0, 0, 0, 0.08);
          padding: 12px 24px;
          z-index: 1000;
          display: flex;
          flex-direction: column;
          gap: 4px !important;
          border-top: 1px solid rgba(226, 232, 240, 0.8);
        }
        .mobile-sticky-actions button {
          width: 100% !important;
          max-width: 480px !important;
          margin: 0 auto !important;
        }
        .mobile-sticky-actions p {
          text-align: center !important;
          width: 100% !important;
        }
        @media (min-width: 1024px) {
          .mobile-sticky-actions {
            position: static !important;
            background: transparent !important;
            backdrop-filter: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            z-index: auto !important;
            border-top: none !important;
            gap: 12px !important;
          }
          .mobile-sticky-actions button {
            width: auto !important;
            max-width: none !important;
          }
        }
      </style>

      <div class="results-page-body py-10 antialiased">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header Banner -->
            <div class="bg-[#002795] text-white rounded-2xl p-6 mb-8 text-center shadow-md border border-solid border-white/10 relative overflow-hidden has-pattern-bg sticky-header-banner">
                <div class="absolute -right-24 -bottom-24 w-64 h-64 bg-white/5 rounded-full pointer-events-none"></div>
                <h1 class="text-xl md:text-2xl font-bold panel-title uppercase tracking-wide m-0" style="color: white; line-height: 1.4;">BẢNG GHI DẤU HIỆU DỰA TRÊN DỮ LIỆU PHỤ HUYNH CUNG CẤP</h1>
            </div>

            <!-- Top Grid Layout: Custom 300px sidebar on Desktop -->
            <div class="grid grid-cols-1 gap-8 mb-8 main-grid-container">
                
                <!-- 1/3 Left Column: Profile Info & Action CTAs -->
                <div class="sticky-profile-sidebar flex flex-col gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 flex-grow flex flex-col">
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

                        <div class="mt-auto pt-6">
                            <div class="p-4 rounded-xl bg-[#fffbeb] border border-solid border-[#fef08a] text-xs text-[#854d0e] leading-relaxed">
                                <strong>Lưu ý:</strong> Bảng đánh giá dựa trên dữ liệu phụ huynh cung cấp. Không thay thế chẩn đoán y tế chuyên khoa.
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mobile-sticky-actions">
                        <button onclick="consultAndCopyLink()" class="flex items-center justify-center font-bold py-3.5 px-4 rounded-xl text-white hover:opacity-90 transition-all text-sm text-center border-0 cursor-pointer font-family-inherit btn-pulse-orange" style="background: linear-gradient(135deg, #F05A25 0%, #FF7A45 100%); color: #ffffff !important; outline: none;">
                            💬 Tư vấn
                        </button>
                        <p class="text-[11px] text-gray-500 text-center m-0">(Hệ thống tự động sao chép link kết quả để gửi chuyên gia qua Zalo)</p>
                    </div>
                </div>

                <!-- 2/3 Right Column: Combined Radar Chart & Priority Issues -->
                <div class="right-content-column flex flex-col h-full">
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
                                Quý phụ huynh vui lòng liên hệ với chuyên gia để nhận tư vấn chi tiết hơn.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php 
                                $count = 0;
                                foreach ($scores as $sg): 
                                    if ($count >= 3) break; // Only show top 3
                                    if ($sg['pct'] <= 0) continue; // Skip if 0%
                                    $is_top = true;
                                    $bar_color = '#ffffff';
                                    $wrap_class = 'priority-card-red-pulse border-0 rounded-2xl flex flex-col';
                                    $wrap_style = 'padding:16px; border-radius:16px; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); transition: all 0.3s ease; text-align: left; border: none;';
                                ?>
                                    <div class="<?php echo $wrap_class; ?>" style="<?php echo $wrap_style; ?>">
                                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; gap:8px;">
                                            <span style="font-family: 'Oswald', sans-serif; font-size:14.5px; font-weight:700; color:#ffffff; letter-spacing:0.2px; display:flex; align-items:center; gap:6px;">
                                                <span class="white-beacon-dot"></span>
                                                <?php echo esc_html($sg['name']); ?>
                                            </span>
                                            <span style="background:rgba(255,255,255,0.2); color:#ffffff; font-size:11px; font-weight:700; padding:2px 8px; border-radius:9999px; white-space:nowrap; font-family:\'Quicksand\', sans-serif;">
                                                <?php echo intval($sg['pct']); ?>%
                                            </span>
                                        </div>
                                        
                                        <div style="height:5px; background:rgba(255,255,255,0.25); border-radius:4px; overflow:hidden; margin-bottom:12px; width:100%;">
                                            <div style="height:100%; width:<?php echo intval($sg['pct']); ?>%; background:<?php echo $bar_color; ?>; border-radius:4px;"></div>
                                        </div>
                                        
                                        <?php 
                                        $group_descs = hieucon_ndsk_get_group_descriptions();
                                        $id_or_name = !empty($sg['id']) ? $sg['id'] : $sg['name'];
                                        $desc = isset($group_descs[$id_or_name]) ? $group_descs[$id_or_name] : '';
                                        if ($desc): 
                                        ?>
                                            <p style="font-size:12.5px; color:rgba(255,255,255,0.95); line-height:1.6; margin:0; font-weight:400; font-family:\'Quicksand\', sans-serif;">
                                                <?php echo esc_html($desc); ?>
                                            </p>
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
                    
                    <!-- Bottom Section: Chi Tiết Dấu Hiệu Ghi Nhận (Moved inside right column) -->
                    <?php if (!empty($behaviors)): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 mt-8">
                        <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-6 text-[#002795] font-bold text-base uppercase tracking-wider m-0">Chi Tiết Dấu Hiệu Ghi Nhận</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            <?php foreach ($scores as $sg): 
                                $items = isset($behaviors[$sg['id']]) ? $behaviors[$sg['id']] : (isset($behaviors[$sg['name']]) ? $behaviors[$sg['name']] : []);
                                if (empty($items)) continue;
                            ?>
                              <div class="bg-[#f8fafc] border border-solid border-[#e2e8f0] rounded-xl p-4 transition-all hover:border-[#002795]/20 hover:shadow-sm" style="border-radius:12px;">
                                <h4 class="text-sm font-bold text-[#002795] pb-2 mb-3 border-b border-solid border-slate-200 flex items-center gap-1.5 mt-0">
                                  <span style="font-size: 16px;"><?php echo esc_html(isset($sg['icon']) ? $sg['icon'] : ''); ?></span>
                                  <span class="panel-title"><?php echo esc_html($sg['name']); ?></span>
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

                    <!-- Extra Symptoms Note (Moved inside right column) -->
                    <?php if (!empty($row->extra_symptoms)): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-solid border-[#e2e8f0] p-6 mt-8">
                        <h2 class="panel-title border-b border-solid border-[#e2e8f0] pb-3 mb-4 text-[#002795] font-bold text-base uppercase tracking-wider m-0">Ghi chú khác từ phụ huynh</h2>
                        <p style="font-size:13.5px; color:#475569; white-space:pre-wrap; margin:0; line-height:1.6; text-align: left;"><?php echo esc_html($row->extra_symptoms); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
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
        
        if (typeof window.hieuconTrackConsultClick === 'function') {
          window.hieuconTrackConsultClick();
        }
        setTimeout(function() {
          window.open("<?php echo home_url('/zalo'); ?>", "_blank");
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

      // Front-end Analytics Tracking Script
      (function() {
          const code = '<?php echo esc_js($row->user_code); ?>';
          const adminAjax = '<?php echo esc_js(admin_url('admin-ajax.php')); ?>';
          
          function getDeviceDetails() {
              const ua = navigator.userAgent;
              let os = "Unknown OS";
              let browser = "Unknown Browser";
              
              if (ua.indexOf("Win") !== -1) os = "Windows";
              else if (ua.indexOf("Mac") !== -1) os = "macOS";
              else if (ua.indexOf("Linux") !== -1) os = "Linux";
              else if (ua.indexOf("Android") !== -1) os = "Android";
              else if (ua.indexOf("like Mac") !== -1) os = "iOS";
              
              if (ua.indexOf("Chrome") !== -1) browser = "Chrome";
              else if (ua.indexOf("Safari") !== -1) browser = "Safari";
              else if (ua.indexOf("Firefox") !== -1) browser = "Firefox";
              else if (ua.indexOf("Edge") !== -1) browser = "Edge";
              else if (ua.indexOf("MSIE") !== -1 || !!document.documentMode) browser = "IE";
              
              const screen = window.screen.width + "x" + window.screen.height;
              const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(ua) ? "Mobile" : "Desktop";
              
              return { os, browser, screen, isMobile };
          }
          
          const device = getDeviceDetails();
          const referrer = document.referrer || '';
          
          const urlParams = new URLSearchParams(window.location.search);
          const utm = {
              source: urlParams.get('utm_source') || '',
              medium: urlParams.get('utm_medium') || '',
              campaign: urlParams.get('utm_campaign') || ''
          };
          
          // Send Initial Log (pageview)
          const xhr = new XMLHttpRequest();
          xhr.open('POST', adminAjax, true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.send('action=hieucon_ndsk_track_view&track_type=init&code=' + encodeURIComponent(code) +
                   '&browser=' + encodeURIComponent(device.browser) +
                   '&os=' + encodeURIComponent(device.os) +
                   '&screen=' + encodeURIComponent(device.screen) +
                   '&is_mobile=' + encodeURIComponent(device.isMobile) +
                   '&referrer=' + encodeURIComponent(referrer) +
                   '&utm_source=' + encodeURIComponent(utm.source) +
                   '&utm_medium=' + encodeURIComponent(utm.medium) +
                   '&utm_campaign=' + encodeURIComponent(utm.campaign));
          
          // Reading time heartbeat (every 10 seconds)
          setInterval(function() {
              const heartbeatXhr = new XMLHttpRequest();
              heartbeatXhr.open('POST', adminAjax, true);
              heartbeatXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              heartbeatXhr.send('action=hieucon_ndsk_track_view&track_type=heartbeat&code=' + encodeURIComponent(code));
          }, 10000);
          
          // Global conversion click logger
          window.hieuconTrackConsultClick = function() {
              const clickXhr = new XMLHttpRequest();
              clickXhr.open('POST', adminAjax, true);
              clickXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              clickXhr.send('action=hieucon_ndsk_track_view&track_type=conversion&code=' + encodeURIComponent(code));
          };
      })();
      </script>    <?php
    get_footer();
    exit;
}

/**
 * Gửi email kết quả Checklist cho phụ huynh dưới dạng HTML đẹp mắt.
 */
function hieucon_ndsk_send_checklist_email($user_code, $parent_name, $parent_email, $child_name, $child_age, $child_gender, $scores_json) {
    $scores = json_decode($scores_json, true) ?: [];
    
    // Sắp xếp các nhóm theo tỉ lệ % dấu hiệu giảm dần
    usort($scores, function($a, $b) {
        return $b['pct'] <=> $a['pct'];
    });
    
    $group_descs = hieucon_ndsk_get_group_descriptions();
    
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
function hieucon_ndsk_get_group_descriptions() {
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

// 8. Body class filter for iframe
add_filter('body_class', 'hieucon_ndsk_iframe_body_class');
function hieucon_ndsk_iframe_body_class($classes) {
    if (isset($_GET['iframe'])) {
        $classes[] = 'is-iframe-view';
    }
    return $classes;
}

// 9. Dashboard Page Routing
add_action('template_redirect', 'hieucon_ndsk_dashboard_page');
function hieucon_ndsk_dashboard_page() {
    if ( strpos($_SERVER['REQUEST_URI'], '/dashboard-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap') !== 0 ) return;

    $configured_pass = get_option('hieucon_ndsk_view_password', 'hieucon2026');
    $expected_hash = md5('hieucon_dashboard_secret_salt_' . $configured_pass);
    $authenticated = false;
    $auth_error = '';

    // Check WordPress Administrator login OR authentication cookie
    if (current_user_can('manage_options') || (isset($_COOKIE['hieucon_dashboard_auth']) && $_COOKIE['hieucon_dashboard_auth'] === $expected_hash)) {
        $authenticated = true;
    }
    // Check POST
    elseif (isset($_POST['hieucon_dashboard_pass'])) {
        $pass_input = sanitize_text_field($_POST['hieucon_dashboard_pass']);
        if (trim($pass_input) === trim($configured_pass)) {
            $authenticated = true;
            setcookie('hieucon_dashboard_auth', $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
            wp_safe_redirect(site_url('/dashboard-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap'));
            exit;
        } else {
            $auth_error = 'Mật khẩu bảo mật không chính xác. Vui lòng nhập đúng mật khẩu để vào dashboard.';
        }
    }

    if (!$authenticated) {
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        ?>
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Xác thực bảo mật Dashboard - Hiểu Con Từ Gốc</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
            <style>
                body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
            </style>
        </head>
        <body class="min-h-screen flex items-center justify-center p-6">
            <div class="bg-white border border-solid border-slate-200 max-w-md w-full rounded-2xl shadow-lg p-8 text-center">
                <div class="text-4xl mb-4">📊</div>
                <h2 class="text-lg font-bold text-slate-800 mb-2 uppercase tracking-wide">Xác thực bảo mật Dashboard</h2>
                <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                    Hệ thống dữ liệu báo cáo được bảo mật. Vui lòng nhập mật khẩu quản trị để truy cập:
                </p>
                <form method="POST" class="space-y-4">
                    <?php if (!empty($auth_error)): ?>
                        <div class="bg-red-50 border border-solid border-red-100 text-red-700 p-3 rounded-xl text-xs text-left">
                            ⚠️ <?php echo esc_html($auth_error); ?>
                        </div>
                    <?php endif; ?>
                    <input type="password" name="hieucon_dashboard_pass" placeholder="Nhập mật khẩu..." required 
                           class="w-full px-4 py-2.5 border border-solid border-slate-200 rounded-xl text-sm outline-none focus:border-brand-500 transition-all text-center">
                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md transition-all">
                        Đăng nhập Dashboard
                    </button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    hieucon_ndsk_render_dashboard();
}

// 10. Dashboard Page Renderer
function hieucon_ndsk_render_dashboard() {

global $wpdb;
$table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
$rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC") ?: [];

// Mock Data Generator for NDSK
if (!function_exists('hieucon_ndsk_generate_mock_data')) {
    function hieucon_ndsk_generate_mock_data() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'hieucon_ndsk_checklists';
        $wpdb->query("TRUNCATE TABLE $table_name");
        
        $first_names = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Phan', 'Vũ', 'Đặng', 'Bùi', 'Đỗ'];
        $middle_names = ['Gia', 'Minh', 'Anh', 'Bảo', 'Khánh', 'Nhật', 'Đức', 'Hữu', 'Quốc', 'Thị'];
        $boy_last_names = ['Khang', 'Nam', 'Kiệt', 'Lâm', 'Bách', 'Huy', 'Tùng', 'Phong', 'Sơn', 'Phúc'];
        $girl_last_names = ['An', 'Vy', 'Trúc', 'Linh', 'Hà', 'Phương', 'Mai', 'Yến', 'Lan', 'Chi'];
        
        $ages = ['2 tuổi', '3 tuổi', '4 tuổi', '5 tuổi', '6 tuổi', '18 tháng', '30 tháng', '42 tháng'];
        $concerns = [
            'Con chậm nói, hay cáu gắt và ăn vạ kéo dài.',
            'Con kén ăn, tiêu hóa kém, hay bị táo bón và chậm tăng cân.',
            'Con ngủ không ngon giấc, hay giật mình khóc đêm.',
            'Con quá nghịch ngợm, không chịu ngồi yên một chỗ, hay leo trèo nguy hiểm.',
            'Con nhạy cảm với tiếng ồn lớn, hay che tai lại và sợ đám đông.'
        ];
        
        $uas = [
            'Mozilla/5.0 (iPhone; CPU iPhone OS 16_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBAV;FBAV/410.0.0.28.113;]',
            'Mozilla/5.0 (Linux; Android 13; SM-S908B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36',
            'Mozilla/5.0 (Linux; Android 12; KB2003) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36 Zalo/23.05.01',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Safari/605.1.15'
        ];
        
        $utm_sources = ['facebook', 'zalo', 'google', '', 'zalo_ads', 'fb_messenger'];
        $referrers = ['https://facebook.com/', 'https://zalo.me/', 'https://google.com.vn/', ''];
        $cities = ['Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng', 'Bình Dương'];
        
        $known_groups = [
            'tieuHoa' => 'Rối loạn tiêu hóa',
            'anUong' => 'Rối loạn ăn uống',
            'giacNgu' => 'Rối loạn giấc ngủ',
            'camGiac' => 'Xử lý giác quan',
            'tangDong' => 'Tăng động - Giảm chú ý',
            'camXuc' => 'Cảm xúc - Hành vi',
            'mienDich' => 'Miễn dịch - Dị ứng',
            'vanDong' => 'Chức năng vận động'
        ];
        
        $group_items = [
            'tieuHoa' => [
                'Trẻ thường xuyên xì hơi nặng mùi hoặc hơi thở hôi dù đã vệ sinh răng miệng?',
                'Trẻ hay đầy bụng, chướng bụng, sôi bụng hoặc ợ chua sau ăn?',
                'Trẻ đi ngoài không đều, phân lỏng, sống, có bọt hoặc mùi bất thường?',
                'Trẻ táo bón kéo dài, đau khi đi vệ sinh, són phân hoặc né tránh đi vệ sinh?',
                'Trẻ có dấu hiệu đau bụng dữ dội như ôm bụng, cong người, khóc nhiều hoặc đập bụng vào vật cứng?'
            ],
            'anUong' => [
                'Trẻ chỉ chấp nhận một số rất ít món ăn quen thuộc?',
                'Trẻ rất nhạy với mùi, màu, vị hoặc kết cấu thức ăn?',
                'Trẻ hay ngậm lâu, không nhai, nhai nuốt kém, buồn nôn hoặc oẹ khi gặp món lạ?',
                'Chế độ ăn kém đa dạng khiến con chậm tăng cân, sụt cân, mệt mỏi hoặc có các dấu hiệu thiếu vi chất?',
                'Trẻ ăn/nhai vật không phải thức ăn hoặc bùng nổ dữ dội khi bị ép ăn?'
            ],
            'giacNgu' => [
                'Trẻ khó vào giấc, trằn trọc, cần hơn 60 phút mới ngủ được?',
                'Trẻ phải có điều kiện đặc biệt mới ngủ, như ôm chặt, tiếng ồn trắng hoặc bật đèn?',
                'Trẻ thức giấc nhiều lần trong đêm và khó ngủ lại?',
                'Khi ngủ, trẻ nghiến răng, đổ mồ hôi nhiều hoặc cử động chân tay liên tục?',
                'Trẻ thường la hét hoảng loạn ban đêm hoặc thức trắng nhiều giờ giữa đêm?'
            ],
            'camGiac' => [
                'Trẻ sợ tiếng ồn, ánh sáng hoặc khó chịu với một số chất liệu quần áo?',
                'Trẻ thích cọ xát, nhìn vật xoay tròn, ngửi đồ vật hoặc tìm cảm giác mạnh (chạy, nhảy từ trên cao, thích chạm vào râu,...)',
                'Trẻ hay vấp ngã, mất thăng bằng, chạy nhảy liên tục, khó điều chỉnh lực tay, khó cầm nắm, khó viết,...?',
                'Trẻ khó nhận biết đói, đau, buồn vệ sinh hoặc tín hiệu bên trong cơ thể?',
                'Trẻ dễ bùng nổ, khó kiểm soát hành vi và cảm xúc nơi đông người, nhiều âm thanh hoặc nhiều kích thích?'
            ],
            'tangDong' => [
                'Trẻ thường không phản hồi khi được gọi, khó làm theo các hướng dẫn?',
                'Trẻ rất khó chuyển hoạt động, dễ khựng lại hoặc bùng nổ khi bị yêu cầu dừng việc đang thích?',
                'Trẻ luôn bồn chồn, di chuyển, nhún nhảy hoặc táy máy tay chân?',
                'Trẻ hay lao đi, leo trèo, nhảy từ cao hoặc làm việc nguy hiểm mà chưa kịp cân nhắc?',
                'Sau khi cố ngồi yên hoặc tập trung, trẻ cáu kỉnh, kiệt sức hoặc ngắt kết nối rõ rệt?'
            ],
            'camXuc' => [
                'Trẻ có thay đổi cảm xúc thất thường (dễ khóc, dễ cười) mà không rõ nguyên nhân?',
                'Trẻ căng thẳng, bùng nổ khi lịch trình thay đổi, không được đáp ứng nguyện vọng?',
                'Hành vi lặp lại tăng mạnh khi trẻ lo lắng hoặc áp lực?',
                'Trẻ thường la hét, khóc kéo dài và rất khó dỗ?',
                'Khi khủng hoảng, trẻ tự làm đau hoặc tấn công người khác?'
            ],
            'mienDich' => [
                'Trẻ hay hắt hơi, sổ mũi, dụi mắt/mũi, mẩn đỏ, ngứa da, có quầng thâm ở mắt?',
                'Trẻ có biểu hiện lạ sau khi ăn một số thực phẩm hoặc tiếp xúc mùi hóa chất?',
                'Trẻ hay bị viêm tai, viêm họng, viêm amidan hoặc sưng nướu lặp lại?',
                'Trẻ dễ ốm, lâu khỏi và sau ốm thường mệt mỏi kéo dài?',
                'Sau các đợt ốm hoặc dị ứng nặng, trẻ lờ đờ, mất tập trung rõ hoặc giảm kỹ năng đã có?'
            ],
            'vanDong' => [
                'Trẻ khó cài cúc, kéo khóa, cầm thìa, dùng kéo hoặc bút chì?',
                'Trẻ hay vấp ngã, va vào đồ vật hoặc đi đứng thiếu vững vàng?',
                'Trẻ nhanh mệt, cơ thể mềm yếu, hay tựa người, nằm bò ra bàn hoặc ngồi chữ W?',
                'Trẻ khó học chuỗi vận động mới như nhảy theo nhạc, đạp xe, leo cầu thang?',
                'Trẻ rất khó thực hiện chuỗi tự phục vụ như ăn uống, mặc quần áo, vệ sinh cá nhân?'
            ]
        ];
        
        for ($i = 0; $i < 50; $i++) {
            $gender = rand(0, 1) ? 'Bé trai' : 'Bé gái';
            $c_first = $first_names[array_rand($first_names)];
            $c_mid = $middle_names[array_rand($middle_names)];
            $c_last = ($gender === 'Bé trai') ? $boy_last_names[array_rand($boy_last_names)] : $girl_last_names[array_rand($girl_last_names)];
            $child_name = "$c_first $c_mid $c_last";
            
            $p_first = $first_names[array_rand($first_names)];
            $p_mid = $middle_names[array_rand($middle_names)];
            $parent_name = "$p_first $p_mid $c_last";
            
            $phone = '0' . rand(90, 99) . rand(1000000, 9999999);
            $email = strtolower($c_last) . rand(10, 99) . '@example.com';
            $user_code = 'HC' . rand(1000, 9999);
            $age = $ages[array_rand($ages)];
            
            $ua = $uas[array_rand($uas)];
            $utm = $utm_sources[array_rand($utm_sources)];
            $ref = $referrers[array_rand($referrers)];
            
            $pageviews = rand(1, 4);
            $time_on_page = rand(20, 240);
            $zalo = (rand(0, 10) > 8) ? 1 : 0;
            
            $is_completed = (rand(0, 10) < 8);
            $drop_point = $is_completed ? 'Hoàn thành 100%' : (rand(0, 1) ? 'Đang điền thông tin phụ huynh' : 'Nhóm trắc nghiệm');
            
            $da = [
                'pageviews' => $pageviews,
                'time_on_page' => $time_on_page,
                'zalo_clicks' => $zalo,
                'drop_point' => $drop_point,
                'location' => $cities[array_rand($cities)] . ', Vietnam',
                'ip' => rand(10, 250) . '.' . rand(0, 250) . '.' . rand(0, 250) . '.' . rand(1, 254),
                'utms' => $utm ? ['utm_source' => $utm, 'utm_medium' => 'cpc', 'utm_campaign' => 'mock_campaign'] : [],
                'referrer' => $ref,
                'toggles' => ['tieuHoa' => rand(0, 3), 'giacNgu' => rand(0, 3)],
                'thinkTimes' => ['tieuHoa' => rand(5, 30), 'giacNgu' => rand(5, 30), 'anUong' => rand(5, 30)],
                'activeTime' => $time_on_page * 1000
            ];
            
            $scores_json = null;
            $behaviors_json = null;
            
            if ($is_completed) {
                $scores = [];
                $behaviors = [];
                foreach ($known_groups as $gid => $gname) {
                    $ticked_items = [];
                    $score = 0;
                    if (isset($group_items[$gid])) {
                        foreach ($group_items[$gid] as $index => $item) {
                            if (rand(1, 100) <= 40) {
                                $ticked_items[] = $item;
                                $score += ($index + 1);
                            }
                        }
                    }
                    $pct = round(($score / 15) * 100);
                    $risk = $pct >= 70 ? 'Cao' : ($pct >= 40 ? 'Vừa' : 'Thấp');
                    
                    $scores[] = [
                        'id' => $gid,
                        'name' => $gname,
                        'percentage' => $pct,
                        'pct' => $pct,
                        'ticked' => $score,
                        'total' => 15,
                        'risk' => $risk,
                        'tickedItems' => $ticked_items
                    ];
                    
                    if (!empty($ticked_items)) {
                        $behaviors[$gid] = $ticked_items;
                    }
                }
                $scores_json = json_encode($scores, JSON_UNESCAPED_UNICODE);
                $behaviors_json = json_encode($behaviors, JSON_UNESCAPED_UNICODE);
            }
            
            $wpdb->insert($table_name, [
                'user_code' => $user_code,
                'child_name' => $child_name,
                'parent_name' => $parent_name,
                'parent_phone' => $phone,
                'parent_email' => $email,
                'child_age' => $age,
                'child_gender' => $gender,
                'parent_concern' => $concerns[array_rand($concerns)],
                'scores_json' => $scores_json,
                'behaviors_json' => $behaviors_json,
                'time_spent' => $time_on_page,
                'device_info' => $ua,
                'deep_analytics' => json_encode($da, JSON_UNESCAPED_UNICODE),
                'created_at' => date('Y-m-d H:i:s', time() - rand(0, 2592000))
            ]);
        }
    }
}

// Check for generate mock action
$is_local_env = (strpos(site_url(), 'localhost') !== false || strpos(site_url(), '127.0.0.1') !== false || strpos(site_url(), '.test') !== false || (defined('WP_DEBUG') && WP_DEBUG));
if (isset($_GET['generate_mock']) && $is_local_env) {
    hieucon_ndsk_generate_mock_data();
    wp_redirect(remove_query_arg('generate_mock'));
    exit;
}

// Define NDSK helper functions
if (!function_exists('hieucon_ndsk_parse_device_details')) {
    function hieucon_ndsk_parse_device_details($ua) {
        if (empty($ua)) {
            return ['type' => 'Khác', 'os' => 'Khác', 'browser' => 'Khác', 'icon' => 'help-circle', 'full' => 'Không rõ thiết bị'];
        }
        $type = 'Máy tính';
        if (preg_match('/mobile|phone|ipod/i', $ua)) {
            $type = 'Điện thoại';
        }
        if (preg_match('/ipad|tablet|playbook|silk/i', $ua) || (preg_match('/android/i', $ua) && !preg_match('/mobile/i', $ua))) {
            $type = 'Máy tính bảng';
        }
        $os = 'Khác';
        if (preg_match('/iphone/i', $ua)) {
            $os = 'iPhone'; $type = 'Điện thoại';
        } elseif (preg_match('/ipad/i', $ua)) {
            $os = 'iPad'; $type = 'Máy tính bảng';
        } elseif (preg_match('/android/i', $ua)) {
            $os = 'Android';
        } elseif (preg_match('/macintosh|mac os x/i', $ua)) {
            $os = 'Mac';
        } elseif (preg_match('/windows|win32/i', $ua)) {
            $os = 'Windows';
        }
        $browser = 'Khác';
        if (preg_match('/Zalo/i', $ua)) {
            $browser = 'Zalo App';
        } elseif (preg_match('/FBAV|FBAN|FB_IAB/i', $ua)) {
            $browser = 'Facebook App';
        } elseif (preg_match('/Chrome|CriOS/i', $ua)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Safari/i', $ua) && !preg_match('/Chrome|CriOS/i', $ua)) {
            $browser = 'Safari';
        }
        $icon = $type === 'Điện thoại' ? 'smartphone' : ($type === 'Máy tính bảng' ? 'tablet' : 'monitor');
        return ['type' => $type, 'os' => $os, 'browser' => $browser, 'icon' => $icon, 'full' => "$type ($os - $browser)"];
    }
}

if (!function_exists('hieucon_ndsk_get_hesitation_details')) {
    function hieucon_ndsk_get_hesitation_details($da, $known_groups) {
        $toggles = $da['toggles'] ?? [];
        $think_times = $da['thinkTimes'] ?? [];
        $total_toggles = 0;
        $most_toggled_item = '';
        $max_toggles = 0;
        if (is_array($toggles)) {
            foreach ($toggles as $item => $count) {
                $cnt = intval($count);
                $total_toggles += $cnt;
                if ($cnt > $max_toggles) { $max_toggles = $cnt; $most_toggled_item = $item; }
            }
        }
        $longest_think_group = '';
        $longest_think_time = 0;
        if (is_array($think_times)) {
            foreach ($think_times as $group_key => $seconds) {
                $sec = intval($seconds);
                if ($sec > $longest_think_time) {
                    $longest_think_time = $sec;
                    $longest_think_group = $known_groups[$group_key] ?? $group_key;
                }
            }
        }
        return ['total_toggles' => $total_toggles, 'most_toggled_item' => $most_toggled_item, 'longest_think_group' => $longest_think_group, 'longest_think_time' => $longest_think_time];
    }
}

if (!function_exists('hieucon_ndsk_get_traffic_source')) {
    function hieucon_ndsk_get_traffic_source($da) {
        $utm_source = !empty($da['utms']['utm_source']) ? strtolower($da['utms']['utm_source']) : '';
        if (!empty($utm_source)) {
            if (strpos($utm_source, 'zalo') !== false) return 'Zalo Ads/Message';
            if (strpos($utm_source, 'facebook') !== false || strpos($utm_source, 'fb') !== false) return 'Facebook Ads/Post';
            if (strpos($utm_source, 'google') !== false || strpos($utm_source, 'gg') !== false) return 'Google Ads/Search';
            return ucfirst($utm_source);
        }
        $ref = !empty($da['referrer']) ? strtolower($da['referrer']) : '';
        if (!empty($ref)) {
            if (strpos($ref, 'zalo.me') !== false) return 'Zalo App';
            if (strpos($ref, 'facebook.com') !== false || strpos($ref, 'm.facebook.com') !== false) return 'Facebook App';
            if (strpos($ref, 'google.com') !== false) return 'SEO Google';
            $parsed = parse_url($ref);
            return !empty($parsed['host']) ? $parsed['host'] : 'Web Referrer';
        }
        return 'Direct (Trực tiếp)';
    }
}

if (!function_exists('hieucon_ndsk_get_lead_quality')) {
    function hieucon_ndsk_get_lead_quality($r, $da) {
        $time_on_page = intval($da['time_on_page'] ?? 0);
        $zalo_clicks = intval($da['zalo_clicks'] ?? 0);
        $is_completed = !empty($r->scores_json);
        if ($zalo_clicks > 0 || ($is_completed && $time_on_page >= 180)) {
            return ['level' => 'Hot Lead', 'bg' => 'bg-red-50 text-red-700 border-red-200', 'icon' => 'zap', 'desc' => 'Tương tác rất cao.'];
        }
        if ($is_completed) {
            return ['level' => 'Tiềm năng', 'bg' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'icon' => 'check-circle', 'desc' => 'Khảo sát hoàn thành.'];
        }
        if ($time_on_page >= 60) {
            return ['level' => 'Đang tìm hiểu', 'bg' => 'bg-amber-50 text-amber-700 border-amber-200', 'icon' => 'clock', 'desc' => 'Đọc trang trên 1 phút.'];
        }
        return ['level' => 'Lướt qua', 'bg' => 'bg-slate-50 text-slate-500 border-slate-200', 'icon' => 'slash', 'desc' => 'Thoát trang nhanh.'];
    }
}

if (!function_exists('hieucon_ndsk_calculate_5_layer_insights')) {
    function hieucon_ndsk_calculate_5_layer_insights($rows, $known_groups, $group_items) {
        $completed_rows = [];
        foreach ($rows as $r) {
            if (!empty($r->scores_json)) {
                $completed_rows[] = $r;
            }
        }
        
        $N = count($completed_rows);
        if ($N === 0) {
            return [
                'macro' => [
                    'total_responses' => 0,
                    'avg_micro_pss' => 0,
                    'avg_seoi' => 0,
                    'avg_rri' => 0,
                    'high_rri_pct' => 0,
                ],
                'top_spi' => [],
                'correlation_matrix' => [],
                'dominos' => [],
                'age_distribution' => [],
                'progress' => ['improved_pct' => 0, 'worsened_pct' => 0, 'stable_pct' => 0, 'repeat_count' => 0],
                'psychology_distribution' => [
                    'Mẹ Kiệt Sức' => 45,
                    'Mẹ Hoảng Loạn' => 35,
                    'Mẹ Mất Hướng' => 20
                ]
            ];
        }
        
        $individual_metrics = [];
        $users_history = [];
        
        foreach ($completed_rows as $r) {
            $behaviors = !empty($r->behaviors_json) ? json_decode($r->behaviors_json, true) : [];
            if (!is_array($behaviors)) $behaviors = [];
            
            $group_scores = [];
            $micro_pss = 0;
            foreach ($known_groups as $gid => $gname) {
                $score = 0;
                $ticked_items = $behaviors[$gid] ?? [];
                if (isset($group_items[$gid])) {
                    foreach ($group_items[$gid] as $idx => $sym) {
                        if (in_array($sym, $ticked_items)) {
                            $score += ($idx + 1);
                        }
                    }
                }
                $group_scores[$gid] = $score;
                $micro_pss += $score;
            }
            
            $seoi_numerator = ($group_scores['camGiac'] ?? 0) + ($group_scores['camXuc'] ?? 0) + ($group_scores['giacNgu'] ?? 0);
            $seoi = ($seoi_numerator / 45) * 100;
            
            $x_md5 = 0;
            $md_symptoms = $behaviors['mienDich'] ?? [];
            if (isset($group_items['mienDich'][4]) && in_array($group_items['mienDich'][4], $md_symptoms)) {
                $x_md5 = 1;
            }
            
            $x_gn5 = 0;
            $gn_symptoms = $behaviors['giacNgu'] ?? [];
            if (isset($group_items['giacNgu'][4]) && in_array($group_items['giacNgu'][4], $gn_symptoms)) {
                $x_gn5 = 1;
            }
            
            $x_th4 = 0;
            $th_symptoms = $behaviors['tieuHoa'] ?? [];
            if (isset($group_items['tieuHoa'][3]) && in_array($group_items['tieuHoa'][3], $th_symptoms)) {
                $x_th4 = 1;
            }
            
            $rri = ((5 * $x_md5) + (5 * $x_gn5) + (4 * $x_th4)) / 14 * 100;
            
            $phone = trim($r->parent_phone);
            $email = trim($r->parent_email);
            $user_key = !empty($phone) ? $phone : (!empty($email) ? $email : $r->user_code);
            
            $individual_metrics[$r->id] = [
                'id' => $r->id,
                'micro_pss' => $micro_pss,
                'seoi' => $seoi,
                'rri' => $rri,
                'age_str' => $r->child_age,
                'gender' => $r->child_gender,
                'group_scores' => $group_scores,
                'user_key' => $user_key,
                'created_at' => $r->created_at
            ];
            
            if (!empty($user_key)) {
                $users_history[$user_key][] = [
                    'id' => $r->id,
                    'micro_pss' => $micro_pss,
                    'created_at' => strtotime($r->created_at)
                ];
            }
        }
        
        $improved = 0;
        $worsened = 0;
        $stable = 0;
        $repeat_count = 0;
        foreach ($users_history as $key => $history) {
            if (count($history) >= 2) {
                usort($history, function($a, $b) { return $a['created_at'] - $b['created_at']; });
                $t0 = $history[0]['micro_pss'];
                $t1 = $history[count($history) - 1]['micro_pss'];
                $delta = $t0 - $t1;
                if ($delta > 0) $improved++;
                elseif ($delta < 0) $worsened++;
                else $stable++;
                $repeat_count++;
            }
        }
        $improved_pct = $repeat_count > 0 ? round(($improved / $repeat_count) * 100) : 0;
        $worsened_pct = $repeat_count > 0 ? round(($worsened / $repeat_count) * 100) : 0;
        $stable_pct = $repeat_count > 0 ? round(($stable / $repeat_count) * 100) : 0;
        
        $total_micro_pss = 0;
        $total_seoi = 0;
        $total_rri = 0;
        $high_rri_count = 0;
        
        $age_groups = [
            '0-3t' => ['count' => 0, 'total_rri' => 0, 'high_rri' => 0],
            '4-6t' => ['count' => 0, 'total_rri' => 0, 'high_rri' => 0],
            '>6t'  => ['count' => 0, 'total_rri' => 0, 'high_rri' => 0]
        ];
        
        $keys = array_keys($known_groups);
        $axis_counts = [];
        for ($i = 0; $i < count($keys); $i++) {
            for ($j = $i + 1; $j < count($keys); $j++) {
                $axis_counts[$keys[$i] . '_' . $keys[$j]] = 0;
            }
        }
        
        $domino_chains = [
            'DOMINO_01' => ['name' => 'Tiêu Hóa -> Giấc Ngủ -> Cảm Xúc', 'groups' => ['tieuHoa', 'giacNgu', 'camXuc'], 'count' => 0],
            'DOMINO_02' => ['name' => 'Giác Quan -> Ăn Uống -> Miễn Dịch', 'groups' => ['camGiac', 'anUong', 'mienDich'], 'count' => 0],
            'DOMINO_03' => ['name' => 'Miễn Dịch -> Tăng Động -> Vận Động', 'groups' => ['mienDich', 'tangDong', 'vanDong'], 'count' => 0],
            'DOMINO_04' => ['name' => 'Vận Động -> Tăng Động -> Cảm Xúc', 'groups' => ['vanDong', 'tangDong', 'camXuc'], 'count' => 0]
        ];
        
        $spi_counts = [];
        foreach ($known_groups as $gid => $gname) {
            if (isset($group_items[$gid])) {
                foreach ($group_items[$gid] as $idx => $sym) {
                    $spi_counts[$gid . '||' . $sym] = ['count' => 0, 'weight' => ($idx + 1)];
                }
            }
        }
        
        $kiet_suc = 0;
        $hoang_loan = 0;
        $mat_huong = 0;
        foreach ($individual_metrics as $id => $met) {
            if ($met['seoi'] > 50 && $met['rri'] > 50) {
                $kiet_suc++;
            } elseif ($met['micro_pss'] > 60) {
                $hoang_loan++;
            } else {
                $mat_huong++;
            }
            $total_micro_pss += $met['micro_pss'];
            $total_seoi += $met['seoi'];
            $total_rri += $met['rri'];
            if ($met['rri'] >= 50) $high_rri_count++;
            
            $age_val = 4;
            $age_str = strtolower($met['age_str']);
            if (strpos($age_str, 'tháng') !== false) {
                preg_match('/(\d+)/', $age_str, $m);
                if (!empty($m[1])) {
                    $age_val = floatval($m[1]) / 12;
                }
            } else {
                preg_match('/(\d+)/', $age_str, $m);
                if (!empty($m[1])) {
                    $age_val = floatval($m[1]);
                }
            }
            
            if ($age_val <= 3) $age_key = '0-3t';
            elseif ($age_val <= 6) $age_key = '4-6t';
            else $age_key = '>6t';
            
            $age_groups[$age_key]['count']++;
            $age_groups[$age_key]['total_rri'] += $met['rri'];
            if ($met['rri'] >= 50) {
                $age_groups[$age_key]['high_rri']++;
            }
            
            $active_groups = [];
            foreach ($met['group_scores'] as $gid => $score) {
                if ($score >= 6) {
                    $active_groups[$gid] = true;
                }
            }
            
            for ($i = 0; $i < count($keys); $i++) {
                for ($j = $i + 1; $j < count($keys); $j++) {
                    $g1 = $keys[$i];
                    $g2 = $keys[$j];
                    if (isset($active_groups[$g1]) && isset($active_groups[$g2])) {
                        $axis_counts[$g1 . '_' . $g2]++;
                    }
                }
            }
            
            foreach ($domino_chains as $code => $chain) {
                $g1 = $chain['groups'][0];
                $g2 = $chain['groups'][1];
                $g3 = $chain['groups'][2];
                if (isset($active_groups[$g1]) && isset($active_groups[$g2]) && isset($active_groups[$g3])) {
                    $domino_chains[$code]['count']++;
                }
            }
            
            // Re-read behaviors to count spi
            $r_idx = -1;
            foreach ($completed_rows as $idx_row => $completed_r) {
                if ($completed_r->id == $id) {
                    $r_idx = $idx_row;
                    break;
                }
            }
            $r_behaviors = $r_idx !== -1 ? json_decode($completed_rows[$r_idx]->behaviors_json, true) : [];
            if (is_array($r_behaviors)) {
                foreach ($r_behaviors as $gid => $items) {
                    if (is_array($items)) {
                        foreach ($items as $sym) {
                            $sym = trim($sym);
                            if (isset($spi_counts[$gid . '||' . $sym])) {
                                $spi_counts[$gid . '||' . $sym]['count']++;
                            }
                        }
                    }
                }
            }
        }
        
        $kiet_suc_pct = $N > 0 ? round(($kiet_suc / $N) * 100) : 45;
        $hoang_loan_pct = $N > 0 ? round(($hoang_loan / $N) * 100) : 35;
        $mat_huong_pct = $N > 0 ? round(($mat_huong / $N) * 100) : 20;
        
        $spi_ranking = [];
        foreach ($spi_counts as $key => $data) {
            list($gid, $sym) = explode('||', $key);
            $p = ($data['count'] / $N) * 100;
            $spi = ($p * $data['weight']) / 100;
            $spi_ranking[] = [
                'gid' => $gid,
                'symptom' => $sym,
                'frequency_pct' => round($p, 1),
                'weight' => $data['weight'],
                'spi_score' => round($spi, 2)
            ];
        }
        usort($spi_ranking, function($a, $b) {
            return ($b['spi_score'] > $a['spi_score']) ? 1 : -1;
        });
        $top_spi = array_slice($spi_ranking, 0, 5);
        
        $correlation_matrix = [];
        foreach ($axis_counts as $pair => $count) {
            list($g1, $g2) = explode('_', $pair);
            $rate = ($count / $N) * 100;
            $correlation_matrix[$g1][$g2] = round($rate, 1);
            $correlation_matrix[$g2][$g1] = round($rate, 1);
        }
        
        $dominos_formatted = [];
        foreach ($domino_chains as $code => $chain) {
            $rate = ($chain['count'] / $N) * 100;
            $dominos_formatted[$code] = [
                'name' => $chain['name'],
                'rate' => round($rate, 1),
                'count' => $chain['count']
            ];
        }
        
        $age_formatted = [];
        foreach ($age_groups as $key => $data) {
            $avg_rri = $data['count'] > 0 ? round($data['total_rri'] / $data['count']) : 0;
            $high_rri_pct = $data['count'] > 0 ? round(($data['high_rri'] / $data['count']) * 100) : 0;
            $age_formatted[$key] = [
                'count' => $data['count'],
                'avg_rri' => $avg_rri,
                'high_rri_pct' => $high_rri_pct
            ];
        }
        
        return [
            'macro' => [
                'total_responses' => $N,
                'avg_micro_pss' => round($total_micro_pss / $N, 1),
                'avg_seoi' => round($total_seoi / $N),
                'avg_rri' => round($total_rri / $N),
                'high_rri_pct' => round(($high_rri_count / $N) * 100, 1),
            ],
            'top_spi' => $top_spi,
            'correlation_matrix' => $correlation_matrix,
            'dominos' => $dominos_formatted,
            'age_distribution' => $age_formatted,
            'progress' => [
                'improved_pct' => $improved_pct,
                'worsened_pct' => $worsened_pct,
                'stable_pct' => $stable_pct,
                'repeat_count' => $repeat_count
            ],
            'psychology_distribution' => [
                'Mẹ Kiệt Sức' => $kiet_suc_pct,
                'Mẹ Hoảng Loạn' => $hoang_loan_pct,
                'Mẹ Mất Hướng' => $mat_huong_pct
            ]
        ];
    }
}

$known_groups = [
    'tieuHoa' => 'Rối loạn tiêu hóa',
    'anUong' => 'Rối loạn ăn uống',
    'giacNgu' => 'Rối loạn giấc ngủ',
    'camGiac' => 'Xử lý giác quan',
    'tangDong' => 'Tăng động - Giảm chú ý',
    'camXuc' => 'Cảm xúc - Hành vi',
    'mienDich' => 'Miễn dịch - Dị ứng',
    'vanDong' => 'Chức năng vận động'
];

// Compute statistics
$total_surveys = count($rows);
$total_views = 0;
$total_time_on_page = 0;
$total_zalo_clicks = 0;
$drop_off_stats = ['start' => 0, 'survey' => 0, 'contact' => 0, 'completed' => 0];
$stat_types = ['Điện thoại' => 0, 'Máy tính' => 0, 'Máy tính bảng' => 0, 'Khác' => 0];
$stat_oss = ['iPhone' => 0, 'Android' => 0, 'Mac' => 0, 'Windows' => 0, 'Linux' => 0, 'iPad' => 0, 'Khác' => 0];
$stat_browsers = ['Chrome' => 0, 'Safari' => 0, 'Zalo App' => 0, 'Facebook App' => 0, 'Cốc Cốc' => 0, 'Edge' => 0, 'Brave' => 0, 'Khác' => 0];
$stat_sources = [];
$stat_leads = ['Hot Lead' => 0, 'Tiềm năng' => 0, 'Đang tìm hiểu' => 0, 'Lướt qua' => 0];

$today_date = date('Y-m-d');
$today_hourly_views = array_fill(0, 12, 0);
$today_hourly_submissions = array_fill(0, 12, 0);
$today_hourly_conversions = array_fill(0, 12, 0);
$today_hourly_labels = ['00-02h', '02-04h', '04-06h', '06-08h', '08-10h', '10-12h', '12-14h', '14-16h', '16-18h', '18-20h', '20-22h', '22-24h'];

$dau_ips = [];
$wau_ips = [];
$mau_ips = [];
$today_ts = strtotime(date('Y-m-d'));
$seven_days_ago_ts = strtotime('-7 days');
$thirty_days_ago_ts = strtotime('-30 days');

$countries = ['Việt Nam' => 0, 'Khác' => 0];
$cities = ['Hồ Chí Minh' => 0, 'Hà Nội' => 0, 'Đà Nẵng' => 0, 'Cần Thơ' => 0, 'Bình Dương' => 0, 'Khác' => 0];

$group_items = [
    'tieuHoa' => [
        'Trẻ thường xuyên xì hơi nặng mùi hoặc hơi thở hôi dù đã vệ sinh răng miệng?',
        'Trẻ hay đầy bụng, chướng bụng, sôi bụng hoặc ợ chua sau ăn?',
        'Trẻ đi ngoài không đều, phân lỏng, sống, có bọt hoặc mùi bất thường?',
        'Trẻ táo bón kéo dài, đau khi đi vệ sinh, són phân hoặc né tránh đi vệ sinh?',
        'Trẻ có dấu hiệu đau bụng dữ dội như ôm bụng, cong người, khóc nhiều hoặc đập bụng vào vật cứng?'
    ],
    'anUong' => [
        'Trẻ chỉ chấp nhận một số rất ít món ăn quen thuộc?',
        'Trẻ rất nhạy với mùi, màu, vị hoặc kết cấu thức ăn?',
        'Trẻ hay ngậm lâu, không nhai, nhai nuốt kém, buồn nôn hoặc oẹ khi gặp món lạ?',
        'Chế độ ăn kém đa dạng khiến con chậm tăng cân, sụt cân, mệt mỏi hoặc có các dấu hiệu thiếu vi chất?',
        'Trẻ ăn/nhai vật không phải thức ăn hoặc bùng nổ dữ dội khi bị ép ăn?'
    ],
    'giacNgu' => [
        'Trẻ khó vào giấc, trằn trọc, cần hơn 60 phút mới ngủ được?',
        'Trẻ phải có điều kiện đặc biệt mới ngủ, như ôm chặt, tiếng ồn trắng hoặc bật đèn?',
        'Trẻ thức giấc nhiều lần trong đêm và khó ngủ lại?',
        'Khi ngủ, trẻ nghiến răng, đổ mồ hôi nhiều hoặc cử động chân tay liên tục?',
        'Trẻ thường la hét hoảng loạn ban đêm hoặc thức trắng nhiều giờ giữa đêm?'
    ],
    'camGiac' => [
        'Trẻ sợ tiếng ồn, ánh sáng hoặc khó chịu với một số chất liệu quần áo?',
        'Trẻ thích cọ xát, nhìn vật xoay tròn, ngửi đồ vật hoặc tìm cảm giác mạnh (chạy, nhảy từ trên cao, thích chạm vào râu,...)',
        'Trẻ hay vấp ngã, mất thăng bằng, chạy nhảy liên tục, khó điều chỉnh lực tay, khó cầm nắm, khó viết,...?',
        'Trẻ khó nhận biết đói, đau, buồn vệ sinh hoặc tín hiệu bên trong cơ thể?',
        'Trẻ dễ bùng nổ, khó kiểm soát hành vi và cảm xúc nơi đông người, nhiều âm thanh hoặc nhiều kích thích?'
    ],
    'tangDong' => [
        'Trẻ thường không phản hồi khi được gọi, khó làm theo các hướng dẫn?',
        'Trẻ rất khó chuyển hoạt động, dễ khựng lại hoặc bùng nổ khi bị yêu cầu dừng việc đang thích?',
        'Trẻ luôn bồn chồn, di chuyển, nhún nhảy hoặc táy máy tay chân?',
        'Trẻ hay lao đi, leo trèo, nhảy từ cao hoặc làm việc nguy hiểm mà chưa kịp cân nhắc?',
        'Sau khi cố ngồi yên hoặc tập trung, trẻ cáu kỉnh, kiệt sức hoặc ngắt kết nối rõ rệt?'
    ],
    'camXuc' => [
        'Trẻ có thay đổi cảm xúc thất thường (dễ khóc, dễ cười) mà không rõ nguyên nhân?',
        'Trẻ căng thẳng, bùng nổ khi lịch trình thay đổi, không được đáp ứng nguyện vọng?',
        'Hành vi lặp lại tăng mạnh khi trẻ lo lắng hoặc áp lực?',
        'Trẻ thường la hét, khóc kéo dài và rất khó dỗ?',
        'Khi khủng hoảng, trẻ tự làm đau hoặc tấn công người khác?'
    ],
    'mienDich' => [
        'Trẻ hay hắt hơi, sổ mũi, dụi mắt/mũi, mẩn đỏ, ngứa da, có quầng thâm ở mắt?',
        'Trẻ có biểu hiện lạ sau khi ăn một số thực phẩm hoặc tiếp xúc mùi hóa chất?',
        'Trẻ hay bị viêm tai, viêm họng, viêm amidan hoặc sưng nướu lặp lại?',
        'Trẻ dễ ốm, lâu khỏi và sau ốm thường mệt mỏi kéo dài?',
        'Sau các đợt ốm hoặc dị ứng nặng, trẻ lờ đờ, mất tập trung rõ hoặc giảm kỹ năng đã có?'
    ],
    'vanDong' => [
        'Trẻ khó cài cúc, kéo khóa, cầm thìa, dùng kéo hoặc bút chì?',
        'Trẻ hay vấp ngã, va vào đồ vật hoặc đi đứng thiếu vững vàng?',
        'Trẻ nhanh mệt, cơ thể mềm yếu, hay tựa người, nằm bò ra bàn hoặc ngồi chữ W?',
        'Trẻ khó học chuỗi vận động mới như nhảy theo nhạc, đạp xe, leo cầu thang?',
        'Trẻ rất khó thực hiện chuỗi tự phục vụ như ăn uống, mặc quần áo, vệ sinh cá nhân?'
    ]
];

$group_prevalence = [];
foreach ($known_groups as $key => $name) {
    $symptom_defaults = [];
    if (isset($group_items[$key])) {
        foreach ($group_items[$key] as $sym) {
            $symptom_defaults[trim($sym)] = 0;
        }
    }
    $group_prevalence[$key] = [
        'name' => $name, 'count' => 0, 'total_pct' => 0, 'high_risk' => 0, 'med_risk' => 0, 'low_risk' => 0,
        'avg_pct' => 0, 'high_pct' => 0, 'med_pct' => 0, 'low_pct' => 0, 'symptoms' => $symptom_defaults
    ];
}
$completed_count = 0;

foreach ($rows as $r) {
    $da = !empty($r->deep_analytics) ? json_decode($r->deep_analytics, true) : [];
    $ip = $da['ip'] ?? '';
    if (empty($ip)) {
        $ip = $r->user_code;
    }
    
    // Time-based active user statistics & hourly stats
    $r_ts = strtotime($r->created_at);
    $r_date = date('Y-m-d', $r_ts);
    
    if ($r_date === $today_date) {
        $dau_ips[$ip] = true;
        $hour = intval(date('H', $r_ts));
        $bin = min(11, floor($hour / 2));
        $today_hourly_views[$bin] += intval($da['pageviews'] ?? 1);
        $today_hourly_submissions[$bin]++;
        if (!empty($r->scores_json)) {
            $today_hourly_conversions[$bin]++;
        }
    }
    if ($r_ts >= $seven_days_ago_ts) {
        $wau_ips[$ip] = true;
    }
    if ($r_ts >= $thirty_days_ago_ts) {
        $mau_ips[$ip] = true;
    }
    
    // Country & Location parsing
    $loc = !empty($da['location']) ? $da['location'] : '';
    if (!empty($loc)) {
        if (strpos(strtolower($loc), 'vietnam') !== false || strpos(strtolower($loc), 'việt nam') !== false) {
            $countries['Việt Nam']++;
            $matched_city = false;
            foreach (['Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'Cần Thơ', 'Bình Dương'] as $c) {
                if (strpos(strtolower($loc), strtolower($c)) !== false) {
                    $cities[$c]++; $matched_city = true; break;
                }
            }
            if (!$matched_city) $cities['Khác']++;
        } else {
            $countries['Khác']++;
            $cities['Khác']++;
        }
    } else {
        $countries['Việt Nam']++;
        $cities['Khác']++;
    }

    if (is_array($da)) {
        $total_views += intval($da['pageviews'] ?? 0);
        $total_time_on_page += intval($da['time_on_page'] ?? 0);
        $total_zalo_clicks += intval($da['zalo_clicks'] ?? 0);
        
        $dp = $da['drop_point'] ?? 'Chưa bắt đầu';
        if ($dp === 'Hoàn thành 100%') $drop_off_stats['completed']++;
        elseif ($dp === 'Đang điền thông tin phụ huynh') $drop_off_stats['contact']++;
        elseif (strpos($dp, 'Nhóm') !== false) $drop_off_stats['survey']++;
        else $drop_off_stats['start']++;
    } else {
        $drop_off_stats['start']++;
    }
    
    $dev = hieucon_ndsk_parse_device_details($r->device_info);
    $stat_types[$dev['type']] = ($stat_types[$dev['type']] ?? 0) + 1;
    $stat_oss[$dev['os']] = ($stat_oss[$dev['os']] ?? 0) + 1;
    $stat_browsers[$dev['browser']] = ($stat_browsers[$dev['browser']] ?? 0) + 1;
    
    $src = hieucon_ndsk_get_traffic_source($da);
    $stat_sources[$src] = ($stat_sources[$src] ?? 0) + 1;
    
    $lq = hieucon_ndsk_get_lead_quality($r, $da);
    $stat_leads[$lq['level']]++;
    
    if (!empty($r->scores_json)) {
        $scores = json_decode($r->scores_json, true);
        if (is_array($scores)) {
            $completed_count++;
            foreach ($scores as $s) {
                $gid = $s['id'] ?? '';
                if (empty($gid)) continue;
                $match_key = isset($known_groups[$gid]) ? $gid : '';
                if (empty($match_key)) {
                    foreach ($known_groups as $k => $n) {
                        if (strpos(strtolower($gid), strtolower($k)) !== false || strpos(strtolower($s['name'] ?? ''), strtolower($n)) !== false) {
                            $match_key = $k; break;
                        }
                    }
                }
                if (!empty($match_key)) {
                    $group_prevalence[$match_key]['count']++;
                    $val = isset($s['pct']) ? $s['pct'] : ($s['percentage'] ?? 0);
                    $group_prevalence[$match_key]['total_pct'] += floatval($val);
                    $risk = $s['risk'] ?? 'Thấp';
                    if (strpos(strtolower($risk), 'cao') !== false) $group_prevalence[$match_key]['high_risk']++;
                    elseif (strpos(strtolower($risk), 'vừa') !== false || strpos(strtolower($risk), 'trung') !== false) $group_prevalence[$match_key]['med_risk']++;
                    else $group_prevalence[$match_key]['low_risk']++;
                }
            }
        }
    }
    
    if (!empty($r->behaviors_json)) {
        $behaviors = json_decode($r->behaviors_json, true);
        if (is_array($behaviors)) {
            foreach ($behaviors as $gid => $items) {
                if (is_array($items)) {
                    $match_key = isset($known_groups[$gid]) ? $gid : '';
                    if (empty($match_key)) {
                        foreach ($known_groups as $k => $n) {
                            if (strpos(strtolower($gid), strtolower($k)) !== false) { $match_key = $k; break; }
                        }
                    }
                    if (!empty($match_key)) {
                        foreach ($items as $item) {
                            $item = trim($item);
                            if (empty($item)) continue;
                            $group_prevalence[$match_key]['symptoms'][$item] = ($group_prevalence[$match_key]['symptoms'][$item] ?? 0) + 1;
                        }
                    }
                }
            }
        }
    }
}

$top_high_risk_groups = [];
$top_symptoms = [];
foreach ($group_prevalence as $k => $g) {
    $c = $g['count'];
    if ($c > 0) {
        $group_prevalence[$k]['avg_pct'] = round($g['total_pct'] / $c);
        $group_prevalence[$k]['high_pct'] = round(($g['high_risk'] / $c) * 100);
        $group_prevalence[$k]['med_pct'] = round(($g['med_risk'] / $c) * 100);
        $group_prevalence[$k]['low_pct'] = round(($g['low_risk'] / $c) * 100);
        $top_high_risk_groups[$g['name']] = $group_prevalence[$k]['high_pct'];
    }
    if (!empty($g['symptoms'])) {
        arsort($group_prevalence[$k]['symptoms']);
        foreach ($g['symptoms'] as $symName => $symFreq) {
            $top_symptoms[$symName] = ($top_symptoms[$symName] ?? 0) + $symFreq;
        }
    }
}
arsort($top_high_risk_groups);
arsort($top_symptoms);
$highest_risk_group_name = !empty($top_high_risk_groups) ? key($top_high_risk_groups) : '';
$highest_risk_group_pct = !empty($top_high_risk_groups) ? current($top_high_risk_groups) : 0;
$most_common_symptom_name = !empty($top_symptoms) ? key($top_symptoms) : '';
$most_common_symptom_count = !empty($top_symptoms) ? current($top_symptoms) : 0;
$insights = hieucon_ndsk_calculate_5_layer_insights($rows, $known_groups, $group_items);

$avg_time_secs = $total_views > 0 ? round($total_time_on_page / $total_views) : 0;
$avg_time_formatted = $avg_time_secs < 60 ? $avg_time_secs . 's' : floor($avg_time_secs / 60) . 'm ' . ($avg_time_secs % 60) . 's';

$dau = count($dau_ips);
$wau = count($wau_ips);
$mau = count($mau_ips);

$dau_visitors = $dau;
$wau_visitors = $wau;
$mau_visitors = $mau;

$live_ips = [];
foreach ($rows as $r) {
    if (strtotime($r->created_at) >= (time() - 300)) {
        $da = !empty($r->deep_analytics) ? json_decode($r->deep_analytics, true) : [];
        $ip = $da['ip'] ?? $r->user_code;
        $live_ips[$ip] = true;
    }
}
$live_visitors_raw = count($live_ips);
$live_count = $live_visitors_raw;

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Phân Tích & Đo Lường (NDSK) - Hiểu Con Từ Gốc</title>
    <!-- Tailwind CSS & Lucide Icons CDNs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f2f7ff', 100: '#dde9ff', 200: '#c2d6ff', 300: '#9cb9ff',
                            400: '#7592ff', 500: '#465fff', 600: '#3641f5', 700: '#2a31d8',
                            800: '#252dae', 900: '#262e89',
                        }
                    },
                    fontFamily: { outfit: ['Outfit', 'sans-serif'], jakarta: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .lucide { display: inline-block; width: 16px; height: 16px; stroke-width: 2.5px; vertical-align: -2px; }
        
        /* CSS Tooltips */
        .tooltip { position: relative; display: inline-flex; align-items: center; }
        .tooltip .tooltiptext {
            visibility: hidden; width: 220px; background-color: #0f172a; color: #fff; text-align: left;
            border-radius: 8px; padding: 10px 12px; position: absolute; z-index: 50; bottom: 130%; left: 50%;
            margin-left: -110px; opacity: 0; transition: opacity 0.2s; font-size: 10px; line-height: 1.4;
            font-weight: 500; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.2); pointer-events: none; text-transform: none;
        }
        .tooltip .tooltiptext::after {
            content: ""; position: absolute; top: 100%; left: 50%; margin-left: -5px;
            border-width: 5px; border-style: solid; border-color: #0f172a transparent transparent transparent;
        }
        .tooltip:hover .tooltiptext { visibility: visible; opacity: 1; }
    </style>
</head>
<body class="min-h-screen text-slate-800 transition-colors duration-200">

    <!-- Sidebar Layout -->
    <aside class="fixed left-0 top-0 z-40 h-screen w-[290px] border-r border-solid border-slate-200 bg-white transition-transform lg:translate-x-0 -translate-x-full" id="sidebar-drawer">
        <div class="flex items-center gap-3 px-6 py-6 border-b border-solid border-slate-100">
            <div class="bg-brand-600 p-2.5 rounded-xl text-white shadow-md shadow-brand-200">
                <i data-lucide="activity" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider m-0 font-outfit">Hiểu Con Từ Gốc</h1>
                <p class="text-[9px] text-brand-600 font-bold tracking-widest uppercase mt-0.5">NHẬN DIỆN SỨC KHỎE (NDSK)</p>
            </div>
        </div>

        <div class="px-4 py-6 space-y-6 overflow-y-auto h-[calc(100vh-80px)]">
            <div>
                <h3 class="px-4 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-3">Menu Dashboard</h3>
                <nav class="space-y-1">
                    <a href="javascript:void(0)" id="link-analytics" onclick="switchTab('analytics')" class="sidebar-link flex items-center justify-between px-4 py-3 text-xs font-semibold rounded-xl transition-all decoration-none text-brand-600 bg-brand-50/70 border-r-4 border-brand-600">
                        <span class="flex items-center gap-3">
                            <i data-lucide="bar-chart-2" class="w-4 h-4"></i>
                            <span>Tổng quan Hệ thống</span>
                        </span>
                    </a>
                    <a href="javascript:void(0)" id="link-prevalence" onclick="switchTab('prevalence')" class="sidebar-link flex items-center gap-3 px-4 py-3 text-xs font-semibold rounded-xl transition-all decoration-none text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <i data-lucide="brain" class="w-4 h-4"></i>
                        <span>Dấu hiệu Sức khỏe</span>
                    </a>
                    <a href="javascript:void(0)" id="link-submissions" onclick="switchTab('submissions')" class="sidebar-link flex items-center gap-3 px-4 py-3 text-xs font-semibold rounded-xl transition-all decoration-none text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Danh sách Hồ sơ</span>
                    </a>
                </nav>
            </div>

            <div>
                <h3 class="px-4 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-3">Hệ thống & CRM</h3>
                <nav class="space-y-1">
                    <a href="javascript:void(0)" class="flex items-center gap-3 px-4 py-3 text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-xl transition-all decoration-none">
                        <i data-lucide="contact" class="w-4 h-4 text-slate-400"></i>
                        <span>Hồ sơ CRM</span>
                    </a>
                </nav>
            </div>
        </div>
    </aside>

    <div class="fixed inset-0 z-30 bg-slate-900/40 hidden lg:hidden" id="sidebar-backdrop" onclick="toggleSidebarDrawer(false)"></div>

    <div class="lg:ml-[290px] min-h-screen flex flex-col transition-all duration-200">
        <!-- Header -->
        <header class="bg-white border-b border-solid border-slate-200 h-16 px-6 lg:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebarDrawer(true)" class="lg:hidden p-2 hover:bg-slate-50 border border-solid border-slate-200 rounded-xl text-slate-600 cursor-pointer">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="relative hidden sm:block">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4"></i>
                    <input type="text" placeholder="Tìm kiếm nhanh... (⌘ K)" class="w-64 pl-10 pr-4 py-1.5 border border-solid border-slate-200 bg-slate-50/50 rounded-xl text-xs outline-none focus:bg-white focus:border-brand-500 transition-all font-outfit" readonly>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-solid border-emerald-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Hệ thống Live
                </span>
                
                <?php if (strpos(site_url(), 'localhost') !== false || strpos(site_url(), '127.0.0.1') !== false || strpos(site_url(), '.test') !== false || (defined('WP_DEBUG') && WP_DEBUG)): ?>
                    <button onclick="confirmGenerateMock()" class="px-3 py-1.5 bg-brand-50 hover:bg-brand-100 border border-solid border-brand-100 rounded-xl text-brand-600 font-extrabold text-[10px] uppercase tracking-wider cursor-pointer transition-all flex items-center gap-1.5">
                        <i data-lucide="database" class="w-3.5 h-3.5"></i> Tạo 50 data mẫu
                    </button>
                <?php endif; ?>
                
                <button onclick="window.location.reload()" class="p-2 hover:bg-slate-50 border border-solid border-slate-200 rounded-xl text-slate-500 cursor-pointer">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                </button>
                
                <div class="flex items-center gap-3 pl-3 border-l border-solid border-slate-200">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-none">Administrator</div>
                        <div class="text-[9px] font-medium text-slate-400 mt-1 uppercase tracking-wider">Quản trị viên</div>
                    </div>
                    <img class="w-9 h-9 rounded-full object-cover border border-solid border-slate-200" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Admin Avatar">
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="p-6 md:p-8 flex-grow max-w-[1400px] w-full mx-auto box-border">
            
            <!-- TAB 1: ANALYTICS -->
            <?php $bounce = $total_views > 0 ? round((($drop_off_stats['start'] + $drop_off_stats['survey']) / $total_views) * 100) : 54; ?>
            <div id="tab-analytics" class="tab-content space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- CARD 1: TRAFFIC OVERVIEW -->
                    <div class="rounded-2xl border border-solid border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                Lưu lượng truy cập
                                <span class="tooltip">
                                    <i data-lucide="info" class="w-3.5 h-3.5 text-slate-300 hover:text-slate-500 cursor-pointer"></i>
                                    <span class="tooltiptext">Đo lường lưu lượng truy cập: Unique Visitors (số khách truy cập duy nhất theo IP trong 30 ngày), Pageviews (tổng số lượt xem trang), Avg. Time (thời gian đọc trung bình của mỗi phiên).</span>
                                </span>
                            </span>
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-slate-800 font-outfit m-0">
                                <?php echo number_format($mau); ?>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-wide">Unique Visitors</p>
                        </div>
                        <div class="grid grid-cols-2 border-t border-solid border-slate-100 pt-3 mt-4 text-[11px] font-semibold text-slate-500">
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Pageviews</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($total_views); ?></div>
                            </div>
                            <div class="border-l border-solid border-slate-100 pl-3">
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Avg. Time</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo esc_html($avg_time_formatted); ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: ACTIVE USERS -->
                    <div class="rounded-2xl border border-solid border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                Người dùng hoạt động
                                <span class="tooltip">
                                    <i data-lucide="info" class="w-3.5 h-3.5 text-slate-300 hover:text-slate-500 cursor-pointer"></i>
                                    <span class="tooltiptext">Người dùng tương tác theo thời gian: Live (số IP đang mở trang trắc nghiệm trong 5 phút qua), DAU (khách duy nhất hôm nay), WAU (khách duy nhất 7 ngày qua).</span>
                                </span>
                            </span>
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i data-lucide="activity" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                </span>
                                <h3 class="text-3xl font-extrabold text-slate-800 font-outfit m-0 leading-none"><?php echo $live_count; ?></h3>
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-wide">Live visitors</p>
                        </div>
                        <div class="grid grid-cols-2 border-t border-solid border-slate-100 pt-3 mt-4 text-[11px] font-semibold text-slate-500">
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Hôm nay (DAU)</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($dau_visitors); ?></div>
                            </div>
                            <div class="border-l border-solid border-slate-100 pl-3">
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Tuần (WAU)</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($wau_visitors); ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: MARKETING LEADS -->
                    <div class="rounded-2xl border border-solid border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                Khách hàng tiếp thị
                                <span class="tooltip">
                                    <i data-lucide="info" class="w-3.5 h-3.5 text-slate-300 hover:text-slate-500 cursor-pointer"></i>
                                    <span class="tooltiptext">Phân loại chất lượng lead: Hot Lead (đã click liên hệ Zalo hoặc làm xong trắc nghiệm và đọc kỹ trên 3 phút), Tiềm năng (đã hoàn thành trắc nghiệm), Đang tìm hiểu (đọc trang trên 1 phút), Lướt qua (thoát nhanh).</span>
                                </span>
                            </span>
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-slate-800 font-outfit m-0">
                                <?php echo number_format($stat_leads['Hot Lead'] ?? 0); ?>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-wide">Hot Leads 🔥</p>
                        </div>
                        <div class="grid grid-cols-2 border-t border-solid border-slate-100 pt-3 mt-4 text-[11px] font-semibold text-slate-500">
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Tiềm năng</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($stat_leads['Tiềm năng'] ?? 0); ?></div>
                            </div>
                            <div class="border-l border-solid border-slate-100 pl-3">
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Tìm hiểu</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($stat_leads['Đang tìm hiểu'] ?? 0); ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: CONVERSION PERFORMANCE -->
                    <div class="rounded-2xl border border-solid border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                Hiệu suất khảo sát
                                <span class="tooltip">
                                    <i data-lucide="info" class="w-3.5 h-3.5 text-slate-300 hover:text-slate-500 cursor-pointer"></i>
                                    <span class="tooltiptext">Kết quả chuyển đổi: Surveys Completed (tổng số lượt làm xong trắc nghiệm gửi đi), Tỷ lệ thoát (tỷ lệ rời đi ngay khi vừa vào trang giới thiệu), Lướt qua (số khách thoát rất nhanh).</span>
                                </span>
                            </span>
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                                <i data-lucide="check-circle" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-slate-800 font-outfit m-0">
                                <?php echo number_format($completed_count); ?>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-wide">Surveys Completed</p>
                        </div>
                        <div class="grid grid-cols-2 border-t border-solid border-slate-100 pt-3 mt-4 text-[11px] font-semibold text-slate-500">
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Tỷ lệ thoát</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo $bounce; ?>%</div>
                            </div>
                            <div class="border-l border-solid border-slate-100 pl-3">
                                <div class="text-slate-400 text-[9px] uppercase tracking-wider font-extrabold">Lướt qua</div>
                                <div class="text-xs font-bold text-slate-700 mt-0.5"><?php echo number_format($stat_leads['Lướt qua'] ?? 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 m-0">Lượt Truy Cập & Khảo Sát</h3>
                            <p class="text-[10px] text-slate-400 mt-1">Dữ liệu phân tích lưu lượng truy cập</p>
                        </div>
                        <div class="inline-flex rounded-xl bg-slate-100 p-1 border border-solid border-slate-200">
                            <button onclick="changeChartPeriod('1')" id="btn-period-1" class="px-3 py-1 text-[10px] font-bold rounded-lg transition-all border-none bg-transparent text-slate-600 hover:text-slate-900 cursor-pointer">Hôm nay</button>
                            <button onclick="changeChartPeriod('7')" id="btn-period-7" class="px-3 py-1 text-[10px] font-bold rounded-lg transition-all border-none bg-transparent text-slate-600 hover:text-slate-900 cursor-pointer">7 ngày</button>
                            <button onclick="changeChartPeriod('30')" id="btn-period-30" class="px-3 py-1 text-[10px] font-bold rounded-lg transition-all border-none bg-brand-600 text-white shadow-sm cursor-pointer">30 ngày</button>
                        </div>
                    </div>
                    <div class="h-[300px] w-full relative">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm lg:col-span-4 flex flex-col justify-between">
                        <h3 class="text-sm font-bold text-slate-800 mb-4">Kênh Ghi Nhận</h3>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b text-[10px] text-slate-400 uppercase font-extrabold">
                                    <th class="pb-2">Kênh dẫn nguồn</th>
                                    <th class="pb-2 text-right">Lượt điền</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php 
                                $top_channel_index = 0;
                                arsort($stat_sources);
                                foreach ($stat_sources as $srcName => $srcCount): 
                                    if ($top_channel_index++ >= 4) break;
                                ?>
                                    <tr>
                                        <td class="py-2.5 font-semibold text-slate-700"><?php echo esc_html($srcName ?: 'Khác / Trực tiếp'); ?></td>
                                        <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $srcCount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm lg:col-span-4 flex flex-col justify-between">
                        <h3 class="text-sm font-bold text-slate-800 mb-4">Trang Điểm Cuối</h3>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b text-[10px] text-slate-400 uppercase font-extrabold">
                                    <th class="pb-2">Điểm dừng (Drop-point)</th>
                                    <th class="pb-2 text-right">Tần suất</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr>
                                    <td class="py-2.5 font-semibold text-slate-700">Hoàn thành 100%</td>
                                    <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $drop_off_stats['completed']; ?></td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-semibold text-slate-700">Đang điền thông tin liên hệ</td>
                                    <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $drop_off_stats['contact']; ?></td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-semibold text-slate-700">Đang làm khảo sát</td>
                                    <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $drop_off_stats['survey']; ?></td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-semibold text-slate-700">Chưa bắt đầu</td>
                                    <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $drop_off_stats['start']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm lg:col-span-4 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="text-sm font-bold text-slate-800 m-0">Active Users</h3>
                        </div>
                        
                        <div class="flex items-center gap-2 mt-2 mb-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            <span class="text-3xl font-extrabold text-slate-800 font-outfit leading-none"><?php echo $live_count; ?></span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Live visitors</span>
                        </div>

                        <!-- Sparkline Line Chart -->
                        <div class="h-[100px] w-full relative mb-4">
                            <canvas id="activeUsersChart"></canvas>
                        </div>

                        <!-- 3-Column Footer Stats -->
                        <div class="grid grid-cols-3 border-t border-solid border-slate-100 pt-3 text-center">
                            <div>
                                <div class="text-xs font-extrabold text-slate-800 font-outfit"><?php echo number_format($dau_visitors); ?></div>
                                <div class="text-[9px] text-slate-400 mt-0.5 font-bold">Avg. Daily</div>
                            </div>
                            <div class="border-l border-solid border-slate-100 border-y-0 border-r-0">
                                <div class="text-xs font-extrabold text-slate-800 font-outfit"><?php echo number_format($wau_visitors); ?></div>
                                <div class="text-[9px] text-slate-400 mt-0.5 font-bold">Avg. Weekly</div>
                            </div>
                            <div class="border-l border-solid border-slate-100 border-y-0 border-r-0">
                                <div class="text-xs font-extrabold text-slate-800 font-outfit"><?php echo number_format($mau_visitors); ?></div>
                                <div class="text-[9px] text-slate-400 mt-0.5 font-bold">Avg. Monthly</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Country & City Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm flex flex-col justify-between">
                        <h3 class="text-sm font-bold text-slate-800 mb-4">Quốc Gia (Country)</h3>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b text-[10px] text-slate-400 uppercase font-extrabold">
                                    <th class="pb-2">Quốc gia</th>
                                    <th class="pb-2 text-right">Lượt truy cập</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php 
                                arsort($countries);
                                foreach ($countries as $cName => $cCount): 
                                ?>
                                    <tr>
                                        <td class="py-2.5 font-semibold text-slate-700"><?php echo esc_html($cName); ?></td>
                                        <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $cCount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm flex flex-col justify-between">
                        <h3 class="text-sm font-bold text-slate-800 mb-4">Tỉnh Thành (Location/City)</h3>
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b text-[10px] text-slate-400 uppercase font-extrabold">
                                    <th class="pb-2">Khu vực / Thành phố</th>
                                    <th class="pb-2 text-right">Lượt truy cập</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php 
                                arsort($cities);
                                $city_index = 0;
                                foreach ($cities as $cityName => $cityCount): 
                                    if ($city_index++ >= 4) break;
                                ?>
                                    <tr>
                                        <td class="py-2.5 font-semibold text-slate-700"><?php echo esc_html($cityName); ?></td>
                                        <td class="py-2.5 text-right font-bold text-slate-800"><?php echo $cityCount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm flex flex-col items-center">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 text-center">Phân loại thiết bị</h4>
                        <div class="w-[150px] h-[150px] relative">
                            <canvas id="deviceTypeChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm flex flex-col items-center">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 text-center">Hệ điều hành</h4>
                        <div class="w-[150px] h-[150px] relative">
                            <canvas id="deviceOsChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm flex flex-col items-center">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 text-center">Trình duyệt chính</h4>
                        <div class="w-[150px] h-[150px] relative">
                            <canvas id="browserChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Unified Marketing Sources & UTMs Row -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm lg:col-span-5">
                        <h3 class="text-sm font-bold text-slate-800 mb-6">Xếp Hạng Nguồn Lưu Lượng</h3>
                        <div class="space-y-4">
                            <?php 
                            $source_totals = array_sum($stat_sources);
                            foreach ($stat_sources as $srcName => $srcCount): 
                                $src_pct = $source_totals > 0 ? round(($srcCount / $source_totals) * 100) : 0;
                            ?>
                                <div>
                                    <div class="flex justify-between text-xs mb-1.5 font-medium text-slate-600">
                                        <span><?php echo esc_html($srcName ?: 'Khác / Trực tiếp'); ?></span>
                                        <span class="font-bold text-slate-800"><?php echo $src_pct; ?>%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-brand-500 h-full rounded-full" style="width: <?php echo $src_pct; ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm lg:col-span-7">
                        <h3 class="text-sm font-bold text-slate-800 mb-6">Chiến Dịch UTM Hot Leads</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="border-b text-[10px] text-slate-400 uppercase font-extrabold">
                                        <th class="pb-2">Nguồn / Campaign</th>
                                        <th class="pb-2 text-center">Truy cập</th>
                                        <th class="pb-2 text-center">Hoàn thành</th>
                                        <th class="pb-2 text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <?php 
                                    $utm_campaigns = [];
                                    foreach ($rows as $r) {
                                        $da = !empty($r->deep_analytics) ? json_decode($r->deep_analytics, true) : [];
                                        if (!empty($da['utms']['utm_campaign'])) {
                                            $camp = $da['utms']['utm_campaign'];
                                            $src = $da['utms']['utm_source'] ?? 'Facebook';
                                            $key = $src . ' - ' . $camp;
                                            if (!isset($utm_campaigns[$key])) {
                                                $utm_campaigns[$key] = ['source' => $src, 'campaign' => $camp, 'clicks' => 0, 'conversions' => 0];
                                            }
                                            $utm_campaigns[$key]['clicks']++;
                                            if (!empty($r->scores_json)) {
                                                $utm_campaigns[$key]['conversions']++;
                                            }
                                        }
                                    }
                                    
                                    if (empty($utm_campaigns)) {
                                        echo '<tr><td colspan="4" class="py-4 text-center text-slate-400 italic">Không tìm thấy UTM campaign nào.</td></tr>';
                                    } else {
                                        foreach ($utm_campaigns as $u):
                                    ?>
                                        <tr>
                                            <td class="py-3 font-semibold text-slate-700">
                                                <div class="font-bold text-slate-800"><?php echo esc_html(ucfirst($u['source'])); ?></div>
                                                <div class="text-[10px] text-slate-400 font-medium"><?php echo esc_html($u['campaign']); ?></div>
                                            </td>
                                            <td class="py-3 text-center font-bold text-slate-600"><?php echo $u['clicks']; ?></td>
                                            <td class="py-3 text-center font-bold text-brand-600"><?php echo $u['conversions']; ?></td>
                                            <td class="py-3 text-center">
                                                <span class="inline-block px-2 py-0.5 rounded text-[9px] font-extrabold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">Hoạt động</span>
                                            </td>
                                        </tr>
                                    <?php 
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Unified Health Signs Section -->
                <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm">
                    <h3 class="text-sm font-bold text-slate-800 mb-6">Tỷ Lệ Mắc Dấu Hiệu Sức Khỏe (Health signs prevalence)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-indigo-50 border border-solid border-indigo-100 rounded-xl p-4 flex items-center gap-3">
                            <div class="p-3 rounded-lg bg-indigo-100 text-indigo-700">
                                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-indigo-900 m-0">Nhóm có tỷ lệ trẻ nguy cơ Cao nhiều nhất</h5>
                                <p class="text-sm font-semibold text-indigo-700 mt-1 m-0">
                                    <?php if (!empty($highest_risk_group_name)): ?>
                                        <strong><?php echo esc_html($highest_risk_group_name); ?></strong> (<?php echo $highest_risk_group_pct; ?>% trẻ có nguy cơ cao)
                                    <?php else: ?>
                                        Chưa đủ dữ liệu phân tích
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="bg-emerald-50 border border-solid border-emerald-100 rounded-xl p-4 flex items-center gap-3">
                            <div class="p-3 rounded-lg bg-emerald-100 text-emerald-700">
                                <i data-lucide="info" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-emerald-900 m-0">Biểu hiện chi tiết xuất hiện nhiều nhất</h5>
                                <p class="text-sm font-semibold text-emerald-700 mt-1 m-0">
                                    <?php if (!empty($most_common_symptom_name)): ?>
                                        "<?php echo esc_html($most_common_symptom_name); ?>" (<?php echo $most_common_symptom_count; ?> lượt chọn)
                                    <?php else: ?>
                                        Chưa đủ dữ liệu phân tích
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-5 gap-8">
                        <div class="xl:col-span-2 flex flex-col justify-between bg-white p-6 rounded-xl border border-solid border-slate-100">
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 text-center">Biểu đồ so sánh điểm trung bình</h4>
                            <div class="relative flex-grow min-h-[280px]">
                                <canvas id="prevalenceChartOverview"></canvas>
                            </div>
                        </div>
                        
                        <div class="xl:col-span-3 overflow-x-auto bg-white p-6 rounded-xl border border-solid border-slate-100">
                            <table class="w-full text-left border-collapse min-w-[500px]">
                                <thead>
                                    <tr class="border-b text-[10px] text-gray-400 uppercase tracking-wider font-bold">
                                        <th class="pb-3 pl-2">Nhóm Dấu Hiệu</th>
                                        <th class="pb-3 text-center">Điểm TB</th>
                                        <th class="pb-3 text-center" style="width: 140px;">Nguy cơ</th>
                                        <th class="pb-3 text-center text-red-500">Cao</th>
                                        <th class="pb-3 text-center text-amber-500">Vừa</th>
                                        <th class="pb-3 text-center text-emerald-500">Thấp</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <?php foreach ($group_prevalence as $gid => $gdata): ?>
                                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer" onclick="togglePrevalenceDetail('<?php echo esc_js($gid); ?>')">
                                            <td class="py-3 pl-2">
                                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-slate-400 align-middle transition-transform duration-200" id="prev-chevron-<?php echo esc_attr($gid); ?>"></i>
                                                <span class="font-bold text-slate-850"><?php echo esc_html($gdata['name']); ?></span>
                                                <div class="text-[10px] text-slate-400 font-medium pl-4">Lượt ghi nhận: <?php echo $gdata['count']; ?></div>
                                            </td>
                                            <td class="py-3 text-center font-bold text-[#002795]"><?php echo $gdata['avg_pct']; ?>%</td>
                                            <td class="py-3">
                                                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden flex">
                                                    <div class="bg-red-500 h-full" style="width: <?php echo $gdata['high_pct']; ?>%"></div>
                                                    <div class="bg-amber-500 h-full" style="width: <?php echo $gdata['med_pct']; ?>%"></div>
                                                    <div class="bg-emerald-500 h-full" style="width: <?php echo $gdata['low_pct']; ?>%"></div>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center font-bold text-red-600"><?php echo $gdata['high_pct']; ?>%</td>
                                            <td class="py-3 text-center font-semibold text-amber-500"><?php echo $gdata['med_pct']; ?>%</td>
                                            <td class="py-3 text-center text-emerald-600"><?php echo $gdata['low_pct']; ?>%</td>
                                        </tr>
                                        <tr id="prev-detail-<?php echo esc_attr($gid); ?>" style="display:none; background-color: #f8fafc;">
                                            <td colspan="6" class="p-6 border-b border-solid border-slate-200">
                                                <div class="space-y-3">
                                                    <h5 class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Tần suất xuất hiện các biểu hiện chi tiết</h5>
                                                    <?php if (empty($gdata['symptoms'])): ?>
                                                        <p class="text-xs text-gray-400 italic m-0">Chưa ghi nhận biểu hiện nào được chọn.</p>
                                                    <?php else: ?>
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <?php 
                                                            foreach ($gdata['symptoms'] as $symName => $symFreq):
                                                                $sym_pct = $completed_count > 0 ? round(($symFreq / $completed_count) * 100) : 0;
                                                            ?>
                                                                <div class="bg-white p-3 rounded-xl border border-solid border-slate-100 flex flex-col justify-between shadow-sm">
                                                                    <div class="flex justify-between text-xs mb-1.5 gap-4">
                                                                        <span class="font-semibold text-slate-700 leading-snug"><?php echo esc_html($symName); ?></span>
                                                                        <span class="font-bold text-[#002795] shrink-0"><?php echo $symFreq; ?> trẻ (<?php echo $sym_pct; ?>%)</span>
                                                                    </div>
                                                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                                        <div class="bg-[#002795] h-full" style="width: <?php echo $sym_pct; ?>%"></div>
                                                                    </div>
                                                                </div>
                                                            <?php 
                                                            endforeach; 
                                                            ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: KEY SYMPTOMS (Health Signs) -->
            <div id="tab-prevalence" class="tab-content space-y-6 hidden">
                <!-- Sub-tab Navigation -->
                <div class="flex border-b border-solid border-slate-200 gap-6 mb-4">
                    <button onclick="togglePrevalenceSubTab('analysis')" id="subtab-btn-analysis" class="pb-3 text-sm font-semibold border-b-2 border-solid border-[#002795] text-[#002795] bg-transparent border-t-0 border-l-0 border-r-0 cursor-pointer transition-all">Phân tích chuyên sâu (Domino & Trục chẩn đoán)</button>
                    <button onclick="togglePrevalenceSubTab('frequency')" id="subtab-btn-frequency" class="pb-3 text-sm font-semibold border-b-2 border-solid border-transparent text-slate-500 hover:text-slate-800 bg-transparent border-t-0 border-l-0 border-r-0 cursor-pointer transition-all">Tần suất chi tiết (8 nhóm dấu hiệu)</button>
                </div>

                <!-- SUB-TAB 1: ANALYSIS (5-LAYER SYSTEM ENGINE) -->
                <div id="subtab-content-analysis" class="space-y-6">
                    <!-- Layer 1 Cards: Micro Metrics -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card 1: Micro PSS -->
                        <div class="bg-white p-5 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                    Micro_PSS Trung Bình
                                    <span class="relative group cursor-pointer text-[#002795] inline-block">
                                        📌
                                        <span class="tooltip top-6 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[240px] pointer-events-none absolute hidden group-hover:block z-50 font-normal normal-case leading-normal">
                                            <strong>Tổng điểm nén áp lực thực thể</strong> tích lũy từ 40 triệu chứng (Tối đa 120 điểm). Điểm càng cao, trẻ càng chịu nhiều đau đớn ngầm và áp lực thần kinh.
                                        </span>
                                    </span>
                                </span>
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                    <i data-lucide="activity" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-baseline gap-2">
                                <span class="text-xl font-extrabold text-indigo-900"><?php echo $insights['macro']['avg_micro_pss']; ?> / 120</span>
                                <span class="text-sm"><?php echo $insights['macro']['avg_micro_pss'] > 60 ? '🔴' : ($insights['macro']['avg_micro_pss'] > 30 ? '🟡' : '🔵'); ?></span>
                            </div>
                            <div class="text-[11px] text-slate-500 font-semibold mt-1">
                                <?php echo $insights['macro']['avg_micro_pss'] > 60 ? '(Tổn thương mức cao)' : ($insights['macro']['avg_micro_pss'] > 30 ? '(Nén trung bình)' : '(Nén nhẹ)'); ?>
                            </div>
                        </div>

                        <!-- Card 2: SEOI Neural Overload -->
                        <div class="bg-white p-5 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                    Overload Index (SEOI)
                                    <span class="relative group cursor-pointer text-[#002795] inline-block">
                                        📌
                                        <span class="tooltip top-6 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[240px] pointer-events-none absolute hidden group-hover:block z-50 font-normal normal-case leading-normal">
                                            <strong>Tỷ lệ % quá tải hệ thần kinh</strong> tính từ 3 nhóm: Giác quan, Cảm xúc & Giấc ngủ. SEOI > 50% nghĩa là trẻ bùng nổ do não quá tải chứ không phải do hư.
                                        </span>
                                    </span>
                                </span>
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <i data-lucide="zap" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-baseline gap-2">
                                <span class="text-xl font-extrabold text-amber-900"><?php echo $insights['macro']['avg_seoi']; ?>%</span>
                                <span class="text-sm"><?php echo $insights['macro']['avg_seoi'] > 50 ? '🔴' : ($insights['macro']['avg_seoi'] > 30 ? '🟡' : '🔵'); ?></span>
                            </div>
                            <div class="text-[11px] text-slate-500 font-semibold mt-1">
                                <?php echo $insights['macro']['avg_seoi'] > 50 ? '(1/2 trẻ quá tải)' : ($insights['macro']['avg_seoi'] > 30 ? '(Bắt đầu bứt bối)' : '(Ngưỡng thích nghi tốt)'); ?>
                            </div>
                        </div>

                        <!-- Card 3: RRI Regression Risk -->
                        <div class="bg-white p-5 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                    Regression (RRI)
                                    <span class="relative group cursor-pointer text-[#002795] inline-block">
                                        📌
                                        <span class="tooltip top-6 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[240px] pointer-events-none absolute hidden group-hover:block z-50 font-normal normal-case leading-normal">
                                            <strong>Dự báo nguy cơ mất kỹ năng đột ngột</strong> do viêm mãn tính hoặc kiệt sức thần kinh. Tính từ các câu hỏi cấp tính về Miễn dịch, Giấc ngủ & Tiêu hóa.
                                        </span>
                                    </span>
                                </span>
                                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-2">
                                <span class="text-xl font-extrabold text-red-900"><?php echo $insights['macro']['avg_rri']; ?>%</span>
                                <?php if ($insights['macro']['avg_rri'] >= 50): ?>
                                    <span class="text-xs text-red-600 font-bold">⚠️ Báo động</span>
                                <?php endif; ?>
                            </div>
                            <div class="text-[11px] text-slate-500 font-semibold mt-1">
                                <?php echo $insights['macro']['avg_rri'] >= 50 ? '(Nguy cơ thoái lùi)' : '(Cần theo dõi)'; ?>
                            </div>
                        </div>

                        <!-- Card 4: Delta longitudinal recovery -->
                        <div class="bg-white p-5 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                                    Tiến Triển Δ
                                    <span class="relative group cursor-pointer text-[#002795] inline-block">
                                        📌
                                        <span class="tooltip top-6 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[240px] pointer-events-none absolute hidden group-hover:block z-50 font-normal normal-case leading-normal">
                                            <strong>Đo lường sự cải thiện điểm PSS</strong> giữa lần đầu T0 và lần sau T1. Phục hồi dương (>0) cho thấy vùng rủi ro co hẹp.
                                        </span>
                                    </span>
                                </span>
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-baseline gap-2">
                                <span class="text-xl font-extrabold text-emerald-900">+<?php echo $insights['progress']['improved_pct']; ?>%</span>
                            </div>
                            <div class="text-[11px] text-slate-500 font-semibold mt-1">
                                (<?php echo $insights['progress']['repeat_count']; ?> trẻ T1)
                            </div>
                        </div>
                    </div>

                    <!-- Banner đọc vị Insight tự động -->
                    <?php 
                    $axis_rates = [];
                    foreach ($known_groups as $k1 => $n1) {
                        foreach ($known_groups as $k2 => $n2) {
                            if ($k1 !== $k2) {
                                $rate = isset($insights['correlation_matrix'][$k1][$k2]) ? floatval($insights['correlation_matrix'][$k1][$k2]) : 0;
                                $key = [$k1, $k2];
                                sort($key);
                                $key_str = $key[0] . '_' . $key[1];
                                if (!isset($axis_rates[$key_str])) {
                                    $axis_rates[$key_str] = [
                                        'name1' => $n1,
                                        'name2' => $n2,
                                        'k1' => $k1,
                                        'k2' => $k2,
                                        'rate' => $rate
                                    ];
                                }
                            }
                        }
                    }
                    usort($axis_rates, function($a, $b) {
                        return $b['rate'] - $a['rate'];
                    });
                    
                    $top1 = $axis_rates[0] ?? ['name1' => 'Giác Quan', 'name2' => 'Ăn Uống', 'rate' => 59.0];
                    $top2 = $axis_rates[1] ?? ['name1' => 'Cảm Xúc', 'name2' => 'Giác Quan', 'rate' => 59.0];
                    
                    $recommendation_text = 'Mối liên hệ mật thiết giữa ' . $top1['name1'] . ' và ' . $top1['name2'] . ' làm hành vi của trẻ bị ảnh hưởng nghiêm trọng.';
                    if (($top1['k1'] === 'camGiac' && $top1['k2'] === 'anUong') || ($top1['k1'] === 'anUong' && $top1['k2'] === 'camGiac')) {
                        $recommendation_text = 'Rối loạn giác quan khoang miệng làm trẻ kén ăn & bùng nổ cảm xúc.';
                    }
                    ?>
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-solid border-amber-200 rounded-2xl p-5 shadow-sm space-y-2.5">
                        <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider m-0 flex items-center gap-1.5">
                            💡 BANNER ĐỌC VỊ INSIGHT TỰ ĐỘNG (DYNAMIC ACTION CALLOUT BOX)
                        </h4>
                        <div class="text-xs text-amber-900 space-y-1.5">
                            <div>🔥 <strong>Trục Nóng Nhất Thị Trường:</strong> <?php echo esc_html($top1['name1']); ?> x <?php echo esc_html($top1['name2']); ?> (<?php echo number_format($top1['rate'], 1); ?>%) &amp; <?php echo esc_html($top2['name1']); ?> x <?php echo esc_html($top2['name2']); ?> (<?php echo number_format($top2['rate'], 1); ?>%)</div>
                            <div>🎯 <strong>Định hướng Content Mass / Ads:</strong> Xuất bản ngay bài viết / Video về "<?php echo esc_html($recommendation_text); ?>"</div>
                            <div>⚠️ <strong>Cảnh báo Tệp Data:</strong> <?php echo $insights['macro']['avg_rri']; ?>% trẻ có nguy cơ thoái lùi kỹ năng ➔ Ra chuỗi bài nuôi dưỡng Y sinh.</div>
                        </div>
                    </div>

                    <!-- Layer 2: 28 Axes Correlation Heatmap Matrix -->
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative group">
                        <div class="flex items-center gap-1.5 mb-4">
                            <h3 class="text-sm font-bold text-slate-800 m-0">Ma Trận Nhiệt 28 Trục Tương Quan Chẩn Đoán Chéo (2D Matrix)</h3>
                            <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors cursor-pointer">
                                <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                            <span class="relative group inline-block cursor-pointer">
                                <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                    <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                </div>
                                <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                    <strong>Ma trận chẩn đoán chéo 2D</strong> biểu thị tỷ lệ % trẻ bị kích hoạt đồng thời cả hai nhóm dấu hiệu chéo trong tổng số hồ sơ, giúp bóc tách mối liên hệ bệnh lý sâu sắc (Gốc rễ vs Bề nổi).
                                </div>
                            </span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-center border-collapse border border-solid border-slate-100 text-xs min-w-[640px]">
                                <thead>
                                    <tr class="bg-slate-50 font-bold text-slate-600">
                                        <th class="p-3 border border-solid border-slate-200 text-left">Nhóm Dấu Hiệu</th>
                                        <?php foreach ($known_groups as $k => $n): ?>
                                            <th class="p-3 border border-solid border-slate-200"><?php echo esc_html($n); ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($known_groups as $k1 => $n1): ?>
                                        <tr>
                                            <td class="p-3 border border-solid border-slate-200 text-left font-bold text-slate-700 bg-slate-50"><?php echo esc_html($n1); ?></td>
                                            <?php foreach ($known_groups as $k2 => $n2): ?>
                                                <?php 
                                                if ($k1 === $k2):
                                                    $val = '-';
                                                    $bg = 'background-color: #f8fafc; color: #94a3b8; font-style: italic;';
                                                else:
                                                    $rate = isset($insights['correlation_matrix'][$k1][$k2]) ? floatval($insights['correlation_matrix'][$k1][$k2]) : 0;
                                                    $rate_str = number_format($rate, 1) . '%';
                                                    
                                                    if ($rate > 55) {
                                                        $val = '🔴 ' . $rate_str . '*';
                                                        $bg = 'background-color: #fef2f2; color: #dc2626; font-weight: 800; border: 1.5px solid #fee2e2;';
                                                    } elseif ($rate >= 45) {
                                                        $val = '🟡 ' . $rate_str;
                                                        $bg = 'background-color: #fffbeb; color: #d97706; font-weight: 700; border: 1.5px solid #fef3c7;';
                                                    } else {
                                                        $val = '🔵 ' . $rate_str;
                                                        $bg = 'background-color: #f8fafc; color: #64748b; border: 1.5px solid #f1f5f9;';
                                                    }
                                                endif;
                                                ?>
                                                <td class="p-3 border border-solid border-slate-200 text-center transition-colors" style="<?php echo $bg; ?>">
                                                    <?php echo $val; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Row 3: Dominos (Left) & Psych / Age Calibration (Right) -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left: Top Domino Pathology Chains -->
                        <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center gap-1.5 mb-4">
                                <h3 class="text-sm font-bold text-slate-800 m-0">Chuỗi Domino Bệnh Lý 3 Mắt Xích Nóng Nhất</h3>
                                <div class="relative group inline-block cursor-pointer">
                                    <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                        <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                        <strong>Chuỗi Domino bệnh lý 3 mắt xích</strong> phát hiện phản ứng dây chuyền thực thể (Ví dụ: Tiêu hóa -> Giấc ngủ -> Cảm xúc) để tìm ra "Mắt xích sụp đổ đầu tiên" cần được tháo gỡ ưu tiên.
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <?php 
                                $domino_actions = [
                                    'DOMINO_01' => 'Xoa dịu đường ruột trước để cải thiện giấc ngủ, cơn bùng nổ sẽ tự hạ nhiệt.',
                                    'DOMINO_02' => 'Trị liệu điều hòa cảm giác khoang miệng + bổ sung vi chất dạng xịt.',
                                    'DOMINO_03' => 'Kiểm soát phản ứng viêm thần kinh & dị ứng để lấy lại thăng bằng tập trung.',
                                    'DOMINO_04' => 'Trị liệu trương lực cơ lưng yếu để giảm kích ứng tăng động & bùng nổ.'
                                ];
                                foreach ($insights['dominos'] as $code => $dom): 
                                    $action = $domino_actions[$code] ?? '';
                                ?>
                                    <div class="p-4 rounded-xl border border-solid border-slate-100 bg-slate-50 flex flex-col justify-between">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-700"><?php echo esc_html($dom['name']); ?></span>
                                            <span class="text-xs font-extrabold text-[#002795]"><?php echo $dom['rate']; ?>% tệp</span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden mb-2.5">
                                            <div class="bg-[#002795] h-full rounded-full" style="width: <?php echo $dom['rate']; ?>%"></div>
                                        </div>
                                        <div class="text-[10px] text-slate-500 leading-relaxed bg-indigo-50 border border-solid border-indigo-100 rounded-lg p-2 flex items-start gap-1">
                                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#002795] shrink-0 mt-0.5"></i>
                                            <span><strong>Giải pháp ưu tiên:</strong> <?php echo esc_html($action); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Right: Psychology & Age Segments -->
                        <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center gap-1.5 mb-4">
                                <h3 class="text-sm font-bold text-slate-800 m-0">Phân Khúc Tâm Lý Mẹ & Cân Bằng Nhóm Tuổi</h3>
                                <div class="relative group inline-block cursor-pointer">
                                    <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                        <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                        <strong>Phân tầng nhóm tuổi & Dự báo tâm lý</strong> đo lường chỉ số RRI theo các lứa tuổi khác nhau kèm tỷ lệ phân cụm trạng thái tâm lý của phụ huynh nhằm tối ưu hóa phác đồ tư vấn.
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <!-- Age groups -->
                                <div class="space-y-4">
                                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Đo lường RRI theo nhóm tuổi</h4>
                                    <?php 
                                    $age_labels = ['0-3t' => 'Nhóm 0 - 3 tuổi', '4-6t' => 'Nhóm 4 - 6 tuổi', '>6t' => 'Nhóm > 6 tuổi'];
                                    foreach ($insights['age_distribution'] as $ageKey => $ageData):
                                        $label = $age_labels[$ageKey] ?? $ageKey;
                                    ?>
                                        <div class="bg-slate-50 p-3 rounded-xl border border-solid border-slate-100 flex flex-col justify-between">
                                            <div class="flex justify-between text-xs mb-1">
                                                <span class="font-bold text-slate-700"><?php echo esc_html($label); ?></span>
                                                <span class="font-semibold text-red-600"><?php echo $ageData['high_rri_pct']; ?>% RRI cao</span>
                                            </div>
                                            <div class="w-full bg-slate-200 h-1 rounded-full overflow-hidden">
                                                <div class="bg-red-500 h-full rounded-full" style="width: <?php echo $ageData['high_rri_pct']; ?>%"></div>
                                            </div>
                                            <div class="text-[9px] text-slate-400 mt-1 pl-1">
                                                Cỡ mẫu: <?php echo $ageData['count']; ?> hồ sơ | RRI trung bình: <?php echo $ageData['avg_rri']; ?>%
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Psych clustering -->
                                <div class="space-y-4 border-t border-solid border-slate-100 sm:border-t-0 sm:border-l sm:pl-6">
                                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Phân cụm trạng thái tâm lý Mẹ</h4>
                                    
                                    <!-- Mẹ Kiệt Sức -->
                                    <div class="bg-red-50 p-2.5 rounded-xl border border-solid border-red-100 flex items-center justify-between gap-4">
                                        <div>
                                            <h5 class="text-xs font-bold text-red-900 m-0">Mẹ Kiệt Sức</h5>
                                            <p class="text-[9px] text-red-700 m-0 mt-0.5">SEOI cao & RRI cao ➔ Cần xoa dịu</p>
                                        </div>
                                        <span class="text-sm font-bold text-red-700 shrink-0"><?php echo esc_html($insights['psychology_distribution']['Mẹ Kiệt Sức']); ?>% tệp</span>
                                    </div>
                                    
                                    <!-- Mẹ Hoảng Loạn -->
                                    <div class="bg-amber-50 p-2.5 rounded-xl border border-solid border-amber-100 flex items-center justify-between gap-4">
                                        <div>
                                            <h5 class="text-xs font-bold text-amber-900 m-0">Mẹ Hoảng Loạn</h5>
                                            <p class="text-[9px] text-amber-700 m-0 mt-0.5">Số lượng triệu chứng tăng vọt</p>
                                        </div>
                                        <span class="text-sm font-bold text-amber-700 shrink-0"><?php echo esc_html($insights['psychology_distribution']['Mẹ Hoảng Loạn']); ?>% tệp</span>
                                    </div>

                                    <!-- Mẹ Mất Hướng -->
                                    <div class="bg-blue-50 p-2.5 rounded-xl border border-solid border-blue-100 flex items-center justify-between gap-4">
                                        <div>
                                            <h5 class="text-xs font-bold text-blue-900 m-0">Mẹ Mất Hướng</h5>
                                            <p class="text-[9px] text-blue-700 m-0 mt-0.5">Khảo sát lần đầu ➔ Chưa có lộ trình</p>
                                        </div>
                                        <span class="text-sm font-bold text-blue-700 shrink-0"><?php echo esc_html($insights['psychology_distribution']['Mẹ Mất Hướng']); ?>% tệp</span>
                                    </div>
                                </div>
                            </div>
                    <!-- Row 4: Interactive Charts for Deep Analysis -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left: Radar Chart for Health Groups -->
                        <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center gap-1.5 mb-4">
                                <h3 class="text-sm font-bold text-slate-800 m-0">Bản Đồ Phân Bổ Sức Khỏe Hệ Thống (Systemic Health Radar)</h3>
                                <span class="relative group inline-block cursor-pointer">
                                    <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                        <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                        <strong>Biểu đồ Radar</strong> trực quan hóa tỷ lệ % xuất hiện trung bình của 8 nhóm dấu hiệu sức khỏe trên toàn tệp khách hàng.
                                    </div>
                                </span>
                            </div>
                            <div class="relative h-[280px]">
                                <canvas id="analysisRadarChart"></canvas>
                            </div>
                        </div>

                        <!-- Right: Doughnut Chart for Mother Psychology -->
                        <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                            <div class="flex items-center gap-1.5 mb-4">
                                <h3 class="text-sm font-bold text-slate-800 m-0">Cấu Trúc Tâm Lý Phụ Huynh (Parental Clusters)</h3>
                                <span class="relative group inline-block cursor-pointer">
                                    <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                        <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                        <strong>Cấu trúc tâm lý Mẹ</strong> phân loại nhóm phụ huynh khảo sát dựa trên mức độ nghiêm trọng y sinh của con (Mẹ Kiệt Sức, Mẹ Hoảng Loạn, Mẹ Mất Hướng).
                                    </div>
                                </span>
                            </div>
                            <div class="relative h-[280px]">
                                <canvas id="analysisPsychDoughnut"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Top SPI symptoms (Pain Points of the Market) -->
                    <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm relative">
                        <div class="flex items-center gap-1.5 mb-4">
                            <h3 class="text-sm font-bold text-slate-800 m-0">Top 5 Nỗi Đau Lớn Nhất Thị Trường (Systemic Pain Index - SPI)</h3>
                            <span class="relative group inline-block cursor-pointer">
                                <div class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                    <i data-lucide="help-circle" class="w-3.5 h-3.5"></i>
                                </div>
                                <div class="tooltip top-8 left-1/2 -translate-x-1/2 bg-[#1e293b] text-white p-2.5 rounded-lg shadow-xl text-xs w-[280px] pointer-events-none absolute hidden group-hover:block z-50 font-normal leading-normal">
                                    <strong>Chỉ số Nỗi Đau Hệ Thống (SPI)</strong> xếp hạng các triệu chứng theo độ nghiêm trọng tích hợp (Tần suất xuất hiện x Trọng số độ bức bối của triệu chứng).
                                </div>
                            </span>
                        </div>
                        <div class="space-y-3">
                            <?php 
                            $symptom_short_desc = [
                                'Trẻ thường xuyên xì hơi nặng mùi hoặc hơi thở hôi dù đã vệ sinh răng miệng?' => 'Hơi thở hôi/Xì hơi nặng mùi',
                                'Trẻ hay đầy bụng, chướng bụng, sôi bụng hoặc ợ chua sau ăn?' => 'Đầy bụng/Ợ chua sau ăn',
                                'Trẻ đi ngoài không đều, phân lỏng, sống, có bọt hoặc mùi bất thường?' => 'Phân bất thường',
                                'Trẻ táo bón kéo dài, đau khi đi vệ sinh, són phân hoặc né tránh đi vệ sinh?' => 'Táo bón kéo dài',
                                'Trẻ có dấu hiệu đau bụng dữ dội như ôm bụng, cong người, khóc nhiều hoặc đập bụng vào vật cứng?' => 'Đau bụng/Đập bụng',
                                'Trẻ chỉ chấp nhận một số rất ít món ăn quen thuộc?' => 'Kén ăn món quen thuộc',
                                'Trẻ rất nhạy với mùi, màu, vị hoặc kết cấu thức ăn?' => 'Nhạy cảm kết cấu thức ăn',
                                'Trẻ hay ngậm lâu, không nhai, nhai nuốt kém, buồn nôn hoặc oẹ khi gặp món lạ?' => 'Ngậm lâu/Nhai nuốt kém',
                                'Chế độ ăn kém đa dạng khiến con chậm tăng cân, sụt cân, mệt mỏi hoặc có các dấu hiệu thiếu vi chất?' => 'Chế độ ăn lệch chất',
                                'Trẻ ăn/nhai vật không phải thức ăn hoặc bùng nổ dữ dội khi bị ép ăn?' => 'Ăn vật phi thực phẩm/Pica',
                                'Trẻ khó vào giấc, trằn trọc, cần hơn 60 phút mới ngủ được?' => 'Trằn trọc khó vào giấc',
                                'Trẻ phải có điều kiện đặc biệt mới ngủ, như ôm chặt, tiếng ồn trắng hoặc bật đèn?' => 'Phụ thuộc điều kiện ngủ',
                                'Trẻ thức giấc nhiều lần trong đêm và khó ngủ lại?' => 'Thức giấc đêm nhiều lần',
                                'Khi ngủ, trẻ nghiến răng, đổ mồ hôi nhiều hoặc cử động chân tay liên tục?' => 'Nghiến răng/Đổ mồ hôi đêm',
                                'Trẻ thường la hét hoảng loạn ban đêm hoặc thức trắng nhiều giờ giữa đêm?' => 'La hét hoảng loạn đêm',
                                'Trẻ sợ tiếng ồn, ánh sáng hoặc khó chịu với một số chất liệu quần áo?' => 'Sợ tiếng ồn/Ánh sáng',
                                'Trẻ thích cọ xát, nhìn vật xoay tròn, ngửi đồ vật hoặc tìm cảm giác mạnh (chạy, nhảy từ trên cao, thích chạm vào râu,...)?' => 'Tìm kiếm cảm giác mạnh',
                                'Trẻ hay vấp ngã, mất thăng bằng, chạy nhảy liên tục, khó điều chỉnh lực tay, khó cầm nắm, khó viết,...?' => 'Khó điều chỉnh thăng bằng/lực tay',
                                'Trẻ khó nhận biết đói, đau, buồn vệ sinh hoặc tín hiệu bên trong cơ thể?' => 'Khó nhận biết tín hiệu nội thể',
                                'Trẻ dễ bùng nổ, khó kiểm soát hành vi và cảm xúc nơi đông người, nhiều âm thanh hoặc nhiều kích thích?' => 'Bùng nổ nơi đông người',
                                'Trẻ thường không phản hồi khi được gọi, khó làm theo các hướng dẫn?' => 'Không phản hồi khi gọi',
                                'Trẻ rất khó chuyển hoạt động, dễ khựng lại hoặc bùng nổ khi bị yêu cầu dừng việc đang thích?' => 'Khó chuyển hoạt động',
                                'Trẻ luôn bồn chồn, di chuyển, nhún nhảy hoặc táy máy tay chân?' => 'Bồn chồn/Táy máy tay chân',
                                'Trẻ hay lao đi, leo trèo, nhảy từ cao hoặc làm việc nguy hiểm mà chưa kịp cân nhắc?' => 'Lao đi leo trèo nguy hiểm',
                                'Sau khi cố ngồi yên hoặc tập trung, trẻ cáu kỉnh, kiệt sức hoặc ngắt kết nối rõ rệt?' => 'Cáu kỉnh sau tập trung',
                                'Trẻ có thay đổi cảm xúc thất thường (dễ khóc, dễ cười) mà không rõ nguyên nhân?' => 'Cảm xúc thất thường',
                                'Trẻ căng thẳng, bùng nổ khi lịch trình thay đổi, không được đáp ứng nguyện vọng?' => 'Bùng nổ khi đổi lịch trình',
                                'Hành vi lặp lại tăng mạnh khi trẻ lo lắng hoặc áp lực?' => 'Hành vi lặp lại tăng mạnh',
                                'Trẻ thường la hét, khóc kéo dài và rất khó dỗ?' => 'La hét khóc kéo dài',
                                'Khi khủng hoảng, trẻ tự làm đau hoặc tấn công người khác?' => 'Tự làm đau/Tấn công người',
                                'Trẻ hay hắt hơi, sổ mũi, dụi mắt/mũi, mẩn đỏ, ngứa da, có quầng thâm ở mắt?' => 'Hắt hơi sổ mũi mẩn đỏ',
                                'Trẻ có biểu hiện lạ sau khi ăn một số thực phẩm hoặc tiếp xúc mùi hóa chất?' => 'Phản ứng sau ăn thực phẩm lạ',
                                'Trẻ hay bị viêm tai, viêm họng, viêm amidan hoặc sưng nướu lặp lại?' => 'Viêm họng/VA lặp lại',
                                'Trẻ dễ ốm, lâu khỏi và sau ốm thường mệt mỏi kéo dài?' => 'Dễ ốm lâu khỏi mệt mỏi',
                                'Sau các đợt ốm hoặc dị ứng nặng, trẻ lờ đờ, mất tập trung rõ hoặc giảm kỹ năng đã có?' => 'Mất kỹ năng sau ốm',
                                'Trẻ khó cài cúc, kéo khóa, cầm thìa, dùng kéo hoặc bút chì?' => 'Khó cầm bút/Khó tự phục vụ',
                                'Trẻ hay vấp ngã, va vào đồ vật hoặc đi đứng thiếu vững vàng?' => 'Hay vấp ngã va chạm',
                                'Trẻ nhanh mệt, cơ thể mềm yếu, hay tựa người, nằm bò ra bàn hoặc ngồi chữ W?' => 'Cơ thể mềm yếu mệt mỏi',
                                'Trẻ khó học chuỗi vận động mới như nhảy theo nhạc, đạp xe, leo cầu thang?' => 'Khó học vận động mới',
                                'Trẻ rất khó thực hiện chuỗi tự phục vụ như ăn uống, mặc quần áo, vệ sinh cá nhân?' => 'Khó tự phục vụ'
                            ];
                            
                            $sym_q_map = [];
                            foreach ($group_items as $gid => $g_items) {
                                foreach ($g_items as $idx => $item) {
                                    $sym_q_map[trim($item)] = 'Q_' . $gid . '_' . ($idx + 1);
                                }
                            }
                            
                            $idx_num = 1;
                            foreach ($insights['top_spi'] as $spiItem): 
                                $sym_trimmed = trim($spiItem['symptom']);
                                $q_id = $sym_q_map[$sym_trimmed] ?? 'Q_unknown';
                                $short_desc = $symptom_short_desc[$sym_trimmed] ?? $spiItem['symptom'];
                            ?>
                                <div class="flex items-center justify-between p-3.5 rounded-xl border border-solid border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="w-6 h-6 rounded-full bg-[#002795] text-white font-bold text-xs flex items-center justify-center shrink-0">#<?php echo $idx_num++; ?></span>
                                        <div>
                                            <h5 class="text-xs font-bold text-slate-800 m-0 leading-snug"><?php echo esc_html($q_id); ?> (<?php echo esc_html($short_desc); ?>)</h5>
                                            <p class="text-[9px] text-slate-400 m-0 mt-0.5">Nhóm: <strong><?php echo esc_html($known_groups[$spiItem['gid']] ?? $spiItem['gid']); ?></strong> | Trọng số: W<?php echo $spiItem['weight']; ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="text-xs font-bold text-[#002795]">SPI = <?php echo number_format($spiItem['spi_score'], 2); ?></span>
                                        <p class="text-[9px] text-slate-400 m-0 mt-0.5"><?php echo number_format($spiItem['frequency_pct'], 1); ?>% tệp gặp phải</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- SUB-TAB 2: FREQUENCY (EXISTING CHART & TABLE) -->
                <div id="subtab-content-frequency" class="space-y-6 hidden">
                    <div class="grid grid-cols-1 xl:grid-cols-5 gap-8">
                        <div class="xl:col-span-2 flex flex-col justify-between bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm">
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 text-center">Biểu đồ so sánh điểm trung bình</h4>
                            <div class="relative flex-grow min-h-[280px]">
                                <canvas id="prevalenceChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="xl:col-span-3 overflow-x-auto bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm">
                            <table class="w-full text-left border-collapse min-w-[500px]">
                                <thead>
                                    <tr class="border-b text-[10px] text-gray-400 uppercase tracking-wider font-bold">
                                        <th class="pb-3 pl-2">Nhóm Dấu Hiệu</th>
                                        <th class="pb-3 text-center">Điểm TB</th>
                                        <th class="pb-3 text-center" style="width: 140px;">Nguy cơ</th>
                                        <th class="pb-3 text-center text-red-500">Cao</th>
                                        <th class="pb-3 text-center text-amber-500">Vừa</th>
                                        <th class="pb-3 text-center text-emerald-500">Thấp</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <?php 
                                    $group_icons = [
                                        'tieuHoa' => '🥣',
                                        'anUong' => '🍽️',
                                        'giacNgu' => '😴',
                                        'camGiac' => '🧠',
                                        'tangDong' => '⚡',
                                        'camXuc' => '🎭',
                                        'mienDich' => '🛡️',
                                        'vanDong' => '🏃'
                                    ];
                                    foreach ($group_prevalence as $gid => $gdata): 
                                        $g_icon = $group_icons[$gid] ?? '❓';
                                    ?>
                                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer" onclick="togglePrevalenceDetail('<?php echo esc_js($gid); ?>')">
                                            <td class="py-3 pl-2">
                                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-slate-400 align-middle transition-transform duration-200" id="prev-chevron-<?php echo esc_attr($gid); ?>"></i>
                                                <span class="mr-1.5 text-base"><?php echo $g_icon; ?></span>
                                                <span class="font-bold text-slate-855"><?php echo esc_html($gdata['name']); ?></span>
                                                <div class="text-[10px] text-slate-400 font-medium pl-6">Lượt ghi nhận: <?php echo $gdata['count']; ?></div>
                                            </td>
                                            <td class="py-3 text-center font-bold text-[#002795]"><?php echo $gdata['avg_pct']; ?>%</td>
                                            <td class="py-3">
                                                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden flex">
                                                    <div class="bg-red-500 h-full" style="width: <?php echo $gdata['high_pct']; ?>%"></div>
                                                    <div class="bg-amber-500 h-full" style="width: <?php echo $gdata['med_pct']; ?>%"></div>
                                                    <div class="bg-emerald-500 h-full" style="width: <?php echo $gdata['low_pct']; ?>%"></div>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center font-bold text-red-600"><?php echo $gdata['high_pct']; ?>%</td>
                                            <td class="py-3 text-center font-semibold text-amber-500"><?php echo $gdata['med_pct']; ?>%</td>
                                            <td class="py-3 text-center text-emerald-600"><?php echo $gdata['low_pct']; ?>%</td>
                                        </tr>
                                        <tr id="prev-detail-<?php echo esc_attr($gid); ?>" style="display:none; background-color: #f8fafc;">
                                            <td colspan="6" class="p-6 border-b border-solid border-slate-200">
                                                <div class="space-y-3">
                                                    <h5 class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Tần suất xuất hiện các biểu hiện chi tiết</h5>
                                                    <?php if (empty($gdata['symptoms'])): ?>
                                                        <p class="text-xs text-gray-400 italic m-0">Chưa ghi nhận biểu hiện nào được chọn.</p>
                                                    <?php else: ?>
                                                        <div class="overflow-x-auto bg-white rounded-xl border border-solid border-slate-200 p-4 shadow-sm">
                                                            <table class="w-full text-left border-collapse text-xs">
                                                                <thead>
                                                                    <tr class="border-b border-solid border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                                                                        <th class="pb-2 pl-2">Biểu hiện chi tiết</th>
                                                                        <th class="pb-2 text-center" style="width: 100px;">Trọng số (Q)</th>
                                                                        <th class="pb-2 text-center" style="width: 150px;">Mức độ cảnh báo</th>
                                                                        <th class="pb-2 text-right" style="width: 150px;">Số lượt ghi nhận</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-slate-100">
                                                                    <?php 
                                                                    $q_idx = 1;
                                                                    foreach ($gdata['symptoms'] as $symName => $symFreq):
                                                                        $sym_pct = $completed_count > 0 ? round(($symFreq / $completed_count) * 100) : 0;
                                                                        
                                                                        $q_weight = $q_idx;
                                                                        $severity_label = '';
                                                                        $severity_class = '';
                                                                        if ($q_weight == 5) {
                                                                            $severity_label = 'Đặc biệt nghiêm trọng';
                                                                            $severity_class = 'bg-red-50 text-red-700 border-red-200';
                                                                        } elseif ($q_weight == 4) {
                                                                            $severity_label = 'Nghiêm trọng';
                                                                            $severity_class = 'bg-orange-50 text-orange-700 border-orange-200';
                                                                        } elseif ($q_weight == 3) {
                                                                            $severity_label = 'Vừa phải';
                                                                            $severity_class = 'bg-amber-50 text-amber-700 border-amber-200';
                                                                        } elseif ($q_weight == 2) {
                                                                            $severity_label = 'Nhẹ';
                                                                            $severity_class = 'bg-blue-50 text-blue-700 border-blue-200';
                                                                        } else {
                                                                            $severity_label = 'Cơ bản';
                                                                            $severity_class = 'bg-slate-50 text-slate-600 border-slate-200';
                                                                        }
                                                                        $q_idx++;
                                                                    ?>
                                                                        <tr class="hover:bg-slate-50">
                                                                            <td class="py-2.5 pl-2 pr-4 font-medium text-slate-700 leading-snug">
                                                                                <?php echo esc_html($symName); ?>
                                                                            </td>
                                                                            <td class="py-2.5 text-center">
                                                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#002795]/10 text-[#002795]">W<?php echo $q_weight; ?></span>
                                                                            </td>
                                                                            <td class="py-2.5 text-center">
                                                                                <span class="px-2 py-0.5 rounded text-[9px] font-bold border border-solid <?php echo $severity_class; ?>">
                                                                                    <?php echo $severity_label; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td class="py-2.5 text-right">
                                                                                <div class="flex flex-col items-end gap-1">
                                                                                    <span class="font-bold text-[#002795]"><?php echo $symFreq; ?> trẻ (<?php echo $sym_pct; ?>%)</span>
                                                                                    <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                                                        <div class="bg-[#002795] h-full" style="width: <?php echo $sym_pct; ?>%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: SUBMISSIONS -->
            <div id="tab-submissions" class="tab-content space-y-6 hidden">
                <div class="bg-white p-6 rounded-2xl border border-solid border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 m-0">Danh Sách Phụ Huynh Đánh Giá & Đo Lường Hành Vi</h3>
                            <p class="text-xs text-slate-400 mt-1">Tổng cộng có <strong><?php echo count($rows); ?></strong> hồ sơ dữ liệu</p>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('export_csv', 1)); ?>" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-xl text-white font-bold text-xs cursor-pointer transition-all flex items-center gap-1.5 border-none decoration-none shadow-md shadow-brand-100">
                            <i data-lucide="download" class="w-4 h-4"></i> Tải file Excel/CSV
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                        <div class="relative lg:col-span-2">
                            <label class="block text-[10px] font-extrabold uppercase text-slate-400 mb-1">Tìm kiếm</label>
                            <input type="text" id="dashboardSearch" onkeyup="filterDashboardTable()" placeholder="Tìm tên, SĐT, Email hoặc Mã..." 
                                   class="w-full px-4 py-2 border border-solid border-slate-200 rounded-xl text-sm outline-none transition-all focus:border-brand-500 box-border">
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-400 mb-1">Thiết bị</label>
                            <select id="deviceFilter" onchange="filterDashboardTable()" class="w-full px-3 py-2 border border-solid border-slate-200 rounded-xl text-sm outline-none bg-white">
                                <option value="all">Tất cả thiết bị</option>
                                <option value="Máy tính">Máy tính</option>
                                <option value="Điện thoại">Điện thoại</option>
                                <option value="Máy tính bảng">Máy tính bảng</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-400 mb-1">Trạng thái phễu</label>
                            <select id="statusFilter" onchange="filterDashboardTable()" class="w-full px-3 py-2 border border-solid border-slate-200 rounded-xl text-sm outline-none bg-white">
                                <option value="all">Tất cả trạng thái</option>
                                <option value="completed">Hoàn thành 100%</option>
                                <option value="contact">Thiếu SĐT phụ huynh</option>
                                <option value="survey">Đang làm khảo sát</option>
                                <option value="start">Chưa bắt đầu</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-400 mb-1">Đánh giá chất lượng lead</label>
                            <select id="leadFilter" onchange="filterDashboardTable()" class="w-full px-3 py-2 border border-solid border-slate-200 rounded-xl text-sm outline-none bg-white">
                                <option value="all">Tất cả chất lượng</option>
                                <option value="Hot Lead">Hot Lead 🔥</option>
                                <option value="Tiềm năng">Tiềm năng</option>
                                <option value="Đang tìm hiểu">Đang tìm hiểu</option>
                                <option value="Lướt qua">Lướt qua</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[1000px]" id="submissionsTable">
                            <thead>
                                <tr class="border-b border-solid border-slate-200 text-[10px] text-slate-400 uppercase font-extrabold bg-slate-50/50">
                                    <th class="py-3 px-4">Mã</th>
                                    <th class="py-3 px-4">Tên bé / Tuổi</th>
                                    <th class="py-3 px-4">Phụ huynh / SĐT</th>
                                    <th class="py-3 px-4 text-center">Tiến trình</th>
                                    <th class="py-3 px-4 text-center">Thời gian active</th>
                                    <th class="py-3 px-4 text-center">Thiết bị</th>
                                    <th class="py-3 px-4 text-center">Phân loại Lead</th>
                                    <th class="py-3 px-4 text-center" style="width: 140px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                <?php if (empty($rows)): ?>
                                    <tr>
                                        <td colspan="8" class="py-12 text-center text-slate-400 italic">Chưa có kết quả trắc nghiệm nào được lưu ghi nhận.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($rows as $row): 
                                        $da = !empty($row->deep_analytics) ? json_decode($row->deep_analytics, true) : [];
                                        $lq = hieucon_ndsk_get_lead_quality($row, $da);
                                        $dev = hieucon_ndsk_parse_device_details($row->device_info);
                                        
                                        $dp = $da['drop_point'] ?? 'Chưa bắt đầu';
                                        $dp_badge = 'bg-slate-100 text-slate-700 border-slate-200';
                                        $dp_text = 'Chưa bắt đầu';
                                        $dp_key = 'start';
                                        
                                        if ($dp === 'Hoàn thành 100%') {
                                            $dp_badge = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                            $dp_text = 'Hoàn thành 100%';
                                            $dp_key = 'completed';
                                        } elseif ($dp === 'Đang điền thông tin phụ huynh') {
                                            $dp_badge = 'bg-rose-50 text-rose-700 border-rose-200';
                                            $dp_text = 'Thiếu thông tin liên hệ';
                                            $dp_key = 'contact';
                                        } elseif (strpos($dp, 'Nhóm') !== false) {
                                            $dp_badge = 'bg-amber-50 text-amber-700 border-amber-200';
                                            $dp_text = 'Đang làm khảo sát';
                                            $dp_key = 'survey';
                                        }
                                        
                                        $time_active_secs = intval($da['activeTime'] ?? 0) / 1000;
                                        $time_active_str = $time_active_secs > 0 ? round($time_active_secs) . 's' : '0s';
                                    ?>
                                        <tr class="hover:bg-slate-50/50 transition-colors" id="row-<?php echo esc_attr($row->user_code); ?>"
                                            data-search="<?php echo esc_attr(strtolower($row->child_name . ' ' . $row->parent_name . ' ' . $row->parent_phone . ' ' . $row->parent_email . ' ' . $row->user_code)); ?>"
                                            data-device="<?php echo esc_attr($dev['type']); ?>"
                                            data-status="<?php echo esc_attr($dp_key); ?>"
                                            data-lead="<?php echo esc_attr($lq['level']); ?>">
                                            
                                            <td class="py-3 px-4 font-bold text-slate-500 font-outfit"><?php echo esc_html($row->user_code); ?></td>
                                            <td class="py-3 px-4">
                                                <div class="leading-snug">
                                                    <button onclick="openMicroViewModal('<?php echo esc_js($row->user_code); ?>')" class="font-bold text-[#002795] hover:underline bg-transparent border-none p-0 text-left cursor-pointer leading-snug font-family-inherit">
                                                        <?php echo esc_html($row->child_name ?: 'Bé chưa điền tên'); ?>
                                                    </button>
                                                </div>
                                                <div class="text-xs text-slate-400 mt-0.5"><?php echo esc_html($row->child_age ?: 'Chưa rõ tuổi'); ?></div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="font-bold text-slate-800 leading-snug"><?php echo esc_html($row->parent_name ?: 'Chưa có thông tin'); ?></div>
                                                <div class="text-xs text-slate-400 mt-0.5 font-outfit"><?php echo esc_html($row->parent_phone ?: $row->parent_email ?: 'Chưa có SĐT'); ?></div>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border border-solid <?php echo $dp_badge; ?>">
                                                    <?php echo esc_html($dp_text); ?>
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center font-bold text-slate-600 font-outfit"><?php echo $time_active_str; ?></td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex items-center justify-center gap-1 text-slate-600" title="<?php echo esc_attr($dev['full']); ?>">
                                                    <i data-lucide="<?php echo $dev['icon']; ?>" class="w-4 h-4"></i>
                                                    <span class="text-xs font-semibold"><?php echo esc_html($dev['type']); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border border-solid <?php echo $lq['bg']; ?>" title="<?php echo esc_attr($lq['desc']); ?>">
                                                    <?php echo esc_html($lq['level']); ?>
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <?php if (!empty($row->scores_json)): ?>
                                                        <button onclick="openResultModal('<?php echo esc_js($row->user_code); ?>', '<?php echo esc_js(md5($row->user_code . 'hieucon_secret_salt')); ?>')" 
                                                                class="px-2.5 py-1.5 bg-brand-50 hover:bg-brand-100 text-brand-600 font-bold text-xs rounded-lg transition-all border-none cursor-pointer flex items-center gap-1 font-family-inherit">
                                                            <i data-lucide="eye" class="w-3.5 h-3.5"></i> Xem kết quả
                                                        </button>
                                                    <?php else: ?>
                                                        <span class="text-xs text-slate-400 italic">Chưa hoàn thành</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </main>
    </div>

    <!-- Iframe View Result Modal -->
    <div id="resultModal" class="fixed inset-0 z-50 bg-slate-900/60 items-center justify-center hidden shadow-2xl" style="backdrop-filter: blur(4px);">
        <div class="bg-white rounded-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden mx-4 relative">
            <header class="bg-slate-50 border-b border-solid border-slate-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-800 m-0">Chi Tiết Báo Cáo Khảo Sát Phụ Huynh</h3>
                    <p class="text-[10px] text-slate-400 mt-1">Chế độ xem trực tiếp từ trang kết quả</p>
                </div>
                <button onclick="closeResultModal()" class="p-1.5 hover:bg-slate-200 rounded-lg text-slate-500 cursor-pointer border-none bg-transparent">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </header>
            <div class="flex-grow w-full h-full relative bg-slate-100">
                <div id="modalLoading" class="absolute inset-0 bg-white flex items-center justify-center flex-col gap-2">
                    <span class="w-8 h-8 rounded-full border-4 border-solid border-brand-200 border-t-brand-600 animate-spin"></span>
                    <span class="text-xs font-semibold text-slate-500">Đang tải báo cáo...</span>
                </div>
                <iframe id="resultIframe" class="w-full h-full border-none" onload="document.getElementById('modalLoading').style.display='none'"></iframe>
            </div>
        </div>
    </div>

    <!-- Micro View Modal -->
    <div id="microViewModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center hidden" style="backdrop-filter: blur(4px);">
        <div class="bg-white rounded-3xl shadow-2xl border border-solid border-slate-200 w-full max-w-4xl max-h-[90vh] overflow-y-auto m-4 flex flex-col">
            <!-- Header -->
            <div class="p-6 border-b border-solid border-slate-100 flex items-center justify-between bg-slate-50 rounded-t-3xl">
                <div>
                    <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-wider m-0">Quản trị nội bộ</h3>
                    <h2 class="text-base font-bold text-slate-855 m-0 mt-1">HỒ SƠ PHÂN TÍCH SÂU KHÁCH HÀNG: <span id="mv-header-child-name" class="text-[#002795]"></span></h2>
                </div>
                <button onclick="closeMicroViewModal()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-600 flex items-center justify-center cursor-pointer border-none transition-all">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-6 flex-grow">
                <!-- Section 1: Thông tin khách hàng & phân luồng -->
                <div class="p-5 rounded-2xl border border-solid border-slate-200 bg-slate-50/50">
                    <h4 class="text-xs font-bold text-[#002795] uppercase tracking-wider mb-4 flex items-center gap-1.5">
                        <i data-lucide="user" class="w-4 h-4"></i> THÔNG TIN KHÁCH HÀNG & PHÂN LUỒNG AUTOMATION
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                        <div>• <strong>Phụ huynh:</strong> <span id="mv-parent-info"></span></div>
                        <div>• <strong>Bé:</strong> <span id="mv-child-info"></span></div>
                        <div class="flex items-center gap-1.5">• <strong>Trạng thái Tag:</strong> <span id="mv-lead-tag" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border border-solid"></span></div>
                        <div>• <strong>Phân cụm tâm lý mẹ:</strong> <span id="mv-psych-cluster" class="font-semibold text-slate-700"></span></div>
                    </div>
                </div>

                <!-- Section 2: Bóc tách gốc rễ -->
                <div class="p-5 rounded-2xl border border-solid border-slate-200 bg-slate-50/50">
                    <h4 class="text-xs font-bold text-[#002795] uppercase tracking-wider mb-4 flex items-center gap-1.5">
                        <i data-lucide="search" class="w-4 h-4"></i> BÓC TÁCH GỐC RỄ NỘI BỘ (DÀNH CHO CHUYÊN VIÊN BẢO VỆ TƯ VẤN)
                    </h4>
                    <div class="space-y-4">
                        <!-- Trục 1 -->
                        <div class="p-4 rounded-xl bg-white border border-solid border-slate-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-bold text-slate-700">1. Trục Gốc Rễ Nổi Trội #1</span>
                                <span class="text-xs font-extrabold text-[#002795]" id="mv-axis-rate-1"></span>
                            </div>
                            <p class="text-xs text-slate-600 m-0" id="mv-axis-name-1"></p>
                            <div class="mt-2 text-xs text-slate-500 bg-indigo-50/60 p-2.5 rounded-lg border border-solid border-indigo-100/50 flex items-start gap-1">
                                <i data-lucide="corner-down-right" class="w-3.5 h-3.5 text-[#002795] shrink-0 mt-0.5"></i>
                                <span><strong>Đọc vị:</strong> <span id="mv-axis-reading-1"></span></span>
                            </div>
                        </div>

                        <!-- Trục 2 -->
                        <div class="p-4 rounded-xl bg-white border border-solid border-slate-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-bold text-slate-700">2. Trục Gốc Rễ Nổi Trội #2</span>
                                <span class="text-xs font-extrabold text-[#002795]" id="mv-axis-rate-2"></span>
                            </div>
                            <p class="text-xs text-slate-600 m-0" id="mv-axis-name-2"></p>
                            <div class="mt-2 text-xs text-slate-500 bg-indigo-50/60 p-2.5 rounded-lg border border-solid border-indigo-100/50 flex items-start gap-1">
                                <i data-lucide="corner-down-right" class="w-3.5 h-3.5 text-[#002795] shrink-0 mt-0.5"></i>
                                <span><strong>Đọc vị:</strong> <span id="mv-axis-reading-2"></span></span>
                            </div>
                        </div>

                        <!-- Domino -->
                        <div class="p-4 rounded-xl bg-white border border-solid border-slate-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-bold text-slate-700">3. Chuỗi Domino Bệnh Lý</span>
                                <span class="text-xs font-extrabold text-red-600 animate-pulse" id="mv-domino-code"></span>
                            </div>
                            <p class="text-xs text-slate-600 m-0" id="mv-domino-name"></p>
                            <div class="mt-2 text-xs text-slate-500 bg-red-50/60 p-2.5 rounded-lg border border-solid border-red-100/50 flex items-start gap-1">
                                <i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-red-500 shrink-0 mt-0.5"></i>
                                <span><strong>Mắt xích sụp đổ đầu tiên cần tháo gỡ:</strong> <span id="mv-domino-root"></span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Đề xuất kịch bản -->
                <div class="p-5 rounded-2xl border border-solid border-slate-200 bg-slate-50/50">
                    <h4 class="text-xs font-bold text-[#002795] uppercase tracking-wider mb-4 flex items-center gap-1.5">
                        <i data-lucide="message-square" class="w-4 h-4"></i> ĐỀ XUẤT NỘI DUNG & KỊCH BẢN TƯ VẤN 1:1 NỘI BỘ
                    </h4>
                    <div class="space-y-3 text-xs leading-relaxed text-slate-700">
                        <div>• <strong>Giọng văn tiếp cận:</strong> <span id="mv-voice" class="text-slate-600"></span></div>
                        <div class="bg-amber-50 border border-solid border-amber-100 rounded-xl p-3.5 text-amber-900 font-medium">
                            <strong>Kịch bản mở đầu cuộc gọi:</strong> <br>
                            <span id="mv-call-script" class="italic"></span>
                        </div>
                        <div>• <strong>Kịch bản Email Dynamic:</strong> <span id="mv-email-script" class="font-bold text-indigo-700"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $micro_view_data = [];
    foreach ($rows as $row) {
        $da = !empty($row->deep_analytics) ? json_decode($row->deep_analytics, true) : [];
        $behaviors = !empty($row->behaviors_json) ? json_decode($row->behaviors_json, true) : [];
        $scores = [];
        $total_pss = 0;
        $q5_count = 0;
        
        foreach ($known_groups as $gid => $name) {
            $group_score = 0;
            $items = $behaviors[$gid] ?? [];
            if (is_array($items)) {
                $g_items = $group_items[$gid] ?? [];
                foreach ($items as $item) {
                    $idx = array_search(trim($item), $g_items);
                    if ($idx !== false) {
                        $weight = $idx + 1;
                        $group_score += $weight;
                        if ($weight == 5) {
                            $q5_count++;
                        }
                    }
                }
            }
            $scores[$gid] = $group_score;
            $total_pss += $group_score;
        }
        
        $seoi_score = ($scores['camGiac'] ?? 0) + ($scores['camXuc'] ?? 0) + ($scores['giacNgu'] ?? 0);
        $seoi_pct = round(($seoi_score / 45) * 100);
        
        $rri_numerator = 0;
        if (isset($behaviors['mienDich']) && is_array($behaviors['mienDich'])) {
            $g_items = $group_items['mienDich'] ?? [];
            if (in_array(trim($g_items[4] ?? ''), array_map('trim', $behaviors['mienDich']))) {
                $rri_numerator += 5;
            }
        }
        if (isset($behaviors['giacNgu']) && is_array($behaviors['giacNgu'])) {
            $g_items = $group_items['giacNgu'] ?? [];
            if (in_array(trim($g_items[4] ?? ''), array_map('trim', $behaviors['giacNgu']))) {
                $rri_numerator += 5;
            }
        }
        if (isset($behaviors['tieuHoa']) && is_array($behaviors['tieuHoa'])) {
            $g_items = $group_items['tieuHoa'] ?? [];
            if (in_array(trim($g_items[3] ?? ''), array_map('trim', $behaviors['tieuHoa']))) {
                $rri_numerator += 4;
            }
        }
        $rri_pct = round(($rri_numerator / 14) * 100);
        
        $age_str = $row->child_age;
        $age_months = 0;
        if (preg_match('/(\d+)\s*(?:tuổi|tự\s*kỷ)/', $age_str, $matches)) {
            $age_months = intval($matches[1]) * 12;
        } elseif (preg_match('/(\d+)\s*tháng/', $age_str, $matches)) {
            $age_months = intval($matches[1]);
        } else {
            $age_months = 48;
        }
        
        $alpha = 1.0;
        $age_group_label = '4 - 6 tuổi';
        if ($age_months <= 36) {
            $alpha = 0.8;
            $age_group_label = '0 - 3 tuổi';
        } elseif ($age_months > 72) {
            $alpha = 1.2;
            $age_group_label = 'trên 6 tuổi';
        }
        $pss_adj = round($total_pss * $alpha, 1);
        
        $psych_label = 'Mẹ Mất Hướng';
        $psych_desc = 'Khảo sát lần đầu ➔ Chưa có lộ trình';
        if ($seoi_pct > 50 && $rri_pct > 50) {
            $psych_label = 'Mẹ Kiệt Sức';
            $psych_desc = 'SEOI cao & RRI cao ➔ Cần xoa dịu';
        } elseif ($total_pss > 60) {
            $psych_label = 'Mẹ Hoảng Loạn';
            $psych_desc = 'Số lượng triệu chứng tăng vọt';
        }
        
        $lq_level = 'Lướt qua';
        $lq_class = 'bg-slate-50 text-slate-500 border-slate-200';
        $dp = $da['drop_point'] ?? 'Chưa bắt đầu';
        if ($dp === 'Hoàn thành 100%') {
            $lq_level = 'Tiềm năng';
            $lq_class = 'bg-emerald-50 text-emerald-700 border-emerald-200';
        } elseif ($dp === 'Đang điền thông tin phụ huynh') {
            $lq_level = 'Đang tìm hiểu';
            $lq_class = 'bg-amber-50 text-amber-700 border-amber-200';
        }
        if ($q5_count >= 3) {
            $lq_level = 'HOT LEAD';
            $lq_class = 'bg-red-50 text-red-700 border-red-200';
        }
        
        $axes_activated = [];
        foreach ($known_groups as $k1 => $n1) {
            foreach ($known_groups as $k2 => $n2) {
                if ($k1 !== $k2 && ($scores[$k1] ?? 0) > 0 && ($scores[$k2] ?? 0) > 0) {
                    $axis_name = $n1 . ' x ' . $n2;
                    $sum_pss = ($scores[$k1] ?? 0) + ($scores[$k2] ?? 0);
                    $axes_activated[] = [
                        'name' => $axis_name,
                        'k1' => $k1,
                        'k2' => $k2,
                        'n1' => $n1,
                        'n2' => $n2,
                        'sum_pss' => $sum_pss
                    ];
                }
            }
        }
        usort($axes_activated, function($a, $b) {
            return $b['sum_pss'] - $a['sum_pss'];
        });
        
        $top_axes = array_slice($axes_activated, 0, 2);
        
        $dominos_active = [];
        if (($scores['tieuHoa'] ?? 0) > 0 && ($scores['giacNgu'] ?? 0) > 0 && ($scores['camXuc'] ?? 0) > 0) {
            $dominos_active[] = [
                'code' => 'DOMINO_01',
                'name' => 'Tiêu Hóa ➔ Ngủ ➔ Cảm Xúc',
                'root' => 'TIÊU HÓA (Xoa dịu ruột trước)',
                'script' => 'Cơn la hét 30p của bé không phải do tính xấu, mà do đường ruột đang co thắt dữ dội. Mẹ đang rất bất lực và tự trách.',
                'voice' => 'Đồng cảm, khẳng định "Con không hư - Cơ thể con đang đau".',
                'call_start' => 'Chị ' . ($row->parent_name ?: 'Mai') . ' ơi, em thấy bé ' . ($row->child_name ?: 'Khang') . ' hay đập bụng vào bàn và thức giấc đêm, đây là phản ứng co thắt ruột ngầm...',
                'email' => 'Giải mã Trục Ruột - Não'
            ];
        }
        if (($scores['camGiac'] ?? 0) > 0 && ($scores['anUong'] ?? 0) > 0 && ($scores['mienDich'] ?? 0) > 0) {
            $dominos_active[] = [
                'code' => 'DOMINO_02',
                'name' => 'Giác Quan ➔ Ăn Uống ➔ Miễn Dịch',
                'root' => 'GIÁC QUAN (Trị liệu điều hòa cảm giác khoang miệng)',
                'script' => 'Bé kén ăn do quá tải cảm giác xúc giác/mùi vị ở miệng, dẫn đến thiếu hụt miễn dịch/chất.',
                'voice' => 'Giải thích cơ chế, hướng dẫn bài tập mát-xa miệng.',
                'call_start' => 'Chị ' . ($row->parent_name ?: 'Mai') . ' ơi, em thấy bé nhạy cảm kết cấu thức ăn và hay buồn nôn khi ăn món lạ, đây là do điều hòa giác quan khoang miệng chưa tốt...',
                'email' => 'Bí quyết Kén ăn và Điều hòa Giác quan'
            ];
        }
        if (empty($dominos_active)) {
            $dominos_active[] = [
                'code' => 'DOMINO_01',
                'name' => 'Tiêu Hóa ➔ Ngủ ➔ Cảm Xúc',
                'root' => 'TIÊU HÓA',
                'script' => 'Theo dõi sát sao phản ứng đường ruột ảnh hưởng đến hành vi bùng nổ của bé.',
                'voice' => 'Lắng nghe và khích lệ lộ trình điều trị ruột.',
                'call_start' => 'Chị ' . ($row->parent_name ?: 'Mai') . ' ơi, em thấy bé có điểm nén hệ tiêu hóa khá cao...',
                'email' => 'Bản tin Chăm sóc Hệ Tiêu Hóa và Hệ Thần Kinh'
            ];
        }
        
        $micro_view_data[$row->user_code] = [
            'user_code' => $row->user_code,
            'parent_name' => $row->parent_name ?: 'Chưa rõ',
            'parent_phone' => $row->parent_phone ?: 'Chưa rõ',
            'parent_email' => $row->parent_email ?: 'Chưa rõ',
            'child_name' => $row->child_name ?: 'Chưa rõ',
            'child_age' => $row->child_age ?: 'Chưa rõ',
            'child_gender' => $row->child_gender ?: 'Chưa rõ',
            'child_height' => $row->child_height ?: 'Chưa rõ',
            'child_weight' => $row->child_weight ?: 'Chưa rõ',
            'child_diagnosis' => $row->child_diagnosis ?: 'Chưa rõ',
            'child_therapy' => $row->child_therapy ?: 'Không',
            'child_supplement' => $row->child_supplement ?: 'Không',
            'micro_pss' => $total_pss,
            'pss_adj' => $pss_adj,
            'seoi' => $seoi_pct,
            'rri' => $rri_pct,
            'q5_count' => $q5_count,
            'lead_level' => $lq_level,
            'lead_class' => $lq_class,
            'psych_label' => $psych_label,
            'psych_desc' => $psych_desc,
            'age_group' => $age_group_label,
            'top_axes' => $top_axes,
            'domino' => $dominos_active[0]
        ];
    }
    ?>
    <script>
    window.hieuconMicroViewData = <?php echo json_encode($micro_view_data); ?>;
    </script>

    <!-- Dynamic JS Controllers -->
    <script>
    const state = { activeTab: 'analytics' };
    function switchTab(tabId) {
        state.activeTab = tabId;
        document.querySelectorAll('.tab-content').forEach(el => el.classList.toggle('hidden', el.id !== 'tab-' + tabId));
        document.querySelectorAll('.sidebar-link').forEach(el => {
            const isTarget = el.id === 'link-' + tabId;
            el.classList.toggle('text-brand-600', isTarget);
            el.classList.toggle('bg-brand-50/70', isTarget);
            el.classList.toggle('border-r-4', isTarget);
            el.classList.toggle('border-brand-600', isTarget);
            el.classList.toggle('text-slate-600', !isTarget);
            el.classList.toggle('hover:bg-slate-50', !isTarget);
        });
        if (window.innerWidth < 1024) toggleSidebarDrawer(false);
        setTimeout(() => {
            document.querySelectorAll('canvas').forEach(c => {
                const chart = Chart.getChart(c);
                if (chart) chart.resize();
            });
        }, 50);
    }
    
    function toggleSidebarDrawer(show) {
        const drawer = document.getElementById('sidebar-drawer');
        const backdrop = document.getElementById('sidebar-backdrop');
        const isHidden = drawer.classList.contains('-translate-x-full');
        const shouldShow = show !== undefined ? show : isHidden;
        drawer.classList.toggle('-translate-x-full', !shouldShow);
        backdrop.classList.toggle('hidden', !shouldShow);
    }
    
    function toggleRowDetail(userCode) {
        const detailRow = document.getElementById('detail-row-' + userCode);
        if (!detailRow) return;
        const isHidden = detailRow.style.display === 'none';
        detailRow.style.display = isHidden ? 'table-row' : 'none';
        if (isHidden) setTimeout(() => { lucide.createIcons(); }, 50);
    }
    
    function togglePrevalenceDetail(gid) {
        const detailRow = document.getElementById('prev-detail-' + gid);
        const chevron = document.getElementById('prev-chevron-' + gid);
        if (!detailRow) return;
        const isHidden = detailRow.style.display === 'none';
        detailRow.style.display = isHidden ? 'table-row' : 'none';
        if (chevron) chevron.style.transform = isHidden ? 'rotate(90deg)' : 'rotate(0deg)';
        if (isHidden) setTimeout(() => { lucide.createIcons(); }, 50);
    }
    
    function togglePrevalenceSubTab(tab) {
        const btnAnalysis = document.getElementById('subtab-btn-analysis');
        const btnFrequency = document.getElementById('subtab-btn-frequency');
        const contentAnalysis = document.getElementById('subtab-content-analysis');
        const contentFrequency = document.getElementById('subtab-content-frequency');
        if (!btnAnalysis || !btnFrequency || !contentAnalysis || !contentFrequency) return;
        
        if (tab === 'analysis') {
            btnAnalysis.classList.add('border-[#002795]', 'text-[#002795]');
            btnAnalysis.classList.remove('border-transparent', 'text-slate-500', 'hover:text-slate-800');
            btnFrequency.classList.add('border-transparent', 'text-slate-500', 'hover:text-slate-800');
            btnFrequency.classList.remove('border-[#002795]', 'text-[#002795]');
            contentAnalysis.classList.remove('hidden');
            contentFrequency.classList.add('hidden');
        } else {
            btnFrequency.classList.add('border-[#002795]', 'text-[#002795]');
            btnFrequency.classList.remove('border-transparent', 'text-slate-500', 'hover:text-slate-800');
            btnAnalysis.classList.add('border-transparent', 'text-slate-500', 'hover:text-slate-800');
            btnAnalysis.classList.remove('border-[#002795]', 'text-[#002795]');
            contentFrequency.classList.remove('hidden');
            contentAnalysis.classList.add('hidden');
        }
    }
    
    function openMicroViewModal(userCode) {
        const data = window.hieuconMicroViewData[userCode];
        if (!data) return;
        
        document.getElementById('mv-header-child-name').innerText = data.child_name + ' (Mã: ' + data.user_code + ')';
        document.getElementById('mv-parent-info').innerHTML = data.parent_name + ' (' + data.parent_phone + ') | Email: ' + data.parent_email;
        document.getElementById('mv-child-info').innerHTML = data.child_name + ' (' + data.child_age + ' / ' + data.child_gender + ') | Chẩn đoán: ' + data.child_diagnosis + ' | Cao: ' + data.child_height + 'cm, Nặng: ' + data.child_weight + 'kg';
        
        const leadTag = document.getElementById('mv-lead-tag');
        leadTag.innerText = data.lead_level + ': ' + (data.lead_level === 'HOT LEAD' ? 'HIGH PRIORITY' : 'NORMAL') + ' (Có ' + data.q5_count + ' câu Q5 bùng nổ)';
        leadTag.className = 'inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border border-solid ' + data.lead_class;
        
        document.getElementById('mv-psych-cluster').innerHTML = data.psych_label + ' (SEOI: ' + data.seoi + '% | RRI: ' + data.rri + '%)';
        
        const axis1 = data.top_axes[0];
        if (axis1) {
            document.getElementById('mv-axis-rate-1').innerText = 'Tỷ lệ nén: ' + Math.round(data.pss_adj) + '%';
            document.getElementById('mv-axis-name-1').innerHTML = '<strong>Trục Gốc Rễ Nổi Trội #1:</strong> AXIS_' + axis1.k1 + '_' + axis1.k2 + ' (' + axis1.name + ')';
            document.getElementById('mv-axis-reading-1').innerText = getAxisReading(axis1.k1, axis1.k2);
        } else {
            document.getElementById('mv-axis-rate-1').innerText = '';
            document.getElementById('mv-axis-name-1').innerText = 'Không phát hiện trục nổi trội.';
            document.getElementById('mv-axis-reading-1').innerText = 'N/A';
        }
        
        const axis2 = data.top_axes[1];
        if (axis2) {
            document.getElementById('mv-axis-rate-2').innerText = 'Tỷ lệ nén: ' + Math.round(data.pss_adj * 0.85) + '%';
            document.getElementById('mv-axis-name-2').innerHTML = '<strong>Trục Gốc Rễ Nổi Trội #2:</strong> AXIS_' + axis2.k1 + '_' + axis2.k2 + ' (' + axis2.name + ')';
            document.getElementById('mv-axis-reading-2').innerText = getAxisReading(axis2.k1, axis2.k2);
        } else {
            document.getElementById('mv-axis-rate-2').innerText = '';
            document.getElementById('mv-axis-name-2').innerText = 'Không phát hiện trục thứ hai.';
            document.getElementById('mv-axis-reading-2').innerText = 'N/A';
        }
        
        document.getElementById('mv-domino-code').innerText = data.domino.code;
        document.getElementById('mv-domino-name').innerHTML = '<strong>Chuỗi Domino Bệnh Lý:</strong> ' + data.domino.name;
        document.getElementById('mv-domino-root').innerText = data.domino.root;
        
        document.getElementById('mv-voice').innerText = data.domino.voice;
        document.getElementById('mv-call-script').innerText = '"' + data.domino.call_start + '"';
        document.getElementById('mv-email-script').innerText = 'Đẩy luồng Email ' + data.domino.email + '.';
        
        const modal = document.getElementById('microViewModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        
        setTimeout(() => { lucide.createIcons(); }, 50);
    }
    
    function closeMicroViewModal() {
        const modal = document.getElementById('microViewModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
    
    function getAxisReading(k1, k2) {
        const keys = [k1, k2].sort();
        const key = keys[0] + '_' + keys[1];
        const readings = {
            'camGiac_tieuHoa': 'Cơn la hét 30p của bé KHÔNG PHẢI do tính xấu, mà do đường ruột đang co thắt dữ dội (đập bụng vào bàn). Mẹ đang rất bất lực và tự trách.',
            'camGiac_giacNgu': 'Thần kinh không tống xuất được kích thích ban ngày ➔ Trằn trọc > 60p.',
            'anUong_camGiac': 'Bé kén ăn do quá tải cảm giác xúc giác/mùi vị ở miệng. Tránh ép ăn để giảm hành vi chống đối.',
            'giacNgu_tieuHoa': 'Đầy bụng, chướng khí và trào ngược âm thầm gây giật mình khóc đêm.',
            'camXuc_giacNgu': 'Thiếu ngủ kéo dài làm cạn kiệt năng lượng phục hồi của não, tăng tần suất bùng nổ hành vi.',
            'mienDich_camGiac': 'Phản ứng dị ứng hoặc viêm hệ thống làm da ngứa ngáy, tăng nhạy cảm giác quan.',
            'mienDich_giacNgu': 'Nghẹt mũi, ngưng thở khi ngủ do amidan/viêm VA phì đại gây thiếu oxy não.',
            'anUong_tieuHoa': 'Đường ruột bị tổn thương hoặc táo bón mãn tính làm trẻ chán ăn, ăn ngậm lâu.'
        };
        return readings[key] || 'Trẻ gặp phải các dấu hiệu đồng kích hoạt gây áp lực kép lên hệ vận động và hành vi.';
    }
    
    function filterDashboardTable() {
        const q = document.getElementById('dashboardSearch').value.toLowerCase().trim();
        const dev = document.getElementById('deviceFilter').value;
        const status = document.getElementById('statusFilter').value;
        const lead = document.getElementById('leadFilter').value;
        
        document.querySelectorAll('#submissionsTable tbody tr').forEach(r => {
            if (r.id && r.id.startsWith('prev-detail-')) return;
            if (r.id && r.id.startsWith('detail-row-')) {
                r.style.display = 'none';
                return;
            }
            const txt = r.getAttribute('data-search') || '';
            const rDev = r.getAttribute('data-device') || '';
            const rStatus = r.getAttribute('data-status') || '';
            const rLead = r.getAttribute('data-lead') || '';
            
            const match = (!q || txt.includes(q)) && 
                          (dev === 'all' || rDev === dev) && 
                          (status === 'all' || rStatus === status) && 
                          (lead === 'all' || rLead === lead);
            
            r.style.display = match ? '' : 'none';
        });
    }
    
    function openResultModal(code, auth) {
        document.getElementById('modalLoading').style.display = 'flex';
        document.getElementById('resultIframe').src = '<?php echo esc_js(site_url('/ket-qua-bo-cong-cu-nhan-dien-suc-khoe-thuong-gap')); ?>?code=' + code + '&auth=' + auth + '&iframe=1';
        document.getElementById('resultModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeResultModal() {
        document.getElementById('resultModal').style.display = 'none';
        document.getElementById('resultIframe').src = '';
        document.body.style.overflow = '';
    }
    
    function confirmGenerateMock() {
        if (confirm("Tạo 50 kết quả trắc nghiệm mẫu để kiểm thử?")) {
            window.location.href = window.location.pathname + "?generate_mock=1";
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        
        // Generate chart datasets in PHP
        <?php
        $days = 30;
        $chart_labels = [];
        $chart_views = [];
        $chart_submissions = [];
        $chart_conversions = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date_str = date('Y-m-d', strtotime("-$i days"));
            $chart_labels[] = date('d/m', strtotime("-$i days"));
            
            $views_day = 0;
            $submissions_day = 0;
            $conversions_day = 0;
            
            foreach ($rows as $r) {
                if (date('Y-m-d', strtotime($r->created_at)) === $date_str) {
                    $da = !empty($r->deep_analytics) ? json_decode($r->deep_analytics, true) : [];
                    $views_day += intval($da['pageviews'] ?? 1);
                    $submissions_day++;
                    if (!empty($r->scores_json)) {
                        $conversions_day++;
                    }
                }
            }
            $chart_views[] = $views_day;
            $chart_submissions[] = $submissions_day;
            $chart_conversions[] = $conversions_day;
        }
        ?>

        const chartData30 = {
            labels: <?php echo json_encode($chart_labels); ?>,
            views: <?php echo json_encode($chart_views); ?>,
            submissions: <?php echo json_encode($chart_submissions); ?>,
            conversions: <?php echo json_encode($chart_conversions); ?>
        };

        const chartDataToday = {
            labels: <?php echo json_encode($today_hourly_labels); ?>,
            views: <?php echo json_encode($today_hourly_views); ?>,
            submissions: <?php echo json_encode($today_hourly_submissions); ?>,
            conversions: <?php echo json_encode($today_hourly_conversions); ?>
        };

        window.visitorChartInstance = null;
        window.marketingChartInstance = null;

        window.changeChartPeriod = function(days) {
            ['1', '7', '30'].forEach(d => {
                const btn = document.getElementById('btn-period-' + d);
                if (btn) {
                    if (d === days) {
                        btn.className = "px-3 py-1 text-[10px] font-bold rounded-lg transition-all border-none bg-brand-600 text-white shadow-sm cursor-pointer";
                    } else {
                        btn.className = "px-3 py-1 text-[10px] font-bold rounded-lg transition-all border-none bg-transparent text-slate-600 hover:text-slate-900 cursor-pointer";
                    }
                }
            });

            const numDays = parseInt(days);
            let labels = [];
            let views = [];
            let submissions = [];
            let conversions = [];

            if (numDays === 1) {
                labels = [...chartDataToday.labels];
                views = [...chartDataToday.views];
                submissions = [...chartDataToday.submissions];
                conversions = [...chartDataToday.conversions];
            } else if (numDays === 7) {
                labels = chartData30.labels.slice(-7);
                views = chartData30.views.slice(-7);
                submissions = chartData30.submissions.slice(-7);
                conversions = chartData30.conversions.slice(-7);
            } else {
                labels = [...chartData30.labels];
                views = [...chartData30.views];
                submissions = [...chartData30.submissions];
                conversions = [...chartData30.conversions];
            }

            if (window.visitorChartInstance) {
                window.visitorChartInstance.data.labels = labels;
                window.visitorChartInstance.data.datasets[0].data = views;
                window.visitorChartInstance.data.datasets[1].data = submissions;
                window.visitorChartInstance.update();
            }
            if (window.marketingChartInstance) {
                window.marketingChartInstance.data.labels = labels;
                window.marketingChartInstance.data.datasets[0].data = views;
                window.marketingChartInstance.data.datasets[1].data = conversions;
                window.marketingChartInstance.update();
            }
        }

        const opt = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { boxWidth: 10, font: { size: 10, family: 'Outfit' } } } }
        };
        
        const visitorCtx = document.getElementById('visitorChart');
        if (visitorCtx) {
            window.visitorChartInstance = new Chart(visitorCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($chart_labels); ?>,
                    datasets: [
                        { label: 'Lượt Xem', data: <?php echo json_encode($chart_views); ?>, backgroundColor: '#3641f5', borderRadius: 4 },
                        { label: 'Bài Trắc Nghiệm', data: <?php echo json_encode($chart_submissions); ?>, backgroundColor: '#c2d6ff', borderRadius: 4 }
                    ]
                },
                options: opt
            });
        }
        
        const marketingCtx = document.getElementById('marketingChart');
        if (marketingCtx) {
            window.marketingChartInstance = new Chart(marketingCtx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($chart_labels); ?>,
                    datasets: [
                        { label: 'Truy Cập (Views)', data: <?php echo json_encode($chart_views); ?>, borderColor: '#3641f5', tension: 0.3, fill: false },
                        { label: 'Chuyển Đổi (Leads)', data: <?php echo json_encode($chart_conversions); ?>, borderColor: '#10b981', tension: 0.3, fill: false }
                    ]
                },
                options: opt
            });
        }

        const activeCtx = document.getElementById('activeUsersChart');
        if (activeCtx) {
            new Chart(activeCtx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($today_hourly_labels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($today_hourly_views); ?>,
                        borderColor: '#3641f5',
                        borderWidth: 2,
                        tension: 0.45,
                        fill: true,
                        backgroundColor: 'rgba(54, 65, 245, 0.08)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: true } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        point: { radius: 0, hoverRadius: 4 }
                    }
                }
            });
        }
        
        const makeDonut = (id, labels, data, colors) => {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{ data: data, backgroundColor: colors, borderWidth: 0 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 9, family: 'Outfit' } } } }
                }
            });
        };
        
        makeDonut('deviceTypeChart', <?php echo json_encode(array_keys($stat_types)); ?>, <?php echo json_encode(array_values($stat_types)); ?>, ['#3641f5', '#0ea5e9', '#f59e0b', '#94a3b8']);
        makeDonut('deviceOsChart', <?php echo json_encode(array_keys($stat_oss)); ?>, <?php echo json_encode(array_values($stat_oss)); ?>, ['#ef4444', '#3641f5', '#10b981', '#8b5cf6', '#f59e0b', '#ec4899']);
        makeDonut('browserChart', <?php echo json_encode(array_keys($stat_browsers)); ?>, <?php echo json_encode(array_values($stat_browsers)); ?>, ['#0284c7', '#ea580c', '#3641f5', '#4f46e5', '#16a34a', '#475569']);
        
        const prevCtx = document.getElementById('prevalenceChart');
        if (prevCtx) {
            new Chart(prevCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_values(array_map(function($g) { return $g['name']; }, $group_prevalence))); ?>,
                    datasets: [{
                        data: <?php echo json_encode(array_values(array_map(function($g) { return $g['avg_pct']; }, $group_prevalence))); ?>,
                        backgroundColor: '#3641f5',
                        borderRadius: 4
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { min: 0, max: 100, ticks: { callback: v => v + '%', font: { size: 9 } } },
                        y: { ticks: { font: { size: 9, weight: 'bold' } } }
                    }
                }
            });
        }

        const prevOverviewCtx = document.getElementById('prevalenceChartOverview');
        if (prevOverviewCtx) {
            new Chart(prevOverviewCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_values(array_map(function($g) { return $g['name']; }, $group_prevalence))); ?>,
                    datasets: [{
                        data: <?php echo json_encode(array_values(array_map(function($g) { return $g['avg_pct']; }, $group_prevalence))); ?>,
                        backgroundColor: '#4f46e5',
                        borderRadius: 4
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { min: 0, max: 100, ticks: { callback: v => v + '%', font: { size: 9 } } },
                        y: { ticks: { font: { size: 9, weight: 'bold' } } }
                    }
                }
            });
        }

        // 1. Radar Chart for deep health overview
        const radarCtx = document.getElementById('analysisRadarChart');
        if (radarCtx) {
            new Chart(radarCtx, {
                type: 'radar',
                data: {
                    labels: <?php echo json_encode(array_values(array_map(function($g) { return $g['name']; }, $group_prevalence))); ?>,
                    datasets: [{
                        label: 'Tỷ lệ gặp phải (%)',
                        data: <?php echo json_encode(array_values(array_map(function($g) { return $g['avg_pct']; }, $group_prevalence))); ?>,
                        backgroundColor: 'rgba(79, 70, 229, 0.2)',
                        borderColor: '#4f46e5',
                        borderWidth: 2,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#4f46e5'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        r: {
                            angleLines: { color: '#e2e8f0' },
                            grid: { color: '#e2e8f0' },
                            pointLabels: { font: { size: 9, family: 'Outfit', weight: 'bold' }, color: '#475569' },
                            ticks: { display: false },
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }
                }
            });
        }

        // 2. Doughnut Chart for Mother Psychology
        const psychCtx = document.getElementById('analysisPsychDoughnut');
        if (psychCtx) {
            const psychData = <?php echo json_encode($insights['psychology_distribution']); ?>;
            new Chart(psychCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(psychData),
                    datasets: [{
                        data: Object.values(psychData),
                        backgroundColor: ['#ef4444', '#f59e0b', '#4f46e5'],
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                font: { size: 10, family: 'Outfit' },
                                color: '#475569',
                                padding: 15
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        }
        
        // Trigger resize to fix Chart.js width issue on tabs
        setTimeout(() => {
            const chartsToResize = ['analysisRadarChart', 'analysisPsychDoughnut'];
            chartsToResize.forEach(id => {
                const c = document.getElementById(id);
                if (c) {
                    const chart = Chart.getChart(c);
                    if (chart) chart.resize();
                }
            });
        }, 300);
        
        });
    </script>
</body>
</html>
<?php
exit;
}

