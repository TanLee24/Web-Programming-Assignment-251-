--
-- Bảng 1: users (Quản lý người dùng, thành viên, admin)
-- Đáp ứng yêu cầu: Đăng ký, Đăng nhập [cite: 44], Thay đổi thông tin [cite: 46], Quản lý thành viên 
--
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    avatar_url VARCHAR(255) DEFAULT 'default_avatar.png',
    role ENUM('member', 'admin') NOT NULL DEFAULT 'member',
    status ENUM('active', 'banned') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
-- Bảng 2: news (Quản lý tin tức, bài viết)
-- Đáp ứng yêu cầu: Quản lý tin tức (thêm, sửa, xóa) [cite: 55], Tìm kiếm [cite: 43]
--
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    featured_image_url VARCHAR(255),
    author_id INT,
    slug VARCHAR(255) NOT NULL UNIQUE, -- Dùng cho URL thân thiện (SEO)
    seo_title VARCHAR(255),
    seo_description VARCHAR(255), -- [cite: 55]
    seo_keywords VARCHAR(255),   -- [cite: 55]
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL -- Giữ lại bài viết nếu xóa user
);

--
-- Bảng 3: products (Quản lý sản phẩm, dịch vụ)
-- Đáp ứng yêu cầu: Quản lý sản phẩm, dịch vụ, bảng giá [cite: 54], Tìm kiếm [cite: 43]
--
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL DEFAULT 0.00, -- 10 chữ số, 2 số sau dấu phẩy
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Bảng 4: comments (Quản lý bình luận)
-- Đáp ứng yêu cầu: Viết bình luận [cite: 47], Quản lý bình luận 
-- (Thiết kế đa hình: có thể dùng cho cả 'news' và 'products')
--
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    commentable_type ENUM('news', 'product') NOT NULL, -- Loại nội dung được bình luận
    commentable_id INT NOT NULL, -- ID của bài news hoặc product
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- Xóa user thì xóa bình luận
);

--
-- Bảng 5: contacts (Quản lý liên hệ của khách hàng)
-- Đáp ứng yêu cầu: Trang Liên hệ [cite: 34], Quản lý liên hệ [cite: 52, 75]
--
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') NOT NULL DEFAULT 'unread', -- [cite: 75]
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
-- Bảng 6: faqs (Quản lý Hỏi/Đáp)
-- Đáp ứng yêu cầu: Trang Hỏi/đáp [cite: 35], Quản lý Hỏi/đáp 
--
CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Bảng 7: settings (Quản lý thông tin chung trên các trang)
-- Đáp ứng yêu cầu: Quản lý thông tin public (logo, SĐT, địa chỉ...) 
--
CREATE TABLE settings (
    setting_key VARCHAR(100) NOT NULL PRIMARY KEY, -- Ví dụ: 'company_logo', 'contact_phone', 'about_page_content'
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Bảng 8 & 9: (Nâng cao) Quản lý Giỏ hàng / Đơn hàng
-- Đáp ứng yêu cầu: Quản lý giỏ hàng, đơn hàng 
--

-- Bảng 8: orders (Lưu thông tin tổng quan của đơn hàng)
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng 9: order_items (Lưu các sản phẩm cụ thể trong một đơn hàng)
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price_at_purchase DECIMAL(10, 2) NOT NULL, -- Lưu giá tại thời điểm mua, phòng trường hợp giá sản phẩm thay đổi
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Bảng bổ sung: password_resets (Hỗ trợ tính năng quên mật khẩu)
CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Bảng bổ sung: media_files (Quản lý ảnh và file upload)
CREATE TABLE media_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(100),
    file_size INT,
    uploaded_by INT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Bảng bổ sung: audit_logs (Theo dõi hành động của user để phục vụ bảo mật)
CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
