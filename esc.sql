-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 10:58 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(18, 1, 43, '2023-05-29 21:39:07', '2023-05-29 21:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(5, 44, 2, 'hi', '2023-05-25 21:14:00', '2023-05-25 21:14:00'),
(6, 43, 2, 'hey', '2023-05-25 21:22:56', '2023-05-25 21:22:56'),
(7, 44, 2, 'yoo', '2023-05-25 21:23:14', '2023-05-25 21:23:14'),
(8, 43, 1, 'hii', '2023-05-25 21:39:51', '2023-05-25 21:39:51'),
(9, 44, 2, 'hey', '2023-05-25 21:40:58', '2023-05-25 21:40:58'),
(10, 44, 2, 'haha', '2023-05-25 21:41:50', '2023-05-25 21:41:50'),
(11, 44, 2, 'ay', '2023-05-25 21:42:32', '2023-05-25 21:42:32'),
(12, 44, 1, 'boo', '2023-05-25 21:43:27', '2023-05-25 21:43:27'),
(13, 43, 1, 'hi', '2023-05-27 20:39:43', '2023-05-27 20:39:43'),
(14, 44, 2, 'yooooo', '2023-05-27 20:49:50', '2023-05-27 20:49:50'),
(15, 44, 2, 'slay', '2023-05-27 20:54:02', '2023-05-27 20:54:02'),
(16, 44, 2, 'hey', '2023-05-27 21:11:25', '2023-05-27 21:11:25'),
(17, 44, 2, 'yo', '2023-05-27 21:13:43', '2023-05-27 21:13:43'),
(18, 44, 2, 'test', '2023-05-27 21:14:59', '2023-05-27 21:14:59'),
(30, 44, 1, 'xds', '2023-05-29 11:05:36', '2023-05-29 11:05:36'),
(31, 44, 1, 'jjj', '2023-05-29 11:09:52', '2023-05-29 11:09:52'),
(35, 43, 21, 'hi', '2023-05-31 18:08:02', '2023-05-31 18:08:02'),
(36, 51, 1, 'hey, here are a few useful links:\r\nhttps://www.theodinproject.com/paths\r\nhttps://www.freecodecamp.org/learn/\r\nhttps://www.learncpp.com/', '2023-05-31 18:09:37', '2023-05-31 18:09:37'),
(37, 52, 1, 'They start on the 12th of June', '2023-05-31 18:15:31', '2023-05-31 18:15:31');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `created_at`, `updated_at`, `subject`, `message`) VALUES
(5, '2023-05-31 18:17:33', '2023-05-31 18:17:33', 'Messages feature', 'Would really want messages implemented in the next update!');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `followed_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `followed_id`, `created_at`, `updated_at`) VALUES
(6, 2, 1, NULL, NULL),
(7, 2, 1, NULL, NULL),
(8, 2, 1, NULL, NULL),
(9, 1, 2, NULL, NULL),
(11, 21, 1, NULL, NULL),
(12, 1, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_joined` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `name`, `description`, `created_at`, `updated_at`, `users_joined`) VALUES
(6, 'Civil Engineering', 'Welcome to the Civil Engineering Forum, a platform dedicated to civil engineers and enthusiasts. This forum provides a space for professionals and aspiring civil engineers to engage in discussions, share knowledge, and stay updated on the latest developments in the field.', '2023-05-16 15:16:51', '2023-05-16 15:28:14', 0),
(7, 'Computer Engineering', 'Welcome to the Computer Engineering Forum, a dedicated platform for computer engineering students to discuss and exchange knowledge about the dynamic field of computer engineering. Engage in conversations about hardware, software, networking, algorithms, programming languages, emerging technologies, career guidance, and more.', '2023-05-16 15:26:41', '2023-05-16 15:37:49', 0),
(8, 'Architecture', 'Welcome to the Architecture Forum. Whether you\'re a student, aspiring architect, or professional in the industry, this forum provides a space to exchange ideas, seek advice, share experiences, and explore various topics concerning architecture degrees', '2023-05-16 15:37:32', '2023-05-16 15:37:40', 0),
(9, 'Electronics and Digital Communication Engineering', 'Welcome to the Electronics and Digital Communication Engineering Forum, a platform dedicated to discussions and knowledge-sharing related to the field of electronics and digital communication engineering. It serves as a community hub for engineers, students, researchers, and enthusiasts to exchange ideas, seek assistance, and explore the latest advancements in electronic circuits.', '2023-05-16 15:38:59', '2023-05-16 15:38:59', 0),
(10, 'Software Engineering', 'Welcome to the Software Engineering Forum. It serves as a platform for software engineers, developers, and enthusiasts to exchange ideas, share knowledge, and engage in discussions related to software development methodologies, programming languages, best practices, software architecture, testing and quality assurance, project management, and other relevant topics.', '2023-05-16 15:43:05', '2023-05-16 15:43:05', 0),
(11, 'Economics', 'Welcome to the Economics Forum. Explore and engage with a community of individuals interested in the study of how societies allocate resources, make decisions, and create wealth. From macroeconomics to microeconomics, monetary policies to market dynamics, this forum provides a platform to share insights, ask questions, and exchange ideas on various economic topics.', '2023-05-16 15:45:32', '2023-05-16 15:45:32', 0),
(12, 'Business Administration', 'Welcome to the Business Administration Forum, a platform dedicated to discussing various aspects of managing and operating businesses. From strategic planning and organizational management to marketing strategies and financial analysis, this forum provides a platform for professionals and enthusiasts to share insights, seek advice, and engage in discussions related to the field of business administration.', '2023-05-16 15:58:32', '2023-05-16 15:58:32', 0),
(13, 'Business Informatics', 'Welcome to the Business Informatics Forum, a platform dedicated to discussing the intersection of business and technology. Explore the latest trends, strategies, and tools in the field of business informatics, where business processes, information systems, and technology converge. Engage with professionals and enthusiasts to exchange insights, ask questions, and share knowledge about leveraging technology to drive innovation, efficiency, and success in the business world.', '2023-05-16 15:59:24', '2023-05-16 15:59:24', 0),
(14, 'Banking and Finance', 'Welcome to the Banking and Finance Forum, a platform to discuss and explore various topics related to banking, financial institutions, investment strategies, personal finance management, and more.', '2023-05-16 16:01:19', '2023-05-16 16:01:19', 0),
(15, 'International Marketing and Logistics Management', 'Welcome to the nternational Marketing and Logistics Management Forum, a platform dedicated to discussing and sharing insights on various aspects of global marketing strategies and efficient logistics management.', '2023-05-16 16:02:24', '2023-05-16 16:02:24', 0),
(16, 'Political Science and International Relations', 'Welcome to the Political Science and International Relations Forum, a platform dedicated to the discussion and analysis of political systems, international relations, and global affairs.', '2023-05-16 16:03:48', '2023-05-16 16:03:48', 0),
(17, 'Law', 'Welcome to the Law Forum, a platform for discussing legal topics, providing legal advice, and engaging in discussions related to laws, regulations, and legal systems.', '2023-05-16 16:04:43', '2023-05-16 16:04:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_user`
--

CREATE TABLE `forum_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `forum_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_user`
--

INSERT INTO `forum_user` (`id`, `user_id`, `forum_id`, `created_at`, `updated_at`) VALUES
(21, 2, 11, '2023-05-27 23:37:14', '2023-05-27 23:37:14'),
(24, 1, 11, '2023-05-28 13:12:25', '2023-05-28 13:12:25'),
(25, 1, 13, '2023-05-28 19:22:39', '2023-05-28 19:22:39'),
(26, 2, 13, '2023-05-28 21:43:07', '2023-05-28 21:43:07'),
(28, 21, 7, '2023-05-31 17:57:11', '2023-05-31 17:57:11'),
(29, 1, 7, '2023-05-31 18:18:00', '2023-05-31 18:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `created_at`, `updated_at`, `post_id`, `user_id`) VALUES
(34, '2023-05-25 21:39:44', '2023-05-25 21:39:44', 43, 1),
(35, '2023-05-27 20:50:50', '2023-05-27 20:50:50', 44, 2),
(44, '2023-05-29 11:12:35', '2023-05-29 11:12:35', 44, 1),
(48, '2023-05-31 18:07:58', '2023-05-31 18:07:58', 43, 21),
(49, '2023-05-31 18:09:55', '2023-05-31 18:09:55', 51, 1),
(50, '2023-05-31 18:15:32', '2023-05-31 18:15:32', 52, 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2023_05_07_192743_add_fields_to_users_table', 3),
(8, '2023_05_08_154700_update_users_table_set_profile_picture_column', 4),
(9, '2023_05_08_161752_create_posts_table', 5),
(10, '2023_05_08_173513_create_forums_table', 6),
(11, '2023_05_08_174641_create_threads_table', 7),
(12, '2023_05_08_174823_create_replies_table', 7),
(13, '2023_05_08_174953_create_users_joined_table', 7),
(14, '2023_05_08_184808_create_followers_table', 8),
(15, '2023_05_08_192427_create_followings_table', 9),
(16, '2023_05_08_201020_add_fields_to_followers_table', 10),
(17, '2023_05_08_210424_create_forum_user_table', 11),
(18, '2023_05_09_212653_remove_date_column_from_posts_table', 12),
(19, '2023_05_11_202754_create_likes_table', 13),
(20, '2023_05_12_162344_create_storage_models_table', 14),
(21, '2023_05_13_135929_create_permission_tables', 15),
(22, '2023_05_13_185523_add_roles_to_users_table', 16),
(23, '2023_05_14_010710_update_users_table_profile_picture', 17),
(24, '2023_05_17_002857_add_fields_to_posts_table', 18),
(25, '2023_05_17_003042_create_members_table', 18),
(26, '2023_05_17_004758_create_replies_table', 19),
(27, '2023_05_19_204828_create_role_user_table', 20),
(28, '2023_05_21_141435_create_reports_table', 21),
(29, '2023_05_21_192913_create_bookmarks_table', 22),
(30, '2023_05_21_214349_create_comments_table', 23),
(31, '2023_05_25_214948_create_follows_table', 24),
(32, '2023_05_25_223332_create_notifications_table', 25),
(33, '2023_05_29_132839_update_reports_table', 26),
(34, '2023_05_29_205802_create_feedback_table', 27),
(35, '2023_05_30_002841_add_verification_code_to_users_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(1, 'follow', 'App\\Models\\User', 1, '{\"follower_name\":\"Ana\"}', NULL, '2023-05-25 21:27:42', '2023-05-25 21:27:42'),
(2, 'like', 'App\\Models\\User', 1, '{\"liker_name\":\"Ana\",\"post_id\":44}', NULL, '2023-05-25 21:30:29', '2023-05-25 21:30:29'),
(3, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":43}', NULL, '2023-05-25 21:39:44', '2023-05-25 21:39:44'),
(4, 'follow', 'App\\Models\\User', 2, '{\"follower_name\":\"Klaudia Rapaj\"}', NULL, '2023-05-27 20:39:31', '2023-05-27 20:39:31'),
(5, 'like', 'App\\Models\\User', 1, '{\"liked_by\":\"Ana\",\"post_id\":44}', NULL, '2023-05-27 20:50:50', '2023-05-27 20:50:50'),
(6, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":49}', NULL, '2023-05-29 09:25:03', '2023-05-29 09:25:03'),
(7, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":49}', NULL, '2023-05-29 10:45:43', '2023-05-29 10:45:43'),
(8, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":49}', NULL, '2023-05-29 10:47:20', '2023-05-29 10:47:20'),
(9, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":49}', NULL, '2023-05-29 11:13:17', '2023-05-29 11:13:17'),
(10, 'comment', 'App\\Models\\User', 2, '{\"commented_by\":\"Klaudia Rapaj\",\"post_id\":49}', NULL, '2023-05-29 11:13:27', '2023-05-29 11:13:27'),
(11, 'follow', 'App\\Models\\User', 1, '{\"follower_name\":\"Klaudia Rapaj\"}', NULL, '2023-05-30 21:42:26', '2023-05-30 21:42:26'),
(12, 'comment', 'App\\Models\\User', 1, '{\"commented_by\":\"Klaudia Rapaj\",\"post_id\":50}', NULL, '2023-05-30 21:52:40', '2023-05-30 21:52:40'),
(13, 'follow', 'App\\Models\\User', 1, '{\"follower_name\":\"Maria R\"}', NULL, '2023-05-31 18:07:47', '2023-05-31 18:07:47'),
(14, 'like', 'App\\Models\\User', 2, '{\"liked_by\":\"Maria R\",\"post_id\":43}', NULL, '2023-05-31 18:07:58', '2023-05-31 18:07:58'),
(15, 'comment', 'App\\Models\\User', 2, '{\"commented_by\":\"Maria R\",\"post_id\":43}', NULL, '2023-05-31 18:08:02', '2023-05-31 18:08:02'),
(16, 'follow', 'App\\Models\\User', 21, '{\"follower_name\":\"Klaudia Rapaj\"}', NULL, '2023-05-31 18:08:28', '2023-05-31 18:08:28'),
(17, 'comment', 'App\\Models\\User', 21, '{\"commented_by\":\"Klaudia Rapaj\",\"post_id\":51}', NULL, '2023-05-31 18:09:37', '2023-05-31 18:09:37'),
(18, 'like', 'App\\Models\\User', 21, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":51}', NULL, '2023-05-31 18:09:55', '2023-05-31 18:09:55'),
(19, 'comment', 'App\\Models\\User', 21, '{\"commented_by\":\"Klaudia Rapaj\",\"post_id\":52}', NULL, '2023-05-31 18:15:31', '2023-05-31 18:15:31'),
(20, 'like', 'App\\Models\\User', 21, '{\"liked_by\":\"Klaudia Rapaj\",\"post_id\":52}', NULL, '2023-05-31 18:15:32', '2023-05-31 18:15:32');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('krapaj20@epoka.edu.al', '$2y$10$oWLnNAwrEcnMyZQ8uTBeyuDhnz5jAwq0QLsw1a3P4Tj38mnG5Jbci', '2023-05-22 11:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `forum_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `forum_id`) VALUES
(3, 1, 'hi', 'hiii', '2023-05-09 19:54:13', '2023-05-09 19:54:13', NULL),
(43, 2, 'first post', 'hello', '2023-05-21 15:36:20', '2023-05-21 15:36:20', NULL),
(44, 1, 'yoo', 'haha', '2023-05-25 20:27:21', '2023-05-25 20:27:21', NULL),
(51, 21, 'Useful links to learn C++', 'Hello, does anyone know any websites that teach C++? Would really appreciate it if you could drop them below!', '2023-05-31 17:58:17', '2023-05-31 17:58:17', 7),
(52, 21, 'Finals Week', 'When do the finals start?', '2023-05-31 18:04:14', '2023-05-31 18:04:14', 7),
(53, 1, 'Lost watch', 'I lost my watch at the cafeteria, if anyone has seen it please let me know!', '2023-05-31 18:13:13', '2023-05-31 18:13:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(6, 1, 43, '2023-05-29 18:47:59', '2023-05-29 18:47:59'),
(7, 1, 43, '2023-05-29 19:40:30', '2023-05-29 19:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `interests` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `department`, `birthdate`, `interests`, `bio`, `major`, `phonenumber`, `profile_picture`, `privacy`, `role`) VALUES
(1, 'Klaudia Rapaj', 'klaudiarapaj@yahoo.com', '2023-05-30 22:13:48', '$2y$10$1MBrp7WVn6/xPfncADw/keXlp9DXdmork4ZHAZ85K6ZLV7jM43KPq', 'UwW9rvj6BXUg7QLoPShwJetMCypTktNjaitkz6Xl1ArnsIY7e6SeE8QTIZ7A', '2023-05-07 16:50:41', '2023-05-31 18:13:44', 'Business Administration', '2023-05-03', 'music', NULL, 'BINF', NULL, 'papers.co-aq83-nature-anime-art-sea-art-1-wallpaper.jpg', 'public', 'admin'),
(2, 'Ana', 'ana20@epoka.edu.al', NULL, '$2y$10$g1hbwBT3AmAqMan0PPYpV.2H8K1DbHza2.QfAHK4m8KvzLgYqo.6C', NULL, '2023-05-13 22:44:10', '2023-05-26 21:56:40', 'binf', NULL, NULL, NULL, NULL, NULL, '20230511_131414.jpg', 'public', 'user'),
(21, 'Maria R', 'krapaj20@epoka.edu.al', '2023-05-30 21:31:24', '$2y$10$NSE2yjkd7mBxBYwIovXe8evw5gGYWI.R6XT.tDdasJsRAXvOqt8Na', NULL, '2023-05-30 21:25:50', '2023-05-31 18:05:21', 'Computer Engineering', NULL, NULL, NULL, NULL, NULL, 'WhatsApp Image 2023-02-12 at 2.59.13 PM.jpeg', 'public', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_user_id_foreign` (`user_id`),
  ADD KEY `bookmarks_post_id_foreign` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follows_follower_id_foreign` (`follower_id`),
  ADD KEY `follows_followed_id_foreign` (`followed_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_user`
--
ALTER TABLE `forum_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_user_user_id_foreign` (`user_id`),
  ADD KEY `forum_user_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_post_id_foreign` (`post_id`),
  ADD KEY `replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forum_user`
--
ALTER TABLE `forum_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_followed_id_foreign` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_user`
--
ALTER TABLE `forum_user`
  ADD CONSTRAINT `forum_user_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
