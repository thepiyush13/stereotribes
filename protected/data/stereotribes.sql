-- MySQL dump 10.13  Distrib 5.1.44, for apple-darwin8.11.1 (i386)
--
-- Host: localhost    Database: stereotribes
-- ------------------------------------------------------
-- Server version	5.1.44

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
-- Current Database: `stereotribes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `stereotribes` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `stereotribes`;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(55) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  KEY `links_project_id` (`project_id`),
  CONSTRAINT `links_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_links`
--

DROP TABLE IF EXISTS `media_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_links` (
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `extra_code` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  KEY `media_project_id` (`project_id`),
  CONSTRAINT `media_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_links`
--

LOCK TABLES `media_links` WRITE;
/*!40000 ALTER TABLE `media_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) DEFAULT NULL,
  `short_summary` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `flip_image_url` varchar(255) DEFAULT NULL,
  `short_url` varchar(55) DEFAULT NULL,
  `category` varchar(55) DEFAULT NULL,
  `goal` decimal(10,0) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `project_for` enum('team','individual') NOT NULL DEFAULT 'individual',
  `funding_type` enum('fixed','flexible') DEFAULT NULL,
  `days_run` int(11) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `media_type` varchar(45) DEFAULT NULL,
  `video_url` varchar(100) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `pitch_story` text,
  `main_link` varchar(155) DEFAULT NULL,
  `thankyou_media_type` varchar(45) DEFAULT NULL,
  `thankyou_media_url` varchar(45) DEFAULT NULL,
  `campaign_url` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `social_amplifier_status` tinyint(4) DEFAULT NULL,
  `rewardDisclaimer` enum('yes','no') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_category` (`category`),
  KEY `up_ser_id` (`user_id`),
  CONSTRAINT `up_ser_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (2,NULL,NULL,NULL,NULL,NULL,NULL,'technology','500','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,'technology','300','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,'technology','300','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(5,NULL,NULL,NULL,NULL,NULL,NULL,'technology','300','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(6,NULL,NULL,NULL,NULL,NULL,NULL,'technology','300','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(11,'BUILD YOUR AWESOME CAMPAIG','We can\'t wait to see what you\'re project idea is! We begin with designing your promotional flip box. Its the first time to capture the interest of potential funders. When they clic','India','Jamshedpur','http://stereotribes.dev/uploads/campaign/flip_db8e1af0cb3aca1ae2d0018624204529',NULL,'technology','4000','0','individual','flexible',30,'0000-00-00',NULL,'image','//www.youtube.com/embed/PdCInvGOOL0','','<ol><li>india</li><li>pakistan</li><li>australia</li></ol>',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(12,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(13,NULL,NULL,NULL,NULL,NULL,NULL,'technology','2962','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(14,NULL,NULL,NULL,NULL,NULL,NULL,'technology','4000','GBP ','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,'technology','1000','GBP ','individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL),(16,NULL,NULL,NULL,NULL,NULL,NULL,'technology','200','','team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward`
--

DROP TABLE IF EXISTS `reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `reward_types` varchar(555) NOT NULL,
  `fund_amount` varchar(45) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `estimated_delivery` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `funders_shipping_address_required` tinyint(4) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reward_project_id` (`project_id`),
  CONSTRAINT `reward_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward`
--

LOCK TABLES `reward` WRITE;
/*!40000 ALTER TABLE `reward` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_amplifier`
--

DROP TABLE IF EXISTS `social_amplifier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_amplifier` (
  `target` tinyint(4) DEFAULT NULL,
  `message` text,
  `post_status` tinyint(4) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  KEY `sa_project_id` (`project_id`),
  CONSTRAINT `sa_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_amplifier`
--

LOCK TABLES `social_amplifier` WRITE;
/*!40000 ALTER TABLE `social_amplifier` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_amplifier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tribes`
--

DROP TABLE IF EXISTS `tribes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tribes` (
  `email` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `can_edit` varchar(45) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  KEY `tribes_project_id` (`project_id`),
  CONSTRAINT `tribes_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tribes`
--

LOCK TABLES `tribes` WRITE;
/*!40000 ALTER TABLE `tribes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tribes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'kanchan karjee','kanchan@inkoniq.com','21232f297a57a5a743894a0e4a801fc3'),(2,'admin','admin@st.com','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_fund_project`
--

DROP TABLE IF EXISTS `user_fund_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_fund_project` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `amout` varchar(45) DEFAULT NULL,
  `timestamp` varchar(45) DEFAULT NULL,
  `shipping_address` varchar(45) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `reward_received_status` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `uf_project_id` (`project_id`),
  KEY `uf_reward_id` (`reward_id`),
  KEY `uf_user_id` (`user_id`),
  CONSTRAINT `uf_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `uf_reward_id` FOREIGN KEY (`reward_id`) REFERENCES `reward` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `uf_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fund_project`
--

LOCK TABLES `user_fund_project` WRITE;
/*!40000 ALTER TABLE `user_fund_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_fund_project` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-03 18:03:33
