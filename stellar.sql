CREATE DATABASE  IF NOT EXISTS `stellar` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `stellar`;
-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: stellar
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

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
-- Table structure for table `activation_codes`
--

DROP TABLE IF EXISTS `activation_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activation_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activationCode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activation_codes`
--

LOCK TABLES `activation_codes` WRITE;
/*!40000 ALTER TABLE `activation_codes` DISABLE KEYS */;
INSERT INTO `activation_codes` VALUES (21,1157777720,NULL),(22,1854519957,NULL),(23,1383948945,NULL),(24,1048247296,NULL),(25,1677910227,NULL),(26,658942136,NULL),(27,296887890,NULL),(28,1696103038,NULL),(29,342855552,NULL),(30,1105186400,NULL),(31,1153120841,NULL),(32,1749811454,NULL),(33,592647991,NULL),(34,1288158461,NULL),(35,421490584,NULL),(36,168268564,NULL),(37,1675515987,NULL),(38,267489359,NULL),(39,570507488,NULL),(40,2079777632,NULL);
/*!40000 ALTER TABLE `activation_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_01_25_034926_add_fields_to_users',2),(6,'2023_01_25_040239_create_activation_code_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',3,'API TOKEN','8fe7585f8d720183bd55c258766760ed86619ac10cf6bfc2229b13d4664a00ed','[\"*\"]',NULL,NULL,'2023-01-23 16:53:28','2023-01-23 16:53:28'),(2,'App\\Models\\User',3,'API TOKEN','62d765d392f834879a6fe7ffd9408b657384952d5eb31e65dff2da0d58e187b4','[\"*\"]',NULL,NULL,'2023-01-23 19:10:41','2023-01-23 19:10:41'),(3,'App\\Models\\User',3,'API TOKEN','aa96944911c3c7a096203592e36b8e89f9d51d97ebf7d6a0dc9daa9f60208eb5','[\"*\"]',NULL,NULL,'2023-01-24 04:33:53','2023-01-24 04:33:53'),(4,'App\\Models\\User',3,'API TOKEN','f006dc540e60fb6299bb1be0b09e7d43ff17c2da968262146ef4d1419d730c83','[\"*\"]',NULL,NULL,'2023-01-24 14:03:12','2023-01-24 14:03:12'),(5,'App\\Models\\User',3,'API TOKEN','e305828fbc94e03635b9d7be70959d209f8b1917a031b180751b2d448d1edf94','[\"*\"]',NULL,NULL,'2023-01-24 14:06:32','2023-01-24 14:06:32'),(6,'App\\Models\\User',3,'API TOKEN','e571661478b365694476a234e5eee139915d3c7206de1327583ca1b01a8ec29b','[\"*\"]',NULL,NULL,'2023-01-24 14:09:15','2023-01-24 14:09:15'),(7,'App\\Models\\User',3,'API TOKEN','110b9240a62141bc7c8932c83b13d9c4ff87feb457e52c75b8fb6e38a7590a0e','[\"*\"]',NULL,NULL,'2023-01-24 14:09:22','2023-01-24 14:09:22'),(8,'App\\Models\\User',3,'API TOKEN','a5f4362191f8c3d070f00aebf8d8cb11429ea19e35ee509106c18501bb6c74cb','[\"*\"]',NULL,NULL,'2023-01-24 14:14:08','2023-01-24 14:14:08'),(9,'App\\Models\\User',3,'API TOKEN','a3afed892724ee412781e64841fbc3f1ef05677c4dbe2e0cd0343836f7a78599','[\"*\"]',NULL,NULL,'2023-01-24 14:29:02','2023-01-24 14:29:02'),(10,'App\\Models\\User',3,'API TOKEN','565c7681ff49f9b4f965892c4db1781945f89be60e8607647c154fcf4218bcf2','[\"*\"]',NULL,NULL,'2023-01-24 14:30:20','2023-01-24 14:30:20'),(11,'App\\Models\\User',3,'API TOKEN','2010d7fdafef32c6a8f699f0b589b7cac613de2b782d43117ddc9e772f5023c7','[\"*\"]',NULL,NULL,'2023-01-24 19:14:16','2023-01-24 19:14:16'),(12,'App\\Models\\User',3,'API TOKEN','a625c95051132329f35ade6d090615313d9ee42ed57805764e7873377fa5bd21','[\"*\"]',NULL,NULL,'2023-01-24 19:18:17','2023-01-24 19:18:17'),(13,'App\\Models\\User',3,'API TOKEN','bb07b88fde0e4715d4ed93448606992c0b75c7b513a43724249163876eba1581','[\"*\"]',NULL,NULL,'2023-01-24 19:55:23','2023-01-24 19:55:23'),(14,'App\\Models\\User',1,'API TOKEN','73ecb85b9ae5956f6ae009e26436ad9b7600258e71619838f67d4c5641c4aa59','[\"*\"]',NULL,NULL,'2023-01-24 19:56:33','2023-01-24 19:56:33'),(15,'App\\Models\\User',1,'API TOKEN','72c4b3feffb1f12202b21e61db38574032119ccfaf47c5e1a0ce896ae55309ea','[\"*\"]',NULL,NULL,'2023-01-25 03:38:04','2023-01-25 03:38:04'),(16,'App\\Models\\User',1,'API TOKEN','23b507df870f1867b800a14cc57deca47bd1efb051769d35a0d864c99349af1b','[\"*\"]',NULL,NULL,'2023-01-25 03:40:08','2023-01-25 03:40:08'),(17,'App\\Models\\User',1,'API TOKEN','8f5e5dcb0835ebe79c1e46090c978754fd8cbe54cf9ee0ac63b342a1a077f1b7','[\"*\"]',NULL,NULL,'2023-01-25 03:40:23','2023-01-25 03:40:23'),(18,'App\\Models\\User',1,'API TOKEN','acb0097675f9955f1bf9e0e2e834eadc9711b1a8bfc858ab69a3c327f420c915','[\"*\"]',NULL,NULL,'2023-01-25 03:47:30','2023-01-25 03:47:30'),(19,'App\\Models\\User',1,'API TOKEN','6eb18d7d6ead1be8708309822e1f941367bc6f0771072fe80c08ccf65548b283','[\"*\"]',NULL,NULL,'2023-01-25 03:49:26','2023-01-25 03:49:26'),(20,'App\\Models\\User',1,'API TOKEN','684b454e394d4fafe0f3889968da1a2e2be67bfaffeba2f1a69664fc33e6ed26','[\"*\"]',NULL,NULL,'2023-01-25 03:50:11','2023-01-25 03:50:11'),(21,'App\\Models\\User',1,'API TOKEN','530494eba6af7d5c7591c0c4c93a86f8ba4e40c17b5565f3ddf97d90a3845ffd','[\"*\"]',NULL,NULL,'2023-01-25 03:54:25','2023-01-25 03:54:25'),(22,'App\\Models\\User',1,'API TOKEN','03adb062e680e08ca4dc9e1be6c51537379ff45f6f8c9dddbcc5836d120b4bc2','[\"*\"]',NULL,NULL,'2023-01-25 03:57:52','2023-01-25 03:57:52'),(23,'App\\Models\\User',1,'API TOKEN','8ae45db5ceaad071b3b8f05d78262913b77b720b397a9b7288d648ac269ff7d9','[\"*\"]',NULL,NULL,'2023-01-25 04:00:30','2023-01-25 04:00:30'),(24,'App\\Models\\User',1,'API TOKEN','da34dead99c3f260906a247799d483b62aeee9f8e1870b25d1c9eb27c017b771','[\"*\"]',NULL,NULL,'2023-01-25 04:13:27','2023-01-25 04:13:27'),(25,'App\\Models\\User',1,'API TOKEN','cb112ef18fa5b9cd4623ab77941024c58de90c3dad634aef1a0511e6ffd2881e','[\"*\"]','2023-01-25 05:02:44',NULL,'2023-01-25 05:01:04','2023-01-25 05:02:44'),(26,'App\\Models\\User',1,'API TOKEN','7ed1e222566a5d716a510a47b0506b0f4b75ae1c47d2dece2e99f43bcda09288','[\"*\"]','2023-01-25 19:49:00',NULL,'2023-01-25 17:29:44','2023-01-25 19:49:00'),(27,'App\\Models\\User',1,'API TOKEN','ad7fb67e7eb4c12365097df37e40493e807d26cc703191df5c86549c66cc9b6e','[\"*\"]',NULL,NULL,'2023-01-26 00:54:24','2023-01-26 00:54:24'),(28,'App\\Models\\User',1,'API TOKEN','dbcb8e41d44f43e5fe5570435980b724e4a1f6d378e34834666ea44a2d97d031','[\"*\"]','2023-01-26 02:01:05',NULL,'2023-01-26 01:05:25','2023-01-26 02:01:05'),(29,'App\\Models\\User',1,'API TOKEN','e8f0bdc17ecdbc9e2ec73d83f80b13ec3a755c3bd44f5623e51881878c1d373c','[\"*\"]','2023-01-26 04:16:42',NULL,'2023-01-26 03:14:52','2023-01-26 04:16:42'),(30,'App\\Models\\User',1,'API TOKEN','93f5e4219bf8364b2db59b38f306bcbed251c43a5d66d892b252f421144b0b82','[\"*\"]','2023-01-26 22:51:51',NULL,'2023-01-26 04:00:13','2023-01-26 22:51:51'),(31,'App\\Models\\User',1,'API TOKEN','c36f0ac2187c65b6386b18feffffc74be98f8762e3aeab6424f68ea39cf8bd58','[\"*\"]','2023-01-26 04:49:18',NULL,'2023-01-26 04:21:54','2023-01-26 04:49:18'),(32,'App\\Models\\User',1,'API TOKEN','e14c6affb45fde415bda91a3a938d920ed0f2cf53b2326cb361f7dbd8165764c','[\"*\"]','2023-01-26 15:30:27',NULL,'2023-01-26 13:52:45','2023-01-26 15:30:27'),(33,'App\\Models\\User',1,'API TOKEN','54224e9e24651eb30cff177fa04bf9eb4a2973a3895586650dfcb2d33cb0103a','[\"*\"]','2023-01-26 15:33:46',NULL,'2023-01-26 15:31:04','2023-01-26 15:33:46'),(34,'App\\Models\\User',2,'API TOKEN','6ffec8b846247ecd0e8d20d9919b696740226708122582838a8e108c1cb48900','[\"*\"]','2023-01-26 22:07:03',NULL,'2023-01-26 22:06:49','2023-01-26 22:07:03'),(35,'App\\Models\\User',1,'API TOKEN','b8d41e7619728fc966339000431e6b0e0c4a9084d8b9ac5abf47a61916d19ad1','[\"*\"]','2023-01-26 22:52:16',NULL,'2023-01-26 22:07:19','2023-01-26 22:52:16'),(36,'App\\Models\\User',1,'API TOKEN','50b82db63364a39c2202ab8225fb3fb5cc743139458a86e56877d188db30e767','[\"*\"]','2023-01-26 22:45:44',NULL,'2023-01-26 22:43:19','2023-01-26 22:45:44'),(37,'App\\Models\\User',1,'API TOKEN','018c5f6090b86ab4670fd94e59d9e2fd6ddffe03702b2cd851962037c5b5a8af','[\"*\"]','2023-01-26 22:52:36',NULL,'2023-01-26 22:52:32','2023-01-26 22:52:36'),(38,'App\\Models\\User',1,'API TOKEN','dda44fc8766a22da055147a0409859055c477a0578d40bd509a987415c717929','[\"*\"]','2023-01-26 22:55:14',NULL,'2023-01-26 22:55:09','2023-01-26 22:55:14'),(39,'App\\Models\\User',2,'API TOKEN','c07d872146a9e20970b7e57a802ce5bdacf63c317f0673be464214adf9565f99','[\"*\"]','2023-01-26 22:57:37',NULL,'2023-01-26 22:57:35','2023-01-26 22:57:37'),(40,'App\\Models\\User',1,'API TOKEN','3e2b9b98b34c23a6073b5b1b6969ae51dea6e57602bce255036e6c8e7aa8d6b0','[\"*\"]','2023-01-27 00:27:44',NULL,'2023-01-26 22:57:57','2023-01-27 00:27:44'),(41,'App\\Models\\User',1,'API TOKEN','b672bc1ee1606fed422adab5060eb99d5a7b3645271f8abed39732a2bf0d6649','[\"*\"]','2023-01-27 03:04:47',NULL,'2023-01-27 03:04:26','2023-01-27 03:04:47'),(42,'App\\Models\\User',2,'API TOKEN','16614919fd18fad9d78099615303d00ae6caa9cc7791639d3215e3e6c8d2829c','[\"*\"]','2023-01-27 03:06:17',NULL,'2023-01-27 03:06:11','2023-01-27 03:06:17'),(43,'App\\Models\\User',1,'API TOKEN','3a2d17dbbf9ef5f0657f520d81607690c21022ceaa769a21d6e646c196181b1c','[\"*\"]','2023-01-27 04:02:13',NULL,'2023-01-27 03:06:34','2023-01-27 04:02:13'),(44,'App\\Models\\User',1,'API TOKEN','aae845f115c23a624be5fa762fd873d827dd1f10ad7fffb603797707a4280c92','[\"*\"]','2023-01-27 04:44:23',NULL,'2023-01-27 04:21:41','2023-01-27 04:44:23'),(45,'App\\Models\\User',2,'API TOKEN','4b46df4f6a25e40f6a9c74dde48e531c6eb998486bc9c8ec3d1447b281daf0db','[\"*\"]','2023-01-27 04:50:13',NULL,'2023-01-27 04:44:33','2023-01-27 04:50:13'),(46,'App\\Models\\User',1,'API TOKEN','9b6dbde821fce2746cf704f45f8deb943d3957b5e8abc006eb2488cf92460233','[\"*\"]','2023-01-27 04:49:24',NULL,'2023-01-27 04:49:06','2023-01-27 04:49:24'),(47,'App\\Models\\User',1,'API TOKEN','28b462626c36b2344307362c59cf4da6e7d0e6cb2e795ca3db58f7c0ae74238d','[\"*\"]','2023-01-27 17:45:36',NULL,'2023-01-27 17:45:30','2023-01-27 17:45:36');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sponsorID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activationCode` bigint(20) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactInfo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0',2016100900,'John','','Doe','','','example@gmail.com','$2y$10$.X4B1zw9vUfMgIu06Rsefu64cMyD15x4nkoNUQTu/hT8rW5WzZlfe','user',NULL,'2023-01-23 16:51:59','2023-01-23 16:51:59'),(2,'1',1157777720,'Adam','Ben','Poe','07-07-1997','09978366415','abPoe@gmail.com','$2y$10$YqHsVQprOoqd1XrqIepdQOJpH.E19f93eQAeNCC/4dmbDfVVGEbVG','user',NULL,'2023-01-25 17:48:19','2023-01-25 17:48:19'),(3,'1',1854519957,'Jason','Will','Terry','07-07-1997','09978366415','jTerry@gmail.com','$2y$10$dOpFlm3M.TLMxQxFRY/dxOLG5GDv2bLkDX.p7eX9.KGBwVtoameaq','user',NULL,'2023-01-25 17:52:01','2023-01-25 17:52:01'),(4,'1',1383948945,'Joseph','Greg','Doe','07-10-1993','09978366415','jgDoe@gmail.com','$2y$10$WbjGo1fsKC7shF3S2h2JfezZ9AbCS6wbPjLa42jfNpgRWRDjE0YBm','user',NULL,'2023-01-25 17:53:22','2023-01-25 17:53:22'),(5,'1',267489359,'Nics','jr','Balahay','2023-01-01','09978366415','nics@gmail.com','$2y$10$D6oxXiD6znLITeofoPTrceWjUtLn5enTVcFpF50I1bj0pbPSlq10u','user',NULL,'2023-01-27 04:24:34','2023-01-27 04:24:34'),(6,'0',0,'admin','admin','admin','07-07-1997','09978366415','admin@stellar.com','$2y$10$0E97yNI7LDzGVGZ.lykaB.Ki0emVHugQBX0/e9CJ8Ull6L0wf7xl.','admin',NULL,'2023-01-27 17:16:32','2023-01-27 17:16:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-28 10:19:57
