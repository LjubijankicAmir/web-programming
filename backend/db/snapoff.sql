-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: snapoff
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Nature','Capture the breathtaking beauty of the natural world, from stunning landscapes to intricate flora and fauna, celebrating the wonders of our planet through photography.'),(2,'Portrait','Showcase the essence of individuals through compelling portraits, revealing the unique personalities, emotions, and stories that make each person extraordinary.'),(3,'Random','Unleash your creativity without constraints, exploring diverse themes, concepts, and perspectives to push the boundaries of imagination and photographic expression.');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_entrances`
--

DROP TABLE IF EXISTS `contest_entrances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contest_entrances` (
  `user_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  KEY `contest_entrances_users_FK` (`user_id`),
  KEY `contest_entrances_contests_FK` (`contest_id`),
  CONSTRAINT `contest_entrances_contests_FK` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`id`),
  CONSTRAINT `contest_entrances_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_entrances`
--

LOCK TABLES `contest_entrances` WRITE;
/*!40000 ALTER TABLE `contest_entrances` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_entrances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests`
--

DROP TABLE IF EXISTS `contests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `entry_price` int(10) unsigned DEFAULT NULL,
  `deadline_date` datetime NOT NULL,
  `participants` int(10) unsigned DEFAULT NULL,
  `submissions` int(10) unsigned DEFAULT NULL,
  `image_source` varchar(100) NOT NULL,
  `paragraph_1` longtext DEFAULT NULL,
  `paragraph_2` longtext DEFAULT NULL,
  `paragraph_3` longtext DEFAULT NULL,
  `paragraph_4` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contests_categories_FK` (`category`),
  CONSTRAINT `contests_categories_FK` FOREIGN KEY (`category`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests`
--

LOCK TABLES `contests` WRITE;
/*!40000 ALTER TABLE `contests` DISABLE KEYS */;
INSERT INTO `contests` VALUES (1,1,'Walk In The Forest',10,'2024-05-07 08:00:00',0,0,'featured-image-03','Images should capture the stunning beauty of the forest, including lush greenery, sunlight filtering through the trees, and vibrant flora.',NULL,'Photos should not include artificial structures such as buildings, roads, or signs unless they contribute to the story or aesthetic in a meaningful way.','While some editing is expected, avoid excessive manipulation that alters the natural appearance of the forest or detracts from the authenticity of the scene.'),(2,3,'Stars In The Sky',20,'2024-05-05 08:00:00',0,0,'photo-video-01','Images featuring clear, dark skies filled with stars providing a captivating backdrop for various compositions.','Successful entries will evoke a sense of wonder, awe, or tranquility, capturing the beauty and majesty of the night sky and inspiring viewers to contemplate the universe\'s vastness.','Avoid images with significant light pollution, which can detract from the visibility and clarity of the stars in the sky. Seek out dark sky locations away from urban areas for optimal conditions.','Empty Skies: Images that lack visual interest or focal points in the sky or foreground may appear dull or uninspiring'),(3,3,'City Lights',NULL,'2024-05-05 08:00:00',0,0,'city-lights','Reflections: Utilizing reflections from water bodies, glass surfaces, or wet pavements can create captivating visual effects, doubling the impact of city lights and adding depth to the composition.',NULL,'Avoid images with excessive noise or distortion, which can result from high ISO settings or poor image quality.',NULL),(4,1,'Blue Lake',25,'2024-05-07 08:00:00',0,0,'featured-image-02','Scenic Surroundings: Including the natural surroundings of the lake such as mountains, forests, or rocky cliffs can add depth and context to the composition, enhancing the overall beauty of the scene.','Images showcasing the crystal-clear blue waters of the lake create a captivating visual impact. Look for vantage points that offer unobstructed views of the lake\'s surface.','While enhancing colors in post-processing can be tempting, avoid excessive manipulation that alters the natural appearance of the lake\'s blue water. Strive for a balance between enhancement and authenticity.','Entries should strive to capture the unique beauty and allure of the blue lake. Avoid images that lack a clear focal point or fail to evoke a sense of wonder and admiration.');
/*!40000 ALTER TABLE `contests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submissions` (
  `image_source` varchar(100) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `award` int(10) unsigned DEFAULT NULL,
  `position_won` int(10) unsigned NOT NULL,
  `contest_name` varchar(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submissions_users_FK` (`user_id`),
  CONSTRAINT `submissions_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES ('portfolio-01',1,1000,2,'Walk In The Beach',11),('portfolio-02',2,NULL,5,'Walk In The Nature',11),('portfolio-03',3,NULL,6,'Walk In The Forest',11),('portfolio-04',4,NULL,4,'Walk In The Forest',11),('portfolio-05',5,200,4,'Walk In The Forest',12),('portfolio-06',6,1500,1,'Rocky Mountain',12),('portfolio-08',7,500,3,'Blue Lake',12),('portfolio-09',8,200,5,'Walk In The Forest',12),('portfolio-01',9,500,3,'Walk In The Beach',12),('portfolio-02',10,NULL,8,'Walk In The Nature',12),('portfolio-08',11,800,3,'Blue Lake',13);
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `send_updates` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'John Walker','johnwalker@gmail.com','$2y$10$nDzn0Fc5rj1V1pSF55B2SeAKwtlQG1dmelasPuOtZux7v.742q8zW',2,'avatar_1',0),(12,'Jane Smith','janesmith@gmail.com','$2y$10$wwogBKP97AK9QNbADBQDVONVHiHQhgmppVXASmP9xPHWqTOi33pou',1,'avatar_2',0),(13,'David Johnson','davidjohnson@gmail.com','$2y$10$YP.DaJ/pFdvMJvwj7kND5.sMZ1YQRHbV5fitKmw0EMV/lAWGSUvsS',3,NULL,0),(14,'amir','amir.ljubijankic1@stu.ibu.edu.ba','$2y$10$00D4bCKmUyxFlyZX8GfumOm0nuDgnoko9tbVD6klAsMoqSMnnR9mu',NULL,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'snapoff'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-23  6:55:21
