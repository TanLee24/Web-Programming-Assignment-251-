<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Chi tiết</div>
                <h2 class="page-title">Đơn hàng #<?= $order->id ?></h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="<?= URLROOT ?>/public/index.php?url=admin/order/list" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khách hàng</h3>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Họ và tên</div>
                            <div class="datagrid-content"><?= $order->fullname ?></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Số điện thoại</div>
                            <div class="datagrid-content"><?= $order->phone ?></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Ngày đặt hàng</div>
                            <div class="datagrid-content"><?= date('H:i d/m/Y', strtotime($order->created_at)) ?></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Địa chỉ giao hàng</div>
                            <div class="datagrid-content"><?= $order->address ?></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Ghi chú từ khách</div>
                            <div class="datagrid-content text-muted"><?= empty($order->note) ? 'Không có' : $order->note ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách sản phẩm mua</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Phân loại</th>
                                <th>Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $it): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2" style="background-image: url('<?= URLROOT . $it->product_image ?>')"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium"><?= $it->product_name ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= number_format($it->price_at_purchase) ?> đ</td>
                                    <td class="text-muted">Size: <?= $it->size ?></td>
                                    <td><?= $it->quantity ?></td>
                                    <td class="text-end font-weight-bold"><?= number_format($it->quantity * $it->price_at_purchase) ?> đ</td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <tr>
                                <td colspan="4" class="text-end font-weight-bold text-uppercase">Tổng giá trị đơn hàng</td>
                                <td class="text-end font-weight-bold text-primary h3"><?= number_format($order->total_amount) ?> đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>