<div class="relative bg-gray-900 py-24 sm:py-32 isolate overflow-hidden">
    <img src="<?= URLROOT ?>/public/uploads/sneakershop.jpg" alt="Background" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-20 blur-sm">
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-black tracking-tight text-white uppercase italic drop-shadow-lg">
            VỀ CHÚNG TÔI
        </h1>
        <p class="mt-4 text-lg text-gray-300 max-w-2xl mx-auto font-light">
            <?= isset($company_name) ? $company_name : 'Do & Tan Sneakers' ?> - Hành trình đam mê.
        </p>
    </div>
</div>

<div class="container mx-auto px-4 -mt-16 relative z-20 mb-20">
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-gray-800">
        <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
            <?= !empty($content) ? $content : '<p class="text-center">Nội dung đang cập nhật...</p>' ?>
        </div>
    </div>
</div>