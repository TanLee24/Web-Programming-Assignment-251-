<form method="POST" class="card p-4">
    <h3 class="card-title mb-4">Chỉnh sửa nội dung trang Giới thiệu</h3>

    <textarea name="content" class="form-control" rows="10"><?= htmlspecialchars($contentValue) ?></textarea>

    <button class="btn btn-primary mt-3">Lưu thay đổi</button>
</form>
