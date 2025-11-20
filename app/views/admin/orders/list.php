<div class="container mt-4">
    <h2 class="mb-4">Danh sách đơn hàng</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order->id ?></td>
                    <td><?= $order->fullname ?></td>
                    <td><?= $order->phone ?></td>
                    <td><?= $order->address ?></td>
                    <td><?= number_format($order->total_amount) ?> đ</td>

                    <td>
                        <form action="<?= URLROOT ?>/public/index.php?url=admin/order/updateStatus" method="POST">
                            <input type="hidden" name="order_id" value="<?= $order->id ?>">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="pending" <?= $order->status == "pending" ? "selected" : "" ?>>Đang xử lý</option>
                                <option value="processing" <?= $order->status == "processing" ? "selected" : "" ?>>Đang giao hàng</option>
                                <option value="completed" <?= $order->status == "completed" ? "selected" : "" ?>>Hoàn thành</option>
                            </select>
                        </form>
                    </td>

                    <td><?= $order->created_at ?></td>

                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="<?= URLROOT ?>/public/index.php?url=admin/order/detail/<?= $order->id ?>">
                           Xem
                        </a>

                        <a class="btn btn-danger btn-sm"
                           href="<?= URLROOT ?>/public/index.php?url=admin/order/delete/<?= $order->id ?>"
                           onclick="return confirm('Xóa đơn hàng này?')">
                           Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
