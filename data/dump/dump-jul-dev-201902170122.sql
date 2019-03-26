-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: jul-dev
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
INSERT INTO `migration_versions` VALUES ('20190124205803'),('20190128053150'),('20190128102308'),('20190214103107'),('20190215100015'),('20190215101315'),('20190215102505'),('20190215133951'),('20190215134050'),('20190216125744'),('20190216191316'),('20190216201504'),('20190216220041');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
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
  UNIQUE KEY `UNIQ_3A08CB07D5D52DEC` (`nws_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_email_newsletter`
--

LOCK TABLES `sk_email_newsletter` WRITE;
/*!40000 ALTER TABLE `sk_email_newsletter` DISABLE KEYS */;
INSERT INTO `sk_email_newsletter` VALUES (1,'julienrajerison5@gmail.com',1);
/*!40000 ALTER TABLE `sk_email_newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_event_activite`
--

DROP TABLE IF EXISTS `sk_event_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_event_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `act_description` longtext COLLATE utf8_unicode_ci,
  `act_debut` datetime DEFAULT NULL,
  `act_fin` datetime DEFAULT NULL,
  `act_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actEvent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45682F156FC3B45D` (`actEvent`),
  CONSTRAINT `FK_45682F156FC3B45D` FOREIGN KEY (`actEvent`) REFERENCES `sk_slide` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_event_activite`
--

LOCK TABLES `sk_event_activite` WRITE;
/*!40000 ALTER TABLE `sk_event_activite` DISABLE KEYS */;
INSERT INTO `sk_event_activite` VALUES (1,'Brise glace','Dance kely iarahan\'ny rehetra','2019-03-30 08:08:00','2019-03-30 08:45:00','/upload/slide/d8dac522c1f6480dde85b144b615b2ad.jpeg',6),(2,'Conférences','Conférences entre les participants','2019-02-16 06:40:00','2019-02-16 06:40:00','/upload/slide/adc84e1fa9f5378d75670f65b0a3ee3a.jpeg',6),(3,'Teste','teste','2019-02-16 13:14:00','2019-02-16 13:14:00','/upload/slide/fc7aacdf6a909bff3513324d228668f1.jpeg',5);
/*!40000 ALTER TABLE `sk_event_activite` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_message_newsletter`
--

LOCK TABLES `sk_message_newsletter` WRITE;
/*!40000 ALTER TABLE `sk_message_newsletter` DISABLE KEYS */;
INSERT INTO `sk_message_newsletter` VALUES (1);
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
  KEY `IDX_13D0B35A2C2AC5D3` (`translatable_id`),
  CONSTRAINT `FK_5839731D2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `sk_message_newsletter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_message_newsletter_translation`
--

LOCK TABLES `sk_message_newsletter_translation` WRITE;
/*!40000 ALTER TABLE `sk_message_newsletter_translation` DISABLE KEYS */;
INSERT INTO `sk_message_newsletter_translation` VALUES (1,1,'aaaa','<p>zaaaaaaaaaaaaa</p>','fr');
/*!40000 ALTER TABLE `sk_message_newsletter_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_organisateur`
--

DROP TABLE IF EXISTS `sk_organisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_organisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_image` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_decription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_responsabilite` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actEvent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9039BB5A6FC3B45D` (`actEvent`),
  CONSTRAINT `FK_9039BB5A6FC3B45D` FOREIGN KEY (`actEvent`) REFERENCES `sk_slide` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_organisateur`
--

LOCK TABLES `sk_organisateur` WRITE;
/*!40000 ALTER TABLE `sk_organisateur` DISABLE KEYS */;
INSERT INTO `sk_organisateur` VALUES (1,'Julien','/upload/slide/f0cd690ec933843d2a7803cf124ba884.jpeg','Testaaz','Responsable',6);
/*!40000 ALTER TABLE `sk_organisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_partenaires`
--

DROP TABLE IF EXISTS `sk_partenaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_partenaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parte_entite` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parte_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parte_location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parte_contribution` longtext COLLATE utf8_unicode_ci,
  `actEvent` int(11) NOT NULL,
  `parte_facebook` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parteweb_site` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parte_description` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_872FD8046FC3B45D` (`actEvent`),
  CONSTRAINT `FK_872FD8046FC3B45D` FOREIGN KEY (`actEvent`) REFERENCES `sk_slide` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_partenaires`
--

LOCK TABLES `sk_partenaires` WRITE;
/*!40000 ALTER TABLE `sk_partenaires` DISABLE KEYS */;
INSERT INTO `sk_partenaires` VALUES (1,'Dadaazaza','/upload/slide/9e09d7cf931c931e709a4d82c70581ef.jpeg','ddaaz',NULL,6,NULL,NULL,NULL),(2,'Bocasay',NULL,'Antanimora','Lots pour le premier',6,'https://www.facebook.com/bocasay','https://www.bocasay.com/','Développement web');
/*!40000 ALTER TABLE `sk_partenaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_participants`
--

DROP TABLE IF EXISTS `sk_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_universite` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_team` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_description` longtext COLLATE utf8_unicode_ci,
  `actEvent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AA87A68C6FC3B45D` (`actEvent`),
  CONSTRAINT `FK_AA87A68C6FC3B45D` FOREIGN KEY (`actEvent`) REFERENCES `sk_slide` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_participants`
--

LOCK TABLES `sk_participants` WRITE;
/*!40000 ALTER TABLE `sk_participants` DISABLE KEYS */;
INSERT INTO `sk_participants` VALUES (1,'kotikota','/upload/slide/17ed2bf3af5a4dea23c3bad36a0c03df.jpeg','kotikotaaz','kotikotaazaz',5),(2,'kotikota','/upload/slide/5d0cd0704eaff499a95d8f4a87505624.jpeg','kotikota','kotikota',6);
/*!40000 ALTER TABLE `sk_participants` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_role`
--

LOCK TABLES `sk_role` WRITE;
/*!40000 ALTER TABLE `sk_role` DISABLE KEYS */;
INSERT INTO `sk_role` VALUES (1,'Superadmin'),(2,'Admin'),(3,'Member');
/*!40000 ALTER TABLE `sk_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sk_slide`
--

DROP TABLE IF EXISTS `sk_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sld_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sld_event_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sld_intervenant` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sld_location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sld_place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sld_event_date` datetime DEFAULT NULL,
  `sld_event_description` longtext COLLATE utf8_unicode_ci,
  `sld_event_date_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_slide`
--

LOCK TABLES `sk_slide` WRITE;
/*!40000 ALTER TABLE `sk_slide` DISABLE KEYS */;
INSERT INTO `sk_slide` VALUES (5,'/upload/slide/e541590e9616ed89da0c491042ee5393.jpeg','aza','zaza','azaza','zaza','2019-02-15 13:38:00','zaza','2019-02-15 13:38:00'),(6,'/upload/slide/f72dbe4db08e38f8d04c2cbe88bb22cd.jpeg','Hackathon InterUniversitaire 2019','Techzara','Antananarivo','84','2019-03-30 08:00:00','Concours entre les université partouts à Madagascar','2019-03-31 19:00:00');
/*!40000 ALTER TABLE `sk_slide` ENABLE KEYS */;
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
  `usr_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_is_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_canonical_UNIQUE` (`username_canonical`),
  UNIQUE KEY `email_canonical_UNIQUE` (`email_canonical`),
  UNIQUE KEY `confirmation_token_UNIQUE` (`confirmation_token`),
  KEY `IDX_4B8D00C0158A5D9F` (`sk_role_id`),
  CONSTRAINT `FK_A98A6686CC5EF58D` FOREIGN KEY (`sk_role_id`) REFERENCES `sk_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1,'julien','julien','julienrajerison5@gmail.com','julienrajerison5@gmail.com',1,NULL,'$2y$13$CzOV8aI87NL0iqDviZz/SemLlKUhfRxLFpQ/s0c1pk2PcFPSCexxK','2019-02-15 12:19:33',NULL,NULL,'a:1:{i:0;s:15:\"ROLE_SUPERADMIN\";}','teste','teste','teste','2019-01-24 22:59:34','2019-01-24 23:03:28','0329473033',NULL,0),(9,3,'zaz','zaz','hello@gmail.com','hello@gmail.com',1,NULL,'$2y$13$FfJaLxavsDEhWnfZpWO4ZukyPPU9QY/n/c9aMNEaendTgKQr6fCaS',NULL,NULL,NULL,'a:1:{i:0;s:11:\"ROLE_MEMBER\";}','Hello','Hello','Hello','2019-02-14 16:07:01',NULL,'0365478954',NULL,0);
/*!40000 ALTER TABLE `sk_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'jul-dev'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-17  1:22:57
