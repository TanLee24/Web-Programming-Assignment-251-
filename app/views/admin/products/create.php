<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thêm sản phẩm mới</h3>
    </div>

    <form action="<?= URLROOT ?>/public/index.php?url=admin/product/create"
      method="POST"
      enctype="multipart/form-data">
        <div class="card-body">

            <!-- BRAND -->
            <div class="mb-3">
                <label class="form-label">Hãng (Brand)</label>
                <input type="text" name="brand" class="form-control" placeholder="Ví dụ: Nike, Adidas..." required>
            </div>

            <!-- NAME -->
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- PRICE -->
            <div class="mb-3">
                <label class="form-label">Giá (VNĐ)</label>
                <input type="number" name="price" class="form-control" min="0" required>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control tiny-editor" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
            </div>

            <!-- IMAGE -->
            <div class="mb-3">
                <label class="form-label">Ảnh (Upload)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        </div>
    </form>
</div>
