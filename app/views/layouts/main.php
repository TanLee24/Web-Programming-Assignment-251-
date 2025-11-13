<!doctype html>
<html lang="vi" class="h-full">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $data['title']; ?> - Do & Tan Solution</title>
 
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script src="/_sdk/element_sdk.js"></script>
 <script src="/_sdk/data_sdk.js" type="text/javascript"></script>

   <style>
    body { box-sizing: border-box; }
   
        /* Nền Hero đổi sang Đen/Xám Đậm */
    .gradient-bg {
      background: linear-gradient(135deg, #222 0%, #000 100%);
    }
   
    .service-card { transition: all 0.3s ease; }
    .service-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
   
        /* Link Nav đổi sang màu Vàng khi hover */
    .nav-link { position: relative; transition: color 0.3s ease; }
    .nav-link:hover { color: #f59e0b; /* Amber-500 */ }
    .nav-link::after { content: ''; position: absolute; width: 0; height: 2px; bottom: -5px; left: 0; background-color: #f59e0b; transition: width 0.3s ease; }
    .nav-link:hover::after { width: 100%; }
   
        /* Nút Bấm chính đổi sang Vàng */
    .btn-primary {
      background: linear-gradient(45deg, #f59e0b, #ca8a04); /* Amber 500 -> 700 */
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3); /* Bóng màu Vàng */
    }
   
    .floating-animation { animation: float 6s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
   
    .fade-in { opacity: 0; transform: translateY(30px); animation: fadeIn 0.8s ease forwards; }
    @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
  </style>
 <style>@view-transition { navigation: auto; }</style>
</head>
<body class="h-full font-sans bg-gray-50">  <main class="min-h-full">
      <header class="bg-white shadow-lg sticky top-0 z-50">
   <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center py-4">
     <div class="flex items-center">
                  <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-3">
       <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </div>
      <h1 id="company-name" class="text-2xl font-bold text-gray-800">Do & Tan Solution</h1>
     </div>
     <div class="hidden md:flex space-x-8">
                  <a href="http://localhost/Web-Programming-Assignment-251-/public/" class="nav-link text-gray-700 font-medium">Trang chủ</a> 
            <a href="#" class="nav-link text-gray-700 font-medium">Dịch vụ</a> 
            <a href="#" class="nav-link text-gray-700 font-medium">Giới thiệu</a> 
            <a href="http://localhost/Web-Programming-Assignment-251-/public/index.php?url=pages/contact" class="nav-link text-gray-700 font-medium">Liên hệ</a>
     </div>
          <button class="md:hidden p-2">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
          </button>
    </div>
   </nav>
  </header>
    
      <?php echo $content; ?>
        <footer class="bg-black text-white py-12">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
     <div class="col-span-1 md:col-span-2">
      <div class="flex items-center mb-4">
                     <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-3">
        <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
       </div>
       <h5 class="text-xl font-bold">Do & Tan Solution</h5>
      </div>
      <p class="text-gray-400 mb-4">Đối tác tin cậy trong hành trình chuyển đổi số của doanh nghiệp. Chúng tôi cam kết mang đến những giải pháp công nghệ tối ưu và hiệu quả nhất.</p>
     </div>
     <div>
      <h6 class="font-semibold mb-4">Dịch vụ</h6>
      <ul class="space-y-2 text-gray-400">
       <li><a href="#" class="hover:text-white transition-colors">Phát triển phần mềm</a></li>
       <li><a href="#" class="hover:text-white transition-colors">Tư vấn hệ thống</a></li>
       <li><a href="#" class="hover:text-white transition-colors">Bảo mật thông tin</a></li>
       <li><a href="#" class="hover:text-white transition-colors">Hỗ trợ kỹ thuật</a></li>
      </ul>
     </div>
     <div>
      <h6 class="font-semibold mb-4">Liên kết</h6>
      <ul class="space-y-2 text-gray-400">
       <li><a href="http://localhost/Web-Programming-Assignment-251-/public/" class="hover:text-white transition-colors">Trang chủ</a></li>
       <li><a href="#" class="hover:text-white transition-colors">Giới thiệu</a></li>
       <li><a href="http://localhost/Web-Programming-Assignment-251-/public/index.php?url=pages/contact" class="hover:text-white transition-colors">Liên hệ</a></li>
      </ul>
     </div>
    </div>
    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
     <p>© 2025 Do & Tan Solution. Tất cả quyền được bảo lưu.</p>
    </div>
   </div>
  </footer>
 </main>
 
  <script>
    // Default configuration (giữ nguyên)
    const defaultConfig = {
      company_name: "Do & Tan Solution",
      hero_title: "Giải pháp công nghệ thông tin toàn diện",
      hero_subtitle: "Chúng tôi cung cấp các dịch vụ IT chuyên nghiệp...",
      services_title: "Dịch vụ của chúng tôi",
      contact_title: "Liên hệ với chúng tôi",
      phone_number: "+84 123 456 789",
      email_address: "info@D&Tsolution.vn"
    };

    // Handle contact form submission
    function handleContactForm(event) {
      event.preventDefault();
      const formData = new FormData(event.target);
      const button = event.target.querySelector('button[type="submit"]');
      const originalText = button.textContent;
      button.textContent = 'Đã gửi thành công!';
            // Đổi màu nút thành công sang Vàng đậm
      button.style.background = '#b45309'; // Amber-800
     
      setTimeout(() => {
        event.target.reset();
        button.textContent = originalText;
        button.style.background = ''; // Quay về style gốc
      }, 3000);
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    // Add scroll effect to fade-in elements
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationDelay = '0.2s';
          entry.target.classList.add('fade-in');
        }
      });
    }, observerOptions);
    document.querySelectorAll('.service-card').forEach(card => {
      observer.observe(card);
    });

    // Element SDK configuration (giữ nguyên)
    async function onConfigChange(config) {
        // (toàn bộ nội dung hàm này giữ nguyên)
      const companyNameEl = document.getElementById('company-name');
      if (companyNameEl) { companyNameEl.textContent = config.company_name || defaultConfig.company_name; }
            // (v.v... cho các element khác)
    }
    function mapToCapabilities(config) { /* (giữ nguyên) */ }
    function mapToEditPanelValues(config) { /* (giữ nguyên) */ }
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig, onConfigChange, mapToCapabilities, mapToEditPanelValues
      });
    }
 </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99de7048e128c7ca',t:'MTc2MzAzODY4Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</body>
</html>