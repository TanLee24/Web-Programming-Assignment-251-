<?php
// DÒNG NÀY PHẢI LUÔN Ở ĐẦU
session_start();

// 1. REQUIRE CÁC FILE CẦN THIẾT
require_once '../app/config.php'; 
require_once '../app/libraries/Database.php'; 

// 2. XỬ LÝ ĐỊNH TUYẾN (ROUTING LOGIC) 

// Lấy tham số 'url' từ query string
$url = isset($_GET['url']) ? $_GET['url'] : null;

if($url){
    // Loại bỏ ký tự thừa và chuyển URL thành mảng [Controller, Action, Params]
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
} else {
    // Mặc định về trang chủ
    $url = ['pages', 'home']; 
}

// 3. XÁC ĐỊNH VÀ GỌI CONTROLLER
$controllerSegment = $url[0];

// Xử lý logic Admin (controller nằm trong sub-folder)
if ($controllerSegment === 'admin') {
    // Ví dụ: url[1] = 'product', url[2] = 'list'
    $controllerName = 'Admin' . ucwords($url[1]) . 'Controller';
    $controllerPath = '../app/controllers/admin/' . $controllerName . '.php';
    $actionIndex = 2; // action là phần tử thứ 3 (index 2)
    
} else {
    // Xử lý logic Public (controller nằm ngoài)
    $controllerName = ucwords($controllerSegment) . 'Controller';
    $controllerPath = '../app/controllers/' . $controllerName . '.php';
    $actionIndex = 1; // action là phần tử thứ 2 (index 1)
}


// 4. KIỂM TRA VÀ THỰC THI
if(file_exists($controllerPath)){
    require_once $controllerPath;
    
    // Khởi tạo Controller (Ví dụ: new ProductsController)
    $controller = new $controllerName;

    // Xác định Action (method)
    $action = isset($url[$actionIndex]) ? $url[$actionIndex] : 'index';

    // Xác định Params (tham số sau action)
    $params = $actionIndex >= count($url) ? [] : array_slice($url, $actionIndex + 1);

    // Kiểm tra Action có tồn tại trong Controller không
    if(method_exists($controller, $action)){
        // Gọi method và truyền Params (ví dụ: detail(123))
        call_user_func_array([$controller, $action], $params);
    } else {
        die('Lỗi 404: Không tìm thấy phương thức (Action) "' . $action . '"');
    }

} else {
    die('Lỗi 404: Không tìm thấy Controller "' . $controllerName . '"');
}

if ($url == "products/addToCartAjax") {
    require "../app/controllers/ProductsController.php";
    $c = new ProductsController();
    $c->addToCartAjax();
    exit;
}

// AJAX: Cập nhật số lượng giỏ hàng (tăng/giảm)
if ($url == "products/updateQuantity") {
    require "../app/controllers/ProductsController.php";
    $c = new ProductsController();
    $c->updateQuantity();
    exit;
}
