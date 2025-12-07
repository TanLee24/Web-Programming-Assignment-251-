<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cập nhật sản phẩm</h3>
    </div>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label required">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control"
                               value="<?= htmlspecialchars($product->name) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Mô tả</label>
                        <textarea name="description" class="form-control tiny-editor" rows="5"><?= htmlspecialchars($product->description) ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label required">Giá</label>
                        <div class="input-group input-group-flat">
                            <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($product->price) ?>" required>
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hãng (Brand)</label>
                        <input type="text" name="brand" class="form-control"
                               value="<?= htmlspecialchars($product->brand) ?>" required>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Ảnh đại diện</div>
                        <input type="file" name="image" class="form-control mb-2">
                        <?php if(!empty($product->image_url)): ?>
                            <div class="text-center">
                                <img src="<?= URLROOT . $product->image_url ?>" class="img-fluid rounded border" style="max-height: 150px;">
                                <div class="text-muted mt-1 small">Ảnh hiện tại</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-end bg-transparent">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/product/list" class="btn btn-link link-secondary">Hủy bỏ</a>
            <button type="submit" class="btn btn-primary ms-auto">Cập nhật dữ liệu</button>
        </div>
    </form>
</div>