<div class="container mx-auto py-16 px-4 max-w-5xl">
    <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-12 text-center">
        Giỏ hàng <span class="text-yellow-500">Của Bạn</span>
    </h1>

    <?php if (empty($cartItems)): ?>
        <div class="text-center py-12 bg-white dark:bg-[#1a1a1a] rounded-lg shadow">
            <p class="text-xl text-gray-500 mb-4">Giỏ hàng đang trống.</p>
            <a href="<?= URLROOT ?>/public/index.php?url=products" class="text-yellow-500 font-bold hover:underline">
                Mua sắm ngay →
            </a>
        </div>

    <?php else: ?>
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-lg overflow-hidden">

            <!-- Header -->
            <div class="hidden md:grid grid-cols-12 gap-4 p-4 border-b dark:border-gray-800 font-bold text-gray-500 uppercase text-sm bg-gray-50 dark:bg-gray-900">
                <div class="col-span-6">Sản phẩm</div>
                <div class="col-span-2 text-center">Đơn giá</div>
                <div class="col-span-2 text-center">Số lượng</div>
                <div class="col-span-2 text-right">Thành tiền</div>
            </div>

            <!-- Items -->
            <?php foreach ($cartItems as $item): ?>
                <?php $cartKey = $item->id . "-" . $item->size; ?>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 border-b dark:border-gray-800 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">

                    <!-- name + image -->
                    <div class="col-span-12 md:col-span-6 flex items-center gap-4">
                        <img src="<?= URLROOT . $item->image_url ?>" class="w-20 h-20 object-cover rounded border dark:border-gray-700">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">
                                <?= $item->name ?> 
                                <span class="text-sm text-gray-500">(Size: <?= $item->size ?>)</span>
                            </h3>

                            <a href="<?= URLROOT ?>/public/index.php?url=products/remove/<?= $cartKey ?>"
                               class="text-xs text-red-500 hover:underline mt-1 inline-block">Xóa</a>
                        </div>
                    </div>

                    <!-- price -->
                    <div class="col-span-4 md:col-span-2 md:text-center text-gray-600 dark:text-gray-400">
                        <?= number_format($item->price) ?> đ
                    </div>

                    <!-- quantity control -->
                    <div class="col-span-4 md:col-span-2 text-center flex items-center justify-center gap-2">

                        <button class="btn-decrease bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded font-bold"
                                data-key="<?= $cartKey ?>">-</button>

                        <input type="number"
                            value="<?= $item->quantity ?>"
                            min="1"
                            class="quantity-input w-14 text-center p-1 border rounded dark:bg-gray-700 dark:border-gray-600"
                            data-key="<?= $cartKey ?>">

                        <button class="btn-increase bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded font-bold"
                                data-key="<?= $cartKey ?>">+</button>
                    </div>

                    <!-- total per item -->
                    <div class="col-span-4 md:col-span-2 text-right font-bold text-red-500 item-total"
                        id="total-<?= $cartKey ?>">
                        <?= number_format($item->total) ?> đ
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Total -->
            <div class="p-6 bg-gray-50 dark:bg-gray-900 border-t dark:border-gray-800">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xl font-bold text-gray-700 dark:text-gray-300">Tổng cộng:</span>
                    <span id="cart-grand-total" class="text-3xl font-black text-red-600">
                        <?= number_format($totalPrice) ?> đ
                    </span>
                </div>

                <!-- Checkout info -->
                <div class="text-right">
                    <div class="mt-8 bg-gray-100 dark:bg-gray-800 p-6 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 dark:text-white">Thông tin giao hàng</h3>

                        <form action="<?= URLROOT ?>/public/index.php?url=products/checkout" method="POST" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Họ và tên</label>
                                <input type="text" name="fullname" required class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Số điện thoại</label>
                                <input type="text" name="phone" required class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Địa chỉ nhận hàng</label>
                                <input type="text" name="address" required class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ghi chú</label>
                                <textarea name="note" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-8 rounded-lg uppercase shadow-lg transform transition hover:-translate-y-1">
                                    Xác nhận đặt hàng
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>


<!-- JS UPDATE QUANTITY -->
<script>
function updateQuantity(key, quantity) {
    fetch("<?= URLROOT ?>/public/index.php?url=products/updateQuantity", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "key=" + encodeURIComponent(key) + "&quantity=" + quantity
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {

            // Update item total
            document.getElementById("total-" + key).innerText =
                new Intl.NumberFormat().format(data.itemTotal) + " đ";

            // Update grand total
            document.getElementById("cart-grand-total").innerText =
                new Intl.NumberFormat().format(data.cartTotal) + " đ";

            // Update icon count
            document.getElementById("cart-count").innerText = data.cartCount;
        }
    });
}

// Increase button
document.querySelectorAll(".btn-increase").forEach(btn => {
    btn.addEventListener("click", function() {
        let key = this.dataset.key;
        let input = document.querySelector(".quantity-input[data-key='" + key + "']");
        input.value = parseInt(input.value) + 1;
        updateQuantity(key, input.value);
    });
});

// Decrease button
document.querySelectorAll(".btn-decrease").forEach(btn => {
    btn.addEventListener("click", function() {
        let key = this.dataset.key;
        let input = document.querySelector(".quantity-input[data-key='" + key + "']");
        input.value = Math.max(1, parseInt(input.value) - 1);
        updateQuantity(key, input.value);
    });
});

// Manual change
document.querySelectorAll(".quantity-input").forEach(input => {
    input.addEventListener("change", function() {
        let key = this.dataset.key;
        if (this.value < 1) this.value = 1;
        updateQuantity(key, this.value);
    });
});
</script>
