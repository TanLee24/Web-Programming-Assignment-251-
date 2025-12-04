<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">Cấu hình thông tin Website</h2>
    </div>
    <div class="row row-cards">
        <div class="col-12">
            <form action="" method="post" enctype="multipart/form-data" class="card">
                <div class="card-body">
                    <?php if(!empty($data['msg'])): ?>
                        <div class="alert alert-success"><?php echo $data['msg']; ?></div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Tên Công Ty / Website</label>
                        <input type="text" class="form-control" name="company_name" value="<?php echo $data['company_name'] ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <?php if(!empty($data['logo_path'])): ?>
                            <div class="mb-2">
                                <img src="<?= URLROOT ?>/public/<?php echo $data['logo_path']; ?>" style="height: 80px; border: 1px solid #eee;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="logo">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $data['phone'] ?? ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $data['address'] ?? ''; ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Giới thiệu ngắn</label>
                        <textarea class="form-control" name="intro_text" rows="4"><?php echo $data['intro_text'] ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>