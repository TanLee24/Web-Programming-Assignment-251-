<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? "Admin Dashboard"; ?></title>

    <link href="<?= URLROOT ?>/public/admin/dist/css/tabler.css" rel="stylesheet" />
    <link href="<?= URLROOT ?>/public/admin/dist/css/tabler-vendors.css" rel="stylesheet" />
</head>

<body class="layout-fluid">
    <div class="page">
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
                                <a class="nav-link" href="<?= URLROOT ?>/public/index.php?url=admin/settings/index">
                                    <span class="nav-link-title">Cấu hình chung</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= URLROOT ?>/public/index.php?url=admin/contact/list">
                                    <span class="nav-link-title">Liên hệ khách hàng</span>
                                </a>
                            </li>

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

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/news/list">
                                    <span class="nav-link-title">Quản lý Tin tức</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URLROOT; ?>/public/index.php?url=admin/user/index">
                                    <span class="nav-link-title">Quản lý Thành viên</span>
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

    <script src="<?= URLROOT ?>/public/admin/dist/js/tabler.js"></script>

    <script src="https://cdn.tiny.cloud/1/3cfv05eoz2msrztbf5793c9pmvvgf7v6a2qjptgco1thyphp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.tiny-editor', // Script sẽ áp dụng cho bất kỳ thẻ nào có class này
        height: 400,
        menubar: false,
        statusbar: false,
        plugins: [
          'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
          'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
          'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }'
      });
    </script>
</body>
</html>