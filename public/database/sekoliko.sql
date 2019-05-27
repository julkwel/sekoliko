-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: sekoliko1.1
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
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveau_id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F87BF96B3E9C81` (`niveau_id`),
  CONSTRAINT `FK_8F87BF96B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classe`
--

LOCK TABLES `classe` WRITE;
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classe_matiere`
--

DROP TABLE IF EXISTS `classe_matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classe_matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matieres_id` int(11) NOT NULL,
  `professeur_id` int(11) DEFAULT NULL,
  `classe_id` int(11) NOT NULL,
  `coefficient` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` longtext COLLATE utf8mb4_unicode_ci,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EB8D372B82350831` (`matieres_id`),
  UNIQUE KEY `UNIQ_EB8D372B8F5EA509` (`classe_id`),
  UNIQUE KEY `UNIQ_EB8D372BBAB22EE9` (`professeur_id`),
  CONSTRAINT `FK_EB8D372B82350831` FOREIGN KEY (`matieres_id`) REFERENCES `matiere` (`id`),
  CONSTRAINT `FK_EB8D372B8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  CONSTRAINT `FK_EB8D372BBAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classe_matiere`
--

LOCK TABLES `classe_matiere` WRITE;
/*!40000 ALTER TABLE `classe_matiere` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe_matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_id` int(11) NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_pere` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_mere` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom_pere` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom_mere` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_parent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_717E22E38F5EA509` (`classe_id`),
  CONSTRAINT `FK_717E22E38F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiant`
--

LOCK TABLES `etudiant` WRITE;
/*!40000 ALTER TABLE `etudiant` DISABLE KEYS */;
/*!40000 ALTER TABLE `etudiant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `date_de_naissance` datetime DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'julkwel','julkwel','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$Ty7PSyccViC8HcihfDbOfuTChrFTuZRLU52qfuisENhDUPHPzTkyO','2019-05-27 17:32:43',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',NULL,'',NULL,'',NULL,'',NULL,NULL,'','',NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matiere`
--

LOCK TABLES `matiere` WRITE;
/*!40000 ALTER TABLE `matiere` DISABLE KEYS */;
/*!40000 ALTER TABLE `matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190527103206','2019-05-27 10:32:12'),('20190527122648','2019-05-27 12:27:04'),('20190527122945','2019-05-27 12:29:51'),('20190527131911','2019-05-27 13:19:44'),('20190527132706','2019-05-27 13:27:21'),('20190527134201','2019-05-27 13:42:07'),('20190527143939','2019-05-27 14:39:51');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau`
--

LOCK TABLES `niveau` WRITE;
/*!40000 ALTER TABLE `niveau` DISABLE KEYS */;
/*!40000 ALTER TABLE `niveau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indice` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_service` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cisco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel`
--

LOCK TABLES `personnel` WRITE;
/*!40000 ALTER TABLE `personnel` DISABLE KEYS */;
/*!40000 ALTER TABLE `personnel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profs_id` int(11) NOT NULL,
  `cin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cin` datetime NOT NULL,
  `heures_par_semaines` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_ae` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_prise_service` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_17A55299BDDFA3C9` (`profs_id`),
  CONSTRAINT `FK_17A55299BDDFA3C9` FOREIGN KEY (`profs_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professeur`
--

LOCK TABLES `professeur` WRITE;
/*!40000 ALTER TABLE `professeur` DISABLE KEYS */;
/*!40000 ALTER TABLE `professeur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trimestre`
--

DROP TABLE IF EXISTS `trimestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trimestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `as_date_debut` datetime DEFAULT NULL,
  `as_date_fin` datetime DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_addresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ets_contact` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trimestre`
--

LOCK TABLES `trimestre` WRITE;
/*!40000 ALTER TABLE `trimestre` DISABLE KEYS */;
/*!40000 ALTER TABLE `trimestre` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-27 18:54:43
