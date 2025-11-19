<div class="container mx-auto py-12 px-4">
    <h1 class="text-4xl font-bold text-center mb-8 text-blue-800 dark:text-blue-300">
        <?= htmlspecialchars($title) ?>
    </h1>
    
    <div class="
        prose lg:prose-xl mx-auto 
        bg-white dark:bg-gray-800 
        p-8 shadow rounded
        text-gray-900 dark:text-gray-100
    ">
        <?= $content ?> 
    </div>
</div>
