
<div
  class="landing-checklist-wrapper antialiased relative z-10 bg-[var(--cream)] text-[var(--charcoal)] font-quicksand">
  <!-- HERO -->
  <section class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden has-pattern-bg" id="hero-section"
    <?php if ($is_start)
      echo 'style="display:none;"'; ?>>
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
      <div
        class="absolute -top-24 -left-24 w-96 h-96 bg-[#2563eb] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[blob_7s_infinite]">
      </div>
      <div
        class="absolute top-1/4 -right-24 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[blob_7s_infinite_2s]">
      </div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
      <div class="text-left flex flex-col justify-center">
        <h1 class="font-oswald mb-6 text-white tracking-wide uppercase" style="line-height: 1.35;">
          <span class="block font-bold tracking-wider opacity-90 whitespace-nowrap"
            style="font-size: clamp(18px, 5.2vw, 30px);">BỘ CÔNG CỤ NHẬN DIỆN CÁC</span>
          <span class="text-yellow uppercase block my-2 sm:my-2.5 font-black whitespace-nowrap"
            style="color: var(--yellow); font-size: clamp(24px, 7.6vw, 48px); letter-spacing: 0.02em;">VẤN ĐỀ SỨC
            KHỎE</span>
          <span class="block font-bold tracking-wider opacity-90 whitespace-nowrap"
            style="font-size: clamp(18px, 5.2vw, 30px);">THƯỜNG GẶP Ở TRẺ TỰ KỶ</span>
        </h1>

        <p
          class="font-quicksand text-sm sm:text-base leading-relaxed text-[rgba(250,249,246,0.9)] mb-6 font-light max-w-xl">
          Đằng sau nhiều khó khăn về hành vi có thể là những vấn đề sức khỏe chưa được nhận diện. Bộ công cụ này giúp ba
          mẹ quan sát nhanh 8 nhóm dấu hiệu thường gặp ở trẻ tự kỷ, từ đó biết nhóm nào cần theo dõi, trao đổi chuyên
          môn và ưu tiên hỗ trợ trước.
        </p>

        <!-- Combined Stats & Action Card (2/3 Stats, 1/3 Button) -->
        <div
          class="bg-[rgba(255,255,255,0.06)] border border-solid border-[rgba(255,255,255,0.12)] rounded-2xl p-4 shadow-[0_8px_32px_rgba(0,0,0,0.08)] mb-6 text-white max-w-xl">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

            <!-- Left 2/3: Stats Columns -->
            <div class="md:col-span-2 grid grid-cols-3 gap-2 text-center items-center">
              <div class="py-1">
                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow"
                  style="color: var(--yellow); line-height: 1;">8</span>
                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Nhóm vấn
                  đề</span>
              </div>
              <div class="border-l border-r border-solid border-white/10 py-1">
                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow"
                  style="color: var(--yellow); line-height: 1;">40+</span>
                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Dấu hiệu</span>
              </div>
              <div class="py-1">
                <span class="block font-oswald text-2xl md:text-3xl font-extrabold text-yellow"
                  style="color: var(--yellow); line-height: 1;">5'</span>
                <span class="block mt-1 text-[9px] uppercase tracking-wider font-semibold text-white/70">Thực
                  hiện</span>
              </div>
            </div>

            <!-- Right 1/3: Start Button -->
            <div class="md:col-span-1 flex justify-center md:justify-end">
              <button onclick="goToIntro()" class="btn-hero-start w-full text-center"
                style="padding: 14px 20px; background: var(--yellow); color: var(--navy); font-family: 'Oswald', sans-serif; font-weight: 700; font-size: 15px; text-transform: uppercase; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 6px 15px rgba(255,209,84,0.3); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                <span>BẮT ĐẦU NGAY</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                  stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>
            </div>

          </div>
        </div>

        <!-- Nguồn tham khảo khoa học (Listed directly below the button in a 2-column grid layout) -->
        <div
          class="text-left text-white max-w-xl bg-[rgba(255,255,255,0.03)] border border-solid border-[rgba(255,255,255,0.08)] rounded-2xl p-5 shadow-[0_8px_32px_rgba(0,0,0,0.04)]">
          <h3 class="text-yellow font-bold text-xs uppercase tracking-wider mb-3.5 flex items-center gap-2"
            style="color: var(--yellow); font-family: 'Oswald', sans-serif; letter-spacing: 0.05em; margin: 0 0 14px 0;">
            📖 Nguồn tham khảo đối chứng khoa học:
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <ul
              class="list-none p-0 m-0 flex flex-col gap-3 font-light text-[rgba(250,249,246,0.8)] leading-relaxed text-[11px]"
              style="display:flex; flex-direction:column; gap:10px; padding-left:0; margin:0; list-style:none;">
              <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">PSC:</strong> Sàng lọc
                  hành vi & cảm xúc (trẻ từ 4-16 tuổi).</span>
              </li>
              <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">CSHQ:</strong> Sàng lọc
                  rối loạn giấc ngủ (trẻ 4-12 tuổi).</span>
              </li>
            </ul>
            <ul
              class="list-none p-0 m-0 flex flex-col gap-3 font-light text-[rgba(250,249,246,0.8)] leading-relaxed text-[11px]"
              style="display:flex; flex-direction:column; gap:10px; padding-left:0; margin:0; list-style:none;">

              <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">BAMBI:</strong> Khảo
                  sát hành vi ăn uống tự kỷ (2-11 tuổi).</span>
              </li>
              <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
                <span style="color: var(--yellow); font-weight: 800; font-size: 12px; line-height: 1;">•</span>
                <span><strong class="text-yellow" style="color: var(--yellow); font-weight:700;">VADRS:</strong> Đánh
                  giá nguy cơ Tăng động - Giảm chú ý (6-12 tuổi).</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="relative hidden lg:block">
        <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bang-check-list.png"
          alt="Bộ công cụ nhận diện các rào cản sức khỏe"
          class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full aspect-square"
          style="aspect-ratio: 1 / 1;" />
      </div>
    </div>
  </section>

  <!-- SURVEY PAGE CONTAINER (GRID LAYOUT) -->
  <div class="max-w-7xl mx-auto px-6 py-12" id="survey-page-container" style="display:none;">
    <div class="survey-page-grid">

      <!-- CỘT TRÁI (1/4): WIDGET FIXED/STICKY -->
      <div class="survey-sidebar-sticky" id="sticky-sidebar" style="display:flex; flex-direction:column; gap:24px;">
        <!-- WIDGET CÁCH SỬ DỤNG (Nổi bật màu Navy) -->
        <div
          class="bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg"
          style="background-color: var(--navy); color: white;">
          <!-- Decorative subtle light circle -->
          <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>

          <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase"
            style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 17px; letter-spacing: 0.03em;">
            <span style="font-size:18px;">📋</span> Hướng dẫn làm bài
          </h3>
          <div class="flex flex-col gap-4"
            style="display: flex; flex-direction: column; gap: 16px; font-size: 13.5px; line-height: 1.5; color: #ffffff;">
            <div class="flex gap-3 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
                class="shrink-0">1</div>
              <p class="m-0" style="margin:0; font-weight:500;">Nhập thông tin cơ bản về con (Họ tên, ngày sinh, chiều
                cao, cân nặng...).</p>
            </div>
            <div class="flex gap-3 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
                class="shrink-0">2</div>
              <p class="m-0" style="margin:0; font-weight:500;">Tích chọn những dấu hiệu quan sát được ở con qua 8 nhóm
                hệ cơ quan.</p>
            </div>
            <div class="flex gap-3 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
                class="shrink-0">3</div>
              <p class="m-0" style="margin:0; font-weight:500;">Điền thông tin liên hệ của phụ huynh để nhận kết quả
                phân tích gửi qua email.</p>
            </div>
          </div>
        </div>

        <!-- WIDGET DISCLAIMER -->
        <div class="desktop-only-widget sidebar-widget-card-yellow">
          <h3 class="text-[#854d0e] font-bold text-sm mb-3 flex items-center gap-2"
            style="margin-bottom: 12px; font-weight:700;">
            <span style="font-size:16px;">⚠️</span> Lưu ý quan trọng
          </h3>
          <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light"
            style="margin:0; font-size:12px; line-height:1.6;">
            Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế
            chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn
            phù hợp.
          </p>
          <div class="mt-4 pt-3 border-t border-solid border-[#fef08a] text-[11px] text-[#854d0e] font-medium"
            style="margin-top:16px; padding-top:12px; border-top:1px solid #fef08a; font-size:11px; font-weight:500;">
            Tài liệu tham khảo: Documenting Hope
          </div>
        </div>

        <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
        <div class="desktop-only-widget sidebar-widget-card-white">
          <!-- Nút: Cộng đồng Facebook -->
          <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer"
            title="Cộng Đồng Cha Mẹ"
            class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
            aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
            <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;"
              class="group-hover:scale-110 transition-transform">
              <path
                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
            </svg>
            <span>Cộng đồng</span>
          </a>

          <!-- Nút: Hỏi đáp Zalo -->
          <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
            title="Kết Nối Chuyên Gia"
            class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
            aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
            <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
            <span>Hỏi đáp Zalo</span>
          </a>

          <!-- Nút: Đăng nhập / Tài khoản -->
          <?php
          $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
          if ($current_member):
            ?>
            <a href="<?php echo home_url('/tai-khoan/'); ?>"
              class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
              style="text-decoration:none; display:flex;">
              <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
              <span>Tài khoản</span>
            </a>
          <?php else: ?>
            <a href="<?php echo home_url('/dang-nhap/'); ?>"
              class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
              style="text-decoration:none; display:flex;">
              <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
              <span>Đăng nhập</span>
            </a>
          <?php endif; ?>
        </div>
      </div>

      <!-- CỘT PHẢI (3/4): KHU VỰC FORM CHÍNH -->
      <div class="lg:col-span-3" id="right-form-column">
        <!-- MAIN FORM -->

        <!-- THÔNG TIN CƠ BẢN -->
        <div class="form-section" id="info-section">
          <div class="section-header">
            <div class="section-icon">👤</div>
            <div>
              <div class="section-title">Thông tin về con</div>
              <div class="section-subtitle">Giúp chuyên gia tư vấn hiểu ngữ cảnh trước buổi gặp</div>
            </div>
          </div>
          <!-- GROUP 1: Tên của con -->
          <div
            style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">
            1. Tên của con</div>
          <div class="form-row" style="margin-bottom:24px;">
            <div class="form-group" style="grid-column: 1 / -1;">
              <label>Họ và tên của con *</label>
              <input type="text" id="child-name" placeholder="Ví dụ: Nguyễn Văn A" required
                style="padding:14px 16px; font-size:15px; font-weight:600;">
            </div>
          </div>

          <!-- GROUP 2: Thông tin của con -->
          <div
            style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">
            2. Thông tin của con</div>
          <div class="form-row">
            <div class="form-group" style="position:relative;">
              <label style="margin-bottom:8px; display:flex; flex-wrap:wrap; align-items:center; gap:6px;">
                <span>Ngày sinh của con *</span>
                <span style="font-size:12px; color:var(--gray); font-weight:400; text-transform:none;">(Để tính chính
                  xác độ tuổi)</span>
              </label>
              <div
                style="display:flex; border: 1.5px solid var(--border); border-radius: 10px; overflow: hidden; background: var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                <div style="flex:1; border-right: 1px solid var(--border); position: relative;">
                  <div
                    style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">
                    Ngày</div>
                  <input type="text" inputmode="numeric" list="dob-days" id="child-dob-day" oninput="calculateAge()"
                    placeholder="DD"
                    style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
                  <datalist id="dob-days">
                    <?php for ($i = 1; $i <= 31; $i++) {
                      echo '<option value="' . $i . '">';
                    } ?>
                  </datalist>
                </div>
                <div style="flex:1; border-right: 1px solid var(--border); position: relative;">
                  <div
                    style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">
                    Tháng</div>
                  <input type="text" inputmode="numeric" list="dob-months" id="child-dob-month" oninput="calculateAge()"
                    placeholder="MM"
                    style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
                  <datalist id="dob-months">
                    <?php for ($i = 1; $i <= 12; $i++) {
                      echo '<option value="' . $i . '">';
                    } ?>
                  </datalist>
                </div>
                <div style="flex:1.2; position: relative;">
                  <div
                    style="position:absolute; top:4px; left:0; right:0; text-align:center; font-size:9px; font-weight:700; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px; pointer-events:none;">
                    Năm</div>
                  <input type="text" inputmode="numeric" list="dob-years" id="child-dob-year" oninput="calculateAge()"
                    placeholder="YYYY"
                    style="width:100%; border:none; padding:18px 8px 8px; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
                  <datalist id="dob-years">
                    <?php $curYear = date('Y');
                    for ($i = $curYear; $i >= ($curYear - 20); $i--) {
                      echo '<option value="' . $i . '">';
                    } ?>
                  </datalist>
                </div>
              </div>
              <div id="calculated-age"
                style="font-size: 13px; color: var(--navy); margin-top: 8px; font-weight: 600; text-align:left;"></div>
              <input type="hidden" id="child-age" value="">
            </div>

            <div class="form-group">
              <label style="margin-bottom:8px; display:flex; flex-wrap:wrap; align-items:center; gap:6px;">
                <span>Giới tính *</span>
                <span style="font-size:12px; color:var(--gray); font-weight:400; text-transform:none;">(Dùng cho chỉ số
                  phát triển)</span>
              </label>
              <div style="display:flex; gap:12px; height: 49.5px;">
                <label
                  style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
                  <input type="radio" name="child-gender" value="Bé trai" style="width:16px; height:16px; margin:0;"> Bé
                  trai
                </label>
                <label
                  style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--white); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0;">
                  <input type="radio" name="child-gender" value="Bé gái" style="width:16px; height:16px; margin:0;"> Bé
                  gái
                </label>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-4" style="margin-bottom: 24px;">
            <div class="form-group" style="position:relative;">
              <label>Chiều cao (cm) *</label>
              <input type="number" id="child-height" placeholder="Ví dụ: 105" required
                style="padding:14px 16px; font-size:15px; font-weight:600;">
            </div>
            <div class="form-group" style="position:relative;">
              <label>Cân nặng (kg) *</label>
              <input type="number" step="0.1" id="child-weight" placeholder="Ví dụ: 18.5" required
                style="padding:14px 16px; font-size:15px; font-weight:600;">
            </div>
          </div>

          <!-- GROUP 3: Tình trạng -->
          <div
            style="font-size:14px; font-weight:700; color:var(--navy); margin-bottom:12px; border-bottom:1px solid var(--border); padding-bottom:8px;">
            3. Tình trạng & Can thiệp</div>
          <div class="form-row">
            <div class="form-group">
              <label>Chẩn đoán hiện tại *</label>
              <select id="child-diagnosis">
                <option value="">-- Chọn --</option>
                <option>Tự kỷ (ASD)</option>
                <option>Tăng động giảm chú ý (ADHD)</option>
                <option>Chậm phát triển</option>
                <option>Chưa có chẩn đoán chính thức</option>
                <option>Khác</option>
              </select>
            </div>
            <div class="form-group">
              <label>Con đang được can thiệp gì?</label>
              <input type="text" id="child-therapy" placeholder="ABA, ngôn ngữ, vật lý trị liệu...">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
              <label>Đang dùng sản phẩm hỗ trợ nào không?</label>
              <input type="text" id="child-supplement" placeholder="Vitamin, men vi sinh, Omega-3...">
            </div>
          </div>
          <div class="form-group">
            <label>Điều cha mẹ lo lắng nhất về con hiện tại là gì?</label>
            <textarea id="parent-concern" placeholder="Chia sẻ ngắn gọn điều khiến cha mẹ trăn trở nhất..."></textarea>
          </div>
          <div class="nav-buttons" style="justify-content:center;">
            <button class="btn btn-primary" onclick="startChecklist()">Bắt đầu kiểm tra →</button>
          </div>
        </div> <!-- /#info-section -->

        <!-- MOBILE ONLY: DISCLAIMER & CTA BUTTONS -->
        <div class="mobile-only-widget mt-8" style="display:flex; flex-direction:column; gap:24px;">
          <!-- Divider to separate checklist from bottom content -->
          <div class="border-t-2 border-solid border-[#e2e8f0] my-2 pt-2"></div>
          <!-- WIDGET DISCLAIMER -->
          <div class="sidebar-widget-card-yellow">
            <h3 class="text-[#854d0e] font-bold text-sm mb-3 flex items-center gap-2"
              style="margin-bottom: 12px; font-weight:700; margin-top:0;">
              <span style="font-size:16px;">⚠️</span> Lưu ý quan trọng
            </h3>
            <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light"
              style="margin:0; font-size:12px; line-height:1.6;">
              Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế
              chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên
              môn phù hợp.
            </p>
            <div class="mt-4 pt-3 border-t border-solid border-[#fef08a] text-[11px] text-[#854d0e] font-medium"
              style="margin-top:16px; padding-top:12px; border-top:1px solid #fef08a; font-size:11px; font-weight:500;">
              Tài liệu tham khảo: Documenting Hope
            </div>
          </div>

          <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
          <div class="sidebar-widget-card-white">
            <!-- Nút: Cộng đồng Facebook -->
            <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer"
              title="Cộng Đồng Cha Mẹ"
              class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
              aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
              <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;"
                class="group-hover:scale-110 transition-transform">
                <path
                  d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
              </svg>
              <span>Cộng đồng</span>
            </a>

            <!-- Nút: Hỏi đáp Zalo -->
            <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
              title="Kết Nối Chuyên Gia"
              class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
              aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
              <span
                class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
              <span>Hỏi đáp Zalo</span>
            </a>

            <!-- Nút: Đăng nhập / Tài khoản -->
            <?php
            $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
            if ($current_member):
              ?>
              <a href="<?php echo home_url('/tai-khoan/'); ?>"
                class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
                style="text-decoration:none; display:flex;">
                <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                <span>Tài khoản</span>
              </a>
            <?php else: ?>
              <a href="<?php echo home_url('/dang-nhap/'); ?>"
                class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
                style="text-decoration:none; display:flex;">
                <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                <span>Đăng nhập</span>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div> <!-- /#right-form-column -->
    </div> <!-- /.grid -->
  </div> <!-- /#survey-page-container -->

  <!-- SURVEY ACTIVE CONTAINER (GRID LAYOUT FOR SURVEY STEP) -->
  <div class="max-w-7xl mx-auto px-6 py-12 survey-grid" id="survey-active-container" style="display:none;">

    <!-- CỘT TRÁI (3/4): KHU VỰC KHẢO SÁT CHÍNH -->
    <div id="checklist-main-column">
      <!-- MAIN FORM -->
      <div id="main-form">

        <!-- MOBILE ONLY: HƯỚNG DẪN KHẢO SÁT -->
        <div
          class="block lg:hidden bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg mb-6"
          style="background-color: var(--navy); color: white;">
          <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
          <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase"
            style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em; margin-top: 0;">
            <span style="font-size:18px;">📋</span> Hướng dẫn khảo sát
          </h3>
          <div class="flex flex-col gap-4"
            style="display: flex; flex-direction: column; gap: 16px; font-size: 13px; line-height: 1.5; color: #ffffff;">
            <div class="flex gap-2.5 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
                class="shrink-0">1</div>
              <p class="m-0" style="margin:0; font-weight:500;">Tích chọn các dấu hiệu quan sát thấy ở con trong nhóm
                hiện tại.</p>
            </div>
            <div class="flex gap-2.5 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
                class="shrink-0">2</div>
              <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Tiếp theo →" hoặc click tên nhóm ở trên để chuyển
                phần.</p>
            </div>
            <div class="flex gap-2.5 items-start">
              <div
                style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
                class="shrink-0">3</div>
              <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Hoàn thiện & nhận kết quả" sau khi điền xong nhóm
                thứ 8.</p>
            </div>
          </div>
        </div>

        <!-- PROGRESS -->
        <div class="progress-wrap" id="progress-wrap" style="display:none;">
          <div class="progress-header">
            <span class="progress-label">Tiến trình hoàn thành</span>
            <span class="progress-count" id="progress-count">0 / 8 nhóm</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
          <div class="progress-steps" id="progress-steps"></div>
        </div>

        <!-- CHECKLIST DATA -->
        <div id="checklist-container"></div>

        <!-- OPEN-ENDED & SUBMIT SECTION (Outside Groups) -->
        <div id="survey-completion-section" style="display: none; margin-top: 32px;">
          <div class="open-section">
            <label>Triệu chứng khác cha mẹ muốn chia sẻ thêm (không bắt buộc)</label>
            <textarea id="extra-symptoms"
              placeholder="Ghi thêm bất kỳ dấu hiệu nào cha mẹ quan sát được ở con..."></textarea>
          </div>
          <div class="flex justify-end mt-8">
            <button type="button" class="btn btn-submit" id="btn-show-parent-info"
              onclick="ModuleSurvey.completeSurvey()">Hoàn thiện & nhận kết quả →</button>
          </div>
        </div>

        <!-- THÔNG TIN PHỤ HUYNH (Mới - Sau khi xong khảo sát) -->
        <div class="form-section" id="parent-info-section" style="display:none; max-width:760px; margin: 32px auto;">
          <div class="section-header">
            <div class="section-icon">✉️</div>
            <div>
              <div class="section-title">Nhận Kết Quả Qua Email</div>
              <div class="section-subtitle">Vui lòng điền thông tin để nhận kết quả khảo sát chi tiết của con</div>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 20px;">
            <label>Tên cha / mẹ *</label>
            <input type="text" id="parent-name" placeholder="Họ và tên phụ huynh" required
              style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
            <div class="form-group">
              <label>Số điện thoại / Zalo *</label>
              <input type="tel" id="parent-phone" placeholder="Ví dụ: 0987654321" required
                style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
            </div>
            <div class="form-group">
              <label>Email liên hệ nhận kết quả *</label>
              <input type="email" id="parent-email" placeholder="Ví dụ: email@gmail.com" required
                style="padding:14px 16px; font-size:15px; font-weight:600; width:100%; border:1.5px solid var(--border); border-radius:10px; font-family:'Quicksand', sans-serif; background:var(--cream); outline:none;">
            </div>
          </div>

          <div class="nav-buttons" style="display:flex; justify-content:flex-end;">
            <button class="btn btn-submit" id="btn-final-submit" onclick="submitParentInfo()"
              style="padding: 14px 28px; background:var(--navy); color:var(--white); font-weight:700; border:none; border-radius:10px; cursor:pointer; font-size:15px; font-family:'Quicksand', sans-serif;">Hoàn
              thiện & nhận kết quả →</button>
          </div>
        </div>

      </div>
    </div> <!-- /#main-form -->
  </div> <!-- /#checklist-main-column -->

  <!-- CỘT PHẢI (1/4): SIDEBAR BIỂU ĐỒ & HƯỚNG DẪN (Sticky) -->
  <div class="survey-sidebar-sticky" id="survey-sidebar" style="display:flex; flex-direction:column; gap:24px;">

    <!-- WIDGET 2: HƯỚNG DẪN KHẢO SÁT (Màu Navy) -->
    <div
      class="desktop-only-widget bg-navy rounded-2xl p-6 border border-solid border-[rgba(255,255,255,0.15)] shadow-[0_10px_25px_rgba(0,39,149,0.15)] text-white relative overflow-hidden has-pattern-bg"
      style="background-color: var(--navy); color: white;">
      <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
      <h3 class="font-bold text-base mb-4 flex items-center gap-2 text-yellow font-oswald tracking-wide uppercase"
        style="color: var(--yellow); margin-bottom: 16px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em;">
        <span style="font-size:18px;">📋</span> Hướng dẫn khảo sát
      </h3>
      <div class="flex flex-col gap-4"
        style="display: flex; flex-direction: column; gap: 16px; font-size: 13px; line-height: 1.5; color: #ffffff;">
        <div class="flex gap-2.5 items-start">
          <div
            style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
            class="shrink-0">1</div>
          <p class="m-0" style="margin:0; font-weight:500;">Tích chọn các dấu hiệu quan sát thấy ở con trong nhóm hiện
            tại.</p>
        </div>
        <div class="flex gap-2.5 items-start">
          <div
            style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
            class="shrink-0">2</div>
          <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Tiếp theo →" hoặc click tên nhóm ở trên để chuyển
            phần.</p>
        </div>
        <div class="flex gap-2.5 items-start">
          <div
            style="color: var(--navy); font-weight:800; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 10px;"
            class="shrink-0">3</div>
          <p class="m-0" style="margin:0; font-weight:500;">Nhấn "Hoàn thiện & nhận kết quả" sau khi điền xong nhóm thứ
            8.</p>
        </div>
      </div>
    </div>

    <!-- WIDGET 1: RADAR CHART -->
    <div class="sidebar-widget-card has-pattern-bg" style="padding: 16px !important;">
      <!-- Close Button (Only visible on mobile overlay mode) -->
      <button onclick="toggleMobileRadar(false)" class="absolute top-4 right-4 text-white/70 hover:text-white"
        style="display:none; background:none; border:none; padding:4px; cursor:pointer; z-index: 10;"
        id="close-radar-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
      <h3 class="font-bold text-sm mb-3 text-yellow font-oswald tracking-wide uppercase text-center w-full"
        style="color: var(--yellow); margin-bottom: 12px; font-weight:700; font-family: 'Oswald', sans-serif; font-size: 15px; letter-spacing: 0.03em;">
        📊 Tổng quan dấu hiệu cha mẹ ghi nhận
      </h3>
      <div style="position: relative; width: 100%; height: 280px;">
        <canvas id="radarChartCanvas"></canvas>
      </div>
      <div class="mt-4 text-[11px] text-white/70 text-center font-light leading-relaxed">
        Biểu đồ phản ánh tỷ lệ biểu hiện dấu hiệu của từng hệ cơ quan theo thời gian thực.
      </div>
    </div>

    <!-- WIDGET 3: DISCLAIMER -->
    <div class="sidebar-widget-card-yellow">
      <h3 class="text-[#854d0e] font-bold text-sm mb-2 flex items-center gap-2"
        style="margin-bottom: 8px; font-weight:700;">
        <span>⚠️</span> Lưu ý quan trọng
      </h3>
      <p class="text-xs text-[#713f12] leading-relaxed m-0 font-light"
        style="margin:0; font-size:11px; line-height:1.5;">
        Kết quả và biểu đồ này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán chuyên khoa hoặc chỉ định
        y khoa chính thức.
      </p>
    </div>

    <!-- WIDGET 4: LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
    <div class="sidebar-widget-card-white">
      <!-- Nút: Cộng đồng Facebook -->
      <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer"
        title="Cộng Đồng Cha Mẹ"
        class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
        aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex;">
        <svg viewBox="0 0 320 512" style="width:12px; height:12px; fill:currentColor;"
          class="group-hover:scale-110 transition-transform">
          <path
            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
        </svg>
        <span>Cộng đồng</span>
      </a>

      <!-- Nút: Hỏi đáp Zalo -->
      <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
        title="Kết Nối Chuyên Gia"
        class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
        aria-label="Kết nối Zalo" style="text-decoration:none; display:flex;">
        <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
        <span>Hỏi đáp Zalo</span>
      </a>

      <!-- Nút: Đăng nhập / Tài khoản -->
      <?php
      $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
      if ($current_member):
        ?>
        <a href="<?php echo home_url('/tai-khoan/'); ?>"
          class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
          style="text-decoration:none; display:flex;">
          <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
          <span>Tài khoản</span>
        </a>
      <?php else: ?>
        <a href="<?php echo home_url('/dang-nhap/'); ?>"
          class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
          style="text-decoration:none; display:flex;">
          <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
          <span>Đăng nhập</span>
        </a>
      <?php endif; ?>
    </div>

  </div> <!-- /#survey-sidebar -->

</div> <!-- /#survey-active-container -->

<!-- THÀNH CÔNG SCREEN (Outside active container to avoid sidebar conflicts) -->
<!-- THÀNH CÔNG (Sau khi submit parent-info-section) -->
<div class="form-section" id="thankyou-section"
  style="display:none; text-align:center; padding:48px 32px; max-width:760px; margin: 32px auto;">
  <div style="font-size: 64px; margin-bottom: 24px;">✉️</div>
  <h2 style="font-family:'Oswald', sans-serif; font-size:28px; color:var(--navy); margin-bottom:16px;">Đã gửi kết quả
    thành công!</h2>
  <p style="font-size:16px; color:var(--charcoal); max-width:540px; margin:0 auto 24px; line-height:1.7;">
    Kết quả phân tích 8 nhóm dấu hiệu của con đã được gửi tới hòm thư của cha mẹ tại <strong id="sent-email-display"
      style="color:var(--navy);">[email]</strong>.
  </p>
  <p style="font-size:14px; color:#64748b; max-width:500px; margin:0 auto 32px; line-height:1.6; font-style:italic;">
    Cha mẹ vui lòng kiểm tra hộp thư đến (Inbox). Nếu không tìm thấy thư trong vòng 3-5 phút, vui lòng kiểm tra thêm thư
    mục <strong>Spam (Thư rác)</strong> hoặc <strong>Promotions (Quảng cáo)</strong>.
  </p>
  <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
    <a href="https://zalo.me/0988717107" target="_blank" rel="noopener" class="btn btn-primary"
      style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:var(--navy); color:var(--white); border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif;">
      📞 Kết nối chuyên gia qua Zalo
    </a>
    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" rel="noopener" class="btn btn-secondary"
      style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:#f1f5f9; color:#334155; border:1px solid #cbd5e1; border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif; transition: background 0.2s;">
      📬 Kiểm tra Hòm thư đến (Inbox)
    </a>
    <a href="https://mail.google.com/mail/u/0/#spam" target="_blank" rel="noopener" class="btn btn-secondary"
      style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none; padding:14px 28px; font-weight:700; background:#fff1f2; color:#be123c; border:1px solid #fecdd3; border-radius:10px; font-size:15px; font-family:'Quicksand', sans-serif; transition: background 0.2s;">
      📁 Kiểm tra Hòm thư Spam
    </a>
  </div>
</div>

<!-- RESULT PAGE -->
<div id="result-page">
  <div class="result-hero">
    <div style="font-size:48px;margin-bottom:16px;">📋</div>
    <h2>Bản Ghi Nhận Dấu Hiệu (Checklist)</h2>
    <p>Dưới đây là thống kê tỷ lệ các dấu hiệu được ghi nhận theo từng nhóm.<br>Chuyên gia tư vấn sẽ sử dụng thông tin
      này để phân tích chi tiết
      và đề xuất hướng hỗ trợ phù hợp nhất cho con.</p>
  </div>
  <div class="result-grid" id="result-grid"></div>
  <div class="cta-box">
    <h3>Đặt lịch tư vấn </h3>
    <p>Chuyên gia sẽ phân tích kết quả kiểm tra và đưa ra định hướng hỗ trợ cụ thể cho con - hoàn toàn , không
      ràng buộc.</p>
    <div class="cta-form">
      <input type="tel" placeholder="Số điện thoại / Zalo của bạn" id="cta-phone">
      <button onclick="submitCTA()">Đặt lịch ngay</button>
    </div>
    <p style="font-size:13px;opacity:0.6;margin-top:16px;">Hoặc liên hệ trực tiếp qua Zalo: <strong>0xxx xxx
        xxx</strong></p>
  </div>
  <div class="disclaimer">
    <strong>Lưu ý quan trọng:</strong> Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn
    đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc
    chuyên gia có chuyên môn phù hợp.
    <details class="mt-3 pt-3 border-t border-solid border-slate-200 text-xs text-gray-500 cursor-pointer">
      <summary class="focus:outline-none hover:text-gray-700 font-semibold">📖 Xem nguồn tài liệu tham khảo</summary>
      <ul class="list-none p-0 mt-2 flex flex-col gap-2 font-normal text-gray-600 leading-relaxed text-xs"
        style="display:flex; flex-direction:column; gap:8px; padding-left:0; margin-top:8px; list-style:none;">
        <li><strong>PSC - Pediatric Symptom Checklist:</strong> Bộ công cụ sàng lọc những vấn đề về cảm xúc và hành vi
          cho trẻ từ 4 đến 16 tuổi.</li>
        <li><strong>CSHQ - Children’s Sleep Habits Questionnaire:</strong> Bộ công cụ sàng lọc những vấn đề liên quan
          đến giấc ngủ cho trẻ từ 48 tháng đến 12 tuổi.</li>
        <li><strong>BAMBI - Brief Autism Mealtime Behavior Inventory:</strong> Bộ công cụ sàng lọc những vấn đề hành vi
          liên quan đến ăn uống ở trẻ tự kỷ từ 2 đến dưới 11 tuổi.</li>
        <li><strong>VADRS - Vanderbilt ADHD Diagnostic Rating Scale:</strong> Bộ công cụ sàng lọc nguy cơ Tăng động -
          Giảm chú ý và các rối loạn liên quan, thường dùng cho trẻ từ 6 đến 12 tuổi.</li>
        <li><strong>Documenting Hope:</strong> Một tổ chức phi lợi nhuận tại Hoa Kỳ, tập trung vào giáo dục, nghiên cứu
          và cung cấp tài nguyên về sức khỏe toàn diện cho trẻ em mắc các rối loạn phát triển thần kinh, bao gồm tự kỷ.
        </li>
      </ul>
    </details>
  </div>
</div>

</div>
</div>

