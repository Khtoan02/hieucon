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
            style="margin:0; font-size:12px; line-height:1.6;">Bộ công cụ chỉ hỗ trợ phụ huynh nhận diện các dấu hiệu sức khỏe của con, không thay thế chẩn đoán lâm sàng hoặc tư vấn y tế chuyên nghiệp. Mọi quyết định can thiệp cho trẻ cần được thảo luận với bác sĩ hoặc chuyên gia có chuyên môn phù hợp
          </p>
        </div>

        <!-- WIDGET LIÊN KẾT NHANH (Nút Bấm Từ Header) -->
        <div class="desktop-only-widget sidebar-widget-card-white">
          <!-- Nút: Cộng đồng Facebook -->
          <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer"
            title="Cộng Đồng Ba Mẹ"
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
              title="Cộng Đồng Ba Mẹ"
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
