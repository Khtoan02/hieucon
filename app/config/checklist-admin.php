<?php
/**
 * Checklist Tracking & Admin Page
 */

// 1. Install Custom Table
function hieucon_install_checklist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_checklists';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        session_id varchar(100) NOT NULL,
        parent_name varchar(255) DEFAULT '' NOT NULL,
        parent_phone varchar(50) DEFAULT '' NOT NULL,
        read_all tinyint(1) DEFAULT 0 NOT NULL,
        behaviors text NOT NULL,
        contact_method text NOT NULL,
        time_spent int(11) DEFAULT 0 NOT NULL,
        next_action varchar(255) DEFAULT '' NOT NULL,
        furthest_step int(11) DEFAULT 0 NOT NULL,
        result_level varchar(255) DEFAULT '' NOT NULL,
        result_score varchar(50) DEFAULT '' NOT NULL,
        result_groups varchar(50) DEFAULT '' NOT NULL,
        device_info text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY session_id (session_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
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
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC LIMIT 500");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Kết quả Check list</h1>
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
                                <?php echo esc_html($row->parent_phone); ?><br><br>
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

// 4. AJAX Endpoint to receive tracking events
add_action('wp_ajax_hieucon_track_checklist', 'hieucon_track_checklist');
add_action('wp_ajax_nopriv_hieucon_track_checklist', 'hieucon_track_checklist');
function hieucon_track_checklist() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_checklists';
    
    $session_id = isset($_POST['session_id']) ? sanitize_text_field($_POST['session_id']) : '';
    if (!$session_id) wp_send_json_error('Missing session ID');

    $parent_name = isset($_POST['parent_name']) ? sanitize_text_field($_POST['parent_name']) : '';
    $parent_phone = isset($_POST['parent_phone']) ? sanitize_text_field($_POST['parent_phone']) : '';
    $read_all = isset($_POST['read_all']) ? intval($_POST['read_all']) : 0;
    $behaviors = isset($_POST['behaviors']) ? sanitize_text_field(stripslashes($_POST['behaviors'])) : '';
    $contact_method = isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '';
    $next_action = isset($_POST['next_action']) ? sanitize_text_field($_POST['next_action']) : '';
    $time_spent = isset($_POST['time_spent']) ? intval($_POST['time_spent']) : 0;

    $furthest_step = isset($_POST['furthest_step']) ? intval($_POST['furthest_step']) : 0;
    $result_level = isset($_POST['result_level']) ? sanitize_text_field($_POST['result_level']) : '';
    $result_score = isset($_POST['result_score']) ? sanitize_text_field($_POST['result_score']) : '';
    $result_groups = isset($_POST['result_groups']) ? sanitize_text_field($_POST['result_groups']) : '';
    $device_info = isset($_POST['device_info']) ? sanitize_text_field($_POST['device_info']) : '';

    // Check if exists
    $existing = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE session_id = %s", $session_id));

    $data = [];
    if ($parent_name) $data['parent_name'] = $parent_name;
    if ($parent_phone) $data['parent_phone'] = $parent_phone;
    if ($read_all) $data['read_all'] = $read_all;
    if ($behaviors) $data['behaviors'] = $behaviors;
    if ($contact_method) $data['contact_method'] = $contact_method;
    if ($next_action) $data['next_action'] = $next_action;
    if ($time_spent) $data['time_spent'] = $time_spent;

    if ($furthest_step) $data['furthest_step'] = $furthest_step;
    if ($result_level) $data['result_level'] = $result_level;
    if ($result_score) $data['result_score'] = $result_score;
    if ($result_groups) $data['result_groups'] = $result_groups;
    if ($device_info) $data['device_info'] = $device_info;

    if ($existing) {
        $wpdb->update($table_name, $data, ['session_id' => $session_id]);
    } else {
        $data['session_id'] = $session_id;
        $wpdb->insert($table_name, $data);
    }

    wp_send_json_success('Tracked Detailed');
}
