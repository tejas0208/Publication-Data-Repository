-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: pubdata
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application_id_max`
--

DROP TABLE IF EXISTS `application_id_max`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_id_max` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_id_max`
--

LOCK TABLES `application_id_max` WRITE;
/*!40000 ALTER TABLE `application_id_max` DISABLE KEYS */;
INSERT INTO `application_id_max` VALUES (5);
/*!40000 ALTER TABLE `application_id_max` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `aid` int(11) NOT NULL,
  `idrecord` int(11) NOT NULL,
  `initial_paper` varchar(1023) DEFAULT NULL,
  `fund_required` varchar(1023) DEFAULT NULL,
  `approved_level` int(1) DEFAULT '1',
  `Comment` varchar(1023) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idrecord`,`aid`),
  CONSTRAINT `id_record_appl_fk` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,17,'Test123','10000',8,NULL,'2019-02-18'),(2,19,'Test234','1000',5,'Bad app','2019-02-18'),(4,19,'Test567','12345',3,'Bad application','2019-02-18'),(3,21,'Test345','999999',3,'More bad application','2019-02-18');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attended_by`
--

DROP TABLE IF EXISTS `attended_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attended_by` (
  `recordid` int(11) NOT NULL,
  `mis` int(11) NOT NULL,
  PRIMARY KEY (`recordid`,`mis`),
  KEY `attended_to_mis_idx` (`mis`),
  CONSTRAINT `attended_by_ibfk_3` FOREIGN KEY (`mis`) REFERENCES `users` (`mis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `attended_to_record_id` FOREIGN KEY (`recordid`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attended_by`
--

LOCK TABLES `attended_by` WRITE;
/*!40000 ALTER TABLE `attended_by` DISABLE KEYS */;
/*!40000 ALTER TABLE `attended_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `idrecord` int(11) NOT NULL,
  `mis` int(11) NOT NULL,
  PRIMARY KEY (`idrecord`,`mis`),
  KEY `record_to_mis_idx` (`mis`),
  CONSTRAINT `author_to_record_id` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `branch` varchar(45) NOT NULL,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`branch`,`department`),
  KEY `department_idx` (`department`),
  CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES ('Applied Science','Applied Science'),('Civil Engineering','Civil Engineering'),('Computer Engineering','Computer Engineering and Information Technology'),('Information Technology ','Computer Engineering and Information Technology'),('Electrical Engineering','Electrical Engineering'),('Electronics and Telecommunication Engineering','Electronics and Telecommunication Engineering'),('Instrumentation and Control Engineering ','Electronics and Telecommunication Engineering'),('maths','maths'),('Mechanical Engineering','Mechanical Engineering'),('Metallurgical Engineering','Mechanical Engineering'),('phy','phy'),('Planning','Planning '),('Production Engineering (Sandwich)','Production Engineering and Industrial Management');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES ('Applied Science'),('Civil Engineering '),('Computer Engineering and Information Technology'),('Electrical Engineering '),('Electronics and Telecommunication Engineering '),('Instrumentation and Control Engineering '),('maths'),('Mechanical Engineering '),('Metallurgy and Material Science '),('phy'),('Planning '),('Production Engineering and Industrial Management');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external`
--

DROP TABLE IF EXISTS `external`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external` (
  `record_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`record_id`,`name`),
  CONSTRAINT `record_id_tab` FOREIGN KEY (`record_id`) REFERENCES `record` (`idrecord`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external`
--

LOCK TABLES `external` WRITE;
/*!40000 ALTER TABLE `external` DISABLE KEYS */;
/*!40000 ALTER TABLE `external` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `level` varchar(45) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES ('admin'),('approver'),('executive'),('normal');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `filename` varchar(1023) DEFAULT NULL,
  `issueno` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrecord`),
  KEY `approved_by_to_mis_idx` (`approved_by_mis`,`submitted_by_mis`),
  KEY `submitted_by_mis` (`submitted_by_mis`),
  CONSTRAINT `record_ibfk_1` FOREIGN KEY (`approved_by_mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `record_ibfk_2` FOREIGN KEY (`submitted_by_mis`) REFERENCES `users` (`mis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record`
--

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
INSERT INTO `record` VALUES (17,'1999-05-06','Test1','F','F','F','F','T','F','T','F','F','T','F','F',NULL,NULL,NULL,NULL,'345','200',NULL,'T',111503001,111603061,'Computer Engineering and Information Technology','8086-ADDITION-PROGRAMS.pdf','50'),(19,'1969-04-09','Test2','F','F','T','T','T','F','F','F','F','F','T','F',NULL,NULL,NULL,NULL,'345','2200',NULL,'T',111503001,111603061,'Computer Engineering and Information Technology','8086-PIN-EVEN-ODD-MEMORY-SEGMENT.pdf','234'),(20,'2018-05-06','Test3','T','F','T','F','F','F','F','F','F','F','F','F',NULL,NULL,'Test','Test','345','123',NULL,'F',111503001,111603061,'Computer Engineering and Information Technology','DC1.pdf','546'),(21,'2018-10-11','Test4','F','F','F','F','T','F','F','T','F','F','F','F','Test',NULL,NULL,NULL,'654','897',NULL,'T',111503001,111603061,'Computer Engineering and Information Technology','VED SADASHIV DANDEKAR DANDEKAR SADASHIV VITHAL.PDF','456'),(22,'2019-01-17','Test5','T','F','F','F','F','F','F','T','F','F','T','F',NULL,NULL,NULL,NULL,'734','99',NULL,'F',111503001,111603061,'Computer Engineering and Information Technology','Unit II Analog Modulation Techniques.pdf','75');
/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_id_max`
--

DROP TABLE IF EXISTS `record_id_max`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record_id_max` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record_id_max`
--

LOCK TABLES `record_id_max` WRITE;
/*!40000 ALTER TABLE `record_id_max` DISABLE KEYS */;
INSERT INTO `record_id_max` VALUES (23);
/*!40000 ALTER TABLE `record_id_max` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rejection_record`
--

DROP TABLE IF EXISTS `rejection_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rejection_record` (
  `idrecord` int(11) NOT NULL,
  `reason` varchar(256) NOT NULL,
  PRIMARY KEY (`idrecord`),
  CONSTRAINT `id_record_rejection_fk` FOREIGN KEY (`idrecord`) REFERENCES `record` (`idrecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rejection_record`
--

LOCK TABLES `rejection_record` WRITE;
/*!40000 ALTER TABLE `rejection_record` DISABLE KEYS */;
INSERT INTO `rejection_record` VALUES (20,'more bad paper'),(22,'Bad paper');
/*!40000 ALTER TABLE `rejection_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roles` varchar(45) NOT NULL,
  PRIMARY KEY (`roles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('dean'),('director'),('faculty'),('hod'),('student');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `mis` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `branch` varchar(45) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `mis_index` (`mis`),
  KEY `user_to_level_idx` (`role`),
  KEY `user_branch_idx` (`branch`),
  KEY `user_roles_idx` (`level`),
  KEY `department` (`department`),
  CONSTRAINT `user_branch` FOREIGN KEY (`branch`) REFERENCES `branches` (`branch`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_department` FOREIGN KEY (`department`) REFERENCES `departments` (`department`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`roles`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_to_level` FOREIGN KEY (`level`) REFERENCES `levels` (`level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('111503071',111503071,'WADHWA TARUN RAJULAL','wadhwatr15.comp@coep.ac.in','student','Computer Engineering',2019,'normal','Computer Engineering and Information Technology'),('111503075',111503075,'PATIL AKASH MARUTI','patilam15.comp@coep.ac.in','student','Computer Engineering',2019,'normal','Computer Engineering and Information Technology'),('111505048',111505048,'SAFNA HASSAN','hassans15.elec@coep.ac.in','student','Computer Engineering',2019,'normal','Computer Engineering and Information Technology'),('111603061',111603061,'Yash Shah','yashns16.comp@coep.ac.in','student','Computer Engineering',2020,'normal','Computer Engineering and Information Technology'),('approver',111503001,'ABHYANKAR AKSHAY SAMEER','abhyankaras15.comp@coep.ac.in','faculty','Computer Engineering',NULL,'approver','Computer Engineering and Information Technology');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-18 10:23:18
