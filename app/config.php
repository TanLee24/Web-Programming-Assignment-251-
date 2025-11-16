<?php
// Thông tin Cơ sở dữ liệu
define('DB_HOST', '127.0.0.1'); // hoặc 'localhost'
define('DB_USER', 'root');       // Tên người dùng CSDL
define('DB_PASS', '');           // Mật khẩu CSDL (để trống nếu dùng XAMPP mặc định)
define('DB_NAME', 'web_asgmt_database'); // Tên CSDL bạn đã tạo

// Đường dẫn gốc của ứng dụng
//define('APPROOT', dirname(dirname(__FILE__))); // Trỏ về thư mục 'app'
//define('URLROOT', 'http://localhost/web-programming-assignment-251-'); // Cập nhật sau
//define('URLROOT', 'http://localhost/BTL_web');
define('APPROOT', dirname(__FILE__));


// Tự động lấy đường dẫn gốc dựa trên thư mục chứa project
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$folder = trim(dirname($_SERVER['SCRIPT_NAME']), '/');

define('URLROOT', $protocol . $host . '/' . $folder);
