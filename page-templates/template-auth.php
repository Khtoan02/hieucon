<?php
/**
 * Template Name: Đăng ký & Đăng nhập Hội viên
 *
 * @package Hieucon
 */

use Hieucon\Model\Member_Model;

// Xác định địa chỉ chuyển hướng an toàn sau khi đăng ký / đăng nhập
$redirect_to = home_url( '/tai-khoan/' );
if ( ! empty( $_GET['redirect_to'] ) ) {
    $safe_redirect = wp_validate_redirect( $_GET['redirect_to'], home_url( '/tai-khoan/' ) );
    if ( $safe_redirect ) {
        $redirect_to = $safe_redirect;
    }
}

// Nếu đã đăng nhập thì tự động chuyển hướng về trang mong muốn
$current_member = Member_Model::get_current_member();
if ( $current_member ) {
    wp_redirect( $redirect_to );
    exit;
}

get_header();

// Lấy thông tin Turnstile Site Key (TẠM THỜI TẮT CAPTCHA THEO YÊU CẦU USER)
$turnstile_sitekey = ''; // get_option( 'hieucon_turnstile_sitekey', '' );
$auth_nonce        = wp_create_nonce( 'hieucon_auth_nonce' );
?>

<!-- Nạp thư viện Cloudflare Turnstile Script -->
<?php if ( ! empty( $turnstile_sitekey ) ) : ?>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
<?php endif; ?>

<main id="primary" class="site-main min-h-screen py-16 md:py-24 flex items-center justify-center relative overflow-hidden bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/30">
    
    <!-- Trang trí nền phông tròn hiệu ứng Blur -->
    <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-secondary/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-[500px] mx-auto px-4 z-10">
        
        <!-- Logo / Brand Header -->
        <div class="text-center mb-8">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block group">
                <img src="<?php echo esc_url( get_site_icon_url( 128 ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-16 h-16 mx-auto rounded-2xl shadow-md border border-white bg-white group-hover:scale-105 transition-transform duration-300">
            </a>
            <h1 class="font-serif text-2xl md:text-3xl text-navy mt-4 font-bold tracking-tight">Hệ thống Hội viên Hieucon</h1>
            <p class="text-navy/60 text-sm mt-1 font-medium">Kết nối chuyên gia, trợ lý và cộng đồng chăm sóc con</p>
        </div>

        <!-- Thẻ Auth Card chính -->
        <div class="bg-white/70 backdrop-blur-xl border border-white/60 shadow-elegant rounded-[2.5rem] p-6 md:p-8 relative">
            
            <!-- Hộp thoại thông báo nổi (Toast Message) -->
            <div id="auth-alert" class="hidden mb-6 p-4 rounded-2xl text-xs md:text-sm font-semibold transition-all duration-300 transform scale-95 opacity-0"></div>

            <!-- Tabs đăng nhập / đăng ký -->
            <div class="flex p-1.5 bg-slate-100/80 rounded-2xl mb-8 border border-slate-200/50">
                <button type="button" onclick="switchTab('login')" id="tab-login-btn" class="w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy bg-white shadow-sm">
                    Đăng Nhập
                </button>
                <button type="button" onclick="switchTab('register')" id="tab-register-btn" class="w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy/60 hover:text-navy">
                    Đăng Ký
                </button>
            </div>

            <!-- ================= VIEW 1: ĐĂNG NHẬP ================= -->
            <div id="login-view" class="transition-opacity duration-300">
                <!-- Chọn phương thức đăng nhập -->
                <div class="flex gap-4 mb-6 border-b border-slate-100 pb-3">
                    <button type="button" onclick="switchLoginMethod('password')" id="btn-login-method-password" class="text-xs font-bold text-secondary border-b-2 border-secondary pb-1">
                        Dùng Mật khẩu
                    </button>
                    <button type="button" onclick="switchLoginMethod('otp')" id="btn-login-method-otp" class="text-xs font-bold text-navy/40 hover:text-navy pb-1">
                        Dùng OTP Email
                    </button>
                </div>

                <!-- A. Form Đăng nhập bằng Mật khẩu -->
                <form id="form-login-password" onsubmit="handleLoginPassword(event)" class="space-y-5">
                    <input type="hidden" name="action" value="hieucon_login_via_password">
                    <input type="hidden" name="nonce" value="<?php echo esc_attr( $auth_nonce ); ?>">

                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Địa chỉ Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="yourname@gmail.com">
                    </div>

                    <div class="space-y-1">
                        <div class="flex justify-between items-center px-1">
                            <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest">Mật khẩu</label>
                        </div>
                        <input type="password" name="password" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="••••••••">
                    </div>

                    <div class="flex items-center justify-between px-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" value="true" class="rounded text-primary border-slate-200 focus:ring-primary/20">
                            <span class="text-xs font-semibold text-navy/60">Ghi nhớ đăng nhập</span>
                        </label>
                    </div>

                    <!-- Captcha Widget -->
                    <?php if ( ! empty( $turnstile_sitekey ) ) : ?>
                        <div class="cf-turnstile flex justify-center" data-sitekey="<?php echo esc_attr( $turnstile_sitekey ); ?>" data-theme="light"></div>
                    <?php endif; ?>

                    <button type="submit" class="w-full py-4 bg-navy hover:bg-navy/90 text-white rounded-2xl font-bold text-sm shadow-md hover:shadow-lg transition-all duration-300 transform active:scale-98 flex items-center justify-center gap-2">
                        Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>
                    </button>
                </form>

                <!-- B. Form Đăng nhập nhanh bằng OTP Email -->
                <form id="form-login-otp" onsubmit="handleLoginOTP(event)" class="space-y-5 hidden">
                    <input type="hidden" name="action" value="hieucon_login_via_otp">
                    <input type="hidden" name="nonce" value="<?php echo esc_attr( $auth_nonce ); ?>">

                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Địa chỉ Email</label>
                        <div class="relative flex gap-2">
                            <input type="email" id="login-otp-email" name="email" required class="flex-grow px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="yourname@gmail.com">
                            <button type="button" id="btn-request-login-otp" onclick="requestLoginOTP()" class="px-4 bg-secondary hover:bg-secondary/90 text-white rounded-xl font-bold text-xs transition-colors shrink-0 flex items-center justify-center">
                                Gửi mã OTP
                            </button>
                        </div>
                    </div>

                    <!-- Trường nhập OTP ẩn, sẽ hiện khi gửi OTP thành công -->
                    <div id="login-otp-field" class="space-y-1 hidden">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Mã xác thực OTP (6 số)</label>
                        <input type="text" name="otp" maxlength="6" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 text-center tracking-[1em] text-lg font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="000000">
                    </div>

                    <div class="flex items-center gap-2 px-1">
                        <input type="checkbox" name="remember" value="true" class="rounded text-primary border-slate-200 focus:ring-primary/20">
                        <span class="text-xs font-semibold text-navy/60">Ghi nhớ đăng nhập</span>
                    </div>

                    <?php if ( ! empty( $turnstile_sitekey ) ) : ?>
                        <div class="cf-turnstile flex justify-center" data-sitekey="<?php echo esc_attr( $turnstile_sitekey ); ?>" data-theme="light"></div>
                    <?php endif; ?>

                    <button type="submit" id="btn-submit-login-otp" disabled class="w-full py-4 bg-slate-300 text-white cursor-not-allowed rounded-2xl font-bold text-sm shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

            <!-- ================= VIEW 2: ĐĂNG KÝ ================= -->
            <div id="register-view" class="hidden transition-opacity duration-300">
                <form id="form-register" onsubmit="handleRegister(event)" class="space-y-4">
                    <input type="hidden" name="action" value="hieucon_register_member">
                    <input type="hidden" name="nonce" value="<?php echo esc_attr( $auth_nonce ); ?>">

                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Họ và tên</label>
                        <input type="text" name="full_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="Nguyễn Văn A">
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Địa chỉ Email</label>
                        <div class="relative flex gap-2">
                            <input type="email" id="register-email" name="email" required class="flex-grow px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="yourname@gmail.com">
                            <button type="button" id="btn-request-register-otp" onclick="requestRegisterOTP()" class="px-4 bg-secondary hover:bg-secondary/90 text-white rounded-xl font-bold text-xs transition-colors shrink-0 flex items-center justify-center">
                                Gửi mã OTP
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Mật khẩu</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" placeholder="Tối thiểu 8 ký tự">
                    </div>

                    <!-- Trường nhập OTP ẩn, sẽ hiện khi gửi OTP thành công -->
                    <div id="register-otp-field" class="space-y-1 hidden">
                        <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Mã OTP xác thực Email (6 số)</label>
                        <input type="text" name="otp" maxlength="6" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 text-center tracking-[1em] text-lg font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="000000">
                    </div>

                    <?php if ( ! empty( $turnstile_sitekey ) ) : ?>
                        <div class="cf-turnstile flex justify-center" data-sitekey="<?php echo esc_attr( $turnstile_sitekey ); ?>" data-theme="light"></div>
                    <?php endif; ?>

                    <button type="submit" id="btn-submit-register" disabled class="w-full py-4 bg-slate-300 text-white cursor-not-allowed rounded-2xl font-bold text-sm shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        Đăng Ký Tài Khoản <i data-lucide="user-plus" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>

<script>
    const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

    // --- CHUYỂN TABS CHÍNH (ĐĂNG NHẬP / ĐĂNG KÝ) ---
    function switchTab(tab) {
        const loginView = document.getElementById('login-view');
        const registerView = document.getElementById('register-view');
        const loginBtn = document.getElementById('tab-login-btn');
        const registerBtn = document.getElementById('tab-register-btn');
        
        hideAlert();

        if (tab === 'login') {
            loginView.classList.remove('hidden');
            registerView.classList.add('hidden');
            loginBtn.className = "w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy bg-white shadow-sm";
            registerBtn.className = "w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy/60 hover:text-navy";
        } else {
            loginView.classList.add('hidden');
            registerView.classList.remove('hidden');
            loginBtn.className = "w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy/60 hover:text-navy";
            registerBtn.className = "w-1/2 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-navy bg-white shadow-sm";
        }
        
        // Reset Captcha Turnstile nếu có
        if (window.turnstile) {
            window.turnstile.reset();
        }
    }

    // --- CHUYỂN PHƯƠNG THỨC ĐĂNG NHẬP ---
    function switchLoginMethod(method) {
        const formPassword = document.getElementById('form-login-password');
        const formOtp = document.getElementById('form-login-otp');
        const btnPassword = document.getElementById('btn-login-method-password');
        const btnOtp = document.getElementById('btn-login-method-otp');

        hideAlert();

        if (method === 'password') {
            formPassword.classList.remove('hidden');
            formOtp.classList.add('hidden');
            btnPassword.className = "text-xs font-bold text-secondary border-b-2 border-secondary pb-1";
            btnOtp.className = "text-xs font-bold text-navy/40 hover:text-navy pb-1";
        } else {
            formPassword.classList.add('hidden');
            formOtp.classList.remove('hidden');
            btnPassword.className = "text-xs font-bold text-navy/40 hover:text-navy pb-1";
            btnOtp.className = "text-xs font-bold text-secondary border-b-2 border-secondary pb-1";
        }

        if (window.turnstile) {
            window.turnstile.reset();
        }
    }

    // --- GIAO DIỆN HIỂN THỊ ALERT THÔNG BÁO ---
    function showAlert(message, type = 'error') {
        const alert = document.getElementById('auth-alert');
        alert.innerHTML = message;
        alert.classList.remove('hidden', 'bg-red-50', 'text-red-600', 'border-red-200', 'bg-green-50', 'text-green-600', 'border-green-200');

        if (type === 'error') {
            alert.classList.add('bg-red-50', 'text-red-600', 'border', 'border-red-200');
        } else {
            alert.classList.add('bg-green-50', 'text-green-600', 'border', 'border-green-200');
        }

        // Tạo hiệu ứng fade-in
        alert.classList.remove('scale-95', 'opacity-0');
        alert.classList.add('scale-100', 'opacity-100');
    }

    function hideAlert() {
        const alert = document.getElementById('auth-alert');
        alert.classList.add('scale-95', 'opacity-0');
        alert.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => alert.classList.add('hidden'), 300);
    }

    // --- LẤY TOKEN TURNSTILE AN TOÀN ---
    function getTurnstileToken(form) {
        if (!window.turnstile) return '';
        const widgetId = window.turnstile.widgetId;
        // Trích xuất token từ thẻ input được chèn tự động của Turnstile
        const response = form.querySelector('[name="cf-turnstile-response"]');
        return response ? response.value : '';
    }

    // --- GỬI YÊU CẦU OTP ĐĂNG KÝ ---
    async function requestRegisterOTP() {
        const emailInput = document.getElementById('register-email');
        const email = emailInput.value.trim();
        const form = document.getElementById('form-register');
        const btn = document.getElementById('btn-request-register-otp');

        if (!email || !email.includes('@')) {
            showAlert('Vui lòng nhập địa chỉ Email hợp lệ trước khi gửi mã OTP.');
            return;
        }

        const captchaToken = getTurnstileToken(form);
        
        btn.disabled = true;
        btn.innerText = 'Đang gửi...';
        hideAlert();

        const formData = new FormData();
        formData.append('action', 'hieucon_send_otp_register');
        formData.append('email', email);
        formData.append('captcha_token', captchaToken);
        formData.append('nonce', '<?php echo esc_attr( $auth_nonce ); ?>');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                showAlert(data.data.message, 'success');
                // Hiển thị trường OTP và kích hoạt nút submit
                document.getElementById('register-otp-field').classList.remove('hidden');
                
                const submitBtn = document.getElementById('btn-submit-register');
                submitBtn.disabled = false;
                submitBtn.className = "w-full py-4 bg-navy hover:bg-navy/90 text-white rounded-2xl font-bold text-sm shadow-md hover:shadow-lg transition-all duration-300 transform active:scale-98 flex items-center justify-center gap-2";

                // Bắt đầu đếm ngược 60 giây gửi lại OTP
                let count = 60;
                btn.innerText = `Gửi lại (${count}s)`;
                const timer = setInterval(() => {
                    count--;
                    if (count <= 0) {
                        clearInterval(timer);
                        btn.disabled = false;
                        btn.innerText = 'Gửi mã OTP';
                        if (window.turnstile) window.turnstile.reset();
                    } else {
                        btn.innerText = `Gửi lại (${count}s)`;
                    }
                }, 1000);

            } else {
                showAlert(data.data.message);
                btn.disabled = false;
                btn.innerText = 'Gửi mã OTP';
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAlert('Lỗi hệ thống khi gửi OTP. Vui lòng tải lại trang.');
            btn.disabled = false;
            btn.innerText = 'Gửi mã OTP';
        }
    }

    // --- GỬI YÊU CẦU OTP ĐĂNG NHẬP ---
    async function requestLoginOTP() {
        const emailInput = document.getElementById('login-otp-email');
        const email = emailInput.value.trim();
        const form = document.getElementById('form-login-otp');
        const btn = document.getElementById('btn-request-login-otp');

        if (!email || !email.includes('@')) {
            showAlert('Vui lòng điền Email đăng nhập.');
            return;
        }

        const captchaToken = getTurnstileToken(form);
        
        btn.disabled = true;
        btn.innerText = 'Đang gửi...';
        hideAlert();

        const formData = new FormData();
        formData.append('action', 'hieucon_send_otp_login');
        formData.append('email', email);
        formData.append('captcha_token', captchaToken);
        formData.append('nonce', '<?php echo esc_attr( $auth_nonce ); ?>');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                showAlert(data.data.message, 'success');
                document.getElementById('login-otp-field').classList.remove('hidden');
                
                const submitBtn = document.getElementById('btn-submit-login-otp');
                submitBtn.disabled = false;
                submitBtn.className = "w-full py-4 bg-navy hover:bg-navy/90 text-white rounded-2xl font-bold text-sm shadow-md hover:shadow-lg transition-all duration-300 transform active:scale-98 flex items-center justify-center gap-2";

                let count = 60;
                btn.innerText = `Gửi lại (${count}s)`;
                const timer = setInterval(() => {
                    count--;
                    if (count <= 0) {
                        clearInterval(timer);
                        btn.disabled = false;
                        btn.innerText = 'Gửi mã OTP';
                        if (window.turnstile) window.turnstile.reset();
                    } else {
                        btn.innerText = `Gửi lại (${count}s)`;
                    }
                }, 1000);

            } else {
                showAlert(data.data.message);
                btn.disabled = false;
                btn.innerText = 'Gửi mã OTP';
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAlert('Lỗi kết nối. Vui lòng tải lại trang.');
            btn.disabled = false;
            btn.innerText = 'Gửi mã OTP';
        }
    }

    // --- XỬ LÝ ĐĂNG KÝ HỘI VIÊN ---
    async function handleRegister(event) {
        event.preventDefault();
        const form = document.getElementById('form-register');
        const submitBtn = document.getElementById('btn-submit-register');
        
        hideAlert();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Đang đăng ký... <i data-lucide="loader" class="w-4 h-4 animate-spin"></i>';
        lucide.createIcons(); // reload icons

        const formData = new FormData(form);
        const captchaToken = getTurnstileToken(form);
        formData.append('captcha_token', captchaToken);

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                showAlert('Đăng ký tài khoản thành công! Đang chuyển hướng về trang tài khoản...', 'success');
                setTimeout(() => window.location.href = '<?php echo esc_url( $redirect_to ); ?>', 1500);
            } else {
                showAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Đăng Ký Tài Khoản <i data-lucide="user-plus" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAlert('Lỗi xử lý. Thử lại sau.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Đăng Ký Tài Khoản <i data-lucide="user-plus" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- XỬ LÝ ĐĂNG NHẬP BẰNG MẬT KHẨU ---
    async function handleLoginPassword(event) {
        event.preventDefault();
        const form = document.getElementById('form-login-password');
        const submitBtn = form.querySelector('button[type="submit"]');

        hideAlert();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Đang xử lý... <i data-lucide="loader" class="w-4 h-4 animate-spin"></i>';
        lucide.createIcons();

        const formData = new FormData(form);
        const captchaToken = getTurnstileToken(form);
        formData.append('captcha_token', captchaToken);

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                showAlert('Đăng nhập thành công! Đang vào tài khoản...', 'success');
                setTimeout(() => window.location.href = '<?php echo esc_url( $redirect_to ); ?>', 1200);
            } else {
                showAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAlert('Lỗi kết nối máy chủ.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- XỬ LÝ ĐĂNG NHẬP BẰNG OTP ---
    async function handleLoginOTP(event) {
        event.preventDefault();
        const form = document.getElementById('form-login-otp');
        const submitBtn = document.getElementById('btn-submit-login-otp');

        hideAlert();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Đang xác minh... <i data-lucide="loader" class="w-4 h-4 animate-spin"></i>';
        lucide.createIcons();

        const formData = new FormData(form);
        const captchaToken = getTurnstileToken(form);
        formData.append('captcha_token', captchaToken);

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                showAlert('Xác minh thành công! Đang tải tài khoản...', 'success');
                setTimeout(() => window.location.href = '<?php echo esc_url( $redirect_to ); ?>', 1200);
            } else {
                showAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAlert('Lỗi xác thực mã OTP.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Đăng Nhập <i data-lucide="log-in" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }
</script>

<?php
get_footer();
