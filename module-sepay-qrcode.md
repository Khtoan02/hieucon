# TÀI LIỆU KỸ THUẬT & HƯỚNG DẪN TRIỂN KHAI HỆ THỐNG THANH TOÁN TỰ ĐỘNG VIETQR VỚI SEPAY (ĐỘC LẬP - TÁI SỬ DỤNG 100%)

Tài liệu này đặc tả chi tiết kiến trúc, nguyên lý hoạt động, cơ chế bảo mật và cung cấp mã nguồn hoàn chỉnh (Backend PHP + Frontend JS/HTML) của **Module Thanh toán VietQR Code tích hợp SePay**. 

Module được thiết kế theo mô hình **Hướng sự kiện (Hook-driven)**, tách biệt hoàn toàn khỏi logic nghiệp vụ của website (như E-learning, Bán lẻ WooCommerce, membership...), giúp bạn dễ dàng cắm ghép (Plug-and-Play) vào bất kỳ dự án WordPress nào trong tương lai chỉ bằng việc cấu hình.

---

## PHẦN I: BẢN CHẤT VẬN HÀNH & SƠ ĐỒ LUỒNG DỮ LIỆU

Để đảm bảo an toàn tuyệt đối, tránh việc khách hàng can thiệp sửa đổi giá tiền hoặc hack hệ thống bằng JavaScript, luồng dữ liệu của module được chia làm 4 giai đoạn khép kín như sau:

```
[Khách Hàng] 
     │  (1) Quét mã QR chứa mã chuyển khoản (VD: "DH502")
     ▼
[Ngân Hàng Nhận] ──(2) Báo có tiền ──► [Hệ thống SePay]
                                             │
                                      (3) Bắn Webhook chứa nội dung "DH502"
                                             ▼
[Trình Duyệt Khách] ◄──(4) Trả về "DH502: Đã nhận" ─── [Website của bạn (DB)]
```

1. **Giai đoạn 1 (Khởi tạo & Hiển thị QR):** Server tạo ra mã thanh toán duy nhất (ví dụ `DH502` cho đơn hàng ID 502) và số tiền chính xác. Trình duyệt render mã VietQR động chứa sẵn số tiền và nội dung `DH502`.
2. **Giai đoạn 2 (Khách chuyển tiền):** Khách quét QR, app ngân hàng tự động điền đúng số tiền và nội dung chuyển khoản. Khách hàng xác nhận chuyển khoản trên điện thoại.
3. **Giai đoạn 3 (Đối soát giao dịch tự động):** Ngân hàng báo có -> SePay bắt biến động số dư -> SePay dùng AI trích xuất mã chuyển khoản `DH502` -> SePay gửi `POST Webhook` chứa API Key bảo mật về máy chủ WordPress của bạn. Máy chủ xác thực API Key, ghi nhận giao dịch vào CSDL, đổi trạng thái mã `DH520` thành `paid` và kích hoạt Action Hook để thông báo cho các phần mềm khác biết.
4. **Giai đoạn 4 (Phản hồi thời gian thực - Real-time Polling):** Trình duyệt khách hàng gọi liên tục (mỗi 5 giây) lên máy chủ thông qua REST API public để hỏi xem giao dịch `DH502` đã được ghi nhận `paid` chưa. Khi máy chủ trả về `paid: true`, trình duyệt lập tức hiển thị thông báo thành công và chuyển hướng trang.

---

## PHẦN II: CẤU HÌNH 4 THAM SỐ CỐT LÕI (AMOUNT, DESCRIPTION, STATUS, ACCEPT)

Khi cấu hình tích hợp cho bất kỳ website mới nào, bạn bắt buộc phải hiểu rõ cách thiết lập và kiểm soát 4 tham số này:

### 1. Giá trị tiền (Amount)
* **Khởi tạo:** Giá trị tiền thanh toán phải được tính toán trên Server (Tổng tiền giỏ hàng, giảm giá, phí vận chuyển) và lưu vào phiên làm việc hoặc CSDL tạm, tuyệt đối không lấy trực tiếp từ ô nhập liệu HTML (tránh khách hàng bấm F12 đổi giá tiền).
* **Giao diện:** Truyền trực tiếp giá trị này vào Javascript SDK để sinh ảnh mã QR: `https://qr.sepay.vn/img?bank=...&amount=500000...`
* **Kiểm tra bảo mật (Đối soát ngược):** Khi Webhook SePay báo có tiền, hệ thống nhận được tham số `transferAmount` (số tiền thực chuyển). Ở hàm xử lý nghiệp vụ, bắt buộc phải đối chiếu số tiền thực chuyển này với số tiền kỳ vọng của đơn hàng:
  ```php
  $real_paid = floatval($transaction_data['amount_in']); // Số tiền thực chuyển từ Webhook
  $expected = floatval($expected_order_amount); // Số tiền của đơn hàng trên CSDL
  
  if ($real_paid < $expected) {
      // Giao dịch chuyển thiếu tiền! Ghi log và không kích hoạt dịch vụ tự động
      return; 
  }
  ```

### 2. Nội dung chuyển khoản (Payment Code)
* **Cấu trúc:** Phải là chuỗi ký tự viết liền không dấu, không khoảng trắng và không chứa ký tự đặc biệt (để tránh AI của ngân hàng hoặc SePay phân tách lỗi). Bạn nên dùng tiền tố cố định kèm ID bản ghi (Ví dụ: `DH1024` - đơn hàng 1024, `VIP95` - user nâng cấp 95).
* **Regex dự phòng:** Trong trường hợp SePay không tự bóc tách được mã sạch, hệ thống backend sử dụng Regex quét toàn bộ nội dung chuyển khoản thô (`transaction_content`) để tìm mã đơn hàng:
  ```php
  if (preg_match('/DH[A-Za-z0-9]+/i', $data['transaction_content'], $matches)) {
      $payment_code = strtoupper($matches[0]); // Chuẩn hóa viết hoa e.g. DH1024
  }
  ```

### 3. Trạng thái thanh toán tạm thời (Payment Status)
* **Nơi lưu:** Sử dụng bảng `wp_options` của WordPress với định danh `sepay_payment_status_[Mã_Thanh_Toán]` (Ví dụ: `sepay_payment_status_DH1024`).
* **Dữ liệu lưu:** Lưu mảng dữ liệu bao gồm trạng thái `status => paid`, thời gian cập nhật và dữ liệu thô của giao dịch.
* **Tự động dọn dẹp (Garbage Collector):** Để tránh phình to CSDL sau hàng nghìn đơn hàng, ngay khi API Polling của Frontend gọi lên và nhận diện trạng thái `paid: true` thành công, hệ thống backend sẽ tự động xóa option tạm này bằng lệnh:
  ```php
  delete_option('sepay_payment_status_' . $code);
  ```

### 4. Trạng thái duyệt thành công an toàn (Accept Status)
* **Nguyên tắc an toàn:** Không bao giờ để mã JavaScript ở trình duyệt tự quyết định việc kích hoạt đơn hàng hay mở khóa học. Mọi hành động kích hoạt dịch vụ thực tế (Accept) phải được thực thi trực tiếp trên máy chủ bằng PHP thông qua cơ chế Hook:
  * Khi Webhook nhận diện tiền thành công -> Ghi trạng thái `paid` lên database -> Bắn ra Hook `sepay_payment_completed`.
  * Lập trình viên viết hàm nghiệp vụ móc nối (Hook Listener) đón sự kiện trên để chính thức kích hoạt đơn hàng/nâng VIP cho tài khoản.

---

## PHẦN III: MÃ NGUỒN BACKEND PHP MODULE (`class-sepay-payment-module.php`)

Đây là mã nguồn Backend hoàn toàn độc lập, viết theo hướng hướng đối tượng (OOP Singleton). Bạn chỉ cần lưu mã nguồn này thành file `class-sepay-payment-module.php` và nhúng trực tiếp vào theme mới của bạn.

```php
<?php
/**
 * Standalone SePay QR Code Payment Module
 * Author: Antigravity AI Pair Programming
 * Version: 1.0.0
 * Decoupled & Hook-driven
 */

if (!defined('ABSPATH')) {
    exit; // Chống truy cập trực tiếp
}

class Standalone_SePay_Payment_Module {

    private static $instance = null;
    private $table_name;

    // ==========================================
    // THIẾT LẬP CẤU HÌNH BẢO MẬT (CẦN SỬA KHI CONFIG WEB MỚI)
    // ==========================================
    private $api_key = 'sec_your_sepay_api_key'; // Khóa bảo mật API Key từ SePay.vn
    private $webhook_token = 'secure_url_token_fallback'; // Token dự phòng cho URL ngắn

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'sepay_transactions';

        // Tự động kiểm tra và tạo bảng khi khởi động hệ thống
        add_action('init', array($this, 'ensure_database_table'));

        // Đăng ký REST API Webhook & Trạng thái Polling
        add_action('rest_api_init', array($this, 'register_rest_routes'));

        // Đăng ký luồng Rewrite URL ngắn cho Webhook (Trường hợp Web chặn Header x-api-key)
        add_action('init', array($this, 'register_rewrite_rules'));
        add_action('template_redirect', array($this, 'handle_rewrite_redirect'));
        add_filter('query_vars', array($this, 'register_query_vars'));
    }

    /**
     * TỰ ĐỘNG TẠO BẢNG CSDL ĐỐI SOÁT GIAO DỊCH THÔ
     */
    public function ensure_database_table() {
        global $wpdb;

        $existing = $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $this->table_name));
        if ($existing === $this->table_name) {
            return;
        }

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table_name} (
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
    }

    /**
     * ĐĂNG KÝ CÁC ROUTE REST API ĐỘC LẬP
     */
    public function register_rest_routes() {
        // 1. Webhook tiếp nhận dữ liệu từ SePay: POST /wp-json/sepay-payment/v1/webhook
        register_rest_route('sepay-payment/v1', '/webhook', array(
            'methods'             => 'POST',
            'callback'            => array($this, 'handle_sepay_webhook'),
            'permission_callback' => '__return_true', // Xác thực API Key sẽ được xử lý trong callback
        ));

        // 2. API Polling kiểm tra trạng thái từ Frontend: GET /wp-json/sepay-payment/v1/status?code=...
        register_rest_route('sepay-payment/v1', '/status', array(
            'methods'             => WP_REST_Server::READABLE,
            'callback'            => array($this, 'handle_get_payment_status'),
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
     * XỬ LÝ NHẬN WEBHOOK TỪ SEPAY.VN
     */
    public function handle_sepay_webhook(WP_REST_Request $request) {
        global $wpdb;

        // A. Kiểm tra Token/API Key bảo mật gửi kèm trong Headers
        $provided_key = $request->get_header('x-api-key');
        if (empty($provided_key)) {
            $provided_key = $request->get_header('x-sepay-api-key');
        }
        if (empty($provided_key)) {
            $auth_header = $request->get_header('authorization');
            if ($auth_header && preg_match('/Apikey\s+(.*)/i', $auth_header, $m)) {
                $provided_key = trim($m[1]);
            }
        }

        if ($this->api_key !== $provided_key) {
            return new WP_Error('unauthorized', 'Khóa bảo mật API Key không chính xác.', array('status' => 401));
        }

        // B. Đọc và lọc sạch dữ liệu JSON từ SePay gửi về
        $params = $request->get_json_params();
        if (empty($params)) {
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

        if ('in' === $transfer_type) {
            $data['amount_in'] = $transfer_amount;
        } elseif ('out' === $transfer_type) {
            $data['amount_out'] = $transfer_amount;
        }

        // C. Ghi nhận giao dịch thô vào bảng đối soát CSDL
        $inserted = $wpdb->insert($this->table_name, $data);

        if ($inserted) {
            $transaction_id = $wpdb->insert_id;

            // Tự động sử dụng Regex quét tìm mã đơn hàng dự phòng nếu AI SePay không tự tách được
            $payment_code = $data['code'];
            if (empty($payment_code) && !empty($data['transaction_content'])) {
                if (preg_match('/DH[A-Za-z0-9]+/i', $data['transaction_content'], $matches)) {
                    $payment_code = strtoupper($matches[0]);
                }
            }

            if (!empty($payment_code)) {
                $this->mark_payment_code_paid($payment_code, $data);
            }

            return new WP_REST_Response(array(
                'success' => true,
                'id'      => $transaction_id,
            ), 200);
        }

        return new WP_Error('db_error', 'Ghi nhận giao dịch vào CSDL lỗi.', array('status' => 500));
    }

    /**
     * GHI TRẠNG THÁI THANH TOÁN THÀNH CÔNG VÀ KÍCH HOẠT SỰ KIỆN HOÀN TẤT (HOOKS)
     */
    private function mark_payment_code_paid($payment_code, $transaction_data) {
        $payment_code = sanitize_text_field($payment_code);
        
        // Cập nhật trạng thái tạm vào WordPress Options
        update_option(
            'sepay_payment_status_' . $payment_code,
            array(
                'status'     => 'paid',
                'updated_at' => current_time('mysql'),
                'transaction'=> $transaction_data
            ),
            false
        );

        /**
         * 🌟 TRÁI TIM CƠ CHẾ ĐỘC LẬP: KÍCH HOẠT ACTION HOOK CHO DỰ ÁN
         * Cho phép bất kỳ Module/Plugin nghiệp vụ nào bên ngoài "lắng nghe" và thực thi logic tương ứng.
         */
        do_action('sepay_payment_completed', $payment_code, $transaction_data);
    }

    /**
     * XỬ LÝ TRẢ TRẠNG THÁI THANH TOÁN (POLLING TỪ TRÌNH DUYỆT KHÁCH)
     */
    public function handle_get_payment_status(WP_REST_Request $request) {
        $code = $request->get_param('code');
        $status_data = get_option('sepay_payment_status_' . $code, null);

        if (empty($status_data)) {
            return rest_ensure_response(array(
                'paid'  => false,
                'code'  => $code,
                'found' => false,
            ));
        }

        // Tự động xóa dọn sạch rác trong Options DB sau khi client nhận diện đã thanh toán thành công
        if (isset($status_data['status']) && $status_data['status'] === 'paid') {
            delete_option('sepay_payment_status_' . $code);
        }

        return rest_ensure_response(array(
            'paid'       => isset($status_data['status']) && 'paid' === $status_data['status'],
            'code'       => $code,
            'updated_at' => isset($status_data['updated_at']) ? $status_data['updated_at'] : null,
            'transaction'=> isset($status_data['transaction']) ? $status_data['transaction'] : null,
        ));
    }

    /**
     * ĐĂNG KÝ REWRITE RULES DÀNH CHO URL WEBHOOK RÚT GỌN (DỰ PHÒNG CHẶN HEADER)
     * Trực tiếp: https://yourdomain.com/hooks/sepay-payment/[token]
     */
    public function register_rewrite_rules() {
        add_rewrite_rule(
            '^hooks/sepay-payment/?([^/]*)/?$',
            'index.php?sepay_hook=1&token=$matches[1]',
            'top'
        );
    }

    public function register_query_vars($vars) {
        $vars[] = 'sepay_hook';
        $vars[] = 'token';
        return $vars;
    }

    public function handle_rewrite_redirect() {
        if (intval(get_query_var('sepay_hook', 0)) !== 1) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            status_header(405);
            wp_send_json_error(array('message' => 'Method Not Allowed'), 405);
        }

        $token = get_query_var('token', '');
        if (!empty($this->webhook_token) && $token !== $this->webhook_token) {
            status_header(401);
            wp_send_json_error(array('message' => 'Unauthorized URL Token'), 401);
        }

        $body = file_get_contents('php://input');
        $json = json_decode($body, true);

        // Giả lập một request REST API nội bộ truyền tới callback
        $request = new WP_REST_Request('POST', '/sepay-payment/v1/webhook');
        $request->set_json_params($json);
        $request->set_header('x-api-key', $this->api_key);

        $response = $this->handle_sepay_webhook($request);

        if (is_wp_error($response)) {
            $status = $response->get_error_data()['status'] ?? 500;
            status_header($status);
            wp_send_json_error(array('message' => $response->get_error_message()), $status);
        }

        if ($response instanceof WP_REST_Response) {
            $status = $response->get_status();
            $data = $response->get_data();
            status_header($status);
            wp_send_json_success($data, $status);
        }

        wp_send_json($response);
        exit;
    }
}

// Khởi tạo
Standalone_SePay_Payment_Module::get_instance();
```

---

## PHẦN IV: CÁCH DÙNG ACTION HOOK TẠI WEBSITE NGHIỆP VỤ

Khi module chạy, bạn chỉ cần mở file `functions.php` hoặc tạo một plugin nhỏ trên bất kỳ website nào để lắng nghe sự kiện thanh toán thành công và thực thi nghiệp vụ kích hoạt tương ứng:

```php
<?php
/**
 * Đón sự kiện thanh toán thành công qua SePay để nâng cấp VIP tài khoản
 */
add_action('sepay_payment_completed', 'web_moi_auto_upgrade_vip_status', 10, 2);

function web_moi_auto_upgrade_vip_status($payment_code, $transaction_data) {
    
    // Giả sử cú pháp mã thanh toán thiết lập là: VIP[UserID] -> e.g. VIP205
    if (strpos($payment_code, 'VIP') === 0) {
        $user_id = intval(str_replace('VIP', '', $payment_code));
        $amount_paid = floatval($transaction_data['amount_in']); // Tiền thực nhận
        
        $vip_price = 500000; // Giá tiền gói VIP cần đối soát bảo mật
        
        // 1. Kiểm tra chéo số tiền thực chuyển để tránh gian lận chuyển thiếu tiền
        if ($amount_paid < $vip_price) {
            error_log("CẢNH BÁO: Người dùng ID {$user_id} chuyển khoản thiếu tiền gói VIP. Thực chuyển: {$amount_paid}đ");
            return;
        }

        // 2. Kích hoạt VIP và thời hạn cho User trên hệ thống
        update_user_meta($user_id, 'member_vip_rank', 'premium');
        update_user_meta($user_id, 'vip_expire_date', date('Y-m-d H:i:s', strtotime('+30 days')));

        // 3. Gửi Email thông báo thành công cho thành viên
        $user_info = get_userdata($user_id);
        wp_mail(
            $user_info->user_email,
            'Nâng cấp tài khoản Premium VIP thành công!',
            "Xin chào {$user_info->display_name}, tài khoản Premium VIP của bạn đã được kích hoạt thành công tự động qua VietQR code."
        );
        
        error_log("Kích hoạt VIP thành công cho người dùng ID: " . $user_id);
    }
}
```

---

## PHẦN V: FRONTEND JS SDK & GIAO DIỆN THANH TOÁN HOÀN CHỈNH

Dưới đây là mã nguồn Giao diện thanh toán VietQR động cao cấp được thiết kế bằng **Tailwind CSS** tích hợp hiệu ứng Scan Laser động và **Lớp JS SDK `SePayPaymentScanner`** độc lập để xử lý Polling:

### 1. File Template Giao diện (`payment-page.php`)

```php
<?php
/**
 * Template Name: Giao diện Quét VietQR Thanh Toán Độc Lập
 * @package WordPressTheme
 */

get_header();

// Giả định thông số đơn hàng truyền từ Session hoặc URL quy định độc lập
$payment_amount = isset($_GET['amount']) ? floatval($_GET['amount']) : 150000;
$payment_code   = isset($_GET['code']) ? sanitize_text_field($_GET['code']) : 'VIP' . get_current_user_id() . 'T' . time();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Tự Động Qua VietQR Code</title>
    <!-- Tailwind CSS CDN cho giao diện cao cấp -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .copy-btn:active { transform: scale(0.95); }
        .scan-laser {
            width: 100%; height: 3px; background: #10b981;
            position: absolute; z-index: 10;
            animation: laser 3s infinite linear;
            box-shadow: 0 0 10px #10b981;
        }
        @keyframes laser {
            0% { top: 0; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen py-12 px-4 flex items-center justify-center">
        <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden grid grid-cols-1 md:grid-cols-12">
            
            <!-- CỘT TRÁI: KHU VỰC QUÉT MÃ QR (5 Cột) -->
            <div class="md:col-span-5 bg-slate-900 p-8 flex flex-col items-center justify-center relative text-white">
                <div class="absolute top-4 left-4 flex items-center gap-1 text-xs text-slate-400 bg-slate-800/60 px-3 py-1 rounded-full border border-slate-700">
                    <i class="fas fa-shield-alt text-emerald-400"></i> Thanh toán an toàn
                </div>

                <div class="text-center mb-6 mt-4">
                    <p class="text-slate-450 text-[11px] font-bold uppercase tracking-wider mb-1">Số tiền thanh toán</p>
                    <h2 class="text-3xl font-black text-emerald-400 font-mono"><?php echo number_format($payment_amount, 0, ',', '.'); ?>đ</h2>
                    <p class="text-slate-400 text-[10px] mt-1">Nội dung: <?php echo esc_html($payment_code); ?></p>
                </div>

                <!-- Khung hiển thị QR động -->
                <div class="relative w-56 h-56 bg-white p-2.5 rounded-2xl shadow-xl border border-slate-800 overflow-hidden flex items-center justify-center">
                    <!-- Loader khi đang sinh mã -->
                    <div id="qrLoading" class="absolute inset-0 bg-slate-900 flex flex-col items-center justify-center gap-2 z-20">
                        <i class="fas fa-circle-notch fa-spin text-3xl text-emerald-400"></i>
                        <p class="text-[10px] text-slate-400">Đang khởi tạo mã QR...</p>
                    </div>
                    
                    <img id="qrImage" src="" class="w-full h-full object-contain rounded-xl z-10" alt="VietQR SePay" style="display: none;">
                    
                    <!-- Hiệu ứng Laser quét động -->
                    <div class="absolute inset-0 pointer-events-none rounded-xl overflow-hidden">
                        <div class="scan-laser"></div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-xs text-slate-400 flex items-center justify-center gap-1.5">
                        Mã hết hạn sau: 
                        <span id="timerText" class="font-bold text-emerald-400 font-mono bg-slate-850 px-2 py-0.5 rounded border border-slate-700">15:00</span>
                    </p>
                </div>
            </div>

            <!-- CỘT PHẢI: CHI TIẾT CHUYỂN KHOẢN THỦ CÔNG (7 Cột) -->
            <div class="md:col-span-7 p-8 md:p-10 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center gap-2 pb-4 border-b border-slate-100">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500"><i class="fas fa-university"></i></span>
                        Thông Tin Chuyển Khoản Thủ Công
                    </h3>

                    <!-- Cấu hình tài khoản nhận tiền -->
                    <div class="space-y-4">
                        <!-- Số tài khoản -->
                        <div onclick="copyData('acc-number', 'Số tài khoản')" class="bg-slate-50 border border-slate-200/60 rounded-xl p-4 cursor-pointer hover:border-slate-300 transition relative group">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Số Tài Khoản Nhận</span>
                            <div class="flex justify-between items-center">
                                <span id="acc-number" class="text-xl font-mono font-black text-slate-900 tracking-wider">VQRQAFUAF0842</span>
                                <button class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-emerald-500 border border-slate-200 copy-btn">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Ngân hàng -->
                            <div class="bg-slate-50 border border-slate-200/60 rounded-xl p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Ngân Hàng</span>
                                <div class="flex items-center gap-2">
                                    <img src="https://img.icons8.com/color/48/mb-bank.png" class="w-5 h-5 object-contain" alt="MB Bank">
                                    <span class="font-bold text-slate-900 text-sm">MB Bank</span>
                                </div>
                            </div>
                            <!-- Tên chủ tài khoản -->
                            <div class="bg-slate-50 border border-slate-200/60 rounded-xl p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Chủ Tài Khoản</span>
                                <span class="font-bold text-slate-900 text-sm uppercase">Nguyễn Khánh Toàn</span>
                            </div>
                        </div>

                        <!-- Nội dung chuyển khoản (BẮT BUỘC CHÍNH XÁC) -->
                        <div onclick="copyData('transfer-content', 'Nội dung chuyển khoản')" class="bg-amber-50 border border-amber-200 rounded-xl p-4 cursor-pointer hover:border-amber-400 transition relative group">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-exclamation-triangle"></i> Nội Dung Chuyển Khoản (Bắt buộc)
                                </span>
                                <span class="text-[9px] bg-amber-500 text-white px-1.5 py-0.5 rounded font-extrabold shrink-0">BẮT BUỘC</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span id="transfer-content" class="text-lg font-mono font-bold text-slate-900"><?php echo esc_html($payment_code); ?></span>
                                <button class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-amber-600 border border-amber-200 copy-btn">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phần trạng thái và nút đối soát ngay -->
                <div class="mt-8 pt-6 border-t border-slate-100 space-y-4">
                    <div class="flex items-center justify-between bg-slate-900 text-white rounded-2xl p-4 border border-slate-800">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-full bg-slate-850 flex items-center justify-center text-emerald-400 animate-pulse">
                                <i class="fas fa-circle-notch fa-spin text-sm"></i>
                            </span>
                            <div>
                                <p class="text-xs font-bold">Trạng thái thanh toán</p>
                                <p id="statusLabel" class="text-[11px] text-slate-400">Đang chờ giao dịch tự động...</p>
                            </div>
                        </div>
                        <button id="btnScanNow" class="text-xs px-3 py-1.5 bg-emerald-500 text-slate-900 font-bold rounded-lg hover:bg-emerald-400 transition">Kiểm tra ngay</button>
                    </div>

                    <p class="text-[10px] text-slate-400 text-center leading-relaxed">
                        Hệ thống đối soát SePay sẽ tự động ghi nhận giao dịch của bạn trong vòng 1-3 phút. Nếu có bất kỳ sự cố chậm trễ nào, vui lòng liên hệ hotline hỗ trợ.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL THÔNG BÁO THÀNH CÔNG -->
    <div id="successOverlay" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl border-4 border-emerald-100">
            <div class="w-16 h-16 bg-emerald-50 border border-emerald-100 text-emerald-500 text-3xl rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-check-circle"></i>
            </div>
            <h4 class="text-xl font-black text-slate-900 mb-2">Thanh Toán Thành Công!</h4>
            <p class="text-xs text-slate-500 mb-6">Mã giao dịch của bạn đã được xác nhận tự động trên hệ thống. Dịch vụ Premium VIP của bạn đã được nâng cấp.</p>
            <button onclick="window.location.reload();" class="w-full py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">Quay lại Trang Chủ</button>
        </div>
    </div>

    <!-- JAVASCRIPT SDK KẾT NỐI -->
    <script>
        /**
         * Standalone JavaScript SDK for SePay VietQR Polling
         */
        class SePayPaymentScanner {
            
            constructor(config) {
                this.bankId = config.bankId || 'MBBank';
                this.accountNo = config.accountNo || '';
                this.amount = parseFloat(config.amount) || 0;
                this.code = config.code || '';
                this.template = config.template || 'qronly';
                this.pollingInterval = config.pollingInterval || 5000;
                this.timeoutLimit = config.timeoutLimit || 900; // 15 phút
                
                // Callbacks
                this.onSuccess = config.onSuccess || function(data) {};
                this.onChecking = config.onChecking || function(text) {};
                this.onTimeout = config.onTimeout || function() {};
                
                this.timer = null;
                this.countdownTimer = null;
                this.timeLeft = this.timeoutLimit;
            }

            generateQrUrl() {
                return `https://qr.sepay.vn/img?bank=${this.bankId}&acc=${this.accountNo}&template=${this.template}&amount=${this.amount}&des=${encodeURIComponent(this.code)}`;
            }

            start() {
                this.stop();
                this.timeLeft = this.timeoutLimit;
                this.runCountdown();
                
                // Chạy Polling lặp
                this.checkStatus();
                this.timer = setInterval(() => this.checkStatus(), this.pollingInterval);
            }

            stop() {
                if (this.timer) clearInterval(this.timer);
                if (this.countdownTimer) clearInterval(this.countdownTimer);
            }

            async checkStatus(isManual = false) {
                try {
                    // Gọi API status của module PHP
                    const checkUrl = `${window.location.origin}/wp-json/sepay-payment/v1/status?code=${encodeURIComponent(this.code)}`;
                    const response = await fetch(checkUrl, { method: 'GET', cache: 'no-store' });
                    const data = await response.json();

                    if (response.ok && data && data.paid) {
                        this.stop();
                        this.onSuccess(data);
                    } else {
                        this.onChecking(isManual ? 'Giao dịch chưa được nhận, vui lòng thử lại sau.' : 'Đang chờ chuyển tiền...');
                    }
                } catch (err) {
                    console.error("Lỗi Polling:", err);
                    this.onChecking('Lỗi kết nối đường truyền...');
                }
            }

            runCountdown() {
                this.countdownTimer = setInterval(() => {
                    this.timeLeft--;
                    if (this.timeLeft <= 0) {
                        this.stop();
                        this.onTimeout();
                    }
                }, 1000);
            }
        }

        // ==========================================
        // KHỞI TẠO VÀ SỬ DỤNG
        // ==========================================
        const scanner = new SePayPaymentScanner({
            bankId: 'MBBank',
            accountNo: 'VQRQAFUAF0842',
            amount: <?php echo esc_js($payment_amount); ?>,
            code: '<?php echo esc_js($payment_code); ?>',
            
            // Webhook ghi nhận và đối soát khớp thành công!
            onSuccess: function(data) {
                document.getElementById('statusLabel').innerText = 'Giao dịch thành công!';
                document.getElementById('statusLabel').className = 'text-[11px] font-bold text-emerald-400';
                
                // Hiển thị Popup thành công
                document.getElementById('successOverlay').classList.replace('hidden', 'flex');
            },

            // Cập nhật nhãn trạng thái thời gian thực
            onChecking: function(statusText) {
                document.getElementById('statusLabel').innerText = statusText;
            },

            // Khi hết hạn (15 phút)
            onTimeout: function() {
                document.getElementById('qrImage').style.opacity = '0.2';
                document.getElementById('statusLabel').innerText = 'Phiên giao dịch đã hết hạn.';
                document.getElementById('statusLabel').className = 'text-[11px] font-bold text-rose-500';
                alert('Mã QR đã hết hạn, vui lòng tải lại trang để thực hiện giao dịch mới.');
            }
        });

        // Tải ảnh QR động vào thẻ HTML
        document.addEventListener('DOMContentLoaded', () => {
            const qrImg = document.getElementById('qrImage');
            qrImg.src = scanner.generateQrUrl();
            qrImg.onload = () => {
                document.getElementById('qrLoading').style.display = 'none';
                qrImg.style.display = 'block';
            };

            // Chạy tiến trình đếm ngược & polling kiểm tra
            scanner.start();
            startCountdownTimer(900);
        });

        // Bắt nút Kiểm tra ngay thủ công
        document.getElementById('btnScanNow').addEventListener('click', () => {
            scanner.checkStatus(true);
        });

        // Tiện ích phụ trợ giao diện
        function copyData(elementId, label) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                showToast(`Đã sao chép ${label}!`);
            });
        }

        function showToast(msg) {
            let toast = document.getElementById('toastBox');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'toastBox';
                toast.className = 'fixed bottom-4 right-4 bg-emerald-500 text-white font-bold px-5 py-3 rounded-xl shadow-xl z-[999] transition-all duration-300 transform translate-y-20 opacity-0';
                document.body.appendChild(toast);
            }
            toast.innerText = msg;
            toast.classList.replace('translate-y-20', 'translate-y-0');
            toast.classList.replace('opacity-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.replace('translate-y-0', 'translate-y-20');
                toast.classList.replace('opacity-100', 'opacity-0');
            }, 2500);
        }

        function startCountdownTimer(dur) {
            let t = dur, m, s;
            const display = document.getElementById('timerText');
            const countdown = setInterval(() => {
                m = parseInt(t / 60, 10);
                s = parseInt(t % 60, 10);
                m = m < 10 ? "0" + m : m;
                s = s < 10 ? "0" + s : s;
                display.textContent = m + ":" + s;
                if (--t < 0) clearInterval(countdown);
            }, 1000);
        }
    </script>
</body>
</html>
<?php
get_footer();
