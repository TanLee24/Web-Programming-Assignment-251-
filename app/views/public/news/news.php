<div class="bg-white dark:bg-black min-h-screen">
    <div class="bg-gray-50 dark:bg-[#111111] py-16 border-b border-gray-100 dark:border-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-black italic uppercase text-gray-900 dark:text-white mb-4">
                Tin tức <span class="text-yellow-500">& Sự kiện</span>
            </h1>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
                Cập nhật những xu hướng giày Sneaker mới nhất, mẹo bảo quản và các chương trình khuyến mãi độc quyền từ Do & Tan.
            </p>

            <form action="<?= URLROOT ?>/public/index.php" method="GET" class="max-w-xl mx-auto relative">
                <input type="hidden" name="url" value="news/index">
                <input type="text" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                    placeholder="Tìm kiếm bài viết..." 
                    class="w-full pl-6 pr-14 py-4 rounded-full bg-white dark:bg-black border border-gray-200 dark:border-gray-700 shadow-lg focus:ring-2 focus:ring-yellow-500 outline-none transition-all text-gray-900 dark:text-white">
                <button type="submit" class="absolute right-2 top-2 bg-yellow-500 hover:bg-yellow-400 text-black p-2 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <?php if (empty($newsList)): ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-xl">Không tìm thấy bài viết nào phù hợp.</p>
                <a href="<?= URLROOT ?>/public/index.php?url=news/index" class="text-yellow-500 hover:underline mt-2 inline-block">Quay lại danh sách</a>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach ($newsList as $news): ?>
                    <article class="flex flex-col bg-white dark:bg-[#1a1a1a] rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        <a href="<?= URLROOT ?>/public/tin-tuc/<?= $news->slug ?>" class="h-56 overflow-hidden relative group">
                            <?php if (!empty($news->featured_image_url)): ?>
                                <img src="<?= URLROOT . $news->featured_image_url ?>" alt="<?= htmlspecialchars($news->title) ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-gray-500">No Image</div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                        </a>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-3 font-medium uppercase tracking-wider">
                                <span>📅 <?= date('d/m/Y', strtotime($news->created_at)) ?></span>
                                <span>•</span>
                                <span>Tin tức</span>
                            </div>
                            
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white leading-tight">
                                <a href="<?= URLROOT ?>/public/tin-tuc/<?= $news->slug ?>" class="hover:text-yellow-500 transition-colors">
                                    <?= htmlspecialchars($news->title) ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-6 flex-1">
                                <?= !empty($news->seo_description) ? htmlspecialchars($news->seo_description) : strip_tags(substr($news->content, 0, 150)) . '...' ?>
                            </p>
                            
                            <a href="<?= URLROOT ?>/public/tin-tuc/<?= $news->slug ?>" class="inline-flex items-center text-yellow-600 dark:text-yellow-500 font-bold text-sm uppercase tracking-wide hover:translate-x-2 transition-transform">
                                Đọc tiếp <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>