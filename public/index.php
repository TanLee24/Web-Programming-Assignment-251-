<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../app/config.php';

// Tự động load tất cả Controllers
foreach (glob("../app/controllers/*.php") as $controllerFile) {
    require_once $controllerFile;
}

// ---------------------- ROUTER ----------------------

$url = isset($_GET['url']) ? $_GET['url'] : 'pages/home';
$url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
$urlParts = explode('/', $url);

// Controller
$controllerName = !empty($urlParts[0]) ? ucwords($urlParts[0]) . 'Controller' : 'PagesController';

// Method
$methodName = $urlParts[1] ?? 'home';

// Tham số
$params = array_slice($urlParts, 2);

// Kiểm tra Controller tồn tại
if (!class_exists($controllerName)) {
    $controllerName = 'PagesController';
    $methodName = 'home';
}

// Tạo controller
$controller = new $controllerName();

// Kiểm tra method tồn tại
if (!method_exists($controller, $methodName)) {
    $controllerName = 'PagesController';
    $controller = new $controllerName();
    $methodName = 'home';
}

// Gọi hàm
call_user_func_array([$controller, $methodName], $params);

?>
