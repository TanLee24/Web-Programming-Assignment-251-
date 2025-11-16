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

    .gradient-bg {
      background: linear-gradient(135deg, #222 0%, #000 100%);
    }

    .service-card { transition: all 0.3s ease; }
    .service-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }

    .nav-link { position: relative; transition: color 0.3s ease; }
    .nav-link:hover { color: #f59e0b; }
    .nav-link::after {
      content: '';
      position: absolute;
      width: 0; height: 2px;
      bottom: -5px; left: 0;
      background-color: #f59e0b;
      transition: width 0.3s ease;
    }
    .nav-link:hover::after { width: 100%; }

    .btn-primary {
      background: linear-gradient(45deg, #f59e0b, #ca8a04);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
    }

    .floating-animation { animation: float 6s ease-in-out infinite; }
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    .fade-in { opacity: 0; transform: translateY(30px); animation: fadeIn 0.8s ease forwards; }
    @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
 </style>

 <style>@view-transition { navigation: auto; }</style>
</head>

<body class="h-full font-sans bg-gray-50">
<main class="min-h-full">

<header class="bg-white shadow-lg sticky top-0 z-50">
 <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center py-4">

     <div class="flex items-center">
        <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-3">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h1 id="company-name" class="text-2xl font-bold text-gray-800">Do & Tan Solution</h1>
     </div>

     <div class="hidden md:flex space-x-8">
        <a href="<?php echo URLROOT; ?>/public/" class="nav-link text-gray-700 font-medium">Trang chủ</a> 
        <a href="<?php echo URLROOT; ?>/public/index.php?url=services" class="nav-link text-gray-700 font-medium">Dịch vụ</a> 
        <a href="<?php echo URLROOT; ?>/public/index.php?url=about" class="nav-link text-gray-700 font-medium">Giới thiệu</a> 
        <a href="<?php echo URLROOT; ?>/public/index.php?url=pages/contact" class="nav-link text-gray-700 font-medium">Liên hệ</a>
     </div>

     <button class="md:hidden p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
     </button>

    </div>
 </nav>
</header>

<?php echo $content; ?>

<!-- ==================== FOOTER ===================== -->
<footer class="bg-black text-white py-12 mt-10">
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

     <div class="col-span-1 md:col-span-2">
        <div class="flex items-center mb-4">
           <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-3">
             <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 20 20">
               <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
             </svg>
           </div>
           <h5 class="text-xl font-bold">Do & Tan Solution</h5>
        </div>

        <p class="text-gray-400 mb-4">
           Đối tác tin cậy trong hành trình chuyển đổi số của doanh nghiệp.
        </p>
     </div>

     <div>
        <h6 class="font-semibold mb-4">Dịch vụ</h6>
        <ul class="space-y-2 text-gray-400">
          <li><a href="#" class="hover:text-white">Phát triển phần mềm</a></li>
          <li><a href="#" class="hover:text-white">Tư vấn hệ thống</a></li>
          <li><a href="#" class="hover:text-white">Bảo mật thông tin</a></li>
          <li><a href="#" class="hover:text-white">Hỗ trợ kỹ thuật</a></li>
        </ul>
     </div>

     <div>
        <h6 class="font-semibold mb-4">Liên kết</h6>
        <ul class="space-y-2 text-gray-400">

          <li><a href="<?php echo URLROOT; ?>/public/" class="hover:text-white">Trang chủ</a></li>
          <li><a href="<?php echo URLROOT; ?>/public/index.php?url=about" class="hover:text-white">Giới thiệu</a></li>
          <li><a href="<?php echo URLROOT; ?>/public/index.php?url=pages/contact" class="hover:text-white">Liên hệ</a></li>

        </ul>
     </div>

    </div>

    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
      <p>© 2025 Do & Tan Solution. Tất cả quyền được bảo lưu.</p>
    </div>
 </div>
</footer>

</main>

<!-- (Script giữ nguyên của bạn) -->
<script>
</script>

</body>
</html>
