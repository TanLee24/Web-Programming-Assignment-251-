<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white">
        <h3 class="card-title text-white mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Thêm câu hỏi mới (FAQ)
        </h3>
    </div>

    <form method="POST" action="<?= URLROOT ?>/public/index.php?url=admin/faq/create">
        <div class="card-body">
            
            <div class="mb-4">
                <label class="form-label font-bold text-success">Câu hỏi</label>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="17" x2="12" y2="17.01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                    </span>
                    <input type="text" name="question" class="form-control form-control-lg" placeholder="Ví dụ: Shop có ship COD không?" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label font-bold text-success">Câu trả lời</label>
                <textarea id="editor" name="answer" class="form-control" rows="10" placeholder="Nhập câu trả lời tại đây..."></textarea>
            </div>
        </div>

        <div class="card-footer text-end bg-light">
            <a href="<?= URLROOT ?>/public/index.php?url=admin/faq/list" class="btn btn-link link-secondary me-2">Quay lại danh sách</a>
            <button type="submit" class="btn btn-success d-inline-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                Lưu câu hỏi
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
                height: 300,
                menubar: false,
                statusbar: false,
                plugins: 'lists link wordcount',
                toolbar: 'undo redo | bold italic | bullist numlist | removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; }'
            });
        }
    });
</script>