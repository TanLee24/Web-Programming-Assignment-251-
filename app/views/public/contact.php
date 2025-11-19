<section id="contact" class="py-16 bg-white dark:bg-black">
    <div class="container mx-auto px-4">
        <h2 id="contact-title" class="text-3xl font-black text-center mb-12 uppercase italic text-gray-900 dark:text-white">Liên hệ <span class="text-yellow-500">Do & Tan</span></h2>
        <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">
            
            <div class="space-y-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Thông tin liên hệ</h3>
                
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-gray-50 dark:bg-[#111111] border border-gray-100 dark:border-gray-800">
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">📍</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Cửa hàng</h4>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">36 Đường 18, phường Diên Hồng, TP.HCM</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-gray-50 dark:bg-[#111111] border border-gray-100 dark:border-gray-800">
                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">📞</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Hotline Mua Hàng</h4>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">0909 123 456</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-gray-50 dark:bg-[#111111] border border-gray-100 dark:border-gray-800">
                    <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl">✉️</div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Email Hỗ Trợ</h4>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">cskh@dotanstore.vn</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-[#111111] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-lg">
                <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Gửi tin nhắn</h3>
                <form class="space-y-5" onsubmit="handleContactForm(event)">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Họ tên</label> 
                        <input type="text" required class="w-full px-4 py-3 rounded-xl bg-white dark:bg-black border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email</label> 
                        <input type="email" required class="w-full px-4 py-3 rounded-xl bg-white dark:bg-black border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tin nhắn</label> 
                        <textarea rows="4" required class="w-full px-4 py-3 rounded-xl bg-white dark:bg-black border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-4 rounded-xl hover:bg-yellow-400 hover:scale-[1.02] transition-all shadow-lg shadow-yellow-500/20">
                        Gửi ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>