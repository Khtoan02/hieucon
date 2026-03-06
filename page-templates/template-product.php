<?php
/**
 * Template Name: Sản phẩm
 * 
 * @package Hieucon
 */
?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm Cao Cấp - Hiểu Con Từ Gốc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Thư viện Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts: Lora (Nghệ thuật/Tin cậy) & Nunito (Gần gũi/Mềm mại) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        primary: '#0d9488', 
                        secondary: '#f97316', 
                        secondary_dark: '#ea580c', 
                        navy: {
                            DEFAULT: '#0A1931',
                            light: '#1A365D',
                        },
                        sunset: {
                            top: '#FFF9F0', 
                            mid: '#FFD6C0', 
                            bot: '#B4C8BB'  
                        }
                    },
                    boxShadow: {
                        'elegant': '0 10px 40px -10px rgba(10, 25, 49, 0.08)',
                        'soft': '0 4px 20px -2px rgba(10, 25, 49, 0.05)',
                        'premium': '0 20px 50px -12px rgba(10, 25, 49, 0.15)'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Nunito', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Lora', serif; }
        
        /* Hiệu ứng nền hoàng hôn mượt mà */
        .bg-healing-gradient {
            background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* Glassmorphism cho các nút và thẻ */
        .glass-elegant {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .glass-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 1);
        }

        /* Divider tinh tế */
        .elegant-divider {
            width: 40px;
            height: 3px;
            background-color: #f97316;
            margin: 1.5rem auto;
            border-radius: 4px;
            opacity: 0.8;
        }

        /* Trượt ngang cho menu danh mục trên Mobile */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Hiệu ứng Fade in mượt mà khi lọc sản phẩm */
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-healing-gradient text-navy antialiased selection:bg-secondary/30 selection:text-navy">

    <!-- Tiêu đề trang -->
    <header class="pt-16 pb-10 px-4 text-center relative z-10">
        <div class="inline-flex items-center gap-2 text-secondary font-extrabold text-[11px] uppercase tracking-widest mb-4 bg-white/50 px-4 py-1.5 rounded-full border border-white/60">
            <i data-lucide="sparkles" class="w-4 h-4"></i> Giải pháp toàn diện
        </div>
        <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-navy mb-4">Sản Phẩm Cốt Lõi</h1>
        <div class="elegant-divider"></div>
        <p class="text-navy/70 font-medium text-base md:text-lg max-w-2xl mx-auto leading-relaxed mt-6">
            Tuyển chọn những giải pháp y sinh, dinh dưỡng và chăm sóc tốt nhất, đồng hành cùng ba mẹ trên hành trình phục hồi sức khỏe từ gốc rễ cho con.
        </p>
    </header>

    <!-- Khu vực chính -->
    <main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pb-24 relative z-10">
        
        <!-- Lưới sản phẩm (Đã bỏ bộ lọc ngang) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 mt-6" id="product-grid">
            <!-- Sản phẩm sẽ được render bằng JS -->
        </div>

    </main>

    <!-- Disclaimer & Footer -->
    <footer class="border-t border-white/40 bg-white/30 backdrop-blur-md pt-16 pb-10 mt-10 relative z-10">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Disclaimer Box -->
            <div class="glass-card rounded-[2rem] p-6 md:p-8 shadow-soft mb-16 flex flex-col md:flex-row gap-5 items-start relative overflow-hidden">
                <!-- Watermark Icon -->
                <div class="absolute -top-10 -right-10 opacity-5 pointer-events-none">
                    <i data-lucide="shield-alert" class="w-48 h-48 text-navy"></i>
                </div>
                
                <div class="bg-secondary/10 p-3 md:p-4 rounded-full shrink-0 relative z-10">
                    <i data-lucide="info" class="w-6 h-6 md:w-8 md:h-8 text-secondary"></i>
                </div>
                
                <div class="relative z-10">
                    <h4 class="font-serif text-navy font-bold text-lg md:text-xl mb-3">Lưu ý quan trọng về Y Tế</h4>
                    <p class="text-navy/70 font-medium text-sm md:text-base leading-relaxed">
                        Các sản phẩm và thông tin trên trang web mang tính chất chia sẻ kiến thức, hỗ trợ dinh dưỡng và sức khỏe nền tảng. <strong>Thực phẩm này không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh.</strong> Mọi quyết định can thiệp y tế chuyên sâu hoặc sử dụng sản phẩm cho trẻ có nhu cầu đặc biệt cần có sự tham vấn của các y bác sĩ, chuyên gia có chuyên môn phù hợp với thể trạng riêng biệt của từng trẻ.
                    </p>
                </div>
            </div>

            <!-- Minimal Footer Info -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3 text-center md:text-left">
                    <div class="p-2 bg-secondary/10 rounded-full text-secondary">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                    </div>
                    <span class="font-serif italic text-navy text-base md:text-lg">Hiểu con từ gốc, yêu thương trọn vẹn.</span>
                </div>
                <div class="text-sm font-medium text-navy/50 text-center md:text-right">
                    &copy; 2026 Cộng đồng Hiểu Con Từ Gốc.<br class="md:hidden" /> All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>

        // Dữ liệu sản phẩm tĩnh (Bỏ phân loại)
        const productsData = [
            { id: "1", product_name: "Miwako A+", product_unit: "Lon 700g", price: 750000, product_description: "Dinh dưỡng thực vật toàn diện bổ sung 22 vi chất và GABA, chuyên biệt giúp phát triển trí não.", product_link: "/miwako-a", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/A_yzi6wk.png" },
            { id: "2", product_name: "Miwako", product_unit: "Lon 700g", price: 725000, product_description: "Giải pháp dinh dưỡng nền tảng được thiết kế đặc biệt hỗ trợ ổn định hệ tiêu hoá non nớt.", product_link: "/miwako", product_image: "https://statics.pancake.vn/web-media/47/72/37/5e/6a5a4c3c211b04c61cba1dd9586672a65c317ff5caec49342bdade7c-w:1652-h:1629-l:3980831-t:image/png.png", imageScale: "0.75" },
            { id: "3", product_name: "CareMIL", product_unit: "Lon 800g", price: 960000, product_description: "Sữa hạt hữu cơ củng cố trục não-ruột nhờ công thức GABA và lợi khuẩn.", product_link: "/caremil", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Care_Milk_goeehp.png" },
            { id: "4", product_name: "DawnBridge NuraFix", product_unit: "Hộp 30 gói, mỗi gói 30g", price: 800000, product_description: "Giải pháp hỗ trợ kết nối não bộ giúp trẻ tăng cường sự tập trung.", product_link: "/dawnbridge-nurafix", product_image: "https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-NURA-FIX_MALAYSIA-DEC24.png" },
            { id: "5", product_name: "Heilusan Omega-3", product_unit: "1 hộp/120 viên", price: 396000, product_description: "Viên uống dầu cá hồi cô đặc nhập khẩu từ Đức, cung cấp hàm lượng cao EPA, DHA.", product_link: "/heilusan-omega-3", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Helusan_ydqh4i.png" },
            { id: "6", product_name: "Nutridom Folate 400 mcg", product_unit: "1 hộp/30 viên", price: 360000, product_description: "Folate hữu cơ dạng hoạt tính 5-MTHF dễ hấp thu, hỗ trợ não bộ.", product_link: "/folate-400-mcg", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Folate_gxa2ro.png" },
            { id: "7", product_name: "Neurocard Max", product_unit: "1 hộp/6 vỉ x 10 viên", price: 594000, product_description: "Công thức đột phá kết hợp Omega-3 và khoáng chất tăng cường trí nhớ.", product_link: "/neurocard-max", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Neroucard_Max_zf1grp.png" },
            { id: "8", product_name: "Dawn Bridge ProbioACE", product_unit: "1 hộp/20 gói x 2g", price: 900000, product_description: "Men vi sinh công nghệ bao vi nang 5 lớp VPro®, hỗ trợ đường ruột.", product_link: "/probioace", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867140/ProbioACE_eufmi8.png" },
            { id: "9", product_name: "Probiotic BISUMI 120B", product_unit: "1 hộp/20 gói x 2g", price: 390000, product_description: "Siêu men vi sinh chứa 120 tỷ lợi khuẩn, giải quyết triệt để táo bón.", product_link: "/bisumi", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867138/Bisumi_b8hwar.png" },
            { id: "10", product_name: "DawnBridge Nura-Zen", product_unit: "Hộp 30 gói, mỗi gói 30g", price: 800000, product_description: "Công thức kết hợp GABA, Magie hỗ trợ giấc ngủ và điều hòa hành vi.", product_link: "/dawnbridge-nura-zen", product_image: "https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-NURA-ZEN_MALAYSIA-DEC24.png" },
            { id: "11", product_name: "DawnBridge Botani9", product_unit: "Hộp 30 gói, mỗi gói 30g", price: 960000, product_description: "Giàu chất chống oxy hóa bảo vệ não bộ và tăng cường miễn dịch.", product_link: "/dawnbridge-botani9", product_image: "https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-BOTANI9_MALAYSIA-DEC24.png" },
            { id: "12", product_name: "Obibebe", product_unit: "Hộp 20 ống x 10ml", price: 0, product_description: "Dung dịch uống dinh dưỡng đặc biệt chuyên sâu cho bé.", product_link: "/obibebe", product_image: "https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Obibebe_ytxvzs.png" }
        ];

        // Khởi tạo Icon
        lucide.createIcons({ strokeWidth: 1.5 });

        // Hàm định dạng tiền tệ
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN').format(amount);
        }

        // 1. Hàm render Danh sách Sản phẩm
        function renderProducts() {
            const grid = document.getElementById('product-grid');
            grid.innerHTML = '';

            // Lấy toàn bộ sản phẩm do đã bỏ tính năng lọc
            const filteredData = productsData;

            filteredData.forEach((product, index) => {
                const card = document.createElement('div');
                // Độ trễ animation cho từng card mượt mà
                card.style.animationDelay = `${index * 0.05}s`;
                card.className = 'glass-card rounded-[2rem] overflow-hidden flex flex-col h-full hover:-translate-y-2 transition-transform duration-500 shadow-soft hover:shadow-elegant group fade-in';
                
                const catLabel = categories[product.category];

                // Scale logic xử lý ảnh
                const imgTransform = product.imageScale ? `transform: scale(${product.imageScale}); transform-origin: center;` : '';

                card.innerHTML = `
                    <a href="${product.product_link}" target="_blank" class="flex flex-col h-full outline-none focus-visible:ring-2 focus-visible:ring-secondary focus-visible:ring-inset">
                        
                        <!-- Product Image Area -->
                        <div class="relative w-full pt-[100%] bg-white/60 overflow-hidden">
                            <!-- Image wrapper for hover effect -->
                            <div class="absolute inset-0 flex items-center justify-center p-6 transition-transform duration-700 ease-out group-hover:scale-110">
                                ${product.product_image ? `
                                    <img src="${product.product_image}" alt="${product.product_name}" class="w-full h-full object-contain drop-shadow-sm" style="${imgTransform}" loading="lazy">
                                ` : `
                                    <i data-lucide="package" class="w-16 h-16 text-navy/20"></i>
                                `}
                            </div>
                        </div>

                        <!-- Product Content Area -->
                        <div class="p-6 xl:p-8 flex flex-col flex-grow bg-gradient-to-b from-transparent to-white/40">
                            
                            <!-- Name & Unit -->
                            <h3 class="font-serif text-[22px] font-bold text-navy mb-1.5 leading-tight group-hover:text-secondary transition-colors duration-300 line-clamp-2">
                                ${product.product_name}
                            </h3>
                            ${product.product_unit ? `
                                <p class="text-xs font-bold text-navy/40 uppercase tracking-widest mb-4">
                                    ${product.product_unit}
                                </p>
                            ` : ''}
                            
                            <!-- Description -->
                            <p class="text-sm font-medium text-navy/70 leading-relaxed mb-6 flex-grow line-clamp-3">
                                ${product.product_description || 'Nhấn để xem chi tiết sản phẩm'}
                            </p>
                            
                            <!-- Price & Action (Bottom fixed) -->
                            <div class="mt-auto pt-5 border-t border-navy/10 flex items-end justify-between">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-navy/40 uppercase tracking-widest mb-0.5">Giá sản phẩm</span>
                                    ${product.price > 0 ? `
                                        <span class="font-bold text-secondary text-xl xl:text-2xl leading-none">
                                            ${formatCurrency(product.price)}<span class="text-[14px] ml-0.5 relative -top-1">₫</span>
                                        </span>
                                    ` : `
                                        <span class="font-bold text-secondary text-lg leading-none">
                                            Vui lòng liên hệ
                                        </span>
                                    `}
                                </div>
                                
                                <div class="w-10 h-10 rounded-2xl bg-white border border-navy/10 flex items-center justify-center text-navy shadow-sm group-hover:bg-secondary group-hover:text-white group-hover:border-secondary transition-all duration-300 transform group-hover:-rotate-12">
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                
                grid.appendChild(card);
            });

            // Re-init lucide icons for newly added elements
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        // Khởi tạo trang
        renderProducts();

    </script>
</body>
</html>