-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2024 at 01:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radix`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int NOT NULL,
  `thumbnail` text COLLATE utf8mb4_vietnamese_ci,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `user_id` int DEFAULT '0',
  `category_id` int DEFAULT '0',
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `view_count` int DEFAULT '0',
  `dscription` text COLLATE utf8mb4_vietnamese_ci,
  `duplicate` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `thumbnail`, `title`, `slug`, `user_id`, `category_id`, `content`, `view_count`, `dscription`, `duplicate`, `create_at`, `update_at`) VALUES
(2, '/radix/uploads/images/DuAn/anhduan2.jpg', 'Đánh giá sản phẩm TUF F15', 'danh-gia-san-pham-tuf-f15', 1, 3, '&#60;h4&#62;&#60;strong&#62;Đánh giá sản ph&#38;acirc;̉m TUF F15&#60;/strong&#62;&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond&#60;/p&#62;&#13;&#10;', 27, 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond', 1, '2024-06-18 13:47:01', '2024-06-18 13:47:41'),
(3, '/radix/uploads/images/DuAn/anhduan3.jpg', 'Có nên dùng Bootstrap?', 'co-nen-dung-bootstrap', 1, 1, '&#60;h2&#62;Có n&#38;ecirc;n dùng Bootstrap?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond,&#38;nbsp;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond&#60;/p&#62;&#13;&#10;', 105, 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond', 0, '2024-06-18 14:54:30', '2024-06-18 14:54:30'),
(4, '/radix/uploads/images/DuAn/anhduan5.jpg', 'Lập trình web với Laravel', 'lap-trinh-web-voi-laravel', 1, 3, '&#60;h2&#62;L&#38;acirc;̣p trình web với Laravel&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond,&#38;nbsp;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:166.55px; top:37px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 10, 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond', 1, '2024-06-18 15:07:29', '2024-06-18 15:07:29'),
(5, '/radix/uploads/images/slider-image2.jpg', 'Cách để debug hiệu quả', 'cach-de-debug-hieu-qua', 1, 1, '&#60;h2&#62;Cách đ&#38;ecirc;̉ debug hi&#38;ecirc;̣u quả&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond,&#38;nbsp;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:161.675px; top:27px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 20, 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond', 0, '2024-06-18 16:03:13', '2024-06-18 16:03:13'),
(10, '/radix/uploads/images/slider-image2.jpg', 'So sánh PDO và MySQLI ', 'so-sanh-pdo-va-mysqli', 6, 3, '&#60;h2&#62;So sánh PDO và MySQLI&#38;nbsp;&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond,&#38;nbsp;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond&#60;/p&#62;&#13;&#10;', 50, 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor sedelon bond', 0, '2024-06-19 07:48:40', '2024-06-19 07:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `create_at`, `update_at`) VALUES
(1, 'Đánh giá ', 'danh-gia', 1, '2024-06-18 12:35:01', '2024-07-07 09:41:17'),
(3, 'Website', 'website', 1, '2024-06-18 12:35:20', '2024-07-07 09:41:24'),
(6, 'Chia sẻ kiến thức', 'chia-se-kien-thuc', 1, '2024-07-18 09:36:48', '2024-07-19 15:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `blog_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `status` tinyint DEFAULT '0' COMMENT '0: Chưa duyệt, 1: Đã duyệt',
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `name`, `email`, `website`, `parent_id`, `blog_id`, `user_id`, `status`, `content`, `create_at`, `update_at`) VALUES
(191, 'Hoàng Vy', 'hvy155@gmail.com', NULL, 0, 2, NULL, 1, 'Bài viết quá hay, rất hữu ích! ', '2024-07-12 15:08:23', '2024-07-15 09:23:03'),
(197, NULL, NULL, NULL, 0, 2, 1, 1, 'Quá đỉnh nha', '2024-07-12 16:49:50', '2024-07-15 09:23:04'),
(198, NULL, NULL, NULL, 0, 2, 1, 1, 'Test comment', '2024-07-12 16:54:00', '2024-07-15 09:23:05'),
(201, NULL, NULL, NULL, 0, 10, 1, 1, 'Mong mọi người cho ý kiến nha !', '2024-07-15 09:39:24', '2024-07-15 09:51:52'),
(212, NULL, NULL, NULL, 0, 4, 1, 1, 'Lập trình với laravel', '2024-07-20 09:54:12', '2024-07-20 09:54:12'),
(213, NULL, NULL, NULL, 0, 4, 1, 1, 'Lập trình ajax&#10;', '2024-07-20 09:56:11', '2024-07-20 09:56:11'),
(222, NULL, NULL, NULL, 0, 4, 1, 1, 'Quản trị viên', '2024-07-20 10:34:05', '2024-07-20 10:34:05'),
(229, NULL, NULL, NULL, 0, 4, 1, 1, 'a', '2024-07-20 11:13:30', '2024-07-20 11:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `type_id` int DEFAULT '0',
  `message` text COLLATE utf8mb4_vietnamese_ci,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa xử lý, 1: Đang xử lý, 3: Đã xử lý',
  `note` text COLLATE utf8mb4_vietnamese_ci,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `status`, `note`, `create_at`, `update_at`) VALUES
(1, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', 3, 'Tôi muốn hỏi là gì?', 2, 'Ghi chú', '2024-06-22 11:00:12', '2024-06-22 16:51:05'),
(2, 'Trương Hoàng Vy', 'hvy155@gmail.com', 3, 'Thiết kế dùm tôi website', 2, 'Ghi chú', '2024-06-22 12:30:41', '2024-06-23 15:23:22'),
(4, 'Nguyễn Văn D', 'nvand@gmail.com', 2, 'Tôi muốn code đồ án', 1, '', '2024-07-15 15:32:08', '2024-07-15 15:38:07'),
(5, 'truongluoc', 'luoc@gmail.com', 3, 'Thiết kế con mèo', 0, NULL, '2024-07-15 15:33:13', '2024-07-15 15:33:13'),
(8, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', 2, 'Tôi muốn mua đồ án', 0, NULL, '2024-07-15 17:12:12', '2024-07-15 17:12:12'),
(9, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', 2, 'Tôi muốn mua đồ án lần 2', 0, NULL, '2024-07-15 17:13:06', '2024-07-15 17:13:06'),
(10, 'Nguyễn Văn D', 'thanh1905206066@vnkgu.edu.vn', 3, 'Tui muốn quánh lộn', 0, NULL, '2024-07-15 17:22:47', '2024-07-15 17:22:47'),
(11, 'Nguyễn Võ Thanh', 'thanh1905206055@vnkgu.edu.vn', 2, 'Tôi muốn code đồ án', 0, NULL, '2024-07-16 05:37:01', '2024-07-16 05:37:01'),
(12, 'Nguyễn Võ Thanh', 'thanh1905206055@vnkgu.edu.vn', 2, 'Tôi muốn quáh lộn', 0, 'Đã comebat', '2024-07-16 05:42:16', '2024-07-16 09:28:39'),
(13, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', 2, 'Tôi liên hệ', 0, NULL, '2024-07-19 17:41:19', '2024-07-19 17:41:19'),
(14, 'Nguyễn Văn D', 'nvothanh00@gmail.com', 2, 'Admin', 0, NULL, '2024-07-20 09:34:37', '2024-07-20 09:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Kinh doanh', '2024-06-22 10:48:56', '2024-06-22 10:48:56'),
(2, 'Công nghệ thông tin', '2024-06-22 10:49:06', '2024-06-22 10:49:06'),
(3, 'Thiết kế', '2024-06-22 10:49:17', '2024-06-22 10:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `permission` text COLLATE utf8mb4_vietnamese_ci,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(1, 'Administrator', NULL, '2024-06-04 08:50:19', '2024-06-04 08:50:19'),
(3, 'Admin', NULL, '2024-06-10 08:49:05', '2024-06-10 08:49:05'),
(4, 'Nhập liệu', NULL, '2024-06-10 08:49:13', '2024-06-10 08:49:13'),
(5, 'Sale', NULL, '2024-06-10 08:49:34', '2024-06-10 08:49:34'),
(6, 'Stalf', NULL, '2024-06-10 08:49:58', '2024-06-10 08:49:58'),
(7, 'Kho', NULL, '2024-06-10 08:50:04', '2024-06-10 08:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(95, 1, '60aa20458d0914e0265f469bde8e61f771aaa4bc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int NOT NULL,
  `opt_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `opt_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_hotline', '0943833031', 'ganeral_hotline'),
(2, 'general_email', 'nvothanh00@gmail.com', 'Email'),
(3, 'general_time', 'Từ 7h sáng - 17h chiều', 'Thời gian làm việc'),
(4, 'general_search_placeholder', 'Từ khoá tìm kiếm...', 'Từ khoá tìm kiếm'),
(5, 'general_facebook', 'https://www.facebook.com/groups/792924212576126', 'general_facebook'),
(6, 'general_linkedin', '#', 'general_linkedin'),
(7, 'general_x', '#', 'general_x'),
(8, 'general_behance', '#', 'general_behance'),
(9, 'general_youtube', '#', 'general_youtube'),
(10, 'general_quote_text', 'Báo giá', 'Nút báo giá'),
(11, 'general_quote_link', '##', 'Link báo giá'),
(12, 'general_logo_favicon', '/radix/uploads/images/Services/png-transparent-playbuzz-business-advertising-quiz-logo-favicon-purple-violet-text.png', 'Favicon'),
(13, 'general_logo_header', '', 'Logo Header'),
(14, 'general_sitename', 'TVStore', 'Tên website'),
(15, 'general_sitedesc', 'Website giới thiêu dự án cá nhận', 'Mô tả website'),
(16, 'home_slide', '[{\"title_slider\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"button_slider\":\"Our Portfolio\",\"link_slider\":\"http:\\/\\/localhost\\/tvstore\\/du-an\",\"video_slider\":\"https:\\/\\/www.youtube.com\\/watch?v=AxFgjwDTkvk\",\"image_silde_1\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/slider-image1.jpg\",\"image_silde_2\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/gallery-image1.jpg\",\"slide_bg\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/gallery-image.jpg\",\"desc_slider\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled\",\"position_slide\":\"left\"},{\"title_slider\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"button_slider\":\"Viewer\",\"link_slider\":\"#\",\"video_slider\":\"https:\\/\\/vothanh.devcv.online\\/\",\"image_silde_1\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/slider-image1.jpg\",\"image_silde_2\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/gallery-image1.jpg\",\"slide_bg\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/slider-image2.jpg\",\"desc_slider\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic\",\"position_slide\":\"right\"},{\"title_slider\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"button_slider\":\"Our Portfolio\",\"link_slider\":\"#\",\"video_slider\":\"\",\"image_silde_1\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/slider-image2.jpg\",\"image_silde_2\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/gallery-image.jpg\",\"slide_bg\":\"\\/radix\\/uploads\\/images\\/AnhTrangChu\\/gallery-image1.jpg\",\"desc_slider\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took \",\"position_slide\":\"midle\"}]', 'Slide'),
(17, 'home_about', '{\"information\":{\"title_bg\":\"TVSTORE\",\"desc\":\"&#60;h1&#62;&#60;strong&#62;V&#38;ecirc;\\u0300 chu\\u0301ng t&#38;ocirc;i&#60;\\/strong&#62;&#60;\\/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;\\/div&#62;&#13;&#10;\",\"image\":\"\\/radix\\/uploads\\/images\\/DuAn\\/anhduan3.jpg\",\"video\":\"https:\\/\\/youtube\\/E-2ocmhF6TA\",\"content\":\"&#60;h2&#62;We Are Professional Website Design &#38;amp; Development Company!&#60;\\/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. You think water moves fast? You should see ice.&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a weeked do incididunt magna Lorem&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalancip isicing elit, sed do eiusmod tempor incididunt&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:197.663px; top:39px&#34;&#62;&#60;img src=&#34;chrome-extension:\\/\\/bpggmmljdiliancllaapiggllnkbjocb\\/logo\\/48.png&#34; \\/&#62;&#60;\\/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;\\/div&#62;&#13;&#10;\",\"skill\":{\"name\":[\"PHP\",\"Laravel\",\"Bootstrap\",\"JavaSwing\"],\"values\":[\"86\",\"70\",\"74\",\"90\"]}},\"skill\":\"[{\\\"name\\\":\\\"PHP\\\",\\\"value\\\":\\\"86\\\"},{\\\"name\\\":\\\"Laravel\\\",\\\"value\\\":\\\"70\\\"},{\\\"name\\\":\\\"Bootstrap\\\",\\\"value\\\":\\\"74\\\"},{\\\"name\\\":\\\"JavaSwing\\\",\\\"value\\\":\\\"90\\\"}]\"}', 'Thiết lập giới thiệu'),
(18, 'home_service_title_bg', 'Dịch vụ', 'Tiêu đề nền dịch vụ'),
(19, 'home_service_title', '&#60;h1&#62;Cung c&#38;acirc;́p dịch vụ g&#38;ocirc;̀m những gì?&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;TVStore cung c&#38;acirc;́p dịch vụ làm đ&#38;ocirc;̀ án online, PHP/Laravel, C# ASP.NET, ASP MVC, JavaSwing. Dưới đ&#38;acirc;y là chi ti&#38;ecirc;́t dịch vụ mà chúng t&#38;ocirc;i cung c&#38;acirc;́p&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Tiêu đề dịch vụ'),
(21, 'home_fact_title', 'Our Achievements With Smooth Animation Numbering', 'Tiêu đề chính'),
(22, 'home_fact_sub_title', 'Our Achievements', 'Tiêu đề phụ'),
(23, 'home_fact_desc', '&#60;p&#62;Pellentesque vitae gravida nulla. Maecenas molestie ligula quis urna viverra venenatis. Donec at ex metus. Suspendisse ac est et magna viverra eleifend. Etiam varius auctor est eu eleifend.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Mô tả'),
(24, 'home_fact_button_text', 'Liên hệ ngay', 'Nội dung nút'),
(25, 'home_fact_button_link', 'http://localhost/tvstore/lien-he.html', 'Link nút'),
(26, 'home_fact_year_number', '10', 'Năm thành lập'),
(28, 'home_fact_project_number', '15', 'Số lượng dự án'),
(29, 'home_fact_total_number', '50', 'Doanh thu'),
(30, 'home_fact_awards_number', '17', 'Giải thưởng'),
(31, 'home_fact_project_unit', 'K', 'Đơn vị đếm'),
(32, 'home_fact_total_unit', 'Triệu', 'Đơn vị đếm'),
(33, 'home_portfolio_title_bg', 'Dự án', 'Tiêu đề nền'),
(34, 'home_portfolio_title', '&#60;h1&#62;Dự án của chúng t&#38;ocirc;i&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Tiêu đề'),
(35, 'home_portfolio_button', 'Xem thêm', 'Nội dung nút'),
(36, 'home_portfolio_button_link', 'http://localhost/tvstore/du-an.html', 'Link nút'),
(37, 'home_cta_content', '&#60;h2&#62;We Have 35+ Years Of Experiences For Creating Creative Website Project.&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim feugiat, facilisis arcu vehicula, consequat sem. Cras et vulputate nisi, ac dignissim mi. Etiam laoreet&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Nội dung'),
(38, 'home_cta_button', 'Liên hệ ngay', 'Nội dung nút'),
(39, 'home_cta_button_link', 'http://localhost/tvstore/lien-he.html', 'Link nút'),
(40, 'home_blog_title_bg', 'Bài viết', 'Tiêu đề nền'),
(41, 'home_blog_content', '&#60;h1&#62;Bài vi&#38;ecirc;́t n&#38;ocirc;̉i b&#38;acirc;̣t&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Nội dung'),
(42, 'home_partner_content', '&#60;h1&#62;Our Partners&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Tiêu đề đối tác'),
(43, 'home_partner_title_bg', 'Partners', 'Tiêu đền nền'),
(44, 'home_partner_list', '[{\"name\":\"\\u0110\\u00f4\\u0301i ta\\u0301c1\",\"link\":\"link \\u0111\\u00f4\\u0301i ta\\u0301c 1\",\"image\":\"\\/radix\\/uploads\\/images\\/Services\\/anhduan4.jpg\"},{\"name\":\"\\u0110\\u00f4\\u0301i ta\\u0301c 2\",\"link\":\"link \\u0111\\u00f4\\u0301i ta\\u0301c 2\",\"image\":\"\\/radix\\/uploads\\/images\\/Services\\/anhduan6.jpg\"},{\"name\":\"\\u0110\\u00f4\\u0301i ta\\u0301c3\",\"link\":\"link \\u0111\\u00f4\\u0301i ta\\u0301c 3\",\"image\":\"\\/radix\\/uploads\\/images\\/Services\\/anhduan5.jpg\"},{\"name\":\"\\u0110\\u00f4\\u0301i ta\\u0301c 5\",\"link\":\"link \\u0111\\u00f4\\u0301i ta\\u0301c 5\",\"image\":\"\\/radix\\/uploads\\/images\\/Services\\/anhduan6.jpg\"}]', 'Danh sách đối tác'),
(45, 'general_address', 'Sô 125 - Nguyễn Trung Trực - Rạch Giá - Kiên Giang', 'Địa chỉ'),
(46, 'footer_title_1', 'Địa điểm', 'Tiêu đề cột 1'),
(47, 'footer_title_2', 'Liên kết nhanh', 'Tiêu đề cột 2'),
(48, 'footer_title_3', 'Nhóm liên hệ', 'Tiêu đề cột 3'),
(49, 'footer_title_4', 'Đăng ký thông tin !', 'Tiêu đề cột 4'),
(50, 'footer_content_1', '&#60;p&#62;Mauris sagittis nibh et nibh commodo vehicula. Praesent blandit nulla nec tristique egestas.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:72.05px; top:62px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 'Nội dung cột 1'),
(51, 'footer_content_2', '&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;About Our Company&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Our Latest services&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Our Recent Project&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Latest Blog&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Help Desk&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;&#34;&#62;Contact With Us&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;', 'Nội dung cột 2'),
(52, 'footer_qrcode_3', '/radix/uploads/images/Services/qr-zalo-me-www-facebook-com-groups-792924212576126.png', 'Mã QR'),
(53, 'footer_content_4', '&#60;p&#62;consectetur adipiscing elit. Vestibulum vel sapien et lacus tempus varius. In finibus lorem vel.&#60;/p&#62;&#13;&#10;', 'Nội dung cột 4'),
(54, 'footer_content_3', '&#60;p&#62;Truy c&#38;acirc;̣p qua QR Code&#60;/p&#62;&#13;&#10;', 'Nội dung cột 3'),
(56, 'footer_text_button_4', 'Đăng ký với chúng tôi!', 'Nội dung nút'),
(57, 'footer_copy', '&#60;p&#62;&#38;copy; 2024 Bản quy&#38;ecirc;̀n thu&#38;ocirc;̣c v&#38;ecirc;̀ &#60;u&#62;&#60;strong&#62;Nguy&#38;ecirc;̃n Võ Thanh&#60;/strong&#62;&#60;/u&#62;, Group &#60;u&#62;&#60;em&#62;&#60;strong&#62;Code Lại Bug&#60;/strong&#62;&#60;/em&#62;&#60;/u&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:420.513px; top:29px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 'Bản quyền'),
(58, 'about_title', 'Giới thiệu TVStore', 'Tiêu đề trang giới thiệu'),
(59, 'team_title', 'Đội ngũ', 'Tiêu đề trang'),
(60, 'team_desc', '&#60;h1&#62;Đ&#38;ocirc;̣i ngũ của chúng t&#38;ocirc;i !&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Nội dung trang team'),
(61, 'team_title_bg', 'Đội ngũ', 'Tiêu đề nền trang'),
(62, 'team_list', '[{\"name\":\"Collis Molate\",\"position\":\"Founder\",\"zalo\":\"#zalo\",\"behance\":\"#bahance\",\"x\":\"#x\",\"facebook\":\"#facebook\",\"linkedin\":\"#Linkedin\",\"image\":\"\\/radix\\/uploads\\/images\\/AnhTeam\\/team_avt1.jpg\"},{\"name\":\"Domani Plavon\",\"position\":\"Co-Founder\",\"zalo\":\"#zalo 1\",\"behance\":\"#behance 1\",\"x\":\"#x 1\",\"facebook\":\"#facebook 1\",\"linkedin\":\"#linkedin 1\",\"image\":\"\\/radix\\/uploads\\/images\\/AnhTeam\\/team_avt2.jpg\"},{\"name\":\"John Mard\",\"position\":\"Developer\",\"zalo\":\"#\",\"behance\":\"#\",\"x\":\"#\",\"facebook\":\"#facebook 1\",\"linkedin\":\"#\",\"image\":\"\\/radix\\/uploads\\/images\\/AnhTeam\\/team_avt3.jpg\"},{\"name\":\"Amanal Frond\",\"position\":\"Marketer\",\"zalo\":\"#\",\"behance\":\"#\",\"x\":\"#\",\"facebook\":\"#\",\"linkedin\":\"#\",\"image\":\"\\/radix\\/uploads\\/images\\/AnhTeam\\/team_avt4.jpg\"}]', 'Danh sách đội ngũ'),
(63, 'service_title', 'Dịch vụ TVStore', 'Tiêu đề dịch vụ'),
(64, 'portfolio_title', 'Dự án đã triển khai !', 'Tiêu đề dự án'),
(65, 'blogs_title', 'Bài viết - tin tức', 'Tiêu đề bài viết'),
(66, 'contact_title_bg', 'Liên hệ', 'Tiêu đề nền'),
(67, 'contact_desc', '&#60;h1&#62;Li&#38;ecirc;n h&#38;ecirc;̣ với chúng t&#38;ocirc;i !&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 'Tiêu đề - nội dung liên hệ'),
(68, 'contact_title', 'Liên hệ với chúng tôi', 'Tiêu đề liên hệ'),
(69, 'header_menu', '[{&#34;text&#34;:&#34;Trang chủ&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;Trang chủ&#34;},{&#34;text&#34;:&#34;Giới thiệu&#34;,&#34;href&#34;:&#34;#&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Giới thiệu chung&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Đội ngũ&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/doi-ngu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Dự án&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/du-an&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Dịch vụ&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/dich-vu&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Bài viết&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/bai-viet&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Chia sẻ kiến thức&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/bai-viet/danh-muc/chia-se-kien-thuc.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;Chia sẻ kiến thức&#34;},{&#34;text&#34;:&#34;Đánh giá&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/bai-viet/danh-muc/danh-gia.html&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Liên hệ&#34;,&#34;href&#34;:&#34;http://localhost/tvstore/lien-he.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Công đồng&#34;,&#34;href&#34;:&#34;https://www.facebook.com/groups/792924212576126&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_blank&#34;,&#34;title&#34;:&#34;&#34;}]', 'Cấu trúc menu');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `user_id` int NOT NULL DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(1, 'Hướng dẫn thanh toán', 'huong-dan-thanh-toan', '&#60;h4&#62;&#60;strong&#62;Thanh toán trực ti&#38;ecirc;́p&#60;/strong&#62;&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div&#62;Quý khách có th&#38;ecirc;̉ thanh toán trực ti&#38;ecirc;́p n&#38;ecirc;́u ở tr&#38;ecirc;n địa bàn tỉnh Ki&#38;ecirc;n Giang&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;&#60;strong&#62;Thanh toán trực tuy&#38;ecirc;́n&#60;/strong&#62;&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;&#60;em&#62;1. Thanh toán qua tài khoản ng&#38;acirc;n hàng.&#60;/em&#62;&#60;/strong&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;T&#38;ecirc;n ng&#38;acirc;n hàng:&#38;nbsp;LPBANK (Li&#38;ecirc;n Vi&#38;ecirc;̣t)&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;S&#38;ocirc;́ tài khoản: 001xxx99xxx0xxx.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Chủ sở hữu: Nguy&#38;ecirc;̃n Võ Thanh (Nguyen Vo Thanh)&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Chi nhánh: U Minh Thượng, Ki&#38;ecirc;n Giang&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;em&#62;&#60;strong&#62;2. Thanh to&#38;aacute;n V&#38;iacute; MoMo&#60;/strong&#62;&#60;/em&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Hiện tại, MoMo đ&#38;atilde; kết nối với h&#38;agrave;ng trăm ngh&#38;igrave;n điểm chấp nhận thanh to&#38;aacute;n tr&#38;ecirc;n to&#38;agrave;n quốc. Để biết được cửa h&#38;agrave;ng bạn đang mua sắm c&#38;oacute; thanh to&#38;aacute;n được bằng V&#38;iacute; MoMo hay kh&#38;ocirc;ng, bạn c&#38;oacute; thể thực hiện c&#38;aacute;c c&#38;aacute;ch dưới đ&#38;acirc;y:&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;1. Mở Ứng dụng V&#38;iacute; MoMo, tại thanh t&#38;igrave;m kiếm ở m&#38;agrave;n h&#38;igrave;nh ch&#38;iacute;nh, g&#38;otilde; &#38;ldquo;Điểm thanh to&#38;aacute;n&#38;rdquo;. Chọn &#38;ldquo;Điểm thanh to&#38;aacute;n MoMo&#38;rdquo;, bạn sẽ thấy danh s&#38;aacute;ch c&#38;aacute;c điểm chấp nhận thanh to&#38;aacute;n.&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;2. T&#38;igrave;m điểm&#38;nbsp;chấp nhận thanh to&#38;aacute;n MoMo tại:&#38;nbsp;&#60;a href=&#34;https://momo.vn/timdiemthanhtoan&#34;&#62;https://momo.vn/timdiemthanhtoan&#60;/a&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;3. Quan s&#38;aacute;t tại cửa h&#38;agrave;ng bạn đang đứng. Quầy thanh to&#38;aacute;n ở tất cả c&#38;aacute;c cửa h&#38;agrave;ng c&#38;oacute; thanh to&#38;aacute;n MoMo đều c&#38;oacute; đặt một bảng th&#38;ocirc;ng b&#38;aacute;o &#38;ldquo;Thanh to&#38;aacute;n MoMo tại đ&#38;acirc;y&#38;rdquo;.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;4. Khi mua h&#38;agrave;ng tr&#38;ecirc;n c&#38;aacute;c website thương mại điện tử, bạn h&#38;atilde;y chọn xem c&#38;aacute;c phương thức thanh to&#38;aacute;n tr&#38;ecirc;n website đ&#38;oacute;. Bạn c&#38;oacute; thể thanh to&#38;aacute;n bằng V&#38;iacute; MoMo nếu MoMo l&#38;agrave; một trong những phương&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;thức thanh to&#38;aacute;n, b&#38;ecirc;n cạnh thẻ ATM, Visa hay Mastercard.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;eJOY__extension_root_class&#34; id=&#34;eJOY__extension_root&#34; style=&#34;all:unset&#34;&#62;&#38;nbsp;&#60;/div&#62;&#13;&#10;', 3, 0, '2024-06-16 06:22:26', '2024-07-16 08:45:01'),
(2, 'Chính sách hoàn trả', 'chinh-sach-hoan-tra', '&#60;h2&#62;Những trường hợp được hoàn trả - b&#38;ocirc;̀i thường&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;', 1, 2, '2024-06-16 06:29:39', '2024-07-16 08:07:43'),
(3, 'Chính sách bảo hành', 'chinh-sach-bao-hanh', '&#60;p&#62;Chính sách bảo hành&#60;/p&#62;&#13;&#10;', 1, 1, '2024-06-16 06:42:01', '2024-07-16 08:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `dscription` text COLLATE utf8mb4_vietnamese_ci,
  `video` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `user_id` int DEFAULT '0',
  `portfolio_categories_id` int NOT NULL DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `dscription`, `video`, `content`, `user_id`, `portfolio_categories_id`, `duplicate`, `create_at`, `update_at`) VALUES
(13, 'Creative Work', 'creative-work', '/radix/uploads/images/DuAn/anhduan1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=y2M3-QdAkYk', '&#60;h3 style=&#34;text-align:justify&#34;&#62;&#60;span style=&#34;font-family:Tahoma,Geneva,sans-serif&#34;&#62;&#60;strong&#62;1. T&#38;ocirc;̉ng quan dự án&#60;/strong&#62;&#60;/span&#62;&#60;/h3&#62;&#13;&#10;&#13;&#10;&#60;hr /&#62;&#13;&#10;&#60;p style=&#34;text-align:justify&#34;&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p style=&#34;text-align:justify&#34;&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h3 style=&#34;text-align:justify&#34;&#62;&#60;span style=&#34;font-family:Tahoma,Geneva,sans-serif&#34;&#62;&#60;strong&#62;2. C&#38;ocirc;ng ngh&#38;ecirc;̣ sử dụng&#60;/strong&#62;&#60;/span&#62;&#60;/h3&#62;&#13;&#10;&#13;&#10;&#60;hr /&#62;&#13;&#10;&#60;p style=&#34;text-align:justify&#34;&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;/span&#62;&#60;/p&#62;&#13;&#10;', 1, 9, 1, '2024-06-29 06:55:27', '2024-07-06 15:28:28'),
(14, 'Responsive Design', 'responsive-design', '/radix/uploads/images/DuAn/anhduan2.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://youtu.be/WS5B2jVJj5I?si=hkqvHZBgjWGOzey0', '&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;BẮT ĐẦU N&#38;Agrave;O!&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;N&#38;agrave;y bạn xem đ&#38;acirc;y, rất nhiều học tr&#38;ograve; của t&#38;ocirc;i đ&#38;atilde; kiếm được tiền từ kỹ năng lập tr&#38;igrave;nh web như thế n&#38;agrave;o?&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Cấp độ #1: Sau khi học xong ra nghề thường c&#38;oacute; cơ hội thu nhập 8-10tr/th&#38;aacute;ng.&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Cấp độ #2: Cơ hội đạt thu nhập từ 12-16tr sau 8 th&#38;aacute;ng - 1 năm đi l&#38;agrave;m&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Cấp độ #3: Cơ hội đạt thu nhập 16 - 30tr/th&#38;aacute;ng từ lương đi l&#38;agrave;m c&#38;ocirc;ng ty v&#38;agrave; số tiền l&#38;agrave;m Freelancer(L&#38;agrave;m việc tự do)&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Đ&#38;acirc;y chỉ l&#38;agrave; một phần rất nhỏ trong h&#38;agrave;ng ng&#38;agrave;n bạn học vi&#38;ecirc;n unitop đ&#38;atilde; c&#38;oacute; cơ hội đi l&#38;agrave;m tốt chỉ sau 6-8 th&#38;aacute;ng nỗ lực!&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Nhưng b&#38;ecirc;n ngo&#38;agrave;i kia th&#38;igrave; sao?&#38;nbsp;&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Khi join v&#38;agrave;o c&#38;aacute;c nh&#38;oacute;m lập tr&#38;igrave;nh t&#38;ocirc;i thường nh&#38;igrave;n thấy c&#38;aacute;c b&#38;agrave;i post tuy ti&#38;ecirc;u cực nhưng phản &#38;aacute;nh đ&#38;uacute;ng thực tế.&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Mọi người đang k&#38;ecirc;u trời v&#38;igrave; nghề lập tr&#38;igrave;nh web đang cạnh tranh khốc liệt.&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;H&#38;agrave;ng trăm ng&#38;agrave;n người học ra nhưng kh&#38;ocirc;ng c&#38;oacute; việc l&#38;agrave;m.&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Thất nghiệp...blabla&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Nhưng, trong khi đ&#38;oacute; c&#38;aacute;c học vi&#38;ecirc;n của t&#38;ocirc;i vẫn vượt b&#38;atilde;o th&#38;agrave;nh c&#38;ocirc;ng, họ vẫn r&#38;egrave;n luyện mỗi ng&#38;agrave;y, đi l&#38;agrave;m tốt v&#38;agrave; c&#38;oacute; cơ hội thu nhập kh&#38;ocirc;ng ngừng tăng l&#38;ecirc;n....&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;Tại sao vậy?&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;T&#38;ocirc;i ph&#38;aacute;t hiện ra hầu hết mọi người đang học lập tr&#38;igrave;nh web sai c&#38;aacute;ch v&#38;agrave; rất c&#38;oacute; thể bạn cũng đang nằm trong số đ&#38;oacute;.&#60;br /&#62;&#13;&#10;&#60;br /&#62;&#13;&#10;H&#38;atilde;y để t&#38;ocirc;i ph&#38;acirc;n t&#38;iacute;ch cho bạn...&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1166.46px; top:19px&#34;&#62;&#60;span style=&#34;font-size:16px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/span&#62;&#60;/div&#62;&#13;&#10;', 1, 9, 1, '2024-06-29 06:55:38', '2024-07-06 14:11:53'),
(15, 'Bootstrap Based', 'bootstrap-based', '/radix/uploads/images/DuAn/anhduan3.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim oke', 'https://youtu.be/WS5B2jVJj5I?si=hkqvHZBgjWGOzey0', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 9, 1, '2024-06-29 06:58:01', '2024-07-05 12:54:42'),
(16, 'Clean Design', 'clean-design', '/radix/uploads/images/DuAn/anhduan4.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://youtu.be/WS5B2jVJj5I?si=hkqvHZBgjWGOzey0', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 9, 1, '2024-06-29 06:59:17', '2024-07-05 12:54:52'),
(17, 'Animation', 'animation', '/radix/uploads/images/DuAn/anhduan5.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://youtu.be/WS5B2jVJj5I?si=hkqvHZBgjWGOzey0', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 9, 1, '2024-06-29 07:01:23', '2024-07-05 12:55:01'),
(18, 'Animation', 'animation', '/radix/uploads/images/DuAn/anhduan6.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://youtu.be/WS5B2jVJj5I?si=hkqvHZBgjWGOzey0', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 9, 0, '2024-06-29 07:02:14', '2024-07-05 12:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(9, 'Review', 1, 0, '2024-06-16 17:51:07', '2024-06-16 17:51:07'),
(10, 'Du lịch', 1, 1, '2024-06-16 17:51:28', '2024-06-16 17:51:28'),
(12, 'Hoạt động', 3, 1, '2024-06-16 18:02:16', '2024-06-16 18:02:16'),
(13, 'Tư vấn dịch vụ', 1, 1, '2024-06-16 18:17:58', '2024-06-16 18:17:58'),
(15, 'Lập trình web', 1, 3, '2024-06-16 19:01:42', '2024-06-16 19:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int NOT NULL,
  `portfolio_id` int DEFAULT '0',
  `images` varchar(150) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `images`, `create_at`, `update_at`) VALUES
(43, 13, '/radix/uploads/images/DuAn/anhduan1.jpg', '2024-07-06 14:36:40', '2024-07-06 14:36:40'),
(44, 13, '/radix/uploads/images/DuAn/anhduan2.jpg', '2024-07-06 14:36:40', '2024-07-06 14:36:40'),
(45, 13, '/radix/uploads/images/DuAn/anhduan3.jpg', '2024-07-06 14:36:40', '2024-07-06 14:36:40'),
(46, 13, '/radix/uploads/images/DuAn/anhduan4.jpg', '2024-07-06 14:36:40', '2024-07-06 14:36:40'),
(47, 14, '/radix/uploads/images/DuAn/ismar1.png', '2024-07-06 16:52:03', '2024-07-06 16:52:03'),
(48, 14, '/radix/uploads/images/DuAn/ismar2.png', '2024-07-06 16:52:03', '2024-07-06 16:52:03'),
(49, 14, '/radix/uploads/images/DuAn/ismar3.png', '2024-07-06 16:52:03', '2024-07-06 16:52:03'),
(50, 14, '/radix/uploads/images/DuAn/ismar4.png', '2024-07-06 16:52:03', '2024-07-06 16:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `sevices`
--

CREATE TABLE `sevices` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `dscription` text COLLATE utf8mb4_vietnamese_ci,
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sevices`
--

INSERT INTO `sevices` (`id`, `name`, `slug`, `icon`, `dscription`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(23, 'ASP MVC', 'asp-mvc', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', 'Nhận code thuê đồ án WEB ASP.NET. Cung cấp source cơ sở dữ liệu liên quan', '&#60;h1&#62;&#60;span style=&#34;font-size:20px&#34;&#62;&#60;strong&#62;CHÚNG T&#38;Ocirc;I LÀM DỰ ÁN ASP.NET NHƯ TH&#38;Ecirc;́ NÀO ?&#60;/strong&#62;&#60;/span&#62;&#60;/h1&#62;&#13;&#10;&#13;&#10;&#60;hr /&#62;&#13;&#10;&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;span style=&#34;font-size:16px&#34;&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;span dir=&#34;rtl&#34; lang=&#34;ar&#34;&#62;.&#60;/span&#62;&#60;/span&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:677.7px; top:34px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1154.94px; top:20px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1160px; top:203.6px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1160px; top:234.6px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1160px; top:326.2px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1160px; top:346px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 1, 0, '2024-06-27 17:10:59', '2024-07-19 08:56:03'),
(24, 'PHP/Laravel', 'development', '&#60;i class=&#34;fa fa-wordpress&#34;&#62;&#60;/i&#62;', 'Nhận làm đồ án thực tập, tiều luận... Sử dung PHP Laravel trong phát triền phần mềm', '&#60;p&#62;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin,&#38;nbsp;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin ,Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', 1, 0, '2024-06-27 17:11:52', '2024-06-27 18:10:16'),
(25, 'Winform', 'creative-idea', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', 'Tạo ra ứng dung winform bằng theo yêu cầu của khách hàng, lập trình 3 lớp ....', '&#60;p&#62;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin,Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', 1, 0, '2024-06-27 17:12:22', '2024-06-27 18:23:05'),
(26, 'Tiểu luận', 'maketting', '&#60;i class=&#34;fa fa-bullhorn &#34;&#62;&#60;/i&#62;', 'Nhân viết báo cáo tiểu luận các môn học thuộc ngành CNTT. Hỗ trợ đĩa CD lưu source code', '&#60;p&#62;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical LatinCreative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', 1, 0, '2024-06-27 17:13:03', '2024-06-27 18:11:51'),
(27, 'Đồ án ', 'direct-work', '&#60;i class=&#34;fa fa-bullseye &#34;&#62;&#60;/i&#62;', 'Cung cấp đồ án tốt nghiệp đại học giải thích code A-Z. Bao gôm các mô hình cơ sở dữ liệu liên quan', '&#60;p&#62;Everything ien erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat Latin&#60;/p&#62;&#13;&#10;', 1, 0, '2024-06-27 17:14:44', '2024-06-27 18:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `subscibe`
--

CREATE TABLE `subscibe` (
  `id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa xử lý, 1: Đang xử lý, 3: Đã xử lý',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `subscibe`
--

INSERT INTO `subscibe` (`id`, `fullname`, `email`, `status`, `create_at`, `update_at`) VALUES
(1, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', 1, '2024-07-16 17:21:44', '2024-07-17 10:15:23'),
(3, 'Hoang Vy ', 'hvy155@gmail.com', 2, '2024-07-16 17:32:50', '2024-07-17 10:18:49'),
(4, 'Nguyễn Võ Thanh', 'thanh1905206055@vnkgu.edu.vn', 1, '2024-07-16 17:33:55', '2024-07-17 13:07:30'),
(5, 'Hoàng Vy', 'hvy1155@gmail.com', 0, '2024-07-16 17:36:47', '2024-07-16 17:36:47'),
(6, 'Hoàng Vy', 'nvand@gmail.com', 0, '2024-07-16 17:37:02', '2024-07-16 17:37:02'),
(7, 'Nguyễn Võ Thanh', 'nvothanh002@gmail.com', 0, '2024-07-16 17:37:58', '2024-07-16 17:37:58'),
(8, 'Nguyễn Văn Luốc', 'thanh1905206066@vnkgu.edu.vn', 0, '2024-07-16 17:38:16', '2024-07-16 17:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `about_content` text COLLATE utf8mb4_vietnamese_ci,
  `contact_facebook` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `contact_x` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `contact_linkedin` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `contact_pinterest` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `forgot_token` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `status` int DEFAULT '0' COMMENT '0: Chưa kích hoạt, 1: Đã kích hoạt',
  `last_activity` datetime DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_x`, `contact_linkedin`, `contact_pinterest`, `forgot_token`, `group_id`, `status`, `last_activity`, `create_at`, `update_at`) VALUES
(1, 'Nguyễn Võ Thanh', 'nvothanh00@gmail.com', '$2y$10$NtiyS58GfpYNgmCru4Qn7u8PUsxDmJ/snpogxDBC3q4P1bh35sVai', 'Nguyễn Võ Thanh, Sinh năm 2000', 'https://www.facebook.com/thanhvy1709.0505.0110/', '', '', '', NULL, 1, 1, '2024-07-20 20:29:52', '2024-06-04 08:53:57', '2024-07-20 13:29:52'),
(3, 'Ngọc Tâm UNicode', 'ngoctam@gmail.com', '$2y$10$zlzWZcwcg4QTH3sq7vaPW.l4eygf3UKTZfiOcaL1hSNiEudeVoVjG', 'Oke', '', '', '', '', NULL, 3, 1, '2024-06-11 23:26:59', '2024-06-11 16:02:35', '2024-06-11 16:26:59'),
(6, 'Nguyễn Văn Cê', 'nguyence@gmail.com', '$2y$10$7iwjLQTyKKJVaH1EF024OeRhnN2ROOuPztnMslBSkRayAwEzbvHfS', '', NULL, NULL, NULL, NULL, NULL, 7, 1, NULL, '2024-06-12 12:43:59', '2024-06-12 12:44:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portloios_categories_id` (`portfolio_categories_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portlio_id` (`portfolio_id`);

--
-- Indexes for table `sevices`
--
ALTER TABLE `sevices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscibe`
--
ALTER TABLE `subscibe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sevices`
--
ALTER TABLE `sevices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subscibe`
--
ALTER TABLE `subscibe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`portfolio_categories_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD CONSTRAINT `portfolio_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sevices`
--
ALTER TABLE `sevices`
  ADD CONSTRAINT `sevices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
