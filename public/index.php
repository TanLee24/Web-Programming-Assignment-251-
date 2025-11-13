<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Nạp file config (chứa thông tin CSDL, v.v.)
require_once '../app/config.php';

// Nạp file Controller
require_once '../app/controllers/PagesController.php';

// --- BỘ ĐỊNH TUYẾN (ROUTER) ĐƠN GIẢN ---

// 1. Lấy URL mà người dùng yêu cầu (qua tham số ?url=)
// Ví dụ: ...public/index.php?url=pages/contact
$url = isset($_GET['url']) ? $_GET['url'] : 'pages/home';

// 2. Tách URL thành các phần
// $url = 'pages/contact' -> $urlParts = ['pages', 'contact']
$urlParts = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

// 3. Xác định Controller và Phương thức (Method)
// Mặc định là PagesController và phương thức home
$controllerName = 'PagesController';
$methodName = 'home';

// 4. Kiểm tra URL
if (!empty($urlParts[0])) {
    // Nếu có phần tử đầu tiên (ví dụ: 'pages')
    // Chuyển 'pages' thành 'PagesController'
    $controllerName = ucwords($urlParts[0]) . 'Controller';
}

if (!empty($urlParts[1])) {
    // Nếu có phần tử thứ hai (ví dụ: 'contact')
    $methodName = $urlParts[1];
}

// 5. Kiểm tra file Controller có tồn tại không
// (Tạm thời chúng ta chỉ có PagesController)
if ($controllerName !== 'PagesController' || !method_exists('PagesController', $methodName)) {
    // Nếu không tìm thấy, quay về trang chủ
    $controllerName = 'PagesController';
    $methodName = 'home';
}

// 6. Khởi tạo Controller
$controller = new $controllerName();

// 7. Gọi phương thức (action)
call_user_func([$controller, $methodName]);

?>