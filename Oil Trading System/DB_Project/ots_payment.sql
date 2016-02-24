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
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` varchar(45) DEFAULT NULL,
  `c_id` varchar(45) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `date_of_payment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id_idx` (`c_id`),
  KEY `t_id_idx` (`t_id`),
  CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `client` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `t_id` FOREIGN KEY (`t_id`) REFERENCES `trader` (`trader_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (3,'T2','C2',4200,'APPROVE','CASH','2014-11-27 20:56:26'),(4,'T2','C2',2000,'APPROVE','CASH','2014-11-30 00:42:49'),(5,'T2','C2',1000,'APPROVE','CASH','2014-11-30 01:50:26'),(6,'T2','C2',500,'CANCEL','CASH','2014-12-01 03:05:45'),(7,'T2','C2',500,'APPROVE','CASH','2014-12-01 18:09:34'),(8,'T2','C2',100,'APPROVE','CASH','2014-12-01 18:13:07'),(9,'T2','C2',100,'APPROVE','CASH','2014-12-01 18:37:15'),(10,'T2','C2',100,'APPROVE','CASH','2014-12-01 19:09:11'),(11,'T2','C2',150,'CANCEL','CASH','2014-12-01 19:09:24');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
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
