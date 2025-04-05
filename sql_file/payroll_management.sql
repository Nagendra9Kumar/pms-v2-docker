-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: payroll_management
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.2

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
-- Table structure for table `Salary`
--

DROP TABLE IF EXISTS `Salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Salary` (
  `empid` varchar(100) DEFAULT NULL,
  `payment_id` double NOT NULL AUTO_INCREMENT,
  `month` varchar(10) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  UNIQUE KEY `payment_id` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1804723025 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salary`
--

LOCK TABLES `Salary` WRITE;
/*!40000 ALTER TABLE `Salary` DISABLE KEYS */;
INSERT INTO `Salary` VALUES ('880980020',1804723001,'September','2022','Interns'),('880980021',1804723002,'September','2022','Team Leaders'),('880980022',1804723003,'September','2022','Top Level Management'),('880980026',1804723004,'September','2022','Sr Employees'),('880980063',1804723005,'September','2022','Jr Employees'),('880980020',1804723006,'October','2022','Interns'),('880980021',1804723007,'October','2022','Team Leaders'),('880980022',1804723008,'October','2022','Top Level Management'),('880980026',1804723009,'October','2022','Sr Employees'),('880980063',1804723010,'October','2022','Jr Employees'),('23225a6102',1804723012,'September','2024','Jr Employees'),('22H41A4539',1804723013,'September','2024','Sr Employees'),('23225a4504',1804723014,'September','2024','Top Level Management'),('24A4229',1804723015,'September','2024','Top Level Management'),('22221A4533',1804723016,'September','2024','Vip'),('998',1804723017,'September','2024','Team Leaders'),('111',1804723018,'September','2024','Top Level Management'),('1269-Collector',1804723019,'September','2024','Top Level Management'),('22221a4553',1804723020,'September','2024','Interns'),('23h45a0509',1804723021,'September','2024','Top Level Management'),('23h45a4507',1804723022,'September','2024','Prabs'),('22221a0348',1804723023,'September','2024','Top Level Management'),('22221a4511',1804723024,'October','2024','Prabs');
/*!40000 ALTER TABLE `Salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salary_Class`
--

DROP TABLE IF EXISTS `Salary_Class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Salary_Class` (
  `Class` varchar(20) DEFAULT NULL,
  `BS` double DEFAULT NULL,
  `HRA` double DEFAULT NULL,
  `TA` double DEFAULT NULL,
  `MA` double DEFAULT NULL,
  `TDS` double DEFAULT NULL,
  `PT` double DEFAULT NULL,
  `PF` double DEFAULT NULL,
  `GS` double DEFAULT NULL,
  `NS` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salary_Class`
--

LOCK TABLES `Salary_Class` WRITE;
/*!40000 ALTER TABLE `Salary_Class` DISABLE KEYS */;
INSERT INTO `Salary_Class` VALUES ('Interns',15000,2000,1000,500,1000,500,500,18500,16500),('Jr Employees',30000,5000,3000,2000,3500,1500,2000,40000,33000),('Sr Employees',50000,7000,5000,3000,6500,3000,3500,65000,52000),('Team Leaders',70000,7000,5000,3000,8500,5000,4500,85000,67000),('Top Level Management',100000,8000,6000,4000,15000,7000,5000,118000,91000),('Vip',1000000,0,0,0,0,0,0,1000000,1000000);
/*!40000 ALTER TABLE `Salary_Class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rdata`
--

DROP TABLE IF EXISTS `rdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rdata` (
  `first_name` text,
  `last_name` text,
  `empid` varchar(255) NOT NULL,
  `email` text,
  `gender` text,
  `address` text,
  `department` text,
  `password` text,
  `Images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rdata`
--

LOCK TABLES `rdata` WRITE;
/*!40000 ALTER TABLE `rdata` DISABLE KEYS */;
INSERT INTO `rdata` VALUES ('Yenamadala','Surya','22221a0348','suryasai2348@gmail.com','MALE','Kesnakurru','HUMAN RESOURCE','023b7109f2de41cfd0b8ecb75d0cbc0b',NULL),('Saipower','Rolls','22221a4000','figixo5617@craftapk.com','MALE','Losvages ','DESIGN','9d3103a2c30a5905e8a70a3f8ff9abac',NULL),('Ram','Tej','22221a4511','tejbonthu45@gmail.com','MALE','Magatapalli','CODING','1432852e2fff2f562cee66589436954a',NULL),('Kadali','Harshitha Ramya','22221A4524','ramyakadali107@gmail.com','FEMALE','Vilasa','CODING','0a1592dcd29ef093d9b287b8b21bcab7',NULL),('Koppisetti',' Chandanika Lalitha','22221A4533','kchandanikalalitha@gmail.com','FEMALE','Mummidivaram','CODING','ae5bbac051bebffba4a73a115aabb900',NULL),('Praveen','Singireddy','22221a4553','praveen123@gmail.com','MALE','Kothapeta','CODING','8221b6f4bd02d66767e77f6fee759a9c','uploads/1000010002.jpg'),('Mansa','Pendem','22H41A4539','manasapendem005@gmail.com','FEMALE','Mmd','TESTING','4486ab93d9674df276fc7592f47e2da8',NULL),('Nagendra Kumar','Gubbala','23225a4502','23225a4502@bvcgroup.in','MALE','mummidivaram','CODING','c53b389331e16f0444eaa753f01aacd9','uploads/_gnk_9-20240916-0001.jpg'),('rajeswari','penumalle','23225a4504','raji123@gmail.com','FEMALE','amp','CODING','f354b384c0d334606e004c5880b99d7e','uploads/1000001985.jpg'),('Chaitanya','Veera','23225a4507','veerachaitanya5299@gmail.com','MALE','k.v palem  venkataswaraswami temple ambajipeta','TESTING','4de45adc0c90a6a80f2a6bfe64c84fe7',NULL),('satish','Bokka','23225A6102 ','satishbokka2002@gmail.com','MALE','Samanasa','TESTING','ec2572469eb256f8adf456582b04a2fe',NULL),('Dunaboyina','swamy','23h45a0509','swamydunaboyina456@gmail.com','MALE','Kesanakurru palem','CODING','b910449e6c0015f0a5ee262d01c4aab9',NULL),('Prabhas','v','23h45a4507','prabhasvegi9392@gmail.com','MALE','Earth','DESIGN','1b583adc1177df1d57365971fed09e39','uploads/1000002936.jpg'),('Admin',NULL,'admin',NULL,NULL,NULL,NULL,'0192023a7bbd73250516f069df18b500',NULL);
/*!40000 ALTER TABLE `rdata` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-04  8:42:31
