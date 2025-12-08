<style>
    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="container mx-auto py-16 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <div class="relative group">
            <div class="aspect-w-1 aspect-h-1 bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700">
                <img 
                    src="<?= URLROOT . $product->image_url ?>"
                    alt="<?= htmlspecialchars($product->name) ?>" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    onerror="this.src='https://placehold.co/600x600?text=No+Image'"
                />
            </div>
        </div>

        <div class="flex flex-col justify-start">
            <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-2 leading-tight">
                <?= htmlspecialchars($product->name) ?>
            </h1>
            
            <div class="flex items-center gap-4 mb-6">
                <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-full text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    <?= htmlspecialchars($product->brand ?? 'Sneaker') ?>
                </span>
                
                <?php if(isset($product->sale_price) && $product->sale_price < $product->price): ?>
                    <p class="text-3xl font-bold text-red-500">
                        <?= number_format($product->sale_price) ?> đ
                    </p>
                    <p class="text-xl text-gray-400 line-through">
                        <?= number_format($product->price) ?> đ
                    </p>
                <?php else: ?>
                    <p class="text-3xl font-bold text-red-500">
                        <?= number_format($product->price) ?> đ
                    </p>
                <?php endif; ?>
            </div>

            <div class="prose prose-lg dark:prose-invert mb-8 text-gray-600 dark:text-gray-400 max-w-none">
                <?= $product->description ?>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-auto">
                <div class="flex flex-wrap gap-4 items-end">
                    
                    <div>
                        <label class="block font-bold text-sm text-gray-700 dark:text-gray-300 mb-2">Số lượng</label>
                        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                            <button onclick="this.nextElementSibling.stepDown()" class="px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors font-bold text-lg">-</button>
                            
                            <input id="quantity" type="number" value="1" min="1" class="w-12 py-2 text-center border-0 bg-transparent focus:ring-0 appearance-none font-bold text-gray-900 dark:text-white">
                            
                            <button onclick="this.previousElementSibling.stepUp()" class="px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors font-bold text-lg">+</button>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-sm text-gray-700 dark:text-gray-300 mb-2">Chọn Size</label>
                        <select id="size" class="w-32 p-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">-- Size --</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                        </select>
                    </div>
                    
                    <button 
                        id="btnAddToCart"
                        data-id="<?= $product->id ?>"
                        class="flex-grow bg-yellow-500 hover:bg-yellow-400 text-black font-black py-3 px-8 rounded-lg uppercase tracking-wider transition-all transform hover:-translate-y-1 shadow-lg flex items-center justify-center gap-2 h-[46px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        Thêm vào giỏ
                    </button>
                    
                </div>
                
                <div class="mt-6">
                    <a href="<?= URLROOT ?>/public/san-pham"
                       class="text-sm font-medium text-gray-500 hover:text-yellow-600 flex items-center gap-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// (Giữ nguyên phần Script cũ của bạn ở đây)
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
            sizeInput.classList.add('border-red-500', 'ring-1', 'ring-red-500');
            sizeInput.focus();
            alert("Bạn quên chọn Size rồi kìa! 😅");
            return;
        } else {
            sizeInput.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
        }

        const originalText = btn.innerHTML;
        btn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Đang xử lý...';
        btn.disabled = true;

        fetch("<?= URLROOT ?>/public/index.php?url=products/addToCartAjax", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "product_id=" + encodeURIComponent(productId) + "&quantity=" + encodeURIComponent(quantity) + "&size=" + encodeURIComponent(size)
        })
        .then(res => res.json())
        .then(data => {
            btn.innerHTML = originalText;
            btn.disabled = false;

            if (data.success) {
                window.dispatchEvent(new CustomEvent("cartUpdated", { detail: { cartCount: data.cartCount } }));
                alert("✅ Đã thêm vào giỏ hàng thành công!");
            } else {
                alert("❌ Lỗi: " + (data.message || "Không thể thêm vào giỏ"));
            }
        })
        .catch(err => {
            console.error(err);
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert("⚠️ Lỗi kết nối đến Server.");
        });
    });
});
</script>