-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 30, 2020 at 07:03 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `asignments`
--

CREATE TABLE `asignments` (
  `assignment_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_instructor` int(12) NOT NULL,
  `due_time` time DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(12) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_venue` int(11) NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `freq` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `id_course`, `id_venue`, `start`, `end`, `day`, `type`, `freq`) VALUES
(10, 4170103, 1, '11:21:00', '00:56:00', 'Thursday', 'lecture', 'all'),
(11, 4170103, 2, '12:00:00', '13:02:00', 'Tuesday', 'section', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_author` varchar(40) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(20) NOT NULL DEFAULT 'draft',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(12) NOT NULL,
  `credits` int(11) NOT NULL,
  `has_preq` tinyint(1) DEFAULT NULL,
  `is_preq` tinyint(1) DEFAULT NULL,
  `has_labs` tinyint(1) DEFAULT NULL,
  `has_practical` tinyint(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `credits`, `has_preq`, `is_preq`, `has_labs`, `has_practical`, `name`) VALUES
(1, 0, 0, 0, 0, 0, 'Level 1'),
(4170101, 2, 0, 1, 1, 0, 'Math I'),
(4170102, 2, 1, 1, 1, 0, 'Math II'),
(4170103, 3, 0, 1, 1, 1, 'Introduction to Computing Technology');

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
  `grade` float DEFAULT NULL,
  `gpa` float DEFAULT NULL,
  `oral` float DEFAULT NULL,
  `midterm` float DEFAULT NULL,
  `course_work` varchar(255) DEFAULT NULL
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

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id_user`, `instructor_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(12) NOT NULL,
  `id_course` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `open_courses`
--

CREATE TABLE `open_courses` (
  `id_course` int(12) NOT NULL,
  `instrutcor_type` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `id_instructor` int(12) NOT NULL
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
  `votes` int(11) NOT NULL DEFAULT 0
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id_asignment` int(12) NOT NULL,
  `grade` float DEFAULT NULL,
  `id_student` int(12) NOT NULL
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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `national_id`, `type`, `email`, `password`, `gender`, `mobile_number`, `home_number`) VALUES
(1, 'Abdulrahman', 'Khalid', 'Ibrahim', 12345678910, 'proffesor', 'sim.abdulrahman.khaled@alexu.edu.eg', 'abdo1206', 'male', '01281141753', 'none'),
(2, 'Sherief', 'Hazem', 'Hazem', 0, 'SA', 'sim.sherief@alexu.edu.eg', '123456', 'male', '01201201200', '1233222');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(12) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `name`) VALUES
(1, 'hall 9'),
(2, 'SIM Lab');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `vote_value` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id_post`, `id_user`, `vote_value`) VALUES
(59, 1, 1),
(0, 2, 1),
(0, 2, -1),
(0, 2, -1),
(0, 1, -1),
(0, 1, 1),
(0, 1, -1),
(0, 1, 1),
(0, 1, -1),
(0, 1, 1),
(0, 1, -1),
(0, 1, -1),
(0, 1, 1),
(0, 1, -1),
(0, 1, 1),
(63, 1, 1);

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
  ADD UNIQUE KEY `instructor_id` (`id_instructor`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
  ADD KEY `id_user_materials_fk` (`id_user`);

--
-- Indexes for table `open_courses`
--
ALTER TABLE `open_courses`
  ADD PRIMARY KEY (`id_course`,`id_instructor`),
  ADD KEY `id_instructor_open_fk` (`id_instructor`);

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
  ADD PRIMARY KEY (`venue_id`);

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
  MODIFY `class_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `id_instructors_assignments_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `id_course_materials_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_materials_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_courses`
--
ALTER TABLE `open_courses`
  ADD CONSTRAINT `id_course_open_fk` FOREIGN KEY (`id_course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_instructor_open_fk` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
