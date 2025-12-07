<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title text-white mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
            Chỉnh sửa nội dung Giới Thiệu
        </h3>
    </div>

    <form method="POST" action="<?php echo URLROOT; ?>/public/index.php?url=admin/about/update">
        <div class="card-body">
            
            <div class="mb-3">
                <label class="form-label font-bold">Nội dung chi tiết</label>
                <textarea id="editor" name="content" class="form-control" rows="20"><?= htmlspecialchars($data['about']->content ?? '') ?></textarea>
            </div>

        </div>

        <div class="card-footer text-end bg-light">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/dashboard" class="btn btn-link link-secondary me-2">Hủy bỏ</a>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                Lưu thay đổi
            </button>
        </div>
    </form>
</div>

<script src="<?= URLROOT ?>/public/admin/dist/libs/hugerte/hugerte.min.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if(window.hugerte) {
            hugerte.init({
                selector: '#editor',
                height: 600,
                menubar: false,
                plugins: 'image link lists table help wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 16px; }'
            });
        }
    });
</script>