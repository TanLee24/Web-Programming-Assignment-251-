<div class="container mx-auto py-16 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="relative group">
            <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-2xl overflow-hidden">
                <img 
                    src="<?= URLROOT . $product->image_url ?>"
                    alt="<?= htmlspecialchars($product->name) ?>" 
                    class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500"
                />
            </div>
        </div>

        <div class="flex flex-col justify-center">
            <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-4">
                <?= htmlspecialchars($product->name) ?>
            </h1>
            
            <p class="text-3xl font-bold text-red-500 mb-6">
                <?= number_format($product->price) ?> đ
            </p>

            <div class="prose dark:prose-invert mb-8 text-gray-600 dark:text-gray-400">
                <?= nl2br(htmlspecialchars($product->description)) ?>
            </div>

            <div class="flex gap-4 items-center">
                <label class="font-medium text-gray-700 dark:text-gray-300">SL:</label>
                <input id="quantity" type="number" value="1" min="1" 
                       class="w-20 p-2 border rounded-lg text-center dark:bg-gray-700 dark:border-gray-600 focus:ring-yellow-500">

                <label class="font-medium text-gray-700 dark:text-gray-300">Size:</label>
                <select id="size" class="p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                </select>
                
                <button 
                    id="btnAddToCart"
                    data-id="<?= $product->id ?>"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg uppercase tracking-wider transition-all transform hover:scale-[1.02] active:scale-95">
                    Thêm vào giỏ
                </button>
                
                <a href="<?= URLROOT ?>/public/index.php?url=products/index"
                   class="px-8 py-3 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-bold transition">
                    Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const btn = document.getElementById('btnAddToCart');
    const qtyInput = document.getElementById('quantity');
    const sizeInput = document.getElementById('size');

    if (!btn || !qtyInput || !sizeInput) return;

    btn.addEventListener('click', function () {

        const productId = this.dataset.id;
        const quantity = qtyInput.value || 1;
        const size = sizeInput.value;

        if (!size) {
            alert("Vui lòng chọn size!");
            return;
        }

        fetch("<?= URLROOT ?>/public/index.php?url=products/addToCartAjax", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body:
                "product_id=" + encodeURIComponent(productId) +
                "&quantity=" + encodeURIComponent(quantity) +
                "&size=" + encodeURIComponent(size)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {

                // Bắn event để main.php cập nhật icon giỏ
                window.dispatchEvent(new CustomEvent("cartUpdated", {
                    detail: { cartCount: data.cartCount }
                }));

                // Toast
                alert("Đã thêm sản phẩm vào giỏ!");
            } else {
                alert("Có lỗi xảy ra.");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Không thể kết nối server.");
        });
    });
});
</script>

