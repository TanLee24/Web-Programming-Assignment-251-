<?php
// --- KẾT NỐI DATABASE ĐỂ LẤY CẤU HÌNH (GIỮ NGUYÊN) ---
if (!isset($config_site)) {
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
$company_name = $config_site['company_name'] ?? 'Do & Tan Sneakers';
$intro_text   = $config_site['intro_text'] ?? 'Chất lượng đỉnh cao - Phong cách dẫn đầu';
?>

<style>
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-container { overflow: hidden; white-space: nowrap; }
    .marquee-content { display: inline-block; animation: scroll 20s linear infinite; }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>

<section id="home" class="relative py-12 md:py-24 bg-[#0a0a0a] overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-yellow-500/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-purple-500/20 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

    <div class="container relative mx-auto px-4 z-10">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">
            <div class="w-full md:w-1/2 text-center md:text-left space-y-6">
                <span class="inline-block px-4 py-1 rounded-full bg-yellow-500/10 text-yellow-500 font-bold text-sm tracking-wider uppercase border border-yellow-500/20">
                    New Collection 2025
                </span>
                <h2 id="hero-title" class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-tight">
                    <?= $company_name ?> <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600 italic">Authentic</span>
                </h2>
                <p id="hero-subtitle" class="text-lg text-gray-400 font-light max-w-lg mx-auto md:mx-0">
                    <?= $intro_text ?>. Khám phá ngay những mẫu giày giới hạn và phong cách streetwear độc đáo nhất.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start pt-4">
                    <a href="index.php?url=products" class="group relative px-8 py-4 bg-yellow-500 text-black font-bold rounded-full overflow-hidden">
                        <span class="relative z-10 group-hover:text-white transition-colors">Mua Ngay &rarr;</span>
                        <div class="absolute inset-0 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                    </a> 
                    <a href="index.php?url=pages/contact" class="px-8 py-4 border border-gray-600 text-white rounded-full font-bold hover:bg-white hover:text-black transition-all">
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center relative">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full blur-3xl opacity-20 scale-75 animate-pulse"></div>
                <img src="https://parspng.com/wp-content/uploads/2023/02/shoespng.parspng.com-13.png" 
                     alt="Hero Sneaker" 
                     class="relative z-10 w-full max-w-lg object-contain animate-float drop-shadow-2xl">
            </div>
        </div>
    </div>
</section>

<div class="bg-yellow-500 py-3 overflow-hidden border-y border-yellow-600">
    <div class="marquee-container">
        <div class="marquee-content text-black font-black text-xl italic uppercase tracking-widest">
            NIKE &bull; ADIDAS &bull; JORDAN &bull; PUMA &bull; NEW BALANCE &bull; CONVERSE &bull; VANS &bull; 
            NIKE &bull; ADIDAS &bull; JORDAN &bull; PUMA &bull; NEW BALANCE &bull; CONVERSE &bull; VANS &bull;
            NIKE &bull; ADIDAS &bull; JORDAN &bull; PUMA &bull; NEW BALANCE &bull; CONVERSE &bull; VANS &bull;
        </div>
    </div>
</div>

<section class="py-16 bg-white dark:bg-[#0f0f0f]">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="group p-8 rounded-2xl bg-white dark:bg-[#1a1a1a] border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mb-6 rounded-2xl bg-yellow-500/10 text-yellow-600 flex items-center justify-center text-3xl group-hover:bg-yellow-500 group-hover:text-white transition-colors">🚀</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Giao hàng siêu tốc</h3>
                <p class="text-gray-500 dark:text-gray-400 leading-relaxed">Nhận hàng trong 2h nội thành. Miễn phí ship cho mọi đơn hàng giá trị > 500k.</p>
            </div>
            <div class="group p-8 rounded-2xl bg-white dark:bg-[#1a1a1a] border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mb-6 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-3xl group-hover:bg-blue-600 group-hover:text-white transition-colors">🛡️</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Bảo hành trọn đời</h3>
                <p class="text-gray-500 dark:text-gray-400 leading-relaxed">Cam kết 100% Authentic. Hoàn tiền gấp 10 lần nếu phát hiện hàng Fake.</p>
            </div>
            <div class="group p-8 rounded-2xl bg-white dark:bg-[#1a1a1a] border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mb-6 rounded-2xl bg-green-500/10 text-green-600 flex items-center justify-center text-3xl group-hover:bg-green-600 group-hover:text-white transition-colors">↺</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Đổi size miễn phí</h3>
                <p class="text-gray-500 dark:text-gray-400 leading-relaxed">Hỗ trợ đổi size trong vòng 30 ngày. Thủ tục nhanh gọn, tận nhà.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 dark:bg-black">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-black uppercase italic text-gray-900 dark:text-white text-center mb-10">
            Chọn phong cách <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Của bạn</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[500px] md:h-[400px]">
            <a href="index.php?url=products&category=men" class="group relative overflow-hidden rounded-3xl h-full">
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                <div class="absolute bottom-6 left-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Giày Nam</h3>
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-md text-white rounded-lg text-sm group-hover:bg-yellow-500 group-hover:text-black transition-colors">Khám phá &rarr;</span>
                </div>
            </a>
            <a href="index.php?url=products&category=women" class="group relative overflow-hidden rounded-3xl h-full">
                <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                <div class="absolute bottom-6 left-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Giày Nữ</h3>
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-md text-white rounded-lg text-sm group-hover:bg-yellow-500 group-hover:text-black transition-colors">Khám phá &rarr;</span>
                </div>
            </a>
            <a href="index.php?url=products&category=sale" class="group relative overflow-hidden rounded-3xl h-full">
                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                    onerror="this.onerror=null; this.src='https://dummyimage.com/600x800/cc0000/fff&text=HOT+SALE';"
                    alt="Hot Sale" 
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    
                <div class="absolute inset-0 bg-gradient-to-t from-red-600/90 via-red-600/20 to-transparent"></div>
                
                <div class="absolute bottom-6 left-6">
                    <h3 class="text-3xl font-black text-white mb-2 italic">HOT SALE</h3>
                    <span class="inline-block px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold shadow-lg animate-bounce">
                        Giảm đến 50%
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

<section id="store-gallery" class="py-20 bg-white dark:bg-[#111111] overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black uppercase italic text-gray-900 dark:text-white">
                    Check-in <span class="text-yellow-500">Tại Store</span>
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-lg">Không gian mua sắm hiện đại với hàng ngàn mẫu sneakers hot nhất hiện nay.</p>
            </div>
            <div class="hidden md:block">
                 <a href="#" class="text-sm font-bold text-gray-400 hover:text-white border-b border-transparent hover:border-yellow-500 transition-all">Xem tất cả hình ảnh</a>
            </div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[500px]">
            <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-3xl h-64 md:h-auto border border-gray-100 dark:border-gray-800">
                <img src="<?= URLROOT ?>/public/uploads/sneakershop.jpg" onerror="this.src='https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?auto=format&fit=crop&w=800'" alt="Store" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 filter brightness-90 group-hover:brightness-100">
                <div class="absolute bottom-0 left-0 p-6 bg-gradient-to-t from-black/80 to-transparent w-full">
                     <p class="text-white font-bold text-lg translate-y-4 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">🔥 Khu vực trưng bày Limited</p>
                </div>
            </div>
            <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-3xl h-40 md:h-auto">
                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-3xl h-40 md:h-auto">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="col-span-2 md:col-span-2 row-span-1 relative group overflow-hidden rounded-3xl h-48 md:h-auto bg-gray-800">
                <img src="<?= URLROOT ?>/public/uploads/map.png" onerror="this.src='https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=800'" alt="Map" class="w-full h-full object-cover opacity-60 group-hover:opacity-30 transition-opacity">
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-yellow-500 text-3xl font-bold mb-2">DO & TAN STORE</span>
                    <a href="https://www.google.com/maps/search/?api=1&query=Trường+Đại+học+Bách+khoa+-+ĐHQG+TP.HCM+Cơ+sở+Dĩ+An" target="_blank" class="glass-effect px-6 py-2 rounded-full text-white font-bold hover:bg-white hover:text-black transition-all transform hover:scale-105">
                        📍 Dẫn đường ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="news" class="py-20 bg-gray-50 dark:bg-black border-t border-gray-200 dark:border-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black uppercase italic text-gray-900 dark:text-white">
                News <span class="text-stroke text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">& Updates</span>
            </h2>
            <p class="text-gray-500 mt-4">Cập nhật xu hướng thời trang mới nhất mỗi ngày</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                    <article class="bg-white dark:bg-[#151515] rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-800 flex flex-col group h-full">
                        <div class="h-56 overflow-hidden relative">
                            <a href="index.php?url=news/detail&id=<?= $news->id ?>">
                                <?php if (!empty($news->featured_image_url)): ?>
                                    <?php 
                                        // Kiểm tra: Nếu link ảnh bắt đầu bằng "http" (link ngoài) thì giữ nguyên
                                        // Nếu không (ảnh trong máy) thì nối thêm URLROOT
                                        $imgSrc = (strpos($news->featured_image_url, 'http') === 0) 
                                                ? $news->featured_image_url 
                                                : URLROOT . $news->featured_image_url;
                                    ?>
                                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($news->title) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-500">No Image</div>
                                <?php endif; ?>
                            </a>
                            <div class="absolute top-4 left-4 bg-yellow-400 text-black text-xs font-bold px-3 py-1 rounded-md shadow-md">
                                NEW
                            </div>
                            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col relative">
                            <div class="absolute -top-6 right-6 bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg text-center min-w-[60px] border border-gray-100 dark:border-gray-700">
                                <span class="block text-xl font-bold text-gray-900 dark:text-white"><?= date('d', strtotime($news->created_at)) ?></span>
                                <span class="block text-xs text-gray-500 uppercase"><?= date('M', strtotime($news->created_at)) ?></span>
                            </div>

                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white group-hover:text-yellow-500 transition-colors line-clamp-2 mt-2">
                                <a href="index.php?url=news/detail&id=<?= $news->id ?>">
                                    <?= htmlspecialchars($news->title) ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-4 flex-1">
                                <?= !empty($news->seo_description) ? htmlspecialchars($news->seo_description) : strip_tags(substr($news->content, 0, 150)) . '...' ?>
                            </p>
                            
                            <a href="index.php?url=news/detail&id=<?= $news->id ?>" class="inline-flex items-center text-yellow-600 font-bold text-sm uppercase tracking-wide hover:gap-2 transition-all">
                                Đọc chi tiết <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-12 text-gray-500 border-2 border-dashed border-gray-700 rounded-xl">
                    Chưa có tin tức nào được cập nhật.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-24 relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?auto=format&fit=crop&w=1920" class="w-full h-full object-cover opacity-20 filter blur-sm">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="container relative mx-auto px-4 text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Đừng bỏ lỡ các đợt phát hành mới!</h2>
            <p class="text-gray-400 mb-8">Đăng ký nhận thông tin về các mẫu giày Limited, mã giảm giá độc quyền từ Do & Tan Sneakers.</p>
            
            <form id="newsletterForm" class="flex flex-col sm:flex-row gap-3 relative z-10">
                <input type="email" name="email" required placeholder="Nhập email của bạn..." class="flex-1 px-6 py-4 rounded-full bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-yellow-500 backdrop-blur-md transition-colors">
                
                <button type="submit" id="btnSubscribe" class="px-8 py-4 bg-yellow-500 text-black font-bold rounded-full hover:bg-yellow-400 transition-colors shadow-lg shadow-yellow-500/30 flex items-center justify-center gap-2">
                    <span>Đăng Ký Ngay</span>
                    <svg id="loadingIcon" class="animate-spin h-5 w-5 text-black hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
            
            <div id="msgNotify" class="mt-4 text-sm font-semibold h-6 text-transparent">...</div>

            <div class="flex justify-center gap-8 mt-12 border-t border-gray-700 pt-8" id="stats-section">
                <div class="text-center">
                    <span class="counter-num block text-3xl font-black text-white" data-target="10" data-suffix="+">0</span>
                    <span class="text-sm text-gray-400">Năm kinh nghiệm</span>
                </div>
                <div class="text-center">
                    <span class="counter-num block text-3xl font-black text-white" data-target="50" data-suffix="k+">0</span>
                    <span class="text-sm text-gray-400">Khách hàng hài lòng</span>
                </div>
                <div class="text-center">
                    <span class="counter-num block text-3xl font-black text-white" data-target="100" data-suffix="%">0</span>
                    <span class="text-sm text-gray-400">Chính hãng</span>
                </div>

                <script src="<?= URLROOT ?>/public/js/counter.js"></script>
            </div>
        </div>
    </div>
</section>
