<article class="bg-white dark:bg-black min-h-screen pb-20">
    <div class="h-[60vh] relative w-full overflow-hidden">
        <img src="<?php echo $data['article']['image']; ?>" 
             class="w-full h-full object-cover" alt="Cover Image">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-4 md:p-12 container mx-auto">
             <a href="index.php?url=pages/news" class="inline-flex items-center text-white mb-6 hover:text-yellow-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Quay lại tin tức
            </a>
            <h1 class="text-3xl md:text-5xl font-black text-white mb-4 leading-tight">
                <?php echo $data['article']['title']; ?>
            </h1>
            <div class="flex items-center gap-6 text-gray-300">
                <span class="bg-yellow-500 text-black px-2 py-1 rounded text-xs font-bold"><?php echo $data['article']['category']; ?></span>
                <span>Đăng bởi: <strong><?php echo $data['article']['author']; ?></strong></span>
                <span>•</span>
                <span><?php echo $data['article']['date']; ?></span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-12 max-w-4xl">
        <div class="prose prose-lg dark:prose-invert mx-auto text-gray-600 dark:text-gray-300">
            <p class="lead text-xl font-medium text-gray-900 dark:text-white mb-8 border-l-4 border-yellow-500 pl-4 italic">
                <?php echo $data['article']['intro']; ?>
            </p>

            <div class="article-content">
                <?php echo $data['article']['content']; ?>
            </div>
        </div>

        <div class="mt-12 text-center border-t border-gray-200 dark:border-gray-800 pt-12">
            <p class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Bạn quan tâm đến sản phẩm / dịch vụ này?</p>
            <a href="https://www.google.com/maps/search/?api=1&query=Trường+Đại+học+Bách+khoa+-+ĐHQG+TP.HCM+Cơ+sở+Dĩ+An" 
            target="_blank" 
            class="inline-block bg-yellow-500 text-black px-12 py-4 rounded-full font-black text-lg hover:scale-105 transition-transform shadow-xl shadow-yellow-500/20">
                GHÉ CỬA HÀNG NGAY 
            </a>
        </div>
    </div>
</article>