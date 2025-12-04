<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Thêm bài viết mới</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= URLROOT ?>/public/index.php?url=admin/news/create" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label required">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label required">Nội dung</label>
                    <textarea class="form-control" name="content" rows="10" required></textarea>
                </div>

                <div class="card-footer text-end bg-transparent mt-4">
                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/list" class="btn btn-link link-secondary">Hủy</a>
                    <button type="submit" class="btn btn-primary">Đăng bài</button>
                </div>
            </form>
        </div>
    </div>
</div>