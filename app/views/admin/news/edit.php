<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <h2 class="page-title">Cập nhật bài viết</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($news->title) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh đại diện</label>
                    <?php if (!empty($news->featured_image_url)): ?>
                        <div class="mb-2">
                            <?php 
                                $imgSrc = (strpos($news->featured_image_url, 'http') === 0) 
                                          ? $news->featured_image_url 
                                          : URLROOT . $news->featured_image_url;
                            ?>
                            <img src="<?= $imgSrc ?>" alt="Current Image" style="max-height: 150px; border-radius: 8px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <small class="text-muted">Chỉ chọn file nếu bạn muốn thay đổi ảnh.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung bài viết</label>
                    <textarea class="form-control" name="content" rows="10" required><?= htmlspecialchars($news->content) ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/list" class="btn btn-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>

            </form>
        </div>
    </div>
</div>