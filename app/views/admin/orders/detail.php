<div class="container mt-4">
    <h2 class="mb-4">Chi tiết đơn hàng #<?= $order->id ?></h2>

    <p><strong>Khách hàng:</strong> <?= $order->fullname ?></p>
    <p><strong>Số điện thoại:</strong> <?= $order->phone ?></p>
    <p><strong>Địa chỉ:</strong> <?= $order->address ?></p>
    <p><strong>Ghi chú:</strong> <?= $order->note ?></p>
    <p><strong>Ngày đặt:</strong> <?= $order->created_at ?></p>

    <h4 class="mt-4">Danh sách sản phẩm</h4>

    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình</th>
                <th>Giá</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($items as $it): ?>
                <tr>
                    <!-- tên sản phẩm -->
                    <td><?= $it->product_name ?></td>

                    <!-- hình sản phẩm -->
                    <td>
                        <img src="<?= URLROOT . $it->product_image ?>" width="70">
                    </td>

                    <!-- giá lúc mua -->
                    <td><?= number_format($it->price_at_purchase) ?> đ</td>

                    <!-- size -->
                    <td><?= $it->size ?></td>

                    <!-- số lượng -->
                    <td><?= $it->quantity ?></td>

                    <!-- tổng tiền -->
                    <td><?= number_format($it->quantity * $it->price_at_purchase) ?> đ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= URLROOT ?>/public/index.php?url=admin/order/list" 
       class="btn btn-secondary mt-3">Quay lại</a>
</div>
