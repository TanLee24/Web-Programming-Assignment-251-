<section class="max-w-6xl mx-auto py-12">
    <h1 class="text-4xl font-bold mb-8">Sản phẩm</h1>

    <form class="mb-6" method="GET">
        <input class="border px-4 py-2 rounded" type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." />
    </form>

    <div class="grid grid-cols-3 gap-6">
        <?php foreach ($products as $p): ?>
            <a class="block border rounded p-4 hover:shadow" href="/public/index.php?url=products/detail/<?= $p->id ?>">
                <img src="<?= $p->image_url ?>" class="w-full h-40 object-cover">
                <h2 class="font-semibold mt-2"><?= $p->name ?></h2>
                <p class="text-red-600 font-bold"><?= number_format($p->price) ?> đ</p>
            </a>
        <?php endforeach ?>
    </div>
</section>
