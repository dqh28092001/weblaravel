-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2023 lúc 11:51 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `weblaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_08_074629_create_tbl_admin_table', 1),
(6, '2023_10_08_074849_create_tbl_category_product', 1),
(7, '2023_10_08_074916_create_tbl_product', 1),
(8, '2023_10_08_075000_create_tbl_brand_product', 1),
(9, '2023_10_16_032222_tbl_customer', 2),
(10, '2023_10_16_041449_tbl_shipping', 3),
(11, '2023_10_16_081729_tbl_payment', 4),
(12, '2023_10_16_081956_tbl_oder', 4),
(13, '2023_10_16_082019_tbl_oder_detail', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Đặng Quốc Huy', '0334630884', '2023-09-27 04:22:12', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand_product`
--

CREATE TABLE `tbl_brand_product` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug` varchar(255) NOT NULL,
  `brand_desc` text NOT NULL,
  `brand_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand_product`
--

INSERT INTO `tbl_brand_product` (`brand_id`, `brand_name`, `brand_slug`, `brand_desc`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Dior', 'Dior', 'DIOR official website. Discover Christian Dior fashion, fragrances and accessories for Women and Men.', 0, NULL, NULL),
(2, 'Burberry', 'Burberry', 'Burberry là một hãng thời trang sang trọng của Anh, phân phối quần áo thể thao độc đáo sang trọng, phụ kiện thời trang, nước hoa, kính mát, và mỹ phẩm.', 0, NULL, NULL),
(3, 'Hermès', 'Hermès', 'Hermès là một thương hiệu thời trang sang trọng bậc nhất, sản phẩm đặc trưng ngoài cà vạt và khăn lụa là dòng túi Birkin và dòng túi Kelly.', 0, NULL, NULL),
(4, 'Chanel', 'Chanel', 'Nước hoa Chanel – Đại diện của sự sang trọng, tinh tế và đẳng cấp. Chanel là một hãng thời trang Pháp, tại Paris được sáng lập bởi CoCo Chanel (1883 - 1971).', 0, NULL, NULL),
(5, 'Louis Vuitton', 'Louis Vuitton', 'Louis Vuitton (viết tắt là LV) là thương hiệu thời trang cao cấp đến từ Pháp danh giá bậc nhất thế giới, thành lập từ năm 1854, mang tên chính người sáng lập .', 0, NULL, NULL),
(6, 'Gucci', 'Gucci', 'Gucci là một thương hiệu hàng xa xỉ châu Âu được kiểm soát và chủ trì bởi doanh nhân người Pháp Bernard Arnault, người cũng đứng đầu LVMH, tập đoàn xa xỉ lớn ...', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` text NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Gucci', 'Gucci hàng hiệu là một thương hiệu thời trang và đồ da cao cấp của Ý. Gucci được thành lập bởi Guccio Gucci tại Florence, Tuscany, vào năm 1921.', 0, NULL, NULL),
(2, 'D&G', 'D&G Junior là dòng sản phẩm dành cho trẻ em dưới 15 tuổi. Các dòng sản phẩm nổi bật của Dolce & Gabbana sản xuất. Thời trang may mặc của Dolce & Gabbana. Dolce ...', 0, NULL, NULL),
(3, 'Burberry', 'Burberry là một hãng thời trang sang trọng của Anh, phân phối quần áo thể thao độc đáo sang trọng, phụ kiện thời trang, nước hoa, kính mát, và mỹ phẩm.', 0, NULL, NULL),
(4, 'Fendi', 'Thương hiệu Fendi được khởi nguồn từ một cửa hàng chuyên về đồ da và lông thú do Edoarnado và Adele Fendi sáng lập. Độ tuổi của Fendi từ 20-50 tuổi.', 0, NULL, NULL),
(5, 'Chanel', 'Nước hoa Chanel – Đại diện của sự sang trọng, tinh tế và đẳng cấp. Chanel là một hãng thời trang Pháp, tại Paris được sáng lập bởi CoCo Chanel (1883 - 1971).', 0, NULL, NULL),
(6, 'Hermès', 'Hermès là một thương hiệu thời trang sang trọng bậc nhất, sản phẩm đặc trưng ngoài cà vạt và khăn lụa là dòng túi Birkin và dòng túi Kelly.', 0, NULL, NULL),
(7, 'Louis Vuitton', 'Louis Vuitton (viết tắt là LV) là thương hiệu thời trang cao cấp đến từ Pháp danh giá bậc nhất thế giới, thành lập từ năm 1854, mang tên chính người sáng lập .', 0, NULL, NULL),
(9, 'Burberry', 'ádasd', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `created_at`, `updated_at`) VALUES
(7, 'huy', 'dqh28092001@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '1234', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_oder`
--

CREATE TABLE `tbl_oder` (
  `oder_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `oder_status` varchar(50) NOT NULL,
  `oder_code` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_oder`
--

INSERT INTO `tbl_oder` (`oder_id`, `customer_id`, `shipping_id`, `oder_status`, `oder_code`, `created_at`, `updated_at`) VALUES
(28, 7, 22, '1', '9ddc8', '2023-10-19 03:09:22', NULL),
(29, 7, 23, '1', 'c8cdb', '2023-10-19 03:18:31', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_oder_detail`
--

CREATE TABLE `tbl_oder_detail` (
  `oder_detail_id` bigint(20) UNSIGNED NOT NULL,
  `oder_code` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_sales_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_oder_detail`
--

INSERT INTO `tbl_oder_detail` (`oder_detail_id`, `oder_code`, `product_id`, `product_name`, `product_price`, `product_sales_quantity`, `created_at`, `updated_at`) VALUES
(46, '9ddc8', 6, 'Giày Đen', '300000', 1, NULL, NULL),
(47, '9ddc8', 3, 'Váy Thời Trang', '300000', 1, NULL, NULL),
(48, '9ddc8', 8, 'Áo Khoác', '300000', 2, NULL, NULL),
(49, '9ddc8', 1, 'Sơ Mi', '900000', 2, NULL, NULL),
(50, 'c8cdb', 6, 'Giày Đen', '300000', 2, NULL, NULL),
(51, 'c8cdb', 3, 'Váy Thời Trang', '300000', 2, NULL, NULL),
(52, 'c8cdb', 8, 'Áo Khoác', '300000', 2, NULL, NULL),
(53, 'c8cdb', 1, 'Sơ Mi', '900000', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` varchar(50) NOT NULL,
  `product_sold` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_content` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_quantity`, `product_sold`, `category_id`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 'Sơ Mi', '6', 12, 7, 5, 'Dior là một thương hiệu hàng xa xỉ châu Âu được kiểm soát và chủ trì bởi doanh nhân người Pháp Bernard Arnault, người cũng đứng đầu LVMH, tập đoàn xa xỉ lớn ...', 'Dior là một thương hiệu hàng xa xỉ châu Âu được kiểm soát và chủ trì bởi doanh nhân người Pháp Bernard Arnault, người cũng đứng đầu LVMH, tập đoàn xa xỉ lớn ...', '900000', '65006f810807f_cac-thuong-hieu-thoi-trang-noi-tieng_1.png', 0, NULL, NULL),
(2, 'Áo cọc', '20', 0, 6, 3, 'Mua áo cọc đôi chất lượng giá tốt, freeship toàn quốc 0Đ, áp dụng đến 6 tầng giảm giá. Ưu đãi mỗi ngày, hoàn tiền đến 300K. Mua ngay áo cọc đôi tại Lazada.\"\"\"\"', 'Mua áo cọc đôi chất lượng giá tốt, freeship toàn quốc 0Đ, áp dụng đến 6 tầng giảm giá. Ưu đãi mỗi ngày, hoàn tiền đến 300K. Mua ngay áo cọc đôi tại Lazada.\"\"\"\"', '122000', 'cac-thuong-hieu-thoi-trang-noi-tieng-2_67.png', 0, NULL, NULL),
(3, 'Váy Thời Trang', '22', 8, 5, 4, 'Đa dạng lựa chọn: Áo chui đầu, cài khuy và áo cộc tay hoặc dài tay, cổ chữ V, cổ lọ hoặc cổ tròn. Vô cùng mềm mại, thoải mái và nhiều màu sắc. Khám phá ngay! ÁO ..\"\"\"\"\"\"\"\"\"\"\"\"', 'Đa dạng lựa chọn: Áo chui đầu, cài khuy và áo cộc tay hoặc dài tay, cổ chữ V, cổ lọ hoặc cổ tròn. Vô cùng mềm mại, thoải mái và nhiều màu sắc. Khám phá ngay! ÁO ..\"\"\"\"\"\"\"\"\"\"\"\"', '300000', 'rp-3_13.jpg', 0, NULL, NULL),
(4, 'Váy Dạ Hội', '10', 0, 3, 2, 'Trong đây là những mẫu váy đi biển đẹp nhất được Lami Shop chọn lọc rất kỹ, với đủ màu sắc và kiểu dáng khác nhau như: váy maxi dài đi biển màu trắng, maxi đi ...\"\"\"\"', 'Trong đây là những mẫu váy đi biển đẹp nhất được Lami Shop chọn lọc rất kỹ, với đủ màu sắc và kiểu dáng khác nhau như: váy maxi dài đi biển màu trắng, maxi đi ...\"\"\"\"', '321000', 'rp-2_1.jpg', 0, NULL, NULL),
(5, 'Túi xách', '20', 0, 1, 6, 'Bộ sư tập túi xách hàng hiệu, đẹp, cao cấp chính hãng đến từ thương hiệu Vascara, Túi xách Vascara luôn cập nhập những mẫu mới nhất phù hợp với mọi phong ...\"\"\"\"\"', 'Bộ sư tập túi xách hàng hiệu, đẹp, cao cấp chính hãng đến từ thương hiệu Vascara, Túi xách Vascara luôn cập nhập những mẫu mới nhất phù hợp với mọi phong ...\"\"\"\"\"', '321000', '65003d9442732_mau-tui-xach-moi-la-cao-cap-cua-loewe_35.png', 0, NULL, NULL),
(6, 'Giày Đen', '16', 12, 5, 4, 'Mua online giày đen chất lượng, mới nhất, giảm tới 50% tại Shopee Việt Nam. Khuyến mãi tháng 10. Miễn phí vận chuyển. Mua ngay!', 'Mua online giày đen chất lượng, mới nhất, giảm tới 50% tại Shopee Việt Nam. Khuyến mãi tháng 10. Miễn phí vận chuyển. Mua ngay!', '300000', '650039d532026_cac-thuong-hieu-thoi-trang-noi-tieng-5_88.png', 0, NULL, NULL),
(7, 'Váy Đi Biển', '60', 0, 1, 6, 'Mua đầm đi biển giao tận nơi và tham khảo thêm nhiều sản phẩm khác. Miễn phí vận chuyển toàn quốc cho mọi đơn hàng . Đổi trả dễ dàng. Thanh toán bảo mật.\"\"\"\"\"', 'Mua đầm đi biển giao tận nơi và tham khảo thêm nhiều sản phẩm khác. Miễn phí vận chuyển toàn quốc cho mọi đơn hàng . Đổi trả dễ dàng. Thanh toán bảo mật.\"\"\"\"\"', '122000', 'images_52.jfif', 0, NULL, NULL),
(8, 'Áo Khoác', '8', 12, 7, 5, 'Mua sắm ngay áo khoác cho nam với nhiều màu sắc và kiểu dáng khác nhau từ những công nghệ tiên như chống UV, Siêu nhẹ và hơn thế nữa!\"', 'Mua sắm ngay áo khoác cho nam với nhiều màu sắc và kiểu dáng khác nhau từ những công nghệ tiên như chống UV, Siêu nhẹ và hơn thế nữa!\"', '300000', '65003e38cf0a7_pc-ao-khoac-du-nam-truot-nuoc-mau-xanh-da-quang-large-1669600982-6771_29.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_note` text NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `shipping_email`, `shipping_note`, `shipping_method`, `created_at`, `updated_at`) VALUES
(22, 'huydang', 'trungnuwvuon', '1234567890', 'dqh28092001@gmail.com', 'adasd', 1, NULL, NULL),
(23, 'huydang', 'trungnuwvuon', '1234567890', 'dqh28092001@gmail.com', 'adasda', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand_product`
--
ALTER TABLE `tbl_brand_product`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_oder`
--
ALTER TABLE `tbl_oder`
  ADD PRIMARY KEY (`oder_id`);

--
-- Chỉ mục cho bảng `tbl_oder_detail`
--
ALTER TABLE `tbl_oder_detail`
  ADD PRIMARY KEY (`oder_detail_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand_product`
--
ALTER TABLE `tbl_brand_product`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_oder`
--
ALTER TABLE `tbl_oder`
  MODIFY `oder_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tbl_oder_detail`
--
ALTER TABLE `tbl_oder_detail`
  MODIFY `oder_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
