<div class="container mx-auto py-16 px-4 max-w-4xl">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black italic uppercase text-gray-900 dark:text-white mb-4">
            <span class="text-yellow-500">FAQ</span> - Hỏi Đáp
        </h1>
        <p class="text-gray-600 dark:text-gray-400">Giải đáp những thắc mắc thường gặp về sản phẩm và dịch vụ của Do & Tan Sneakers</p>
    </div>

    <div class="space-y-4">
        <?php if (empty($faqs)): ?>
            <div class="text-center p-8 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg">
                <p class="text-gray-500">Hiện chưa có câu hỏi nào được cập nhật.</p>
            </div>
        <?php else: ?>
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="border border-gray-200 dark:border-gray-800 rounded-lg bg-white dark:bg-[#1a1a1a] overflow-hidden transition-all hover:shadow-md">
                    <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none group" 
                            onclick="toggleFaq('faq-ans-<?= $index ?>', 'icon-<?= $index ?>')">
                        <span class="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-yellow-500 transition-colors">
                            <?= htmlspecialchars($faq->question) ?>
                        </span>
                        <svg id="icon-<?= $index ?>" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div id="faq-ans-<?= $index ?>" class="hidden px-6 pb-6 pt-0 border-t border-gray-100 dark:border-gray-800 mt-2 bg-gray-50 dark:bg-black/20">
                        <div class="pt-4 prose prose-sm dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                            <?= html_entity_decode($faq->answer, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="mt-12 text-center">
        <p class="text-gray-600 dark:text-gray-400">
            Vẫn chưa tìm thấy câu trả lời? 
            <a href="index.php?url=pages/contact" class="text-yellow-500 font-bold hover:underline">Liên hệ ngay</a>
        </p>
    </div>
</div>

<script>
    function toggleFaq(contentId, iconId) {
        const content = document.getElementById(contentId);
        const icon = document.getElementById(iconId);
        
        // Toggle ẩn/hiện nội dung
        content.classList.toggle('hidden');
        
        // Xoay icon mũi tên
        icon.classList.toggle('rotate-180');
    }
</script>