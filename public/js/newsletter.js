// File: public/js/newsletter.js

document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.getElementById('newsletterForm');
    
    // Kiểm tra xem form có tồn tại ở trang hiện tại không để tránh lỗi JS
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const btn = document.getElementById('btnSubscribe');
            const loading = document.getElementById('loadingIcon');
            const msgDiv = document.getElementById('msgNotify');
            const formData = new FormData(form);

            // 1. Hiệu ứng loading
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            loading.classList.remove('hidden');
            msgDiv.innerHTML = '';

            // 2. Gửi AJAX
            // Lưu ý: URLROOT thường được khai báo global hoặc dùng đường dẫn tương đối
            fetch(SITE_URL + '/index.php?url=newsletter/subscribe', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    msgDiv.className = 'mt-4 text-sm font-semibold h-6 text-green-400';
                    msgDiv.innerHTML = '✅ ' + data.message;
                    form.reset();
                } else if (data.status === 'warning') {
                    msgDiv.className = 'mt-4 text-sm font-semibold h-6 text-yellow-400';
                    msgDiv.innerHTML = '⚠️ ' + data.message;
                } else {
                    msgDiv.className = 'mt-4 text-sm font-semibold h-6 text-red-400';
                    msgDiv.innerHTML = '❌ ' + data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                msgDiv.className = 'mt-4 text-sm font-semibold h-6 text-red-400';
                msgDiv.innerHTML = '❌ Lỗi kết nối hệ thống.';
            })
            .finally(() => {
                btn.disabled = false;
                btn.classList.remove('opacity-70', 'cursor-not-allowed');
                loading.classList.add('hidden');
            });
        });
    }
});