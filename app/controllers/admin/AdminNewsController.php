<?php
// File: app/controllers/AdminNewsController.php
require_once APPROOT . "/models/News.php";

class AdminNewsController {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new News();
    }

    // 1. Danh sách tin tức
    public function list() {
        $keyword = $_GET['search'] ?? null;
        $newsList = $this->newsModel->all($keyword);
        $title = "Quản lý Tin tức";

        // Load View Admin
        ob_start();
        require APPROOT . "/views/admin/news/list.php"; // File chứa bảng danh sách
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 2. Thêm bài viết
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content']; 
            
            // Xử lý upload ảnh
            $imgUrl = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $filename = time() . "_" . basename($_FILES['image']['name']);
                $targetPath = dirname(APPROOT) . "/public/uploads/" . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imgUrl = "/public/uploads/" . $filename;
                }
            }

            $this->newsModel->create($title, $content, $imgUrl);
            header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
            exit;
        }

        $title = "Thêm tin tức mới";
        ob_start();
        require APPROOT . "/views/admin/news/create.php"; // Bạn cần tạo view này
        $content = ob_get_clean();
        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 3. Sửa bài viết
    public function edit() {
        $id = $_GET['id'] ?? null;
        $news = $this->newsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            // Giữ ảnh cũ nếu không up ảnh mới
            $imgUrl = $news->featured_image_url; 
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $filename = time() . "_" . basename($_FILES['image']['name']);
                $targetPath = dirname(APPROOT) . "/public/uploads/" . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imgUrl = "/public/uploads/" . $filename;
                }
            }

            $this->newsModel->update($id, $title, $content, $imgUrl);
            header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
            exit;
        }

        $title = "Sửa bài viết";
        ob_start();
        require APPROOT . "/views/admin/news/edit.php"; // Bạn cần tạo view này
        $content = ob_get_clean();
        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 4. Xóa bài viết
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->newsModel->delete($id);
        }
        header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
        exit;
    }
}