<?php
/**
 * Template Name: Giao diện Thanh toán QR Code (SePay)
 * Template Post Type: page
 * @package Hieucon
 */

if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

get_header();

// Lấy thông tin tài khoản nhận từ cấu hình Admin
$configured_bank    = get_option('sepay_bank_id', 'MBBank');
$configured_acc     = get_option('sepay_account_number', 'VQRQAFUAF0842');
$configured_name    = get_option('sepay_account_name', 'NGUYEN KHANH TOAN');
$configured_tmpl    = get_option('sepay_qr_template', 'qronly');

// Lấy thông tin đơn thanh toán từ URL Query
$course_id     = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$total_amount  = isset($_GET['total']) ? floatval($_GET['total']) : 0;
$temp_order_id = isset($_GET['order_id']) ? sanitize_text_field($_GET['order_id']) : 'TEMP' . time();

// Lấy thông tin khóa học
$course_title  = $course_id ? get_the_title($course_id) : 'Đăng ký tài liệu / Khóa học hội viên';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Học Phí Chuyển Khoản QR Code - Hieucon</title>
    <!-- CSS Tailwind cho giao diện cao cấp -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .copy-btn:active { transform: scale(0.95); }
        .scan-line {
            width: 100%; height: 3px; background: #10b981;
            position: absolute; z-index: 10;
            animation: scan 3s infinite linear;
            box-shadow: 0 0 8px #10b981;
        }
        @keyframes scan {
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
            
            <!-- CỘT TRÁI: HIỂN THỊ DÀNH CHO QUÉT MÃ QR (5 cột) -->
            <div class="md:col-span-5 bg-slate-900 p-8 flex flex-col items-center justify-center relative text-white">
                <div class="absolute top-4 left-4 flex items-center gap-1.5 text-xs text-slate-400 bg-slate-800/50 px-2.5 py-1 rounded-full border border-slate-700">
                    <i class="fas fa-lock text-emerald-500"></i> Thanh toán bảo mật
                </div>

                <div class="text-center mb-6 mt-4">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Số tiền học phí</p>
                    <h2 class="text-3xl font-black text-emerald-400 font-mono"><?php echo number_format($total_amount, 0, ',', '.'); ?>đ</h2>
                    <p class="text-slate-450 text-[11px] mt-1 line-clamp-1 opacity-80"><?php echo esc_html($course_title); ?></p>
                </div>

                <!-- Ô quét QR -->
                <div class="relative w-60 h-60 bg-white p-2.5 rounded-2xl shadow-xl border border-slate-850 overflow-hidden flex items-center justify-center">
                    <div id="qrLoading" class="absolute inset-0 bg-slate-900 flex flex-col items-center justify-center gap-2 z-20">
                        <i class="fas fa-circle-notch fa-spin text-3xl text-emerald-400"></i>
                        <p class="text-[10px] text-slate-400 font-medium">Đang khởi tạo VietQR...</p>
                    </div>
                    
                    <img id="qrImage" src="" class="w-full h-full object-contain rounded-xl z-10" alt="VietQR SePay" style="display: none;">
                    
                    <!-- Hiệu ứng quét sáng laze xanh lá -->
                    <div class="absolute inset-0 pointer-events-none rounded-xl overflow-hidden">
                        <div class="scan-line"></div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-xs text-slate-400 flex items-center justify-center gap-1.5">
                        Mã QR hết hạn sau: 
                        <span id="countdownTimer" class="font-bold text-emerald-400 font-mono bg-slate-800 px-2 py-0.5 rounded border border-slate-700">15:00</span>
                    </p>
                </div>
            </div>

            <!-- CỘT PHẢI: HIỂN THỊ CHI TIẾT CHUYỂN KHOẢN (7 cột) -->
            <div class="md:col-span-7 p-8 md:p-10 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2 pb-4 border-b border-slate-100">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500"><i class="fas fa-university"></i></span>
                        Thông Tin Chuyển Khoản Thủ Công
                    </h3>

                    <!-- Cấu hình tài khoản nhận tiền -->
                    <div class="space-y-4">
                        <!-- Số tài khoản -->
                        <div onclick="copyText('acc-number', 'Số tài khoản')" class="bg-slate-50 border border-slate-200/65 rounded-xl p-4 cursor-pointer hover:border-slate-350 transition relative group">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Số Tài Khoản Nhận</span>
                            <div class="flex justify-between items-center">
                                <span id="acc-number" class="text-xl font-mono font-extrabold text-slate-900 tracking-wider"><?php echo esc_html($configured_acc); ?></span>
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
                                    <span class="font-bold text-slate-900 text-sm"><?php echo esc_html($configured_bank); ?></span>
                                </div>
                            </div>
                            <!-- Tên chủ tài khoản -->
                            <div class="bg-slate-50 border border-slate-200/60 rounded-xl p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase block mb-1">Chủ Tài Khoản</span>
                                <span class="font-bold text-slate-900 text-sm uppercase"><?php echo esc_html($configured_name); ?></span>
                            </div>
                        </div>

                        <!-- Nội dung chuyển khoản (BẮT BUỘC CHÍNH XÁC) -->
                        <div onclick="copyText('transfer-content', 'Nội dung chuyển khoản')" class="bg-amber-50 border border-amber-200 rounded-xl p-4 cursor-pointer hover:border-amber-400 transition relative group">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-exclamation-triangle"></i> Nội Dung Chuyển Khoản (Bắt buộc)
                                </span>
                                <span class="text-[9px] bg-amber-500 text-white px-1.5 py-0.5 rounded font-extrabold shrink-0">BẮT BUỘC</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span id="transfer-content" class="text-lg font-mono font-bold text-slate-900">DH<?php echo esc_html($temp_order_id); ?></span>
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
                            <span class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-emerald-400 animate-pulse">
                                <i class="fas fa-circle-notch fa-spin text-sm"></i>
                            </span>
                            <div>
                                <p class="text-xs font-bold">Trạng thái thanh toán</p>
                                <p id="status-text" class="text-[11px] text-slate-400">Đang kiểm tra giao dịch tự động...</p>
                            </div>
                        </div>
                        <button id="btnCheckNow" class="text-xs px-3 py-1.5 bg-emerald-500 text-slate-900 font-bold rounded-lg hover:bg-emerald-400 transition">Kiểm tra ngay</button>
                    </div>

                    <p class="text-[11px] text-slate-400 text-center leading-relaxed">
                        Hệ thống đối soát SePay sẽ tự động ghi nhận giao dịch của bạn trong vòng 1-3 phút. Nếu có bất kỳ sự cố chậm trễ nào, vui lòng liên hệ hotline hỗ trợ.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ĐỐI SOÁT & KÍCH HOẠT THÀNH CÔNG -->
    <div id="loadingModal" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl">
            <div class="w-20 h-20 border-4 border-emerald-100 border-t-emerald-500 rounded-full animate-spin mx-auto mb-5 flex items-center justify-center">
                <i class="fas fa-check-double text-2xl text-emerald-400 animate-pulse"></i>
            </div>
            <h4 class="text-lg font-bold text-slate-800 mb-1">Giao Dịch Đã Ghi Nhận!</h4>
            <p class="text-xs text-slate-500">Đang đối soát an toàn và tự động kích hoạt tài khoản hội viên...</p>
        </div>
    </div>

    <!-- MODAL THÀNH CÔNG -->
    <div id="successModal" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl border-4 border-emerald-100">
            <div class="w-16 h-16 bg-emerald-50 border border-emerald-100 text-emerald-500 text-3xl rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4 class="text-xl font-black text-slate-900 mb-2">Đăng Ký Thành Công!</h4>
            <p class="text-xs text-slate-500 mb-6">Bạn đã kích hoạt thành công khóa học: <strong><?php echo esc_html($course_title); ?></strong>. Chào mừng bạn tham gia hành trình học tập.</p>
            <button id="btnStartLearning" class="w-full py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">Vào Học Ngay</button>
        </div>
    </div>

    <!-- JAVASCRIPT HẬU TRƯỜNG: POLLING & AJAX KÍCH HOẠT -->
    <script>
        const PAYMENT_CONFIG = {
            BANK_ID: '<?php echo esc_js($configured_bank); ?>',
            ACC_NO: '<?php echo esc_js($configured_acc); ?>',
            TEMPLATE: '<?php echo esc_js($configured_tmpl); ?>'
        };

        const orderInfo = {
            courseId: <?php echo esc_js($course_id); ?>,
            amount: <?php echo esc_js($total_amount); ?>,
            code: 'DH<?php echo esc_js($temp_order_id); ?>',
            ajaxUrl: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
            nonce: '<?php echo esc_js(wp_create_nonce('hieucon_payment_nonce')); ?>'
        };

        let pollingTimer = null;

        document.addEventListener('DOMContentLoaded', () => {
            // A. Khởi tạo và tải mã QR động từ SePay VietQR Image API
            const qrUrl = `https://qr.sepay.vn/img?bank=${PAYMENT_CONFIG.BANK_ID}&acc=${PAYMENT_CONFIG.ACC_NO}&template=${PAYMENT_CONFIG.TEMPLATE}&amount=${orderInfo.amount}&des=${encodeURIComponent(orderInfo.code)}`;
            
            const qrImgElement = document.getElementById('qrImage');
            qrImgElement.src = qrUrl;
            qrImgElement.onload = () => {
                document.getElementById('qrLoading').style.display = 'none';
                qrImgElement.style.display = 'block';
            };

            // B. Khởi chạy luồng đếm ngược và kiểm tra tự động Polling
            startTimer(900); // 15 phút đếm ngược
            startPaymentPolling();
        });

        // HÀM POLLING: Gọi API kiểm tra thanh toán mỗi 5 giây
        function startPaymentPolling() {
            checkStatusOnServer();
            pollingTimer = setInterval(checkStatusOnServer, 5000);
        }

        async function checkStatusOnServer(isManual = false) {
            try {
                const checkUrl = `${window.location.origin}/wp-json/hieucon/v1/payment-status?code=${encodeURIComponent(orderInfo.code)}`;
                const res = await fetch(checkUrl, { method: 'GET', cache: 'no-store' });
                const data = await res.json();

                if (res.ok && data && data.paid) {
                    clearInterval(pollingTimer);
                    updateStatusUI('Thanh toán thành công! Đang kích hoạt...', 'text-emerald-400');
                    
                    // Kích hoạt AJAX tạo đơn hàng và add khóa học cho học viên
                    await processActivation();
                } else {
                    if (isManual) {
                        showToast('Hệ thống chưa ghi nhận được khoản chuyển tiền. Vui lòng kiểm tra lại sau ít phút.');
                    }
                    updateStatusUI('Chờ giao dịch chuyển khoản...', 'text-amber-405');
                }
            } catch (err) {
                console.error("Lỗi khi kiểm tra thanh toán:", err);
                updateStatusUI('Lỗi kết nối kiểm tra...', 'text-rose-400');
            }
        }

        // HÀM AJAX GỬI LÊN WP BACKEND ĐỂ GHI NHẬN ĐƠN VÀ KÍCH HOẠT HỌC VIÊN
        async function processActivation() {
            document.getElementById('loadingModal').classList.replace('hidden', 'flex');

            try {
                const formData = new URLSearchParams();
                formData.append('action', 'hieucon_create_paid_order');
                formData.append('nonce', orderInfo.nonce);
                formData.append('course_id', orderInfo.courseId);
                formData.append('amount', orderInfo.amount);
                formData.append('code', orderInfo.code);

                const response = await fetch(orderInfo.ajaxUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: formData
                });

                const result = await response.json();
                document.getElementById('loadingModal').classList.replace('flex', 'hidden');

                if (result.success) {
                    // Hiển thị modal thành công
                    document.getElementById('successModal').classList.replace('hidden', 'flex');
                    document.getElementById('btnStartLearning').onclick = () => {
                        window.location.href = result.data.course_url;
                    };
                } else {
                    alert('Lỗi kích hoạt: ' + (result.data.message || 'Không rõ nguyên nhân'));
                    startPaymentPolling();
                }
            } catch (err) {
                document.getElementById('loadingModal').classList.replace('flex', 'hidden');
                alert('Đã có lỗi đường truyền kết nối xảy ra khi thực hiện kích hoạt khóa học.');
                startPaymentPolling();
            }
        }

        // CÁC HÀM TIỆN ÍCH DÀNH CHO GIAO DIỆN HÌNH THỂ VÀ TRẢI NGHIỆM
        function updateStatusUI(text, colorClass) {
            const el = document.getElementById('status-text');
            el.className = `text-[11px] font-bold ${colorClass}`;
            el.innerText = text;
        }

        function copyText(elementId, label) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                showToast(`Đã sao chép ${label}: ${text}`);
            });
        }

        function showToast(msg) {
            let toast = document.getElementById('sepay-toast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'sepay-toast';
                toast.className = 'fixed bottom-4 right-4 bg-emerald-500 text-white font-bold px-5 py-3 rounded-xl shadow-xl z-[999] transition-all duration-300 transform translate-y-20 opacity-0';
                document.body.appendChild(toast);
            }
            toast.innerText = msg;
            toast.classList.replace('translate-y-20', 'translate-y-0');
            toast.classList.replace('opacity-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.replace('translate-y-0', 'translate-y-20');
                toast.classList.replace('opacity-100', 'opacity-0');
            }, 3000);
        }

        function startTimer(duration) {
            let timer = duration, minutes, seconds;
            const display = document.getElementById('countdownTimer');
            const interval = setInterval(() => {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    clearInterval(pollingTimer);
                    display.textContent = "Hết hạn";
                    updateStatusUI('Mã QR đã hết hạn hiệu lực.', 'text-rose-500');
                }
            }, 1000);
        }

        // Bắt nút Kiểm tra ngay thủ công
        document.getElementById('btnCheckNow').addEventListener('click', () => {
            checkStatusOnServer(true);
        });
    </script>
</body>
</html>
<?php
get_footer();
