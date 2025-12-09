<div class="container-xl">
    <div class="page-header d-print-none mb-4">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Quản lý thành viên</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thông tin thành viên</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tham gia</th>
                        <th class="w-1">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u->id ?></td>
                        <td>
                            <div class="d-flex py-1 align-items-center">
                                <?php 
                                    $avatar = !empty($u->avatar_url) ? URLROOT . "/public/" . $u->avatar_url : "https://ui-avatars.com/api/?name=" . urlencode($u->full_name);
                                ?>
                                <span class="avatar me-2" style="background-image: url(<?= $avatar ?>)"></span>
                                <div class="flex-fill">
                                    <div class="font-weight-medium"><?= htmlspecialchars($u->full_name) ?></div>
                                    <div class="text-muted"><a href="#" class="text-reset"><?= htmlspecialchars($u->email) ?></a></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if ($u->role === 'admin'): ?>
                                <span class="badge bg-purple text-purple-fg">Quản trị viên</span>
                            <?php else: ?>
                                <span class="badge bg-blue text-blue-fg">Thành viên</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u->status === 'active'): ?>
                                <span class="badge bg-green">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-red">Đã khóa</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted">
                            <?= date('d/m/Y', strtotime($u->created_at)) ?>
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <?php if ($u->role !== 'admin'): ?>
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/user/ban&id=<?= $u->id ?>" 
                                       class="btn btn-sm <?= ($u->status === 'active') ? 'btn-outline-danger' : 'btn-outline-success' ?>">
                                        <?= ($u->status === 'active') ? 'Khóa' : 'Mở khóa' ?>
                                    </a>
                                    
                                    <a href="<?= URLROOT ?>/public/index.php?url=admin/user/reset&id=<?= $u->id ?>" 
                                       class="btn btn-sm btn-outline-warning"
                                       onclick="return confirm('Bạn có chắc muốn reset mật khẩu của <?= $u->full_name ?> về 123456 không?');">
                                        Reset Pass
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div> <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">
                Trang <span><?= $page ?></span> / <span><?= $totalPages ?></span>
            </p>
            <ul class="pagination m-0 ms-auto">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/user/index&page=<?= $page - 1 ?>">
                        Trước
                    </a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == 1 || $i == $totalPages || ($i >= $page - 2 && $i <= $page + 2)): ?>
                        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/user/index&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php elseif ($i == $page - 3 || $i == $page + 3): ?>
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= URLROOT ?>/public/index.php?url=admin/user/index&page=<?= $page + 1 ?>">
                        Sau
                    </a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        </div> </div>
    </div>
</div>