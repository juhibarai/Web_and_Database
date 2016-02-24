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
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(10) NOT NULL,
  `trader_id` varchar(10) DEFAULT NULL,
  `transaction_status` varchar(45) NOT NULL,
  `oil_quantity` int(11) NOT NULL,
  `commission_type` varchar(45) DEFAULT NULL,
  `date_initiated` date NOT NULL,
  `date_approved` date DEFAULT NULL,
  `transaction_type` varchar(45) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `client_id_idx` (`client_id`),
  KEY `trader_id_idx` (`trader_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trader_id` FOREIGN KEY (`trader_id`) REFERENCES `trader` (`trader_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (130,'C2','T1','SHIPPED',50,'CASH','2014-12-01','2014-12-01','BUY'),(131,'C2','T2','SHIPPED',30,'CASH','2014-12-01','2014-12-01','BUY'),(132,'C2','T2','SHIPPED',30,'CASH','2014-12-01','2014-12-01','BUY'),(133,'C2','T2','SHIPPED',50,'CASH','2014-12-01','2014-12-01','BUY'),(134,'C1','T2','SHIPPED',30,'CASH','2014-12-01','2014-12-01','BUY'),(135,'C1',NULL,'SHIPPED',30,NULL,'2014-12-01','2014-12-01','SELL'),(136,'C1',NULL,'SHIPPED',30,NULL,'2014-12-01','2014-12-01','SELL');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
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
