<!doctype html>
<html lang="vi" class="h-full dark">
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

        /* Style riêng cho Brand Logos */
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
                    <a href="index.php#products" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Sản phẩm</a>
                    <a href="index.php#brands" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Thương hiệu</a>
                    <a href="index.php?url=pages/contact" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Liên hệ</a>
                </div>
                
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" onclick="toggleTheme()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg id="sun-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <svg id="moon-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    </button> 
                    
                    <button class="group relative w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="w-6 h-6"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L6 13.5h11.25a.75.75 0 00.728-.568l1.5-6a.75.75 0 00-.728-.932H5.181m0 0L4.5 3.75M6 13.5l-1.5 6h15"
                          />
                        </svg>
                        
                        <span id="cart-count" class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white dark:border-[#111111]">0</span> 
                    </button>
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
                    <div class="flex gap-4">
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">F</a>
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all">I</a>
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
        
        // 4. CART LOGIC
        let cartCount = 0;
        const cartCountElement = document.getElementById('cart-count');
        document.addEventListener('click', function(e) {
            if (e.target && e.target.closest('button.buy-btn')) {
                cartCount++;
                cartCountElement.textContent = cartCount;
                
                // Animation rung
                const badge = cartCountElement;
                badge.classList.add('scale-125');
                setTimeout(() => badge.classList.remove('scale-125'), 200);
                
                showNotification('Đã thêm sản phẩm vào giỏ hàng!', 'success');
            }
        });

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
</body>
</html>