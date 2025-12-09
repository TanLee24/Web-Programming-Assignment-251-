<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách FAQ</h3>
        <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/create" 
           class="btn btn-primary ms-auto">Thêm mới</a>
    </div>

    <table class="table card-table table-vcenter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Câu hỏi</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($faqs as $item): ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><?= htmlspecialchars($item->question) ?></td>
                    <td>
                        <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/edit/<?= $item->id ?>" 
                           class="btn btn-warning btn-sm">Sửa</a>

                        <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/delete/<?= $item->id ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa câu hỏi này?')">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
    <?php if (isset($totalPages) && $totalPages > 1): ?>
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">
            Trang <span><?= $page ?></span> / <span><?= $totalPages ?></span>
        </p>
        <ul class="pagination m-0 ms-auto">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/faq/list&page=<?= $page - 1 ?>">
                    Trước
                </a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == 1 || $i == $totalPages || ($i >= $page - 2 && $i <= $page + 2)): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/faq/list&page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php elseif ($i == $page - 3 || $i == $page + 3): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/faq/list&page=<?= $page + 1 ?>">
                    Sau
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
    </div> 
</div>
