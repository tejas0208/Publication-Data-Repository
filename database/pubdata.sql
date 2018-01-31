-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2018 at 04:42 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

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

CREATE TABLE `attended_by` (
  `recordid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `idrecord` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `approved_by_username` varchar(20) DEFAULT NULL,
  `submitted_by_username` varchar(20) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `filename` varchar(1023) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_id_max`
--

CREATE TABLE `record_id_max` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `branch` varchar(45) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attended_by`
--
ALTER TABLE `attended_by`
  ADD PRIMARY KEY (`recordid`,`username`),
  ADD KEY `attended_to_mis_idx` (`username`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`idrecord`,`username`),
  ADD KEY `record_to_mis_idx` (`username`);

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
  ADD KEY `approved_by_to_mis_idx` (`approved_by_username`,`submitted_by_username`),
  ADD KEY `submitted_by_username` (`submitted_by_username`);

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
  ADD KEY `user_to_level_idx` (`level`),
  ADD KEY `user_branch_idx` (`branch`),
  ADD KEY `user_roles_idx` (`role`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attended_by`
--
ALTER TABLE `attended_by`
  ADD CONSTRAINT `attended_by_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `attended_to_record_id` FOREIGN KEY (`recordid`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `author_to_record_id` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `department` FOREIGN KEY (`department`) REFERENCES `departments` (`department`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `external`
--
ALTER TABLE `external`
  ADD CONSTRAINT `record_id_tab` FOREIGN KEY (`record_id`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`approved_by_username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`submitted_by_username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_branch` FOREIGN KEY (`branch`) REFERENCES `branches` (`branch`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`roles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_to_level` FOREIGN KEY (`level`) REFERENCES `levels` (`level`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
