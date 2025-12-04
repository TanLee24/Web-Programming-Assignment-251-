<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">Hộp thư liên hệ</h2>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Người gửi</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($contacts)): ?>
                        <?php foreach($contacts as $row): ?>
                            <?php 
                                $row = (array)$row; 
                                // Nếu chưa có cột status hoặc created_at thì gán mặc định để không lỗi hiển thị
                                $status = $row['status'] ?? 0;
                                $created_at = $row['created_at'] ?? date('Y-m-d H:i:s');
                            ?>
                        <tr>
                            <td>
                                <div><?php echo htmlspecialchars($row['name']); ?></div>
                                <div class="text-muted"><?php echo htmlspecialchars($row['email']); ?></div>
                            </td>
                            <td class="text-muted text-truncate" style="max-width: 300px;">
                                <?php echo htmlspecialchars($row['message']); ?>
                            </td>
                            <td><?php echo $created_at; ?></td>
                            <td>
                                <?php if($status == 0): ?>
                                    <span class="badge bg-warning">Mới</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Đã xem</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <?php if($status == 0): ?>
                                        <a href="<?= URLROOT ?>/public/index.php?url=admin/contact/mark_read&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">Đã xem</a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/contact/delete&id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?');">Xóa</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Hộp thư trống</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>