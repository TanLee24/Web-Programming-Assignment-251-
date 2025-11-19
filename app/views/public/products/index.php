<div class="container mx-auto py-16 px-4">
    <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-10">
        <span class="text-yellow-500">Danh Mục</span> Sản Phẩm
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        <aside class="lg:col-span-1 bg-white dark:bg-[#111111] p-6 rounded-lg shadow-lg h-fit sticky top-20">
            <h3 class="text-xl font-bold mb-4 border-b pb-2 dark:border-gray-700">Lọc theo Hãng</h3>

            <ul class="space-y-2">
                <li>
                    <a href="<?= URLROOT ?>/public/index.php?url=products/index"
                       class="nav-link-filter block p-2 rounded-lg transition-colors 
                       <?= $currentBrand == null ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400' : 'hover:bg-gray-100 dark:hover:bg-gray-800' ?>">
                        Tất cả sản phẩm
                    </a>
                </li>
                
                <?php foreach ($brands as $brand): ?>
                    <li>
                        <a href="<?= URLROOT ?>/public/index.php?url=products/index&brand=<?= urlencode($brand->brand) ?>"
                           class="nav-link-filter block p-2 rounded-lg transition-colors 
                           <?= $currentBrand == $brand->brand ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400' : 'hover:bg-gray-100 dark:hover:bg-gray-800' ?>">
                            <?= htmlspecialchars($brand->brand) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <form method="GET" action="<?= URLPUBLIC ?>/index.php">
                <input type="hidden" name="url" value="products/index">

                <?php if ($currentBrand): ?>
                    <input type="hidden" name="brand" value="<?= htmlspecialchars($currentBrand) ?>">
                <?php endif; ?>

                <input class="w-full border px-3 py-2 rounded-lg dark:bg-gray-800 dark:border-gray-700"
                    type="text"
                    name="keyword"
                    placeholder="Nhập từ khóa..."
                    value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>" />

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg mt-3 hover:bg-blue-600 transition">
                    Tìm kiếm
                </button>
            </form>
        </aside>


        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (empty($products)): ?>
                    <p class="text-gray-500 col-span-3 text-center p-10">Không tìm thấy sản phẩm nào.</p>
                <?php endif; ?>
                
                <?php foreach ($products as $p): ?>
                    <a class="block border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-[#111111] hover:shadow-xl transition-all group" 
                       href="<?= URLROOT ?>/public/index.php?url=products/detail/<?= $p->id ?>">
                        <div class="h-48 overflow-hidden rounded-lg mb-4">
                            <img 
                                src="<?= URLROOT . $p->image_url ?>" 
                                alt="<?= htmlspecialchars($p->name) ?>" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                        </div>
                        
                        <h2 class="font-semibold text-lg truncate mb-1 dark:text-white"><?= htmlspecialchars($p->name) ?></h2>
                        <p class="text-red-500 font-bold"><?= number_format($p->price) ?> đ</p>
                    </a>
                <?php endforeach ?>
            </div>
            </div>

    </div>
</div>