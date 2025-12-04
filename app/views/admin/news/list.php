<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <?= $title ?>
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="<?= URLROOT ?>/public/index.php?url=admin/news/create" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Thêm bài viết mới
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form action="" method="GET" class="d-flex gap-2">
                <input type="hidden" name="url" value="admin/news/list">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tiêu đề..." value="<?= $_GET['search'] ?? '' ?>">
                <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Ngày tạo</th>
                        <th class="w-1">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($newsList)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Chưa có bài viết nào.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($newsList as $item): ?>
                        <tr>
                            <td><span class="text-muted"><?= $item->id ?></span></td>
                            <td>
                                <?php if (!empty($item->featured_image_url)): ?>
                                    <img src="<?= URLROOT . $item->featured_image_url ?>" alt="Thumb" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="font-weight-medium text-truncate" style="max-width: 300px;">
                                    <?= htmlspecialchars($item->title) ?>
                                </div>
                                <div class="text-muted small">Slug: <?= $item->slug ?></div>
                            </td>
                            <td class="text-nowrap text-muted">
                                <?= date('d/m/Y H:i', strtotime($item->created_at)) ?>
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/edit&id=<?= $item->id ?>" class="btn btn-white btn-sm">
                                        Sửa
                                    </a>
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/news/delete&id=<?= $item->id ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                        Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>