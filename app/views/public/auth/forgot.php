<?php
// --- 1. BẮT ĐẦU GHI NHỚ NỘI DUNG (BUFFERING) ---
ob_start();
?>

<div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-black italic uppercase tracking-tighter">
            Do & Tan <span class="text-yellow-500">Sneakers</span>
        </h2>
        <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Quên Mật Khẩu
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
            Nhập email của bạn để nhận liên kết đặt lại mật khẩu
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white dark:bg-black py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-200 dark:border-gray-800">
            
            <?php if (!empty($data['error'])): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($data['success'])): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative text-sm break-words">
                    <?= $data['success'] ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="<?= URLROOT ?>/public/index.php?url=auth/forgot_password" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email đăng ký</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" required 
                               value="<?= isset($data['email']) ? $data['email'] : '' ?>"
                               class="block w-full appearance-none rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-[#1a1a1a] placeholder-gray-400 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-bold text-black shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        Gửi yêu cầu
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white dark:bg-black px-2 text-gray-500">Hoặc</span>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <a href="<?= URLROOT ?>/public/index.php?url=auth/login" class="font-semibold leading-6 text-yellow-500 hover:text-yellow-400 hover:underline">
                        &larr; Quay lại Đăng nhập
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// --- 2. KẾT THÚC BUFFERING VÀ GỌI LAYOUT ---
$content = ob_get_clean(); // Lấy toàn bộ nội dung HTML ở trên gán vào biến $content
$data['title'] = 'Quên Mật Khẩu'; // Đặt tiêu đề tab trình duyệt
require_once APPROOT . '/views/layouts/main.php'; // Gọi giao diện chính
?>