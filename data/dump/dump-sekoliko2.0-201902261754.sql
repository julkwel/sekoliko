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
-- Table structure for table `ets`
--

DROP TABLE IF EXISTS `ets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ets_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ets_adresse` longtext COLLATE utf8_unicode_ci,
  `ets_responsable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ets_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ets_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ets`
--

LOCK TABLES `ets` WRITE;
/*!40000 ALTER TABLE `ets` DISABLE KEYS */;
/*!40000 ALTER TABLE `ets` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `migration_versions` VALUES ('20190124205803'),('20190128053150'),('20190128102308'),('20190214103107'),('20190215100015'),('20190215101315'),('20190215102505'),('20190215133951'),('20190215134050'),('20190216125744'),('20190216191316'),('20190216201504'),('20190216220041'),('20190225081452'),('20190225084907'),('20190225093858'),('20190225122151'),('20190225122345'),('20190225140546'),('20190225191533');
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
  PRIMARY KEY (`id`),
  KEY `IDX_497ED0384BDFF36B` (`niveau`),
  CONSTRAINT `FK_497ED0384BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_niveau` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_classe`
--

LOCK TABLES `sk_classe` WRITE;
/*!40000 ALTER TABLE `sk_classe` DISABLE KEYS */;
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
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9CF709B44BDFF36B` (`niveau`),
  UNIQUE KEY `UNIQ_9CF709B4717E22E3` (`etudiant`),
  KEY `IDX_9CF709B4CFBDFA14` (`note`),
  CONSTRAINT `FK_9CF709B44BDFF36B` FOREIGN KEY (`niveau`) REFERENCES `sk_classe` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9CF709B4717E22E3` FOREIGN KEY (`etudiant`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9CF709B4CFBDFA14` FOREIGN KEY (`note`) REFERENCES `sk_note` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_etudiant`
--

LOCK TABLES `sk_etudiant` WRITE;
/*!40000 ALTER TABLE `sk_etudiant` DISABLE KEYS */;
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
  `actEvent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A1BC20CA623B6832` (`matProf`),
  KEY `IDX_A1BC20CA6FC3B45D` (`actEvent`),
  CONSTRAINT `FK_A1BC20CA623B6832` FOREIGN KEY (`matProf`) REFERENCES `sk_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A1BC20CA6FC3B45D` FOREIGN KEY (`actEvent`) REFERENCES `ets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_matiere`
--

LOCK TABLES `sk_matiere` WRITE;
/*!40000 ALTER TABLE `sk_matiere` DISABLE KEYS */;
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
  `etsNom` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D269CC53741BC70` (`etsNom`),
  CONSTRAINT `FK_8D269CC53741BC70` FOREIGN KEY (`etsNom`) REFERENCES `ets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_niveau`
--

LOCK TABLES `sk_niveau` WRITE;
/*!40000 ALTER TABLE `sk_niveau` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `IDX_76659743EEC51E56` (`matNom`),
  CONSTRAINT `FK_76659743EEC51E56` FOREIGN KEY (`matNom`) REFERENCES `sk_matiere` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_note`
--

LOCK TABLES `sk_note` WRITE;
/*!40000 ALTER TABLE `sk_note` DISABLE KEYS */;
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
  `etsNom` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BB2162663741BC70` (`etsNom`),
  CONSTRAINT `FK_BB2162663741BC70` FOREIGN KEY (`etsNom`) REFERENCES `ets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_salle`
--

LOCK TABLES `sk_salle` WRITE;
/*!40000 ALTER TABLE `sk_salle` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_canonical_UNIQUE` (`username_canonical`),
  UNIQUE KEY `email_canonical_UNIQUE` (`email_canonical`),
  UNIQUE KEY `confirmation_token_UNIQUE` (`confirmation_token`),
  KEY `IDX_344BBB1EE7AB552C` (`sk_role_id`),
  CONSTRAINT `FK_344BBB1EE7AB552C` FOREIGN KEY (`sk_role_id`) REFERENCES `sk_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1,'julien','julien','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$CzOV8aI87NL0iqDviZz/SemLlKUhfRxLFpQ/s0c1pk2PcFPSCexxK','2019-02-26 16:12:23',NULL,NULL,'a:1:{i:0;s:15:\"ROLE_SUPERADMIN\";}','teste','teste','teste','2019-01-24 22:59:34','2019-01-24 23:03:28','0329473033',NULL,0),(9,3,'zaz','zaz','hello@gmail.com','hello@gmail.com',1,NULL,'$2y$13$FfJaLxavsDEhWnfZpWO4ZukyPPU9QY/n/c9aMNEaendTgKQr6fCaS',NULL,NULL,NULL,'a:1:{i:0;s:11:\"ROLE_MEMBER\";}','Hello','Hello','Hello','2019-02-14 16:07:01',NULL,'0365478954',NULL,0),(14,2,'bonbonzzzayyy','bonbonzzzayyy','julienrajerisonzzz5@gmail.azaza','julienrajerisonzzz5@gmail.azaza',1,NULL,'hello',NULL,NULL,NULL,'a:0:{}','testezzzzzzzazaza','testazzzazaz','testezzazaz','2019-02-26 01:27:52',NULL,'0329473033',NULL,0),(15,2,'bonbonzzzayyya','bonbonzzzayyya','julienrajerisonzzz5@gmail.azazazz','julienrajerisonzzz5@gmail.azazazz',1,NULL,'hello',NULL,NULL,NULL,'a:0:{}','testezzzzzzzazaza','testazzzazaz','testezzazaz','2019-02-26 01:29:19',NULL,'0329473033',NULL,0),(16,2,'bonoc','bonoc','julienrajerisonzzz5@ga.co','julienrajerisonzzz5@ga.co',1,NULL,'helloaz',NULL,NULL,NULL,'a:0:{}','testezzzzzzzazaza','testazzzazaz','testezzazaz','2019-02-26 01:34:40',NULL,'0329473033','/upload/image/61533f59dfb287e1fd1013236caccec9.png',0),(18,2,'bonocaz','bonocaz','julienrajerisonzzz5@ga.coza','julienrajerisonzzz5@ga.coza',1,NULL,'helloaz',NULL,NULL,NULL,'a:0:{}','testezzzzzzzazaza','testazzzazaz','testezzazaz','2019-02-26 01:40:36',NULL,'0329473033','/upload/image/abc6d01d8160de546b31821ddc73e862.png',0);
/*!40000 ALTER TABLE `sk_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sekoliko2.0'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-26 17:54:34
