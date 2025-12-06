<div class="bg-white dark:bg-black min-h-screen pt-8 pb-16">
    <div class="container mx-auto px-4 mb-8">
        <nav class="flex text-sm text-gray-500 dark:text-gray-400">
            <a href="<?= URLROOT ?>" class="hover:text-yellow-500">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="<?= URLROOT ?>/public/index.php?url=news/index" class="hover:text-yellow-500">Tin tức</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 dark:text-white font-medium truncate max-w-[200px]"><?= htmlspecialchars($post->title) ?></span>
        </nav>
    </div>

    <article class="container mx-auto px-4 max-w-4xl">
        <header class="mb-10 text-center">
            <div class="inline-block bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-wider">
                News & Updates
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 leading-tight">
                <?= htmlspecialchars($post->title) ?>
            </h1>
            <div class="flex items-center justify-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <?= date('d/m/Y', strtotime($post->created_at)) ?></span>
                <span>•</span>
                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> 1.2k Lượt xem</span>
            </div>
        </header>

        <?php if (!empty($post->featured_image_url)): ?>
            <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 border border-gray-100 dark:border-gray-800">
                <img src="<?= (strpos($post->featured_image_url, 'http') === 0) ? $post->featured_image_url : URLROOT . $post->featured_image_url ?>" alt="<?= htmlspecialchars($post->title) ?>" class="w-full h-auto object-cover">
            </div>
        <?php endif; ?>

        <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-a:text-yellow-600 hover:prose-a:text-yellow-500 prose-img:rounded-xl
                    text-gray-700 dark:text-gray-300 leading-relaxed">
            <?= $post->content ?>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 flex justify-between items-center">
            <div class="text-sm font-bold text-gray-900 dark:text-white">Chia sẻ bài viết:</div>
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition">F</button>
                <button class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition">T</button>
            </div>
        </div>
    </article>

    <section class="bg-gray-50 dark:bg-[#111111] py-12 mt-16 border-t border-gray-200 dark:border-gray-800">
        <div class="container mx-auto px-4 max-w-3xl">
            <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-2">
                Bình luận <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-full"><?= count($comments) ?></span>
            </h3>

            <div class="bg-white dark:bg-black p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 mb-10">
                <form action="<?= URLROOT ?>/public/index.php?url=news/comment" method="POST">
                    <input type="hidden" name="news_id" value="<?= $post->id ?>">
                    
                    <?php if(isset($_SESSION['user_name'])): ?>
                        <div class="mb-4 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                <?php 
                                    // Hiển thị avatar nhỏ của người đang đăng nhập (nếu cần)
                                    $currentUserAvatar = isset($_SESSION['user_avatar']) && !empty($_SESSION['user_avatar']) 
                                        ? URLROOT . '/public/' . $_SESSION['user_avatar'] 
                                        : "https://ui-avatars.com/api/?name=" . urlencode($_SESSION['user_name']);
                                ?>
                                <img src="<?= $currentUserAvatar ?>" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Bình luận với tư cách:</p>
                                <p class="font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($_SESSION['user_name']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 text-gray-700 dark:text-gray-300">Nội dung bình luận *</label>
                        <textarea name="content" rows="3" required placeholder="Chia sẻ suy nghĩ của bạn..." class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-[#1a1a1a] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 outline-none"></textarea>
                    </div>
                    
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-8 rounded-lg transition-all shadow-lg shadow-yellow-500/30">
                        Gửi bình luận
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <?php if (empty($comments)): ?>
                    <p class="text-center text-gray-500 italic">Chưa có bình luận nào. Hãy là người đầu tiên!</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="flex gap-4 p-6 bg-white dark:bg-black rounded-2xl border border-gray-100 dark:border-gray-800">
                            
                            <div class="flex-shrink-0">
                                <?php 
                                    // Logic mới: Chỉ hiện ảnh nếu có URL và URL đó KHÔNG PHẢI là 'default_avatar.png'
                                    $hasCustomAvatar = !empty($comment->avatar_url) && $comment->avatar_url !== 'default_avatar.png';
                                ?>

                                <?php if ($hasCustomAvatar): ?>
                                    <?php 
                                        // Kiểm tra link ảnh là link ngoài (http) hay link trong host
                                        $avatarSrc = (strpos($comment->avatar_url, 'http') === 0) 
                                            ? $comment->avatar_url 
                                            : URLROOT . '/public/' . $comment->avatar_url;
                                    ?>
                                    <img src="<?= $avatarSrc ?>" 
                                        alt="<?= htmlspecialchars($comment->user_name) ?>" 
                                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-100 dark:border-gray-700">
                                
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-xl border-2 border-white dark:border-gray-700 shadow-sm">
                                        <?= strtoupper(substr($comment->user_name ?? 'A', 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-gray-900 dark:text-white"><?= htmlspecialchars($comment->user_name ?? 'Ẩn danh') ?></h4>
                                    <span class="text-xs text-gray-500">• <?= date('H:i d/m/Y', strtotime($comment->created_at)) ?></span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                    <?= nl2br(htmlspecialchars($comment->content)) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>