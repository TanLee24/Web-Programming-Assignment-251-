<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">Quản lý Đánh giá & Bình luận</h2>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm / Bài viết</th>
                        <th>Nội dung</th>
                        <th>Đánh giá</th>
                        <th>Ngày gửi</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($comments)): ?>
                        <?php foreach($comments as $row): $row = (object)$row; ?>
                        <tr>
                            <td>#<?= $row->id ?></td>
                            
                            <td>
                                <div class="font-weight-medium"><?= htmlspecialchars($row->full_name ?? $row->user_name ?? 'Khách') ?></div>
                                <div class="text-muted text-xs"><?= htmlspecialchars($row->email ?? '') ?></div>
                            </td>

                            <td>
                                <?php if($row->commentable_type == 'news'): ?>
                                    <span class="badge bg-blue-lt">Tin tức</span>
                                <?php else: ?>
                                    <span class="badge bg-orange-lt">Sản phẩm</span>
                                <?php endif; ?>
                                <div class="text-truncate" style="max-width: 200px;"><?= htmlspecialchars($row->item_name) ?></div>
                            </td>

                            <td class="text-muted text-truncate" style="max-width: 250px;">
                                <?= htmlspecialchars($row->content) ?>
                            </td>

                            <td>
                                <div class="text-warning">
                                    <?php 
                                    $stars = $row->rating ?? 5; 
                                    for($i=1; $i<=5; $i++) {
                                        // Vẽ sao đặc hoặc sao rỗng
                                        echo ($i <= $stars) ? '★' : '☆'; 
                                    }
                                    ?>
                                </div>
                            </td>

                            <td><?= date('d/m/Y', strtotime($row->created_at)) ?></td>

                            <td>
                                <div class="btn-list flex-nowrap">
                                    <?php if ($row->status == 1): ?>
                                        <a href="<?= URLROOT ?>/public/index.php?url=admin/comment/status&id=<?= $row->id ?>&val=0" 
                                           class="btn btn-sm btn-outline-success">Hiện</a>
                                    <?php else: ?>
                                        <a href="<?= URLROOT ?>/public/index.php?url=admin/comment/status&id=<?= $row->id ?>&val=1" 
                                           class="btn btn-sm btn-outline-secondary">Ẩn</a>
                                    <?php endif; ?>

                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/comment/delete&id=<?= $row->id ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center p-3">Chưa có bình luận nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>