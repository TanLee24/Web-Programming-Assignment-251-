<form method="POST" class="card p-4">
    <h3 class="card-title mb-4">Sửa câu hỏi</h3>

    <div class="mb-3">
        <label>Câu hỏi</label>
        <input type="text" name="question" class="form-control" value="<?= htmlspecialchars($faq->question) ?>" required>
    </div>

    <div class="mb-3">
        <label>Trả lời</label>
        <textarea name="answer" class="form-control" rows="5" required><?= htmlspecialchars($faq->answer) ?></textarea>
    </div>

    <button class="btn btn-primary">Cập nhật</button>
</form>
