<!DOCTYPE html>
<html lang="vi" class="h-full bg-white dark:bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Do & Tan Sneakers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> tailwind.config = { darkMode: 'class' } </script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="h-full bg-gray-50 dark:bg-[#111111] text-gray-900 dark:text-white flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-black italic uppercase tracking-tighter">
            Do & Tan <span class="text-yellow-500">Sneakers</span>
        </h2>
        <h2 class="mt-6 text-center text-2xl font-bold tracking-tight">Đăng nhập tài khoản</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white dark:bg-black py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-200 dark:border-gray-800">
            
            <?php if (!empty($data['error'])): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="<?= URLROOT ?>/public/index.php?url=auth/login" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium">Email hoặc Tên đăng nhập</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-[#1a1a1a] placeholder-gray-400 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium">Mật khẩu</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required class="block w-full appearance-none rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-[#1a1a1a] placeholder-gray-400 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-bold text-black shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        Đăng nhập
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
                <div class="mt-6 grid grid-cols-1 gap-3">
                    <a href="<?= URLROOT ?>/public/index.php?url=auth/register" class="flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#1a1a1a] py-2 px-4 text-sm font-medium shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800">
                        Đăng ký tài khoản mới
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a href="<?= URLROOT ?>/public/index.php" class="font-semibold leading-6 text-gray-900 hover:underline">← Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>