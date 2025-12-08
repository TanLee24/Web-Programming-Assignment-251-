-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2025 lúc 07:54 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_asgmt_database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `commentable_type` enum('news','product') NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `content`, `commentable_type`, `commentable_id`, `status`, `created_at`, `user_name`) VALUES
(2, 1, 'quaooo', 'news', 1, 1, '2025-12-04 09:15:15', ''),
(3, 2, 'húuuu', 'news', 2, 1, '2025-12-04 16:06:03', ''),
(4, 3, 'goat', 'news', 3, 1, '2025-12-06 08:34:18', ''),
(5, 1, 'xin giá shop ơii', 'news', 3, 1, '2025-12-06 08:46:28', ''),
(6, 4, 'Very helpful!', 'news', 4, 1, '2025-12-07 14:24:34', 'TannDz'),
(7, 3, 'hehehe', 'news', 3, 1, '2025-12-07 00:54:34', 'Do_admin'),
(9, 3, 'bổ x', 'news', 4, 0, '2025-12-07 10:12:38', 'Do_admin'),
(11, 3, 'bổ x', 'news', 4, 1, '2025-12-08 03:59:08', 'Do_admin'),
(12, 3, 'OMG!!', 'news', 3, 1, '2025-12-08 07:34:50', 'Do_admin'),
(13, 3, 'quá đã shop ơiii', 'news', 2, 0, '2025-12-08 08:08:37', 'Do_admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') NOT NULL DEFAULT 'unread',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `status`, `submitted_at`, `created_at`) VALUES
(3, 'Do Do', 'do@gmail.com', 'cần hỗ trợ size vans', 'replied', '2025-12-06 08:31:55', '2025-12-06 08:31:55'),
(4, 'Nguyễn Văn Á', 'as@gmail.com', 'hỗ trợ đổi size', 'unread', '2025-12-06 04:57:37', '2025-12-06 04:57:37'),
(5, 'Cao Lỗ', 'caolo@gmail.com', 'cần hình ảnh màu sắc giày thực tế', 'read', '2025-12-06 04:59:13', '2025-12-06 04:59:13'),
(6, 'Khoa Đỗ', 'khoa53640@gmail.com', 'hép hép', 'unread', '2025-12-07 00:34:38', '2025-12-07 00:34:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Giày bên shop có chính hãng không', '<p>C&aacute;c sản phẩm sneakers của shop đảm bảo <em><strong>100% authentic</strong></em>, nếu kh&aacute;ch ph&aacute;t hiện l&agrave; h&agrave;ng fake sẽ được đền gấp đ&ocirc;i gi&aacute; trị đ&ocirc;i gi&agrave;y.</p>', '2025-11-20 11:27:27', '2025-12-07 15:06:25'),
(2, 'Trong nội thành thành phố Hồ Chí Minh thì mất bao lâu để giao hàng?', '<p>Trong nội th&agrave;nh th&agrave;nh phố Hồ Ch&iacute; Minh th&igrave; thời gian giao h&agrave;ng tối đa l&agrave; <strong>3 ng&agrave;y</strong> bạn nh&eacute;.</p>', '2025-12-05 06:25:17', '2025-12-07 15:06:17'),
(3, 'Bên shop có free ship nội thành không ạ?', '<p>B&ecirc;n shop sẽ free ship cho bạn với đơn h&agrave;ng trị gi&aacute; <strong>tr&ecirc;n 1 triệu VNĐ</strong> bất kể ở đ&acirc;u nh&eacute;!</p>', '2025-12-07 15:01:53', '2025-12-07 15:05:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `featured_image_url` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `featured_image_url`, `author_id`, `slug`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(2, 'CHRISTMAS SALE!!!', '-->DTSNEAKERS100K  Giảm 100k cho đơn từ 1 Triệu\r\n✨ Ưu đãi chỉ có tại Drake VN\r\nÁp dụng qua website của DO&TAN SNEAKERS', '/public/uploads/1764842042_sale christmas web1.png', NULL, 'christmas-sale-', NULL, NULL, NULL, '2025-12-04 09:54:02', '2025-12-04 09:54:02'),
(3, 'Siêu phẩm trở lại: Air Jordan 1 Chicago \"Lost & Found\"', '<p>Sau bao ngày chờ đợi, huyền thoại <strong>Air Jordan 1 High OG \"Chicago\"</strong> đã chính thức quay trở lại với diện mạo mới mang tên \"Lost & Found\".</p><p>Được thiết kế với phong cách vintage, phần da nứt ở cổ giày và hộp giày cũ kỹ tạo cảm giác như bạn vừa tìm thấy một kho báu từ những năm 80. Phối màu Đỏ/Trắng/Đen kinh điển vẫn giữ nguyên sức hút mãnh liệt.</p><p>Hiện tại, Do & Tan Sneakers đã về sẵn full size cho anh em trải nghiệm. Số lượng cực kỳ giới hạn, hãy nhanh chân ghé store để cop ngay siêu phẩm này nhé!</p>', '/public/uploads/1765009272_air-jordan-1-2022-lost-and-found-chicago-the-inspiration-behind-the-design.avif', NULL, 'sieu-pham-tro-lai-air-jordan-1-chicago-lost-found-', NULL, 'Huyền thoại Air Jordan 1 Chicago đã trở lại với phiên bản Lost & Found. Sẵn hàng tại Do & Tan Sneakers.', NULL, '2025-12-06 07:51:26', '2025-12-06 08:21:12'),
(4, '5 Mẹo giữ giày Sneaker trắng luôn như mới', '<p>Giày trắng (All White) luôn là item \"must-have\" trong tủ đồ nhưng lại là nỗi ám ảnh vì quá dễ bẩn. Đừng lo, hãy áp dụng 5 mẹo nhỏ sau từ Do & Tan Sneakers:</p><ul class=\"list-disc list-inside space-y-2\"><li><strong>Dùng gôm tẩy:</strong> Với các vết bẩn nhỏ trên đế cao su, cục tẩy bút chì là cứu cánh nhanh nhất.</li><li><strong>Phủ Nano chống nước:</strong> Xịt một lớp Crep Protect hoặc nano trước khi ra đường để ngăn nước bẩn ngấm vào vải.</li><li><strong>Tránh phơi nắng gắt:</strong> Ánh nắng trực tiếp sẽ làm giày trắng bị ố vàng nhanh chóng. Hãy phơi trong bóng râm.</li><li><strong>Dùng kem đánh răng:</strong> Một ít kem đánh răng trắng và bàn chải mềm có thể làm sạch viền đế hiệu quả.</li></ul><p>Hy vọng tips nhỏ này giúp đôi giày cưng của bạn luôn bền đẹp!</p>', '/public/uploads/1765009289_vesinhgiay.webp', NULL, '5-meo-giu-giay-sneaker-trang-luon-nhu-moi', NULL, 'Bí quyết vệ sinh và bảo quản giày sneaker trắng không bị ố vàng cực đơn giản.', NULL, '2025-12-06 07:51:26', '2025-12-06 08:21:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` enum('subscribed','unsubscribed') NOT NULL DEFAULT 'subscribed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `status`, `created_at`) VALUES
(1, 'khoa53640@gmail.com', 'subscribed', '2025-12-06 07:09:07'),
(2, 'khoa53@gmail.com', 'subscribed', '2025-12-06 07:37:48'),
(3, 'do@gmail.com', 'subscribed', '2025-12-07 05:14:58'),
(4, 'abc@a.com', 'subscribed', '2025-12-08 03:59:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`, `fullname`, `phone`, `address`, `note`) VALUES
(1, 0, 8787000.00, 'completed', '2025-11-20 11:07:20', 'Tan', '0123456789', 'VN', 'zzzz'),
(3, 0, 2650000.00, 'processing', '2025-12-05 06:44:38', 'Lê Hoàng Tân', '0123456789', 'Cambodia', 'đóng gói cẩn thận'),
(4, 0, 1600000.00, 'pending', '2025-12-08 05:59:18', 'Khoa Đỗ', '0903191036', 'Nguyễn Văn Lạc', 'lẹ lẹ sốp ơi'),
(6, 0, 17000000.00, 'pending', '2025-12-08 15:00:36', 'Lê Hoàng Tân', '0904437143', 'phường Bình Trưng', 'đóng gói cẩn thận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price_at_purchase`) VALUES
(1, 1, 1, '38', 3, 2929000.00),
(2, 3, 2, '43', 1, 2650000.00),
(3, 4, 4, '39', 1, 1600000.00),
(5, 6, 5, '43', 1, 17000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(14, 9, '2e6bd3f754441df9ed0099d785e9bbecaf2a0a14a21a479d938fabb6e52f158f', '2025-12-08 00:52:46', '2025-12-07 23:52:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `brand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `image_url`, `price`, `created_at`, `updated_at`, `brand`) VALUES
(1, 'Nike Air Force 1', 'nike-air-force-1', '<p>Nike Air Force 1 Low AllWhite l&agrave; một biểu tượng thời trang kh&ocirc;ng thể chối c&atilde;i, với thiết kế cổ điển, tinh tế c&ugrave;ng gam m&agrave;u trắng thanh lịch, ph&ugrave; hợp với mọi phong c&aacute;ch v&agrave; ho&agrave;n cảnh. Được ra mắt v&agrave;o năm 1982, Air Force 1 l&agrave; đ&ocirc;i gi&agrave;y b&oacute;ng rổ đầu ti&ecirc;n sở hữu c&ocirc;ng nghệ đệm kh&iacute; Air, tạo n&ecirc;n bước ngoặt lịch sử cho Nike. Với phi&ecirc;n bản Air Force 1 Low ra mắt sau đ&oacute;, nhanh ch&oacute;ng trở th&agrave;nh biểu tượng thời trang đường phố được y&ecirc;u th&iacute;ch bởi giới trẻ.</p>', '/public/uploads/1765124066_ce76a10b.jpg', 2929000.00, '2025-11-20 07:30:17', '2025-12-08 15:43:16', 'Nike'),
(2, 'Adidas Ultraboost 23 Light', 'adidas-ultraboost-23-light', 'Trải nghiệm năng lượng sử thi với Ultraboost Light mới, Ultraboost nhẹ nhất từ trước đến nay của chúng tôi. Điều kỳ diệu nằm ở đế giữa Light BOOST, một thế hệ mới của adidas BOOST. Thiết kế phân tử độc đáo của nó tạo ra bọt BOOST nhẹ nhất cho đến nay và tự hào có lượng khí thải carbon thấp hơn 10% so với các mẫu trước đó (để biết thêm thông tin, hãy xem phần Câu hỏi thường gặp bên dưới).\r\n\r\nĐược thiết kế đặc biệt cho dáng người phụ nữ, Ultraboost Light có phần gót vừa vặn hơn cộng với đường cong mu bàn chân thấp hơn được thiết kế giúp giảm trượt gót và phồng rộp. Với đệm, sự thoải mái và độ phản hồi cao nhất, một số bàn chân thực sự có thể có được tất cả.', '/public/uploads/1764957256_Ultraboost-Light-Core-black.jpg', 2650000.00, '2025-11-20 11:22:42', '2025-12-08 15:43:16', 'Adidas'),
(3, 'Vans Old Skool Classic Black', 'vans-old-skool-classic-black', 'Được gọi vui một cách thân thuộc là \"giày VANS đen\" vốn là một sự phổ biến rất đặc biệt đối với các tín đồ của nhà VANS. Tới nay đôi giày chỉ với phối màu đen trắng này vẫn nằm trong top \"Best Seller\" của VANS trên toàn thế giới, với kiểu dáng cổ điển cùng \"sọc Jazz\" huyền thoại hợp thời trang khiến đôi VANS này thật sự trở thành mẫu giày classic bất bại, là fan hâm mộ của VANS nói chung và những skaters nói riêng đều nên có một đôi trong tủ giày. Được mệnh danh là phiên bản mang \"càng cũ càng đẹp\" và nhiều phiên bản custom  bậc nhất của nhà VANS.', '/public/uploads/1764956608_vans.png', 1480000.00, '2025-12-05 17:43:28', '2025-12-08 15:43:16', 'Vans'),
(4, 'Converse Chuck Taylor All Star 1970s Parchment Hi Top', 'converse-chuck-taylor-all-star-1970s-parchment-hi-top', 'Giày Converse Chuck Taylor All Star 1970s Parchment Hi Top  với form dáng của Chuck 70s, phiên bản Hi Top Parchment với màu trắng ngà basic đã mang tới cho người dùng một bản phối hiện đại, trẻ trung mà vẫn đậm màu vintage. Bằng những chất liệu truyền thống, được chăm chút tỉ mẩn trong từng đường nét, item này đã lọt vào top những mẫu sneaker đang làm mưa làm gió trên thị trường sneaker hiện đại.', '/public/uploads/1764956977_converse.jpg', 1600000.00, '2025-12-05 17:49:37', '2025-12-08 15:43:16', 'Converse'),
(5, 'Air Jordan 4 Retro Motorsports', 'air-jordan-4-retro-motorsports', 'Air Jordan 4 Retro Motorsports 2017 được lấy cảm hứng từ một màu sắc cho bạn bè và gia đình của năm 2006 được làm để kỷ niệm sự ra đời của đội đua xe MJ Motorsports vào năm thứ tư.\r\n\r\nSự kết hợp giữa màu đen, xanh vương triều và trắng của đội được bao gồm trong các giày dép Retro Motorsports Air Jordan này. Tuy nhiên, phần mũ Blackmon Mars của mẫu năm 2006 không có trong thiết kế này. Sản phẩm cũng có một phiên bản màu đen.', '/public/uploads/1764957852_jordan.jpg', 17000000.00, '2025-12-05 18:04:12', '2025-12-08 15:43:16', 'Nike'),
(6, ' Adidas Yeezy Boost 700 Salt', '-adidas-yeezy-boost-700-salt', 'Nếu bạn là một fan hâm mộ của Yeezy 500 Salt, thì Yeezy Boost 700 Salt được sản xuất dành riêng cho bạn! Kể từ khi nó có thông tin ra mắt lần đầu tiên vào cuối năm 2018, các sneakerhead ở khắp mọi nơi đã kiên nhẫn chờ đợi sự ra mắt của đôi giày chunky này, và bây giờ có vẻ như chúng ta sẽ sớm đưa chúng vào bộ sưu tập của mình!\r\n\r\nĐược sơn màu trắng nhạt làm nổi bật bộ outfit của bạn, ‘Salt’ được làm từ da và lưới. Nằm trên phần đế giữa vẫn được làm Boost chunky, nó được hoàn thiện bằng một đế ngoài cao su cứng và bền ở bên dưới.\r\n\r\nNgay cả khi nó trở nên sạch sẽ, nếu bạn vẫn đang tìm kiếm một đôi giày thể thao độc đáo để thêm vào bộ sưu tập của mình, thì không đâu xa hơn là Yeezy Boost 700 Salt. Được đồn đại sẽ phát hành vào tháng 2 năm 2019, mẫu giày này không giống bất kỳ mẫu nào khác hiện có trên thị trường và chắc chắn sẽ khiến bạn chú ý.', '/public/uploads/1764958102_yeezy.jpg', 7500000.00, '2025-12-05 18:08:22', '2025-12-08 15:43:16', 'Adidas'),
(7, 'MLB Chunky Liner Classic Monogram Boston Red Sox Brown', 'mlb-chunky-liner-classic-monogram', '<p>Họa tiết Monogram cổ điển lu&ocirc;n l&agrave; biểu tượng của thương hiệu MLB, nay đ&atilde; được kh&eacute;o l&eacute;o kết hợp v&agrave;o thiết kế của đ&ocirc;i gi&agrave;y sneakers Chunky Liner Classic Monogram để tạo n&ecirc;n một thiết kế mới mẻ, độc đ&aacute;o. Với phom d&aacute;ng &ocirc;m ch&acirc;n vừa vặn kết hợp c&ugrave;ng gam m&agrave;u trắng thanh lịch v&agrave; điểm nhấn l&agrave; logo monogram ở phần th&acirc;n gi&agrave;y, kh&ocirc;ng c&ograve;n nghi ngờ g&igrave; nữa, đ&acirc;y ch&iacute;nh l&agrave; item ho&agrave;n hảo biến mọi bản phối thời trang của bạn th&ecirc;m phần ph&oacute;ng kho&aacute;ng, s&agrave;nh điệu hơn bao giờ hết.</p>', '/public/uploads/1765197006_ad60f68c.jpg', 3590000.00, '2025-12-08 12:30:06', '2025-12-08 15:43:16', 'MLB'),
(8, 'Puma Speedcat OG Black Pink', 'puma-speedcat-og-black-pink', '<p><strong>Gi&agrave;y Puma Speedcat OG &lsquo;Black Pink&rsquo;&nbsp;</strong>l&agrave; một mẫu gi&agrave;y thể thao mang đậm phong c&aacute;ch retro, kết hợp giữa thiết kế thể thao cổ điển v&agrave; c&aacute;c yếu tố hiện đại. Mẫu gi&agrave;y n&agrave;y l&agrave; một trong những sản phẩm trong d&ograve;ng&nbsp;<strong>Speedcat OG</strong> của Puma, được t&aacute;i ph&aacute;t h&agrave;nh với c&aacute;c cải tiến để mang lại sự thoải m&aacute;i v&agrave; phong c&aacute;ch độc đ&aacute;o.</p>', '/public/uploads/1765197256_91d5a747.jpg', 3590000.00, '2025-12-08 12:34:16', '2025-12-08 15:43:16', 'Puma'),
(9, 'New Balance 530 \'White\'', 'new-balance-530-white', '<p>Trong những năm gần đ&acirc;y, tr&agrave;o lưu sneaker mang phong c&aacute;ch Y2K (2000s) đang quay trở lại mạnh mẽ, v&agrave; kh&ocirc;ng c&aacute;i t&ecirc;n n&agrave;o thể hiện xu hướng đ&oacute; r&otilde; n&eacute;t hơn&nbsp;<strong data-start=\"384\" data-end=\"403\">New Balance 530</strong>. Trong đ&oacute;, phi&ecirc;n bản&nbsp;<strong data-start=\"425\" data-end=\"460\">New Balance 530 &lsquo;White&rsquo; </strong>đ&atilde; nhanh ch&oacute;ng trở th&agrave;nh đ&ocirc;i gi&agrave;y &ldquo;quốc d&acirc;n&rdquo; nhờ thiết kế tối giản, tinh tế nhưng vẫn đầy t&iacute;nh thời trang.</p>', '/public/uploads/1765197618_d6ff9f59.png', 2489000.00, '2025-12-08 12:36:58', '2025-12-08 15:43:16', 'New Balance');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `stock`) VALUES
(1, 1, '38', 12),
(2, 1, '39', 8),
(3, 1, '40', 15),
(4, 1, '41', 10),
(5, 1, '42', 7),
(6, 1, '43', 5),
(7, 1, '37', 3),
(8, 2, '38', 5),
(9, 2, '39', 9),
(10, 2, '40', 12),
(11, 2, '41', 14),
(12, 2, '42', 10),
(13, 2, '43', 6),
(14, 3, '38', 20),
(15, 3, '39', 18),
(16, 3, '40', 15),
(17, 3, '41', 12),
(18, 3, '42', 10),
(19, 3, '43', 8),
(20, 4, '38', 10),
(21, 4, '39', 14),
(22, 4, '40', 16),
(23, 4, '41', 9),
(24, 4, '42', 6),
(25, 4, '43', 4),
(26, 5, '40', 3),
(27, 5, '41', 5),
(28, 5, '42', 2),
(29, 5, '43', 1),
(30, 6, '39', 6),
(31, 6, '40', 8),
(32, 6, '41', 7),
(33, 6, '42', 4),
(34, 6, '43', 3),
(35, 7, '38', 10),
(36, 7, '39', 12),
(37, 7, '40', 11),
(38, 7, '41', 7),
(39, 7, '42', 5),
(40, 7, '43', 3),
(41, 8, '38', 6),
(42, 8, '39', 9),
(43, 8, '40', 8),
(44, 8, '41', 5),
(45, 8, '42', 4),
(46, 8, '43', 2),
(47, 9, '38', 15),
(48, 9, '39', 12),
(49, 9, '40', 10),
(50, 9, '41', 9),
(51, 9, '42', 6),
(52, 9, '43', 4),
(53, 9, '37', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'about_content', '<p data-path-to-node=\"7\">Xuất ph&aacute;t điểm từ những kẻ nghiện gi&agrave;y (Sneakerheads) ch&iacute;nh hiệu, ch&uacute;ng t&ocirc;i hiểu rằng một đ&ocirc;i gi&agrave;y kh&ocirc;ng chỉ l&agrave; phụ kiện để bảo vệ đ&ocirc;i ch&acirc;n. N&oacute; l&agrave; tiếng n&oacute;i của c&aacute; t&iacute;nh, l&agrave; biểu tượng của văn h&oacute;a đường phố, v&agrave; l&agrave; người bạn đồng h&agrave;nh tr&ecirc;n mọi h&agrave;nh tr&igrave;nh chinh phục ước mơ.</p>\r\n<p data-path-to-node=\"8\">&nbsp;</p>\r\n<p data-path-to-node=\"8\">Tại&nbsp;<strong>Do &amp; Tan Sneakers</strong>, ch&uacute;ng t&ocirc;i kh&ocirc;ng b&aacute;n những đ&ocirc;i gi&agrave;y v&ocirc; tri. Ch&uacute;ng t&ocirc;i mang đến sự tự tin v&agrave; phong c&aacute;ch sống. Từ những huyền thoại bất tử như <em>Nike Air Force 1, Jordan 1</em> cho đến những c&ocirc;ng nghệ ti&ecirc;n phong như <em>Adidas Ultraboost</em>, mỗi sản phẩm tr&ecirc;n kệ h&agrave;ng đều được tuyển chọn khắt khe với ti&ecirc;u chuẩn Authentic 100%.</p>\r\n<p data-path-to-node=\"9\">&nbsp;</p>\r\n<p data-path-to-node=\"9\">Sứ mệnh của ch&uacute;ng t&ocirc;i rất đơn giản nhưng đầy tham vọng:&nbsp;<strong>\'Mang tinh hoa Sneaker thế giới đặt l&ecirc;n b&agrave;n ch&acirc;n Việt\'</strong>. Ch&uacute;ng t&ocirc;i cam kết x&oacute;a bỏ mọi r&agrave;o cản về h&agrave;ng giả, h&agrave;ng nh&aacute;i, để bạn c&oacute; thể bước đi đầy ki&ecirc;u h&atilde;nh với những sản phẩm ch&iacute;nh h&atilde;ng chất lượng nhất.</p>', '2025-12-07 06:07:59'),
(7, 'about_title', '', '2025-12-07 05:55:51'),
(4, 'address', 'TP.HCM', '2025-12-03 11:29:58'),
(2, 'company_name', 'Do&Tan sneakers', '2025-12-06 08:07:28'),
(5, 'intro_text', 'Chào mừng đến với website', '2025-12-03 11:29:58'),
(6, 'logo_path', 'uploads/1764776561_logo3.png', '2025-12-03 15:42:41'),
(3, 'phone', '0909123456', '2025-12-03 15:32:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT 'default_avatar.png',
  `role` enum('member','admin') NOT NULL DEFAULT 'member',
  `status` enum('active','banned') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `full_name`, `avatar_url`, `role`, `status`, `created_at`) VALUES
(1, 'Do1st', 'khoa53640@gmail.com', '$2y$10$YFH6ucrpaTY/7Ca6VsXT5OJlMdn9IuhSeGzT2w8kVQhYKPb.OQ4T6', 'Khoa Đỗ', 'uploads/avatars/avatar_1_1764862049.jpg', 'member', 'active', '2025-12-04 09:14:37'),
(2, 'bot', 'bot@gmail.com', '$2y$10$s0tehCOa6Jp6XvlW/R1WMeTFb6T/Rqu.CZn1h7V4MiekjikgxuupC', 'bot1->2', 'default_avatar.png', 'member', 'active', '2025-12-04 16:03:56'),
(3, 'doadmin', 'doadmin@gmail.com', '$2y$10$zaLWKnJ3MYfvqqAYs3TTheTY3Lg9mK5UC6DevF8BjAkDVu53APYYO', 'Do_admin', 'default_avatar.png', 'admin', 'active', '2025-12-04 16:26:48'),
(4, 'TanLe24', 'tandepzai24@gmail.com', '$2y$10$Q3zv1Lrc0tSK9eGV2KlNWumtlSRhXDY/g0sA5aI.ozWk4UZaQ46OS', 'TannDz', 'uploads/avatars/avatar_4_1764915262.png', 'admin', 'active', '2025-12-05 06:13:39'),
(5, 'User123', 'abc@gmail.com', '$2y$10$tp7tx4/RimZvwBWGtig4kumiyhbj69fcI2nm1hvq9BOtS.6iA6gFO', 'User123', 'uploads/avatars/avatar_5_a153b18688c91521.jpg', 'member', 'active', '2025-12-05 07:54:18'),
(6, 'imbot', 'imbot@g', '$2y$10$LLKKZWM5i2jzwN50vAPAAeFjLLfPLaPPQGJWqdaRL.Fs8pIIoaRRm', 'imBot', 'default_avatar.png', 'member', 'active', '2025-12-07 23:34:15'),
(7, 'hehe', 'heehe@g', '$2y$10$GyStprjJ2kK.uZ6ZRXSNiujuZh4Ask7BnpDBIFn2LHAhZHdD7RjNi', 'hehe', 'default_avatar.png', 'member', 'active', '2025-12-07 23:39:06'),
(8, 'tm', 'tm@aknfa', '$2y$10$dJhZMTIWlLDyCaeBf1yrqeV9hftzSEovjBN1Gmq.yYdKCC3tt5TVy', 'test mail', 'default_avatar.png', 'member', 'active', '2025-12-07 23:41:28'),
(9, 'a', 'a@hehe.com', '$2y$10$eoat8mV1uNWqYUQjVCg6ZO0SqJWcudOqelKcN8vCYMeqGZ88Vp1ou', 'a', 'default_avatar.png', 'member', 'active', '2025-12-07 23:48:43');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_key`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
