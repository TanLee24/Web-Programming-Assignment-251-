<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách FAQ</h3>
        <a href="/public/index.php?url=admin/faq/create" class="btn btn-primary ms-auto">Thêm mới</a>
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
                        <a href="/public/index.php?url=admin/faq/edit/<?= $item->id ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/public/index.php?url=admin/faq/delete/<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa câu hỏi này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
