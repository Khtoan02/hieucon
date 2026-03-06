<?php
/**
 * Template Name: Trang 404
 * 
 * @package Hieucon
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Một chút lạc nhịp - Hiểu Con Từ Gốc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Thư viện Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts: Lora (Nghệ thuật/Tin cậy) & Nunito (Gần gũi/Mềm mại) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

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
                        secondary_light: '#ffedd5',
                        secondary_dark: '#ea580c',
                        navy: {
                            DEFAULT: '#0A1931',
                            light: '#1A365D',
                            muted: '#334155'
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
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-serif {
            font-family: 'Lora', serif;
        }

        .gradient-text {
            background: linear-gradient(90deg, #0A1931, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hiệu ứng nền mượt mà */
        .bg-healing-gradient {
            background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%);
            background-attachment: fixed;
        }

        /* Glassmorphism */
        .glass-elegant {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.6) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body
    class="bg-healing-gradient text-navy antialiased selection:bg-secondary/30 selection:text-navy min-h-screen flex flex-col justify-between">

    <!-- 404 Content (Tự động căn giữa toàn màn hình vì đã bỏ header) -->
    <main class="flex-grow flex items-center justify-center py-16 px-4 relative z-10">
        <div
            class="max-w-3xl w-full mx-auto text-center glass-card p-10 md:p-16 rounded-[3rem] shadow-elegant relative overflow-hidden">
            <!-- Decorative Background Element -->
            <div class="absolute -top-16 -right-16 opacity-5 pointer-events-none">
                <i data-lucide="dna" class="w-64 h-64 text-navy"></i>
            </div>

            <div class="inline-flex bg-secondary/10 p-5 rounded-full mb-6">
                <i data-lucide="flower-2" class="w-12 h-12 md:w-16 md:h-16 text-secondary opacity-90"></i>
            </div>

            <h1
                class="font-serif text-5xl md:text-7xl font-extrabold text-navy/10 mb-2 tracking-widest absolute top-8 left-1/2 -translate-x-1/2 pointer-events-none">
                404</h1>

            <h2 class="font-serif text-2xl md:text-4xl text-navy mb-6 relative z-10 leading-tight">
                Rất tiếc, trang ba mẹ tìm kiếm <span class="text-secondary italic">hiện không tồn tại.</span>
            </h2>

            <div class="w-16 h-1 bg-secondary/30 mx-auto rounded-full mb-8"></div>

            <p
                class="text-base md:text-xl text-navy/80 font-medium mb-12 max-w-xl mx-auto leading-relaxed relative z-10">
                Đường dẫn có thể đã bị thay đổi hoặc không chính xác. Tuy nhiên, mái nhà chung <strong
                    class="text-navy">Hiểu Con Từ Gốc - Tự Kỷ Là Rối Loạn Toàn Thân</strong> vẫn luôn ở ngay đây chờ đón
                ba mẹ.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center relative z-10">
                <!-- Nút quay về trang chủ (index.html) -->
                <a href="index.html"
                    class="w-full sm:w-auto bg-navy hover:bg-navy-light text-white px-8 py-3.5 md:py-4 rounded-full font-bold transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-3">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Về lại trang chủ
                </a>

                <!-- Nút tham gia nhóm Facebook -->
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                    rel="noopener noreferrer"
                    class="w-full sm:w-auto glass-elegant text-navy hover:bg-white/90 px-8 py-3.5 md:py-4 rounded-full font-bold transition-all shadow-soft hover:shadow-elegant flex items-center justify-center gap-3">
                    <i data-lucide="users" class="w-5 h-5 text-secondary"></i>
                    Tham gia nhóm "Hiểu Con Từ Gốc"
                </a>
            </div>
        </div>
    </main>

    <!-- Footer tinh gọn -->
    <footer class="border-t border-white/30 bg-white/20 backdrop-blur-md py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center items-center gap-2">
                <span class="font-serif italic text-navy/70 text-sm md:text-base">"Hiểu con từ gốc, yêu thương trọn
                    vẹn."</span>
            </div>
        </div>
    </footer>

    <!-- Initialize Icons -->
    <script>
        lucide.createIcons({
            strokeWidth: 1.5
        });
    </script>