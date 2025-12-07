<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title text-white mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
            Chỉnh sửa câu hỏi (ID: <?= $faq->id ?>)
        </h3>
    </div>

    <form method="POST" action="<?= URLROOT ?>/public/index.php?url=admin/faq/edit/<?= $faq->id ?>">
        <div class="card-body">
            
            <div class="mb-4">
                <label class="form-label font-bold text-primary">Câu hỏi</label>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="17" x2="12" y2="17.01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                    </span>
                    <input type="text" name="question" class="form-control form-control-lg" 
                           value="<?= htmlspecialchars($faq->question) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label font-bold text-primary">Nội dung trả lời</label>
                <textarea id="editor" name="answer" class="form-control" rows="10"><?= $faq->answer ?></textarea>
            </div>
        </div>

        <div class="card-footer text-end bg-light">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/list" class="btn btn-link link-secondary me-2">Hủy bỏ</a>
            <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                Cập nhật thay đổi
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
                height: 350,
                menubar: false,
                statusbar: false,
                plugins: 'lists link wordcount',
                toolbar: 'undo redo | bold italic | bullist numlist | removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; }'
            });
        }
    });
</script>