<?php
class AdminDashboardController {

    public function index() {
        $title = "Admin Dashboard";

        ob_start();
        require APPROOT . "/views/admin/dashboard/index.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }
}
