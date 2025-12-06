// File: public/js/counter.js

document.addEventListener("DOMContentLoaded", function() {
    // 1. Hàm chạy hiệu ứng tăng số
    const runCounter = (el) => {
        const target = +el.getAttribute('data-target'); // Lấy số đích
        const suffix = el.getAttribute('data-suffix') || ''; // Lấy ký tự đuôi (+, k, %)
        const duration = 2000; // Thời gian chạy (ms)
        const step = target / (duration / 16); // Tính bước nhảy
        
        let current = 0;
        
        const updateCount = () => {
            current += step;
            if(current < target) {
                el.innerText = Math.ceil(current) + suffix;
                requestAnimationFrame(updateCount);
            } else {
                el.innerText = target + suffix;
            }
        };
        
        updateCount();
    };

    // 2. Observer: Chỉ chạy khi lướt tới
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter-num');
                counters.forEach(counter => runCounter(counter));
                observer.unobserve(entry.target); // Chạy xong thì thôi
            }
        });
    }, { threshold: 0.5 }); // Hiện 50% khung hình mới chạy

    // Bắt đầu theo dõi
    const statsSection = document.getElementById('stats-section');
    if(statsSection) {
        observer.observe(statsSection);
    }
});