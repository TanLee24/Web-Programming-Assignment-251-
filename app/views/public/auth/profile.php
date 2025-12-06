<div class="bg-gray-50 dark:bg-[#111111] min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <nav class="flex text-sm text-gray-500 mb-8">
            <a href="<?= URLROOT ?>/public/index.php" class="...">Trang chủ</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 dark:text-white font-bold">Hồ sơ cá nhân</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-lg p-8 text-center border border-gray-100 dark:border-gray-800 sticky top-24">
                    
                    <form id="avatar-form" action="" method="POST" enctype="multipart/form-data">
                        <div class="relative inline-block group">
                            <?php 
                                // Nếu có ảnh trong DB thì dùng, không thì dùng ảnh mặc định tạo theo tên
                                $avatarSrc = !empty($user->avatar_url) ? URLROOT . "/public/" . $user->avatar_url : "https://ui-avatars.com/api/?name=" . urlencode($user->full_name) . "&background=fbbf24&color=000&size=200";
                            ?>
                            <img id="avatar-preview" 
                                 src="<?= $avatarSrc ?>" 
                                 alt="Avatar" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 dark:border-gray-700 shadow-md mx-auto transition-transform group-hover:scale-105">
                            
                            <label for="avatar-input" class="absolute bottom-0 right-0 bg-yellow-500 text-black p-2 rounded-full cursor-pointer hover:bg-yellow-400 transition-all shadow-lg transform translate-x-1 translate-y-1" title="Đổi ảnh đại diện">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                        </div>
                    </form>

                    <h2 class="text-xl font-black mt-4 text-gray-900 dark:text-white uppercase italic">
                        <?= htmlspecialchars($user->full_name) ?>
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?= htmlspecialchars($user->email) ?></p>
                    
                    <div class="mt-4">
                        <?php if (isset($user->role) && $user->role === 'admin'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                                Quản trị viên
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                Thành viên
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-lg p-8 border border-gray-100 dark:border-gray-800">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        Cập nhật thông tin
                    </h3>

                    <?php if (!empty($success)): ?>
                        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg></div>
                                <div class="ml-3"><p class="text-sm text-green-700"><?= $success ?></p></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0"><svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg></div>
                                <div class="ml-3"><p class="text-sm text-red-700"><?= $error ?></p></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?= URLROOT ?>/public/index.php?url=profile/index" method="POST" enctype="multipart/form-data">
                        
                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewImage(this)">

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Họ và tên hiển thị</label>
                                <input type="text" name="full_name" value="<?= htmlspecialchars($user->full_name) ?>" required 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#252525] text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email đăng nhập</label>
                                <div class="relative">
                                    <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>" readonly
                                        class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-500 cursor-not-allowed shadow-inner">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 mt-2 italic">* Không thể thay đổi địa chỉ email.</p>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Đổi mật khẩu</h4>
                                <p class="text-sm text-gray-500 mb-4">Chỉ điền vào các ô bên dưới nếu bạn muốn thay đổi mật khẩu.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Mật khẩu mới</label>
                                    <input type="password" name="new_password" placeholder="••••••" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#252525] text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Xác nhận mật khẩu</label>
                                    <input type="password" name="confirm_password" placeholder="••••••" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#252525] text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-center">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-12 rounded-xl shadow-lg shadow-yellow-500/30 transform transition hover:-translate-y-1 hover:scale-105 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script xem trước ảnh khi chọn file từ máy tính
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>