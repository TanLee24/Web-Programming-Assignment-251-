<!DOCTYPE html>
<html lang="vi" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Do & Tan Sneakers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-3xl font-black italic uppercase tracking-tighter text-gray-900">
        Do & Tan <span class="text-yellow-500">Sneakers</span>
        </h2>
        <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Đăng ký thành viên</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        
        <?php if (!empty($data['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                <?= $data['error'] ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" action="<?= URLROOT ?>/public/index.php?url=auth/register" method="POST">
        
        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Họ và tên hiển thị</label>
            <div class="mt-2">
            <input name="full_name" type="text" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Tên đăng nhập (Username)</label>
            <div class="mt-2">
            <input name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
            <div class="mt-2">
            <input name="email" type="email" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Mật khẩu</label>
            <div class="mt-2">
            <input name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Xác nhận mật khẩu</label>
            <div class="mt-2">
            <input name="confirm_password" type="password" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6">
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
            <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
            <span class="bg-white px-2 text-sm text-gray-500">Hoặc</span>
            </div>
        </div>

        <div class="mt-6">
            <a href="<?= URLROOT ?>/public/index.php?url=auth/login" class="flex w-full justify-center rounded-md bg-white px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-all">
                Đăng nhập
            </a>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
        <a href="<?= URLROOT ?>/public/index.php" class="font-semibold leading-6 text-gray-900 hover:underline">← Về trang chủ</a>
        </p>
        
    </div>
    </div>
</body>
</html>