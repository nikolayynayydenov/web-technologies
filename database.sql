-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 01:31 PM
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
(10, 81580, NULL, 5, 100, NULL, NULL),
(11, 1234, '2020-12-31 11:15:00', 6, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(12, 929, '2020-12-31 10:15:00', 6, 90, 'добавен от студент-помагач\r\n', 'save-users-list-2.txt'),
(13, 421, '2020-12-31 10:15:00', 6, 100, NULL, 'Проверени от инструктор на място'),
(14, 2340, '2020-12-31 10:15:00', 6, 50, NULL, 'През линк за вход'),
(15, 4524, '2020-12-31 10:15:00', 6, 100, 'направена от инструктор\r\n', 'Ръчна проверка'),
(16, 24233, '2020-12-31 10:15:00', 6, 100, 'списък -  всеки се записва (на хартия) - и после р', 'Ръчна проверка'),
(17, 5453, NULL, 6, 0, NULL, 'Самозаписване в системата(доброволно)\r\n'),
(18, 212, NULL, 6, 0, NULL, 'Самозаписване по даден код (QR/текст) - проверка, '),
(19, 81580, '0000-00-00 00:00:00', 7, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(20, 81565, '0000-00-00 00:00:00', 7, 90, 'добавен от студент-помагач\r\n', 'save-users-list-2.txt'),
(21, 81111, '0000-00-00 00:00:00', 7, 100, NULL, 'Проверени от инструктор на място'),
(22, 81112, '0000-00-00 00:00:00', 7, 50, NULL, 'През линк за вход'),
(23, 81113, '0000-00-00 00:00:00', 7, 100, 'направена от инструктор\r\n', 'Ръчна проверка'),
(24, 81114, '0000-00-00 00:00:00', 7, 100, 'списък -  всеки се записва (на хартия) - и после р', 'Ръчна проверка'),
(25, 81508, '0000-00-00 00:00:00', 7, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(26, 81510, '0000-00-00 00:00:00', 7, 90, 'добавен от студент-помагач', 'save-users-list-2.txt'),
(27, 81500, '0000-00-00 00:00:00', 3, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(28, 81501, '0000-00-00 00:00:00', 3, 90, 'добавен от студент-помагач\r\n', 'save-users-list-2.txt'),
(29, 81502, '0000-00-00 00:00:00', 3, 100, NULL, 'Проверени от инструктор на място'),
(30, 81503, '0000-00-00 00:00:00', 3, 50, NULL, 'През линк за вход'),
(31, 81504, '0000-00-00 00:00:00', 3, 100, 'направена от инструктор\r\n', 'Ръчна проверка'),
(32, 81506, '0000-00-00 00:00:00', 3, 100, 'списък -  всеки се записва (на хартия) - и после р', 'Ръчна проверка'),
(33, 81111, '0000-00-00 00:00:00', 3, 100, 'проверено от инструктор\r\n', 'save-users-list-1609407912138.txt'),
(34, 81565, '0000-00-00 00:00:00', 3, 90, 'добавен от студент-помагач', 'save-users-list-2.txt');

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
  `pending` tinyint(1) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `event_id`, `is_visible`, `faculty_number`, `pending`, `teacher_id`) VALUES
(1, 'Много добър урок!', 5, 1, 81580, 0, NULL),
(2, 'Моят коментар!', 5, NULL, 81580, 1, NULL),
(3, 'komentar', 6, 1, NULL, 0, 13),
(4, 'Това е моят коментар!', 5, 1, NULL, 0, 13),
(5, 'Благодаря за вниманието!', 7, 1, NULL, 0, 13),
(6, 'моят коментар1', 7, 1, 81111, 0, NULL),
(7, 'Може ли да споделите линка от събитието?', 7, 1, 81500, 0, NULL),
(8, 'моят коментар1', 7, NULL, 81580, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`, `start`, `end`, `teacher_id`) VALUES
(1, 'JavaScript', 'Основи за javascript', '2021-01-20 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Представяне на знания', 'Кратко описание на събитието', '2021-02-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12),
(3, 'Първо събитие', 'Започваме поредица', '2021-02-14 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13),
(4, 'Събитие на Стефан', 'описание', '2021-02-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14),
(5, 'Второ събитие', 'това е второто събитие на Петър', '2021-02-12 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13),
(6, 'Трето събитие на Петър', 'Ранно събитие', '2021-02-13 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13),
(7, 'Четвърто събитие', 'Това е четвъртото събитие!', '2021-02-16 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13);

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
(6, 'Михаил', 'Петков', 81114),
(7, 'Ивана', 'Станева', 81110),
(8, 'Стефан', 'Дамянов', 81500),
(9, 'Боян', 'Георгиев', 81501),
(10, 'Галя', 'Георгиева', 81502),
(11, 'Борислав', 'Димитров', 81503),
(12, 'Ангела', 'Димитрова', 81504),
(13, 'Филип', 'Дамянов', 81505),
(14, 'Вестияна', 'Михова', 81506),
(15, 'Верен', 'Дамянов', 81507),
(16, 'Любов', 'Желева', 81508),
(17, 'Вяра', 'Желева', 81509),
(18, 'Екатерина', 'Зарева', 81510);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
