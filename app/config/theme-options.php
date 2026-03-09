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
        ?>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
/* ================================================
   POPUP – HIỂU CON TỪ GỐC  |  prefix: p-hctg
   Tương thích: mobile · tablet · desktop
   ================================================ */

/* ── LAYER 1: OVERLAY ── */
.p-hctg-ov {
  position: fixed; inset: 0; z-index: 99999;
  display: flex; align-items: flex-end; justify-content: center;
  background: rgba(14, 6, 2, 0.65);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  padding: 0;
  animation: phOvIn .32s cubic-bezier(.4,0,.2,1) both;
}
.p-hctg-ov.ph-out {
  animation: phOvOut .28s cubic-bezier(.4,0,.2,1) both;
  pointer-events: none;
}

/* ── LAYER 2: CARD ── */
.p-hctg-card {
  --radius: 24px;
  background: #ffffff;
  border-radius: var(--radius) var(--radius) 0 0;
  width: 100%;
  max-width: 100%;
  /* Mobile: bottom sheet */
  max-height: 92dvh;
  display: flex; flex-direction: column;
  overflow: hidden;
  box-shadow:
    0 -4px 24px rgba(13,148,136,.1),
    0 -16px 60px rgba(13,148,136,.18),
    0 -48px 120px rgba(13,148,136,.14);
  animation: phCardUp .46s cubic-bezier(.22,.68,0,1.1) .06s both;
  position: relative;
  font-family: 'Inter', sans-serif;
}

/* Pill drag handle – mobile UX */
.p-hctg-handle {
  width: 40px; height: 4px; border-radius: 2px;
  background: rgba(13,148,136,.25);
  margin: 12px auto 0;
  flex-shrink: 0;
}

/* ── SCROLLABLE INNER ── */
.p-hctg-scroll {
  overflow-y: auto; overflow-x: hidden;
  overscroll-behavior: contain;
  flex: 1;
  /* Smooth iOS momentum */
  -webkit-overflow-scrolling: touch;
  scrollbar-width: thin;
  scrollbar-color: #99f6e4 transparent;
}
.p-hctg-scroll::-webkit-scrollbar { width: 3px; }
.p-hctg-scroll::-webkit-scrollbar-thumb { background: #99f6e4; border-radius: 3px; }

/* ── HEADER ── */
.p-hctg-hd {
  position: relative; overflow: hidden;
  padding: 28px 28px 24px;
  background:
    radial-gradient(ellipse at 90% -10%, rgba(204,251,241,.22) 0%, transparent 55%),
    radial-gradient(ellipse at 10% 110%, rgba(13,148,136,.18) 0%, transparent 50%),
    linear-gradient(148deg, #0f766e 0%, #0d9488 42%, #14b8a6 78%, #2dd4bf 100%);
  display: flex; align-items: flex-start; gap: 16px;
}

/* Close btn — top right */
.p-hctg-x {
  position: absolute; top: 14px; right: 14px;
  /* Generous tap target */
  width: 44px; height: 44px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 50%;
  background: rgba(255,255,255,.12);
  border: 1.5px solid rgba(255,255,255,.2);
  color: rgba(255,255,255,.88);
  font-size: 1rem; cursor: pointer;
  transition: background .18s, transform .22s;
  -webkit-tap-highlight-color: transparent;
  touch-action: manipulation;
  z-index: 2;
}
.p-hctg-x:hover  { background: rgba(255,255,255,.24); transform: rotate(90deg); }
.p-hctg-x:active { background: rgba(255,255,255,.18); transform: rotate(90deg) scale(.9); }

/* Header icon */
.p-hctg-icon {
  flex-shrink: 0;
  width: 54px; height: 54px;
  border-radius: 16px;
  background: rgba(255,255,255,.18);
  border: 2px solid rgba(255,255,255,.26);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.7rem;
  box-shadow: 0 4px 16px rgba(0,0,0,.15), inset 0 1px 0 rgba(255,255,255,.2);
  margin-top: 2px;
}

.p-hctg-hd-text { flex: 1; padding-right: 36px; }
.p-hctg-eyebrow {
  font-size: .62rem; font-weight: 600; letter-spacing: 2.5px;
  text-transform: uppercase; color: rgba(204,251,241,.85);
  margin-bottom: 6px; display: block;
}
.p-hctg-hd h2 {
  font-family: 'Quicksand', sans-serif;
  font-size: clamp(1.3rem, 5.5vw, 1.7rem);
  font-weight: 700; color: #fff;
  line-height: 1.18; margin: 0;
  text-shadow: 0 2px 10px rgba(0,0,0,.2);
}
.p-hctg-hd h2 em {
  font-style: italic; color: #ccfbf1;
  display: block; font-size: .88em;
}

/* ── BODY ── */
.p-hctg-body {
  padding: 22px 24px 0;
}

/* QUOTE */
.p-hctg-quote {
  position: relative;
  background: linear-gradient(135deg, #f0fdfa 0%, #e0f2fe 100%);
  border-radius: 14px;
  padding: 16px 18px 16px 20px;
  margin-bottom: 20px;
  border: 1px solid rgba(13,148,136,.18);
  overflow: hidden;
}
.p-hctg-quote::before {
  content: '';
  position: absolute; left: 0; top: 0; bottom: 0;
  width: 4px; border-radius: 4px 0 0 4px;
  background: linear-gradient(180deg, #0d9488, #14b8a6);
}
.p-hctg-qmark {
  font-family: 'Quicksand', sans-serif;
  font-size: 4rem; line-height: .55; color: #14b8a6;
  float: left; margin: 4px 6px 0 0;
  user-select: none; pointer-events: none;
}
.p-hctg-quote p {
  font-family: 'Quicksand', sans-serif;
  font-size: clamp(.98rem, 3vw, 1.08rem);
  font-weight: 600; font-style: italic;
  color: #1f2937; line-height: 1.65; margin: 0;
}
.p-hctg-quote p strong { font-style: normal; color: #0d9488; }

/* SECTION DIVIDER */
.p-hctg-sec {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 12px;
}
.p-hctg-sec::after {
  content: ''; flex: 1; height: 1px;
  background: linear-gradient(90deg, #99f6e4 0%, transparent 100%);
}
.p-hctg-sec-lbl {
  font-size: .65rem; font-weight: 700; letter-spacing: 2px;
  text-transform: uppercase; color: #0d9488;
  white-space: nowrap;
}

/* CAUSES */
.p-hctg-causes {
  list-style: none; padding: 0;
  display: flex; flex-direction: column; gap: 8px;
  margin-bottom: 12px;
}
.p-hctg-causes li {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: clamp(.83rem, 2.5vw, .9rem);
  color: #374151; line-height: 1.58;
}
.p-hctg-n {
  flex-shrink: 0;
  min-width: 22px; height: 22px;
  background: linear-gradient(135deg, #0d9488, #14b8a6);
  color: white; font-size: .62rem; font-weight: 700;
  border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  margin-top: 1px;
  box-shadow: 0 2px 6px rgba(13,148,136,.3);
}
.p-hctg-causes li strong { color: #0f766e; }

/* Insight note */
.p-hctg-note {
  display: flex; align-items: flex-start; gap: 8px;
  background: linear-gradient(135deg, #f0fdfa, #f8fafc);
  border-radius: 10px; padding: 10px 14px;
  margin-bottom: 20px;
  border: 1px solid rgba(13,148,136,.15);
  font-size: clamp(.8rem, 2.4vw, .86rem);
  color: #1f2937; line-height: 1.6;
}
.p-hctg-note-ico { flex-shrink: 0; font-size: .95rem; margin-top: 1px; }
.p-hctg-note strong { color: #0d9488; }

/* GOALS */
.p-hctg-goals {
  list-style: none; padding: 0;
  display: flex; flex-direction: column; gap: 7px;
  margin-bottom: 22px;
}
.p-hctg-goals li {
  display: flex; align-items: flex-start; gap: 9px;
  font-size: clamp(.83rem, 2.5vw, .9rem);
  color: #374151; line-height: 1.58;
}
.p-hctg-goals li::before {
  content: '▸'; color: #14b8a6;
  font-size: .75rem; flex-shrink: 0; margin-top: 2px;
}
.p-hctg-goals li strong { color: #0f766e; }

/* ── CTA FOOTER ── */
.p-hctg-footer {
  position: sticky; bottom: 0;
  background: #ffffff;
  padding: 16px 24px 20px;
  /* Safe area for notched phones */
  padding-bottom: calc(20px + env(safe-area-inset-bottom, 0px));
  border-top: 1px solid rgba(153,246,228,.3);
  box-shadow: 0 -8px 24px rgba(13,148,136,.06);
}

.p-hctg-btns { display: flex; flex-direction: column; gap: 12px; margin-bottom: 10px; }

.p-hctg-btn {
  display: flex; align-items: center; gap: 13px;
  width: 100%; padding: 14px 18px;
  color: #fff !important; font-family: 'Inter', sans-serif;
  border: none; border-radius: 14px;
  cursor: pointer; text-decoration: none;
  position: relative; overflow: hidden;
  transition: transform .22s cubic-bezier(.22,.68,0,1.2), box-shadow .22s ease;
  -webkit-tap-highlight-color: transparent;
  touch-action: manipulation;
  /* Shimmer layer */
  isolation: isolate;
}
/* Ripple shimmer on hover */
.p-hctg-btn::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,.14) 50%, transparent 70%);
  transform: translateX(-100%);
  transition: transform .5s ease;
}
.p-hctg-btn:hover::after { transform: translateX(100%); }
.p-hctg-btn:hover  { transform: translateY(-3px); }
.p-hctg-btn:active { transform: scale(.975) !important; }

.p-hctg-btn-fb {
  background: linear-gradient(135deg, #0050c8 0%, #0070f0 60%, #1a88ff 100%);
  box-shadow: 0 6px 20px rgba(0,90,210,.28), 0 2px 6px rgba(0,90,210,.18);
}
.p-hctg-btn-fb:hover { box-shadow: 0 12px 32px rgba(0,90,210,.42), 0 4px 10px rgba(0,90,210,.22); }

.p-hctg-btn-zalo {
  background: linear-gradient(135deg, #0050c8 0%, #0070f0 60%, #1a88ff 100%);
  box-shadow: 0 6px 20px rgba(0,90,210,.28), 0 2px 6px rgba(0,90,210,.18);
}
.p-hctg-btn-zalo:hover { box-shadow: 0 12px 32px rgba(0,90,210,.42), 0 4px 10px rgba(0,90,210,.22); }

.p-hctg-btn-ico {
  width: 32px; height: 32px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.15rem;
}
.p-hctg-btn-lbl { flex: 1; text-align: left; line-height: 1; }
.p-hctg-btn-title {
  display: block; font-size: .92rem; font-weight: 600;
  letter-spacing: .1px; margin-bottom: 3px;
}
.p-hctg-btn-sub {
  display: block; font-size: .67rem; opacity: .75; font-weight: 400;
}
.p-hctg-arr {
  flex-shrink: 0; font-size: .85rem; opacity: .55;
  transition: transform .2s, opacity .2s;
}
.p-hctg-btn:hover .p-hctg-arr { transform: translateX(4px); opacity: 1; }

/* Skip */
.p-hctg-skip {
  display: block; width: 100%; min-height: 36px;
  background: none; border: none; cursor: pointer;
  font-family: 'Inter', sans-serif;
  font-size: .73rem; color: #64748b;
  text-align: center;
  text-decoration: underline; text-underline-offset: 3px;
  transition: color .18s;
  -webkit-tap-highlight-color: transparent;
  padding: 4px 0;
}
.p-hctg-skip:hover { color: #0f766e; }

/* Trust pills */
.p-hctg-trust {
  display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 14px;
  margin-top: 10px; padding-top: 10px;
  border-top: 1px solid rgba(153,246,228,.5);
}
.p-hctg-trust-item {
  display: flex; align-items: center; gap: 4px;
  font-size: .62rem; color: #64748b; white-space: nowrap;
}
.p-hctg-trust-dot {
  width: 4px; height: 4px; border-radius: 50%;
  background: #14b8a6; flex-shrink: 0;
}

/* ── ANIMATIONS ── */
@keyframes phOvIn  { from { opacity:0 } to { opacity:1 } }
@keyframes phOvOut { from { opacity:1 } to { opacity:0 } }

/* Mobile: slide up from bottom */
@keyframes phCardUp {
  from { transform: translateY(40px); opacity: 0; }
  to   { transform: translateY(0);    opacity: 1; }
}

/* ────────────────────────────────────────────────────
   TABLET (≥ 600px) — centered floating card
──────────────────────────────────────────────────── */
@media (min-width: 600px) {
  .p-hctg-ov {
    align-items: center;
    padding: 20px;
  }
  .p-hctg-card {
    border-radius: 24px;
    width: 90vw;
    max-width: 520px;
    max-height: calc(100dvh - 40px);
  }
  .p-hctg-handle { display: none; }
  @keyframes phCardUp {
    from { transform: translateY(24px) scale(.96); opacity: 0; }
    to   { transform: none; opacity: 1; }
  }
  .p-hctg-hd { padding: 32px 32px 26px; }
  .p-hctg-icon { width: 58px; height: 58px; font-size: 1.85rem; }
  .p-hctg-body { padding: 24px 32px 0; }
  .p-hctg-footer { padding: 16px 32px 24px; }
}

/* ────────────────────────────────────────────────────
   DESKTOP (≥ 1024px) — wider, more breathing room
──────────────────────────────────────────────────── */
@media (min-width: 1024px) {
  .p-hctg-card { max-width: 800px; width: 90vw; }
  .p-hctg-hd { padding: 36px 36px 28px; gap: 18px; }
  .p-hctg-icon { width: 64px; height: 64px; font-size: 2rem; border-radius: 18px; }
  .p-hctg-hd h2 { font-size: 1.75rem; }
  .p-hctg-body { padding: 26px 36px 0; }
  .p-hctg-footer { padding: 18px 36px 28px; }
  .p-hctg-btn { padding: 15px 20px; width: 50%; }
  .p-hctg-btns { flex-direction: row; gap: 16px; margin-bottom: 14px; }
  .p-hctg-btn-ico { width: 36px; height: 36px; }
  .p-hctg-btn-title { font-size: 1rem; }
}

/* ────────────────────────────────────────────────────
   SMALL MOBILE (≤ 374px)
──────────────────────────────────────────────────── */
@media (max-width: 374px) {
  .p-hctg-hd { padding: 22px 20px 18px; gap: 12px; }
  .p-hctg-icon { width: 46px; height: 46px; font-size: 1.4rem; border-radius: 12px; }
  .p-hctg-body { padding: 18px 18px 0; }
  .p-hctg-footer { padding: 14px 18px 16px; }
  .p-hctg-btn { padding: 12px 14px; gap: 10px; }
  .p-hctg-btn-ico { width: 34px; height: 34px; font-size: 1rem; }
  .p-hctg-trust-item { font-size: .58rem; }
}

/* ────────────────────────────────────────────────────
   LANDSCAPE PHONE
──────────────────────────────────────────────────── */
@media (max-height: 500px) and (orientation: landscape) {
  .p-hctg-ov { align-items: center; padding: 8px; }
  .p-hctg-card { border-radius: 18px; flex-direction: row; max-height: calc(100dvh - 16px); }
  .p-hctg-handle { display: none; }
  .p-hctg-scroll { border-right: 1px solid rgba(153,246,228,.2); }
  .p-hctg-footer {
    min-width: 220px; max-width: 240px;
    border-top: none; border-left: 1px solid rgba(153,246,228,.2);
    position: static;
    display: flex; flex-direction: column; justify-content: center;
    padding: 20px 20px calc(20px + env(safe-area-inset-bottom,0px));
  }
}

/* ────────────────────────────────────────────────────
   REDUCED MOTION
──────────────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  .p-hctg-ov, .p-hctg-card { animation: none !important; }
  .p-hctg-x:hover, .p-hctg-btn:hover { transform: none !important; }
  .p-hctg-btn::after { display: none; }
}
    </style>

    <!-- ══ POPUP HTML ══ -->
    <div class="p-hctg-ov" id="phOv" role="dialog" aria-modal="true" aria-labelledby="phTitle" style="display:none;">
    <div class="p-hctg-card">

        <!-- Drag handle (mobile only) -->
        <div class="p-hctg-handle" aria-hidden="true"></div>

        <!-- Scrollable content -->
        <div class="p-hctg-scroll">

        <!-- HEADER -->
        <div class="p-hctg-hd">
            <button class="p-hctg-x" onclick="phClose()" aria-label="Đóng popup">✕</button>

            <div class="p-hctg-icon" aria-hidden="true" style="overflow: hidden;">
                <?php 
                $site_icon = get_site_icon_url();
                if ( $site_icon ) {
                    echo '<img src="' . esc_url( $site_icon ) . '" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">';
                } else {
                    echo '🌱';
                }
                ?>
            </div>

            <div class="p-hctg-hd-text">
            <span class="p-hctg-eyebrow">Chào mừng ba mẹ đến với</span>
            <h2 id="phTitle">
                Hiểu Con Từ Gốc
                <em>Tự kỷ là Rối loạn Toàn thân</em>
            </h2>
            </div>
        </div>

        <!-- IMAGE BANNER -->
        <div style="width: 100%; border-bottom: 4px solid #ccfbf1;">
            <img src="https://hieu-con.dawnbridge.vn/wp-content/uploads/2026/03/Anh-bia.jpg" alt="Hiểu Con Từ Gốc" style="width: 100%; height: auto; max-height: 280px; object-fit: cover; display: block; object-position: center;">
        </div>

        <!-- BODY -->
        <div class="p-hctg-body">

            <!-- Quote -->
            <div class="p-hctg-quote">
            <span class="p-hctg-qmark" aria-hidden="true">"</span>
            <p>Yêu thương không chỉ là chấp nhận — yêu thương là nỗ lực tìm ra gốc rễ để <strong>PHỤC HỒI sức khỏe cho con.</strong>"</p>
            </div>

            <!-- Causes -->
            <div class="p-hctg-sec">
            <span class="p-hctg-sec-lbl">🧬 Tự kỷ là rối loạn toàn thân</span>
            </div>
            <ul class="p-hctg-causes">
            <li>
                <span class="p-hctg-n">1</span>
                <span><strong>Đường ruột tổn thương</strong> (rò rỉ ruột, loạn khuẩn) ảnh hưởng trực tiếp lên não.</span>
            </li>
            <li>
                <span class="p-hctg-n">2</span>
                <span><strong>Hệ miễn dịch quá mẫn</strong> gây viêm thần kinh mạn tính.</span>
            </li>
            <li>
                <span class="p-hctg-n">3</span>
                <span><strong>Rối loạn chuyển hóa</strong> ngăn cản phát triển nhận thức của con.</span>
            </li>
            </ul>

            <div class="p-hctg-note">
            <span class="p-hctg-note-ico">👉</span>
            <span>Muốn <strong>sửa lỗi não bộ</strong>, ta phải bắt đầu <strong>phục hồi từ cơ thể.</strong></span>
            </div>

            <!-- Goals -->
            <div class="p-hctg-sec">
            <span class="p-hctg-sec-lbl">🎯 Mục tiêu nhóm</span>
            </div>
            <ul class="p-hctg-goals">
            <li>Ba mẹ chủ động — trở thành <strong>"người bác sĩ"</strong> tốt nhất của con.</li>
            <li>Lan tỏa tư duy: <strong>"Cơ thể khỏe thì não bộ mới khỏe."</strong></li>
            <li>Điểm tựa khoa học, đồng hành trên hành trình phục hồi.</li>
            </ul>

        </div><!-- /.p-hctg-body -->
        </div><!-- /.p-hctg-scroll -->

        <!-- STICKY FOOTER CTA -->
        <div class="p-hctg-footer">
        <div class="p-hctg-btns">

            <a href="https://www.facebook.com/groups/tukylaroiloantoanthan"
            target="_blank" rel="noopener noreferrer"
            class="p-hctg-btn p-hctg-btn-fb"
            onclick="phClose()"
            aria-label="Tham gia nhóm Facebook Hiểu Con Từ Gốc">
            <span class="p-hctg-btn-ico" aria-hidden="true"><img src="https://img.icons8.com/?size=100&id=13912&format=png&color=000000" alt="Facebook" style="width: 100%; height: 100%; object-fit: contain;"></span>
            <span class="p-hctg-btn-lbl">
                <span class="p-hctg-btn-title">Hiểu Con Từ Gốc</span>
                <span class="p-hctg-btn-sub">Tự kỷ là Rối loạn toàn thân</span>
            </span>
            <span class="p-hctg-arr" aria-hidden="true">→</span>
            </a>

            <a href="<?php echo esc_url( $popup_btn_link ); ?>"
            target="_blank" rel="noopener noreferrer"
            class="p-hctg-btn p-hctg-btn-zalo"
            onclick="phClose()"
            aria-label="Tham gia Nhóm Zalo Hỗ Trợ">
            <span class="p-hctg-btn-ico" aria-hidden="true">
                <img src="https://img.icons8.com/?size=100&id=0m71tmRjlxEe&format=png&color=000000" alt="Zalo" style="width: 100%; height: 100%; object-fit: contain;">
            </span>
            <span class="p-hctg-btn-lbl">
                <span class="p-hctg-btn-title"><?php echo esc_html( $popup_btn_text ); ?></span>
                <span class="p-hctg-btn-sub">Hỏi – đáp &amp; nhận hỗ trợ kịp thời</span>
            </span>
            <span class="p-hctg-arr" aria-hidden="true">→</span>
            </a>

        </div>

        <button class="p-hctg-skip" onclick="phClose()">
            Tôi đã là thành viên, đóng thông báo này
        </button>

        <div class="p-hctg-trust" aria-label="Cam kết">
            <div class="p-hctg-trust-item"><div class="p-hctg-trust-dot"></div>Hoàn toàn miễn phí</div>
            <div class="p-hctg-trust-item"><div class="p-hctg-trust-dot"></div>Không spam</div>
            <div class="p-hctg-trust-item"><div class="p-hctg-trust-dot"></div>Rời nhóm bất cứ lúc nào</div>
        </div>
        </div><!-- /.p-hctg-footer -->

    </div><!-- /.p-hctg-card -->
    </div><!-- /.p-hctg-ov -->

    <script>
    (function () {
    var OV = document.getElementById('phOv');

    /* Close */
    window.phClose = function () {
        OV.classList.add('ph-out');
        setTimeout(function () { OV.style.display = 'none'; }, 300);
    };

    /* Click backdrop */
    OV.addEventListener('click', function (e) {
        if (e.target === OV) phClose();
    });

    /* ESC key */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && window.getComputedStyle(OV).display !== 'none') phClose();
    });

    /* Focus trap */
    OV.addEventListener('keydown', function (e) {
        if (e.key !== 'Tab') return;
        var els = Array.from(OV.querySelectorAll(
        'a[href]:not([disabled]), button:not([disabled]), [tabindex]:not([tabindex="-1"])'
        )).filter(function (el) { return el.offsetParent !== null; });
        if (!els.length) return;
        var first = els[0], last = els[els.length - 1];
        if (e.shiftKey) {
        if (document.activeElement === first) { e.preventDefault(); last.focus(); }
        } else {
        if (document.activeElement === last)  { e.preventDefault(); first.focus(); }
        }
    });

    /* Swipe down to close (mobile) */
    var startY = 0, card = OV.querySelector('.p-hctg-card');
    card.addEventListener('touchstart', function (e) {
        startY = e.touches[0].clientY;
    }, { passive: true });
    card.addEventListener('touchend', function (e) {
        var dy = e.changedTouches[0].clientY - startY;
        if (dy > 80) phClose(); /* swipe down > 80px → close */
    }, { passive: true });

    /* Load logic & Timer */
    function getTodayString() {
        var today = new Date();
        return today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    }

    var popupKey = "hieucon_popup_date";
    var lastShown = localStorage.getItem(popupKey);
    var todayStr = getTodayString();

    if (lastShown !== todayStr) {
        setTimeout(function() {
            OV.style.display = "flex";
            OV.classList.remove('ph-out');
            localStorage.setItem(popupKey, todayStr);
        }, <?php echo esc_js($popup_delay); ?>);
    }
    }());
    </script>
    <?php 
        } // Kết thúc block else của if(!empty($custom_code))
    endif;
}
add_action( 'wp_footer', 'hieucon_render_popup' );
