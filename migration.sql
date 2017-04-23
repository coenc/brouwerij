CREATE DATABASE  IF NOT EXISTS `brouwerij` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `brouwerij`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: brouwerij
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `accijnstarifs`
--

DROP TABLE IF EXISTS `accijnstarifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accijnstarifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentageplato` varchar(50) DEFAULT NULL,
  `tariefperhl` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accijnstarifs`
--

LOCK TABLES `accijnstarifs` WRITE;
/*!40000 ALTER TABLE `accijnstarifs` DISABLE KEYS */;
INSERT INTO `accijnstarifs` VALUES (1,'< 7%',0.00,NULL,NULL,NULL),(2,'7% tot 11%',24.92,NULL,NULL,NULL),(3,'11% tot 15%',33.21,NULL,NULL,NULL),(4,'> 16%',41.53,NULL,NULL,NULL);
/*!40000 ALTER TABLE `accijnstarifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beercategories`
--

DROP TABLE IF EXISTS `beercategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beercategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `omschrijving` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beercategories`
--

LOCK TABLES `beercategories` WRITE;
/*!40000 ALTER TABLE `beercategories` DISABLE KEYS */;
INSERT INTO `beercategories` VALUES (1,1,'Pilsener',NULL,NULL,NULL),(2,1,'Bockbier',NULL,NULL,NULL),(3,1,'Dubbel',NULL,NULL,NULL),(4,1,'Triple',NULL,NULL,NULL),(5,1,'Witbier',NULL,NULL,NULL),(6,1,'Traditioneel',NULL,NULL,NULL),(7,1,'Stout',NULL,NULL,NULL),(8,1,'Fruit',NULL,NULL,NULL),(9,1,'Blond',NULL,NULL,NULL),(10,1,'Quadruple',NULL,NULL,NULL),(11,1,'Ale',NULL,'2017-03-11 21:48:00',NULL),(12,1,'Brood','2017-03-07 19:51:31','2017-03-07 19:51:31',NULL),(13,2,'Bruinbrood',NULL,NULL,NULL),(14,2,'Wit brood',NULL,NULL,NULL),(19,1,'ZZZZ','2017-04-07 20:41:40','2017-04-08 14:47:36','2017-04-08 14:47:36');
/*!40000 ALTER TABLE `beercategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beersorts`
--

DROP TABLE IF EXISTS `beersorts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beersorts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `beercategory_id` int(11) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  `omschrijving` varchar(100) DEFAULT NULL,
  `toelichting` varchar(1000) DEFAULT NULL,
  `vastofseizoen` enum('V','S') DEFAULT NULL,
  `accijnstarif_id` int(11) DEFAULT NULL,
  `ogmin` int(11) DEFAULT NULL,
  `ogmax` int(11) DEFAULT NULL,
  `fgmin` int(11) DEFAULT NULL,
  `fgmax` int(11) DEFAULT NULL,
  `alcvolmin` int(11) DEFAULT NULL,
  `alcvolmax` int(11) DEFAULT NULL,
  `ebumin` int(11) DEFAULT NULL,
  `ebumax` int(11) DEFAULT NULL,
  `ebcmin` int(11) DEFAULT NULL,
  `ebcmax` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beersorts`
--

LOCK TABLES `beersorts` WRITE;
/*!40000 ALTER TABLE `beersorts` DISABLE KEYS */;
INSERT INTO `beersorts` VALUES (1,1,5,'R+B','Ruw+Bolster','XFris, kruidig witbier naar het voorbeeld van de Belgen. Fijn hoparoma door toevoeging aromahop na de eerste vergisting.','V',3,1,2,3,4,5,6,7,8,9,10,'ruwenbolster.png','2017-02-04 11:12:44',NULL,NULL),(2,1,6,'A+Z','Arm+Zalig','Niet zo zwaar, maar wel veel smaak. Dit bier krijgt zijn smaak door o.a. rookmout en jeneverbes.','V',3,3,4,9,0,1,2,5,6,7,8,'armenzalig.png','2017-03-18 12:52:29',NULL,NULL),(4,1,1,'S+Z','Scherp+Zinnig','Pilsachtig bier – fruitig met een lichte bite. Scherp+Zinnig heeft de smaak en het aroma van hop en rode pepers.','V',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'notfound.png','2017-02-03 20:56:26',NULL,NULL),(5,1,1,'D+D','Dubbel+Dik','Rijk, donker bier, naar het voorbeeld van de Belgische Dubbels, kruidig en een beetje zoet.','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dubbelendik.png',NULL,NULL,NULL),(6,1,1,'SCH','Scheepsrecht','Kruidig en zoet, naar het voorbeeld van de Belgische Tripels, met het aroma van kruidnagels','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'scheepsrecht.png',NULL,NULL,NULL),(7,1,2,'S+M','Stout+Moedig','Zwart bier om in te bijten naar het voorbeeld van Iers Stout-bier met een subtiel koffiearoma.','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'stoutenmoedig.png',NULL,NULL,NULL),(9,1,3,'B+B','Bezig+Bij','Goudbruin bier met het subtiele aroma van echte bijenhoning','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bezigenbij.png',NULL,NULL,NULL),(10,1,3,'S+T','Spring+Tijm','Uitbundig lentebier. Het eerste seizoensbier van De 7 Deugden. Gemaakt met pilsmout en tarwemout, verrijkt met oranjeschil en tijm.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'springentijm.png',NULL,NULL,NULL),(11,1,3,'S+B','Spring+Bock','Donker, moutig bier met op de achtergrond het aroma van groene appels.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'springenbock.png','2017-02-03 20:57:26',NULL,NULL),(12,1,3,'B+S','Bock+Sprong','Verwarmend bockbier met een zweem van rozijnen.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'springenbock.png',NULL,NULL,NULL),(14,2,13,'Z+Z','Kadetjes (bruin)','Volkorenkadetjes met een rijke gezonde smaak','V',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bolbruin.jpg',NULL,NULL,NULL),(15,2,14,'X+X','Kadetjes (wit)','Zacht witbrood met krokante korst','V',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bolwit.jpg',NULL,NULL,NULL),(16,1,9,'www','www','www','S',2,0,0,0,0,0,0,0,0,0,0,'16.jpg','2017-04-08 11:38:35','2017-04-08 09:25:31','2017-04-08 11:38:35'),(17,1,11,'zzz','zzz','zzz','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 14:47:50','2017-04-08 12:17:42','2017-04-08 14:47:50'),(18,1,11,'ppp','ppkkk','uuuu','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:00:12','2017-04-08 14:50:50','2017-04-08 16:00:12'),(19,1,11,'p','p','p','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:00:10','2017-04-08 15:59:24','2017-04-08 16:00:10'),(20,1,11,'p','p','p','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:01:24','2017-04-08 16:00:26','2017-04-08 16:01:24'),(21,1,11,'o','o','o','V',1,0,0,0,0,0,0,0,0,0,0,'21.jpg','2017-04-08 16:10:40','2017-04-08 16:01:38','2017-04-08 16:10:40'),(22,1,11,'v','v','v','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:10:37','2017-04-08 16:05:15','2017-04-08 16:10:37'),(23,1,11,'c','c','c','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:10:42','2017-04-08 16:06:31','2017-04-08 16:10:42'),(24,1,11,'9','9','9','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 16:10:35','2017-04-08 16:09:56','2017-04-08 16:10:35'),(25,1,11,'w','w','w','V',1,0,0,0,0,0,0,0,0,0,0,NULL,'2017-04-08 19:22:49','2017-04-08 16:10:58','2017-04-08 19:22:49');
/*!40000 ALTER TABLE `beersorts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brouwsels`
--

DROP TABLE IF EXISTS `brouwsels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brouwsels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `biersoort_id` int(11) DEFAULT NULL,
  `liters` int(11) DEFAULT NULL,
  `sgbegin` int(11) DEFAULT NULL,
  `sgeind` int(11) DEFAULT NULL,
  `datumsmaaktest` datetime DEFAULT NULL,
  `opmerking` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brouwsels`
--

LOCK TABLES `brouwsels` WRITE;
/*!40000 ALTER TABLE `brouwsels` DISABLE KEYS */;
INSERT INTO `brouwsels` VALUES (16,2,'2017-01-01',14,99,NULL,NULL,NULL,'Productie van januari',NULL,'2017-04-09 16:10:26',NULL),(26,1,'2017-01-01',4,200,NULL,NULL,NULL,'','2017-03-26 19:22:39','2017-03-26 19:22:39',NULL),(27,1,'2017-02-06',5,100,NULL,NULL,NULL,'','2017-03-26 19:22:57','2017-03-26 19:22:57',NULL),(28,1,'2017-02-06',7,150,NULL,NULL,NULL,'1e brouwsel van de maand februari','2017-03-26 19:24:10','2017-04-07 21:04:05',NULL),(29,1,'2017-02-14',1,250,NULL,NULL,NULL,'','2017-03-26 19:24:59','2017-03-26 19:24:59',NULL),(30,1,'2017-02-16',11,100,NULL,NULL,NULL,'test productie','2017-03-26 19:25:32','2017-03-31 15:59:26',NULL),(31,1,'2017-01-01',4,10,NULL,NULL,NULL,'','2017-03-27 16:44:45','2017-03-27 16:45:13',NULL),(32,2,'2017-02-01',15,10,NULL,NULL,NULL,'xxx','2017-04-09 16:10:42','2017-04-09 16:19:05',NULL);
/*!40000 ALTER TABLE `brouwsels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grondstofcategorie`
--

DROP TABLE IF EXISTS `grondstofcategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grondstofcategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `omschrijving` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grondstofcategorie`
--

LOCK TABLES `grondstofcategorie` WRITE;
/*!40000 ALTER TABLE `grondstofcategorie` DISABLE KEYS */;
INSERT INTO `grondstofcategorie` VALUES (1,1,'Mout en graan',NULL,'2017-03-12 07:28:58',NULL),(2,1,'Hop',NULL,NULL,NULL),(3,1,'Gist',NULL,NULL,NULL),(4,1,'Kruiden/specerijen',NULL,NULL,NULL),(5,1,'Suiker',NULL,NULL,NULL),(6,1,'Diversen',NULL,NULL,NULL),(7,1,'Flessen',NULL,NULL,NULL),(8,1,'Etiketten',NULL,NULL,NULL),(10,2,'Meelsoorten',NULL,'2017-04-09 16:13:26',NULL),(13,2,'Smaakversterkers','2017-03-18 19:06:41','2017-03-18 19:06:41',NULL),(23,4,'qqq','2017-03-19 16:59:28','2017-03-19 16:59:28',NULL),(24,2,'Gisten','2017-04-09 09:31:43','2017-04-09 16:13:18',NULL);
/*!40000 ALTER TABLE `grondstofcategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grondstoffen`
--

DROP TABLE IF EXISTS `grondstoffen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grondstoffen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `grondstofcategorie_id` int(11) DEFAULT NULL,
  `naam` varchar(256) DEFAULT NULL,
  `ebc` int(11) DEFAULT NULL,
  `ibu` int(11) DEFAULT NULL,
  `extrpercentage` int(11) DEFAULT NULL,
  `leverancier_id` int(11) DEFAULT NULL,
  `minimumvoorraad` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grondstoffen`
--

LOCK TABLES `grondstoffen` WRITE;
/*!40000 ALTER TABLE `grondstoffen` DISABLE KEYS */;
INSERT INTO `grondstoffen` VALUES (1,1,1,'Amber',NULL,50,74,NULL,NULL,NULL,NULL,NULL),(2,1,1,'Cara aroma',NULL,35,0,NULL,NULL,NULL,NULL,NULL),(3,1,1,'Carafa typ I',NULL,900,0,NULL,NULL,NULL,NULL,NULL),(4,1,1,'Caramunchen typ 2',NULL,120,0,NULL,NULL,NULL,NULL,NULL),(5,1,1,'Caramunchen typ 3',NULL,150,0,NULL,NULL,NULL,NULL,NULL),(6,1,1,'Cara pils',NULL,5,0,NULL,NULL,NULL,NULL,NULL),(7,1,1,'Cara red',NULL,40,0,NULL,NULL,NULL,NULL,NULL),(8,1,1,'BIO Carafa',NULL,800,0,NULL,NULL,NULL,NULL,NULL),(9,1,1,'Havervlokken',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(10,1,1,'Munchen typ I',NULL,15,0,NULL,NULL,NULL,NULL,NULL),(11,1,1,'Pale ale 7EBC 25kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,1,1,'Pils/bio pilsner',NULL,3,0,NULL,NULL,NULL,NULL,NULL),(13,1,1,'Rijstvlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,1,1,'Roggemout',NULL,8,0,NULL,NULL,NULL,NULL,NULL),(15,1,1,'Rookmout',NULL,5,0,NULL,NULL,NULL,NULL,NULL),(16,1,1,'Sauermalz',NULL,4,NULL,NULL,NULL,NULL,NULL,NULL),(17,1,1,'Special B',NULL,150,0,NULL,NULL,NULL,NULL,NULL),(18,1,1,'Spelt',NULL,4,0,NULL,NULL,NULL,NULL,NULL),(19,1,1,'Tarwevlokken',NULL,3,NULL,NULL,NULL,NULL,NULL,NULL),(20,1,1,'Vienna',NULL,7,0,NULL,NULL,NULL,NULL,NULL),(21,1,1,'Weizen dunkel',NULL,15,0,NULL,NULL,NULL,NULL,NULL),(22,1,1,'Weizen hell',NULL,3,0,NULL,NULL,NULL,NULL,NULL),(23,1,2,'Brewersgold',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,1,2,'Challenger',NULL,6,NULL,NULL,NULL,NULL,NULL,NULL),(25,1,2,'East kent goldings',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(26,1,2,'Hallertauer hersbrucker',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(27,1,2,'Hallertauer perle',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(28,1,2,'Northern brewer',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(29,1,3,'Safale S-04',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,1,3,'Safale US 05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,1,3,'Safbrew S 33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,1,3,'Safbrew T 58',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,1,3,'Saflager S 23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,1,4,'Jeneverbes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,1,4,'Kardamom',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,1,4,'Koriander',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,1,4,'Kruidnagel',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,1,4,'Oranjeschil',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,1,4,'Rode pepers',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,1,4,'Steranijs',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,1,4,'Zoethout',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,1,5,'Ahornsiroop',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(43,1,5,'Bruine kandij',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(44,1,5,'Glucose',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(45,1,5,'Oerzoet',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(46,1,5,'Rietsuiker',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(47,1,6,'Appels',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,1,6,'Eikenchips frans medium toast',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,1,6,'Eikenchips medium toast',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,1,6,'Espresso koffie',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,1,6,'Hazelnoten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,1,6,'Perenmoes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,1,6,'Vlierbessen',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,1,8,'Etiket klein',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,1,8,'Etiket groot',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,1,7,'Fles 33cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,1,7,'Fles 75 cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,1,1,'BIO Pilsener',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,1,1,'BIO Carafa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,1,1,'BIO Cara Munchen',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,1,1,'BIO Munchener I',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,1,1,'BIO Pilsener',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(63,1,1,'BIO Weizen hell',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,1,1,'Rauchmalz',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(65,1,1,'BIO Spelt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(66,1,1,'Havervlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(67,1,1,'Rijst',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(68,1,1,'Oerzoet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(69,1,1,'Rijstvlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(70,1,2,'Hallentauer Hersbrucker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(71,1,2,'Northern brewer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(72,1,2,'Hallertaue Spalt Select',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,1,2,'Safale S-04 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(74,1,2,'Safale US 05 (56)  0,5kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(75,1,2,'Safbrew S-33 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(76,1,2,'Saflager S-23 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(77,1,4,'Koffie',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78,1,4,'Rozijnen',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(100,1,9,'Volkorenbloem',NULL,NULL,NULL,NULL,NULL,'2017-03-11 08:40:39','2017-04-08 11:38:51','2017-04-08 11:38:51'),(101,1,9,'Zout',NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-08 11:38:54','2017-04-08 11:38:54'),(102,2,10,'Volkorenbloem',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(103,2,13,'Zout',NULL,NULL,NULL,NULL,NULL,NULL,'2017-03-18 19:06:56',NULL),(107,4,23,'abc123',NULL,NULL,NULL,NULL,NULL,'2017-03-19 16:59:42','2017-03-19 16:59:49',NULL),(108,2,24,'Gist',NULL,NULL,NULL,NULL,NULL,'2017-04-09 09:32:04','2017-04-09 16:13:44',NULL);
/*!40000 ALTER TABLE `grondstoffen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grondstofverbruik`
--

DROP TABLE IF EXISTS `grondstofverbruik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grondstofverbruik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grondstof_id` int(11) NOT NULL,
  `brouwsel_id` int(11) DEFAULT NULL,
  `inkoop_id` int(11) DEFAULT NULL,
  `hoeveelheid` int(11) DEFAULT NULL,
  `kostprijs` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grondstofverbruik`
--

LOCK TABLES `grondstofverbruik` WRITE;
/*!40000 ALTER TABLE `grondstofverbruik` DISABLE KEYS */;
/*!40000 ALTER TABLE `grondstofverbruik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(200) DEFAULT NULL,
  `groupname` varchar(200) DEFAULT NULL,
  `adres` varchar(200) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `woonplaats` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'1.png','Brouwerij De Vrolijke Gast','Vrolijkstraat 1','1000AA','Amsterdam','info@devrolijkegast.nl',NULL,'2017-04-07 20:14:05'),(2,'2.png','Bakkerij Het Bruine Broodje','Volkorenstraat 123','1234AB','Amsterdam','info@bakkerijhetbruinebroodje.nl',NULL,'2017-04-09 09:33:20');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inkoopgrondstof`
--

DROP TABLE IF EXISTS `inkoopgrondstof`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inkoopgrondstof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `grondstof_id` int(11) DEFAULT NULL,
  `hoeveelheidkg` decimal(10,3) DEFAULT '0.000',
  `verbruiktkg` decimal(10,3) DEFAULT '0.000',
  `prijsexbtw` decimal(10,2) DEFAULT NULL,
  `leverancierid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inkoopgrondstof`
--

LOCK TABLES `inkoopgrondstof` WRITE;
/*!40000 ALTER TABLE `inkoopgrondstof` DISABLE KEYS */;
INSERT INTO `inkoopgrondstof` VALUES (1,1,'2017-01-01',1,1000.000,42.900,9.98,NULL,'2017-01-01 00:00:00','2017-03-26 19:22:57',NULL),(2,1,'2017-01-20',11,1000.000,0.000,12.65,NULL,'2017-01-01 00:00:00',NULL,NULL),(3,1,'2017-01-01',19,1000.000,0.000,1.25,NULL,'2017-01-01 00:00:00',NULL,NULL),(4,1,'2017-02-03',26,1000.000,0.000,3.75,NULL,'2017-01-01 00:00:00',NULL,NULL),(5,1,'2017-02-03',27,1000.000,0.000,13.50,NULL,'2017-01-01 00:00:00',NULL,NULL),(6,1,'2017-02-03',28,1000.000,0.000,14.50,NULL,'2017-01-01 00:00:00',NULL,NULL),(7,1,'2017-02-20',58,1000.000,115.450,18.35,NULL,'2017-01-01 00:00:00','2017-03-27 16:44:45',NULL),(8,1,'2017-02-20',59,1000.000,1.300,10.00,NULL,'2017-01-01 00:00:00','2017-04-09 12:39:38','2017-04-09 12:39:38'),(9,1,'2017-02-20',60,1000.000,17.850,19.75,NULL,'2017-01-01 00:00:00','2017-03-26 19:24:10',NULL),(10,1,'2017-02-20',61,1000.000,12.300,25.00,NULL,'2017-01-01 00:00:00','2017-03-26 19:25:32',NULL),(11,1,'2017-02-20',62,1000.000,0.000,3.10,NULL,'2017-01-01 00:00:00',NULL,NULL),(12,1,'2017-02-20',63,1000.000,39.750,10.00,NULL,'2017-01-01 00:00:00','2017-03-26 19:25:32',NULL),(13,1,'2017-03-01',70,1000.000,268.680,18.00,NULL,'2017-01-01 00:00:00','2017-03-27 16:44:45',NULL),(14,1,'2017-03-02',71,2000.000,1314.850,21.10,NULL,'2017-01-01 00:00:00','2017-03-27 16:44:45',NULL),(15,1,'2017-03-02',72,1000.000,142.750,5.75,NULL,'2017-01-01 00:00:00','2017-03-26 19:24:59',NULL),(16,2,'2017-04-01',108,100.000,4.000,9.75,NULL,'2017-04-09 12:47:43','2017-04-09 16:10:42',NULL),(17,2,'2017-03-31',103,10.000,0.000,11.00,NULL,'2017-04-09 12:49:57','2017-04-09 12:49:57',NULL),(18,2,'2017-04-01',102,22.000,18.000,12.00,NULL,'2017-04-09 12:50:58','2017-04-09 16:10:42',NULL),(19,2,'2017-04-12',103,25.000,4.000,15.00,NULL,'2017-04-09 12:52:28','2017-04-09 12:52:28',NULL);
/*!40000 ALTER TABLE `inkoopgrondstof` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klanten`
--

DROP TABLE IF EXISTS `klanten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `naam` varchar(1000) DEFAULT NULL,
  `factuurnaam` varchar(1000) DEFAULT NULL,
  `factuuradres` varchar(1000) DEFAULT NULL,
  `factuurpostcode` varchar(1000) DEFAULT NULL,
  `factuurplaats` varchar(1000) DEFAULT NULL,
  `contactpersoon` varchar(1000) DEFAULT NULL,
  `telefoon` varchar(1000) DEFAULT NULL,
  `mobiel` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `website` varchar(1000) DEFAULT NULL,
  `aflevernaam` varchar(1000) DEFAULT NULL,
  `afleveradres` varchar(1000) DEFAULT NULL,
  `afleverpostcode` varchar(1000) DEFAULT NULL,
  `afleverplaats` varchar(1000) DEFAULT NULL,
  `openingstijden` varchar(1000) DEFAULT NULL,
  `nieuwsbriefjn` varchar(1) DEFAULT NULL,
  `bankrekening` varchar(20) DEFAULT NULL,
  `banknaam` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klanten`
--

LOCK TABLES `klanten` WRITE;
/*!40000 ALTER TABLE `klanten` DISABLE KEYS */;
INSERT INTO `klanten` VALUES (1,'Hotel Arena',NULL,NULL,NULL,NULL,'Ruben Vis','020-850 2400','06 1285 0473','finance@amvilco.nl (voor facturen Rabin)','',NULL,'s-Gravesandestraat 5','1092 AA','Amsterdam',NULL,NULL,NULL,NULL),(2,'t Arendsnest',NULL,NULL,NULL,NULL,'Peter van de Arend (eigenaar)','020-4212 057','06-5364 1442 (Hans Stalenhoef bedr.ldr)','info@arendsnest.nl /café@arendsnest.nl','www.meerbier.nl',NULL,'Herengracht 90','1015 BS','',NULL,NULL,NULL,NULL),(3,'Café Bar baarsch',NULL,NULL,NULL,NULL,'Reinoud','','06-1803 1631','info@barbaarsch.nl','',NULL,'Jan Evertsenstraat','','Amsterdam',NULL,NULL,NULL,NULL),(4,'Blue Square Hotel BV',NULL,NULL,NULL,NULL,'','020-506 3717','','','',NULL,'Slotermeerlaan 80','1064 HD','Amsterdam',NULL,NULL,NULL,NULL),(5,'Hotel La Boheme',NULL,NULL,NULL,NULL,'','','','','',NULL,'','','',NULL,NULL,NULL,NULL),(6,'Biercafé De Bonte Koe Purmerend',NULL,NULL,NULL,NULL,'Huub Arents 06-1254 4914, fact.naar Anemonenstraat 22, 1441 HX Purmerend','0299-421 124','','','www.biertevredenbontekoe.nl (niet zeker over nl)',NULL,'Koemarkt 24','','Purmerend',NULL,NULL,NULL,NULL),(7,'Brouwcafe',NULL,NULL,NULL,NULL,'Tony Lutz eigenaar','','06-2426 5489','','',NULL,'Dr. Lelykade 28','','Scheveningen haven',NULL,NULL,NULL,NULL),(8,'Café Buiten',NULL,NULL,NULL,NULL,'Pluim/Michel','','','cafebuitensloterplas@gmail.com','',NULL,'','','',NULL,NULL,NULL,NULL),(84,'De Wijnstok Delft',NULL,NULL,NULL,NULL,'Bart','015-256 8567','','www.de-wijnstok.nl','b.kooiman@de-wijnstok.nl',NULL,'Fred. Hendrikstraat 34a,','2628 TC','Delft',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `klanten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leveranciers`
--

DROP TABLE IF EXISTS `leveranciers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leveranciers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `naam` varchar(1000) DEFAULT NULL,
  `factuurnaam` varchar(1000) DEFAULT NULL,
  `factuuradres` varchar(1000) DEFAULT NULL,
  `factuurpostcode` varchar(1000) DEFAULT NULL,
  `factuurplaats` varchar(1000) DEFAULT NULL,
  `contactpersoon` varchar(1000) DEFAULT NULL,
  `telefoon` varchar(1000) DEFAULT NULL,
  `mobiel` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `website` varchar(1000) DEFAULT NULL,
  `openingstijden` varchar(1000) DEFAULT NULL,
  `bankrekening` varchar(100) DEFAULT NULL,
  `banknaam` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leveranciers`
--

LOCK TABLES `leveranciers` WRITE;
/*!40000 ALTER TABLE `leveranciers` DISABLE KEYS */;
INSERT INTO `leveranciers` VALUES (1,1,'Brewferm',NULL,'Korspolsesteenweg 86','3581','Beverlo, België',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'WeyerMan',NULL,'Brennerstrasse 17-19','96052','Bamberg, Germany',NULL,'+ 49 (0)951 93 220-0',NULL,'info@weyermann.de','www.weyermann.de',NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'Brouwland',NULL,'Korspelsesteenweg 86','3581','Beverlo, België',NULL,'+32 (0)11 40.14.08',NULL,'sales@brouwland.com','http://www.brouwland.com/nl/',NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'SBI4Beer',NULL,'Eikenlaan 24','5453 RV','Langenboom',NULL,'+31 (0)486-436750',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'Brouwmarkt',NULL,'Markerkant 1111','1316 AE','Almere',NULL,'036-5400844',NULL,'Info@brouwmarkt.nl','www.brouwmarkt.nl',NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'Meel B.V.',NULL,'Volkorenstraat 1','1766AM','Doetinchem',NULL,'012-345678','','info@meelleverancier.nl','www.meelleverancier.nl',NULL,'','',NULL,'2017-04-09 16:27:20',NULL),(7,2,'Volkoren BV',NULL,'Meelstraat 33','1422BR','Brodelen',NULL,'0123-4567889900','','info@volkoren.nl','www.volkoren.nl',NULL,'','','2017-03-18 19:16:55','2017-04-09 16:24:11',NULL);
/*!40000 ALTER TABLE `leveranciers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('coen.coppoolse@gmail.com','$2y$10$oaPranHFFBbaVhvfeccE0OvshAT4fUXhE7jTg7ckmAAaNwMb17ELi','2017-03-29 16:22:38');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recepten`
--

DROP TABLE IF EXISTS `recepten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recepten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `biersoort_id` int(11) DEFAULT NULL,
  `grondstof_id` int(11) DEFAULT NULL,
  `hoeveelheid` decimal(8,3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recepten`
--

LOCK TABLES `recepten` WRITE;
/*!40000 ALTER TABLE `recepten` DISABLE KEYS */;
INSERT INTO `recepten` VALUES (1,1,4,58,0.190,NULL,NULL,NULL),(2,1,4,66,0.013,NULL,NULL,NULL),(3,1,4,67,0.013,NULL,NULL,NULL),(4,1,4,71,1.000,NULL,NULL,NULL),(5,1,4,71,1.000,NULL,NULL,NULL),(6,1,4,70,0.833,NULL,NULL,NULL),(7,1,4,76,0.001,NULL,NULL,NULL),(8,1,4,39,0.001,NULL,NULL,NULL),(9,1,5,58,0.140,NULL,NULL,NULL),(10,1,5,66,0.006,NULL,NULL,NULL),(11,1,5,61,0.040,NULL,NULL,NULL),(12,1,5,60,0.066,NULL,NULL,NULL),(13,1,5,59,0.001,NULL,NULL,NULL),(14,1,5,68,0.009,NULL,NULL,NULL),(15,1,5,71,0.629,NULL,NULL,NULL),(16,1,5,71,0.686,NULL,NULL,NULL),(17,1,5,1,0.429,NULL,NULL,NULL),(18,1,5,75,0.001,NULL,NULL,NULL),(19,1,5,37,0.000,NULL,NULL,NULL),(20,1,5,40,0.000,NULL,NULL,NULL),(21,1,5,41,0.000,NULL,NULL,NULL),(22,1,7,58,0.165,NULL,NULL,NULL),(23,1,7,60,0.075,NULL,NULL,NULL),(24,1,7,59,0.008,NULL,NULL,NULL),(25,1,7,63,0.038,NULL,NULL,NULL),(26,1,7,68,0.015,NULL,NULL,NULL),(27,1,7,71,1.125,NULL,NULL,NULL),(28,1,7,71,1.250,NULL,NULL,NULL),(29,1,7,70,0.625,NULL,NULL,NULL),(30,1,7,74,0.001,NULL,NULL,NULL),(31,1,7,77,0.001,NULL,NULL,NULL),(32,1,1,58,0.114,NULL,NULL,NULL),(33,1,1,63,0.103,NULL,NULL,NULL),(34,1,1,66,0.011,NULL,NULL,NULL),(35,1,1,69,0.000,NULL,NULL,NULL),(36,1,1,75,0.001,NULL,NULL,NULL),(37,1,1,71,0.314,NULL,NULL,NULL),(38,1,1,71,0.514,NULL,NULL,NULL),(39,1,1,72,0.571,NULL,NULL,NULL),(40,1,6,58,0.240,NULL,NULL,NULL),(41,1,6,61,0.046,NULL,NULL,NULL),(42,1,6,66,0.006,NULL,NULL,NULL),(43,1,6,71,0.857,NULL,NULL,NULL),(44,1,6,71,0.686,NULL,NULL,NULL),(45,1,6,70,0.429,NULL,NULL,NULL),(46,1,6,75,0.001,NULL,NULL,NULL),(47,1,6,34,0.001,NULL,NULL,NULL),(48,1,6,37,0.000,NULL,NULL,NULL),(49,1,3,58,0.063,NULL,NULL,NULL),(50,1,3,63,0.098,NULL,NULL,NULL),(51,1,3,60,0.033,NULL,NULL,NULL),(52,1,3,65,0.013,NULL,NULL,NULL),(53,1,3,66,0.005,NULL,NULL,NULL),(54,1,3,71,0.625,NULL,NULL,NULL),(55,1,3,71,0.750,NULL,NULL,NULL),(56,1,3,70,0.563,NULL,NULL,NULL),(57,1,3,75,0.001,NULL,NULL,NULL),(58,1,3,35,0.000,NULL,NULL,NULL),(59,1,11,58,0.083,NULL,NULL,NULL),(60,1,11,63,0.083,NULL,NULL,NULL),(61,1,11,66,0.014,NULL,NULL,NULL),(62,1,11,69,0.019,NULL,NULL,NULL),(63,1,11,61,0.083,NULL,NULL,NULL),(64,1,11,71,0.667,NULL,NULL,NULL),(65,1,11,71,0.667,NULL,NULL,NULL),(66,1,11,71,0.667,NULL,NULL,NULL),(67,1,11,76,0.001,NULL,NULL,NULL),(73,1,2,71,0.660,NULL,'2017-03-16 18:54:26',NULL),(74,1,2,71,0.813,NULL,NULL,NULL),(75,1,2,72,0.500,NULL,NULL,NULL),(76,1,2,74,0.001,NULL,NULL,NULL),(77,1,2,34,0.001,NULL,NULL,NULL),(78,1,8,58,0.213,NULL,NULL,NULL),(79,1,8,60,0.073,NULL,NULL,NULL),(80,1,8,61,0.033,NULL,NULL,NULL),(81,1,8,68,0.007,NULL,NULL,NULL),(82,1,8,59,0.003,NULL,NULL,NULL),(83,1,8,66,0.007,NULL,NULL,NULL),(84,1,8,71,0.600,NULL,NULL,NULL),(85,1,8,71,0.833,NULL,NULL,NULL),(86,1,8,70,0.667,NULL,NULL,NULL),(87,1,8,74,0.001,NULL,NULL,NULL),(88,1,8,40,0.000,NULL,NULL,NULL),(89,1,8,41,0.000,NULL,NULL,NULL),(90,1,12,58,0.229,NULL,NULL,NULL),(91,1,12,63,0.057,NULL,NULL,NULL),(92,1,12,60,0.026,NULL,NULL,NULL),(93,1,12,59,0.006,NULL,NULL,NULL),(94,1,12,67,0.003,NULL,NULL,NULL),(95,1,12,66,0.003,NULL,NULL,NULL),(96,1,12,71,0.714,NULL,NULL,NULL),(97,1,12,71,0.714,NULL,NULL,NULL),(98,1,12,72,0.571,NULL,NULL,NULL),(99,1,12,73,0.001,NULL,NULL,NULL),(100,1,12,78,0.002,NULL,NULL,NULL),(101,1,13,100,1.000,'2017-03-25 19:39:33','2017-03-25 19:39:33',NULL),(102,1,13,101,0.001,'2017-03-25 19:39:43','2017-03-25 19:41:13',NULL),(103,2,14,102,0.500,'2017-04-09 09:15:45','2017-04-09 09:15:45',NULL),(104,2,14,103,0.010,'2017-04-09 09:15:55','2017-04-09 09:15:55',NULL),(105,2,15,102,1.500,'2017-04-09 09:16:08','2017-04-09 09:16:08',NULL),(106,2,15,108,0.300,'2017-04-09 09:32:30','2017-04-09 09:32:30',NULL);
/*!40000 ALTER TABLE `recepten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `woonplaats` int(11) DEFAULT NULL,
  `group_id` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mr. User','guest@bis.nl','guest','$2y$10$Ly7lKsrWftpQB1XlujYKpeT3XrBx5NJoz6wA.aR4M2fb0jj0ZbaPq','zrNxsFOsDuMuda1LYNtJy5WRlnFWoPPPTWXdvbcW88ROpDBSiYuTje4eXruc',63,1,'2017-03-19 16:56:18','2017-03-19 16:56:18'),(2,'bakery user','baker@bakery.com','baker','$2y$10$zgnn.llQzHtMu7oA6e6E9uDU/isFpXQ/6.J1Xh8U9zIW0ERcJLMJO','wa84v5h05qj5nFYgH4PdCDEUjbZzjIq2YFVD9Y5DaDXkH4nrErbJV1qVX7LJ',63,2,'2017-03-19 13:20:06','2017-03-19 13:20:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitordata`
--

DROP TABLE IF EXISTS `visitordata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitordata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(45) DEFAULT NULL,
  `requestedurl` varchar(200) DEFAULT NULL,
  `useragent` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitordata`
--

LOCK TABLES `visitordata` WRITE;
/*!40000 ALTER TABLE `visitordata` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitordata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_inkoop_grondstoffen`
--

DROP TABLE IF EXISTS `vw_inkoop_grondstoffen`;
/*!50001 DROP VIEW IF EXISTS `vw_inkoop_grondstoffen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_inkoop_grondstoffen` AS SELECT 
 1 AS `id`,
 1 AS `hoeveelheidkg`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_verbruik_grondstoffen`
--

DROP TABLE IF EXISTS `vw_verbruik_grondstoffen`;
/*!50001 DROP VIEW IF EXISTS `vw_verbruik_grondstoffen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_verbruik_grondstoffen` AS SELECT 
 1 AS `id`,
 1 AS `hoeveelheidkg`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_voorraad_grondstoffen`
--

DROP TABLE IF EXISTS `vw_voorraad_grondstoffen`;
/*!50001 DROP VIEW IF EXISTS `vw_voorraad_grondstoffen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_voorraad_grondstoffen` AS SELECT 
 1 AS `naam`,
 1 AS `ingekocht`,
 1 AS `verbruikt`,
 1 AS `resteert`*/;
SET character_set_client = @saved_cs_client;


-- Dump completed on 2017-04-09 18:30:45
