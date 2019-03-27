-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: sekoliko2.0
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
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190124205803'),('20190128053150'),('20190128102308'),('20190214103107'),('20190215100015'),('20190215101315'),('20190215102505'),('20190215133951'),('20190215134050'),('20190216125744'),('20190216191316'),('20190216201504'),('20190216220041'),('20190225081452'),('20190225084907'),('20190225093858'),('20190225122151'),('20190225122345'),('20190225140546'),('20190225191533'),('20190326223059'),('20190326224726'),('20190326225217'),('20190327111917'),('20190327143100'),('20190327153313'),('20190327154526');
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
  PRIMARY KEY (`id`),
  KEY `IDX_497ED0384BDFF36B` (`niveau`),
  CONSTRAINT `FK_497ED0384BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_niveau` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_classe`
--

LOCK TABLES `sk_classe` WRITE;
/*!40000 ALTER TABLE `sk_classe` DISABLE KEYS */;
INSERT INTO `sk_classe` VALUES (1,NULL,'zaza',NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'azaza',NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'zaza',NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'zaza',NULL,NULL,NULL,NULL,NULL,NULL),(8,5,'zaazazaza','Techzara',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sk_classe` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `IDX_591D9529EEC51E56` (`matNom`),
  CONSTRAINT `FK_591D9529EEC51E56` FOREIGN KEY (`matNom`) REFERENCES `sk_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_edt`
--

LOCK TABLES `sk_edt` WRITE;
/*!40000 ALTER TABLE `sk_edt` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9CF709B44BDFF36B` (`niveau`),
  UNIQUE KEY `UNIQ_9CF709B4717E22E3` (`etudiant`),
  CONSTRAINT `FK_9CF709B44BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_classe` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9CF709B4717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_etudiant`
--

LOCK TABLES `sk_etudiant` WRITE;
/*!40000 ALTER TABLE `sk_etudiant` DISABLE KEYS */;
INSERT INTO `sk_etudiant` VALUES (1,8,1,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sk_etudiant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_matiere`
--

DROP TABLE IF EXISTS `sk_matiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mat_coeff` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matProf` int(11) DEFAULT NULL,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matClasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A1BC20CA623B6832` (`matProf`),
  KEY `IDX_A1BC20CA76AA3D43` (`matClasse`),
  CONSTRAINT `FK_A1BC20CA623B6832` FOREIGN KEY (`matProf`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A1BC20CA76AA3D43` FOREIGN KEY (`matClasse`) REFERENCES `sk_classe` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_matiere`
--

LOCK TABLES `sk_matiere` WRITE;
/*!40000 ALTER TABLE `sk_matiere` DISABLE KEYS */;
INSERT INTO `sk_matiere` VALUES (1,'zaza','zaza',25,'Techzara',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Malagasy','12',25,'Techzara',NULL,NULL,NULL,NULL,NULL,8);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_niveau`
--

LOCK TABLES `sk_niveau` WRITE;
/*!40000 ALTER TABLE `sk_niveau` DISABLE KEYS */;
INSERT INTO `sk_niveau` VALUES (1,'Testzaaaaaaaaaaaaaa','Techzara',NULL,NULL,NULL,NULL,NULL),(4,'sssssss',NULL,NULL,NULL,NULL,NULL,NULL),(5,'zzaaa','Techzara',NULL,NULL,NULL,NULL,NULL);
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
  PRIMARY KEY (`id`),
  KEY `IDX_76659743EEC51E56` (`matNom`),
  KEY `IDX_76659743717E22E3` (`etudiant`),
  CONSTRAINT `FK_76659743717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `sk_etudiant` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_76659743EEC51E56` FOREIGN KEY (`matNom`) REFERENCES `sk_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_note`
--

LOCK TABLES `sk_note` WRITE;
/*!40000 ALTER TABLE `sk_note` DISABLE KEYS */;
INSERT INTO `sk_note` VALUES (1,'10',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'10',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'10',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'10',3,NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `sk_note` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_role`
--

LOCK TABLES `sk_role` WRITE;
/*!40000 ALTER TABLE `sk_role` DISABLE KEYS */;
INSERT INTO `sk_role` VALUES (1,'Superadmin'),(2,'Admin'),(3,'Etudiant'),(4,'Profs'),(5,'Personel'),(6,'Parent');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_salle`
--

LOCK TABLES `sk_salle` WRITE;
/*!40000 ALTER TABLE `sk_salle` DISABLE KEYS */;
INSERT INTO `sk_salle` VALUES (3,'aza','za',0,'2019-03-27 13:05:00','2019-03-27 13:05:00',NULL,'Techzara',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sk_salle` ENABLE KEYS */;
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
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_canonical_UNIQUE` (`username_canonical`),
  UNIQUE KEY `email_canonical_UNIQUE` (`email_canonical`),
  UNIQUE KEY `confirmation_token_UNIQUE` (`confirmation_token`),
  KEY `IDX_344BBB1EE7AB552C` (`sk_role_id`),
  CONSTRAINT `FK_344BBB1EE7AB552C` FOREIGN KEY (`sk_role_id`) REFERENCES `sk_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1,'julien','julien','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$hxjy5.pW2rnuBHsyJa.VreMcmZXMdVthY/kLdEtdKHSSWPsRaUtea','2019-03-27 02:38:14',NULL,NULL,'a:1:{i:0;s:15:\"ROLE_SUPERADMIN\";}','teste','teste','teste','2019-01-24 22:59:34','2019-03-27 20:17:23','0329473033','/upload/user/a378b14bb7a8d7485917e6694f372e4e.jpeg',0,'Techzara',NULL,'',NULL,NULL,NULL),(21,3,'julienaz','julienaz','julienrajerison5@gmail.comza','julienrajerison5@gmail.comza',1,NULL,'$2y$13$.vQFMtnJOnxLnebDt4.WNeNWqXF5Ydx4Jfllli8pCpeZslqYmwrNO',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','za','dada','aza','2019-03-26 23:18:11',NULL,'0329473033',NULL,0,'',NULL,'',NULL,NULL,NULL),(22,3,'julienzaz','julienzaz','julienrajerison5@gmail.comz','julienrajerison5@gmail.comz',1,NULL,'$2y$13$pNZ9CNo6o41j44SRGplmj.y2sUIcko2UtmUzEoyrc7mpEmKwgBRBK',NULL,NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','dada','Tana','2019-03-27 00:52:38',NULL,'0329473033',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(24,3,'julienz','julienz','julienrajerison5@gmail.coma','julienrajerison5@gmail.coma',1,NULL,'$2y$13$ZKIBm0vX45CJstb8yPACD.8B4zd8iH3UiRj22HzCLR0FEJKPC09/K','2019-03-27 02:37:48',NULL,NULL,'a:1:{i:0;s:13:\"ROLE_ETUDIANT\";}','kotikota','dada','Tana','2019-03-27 02:37:37',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL),(25,4,'prof','prof','julienrajerison5@gmail.comaz','julienrajerison5@gmail.comaz',1,NULL,'$2y$13$/8XvrgoHuO1qAKIM9G90SezMlSHaQL5vBmezNsgBTBB6N6c/DevOW',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','azz','dada','aza','2019-03-27 10:14:14',NULL,'0329473033',NULL,0,'Techzara',NULL,NULL,NULL,NULL,NULL),(26,4,'prof2','prof2','julienrajerison5@gmail.comzaz','julienrajerison5@gmail.comzaz',1,NULL,'$2y$13$CidiQwWw2xhoQECujlgkuuOv5EUmJe9ui7fxLSkWBHooMXVk5SeXS',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_PROFS\";}','z','dada','a','2019-03-27 10:49:38',NULL,'0329473033',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2019-03-27 21:27:25
