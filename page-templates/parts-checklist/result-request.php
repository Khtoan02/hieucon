        <div class="form-section" id="parent-info-section" style="display:none; max-width:760px; margin: 32px auto;">
          <div class="section-header">
            <div class="section-icon">✉️</div>
            <div>
              <div class="section-title">Nhận Kết Quả Qua Email</div>
              <div class="section-subtitle">Vui lòng điền thông tin để nhận kết quả khảo sát chi tiết của con</div>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 20px;">
            <label>Tên ba mẹ *</label>
            <input type="text" id="parent-name" placeholder="Họ và tên ba mẹ" required
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
