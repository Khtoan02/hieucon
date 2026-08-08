
<div
  class="landing-checklist-wrapper antialiased relative z-10 bg-[var(--cream)] text-[var(--charcoal)] font-quicksand">
  <!-- HERO -->
  <section class="relative bg-navy pt-10 pb-12 md:pt-40 md:pb-32 px-6 overflow-hidden has-pattern-bg" id="hero-section"
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

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center relative z-10">
      <div class="text-left flex flex-col justify-center order-2 lg:order-1">
        <h1 class="font-oswald mb-6 text-white uppercase" style="line-height: 1.4; letter-spacing: 0;">
          <span class="block font-bold whitespace-nowrap"
            style="font-size: clamp(26px, 3.5vw, 44px); letter-spacing: 0;">BỘ CÔNG CỤ NHẬN DIỆN CÁC</span>
          <span class="text-yellow uppercase block my-1 sm:my-1.5 font-bold whitespace-nowrap"
            style="color: var(--yellow); font-size: clamp(38px, 6vw, 72px); letter-spacing: 0;">VẤN ĐỀ SỨC
            KHỎE</span>
          <span class="block font-bold whitespace-nowrap"
            style="font-size: clamp(26px, 3.5vw, 44px); letter-spacing: 0;">THƯỜNG GẶP Ở TRẺ TỰ KỶ</span>
        </h1>

        <p
          class="font-quicksand text-sm sm:text-base leading-relaxed text-[rgba(250,249,246,0.9)] mb-6 font-light max-w-xl">
          Đằng sau nhiều khó khăn về hành vi có thể là những vấn đề sức khỏe chưa được nhận diện. Bộ công cụ này giúp phụ huynh quan sát nhanh 8 nhóm dấu hiệu thường gặp ở trẻ tự kỷ, từ đó biết nhóm nào cần theo dõi, trao đổi chuyên môn và ưu tiên hỗ trợ trước.
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

        <!-- Nguồn tham khảo khoa học (Listed directly below the button in a 1-column layout) -->
        <div
          class="text-left text-white max-w-xl bg-[rgba(255,255,255,0.03)] border border-solid border-[rgba(255,255,255,0.08)] rounded-2xl p-5 shadow-[0_8px_32px_rgba(0,0,0,0.04)]">
          <h3 class="text-yellow font-bold text-sm uppercase tracking-wider mb-4 flex items-center gap-2"
            style="color: var(--yellow); font-family: 'Oswald', sans-serif; letter-spacing: 0.05em; margin: 0 0 14px 0;">
            📖 Nguồn tham khảo:
          </h3>
          <ul
            class="list-none p-0 m-0 flex flex-col gap-3 font-light text-[rgba(250,249,246,0.9)] leading-relaxed text-[13px]"
            style="display:flex; flex-direction:column; gap:12px; padding-left:0; margin:0; list-style:none;">
            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
              <span style="color: var(--yellow); font-weight: 800; font-size: 14px; line-height: 1;">•</span>
              <span><a href="https://www.massgeneral.org/psychiatry/treatments-and-services/pediatric-symptom-checklist/" target="_blank" rel="noopener noreferrer" class="text-yellow hover:underline font-bold" style="color: var(--yellow); text-decoration: underline;">PSC</a>: Sàng lọc hành vi & cảm xúc (trẻ từ 4-16 tuổi).</span>
            </li>
            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
              <span style="color: var(--yellow); font-weight: 800; font-size: 14px; line-height: 1;">•</span>
              <span><a href="https://site.thoracic.org/assemblies/srn/sleep-related-questionnaires/cshq" target="_blank" rel="noopener noreferrer" class="text-yellow hover:underline font-bold" style="color: var(--yellow); text-decoration: underline;">CSHQ</a>: Sàng lọc rối loạn giấc ngủ (trẻ 4-12 tuổi).</span>
            </li>
            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
              <span style="color: var(--yellow); font-weight: 800; font-size: 14px; line-height: 1;">•</span>
              <span><a href="https://psychology.osu.edu/" target="_blank" rel="noopener noreferrer" class="text-yellow hover:underline font-bold" style="color: var(--yellow); text-decoration: underline;">BAMBI</a>: Khảo sát hành vi ăn uống tự kỷ (2-11 tuổi).</span>
            </li>
            <li class="flex items-start gap-2" style="display:flex; align-items:start; gap:8px; margin-bottom: 0;">
              <span style="color: var(--yellow); font-weight: 800; font-size: 14px; line-height: 1;">•</span>
              <span><a href="https://publications.aap.org/toolkits/pages/ADHD-Toolkit?autologincheck=redirected" target="_blank" rel="noopener noreferrer" class="text-yellow hover:underline font-bold" style="color: var(--yellow); text-decoration: underline;">VADRS</a>: Đánh giá nguy cơ Tăng động - Giảm chú ý (6-12 tuổi).</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Image Column (First on mobile, second on desktop) -->
      <div class="relative order-1 lg:order-2 block w-full h-40 sm:h-48 lg:h-auto overflow-hidden rounded-2xl lg:rounded-none">
        <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-2xl transform rotate-1 lg:rotate-2 scale-105"></div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bang-check-list.png"
          alt="Bộ công cụ nhận diện các rào cản sức khỏe"
          class="relative rounded-2xl lg:rounded-3xl shadow-lg lg:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-full lg:aspect-square"
          style="object-position: center;" />
        <!-- Badge: Phù hợp với trẻ từ 2 đến 12 tuổi -->
        <div class="absolute top-3 left-3 lg:top-4 lg:left-4 bg-yellow text-navy font-bold text-[9px] sm:text-xs px-3 py-1.5 lg:px-4 lg:py-2.5 rounded-xl lg:rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,0.15)] z-20 flex items-center gap-1.5 lg:gap-2 border border-solid border-white/20 select-none uppercase tracking-wider">
          <span class="text-xs lg:text-sm">👶</span>
          <span>Phù hợp với trẻ từ 2 đến 12 tuổi</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SURVEY PAGE CONTAINER (GRID LAYOUT) -->
