-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 11:13 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET FOREIGN_KEY_CHECKS=0;
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
CREATE DATABASE IF NOT EXISTS `sim` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sim`;

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
(41, 24),
(14, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `asignments`
--

CREATE TABLE `asignments` (
  `assignment_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `due_time` time NOT NULL,
  `due_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `id_semester` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `assignment` text NOT NULL,
  `description` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asignments`
--

INSERT INTO `asignments` (`assignment_id`, `id_course`, `id_instructor`, `due_time`, `due_date`, `publish_date`, `id_semester`, `title`, `assignment`, `description`, `points`) VALUES
(5, 1, 8, '17:13:00', '2021-02-20', '2021-02-20', 1, 'First', 'chapter1.pdf', 'first assig', 0),
(7, 2, 18, '17:29:00', '2021-02-20', '2021-02-20', 1, 'First', 'photo-1503023345310-bd7c1de61c7d.jfif', 'from data mining\r\n', 0),
(8, 2, 18, '08:37:00', '2021-02-21', '2021-02-21', 1, 'Second data mining', 'bk5.jpg', 'from data minig', 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_venue` int(12) NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `day` date DEFAULT NULL,
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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `id_post`, `id_user`, `comment_author`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 9, 8, 'islam kabany', 'hi', '', '2021-02-20'),
(2, 13, 33, 'ghada ghada', 'first', '', '2021-02-21'),
(3, 13, 33, 'ghada ghada', 'second', '', '2021-02-21'),
(5, 13, 33, 'ghada ghada', 'third\r\n', '', '2021-02-21'),
(6, 12, 33, 'ghada ghada', 'here', '', '2021-02-21'),
(7, 13, 1, 'hassan khaled', 'fourth', '', '2021-02-21');

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
(1, 'Web', 3, 0, 0, 0, 'university', 'no'),
(2, 'Data Mining', 3, 0, 1, 1, 'university', 'yes'),
(3, 'Graphics', 3, 0, 1, 1, 'faculty', 'no'),
(4, 'Multi Media', 3, 0, 1, 1, 'sim', 'no'),
(5, 'Advanced Multi Media', 3, 1, 0, 0, 'sim', 'no');

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
(1, 1, 1, '5', 0, 0, 4, 0, 0, 0),
(1, 2, 1, NULL, 0, 0, 5, 0, 0, 0),
(2, 1, 1, NULL, 10, 10, 10, 10, 10, 0);

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
(8, 8),
(26, 10),
(28, 13),
(30, 15),
(31, 16),
(33, 18),
(34, 19),
(35, 20),
(36, 21),
(38, 22),
(41, 24),
(24, 101),
(14, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `material_ref` varchar(255) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `id_course`, `id_user`, `title`, `material_ref`, `semester_id`) VALUES
(3, 1, 8, 'first material', '../files/6031fe182c77d4.72196353.jpg', 1),
(4, 2, 33, 'first material from data mining course', '', 1);

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
(3, 0, 1),
(4, 0, 2),
(4, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `open_courses_instructors`
--

CREATE TABLE `open_courses_instructors` (
  `instructor_id` int(11) NOT NULL,
  `course_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `open_courses_instructors`
--

INSERT INTO `open_courses_instructors` (`instructor_id`, `course_id`) VALUES
(18, 2),
(8, 1),
(24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(10) NOT NULL,
  `id_user` int(12) NOT NULL,
  `poll_content` text NOT NULL,
  `poll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `id_user`, `poll_content`, `poll_date`) VALUES
(3, 8, 'choose', '2021-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `option_id` int(12) NOT NULL,
  `id_poll` int(10) NOT NULL,
  `option_content` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`option_id`, `id_poll`, `option_content`, `votes`) VALUES
(2, 3, 'big', NULL),
(3, 3, 'medium', NULL),
(4, 3, 'small', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id_user` int(12) NOT NULL,
  `id_poll` int(10) NOT NULL,
  `id_option` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`id_user`, `id_poll`, `id_option`) VALUES
(8, 3, 2),
(8, 3, 2),
(1, 3, 2),
(1, 3, 2);

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
  `votes` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `id_user`, `id_course`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_views_count`, `votes`) VALUES
(9, 8, 1, 'title', 'islam kabany', 'SA', '2021-02-20', '', 'from islam', 'islam kabany', 0, 0),
(10, 8, 1, 'title', 'islam kabany', 'SA', '2021-02-20', '', 'from isalm 2\r\n', 'islam kabany', 0, -1),
(11, 33, 2, 'title', 'ghada ghada', 'SA', '2021-02-20', '', 'from ghada', 'ghada ghada', 0, 0),
(12, 33, 2, 'title', 'ghada ghada', 'SA', '2021-02-20', '', 'from ghada', 'ghada ghada', 0, 1),
(13, 33, 2, 'title', 'ghada ghada', 'SA', '2021-02-20', '', 'from ghada', 'ghada ghada', 0, -1),
(14, 1, 1, 'title', 'hassan khaled', 'SA', '2021-02-21', '', 'hi in web', 'hassan khaled', 0, 0),
(15, 1, 2, 'title', 'hassan khaled', 'SA', '2021-02-21', '', 'hi in data mining', 'hassan khaled', 0, 0);

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
(5, 4);

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
(8, 8, ''),
(28, 13, ''),
(33, 18, '@ITI'),
(34, 19, ''),
(35, 20, ''),
(36, 21, ''),
(41, 24, '');

-- --------------------------------------------------------

--
-- Table structure for table `sas`
--

CREATE TABLE `sas` (
  `id_user` int(12) NOT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sas`
--

INSERT INTO `sas` (`id_user`, `department`) VALUES
(24, ''),
(31, ''),
(38, '');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(12) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `sem_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `season`, `sem_year`) VALUES
(1, 'fall spring', 2020);

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
) ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_user`, `student_id`, `arabic_name`, `level`, `finished_hours`, `cgpa`, `student_group`, `status`, `address`, `guardian_mobile_number`, `student_type`) VALUES
(1, 1, 'حسن خالد', 3, 0, 0, 0, 'N/A', 'smoha, nasr street', '**', 'Math 0'),
(2, 2, 'عمر خالد', 3, 0, 0, 0, 'N/A', 'smoha, nasr street', '2', 'Math 1'),
(5, 5, 'محمد علاء', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '5', 'Math 1'),
(29, 101, 'حسن خالد راضي', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '', ''),
(32, 20, 'حسن خالد حسن راضي', 1, 0, 0, 0, 'N/A', 'smoha, nasr street', '17', ''),
(40, 21, 'arabic', 1, 0, 0, 0, 'N/A', '123 main st', '23', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `tas`
--

CREATE TABLE `tas` (
  `id_user` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tas`
--

INSERT INTO `tas` (`id_user`, `id_instructor`, `department`) VALUES
(26, 10, ''),
(30, 15, '');

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
(1, 'hassan', 'khaled', 'hassan', 1, 'student', 'sim.hassan.khaled@alexu.edu.eg', '123', 'Male', '[0],', '', 'profile_images/bk5.jpg'),
(2, 'omar', 'khaled', 'taha', 2, 'student', 'om4r_kh4lid@yahoo.com', '123', 'Male', '2', '', 'profile_images/rock2.jpg'),
(5, 'mohamed', 'alaa', 'gaber', 5, 'student', 'sim.mohamed.alaa@alexu.edu.eg', '$2y$10$QoLOGId5/WHVH4HbD9xKQu.PH89PyPAwIniDyQ6u6iGOZ4skA/muG', 'Male', '5', '', 'profile_images\\profile.png'),
(8, 'islam', 'kabany', 'islam', 8, 'professor', 'islam3@yahoo.com', '123', 'Male', '88', '/-', 'profile_images/38797033_10160632376490655_5348618237946888192_o.jpg'),
(14, 'isalm', 'islam', 'islam', 11111111111112, 'sa', 'islam5@alexu.edu.eg', '$2y$10$t3hkovOpOFGcc9MPWUzPruPRJZMXo2Apc9NRCWcC3ZlMZjOkKEdQe', 'Male', '01111111112', '', 'profile_images\\profile.png'),
(24, 'mona', 'mohamed', 'mohamed', 101, 'sa', 'mona@me.com', '123', 'Female', 'UnKnwon', '', 'profile_images/photo-1503023345310-bd7c1de61c7d.jfif'),
(26, 'mai', 'mo', 'mo', 10, 'ta', 'mai@me.com', '$2y$10$X5u2mbB.VDM7hF2rPUTgEuYZCSC/wqBlBETvtv5dwRN72cmFwCBCO', 'Female', '103', '', 'profile_images\\profile.png'),
(28, 'islam66', 'islam', 'islam', 13, 'professor', 'islam6@me.com', '$2y$10$fiYyDN5ODRGdAKL31xj7BeLflRwh4g/ziDEmsD6Ne4JC1DPSvIdqi', 'Male', '10.5', '', 'profile_images\\profile.png'),
(29, 'hassan2', 'hassan', 'hassan', 14, 'student', 'hassan2@me.com', '$2y$10$3Sbh6/EXVoh3NgYdR7SufOGygjY8VriDwSr.pWOPAGaGCcb0gxNuq', 'Male', '+201277787001+', '', 'profile_images\\profile.png'),
(30, 'ahmed', 'ahmed', 'ahmed', 15, 'ta', 'ahmed@me.com', '$2y$10$6Kb.jfW78P0hd6eegxZy7ui3wZQRrAw/XJKZRxb8EqY/Mt91ASH8a', 'Male', '1.5', '', 'profile_images\\profile.png'),
(31, 'joe', 'joe', 'joe', 16, 'sa', 'joe@me.com', '$2y$10$BlRl81GzKMHsD95lyCud6.ZAVB/3n361bLOVGLw6g7mvaf1Sd0vKy', 'Male', '16.', '', 'profile_images\\profile.png'),
(32, 'hassan khaled hassan', 'mahmoud', 'rady', 17, 'student', 'Hassan4@me.com', '$2y$10$6NLrGj49binvilq4js41iOTuwCm0EyhC2Xn0vxZgQ6RGRzUpQYNqW', 'Male', '+++', '', 'profile_images/rock.jfif'),
(33, 'ghada', 'ghada', 'ghada', 18, 'professor', 'ghada@me.com', '123', 'Female', '18', '18', 'profile_images/photo-1503023345310-bd7c1de61c7d.jfif'),
(34, 'mohammed', 'mohammed', 'mohammed', 19, 'professor', 'mohammed@me.com', '$2y$10$F5GSMt4rdfH8fZhioS.vE.ij9yRkvXp.rBqzS5E4iijGbvO2pTF4K', '', '19', '19', 'profile_images\\profile.png'),
(35, 'mike', 'mike', 'mike', 20, 'admin', 'mike@me.com', '123', 'Male', '20', '20', 'profile_images\\profile.png'),
(36, 'maya', 'maya', 'maya', 21, 'professor', 'maya@me.com', '$2y$10$pVrYgeBAxl19W2L2FKCH/.9euABjRtZz9H830CKWuPHJMewOLQLC6', 'Female', '21', '21', 'profile_images\\profile.png'),
(38, 'amy', 'x', 'x', 22, 'sa', 'amy@me.com', '$2y$10$LqE4DQ965JoKmaAl7jEo7.mViM3RA6qPLXmZQM0pqJNQOp4mopCiC', 'Female', '22', '22', 'profile_images\\profile.png'),
(40, 'russ', 'x', 'x', 23, 'student', 'russ@me.com', '123', 'Male', '23', '23', 'profile_images\\profile.png'),
(41, 'zoro', 'x', 'x', 24, 'admin', 'zoro@me.com', '$2y$10$ie87qePnXK3RZzYQgS8ZiuY9NOmRwj7S3KlZZmsDcOXLM22iCEz7S', 'Male', '24', '24', 'profile_images\\profile.png');

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
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id_user`, `id_post`, `vote_value`) VALUES
(8, 10, -1),
(33, 12, 1),
(33, 13, -1);

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
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD UNIQUE KEY `venue_id` (`id_venue`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `id_user_comments_fk` (`id_user`),
  ADD KEY `id_post_comments_fk` (`id_post`);

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
  ADD PRIMARY KEY (`material_id`,`id_course`,`id_user`),
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD KEY `id_semester_materials_fk` (`semester_id`),
  ADD KEY `id_user_materials_fk` (`id_user`);

--
-- Indexes for table `open_courses`
--
ALTER TABLE `open_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `open_courses_instructors`
--
ALTER TABLE `open_courses_instructors`
  ADD KEY `oci_instructor_fk` (`instructor_id`),
  ADD KEY `oci_course_fk` (`course_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `id_user_polls_fk` (`id_user`);

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
  ADD KEY `id_user_posts_fk` (`id_user`);

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
  ADD PRIMARY KEY (`id_user`);

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
  ADD KEY `id_instructors_tas_fk` (`id_instructor`);

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
  MODIFY `assignment_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `option_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  ADD CONSTRAINT `id_course_assignments_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_instructors_assignments_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_semester_assignmets_fk` FOREIGN KEY (`id_semester`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `id_course_classes_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_venue_classes_fk` FOREIGN KEY (`id_venue`) REFERENCES `venues` (`venue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `id_post_comments_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_comments_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `open_courses_instructors`
--
ALTER TABLE `open_courses_instructors`
  ADD CONSTRAINT `oci_course_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oci_instructor_fk` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
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
  ADD CONSTRAINT `id_user_posts_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `id_asignment_student_assignments_fk` FOREIGN KEY (`id_asignment`) REFERENCES `asignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
