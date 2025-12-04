<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Thêm bài viết mới
                </h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= URLROOT ?>/public/index.php?url=admin/news/create" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label required">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <small class="form-hint">Hỗ trợ JPG, PNG, WEBP. Dung lượng tối đa 5MB.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Nội dung bài viết</label>
                    <textarea class="form-control" name="content" rows="10" placeholder="Nhập nội dung chi tiết..." required></textarea>
                </div>

                <div class="card-footer text-end bg-transparent mt-4">
                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/list" class="btn btn-link link-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        Đăng bài viết
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>