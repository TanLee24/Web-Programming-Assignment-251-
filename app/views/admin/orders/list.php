<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý đơn hàng</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><span class="text-muted">#<?= $order->id ?></span></td>
                            <td class="text-reset"><?= $order->fullname ?></td>
                            <td><?= $order->phone ?></td>
                            <td class="text-primary fw-bold"><?= number_format($order->total_amount) ?> đ</td>

                            <td>
                                <form action="<?= URLROOT ?>/public/index.php?url=admin/order/updateStatus" method="POST">
                                    <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                    <select name="status" class="form-select form-select-sm" 
                                            onchange="this.form.submit()"
                                            style="width: 140px; 
                                            <?= $order->status == 'completed' ? 'border-color: green; color: green;' : '' ?>
                                            <?= $order->status == 'processing' ? 'border-color: blue; color: blue;' : '' ?>">
                                        <option value="pending" <?= $order->status == "pending" ? "selected" : "" ?>>Đang xử lý</option>
                                        <option value="processing" <?= $order->status == "processing" ? "selected" : "" ?>>Đang giao hàng</option>
                                        <option value="completed" <?= $order->status == "completed" ? "selected" : "" ?>>Hoàn thành</option>
                                    </select>
                                </form>
                            </td>

                            <td class="text-muted"><?= date('d/m/Y', strtotime($order->created_at)) ?></td>

                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/order/detail/<?= $order->id ?>" class="btn btn-white btn-sm">
                                        Xem
                                    </a>
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/order/delete/<?= $order->id ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Xóa đơn hàng này?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>