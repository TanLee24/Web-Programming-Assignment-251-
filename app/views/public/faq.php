<section class="py-16 max-w-4xl mx-auto">
  <h1 class="text-4xl font-bold mb-8">Câu hỏi thường gặp (FAQ)</h1>

  <?php foreach($faqs as $f): ?>
    <details class="mb-4">
      <summary class="font-semibold text-xl"><?= $f->question ?></summary>
      <p class="mt-2"><?= $f->answer ?></p>
    </details>
  <?php endforeach ?>
</section>
