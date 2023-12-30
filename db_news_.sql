-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2021 at 05:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_data`
--

CREATE TABLE `audit_data` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` blob DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_entry`
--

CREATE TABLE `audit_entry` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `duration` float DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `request_method` varchar(16) DEFAULT NULL,
  `ajax` int(1) NOT NULL DEFAULT 0,
  `route` varchar(255) DEFAULT NULL,
  `memory_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_error`
--

CREATE TABLE `audit_error` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` text NOT NULL,
  `code` int(11) DEFAULT 0,
  `file` varchar(512) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `trace` blob DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `emailed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_javascript`
--

CREATE TABLE `audit_javascript` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `origin` varchar(512) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_mail`
--

CREATE TABLE `audit_mail` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `successful` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `text` blob DEFAULT NULL,
  `html` blob DEFAULT NULL,
  `data` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `field` varchar(255) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '1', 1633587332),
('Admin', '10', 1633398952),
('Admin', '7', 1633522734),
('Admin', '9', 1630988128),
('Writer', '8', 1630912654);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, NULL, NULL, NULL, 1630900794, 1630900794),
('Writer', 1, NULL, NULL, NULL, 1630900784, 1630900784);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auto_number`
--

CREATE TABLE `auto_number` (
  `group` varchar(32) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `optimistic_lock` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `photo`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'Smart', 'learning-3245793__480.webp', 1633571378, 1633575588, 1, 1),
(5, 'Perpustakaan', 'library-869061__480.jpg', 1633574197, 1633575578, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(119) NOT NULL COMMENT 'Nama Kategori',
  `slug` varchar(50) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(8, 'Technology', 'technology', 1, 1632630855, 1633576302, 8, 1),
(27, 'Vidio Game', 'vidio-game', 1, 1633477366, 1633576357, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contact_name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(18, 'Aboutme', 'Ini adalah project portal berita .', 1633473650, 1633576079, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL COMMENT 'Berita',
  `file_news` varchar(225) DEFAULT NULL COMMENT 'file download/gambar',
  `page` varchar(225) DEFAULT NULL COMMENT 'url halaman',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `news_id`, `file_news`, `page`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(48, 57, 'https://asset.kompas.com/crops/SKiwOpVXOniUAQjI3Vix_0XZcfg=/0x0:841x561/750x500/data/photo/2021/07/05/60e29160a7f83.png', 'https://www.kompas.com/skola/read/2021/07/05/121323869/artificial-intelligence-ai-pengertian-perkembangan-cara-kerja-dan', 1633576561, 1633576561, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `pages_id` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'id menu yang parent',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `category_id`, `pages_id`, `parent_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(9, '8', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '27', NULL, 9, NULL, NULL, NULL, NULL),
(11, '', '1', 9, NULL, NULL, NULL, NULL),
(12, '', '2', NULL, NULL, NULL, NULL, NULL),
(13, '', '2', 12, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL COMMENT 'Judul Berita',
  `category_id` int(11) DEFAULT NULL COMMENT 'Kategory Id',
  `subcategory_id` int(11) DEFAULT NULL,
  `publish_at` int(11) DEFAULT NULL COMMENT 'Tanggal Publish',
  `author_id` int(11) NOT NULL COMMENT 'Nama Penulis',
  `content` text NOT NULL COMMENT 'isi Berita',
  `photo` varchar(225) DEFAULT NULL,
  `views` int(11) DEFAULT NULL COMMENT 'views',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category_id`, `subcategory_id`, `publish_at`, `author_id`, `content`, `photo`, `views`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(57, 'Artificial Inteligen', 8, 10, 1633576561, 1, '<p>Dalam banyak fiksi ilmiah keberdaan robot humanoid adalah hal yang mengasyikan juga berbahaya. Robot-robot tersebut memiliki wujud seperti manusia, belum lagi mereka dilengkapi dengan kecerdasan buatan. Kecerdasan buatan membuat robot bisa berpikiri dan mengambil keputusan layaknya manusia. Tahukah kamu bahwa kecerdasan buatan bukan hanya sekadar fiksi ilmiah, melainkan sedang dikembangkan di dunia nyata? Dilansir dari Stanford Computer Science, artificial intelligence (AI) atau kecerdasan buatan adalah ilmu dan rekayasa pembuatan mesin cerdas, melibatkan mekanisme untuk menjalankan suatu tugas menggunakan komputer.<br />\r\n<br />\r\nArtikel ini telah tayang di&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;dengan judul &quot;Artificial Intelligence (AI): Pengertian, Perkembangan, Cara Kerja, dan Dampaknya&quot;, Klik untuk baca:&nbsp;<a href=\"https://www.kompas.com/skola/read/2021/07/05/121323869/artificial-intelligence-ai-pengertian-perkembangan-cara-kerja-dan\">https://www.kompas.com/skola/read/2021/07/05/121323869/artificial-intelligence-ai-pengertian-perkembangan-cara-kerja-dan</a>.<br />\r\nPenulis : Silmi Nurul Utami<br />\r\nEditor : Serafica Gischa<br />\r\n<br />\r\nDownload aplikasi&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;untuk akses berita lebih mudah dan cepat:<br />\r\nAndroid:&nbsp;<a href=\"https://bit.ly/3g85pkA\">https://bit.ly/3g85pkA</a><br />\r\niOS:&nbsp;<a href=\"https://apple.co/3hXWJ0L\">https://apple.co/3hXWJ0L</a></p>\r\n', '60e29160a7f83.png', NULL, 1, 1633576561, 1633576561, 1, 1),
(58, 'test 2', 8, NULL, 1633616650, 1, '<p>jkdks</p>\r\n', '14-elang_gumilang.jpg', NULL, 1, 1633616650, 1633616650, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL COMMENT 'Judul Laman',
  `publish_at` int(11) DEFAULT NULL COMMENT 'Tanggal Publish',
  `author_id` int(11) NOT NULL COMMENT 'Nama Penulis',
  `content` text NOT NULL COMMENT 'Konten',
  `photo` varchar(225) DEFAULT NULL,
  `views` int(11) DEFAULT NULL COMMENT 'views',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `publish_at`, `author_id`, `content`, `photo`, `views`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'test', 1633616415, 1, '<p>konten</p>\r\n', '14-elang_gumilang.jpg', NULL, 1, 1633616415, 1633616415, 1, 1),
(2, 'Kontak', 1633616415, 1, '<p>konten</p>\r\n', '14-elang_gumilang.jpg', NULL, 1, 1633616415, 1633616415, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `notelp` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama`, `alamat`, `notelp`) VALUES
(1, 'News', 'Padang', '07766655');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` char(64) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `remote_addr` varchar(255) DEFAULT NULL,
  `x_forwarded_for` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'SubCategori',
  `category_id` int(11) NOT NULL COMMENT 'Kategori',
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `category_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(9, 'Aplikasi', 8, 1633576302, 1, 1633576302, 1),
(10, 'Robot', 8, 1633576302, 1, 1633576302, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor HP',
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `name`, `phone`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `verification_token`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'admin@mail.com', '1630898917_2rsUzsrrC6ot3bbld5ig0qSTlGwMU-XX', 'Admin', NULL, '8-Zl5MWyYR-qp-xJ4GsXMjPxqWFhVWQj', '$2y$13$wgnzGEno6Izm5bB8TMjh3eTBnVMSpl7gm6eC5XcADAC7Yh/aHg/kW', NULL, 10, 'u6PGYwm7Ne5uxpNNHSB0kZonkkfp6CbO_1630898919', 1630898919, 1633587332, NULL, NULL),
(7, 'email1@mail.com', 'user102929', 'user', '0938931', 'pNigFm2EOHBKeEyTZNFEv-dR22Si-Rni', '$2y$13$PsMKF7R8XvscGMbf8xyvjOCEc.3n3ZGWpjAQaROcMNWdNMsnKuFZu', NULL, 10, '-I-k35r5-exWV6tuu7Fc-QUYwzw0z30u_1630912084', 1630912084, 1633522734, NULL, 1),
(8, 'writer@mail.com', 'writer260298', 'writer 1', '08319898989', '1oQcfQjNfuYWfsGc2h3sukEvS5Zyf5JL', '$2y$13$30r6qw1OAGWhsfR/kpW.aOW2.cs5wowvvlYvQfWDG60J/8M/zPsKu', NULL, 10, 'Gdi7ha036QlRuRXsAuDOEn4MPqSHG-ao_1630912654', 1630912654, 1631363641, NULL, NULL),
(9, 'test@ma', 'GXMJo2f3QoXcXMGTZ4D4XgntlDNTjBrb_1630988128', 'jkad', NULL, 'TgEd2L0pQbNmIuQM-lo2cm6YFLTcV3eu', '$2y$13$BGJhhi18eYw0bsVUttxhu.Bn2paRTN7JKYGWcjddO/xXl5I1AVV62', NULL, 10, NULL, 1630988128, 1630988128, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_data`
--
ALTER TABLE `audit_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_data_entry_id` (`entry_id`);

--
-- Indexes for table `audit_entry`
--
ALTER TABLE `audit_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_route` (`route`);

--
-- Indexes for table `audit_error`
--
ALTER TABLE `audit_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_error_entry_id` (`entry_id`),
  ADD KEY `idx_file` (`file`(180)),
  ADD KEY `idx_emailed` (`emailed`);

--
-- Indexes for table `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_javascript_entry_id` (`entry_id`);

--
-- Indexes for table `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_mail_entry_id` (`entry_id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_trail_entry_id` (`entry_id`),
  ADD KEY `idx_audit_user_id` (`user_id`),
  ADD KEY `idx_audit_trail_field` (`model`,`model_id`,`field`),
  ADD KEY `idx_audit_trail_action` (`action`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `auto_number`
--
ALTER TABLE `auto_number`
  ADD PRIMARY KEY (`group`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_user_id_ibfk_1` (`created_by`),
  ADD KEY `category_user_id_ibfk_2` (`updated_by`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_user_id_ibfk_1` (`created_by`),
  ADD KEY `photo_user_id_ibfk_2` (`updated_by`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_log_level` (`level`),
  ADD KEY `idx_log_category` (`category`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_author_id` (`author_id`),
  ADD KEY `news_user_id_ibfk_1` (`created_by`),
  ADD KEY `news_user_id_ibfk_2` (`updated_by`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_data`
--
ALTER TABLE `audit_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_entry`
--
ALTER TABLE `audit_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_error`
--
ALTER TABLE `audit_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_javascript`
--
ALTER TABLE `audit_javascript`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_mail`
--
ALTER TABLE `audit_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_data`
--
ALTER TABLE `audit_data`
  ADD CONSTRAINT `fk_audit_data_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_error`
--
ALTER TABLE `audit_error`
  ADD CONSTRAINT `fk_audit_error_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD CONSTRAINT `fk_audit_javascript_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD CONSTRAINT `fk_audit_mail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `fk_audit_trail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `relasi11` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `relasi12` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_user_id_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `category_user_id_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `relasi1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `relasi2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photo_user_id_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `photo_user_id_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `relasiid1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `relasiid2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_user_id_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `news_user_id_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
