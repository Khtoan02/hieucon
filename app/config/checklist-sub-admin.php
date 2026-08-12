<?php
/**
 * Dynamic Sub-Checklist Tracking & Admin Management
 */

// 1. Install Custom Database Table for Sub-Checklist Submissions
function hieucon_install_sub_checklist_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_sub_checklist_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        checklist_id bigint(20) NOT NULL,
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
        UNIQUE KEY user_code_checklist (user_code, checklist_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'hieucon_install_sub_checklist_table');

// 2. Register Custom Post Type: hieucon_sub_chk (Tối đa 20 ký tự để tránh thông báo sai post type length của WP)
function hieucon_register_sub_checklist_cpt()
{
    $labels = [
        'name' => 'Checklist Nhánh',
        'singular_name' => 'Checklist Nhánh',
        'menu_name' => 'Checklist Nhánh',
        'add_new' => 'Thêm Checklist mới',
        'add_new_item' => 'Thêm Checklist Nhánh mới',
        'edit_item' => 'Sửa Checklist Nhánh',
        'new_item' => 'Checklist Nhánh mới',
        'view_item' => 'Xem Checklist Nhánh',
        'search_items' => 'Tìm kiếm Checklist',
        'not_found' => 'Không tìm thấy Checklist nào',
        'not_found_in_trash' => 'Không tìm thấy Checklist nào trong thùng rác'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_menu' => 'hieucon-checklist-main', // Gộp chung vào menu Check-list
        'rewrite' => ['slug' => 'checklist-nhanh'],
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
        'menu_position' => 12,
    ];

    register_post_type('hieucon_sub_chk', $args);
}
add_action('init', 'hieucon_register_sub_checklist_cpt');

// Loại bỏ slug 'checklist-nhanh' khỏi URL của CPT hieucon_sub_chk
add_filter('post_type_link', 'hieucon_sub_checklist_remove_slug', 10, 3);
function hieucon_sub_checklist_remove_slug($post_link, $post, $leavename) {
    if ('hieucon_sub_chk' != $post->post_type || 'publish' != $post->post_status) {
        return $post_link;
    }
    return home_url('/' . $post->post_name . '/');
}

// Giúp WordPress phân tích request ở root level slug cho hieucon_sub_chk
add_action('pre_get_posts', 'hieucon_sub_checklist_parse_request');
function hieucon_sub_checklist_parse_request($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (isset($query->query['name']) || isset($query->query['pagename'])) {
            $current_types = $query->get('post_type');
            if (empty($current_types)) {
                $query->set('post_type', array('post', 'page', 'hieucon_sub_chk'));
            } elseif (is_array($current_types) && !in_array('hieucon_sub_chk', $current_types)) {
                $current_types[] = 'hieucon_sub_chk';
                $query->set('post_type', $current_types);
            } elseif (is_string($current_types) && $current_types != 'hieucon_sub_chk' && $current_types != 'any') {
                $query->set('post_type', array($current_types, 'hieucon_sub_chk'));
            }
        }
    }
}

// Ép buộc WordPress nạp đúng file single-hieucon_sub_chk.php khi xem chi tiết Checklist Nhánh
add_filter('template_include', 'hieucon_sub_checklist_template_include', 99);
function hieucon_sub_checklist_template_include($template) {
    if (is_singular('hieucon_sub_chk')) {
        $custom_template = get_template_directory() . '/single-hieucon_sub_chk.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

// 3. Add Custom Metabox for Question Structure Configuration
function hieucon_sub_checklist_add_metabox()
{
    add_meta_box(
        'hieucon_sub_checklist_questions_metabox',
        'Cấu hình Câu hỏi Checklist',
        'hieucon_sub_checklist_questions_metabox_html',
        'hieucon_sub_chk',
        'normal',
        'high'
    );

    add_meta_box(
        'hieucon_sub_checklist_extra_metabox',
        'Cấu hình Thông tin Bổ sung & Tài liệu tham khảo',
        'hieucon_sub_checklist_extra_metabox_html',
        'hieucon_sub_chk',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'hieucon_sub_checklist_add_metabox');

function hieucon_sub_checklist_extra_metabox_html($post)
{
    // Lấy dữ liệu đã lưu
    $edu_title = get_post_meta($post->ID, '_hieucon_sub_edu_title', true);
    $legacy_edu_title = '🧭 Tiêu hóa chỉ là một mảnh ghép trong bức tranh sức khỏe của con';
    if (empty($edu_title) || $edu_title === $legacy_edu_title) {
        $edu_title = '[Title] chỉ là một mảnh ghép trong bức tranh sức khỏe của con';
    }

    $edu_content = get_post_meta($post->ID, '_hieucon_sub_edu_content', true);
    if (empty($edu_content)) {
        $edu_content = "Các vấn đề tiêu hóa, giấc ngủ, hành vi, dinh dưỡng và miễn dịch thường liên kết chặt chẽ với nhau qua trục Não – Ruột và các cơ chế sinh học chung.\nĐể hiểu được bức tranh sức khỏe đó của con, ba mẹ có thể tham khảo:";
    }

    $references = get_post_meta($post->ID, '_hieucon_sub_references', true);
    ?>
    <div style="background:#f6f7f7; border:1px solid #ccd0d4; padding:20px; border-radius:8px; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;">
        <p class="description" style="margin-bottom:15px; font-style:italic; font-size: 13px;">
            Cấu hình khối “Bức tranh toàn diện” và tài liệu tham khảo ở cuối trang. Dùng <code>[Title]</code> để tự động chèn tên Checklist hiện tại.
        </p>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight:bold; margin-bottom:8px; font-size:13px;">Tiêu đề khối Bức tranh toàn diện:</label>
            <input type="text" name="hieucon_sub_edu_title" value="<?php echo esc_attr($edu_title); ?>" style="width:100%; padding:8px; border:1px solid #8c8f94; border-radius:4px; font-size:13px;">
            <p class="description" style="margin-top:6px;"><code>[Title]</code> luôn lấy đúng tiêu đề Checklist hiện tại. Ví dụ: <code>Rối loạn tiêu hóa chỉ là một mảnh ghép trong bức tranh sức khỏe của con</code>.</p>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight:bold; margin-bottom:8px; font-size:13px;">Nội dung Khối giáo dục:</label>
            <textarea name="hieucon_sub_edu_content" rows="4" style="width:100%; padding:8px; border:1px solid #8c8f94; border-radius:4px; font-size:13px;"><?php echo esc_textarea($edu_content); ?></textarea>
        </div>

        <div>
            <label style="display:block; font-weight:bold; margin-bottom:8px; font-size:13px;">📚 Tài liệu tham khảo:</label>
            <textarea name="hieucon_sub_references" rows="6" placeholder="Ví dụ:&#10;[1] Nghiên cứu tổng hợp về hệ vi sinh đường ruột (2023).&#10;[2] Hướng dẫn can thiệp trục Não - Ruột của bác sĩ nhi khoa." style="width:100%; padding:8px; border:1px solid #8c8f94; border-radius:4px; font-size:13px;"><?php echo esc_textarea($references); ?></textarea>
        </div>
    </div>
    <?php
}

function hieucon_sub_checklist_questions_metabox_html($post)
{
    // Lấy dữ liệu đã lưu
    $questions_json = get_post_meta($post->ID, '_hieucon_sub_checklist_questions', true);
    if (empty($questions_json)) {
        $questions_json = '[]';
    }
    wp_nonce_field('hieucon_sub_checklist_save_meta', 'hieucon_sub_checklist_nonce');
    ?>
    <div id="hieucon-checklist-builder-app"
        style="background:#f6f7f7; border:1px solid #ccd0d4; padding:20px; border-radius:8px;">
        <p class="description" style="margin-bottom:15px; font-style:italic; font-size: 13px;">Thiết kế danh sách câu hỏi và mô tả giải thích cho Checklist này.
            Dữ liệu sẽ tự động được lưu trữ dưới dạng JSON khi cập nhật bài viết.</p>

        <div class="checklist-json-importer">
            <div class="checklist-json-importer-header">
                <div>
                    <strong>Nhập nhanh danh sách câu hỏi bằng JSON</strong>
                    <p class="description">Dán JSON và bấm <strong>Áp dụng JSON</strong>. Hãy kiểm tra danh sách bên dưới trước khi bấm Cập nhật bài viết.</p>
                </div>
                <button type="button" class="button" id="btn-load-current-json">Lấy JSON hiện tại</button>
            </div>

            <textarea id="questions-json-import" rows="12" spellcheck="false"
                placeholder='[
  {
    "main": "Câu hỏi hiển thị?",
    "exp": "Giải thích dễ hiểu cho ba mẹ.",
    "mechanism": "Thông tin chuyên môn hoặc cơ chế.",
    "guide": "Hướng dẫn ba mẹ theo dõi.",
    "warning": "Dấu hiệu cần đi khám."
  }
]'></textarea>

            <div class="checklist-json-actions">
                <button type="button" class="button button-primary" id="btn-apply-json">Áp dụng JSON</button>
                <button type="button" class="button" id="btn-format-json">Định dạng JSON</button>
                <button type="button" class="button" id="btn-json-example">Chèn JSON mẫu</button>
                <span id="questions-json-status" role="status" aria-live="polite"></span>
            </div>
        </div>

        <div id="questions-container"></div>

        <button type="button" class="button button-primary" id="btn-add-question"
            style="margin-top:10px; font-weight:bold; height: auto; padding: 6px 14px; font-size: 13px;">+ Thêm câu hỏi</button>

        <input type="hidden" name="hieucon_sub_checklist_questions_data" id="questions-data-input"
            value="<?php echo esc_attr($questions_json); ?>">
    </div>

    <!-- Style dành cho builder -->
    <style>
        .checklist-builder-item-row {
            background: #fff;
            border: 1px solid #c3c4c7;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            position: relative;
        }
        .checklist-builder-item-row input, 
        .checklist-builder-item-row textarea {
            border: 1px solid #8c8f94;
            border-radius: 4px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
        }
        .checklist-builder-item-row input:focus, 
        .checklist-builder-item-row textarea:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 2px solid transparent;
        }
        .checklist-json-importer {
            margin-bottom: 20px;
            padding: 16px;
            background: #fff;
            border: 1px solid #c3c4c7;
            border-left: 4px solid #2271b1;
            border-radius: 6px;
        }
        .checklist-json-importer-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 10px;
        }
        .checklist-json-importer-header .description {
            margin: 4px 0 0;
        }
        #questions-json-import {
            display: block;
            width: 100%;
            min-height: 220px;
            padding: 12px;
            border: 1px solid #8c8f94;
            border-radius: 4px;
            background: #f8fafc;
            color: #1e293b;
            font-family: Consolas, Monaco, monospace;
            font-size: 12px;
            line-height: 1.55;
            tab-size: 2;
        }
        #questions-json-import:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 2px solid transparent;
        }
        .checklist-json-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        #questions-json-status {
            font-weight: 600;
            font-size: 13px;
        }
        #questions-json-status.is-success { color: #008a20; }
        #questions-json-status.is-error { color: #b32d2e; }
        @media (max-width: 782px) {
            .checklist-json-importer-header {
                flex-direction: column;
            }
        }
    </style>

    <!-- Script điều khiển Builder -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputData = document.getElementById('questions-data-input');
            const container = document.getElementById('questions-container');
            const btnAddQuestion = document.getElementById('btn-add-question');
            const jsonInput = document.getElementById('questions-json-import');
            const jsonStatus = document.getElementById('questions-json-status');
            const btnApplyJson = document.getElementById('btn-apply-json');
            const btnFormatJson = document.getElementById('btn-format-json');
            const btnJsonExample = document.getElementById('btn-json-example');
            const btnLoadCurrentJson = document.getElementById('btn-load-current-json');

            // Đọc dữ liệu từ DB
            let rawData = [];
            try {
                rawData = JSON.parse(inputData.value || '[]');
            } catch (e) {
                rawData = [];
            }

            // Đảm bảo rawData luôn là mảng
            if (!Array.isArray(rawData)) {
                rawData = [];
            }

            // Lấy danh sách câu hỏi phẳng
            let items = [];
            if (rawData.length > 0 && rawData[0] && rawData[0].items && Array.isArray(rawData[0].items)) {
                items = rawData[0].items;
            } else if (Array.isArray(rawData)) {
                // Đề phòng trường hợp trước đó đã lưu dạng phẳng hoặc lỗi
                items = rawData;
            }

            const exampleItems = [
                {
                    main: 'Câu hỏi hiển thị?',
                    exp: 'Giải thích ngắn gọn, dễ hiểu cho ba mẹ.',
                    mechanism: 'Thông tin chuyên môn hoặc cơ chế liên quan.',
                    guide: 'Hướng dẫn ba mẹ quan sát và theo dõi.',
                    warning: 'Dấu hiệu cần trao đổi với bác sĩ hoặc đi khám.'
                }
            ];

            function setJsonStatus(message, type) {
                jsonStatus.textContent = message || '';
                jsonStatus.className = type ? `is-${type}` : '';
            }

            function normalizeItem(item, index) {
                if (!item || typeof item !== 'object' || Array.isArray(item)) {
                    throw new Error(`Câu hỏi số ${index + 1} phải là một object JSON.`);
                }

                const normalized = {
                    main: String(item.main || item.question || item.title || '').trim(),
                    example: String(item.example || '').trim(),
                    exp: String(item.exp || item.explanation || '').trim(),
                    mechanism: String(item.mechanism || '').trim(),
                    guide: String(item.guide || item.guidance || '').trim(),
                    warning: String(item.warning || '').trim()
                };

                if (!normalized.main) {
                    throw new Error(`Câu hỏi số ${index + 1} thiếu trường "main".`);
                }

                return normalized;
            }

            function extractItemsFromJson(parsed) {
                if (parsed && !Array.isArray(parsed) && Array.isArray(parsed.items)) {
                    return parsed.items;
                }

                if (!Array.isArray(parsed)) {
                    throw new Error('JSON phải là một mảng câu hỏi hoặc object có trường "items".');
                }

                const hasGroups = parsed.some(entry => entry && typeof entry === 'object' && Array.isArray(entry.items));
                if (hasGroups) {
                    return parsed.reduce((allItems, group) => {
                        if (group && Array.isArray(group.items)) {
                            return allItems.concat(group.items);
                        }
                        return allItems;
                    }, []);
                }

                return parsed;
            }

            function parseJsonInput() {
                const source = jsonInput.value.trim();
                if (!source) {
                    throw new Error('Vui lòng dán JSON vào ô nhập.');
                }

                let parsed;
                try {
                    parsed = JSON.parse(source);
                } catch (error) {
                    throw new Error(`JSON không hợp lệ: ${error.message}`);
                }

                const extractedItems = extractItemsFromJson(parsed);
                if (extractedItems.length === 0) {
                    throw new Error('JSON không có câu hỏi nào.');
                }

                return extractedItems.map(normalizeItem);
            }

            // Di chuyển dữ liệu cũ sang 4 trường mới nếu cần
            items.forEach(item => {
                if (item && item.example && (!item.exp && !item.mechanism && !item.guide && !item.warning)) {
                    // Phân tách nội dung dựa trên emoji
                    const lines = item.example.split("\n");
                    lines.forEach(line => {
                        line = line.trim();
                        if (line.indexOf('💟') !== -1) {
                            item.exp = line.replace('💟', '').trim();
                        } else if (line.indexOf('🎯') !== -1) {
                            item.mechanism = line.replace('🎯', '').trim();
                        } else if (line.indexOf('📋') !== -1) {
                            item.guide = line.replace('📋', '').trim();
                        } else if (line.indexOf('⚠️') !== -1) {
                            item.warning = line.replace('⚠️', '').trim();
                        }
                    });
                }
            });

            function render() {
                container.innerHTML = '';
                if (!Array.isArray(items) || items.length === 0) {
                    container.innerHTML = '<p style="color:#64748b; font-style:italic; padding:10px 0;">Chưa có câu hỏi nào. Hãy bấm nút dưới để thêm mới.</p>';
                    return;
                }

                items.forEach((item, idx) => {
                    if (!item) {
                        item = { main: '', example: '', exp: '', mechanism: '', guide: '', warning: '' };
                        items[idx] = item;
                    }
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'checklist-builder-item-row';
                    rowDiv.style = 'display: flex; gap: 15px; margin-bottom: 12px; align-items: flex-start; background: #fff; padding: 15px; border-radius: 6px; border: 1px solid #c3c4c7;';
                    rowDiv.innerHTML = `
                        <div style="font-weight: bold; min-width: 25px; padding-top: 6px; color: #1d2327; font-size: 14px;">Q${idx + 1}:</div>
                        <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                            <input type="text" placeholder="Câu hỏi chính" class="item-main regular-text" value="${escapeHtml(item.main || '')}" data-idx="${idx}" style="width: 100%;">
                            
                            <!-- Bốn phần giải thích chi tiết -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 4px;">
                                <div>
                                    <label style="font-weight: bold; font-size: 11px; color: #4f46e5; display: block; margin-bottom: 3px;">💟 Giải thích</label>
                                    <textarea class="item-exp" data-idx="${idx}" rows="3" style="width: 100%; font-family: sans-serif; font-size: 12px; padding: 6px;" placeholder="Nhập lời giải thích...">${escapeHtml(item.exp || '')}</textarea>
                                </div>
                                <div>
                                    <label style="font-weight: bold; font-size: 11px; color: #3730a3; display: block; margin-bottom: 3px;">🎯 Thông tin chuyên môn / Cơ chế</label>
                                    <textarea class="item-mechanism" data-idx="${idx}" rows="3" style="width: 100%; font-family: sans-serif; font-size: 12px; padding: 6px;" placeholder="Nhập cơ chế y sinh...">${escapeHtml(item.mechanism || '')}</textarea>
                                </div>
                                <div>
                                    <label style="font-weight: bold; font-size: 11px; color: #065f46; display: block; margin-bottom: 3px;">📋 Hướng dẫn thực hành</label>
                                    <textarea class="item-guide" data-idx="${idx}" rows="3" style="width: 100%; font-family: sans-serif; font-size: 12px; padding: 6px;" placeholder="Nhập hướng dẫn thực hành...">${escapeHtml(item.guide || '')}</textarea>
                                </div>
                                <div>
                                    <label style="font-weight: bold; font-size: 11px; color: #9f1239; display: block; margin-bottom: 3px;">⚠️ Cảnh báo y khoa</label>
                                    <textarea class="item-warning" data-idx="${idx}" rows="3" style="width: 100%; font-family: sans-serif; font-size: 12px; padding: 6px;" placeholder="Nhập cảnh báo y khoa...">${escapeHtml(item.warning || '')}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-delete-item button button-link-delete" title="Xóa câu hỏi" data-idx="${idx}" style="color: #b32d2e; font-size: 18px; line-height: 1; padding: 4px; margin-top: 2px; border: none; background: none; cursor: pointer;">✖</button>
                    `;
                    container.appendChild(rowDiv);
                });

                bindEvents();
            }

            function saveState() {
                // Đóng gói thành cấu trúc nhóm mặc định để giữ tương thích
                const structuredData = [
                    {
                        id: 'mac-dinh',
                        name: '',
                        icon: '',
                        desc: '',
                        items: items
                    }
                ];
                inputData.value = JSON.stringify(structuredData);
            }

            function bindEvents() {
                // Sửa Item Main
                document.querySelectorAll('.item-main').forEach(input => {
                    input.addEventListener('input', function () {
                        const idx = parseInt(this.dataset.idx);
                        if (items[idx]) {
                            items[idx].main = this.value;
                            saveState();
                        }
                    });
                });

                // Sửa Item Exp (💟)
                document.querySelectorAll('.item-exp').forEach(textarea => {
                    textarea.addEventListener('input', function () {
                        const idx = parseInt(this.dataset.idx);
                        if (items[idx]) {
                            items[idx].exp = this.value;
                            saveState();
                        }
                    });
                });

                // Sửa Item Mechanism (🎯)
                document.querySelectorAll('.item-mechanism').forEach(textarea => {
                    textarea.addEventListener('input', function () {
                        const idx = parseInt(this.dataset.idx);
                        if (items[idx]) {
                            items[idx].mechanism = this.value;
                            saveState();
                        }
                    });
                });

                // Sửa Item Guide (📋)
                document.querySelectorAll('.item-guide').forEach(textarea => {
                    textarea.addEventListener('input', function () {
                        const idx = parseInt(this.dataset.idx);
                        if (items[idx]) {
                            items[idx].guide = this.value;
                            saveState();
                        }
                    });
                });

                // Sửa Item Warning (⚠️)
                document.querySelectorAll('.item-warning').forEach(textarea => {
                    textarea.addEventListener('input', function () {
                        const idx = parseInt(this.dataset.idx);
                        if (items[idx]) {
                            items[idx].warning = this.value;
                            saveState();
                        }
                    });
                });

                // Xóa Item
                document.querySelectorAll('.btn-delete-item').forEach(btn => {
                    btn.onclick = function () {
                        const idx = parseInt(this.dataset.idx);
                        if (confirm(`Bạn có chắc chắn muốn xóa Câu hỏi Q${idx + 1} không?`)) {
                            items.splice(idx, 1);
                            saveState();
                            render();
                        }
                    };
                });
            }

            // Nút thêm câu hỏi
            btnAddQuestion.onclick = function () {
                if (!Array.isArray(items)) {
                    items = [];
                }
                items.push({ main: '', example: '', exp: '', mechanism: '', guide: '', warning: '' });
                saveState();
                render();

                // Focus vào ô input vừa thêm
                setTimeout(() => {
                    const inputs = container.querySelectorAll('.item-main');
                    if (inputs.length > 0) inputs[inputs.length - 1].focus();
                }, 50);
            };

            btnApplyJson.onclick = function () {
                try {
                    items = parseJsonInput();
                    saveState();
                    render();
                    setJsonStatus(`Đã áp dụng ${items.length} câu hỏi. Bấm “Cập nhật” để lưu bài viết.`, 'success');
                } catch (error) {
                    setJsonStatus(error.message, 'error');
                }
            };

            btnFormatJson.onclick = function () {
                try {
                    const parsed = JSON.parse(jsonInput.value);
                    jsonInput.value = JSON.stringify(parsed, null, 2);
                    setJsonStatus('Đã định dạng lại JSON.', 'success');
                } catch (error) {
                    setJsonStatus(`Không thể định dạng: ${error.message}`, 'error');
                }
            };

            btnJsonExample.onclick = function () {
                jsonInput.value = JSON.stringify(exampleItems, null, 2);
                setJsonStatus('Đã chèn JSON mẫu. Bạn có thể sửa rồi bấm “Áp dụng JSON”.', 'success');
            };

            btnLoadCurrentJson.onclick = function () {
                const currentItems = Array.isArray(items) ? items : [];
                jsonInput.value = JSON.stringify(currentItems, null, 2);
                setJsonStatus(`Đã tải ${currentItems.length} câu hỏi hiện tại.`, 'success');
            };

            function escapeHtml(text) {
                if (typeof text !== 'string') {
                    text = String(text || '');
                }
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            render();
        });
    </script>
    <?php
}

// 4. Save Metabox Data
function hieucon_sub_checklist_save_meta_data($post_id)
{
    if (!isset($_POST['hieucon_sub_checklist_nonce']) || !wp_verify_nonce($_POST['hieucon_sub_checklist_nonce'], 'hieucon_sub_checklist_save_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['hieucon_sub_checklist_questions_data'])) {
        $questions_raw = wp_unslash($_POST['hieucon_sub_checklist_questions_data']);
        // Parse & validate JSON trước khi lưu
        $questions_arr = json_decode($questions_raw, true);
        if (is_array($questions_arr)) {
            // Chuẩn hóa cấu trúc
            foreach ($questions_arr as &$grp) {
                $grp['id'] = sanitize_title($grp['id'] ?? '');
                $grp['name'] = sanitize_text_field($grp['name'] ?? '');
                $grp['icon'] = sanitize_text_field($grp['icon'] ?? '📝');
                $grp['desc'] = sanitize_text_field($grp['desc'] ?? '');
                if (isset($grp['items']) && is_array($grp['items'])) {
                    foreach ($grp['items'] as &$item) {
                        $item['main'] = sanitize_text_field($item['main'] ?? '');
                        $item['example'] = sanitize_textarea_field($item['example'] ?? '');
                        $item['exp'] = sanitize_textarea_field($item['exp'] ?? '');
                        $item['mechanism'] = sanitize_textarea_field($item['mechanism'] ?? '');
                        $item['guide'] = sanitize_textarea_field($item['guide'] ?? '');
                        $item['warning'] = sanitize_textarea_field($item['warning'] ?? '');
                    }
                } else {
                    $grp['items'] = [];
                }
            }
            unset($grp);
            update_post_meta($post_id, '_hieucon_sub_checklist_questions', wp_slash(wp_json_encode($questions_arr, JSON_UNESCAPED_UNICODE)));
        }
    }

    if (isset($_POST['hieucon_sub_edu_title'])) {
        update_post_meta($post_id, '_hieucon_sub_edu_title', sanitize_text_field($_POST['hieucon_sub_edu_title']));
    }
    if (isset($_POST['hieucon_sub_edu_content'])) {
        update_post_meta($post_id, '_hieucon_sub_edu_content', sanitize_textarea_field($_POST['hieucon_sub_edu_content']));
    }
    if (isset($_POST['hieucon_sub_references'])) {
        update_post_meta($post_id, '_hieucon_sub_references', sanitize_textarea_field($_POST['hieucon_sub_references']));
    }
}
add_action('save_post_hieucon_sub_chk', 'hieucon_sub_checklist_save_meta_data');

// 5. Register Admin Submenu: Báo cáo Checklist Nhánh
function hieucon_sub_checklist_admin_menu()
{
    add_submenu_page(
        'hieucon-checklist-main',
        'Báo cáo Checklist Nhánh',
        'Báo cáo Checklist Nhánh',
        'manage_options',
        'hieucon-sub-checklist-reports',
        'hieucon_sub_checklist_reports_page'
    );
}
add_action('admin_menu', 'hieucon_sub_checklist_admin_menu', 12);

// 6. Admin Submenu Page HTML/PHP
function hieucon_sub_checklist_reports_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_sub_checklist_submissions';

    // Lấy toàn bộ các Checklist Nhánh đang có
    $checklists = get_posts([
        'post_type' => 'hieucon_sub_chk',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    $selected_checklist_id = isset($_GET['checklist_id']) ? intval($_GET['checklist_id']) : 0;
    if (empty($selected_checklist_id) && !empty($checklists)) {
        $selected_checklist_id = $checklists[0]->ID;
    }

    $results = [];
    if ($selected_checklist_id > 0) {
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_name WHERE checklist_id = %d ORDER BY updated_at DESC LIMIT 500",
            $selected_checklist_id
        ));
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Báo cáo kết quả của các Checklist Nhánh</h1>
        <hr class="wp-header-end">

        <div
            style="background:#ffffff; border:1px solid #ccd0d4; padding:15px; margin:15px 0; border-radius:6px; display:flex; gap:20px; align-items:center;">
            <form method="GET" style="margin:0; padding:0; display:flex; gap:10px; align-items:center;">
                <input type="hidden" name="page" value="hieucon-sub-checklist-reports">
                <strong style="font-size:14px;">Chọn bộ Checklist con:</strong>
                <select name="checklist_id" style="min-width: 250px; padding: 4px 8px;" onchange="this.form.submit()">
                    <option value="">-- Chọn Checklist con --</option>
                    <?php foreach ($checklists as $chk): ?>
                        <option value="<?php echo intval($chk->ID); ?>" <?php selected($selected_checklist_id, $chk->ID); ?>>
                            <?php echo esc_html($chk->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($selected_checklist_id > 0): ?>
                <a href="<?php echo admin_url('admin-post.php?action=hieucon_sub_export_csv&checklist_id=' . $selected_checklist_id); ?>"
                    class="button button-primary">Xuất CSV dữ liệu</a>
            <?php endif; ?>
        </div>

        <?php if ($selected_checklist_id <= 0): ?>
            <div class="notice notice-warning">
                <p>Vui lòng chọn hoặc thêm mới một bộ Checklist con để bắt đầu xem báo cáo.</p>
            </div>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped table-view-list">
                <thead>
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th style="width:100px;">Mã KH (8 số)</th>
                        <th style="width:160px;">Phụ huynh</th>
                        <th style="width:120px;">SĐT</th>
                        <th style="width:150px;">Tuổi / Chẩn đoán</th>
                        <th style="width:200px;">Analyst (Hành vi)</th>
                        <th>Thời gian nộp</th>
                        <th style="width:120px; text-align:right;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($results)): ?>
                        <tr>
                            <td colspan="8">Chưa có kết quả nộp nào cho bộ Checklist này.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo esc_html($row->id); ?></td>
                                <td><strong>#<?php echo esc_html($row->user_code); ?></strong></td>
                                <td>
                                    <strong><?php echo esc_html($row->parent_name ? $row->parent_name : '---'); ?></strong><br>
                                    <span
                                        style="font-size:11px; color:#666;"><?php echo esc_html($row->parent_email ? $row->parent_email : '---'); ?></span>
                                </td>
                                <td><?php echo esc_html($row->parent_phone ? $row->parent_phone : '---'); ?></td>
                                <td>
                                    Bé: <strong><?php echo esc_html($row->child_name ? $row->child_name : '---'); ?></strong><br>
                                    Tuổi: <?php echo esc_html($row->child_age); ?><br>
                                    CĐ: <?php echo esc_html($row->child_diagnosis); ?>
                                </td>
                                <td>
                                    <span style="font-size:12px;">⏱ <strong><?php echo intval($row->time_spent ?? 0); ?></strong>
                                        giây</span><br>
                                    <span style="font-size:11px; color:#666;"
                                        title="<?php echo esc_attr($row->device_info ?? ''); ?>">📱
                                        <?php echo esc_html(hieucon_parse_user_agent($row->device_info ?? '')); ?></span>

                                    <?php if (!empty($row->deep_analytics)):
                                        $da = json_decode($row->deep_analytics, true);
                                        if (is_string($da))
                                            $da = json_decode($da, true);
                                        if (is_array($da)):
                                            ?>
                                            <details
                                                style="margin-top: 8px; font-size: 11px; background: #f0f0f1; padding: 5px; border-radius: 4px;">
                                                <summary style="cursor:pointer; font-weight:bold; color:#2271b1;">Xem hành vi sâu</summary>
                                                <div style="margin-top:5px; border-top:1px solid #ccc; padding-top:5px;">
                                                    <strong>Active Tab:</strong> <?php echo intval($da['activeTime'] ?? 0); ?>s<br>
                                                    <strong>Vị trí:</strong>
                                                    <?php echo esc_html(($da['location'] ?? 'N/A') . ' (IP: ' . ($da['ip'] ?? '') . ')'); ?><br>
                                                    <strong>UTM:</strong> <?php echo esc_html(json_encode($da['utms'] ?? [])); ?><br>

                                                    <?php
                                                    $toggles = $da['toggles'] ?? [];
                                                    $hesitations = [];
                                                    if (is_array($toggles) || is_object($toggles)) {
                                                        foreach ($toggles as $itemName => $count) {
                                                            if ($count > 1)
                                                                $hesitations[] = "$itemName ($count lần)";
                                                        }
                                                    }
                                                    if (!empty($hesitations)): ?>
                                                        <strong style="color:#d97706;">Lưỡng lự ở:</strong>
                                                        <?php echo esc_html(implode(' | ', $hesitations)); ?><br>
                                                    <?php endif; ?>

                                                    <strong>Ký tự đã xoá:</strong> <?php echo intval($da['deletedChars'] ?? 0); ?><br>
                                                    <?php if (!empty($da['drop_point'])): ?>
                                                        <strong style="color:red;">Trạng thái:</strong> <?php echo esc_html($da['drop_point']); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </details>
                                        <?php endif; endif; ?>

                                    <!-- Xem chi tiết các câu trả lời của con -->
                                    <?php if (!empty($row->behaviors_json)):
                                        $behaviors = json_decode($row->behaviors_json, true);
                                        if (is_array($behaviors) && !empty($behaviors)):
                                            ?>
                                            <details
                                                style="margin-top: 5px; font-size: 11px; background: #e0f2fe; padding: 5px; border-radius: 4px;">
                                                <summary style="cursor:pointer; font-weight:bold; color:#0369a1;">Biểu hiện ghi nhận (<?php
                                                $total_ticks = 0;
                                                foreach ($behaviors as $grp_items) {
                                                    $total_ticks += count($grp_items);
                                                }
                                                echo $total_ticks;
                                                ?>)</summary>
                                                <div
                                                    style="margin-top:5px; border-top:1px dashed #0369a1; padding-top:5px; max-height: 150px; overflow-y: auto;">
                                                    <?php foreach ($behaviors as $grp_id => $items): ?>
                                                        <strong>- Nhóm <?php echo esc_html($grp_id); ?>:</strong>
                                                        <ul style="margin:2px 0 6px 10px; padding:0; list-style:disc;">
                                                            <?php foreach ($items as $itm): ?>
                                                                <li><?php echo esc_html($itm); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endforeach; ?>
                                                </div>
                                            </details>
                                        <?php endif; endif; ?>
                                </td>
                                <td><?php echo esc_html($row->created_at); ?></td>
                                <td style="text-align:right;">
                                    <a href="<?php echo esc_url(site_url('/ket-qua-nhan-dien?code=' . $row->user_code . '&checklist_id=' . $selected_checklist_id . '&auth=' . md5($row->user_code . 'hieucon_secret_salt'))); ?>"
                                        target="_blank" class="button button-small">Xem kết quả</a>
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

// 7. Export CSV for Sub-Checklist Submissions
add_action('admin_post_hieucon_sub_export_csv', 'hieucon_sub_export_csv_handler');
function hieucon_sub_export_csv_handler()
{
    if (!current_user_can('manage_options')) {
        wp_die('Bạn không có quyền truy cập.');
    }

    $checklist_id = isset($_GET['checklist_id']) ? intval($_GET['checklist_id']) : 0;
    if (empty($checklist_id)) {
        wp_die('Thiếu ID bộ checklist.');
    }

    $checklist = get_post($checklist_id);
    if (!$checklist || $checklist->post_type !== 'hieucon_sub_chk') {
        wp_die('Bộ checklist không tồn tại.');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_sub_checklist_submissions';
    $results = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE checklist_id = %d ORDER BY created_at DESC",
        $checklist_id
    ));

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="checklist-' . sanitize_title($checklist->post_title) . '-export-' . date('Ymd-His') . '.csv"');

    // Add BOM to fix UTF-8 in Excel
    echo "\xEF\xBB\xBF";

    $output = fopen('php://output', 'w');

    $headers = [
        'ID',
        'Mã KH',
        'Tên con',
        'Phụ huynh',
        'SĐT',
        'Email phụ huynh',
        'Tuổi',
        'Chẩn đoán hiện tại',
        'Đang can thiệp',
        'Sản phẩm hỗ trợ',
        'Lo lắng nhất',
        'Triệu chứng khác',
        'Thời gian làm bài (giây)',
        'Thời gian nộp',
        'Thiết bị',
        'Vị trí',
        'IP',
        'Thời gian Active (giây)',
        'Tiến trình (Drop-off)',
        'UTMs',
        'Danh sách dấu hiệu chọn'
    ];
    fputcsv($output, $headers);

    foreach ($results as $row) {
        $da = json_decode($row->deep_analytics, true);
        $device = hieucon_parse_user_agent($row->device_info ?? '');

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
            !empty($da['utms']) && is_array($da['utms']) ? json_encode($da['utms'], JSON_UNESCAPED_UNICODE) : '',
            $behaviors_str
        ];

        fputcsv($output, $line);
    }

    fclose($output);
    exit;
}

// 8. AJAX Endpoint to receive Sub-Checklist data
add_action('wp_ajax_hieucon_sub_submit_checklist', 'hieucon_sub_submit_checklist');
add_action('wp_ajax_nopriv_hieucon_sub_submit_checklist', 'hieucon_sub_submit_checklist');
function hieucon_sub_submit_checklist()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_sub_checklist_submissions';

    $checklist_id = isset($_POST['checklist_id']) ? intval($_POST['checklist_id']) : 0;
    if ($checklist_id <= 0) {
        wp_send_json_error('Thiếu mã Checklist con.');
    }

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
        'checklist_id' => $checklist_id,
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

        $server_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $server_ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        }

        if (empty($da['ip'])) {
            $da['ip'] = $server_ip;
        }

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

    $existing = $wpdb->get_row($wpdb->prepare(
        "SELECT id, parent_email FROM $table_name WHERE user_code = %s AND checklist_id = %d",
        $user_code,
        $checklist_id
    ));

    if ($existing) {
        $wpdb->update($table_name, $data, ['user_code' => $user_code, 'checklist_id' => $checklist_id]);
    } else {
        $data['user_code'] = $user_code;
        $wpdb->insert($table_name, $data);
    }

    // Đồng bộ thông tin CRM Hội viên
    $checklist_post = get_post($checklist_id);
    $checklist_title = $checklist_post ? $checklist_post->post_title : 'Checklist Nhánh';
    \Hieucon\Model\Member_Model::sync_survey(
        $parent_name,
        $parent_phone,
        $parent_email,
        $child_name,
        $child_age,
        $child_gender,
        $child_diagnosis,
        $checklist_title
    );

    // Gửi email tự động nếu nộp kết quả cuối cùng và chưa được gửi trước đó
    $is_final = !empty($parent_email) && !empty($scores_json);
    $already_sent = ($existing && !empty($existing->parent_email));
    if ($is_final && !$already_sent) {
        $subject = 'Kết quả khảo sát của bé ' . $child_name . ' - ' . $checklist_title;
        $body = "Chào phụ huynh {$parent_name},<br><br>";
        $body .= "Cảm ơn phụ huynh đã tin tưởng thực hiện khảo sát <strong>{$checklist_title}</strong> của Hiểu Con Từ Gốc.<br>";
        $body .= "Mã hồ sơ đăng ký của con là: <strong>#{$user_code}</strong>.<br><br>";
        $body .= "Phụ huynh có thể nhấp vào liên kết sau để xem phân tích chi tiết: <br>";
        $body .= '<a href="' . site_url("/ket-qua-nhan-dien?code={$user_code}&checklist_id={$checklist_id}&auth=" . md5($user_code . 'hieucon_secret_salt')) . '" style="background:#0d2a78; color:#fff; padding:10px 20px; text-decoration:none; border-radius:6px; display:inline-block; margin-top:10px;">Xem Báo Cáo Phân Tích</a><br><br>';
        $body .= "Chuyên gia của Hiểu Con Từ Gốc sẽ sớm liên hệ lại với phụ huynh qua số điện thoại <strong>{$parent_phone}</strong> để hỗ trợ đồng hành cùng con.<br><br>";
        $body .= "Trân trọng,<br>Đội ngũ Hiểu Con Từ Gốc.";

        $headers = ['Content-Type: text/html; charset=UTF-8'];
        wp_mail($parent_email, $subject, $body, $headers);
    }

    wp_send_json_success(['user_code' => $user_code, 'auth' => md5($user_code . 'hieucon_secret_salt')]);
}

// AJAX Action: Autofill form data by parent phone number
add_action('wp_ajax_hieucon_sub_autofill_by_phone', 'hieucon_sub_autofill_by_phone_handler');
add_action('wp_ajax_nopriv_hieucon_sub_autofill_by_phone', 'hieucon_sub_autofill_by_phone_handler');
function hieucon_sub_autofill_by_phone_handler()
{
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    if (empty($phone)) {
        wp_send_json_error('Số điện thoại không được để trống.');
    }

    // Tra cứu trực tiếp từ bảng Hội viên Hiểu Con tập trung
    $member = \Hieucon\Model\Member_Model::get_by_phone($phone);

    if ($member) {
        $dob_formatted = '';
        if (!empty($member->child_dob)) {
            $parts = explode('/', $member->child_dob);
            if (count($parts) === 3) {
                $dob_formatted = sprintf('%04d-%02d-%02d', intval($parts[2]), intval($parts[1]), intval($parts[0]));
            }
        }

        $data = [
            'parent_name' => $member->full_name,
            'parent_email' => ($member->email && strpos($member->email, '@hieucon.vn') === false) ? $member->email : '',
            'child_name' => $member->child_name,
            'child_gender' => $member->child_gender,
            'child_dob' => $dob_formatted,
            'child_age' => $member->child_dob,
            'child_diagnosis' => $member->child_diagnosis,
        ];
        wp_send_json_success($data);
    }

    wp_send_json_error('Không tìm thấy dữ liệu cũ.');
}


// 9. Template Redirect: Phụ huynh xem kết quả tại /ket-qua-nhanh
add_action('template_redirect', 'hieucon_sub_public_checklist_result');
function hieucon_sub_public_checklist_result()
{
    if (strpos($_SERVER['REQUEST_URI'], '/ket-qua-nhan-dien') !== 0 || !isset($_GET['code']) || !isset($_GET['checklist_id']))
        return;

    define('IS_SUB_CHECKLIST_RESULT', true);

    $code = sanitize_text_field($_GET['code']);
    $checklist_id = intval($_GET['checklist_id']);

    $checklist = get_post($checklist_id);
    if (!$checklist || $checklist->post_type !== 'hieucon_sub_chk') {
        get_header();
        echo '<div style="padding:40px; text-align:center; font-family:sans-serif; color:#b91c1c;">Bộ Checklist không tồn tại.</div>';
        get_footer();
        exit;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_sub_checklist_submissions';
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE (user_code = %s OR parent_email = %s OR parent_phone = %s) AND checklist_id = %d ORDER BY id DESC LIMIT 1",
        $code,
        $code,
        $code,
        $checklist_id
    ));

    if (!$row) {
        get_header();
        echo '<div style="padding:40px; text-align:center; font-family:sans-serif; color:#b91c1c;">Không tìm thấy kết quả cho mã hồ sơ này.</div>';
        get_footer();
        exit;
    }

    // Xác thực bảo mật kết quả
    $secret_salt = 'hieucon_secret_salt';
    $expected_hash = md5($row->user_code . $secret_salt);
    $authenticated = false;
    $auth_error = '';

    if (isset($_GET['auth']) && $_GET['auth'] === $expected_hash) {
        $authenticated = true;
        setcookie('hieucon_sub_auth_' . $row->user_code . '_' . $checklist_id, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    } elseif (isset($_COOKIE['hieucon_sub_auth_' . $row->user_code . '_' . $checklist_id]) && $_COOKIE['hieucon_sub_auth_' . $row->user_code . '_' . $checklist_id] === $expected_hash) {
        $authenticated = true;
    } elseif (isset($_POST['hieucon_pass'])) {
        $pass_input = sanitize_text_field($_POST['hieucon_pass']);
        $configured_pass = get_option('hieucon_checklist_view_password', 'hieucon2026');

        if (trim($pass_input) === trim($configured_pass)) {
            $authenticated = true;
            setcookie('hieucon_sub_auth_' . $row->user_code . '_' . $checklist_id, $expected_hash, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
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

        add_filter('pre_get_document_title', function () use ($checklist) {
            return 'Xác thực bảo mật kết quả - ' . esc_html($checklist->post_title);
        }, 999);

        get_header();
        ?>
        <div class="results-page-body flex items-center justify-center px-4 py-16"
            style="background-color: #faf9f6; font-family: 'Quicksand', sans-serif; min-height: 70vh; display: flex; align-items: center; justify-content: center; width: 100%;">
            <div
                style="background: #ffffff; border: 1px solid #D6E2F5; max-width: 480px; width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(13, 42, 120, 0.08); padding: 32px 24px; text-align: center; box-sizing: border-box;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔒</div>
                <h2
                    style="font-family: 'Oswald', sans-serif; font-size: 22px; color: #0D2A78; margin: 0 0 12px 0; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">
                    Xác thực bảo mật</h2>
                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0 0 24px 0;">
                    Báo cáo kết quả của con được bảo mật. Vui lòng nhập <strong>Mật khẩu bảo mật</strong> được cung cấp để mở
                    khóa xem chi tiết:
                </p>

                <form method="POST" style="margin: 0; padding: 0;">
                    <?php if (!empty($auth_error)): ?>
                        <div
                            style="background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; font-size: 13px; text-align: left; margin-bottom: 16px; line-height: 1.5; box-sizing: border-box;">
                            ⚠️ <?php echo esc_html($auth_error); ?>
                        </div>
                    <?php endif; ?>

                    <div style="margin-bottom: 20px; text-align: left;">
                        <input type="password" name="hieucon_pass" placeholder="Nhập mật khẩu mở khóa..." required
                            style="width: 100%; padding: 12px 16px; border: 1.5px solid #CBD5E1; border-radius: 8px; font-size: 14px; font-family: 'Quicksand', sans-serif; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='#0D2A78'" onblur="this.style.borderColor='#CBD5E1'">
                    </div>

                    <button type="submit"
                        style="width: 100%; background: linear-gradient(135deg, #0d2a78 0%, #163ca3 100%); color: #ffffff; padding: 12px; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; font-family: 'Quicksand', sans-serif; cursor: pointer; box-shadow: 0 4px 12px rgba(13, 42, 120, 0.2); transition: opacity 0.2s; box-sizing: border-box;">
                        Mở khóa kết quả
                    </button>
                </form>
            </div>
        </div>
        <?php
        get_footer();
        exit;
    }

    // Fix status code and meta title
    global $wp_query;
    $wp_query->is_404 = false;
    status_header(200);

    add_filter('pre_get_document_title', function () use ($row, $checklist) {
        return esc_html($row->parent_name) . ' - Kết quả ' . esc_html($checklist->post_title);
    }, 999);

    get_header();

    $name = esc_html($row->parent_name ?: 'Ẩn danh');
    $phone_disp = esc_html($row->parent_phone);
    $updated = date('d/m/Y', strtotime($row->updated_at));

    $scores = json_decode($row->scores_json, true) ?: [];
    $behaviors = json_decode($row->behaviors_json, true) ?: [];

    // Đọc cấu trúc nhóm của checklist con để vẽ biểu đồ và hiển thị
    $questions_json = get_post_meta($checklist_id, '_hieucon_sub_checklist_questions', true);
    $groups_structure = json_decode($questions_json, true) ?: [];

    // Tự động map điểm & màu sắc
    $color_palette = ['#EF4444', '#F59E0B', '#10B981', '#3B82F6', '#8B5CF6', '#EC4899', '#6366F1', '#14B8A6'];
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Quicksand:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        .results-page-body {
            background-color: #faf9f6;
            color: #1e293b;
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
        }

        .panel-title {
            font-family: 'Oswald', sans-serif;
        }

        .has-pattern-bg {
            position: relative;
            background: #002795;
            overflow: hidden;
            z-index: 1;
        }

        .has-pattern-bg::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pattern-hieu-con.png?v=1.2");
            background-size: 200px;
            background-position: right 40px center;
            background-repeat: no-repeat;
            opacity: 0.1;
            z-index: -1;
        }
    </style>

    <div class="results-page-body py-12 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <!-- Header Banner -->
            <div class="has-pattern-bg p-8 md:p-12 text-white relative">
                <div
                    class="flex justify-between items-center text-xs font-bold uppercase tracking-wider text-yellow-300 mb-4">
                    <span>Hiểu con từ Gốc</span>
                    <span>Ngày hoàn thành: <?php echo esc_html($updated); ?></span>
                </div>
                <h1 class="panel-title text-3xl md:text-4xl font-bold mb-2 uppercase text-white tracking-wide">Báo Cáo Phân
                    Tích Kết Quả</h1>
                <p class="text-lg text-slate-100 opacity-90 font-light"><?php echo esc_html($checklist->post_title); ?></p>

                <div
                    class="mt-8 flex flex-wrap gap-6 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 text-sm">
                    <div>Phụ huynh: <strong class="text-yellow-300"><?php echo $name; ?></strong></div>
                    <div>Số điện thoại: <strong class="text-yellow-300"><?php echo $phone_disp; ?></strong></div>
                    <div>Mã hồ sơ: <strong class="text-yellow-300">#<?php echo esc_html($row->user_code); ?></strong></div>
                </div>
            </div>

            <div class="p-6 md:p-10 space-y-10">
                <?php
                // Tính tổng số câu CÓ (tích chọn)
                $total_ticked = 0;
                foreach ($behaviors as $grp_id => $ticked_items) {
                    $total_ticked += count($ticked_items);
                }

                $severity_title = '';
                $severity_desc = '';
                $severity_bg = '';
                $severity_border = '';
                $severity_text = '';

                // Tiêu đề checklist động
                $chk_title = esc_html($checklist->post_title);

                if ($total_ticked <= 1) {
                    $severity_title = 'Chưa thấy nhiều điểm đáng lưu ý';
                    $severity_bg = '#f0fdf4'; // green-50
                    $severity_border = '#bbf7d0'; // green-200
                    $severity_text = '#16a34a'; // green-600
                    $severity_desc = 'Qua những gì cha mẹ vừa ghi nhận, hiện chưa có nhiều biểu hiện nổi bật trong nhóm ' . $chk_title . '. <strong>Cha mẹ có thể tiếp tục quan sát con trong sinh hoạt hằng ngày</strong>.';
                } elseif ($total_ticked <= 3) {
                    $severity_title = 'Có một số điểm cần quan sát thêm';
                    $severity_bg = '#fffbeb'; // amber-50
                    $severity_border = '#fde68a'; // amber-200
                    $severity_text = '#d97706'; // amber-600
                    $severity_desc = 'Cha mẹ đã ghi nhận một số biểu hiện liên quan đến ' . $chk_title . '. Mỗi dấu hiệu riêng lẻ chưa nói lên nguyên nhân, nhưng khi chúng xuất hiện cùng nhau, <strong>việc nhìn rộng hơn bức tranh sức khỏe của con có thể hữu ích</strong>.';
                } else {
                    $severity_title = 'Có nhiều điểm đáng lưu ý';
                    $severity_bg = '#fef2f2'; // red-50
                    $severity_border = '#fecaca'; // red-200
                    $severity_text = '#dc2626'; // red-600
                    $severity_desc = 'Có nhiều biểu hiện liên quan đến ' . $chk_title . ' đang cùng được cha mẹ ghi nhận. Đây không phải kết luận bệnh lý, nhưng là <strong>lý do phù hợp để quan sát toàn diện hơn các phương diện sức khỏe khác của con</strong>.';
                }
                ?>

                <!-- Nhận định mức độ kết quả -->
                <div class="rounded-2xl p-6 border-2 border-solid transition-all text-left"
                    style="background-color: <?php echo $severity_bg; ?>; border-color: <?php echo $severity_border; ?>;">
                    <div class="text-xs uppercase font-bold tracking-wider mb-2"
                        style="color: <?php echo $severity_text; ?>;">
                        Nhận định kết quả sơ bộ
                    </div>
                    <h2 class="panel-title text-2xl font-bold mb-3"
                        style="color: <?php echo $severity_text; ?>; margin-top: 0; line-height: 1.3;">
                        <?php echo esc_html($severity_title); ?>
                    </h2>
                    <p class="text-slate-700 text-sm md:text-base leading-relaxed mb-4">
                        <?php echo $severity_desc; ?>
                    </p>

                    <!-- Nút Tư vấn đồng màu với mức độ -->
                    <div class="mt-4 mb-2">
                        <a href="tel:0988717107"
                            class="inline-flex items-center justify-center gap-1.5 text-white font-bold px-6 py-3 rounded-full shadow-md transition-all text-xs md:text-sm no-underline btn-pulse-orange w-fit"
                            style="background-color: <?php echo $severity_text; ?>;">
                            <svg class="w-4 h-4 text-white fill-current" viewBox="0 0 24 24">
                                <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1.02c-.36-1.11-.56-2.3-.56-3.53C8.58 3.58 7.7 3 6.7 3H3.03c-.98 0-1.74.88-1.64 1.86a18.23 18.23 0 0017.3 17.3c.98.1 1.86-.66 1.86-1.64v-3.51c0-1-.58-1.63-1.54-1.63z"/>
                            </svg>
                            Tư vấn
                        </a>
                    </div>

                </div>

                <!-- Chi tiết các biểu hiện đã tích chọn -->
                <div>
                    <h2 class="panel-title text-xl font-bold text-slate-800 border-b pb-2 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Chi tiết dấu hiệu ghi nhận
                    </h2>

                    <?php
                    $has_ticks = false;
                    foreach ($groups_structure as $grp):
                        $grp_id = $grp['id'];
                        $ticked_items = $behaviors[$grp_id] ?? [];
                        if (empty($ticked_items))
                            continue;
                        $has_ticks = true;
                        ?>
                        <div class="mb-6 last:mb-0">
                            <?php if (!empty(trim($grp['name'] ?? ''))): ?>
                                <div
                                    class="font-bold text-sm text-slate-700 bg-slate-50 border-l-4 border-slate-400 px-4 py-2 rounded-r-lg mb-3">
                                    <?php echo esc_html($grp['icon'] . ' ' . $grp['name']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="space-y-2 pl-4">
                                <?php foreach ($ticked_items as $itm): ?>
                                    <div class="text-sm text-slate-600 flex items-start gap-2.5">
                                        <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span><?php echo esc_html($itm); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach;
                    if (!$has_ticks): ?>
                        <p class="text-sm italic text-slate-400">Không ghi nhận biểu hiện nào đặc biệt.</p>
                    <?php endif; ?>
                </div>

                <!-- Lời khuyên và Hành động tiếp theo -->
                <?php if (!empty($row->parent_concern) || !empty($row->extra_symptoms)): ?>
                    <div class="bg-amber-50/50 border border-amber-200/60 rounded-2xl p-6">
                        <h3 class="font-bold text-sm text-amber-800 mb-3 flex items-center gap-2">
                            <svg class="w-4.5 h-4.5 text-amber-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Thông tin bổ sung từ phụ huynh
                        </h3>
                        <div class="space-y-3 text-sm text-slate-600">
                            <?php if (!empty($row->parent_concern)): ?>
                                <p><strong>Lo lắng nhất của cha mẹ:</strong> <?php echo esc_html($row->parent_concern); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($row->extra_symptoms)): ?>
                                <p><strong>Biểu hiện khác:</strong> <?php echo esc_html($row->extra_symptoms); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- CTA -->
                <div class="pt-6 border-t text-center">
                    <div class="bg-blue-50 border border-solid border-blue-200 rounded-3xl p-6 md:p-8 mb-8 w-full text-center">
                        <p class="text-slate-700 text-sm md:text-base leading-relaxed mb-6 max-w-3xl mx-auto">
                            Một biểu hiện của con đôi khi không đứng riêng lẻ.<br>
                            <strong><?php echo esc_html($checklist->post_title); ?></strong> có thể xuất hiện song song với
                            những khó khăn ở ăn uống, giấc ngủ, giác quan, cảm xúc – hành vi và các phương diện sức khỏe
                            khác.
                        </p>
                        
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-6 border-t border-dashed border-blue-200/80 text-left">
                            <!-- Bên trái: Text -->
                            <div class="flex items-center gap-3.5 flex-1">
                                <svg class="w-5 h-5 text-blue-800 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                <p class="font-bold text-sm md:text-base text-blue-900 m-0 leading-relaxed">
                                    Thực hiện Bộ công cụ nhận diện các vấn đề sức khỏe thường gặp ở trẻ tự kỷ để nhìn bức tranh của con đầy đủ hơn.
                                </p>
                            </div>
                            
                            <!-- Bên phải: Button -->
                            <div class="shrink-0 w-full md:w-auto text-center md:text-right">
                                <a href="/bo-cong-cu-suc-khoe/"
                                    class="inline-flex items-center justify-center gap-2 bg-yellow hover:bg-yellow/95 text-slate-800 font-bold px-7 py-3 rounded-full shadow-lg transition-all text-sm no-underline w-full md:w-auto"
                                    style="background:#FFD154; color:#002795; white-space: nowrap;">
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="stroke: #002795;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    Bộ công cụ 8 nhóm
                                </a>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 mt-6 leading-relaxed text-center">
                        <strong>Lưu ý:</strong> Kết quả trên mang tính chất sàng lọc sơ bộ hành vi biểu hiện y sinh học của
                        trẻ theo góc nhìn của phụ huynh, không thay thế chẩn đoán y tế lâm sàng.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    exit;
}

// Hàm Math_round helper cho PHP < 7
if (!function_exists('Math_round')) {
    function Math_round($val)
    {
        return round($val);
    }
}
