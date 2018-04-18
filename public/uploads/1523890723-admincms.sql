-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 10:00 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admincms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `type`, `created_at`, `updated_at`) VALUES
(1, 'C:\\xampp\\htdocs\\AdminCMS\\app\\Http\\Controllers\\Admin\\CalendarController.php', 'Controller', '2017-10-27 22:46:30', '2017-10-27 22:46:30'),
(2, 'C:\\xampp\\htdocs\\AdminCMS\\resources\\views\\admin\\calendar\\index.blade.php', 'View', '2017-10-27 22:46:30', '2017-10-27 22:46:30'),
(3, 'C:\\xampp\\htdocs\\AdminCMS\\app\\Http\\Controllers\\Admin\\FormsController.php', 'Controller', '2017-10-29 17:18:33', '2017-10-29 17:18:33'),
(4, 'C:\\xampp\\htdocs\\AdminCMS\\resources\\views\\admin\\forms\\index.blade.php', 'View', '2017-10-29 17:18:33', '2017-10-29 17:18:33'),
(5, 'C:\\xampp\\htdocs\\adminCMS3\\database\\migrations\\2018_02_20_145138_create_products_table.php', 'Migration', '2018-02-20 06:51:38', '2018-02-20 06:51:38'),
(6, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Products.php', 'Model', '2018-02-20 06:51:38', '2018-02-20 06:51:38'),
(7, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\CreateProductsRequest.php', 'Request', '2018-02-20 06:51:38', '2018-02-20 06:51:38'),
(8, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\UpdateProductsRequest.php', 'Request', '2018-02-20 06:51:38', '2018-02-20 06:51:38'),
(9, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Controllers\\Admin\\ProductsController.php', 'Controller', '2018-02-20 06:51:38', '2018-02-20 06:51:38'),
(10, 'C:\\xampp\\htdocs\\adminCMS3\\database\\migrations\\2018_02_20_145427_create_products_table.php', 'Migration', '2018-02-20 06:54:27', '2018-02-20 06:54:27'),
(11, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Products.php', 'Model', '2018-02-20 06:54:27', '2018-02-20 06:54:27'),
(12, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\CreateProductsRequest.php', 'Request', '2018-02-20 06:54:27', '2018-02-20 06:54:27'),
(13, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Requests\\UpdateProductsRequest.php', 'Request', '2018-02-20 06:54:27', '2018-02-20 06:54:27'),
(14, 'C:\\xampp\\htdocs\\adminCMS3\\app\\Http\\Controllers\\Admin\\ProductsController.php', 'Controller', '2018-02-20 06:54:27', '2018-02-20 06:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `position`, `menu_type`, `icon`, `name`, `title`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, 'User', 'User', NULL, NULL, NULL),
(2, NULL, 0, NULL, 'Role', 'Role', NULL, NULL, NULL),
(3, NULL, 0, NULL, 'Files', 'Files', NULL, NULL, NULL),
(4, 4, 3, 'fa-calendar', 'Calendar', 'Calendar', NULL, '2017-10-27 22:46:30', '2018-02-20 06:54:47'),
(5, 1, 2, 'fa-archive', 'Parent', 'Parent', NULL, '2017-10-27 22:46:59', '2018-01-07 13:37:03'),
(6, 2, 3, 'fa-archive', 'Forms', 'Forms', NULL, '2017-10-29 17:18:33', '2018-02-20 06:54:50'),
(8, 3, 1, 'fa-list-alt', 'Products', 'Products', NULL, '2018-02-20 06:54:26', '2018-02-20 06:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_id`, `role_id`) VALUES
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(8, 1),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_10_10_000000_create_menus_table', 1),
(4, '2015_10_10_000000_create_roles_table', 1),
(5, '2015_10_10_000000_update_users_table', 1),
(6, '2015_12_11_000000_create_users_logs_table', 1),
(7, '2016_03_14_000000_update_menus_table', 1),
(8, '2017_10_25_100527_create_files_table', 1),
(9, '2017_10_30_054451_create_category_table', 2),
(10, '2018_02_20_145427_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sProductName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sProductDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sProductName`, `sProductDescription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Samsung Galaxy Tab', 'Samsung Galaxy Tab Black', '2018-02-20 07:07:12', '2018-02-20 07:07:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2017-10-27 20:05:04', '2017-10-27 20:05:04'),
(2, 'User', '2017-10-27 20:05:04', '2017-10-27 20:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@example.com', '$2y$10$75z0mTJbiCJy89GTe6csheSMxdSm6L9/u1CWngUgh8Ifkd0zKmINi', 'HNw2mQ5VD3oS7YKS5AHIJpmmOVVz7IjQPRl2HkF4ci3YlJlGUkwmWTpz18o0', '2017-10-27 20:05:21', '2017-10-27 20:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `action`, `action_model`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'updated', 'users', 1, '2017-10-27 20:05:44', '2017-10-27 20:05:44'),
(2, 1, 'updated', 'users', 1, '2017-10-27 20:47:52', '2017-10-27 20:47:52'),
(3, 1, 'updated', 'users', 1, '2017-11-24 21:57:55', '2017-11-24 21:57:55'),
(4, 1, 'updated', 'users', 1, '2018-01-11 22:33:52', '2018-01-11 22:33:52'),
(5, 1, 'updated', 'users', 1, '2018-01-14 04:09:31', '2018-01-14 04:09:31'),
(6, 1, 'created', 'products', 1, '2018-02-20 07:07:12', '2018-02-20 07:07:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD UNIQUE KEY `menu_role_menu_id_role_id_unique` (`menu_id`,`role_id`),
  ADD KEY `menu_role_menu_id_index` (`menu_id`),
  ADD KEY `menu_role_role_id_index` (`role_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
