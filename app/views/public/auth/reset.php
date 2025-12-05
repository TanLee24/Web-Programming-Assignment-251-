<?php
// --- 1. BẮT ĐẦU BUFFERING ---
ob_start();
?>

<div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-black italic uppercase tracking-tighter">
            Do & Tan <span class="text-yellow-500">Sneakers</span>
        </h2>
        <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Đặt Lại Mật Khẩu
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
            Vui lòng nhập mật khẩu mới của bạn
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white dark:bg-black py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-200 dark:border-gray-800">
            
            <?php if (!empty($data['error'])): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="<?= URLROOT ?>/public/index.php?url=auth/reset_password/<?= $data['token']; ?>" method="POST">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mật khẩu mới</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required 
                               class="block w-full appearance-none rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-[#1a1a1a] placeholder-gray-400 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Xác nhận mật khẩu</label>
                    <div class="mt-1">
                        <input id="confirm_password" name="confirm_password" type="password" required 
                               class="block w-full appearance-none rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-[#1a1a1a] placeholder-gray-400 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-bold text-black shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        Đổi mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// --- 2. GỌI LAYOUT ---
$content = ob_get_clean();
$data['title'] = 'Đặt Lại Mật Khẩu';
require_once APPROOT . '/views/layouts/main.php';
?>