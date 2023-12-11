-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `module6_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `user_id`, `category_id`, `content`, `view_count`, `thumbnail`, `description`, `create_at`, `update_at`, `duplicate`) VALUES
(2, 'Kiến thức website', 'kien-thuc-website', 4, 3, '&#60;p&#62;Kien thuc&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/website.png', 'Kiến thức website', '2022-12-14 21:29:10', '2022-12-22 10:26:09', 5),
(3, 'Thao túng tâm lý', 'thao-tung-tam-ly', 4, 2, '&#60;p&#62;Thao t&#38;uacute;ng t&#38;acirc;m l&#38;yacute; ...&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/files/p4(1).jpg', 'Thao túng tâm lý', '2022-12-14 22:02:42', '2022-12-21 10:14:01', 3),
(9, 'Thao túng tâm lý (2)', 'thao-tung-tam-ly', 4, 2, '&#60;p&#62;Thao t&#38;uacute;ng t&#38;acirc;m l&#38;yacute; ...&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/files/p4(1).jpg', 'Thao túng tâm lý', '2022-12-21 10:23:19', '2022-12-21 10:23:19', 3),
(11, 'Thao túng tâm lý (3)', 'thao-tung-tam-ly', 4, 5, '&#60;p&#62;Thao t&#38;uacute;ng t&#38;acirc;m l&#38;yacute; ...&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/files/p4(1).jpg', 'Thao túng tâm lý', '2022-12-21 10:23:21', '2022-12-22 10:25:42', 3),
(12, 'Thao túng tâm lý (3)', 'thao-tung-tam-ly', 4, 4, '&#60;p&#62;Thao t&#38;uacute;ng t&#38;acirc;m l&#38;yacute; ...&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/files/p4(1).jpg', 'Thao túng tâm lý', '2022-12-21 10:23:23', '2022-12-22 10:25:50', 3),
(20, 'Kiến thức website (5)', 'kien-thuc-website', 5, 3, '&#60;p&#62;Kien thuc&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/website.png', 'Kiến thức website', '2022-12-22 17:29:30', '2022-12-22 17:29:30', 6),
(21, 'Kiến thức website (6)', 'kien-thuc-website', 5, 3, '&#60;p&#62;Kien thuc&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/website.png', 'Kiến thức website', '2022-12-22 17:29:32', '2022-12-22 17:29:32', 7),
(22, 'Kiến thức website (7)', 'kien-thuc-website', 5, 3, '&#60;p&#62;Kien thuc&#60;/p&#62;&#13;&#10;', 0, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/website.png', 'Kiến thức website', '2022-12-22 17:29:33', '2022-12-22 17:29:33', 7);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(2, 'Kiến thức', 'kien-thuc', 4, '2022-10-14 21:28:25', '2023-03-13 14:36:42', 2),
(3, 'Chứng khoán', 'chung-khoan', 5, '2022-12-14 21:30:23', '2023-03-13 14:36:44', 1),
(4, 'Thị trường', 'thi-truong', 1, '2022-12-14 21:32:33', '2022-12-14 21:32:33', 2),
(5, 'Môi trường việc làm', 'moi-truong-viec-lam', 1, '2022-12-14 21:35:44', '2022-12-14 21:40:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `blog_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0: Chưa duyệt 1: Đã duyệt',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `website`, `content`, `parent_id`, `blog_id`, `user_id`, `status`, `create_at`, `update_at`) VALUES
(172, 'Tien Hai Le', 'tienhai@gmail.com', '', 'binh luan nay', 0, 3, 1, 1, '2022-12-24 16:43:24', '2022-12-24 16:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT 0,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Chưa xử lý 1: Đang xử lý 2: Đã xử lý',
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `status`, `note`, `create_at`, `update_at`, `duplicate`) VALUES
(3, 'CNTT', 'cntt.contact@gmail.com', 4, 'noi dung ', 1, 'ghi chu', NULL, NULL, 1),
(4, 'TaiChinh', 'tc.contact@gmail.com', 6, '&#60;p&#62;T&#38;agrave;i ch&#38;iacute;nh...&#60;/p&#62;&#13;&#10;', 2, '&#60;p&#62;T&#38;agrave;i ch&#38;iacute;nh...&#60;/p&#62;&#13;&#10;', '2022-12-17 01:24:02', '2022-12-17 01:24:02', 1),
(6, 'tienhai', 'tienhai@gmail.com', 5, '&#60;p&#62;Marketing&#60;/p&#62;&#13;&#10;', 0, '&#60;p&#62;Marketing&#60;/p&#62;&#13;&#10;', '2022-12-17 01:32:21', '2022-12-17 01:32:21', 3),
(12, 'Tien Hai Le', 'tienhai@gmail.com', 4, 'Chung toi muon lien he de xay dung mot trang web ban hang!', 0, NULL, '2022-12-24 17:53:08', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `create_at`, `update_at`, `duplicate`) VALUES
(4, 'Công nghệ thông tin', '2022-02-17 00:31:31', NULL, 1),
(5, 'Marketing', '2022-12-17 00:31:47', NULL, 1),
(6, 'Tài chính', '2022-12-17 00:40:41', '2022-12-17 01:33:12', 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(1, 'Admin', NULL, '2020-12-02 19:34:07', NULL),
(2, 'Kho', NULL, '2022-08-02 20:05:45', NULL),
(3, 'Manager', NULL, '2022-12-02 19:34:52', NULL),
(4, 'Staff', NULL, '2022-12-02 21:01:05', NULL),
(5, 'Sale', NULL, '2022-12-02 21:01:16', NULL),
(6, 'Nhập liệu', NULL, '2022-12-02 21:09:03', NULL),
(7, 'Lễ tân', NULL, '2022-12-02 21:09:21', NULL),
(9, 'Seo Web', NULL, '2022-12-02 21:48:32', '2022-12-02 23:29:42'),
(10, 'Nhân sự', NULL, '2022-12-02 21:51:49', NULL),
(11, 'Kế toán', NULL, '2022-12-02 21:52:42', NULL),
(12, 'Marketing', NULL, '2022-12-02 22:40:51', '2022-12-02 23:27:24'),
(13, 'Minh Lâm Update', NULL, '2023-03-13 21:55:55', '2023-03-15 08:06:31'),
(17, 'TienHai', NULL, '2023-03-15 14:59:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(131, 4, '04dfffdef76be39873cd358a3e9909bcadfcec54', '2023-12-11 20:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `opt_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opt_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_hotline', '0987982144', 'Hotline'),
(2, 'general_email', 'tienhai.contact@gmail.com', 'Email'),
(3, 'general_time', '8 AM - 12 PM', 'Thời gian làm việc'),
(4, 'general_facebook', 'https://www.facebook.com/', 'Facebook'),
(5, 'general_twitter', 'https://www.twitter.com/', 'Twitter'),
(6, 'general_linkedin', 'https://www.linkedin.com/', 'Linkedin'),
(7, 'general_github', 'https://www.github.com/', 'Github'),
(8, 'general_youtube', 'https://www.youtube.com/', 'Youtube'),
(9, 'general_slide', '[{\"name\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"link_video\":\"https:\\/\\/www.youtube.com\\/watch?v=oWa56tgoKT0\",\"content\":\"&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"Our Port\",\"link_btn\":\"#\",\"image_1\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image1.jpg\",\"image_2\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image2.jpg\",\"backgroud_image\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/slider-image1.jpg\",\"positon_image\":\"left\"},{\"name\":\"Slide 2\",\"link_video\":\"https:\\/\\/www.youtube.com\\/watch?v=oWa56tgoKT0\",\"content\":\"&#60;p&#62;Slide 1&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"Nut nhan\",\"link_btn\":\"#\",\"image_1\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image1.jpg\",\"image_2\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image2.jpg\",\"backgroud_image\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/slider-image1.jpg\",\"positon_image\":\"right\"},{\"name\":\"Slide 3\",\"link_video\":\"https:\\/\\/www.youtube.com\\/watch?v=oWa56tgoKT0\",\"content\":\"&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis&#60;\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"Nut bam\",\"link_btn\":\"#\",\"image_1\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image1.jpg\",\"image_2\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-image2.jpg\",\"backgroud_image\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/slider-image1.jpg\",\"positon_image\":\"center\"}]', 'Slide'),
(10, 'general_about', '{\"heading\":\"tieu de\",\"link_video\":\"https:\\/\\/www.youtube.com\\/watch?v=oWa56tgoKT0\",\"name\":\"tienhai\",\"image_1\":\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/Product\\/gallery-4.jpg\",\"text_bg\":\"TienHaiLe\",\"description\":\"&#60;p&#62;mo ta&#60;\\/p&#62;&#13;&#10;\",\"content\":\"&#60;p&#62;noi dung&#60;\\/p&#62;&#13;&#10;\",\"range_name\":[\"1\",\"2\",\"3\",\"4\"],\"range\":[\"12\",\"34\",\"68\",\"91\"],\"title_about\":\"Gi\\u1edbi thi\\u1ec7u\",\"title_team\":\"\\u0110\\u1ed9i nh\\u00f3m\",\"heading_team\":\"Our Leaders\",\"heading_bg\":\"TienHai\",\"des_team\":\"&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;\\/p&#62;&#13;&#10;\"}', 'Contact'),
(11, 'general_service', '{\"heading\":\"tieu de\",\"text_bg\":\"TienHai\",\"description\":\"&#60;p&#62;mo ta&#60;\\/p&#62;&#13;&#10;\",\"title_service\":\"D\\u1ecbch v\\u1ee5\"}', 'Service'),
(12, 'general_age_company', '3', 'Tuổi đời'),
(13, 'general_complete_project', '4', 'Dự án hoàn thành'),
(14, 'general_total_earning', '300', 'Tổng thu nhập'),
(15, 'general_award', '10', 'Số giải thưởng'),
(16, 'general_fact', '{\"heading\":\"Our Achievements\",\"sub_title\":\"With Smooth Animation Numbering\",\"description\":\"&#60;p&#62;Pellentesque vitae gravida nulla. Maecenas molestie ligula quis urna viverra venenatis. Donec at ex metus. Suspendisse ac est et magna viverra eleifend. Etiam varius auctor est eu eleifend.&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"CONTACT US\",\"btn_link\":\"#\"}', 'Fact'),
(17, 'general_portfolio', '{\"heading\":\"D\\u1ef1 \\u00c1n\",\"title_bg\":\"Tien Hai\",\"description\":\"&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"More Portfolio\",\"btn_link\":\"#\",\"title_portfolio\":\"D\\u1ef1 \\u00e1n \"}', 'Dự án'),
(18, 'general_blog', '{\"heading\":\"Latest Blogs\",\"title_bg\":\"Tien Hai\",\"description\":\"&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;\\/p&#62;&#13;&#10;\",\"title_blog\":\"B\\u00e0i vi\\u1ebft\"}', 'Blog'),
(19, 'general_action', '{\"heading\":\"We Have 35+ Years Of Experiences For Creating Creative Website Project.\",\"description\":\"&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim feugiat, facilisis arcu vehicula, consequat sem. Cras et vulputate nisi, ac dignissim mi. Etiam laoreet&#60;\\/p&#62;&#13;&#10;\",\"btn_name\":\"BUY THIS THEME\",\"btn_link\":\"#\"}', 'Action'),
(20, 'general_partner', '{\"heading\":\"Our Partners\",\"title_bg\":\"TienHai\",\"description\":\"&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;\\/p&#62;&#13;&#10;\",\"image\":[\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-1.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-2.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-3.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-4.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-5.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-6.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-7.png\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/partner-8.png\"],\"link\":[\"#\",\"#\",\"#\",\"#\",\"#\",\"#\",\"#\",\"#\"]}', 'Partner'),
(21, 'general_address', 'Tuy Phước Bình Định', 'Địa chỉ'),
(22, 'general_footer', '{\"title_1\":\"TienHai\",\"des_1\":\"Maecenas sapien erat, porta non porttitor non, dignissim et enim.\",\"title_2\":\"Quick Links\",\"name_quicklink\":[\"About Our\",\"Company Our\",\"Latest services\",\"Our Recent Project \",\"Latest Blog\"],\"link_quicklink\":[\"#\",\"#\",\"#\",\"#\",\"#\"],\"title_3\":\"Recent Tweets\",\"name_account_twitter\":[\"@TienHai\",\"@TaiKhoan\",\"@TaiKhoan\"],\"link_account_twitter\":[\"#\",\"#\",\"#\"],\"des_account_twitter\":[\"Mauris sagittis nibh et nibh commodo vehicula. Praesent blandit nulla nec tristique egestas. Integer in volutpat turpis\",\"Mauris sagittis nibh et nibh commodo vehicula. Praesent blandit nulla nec tristique egestas. Integer in volutpat turpis\",\"Mauris sagittis nibh et nibh commodo vehicula. Praesent blandit nulla nec tristique egestas. Integer in volutpat turpis\"],\"title_4\":\"Newsletter\",\"des_4\":\"Consectetur adipiscing elit. Vestibulum vel sapien et lacus tempus varius. In finibus lorem vel.\",\"copy_right\":\"\\u00a9 2020 All Right Reserved. \"}', 'Footer'),
(23, 'general_team', '{\"name\":[\"Collis Molate\",\"Collis Molate\",\"Collis Molate\",\"Collis Molate\"],\"position\":[\"Founder\",\"Founder\",\"Founder\",\"Founder\"],\"image\":[\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/partner\\/t2.jpg\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/our\\/t1.jpg\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/our\\/t3.jpg\",\"http:\\/\\/localhost:81\\/PHP\\/module06\\/radix\\/uploads\\/images\\/our\\/t4.jpg\"],\"link\":[\"#\",\"#\",\"#\",\"#\"],\"facebook\":[\"#\",\"#\",\"#\",\"#\"],\"twitter\":[\"#\",\"#\",\"#\",\"#\"],\"youtube\":[\"#\",\"#\",\"#\",\"#\"],\"github\":[\"#\",\"#\",\"#\",\"#\"]}', 'Team'),
(24, 'general_contact', '{\"heading\":\"Contact Us\",\"title_bg\":\"TienHai\",\"description\":\"&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;\\/p&#62;&#13;&#10;\",\"title_contact\":\"Li\\u00ean h\\u1ec7\"}', 'Contact');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(1, 'Trang 1', 'trang-1', 'Đây là trang 1', 4, '2022-10-13 21:03:14', NULL, 2),
(2, 'Trang 2', 'trang-2', 'Đây là trang 2', 1, '2022-12-13 21:20:13', NULL, 1),
(5, 'Trang 1 (2)', 'trang-1', 'Đây là trang 1', 4, '2022-12-13 21:45:51', '2022-12-13 21:45:51', 5);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `portfolio_category_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `description`, `video`, `content`, `user_id`, `portfolio_category_id`, `create_at`, `update_at`, `duplicate`) VALUES
(5, 'Thiết kế web cơ bản', 'web-co-ban', 'http://localhost:81/PHP/module06/radix/uploads/images/Product/p1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 2, '2022-12-13 23:29:32', '2022-12-22 09:45:18', 3),
(7, 'Thiết kế web nâng cao', 'web-nang-cao', 'http://localhost:81/PHP/module06/radix/uploads/images/Product/p2.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 2, '2022-12-13 23:30:25', '2022-12-20 23:19:08', 1),
(17, 'Giới thiệu tính năng', 'gioi-thieu-tinh-nang', 'http://localhost:81/PHP/module06/radix/uploads/files/p4.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 4, '2022-12-20 22:43:15', '2022-12-20 23:19:26', 3),
(18, 'Bảo mật 3 lớp', 'bao-mat-3-lop', 'http://localhost:81/PHP/module06/radix/uploads/files/p3.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 6, '2022-12-20 22:44:06', '2022-12-20 23:18:46', 4),
(19, 'Tài chính thị trường', 'tai-chinh-thi-truong', 'http://localhost:81/PHP/module06/radix/uploads/files/p5.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 14, '2022-12-20 22:44:54', '2022-12-20 23:19:01', 5),
(20, 'Hướng dẫn seo top', 'huong-dan-seo-top', 'http://localhost:81/PHP/module06/radix/uploads/files/p6.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=39Z3hNSbjhQ', '&#60;p&#62;noi dung&#60;/p&#62;&#13;&#10;', 4, 3, '2022-12-20 22:44:56', '2022-12-20 23:18:53', 7);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(2, 'Thiết kế website', 4, '2022-10-13 23:22:11', NULL, 2),
(3, 'Seo Top Google', 5, '2022-12-13 23:22:32', NULL, 1),
(4, 'Giới thiệu sản phẩm', 1, '2022-12-13 23:22:48', NULL, 1),
(6, 'Bảo mật khách hàng', 4, '2022-12-13 23:48:22', '2022-12-13 23:48:22', 2),
(14, 'Marketing', 4, '2022-12-14 00:08:43', '2022-12-14 00:08:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT 0,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `image`, `create_at`, `update_at`) VALUES
(11, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/goal.jpg', '2022-12-22 09:45:18', '2022-12-22 09:45:18'),
(12, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/p1.jpg', '2022-12-22 09:45:18', '2022-12-22 09:45:18'),
(13, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/gallery-image2.jpg', '2022-12-22 09:45:18', '2022-12-22 09:45:18'),
(14, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/website.png', '2022-12-22 09:45:18', '2022-12-22 09:45:18'),
(15, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/gallery-image2.jpg', '2022-12-22 09:45:18', '2022-12-22 09:45:18'),
(16, 5, 'http://localhost:81/PHP/module06/radix/uploads/images/Product/gallery-4.jpg', '2022-12-22 09:45:18', '2022-12-22 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `description`, `content`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(11, 'Dich vu 4', 'dich-vu-4', '<i class=\"fa fa-window-minimize\"></i>', 'Dich vu 4', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum&#60;/p&#62;&#13;&#10;', 1, '2022-12-13 14:18:47', '2022-12-21 23:32:19', 1),
(13, 'Dich vu 1', 'dich-vu-1', '<i class=\"fas fa-viruses\"></i>', 'Dich vu 1', '&#60;p&#62;Dich vu 1&#60;/p&#62;&#13;&#10;', 1, '2022-12-13 17:13:34', '2022-12-13 17:23:04', 1),
(14, 'Dich vu 3', 'dich-vu-3', '<i class=\"fas fa-vial\"></i>', 'Dich vu 3', '&#60;p&#62;Dich vu 3&#60;/p&#62;&#13;&#10;', 1, '2022-12-13 17:24:32', '2022-12-20 21:11:15', 1),
(16, 'Dich vu 1 nhan ban', 'dich-vu-1-nhan-ban', '<i class=\"fas fa-viruses\"></i>', 'Dich vu 1', '&#60;p&#62;Dich vu 1&#60;/p&#62;&#13;&#10;', 1, '2022-12-13 17:39:43', '2022-12-20 21:11:03', 1),
(29, 'Dich vu 3', 'dich-vu-3', '<i class=\"fas fa-vihara\"></i>', 'Dich vu 3', '&#60;p&#62;Dich vu 3&#60;/p&#62;&#13;&#10;', 1, '2022-12-13 18:29:39', '2022-12-20 21:10:53', 6),
(48, 'Dich vu moi', 'dich-vu-moi', '<i class=\"fas fa-yin-yang\"></i>', 'Dich vu moi', '&#60;p&#62;Dich vu moi&#60;/p&#62;&#13;&#10;', 4, '2022-12-18 19:42:44', '2022-12-20 21:10:42', 1),
(49, 'Dich vu new', 'dich-vu-new', '<i class=\"fa fa-magic\"></i>', 'Dich vu new', '&#60;p&#62;Dich vu new&#60;/p&#62;&#13;&#10;', 4, '2022-12-18 19:50:25', '2022-12-18 19:50:25', 1),
(50, 'Dich vu 4.7', 'dich-vu-47', '<i class=\"fa fa-long-arrow-left\"></i>', 'Dich vu 4.7', '&#60;p&#62;Dich vu 4.7&#60;/p&#62;&#13;&#10;', 4, '2022-12-18 21:13:21', '2022-12-20 20:45:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Chưa xử lý 1: Đang xử lý 2: Đã xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_facebook` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_twitter` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_linkedin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_pinterest` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0 COMMENT '0: Chưa kích hoạt - 1: Đã kích hoạt',
  `last_activity` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_twitter`, `contact_linkedin`, `contact_pinterest`, `forgot_token`, `group_id`, `status`, `last_activity`, `create_at`, `update_at`) VALUES
(1, 'Tien Hai Le', 'tienhai@gmail.com', '$2y$10$3wFCNyVe55jHdoeRC.sS/.MiQSA.WhVHu.blEw/bUVG.5qxYgZhSK', 'le tien hai da den day nha moi nguoi', 'link face', 'link twitter', '', '', NULL, 1, 1, '2023-03-18 22:10:44', '2022-08-08 01:08:00', '2022-12-11 15:48:52'),
(4, 'Tiến Hải', 'tienhai488@gmail.com', '$2y$10$3aQaOLqlkN/pcc/uYIw1UuFMgnTYy0f8ZkvQoboxFnfFEcetvZopy', 'Hi My name is Lamp! quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterations. Vivamus vehicula quis cursus. In hac habitasse platea dictumst Aenean tristique odio id lectus solmania trundard lamp!', '', '', '', '', '', 1, 1, '2023-12-11 20:54:49', '2022-10-11 15:54:22', '2023-03-13 22:56:44'),
(5, 'Minh Lâm', 'tienhai4888@gmail.com', '$2y$10$B/2UHjo7QajhmvFR0q.Lzeqg5UiHjfPbvxfy0a7x3BVT0iBjeN/Km', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2022-12-22 17:29:33', '2022-12-11 15:49:42', '2022-12-11 15:57:13'),
(6, 'Mạnh Tuấn', 'manhtuan@gmail.com', '$2y$10$rW0U7E.1u.GY/JvZurXVe./WyrAHCkC9dZi2gBLMqezyk6APuV3nW', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2022-12-11 15:59:10', '2022-12-11 16:01:53');

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
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
  ADD KEY `portfolio_category_id` (`portfolio_category_id`),
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
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`);

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`),
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD CONSTRAINT `portfolio_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
