-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 01:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_user` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_user`, `id_instructor`) VALUES
(47, 0),
(62, 11);

-- --------------------------------------------------------

--
-- Table structure for table `asignments`
--

CREATE TABLE `asignments` (
  `assignment_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `id_semester` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `due_time` time NOT NULL,
  `due_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `assignment` text NOT NULL,
  `description` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asignments`
--

INSERT INTO `asignments` (`assignment_id`, `id_course`, `id_instructor`, `id_semester`, `title`, `due_time`, `due_date`, `publish_date`, `assignment`, `description`, `points`) VALUES
(2, 6, 9, 1, 'from soft_eng2', '16:55:00', '2021-02-22', '2021-02-22', 'bk5.jpg', 'N/A', 0),
(3, 5, 4, 1, 'from adv_multi', '08:07:00', '2021-02-23', '2021-02-23', 'bk5.jpg', 'N/A', 0),
(5, 5, 0, 1, 'from adv_multi2', '11:27:00', '2021-03-15', '2021-03-15', 'rock.jfif', 'test', 0),
(6, 0, 0, 5, 'dfasf', '04:34:00', '2021-03-10', '2021-03-16', 'db v2.0.6.sql', 'zzzz', 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `id_venue` int(12) NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `students_group` int(2) DEFAULT NULL,
  `freq` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(12) NOT NULL,
  `id_post` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credits` int(11) NOT NULL,
  `has_preq` tinyint(1) DEFAULT NULL,
  `has_labs` tinyint(1) DEFAULT NULL,
  `has_practical` tinyint(1) DEFAULT NULL,
  `category` varchar(20) NOT NULL DEFAULT 'university',
  `elective` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `name`, `credits`, `has_preq`, `has_labs`, `has_practical`, `category`, `elective`) VALUES
(0, 'General Announcement', 0, 0, 0, 0, 'university', 'no'),
(1, 'Web', 3, 0, 0, 0, 'university', 'no'),
(2, 'Data Mining', 3, 0, 1, 1, 'university', 'yes'),
(3, 'Graphics', 3, 0, 1, 1, 'faculty', 'no'),
(4, 'Multi Media', 3, 0, 1, 1, 'sim', 'no'),
(5, 'Advanced Multi Media', 3, 1, 0, 0, 'sim', 'no'),
(6, 'Software engineering', 3, 0, 1, 1, 'sim', 'no'),
(7, 'Software Req', 3, 1, 1, 1, 'sim', 'no'),
(8, 'Mobile', 3, 0, 1, 1, 'sim', 'no'),
(9, 'Math 4', 2, 0, 0, 0, 'university', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `course_discussions`
--

CREATE TABLE `course_discussions` (
  `id_post` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `upvotes` int(11) DEFAULT NULL,
  `downvotes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_semester_students`
--

CREATE TABLE `course_semester_students` (
  `id_student` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_semester` int(12) NOT NULL,
  `grade` varchar(1) DEFAULT NULL,
  `gpa` float DEFAULT 0,
  `oral` float DEFAULT 0,
  `midterm` float DEFAULT 0,
  `course_work` float DEFAULT 0,
  `practical` float DEFAULT 0,
  `final` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_semester_students`
--

INSERT INTO `course_semester_students` (`id_student`, `id_course`, `id_semester`, `grade`, `gpa`, `oral`, `midterm`, `course_work`, `practical`, `final`) VALUES
(1, 5, 1, NULL, 0, 0, 0, 0, 0, 0),
(1, 6, 1, NULL, 0, 0, 0, 0, 0, 0),
(5, 5, 1, NULL, 0, 0, 0, 0, 0, 0),
(5, 6, 1, NULL, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `empty_venues`
--

CREATE TABLE `empty_venues` (
  `id_venue` int(12) NOT NULL,
  `venue_from` datetime DEFAULT NULL,
  `venue_to` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id_user` int(12) NOT NULL,
  `instructor_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id_user`, `instructor_id`) VALUES
(47, 0),
(48, 4),
(57, 5),
(50, 6),
(58, 7),
(53, 9),
(61, 10),
(62, 11);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `semester_id` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `material_ref` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `id_course`, `id_user`, `semester_id`, `title`, `material_ref`) VALUES
(1, 6, 53, 1, 'from soft_eng', '../files/6033c266cd40f5.78443536.jpg'),
(2, 6, 53, 1, 'from soft_eng2', '../files/6033c279576117.52838684.jpg'),
(3, 5, 48, 1, 'from adv_multi', '../files/60349bca223d61.90843225.jpg'),
(4, 5, 48, 1, 'from adv_multi2', '../files/60349bd3b33241.63669873.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `open_courses`
--

CREATE TABLE `open_courses` (
  `level` int(1) DEFAULT 1,
  `student_count` int(11) NOT NULL DEFAULT 0,
  `course_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `open_courses`
--

INSERT INTO `open_courses` (`level`, `student_count`, `course_id`) VALUES
(2, 0, 1),
(3, 0, 2),
(3, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `open_courses_instructors`
--

CREATE TABLE `open_courses_instructors` (
  `instructor_id` int(11) NOT NULL,
  `course_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(10) NOT NULL,
  `id_user` int(12) NOT NULL,
  `poll_content` text NOT NULL,
  `poll_date` date NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `option_id` int(12) NOT NULL,
  `id_poll` int(10) NOT NULL,
  `option_content` varchar(255) DEFAULT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id_user` int(12) NOT NULL,
  `id_poll` int(10) NOT NULL,
  `id_option` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL,
  `votes` int(5) NOT NULL DEFAULT 0,
  `id_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `id_course` int(12) NOT NULL,
  `prerequisite_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`id_course`, `prerequisite_id`) VALUES
(5, 4),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id_user` int(12) NOT NULL,
  `id_instructor` int(14) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id_user`, `id_instructor`, `description`) VALUES
(47, 0, ''),
(48, 4, ''),
(53, 9, ''),
(57, 5, ''),
(58, 7, ''),
(62, 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `sas`
--

CREATE TABLE `sas` (
  `id_user` int(12) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `id_instructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sas`
--

INSERT INTO `sas` (`id_user`, `department`, `id_instructor`) VALUES
(50, '', 6),
(61, '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(12) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `sem_year` year(4) DEFAULT NULL,
  `ongoing` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `season`, `sem_year`, `ongoing`) VALUES
(1, 'summer', 2020, 0),
(2, 'spring', 2020, 0),
(3, 'fall', 2021, 0),
(4, 'summer', 2021, 0),
(5, 'spring', 2021, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_user` int(12) NOT NULL,
  `student_id` int(11) NOT NULL,
  `arabic_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `level` int(1) NOT NULL DEFAULT 1,
  `finished_hours` int(3) NOT NULL DEFAULT 0,
  `cgpa` float NOT NULL DEFAULT 0,
  `student_group` int(2) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT 'N/A',
  `address` varchar(255) NOT NULL,
  `guardian_mobile_number` varchar(255) NOT NULL,
  `student_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_user`, `student_id`, `arabic_name`, `level`, `finished_hours`, `cgpa`, `student_group`, `status`, `address`, `guardian_mobile_number`, `student_type`) VALUES
(1, 1, 'حسن خالد', 3, 0, 0, 0, 'N/A', 'smoha, nasr street', '**', 'Math 0'),
(2, 2, 'عمر خالد', 3, 0, 0, 0, 'N/A', 'smoha, nasr street', '2', 'Math 1'),
(51, 3, 'عبدالرحمن خالد', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '7', ''),
(52, 4, 'arabic', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '8', ''),
(56, 5, 'arabic', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id_asignment` int(12) NOT NULL,
  `grade` float DEFAULT 0,
  `id_student` int(12) NOT NULL,
  `handin_date` date NOT NULL,
  `handin_time` time NOT NULL,
  `student_assignment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_assignments`
--

INSERT INTO `student_assignments` (`id_asignment`, `grade`, `id_student`, `handin_date`, `handin_time`, `student_assignment`) VALUES
(2, 0, 1, '2021-03-15', '03:38:43', 'rock.jfif'),
(2, 0, 5, '2021-03-13', '06:43:47', 'photo-1503023345310-bd7c1de61c7d.jfif'),
(3, 0, 1, '2021-03-15', '08:38:24', 'rock.jfif'),
(3, 0, 5, '2021-03-15', '08:50:20', 'rock2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tas`
--

CREATE TABLE `tas` (
  `id_user` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `national_id` bigint(14) NOT NULL,
  `type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `home_number` varchar(255) DEFAULT NULL,
  `image_path` text DEFAULT 'profile_images\\profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `national_id`, `type`, `email`, `password`, `gender`, `mobile_number`, `home_number`, `image_path`) VALUES
(1, 'hassan', 'khaled', 'hassan', 1, 'student', 'sim.hassan.khaled@alexu.edu.eg', '$2y$10$5ne8dXl5K.J6heByPPB50.iq0ByKpL3EjygJz.fSJK.cakNhhBbJa', 'Male', '1', '', 'profile_images/IMG_E0889 - Copy.Jpeg'),
(2, 'omar', 'khaled', 'taha', 2, 'student', 'om4r_kh4lid@yahoo.com', '$2y$10$Bq7aqctcHhuCuVzuaVG07ucs8q2myPxLaf5Q1iAEs3mUKtA.cWaVW', 'Male', '2', '', 'profile_images/rock2.jpg'),
(47, 'islam', 'xxx', 'xxx', 3, 'admin', 'islam@me.com', '$2y$10$FdwmShk3JXswzwibwaDjn.MxZ.mwc9ld0aIaKd3r2BG6Y7vEDgvCy', 'Male', '3', '', 'profile_images/38797033_10160632376490655_5348618237946888192_o.jpg'),
(48, 'mohamed', 'xxx', 'xxx', 4, 'professor', 'mohamed@me.com', '$2y$10$DCGsgEtRDrVFyxfiV3CyPuFYcRuYxgH06kRO6wogFAdD/Y.gEYETu', 'Male', '4', '', 'profile_images\\profile.png'),
(50, 'mona', 'xxx', 'xxx', 6, 'sa', 'mona@me.com', '$2y$10$DKiS3G4XTzPln/UyJa6YUuMIsomWTNydvapCCyU7WJPoZQPSDPVKa', 'Female', '6', '', 'profile_images\\profile.png'),
(51, 'abdalrahman', 'khaled', 'ibrahiem', 7, 'student', 'abdalrahman@me.com', '$2y$10$PMiq.5jWSETu3gtZDEn2AeZMdBDaOjr6GqLvEAg0giE4RrGmKkoSm', 'Male', '7', '', 'profile_images\\profile.png'),
(52, 'abdullah', 'yaser', 'gaber', 8, 'student', 'abdullah@me.com', '$2y$10$7mg3UFA3ikigKW22Ao3qFewAsNcrfma4307KiDmEfAqoEJ.XqAgZC', 'Male', '8', '', 'profile_images\\profile.png'),
(53, 'yasser', 'xxx', 'xxx', 9, 'professor', 'yasser@me.com', '$2y$10$6zT3mjOwz0OPyns628YCa.8LNx7LzY/mHIranZ/IOx1DQ5GB2YjXe', 'Male', '9', '', 'profile_images\\profile.png'),
(56, 'Mariam', 'Ahmed', 'Alaa', 10, 'student', 'mariam@me.com', '$2y$10$W1UiQQaeRBIcGY0SkJCDqeO532O0omjscd0oU0fJ/XxdBy2DE8hFq', 'Female', '5', '', 'profile_images\\profile.png'),
(57, 'mohammed', 'x', 'x', 11, 'professor', 'data@me.com', '$2y$10$THnkGw0G3egzeB.EsTaCl.gUZwb7/RAZ9BWGdsaaXIWR0iT.rIn6G', 'Male', '11', '', 'profile_images\\profile.png'),
(58, 'nermen', 'x', 'x', 12, 'professor', 'graphics@me.com', '$2y$10$/.a6Rl/OgZQuSFi36yQS7eigx.uL/GMnr5a0CHrc1srtkWO6iu4cK', 'Female', '12', '', 'profile_images\\profile.png'),
(61, 'Sherif', 'xx', 'xx', 13, 'sa', 'Sherif@me.com', '$2y$10$7ECb91ZnbpF3X.njcX2tpuydXSJntG.pFDi8Jp/O4qD3UjYF3jWTq', 'Male', '13', '', 'profile_images\\profile.png'),
(62, 'x', 'x', 'x', 14, 'admin', 'x@me.com', '$2y$10$qUgdQcw//OLS/bVQO/EfdOAMuQBTqGuxjiGj9a7fMAj68/CkBOrl.', 'Female', '14', '', 'profile_images\\profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `venue_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `name`, `venue_location`) VALUES
(1, 'Hall 9', '2413558.jpg'),
(2, 'Hall 8', 'bk5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id_user` int(12) NOT NULL,
  `id_post` int(12) NOT NULL,
  `vote_value` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_instructors_admins_fk` (`id_instructor`);

--
-- Indexes for table `asignments`
--
ALTER TABLE `asignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `id_course_assignments_fk` (`id_course`),
  ADD KEY `id_semester_assignmets_fk` (`id_semester`),
  ADD KEY `id_instructors_assignment_fk` (`id_instructor`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `id_instructors_classes_fk` (`id_instructor`),
  ADD KEY `id_course_classes_fk` (`id_course`),
  ADD KEY `id_venue_classes_fk` (`id_venue`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `id_post_comments_fk` (`id_post`),
  ADD KEY `id_user_comments_fk` (`id_user`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_discussions`
--
ALTER TABLE `course_discussions`
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD KEY `id_post_course_discussions_fk` (`id_post`);

--
-- Indexes for table `course_semester_students`
--
ALTER TABLE `course_semester_students`
  ADD PRIMARY KEY (`id_student`,`id_course`,`id_semester`),
  ADD KEY `id_course_course_semester_students_fk` (`id_course`),
  ADD KEY `id_semester_course_semester_students_fk` (`id_semester`);

--
-- Indexes for table `empty_venues`
--
ALTER TABLE `empty_venues`
  ADD PRIMARY KEY (`id_venue`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD UNIQUE KEY `id` (`id_user`),
  ADD UNIQUE KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `id_user_materials_fk` (`id_user`),
  ADD KEY `id_course_materials_fk` (`id_course`),
  ADD KEY `id_semester_materials_fk` (`semester_id`);

--
-- Indexes for table `open_courses`
--
ALTER TABLE `open_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `open_courses_instructors`
--
ALTER TABLE `open_courses_instructors`
  ADD PRIMARY KEY (`instructor_id`,`course_id`),
  ADD KEY `oci_course_fk` (`course_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `id_user_polls_fk` (`id_user`),
  ADD KEY `id_course_polls_fk` (`id_course`),
  ADD KEY `id_semester_polls_fk` (`id_semester`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `id_poll_poll_options_fk` (`id_poll`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD KEY `id_user_poll_votes_fk` (`id_user`),
  ADD KEY `id_poll_poll_votes_fk` (`id_poll`),
  ADD KEY `id_option_poll_votes_fk` (`id_option`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `id_course_posts_fk` (`id_course`),
  ADD KEY `id_user_posts_fk` (`id_user`),
  ADD KEY `id_option_posts_fk` (`id_semester`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD UNIQUE KEY `pre_id` (`prerequisite_id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `instructor_id` (`id_instructor`),
  ADD UNIQUE KEY `id` (`id_user`);

--
-- Indexes for table `sas`
--
ALTER TABLE `sas`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_instructors_sas_fk` (`id_instructor`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `guardian_mobile_number` (`guardian_mobile_number`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD PRIMARY KEY (`id_asignment`,`id_student`),
  ADD KEY `id_student_student_assignments_fk` (`id_student`);

--
-- Indexes for table `tas`
--
ALTER TABLE `tas`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_instructor` (`id_instructor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`,`home_number`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD KEY `id_post_votes_fk` (`id_post`),
  ADD KEY `id_user_votes_fk` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignments`
--
ALTER TABLE `asignments`
  MODIFY `assignment_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `option_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `id_instructors_admins_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_admins_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asignments`
--
ALTER TABLE `asignments`
  ADD CONSTRAINT `id_course_assignments_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_instructors_assignment_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_semester_assignmets_fk` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`semester_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `id_course_classes_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_instructors_classes_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_venue_classes_fk` FOREIGN KEY (`id_venue`) REFERENCES `venues` (`venue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `id_post_comments_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_comments_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `course_discussions`
--
ALTER TABLE `course_discussions`
  ADD CONSTRAINT `id_course_course_discussions_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_post_course_discussions_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_semester_students`
--
ALTER TABLE `course_semester_students`
  ADD CONSTRAINT `id_course_course_semester_students_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_semester_course_semester_students_fk` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_student_course_semester_students_fk` FOREIGN KEY (`id_student`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `empty_venues`
--
ALTER TABLE `empty_venues`
  ADD CONSTRAINT `id_venue_empty_venues_fk` FOREIGN KEY (`id_venue`) REFERENCES `venues` (`venue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `id_user_instructors_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `id_course_materials_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_semester_materials_fk` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_materials_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `open_courses`
--
ALTER TABLE `open_courses`
  ADD CONSTRAINT `course_id_open_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_courses_instructors`
--
ALTER TABLE `open_courses_instructors`
  ADD CONSTRAINT `oci_course_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oci_instructor_fk` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `id_course_polls_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_semester_polls_fk` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_polls_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `id_poll_poll_options_fk` FOREIGN KEY (`id_poll`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD CONSTRAINT `id_option_poll_votes_fk` FOREIGN KEY (`id_option`) REFERENCES `poll_options` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_poll_poll_votes_fk` FOREIGN KEY (`id_poll`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_poll_votes_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `id_course_posts_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_option_posts_fk` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_posts_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD CONSTRAINT `id_course_prerequisites_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prerequisite_id_prerequisites_fk` FOREIGN KEY (`prerequisite_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `id_instructor_professors_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_professors_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sas`
--
ALTER TABLE `sas`
  ADD CONSTRAINT `id_instructors_sas_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_sas_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `id_user_students_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD CONSTRAINT `id_assignment_studnt_assignment_fk` FOREIGN KEY (`id_asignment`) REFERENCES `asignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_student_student_assignments_fk` FOREIGN KEY (`id_student`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tas`
--
ALTER TABLE `tas`
  ADD CONSTRAINT `id_instructors_tas_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_tas_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `id_post_votes_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_votes_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
