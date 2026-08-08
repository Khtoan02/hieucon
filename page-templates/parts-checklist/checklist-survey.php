
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
        <div id="survey-completion-section" style="display: none; max-width: 820px; margin: 32px auto 0; box-sizing: border-box;">
          <div class="open-section">
            <label>Dấu hiệu khác phụ huynh muốn chia sẻ thêm (không bắt buộc)</label>
            <textarea id="extra-symptoms"
              placeholder="Ghi thêm bất kỳ dấu hiệu nào phụ huynh quan sát được ở con..."></textarea>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 32px; gap: 16px;">
            <button type="button" class="btn-prev-slide" onclick="ModuleSurvey.prevGroup(7)">← Quay lại</button>
            <button type="button" class="btn-next-slide" id="btn-show-parent-info"
              onclick="ModuleSurvey.completeSurvey()">Hoàn thành</button>
          </div>
        </div>

        <!-- THÔNG TIN PHỤ HUYNH (Mới - Sau khi xong khảo sát) -->
        <?php include get_template_directory() . '/page-templates/parts-checklist/result-request.php'; ?>

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
        title="Cộng Đồng"
        class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
        aria-label="Cộng đồng Facebook" style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
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
        class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
        aria-label="Kết nối Zalo" style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
        <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
        <span>Hỏi đáp Zalo</span>
      </a>

      <!-- Nút: Đăng nhập / Tài khoản -->
      <?php
      $current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
      if ($current_member):
        ?>
        <a href="<?php echo home_url('/tai-khoan/'); ?>"
          class="flex items-center justify-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 group w-full text-center border-0"
          style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:0 !important;">
          <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
          <span>Tài khoản</span>
        </a>
      <?php else: ?>
        <a href="<?php echo home_url('/dang-nhap/'); ?>"
          class="flex items-center justify-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 w-full text-center border-0"
          style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:0 !important;">
          <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
          <span>Đăng nhập</span>
        </a>
      <?php endif; ?>
    </div>

  </div> <!-- /#survey-sidebar -->

</div> <!-- /#survey-active-container -->
