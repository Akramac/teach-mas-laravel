-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 12 nov. 2026 à 10:11
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `teach-mas`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Maths', '', '2026-04-19 20:00:00', '2026-04-19 20:00:00'),
(2, 'Physics', '', '2026-04-12 20:00:00', '2026-04-19 20:00:00'),
(3, 'Arabe', '', '2026-04-19 20:00:00', '2026-04-19 20:00:00'),
(4, 'History', '', '2026-04-19 20:00:00', '2026-04-19 20:00:00'),
(5, 'Geography', '', '2026-04-19 20:00:00', '2026-04-19 20:00:00'),
(6, 'English', '', '2026-04-19 20:00:00', '2026-04-19 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_exam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_exam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_screen_record` tinyint(1) NOT NULL,
  `allow_camera_record` tinyint(1) NOT NULL,
  `random_questions` tinyint(1) NOT NULL,
  `no_remake_exam` tinyint(1) NOT NULL,
  `show_results` tinyint(1) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exams`
--

INSERT INTO `exams` (`id`, `title_exam`, `duration_exam`, `allow_screen_record`, `allow_camera_record`, `random_questions`, `no_remake_exam`, `show_results`, `teacher_id`, `created_at`, `updated_at`, `categorie_id`) VALUES
(5, 'Exam 2', '00:15:00', 0, 0, 1, 0, 1, 1, '2026-04-21 11:32:39', '2026-04-21 11:32:39', 4),
(8, 'Exam 8', '00:15:00', 0, 0, 1, 0, 1, 1, '2026-04-27 10:38:01', '2026-04-27 10:38:01', 2),
(9, 'Exam test', '00:15:00', 0, 0, 1, 0, 1, 1, '2026-04-29 08:54:27', '2026-04-29 08:54:27', 1),
(10, 'Exam reprise', '00:15:00', 1, 0, 1, 1, 0, 1, '2026-10-12 12:41:20', '2026-10-13 13:20:06', 1),
(11, 'TEst fonctionnel', '00:15:00', 0, 0, 1, 1, 0, 1, '2026-10-14 12:54:02', '2026-10-14 12:59:19', 1),
(12, 'test multi 1', '00:15:00', 1, 0, 1, 0, 1, 1, '2026-11-11 10:53:00', '2026-11-11 10:53:00', 1),
(13, 'quest 2 long text', '00:15:00', 0, 0, 1, 0, 1, 1, '2026-11-11 11:36:43', '2026-11-11 11:36:43', 2);

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_long_text`
--

CREATE TABLE `exam_question_long_text` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_long_text_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_question_long_text`
--

INSERT INTO `exam_question_long_text` (`id`, `exam_id`, `question_long_text_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(2, 9, 2, '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(3, 11, 3, '2026-10-14 12:54:03', '2026-10-14 12:54:03'),
(4, 13, 4, '2026-11-11 11:36:45', '2026-11-11 11:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_multi_choice`
--

CREATE TABLE `exam_question_multi_choice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_multi_choice_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_question_multi_choice`
--

INSERT INTO `exam_question_multi_choice` (`id`, `exam_id`, `question_multi_choice_id`, `created_at`, `updated_at`) VALUES
(5, 5, 5, '2026-04-21 11:32:40', '2026-04-21 11:32:40'),
(8, 8, 8, '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(9, 9, 9, '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(10, 10, 10, '2026-10-12 12:41:21', '2026-10-12 12:41:21'),
(11, 10, 11, '2026-10-13 12:25:57', '2026-10-13 12:25:57'),
(12, 11, 12, '2026-10-14 12:54:03', '2026-10-14 12:54:03'),
(13, 12, 13, '2026-11-11 10:53:01', '2026-11-11 10:53:01'),
(14, 13, 14, '2026-11-11 11:36:45', '2026-11-11 11:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_span`
--

CREATE TABLE `exam_question_span` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_span_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_question_span`
--

INSERT INTO `exam_question_span` (`id`, `exam_id`, `question_span_id`, `created_at`, `updated_at`) VALUES
(1, 11, 1, '2026-10-14 12:59:19', '2026-10-14 12:59:19');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_tartib`
--

CREATE TABLE `exam_question_tartib` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_tartib_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_question_tartib`
--

INSERT INTO `exam_question_tartib` (`id`, `exam_id`, `question_tartib_id`, `created_at`, `updated_at`) VALUES
(1, 9, 1, '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(2, 10, 2, '2026-10-13 13:20:06', '2026-10-13 13:20:06'),
(3, 11, 3, '2026-10-14 12:54:03', '2026-10-14 12:54:03');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_tawsil`
--

CREATE TABLE `exam_question_tawsil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_tawsil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exam_question_tawsil`
--

INSERT INTO `exam_question_tawsil` (`id`, `exam_id`, `question_tawsil_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(2, 11, 2, '2026-10-14 12:54:03', '2026-10-14 12:54:03');

-- --------------------------------------------------------

--
-- Structure de la table `exam_teacher`
--

CREATE TABLE `exam_teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `footer`
--

CREATE TABLE `footer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_1_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_1_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_1_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_2_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_2_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_2_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_3_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_3_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_3_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_4_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_4_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_4_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_1_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_1_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_1_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_2_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_2_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_2_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_3_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_3_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_3_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_4_title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_4_title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_4_title_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage`
--

CREATE TABLE `homepage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_11` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_12` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(97, '2014_10_12_000000_create_users_table', 1),
(98, '2014_10_12_100000_create_password_resets_table', 1),
(99, '2019_08_19_000000_create_failed_jobs_table', 1),
(100, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(101, '2026_03_30_124210_create_users_table', 1),
(102, '2026_03_30_125805_create_students_table', 1),
(103, '2026_03_30_130623_create_teachers_table', 1),
(104, '2026_03_30_132256_create_exams_table', 1),
(105, '2026_03_30_132739_create_categories_table', 1),
(106, '2026_03_30_133551_create_footer_table', 1),
(107, '2026_03_30_133950_create_homepage_table', 1),
(108, '2026_03_30_135020_create_response_exam_table', 1),
(109, '2026_03_30_140120_create_response_hash_url_exam_table', 1),
(110, '2026_03_31_140452_create_question_long_text_table', 1),
(111, '2026_03_31_140952_create_question_multi_choice_table', 1),
(112, '2026_03_31_141348_create_question_span_table', 1),
(113, '2026_03_31_141806_create_question_tartib_table', 1),
(114, '2026_03_31_142321_create_question_tawsil_table', 1),
(115, '2026_03_31_143150_create_response_question_long_text_table', 1),
(116, '2026_03_31_145221_create_response_question_mutli_choice_table', 1),
(117, '2026_03_31_145902_create_response_question_span_table', 1),
(118, '2026_03_31_150617_create_response_question_tartib_table', 1),
(119, '2026_04_01_125156_create_response_question_tawsil_table', 1),
(120, '2026_04_01_130827_create_exam_question_long_text_table', 1),
(121, '2026_04_01_133139_create_exam_question_multi_choice_table', 1),
(122, '2026_04_01_133524_create_exam_question_span_table', 1),
(123, '2026_04_01_133724_create_exam_question_tartib_table', 1),
(124, '2026_04_01_133942_create_exam_question_tawsil_table', 1),
(125, '2026_04_01_134336_create_exam_teacher_table', 1),
(126, '2026_04_01_135519_create_student_exam_table', 1),
(127, '2026_04_01_135850_create_student_teacher_table', 1),
(128, '2026_04_02_140038_add_categorie_id_to_exams_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question_long_text`
--

CREATE TABLE `question_long_text` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_specific_time` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_long_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_long_text`
--

INSERT INTO `question_long_text` (`id`, `user_id`, `no_specific_time`, `title`, `correct_long_text`, `duration`, `file_url`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'quest 2', 'Goood', '00:00:00', NULL, 5, NULL, '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(2, 1, NULL, 'Question 2', '3.14', '00:00:00', NULL, 4, NULL, '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(3, 1, NULL, 'quest 2', 'Cool', '00:00:00', NULL, 6, NULL, '2026-10-14 12:54:03', '2026-10-14 12:54:03'),
(4, 1, NULL, 'What is lives in sea and earth', 'Oxygen', '00:00:00', NULL, 3, NULL, '2026-11-11 11:36:45', '2026-11-11 11:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `question_multi_choice`
--

CREATE TABLE `question_multi_choice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_single_choice` tinyint(1) DEFAULT NULL,
  `no_specific_time` tinyint(1) DEFAULT NULL,
  `option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_file` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_multi_choice`
--

INSERT INTO `question_multi_choice` (`id`, `user_id`, `title`, `duration`, `is_single_choice`, `no_specific_time`, `option_1`, `correct_option_1`, `option_2`, `correct_option_2`, `option_3`, `correct_option_3`, `option_4`, `correct_option_4`, `option_5`, `correct_option_5`, `option_6`, `correct_option_6`, `file_url`, `points`, `image`, `data_file`, `created_at`, `updated_at`) VALUES
(1, 1, 'Quest 1', '00:00:00', 1, NULL, 'a', NULL, 'b', 'correct', 'c', NULL, 'd', NULL, NULL, NULL, NULL, NULL, NULL, 4, '719624657CPUGPUmetrics.JPG', 'data:image/png;base64,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', '2026-04-21 10:52:04', '2026-04-21 10:52:04'),
(2, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:26:02', '2026-04-21 11:26:02');
INSERT INTO `question_multi_choice` (`id`, `user_id`, `title`, `duration`, `is_single_choice`, `no_specific_time`, `option_1`, `correct_option_1`, `option_2`, `correct_option_2`, `option_3`, `correct_option_3`, `option_4`, `correct_option_4`, `option_5`, `correct_option_5`, `option_6`, `correct_option_6`, `file_url`, `points`, `image`, `data_file`, `created_at`, `updated_at`) VALUES
(3, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:30:28', '2026-04-21 11:30:28'),
(4, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:31:10', '2026-04-21 11:31:10');
INSERT INTO `question_multi_choice` (`id`, `user_id`, `title`, `duration`, `is_single_choice`, `no_specific_time`, `option_1`, `correct_option_1`, `option_2`, `correct_option_2`, `option_3`, `correct_option_3`, `option_4`, `correct_option_4`, `option_5`, `correct_option_5`, `option_6`, `correct_option_6`, `file_url`, `points`, `image`, `data_file`, `created_at`, `updated_at`) VALUES
(5, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:32:40', '2026-04-21 11:32:40'),
(6, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:33:14', '2026-04-21 11:33:14');
INSERT INTO `question_multi_choice` (`id`, `user_id`, `title`, `duration`, `is_single_choice`, `no_specific_time`, `option_1`, `correct_option_1`, `option_2`, `correct_option_2`, `option_3`, `correct_option_3`, `option_4`, `correct_option_4`, `option_5`, `correct_option_5`, `option_6`, `correct_option_6`, `file_url`, `points`, `image`, `data_file`, `created_at`, `updated_at`) VALUES
(7, 1, 'Quest 2', '00:00:00', 0, NULL, '1', 'correct', '2', 'correct', '3', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,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', '2026-04-21 11:34:37', '2026-04-21 11:34:37'),
(8, 1, 'Quest 1', '00:00:00', 1, NULL, 'a', '', 'b', 'correct', 'c', NULL, 'd', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAGQCAYAAAByNR6YAAAAAXNSR0IArs4c6QAAIABJREFUeF7t3Q+UnWddJ/Df895p2mbuhFJAXAxouphWjyiY5k4TENK5Q1kW9IilehYDgoKsghHZBReRPZxVwJVd0SCuIAIrBVdK1aOiS5k7jYBJ56ZBxD/bRjdB6OrhXymZO2mbzrzPeicJ/xpKmr7zzp15P3NOT5sy9/c8v8/v4fDlvve+bwo/BAgQIECAAAEClQqkSqspRoAAAQIECBAgEAKWQ0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA5QwQIECAAAECBCoWELAqBlWOAAECBAgQICBgOQMECBAgQIAAgYoFBKyKQZUjQIAAAQIECAhYzgABAgQIECBAoGIBAatiUOUIECBAgAABAgKWM0CAAAECBAgQqFhAwKoYVDkCBAgQIECAgIDlDBAgQIAAAQIEKhYQsCoGVY4AAQIECBAgIGA5AwQIECBAgACBigUErIpBlSNAgAABAgQICFjOAAECBAgQIECgYgEBq2JQ5QgQIECAAAECApYzQIAAAQIECBCoWEDAqhhUOQIECBAgQICAgOUMECBAgAABAgQqFhCwKgZVjgABAgQIECAgYDkDBAgQIECAAIGKBQSsikGVI0CAAAECBAgIWM4AAQIECBAgQKBiAQGrYlDlCBAgQIAAAQICljNAgAABAgQIEKhYQMCqGFQ5AgQIECBAgICA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IECAAIFGCAhYjRizJgkQIECAAIE6BQSsOrWtRYAAAQIECDRCQMBqxJg1SYAAAQIECNQpIGDVqW0tAgQIECBAoBECAlYjxqxJAgQIECBAoE4BAatObWsRIECAAAECjRAQsBoxZk0SIECAAAECdQoIWHVqW4sAAQIECBBohICA1Ygxa5IAAQIECBCoU0DAqlPbWgQIECBAgEAjBASsRoxZkwQIECBAgECdAgJWndrWIkCAAAECBBohIGA1YsyaJECAAAECBOoUELDq1LYWAQIECBAg0AgBAasRY9YkAQIECBAgUKeAgFWntrUIECBAgACBRggIWI0YsyYJECBAgACBOgUErDq1rUWAAAECBAg0QkDAasSYNUmAAAECBAjUKSBg1altLQIECBAgQKARAgJWI8asSQIECBAgQKBOAQGrTm1rESBAgAABAo0QELAaMWZNEiBAgAABAnUKCFh1aluLAAECBAgQaISAgNWIMWuSAAECBAgQqFNAwKpT21oECBAgQIBAIwQErEaMWZMECBAgQIBAnQICVp3a1iJAgAABAgQaISBgNWLMmiRAgAABAgTqFBCw6tS2FgECBAgQINAIAQGrEWPWJAECBAgQIFCngIBVp7a1CBAgQIAAgUYICFiNGLMmCRAgQIAAgToFBKw6ta1FgAABAgQINEJAwGrEmDVJgAABAgQI1CkgYNWpbS0CBAgQIECgEQICViPGrEkCBAgQIECgTgEBq05taxEgQIAAAQKNEBCwGjFmTRIgQIAAAQJ1CghYdWpbiwABAgQIEGiEwP8Hnow4GH6qwpMAAAAASUVORK5CYII=', '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(9, 1, 'Question 1', '00:00:00', 1, NULL, 'a', NULL, 'b', 'correct', 'c', NULL, 'd', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAGQCAYAAAByNR6YAAAAAXNSR0IArs4c6QAAE9RJREFUeF7t1jERAAAIAzHq3zQmfgwCOuQYfucIECBAgAABAgRSgaVrxggQIECAAAECBE5geQICBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEBBYfoAAAQIECBAgEAsIrBjUHAECBAgQIEBAYPkBAgQIECBAgEAsILBiUHMECBAgQIAAAYHlBwgQIECAAAECsYDAikHNESBAgAABAgQElh8gQIAAAQIECMQCAisGNUeAAAECBAgQEFh+gAABAgQIECAQCwisGNQcAQIECBAgQEBg+QECBAgQIECAQCwgsGJQcwQIECBAgAABgeUHCBAgQIAAAQKxgMCKQc0RIECAAAECBASWHyBAgAABAgQIxAICKwY1R4AAAQIECBAQWH6AAAECBAgQIBALCKwY1BwBAgQIECBAQGD5AQIECBAgQIBALCCwYlBzBAgQIECAAAGB5QcIECBAgAABArGAwIpBzREgQIAAAQIEBJYfIECAAAECBAjEAgIrBjVHgAABAgQIEHiQ3wGRibhsvwAAAABJRU5ErkJggg==', '2026-04-29 08:54:27', '2026-04-29 08:54:27'),
(10, 1, 'Quest 1', '00:00:00', 0, NULL, '1', NULL, '2', NULL, '3', NULL, '4', NULL, '1111111', NULL, '1111111', NULL, NULL, 4, NULL, NULL, '2026-10-12 12:41:20', '2026-10-13 13:20:06'),
(11, 1, 'Quest 1', '00:00:00', 0, NULL, '1', NULL, '2', NULL, '3', NULL, '4', NULL, '221', NULL, '221', NULL, NULL, 4, NULL, NULL, '2026-10-13 12:25:57', '2026-10-13 13:20:06'),
(12, 1, 'Qu1', '00:00:00', 1, NULL, 'a', NULL, 'b', 'correct', 'c', NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 7, NULL, NULL, '2026-10-14 12:54:03', '2026-10-14 12:55:57');
INSERT INTO `question_multi_choice` (`id`, `user_id`, `title`, `duration`, `is_single_choice`, `no_specific_time`, `option_1`, `correct_option_1`, `option_2`, `correct_option_2`, `option_3`, `correct_option_3`, `option_4`, `correct_option_4`, `option_5`, `correct_option_5`, `option_6`, `correct_option_6`, `file_url`, `points`, `image`, `data_file`, `created_at`, `updated_at`) VALUES
(13, 1, 'Qa 1', '00:00:00', 1, NULL, 'a', NULL, 'b', 'correct', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 'data:image/png;base64,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AgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwIELHdmSScIIIAAAgggYIkAAcuSQVAGAggggAACCLgjQMByZ5Z0ggACCCCAAAKWCBCwLBkEZSCAAAIIIICAOwL/H6BQgDZw7gGxAAAAAElFTkSuQmCC', '2026-11-11 10:53:01', '2026-11-11 10:53:01'),
(14, 1, 'Q1', '00:00:00', 0, NULL, '1', 'correct', '2', NULL, '3', NULL, '4', 'correct', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAGQCAYAAAByNR6YAAAAAXNSR0IArs4c6QAAIABJREFUeF7t3X9spdl5F/Bz3mvP9czYGxJoqERaQUSrEkga1Pg6u0JlMtfZqkmhLWQjIlGkRFClf4BECsrSJOykSekshS0SKkT9o5EAKdVuKCFqgtj1nR0QymauU5FuS4tKFVAJEk3TbLK2Z3w9vu+B99qzO5vM7tqex/b98RlpdW3P+z7nnM95Vverc73v5uQPAQIECBAgQIBAqEAOraYYAQIECBAgQIBAErA0AQECBAgQIEAgWEDACgZVjgABAgQIECAgYOkBAgQIECBAgECwgIAVDKocAQIECBAgQEDA0gMECBAgQIAAgWABASsYVDkCBAgQIECAgIClBwgQIECAAAECwQICVjCocgQIECBAgAABAUsPECBAgAABAgSCBQSsYFDlCBAgQIAAAQIClh4gQIAAAQIECAQLCFjBoMoRIECAAAECBAQsPUCAAAECBAgQCBYQsIJBlSNAgAABAgQICFh6gAABAgQIECAQLCBgBYMqR4AAAQIECBAQsPQAAQIECBAgQCBYQMAKBlWOAAECBAgQICBg6QECBAgQIECAQLCAgBUMqhwBAgQIECBAQMDSAwQIECBAgACBYAEBKxhUOQIECBAgQICAgKUHCBAgQIAAAQLBAgJWMKhyBAgQIECAAAEBSw8QIECAAAECBIIFBKxgUOUIECBAgAABAgKWHiBAgAABAgQIBAsIWMGgyhEgQIAAAQIEBCw9QIAAAQIECBAIFhCwgkGVI0CAAAECBAgIWHqAAAECBAgQIBAsIGAFgypHgAABAgQIEBCw9AABAgQIECBAIFhAwAoGVY4AAQIECBAgIGDpAQIECBAgQIBAsICAFQyqHAECBAgQIEBAwNIDBAgQIECAAIFgAQErGFQ5AgQIECBAgICApQcIECBAgAABAsECAlYwqHIECBAgQIAAAQFLDxAgQIAAAQIEggUErGBQ5QgQIECAAAECApYeIECAAAECBAgECwhYwaDKESBAgAABAgQELD1AgAABAgQIEAgWELCCQZUjQIAAAQIECAhYeoAAAQIECBAgECwgYAWDKkeAAAECBAgQELD0AAECBAgQIEAgWEDACgZVjgABAgQIECAgYOkBAgQIECBAgECwgIAVDKocAQIECBAgQEDA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AAECBAgQCBYQsIJBlSNAgAABAgQICFh6gAABAgQIECAQLCBgBYMqR4AAAQIECBAQsPQAAQIECBAgQCBYQMAKBlWOAAECBAgQICBg6QECBAgQIECAQLCAgBUMqhwBAgQIECBAQMDSAwQIECBAgACBYAEBKxhUOQIECBAgQICAgKUHCBAgQIAAAQLBAgJWMKhyBAgQIECAAAEBSw8QIECAAAECBIIFBKxgUOUIECBAgAABAgKWHiBAgAABAgQIBAsIWMGgyhEgQIAAAQIEBCw9QIAAAQIECBAIFhCwgkGVI0CAAAECBAgIWHqAAAECBAgQIBAsIGAFgypHgAABAgQIEBCw9AABAgQIECBAIFhAwAoGVY4AAQIECBAgIGDpAQIECBAgQIBAsICAFQyqHAECBAgQIEBAwNIDBAgQIECAAIFgAQErGFQ5AgQIECBAgICApQcIECBAgAABAsECAlYwqHIECBAgQIAAAQFLDxAgQIAAAQIEggUErGBQ5QgQIECAAAECApYeIECAAAECBAgECwhYwaDKESBAgAABAgQELD1AgAABAgQIEAgWELCCQZUjQIAAAQIECAhYeoAAAQIECBAgECwgYAWDKkeAAAECBAgQELD0AAECBAgQIEAgWEDACgZVjgABAgQIECAgYOkBAgQIECBAgECwgIAVDKocAQIECBAgQEDA0gMECBAgQIAAgWABASsYVDkCBAgQIECAgIClBwgQIECAAAECwQICVjCocgQIECBAgAABAUsPECBAgAABAgSCBQSsYFDlCBAgQIAAAQIClh4gQIAAAQIECAQLCFjBoMoRIECAAAECBAQsPUCAAAECBAgQCBYQsIJBlSNAgAABAgQICFh6gAABAgQIECAQLCBgBYMqR4AAAQIECBAQsPQAAQIECBAgQCBYQMAKBlWOAAECBAgQICBg6QECBAgQIECAQLCAgBUMqhwBAgQIECBAQMDSAwQIECBAgACBYAEBKxhUOQIECBAgQICAgKUHCBAgQIAAAQLBAgJWMKhyBAgQIECAAAEBSw8QIECAAAECBIIFBKxgUOUIECBAgAABAgKWHiBAgAABAgQIBAsIWMGgyhEgQIAAAQIEBCw9QIAAAQIECBAIFhCwgkGVI0CAAAECBAgIWHqAAAECBAgQIBAsIGAFgypHgAABAgQIEBCw9AABAgQIECBAIFhAwAoGVY4AAQIECBAgIGDpAQIECBAgQIBAsICAFQyqHAECBAgQIEBAwNIDBAgQIECAAIFgAQErGFQ5AgQIECBAgICApQcIECBAgAABAsECAlYwqHIECBAgQIAAAQFLDxAgQIAAAQIEggUErGBQ5QgQIECAAAECApYeIECAAAECBAgECwhYwaDKESBAgAABAgQELD1AgAA3otz9AAAEZElEQVQBAgQIEAgWELCCQZUjQIAAAQIECAhYeoAAAQIECBAgECwgYAWDKkeAAAECBAgQELD0AAECBAgQIEAgWEDACgZVjgABAgQIECAgYOkBAgQIECBAgECwgIAVDKocAQIECBAgQEDA0gMECBAgQIAAgWABASsYVDkCBAgQIECAgIClBwgQIECAAAECwQICVjCocgQIECBAgAABAUsPECBAgAABAgSCBQSsYFDlCBAgQIAAAQIClh4gQIAAAQIECAQLCFjBoMoRIECAAAECBAQsPUCAAAECBAgQCBYQsIJBlSNAgAABAgQICFh6gAABAgQIECAQLCBgBYMqR4AAAQIECBAQsPQAAQIECBAgQCBYQMAKBlWOAAECBAgQICBg6QECBAgQIECAQLCAgBUMqhwBAgQIECBAQMDSAwQIECBAgACBYAEBKxhUOQIECBAgQICAgKUHCBAgQIAAAQLBAgJWMKhyBAgQIECAAAEBSw8QIECAAAECBIIFBKxgUOUIECBAgAABAgKWHiBAgAABAgQIBAsIWMGgyhEgQIAAAQIEBCw9QIAAAQIECBAIFhCwgkGVI0CAAAECBAgIWHqAAAECBAgQIBAsIGAFgypHgAABAgQIEBCw9AABAgQIECBAIFhAwAoGVY4AAQIECBAgIGDpAQIECBAgQIBAsICAFQyqHAECBAgQIEBAwNIDBAgQIECAAIFgAQErGFQ5AgQIECBAgICApQcIECBAgAABAsECAlYwqHIECBAgQIAAAQFLDxAgQIAAAQIEggUErGBQ5QgQIECAAAECApYeIECAAAECBAgECwhYwaDKESBAgAABAgQELD1AgAABAgQIEAgWELCCQZUjQIAAAQIECAhYeoAAAQIECBAgECwgYAWDKkeAAAECBAgQELD0AAECBAgQIEAgWEDACgZVjgABAgQIECAgYOkBAgQIECBAgECwgIAVDKocAQIECBAgQEDA0gMECBAgQIAAgWABASsYVDkCBAgQIECAgIClBwgQIECAAAECwQICVjCocgQIECBAgAABAUsPECBAgAABAgSCBQSsYFDlCBAgQIAAAQIClh4gQIAAAQIECAQLCFjBoMoRIECAAAECBAQsPUCAAAECBAgQCBYQsIJBlSNAgAABAgQICFh6gAABAgQIECAQLCBgBYMqR4AAAQIECBAQsPQAAQIECBAgQCBYQMAKBlWOAAECBAgQICBg6QECBAgQIECAQLCAgBUMqhwBAgQIECBAQMDSAwQIECBAgACBYAEBKxhUOQIECBAgQICAgKUHCBAgQIAAAQLBAgJWMKhyBAgQIECAAAEBSw8QIECAAAECBIIFBKxgUOUIECBAgAABAgKWHiBAgAABAgQIBAsIWMGgyhEgQIAAAQIEBCw9QIAAAQIECBAIFhCwgkGVI0CAAAECBAgIWHqAAAECBAgQIBAsIGAFgypHgAABAgQIEBCw9AABAgQIECBAIFhAwAoGVY4AAQIECBAg8P8At2+1+u+p9kwAAAAASUVORK5CYII=', '2026-11-11 11:36:45', '2026-11-11 11:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `question_span`
--

CREATE TABLE `question_span` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_specific_time` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `span_text` varchar(1255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_span`
--

INSERT INTO `question_span` (`id`, `user_id`, `no_specific_time`, `title`, `span_text`, `words`, `duration`, `file_url`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Qu5', '<span class=\'w\'>Allo  a poireau me placer ici</span>&nbsp;', ';ici;.', '00:00:00', '<spanclass=\'w\'>Allo  a poireau me placer ici</span>&nbsp;', 3, NULL, '2026-10-14 12:59:19', '2026-10-14 12:59:19');

-- --------------------------------------------------------

--
-- Structure de la table `question_tartib`
--

CREATE TABLE `question_tartib` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_specific_time` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_to_order_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_tartib`
--

INSERT INTO `question_tartib` (`id`, `user_id`, `no_specific_time`, `title`, `duration`, `option_to_order_1`, `option_to_order_2`, `option_to_order_3`, `option_to_order_4`, `option_to_order_5`, `option_to_order_6`, `file_url`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Question 3', '00:00:00', 'a', 'b', 'c', 'd', NULL, NULL, NULL, 4, NULL, '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(2, 1, NULL, 'Question 3', '00:00:00', 'aa', 'bb', 'cc', 'dd', NULL, NULL, NULL, 3, NULL, '2026-10-13 13:20:06', '2026-10-13 13:20:06'),
(3, 1, NULL, 'Qu 3', '00:00:00', '1', '2', '3', '4', NULL, NULL, NULL, 4, NULL, '2026-10-14 12:54:03', '2026-10-14 12:59:19');

-- --------------------------------------------------------

--
-- Structure de la table `question_tawsil`
--

CREATE TABLE `question_tawsil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_specific_time` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_tawsil`
--

INSERT INTO `question_tawsil` (`id`, `user_id`, `no_specific_time`, `title`, `duration`, `option_1`, `link_option_1`, `option_2`, `link_option_2`, `option_3`, `link_option_3`, `option_4`, `link_option_4`, `option_5`, `link_option_5`, `option_6`, `link_option_6`, `file_url`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'quets tawsil 1', '00:00:00', 'a', 'a', 'b', 'c', 'd', 'e', 'f', NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(2, 1, NULL, 'quets tawsil 1', '00:00:00', 'a', 'aa', 'b', 'bb', 'c', 'cc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, '2026-10-14 12:54:03', '2026-10-14 12:54:03');

-- --------------------------------------------------------

--
-- Structure de la table `response_exam`
--

CREATE TABLE `response_exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `show_notes` tinyint(1) DEFAULT NULL,
  `file_screen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `response_exam`
--

INSERT INTO `response_exam` (`id`, `teacher_id`, `student_id`, `exam_id`, `note_by_teacher`, `show_notes`, `file_screen`, `file_video`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 8, NULL, NULL, NULL, NULL, '2026-05-02 08:46:04', '2026-05-02 08:46:04'),
(2, 1, 1, 8, 5, NULL, NULL, NULL, '2026-05-02 08:58:52', '2026-05-04 07:54:36'),
(3, 1, 1, 8, NULL, NULL, NULL, NULL, '2026-05-04 08:05:53', '2026-05-04 08:05:53'),
(4, 1, 1, 8, 6, 1, NULL, NULL, '2026-05-04 08:06:07', '2026-05-06 07:54:32'),
(5, 1, 1, 12, 0, NULL, '6605087892812067.webm', NULL, '2026-11-11 10:54:44', '2026-11-11 10:57:59'),
(6, 1, 1, 12, 5, 1, NULL, NULL, '2026-11-11 10:58:52', '2026-11-11 11:25:17'),
(7, 1, 1, 13, 0, 1, NULL, NULL, '2026-11-11 11:39:34', '2026-11-11 11:41:33');

-- --------------------------------------------------------

--
-- Structure de la table `response_hash_url_exam`
--

CREATE TABLE `response_hash_url_exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `used_once_by_student` tinyint(1) DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `response_hash_url_exam`
--

INSERT INTO `response_hash_url_exam` (`id`, `teacher_id`, `student_id`, `exam_id`, `used_once_by_student`, `hash`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, 8, NULL, '5dQ0GE2DWw', '2026-04-27 10:38:01', '2026-04-27 10:38:01'),
(4, 1, NULL, 9, NULL, '0jDGFq386P', '2026-04-29 08:54:28', '2026-04-29 08:54:28'),
(5, 1, NULL, 10, NULL, 'fjjpOgqcqq', '2026-10-12 12:41:21', '2026-10-12 12:41:21'),
(6, 1, NULL, 10, NULL, 'QokNctlMRi', '2026-10-13 12:25:57', '2026-10-13 12:25:57'),
(7, 1, NULL, 10, NULL, 'hclzph9wxp', '2026-10-13 13:20:06', '2026-10-13 13:20:06'),
(8, 1, NULL, 11, NULL, '9Ppzc395lX', '2026-10-14 12:54:03', '2026-10-14 12:54:03'),
(9, 1, NULL, 11, NULL, '5aLW5Wagv1', '2026-10-14 12:59:19', '2026-10-14 12:59:19'),
(10, 1, NULL, 12, NULL, 'yj6n2CqjSM', '2026-11-11 10:53:01', '2026-11-11 10:53:01'),
(11, 1, NULL, 13, NULL, 'saFcBW0iFH', '2026-11-11 11:36:45', '2026-11-11 11:36:45');

-- --------------------------------------------------------

--
-- Structure de la table `response_question_long_text`
--

CREATE TABLE `response_question_long_text` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_long_id` bigint(20) UNSIGNED NOT NULL,
  `reponse_long_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_long_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `response_question_long_text`
--

INSERT INTO `response_question_long_text` (`id`, `user_id`, `teacher_id`, `student_id`, `exam_id`, `question_long_id`, `reponse_long_text`, `correct_long_text`, `note_by_teacher`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 8, 1, 'Goood', 'Goood', 5, '2026-05-02 08:58:52', '2026-05-04 07:49:37'),
(2, 2, 1, 1, 8, 1, 'Noooo', 'Goood', NULL, '2026-05-04 08:05:52', '2026-05-04 08:05:52'),
(3, 2, 1, 1, 8, 1, 'Noooo', 'Goood', 2, '2026-05-04 08:06:07', '2026-05-06 07:54:32'),
(4, 2, 1, 1, 13, 4, 'oxygen', 'Oxygen', 0, '2026-11-11 11:39:34', '2026-11-11 11:41:33');

-- --------------------------------------------------------

--
-- Structure de la table `response_question_mutli_choice`
--

CREATE TABLE `response_question_mutli_choice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_multi_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_single_choice` tinyint(1) DEFAULT NULL,
  `response_option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `response_question_mutli_choice`
--

INSERT INTO `response_question_mutli_choice` (`id`, `user_id`, `teacher_id`, `student_id`, `exam_id`, `question_multi_id`, `title`, `is_single_choice`, `response_option_1`, `response_option_2`, `response_option_3`, `response_option_4`, `response_option_5`, `response_option_6`, `note_by_teacher`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 8, 8, NULL, NULL, 'b', 'b', 'b', 'b', 'b', 'b', NULL, '2026-05-02 08:46:03', '2026-05-02 08:46:03'),
(2, 2, 1, 1, 8, 8, NULL, NULL, 'd', 'd', 'd', 'd', 'd', 'd', 0, '2026-05-02 08:58:51', '2026-05-04 08:03:42'),
(3, 2, 1, 1, 8, 8, NULL, NULL, 'b', 'b', 'b', 'b', 'b', 'b', NULL, '2026-05-04 08:05:53', '2026-05-04 08:05:53'),
(4, 2, 1, 1, 8, 8, NULL, NULL, 'b', 'b', 'b', 'b', 'b', 'b', 4, '2026-05-04 08:06:07', '2026-05-04 08:09:20'),
(5, 2, 1, 1, 12, 13, NULL, NULL, 'a', 'a', 'a', 'a', 'a', 'a', 0, '2026-11-11 10:54:44', '2026-11-11 10:57:59'),
(6, 2, 1, 1, 12, 13, NULL, NULL, 'b', 'b', 'b', 'b', 'b', 'b', 5, '2026-11-11 10:58:51', '2026-11-11 11:25:15'),
(7, 2, 1, 1, 13, 14, NULL, NULL, '1', '2', NULL, NULL, NULL, NULL, 0, '2026-11-11 11:39:34', '2026-11-11 11:41:33');

-- --------------------------------------------------------

--
-- Structure de la table `response_question_span`
--

CREATE TABLE `response_question_span` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_span_id` bigint(20) UNSIGNED NOT NULL,
  `reponse_span` varchar(1255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_span` varchar(1255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `response_question_tartib`
--

CREATE TABLE `response_question_tartib` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_tartib_id` bigint(20) UNSIGNED NOT NULL,
  `reponse_option_to_order_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_option_to_order_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_option_to_order_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_option_to_order_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_option_to_order_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_option_to_order_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_order_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `response_question_tawsil`
--

CREATE TABLE `response_question_tawsil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_tawsil_id` bigint(20) UNSIGNED NOT NULL,
  `response_option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_option_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_by_teacher` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `response_question_tawsil`
--

INSERT INTO `response_question_tawsil` (`id`, `user_id`, `teacher_id`, `student_id`, `exam_id`, `question_tawsil_id`, `response_option_1`, `correct_option_1`, `response_option_2`, `correct_option_2`, `response_option_3`, `correct_option_3`, `response_option_4`, `correct_option_4`, `response_option_5`, `correct_option_5`, `response_option_6`, `correct_option_6`, `note_by_teacher`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 8, 1, 'b', 'a', 'd', 'b', 'f', 'd', 'a', 'f', '', NULL, NULL, NULL, 0, '2026-05-02 08:58:52', '2026-05-04 07:29:33'),
(2, 2, 1, 1, 8, 1, 'f', 'a', 'b', 'b', 'd', 'd', 'a', 'f', '', NULL, NULL, NULL, NULL, '2026-05-04 08:05:52', '2026-05-04 08:05:52'),
(3, 2, 1, 1, 8, 1, 'f', 'a', 'b', 'b', 'd', 'd', 'a', 'f', '', NULL, NULL, NULL, 0, '2026-05-04 08:06:07', '2026-05-04 08:08:30');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Akram', 'student@gmail.com', 2, '2026-04-29 10:35:18', '2026-04-29 10:35:18'),
(2, 'stu', 'student2@gmail.com', 8, '2026-10-16 13:07:43', '2026-10-16 13:07:43');

-- --------------------------------------------------------

--
-- Structure de la table `student_exam`
--

CREATE TABLE `student_exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `student_exam`
--

INSERT INTO `student_exam` (`id`, `exam_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '2026-04-30 08:07:28', '2026-04-30 08:07:28'),
(2, 12, 1, '2026-11-11 10:53:48', '2026-11-11 10:53:48'),
(3, 13, 1, '2026-11-11 11:38:46', '2026-11-11 11:38:46');

-- --------------------------------------------------------

--
-- Structure de la table `student_teacher`
--

CREATE TABLE `student_teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `student_teacher`
--

INSERT INTO `student_teacher` (`id`, `teacher_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-04-30 08:10:15', '2026-04-30 08:10:15');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by_admin` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `approved_by_admin`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'teacher', 'teacher@gmail.com', 0, 1, '2026-04-21 10:50:44', '2026-04-21 10:50:44'),
(2, 'teaa', 'teacher3@gmail.com', 0, 4, '2026-10-16 12:55:21', '2026-10-16 12:55:21'),
(3, 'teeta', 'etacher5@gmail.com', 0, 7, '2026-10-16 13:07:21', '2026-10-16 13:07:21');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verified` tinyint(1) DEFAULT NULL,
  `user_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `first_name`, `last_name`, `verification_key`, `is_email_verified`, `user_level`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'teacher', 'teacher@gmail.com', '$2y$10$xPe2hoRAL35mtyN3qfegROb4vemOLJ3Js1u4J8z6ODF3c4pETy1Ti', NULL, NULL, 'MVHK71VwocZMYQSopJSu', NULL, 'ROLE_TEACHER', '1793785688_Photo_moi_2025.JPG', '2026-04-21 10:50:44', '2026-11-04 08:48:08', NULL),
(2, 'Akram', 'student@gmail.com', '$2y$10$/bkDAny52RaZAB0D8qBFhe/crGAPqGWLDujf85KcfohW6dDGbs9t6', NULL, NULL, 'sLgjEWJxN6Q1DhM0hz6C', NULL, 'ROLE_STUDENT', NULL, '2026-04-29 10:35:18', '2026-04-29 10:35:18', NULL),
(3, 'Tea', 'teacher2@gmail.com', '$2y$10$k2ImTCTlbOWC/XIoCLTrbuSPjCmIfrztAVC4NdBiEJ.JLqt5aMjoy', NULL, NULL, 'mOOdNfm1VVEXMJGxBFxp', NULL, '', NULL, '2026-10-16 12:51:48', '2026-10-16 12:51:48', NULL),
(4, 'teaa', 'teacher3@gmail.com', '$2y$10$A3iMDizv09NESTFLZj9w2ezZmnjqi3UA08pfK.vHh4FJVFuCsdlnC', NULL, NULL, 'pcLaoQOHVPf9bIfKnSDO', NULL, 'ROLE_TEACHER', NULL, '2026-10-16 12:55:21', '2026-10-16 12:55:21', NULL),
(5, 'tea4', 'teacher4@gmail.com', '$2y$10$tdm5ll2srGuk0VehBv6xxeKgxGAW36WrpHcj1GS1vcPKnbNq56p8m', NULL, NULL, 'Gp20P7zcT8E7rtuMqHdJ', NULL, '', NULL, '2026-10-16 13:00:55', '2026-10-16 13:00:55', NULL),
(7, 'teeta', 'etacher5@gmail.com', '$2y$10$B.gFRkdzfc5yWTdaACDIxOsCKrMSvMJzXZnu2h/BU5Pb...JshuDG', NULL, NULL, '2GWaXpXvLISFeNPTEcUF', NULL, 'ROLE_TEACHER', NULL, '2026-10-16 13:07:21', '2026-10-16 13:07:21', NULL),
(8, 'stu', 'student2@gmail.com', '$2y$10$iCSwgop/4seWRBUoiKcOY.PBjHUSrs/wOFcjJUfccyMMkBNy/ueVi', NULL, NULL, 'jjiv09bdO4SYtm7ycFIt', NULL, 'ROLE_STUDENT', NULL, '2026-10-16 13:07:43', '2026-10-16 13:07:43', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_teacher_id_foreign` (`teacher_id`),
  ADD KEY `exams_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `exam_question_long_text`
--
ALTER TABLE `exam_question_long_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_long_text_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_long_text_question_long_text_id_foreign` (`question_long_text_id`);

--
-- Index pour la table `exam_question_multi_choice`
--
ALTER TABLE `exam_question_multi_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_multi_choice_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_multi_choice_question_multi_choice_id_foreign` (`question_multi_choice_id`);

--
-- Index pour la table `exam_question_span`
--
ALTER TABLE `exam_question_span`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_span_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_span_question_span_id_foreign` (`question_span_id`);

--
-- Index pour la table `exam_question_tartib`
--
ALTER TABLE `exam_question_tartib`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_tartib_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_tartib_question_tartib_id_foreign` (`question_tartib_id`);

--
-- Index pour la table `exam_question_tawsil`
--
ALTER TABLE `exam_question_tawsil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_tawsil_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_tawsil_question_tawsil_id_foreign` (`question_tawsil_id`);

--
-- Index pour la table `exam_teacher`
--
ALTER TABLE `exam_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_teacher_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_teacher_teacher_id_foreign` (`teacher_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `question_long_text`
--
ALTER TABLE `question_long_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_long_text_user_id_foreign` (`user_id`);

--
-- Index pour la table `question_multi_choice`
--
ALTER TABLE `question_multi_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_multi_choice_user_id_foreign` (`user_id`);

--
-- Index pour la table `question_span`
--
ALTER TABLE `question_span`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_span_user_id_foreign` (`user_id`);

--
-- Index pour la table `question_tartib`
--
ALTER TABLE `question_tartib`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_tartib_user_id_foreign` (`user_id`);

--
-- Index pour la table `question_tawsil`
--
ALTER TABLE `question_tawsil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_tawsil_user_id_foreign` (`user_id`);

--
-- Index pour la table `response_exam`
--
ALTER TABLE `response_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_exam_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_exam_student_id_foreign` (`student_id`),
  ADD KEY `response_exam_exam_id_foreign` (`exam_id`);

--
-- Index pour la table `response_hash_url_exam`
--
ALTER TABLE `response_hash_url_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_hash_url_exam_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_hash_url_exam_student_id_foreign` (`student_id`),
  ADD KEY `response_hash_url_exam_exam_id_foreign` (`exam_id`);

--
-- Index pour la table `response_question_long_text`
--
ALTER TABLE `response_question_long_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_question_long_text_user_id_foreign` (`user_id`),
  ADD KEY `response_question_long_text_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_question_long_text_student_id_foreign` (`student_id`),
  ADD KEY `response_question_long_text_exam_id_foreign` (`exam_id`),
  ADD KEY `response_question_long_text_question_long_id_foreign` (`question_long_id`);

--
-- Index pour la table `response_question_mutli_choice`
--
ALTER TABLE `response_question_mutli_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_question_mutli_choice_user_id_foreign` (`user_id`),
  ADD KEY `response_question_mutli_choice_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_question_mutli_choice_student_id_foreign` (`student_id`),
  ADD KEY `response_question_mutli_choice_exam_id_foreign` (`exam_id`),
  ADD KEY `response_question_mutli_choice_question_multi_id_foreign` (`question_multi_id`);

--
-- Index pour la table `response_question_span`
--
ALTER TABLE `response_question_span`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_question_span_user_id_foreign` (`user_id`),
  ADD KEY `response_question_span_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_question_span_student_id_foreign` (`student_id`),
  ADD KEY `response_question_span_exam_id_foreign` (`exam_id`),
  ADD KEY `response_question_span_question_span_id_foreign` (`question_span_id`);

--
-- Index pour la table `response_question_tartib`
--
ALTER TABLE `response_question_tartib`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_question_tartib_user_id_foreign` (`user_id`),
  ADD KEY `response_question_tartib_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_question_tartib_student_id_foreign` (`student_id`),
  ADD KEY `response_question_tartib_exam_id_foreign` (`exam_id`),
  ADD KEY `response_question_tartib_question_tartib_id_foreign` (`question_tartib_id`);

--
-- Index pour la table `response_question_tawsil`
--
ALTER TABLE `response_question_tawsil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_question_tawsil_user_id_foreign` (`user_id`),
  ADD KEY `response_question_tawsil_teacher_id_foreign` (`teacher_id`),
  ADD KEY `response_question_tawsil_student_id_foreign` (`student_id`),
  ADD KEY `response_question_tawsil_exam_id_foreign` (`exam_id`),
  ADD KEY `response_question_tawsil_question_tawsil_id_foreign` (`question_tawsil_id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Index pour la table `student_exam`
--
ALTER TABLE `student_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_exam_exam_id_foreign` (`exam_id`),
  ADD KEY `student_exam_student_id_foreign` (`student_id`);

--
-- Index pour la table `student_teacher`
--
ALTER TABLE `student_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_teacher_teacher_id_foreign` (`teacher_id`),
  ADD KEY `student_teacher_student_id_foreign` (`student_id`);

--
-- Index pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `exam_question_long_text`
--
ALTER TABLE `exam_question_long_text`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `exam_question_multi_choice`
--
ALTER TABLE `exam_question_multi_choice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `exam_question_span`
--
ALTER TABLE `exam_question_span`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `exam_question_tartib`
--
ALTER TABLE `exam_question_tartib`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `exam_question_tawsil`
--
ALTER TABLE `exam_question_tawsil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `exam_teacher`
--
ALTER TABLE `exam_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `question_long_text`
--
ALTER TABLE `question_long_text`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `question_multi_choice`
--
ALTER TABLE `question_multi_choice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `question_span`
--
ALTER TABLE `question_span`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `question_tartib`
--
ALTER TABLE `question_tartib`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `question_tawsil`
--
ALTER TABLE `question_tawsil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `response_exam`
--
ALTER TABLE `response_exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `response_hash_url_exam`
--
ALTER TABLE `response_hash_url_exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `response_question_long_text`
--
ALTER TABLE `response_question_long_text`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `response_question_mutli_choice`
--
ALTER TABLE `response_question_mutli_choice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `response_question_span`
--
ALTER TABLE `response_question_span`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `response_question_tartib`
--
ALTER TABLE `response_question_tartib`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `response_question_tawsil`
--
ALTER TABLE `response_question_tawsil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `student_exam`
--
ALTER TABLE `student_exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `student_teacher`
--
ALTER TABLE `student_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_question_long_text`
--
ALTER TABLE `exam_question_long_text`
  ADD CONSTRAINT `exam_question_long_text_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_question_long_text_question_long_text_id_foreign` FOREIGN KEY (`question_long_text_id`) REFERENCES `question_long_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_question_multi_choice`
--
ALTER TABLE `exam_question_multi_choice`
  ADD CONSTRAINT `exam_question_multi_choice_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_question_multi_choice_question_multi_choice_id_foreign` FOREIGN KEY (`question_multi_choice_id`) REFERENCES `question_multi_choice` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_question_span`
--
ALTER TABLE `exam_question_span`
  ADD CONSTRAINT `exam_question_span_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_question_span_question_span_id_foreign` FOREIGN KEY (`question_span_id`) REFERENCES `question_span` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_question_tartib`
--
ALTER TABLE `exam_question_tartib`
  ADD CONSTRAINT `exam_question_tartib_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_question_tartib_question_tartib_id_foreign` FOREIGN KEY (`question_tartib_id`) REFERENCES `question_tartib` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_question_tawsil`
--
ALTER TABLE `exam_question_tawsil`
  ADD CONSTRAINT `exam_question_tawsil_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_question_tawsil_question_tawsil_id_foreign` FOREIGN KEY (`question_tawsil_id`) REFERENCES `question_tawsil` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exam_teacher`
--
ALTER TABLE `exam_teacher`
  ADD CONSTRAINT `exam_teacher_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_long_text`
--
ALTER TABLE `question_long_text`
  ADD CONSTRAINT `question_long_text_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_multi_choice`
--
ALTER TABLE `question_multi_choice`
  ADD CONSTRAINT `question_multi_choice_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_span`
--
ALTER TABLE `question_span`
  ADD CONSTRAINT `question_span_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_tartib`
--
ALTER TABLE `question_tartib`
  ADD CONSTRAINT `question_tartib_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_tawsil`
--
ALTER TABLE `question_tawsil`
  ADD CONSTRAINT `question_tawsil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_exam`
--
ALTER TABLE `response_exam`
  ADD CONSTRAINT `response_exam_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_exam_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_exam_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_hash_url_exam`
--
ALTER TABLE `response_hash_url_exam`
  ADD CONSTRAINT `response_hash_url_exam_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_hash_url_exam_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_hash_url_exam_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_question_long_text`
--
ALTER TABLE `response_question_long_text`
  ADD CONSTRAINT `response_question_long_text_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_long_text_question_long_id_foreign` FOREIGN KEY (`question_long_id`) REFERENCES `question_long_text` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_long_text_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_long_text_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_long_text_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_question_mutli_choice`
--
ALTER TABLE `response_question_mutli_choice`
  ADD CONSTRAINT `response_question_mutli_choice_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_mutli_choice_question_multi_id_foreign` FOREIGN KEY (`question_multi_id`) REFERENCES `question_multi_choice` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_mutli_choice_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_mutli_choice_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_mutli_choice_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_question_span`
--
ALTER TABLE `response_question_span`
  ADD CONSTRAINT `response_question_span_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_span_question_span_id_foreign` FOREIGN KEY (`question_span_id`) REFERENCES `question_span` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_span_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_span_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_span_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_question_tartib`
--
ALTER TABLE `response_question_tartib`
  ADD CONSTRAINT `response_question_tartib_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tartib_question_tartib_id_foreign` FOREIGN KEY (`question_tartib_id`) REFERENCES `question_tartib` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tartib_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tartib_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tartib_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `response_question_tawsil`
--
ALTER TABLE `response_question_tawsil`
  ADD CONSTRAINT `response_question_tawsil_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tawsil_question_tawsil_id_foreign` FOREIGN KEY (`question_tawsil_id`) REFERENCES `question_tawsil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tawsil_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tawsil_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_tawsil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `student_exam`
--
ALTER TABLE `student_exam`
  ADD CONSTRAINT `student_exam_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_exam_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `student_teacher`
--
ALTER TABLE `student_teacher`
  ADD CONSTRAINT `student_teacher_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
