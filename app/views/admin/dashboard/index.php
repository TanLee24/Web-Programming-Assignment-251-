<div class="container mt-4">
    <h1>Trang quản trị</h1>
    <p>Chào mừng bạn đến trang Admin Panel.</p>

    <div class="row mt-4">
        <div class="col-12 mb-2">
            <h5 class="text-muted">Quản lý chung </h5>
        </div>

        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/settings/index" class="btn btn-dark w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill mb-1" viewBox="0 0 16 16">
                  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
                Cấu hình chung
            </a>
        </div>

        <div class="col-md-3">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/contact/list" class="btn btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill mb-1" viewBox="0 0 16 16">
                  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                </svg>
                Liên hệ khách hàng
            </a>
        </div>
    </div>

    <hr> <div class="row mt-4">
        <div class="col-12 mb-2">
            <h5 class="text-muted">Module quản lý bán hàng</h5>
        </div>

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