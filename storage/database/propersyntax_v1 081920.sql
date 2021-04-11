-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 09:27 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propersyntax_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `telephone_number` varchar(50) DEFAULT NULL,
  `location` mediumtext NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `description`, `email_address`, `mobile_number`, `telephone_number`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'EssayGear', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est lorem.', 'essaygear@gmail.com', '912345678', '00 0000 0000', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Active', '2020-06-08 11:37:57', '2020-07-06 19:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `instruction` mediumtext NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `lesson_id`, `title`, `description`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>', 'Active', '2020-08-15 04:43:45', '2020-08-15 09:55:10'),
(2, 5, 2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>', 'Active', '2020-08-15 08:45:25', '2020-08-15 10:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `activity_items`
--

CREATE TABLE `activity_items` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `arrangement` int(11) NOT NULL,
  `problem` mediumtext NOT NULL,
  `solution` mediumtext DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_items`
--

INSERT INTO `activity_items` (`id`, `activity_id`, `arrangement`, `problem`, `solution`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Problem 1', 'Solution 1', 'Active', '2020-08-15 04:43:45', '2020-08-15 09:42:08'),
(2, 1, 2, 'Problem 2', 'Solution 2', 'Active', '2020-08-15 04:43:45', '2020-08-15 09:27:17'),
(3, 1, 3, 'Problem 3', 'Solution 3', 'Active', '2020-08-15 04:43:45', '2020-08-15 09:42:17'),
(4, 1, 4, 'Problem 4', 'Solution 4', 'Active', '2020-08-15 08:12:07', NULL),
(5, 1, 5, 'Problem 5', 'Solution 5', 'Active', '2020-08-15 08:12:07', '2020-08-15 10:19:44'),
(6, 2, 1, 'Problem 1.1', 'Solution 1.1', 'Active', '2020-08-15 08:45:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `video_desc` mediumtext DEFAULT NULL,
  `presentation_desc` mediumtext DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `user_id`, `photo_id`, `name`, `description`, `video_desc`, `presentation_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '4', 'Grade 1', 'This is a test. ', 'This is a test.', 'This is a test.', 'Active', '2020-08-14 16:47:09', NULL),
(2, 5, '5', 'Grade 2', 'This is a test.', 'This is a test.', 'This is a test.', 'Active', '2020-08-14 17:26:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_presentations`
--

CREATE TABLE `lesson_presentations` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_presentations`
--

INSERT INTO `lesson_presentations` (`id`, `lesson_id`, `file_path`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/pictures/lesson_presentations', 'Test-ID 2_5f36c00db9a4a.jpg', 'Active', '2020-08-14 16:47:09', NULL),
(2, 1, 'storage/pictures/lesson_presentations', 'Test-ID 1_5f36c00dc1b61.jpg', 'Active', '2020-08-14 16:47:09', NULL),
(3, 2, 'storage/pictures/lesson_presentations', 'Test-ID 2_5f36c945912c7.jpg', 'Active', '2020-08-14 17:26:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_videos`
--

CREATE TABLE `lesson_videos` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_videos`
--

INSERT INTO `lesson_videos` (`id`, `lesson_id`, `file_path`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/videos/lesson_videos', 'Test-ID 1_5f36c00da94e7.jpg', 'Active', '2020-08-14 16:47:09', NULL),
(2, 2, 'storage/videos/lesson_videos', 'Test-ID 2_5f36c9457075d.jpg', 'Active', '2020-08-14 17:26:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `module_primary_id` int(11) NOT NULL,
  `module_type` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `enable` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `file_path`, `file_name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'storage/pictures/users', '100872202_95963_1597406072.jpg', 'profile', 'Active', '2020-08-14 11:54:32', NULL),
(2, 'storage/pictures/identity_cards', 'Test-ID 1_1597406073.jpg', 'identity_card', 'Active', '2020-08-14 11:54:33', NULL),
(3, 'storage/pictures/users', 'default-m.png', 'profile', 'Active', '2020-08-14 14:42:29', NULL),
(4, 'storage/pictures/lessons', 'Test-ID 1_1597423629.jpg', 'lesson', 'Active', '2020-08-14 16:47:09', NULL),
(5, 'storage/pictures/lessons', 'Test-ID 2_1597425989.jpg', 'lesson', 'Active', '2020-08-14 17:26:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `user_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Sample 1', 'This is a test.', 'Active', '2020-08-14 12:02:11', '2020-08-14 19:57:29'),
(2, 5, 'Sample 2', 'This is a test.', 'Active', '2020-08-14 12:24:32', NULL),
(5, 5, 'Sample 3', 'This is a test.', 'Active', '2020-08-14 13:55:17', NULL),
(6, 5, 'Sample 4', 'This is a test.', 'Active', '2020-08-14 13:55:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `profile_photo_id` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `educational_attainment` varchar(100) NOT NULL,
  `school_attended` varchar(100) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `teacher_user_id`, `section_id`, `profile_photo_id`, `sex`, `date_of_birth`, `mobile_number`, `educational_attainment`, `school_attended`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 5, 1, 3, 'Male', '1998-04-18', '09666936870', 'College', 'University of Caloocan City', 'Active', '2020-08-14 14:42:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_activities`
--

CREATE TABLE `student_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `activity_item_id` int(11) NOT NULL,
  `answer` mediumtext NOT NULL,
  `checked` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activities`
--

INSERT INTO `student_activities` (`id`, `user_id`, `activity_id`, `activity_item_id`, `answer`, `checked`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 'Answer 1', 1, 'Active', '2020-08-17 09:03:14', '2020-08-19 05:17:39'),
(2, 6, 1, 2, 'Answer 2', 1, 'Active', '2020-08-17 09:03:14', '2020-08-19 09:21:10'),
(3, 6, 1, 3, 'Answer 3', 1, 'Active', '2020-08-17 09:03:14', '2020-08-19 05:20:53'),
(4, 6, 1, 4, 'Answer 4', 1, 'Active', '2020-08-17 09:03:14', '2020-08-19 05:21:23'),
(5, 6, 1, 5, 'Answer 5', 1, 'Active', '2020-08-17 09:03:14', '2020-08-19 05:32:00'),
(6, 6, 2, 6, 'Answer 1.1', 1, 'Active', '2020-08-18 07:47:07', '2020-08-19 09:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_activity_points`
--

CREATE TABLE `student_activity_points` (
  `id` int(11) NOT NULL,
  `student_activity_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `correction` mediumtext NOT NULL,
  `recommendation` mediumtext DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activity_points`
--

INSERT INTO `student_activity_points` (`id`, `student_activity_id`, `point`, `correction`, `recommendation`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 'Answer 1', '<p>This is a test</p>', 'Active', '2020-08-19 03:36:11', '2020-08-19 05:36:10'),
(2, 3, 5, 'Answer 3', '<p>This is a test.</p>', 'Active', '2020-08-19 03:20:52', NULL),
(3, 4, 1, 'Answer 4', '<p>This is a test.</p>', 'Active', '2020-08-19 03:40:01', '2020-08-19 05:40:01'),
(4, 5, 8, 'Answer 5', '<p>This is a test.</p>', 'Active', '2020-08-19 03:37:04', '2020-08-19 05:37:04'),
(5, 6, 10, 'This si a tests.', '<p>This is a test.</p>', 'Active', '2020-08-19 07:12:57', NULL),
(6, 2, 14, 'Answer 2', '', 'Active', '2020-08-19 07:21:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `enable` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `image_path`, `image_name`, `name`, `description`, `enable`, `status`, `created_at`, `updated_at`) VALUES
(1, 'storage/pictures/system', 'logo-light_1592478498.png', 'SPEECHClass', '', 0, 'Active', '2020-06-08 03:19:53', '2020-07-06 20:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `system_trashes`
--

CREATE TABLE `system_trashes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_primary_id` int(11) NOT NULL,
  `module_type` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_photo_id` int(11) NOT NULL,
  `identity_photo_id` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_address` mediumtext NOT NULL,
  `type_of_school` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `profile_photo_id`, `identity_photo_id`, `sex`, `date_of_birth`, `mobile_number`, `school_name`, `school_address`, `type_of_school`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 2, 'Male', '2000-01-01', '9123456789', 'Caybiga Elementary School', 'Gen. Luis Street, Caybiga, Caloocan City', 'Public', 'Active', '2020-08-14 11:54:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `family_name` text NOT NULL,
  `given_name` text NOT NULL,
  `middle_name` text DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `family_name`, `given_name`, `middle_name`, `email_address`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makilan', 'Mark', 'Navera', 'mrknvrmkln2nd@gmail.com', '$2y$10$ClceuNnVWKM8LAcrGsRjGuM/AT3kxIZ/kKRO0LL6.lkn4YRzOcFSu', 'Active', '2020-07-07 17:22:29', '2020-08-14 13:59:00'),
(5, 2, 'Nesortado', 'Arjay', '', 'arjaynesortado@gmail.com', '$2y$10$1uMOFWc/cU0oqWd78Klmfu/p6SHmHiNq5mi6pCbTxG574uv73zD7O', 'Active', '2020-08-14 11:54:32', NULL),
(6, 3, 'Makilan', 'Mark', 'Navera', 'markmakilan@gmail.com', '$2y$10$XDsQEkGxia7G6pSWEN3LGeByDTWi2NK5pevJFxp9JDIctWsKjmOHG', 'Active', '2020-08-14 14:42:29', '2020-08-14 17:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'The person responsible for managing things inside the system.', 'Active', '2020-06-08 03:09:51', NULL),
(2, 'Teacher', '', 'Active', '2020-06-08 03:10:04', NULL),
(3, 'Student', NULL, 'Active', '2020-06-18 07:35:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `activity_items`
--
ALTER TABLE `activity_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`user_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `lesson_presentations`
--
ALTER TABLE `lesson_presentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `lesson_videos`
--
ALTER TABLE `lesson_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`),
  ADD KEY `module_primary_id` (`module_primary_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `teacher_id` (`teacher_user_id`),
  ADD KEY `photo_id` (`profile_photo_id`);

--
-- Indexes for table `student_activities`
--
ALTER TABLE `student_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `activity_item_id` (`activity_item_id`);

--
-- Indexes for table `student_activity_points`
--
ALTER TABLE `student_activity_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_activity_id` (`student_activity_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_trashes`
--
ALTER TABLE `system_trashes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_primary_id` (`module_primary_id`) USING BTREE;

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `photo_id` (`identity_photo_id`),
  ADD KEY `photo_id_2` (`identity_photo_id`),
  ADD KEY `profile_photo_id` (`profile_photo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_items`
--
ALTER TABLE `activity_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson_presentations`
--
ALTER TABLE `lesson_presentations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lesson_videos`
--
ALTER TABLE `lesson_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_activities`
--
ALTER TABLE `student_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_activity_points`
--
ALTER TABLE `student_activity_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_trashes`
--
ALTER TABLE `system_trashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
