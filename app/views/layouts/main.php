<?php
// --- KẾT NỐI DATABASE ĐỂ LẤY CẤU HÌNH (HEADER/FOOTER) ---
// Kiểm tra nếu biến $config_site chưa có thì mới đi lấy
if (!isset($config_site)) {
    // Gọi Model Setting (nếu file tồn tại) hoặc dùng Database trực tiếp
    if (file_exists(APPROOT . '/models/Setting.php')) {
        require_once APPROOT . '/models/Setting.php';
        $db = new Database();
        $db->query("SELECT * FROM settings");
        $rows = $db->resultSet();
        
        $config_site = [];
        foreach ($rows as $row) {
            $config_site[$row->setting_key] = $row->setting_value;
        }
    }
}

// Gán biến mặc định nếu database chưa có dữ liệu
$company_name = $config_site['company_name'] ?? 'Do & Tan Sneakers';
$phone        = $config_site['phone'] ?? '0909 123 456';
$address      = $config_site['address'] ?? 'Dĩ An, Bình Dương';
$logo         = $config_site['logo_path'] ?? '';
?>

<!doctype html>
<html lang="vi" class="h-full dark">
    <script> 
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : 'Trang chủ'; ?> - <?= $company_name ?></title>

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
    </style>
</head>
<body class="min-h-full flex flex-col bg-white text-gray-900 dark:bg-black dark:text-white">
    
    <header class="sticky top-0 z-50 shadow-lg bg-white dark:bg-[#111111] border-b dark:border-gray-800">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                
                <div class="flex items-center gap-3">
                    <a href="<?= URLROOT ?>/public/index.php" class="flex flex-col leading-none">
                        <?php if (!empty($logo) && file_exists(dirname(APPROOT) . '/public/' . $logo)): ?>
                            <img src="<?= URLROOT ?>/public/<?= $logo ?>" alt="<?= $company_name ?>" class="h-10 object-contain">
                        <?php else: ?>
                            <h1 id="store-name" class="text-2xl font-black italic uppercase tracking-tighter">
                                <span class="text-gray-900 dark:text-white"><?= $company_name ?></span>
                            </h1>
                        <?php endif; ?>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="index.php" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Trang chủ</a>
                    <a href="index.php?url=pages/about" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Giới thiệu</a>
                    <a href="<?= URLROOT ?>/public/index.php?url=products/index" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Sản phẩm</a>
                    <a href="<?= URLROOT ?>/public/index.php?url=news/index" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Tin tức</a>
                    <a href="index.php?url=pages/faq" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Hỏi đáp</a>
                    <a href="index.php?url=pages/contact" class="nav-link font-bold text-sm uppercase tracking-wide text-gray-700 hover:text-yellow-500 dark:text-gray-300 dark:hover:text-yellow-400">Liên hệ</a>
                </div>
                
                <div class="flex items-center gap-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-yellow-500">
                                <span>Chào, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#1a1a1a] rounded-lg shadow-xl border border-gray-100 dark:border-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                                        ⚙️ Trang quản trị
                                    </a>
                                <?php endif; ?>
                                
                                <a href="<?= URLROOT ?>/public/index.php?url=profile/index" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    👤 Thông tin tài khoản
                                </a>
                                
                                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                                <a href="<?= URLROOT ?>/public/index.php?url=auth/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    👋 Đăng xuất
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= URLROOT ?>/public/index.php?url=auth/login" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-yellow-500">
                            Đăng nhập
                        </a>
                    <?php endif; ?>
                    <button id="theme-toggle" onclick="toggleTheme()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg id="sun-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <svg id="moon-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    </button> 
                    
                    <a href="<?php echo URLROOT; ?>/public/index.php?url=products/cart" class="group relative w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-yellow-100 text-gray-600 hover:text-yellow-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 transition-all focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L6 13.5h11.25a.75.75 0 00.728-.568l1.5-6a.75.75 0 00-.728-.932H5.181m0 0L4.5 3.75M6 13.5l-1.5 6h15" /></svg>
                        <span id="cartCount" class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white dark:border-[#111111]">
                            <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
                        </span>
                    </a>

                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-100 dark:border-gray-800">
                <div class="flex flex-col space-y-3 pt-4">
                    <a href="index.php" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Trang chủ</a>
                    <a href="index.php?url=pages/about" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Giới thiệu</a>
                    <a href="<?= URLROOT ?>/public/index.php?url=products/index" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Sản phẩm</a>
                    
                    <a href="<?= URLROOT ?>/public/index.php?url=news/index" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Tin tức</a>
                    
                    <a href="index.php?url=pages/faq" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Hỏi đáp</a>
                    <a href="index.php?url=pages/contact" class="block py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Liên hệ</a>

                    <div class="border-t border-gray-100 dark:border-gray-800 my-2"></div>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="px-4 py-2">
                            <span class="block text-sm text-gray-500 mb-2">Xin chào, <strong class="text-yellow-500"><?= htmlspecialchars($_SESSION['user_name']) ?></strong></span>
                            
                            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                <a href="<?= URLROOT ?>/public/index.php?url=admin/dashboard" class="block py-2 text-sm font-bold text-blue-600 hover:text-blue-500">
                                    ⚙️ Trang quản trị
                                </a>
                            <?php endif; ?>
                            
                            <a href="<?= URLROOT ?>/public/index.php?url=profile/index" class="block py-2 text-sm font-bold text-gray-600 hover:text-gray-500 dark:text-gray-400">
                                👤 Thông tin tài khoản
                            </a>

                            <a href="<?= URLROOT ?>/public/index.php?url=auth/logout" class="block py-2 text-sm font-bold text-red-600 hover:text-red-500">
                                👋 Đăng xuất
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col gap-2 px-4">
                            <a href="<?= URLROOT ?>/public/index.php?url=auth/login" class="text-center w-full bg-yellow-500 text-black font-bold py-2 rounded-lg hover:bg-yellow-400 transition-all">
                                Đăng nhập
                            </a>
                            <a href="<?= URLROOT ?>/public/index.php?url=auth/register" class="text-center w-full border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                                Đăng ký
                            </a>
                        </div>
                    <?php endif; ?>
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
                        <h2 class="text-xl font-black italic uppercase text-white"><?= $company_name ?></h2>
                    </div>
                    <p class="text-gray-400 text-sm">Đại lý phân phối giày chính hãng uy tín. Cam kết chất lượng 100% Authentic.</p>
                    <div class="mt-4 text-sm">
                        <p>📍 <?= $address ?></p>
                        <p>📞 <?= $phone ?></p>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4 uppercase tracking-wider">Sản phẩm</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="index.php?url=products/index&category=sports" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Giày thể thao</a></li>
                        <li><a href="index.php?url=products/index&category=running" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Giày chạy bộ</a></li>
                        <li><a href="index.php?url=products/index&category=lifestyle" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Sneaker Lifestyle</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4 uppercase tracking-wider">Hỗ trợ</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="index.php?url=pages/size_guide" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Hướng dẫn chọn size</a></li>
                        <li><a href="index.php?url=pages/return_policy" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Chính sách đổi trả</a></li>
                        <li><a href="index.php?url=pages/warranty" class="hover:text-yellow-500 hover:translate-x-1 transition-all inline-block">Chính sách bảo hành</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4 uppercase tracking-wider">Theo dõi</h4>
                    <div class="flex gap-4">
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 text-white transition-all transform hover:-translate-y-1 shadow-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg></a>
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 text-white transition-all transform hover:-translate-y-1 shadow-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.416 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468.99c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg></a>
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-black hover:border hover:border-gray-700 text-white transition-all transform hover:-translate-y-1 shadow-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.35-1.17.82-1.5 1.47-.24.52-.34 1.11-.27 1.69.1 1.36 1.01 2.57 2.29 2.94.82.27 1.73.27 2.55-.02.76-.25 1.42-.78 1.82-1.48.42-.74.58-1.6.56-2.45V4.05c.01-1.34.02-2.68.02-4.03z"/></svg></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-xs text-gray-500">
                <p>© 2025 <?= $company_name ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }
        
        const defaultConfig = { store_name: "Do & Tan" }; // Config cũ giữ nguyên

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

        window.addEventListener("DOMContentLoaded", function () {
            window.addEventListener("cartUpdated", function(e) {
                document.getElementById("cartCount").textContent = e.detail.cartCount;
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