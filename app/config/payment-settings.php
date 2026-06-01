<?php
/**
 * SePay QR Code Payment Settings & Core Integration Module
 * Decoupled, Hook-driven & Highly Visual
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Chống truy cập trực tiếp
}

/**
 * 1. TỰ ĐỘNG TẠO BẢNG GIAO DỊCH SEPAY
 */
function hieucon_sepay_auto_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'sepay_transactions';

    // Tránh truy vấn lặp lại nếu bảng đã tồn tại
    $existing = $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table_name));
    if ($existing === $table_name) {
        return;
    }

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        gateway varchar(100) NOT NULL,
        transaction_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        account_number varchar(100) DEFAULT '' NOT NULL,
        sub_account varchar(250) DEFAULT '' NOT NULL,
        amount_in decimal(20,2) DEFAULT '0.00' NOT NULL,
        amount_out decimal(20,2) DEFAULT '0.00' NOT NULL,
        accumulated decimal(20,2) DEFAULT '0.00' NOT NULL,
        code varchar(250) DEFAULT '' NOT NULL,
        transaction_content text DEFAULT '' NOT NULL,
        reference_number varchar(255) DEFAULT '' NOT NULL,
        body text DEFAULT '' NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) {$charset_collate};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
    error_log('SePay database table initialized: ' . $table_name);
}
add_action('init', 'hieucon_sepay_auto_create_table');

/**
 * 2. ĐĂNG KÝ CÁC SETTINGS LƯU TRỮ
 */
function hieucon_register_payment_settings() {
    register_setting('hieucon_payment_options', 'sepay_enabled');
    register_setting('hieucon_payment_options', 'sepay_api_key');
    register_setting('hieucon_payment_options', 'sepay_secret_key');
    register_setting('hieucon_payment_options', 'sepay_webhook_token');
    register_setting('hieucon_payment_options', 'sepay_bank_id');
    register_setting('hieucon_payment_options', 'sepay_account_number');
    register_setting('hieucon_payment_options', 'sepay_account_name');
    register_setting('hieucon_payment_options', 'sepay_qr_template');
}
add_action('admin_init', 'hieucon_register_payment_settings');

/**
 * 3. ĐĂNG KÝ MENU CON "PHƯƠNG THỨC THANH TOÁN"
 */
function hieucon_payment_settings_menu() {
    add_submenu_page(
        'hieucon-theme-settings',    // Parent slug (Cài đặt Theme)
        'Phương thức thanh toán',    // Page title
        '💳 Phương thức thanh toán', // Menu title
        'manage_options',             // Capability
        'hieucon-payment-settings',   // Menu slug
        'hieucon_payment_settings_html' // Callback
    );
}
add_action('admin_menu', 'hieucon_payment_settings_menu', 20);

/**
 * GIAO DIỆN PREMIUM TRANG CẤU HÌNH PHƯƠNG THỨC THANH TOÁN
 */
function hieucon_payment_settings_html() {
    if ( ! current_user_can('manage_options') ) {
        return;
    }

    // Lấy dữ liệu hiện có
    $enabled        = get_option('sepay_enabled', '0');
    $api_key        = get_option('sepay_api_key', '');
    $secret_key     = get_option('sepay_secret_key', '');
    $webhook_token  = get_option('sepay_webhook_token', '');
    $bank_id        = get_option('sepay_bank_id', 'MBBank');
    $acc_number     = get_option('sepay_account_number', 'VQRQAFUAF0842');
    $acc_name       = get_option('sepay_account_name', 'NGUYEN KHANH TOAN');
    $qr_template    = get_option('sepay_qr_template', 'qronly');

    // Tạo token tự động nếu chưa có
    if ( empty($webhook_token) ) {
        $webhook_token = wp_generate_password(16, false);
        update_option('sepay_webhook_token', $webhook_token);
    }

    // Danh sách ngân hàng
    $supported_banks = [
        'MBBank'        => 'MB Bank (Ngân hàng Quân đội)',
        'Vietcombank'   => 'Vietcombank (Ngoại thương Việt Nam)',
        'Techcombank'   => 'Techcombank (Kỹ thương Việt Nam)',
        'ACB'           => 'ACB (Á Châu)',
        'BIDV'          => 'BIDV (Đầu tư và Phát triển)',
        'Agribank'      => 'Agribank (Nông nghiệp & Phát triển Nông thôn)',
        'VietinBank'    => 'VietinBank (Công thương Việt Nam)',
        'VPBank'        => 'VPBank (Việt Nam Thịnh Vượng)',
        'TPBank'        => 'TPBank (Tiên Phong)',
        'Sacombank'     => 'Sacombank (Sài Gòn Thương Tín)',
        'HDBank'        => 'HDBank (Phát triển TP.HCM)',
        'SHB'           => 'SHB (Sài Gòn - Hà Nội)',
        'VIB'           => 'VIB (Quốc tế)',
        'MSB'           => 'MSB (Hàng Hải)',
        'OCB'           => 'OCB (Phương Đông)',
    ];

    // Các template VietQR
    $templates = [
        'qronly'  => 'Ảnh QR Trơn (Chỉ chứa mã quét, không viền thông tin)',
        'compact' => 'Compact (Chứa mã quét và tóm tắt số tiền)',
        'qr_only' => 'VietQR Standard (Chuẩn hóa của NAPAS)',
    ];

    // Lấy danh sách lịch sử giao dịch thô
    global $wpdb;
    $table_name = $wpdb->prefix . 'sepay_transactions';
    $transactions = [];
    if ( $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table_name)) === $table_name ) {
        $transactions = $wpdb->get_results( "SELECT * FROM {$table_name} ORDER BY id DESC LIMIT 15" );
    }

    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'config';
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .hc-pay-wrap {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            max-width: 1200px;
            margin: 20px auto 40px;
            color: #334155;
        }
        .hc-pay-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .hc-pay-tabs {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 25px;
            gap: 8px;
        }
        .hc-pay-tab {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            cursor: pointer;
            outline: none;
            box-shadow: none !important;
        }
        .hc-pay-tab:hover {
            color: #0d9488;
        }
        .hc-pay-tab.active {
            color: #0d9488;
            border-bottom-color: #0d9488;
        }
        .hc-pay-grid {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 30px;
        }
        @media (max-width: 1024px) {
            .hc-pay-grid {
                grid-template-columns: 1fr;
            }
        }
        .hc-pay-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .hc-pay-card-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-b: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .hc-pay-form-table {
            width: 100%;
            border-collapse: collapse;
        }
        .hc-pay-form-table td {
            padding: 12px 0;
            vertical-align: middle;
        }
        .hc-pay-form-table td.label-column {
            width: 30%;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }
        .hc-pay-input-text, .hc-pay-select {
            width: 100%;
            max-width: 420px;
            border: 1px solid #cbd5e1 !important;
            border-radius: 10px !important;
            padding: 10px 14px !important;
            font-size: 13px !important;
            color: #1e293b !important;
            background: #ffffff !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02) !important;
            transition: all 0.25s ease !important;
            height: auto !important;
        }
        .hc-pay-input-text:focus, .hc-pay-select:focus {
            border-color: #0d9488 !important;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.12) !important;
            outline: none !important;
        }
        .hc-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }
        .hc-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .hc-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #cbd5e1;
            transition: .3s;
            border-radius: 34px;
        }
        .hc-slider:before {
            position: absolute;
            content: "";
            height: 18px; width: 18px;
            left: 4px; bottom: 4px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        input:checked + .hc-slider {
            background-color: #10b981;
        }
        input:checked + .hc-slider:before {
            transform: translateX(24px);
        }
        
        /* Webhook visual styles */
        .hc-pay-webhook-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 10px;
        }
        .hc-pay-url-display {
            font-family: monospace;
            background: #0f172a;
            color: #38bdf8;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 6px;
            border: 1px solid #1e293b;
            word-break: break-all;
        }
        .hc-pay-copy-btn {
            background: #1e293b;
            border: 1px solid #334155;
            color: #94a3b8;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            outline: none !important;
        }
        .hc-pay-copy-btn:hover {
            color: #ffffff;
            background: #0f172a;
            border-color: #0d9488;
        }
        .hc-pay-copy-btn:active {
            transform: scale(0.95);
        }
        
        /* QR Code Live Preview Sidebar */
        .hc-pay-sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .hc-qr-preview-card {
            background: #0f172a;
            color: #e2e8f0;
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            border: 1px solid #1e293b;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
        }
        .hc-qr-preview-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #10b981;
            margin-bottom: 20px;
            background: rgba(16, 185, 129, 0.1);
            padding: 6px 14px;
            border-radius: 9999px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid rgba(16, 185, 129, 0.15);
        }
        .hc-qr-frame {
            background: #ffffff;
            padding: 14px;
            border-radius: 18px;
            width: 200px;
            height: 200px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            border: 1px solid #1e293b;
        }
        .hc-qr-frame img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }
        .hc-qr-data-badge {
            background: #1e293b;
            border-radius: 12px;
            padding: 12px 16px;
            text-align: left;
            margin-top: 10px;
            border: 1px solid #334155;
        }
        .hc-qr-data-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            padding: 4px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .hc-qr-data-row:last-child {
            border-bottom: none;
        }
        .hc-qr-data-lbl {
            color: #94a3b8;
        }
        .hc-qr-data-val {
            font-weight: 600;
            color: #ffffff;
            font-family: monospace;
        }
        
        /* Guide styling */
        .hc-guide-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
        }
        .hc-guide-step {
            margin-bottom: 24px;
            padding-left: 36px;
            position: relative;
        }
        .hc-guide-step-num {
            position: absolute;
            left: 0; top: 0;
            width: 24px; height: 24px;
            background: #0d9488;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(13,148,136,0.25);
        }
        .hc-guide-step h4 {
            margin: 0 0 6px 0;
            font-size: 15px;
            font-weight: 750;
            color: #0f172a;
        }
        .hc-guide-step p {
            margin: 0;
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }
        
        /* Toast notification */
        #hc-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #0f172a;
            color: #ffffff;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            z-index: 99999;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #hc-toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Spreadsheet transaction list */
        .hc-log-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .hc-log-table th {
            background: #f8fafc;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }
        .hc-log-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }
        .hc-log-table tr:hover td {
            background-color: #f8fafc;
        }
        .hc-amount-in {
            color: #10b981;
            font-weight: 700;
            font-family: monospace;
        }
        .hc-amount-out {
            color: #ef4444;
            font-family: monospace;
        }
    </style>

    <div class="hc-pay-wrap">
        <h1 class="hc-pay-title">
            <span>💳</span> Cấu hình Phương thức thanh toán VietQR (SePay)
        </h1>

        <!-- Navigation Tabs -->
        <div class="hc-pay-tabs">
            <a href="?page=hieucon-payment-settings&tab=config" class="hc-pay-tab <?php echo $active_tab === 'config' ? 'active' : ''; ?>">⚙️ Cài đặt chung</a>
            <a href="?page=hieucon-payment-settings&tab=guide" class="hc-pay-tab <?php echo $active_tab === 'guide' ? 'active' : ''; ?>">💡 Hướng dẫn kết nối SePay.vn</a>
            <a href="?page=hieucon-payment-settings&tab=logs" class="hc-pay-tab <?php echo $active_tab === 'logs' ? 'active' : ''; ?>">📊 Lịch sử giao dịch</a>
        </div>

        <?php if ( $active_tab === 'config' ) : ?>
            <div class="hc-pay-grid">
                <!-- Cột trái: Form cấu hình -->
                <form action="options.php" method="post">
                    <?php
                    settings_fields('hieucon_payment_options');
                    do_settings_sections('hieucon_payment_options');
                    ?>
                    
                    <div class="hc-pay-card">
                        <h2 class="hc-pay-card-title">🔌 Cổng thanh toán SePay VietQR</h2>
                        
                        <table class="hc-pay-form-table">
                            <tr>
                                <td class="label-column">Kích hoạt phương thức?</td>
                                <td>
                                    <label class="hc-switch">
                                        <input type="checkbox" name="sepay_enabled" value="1" <?php checked($enabled, '1'); ?>>
                                        <span class="hc-slider"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">SePay API Key</td>
                                <td>
                                    <input type="password" name="sepay_api_key" value="<?php echo esc_attr($api_key); ?>" class="hc-pay-input-text" placeholder="sec_your_sepay_api_key_xxx">
                                    <p class="description" style="margin-top: 4px;">Điền API Key được cung cấp bởi SePay.vn (mục Tích hợp API).</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">SePay Secret Key (Chữ ký HMAC)</td>
                                <td>
                                    <input type="password" name="sepay_secret_key" value="<?php echo esc_attr($secret_key); ?>" class="hc-pay-input-text" placeholder="Nhập Secret Key từ SePay">
                                    <p class="description" style="margin-top: 4px;">Dùng để xác thực chữ ký bảo mật HMAC-SHA256 do SePay ký (xem Hướng dẫn kết nối).</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">Webhook Token (Bảo mật)</td>
                                <td>
                                    <input type="text" name="sepay_webhook_token" value="<?php echo esc_attr($webhook_token); ?>" class="hc-pay-input-text">
                                    <p class="description" style="margin-top: 4px;">Dùng để định danh webhook bảo mật của riêng website của bạn.</p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="hc-pay-card">
                        <h2 class="hc-pay-card-title">🏦 Thông tin tài khoản nhận tiền</h2>
                        
                        <table class="hc-pay-form-table">
                            <tr>
                                <td class="label-column">Ngân hàng nhận</td>
                                <td>
                                    <select name="sepay_bank_id" class="hc-pay-select">
                                        <?php foreach ( $supported_banks as $code => $name ) : ?>
                                            <option value="<?php echo esc_attr($code); ?>" <?php selected($bank_id, $code); ?>><?php echo esc_html($name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">Số tài khoản nhận</td>
                                <td>
                                    <input type="text" name="sepay_account_number" value="<?php echo esc_attr($acc_number); ?>" class="hc-pay-input-text" placeholder="Ví dụ: 0842...">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">Chủ tài khoản</td>
                                <td>
                                    <input type="text" name="sepay_account_name" value="<?php echo esc_attr($acc_name); ?>" class="hc-pay-input-text" placeholder="NGUYEN KHANH TOAN">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-column">Giao diện VietQR Template</td>
                                <td>
                                    <select name="sepay_qr_template" class="hc-pay-select">
                                        <?php foreach ( $templates as $val => $lbl ) : ?>
                                            <option value="<?php echo esc_attr($val); ?>" <?php selected($qr_template, $val); ?>><?php echo esc_html($lbl); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="hc-pay-card">
                        <h2 class="hc-pay-card-title">🔗 Cấu hình Webhook gửi về từ SePay.vn</h2>
                        <p style="font-size: 13px; line-height: 1.5; color: #64748b; margin-top: 0;">Sao chép một trong hai liên kết bên dưới để dán vào cấu hình Webhook trên trang quản trị SePay.vn của bạn:</p>
                        
                        <div class="hc-pay-webhook-box">
                            <span style="font-size: 11px; font-weight: 700; color: #0f766e; text-transform: uppercase;">1. Webhook URL Chuẩn (Khuyên dùng)</span>
                            <div class="hc-pay-url-display">
                                <span id="webhook-standard"><?php echo esc_url( home_url('/wp-json/sepay/v1/webhook') ); ?></span>
                                <button type="button" class="hc-pay-copy-btn" onclick="copyToClipboard('webhook-standard', 'Webhook URL Chuẩn')">Sao chép</button>
                            </div>
                        </div>

                        <div class="hc-pay-webhook-box" style="margin-top: 15px;">
                            <span style="font-size: 11px; font-weight: 700; color: #b45309; text-transform: uppercase;">2. Webhook URL Rút gọn (Dự phòng lỗi hosting chặn header)</span>
                            <div class="hc-pay-url-display" style="color: #fbbf24;">
                                <span id="webhook-fallback"><?php echo esc_url( home_url('/hooks/sepay-payment/' . $webhook_token) ); ?></span>
                                <button type="button" class="hc-pay-copy-btn" onclick="copyToClipboard('webhook-fallback', 'Webhook URL Rút gọn')">Sao chép</button>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <?php submit_button('Lưu tất cả thay đổi', 'primary', 'submit', true, array('style' => 'padding: 8px 24px; font-size:14px; font-weight:600; border-radius:10px; background: #0d9488; border-color: #0d9488;')); ?>
                    </div>
                </form>

                <!-- Cột phải: Live Preview và Thông tin trực quan -->
                <div class="hc-pay-sidebar">
                    <div class="hc-qr-preview-card">
                        <div class="hc-qr-preview-header">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981; display: inline-block;"></span> Live VietQR Preview
                        </div>
                        
                        <p style="font-size: 12px; color: #94a3b8; margin-top: 0; line-height: 1.5; margin-bottom: 20px;">Kiểm tra trực quan mã QR của bạn bằng cách nhập số tiền và nội dung bên dưới (mã QR sẽ tự động cập nhật ngay lập tức):</p>
                        
                        <!-- Form nhập tiền và nội dung test động -->
                        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 12px; margin-bottom: 20px; display: grid; grid-template-columns: 1.2fr 1fr; gap: 10px; text-align: left;">
                            <div>
                                <label style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 4px; font-weight:600;">Số tiền test (đ)</label>
                                <input type="number" id="hc-test-amount" value="5000" style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #ffffff; padding: 6px 10px; border-radius: 6px; font-size: 12px; font-family: monospace; outline: none;" oninput="updateLiveQR()">
                            </div>
                            <div>
                                <label style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 4px; font-weight:600;">Nội dung test</label>
                                <input type="text" id="hc-test-desc" value="TEST5000" style="width: 100%; background: #1e293b; border: 1px solid #334155; color: #ffffff; padding: 6px 10px; border-radius: 6px; font-size: 12px; font-family: monospace; outline: none;" oninput="updateLiveQR()">
                            </div>
                        </div>

                        <div class="hc-qr-frame">
                            <img id="hc-qr-img" src="https://qr.sepay.vn/img?bank=<?php echo esc_attr($bank_id); ?>&acc=<?php echo esc_attr($acc_number); ?>&template=<?php echo esc_attr($qr_template); ?>&amount=5000&des=TEST5000" alt="VietQR SePay Live View">
                        </div>

                        <div class="hc-qr-data-badge">
                            <div class="hc-qr-data-row">
                                <span class="hc-qr-data-lbl">Ngân hàng</span>
                                <span class="hc-qr-data-val"><?php echo esc_html($bank_id); ?></span>
                            </div>
                            <div class="hc-qr-data-row">
                                <span class="hc-qr-data-lbl">Số tài khoản</span>
                                <span class="hc-qr-data-val"><?php echo esc_html($acc_number); ?></span>
                            </div>
                            <div class="hc-qr-data-row">
                                <span class="hc-qr-data-lbl">Tên tài khoản</span>
                                <span class="hc-qr-data-val" style="text-transform: uppercase;"><?php echo esc_html($acc_name); ?></span>
                            </div>
                            <div class="hc-qr-data-row">
                                <span class="hc-qr-data-lbl">Số tiền quét</span>
                                <span class="hc-qr-data-val" id="hc-display-amount" style="color: #10b981; font-weight: bold;">5.000đ</span>
                            </div>
                            <div class="hc-qr-data-row">
                                <span class="hc-qr-data-lbl">Nội dung quét</span>
                                <span class="hc-qr-data-val" id="hc-display-desc" style="color: #fbbf24; font-weight: bold;">TEST5000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( $active_tab === 'guide' ) : ?>
            <div class="hc-guide-card">
                <h2 class="hc-pay-card-title" style="margin-bottom: 30px; font-size: 20px;">🚀 Các bước kết nối hệ thống tự động qua SePay.vn</h2>
                
                <div class="hc-guide-step">
                    <span class="hc-guide-step-num">1</span>
                    <h4>Đăng ký và liên kết tài khoản ngân hàng</h4>
                    <p>Truy cập <a href="https://sepay.vn/" target="_blank">sepay.vn</a>, đăng ký tài khoản. Trong màn hình quản trị của SePay, chọn "Liên kết ngân hàng" để tiến hành kết nối app ngân hàng nhận tiền của bạn (ví dụ MBBank, Vietcombank...).</p>
                </div>

                <div class="hc-guide-step">
                    <span class="hc-guide-step-num">2</span>
                    <h4>Tạo API Key</h4>
                    <p>Chọn menu "Tích hợp API" -> "API Keys" -> "Tạo API Key mới". Copy mã khóa (dạng `sec_...`) và dán vào ô "SePay API Key" ở tab <strong>Cài đặt chung</strong> trên website của bạn rồi Lưu lại.</p>
                </div>

                <div class="hc-guide-step">
                    <span class="hc-guide-step-num">3</span>
                    <h4>Cài đặt Webhook trên SePay.vn</h4>
                    <p>Chọn menu "Webhooks" -> "Thêm Webhook mới". Dán địa chỉ <strong>Webhook URL Chuẩn</strong> của website bạn vào ô URL nhận webhook. Phương thức chọn <code>POST</code>, kiểu <code>application/json</code>. Tại ô headers, điền: <code>x-api-key</code> với giá trị là API Key SePay của bạn. Sự kiện nhận: Tích chọn "Giao dịch tiền vào" (Transfer In).</p>
                    <p class="description" style="margin-top: 8px; color:#0d9488;"><strong>🔒 Khuyên dùng chữ ký bảo mật HMAC:</strong> Tại mục tạo Webhook trên SePay, bạn nên điền trường <strong>Secret Key</strong> để mã hóa xác thực request. Sau đó sao chép khóa này dán vào ô <strong>SePay Secret Key (Chữ ký HMAC)</strong> trong cài đặt chung của website để chống giả mạo request 100.</p>
                </div>

                <div class="hc-guide-step" style="margin-bottom: 0;">
                    <span class="hc-guide-step-num">4</span>
                    <h4>Thử nghiệm đối soát giao dịch</h4>
                    <p>Bấm nút "Kiểm tra thử nghiệm" tại webhook trên Dashboard SePay. Nếu SePay giả lập bắn tín hiệu thành công và website phản hồi OK (200) thì hệ thống của bạn đã hoạt động đồng bộ hoàn hảo!</p>
                </div>
            </div>

        <?php elseif ( $active_tab === 'logs' ) : ?>
            <div class="hc-pay-card" style="padding: 0; overflow: hidden; border-radius: 16px;">
                <div style="padding: 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <h2 class="hc-pay-card-title" style="margin: 0; padding: 0; border: none;">📊 Nhật ký 15 giao dịch SePay thô gần nhất</h2>
                    <span style="font-size: 11px; background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 9999px; font-weight: 600;">CSDL Đối soát tự động</span>
                </div>
                
                <?php if ( empty($transactions) ) : ?>
                    <div style="text-align: center; padding: 60px 20px; color: #64748b;">
                        <span style="font-size: 40px; display: block; margin-bottom: 10px;">💸</span>
                        <p style="font-size: 14px; font-weight: 600; margin: 0;">Chưa ghi nhận giao dịch nào qua Webhook SePay.</p>
                        <p style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Các giao dịch quét VietQR sẽ tự động lưu lại tại đây khi SePay bắn webhook về.</p>
                    </div>
                <?php else : ?>
                    <div style="overflow-x: auto;">
                        <table class="hc-log-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cổng</th>
                                    <th>Ngày GD</th>
                                    <th>Số tài khoản</th>
                                    <th>Tiền vào</th>
                                    <th>Tiền ra</th>
                                    <th>Mã KH</th>
                                    <th>Nội dung chuyển khoản</th>
                                    <th>Số tham chiếu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $transactions as $tx ) : ?>
                                    <tr>
                                        <td><strong><?php echo intval($tx->id); ?></strong></td>
                                        <td><span style="background:#e0f2fe; color:#0369a1; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px;"><?php echo esc_html($tx->gateway); ?></span></td>
                                        <td style="font-size:11px; color:#64748b;"><?php echo esc_html($tx->transaction_date); ?></td>
                                        <td style="font-family:monospace; font-size:12px;"><?php echo esc_html($tx->account_number); ?></td>
                                        <td>
                                            <?php if ( floatval($tx->amount_in) > 0 ) : ?>
                                                <span class="hc-amount-in">+<?php echo number_format($tx->amount_in, 0, ',', '.'); ?>đ</span>
                                            <?php else : ?>
                                                <span style="color:#94a3b8;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ( floatval($tx->amount_out) > 0 ) : ?>
                                                <span class="hc-amount-out">-<?php echo number_format($tx->amount_out, 0, ',', '.'); ?>đ</span>
                                            <?php else : ?>
                                                <span style="color:#94a3b8;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong style="color:#0d9488; font-family:monospace;"><?php echo esc_html($tx->code); ?></strong></td>
                                        <td style="font-size:12px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo esc_attr($tx->transaction_content); ?>">
                                            <?php echo esc_html($tx->transaction_content); ?>
                                        </td>
                                        <td style="font-family:monospace; font-size:11px; color:#64748b;"><?php echo esc_html($tx->reference_number); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Toast Notification -->
    <div id="hc-toast">Đã sao chép!</div>

    <script>
        function updateLiveQR() {
            const bank = '<?php echo esc_js($bank_id); ?>';
            const acc = '<?php echo esc_js($acc_number); ?>';
            const template = '<?php echo esc_js($qr_template); ?>';
            const amountInput = document.getElementById('hc-test-amount');
            const descInput = document.getElementById('hc-test-desc');
            
            const amount = amountInput.value || 0;
            const desc = descInput.value || '';
            
            // Build VietQR image URL dynamically
            const qrUrl = `https://qr.sepay.vn/img?bank=${bank}&acc=${acc}&template=${template}&amount=${amount}&des=${encodeURIComponent(desc)}`;
            
            document.getElementById('hc-qr-img').src = qrUrl;
            
            // Format number to currency format (VND)
            const formattedAmount = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount).replace(' ₫', 'đ');
            
            document.getElementById('hc-display-amount').innerText = formattedAmount;
            document.getElementById('hc-display-desc').innerText = desc;
        }

        function copyToClipboard(elementId, label) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                showToast(`Đã sao chép ${label}!`);
            });
        }

        function showToast(msg) {
            const toast = document.getElementById('hc-toast');
            toast.innerText = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }
    </script>
    <?php
}

/**
 * 4. ĐĂNG KÝ ROUTE REST API CHO WEBHOOK VÀ POLLING
 */
add_action('rest_api_init', 'hieucon_sepay_register_routes');
function hieucon_sepay_register_routes() {
    // A. Webhook tiếp nhận dữ liệu từ SePay: POST /wp-json/sepay/v1/webhook
    register_rest_route('sepay/v1', '/webhook', array(
        'methods'             => 'POST',
        'callback'            => 'hieucon_handle_sepay_webhook',
        'permission_callback' => '__return_true', // Kiểm tra khóa bảo mật sẽ được thực thi trong hàm callback
    ));

    // Webhook route phụ để tương thích: POST /wp-json/sepay-payment/v1/webhook
    register_rest_route('sepay-payment/v1', '/webhook', array(
        'methods'             => 'POST',
        'callback'            => 'hieucon_handle_sepay_webhook',
        'permission_callback' => '__return_true',
    ));

    // B. API Polling kiểm tra trạng thái thanh toán từ Frontend: GET /wp-json/hieucon/v1/payment-status?code=...
    register_rest_route('hieucon/v1', '/payment-status', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'hieucon_rest_get_payment_status',
        'permission_callback' => '__return_true',
        'args'                => array(
            'code' => array(
                'required'          => true,
                'sanitize_callback' => 'sanitize_text_field',
            ),
        ),
    ));

    // API Polling phụ để tương thích: GET /wp-json/sepay-payment/v1/status?code=...
    register_rest_route('sepay-payment/v1', '/status', array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'hieucon_rest_get_payment_status',
        'permission_callback' => '__return_true',
        'args'                => array(
            'code' => array(
                'required'          => true,
                'sanitize_callback' => 'sanitize_text_field',
            ),
        ),
    ));
}

/**
 * XỬ LÝ NHẬN TÍN HIỆU WEBHOOK TỪ SEPAY.VN
 */
function hieucon_handle_sepay_webhook(WP_REST_Request $request) {
    global $wpdb;

    // A. Kiểm tra cổng thanh toán đã được kích hoạt chưa
    $is_enabled = get_option('sepay_enabled', '0');
    if ( $is_enabled !== '1' ) {
        return new WP_Error('disabled', 'Cổng thanh toán SePay chưa được kích hoạt.', array('status' => 403));
    }

    // B. Kiểm tra bảo mật Token/API Key hoặc chữ ký mã hóa HMAC-SHA256
    $expected_key = get_option('sepay_api_key', '');
    $secret_key   = get_option('sepay_secret_key', '');

    $signature = $request->get_header('x-sepay-signature');
    if ( empty($signature) ) {
        $signature = $_SERVER['HTTP_X_SEPAY_SIGNATURE'] ?? '';
    }
    
    $timestamp = $request->get_header('x-sepay-timestamp');
    if ( empty($timestamp) ) {
        $timestamp = $_SERVER['HTTP_X_SEPAY_TIMESTAMP'] ?? '';
    }

    // Nếu có cấu hình Secret Key VÀ SePay gửi kèm các header chữ ký bảo mật -> Xác thực bằng HMAC-SHA256
    if ( ! empty($secret_key) && ! empty($signature) && ! empty($timestamp) ) {
        // Sử dụng HMAC-SHA256 Signature xác thực chữ ký mã hóa
        $payload = $request->get_body();
        if ( empty($payload) ) {
            $payload = file_get_contents('php://input');
        }

        $expected_signature = 'sha256=' . hash_hmac('sha256', $timestamp . '.' . $payload, $secret_key);

        if ( ! hash_equals($expected_signature, $signature) ) {
            return new WP_Error('unauthorized', 'Chữ ký bảo mật HMAC-SHA256 không hợp lệ.', array('status' => 401));
        }
    } else {
        // Fallback: Kiểm tra API Key tĩnh (qua Header x-api-key hoặc Authorization: Apikey <KEY>)
        if ( empty($expected_key) ) {
            return new WP_Error('missing_key', 'API Key SePay chưa được cấu hình trên website.', array('status' => 500));
        }

        $provided_key = $request->get_header('x-api-key');
        if ( empty($provided_key) ) {
            $provided_key = $request->get_header('x-sepay-api-key');
        }
        // Hỗ trợ định dạng gửi Authorization: Apikey <KEY>
        if ( empty($provided_key) ) {
            $auth_header = $request->get_header('authorization');
            if ( $auth_header && preg_match('/Apikey\s+(.*)/i', $auth_header, $m) ) {
                $provided_key = trim($m[1]);
            }
        }

        if ( $expected_key !== $provided_key ) {
            return new WP_Error('unauthorized', 'Mã bảo mật API Key không chính xác.', array('status' => 401));
        }
    }

    // C. Đọc và lọc sạch dữ liệu JSON từ SePay gửi về
    $params = $request->get_json_params();
    if ( empty($params) ) {
        return new WP_Error('no_data', 'Không nhận được dữ liệu JSON hợp lệ', array('status' => 400));
    }

    $data = array(
        'gateway'             => isset($params['gateway']) ? sanitize_text_field($params['gateway']) : '',
        'transaction_date'    => isset($params['transactionDate']) ? sanitize_text_field($params['transactionDate']) : '',
        'account_number'      => isset($params['accountNumber']) ? sanitize_text_field($params['accountNumber']) : '',
        'sub_account'         => isset($params['subAccount']) ? sanitize_text_field($params['subAccount']) : '',
        'code'                => isset($params['code']) ? sanitize_text_field($params['code']) : '',
        'transaction_content' => isset($params['content']) ? sanitize_textarea_field($params['content']) : '',
        'reference_number'    => isset($params['referenceCode']) ? sanitize_text_field($params['referenceCode']) : '',
        'body'                => isset($params['description']) ? sanitize_textarea_field($params['description']) : '',
        'accumulated'         => isset($params['accumulated']) ? floatval($params['accumulated']) : 0,
        'amount_in'           => 0,
        'amount_out'          => 0,
    );

    $transfer_amount = isset($params['transferAmount']) ? floatval($params['transferAmount']) : 0;
    $transfer_type   = isset($params['transferType']) ? sanitize_text_field($params['transferType']) : '';

    if ( 'in' === $transfer_type ) {
        $data['amount_in'] = $transfer_amount;
    } elseif ( 'out' === $transfer_type ) {
        $data['amount_out'] = $transfer_amount;
    }

    // D. Ghi nhận giao dịch thô vào bảng đối soát CSDL
    $table_name = $wpdb->prefix . 'sepay_transactions';
    $inserted = $wpdb->insert($table_name, $data);

    if ( $inserted ) {
        $transaction_id = $wpdb->insert_id;

        // Kích hoạt hook phụ để các module khác đón sự kiện giao dịch thô
        do_action('hieucon_sepay_transaction_received', $transaction_id, $data);

        // Tự động sử dụng Regex quét tìm mã đơn hàng dự phòng nếu AI SePay không tự tách được
        $payment_code = $data['code'];
        if ( empty($payment_code) && ! empty($data['transaction_content']) ) {
            // Định dạng mã đơn hàng: DH[Mã đơn hàng] ví dụ: DH205
            if ( preg_match('/DH[A-Za-z0-9]+/i', $data['transaction_content'], $matches) ) {
                $payment_code = strtoupper($matches[0]); // Chuẩn hóa viết hoa
            }
        }

        if ( ! empty($payment_code) ) {
            hieucon_mark_order_paid($payment_code, $data);
        }

        return new WP_REST_Response(array(
            'success' => true,
            'id'      => $transaction_id,
        ), 200);
    }

    return new WP_Error('db_error', 'Ghi nhận giao dịch vào CSDL lỗi.', array('status' => 500));
}

/**
 * GHI TRẠNG THÁI THANH TOÁN THÀNH CÔNG VÀ KÍCH HOẠT ACTION HOOKS
 */
function hieucon_mark_order_paid($payment_code, $transaction_data) {
    $payment_code = sanitize_text_field($payment_code);
    
    // Cập nhật trạng thái tạm vào WordPress Options
    update_option(
        'hieucon_payment_status_' . $payment_code,
        array(
            'status'     => 'paid',
            'updated_at' => current_time('mysql'),
            'transaction'=> $transaction_data
        ),
        false
    );

    // Kích hoạt action hook để các module/plugin nghiệp vụ đón nhận và xử lý (ví dụ: kích hoạt khóa học)
    do_action('hieucon_order_paid', $payment_code, $transaction_data);
}

/**
 * XỬ LÝ TRẢ VỀ TRẠNG THÁI THANH TOÁN (POLLING TỪ TRÌNH DUYỆT KHÁCH HÀNG)
 */
function hieucon_rest_get_payment_status(WP_REST_Request $request) {
    $code = $request->get_param('code');
    if ( empty($code) ) {
        return new WP_Error('missing_code', 'Thiếu mã thanh toán (code).', array('status' => 400));
    }

    $status_data = get_option('hieucon_payment_status_' . $code, null);

    if ( empty($status_data) ) {
        return rest_ensure_response(array(
            'paid'  => false,
            'code'  => $code,
            'found' => false,
        ));
    }

    return rest_ensure_response(array(
        'paid'       => isset($status_data['status']) && 'paid' === $status_data['status'],
        'code'       => $code,
        'updated_at' => isset($status_data['updated_at']) ? $status_data['updated_at'] : null,
        'transaction'=> isset($status_data['transaction']) ? $status_data['transaction'] : null,
    ));
}

/**
 * 5. ĐĂNG KÝ REWRITE RULES DÀNH CHO URL WEBHOOK RÚT GỌN (DỰ PHÒNG CHẶN HEADER)
 * Định dạng: https://yourdomain.com/hooks/sepay-payment/[token]
 */
function hieucon_sepay_register_rewrite_rules() {
    add_rewrite_rule(
        '^hooks/sepay-payment/?([^/]*)/?$',
        'index.php?sepay_hook=1&token=$matches[1]',
        'top'
    );
}
add_action('init', 'hieucon_sepay_register_rewrite_rules');

function hieucon_sepay_register_query_vars($vars) {
    $vars[] = 'sepay_hook';
    $vars[] = 'token';
    return $vars;
}
add_filter('query_vars', 'hieucon_sepay_register_query_vars');

function hieucon_sepay_handle_rewrite_redirect() {
    if ( intval(get_query_var('sepay_hook', 0)) !== 1 ) {
        return;
    }

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        status_header(405);
        wp_send_json_error(array('message' => 'Method Not Allowed'), 405);
    }

    $token = get_query_var('token', '');
    $saved_token = get_option('sepay_webhook_token', '');

    if ( empty($saved_token) || $token !== $saved_token ) {
        status_header(401);
        wp_send_json_error(array('message' => 'Mã Webhook Token không khớp hoặc chưa được cấu hình.'), 401);
    }

    $body = file_get_contents('php://input');
    $json = json_decode($body, true);

    // Giả lập một request REST API nội bộ truyền tới webhook chuẩn
    $request = new WP_REST_Request('POST', '/sepay/v1/webhook');
    $request->set_json_params($json);
    
    // Tự điền API Key kỳ vọng để bypass check header do chúng ta đã kiểm tra bằng Token rút gọn
    $api_key = get_option('sepay_api_key', '');
    $request->set_header('x-api-key', $api_key);

    // Truyền tiếp các header chữ ký bảo mật HMAC nếu có gửi kèm từ SePay
    $signature = $_SERVER['HTTP_X_SEPAY_SIGNATURE'] ?? '';
    $timestamp = $_SERVER['HTTP_X_SEPAY_TIMESTAMP'] ?? '';
    if ( ! empty( $signature ) ) {
        $request->set_header('x-sepay-signature', $signature);
    }
    if ( ! empty( $timestamp ) ) {
        $request->set_header('x-sepay-timestamp', $timestamp);
    }

    $response = hieucon_handle_sepay_webhook($request);

    if ( is_wp_error($response) ) {
        $status = $response->get_error_data()['status'] ?? 500;
        status_header($status);
        wp_send_json_error(array('message' => $response->get_error_message()), $status);
    }

    if ( $response instanceof WP_REST_Response ) {
        $status = $response->get_status();
        $data = $response->get_data();
        status_header($status);
        wp_send_json_success($data, $status);
    }

    wp_send_json($response);
    exit;
}
add_action('template_redirect', 'hieucon_sepay_handle_rewrite_redirect');

/**
 * 6. AJAX HẬU TRƯỜNG KÍCH HOẠT HỌC VIÊN SAU KHI ĐÃ ĐỐI SOÁT THANH TOÁN THÀNH CÔNG
 */
add_action( 'wp_ajax_hieucon_create_paid_order', 'hieucon_handle_create_paid_order' );
add_action( 'wp_ajax_nopriv_hieucon_create_paid_order', 'hieucon_handle_create_paid_order' );

function hieucon_handle_create_paid_order() {
    // 1. Xác thực bảo mật Nonce
    if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'hieucon_payment_nonce') ) {
        wp_send_json_error(array('message' => 'Phiên giao dịch đã hết hạn. Vui lòng tải lại trang.'));
    }

    // 2. Kiểm tra Đăng nhập hội viên
    if ( ! is_user_logged_in() ) {
        wp_send_json_error(array('message' => 'Vui lòng đăng nhập để hoàn tất đăng ký khóa học.'));
    }

    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    // 3. Lấy thông số từ client gửi lên
    $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
    $amount    = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $code      = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : ''; // e.g. DH1002

    if ( ! $course_id || ! get_post($course_id) ) {
        wp_send_json_error(array('message' => 'Khóa học được chọn không hợp lệ hoặc không tồn tại.'));
    }

    // 4. KIỂM TRA CHÉO BẢO MẬT: Kiểm tra xem giao dịch đã thực sự được Webhook SePay báo có tiền chưa
    $payment_check = get_option('hieucon_payment_status_' . $code, null);
    if ( empty($payment_check) || $payment_check['status'] !== 'paid' ) {
        wp_send_json_error(array('message' => 'Hệ thống chưa nhận được khoản tiền chuyển khoản thực tế cho mã giao dịch này.'));
    }

    // 5. KÍCH HOẠT KHÓA HỌC CHO HỌC VIÊN
    $enrolled = get_option("hieucon_enrolled_courses_{$user_id}", null);
    if ( ! is_array($enrolled) ) {
        $enrolled = array();
    }
    
    if ( ! in_array($course_id, $enrolled) ) {
        $enrolled[] = $course_id;
        update_option("hieucon_enrolled_courses_{$user_id}", $enrolled, false);
    }

    // 6. Xóa sạch option tạm của trạng thái thanh toán để tiết kiệm tài nguyên CSDL
    delete_option('hieucon_payment_status_' . $code);

    // Bắn hook phụ nếu dev muốn liên kết thêm API gửi sang Pancake POS hoặc Pancake CRM
    do_action('hieucon_ajax_payment_activation_success', $user_id, $course_id, $amount, $code);

    wp_send_json_success(array(
        'message'    => 'Xác nhận thanh toán thành công và đã kích hoạt khóa học!',
        'course_url' => get_permalink($course_id)
    ));
}
