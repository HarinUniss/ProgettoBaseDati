-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_progetto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

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
-- Table structure for table `animali`
--

DROP TABLE IF EXISTS `animali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animali` (
  `id_animale` int(11) NOT NULL,
  `nome` char(20) NOT NULL,
  `razza` char(25) DEFAULT NULL,
  `specie` char(50) DEFAULT NULL,
  `età` int(11) NOT NULL CHECK (`età` >= 0),
  `sesso` char(1) NOT NULL CHECK (`sesso` = 'F' or `sesso` = 'M'),
  `provenienza` char(50) DEFAULT NULL,
  `pedigree` tinyint(1) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `proprietario` int(11) NOT NULL,
  PRIMARY KEY (`id_animale`),
  UNIQUE KEY `id_animale` (`id_animale`),
  KEY `proprietario` (`proprietario`),
  CONSTRAINT `animali_ibfk_1` FOREIGN KEY (`proprietario`) REFERENCES `utenti` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animali`
--

LOCK TABLES `animali` WRITE;
/*!40000 ALTER TABLE `animali` DISABLE KEYS */;
INSERT INTO `animali` (`id_animale`, `nome`, `razza`, `specie`, `età`, `sesso`, `provenienza`, `pedigree`, `foto`, `proprietario`) VALUES (0,'Sergione','Husky','Cane',2,'M','Sassari',0,NULL,0);
/*!40000 ALTER TABLE `animali` ENABLE KEYS */;
UNLOCK TABLES;
