-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 02:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `np_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambassador_details`
--

CREATE TABLE `ambassador_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `about` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NYC',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YC',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YC',
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `joining` date DEFAULT NULL,
  `high_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lorem Ipsum',
  `workplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lorem Ipsum',
  `hobbies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lorem Ipsum',
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'a:9:{s:5:"about";s:7:"friends";s:4:"city";s:7:"friends";s:5:"state";s:7:"friends";s:12:"relationship";s:7:"friends";s:7:"joining";s:7:"friends";s:11:"high_school";s:7:"friends";s:9:"workplace";s:7:"friends";s:7:"hobbies";s:7:"friends";s:5:"phone";s:7:"friends";}',
  `network_privacy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'a:1:{s:7:"friends";s:7:"friends";}',
  `address_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `npi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `kyc_reject_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambassador_details`
--

INSERT INTO `ambassador_details` (`id`, `user_id`, `about`, `city`, `state`, `country`, `relationship`, `joining`, `high_school`, `workplace`, `hobbies`, `cover_photo`, `privacy`, `network_privacy`, `address_1`, `address_2`, `date_of_birth`, `npi`, `attachment_type`, `attachment_no`, `attachment_1`, `attachment_2`, `kyc_status`, `kyc_reject_reason`, `meta_title`, `meta_description`, `meta_image`, `created_at`, `updated_at`) VALUES
(1, 2, '', 'NYC', 'YC', 'YC', 'Single', NULL, 'Lorem Ipsum', 'Lorem Ipsum', 'NYC', '1656703476vid.jpg', 'a:9:{s:5:\"about\";s:7:\"friends\";s:4:\"city\";s:7:\"friends\";s:5:\"state\";s:7:\"friends\";s:12:\"relationship\";s:7:\"friends\";s:7:\"joining\";s:7:\"friends\";s:11:\"high_school\";s:7:\"friends\";s:9:\"workplace\";s:7:\"friends\";s:7:\"hobbies\";s:7:\"friends\";s:5:\"phone\";s:7:\"friends\";}', 'a:1:{s:7:\"friends\";s:7:\"friends\";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(2, 3, '', 'NYC', 'YC', 'YC', 'single', '2022-09-06', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', NULL, 'a:9:{s:5:\"about\";s:7:\"friends\";s:4:\"city\";s:7:\"friends\";s:5:\"state\";s:7:\"friends\";s:12:\"relationship\";s:7:\"friends\";s:7:\"joining\";s:7:\"friends\";s:11:\"high_school\";s:7:\"friends\";s:9:\"workplace\";s:7:\"friends\";s:7:\"hobbies\";s:7:\"friends\";s:5:\"phone\";s:7:\"friends\";}', 'a:1:{s:7:\"friends\";s:7:\"friends\";}', NULL, NULL, '1998-08-12', '123123123', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, '2022-09-06 13:00:28', '2022-09-06 13:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `from`, `to`, `message`, `file`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2', NULL, '2022-09-06 13:48:56', '2022-09-06 13:45:57', '2022-09-06 13:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `text`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 11, '2', NULL, NULL, '2022-09-06 13:46:13', '2022-09-06 13:46:13'),
(2, 3, 11, '2', NULL, NULL, '2022-09-06 13:46:16', '2022-09-06 13:46:16'),
(3, 3, 11, '3', NULL, NULL, '2022-09-06 13:46:19', '2022-09-06 13:46:19'),
(4, 3, 11, '8', NULL, NULL, '2022-09-06 13:46:23', '2022-09-06 13:46:23'),
(5, 3, 11, '5', NULL, NULL, '2022-09-06 13:46:29', '2022-09-06 13:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `from`, `to`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '1', NULL, '2022-09-06 13:00:53', '2022-09-06 13:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(286, '2014_10_12_000000_create_users_table', 1),
(287, '2014_10_12_100000_create_password_resets_table', 1),
(288, '2019_08_19_000000_create_failed_jobs_table', 1),
(289, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(290, '2022_06_15_124605_create_roles_table', 1),
(291, '2022_06_15_144850_create_permissions_table', 1),
(292, '2022_06_16_131529_create_referrals_table', 1),
(293, '2022_06_17_163404_create_ambassador_details_table', 1),
(294, '2022_06_17_183030_create_posts_table', 1),
(295, '2022_06_17_183327_create_post_assets_table', 1),
(296, '2022_06_20_182554_create_comments_table', 1),
(297, '2022_06_21_175153_create_likes_table', 1),
(298, '2022_06_23_140815_create_friends_table', 1),
(299, '2022_06_24_133829_create_chats_table', 1),
(300, '2022_07_06_183524_create_superadmin_referrals_table', 1),
(301, '2022_07_18_193837_create_settings_table', 1),
(302, '2022_08_24_180115_create_report_table', 1),
(303, '2022_08_26_112943_create_notifications_table', 1),
(304, '2022_08_31_121625_create_blocks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('47f8635f-1bac-4293-9504-12b3bf4ee117', 'App\\Notifications\\AmbassadorNotifications', 'App\\Models\\User', 3, '{\"msg\":\"<b>Parent Tier<\\/b> accepted your friend request.\",\"from\":2,\"url\":\"http:\\/\\/localhost:8000\\/profile-view\\/user\\/tier00\"}', '2022-09-06 13:48:45', '2022-09-06 13:01:18', '2022-09-06 13:48:45'),
('ae45912a-0977-43a6-9d1d-d1e8de40c289', 'App\\Notifications\\AmbassadorNotifications', 'App\\Models\\User', 2, '{\"msg\":\"<b>Azeem Muhammad<\\/b> sent you a friend request.\",\"from\":3,\"url\":\"http:\\/\\/localhost:8000\\/profile-view\\/user\\/enmazeeb\"}', '2022-09-06 13:01:12', '2022-09-06 13:00:53', '2022-09-06 13:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Create', 'create', '2022-09-06 12:59:35', '2022-09-06 12:59:35'),
(2, 'Edit', 'edit', '2022-09-06 12:59:35', '2022-09-06 12:59:35'),
(3, 'Delete', 'delete', '2022-09-06 12:59:35', '2022-09-06 12:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `details` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'friends',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post' COMMENT '1. post 2. cover 3. profile',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `details`, `privacy`, `type`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Testing post from Parent Tier [tier00@connectsocial.com] with privacy of friends', 'friends', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(2, 2, 'Testing post from Parent Tier [tier00@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(3, 2, 'Testing post from Parent Tier [tier00@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(4, 2, 'UPDATES Testing post from Parent Tier [tier00@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(5, 2, 'Testing post from Parent Tier [tier00@connectsocial.com] with privacy of friends', 'friends', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(6, 3, 'Testing post from Tier1 A [tier01_a@connectsocial.com] with privacy of friends', 'friends', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(7, 3, 'Testing post from Tier1 A [tier01_a@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(8, 3, 'Testing post from Tier1 A [tier01_a@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(9, 3, 'Testing post from Tier1 A [tier01_a@connectsocial.com] with privacy of public', 'public', 'post', NULL, NULL, '2022-09-06 12:59:37', '2022-09-06 12:59:37'),
(10, 3, 'Testing post from Tier1 A [tier01_a@connectsocial.com] with privacy of friends', 'friends', 'post', NULL, NULL, '2022-09-06 12:59:37', '2022-09-06 12:59:37'),
(11, 3, 'Azeem Muhammad updated his profile photo.', 'public', 'profile', NULL, NULL, '2022-09-06 13:00:28', '2022-09-06 13:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `post_assets`
--

CREATE TABLE `post_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_assets`
--

INSERT INTO `post_assets` (`id`, `post_id`, `type`, `file`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 11, 'image', '1662487228me.jpg', NULL, '2022-09-06 13:00:28', '2022-09-06 13:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referred_by` int(11) NOT NULL,
  `referred_to` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', '2022-09-06 12:59:35', '2022-09-06 12:59:35'),
(3, 'Ambassador', 'ambassador', '2022-09-06 12:59:35', '2022-09-06 12:59:35'),
(4, 'Admin', 'admin', '2022-09-06 12:59:35', '2022-09-06 12:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_referrals`
--

CREATE TABLE `superadmin_referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+1',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `email_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coa` int(11) DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_email` int(11) NOT NULL DEFAULT 0,
  `rewarded` int(11) NOT NULL DEFAULT 0,
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `country_code`, `phone`, `email_verified_at`, `password`, `gender`, `role`, `email_code`, `coa`, `profile`, `email_token`, `send_email`, `rewarded`, `stripe_customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'super_admin', 'connectsocialdev@napollo.net', '+1', '3001231231', '2022-06-11 19:37:13', '$2y$10$v1bbz8LrbsLpvZPXNwBpkuqv3ZKZImxkCgGvq2cAUHzoga2wX8vNm', 'Male', 1, NULL, NULL, 'coin.png', NULL, 0, 0, NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(2, 'Parent', 'Tier', 'tier00', 'tier00@connectsocial.com', '+1', '3040647306', '2022-06-11 19:37:13', '$2y$10$v1bbz8LrbsLpvZPXNwBpkuqv3ZKZImxkCgGvq2cAUHzoga2wX8vNm', 'Male', 3, '667966', 2, '1656675151blank-profile-picture-973460_640.png', NULL, 0, 0, NULL, NULL, '2022-09-06 12:59:36', '2022-09-06 12:59:36'),
(3, 'Azeem', 'Muhammad', 'enmazeeb', 'azeem@napollo.net', '+1', '3040647306', '2022-09-06 13:00:37', '$2y$10$RGC8.8T1Akt2xVb8cGb9NO4SAQXj9NvzGRMp2v7CTc6MnByinT2m6', 'Male', 3, NULL, NULL, '1662487228me.jpg', NULL, 0, 0, NULL, NULL, '2022-09-06 13:00:28', '2022-09-06 13:00:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambassador_details`
--
ALTER TABLE `ambassador_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_assets`
--
ALTER TABLE `post_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin_referrals`
--
ALTER TABLE `superadmin_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambassador_details`
--
ALTER TABLE `ambassador_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_assets`
--
ALTER TABLE `post_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin_referrals`
--
ALTER TABLE `superadmin_referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
