-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2026 at 06:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucky_satta`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `record_type` varchar(255) DEFAULT NULL,
  `record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `record_type`, `record_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'result.created', 'results', 'App\\Models\\GameResult', 259, NULL, '{\"game_id\":2,\"result_date\":\"2026-08-30T00:00:00.000000Z\",\"open_panna\":\"e\",\"jodi\":\"ed\",\"close_panna\":\"dd\",\"result\":\"dd\",\"source\":\"manual\",\"status\":\"published\",\"created_by\":1,\"updated_by\":1,\"updated_at\":\"2026-08-30T10:51:26.000000Z\",\"created_at\":\"2026-08-30T10:51:26.000000Z\",\"id\":259}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-30 05:21:26', '2026-08-30 05:21:26'),
(2, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 260, NULL, '{\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"75\",\"close_panna\":null,\"result\":\"75\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":260}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(3, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 261, NULL, '{\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"47\",\"close_panna\":null,\"result\":\"47\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":261}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(4, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 262, NULL, '{\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"63\",\"close_panna\":null,\"result\":\"63\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":262}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(5, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 263, NULL, '{\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"97\",\"close_panna\":null,\"result\":\"97\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":263}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(6, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 264, NULL, '{\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"37\",\"close_panna\":null,\"result\":\"37\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":264}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(7, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 265, NULL, '{\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"07\",\"close_panna\":null,\"result\":\"07\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":265}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(8, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 266, NULL, '{\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"10\",\"close_panna\":null,\"result\":\"10\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":266}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(9, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 267, NULL, '{\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"87\",\"close_panna\":null,\"result\":\"87\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:20.000000Z\",\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"id\":267}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:20', '2026-08-31 03:27:20'),
(10, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 268, NULL, '{\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:21.000000Z\",\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"id\":268}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:21', '2026-08-31 03:27:21'),
(11, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 269, NULL, '{\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-08-31T08:57:21.000000Z\",\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"id\":269}', '127.0.0.1', 'Symfony', '2026-08-31 03:27:21', '2026-08-31 03:27:21'),
(12, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 260, '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"75\",\"close_panna\":null,\"result\":\"75\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(13, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 261, '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"47\",\"close_panna\":null,\"result\":\"47\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(14, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 262, '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"63\",\"close_panna\":null,\"result\":\"63\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(15, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 263, '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"97\",\"close_panna\":null,\"result\":\"97\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(16, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 264, '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"37\",\"close_panna\":null,\"result\":\"37\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(17, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 265, '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"07\",\"close_panna\":null,\"result\":\"07\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(18, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 266, '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"10\",\"close_panna\":null,\"result\":\"10\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(19, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 267, '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"87\",\"close_panna\":null,\"result\":\"87\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T08:57:20.000000Z\"}', '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(20, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 268, '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(21, NULL, 'result.updated', 'results', 'App\\Models\\GameResult', 269, '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '127.0.0.1', 'Symfony', '2026-08-31 13:27:32', '2026-08-31 13:27:32'),
(22, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 260, '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(23, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 261, '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(24, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 262, '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(25, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 263, '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(26, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 264, '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(27, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 265, '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(28, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 266, '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(29, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 267, '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T18:57:32.000000Z\"}', '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(30, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 268, '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(31, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 269, '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T08:57:21.000000Z\"}', '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:43:52', '2026-08-31 13:43:52'),
(32, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 260, '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":260,\"game_id\":2,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(33, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 261, '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":261,\"game_id\":3,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(34, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 262, '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":262,\"game_id\":5,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(35, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 263, '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":263,\"game_id\":6,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(36, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 264, '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":264,\"game_id\":7,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(37, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 265, '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":265,\"game_id\":8,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(38, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 266, '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":266,\"game_id\":9,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(39, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 267, '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":267,\"game_id\":10,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:20.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(40, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 268, '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":268,\"game_id\":11,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(41, 1, 'result.updated', 'results', 'App\\Models\\GameResult', 269, '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '{\"id\":269,\"game_id\":12,\"result_date\":\"2026-08-31T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":1,\"created_at\":\"2026-08-31T08:57:21.000000Z\",\"updated_at\":\"2026-08-31T19:13:52.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-31 13:44:20', '2026-08-31 13:44:20'),
(42, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 270, NULL, '{\"game_id\":2,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"22\",\"close_panna\":null,\"result\":\"22\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":270}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(43, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 271, NULL, '{\"game_id\":3,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"42\",\"close_panna\":null,\"result\":\"42\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":271}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(44, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 272, NULL, '{\"game_id\":5,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"14\",\"close_panna\":null,\"result\":\"14\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":272}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(45, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 273, NULL, '{\"game_id\":6,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"81\",\"close_panna\":null,\"result\":\"81\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":273}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(46, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 274, NULL, '{\"game_id\":7,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"28\",\"close_panna\":null,\"result\":\"28\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":274}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(47, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 275, NULL, '{\"game_id\":8,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"41\",\"close_panna\":null,\"result\":\"41\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":275}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(48, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 276, NULL, '{\"game_id\":9,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"26\",\"close_panna\":null,\"result\":\"26\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":276}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(49, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 277, NULL, '{\"game_id\":10,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"11\",\"close_panna\":null,\"result\":\"11\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":277}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(50, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 278, NULL, '{\"game_id\":11,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"01\",\"close_panna\":null,\"result\":\"01\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":278}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(51, NULL, 'result.created', 'results', 'App\\Models\\GameResult', 279, NULL, '{\"game_id\":12,\"result_date\":\"2026-09-01T00:00:00.000000Z\",\"open_panna\":null,\"jodi\":\"21\",\"close_panna\":null,\"result\":\"21\",\"source\":\"scraper\",\"status\":\"published\",\"created_by\":null,\"updated_by\":null,\"updated_at\":\"2026-09-01T06:10:56.000000Z\",\"created_at\":\"2026-09-01T06:10:56.000000Z\",\"id\":279}', '127.0.0.1', 'Symfony', '2026-09-01 00:40:56', '2026-09-01 00:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cover_text` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('lucky-satta-admin-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:56:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"dashboard.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"results.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:14:\"results.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:14:\"results.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"results.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"games.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"games.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"games.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"games.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"cities.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"cities.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"cities.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"cities.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"roles.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:16:\"permissions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:18:\"permissions.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:18:\"permissions.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:10:\"blogs.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:12:\"blogs.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"blogs.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"blogs.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"blogs.publish\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:9:\"faqs.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:11:\"faqs.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:11:\"faqs.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:11:\"faqs.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:8:\"seo.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:10:\"seo.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:10:\"seo.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:10:\"seo.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"settings.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"scraper.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:11:\"scraper.run\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:18:\"activity-logs.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:18:\"permissions.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:11:\"charts.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:13:\"charts.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:13:\"charts.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:13:\"charts.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:14:\"scraper.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:14:\"scraper.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:14:\"scraper.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:13:\"khaiwals.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:15:\"khaiwals.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:15:\"khaiwals.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:15:\"khaiwals.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:11:\"social.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:13:\"social.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"Reader\";s:1:\"c\";s:3:\"web\";}}}', 1788448481);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_entries`
--

CREATE TABLE `chart_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chart_week_id` bigint(20) UNSIGNED NOT NULL,
  `result_date` date NOT NULL,
  `day_of_week` tinyint(3) UNSIGNED NOT NULL,
  `open_panna` varchar(10) DEFAULT NULL,
  `jodi` varchar(10) DEFAULT NULL,
  `close_panna` varchar(10) DEFAULT NULL,
  `result` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_entries`
--

INSERT INTO `chart_entries` (`id`, `chart_week_id`, `result_date`, `day_of_week`, `open_panna`, `jodi`, `close_panna`, `result`, `created_at`, `updated_at`) VALUES
(36, 6, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(37, 6, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(38, 6, '0026-07-29', 3, NULL, '54', NULL, '54', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(39, 6, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(40, 6, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(41, 6, '0026-08-01', 6, NULL, '71', NULL, '71', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(42, 6, '0026-08-02', 0, NULL, '09', NULL, '09', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(43, 7, '0026-08-03', 1, NULL, '53', NULL, '53', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(44, 7, '0026-08-04', 2, NULL, '12', NULL, '12', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(45, 7, '0026-08-05', 3, NULL, '47', NULL, '47', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(46, 7, '0026-08-06', 4, NULL, '61', NULL, '61', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(47, 7, '0026-08-07', 5, NULL, '52', NULL, '52', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(48, 7, '0026-08-08', 6, NULL, '91', NULL, '91', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(49, 7, '0026-08-09', 0, NULL, '89', NULL, '89', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(50, 8, '0026-08-10', 1, NULL, '85', NULL, '85', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(51, 8, '0026-08-11', 2, NULL, '78', NULL, '78', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(52, 8, '0026-08-12', 3, NULL, '94', NULL, '94', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(53, 8, '0026-08-13', 4, NULL, '40', NULL, '40', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(54, 8, '0026-08-14', 5, NULL, '69', NULL, '69', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(55, 8, '0026-08-15', 6, NULL, '10', NULL, '10', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(56, 8, '0026-08-16', 0, NULL, '34', NULL, '34', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(57, 9, '0026-08-17', 1, NULL, '01', NULL, '01', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(58, 9, '0026-08-18', 2, NULL, '01', NULL, '01', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(59, 9, '0026-08-19', 3, NULL, '05', NULL, '05', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(60, 9, '0026-08-20', 4, NULL, '36', NULL, '36', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(61, 9, '0026-08-21', 5, NULL, '35', NULL, '35', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(62, 9, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(63, 9, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(64, 10, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(65, 10, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(66, 10, '0026-07-29', 3, NULL, '60', NULL, '60', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(67, 10, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(68, 10, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(69, 10, '0026-08-01', 6, NULL, '57', NULL, '57', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(70, 10, '0026-08-02', 0, NULL, '06', NULL, '06', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(71, 11, '0026-08-03', 1, NULL, '95', NULL, '95', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(72, 11, '0026-08-04', 2, NULL, '12', NULL, '12', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(73, 11, '0026-08-05', 3, NULL, '57', NULL, '57', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(74, 11, '0026-08-06', 4, NULL, '22', NULL, '22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(75, 11, '0026-08-07', 5, NULL, '26', NULL, '26', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(76, 11, '0026-08-08', 6, NULL, '81', NULL, '81', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(77, 11, '0026-08-09', 0, NULL, '63', NULL, '63', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(78, 12, '0026-08-10', 1, NULL, '58', NULL, '58', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(79, 12, '0026-08-11', 2, NULL, '58', NULL, '58', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(80, 12, '0026-08-12', 3, NULL, '75', NULL, '75', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(81, 12, '0026-08-13', 4, NULL, '54', NULL, '54', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(82, 12, '0026-08-14', 5, NULL, '49', NULL, '49', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(83, 12, '0026-08-15', 6, NULL, '58', NULL, '58', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(84, 12, '0026-08-16', 0, NULL, '90', NULL, '90', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(85, 13, '0026-08-17', 1, NULL, '46', NULL, '46', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(86, 13, '0026-08-18', 2, NULL, '22', NULL, '22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(87, 13, '0026-08-19', 3, NULL, '59', NULL, '59', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(88, 13, '0026-08-20', 4, NULL, '91', NULL, '91', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(89, 13, '0026-08-21', 5, NULL, '34', NULL, '34', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(90, 13, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(91, 13, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(92, 14, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(93, 14, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(94, 14, '0026-07-29', 3, NULL, '16', NULL, '16', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(95, 14, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(96, 14, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(97, 14, '0026-08-01', 6, NULL, '92', NULL, '92', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(98, 14, '0026-08-02', 0, NULL, '31', NULL, '31', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(99, 15, '0026-08-03', 1, NULL, '59', NULL, '59', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(100, 15, '0026-08-04', 2, NULL, '27', NULL, '27', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(101, 15, '0026-08-05', 3, NULL, '85', NULL, '85', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(102, 15, '0026-08-06', 4, NULL, '80', NULL, '80', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(103, 15, '0026-08-07', 5, NULL, '35', NULL, '35', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(104, 15, '0026-08-08', 6, NULL, '93', NULL, '93', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(105, 15, '0026-08-09', 0, NULL, '97', NULL, '97', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(106, 16, '0026-08-10', 1, NULL, '57', NULL, '57', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(107, 16, '0026-08-11', 2, NULL, '92', NULL, '92', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(108, 16, '0026-08-12', 3, NULL, '36', NULL, '36', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(109, 16, '0026-08-13', 4, NULL, '61', NULL, '61', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(110, 16, '0026-08-14', 5, NULL, '71', NULL, '71', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(111, 16, '0026-08-15', 6, NULL, '71', NULL, '71', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(112, 16, '0026-08-16', 0, NULL, '59', NULL, '59', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(113, 17, '0026-08-17', 1, NULL, '15', NULL, '15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(114, 17, '0026-08-18', 2, NULL, '88', NULL, '88', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(115, 17, '0026-08-19', 3, NULL, '56', NULL, '56', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(116, 17, '0026-08-20', 4, NULL, '53', NULL, '53', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(117, 17, '0026-08-21', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(118, 17, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(119, 17, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(120, 18, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(121, 18, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(122, 18, '0026-07-29', 3, NULL, '09', NULL, '09', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(123, 18, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(124, 18, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(125, 18, '0026-08-01', 6, NULL, '23', NULL, '23', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(126, 18, '0026-08-02', 0, NULL, '15', NULL, '15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(127, 19, '0026-08-03', 1, NULL, '60', NULL, '60', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(128, 19, '0026-08-04', 2, NULL, '24', NULL, '24', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(129, 19, '0026-08-05', 3, NULL, '22', NULL, '22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(130, 19, '0026-08-06', 4, NULL, '89', NULL, '89', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(131, 19, '0026-08-07', 5, NULL, '60', NULL, '60', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(132, 19, '0026-08-08', 6, NULL, '99', NULL, '99', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(133, 19, '0026-08-09', 0, NULL, '53', NULL, '53', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(134, 20, '0026-08-10', 1, NULL, '69', NULL, '69', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(135, 20, '0026-08-11', 2, NULL, '31', NULL, '31', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(136, 20, '0026-08-12', 3, NULL, '63', NULL, '63', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(137, 20, '0026-08-13', 4, NULL, '79', NULL, '79', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(138, 20, '0026-08-14', 5, NULL, '38', NULL, '38', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(139, 20, '0026-08-15', 6, NULL, '40', NULL, '40', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(140, 20, '0026-08-16', 0, NULL, '99', NULL, '99', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(141, 21, '0026-08-17', 1, NULL, '20', NULL, '20', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(142, 21, '0026-08-18', 2, NULL, '32', NULL, '32', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(143, 21, '0026-08-19', 3, NULL, '58', NULL, '58', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(144, 21, '0026-08-20', 4, NULL, '22', NULL, '22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(145, 21, '0026-08-21', 5, NULL, '50', NULL, '50', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(146, 21, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(147, 21, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(148, 22, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(149, 22, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(150, 22, '0026-07-29', 3, NULL, '49', NULL, '49', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(151, 22, '0026-07-30', 4, NULL, '09', NULL, '09', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(152, 22, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(153, 22, '0026-08-01', 6, NULL, '29', NULL, '29', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(154, 22, '0026-08-02', 0, NULL, '21', NULL, '21', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(155, 23, '0026-08-03', 1, NULL, '78', NULL, '78', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(156, 23, '0026-08-04', 2, NULL, '49', NULL, '49', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(157, 23, '0026-08-05', 3, NULL, '20', NULL, '20', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(158, 23, '0026-08-06', 4, NULL, '18', NULL, '18', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(159, 23, '0026-08-07', 5, NULL, '99', NULL, '99', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(160, 23, '0026-08-08', 6, NULL, '25', NULL, '25', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(161, 23, '0026-08-09', 0, NULL, '76', NULL, '76', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(162, 24, '0026-06-29', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(163, 24, '0026-06-30', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(164, 24, '0026-07-01', 3, NULL, '51', NULL, '51', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(165, 24, '0026-07-02', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(166, 24, '0026-07-03', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(167, 24, '0026-07-04', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(168, 24, '0026-07-05', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(169, 25, '0026-08-10', 1, NULL, '01', NULL, '01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(170, 25, '0026-08-11', 2, NULL, '20', NULL, '20', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(171, 25, '0026-08-12', 3, NULL, '43', NULL, '43', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(172, 25, '0026-08-13', 4, NULL, '85', NULL, '85', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(173, 25, '0026-08-14', 5, NULL, '79', NULL, '79', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(174, 25, '0026-08-15', 6, NULL, '15', NULL, '15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(175, 25, '0026-08-16', 0, NULL, '36', NULL, '36', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(176, 26, '0026-08-17', 1, NULL, '09', NULL, '09', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(177, 26, '0026-08-18', 2, NULL, '92', NULL, '92', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(178, 26, '0026-08-19', 3, NULL, '78', NULL, '78', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(179, 26, '0026-08-20', 4, NULL, '31', NULL, '31', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(180, 26, '0026-08-21', 5, NULL, '36', NULL, '36', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(181, 26, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(182, 26, '0026-08-23', 0, NULL, 'ee', NULL, 'ee', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(183, 27, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(184, 27, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(185, 27, '0026-07-29', 3, NULL, '71', NULL, '71', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(186, 27, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(187, 27, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(188, 27, '0026-08-01', 6, NULL, '01', NULL, '01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(189, 27, '0026-08-02', 0, NULL, '94', NULL, '94', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(190, 28, '0026-08-03', 1, NULL, '65', NULL, '65', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(191, 28, '0026-08-04', 2, NULL, '90', NULL, '90', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(192, 28, '0026-08-05', 3, NULL, '34', NULL, '34', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(193, 28, '0026-08-06', 4, NULL, '41', NULL, '41', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(194, 28, '0026-08-07', 5, NULL, '83', NULL, '83', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(195, 28, '0026-08-08', 6, NULL, '22', NULL, '22', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(196, 28, '0026-08-09', 0, NULL, '94', NULL, '94', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(197, 29, '0026-08-10', 1, NULL, '73', NULL, '73', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(198, 29, '0026-08-11', 2, NULL, '58', NULL, '58', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(199, 29, '0026-08-12', 3, NULL, '39', NULL, '39', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(200, 29, '0026-08-13', 4, NULL, '49', NULL, '49', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(201, 29, '0026-08-14', 5, NULL, '04', NULL, '04', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(202, 29, '0026-08-15', 6, NULL, '96', NULL, '96', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(203, 29, '0026-08-16', 0, NULL, '57', NULL, '57', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(204, 30, '0026-08-17', 1, NULL, '21', NULL, '21', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(205, 30, '0026-08-18', 2, NULL, '37', NULL, '37', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(206, 30, '0026-08-19', 3, NULL, '48', NULL, '48', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(207, 30, '0026-08-20', 4, NULL, '76', NULL, '76', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(208, 30, '0026-08-21', 5, NULL, '52', NULL, '52', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(209, 30, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(210, 30, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(211, 31, '0026-08-24', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(212, 31, '0026-08-25', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(213, 31, '0026-08-26', 3, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(214, 31, '0026-08-27', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(215, 31, '0026-08-28', 5, NULL, '76', NULL, '76', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(216, 31, '0026-08-29', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(217, 31, '0026-08-30', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(218, 32, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(219, 32, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(220, 32, '0026-07-29', 3, NULL, '51', NULL, '51', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(221, 32, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(222, 32, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(223, 32, '0026-08-01', 6, NULL, '29', NULL, '29', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(224, 32, '0026-08-02', 0, NULL, '41', NULL, '41', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(225, 33, '0026-08-03', 1, NULL, '82', NULL, '82', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(226, 33, '0026-08-04', 2, NULL, '54', NULL, '54', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(227, 33, '0026-08-05', 3, NULL, '78', NULL, '78', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(228, 33, '0026-08-06', 4, NULL, '84', NULL, '84', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(229, 33, '0026-08-07', 5, NULL, '01', NULL, '01', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(230, 33, '0026-08-08', 6, NULL, '36', NULL, '36', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(231, 33, '0026-08-09', 0, NULL, '95', NULL, '95', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(232, 34, '0026-08-10', 1, NULL, '74', NULL, '74', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(233, 34, '0026-08-11', 2, NULL, '24', NULL, '24', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(234, 34, '0026-08-12', 3, NULL, '51', NULL, '51', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(235, 34, '0026-08-13', 4, NULL, '83', NULL, '83', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(236, 34, '0026-08-14', 5, NULL, '62', NULL, '62', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(237, 34, '0026-08-15', 6, NULL, '59', NULL, '59', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(238, 34, '0026-08-16', 0, NULL, '37', NULL, '37', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(239, 35, '0026-08-17', 1, NULL, '90', NULL, '90', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(240, 35, '0026-08-18', 2, NULL, '24', NULL, '24', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(241, 35, '0026-08-19', 3, NULL, '72', NULL, '72', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(242, 35, '0026-08-20', 4, NULL, '35', NULL, '35', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(243, 35, '0026-08-21', 5, NULL, '87', NULL, '87', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(244, 35, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(245, 35, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(246, 36, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(247, 36, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(248, 36, '0026-07-29', 3, NULL, '01', NULL, '01', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(249, 36, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(250, 36, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(251, 36, '0026-08-01', 6, NULL, '36', NULL, '36', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(252, 36, '0026-08-02', 0, NULL, '42', NULL, '42', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(253, 37, '0026-08-03', 1, NULL, '03', NULL, '03', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(254, 37, '0026-08-04', 2, NULL, '64', NULL, '64', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(255, 37, '0026-08-05', 3, NULL, '92', NULL, '92', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(256, 37, '0026-08-06', 4, NULL, '83', NULL, '83', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(257, 37, '0026-08-07', 5, NULL, '51', NULL, '51', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(258, 37, '0026-08-08', 6, NULL, '96', NULL, '96', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(259, 37, '0026-08-09', 0, NULL, '40', NULL, '40', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(260, 38, '0026-08-10', 1, NULL, '52', NULL, '52', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(261, 38, '0026-08-11', 2, NULL, '76', NULL, '76', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(262, 38, '0026-08-12', 3, NULL, '46', NULL, '46', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(263, 38, '0026-08-13', 4, NULL, '13', NULL, '13', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(264, 38, '0026-08-14', 5, NULL, '85', NULL, '85', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(265, 38, '0026-08-15', 6, NULL, '69', NULL, '69', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(266, 38, '0026-08-16', 0, NULL, '01', NULL, '01', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(267, 39, '0026-08-17', 1, NULL, '96', NULL, '96', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(268, 39, '0026-08-18', 2, NULL, '67', NULL, '67', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(269, 39, '0026-08-19', 3, NULL, '13', NULL, '13', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(270, 39, '0026-08-20', 4, NULL, '82', NULL, '82', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(271, 39, '0026-08-21', 5, NULL, '53', NULL, '53', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(272, 39, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(273, 39, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(274, 40, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(275, 40, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(276, 40, '0026-07-29', 3, NULL, '04', NULL, '04', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(277, 40, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(278, 40, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(279, 40, '0026-08-01', 6, NULL, '26', NULL, '26', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(280, 40, '0026-08-02', 0, NULL, '58', NULL, '58', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(281, 41, '0026-08-03', 1, NULL, '31', NULL, '31', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(282, 41, '0026-08-04', 2, NULL, '10', NULL, '10', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(283, 41, '0026-08-05', 3, NULL, '75', NULL, '75', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(284, 41, '0026-08-06', 4, NULL, '97', NULL, '97', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(285, 41, '0026-08-07', 5, NULL, '80', NULL, '80', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(286, 41, '0026-08-08', 6, NULL, '93', NULL, '93', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(287, 41, '0026-08-09', 0, NULL, '74', NULL, '74', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(288, 42, '0026-08-10', 1, NULL, '64', NULL, '64', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(289, 42, '0026-08-11', 2, NULL, '30', NULL, '30', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(290, 42, '0026-08-12', 3, NULL, '41', NULL, '41', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(291, 42, '0026-08-13', 4, NULL, '34', NULL, '34', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(292, 42, '0026-08-14', 5, NULL, '02', NULL, '02', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(293, 42, '0026-08-15', 6, NULL, '23', NULL, '23', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(294, 42, '0026-08-16', 0, NULL, '53', NULL, '53', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(295, 43, '0026-08-17', 1, NULL, '12', NULL, '12', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(296, 43, '0026-08-18', 2, NULL, '87', NULL, '87', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(297, 43, '0026-08-19', 3, NULL, '02', NULL, '02', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(298, 43, '0026-08-20', 4, NULL, '12', NULL, '12', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(299, 43, '0026-08-21', 5, NULL, '93', NULL, '93', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(300, 43, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(301, 43, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(302, 44, '0026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(303, 44, '0026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(304, 44, '0026-07-29', 3, NULL, '80', NULL, '80', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(305, 44, '0026-07-30', 4, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(306, 44, '0026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(307, 44, '0026-08-01', 6, NULL, '31', NULL, '31', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(308, 44, '0026-08-02', 0, NULL, '85', NULL, '85', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(309, 45, '0026-08-03', 1, NULL, '03', NULL, '03', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(310, 45, '0026-08-04', 2, NULL, '45', NULL, '45', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(311, 45, '0026-08-05', 3, NULL, '63', NULL, '63', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(312, 45, '0026-08-06', 4, NULL, '24', NULL, '24', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(313, 45, '0026-08-07', 5, NULL, '90', NULL, '90', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(314, 45, '0026-08-08', 6, NULL, '73', NULL, '73', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(315, 45, '0026-08-09', 0, NULL, '82', NULL, '82', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(316, 46, '0026-08-10', 1, NULL, '11', NULL, '11', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(317, 46, '0026-08-11', 2, NULL, '25', NULL, '25', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(318, 46, '0026-08-12', 3, NULL, '34', NULL, '34', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(319, 46, '0026-08-13', 4, NULL, '51', NULL, '51', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(320, 46, '0026-08-14', 5, NULL, '04', NULL, '04', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(321, 46, '0026-08-15', 6, NULL, '86', NULL, '86', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(322, 46, '0026-08-16', 0, NULL, '53', NULL, '53', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(323, 47, '0026-08-17', 1, NULL, '76', NULL, '76', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(324, 47, '0026-08-18', 2, NULL, '34', NULL, '34', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(325, 47, '0026-08-19', 3, NULL, '68', NULL, '68', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(326, 47, '0026-08-20', 4, NULL, '13', NULL, '13', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(327, 47, '0026-08-21', 5, NULL, '49', NULL, '49', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(328, 47, '0026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(329, 47, '0026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(330, 53, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(331, 53, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(332, 53, '2026-07-29', 3, NULL, '92', NULL, '92', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(333, 53, '2026-07-30', 4, NULL, '60', NULL, '60', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(334, 53, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(335, 53, '2026-08-01', 6, NULL, '62', NULL, '62', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(336, 53, '2026-08-02', 0, NULL, '38', NULL, '38', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(337, 54, '2026-08-03', 1, NULL, '31', NULL, '31', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(338, 54, '2026-08-04', 2, NULL, '60', NULL, '60', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(339, 54, '2026-08-05', 3, NULL, '04', NULL, '04', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(340, 54, '2026-08-06', 4, NULL, '82', NULL, '82', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(341, 54, '2026-08-07', 5, NULL, '65', NULL, '65', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(342, 54, '2026-08-08', 6, NULL, '12', NULL, '12', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(343, 54, '2026-08-09', 0, NULL, '36', NULL, '36', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(344, 55, '2026-08-10', 1, NULL, '74', NULL, '74', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(345, 55, '2026-08-11', 2, NULL, '11', NULL, '11', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(346, 55, '2026-08-12', 3, NULL, '19', NULL, '19', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(347, 55, '2026-08-13', 4, NULL, '72', NULL, '72', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(348, 55, '2026-08-14', 5, NULL, '45', NULL, '45', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(349, 55, '2026-08-15', 6, NULL, '05', NULL, '05', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(350, 55, '2026-08-16', 0, NULL, '96', NULL, '96', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(351, 56, '2026-08-17', 1, NULL, '82', NULL, '82', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(352, 56, '2026-08-18', 2, NULL, '41', NULL, '41', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(353, 56, '2026-08-19', 3, NULL, '30', NULL, '30', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(354, 56, '2026-08-20', 4, NULL, '99', NULL, '99', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(355, 56, '2026-08-21', 5, NULL, '86', NULL, '86', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(356, 56, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(357, 56, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(358, 57, '2026-08-24', 1, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(359, 57, '2026-08-25', 2, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(360, 57, '2026-08-26', 3, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(361, 57, '2026-08-27', 4, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(362, 57, '2026-08-28', 5, NULL, '69', NULL, '69', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(363, 57, '2026-08-29', 6, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(364, 57, '2026-08-30', 0, NULL, NULL, NULL, NULL, '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(365, 58, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(366, 58, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(367, 58, '2026-07-29', 3, NULL, '54', NULL, '54', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(368, 58, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(369, 58, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(370, 58, '2026-08-01', 6, NULL, '71', NULL, '71', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(371, 58, '2026-08-02', 0, NULL, '09', NULL, '09', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(372, 59, '2026-08-03', 1, NULL, '53', NULL, '53', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(373, 59, '2026-08-04', 2, NULL, '12', NULL, '12', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(374, 59, '2026-08-05', 3, NULL, '47', NULL, '47', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(375, 59, '2026-08-06', 4, NULL, '61', NULL, '61', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(376, 59, '2026-08-07', 5, NULL, '52', NULL, '52', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(377, 59, '2026-08-08', 6, NULL, '91', NULL, '91', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(378, 59, '2026-08-09', 0, NULL, '89', NULL, '89', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(379, 60, '2026-08-10', 1, NULL, '85', NULL, '85', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(380, 60, '2026-08-11', 2, NULL, '78', NULL, '78', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(381, 60, '2026-08-12', 3, NULL, '94', NULL, '94', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(382, 60, '2026-08-13', 4, NULL, '40', NULL, '40', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(383, 60, '2026-08-14', 5, NULL, '69', NULL, '69', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(384, 60, '2026-08-15', 6, NULL, '10', NULL, '10', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(385, 60, '2026-08-16', 0, NULL, '34', NULL, '34', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(386, 61, '2026-08-17', 1, NULL, '01', NULL, '01', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(387, 61, '2026-08-18', 2, NULL, '01', NULL, '01', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(388, 61, '2026-08-19', 3, NULL, '05', NULL, '05', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(389, 61, '2026-08-20', 4, NULL, '36', NULL, '36', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(390, 61, '2026-08-21', 5, NULL, '35', NULL, '35', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(391, 61, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(392, 61, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(393, 62, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(394, 62, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(395, 62, '2026-07-29', 3, NULL, '60', NULL, '60', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(396, 62, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(397, 62, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(398, 62, '2026-08-01', 6, NULL, '57', NULL, '57', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(399, 62, '2026-08-02', 0, NULL, '06', NULL, '06', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(400, 63, '2026-08-03', 1, NULL, '95', NULL, '95', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(401, 63, '2026-08-04', 2, NULL, '12', NULL, '12', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(402, 63, '2026-08-05', 3, NULL, '57', NULL, '57', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(403, 63, '2026-08-06', 4, NULL, '22', NULL, '22', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(404, 63, '2026-08-07', 5, NULL, '26', NULL, '26', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(405, 63, '2026-08-08', 6, NULL, '81', NULL, '81', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(406, 63, '2026-08-09', 0, NULL, '63', NULL, '63', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(407, 64, '2026-08-10', 1, NULL, '58', NULL, '58', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(408, 64, '2026-08-11', 2, NULL, '58', NULL, '58', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(409, 64, '2026-08-12', 3, NULL, '75', NULL, '75', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(410, 64, '2026-08-13', 4, NULL, '54', NULL, '54', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(411, 64, '2026-08-14', 5, NULL, '49', NULL, '49', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(412, 64, '2026-08-15', 6, NULL, '58', NULL, '58', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(413, 64, '2026-08-16', 0, NULL, '90', NULL, '90', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(414, 65, '2026-08-17', 1, NULL, '46', NULL, '46', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(415, 65, '2026-08-18', 2, NULL, '22', NULL, '22', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(416, 65, '2026-08-19', 3, NULL, '59', NULL, '59', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(417, 65, '2026-08-20', 4, NULL, '91', NULL, '91', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(418, 65, '2026-08-21', 5, NULL, '34', NULL, '34', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(419, 65, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(420, 65, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(421, 66, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(422, 66, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(423, 66, '2026-07-29', 3, NULL, '16', NULL, '16', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(424, 66, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(425, 66, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(426, 66, '2026-08-01', 6, NULL, '92', NULL, '92', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(427, 66, '2026-08-02', 0, NULL, '31', NULL, '31', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(428, 67, '2026-08-03', 1, NULL, '59', NULL, '59', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(429, 67, '2026-08-04', 2, NULL, '27', NULL, '27', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(430, 67, '2026-08-05', 3, NULL, '85', NULL, '85', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(431, 67, '2026-08-06', 4, NULL, '80', NULL, '80', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(432, 67, '2026-08-07', 5, NULL, '35', NULL, '35', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(433, 67, '2026-08-08', 6, NULL, '93', NULL, '93', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(434, 67, '2026-08-09', 0, NULL, '97', NULL, '97', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(435, 68, '2026-08-10', 1, NULL, '57', NULL, '57', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(436, 68, '2026-08-11', 2, NULL, '92', NULL, '92', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(437, 68, '2026-08-12', 3, NULL, '36', NULL, '36', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(438, 68, '2026-08-13', 4, NULL, '61', NULL, '61', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(439, 68, '2026-08-14', 5, NULL, '71', NULL, '71', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(440, 68, '2026-08-15', 6, NULL, '71', NULL, '71', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(441, 68, '2026-08-16', 0, NULL, '59', NULL, '59', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(442, 69, '2026-08-17', 1, NULL, '15', NULL, '15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(443, 69, '2026-08-18', 2, NULL, '88', NULL, '88', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(444, 69, '2026-08-19', 3, NULL, '56', NULL, '56', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(445, 69, '2026-08-20', 4, NULL, '53', NULL, '53', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(446, 69, '2026-08-21', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(447, 69, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(448, 69, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(449, 70, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(450, 70, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(451, 70, '2026-07-29', 3, NULL, '09', NULL, '09', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(452, 70, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(453, 70, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(454, 70, '2026-08-01', 6, NULL, '23', NULL, '23', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(455, 70, '2026-08-02', 0, NULL, '15', NULL, '15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(456, 71, '2026-08-03', 1, NULL, '60', NULL, '60', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(457, 71, '2026-08-04', 2, NULL, '24', NULL, '24', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(458, 71, '2026-08-05', 3, NULL, '22', NULL, '22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(459, 71, '2026-08-06', 4, NULL, '89', NULL, '89', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(460, 71, '2026-08-07', 5, NULL, '60', NULL, '60', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(461, 71, '2026-08-08', 6, NULL, '99', NULL, '99', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(462, 71, '2026-08-09', 0, NULL, '53', NULL, '53', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(463, 72, '2026-08-10', 1, NULL, '69', NULL, '69', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(464, 72, '2026-08-11', 2, NULL, '31', NULL, '31', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(465, 72, '2026-08-12', 3, NULL, '63', NULL, '63', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(466, 72, '2026-08-13', 4, NULL, '79', NULL, '79', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(467, 72, '2026-08-14', 5, NULL, '38', NULL, '38', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(468, 72, '2026-08-15', 6, NULL, '40', NULL, '40', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(469, 72, '2026-08-16', 0, NULL, '99', NULL, '99', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(470, 73, '2026-08-17', 1, NULL, '20', NULL, '20', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(471, 73, '2026-08-18', 2, NULL, '32', NULL, '32', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(472, 73, '2026-08-19', 3, NULL, '58', NULL, '58', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(473, 73, '2026-08-20', 4, NULL, '22', NULL, '22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(474, 73, '2026-08-21', 5, NULL, '50', NULL, '50', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(475, 73, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(476, 73, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(477, 74, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(478, 74, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(479, 74, '2026-07-29', 3, NULL, '49', NULL, '49', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(480, 74, '2026-07-30', 4, NULL, '09', NULL, '09', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(481, 74, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(482, 74, '2026-08-01', 6, NULL, '29', NULL, '29', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(483, 74, '2026-08-02', 0, NULL, '21', NULL, '21', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(484, 75, '2026-08-03', 1, NULL, '78', NULL, '78', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(485, 75, '2026-08-04', 2, NULL, '49', NULL, '49', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(486, 75, '2026-08-05', 3, NULL, '20', NULL, '20', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(487, 75, '2026-08-06', 4, NULL, '18', NULL, '18', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(488, 75, '2026-08-07', 5, NULL, '99', NULL, '99', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(489, 75, '2026-08-08', 6, NULL, '25', NULL, '25', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(490, 75, '2026-08-09', 0, NULL, '76', NULL, '76', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(491, 76, '2026-06-29', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(492, 76, '2026-06-30', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(493, 76, '2026-07-01', 3, NULL, '51', NULL, '51', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(494, 76, '2026-07-02', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(495, 76, '2026-07-03', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(496, 76, '2026-07-04', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(497, 76, '2026-07-05', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(498, 77, '2026-08-10', 1, NULL, '01', NULL, '01', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(499, 77, '2026-08-11', 2, NULL, '20', NULL, '20', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(500, 77, '2026-08-12', 3, NULL, '43', NULL, '43', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(501, 77, '2026-08-13', 4, NULL, '85', NULL, '85', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(502, 77, '2026-08-14', 5, NULL, '79', NULL, '79', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(503, 77, '2026-08-15', 6, NULL, '15', NULL, '15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(504, 77, '2026-08-16', 0, NULL, '36', NULL, '36', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(505, 78, '2026-08-17', 1, NULL, '09', NULL, '09', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(506, 78, '2026-08-18', 2, NULL, '92', NULL, '92', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(507, 78, '2026-08-19', 3, NULL, '78', NULL, '78', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(508, 78, '2026-08-20', 4, NULL, '31', NULL, '31', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(509, 78, '2026-08-21', 5, NULL, '36', NULL, '36', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(510, 78, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(511, 78, '2026-08-23', 0, NULL, 'ee', NULL, 'ee', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(512, 79, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(513, 79, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(514, 79, '2026-07-29', 3, NULL, '71', NULL, '71', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(515, 79, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(516, 79, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(517, 79, '2026-08-01', 6, NULL, '01', NULL, '01', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(518, 79, '2026-08-02', 0, NULL, '94', NULL, '94', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(519, 80, '2026-08-03', 1, NULL, '65', NULL, '65', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(520, 80, '2026-08-04', 2, NULL, '90', NULL, '90', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(521, 80, '2026-08-05', 3, NULL, '34', NULL, '34', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(522, 80, '2026-08-06', 4, NULL, '41', NULL, '41', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(523, 80, '2026-08-07', 5, NULL, '83', NULL, '83', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(524, 80, '2026-08-08', 6, NULL, '22', NULL, '22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(525, 80, '2026-08-09', 0, NULL, '94', NULL, '94', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(526, 81, '2026-08-10', 1, NULL, '73', NULL, '73', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(527, 81, '2026-08-11', 2, NULL, '58', NULL, '58', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(528, 81, '2026-08-12', 3, NULL, '39', NULL, '39', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(529, 81, '2026-08-13', 4, NULL, '49', NULL, '49', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(530, 81, '2026-08-14', 5, NULL, '04', NULL, '04', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(531, 81, '2026-08-15', 6, NULL, '96', NULL, '96', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(532, 81, '2026-08-16', 0, NULL, '57', NULL, '57', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(533, 82, '2026-08-17', 1, NULL, '21', NULL, '21', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(534, 82, '2026-08-18', 2, NULL, '37', NULL, '37', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(535, 82, '2026-08-19', 3, NULL, '48', NULL, '48', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(536, 82, '2026-08-20', 4, NULL, '76', NULL, '76', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(537, 82, '2026-08-21', 5, NULL, '52', NULL, '52', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(538, 82, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(539, 82, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(540, 83, '2026-08-24', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(541, 83, '2026-08-25', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(542, 83, '2026-08-26', 3, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(543, 83, '2026-08-27', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(544, 83, '2026-08-28', 5, NULL, '76', NULL, '76', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(545, 83, '2026-08-29', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(546, 83, '2026-08-30', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(547, 84, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(548, 84, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(549, 84, '2026-07-29', 3, NULL, '51', NULL, '51', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(550, 84, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(551, 84, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(552, 84, '2026-08-01', 6, NULL, '29', NULL, '29', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(553, 84, '2026-08-02', 0, NULL, '41', NULL, '41', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(554, 85, '2026-08-03', 1, NULL, '82', NULL, '82', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(555, 85, '2026-08-04', 2, NULL, '54', NULL, '54', '2026-09-01 00:14:11', '2026-09-01 00:14:11');
INSERT INTO `chart_entries` (`id`, `chart_week_id`, `result_date`, `day_of_week`, `open_panna`, `jodi`, `close_panna`, `result`, `created_at`, `updated_at`) VALUES
(556, 85, '2026-08-05', 3, NULL, '78', NULL, '78', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(557, 85, '2026-08-06', 4, NULL, '84', NULL, '84', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(558, 85, '2026-08-07', 5, NULL, '01', NULL, '01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(559, 85, '2026-08-08', 6, NULL, '36', NULL, '36', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(560, 85, '2026-08-09', 0, NULL, '95', NULL, '95', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(561, 86, '2026-08-10', 1, NULL, '74', NULL, '74', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(562, 86, '2026-08-11', 2, NULL, '24', NULL, '24', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(563, 86, '2026-08-12', 3, NULL, '51', NULL, '51', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(564, 86, '2026-08-13', 4, NULL, '83', NULL, '83', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(565, 86, '2026-08-14', 5, NULL, '62', NULL, '62', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(566, 86, '2026-08-15', 6, NULL, '59', NULL, '59', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(567, 86, '2026-08-16', 0, NULL, '37', NULL, '37', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(568, 87, '2026-08-17', 1, NULL, '90', NULL, '90', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(569, 87, '2026-08-18', 2, NULL, '24', NULL, '24', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(570, 87, '2026-08-19', 3, NULL, '72', NULL, '72', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(571, 87, '2026-08-20', 4, NULL, '35', NULL, '35', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(572, 87, '2026-08-21', 5, NULL, '87', NULL, '87', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(573, 87, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(574, 87, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(575, 88, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(576, 88, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(577, 88, '2026-07-29', 3, NULL, '01', NULL, '01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(578, 88, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(579, 88, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(580, 88, '2026-08-01', 6, NULL, '36', NULL, '36', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(581, 88, '2026-08-02', 0, NULL, '42', NULL, '42', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(582, 89, '2026-08-03', 1, NULL, '03', NULL, '03', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(583, 89, '2026-08-04', 2, NULL, '64', NULL, '64', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(584, 89, '2026-08-05', 3, NULL, '92', NULL, '92', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(585, 89, '2026-08-06', 4, NULL, '83', NULL, '83', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(586, 89, '2026-08-07', 5, NULL, '51', NULL, '51', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(587, 89, '2026-08-08', 6, NULL, '96', NULL, '96', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(588, 89, '2026-08-09', 0, NULL, '40', NULL, '40', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(589, 90, '2026-08-10', 1, NULL, '52', NULL, '52', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(590, 90, '2026-08-11', 2, NULL, '76', NULL, '76', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(591, 90, '2026-08-12', 3, NULL, '46', NULL, '46', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(592, 90, '2026-08-13', 4, NULL, '13', NULL, '13', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(593, 90, '2026-08-14', 5, NULL, '85', NULL, '85', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(594, 90, '2026-08-15', 6, NULL, '69', NULL, '69', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(595, 90, '2026-08-16', 0, NULL, '01', NULL, '01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(596, 91, '2026-08-17', 1, NULL, '96', NULL, '96', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(597, 91, '2026-08-18', 2, NULL, '67', NULL, '67', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(598, 91, '2026-08-19', 3, NULL, '13', NULL, '13', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(599, 91, '2026-08-20', 4, NULL, '82', NULL, '82', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(600, 91, '2026-08-21', 5, NULL, '53', NULL, '53', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(601, 91, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(602, 91, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(603, 92, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(604, 92, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(605, 92, '2026-07-29', 3, NULL, '04', NULL, '04', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(606, 92, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(607, 92, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(608, 92, '2026-08-01', 6, NULL, '26', NULL, '26', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(609, 92, '2026-08-02', 0, NULL, '58', NULL, '58', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(610, 93, '2026-08-03', 1, NULL, '31', NULL, '31', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(611, 93, '2026-08-04', 2, NULL, '10', NULL, '10', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(612, 93, '2026-08-05', 3, NULL, '75', NULL, '75', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(613, 93, '2026-08-06', 4, NULL, '97', NULL, '97', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(614, 93, '2026-08-07', 5, NULL, '80', NULL, '80', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(615, 93, '2026-08-08', 6, NULL, '93', NULL, '93', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(616, 93, '2026-08-09', 0, NULL, '74', NULL, '74', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(617, 94, '2026-08-10', 1, NULL, '64', NULL, '64', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(618, 94, '2026-08-11', 2, NULL, '30', NULL, '30', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(619, 94, '2026-08-12', 3, NULL, '41', NULL, '41', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(620, 94, '2026-08-13', 4, NULL, '34', NULL, '34', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(621, 94, '2026-08-14', 5, NULL, '02', NULL, '02', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(622, 94, '2026-08-15', 6, NULL, '23', NULL, '23', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(623, 94, '2026-08-16', 0, NULL, '53', NULL, '53', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(624, 95, '2026-08-17', 1, NULL, '12', NULL, '12', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(625, 95, '2026-08-18', 2, NULL, '87', NULL, '87', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(626, 95, '2026-08-19', 3, NULL, '02', NULL, '02', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(627, 95, '2026-08-20', 4, NULL, '12', NULL, '12', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(628, 95, '2026-08-21', 5, NULL, '93', NULL, '93', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(629, 95, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(630, 95, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(631, 96, '2026-07-27', 1, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(632, 96, '2026-07-28', 2, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(633, 96, '2026-07-29', 3, NULL, '80', NULL, '80', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(634, 96, '2026-07-30', 4, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(635, 96, '2026-07-31', 5, NULL, NULL, NULL, NULL, '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(636, 96, '2026-08-01', 6, NULL, '31', NULL, '31', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(637, 96, '2026-08-02', 0, NULL, '85', NULL, '85', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(638, 97, '2026-08-03', 1, NULL, '03', NULL, '03', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(639, 97, '2026-08-04', 2, NULL, '45', NULL, '45', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(640, 97, '2026-08-05', 3, NULL, '63', NULL, '63', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(641, 97, '2026-08-06', 4, NULL, '24', NULL, '24', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(642, 97, '2026-08-07', 5, NULL, '90', NULL, '90', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(643, 97, '2026-08-08', 6, NULL, '73', NULL, '73', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(644, 97, '2026-08-09', 0, NULL, '82', NULL, '82', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(645, 98, '2026-08-10', 1, NULL, '11', NULL, '11', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(646, 98, '2026-08-11', 2, NULL, '25', NULL, '25', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(647, 98, '2026-08-12', 3, NULL, '34', NULL, '34', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(648, 98, '2026-08-13', 4, NULL, '51', NULL, '51', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(649, 98, '2026-08-14', 5, NULL, '04', NULL, '04', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(650, 98, '2026-08-15', 6, NULL, '86', NULL, '86', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(651, 98, '2026-08-16', 0, NULL, '53', NULL, '53', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(652, 99, '2026-08-17', 1, NULL, '76', NULL, '76', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(653, 99, '2026-08-18', 2, NULL, '34', NULL, '34', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(654, 99, '2026-08-19', 3, NULL, '68', NULL, '68', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(655, 99, '2026-08-20', 4, NULL, '13', NULL, '13', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(656, 99, '2026-08-21', 5, NULL, '49', NULL, '49', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(657, 99, '2026-08-22', 6, NULL, NULL, NULL, NULL, '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(658, 99, '2026-08-23', 0, NULL, NULL, NULL, NULL, '2026-09-01 00:14:12', '2026-09-01 00:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `chart_weeks`
--

CREATE TABLE `chart_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `week_start` date NOT NULL,
  `week_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_weeks`
--

INSERT INTO `chart_weeks` (`id`, `game_id`, `week_start`, `week_end`, `created_at`, `updated_at`) VALUES
(6, 5, '0026-07-27', '0026-08-01', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(7, 5, '0026-08-03', '0026-08-08', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(8, 5, '0026-08-10', '0026-08-15', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(9, 5, '0026-08-17', '0026-08-22', '2026-08-31 00:31:34', '2026-08-31 00:31:34'),
(10, 8, '0026-07-27', '0026-08-01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(11, 8, '0026-08-03', '0026-08-08', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(12, 8, '0026-08-10', '0026-08-15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(13, 8, '0026-08-17', '0026-08-22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(14, 12, '0026-07-27', '0026-08-01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(15, 12, '0026-08-03', '0026-08-08', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(16, 12, '0026-08-10', '0026-08-15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(17, 12, '0026-08-17', '0026-08-22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(18, 10, '0026-07-27', '0026-08-01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(19, 10, '0026-08-03', '0026-08-08', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(20, 10, '0026-08-10', '0026-08-15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(21, 10, '0026-08-17', '0026-08-22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(22, 2, '0026-07-27', '0026-08-01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(23, 2, '0026-08-03', '0026-08-08', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(24, 2, '0026-06-29', '0026-07-04', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(25, 2, '0026-08-10', '0026-08-15', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(26, 2, '0026-08-17', '0026-08-22', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(27, 4, '0026-07-27', '0026-08-01', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(28, 4, '0026-08-03', '0026-08-08', '2026-08-31 00:31:35', '2026-08-31 00:31:35'),
(29, 4, '0026-08-10', '0026-08-15', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(30, 4, '0026-08-17', '0026-08-22', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(31, 4, '0026-08-24', '0026-08-29', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(32, 7, '0026-07-27', '0026-08-01', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(33, 7, '0026-08-03', '0026-08-08', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(34, 7, '0026-08-10', '0026-08-15', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(35, 7, '0026-08-17', '0026-08-22', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(36, 11, '0026-07-27', '0026-08-01', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(37, 11, '0026-08-03', '0026-08-08', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(38, 11, '0026-08-10', '0026-08-15', '2026-08-31 00:31:36', '2026-08-31 00:31:36'),
(39, 11, '0026-08-17', '0026-08-22', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(40, 6, '0026-07-27', '0026-08-01', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(41, 6, '0026-08-03', '0026-08-08', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(42, 6, '0026-08-10', '0026-08-15', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(43, 6, '0026-08-17', '0026-08-22', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(44, 9, '0026-07-27', '0026-08-01', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(45, 9, '0026-08-03', '0026-08-08', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(46, 9, '0026-08-10', '0026-08-15', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(47, 9, '0026-08-17', '0026-08-22', '2026-08-31 00:31:37', '2026-08-31 00:31:37'),
(53, 3, '2026-07-27', '2026-08-01', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(54, 3, '2026-08-03', '2026-08-08', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(55, 3, '2026-08-10', '2026-08-15', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(56, 3, '2026-08-17', '2026-08-22', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(57, 3, '2026-08-24', '2026-08-29', '2026-08-31 23:37:44', '2026-08-31 23:37:44'),
(58, 5, '2026-07-27', '2026-08-01', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(59, 5, '2026-08-03', '2026-08-08', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(60, 5, '2026-08-10', '2026-08-15', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(61, 5, '2026-08-17', '2026-08-22', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(62, 8, '2026-07-27', '2026-08-01', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(63, 8, '2026-08-03', '2026-08-08', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(64, 8, '2026-08-10', '2026-08-15', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(65, 8, '2026-08-17', '2026-08-22', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(66, 12, '2026-07-27', '2026-08-01', '2026-09-01 00:14:09', '2026-09-01 00:14:09'),
(67, 12, '2026-08-03', '2026-08-08', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(68, 12, '2026-08-10', '2026-08-15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(69, 12, '2026-08-17', '2026-08-22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(70, 10, '2026-07-27', '2026-08-01', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(71, 10, '2026-08-03', '2026-08-08', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(72, 10, '2026-08-10', '2026-08-15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(73, 10, '2026-08-17', '2026-08-22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(74, 2, '2026-07-27', '2026-08-01', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(75, 2, '2026-08-03', '2026-08-08', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(76, 2, '2026-06-29', '2026-07-04', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(77, 2, '2026-08-10', '2026-08-15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(78, 2, '2026-08-17', '2026-08-22', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(79, 4, '2026-07-27', '2026-08-01', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(80, 4, '2026-08-03', '2026-08-08', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(81, 4, '2026-08-10', '2026-08-15', '2026-09-01 00:14:10', '2026-09-01 00:14:10'),
(82, 4, '2026-08-17', '2026-08-22', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(83, 4, '2026-08-24', '2026-08-29', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(84, 7, '2026-07-27', '2026-08-01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(85, 7, '2026-08-03', '2026-08-08', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(86, 7, '2026-08-10', '2026-08-15', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(87, 7, '2026-08-17', '2026-08-22', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(88, 11, '2026-07-27', '2026-08-01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(89, 11, '2026-08-03', '2026-08-08', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(90, 11, '2026-08-10', '2026-08-15', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(91, 11, '2026-08-17', '2026-08-22', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(92, 6, '2026-07-27', '2026-08-01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(93, 6, '2026-08-03', '2026-08-08', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(94, 6, '2026-08-10', '2026-08-15', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(95, 6, '2026-08-17', '2026-08-22', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(96, 9, '2026-07-27', '2026-08-01', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(97, 9, '2026-08-03', '2026-08-08', '2026-09-01 00:14:11', '2026-09-01 00:14:11'),
(98, 9, '2026-08-10', '2026-08-15', '2026-09-01 00:14:12', '2026-09-01 00:14:12'),
(99, 9, '2026-08-17', '2026-08-22', '2026-09-01 00:14:12', '2026-09-01 00:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legacy_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `legacy_id`, `name`, `slug`, `active`, `created_at`, `updated_at`, `display_order`) VALUES
(2, 'disawer', 'DISAWAR', 'disawar', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(3, 'ghaziabad-savera', 'GHAZIABAD SAVERA', 'ghaziabad-savera', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(4, 'alwar-bazar', 'ALWAR BAZAR', 'alwar-bazar', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(5, 'gwalior-city', 'GWALIOR CITY', 'gwalior-city', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(6, 'delhi-bazar', 'DELHI BAZAR', 'delhi-bazar', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(7, 'shri-ganesh', 'SHRI GANESH', 'shri-ganesh', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(8, 'mathura', 'MATHURA', 'mathura', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(9, 'faridabad', 'FARIDABAD', 'faridabad', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(10, 'shri-shyam', 'SHRI SHYAM', 'shri-shyam', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(11, 'gaziyabad', 'GAZIYABAD', 'gaziyabad', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(12, 'noida', 'NOIDA', 'noida', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0),
(13, 'gali', 'GALI', 'gali', 1, '2026-08-30 03:31:52', '2026-08-30 03:31:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scope` enum('global','game','chart','homepage') NOT NULL DEFAULT 'global',
  `game_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `scope`, `game_id`, `question`, `answer`, `sort_order`, `active`, `created_at`, `updated_at`) VALUES
(43, 'game', 3, 'disawar', 'sdd', 1, 1, '2026-09-01 01:28:07', '2026-09-01 01:28:07'),
(44, 'game', 9, 'What is Shri Shyam Satta?', 'Shri Shyam Satta is a commonly searched term associated with online Satta and\r\nMatka-related result information. Users should verify information carefully before relying on\r\nany online source.', 0, 1, '2026-09-02 08:14:38', '2026-09-02 08:55:47'),
(45, 'game', 9, 'What does Shri Shyam refer to in Satta-related searches?', 'In this context, Shri Shyam is a search term used to find information, result updates, and\r\nhistorical records associated with a Satta-style game.', 1, 1, '2026-09-02 08:14:38', '2026-09-02 08:14:38'),
(46, 'game', 9, 'Where can I find Shri Shyam Satta results?', 'Shri Shyam Satta-related result information may appear on different websites. Users should\r\ncheck the source and publication date because unofficial information may be inaccurate or\r\noutdated.', 2, 1, '2026-09-02 08:14:38', '2026-09-02 08:14:38'),
(47, 'game', 9, 'Can Lucky Satta provide Shri Shyam Satta information?', 'Lucky Satta may provide general informational content related to Shri Shyam Satta and\r\nrelated searches. Such information should not be interpreted as a guarantee of future results\r\nor winnings.', 3, 1, '2026-09-02 08:14:38', '2026-09-02 08:14:38'),
(48, 'game', 9, 'Can previous Shri Shyam Satta results predict future numbers?', 'No. Historical results or number patterns cannot reliably guarantee future outcomes. Claims\r\nof fixed or guaranteed numbers should be treated with skepticism.', 4, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(49, 'game', 9, 'Is Shri Shyam Satta legal?', 'The legality of betting and gambling activities depends on applicable Indian laws and\r\nstate-specific regulations. Users should check the laws applicable to their location before\r\nparticipating.', 5, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(50, 'game', 9, 'What precautions should users take when searching for Shri Shyam Satta?', 'Users should understand the financial risks, protect personal information, and never share\r\nOTPs, passwords, banking credentials, or other sensitive details with unknown individuals or\r\nwebsites.', 6, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(51, 'game', 10, 'What is Ghaziabad Satta?', 'Ghaziabad Satta is a commonly searched term for online information related to Satta and\r\nMatka-style games associated with Ghaziabad.', 7, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(52, 'game', 10, 'What does Ghaziabad  mean?', 'Ghaziabad  is a search term often used for Ghaziabad-related Satta information and\r\nresult updates. Different online sources may use different terminology, so users should verify\r\ninformation carefully.', 8, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(53, 'game', 10, 'What is Ghaziabad Satta King?', 'Ghaziabad Satta King is another commonly searched phrase connected with Ghaziabad Satta result information. Online result claims should be independently checked and should not be considered guaranteed.', 9, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(54, 'game', 10, 'Can I find Ghaziabad Satta information on Lucky Satta?', 'Lucky Satta may provide general informational content covering Ghaziabad, Ghaziabad\r\nSavera, and Ghaziabad Satta King searches. This information should be treated as\r\nreference material rather than a guarantee of any outcome', 10, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(55, 'game', 10, 'Can previous Ghaziabad Satta results predict future numbers?', 'No. Previous results and historical patterns cannot reliably predict future outcomes. Any\r\nwebsite or person claiming guaranteed winning numbers should be approached with caution.', 11, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(56, 'game', 10, 'Is Ghaziabad Satta legal?', 'The legality of gambling and betting activities varies according to applicable Indian laws and\r\nstate regulations. Users should check the laws relevant to their location before participating.', 12, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(57, 'game', 10, 'What precautions should users take while searching for Ghaziabad Satta King?', 'Users should understand the financial risks, protect their privacy, avoid sharing OTPs or\r\nbanking credentials, and carefully evaluate the credibility of online information before making\r\nany decisions.', 13, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(58, 'game', 12, 'What is Gali Satta?', 'Gali Satta is a commonly searched term associated with online Satta and Matka-style result\r\ninformation. Different websites may use the term in different contexts.', 14, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(59, 'game', 12, 'What does Gali mean in Satta-related searches?', 'Gali is often used as a keyword for finding specific Satta-related result information, historical\r\nrecords, and online discussions.', 15, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(60, 'game', 12, 'Where can I find Gali Satta information?', 'Information related to Gali Satta may be available on various websites. Users should verify\r\nthe source, date, and accuracy of any published results.', 16, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(61, 'game', 12, 'Does Lucky Satta provide Gali Satta information?', 'Lucky Satta may provide general informational content related to Gali and Gali Satta\r\nsearches. This content should not be considered a guarantee of any future result or financial\r\noutcome.', 17, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(62, 'game', 12, 'Can previous Gali Satta results predict future numbers?', 'No. Past results and number patterns cannot reliably predict future outcomes. Any claim of\r\nguaranteed winning numbers should be treated with caution.', 18, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(63, 'game', 12, 'Is Gali Satta legal?', 'The legality of gambling and betting activities varies according to applicable Indian laws and\r\nstate regulations. Users should check the laws applicable to their location before\r\nparticipating.', 19, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(64, 'game', 12, 'What precautions should users take when searching for Gali Satta?', 'Users should understand the potential financial risks, protect personal information, and avoid\r\nsharing OTPs, passwords, banking details, or other sensitive information with unknown\r\nwebsites or individuals.', 20, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(65, 'game', 8, 'WHAT IS FARIDABAD SATTA MATKA?', 'Faridabad Satta is a major daily evening market draw declared at 06:10 PM.', 21, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(66, 'game', 8, 'HOW DO I CHECK LIVE FARIDABAD RESULTS?', 'View real-time Faridabad numbers on Lucky-satta.com live table or view full month records in the Faridabad chart section.', 22, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(67, 'game', 8, 'WHERE CAN I GET FARIDABAD GUESSING TIPS?', 'Get accurate Faridabad haruf and jodi guessing tips daily on Lucky Satta.', 23, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(68, 'game', 8, 'What is Faridabad Satta?', 'Faridabad Satta is a commonly searched term for online information related to Satta and\r\nMatka-style games associated with Faridabad.', 24, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(69, 'game', 8, 'What does Faridabad Savera refer to?', 'Faridabad Savera is a search term often used when looking for Faridabad-related Satta\r\ninformation or result updates. Different websites may use varying terminology, so information\r\nshould be verified carefully.', 25, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(70, 'game', 8, 'Where can I find Faridabad Satta result information?', 'Faridabad Satta result information may be published on different online platforms. Users\r\nshould check the source and date of any result before considering it reliable.', 26, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(71, 'game', 8, 'Does Lucky Satta provide Faridabad Savera information?', 'Lucky Satta may publish general informational content related to Faridabad Satta and\r\nFaridabad Savera. Such information should be treated as reference material and not as a\r\nguarantee of future results.', 27, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(72, 'game', 8, 'Can previous Faridabad Satta results predict future numbers?', 'No. Previous results and historical number patterns cannot reliably predict future outcomes.\r\nAny claim of guaranteed numbers or winnings should be approached with caution.', 28, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(73, 'game', 8, 'Is Faridabad Satta legal?', 'The legality of gambling and betting activities varies according to applicable Indian laws and\r\nstate regulations. Users should check the laws relevant to their location before participating.', 29, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(74, 'game', 8, 'What precautions should users take when searching for Faridabad Satta?', 'Users should understand the financial risks, protect their personal information, avoid sharing\r\nOTPs or banking credentials, and use only information sources they consider trustworthy\r\nand legally compliant.', 30, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(75, 'game', 6, 'What is Shri Ganesh Satta?', 'Shri Ganesh Satta is a commonly searched term for online information related to Satta-style\r\ngames and result records. Users should verify information carefully and understand the risks\r\ninvolved.', 31, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(76, 'game', 6, 'What is the Shree Ganesh Satta Game?', 'The Shree Ganesh Satta Game is a phrase used online when searching for information\r\nabout Shri Ganesh-related Satta activities. Different websites may use different names or\r\nformats for the same search topic.', 32, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(77, 'game', 6, 'Where can I find Shri Ganesh Game information?', 'Shri Ganesh Game information may appear on various online platforms, including\r\nresult-focused websites. Users should check the source and date of any information before\r\nrelying on it.', 33, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(78, 'game', 6, 'What does the Shri Ganesh Result mean?', 'Shri Ganesh Result generally refers to result information published online for a Shri\r\nGanesh-related Satta game. Results should be independently verified because unofficial\r\nwebsites may contain errors or outdated information.', 34, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(79, 'game', 6, 'Is Shri Ganesh Satta King\'s result predictable?', 'No. Shri Ganesh Satta King outcomes cannot be reliably predicted from previous results or\r\nnumber patterns. Any claim of a guaranteed winning number should be treated with caution.', 35, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(80, 'game', 6, 'Can Lucky Satta provide Shri Ganesh Satta information?', 'Lucky Satta may publish general informational content related to Shri Ganesh Satta, Shri\r\nGanesh Game, and result-related searches. Such information should not be considered a\r\nguarantee of future results or winnings.', 36, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(81, 'game', 6, 'What should I know before searching for Shri Ganesh Satta results?', 'Users should consider applicable laws, financial risks, and online privacy. Avoid sharing\r\npasswords, OTPs, banking details, or other sensitive information with unknown websites or\r\nindividuals.', 37, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(82, 'game', 2, 'What is Ghaziabad Savera?', '*Ghaziabad Savera* is a term commonly associated online with local Satta/Matka result\r\nsearches. Information about such games can vary by source, so users should verify details\r\ncarefully and understand the applicable laws before participating.', 38, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(83, 'game', 2, 'Where can I find Ghaziabad Savera information on Lucky Satta?', 'Lucky Satta may provide informational content related to Ghaziabad Savera and other\r\ncommonly searched Satta terms. Always check the website information carefully and avoid\r\nrelying on unverified claims.', 39, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(84, 'game', 2, 'Is Ghaziabad Savera legal in India?', 'The legality of gambling and betting activities varies according to Indian laws and individual\r\nstate regulations. Users should check the laws applicable in their location before\r\nparticipating in any gambling-related activity.', 40, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(85, 'game', 2, 'Does Lucky Satta guarantee Ghaziabad Savera results?', 'No. Lucky Satta should not be considered a guarantee of any Ghaziabad Savera result or\r\nfinancial outcome. Results and claims found online should be treated cautiously and\r\nindependently verified.', 41, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(86, 'game', 2, 'Can I use Ghaziabad Savera information for prediction?', 'Past results cannot reliably predict future outcomes in a random-number game. Any\r\nprediction or strategy claiming guaranteed success should be treated with skepticism.', 42, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(87, 'game', 2, 'What should users know before searching for Ghaziabad Savera?', 'Users should understand the potential financial risks, check local regulations, protect their\r\npersonal information, and avoid sharing sensitive account or payment details with unknown\r\nwebsites or individuals.', 43, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(88, 'game', 2, 'Why is Ghaziabad Savera searched on Lucky Satta?', 'Ghaziabad Savera is a commonly searched phrase among users looking for information\r\nabout local Satta-related results. Lucky Satta can be used as an informational reference, but\r\nusers should prioritize legal compliance, privacy, and responsible decision-making.', 44, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(89, 'game', 3, 'What is Alwar Bazar Satta?', 'Alwar Bazar Satta is a term used online in searches related to Satta and Matka-style result information associated with Alwar. Users should understand the risks and applicable local laws before engaging with any gambling-related activity.', 45, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(90, 'game', 3, 'Where can I find Alwar Bazar Satta information?', 'Information about Alwar Bazar Satta may be available on various online platforms, including sites such as Lucky Satta. Users should verify information carefully because unofficial results may be inaccurate.', 46, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(91, 'game', 3, 'Is Alwar Bazar Satta legal?', 'The legality of gambling and betting activities depends on applicable Indian laws and state-specific regulations. Users should check the laws in their location before participating.', 47, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(92, 'game', 3, 'Does Lucky Satta guarantee Alwar Bazar Satta results?', 'No. Lucky Satta does not guarantee any Alwar Bazar Satta result, prediction, or financial return. Results published online should be treated as informational and independently verified.', 48, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(93, 'game', 3, 'Can previous Alwar Bazar Satta results predict future results?', 'Past results cannot reliably determine future outcomes. Any claim that a particular number is guaranteed to win should be approached with caution.', 49, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(94, 'game', 3, 'What precautions should users take when viewing Alwar Bazar Satta content?', 'Users should protect personal information, avoid sharing passwords or payment details with unknown parties, understand financial risks, and follow all applicable laws and regulations.', 50, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(95, 'game', 3, 'Why do people search for Alwar Bazar Satta?', 'People may search for Alwar Bazar Satta to find general information, historical result records, or discussions related to Satta games. Users should rely on responsible and legally compliant information sources.', 51, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(96, 'game', 4, 'Why is Gwalior City Satta searched online?', 'Gwalior City Satta is searched by people looking for general information, historical records,\r\nand online discussions related to Satta-style games. Information should always be checked\r\nagainst reliable sources.', 52, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(97, 'game', 4, 'What makes Gwalior City Satta different from other local Satta searches?', 'The name Gwalior City Satta is primarily associated with searches focused on the Gwalior\r\nregion. However, the terminology and result formats used online can differ between sources.', 53, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(98, 'game', 4, 'Can I find old Gwalior City Satta records online?', 'Historical records may be published on different websites, but their accuracy is not always\r\nguaranteed. Users should compare information rather than assuming every online record is\r\nauthentic.', 54, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(99, 'game', 4, 'How does Lucky Satta present Gwalior City Satta information?', 'Lucky Satta can present Gwalior City Satta-related information in an easy-to-read format for\r\nusers searching for general reference material. Such content should not be interpreted as a\r\nguarantee of future results.', 55, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(100, 'game', 4, 'Are Gwalior City Satta numbers predictable?', 'There is no reliable method for guaranteeing future numbers. Previous results and patterns\r\ncannot ensure a particular future outcome.', 56, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(101, 'game', 4, 'What should I check before using a Gwalior City Satta website?', 'Check the website\'s credibility, privacy practices, applicable laws, and whether it clearly\r\nexplains the risks involved. Avoid websites or individuals asking for unnecessary personal or\r\nfinancial information.', 57, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(102, 'game', 4, 'Is Lucky Satta responsible for any financial loss from Gwalior City Satta?', 'Users should understand that informational content does not guarantee winnings or financial\r\noutcomes. Any gambling-related decision carries risk, and users should comply with\r\napplicable laws and make responsible decisions.', 58, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(103, 'game', 5, 'What does Delhi Bazar mean in Satta related searches?', 'Delhi Bazar is a commonly searched term associated with online Satta and Matka result\r\ninformation. The terminology can vary between websites, so users should verify information\r\ncarefully.', 59, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(104, 'game', 5, 'What is Delhi Satta Bajar?', 'Delhi Satta Bajar is a search phrase used for finding information and historical result records\r\nrelated to Satta-style games associated with Delhi. Users should understand the risks and\r\napplicable laws before participating.', 60, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(105, 'game', 5, 'Can I find Delhi Bazar information on Lucky Satta?', 'Lucky Satta may provide general informational content related to Delhi Bazar, Delhi Satta\r\nBajar, and Delhi Satta King. Users should independently verify information and avoid treating\r\nonline content as a guarantee.', 61, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(106, 'game', 5, 'Are Delhi Satta King results predictable?', 'No. Previous numbers or historical patterns cannot reliably guarantee future outcomes.\r\nClaims of fixed or guaranteed winning numbers should be treated with caution.', 62, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(107, 'game', 5, 'How can users safely browse Delhi Satta Bajar information?', 'Users should protect their personal details, avoid sharing OTPs or banking credentials,\r\ncheck website credibility, and understand the legal and financial risks associated with\r\ngambling-related activities.', 63, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(108, 'game', 5, 'Why are Delhi Bazar and Delhi Satta King popular search terms?', 'These phrases are frequently searched by users looking for Delhi-related Satta information,\r\nhistorical records, and result discussions. Users should rely on responsible information and\r\nfollow all applicable laws.', 64, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(109, 'game', 5, 'What does Delhi Satta King refer to?', 'Delhi Satta King is another commonly used search term for Delhi-related Satta result\r\ninformation. Online claims about results or predictions should not automatically be\r\nconsidered reliable or guaranteed.', 65, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(110, 'game', 7, 'What is Mathura Satta', 'Mathura Satta lucky satta per aata Hai', 66, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(111, 'game', 7, 'What is Mathura Satta?', 'Mathura Satta is a commonly searched phrase related to online Satta and Matka-style\r\nresult information associated with Mathura.', 67, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(112, 'game', 7, 'Where can I find Mathura Satta information?', 'Mathura-related Satta information may be published across different online platforms. Users\r\nshould verify the source, date, and accuracy of any result information before relying on it.', 68, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(113, 'game', 7, 'What does a Mathura Satta result mean?', 'A Mathura Satta result generally refers to numbers or outcome information published for a\r\nSatta-related game. Such results should be independently verified because unofficial\r\nsources may contain errors.', 69, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(114, 'game', 7, 'Can Lucky Satta provide Mathura-related information?', 'Lucky Satta may provide general informational content about Mathura Satta and related\r\nsearch terms. This content should not be considered a guarantee of any future result or\r\nfinancial return.', 70, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(115, 'game', 7, 'Is Mathura Satta legal?', 'The legality of gambling and betting activities depends on applicable Indian laws and\r\nstate-specific regulations. Users should check the rules applicable to their location before\r\nparticipating.', 71, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(116, 'game', 7, 'What should users consider before searching for Mathura Satta?', 'Users should understand the financial risks, protect their personal information, avoid sharing\r\nOTPs or banking credentials, and ensure that any activity they consider is permitted under\r\napplicable laws.', 72, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(117, 'game', 11, 'What is Noida Satta?', 'Noida Satta is a commonly searched term for online information related to Satta and\r\nMatka-style games associated with Noida.', 73, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(118, 'game', 11, 'What does Noida  mean?', 'Noida is a search phrase often used for finding Noida-related Satta information, result\r\nupdates, and historical records published online.', 74, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(119, 'game', 11, 'What is Noida Bazar Satta?', 'Noida Bazar Satta refers to online searches for Satta-related information connected with\r\nNoida Bazar. Different websites may present this information in different formats, so users\r\nshould verify sources carefully.', 75, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(120, 'game', 11, 'Can I find Noida Satta information on Lucky Satta?', 'Lucky Satta may provide general informational content related to Noida Bazar, Noida Satta,\r\nand Noida Bazar Satta. Such information should not be treated as a guarantee of results or\r\nfinancial returns.', 76, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(121, 'game', 11, 'Can old Noida  Satta results predict future numbers?', 'No. Historical results and number patterns cannot reliably determine future outcomes.\r\nClaims about guaranteed numbers or winnings should be treated with caution.', 77, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(122, 'game', 11, 'Is Noida Satta legal?', 'The legality of gambling and betting activities depends on applicable Indian laws and\r\nstate-specific regulations. Users should check the laws relevant to their location before\r\nparticipating.', 78, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39'),
(123, 'game', 11, 'What should users check before searching for Noida Bazar Satta?', 'Users should consider the legal and financial risks, verify the reliability of online information,\r\nprotect personal data, and never share OTPs, passwords, or banking credentials with\r\nunknown parties.', 79, 1, '2026-09-02 08:14:39', '2026-09-02 08:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legacy_id` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `chart_url` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `legacy_id`, `city_id`, `name`, `slug`, `open_time`, `close_time`, `chart_url`, `active`, `display_order`, `created_at`, `updated_at`) VALUES
(2, 'ghaziabad-savera', 3, 'GHAZIABAD SAVERA', 'ghaziabad-savera', '12:30:00', '13:00:00', 'chart.php?game=ghaziabad-savera', 1, 0, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(3, 'alwar-bazar', 4, 'ALWAR BAZAR', 'alwar-bazar', '13:30:00', '14:00:00', 'chart.php?game=alwar-bazar', 1, 1, '2026-08-30 03:32:16', '2026-08-31 14:04:45'),
(4, 'gwalior-city', 5, 'GWALIOR CITY', 'gwalior-city', '14:30:00', '15:00:00', 'chart.php?game=gwalior-city', 1, 2, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(5, 'delhi-bazar', 6, 'DELHI BAZAR', 'delhi-bazar', '15:10:00', '15:40:00', 'chart.php?game=delhi-bazar', 1, 3, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(6, 'shri-ganesh', 7, 'SHRI GANESH', 'shri-ganesh', '16:40:00', '17:10:00', 'chart.php?game=shri-ganesh', 1, 4, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(7, 'mathura', 8, 'MATHURA', 'mathura', '17:30:00', '18:00:00', 'chart.php?game=mathura', 1, 5, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(8, 'faridabad', 9, 'FARIDABAD', 'faridabad', '18:10:00', '18:50:00', 'chart.php?game=faridabad', 1, 6, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(9, 'shri-shyam', 10, 'SHRI SHYAM', 'shri-shyam', '19:30:00', '20:10:00', 'chart.php?game=shri-shyam', 1, 7, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(10, 'gaziyabad', 11, 'GAZIYABAD', 'gaziyabad', '21:30:00', '22:40:00', 'chart.php?game=gaziyabad', 1, 8, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(11, 'noida', 12, 'NOIDA', 'noida', '22:30:00', '23:10:00', 'chart.php?game=noida', 1, 9, '2026-08-30 03:32:16', '2026-08-30 03:32:16'),
(12, 'gali', 13, 'GALI', 'gali', '23:30:00', '01:00:00', 'chart.php?game=gali', 1, 10, '2026-08-30 03:32:16', '2026-08-30 03:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `game_results`
--

CREATE TABLE `game_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `result_date` date NOT NULL,
  `open_panna` varchar(10) DEFAULT NULL,
  `jodi` varchar(10) DEFAULT NULL,
  `close_panna` varchar(10) DEFAULT NULL,
  `result` varchar(20) DEFAULT NULL,
  `source` enum('manual','scraper','import') NOT NULL DEFAULT 'manual',
  `status` enum('pending','published','corrected','cancelled') NOT NULL DEFAULT 'published',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_results`
--

INSERT INTO `game_results` (`id`, `game_id`, `result_date`, `open_panna`, `jodi`, `close_panna`, `result`, `source`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-07-29', NULL, NULL, NULL, '49', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(2, 3, '2026-07-29', NULL, NULL, NULL, '92', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(3, 4, '2026-07-29', NULL, NULL, NULL, '71', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(4, 5, '2026-07-29', NULL, NULL, NULL, '54', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(5, 6, '2026-07-29', NULL, NULL, NULL, '04', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(6, 7, '2026-07-29', NULL, NULL, NULL, '51', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(7, 8, '2026-07-29', NULL, NULL, NULL, '60', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(8, 9, '2026-07-29', NULL, NULL, NULL, '80', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(9, 10, '2026-07-29', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(10, 11, '2026-07-29', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(11, 12, '2026-07-29', NULL, NULL, NULL, '16', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(12, 2, '2026-07-28', NULL, NULL, NULL, '16', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(13, 3, '2026-07-28', NULL, NULL, NULL, '78', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(14, 4, '2026-07-28', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(15, 5, '2026-07-28', NULL, NULL, NULL, '61', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(16, 6, '2026-07-28', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(17, 7, '2026-07-28', NULL, NULL, NULL, '59', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(18, 8, '2026-07-28', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(19, 9, '2026-07-28', NULL, NULL, NULL, '95', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(20, 10, '2026-07-28', NULL, NULL, NULL, '84', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(21, 11, '2026-07-28', NULL, NULL, NULL, '45', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(22, 12, '2026-07-28', NULL, NULL, NULL, '39', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(23, 2, '2026-07-30', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(24, 3, '2026-07-30', NULL, NULL, NULL, '60', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(25, 2, '2026-08-01', NULL, NULL, NULL, '29', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(26, 3, '2026-08-01', NULL, NULL, NULL, '62', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(27, 4, '2026-08-01', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(28, 5, '2026-08-01', NULL, NULL, NULL, '71', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(29, 6, '2026-08-01', NULL, NULL, NULL, '26', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(30, 7, '2026-08-01', NULL, NULL, NULL, '29', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(31, 8, '2026-08-01', NULL, NULL, NULL, '57', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(32, 9, '2026-08-01', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(33, 11, '2026-08-01', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(34, 10, '2026-08-01', NULL, NULL, NULL, '23', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(35, 12, '2026-08-01', NULL, NULL, NULL, '92', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(36, 2, '2026-08-02', NULL, NULL, NULL, '21', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(37, 3, '2026-08-02', NULL, NULL, NULL, '38', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(38, 4, '2026-08-02', NULL, NULL, NULL, '94', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(39, 5, '2026-08-02', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(40, 6, '2026-08-02', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(41, 7, '2026-08-02', NULL, NULL, NULL, '41', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(42, 8, '2026-08-02', NULL, NULL, NULL, '06', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(43, 9, '2026-08-02', NULL, NULL, NULL, '85', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(44, 10, '2026-08-02', NULL, NULL, NULL, '15', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(45, 11, '2026-08-02', NULL, NULL, NULL, '42', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(46, 12, '2026-08-02', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(47, 2, '2026-08-03', NULL, NULL, NULL, '78', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(48, 3, '2026-08-03', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(49, 4, '2026-08-03', NULL, NULL, NULL, '65', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(50, 7, '2026-08-03', NULL, NULL, NULL, '82', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(51, 9, '2026-08-03', NULL, NULL, NULL, '03', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(52, 6, '2026-08-03', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(53, 5, '2026-08-03', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(54, 8, '2026-08-03', NULL, NULL, NULL, '95', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(55, 10, '2026-08-03', NULL, NULL, NULL, '60', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(56, 12, '2026-08-03', NULL, NULL, NULL, '59', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(57, 11, '2026-08-03', NULL, NULL, NULL, '03', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(58, 2, '2026-08-04', NULL, NULL, NULL, '49', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(59, 3, '2026-08-04', NULL, NULL, NULL, '60', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(60, 4, '2026-08-04', NULL, NULL, NULL, '90', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(61, 5, '2026-08-04', NULL, NULL, NULL, '12', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(62, 6, '2026-08-04', NULL, NULL, NULL, '10', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(63, 7, '2026-08-04', NULL, NULL, NULL, '54', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(64, 8, '2026-08-04', NULL, NULL, NULL, '12', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(65, 9, '2026-08-04', NULL, NULL, NULL, '45', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(66, 10, '2026-08-04', NULL, NULL, NULL, '24', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(67, 11, '2026-08-04', NULL, NULL, NULL, '64', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(68, 12, '2026-08-04', NULL, NULL, NULL, '27', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(69, 2, '2026-08-05', NULL, NULL, NULL, '20', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(70, 3, '2026-08-05', NULL, NULL, NULL, '04', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(71, 4, '2026-08-05', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(72, 5, '2026-08-05', NULL, NULL, NULL, '47', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(73, 6, '2026-08-05', NULL, NULL, NULL, '75', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(74, 7, '2026-08-05', NULL, NULL, NULL, '78', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(75, 8, '2026-08-05', NULL, NULL, NULL, '57', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(76, 9, '2026-08-05', NULL, NULL, NULL, '63', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(77, 10, '2026-08-05', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(78, 11, '2026-08-05', NULL, NULL, NULL, '92', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(79, 12, '2026-08-05', NULL, NULL, NULL, '85', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(80, 2, '2026-07-01', NULL, NULL, NULL, '51', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(81, 2, '2026-08-06', NULL, NULL, NULL, '18', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(82, 3, '2026-08-06', NULL, NULL, NULL, '82', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(83, 4, '2026-08-06', NULL, NULL, NULL, '41', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(84, 5, '2026-08-06', NULL, NULL, NULL, '61', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(85, 6, '2026-08-06', NULL, NULL, NULL, '97', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(86, 7, '2026-08-06', NULL, NULL, NULL, '84', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(87, 8, '2026-08-06', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(88, 9, '2026-08-06', NULL, NULL, NULL, '24', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(89, 10, '2026-08-06', NULL, NULL, NULL, '89', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(90, 11, '2026-08-06', NULL, NULL, NULL, '83', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(91, 12, '2026-08-06', NULL, NULL, NULL, '80', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(92, 2, '2026-08-07', NULL, NULL, NULL, '99', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(93, 3, '2026-08-07', NULL, NULL, NULL, '65', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(94, 4, '2026-08-07', NULL, NULL, NULL, '83', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(95, 5, '2026-08-07', NULL, NULL, NULL, '52', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(96, 6, '2026-08-07', NULL, NULL, NULL, '80', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(97, 7, '2026-08-07', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(98, 8, '2026-08-07', NULL, NULL, NULL, '26', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(99, 9, '2026-08-07', NULL, NULL, NULL, '90', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(100, 10, '2026-08-07', NULL, NULL, NULL, '60', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(101, 11, '2026-08-07', NULL, NULL, NULL, '51', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(102, 12, '2026-08-07', NULL, NULL, NULL, '35', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(103, 2, '2026-08-08', NULL, NULL, NULL, '25', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(104, 3, '2026-08-08', NULL, NULL, NULL, '12', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(105, 4, '2026-08-08', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(106, 5, '2026-08-08', NULL, NULL, NULL, '91', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(107, 6, '2026-08-08', NULL, NULL, NULL, '93', 'import', 'published', NULL, NULL, '2026-08-30 03:32:39', '2026-08-30 03:32:39'),
(108, 7, '2026-08-08', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(109, 8, '2026-08-08', NULL, NULL, NULL, '81', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(110, 9, '2026-08-08', NULL, NULL, NULL, '73', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(111, 10, '2026-08-08', NULL, NULL, NULL, '99', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(112, 11, '2026-08-08', NULL, NULL, NULL, '96', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(113, 12, '2026-08-08', NULL, NULL, NULL, '93', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(114, 2, '2026-08-09', NULL, NULL, NULL, '76', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(115, 3, '2026-08-09', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(116, 4, '2026-08-09', NULL, NULL, NULL, '94', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(117, 5, '2026-08-09', NULL, NULL, NULL, '89', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(118, 6, '2026-08-09', NULL, NULL, NULL, '74', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(119, 7, '2026-08-09', NULL, NULL, NULL, '95', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(120, 8, '2026-08-09', NULL, NULL, NULL, '63', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(121, 9, '2026-08-09', NULL, NULL, NULL, '82', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(122, 10, '2026-08-09', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(123, 11, '2026-08-09', NULL, NULL, NULL, '40', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(124, 12, '2026-08-09', NULL, NULL, NULL, '97', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(125, 2, '2026-08-10', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(126, 3, '2026-08-10', NULL, NULL, NULL, '74', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(127, 4, '2026-08-10', NULL, NULL, NULL, '73', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(128, 5, '2026-08-10', NULL, NULL, NULL, '85', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(129, 6, '2026-08-10', NULL, NULL, NULL, '64', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(130, 7, '2026-08-10', NULL, NULL, NULL, '74', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(131, 8, '2026-08-10', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(132, 9, '2026-08-10', NULL, NULL, NULL, '11', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(133, 12, '2026-08-10', NULL, NULL, NULL, '57', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(134, 11, '2026-08-10', NULL, NULL, NULL, '52', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(135, 10, '2026-08-10', NULL, NULL, NULL, '69', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(136, 2, '2026-08-11', NULL, NULL, NULL, '20', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(137, 3, '2026-08-11', NULL, NULL, NULL, '11', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(138, 4, '2026-08-11', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(139, 5, '2026-08-11', NULL, NULL, NULL, '78', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(140, 6, '2026-08-11', NULL, NULL, NULL, '30', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(141, 7, '2026-08-11', NULL, NULL, NULL, '24', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(142, 8, '2026-08-11', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(143, 9, '2026-08-11', NULL, NULL, NULL, '25', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(144, 10, '2026-08-11', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(145, 11, '2026-08-11', NULL, NULL, NULL, '76', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(146, 12, '2026-08-11', NULL, NULL, NULL, '92', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(147, 2, '2026-08-12', NULL, NULL, NULL, '43', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(148, 3, '2026-08-12', NULL, NULL, NULL, '19', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(149, 4, '2026-08-12', NULL, NULL, NULL, '39', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(150, 6, '2026-08-12', NULL, NULL, NULL, '41', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(151, 5, '2026-08-12', NULL, NULL, NULL, '94', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(152, 7, '2026-08-12', NULL, NULL, NULL, '51', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(153, 8, '2026-08-12', NULL, NULL, NULL, '75', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(154, 9, '2026-08-12', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(155, 10, '2026-08-12', NULL, NULL, NULL, '63', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(156, 11, '2026-08-12', NULL, NULL, NULL, '46', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(157, 12, '2026-08-12', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(158, 2, '2026-08-13', NULL, NULL, NULL, '85', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(159, 3, '2026-08-13', NULL, NULL, NULL, '72', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(160, 5, '2026-08-13', NULL, NULL, NULL, '40', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(161, 4, '2026-08-13', NULL, NULL, NULL, '49', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(162, 7, '2026-08-13', NULL, NULL, NULL, '83', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(163, 6, '2026-08-13', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(164, 8, '2026-08-13', NULL, NULL, NULL, '54', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(165, 9, '2026-08-13', NULL, NULL, NULL, '51', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(166, 10, '2026-08-13', NULL, NULL, NULL, '79', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(167, 11, '2026-08-13', NULL, NULL, NULL, '13', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(168, 12, '2026-08-13', NULL, NULL, NULL, '61', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(169, 2, '2026-08-14', NULL, NULL, NULL, '79', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(170, 3, '2026-08-14', NULL, NULL, NULL, '45', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(171, 4, '2026-08-14', NULL, NULL, NULL, '04', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(172, 5, '2026-08-14', NULL, NULL, NULL, '69', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(173, 6, '2026-08-14', NULL, NULL, NULL, '02', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(174, 7, '2026-08-14', NULL, NULL, NULL, '62', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(175, 8, '2026-08-14', NULL, NULL, NULL, '49', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(176, 9, '2026-08-14', NULL, NULL, NULL, '04', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(177, 12, '2026-08-14', NULL, NULL, NULL, '71', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(178, 11, '2026-08-14', NULL, NULL, NULL, '85', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(179, 10, '2026-08-14', NULL, NULL, NULL, '38', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(180, 2, '2026-08-15', NULL, NULL, NULL, '15', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(181, 3, '2026-08-15', NULL, NULL, NULL, '05', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(182, 4, '2026-08-15', NULL, NULL, NULL, '96', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(183, 5, '2026-08-15', NULL, NULL, NULL, '10', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(184, 6, '2026-08-15', NULL, NULL, NULL, '23', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(185, 7, '2026-08-15', NULL, NULL, NULL, '59', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(186, 8, '2026-08-15', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(187, 9, '2026-08-15', NULL, NULL, NULL, '86', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(188, 10, '2026-08-15', NULL, NULL, NULL, '40', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(189, 11, '2026-08-15', NULL, NULL, NULL, '69', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(190, 12, '2026-08-15', NULL, NULL, NULL, '71', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(191, 2, '2026-08-16', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(192, 3, '2026-08-16', NULL, NULL, NULL, '96', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(193, 4, '2026-08-16', NULL, NULL, NULL, '57', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(194, 5, '2026-08-16', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(195, 6, '2026-08-16', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(196, 7, '2026-08-16', NULL, NULL, NULL, '37', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(197, 8, '2026-08-16', NULL, NULL, NULL, '90', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(198, 9, '2026-08-16', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(199, 10, '2026-08-16', NULL, NULL, NULL, '99', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(200, 11, '2026-08-16', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(201, 12, '2026-08-16', NULL, NULL, NULL, '59', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(202, 2, '2026-08-17', NULL, NULL, NULL, '09', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(203, 3, '2026-08-17', NULL, NULL, NULL, '82', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(204, 4, '2026-08-17', NULL, NULL, NULL, '21', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(205, 5, '2026-08-17', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(206, 6, '2026-08-17', NULL, NULL, NULL, '12', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(207, 7, '2026-08-17', NULL, NULL, NULL, '90', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(208, 9, '2026-08-17', NULL, NULL, NULL, '76', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(209, 8, '2026-08-17', NULL, NULL, NULL, '46', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(210, 10, '2026-08-17', NULL, NULL, NULL, '20', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(211, 11, '2026-08-17', NULL, NULL, NULL, '96', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(212, 12, '2026-08-17', NULL, NULL, NULL, '15', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(213, 2, '2026-08-18', NULL, NULL, NULL, '92', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(214, 3, '2026-08-18', NULL, NULL, NULL, '41', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(215, 4, '2026-08-18', NULL, NULL, NULL, '37', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(216, 5, '2026-08-18', NULL, NULL, NULL, '01', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(217, 6, '2026-08-18', NULL, NULL, NULL, '87', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(218, 7, '2026-08-18', NULL, NULL, NULL, '24', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(219, 8, '2026-08-18', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(220, 9, '2026-08-18', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(221, 10, '2026-08-18', NULL, NULL, NULL, '32', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(222, 11, '2026-08-18', NULL, NULL, NULL, '67', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(223, 12, '2026-08-18', NULL, NULL, NULL, '88', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(224, 2, '2026-08-19', NULL, NULL, NULL, '78', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(225, 3, '2026-08-19', NULL, NULL, NULL, '30', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(226, 4, '2026-08-19', NULL, NULL, NULL, '48', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(227, 5, '2026-08-19', NULL, NULL, NULL, '05', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(228, 6, '2026-08-19', NULL, NULL, NULL, '02', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(229, 7, '2026-08-19', NULL, NULL, NULL, '72', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(230, 8, '2026-08-19', NULL, NULL, NULL, '59', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(231, 9, '2026-08-19', NULL, NULL, NULL, '68', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(232, 10, '2026-08-19', NULL, NULL, NULL, '58', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(233, 11, '2026-08-19', NULL, NULL, NULL, '13', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(234, 12, '2026-08-19', NULL, NULL, NULL, '56', 'import', 'published', NULL, NULL, '2026-08-30 03:32:40', '2026-08-30 03:32:40'),
(235, 2, '2026-08-20', NULL, NULL, NULL, '31', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(236, 3, '2026-08-20', NULL, NULL, NULL, '99', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(237, 4, '2026-08-20', NULL, NULL, NULL, '76', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(238, 5, '2026-08-20', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(239, 6, '2026-08-20', NULL, NULL, NULL, '12', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(240, 7, '2026-08-20', NULL, NULL, NULL, '35', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(241, 8, '2026-08-20', NULL, NULL, NULL, '91', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(242, 9, '2026-08-20', NULL, NULL, NULL, '13', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(243, 10, '2026-08-20', NULL, NULL, NULL, '22', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(244, 11, '2026-08-20', NULL, NULL, NULL, '82', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(245, 12, '2026-08-20', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(246, 2, '2026-08-21', NULL, NULL, NULL, '36', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(247, 3, '2026-08-21', NULL, NULL, NULL, '86', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(248, 4, '2026-08-21', NULL, NULL, NULL, '52', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(249, 5, '2026-08-21', NULL, NULL, NULL, '35', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(250, 6, '2026-08-21', NULL, NULL, NULL, '93', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(251, 7, '2026-08-21', NULL, NULL, NULL, '87', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(252, 8, '2026-08-21', NULL, NULL, NULL, '34', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(253, 9, '2026-08-21', NULL, NULL, NULL, '49', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(254, 10, '2026-08-21', NULL, NULL, NULL, '50', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(255, 11, '2026-08-21', NULL, NULL, NULL, '53', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(256, 2, '2026-08-23', NULL, NULL, NULL, 'ee', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(257, 4, '2026-08-28', NULL, NULL, NULL, '76', 'import', 'published', NULL, NULL, '2026-08-30 03:32:41', '2026-08-30 03:32:41'),
(258, 3, '2026-08-30', '123', '45', '678', '45', 'manual', 'published', 1, 1, '2026-08-30 04:24:21', '2026-08-30 04:24:21'),
(259, 2, '2026-08-30', 'e', 'ed', 'dd', 'dd', 'manual', 'published', 1, 1, '2026-08-30 05:21:26', '2026-08-30 05:21:26'),
(260, 2, '2026-08-31', NULL, '22', NULL, '22', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(261, 3, '2026-08-31', NULL, '42', NULL, '42', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(262, 5, '2026-08-31', NULL, '14', NULL, '14', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(263, 6, '2026-08-31', NULL, '81', NULL, '81', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(264, 7, '2026-08-31', NULL, '28', NULL, '28', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(265, 8, '2026-08-31', NULL, '41', NULL, '41', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(266, 9, '2026-08-31', NULL, '26', NULL, '26', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(267, 10, '2026-08-31', NULL, '11', NULL, '11', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:20', '2026-08-31 13:43:52'),
(268, 11, '2026-08-31', NULL, '01', NULL, '01', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:21', '2026-08-31 13:43:52'),
(269, 12, '2026-08-31', NULL, '21', NULL, '21', 'scraper', 'published', NULL, 1, '2026-08-31 03:27:21', '2026-08-31 13:43:52'),
(270, 2, '2026-09-01', NULL, '22', NULL, '22', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(271, 3, '2026-09-01', NULL, '42', NULL, '42', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(272, 5, '2026-09-01', NULL, '14', NULL, '14', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(273, 6, '2026-09-01', NULL, '81', NULL, '81', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(274, 7, '2026-09-01', NULL, '28', NULL, '28', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(275, 8, '2026-09-01', NULL, '41', NULL, '41', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(276, 9, '2026-09-01', NULL, '26', NULL, '26', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(277, 10, '2026-09-01', NULL, '11', NULL, '11', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(278, 11, '2026-09-01', NULL, '01', NULL, '01', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56'),
(279, 12, '2026-09-01', NULL, '21', NULL, '21', 'scraper', 'published', NULL, NULL, '2026-09-01 00:40:56', '2026-09-01 00:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `game_seo_contents`
--

CREATE TABLE `game_seo_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khaiwals`
--

CREATE TABLE `khaiwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legacy_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `top_header` text DEFAULT NULL,
  `cta_text` text DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `schedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schedule`)),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khaiwals`
--

INSERT INTO `khaiwals` (`id`, `legacy_id`, `name`, `top_header`, `cta_text`, `whatsapp`, `telegram`, `schedule`, `active`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'kh_3', 'REDDY BHAI KHAIWAL', 'सीधे सट्टा कंपनी का No 1 खाईवाल', 'Game Play करने के लिये नीचे लिंक पर क्लिक करे', '+917206223202', 'https://t.me', '[\"\\u23f0 \\u0917\\u093e\\u095b\\u093f\\u092f\\u093e\\u092c\\u093e\\u0926 \\u0938\\u0935\\u0947\\u0930\\u093e ------------------ 12:20 PM\",\"\\u23f0 \\u0905\\u0932\\u0935\\u0930 \\u092c\\u093e\\u091c\\u093e\\u0930---------------------- 01:20 PM\",\"\\u23f0 \\u0917\\u094d\\u0935\\u093e\\u0932\\u093f\\u092f\\u0930 \\u0938\\u093f\\u091f\\u0940--------------------- 02:20 PM\",\"\\u23f0 \\u0926\\u093f\\u0932\\u094d\\u0932\\u0940 \\u092c\\u093e\\u091c\\u093e\\u0930 ----------------------- 2:50 PM\",\"\\u23f0 \\u0936\\u094d\\u0930\\u0940 \\u0917\\u0923\\u0947\\u0936 -------------------------- 4:20 PM\",\"\\u23f0 \\u092e\\u0925\\u0941\\u0930\\u093e----------------------------- 5:25 PM\",\"\\u23f0 \\u092b\\u0930\\u0940\\u0926\\u093e\\u092c\\u093e\\u0926 ------------------------- 5:50 PM\",\"\\u23f0 \\u0936\\u094d\\u0930\\u0940 \\u0936\\u094d\\u092f\\u093e\\u092e --------------------------- 7:15 PM\",\"\\u23f0 \\u0917\\u093e\\u095b\\u093f\\u092f\\u093e\\u092c\\u093e\\u0926 ------------------------ 8:45 PM\",\"\\u23f0 \\u0928\\u094b\\u090f\\u0921\\u093e---------------------------- 10:15 PM\",\"\\u23f0 \\u0917\\u0932\\u0940 ------------------------------ 11:10 PM\",\"\\u23f0 \\u0926\\u093f\\u0938\\u093e\\u0935\\u0930 -------------------------- 01:30 AM\"]', 1, 0, '2026-09-01 00:50:51', '2026-09-01 00:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_30_051949_create_permission_tables', 1),
(5, '2026_08_30_052039_create_cities_table', 1),
(6, '2026_08_30_052041_create_games_table', 1),
(7, '2026_08_30_052043_create_game_results_table', 1),
(8, '2026_08_30_052045_create_blogs_table', 1),
(9, '2026_08_30_052046_create_faqs_table', 1),
(10, '2026_08_30_052048_create_game_seo_contents_table', 1),
(11, '2026_08_30_052050_create_seo_blocks_table', 1),
(12, '2026_08_30_052051_create_seo_metas_table', 1),
(14, '2026_08_30_052055_create_social_channels_table', 1),
(15, '2026_08_30_052056_create_forum_posts_table', 1),
(17, '2026_08_30_052100_create_scraper_runs_table', 1),
(18, '2026_08_30_052106_create_activity_logs_table', 1),
(19, '2026_08_30_052124_create_user_cities_table', 1),
(20, '2026_08_30_162107_create_chart_weeks_table', 2),
(21, '2026_08_30_162112_create_chart_entries_table', 2),
(22, '2026_08_31_072409_create_scraper_sources_table', 3),
(23, '2026_08_31_072909_add_scraper_source_id_to_scraper_runs_table', 4),
(24, '2026_08_31_075659_add_scraper_statistics_to_scraper_runs_table', 5),
(25, '2026_08_31_084745_add_scraper_fields_to_scraper_runs_table', 6),
(26, '2026_08_31_190015_add_chart_url_to_games_table', 7),
(27, '2026_08_30_052058_create_settings_table', 8),
(28, '2026_08_30_052053_create_khaiwals_table', 9),
(29, '2026_09_01_064107_create_seo_contents_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(2, 'results.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(3, 'results.create', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(4, 'results.update', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(5, 'results.delete', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(6, 'games.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(7, 'games.create', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(8, 'games.update', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(9, 'games.delete', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(10, 'cities.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(11, 'cities.create', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(12, 'cities.update', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(13, 'cities.delete', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(14, 'users.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(15, 'users.create', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(16, 'users.update', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(17, 'users.delete', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(18, 'roles.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(19, 'roles.create', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(20, 'roles.update', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(21, 'roles.delete', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(22, 'permissions.view', 'web', '2026-08-30 01:30:04', '2026-08-30 01:30:04'),
(23, 'permissions.create', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(24, 'permissions.delete', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(25, 'blogs.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(26, 'blogs.create', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(27, 'blogs.update', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(28, 'blogs.delete', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(29, 'blogs.publish', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(30, 'faqs.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(31, 'faqs.create', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(32, 'faqs.update', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(33, 'faqs.delete', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(34, 'seo.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(35, 'seo.create', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(36, 'seo.update', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(37, 'seo.delete', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(38, 'settings.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(39, 'settings.update', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(40, 'scraper.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(41, 'scraper.run', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(42, 'activity-logs.view', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(43, 'permissions.update', 'web', '2026-08-30 06:22:58', '2026-08-30 06:22:58'),
(44, 'charts.view', 'web', '2026-08-30 11:01:52', '2026-08-30 11:01:52'),
(45, 'charts.create', 'web', '2026-08-30 11:01:52', '2026-08-30 11:01:52'),
(46, 'charts.update', 'web', '2026-08-30 11:01:52', '2026-08-30 11:01:52'),
(47, 'charts.delete', 'web', '2026-08-30 11:01:52', '2026-08-30 11:01:52'),
(48, 'scraper.create', 'web', '2026-08-31 02:04:15', '2026-08-31 02:04:15'),
(49, 'scraper.update', 'web', '2026-08-31 02:04:15', '2026-08-31 02:04:15'),
(50, 'scraper.delete', 'web', '2026-08-31 02:04:15', '2026-08-31 02:04:15'),
(51, 'khaiwals.view', 'web', '2026-09-01 01:02:15', '2026-09-01 01:02:15'),
(52, 'khaiwals.create', 'web', '2026-09-01 01:02:15', '2026-09-01 01:02:15'),
(53, 'khaiwals.update', 'web', '2026-09-01 01:02:15', '2026-09-01 01:02:15'),
(54, 'khaiwals.delete', 'web', '2026-09-01 01:02:15', '2026-09-01 01:02:15'),
(55, 'social.view', 'web', '2026-09-02 09:34:29', '2026-09-02 09:34:29'),
(56, 'social.update', 'web', '2026-09-02 09:34:40', '2026-09-02 09:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-08-30 01:30:05', '2026-08-30 01:30:05'),
(2, 'Reader', 'web', '2026-08-30 07:13:10', '2026-08-30 07:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(34, 2),
(35, 1),
(36, 1),
(36, 2),
(37, 1),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scraper_runs`
--

CREATE TABLE `scraper_runs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scraper_source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `started_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  `status` enum('running','success','failed','partial') NOT NULL DEFAULT 'running',
  `games_found` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `games_updated` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `error_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `records_found` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `records_accepted` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `records_rejected` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `records_changed` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scraper_runs`
--

INSERT INTO `scraper_runs` (`id`, `scraper_source_id`, `started_at`, `completed_at`, `status`, `games_found`, `games_updated`, `error_count`, `message`, `created_at`, `updated_at`, `records_found`, `records_accepted`, `records_rejected`, `records_changed`) VALUES
(1, NULL, '2026-08-31 07:46:26', '2026-08-31 02:16:26', 'failed', 0, 0, 1, 'cURL error 28: Operation timed out after 20015 milliseconds with 0 bytes received (see https://curl.se/libcurl/c/libcurl-errors.html) for http://127.0.0.1:8000/admin/scraper/create', '2026-08-31 02:15:39', '2026-08-31 02:16:26', 0, 0, 0, 0),
(2, NULL, '2026-08-31 08:57:16', '2026-08-31 03:27:16', 'failed', 0, 0, 1, 'No supported result layout was found.', '2026-08-31 03:27:05', '2026-08-31 03:27:16', 0, 0, 0, 0),
(3, 2, '2026-08-31 08:57:21', '2026-08-31 03:27:21', 'partial', 0, 0, 0, 'Found 11, accepted 10, rejected 1, changed 10.', '2026-08-31 03:27:16', '2026-08-31 03:27:21', 0, 0, 0, 0),
(4, NULL, '2026-08-31 18:57:28', '2026-08-31 13:27:28', 'failed', 0, 0, 1, 'No supported result layout was found.', '2026-08-31 13:27:00', '2026-08-31 13:27:28', 0, 0, 0, 0),
(5, 2, '2026-08-31 18:57:32', '2026-08-31 13:27:32', 'partial', 0, 0, 0, 'Found 11, accepted 10, rejected 1, changed 8.', '2026-08-31 13:27:28', '2026-08-31 13:27:32', 0, 0, 0, 0),
(6, 2, '2026-08-31 19:13:52', '2026-08-31 13:43:52', 'partial', 0, 0, 0, 'Found 11, accepted 10, rejected 1, changed 0.', '2026-08-31 13:43:46', '2026-08-31 13:43:52', 0, 0, 0, 0),
(7, 2, '2026-08-31 19:14:20', '2026-08-31 13:44:20', 'partial', 0, 0, 0, 'Found 11, accepted 10, rejected 1, changed 0.', '2026-08-31 13:44:17', '2026-08-31 13:44:20', 0, 0, 0, 0),
(8, NULL, '2026-08-31 19:16:24', '2026-08-31 13:46:24', 'failed', 0, 0, 1, 'cURL error 28: Failed to connect to dpbossss.boston port 443 after 10015 ms: Timeout was reached (see https://curl.se/libcurl/c/libcurl-errors.html) for https://dpbossss.boston/', '2026-08-31 13:46:03', '2026-08-31 13:46:24', 0, 0, 0, 0),
(9, 2, '2026-09-01 06:10:56', '2026-09-01 00:40:56', 'partial', 0, 0, 1, 'Found 11, accepted 10, rejected 1, changed 10.', '2026-09-01 00:40:50', '2026-09-01 00:40:56', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `scraper_sources`
--

CREATE TABLE `scraper_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL DEFAULT 'GET',
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`headers`)),
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scraper_sources`
--

INSERT INTO `scraper_sources` (`id`, `name`, `url`, `method`, `headers`, `config`, `active`, `priority`, `created_at`, `updated_at`) VALUES
(2, 'Lucky Sattaa Live', 'https://lucky-sattaa.com', 'GET', NULL, NULL, 1, 0, '2026-08-31 03:26:17', '2026-08-31 03:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `seo_blocks`
--

CREATE TABLE `seo_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_contents`
--

CREATE TABLE `seo_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_contents`
--

INSERT INTO `seo_contents` (`id`, `game_id`, `title`, `content`, `active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 3, 'Alwar', 'Hello', 1, 1, '2026-09-01 01:27:23', '2026-09-01 01:27:23'),
(2, 2, 'd', 'd', 1, 0, '2026-09-01 01:55:40', '2026-09-01 01:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `seo_meta`
--

CREATE TABLE `seo_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seoable_type` varchar(255) NOT NULL,
  `seoable_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `focus_keyword` varchar(255) DEFAULT NULL,
  `secondary_keywords` text DEFAULT NULL,
  `canonical_url` text DEFAULT NULL,
  `robots` varchar(255) NOT NULL DEFAULT 'index,follow',
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `twitter_title` varchar(255) DEFAULT NULL,
  `twitter_description` text DEFAULT NULL,
  `twitter_image` varchar(255) DEFAULT NULL,
  `schema_type` varchar(255) DEFAULT NULL,
  `schema_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_json`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_meta`
--

INSERT INTO `seo_meta` (`id`, `seoable_type`, `seoable_id`, `meta_title`, `meta_description`, `focus_keyword`, `secondary_keywords`, `canonical_url`, `robots`, `og_title`, `og_description`, `og_image`, `twitter_title`, `twitter_description`, `twitter_image`, `schema_type`, `schema_json`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Game', 9, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(2, 'App\\Models\\Game', 10, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(3, 'App\\Models\\Game', 12, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(4, 'App\\Models\\Game', 8, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(5, 'App\\Models\\Game', 2, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(6, 'App\\Models\\Game', 4, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(7, 'App\\Models\\Game', 3, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(8, 'App\\Models\\Game', 7, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(9, 'App\\Models\\Game', 5, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29'),
(10, 'App\\Models\\Game', 11, NULL, NULL, NULL, NULL, NULL, 'index,follow', NULL, NULL, NULL, NULL, NULL, NULL, 'WebPage', NULL, '2026-09-01 01:36:29', '2026-09-01 01:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fE60E4Qh2vVKRoYLGCb7xjCo7N7wObQ9oMOmIXQi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlA3WU9MN0hhWEQ0MGFHWUltUkJVanRUV0pqdTZzUFJESHVielhiWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788361974),
('lEzEFdyuHAwxmpywBzhSz4Cr5thLYD2f7fXfNe2C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1ZMaElrMHdtTzZoRjBmMG01ZDFFY2hPVnNJUnNEd3Y4T1VNaVB0VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1788362063),
('O8yddDunGeDDAb8EM6VX5jQqJ7xcefJIiPHVxNp6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1FJTXVRbk9vN3V1RjgxQVhCTGlkMnVwZ2tpRzVkY3FKR2lTa29LOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788356408),
('q9oWj1LsOwKeSZe6WBNre5PrpQQ5xuMzeOCDNSzl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmhMMFhhRDR3Mm9ubnRocGJ0ZGUzT3dZMXhyWWxYOVg3SFZRT0ZSUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zb2NpYWwiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLnNvY2lhbC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1788362130);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `autoload` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `autoload`, `created_at`, `updated_at`) VALUES
(3, 'scraper.mode', 'live', 'string', 'scraper', 1, '2026-09-01 00:28:14', '2026-09-01 00:28:14'),
(4, 'scraper.target_url', 'https://dpbossss.boston/', 'string', 'scraper', 1, '2026-09-01 00:28:14', '2026-09-01 00:28:14'),
(5, 'scraper.last_run', '2026-09-01 06:10:56', 'string', 'scraper', 1, '2026-09-01 00:28:14', '2026-09-01 00:40:56'),
(6, 'scraper.cron_token', '2f6ecf613d856824ff666310eaac09cd', 'string', 'scraper', 1, '2026-09-01 00:28:14', '2026-09-01 00:28:14'),
(7, 'social.telegram_url', 'http://127.0.0.1:8000/admin/social', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:45:21'),
(8, 'social.whatsapp_url', '', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:38:26'),
(9, 'social.youtube_url', '', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:38:26'),
(10, 'social.instagram_url', '', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:38:26'),
(11, 'social.facebook_url', '', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:38:26'),
(12, 'social.twitter_url', '', 'string', 'social', 1, '2026-09-02 09:38:26', '2026-09-02 09:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `social_channels`
--

CREATE TABLE `social_channels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@localhost.test', NULL, '$2y$12$pidHyK4yedBJcZdOgE73w.SQEBArbb0fT//JuAWTMF9fe5mE4Jui.', 1, NULL, '2026-08-30 01:30:06', '2026-08-30 01:30:06'),
(2, 'Test Staff', 'teststaff@example.com', NULL, '$2y$12$ANEof0gF.bLiJukjYIOETuIc6O7CvERmqCcH6G.rXuVPCrwQ7ovAm', 1, NULL, '2026-08-30 07:47:02', '2026-08-30 07:47:02'),
(3, 't', 'q@gmail.com', NULL, '$2y$12$9nggSxrw0LufmQFLlxBDk.RPonsh8AuikrteNdR5YaB/qLhHI.tWW', 1, NULL, '2026-08-30 07:49:22', '2026-08-30 07:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_cities`
--

CREATE TABLE `user_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_cities`
--

INSERT INTO `user_cities` (`id`, `user_id`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 3, 4, '2026-08-30 07:49:22', '2026-08-30 07:49:22'),
(2, 3, 6, '2026-08-30 07:49:22', '2026-08-30 07:49:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_module_created_at_index` (`module`,`created_at`),
  ADD KEY `activity_logs_record_type_record_id_index` (`record_type`,`record_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_author_id_foreign` (`author_id`),
  ADD KEY `blogs_status_published_at_index` (`status`,`published_at`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `chart_entries`
--
ALTER TABLE `chart_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chart_entries_chart_week_id_result_date_unique` (`chart_week_id`,`result_date`),
  ADD KEY `chart_entries_result_date_index` (`result_date`);

--
-- Indexes for table `chart_weeks`
--
ALTER TABLE `chart_weeks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chart_weeks_game_id_week_start_week_end_unique` (`game_id`,`week_start`,`week_end`),
  ADD KEY `chart_weeks_game_id_week_start_index` (`game_id`,`week_start`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_slug_unique` (`slug`),
  ADD UNIQUE KEY `cities_legacy_id_unique` (`legacy_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_game_id_foreign` (`game_id`),
  ADD KEY `faqs_scope_active_sort_order_index` (`scope`,`active`,`sort_order`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `games_slug_unique` (`slug`),
  ADD UNIQUE KEY `games_legacy_id_unique` (`legacy_id`),
  ADD KEY `games_city_id_foreign` (`city_id`),
  ADD KEY `games_active_display_order_index` (`active`,`display_order`);

--
-- Indexes for table `game_results`
--
ALTER TABLE `game_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game_results_game_id_result_date_unique` (`game_id`,`result_date`),
  ADD KEY `game_results_created_by_foreign` (`created_by`),
  ADD KEY `game_results_updated_by_foreign` (`updated_by`),
  ADD KEY `game_results_result_date_status_index` (`result_date`,`status`);

--
-- Indexes for table `game_seo_contents`
--
ALTER TABLE `game_seo_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_seo_contents_game_id_active_sort_order_index` (`game_id`,`active`,`sort_order`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khaiwals`
--
ALTER TABLE `khaiwals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khaiwals_legacy_id_unique` (`legacy_id`),
  ADD KEY `khaiwals_active_display_order_index` (`active`,`display_order`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `scraper_runs`
--
ALTER TABLE `scraper_runs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scraper_runs_status_started_at_index` (`status`,`started_at`),
  ADD KEY `scraper_runs_scraper_source_id_index` (`scraper_source_id`);

--
-- Indexes for table `scraper_sources`
--
ALTER TABLE `scraper_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scraper_sources_active_priority_index` (`active`,`priority`);

--
-- Indexes for table `seo_blocks`
--
ALTER TABLE `seo_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_blocks_page_type_active_sort_order_index` (`page_type`,`active`,`sort_order`);

--
-- Indexes for table `seo_contents`
--
ALTER TABLE `seo_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_contents_game_id_active_sort_order_index` (`game_id`,`active`,`sort_order`);

--
-- Indexes for table `seo_meta`
--
ALTER TABLE `seo_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_meta_seoable_type_seoable_id_index` (`seoable_type`,`seoable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_group_index` (`group`),
  ADD KEY `settings_autoload_index` (`autoload`);

--
-- Indexes for table `social_channels`
--
ALTER TABLE `social_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_cities`
--
ALTER TABLE `user_cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_cities_user_id_city_id_unique` (`user_id`,`city_id`),
  ADD KEY `user_cities_city_id_foreign` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chart_entries`
--
ALTER TABLE `chart_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=659;

--
-- AUTO_INCREMENT for table `chart_weeks`
--
ALTER TABLE `chart_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `game_results`
--
ALTER TABLE `game_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `game_seo_contents`
--
ALTER TABLE `game_seo_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khaiwals`
--
ALTER TABLE `khaiwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scraper_runs`
--
ALTER TABLE `scraper_runs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scraper_sources`
--
ALTER TABLE `scraper_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seo_blocks`
--
ALTER TABLE `seo_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_contents`
--
ALTER TABLE `seo_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo_meta`
--
ALTER TABLE `seo_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `social_channels`
--
ALTER TABLE `social_channels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_cities`
--
ALTER TABLE `user_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `chart_entries`
--
ALTER TABLE `chart_entries`
  ADD CONSTRAINT `chart_entries_chart_week_id_foreign` FOREIGN KEY (`chart_week_id`) REFERENCES `chart_weeks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chart_weeks`
--
ALTER TABLE `chart_weeks`
  ADD CONSTRAINT `chart_weeks_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `game_results`
--
ALTER TABLE `game_results`
  ADD CONSTRAINT `game_results_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `game_results_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_results_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `game_seo_contents`
--
ALTER TABLE `game_seo_contents`
  ADD CONSTRAINT `game_seo_contents_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scraper_runs`
--
ALTER TABLE `scraper_runs`
  ADD CONSTRAINT `scraper_runs_scraper_source_id_foreign` FOREIGN KEY (`scraper_source_id`) REFERENCES `scraper_sources` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `seo_contents`
--
ALTER TABLE `seo_contents`
  ADD CONSTRAINT `seo_contents_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_cities`
--
ALTER TABLE `user_cities`
  ADD CONSTRAINT `user_cities_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
