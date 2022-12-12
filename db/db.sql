-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: advertising_module
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `redirect_to` text COLLATE utf8_unicode_ci,
  `clicks` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (7,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/1654165183_7-celes-club-p-oboi-programmista-krasivie-7.jpg','2022-12-01','2022-12-24','https://google.com',0),(8,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/png-clipart-person-computer-icons-stick-figure-free-content-free-animated-s-website-stockxchng.png','2022-12-01','2022-12-08','https://google.com',0),(9,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/1654165171_3-celes-club-p-oboi-programmista-krasivie-3.jpg','2022-12-01','2022-12-30','https://google.com',2),(10,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/access-denied.jpg','2022-12-01','2022-12-30','https://google.com',2),(11,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/russia.jpg','2022-12-01','2022-12-31','https://google.com',2),(12,'C:\\Users\\zpier\\PhpstormProjects\\advertising-module-admin\\backend/uploads/1641846359_2-abrakadabra-fun-p-fon-rabochego-stola-programmista-2.jpg','2022-12-01','2022-12-31','https://google.com',2);
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `active` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (4,'https://google.com',1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_ads`
--

DROP TABLE IF EXISTS `customer_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_ads` (
  `customer_id` int NOT NULL,
  `ads_id` int NOT NULL,
  KEY `FK_customer_ads_customer_customer_id` (`customer_id`),
  KEY `FK_customer_ads_ads_ads_id` (`ads_id`),
  CONSTRAINT `FK_customer_ads_ads_ads_id` FOREIGN KEY (`ads_id`) REFERENCES `ads` (`id`),
  CONSTRAINT `FK_customer_ads_customer_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_ads`
--

LOCK TABLES `customer_ads` WRITE;
/*!40000 ALTER TABLE `customer_ads` DISABLE KEYS */;
INSERT INTO `customer_ads` VALUES (4,7),(4,8),(4,9),(4,10),(4,11),(4,12);
/*!40000 ALTER TABLE `customer_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1670789170),('m130524_201442_init',1670789175),('m190124_110200_add_verification_token_column_to_user_table',1670789175),('m221209_183959_create_table_customer',1670789175),('m221209_200747_create_table_ads',1670789175),('m221209_200921_create_table_customer_ads',1670789176);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','DQtUa5aNXSXunuJY1BluSi2wmflHGiDx','$2y$13$5bg5z9lSjxSDHZ1om8JTZus1MmucFJeaKYVuOaIkplUAmmnkI93PO',NULL,'admin@admin.ru',10,1670789348,1670789348,NULL),(2,'Test','Tt8t3mXxZ7jlFyf7DOOCQOqXuQecWpUX','$2y$13$hxx1vqcHx2TwdcodyayLTeXkh7UcRm5JAvmCQEdJY8py9SAioXJWG',NULL,'test@gmail.com',10,1670791455,1670791455,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-12 23:39:25
