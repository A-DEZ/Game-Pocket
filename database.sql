-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: game_pocket
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.21.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentary_user1_idx` (`user_id`),
  KEY `fk_commentary_game1_idx` (`game_id`),
  CONSTRAINT `fk_commentary_game1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `fk_commentary_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentary`
--

LOCK TABLES `commentary` WRITE;
/*!40000 ALTER TABLE `commentary` DISABLE KEYS */;
INSERT INTO `commentary` VALUES (6,'On va vous avoir au Kahoot vous inquiétez pas !','2021-11-19 11:37:10',7,15),(7,'Moi j\'ai bien aimé mais je préfère Call Of tout de même...','2021-11-19 11:41:52',5,15),(8,'Des barres de rires !!!','2021-11-19 11:42:09',5,1);
/*!40000 ALTER TABLE `commentary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite` (
  `user_id` int NOT NULL,
  `game_id` int NOT NULL,
  KEY `fk_user_has_game_game1_idx` (`game_id`),
  KEY `fk_user_has_game_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_has_game_game1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `fk_user_has_game_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (1,2),(2,3),(2,3);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(150) NOT NULL,
  `video` varchar(150) DEFAULT NULL,
  `is_solo` tinyint(1) NOT NULL,
  `is_online` tinyint(1) NOT NULL,
  `lasting` varchar(45) NOT NULL,
  `link` varchar(150) NOT NULL,
  `popularity` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_game_user1_idx` (`user_id`),
  CONSTRAINT `fk_game_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Le jeu du téléphone arabe en ligne ! Avec des dessins en plus ! Joue dès maintenant et gratuitement au jeu populaire.','gartic_icon.jpeg','gartic_img.png','2020-12-08','Gartic phone',NULL,0,1,'Courte','https://garticphone.com/fr',54,'2021-11-09 00:00:00',NULL),(2,'Skribbl io est un jeu de devinettes et de dessin multijoueur gratuit. Dessinez et devinez des mots avec vos amis et des personnes du monde entier !','skribblio_icon.png','skribblio_img.png','2018-03-01','Skribbl io',NULL,0,1,'Courte','https://skribbl.io/',52,'2021-11-09 00:00:00',NULL),(3,'Forge of Empires est un jeu de stratégie en temps réel massivement multijoueur développé par InnoGames.','forgeofempires_icon.jpeg','forgeofempires_img.jpeg','2012-04-17','Forge of Empires','https://youtu.be/rIzMiYbpw5s',0,1,'Longue','https://www.om.forgeofempire.com/',42,'2021-11-09 00:00:00',NULL),(4,'Stick Fight est un jeu de combat basé sur la physique à jouer entre amis et en ligne où vous incarnez un bonhomme bâton tout droit sorti de l\'âge d\'or d\'internet.','stickfight_icon.jpeg','stickfight_img.jpeg','2017-09-28','Stick Fight','https://youtu.be/PsEZ81-UqDU',0,1,'Courte','https://landfall.se/stickfightthegame',38,'2021-11-09 00:00:00',NULL),(5,'Ultimate Chicken Horse est un jeu de plateformes festif qui vous permet de construire le niveau tout en jouant et en plaçant des pièges et autres dangers pour attraper vos amis tout en essayant de ne pas vous attraper vous-même.','ultimatechicken_icon.jpeg','ultimatechicken_img.jpeg','2016-03-04','Ultimate Chicken Horse','https://youtu.be/FYaE_xw4krw',0,1,'Moyenne','https://www.cleverendeavourgames.com/ultimate-chicken-horse',51,'2021-11-09 00:00:00',NULL),(6,'Fall Guys: Ultimate Knockout réunit, pêle-mêle, des hordes de joueurs en ligne, et les précipite sans ménagement dans une compétition maboule composée de rounds de plus en plus anarchiques !','fallguys_icon.jpeg','fallguys_img.jpeg','2020-08-04','Fall Guys : Ultimate Knockout','https://youtu.be/FcITAzKW3fY',0,1,'Courte','https://fallguys.com/',75,'2021-11-09 00:00:00',NULL),(7,'Slither io est un jeu de type « Snake », vous de faire grandir votre ver en consommant des orbes de couleurs dans une arène multijoueur. Éviter les autres vers pour éviter de vous faire avaler ou dévorez vous même les autres !','slitherio_icon.png','slitherio_img.jpeg','2018-11-16','Slither io',NULL,1,1,'Courte','http://slither.io/',30,'2021-11-09 00:00:00',NULL),(8,'Coéquipier : accomplissez vos tâches dans le vaisseau pour remporter la victoire, mais gare aux imposteurs ! Signalez les cadavres et votez pour expulser les imposteurs lors de réunions d\'urgence. Choisissez judicieusement !','amongus_icon.png','amongus_img.jpeg','2018-11-16','Among us','https://youtu.be/Uk8DJ6DlYSI',0,1,'Moyenne','https://www.innersloth.com/games/among-us/',80,'2021-11-09 00:00:00',NULL),(9,'Aux commandes d\'une boule colorée, collectez de petits ronds et mangez les autres joueurs pour devenir le plus gros possible.','Agar.io_Logo.png','agar.io-10-astuces-001.jpeg','2015-04-28','AgarIo',NULL,0,1,'Courte','https://agar.io/#ffa',20,'2021-11-09 00:00:00',NULL),(10,'OGame est un jeu par navigateur de stratégie guerrière spatiale avec plusieurs millions de comptes actifs','ogameicon.jpeg','ogameImage.jpg','2003-09-23','Ogame','https://www.youtube.com/watch?v=DUXonGdV0UU',0,1,'Courte','https://lobby.ogame.gameforge.com/fr_FR/',3,'2021-11-09 00:00:00',NULL),(11,'Hordes est le premier jeu de survie gratuit dans un monde hostile peuplé de zombies ! Jouez en communauté ou vivez en solitaire, à vous de choisir...','hordesicon.jpg','hordesimage.jpg','2008-07-15','Hordes','https://www.youtube.com/watch?v=lrCieoIaSWk',0,1,'Longue','http://www.hordes.fr/#index',17,'2021-11-18 18:59:39',NULL),(12,'\"À l’aide de ses deux nouveaux amis Pineapple Spank et El Pollo ; Burrito Bison part à l’aventure pour reprendre son livre des mains du méchant chef qui le lui a dérobé.\nPour ce faire, il devra rebondir, voler, planer et repousser les gummies.\n\"','bbisonr.jpeg','BurritoBisonRevengeimage.png','2012-02-12','Burrito Bison Revenge',NULL,1,0,'Moyenne','https://www.kongregate.com/fr/games/JuicyBeast/burrito-bison-revenge',50,'2021-11-18 19:02:12',NULL),(13,'Le jeu est basé sur la base de données de Google Maps et Google Street View. Le joueur apparaît au hasard dans le monde sur Google Street View et son but est de retrouver l’endroit où il se trouve sur Google Maps.','geoguessricon.png','geoguessrimage.png','2013-05-09','Geoguessr','https://www.youtube.com/watch?v=kHmR324AKuI',0,1,'Moyenne','https://www.geoguessr.com/',38,'2021-11-18 19:03:58',NULL),(14,'Kingdom Rush est un tower defense qui vous propose de défendre votre royaume contre les hordes d\'orcs, de trolls, de sorciers et de démons qui l\'assaillent.','kingdomRush.png','kingdomRusheeee.jpeg','2011-07-29','Kingdom Rush','https://www.youtube.com/watch?v=9fcVLnddCM4',1,0,'Moyenne','https://www.jeux-gratuits.com/jeu-kingdom-rush.html',22,'2021-11-18 19:06:11',NULL),(15,'Dans Defend The Castle en tant que roi, il est de votre devoir d’organiser une défense efficace, choisissez le bon type de troupe à envoyer au combat.\nCe jeu mêle habilement stratégie et hasard , vous ne vous lasserez pas.','PocketGameVisuel.png','PocketGameVisuelLandscape.png','2021-12-24','Defend The Castle',NULL,0,1,'Courte','https://github.com/WildCodeSchool/purple-php-2109-project2-castle',150,'2021-11-18 19:07:44',NULL);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rate` float DEFAULT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rating_game1_idx` (`game_id`),
  CONSTRAINT `fk_rating_game1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (2,5,1),(3,5,1),(4,0.5,1),(5,1,3),(6,3.5,3),(7,2.5,3),(8,2,3),(9,3,3),(10,4,3),(11,2,3),(12,4,3),(13,5,3),(14,1,3),(15,4,1),(16,1,1),(17,1,1),(18,5,3),(19,5,15),(20,5,15),(21,5,15),(22,5,15),(23,5,15),(24,5,15),(25,5,15),(26,5,15),(27,5,15),(28,5,15),(29,5,15),(30,5,15),(31,3.5,3),(32,1,6),(33,0.5,10),(34,5,2),(35,2,3),(36,0.5,2);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_has_game`
--

DROP TABLE IF EXISTS `tag_has_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_has_game` (
  `tag_id` int NOT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`tag_id`,`game_id`),
  KEY `fk_tag_has_game_game1_idx` (`game_id`),
  KEY `fk_tag_has_game_tag1_idx` (`tag_id`),
  CONSTRAINT `fk_tag_has_game_game1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `fk_tag_has_game_tag1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_has_game`
--

LOCK TABLES `tag_has_game` WRITE;
/*!40000 ALTER TABLE `tag_has_game` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_has_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `role` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `avatar` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'naïmdu38','naïm','naïmdu38@gmail.com','secretsecret','joueur','2021-11-14 00:00:00','avatar3.svg'),(2,'amandinedu69','amandine','amandine@gmail.com','secret','joueur','2021-11-14 00:00:00','avatar2.svg'),(3,'Rogerdu75','Roger','roger@gmail.com','motdepasse','joueur','2021-11-14 00:00:00','avatar1.svg'),(4,'GameDevPenelope','Penelope','Penelope@gmail.com','$2y$10$oqbAG3HrbVrCYPVZuPuRKOI3EoRueTsuqfWf1LPfQFHcNHyX9v0lG','Dev','2021-11-18 19:19:29','61969931343d96.87157450.jpg'),(5,'Gamer','Gamer','Gamer@gmail.com','$2y$10$1KuZP9aL8x5ysvgklaDUr.kFk3QMOP9k/fMz9NOtDONv99V/NyI5S','Gamer','2021-11-19 11:34:25','61977db1971fd3.97153834.png'),(6,'Dev','Deva','Dev@gmail.com','$2y$10$RAGKN2Y0IrnfVNMa7O9YZe6zlgSCmnjEyO3InTo4D90saAuG8NKe.','Dev','2021-11-19 11:35:04','61977dd7ccbf21.10466414.png'),(7,'Naim','naim','naim.jhuboo@gmail.com','$2y$10$FIaz2EQPfBUk1NFF0zdDzufWmT2JuDHQblIRKKjFp/byQf/Q/9i3G','Gamer','2021-11-19 11:36:21','61977e2526c8d2.78419256.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-19 11:43:29