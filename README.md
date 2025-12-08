# DO & TAN SNEAKERS - WEBSITE KINH DOANH GIÀY TRỰC TUYẾN
> **Bài tập lớn môn Lập trình Web (HK251)**
> **Đề tài:** Thiết kế giao diện và xây dựng các tính năng cơ bản cho website công ty - doanh nghiệp.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Tabler](https://img.shields.io/badge/Tabler-UI-blue?style=for-the-badge)

## 📖 Giới thiệu
Dự án xây dựng một website thương mại điện tử hoàn chỉnh cho cửa hàng **Do & Tan Sneakers**. Hệ thống được xây dựng hoàn toàn bằng **PHP thuần (Native PHP)** theo mô hình **MVC (Model-View-Controller)** tự xây dựng, không sử dụng Framework có sẵn, tuân thủ nghiêm ngặt yêu cầu đồ án.

## 🚀 Công nghệ sử dụng
* **Mô hình kiến trúc:** MVC (Custom Framework).
* **Backend:** PHP (Phiên bản 8.x), MySQL (Sử dụng PDO).
* **Frontend (Khách hàng):** HTML5, CSS3, Tailwind CSS (CDN), Javascript thuần.
* **Frontend (Admin):** Tabler UI (Admin Template), Hugerte (Rich Text Editor), ApexCharts, DropzoneJS.
* **Môi trường phát triển:** XAMPP, Visual Studio Code.

## ✨ Tính năng hệ thống

### 1. Phân hệ Khách hàng (Client-side)
* **Tài khoản:** Đăng ký, Đăng nhập, Quên mật khẩu, Cập nhật thông tin cá nhân (Avatar, Bio).
* **Sản phẩm:** Xem danh sách dạng lưới, lọc theo Thương hiệu, Tìm kiếm sản phẩm, Xem chi tiết (Zoom ảnh, chọn Size).
* **Giỏ hàng:** Thêm vào giỏ (AJAX Realtime), Cập nhật số lượng, Xóa sản phẩm.
* **Đặt hàng:** Thanh toán đơn giản, lưu thông tin giao hàng.
* **Nội dung:** Xem Tin tức/Blog, Trang Giới thiệu, Hỏi đáp (FAQ), Gửi liên hệ.

### 2. Phân hệ Quản trị (Admin Dashboard)
* **Dashboard:** Biểu đồ thống kê doanh thu, số lượng đơn hàng, sản phẩm bán chạy.
* **Quản lý Sản phẩm:** Thêm/Sửa/Xóa, Upload ảnh (Kéo thả), Quản lý kho hàng theo từng Size.
* **Quản lý Đơn hàng:** Xem chi tiết đơn hàng, Cập nhật trạng thái đơn (Chờ xử lý -> Đang giao -> Hoàn thành).
* **Quản lý Nội dung:** Soạn thảo Tin tức, FAQ, Trang Giới thiệu với trình soạn thảo văn bản chuyên nghiệp.
* **Cấu hình:** Thay đổi thông tin hệ thống (Logo, Hotline, Địa chỉ) trực tiếp trên web.

## 🛠 Hướng dẫn cài đặt (Installation)

Để chạy dự án trên máy cục bộ (Localhost), vui lòng làm theo các bước sau:

**Bước 1: Clone hoặc tải source code**
Giải nén thư mục dự án vào thư mục `htdocs` của XAMPP. Ví dụ: `C:/xampp/htdocs/Web-Programming-Assignment-251`

**Bước 2: Cấu hình Cơ sở dữ liệu**
1. Mở **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Tạo một database mới tên là: `web_asgmt_database`.
3. Import file `database/schema.sql` vào database vừa tạo.

**Bước 3: Cấu hình ứng dụng**
Mở file `app/config.php` và chỉnh sửa lại `URLROOT` cho đúng với đường dẫn máy bạn:

```php
// app/config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_asgmt_database');