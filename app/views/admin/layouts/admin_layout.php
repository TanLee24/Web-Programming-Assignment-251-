<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? "Admin Dashboard"; ?></title>

    <!-- Tabler CSS -->
    <link href="/public/admin/dist/css/tabler.css" rel="stylesheet"/>
    <link href="/public/admin/dist/css/tabler-vendors.css" rel="stylesheet"/>
</head>

<body class="layout-fluid">
    <div class="page">

        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-xl">
                <a class="navbar-brand" href="/public/index.php?url=admin/faq/list">
                    <span class="navbar-brand-text">Admin Panel</span>
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="page-wrapper">
            <div class="container-xl mt-3">
                <?php echo $content; ?>
            </div>
        </div>

    </div>

    <!-- Tabler JS -->
    <script src="/public/admin/dist/js/tabler.js"></script>
</body>
</html>
