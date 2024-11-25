-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 09:22 AM
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
-- Database: `school_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class_teachers`
--

CREATE TABLE `assign_class_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_class_teachers`
--

INSERT INTO `assign_class_teachers` (`id`, `class_id`, `teacher_id`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(17, 2, 18, 1, '2024-10-01 06:39:36', '2024-10-05 09:09:05', 1),
(21, 1, 17, 1, '2024-10-05 09:09:28', '2024-10-05 09:09:28', 1),
(22, 1, 16, 1, '2024-10-05 09:09:28', '2024-10-05 09:09:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '12th', 1, 1, '2024-09-08 08:01:01', '2024-09-09 05:10:04'),
(2, '10th', 1, 1, '2024-09-08 08:32:47', '2024-09-08 08:32:47'),
(3, '9th', 1, 1, '2024-09-08 08:32:59', '2024-09-08 08:32:59'),
(5, 'Math', 1, 1, '2024-09-09 04:04:18', '2024-09-09 04:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_id`, `subject_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 1, 1, '2024-09-14 04:44:57', '2024-09-14 04:44:57'),
(2, 2, 2, 1, 1, '2024-09-14 04:44:57', '2024-09-14 04:44:57'),
(11, 1, 7, 1, 1, '2024-10-05 03:04:43', '2024-10-05 03:04:43'),
(12, 1, 2, 1, 1, '2024-10-05 03:04:43', '2024-10-05 03:04:43'),
(13, 1, 3, 1, 1, '2024-10-05 03:04:43', '2024-10-05 03:04:43'),
(14, 1, 5, 1, 1, '2024-10-05 03:04:43', '2024-10-05 03:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject_timetables`
--

CREATE TABLE `class_subject_timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `week_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subject_timetables`
--

INSERT INTO `class_subject_timetables` (`id`, `class_id`, `subject_id`, `week_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(5, 1, 7, 1, '19:26', '20:26', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(6, 1, 7, 3, '21:26', '22:26', '2', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(7, 1, 7, 4, '19:27', '20:27', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(8, 1, 7, 5, '20:27', '21:31', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(9, 1, 7, 6, '20:28', '21:28', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(10, 1, 7, 7, '20:28', '21:28', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(11, 1, 7, 8, '20:28', '21:28', '1', '2024-10-05 06:28:32', '2024-10-05 06:28:32'),
(12, 1, 2, 1, '10:09', '11:09', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(13, 1, 2, 3, '09:09', '10:09', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(14, 1, 2, 4, '19:10', '09:10', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(15, 1, 2, 5, '07:10', '08:10', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(16, 1, 2, 6, '07:10', '08:10', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(17, 1, 2, 7, '07:13', '08:11', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51'),
(18, 1, 2, 8, '19:11', '08:11', '1', '2024-10-05 09:11:51', '2024-10-05 09:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` bigint(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(4, 'Pre Board', 1, 'Pre Board', '2024-10-08 10:30:49', '2024-10-08 10:30:49'),
(5, 'Mid tream', 1, 'Mid tream', '2024-10-08 10:31:09', '2024-10-08 10:31:09'),
(6, 'Final Exam', 1, 'Final Exam', '2024-10-08 10:33:44', '2024-10-08 10:33:44'),
(7, '2nd Exam', 1, '2nd Exam', '2024-10-08 10:33:55', '2024-10-08 10:33:55');

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
(4, '2024_09_05_095840_create_password_reset_tokens', 2),
(7, '2024_09_05_113531_update_users_table', 3),
(9, '2024_09_08_122739_create_classes_table', 4),
(10, '2024_09_09_085042_create_subjects_table', 5),
(14, '2024_09_09_095352_create_class_subjects_table', 6),
(16, '2024_09_14_095116_update_users_table', 7),
(21, '2024_09_20_060124_update_users_table', 8),
(22, '2024_10_01_090411_update_assign_class_teachers', 9),
(23, '2024_10_05_073009_create_weeks_table', 10),
(24, '2024_10_05_104049_create_class_subject_timetables', 11),
(25, '2024_10_08_145134_create_exams_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(15, 'ravi395950@gmail.com', 'WirRz2k4V0ejqvpbN72GR6qI3G5bfRq6akzbe0eSGxQprDwsFKumQgrhsQa8', '2024-09-18 04:39:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `type`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'English', 'Theory', 1, 1, '2024-09-09 04:12:16', '2024-09-09 04:12:16'),
(3, 'Math', 'Practical', 1, 1, '2024-09-09 04:12:27', '2024-09-09 04:56:23'),
(4, 'Science', 'Theory', 1, 1, '2024-09-09 04:19:46', '2024-09-09 04:19:46'),
(5, 'Sanskrit', 'Theory', 1, 1, '2024-09-09 04:20:26', '2024-09-09 04:20:26'),
(6, 'Social Science', 'Theory', 1, 1, '2024-09-09 04:20:39', '2024-09-09 04:20:39'),
(7, 'Economics', 'Theory', 1, 1, '2024-09-09 04:21:13', '2024-09-09 04:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1:admin, 2:teacher, 3:school, 4:parent',
  `admission_number` varchar(255) DEFAULT NULL,
  `roll_number` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `address` varchar(255) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `occupation`, `status`, `address`, `permanent_address`, `qualification`, `marital_status`, `work_experience`, `note`, `created_at`, `updated_at`) VALUES
(1, 0, 'Ravi Kumar', NULL, 'ravi395950@gmail.com', NULL, '$2y$12$ut6nb2iB/4GOCkCQhF.4iuWsE22.TKGWxt9EOADorJLmVGfPst/nO', 'N14jWIJEHt401piR8s65ebY2yzLQnxn0DD7FPY1OonSQUlzV5tRbxXgIFne8', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1727435550.jpg', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 04:38:00', '2024-09-27 05:54:09'),
(2, 0, 'karan', 'kumar', 'teacher@gmail.com', NULL, '$2y$12$nbCUyVPzYtQap3zFqtMfdO728xDFHOSTPWmfLyR2tIM9FvlhMroGK', '690Z37awbLa4vP4ysphx3utIO5MhDwoQ0fBsXoeNREzsEwEjz7N2tiPgjfEn', 2, NULL, NULL, NULL, 'Male', '2021-09-23', NULL, NULL, '11111111', '2024-09-23', '1727096499.png', NULL, NULL, NULL, NULL, 1, 'dfsfsf', NULL, NULL, NULL, NULL, NULL, '2024-09-05 05:58:36', '2024-10-01 07:15:50'),
(12, 0, 'Rajan', 'Kumar', 'rajan@gmail.com', NULL, '$2y$12$L4yG2B0IHToE88TOfnMz9u7n90RhPH44sIWorc0UDA8WyxRyfgSTW', NULL, 4, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '88888888888', NULL, '1727431693.jpg', NULL, NULL, NULL, 'Accountant', 1, 'sfsfsfs', NULL, NULL, NULL, NULL, NULL, '2024-09-20 00:25:07', '2024-09-27 04:38:13'),
(14, 12, 'Karan', 'kumar', 'karan@gmail.com', NULL, '$2y$12$GLvC6k8uV60Nmw5R7H6vtOEC44rOvMz5iefZ3nxvpbIJ1/oI4J9Aa', 'vjG69Mmdz75JZ5t9nJZtBoyjd7TBpRfq7cdAEkCga2i6T2qm0IWggwSDROpg', 3, '41222552', '45662155', 1, 'Male', '2020-01-06', 'OBC', 'hindu', '5546564', '2024-09-20', '1726830294.png', 'O+', '5.6\"', '55kg', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20 05:34:55', '2024-10-08 07:34:07'),
(16, 0, 'Pawan', 'kumar', 'pawan@gmail.com', NULL, '$2y$12$khXNG96Xx1SQTtwfhOThKO8W/SCjm8UViLpqUCV935YXKUat0ZQ7i', NULL, 2, NULL, NULL, NULL, 'Male', '2014-02-01', NULL, NULL, '5555555555', '2024-10-01', '1727771715.png', NULL, NULL, NULL, NULL, 1, 'Delhi', 'dfsf', 'betech', 'Married', '4years', 'fsfs', '2024-10-01 02:59:17', '2024-10-01 08:26:01'),
(17, 0, 'chandarwansi', 'kumar', 'chandarwansi@gmail.com', NULL, '$2y$12$XMtOkU0/MEhMhttq5ZDSjOkKBqW19HmM.obgMVF9O2F3lDn19rNQy', NULL, 2, NULL, NULL, NULL, 'Male', '2015-01-01', NULL, NULL, '44444444', '2024-10-01', '1727771704.png', NULL, NULL, NULL, NULL, 1, 'fsfsfsff', NULL, NULL, NULL, NULL, NULL, '2024-10-01 03:03:58', '2024-10-01 03:05:04'),
(18, NULL, 'raja', 'kumar', 'raja@gmail.com', NULL, '$2y$12$HhOJLe3wHJJD/I78PB/QE.sYxtYzJD4adq2tpCbHe.s2q.EJPqRri', NULL, 2, NULL, NULL, NULL, 'Male', '2015-05-01', NULL, NULL, '4444444555', '2024-10-01', '1727787329.png', NULL, NULL, NULL, NULL, 1, 'fsfsfssd', 'fsfsfssd', 'betch', 'Married', '5years', 'sfsdf', '2024-10-01 07:25:29', '2024-10-01 07:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Monday', NULL, NULL),
(3, 'Tuesday', NULL, NULL),
(4, 'Wednesday', NULL, NULL),
(5, 'Thursday', NULL, NULL),
(6, 'Friday', NULL, NULL),
(7, 'Saturday', NULL, NULL),
(8, 'Sunday', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_class_teachers_class_id_foreign` (`class_id`),
  ADD KEY `assign_class_teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_user_id_foreign` (`user_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subjects_class_id_foreign` (`class_id`),
  ADD KEY `class_subjects_subject_id_foreign` (`subject_id`),
  ADD KEY `class_subjects_user_id_foreign` (`user_id`);

--
-- Indexes for table `class_subject_timetables`
--
ALTER TABLE `class_subject_timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subject_timetables_class_id_foreign` (`class_id`),
  ADD KEY `class_subject_timetables_subject_id_foreign` (`subject_id`),
  ADD KEY `class_subject_timetables_week_id_foreign` (`week_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class_subject_timetables`
--
ALTER TABLE `class_subject_timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  ADD CONSTRAINT `assign_class_teachers_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_class_teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_subject_timetables`
--
ALTER TABLE `class_subject_timetables`
  ADD CONSTRAINT `class_subject_timetables_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_subject_timetables_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_subject_timetables_week_id_foreign` FOREIGN KEY (`week_id`) REFERENCES `weeks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
