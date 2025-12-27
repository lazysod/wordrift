-- MySQL dump 10.13  Distrib 9.4.0, for macos15.4 (arm64)
--
-- Host: 127.0.0.1    Database: awordgame
-- ------------------------------------------------------
-- Server version	5.7.39

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
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `topic_id` int(255) NOT NULL AUTO_INCREMENT,
  `author_id` int(255) NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (10,1,'<p style=\"letter-spacing: 0.21px;\"><span style=\"font-weight: 600;\">First of all welcome to The RPG Forge Community forums!</span></p><p style=\"letter-spacing: 0.21px;\">This document is designed as a small welcome and highlight of features and such of the forums to help you get the most out of things.&nbsp;</p><p style=\"letter-spacing: 0.21px;\">Features:&nbsp;</p><ul style=\"letter-spacing: 0.21px;\"><li>BBCODE commands</li><li>In built rich text editor.&nbsp;</li><li>Help Highlighting forums.&nbsp;</li><li>A range of custom Emotes</li></ul><p style=\"letter-spacing: 0.21px;\"><span style=\"font-weight: 600;\">BBCODE:</span></p><p style=\"letter-spacing: 0.21px;\"><i>(from phpbb website)&nbsp;</i></p><p style=\"letter-spacing: 0.21px;\"><span style=\"font-weight: 600;\"><u>What is it?</u><br></span><span style=\"font-size: 1rem; letter-spacing: 0.015em;\">BBCode is a special implementation of HTML. Whether you can actually use BBCode in your posts on the forum is determined by the administrator. In addition you can disable BBCode on a per post basis via the posting form. BBCode itself is similar in style to HTML, tags are enclosed in square brackets [ and ] rather than &lt; and &gt; and it offers greater control over what and how something is displayed. Depending on the template you are using you may find adding BBCode to your posts is made much easier through a clickable interface above the message area on the posting form. Even with this you may find the following guide useful.</span></p><p style=\"letter-spacing: 0.21px;\"><span style=\"font-size: 1rem; letter-spacing: 0.015em;\">Supported Commands:</span></p><p style=\"letter-spacing: 0.21px;\"><span style=\"font-size: 1rem; letter-spacing: 0.015em;\">Most should be obsolete with the introduction of the now inbuilt text editor. But we still have some commands that are of use.&nbsp;<br></span></p><p style=\"\"><span style=\"letter-spacing: 0.015em; font-size: 1rem;\"><b>youtube</b></span></p><p style=\"\">This command is designed to embed youtube videos with no mess or fuss. Just follow the example below.&nbsp;</p><p style=\"\">[noparse][youtube]https://www.youtube.com/watch?v=j_zzrz7Jks0&amp;list=PLUi1enDp8SVko2lw3v7frz1BLx-2ecAQJ[/youtube][/noparse]</p><p style=\"\"><b>Spoilers!</b></p><p style=\"\">If you want to post spoilers, or perhaps allow the reader choose if they want to read or find something out, follow the examples below:&nbsp;<br></p><p style=\"\">Q) What is a horses favourite game? [spoiler]Stable tennis...[/spoiler]</p><p style=\"\">[noparse][spoiler]this text would be hidden!![/spoiler][/noparse]</p><p style=\"\"><b>Emotes</b></p><p style=\"\">For as long as there has been forums there have been fun emotes, this forum should work with standard device emotes, but also we have provided some custom fun emotes for you to use.&nbsp;</p><p style=\"\">To use them just use a singular [noparse][emote=oops][/noparse] =&nbsp;[emote:oops]<br></p><p style=\"\"><b>Here is the range of emotes we currently provide:</b><br>&nbsp;[emotes]</p><p style=\"\"><b>HELP Forums</b></p><p style=\"\">We have two types of forums here. Normal ones and the Help forums. Or rather the Help category! If you post a question or problem in the help category and someone answers you you will see the topic icon turn green to let you know there is a reply you have nor read. In the event you find the answer useful, simply hit the green \"<b>Mark as answer</b>\" button and you will see a green stripe letting people know you found that reply to contain the helpful information you were looking for, this helps others and if you as a replier get enough of them you win a badge!!</p><p style=\"\">Yeh we have a few badges and......other things that but no point in spoiling <i>everything </i>is there?...</p>','2025-07-25 11:07:47','::1'),(11,1,'<p>First of all welcome!&nbsp;</p><p>Second of all.....Who am I welcoming?? 🤔</p><p>Time for introductions!</p>','2025-07-25 12:32:00','::1');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cookie_login`
--

DROP TABLE IF EXISTS `cookie_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cookie_login` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `cookie_hash` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookie_login`
--

LOCK TABLES `cookie_login` WRITE;
/*!40000 ALTER TABLE `cookie_login` DISABLE KEYS */;
INSERT INTO `cookie_login` VALUES (1,1,'5e1db55007506734eaf692590653735393440afa','2025-07-29','2025-07-29 12:41:03','2025-08-05'),(2,13,'0e4e65c726b6f074cac7a2116a56c0c516f45a47','2025-07-29','2025-07-29 12:58:03','2025-08-28'),(3,1,'afb40f4c6ca672df41dbe7948dae8334fa891212','2025-07-29','2025-07-29 12:58:21','2025-08-28'),(4,10,'072a98b682f2e1a2d1eb7efc2edf15bdb8b54c12','2025-07-29','2025-07-29 14:11:27','2025-08-28'),(5,1,'2ee414568d0853e96584e5a63a8233da6247bf0b','2025-07-29','2025-07-29 22:22:31','2025-08-28'),(6,1,'74041515c15995ec3c87d6b02ed313dced83455d','2025-07-30','2025-07-29 23:49:05','2025-08-29'),(7,9,'025611aa69e16a0afd3da8c2768f03349f9f86eb','2025-07-30','2025-07-30 07:57:14','2025-08-29'),(9,1,'c45e2238f1b7dfe176b53c0df800e1a817476854','2025-08-01','2025-08-01 04:34:07','2025-08-31'),(10,1,'32cd5e51fafc8f1d00b3a586c1a4c9bc44390473','2025-08-01','2025-08-01 04:36:17','2025-08-31'),(11,13,'fb9e6c31b1ebced3e6ff679698df8278bb66cb5e','2025-08-01','2025-08-01 17:21:25','2025-08-31'),(12,1,'816d05d28bf374d7884ed8c1111da4892db961c6','2025-08-03','2025-08-02 23:54:54','2025-09-02'),(13,14,'a2446022e26bfb6ecb12ad01dd61a91016d22ae7','2025-08-03','2025-08-03 00:03:56','2025-09-02'),(14,15,'5772d6cda71f0e7446b509bcf14040a8598ceb71','2025-08-07','2025-08-07 15:10:42','2025-09-06'),(16,10,'70c85799544949449d3722fa2e26c75700443c98','2025-08-08','2025-08-08 22:13:34','2025-09-07'),(17,10,'ec5ceb170a9331f609704f1416e2001a31e6cce3','2025-08-08','2025-08-08 22:15:34','2025-09-07'),(18,1,'8ca669c6664ddce0c3b323162e0c099d6d6e89cd','2025-08-12','2025-08-12 12:45:54','2025-09-11'),(19,13,'ffafc421b94a0d3e5651d68ac9e5fa29cc9950b5','2025-08-17','2025-08-17 22:52:29','2025-09-16'),(20,1,'e5cb675577c0197c6f178ec03244a6e40ec0a49d','2025-08-21','2025-08-21 15:52:05','2025-09-20'),(21,1,'e0cc7b71e9bf62b758889fa83aa7335372f79de0','2025-08-21','2025-08-21 15:54:50','2025-09-20'),(22,1,'db00e4fdc8a6d8fc749a23649c9ec9343051ec47','2025-08-21','2025-08-21 15:59:37','2025-09-20'),(23,1,'8b7471f4ae0bf59f5f0a425068c05d96f4801b9e','2025-08-21','2025-08-21 16:07:24','2025-09-20'),(24,1,'5f573b82f1da8677c86d695538c530d136b6c489','2025-08-21','2025-08-21 16:08:47','2025-09-20'),(25,1,'c02b74809aaccf4972b9bb7059fa28aa91a255a3','2025-08-21','2025-08-21 16:09:14','2025-09-20'),(26,1,'f66b7dcd21696a4242e1ff93608c405741802c92','2025-08-21','2025-08-21 16:14:15','2025-09-20'),(27,10,'37551ac41b8825d8db7bcadc9656dbdcbe7f3914','2025-08-21','2025-08-21 17:29:36','2025-09-20'),(28,1,'389b4f6ee5bd60bebd9d0708da23ba8b4134620b','2025-08-21','2025-08-21 19:49:40','2025-09-20'),(29,16,'dca7d04102c326cf00ed5aac983d712827329f31','2025-08-21','2025-08-21 19:50:25','2025-09-20'),(30,1,'f1815edb36968ad4a072464d6e5083ccc5d82333','2025-08-21','2025-08-21 19:50:33','2025-09-20'),(31,17,'d968fc3125e52a9de4e6a66f892a6db646632248','2025-08-21','2025-08-21 19:51:56','2025-09-20'),(32,19,'3be76cc016a8c850661956c5f71d14c621cf6a69','2025-08-25','2025-08-25 22:39:11','2025-09-24');
/*!40000 ALTER TABLE `cookie_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_played`
--

DROP TABLE IF EXISTS `daily_played`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily_played` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `game_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_played`
--

LOCK TABLES `daily_played` WRITE;
/*!40000 ALTER TABLE `daily_played` DISABLE KEYS */;
INSERT INTO `daily_played` VALUES (1,1,'2025-07-30 07:51:24'),(2,10,'2025-07-30 21:36:25'),(3,13,'2025-07-30 22:33:12'),(4,10,'2025-07-31 19:55:14'),(5,13,'2025-07-31 21:05:46'),(7,13,'2025-08-01 17:26:06'),(8,13,'2025-08-02 23:20:57'),(9,1,'2025-08-03 00:00:50'),(10,1,'2025-08-07 15:36:14'),(11,1,'2025-08-08 19:47:00'),(12,10,'2025-08-08 22:37:14'),(13,13,'2025-08-08 22:50:15'),(14,1,'2025-08-08 23:03:01'),(15,13,'2025-08-09 14:31:23'),(16,10,'2025-08-09 14:35:16'),(17,14,'2025-08-09 18:43:06'),(18,10,'2025-08-10 04:32:13'),(19,1,'2025-08-10 09:41:15'),(20,10,'2025-08-11 05:03:06'),(21,10,'2025-08-12 00:27:01'),(22,1,'2025-08-12 12:47:34'),(23,13,'2025-08-12 14:45:22'),(24,10,'2025-08-13 00:36:52'),(25,1,'2025-08-13 11:05:04'),(26,10,'2025-08-14 05:51:52'),(27,1,'2025-08-14 21:32:26'),(28,1,'2025-08-14 23:29:25'),(29,10,'2025-08-15 13:08:57'),(30,13,'2025-08-15 21:41:27'),(31,10,'2025-08-16 02:22:36'),(32,13,'2025-08-16 17:11:12'),(33,10,'2025-08-17 00:54:33'),(34,13,'2025-08-17 22:53:49'),(35,10,'2025-08-18 02:36:22'),(36,10,'2025-08-19 04:40:23'),(37,10,'2025-08-20 01:31:24'),(38,10,'2025-08-21 11:24:13'),(39,1,'2025-08-21 17:33:45'),(40,17,'2025-08-21 20:00:10'),(41,10,'2025-08-22 00:20:51'),(42,1,'2025-08-22 08:46:51'),(43,1,'2025-08-22 23:15:15'),(44,10,'2025-08-23 15:56:46'),(45,10,'2025-08-23 23:20:20'),(46,1,'2025-08-24 06:48:33'),(47,1,'2025-08-24 23:04:03'),(48,10,'2025-08-24 23:57:17'),(49,19,'2025-08-25 22:43:43'),(50,1,'2025-08-26 08:17:36'),(51,10,'2025-08-26 19:35:01'),(52,1,'2025-08-26 23:04:30'),(53,10,'2025-08-27 00:06:46'),(54,1,'2025-08-27 23:00:00'),(55,10,'2025-08-27 23:00:00'),(56,1,'2025-08-28 23:00:00'),(57,10,'2025-08-28 23:00:00'),(58,10,'2025-08-29 23:00:00'),(59,1,'2025-08-29 23:00:00');
/*!40000 ALTER TABLE `daily_played` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_results`
--

DROP TABLE IF EXISTS `game_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `game_date` date NOT NULL,
  `mode` enum('daily','random') COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` enum('win','loss') COLLATE utf8mb4_unicode_ci NOT NULL,
  `guesses` tinyint(4) NOT NULL,
  `answer` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guess_history` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `max_streak` int(11) DEFAULT '0',
  `current_streak` int(11) DEFAULT '0',
  `game_mode` enum('daily','random','speed','') COLLATE utf8mb4_unicode_ci DEFAULT 'daily',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `game_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_results`
--

LOCK TABLES `game_results` WRITE;
/*!40000 ALTER TABLE `game_results` DISABLE KEYS */;
INSERT INTO `game_results` VALUES (2,1,'2025-07-27','daily','win',2,'GROPE','\"[\\\"\\u2b1b\\\\ud83d\\\\ud83d\\\\ud83d\\u2b1b___\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\\\udfe9\\ud83d\\udfe9\\ud83d\\udfe9\\\"]\"','2025-07-27 17:11:49',1,1,'daily'),(3,9,'2025-07-28','daily','win',6,'GROPE','\"[\\\"\\\\ud83d\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\ud83d\\udfe9\\\",\\\"\\\\ud83d\\u2b1b\\u2b1b\\u2b1b\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\\\ud83d\\u2b1b\\u2b1b__\\\",\\\"\\\\ud83d\\\\ud83d\\u2b1b\\u2b1b\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\ud83d\\udfe9\\ud83d\\udfe9\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\\\udfe9\\ud83d\\udfe9\\ud83d\\udfe9\\\"]\"','2025-07-28 00:41:54',1,1,'daily'),(4,10,'2025-07-28','daily','win',4,'HAVOC','\"[\\\"\\u2b1b\\u2b1b\\\\ud83d\\u2b1b\\u2b1b_\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\\\udfe9\\ud83d\\udfe9\\ud83d\\udfe9\\\"]\"','2025-07-28 02:18:36',1,1,'daily'),(5,1,'2025-07-28','daily','win',4,'HAVOC','\"[\\\"\\u2b1b\\u2b1b\\\\ud83d\\\\ud83d\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\\\ud83d\\\\ud83d\\u2b1b__\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\\\udfe9\\ud83d\\udfe9\\ud83d\\udfe9\\\"]\"','2025-07-28 08:21:39',2,2,'daily'),(6,11,'2025-07-28','daily','win',6,'HAVOC','\"[\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b_\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b_\\\",\\\"\\u2b1b\\u2b1b\\\\ud83d\\u2b1b\\u2b1b_\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b_\\\",\\\"\\u2b1b\\u2b1b\\u2b1b\\u2b1b\\u2b1b_\\\",\\\"\\\\ud83d\\u2b1b\\u2b1b\\u2b1b\\ud83d\\udfe8__\\\"]\"','2025-07-28 09:23:54',0,0,'daily'),(7,1,'2025-07-28','random','loss',6,'KNEED','[\"⬛🟨⬛🟩⬛\",\"⬛⬛🟩🟩⬛\",\"⬛⬛🟩🟩⬛\",\"⬛⬛🟩🟩🟨\",\"⬛⬛🟩🟩⬛\",\"🟩🟩🟩🟩⬛\"]','2025-07-28 20:25:55',0,0,'daily'),(8,1,'2025-07-28','random','win',6,'HANDY','[\"⬛⬛⬛🟨⬛\",\"🟨⬛⬛⬛⬛\",\"⬛⬛⬛⬛⬛\",\"🟩⬛⬛⬛⬛\",\"🟩🟩⬛⬛🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-28 20:32:06',0,0,'daily'),(9,1,'2025-07-29','daily','win',3,'PATSY','[\"🟩🟩⬛🟩🟩\",\"🟩🟩🟨🟨🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 09:13:51',3,3,'daily'),(10,13,'2025-07-29','daily','win',5,'PATSY','[\"🟩⬛⬛⬛🟨\",\"🟩⬛🟨🟨⬛\",\"🟩🟩⬛🟨🟩\",\"🟩🟩🟩⬛🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 14:01:22',1,1,'daily'),(11,1,'2025-07-29','random','loss',6,'LATHE','[\"🟨⬛⬛⬛⬛\",\"🟨⬛⬛🟨🟩\",\"⬛🟩⬛🟨🟩\",\"⬛🟩⬛🟨🟩\",\"🟩🟩⬛⬛🟩\",\"🟩🟩⬛⬛🟩\"]','2025-07-29 15:04:47',0,0,'daily'),(12,1,'2025-07-29','random','win',4,'QUOTE','[\"⬛⬛⬛⬛🟩\",\"⬛⬛🟨⬛🟩\",\"🟨⬛⬛🟩🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:06:46',0,0,'daily'),(13,1,'2025-07-29','random','loss',6,'SKIMP','[\"⬛🟨⬛⬛⬛\",\"⬛⬛⬛🟨⬛\",\"🟨⬛⬛⬛⬛\",\"⬛⬛🟩⬛⬛\",\"⬛🟨⬛⬛⬛\",\"⬛🟨⬛⬛⬛\"]','2025-07-29 15:16:36',0,0,'daily'),(14,10,'2025-07-29','daily','win',3,'PATSY','[\"🟨🟨🟨⬛⬛\",\"🟩🟩🟨🟨⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:18:45',2,2,'daily'),(15,1,'2025-07-29','random','win',3,'HUMOR','[\"⬛⬛⬛🟨⬛\",\"🟨⬛🟨🟩⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:19:07',0,0,'daily'),(16,1,'2025-07-29','random','win',6,'WRUNG','[\"⬛⬛🟨⬛🟨\",\"⬛🟨🟨🟨⬛\",\"🟨🟩⬛🟩⬛\",\"⬛🟩⬛🟩⬛\",\"⬛🟩⬛🟩⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:22:38',0,0,'daily'),(17,10,'2025-07-29','random','win',3,'SPELL','[\"🟨⬛🟨⬛🟨\",\"🟩🟨🟩⬛🟨\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:24:02',0,0,'daily'),(18,1,'2025-07-29','random','win',4,'VISOR','[\"⬛🟨🟨⬛⬛\",\"⬛🟩⬛⬛🟨\",\"⬛🟩⬛🟨🟨\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 15:24:51',0,0,'daily'),(19,1,'2025-07-29','daily','win',5,'PATSY','[\"🟨🟨⬛⬛⬛\",\"🟩⬛⬛⬛⬛\",\"🟩⬛⬛⬛⬛\",\"🟩🟩🟨🟨⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 19:50:22',3,3,'daily'),(20,1,'2025-07-29','daily','win',5,'PATSY','[\"⬛⬛⬛⬛⬛\",\"🟨🟨⬛⬛⬛\",\"🟨🟩⬛⬛🟩\",\"⬛🟩⬛🟩🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 23:28:03',3,3,'daily'),(21,1,'2025-07-29','random','win',5,'QUOTH','[\"⬛⬛⬛🟨⬛\",\"⬛⬛🟩⬛⬛\",\"⬛⬛🟩⬛⬛\",\"🟩🟩🟩🟩⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-29 23:49:07',0,0,'daily'),(22,1,'2025-07-30','daily','win',6,'PATSY','[\"⬛⬛⬛⬛⬛\",\"🟨⬛🟨🟩⬛\",\"⬛⬛⬛🟩⬛\",\"⬛🟩⬛🟩🟩\",\"⬛⬛🟨🟩🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 00:04:43',4,4,'daily'),(23,1,'2025-07-30','random','win',4,'SWING','[\"⬛⬛⬛🟨⬛\",\"🟩⬛⬛🟨⬛\",\"🟩⬛⬛🟨⬛\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 00:06:23',0,0,'daily'),(24,1,'2025-07-30','random','win',4,'DRAWN','[\"⬛⬛🟨⬛🟩\",\"🟨⬛🟨⬛🟩\",\"🟩🟩🟩⬛🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 00:09:06',0,0,'daily'),(25,1,'2025-07-30','random','win',5,'REPLY','[\"⬛🟩⬛⬛⬛\",\"⬛🟩⬛⬛⬛\",\"⬛🟩⬛🟩⬛\",\"⬛🟩⬛🟩🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 00:13:26',0,0,'daily'),(26,1,'2025-07-30','random','win',6,'GLIDE','[\"⬛🟨🟨⬛⬛\",\"⬛🟩🟨⬛⬛\",\"⬛🟩⬛⬛🟩\",\"⬛🟩⬛⬛🟩\",\"⬛🟩🟩⬛🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 00:17:10',0,0,'daily'),(27,1,'2025-07-30','daily','loss',6,'TRULY','[\"⬛🟩🟩⬛⬛\",\"⬛🟩🟩⬛⬛\",\"⬛🟩🟩⬛🟨\",\"⬛🟩🟩⬛🟨\",\"🟩🟩🟩⬛⬛\",\"🟩🟩🟩⬛⬛\"]','2025-07-30 08:13:22',3,0,'daily'),(28,1,'2025-07-30','random','win',4,'SHADE','[\"🟨⬛⬛⬛🟩\",\"⬛🟨🟨⬛🟩\",\"🟨⬛🟩⬛🟩\",\"🟩🟩🟩🟩🟩\"]','2025-07-30 09:15:03',0,0,'daily'),(29,1,'2025-07-30','daily','win',4,'TRULY','⬛⬛⬛⬛⬛\n⬛🟩🟩⬛⬛\n⬛🟩🟩⬛🟨\n🟩🟩🟩🟩🟩','2025-07-30 09:16:41',4,4,'daily'),(31,1,'2025-07-30','random','win',4,'EXIST','⬛⬛⬛🟨⬛\n⬛🟨🟩⬛⬛\n🟨⬛🟩⬛🟨\n🟩🟩🟩🟩🟩','2025-07-30 11:41:38',9,1,'daily'),(32,10,'2025-07-30','daily','win',5,'TRULY','🟩🟩⬛⬛⬛\n⬛⬛🟨🟨⬛\n⬛⬛⬛🟨🟨\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-07-30 22:36:25',3,3,'daily'),(33,13,'2025-07-30','daily','win',6,'TRULY','⬛⬛⬛⬛🟨\n⬛⬛🟨⬛🟨\n🟩⬛🟨🟨⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-07-30 23:33:12',2,2,'daily'),(34,10,'2025-07-31','daily','win',5,'FORTY','⬛🟨⬛🟨⬛\n🟨🟨🟨⬛⬛\n⬛🟩🟨⬛🟨\n⬛🟩🟩🟩⬛\n🟩🟩🟩🟩🟩','2025-07-31 20:55:14',4,4,'daily'),(35,13,'2025-07-31','daily','win',6,'FORTY','⬛⬛⬛⬛⬛\n⬛🟨⬛🟨🟨\n⬛🟨🟨🟩⬛\n⬛🟨🟨🟨🟩\n⬛⬛⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-07-31 22:05:46',3,3,'daily'),(36,13,'2025-07-31','random','win',4,'FELLA','⬛🟨⬛⬛⬛\n⬛🟩🟨⬛⬛\n🟨🟩⬛🟨🟨\n🟩🟩🟩🟩🟩','2025-07-31 22:10:28',1,1,'daily'),(37,1,'2025-08-01','daily','win',4,'DEITY','⬛⬛⬛⬛⬛\n⬛🟨⬛⬛🟩\n⬛🟩⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-08-01 05:39:18',9,2,'daily'),(38,13,'2025-08-01','daily','win',6,'DEITY','⬛🟩⬛⬛⬛\n⬛🟩⬛⬛⬛\n⬛🟩⬛⬛🟩\n🟨🟩🟨⬛🟩\n⬛🟩⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-08-01 18:26:06',4,4,'daily'),(39,13,'2025-08-01','random','win',5,'PAYEE','⬛⬛🟨⬛⬛\n⬛🟩🟨⬛🟨\n⬛🟩⬛🟨🟨\n🟨🟨⬛⬛🟨\n🟩🟩🟩🟩🟩','2025-08-01 18:33:06',2,2,'daily'),(40,13,'2025-08-02','daily','win',4,'UNCLE','⬛🟨⬛🟨⬛\n🟨⬛🟨⬛⬛\n⬛🟨⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-03 00:20:57',5,5,'daily'),(41,1,'2025-08-02','random','win',3,'BEACH','⬛⬛⬛⬛⬛\n⬛⬛⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-03 00:57:48',9,2,'daily'),(42,1,'2025-08-03','daily','win',3,'UNCLE','⬛🟨⬛🟨⬛\n🟨🟨⬛🟨🟩\n🟩🟩🟩🟩🟩','2025-08-03 01:00:50',9,1,'daily'),(43,1,'2025-08-07','daily','win',5,'LEMUR','🟨⬛🟨⬛⬛\n🟨⬛🟨⬛⬛\n⬛🟨🟨🟨⬛\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-07 16:36:14',9,1,'daily'),(44,1,'2025-08-08','daily','win',6,'DRAFT','🟨⬛⬛⬛⬛\n🟨⬛⬛⬛🟩\n⬛⬛🟩⬛🟩\n⬛⬛🟩🟨🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-08 20:47:00',9,2,'daily'),(45,10,'2025-08-08','daily','win',3,'DRAFT','⬛🟨⬛🟨⬛\n⬛⬛🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-08 23:37:14',4,1,'daily'),(46,13,'2025-08-08','daily','win',5,'DRAFT','🟨⬛⬛⬛⬛\n🟨🟨🟨⬛⬛\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-08 23:50:15',5,1,'daily'),(47,13,'2025-08-08','daily','win',5,'DRAFT','🟨⬛⬛⬛⬛\n🟨🟨🟨⬛⬛\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-08 23:50:15',5,1,'daily'),(48,1,'2025-08-08','daily','win',5,'DRAFT','⬛⬛🟨⬛⬛\n🟨⬛⬛🟨🟩\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 00:03:01',9,2,'daily'),(49,13,'2025-08-09','daily','win',5,'SLOPE','⬛⬛🟨⬛⬛\n🟩⬛🟨⬛🟨\n🟩🟨🟩⬛🟩\n🟩⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 15:31:23',5,2,'daily'),(50,10,'2025-08-09','daily','win',4,'SLOPE','🟩⬛🟨⬛⬛\n🟩🟨⬛⬛🟩\n🟩⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 15:35:16',4,2,'daily'),(51,10,'2025-08-09','random','win',5,'PUBIC','⬛⬛⬛⬛⬛\n⬛⬛⬛⬛⬛\n🟨🟩⬛⬛⬛\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 18:39:33',2,2,'daily'),(52,10,'2025-08-09','random','win',5,'GUILE','⬛⬛🟨⬛⬛\n⬛🟨🟩🟨⬛\n⬛⬛🟩🟩🟩\n⬛⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 19:02:39',3,3,'daily'),(53,14,'2025-08-09','daily','win',4,'SLOPE','⬛⬛⬛⬛🟨\n🟨⬛🟩🟩⬛\n🟨🟨⬛⬛⬛\n🟩🟩🟩🟩🟩','2025-08-09 19:43:06',1,1,'daily'),(54,1,'2025-08-09','random','win',6,'VOGUE','⬛🟩⬛⬛⬛\n⬛🟩⬛⬛⬛\n⬛🟩⬛⬛⬛\n⬛🟩⬛🟨🟩\n🟨🟩⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-09 23:17:56',9,3,'daily'),(55,10,'2025-08-09','random','win',4,'ALERT','⬛⬛🟩⬛🟩\n⬛🟨🟩🟨🟩\n🟩⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 23:20:41',4,4,'daily'),(56,13,'2025-08-09','random','win',4,'SAPPY','🟨🟩⬛⬛⬛\n⬛🟩⬛⬛⬛\n🟩🟩⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-09 23:22:43',3,3,'daily'),(57,10,'2025-08-09','random','win',4,'SEVEN','⬛🟩⬛🟨⬛\n🟩🟩⬛🟩⬛\n🟩🟩⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-08-09 23:26:43',5,5,'daily'),(58,13,'2025-08-09','random','win',6,'PLAZA','⬛🟨⬛⬛⬛\n⬛⬛🟩⬛⬛\n⬛🟩🟩⬛⬛\n⬛🟩🟩⬛⬛\n⬛🟩🟩🟩⬛\n🟩🟩🟩🟩🟩','2025-08-09 23:30:48',4,4,'daily'),(59,13,'2025-08-09','random','win',3,'RATIO','⬛🟨🟨🟨⬛\n⬛🟩🟩⬛🟨\n🟩🟩🟩🟩🟩','2025-08-09 23:34:12',5,5,'daily'),(60,10,'2025-08-09','random','win',5,'SNIFF','🟩⬛⬛⬛⬛\n🟩⬛⬛⬛⬛\n🟩⬛🟩⬛⬛\n🟩⬛🟩🟨⬛\n🟩🟩🟩🟩🟩','2025-08-09 23:40:07',6,6,'daily'),(61,10,'2025-08-09','random','win',4,'LEANT','⬛⬛🟨🟨🟩\n⬛🟩🟩⬛🟩\n🟩🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-09 23:54:58',7,7,'daily'),(62,10,'2025-08-10','daily','win',5,'ANNOY','⬛⬛⬛🟨⬛\n🟩⬛⬛⬛🟨\n🟩⬛⬛🟩⬛\n🟩⬛⬛🟩⬛\n🟩🟩🟩🟩🟩','2025-08-10 05:32:13',4,3,'daily'),(63,10,'2025-08-10','random','win',4,'REACH','⬛⬛🟨🟨⬛\n🟨⬛⬛⬛🟨\n🟨🟩🟩🟨⬛\n🟩🟩🟩🟩🟩','2025-08-10 05:35:28',8,8,'daily'),(64,10,'2025-08-10','random','win',3,'LEMUR','⬛🟨🟨⬛⬛\n🟩🟩⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-10 05:38:42',9,9,'daily'),(65,1,'2025-08-10','daily','win',3,'ANNOY','⬛⬛🟨🟨🟩\n🟩⬛🟨🟨🟩\n🟩🟩🟩🟩🟩','2025-08-10 10:41:15',9,1,'daily'),(66,10,'2025-08-10','random','win',4,'SPOKE','🟩⬛⬛⬛🟩\n🟩⬛⬛🟨🟩\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-08-10 17:29:44',10,10,'daily'),(67,10,'2025-08-10','random','win',3,'BEEFY','⬛⬛🟩⬛⬛\n🟨⬛🟩🟨⬛\n🟩🟩🟩🟩🟩','2025-08-10 17:41:00',11,11,'daily'),(68,10,'2025-08-11','daily','win',4,'LINGO','⬛⬛⬛⬛⬛\n⬛⬛🟨🟨⬛\n⬛⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-11 06:03:06',4,4,'daily'),(69,10,'2025-08-12','daily','win',3,'BLEAK','⬛⬛🟩🟩⬛\n⬛🟩🟩🟩⬛\n🟩🟩🟩🟩🟩','2025-08-12 01:27:01',5,5,'daily'),(70,1,'2025-08-12','daily','win',4,'BLEAK','⬛🟨⬛⬛⬛\n🟨🟨⬛⬛🟨\n🟩🟨⬛🟨🟨\n🟩🟩🟩🟩🟩','2025-08-12 13:47:34',9,1,'daily'),(71,13,'2025-08-12','daily','win',6,'BLEAK','⬛⬛⬛⬛🟨\n🟨🟨⬛⬛⬛\n⬛🟩🟩⬛⬛\n⬛🟩🟩🟩⬛\n🟩🟩🟩🟩⬛\n🟩🟩🟩🟩🟩','2025-08-12 15:45:22',5,1,'daily'),(72,10,'2025-08-13','daily','win',4,'DITTY','⬛🟨⬛⬛⬛\n⬛⬛⬛🟩⬛\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-13 01:36:52',6,6,'daily'),(73,10,'2025-08-13','random','win',5,'BRAND','⬛🟩🟩⬛🟨\n⬛🟩🟩🟩⬛\n⬛🟩🟩🟩⬛\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-13 01:45:02',12,12,'daily'),(74,1,'2025-08-13','daily','win',4,'DITTY','⬛⬛⬛⬛⬛\n⬛⬛🟨⬛⬛\n🟩🟩🟩🟩⬛\n🟩🟩🟩🟩🟩','2025-08-13 12:05:04',9,2,'daily'),(75,10,'2025-08-14','daily','win',6,'CURLY','⬛⬛⬛⬛⬛\n⬛🟨🟨⬛⬛\n🟨🟩⬛🟨⬛\n🟩🟩🟩⬛🟩\n🟩🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-14 06:51:52',7,7,'daily'),(76,1,'2025-08-14','daily','win',6,'CURLY','⬛⬛⬛⬛⬛\n⬛⬛⬛🟨⬛\n⬛⬛⬛🟨⬛\n🟩⬛🟨⬛⬛\n🟩🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-14 22:32:26',9,3,'daily'),(77,1,'2025-08-14','daily','win',5,'CURLY','⬛⬛⬛🟩🟩\n⬛⬛⬛🟩🟩\n⬛⬛⬛🟩🟩\n🟩⬛⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-08-15 00:29:25',9,3,'daily'),(78,10,'2025-08-15','daily','win',5,'CEDAR','⬛⬛🟨⬛⬛\n⬛🟩⬛⬛⬛\n⬛🟩⬛🟨🟨\n⬛🟩🟨🟨⬛\n🟩🟩🟩🟩🟩','2025-08-15 14:08:57',8,8,'daily'),(79,13,'2025-08-15','daily','win',4,'CEDAR','⬛⬛🟨⬛⬛\n🟩🟨⬛⬛🟨\n🟩🟨🟨🟩⬛\n🟩🟩🟩🟩🟩','2025-08-15 22:41:27',5,1,'daily'),(80,10,'2025-08-16','daily','win',4,'DIRGE','⬛⬛⬛⬛🟩\n⬛⬛⬛🟨🟩\n🟨🟨🟨⬛🟩\n🟩🟩🟩🟩🟩','2025-08-16 03:22:36',9,9,'daily'),(81,13,'2025-08-16','daily','win',6,'DIRGE','⬛⬛⬛⬛⬛\n⬛⬛⬛🟨🟨\n⬛⬛⬛🟨🟩\n⬛🟨🟨🟨🟩\n🟨🟩🟨🟩🟩\n🟩🟩🟩🟩🟩','2025-08-16 18:11:12',5,2,'daily'),(82,10,'2025-08-17','daily','win',3,'GROWN','⬛⬛⬛⬛🟨\n🟩🟨⬛🟨⬛\n🟩🟩🟩🟩🟩','2025-08-17 01:54:33',10,10,'daily'),(83,13,'2025-08-17','daily','win',6,'GROWN','⬛⬛⬛⬛⬛\n⬛⬛🟨⬛⬛\n⬛🟩🟩🟨⬛\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-17 23:53:49',5,3,'daily'),(84,10,'2025-08-18','daily','win',2,'HORDE','⬛🟨🟨⬛🟩\n🟩🟩🟩🟩🟩','2025-08-18 03:36:22',11,11,'daily'),(85,10,'2025-08-19','daily','win',4,'DROOL','⬛🟩⬛⬛⬛\n⬛🟩🟩⬛🟨\n🟩🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-19 05:40:23',12,12,'daily'),(86,10,'2025-08-20','daily','win',3,'SHUCK','🟩⬛⬛⬛⬛\n🟩⬛⬛⬛🟨\n🟩🟩🟩🟩🟩','2025-08-20 02:31:24',13,13,'daily'),(87,10,'2025-08-21','daily','win',3,'CRYPT','⬛🟨⬛⬛⬛\n⬛🟨🟨⬛🟨\n🟩🟩🟩🟩🟩','2025-08-21 12:24:13',14,14,'daily'),(88,10,'2025-08-21','random','win',4,'ALOFT','⬛🟨⬛🟨⬛\n🟩⬛🟨🟨⬛\n🟩🟩⬛🟨🟩\n🟩🟩🟩🟩🟩','2025-08-21 18:33:00',13,13,'daily'),(89,1,'2025-08-21','daily','win',4,'CRYPT','⬛⬛⬛⬛⬛\n🟩⬛⬛⬛⬛\n🟩⬛⬛⬛🟨\n🟩🟩🟩🟩🟩','2025-08-21 18:33:45',9,1,'daily'),(90,17,'2025-08-21','daily','win',4,'CRYPT','⬛⬛⬛🟨🟩\n⬛🟩⬛⬛🟩\n⬛🟩⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-21 21:00:10',1,1,'daily'),(91,10,'2025-08-22','daily','win',3,'CUMIN','⬛⬛⬛⬛🟨\n🟩⬛🟨🟨⬛\n🟩🟩🟩🟩🟩','2025-08-22 01:20:51',15,15,'daily'),(92,1,'2025-08-22','daily','win',3,'CUMIN','⬛⬛🟨🟨⬛\n⬛⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-22 09:46:51',9,2,'daily'),(94,10,'2025-08-23','daily','win',4,'STOCK','🟩🟩⬛⬛⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-08-23 16:56:46',16,16,'daily'),(95,10,'2025-08-23','daily','win',3,'STOCK','🟩🟩⬛⬛⬛\n🟩🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-24 00:20:20',16,16,'daily'),(96,1,'2025-08-24','daily','win',4,'GRAVY','🟨⬛⬛⬛⬛\n⬛🟨⬛⬛⬛\n⬛🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-24 07:48:33',9,1,'daily'),(97,1,'2025-08-24','daily','win',6,'GRAVY','🟨⬛⬛⬛⬛\n⬛⬛🟩⬛⬛\n⬛⬛🟩🟨⬛\n⬛🟩🟩⬛⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-08-25 00:04:03',9,1,'daily'),(98,10,'2025-08-24','daily','win',6,'GRAVY','⬛⬛⬛🟨⬛\n⬛⬛🟩⬛⬛\n⬛🟩🟩⬛⬛\n⬛🟩🟩⬛⬛\n🟩🟩🟩⬛⬛\n🟩🟩🟩🟩🟩','2025-08-25 00:57:17',17,17,'daily'),(99,19,'2025-08-25','daily','win',4,'LOCUS','⬛⬛⬛⬛⬛\n🟨🟩🟨⬛⬛\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-25 23:43:43',1,1,'daily'),(100,1,'2025-08-26','daily','win',5,'WIDER','⬛🟨⬛🟨⬛\n⬛🟨🟨🟨🟨\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-26 09:17:36',9,1,'daily'),(101,10,'2025-08-26','daily','win',3,'WIDER','⬛⬛🟨⬛⬛\n🟩🟨🟨🟨🟨\n🟩🟩🟩🟩🟩','2025-08-26 20:35:01',17,1,'daily'),(102,1,'2025-08-26','daily','win',3,'WIDER','⬛⬛🟨🟩🟩\n🟩⬛⬛🟩🟩\n🟩🟩🟩🟩🟩','2025-08-27 00:04:30',9,1,'daily'),(103,10,'2025-08-27','daily','win',5,'BREED','⬛⬛🟩⬛⬛\n⬛🟩🟩🟩⬛\n⬛🟩🟩🟩🟩\n⬛🟩🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-27 01:06:46',17,2,'daily'),(104,1,'2025-08-27','daily','win',3,'BREED','⬛🟨⬛⬛⬛\n🟩⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-28 00:37:41',9,2,'daily'),(105,10,'2025-08-28','daily','win',6,'QUITE','⬛🟨🟨⬛⬛\n⬛⬛🟨🟩🟩\n🟨⬛🟩🟩🟩\n🟨⬛🟩🟩🟩\n🟨⬛🟩🟩🟩\n🟩🟩🟩🟩🟩','2025-08-28 01:12:42',NULL,NULL,'daily'),(106,1,'2025-08-28','daily','win',5,'QUITE','⬛⬛⬛🟨⬛\n⬛🟨⬛⬛🟩\n⬛⬛🟩⬛🟩\n⬛🟩🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-29 00:08:38',9,3,'daily'),(107,10,'2025-08-29','daily','win',5,'CHAFE','⬛⬛🟨🟨⬛\n⬛⬛🟩⬛🟩\n⬛⬛🟩⬛🟩\n🟨⬛🟩⬛🟩\n🟩🟩🟩🟩🟩','2025-08-30 00:13:48',1,1,'daily'),(108,1,'2025-08-30','daily','win',3,'CACHE','🟨⬛⬛⬛⬛\n⬛🟩⬛⬛🟩\n🟩🟩🟩🟩🟩','2025-08-30 09:38:15',9,1,'daily');
/*!40000 ALTER TABLE `game_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_log`
--

DROP TABLE IF EXISTS `ip_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ip_log` (
  `ip_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_log`
--

LOCK TABLES `ip_log` WRITE;
/*!40000 ALTER TABLE `ip_log` DISABLE KEYS */;
INSERT INTO `ip_log` VALUES (1,2,'::1','2023-05-03 08:35:02'),(2,2,'::1','2023-05-03 10:21:04'),(3,2,'::1','2023-05-03 10:23:23'),(4,2,'::1','2023-05-04 07:40:10'),(5,2,'::1','2023-05-04 15:19:07'),(6,2,'::1','2023-05-05 07:43:31'),(7,2,'::1','2023-05-06 10:05:37'),(8,2,'::1','2023-05-09 08:08:44'),(9,2,'::1','2023-05-09 08:48:43'),(10,2,'::1','2023-05-10 07:30:04'),(11,2,'::1','2023-05-10 11:14:08'),(12,2,'::1','2023-05-10 14:15:40'),(13,2,'::1','2023-05-10 14:20:28'),(14,2,'::1','2023-05-10 14:22:59'),(15,2,'::1','2023-05-10 14:24:38'),(16,2,'::1','2023-05-11 07:46:07'),(17,2,'::1','2023-05-11 13:18:12'),(18,2,'::1','2023-05-11 13:28:45'),(19,2,'::1','2023-05-12 09:23:33'),(20,2,'::1','2023-05-12 10:14:07'),(21,2,'::1','2023-05-12 10:29:00'),(22,2,'::1','2023-05-12 11:00:54'),(23,2,'::1','2023-05-12 11:03:46'),(24,2,'::1','2023-05-12 12:37:55'),(25,2,'::1','2023-05-12 12:40:50'),(26,2,'::1','2023-05-16 07:46:45'),(27,2,'::1','2023-05-16 09:07:08'),(28,2,'::1','2023-05-17 10:01:36'),(29,2,'::1','2023-05-17 13:30:49'),(30,2,'::1','2023-05-17 13:35:34'),(31,2,'::1','2023-05-17 13:35:49'),(32,2,'::1','2023-05-17 13:37:16'),(33,9,'::1','2023-05-18 14:43:33'),(34,17,'::1','2023-05-22 14:14:14'),(35,8,'::1','2023-05-29 07:52:02'),(36,18,'::1','2023-05-31 11:43:01'),(37,2,'86.15.90.112','2023-06-14 09:55:15'),(38,2,'172.224.224.48','2023-06-21 10:07:31'),(39,8,'86.15.88.61','2023-06-28 10:50:06'),(40,2,'86.15.88.61','2023-06-28 10:58:39'),(41,33,'86.15.88.61','2023-06-28 11:04:29');
/*!40000 ALTER TABLE `ip_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `nsfw` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_lock`
--

DROP TABLE IF EXISTS `migration_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration_lock` (
  `id` int(11) NOT NULL DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `locked_at` timestamp NULL DEFAULT NULL,
  `locked_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_lock`
--

LOCK TABLES `migration_lock` WRITE;
/*!40000 ALTER TABLE `migration_lock` DISABLE KEYS */;
INSERT INTO `migration_lock` VALUES (1,0,NULL,NULL);
/*!40000 ALTER TABLE `migration_lock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applied_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'002_create_users_table.php','2025-08-20 15:13:11','barry@Caledonia-Digital.local'),(2,'003_drop_display_name_from_users.php','2025-08-20 15:13:11','barry@Caledonia-Digital.local'),(3,'004_add_applied_by_to_migrations.php','2025-08-20 15:13:11','barry@Caledonia-Digital.local'),(4,'005_create_migration_lock_table.php','2025-08-20 15:13:11','barry@Caledonia-Digital.local'),(5,'006_create_links_table.php','2025-08-20 15:13:11','barry@Caledonia-Digital.local');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rank`
--

DROP TABLE IF EXISTS `rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rank` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `title` varchar(23) NOT NULL,
  `level` int(3) DEFAULT '0',
  `admin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rank`
--

LOCK TABLES `rank` WRITE;
/*!40000 ALTER TABLE `rank` DISABLE KEYS */;
INSERT INTO `rank` VALUES (1,1,'Admin',100,1);
/*!40000 ALTER TABLE `rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rank_info`
--

DROP TABLE IF EXISTS `rank_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rank_info` (
  `ri_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(50) NOT NULL,
  PRIMARY KEY (`ri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rank_info`
--

LOCK TABLES `rank_info` WRITE;
/*!40000 ALTER TABLE `rank_info` DISABLE KEYS */;
INSERT INTO `rank_info` VALUES (1,'Admin!'),(2,'TCH Staff'),(3,'Medical Staff');
/*!40000 ALTER TABLE `rank_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset`
--

LOCK TABLES `reset` WRITE;
/*!40000 ALTER TABLE `reset` DISABLE KEYS */;
INSERT INTO `reset` VALUES (39,1,'bb7384d9fa673685d807d2476700218bdb51e28aa6202faefd2116161c24ebe8','2025-08-21 15:58:31','2025-08-21 17:58:31');
/*!40000 ALTER TABLE `reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `base_url` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `app_title` varchar(150) NOT NULL,
  `app_tag` varchar(150) NOT NULL,
  `home_login` int(1) NOT NULL DEFAULT '1',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_register` int(1) NOT NULL DEFAULT '1',
  `cookie_warning` int(1) NOT NULL DEFAULT '1',
  `salt` varchar(255) NOT NULL,
  `app_email` varchar(120) NOT NULL,
  `session_prefix` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'https://crm.comparicare.co.uk',2,'Comparicare','Affordable healthcare at your fingertips',1,'2022-04-19 21:49:57',0,0,'0SRzGjsIi.OuEd9,sh*u5p[_nZ>^3dTrCN)BYMzd6N5ihKBbRc@H;l7EQzrb@Vxt','divinorum2001@gmail.com','HCRM_');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activation`
--

DROP TABLE IF EXISTS `user_activation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_activation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `entry_date` datetime NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activation`
--

LOCK TABLES `user_activation` WRITE;
/*!40000 ALTER TABLE `user_activation` DISABLE KEYS */;
INSERT INTO `user_activation` VALUES (14,16,'7987e1e3fbdc24d97af6892318b2dde2b180aa64c90f231c76d60d08bb2f453b','2025-08-10 12:02:01','2025-08-11 12:02:01'),(15,17,'b2fa7e97d856c4e659ff68f4f1cbd1af9856a47926a92bb4b320fe130abd4ed8','2025-08-10 12:05:46','2025-08-11 12:05:46'),(18,18,'0f7c4ca4109105968369b43ad4af4c44c6789e42a1b3967b6f249687c82dd8f3','2025-08-23 00:11:10','2025-08-24 00:11:10');
/*!40000 ALTER TABLE `user_activation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_correct_words`
--

DROP TABLE IF EXISTS `user_correct_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_correct_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `word` varchar(10) NOT NULL,
  `guessed_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_correct_words`
--

LOCK TABLES `user_correct_words` WRITE;
/*!40000 ALTER TABLE `user_correct_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_correct_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `security_hash` varchar(255) NOT NULL,
  `avatar` varchar(120) DEFAULT 'assets/images/blank_user.png',
  `rank` int(1) NOT NULL DEFAULT '0',
  `is_admin` int(1) DEFAULT '0',
  `sys_admin` int(1) DEFAULT '0',
  `last_access` datetime DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `date` date DEFAULT NULL,
  `dead_switch` int(1) DEFAULT '0',
  `avatar_color` varchar(10) DEFAULT NULL,
  `correct_answers_count` int(11) DEFAULT '0',
  `reputation_points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Lazysod','divinorum2001@gmail.com','$2y$12$AVOTtNsK6THpWp86ds2.2ekULICrVZ3yJ9UVG5zjwQsgCF1QjYuPK',NULL,'eadee2397845d6a762b373238264fe14','app/uploads/users/avatar/1/smile.png',1,1,0,'2025-08-30 09:37:17',1,NULL,0,'indigo',0,0),(7,'albaweb','admin@albaweb.net','$2y$12$0hY.dRZo5q4aUhHfQ6ShrOCUC/iyfK9CNhMG9zvyvCQ5tWLYIaK9e',NULL,'$2y$12$PjI2LdUoNQ69IsXRnXaDNO9OAPOu2ZBD1OP3FCAA5BxsOqvwtc0J2','app/img/default.png',0,0,0,'2025-07-22 12:24:16',1,'2025-07-22',0,NULL,0,0),(8,'ghost','divinorum2001+test@gmail.com','$2y$12$LSyF1d.NXEXHE5W5ZtOwAOxf7LPL.JuDlc08uZexQyqfVTRAkJgfO',NULL,'ccad5156a4deac5f671b9fde87887165','assets/images/blank_user.png',0,0,0,'2025-07-28 00:18:25',1,NULL,0,NULL,0,0),(9,'sara','sara@albaweb.net','$2y$12$NwGtgwqYUHXhbtSbJSzsFeYVf/sbCCgTaVntOQdqq82EUNO4ALeca',NULL,'cd53c8e97fbd5904973240e473957bbc','assets/images/blank_user.png',0,0,0,'2025-07-30 08:57:14',1,NULL,0,NULL,0,0),(10,'Coinneach','coinneachmacanndrais@gmail.com','$2y$12$r1wVj7gRXv.OmVpyDJXIXOnCZpFaHWWjr2DepTCJ0OeF8yyOJHaEO',NULL,'70ebf7b5dbd67b11c9dc714639d679c7','assets/images/blank_user.png',0,0,0,'2025-08-30 01:10:47',1,NULL,0,NULL,0,0),(11,'Debbie','debbie.kirkpatrick1@googlemail.com','$2y$12$sPoF8mOrRhnUsxcICqZAveExG9GQsoDpqhdDn7y1mZFxW8/SUDmGS',NULL,'86eb184a5688033e5af15091810c2dc4','assets/images/blank_user.png',0,0,0,'2025-07-28 14:02:11',1,NULL,0,NULL,0,0),(12,'Scruffy','xwl8rak3o@mozmail.com','$2y$12$Pi8VGC8nr8UD1fPAoCuUiOGBHeqacdI.BbhG6tNAGYF1ej/Uvy4YW',NULL,'46ac64c7c44b66dc143c02fb539c49be','assets/images/blank_user.png',0,0,0,'2025-07-28 19:41:12',1,NULL,0,NULL,0,0),(13,'Lisa','lisawilliams_@live.com','$2y$12$.rPzJcqA1HsG.niPt.Aj0eI5TExNb9.c0P9MgPmvPLnxw6E6dI6/y',NULL,'f3e9c67a98cdd472bf835d76e948256b','assets/images/blank_user.png',0,0,0,'2025-08-17 23:52:29',1,NULL,0,NULL,0,0),(14,'Peace','kelly.warrillow@yahoo.co.uk','$2y$12$qaemxwuOCimBSDdkML65S.BO.8BJ3IKpzaqLwdj/hknznpJUxjoPy',NULL,'939952e14a99d14867e45c6b13d21880','assets/images/blank_user.png',0,0,0,'2025-08-09 19:30:34',1,NULL,0,NULL,0,0),(15,'gazzatron','garrylaing@gmail.com','$2y$12$7I.tGsV3S9VhmYr8akr4iO/xbgctz4m7.8MN83oFdm8GcN0JKl20i',NULL,'79dc2c6b60b35a2af27aa392b4de4ea9','assets/images/blank_user.png',0,0,0,'2025-08-07 16:10:42',1,NULL,0,NULL,0,0),(17,'ZombiWorkshop','zombiworkshop@yahoo.co.uk','$2y$12$MlPDwehgyGlpVOFe2Cnqw.WlIuHcdaQ2UlzHCKUM/tZX0z9zF2yh6',NULL,'c7ec0e1429bd1d3e401d09bd084f2fb1','assets/images/blank_user.png',0,0,0,'2025-08-22 13:45:20',1,NULL,0,NULL,0,0),(18,'kieran','kieran.macneil000@gmail.com','$2y$12$hsfFJGQjGO8uervEMMzkwuErKugpQuMHpKuVvYBxu3PhtqSJTy16e',NULL,'c78e16655f836e017dc80fc0f873313e','assets/images/blank_user.png',0,0,0,NULL,0,NULL,0,NULL,0,0),(19,'Mo','saorsascot@gmail.com','$2y$12$qV1xbjgzUvKQhAyDeXsz/uNH.ADMzNmHOFLm1a/IDZmr9oQMsQXp6',NULL,'2446a773373673ca19d2333bb4937076','assets/images/blank_user.png',0,0,0,'2025-08-25 23:39:11',1,NULL,0,NULL,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `word_list`
--

DROP TABLE IF EXISTS `word_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `word_list` (
  `word_id` int(255) NOT NULL AUTO_INCREMENT,
  `word` varchar(12) NOT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2317 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `word_list`
--

LOCK TABLES `word_list` WRITE;
/*!40000 ALTER TABLE `word_list` DISABLE KEYS */;
INSERT INTO `word_list` VALUES (1,'cigar'),(2,'rebut'),(3,'sissy'),(4,'humph'),(5,'awake'),(6,'blush'),(7,'focal'),(8,'evade'),(9,'naval'),(10,'serve'),(11,'heath'),(12,'dwarf'),(13,'model'),(14,'karma'),(15,'stink'),(16,'grade'),(17,'quiet'),(18,'bench'),(19,'abate'),(20,'feign'),(21,'major'),(22,'death'),(23,'fresh'),(24,'crust'),(25,'stool'),(26,'colon'),(27,'abase'),(28,'marry'),(29,'react'),(30,'batty'),(31,'pride'),(32,'floss'),(33,'helix'),(34,'croak'),(35,'staff'),(36,'paper'),(37,'unfed'),(38,'whelp'),(39,'trawl'),(40,'outdo'),(41,'adobe'),(42,'crazy'),(43,'sower'),(44,'repay'),(45,'digit'),(46,'crate'),(47,'cluck'),(48,'spike'),(49,'mimic'),(50,'pound'),(51,'maxim'),(52,'linen'),(53,'unmet'),(54,'flesh'),(55,'booby'),(56,'forth'),(57,'first'),(58,'stand'),(59,'belly'),(60,'ivory'),(61,'seedy'),(62,'print'),(63,'yearn'),(64,'drain'),(65,'bribe'),(66,'stout'),(67,'panel'),(68,'crass'),(69,'flume'),(70,'offal'),(71,'agree'),(72,'error'),(73,'swirl'),(74,'argue'),(75,'bleed'),(76,'delta'),(77,'flick'),(78,'totem'),(79,'wooer'),(80,'front'),(81,'shrub'),(82,'parry'),(83,'biome'),(84,'lapel'),(85,'start'),(86,'greet'),(87,'goner'),(88,'golem'),(89,'lusty'),(90,'loopy'),(91,'round'),(92,'audit'),(93,'lying'),(94,'gamma'),(95,'labor'),(96,'islet'),(97,'civic'),(98,'forge'),(99,'corny'),(100,'moult'),(101,'basic'),(102,'salad'),(103,'agate'),(104,'spicy'),(105,'spray'),(106,'essay'),(107,'fjord'),(108,'spend'),(109,'kebab'),(110,'guild'),(111,'aback'),(112,'motor'),(113,'alone'),(114,'hatch'),(115,'hyper'),(116,'thumb'),(117,'dowry'),(118,'ought'),(119,'belch'),(120,'dutch'),(121,'pilot'),(122,'tweed'),(123,'comet'),(124,'jaunt'),(125,'enema'),(126,'steed'),(127,'abyss'),(128,'growl'),(129,'fling'),(130,'dozen'),(131,'boozy'),(132,'erode'),(133,'world'),(134,'gouge'),(135,'click'),(136,'briar'),(137,'great'),(138,'altar'),(139,'pulpy'),(140,'blurt'),(141,'coast'),(142,'duchy'),(143,'groin'),(144,'fixer'),(145,'group'),(146,'rogue'),(147,'badly'),(148,'smart'),(149,'pithy'),(150,'gaudy'),(151,'chill'),(152,'heron'),(153,'vodka'),(154,'finer'),(155,'surer'),(156,'radio'),(157,'rouge'),(158,'perch'),(159,'retch'),(160,'wrote'),(161,'clock'),(162,'tilde'),(163,'store'),(164,'prove'),(165,'bring'),(166,'solve'),(167,'cheat'),(168,'grime'),(169,'exult'),(170,'usher'),(171,'epoch'),(172,'triad'),(173,'break'),(174,'rhino'),(175,'viral'),(176,'conic'),(177,'masse'),(178,'sonic'),(179,'vital'),(180,'trace'),(181,'using'),(182,'peach'),(183,'champ'),(184,'baton'),(185,'brake'),(186,'pluck'),(187,'craze'),(188,'gripe'),(189,'weary'),(190,'picky'),(191,'acute'),(192,'ferry'),(193,'aside'),(194,'tapir'),(195,'troll'),(196,'unify'),(197,'rebus'),(198,'boost'),(199,'truss'),(200,'siege'),(201,'tiger'),(202,'banal'),(203,'slump'),(204,'crank'),(205,'gorge'),(206,'query'),(207,'drink'),(208,'favor'),(209,'abbey'),(210,'tangy'),(211,'panic'),(212,'solar'),(213,'shire'),(214,'proxy'),(215,'point'),(216,'robot'),(217,'prick'),(218,'wince'),(219,'crimp'),(220,'knoll'),(221,'sugar'),(222,'whack'),(223,'mount'),(224,'perky'),(225,'could'),(226,'wrung'),(227,'light'),(228,'those'),(229,'moist'),(230,'shard'),(231,'pleat'),(232,'aloft'),(233,'skill'),(234,'elder'),(235,'frame'),(236,'humor'),(237,'pause'),(238,'ulcer'),(239,'ultra'),(240,'robin'),(241,'cynic'),(242,'agora'),(243,'aroma'),(244,'caulk'),(245,'shake'),(246,'pupal'),(247,'dodge'),(248,'swill'),(249,'tacit'),(250,'other'),(251,'thorn'),(252,'trove'),(253,'bloke'),(254,'vivid'),(255,'spill'),(256,'chant'),(257,'choke'),(258,'rupee'),(259,'nasty'),(260,'mourn'),(261,'ahead'),(262,'brine'),(263,'cloth'),(264,'hoard'),(265,'sweet'),(266,'month'),(267,'lapse'),(268,'watch'),(269,'today'),(270,'focus'),(271,'smelt'),(272,'tease'),(273,'cater'),(274,'movie'),(275,'lynch'),(276,'saute'),(277,'allow'),(278,'renew'),(279,'their'),(280,'slosh'),(281,'purge'),(282,'chest'),(283,'depot'),(284,'epoxy'),(285,'nymph'),(286,'found'),(287,'shall'),(288,'harry'),(289,'stove'),(290,'lowly'),(291,'snout'),(292,'trope'),(293,'fewer'),(294,'shawl'),(295,'natal'),(296,'fibre'),(297,'comma'),(298,'foray'),(299,'scare'),(300,'stair'),(301,'black'),(302,'squad'),(303,'royal'),(304,'chunk'),(305,'mince'),(306,'slave'),(307,'shame'),(308,'cheek'),(309,'ample'),(310,'flair'),(311,'foyer'),(312,'cargo'),(313,'oxide'),(314,'plant'),(315,'olive'),(316,'inert'),(317,'askew'),(318,'heist'),(319,'shown'),(320,'zesty'),(321,'hasty'),(322,'trash'),(323,'fella'),(324,'larva'),(325,'forgo'),(326,'story'),(327,'hairy'),(328,'train'),(329,'homer'),(330,'badge'),(331,'midst'),(332,'canny'),(333,'fetus'),(334,'butch'),(335,'farce'),(336,'slung'),(337,'tipsy'),(338,'metal'),(339,'yield'),(340,'delve'),(341,'being'),(342,'scour'),(343,'glass'),(344,'gamer'),(345,'scrap'),(346,'money'),(347,'hinge'),(348,'album'),(349,'vouch'),(350,'asset'),(351,'tiara'),(352,'crept'),(353,'bayou'),(354,'atoll'),(355,'manor'),(356,'creak'),(357,'showy'),(358,'phase'),(359,'froth'),(360,'depth'),(361,'gloom'),(362,'flood'),(363,'trait'),(364,'girth'),(365,'piety'),(366,'payer'),(367,'goose'),(368,'float'),(369,'donor'),(370,'atone'),(371,'primo'),(372,'apron'),(373,'blown'),(374,'cacao'),(375,'loser'),(376,'input'),(377,'gloat'),(378,'awful'),(379,'brink'),(380,'smite'),(381,'beady'),(382,'rusty'),(383,'retro'),(384,'droll'),(385,'gawky'),(386,'hutch'),(387,'pinto'),(388,'gaily'),(389,'egret'),(390,'lilac'),(391,'sever'),(392,'field'),(393,'fluff'),(394,'hydro'),(395,'flack'),(396,'agape'),(397,'wench'),(398,'voice'),(399,'stead'),(400,'stalk'),(401,'berth'),(402,'madam'),(403,'night'),(404,'bland'),(405,'liver'),(406,'wedge'),(407,'augur'),(408,'roomy'),(409,'wacky'),(410,'flock'),(411,'angry'),(412,'bobby'),(413,'trite'),(414,'aphid'),(415,'tryst'),(416,'midge'),(417,'power'),(418,'elope'),(419,'cinch'),(420,'motto'),(421,'stomp'),(422,'upset'),(423,'bluff'),(424,'cramp'),(425,'quart'),(426,'coyly'),(427,'youth'),(428,'rhyme'),(429,'buggy'),(430,'alien'),(431,'smear'),(432,'unfit'),(433,'patty'),(434,'cling'),(435,'glean'),(436,'label'),(437,'hunky'),(438,'khaki'),(439,'poker'),(440,'gruel'),(441,'twice'),(442,'twang'),(443,'shrug'),(444,'treat'),(445,'unlit'),(446,'waste'),(447,'merit'),(448,'woven'),(449,'octal'),(450,'needy'),(451,'clown'),(452,'widow'),(453,'irony'),(454,'ruder'),(455,'gauze'),(456,'chief'),(457,'onset'),(458,'prize'),(459,'fungi'),(460,'charm'),(461,'gully'),(462,'inter'),(463,'whoop'),(464,'taunt'),(465,'leery'),(466,'class'),(467,'theme'),(468,'lofty'),(469,'tibia'),(470,'booze'),(471,'alpha'),(472,'thyme'),(473,'eclat'),(474,'doubt'),(475,'parer'),(476,'chute'),(477,'stick'),(478,'trice'),(479,'alike'),(480,'sooth'),(481,'recap'),(482,'saint'),(483,'liege'),(484,'glory'),(485,'grate'),(486,'admit'),(487,'brisk'),(488,'soggy'),(489,'usurp'),(490,'scald'),(491,'scorn'),(492,'leave'),(493,'twine'),(494,'sting'),(495,'bough'),(496,'marsh'),(497,'sloth'),(498,'dandy'),(499,'vigor'),(500,'howdy'),(501,'enjoy'),(502,'valid'),(503,'ionic'),(504,'equal'),(505,'unset'),(506,'floor'),(507,'catch'),(508,'spade'),(509,'stein'),(510,'exist'),(511,'quirk'),(512,'denim'),(513,'grove'),(514,'spiel'),(515,'mummy'),(516,'fault'),(517,'foggy'),(518,'flout'),(519,'carry'),(520,'sneak'),(521,'libel'),(522,'waltz'),(523,'aptly'),(524,'piney'),(525,'inept'),(526,'aloud'),(527,'photo'),(528,'dream'),(529,'stale'),(530,'vomit'),(531,'ombre'),(532,'fanny'),(533,'unite'),(534,'snarl'),(535,'baker'),(536,'there'),(537,'glyph'),(538,'pooch'),(539,'hippy'),(540,'spell'),(541,'folly'),(542,'louse'),(543,'gulch'),(544,'vault'),(545,'godly'),(546,'threw'),(547,'fleet'),(548,'grave'),(549,'inane'),(550,'shock'),(551,'crave'),(552,'spite'),(553,'valve'),(554,'skimp'),(555,'claim'),(556,'rainy'),(557,'musty'),(558,'pique'),(559,'daddy'),(560,'quasi'),(561,'arise'),(562,'aging'),(563,'valet'),(564,'opium'),(565,'avert'),(566,'stuck'),(567,'recut'),(568,'mulch'),(569,'genre'),(570,'plume'),(571,'rifle'),(572,'count'),(573,'incur'),(574,'total'),(575,'wrest'),(576,'mocha'),(577,'deter'),(578,'study'),(579,'lover'),(580,'safer'),(581,'rivet'),(582,'funny'),(583,'smoke'),(584,'mound'),(585,'undue'),(586,'sedan'),(587,'pagan'),(588,'swine'),(589,'guile'),(590,'gusty'),(591,'equip'),(592,'tough'),(593,'canoe'),(594,'chaos'),(595,'covet'),(596,'human'),(597,'udder'),(598,'lunch'),(599,'blast'),(600,'stray'),(601,'manga'),(602,'melee'),(603,'lefty'),(604,'quick'),(605,'paste'),(606,'given'),(607,'octet'),(608,'risen'),(609,'groan'),(610,'leaky'),(611,'grind'),(612,'carve'),(613,'loose'),(614,'sadly'),(615,'spilt'),(616,'apple'),(617,'slack'),(618,'honey'),(619,'final'),(620,'sheen'),(621,'eerie'),(622,'minty'),(623,'slick'),(624,'derby'),(625,'wharf'),(626,'spelt'),(627,'coach'),(628,'erupt'),(629,'singe'),(630,'price'),(631,'spawn'),(632,'fairy'),(633,'jiffy'),(634,'filmy'),(635,'stack'),(636,'chose'),(637,'sleep'),(638,'ardor'),(639,'nanny'),(640,'niece'),(641,'woozy'),(642,'handy'),(643,'grace'),(644,'ditto'),(645,'stank'),(646,'cream'),(647,'usual'),(648,'diode'),(649,'valor'),(650,'angle'),(651,'ninja'),(652,'muddy'),(653,'chase'),(654,'reply'),(655,'prone'),(656,'spoil'),(657,'heart'),(658,'shade'),(659,'diner'),(660,'arson'),(661,'onion'),(662,'sleet'),(663,'dowel'),(664,'couch'),(665,'palsy'),(666,'bowel'),(667,'smile'),(668,'evoke'),(669,'creek'),(670,'lance'),(671,'eagle'),(672,'idiot'),(673,'siren'),(674,'built'),(675,'embed'),(676,'award'),(677,'dross'),(678,'annul'),(679,'goody'),(680,'frown'),(681,'patio'),(682,'laden'),(683,'humid'),(684,'elite'),(685,'lymph'),(686,'edify'),(687,'might'),(688,'reset'),(689,'visit'),(690,'gusto'),(691,'purse'),(692,'vapor'),(693,'crock'),(694,'write'),(695,'sunny'),(696,'loath'),(697,'chaff'),(698,'slide'),(699,'queer'),(700,'venom'),(701,'stamp'),(702,'sorry'),(703,'still'),(704,'acorn'),(705,'aping'),(706,'pushy'),(707,'tamer'),(708,'hater'),(709,'mania'),(710,'awoke'),(711,'brawn'),(712,'swift'),(713,'exile'),(714,'birch'),(715,'lucky'),(716,'freer'),(717,'risky'),(718,'ghost'),(719,'plier'),(720,'lunar'),(721,'winch'),(722,'snare'),(723,'nurse'),(724,'house'),(725,'borax'),(726,'nicer'),(727,'lurch'),(728,'exalt'),(729,'about'),(730,'savvy'),(731,'toxin'),(732,'tunic'),(733,'pried'),(734,'inlay'),(735,'chump'),(736,'lanky'),(737,'cress'),(738,'eater'),(739,'elude'),(740,'cycle'),(741,'kitty'),(742,'boule'),(743,'moron'),(744,'tenet'),(745,'place'),(746,'lobby'),(747,'plush'),(748,'vigil'),(749,'index'),(750,'blink'),(751,'clung'),(752,'qualm'),(753,'croup'),(754,'clink'),(755,'juicy'),(756,'stage'),(757,'decay'),(758,'nerve'),(759,'flier'),(760,'shaft'),(761,'crook'),(762,'clean'),(763,'china'),(764,'ridge'),(765,'vowel'),(766,'gnome'),(767,'snuck'),(768,'icing'),(769,'spiny'),(770,'rigor'),(771,'snail'),(772,'flown'),(773,'rabid'),(774,'prose'),(775,'thank'),(776,'poppy'),(777,'budge'),(778,'fiber'),(779,'moldy'),(780,'dowdy'),(781,'kneel'),(782,'track'),(783,'caddy'),(784,'quell'),(785,'dumpy'),(786,'paler'),(787,'swore'),(788,'rebar'),(789,'scuba'),(790,'splat'),(791,'flyer'),(792,'horny'),(793,'mason'),(794,'doing'),(795,'ozone'),(796,'amply'),(797,'molar'),(798,'ovary'),(799,'beset'),(800,'queue'),(801,'cliff'),(802,'magic'),(803,'truce'),(804,'sport'),(805,'fritz'),(806,'edict'),(807,'twirl'),(808,'verse'),(809,'llama'),(810,'eaten'),(811,'range'),(812,'whisk'),(813,'hovel'),(814,'rehab'),(815,'macaw'),(816,'sigma'),(817,'spout'),(818,'verve'),(819,'sushi'),(820,'dying'),(821,'fetid'),(822,'brain'),(823,'buddy'),(824,'thump'),(825,'scion'),(826,'candy'),(827,'chord'),(828,'basin'),(829,'march'),(830,'crowd'),(831,'arbor'),(832,'gayly'),(833,'musky'),(834,'stain'),(835,'dally'),(836,'bless'),(837,'bravo'),(838,'stung'),(839,'title'),(840,'ruler'),(841,'kiosk'),(842,'blond'),(843,'ennui'),(844,'layer'),(845,'fluid'),(846,'tatty'),(847,'score'),(848,'cutie'),(849,'zebra'),(850,'barge'),(851,'matey'),(852,'bluer'),(853,'aider'),(854,'shook'),(855,'river'),(856,'privy'),(857,'betel'),(858,'frisk'),(859,'bongo'),(860,'begun'),(861,'azure'),(862,'weave'),(863,'genie'),(864,'sound'),(865,'glove'),(866,'braid'),(867,'scope'),(868,'wryly'),(869,'rover'),(870,'assay'),(871,'ocean'),(872,'bloom'),(873,'irate'),(874,'later'),(875,'woken'),(876,'silky'),(877,'wreck'),(878,'dwelt'),(879,'slate'),(880,'smack'),(881,'solid'),(882,'amaze'),(883,'hazel'),(884,'wrist'),(885,'jolly'),(886,'globe'),(887,'flint'),(888,'rouse'),(889,'civil'),(890,'vista'),(891,'relax'),(892,'cover'),(893,'alive'),(894,'beech'),(895,'jetty'),(896,'bliss'),(897,'vocal'),(898,'often'),(899,'dolly'),(900,'eight'),(901,'joker'),(902,'since'),(903,'event'),(904,'ensue'),(905,'shunt'),(906,'diver'),(907,'poser'),(908,'worst'),(909,'sweep'),(910,'alley'),(911,'creed'),(912,'anime'),(913,'leafy'),(914,'bosom'),(915,'dunce'),(916,'stare'),(917,'pudgy'),(918,'waive'),(919,'choir'),(920,'stood'),(921,'spoke'),(922,'outgo'),(923,'delay'),(924,'bilge'),(925,'ideal'),(926,'clasp'),(927,'seize'),(928,'hotly'),(929,'laugh'),(930,'sieve'),(931,'block'),(932,'meant'),(933,'grape'),(934,'noose'),(935,'hardy'),(936,'shied'),(937,'drawl'),(938,'daisy'),(939,'putty'),(940,'strut'),(941,'burnt'),(942,'tulip'),(943,'crick'),(944,'idyll'),(945,'vixen'),(946,'furor'),(947,'geeky'),(948,'cough'),(949,'naive'),(950,'shoal'),(951,'stork'),(952,'bathe'),(953,'aunty'),(954,'check'),(955,'prime'),(956,'brass'),(957,'outer'),(958,'furry'),(959,'razor'),(960,'elect'),(961,'evict'),(962,'imply'),(963,'demur'),(964,'quota'),(965,'haven'),(966,'cavil'),(967,'swear'),(968,'crump'),(969,'dough'),(970,'gavel'),(971,'wagon'),(972,'salon'),(973,'nudge'),(974,'harem'),(975,'pitch'),(976,'sworn'),(977,'pupil'),(978,'excel'),(979,'stony'),(980,'cabin'),(981,'unzip'),(982,'queen'),(983,'trout'),(984,'polyp'),(985,'earth'),(986,'storm'),(987,'until'),(988,'taper'),(989,'enter'),(990,'child'),(991,'adopt'),(992,'minor'),(993,'fatty'),(994,'husky'),(995,'brave'),(996,'filet'),(997,'slime'),(998,'glint'),(999,'tread'),(1000,'steal'),(1001,'regal'),(1002,'guest'),(1003,'every'),(1004,'murky'),(1005,'share'),(1006,'spore'),(1007,'hoist'),(1008,'buxom'),(1009,'inner'),(1010,'otter'),(1011,'dimly'),(1012,'level'),(1013,'sumac'),(1014,'donut'),(1015,'stilt'),(1016,'arena'),(1017,'sheet'),(1018,'scrub'),(1019,'fancy'),(1020,'slimy'),(1021,'pearl'),(1022,'silly'),(1023,'porch'),(1024,'dingo'),(1025,'sepia'),(1026,'amble'),(1027,'shady'),(1028,'bread'),(1029,'friar'),(1030,'reign'),(1031,'dairy'),(1032,'quill'),(1033,'cross'),(1034,'brood'),(1035,'tuber'),(1036,'shear'),(1037,'posit'),(1038,'blank'),(1039,'villa'),(1040,'shank'),(1041,'piggy'),(1042,'freak'),(1043,'which'),(1044,'among'),(1045,'fecal'),(1046,'shell'),(1047,'would'),(1048,'algae'),(1049,'large'),(1050,'rabbi'),(1051,'agony'),(1052,'amuse'),(1053,'bushy'),(1054,'copse'),(1055,'swoon'),(1056,'knife'),(1057,'pouch'),(1058,'ascot'),(1059,'plane'),(1060,'crown'),(1061,'urban'),(1062,'snide'),(1063,'relay'),(1064,'abide'),(1065,'viola'),(1066,'rajah'),(1067,'straw'),(1068,'dilly'),(1069,'crash'),(1070,'amass'),(1071,'third'),(1072,'trick'),(1073,'tutor'),(1074,'woody'),(1075,'blurb'),(1076,'grief'),(1077,'disco'),(1078,'where'),(1079,'sassy'),(1080,'beach'),(1081,'sauna'),(1082,'comic'),(1083,'clued'),(1084,'creep'),(1085,'caste'),(1086,'graze'),(1087,'snuff'),(1088,'frock'),(1089,'gonad'),(1090,'drunk'),(1091,'prong'),(1092,'lurid'),(1093,'steel'),(1094,'halve'),(1095,'buyer'),(1096,'vinyl'),(1097,'utile'),(1098,'smell'),(1099,'adage'),(1100,'worry'),(1101,'tasty'),(1102,'local'),(1103,'trade'),(1104,'finch'),(1105,'ashen'),(1106,'modal'),(1107,'gaunt'),(1108,'clove'),(1109,'enact'),(1110,'adorn'),(1111,'roast'),(1112,'speck'),(1113,'sheik'),(1114,'missy'),(1115,'grunt'),(1116,'snoop'),(1117,'party'),(1118,'touch'),(1119,'mafia'),(1120,'emcee'),(1121,'array'),(1122,'south'),(1123,'vapid'),(1124,'jelly'),(1125,'skulk'),(1126,'angst'),(1127,'tubal'),(1128,'lower'),(1129,'crest'),(1130,'sweat'),(1131,'cyber'),(1132,'adore'),(1133,'tardy'),(1134,'swami'),(1135,'notch'),(1136,'groom'),(1137,'roach'),(1138,'hitch'),(1139,'young'),(1140,'align'),(1141,'ready'),(1142,'frond'),(1143,'strap'),(1144,'puree'),(1145,'realm'),(1146,'venue'),(1147,'swarm'),(1148,'offer'),(1149,'seven'),(1150,'dryer'),(1151,'diary'),(1152,'dryly'),(1153,'drank'),(1154,'acrid'),(1155,'heady'),(1156,'theta'),(1157,'junto'),(1158,'pixie'),(1159,'quoth'),(1160,'bonus'),(1161,'shalt'),(1162,'penne'),(1163,'amend'),(1164,'datum'),(1165,'build'),(1166,'piano'),(1167,'shelf'),(1168,'lodge'),(1169,'suing'),(1170,'rearm'),(1171,'coral'),(1172,'ramen'),(1173,'worth'),(1174,'psalm'),(1175,'infer'),(1176,'overt'),(1177,'mayor'),(1178,'ovoid'),(1179,'glide'),(1180,'usage'),(1181,'poise'),(1182,'randy'),(1183,'chuck'),(1184,'prank'),(1185,'fishy'),(1186,'tooth'),(1187,'ether'),(1188,'drove'),(1189,'idler'),(1190,'swath'),(1191,'stint'),(1192,'while'),(1193,'begat'),(1194,'apply'),(1195,'slang'),(1196,'tarot'),(1197,'radar'),(1198,'credo'),(1199,'aware'),(1200,'canon'),(1201,'shift'),(1202,'timer'),(1203,'bylaw'),(1204,'serum'),(1205,'three'),(1206,'steak'),(1207,'iliac'),(1208,'shirk'),(1209,'blunt'),(1210,'puppy'),(1211,'penal'),(1212,'joist'),(1213,'bunny'),(1214,'shape'),(1215,'beget'),(1216,'wheel'),(1217,'adept'),(1218,'stunt'),(1219,'stole'),(1220,'topaz'),(1221,'chore'),(1222,'fluke'),(1223,'afoot'),(1224,'bloat'),(1225,'bully'),(1226,'dense'),(1227,'caper'),(1228,'sneer'),(1229,'boxer'),(1230,'jumbo'),(1231,'lunge'),(1232,'space'),(1233,'avail'),(1234,'short'),(1235,'slurp'),(1236,'loyal'),(1237,'flirt'),(1238,'pizza'),(1239,'conch'),(1240,'tempo'),(1241,'droop'),(1242,'plate'),(1243,'bible'),(1244,'plunk'),(1245,'afoul'),(1246,'savoy'),(1247,'steep'),(1248,'agile'),(1249,'stake'),(1250,'dwell'),(1251,'knave'),(1252,'beard'),(1253,'arose'),(1254,'motif'),(1255,'smash'),(1256,'broil'),(1257,'glare'),(1258,'shove'),(1259,'baggy'),(1260,'mammy'),(1261,'swamp'),(1262,'along'),(1263,'rugby'),(1264,'wager'),(1265,'quack'),(1266,'squat'),(1267,'snaky'),(1268,'debit'),(1269,'mange'),(1270,'skate'),(1271,'ninth'),(1272,'joust'),(1273,'tramp'),(1274,'spurn'),(1275,'medal'),(1276,'micro'),(1277,'rebel'),(1278,'flank'),(1279,'learn'),(1280,'nadir'),(1281,'maple'),(1282,'comfy'),(1283,'remit'),(1284,'gruff'),(1285,'ester'),(1286,'least'),(1287,'mogul'),(1288,'fetch'),(1289,'cause'),(1290,'oaken'),(1291,'aglow'),(1292,'meaty'),(1293,'gaffe'),(1294,'shyly'),(1295,'racer'),(1296,'prowl'),(1297,'thief'),(1298,'stern'),(1299,'poesy'),(1300,'rocky'),(1301,'tweet'),(1302,'waist'),(1303,'spire'),(1304,'grope'),(1305,'havoc'),(1306,'patsy'),(1307,'truly'),(1308,'forty'),(1309,'deity'),(1310,'uncle'),(1311,'swish'),(1312,'giver'),(1313,'preen'),(1314,'bevel'),(1315,'lemur'),(1316,'draft'),(1317,'slope'),(1318,'annoy'),(1319,'lingo'),(1320,'bleak'),(1321,'ditty'),(1322,'curly'),(1323,'cedar'),(1324,'dirge'),(1325,'grown'),(1326,'horde'),(1327,'drool'),(1328,'shuck'),(1329,'crypt'),(1330,'cumin'),(1331,'stock'),(1332,'gravy'),(1333,'locus'),(1334,'wider'),(1335,'breed'),(1336,'quite'),(1337,'chafe'),(1338,'cache'),(1339,'blimp'),(1340,'deign'),(1341,'fiend'),(1342,'logic'),(1343,'cheap'),(1344,'elide'),(1345,'rigid'),(1346,'false'),(1347,'renal'),(1348,'pence'),(1349,'rowdy'),(1350,'shoot'),(1351,'blaze'),(1352,'envoy'),(1353,'posse'),(1354,'brief'),(1355,'never'),(1356,'abort'),(1357,'mouse'),(1358,'mucky'),(1359,'sulky'),(1360,'fiery'),(1361,'media'),(1362,'trunk'),(1363,'yeast'),(1364,'clear'),(1365,'skunk'),(1366,'scalp'),(1367,'bitty'),(1368,'cider'),(1369,'koala'),(1370,'duvet'),(1371,'segue'),(1372,'creme'),(1373,'super'),(1374,'grill'),(1375,'after'),(1376,'owner'),(1377,'ember'),(1378,'reach'),(1379,'nobly'),(1380,'empty'),(1381,'speed'),(1382,'gipsy'),(1383,'recur'),(1384,'smock'),(1385,'dread'),(1386,'merge'),(1387,'burst'),(1388,'kappa'),(1389,'amity'),(1390,'shaky'),(1391,'hover'),(1392,'carol'),(1393,'snort'),(1394,'synod'),(1395,'faint'),(1396,'haunt'),(1397,'flour'),(1398,'chair'),(1399,'detox'),(1400,'shrew'),(1401,'tense'),(1402,'plied'),(1403,'quark'),(1404,'burly'),(1405,'novel'),(1406,'waxen'),(1407,'stoic'),(1408,'jerky'),(1409,'blitz'),(1410,'beefy'),(1411,'lyric'),(1412,'hussy'),(1413,'towel'),(1414,'quilt'),(1415,'below'),(1416,'bingo'),(1417,'wispy'),(1418,'brash'),(1419,'scone'),(1420,'toast'),(1421,'easel'),(1422,'saucy'),(1423,'value'),(1424,'spice'),(1425,'honor'),(1426,'route'),(1427,'sharp'),(1428,'bawdy'),(1429,'radii'),(1430,'skull'),(1431,'phony'),(1432,'issue'),(1433,'lager'),(1434,'swell'),(1435,'urine'),(1436,'gassy'),(1437,'trial'),(1438,'flora'),(1439,'upper'),(1440,'latch'),(1441,'wight'),(1442,'brick'),(1443,'retry'),(1444,'holly'),(1445,'decal'),(1446,'grass'),(1447,'shack'),(1448,'dogma'),(1449,'mover'),(1450,'defer'),(1451,'sober'),(1452,'optic'),(1453,'crier'),(1454,'vying'),(1455,'nomad'),(1456,'flute'),(1457,'hippo'),(1458,'shark'),(1459,'drier'),(1460,'obese'),(1461,'bugle'),(1462,'tawny'),(1463,'chalk'),(1464,'feast'),(1465,'ruddy'),(1466,'pedal'),(1467,'scarf'),(1468,'cruel'),(1469,'bleat'),(1470,'tidal'),(1471,'slush'),(1472,'semen'),(1473,'windy'),(1474,'dusty'),(1475,'sally'),(1476,'igloo'),(1477,'nerdy'),(1478,'jewel'),(1479,'shone'),(1480,'whale'),(1481,'hymen'),(1482,'abuse'),(1483,'fugue'),(1484,'elbow'),(1485,'crumb'),(1486,'pansy'),(1487,'welsh'),(1488,'syrup'),(1489,'terse'),(1490,'suave'),(1491,'gamut'),(1492,'swung'),(1493,'drake'),(1494,'freed'),(1495,'afire'),(1496,'shirt'),(1497,'grout'),(1498,'oddly'),(1499,'tithe'),(1500,'plaid'),(1501,'dummy'),(1502,'broom'),(1503,'blind'),(1504,'torch'),(1505,'enemy'),(1506,'again'),(1507,'tying'),(1508,'pesky'),(1509,'alter'),(1510,'gazer'),(1511,'noble'),(1512,'ethos'),(1513,'bride'),(1514,'extol'),(1515,'decor'),(1516,'hobby'),(1517,'beast'),(1518,'idiom'),(1519,'utter'),(1520,'these'),(1521,'sixth'),(1522,'alarm'),(1523,'erase'),(1524,'elegy'),(1525,'spunk'),(1526,'piper'),(1527,'scaly'),(1528,'scold'),(1529,'hefty'),(1530,'chick'),(1531,'sooty'),(1532,'canal'),(1533,'whiny'),(1534,'slash'),(1535,'quake'),(1536,'joint'),(1537,'swept'),(1538,'prude'),(1539,'heavy'),(1540,'wield'),(1541,'femme'),(1542,'lasso'),(1543,'maize'),(1544,'shale'),(1545,'screw'),(1546,'spree'),(1547,'smoky'),(1548,'whiff'),(1549,'scent'),(1550,'glade'),(1551,'spent'),(1552,'prism'),(1553,'stoke'),(1554,'riper'),(1555,'orbit'),(1556,'cocoa'),(1557,'guilt'),(1558,'humus'),(1559,'shush'),(1560,'table'),(1561,'smirk'),(1562,'wrong'),(1563,'noisy'),(1564,'alert'),(1565,'shiny'),(1566,'elate'),(1567,'resin'),(1568,'whole'),(1569,'hunch'),(1570,'pixel'),(1571,'polar'),(1572,'hotel'),(1573,'sword'),(1574,'cleat'),(1575,'mango'),(1576,'rumba'),(1577,'puffy'),(1578,'filly'),(1579,'billy'),(1580,'leash'),(1581,'clout'),(1582,'dance'),(1583,'ovate'),(1584,'facet'),(1585,'chili'),(1586,'paint'),(1587,'liner'),(1588,'curio'),(1589,'salty'),(1590,'audio'),(1591,'snake'),(1592,'fable'),(1593,'cloak'),(1594,'navel'),(1595,'spurt'),(1596,'pesto'),(1597,'balmy'),(1598,'flash'),(1599,'unwed'),(1600,'early'),(1601,'churn'),(1602,'weedy'),(1603,'stump'),(1604,'lease'),(1605,'witty'),(1606,'wimpy'),(1607,'spoof'),(1608,'saner'),(1609,'blend'),(1610,'salsa'),(1611,'thick'),(1612,'warty'),(1613,'manic'),(1614,'blare'),(1615,'squib'),(1616,'spoon'),(1617,'probe'),(1618,'crepe'),(1619,'knack'),(1620,'force'),(1621,'debut'),(1622,'order'),(1623,'haste'),(1624,'teeth'),(1625,'agent'),(1626,'widen'),(1627,'icily'),(1628,'slice'),(1629,'ingot'),(1630,'clash'),(1631,'juror'),(1632,'blood'),(1633,'abode'),(1634,'throw'),(1635,'unity'),(1636,'pivot'),(1637,'slept'),(1638,'troop'),(1639,'spare'),(1640,'sewer'),(1641,'parse'),(1642,'morph'),(1643,'cacti'),(1644,'tacky'),(1645,'spool'),(1646,'demon'),(1647,'moody'),(1648,'annex'),(1649,'begin'),(1650,'fuzzy'),(1651,'patch'),(1652,'water'),(1653,'lumpy'),(1654,'admin'),(1655,'omega'),(1656,'limit'),(1657,'tabby'),(1658,'macho'),(1659,'aisle'),(1660,'skiff'),(1661,'basis'),(1662,'plank'),(1663,'verge'),(1664,'botch'),(1665,'crawl'),(1666,'lousy'),(1667,'slain'),(1668,'cubic'),(1669,'raise'),(1670,'wrack'),(1671,'guide'),(1672,'foist'),(1673,'cameo'),(1674,'under'),(1675,'actor'),(1676,'revue'),(1677,'fraud'),(1678,'harpy'),(1679,'scoop'),(1680,'climb'),(1681,'refer'),(1682,'olden'),(1683,'clerk'),(1684,'debar'),(1685,'tally'),(1686,'ethic'),(1687,'cairn'),(1688,'tulle'),(1689,'ghoul'),(1690,'hilly'),(1691,'crude'),(1692,'apart'),(1693,'scale'),(1694,'older'),(1695,'plain'),(1696,'sperm'),(1697,'briny'),(1698,'abbot'),(1699,'rerun'),(1700,'quest'),(1701,'crisp'),(1702,'bound'),(1703,'befit'),(1704,'drawn'),(1705,'suite'),(1706,'itchy'),(1707,'cheer'),(1708,'bagel'),(1709,'guess'),(1710,'broad'),(1711,'axiom'),(1712,'chard'),(1713,'caput'),(1714,'leant'),(1715,'harsh'),(1716,'curse'),(1717,'proud'),(1718,'swing'),(1719,'opine'),(1720,'taste'),(1721,'lupus'),(1722,'gumbo'),(1723,'miner'),(1724,'green'),(1725,'chasm'),(1726,'lipid'),(1727,'topic'),(1728,'armor'),(1729,'brush'),(1730,'crane'),(1731,'mural'),(1732,'abled'),(1733,'habit'),(1734,'bossy'),(1735,'maker'),(1736,'dusky'),(1737,'dizzy'),(1738,'lithe'),(1739,'brook'),(1740,'jazzy'),(1741,'fifty'),(1742,'sense'),(1743,'giant'),(1744,'surly'),(1745,'legal'),(1746,'fatal'),(1747,'flunk'),(1748,'began'),(1749,'prune'),(1750,'small'),(1751,'slant'),(1752,'scoff'),(1753,'torus'),(1754,'ninny'),(1755,'covey'),(1756,'viper'),(1757,'taken'),(1758,'moral'),(1759,'vogue'),(1760,'owing'),(1761,'token'),(1762,'entry'),(1763,'booth'),(1764,'voter'),(1765,'chide'),(1766,'elfin'),(1767,'ebony'),(1768,'neigh'),(1769,'minim'),(1770,'melon'),(1771,'kneed'),(1772,'decoy'),(1773,'voila'),(1774,'ankle'),(1775,'arrow'),(1776,'mushy'),(1777,'tribe'),(1778,'cease'),(1779,'eager'),(1780,'birth'),(1781,'graph'),(1782,'odder'),(1783,'terra'),(1784,'weird'),(1785,'tried'),(1786,'clack'),(1787,'color'),(1788,'rough'),(1789,'weigh'),(1790,'uncut'),(1791,'ladle'),(1792,'strip'),(1793,'craft'),(1794,'minus'),(1795,'dicey'),(1796,'titan'),(1797,'lucid'),(1798,'vicar'),(1799,'dress'),(1800,'ditch'),(1801,'gypsy'),(1802,'pasta'),(1803,'taffy'),(1804,'flame'),(1805,'swoop'),(1806,'aloof'),(1807,'sight'),(1808,'broke'),(1809,'teary'),(1810,'chart'),(1811,'sixty'),(1812,'wordy'),(1813,'sheer'),(1814,'leper'),(1815,'nosey'),(1816,'bulge'),(1817,'savor'),(1818,'clamp'),(1819,'funky'),(1820,'foamy'),(1821,'toxic'),(1822,'brand'),(1823,'plumb'),(1824,'dingy'),(1825,'butte'),(1826,'drill'),(1827,'tripe'),(1828,'bicep'),(1829,'tenor'),(1830,'krill'),(1831,'worse'),(1832,'drama'),(1833,'hyena'),(1834,'think'),(1835,'ratio'),(1836,'cobra'),(1837,'basil'),(1838,'scrum'),(1839,'bused'),(1840,'phone'),(1841,'court'),(1842,'camel'),(1843,'proof'),(1844,'heard'),(1845,'angel'),(1846,'petal'),(1847,'pouty'),(1848,'throb'),(1849,'maybe'),(1850,'fetal'),(1851,'sprig'),(1852,'spine'),(1853,'shout'),(1854,'cadet'),(1855,'macro'),(1856,'dodgy'),(1857,'satyr'),(1858,'rarer'),(1859,'binge'),(1860,'trend'),(1861,'nutty'),(1862,'leapt'),(1863,'amiss'),(1864,'split'),(1865,'myrrh'),(1866,'width'),(1867,'sonar'),(1868,'tower'),(1869,'baron'),(1870,'fever'),(1871,'waver'),(1872,'spark'),(1873,'belie'),(1874,'sloop'),(1875,'expel'),(1876,'smote'),(1877,'baler'),(1878,'above'),(1879,'north'),(1880,'wafer'),(1881,'scant'),(1882,'frill'),(1883,'awash'),(1884,'snack'),(1885,'scowl'),(1886,'frail'),(1887,'drift'),(1888,'limbo'),(1889,'fence'),(1890,'motel'),(1891,'ounce'),(1892,'wreak'),(1893,'revel'),(1894,'talon'),(1895,'prior'),(1896,'knelt'),(1897,'cello'),(1898,'flake'),(1899,'debug'),(1900,'anode'),(1901,'crime'),(1902,'salve'),(1903,'scout'),(1904,'imbue'),(1905,'pinky'),(1906,'stave'),(1907,'vague'),(1908,'chock'),(1909,'fight'),(1910,'video'),(1911,'stone'),(1912,'teach'),(1913,'cleft'),(1914,'frost'),(1915,'prawn'),(1916,'booty'),(1917,'twist'),(1918,'apnea'),(1919,'stiff'),(1920,'plaza'),(1921,'ledge'),(1922,'tweak'),(1923,'board'),(1924,'grant'),(1925,'medic'),(1926,'bacon'),(1927,'cable'),(1928,'brawl'),(1929,'slunk'),(1930,'raspy'),(1931,'forum'),(1932,'drone'),(1933,'women'),(1934,'mucus'),(1935,'boast'),(1936,'toddy'),(1937,'coven'),(1938,'tumor'),(1939,'truer'),(1940,'wrath'),(1941,'stall'),(1942,'steam'),(1943,'axial'),(1944,'purer'),(1945,'daily'),(1946,'trail'),(1947,'niche'),(1948,'mealy'),(1949,'juice'),(1950,'nylon'),(1951,'plump'),(1952,'merry'),(1953,'flail'),(1954,'papal'),(1955,'wheat'),(1956,'berry'),(1957,'cower'),(1958,'erect'),(1959,'brute'),(1960,'leggy'),(1961,'snipe'),(1962,'sinew'),(1963,'skier'),(1964,'penny'),(1965,'jumpy'),(1966,'rally'),(1967,'umbra'),(1968,'scary'),(1969,'modem'),(1970,'gross'),(1971,'avian'),(1972,'greed'),(1973,'satin'),(1974,'tonic'),(1975,'parka'),(1976,'sniff'),(1977,'livid'),(1978,'stark'),(1979,'trump'),(1980,'giddy'),(1981,'reuse'),(1982,'taboo'),(1983,'avoid'),(1984,'quote'),(1985,'devil'),(1986,'liken'),(1987,'gloss'),(1988,'gayer'),(1989,'beret'),(1990,'noise'),(1991,'gland'),(1992,'dealt'),(1993,'sling'),(1994,'rumor'),(1995,'opera'),(1996,'thigh'),(1997,'tonga'),(1998,'flare'),(1999,'wound'),(2000,'white'),(2001,'bulky'),(2002,'etude'),(2003,'horse'),(2004,'circa'),(2005,'paddy'),(2006,'inbox'),(2007,'fizzy'),(2008,'grain'),(2009,'exert'),(2010,'surge'),(2011,'gleam'),(2012,'belle'),(2013,'salvo'),(2014,'crush'),(2015,'fruit'),(2016,'sappy'),(2017,'taker'),(2018,'tract'),(2019,'ovine'),(2020,'spiky'),(2021,'frank'),(2022,'reedy'),(2023,'filth'),(2024,'spasm'),(2025,'heave'),(2026,'mambo'),(2027,'right'),(2028,'clank'),(2029,'trust'),(2030,'lumen'),(2031,'borne'),(2032,'spook'),(2033,'sauce'),(2034,'amber'),(2035,'lathe'),(2036,'carat'),(2037,'corer'),(2038,'dirty'),(2039,'slyly'),(2040,'affix'),(2041,'alloy'),(2042,'taint'),(2043,'sheep'),(2044,'kinky'),(2045,'wooly'),(2046,'mauve'),(2047,'flung'),(2048,'yacht'),(2049,'fried'),(2050,'quail'),(2051,'brunt'),(2052,'grimy'),(2053,'curvy'),(2054,'cagey'),(2055,'rinse'),(2056,'deuce'),(2057,'state'),(2058,'grasp'),(2059,'milky'),(2060,'bison'),(2061,'graft'),(2062,'sandy'),(2063,'baste'),(2064,'flask'),(2065,'hedge'),(2066,'girly'),(2067,'swash'),(2068,'boney'),(2069,'coupe'),(2070,'endow'),(2071,'abhor'),(2072,'welch'),(2073,'blade'),(2074,'tight'),(2075,'geese'),(2076,'miser'),(2077,'mirth'),(2078,'cloud'),(2079,'cabal'),(2080,'leech'),(2081,'close'),(2082,'tenth'),(2083,'pecan'),(2084,'droit'),(2085,'grail'),(2086,'clone'),(2087,'guise'),(2088,'ralph'),(2089,'tango'),(2090,'biddy'),(2091,'smith'),(2092,'mower'),(2093,'payee'),(2094,'serif'),(2095,'drape'),(2096,'fifth'),(2097,'spank'),(2098,'glaze'),(2099,'allot'),(2100,'truck'),(2101,'kayak'),(2102,'virus'),(2103,'testy'),(2104,'tepee'),(2105,'fully'),(2106,'zonal'),(2107,'metro'),(2108,'curry'),(2109,'grand'),(2110,'banjo'),(2111,'axion'),(2112,'bezel'),(2113,'occur'),(2114,'chain'),(2115,'nasal'),(2116,'gooey'),(2117,'filer'),(2118,'brace'),(2119,'allay'),(2120,'pubic'),(2121,'raven'),(2122,'plead'),(2123,'gnash'),(2124,'flaky'),(2125,'munch'),(2126,'dully'),(2127,'eking'),(2128,'thing'),(2129,'slink'),(2130,'hurry'),(2131,'theft'),(2132,'shorn'),(2133,'pygmy'),(2134,'ranch'),(2135,'wring'),(2136,'lemon'),(2137,'shore'),(2138,'mamma'),(2139,'froze'),(2140,'newer'),(2141,'style'),(2142,'moose'),(2143,'antic'),(2144,'drown'),(2145,'vegan'),(2146,'chess'),(2147,'guppy'),(2148,'union'),(2149,'lever'),(2150,'lorry'),(2151,'image'),(2152,'cabby'),(2153,'druid'),(2154,'exact'),(2155,'truth'),(2156,'dopey'),(2157,'spear'),(2158,'cried'),(2159,'chime'),(2160,'crony'),(2161,'stunk'),(2162,'timid'),(2163,'batch'),(2164,'gauge'),(2165,'rotor'),(2166,'crack'),(2167,'curve'),(2168,'latte'),(2169,'witch'),(2170,'bunch'),(2171,'repel'),(2172,'anvil'),(2173,'soapy'),(2174,'meter'),(2175,'broth'),(2176,'madly'),(2177,'dried'),(2178,'scene'),(2179,'known'),(2180,'magma'),(2181,'roost'),(2182,'woman'),(2183,'thong'),(2184,'punch'),(2185,'pasty'),(2186,'downy'),(2187,'knead'),(2188,'whirl'),(2189,'rapid'),(2190,'clang'),(2191,'anger'),(2192,'drive'),(2193,'goofy'),(2194,'email'),(2195,'music'),(2196,'stuff'),(2197,'bleep'),(2198,'rider'),(2199,'mecca'),(2200,'folio'),(2201,'setup'),(2202,'verso'),(2203,'quash'),(2204,'fauna'),(2205,'gummy'),(2206,'happy'),(2207,'newly'),(2208,'fussy'),(2209,'relic'),(2210,'guava'),(2211,'ratty'),(2212,'fudge'),(2213,'femur'),(2214,'chirp'),(2215,'forte'),(2216,'alibi'),(2217,'whine'),(2218,'petty'),(2219,'golly'),(2220,'plait'),(2221,'fleck'),(2222,'felon'),(2223,'gourd'),(2224,'brown'),(2225,'thrum'),(2226,'ficus'),(2227,'stash'),(2228,'decry'),(2229,'wiser'),(2230,'junta'),(2231,'visor'),(2232,'daunt'),(2233,'scree'),(2234,'impel'),(2235,'await'),(2236,'press'),(2237,'whose'),(2238,'turbo'),(2239,'stoop'),(2240,'speak'),(2241,'mangy'),(2242,'eying'),(2243,'inlet'),(2244,'crone'),(2245,'pulse'),(2246,'mossy'),(2247,'staid'),(2248,'hence'),(2249,'pinch'),(2250,'teddy'),(2251,'sully'),(2252,'snore'),(2253,'ripen'),(2254,'snowy'),(2255,'attic'),(2256,'going'),(2257,'leach'),(2258,'mouth'),(2259,'hound'),(2260,'clump'),(2261,'tonal'),(2262,'bigot'),(2263,'peril'),(2264,'piece'),(2265,'blame'),(2266,'haute'),(2267,'spied'),(2268,'undid'),(2269,'intro'),(2270,'basal'),(2271,'shine'),(2272,'gecko'),(2273,'rodeo'),(2274,'guard'),(2275,'steer'),(2276,'loamy'),(2277,'scamp'),(2278,'scram'),(2279,'manly'),(2280,'hello'),(2281,'vaunt'),(2282,'organ'),(2283,'feral'),(2284,'knock'),(2285,'extra'),(2286,'condo'),(2287,'adapt'),(2288,'willy'),(2289,'polka'),(2290,'rayon'),(2291,'skirt'),(2292,'faith'),(2293,'torso'),(2294,'match'),(2295,'mercy'),(2296,'tepid'),(2297,'sleek'),(2298,'riser'),(2299,'twixt'),(2300,'peace'),(2301,'flush'),(2302,'catty'),(2303,'login'),(2304,'eject'),(2305,'roger'),(2306,'rival'),(2307,'untie'),(2308,'refit'),(2309,'aorta'),(2310,'adult'),(2311,'judge'),(2312,'rower'),(2313,'artsy'),(2314,'rural'),(2315,'shave');
/*!40000 ALTER TABLE `word_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-30 12:26:13
