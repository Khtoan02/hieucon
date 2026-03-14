<?php
/**
 * Checklist Tracking & Admin Page
 */

// 1. Install Custom Table
function hieucon_install_checklist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_checklists';
    $charset_collate = $wpdb->get_charset_collate();

    // Tạo bảng nếu chưa có (đầy đủ schema)
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        session_id varchar(100) NOT NULL,
        parent_name varchar(255) NOT NULL DEFAULT '',
        parent_phone varchar(50) NOT NULL DEFAULT '',
        read_all tinyint(1) NOT NULL DEFAULT 0,
        behaviors text NOT NULL DEFAULT '',
        contact_method text NOT NULL DEFAULT '',
        time_spent int(11) NOT NULL DEFAULT 0,
        next_action varchar(255) NOT NULL DEFAULT '',
        furthest_step int(11) NOT NULL DEFAULT 0,
        result_level varchar(255) NOT NULL DEFAULT '',
        result_score varchar(50) NOT NULL DEFAULT '',
        result_groups varchar(50) NOT NULL DEFAULT '',
        device_info text DEFAULT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        UNIQUE KEY session_id (session_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $existing_cols = $wpdb->get_col( "SHOW COLUMNS FROM $table_name", 0 );
    $migrations = [
        'furthest_step' => "ALTER TABLE $table_name ADD COLUMN furthest_step int(11) NOT NULL DEFAULT 0 AFTER next_action",
        'result_level'  => "ALTER TABLE $table_name ADD COLUMN result_level varchar(255) NOT NULL DEFAULT '' AFTER furthest_step",
        'result_score'  => "ALTER TABLE $table_name ADD COLUMN result_score varchar(50) NOT NULL DEFAULT '' AFTER result_level",
        'result_groups' => "ALTER TABLE $table_name ADD COLUMN result_groups varchar(50) NOT NULL DEFAULT '' AFTER result_score",
        'device_info'       => "ALTER TABLE $table_name ADD COLUMN device_info text DEFAULT NULL AFTER result_groups",
        'result_title'      => "ALTER TABLE $table_name ADD COLUMN result_title varchar(255) NOT NULL DEFAULT '' AFTER result_groups",
        'result_body'       => "ALTER TABLE $table_name ADD COLUMN result_body text DEFAULT NULL AFTER result_title",
        'result_badge'      => "ALTER TABLE $table_name ADD COLUMN result_badge varchar(10) NOT NULL DEFAULT '' AFTER result_body",
        'scores_json'       => "ALTER TABLE $table_name ADD COLUMN scores_json text DEFAULT NULL AFTER result_badge",
        'result_snapshot'   => "ALTER TABLE $table_name ADD COLUMN result_snapshot mediumtext DEFAULT NULL AFTER scores_json",
    ];
    foreach ( $migrations as $col => $alter_sql ) {
        if ( ! in_array( $col, $existing_cols ) ) {
            $wpdb->query( $alter_sql );
        }
    }
}
add_action('after_setup_theme', 'hieucon_install_checklist_table');

// 2. Register Admin Menu
function hieucon_checklist_admin_menu() {
    add_menu_page(
        'Kết quả Check list',
        'Kết quả Check list',
        'manage_options',
        'hieucon-checklist',
        'hieucon_checklist_admin_page',
        'dashicons-clipboard',
        30
    );
}
add_action('admin_menu', 'hieucon_checklist_admin_menu');

// 3. Admin Page HTML/PHP
function hieucon_checklist_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_checklists';
    
    // Handle search by phone if passed via link
    $search_phone = isset($_GET['search_phone']) ? sanitize_text_field($_GET['search_phone']) : '';

    if ($search_phone) {
        $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE parent_phone LIKE %s ORDER BY updated_at DESC LIMIT 500", '%' . $wpdb->esc_like($search_phone) . '%'));
    } else {
        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 500");
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Kết quả Check list</h1>

        <div style="background:#fff; padding:15px; border:1px solid #ccd0d4; margin:15px 0;">
            <h2 style="margin-top:0;">Cấu hình API Key</h2>
            <form method="post" action="options.php">
                <?php settings_fields('hieucon_checklist_options_group'); ?>
                <table class="form-table" style="max-width: 600px;">
                    <tr valign="top">
                        <th scope="row" style="padding: 10px 10px 10px 0;">API Key bảo mật:</th>
                        <td style="padding: 10px;">
                            <input type="text" name="hieucon_checklist_api_key" value="<?php echo esc_attr(get_option('hieucon_checklist_api_key')); ?>" class="regular-text" placeholder="Nhập chuỗi bảo mật..." />
                        </td>
                    </tr>
                </table>
                <p class="description">API Endpoint: <code><?php echo get_site_url(); ?>/api/thong-tin-check-list?phone=SĐT&api_key=KEY</code></p>
                <?php submit_button('Lưu cấu hình API', 'primary', 'submit', false); ?>
            </form>
        </div>

        <p>Chi tiết dữ liệu khách hàng sử dụng Checklist.</p>
        <style>
            .behaviors-list { max-height: 100px; overflow-y: auto; font-size: 12px; background: #f9f9f9; padding: 5px; border: 1px solid #ddd; }
            .device-info { font-size: 11px; color: #666; word-break: break-all; max-width: 150px; }
        </style>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th style="width:40px;">ID</th>
                    <th style="width:140px;">Phụ huynh</th>
                    <th style="width:120px;">Kết quả</th>
                    <th style="width:200px;">Hành vi Checklist</th>
                    <th>Trạng thái & Lấy KQ</th>
                    <th>Hành động tiếp</th>
                    <th style="width:90px;">Bản ghi cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                <tr><td colspan="7">Chưa có kết quả nào.</td></tr>
                <?php else: ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo esc_html($row->id); ?></td>
                            <td>
                                <strong><?php echo esc_html($row->parent_name ?: 'Ẩn danh'); ?></strong><br>
                                <?php echo esc_html($row->parent_phone); ?>
                                <?php if (!empty($row->parent_phone)): ?>
                                    <br><a href="<?php echo esc_url(site_url('/ket-qua?p=') . urlencode(hieucon_normalize_phone($row->parent_phone))); ?>" target="_blank" style="font-size:11px; text-decoration:none; color:#0073aa; font-weight:bold;">📋 Xem bản đẹp →</a>
                                <?php endif; ?>
                                <br><br>
                                <div class="device-info" title="<?php echo esc_attr($row->device_info ?? ''); ?>">
                                    Thiết bị: <?php echo esc_html(substr($row->device_info ?? '', 0, 40)) . '...'; ?>
                                </div>
                            </td>
                            <td>
                                <?php if(!empty($row->result_score)): ?>
                                    <strong>Cấp độ:</strong> <?php echo esc_html($row->result_level ?? ''); ?><br>
                                    <strong>Điểm:</strong> <?php echo esc_html($row->result_score ?? ''); ?><br>
                                    <strong>Số nhóm:</strong> <?php echo esc_html($row->result_groups ?? ''); ?>
                                <?php else: ?>
                                    <span style="color:gray;">Chưa hoàn thành</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $b = json_decode($row->behaviors, true);
                                if (!empty($b)) {
                                    echo "<strong>Đã chọn " . count($b) . " mục:</strong>";
                                    echo "<div class='behaviors-list'>";
                                    foreach ($b as $item) {
                                        echo "- " . esc_html($item) . "<br>";
                                    }
                                    echo "</div>";
                                } else {
                                    echo "<span style='color:gray;'>Chưa đánh dấu</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <strong>Đọc hết:</strong> <?php echo $row->read_all ? '<span style="color:green;font-weight:bold;">Rồi</span>' : '<span style="color:red;">Chưa</span>'; ?><br>
                                <strong>Đến bước:</strong> <?php echo intval($row->furthest_step ?? 0) + 1; ?>/6<br>
                                <strong>Thời gian:</strong> <?php echo esc_html($row->time_spent); ?> giây<br>
                                <strong>Hành động:</strong> <?php 
                                    if($row->contact_method === 'pdf') echo 'Tải PDF';
                                    elseif($row->contact_method === 'send') echo 'Gửi tài liệu';
                                    elseif(strpos($row->contact_method, 'just_viewed') !== false) echo 'Chỉ xem';
                                    else echo '-';
                                ?>
                            </td>
                            <td>
                                <?php echo $row->next_action ? '<strong>' . esc_html($row->next_action) . '</strong>' : '<span style="color:gray;">Chưa có</span>'; ?>
                            </td>
                            <td>
                                <?php echo esc_html($row->updated_at); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// 4. Register settings for the API Key
add_action('admin_init', 'hieucon_checklist_register_settings');
function hieucon_checklist_register_settings() {
    register_setting('hieucon_checklist_options_group', 'hieucon_checklist_api_key');
}

// 5. Public Results View — hiển thị kết quả đẹp như PDF
add_action('template_redirect', 'hieucon_public_checklist_result');
function hieucon_public_checklist_result() {
    if ( strpos($_SERVER['REQUEST_URI'], '/ket-qua') !== 0 || !isset($_GET['p']) ) return;

    $phone            = sanitize_text_field($_GET['p']);
    $normalized_phone = hieucon_normalize_phone($phone);
    global $wpdb;
    $table_name  = $wpdb->prefix . 'hieucon_checklists';
    $search_str  = (strlen($normalized_phone) > 8) ? substr($normalized_phone, -8) : $normalized_phone;
    $row         = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE parent_phone LIKE %s ORDER BY updated_at DESC LIMIT 1",
        "%$search_str%"
    ));

    // Badge color map
    $badge_map = [
        'bl' => ['bg'=>'#e8f5ec', 'fg'=>'#2d6a4f'],
        'bm' => ['bg'=>'#fff3e8', 'fg'=>'#c07a35'],
        'bh' => ['bg'=>'#fdeee8', 'fg'=>'#b85a35'],
    ];

    get_header();
    ?>
    <style>
      .kq-wrap{max-width:740px;margin:40px auto;padding:0 16px 60px;font-family:'Be Vietnam Pro',sans-serif;color:#1e293b;line-height:1.6}
      .kq-card{background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.07);padding:40px 44px}
      .kq-hd{border-bottom:2px solid #e2e8f0;padding-bottom:18px;margin-bottom:22px}
      .kq-meta{display:flex;justify-content:space-between;font-size:11px;color:#64748b;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:10px}
      .kq-title{font-size:24px;font-weight:800;color:#0f172a;margin:0 0 4px}
      .kq-sub{font-size:13px;color:#64748b;margin:0 0 14px}
      .kq-info{display:flex;gap:24px;padding:12px 16px;background:#f8fafc;border-radius:10px;font-size:13px;flex-wrap:wrap}
      .kq-result-box{border-left:5px solid #eab308;background:#fefce8;padding:20px;border-radius:10px;margin-bottom:22px}
      .kq-badge{display:inline-block;padding:4px 14px;border-radius:100px;font-size:12px;font-weight:700;margin-bottom:8px}
      .kq-rtitle{font-size:17px;font-weight:800;color:#854d0e;margin:0 0 8px}
      .kq-rbody{font-size:13.5px;color:#713f12;line-height:1.75;margin:0}
      .kq-sec{font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;color:#0f172a;display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #f1f5f9;margin:22px 0 14px}
      .kq-sec span{font-weight:400;color:#64748b;font-size:11px;text-transform:none;letter-spacing:0}
      .kq-srow{display:flex;align-items:center;gap:12px;margin-bottom:10px}
      .kq-slbl{width:130px;font-size:12px;color:#475569;text-align:right;flex-shrink:0}
      .kq-sbar{flex:1;height:10px;background:#f1f5f9;border-radius:10px;overflow:hidden}
      .kq-sfill{height:100%;border-radius:10px}
      .kq-snum{width:40px;font-size:12px;font-weight:700;color:#64748b;text-align:right}
      .kq-item{font-size:12.5px;color:#475569;padding:3px 0 3px 18px;position:relative;line-height:1.5}
      .kq-item::before{content:'✓';position:absolute;left:0;color:#d97706;font-weight:700}
      .kq-cta{text-align:center;margin-top:28px}
      .kq-cta a{display:inline-block;background:#0f172a;color:#fff;font-weight:700;padding:12px 28px;border-radius:100px;font-size:14px;text-decoration:none}
      .kq-footer{margin-top:36px;padding-top:14px;border-top:1px solid #e2e8f0;font-size:11px;color:#94a3b8;text-align:center}
      .kq-empty{padding:24px;background:#fef2f2;color:#b91c1c;border-radius:10px;text-align:center;font-weight:600}
      @media(max-width:600px){.kq-card{padding:24px 18px}.kq-slbl{width:80px;font-size:11px}}
    </style>
    <div class="kq-wrap">
      <div class="kq-card">
      <?php if (!$row): ?>
        <div class="kq-empty">Không tìm thấy kết quả cho số điện thoại này.</div>
      <?php else:
          $name       = esc_html($row->parent_name ?: 'Ẩn danh');
          $phone_disp = esc_html($row->parent_phone);
          $updated    = date('d/m/Y', strtotime($row->updated_at));

          // Ưu tiên dùng result_snapshot (đầy đủ nhất)
          $snap = json_decode($row->result_snapshot ?? '', true);
          if ($snap) {
              $rlevel      = $snap['level']      ?? '';
              $rbadge      = $snap['badge']      ?? 'bm';
              $rtitle      = $snap['title']      ?? '';
              $rsubtitle   = $snap['subtitle']   ?? '';
              $rbody       = $snap['body']       ?? '';
              $rscore      = $snap['score']      ?? '';
              $rgroups_sig = intval($snap['groups_sig'] ?? 0);
              $scores_data = $snap['scores']     ?? [];
              $behaviors_by_group = $snap['behaviors_by_group'] ?? [];
          } else {
              // Fallback cho bản ghi cũ chưa có snapshot
              $rlevel      = $row->result_level  ?: 'Chưa hoàn thành';
              $rbadge      = $row->result_badge  ?: 'bm';
              $rtitle      = $row->result_title  ?: '';
              $rsubtitle   = '';
              $rbody       = $row->result_body   ?: '';
              $rscore      = $row->result_score  ?: '--';
              $rgroups_sig = 0;
              $scores_data = json_decode($row->scores_json ?? '[]', true) ?: [];
              // Flat list thành 1 group
              $flat = json_decode($row->behaviors ?? '[]', true) ?: [];
              $behaviors_by_group = $flat ? [['group'=>'Dấu hiệu ghi nhận','items'=>$flat]] : [];
          }
          $bc = $badge_map[$rbadge] ?? $badge_map['bm'];
      ?>
        <div class="kq-hd">
          <div class="kq-meta">
            <span>Hiểu con từ Gốc</span>
            <span>Ngày: <?php echo esc_html($updated); ?></span>
          </div>
          <h1 class="kq-title">Báo cáo Kết quả Checklist</h1>
          <p class="kq-sub">Dấu hiệu Viêm hệ thần kinh ở trẻ tự kỷ</p>
          <div class="kq-info">
            <div>Phụ huynh: <strong><?php echo $name; ?></strong></div>
            <div>SĐT: <strong><?php echo $phone_disp; ?></strong></div>
          </div>
        </div>

        <div class="kq-result-box">
          <span class="kq-badge" style="background:<?php echo esc_attr($bc['bg']); ?>;color:<?php echo esc_attr($bc['fg']); ?>">
            <?php echo esc_html($rlevel); ?>
          </span>
          <?php if ($rtitle): ?><div class="kq-rtitle"><?php echo esc_html($rtitle); ?></div><?php endif; ?>
          <?php if ($rsubtitle): ?><p class="kq-rsubtitle" style="font-size:13px;color:<?php echo esc_attr($bc['fg']); ?>;opacity:.8;margin:0 0 8px"><?php echo esc_html($rsubtitle); ?></p><?php endif; ?>
          <?php if ($rbody): ?><p class="kq-rbody"><?php echo esc_html($rbody); ?></p><?php endif; ?>
        </div>

        <?php if (!empty($scores_data)): ?>
        <div class="kq-sec">
          Tổng quan theo từng nhóm
          <span><?php echo esc_html($rscore); ?> dấu hiệu · <?php echo intval($rgroups_sig); ?>/6 nhóm có dấu hiệu rõ</span>
        </div>
        <?php foreach ($scores_data as $sg): ?>
          <div class="kq-srow">
            <div class="kq-slbl"><?php echo esc_html(mb_substr(explode(' & ', $sg['g'])[0], 0, 18)); ?></div>
            <div class="kq-sbar"><div class="kq-sfill" style="width:<?php echo intval($sg['pt']); ?>%;background-color:<?php echo esc_attr($sg['color']); ?>"></div></div>
            <div class="kq-snum"><?php echo intval($sg['ch']).'/'.intval($sg['mx']); ?></div>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($behaviors_by_group)): ?>
        <div class="kq-sec">Chi tiết dấu hiệu ghi nhận</div>
        <?php foreach ($behaviors_by_group as $grp): ?>
          <div style="margin-bottom:14px">
            <div style="font-size:12px;font-weight:700;color:#334155;padding:6px 10px;background:#f8fafc;border-left:3px solid #cbd5e1;border-radius:4px;margin-bottom:6px">
              <?php echo esc_html($grp['group']); ?>
            </div>
            <?php foreach (($grp['items'] ?? []) as $b): ?>
              <div class="kq-item"><?php echo esc_html($b); ?></div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
        <?php else: ?>
          <div class="kq-sec">Chi tiết dấu hiệu ghi nhận</div>
          <p style="color:#94a3b8;font-size:13px;font-style:italic">Chưa ghi nhận dấu hiệu nào.</p>
        <?php endif; ?>

        <div class="kq-cta">
          <a href="tel:0988717107">📞 Nhận tư vấn từ chuyên gia</a>
        </div>
        <div class="kq-footer">
          <strong>Lưu ý:</strong> Kết quả mang tính tham khảo, không thay thế chẩn đoán y tế chuyên môn.<br>
          Hỗ trợ: 0988.71.71.07 | dawnbridge.care
        </div>
      <?php endif; ?>
      </div>
    </div>
    <?php
    get_footer();
    exit;
}

// 5. Phone Normalization Helper
// This standardizes a phone number to just digits, replacing +84 or 84 with 0.
function hieucon_normalize_phone($phone) {
    if (empty($phone)) return '';
    // Strip everything except digits
    $phone = preg_replace('/[^\d]/', '', $phone);
    // If starts with 84 and has enough digits to be a VN phone, replace with 0
    if (strpos($phone, '84') === 0 && strlen($phone) >= 11) {
        $phone = '0' . substr($phone, 2);
    }
    // If it doesn't start with 0 but has 9 digits, prepend 0
    if (strlen($phone) === 9 && $phone[0] !== '0') {
        $phone = '0' . $phone;
    }
    // Trả về số đã chuẩn hóa
    return $phone;
}

// 6. REST API Hook for Custom URL
add_action('init', 'hieucon_process_checklist_api');
function hieucon_process_checklist_api() {
    if (strpos($_SERVER['REQUEST_URI'], '/api/thong-tin-check-list') !== false) {
        header('Content-Type: application/json; charset=utf-8');
        
        $saved_api_key = get_option('hieucon_checklist_api_key');
        if (empty($saved_api_key)) {
            $saved_api_key = 'dawnbridge'; // Default fallback API key if not configured in Admin yet
        }
        
        $request_api_key = isset($_GET['api_key']) ? sanitize_text_field($_GET['api_key']) : '';
        
        if ($saved_api_key !== $request_api_key) {
            echo wp_json_encode(['status' => 'error', 'message' => 'Invalid or missing API Key']);
            exit;
        }
        
        $phone_raw = isset($_GET['phone']) ? sanitize_text_field($_GET['phone']) : '';
        $normalized_phone = hieucon_normalize_phone($phone_raw);
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'hieucon_checklists';
        
        $data_output = [];
        
        if (!empty($normalized_phone)) {
            // Để tìm kiếm sai lệch (KH gõ 098... nhưng db lưu +84...), tối ưu nhất là so sánh dựa trên 9 số đuôi
            // Nhưng vì mình đã chuẩn hóa cả đầu vào và đầu ra, giờ cứ lấy normalized_phone mà khớp.
            // Để chắc chắn, ta lấy 8-9 số đuôi để khớp với LIKE.
            $search_str = (strlen($normalized_phone) > 8) ? substr($normalized_phone, -8) : $normalized_phone;
            
            // Lấy 1 bản ghi mới nhất theo số điện thoại (chứa đoạn đuôi)
            $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE parent_phone LIKE %s ORDER BY updated_at DESC LIMIT 1", "%$search_str%"));
            $rows = $row ? [$row] : [];
        } else if (!empty($phone_raw)) {
            // KH truyền phone nhưng không hợp lệ -> parse rỗng
            $rows = [];
        } else {
            // Thu thập toàn bộ
            $rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 1000");
        }
        
        if (empty($rows)) {
            echo wp_json_encode(['status' => 'success', 'data' => []]);
            exit;
        }
        
        foreach ($rows as $r) {
            $completed_groups = min(6, intval($r->furthest_step ?? 0) + 1);
            $thong_tin = "Đã xem đến nhóm $completed_groups/6";
            if (!empty($r->result_score)) {
                $res_level = $r->result_level ?? '';
                $thong_tin = "Đã hoàn thành Checklist (Kết quả: {$res_level})";
            }
            
            $item = [
                'id' => $r->id,
                'ten' => $r->parent_name ?: 'Ẩn danh',
                'sdt' => $r->parent_phone,
                'thong_tin_da_dien' => $thong_tin,
                'link_chi_tiet' => get_site_url() . "/ket-qua?p=" . urlencode(hieucon_normalize_phone($r->parent_phone)),
                // Các trường chi tiết khác
                'session_id' => $r->session_id,
                'read_all' => $r->read_all,
                'behaviors' => json_decode($r->behaviors, true),
                'contact_method' => $r->contact_method,
                'time_spent' => $r->time_spent . ' giây',
                'next_action' => $r->next_action ?? '',
                'furthest_step' => $r->furthest_step ?? null,
                'result_level' => $r->result_level ?? null,
                'result_score' => $r->result_score ?? null,
                'result_groups' => $r->result_groups ?? null,
                'device_info' => $r->device_info ?? null,
                'created_at' => $r->created_at,
                'updated_at' => $r->updated_at
            ];
            
            $data_output[] = $item;
        }
        
        // Nếu client truyền SĐT vào API, ta chỉ xuất 1 cục object data duy nhất thay vì mảng (nếu tìm thấy), 
        // ngược lại nếu không thấy báo lỗi không rườm rà
        if (!empty($phone_raw)) {
            if (count($data_output) > 0) {
                echo wp_json_encode(['status' => 'success', 'data' => $data_output[0]]);
            } else {
                echo wp_json_encode(['status' => 'error', 'message' => 'No matching data found for this phone']);
            }
            exit;
        }
        
        echo wp_json_encode([
            'status' => 'success',
            'data' => $data_output
        ]);
        exit;
    }
}

// 6. AJAX Endpoint to receive tracking events
add_action('wp_ajax_hieucon_track_checklist', 'hieucon_track_checklist');
add_action('wp_ajax_nopriv_hieucon_track_checklist', 'hieucon_track_checklist');
function hieucon_track_checklist() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_checklists';
    
    $session_id = isset($_POST['session_id']) ? sanitize_text_field($_POST['session_id']) : '';
    if (!$session_id) wp_send_json_error('Missing session ID');

    $parent_name = isset($_POST['parent_name']) ? sanitize_text_field($_POST['parent_name']) : '';
    
    // Normalize parent_phone immediately before hitting DB
    $parent_phone_raw = isset($_POST['parent_phone']) ? sanitize_text_field($_POST['parent_phone']) : '';
    $parent_phone = hieucon_normalize_phone($parent_phone_raw);

    $read_all = isset($_POST['read_all']) ? intval($_POST['read_all']) : 0;
    // Dùng wp_unslash + json_decode/encode để bảo toàn cấu trúc JSON, sanitize từng phần tử
    $behaviors_raw = isset($_POST['behaviors']) ? wp_unslash($_POST['behaviors']) : '[]';
    $behaviors_arr = json_decode($behaviors_raw, true);
    if (!is_array($behaviors_arr)) $behaviors_arr = [];
    $behaviors_arr = array_map('sanitize_text_field', $behaviors_arr);
    $behaviors = wp_json_encode($behaviors_arr);
    $contact_method = isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '';
    $next_action = isset($_POST['next_action']) ? sanitize_text_field($_POST['next_action']) : '';
    $time_spent = isset($_POST['time_spent']) ? intval($_POST['time_spent']) : 0;

    $furthest_step = isset($_POST['furthest_step']) ? intval($_POST['furthest_step']) : 0;
    $result_level    = isset($_POST['result_level'])  ? sanitize_text_field($_POST['result_level'])  : '';
    $result_score    = isset($_POST['result_score'])  ? sanitize_text_field($_POST['result_score'])  : '';
    $result_groups   = isset($_POST['result_groups']) ? sanitize_text_field($_POST['result_groups']) : '';
    $result_title    = isset($_POST['result_title'])  ? sanitize_text_field($_POST['result_title'])  : '';
    $result_body_raw = isset($_POST['result_body'])   ? wp_unslash($_POST['result_body'])             : '';
    $result_body     = sanitize_textarea_field($result_body_raw);
    $result_badge    = isset($_POST['result_badge'])  ? sanitize_text_field($_POST['result_badge'])  : '';
    $scores_raw      = isset($_POST['scores_json'])   ? wp_unslash($_POST['scores_json'])             : '';
    $scores_arr         = json_decode($scores_raw, true);
    $scores_json        = is_array($scores_arr) ? wp_json_encode($scores_arr) : '';
    // result_snapshot: full JSON blob
    $snapshot_raw    = isset($_POST['result_snapshot']) ? wp_unslash($_POST['result_snapshot']) : '';
    $snapshot_parsed = json_decode($snapshot_raw, true);
    $result_snapshot = is_array($snapshot_parsed) ? wp_json_encode($snapshot_parsed) : '';
    $device_info     = isset($_POST['device_info'])   ? sanitize_text_field($_POST['device_info'])   : '';

    // Check if exists
    $existing = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE session_id = %s", $session_id));

    // Luôn bao gồm 3 cột NOT NULL để INSERT không lỗi trong MySQL strict mode
    $data = [
        'behaviors'      => $behaviors ?: '[]',
        'contact_method' => $contact_method,
        'device_info'    => $device_info,
    ];
    // Chỉ cập nhật các trường sau khi có giá trị thực (tránh ghi đè bằng chuỗi rỗng)
    if ($parent_name)   $data['parent_name']   = $parent_name;
    if ($parent_phone)  $data['parent_phone']  = $parent_phone;
    if ($read_all)      $data['read_all']      = $read_all;
    if ($next_action)   $data['next_action']   = $next_action;
    if ($time_spent)    $data['time_spent']    = $time_spent;
    if ($furthest_step) $data['furthest_step'] = $furthest_step;
    if ($result_level)  $data['result_level']  = $result_level;
    if ($result_score)  $data['result_score']  = $result_score;
    if ($result_groups) $data['result_groups'] = $result_groups;
    if ($result_title)    $data['result_title']    = $result_title;
    if ($result_body)     $data['result_body']     = $result_body;
    if ($result_badge)    $data['result_badge']    = $result_badge;
    if ($scores_json)     $data['scores_json']     = $scores_json;
    if ($result_snapshot) $data['result_snapshot'] = $result_snapshot;

    if ($existing) {
        $wpdb->update($table_name, $data, ['session_id' => $session_id]);
    } else {
        $data['session_id'] = $session_id;
        $wpdb->insert($table_name, $data);
    }

    wp_send_json_success('Tracked Detailed');
}
