<!doctype html>
<html lang="vi" class="h-full dark">
    <script> // Not flashing when reloading
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : 'Trang chủ'; ?> - Do & Tan Sneakers</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    
    <script src="/_sdk/element_sdk.js"></script>
    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>

    <style>
        body { box-sizing: border-box; }
        
        /* Hiệu ứng chuyển đổi mượt mà */
        html, body, header, section, div, span, p, h1, h2, h3, a, button, svg, path {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, fill 0.3s ease, stroke 0.3s ease;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1a1a1a; }
        ::-webkit-scrollbar-thumb { background: #fbbf24; border-radius: 4px; }
        
        .nav-link { position: relative; }
        .nav-link::after { 
            content: ''; position: absolute; width: 0; height: 2px; 
            bottom: -4px; left: 0; background-color: #fbbf24; 
            transition: width 0.3s ease; 
        }
        .nav-link:hover::after { width: 100%; }

        .brand-icon {
            transition: all 0.3s ease;
            filter: grayscale(100%) opacity(0.7);
        }
        .brand-icon:hover {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.1);
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-white text-gray-900 dark:bg-black dark:text-white">
    
    <header class="sticky top-0 z-50 shadow-lg bg-white dark:bg-[#111111] border-b dark:border-gray-800">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                
                <div class="flex items-center gap-3">
                    <div class="flex flex-col leading-none">
                        <h1 id="store-name" class="text-2xl font-black italic uppercase tracking-tighter">
                            <span class="text-gray-900 dark:text-white">Do &</span>
                            <span class="text-yellow-500">Tan</span>
                        </h1>
                         <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5 font-bold tracking-widest uppercase">Sneaker Store</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="index.php" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Trang chủ</a>
                    
                    <a href="index.php?url=pages/about" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Giới thiệu</a>

                    <a href="<?= URLROOT ?>/public/index.php?url=products/index" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Sản phẩm</a>
                    <a href="index.php#brands" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Thương hiệu</a>

                    <a href="index.php?url=pages/faq" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Hỏi đáp</a>

                    <a href="index.php?url=pages/contact" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Liên hệ</a>
                </div>
                
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" onclick="toggleTheme()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg id="sun-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <svg id="moon-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    </button> 
                    
                    <a href="<?php echo URLROOT; ?>/public/index.php?url=products/cart" class="group relative w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L6 13.5h11.25a.75.75 0 00.728-.568l1.5-6a.75.75 0 00-.728-.932H5.181m0 0L4.5 3.75M6 13.5l-1.5 6h15" />
                        </svg>
                        
                        <span id="cartCount" 
                            class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white dark:border-[#111111]">
                            <?= isset($_SESSION['cart']) 
                            ? array_sum(array_column($_SESSION['cart'], 'quantity')) 
                            : 0 ?>
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow bg-gray-50 dark:bg-black">
        <?php echo isset($content) ? $content : ''; ?>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <h2 class="text-xl font-black italic uppercase text-white">Do & <span class="text-yellow-500">Tan</span></h2>
                    </div>
                    <p class="text-gray-400 text-sm">Đại lý phân phối giày chính hãng uy tín.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Sản phẩm</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Giày thể thao</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Giày chạy bộ</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Sneaker Lifestyle</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Hỗ trợ</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Hướng dẫn chọn size</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Chính sách đổi trả</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Bảo hành</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4">Theo dõi</h4>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 text-white transition-all transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                        </a>
                        
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 text-white transition-all transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468.99c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                        </a>

                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-black hover:border hover:border-gray-700 text-white transition-all transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.35-1.17.82-1.5 1.47-.24.52-.34 1.11-.27 1.69.1 1.36 1.01 2.57 2.29 2.94.82.27 1.73.27 2.55-.02.76-.25 1.42-.78 1.82-1.48.42-.74.58-1.6.56-2.45V4.05c.01-1.34.02-2.68.02-4.03z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-xs text-gray-500">
                <p>© 2025 Do & Tan Sneakers. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // 1. SDK CONFIGURATION
        const defaultConfig = {
            store_name: "Do & Tan",
            hero_title: "Do & Tan Sneakers",
            hero_subtitle: "Chất lượng đỉnh cao - Phong cách dẫn đầu",
            about_title: "Về chúng tôi",
            contact_title: "Liên hệ Do & Tan",
            primary_color: "#eab308",
            font_family: "Inter",
            font_size: 16
        };

        // 2. THEME LOGIC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark'); 
        }
        
        function updateThemeIcons() {
            const html = document.documentElement;
            const sun = document.getElementById('sun-icon');
            const moon = document.getElementById('moon-icon');
            if (html.classList.contains('dark')) {
                sun.classList.add('hidden');
                moon.classList.remove('hidden');
            } else {
                sun.classList.remove('hidden');
                moon.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', updateThemeIcons);

        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
            updateThemeIcons();
        }

        // 3. SMOOTH SCROLL
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
        
        // 4. CART LOGIC – lắng nghe sự kiện toàn cục từ các trang con
        const cartCountElement = document.getElementById('cartCount');

        function showNotification(message) {
            const div = document.createElement('div');
            div.className = 'fixed top-20 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl z-50 animate-bounce font-medium text-sm';
            div.textContent = message;
            document.body.appendChild(div);
            setTimeout(() => div.remove(), 2000);
        }
        
        // 5. FORM HANDLER
        function handleContactForm(event) {
            event.preventDefault();
            showNotification('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.', 'success');
            event.target.reset();
        }

        // 6. SDK IMPLEMENTATION
        async function onConfigChange(config) {
            const storeNameEl = document.getElementById('store-name');
            if (storeNameEl) storeNameEl.innerHTML = `<span class="text-gray-900 dark:text-white">Do &</span> <span class="text-yellow-500">${config.store_name || defaultConfig.store_name}</span>`;
            
            const heroTitleEl = document.getElementById('hero-title');
            if (heroTitleEl) heroTitleEl.textContent = config.hero_title || defaultConfig.hero_title;
            
            const heroSubtitleEl = document.getElementById('hero-subtitle');
            if (heroSubtitleEl) heroSubtitleEl.textContent = config.hero_subtitle || defaultConfig.hero_subtitle;
            
            const aboutTitleEl = document.getElementById('about-title');
            if (aboutTitleEl) aboutTitleEl.textContent = config.about_title || defaultConfig.about_title;
            
            const contactTitleEl = document.getElementById('contact-title');
            if (contactTitleEl) contactTitleEl.textContent = config.contact_title || defaultConfig.contact_title;

            if(config.font_family) document.body.style.fontFamily = config.font_family;
            if(config.primary_color) {
                document.documentElement.style.setProperty('--primary-color', config.primary_color);
                document.querySelectorAll('.text-yellow-500').forEach(el => el.style.color = config.primary_color);
                document.querySelectorAll('.bg-yellow-500').forEach(el => el.style.backgroundColor = config.primary_color);
            }
        }

        if (window.elementSdk) {
            window.elementSdk.init({
                defaultConfig,
                onConfigChange
            });
        }
    </script>
    <script>
        window.addEventListener("DOMContentLoaded", function () {

            // Lắng nghe event khi detail.php gửi tín hiệu cập nhật giỏ hàng
            window.addEventListener("cartUpdated", function(e) {
                document.getElementById("cartCount").textContent = e.detail.cartCount;

                // HIỆN THÔNG BÁO
                const div = document.createElement("div");
                div.className = "fixed top-20 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl z-50 font-medium text-sm";
                div.textContent = "✔ Đã thêm sản phẩm vào giỏ hàng!";
                document.body.appendChild(div);

                setTimeout(() => div.remove(), 2000);
            });
        });
    </script>

</body>
</html>