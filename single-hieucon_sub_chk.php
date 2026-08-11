<?php
/**
 * Template Name: Single Sub-Checklist
 * Post Type: hieucon_sub_chk
 */
define('IS_SUB_CHECKLIST', true);
get_header();

$checklist_id = get_the_ID();
$questions_json = get_post_meta($checklist_id, '_hieucon_sub_checklist_questions', true);
if (empty($questions_json)) {
    $questions_json = '[]';
}
$groups = json_decode($questions_json, true) ?: [];
?>

<!-- Google Fonts & Tailwind -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


<style>
    .sub-chk-body {
        background-color: #FAF9F6;
        font-family: 'Quicksand', sans-serif;
        color: #3D3D3D;
    }
    .font-oswald { font-family: 'Oswald', sans-serif; }
    .has-pattern-bg {
        position: relative;
        background: #002795;
        overflow: hidden;
        z-index: 1;
    }
    .has-pattern-bg::after {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pattern-hieu-con.png?v=1.2");
        background-size: 200px;
        background-position: right 40px center;
        background-repeat: no-repeat;
        opacity: 0.08;
        z-index: -1;
    }
    /* Custom Checkbox Design */
    .custom-chk-row {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .custom-chk-row:hover {
        background-color: #f0fdf4;
    }
    .custom-chk-box {
        width: 22px;
        height: 22px;
        border: 2px solid #CBD5E1;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        flex-shrink: 0;
    }
    .custom-chk-box svg {
        fill: none;
        stroke: white;
        stroke-width: 3px;
        width: 14px;
        height: 14px;
        display: none;
    }
    input[type="checkbox"]:checked + .custom-chk-box {
        background-color: #10B981;
        border-color: #10B981;
    }
    input[type="checkbox"]:checked + .custom-chk-box svg {
        display: block;
    }
    /* Custom Segmented Gender Buttons */
    .gender-btn-label {
        border: 1.5px solid #E2E8F0;
        transition: all 0.2s ease-in-out;
    }
    .gender-btn-label:hover {
        border-color: #CBD5E1;
        background-color: #F8FAFC;
    }
    .gender-btn-label:has(input[type="radio"]:checked) {
        border-color: #002795;
        background-color: #EEF2FF;
    }
    .gender-btn-label:has(input[type="radio"]:checked) .gender-text {
        color: #002795;
        font-weight: 700;
    }
</style>

<div class="sub-chk-body md:px-6">
    <div class="mx-auto" style="max-width: 60rem; width: 100%;">
        <!-- FORM CONTAINER -->
        <form id="hieucon-sub-checklist-form" class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            
            <!-- BANNER TIÊU ĐỀ -->
            <div class="has-pattern-bg p-8 md:p-10 text-white text-center">
                <span class="inline-block bg-yellow/20 text-yellow font-bold text-xs px-3.5 py-1.5 rounded-full border border-solid border-yellow/30 uppercase tracking-wider mb-4" style="color:#FFD154;">Hiểu Con Từ Gốc</span>
                <h1 class="font-oswald text-2xl md:text-3.5xl font-bold uppercase tracking-wide text-white leading-tight mb-3">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>
                <p class="text-sm md:text-base text-slate-100 opacity-90 font-light max-w-xl mx-auto leading-relaxed">
                    <?php 
                    $content = get_the_content();
                    echo $content ? wp_strip_all_tags($content) : 'Vui lòng điền đầy đủ các thông tin và biểu hiện của con phía dưới để nhận kết quả phân tích nhanh từ chuyên gia.';
                    ?>
                </p>
            </div>

            <!-- NỘI DUNG NHẬP LIỆU -->
            <div class="p-6 md:p-8 space-y-10">
                
                <!-- PHẦN 1: THÔNG TIN PHỤ HUYNH -->
                <div>
                    <h3 class="font-oswald text-lg font-bold text-navy border-b border-solid border-slate-100 pb-2 mb-5 flex items-center gap-2" style="color:#002795;">
                        <svg class="w-5 h-5 text-blue-600 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        1. Thông tin phụ huynh
                    </h3>
                    
                    <!-- Alert Autofill Status -->
                    <div id="autofill-alert" class="hidden bg-emerald-50 border border-solid border-emerald-200 text-emerald-800 text-xs rounded-xl p-3.5 mb-5 flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-600 inline-block align-middle -mt-0.5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Đã tự động điền thông tin của phụ huynh và bé từ lịch sử nộp trước đó!
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <div class="md:col-span-5">
                            <input type="text" name="parent_name" id="parent-name" placeholder="Họ tên phụ huynh *" class="w-full border border-solid border-slate-200 focus:border-navy outline-none rounded-xl px-4 text-sm transition-all h-[48px] box-border" required>
                        </div>
                        <div class="md:col-span-3">
                            <input type="tel" name="parent_phone" id="parent-phone" placeholder="Số điện thoại *" class="w-full border border-solid border-slate-200 focus:border-navy outline-none rounded-xl px-4 text-sm transition-all h-[48px] box-border" required>
                        </div>
                        <div class="md:col-span-4">
                            <input type="email" name="parent_email" id="parent-email" placeholder="Email nhận kết quả *" class="w-full border border-solid border-slate-200 focus:border-navy outline-none rounded-xl px-4 text-sm transition-all h-[48px] box-border" required>
                        </div>
                    </div>
                </div>

                <!-- PHẦN 2: THÔNG TIN CỦA BÉ -->
                <div>
                    <h3 class="font-oswald text-lg font-bold text-navy border-b border-solid border-slate-100 pb-2 mb-5 flex items-center gap-2" style="color:#002795;">
                        <svg class="w-5 h-5 text-blue-600 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        2. Thông tin của con
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <div class="md:col-span-5">
                            <input type="text" name="child_name" id="child-name" placeholder="Họ tên con *" class="w-full border border-solid border-slate-200 focus:border-navy focus:ring-1 focus:ring-navy outline-none rounded-xl px-4 text-sm transition-all h-[48px] box-border" required>
                        </div>
                        <div class="md:col-span-3">
                            <div class="relative">
                                <input type="text" id="child-dob-formatted" placeholder="Ngày sinh của con (DD/MM/YYYY) *" class="w-full border border-solid border-slate-200 focus:border-navy focus:ring-1 focus:ring-navy outline-none rounded-xl pl-4 pr-20 text-sm transition-all h-[48px] box-border text-slate-700" required>
                                <span id="calculated-age-display" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-blue-600"></span>
                            </div>
                        </div>
                        <div class="md:col-span-4">
                            <div class="flex gap-4 w-full h-[48px]">
                                <!-- Nút Bé Trai -->
                                <label class="flex-1 flex items-center justify-center border border-solid rounded-xl px-4 py-2.5 bg-white cursor-pointer select-none transition-all gender-btn-label h-full box-border" for="gender-boy">
                                    <input type="radio" name="child_gender" id="gender-boy" value="Bé Trai" class="hidden" required>
                                    <span class="text-sm font-semibold text-slate-600 gender-text flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 2.209-1.791 4-4 4s-4-1.791-4-4 1.791-4 4-4 4 1.791 4 4zm0 0l7-7m0 0h-4m4 0v4" />
                                        </svg>
                                        Bé Trai
                                    </span>
                                </label>
                                <!-- Nút Bé Gái -->
                                <label class="flex-1 flex items-center justify-center border border-solid rounded-xl px-4 py-2.5 bg-white cursor-pointer select-none transition-all gender-btn-label h-full box-border" for="gender-girl">
                                    <input type="radio" name="child_gender" id="gender-girl" value="Bé Gái" class="hidden">
                                    <span class="text-sm font-semibold text-slate-600 gender-text flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1.5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 13c2.209 0 4-1.791 4-4s-1.791-4-4-4-4 1.791-4 4 1.791 4 4 4zm0 0v8m-3-3h6" />
                                        </svg>
                                        Bé Gái
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="md:col-span-12">
                            <input type="text" name="child_diagnosis" id="child-diagnosis" placeholder="Chẩn đoán hiện tại nếu có (Ví dụ: Tự kỷ, Chậm nói, Tăng động...)" class="w-full border border-solid border-slate-200 focus:border-navy outline-none rounded-xl px-4 text-sm transition-all h-[48px] box-border">
                        </div>
                    </div>
                </div>

                <!-- PHẦN 3: KHẢO SÁT CÁC NHÓM BIỂU HIỆN -->
                <div>
                    <h3 class="font-oswald text-lg font-bold text-navy border-b border-solid border-slate-100 pb-2 mb-6 flex items-center gap-2" style="color:#002795;">
                        <svg class="w-5 h-5 text-blue-600 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        3. Đánh giá dấu hiệu hành vi
                    </h3>
                    
                    <?php if (empty($groups)): ?>
                        <p class="text-sm italic text-slate-400">Bộ checklist con này chưa được cấu hình câu hỏi trong Admin.</p>
                    <?php else: ?>
                        <div class="space-y-8">
                            <?php foreach ($groups as $gIdx => $group): 
                                $group_id = sanitize_title($group['id']);
                                $items = $group['items'] ?? [];
                            ?>
                                    
                                    <div class="space-y-2 bg-white rounded-xl border border-solid border-slate-100 divide-y divide-solid divide-slate-100 overflow-hidden">
                                        <?php foreach ($items as $iIdx => $item): 
                                            $unique_id = "chk-{$group_id}-{$iIdx}";
                                        ?>
                                            <label class="custom-chk-row flex items-start gap-3 p-4 select-none m-0" for="<?php echo $unique_id; ?>">
                                                <input type="checkbox" id="<?php echo $unique_id; ?>" data-group="<?php echo esc_attr($group_id); ?>" data-val="<?php echo esc_attr($item['main']); ?>" class="hidden">
                                                <div class="custom-chk-box">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </div>
                                                <div class="text-sm text-slate-600 font-medium leading-relaxed">
                                                    <?php echo esc_html($item['main']); ?>
                                                    <?php if (!empty($item['example'])): ?>
                                                        <span class="block text-xs text-amber-600 font-normal mt-1 bg-amber-50 rounded px-2.5 py-1 border border-solid border-amber-100/50 w-fit flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5 text-amber-600 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                                            </svg>
                                                            <em>Ví dụ:</em> <?php echo esc_html($item['example']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- NÚT GỬI KHẢO SÁT & LƯU Ý QUAN TRỌNG -->
                <div class="text-center mb-10 space-y-4">
                    <button type="submit" id="btn-submit-form" class="w-full md:w-auto bg-navy hover:bg-navy/90 text-white font-bold text-sm uppercase tracking-wider rounded-full shadow-lg transition-all cursor-pointer border-0" style="background:#002795; padding: 1.1rem 3.5rem; letter-spacing: 0.5px;">
                        Hoàn thành & nhận kết quả phân tích
                    </button>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-2xl mx-auto m-0" style="font-family: 'Quicksand', sans-serif;">
                        <strong class="text-slate-500">Lưu ý quan trọng:</strong> Kết quả trên mang tính chất sàng lọc sơ bộ hành vi biểu hiện y sinh học của trẻ theo góc nhìn của phụ huynh để định hướng trải nghiệm quan sát của cha mẹ tại Hiểu con từ Gốc, <strong class="text-slate-500">không thay thế chẩn đoán y tế lâm sàng</strong>.
                    </p>
                </div>

                <!-- DẤU HIỆU CẦN LƯU Ý NGAY -->
                <div class="my-10">
                    <!-- Warning Box -->
                    <div class="rounded-2xl p-6 md:p-8 text-left transition-all border border-solid" 
                         style="background: linear-gradient(135deg, rgba(254, 242, 242, 0.6) 0%, rgba(254, 244, 244, 0.3) 100%); 
                                border-color: rgba(239, 68, 68, 0.15); 
                                border-left-width: 5px; 
                                border-left-color: #ef4444;
                                box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.03), 0 8px 10px -6px rgba(220, 38, 38, 0.03);
                                backdrop-filter: blur(8px);
                                -webkit-backdrop-filter: blur(8px);">
                        
                        <!-- Header -->
                        <h3 class="font-bold text-sm md:text-base mb-4 flex items-center gap-3 uppercase tracking-wider" 
                            style="color: #be123c; margin-top:0; font-family:'Oswald', sans-serif;">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full" style="background: rgba(239, 68, 68, 0.1); color: #be123c;">
                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            DẤU HIỆU CẦN LƯU Ý NGAY
                        </h3>
                        
                        <!-- Main Content -->
                        <div class="text-sm md:text-[15px] leading-relaxed font-bold mb-4" style="color: #9f1239; font-family: 'Quicksand', sans-serif;">
                            Không chờ kết quả Checklist nếu con có: máu trong phân/chảy máu trực tràng, đau bụng liên tục hoặc dữ dội, nôn nhiều, chướng bụng rõ, sụt cân, hoặc có dấu hiệu mất nước. Hãy liên hệ cơ sở y tế phù hợp để được đánh giá.
                        </div>
                        
                        <!-- Footer Notes -->
                        <div class="text-[12px] md:text-[13px] leading-relaxed border-t pt-3.5" 
                             style="color: rgba(159, 18, 57, 0.75); border-top: 1px dashed rgba(239, 68, 68, 0.15); font-family: 'Quicksand', sans-serif;">
                            <span class="font-bold" style="color: #be123c;">NIDDK khuyến nghị:</span> Trẻ có táo bón kèm máu trong phân, đau bụng liên tục, nôn, chướng bụng hoặc sụt cân cần được khám; với tiêu chảy, các dấu hiệu như mất nước, nôn thường xuyên, đau nặng hoặc phân có máu cũng cần được đánh giá sớm.
                        </div>
                    </div>
                </div>
        </form>

        <!-- THÔNG BÁO GỬI THÀNH CÔNG -->
        <div id="sub-success-card" class="bg-white rounded-3xl shadow-xl border border-slate-100 p-10 text-center space-y-6" style="display: none;">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-2 animate-bounce mx-auto">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="font-oswald text-2xl md:text-3xl font-bold text-navy uppercase" style="color:#002795;">Nộp kết quả thành công!</h2>
            <p class="text-sm md:text-base text-slate-600 max-w-lg mx-auto leading-relaxed">
                Kết quả khảo sát của bé đã được ghi nhận. Hệ thống đang tiến hành phân tích chi tiết. Quý phụ huynh có thể xem báo cáo phân tích ngay lập tức bằng nút dưới đây:
            </p>
            
            <div class="pt-4">
                <a id="btn-view-results" href="#" target="_blank" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm uppercase tracking-wider px-8 py-3.5 rounded-full shadow-md transition-all no-underline">
                    Xem kết quả phân tích trực tiếp
                </a>
            </div>
            
            <div class="border-t border-solid border-slate-100 pt-6 mt-6">
                <p class="text-xs text-slate-400 max-w-md mx-auto leading-relaxed">
                    Một bản sao kết quả cùng mã số hồ sơ cũng đã được gửi tới địa chỉ email của phụ huynh. Vui lòng kiểm tra thêm mục Spam nếu không thấy trong hộp thư đến.
                </p>
            </div>
        </div>
        
    </div>
</div>

<!-- LOGIC XỬ LÝ NỘP FORM & AUTOFILL -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('hieucon-sub-checklist-form');
    const successCard = document.getElementById('sub-success-card');
    const submitBtn = document.getElementById('btn-submit-form');
    const viewResultsBtn = document.getElementById('btn-view-results');
    const phoneInput = document.getElementById('parent-phone');
    const autofillAlert = document.getElementById('autofill-alert');
    
    // Input Ngày sinh mới
    const dobInput = document.getElementById('child-dob-formatted');

    const startTime = Date.now();
    const groupsConfig = <?php echo $questions_json; ?>;
    const checklistId = <?php echo $checklist_id; ?>;
    
    // Tạo user code ngẫu nhiên
    const userCode = Math.floor(10000000 + Math.random() * 90000000).toString();

    // Khởi trị UTM
    const utms = {};
    const params = new URLSearchParams(window.location.search);
    for (const [key, value] of params.entries()) {
        if (key.startsWith('utm_')) {
            utms[key] = value;
        }
    }
    
    // Tracking dữ liệu IP/Vị trí cơ bản
    const deepTracker = {
        activeTime: 0,
        toggles: {},
        thinkTimes: {},
        deletedChars: 0,
        location: 'Đang lấy...',
        ip: '',
        referrer: document.referrer || '',
        utms: utms,
        drop_point: 'Đang điền form 1 trang',
        lastFocus: Date.now()
    };

    fetch('https://api.db-ip.com/v2/free/self')
        .then(res => res.json())
        .then(data => {
            deepTracker.location = data.city + ', ' + data.countryName;
            deepTracker.ip = data.ipAddress;
        }).catch(e => {
            deepTracker.location = 'Không xác định';
        });

    // Checkbox Toggles tracking
    document.querySelectorAll('input[type="checkbox"]').forEach(chk => {
        chk.addEventListener('change', function() {
            const labelText = this.dataset.val;
            const grpId = this.dataset.group;
            const itemKey = `${grpId}_${labelText}`;
            
            if (!deepTracker.toggles[itemKey]) {
                deepTracker.toggles[itemKey] = 0;
            }
            deepTracker.toggles[itemKey]++;
        });
    });

    // Tự động định dạng và tính tuổi khi nhập Ngày sinh
    if (dobInput) {
        dobInput.addEventListener('input', function(e) {
            let val = this.value;
            let lastLen = this.lastLen || 0;
            this.lastLen = val.length;
            
            // Nếu người dùng đang xóa lùi (Backspace/Delete), để họ xóa thoải mái, không tự động thêm format
            if (val.length < lastLen) {
                calculateAge(val);
                return;
            }
            
            let clean = val.replace(/\D/g, '');
            if (clean.length > 8) clean = clean.substring(0, 8);
            
            let finalVal = clean;
            if (clean.length > 4) {
                finalVal = clean.substring(0, 2) + '/' + clean.substring(2, 4) + '/' + clean.substring(4);
            } else if (clean.length > 2) {
                finalVal = clean.substring(0, 2) + '/' + clean.substring(2);
            }
            
            this.value = finalVal;
            this.lastLen = finalVal.length; // Cập nhật độ dài sau khi format
            calculateAge(finalVal);
        });
    }

    function calculateAge(dobStr) {
        const displayEl = document.getElementById('calculated-age-display');
        if (!displayEl) return;

        if (!dobStr || dobStr.length < 10) {
            displayEl.innerHTML = '';
            return;
        }

        const parts = dobStr.split('/');
        if (parts.length !== 3) {
            displayEl.innerHTML = '';
            return;
        }

        const day = parseInt(parts[0]);
        const month = parseInt(parts[1]);
        const year = parseInt(parts[2]);

        if (!day || !month || !year || year < 2000 || year > new Date().getFullYear()) {
            displayEl.innerHTML = '';
            return;
        }

        // Kiểm tra tính logic của ngày
        const birthDate = new Date(year, month - 1, day);
        if (birthDate.getFullYear() !== year || birthDate.getMonth() !== month - 1 || birthDate.getDate() !== day) {
            displayEl.innerHTML = '(Không hợp lệ)';
            return;
        }

        const today = new Date();
        let diff = today.getTime() - birthDate.getTime();
        if (diff < 0) {
            displayEl.innerHTML = '(Không hợp lệ)';
            return;
        }

        let years = today.getFullYear() - birthDate.getFullYear();
        let months = today.getMonth() - birthDate.getMonth();
        
        if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
            years--;
            months += 12;
        }
        if (today.getDate() < birthDate.getDate()) {
            months--;
        }

        let text = '';
        if (years > 0) {
            text += `(${years}t`;
            if (months > 0) text += ` ${months}th`;
            text += ')';
        } else if (months > 0) {
            text += `(${months}th)`;
        } else {
            text += '(Mới sinh)';
        }

        displayEl.innerHTML = text;
    }

    // AUTOFILL THEO SỐ ĐIỆN THOẠI
    phoneInput.addEventListener('blur', function() {
        const phone = this.value.trim();
        if (phone.length < 9) return;

        const formData = new FormData();
        formData.append('action', 'hieucon_sub_autofill_by_phone');
        formData.append('phone', phone);

        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data) {
                const data = res.data;
                
                // Điền thông tin phụ huynh
                if (data.parent_name) document.getElementById('parent-name').value = data.parent_name;
                if (data.parent_email) document.getElementById('parent-email').value = data.parent_email;
                
                // Điền thông tin bé
                if (data.child_name) document.getElementById('child-name').value = data.child_name;
                if (data.child_diagnosis) document.getElementById('child-diagnosis').value = data.child_diagnosis;
                
                // Điền ngày sinh
                if (data.child_age) {
                    if (dobInput) {
                        dobInput.value = data.child_age;
                        calculateAge(data.child_age);
                    }
                }
                
                if (data.child_gender) {
                    if (data.child_gender === 'Bé Trai' || data.child_gender === 'Bé trai') {
                        document.getElementById('gender-boy').checked = true;
                    } else if (data.child_gender === 'Bé Gái' || data.child_gender === 'Bé gái') {
                        document.getElementById('gender-girl').checked = true;
                    }
                }

                // Hiển thị alert thông báo autofill thành công
                autofillAlert.classList.remove('hidden');
                setTimeout(() => {
                    autofillAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        })
        .catch(err => {
            console.error('Autofill lookup error:', err);
        });
    });

    // Submit form handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const childName = document.getElementById('child-name').value.trim();
        const childGender = document.querySelector('input[name="child_gender"]:checked')?.value || '';
        
        const dobVal = dobInput ? dobInput.value.trim() : '';
        const dobParts = dobVal.split('/');
        const dobDay = dobParts[0] || '';
        const dobMonth = dobParts[1] || '';
        const dobYear = dobParts[2] || '';

        const childDiagnosis = document.getElementById('child-diagnosis').value.trim();
        
        const parentName = document.getElementById('parent-name').value.trim();
        const parentPhone = phoneInput.value.trim();
        const parentEmail = document.getElementById('parent-email').value.trim();
        const parentConcern = '';
        const extraSymptoms = '';

        if (!childName || !childGender || !dobDay || !dobMonth || !dobYear || !parentName || !parentPhone || !parentEmail) {
            alert('Vui lòng nhập đầy đủ các thông tin bắt buộc có dấu (*).');
            return;
        }

        // Validate ngày tháng năm sinh cơ bản
        const d = parseInt(dobDay);
        const m = parseInt(dobMonth);
        const y = parseInt(dobYear);
        if (isNaN(d) || d < 1 || d > 31 || isNaN(m) || m < 1 || m > 12 || isNaN(y) || y < 2000 || y > new Date().getFullYear()) {
            alert('Ngày sinh không hợp lệ. Vui lòng nhập đúng định dạng ngày sinh của con.');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerText = 'ĐANG GỬI DỮ LIỆU...';

        // Ghép chuỗi ngày sinh dạng dd/mm/yyyy
        const formattedDob = `${dobDay.padStart(2, '0')}/${dobMonth.padStart(2, '0')}/${dobYear}`;

        // 1. Tính toán điểm số (tỉ lệ tick chọn trong mỗi nhóm)
        const scores = [];
        const behaviorsByGroup = {};

        groupsConfig.forEach(group => {
            const grpId = group.id;
            const chkboxes = document.querySelectorAll(`input[data-group="${grpId}"]`);
            const totalQ = chkboxes.length;
            
            let tickedCount = 0;
            const tickedItems = [];

            chkboxes.forEach(chk => {
                if (chk.checked) {
                    tickedCount++;
                    tickedItems.push(chk.dataset.val);
                }
            });

            const pct = totalQ > 0 ? Math.round((tickedCount / totalQ) * 100) : 0;
            
            scores.push({
                id: grpId,
                name: group.name,
                icon: group.icon || '📝',
                tickedCount: tickedCount,
                maxCount: totalQ,
                pct: pct,
                tickedItems: tickedItems
            });

            if (tickedItems.length > 0) {
                behaviorsByGroup[grpId] = tickedItems;
            }
        });

        // Đóng gói data
        const timeSpent = Math.floor((Date.now() - startTime) / 1000);
        deepTracker.drop_point = 'Hoàn thành 100%';
        deepTracker.activeTime = timeSpent;

        const formData = new FormData();
        formData.append('action', 'hieucon_sub_submit_checklist');
        formData.append('checklist_id', checklistId);
        formData.append('user_code', userCode);
        formData.append('child_name', childName);
        formData.append('child_gender', childGender);
        formData.append('child_age', formattedDob);
        formData.append('child_diagnosis', childDiagnosis);
        
        formData.append('parent_name', parentName);
        formData.append('parent_phone', parentPhone);
        formData.append('parent_email', parentEmail);
        formData.append('parent_concern', parentConcern);
        formData.append('extra_symptoms', extraSymptoms);
        
        formData.append('scores_json', JSON.stringify(scores));
        formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
        formData.append('time_spent', timeSpent);
        formData.append('device_info', navigator.userAgent);
        formData.append('deep_analytics', JSON.stringify(deepTracker));

        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            console.log('Submission response:', res);
            if (res.success) {
                const authHash = CryptoJS_md5(userCode);
                const resultsUrl = `/ket-qua-nhan-dien?code=${userCode}&checklist_id=${checklistId}&auth=${authHash}`;
                
                if (typeof fbq !== 'undefined') {
                    fbq('track', 'Lead', { content_name: 'Sub Checklist Submission' });
                }
                
                // Chuyển hướng trực tiếp đến trang kết quả
                window.location.href = resultsUrl;
            } else {
                alert('Có lỗi xảy ra khi nộp dữ liệu. Vui lòng thử lại.');
                submitBtn.disabled = false;
                submitBtn.innerText = 'Hoàn thành & nhận kết quả phân tích';
            }
        })
        .catch(err => {
            console.error('Error submitting form:', err);
            alert('Không thể kết nối máy chủ. Vui lòng kiểm tra lại mạng.');
            submitBtn.disabled = false;
            submitBtn.innerText = 'Hoàn thành & nhận kết quả phân tích';
        });
    });

    // Helper tạo MD5 hash sử dụng thư viện CryptoJS chuẩn từ CDN
    function CryptoJS_md5(string) {
        const secretSalt = 'hieucon_secret_salt';
        return CryptoJS.MD5(string + secretSalt).toString();
    }
});
</script>

<?php get_footer(); ?>
