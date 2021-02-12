-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 08:01 PM
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
-- Database: `web-technologies`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `faculty_number` mediumint(8) UNSIGNED NOT NULL,
  `logged_at` datetime DEFAULT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `thrust` tinyint(3) UNSIGNED DEFAULT NULL,
  `check_description` varchar(50) DEFAULT NULL,
  `enroll_source` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `faculty_number`, `logged_at`, `event_id`, `thrust`, `check_description`, `enroll_source`) VALUES
(1, 81000, NULL, 1, NULL, NULL, NULL),
(2, 1234, '2020-12-31 11:15:00', 1, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(3, 929, '2020-12-31 10:15:00', 1, 90, 'добавен от студент-помагач\r\n', 'save-users-list-2.txt'),
(4, 421, '2020-12-31 10:15:00', 1, 100, NULL, 'Проверени от инструктор на място'),
(5, 2340, '2020-12-31 10:15:00', 1, 50, NULL, 'През линк за вход'),
(6, 4524, '2020-12-31 10:15:00', 1, 100, 'направена от инструктор\r\n', 'Ръчна проверка'),
(7, 24233, '2020-12-31 10:15:00', 1, 100, 'списък -  всеки се записва (на хартия) - и после р', 'Ръчна проверка'),
(8, 5453, NULL, 1, 0, NULL, 'Самозаписване в системата(доброволно)\r\n'),
(9, 212, NULL, 1, 0, NULL, 'Самозаписване по даден код (QR/текст) - проверка, '),
(10, 81580, NULL, 5, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `is_visible` tinyint(4) DEFAULT NULL,
  `faculty_number` mediumint(8) UNSIGNED DEFAULT NULL,
  `pending` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `event_id`, `is_visible`, `faculty_number`, `pending`) VALUES
(1, 'Много добър урок!', 5, NULL, 81580, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`, `start`, `end`, `teacher_id`) VALUES
(1, 'JavaScript', 'Основи за javascript', '2021-01-20 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Представяне на знания', 'Кратко описание на събитието', '2021-02-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12),
(3, 'na pesho sybitieto', 'opisanie', '2021-02-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13),
(4, 'Събитие на Стефан', 'описание', '2021-02-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14),
(5, 'Второ събитие', 'това е второто събитие на Петър', '2021-02-12 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `faculty_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `faculty_number`) VALUES
(1, 'Ралица', 'Димитрова', 81580),
(2, 'Николай', 'Найденов', 81565),
(3, 'Петя', 'Иванова', 81111),
(4, 'Радостина', 'Кръстева', 81112),
(5, 'Кристиян', 'Господинов', 81113),
(6, 'Михаил', 'Петков', 81114);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'Петър', '$2y$10$.8BaN/YZD4pWd7IMPuqZpObJS/tH566js8r6xq/k9l9OHOnfBtVJK', NULL, NULL),
(12, 'todor@gmail.com', '$2y$10$.9a7t3HleAoyoLzxZv3MHuE6utL2RdDsDQ0Mz.6GID.s8sv4Y0MyO', 'Тодор', 'Тодоров'),
(13, 'peter@abv.bg', '$2y$10$KdFLWtu2ZWA2BRZUp.ahCuZn4qWUMiKhps8xX46vm1vVDRM7Oa6Ka', 'Петър', 'Иванов'),
(14, 'stef@abv.bg', '$2y$10$QlF3xwQYizGB1FejieYFIO8FEdvFggYeGKEqRihYr2sPBCFtxR8sC', 'Стефан', 'Стефанов');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_attendance_event_id_events_id` (`event_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_event_id_events_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_events_teacher_id_teachers_id` (`teacher_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `FK_attendance_event_id_events_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_event_id_events_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_events_teacher_id_teachers_id` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
