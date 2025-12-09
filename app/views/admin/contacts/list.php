<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Hộp thư liên hệ</h2>
                <div class="text-muted mt-1">Quản lý phản hồi từ khách hàng</div>
            </div>
        </div>
    </div>
    
    <div class="card mt-3" style="min-height: 400px;">
        <table class="table table-vcenter card-table table-hover">
            <thead>
                <tr>
                    <th class="w-25">Người gửi</th>
                    <th class="w-50">Nội dung</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contacts)): ?>
                    <?php foreach($contacts as $row): ?>
                        <?php 
                            $row = (object)$row;
                            
                            $status = $row->status ?? 'unread';
                            $statusLabel = 'Chưa đọc';
                            $statusColor = 'bg-warning'; // Màu vàng

                            if ($status == 'read' || $status == 1) { 
                                $statusLabel = 'Đã xem';
                                $statusColor = 'bg-blue'; // Màu xanh dương
                                $status = 'read';
                            } elseif ($status == 'replied') {
                                $statusLabel = 'Đã phản hồi';
                                $statusColor = 'bg-success'; // Màu xanh lá
                            }
                        ?>
                    <tr>
                        <td>
                            <div class="font-weight-medium"><?php echo htmlspecialchars($row->name); ?></div>
                            <div class="text-muted small text-truncate"><?php echo htmlspecialchars($row->email); ?></div>
                        </td>
                        <td>
                            <div class="text-muted text-truncate" style="max-width: 400px;" title="<?php echo htmlspecialchars($row->message); ?>">
                                <?php echo htmlspecialchars($row->message); ?>
                            </div>
                        </td>
                        <td class="text-muted small">
                            <?php echo isset($row->created_at) ? date('H:i d/m/Y', strtotime($row->created_at)) : ''; ?>
                        </td>
                        <td style="overflow: visible;">
                            <div class="dropdown">
                                <button class="btn badge <?php echo $statusColor; ?> text-white dropdown-toggle align-text-top" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        data-bs-boundary="viewport"> <?php echo $statusLabel; ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="<?= URLROOT ?>/public/index.php?url=admin/contact/update_status&id=<?php echo $row->id; ?>&status=unread">
                                        <span class="status-dot status-dot-animated bg-warning me-2"></span> Đánh dấu chưa đọc
                                    </a>
                                    <a class="dropdown-item" href="<?= URLROOT ?>/public/index.php?url=admin/contact/update_status&id=<?php echo $row->id; ?>&status=read">
                                        <span class="status-dot bg-blue me-2"></span> Đánh dấu đã xem
                                    </a>
                                    <a class="dropdown-item" href="<?= URLROOT ?>/public/index.php?url=admin/contact/update_status&id=<?php echo $row->id; ?>&status=replied">
                                        <span class="status-dot bg-success me-2"></span> Đã phản hồi
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="<?= URLROOT ?>/public/index.php?url=admin/contact/delete&id=<?php echo $row->id; ?>" 
                               class="text-danger"
                               onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?');"
                               title="Xóa">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center py-5 text-muted">Không có liên hệ nào</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">
                Trang <span><?= $page ?></span> / <span><?= $totalPages ?></span>
            </p>
            <ul class="pagination m-0 ms-auto">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/contact/list&page=<?= $page - 1 ?>">
                        Trước
                    </a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == 1 || $i == $totalPages || ($i >= $page - 2 && $i <= $page + 2)): ?>
                        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/contact/list&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php elseif ($i == $page - 3 || $i == $page + 3): ?>
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/contact/list&page=<?= $page + 1 ?>">
                        Sau
                    </a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        </div> </div>
    </div>
</div>