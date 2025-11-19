<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách sản phẩm</h3>

        <form class="ms-auto" method="GET">
            <input type="hidden" name="url" value="admin/product/list">
            <input class="form-control" type="text" name="search" placeholder="Tìm kiếm..." />
        </form>

        <a href="<?= URLROOT ?>/public/index.php?url=admin/product/create" 
           class="btn btn-primary ms-2">Thêm</a>
    </div>

    <table class="table card-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p->id ?></td>
                <td><?= $p->name ?></td>
                <td><?= number_format($p->price) ?> đ</td>
                <td><img src="<?= URLROOT . $p->image_url ?>" width="60"></td>
                <td>
                    <a class="btn btn-warning"
                       href="<?= URLROOT ?>/public/index.php?url=admin/product/edit/<?= $p->id ?>">
                        Sửa
                    </a>

                    <a class="btn btn-danger"
                       onclick="return confirm('Xóa?')"
                       href="<?= URLROOT ?>/public/index.php?url=admin/product/delete/<?= $p->id ?>">
                        Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
