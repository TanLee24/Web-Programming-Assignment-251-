<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sửa sản phẩm</h3>
    </div>

    <form action="" method="POST" enctype="multipart/form-data" class="card-body">

        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($product->name) ?>" required>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="5" required><?= 
                htmlspecialchars($product->description) 
            ?></textarea>
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" 
                   value="<?= htmlspecialchars($product->price) ?>" required>
        </div>

        <!-- Hãng -->
        <div class="mb-3">
            <label class="form-label">Hãng (Brand)</label>
            <input type="text" name="brand" class="form-control"
                   placeholder="Ví dụ: Nike, Adidas..."
                   value="<?= htmlspecialchars($product->brand) ?>" required>
        </div>

        <!-- Ảnh hiện tại -->
        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="<?= URLROOT . $product->image_url ?>" 
                 alt="Ảnh sản phẩm" width="150" class="border rounded">
        </div>

        <!-- Upload ảnh mới -->
        <div class="mb-3">
            <label class="form-label">Chọn ảnh mới (nếu muốn thay)</label>
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Bỏ trống nếu giữ ảnh cũ</small>
        </div>

        <!-- Nút cập nhật -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?= URLROOT ?>/public/index.php?url=admin/product/list" class="btn btn-secondary">
                Quay lại
            </a>
        </div>

    </form>
</div>
