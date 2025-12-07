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
                    <label class="form-label required">Tiêu đề bài viết</label>
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
                    <small class="form-hint">Chỉ chọn file nếu bạn muốn thay đổi ảnh.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Nội dung bài viết</label>
                    <textarea class="form-control tiny-editor" name="content"><?= htmlspecialchars($news->content) ?></textarea>
                </div>

                <div class="card-footer text-end bg-transparent mt-4">
                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/list" class="btn btn-link link-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        Lưu thay đổi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>