-- MySQL dump 10.13  Distrib 8.1.0, for macos12.6 (x86_64)
--
-- Host: localhost    Database: mentor
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (2,'格仲國際遊學','blog_images/vLdqX8i8yFHd4LSEySG3IUFZEWVfuUN6Pbn2wLlF.png','Web Design','Html','最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心最專業 ，安心 ，專心，放心','active','2023-11-06 04:06:04','2023-11-07 02:32:02',NULL,NULL),(8,'謝仲城','blog_images/M5VBZ1qg1prZvcO8C9jKILFZeBtBTgj0rsohGE9N.png','Web Design','Html','謝仲城是大帥哥','active','2023-11-06 07:13:13','2023-11-06 07:13:13',NULL,NULL),(9,'8888234','blog_images/0cEOBqjrqH913haF5Ztn9XPxATZPJ8AYDOSfycDY.png','Web Development','Javascript','234234','inactive','2023-11-06 07:31:21','2023-11-06 07:31:21',NULL,NULL),(10,'ESL課程好嗎','blog_images/GlzZ4zNtbFhQiATDXN6ajbnn5gkXyyjJArijtnd7.png','App Development','Codeignitor','234234','active','2023-11-06 08:07:27','2023-11-06 08:20:52',NULL,NULL),(12,'234234','blog_images/a4cNCfrMNQL59RSAln3Gq8pzFjMZD40On258FeQT.png','Web Design','Html','234234234','active','2023-11-06 13:01:52','2023-11-12 21:35:20',NULL,NULL),(13,'第13筆資料','blog_images/fIY5fuloJuOiZHnHhbWUO1RPFQABKxXL7sMsAVET.png','Web Development','Css','第13筆資料','active','2023-11-06 13:02:38','2023-11-06 13:02:38',NULL,NULL),(14,'第14筆資料','blog_images/w3FoLBwYxuDjg8UkU97co8GFhFNAACX86jQqOO0g.png','Web Design','Html','第14筆資料的內容','active','2023-11-06 13:05:30','2023-11-06 13:05:30',NULL,NULL),(15,'第15筆資料','blog_images/9lQIa4ufBGKG0qhtUx964SaaheManUFreOG0vvPw.png','App Development','PHP','123到台灣','active','2023-11-10 01:34:45','2023-11-10 01:34:45',NULL,NULL),(16,'第16筆資料','blog_images/hdoRSiRtYrEGo8DCjC8ntyePif9eDJvlTm6hwH6H.jpg','Web Development','PHP','第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料第16筆資料','active','2023-11-12 20:22:05','2023-11-12 20:22:05',NULL,NULL),(17,'第 17筆資料','blog_images/AuC9jZa343ekFbcV9mbAqsSGV9yJq9es5MxZ6mpJ.png','Web Design','Html','第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料第 17筆資料','active','2023-11-12 21:47:34','2023-11-12 21:47:34','Admin','http://127.0.0.1:8000/storage/avatars/1698718718.png'),(18,'第 18筆資料','blog_images/RtJtZhnLeXatB3ApGxRZ9BX1XQGbzyK20x1zj9rX.jpg','Web Design','Html','第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料第 18筆資料','active','2023-11-12 22:59:19','2023-11-12 22:59:19','Admin','http://127.0.0.1:8000/storage/avatars/1698718718.png'),(19,'第 19筆資料','blog_images/hsv69gE6dNWzSYFuqMEFg7ujDjkcFaYg4052Ok1n.jpg','App Development','Css','第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料第 19筆資料','active','2023-11-12 23:02:40','2023-11-12 23:06:59','Admin','/storage/avatars/1698718718.png');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `schedule_date` date NOT NULL,
  `day_of_week` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_course_id_foreign` (`course_id`),
  CONSTRAINT `bookings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms`
--

DROP TABLE IF EXISTS `chat_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms`
--

LOCK TABLES `chat_rooms` WRITE;
/*!40000 ALTER TABLE `chat_rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_bookings`
--

DROP TABLE IF EXISTS `class_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `class_schedule_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_bookings_order_id_foreign` (`order_id`),
  KEY `class_bookings_user_id_foreign` (`user_id`),
  KEY `class_bookings_class_schedule_id_foreign` (`class_schedule_id`),
  CONSTRAINT `class_bookings_class_schedule_id_foreign` FOREIGN KEY (`class_schedule_id`) REFERENCES `class_schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `class_bookings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `class_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_bookings`
--

LOCK TABLES `class_bookings` WRITE;
/*!40000 ALTER TABLE `class_bookings` DISABLE KEYS */;
INSERT INTO `class_bookings` VALUES (1,1,1,1,'booked','2023-12-04 21:44:17','2023-12-04 21:44:17');
/*!40000 ALTER TABLE `class_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_schedules`
--

DROP TABLE IF EXISTS `class_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `day_of_week` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `schedule_date` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `course_id` int DEFAULT NULL,
  `mentee_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_schedules_user_id_foreign` (`user_id`),
  CONSTRAINT `class_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=510 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_schedules`
--

LOCK TABLES `class_schedules` WRITE;
/*!40000 ALTER TABLE `class_schedules` DISABLE KEYS */;
INSERT INTO `class_schedules` VALUES (1,2,'Tuesday','08:00:00','08:25:00','2023-10-24',0,'Completed',NULL,6,NULL,'2023-10-23 18:08:53'),(2,2,'Tuesday','08:30:00','08:55:00','2023-10-24',0,'Canceled',NULL,6,NULL,'2023-10-23 18:06:47'),(3,2,'Monday','08:00:00','08:25:00','2023-10-30',0,'Absent',NULL,6,NULL,'2023-10-23 18:10:54'),(4,2,'Monday','08:30:00','08:55:00','2023-10-30',0,'Absent',NULL,6,NULL,'2023-10-23 18:15:36'),(5,2,'Tuesday','08:00:00','08:25:00','2023-10-31',0,'Absent',NULL,6,NULL,'2023-10-23 19:12:11'),(6,2,'Tuesday','08:30:00','08:55:00','2023-10-31',0,'Canceled',NULL,6,NULL,'2023-10-23 18:45:47'),(7,2,'Monday','08:00:00','08:25:00','2023-11-06',0,'Absent',NULL,6,NULL,'2023-10-24 03:07:07'),(8,2,'Monday','08:30:00','08:55:00','2023-11-06',0,'Canceled',NULL,6,NULL,'2023-10-23 18:45:55'),(9,2,'Tuesday','08:00:00','08:25:00','2023-11-07',0,'Absent',NULL,6,NULL,'2023-10-24 03:07:30'),(10,2,'Tuesday','08:30:00','08:55:00','2023-11-07',0,'Completed',NULL,6,NULL,'2023-10-23 18:43:08'),(11,2,'Monday','08:00:00','08:25:00','2023-11-13',0,'Completed',NULL,6,NULL,'2023-11-23 17:18:37'),(12,2,'Monday','08:30:00','08:55:00','2023-11-13',0,'Completed',NULL,6,NULL,'2023-11-23 18:01:29'),(13,2,'Tuesday','08:00:00','08:25:00','2023-11-14',0,'Canceled',NULL,6,NULL,'2023-10-24 01:03:42'),(14,2,'Tuesday','08:30:00','08:55:00','2023-11-14',0,'Completed',NULL,6,NULL,'2023-11-23 18:05:36'),(15,2,'Monday','08:00:00','08:25:00','2023-11-20',0,'Completed',NULL,6,NULL,'2023-11-23 18:06:36'),(16,2,'Monday','08:30:00','08:55:00','2023-11-20',0,'Completed',NULL,1,NULL,'2023-11-29 18:21:57'),(17,2,'Tuesday','08:00:00','08:25:00','2023-11-21',0,'Absent',NULL,1,NULL,'2023-10-24 03:09:17'),(18,2,'Tuesday','08:30:00','08:55:00','2023-11-21',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(19,3,'Tuesday','08:00:00','08:25:00','2023-10-24',0,'Absent',NULL,6,NULL,'2023-10-23 18:46:16'),(20,3,'Tuesday','08:30:00','08:55:00','2023-10-24',0,'Completed',NULL,6,NULL,'2023-11-23 18:07:27'),(21,3,'Tuesday','09:00:00','09:25:00','2023-10-24',0,'Canceled',NULL,6,NULL,'2023-10-23 18:11:17'),(22,3,'Tuesday','09:30:00','09:55:00','2023-10-24',0,'Absent',NULL,6,NULL,'2023-10-24 01:03:16'),(23,3,'Tuesday','10:00:00','10:25:00','2023-10-24',0,'Absent',NULL,6,NULL,'2023-10-23 18:07:03'),(24,3,'Monday','08:00:00','08:25:00','2023-10-30',0,'Canceled',NULL,6,NULL,'2023-10-23 18:52:14'),(25,3,'Monday','08:30:00','08:55:00','2023-10-30',0,'Absent',NULL,6,NULL,'2023-11-23 18:07:36'),(26,3,'Monday','09:00:00','09:25:00','2023-10-30',0,'Absent',NULL,6,NULL,'2023-10-23 18:43:23'),(27,3,'Monday','09:30:00','09:55:00','2023-10-30',0,'Canceled',NULL,6,NULL,'2023-10-23 18:46:33'),(28,3,'Monday','10:00:00','10:25:00','2023-10-30',0,'Completed',NULL,6,NULL,'2023-10-23 18:06:27'),(29,3,'Tuesday','08:00:00','08:25:00','2023-10-31',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(30,3,'Tuesday','08:30:00','08:55:00','2023-10-31',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(31,3,'Tuesday','09:00:00','09:25:00','2023-10-31',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(32,3,'Tuesday','09:30:00','09:55:00','2023-10-31',0,'available',NULL,NULL,NULL,NULL),(33,3,'Tuesday','10:00:00','10:25:00','2023-10-31',0,'available',NULL,NULL,NULL,NULL),(34,3,'Monday','08:00:00','08:25:00','2023-11-06',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(35,3,'Monday','08:30:00','08:55:00','2023-11-06',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(36,3,'Monday','09:00:00','09:25:00','2023-11-06',0,'absent',NULL,1,NULL,'2023-11-29 21:37:30'),(37,3,'Monday','09:30:00','09:55:00','2023-11-06',0,'available',NULL,NULL,NULL,NULL),(38,3,'Monday','10:00:00','10:25:00','2023-11-06',0,'available',NULL,NULL,NULL,NULL),(39,3,'Tuesday','08:00:00','08:25:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(40,3,'Tuesday','08:30:00','08:55:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(41,3,'Tuesday','09:00:00','09:25:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(42,3,'Tuesday','09:30:00','09:55:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(43,3,'Tuesday','10:00:00','10:25:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(44,3,'Monday','08:00:00','08:25:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(45,3,'Monday','08:30:00','08:55:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(46,3,'Monday','09:00:00','09:25:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(47,3,'Monday','09:30:00','09:55:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(48,3,'Monday','10:00:00','10:25:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(49,3,'Tuesday','08:00:00','08:25:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(50,3,'Tuesday','08:30:00','08:55:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(51,3,'Tuesday','09:00:00','09:25:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(52,3,'Tuesday','09:30:00','09:55:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(53,3,'Tuesday','10:00:00','10:25:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(54,3,'Monday','08:00:00','08:25:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(55,3,'Monday','08:30:00','08:55:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(56,3,'Monday','09:00:00','09:25:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(57,3,'Monday','09:30:00','09:55:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(58,3,'Monday','10:00:00','10:25:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(59,3,'Tuesday','08:00:00','08:25:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(60,3,'Tuesday','08:30:00','08:55:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(61,3,'Tuesday','09:00:00','09:25:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(62,3,'Tuesday','09:30:00','09:55:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(63,3,'Tuesday','10:00:00','10:25:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(64,2,'Tuesday','09:00:00','09:25:00','2023-10-24',0,'available',NULL,NULL,NULL,NULL),(65,2,'Tuesday','09:30:00','09:55:00','2023-10-24',0,'available',NULL,NULL,NULL,NULL),(66,2,'Wednesday','08:00:00','08:25:00','2023-10-25',0,'Completed',NULL,6,NULL,'2023-10-24 03:06:15'),(67,2,'Wednesday','08:30:00','08:55:00','2023-10-25',0,'Completed',NULL,6,NULL,'2023-11-23 18:08:35'),(68,2,'Wednesday','09:00:00','09:25:00','2023-10-25',0,'Completed',NULL,6,NULL,'2023-11-23 18:13:13'),(69,2,'Wednesday','09:30:00','09:55:00','2023-10-25',0,'Canceled',NULL,6,NULL,'2023-10-24 03:09:02'),(70,2,'Thursday','08:00:00','08:25:00','2023-10-26',0,'Completed',NULL,6,NULL,'2023-11-23 18:22:21'),(71,2,'Thursday','08:30:00','08:55:00','2023-10-26',0,'Completed',NULL,6,NULL,'2023-11-23 18:26:27'),(72,2,'Thursday','09:00:00','09:25:00','2023-10-26',0,'Completed',NULL,6,NULL,'2023-11-23 18:57:30'),(73,2,'Thursday','09:30:00','09:55:00','2023-10-26',0,'Completed',NULL,6,NULL,'2023-11-23 19:02:32'),(74,2,'Friday','08:00:00','08:25:00','2023-10-27',0,'Canceled',NULL,6,NULL,'2023-11-24 01:02:37'),(75,2,'Friday','08:30:00','08:55:00','2023-10-27',0,'Completed',NULL,6,NULL,'2023-11-24 01:07:57'),(76,2,'Friday','09:00:00','09:25:00','2023-10-27',0,'Completed',NULL,6,NULL,'2023-11-24 01:08:13'),(77,2,'Friday','09:30:00','09:55:00','2023-10-27',0,'Completed',NULL,6,NULL,'2023-11-24 01:19:10'),(78,2,'Saturday','08:00:00','08:25:00','2023-10-28',0,'Completed',NULL,6,NULL,'2023-11-24 03:11:47'),(79,2,'Saturday','08:30:00','08:55:00','2023-10-28',0,'Completed',NULL,6,NULL,'2023-11-24 03:13:27'),(80,2,'Saturday','09:00:00','09:25:00','2023-10-28',0,'Completed',NULL,6,NULL,'2023-11-24 03:13:55'),(81,2,'Saturday','09:30:00','09:55:00','2023-10-28',0,'Completed',NULL,6,NULL,'2023-11-27 04:56:46'),(82,2,'Sunday','08:00:00','08:25:00','2023-10-29',0,'Completed',NULL,6,NULL,'2023-11-27 04:58:46'),(83,2,'Sunday','08:30:00','08:55:00','2023-10-29',0,'Completed',NULL,6,NULL,'2023-11-29 16:41:55'),(84,2,'Sunday','09:00:00','09:25:00','2023-10-29',0,'Completed',NULL,6,NULL,'2023-11-29 17:24:20'),(85,2,'Sunday','09:30:00','09:55:00','2023-10-29',0,'Completed',NULL,6,NULL,'2023-11-29 17:29:26'),(86,2,'Monday','09:00:00','09:25:00','2023-10-30',0,'available',NULL,NULL,NULL,NULL),(87,2,'Monday','09:30:00','09:55:00','2023-10-30',0,'available',NULL,NULL,NULL,NULL),(88,2,'Tuesday','09:00:00','09:25:00','2023-10-31',0,'available',NULL,NULL,NULL,NULL),(89,2,'Tuesday','09:30:00','09:55:00','2023-10-31',0,'available',NULL,NULL,NULL,NULL),(90,2,'Wednesday','08:00:00','08:25:00','2023-11-01',0,'available',NULL,NULL,NULL,NULL),(91,2,'Wednesday','08:30:00','08:55:00','2023-11-01',0,'available',NULL,NULL,NULL,NULL),(92,2,'Wednesday','09:00:00','09:25:00','2023-11-01',0,'available',NULL,NULL,NULL,NULL),(93,2,'Wednesday','09:30:00','09:55:00','2023-11-01',0,'available',NULL,NULL,NULL,NULL),(94,2,'Thursday','08:00:00','08:25:00','2023-11-02',0,'available',NULL,NULL,NULL,NULL),(95,2,'Thursday','08:30:00','08:55:00','2023-11-02',0,'available',NULL,NULL,NULL,NULL),(96,2,'Thursday','09:00:00','09:25:00','2023-11-02',0,'available',NULL,NULL,NULL,NULL),(97,2,'Thursday','09:30:00','09:55:00','2023-11-02',0,'available',NULL,NULL,NULL,NULL),(98,2,'Friday','08:00:00','08:25:00','2023-11-03',0,'available',NULL,NULL,NULL,NULL),(99,2,'Friday','08:30:00','08:55:00','2023-11-03',0,'available',NULL,NULL,NULL,NULL),(100,2,'Friday','09:00:00','09:25:00','2023-11-03',0,'available',NULL,NULL,NULL,NULL),(101,2,'Friday','09:30:00','09:55:00','2023-11-03',0,'available',NULL,NULL,NULL,NULL),(102,2,'Saturday','08:00:00','08:25:00','2023-11-04',0,'available',NULL,NULL,NULL,NULL),(103,2,'Saturday','08:30:00','08:55:00','2023-11-04',0,'available',NULL,NULL,NULL,NULL),(104,2,'Saturday','09:00:00','09:25:00','2023-11-04',0,'available',NULL,NULL,NULL,NULL),(105,2,'Saturday','09:30:00','09:55:00','2023-11-04',0,'available',NULL,NULL,NULL,NULL),(106,2,'Sunday','08:00:00','08:25:00','2023-11-05',0,'available',NULL,NULL,NULL,NULL),(107,2,'Sunday','08:30:00','08:55:00','2023-11-05',0,'available',NULL,NULL,NULL,NULL),(108,2,'Sunday','09:00:00','09:25:00','2023-11-05',0,'available',NULL,NULL,NULL,NULL),(109,2,'Sunday','09:30:00','09:55:00','2023-11-05',0,'available',NULL,NULL,NULL,NULL),(110,2,'Monday','09:00:00','09:25:00','2023-11-06',0,'available',NULL,NULL,NULL,NULL),(111,2,'Monday','09:30:00','09:55:00','2023-11-06',0,'available',NULL,NULL,NULL,NULL),(112,2,'Tuesday','09:00:00','09:25:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(113,2,'Tuesday','09:30:00','09:55:00','2023-11-07',0,'available',NULL,NULL,NULL,NULL),(114,2,'Wednesday','08:00:00','08:25:00','2023-11-08',0,'available',NULL,NULL,NULL,NULL),(115,2,'Wednesday','08:30:00','08:55:00','2023-11-08',0,'available',NULL,NULL,NULL,NULL),(116,2,'Wednesday','09:00:00','09:25:00','2023-11-08',0,'available',NULL,NULL,NULL,NULL),(117,2,'Wednesday','09:30:00','09:55:00','2023-11-08',0,'available',NULL,NULL,NULL,NULL),(118,2,'Thursday','08:00:00','08:25:00','2023-11-09',0,'available',NULL,NULL,NULL,NULL),(119,2,'Thursday','08:30:00','08:55:00','2023-11-09',0,'available',NULL,NULL,NULL,NULL),(120,2,'Thursday','09:00:00','09:25:00','2023-11-09',0,'available',NULL,NULL,NULL,NULL),(121,2,'Thursday','09:30:00','09:55:00','2023-11-09',0,'available',NULL,NULL,NULL,NULL),(122,2,'Friday','08:00:00','08:25:00','2023-11-10',0,'available',NULL,NULL,NULL,NULL),(123,2,'Friday','08:30:00','08:55:00','2023-11-10',0,'available',NULL,NULL,NULL,NULL),(124,2,'Friday','09:00:00','09:25:00','2023-11-10',0,'available',NULL,NULL,NULL,NULL),(125,2,'Friday','09:30:00','09:55:00','2023-11-10',0,'available',NULL,NULL,NULL,NULL),(126,2,'Saturday','08:00:00','08:25:00','2023-11-11',0,'available',NULL,NULL,NULL,NULL),(127,2,'Saturday','08:30:00','08:55:00','2023-11-11',0,'available',NULL,NULL,NULL,NULL),(128,2,'Saturday','09:00:00','09:25:00','2023-11-11',0,'available',NULL,NULL,NULL,NULL),(129,2,'Saturday','09:30:00','09:55:00','2023-11-11',0,'available',NULL,NULL,NULL,NULL),(130,2,'Sunday','08:00:00','08:25:00','2023-11-12',0,'Completed',NULL,6,NULL,'2023-11-29 17:34:57'),(131,2,'Sunday','08:30:00','08:55:00','2023-11-12',0,'Completed',NULL,6,NULL,'2023-11-29 20:31:49'),(132,2,'Sunday','09:00:00','09:25:00','2023-11-12',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(133,2,'Sunday','09:30:00','09:55:00','2023-11-12',0,'available',NULL,NULL,NULL,NULL),(134,2,'Monday','09:00:00','09:25:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(135,2,'Monday','09:30:00','09:55:00','2023-11-13',0,'available',NULL,NULL,NULL,NULL),(136,2,'Tuesday','09:00:00','09:25:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(137,2,'Tuesday','09:30:00','09:55:00','2023-11-14',0,'available',NULL,NULL,NULL,NULL),(138,2,'Wednesday','08:00:00','08:25:00','2023-11-15',0,'available',NULL,NULL,NULL,NULL),(139,2,'Wednesday','08:30:00','08:55:00','2023-11-15',0,'available',NULL,NULL,NULL,NULL),(140,2,'Wednesday','09:00:00','09:25:00','2023-11-15',0,'available',NULL,NULL,NULL,NULL),(141,2,'Wednesday','09:30:00','09:55:00','2023-11-15',0,'available',NULL,NULL,NULL,NULL),(142,2,'Thursday','08:00:00','08:25:00','2023-11-16',0,'available',NULL,NULL,NULL,NULL),(143,2,'Thursday','08:30:00','08:55:00','2023-11-16',0,'available',NULL,NULL,NULL,NULL),(144,2,'Thursday','09:00:00','09:25:00','2023-11-16',0,'available',NULL,NULL,NULL,NULL),(145,2,'Thursday','09:30:00','09:55:00','2023-11-16',0,'available',NULL,NULL,NULL,NULL),(146,2,'Friday','08:00:00','08:25:00','2023-11-17',0,'available',NULL,NULL,NULL,NULL),(147,2,'Friday','08:30:00','08:55:00','2023-11-17',0,'available',NULL,NULL,NULL,NULL),(148,2,'Friday','09:00:00','09:25:00','2023-11-17',0,'available',NULL,NULL,NULL,NULL),(149,2,'Friday','09:30:00','09:55:00','2023-11-17',0,'available',NULL,NULL,NULL,NULL),(150,2,'Saturday','08:00:00','08:25:00','2023-11-18',0,'available',NULL,NULL,NULL,NULL),(151,2,'Saturday','08:30:00','08:55:00','2023-11-18',0,'available',NULL,NULL,NULL,NULL),(152,2,'Saturday','09:00:00','09:25:00','2023-11-18',0,'available',NULL,NULL,NULL,NULL),(153,2,'Saturday','09:30:00','09:55:00','2023-11-18',0,'available',NULL,NULL,NULL,NULL),(154,2,'Sunday','08:00:00','08:25:00','2023-11-19',0,'available',NULL,NULL,NULL,NULL),(155,2,'Sunday','08:30:00','08:55:00','2023-11-19',0,'available',NULL,NULL,NULL,NULL),(156,2,'Sunday','09:00:00','09:25:00','2023-11-19',0,'available',NULL,NULL,NULL,NULL),(157,2,'Sunday','09:30:00','09:55:00','2023-11-19',0,'available',NULL,NULL,NULL,NULL),(158,2,'Monday','09:00:00','09:25:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(159,2,'Monday','09:30:00','09:55:00','2023-11-20',0,'available',NULL,NULL,NULL,NULL),(160,2,'Tuesday','09:00:00','09:25:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(161,2,'Tuesday','09:30:00','09:55:00','2023-11-21',0,'available',NULL,NULL,NULL,NULL),(162,2,'Wednesday','08:00:00','08:25:00','2023-11-22',0,'available',NULL,NULL,NULL,NULL),(163,2,'Wednesday','08:30:00','08:55:00','2023-11-22',0,'available',NULL,NULL,NULL,NULL),(164,2,'Wednesday','09:00:00','09:25:00','2023-11-22',0,'available',NULL,NULL,NULL,NULL),(165,2,'Wednesday','09:30:00','09:55:00','2023-11-22',0,'available',NULL,NULL,NULL,NULL),(166,2,'Thursday','08:00:00','08:25:00','2023-11-23',0,'available',NULL,NULL,NULL,NULL),(167,2,'Thursday','08:30:00','08:55:00','2023-11-23',0,'available',NULL,NULL,NULL,NULL),(168,2,'Thursday','09:00:00','09:25:00','2023-11-23',0,'available',NULL,NULL,NULL,NULL),(169,2,'Thursday','09:30:00','09:55:00','2023-11-23',0,'available',NULL,NULL,NULL,NULL),(170,2,'Friday','08:00:00','08:25:00','2023-11-24',0,'available',NULL,NULL,NULL,NULL),(171,2,'Friday','08:30:00','08:55:00','2023-11-24',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(172,2,'Friday','09:00:00','09:25:00','2023-11-24',0,'available',NULL,NULL,NULL,'2023-11-21 21:56:23'),(173,2,'Friday','09:30:00','09:55:00','2023-11-24',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(174,3,'Tuesday','08:00:00','08:25:00','2023-11-28',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(175,3,'Sunday','08:00:00','08:25:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(176,3,'Monday','08:00:00','08:25:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(177,3,'Tuesday','08:00:00','08:25:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(178,3,'Sunday','08:00:00','08:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(179,3,'Monday','08:00:00','08:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(180,3,'Tuesday','08:00:00','08:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(181,3,'Sunday','08:00:00','08:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(182,3,'Monday','08:00:00','08:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(183,3,'Tuesday','08:00:00','08:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(184,3,'Sunday','08:00:00','08:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(185,3,'Monday','08:00:00','08:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(186,3,'Tuesday','08:00:00','08:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(187,3,'Tuesday','10:30:00','10:55:00','2023-11-28',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(188,3,'Tuesday','11:00:00','11:25:00','2023-11-28',0,'absent',NULL,6,NULL,'2023-11-29 21:37:30'),(189,3,'Tuesday','11:30:00','11:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(190,3,'Tuesday','12:00:00','12:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(191,3,'Tuesday','12:30:00','12:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(192,3,'Tuesday','13:00:00','13:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(193,3,'Tuesday','13:30:00','13:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(194,3,'Wednesday','10:30:00','10:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(195,3,'Wednesday','11:00:00','11:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(196,3,'Wednesday','11:30:00','11:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(197,3,'Wednesday','12:00:00','12:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(198,3,'Wednesday','12:30:00','12:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(199,3,'Wednesday','13:00:00','13:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(200,3,'Wednesday','13:30:00','13:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(201,3,'Thursday','10:30:00','10:55:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(202,3,'Thursday','11:00:00','11:25:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(203,3,'Thursday','11:30:00','11:55:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(204,3,'Thursday','12:00:00','12:25:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(205,3,'Thursday','12:30:00','12:55:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(206,3,'Thursday','13:00:00','13:25:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(207,3,'Thursday','13:30:00','13:55:00','2023-11-30',0,'available',NULL,NULL,NULL,NULL),(208,3,'Sunday','10:30:00','10:55:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(209,3,'Sunday','11:00:00','11:25:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(210,3,'Sunday','11:30:00','11:55:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(211,3,'Sunday','12:00:00','12:25:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(212,3,'Sunday','12:30:00','12:55:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(213,3,'Sunday','13:00:00','13:25:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(214,3,'Sunday','13:30:00','13:55:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(215,3,'Monday','10:30:00','10:55:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(216,3,'Monday','11:00:00','11:25:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(217,3,'Monday','11:30:00','11:55:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(218,3,'Monday','12:00:00','12:25:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(219,3,'Monday','12:30:00','12:55:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(220,3,'Monday','13:00:00','13:25:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(221,3,'Monday','13:30:00','13:55:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(222,3,'Tuesday','10:30:00','10:55:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(223,3,'Tuesday','11:00:00','11:25:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(224,3,'Tuesday','11:30:00','11:55:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(225,3,'Tuesday','12:00:00','12:25:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(226,3,'Tuesday','12:30:00','12:55:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(227,3,'Tuesday','13:00:00','13:25:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(228,3,'Tuesday','13:30:00','13:55:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(229,3,'Wednesday','10:30:00','10:55:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(230,3,'Wednesday','11:00:00','11:25:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(231,3,'Wednesday','11:30:00','11:55:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(232,3,'Wednesday','12:00:00','12:25:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(233,3,'Wednesday','12:30:00','12:55:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(234,3,'Wednesday','13:00:00','13:25:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(235,3,'Wednesday','13:30:00','13:55:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(236,3,'Thursday','10:30:00','10:55:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(237,3,'Thursday','11:00:00','11:25:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(238,3,'Thursday','11:30:00','11:55:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(239,3,'Thursday','12:00:00','12:25:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(240,3,'Thursday','12:30:00','12:55:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(241,3,'Thursday','13:00:00','13:25:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(242,3,'Thursday','13:30:00','13:55:00','2023-12-07',0,'available',NULL,NULL,NULL,NULL),(243,3,'Sunday','10:30:00','10:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(244,3,'Sunday','11:00:00','11:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(245,3,'Sunday','11:30:00','11:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(246,3,'Sunday','12:00:00','12:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(247,3,'Sunday','12:30:00','12:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(248,3,'Sunday','13:00:00','13:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(249,3,'Sunday','13:30:00','13:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(250,3,'Monday','10:30:00','10:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(251,3,'Monday','11:00:00','11:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(252,3,'Monday','11:30:00','11:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(253,3,'Monday','12:00:00','12:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(254,3,'Monday','12:30:00','12:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(255,3,'Monday','13:00:00','13:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(256,3,'Monday','13:30:00','13:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(257,3,'Tuesday','10:30:00','10:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(258,3,'Tuesday','11:00:00','11:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(259,3,'Tuesday','11:30:00','11:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(260,3,'Tuesday','12:00:00','12:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(261,3,'Tuesday','12:30:00','12:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(262,3,'Tuesday','13:00:00','13:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(263,3,'Tuesday','13:30:00','13:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(264,3,'Wednesday','10:30:00','10:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(265,3,'Wednesday','11:00:00','11:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(266,3,'Wednesday','11:30:00','11:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(267,3,'Wednesday','12:00:00','12:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(268,3,'Wednesday','12:30:00','12:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(269,3,'Wednesday','13:00:00','13:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(270,3,'Wednesday','13:30:00','13:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(271,3,'Thursday','10:30:00','10:55:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(272,3,'Thursday','11:00:00','11:25:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(273,3,'Thursday','11:30:00','11:55:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(274,3,'Thursday','12:00:00','12:25:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(275,3,'Thursday','12:30:00','12:55:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(276,3,'Thursday','13:00:00','13:25:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(277,3,'Thursday','13:30:00','13:55:00','2023-12-14',0,'available',NULL,NULL,NULL,NULL),(278,3,'Sunday','10:30:00','10:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(279,3,'Sunday','11:00:00','11:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(280,3,'Sunday','11:30:00','11:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(281,3,'Sunday','12:00:00','12:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(282,3,'Sunday','12:30:00','12:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(283,3,'Sunday','13:00:00','13:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(284,3,'Sunday','13:30:00','13:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(285,3,'Monday','10:30:00','10:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(286,3,'Monday','11:00:00','11:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(287,3,'Monday','11:30:00','11:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(288,3,'Monday','12:00:00','12:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(289,3,'Monday','12:30:00','12:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(290,3,'Monday','13:00:00','13:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(291,3,'Monday','13:30:00','13:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(292,3,'Tuesday','10:30:00','10:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(293,3,'Tuesday','11:00:00','11:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(294,3,'Tuesday','11:30:00','11:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(295,3,'Tuesday','12:00:00','12:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(296,3,'Tuesday','12:30:00','12:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(297,3,'Tuesday','13:00:00','13:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(298,3,'Tuesday','13:30:00','13:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(299,3,'Wednesday','10:30:00','10:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(300,3,'Wednesday','11:00:00','11:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(301,3,'Wednesday','11:30:00','11:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(302,3,'Wednesday','12:00:00','12:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(303,3,'Wednesday','12:30:00','12:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(304,3,'Wednesday','13:00:00','13:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(305,3,'Wednesday','13:30:00','13:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(306,3,'Thursday','10:30:00','10:55:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(307,3,'Thursday','11:00:00','11:25:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(308,3,'Thursday','11:30:00','11:55:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(309,3,'Thursday','12:00:00','12:25:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(310,3,'Thursday','12:30:00','12:55:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(311,3,'Thursday','13:00:00','13:25:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(312,3,'Thursday','13:30:00','13:55:00','2023-12-21',0,'available',NULL,NULL,NULL,NULL),(313,3,'Sunday','10:30:00','10:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(314,3,'Sunday','11:00:00','11:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(315,3,'Sunday','11:30:00','11:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(316,3,'Sunday','12:00:00','12:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(317,3,'Sunday','12:30:00','12:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(318,3,'Sunday','13:00:00','13:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(319,3,'Sunday','13:30:00','13:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(320,3,'Monday','10:30:00','10:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(321,3,'Monday','11:00:00','11:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(322,3,'Monday','11:30:00','11:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(323,3,'Monday','12:00:00','12:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(324,3,'Monday','12:30:00','12:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(325,3,'Monday','13:00:00','13:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(326,3,'Monday','13:30:00','13:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(327,3,'Tuesday','10:30:00','10:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(328,3,'Tuesday','11:00:00','11:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(329,3,'Tuesday','11:30:00','11:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(330,3,'Tuesday','12:00:00','12:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(331,3,'Tuesday','12:30:00','12:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(332,3,'Tuesday','13:00:00','13:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(333,3,'Tuesday','13:30:00','13:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(334,3,'Wednesday','10:30:00','10:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(335,3,'Wednesday','11:00:00','11:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(336,3,'Wednesday','11:30:00','11:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(337,3,'Wednesday','12:00:00','12:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(338,3,'Wednesday','12:30:00','12:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(339,3,'Wednesday','13:00:00','13:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(340,3,'Wednesday','13:30:00','13:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(341,3,'Thursday','10:30:00','10:55:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(342,3,'Thursday','11:00:00','11:25:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(343,3,'Thursday','11:30:00','11:55:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(344,3,'Thursday','12:00:00','12:25:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(345,3,'Thursday','12:30:00','12:55:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(346,3,'Thursday','13:00:00','13:25:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(347,3,'Thursday','13:30:00','13:55:00','2023-12-28',0,'available',NULL,NULL,NULL,NULL),(348,2,'Tuesday','08:00:00','08:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(349,2,'Tuesday','08:30:00','08:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(350,2,'Tuesday','09:00:00','09:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(351,2,'Tuesday','09:30:00','09:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(352,2,'Tuesday','10:00:00','10:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(353,2,'Tuesday','10:30:00','10:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(354,2,'Tuesday','11:00:00','11:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(355,2,'Tuesday','11:30:00','11:55:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(356,2,'Tuesday','12:00:00','12:25:00','2023-11-28',0,'available',NULL,NULL,NULL,NULL),(357,2,'Wednesday','08:00:00','08:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(358,2,'Wednesday','08:30:00','08:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(359,2,'Wednesday','09:00:00','09:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(360,2,'Wednesday','09:30:00','09:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(361,2,'Wednesday','10:00:00','10:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(362,2,'Wednesday','10:30:00','10:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(363,2,'Wednesday','11:00:00','11:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(364,2,'Wednesday','11:30:00','11:55:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(365,2,'Wednesday','12:00:00','12:25:00','2023-11-29',0,'available',NULL,NULL,NULL,NULL),(366,2,'Sunday','08:00:00','08:25:00','2023-12-03',0,'Completed',NULL,6,NULL,'2023-11-29 22:59:17'),(367,2,'Sunday','08:30:00','08:55:00','2023-12-03',0,'Canceled',NULL,6,NULL,'2023-11-30 23:18:26'),(368,2,'Sunday','09:00:00','09:25:00','2023-12-03',0,'Completed',NULL,6,NULL,'2023-11-30 23:24:03'),(369,2,'Sunday','09:30:00','09:55:00','2023-12-03',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(370,2,'Sunday','10:00:00','10:25:00','2023-12-03',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(371,2,'Sunday','10:30:00','10:55:00','2023-12-03',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(372,2,'Sunday','11:00:00','11:25:00','2023-12-03',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(373,2,'Sunday','11:30:00','11:55:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(374,2,'Sunday','12:00:00','12:25:00','2023-12-03',0,'available',NULL,NULL,NULL,NULL),(375,2,'Monday','08:00:00','08:25:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(376,2,'Monday','08:30:00','08:55:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(377,2,'Monday','09:00:00','09:25:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(378,2,'Monday','09:30:00','09:55:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(379,2,'Monday','10:00:00','10:25:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(380,2,'Monday','10:30:00','10:55:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(381,2,'Monday','11:00:00','11:25:00','2023-12-04',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(382,2,'Monday','11:30:00','11:55:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(383,2,'Monday','12:00:00','12:25:00','2023-12-04',0,'available',NULL,NULL,NULL,NULL),(384,2,'Tuesday','08:00:00','08:25:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(385,2,'Tuesday','08:30:00','08:55:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(386,2,'Tuesday','09:00:00','09:25:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(387,2,'Tuesday','09:30:00','09:55:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(388,2,'Tuesday','10:00:00','10:25:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(389,2,'Tuesday','10:30:00','10:55:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(390,2,'Tuesday','11:00:00','11:25:00','2023-12-05',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(391,2,'Tuesday','11:30:00','11:55:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(392,2,'Tuesday','12:00:00','12:25:00','2023-12-05',0,'available',NULL,NULL,NULL,NULL),(393,2,'Wednesday','08:00:00','08:25:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(394,2,'Wednesday','08:30:00','08:55:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(395,2,'Wednesday','09:00:00','09:25:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-12-03 20:17:46'),(396,2,'Wednesday','09:30:00','09:55:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(397,2,'Wednesday','10:00:00','10:25:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(398,2,'Wednesday','10:30:00','10:55:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(399,2,'Wednesday','11:00:00','11:25:00','2023-12-06',0,'booked',NULL,6,NULL,'2023-11-29 21:41:00'),(400,2,'Wednesday','11:30:00','11:55:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(401,2,'Wednesday','12:00:00','12:25:00','2023-12-06',0,'available',NULL,NULL,NULL,NULL),(402,2,'Sunday','08:00:00','08:25:00','2023-12-10',0,'booked',NULL,6,NULL,'2023-12-03 20:17:46'),(403,2,'Sunday','08:30:00','08:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(404,2,'Sunday','09:00:00','09:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(405,2,'Sunday','09:30:00','09:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(406,2,'Sunday','10:00:00','10:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(407,2,'Sunday','10:30:00','10:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(408,2,'Sunday','11:00:00','11:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(409,2,'Sunday','11:30:00','11:55:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(410,2,'Sunday','12:00:00','12:25:00','2023-12-10',0,'available',NULL,NULL,NULL,NULL),(411,2,'Monday','08:00:00','08:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(412,2,'Monday','08:30:00','08:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(413,2,'Monday','09:00:00','09:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(414,2,'Monday','09:30:00','09:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(415,2,'Monday','10:00:00','10:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(416,2,'Monday','10:30:00','10:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(417,2,'Monday','11:00:00','11:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(418,2,'Monday','11:30:00','11:55:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(419,2,'Monday','12:00:00','12:25:00','2023-12-11',0,'available',NULL,NULL,NULL,NULL),(420,2,'Tuesday','08:00:00','08:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(421,2,'Tuesday','08:30:00','08:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(422,2,'Tuesday','09:00:00','09:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(423,2,'Tuesday','09:30:00','09:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(424,2,'Tuesday','10:00:00','10:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(425,2,'Tuesday','10:30:00','10:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(426,2,'Tuesday','11:00:00','11:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(427,2,'Tuesday','11:30:00','11:55:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(428,2,'Tuesday','12:00:00','12:25:00','2023-12-12',0,'available',NULL,NULL,NULL,NULL),(429,2,'Wednesday','08:00:00','08:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(430,2,'Wednesday','08:30:00','08:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(431,2,'Wednesday','09:00:00','09:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(432,2,'Wednesday','09:30:00','09:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(433,2,'Wednesday','10:00:00','10:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(434,2,'Wednesday','10:30:00','10:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(435,2,'Wednesday','11:00:00','11:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(436,2,'Wednesday','11:30:00','11:55:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(437,2,'Wednesday','12:00:00','12:25:00','2023-12-13',0,'available',NULL,NULL,NULL,NULL),(438,2,'Sunday','08:00:00','08:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(439,2,'Sunday','08:30:00','08:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(440,2,'Sunday','09:00:00','09:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(441,2,'Sunday','09:30:00','09:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(442,2,'Sunday','10:00:00','10:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(443,2,'Sunday','10:30:00','10:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(444,2,'Sunday','11:00:00','11:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(445,2,'Sunday','11:30:00','11:55:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(446,2,'Sunday','12:00:00','12:25:00','2023-12-17',0,'available',NULL,NULL,NULL,NULL),(447,2,'Monday','08:00:00','08:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(448,2,'Monday','08:30:00','08:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(449,2,'Monday','09:00:00','09:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(450,2,'Monday','09:30:00','09:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(451,2,'Monday','10:00:00','10:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(452,2,'Monday','10:30:00','10:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(453,2,'Monday','11:00:00','11:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(454,2,'Monday','11:30:00','11:55:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(455,2,'Monday','12:00:00','12:25:00','2023-12-18',0,'available',NULL,NULL,NULL,NULL),(456,2,'Tuesday','08:00:00','08:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(457,2,'Tuesday','08:30:00','08:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(458,2,'Tuesday','09:00:00','09:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(459,2,'Tuesday','09:30:00','09:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(460,2,'Tuesday','10:00:00','10:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(461,2,'Tuesday','10:30:00','10:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(462,2,'Tuesday','11:00:00','11:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(463,2,'Tuesday','11:30:00','11:55:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(464,2,'Tuesday','12:00:00','12:25:00','2023-12-19',0,'available',NULL,NULL,NULL,NULL),(465,2,'Wednesday','08:00:00','08:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(466,2,'Wednesday','08:30:00','08:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(467,2,'Wednesday','09:00:00','09:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(468,2,'Wednesday','09:30:00','09:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(469,2,'Wednesday','10:00:00','10:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(470,2,'Wednesday','10:30:00','10:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(471,2,'Wednesday','11:00:00','11:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(472,2,'Wednesday','11:30:00','11:55:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(473,2,'Wednesday','12:00:00','12:25:00','2023-12-20',0,'available',NULL,NULL,NULL,NULL),(474,2,'Sunday','08:00:00','08:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(475,2,'Sunday','08:30:00','08:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(476,2,'Sunday','09:00:00','09:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(477,2,'Sunday','09:30:00','09:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(478,2,'Sunday','10:00:00','10:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(479,2,'Sunday','10:30:00','10:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(480,2,'Sunday','11:00:00','11:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(481,2,'Sunday','11:30:00','11:55:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(482,2,'Sunday','12:00:00','12:25:00','2023-12-24',0,'available',NULL,NULL,NULL,NULL),(483,2,'Monday','08:00:00','08:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(484,2,'Monday','08:30:00','08:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(485,2,'Monday','09:00:00','09:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(486,2,'Monday','09:30:00','09:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(487,2,'Monday','10:00:00','10:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(488,2,'Monday','10:30:00','10:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(489,2,'Monday','11:00:00','11:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(490,2,'Monday','11:30:00','11:55:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(491,2,'Monday','12:00:00','12:25:00','2023-12-25',0,'available',NULL,NULL,NULL,NULL),(492,2,'Tuesday','08:00:00','08:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(493,2,'Tuesday','08:30:00','08:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(494,2,'Tuesday','09:00:00','09:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(495,2,'Tuesday','09:30:00','09:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(496,2,'Tuesday','10:00:00','10:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(497,2,'Tuesday','10:30:00','10:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(498,2,'Tuesday','11:00:00','11:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(499,2,'Tuesday','11:30:00','11:55:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(500,2,'Tuesday','12:00:00','12:25:00','2023-12-26',0,'available',NULL,NULL,NULL,NULL),(501,2,'Wednesday','08:00:00','08:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(502,2,'Wednesday','08:30:00','08:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(503,2,'Wednesday','09:00:00','09:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(504,2,'Wednesday','09:30:00','09:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(505,2,'Wednesday','10:00:00','10:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(506,2,'Wednesday','10:30:00','10:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(507,2,'Wednesday','11:00:00','11:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(508,2,'Wednesday','11:30:00','11:55:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL),(509,2,'Wednesday','12:00:00','12:25:00','2023-12-27',0,'available',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `class_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,0,'234',NULL,NULL,'appetie',0,'2023-11-13 19:22:00','2023-11-13 19:22:00'),(2,0,'kevin',NULL,NULL,'appetie',0,'2023-11-13 19:22:55','2023-11-13 19:22:55'),(3,0,'vicky',NULL,NULL,'appetite',0,'2023-11-13 19:23:41','2023-11-13 19:23:41'),(4,0,'234',NULL,NULL,'234',0,'2023-11-13 19:44:07','2023-11-13 19:44:07'),(5,0,'Iris',NULL,NULL,'23234',0,'2023-11-13 19:51:03','2023-11-13 19:51:03'),(6,0,'Iris3234','23423@gmail.com',NULL,'23234',0,'2023-11-13 19:53:43','2023-11-13 19:53:43'),(7,0,'Iris3234','23423@gmail.com',NULL,'23234',0,'2023-11-13 19:57:06','2023-11-13 19:57:06'),(8,0,'2423423423424','223@hotmail.com',NULL,'apppteite',0,'2023-11-13 19:57:23','2023-11-13 19:57:23'),(9,13,'8888','888@gmail.com',NULL,'8888',0,'2023-11-13 21:15:03','2023-11-13 21:15:03'),(10,14,'77777','77@gmail.com',NULL,'7777',0,'2023-11-13 21:15:44','2023-11-13 21:15:44'),(11,14,'6666','6666@gmail.com',NULL,'6666',0,'2023-11-13 23:59:51','2023-11-13 23:59:51'),(12,14,'5555','5555@gmail.com',NULL,'55555',0,'2023-11-14 01:12:27','2023-11-14 01:12:27'),(13,14,'仲城',NULL,NULL,'123123',1,'2023-11-14 04:53:06','2023-11-14 04:53:06'),(14,14,'仲城 謝',NULL,NULL,'appetite',1,'2023-11-14 05:05:58','2023-11-14 05:05:58'),(15,14,' 仲城',NULL,'avatars/Q18WSlOSda5g2FBcNkU5i1ELZ6UscCvXLEuBAli3.png','jean',1,'2023-11-14 05:14:52','2023-11-14 05:14:52'),(16,14,' 仲城',NULL,'avatars/Q18WSlOSda5g2FBcNkU5i1ELZ6UscCvXLEuBAli3.png','kevin',1,'2023-11-14 05:15:21','2023-11-14 05:15:21'),(17,14,'5555','55@gmail.com','avatars/Q18WSlOSda5g2FBcNkU5i1ELZ6UscCvXLEuBAli3.png','apete',1,'2023-11-14 05:22:10','2023-11-14 05:22:10'),(18,14,'234234234234','23423@gmail.com','avatars/dRmGWf4ToeTxoX0vJbFphfBd2BGBD4nPra5aIxrm.png','234234234',6,'2023-11-14 19:56:29','2023-11-14 19:56:29');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'General English','一般常用英文練習','2023-09-27 14:03:37','2023-09-27 14:03:37'),(2,'雅思課程','考試類的課程，上班族會需要','2023-09-28 02:18:55','2023-09-28 02:21:15'),(3,'多益課程','考試類的課程，上班族會需要','2023-09-28 02:23:33','2023-09-28 02:23:33'),(4,'托福課程','考試類的課程，上班族會需要','2023-09-28 02:24:08','2023-09-28 02:24:08'),(5,'商用英文','考試類的課程，上班族會需要','2023-09-28 02:58:21','2023-09-28 02:58:21'),(7,'青少年課程','專為青少年設計的語言學習課程','2023-10-24 04:32:30','2023-10-24 04:32:30');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `mentor_courses`
--

DROP TABLE IF EXISTS `mentor_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mentor_courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mentor_courses_user_id_foreign` (`user_id`),
  KEY `mentor_courses_course_id_foreign` (`course_id`),
  CONSTRAINT `mentor_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mentor_courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mentor_courses`
--

LOCK TABLES `mentor_courses` WRITE;
/*!40000 ALTER TABLE `mentor_courses` DISABLE KEYS */;
INSERT INTO `mentor_courses` VALUES (2,2,1,NULL,NULL),(3,2,2,NULL,NULL),(4,2,3,NULL,NULL),(5,2,4,NULL,NULL),(8,3,1,NULL,NULL),(14,3,2,NULL,NULL),(15,22,1,NULL,NULL),(16,22,2,NULL,NULL),(17,22,3,NULL,NULL);
/*!40000 ALTER TABLE `mentor_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint unsigned NOT NULL,
  `to_user_id` bigint unsigned DEFAULT NULL,
  `chat_room_id` bigint unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_from_user_id_foreign` (`from_user_id`),
  KEY `messages_to_user_id_foreign` (`to_user_id`),
  KEY `messages_chat_room_id_foreign` (`chat_room_id`),
  CONSTRAINT `messages_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`),
  CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,2,NULL,NULL,'234234234',NULL,'2023-10-05 17:50:34','2023-10-05 17:50:34',''),(2,2,NULL,NULL,'234234',NULL,'2023-10-05 17:51:16','2023-10-05 17:51:16',''),(3,2,NULL,NULL,'謝謝你',NULL,'2023-10-05 18:16:10','2023-10-05 18:16:10',''),(4,2,NULL,NULL,'23423',NULL,'2023-10-06 03:30:13','2023-10-06 03:30:13',''),(5,2,NULL,NULL,'234324',NULL,'2023-10-06 03:55:55','2023-10-06 03:55:55',''),(6,2,NULL,NULL,'666666',NULL,'2023-10-06 03:56:09','2023-10-06 03:56:09',''),(7,2,NULL,NULL,'5555',NULL,'2023-10-06 03:58:54','2023-10-06 03:58:54',''),(8,2,NULL,NULL,'4324',NULL,'2023-10-06 04:01:15','2023-10-06 04:01:15',''),(9,2,NULL,NULL,'312312',NULL,'2023-10-06 08:42:36','2023-10-06 08:42:36',''),(10,2,NULL,NULL,'56565',NULL,'2023-10-06 10:59:57','2023-10-06 10:59:57',''),(11,6,NULL,NULL,'3dsf23423',NULL,'2023-10-11 13:53:34','2023-10-11 13:53:34',''),(12,6,NULL,NULL,'謝仲城',NULL,'2023-10-11 13:53:41','2023-10-11 13:53:41','');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2023_09_21_135534_add_gender_to_users_table',1),(11,'2023_09_21_152424_add_avatar_path_to_users_table',1),(12,'2023_09_22_204711_add_activation_to_users_table',1),(13,'2023_09_23_210037_create_courses_table',1),(14,'2023_09_23_210047_create_class_schedules_table',1),(15,'2023_09_25_183639_add_status_to_class_schedules_table',1),(16,'2023_09_26_004059_create_bookings_table',1),(17,'2023_09_26_005734_add_schedule_date_to_class_schedules_table',2),(18,'2023_09_28_024823_alter_day_of_week_column_in_class_schedule_table',3),(19,'2023_09_30_133816_remove_course_id_from_class_schedules_table',4),(21,'2023_10_04_150150_create_chat_rooms_table',5),(22,'2023_10_04_151150_create_messages_table',6),(25,'2023_10_06_014336_add_type_to_messages_table',7),(27,'2023_10_13_160559_add_timestamps_to_class_schedules_table',8),(28,'2023_10_16_101555_add_mentor_id_to_class_schedules_table',9),(29,'2023_10_16_103645_rename_mentor_id_to_mentee_id_in_class_schedules_table',9),(30,'2023_10_16_220240_add_google_meet_code_to_users_table',10),(31,'2023_10_18_094749_add_additional_fields_to_users_table',11),(32,'2023_10_24_154053_add_user_id_to_courses_table',12),(33,'2023_10_24_155131_remove_user_id_from_courses_table',13),(34,'2023_10_24_155258_create_mentor_courses_table',14),(35,'2023_10_27_172757_create_payment_plans_table',15),(36,'2023_11_06_093421_create_blogs_table',16),(37,'2023_11_13_033555_add_author_to_blogs_table',17),(38,'2023_11_13_054436_add_avatar_path_to_blogs_table',18),(39,'2023_11_14_020233_create_comments_table',19),(40,'2023_11_14_034840_add_email_to_comments_table',20),(41,'2023_11_14_045008_add_blog_id_to_comments_table',21),(42,'2023_11_24_005252_create_reviews_table',22),(43,'2023_11_24_084653_update_foreign_key_in_reviews_table',23),(44,'2023_11_24_105047_add_mentor_id_to_reviews_table',24),(45,'2023_12_05_010935_create_orders_table',25),(46,'2023_12_05_010945_create_class_bookings_table',25);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','qhXqFAn1t3VfaEsrwmLYFv8ZqOxCoO3JWkMPdxR0',NULL,'http://localhost',1,0,0,'2023-10-12 08:44:06','2023-10-12 08:44:06'),(2,NULL,'Laravel Password Grant Client','VUBeKFDQRkOWpjW9wDh9hYtHLRFh02xJNSx90gqI','users','http://localhost',0,1,0,'2023-10-12 08:44:06','2023-10-12 08:44:06'),(3,NULL,'Laravel Personal Access Client','jxZtVSL7GH1fJdbdRMpJIMjaS4kRsTiD3KI1PnWo',NULL,'http://localhost',1,0,0,'2023-10-12 08:45:32','2023-10-12 08:45:32'),(4,NULL,'Laravel Password Grant Client','DWGIfb8upiUo4lVh0dUB0wYlkSVs3ct9hCkGQ032','users','http://localhost',0,1,0,'2023-10-12 08:45:32','2023-10-12 08:45:32'),(5,NULL,'Laravel Personal Access Client','W5NoCTwocK1akUYYqafHXxlpWAZeVbxJwnsd5UzX',NULL,'http://localhost',1,0,0,'2023-10-12 08:52:12','2023-10-12 08:52:12'),(6,NULL,'Laravel Password Grant Client','knomEa5me0f0YS6aujXJOrd1nFMSixXIvAKDZTll','users','http://localhost',0,1,0,'2023-10-12 08:52:12','2023-10-12 08:52:12');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2023-10-12 08:44:06','2023-10-12 08:44:06'),(2,3,'2023-10-12 08:45:32','2023-10-12 08:45:32'),(3,5,'2023-10-12 08:52:12','2023-10-12 08:52:12');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `payment_plan_id` bigint unsigned NOT NULL,
  `total_lessons` int NOT NULL,
  `remaining_lessons` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_payment_plan_id_foreign` (`payment_plan_id`),
  CONSTRAINT `orders_payment_plan_id_foreign` FOREIGN KEY (`payment_plan_id`) REFERENCES `payment_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,35,1,5,3,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(2,36,1,14,1,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(3,37,1,6,1,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(4,38,1,11,5,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(5,39,1,11,1,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(6,40,1,12,3,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(7,41,1,7,5,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(8,42,1,12,4,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(9,43,1,8,2,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(10,44,1,13,3,'2023-12-05','2024-01-04','2023-12-04 21:31:02','2023-12-04 21:31:02'),(11,45,1,15,4,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(12,46,1,7,1,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(13,47,1,15,4,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(14,48,1,8,1,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(15,49,1,10,1,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(16,50,1,14,2,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(17,51,1,14,3,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(18,52,1,15,2,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(19,53,1,7,3,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(20,54,1,8,5,'2023-12-05','2024-01-04','2023-12-04 21:31:56','2023-12-04 21:31:56'),(21,1,1,7,4,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(22,1,1,9,2,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(23,1,1,9,2,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(24,1,1,11,1,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(25,1,1,5,5,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(26,1,1,7,4,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(27,1,1,7,4,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(28,1,1,14,5,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(29,1,1,12,1,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(30,1,1,6,2,'2023-12-05','2024-01-04','2023-12-04 21:39:18','2023-12-04 21:39:18'),(31,1,1,14,5,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(32,1,1,15,2,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(33,1,1,7,3,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(34,1,1,12,5,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(35,1,1,10,2,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(36,1,1,6,4,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(37,1,1,14,1,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(38,1,1,7,3,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(39,1,1,5,4,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(40,1,1,8,2,'2023-12-05','2024-01-04','2023-12-04 21:40:34','2023-12-04 21:40:34'),(41,1,1,15,2,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(42,1,1,11,5,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(43,1,1,5,2,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(44,1,1,8,1,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(45,1,1,14,5,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(46,1,1,7,1,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(47,1,1,6,5,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(48,1,1,7,3,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(49,1,1,6,1,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(50,1,1,12,5,'2023-12-05','2024-01-04','2023-12-04 21:40:47','2023-12-04 21:40:47'),(51,1,1,8,5,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(52,1,1,11,4,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(53,1,1,9,1,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(54,1,1,5,1,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(55,1,1,12,1,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(56,1,1,5,3,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(57,1,1,10,4,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(58,1,1,15,3,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(59,1,1,7,1,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(60,1,1,7,5,'2023-12-05','2024-01-04','2023-12-04 21:41:12','2023-12-04 21:41:12'),(61,1,1,15,4,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(62,1,1,6,3,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(63,1,1,8,3,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(64,1,1,10,2,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(65,1,1,6,2,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(66,1,1,13,2,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(67,1,1,12,5,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(68,1,1,12,1,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(69,1,1,9,2,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(70,1,1,5,2,'2023-12-05','2024-01-04','2023-12-04 21:42:38','2023-12-04 21:42:38'),(71,1,1,8,8,'2023-12-05','2024-01-04','2023-12-04 21:44:17','2023-12-04 21:44:17');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `payment_plans`
--

DROP TABLE IF EXISTS `payment_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lessons` int NOT NULL,
  `price` int NOT NULL,
  `duration` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_plans`
--

LOCK TABLES `payment_plans` WRITE;
/*!40000 ALTER TABLE `payment_plans` DISABLE KEYS */;
INSERT INTO `payment_plans` VALUES (1,'月繳方案',8,1980,30,'30天自動扣款','2023-10-27 10:08:02','2023-10-27 10:08:02'),(2,'月繳方案',12,2940,30,'30天自動扣款','2023-10-27 10:10:21','2023-10-27 10:10:21'),(3,'月繳方案',20,4800,30,'30天自動扣款','2023-10-27 10:11:02','2023-10-27 10:11:02'),(4,'月繳方案',24,5640,30,'30天自動扣款','2023-10-27 10:11:27','2023-10-27 10:11:27'),(5,'季繳方案',24,8000,90,'90天自動扣款','2023-11-20 19:52:40','2023-11-20 19:52:40'),(6,'季繳方案',36,8000,90,'90天自動扣款','2023-11-20 19:55:26','2023-11-20 19:55:26'),(7,'季繳方案',48,8000,90,'90天自動扣款','2023-11-20 19:55:26','2023-11-20 19:55:26'),(8,'季繳方案',60,8000,90,'90天自動扣款','2023-11-20 19:55:31','2023-11-20 19:55:31'),(9,'半年繳方案',48,15000,180,'180天自動扣款','2023-11-20 19:58:21','2023-11-20 19:58:21'),(10,'半年繳方案',72,15000,180,'180天自動扣款','2023-11-20 19:58:21','2023-11-20 19:58:21'),(11,'半年繳方案',120,15000,180,'180天自動扣款','2023-11-20 19:58:21','2023-11-20 19:58:21'),(12,'半年繳方案',144,15000,180,'180天自動扣款','2023-11-20 19:58:22','2023-11-20 19:58:22'),(13,'年繳方案',96,28000,365,'365天自動扣款','2023-11-20 19:59:39','2023-11-20 19:59:39'),(14,'年繳方案',144,28000,365,'365天自動扣款','2023-11-20 19:59:39','2023-11-20 19:59:39'),(15,'年繳方案',240,28000,365,'365天自動扣款','2023-11-20 19:59:39','2023-11-20 19:59:39'),(16,'年繳方案',288,28000,365,'365天自動扣款','2023-11-20 19:59:39','2023-11-20 19:59:39');
/*!40000 ALTER TABLE `payment_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `mentor_id` bigint unsigned DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_booking_id_foreign` (`booking_id`),
  CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `class_schedules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (8,74,NULL,4,'234234234','2023-11-24 00:47:56','2023-11-24 00:47:56'),(9,74,NULL,5,'2342342','2023-11-24 00:54:17','2023-11-24 00:54:17'),(10,74,NULL,5,'23423423423','2023-11-24 00:54:59','2023-11-24 00:54:59'),(11,74,NULL,1,'234234234','2023-11-24 00:55:23','2023-11-24 00:55:23'),(12,75,NULL,5,'999999','2023-11-24 01:07:56','2023-11-24 01:07:56'),(13,76,NULL,1,'11111','2023-11-24 01:08:13','2023-11-24 01:08:13'),(14,77,NULL,3,'33333','2023-11-24 01:19:10','2023-11-24 01:19:10'),(15,78,2,1,'454566888','2023-11-24 03:11:47','2023-11-27 05:09:27'),(16,79,2,1,'3333','2023-11-24 03:13:27','2023-11-27 05:45:03'),(17,80,2,1,'55555','2023-11-24 03:13:55','2023-11-27 05:45:03'),(18,81,2,1,'234234','2023-11-27 04:56:45','2023-11-27 05:45:03'),(19,82,2,1,'4444','2023-11-27 04:58:46','2023-11-27 05:45:03'),(20,83,2,1,'23424324','2023-11-29 16:41:55','2023-11-29 16:41:55'),(21,84,2,5,'2342342','2023-11-29 17:24:20','2023-11-29 17:24:20'),(22,85,2,3,'我是第一次卜課','2023-11-29 17:29:26','2023-11-29 17:29:26'),(23,67,2,4,'234234','2023-11-29 17:34:18','2023-11-29 17:34:18'),(24,130,2,5,'555555','2023-11-29 17:34:57','2023-11-29 17:34:57'),(25,130,2,1,'11111','2023-11-29 17:35:59','2023-11-29 17:35:59'),(26,67,6,3,'234234','2023-11-29 17:43:00','2023-11-29 17:43:00'),(27,130,6,5,'5555555','2023-11-29 17:43:27','2023-11-29 17:44:00'),(28,366,6,5,'2342342','2023-11-29 22:59:17','2023-11-29 22:59:17'),(29,1,6,4,'234','2023-11-30 23:04:12','2023-11-30 23:04:12');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mentee',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_meet_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `education_background` text COLLATE utf8mb4_unicode_ci,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mentee','仲城','謝','$2y$10$RumO9887wI3RCA/NbXW4yutBoI4h4tInlbUKARwXax6qzAQugC4eW',NULL,'2023-09-24',NULL,'tor@gmail.com','0917368581',NULL,NULL,NULL,NULL,NULL,'avatars/Q18WSlOSda5g2FBcNkU5i1ELZ6UscCvXLEuBAli3.png','2023-09-26 11:53:53','2023-11-02 12:17:39','male',1,NULL,NULL,NULL,NULL,NULL),(2,'mentor','惠娟','謝','$2y$10$HFg9J452OwpGCGa6rpsf0exhapuiYgl6GyTDFYpmDoUUdDTax4Fm.',NULL,'2023-08-20',NULL,'mentor@gmail.com','0936396765','館前路8號 7樓','台北市',NULL,NULL,'Taiwan','avatars/SFZebBKieF8Azgr2w8SW4PyIXiRpx8IvEdEXfLu9.png','2023-09-26 12:13:54','2023-11-01 13:11:58','Female',1,NULL,'https://meet.google.com/sof-qfgi-btm','<p>Hello everyone! My name is Vicky, and I\'m thrilled to introduce myself as an online English teacher. I have always been passionate about the English language and the power it holds in connecting people from diverse backgrounds. I believe that learning a new language can open doors to countless opportunities, both personal and professional.</p>\r\n<p>I hold a Bachelor\'s degree in English Literature from [Your University] and a TEFL (Teaching English as a Foreign Language) certification. My educational background has equipped me with substantial knowledge of the intricacies of the English language and its diverse applications.&nbsp;</p>\r\n<p>I\'ve been teaching English online for [number of years], focusing on helping students improve their conversational skills, vocabulary, grammar, and pronunciation. I have taught students ranging from young children to adults, coming from various cultural backgrounds. This experience has enriched me, not only as a teacher but also as a global citizen. I take immense pleasure in seeing my students grow and excel in their language skills.</p>\r\n<p>My teaching philosophy revolves around the idea of student-centered learning. I use a variety of teaching methods, including interactive exercises, role-plays, and real-world scenarios to make the learning process engaging and effective. I\'m particularly fond of using multimedia resources like videos and podcasts to supplement my lessons. I believe that each student is unique, and I strive to tailor my teaching methods to suit individual needs and learning styles.</p>','台北商業大學二專部','https://www.youtube.com/watch?v=XbAihLn5UE0'),(3,'mentor','安妍','謝','$2y$10$on0Oi6faoTYywJkelnchYO/wViZKMjEj0i0r9.zzTKbq9/.psMZwC',NULL,'2023-09-03',NULL,'tor1@gmail.com','0988988988','廣豐路145號12樓','桃園市',NULL,NULL,'Taiwan','avatars/INRNTjDSUyirLD2FikBGqjg0ZsGRK0uedumayRDC.png','2023-09-27 01:09:40','2023-11-01 06:17:38','Female',1,NULL,'https://meet.google.com/xao-ezcj-hss','<p style=\"white-space-collapse: preserve; margin: 0px;\">Hello everyone! My name is [Your Name], and I\'m thrilled to introduce myself as an online English teacher. I have always been passionate about the English language and the power it holds in connecting people from diverse backgrounds. I believe that learning a new language can open doors to countless opportunities, both personal and professional.</p>\r\n<p style=\"white-space-collapse: preserve; margin: 0px;\">&nbsp;</p>\r\n<p style=\"white-space-collapse: preserve; margin: 0px;\">I hold a Bachelor\'s degree in English Literature from [Your University] and a TEFL (Teaching English as a Foreign Language) certification. My educational background has equipped me with substantial knowledge of the intricacies of the English language and its diverse applications.</p>',NULL,'https://www.youtube.com/watch?v=eoZW0Uoqt_s&t=369s'),(4,'mentee',NULL,NULL,'$2y$10$88O7jrSycHeuy23qlkurLeKpL2Ad1GpaaSIKnzYG0bxOpIP3UNU26',NULL,NULL,NULL,'mentee@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-11 03:41:34','2023-11-02 07:58:39',NULL,1,'xxjPSRTcFIt4EoKSJPcYWlRBGvtfNFWvAet0VbCrRPzkzD0qN8R43XP04r1T',NULL,NULL,NULL,NULL),(5,'mentor','奕宸','謝','$2y$10$XL67yTqlmJaR0W.YBexZueViwuJ2.tFQol5f.f0mbN0oZgLG7ZcAu',NULL,'2020-05-24',NULL,'mentor1@gmail.com','0939236289','新莊區自由街','新北市','台灣','12345','台灣','avatars/G4mcGsZUGpd2Np0GjhBuQ8gNd7z5QtPknvPA9bd6.png','2023-10-11 03:49:01','2023-11-02 07:58:34','Male',1,'M8D4GxjY3h6uRYXk7NClfORROHZifluitWdabyrFR8gOBd3l2BMECyIjFQOh',NULL,NULL,NULL,NULL),(6,'mentee','學生','謝','$2y$10$k9JKcC3mIQq4yf86ZgYowOSy7DX8bTNLq/pfdA9hCtyrac0jo/7au',NULL,'2023-10-30',NULL,'mentee1@gmail.com','23423','234234','234232','3423','23423','Taiwan','avatars/dRmGWf4ToeTxoX0vJbFphfBd2BGBD4nPra5aIxrm.png','2023-10-11 03:51:40','2023-11-07 07:25:19','male',1,NULL,NULL,NULL,NULL,NULL),(12,'admin','vicky',NULL,'$2y$10$hR2SxoekODdYX.b4c9ZJpuSKq3Y0hTKZFZURUxrKaEKLBxqXq8jyy',NULL,NULL,NULL,'vicky@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 11:40:53','2023-10-29 11:40:53',NULL,0,NULL,NULL,NULL,NULL,NULL),(13,'admin','Chung Cheng','Hsieh','$2y$10$eB2tYH.MdqadPgRNzcGWC.5nAF2IwcYzuPGsw2H1fUC8FVYuVssuS',NULL,NULL,NULL,'admin@gmail.com','0917368582342342341','廣豐路145號 12樓','Taipei',NULL,NULL,NULL,'avatars/1698718718.png','2023-10-29 12:14:37','2023-10-31 02:55:40',NULL,0,NULL,NULL,NULL,NULL,NULL),(14,'admin','kkk',NULL,'$2y$10$3pzaCRqpmQ78YHsY5MBwQuDqUiXt.SYtQlbkghk7ayDkgCQmSEOEm',NULL,NULL,NULL,'kkk@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 12:18:45','2023-10-29 12:18:45',NULL,0,NULL,NULL,NULL,NULL,NULL),(15,'admin','bbb',NULL,'$2y$10$bu3Bv1kqWLR9Y1JJmBNl5ePCEJwMwkIgVWZ83QpkDBHMJhY.Nuur2',NULL,NULL,NULL,'bbb@gamil.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 13:16:04','2023-10-29 13:16:04',NULL,0,NULL,NULL,NULL,NULL,NULL),(16,'admin','ccc',NULL,'$2y$10$/LxeeCLVvY4hDEwfjnM6lerldLeSCKKfuOBkl7wu8gahgGA3f3E0i',NULL,NULL,NULL,'ccc@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 13:18:29','2023-10-29 13:18:29',NULL,0,NULL,NULL,NULL,NULL,NULL),(17,'mentee','秝均','周','$2y$10$prJSaLmV7dZ9SFJsOyttFOPVZ9da8CcIBxnlQovZlmtH.g4fkYJj6',NULL,'1965-06-23',NULL,'tor2@gmail.com','0939236289','廣豐路145號12樓','桃園市','台灣','33405','台灣',NULL,'2023-11-17 00:24:21','2023-11-17 00:29:40','female',1,NULL,NULL,NULL,NULL,NULL),(18,'mentee',NULL,NULL,'$2y$10$bfddsTPJLj35dhd36ZJZ8ezhMS101wxpFt42Bh2dw7sjO1AhF/5ly',NULL,NULL,NULL,'mentee2@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-17 00:33:21','2023-11-17 00:33:21',NULL,0,'UPRtEnGEbxwhlmrtvsKrTBK7KIBWSurf6HJDmeSvhpOItsAktSYPgd3JDwTW',NULL,NULL,NULL,NULL),(19,'mentee',NULL,NULL,'$2y$10$VHW01ps7c3Gj2sJ6oityT.MNpjTn4Ww/5HSy/F5gywlB7onHDcnyK',NULL,NULL,NULL,'mentee3@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-17 00:38:25','2023-11-17 00:38:25',NULL,0,'NoSuVd9F1ldb2XV2O5X8A5xrywXsT7uJLmoyFo9M6Zxi578TfSvTfQOqT2PT',NULL,NULL,NULL,NULL),(20,'mentee',NULL,NULL,'$2y$10$8XdVdfMa5fwIh57AeM7FKO3byEVJz7XpJuVSBWTBVLHK0B4pUwApq',NULL,NULL,NULL,'mentee4@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-17 00:39:32','2023-11-17 00:39:32',NULL,0,'9Y4VnSj5wzsfq5y1f2NWVIOuATNOTgNc59tfHxQLOJ7T6uvuBiAjKvtNnXhq',NULL,NULL,NULL,NULL),(21,'mentee',NULL,NULL,'$2y$10$ZWCn59kzKpyf7mT8PXVxuOJKS3Prpu8Y0yXROItFCV2FHss/NCU36',NULL,NULL,NULL,'mentee5@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-17 00:41:05','2023-11-17 00:41:05',NULL,0,'GnLKABmJwBEOUf95oIHsdE94Pe6FVtlJA6KJPvsPd17M0XodIp5HlsCj4Yw1',NULL,NULL,NULL,NULL),(22,'mentor','秝均','周','$2y$10$G4fl3pft9PSKxku8Y9.L1.bQUwnn1t2jI5ER2gjn76T.NL3kIwREe',NULL,'2023-11-26',NULL,'mentor2@gmail.com','0939236289','廣豐路125號12樓','Taoyuan',NULL,NULL,'Taiwan','avatars/Sb8SE2XETPBhqto19bnKyros4q1A69SvOn4a656k.png','2023-11-17 00:42:17','2023-11-17 00:58:27','Female',1,NULL,NULL,'<p>我是周秝均</p>',NULL,NULL),(23,'mentor','Deven','Morar','$2y$10$i4aQCoT8','Ofqq9eLB','1995-08-02','O+','taufderhar@example.net','+1 (937) 482-7154',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:20:46','2023-12-04 21:20:46','female',1,NULL,NULL,NULL,NULL,NULL),(24,'mentee','Meredith','Schulist','$2y$10$JBH3xUpc','2UQDsADd','1976-10-17','A-','mohammed20@example.org','(570) 616-4638',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:20:55','2023-12-04 21:20:55','female',1,NULL,NULL,NULL,NULL,NULL),(25,'mentee','Mason','Ebert','$2y$10$0pQQjqSV','tjHl8REO','2012-09-16','AB-','ryan.karlie@example.org','1-830-399-5512',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','male',1,NULL,NULL,NULL,NULL,NULL),(26,'mentor','Lizzie','Cassin','$2y$10$1Xf7VJZn','utIRJvF4','2016-02-26','O+','zander24@example.com','+1.484.817.2254',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','male',1,NULL,NULL,NULL,NULL,NULL),(27,'mentee','Tyson','Bahringer','$2y$10$QhulfqBu','ojnsBzMQ','1971-01-26','AB+','hintz.mavis@example.net','713.253.8147',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','female',0,NULL,NULL,NULL,NULL,NULL),(28,'mentor','Tobin','Kiehn','$2y$10$Mw32NOnZ','nYno10Bj','1997-03-18','AB+','issac31@example.com','602-913-7589',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','male',1,NULL,NULL,NULL,NULL,NULL),(29,'mentee','Jayda','Stoltenberg','$2y$10$pE6icZkW','Kqdwb2Dm','2023-02-24','AB+','bradtke.ansel@example.net','(731) 608-6875',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','female',1,NULL,NULL,NULL,NULL,NULL),(30,'mentee','Demetris','Kreiger','$2y$10$SK3DEpZx','zwvq8oTt','1974-01-19','B-','roger.kunde@example.org','541.906.1687',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','male',1,NULL,NULL,NULL,NULL,NULL),(31,'mentor','Chandler','Gleason','$2y$10$lAiWx0pX','nLKk3ghO','2014-08-13','O-','katlyn.howe@example.net','479-355-1851',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','female',1,NULL,NULL,NULL,NULL,NULL),(32,'mentee','Maritza','Altenwerth','$2y$10$HcLf6Wn3','AUcKDKy8','1998-03-27','AB-','cordell27@example.org','+1 (386) 323-3932',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','male',0,NULL,NULL,NULL,NULL,NULL),(33,'mentee','Tatyana','Bogan','$2y$10$A1blHoqp','bz0Ls5E8','2000-03-11','A+','pinkie96@example.com','+1-718-275-1371',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','female',1,NULL,NULL,NULL,NULL,NULL),(34,'mentee','Stanton','Cruickshank','$2y$10$ZZMJrZsI','bOV4ON5U','1979-05-08','B-','donald.davis@example.net','1-574-999-8346',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:25:34','2023-12-04 21:25:34','female',0,NULL,NULL,NULL,NULL,NULL),(35,'mentee','Dayton','Parisian','$2y$10$fh5xGp4P','h8D6ptgm','1998-01-02','AB+','yadira.armstrong@example.net','(815) 416-0473',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','female',1,NULL,NULL,NULL,NULL,NULL),(36,'mentor','Providenci','McCullough','$2y$10$IZ3bcYhf','I6vcybb5','1982-08-05','A+','stone.hartmann@example.org','+1 (870) 932-7439',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','male',0,NULL,NULL,NULL,NULL,NULL),(37,'mentor','Sven','Bartell','$2y$10$0Q5FCKlY','tDkpftZE','1981-09-03','A-','maybelle85@example.org','1-956-710-3575',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','male',0,NULL,NULL,NULL,NULL,NULL),(38,'mentee','Jeanne','Gibson','$2y$10$qwsELBiq','TF6sAYta','1977-05-15','AB+','douglas.adrian@example.org','(207) 494-7745',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','female',0,NULL,NULL,NULL,NULL,NULL),(39,'mentor','Llewellyn','D\'Amore','$2y$10$M6nw5oA2','YdPsJIg3','1982-03-17','A+','jessika72@example.com','858-595-4367',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','female',1,NULL,NULL,NULL,NULL,NULL),(40,'mentor','Randy','Johnson','$2y$10$ZoTb9cX5','K5cZNPrL','2001-04-10','B-','elody.johns@example.org','563.552.2244',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','male',1,NULL,NULL,NULL,NULL,NULL),(41,'mentee','Molly','Boehm','$2y$10$tyox2kiN','sYNjDdRr','2022-01-30','AB+','rolfson.horacio@example.net','+1-334-748-0208',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','male',0,NULL,NULL,NULL,NULL,NULL),(42,'mentee','Leonor','Schamberger','$2y$10$6ah7x4FH','H9XhrvkP','1991-03-08','AB+','zconsidine@example.com','650.574.9922',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','female',1,NULL,NULL,NULL,NULL,NULL),(43,'mentee','Loma','Keeling','$2y$10$tiHiKBuL','rHRqyC3b','2008-08-20','AB-','demarco99@example.com','+1-986-744-0701',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','male',0,NULL,NULL,NULL,NULL,NULL),(44,'mentor','Odie','Jerde','$2y$10$OcLrdgE0','5yqAIPNc','1994-05-31','B-','aisha.wolf@example.net','+1.930.512.5451',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:02','2023-12-04 21:31:02','female',1,NULL,NULL,NULL,NULL,NULL),(45,'mentee','Valentin','Heathcote','$2y$10$QwshR3aX','xmyfHV0B','1996-03-17','A+','emard.eloisa@example.org','540-291-3193',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','female',0,NULL,NULL,NULL,NULL,NULL),(46,'mentee','Doyle','Deckow','$2y$10$P30W0YMx','yHralqx8','1979-01-06','O-','pkrajcik@example.org','+1-801-931-9053',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','male',0,NULL,NULL,NULL,NULL,NULL),(47,'mentor','Eve','Shanahan','$2y$10$iHomTVo9','itcVgbXp','2002-09-02','B-','fkuhn@example.com','+14326192609',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','male',1,NULL,NULL,NULL,NULL,NULL),(48,'mentor','Bret','Rippin','$2y$10$lAnluLxG','LWsM5RVm','1990-01-28','A-','raymundo50@example.org','240.687.7258',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','male',0,NULL,NULL,NULL,NULL,NULL),(49,'mentor','Rico','Abbott','$2y$10$1J9FpswS','6T3uNijD','1973-04-13','O+','abernathy.vena@example.net','1-774-719-6919',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','female',1,NULL,NULL,NULL,NULL,NULL),(50,'mentee','Raleigh','Bergnaum','$2y$10$x8d4JeK4','AjxRW5dk','1984-04-09','O-','nathanial.glover@example.net','1-785-502-3885',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','female',0,NULL,NULL,NULL,NULL,NULL),(51,'mentor','Julianne','Leannon','$2y$10$RwaSMHUl','IlDmIXZK','2010-05-07','AB+','constantin41@example.net','+1-425-338-2263',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','male',0,NULL,NULL,NULL,NULL,NULL),(52,'mentee','Yasmine','Mosciski','$2y$10$ILRaM23N','0blVe12G','1996-03-15','A-','jameson.hahn@example.net','640-262-5447',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','male',0,NULL,NULL,NULL,NULL,NULL),(53,'mentor','Dannie','Dickinson','$2y$10$pWAsrORV','GliJnp6W','1988-09-02','O-','albert77@example.com','+16697307459',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','female',0,NULL,NULL,NULL,NULL,NULL),(54,'mentee','Ian','Durgan','$2y$10$LlgsxOBh','4hbtRqXv','2019-05-25','B-','keebler.ila@example.net','402-430-9593',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 21:31:56','2023-12-04 21:31:56','female',1,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2023-12-07 18:50:33
