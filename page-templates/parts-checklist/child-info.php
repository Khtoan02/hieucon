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
            <p class="m-0" style="margin:0; font-weight:500;">Nhập thông tin cơ bản về con.</p>
          </div>
          <div class="flex gap-3 items-start">
            <div
              style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
              class="shrink-0">2</div>
            <p class="m-0" style="margin:0; font-weight:500;">Tích chọn những dấu hiệu quan sát được.</p>
          </div>
          <div class="flex gap-3 items-start">
            <div
              style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
              class="shrink-0">3</div>
            <p class="m-0" style="margin:0; font-weight:500;">Điền thông tin liên hệ để nhận kết quả.</p>
          </div>
          <div class="flex gap-3 items-start">
            <div
              style="color: var(--navy); font-weight:800; width:24px; height:24px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--yellow); margin-top:2px; font-size: 11px;"
              class="shrink-0">4</div>
            <p class="m-0" style="margin:0; font-weight:500;">Liên hệ tư vấn.</p>
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
          Bảng kiểm tra này là công cụ hỗ trợ nhận diện dấu hiệu, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn phù hợp.
        </p>
      </div>

      <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
      <div class="desktop-only-widget sidebar-widget-card-white">
        <!-- Nút: Cộng đồng Facebook -->
        <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener noreferrer"
          title="Cộng Đồng"
          class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
          aria-label="Cộng đồng Facebook"
          style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
          <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;"
            class="group-hover:scale-110 transition-transform">
            <path
              d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
          </svg>
          <span>Cộng đồng</span>
        </a>

        <!-- Nút: Góc chia sẻ Zalo -->
        <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank" rel="noopener noreferrer"
          title="Góc Chia Sẻ"
          class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
          aria-label="Góc chia sẻ Zalo"
          style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
          <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
          <span>Góc chia sẻ</span>
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
    </div>

    <!-- CỘT PHẢI (3/4): KHU VỰC FORM CHÍNH -->
    <div class="lg:col-span-3" id="right-form-column">
      <!-- MAIN FORM -->

      <!-- THÔNG TIN CƠ BẢN -->
      <div class="form-section" id="info-section">
        <div class="section-header">
          <div class="section-icon">👤</div>
          <div>
            <div class="section-title">Thông tin cơ bản</div>
          </div>
        </div>
        <!-- FORM FIELDS -->
        <div class="form-row">
          <div class="form-group">
            <label>Tên của con <span style="color:#e11d48; margin-left:2px;">*</span></label>
            <input type="text" id="child-name" placeholder="Ví dụ: Nguyễn Văn A" required
              style="padding:14px 16px; font-size:15px; font-weight:600; height: 49.5px;">
          </div>

          <div class="form-group">
            <label>Giới tính <span style="color:#e11d48; margin-left:2px;">*</span></label>
            <div style="display:flex; gap:12px; height: 49.5px;">
              <label class="gender-btn-wrapper"
                style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--cream); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0; transition: all 0.25s ease; position: relative;">
                <input type="radio" name="child-gender" value="Bé trai" style="width:16px; height:16px; margin:0;">
                <span>Bé trai</span>
                <span class="gender-boy-icon"
                  style="color:#0068FF; font-size:22px; line-height:1; display:inline-block; font-weight:900; opacity:0; transform:translateY(15px) scale(0.5); transition:all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275); margin-left: 2px; text-shadow: 0 0 8px rgba(0,104,255,0.25);">♂</span>
              </label>
              <label class="gender-btn-wrapper"
                style="flex:1; display:flex; align-items:center; justify-content:center; gap:8px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; font-size:15px; font-weight:600; color:var(--charcoal); background:var(--cream); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); margin:0; transition: all 0.25s ease; position: relative;">
                <input type="radio" name="child-gender" value="Bé gái" style="width:16px; height:16px; margin:0;">
                <span>Bé gái</span>
                <span class="gender-girl-icon"
                  style="color:#ec4899; font-size:22px; line-height:1; display:inline-block; font-weight:900; opacity:0; transform:translateY(15px) scale(0.5); transition:all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275); margin-left: 2px; text-shadow: 0 0 8px rgba(236,72,153,0.25);">♀</span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-row-3">
          <div class="form-group" style="position:relative;">
            <label style="display:flex; justify-content:space-between; align-items:center;">
              <span id="dob-label-text">Ngày sinh của con <span style="color:#e11d48; margin-left:2px;">*</span></span>
              <span id="calculated-age"
                style="font-size: 13px; color: var(--navy); font-weight: 600; text-transform: none; display: none;"></span>
            </label>
            <div
              style="display:flex; align-items:center; border: 1.5px solid var(--border); border-radius: 10px; background: var(--cream); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); height: 49.5px; padding: 0 16px; gap: 8px;">
              <input type="text" inputmode="numeric" id="child-dob-day" placeholder="DD" maxlength="2"
                style="width:30px; border:none; padding:0; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
              <span style="color:var(--gray); font-weight:600; font-size:16px;">/</span>
              <input type="text" inputmode="numeric" id="child-dob-month" placeholder="MM" maxlength="2"
                style="width:30px; border:none; padding:0; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
              <span style="color:var(--gray); font-weight:600; font-size:16px;">/</span>
              <input type="text" inputmode="numeric" id="child-dob-year" placeholder="YYYY" maxlength="4"
                style="width:55px; border:none; padding:0; text-align:center; font-weight:600; font-size:15px; outline:none; background:transparent; color:var(--charcoal);">
            </div>
            <input type="hidden" id="child-age" value="">
          </div>

          <div class="form-group" style="position:relative;">
            <label>Chiều cao (cm) <span style="color:#e11d48; margin-left:2px;">*</span></label>
            <input type="number" id="child-height" placeholder="Ví dụ: 105" required
              style="padding:14px 16px; font-size:15px; font-weight:600; height: 49.5px;">
          </div>

          <div class="form-group" style="position:relative;">
            <label>Cân nặng (kg) <span style="color:#e11d48; margin-left:2px;">*</span></label>
            <input type="number" step="0.1" id="child-weight" placeholder="Ví dụ: 18.5" required
              style="padding:14px 16px; font-size:15px; font-weight:600; height: 49.5px;">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Chẩn đoán hiện tại <span style="color:#e11d48; margin-left:2px;">*</span></label>
            <select id="child-diagnosis"
              style="padding:12px 16px; font-size:15px; font-weight:600; height:49.5px; border:1.5px solid var(--border); border-radius:10px; outline:none; color:var(--charcoal); background:var(--cream); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
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
            <input type="text" id="child-therapy" placeholder="Ví dụ: ABA, ngôn ngữ, vật lý trị liệu..."
              style="padding:14px 16px; font-size:15px; font-weight:600; height: 49.5px;">
          </div>
        </div>

        <div class="form-row" style="grid-template-columns: 1fr;">
          <div class="form-group">
            <label>Đang dùng sản phẩm hỗ trợ nào không?</label>
            <input type="text" id="child-supplement" placeholder="Ví dụ: Vitamin, men vi sinh, Omega-3..."
              style="padding:14px 16px; font-size:15px; font-weight:600; height: 49.5px;">
          </div>
        </div>

        <div class="nav-buttons" style="justify-content:center; margin-top:32px;">
          <button class="btn btn-primary" onclick="startChecklist()">Tiếp theo →</button>
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
            <div style="font-weight:700; margin-bottom:6px; font-size:11px; text-transform:uppercase; letter-spacing:0.5px;">📚 Tài liệu tham khảo:</div>
            <ul style="margin:0; padding:0; list-style:none; line-height:1.5;">
              <li style="margin-bottom:4px;">• <a href="https://www.massgeneral.org/psychiatry/treatments-and-services/pediatric-symptom-checklist/" target="_blank" rel="noopener noreferrer" style="color: #0d2a78; font-weight:700; text-decoration:underline;">PSC</a>: Sàng lọc hành vi & cảm xúc.</li>
              <li style="margin-bottom:4px;">• <a href="https://site.thoracic.org/assemblies/srn/sleep-related-questionnaires/cshq" target="_blank" rel="noopener noreferrer" style="color: #0d2a78; font-weight:700; text-decoration:underline;">CSHQ</a>: Sàng lọc rối loạn giấc ngủ.</li>
              <li style="margin-bottom:4px;">• <a href="https://www.autismspeaks.org/" target="_blank" rel="noopener noreferrer" style="color: #0d2a78; font-weight:700; text-decoration:underline;">BAMBI</a>: Khảo sát hành vi ăn uống.</li>
              <li style="margin-bottom:0;">• <a href="https://www.nichq.org/resource/vanderbilt-assessment-scales" target="_blank" rel="noopener noreferrer" style="color: #0d2a78; font-weight:700; text-decoration:underline;">VADRS</a>: Đánh giá Tăng động - Giảm chú ý.</li>
            </ul>
          </div>
        </div>

        <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
        <div class="sidebar-widget-card-white">
          <!-- Nút: Cộng đồng Facebook -->
          <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener noreferrer"
            title="Cộng Đồng"
            class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.25)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
            aria-label="Cộng đồng Facebook"
            style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
            <svg viewBox="0 0 320 512" style="width:14px; height:14px; fill:currentColor;"
              class="group-hover:scale-110 transition-transform">
              <path
                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
            </svg>
            <span>Cộng đồng</span>
          </a>

          <!-- Nút: Góc chia sẻ Zalo -->
          <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank" rel="noopener noreferrer"
            title="Góc Chia Sẻ"
            class="flex items-center justify-center gap-2 bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white px-3.5 py-2.5 font-bold text-xs transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.25)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.35)] hover:-translate-y-0.5 border border-white/10 group w-full text-center"
            aria-label="Góc chia sẻ Zalo"
            style="text-decoration:none; display:flex; border-radius:12px !important; margin-bottom:12px !important;">
            <span class="font-black text-xs text-white leading-none group-hover:scale-110 transition-transform">Z</span>
            <span>Góc chia sẻ</span>
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
      </div>
    </div> <!-- /#right-form-column -->
  </div> <!-- /.grid -->
</div> <!-- /#survey-page-container -->