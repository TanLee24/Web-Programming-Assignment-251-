<?php
// Thông tin Cơ sở dữ liệu
define('DB_HOST', '127.0.0.1'); // hoặc 'localhost'
define('DB_USER', 'root');       // Tên người dùng CSDL
define('DB_PASS', '');           // Mật khẩu CSDL (để trống nếu dùng XAMPP mặc định)
define('DB_NAME', 'web_asgmt_database'); // Tên CSDL bạn đã tạo

// Đường dẫn gốc của ứng dụng
define('APPROOT', dirname(dirname(__FILE__))); // Trỏ về thư mục 'app'
define('URLROOT', 'http://localhost/web-programming-assignment-251-'); // Cập nhật sau