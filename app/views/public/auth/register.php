<?php
// --- BẮT ĐẦU BUFFERING ---
ob_start();
?>

<div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8 min-h-[calc(100vh-200px)]">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-black italic uppercase tracking-tighter">
            Do & Tan <span class="text-yellow-500">Sneakers</span>
        </h2>
        <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Đăng ký thành viên
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white dark:bg-[#1a1a1a] py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-200 dark:border-gray-800">
            
            <?php if (!empty($data['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="<?= URLROOT ?>/public/index.php?url=auth/register" method="POST">
            
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Họ và tên hiển thị</label>
                    <div class="mt-2">
                        <input name="full_name" type="text" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 dark:text-white bg-white dark:bg-[#252525] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Tên đăng nhập (Username)</label>
                    <div class="mt-2">
                        <input name="username" type="text" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 dark:text-white bg-white dark:bg-[#252525] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Email</label>
                    <div class="mt-2">
                        <input name="email" type="email" required 
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                                title="Vui lòng nhập email hợp lệ (ví dụ: name@example.com)"
                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 dark:text-white bg-white dark:bg-[#252525] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Mật khẩu</label>
                    <div class="mt-2">
                        <input name="password" type="password" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 dark:text-white bg-white dark:bg-[#252525] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Xác nhận mật khẩu</label>
                    <div class="mt-2">
                        <input name="confirm_password" type="password" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 dark:text-white bg-white dark:bg-[#252525] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-1.5 text-sm font-bold leading-6 text-black shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600 transition-all">
                        Đăng ký
                    </button>
                </div>
            </form>

            <div class="relative mt-10">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white dark:bg-[#1a1a1a] px-2 text-sm text-gray-500">Hoặc</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="<?= URLROOT ?>/public/index.php?url=auth/login" class="flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#252525] px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                    Đăng nhập
                </a>
            </div>
            
        </div>
    </div>
</div>

<?php
// --- KẾT THÚC BUFFERING VÀ GỌI LAYOUT ---
$content = ob_get_clean();
$data['title'] = 'Đăng ký';
require_once APPROOT . '/views/layouts/main.php';
?>