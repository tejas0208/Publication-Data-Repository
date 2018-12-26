-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2018 at 07:56 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pubdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `attended_by`
--
create database pubdata;
use pubdata;

CREATE TABLE `attended_by` (
  `recordid` int(11) NOT NULL,
  `mis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `idrecord` int(11) NOT NULL,
  `mis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch` varchar(45) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch`, `department`) VALUES
('Applied Science', 'Applied Science'),
('Civil Engineering', 'Civil Engineering'),
('Computer Engineering', 'Computer Engineering and Information Technology'),
('Information Technology ', 'Computer Engineering and Information Technology'),
('Electrical Engineering', 'Electrical Engineering'),
('Electronics and Telecommunication Engineering', 'Electronics and Telecommunication Engineering'),
('Instrumentation and Control Engineering ', 'Electronics and Telecommunication Engineering'),
('maths', 'maths'),
('Mechanical Engineering', 'Mechanical Engineering'),
('Metallurgical Engineering', 'Mechanical Engineering'),
('phy', 'phy'),
('Planning', 'Planning '),
('Production Engineering (Sandwich)', 'Production Engineering and Industrial Management');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department`) VALUES
('Applied Science'),
('Civil Engineering '),
('Computer Engineering and Information Technology'),
('Electrical Engineering '),
('Electronics and Telecommunication Engineering '),
('Instrumentation and Control Engineering '),
('maths'),
('Mechanical Engineering '),
('Metallurgy and Material Science '),
('phy'),
('Planning '),
('Production Engineering and Industrial Management');

-- --------------------------------------------------------

--
-- Table structure for table `external`
--

CREATE TABLE `external` (
  `record_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level`) VALUES
('admin'),
('approver'),
('executive'),
('normal');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `idrecord` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(1023) DEFAULT NULL,
  `f_tequip` varchar(2) DEFAULT NULL,
  `f_rsa` varchar(2) DEFAULT NULL,
  `f_isea` varchar(2) DEFAULT NULL,
  `f_aicte` varchar(2) DEFAULT NULL,
  `f_coep` varchar(2) DEFAULT NULL,
  `f_others` varchar(2) DEFAULT NULL,
  `t_tequip` varchar(2) DEFAULT NULL,
  `t_isea` varchar(2) DEFAULT NULL,
  `t_rsa` varchar(2) DEFAULT NULL,
  `t_aicte` varchar(2) DEFAULT NULL,
  `t_coep` varchar(2) DEFAULT NULL,
  `t_others` varchar(2) DEFAULT NULL,
  `nat_journal` varchar(1023) DEFAULT NULL,
  `int_journal` varchar(1023) DEFAULT NULL,
  `nat_conf` varchar(1023) DEFAULT NULL,
  `int_conf` varchar(1023) DEFAULT NULL,
  `volume_no` varchar(45) DEFAULT NULL,
  `pages` varchar(45) DEFAULT NULL,
  `citations` varchar(1023) DEFAULT NULL,
  `approved_status` varchar(2) DEFAULT NULL,
  `approved_by_mis` int(11) DEFAULT NULL,
  `submitted_by_mis` int(11) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `filename` varchar(1023) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_id_max`
--

CREATE TABLE `record_id_max` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `record_id_max`
--

INSERT INTO `record_id_max` (`id`) VALUES
(17);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles`) VALUES
('dean'),
('director'),
('faculty'),
('hod'),
('student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `mis` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `branch` varchar(45) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `mis`, `name`, `email`, `role`, `branch`, `year`, `level`, `department`) VALUES
('111503071', 111503071, 'WADHWA TARUN RAJULAL', 'wadhwatr15.comp@coep.ac.in', 'student', 'Computer Engineering', 2019, 'normal', 'Computer Engineering and Information Technology'),
('111503075', 111503075, 'PATIL AKASH MARUTI', 'patilam15.comp@coep.ac.in', 'student', 'Computer Engineering', 2019, 'normal', 'Computer Engineering and Information Technology'),
('111505048', 111505048, 'SAFNA HASSAN', 'hassans15.elec@coep.ac.in', 'student', 'Computer Engineering', 2019, 'normal', 'Computer Engineering and Information Technology'),
('approver', 111503001, 'ABHYANKAR AKSHAY SAMEER', 'abhyankaras15.comp@coep.ac.in', 'faculty', 'Computer Engineering', NULL, 'approver', 'Computer Engineering and Information Technology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attended_by`
--
ALTER TABLE `attended_by`
  ADD PRIMARY KEY (`recordid`,`mis`),
  ADD KEY `attended_to_mis_idx` (`mis`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`idrecord`,`mis`),
  ADD KEY `record_to_mis_idx` (`mis`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch`,`department`),
  ADD KEY `department_idx` (`department`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department`);

--
-- Indexes for table `external`
--
ALTER TABLE `external`
  ADD PRIMARY KEY (`record_id`,`name`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`idrecord`),
  ADD KEY `approved_by_to_mis_idx` (`approved_by_mis`,`submitted_by_mis`),
  ADD KEY `submitted_by_mis` (`submitted_by_mis`);

--
-- Indexes for table `record_id_max`
--
ALTER TABLE `record_id_max`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `mis_index` (`mis`),
  ADD KEY `user_to_level_idx` (`role`),
  ADD KEY `user_branch_idx` (`branch`),
  ADD KEY `user_roles_idx` (`level`),
  ADD KEY `department` (`department`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attended_by`
--
ALTER TABLE `attended_by`
  ADD CONSTRAINT `attended_by_ibfk_3` FOREIGN KEY (`mis`) REFERENCES `users` (`mis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `attended_to_record_id` FOREIGN KEY (`recordid`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `author_to_record_id` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`department`);

--
-- Constraints for table `external`
--
ALTER TABLE `external`
  ADD CONSTRAINT `record_id_tab` FOREIGN KEY (`record_id`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`approved_by_mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`submitted_by_mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_branch` FOREIGN KEY (`branch`) REFERENCES `branches` (`branch`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_department` FOREIGN KEY (`department`) REFERENCES `departments` (`department`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`roles`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_to_level` FOREIGN KEY (`level`) REFERENCES `levels` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Table structure for applications table

CREATE TABLE `rejection_record` (
  `idrecord` int(11) NOT NULL,
  `reason` varchar(256) NOT NULL
);

ALTER TABLE `rejection_record`
  ADD PRIMARY KEY (`idrecord`);

ALTER TABLE `rejection_record`
  ADD CONSTRAINT `id_record_rejection_fk` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`);
COMMIT;

CREATE TABLE `applications` (
	`aid` int(11),
  `idrecord` int(11) NOT NULL,
`initial_paper` varchar(1023) DEFAULT NULL,
`fund_required` varchar(1023) DEFAULT NULL,
 `approved_level` int(1) DEFAULT 1,
`Comment` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`idrecord`,`aid`)
);

ALTER TABLE `applications`
  ADD CONSTRAINT `id_record_appl_fk` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`);
COMMIT;

-- Adding a missing column to the records table.
ALTER TABLE `record` 
  ADD COLUMN issueno varchar(45);
COMMIT;
