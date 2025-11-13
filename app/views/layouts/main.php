<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; // Lấy tiêu đề từ controller ?></title>
    <style>
        /* CSS Tạm thời để phân biệt */
        body { font-family: Arial, sans-serif; }
        header { background: #f1f1f1; padding: 20px; text-align: center; }
        footer { background: #333; color: white; padding: 10px; text-align: center; margin-top: 20px;}
        main { min-height: 200px; padding: 20px; }
    </style>
</head>
<body>

    <header>
        <h2>Đây là HEADER (Menu Chung)</h2>
        <nav>
            <a href="http://localhost/Web-Programming-Assignment-251-/public/">Trang Chủ</a> | 
            <a href="http://localhost/Web-Programming-Assignment-251-/public/index.php?url=pages/contact">Liên Hệ</a>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; 2025 - Bài tập lớn Lập trình Web</p>
    </footer>

</body>
</html>