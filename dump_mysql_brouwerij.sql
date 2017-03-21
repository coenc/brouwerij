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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accijnstarifs`
--

LOCK TABLES `accijnstarifs` WRITE;
/*!40000 ALTER TABLE `accijnstarifs` DISABLE KEYS */;
INSERT INTO `accijnstarifs` VALUES (1,'< 7%',0.00,NULL,NULL),(2,'7% tot 11%',24.92,NULL,NULL),(3,'11% tot 15%',33.21,NULL,NULL),(4,'> 16%',41.53,NULL,NULL);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beercategories`
--

LOCK TABLES `beercategories` WRITE;
/*!40000 ALTER TABLE `beercategories` DISABLE KEYS */;
INSERT INTO `beercategories` VALUES (1,1,'Pilsener',NULL,NULL),(2,1,'Bockbier',NULL,NULL),(3,1,'Dubbel',NULL,NULL),(4,1,'Triple',NULL,NULL),(5,1,'Witbier',NULL,NULL),(6,1,'Traditioneel',NULL,NULL),(7,1,'Stout',NULL,NULL),(8,1,'Fruit',NULL,NULL),(9,1,'Blond',NULL,NULL),(10,1,'Quadruple',NULL,NULL),(11,1,'Ale',NULL,'2017-03-11 21:48:00'),(12,1,'Brood','2017-03-07 19:51:31','2017-03-07 19:51:31'),(13,2,'Bruinbrood',NULL,NULL),(14,2,'Wit brood',NULL,NULL),(15,1,'aaa','2017-03-18 16:47:44','2017-03-18 16:47:44');
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
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `smaak` varchar(1000) DEFAULT NULL,
  `afdronk` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beersorts`
--

LOCK TABLES `beersorts` WRITE;
/*!40000 ALTER TABLE `beersorts` DISABLE KEYS */;
INSERT INTO `beersorts` VALUES (1,1,5,'R+B','Ruw+Bolster','XFris, kruidig witbier naar het voorbeeld van de Belgen. Fijn hoparoma door toevoeging aromahop na de eerste vergisting.','V',3,1,2,3,4,5,6,7,8,9,10,'2017-02-04 11:12:44',NULL,NULL,NULL,NULL),(2,1,6,'A+Z','Arm+Zalig','Niet zo zwaar, maar wel veel smaak. Dit bier krijgt zijn smaak door o.a. rookmout en jeneverbes.','V',3,3,4,9,0,1,2,5,6,7,8,'2017-03-18 12:52:29',NULL,'armenzalig.png',NULL,NULL),(4,1,1,'S+Z','Scherp+Zinnig','Pilsachtig bier – fruitig met een lichte bite. Scherp+Zinnig heeft de smaak en het aroma van hop en rode pepers.','V',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-02-03 20:56:26',NULL,'notfound.png',NULL,NULL),(5,1,1,'D+D','Dubbel+Dik','Rijk, donker bier, naar het voorbeeld van de Belgische Dubbels, kruidig en een beetje zoet.','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dubbelendik.png',NULL,NULL),(6,1,1,'SCH','Scheepsrecht','Kruidig en zoet, naar het voorbeeld van de Belgische Tripels, met het aroma van kruidnagels','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'scheepsrecht.png',NULL,NULL),(7,1,2,'S+M','Stout+Moedig','Zwart bier om in te bijten naar het voorbeeld van Iers Stout-bier met een subtiel koffiearoma.','V',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'stoutenmoedig.png',NULL,NULL),(8,1,2,'V+G','Vuur+Gloed','Donker winterbier, voor de donkere avonden rond kerst','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vuurengloed.png',NULL,NULL),(9,1,3,'B+B','Bezig+Bij','Goudbruin bier met het subtiele aroma van echte bijenhoning','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bezigenbij.png',NULL,NULL),(10,1,3,'S+T','Spring+Tijm','Uitbundig lentebier. Het eerste seizoensbier van De 7 Deugden. Gemaakt met pilsmout en tarwemout, verrijkt met oranjeschil en tijm.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'springentijm.png',NULL,NULL),(11,1,3,'S+B','Spring+Bock','Donker, moutig bier met op de achtergrond het aroma van groene appels.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-02-03 20:57:26',NULL,'springenbock.png',NULL,NULL),(12,1,3,'B+S','Bock+Sprong','Verwarmend bockbier met een zweem van rozijnen.','S',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'springenbock.png',NULL,NULL),(13,1,1,'B+B','Kadet (bruin)','Volkorenbrood met volle smaak','S',1,3,4,9,0,1,2,5,6,7,8,'2017-03-15 20:32:45','2017-03-07 19:52:07',NULL,NULL,NULL),(14,2,13,'Z+Z','Kadetjes (bruin)','Volkorenkadetjes met een rijke gezonde smaak','V',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,2,14,'X+X','Kadetjes (wit)','Zacht witbrood met krokante korts','V',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brouwsels`
--

LOCK TABLES `brouwsels` WRITE;
/*!40000 ALTER TABLE `brouwsels` DISABLE KEYS */;
INSERT INTO `brouwsels` VALUES (1,1,'2016-12-06',1,1000,NULL,NULL,NULL,'De eerste brouw van 2016 is een geslaagde batch met veel smaak en een goede kleur',NULL,NULL),(2,1,'2016-12-22',2,2000,NULL,NULL,NULL,'De 2e brouw van 2016 is een geslaagde batch met veel smaak en een goede kleur',NULL,NULL),(12,1,'2017-03-11',13,2,NULL,NULL,NULL,'eerste x','2017-03-11 10:12:57','2017-03-11 10:12:57'),(13,1,'2017-03-12',1,2,NULL,NULL,NULL,'tweede xxxx','2017-03-11 10:13:11','2017-03-11 20:01:50'),(14,1,'2017-03-11',13,1,NULL,NULL,NULL,'xxx','2017-03-11 10:14:19','2017-03-11 10:14:19'),(15,1,'2017-03-31',13,1,NULL,NULL,NULL,'test','2017-03-11 20:52:03','2017-03-12 21:52:13'),(16,2,'2017-01-01',14,1,NULL,NULL,NULL,'Brouwsel',NULL,'2017-03-18 19:39:47'),(20,1,'2017-03-18',13,1,NULL,NULL,NULL,'xxx','2017-03-18 16:28:51','2017-03-18 16:28:51');
/*!40000 ALTER TABLE `brouwsels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bedrijfsnaam` varchar(100) NOT NULL,
  `bedrijfsadres` varchar(100) DEFAULT NULL,
  `bedrijfspostcode` varchar(45) DEFAULT NULL,
  `bedrijfswoonplaats` varchar(100) DEFAULT NULL,
  `bedrijfsemail` varchar(45) DEFAULT NULL,
  `bedrijfswebsite` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'Brouwerij B.V.','Brouwerijstraat 1','1000AA','Brouwerijstad','demo@brouwerij.nl','www.mijnbrouwerij.nl',NULL,NULL);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grondstofcategorie`
--

LOCK TABLES `grondstofcategorie` WRITE;
/*!40000 ALTER TABLE `grondstofcategorie` DISABLE KEYS */;
INSERT INTO `grondstofcategorie` VALUES (1,1,'Mout en graan',NULL,'2017-03-12 07:28:58'),(2,1,'Hop',NULL,NULL),(3,1,'Gist',NULL,NULL),(4,1,'Kruiden/specerijen',NULL,NULL),(5,1,'Suiker',NULL,NULL),(6,1,'Diversen',NULL,NULL),(7,1,'Flessen',NULL,NULL),(8,1,'Etiketten',NULL,NULL),(9,1,'Bloem','2017-03-07 19:52:48','2017-03-07 19:52:48'),(10,2,'Meel',NULL,'2017-03-18 19:06:30'),(13,2,'Smaakversterkers','2017-03-18 19:06:41','2017-03-18 19:06:41');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grondstoffen`
--

LOCK TABLES `grondstoffen` WRITE;
/*!40000 ALTER TABLE `grondstoffen` DISABLE KEYS */;
INSERT INTO `grondstoffen` VALUES (1,1,1,'Amber',NULL,50,74,NULL,NULL,NULL,NULL),(2,1,1,'Cara aroma',NULL,35,0,NULL,NULL,NULL,NULL),(3,1,1,'Carafa typ I',NULL,900,0,NULL,NULL,NULL,NULL),(4,1,1,'Caramunchen typ 2',NULL,120,0,NULL,NULL,NULL,NULL),(5,1,1,'Caramunchen typ 3',NULL,150,0,NULL,NULL,NULL,NULL),(6,1,1,'Cara pils',NULL,5,0,NULL,NULL,NULL,NULL),(7,1,1,'Cara red',NULL,40,0,NULL,NULL,NULL,NULL),(8,1,1,'BIO Carafa',NULL,800,0,NULL,NULL,NULL,NULL),(9,1,1,'Havervlokken',NULL,NULL,1,NULL,NULL,NULL,NULL),(10,1,1,'Munchen typ I',NULL,15,0,NULL,NULL,NULL,NULL),(11,1,1,'Pale ale 7EBC 25kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,1,1,'Pils/bio pilsner',NULL,3,0,NULL,NULL,NULL,NULL),(13,1,1,'Rijstvlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,1,1,'Roggemout',NULL,8,0,NULL,NULL,NULL,NULL),(15,1,1,'Rookmout',NULL,5,0,NULL,NULL,NULL,NULL),(16,1,1,'Sauermalz',NULL,4,NULL,NULL,NULL,NULL,NULL),(17,1,1,'Special B',NULL,150,0,NULL,NULL,NULL,NULL),(18,1,1,'Spelt',NULL,4,0,NULL,NULL,NULL,NULL),(19,1,1,'Tarwevlokken',NULL,3,NULL,NULL,NULL,NULL,NULL),(20,1,1,'Vienna',NULL,7,0,NULL,NULL,NULL,NULL),(21,1,1,'Weizen dunkel',NULL,15,0,NULL,NULL,NULL,NULL),(22,1,1,'Weizen hell',NULL,3,0,NULL,NULL,NULL,NULL),(23,1,2,'Brewersgold',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,1,2,'Challenger',NULL,6,NULL,NULL,NULL,NULL,NULL),(25,1,2,'East kent goldings',NULL,0,NULL,NULL,NULL,NULL,NULL),(26,1,2,'Hallertauer hersbrucker',NULL,0,NULL,NULL,NULL,NULL,NULL),(27,1,2,'Hallertauer perle',NULL,0,NULL,NULL,NULL,NULL,NULL),(28,1,2,'Northern brewer',NULL,0,NULL,NULL,NULL,NULL,NULL),(29,1,3,'Safale S-04',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,1,3,'Safale US 05',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,1,3,'Safbrew S 33',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,1,3,'Safbrew T 58',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,1,3,'Saflager S 23',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,1,4,'Jeneverbes',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,1,4,'Kardamom',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,1,4,'Koriander',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,1,4,'Kruidnagel',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,1,4,'Oranjeschil',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,1,4,'Rode pepers',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,1,4,'Steranijs',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,1,4,'Zoethout',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,1,5,'Ahornsiroop',NULL,NULL,1,NULL,NULL,NULL,NULL),(43,1,5,'Bruine kandij',NULL,NULL,1,NULL,NULL,NULL,NULL),(44,1,5,'Glucose',NULL,NULL,1,NULL,NULL,NULL,NULL),(45,1,5,'Oerzoet',NULL,NULL,1,NULL,NULL,NULL,NULL),(46,1,5,'Rietsuiker',NULL,NULL,1,NULL,NULL,NULL,NULL),(47,1,6,'Appels',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,1,6,'Eikenchips frans medium toast',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,1,6,'Eikenchips medium toast',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,1,6,'Espresso koffie',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,1,6,'Hazelnoten',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,1,6,'Perenmoes',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,1,6,'Vlierbessen',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,1,8,'Etiket klein',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,1,8,'Etiket groot',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,1,7,'Fles 33cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,1,7,'Fles 75 cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,1,1,'BIO Pilsener',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,1,1,'BIO Carafa',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,1,1,'BIO Cara Munchen',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,1,1,'BIO Munchener I',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,1,1,'BIO Pilsener',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(63,1,1,'BIO Weizen hell',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,1,1,'Rauchmalz',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(65,1,1,'BIO Spelt',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(66,1,1,'Havervlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(67,1,1,'Rijst',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(68,1,1,'Oerzoet',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(69,1,1,'Rijstvlokken',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(70,1,2,'Hallentauer Hersbrucker',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(71,1,2,'Northern brewer',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(72,1,2,'Hallertaue Spalt Select',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,1,2,'Safale S-04 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(74,1,2,'Safale US 05 (56)  0,5kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(75,1,2,'Safbrew S-33 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(76,1,2,'Saflager S-23 0,5 kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(77,1,4,'Koffie',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78,1,4,'Rozijnen',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(100,1,9,'Volkorenbloem',NULL,NULL,NULL,NULL,NULL,'2017-03-11 08:40:39','2017-03-11 08:40:39'),(101,1,9,'Zout',NULL,NULL,NULL,NULL,NULL,NULL,'2017-03-11 21:01:34'),(102,2,10,'Volkorenbloem',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(103,2,13,'Zout',NULL,NULL,NULL,NULL,NULL,NULL,'2017-03-18 19:06:56');
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
  `grondstofid` int(11) NOT NULL,
  `hoeveelheid` int(11) DEFAULT NULL,
  `kostprijs` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
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
  `groupname` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Brouwerij de 7 deugden','de7deugden.png'),(2,'Bakkerij Het Bruine Broodje','bakkerij.png');
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
  `besteldatum` date DEFAULT NULL,
  `bezorgdatum` date DEFAULT NULL,
  `leverancierid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inkoopgrondstof`
--

LOCK TABLES `inkoopgrondstof` WRITE;
/*!40000 ALTER TABLE `inkoopgrondstof` DISABLE KEYS */;
INSERT INTO `inkoopgrondstof` VALUES (19,1,'2017-03-11',100,1.000,1.000,1.00,NULL,NULL,NULL,'2017-03-11 08:59:59','2017-03-11 10:13:11'),(20,1,'2017-03-11',101,1.000,1.000,0.50,NULL,NULL,NULL,'2017-03-11 09:00:19','2017-03-18 16:23:15'),(21,1,'2017-03-17',100,10.000,4.000,1.00,NULL,NULL,NULL,'2017-03-11 10:13:45','2017-03-18 16:28:50'),(22,1,'2017-03-12',101,10.000,1.400,2.00,NULL,NULL,NULL,'2017-03-11 20:19:15','2017-03-18 16:28:51'),(23,2,'2017-03-18',102,5.000,0.500,1.00,NULL,NULL,NULL,NULL,'2017-03-18 19:38:56'),(24,NULL,'2017-03-18',42,1.000,0.000,1.00,NULL,NULL,NULL,'2017-03-18 18:03:56','2017-03-18 18:03:56'),(26,2,'2017-03-19',103,10.000,0.000,1.00,NULL,NULL,NULL,'2017-03-18 19:00:02','2017-03-18 19:00:02');
/*!40000 ALTER TABLE `inkoopgrondstof` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interacties`
--

DROP TABLE IF EXISTS `interacties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interacties` (
  `id` varchar(1) NOT NULL,
  `relatieid` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `gespreksnotitie` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interacties`
--

LOCK TABLES `interacties` WRITE;
/*!40000 ALTER TABLE `interacties` DISABLE KEYS */;
INSERT INTO `interacties` VALUES ('1',1,'2013-01-01 00:00:00','Klant wil info over bier. Beloofd terug te bellen op maandag'),('2',2,'2012-10-31 00:00:00','Klachtover bezorging'),('3',1,'2011-01-01 00:00:00','Bestelling #884648');
/*!40000 ALTER TABLE `interacties` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leveranciers`
--

LOCK TABLES `leveranciers` WRITE;
/*!40000 ALTER TABLE `leveranciers` DISABLE KEYS */;
INSERT INTO `leveranciers` VALUES (1,1,'Brewferm',NULL,'Korspolsesteenweg 86','3581','Beverlo, België',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'WeyerMan',NULL,'Brennerstrasse 17-19','96052','Bamberg, Germany',NULL,'+ 49 (0)951 93 220-0',NULL,'info@weyermann.de','www.weyermann.de',NULL,NULL,NULL,NULL,NULL),(3,1,'Brouwland',NULL,'Korspelsesteenweg 86','3581','Beverlo, België',NULL,'+32 (0)11 40.14.08',NULL,'sales@brouwland.com','http://www.brouwland.com/nl/',NULL,NULL,NULL,NULL,NULL),(4,1,'SBI4Beer',NULL,'Eikenlaan 24','5453 RV','Langenboom',NULL,'+31 (0)486-436750',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'Brouwmarkt',NULL,'Markerkant 1111','1316 AE','Almere',NULL,'036-5400844',NULL,'Info@brouwmarkt.nl','www.brouwmarkt.nl',NULL,NULL,NULL,NULL,NULL),(6,2,'Meel B.V.1',NULL,'Volkorenstraat 1','1766AM','Doetinchem',NULL,'012-345678','','info@meelleverancier.nl','www.meelleverancier.nl',NULL,'','',NULL,'2017-03-19 10:12:12'),(7,2,'Volkoren BV',NULL,'Meelstraat 33','1422BR','Brodelen',NULL,'0123-4567889900',NULL,'info@broodjes.nl','www.broodjes.nl',NULL,NULL,NULL,'2017-03-18 19:16:55','2017-03-18 19:22:00');
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
INSERT INTO `password_resets` VALUES ('coen.coppoolse@gmail.com','3e8e1dda9f32bc10412781bce7bb4f7ca4d50357aa18f317f363c77d715a4b1f','2017-02-25 08:33:38');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recepten`
--

LOCK TABLES `recepten` WRITE;
/*!40000 ALTER TABLE `recepten` DISABLE KEYS */;
INSERT INTO `recepten` VALUES (1,1,4,58,0.190,NULL,NULL),(2,1,4,66,0.013,NULL,NULL),(3,1,4,67,0.013,NULL,NULL),(4,1,4,71,1.000,NULL,NULL),(5,1,4,71,1.000,NULL,NULL),(6,1,4,70,0.833,NULL,NULL),(7,1,4,76,0.001,NULL,NULL),(8,1,4,39,0.001,NULL,NULL),(9,1,5,58,0.140,NULL,NULL),(10,1,5,66,0.006,NULL,NULL),(11,1,5,61,0.040,NULL,NULL),(12,1,5,60,0.066,NULL,NULL),(13,1,5,59,0.001,NULL,NULL),(14,1,5,68,0.009,NULL,NULL),(15,1,5,71,0.629,NULL,NULL),(16,1,5,71,0.686,NULL,NULL),(17,1,5,1,0.429,NULL,NULL),(18,1,5,75,0.001,NULL,NULL),(19,1,5,37,0.000,NULL,NULL),(20,1,5,40,0.000,NULL,NULL),(21,1,5,41,0.000,NULL,NULL),(22,1,7,58,0.165,NULL,NULL),(23,1,7,60,0.075,NULL,NULL),(24,1,7,59,0.008,NULL,NULL),(25,1,7,63,0.038,NULL,NULL),(26,1,7,68,0.015,NULL,NULL),(27,1,7,71,1.125,NULL,NULL),(28,1,7,71,1.250,NULL,NULL),(29,1,7,70,0.625,NULL,NULL),(30,1,7,74,0.001,NULL,NULL),(31,1,7,77,0.001,NULL,NULL),(32,1,1,58,0.114,NULL,NULL),(33,1,1,63,0.103,NULL,NULL),(34,1,1,66,0.011,NULL,NULL),(35,1,1,69,0.000,NULL,NULL),(36,1,1,75,0.001,NULL,NULL),(37,1,1,71,0.314,NULL,NULL),(38,1,1,71,0.514,NULL,NULL),(39,1,1,72,0.571,NULL,NULL),(40,1,6,58,0.240,NULL,NULL),(41,1,6,61,0.046,NULL,NULL),(42,1,6,66,0.006,NULL,NULL),(43,1,6,71,0.857,NULL,NULL),(44,1,6,71,0.686,NULL,NULL),(45,1,6,70,0.429,NULL,NULL),(46,1,6,75,0.001,NULL,NULL),(47,1,6,34,0.001,NULL,NULL),(48,1,6,37,0.000,NULL,NULL),(49,1,3,58,0.063,NULL,NULL),(50,1,3,63,0.098,NULL,NULL),(51,1,3,60,0.033,NULL,NULL),(52,1,3,65,0.013,NULL,NULL),(53,1,3,66,0.005,NULL,NULL),(54,1,3,71,0.625,NULL,NULL),(55,1,3,71,0.750,NULL,NULL),(56,1,3,70,0.563,NULL,NULL),(57,1,3,75,0.001,NULL,NULL),(58,1,3,35,0.000,NULL,NULL),(59,1,11,58,0.083,NULL,NULL),(60,1,11,63,0.083,NULL,NULL),(61,1,11,66,0.014,NULL,NULL),(62,1,11,69,0.019,NULL,NULL),(63,1,11,61,0.083,NULL,NULL),(64,1,11,71,0.667,NULL,NULL),(65,1,11,71,0.667,NULL,NULL),(66,1,11,71,0.667,NULL,NULL),(67,1,11,76,0.001,NULL,NULL),(73,1,2,71,0.660,NULL,'2017-03-16 18:54:26'),(74,1,2,71,0.813,NULL,NULL),(75,1,2,72,0.500,NULL,NULL),(76,1,2,74,0.001,NULL,NULL),(77,1,2,34,0.001,NULL,NULL),(78,1,8,58,0.213,NULL,NULL),(79,1,8,60,0.073,NULL,NULL),(80,1,8,61,0.033,NULL,NULL),(81,1,8,68,0.007,NULL,NULL),(82,1,8,59,0.003,NULL,NULL),(83,1,8,66,0.007,NULL,NULL),(84,1,8,71,0.600,NULL,NULL),(85,1,8,71,0.833,NULL,NULL),(86,1,8,70,0.667,NULL,NULL),(87,1,8,74,0.001,NULL,NULL),(88,1,8,40,0.000,NULL,NULL),(89,1,8,41,0.000,NULL,NULL),(90,1,12,58,0.229,NULL,NULL),(91,1,12,63,0.057,NULL,NULL),(92,1,12,60,0.026,NULL,NULL),(93,1,12,59,0.006,NULL,NULL),(94,1,12,67,0.003,NULL,NULL),(95,1,12,66,0.003,NULL,NULL),(96,1,12,71,0.714,NULL,NULL),(97,1,12,71,0.714,NULL,NULL),(98,1,12,72,0.571,NULL,NULL),(99,1,12,73,0.001,NULL,NULL),(100,1,12,78,0.002,NULL,NULL);
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
  `woonplaats` int(11) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `group_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Coen','coen.coppoolse@gmail.com',63,'$2y$10$ozYsa2JxbbXo56J5PVDESe/fTh6wrpAMzOSfFSJO2kkkhH5EOEZ02','jK02QdjTiQOUTlTcObaoFA4nvN79u6CQtMtFT3nDuU7cToOhaHhqhdaroZkf','2017-01-28 14:03:35','2017-02-26 10:00:54',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verkooporders`
--

DROP TABLE IF EXISTS `verkooporders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verkooporders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime DEFAULT NULL,
  `klantid` int(11) DEFAULT NULL,
  `biersoortid` int(11) DEFAULT NULL,
  `verpakkingid` int(11) DEFAULT NULL,
  `aantal` int(11) DEFAULT NULL,
  `prijsperstuk` decimal(10,2) DEFAULT NULL,
  `factuurid` int(11) DEFAULT NULL,
  `voldaan` int(11) DEFAULT NULL,
  `afgeleverd` int(11) DEFAULT NULL,
  `geplandeaflevering` date DEFAULT NULL,
  `opmerking` varchar(1000) DEFAULT NULL,
  `datumwerkelijkeaflevering` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verkooporders`
--

LOCK TABLES `verkooporders` WRITE;
/*!40000 ALTER TABLE `verkooporders` DISABLE KEYS */;
INSERT INTO `verkooporders` VALUES (1,'1980-01-01 00:00:00',1,1,1,12,1.20,NULL,NULL,NULL,NULL,NULL,NULL),(2,'2013-06-01 00:00:00',2,2,2,2,1.20,NULL,NULL,NULL,NULL,NULL,NULL),(3,'2013-01-12 00:00:00',2,3,1,120,1.25,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `verkooporders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verpakkingen`
--

DROP TABLE IF EXISTS `verpakkingen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verpakkingen` (
  `id` int(11) NOT NULL,
  `omschrijving` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verpakkingen`
--

LOCK TABLES `verpakkingen` WRITE;
/*!40000 ALTER TABLE `verpakkingen` DISABLE KEYS */;
INSERT INTO `verpakkingen` VALUES (1,'Fles 33 cl'),(2,'Fles 75 cl'),(3,'Fust 20 ltr'),(4,'Fust 30 ltr'),(5,'Fust 50 lltr');
/*!40000 ALTER TABLE `verpakkingen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_verbruik_grondstoffen`
--

DROP TABLE IF EXISTS `vw_verbruik_grondstoffen`;
/*!50001 DROP VIEW IF EXISTS `vw_verbruik_grondstoffen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_verbruik_grondstoffen` AS SELECT 
 1 AS `naam`,
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
 1 AS `hoeveelheidkg`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `woonplaatsen`
--

DROP TABLE IF EXISTS `woonplaatsen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woonplaatsen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plaats` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2458 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `woonplaatsen`
--

LOCK TABLES `woonplaatsen` WRITE;
/*!40000 ALTER TABLE `woonplaatsen` DISABLE KEYS */;
INSERT INTO `woonplaatsen` VALUES (1,'AADORP'),(2,'AAGTEKERKE'),(3,'AALDEN'),(4,'AALSMEER'),(5,'AALSMEERDERBRUG'),(6,'AALST GLD'),(7,'AALTEN'),(8,'AALZUM'),(9,'AARDENBURG'),(10,'AARLANDERVEEN'),(11,'AARLE RIXTEL'),(12,'AARTSWOUD'),(13,'ABBEGA'),(14,'ABBEKERK'),(15,'ABBENBROEK'),(16,'ABBENES'),(17,'ABCOUDE'),(18,'ACHLUM'),(19,'ACHTERVELD'),(20,'ACHTHUIZEN'),(21,'ACHTMAAL'),(22,'ACQUOY'),(23,'ADORP'),(24,'ADUARD'),(25,'AERDENHOUT'),(26,'AERDT'),(27,'AFFERDEN GLD'),(28,'AFFERDEN LB'),(29,'AGELO'),(30,'AKERSLOOT'),(31,'AKKRUM'),(32,'AKMARYP'),(33,'ALBERGEN'),(34,'ALBLASSERDAM'),(35,'ALDEBOARN'),(36,'ALDTSJERK'),(37,'ALEM'),(38,'ALKMAAR'),(39,'ALLINGAWIER'),(40,'ALMELO'),(41,'ALMEN'),(42,'ALMERE'),(43,'ALMKERK'),(44,'ALPHEN AAN DEN RYN'),(45,'ALPHEN GLD'),(46,'ALPHEN NB'),(47,'ALTEVEER DE WOLDEN'),(48,'ALTEVEER GN'),(49,'ALTEVEER HOOGEVEEN'),(50,'ALTEVEER NOORDENV'),(51,'ALTFORST'),(52,'AMBT DELDEN'),(53,'AMEIDE'),(54,'AMEN'),(55,'AMERICA'),(56,'AMERONGEN'),(57,'AMERSFOORT'),(58,'AMMERSTOL'),(59,'AMMERZODEN'),(60,'AMSTELHOEK'),(61,'AMSTELVEEN'),(62,'AMSTENRADE'),(63,'AMSTERDAM'),(64,'AMSTERDAM ZUIDOOST'),(65,'ANDEL'),(66,'ANDELST'),(67,'ANDEREN'),(68,'ANDYK'),(69,'ANE'),(70,'ANERVEEN'),(71,'ANEVELDE'),(72,'ANGEREN'),(73,'ANGERLO'),(74,'ANJUM'),(75,'ANKEVEEN'),(76,'ANLOO'),(77,'ANNA PAULOWNA'),(78,'ANNEN'),(79,'ANNERVEENSCHE KAN'),(80,'ANSEN'),(81,'APELDOORN'),(82,'APLEDOORN'),(83,'APPELSCHA'),(84,'APPELTERN'),(85,'APPINGEDAM'),(86,'ARCEN'),(87,'ARKEL'),(88,'ARNEMUIDEN'),(89,'ARNHEM'),(90,'ARRIEN'),(91,'ARUM'),(92,'ASCH'),(93,'ASPEREN'),(94,'ASSEN'),(95,'ASSENDELFT'),(96,'ASTEN'),(97,'AUGSBUURT'),(98,'AUGUSTINUSGA'),(99,'AUSTERLITZ'),(100,'AVENHORN'),(101,'AXEL'),(102,'AZEWYN'),(103,'BAAIUM'),(104,'BAAK'),(105,'BAAMBRUGGE'),(106,'BAARD'),(107,'BAARLAND'),(108,'BAARLE NASSAU'),(109,'BAARLO LB'),(110,'BAARLO OV'),(111,'BAARN'),(112,'BAARS'),(113,'BABBERICH'),(114,'BABYLONIENBROEK'),(115,'BADHOEVEDORP'),(116,'BAEXEM'),(117,'BAFLO'),(118,'BAKEL'),(119,'BAKHUIZEN'),(120,'BAKKEVEEN'),(121,'BALGOY'),(122,'BALINGE'),(123,'BALK'),(124,'BALKBRUG'),(125,'BALLOERVELD'),(126,'BALLOO'),(127,'BALLUM'),(128,'BANEHEIDE'),(129,'BANHOLT'),(130,'BANT'),(131,'BANTEGA'),(132,'BARCHEM'),(133,'BARENDRECHT'),(134,'BARGER COMPASCUUM'),(135,'BARNEVELD'),(136,'BARSINGERHORN'),(137,'BASSE'),(138,'BATENBURG'),(139,'BATHMEN'),(140,'BAVEL'),(141,'BAVEL AC'),(142,'BEARS FR'),(143,'BEDUM'),(144,'BEEGDEN'),(145,'BEEK EN DONK'),(146,'BEEK GEM BERGH'),(147,'BEEK LB'),(148,'BEEK UBBERGEN'),(149,'BEEKBERGEN'),(150,'BEEMTE BROEKLAND'),(151,'BEERS NB'),(152,'BEERTA'),(153,'BEERZE'),(154,'BEERZERVELD'),(155,'BEESD'),(156,'BEESEL'),(157,'BEETGUM'),(158,'BEETGUMERMOLEN'),(159,'BEETS NH'),(160,'BEETSTERZWAAG'),(161,'BEILEN'),(162,'BEINSDORP'),(163,'BELFELD'),(164,'BELLINGWOLDE'),(165,'BELT SCHUTSLOOT'),(166,'BELTRUM'),(167,'BEMELEN'),(168,'BEMMEL'),(169,'BENEDEN LEEUWEN'),(170,'BENNEBROEK'),(171,'BENNEKOM'),(172,'BENNEVELD'),(173,'BENNINGBROEK'),(174,'BENSCHOP'),(175,'BENTELO'),(176,'BENTHUIZEN'),(177,'BENTVELD'),(178,'BERG EN DAL'),(179,'BERG EN TERBLYT'),(180,'BERGAMBACHT'),(181,'BERGEN AAN ZEE'),(182,'BERGEN LB'),(183,'BERGEN NH'),(184,'BERGEN OP ZOOM'),(185,'BERGENTHEIM'),(186,'BERGEYK'),(187,'BERGHAREN'),(188,'BERGHEM'),(189,'BERGSCHENHOEK'),(190,'BERINGE'),(191,'BERKEL EN RODENRYS'),(192,'BERKEL ENSCHOT'),(193,'BERKENWOUDE'),(194,'BERKHOUT'),(195,'BERLICUM NB'),(196,'BERLIKUM FR'),(197,'BERN'),(198,'BEST'),(199,'BEUGEN'),(200,'BEUNINGEN GLD'),(201,'BEUNINGEN OV'),(202,'BEUSICHEM'),(203,'BEUTENAKEN'),(204,'BEVERWYK'),(205,'BIDDINGHUIZEN'),(206,'BIERUM'),(207,'BIERVLIET'),(208,'BIEST HOUTAKKER'),(209,'BIEZENMORTEL'),(210,'BIGGEKERKE'),(211,'BILTHOVEN'),(212,'BINGELRADE'),(213,'BLADEL'),(214,'BLANKENHAM'),(215,'BLARICUM'),(216,'BLAUWHUIS'),(217,'BLEISWIJK'),(218,'BLEISWYK'),(219,'BLESDYKE'),(220,'BLESKENSGRAAF CA'),(221,'BLESSUM'),(222,'BLITTERSWYCK'),(223,'BLOEMENDAAL'),(224,'BLOKKER'),(225,'BLOKZYL'),(226,'BLYE'),(227,'BLYHAM'),(228,'BOAZUM'),(229,'BOCHOLTZ'),(230,'BODEGRAVEN'),(231,'BOEKEL'),(232,'BOELENSLAAN'),(233,'BOER'),(234,'BOERAKKER'),(235,'BOERAKKER GEM LEEK'),(236,'BOESINGHELIEDE'),(237,'BOKSUM'),(238,'BOLSWARD'),(239,'BONTEBOK'),(240,'BOORNBERGUM'),(241,'BOORNZWAAG'),(242,'BORCULO'),(243,'BORGER'),(244,'BORGERCOMPAGNIE'),(245,'BORGSWEER'),(246,'BORN'),(247,'BORNE'),(248,'BORNERBROEK'),(249,'BORNWIRD'),(250,'BORSSELE'),(251,'BOSCH EN DUIN'),(252,'BOSCHOORD'),(253,'BOSKOOP'),(254,'BOSSCHENHOOFD'),(255,'BOTLEK RT'),(256,'BOURTANGE'),(257,'BOVEN LEEUWEN'),(258,'BOVENKARSPEL'),(259,'BOVENSMILDE'),(260,'BOXMEER'),(261,'BOXTEL'),(262,'BOYL'),(263,'BRAAMT'),(264,'BRAKEL'),(265,'BRANDWYK'),(266,'BRANTGUM'),(267,'BREDA'),(268,'BREDEVOORT'),(269,'BREEDENBROEK'),(270,'BREEZAND'),(271,'BREEZANDDYK'),(272,'BRESKENS'),(273,'BREUGEL'),(274,'BREUKELEN UT'),(275,'BREUKELEVEEN'),(276,'BRIELLE'),(277,'BRILTIL'),(278,'BRITSUM'),(279,'BRITSWERT'),(280,'BROEK FR'),(281,'BROEK IN WATERLAND'),(282,'BROEK OP LANGEDYK'),(283,'BROEKHUIZEN DR'),(284,'BROEKHUIZEN LB'),(285,'BROEKHUIZENVORST'),(286,'BROEKLAND OV'),(287,'BROEKSTERWOUDE'),(288,'BRONKHORST'),(289,'BRONNEGER'),(290,'BRONNEGERVEEN'),(291,'BROUWERSHAVEN'),(292,'BRUCHEM'),(293,'BRUCHT'),(294,'BRUCHTERVELD'),(295,'BRUINEHAAR'),(296,'BRUINISSE'),(297,'BRUMMEN'),(298,'BRUNSSUM'),(299,'BRUNTINGE'),(300,'BUCHTEN'),(301,'BUDEL'),(302,'BUDEL DORPLEIN'),(303,'BUDEL SCHOOT'),(304,'BUGGENUM'),(305,'BUINEN'),(306,'BUINERVEEN'),(307,'BUITENKAAG'),(308,'BUITENPOST'),(309,'BUNDE'),(310,'BUNNE'),(311,'BUNNIK'),(312,'BUNSCHOTEN SPAKENB'),(313,'BURDAARD'),(314,'BUREN FR'),(315,'BUREN GLD'),(316,'BURGERBRUG'),(317,'BURGERVEEN'),(318,'BURGH HAAMSTEDE'),(319,'BURGUM'),(320,'BURGWERD'),(321,'BURUM'),(322,'BUSSUM'),(323,'BUURMALSEN'),(324,'CADIER EN KEER'),(325,'CADZAND'),(326,'CALLANTSOOG'),(327,'CAPELLE AD YSSEL'),(328,'CASTELRE'),(329,'CASTENRAY'),(330,'CASTEREN'),(331,'CASTRICUM'),(332,'CHAAM'),(333,'CLINGE'),(334,'COEVORDEN'),(335,'COLLENDOORN'),(336,'COLMSCHATE'),(337,'COLYNSPLAAT'),(338,'CORNJUM'),(339,'CORNWERD'),(340,'COTHEN'),(341,'CREIL'),(342,'CROMVOIRT'),(343,'CRUQUIUS'),(344,'CULEMBORG'),(345,'CUYK'),(346,'DAARLE'),(347,'DAARLERVEEN'),(348,'DALEM'),(349,'DALEN'),(350,'DALERPEEL'),(351,'DALERVEEN'),(352,'DALFSEN'),(353,'DALMSHOLTE'),(354,'DAMWOUDE'),(355,'DARP'),(356,'DE BILT'),(357,'DE BLESSE'),(358,'DE BULT'),(359,'DE COCKSDORP'),(360,'DE GLIND'),(361,'DE GOORN'),(362,'DE GROEVE'),(363,'DE HEEN'),(364,'DE HEURNE'),(365,'DE HOEF'),(366,'DE HOEVE'),(367,'DE KIEL'),(368,'DE KLOMP'),(369,'DE KNIPE'),(370,'DE KOOG'),(371,'DE KRIM'),(372,'DE KWAKEL'),(373,'DE LIER'),(374,'DE LUTTE'),(375,'DE MEERN'),(376,'DE MOER'),(377,'DE MORTEL'),(378,'DE POL'),(379,'DE PUNT'),(380,'DE RIPS'),(381,'DE RYP'),(382,'DE SCHIPHORST'),(383,'DE STEEG'),(384,'DE TIKE'),(385,'DE VALOM'),(386,'DE VEENHOOP'),(387,'DE WAAL'),(388,'DE WEERE'),(389,'DE WILGEN'),(390,'DE WILP GN'),(391,'DE WOUDE'),(392,'DE WYK'),(393,'DE ZILK'),(394,'DEARSUM'),(395,'DEDEMSVAART'),(396,'DEDGUM'),(397,'DEELEN'),(398,'DEEST'),(399,'DEIL'),(400,'DEINUM'),(401,'DELDEN'),(402,'DELFGAUW'),(403,'DELFSTRAHUIZEN'),(404,'DELFT'),(405,'DELFZYL'),(406,'DELWYNEN'),(407,'DEN ANDEL'),(408,'DEN BOMMEL'),(409,'DEN BURG'),(410,'DEN DOLDER'),(411,'DEN DUNGEN'),(412,'DEN HAAG'),(413,'DEN HAM GN'),(414,'DEN HAM OV'),(415,'DEN HELDER'),(416,'DEN HOORN'),(417,'DEN HOORN TEXEL'),(418,'DEN HOORN ZH'),(419,'DEN HORN'),(420,'DEN HOUT NB'),(421,'DEN ILP'),(422,'DEN OEVER'),(423,'DEN VELDE'),(424,'DENEKAMP'),(425,'DEURNE'),(426,'DEURNINGEN'),(427,'DEURZE'),(428,'DEVENTER'),(429,'DIDAM'),(430,'DIEMEN'),(431,'DIEPENHEIM'),(432,'DIEPENVEEN'),(433,'DIEREN'),(434,'DIESSEN'),(435,'DIEVER'),(436,'DIEVERBRUG'),(437,'DIFFELEN'),(438,'DINTELOORD'),(439,'DINXPERLO'),(440,'DIPHOORN'),(441,'DIRKSHORN'),(442,'DIRKSLAND'),(443,'DODEWAARD'),(444,'DOENRADE'),(445,'DOESBURG'),(446,'DOETINCHEM'),(447,'DOEZUM'),(448,'DOKKUM'),(449,'DOLDERSUM'),(450,'DOMBURG'),(451,'DONDEREN'),(452,'DONGEN'),(453,'DONGJUM'),(454,'DONIAGA'),(455,'DONKERBROEK'),(456,'DOORN'),(457,'DOORNENBURG'),(458,'DOORNSPYK'),(459,'DOORWERTH'),(460,'DORDRECHT'),(461,'DORST'),(462,'DRACHTEN'),(463,'DRACHTSTERCOMPAGN'),(464,'DREISCHOR'),(465,'DREMPT'),(466,'DREUMEL'),(467,'DRIEBERGEN RYSENB'),(468,'DRIEBORG'),(469,'DRIEBRUGGEN'),(470,'DRIEHUIS NH'),(471,'DRIEHUIZEN'),(472,'DRIEL'),(473,'DRIESUM'),(474,'DRIEWEGEN'),(475,'DRIMMELEN'),(476,'DROGEHAM'),(477,'DROGTEROPSLAGEN'),(478,'DRONGELEN'),(479,'DRONRYP'),(480,'DRONTEN'),(481,'DROUWEN'),(482,'DROUWENERMOND'),(483,'DROUWENERVEEN'),(484,'DRUNEN'),(485,'DRUTEN'),(486,'DRYBER'),(487,'DUIVEN'),(488,'DUIVENDRECHT'),(489,'DUIZEL'),(490,'DUSSEN'),(491,'DWINGELOO'),(492,'DYKEN'),(493,'EAGUM'),(494,'EARNEWALD'),(495,'EASTEREIN'),(496,'EASTERLITTENS'),(497,'EASTERMAR'),(498,'EASTERWIERRUM'),(499,'ECHT'),(500,'ECHTELD'),(501,'ECHTEN DR'),(502,'ECHTEN FR'),(503,'ECHTENERBRUG'),(504,'ECK EN WIEL'),(505,'ECKELRADE'),(506,'EDAM'),(507,'EDE GLD'),(508,'EDERVEEN'),(509,'EE'),(510,'EEDE ZLD'),(511,'EEFDE'),(512,'EELDE'),(513,'EELDERWOLDE'),(514,'EEMDYK'),(515,'EEMNES'),(516,'EEMSHAVEN'),(517,'EEN'),(518,'EEN WEST'),(519,'EENRUM'),(520,'EENUM'),(521,'EERBEEK'),(522,'EERSEL'),(523,'EERSTE EXLOERMOND'),(524,'EES'),(525,'EESERGROEN'),(526,'EESERVEEN'),(527,'EESTERGA'),(528,'EESVEEN'),(529,'EETHEN'),(530,'EEXT'),(531,'EEXTERVEEN'),(532,'EEXTERVEENSCHE KAN'),(533,'EEXTERZANDVOORT'),(534,'EGCHEL'),(535,'EGMOND AAN ZEE'),(536,'EGMOND AD HOEF'),(537,'EGMOND BINNEN'),(538,'EIBERGEN'),(539,'EINDHOVEN'),(540,'EINIGHAUSEN'),(541,'EKEHAAR'),(542,'ELAHUIZEN'),(543,'ELBURG'),(544,'ELDERSLOO'),(545,'ELEVELD'),(546,'ELIM'),(547,'ELKENRADE'),(548,'ELL'),(549,'ELLECOM'),(550,'ELLEMEET'),(551,'ELLERTSHAAR'),(552,'ELLEWOUTSDYK'),(553,'ELP'),(554,'ELSENDORP'),(555,'ELSHOUT'),(556,'ELSLOO FR'),(557,'ELSLOO LB'),(558,'ELSPEET'),(559,'ELST GLD'),(560,'ELST UT'),(561,'EMMELOORD'),(562,'EMMEN'),(563,'EMMER COMPASCUUM'),(564,'EMPE'),(565,'EMST'),(566,'ENGELUM'),(567,'ENGWIERUM'),(568,'ENKHUIZEN'),(569,'ENS'),(570,'ENSCHEDE'),(571,'ENSPYK'),(572,'ENTER'),(573,'ENUMATIL'),(574,'EPE'),(575,'EPEN'),(576,'EPPENHUIZEN'),(577,'EPSE'),(578,'ERICA'),(579,'ERICHEM'),(580,'ERLECOM'),(581,'ERM'),(582,'ERMELO'),(583,'ERP'),(584,'ESBEEK'),(585,'ESCH'),(586,'ESCHAREN'),(587,'ESPEL'),(588,'EST'),(589,'ETTEN GLD'),(590,'ETTEN LEUR'),(591,'EUROPOORT RT'),(592,'EURSINGE'),(593,'EURSINGE DE WOLDEN'),(594,'EVERDINGEN'),(595,'EVERTSOORD'),(596,'EWYK'),(597,'EXLOERVEEN'),(598,'EXLOO'),(599,'EXMORRA'),(600,'EYGELSHOVEN'),(601,'EYS'),(602,'EYSDEN'),(603,'EZINGE'),(604,'FARMSUM'),(605,'FEERWERD'),(606,'FERWERT'),(607,'FERWOUDE'),(608,'FINKUM'),(609,'FINSTERWOLDE'),(610,'FIRDGUM'),(611,'FLERINGEN'),(612,'FLUITENBERG'),(613,'FOCHTELOO'),(614,'FOLLEGA'),(615,'FOLSGARE'),(616,'FOUDGUM'),(617,'FOXHOL'),(618,'FOXWOLDE'),(619,'FRANEKER'),(620,'FREDERIKSOORD'),(621,'FRIENS'),(622,'FRIESCHEPALEN'),(623,'FROOMBOSCH'),(624,'FYNAART'),(625,'GAANDEREN'),(626,'GAAST'),(627,'GAASTMEER'),(628,'GALDER'),(629,'GAMEREN'),(630,'GAPINGE'),(631,'GARDEREN'),(632,'GARMERWOLDE'),(633,'GARMINGE'),(634,'GARNWERD'),(635,'GARRELSWEER'),(636,'GARSTHUIZEN'),(637,'GARYP'),(638,'GASSEL'),(639,'GASSELTE'),(640,'GASSELTERNYV MOND'),(641,'GASSELTERNYVEEN'),(642,'GASTEL'),(643,'GASTEREN'),(644,'GAUW'),(645,'GEELBROEK'),(646,'GEERSDYK'),(647,'GEERTRUIDENBERG'),(648,'GEERVLIET'),(649,'GEES'),(650,'GEESBRUG'),(651,'GEESTEREN GLD'),(652,'GEESTEREN OV'),(653,'GEEUWENBRUG'),(654,'GEFFEN'),(655,'GELDERMALSEN'),(656,'GELDERSWOUDE'),(657,'GELDROP'),(658,'GELEEN'),(659,'GELLICUM'),(660,'GELSELAAR'),(661,'GEMERT'),(662,'GEMONDE'),(663,'GENDEREN'),(664,'GENDRINGEN'),(665,'GENDT'),(666,'GENEMUIDEN'),(667,'GENNEP'),(668,'GERKESKLOOSTER'),(669,'GERSLOOT'),(670,'GEULLE'),(671,'GEYSTEREN'),(672,'GIESBEEK'),(673,'GIESSEN'),(674,'GIESSENBURG'),(675,'GIETEN'),(676,'GIETERVEEN'),(677,'GIETHMEN'),(678,'GIETHOORN'),(679,'GILZE'),(680,'GINNUM'),(681,'GLANE'),(682,'GLIMMEN'),(683,'GODLINZE'),(684,'GOEDEREEDE'),(685,'GOENGA'),(686,'GOENGAHUIZEN'),(687,'GOES'),(688,'GOINGARYP'),(689,'GOIRLE'),(690,'GOOR'),(691,'GORINCHEM'),(692,'GORREDYK'),(693,'GORSSEL'),(694,'GOUDA'),(695,'GOUDERAK'),(696,'GOUDRIAAN'),(697,'GOUDSWAARD'),(698,'GOUTUM'),(699,'GRAAUW'),(700,'GRAFHORST'),(701,'GRAFT'),(702,'GRAMSBERGEN'),(703,'GRASHOEK'),(704,'GRATHEM'),(705,'GRAVE'),(706,'GREONTERP'),(707,'GREVENBICHT'),(708,'GRIENDTSVEEN'),(709,'GROEDE'),(710,'GROENEKAN'),(711,'GROENINGEN'),(712,'GROENLO'),(713,'GROESBEEK'),(714,'GROESSEN'),(715,'GROET'),(716,'GROLLOO'),(717,'GRONINGEN'),(718,'GRONSVELD'),(719,'GROOT AMMERS'),(720,'GROOTEBROEK'),(721,'GROOTEGAST'),(722,'GROOTSCHERMER'),(723,'GROU'),(724,'GRUBBENVORST'),(725,'GRYPSKERK'),(726,'GRYPSKERKE'),(727,'GULPEN'),(728,'GUTTECOVEN'),(729,'GYTSJERK'),(730,'H LANDSTICHTING'),(731,'HAAFTEN'),(732,'HAAKSBERGEN'),(733,'HAALDEREN'),(734,'HAAREN'),(735,'HAARLE GEM HELLEND'),(736,'HAARLE GEM TUBBERG'),(737,'HAARLEM'),(738,'HAARLEMMERLIEDE'),(739,'HAARLO'),(740,'HAARSTEEG'),(741,'HAARZUILENS'),(742,'HAASTRECHT'),(743,'HAELEN'),(744,'HAGESTEIN'),(745,'HAGHORST'),(746,'HALER'),(747,'HALFWEG NH'),(748,'HALL'),(749,'HALLE'),(750,'HALLUM'),(751,'HALSTEREN'),(752,'HANDEL'),(753,'HANK'),(754,'HANSWEERT'),(755,'HANTUM'),(756,'HANTUMERUITBUREN'),(757,'HANTUMHUIZEN'),(758,'HAPERT'),(759,'HAPS'),(760,'HARBRINKHOEK'),(761,'HARDENBERG'),(762,'HARDERWYK'),(763,'HARDINXV GIESSEND'),(764,'HAREN GN'),(765,'HAREN NB'),(766,'HARFSEN'),(767,'HARICH'),(768,'HARKEMA'),(769,'HARKSTEDE'),(770,'HARLINGEN'),(771,'HARMELEN'),(772,'HARREVELD'),(773,'HARSKAMP'),(774,'HARTWERD'),(775,'HASKERDYKEN'),(776,'HASKERHORNE'),(777,'HASSELT'),(778,'HATTEM'),(779,'HATTEMERBROEK'),(780,'HAULE'),(781,'HAULERWYK'),(782,'HAUWERT'),(783,'HAVELTE'),(784,'HAVELTERBERG'),(785,'HAZERSWOUDE DORP'),(786,'HAZERSWOUDE RYNDYK'),(787,'HEDEL'),(788,'HEEG'),(789,'HEEL'),(790,'HEELSUM'),(791,'HEELWEG'),(792,'HEEMSERVEEN'),(793,'HEEMSKERK'),(794,'HEEMSTEDE'),(795,'HEENVLIET'),(796,'HEERDE'),(797,'HEERENVEEN'),(798,'HEEREWAARDEN'),(799,'HEERHUGOWAARD'),(800,'HEERJANSDAM'),(801,'HEERLE'),(802,'HEERLEN'),(803,'HEESCH'),(804,'HEESSELT'),(805,'HEESWYK DINTHER'),(806,'HEETEN'),(807,'HEEZE'),(808,'HEGEBEINTUM'),(809,'HEGELSOM'),(810,'HEI EN BOEICOP'),(811,'HEIBLOEM'),(812,'HEIDE'),(813,'HEIKANT'),(814,'HEILIGERLEE'),(815,'HEILOO'),(816,'HEINENOORD'),(817,'HEINKENSZAND'),(818,'HEINO'),(819,'HEKELINGEN'),(820,'HEKENDORP'),(821,'HELDEN'),(822,'HELENAVEEN'),(823,'HELLENDOORN'),(824,'HELLEVOETSLUIS'),(825,'HELLOUW'),(826,'HELLUM'),(827,'HELMOND'),(828,'HELVOIRT'),(829,'HEM'),(830,'HEMELUM'),(831,'HEMMEN'),(832,'HEMPENS'),(833,'HEMRIK'),(834,'HENDR IDO AMBACHT'),(835,'HENGELO GLD'),(836,'HENGELO OV'),(837,'HENGEVELDE'),(838,'HENGSTDYK'),(839,'HENSBROEK'),(840,'HERBAYUM'),(841,'HERKENBOSCH'),(842,'HERKINGEN'),(843,'HERNEN'),(844,'HERPEN'),(845,'HERTEN'),(846,'HERTME'),(847,'HERVELD'),(848,'HERWEN'),(849,'HERWYNEN'),(850,'HETEREN'),(851,'HEUKELOM NB'),(852,'HEUKELUM'),(853,'HEUMEN'),(854,'HEURNE'),(855,'HEUSDEN GEM ASTEN'),(856,'HEUSDEN GEM HEUSD'),(857,'HEYEN'),(858,'HEYENRATH'),(859,'HEYNINGEN'),(860,'HEYTHUYSEN'),(861,'HEZINGEN'),(862,'HIAURE'),(863,'HICHTUM'),(864,'HIDAARD'),(865,'HIERDEN'),(866,'HIESLUM'),(867,'HILAARD'),(868,'HILLEGOM'),(869,'HILVARENBEEK'),(870,'HILVERSUM'),(871,'HINDELOOPEN'),(872,'HINNAARD'),(873,'HIPPOLYTUSHOEF'),(874,'HITZUM'),(875,'HOBREDE'),(876,'HOEDEKENSKERKE'),(877,'HOEK'),(878,'HOEK VAN HOLLAND'),(879,'HOENDERLOO'),(880,'HOENSBROEK'),(881,'HOENZADRIEL'),(882,'HOEVELAKEN'),(883,'HOEVEN'),(884,'HOGE HEXEL'),(885,'HOLLANDSCHE RADING'),(886,'HOLLANDSCHEVELD'),(887,'HOLLUM'),(888,'HOLSLOOT'),(889,'HOLTEN'),(890,'HOLTHEES'),(891,'HOLTHEME'),(892,'HOLTHONE'),(893,'HOLTUM'),(894,'HOLWERD'),(895,'HOLWIERDE'),(896,'HOMMERTS'),(897,'HOMOET'),(898,'HONSELERSDYK'),(899,'HOOFDDORP'),(900,'HOOFDPLAAT'),(901,'HOOG KEPPEL'),(902,'HOOG SOEREN'),(903,'HOOGBLOKLAND'),(904,'HOOGE MIERDE'),(905,'HOOGE ZWALUWE'),(906,'HOOGELOON'),(907,'HOOGENWEG'),(908,'HOOGERHEIDE'),(909,'HOOGERSMILDE'),(910,'HOOGEVEEN'),(911,'HOOGEZAND'),(912,'HOOGHALEN'),(913,'HOOGKARSPEL'),(914,'HOOGLAND'),(915,'HOOGLANDERVEEN'),(916,'HOOGMADE'),(917,'HOOGVLIET RT'),(918,'HOOGWOUD'),(919,'HOORN NH'),(920,'HOORNAAR'),(921,'HOORNSTERZWAAG'),(922,'HORN'),(923,'HORNHUIZEN'),(924,'HORSSEN'),(925,'HORST'),(926,'HOUTEN'),(927,'HOUTIGEHAGE'),(928,'HOUWERZYL'),(929,'HUIS TER HEIDE DR'),(930,'HUIS TER HEIDE UT'),(931,'HUISSEN'),(932,'HUIZEN'),(933,'HUIZINGE'),(934,'HULSBERG'),(935,'HULSEL'),(936,'HULSHORST'),(937,'HULST'),(938,'HULTEN'),(939,'HUMMELO'),(940,'HUNS'),(941,'HUNSEL'),(942,'HURDEGARYP'),(943,'HURWENEN'),(944,'HUYBERGEN'),(945,'HYKEN'),(946,'HYUM'),(947,'IDAERD'),(948,'IDSEGAHUIZUM'),(949,'IDSKENHUIZEN'),(950,'IDZEGA'),(951,'IENS'),(952,'ILPENDAM'),(953,'INDYK'),(954,'INGBER'),(955,'INGEN'),(956,'IT HEIDENSKIP'),(957,'ITENS'),(958,'ITTERVOORT'),(959,'JAARSVELD'),(960,'JABEEK'),(961,'JANNUM'),(962,'JELLUM'),(963,'JELSUM'),(964,'JIRNSUM'),(965,'JISLUM'),(966,'JISP'),(967,'JISTRUM'),(968,'JONKERSLAN'),(969,'JONKERSVAART'),(970,'JOPPE'),(971,'JORWERT'),(972,'JOURE'),(973,'JOUSWIER'),(974,'JUBBEGA'),(975,'JUTRYP'),(976,'KAAG'),(977,'KAATSHEUVEL'),(978,'KALENBERG'),(979,'KALLENKOTE'),(980,'KAMERIK'),(981,'KAMPEN'),(982,'KAMPERLAND'),(983,'KAMPERVEEN'),(984,'KANTENS'),(985,'KAPEL AVEZAATH'),(986,'KAPEL AVEZAATH BUR'),(987,'KAPELLE'),(988,'KAPELLEBRUG'),(989,'KATLYK'),(990,'KATS'),(991,'KATTENDYKE'),(992,'KATWOUDE'),(993,'KATWYK NB'),(994,'KATWYK ZH'),(995,'KEDICHEM'),(996,'KEKERDOM'),(997,'KELPEN OLER'),(998,'KERK AVEZAATH'),(999,'KERK AVEZAATH TIEL'),(1000,'KERKDRIEL'),(1001,'KERKENVELD'),(1002,'KERKRADE'),(1003,'KERKWERVE'),(1004,'KERKWYK'),(1005,'KESSEL LB'),(1006,'KESTEREN'),(1007,'KEYENBORG'),(1008,'KIEL WINDEWEER'),(1009,'KILDER'),(1010,'KIMSWERD'),(1011,'KINDERDYK'),(1012,'KLAASWAAL'),(1013,'KLARENBEEK'),(1014,'KLAZIENAVEEN'),(1015,'KLIMMEN'),(1016,'KLOETINGE'),(1017,'KLOOSTER LIDLUM'),(1018,'KLOOSTERBUREN'),(1019,'KLOOSTERHAAR'),(1020,'KLOOSTERZANDE'),(1021,'KLUNDERT'),(1022,'KLYNDYK'),(1023,'KNEGSEL'),(1024,'KOCKENGEN'),(1025,'KOEDYK'),(1026,'KOEKANGE'),(1027,'KOEWACHT'),(1028,'KOLDERWOLDE'),(1029,'KOLHAM'),(1030,'KOLHORN'),(1031,'KOLLUM'),(1032,'KOLLUMERPOMP'),(1033,'KOLLUMERZWAAG'),(1034,'KOMMERZYL'),(1035,'KONINGSBOSCH'),(1036,'KONINGSLUST'),(1037,'KOOG AAN DE ZAAN'),(1038,'KOOTSTERTILLE'),(1039,'KOOTWYK'),(1040,'KOOTWYKERBROEK'),(1041,'KORNHORN'),(1042,'KORNWERDERZAND'),(1043,'KORTEHEMMEN'),(1044,'KORTENHOEF'),(1045,'KORTGENE'),(1046,'KOUDEKERK AD RYN'),(1047,'KOUDEKERKE'),(1048,'KOUDUM'),(1049,'KOUFURDERRIGE'),(1050,'KRABBENDYKE'),(1051,'KRAGGENBURG'),(1052,'KREILEROORD'),(1053,'KREWERD'),(1054,'KRIMPEN AAN DE LEK'),(1055,'KRIMPEN AD YSSEL'),(1056,'KRING VAN DORTH'),(1057,'KROMMENIE'),(1058,'KRONENBERG'),(1059,'KROPSWOLDE'),(1060,'KRUININGEN'),(1061,'KRUISLAND'),(1062,'KUBAARD'),(1063,'KUDELSTAART'),(1064,'KUINRE'),(1065,'KUITAART'),(1066,'KWADENDAMME'),(1067,'KWADYK'),(1068,'KWINTSHEUL'),(1069,'LAAG KEPPEL'),(1070,'LAAG SOEREN'),(1071,'LAAG ZUTHEM'),(1072,'LAGE MIERDE'),(1073,'LAGE VUURSCHE'),(1074,'LAGE ZWALUWE'),(1075,'LAGELAND'),(1076,'LAMBERTSCHAAG'),(1077,'LAMSWAARDE'),(1078,'LANDGRAAF'),(1079,'LANDHORST'),(1080,'LANDSMEER'),(1081,'LANGBROEK'),(1082,'LANGEDYKE'),(1083,'LANGELILLE'),(1084,'LANGELO DR'),(1085,'LANGENBOOM'),(1086,'LANGERAK ZH'),(1087,'LANGEVEEN'),(1088,'LANGEWEG'),(1089,'LANGEZWAAG'),(1090,'LANGWEER'),(1091,'LAREN GLD'),(1092,'LAREN NH'),(1093,'LATHUM'),(1094,'LATTROP BREKLENK'),(1095,'LAUWERSOOG'),(1096,'LAUWERZYL'),(1097,'LEDEACKER'),(1098,'LEEK'),(1099,'LEENDE'),(1100,'LEENS'),(1101,'LEERBROEK'),(1102,'LEERDAM'),(1103,'LEERMENS'),(1104,'LEERSUM'),(1105,'LEEUWARDEN'),(1106,'LEGEMEER'),(1107,'LEIDEN'),(1108,'LEIDERDORP'),(1109,'LEIDSCHENDAM'),(1110,'LEIMUIDEN'),(1111,'LEIMUIDERBRUG'),(1112,'LEKKERKERK'),(1113,'LEKKUM'),(1114,'LELLENS'),(1115,'LELYSTAD'),(1116,'LEMELE'),(1117,'LEMELERVELD'),(1118,'LEMIERS'),(1119,'LEMMER'),(1120,'LENGEL'),(1121,'LENT'),(1122,'LEONS'),(1123,'LEPELSTRAAT'),(1124,'LETTELBERT'),(1125,'LETTELE'),(1126,'LEUNEN'),(1127,'LEUR'),(1128,'LEUSDEN'),(1129,'LEUTH'),(1130,'LEUTINGEWOLDE'),(1131,'LEUVENHEIM'),(1132,'LEVEROY'),(1133,'LEWEDORP'),(1134,'LEXMOND'),(1135,'LICHTAARD'),(1136,'LICHTENVOORDE'),(1137,'LIEMPDE'),(1138,'LIENDEN'),(1139,'LIERDERHOLTHUIS'),(1140,'LIEREN'),(1141,'LIEROP'),(1142,'LIESHOUT'),(1143,'LIESSEL'),(1144,'LIEVELDE'),(1145,'LIEVEREN'),(1146,'LIMBRICHT'),(1147,'LIMMEN'),(1148,'LINDE DR'),(1149,'LINDEN'),(1150,'LINNE'),(1151,'LINSCHOTEN'),(1152,'LIOESSENS'),(1153,'LIPPENHUIZEN'),(1154,'LISSE'),(1155,'LISSERBROEK'),(1156,'LITH'),(1157,'LITHOYEN'),(1158,'LOBITH'),(1159,'LOCHEM'),(1160,'LOENEN AD VECHT'),(1161,'LOENEN GLD'),(1162,'LOENERSLOOT'),(1163,'LOENGA'),(1164,'LOERBEEK'),(1165,'LOLLUM'),(1166,'LOMM'),(1167,'LONGERHOUW'),(1168,'LOO GLD'),(1169,'LOON'),(1170,'LOON OP ZAND'),(1171,'LOOSBROEK'),(1172,'LOOSDRECHT'),(1173,'LOOZEN'),(1174,'LOPIK'),(1175,'LOPIKERKAPEL'),(1176,'LOPPERSUM'),(1177,'LOSDORP'),(1178,'LOSSER'),(1179,'LOTTUM'),(1180,'LUCASWOLDE'),(1181,'LUCHTH SCHIPHOL'),(1182,'LUDDEWEER'),(1183,'LUINJEBERD'),(1184,'LUNTEREN'),(1185,'LUTJEBROEK'),(1186,'LUTJEGAST'),(1187,'LUTJEWINKEL'),(1188,'LUTTELGEEST'),(1189,'LUTTEN'),(1190,'LUTTENBERG'),(1191,'LUXWOUDE'),(1192,'LUYKSGESTEL'),(1193,'LYNDEN'),(1194,'LYTSEWIERRUM'),(1195,'MAARHEEZE'),(1196,'MAARN'),(1197,'MAARSBERGEN'),(1198,'MAARSSEN'),(1199,'MAARTENSDYK'),(1200,'MAASBOMMEL'),(1201,'MAASBRACHT'),(1202,'MAASBREE'),(1203,'MAASDAM'),(1204,'MAASDYK'),(1205,'MAASHEES'),(1206,'MAASLAND'),(1207,'MAASSLUIS'),(1208,'MAASTRICHT'),(1209,'MAASVLAKTE RT'),(1210,'MACHAREN'),(1211,'MADE'),(1212,'MAKKINGA'),(1213,'MAKKUM FR'),(1214,'MALDEN'),(1215,'MANDER'),(1216,'MANDERVEEN'),(1217,'MANTGUM'),(1218,'MANTINGE'),(1219,'MAREN KESSEL'),(1220,'MARGRATEN'),(1221,'MARIA HOOP'),(1222,'MARIAHOUT'),(1223,'MARIAPAROCHIE'),(1224,'MARIENBERG'),(1225,'MARIENHEEM'),(1226,'MARIENVELDE'),(1227,'MARKELO'),(1228,'MARKEN'),(1229,'MARKENBINNEN'),(1230,'MARKNESSE'),(1231,'MARLE'),(1232,'MARRUM'),(1233,'MARSSUM'),(1234,'MARUM'),(1235,'MARWYKSOORD'),(1236,'MARYENKAMPEN'),(1237,'MASTENBROEK'),(1238,'MATSLOOT'),(1239,'MAURIK'),(1240,'MECHELEN'),(1241,'MEDEMBLIK'),(1242,'MEEDEN'),(1243,'MEEDHUIZEN'),(1244,'MEERKERK'),(1245,'MEERLO'),(1246,'MEERSSEN'),(1247,'MEEUWEN'),(1248,'MEGCHELEN'),(1249,'MEGEN'),(1250,'MELDERSLO'),(1251,'MELICK'),(1252,'MELISKERKE'),(1253,'MELISSANT'),(1254,'MENALDUM'),(1255,'MENSINGEWEER'),(1256,'MEPPEL'),(1257,'MEPPEN'),(1258,'MERKELBEEK'),(1259,'MERSELO'),(1260,'METEREN'),(1261,'METERIK'),(1262,'METSLAWIER'),(1263,'MEYEL'),(1264,'MHEER'),(1265,'MIDDELAAR'),(1266,'MIDDELBURG'),(1267,'MIDDELHARNIS'),(1268,'MIDDELIE'),(1269,'MIDDELSTUM'),(1270,'MIDDENBEEMSTER'),(1271,'MIDDENMEER'),(1272,'MIDLAREN'),(1273,'MIDLUM'),(1274,'MIDWOLDA'),(1275,'MIDWOLDE'),(1276,'MIDWOUD'),(1277,'MIEDUM'),(1278,'MIERLO'),(1279,'MILDAM'),(1280,'MILHEEZE'),(1281,'MILL'),(1282,'MILLINGEN AD RYN'),(1283,'MILSBEEK'),(1284,'MINNERTSGA'),(1285,'MIRNS'),(1286,'MODDERGAT'),(1287,'MOERDYK'),(1288,'MOERGESTEL'),(1289,'MOERKAPELLE'),(1290,'MOERSTRATEN'),(1291,'MOLENAARSGRAAF'),(1292,'MOLENHOEK LB'),(1293,'MOLENSCHOT'),(1294,'MOLKWERUM'),(1295,'MONNICKENDAM'),(1296,'MONSTER'),(1297,'MONTFOORT'),(1298,'MONTFORT'),(1299,'MOOK'),(1300,'MOOKHOEK'),(1301,'MOORDRECHT'),(1302,'MOORVELD'),(1303,'MORRA'),(1304,'MUIDEN'),(1305,'MUIDERBERG'),(1306,'MUNEIN'),(1307,'MUNNEKEBUREN'),(1308,'MUNNEKEZYL'),(1309,'MUNSTERGELEEN'),(1310,'MUNTENDAM'),(1311,'MUSSEL'),(1312,'MUSSELKANAAL'),(1313,'MYDRECHT'),(1314,'MYNSHEERENLAND'),(1315,'NAALDWYK'),(1316,'NAARDEN'),(1317,'NAGELE'),(1318,'NEDERASSELT'),(1319,'NEDERHEMERT'),(1320,'NEDERHORST D BERG'),(1321,'NEDERLAND'),(1322,'NEDERWEERT'),(1323,'NEDERWEERT EIND'),(1324,'NEEDE'),(1325,'NEER'),(1326,'NEERITTER'),(1327,'NEERKANT'),(1328,'NEERYNEN'),(1329,'NES AMELAND'),(1330,'NES GEM BOARNSTER'),(1331,'NES GEM DONGER'),(1332,'NETERSEL'),(1333,'NETTERDEN'),(1334,'NIAWIER'),(1335,'NIBBIXWOUD'),(1336,'NIEBERT'),(1337,'NIEHOVE'),(1338,'NIEKERK DE MARNE'),(1339,'NIEKERK GROOTEGAST'),(1340,'NIETAP'),(1341,'NIEUW AMSTERDAM'),(1342,'NIEUW ANNERVEEN'),(1343,'NIEUW BALINGE'),(1344,'NIEUW BEERTA'),(1345,'NIEUW BEYERLAND'),(1346,'NIEUW BUINEN'),(1347,'NIEUW DORDRECHT'),(1348,'NIEUW EN ST JOOSL'),(1349,'NIEUW HEETEN'),(1350,'NIEUW LEKKERLAND'),(1351,'NIEUW NAMEN'),(1352,'NIEUW RODEN'),(1353,'NIEUW SCHEEMDA'),(1354,'NIEUW SCHOONEBEEK'),(1355,'NIEUW VENNEP'),(1356,'NIEUW VOSSEMEER'),(1357,'NIEUW WEERDINGE'),(1358,'NIEUWAAL'),(1359,'NIEUWDORP ZLD'),(1360,'NIEUWE NIEDORP'),(1361,'NIEUWE PEKELA'),(1362,'NIEUWE TONGE'),(1363,'NIEUWE WETERING'),(1364,'NIEUWEBRUG'),(1365,'NIEUWEDIEP'),(1366,'NIEUWEGEIN'),(1367,'NIEUWEHORNE'),(1368,'NIEUWENDYK NB'),(1369,'NIEUWER TER AA'),(1370,'NIEUWERBRUG'),(1371,'NIEUWERKERK'),(1372,'NIEUWERKERK YSSEL'),(1373,'NIEUWEROORD'),(1374,'NIEUWERSLUIS'),(1375,'NIEUWESCHANS'),(1376,'NIEUWESCHOOT'),(1377,'NIEUWKOOP'),(1378,'NIEUWKUYK'),(1379,'NIEUWLAND'),(1380,'NIEUWLANDE'),(1381,'NIEUWLANDE COEVORD'),(1382,'NIEUWLEUSEN'),(1383,'NIEUWOLDA'),(1384,'NIEUWPOORT'),(1385,'NIEUWSTADT'),(1386,'NIEUWVEEN'),(1387,'NIEUWVLIET'),(1388,'NIEZYL'),(1389,'NIFTRIK'),(1390,'NIGTEVECHT'),(1391,'NIJKERK'),(1392,'NISPEN'),(1393,'NISSE'),(1394,'NISTELRODE'),(1395,'NOARDBURGUM'),(1396,'NOOITGEDACHT'),(1397,'NOORBEEK'),(1398,'NOORD SCHARWOUDE'),(1399,'NOORD SLEEN'),(1400,'NOORDBEEMSTER'),(1401,'NOORDBROEK'),(1402,'NOORDEINDE GLD'),(1403,'NOORDEINDE NH'),(1404,'NOORDELOOS'),(1405,'NOORDEN'),(1406,'NOORDGOUWE'),(1407,'NOORDHORN'),(1408,'NOORDLAREN'),(1409,'NOORDSCHESCHUT'),(1410,'NOORDWELLE'),(1411,'NOORDWOLDE FR'),(1412,'NOORDWOLDE GN'),(1413,'NOORDWYK GN'),(1414,'NOORDWYK ZH'),(1415,'NOORDWYKERHOUT'),(1416,'NOOTDORP'),(1417,'NORG'),(1418,'NOTTER'),(1419,'NUENEN'),(1420,'NUIS'),(1421,'NULAND'),(1422,'NUMANSDORP'),(1423,'NUNHEM'),(1424,'NUNSPEET'),(1425,'NUTH'),(1426,'NUTTER'),(1427,'NY BEETS'),(1428,'NYBROEK'),(1429,'NYEBERKOOP'),(1430,'NYEGA'),(1431,'NYEHASKE'),(1432,'NYEHOLTPADE'),(1433,'NYEHOLTWOLDE'),(1434,'NYELAMER'),(1435,'NYEMIRDUM'),(1436,'NYENSLEEK'),(1437,'NYETRYNE'),(1438,'NYEVEEN'),(1439,'NYHUIZUM'),(1440,'NYKERK GLD'),(1441,'NYKERKERVEEN'),(1442,'NYLAND'),(1443,'NYLANDE'),(1444,'NYMEGEN'),(1445,'NYVERDAL'),(1446,'OBBICHT'),(1447,'OBDAM'),(1448,'OCHTEN'),(1449,'ODILIAPEEL'),(1450,'ODOORN'),(1451,'ODOORNERVEEN'),(1452,'ODYK'),(1453,'OEFFELT'),(1454,'OEGSTGEEST'),(1455,'OENE'),(1456,'OENTSJERK'),(1457,'OFFINGAWIER'),(1458,'OHE EN LAAK'),(1459,'OIRLO'),(1460,'OIRSBEEK'),(1461,'OIRSCHOT'),(1462,'OISTERWYK'),(1463,'OKKENBROEK'),(1464,'OLBURGEN'),(1465,'OLDEBERKOOP'),(1466,'OLDEBROEK'),(1467,'OLDEHOLTPADE'),(1468,'OLDEHOLTWOLDE'),(1469,'OLDEHOVE'),(1470,'OLDEKERK'),(1471,'OLDELAMER'),(1472,'OLDEMARKT'),(1473,'OLDENZAAL'),(1474,'OLDENZYL'),(1475,'OLDEOUWER'),(1476,'OLDETRYNE'),(1477,'OLST'),(1478,'OLTERTERP'),(1479,'OMMEL'),(1480,'OMMEN'),(1481,'OMMEREN'),(1482,'ONDERDENDAM'),(1483,'ONNA'),(1484,'ONNEN'),(1485,'ONSTWEDDE'),(1486,'OOLTGENSPLAAT'),(1487,'OOST GRAFTDYK'),(1488,'OOST SOUBURG'),(1489,'OOST W MIDDELBEERS'),(1490,'OOSTBURG'),(1491,'OOSTDYK'),(1492,'OOSTEIND'),(1493,'OOSTERBEEK'),(1494,'OOSTERBIERUM'),(1495,'OOSTERBLOKKER'),(1496,'OOSTEREND NH'),(1497,'OOSTERHESSELEN'),(1498,'OOSTERHOUT GLD'),(1499,'OOSTERHOUT NB'),(1500,'OOSTERHOUT NYMEGEN'),(1501,'OOSTERLAND'),(1502,'OOSTERLEEK'),(1503,'OOSTERNIELAND'),(1504,'OOSTERNYKERK'),(1505,'OOSTERSTREEK'),(1506,'OOSTERWOLDE FR'),(1507,'OOSTERWOLDE GLD'),(1508,'OOSTERWYK'),(1509,'OOSTERWYTWERD'),(1510,'OOSTERZEE'),(1511,'OOSTHEM'),(1512,'OOSTHUIZEN'),(1513,'OOSTKAPELLE'),(1514,'OOSTKNOLLENDAM'),(1515,'OOSTRUM FR'),(1516,'OOSTRUM LB'),(1517,'OOSTVOORNE'),(1518,'OOSTWOLD GEM LEEK'),(1519,'OOSTWOLD SCHEEMDA'),(1520,'OOSTWOUD'),(1521,'OOSTZAAN'),(1522,'OOTMARSUM'),(1523,'OOY'),(1524,'OPEINDE'),(1525,'OPENDE'),(1526,'OPHEMERT'),(1527,'OPHEUSDEN'),(1528,'OPLOO'),(1529,'OPMEER'),(1530,'OPPENHUIZEN'),(1531,'OPPERDOES'),(1532,'OPYNEN'),(1533,'ORANJE'),(1534,'ORANJEWOUD'),(1535,'ORVELTE'),(1536,'OSPEL'),(1537,'OSS'),(1538,'OSSENDRECHT'),(1539,'OSSENISSE'),(1540,'OSSENWAARD ZH'),(1541,'OSSENZYL'),(1542,'OTERLEEK'),(1543,'OTTERLO'),(1544,'OTTERSUM'),(1545,'OTTOLAND'),(1546,'OUD ADE'),(1547,'OUD ALBLAS'),(1548,'OUD ANNERVEEN'),(1549,'OUD BEYERLAND'),(1550,'OUD GASTEL'),(1551,'OUD OOTMARSUM'),(1552,'OUD VOSSEMEER'),(1553,'OUD ZUILEN'),(1554,'OUDDORP ZH'),(1555,'OUDE BILDTZYL'),(1556,'OUDE LEYE'),(1557,'OUDE MEER'),(1558,'OUDE NIEDORP'),(1559,'OUDE PEKELA'),(1560,'OUDE TONGE'),(1561,'OUDE WETERING'),(1562,'OUDE WILLEM'),(1563,'OUDEGA GAAST SLEAT'),(1564,'OUDEGA GEM SMALL'),(1565,'OUDEGA GEM WYMB'),(1566,'OUDEHASKE'),(1567,'OUDEHORNE'),(1568,'OUDELANDE'),(1569,'OUDEMIRDUM'),(1570,'OUDEMOLEN DR'),(1571,'OUDEMOLEN NB'),(1572,'OUDENBOSCH'),(1573,'OUDENDYK NH'),(1574,'OUDENHOORN'),(1575,'OUDERKERK AD YSSEL'),(1576,'OUDERKERK AMSTEL'),(1577,'OUDESCHANS'),(1578,'OUDESCHILD'),(1579,'OUDESCHIP'),(1580,'OUDESCHOOT'),(1581,'OUDESLUIS'),(1582,'OUDEWATER'),(1583,'OUDEZYL'),(1584,'OUDKARSPEL'),(1585,'OUDORP NH'),(1586,'OUDWOUDE'),(1587,'OUWERKERK'),(1588,'OUWSTER NYEGA'),(1589,'OUWSTERHAULE'),(1590,'OVERASSELT'),(1591,'OVERBERG'),(1592,'OVERDINKEL'),(1593,'OVERLOON'),(1594,'OVERSCHILD'),(1595,'OVERSLAG'),(1596,'OVERVEEN'),(1597,'OVEZANDE'),(1598,'OYEN'),(1599,'PAASLOO'),(1600,'PAESENS'),(1601,'PANNERDEN'),(1602,'PANNINGEN'),(1603,'PAPEKOP'),(1604,'PAPENDRECHT'),(1605,'PAPENHOVEN'),(1606,'PAPENVOORT'),(1607,'PARREGA'),(1608,'PATERSWOLDE'),(1609,'PEEST'),(1610,'PEINS'),(1611,'PEIZE'),(1612,'PEPERGA'),(1613,'PERNIS RT'),(1614,'PERSINGEN'),(1615,'PESSE'),(1616,'PETTEN'),(1617,'PHILIPPINE'),(1618,'PIAAM'),(1619,'PIERSHIL'),(1620,'PIETERBUREN'),(1621,'PIETERSBIERUM'),(1622,'PIETERZYL'),(1623,'PINGJUM'),(1624,'PLASMOLEN'),(1625,'POEDEROYEN'),(1626,'POELDYK'),(1627,'POLSBROEK'),(1628,'POORTUGAAL'),(1629,'POORTVLIET'),(1630,'POPPENWIER'),(1631,'POSTERHOLT'),(1632,'PRINSENBEEK'),(1633,'PUIFLYK'),(1634,'PUNTHORST'),(1635,'PURMER'),(1636,'PURMEREND'),(1637,'PURMERLAND'),(1638,'PUTH'),(1639,'PUTTE'),(1640,'PUTTEN'),(1641,'PUTTERSHOEK'),(1642,'PYNACKER'),(1643,'RAALTE'),(1644,'RAAMSDONK'),(1645,'RAAMSDONKSVEER'),(1646,'RAARD'),(1647,'RADEWYK'),(1648,'RAERD'),(1649,'RANDWYK'),(1650,'RANSDAAL'),(1651,'RASQUERT'),(1652,'RAVENSTEIN'),(1653,'RAVENSWAAY'),(1654,'RAVENSWOUD'),(1655,'REAHUS'),(1656,'REDUZUM'),(1657,'REEK'),(1658,'REEUWYK'),(1659,'REITSUM'),(1660,'REKKEN'),(1661,'RENESSE'),(1662,'RENKUM'),(1663,'RENSWOUDE'),(1664,'RESSEN'),(1665,'RESSEN GEM NYMEGEN'),(1666,'RETRANCHEMENT'),(1667,'REUSEL'),(1668,'REUTUM'),(1669,'REUVER'),(1670,'REYMERSTOK'),(1671,'RHA'),(1672,'RHEDEN'),(1673,'RHEE'),(1674,'RHEEZE'),(1675,'RHEEZERVEEN'),(1676,'RHENEN'),(1677,'RHENOY'),(1678,'RHOON'),(1679,'RIDDERKERK'),(1680,'RIED'),(1681,'RIEL'),(1682,'RIEN'),(1683,'RIETHOVEN'),(1684,'RIETMOLEN'),(1685,'RILLAND'),(1686,'RINSUMAGEEST'),(1687,'RITTHEM'),(1688,'ROCKANJE'),(1689,'RODEN'),(1690,'RODERESCH'),(1691,'RODERWOLDE'),(1692,'ROELOFARENDSVEEN'),(1693,'ROERMOND'),(1694,'ROGAT'),(1695,'ROGGEL'),(1696,'ROHEL'),(1697,'ROLDE'),(1698,'ROODESCHOOL'),(1699,'ROODKERK'),(1700,'ROOSENDAAL'),(1701,'ROOSTEREN'),(1702,'ROSMALEN'),(1703,'ROSSUM GLD'),(1704,'ROSSUM OV'),(1705,'ROSWINKEL'),(1706,'ROTSTERGAAST'),(1707,'ROTSTERHAULE'),(1708,'ROTTERDAM'),(1709,'ROTTERDAM ALBRANDS'),(1710,'ROTTEVALLE'),(1711,'ROTTUM FR'),(1712,'ROTTUM GN'),(1713,'ROUVEEN'),(1714,'ROZENBURG NH'),(1715,'ROZENBURG ZH'),(1716,'ROZENDAAL'),(1717,'RUCPHEN'),(1718,'RUIGAHUIZEN'),(1719,'RUINEN'),(1720,'RUINERWOLD'),(1721,'RUMPT'),(1722,'RUTTEN'),(1723,'RUURLO'),(1724,'RYEN'),(1725,'RYKEVOORT'),(1726,'RYKEVOORT WALSERT'),(1727,'RYNSATERWOUDE'),(1728,'RYNSBURG'),(1729,'RYPTSJERK'),(1730,'RYPWETERING'),(1731,'RYS'),(1732,'RYSBERGEN'),(1733,'RYSENHOUT'),(1734,'RYSSEN'),(1735,'RYSWYK GLD'),(1736,'RYSWYK NB'),(1737,'RYSWYK ZH'),(1738,'S GRAVELAND'),(1739,'S GRAVENDEEL'),(1740,'S GRAVENHAGE'),(1741,'S GRAVENMOER'),(1742,'S GRAVENPOLDER'),(1743,'S GRAVENZANDE'),(1744,'S HEER ABTSKERKE'),(1745,'S HEER ARENDSKERKE'),(1746,'S HEERENBERG'),(1747,'S HEERENBROEK'),(1748,'S HEERENHOEK'),(1749,'S HERTOGENBOSCH'),(1750,'S HR HENDR KINDER'),(1751,'SAAKSUM'),(1752,'SAASVELD'),(1753,'SAAXUMHUIZEN'),(1754,'SAMBEEK'),(1755,'SANDFIRDEN'),(1756,'SANTPOORT NOORD'),(1757,'SANTPOORT ZUID'),(1758,'SANTPOORT-NOORD'),(1759,'SANTPOORT-ZUID'),(1760,'SAPPEMEER'),(1761,'SAS VAN GENT'),(1762,'SASSENHEIM'),(1763,'SAUWERD'),(1764,'SCHAGEN'),(1765,'SCHAGERBRUG'),(1766,'SCHALKHAAR'),(1767,'SCHALKWYK'),(1768,'SCHALSUM'),(1769,'SCHARDAM'),(1770,'SCHARENDYKE'),(1771,'SCHARMER'),(1772,'SCHARNEGOUTUM'),(1773,'SCHARSTERBRUG'),(1774,'SCHARWOUDE'),(1775,'SCHAYK'),(1776,'SCHEEMDA'),(1777,'SCHEERWOLDE'),(1778,'SCHELLINKHOUT'),(1779,'SCHELLUINEN'),(1780,'SCHERMERHORN'),(1781,'SCHERPENISSE'),(1782,'SCHERPENZEEL FR'),(1783,'SCHERPENZEEL GLD'),(1784,'SCHETTENS'),(1785,'SCHEULDER'),(1786,'SCHIEDAM'),(1787,'SCHIERMONNIKOOG'),(1788,'SCHILDWOLDE'),(1789,'SCHIMMERT'),(1790,'SCHIN OP GEUL'),(1791,'SCHINGEN'),(1792,'SCHINNEN'),(1793,'SCHINVELD'),(1794,'SCHIPBORG'),(1795,'SCHIPHOL'),(1796,'SCHIPHOL RYK'),(1797,'SCHIPLUIDEN'),(1798,'SCHOONDYKE'),(1799,'SCHOONEBEEK'),(1800,'SCHOONHOVEN'),(1801,'SCHOONLOO'),(1802,'SCHOONOORD'),(1803,'SCHOONREWOERD'),(1804,'SCHOORL'),(1805,'SCHORE'),(1806,'SCHOUWERZYL'),(1807,'SCHRAARD'),(1808,'SCHUINESLOOT'),(1809,'SCHYF'),(1810,'SCHYNDEL'),(1811,'SEBALDEBUREN'),(1812,'SELLINGEN'),(1813,'SEROOSKERKE SCHOUW'),(1814,'SEROOSKERKE WALCH'),(1815,'SEVENUM'),(1816,'SEXBIERUM'),(1817,'SIBCULO'),(1818,'SIBRANDABUORREN'),(1819,'SIDDEBUREN'),(1820,'SIEBENGEWALD'),(1821,'SIEGERSWOUDE'),(1822,'SILVOLDE'),(1823,'SIMONSHAVEN'),(1824,'SIMPELVELD'),(1825,'SINDEREN'),(1826,'SINDEREN GEM GENDR'),(1827,'SINTJOHANNESGA'),(1828,'SIRJANSLAND'),(1829,'SITTARD'),(1830,'SLAGHAREN'),(1831,'SLAPPETERP'),(1832,'SLEEN'),(1833,'SLEEUWYK'),(1834,'SLENAKEN'),(1835,'SLIEDRECHT'),(1836,'SLOCHTEREN'),(1837,'SLOOTDORP'),(1838,'SLOTEN FR'),(1839,'SLUIS'),(1840,'SLUISKIL'),(1841,'SLYK EWYK'),(1842,'SLYKENBURG'),(1843,'SMAKT'),(1844,'SMALLE EE'),(1845,'SMALLEBRUGGE'),(1846,'SMILDE'),(1847,'SNAKKERBUREN'),(1848,'SNEEK'),(1849,'SNELREWAARD'),(1850,'SNIKZWAAG'),(1851,'SOERENDONK'),(1852,'SOEST'),(1853,'SOESTERBERG'),(1854,'SOMEREN'),(1855,'SOMMELSDYK'),(1856,'SON'),(1857,'SONDEL'),(1858,'SONNEGA'),(1859,'SPAARNDAM'),(1860,'SPAARNDAM WEST'),(1861,'SPANBROEK'),(1862,'SPANGA'),(1863,'SPANKEREN'),(1864,'SPANNUM'),(1865,'SPAUBEEK'),(1866,'SPIER'),(1867,'SPIERDYK'),(1868,'SPRANG CAPELLE'),(1869,'SPRUNDEL'),(1870,'SPUI'),(1871,'SPYK GEM LINGEWAAL'),(1872,'SPYK GLD'),(1873,'SPYK GN'),(1874,'SPYKENISSE'),(1875,'SPYKERBOOR DR'),(1876,'SPYKERBOOR NH'),(1877,'ST AGATHA'),(1878,'ST ANNALAND'),(1879,'ST ANNAPAROCHIE'),(1880,'ST ANNEN'),(1881,'ST ANTHONIS'),(1882,'ST GEERTRUID'),(1883,'ST HUBERT'),(1884,'ST JACOBIPAROCHIE'),(1885,'ST JANSKLOOSTER'),(1886,'ST JANSTEEN'),(1887,'ST JOOST'),(1888,'ST KRUIS'),(1889,'ST MAARTEN'),(1890,'ST MAARTENSBRUG'),(1891,'ST MAARTENSDYK'),(1892,'ST MAARTENSVLOTBR'),(1893,'ST MICHIELSGESTEL'),(1894,'ST NICOLAASGA'),(1895,'ST ODILIENBERG'),(1896,'ST OEDENRODE'),(1897,'ST PANCRAS'),(1898,'ST PHILIPSLAND'),(1899,'ST WILLEBRORD'),(1900,'STAD AH HARINGVL'),(1901,'STADSKANAAL'),(1902,'STAMPERSGAT'),(1903,'STANDDAARBUITEN'),(1904,'STAPHORST'),(1905,'STARNMEER'),(1906,'STARTENHUIZEN'),(1907,'STARTENHUIZEN LOPP'),(1908,'STAVENISSE'),(1909,'STAVOREN'),(1910,'STEDUM'),(1911,'STEENBERGEN DR'),(1912,'STEENBERGEN NB'),(1913,'STEENDAM'),(1914,'STEENDEREN'),(1915,'STEENENKAMER'),(1916,'STEENSEL'),(1917,'STEENWYK'),(1918,'STEENWYKERWOLD'),(1919,'STEGEREN'),(1920,'STEGGERDA'),(1921,'STEIN LB'),(1922,'STELLENDAM'),(1923,'STERKSEL'),(1924,'STEVENSBEEK'),(1925,'STEVENSWEERT'),(1926,'STEYL'),(1927,'STIELTJESKANAAL'),(1928,'STIENS'),(1929,'STITSWERD'),(1930,'STOKKUM'),(1931,'STOLWYK'),(1932,'STOMPETOREN'),(1933,'STOUTENBURG'),(1934,'STOUTENBURG NOORD'),(1935,'STRAMPROY'),(1936,'STREEFKERK'),(1937,'STROE'),(1938,'STROOBOS'),(1939,'STRYBEEK'),(1940,'STRYEN'),(1941,'STRYENSAS'),(1942,'STUIFZAND'),(1943,'SUMAR'),(1944,'SURHUISTERVEEN'),(1945,'SURHUIZUM'),(1946,'SUSTEREN'),(1947,'SUWALD'),(1948,'SWALMEN'),(1949,'SWEIKHUIZEN'),(1950,'SWICHUM'),(1951,'SWIFTERBANT'),(1952,'SWOLGEN'),(1953,'SYBEKARSPEL'),(1954,'SYBRANDAHUIS'),(1955,'T GOY'),(1956,'T HAANTJE'),(1957,'T HARDE'),(1958,'T LOO OLDEBROEK'),(1959,'T VELD'),(1960,'T WAAR'),(1961,'T ZAND NH'),(1962,'T ZANDT GN'),(1963,'TAARLO'),(1964,'TEEFFELEN'),(1965,'TEERNS'),(1966,'TEGELEN'),(1967,'TEN BOER'),(1968,'TEN POST'),(1969,'TER AAR'),(1970,'TER AARD'),(1971,'TER APEL'),(1972,'TER APELKANAAL'),(1973,'TER HEYDE'),(1974,'TER IDZARD'),(1975,'TERBAND'),(1976,'TERBORG'),(1977,'TERHERNE'),(1978,'TERHEYDEN'),(1979,'TERHOLE'),(1980,'TERKAPLE'),(1981,'TERMUNTEN'),(1982,'TERMUNTERZYL'),(1983,'TERNAARD'),(1984,'TERNEUZEN'),(1985,'TEROELE'),(1986,'TERSCHELLING BAAID'),(1987,'TERSCHELLING FORMR'),(1988,'TERSCHELLING HEE'),(1989,'TERSCHELLING HOORN'),(1990,'TERSCHELLING KAART'),(1991,'TERSCHELLING KINUM'),(1992,'TERSCHELLING LANDR'),(1993,'TERSCHELLING LIES'),(1994,'TERSCHELLING MIDLD'),(1995,'TERSCHELLING O END'),(1996,'TERSCHELLING SERYP'),(1997,'TERSCHELLING WEST'),(1998,'TERSCHUUR'),(1999,'TERSOAL'),(2000,'TERWISPEL'),(2001,'TERWOLDE'),(2002,'TETERINGEN'),(2003,'TEUGE'),(2004,'THESINGE'),(2005,'THOLEN'),(2006,'THORN'),(2007,'TIEL'),(2008,'TIENDEVEEN'),(2009,'TIENHOVEN UT'),(2010,'TIENHOVEN ZH'),(2011,'TIENRAY'),(2012,'TILBURG'),(2013,'TILLIGTE'),(2014,'TINALLINGE'),(2015,'TINTE'),(2016,'TIRNS'),(2017,'TJALHUIZUM'),(2018,'TJALLEBERD'),(2019,'TJERKGAAST'),(2020,'TJERKWERD'),(2021,'TJUCHEM'),(2022,'TOLBERT'),(2023,'TOLDYK'),(2024,'TOLKAMER'),(2025,'TOLLEBEEK'),(2026,'TONDEN'),(2027,'TOORNWERD'),(2028,'TRICHT'),(2029,'TRIEMEN'),(2030,'TRIPSCOMPAGNIE'),(2031,'TUBBERGEN'),(2032,'TUIL'),(2033,'TUITJENHORN'),(2034,'TUK'),(2035,'TULL EN T WAAL'),(2036,'TWEEDE EXLOERMOND'),(2037,'TWEEDE VALTHERMOND'),(2038,'TWELLO'),(2039,'TWISK'),(2040,'TWYZEL'),(2041,'TWYZELERHEIDE'),(2042,'TYNAARLO'),(2043,'TYNJE'),(2044,'TYTSJERK'),(2045,'TZUM'),(2046,'TZUMMARUM'),(2047,'UBBENA'),(2048,'UBBERGEN'),(2049,'UDDEL'),(2050,'UDEN'),(2051,'UDENHOUT'),(2052,'UFFELTE'),(2053,'UGCHELEN'),(2054,'UITDAM'),(2055,'UITGEEST'),(2056,'UITHOORN'),(2057,'UITHUIZEN'),(2058,'UITHUIZERMEEDEN'),(2059,'UITWELLINGERGA'),(2060,'UITWYK'),(2061,'ULESTRATEN'),(2062,'ULFT'),(2063,'ULICOTEN'),(2064,'ULRUM'),(2065,'ULVENHOUT'),(2066,'ULVENHOUT AC'),(2067,'URETERP'),(2068,'URK'),(2069,'URMOND'),(2070,'URSEM'),(2071,'URSEM GEM SCHERMER'),(2072,'USQUERT'),(2073,'UTRECHT'),(2074,'VAALS'),(2075,'VAASSEN'),(2076,'VALBURG'),(2077,'VALKENBURG LB'),(2078,'VALKENBURG ZH'),(2079,'VALKENSWAARD'),(2080,'VALTHE'),(2081,'VALTHERMOND'),(2082,'VARIK'),(2083,'VARSSELDER VELDH'),(2084,'VARSSEVELD'),(2085,'VASSE'),(2086,'VEELERVEEN'),(2087,'VEEN'),(2088,'VEENDAM'),(2089,'VEENENDAAL'),(2090,'VEENHUIZEN'),(2091,'VEENINGEN'),(2092,'VEENKLOOSTER'),(2093,'VEENOORD'),(2094,'VEENWOUDEN'),(2095,'VEERE'),(2096,'VEESSEN'),(2097,'VEGELINSOORD'),(2098,'VEGHEL'),(2099,'VELDDRIEL'),(2100,'VELDEN'),(2101,'VELDHOVEN'),(2102,'VELP GLD'),(2103,'VELP NB'),(2104,'VELSEN NOORD'),(2105,'VELSEN-NOORD'),(2106,'VELSEN-ZUID'),(2107,'VELSERBROEK'),(2108,'VENEBRUGGE'),(2109,'VENHORST'),(2110,'VENHUIZEN'),(2111,'VENLO'),(2112,'VENRAY'),(2113,'VESSEM'),(2114,'VETHUIZEN'),(2115,'VEULEN'),(2116,'VIANEN NB'),(2117,'VIANEN ZH'),(2118,'VIERAKKER'),(2119,'VIERHOUTEN'),(2120,'VIERHUIZEN'),(2121,'VIERLINGSBEEK'),(2122,'VIERPOLDERS'),(2123,'VILSTEREN'),(2124,'VINKEGA'),(2125,'VINKEL'),(2126,'VINKENBUURT'),(2127,'VINKEVEEN'),(2128,'VISVLIET'),(2129,'VLAARDINGEN'),(2130,'VLAGTWEDDE'),(2131,'VLEDDER'),(2132,'VLEDDERVEEN DR'),(2133,'VLEDDERVEEN GN'),(2134,'VLEUTEN'),(2135,'VLIELAND'),(2136,'VLIERDEN'),(2137,'VLISSINGEN'),(2138,'VLIST'),(2139,'VLODROP'),(2140,'VLYMEN'),(2141,'VOERENDAAL'),(2142,'VOGELENZANG'),(2143,'VOGELWAARDE'),(2144,'VOLENDAM'),(2145,'VOLKEL'),(2146,'VOLLENHOVE'),(2147,'VONDELINGENPL RT'),(2148,'VOORBURG'),(2149,'VOORHOUT'),(2150,'VOORSCHOTEN'),(2151,'VOORST GEM GENDR'),(2152,'VOORST GEM VOORST'),(2153,'VOORTHUIZEN'),(2154,'VORCHTEN'),(2155,'VORDEN'),(2156,'VORSTENBOSCH'),(2157,'VORTUM MULLEM'),(2158,'VRAGENDER'),(2159,'VREDENHEIM'),(2160,'VREDEPEEL'),(2161,'VREELAND'),(2162,'VRIES'),(2163,'VRIESCHELOO'),(2164,'VRIEZENVEEN'),(2165,'VROOMSHOOP'),(2166,'VROUWENAKKER'),(2167,'VROUWENPAROCHIE'),(2168,'VROUWENPOLDER'),(2169,'VUGHT'),(2170,'VUREN'),(2171,'VYFHUIZEN'),(2172,'VYLEN'),(2173,'WAAKSENS GEM LITT'),(2174,'WAAL'),(2175,'WAALRE'),(2176,'WAALWYK'),(2177,'WAARDE'),(2178,'WAARDENBURG'),(2179,'WAARDER'),(2180,'WAARDHUIZEN'),(2181,'WAARLAND'),(2182,'WAAXENS GEM DONGER'),(2183,'WACHTUM'),(2184,'WADDINXVEEN'),(2185,'WADENOYEN'),(2186,'WAGENBERG'),(2187,'WAGENBORGEN'),(2188,'WAGENINGEN'),(2189,'WALEM'),(2190,'WALSOORDEN'),(2191,'WAMEL'),(2192,'WANNEPERVEEN'),(2193,'WANROY'),(2194,'WANSSUM'),(2195,'WANSWERT'),(2196,'WAPENVELD'),(2197,'WAPSE'),(2198,'WAPSERVEEN'),(2199,'WARDER'),(2200,'WARFFUM'),(2201,'WARFHUIZEN'),(2202,'WARFSTERMOLEN'),(2203,'WARMENHUIZEN'),(2204,'WARMOND'),(2205,'WARNS'),(2206,'WARNSVELD'),(2207,'WARSTIENS'),(2208,'WARTEN'),(2209,'WASKEMEER'),(2210,'WASPIK'),(2211,'WASSENAAR'),(2212,'WATEREN'),(2213,'WATERGANG'),(2214,'WATERHUIZEN'),(2215,'WATERINGEN'),(2216,'WATERLANDKERKJE'),(2217,'WAVERVEEN'),(2218,'WEDDE'),(2219,'WEERSELO'),(2220,'WEERT'),(2221,'WEESP'),(2222,'WEHE DEN HOORN'),(2223,'WEHL'),(2224,'WEIDUM'),(2225,'WEITEVEEN'),(2226,'WEKEROM'),(2227,'WELL GLD'),(2228,'WELL LB'),(2229,'WELLERLOOI'),(2230,'WELSUM'),(2231,'WEMELDINGE'),(2232,'WENUM WIESEL'),(2233,'WERGEA'),(2234,'WERKENDAM'),(2235,'WERKHOVEN'),(2236,'WERNHOUT'),(2237,'WERVERSHOOF'),(2238,'WESEPE'),(2239,'WESSEM'),(2240,'WEST GRAFTDYK'),(2241,'WESTBEEMSTER'),(2242,'WESTBROEK'),(2243,'WESTDORP'),(2244,'WESTDORPE'),(2245,'WESTENDORP'),(2246,'WESTERBEEK'),(2247,'WESTERBORK'),(2248,'WESTERBROEK'),(2249,'WESTEREMDEN'),(2250,'WESTERGEEST'),(2251,'WESTERH VRIEZENV W'),(2252,'WESTERHOVEN'),(2253,'WESTERLAND'),(2254,'WESTERLEE GN'),(2255,'WESTERNIELAND'),(2256,'WESTERVELDE'),(2257,'WESTERVOORT'),(2258,'WESTERWYTWERD'),(2259,'WESTHEM'),(2260,'WESTHOEK'),(2261,'WESTKAPELLE'),(2262,'WESTKNOLLENDAM'),(2263,'WESTMAAS'),(2264,'WESTWOUD'),(2265,'WESTZAAN'),(2266,'WETERING'),(2267,'WETERINGBRUG'),(2268,'WETSINGE'),(2269,'WETZENS'),(2270,'WEURT'),(2271,'WEZEP'),(2272,'WEZUP'),(2273,'WEZUPERBRUG'),(2274,'WICHMOND'),(2275,'WIER'),(2276,'WIERDEN'),(2277,'WIERINGERWAARD'),(2278,'WIERINGERWERF'),(2279,'WIERUM'),(2280,'WILBERTOORD'),(2281,'WILDERVANK'),(2282,'WILHELMINADORP'),(2283,'WILHELMINAOORD'),(2284,'WILLEMSOORD'),(2285,'WILLEMSTAD NB'),(2286,'WILNIS'),(2287,'WILP GLD'),(2288,'WILSUM'),(2289,'WINDE'),(2290,'WINDRAAK'),(2291,'WINKEL'),(2292,'WINNEWEER'),(2293,'WINSCHOTEN'),(2294,'WINSSEN'),(2295,'WINSUM FR'),(2296,'WINSUM GN'),(2297,'WINTELRE'),(2298,'WINTERSWYK'),(2299,'WINTERSWYK BRINKH'),(2300,'WINTERSWYK CORLE'),(2301,'WINTERSWYK HENXEL'),(2302,'WINTERSWYK HUPPEL'),(2303,'WINTERSWYK KOTTEN'),(2304,'WINTERSWYK MEDDO'),(2305,'WINTERSWYK MISTE'),(2306,'WINTERSWYK RATUM'),(2307,'WINTERSWYK WOOLD'),(2308,'WIRDUM FR'),(2309,'WIRDUM GN'),(2310,'WISSENKERKE'),(2311,'WITHAREN'),(2312,'WITMARSUM'),(2313,'WITTE PAARDEN'),(2314,'WITTELTE'),(2315,'WITTEM'),(2316,'WITTEVEEN'),(2317,'WIUWERT'),(2318,'WJELSRYP'),(2319,'WOENSDRECHT'),(2320,'WOERDEN'),(2321,'WOERDENSE VERLAAT'),(2322,'WOGNUM'),(2323,'WOLDENDORP'),(2324,'WOLFHEZE'),(2325,'WOLPHAARTSDYK'),(2326,'WOLSUM'),(2327,'WOLTERSUM'),(2328,'WOLVEGA'),(2329,'WOMMELS'),(2330,'WONS'),(2331,'WORKUM'),(2332,'WORMER'),(2333,'WORMERVEER'),(2334,'WOUBRUGGE'),(2335,'WOUDBLOEM'),(2336,'WOUDENBERG'),(2337,'WOUDRICHEM'),(2338,'WOUDSEND'),(2339,'WOUTERSWOUDE'),(2340,'WOUW'),(2341,'WOUWSE PLANTAGE'),(2342,'WYCHEN'),(2343,'WYCKEL'),(2344,'WYDENES'),(2345,'WYDEWORMER'),(2346,'WYHE'),(2347,'WYK AAN ZEE'),(2348,'WYK BY DUURSTEDE'),(2349,'WYK EN AALBURG'),(2350,'WYLRE'),(2351,'WYNALDUM'),(2352,'WYNANDSRADE'),(2353,'WYNBERGEN'),(2354,'WYNGAARDEN ZH'),(2355,'WYNJEWOUDE'),(2356,'WYNS'),(2357,'WYSTER'),(2358,'WYTGAARD'),(2359,'YDE'),(2360,'YERSEKE'),(2361,'YHORST'),(2362,'YLST'),(2363,'YMUIDEN'),(2364,'YPECOLSGA'),(2365,'YSBRECHTUM'),(2366,'YSSELHAM'),(2367,'YSSELMUIDEN'),(2368,'YSSELSTEIN UT'),(2369,'YSSELSTEYN LB'),(2370,'YZENDOORN'),(2371,'YZENDYKE'),(2372,'ZAAMSLAG'),(2373,'ZAANDAM'),(2374,'ZAANDYK'),(2375,'ZALK'),(2376,'ZALTBOMMEL'),(2377,'ZANDBERG DR'),(2378,'ZANDEWEER'),(2379,'ZANDHUIZEN'),(2380,'ZANDPOL'),(2381,'ZANDVOORT'),(2382,'ZEDDAM'),(2383,'ZEEGSE'),(2384,'ZEELAND'),(2385,'ZEERYP'),(2386,'ZEEWOLDE'),(2387,'ZEGGE'),(2388,'ZEGVELD'),(2389,'ZEIST'),(2390,'ZELHEM'),(2391,'ZENDEREN'),(2392,'ZENNEWYNEN'),(2393,'ZETTEN'),(2394,'ZEVENAAR'),(2395,'ZEVENBERG HOEK DRI'),(2396,'ZEVENBERGEN'),(2397,'ZEVENBERGS HOEK'),(2398,'ZEVENHOVEN'),(2399,'ZEVENHUIZEN GN'),(2400,'ZEVENHUIZEN ZH'),(2401,'ZEYEN'),(2402,'ZEYERVEEN'),(2403,'ZEYERVELD'),(2404,'ZIERIKZEE'),(2405,'ZIEUWENT'),(2406,'ZOELEN'),(2407,'ZOELMOND'),(2408,'ZOETERMEER'),(2409,'ZOETERWOUDE'),(2410,'ZONNEMAIRE'),(2411,'ZORGVLIED'),(2412,'ZOUTELANDE'),(2413,'ZOUTKAMP'),(2414,'ZUID BEYERLAND'),(2415,'ZUID SCHARWOUDE'),(2416,'ZUIDBROEK'),(2417,'ZUIDDORPE'),(2418,'ZUIDERMEER'),(2419,'ZUIDERWOUDE'),(2420,'ZUIDHORN'),(2421,'ZUIDLAARDERVEEN'),(2422,'ZUIDLAND'),(2423,'ZUIDLAREN'),(2424,'ZUIDOOSTBEEMSTER'),(2425,'ZUIDSCHERMER'),(2426,'ZUIDVEEN'),(2427,'ZUIDVELD'),(2428,'ZUIDVELDE'),(2429,'ZUIDWOLDE DR'),(2430,'ZUIDWOLDE GN'),(2431,'ZUIDZANDE'),(2432,'ZUILICHEM'),(2433,'ZUNA'),(2434,'ZUNDERT'),(2435,'ZURICH'),(2436,'ZUTPHEN'),(2437,'ZUURDYK'),(2438,'ZWAAG'),(2439,'ZWAAGDYK'),(2440,'ZWAAGWESTEINDE'),(2441,'ZWAANSHOEK'),(2442,'ZWAGERBOSCH'),(2443,'ZWAMMERDAM'),(2444,'ZWANENBURG'),(2445,'ZWARTEBROEK'),(2446,'ZWARTEMEER'),(2447,'ZWARTEWAAL'),(2448,'ZWARTSLUIS'),(2449,'ZWEELOO'),(2450,'ZWEINS'),(2451,'ZWIGGELTE'),(2452,'ZWINDEREN'),(2453,'ZWOLLE'),(2454,'ZWYNDRECHT'),(2455,'ZYDERVELD'),(2456,'ZYDEWIND'),(2457,'ZYLDYK');
/*!40000 ALTER TABLE `woonplaatsen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'brouwerij'
--

--
-- Final view structure for view `vw_verbruik_grondstoffen`
--

/*!50001 DROP VIEW IF EXISTS `vw_verbruik_grondstoffen`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_verbruik_grondstoffen` AS select `g`.`naam` AS `naam`,((`r`.`hoeveelheid` * `b`.`liters`) * -(1)) AS `hoeveelheidkg` from (((`brouwsels` `b` join `recepten` `r`) join `beersorts` `bs`) join `grondstoffen` `g`) where ((`b`.`biersoort_id` = `r`.`biersoort_id`) and (`b`.`biersoort_id` = `bs`.`id`) and (`r`.`grondstof_id` = `g`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_voorraad_grondstoffen`
--

/*!50001 DROP VIEW IF EXISTS `vw_voorraad_grondstoffen`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_voorraad_grondstoffen` AS select `vw_verbruik_grondstoffen`.`naam` AS `naam`,`vw_verbruik_grondstoffen`.`hoeveelheidkg` AS `hoeveelheidkg` from `vw_verbruik_grondstoffen` union all select `grondstoffen`.`naam` AS `grondstof`,`inkoopgrondstof`.`hoeveelheidkg` AS `hoeveelheidkg` from (`inkoopgrondstof` join `grondstoffen`) where (`inkoopgrondstof`.`grondstof_id` = `grondstoffen`.`id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-19 13:24:41
