<?php
require_once APPROOT . "/models/Product.php";

class AdminProductController {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function list() {
        $keyword = $_GET['search'] ?? null;
        $products = $this->product->all($keyword);
        $title = "Quản lý sản phẩm";

        ob_start();
        require APPROOT . "/views/admin/products/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];

            // Upload ảnh
            $img = $_FILES['image'];
            $path = "/uploads/" . time() . "_" . $img['name'];
            move_uploaded_file($img['tmp_name'], APPROOT . "/../public" . $path);

            $this->product->create($name, $desc, $price, $path);
            header("Location: /public/index.php?url=admin/product/list");
            exit;
        }

        $title = "Thêm sản phẩm";

        ob_start();
        require APPROOT . "/views/admin/products/create.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function edit($id) {
        $product = $this->product->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];

            $imgUrl = $product->image_url;

            if (!empty($_FILES['image']['name'])) {
                $img = $_FILES['image'];
                $imgUrl = "/uploads/" . time() . "_" . $img['name'];
                move_uploaded_file($img['tmp_name'], APPROOT . "/../public" . $imgUrl);
            }

            $this->product->update($id, $name, $desc, $price, $imgUrl);
            header("Location: /public/index.php?url=admin/product/list");
            exit;
        }

        $title = "Sửa sản phẩm";
        ob_start();
        require APPROOT . "/views/admin/products/edit.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function delete($id) {
        $this->product->delete($id);
        header("Location: /public/index.php?url=admin/product/list");
    }
}
