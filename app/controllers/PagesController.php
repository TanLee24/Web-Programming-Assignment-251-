<?php
// Nạp các Model cần thiết để lấy dữ liệu từ Database
require_once APPROOT . '/models/Setting.php';
require_once APPROOT . '/models/Faq.php';
require_once APPROOT . '/models/News.php';

class PagesController 
{
    private $settingModel;
    private $faqModel;
    private $newsModel;

    public function __construct() 
    {
        // Khởi tạo các Model
        $this->settingModel = new Setting();
        $this->faqModel = new Faq();
        $this->newsModel = new News();
    }

    // --- TRANG CHỦ ---
    public function home() 
    {
        // 4. LẤY TIN TỨC MỚI NHẤT
        // Lấy tất cả tin tức
        $allNews = $this->newsModel->all(); 
        
        // Chỉ lấy 3 bài mới nhất để hiện ở trang chủ
        $latestNews = array_slice($allNews, 0, 3);

        $data = [
            'title' => 'Trang Chủ - Do & Tan Sneakers',
            'latestNews' => $latestNews // TRUYỀN DỮ LIỆU SANG VIEW
        ];
        
        $this->loadView('public/home', $data);
    }

    // --- TRANG LIÊN HỆ (Giao diện) ---
    public function contact() 
    {
        $data = ['title' => 'Liên Hệ Chúng Tôi'];
        $this->loadView('public/contact', $data);
    }

    // --- TRANG GIỚI THIỆU ---
    public function about() 
    {
        // Lấy nội dung giới thiệu từ bảng settings
        $aboutTitle = $this->settingModel->get('about_title');
        $aboutContent = $this->settingModel->get('about_content');

        // Giá trị mặc định nếu Database chưa có gì
        if (empty($aboutTitle)) $aboutTitle = 'Về Chúng Tôi';
        if (empty($aboutContent)) $aboutContent = '<p>Đang cập nhật nội dung giới thiệu...</p>';

        $data = [
            'title' => $aboutTitle,
            'content' => $aboutContent
        ];
        $this->loadView('public/about', $data);
    }

    // --- TRANG HỎI ĐÁP / FAQ ---
    public function faq() 
    {
        // 1. Gọi Model để lấy toàn bộ danh sách câu hỏi từ Database
        $faqs = $this->faqModel->all();

        // 2. Chuẩn bị dữ liệu để gửi sang View
        $data = [
            'title' => 'Câu Hỏi Thường Gặp',
            'faqs' => $faqs // Biến này chứa mảng các câu hỏi
        ];

        // 3. Load giao diện faq.php
        $this->loadView('public/faq', $data);
    }

    // Hàm hỗ trợ load view
    public function loadView($viewPath, $data = []) 
    {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) 
            {
            ob_start();
            require_once $fileView;
            $content = ob_get_clean();
            require_once '../app/views/layouts/main.php';
        } 
        else 
        {
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }

    // --- TRANG DANH SÁCH TIN TỨC ---
    public function news() 
    {
        $data = [
            'title' => 'Tin Tức & Sự Kiện - Do & Tan Sneakers'
        ];
        
        $this->loadView('public/news/news', $data);
    }

    // --- TRANG CHI TIẾT TIN TỨC ---
    public function news_detail() 
    {
        // 1. Lấy ID từ URL (mặc định là 1 nếu không có)
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

        // 2. Dữ liệu của 3 bài báo (Giả lập Database)
        $articles = [
            1 => [
                'title' => 'Top 5 xu hướng Sneaker thống trị năm 2025',
                'category' => 'Xu hướng',
                'date' => '02/12/2025',
                'author' => 'Do & Tan Admin',
                'image' => 'https://images.unsplash.com/photo-1552346154-21d32810aba3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80',
                'intro' => 'Năm 2025 đánh dấu sự trở lại mạnh mẽ của phong cách Retro thập niên 90 và sự lên ngôi của các thiết kế bền vững (Sustainable).',
                'content' => '
                    <p class="mb-4">Thế giới Sneaker luôn vận động không ngừng. Nếu như năm 2024 là năm của những đôi giày tối giản (Minimalism), thì 2025 hứa hẹn sẽ bùng nổ với những thiết kế táo bạo hơn.</p>
                    <h3 class="text-2xl font-bold mb-2">1. Retro Runner</h3>
                    <p class="mb-4">Các mẫu giày chạy bộ cổ điển từ những năm 90 như New Balance 530 hay Nike Vomero 5 vẫn tiếp tục làm mưa làm gió. Sự thoải mái kết hợp với vẻ ngoài hoài cổ tạo nên sức hút khó cưỡng.</p>
                    <h3 class="text-2xl font-bold mb-2">2. Chunky & Bold</h3>
                    <p class="mb-4">Đế giày dày, đường nét hầm hố vẫn chưa hề hạ nhiệt. Các thương hiệu xa xỉ như Balenciaga hay các hãng thể thao như Puma đều đang đẩy mạnh xu hướng này.</p>
                    <p>Hãy ghé ngay cửa hàng Do & Tan để cập nhật những mẫu mới nhất nhé!</p>
                '
            ],
            2 => [
                'title' => 'Siêu phẩm Jordan 1 "Lost & Found" sắp cập bến',
                'category' => 'Sắp ra mắt',
                'date' => '28/11/2025',
                'author' => 'Sneakerhead Team',
                'image' => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80',
                'intro' => 'Huyền thoại Chicago đã trở lại với diện mạo vintage độc đáo. Do & Tan Sneakers tự hào là một trong những đơn vị đầu tiên mở bán.',
                'content' => '
                    <p class="mb-4">Không cần phải giới thiệu quá nhiều, phối màu Chicago trên dòng Air Jordan 1 luôn là "Chén Thánh" (Holy Grail) của mọi tín đồ giày.</p>
                    <h3 class="text-2xl font-bold mb-2">Câu chuyện "Lost & Found"</h3>
                    <p class="mb-4">Phiên bản lần này mang tên "Lost & Found" (Tìm lại & Đã mất), lấy cảm hứng từ những đôi giày Jordan 1 cũ kỹ nằm quên lãng trong các kho hàng thập niên 80. Phần da nứt nẻ ở cổ giày và hộp giày bị móp méo cố ý tạo nên vẻ đẹp thời gian.</p>
                    <h3 class="text-2xl font-bold mb-2">Ngày phát hành</h3>
                    <p class="mb-4">Sản phẩm sẽ chính thức có mặt tại Do & Tan Store vào ngày 15/12 tới đây. Số lượng cực kỳ giới hạn.</p>
                '
            ],
            3 => [
                'title' => 'Bí kíp bảo quản giày da lộn (Suede) mùa mưa',
                'category' => 'Mẹo hay',
                'date' => '20/11/2025',
                'author' => 'Chăm sóc khách hàng',
                'image' => 'https://images.unsplash.com/photo-1597045566677-8cf032ed6634?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80',
                'intro' => 'Giày da lộn rất khó chiều, đặc biệt là khi trời mưa. Xem ngay 3 bước đơn giản để giữ đôi giày yêu thích của bạn luôn mới.',
                'content' => '
                    <p class="mb-4">Da lộn (Suede) mang lại vẻ sang trọng nhưng lại là "kẻ thù" của nước. Nếu không biết cách chăm sóc, đôi giày của bạn sẽ rất nhanh bị cứng và bạc màu.</p>
                    <h3 class="text-2xl font-bold mb-2">Bước 1: Sử dụng xịt nano chống thấm</h3>
                    <p class="mb-4">Đây là bước phòng bệnh hơn chữa bệnh. Một lớp xịt nano (như Crep Protect) sẽ tạo hiệu ứng lá sen, giúp nước trượt đi thay vì thấm vào da.</p>
                    <h3 class="text-2xl font-bold mb-2">Bước 2: Tuyệt đối không phơi nắng/sấy nhiệt</h3>
                    <p class="mb-4">Nếu giày bị ướt, hãy nhét giấy báo vào bên trong để hút ẩm và phơi ở nơi thoáng gió. Nhiệt độ cao sẽ làm hỏng cấu trúc da ngay lập tức.</p>
                    <h3 class="text-2xl font-bold mb-2">Bước 3: Dùng bàn chải chuyên dụng</h3>
                    <p>Sau khi giày khô, dùng bàn chải cao su chải nhẹ để phục hồi độ bông của lớp da lộn.</p>
                '
            ]
        ];

        // 3. Chọn bài viết dựa trên ID (Nếu ID sai thì lấy bài 1)
        $selectedArticle = isset($articles[$id]) ? $articles[$id] : $articles[1];

        $data = [
            'title' => $selectedArticle['title'],
            'article' => $selectedArticle // Truyền toàn bộ dữ liệu bài viết sang View
        ];

        $this->loadView('public/news/news_detail', $data);
    }

    // --- CÁC TRANG HỖ TRỢ (Footer) ---
    
    // 1. Hướng dẫn chọn size
    public function size_guide() {
        $data = ['title' => 'Hướng dẫn chọn Size - Do & Tan Sneakers'];
        $this->loadView('public/footer_detail/size_guide', $data);
    }

    // 2. Chính sách đổi trả
    public function return_policy() {
        $data = ['title' => 'Chính sách đổi trả - Do & Tan Sneakers'];
        $this->loadView('public/footer_detail/return_policy', $data);
    }

    // 3. Chính sách bảo hành
    public function warranty() {
        $data = ['title' => 'Chính sách bảo hành - Do & Tan Sneakers'];
        $this->loadView('public/footer_detail/warranty', $data);
    }
}