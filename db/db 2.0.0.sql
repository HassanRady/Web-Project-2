-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 01:49 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `open_courses`
--

CREATE TABLE `open_courses` (
  `level` int(1) DEFAULT 1,
  `student_count` int(11) NOT NULL DEFAULT 0,
  `course_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `id_post` int(12) NOT NULL,
  `poll_option` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL
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
  `votes` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `id_course` int(12) NOT NULL,
  `prerequisite_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id_user` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(12) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `sem_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id_asignment` int(12) NOT NULL,
  `grade` float DEFAULT 0,
  `id_student` int(12) NOT NULL,
  `handin_date` date NOT NULL,
  `handin_time` time NOT NULL
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
  `home_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `venue_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD UNIQUE KEY `instructor_id` (`id_instructor`),
  ADD KEY `id_semester_assignmets_fk` (`id_semester`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `course_id` (`id_course`),
  ADD UNIQUE KEY `venue_id` (`id_venue`);

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
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`id_post`);

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
  MODIFY `assignment_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(12) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `id_post_poll_options_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
