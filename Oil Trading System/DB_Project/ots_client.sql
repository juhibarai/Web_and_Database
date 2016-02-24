CREATE DATABASE  IF NOT EXISTS `ots` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ots`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ots
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `cid` varchar(5) NOT NULL,
  `cfname` varchar(45) NOT NULL,
  `clname` varchar(45) DEFAULT NULL,
  `phone_no` int(11) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `quantity` decimal(45,5) NOT NULL,
  `amount_due` decimal(45,5) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES ('C1','apara','srini',12355124,2147483647,'abc@gmail.com','gold',0.00000,23987.60000,'PAYMENT PENDING'),('C10','alex','george',2142466823,2144982739,'alexgeorge21@gmail.com','gold',100.00000,5200.00000,'PAYMENT PENDING'),('C2','mathu','raja',32466823,4982739,'mat@gmail.com','gold',160.00000,34133.00000,'PAYMENT PENDING'),('C3','radhika','kast',23648253,2573578,'rad@gmail.com','gold',59.00000,5400.00000,'PAYMENT PENDING'),('C4','ranjani','suresh',12334878,7126367,'rs@gmail.com','gold',51.00000,5410.00000,'PAYMENT PENDING'),('C5','esha','gupta',2143456755,2147482299,'eshag@gmail.com','silver',10.00000,2000.00000,'PAYMENT PENDING'),('C6','sneha','shinde',2147483647,2144982739,'ss1990@gmail.com','gold',25.00000,5200.00000,'PAYMENT PENDING'),('C7','karan','gandhi',2147483647,2142772501,'kgrocks@yahoo.com','gold',70.00000,5400.00000,'PAYMENT PENDING'),('C8','deepak','singh',469543901,2147483647,'singhdeepak@gmail.com','silver',40.00000,5410.00000,'PAYMENT PENDING'),('C9','paul','davis',2147483647,2147483647,'paul67@gmail.com','silver',38.00000,2000.00000,'PAYMENT PENDING');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-01 22:07:15
