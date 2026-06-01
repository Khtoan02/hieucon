<?php
/**
 * Single Template: Ebook (ebook)
 *
 * @package Hieucon
 */

get_header();

$current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$is_owned       = false;

// Fetch Ebook custom metadata
$price      = get_post_meta( get_the_ID(), '_ebook_price', true );
$pdf_url    = get_post_meta( get_the_ID(), '_ebook_pdf_url', true );
$ebook_pages = get_post_meta( get_the_ID(), '_ebook_pages', true );
$sample_url = get_post_meta( get_the_ID(), '_ebook_sample_url', true );

// Set default values if not defined
$price = ! empty( $price ) ? floatval( $price ) : 0;
$ebook_pages = ! empty( $ebook_pages ) ? intval( $ebook_pages ) : 0;

// Check membership status and ebook ownership
if ( $current_member ) {
    $member_id = intval( $current_member->id );
    if ( $current_member->role === 'administrator' || $current_member->role === 'teacher' || $current_member->role === 'expert' ) {
        $is_owned = true;
    } else {
        $enrolled = hieucon_get_member_enrolled_ebooks( $member_id );
        if ( is_array( $enrolled ) && in_array( get_the_ID(), $enrolled ) ) {
            $is_owned = true;
        }
    }
}

// Free Ebook (price is 0) grants access to everyone
if ( $price == 0 ) {
    $is_owned = true;
}

// Fetch categories
$categories = get_the_terms( get_the_ID(), 'ebook_cat' );
$cat_names  = [];
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
    foreach ( $categories as $cat ) {
        $cat_names[] = $cat->name;
    }
}
$category_label = ! empty( $cat_names ) ? implode( ', ', $cat_names ) : 'Chưa phân loại';

// Unique Purchase URL construction
$purchase_url = '';
if ( ! $current_member ) {
    $purchase_url = add_query_arg( 'redirect_to', urlencode( home_url( '/thanh-toan/?ebook_id=' . get_the_ID() ) ), home_url( '/dang-nhap/' ) );
} else {
    $purchase_url = home_url( '/thanh-toan/?ebook_id=' . get_the_ID() );
}
?>

<main id="primary" class="site-main min-h-screen py-10 md:py-16 bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/20">
    <!-- Premium CSS Mockup Styles -->
    <style>
        .book-container {
            perspective: 1200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .book-mockup {
            position: relative;
            width: 230px;
            height: 320px;
            transform-style: preserve-3d;
            transform: rotateY(-20deg) rotateX(5deg);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s;
            box-shadow: 5px 5px 20px rgba(15, 23, 42, 0.08), 15px 20px 35px rgba(15, 23, 42, 0.12);
            border-radius: 3px 12px 12px 3px;
        }
        .book-mockup:hover {
            transform: rotateY(-5deg) rotateX(2deg) scale(1.03);
            box-shadow: 8px 8px 25px rgba(15, 23, 42, 0.12), 25px 30px 45px rgba(15, 23, 42, 0.2);
        }
        .book-spine {
            position: absolute;
            width: 24px;
            height: 100%;
            left: -12px;
            top: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.3) 0%, rgba(255,255,255,0.1) 40%, rgba(0,0,0,0.1) 100%), #1e293b;
            transform: rotateY(-90deg);
            transform-origin: right center;
            border-radius: 3px 0 0 3px;
        }
        .book-pages-side {
            position: absolute;
            width: 20px;
            height: 98%;
            right: -10px;
            top: 1%;
            background: linear-gradient(to right, #ffffff 0%, #f1f5f9 60%, #e2e8f0 100%);
            transform: rotateY(90deg);
            transform-origin: left center;
            box-shadow: inset 0px 0px 5px rgba(0,0,0,0.15);
            border-radius: 0 4px 4px 0;
        }
        .glass-blur-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        .liked-heart-glow {
            filter: drop-shadow(0 0 4px rgba(239, 68, 68, 0.5));
        }
        .thread-line::before {
            content: '';
            position: absolute;
            left: -12px;
            top: -10px;
            bottom: 12px;
            width: 2px;
            background: linear-gradient(to bottom, #cbd5e1 0%, #f1f5f9 100%);
            border-radius: 99px;
        }
        .comment-bubble-glass {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(241, 245, 249, 0.8);
            box-shadow: 0 4px 15px -3px rgba(15, 23, 42, 0.02);
        }
        .animate-pulse-slow {
            animation: pulse 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-xs font-bold uppercase tracking-widest mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'ebook' ) ); ?>" class="hover:text-primary text-navy/70 transition-colors flex items-center gap-2 bg-white/70 backdrop-blur-md px-4 py-2 rounded-full border border-white/80 shadow-soft">
                        <i data-lucide="book-open" class="w-4 h-4 text-primary"></i> Tủ sách Ebook
                    </a>
                </li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 mx-1"></i>
                    <span class="bg-white/40 backdrop-blur-md px-4 py-2 rounded-full border border-white/40 text-slate-400 select-none max-w-[200px] md:max-w-xs truncate"><?php the_title(); ?></span>
                </li>
            </ol>
        </nav>

        <!-- Ebook Detail (2 Columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
            
            <!-- LEFT COLUMN: 3D Mockup & Quick Specs (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 flex flex-col items-center">
                    
                    <!-- 3D Book Display -->
                    <div class="book-container py-6 mb-8 select-none">
                        <div class="book-mockup bg-slate-200">
                            <!-- Spine effect -->
                            <div class="book-spine" style="background-color: <?php echo esc_attr( $price == 0 ? '#10b981' : '#0d9488' ); ?>;"></div>
                            
                            <!-- Main Cover Image -->
                            <div class="w-full h-full rounded-r-xl overflow-hidden relative">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', [ 'class' => 'w-full h-full object-cover' ] ); ?>
                                <?php else : ?>
                                    <div class="w-full h-full bg-gradient-to-tr from-teal-500 to-emerald-600 flex flex-col items-center justify-center p-4 text-center text-white">
                                        <i data-lucide="book-open" class="w-12 h-12 mb-2 opacity-80"></i>
                                        <span class="text-xs font-bold font-serif line-clamp-3 leading-snug"><?php the_title(); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Page thickness edge effect -->
                            <div class="book-pages-side"></div>
                        </div>
                    </div>

                    <!-- Price Block -->
                    <div class="text-center w-full pb-6 border-b border-slate-100 mb-6">
                        <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1.5">Giá sở hữu</span>
                        <?php if ( $price == 0 ) : ?>
                            <span class="text-3xl font-extrabold text-emerald-600 bg-emerald-50 px-5 py-2 rounded-2xl border border-emerald-100 inline-block shadow-sm">Miễn phí</span>
                        <?php else : ?>
                            <div class="flex items-baseline justify-center gap-1">
                                <span class="text-3xl font-black text-navy leading-none"><?php echo number_format( $price, 0, ',', '.' ); ?></span>
                                <span class="text-base font-bold text-navy">đ</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Info Grid -->
                    <div class="w-full space-y-3.5 mb-8">
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <span class="text-xs text-slate-455 font-semibold flex items-center gap-2">
                                <i data-lucide="file-text" class="w-4 h-4 text-primary"></i> Số trang
                            </span>
                            <span class="text-xs font-bold text-navy"><?php echo $ebook_pages ? $ebook_pages . ' trang' : 'Đang cập nhật'; ?></span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <span class="text-xs text-slate-455 font-semibold flex items-center gap-2">
                                <i data-lucide="folder" class="w-4 h-4 text-primary"></i> Danh mục
                            </span>
                            <span class="text-xs font-bold text-navy truncate max-w-[150px]" title="<?php echo esc_attr( $category_label ); ?>"><?php echo esc_html( $category_label ); ?></span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <span class="text-xs text-slate-455 font-semibold flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i> Định dạng
                            </span>
                            <span class="text-xs font-bold text-navy">Secure PDF Reader</span>
                        </div>
                    </div>

                    <!-- Primary Sidebar Action Button -->
                    <div class="w-full space-y-3">
                        <?php if ( $is_owned ) : ?>
                            <a href="#ebook-reader-section" class="w-full py-4 bg-emerald-600 hover:bg-emerald-550 text-white rounded-2xl font-bold text-sm shadow-[0_4px_20px_rgba(16,185,129,0.18)] hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer border-0">
                                Đọc Online Ngay <i data-lucide="book-open" class="w-4 h-4 animate-pulse-slow"></i>
                            </a>
                            <?php if ( ! empty( $pdf_url ) ) : ?>
                                <a href="<?php echo esc_url( $pdf_url ); ?>" download class="w-full py-3.5 bg-navy hover:bg-navy/90 text-white rounded-2xl font-bold text-xs shadow-sm hover:scale-[1.01] transform transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer border-0">
                                    Tải PDF Gốc <i data-lucide="download" class="w-4 h-4"></i>
                                </a>
                            <?php endif; ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $purchase_url ); ?>" class="w-full py-4 bg-primary hover:bg-secondary text-white rounded-2xl font-bold text-sm shadow-[0_4px_20px_rgba(13,148,136,0.15)] hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer border-0">
                                Mua Ebook Ngay <i data-lucide="credit-card" class="w-4 h-4"></i>
                            </a>
                            <?php if ( ! empty( $sample_url ) ) : ?>
                                <a href="<?php echo esc_url( $sample_url ); ?>" target="_blank" class="w-full py-3 bg-white hover:bg-slate-50 text-slate-700 rounded-2xl font-bold text-xs border border-slate-200 shadow-sm flex items-center justify-center gap-2 transition-all">
                                    Đọc Thử Sách <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Title, Intro & Editorial (8 cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-10 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 h-full flex flex-col justify-between">
                    <div>
                        <!-- Category Badge -->
                        <div class="mb-4">
                            <span class="px-3.5 py-1.5 rounded-full bg-primary/10 text-primary border border-primary/10 text-[10px] font-bold uppercase tracking-wider">
                                <?php echo esc_html( $category_label ); ?>
                            </span>
                        </div>

                        <!-- Ebook Title -->
                        <h1 class="text-2xl md:text-4xl font-serif font-bold text-navy leading-tight mb-6"><?php the_title(); ?></h1>

                        <!-- Ebook Intro Meta -->
                        <div class="flex flex-wrap gap-y-3 gap-x-6 items-center text-slate-500 text-xs md:text-sm font-semibold mb-8 pb-6 border-b border-slate-100">
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="book-open" class="w-4.5 h-4.5 text-primary"></i>
                                <span>Thể loại: Ebook PDF</span>
                            </div>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="shield-check" class="w-4.5 h-4.5 text-primary"></i>
                                <span>Bảo vệ bản quyền</span>
                            </div>
                            <?php if ( $ebook_pages > 0 ) : ?>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-primary"></i>
                                    <span><?php echo $ebook_pages; ?> trang độc quyền</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Excerpt & Content -->
                        <div class="prose max-w-none text-slate-700 leading-relaxed">
                            <?php if ( has_excerpt() ) : ?>
                                <div class="p-5 bg-orange-50/30 border-l-4 border-primary rounded-r-2xl mb-6 text-sm font-medium text-slate-655 italic">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="text-xl font-serif font-bold text-navy mb-4">Giới thiệu tóm tắt sách</h3>
                            <div class="editorial-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Commercial highlights inside details -->
                    <div class="mt-8 pt-6 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-semibold text-slate-600">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4.5 h-4.5 text-emerald-500 shrink-0"></i>
                            <span>Đọc trực tuyến chất lượng cao không quảng cáo</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4.5 h-4.5 text-emerald-500 shrink-0"></i>
                            <span>Tương thích đa thiết bị (Máy tính, Máy tính bảng, Di động)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4.5 h-4.5 text-emerald-500 shrink-0"></i>
                            <span>Tải bản PDF chất lượng cao không giảm độ nét</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4.5 h-4.5 text-emerald-500 shrink-0"></i>
                            <span>Bảo mật trọn đời gắn liền tài khoản Hieucon</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- FULL WIDTH BLOCK: Embedded Secure PDF Reader / Blur Lock -->
        <div id="ebook-reader-section" class="mb-12 scroll-mt-24">
            <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft overflow-hidden">
                <h3 class="text-xl font-serif font-bold text-navy mb-6 flex items-center gap-2 pb-4 border-b border-slate-100">
                    <i data-lucide="book-open" class="w-5 h-5 text-primary"></i> Trình Đọc Ebook PDF Trực Tuyến Hieucon Premium
                </h3>

                <?php if ( $is_owned ) : ?>
                    <!-- OWNED: Render high quality iframe reader -->
                    <?php if ( ! empty( $pdf_url ) ) : ?>
                        <div class="relative w-full h-[650px] rounded-2xl bg-slate-900 shadow-inner overflow-hidden border border-slate-200">
                            <iframe src="<?php echo esc_url( $pdf_url ); ?>#toolbar=0&navpanes=0&scrollbar=1" class="w-full h-full border-0" allowfullscreen></iframe>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-4 items-center justify-between">
                            <p class="text-xs text-slate-455 font-medium flex items-center gap-1">
                                <i data-lucide="info" class="w-4 h-4 text-primary shrink-0"></i> 
                                Mẹo: Nếu file không tự động tải, hãy bấm nút "Tải PDF Gốc" bên dưới để lưu file ngoại tuyến.
                            </p>
                            <div class="flex items-center gap-2.5">
                                <a href="<?php echo esc_url( $pdf_url ); ?>" download class="px-5 py-2.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-sm hover:scale-[1.01] transform transition-all duration-300 flex items-center gap-1.5 cursor-pointer">
                                    Tải PDF Gốc <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <i data-lucide="info" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
                            <p class="text-slate-500 font-semibold text-sm">File Ebook PDF chưa được quản trị viên thiết lập. Vui lòng quay lại sau!</p>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <!-- NOT OWNED: Show Glassmorphic Locked Screen -->
                    <div class="relative w-full h-[450px] rounded-2xl overflow-hidden border border-slate-100 flex items-center justify-center bg-slate-950">
                        
                        <!-- Background blurred mockup preview pages -->
                        <div class="absolute inset-0 opacity-15 filter blur-md bg-cover bg-center select-none pointer-events-none" style="background-image: url('<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ) : ''; ?>');"></div>
                        
                        <!-- Premium locked glassmorphic prompt -->
                        <div class="relative z-10 max-w-lg w-full mx-4 p-8 rounded-3xl glass-blur-card text-center border border-white shadow-2xl flex flex-col items-center">
                            <div class="w-14 h-14 rounded-full bg-primary/10 text-primary border border-primary/20 flex items-center justify-center mb-4.5 shadow-sm">
                                <i data-lucide="lock" class="w-6 h-6 animate-pulse-slow"></i>
                            </div>
                            <h4 class="text-lg font-black text-navy mb-2">Nội dung Ebook PDF đã khóa bảo mật</h4>
                            <p class="text-xs text-slate-655 leading-relaxed mb-6 font-medium">Bạn chưa đăng ký sở hữu cuốn Ebook này. Hãy mua ngay để mở khóa toàn bộ nội dung PDF trực tuyến cùng file tải gốc bản quyền.</p>
                            
                            <div class="flex flex-col sm:flex-row gap-3 w-full justify-center">
                                <a href="<?php echo esc_url( $purchase_url ); ?>" class="px-6 py-3 bg-primary hover:bg-secondary text-white rounded-xl font-bold text-xs shadow-md hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-1.5 cursor-pointer border-0">
                                    Mua Ebook Ngay <i data-lucide="credit-card" class="w-4 h-4"></i>
                                </a>
                                <?php if ( ! empty( $sample_url ) ) : ?>
                                    <a href="<?php echo esc_url( $sample_url ); ?>" target="_blank" class="px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 rounded-xl font-bold text-xs border border-slate-200 shadow-sm flex items-center justify-center gap-1.5 transition-all">
                                        Đọc Thử PDF <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- DISCUSSION & QA SECTION (Copied & adapted from single-course.php for maximum premium functionality) -->
        <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 animate-fadeIn mt-8">
            <h3 class="text-xl font-serif font-bold text-navy mb-6 flex items-center gap-2">
                <i data-lucide="messages-square" class="w-5 h-5 text-primary"></i> Thảo luận & Hỏi đáp Ebook
            </h3>

            <!-- Comments list mount area -->
            <div class="relative z-10 mb-6">
                <div id="realtime-comments-list" class="space-y-4">
                    <div class="text-center py-10 text-slate-455 text-xs select-none">
                        <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                        Đang tải thảo luận...
                    </div>
                </div>
            </div>

            <!-- Submit form or Guest Notice -->
            <div class="pt-6 border-t border-slate-100 space-y-4">
                <h4 class="text-sm font-bold text-[#0A1931] flex items-center gap-1.5">
                    <i data-lucide="message-square-plus" class="w-4 h-4 text-primary"></i> Gửi thắc mắc / Cảm nhận của bạn
                </h4>
                <?php if ( ! $current_member ) : ?>
                    <div class="p-5 bg-slate-50 border border-slate-150 rounded-2xl text-center select-none shadow-soft">
                        <p class="text-xs text-slate-500 font-semibold mb-3">Vui lòng đăng nhập để gửi thắc mắc hoặc bình luận cảm nhận về cuốn sách này.</p>
                        <a href="<?php echo esc_url( home_url( '/dang-nhap/?redirect_to=' . urlencode( get_permalink() ) ) ); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-navy hover:bg-secondary text-white text-xs font-bold rounded-xl transition-all shadow-md hover:scale-102 transform duration-200">
                            Đăng nhập ngay <i data-lucide="log-in" class="w-4 h-4"></i>
                        </a>
                    </div>
                <?php else : ?>
                    <form id="ajax-comment-form" onsubmit="submitAjaxComment(event)" class="space-y-4">
                        <textarea id="comment-textarea" name="comment" required rows="3" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Hãy để lại ý kiến hoặc thảo luận về nội dung cuốn sách..."></textarea>
                        <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
                        <input type="hidden" name="comment_parent" id="ajax_comment_parent" value="0">
                        <?php wp_nonce_field( 'hieucon_comment_nonce', 'comment_nonce' ); ?>
                        
                        <div class="flex justify-end">
                            <button type="submit" id="submit-comment-btn" class="px-5 py-2.5 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-xl font-bold text-xs shadow-md hover:shadow-lg transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                                Gửi thảo luận <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<!-- LOGIN REQUIRED TOAST (Copied from single-course.php) -->
<div id="login-required-toast" class="fixed bottom-6 left-6 max-w-sm w-full bg-white/95 backdrop-blur-xl border border-slate-100 shadow-[0_20px_40px_rgba(15,23,42,0.15)] rounded-2xl p-4 transition-all duration-500 transform translate-y-12 opacity-0 pointer-events-none z-[999] flex items-start gap-3 select-none">
    <div class="w-8 h-8 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-500 shrink-0 mt-0.5 shadow-sm">
        <i data-lucide="alert-circle" class="w-4 h-4"></i>
    </div>
    <div class="flex-1 min-w-0">
        <div>
            <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Thông báo hệ thống</span>
            <p class="text-[10px] font-bold text-[#0A1931] leading-tight">Vui lòng đăng nhập để tiếp tục thao tác nhé!</p>
        </div>
    </div>
    <div class="flex items-center gap-1 shrink-0">
        <button type="button" onclick="dismissToast()" class="text-slate-400 hover:text-slate-600 transition-colors p-1 bg-transparent border-0 cursor-pointer flex items-center justify-center rounded-lg">
            <i data-lucide="x" class="w-3.5 h-3.5"></i>
        </button>
    </div>
</div>

<!-- DISCUSSION SCRIPTS -->
<script>
    const ajaxUrlLike = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const currentPostId = <?php echo get_the_ID(); ?>;
    const likeNonce = '<?php echo esc_attr( wp_create_nonce("hieucon_comment_nonce") ); ?>';

    let isFetching = false;
    let expandedRepliesCache = []; // Expanded nested replies tracking
    let visibleTopLevelCount = 5;
    let expandedRepliesFullCache = []; // Fully expanded replies tracks
    let lastCommentsHtmlCache = ""; // Polling cache to prevent layout thrashing

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        // Fetch comments on start
        fetchComments(false);

        // Check for error query parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('error') === 'login_required') {
            showLoginRequiredToast();
        }
    });

    function showLoginRequiredToast() {
        const toast = document.getElementById('login-required-toast');
        if (toast) {
            toast.classList.remove('translate-y-12', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            setTimeout(() => {
                dismissToast();
            }, 5000);
        }
    }

    function dismissToast() {
        const toast = document.getElementById('login-required-toast');
        if (toast) {
            toast.classList.add('translate-y-12', 'opacity-0', 'pointer-events-none');
            toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            
            // Clean up URL parameter cleanly without reloading the page
            const url = new URL(window.location);
            url.searchParams.delete('error');
            window.history.replaceState({}, document.title, url.toString());
        }
    }

    // --- STATE CACHING FOR STAMINA AND CURSOR POSITION PRESERVATION ---
    function cacheActiveReplyStates() {
        const list = document.getElementById('realtime-comments-list');
        if (!list) return {};
        const state = {};
        list.querySelectorAll('.replies-container textarea').forEach(txt => {
            const id = txt.id.replace('reply-textarea-', '');
            state[id] = { val: txt.value, isFocused: (document.activeElement === txt) };
        });
        return state;
    }

    function cacheExpandedReplies() {
        return [...expandedRepliesCache];
    }

    function restoreExpandedReplies(expanded) {
        expanded.forEach(commentId => {
            const container = document.getElementById(`replies-container-${commentId}`);
            const toggleWrap = document.getElementById(`reply-toggle-wrap-${commentId}`);
            if (container && toggleWrap) {
                container.classList.remove('hidden');
                toggleWrap.innerHTML = `
                    <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-slate-500 hover:text-slate-450 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                        <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-455"></i> Ẩn phản hồi
                    </button>
                `;
            }
        });
        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    function restoreReplyStates(states, activeElementId, selectionStart, selectionEnd) {
        Object.keys(states).forEach(commentId => {
            showReplyForm(commentId, true);
            const txt = document.getElementById(`reply-textarea-${commentId}`);
            if (txt) {
                txt.value = states[commentId].val;
                if (states[commentId].isFocused) {
                    txt.focus();
                }
            }
        });

        if (activeElementId) {
            const activeEl = document.getElementById(activeElementId);
            if (activeEl) {
                activeEl.focus();
                if (selectionStart !== null && selectionEnd !== null) {
                    activeEl.setSelectionRange(selectionStart, selectionEnd);
                }
            }
        }
    }

    // --- MAIN FETCH COMMENTS ACTION ---
    async function fetchComments(silent = false, force = false) {
        if (isFetching && !force) return;
        isFetching = true;

        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) {
            isFetching = false;
            return;
        }

        const activeStates = cacheActiveReplyStates();
        const expandedReplies = cacheExpandedReplies();
        
        const activeElement = document.activeElement;
        const activeElementId = activeElement ? activeElement.id : null;
        let selectionStart = null;
        let selectionEnd = null;

        if (activeElement && (activeElement.tagName === 'TEXTAREA' || activeElement.tagName === 'INPUT')) {
            selectionStart = activeElement.selectionStart;
            selectionEnd = activeElement.selectionEnd;
        }

        if (!silent && !listContainer.querySelector('.comment-node')) {
            listContainer.innerHTML = `
                <div class="text-center py-10 text-slate-455 text-xs select-none">
                    <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                    Đang tải thảo luận...
                </div>
            `;
        }

        try {
            const url = `${ajaxUrlLike}?action=hieucon_fetch_comments&post_id=${currentPostId}&t=${Date.now()}`;
            const res = await fetch(url);
            const data = await res.json();

            if (data.success) {
                if (lastCommentsHtmlCache === data.data.html) {
                    isFetching = false;
                    return;
                }
                lastCommentsHtmlCache = data.data.html;
                listContainer.innerHTML = data.data.html;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }

                restoreExpandedReplies(expandedReplies);
                applyTopLevelPagination();
                applyNestedRepliesPagination();
                restoreReplyStates(activeStates, activeElementId, selectionStart, selectionEnd);
            }
        } catch (err) {
            console.error('Lỗi khi tải thảo luận:', err);
        } finally {
            isFetching = false;
        }
    }

    function showReplyForm(commentId, forceOpen = false) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (!wrap) return;

        if (!forceOpen && !wrap.classList.contains('hidden')) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
            return;
        }

        wrap.innerHTML = `
            <form onsubmit="submitAjaxComment(event, ${commentId})" class="mt-2 space-y-2 solid-panel p-3.5 rounded-2xl shadow-soft animate-fadeIn bg-white border border-[#FFD6C0]/35 select-none text-left">
                <textarea id="reply-textarea-${commentId}" required rows="2" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Viết phản hồi của bạn..."></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cancelReplyForm(${commentId})" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-655 rounded-lg font-bold text-[10px] transition-colors border border-slate-200/80 cursor-pointer">Hủy</button>
                    <button type="submit" id="submit-reply-${commentId}-btn" class="px-3 py-1.5 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-lg font-bold text-[10px] shadow-sm transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                        Gửi phản hồi <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                    </button>
                </div>
            </form>
        `;
        wrap.classList.remove('hidden');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        if (!forceOpen) {
            const textarea = document.getElementById(`reply-textarea-${commentId}`);
            if (textarea) {
                textarea.focus();
            }
        }
    }

    function cancelReplyForm(commentId) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (wrap) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
        }
    }

    function toggleReplies(commentId, forceOpen = false) {
        const container = document.getElementById(`replies-container-${commentId}`);
        const toggleWrap = document.getElementById(`reply-toggle-wrap-${commentId}`);
        if (!container || !toggleWrap) return;

        const isHidden = container.classList.contains('hidden');

        if (forceOpen || isHidden) {
            container.classList.remove('hidden');
            if (!expandedRepliesCache.includes(commentId)) {
                expandedRepliesCache.push(commentId);
            }

            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-slate-500 hover:text-slate-455 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-455"></i> Ẩn phản hồi
                </button>
            `;

            applyNestedRepliesPagination();
        } else {
            container.classList.add('hidden');
            expandedRepliesCache = expandedRepliesCache.filter(id => id !== commentId);
            expandedRepliesFullCache = expandedRepliesFullCache.filter(id => id !== commentId);

            const replyCount = container.querySelectorAll('.comment-node[data-reply-index]').length;
            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-primary"></i> Xem ${replyCount} câu trả lời
                </button>
            `;

            applyNestedRepliesPagination();
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    async function submitAjaxComment(event, parentId = 0) {
        event.preventDefault();

        let content = '';
        let submitBtn = null;
        let textarea = null;

        if (parentId === 0) {
            textarea = document.getElementById('comment-textarea');
            submitBtn = document.getElementById('submit-comment-btn');
        } else {
            textarea = document.getElementById(`reply-textarea-${parentId}`);
            submitBtn = document.getElementById(`submit-reply-${parentId}-btn`);
        }

        if (!textarea || !textarea.value.trim()) return;
        content = textarea.value.trim();

        // --- OPTIMISTIC UI UPDATE ---
        const listContainer = document.getElementById('realtime-comments-list');
        if (listContainer) {
            const escapedContent = content.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>");
            const optimisticHtml = `
                <div class="comment-node group/comment relative animate-pulse mt-3 opacity-60 transition-all duration-300">
                    <div class="flex items-start gap-2.5 relative z-10">
                        <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-[10px] text-slate-500 shadow-sm shrink-0">
                            <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="inline-block comment-bubble-glass px-4 py-2.5 rounded-2xl max-w-full border border-slate-200/50">
                                <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                    <span class="text-xs font-extrabold text-slate-500">Đang gửi...</span>
                                </div>
                                <div class="text-[12px] md:text-xs text-slate-650 leading-relaxed break-words font-semibold">
                                    ${escapedContent}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (parentId === 0) {
                const placeholder = listContainer.querySelector('div.text-center');
                if (placeholder && placeholder.innerHTML.includes('Chưa có cuộc thảo luận nào')) {
                    listContainer.innerHTML = '';
                }
                listContainer.insertAdjacentHTML('beforeend', optimisticHtml);
            } else {
                const repliesContainer = document.getElementById(`replies-container-${parentId}`);
                if (repliesContainer) {
                    repliesContainer.classList.remove('hidden');
                    repliesContainer.insertAdjacentHTML('beforeend', optimisticHtml);
                }
            }
            
            try {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } catch (e) {}
        }
        
        textarea.value = '';

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_submit_comment');
        formData.append('post_id', currentPostId);
        formData.append('comment_parent', parentId);
        formData.append('content', content);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                if (parentId !== 0) {
                    cancelReplyForm(parentId);
                    if (!expandedRepliesCache.includes(parentId)) {
                        expandedRepliesCache.push(parentId);
                    }
                    if (!expandedRepliesFullCache.includes(parentId)) {
                        expandedRepliesFullCache.push(parentId);
                    }
                } else {
                    visibleTopLevelCount = 999;
                }

                lastCommentsHtmlCache = "";
                await fetchComments(true, true);
            } else {
                textarea.value = content;
                alert(data.data.message || 'Lỗi khi gửi thảo luận.');
            }
        } catch (err) {
            textarea.value = content;
            console.error('Lỗi khi gửi thảo luận:', err);
            alert('Lỗi kết nối máy chủ. Vui lòng thử lại.');
        }
    }

    async function handleCommentLike(commentId) {
        const btn = document.getElementById(`comment-like-btn-${commentId}`);
        if (!btn) return;
        btn.disabled = true;

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_like_comment');
        formData.append('comment_id', commentId);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                const isLiked = data.data.status === 'liked';
                const count = data.data.total_likes;

                btn.className = `text-[10px] font-bold transition-colors flex items-center gap-1 ${isLiked ? 'text-red-500' : 'text-slate-500 hover:text-primary'} bg-transparent border-0 cursor-pointer p-0 select-none`;
                
                const heartIcon = isLiked ? '<i data-lucide="heart" class="w-3 h-3 fill-red-500 text-red-500 liked-heart-glow"></i>' : '<i data-lucide="heart" class="w-3 h-3 text-slate-500"></i>';
                const countSpan = count > 0 ? `<span id="comment-like-count-${commentId}" class="bg-red-50 px-1.5 py-0.5 rounded text-red-500 font-bold ml-0.5 border border-red-200/50">${count}</span>` : '';
                
                btn.innerHTML = `${heartIcon} Thích ${countSpan}`;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } else {
                alert(data.data.message || 'Lỗi khi thích bình luận.');
            }
        } catch (err) {
            console.error('Lỗi khi thích bình luận:', err);
        } finally {
            btn.disabled = false;
        }
    }

    // --- FACEBOOK PAGINATION SYSTEM ---
    function applyTopLevelPagination() {
        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) return;

        const topComments = Array.from(listContainer.querySelectorAll(':scope > .comment-node'));
        const total = topComments.length;
        const startIndex = Math.max(0, total - visibleTopLevelCount);
        
        topComments.forEach((comment, index) => {
            if (index >= startIndex) {
                comment.classList.remove('hidden');
            } else {
                comment.classList.add('hidden');
            }
        });

        const oldBtn = document.getElementById('load-more-comments-btn-wrap');
        if (oldBtn) oldBtn.remove();

        if (startIndex > 0) {
            const remaining = startIndex;
            const btnHtml = `
                <div id="load-more-comments-btn-wrap" class="pb-3 select-none">
                    <button type="button" onclick="loadMoreTopComments()" class="w-full py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 rounded-xl font-bold text-xs text-primary transition-all flex items-center justify-center gap-1.5 cursor-pointer shadow-sm border-0">
                        <i data-lucide="history" class="w-3.5 h-3.5 text-primary"></i> Xem bình luận cũ hơn (${remaining})
                    </button>
                </div>
            `;
            listContainer.insertAdjacentHTML('afterbegin', btnHtml);
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons({ strokeWidth: 1.5 });
            }
        }
    }

    function loadMoreTopComments() {
        visibleTopLevelCount += 5;
        applyTopLevelPagination();
    }

    function applyNestedRepliesPagination() {
        expandedRepliesCache.forEach(commentId => {
            const container = document.getElementById(`replies-container-${commentId}`);
            if (!container) return;

            const replies = Array.from(container.querySelectorAll(':scope > .comment-node[data-reply-index]'));
            const total = replies.length;

            const isFullyExpanded = expandedRepliesFullCache.includes(commentId);
            const defaultLimit = 3;

            if (total > defaultLimit && !isFullyExpanded) {
                const hiddenCount = total - defaultLimit;
                replies.forEach((rep, idx) => {
                    if (idx >= hiddenCount) {
                        rep.classList.remove('hidden');
                    } else {
                        rep.classList.add('hidden');
                    }
                });

                const oldBtn = document.getElementById(`load-more-replies-wrap-${commentId}`);
                if (oldBtn) oldBtn.remove();

                const btnHtml = `
                    <div id="load-more-replies-wrap-${commentId}" class="ml-10 py-1.5 animate-fadeIn select-none text-left">
                        <button type="button" onclick="loadMoreReplies(${commentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0">
                            <i data-lucide="messages-square" class="w-3.5 h-3.5 text-primary"></i> Xem ${hiddenCount} câu trả lời cũ hơn
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', btnHtml);

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } else {
                replies.forEach(rep => rep.classList.remove('hidden'));
                const oldBtn = document.getElementById(`load-more-replies-wrap-${commentId}`);
                if (oldBtn) oldBtn.remove();
            }
        });
    }

    function loadMoreReplies(commentId) {
        if (!expandedRepliesFullCache.includes(commentId)) {
            expandedRepliesFullCache.push(commentId);
        }
        applyNestedRepliesPagination();
    }
</script>

<?php
get_footer();
