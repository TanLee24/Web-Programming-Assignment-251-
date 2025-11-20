<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? "Admin Dashboard"; ?></title>

    <!-- Tabler CSS -->
    <link href="<?= URLROOT ?>/public/admin/dist/css/tabler.css" rel="stylesheet" />
    <link href="<?= URLROOT ?>/public/admin/dist/css/tabler-vendors.css" rel="stylesheet" />
</head>

<body class="layout-fluid">
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="<?= URLROOT ?>/public/index.php?url=admin/dashboard">
                        Admin Panel
                    </a>
                </h1>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/about/index">
                                    <span class="nav-link-title">Quản lý Giới thiệu</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/faq/list">
                                    <span class="nav-link-title">Quản lý FAQ</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/product/list">
                                    <span class="nav-link-title">Quản lý Sản phẩm</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/order/list">
                                    <span class="nav-link-title">Quản lý Đơn hàng</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler JS -->
    <script src="<?= URLROOT ?>/public/admin/dist/js/tabler.js"></script>
</body>
</html>
