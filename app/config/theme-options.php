<?php
/**
 * Theme Options - Popup Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Thêm menu cài đặt vào admin
function hieucon_add_theme_options_page() {
    add_theme_page(
        'Cài đặt Popup',          // Page title
        'Cài đặt Popup',          // Menu title
        'manage_options',         // Capability
        'hieucon-popup-settings', // Menu slug
        'hieucon_theme_options_page_html' // Callback function
    );
}
add_action( 'admin_menu', 'hieucon_add_theme_options_page' );

// Đăng ký các setting
function hieucon_register_settings() {
    register_setting( 'hieucon_popup_options', 'hieucon_popup_enable' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_title' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_desc' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_btn_text' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_btn_link' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_delay' );
    register_setting( 'hieucon_popup_options', 'hieucon_popup_custom_code' );
}
add_action( 'admin_init', 'hieucon_register_settings' );

// Giao diện trang cài đặt
function hieucon_theme_options_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Giá trị mặc định
    $enable   = get_option( 'hieucon_popup_enable', '1' ) ? 'checked' : '';
    $title    = get_option( 'hieucon_popup_title', 'Chào mừng ba mẹ!' );
    $desc     = get_option( 'hieucon_popup_desc', 'Mời ba mẹ tham gia Group <strong>Hiểu con từ gốc</strong> để nhận thêm nhiều chia sẻ hữu ích.' );
    $btn_text = get_option( 'hieucon_popup_btn_text', 'Tham gia ngay' );
    $btn_link = get_option( 'hieucon_popup_btn_link', '#' );
    $delay    = get_option( 'hieucon_popup_delay', '5' );
    $custom   = get_option( 'hieucon_popup_custom_code', '' );
    ?>
    <div class="wrap">
        <h1>Cài đặt Popup "Hiểu con từ gốc"</h1>
        <form action="options.php" method="post">
            <?php
            // Security field
            settings_fields( 'hieucon_popup_options' );
            do_settings_sections( 'hieucon_popup_options' );
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Bật Popup?</th>
                    <td>
                        <input type="checkbox" name="hieucon_popup_enable" value="1" <?php echo $enable; ?> />
                        <p class="description">Check để bật hiển thị popup trên website.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tiêu đề Popup</th>
                    <td>
                        <input type="text" name="hieucon_popup_title" value="<?php echo esc_attr( $title ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Nội dung Popup (hỗ trợ HTML)</th>
                    <td>
                        <textarea name="hieucon_popup_desc" rows="5" cols="50" class="large-text code"><?php echo esc_textarea( $desc ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chữ trên Nút</th>
                    <td>
                        <input type="text" name="hieucon_popup_btn_text" value="<?php echo esc_attr( $btn_text ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Link của Nút</th>
                    <td>
                        <input type="url" name="hieucon_popup_btn_link" value="<?php echo esc_attr( $btn_link ); ?>" class="regular-text" />
                        <p class="description">Ví dụ: https://zalo.me/g/xxxxxx hoặc link Facebook Group</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Thời gian hiển thị (giây)</th>
                    <td>
                        <input type="number" name="hieucon_popup_delay" value="<?php echo esc_attr( $delay ); ?>" class="small-text" min="0" />
                        <p class="description">Số giây chờ trước khi Popup hiện lên lần đầu tiên (Mặc định: 5 giây).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="color: #d63638;">Custom Code (Toàn quyền)</th>
                    <td>
                        <textarea name="hieucon_popup_custom_code" rows="8" cols="50" class="large-text code"><?php echo esc_textarea( $custom ); ?></textarea>
                        <p class="description">Nếu bạn điền mã HTML/JS/CSS vào đây, hệ thống sẽ sử dụng <strong>toàn bộ mã này</strong> để làm Popup và sẽ bỏ qua tất cả cấu hình mặc định (Tiêu đề, Mô tả, Nút, Thời gian hiển thị...) phía trên.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button( 'Lưu thay đổi' ); ?>
        </form>
    </div>
    <?php
}

// Hàm hiển thị Popup ở frontend
function hieucon_render_popup() {
    // Kiểm tra xem Popup có được bật trong cài đặt không
    $hieucon_popup_enable = get_option('hieucon_popup_enable', '1');

    if ( $hieucon_popup_enable ) :
        $custom_code = get_option('hieucon_popup_custom_code', '');

        // Nếu có custom code thì sẽ in ra luôn custom code
        if ( ! empty( trim( $custom_code ) ) ) {
            echo $custom_code;
        } else {
            // Nếu không có custom code, dùng cấu hình mặc định
            $popup_title    = get_option('hieucon_popup_title', 'Chào mừng ba mẹ!');
            $popup_desc     = get_option('hieucon_popup_desc', 'Mời ba mẹ tham gia Group <strong>Hiểu con từ gốc</strong> để nhận thêm nhiều chia sẻ hữu ích.');
            $popup_btn_text = get_option('hieucon_popup_btn_text', 'Tham gia ngay');
            $popup_btn_link = get_option('hieucon_popup_btn_link', '#');
            $popup_delay    = (int) get_option('hieucon_popup_delay', '5') * 1000;
        ?>
        <!-- Popup Tham Gia Group -->
    <style>
    #hieucon-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 999999;
        align-items: center;
        justify-content: center;
        display: none;
    }
    #hieucon-popup-content {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: popupFadeIn 0.3s ease-out;
    }
    @keyframes popupFadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    #hieucon-popup-close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 28px;
        cursor: pointer;
        color: #888;
        line-height: 1;
    }
    #hieucon-popup-close:hover {
        color: #333;
    }
    .hieucon-popup-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-top: 0;
        margin-bottom: 10px;
    }
    .hieucon-popup-desc {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }
    .hieucon-popup-btn {
        display: inline-block;
        padding: 12px 24px;
        background: #e85d75;
        color: #fff !important;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background 0.3s;
    }
    .hieucon-popup-btn:hover {
        background: #d64961;
    }
    </style>

    <div id="hieucon-popup-overlay">
        <div id="hieucon-popup-content">
            <span id="hieucon-popup-close">&times;</span>
            <h2 class="hieucon-popup-title"><?php echo esc_html( $popup_title ); ?></h2>
            <div class="hieucon-popup-desc"><?php echo wp_kses_post( $popup_desc ); ?></div>
            <a href="<?php echo esc_url( $popup_btn_link ); ?>" class="hieucon-popup-btn" target="_blank"><?php echo esc_html( $popup_btn_text ); ?></a>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var overlay = document.getElementById("hieucon-popup-overlay");
        var closeBtn = document.getElementById("hieucon-popup-close");
        var joinBtn = document.querySelector(".hieucon-popup-btn");

        if (!overlay) return;

        // Chỉ hiển thị 1 lần mỗi ngày
        function getTodayString() {
            var today = new Date();
            return today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        }

        var popupKey = "hieucon_popup_date";
        var lastShown = localStorage.getItem(popupKey);
        var todayStr = getTodayString();

        if (lastShown !== todayStr) {
            setTimeout(function() {
                overlay.style.display = "flex";
                localStorage.setItem(popupKey, todayStr);
            }, <?php echo esc_js($popup_delay); ?>); // Hiển thị sau thời gian đã cài đặt
        }

        function closePopup() {
            overlay.style.display = "none";
        }

        closeBtn.addEventListener("click", closePopup);
        joinBtn.addEventListener("click", closePopup);
        overlay.addEventListener("click", function(e) {
            if (e.target === overlay) {
                closePopup();
            }
        });
    });
    </script>
    <?php 
        } // Kết thúc block else của if(!empty($custom_code))
    endif;
}
add_action( 'wp_footer', 'hieucon_render_popup' );
