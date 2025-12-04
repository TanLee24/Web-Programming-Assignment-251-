<?php
// --- KẾT NỐI DATABASE ĐỂ LẤY CẤU HÌNH ---
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

<section id="home" class="relative py-20 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-gray-800 opacity-90"></div>
    <div class="container relative mx-auto px-4 text-center z-10">
        <h2 id="hero-title" class="text-5xl md:text-7xl font-black mb-6 text-white tracking-tight uppercase italic">
            <?= $company_name ?>
        </h2>
        <p id="hero-subtitle" class="text-xl md:text-2xl mb-8 text-gray-300 font-light">
            <?= $intro_text ?>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="index.php?url=products" class="bg-yellow-500 text-black px-8 py-3 rounded-full font-bold hover:bg-yellow-400 hover:scale-105 transition-all shadow-lg shadow-yellow-500/30">
                Xem Bộ Sưu Tập
            </a> 
            <a href="index.php?url=pages/contact" class="border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-black hover:scale-105 transition-all">
                Liên hệ Mua Hàng
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-white dark:bg-black">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-8 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-[#111111] hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mb-4 rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl">🚚</div>
                <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Giao hàng siêu tốc</h3>
                <p class="text-gray-600 dark:text-gray-400">Nhận hàng trong 2h nội thành. Miễn phí ship đơn > 500k.</p>
            </div>
            <div class="p-8 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-[#111111] hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mb-4 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">🛡️</div>
                <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Bảo hành chính hãng</h3>
                <p class="text-gray-600 dark:text-gray-400">Cam kết 100% Authentic. Hoàn tiền gấp đôi nếu phát hiện Fake.</p>
            </div>
            <div class="p-8 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-[#111111] hover:-translate-y-2 transition-transform duration-300">
                <div class="w-14 h-14 mb-4 rounded-xl bg-green-100 text-green-600 flex items-center justify-center text-2xl">↺</div>
                <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Đổi trả linh hoạt</h3>
                <p class="text-gray-600 dark:text-gray-400">30 ngày đổi trả miễn phí không cần lý do.</p>
            </div>
        </div>
    </div>
</section>

<section id="store-gallery" class="py-16 bg-gray-50 dark:bg-[#111111] overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black uppercase italic text-gray-900 dark:text-white">
                Không gian <span class="text-yellow-500">Trải nghiệm</span>
            </h2>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Ghé thăm Do & Tan Store để trực tiếp cảm nhận chất lượng trên từng đôi giày.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[500px]">
            <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-2xl h-64 md:h-auto">
                <img src="<?= URLROOT ?>/public/uploads/sneakershop.jpg" alt="Toàn cảnh cửa hàng" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <span class="text-white font-bold text-xl">Không gian mua sắm hiện đại</span>
                </div>
            </div>
            <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl h-40 md:h-auto">
                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Kệ trưng bày giày" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl h-40 md:h-auto">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Khu vực thử giày" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="col-span-2 md:col-span-2 row-span-1 relative group overflow-hidden rounded-2xl h-48 md:h-auto">
                <img src="<?= URLROOT ?>/public/uploads/map.png" alt="Kho giày đa dạng" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="https://www.google.com/maps/search/?api=1&query=Trường+Đại+học+Bách+khoa+-+ĐHQG+TP.HCM+Cơ+sở+Dĩ+An" target="_blank" class="text-white border border-white px-6 py-2 rounded-full hover:bg-white hover:text-black transition-colors">Xem bản đồ đến Shop</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="news" class="py-16 bg-white dark:bg-black">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black uppercase italic text-gray-900 dark:text-white">
                    News <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">& Updates</span>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Thông tin mới nhất về Sneaker & Streetwear</p>
            </div>
            <a href="index.php?url=news/index" class="hidden md:inline-block text-yellow-600 hover:text-yellow-500 font-bold hover:underline">
                Xem tất cả bài viết →
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                    <article class="bg-white dark:bg-[#1a1a1a] rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 border border-gray-100 dark:border-gray-800 flex flex-col">
                        <div class="h-48 overflow-hidden relative group">
                            <a href="index.php?url=news/detail&id=<?= $news->id ?>">
                                <?php if (!empty($news->featured_image_url)): ?>
                                    <img src="<?= URLROOT . $news->featured_image_url ?>" alt="<?= htmlspecialchars($news->title) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-gray-500">No Image</div>
                                <?php endif; ?>
                            </a>
                            <div class="absolute top-4 left-4 bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full">
                                Tin tức
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="text-sm text-gray-400 mb-2">
                                <?= date('d/m/Y', strtotime($news->created_at)) ?>
                            </div>
                            
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white hover:text-yellow-500 transition-colors line-clamp-2">
                                <a href="index.php?url=news/detail&id=<?= $news->id ?>">
                                    <?= htmlspecialchars($news->title) ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4 flex-1">
                                <?= !empty($news->seo_description) ? htmlspecialchars($news->seo_description) : strip_tags(substr($news->content, 0, 150)) . '...' ?>
                            </p>
                            
                            <a href="index.php?url=news/detail&id=<?= $news->id ?>" class="inline-flex items-center text-yellow-600 font-semibold text-sm hover:translate-x-1 transition-transform">
                                Đọc tiếp <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-8 text-gray-500 border border-dashed dark:border-gray-700 rounded-lg">
                    Chưa có tin tức nào được cập nhật.
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-8 text-center md:hidden">
             <a href="index.php?url=news/index" class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white px-6 py-3 rounded-full font-bold hover:bg-yellow-500 hover:text-black transition-all">
                Xem tất cả bài viết
             </a>
        </div>
    </div>
</section>

<section id="about" class="py-16 bg-gray-50 dark:bg-[#111111]">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 id="about-title" class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">Về chúng tôi</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Do & Tan Sneakers là đại lý chính thức của các thương hiệu giày dép hàng đầu thế giới. Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi cam kết mang đến cho khách hàng những sản phẩm chính hãng với chất lượng tốt nhất.</p>
        </div>
    </div>
</section>