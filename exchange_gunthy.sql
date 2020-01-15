-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2019 at 01:05 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.15-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exchange_gunthy`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `api_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `api_name`, `key`, `secret`, `created_at`, `updated_at`) VALUES
(7, 11, 'qwer', 'h5tF1rnb9dJqSg2a', 'xEdBI7zUq49HrJp35PsyhmaSeZ1tLNVY', '2019-03-24 22:38:12', '2019-03-24 22:38:12'),
(8, 11, '1234', 'wunV0gARN3D7WEyQ', 'EHgltjmqp15YsfGrL602NkzIdiTKoDbX', '2019-03-24 23:06:40', '2019-03-24 23:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `api_roles`
--

CREATE TABLE `api_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_role_api_key`
--

CREATE TABLE `api_role_api_key` (
  `id` int(10) UNSIGNED NOT NULL,
  `api_role_id` int(10) UNSIGNED NOT NULL,
  `api_key_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_15_105324_create_roles_table', 1),
(4, '2016_01_15_114412_create_role_user_table', 1),
(5, '2016_01_26_115212_create_permissions_table', 1),
(6, '2016_01_26_115523_create_permission_role_table', 1),
(7, '2016_02_09_132439_create_permission_user_table', 1),
(8, '2017_03_09_082449_create_social_logins_table', 1),
(9, '2017_03_09_082526_create_activations_table', 1),
(10, '2017_03_20_213554_create_themes_table', 1),
(11, '2017_03_21_042918_create_profiles_table', 1),
(12, '2017_05_20_095210_create_tasks_table', 1),
(13, '2019_03_19_141610_add_google2fa_column_to_users', 2),
(14, '2019_03_21_091942_add_gunthy_keys_column_to_users', 3),
(15, '2019_03_21_140725_create_api_keys_table', 4),
(16, '2019_03_21_142743_create_api_roles_table', 4),
(17, '2019_03_21_142757_create_api_role_api_key_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`) VALUES
(1, 'Can View Users', 'view.users', 'Can view users', 'Permission', '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(2, 'Can Create Users', 'create.users', 'Can create new users', 'Permission', '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(3, 'Can Edit Users', 'edit.users', 'Can edit users', 'Permission', '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(4, 'Can Delete Users', 'delete.users', 'Can delete users', 'Permission', '2019-03-05 13:05:54', '2019-03-05 13:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(2, 2, 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(3, 3, 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(4, 4, 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `theme_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `twitter_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_profile_bg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '/images/default-user-bg.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `theme_id`, `location`, `bio`, `twitter_username`, `github_username`, `avatar`, `avatar_status`, `user_profile_bg`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-05 13:05:55', '2019-03-05 13:05:55'),
(2, 2, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-05 13:05:55', '2019-03-05 13:05:55'),
(3, 9, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-10 18:49:04', '2019-03-10 18:49:04'),
(5, 11, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-10 23:20:26', '2019-03-10 23:20:26'),
(6, 13, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-16 15:49:39', '2019-03-16 15:49:39'),
(7, 14, 1, NULL, NULL, NULL, NULL, NULL, 0, '/images/default-user-bg.png', '2019-03-24 02:36:25', '2019-03-24 02:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'Admin Role', 5, '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(2, 'User', 'user', 'User Role', 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54'),
(3, 'Unverified', 'unverified', 'Unverified Role', 0, '2019-03-05 13:05:54', '2019-03-05 13:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-03-05 13:05:55', '2019-03-05 13:05:55'),
(2, 2, 2, '2019-03-05 13:05:55', '2019-03-05 13:05:55'),
(10, 2, 9, '2019-03-10 18:49:04', '2019-03-10 18:49:04'),
(14, 2, 11, '2019-03-10 23:20:26', '2019-03-10 23:20:26'),
(17, 2, 13, '2019-03-16 15:49:39', '2019-03-16 15:49:39'),
(19, 2, 14, '2019-03-24 02:36:25', '2019-03-24 02:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_confirmation_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_sm_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `google2fa_secret` text COLLATE utf8mb4_unicode_ci,
  `gunthy_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gunthy_api_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `password`, `remember_token`, `activated`, `token`, `signup_ip_address`, `signup_confirmation_ip_address`, `signup_sm_ip_address`, `admin_ip_address`, `updated_ip_address`, `deleted_ip_address`, `created_at`, `updated_at`, `deleted_at`, `google2fa_secret`, `gunthy_api_key`, `gunthy_api_secret`) VALUES
(1, 'betsy08', 'Abigayle', 'Hegmann', 'admin@admin.com', '1234567890', '$2y$10$4TxZt2/4E.mO8zL2QCJehOBCu3PuA3p9//6tXRGxY4pB5bBUgubmC', 'RKfjZlUMuXrWfZ1whhM8oh92FhfPzlX9MwQdloZNbpyUYa19W5QDOTc8RBq2', 1, 'fuF9tII79qCCFn50aNZ7Y7y4kOq4ooF0lLwIVrtpuk8gOEH4QTpOlccQzFqyRJdX', NULL, '23.209.217.146', NULL, '109.20.138.60', NULL, NULL, '2019-03-05 13:05:55', '2019-03-05 13:05:55', NULL, '', NULL, NULL),
(2, 'halvorson.melany', 'Jeffry', 'Mayert', 'user@user.com', '23456789098', '$2y$10$Y/lONGVcKc2s9ud3UgbDOexSYxxHgh6pSD09kxNU5ORKhfG49u8Ke', 'T3gBv20RqqTVsxNDqrdcR5EiFxZhxDWQyxuyf5spijF5dhqA5L6P0XBIEYPW', 1, 'tBkFnhHUOfY122pgnPIYzGGrbc3bEPchNcuiX3KeHmryAtWk7MRNHbzy78rzz4fn', '211.67.245.52', '128.102.78.196', NULL, NULL, NULL, NULL, '2019-03-05 13:05:55', '2019-03-05 13:05:55', NULL, '', NULL, NULL),
(9, 'pew20pew', 'alyosha', 'Ruslanovich', 'pew20pew@gmail.com', '0987654321123', '$2y$10$c4Pt6AJelP4ORJJgPeOOgOjLfl72Wkw0N.3MTNg2DMbwUYOtnqk6.', '3Hd6RE7FUHLRlw0UR4XojiTEBuvFe8IYACl9bDnuVfgCu9V1uEzuL9wJDjgX', 1, 'LL1kzS8QywOo5QLiPTlmd6kRl432P0VEseH8ny94lbbmRXwNVfRXgKwItZfaMnxe', '188.43.224.141', '188.43.224.141', NULL, NULL, NULL, NULL, '2019-03-10 18:46:50', '2019-03-22 20:52:08', NULL, '', NULL, NULL),
(11, 'Alyosha', 'Alyosha', 'Ruslanovich', 'Alyosha.Ruslanovich@gmail.com', '65431234567876', '$2y$10$6K6.LOUUhzNPKV.G8OTo7ujuntGGncSwgE1pn3OCAcqd/rX/HW0Q.', '4Dp1x5gCGuoiwJRglRRhCtjO3Xq3yCXWX06f4vwn0w3yM0aj01vuxJOq2qE2', 1, 'zISGyJ5Vas8AAsmlJY6AFJI7tPt3xl2lx6LcTgiOmJdAabzrHmXFbsJ3zByoYEQh', '188.43.224.141', '188.43.224.141', NULL, NULL, NULL, NULL, '2019-03-10 23:19:01', '2019-03-25 16:42:27', NULL, 'eyJpdiI6ImhLeExmYnJlaXJBVUJPVGEyN092c0E9PSIsInZhbHVlIjoiTmplVWM1QlduczFiNEhlYUtacVo5eFFcLzluVW1kUTJWS3hXRXgyWHpra1Noc1orR2JCRXFjMWdXZTh3dlwvMzJtYjBRSWJ2bkxxbTRXYkc2NURBVCtSMmlQUGlEbjR5SzZuTzdJM0xEMVwvK1pPOGtlOThcL3cwTWhLaCtEMlZVTWtSaklDSVdUZHJoSTY3Yyt6cFZWXC9YMGJSQXNZWjlHMHR6NjgxOWpUYytKWHdhcWFqSWtVQmtuNmdQM2lcL2tzb2VRNTZhbmtFZUlFaXY4Q0dER2wreGdYQU15Y3VxWTRvU1Bob0tVdGdGTkVLTnJOQ3F2Q0ROdG4xaENiR3g1bk9CUEMyNFVKekJkbjBmWWxwa2tvTzFrcElJOWRiWFdQeHZ4eDliQ1RXUUYxbmhsREE4WkxNcTlvRWd6c3p1cXF6WUoiLCJtYWMiOiJjNDFjMWFhYmJjM2ZiY2FjODg5Yzk5MmUwYjNhNGU0MWFmMjVlN2U1YmVlYTZlM2NlM2NmZjhjY2RlMTQ0NjcwIn0=', NULL, NULL),
(13, 'Alexey', 'Alexey', 'Khlebnikov', 'Alexey.Khlebnikov@outlook.com', '7878657456', '$2y$10$2AbMb4SDOLvvJWGFpgLHhe7OzHI6uP3fp4Yqw39P58pGM4kYR1P0K', 'PCv12HYcwZvMwULxP3GRIyGh7GKgxILHv1AEMEycGLTvwC6gXHjfTthKkYlJ', 1, '7y35peiNBjognjHwVr37KAaWHchSXggVcX8WxAEkAsivT4vbIESsuRUqj54LOpkZ', '188.43.224.141', '188.43.224.141', NULL, NULL, NULL, NULL, '2019-03-16 15:48:24', '2019-03-16 15:49:39', NULL, '', NULL, NULL),
(14, 'gunthardeniro@gmail.com', 'Gunthar', 'De Niro', 'gunthardeniro@gmail.com', '+39123456789', '$2y$10$G19JAQBQz6goIC0VV.QnWOb.XF0iNQzG8IO3AUKO7mjinDedkzGNe', 'x4opX0oOFw8QBXUUyT4rg8lxEaax4DDXLWQ9Chc9DWQo8Vtv8AuiNbIv8nvK', 1, '7nDml4ohfqGxb3sJEpD31z8VIxozTHxq27b17scPJj2NPhcqX4E7tPsikU6wYGJ9', '79.18.44.194', '79.18.44.194', NULL, NULL, NULL, NULL, '2019-03-24 02:35:03', '2019-03-24 02:38:55', NULL, 'eyJpdiI6InJWWXdMUngxZFg4WXNyWG82YWE3TFE9PSIsInZhbHVlIjoiZis3VHd4RDFGVDdieEsyRXlKOUlxVDJxVDdIdGU0VHJDNWUzQ3lwWm5PZXpwWXdaZVJnXC9XV2xRK1RGVFBhamNORXpLYmhJbVVCOXZLOEpBQlpwTVMwNkpjQ3RBMTRcL09Ha1wvRkZXOWFPYXp6eStKVERvMklcL2JBQWJiMDhBYXh3VEV4WGEyTW5GUWZFdTI3RGhqQjJpSEw5THZYcVc2WWw3ZVlldEdTc2NxMkxsTVFhcDJ2MnV6dk45MmRFYXJjZGdNdmJnYW5nRk5qZW1ZYlBEeHNxZk0xbjF4eDh2XC9ycHZ6cmRkZVA3T082dnYzSjI5cXR2WUFCU040XC9VZXQ3SUQ1cWZcL2VPT3I3MmNwbXpzXC9oaml1RktnbEprcFJSNzcxRXdKUWlCZXdSMWVHTDZETVVYYkFCeCs3dFl1TjR6eSIsIm1hYyI6Ijg5NzFlOWIyNTAwNjQ4YmZlMTY2MmQ0NWJlYThlMDQ3ZGQ2NTY2ZThjMTk1ZjU0ODZjYTRkZWEwOGNjMjFjNzMifQ==', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `link`, `notes`, `status`, `taggable_type`, `taggable_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Default', 'material.min.css', NULL, 1, 'theme', 1, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(2, 'Amber / Blue', 'material.amber-blue.min.css', NULL, 1, 'theme', 2, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(3, 'Amber / Cyan', 'material.amber-cyan.min.css', NULL, 1, 'theme', 3, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(4, 'Amber / Deep Orange', 'material.amber-deep_orange.min.css', NULL, 1, 'theme', 4, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(5, 'Amber / Deep Purple', 'material.amber-deep_purple.min.css', NULL, 1, 'theme', 5, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(6, 'Amber / Green', 'material.amber-green.min.css', NULL, 1, 'theme', 6, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(7, 'Amber / Indigo', 'material.amber-indigo.min.css', NULL, 1, 'theme', 7, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(8, 'Amber / Light Blue', 'material.amber-light_blue.min.css', NULL, 1, 'theme', 8, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(9, 'Amber / Light Green', 'material.amber-light_green.min.css', NULL, 1, 'theme', 9, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(10, 'Amber / Lime', 'material.amber-lime.min.css', NULL, 1, 'theme', 10, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(11, 'Amber / Orange', 'material.amber-orange.min.css', NULL, 1, 'theme', 11, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(12, 'Amber / Pink', 'material.amber-pink.min.css', NULL, 1, 'theme', 12, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(13, 'Amber / Purple', 'material.amber-purple.min.css', NULL, 1, 'theme', 13, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(14, 'Amber / Red', 'material.amber-red.min.css', NULL, 1, 'theme', 14, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(15, 'Amber / Teal', 'material.amber-teal.min.css', NULL, 1, 'theme', 15, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(16, 'Amber / Yellow', 'material.amber-yellow.min.css', NULL, 1, 'theme', 16, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(17, 'Blue Grey / Amber', 'material.blue_grey-amber.min.css', NULL, 1, 'theme', 17, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(18, 'Blue Grey / Blue', 'material.blue_grey-blue.min.css', NULL, 1, 'theme', 18, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(19, 'Blue Grey / Cyan', 'material.blue_grey-cyan.min.css', NULL, 1, 'theme', 19, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(20, 'Blue Grey / Deep Orange', 'material.blue_grey-deep_orange.min.css', NULL, 1, 'theme', 20, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(21, 'Blue Grey / Deep Purple', 'material.blue_grey-deep_purple.min.css', NULL, 1, 'theme', 21, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(22, 'Blue Grey / Green', 'material.blue_grey-green.min.css', NULL, 1, 'theme', 22, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(23, 'Blue Grey / Indigo', 'material.blue_grey-indigo.min.css', NULL, 1, 'theme', 23, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(24, 'Blue Grey / Light Blue', 'material.blue_grey-light_blue.min.css', NULL, 1, 'theme', 24, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(25, 'Blue Grey / Light Green', 'material.blue_grey-light_green.min.css', NULL, 1, 'theme', 25, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(26, 'Blue Grey / Lime', 'material.blue_grey-lime.min.css', NULL, 1, 'theme', 26, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(27, 'Blue Grey / Orange', 'material.blue_grey-orange.min.css', NULL, 1, 'theme', 27, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(28, 'Blue Grey / Pink', 'material.blue_grey-pink.min.css', NULL, 1, 'theme', 28, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(29, 'Blue Grey / Purple', 'material.blue_grey-purple.min.css', NULL, 1, 'theme', 29, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(30, 'Blue Grey / Red', 'material.blue_grey-red.min.css', NULL, 1, 'theme', 30, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(31, 'Blue Grey / Teal', 'material.blue_grey-teal.min.css', NULL, 1, 'theme', 31, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(32, 'Blue Grey / Yellow', 'material.blue_grey-yellow.min.css', NULL, 1, 'theme', 32, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(33, 'Blue / Amber', 'material.blue-amber.min.css', NULL, 1, 'theme', 33, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(34, 'Blue / Cyan', 'material.blue-cyan.min.css', NULL, 1, 'theme', 34, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(35, 'Blue / Deep Orange', 'material.blue-deep_orange.min.css', NULL, 1, 'theme', 35, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(36, 'Blue / Deep Purple', 'material.blue-deep_purple.min.css', NULL, 1, 'theme', 36, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(37, 'Blue / Green', 'material.blue-green.min.css', NULL, 1, 'theme', 37, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(38, 'Blue / Indigo', 'material.blue-indigo.min.css', NULL, 1, 'theme', 38, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(39, 'Blue / Light Blue', 'material.blue-light_blue.min.css', NULL, 1, 'theme', 39, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(40, 'Blue / Light Green', 'material.blue-light_green.min.css', NULL, 1, 'theme', 40, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(41, 'Blue / Lime', 'material.blue-lime.min.css', NULL, 1, 'theme', 41, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(42, 'Blue / Orange', 'material.blue-orange.min.css', NULL, 1, 'theme', 42, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(43, 'Blue / Pink', 'material.blue-pink.min.css', NULL, 1, 'theme', 43, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(44, 'Blue / Purple', 'material.blue-purple.min.css', NULL, 1, 'theme', 44, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(45, 'Blue / Red', 'material.blue-red.min.css', NULL, 1, 'theme', 45, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(46, 'Blue / Teal', 'material.blue-teal.min.css', NULL, 1, 'theme', 46, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(47, 'Blue / Yellow', 'material.blue-yellow.min.css', NULL, 1, 'theme', 47, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(48, 'Brown / Amber', 'material.brown-amber.min.css', NULL, 1, 'theme', 48, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(49, 'Brown / Blue', 'material.brown-blue.min.css', NULL, 1, 'theme', 49, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(50, 'Brown / Cyan', 'material.brown-cyan.min.css', NULL, 1, 'theme', 50, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(51, 'Brown / Deep Orange', 'material.brown-deep_orange.min.css', NULL, 1, 'theme', 51, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(52, 'Brown / Deep Purple', 'material.brown-deep_purple.min.css', NULL, 1, 'theme', 52, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(53, 'Brown / Green', 'material.brown-green.min.css', NULL, 1, 'theme', 53, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(54, 'Brown / Indigo', 'material.brown-indigo.min.css', NULL, 1, 'theme', 54, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(55, 'Brown / Light Blue', 'material.brown-light_blue.min.css', NULL, 1, 'theme', 55, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(56, 'Brown / Light Green', 'material.brown-light_green.min.css', NULL, 1, 'theme', 56, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(57, 'Brown / Lime', 'material.brown-lime.min.css', NULL, 1, 'theme', 57, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(58, 'Brown / Orange', 'material.brown-orange.min.css', NULL, 1, 'theme', 58, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(59, 'Brown / Pink', 'material.brown-pink.min.css', NULL, 1, 'theme', 59, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(60, 'Brown / Purple', 'material.brown-purple.min.css', NULL, 1, 'theme', 60, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(61, 'Brown / Red', 'material.brown-red.min.css', NULL, 1, 'theme', 61, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(62, 'Brown / Teal', 'material.brown-teal.min.css', NULL, 1, 'theme', 62, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(63, 'Brown / Yellow', 'material.brown-yellow.min.css', NULL, 1, 'theme', 63, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(64, 'Cyan / Amber', 'material.cyan-amber.min.css', NULL, 1, 'theme', 64, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(65, 'Cyan / Blue', 'material.cyan-blue.min.css', NULL, 1, 'theme', 65, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(66, 'Cyan / Deep Orange', 'material.cyan-deep_orange.min.css', NULL, 1, 'theme', 66, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(67, 'Cyan / Deep Purple', 'material.cyan-deep_purple.min.css', NULL, 1, 'theme', 67, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(68, 'Cyan / Green', 'material.cyan-green.min.css', NULL, 1, 'theme', 68, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(69, 'Cyan / Indigo', 'material.cyan-indigo.min.css', NULL, 1, 'theme', 69, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(70, 'Cyan / Light Blue', 'material.cyan-light_blue.min.css', NULL, 1, 'theme', 70, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(71, 'Cyan / Light Green', 'material.cyan-light_green.min.css', NULL, 1, 'theme', 71, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(72, 'Cyan / Lime', 'material.cyan-lime.min.css', NULL, 1, 'theme', 72, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(73, 'Cyan / Orange', 'material.cyan-orange.min.css', NULL, 1, 'theme', 73, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(74, 'Cyan / Pink', 'material.cyan-pink.min.css', NULL, 1, 'theme', 74, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(75, 'Cyan / Purple', 'material.cyan-purple.min.css', NULL, 1, 'theme', 75, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(76, 'Cyan / Red', 'material.cyan-red.min.css', NULL, 1, 'theme', 76, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(77, 'Cyan / Teal', 'material.cyan-teal.min.css', NULL, 1, 'theme', 77, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(78, 'Cyan / Yellow', 'material.cyan-yellow.min.css', NULL, 1, 'theme', 78, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(79, 'Deep Orange / Amber', 'material.deep_orange-amber.min.css', NULL, 1, 'theme', 79, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(80, 'Deep Orange / Blue', 'material.deep_orange-blue.min.css', NULL, 1, 'theme', 80, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(81, 'Deep Orange / Cyan', 'material.deep_orange-cyan.min.css', NULL, 1, 'theme', 81, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(82, 'Deep Orange / Deep Purple', 'material.deep_orange-deep_purple.min.css', NULL, 1, 'theme', 82, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(83, 'Deep Orange / Green', 'material.deep_orange-green.min.css', NULL, 1, 'theme', 83, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(84, 'Deep Orange / Indigo', 'material.deep_orange-indigo.min.css', NULL, 1, 'theme', 84, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(85, 'Deep Orange / Light Blue', 'material.deep_orange-light_blue.min.css', NULL, 1, 'theme', 85, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(86, 'Deep Orange / Light Green', 'material.deep_orange-light_green.min.css', NULL, 1, 'theme', 86, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(87, 'Deep Orange / Lime', 'material.deep_orange-lime.min.css', NULL, 1, 'theme', 87, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(88, 'Deep Orange / Orange', 'material.deep_orange-orange.min.css', NULL, 1, 'theme', 88, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(89, 'Deep Orange / Pink', 'material.deep_orange-pink.min.css', NULL, 1, 'theme', 89, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(90, 'Deep Orange / Purple', 'material.deep_orange-purple.min.css', NULL, 1, 'theme', 90, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(91, 'Deep Orange / Red', 'material.deep_orange-red.min.css', NULL, 1, 'theme', 91, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(92, 'Deep Orange / Teal', 'material.deep_orange-teal.min.css', NULL, 1, 'theme', 92, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(93, 'Deep Orange / Yellow', 'material.deep_orange-yellow.min.css', NULL, 1, 'theme', 93, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(94, 'Deep Purple / Amber', 'material.deep_purple-amber.min.css', NULL, 1, 'theme', 94, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(95, 'Deep Purple / Blue', 'material.deep_purple-blue.min.css', NULL, 1, 'theme', 95, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(96, 'Deep Purple / Cyan', 'material.deep_purple-cyan.min.css', NULL, 1, 'theme', 96, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(97, 'Deep Purple / Deep Orange', 'material.deep_purple-deep_orange.min.css', NULL, 1, 'theme', 97, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(98, 'Deep Purple / Green', 'material.deep_purple-green.min.css', NULL, 1, 'theme', 98, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(99, 'Yellow / Teal', 'material.yellow-teal.min.css', NULL, 1, 'theme', 99, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(100, 'Yellow / Red', 'material.yellow-red.min.css', NULL, 1, 'theme', 100, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(101, 'Yellow / Orange', 'material.yellow-orange.min.css', NULL, 1, 'theme', 101, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(102, 'Yellow / Pink', 'material.yellow-pink.min.css', NULL, 1, 'theme', 102, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(103, 'Yellow / Purple', 'material.yellow-purple.min.css', NULL, 1, 'theme', 103, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(104, 'Yellow / Lime', 'material.yellow-lime.min.css', NULL, 1, 'theme', 104, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(105, 'Yellow / Light Green', 'material.yellow-light_green.min.css', NULL, 1, 'theme', 105, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(106, 'Yellow / Indigo', 'material.yellow-indigo.min.css', NULL, 1, 'theme', 106, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(107, 'Yellow / Light Blue', 'material.yellow-light_blue.min.css', NULL, 1, 'theme', 107, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(108, 'Yellow / Green', 'material.yellow-green.min.css', NULL, 1, 'theme', 108, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(109, 'Yellow / Deep Purple', 'material.yellow-deep_purple.min.css', NULL, 1, 'theme', 109, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(110, 'Yellow / Deep Orange', 'material.yellow-deep_orange.min.css', NULL, 1, 'theme', 110, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(111, 'Yellow / Cyan', 'material.yellow-cyan.min.css', NULL, 1, 'theme', 111, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(112, 'Yellow / Blue', 'material.yellow-blue.min.css', NULL, 1, 'theme', 112, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(113, 'Yellow / Amber', 'material.yellow-amber.min.css', NULL, 1, 'theme', 113, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(114, 'Teal / Yellow', 'material.teal-yellow.min.css', NULL, 1, 'theme', 114, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(115, 'Teal / Red', 'material.teal-red.min.css', NULL, 1, 'theme', 115, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(116, 'Teal / Purple', 'material.teal-purple.min.css', NULL, 1, 'theme', 116, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(117, 'Teal / Pink', 'material.teal-pink.min.css', NULL, 1, 'theme', 117, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(118, 'Teal / Orange', 'material.teal-orange.min.css', NULL, 1, 'theme', 118, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(119, 'Teal / Lime', 'material.teal-lime.min.css', NULL, 1, 'theme', 119, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(120, 'Teal / Light Green', 'material.teal-light_green.min.css', NULL, 1, 'theme', 120, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(121, 'Teal / Light Blue', 'material.teal-light_blue.min.css', NULL, 1, 'theme', 121, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(122, 'Teal / Indigo', 'material.teal-indigo.min.css', NULL, 1, 'theme', 122, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(123, 'Teal / Green', 'material.teal-green.min.css', NULL, 1, 'theme', 123, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(124, 'Teal / Deep Purple', 'material.teal-deep_purple.min.css', NULL, 1, 'theme', 124, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(125, 'Teal / Deep Orange', 'material.teal-deep_orange.min.css', NULL, 1, 'theme', 125, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(126, 'Teal / Cyan', 'material.teal-cyan.min.css', NULL, 1, 'theme', 126, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(127, 'Teal / Blue', 'material.teal-blue.min.css', NULL, 1, 'theme', 127, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(128, 'Teal / Amber', 'material.teal-amber.min.css', NULL, 1, 'theme', 128, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(129, 'Red / Yellow', 'material.red-yellow.min.css', NULL, 1, 'theme', 129, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(130, 'Red / Teal', 'material.red-teal.min.css', NULL, 1, 'theme', 130, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(131, 'Red / Purple', 'material.red-purple.min.css', NULL, 1, 'theme', 131, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(132, 'Red / Pink', 'material.red-pink.min.css', NULL, 1, 'theme', 132, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(133, 'Red / Orange', 'material.red-orange.min.css', NULL, 1, 'theme', 133, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(134, 'Red / Lime', 'material.red-lime.min.css', NULL, 1, 'theme', 134, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(135, 'Red / Light Green', 'material.red-light_green.min.css', NULL, 1, 'theme', 135, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(136, 'Red / Light Blue', 'material.red-light_blue.min.css', NULL, 1, 'theme', 136, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(137, 'Red / Indigo', 'material.red-indigo.min.css', NULL, 1, 'theme', 137, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(138, 'Red / Green', 'material.red-green.min.css', NULL, 1, 'theme', 138, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(139, 'Red / Deep Purple', 'material.red-deep_purple.min.css', NULL, 1, 'theme', 139, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(140, 'Red / Deep Orange', 'material.red-deep_orange.min.css', NULL, 1, 'theme', 140, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(141, 'Red / Cyan', 'material.red-cyan.min.css', NULL, 1, 'theme', 141, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(142, 'Red / Blue', 'material.red-blue.min.css', NULL, 1, 'theme', 142, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(143, 'Red / Amber', 'material.red-amber.min.css', NULL, 1, 'theme', 143, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(144, 'Purple / Yellow', 'material.purple-yellow.min.css', NULL, 1, 'theme', 144, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(145, 'Purple / Teal', 'material.purple-teal.min.css', NULL, 1, 'theme', 145, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(146, 'Purple / Pink', 'material.purple-pink.min.css', NULL, 1, 'theme', 146, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(147, 'Purple / Orange', 'material.purple-orange.min.css', NULL, 1, 'theme', 147, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(148, 'Purple / Lime', 'material.purple-lime.min.css', NULL, 1, 'theme', 148, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(149, 'Purple / Light Green', 'material.purple-light_green.min.css', NULL, 1, 'theme', 149, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(150, 'Purple / Light Blue', 'material.purple-light_blue.min.css', NULL, 1, 'theme', 150, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(151, 'Purple / Indigo', 'material.purple-indigo.min.css', NULL, 1, 'theme', 151, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(152, 'Purple / Green', 'material.purple-green.min.css', NULL, 1, 'theme', 152, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(153, 'Purple / Deep Purple', 'material.purple-deep_purple.min.css', NULL, 1, 'theme', 153, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(154, 'Purple / Deep Orange', 'material.purple-deep_orange.min.css', NULL, 1, 'theme', 154, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(155, 'Purple / Cyan', 'material.purple-cyan.min.css', NULL, 1, 'theme', 155, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(156, 'Purple / Blue', 'material.purple-blue.min.css', NULL, 1, 'theme', 156, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(157, 'Purple / Amber', 'material.purple-amber.min.css', NULL, 1, 'theme', 157, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(158, 'Pink / Yellow', 'material.pink-yellow.min.css', NULL, 1, 'theme', 158, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(159, 'Pink / Teal', 'material.pink-teal.min.css', NULL, 1, 'theme', 159, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(160, 'Pink / Red', 'material.pink-red.min.css', NULL, 1, 'theme', 160, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(161, 'Pink / Purple', 'material.pink-purple.min.css', NULL, 1, 'theme', 161, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(162, 'Pink / Orange', 'material.pink-orange.min.css', NULL, 1, 'theme', 162, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(163, 'Pink / Lime', 'material.pink-lime.min.css', NULL, 1, 'theme', 163, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(164, 'Pink / Light Green', 'material.pink-light_green.min.css', NULL, 1, 'theme', 164, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(165, 'Pink / Light Blue', 'material.pink-light_blue.min.css', NULL, 1, 'theme', 165, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(166, 'Pink / Indigo', 'material.pink-indigo.min.css', NULL, 1, 'theme', 166, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(167, 'Pink / Green', 'material.pink-green.min.css', NULL, 1, 'theme', 167, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(168, 'Pink / Deep Purple', 'material.pink-deep_purple.min.css', NULL, 1, 'theme', 168, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(169, 'Pink / Deep Orange', 'material.pink-deep_orange.min.css', NULL, 1, 'theme', 169, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(170, 'Pink / Cyan', 'material.pink-cyan.min.css', NULL, 1, 'theme', 170, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(171, 'Pink / Blue', 'material.pink-blue.min.css', NULL, 1, 'theme', 171, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(172, 'Pink / Amber', 'material.pink-amber.min.css', NULL, 1, 'theme', 172, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(173, 'Orange / Yellow', 'material.orange-yellow.min.css', NULL, 1, 'theme', 173, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(174, 'Orange / Teal', 'material.orange-teal.min.css', NULL, 1, 'theme', 174, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(175, 'Orange / Red', 'material.orange-red.min.css', NULL, 1, 'theme', 175, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(176, 'Orange / Purple', 'material.orange-purple.min.css', NULL, 1, 'theme', 176, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(177, 'Orange / Pink', 'material.orange-pink.min.css', NULL, 1, 'theme', 177, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(178, 'Orange / Lime', 'material.orange-lime.min.css', NULL, 1, 'theme', 178, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(179, 'Orange / Light Green', 'material.orange-light_green.min.css', NULL, 1, 'theme', 179, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(180, 'Orange / Light Blue', 'material.orange-light_blue.min.css', NULL, 1, 'theme', 180, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(181, 'Orange / Indigo', 'material.orange-indigo.min.css', NULL, 1, 'theme', 181, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(182, 'Orange / Green', 'material.orange-green.min.css', NULL, 1, 'theme', 182, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(183, 'Orange / Deep Purple', 'material.orange-deep_purple.min.css', NULL, 1, 'theme', 183, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(184, 'Orange / Deep Orange', 'material.orange-deep_orange.min.css', NULL, 1, 'theme', 184, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(185, 'Orange / Cyan', 'material.orange-cyan.min.css', NULL, 1, 'theme', 185, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(186, 'Orange / Amber', 'material.orange-amber.min.css', NULL, 1, 'theme', 186, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(187, 'Orange / Blue', 'material.orange-blue.min.css', NULL, 1, 'theme', 187, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(188, 'Lime / Yellow', 'material.lime-yellow.min.css', NULL, 1, 'theme', 188, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(189, 'Lime / Teal', 'material.lime-teal.min.css', NULL, 1, 'theme', 189, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(190, 'Lime / Red', 'material.lime-red.min.css', NULL, 1, 'theme', 190, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(191, 'Lime / Purple', 'material.lime-purple.min.css', NULL, 1, 'theme', 191, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(192, 'Lime / Pink', 'material.lime-pink.min.css', NULL, 1, 'theme', 192, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(193, 'Lime / Orange', 'material.lime-orange.min.css', NULL, 1, 'theme', 193, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(194, 'Lime / Light Green', 'material.lime-light_green.min.css', NULL, 1, 'theme', 194, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(195, 'Lime / Light Blue', 'material.lime-light_blue.min.css', NULL, 1, 'theme', 195, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(196, 'Lime / Indigo', 'material.lime-indigo.min.css', NULL, 1, 'theme', 196, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(197, 'Lime / Green', 'material.lime-green.min.css', NULL, 1, 'theme', 197, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(198, 'Lime / Deep Orange', 'material.lime-deep_orange.min.css', NULL, 1, 'theme', 198, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(199, 'Lime / Deep Purple', 'material.lime-deep_purple.min.css', NULL, 1, 'theme', 199, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(200, 'Lime / Cyan', 'material.lime-cyan.min.css', NULL, 1, 'theme', 200, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(201, 'Lime / Blue', 'material.lime-blue.min.css', NULL, 1, 'theme', 201, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(202, 'Lime / Amber', 'material.lime-amber.min.css', NULL, 1, 'theme', 202, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(203, 'Light Green / Yellow', 'material.light_green-yellow.min.css', NULL, 1, 'theme', 203, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(204, 'Light Green / Teal', 'material.light_green-teal.min.css', NULL, 1, 'theme', 204, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(205, 'Light Green / Red', 'material.light_green-red.min.css', NULL, 1, 'theme', 205, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(206, 'Light Green / Purple', 'material.light_green-purple.min.css', NULL, 1, 'theme', 206, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(207, 'Light Green / Pink', 'material.light_green-pink.min.css', NULL, 1, 'theme', 207, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(208, 'Light Green / Orange', 'material.light_green-orange.min.css', NULL, 1, 'theme', 208, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(209, 'Light Green / Lime', 'material.light_green-lime.min.css', NULL, 1, 'theme', 209, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(210, 'Light Green / Light Blue', 'material.light_green-light_blue.min.css', NULL, 1, 'theme', 210, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(211, 'Light Green / Indigo', 'material.light_green-indigo.min.css', NULL, 1, 'theme', 211, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(212, 'Light Green / Green', 'material.light_green-green.min.css', NULL, 1, 'theme', 212, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(213, 'Light Green / Deep Purple', 'material.light_green-deep_purple.min.css', NULL, 1, 'theme', 213, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(214, 'Light Green / Deep Orange', 'material.light_green-deep_orange.min.css', NULL, 1, 'theme', 214, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(215, 'Light Green / Cyan', 'material.light_green-cyan.min.css', NULL, 1, 'theme', 215, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(216, 'Light Green / Blue', 'material.light_green-blue.min.css', NULL, 1, 'theme', 216, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(217, 'Light Green / Amber', 'material.light_green-amber.min.css', NULL, 1, 'theme', 217, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(218, 'Light Blue / Yellow', 'material.light_blue-yellow.min.css', NULL, 1, 'theme', 218, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(219, 'Light Blue / Teal', 'material.light_blue-teal.min.css', NULL, 1, 'theme', 219, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(220, 'Light Blue / Red', 'material.light_blue-red.min.css', NULL, 1, 'theme', 220, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(221, 'Light Blue / Purple', 'material.light_blue-purple.min.css', NULL, 1, 'theme', 221, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(222, 'Light Blue / Pink', 'material.light_blue-pink.min.css', NULL, 1, 'theme', 222, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(223, 'Light Blue / Orange', 'material.light_blue-orange.min.css', NULL, 1, 'theme', 223, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(224, 'Light Blue / Lime', 'material.light_blue-lime.min.css', NULL, 1, 'theme', 224, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(225, 'Light Blue / Light Green', 'material.light_blue-light_green.min.css', NULL, 1, 'theme', 225, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(226, 'Light Blue / Indigo', 'material.light_blue-indigo.min.css', NULL, 1, 'theme', 226, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(227, 'Light Blue / Green', 'material.light_blue-green.min.css', NULL, 1, 'theme', 227, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(228, 'Light Blue / Deep Purple', 'material.light_blue-deep_purple.min.css', NULL, 1, 'theme', 228, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(229, 'Light Blue / Deep Orange', 'material.light_blue-deep_orange.min.css', NULL, 1, 'theme', 229, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(230, 'Light Blue / Cyan', 'material.light_blue-cyan.min.css', NULL, 1, 'theme', 230, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(231, 'Light Blue / Blue', 'material.light_blue-blue.min.css', NULL, 1, 'theme', 231, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(232, 'Light Blue / Amber', 'material.light_blue-amber.min.css', NULL, 1, 'theme', 232, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(233, 'Indigo / Yellow', 'material.indigo-yellow.min.css', NULL, 1, 'theme', 233, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(234, 'Indigo / Teal', 'material.indigo-teal.min.css', NULL, 1, 'theme', 234, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(235, 'Indigo / Red', 'material.indigo-red.min.css', NULL, 1, 'theme', 235, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(236, 'Indigo / Purple', 'material.indigo-purple.min.css', NULL, 1, 'theme', 236, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(237, 'Indigo / Pink', 'material.indigo-pink.min.css', NULL, 1, 'theme', 237, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(238, 'Indigo / Orange', 'material.indigo-orange.min.css', NULL, 1, 'theme', 238, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(239, 'Indigo / Lime', 'material.indigo-lime.min.css', NULL, 1, 'theme', 239, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(240, 'Indigo / Light Green', 'material.indigo-light_green.min.css', NULL, 1, 'theme', 240, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(241, 'Indigo / Light Blue', 'material.indigo-light_blue.min.css', NULL, 1, 'theme', 241, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(242, 'Indigo / Green', 'material.indigo-green.min.css', NULL, 1, 'theme', 242, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(243, 'Indigo / Deep Purple', 'material.indigo-deep_purple.min.css', NULL, 1, 'theme', 243, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(244, 'Indigo / Deep Orange', 'material.indigo-deep_orange.min.css', NULL, 1, 'theme', 244, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(245, 'Indigo / Cyan', 'material.indigo-cyan.min.css', NULL, 1, 'theme', 245, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(246, 'Indigo / Blue', 'material.indigo-blue.min.css', NULL, 1, 'theme', 246, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(247, 'Indigo / Amber', 'material.indigo-amber.min.css', NULL, 1, 'theme', 247, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(248, 'Grey / Yellow', 'material.grey-yellow.min.css', NULL, 1, 'theme', 248, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(249, 'Grey / Teal', 'material.grey-teal.min.css', NULL, 1, 'theme', 249, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(250, 'Grey / Red', 'material.grey-red.min.css', NULL, 1, 'theme', 250, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(251, 'Grey / Purple', 'material.grey-purple.min.css', NULL, 1, 'theme', 251, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(252, 'Grey / Pink', 'material.grey-pink.min.css', NULL, 1, 'theme', 252, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(253, 'Grey / Orange', 'material.grey-orange.min.css', NULL, 1, 'theme', 253, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(254, 'Grey / Lime', 'material.grey-lime.min.css', NULL, 1, 'theme', 254, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(255, 'Grey / Light Green', 'material.grey-light_green.min.css', NULL, 1, 'theme', 255, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(256, 'Grey / Light Blue', 'material.grey-light_blue.min.css', NULL, 1, 'theme', 256, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(257, 'Grey / Indigo', 'material.grey-indigo.min.css', NULL, 1, 'theme', 257, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(258, 'Grey / Green', 'material.grey-green.min.css', NULL, 1, 'theme', 258, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(259, 'Grey / Deep Purple', 'material.grey-deep_purple.min.css', NULL, 1, 'theme', 259, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(260, 'Grey / Deep Orange', 'material.grey-deep_orange.min.css', NULL, 1, 'theme', 260, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(261, 'Grey / Cyan', 'material.grey-cyan.min.css', NULL, 1, 'theme', 261, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(262, 'Grey / Blue', 'material.grey-blue.min.css', NULL, 1, 'theme', 262, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(263, 'Grey / Amber', 'material.grey-amber.min.css', NULL, 1, 'theme', 263, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(264, 'Green / Yellow', 'material.green-yellow.min.css', NULL, 1, 'theme', 264, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(265, 'Green / Teal', 'material.green-teal.min.css', NULL, 1, 'theme', 265, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(266, 'Green / Red', 'material.green-red.min.css', NULL, 1, 'theme', 266, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(267, 'Green / Purple', 'material.green-purple.min.css', NULL, 1, 'theme', 267, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(268, 'Green / Pink', 'material.green-pink.min.css', NULL, 1, 'theme', 268, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(269, 'Green / Orange', 'material.green-orange.min.css', NULL, 1, 'theme', 269, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(270, 'Green / Lime', 'material.green-lime.min.css', NULL, 1, 'theme', 270, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(271, 'Green / Light Green', 'material.green-light_green.min.css', NULL, 1, 'theme', 271, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(272, 'Green / Light Blue', 'material.green-light_blue.min.css', NULL, 1, 'theme', 272, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(273, 'Green / Indigo', 'material.green-indigo.min.css', NULL, 1, 'theme', 273, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(274, 'Green / Deep Purple', 'material.green-deep_purple.min.css', NULL, 1, 'theme', 274, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(275, 'Green / Deep Orange', 'material.green-deep_orange.min.css', NULL, 1, 'theme', 275, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(276, 'Green / Cyan', 'material.green-cyan.min.css', NULL, 1, 'theme', 276, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(277, 'Green / Blue', 'material.green-blue.min.css', NULL, 1, 'theme', 277, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(278, 'Green / Amber', 'material.green-amber.min.css', NULL, 1, 'theme', 278, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(279, 'Deep Purple / Yellow', 'material.deep_purple-yellow.min.css', NULL, 1, 'theme', 279, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(280, 'Deep Purple / Teal', 'material.deep_purple-teal.min.css', NULL, 1, 'theme', 280, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(281, 'Deep Purple / Red', 'material.deep_purple-red.min.css', NULL, 1, 'theme', 281, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(282, 'Deep Purple / Purple', 'material.deep_purple-purple.min.css', NULL, 1, 'theme', 282, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(283, 'Deep Purple / Pink', 'material.deep_purple-pink.min.css', NULL, 1, 'theme', 283, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(284, 'Deep Purple / Orange', 'material.deep_purple-orange.min.css', NULL, 1, 'theme', 284, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(285, 'Deep Purple / Lime', 'material.deep_purple-lime.min.css', NULL, 1, 'theme', 285, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(286, 'Deep Purple / Light Green', 'material.deep_purple-light_green.min.css', NULL, 1, 'theme', 286, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(287, 'Deep Purple / Light Blue', 'material.deep_purple-light_blue.min.css', NULL, 1, 'theme', 287, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL),
(288, 'Deep Purple / Indigo', 'material.deep_purple-indigo.min.css', NULL, 1, 'theme', 288, '2019-03-05 13:05:54', '2019-03-05 13:05:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_user_id_index` (`user_id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_keys_key_unique` (`key`),
  ADD KEY `api_keys_user_id_index` (`user_id`);

--
-- Indexes for table `api_roles`
--
ALTER TABLE `api_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_roles_slug_unique` (`slug`);

--
-- Indexes for table `api_role_api_key`
--
ALTER TABLE `api_role_api_key`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_role_api_key_api_role_id_index` (`api_role_id`),
  ADD KEY `api_role_api_key_api_key_id_index` (`api_key_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_theme_id_foreign` (`theme_id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_index` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `themes_name_unique` (`name`),
  ADD UNIQUE KEY `themes_link_unique` (`link`),
  ADD KEY `themes_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`),
  ADD KEY `themes_id_index` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `api_roles`
--
ALTER TABLE `api_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_role_api_key`
--
ALTER TABLE `api_role_api_key`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `activations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD CONSTRAINT `api_keys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `api_role_api_key`
--
ALTER TABLE `api_role_api_key`
  ADD CONSTRAINT `api_role_api_key_api_key_id_foreign` FOREIGN KEY (`api_key_id`) REFERENCES `api_keys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `api_role_api_key_api_role_id_foreign` FOREIGN KEY (`api_role_id`) REFERENCES `api_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`),
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `site_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
