-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: tweeter
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `text` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`),
  KEY `userId` (`userId`),
  CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (1,1,1,'2010-12-12 11:11:21','hłehłehłe'),(2,2,1,'2010-12-12 11:30:21','co się śmiejesz?'),(3,2,2,'2017-04-18 11:00:00','fajnie'),(4,1,2,'2017-04-18 11:30:00','wiem'),(5,2,5,'2017-05-02 14:20:57','ja też'),(6,2,13,'2017-05-04 13:53:11','To tyle.'),(10,13,13,'2017-05-04 18:46:41','lepiej nie ucz się łaciny!'),(11,13,13,'2017-05-04 19:46:58','nowy komentarz'),(12,13,13,'2017-05-04 20:08:44','Suspendisse ut tempor dui.'),(15,16,10,'2017-05-05 10:32:12','Masz rację.');
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messages`
--

DROP TABLE IF EXISTS `Messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `text` varchar(5000) COLLATE utf8_polish_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `readed` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messages`
--

LOCK TABLES `Messages` WRITE;
/*!40000 ALTER TABLE `Messages` DISABLE KEYS */;
INSERT INTO `Messages` VALUES (1,1,2,'cześć! co u Ciebie słychać?','2017-05-02 19:23:13',1),(2,1,2,'masz czas dzisiaj po południu?','2017-05-02 19:30:18',1),(3,2,1,'muszę jeszcze coś jutro pozałatwiać wiec nie mam zbyt dużo czasu','2017-05-02 23:36:44',0),(4,4,1,'hej, fajne posty :)','2017-05-03 22:57:04',0),(5,4,2,'hej, jak będziesz miał chwilę po zobacz http://wiadomosci.onet.pl/','2017-05-03 23:04:20',1),(6,2,4,'ok dzięki, zobaczę','2017-05-03 23:19:17',1),(7,2,1,'Dzień dobry!','2017-05-04 10:21:48',0),(8,2,1,'Co tam?','2017-05-04 10:23:57',0),(10,4,2,'Nullam laoreet elit a felis iaculis, vel lacinia est mollis.','2017-05-04 22:18:00',0);
/*!40000 ALTER TABLE `Messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tweet`
--

DROP TABLE IF EXISTS `Tweet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tweet`
--

LOCK TABLES `Tweet` WRITE;
/*!40000 ALTER TABLE `Tweet` DISABLE KEYS */;
INSERT INTO `Tweet` VALUES (1,1,'eloelo 3 2 0','2012-12-20 00:00:00'),(2,1,'Mam na imie Andrzej!','2017-04-17 00:00:00'),(4,1,'No mam cos ciekawego do powiedzenia','2017-04-17 00:00:00'),(5,1,'No mam cos ciekawego do powiedzenia, i powiem','2017-04-17 00:00:00'),(6,1,'dzisiaj bylem na silowni','2017-04-30 00:00:00'),(7,1,'mecz byl super','2017-04-30 00:00:00'),(8,1,'mecz byl super do przerwy','2017-04-30 11:04:39'),(9,2,'znowu pogoda się popsuła','2017-05-02 11:47:17'),(10,4,'sądzę, że wybory we Francji są ważne dla przyszłości UE','2017-05-02 18:02:56'),(11,2,'to jest mój pierwszy wpis','2017-05-04 13:41:29'),(12,2,'Witam!!!','2017-05-04 13:46:40'),(13,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu erat non eros faucibus congue. Suspendisse ut tempor dui. Nunc porta posuere.','2017-05-04 13:52:31');
/*!40000 ALTER TABLE `Tweet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `hash_pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'panan@placki.pl','Pan Andrzej','$2y$10$7yhrOm5R85BY2C6llXsZ7u0uR3gEoLeZ/R9Y1eVg78/k6Jp7L22UC'),(2,'wojtek@gmial.com','wojtek','$2y$10$rEd92mhxv.2c8WcAPSdp9epLnZMXSawFaAG1qGLBERRe7488Ex9ne'),(3,'ania@gmail.com','Ania','$2y$10$Two8hiJnAzKJ9XBP4P/b0uRE/aN/Qt30MVthc17zYn0j5RoPqhecC'),(4,'agnieszka@gmail.com','Mam na imię Agnieszka.','$2y$10$m75TQ89XFm/cT5.KmI3dzeZUxlIYSEue0tz9BSIGr6yFIgJnZpsDK'),(9,'twoflower@gmial.com','dwukwiat','$2y$10$QqfjBSlESyaSK8dGefNVtuXq.IygGjV09N85dqZWiD4a5f.Xfk5Aa'),(10,'rincewind@interia.pl','rincewind','$2y$10$yTRTAIACiK7s.IAmr3JFEu7IJElNg/ZxmVQW1ZKUzvIMbZ1z8uMwq'),(11,'adam@gmail.com','adam','$2y$10$ecX/zQwd4vLXq3QCEwOQBu5NjUzkmWwsy/N7YirtFr2Zfyhzyrspa'),(13,'rupicabra@wp.pl','rupicabra','$2y$10$j6NbD9y.8GOWyrcJgDnUg.3D4YZ6Iy49KXrmAMJvBQyzvFXu7Rlsu'),(14,'roman@interia.pl','Roman','$2y$10$kra9XRin2q4TqxF3cATbJ.JNa9Bk9Sv6Vpubn7tc.42msKTbZywFi'),(16,'nowyJa@gmail.com','nowyJa','$2y$10$GDHWcPcTWOJxPn/5EEuqWeaWFByqUBO4cueHiZdVOpWa3joXZ127C');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-05 10:56:25
