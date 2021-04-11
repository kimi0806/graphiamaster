-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 01:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propersyntax`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext,
  `email_address` varchar(100) NOT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `telephone_number` varchar(50) DEFAULT NULL,
  `location` mediumtext NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `description` mediumtext,
  `instruction` mediumtext NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `lesson_id`, `title`, `description`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Expository Activity 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>', 'Active', '2020-08-15 04:43:45', '2020-08-15 09:55:10'),
(2, 5, 1, 'Expository Activity 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>', 'Active', '2020-08-15 08:45:25', '2020-08-15 10:47:38'),
(3, 5, 2, 'Educational', 'Knowledge and Learning', '<p>Read and share your though about the problem and make sure your confidently answer the question.</p>', 'Active', '2020-10-25 23:54:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_items`
--

CREATE TABLE `activity_items` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `arrangement` int(11) NOT NULL,
  `problem` mediumtext NOT NULL,
  `solution` mediumtext,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_items`
--

INSERT INTO `activity_items` (`id`, `activity_id`, `arrangement`, `problem`, `solution`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Some educationalists think that international exchange visits will benefit teenagers at the school. To what extent do the advantages outweigh the disadvantages?', 'Solution number one', 'Active', '2020-10-25 23:54:26', NULL),
(2, 3, 2, 'For centuries, important parts of education have remained such as reading, writing and maths. With the advent of computers, some people think that computer skill be made as a fourth skill to be added to the list. To what extent do you agree?', 'Solution number two', 'Active', '2020-10-25 23:54:26', NULL),
(3, 3, 3, 'The government should allocate more funding to teaching sciences rather than other subjects in order for a country to develop and progress. To what extent do you agree?', 'Solution number three', 'Active', '2020-10-25 23:54:26', NULL),
(4, 3, 4, 'Some people believe that children should not be given homework everyday, while others believe that they must get homework everyday in order to be successful at school. Discuss both sides and give your opinion.', 'Solution number four', 'Active', '2020-10-25 23:54:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext,
  `video_desc` mediumtext,
  `presentation_desc` mediumtext,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `user_id`, `photo_id`, `name`, `description`, `video_desc`, `presentation_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '11', 'Expository Writing', 'Expository writing is a type of writing where the purpose is to explain, inform, or even describe. It is considered one of the four most common rhetorical modes. The purpose of expository writing is to explain and analyze information by presenting an idea, relevant evidence, and appropriate discussion.', 'Expository Video explains what is expository writing', 'Presentation that let you know kinds of writing and what is expository writing', 'Active', '2020-09-22 07:35:35', '2020-10-01 06:16:51'),
(2, 5, '15', 'Persuasive Writing', 'Sample Perspective Writing', 'Sample Video Describing Persuasive Writing', 'Sample Presentation for persuasive Writing', 'Active', '2020-10-14 16:41:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_presentations`
--

CREATE TABLE `lesson_presentations` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_presentations`
--

INSERT INTO `lesson_presentations` (`id`, `lesson_id`, `set_id`, `file_path`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(111, 1, 1, 'storage/pictures/lesson_presentations', 'Slide1_5f7555a777413.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(112, 1, 1, 'storage/pictures/lesson_presentations', 'Slide2_5f7555a777d3d.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(113, 1, 1, 'storage/pictures/lesson_presentations', 'Slide3_5f7555a7785e9.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(114, 1, 1, 'storage/pictures/lesson_presentations', 'Slide4_5f7555a7791a5.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(115, 1, 1, 'storage/pictures/lesson_presentations', 'Slide5_5f7555a779b6d.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(116, 1, 1, 'storage/pictures/lesson_presentations', 'Slide6_5f7555a77a617.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(117, 1, 1, 'storage/pictures/lesson_presentations', 'Slide7_5f7555a77aecd.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(118, 1, 1, 'storage/pictures/lesson_presentations', 'Slide8_5f7555a77b7a5.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(119, 1, 1, 'storage/pictures/lesson_presentations', 'Slide9_5f7555a77c012.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(120, 1, 1, 'storage/pictures/lesson_presentations', 'Slide10_5f7555a77c91f.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(121, 1, 1, 'storage/pictures/lesson_presentations', 'Slide11_5f7555a77d1f7.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(122, 1, 1, 'storage/pictures/lesson_presentations', 'Slide12_5f7555a77da7d.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(123, 1, 1, 'storage/pictures/lesson_presentations', 'Slide13_5f7555a77e311.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(124, 1, 1, 'storage/pictures/lesson_presentations', 'Slide14_5f7555a77eb97.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(125, 1, 1, 'storage/pictures/lesson_presentations', 'Slide15_5f7555a77f436.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(126, 1, 1, 'storage/pictures/lesson_presentations', 'Slide16_5f7555a77fe07.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(127, 1, 1, 'storage/pictures/lesson_presentations', 'Slide17_5f7555a782f0a.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(128, 1, 1, 'storage/pictures/lesson_presentations', 'Slide18_5f7555a792afd.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(129, 1, 1, 'storage/pictures/lesson_presentations', 'Slide19_5f7555a793644.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(130, 1, 1, 'storage/pictures/lesson_presentations', 'Slide20_5f7555a793f5a.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(131, 1, 1, 'storage/pictures/lesson_presentations', 'Slide21_5f7555a794798.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(132, 1, 1, 'storage/pictures/lesson_presentations', 'Slide22_5f7555a794fd9.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(133, 1, 1, 'storage/pictures/lesson_presentations', 'Slide23_5f7555a795892.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(134, 1, 1, 'storage/pictures/lesson_presentations', 'Slide24_5f7555a796269.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(135, 1, 1, 'storage/pictures/lesson_presentations', 'Slide25_5f7555a796d1e.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(136, 1, 1, 'storage/pictures/lesson_presentations', 'Slide26_5f7555a797754.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(137, 1, 1, 'storage/pictures/lesson_presentations', 'Slide27_5f7555a7980d3.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(138, 1, 1, 'storage/pictures/lesson_presentations', 'Slide28_5f7555a798bb6.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(139, 1, 1, 'storage/pictures/lesson_presentations', 'Slide29_5f7555a799392.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(140, 1, 1, 'storage/pictures/lesson_presentations', 'Slide30_5f7555a799b72.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(141, 1, 1, 'storage/pictures/lesson_presentations', 'Slide31_5f7555a79a33f.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(142, 1, 1, 'storage/pictures/lesson_presentations', 'Slide32_5f7555a79ab71.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(143, 1, 1, 'storage/pictures/lesson_presentations', 'Slide33_5f7555a79b626.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(144, 1, 1, 'storage/pictures/lesson_presentations', 'Slide34_5f7555a79bdd2.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(145, 1, 1, 'storage/pictures/lesson_presentations', 'Slide35_5f7555a79c8f0.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(146, 1, 1, 'storage/pictures/lesson_presentations', 'Slide36_5f7555a79d1f2.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(147, 1, 1, 'storage/pictures/lesson_presentations', 'Slide37_5f7555a79dcc1.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(148, 1, 1, 'storage/pictures/lesson_presentations', 'Slide38_5f7555a79eada.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(149, 1, 1, 'storage/pictures/lesson_presentations', 'Slide39_5f7555a79f50d.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(150, 1, 1, 'storage/pictures/lesson_presentations', 'Slide40_5f7555a79fefd.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(151, 1, 1, 'storage/pictures/lesson_presentations', 'Slide41_5f7555a7a0b0b.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(152, 1, 1, 'storage/pictures/lesson_presentations', 'Slide42_5f7555a7a149e.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(153, 1, 1, 'storage/pictures/lesson_presentations', 'Slide43_5f7555a7a1e14.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(154, 1, 1, 'storage/pictures/lesson_presentations', 'Slide44_5f7555a7a27a0.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(155, 1, 1, 'storage/pictures/lesson_presentations', 'Slide45_5f7555a7a3065.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(156, 1, 1, 'storage/pictures/lesson_presentations', 'Slide46_5f7555a7a390a.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(157, 1, 1, 'storage/pictures/lesson_presentations', 'Slide47_5f7555a7a41ec.JPG', 'Active', '2020-10-01 04:05:59', NULL),
(158, 2, 2, 'storage/pictures/lesson_presentations', 'Slide1_5f872a47a946c.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(159, 2, 2, 'storage/pictures/lesson_presentations', 'Slide2_5f872a47a9dc1.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(160, 2, 2, 'storage/pictures/lesson_presentations', 'Slide3_5f872a47aa5b0.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(161, 2, 2, 'storage/pictures/lesson_presentations', 'Slide4_5f872a47aaedc.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(162, 2, 2, 'storage/pictures/lesson_presentations', 'Slide5_5f872a47ab8d9.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(163, 2, 2, 'storage/pictures/lesson_presentations', 'Slide6_5f872a47ac123.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(164, 2, 2, 'storage/pictures/lesson_presentations', 'Slide7_5f872a47aca28.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(165, 2, 2, 'storage/pictures/lesson_presentations', 'Slide8_5f872a47ad702.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(166, 2, 2, 'storage/pictures/lesson_presentations', 'Slide9_5f872a47ae04a.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(167, 2, 2, 'storage/pictures/lesson_presentations', 'Slide10_5f872a47ae902.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(168, 2, 2, 'storage/pictures/lesson_presentations', 'Slide11_5f872a47af177.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(169, 2, 2, 'storage/pictures/lesson_presentations', 'Slide12_5f872a47afa69.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(170, 2, 2, 'storage/pictures/lesson_presentations', 'Slide13_5f872a47b0297.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(171, 2, 2, 'storage/pictures/lesson_presentations', 'Slide14_5f872a47b0d03.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(172, 2, 2, 'storage/pictures/lesson_presentations', 'Slide15_5f872a47b17ca.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(173, 2, 2, 'storage/pictures/lesson_presentations', 'Slide16_5f872a47b207a.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(174, 2, 2, 'storage/pictures/lesson_presentations', 'Slide17_5f872a47b28f4.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(175, 2, 2, 'storage/pictures/lesson_presentations', 'Slide18_5f872a47b30de.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(176, 2, 2, 'storage/pictures/lesson_presentations', 'Slide19_5f872a47b394f.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(177, 2, 2, 'storage/pictures/lesson_presentations', 'Slide20_5f872a47b45da.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(178, 2, 2, 'storage/pictures/lesson_presentations', 'Slide21_5f872a47b5025.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(179, 2, 2, 'storage/pictures/lesson_presentations', 'Slide22_5f872a47b61bb.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(180, 2, 2, 'storage/pictures/lesson_presentations', 'Slide23_5f872a47b6b06.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(181, 2, 2, 'storage/pictures/lesson_presentations', 'Slide24_5f872a47b7421.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(182, 2, 2, 'storage/pictures/lesson_presentations', 'Slide25_5f872a47b7c7f.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(183, 2, 2, 'storage/pictures/lesson_presentations', 'Slide26_5f872a47b84ed.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(184, 2, 2, 'storage/pictures/lesson_presentations', 'Slide27_5f872a47b8cba.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(185, 2, 2, 'storage/pictures/lesson_presentations', 'Slide28_5f872a47b954e.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(186, 2, 2, 'storage/pictures/lesson_presentations', 'Slide29_5f872a47ba043.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(187, 2, 2, 'storage/pictures/lesson_presentations', 'Slide30_5f872a47ba975.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(188, 2, 2, 'storage/pictures/lesson_presentations', 'Slide31_5f872a47bb191.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(189, 2, 2, 'storage/pictures/lesson_presentations', 'Slide32_5f872a47bba33.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(190, 2, 2, 'storage/pictures/lesson_presentations', 'Slide33_5f872a47bc3e3.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(191, 2, 2, 'storage/pictures/lesson_presentations', 'Slide34_5f872a47bcc99.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(192, 2, 2, 'storage/pictures/lesson_presentations', 'Slide35_5f872a47bd624.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(193, 2, 2, 'storage/pictures/lesson_presentations', 'Slide36_5f872a47bdebf.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(194, 2, 2, 'storage/pictures/lesson_presentations', 'Slide37_5f872a47be7ca.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(195, 2, 2, 'storage/pictures/lesson_presentations', 'Slide38_5f872a47bf016.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(196, 2, 2, 'storage/pictures/lesson_presentations', 'Slide39_5f872a47bfb46.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(197, 2, 2, 'storage/pictures/lesson_presentations', 'Slide40_5f872a47c04ef.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(198, 2, 2, 'storage/pictures/lesson_presentations', 'Slide41_5f872a47c0d6c.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(199, 2, 2, 'storage/pictures/lesson_presentations', 'Slide42_5f872a47c15ae.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(200, 2, 2, 'storage/pictures/lesson_presentations', 'Slide43_5f872a47c1efa.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(201, 2, 2, 'storage/pictures/lesson_presentations', 'Slide44_5f872a47c2870.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(202, 2, 2, 'storage/pictures/lesson_presentations', 'Slide45_5f872a47c30cc.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(203, 2, 2, 'storage/pictures/lesson_presentations', 'Slide46_5f872a47c3d15.JPG', 'Active', '2020-10-14 16:41:43', NULL),
(204, 2, 2, 'storage/pictures/lesson_presentations', 'Slide47_5f872a47c466c.JPG', 'Active', '2020-10-14 16:41:43', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_videos`
--

INSERT INTO `lesson_videos` (`id`, `lesson_id`, `file_path`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/videos/lesson_videos', 'Expository Writ_5f754f1368ef5.mp4', 'Active', '2020-09-22 07:35:35', '2020-10-01 05:37:55'),
(2, 1, 'storage/videos/lesson_videos', 'Writing an Expo_5f754f136fcfd.mp4', 'Active', '2020-09-22 07:35:35', '2020-10-01 05:37:55'),
(3, 2, 'storage/videos/lesson_videos', 'Persuasive Writ_5f872a47a0ad8.mkv', 'Active', '2020-10-14 16:41:43', NULL),
(4, 2, 'storage/videos/lesson_videos', 'Persuasive Writ_5f872a47a12c7.mkv', 'Active', '2020-10-14 16:41:43', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `file_path`, `file_name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'storage/pictures/users', '100872202_95963_1597406072.jpg', 'profile', 'Active', '2020-08-14 11:54:32', NULL),
(2, 'storage/pictures/identity_cards', 'Test-ID 1_1597406073.jpg', 'identity_card', 'Active', '2020-08-14 11:54:33', NULL),
(3, 'storage/pictures/users', 'default-m.png', 'profile', 'Active', '2020-08-14 14:42:29', NULL),
(11, 'storage/pictures/lessons', 'slide1-l_5f754ebe3b208.jpg', 'lesson', 'Active', '2020-09-22 07:35:35', '2020-10-01 05:36:30'),
(12, 'storage/pictures/users', 'default-m.png', 'profile', 'Active', '2020-10-07 16:44:19', NULL),
(13, 'storage/pictures/users', 'default-f.png', 'profile', 'Active', '2020-10-07 16:46:17', NULL),
(14, 'storage/pictures/identity_cards', 'PRC_1602089177.png', 'identity_card', 'Active', '2020-10-07 16:46:17', NULL),
(15, 'storage/pictures/lessons', 'Slide1_1602693703.JPG', 'lesson', 'Active', '2020-10-14 16:41:43', NULL),
(16, 'storage/pictures/users', 'default-m.png', 'profile', 'Active', '2020-10-17 03:00:54', NULL),
(17, 'storage/pictures/users', 'default-m.png', 'profile', 'Active', '2020-10-17 03:42:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` mediumtext,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `user_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Apple', 'Fruit that color red', 'Active', '2020-08-14 12:02:11', '2020-08-14 19:57:29'),
(2, 5, 'Orange', 'Fruit that color orange', 'Active', '2020-08-14 12:24:32', NULL),
(5, 5, 'Watermelon', 'Fruit that color green stripe', 'Active', '2020-08-14 13:55:17', NULL),
(6, 5, 'Grapes', 'Fruit that color purple', 'Active', '2020-08-14 13:55:27', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `teacher_user_id`, `section_id`, `profile_photo_id`, `sex`, `date_of_birth`, `mobile_number`, `educational_attainment`, `school_attended`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 5, 1, 3, 'Male', '1998-04-18', '09666936870', 'College', 'University of Caloocan City', 'Active', '2020-08-14 14:42:29', NULL),
(2, 10, 5, 2, 17, 'Female', '1997-10-05', '9886463322', 'College', 'St. Claire College', 'Active', '2020-10-17 03:42:17', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activities`
--

INSERT INTO `student_activities` (`id`, `user_id`, `activity_id`, `activity_item_id`, `answer`, `checked`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 3, 1, 'This is an exampl of a sentence with two mispelled words. just type your text and click the ABC icon on the CKEditor toolbar to see how it works.', 1, 'Active', '2020-10-25 23:56:54', '2020-10-26 01:04:15'),
(2, 10, 3, 2, 'This is an exampl of a sentence with two mispelled words. just type your text and click the ABC icon on the CKEditor toolbar to see how it works.', 1, 'Active', '2020-10-25 23:56:54', '2020-10-26 04:18:58'),
(3, 10, 3, 3, 'This is an exampl of a sentence with two mispelled words. just type your text and click the ABC icon on the CKEditor toolbar to see how it works.', 0, 'Active', '2020-10-25 23:56:54', NULL),
(4, 10, 3, 4, 'This is an exampl of a sentence with two mispelled words. just type your text and click the ABC icon on the CKEditor toolbar to see how it works.', 0, 'Active', '2020-10-25 23:56:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_activity_points`
--

CREATE TABLE `student_activity_points` (
  `id` int(11) NOT NULL,
  `student_activity_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `correction` mediumtext NOT NULL,
  `recommendation` mediumtext,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activity_points`
--

INSERT INTO `student_activity_points` (`id`, `student_activity_id`, `point`, `correction`, `recommendation`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '<p>This is an example of a sentence with two misspelled words. Just type your text and click the ABC icon on the CKEditor toolbar to see how it works.</p>\r\n', 'Tried to analyze the sentences and check again if you have mistakes.', 'Active', '2020-10-26 02:57:00', NULL),
(2, 2, 4, 'This is an example of a sentence with two misspelled words. Just type your text and click the ABC icon on the CKEditor toolbar to see how it works.', 'Sample recommendation', 'Active', '2020-10-26 03:18:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext,
  `enable` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `profile_photo_id`, `identity_photo_id`, `sex`, `date_of_birth`, `mobile_number`, `school_name`, `school_address`, `type_of_school`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 2, 'Male', '2000-01-01', '9123456789', 'Caybiga Elementary School', 'Gen. Luis Street, Caybiga, Caloocan City', 'Public', 'Active', '2020-08-14 11:54:33', NULL),
(2, 8, 13, 14, 'Female', '1998-10-18', '9648445464', 'St. Claire College', 'Almar Zabarte Rd. Caloocan City', 'Private', 'Active', '2020-10-07 16:46:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `family_name` text NOT NULL,
  `given_name` text NOT NULL,
  `middle_name` text,
  `email_address` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `family_name`, `given_name`, `middle_name`, `email_address`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makilan', 'Mark', 'Navera', 'mrknvrmkln2nd@gmail.com', '', '$2y$10$AW7IlQ4Xjz.UP4NujPaLLumx7N1/ECSiwEBUZu5AzOyPUyvwUt1e2', 'Active', '2020-07-07 17:22:29', '2020-08-14 13:59:00'),
(5, 2, 'Nesortado', 'Arjay', '', 'arjaynesortado@gmail.com', '', '$2y$10$AW7IlQ4Xjz.UP4NujPaLLumx7N1/ECSiwEBUZu5AzOyPUyvwUt1e2', 'Active', '2020-08-14 11:54:32', NULL),
(6, 3, 'Makilan', 'Mark', 'Navera', 'markmakilan@gmail.com', '', '$2y$10$AW7IlQ4Xjz.UP4NujPaLLumx7N1/ECSiwEBUZu5AzOyPUyvwUt1e2', 'Active', '2020-08-14 14:42:29', '2020-08-14 17:32:46'),
(7, 3, 'Nesortado', 'Ruel', 'Cainday', 'ruelnesortado@gmail.com', '', '$2y$10$n2Q/95MJUokvn1SDwxoKqOriVMbJ4lIKO2h3rQqqydESrlfSprBhu', 'Active', '2020-10-07 16:44:19', NULL),
(8, 2, 'Reyes', 'Gina', 'Cainday', 'ginareyes@gmail.com', '', '$2y$10$Hl1QYgqxKPDNr5VJC48BoeD53t72G7ZR4AwJ8PJHKZljBTVus8MLG', 'Active', '2020-10-07 16:46:17', NULL),
(10, 3, 'deguzman', 'ivan', 'Merit', 'ivandeguzman@gmail.com', 'ivanana', '$2y$10$1MqdY3FlK9gEEkdy2KUo6OEaRxBU/Zd2IQH1CmnayBmolDzu76ure', 'Active', '2020-10-17 03:42:17', '2020-10-19 19:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `activity_items`
--
ALTER TABLE `activity_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson_presentations`
--
ALTER TABLE `lesson_presentations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `lesson_videos`
--
ALTER TABLE `lesson_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_activities`
--
ALTER TABLE `student_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_activity_points`
--
ALTER TABLE `student_activity_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_trashes`
--
ALTER TABLE `system_trashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
