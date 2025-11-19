<div class="card">
    <div class="card-header">
        <h3 class="card-title">Chỉnh sửa nội dung Giới thiệu</h3>
    </div>

    <form method="POST" action="<?php echo URLROOT; ?>/public/index.php?url=admin/about/update">
        <div class="card-body">

            <label class="form-label">Tiêu đề trang</label>
            <input type="text" name="title" class="form-control"
                   value="<?= htmlspecialchars($about->title ?? '') ?>">

            <label class="form-label mt-3">Nội dung chi tiết</label>
            <textarea name="content" class="form-control" rows="10"><?= htmlspecialchars($about->content ?? '') ?></textarea>

        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
    </form>
</div>
