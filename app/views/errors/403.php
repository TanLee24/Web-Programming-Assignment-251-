<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không có quyền truy cập</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; background: #f4f6f8; }
        h1 { font-size: 50px; color: #d9534f; margin-bottom: 10px; }
        p { font-size: 20px; color: #666; }
        a { text-decoration: none; color: #007bff; font-weight: bold; }
        a:hover { text-decoration: underline; }
        .icon { font-size: 80px; margin-bottom: 20px; display: block; }
    </style>
</head>
<body>
    <div class="icon">⛔</div>
    <h1>Truy cập bị từ chối (403)</h1>
    <p>Xin lỗi, bạn không có quyền truy cập vào trang quản trị này.</p>
    
    <p>Vui lòng <a href="<?php echo URLROOT; ?>/public/index.php?url=auth/login">Đăng nhập</a> bằng tài khoản Admin hoặc <a href="<?php echo URLROOT; ?>/public/index.php">Quay về trang chủ</a>.</p>
</body>
</html>