<div class="container mt-4">
    <h1>Trang quản trị</h1>
    <p>Chào mừng bạn đến trang Admin Panel.</p>

    <div class="row mt-4">
        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/product/list" class="btn btn-primary w-100">Quản lý sản phẩm</a>
        </div>

        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/order/list" class="btn btn-success w-100">Quản lý đơn hàng</a>
        </div>

        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/list" class="btn btn-warning w-100">Quản lý FAQ</a>
        </div>

        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/about/index" class="btn btn-info w-100">Quản lý Giới thiệu</a>
        </div>
    </div>
</div>
