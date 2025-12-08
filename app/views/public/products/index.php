<div class="container mx-auto py-16 px-4">
    <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-10">
        <span class="text-yellow-500">Danh Mục</span> Sản Phẩm
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        <!-- SIDEBAR -->
        <aside class="lg:col-span-1 bg-white dark:bg-[#111111] p-6 rounded-lg shadow-lg h-fit lg:sticky lg:top-20 z-10">
            
            <h3 class="text-xl font-bold mb-4 border-b pb-2 dark:border-gray-700 hidden lg:block">Lọc theo Hãng</h3>

            <ul class="space-y-2 mb-6">
                <li>
                    <a href="<?= URLROOT ?>/public/index.php?url=products/index"
                       class="nav-link-filter block p-2 rounded-lg 
                       <?= $currentBrand == null ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400' : 'hover:bg-gray-100 dark:hover:bg-gray-800' ?>">
                        Tất cả sản phẩm
                    </a>
                </li>

                <?php if (!empty($brands)): ?>
                    <?php foreach ($brands as $brand): ?>
                        <li>
                            <a href="<?= URLROOT ?>/public/index.php?url=products/index&brand=<?= urlencode($brand->brand) ?>"
                               class="nav-link-filter block p-2 rounded-lg 
                               <?= $currentBrand == $brand->brand ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400' : 'hover:bg-gray-100 dark:hover:bg-gray-800' ?>">
                                <?= htmlspecialchars($brand->brand) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <!-- Search -->
            <form method="GET" action="<?= URLROOT ?>/public/index.php">
                <input type="hidden" name="url" value="products/index">
                <?php if ($currentBrand): ?>
                    <input type="hidden" name="brand" value="<?= htmlspecialchars($currentBrand) ?>">
                <?php endif; ?>

                <div class="relative">
                    <input 
                        class="w-full border px-3 py-2 rounded-lg dark:bg-gray-800 dark:border-gray-700 focus:ring-2 focus:ring-yellow-500"
                        type="text"
                        name="keyword"
                        placeholder="Nhập tên giày..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                    />
                    <span class="absolute right-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                </div>

                <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-2 rounded-lg mt-3 hover:bg-yellow-400 transition">
                    Tìm kiếm
                </button>
            </form>
        </aside>

        <!-- PRODUCT LIST -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php if (empty($products)): ?>
                    <div class="col-span-3 text-center py-20 bg-gray-50 dark:bg-gray-800/50 rounded-xl border-2 border-dashed">
                        <p class="text-gray-500 text-lg">Không tìm thấy sản phẩm nào.</p>
                        <a href="<?= URLROOT ?>/public/index.php?url=products/index" class="text-yellow-500 hover:underline mt-2 inline-block">Xem tất cả</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <a class="block border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-[#111111] 
                               hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" 
                            href="<?= URLROOT ?>/public/san-pham/<?= $p->slug ?>">

                            <div class="h-64 overflow-hidden rounded-lg mb-4 bg-gray-100 flex items-center justify-center">
                                <img 
                                    src="<?= URLROOT . $p->image_url ?>" 
                                    alt="<?= htmlspecialchars($p->name) ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                />
                            </div>

                            <p class="text-xs text-gray-500 uppercase tracking-wide"><?= htmlspecialchars($p->brand ?? 'Sneaker') ?></p>
                            <h2 class="font-bold text-lg truncate text-gray-900 dark:text-white group-hover:text-yellow-500 transition">
                                <?= htmlspecialchars($p->name) ?>
                            </h2>
                            <p class="text-red-500 font-extrabold text-xl"><?= number_format($p->price) ?> ₫</p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <!-- PAGINATION BELOW -->
            <?php if ($totalPages > 1): ?>
                <div class="flex justify-center mt-12 mb-12">
                    <div class="flex gap-2">

                        <!-- Prev -->
                        <?php if ($currentPage > 1): ?>
                            <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                               href="?url=products/index&page=<?= $currentPage - 1 ?><?= $currentBrand ? '&brand='.$currentBrand : '' ?><?= $keyword ? '&keyword='.$keyword : '' ?>">
                               ←
                            </a>
                        <?php endif; ?>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a class="px-4 py-2 rounded 
                                <?= $i == $currentPage ? 'bg-yellow-500 text-black font-bold' : 'bg-gray-200 hover:bg-gray-300' ?>"
                               href="?url=products/index&page=<?= $i ?><?= $currentBrand ? '&brand='.$currentBrand : '' ?><?= $keyword ? '&keyword='.$keyword : '' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <!-- Next -->
                        <?php if ($currentPage < $totalPages): ?>
                            <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                               href="?url=products/index&page=<?= $currentPage + 1 ?><?= $currentBrand ? '&brand='.$currentBrand : '' ?><?= $keyword ? '&keyword='.$keyword : '' ?>">
                               →
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
