-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: sekoliko2.0
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190124205803',NULL),('20190128053150',NULL),('20190128102308',NULL),('20190214103107',NULL),('20190215100015',NULL),('20190215101315',NULL),('20190215102505',NULL),('20190215133951',NULL),('20190215134050',NULL),('20190216125744',NULL),('20190216191316',NULL),('20190216201504',NULL),('20190216220041',NULL),('20190225081452',NULL),('20190225084907',NULL),('20190225093858',NULL),('20190225122151',NULL),('20190225122345',NULL),('20190225140546',NULL),('20190225191533',NULL),('20190326223059',NULL),('20190326224726',NULL),('20190326225217',NULL),('20190327111917',NULL),('20190327143100',NULL),('20190327153313',NULL),('20190327154526',NULL),('20190327185220',NULL),('20190327191540',NULL),('20190327195948',NULL),('20190327204237',NULL),('20190328103239',NULL),('20190328145337',NULL),('20190328210856',NULL),('20190328230553',NULL),('20190329073616',NULL),('20190329073804',NULL),('20190329082422',NULL),('20190329115851',NULL),('20190330112025',NULL),('20190330112252',NULL),('20190330113211',NULL),('20190330132055',NULL),('20190330132349',NULL),('20190330145355',NULL),('20190331000557',NULL),('20190401145232',NULL),('20190401151451',NULL),('20190402182126',NULL),('20190402183215',NULL),('20190402183521',NULL),('20190402212743',NULL),('20190403202354',NULL),('20190404212335',NULL),('20190405214035',NULL),('20190406051459',NULL),('20190406051732',NULL),('20190409082846',NULL),('20190409083028',NULL),('20190410072644',NULL),('20190410073319',NULL),('20190410195830',NULL),('20190410211230',NULL),('20190411095753',NULL),('20190411191408','2019-04-11 19:14:25'),('20190412120142','2019-04-12 12:01:52'),('20190412155446','2019-04-12 15:54:57'),('20190412165051','2019-04-12 16:51:04'),('20190413200548','2019-04-13 20:07:14'),('20190413200735','2019-04-13 20:07:59'),('20190413203521','2019-04-13 20:35:30'),('20190414065444','2019-04-14 06:55:16'),('20190414065754','2019-04-14 06:58:05'),('20190414071112','2019-04-14 07:11:19'),('20190414073433','2019-04-14 07:35:41'),('20190429183747','2019-04-29 18:38:19'),('20190429183827','2019-04-29 18:38:34'),('20190429185721','2019-04-29 18:58:02'),('20190430112901','2019-04-30 11:29:10'),('20190430125151','2019-04-30 12:52:04'),('20190430130630','2019-04-30 13:06:37'),('20190501071842','2019-05-01 07:19:07'),('20190501072611','2019-05-01 07:33:37'),('20190501073342','2019-05-01 07:33:50'),('20190501120813','2019-05-01 12:08:25'),('20190501171648','2019-05-01 17:16:58'),('20190501173515','2019-05-01 17:35:21'),('20190501211241','2019-05-01 21:13:14'),('20190502081134','2019-05-02 08:11:52'),('20190502202419','2019-05-02 20:24:34'),('20190503072142','2019-05-03 07:21:47'),('20190503072929','2019-05-03 07:29:39'),('20190506081231','2019-05-06 08:12:56'),('20190514211656','2019-05-14 21:17:13'),('20190514213809','2019-05-14 21:38:17'),('20190514220312','2019-05-14 22:03:20'),('20190516183507','2019-05-16 18:35:17');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_abs`
--

DROP TABLE IF EXISTS `sk_abs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_abs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `abs_motif` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `abs_date_deb` datetime DEFAULT NULL,
  `abs_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_962A0FD08D93D649` (`user`),
  CONSTRAINT `FK_962A0FD08D93D649` FOREIGN KEY (`user`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_abs`
--

LOCK TABLES `sk_abs` WRITE;
/*!40000 ALTER TABLE `sk_abs` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_abs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_bibliotheque`
--

DROP TABLE IF EXISTS `sk_bibliotheque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_bibliotheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10A8F090A76ED395` (`user_id`),
  CONSTRAINT `FK_10A8F090A76ED395` FOREIGN KEY (`user_id`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_bibliotheque`
--

LOCK TABLES `sk_bibliotheque` WRITE;
/*!40000 ALTER TABLE `sk_bibliotheque` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_bibliotheque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_bibliotheque_sk_book`
--

DROP TABLE IF EXISTS `sk_bibliotheque_sk_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_bibliotheque_sk_book` (
  `sk_bibliotheque_id` int(11) NOT NULL,
  `sk_book_id` int(11) NOT NULL,
  PRIMARY KEY (`sk_bibliotheque_id`,`sk_book_id`),
  KEY `IDX_D824A53257E3B7B7` (`sk_bibliotheque_id`),
  KEY `IDX_D824A532270AC401` (`sk_book_id`),
  CONSTRAINT `FK_D824A532270AC401` FOREIGN KEY (`sk_book_id`) REFERENCES `sk_book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D824A53257E3B7B7` FOREIGN KEY (`sk_bibliotheque_id`) REFERENCES `sk_bibliotheque` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_bibliotheque_sk_book`
--

LOCK TABLES `sk_bibliotheque_sk_book` WRITE;
/*!40000 ALTER TABLE `sk_bibliotheque_sk_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_bibliotheque_sk_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_book`
--

DROP TABLE IF EXISTS `sk_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_reserved` tinyint(1) DEFAULT '0',
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edition` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723DCE66A76ED395` (`user_id`),
  CONSTRAINT `FK_723DCE66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `sk_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_book`
--

LOCK TABLES `sk_book` WRITE;
/*!40000 ALTER TABLE `sk_book` DISABLE KEYS */;
INSERT INTO `sk_book` VALUES (2,'Boobaoooaaaaaaaaaa',0,'Techzara',NULL,NULL,NULL,NULL,NULL,1,'2019-03-29 11:52:00','2019-03-29 11:52:00',NULL,NULL,NULL,NULL,NULL),(4,'Boobo',0,'Techzara',NULL,NULL,NULL,NULL,NULL,1,'2019-03-29 12:04:00','2019-03-29 12:04:00',NULL,NULL,NULL,NULL,NULL),(5,'Booba',0,'Techzara',NULL,NULL,NULL,NULL,NULL,47,'2019-03-29 17:03:00','2019-03-29 17:03:00',NULL,NULL,NULL,NULL,NULL),(6,'Tes',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL,NULL,NULL),(7,'Tastaee',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL,NULL,NULL),(8,'Bonhome',0,'Techzara',NULL,NULL,NULL,NULL,NULL,153,'2019-04-30 14:40:00','2019-05-01 14:40:00','2018-10-30 16:17:55','2019-10-01 16:17:55',NULL,NULL,NULL),(10,'Booba',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL,'Akoustou','Gonogo'),(11,'Boobaa',0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,'2019-05-02 15:23:00','2019-05-03 15:23:00','2018-10-30 16:17:55','2019-10-01 16:17:55','20182019','Akoustou','Gonogo'),(12,'Boobaazz',0,'Techzara',NULL,NULL,NULL,NULL,NULL,48,'2019-05-14 23:21:00','2019-05-15 23:21:00','2018-10-30 16:17:55','2019-10-01 16:17:55','20182019','Akoustoua','aaaaaa');
/*!40000 ALTER TABLE `sk_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_bug`
--

DROP TABLE IF EXISTS `sk_bug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_bug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `titre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_ajout` datetime NOT NULL,
  `color` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_8B35E1628D93D649` (`user`),
  CONSTRAINT `FK_8B35E1628D93D649` FOREIGN KEY (`user`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_bug`
--

LOCK TABLES `sk_bug` WRITE;
/*!40000 ALTER TABLE `sk_bug` DISABLE KEYS */;
INSERT INTO `sk_bug` VALUES (1,50,'aa','aa','Important','2019-04-06 08:45:59','green',NULL),(2,50,'Image','Grave be le izy e','Important','2019-05-01 19:38:46','green',NULL),(3,50,'Coca','Cocacola','Important','2019-05-01 19:43:10','green',NULL),(4,50,'Imagezzzzzzzzzz','aaazzzza','Important','2019-05-01 21:17:03','green',NULL),(5,50,'az','zzzzzzzzzzz','Important','2019-05-01 21:17:16','green',NULL),(6,50,'aaaaaa','aaaaazzzzzzzzzz','Important','2019-05-01 21:19:10','green',NULL),(7,50,'soko','koso','Important','2019-05-01 22:44:12','green',NULL),(8,50,'zzz','azaa','Important','2019-05-01 22:44:22','green',NULL),(9,50,'Image','zzzzzzz','Important','2019-05-01 22:45:17','green',NULL),(10,50,'sssssssaaaaa','zzzaaaaaaaaaaaaasa','Important','2019-05-01 22:55:14','green',NULL);
/*!40000 ALTER TABLE `sk_bug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_bug_comment`
--

DROP TABLE IF EXISTS `sk_bug_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_bug_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45A4AEE9F8697D13` (`comment_id`),
  KEY `IDX_45A4AEE9A76ED395` (`user_id`),
  CONSTRAINT `FK_45A4AEE9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `sk_user` (`id`),
  CONSTRAINT `FK_45A4AEE9F8697D13` FOREIGN KEY (`comment_id`) REFERENCES `sk_bug` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_bug_comment`
--

LOCK TABLES `sk_bug_comment` WRITE;
/*!40000 ALTER TABLE `sk_bug_comment` DISABLE KEYS */;
INSERT INTO `sk_bug_comment` VALUES (1,5,50,'zzzzzzzzzz','2019-05-01 21:56:22'),(2,5,50,'zdadada','2019-05-01 21:57:07'),(3,2,50,'ssssssssss','2019-05-01 22:06:22'),(4,1,50,'kakakaka','2019-05-01 22:06:38'),(5,1,50,'bobol','2019-05-01 22:07:01'),(6,1,50,'concor','2019-05-01 22:07:45'),(7,4,50,'Kozatina','2019-05-01 22:12:32'),(8,8,50,'jkolka','2019-05-01 22:44:30'),(9,9,50,'caca','2019-05-01 22:45:28'),(10,9,50,'bababzzzzzzzz','2019-05-01 22:49:16'),(11,9,50,'zzzzzz','2019-05-01 22:50:30'),(12,10,50,'zzzzzzzany a','2019-05-01 22:55:22'),(13,8,50,'Ok','2019-05-14 10:29:22'),(14,10,50,'caaaaaaa','2019-05-14 10:29:57');
/*!40000 ALTER TABLE `sk_bug_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_classe`
--

DROP TABLE IF EXISTS `sk_classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` int(11) DEFAULT NULL,
  `classe_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497ED0384BDFF36B` (`niveau`),
  CONSTRAINT `FK_497ED0384BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_niveau` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_classe`
--

LOCK TABLES `sk_classe` WRITE;
/*!40000 ALTER TABLE `sk_classe` DISABLE KEYS */;
INSERT INTO `sk_classe` VALUES (1,NULL,'zaza',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,6,'Seconde A','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,5,'TA3','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,7,'Seconde AA','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL),(14,5,'CONOCO','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(15,5,'Gogole','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(17,10,'Okal','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_classe_matiere`
--

DROP TABLE IF EXISTS `sk_classe_matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_classe_matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_coeff` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8mb4_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `matProf` int(11) DEFAULT NULL,
  `matClasse` int(11) DEFAULT NULL,
  `matiere_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D7CAB33623B6832` (`matProf`),
  KEY `IDX_7D7CAB3376AA3D43` (`matClasse`),
  KEY `IDX_7D7CAB33F46CD258` (`matiere_id`),
  CONSTRAINT `FK_7D7CAB33623B6832` FOREIGN KEY (`matProf`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7D7CAB3376AA3D43` FOREIGN KEY (`matClasse`) REFERENCES `sk_classe` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7D7CAB33F46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `sk_matiere` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_classe_matiere`
--

LOCK TABLES `sk_classe_matiere` WRITE;
/*!40000 ALTER TABLE `sk_classe_matiere` DISABLE KEYS */;
INSERT INTO `sk_classe_matiere` VALUES (1,'10','Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55',48,15,58),(2,'12','Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55',164,17,58),(4,'4','Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55',162,17,57),(5,'10','Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55',48,17,59);
/*!40000 ALTER TABLE `sk_classe_matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_classe_sk_matiere`
--

DROP TABLE IF EXISTS `sk_classe_sk_matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_classe_sk_matiere` (
  `sk_classe_id` int(11) NOT NULL,
  `sk_matiere_id` int(11) NOT NULL,
  PRIMARY KEY (`sk_classe_id`,`sk_matiere_id`),
  KEY `IDX_1FC34237ABCE875` (`sk_classe_id`),
  KEY `IDX_1FC3423AD2A0D02` (`sk_matiere_id`),
  CONSTRAINT `FK_1FC34237ABCE875` FOREIGN KEY (`sk_classe_id`) REFERENCES `sk_classe` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1FC3423AD2A0D02` FOREIGN KEY (`sk_matiere_id`) REFERENCES `sk_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_classe_sk_matiere`
--

LOCK TABLES `sk_classe_sk_matiere` WRITE;
/*!40000 ALTER TABLE `sk_classe_sk_matiere` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_classe_sk_matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_conge`
--

DROP TABLE IF EXISTS `sk_conge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_conge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_deb` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `motif` longtext COLLATE utf8mb4_unicode_ci,
  `type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_fin` tinyint(1) NOT NULL DEFAULT '0',
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8mb4_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DB6E8F72A76ED395` (`user_id`),
  CONSTRAINT `FK_DB6E8F72A76ED395` FOREIGN KEY (`user_id`) REFERENCES `sk_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_conge`
--

LOCK TABLES `sk_conge` WRITE;
/*!40000 ALTER TABLE `sk_conge` DISABLE KEYS */;
INSERT INTO `sk_conge` VALUES (1,53,'2019-05-02 11:03:00','2019-05-02 00:03:00','Andeha hanambady','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(2,55,'2019-05-02 11:06:00','2019-05-03 11:06:00','coco','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(3,56,'2019-05-02 11:09:00','2019-05-03 11:09:00','Coconat','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(4,143,'2019-05-02 11:09:00','2019-05-03 11:09:00','Coconat','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(5,144,'2019-05-02 11:15:00','2019-05-02 11:16:00','Andeha hanambady','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(6,50,'2019-05-14 10:06:00','2019-05-14 10:06:00','Da','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(9,50,'2019-05-14 10:21:00','2019-05-14 10:21:00','Da','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(10,48,'2019-05-14 10:33:00','2019-05-14 10:34:00','Coco','1',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55'),(11,50,'2019-05-17 12:42:00','2019-05-17 12:42:00','Hanambady','0',1,'Techzara',NULL,NULL,NULL,NULL,NULL,'20182019','2018-10-30 16:17:55','2019-10-01 16:17:55');
/*!40000 ALTER TABLE `sk_conge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_discipline`
--

DROP TABLE IF EXISTS `sk_discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_discipline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_discipline`
--

LOCK TABLES `sk_discipline` WRITE;
/*!40000 ALTER TABLE `sk_discipline` DISABLE KEYS */;
INSERT INTO `sk_discipline` VALUES (2,'Ada','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Fahatarana','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(4,'Kokoa','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_discipline_list`
--

DROP TABLE IF EXISTS `sk_discipline_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_discipline_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipline_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_824EA63CA5522701` (`discipline_id`),
  CONSTRAINT `FK_824EA63CA5522701` FOREIGN KEY (`discipline_id`) REFERENCES `sk_discipline` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_discipline_list`
--

LOCK TABLES `sk_discipline_list` WRITE;
/*!40000 ALTER TABLE `sk_discipline_list` DISABLE KEYS */;
INSERT INTO `sk_discipline_list` VALUES (4,2,'Mamafa gabone','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,3,'Mamafa gabone','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(6,4,'koinkoin','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(7,4,'olaaaaaaaa','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(8,4,'bbbbbbbb','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_discipline_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_edt`
--

DROP TABLE IF EXISTS `sk_edt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_edt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etd_date_deb` datetime DEFAULT NULL,
  `etd_date_fin` datetime DEFAULT NULL,
  `matNom` int(11) DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edtClasse` int(11) DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_591D9529EEC51E56` (`matNom`),
  KEY `IDX_591D95298592913F` (`edtClasse`),
  CONSTRAINT `FK_591D95298592913F` FOREIGN KEY (`edtClasse`) REFERENCES `sk_classe` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_591D9529EEC51E56` FOREIGN KEY (`matNom`) REFERENCES `sk_classe_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_edt`
--

LOCK TABLES `sk_edt` WRITE;
/*!40000 ALTER TABLE `sk_edt` DISABLE KEYS */;
INSERT INTO `sk_edt` VALUES (1,'2019-05-15 00:05:00','2019-05-15 00:05:00',4,'Techzara',NULL,NULL,NULL,NULL,NULL,17,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(2,'2019-05-15 00:25:00','2019-05-15 00:25:00',2,'Techzara',NULL,NULL,NULL,NULL,NULL,17,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_edt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_email_newsletter`
--

DROP TABLE IF EXISTS `sk_email_newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_email_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nws_email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nws_subscribed` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A994A6D0D5D52DEC` (`nws_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_email_newsletter`
--

LOCK TABLES `sk_email_newsletter` WRITE;
/*!40000 ALTER TABLE `sk_email_newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_email_newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_etudiant`
--

DROP TABLE IF EXISTS `sk_etudiant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` int(11) DEFAULT NULL,
  `etudiant` int(11) DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `is_renvoie` tinyint(1) DEFAULT '0',
  `date_renvoie` datetime DEFAULT NULL,
  `motif_renvoie` longtext COLLATE utf8_unicode_ci,
  `date_de_naissance` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mere` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pere` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_parent` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexe` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9CF709B4717E22E3` (`etudiant`),
  KEY `IDX_9CF709B44BDFF36B` (`niveau`),
  CONSTRAINT `FK_9CF709B44BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_classe` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9CF709B4717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_etudiant`
--

LOCK TABLES `sk_etudiant` WRITE;
/*!40000 ALTER TABLE `sk_etudiant` DISABLE KEYS */;
INSERT INTO `sk_etudiant` VALUES (1,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(29,11,46,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(30,11,47,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(31,11,49,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2019-04-10 10:27:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(48,12,133,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(52,12,139,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(53,12,140,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(54,11,147,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,'2019-04-12 22:14:08','azzaza',NULL,'kotikota','kotikota','0329473033','Male','Passant','20182019'),(55,11,150,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019'),(56,11,153,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,NULL,NULL,'12/04/2019','kotikota','kotikota','0329473033','Male','Passant','20182019'),(57,13,154,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,NULL,NULL,'12/04/2019','kotikota','kotikota','0329473033','Male','Passant','20182019'),(61,12,155,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,NULL,NULL,'12/04/2019','kotikota','kotikota','0329473033','Male','Passant','20182019'),(62,15,156,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',0,NULL,NULL,'06/05/2019','Etudiant 1','Etudiant 1','0324578954','Male','Passant','20182019');
/*!40000 ALTER TABLE `sk_etudiant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_guide`
--

DROP TABLE IF EXISTS `sk_guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desciption` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` longtext COLLATE utf8_unicode_ci,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_guide`
--

LOCK TABLES `sk_guide` WRITE;
/*!40000 ALTER TABLE `sk_guide` DISABLE KEYS */;
INSERT INTO `sk_guide` VALUES (2,'descripti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'azzzzzzzzzz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'aaaaaaaaaa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sk_guide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_info_comment`
--

DROP TABLE IF EXISTS `sk_info_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_info_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4089582FF8697D13` (`comment_id`),
  KEY `IDX_4089582FA76ED395` (`user_id`),
  CONSTRAINT `FK_4089582FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `sk_user` (`id`),
  CONSTRAINT `FK_4089582FF8697D13` FOREIGN KEY (`comment_id`) REFERENCES `sk_information` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_info_comment`
--

LOCK TABLES `sk_info_comment` WRITE;
/*!40000 ALTER TABLE `sk_info_comment` DISABLE KEYS */;
INSERT INTO `sk_info_comment` VALUES (1,6,50,'Con','2019-05-02 00:25:40'),(2,6,50,'Cochon','2019-05-02 00:25:52'),(3,6,50,'Cool','2019-05-02 00:28:03'),(4,13,50,'Rose a','2019-05-02 00:28:23'),(5,14,50,'pour toutes les étudiants','2019-05-02 13:48:00'),(6,14,50,'hhhhh','2019-05-06 09:39:23'),(7,14,NULL,'Ok pour toutes','2019-05-06 10:02:12'),(8,14,50,'ok','2019-05-06 10:02:49'),(9,14,50,'yay','2019-05-14 10:30:27');
/*!40000 ALTER TABLE `sk_info_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_information`
--

DROP TABLE IF EXISTS `sk_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_ajout` datetime NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_information`
--

LOCK TABLES `sk_information` WRITE;
/*!40000 ALTER TABLE `sk_information` DISABLE KEYS */;
INSERT INTO `sk_information` VALUES (6,'Information','2019-05-01 23:52:23','Techzara',NULL,NULL,NULL,NULL,NULL,'Info','2018-10-30 16:17:55','2019-10-01 16:17:55',NULL),(13,'aaaaaaaaz','2019-05-02 00:28:10','Techzara',NULL,NULL,NULL,NULL,NULL,'Anaaazzzza','2018-10-30 16:17:55','2019-10-01 16:17:55',NULL),(14,'zzzzzzz','2019-05-02 13:47:40','Techzara',NULL,NULL,NULL,NULL,NULL,'zazazaza','2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_matiere`
--

DROP TABLE IF EXISTS `sk_matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `mat_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_matiere`
--

LOCK TABLES `sk_matiere` WRITE;
/*!40000 ALTER TABLE `sk_matiere` DISABLE KEYS */;
INSERT INTO `sk_matiere` VALUES (54,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','Maths',NULL),(57,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','Anglais','20182019'),(58,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','Mathématique','20182019'),(59,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','Malagasy','20182019');
/*!40000 ALTER TABLE `sk_matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_message_newsletter`
--

DROP TABLE IF EXISTS `sk_message_newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_message_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_message_newsletter`
--

LOCK TABLES `sk_message_newsletter` WRITE;
/*!40000 ALTER TABLE `sk_message_newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_message_newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_message_newsletter_translation`
--

DROP TABLE IF EXISTS `sk_message_newsletter_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_message_newsletter_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translatable_id` int(11) DEFAULT NULL,
  `message_newsletter_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_newsletter_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sk_message_newsletter_translation_unique_translation` (`translatable_id`,`locale`),
  KEY `IDX_B29ADF0D2C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_B29ADF0D2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `sk_message_newsletter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_message_newsletter_translation`
--

LOCK TABLES `sk_message_newsletter_translation` WRITE;
/*!40000 ALTER TABLE `sk_message_newsletter_translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_message_newsletter_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_niveau`
--

DROP TABLE IF EXISTS `sk_niveau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveau_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_niveau`
--

LOCK TABLES `sk_niveau` WRITE;
/*!40000 ALTER TABLE `sk_niveau` DISABLE KEYS */;
INSERT INTO `sk_niveau` VALUES (4,'sssssss',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'Terminale','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'Seconda','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'Maternelle','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'Oka','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(9,'Ok','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(10,'Bon','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_niveau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_note`
--

DROP TABLE IF EXISTS `sk_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_val` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matNom` int(11) DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etudiant` int(11) DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `trimestre` int(11) DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_76659743EEC51E56` (`matNom`),
  KEY `IDX_76659743717E22E3` (`etudiant`),
  KEY `IDX_766597435406BC48` (`trimestre`),
  CONSTRAINT `FK_766597435406BC48` FOREIGN KEY (`trimestre`) REFERENCES `sk_trimestre` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_76659743717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `sk_etudiant` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_76659743EEC51E56` FOREIGN KEY (`matNom`) REFERENCES `sk_classe_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_note`
--

LOCK TABLES `sk_note` WRITE;
/*!40000 ALTER TABLE `sk_note` DISABLE KEYS */;
INSERT INTO `sk_note` VALUES (1,'11',1,'Techzara',NULL,NULL,NULL,NULL,NULL,62,NULL,NULL,2,'20182019');
/*!40000 ALTER TABLE `sk_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_paiement`
--

DROP TABLE IF EXISTS `sk_paiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `montant` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` longtext COLLATE utf8_unicode_ci,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5C5551498D93D649` (`user`),
  CONSTRAINT `FK_5C5551498D93D649` FOREIGN KEY (`user`) REFERENCES `sk_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_paiement`
--

LOCK TABLES `sk_paiement` WRITE;
/*!40000 ALTER TABLE `sk_paiement` DISABLE KEYS */;
INSERT INTO `sk_paiement` VALUES (16,'Ecolage','2019-05-16 22:52:00','10000','','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',156),(17,'Ecolage','2019-05-16 22:53:00','1000','March','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',156);
/*!40000 ALTER TABLE `sk_paiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_profs`
--

DROP TABLE IF EXISTS `sk_profs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_profs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profs` int(11) DEFAULT NULL,
  `matiere` int(11) DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B250034547E61F7F` (`profs`),
  KEY `IDX_B25003459014574A` (`matiere`),
  CONSTRAINT `FK_B250034547E61F7F` FOREIGN KEY (`profs`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B25003459014574A` FOREIGN KEY (`matiere`) REFERENCES `sk_matiere` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_profs`
--

LOCK TABLES `sk_profs` WRITE;
/*!40000 ALTER TABLE `sk_profs` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_profs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_retard`
--

DROP TABLE IF EXISTS `sk_retard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_retard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `abs_motif` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `heure_deb` datetime DEFAULT NULL,
  `heure_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A9DB2138D93D649` (`user`),
  CONSTRAINT `FK_9A9DB2138D93D649` FOREIGN KEY (`user`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_retard`
--

LOCK TABLES `sk_retard` WRITE;
/*!40000 ALTER TABLE `sk_retard` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_retard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_role`
--

DROP TABLE IF EXISTS `sk_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rl_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_role`
--

LOCK TABLES `sk_role` WRITE;
/*!40000 ALTER TABLE `sk_role` DISABLE KEYS */;
INSERT INTO `sk_role` VALUES (1,'Superadmin'),(2,'Etudiant'),(3,'Admin'),(4,'Profs'),(5,'Personel'),(6,'Secretaire'),(7,'Bibliotheque');
/*!40000 ALTER TABLE `sk_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_salle`
--

DROP TABLE IF EXISTS `sk_salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salle_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salle_numero` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_reserve` tinyint(1) NOT NULL DEFAULT '0',
  `deb_reserve` datetime DEFAULT NULL,
  `fin_reserve` datetime DEFAULT NULL,
  `motifs` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `nombre_place` int(11) DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_salle`
--

LOCK TABLES `sk_salle` WRITE;
/*!40000 ALTER TABLE `sk_salle` DISABLE KEYS */;
INSERT INTO `sk_salle` VALUES (4,'chen','1',1,'2019-05-01 12:29:00','2019-05-02 12:27:00','Réunion','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',100,NULL),(5,'chen','12',0,NULL,NULL,NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',100,NULL),(6,'chen','12',0,'2019-04-13 00:15:00','2019-04-14 00:15:00',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',100,NULL),(7,'COMa','1000',0,'2019-05-15 22:47:00','2019-05-16 22:47:00',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',100,'20182019'),(8,'Blue','10',0,'2019-05-14 22:42:00','2019-05-15 22:42:00',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',100,'20182019');
/*!40000 ALTER TABLE `sk_salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_theme`
--

DROP TABLE IF EXISTS `sk_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sidebar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_theme`
--

LOCK TABLES `sk_theme` WRITE;
/*!40000 ALTER TABLE `sk_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `sk_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_trimestre`
--

DROP TABLE IF EXISTS `sk_trimestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_trimestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trim_debut` datetime NOT NULL,
  `trim_fin` datetime NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_trimestre`
--

LOCK TABLES `sk_trimestre` WRITE;
/*!40000 ALTER TABLE `sk_trimestre` DISABLE KEYS */;
INSERT INTO `sk_trimestre` VALUES (2,'Premier trimestre','2019-04-09 13:26:00','2019-06-13 13:26:00','Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Deuxieme trimestre','2019-05-02 08:58:00','2019-05-02 08:58:00','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL),(4,'Prim','2019-05-14 15:47:00','2019-05-14 15:47:00','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019'),(5,'Bonbon','2019-05-14 15:39:00','2019-05-14 15:39:00','Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019');
/*!40000 ALTER TABLE `sk_trimestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_user`
--

DROP TABLE IF EXISTS `sk_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sk_role_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `usr_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_date_create` datetime DEFAULT NULL,
  `usr_date_update` datetime DEFAULT NULL,
  `usr_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_is_valid` tinyint(1) NOT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anne_scolaire_debut` datetime DEFAULT NULL,
  `anne_scolaire_fin` datetime DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_conge` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_canonical_UNIQUE` (`username_canonical`),
  UNIQUE KEY `confirmation_token_UNIQUE` (`confirmation_token`),
  KEY `IDX_344BBB1EE7AB552C` (`sk_role_id`),
  CONSTRAINT `FK_344BBB1EE7AB552C` FOREIGN KEY (`sk_role_id`) REFERENCES `sk_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1,'julien','julien','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$z//7IEYKyI/ENc4idtejguCKumh/MewQl5HyfhrUofzY6u8OrFKaG','2019-04-29 09:48:04',NULL,NULL,'a:1:{i:0;s:15:\"ROLE_SUPERADMIN\";}','teste','teste','teste','2019-01-24 22:59:34','2019-03-29 22:05:37','0329473033',NULL,0,'Techzara',NULL,'',NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(46,2,'za','za','zaza@zaza.com','zaza@zaza.com',1,NULL,'$2y$13$IZnW5uh/YGjM3z7LfcqeTuZD7zPuPk2Hnf6XGknt4xitkULYqMVKO','2019-05-06 21:32:14',NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','za','za','za','2019-03-28 23:16:35','2019-03-29 21:29:35','0329473033','/upload/user/f7d22b8a0da3e56fafe998ce39fdd7e2.png',0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(47,2,'az','az','az@az.com','az@az.com',1,NULL,'$2y$13$X2nvspFG.1fh8J0PRRljV.Q7eubFNtGUjf5m4KLFNIoTYnJazLh7W',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','az','az','az','2019-03-28 23:17:10',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(48,4,'prof','prof','prof@prof.gma','prof@prof.gma',1,NULL,'$2y$13$XrFzQnXUvtThXrKGH0Kp.umO92sb8yiLOqV70EJrmM2km/Us6IFEy','2019-05-06 21:16:08',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','prof','prof','prof','2019-03-28 23:29:20',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',0),(49,2,'bon','bon','bon@bon.com','bon@bon.com',0,NULL,'$2y$13$UEi37RJs4Z2A6yG9EnfQHeP/UhAE/zFTevXvI1PMap3Jo0M4P.a7q','2019-04-10 08:30:37',NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','bon','bon','bon','2019-03-29 00:25:08',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(50,3,'admin','admin','admin@gmail.com','admin@gmail.com',1,NULL,'$2y$13$cA7z3REXP9pnb7oRUQ0JDOj6hNQTVwHsnt4xPy1E1Qtxpq5zWwzNW','2019-05-16 11:54:49',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','admin','admin','admin','2019-03-29 16:17:55',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',0),(53,3,'koko','koko','aaaaaa@aaaaaaa.com','aaaaaa@aaaaaaa.com',1,NULL,'$2y$13$MqEEH1hulAQnPh02cwPYHeE409p8bekJTsOsTE5Vu96sv6kAee8hi',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','aaaaaaaaa','aaaaaa','aaaaaa@aaaaaaa.com','2019-03-29 21:58:55',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',0),(54,3,'aaaaaaaa','aaaaaaaa','a@c.com','a@c.com',1,NULL,'$2y$13$9qIIeaxrYTz829H1nLcOTuhiHYOrDR1GVemqq86c9j7UMXCct5rza',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','bob','aaa','bo','2019-03-29 22:09:39',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(55,3,'aaaaaaaaaaaa','aaaaaaaaaaaa','julienrajerison5@gmail.comaaaaaaaa','julienrajerison5@gmail.comaaaaaaaa',1,NULL,'$2y$13$02gCvQO//44f5aJ8bEnLJOIkxlPXqnZ.noArKLf38MglPyEHqSktC',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','pol','pol','pol','2019-03-29 22:10:17',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',0),(56,3,'bonaaaaaaaaaaaa','bonaaaaaaaaaaaa','bon@bon.comaaaa','bon@bon.comaaaa',1,NULL,'$2y$13$lvbMSqIpDhk5v4UcSUDkmujcyMWW3FyyyCjC4ApiiUR/xTJNpuPjW',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','bon','bon','bon','2019-03-29 22:12:59',NULL,NULL,NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',0),(128,3,'ada','ada','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$rlDPF3s764Sa3nsUrpl/Lu5SxwF0M7TdbS33h0J.zk7xIUHb4m5uC','2019-04-02 20:38:08',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','kotikota','za','Tana','2019-04-02 20:37:33',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(133,2,'jul4','jul4','jul4@jul.com','jul4@jul.com',1,NULL,'$2y$13$68VU4nYEs6RkDR/5GA2vN.QktKvm8eVtFAUCbAodBGE0J4ZOOzvdS',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','jul','jul','jul','2019-04-02 21:46:45',NULL,'345475684',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(139,2,'boba','boba','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$n4ovvRNeHcmLkWSKPsePBun6Bj7EclVA9PnAfES9qZBeRl8.jbqu6',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','ada','donu','dada','2019-04-02 22:28:33',NULL,'zzzzzzzzzzz',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(140,2,'zazaza','zazaza','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$5pZhHDKfzYSomKNWJ2cq9OW1XCHiqOfrHbk5R4pG2mX9GUA4JDUIG',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','mick','micik','mi','2019-04-02 22:42:11',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(142,3,'dada','dada','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$bbSYLGoN10nsdPIlcsmP4eqguvRgK0r3Xrn1BOX9J.JEk3vM0Nxz2',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','a','a','Tana','2019-04-02 22:53:33',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',NULL),(143,3,'da','da','julienrajerison5@gmail.con','julienrajerison5@gmail.con',1,NULL,'$2y$13$S5YnF6OGQxu.f9VXJGev7e44ICAJsbSCipgLIL0Ou6sYanTKT8Y/O',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','a','a','a','2019-04-02 22:54:28',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'20182019',0),(144,3,'roland','roland','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$unoQLlbaaN8Ma9lmtqNXF.A1sbFZrr1l0xSAcKY58.7jOSTTW0X0W',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','rolan','rolan','tana','2019-04-06 08:31:34',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',0),(147,2,'zeze','zeze','julienrajerisonzzzzz5@gmail.com','julienrajerisonzzzzz5@gmail.com',1,NULL,'$2y$13$WgiAQmuVHbmlbjyvVxrdYeg45o8pKYlC2W84ZEeTU3Xi2NyBrgoqe',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','dadada','dada','dada','2019-04-09 22:43:13',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(149,4,'pda','pda','julienrajerisonaaa5@gmail.com','julienrajerisonaaa5@gmail.com',1,NULL,'$2y$13$4HIjJikyxnhQWaGzkQijSu8MTkTSRpWtSLnh5vXr/MLSwQaqvY9pe',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','kotikota','za','Tana','2019-04-09 23:28:41',NULL,'0324578574',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(150,2,'tsanta','tsanta','julienrajerison@gmail.com','julienrajerison@gmail.com',1,NULL,'$2y$13$5WKSy1Bb/FMFwSsYxK6aUOsUKDk96QnJXwG.T2IyQFt2mvhpyM5au',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','Tsanta','Tsanta','Tan','2019-04-11 11:59:37',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(151,2,'per','per','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$wl4kwFwdxfVCleiu0GdZWuJPR.vAG6cMSMKsuwxal69snz1IKEF0K',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','Perety','Tana','2019-04-12 19:18:24',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(152,2,'poma','poma','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$An8yMOggKtb0R4.YGF0xOOOTNMUXrmgUtBlQWLss29bX01XeVYQnO',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','Perety','Tana','2019-04-12 19:20:03',NULL,NULL,NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(153,2,'ponaaa','ponaaa','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$ViJiZ0uSsQQcij7cMMLmB.vAPmOtoptcIIuYF05cOGBbPQVg6OD6K',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','julien','julien','Tana','2019-04-12 19:25:03',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(154,2,'combo','combo','julienrajerison5@gmail.coma','julienrajerison5@gmail.coma',1,NULL,'$2y$13$3sYxeVFXI9VbWo7Il6IlluvdKDBN9Xpp//7VuBl0wdy0Nx690xHoC',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','Tsanta','Tana','2019-05-02 09:01:45',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55',NULL,NULL),(155,2,'comboa','comboa','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$FBjNre2U0bnFxrYUzTb8XOLgEpKbysSRSy5BCqiWefk.kID8q4NyS',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','Tsanta','Tana','2019-05-02 10:48:18',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(156,2,'vatobe','vatobe',NULL,NULL,1,NULL,'$2y$13$XSnlzHS71V.Y748PuZ.jDOYvQ5zUYzk.1NmpbCSDNmtqtgQsvRwSC','2019-05-06 10:56:04',NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','Etudiant 1','Etudiant 1','Etudiant 1','2019-05-06 10:55:39',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(162,4,'black','black','bema@mama.com','bema@mama.com',1,NULL,'black',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','black','black','black','2019-05-14 14:56:52',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(163,4,'koin','koin','bema@mama.com','bema@mama.com',1,NULL,'koin',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','koin','koin','koin','2019-05-14 14:58:15',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(164,4,'cheng','cheng','bema@mama.com','bema@mama.com',1,NULL,'cheng',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','cheng','cheng','cheng','2019-05-14 15:00:36',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(165,4,'prrr','prrr','bema@mama.com','bema@mama.com',1,NULL,'prrr',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','prrr','prrr','prrr','2019-05-15 01:55:57',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL),(166,4,'testa','testa','bema@mama.com','bema@mama.com',1,NULL,'$2y$13$4E.TYBLd.GWJWjgMXycsQeoptlOchnNZW9i51dfKOrZrtuWrJIFW.','2019-05-15 02:02:24',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','test','test','test','2019-05-15 02:01:36',NULL,'0329475215',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL,'2018-10-30 16:17:55','2019-10-01 16:17:55','20182019',NULL);
/*!40000 ALTER TABLE `sk_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-21 12:02:57
