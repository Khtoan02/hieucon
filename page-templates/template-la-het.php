<?php
/**
 * Template Name: Tại sao con la hét
 * 
 * @package Hieucon
 */
?>
<?php get_header(); ?>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Nunito', sans-serif; }
</style>

<div class="min-h-screen bg-purple-50 font-sans text-slate-800">
  <!-- Hero Section -->
  <section class="relative py-20 px-6 bg-gradient-to-br from-purple-700 to-indigo-900 text-white overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
      <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full fill-current">
        <circle cx="10" cy="10" r="20" />
        <circle cx="90" cy="50" r="30" />
        <circle cx="30" cy="80" r="25" />
      </svg>
    </div>
    <div class="max-w-4xl mx-auto relative z-10 text-center">
      <div class="inline-block px-4 py-1 mb-6 bg-purple-400 bg-opacity-30 rounded-full border border-purple-200 text-sm font-medium">
        Dành cho cha mẹ của trẻ Tự kỷ, ADHD
      </div>
      <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
        Bố mẹ phải làm gì khi con la hét liên tục trong nhà?
      </h1>
      <p class="text-xl md:text-2xl text-purple-100 mb-8 leading-relaxed max-w-3xl mx-auto">
        Đừng để những cơn cáu giận vô cớ làm bạn kiệt sức. Hãy cùng giải mã "ngôn ngữ" của con và chặn đứng cơn bão từ gốc rễ sinh hóa.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <button class="px-8 py-4 bg-white text-purple-800 font-bold rounded-xl shadow-lg hover:bg-purple-50 transition duration-300 flex items-center justify-center">
          Tìm hiểu nguyên nhân ngay <i data-lucide="chevron-down" class="ml-2 w-5 h-5"></i>
        </button>
        <a 
          href="https://www.facebook.com/profile.php?id=61555235975765" 
          target="_blank" 
          rel="noopener noreferrer"
          class="px-8 py-4 bg-purple-500 bg-opacity-20 border border-white border-opacity-30 text-white font-bold rounded-xl hover:bg-opacity-30 transition duration-300 flex items-center justify-center"
        >
          Hỗ trợ từ Helen Hoai <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Empathy Section -->
  <section class="py-16 px-6 max-w-4xl mx-auto">
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-purple-100 relative">
      <i data-lucide="heart" class="absolute -top-6 -left-6 w-12 h-12 text-purple-400 fill-current opacity-20"></i>
      <p class="text-lg italic text-slate-600 mb-6 leading-relaxed">
        "Tôi biết, đối diện với tiếng la hét chói tai, sự kiệt sức và bất lực là điều không thể tránh khỏi. Nhưng tiếng la hét chính là 'ngôn ngữ' duy nhất của con để nói rằng bên trong con đang có một cơn bão sinh hóa mà con không thể tự thoát ra được."
      </p>
      <div class="h-1 w-20 bg-purple-500 rounded-full"></div>
    </div>
  </section>

  <!-- Emergency First Aid -->
  <section class="py-16 px-6 bg-white shadow-sm">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-slate-900 mb-4">"Sơ cứu" cảm xúc khi con bùng nổ</h2>
        <p class="text-slate-500">Hành động nhanh để dập tắt cơn bão ngay lập tức</p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-purple-50 border border-purple-100 group hover:border-purple-300 transition">
          <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white mb-6 shadow-lg group-hover:scale-110 transition">
            <i data-lucide="volume-x" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-purple-900">Tắt bớt kích thích</h3>
          <p class="text-slate-600">Tắt tivi, giảm ánh sáng, giữ im lặng. Tạo không gian "tĩnh" nhất để hệ thần kinh con không bị quá tải thêm.</p>
        </div>
        
        <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-purple-50 border border-purple-100 group hover:border-purple-300 transition">
          <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white mb-6 shadow-lg group-hover:scale-110 transition">
            <i data-lucide="hand-helping" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-indigo-900">Liệu pháp Áp lực sâu</h3>
          <p class="text-slate-600">Ôm chặt hoặc nắn bóp sâu dọc cánh tay, bắp chân. Áp lực vật lý gửi tín hiệu "an toàn" trực tiếp lên não bộ.</p>
        </div>
        
        <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-purple-50 border border-purple-100 group hover:border-purple-300 transition">
          <div class="w-16 h-16 bg-violet-600 rounded-full flex items-center justify-center text-white mb-6 shadow-lg group-hover:scale-110 transition">
            <i data-lucide="wind" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-violet-900">Mỏ neo bình an</h3>
          <p class="text-slate-600">Ngồi ngang tầm mắt, hít thở sâu. Sự điềm tĩnh của bố mẹ sẽ giúp con cảm thấy được che chở để "hạ nhiệt".</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Root Causes Section -->
  <section class="py-20 px-6">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">5 "Ngòi nổ" gây bùng nổ từ bên trong</h2>
        <p class="text-slate-600 max-w-2xl mx-auto text-lg">
          Thay vì trừng phạt, hãy sắm vai "thám tử" để tìm ra và dập tắt gốc rễ của những cơn đau ngầm.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        
        <div class="flex flex-col md:flex-row gap-6 p-8 rounded-3xl border-2 transition hover:shadow-2xl bg-white bg-white border-purple-200">
          <div class="flex-shrink-0">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center shadow-sm border border-purple-100">
              <i data-lucide="stethoscope" class="w-8 h-8 text-purple-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold mb-3 text-slate-900">1. Cơn đau thể xác ngầm</h3>
            <p class="text-slate-700 mb-4 leading-relaxed">Con không thể nói 'con đau bụng'. Tiếng la hét là cách con phản ứng với táo bón, trào ngược hay đau răng...</p>
            <div class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-purple-600">
              <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Giải pháp:
            </div>
            <p class="text-slate-800 font-medium">Kiểm tra hệ tiêu hóa và các bệnh lý nền ngay đầu tiên.</p>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 p-8 rounded-3xl border-2 transition hover:shadow-2xl bg-white bg-white border-amber-200">
          <div class="flex-shrink-0">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center shadow-sm border border-purple-100">
              <i data-lucide="utensils-crossed" class="w-8 h-8 text-amber-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold mb-3 text-slate-900">2. Hiệu ứng 'Nghiện' Lúa mì & Sữa</h3>
            <p class="text-slate-700 mb-4 leading-relaxed">Đạm Gluten và Casein khi không tiêu hóa hết sẽ biến thành các chuỗi giống như 'thuốc phiện giả', gây lờ đờ hoặc kích thích tột độ.</p>
            <div class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-purple-600">
              <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Giải pháp:
            </div>
            <p class="text-slate-800 font-medium">Thử nghiệm chế độ ăn GFCF (Không Gluten - Không Sữa bò).</p>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 p-8 rounded-3xl border-2 transition hover:shadow-2xl bg-white bg-white border-indigo-200">
          <div class="flex-shrink-0">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center shadow-sm border border-purple-100">
              <i data-lucide="zap" class="w-8 h-8 text-indigo-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold mb-3 text-slate-900">3. Rác độc thần kinh & Vi khuẩn</h3>
            <p class="text-slate-700 mb-4 leading-relaxed">Nấm men Candida và vi khuẩn xấu tiết độc tố khiến não bị 'say' hoặc tăng vọt Dopamine gây hành vi bốc đồng.</p>
            <div class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-purple-600">
              <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Giải pháp:
            </div>
            <p class="text-slate-800 font-medium">Cắt giảm đường, bổ sung Men vi sinh Tâm thần (Psychobiotics).</p>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 p-8 rounded-3xl border-2 transition hover:shadow-2xl bg-white bg-white border-fuchsia-200">
          <div class="flex-shrink-0">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center shadow-sm border border-purple-100">
              <i data-lucide="brain" class="w-8 h-8 text-fuchsia-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold mb-3 text-slate-900">4. Thiếu hụt vi chất 'Nhấn Phanh'</h3>
            <p class="text-slate-700 mb-4 leading-relaxed">Khi 'chân ga' (Glutamate) quá mạnh mà 'chân phanh' (GABA) bị đứt, con sẽ luôn trong trạng thái quá tải kích thích thần kinh, dễ bùng nổ cảm xúc.</p>
            <div class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-purple-600">
              <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Giải pháp:
            </div>
            <p class="text-slate-800 font-medium">Hỗ trợ bằng Magie, B6 và Omega-3 để xoa dịu thần kinh.</p>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 p-8 rounded-3xl border-2 transition hover:shadow-2xl bg-white bg-white border-violet-200">
          <div class="flex-shrink-0">
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center shadow-sm border border-purple-100">
              <i data-lucide="microscope" class="w-8 h-8 text-violet-600"></i>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold mb-3 text-slate-900">5. Rối loạn sinh hóa chuyên sâu</h3>
            <p class="text-slate-700 mb-4 leading-relaxed">Các vấn đề về Methyl hóa, Phenol hoặc tinh thể Oxalate sắc nhọn đâm vào mô gây đau đớn tột cùng.</p>
            <div class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-purple-600">
              <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i> Giải pháp:
            </div>
            <p class="text-slate-800 font-medium">Tắm muối Epsom và áp dụng nguyên tắc 'Low & Slow' khi bổ sung vi chất.</p>
          </div>
        </div>
        
        <div class="flex flex-col p-8 rounded-3xl bg-amber-50 border-2 border-amber-200 shadow-sm">
          <div class="flex items-center gap-3 mb-4">
            <i data-lucide="info" class="w-6 h-6 text-amber-700"></i>
            <h3 class="text-xl font-bold text-amber-900 uppercase tracking-tight">Lưu ý quan trọng: Methyl hóa</h3>
          </div>
          <p class="text-amber-800 leading-relaxed">
            95% trẻ đặc biệt gặp lỗi ở chu trình này. Khi bổ sung Methyl B12 hay Folate, <strong>bắt buộc</strong> áp dụng nguyên tắc <strong>"Low and Slow"</strong>. Đừng nạp liều cao ngay lập tức để tránh gây kích thích quá mức khiến con la hét dữ dội hơn.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Roadmap Section -->
  <section class="py-20 px-6 bg-white border-y border-purple-100">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 text-purple-900">Lộ trình 4 bước cho cha mẹ</h2>
        <p class="text-slate-500">Hành trình giúp con điềm tĩnh và hợp tác trở lại</p>
      </div>

      <div class="grid gap-8">
        <div class="flex items-start gap-6 group">
          <div class="w-12 h-12 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold flex-shrink-0 shadow-lg group-hover:bg-purple-700 transition">
            1
          </div>
          <div class="pb-6 border-b border-purple-50 w-full">
            <h4 class="text-xl font-bold mb-2 text-slate-800">Thải độc từ không gian sống</h4>
            <p class="text-slate-600">Giảm bớt kích thích từ ánh sáng, tiếng ồn, không khí gia đình và tạo góc bình yên, an toàn cho con.</p>
          </div>
        </div>

        <div class="flex items-start gap-6 group">
          <div class="w-12 h-12 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold flex-shrink-0 shadow-lg group-hover:bg-purple-700 transition">
            2
          </div>
          <div class="pb-6 border-b border-purple-50 w-full">
            <h4 class="text-xl font-bold mb-2 text-slate-800">Dọn dẹp căn bếp nhà bạn</h4>
            <p class="text-slate-600">Cắt bỏ đường tinh luyện, bột ngọt, phẩm màu và các chất kích thích thần kinh.</p>
          </div>
        </div>

        <div class="flex items-start gap-6 group">
          <div class="w-12 h-12 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold flex-shrink-0 shadow-lg group-hover:bg-purple-700 transition">
            3
          </div>
          <div class="pb-6 border-b border-purple-50 w-full">
            <h4 class="text-xl font-bold mb-2 text-slate-800">Thử nghiệm Chế độ ăn kiêng & Thải độc an toàn</h4>
            <p class="text-slate-600">Áp dụng GFCF, ngâm chân bằng muối Epsom để hỗ trợ gan giải độc Phenol, bổ sung men vi sinh tâm thần Psychobiotic để thải độc sinh học...</p>
          </div>
        </div>

        <div class="flex items-start gap-6 group">
          <div class="w-12 h-12 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold flex-shrink-0 shadow-lg group-hover:bg-purple-700 transition">
            4
          </div>
          <div class="pb-6 border-b border-purple-50 w-full">
            <h4 class="text-xl font-bold mb-2 text-slate-800">Bổ sung vi chất đúng cách</h4>
            <p class="text-slate-600">Lựa chọn GABA tự nhiên, Magie, B6, folate dạng hoạt hóa hay Omega-3 chất lượng cao để xoa dịu hệ thần kinh của bé.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Community / CTA -->
  <section class="py-20 px-6 bg-purple-900 text-white relative">
    <div class="max-w-4xl mx-auto text-center relative z-10">
      <i data-lucide="heart" class="w-16 h-16 text-pink-300 mx-auto mb-8 animate-pulse"></i>
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Bố mẹ không hề đơn độc!</h2>
      <p class="text-xl text-purple-100 mb-10 leading-relaxed">
        Hành trình này đòi hỏi sự kiên trì, nhưng kết quả là sự bình yên của con và nụ cười của cả gia đình.
      </p>
      
      <div class="bg-white rounded-3xl p-10 shadow-2xl text-slate-900 max-w-2xl mx-auto border-t-8 border-purple-500">
        <div class="py-4">
          <h3 class="text-2xl font-bold mb-4 flex items-center justify-center text-purple-700 uppercase tracking-tight">
            Kết nối với Helen Hoai
          </h3>
          <p class="text-slate-600 mb-8 max-w-md mx-auto">
            Để nhận tư vấn lộ trình hỗ trợ chuyên sâu phù hợp nhất với tình trạng la hét và cáu giận của bé nhà mình.
          </p>
          
          <a 
            href="https://www.facebook.com/profile.php?id=61555235975765" 
            target="_blank" 
            rel="noopener noreferrer"
            class="inline-flex items-center px-10 py-5 bg-purple-600 text-white font-bold rounded-2xl hover:bg-purple-700 transition shadow-xl transform hover:-translate-y-1 active:scale-95"
          >
            <i data-lucide="facebook" class="w-6 h-6 mr-3"></i> Nhận hỗ trợ trực tiếp trên Facebook
          </a>
          
          <div class="mt-8 flex items-center justify-center gap-2 text-purple-400 font-medium text-sm">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
            <span>Thấu hiểu bằng trái tim - cải thiện bằng khoa học</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Decorative Circles -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-purple-800 rounded-full -mr-32 -mt-32 opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-800 rounded-full -ml-24 -mb-24 opacity-50"></div>
  </section>

  <!-- Footer -->
  <footer class="py-12 px-6 bg-slate-950 text-slate-500 text-center text-sm border-t border-purple-900">
    <div class="max-w-4xl mx-auto">
      <p class="font-semibold text-purple-300">Helen Hoai - Love for Autism</p>
      <p class="mt-2 text-slate-600">© 2024</p>
    </div>
  </footer>
</div>

<script>
  lucide.createIcons();
  
  // Script xử lý button Tìm hiểu nguyên nhân ngay scroll xuong content
  document.querySelector('button.bg-white.text-purple-800').addEventListener('click', function() {
    document.querySelector('section.py-16.px-6.max-w-4xl.mx-auto').scrollIntoView({ behavior: 'smooth' });
  });
</script>

<?php wp_footer(); ?>
