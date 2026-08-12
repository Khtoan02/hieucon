<?php
/**
 * Template Name: Single Sub-Checklist
 * Post Type: hieucon_sub_chk
 */
define('IS_SUB_CHECKLIST', true);
get_header();

$checklist_id = get_the_ID();
$checklist_title = trim(wp_strip_all_tags(get_the_title($checklist_id)));
$checklist_title_sentence = function_exists('mb_convert_case')
    ? mb_convert_case($checklist_title, MB_CASE_LOWER, 'UTF-8')
    : strtolower($checklist_title);
$first_character = function_exists('mb_substr') ? mb_substr($checklist_title_sentence, 0, 1, 'UTF-8') : substr($checklist_title_sentence, 0, 1);
$remaining_title = function_exists('mb_substr') ? mb_substr($checklist_title_sentence, 1, null, 'UTF-8') : substr($checklist_title_sentence, 1);
$first_character = function_exists('mb_strtoupper') ? mb_strtoupper($first_character, 'UTF-8') : strtoupper($first_character);
$checklist_title_sentence = $first_character . $remaining_title;
$edu_title_template = get_post_meta($checklist_id, '_hieucon_sub_edu_title', true);
$legacy_edu_title = '🧭 Tiêu hóa chỉ là một mảnh ghép trong bức tranh sức khỏe của con';
if (empty($edu_title_template) || $edu_title_template === $legacy_edu_title) {
    $edu_title_template = '[Title] chỉ là một mảnh ghép trong bức tranh sức khỏe của con';
}
$edu_title = str_ireplace('[Title]', $checklist_title_sentence, $edu_title_template);
$edu_content = get_post_meta($checklist_id, '_hieucon_sub_edu_content', true) ?: "Các vấn đề tiêu hóa, giấc ngủ, hành vi, dinh dưỡng và miễn dịch thường liên kết chặt chẽ với nhau qua trục Não – Ruột và các cơ chế sinh học chung.\nĐể hiểu được bức tranh sức khỏe đó của con, ba mẹ có thể tham khảo:";
$references = get_post_meta($checklist_id, '_hieucon_sub_references', true);
$questions_json = get_post_meta($checklist_id, '_hieucon_sub_checklist_questions', true);
if (empty($questions_json)) {
    $questions_json = '[]';
}
$groups = json_decode($questions_json, true) ?: [];

function hieucon_render_sub_checklist_explanation($text)
{
    if (empty($text))
        return '';

    // Split by lines to detect emojis
    $lines = explode("\n", $text);
    $output = '<div class="space-y-3 mt-2">';

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line))
            continue;

        // Check for 💟
        if (mb_strpos($line, '💟') !== false) {
            $content = trim(str_replace('💟', '', $line));
            $output .= '
            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-purple-50/40 text-slate-700 border border-solid border-purple-100/80 text-xs sm:text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <div class="leading-relaxed">' . esc_html($content) . '</div>
            </div>';
        }
        // Check for 🎯
        elseif (mb_strpos($line, '🎯') !== false) {
            $content = trim(str_replace('🎯', '', $line));
            $output .= '
            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-indigo-50/40 text-slate-700 border border-solid border-indigo-100/80 text-xs sm:text-sm">
                <svg xmlns="http://www/w3.org/2000/svg" class="w-5 h-5 text-indigo-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <circle cx="12" cy="12" r="6" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
                <div class="leading-relaxed">' . esc_html($content) . '</div>
            </div>';
        }
        // Check for 📋
        elseif (mb_strpos($line, '📋') !== false) {
            $content = trim(str_replace('📋', '', $line));
            $output .= '
            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-emerald-50/40 text-slate-700 border border-solid border-emerald-100/80 text-xs sm:text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <div class="leading-relaxed">' . esc_html($content) . '</div>
            </div>';
        }
        // Check for ⚠️
        elseif (mb_strpos($line, '⚠️') !== false) {
            $content = trim(str_replace('⚠️', '', $line));
            $output .= '
            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-rose-50/40 text-slate-700 border border-solid border-rose-100/80 text-xs sm:text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="leading-relaxed font-semibold">' . esc_html($content) . '</div>
            </div>';
        } else {
            // General text line
            $output .= '<div class="text-slate-600 text-xs sm:text-sm leading-relaxed px-1">' . esc_html($line) . '</div>';
        }
    }

    $output .= '</div>';
    return $output;
}

function hieucon_render_sub_checklist_explanation_v2($item)
{
    if (empty($item))
        return '';

    // Check if we have any of the new fields filled
    $has_new_fields = !empty($item['exp']) || !empty($item['mechanism']) || !empty($item['guide']) || !empty($item['warning']);

    if (!$has_new_fields) {
        // Fallback to legacy parser if only example exists
        if (!empty($item['example'])) {
            return hieucon_render_sub_checklist_explanation($item['example']);
        }
        return '';
    }

    $output = '<div class="space-y-3 mt-1">';

    // 💟 Giải thích
    if (!empty($item['exp'])) {
        $output .= '
        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-purple-50/40 text-slate-700 border border-solid border-purple-100/80 text-xs sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <div class="leading-relaxed">' . esc_html($item['exp']) . '</div>
        </div>';
    }

    // 🎯 Thông tin chuyên môn / Cơ chế
    if (!empty($item['mechanism'])) {
        $output .= '
        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-indigo-50/40 text-slate-700 border border-solid border-indigo-100/80 text-xs sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <circle cx="12" cy="12" r="6" />
                <circle cx="12" cy="12" r="2" />
            </svg>
            <div class="leading-relaxed">' . esc_html($item['mechanism']) . '</div>
        </div>';
    }

    // 📋 Hướng dẫn thực hành
    if (!empty($item['guide'])) {
        $output .= '
        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-emerald-50/40 text-slate-700 border border-solid border-emerald-100/80 text-xs sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <div class="leading-relaxed">' . esc_html($item['guide']) . '</div>
        </div>';
    }

    // ⚠️ Cảnh báo y khoa
    if (!empty($item['warning'])) {
        $output .= '
        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-rose-50/40 text-slate-700 border border-solid border-rose-100/80 text-xs sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-500 shrink-0 mt-[3px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="leading-relaxed font-semibold">' . esc_html($item['warning']) . '</div>
        </div>';
    }

    $output .= '</div>';
    return $output;
}
?>

<!-- Google Fonts & Tailwind -->
<link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap"
    rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


<style>
    .sub-chk-body {
        background-color: #FAF9F6;
        font-family: 'Quicksand', sans-serif;
        color: #3D3D3D;
    }

    .font-oswald {
        font-family: 'Oswald', sans-serif;
    }

    .has-pattern-bg {
        position: relative;
        background: linear-gradient(135deg, #002795 0%, #001a66 100%);
        overflow: hidden;
        z-index: 1;
    }

    .has-pattern-bg p {
        text-align: center !important;
    }

    .has-pattern-bg::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
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

    input[type="checkbox"]:checked+.custom-chk-box {
        background-color: #10B981;
        border-color: #10B981;
    }

    input[type="checkbox"]:checked+.custom-chk-box svg {
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

    .sub-chk-result-panel {
        border: 1px solid #a7f3d0;
        border-left: 5px solid #059669;
        background: #f0fdf4;
        box-shadow: 0 14px 32px rgba(5, 150, 105, 0.08);
    }

    .sub-chk-result-count {
        min-width: 34px;
        height: 34px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #047857;
        color: #fff;
        font-family: 'Oswald', sans-serif;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .sub-chk-overview-panel {
        position: relative;
        border: 1px solid #c7d2fe;
        border-top: 6px solid #002795;
        background: #f8faff;
        box-shadow: 0 18px 42px rgba(0, 39, 149, 0.10);
        overflow: hidden;
    }

    .sub-chk-overview-panel::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -80px;
        top: -90px;
        border: 28px solid rgba(0, 39, 149, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .sub-chk-section-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 42px 0 22px;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .sub-chk-section-divider::before,
    .sub-chk-section-divider::after {
        content: "";
        height: 1px;
        background: #dbe3f0;
        flex: 1;
    }

    .sub-chk-cta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .sub-chk-cta-copy {
        min-width: 0;
        flex: 1 1 auto;
    }

    .sub-chk-cta-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: auto;
        max-width: 100%;
        min-height: 44px;
        padding: 11px 18px;
        border-radius: 12px;
        flex: 0 0 auto;
        white-space: nowrap;
        line-height: 1.35;
        text-align: center;
        text-decoration: none;
    }

    .sub-chk-cta-button svg,
    .sub-chk-header-icon svg {
        display: block;
        width: 20px !important;
        height: 20px !important;
        min-width: 20px;
        max-width: 20px;
        flex: 0 0 20px;
    }

    @media (max-width: 639px) {
        .sub-chk-cta-row {
            align-items: stretch;
            flex-direction: column;
        }

        .sub-chk-cta-button {
            width: 100%;
            white-space: normal;
        }
    }
</style>

<div class="sub-chk-body py-12 px-4 md:px-6">
    <div class="mx-auto" style="max-width: 60rem; width: 100%;">
        <!-- FORM CONTAINER -->
        <form id="hieucon-sub-checklist-form"
            class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            <!-- BANNER TIÊU ĐỀ -->
            <div class="has-pattern-bg p-8 md:p-10 text-white text-center">
                <span
                    class="inline-block bg-yellow/20 text-yellow font-bold text-xs px-3.5 py-1.5 rounded-full border border-solid border-yellow/30 uppercase tracking-wider mb-4"
                    style="color:#FFD154;">Hiểu Con Từ Gốc</span>
                <h1
                    class="font-oswald text-2xl md:text-3.5xl font-bold uppercase tracking-wide text-white leading-tight mb-3">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>
                <div
                    class="text-sm md:text-base text-slate-100 opacity-95 font-light max-w-4xl mx-auto leading-relaxed text-center space-y-3.5">
                    <?php
                    $content = get_the_content();
                    if ($content) {
                        echo wpautop($content);
                    } else {
                        echo '<p class="text-center">Vui lòng tích chọn các thông tin và biểu hiện của con phía dưới để nhận giải thích y sinh học tương ứng.</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- NỘI DUNG NHẬP LIỆU -->
            <div class="p-6 md:p-8 space-y-10">

                <!-- KHẢO SÁT CÁC NHÓM BIỂU HIỆN -->
                <div>
                    <h3 class="font-oswald text-lg font-bold text-navy border-b border-solid border-slate-100 pb-2 mb-6 flex items-center gap-2"
                        style="color:#002795;">
                        <svg class="w-5 h-5 text-blue-600 inline-block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Đánh giá dấu hiệu hành vi
                    </h3>

                    <?php if (empty($groups)): ?>
                        <p class="text-sm italic text-slate-400">Bộ checklist con này chưa được cấu hình câu hỏi trong
                            Admin.</p>
                    <?php else: ?>
                        <div class="space-y-8">
                            <?php foreach ($groups as $gIdx => $group):
                                $group_id = sanitize_title($group['id']);
                                $items = $group['items'] ?? [];
                                ?>
                                <div class="space-y-4">

                                    <div class="space-y-3 bg-white rounded-xl overflow-hidden">
                                        <?php foreach ($items as $iIdx => $item):
                                            $unique_id = "chk-{$group_id}-{$iIdx}";
                                            ?>
                                            <div
                                                class="checklist-item-wrapper border border-solid border-slate-100 rounded-xl bg-white overflow-hidden transition-all duration-300 hover:shadow-md">
                                                <!-- Checkbox Row -->
                                                <label
                                                    class="custom-chk-row flex items-start gap-4 p-4 select-none cursor-pointer m-0 hover:bg-slate-50 transition-colors"
                                                    for="<?php echo $unique_id; ?>">
                                                    <input type="checkbox" id="<?php echo $unique_id; ?>"
                                                        data-group="<?php echo esc_attr($group_id); ?>"
                                                        data-val="<?php echo esc_attr($item['main']); ?>"
                                                        class="sub-chk-trigger hidden">
                                                    <div class="custom-chk-box mt-0.5">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </div>
                                                    <div class="text-sm md:text-base text-slate-700 font-semibold leading-relaxed">
                                                        <?php echo esc_html($item['main']); ?>
                                                    </div>
                                                </label>

                                                <!-- Explanation Box (Only shown when checked) -->
                                                <?php
                                                $has_explanation = !empty($item['example']) || !empty($item['exp']) || !empty($item['mechanism']) || !empty($item['guide']) || !empty($item['warning']);
                                                if ($has_explanation):
                                                    ?>
                                                    <div id="exp-<?php echo $unique_id; ?>"
                                                        class="explanation-box border-t border-dashed border-slate-100 bg-slate-50 p-5 text-sm text-slate-600 leading-relaxed hidden transition-all duration-300">
                                                        <?php echo hieucon_render_sub_checklist_explanation_v2($item); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- DYNAMIC SELECTED SIGNS RESULT -->
                <div id="parent-observation-result"
                    class="sub-chk-result-panel hidden rounded-2xl p-6 md:p-8 text-left transition-all my-6">
                    <div class="flex items-start gap-4 mb-5">
                        <span id="selected-questions-count" class="sub-chk-result-count">0</span>
                        <div>
                            <h3 class="font-bold text-lg md:text-xl text-slate-900"
                                style="margin:0; font-family:'Oswald', sans-serif;">
                                Kết quả quan sát của ba mẹ
                            </h3>
                        </div>
                    </div>
                    <p class="text-sm md:text-[15px] leading-relaxed text-slate-700 font-medium mb-4">
                        Theo quan sát của ba mẹ hiện nay, con đang gặp các vấn đề sau:
                    </p>
                    <ul id="selected-questions-list"
                        class="space-y-2 text-sm md:text-[15px] text-slate-800 font-semibold mb-5 leading-relaxed">
                        <!-- Dynamically filled via JS -->
                    </ul>
                    <div class="sub-chk-cta-row pt-5 border-t border-solid border-emerald-200/80 text-sm md:text-[15px] text-slate-700">
                        <span class="sub-chk-cta-copy font-semibold">Nếu ba mẹ cần hỗ trợ tư vấn các vấn đề trên, hãy liên hệ với chúng tôi:</span>
                        <a href="https://zalo.me/0985391881" target="_blank" rel="noopener noreferrer"
                            class="sub-chk-cta-button bg-[#0068ff] hover:bg-[#0056d6] text-white font-bold shadow-md shadow-blue-100 transition-all text-sm cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span>Tư vấn qua Zalo: 0985391881</span>
                        </a>
                    </div>

                    <!-- Disclaimer Row (Soft text only, no red box) -->
                    <div
                        class="mt-4 pt-4 border-t border-dashed border-emerald-200/80 text-xs text-slate-500 leading-relaxed font-medium">
                        <span class="font-bold text-slate-700">Lưu ý:</span> Kết quả này dựa trên quan sát của ba mẹ, không thay thế cho chẩn đoán y khoa. Mọi quyết định can thiệp cần có sự thăm khám và tư vấn từ bác sĩ phù hợp với thể trạng riêng của từng trẻ.
                    </div>
                </div>

            </div> <!-- Đóng khối nội dung nhập liệu -->
        </form>

                <!-- NAVIGATION TO MAIN CHECKLIST -->
                <div class="sub-chk-section-divider"><span>Bức tranh toàn diện</span></div>
                <div class="sub-chk-overview-panel rounded-2xl p-6 md:p-8 text-left transition-all mb-8">
                    <!-- Header -->
                    <div class="relative z-10 flex items-start gap-4 mb-5">
                        <span
                            class="sub-chk-header-icon inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-800 shrink-0"
                            aria-hidden="true">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-xl md:text-2xl leading-tight"
                                style="color:#102a67; margin:0; font-family:'Oswald', sans-serif;">
                                <?php echo esc_html($edu_title); ?>
                            </h3>
                        </div>
                    </div>

                    <!-- Content -->
                    <div
                        class="relative z-10 text-sm md:text-[15px] leading-relaxed text-indigo-950 font-medium space-y-4">
                        <div class="font-semibold text-slate-700">
                            <?php echo wpautop(esc_html($edu_content)); ?>
                        </div>

                        <div class="bg-white/80 border border-solid border-indigo-100/50 rounded-2xl p-4 sm:p-5">
                            <p class="text-xs sm:text-sm text-slate-500 font-bold mb-3 uppercase tracking-wide">
                                Bộ công cụ giúp ba mẹ quan sát nhanh 8 nhóm dấu hiệu thường gặp ở trẻ tự kỷ:
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-sm text-slate-700 font-semibold">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 1. Rối loạn tiêu hóa
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 2. Rối loạn ăn uống
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 3. Rối loạn giấc ngủ
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 4. Xử lý giác quan
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 5. Tăng động - Giảm chú ý
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 6. Cảm xúc - Hành vi
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 7. Miễn dịch - Dị ứng
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 8. Chức năng vận động
                                </div>
                            </div>
                        </div>

                        <p class="text-slate-600">
                            Từ đó biết nhóm nào cần theo dõi, tìm kiếm hỗ trợ chuyên môn trước, giúp cha mẹ có một bức
                            tranh toàn diện hơn về con, thay vì chỉ nhìn từng vấn đề riêng lẻ.
                        </p>

                        <div class="sub-chk-cta-row mt-8 pt-6 border-t border-dashed border-indigo-100">
                            <span class="sub-chk-cta-copy text-slate-700 font-bold">Để đánh giá toàn diện bức tranh sức khỏe của con, ba mẹ có thể thực hiện tại đây:</span>
                            <a href="/check-list"
                                class="sub-chk-cta-button bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-md shadow-indigo-200/80 transition-all text-sm md:text-base cursor-pointer">
                                <span>Thực hiện Bộ công cụ nhận diện</span>
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 📚 TÀI LIỆU THAM KHẢO (NỀN TRƠN, KHÔNG CARD) -->
                <?php if (!empty($references)): ?>
                    <div class="my-8 text-left border-t border-solid border-slate-100 pt-6">
                        <h3 class="font-bold text-sm md:text-base mb-3 flex items-center gap-3 uppercase tracking-wider text-slate-700"
                            style="margin-top:0; font-family:'Oswald', sans-serif;">
                            📚 Tài liệu tham khảo
                        </h3>
                        <div
                            class="text-xs sm:text-sm leading-relaxed text-slate-500 font-medium space-y-2 whitespace-pre-line">
                            <?php echo nl2br(esc_html($references)); ?>
                        </div>
                    </div>
                <?php endif; ?>
    </div>
</div>

<!-- LOGIC XỬ LÝ DYNAMIC TOGGLE EXPLANATIONS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const listContainer = document.getElementById('selected-questions-list');
        const resultContainer = document.getElementById('parent-observation-result');
        const countContainer = document.getElementById('selected-questions-count');

        function updateParentObservationResult() {
            if (!resultContainer || !listContainer) return;

            const checkedBoxes = document.querySelectorAll('.sub-chk-trigger:checked');
            if (countContainer) {
                countContainer.textContent = checkedBoxes.length;
            }
            if (checkedBoxes.length > 0) {
                listContainer.innerHTML = '';
                checkedBoxes.forEach(chk => {
                    const questionText = (chk.getAttribute('data-val') || '').replace(/[?？]+\s*$/u, '').trim();
                    const li = document.createElement('li');
                    li.className = 'flex items-start gap-3 rounded-xl border border-emerald-100 bg-white/80 px-4 py-3';
                    const marker = document.createElement('span');
                    marker.className = 'mt-1.5 w-2 h-2 rounded-full bg-emerald-500 shrink-0';
                    marker.setAttribute('aria-hidden', 'true');
                    const text = document.createElement('span');
                    text.textContent = questionText;
                    li.appendChild(marker);
                    li.appendChild(text);
                    listContainer.appendChild(li);
                });
                resultContainer.classList.remove('hidden');
            } else {
                resultContainer.classList.add('hidden');
                listContainer.innerHTML = '';
            }
        }

        // Checkbox Toggles & Explanations handler
        document.querySelectorAll('.sub-chk-trigger').forEach(chk => {
            chk.addEventListener('change', function () {
                const wrapper = this.closest('.checklist-item-wrapper');
                if (!wrapper) return;

                const expBox = wrapper.querySelector('.explanation-box');
                const chkBox = wrapper.querySelector('.custom-chk-box');

                if (this.checked) {
                    // Highlight item active state
                    wrapper.classList.remove('border-slate-100');
                    wrapper.classList.add('border-emerald-200', 'bg-emerald-50/10', 'shadow-sm');
                    if (chkBox) {
                        chkBox.classList.add('bg-emerald-500', 'border-emerald-500');
                    }

                    // Show explanation
                    if (expBox) {
                        expBox.classList.remove('hidden');
                    }
                } else {
                    // Remove highlight
                    wrapper.classList.remove('border-emerald-200', 'bg-emerald-50/10', 'shadow-sm');
                    wrapper.classList.add('border-slate-100');
                    if (chkBox) {
                        chkBox.classList.remove('bg-emerald-500', 'border-emerald-500');
                    }

                    // Hide explanation
                    if (expBox) {
                        expBox.classList.add('hidden');
                    }
                }

                // Update parent observation results list
                updateParentObservationResult();
            });
        });

        // Run initial update in case some checkboxes are pre-checked
        updateParentObservationResult();
    });
</script>
<?php get_footer(); ?>
