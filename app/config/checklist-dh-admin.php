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
        parent_name varchar(255) NOT NULL DEFAULT '',
        parent_phone varchar(50) NOT NULL DEFAULT '',
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
    add_menu_page(
        'Checklist DocumentingHope',
        'Checklist DocumentingHope',
        'manage_options',
        'hieucon-dh-checklist',
        'hieucon_dh_checklist_admin_page',
        'dashicons-clipboard',
        31
    );
}
add_action('admin_menu', 'hieucon_dh_checklist_admin_menu');

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
    
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 500");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Checklist DocumentingHope</h1>
        <a href="<?php echo admin_url('admin-post.php?action=hieucon_dh_export_csv'); ?>" class="page-title-action">Xuất CSV toàn bộ dữ liệu</a>
        <p>Danh sách khách hàng đã điền Checklist Toàn Diện (DocumentingHope).</p>
        
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
                            <td><?php echo esc_html($row->parent_name); ?></td>
                            <td><?php echo esc_html($row->parent_phone); ?></td>
                            <td>
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
                                <a href="<?php echo esc_url(site_url('/ket-qua-dh?code=' . $row->user_code)); ?>" target="_blank" class="button button-primary">Xem chi tiết</a>
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
        'parent_name' => $parent_name,
        'parent_phone' => $parent_phone,
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
        $server_ip = $_SERVER['REMOTE_ADDR'];
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

    $existing = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE user_code = %s", $user_code));

    if ($existing) {
        $wpdb->update($table_name, $data, ['user_code' => $user_code]);
    } else {
        $data['user_code'] = $user_code;
        $wpdb->insert($table_name, $data);
    }

    wp_send_json_success(['user_code' => $user_code]);
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
        'ID', 'Mã KH', 'Phụ huynh', 'SĐT', 'Tuổi', 'Chẩn đoán hiện tại', 'Đang can thiệp', 'Sản phẩm hỗ trợ', 
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
            $row->parent_name,
            $row->parent_phone,
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
    if ( strpos($_SERVER['REQUEST_URI'], '/ket-qua-dh') !== 0 || !isset($_GET['code']) ) return;

    $code = sanitize_text_field($_GET['code']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_dh_checklists';
    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE user_code = %s", $code));

    if (!$row) {
        get_header();
        echo '<div style="padding:40px; text-align:center; font-family:sans-serif; color:#b91c1c;">Không tìm thấy kết quả cho mã hồ sơ này.</div>';
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
      <style>
        :root {
          --navy: #002795;
          --yellow: #FFD154;
          --charcoal: #1e293b;
          --bg-body: #f1f5f9;
          --white: #FFFFFF;
          --gray: #64748b;
          --border: #e2e8f0;
          --shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
          --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.03);
        }

        body {
          margin: 0;
          font-family: 'Be Vietnam Pro', sans-serif;
          background: var(--bg-body);
          color: var(--charcoal);
          line-height: 1.5;
        }

        .dashboard-header {
          background: var(--navy);
          color: var(--white);
        }
        .dashboard-header-inner {
          max-width: 1200px;
          margin: 0 auto;
          padding: 16px 20px;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .dashboard-header h1 {
          font-size: 18px;
          margin: 0;
          font-weight: 700;
        }

        .dashboard-header .badge {
          background: var(--yellow);
          color: var(--navy);
          font-size: 11px;
          font-weight: 700;
          padding: 4px 12px;
          border-radius: 12px;
          text-transform: uppercase;
        }

        .dashboard-container {
          max-width: 1320px;
          margin: 24px auto;
          padding: 0 16px;
          display: grid;
          grid-template-columns: 360px 1fr;
          gap: 24px;
          align-items: start;
        }

        .panel {
          background: var(--white);
          border-radius: 12px;
          box-shadow: var(--shadow);
          padding: 20px;
          margin-bottom: 24px;
        }

        .panel-title {
          font-size: 15px;
          font-weight: 700;
          color: var(--navy);
          margin: 0 0 16px;
          padding-bottom: 12px;
          border-bottom: 1px solid var(--border);
          text-transform: uppercase;
          letter-spacing: 0.5px;
        }

        /* Thông tin khách hàng */
        .info-list {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 12px;
        }
        .info-item p {
          font-size: 11px;
          color: var(--gray);
          text-transform: uppercase;
          margin: 0 0 2px;
        }
        .info-item h3 {
          font-size: 14px;
          color: var(--charcoal);
          margin: 0;
          font-weight: 700;
        }

        .disclaimer {
          background: #fffbeb;
          border: 1px solid #fcd34d;
          padding: 12px;
          border-radius: 8px;
          font-size: 12px;
          color: #92400e;
          margin-top: 16px;
        }

        /* Thống kê */
        .score-item {
          margin-bottom: 14px;
        }
        .score-header {
          display: flex;
          justify-content: space-between;
          font-size: 13px;
          margin-bottom: 4px;
          font-weight: 600;
        }
        .score-bar-bg {
          height: 6px;
          background: #f1f5f9;
          border-radius: 6px;
          overflow: hidden;
        }
        .score-bar-fill {
          height: 100%;
          background: var(--navy);
          border-radius: 6px;
        }

        /* Chi tiết */
        .masonry-grid {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
          gap: 16px;
        }
        .b-group {
          background: #f8fafc;
          border: 1px solid var(--border);
          border-radius: 8px;
          padding: 12px;
        }
        .b-group h4 {
          font-size: 14px;
          color: var(--navy);
          margin: 0 0 10px;
          padding-bottom: 8px;
          border-bottom: 1px dashed #cbd5e1;
        }
        .b-list {
          list-style: none;
          padding: 0;
          margin: 0;
        }
        .b-list li {
          font-size: 13px;
          color: #334155;
          margin-bottom: 6px;
          padding-left: 18px;
          position: relative;
        }
        .b-list li:last-child {
          margin-bottom: 0;
        }
        .b-list li::before {
          content: '✓';
          position: absolute;
          left: 0;
          color: #d97706;
          font-weight: 900;
        }

        @media(max-width: 992px) {
          .dashboard-container {
            grid-template-columns: 1fr;
          }
        }
      </style>

      <div class="dashboard-header">
        <div class="dashboard-header-inner" style="justify-content: center; text-align: center;">
          <h1 style="margin: 0; font-size: 16px; font-weight: 600;">Bảng ghi dấu hiệu dựa trên dữ liệu phụ huynh cung cấp.</h1>
        </div>
      </div>

      <div class="dashboard-container">
        <!-- Cột Trái: Thông tin & Thống kê -->
        <div class="col-left">
          <div class="panel">
            <h2 class="panel-title">Thông Tin Hồ Sơ</h2>
            <div class="info-list">
              <div class="info-item">
                <p>Mã hồ sơ</p>
                <h3>#<?php echo esc_html($row->user_code); ?></h3>
              </div>
              <div class="info-item">
                <p>Ngày ghi nhận</p>
                <h3><?php echo esc_html($updated); ?></h3>
              </div>
              <div class="info-item">
                <p>Phụ huynh</p>
                <h3><?php echo $name; ?></h3>
              </div>
              <div class="info-item">
                <p>Tuổi của con</p>
                <h3><?php echo esc_html($row->child_age); ?></h3>
              </div>
              <div class="info-item">
                <p>Giới tính</p>
                <h3><?php echo esc_html($row->child_gender ? $row->child_gender : '---'); ?></h3>
              </div>
              <div class="info-item">
                <p>Chiều cao</p>
                <h3><?php echo esc_html($row->child_height ? $row->child_height . ' cm' : '---'); ?></h3>
              </div>
              <div class="info-item">
                <p>Cân nặng</p>
                <h3><?php echo esc_html($row->child_weight ? $row->child_weight . ' kg' : '---'); ?></h3>
              </div>
              <div class="info-item">
                <p>Chỉ số BMI</p>
                <?php
                  $bmi_text = '---';
                  $bmi_color = 'var(--charcoal)';
                  if ($row->child_height && $row->child_weight) {
                      $h_m = floatval($row->child_height) / 100;
                      $w = floatval($row->child_weight);
                      if ($h_m > 0 && $h_m < 3 && $w > 0 && $w < 300) {
                          $bmi = round($w / ($h_m * $h_m), 1);
                          
                          // Logic tính BMI chuẩn theo tuổi và giới tính (Percentile WHO/CDC)
                          $status = '';
                          $bmi_color = '';
                          $ageYears = 2;
                          // Parse age from string (e.g. "3 tuổi 2 tháng" or "18 tháng tuổi")
                          if (preg_match('/(\d+)\s*tuổi/', $row->child_age, $matches)) {
                              $ageYears = intval($matches[1]);
                          } elseif (preg_match('/(\d+)\s*tháng/', $row->child_age, $matches)) {
                              $ageYears = floor(intval($matches[1]) / 12);
                          }
                          if ($ageYears < 2) $ageYears = 2;
                          if ($ageYears > 19) $ageYears = 19;

                          $gender = $row->child_gender;
                          
                          $cdc = [
                              'Bé trai' => [
                                  2=>[14.8, 18.2, 19.3], 3=>[14.4, 17.4, 18.3], 4=>[14.0, 16.9, 17.8], 5=>[13.8, 16.8, 18.0], 6=>[13.7, 17.0, 18.5], 7=>[13.7, 17.4, 19.2], 8=>[13.8, 18.0, 20.1], 9=>[14.0, 18.8, 21.2], 10=>[14.2, 19.6, 22.4], 11=>[14.6, 20.6, 23.6], 12=>[15.0, 21.5, 24.8], 13=>[15.5, 22.5, 25.9], 14=>[16.0, 23.3, 26.9], 15=>[16.5, 24.1, 27.7], 16=>[17.0, 24.8, 28.3], 17=>[17.5, 25.4, 28.8], 18=>[17.9, 25.9, 29.2], 19=>[18.3, 26.4, 29.5]
                              ],
                              'Bé gái' => [
                                  2=>[14.4, 18.0, 19.1], 3=>[14.0, 17.2, 18.3], 4=>[13.7, 16.8, 18.0], 5=>[13.5, 16.8, 18.2], 6=>[13.4, 17.1, 18.8], 7=>[13.4, 17.6, 19.6], 8=>[13.5, 18.3, 20.6], 9=>[13.8, 19.1, 21.7], 10=>[14.0, 20.0, 22.9], 11=>[14.4, 21.0, 24.1], 12=>[14.8, 22.0, 25.3], 13=>[15.3, 22.9, 26.3], 14=>[15.8, 23.8, 27.2], 15=>[16.3, 24.5, 28.0], 16=>[16.8, 25.1, 28.6], 17=>[17.1, 25.5, 29.1], 18=>[17.4, 25.9, 29.5], 19=>[17.7, 26.2, 29.8]
                              ]
                          ];

                          $p5 = 18.5; $p85 = 23.0; $p95 = 25.0; // Fallback
                          if (isset($cdc[$gender][$ageYears])) {
                              $bounds = $cdc[$gender][$ageYears];
                              $p5 = $bounds[0]; $p85 = $bounds[1]; $p95 = $bounds[2];
                          }

                          if ($bmi < $p5) {
                              $status = 'Thiếu cân';
                              $bmi_color = '#d97706'; // Vàng đậm
                          } elseif ($bmi >= $p5 && $bmi < $p85) {
                              $status = 'Bình thường';
                              $bmi_color = '#15803d'; // Xanh lá
                          } elseif ($bmi >= $p85 && $bmi < $p95) {
                              $status = 'Thừa cân';
                              $bmi_color = '#c2410c'; // Cam
                          } else {
                              $status = 'Béo phì';
                              $bmi_color = '#b91c1c'; // Đỏ
                          }
                          $bmi_text = $bmi . ' (' . $status . ')';
                      }
                  }
                ?>
                <h3 style="color: <?php echo $bmi_color; ?>"><?php echo esc_html($bmi_text); ?></h3>
              </div>
            </div>
            <div class="disclaimer">
              <strong>Lưu ý:</strong> Bảng đánh giá dựa trên dữ liệu phụ huynh cung cấp. Không thay thế chẩn đoán y tế chuyên khoa.
            </div>
          </div>

          <?php if (!empty($scores)): 
            usort($scores, function($a, $b) { return $b['pct'] <=> $a['pct']; });
          ?>
          <div class="panel">
            <h2 class="panel-title">Các vấn đề cần ưu tiên</h2>
            <div style="font-size:12px; color:#b91c1c; background:#fef2f2; padding:8px 12px; border-radius:6px; margin-bottom:16px; border:1px solid #fecaca;">
              ⚠️ <strong>Lưu ý:</strong> Màu đỏ là ba nhóm vấn đề con cần được quan tâm hỗ trợ sớm.
            </div>
            <?php 
            $count = 0;
            foreach ($scores as $sg): 
              $is_top = ($count < 3 && $sg['pct'] > 0);
              $bar_color = $is_top ? '#e11d48' : 'var(--navy)';
              $wrap_style = $is_top ? 'background:#fff1f2; padding:10px 12px; border-radius:8px; border:1px dashed #fda4af; margin-bottom:12px;' : 'margin-bottom:14px;';
              $text_color = $is_top ? '#be123c' : 'inherit';
              $icon = $is_top ? '🚨 ' : '';
            ?>
              <div class="score-item" style="<?php echo $wrap_style; ?>">
                <div class="score-header">
                  <span style="color:<?php echo $text_color; ?>; font-weight:<?php echo $is_top ? '700' : '600'; ?>;"><?php echo $icon . esc_html($sg['name']); ?></span>
                  <span style="color:<?php echo $bar_color; ?>; font-weight:700;"><?php echo intval($sg['ticked']).'/'.intval($sg['total']); ?> (<?php echo intval($sg['pct']); ?>%)</span>
                </div>
                <div class="score-bar-bg">
                  <div class="score-bar-fill" style="width:<?php echo intval($sg['pct']); ?>%; background:<?php echo $bar_color; ?>;"></div>
                </div>
              </div>
            <?php 
              $count++;
            endforeach; 
            ?>
          </div>
          <?php endif; ?>

          <div style="text-align:center; margin-top:16px;">
            <a href="https://m.me/884864428052710?ref=1002533683" target="_blank" style="display:inline-block; width:100%; background:var(--navy); color:var(--white); font-weight:700; padding:12px; border-radius:8px; text-decoration:none; font-size:14px; margin-bottom:12px;">💬 Liên hệ chuyên gia</a>
            
            <button onclick="copyResultLink()" style="display:inline-block; width:100%; background:#f8fafc; color:var(--navy); font-weight:700; padding:12px; border-radius:8px; border:1px solid var(--border); font-size:14px; cursor:pointer; font-family:'Be Vietnam Pro', sans-serif; transition: background 0.2s;">🔗 Link kết quả</button>
            <p style="font-size:11.5px; color:var(--gray); margin:6px 0 0;">(Copy link kết quả để gửi cho chuyên gia tư vấn)</p>
          </div>
        </div>

        <!-- Cột Phải: Chi tiết dấu hiệu -->
        <div class="col-right">
          <?php if (!empty($behaviors)): ?>
          <div class="panel" style="box-shadow: var(--shadow-lg);">
            <h2 class="panel-title">Chi Tiết Dấu Hiệu Ghi Nhận</h2>
            <div class="masonry-grid">
            <?php foreach ($scores as $sg): 
                $items = isset($behaviors[$sg['id']]) ? $behaviors[$sg['id']] : (isset($behaviors[$sg['name']]) ? $behaviors[$sg['name']] : []);
                if (empty($items)) continue;
            ?>
              <div class="b-group">
                <h4><?php echo esc_html(isset($sg['icon']) ? $sg['icon'].' ' : '') . esc_html($sg['name']); ?></h4>
                <ul class="b-list">
                  <?php foreach ($items as $item): ?>
                    <li><?php echo esc_html($item); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($row->extra_symptoms)): ?>
          <div class="panel">
            <h2 class="panel-title">Ghi chú khác từ phụ huynh</h2>
            <p style="font-size:13px; color:#475569; white-space:pre-wrap; margin:0;"><?php echo esc_html($row->extra_symptoms); ?></p>
          </div>
          <?php endif; ?>
          
          <p style="text-align:center; font-size:12px; color:var(--gray); margin-top:24px;">© <?php echo date('Y'); ?> Hiểu Con Từ Gốc.</p>
        </div>
      </div>

      <div id="copy-toast" style="visibility: hidden; min-width: 300px; max-width:400px; background-color: var(--navy); color: #fff; text-align: center; border-radius: 12px; padding: 24px; position: fixed; z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0.9); box-shadow: 0 10px 40px rgba(0,0,0,0.2); font-size: 15px; opacity: 0; transition: opacity 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <div style="font-size:32px; margin-bottom:12px;">✅</div>
        <strong>Đã copy link thành công!</strong><br>
        <div style="opacity:0.9; font-size: 13.5px; margin-top:8px; line-height:1.5;">Hãy gửi link này cho Trợ Lý Nam Khánh hoặc lưu lại link để xem lại kết quả vào lần sau nhé!</div>
      </div>

      <script>
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
      </script>
    <?php
    get_footer();
    exit;
}
