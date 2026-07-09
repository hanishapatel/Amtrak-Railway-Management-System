-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: railway
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `role` varchar(60) DEFAULT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'Charlie Reeves','charlie@amtrak.example','10 Rail Ave, New York, NY','212-555-0101','Operations Manager','charlie','charlie123'),(2,'Grace Holloway','grace@amtrak.example','22 Union St, Washington, DC','202-555-0144','Station Manager','grace','grace123'),(3,'Daniel Ortiz','daniel@amtrak.example','5 Depot Rd, Boston, MA','617-555-0177','Ticket Clerk','daniel','daniel123'),(4,'Priya Nair','priya@amtrak.example','18 Market St, Philadelphia, PA','215-555-0190','Scheduling Coordinator','priya','priya123'),(5,'Marcus Lee','marcus@amtrak.example','9 Charles St, Baltimore, MD','410-555-0165','Maintenance Supervisor','marcus','marcus123');
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Passenger`
--

DROP TABLE IF EXISTS `Passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Passenger` (
  `passenger_id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger_name` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  PRIMARY KEY (`passenger_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Passenger`
--

LOCK TABLES `Passenger` WRITE;
/*!40000 ALTER TABLE `Passenger` DISABLE KEYS */;
INSERT INTO `Passenger` VALUES (1,'John Carter','john@example.com','89 Elm St, New York, NY','917-555-0110','john','john123'),(2,'Maria Alvarez','maria@example.com','14 Oak Ave, Boston, MA','857-555-0132','maria','maria123'),(3,'David Kim','david@example.com','203 Pine St, Washington, DC','202-555-0121','david','david123'),(4,'Sophie Turner','sophie@example.com','47 Maple Dr, Philadelphia, PA','267-555-0143','sophie','sophie123'),(5,'Liam Nguyen','liam@example.com','12 Cedar Ln, Providence, RI','401-555-0154','liam','liam123'),(6,'Emma Brooks','emma@example.com','66 Birch Rd, Baltimore, MD','443-555-0165','emma','emma123'),(7,'Noah Patel','noah@example.com','31 Spruce St, New York, NY','646-555-0176','noah','noah123'),(8,'Olivia Rossi','olivia@example.com','5 Walnut Ave, Boston, MA','617-555-0187','olivia','olivia123'),(9,'Ethan Clark','ethan@example.com','77 Chestnut St, Washington, DC','202-555-0198','ethan','ethan123'),(10,'Ava Morales','ava@example.com','9 Willow Way, Philadelphia, PA','215-555-0209','ava','ava123');
/*!40000 ALTER TABLE `Passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `passenger_id` int(11) DEFAULT NULL,
  `seat_number` varchar(20) DEFAULT NULL,
  `special_requests` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_res_ticket` (`ticket_id`),
  KEY `fk_res_passenger` (`passenger_id`),
  CONSTRAINT `fk_res_passenger` FOREIGN KEY (`passenger_id`) REFERENCES `Passenger` (`passenger_id`),
  CONSTRAINT `fk_res_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `Ticket` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservation`
--

LOCK TABLES `Reservation` WRITE;
/*!40000 ALTER TABLE `Reservation` DISABLE KEYS */;
INSERT INTO `Reservation` VALUES (1,1,1,'A(30)','none'),(2,2,1,'A(50)','vegetarian'),(3,3,1,'A(10)','extra-legroom'),(4,4,2,'A(0)','vegetarian'),(5,5,2,'A(60)','none'),(6,6,3,'A(31)','none'),(7,7,4,'A(51)','none'),(8,8,4,'A(40)','non-vegetarian'),(9,9,5,'A(41)','extra-legroom'),(10,10,6,'A(0)','none'),(11,11,6,'A(32)','vegetarian'),(12,12,6,'A(1)','none'),(13,13,7,'A(11)','extra-legroom'),(14,14,7,'A(33)','none'),(15,15,8,'A(61)','non-vegetarian'),(16,16,9,'A(34)','none');
/*!40000 ALTER TABLE `Reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Route`
--

DROP TABLE IF EXISTS `Route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` varchar(120) NOT NULL,
  `origin_station` varchar(120) NOT NULL,
  `destination_station` varchar(120) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Route`
--

LOCK TABLES `Route` WRITE;
/*!40000 ALTER TABLE `Route` DISABLE KEYS */;
INSERT INTO `Route` VALUES (1,'Acela Northeast','New York Penn Station','Washington Union Station'),(2,'Northeast Regional South','Boston South Station','Washington Union Station'),(3,'Keystone Service','New York Penn Station','Philadelphia 30th Street'),(4,'Empire Corridor','New York Penn Station','Boston South Station'),(5,'Palmetto Line','Baltimore Penn Station','Washington Union Station'),(6,'Shore Line','Providence Station','New York Penn Station');
/*!40000 ALTER TABLE `Route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Schedule`
--

DROP TABLE IF EXISTS `Schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `train_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `day_of_week` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `fk_sched_train` (`train_id`),
  KEY `fk_sched_route` (`route_id`),
  CONSTRAINT `fk_sched_route` FOREIGN KEY (`route_id`) REFERENCES `Route` (`route_id`),
  CONSTRAINT `fk_sched_train` FOREIGN KEY (`train_id`) REFERENCES `Train` (`train_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Schedule`
--

LOCK TABLES `Schedule` WRITE;
/*!40000 ALTER TABLE `Schedule` DISABLE KEYS */;
INSERT INTO `Schedule` VALUES (1,1,1,'06:00:00','09:35:00','Monday'),(2,2,2,'08:20:00','13:05:00','Monday'),(3,3,3,'07:15:00','08:45:00','Tuesday'),(4,4,1,'14:15:00','18:40:00','Wednesday'),(5,5,4,'09:00:00','13:20:00','Friday'),(6,6,5,'10:30:00','11:15:00','Tuesday'),(7,7,6,'16:45:00','20:05:00','Thursday'),(8,8,4,'12:00:00','16:10:00','Saturday');
/*!40000 ALTER TABLE `Schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Station`
--

DROP TABLE IF EXISTS `Station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Station` (
  `station_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_name` varchar(120) NOT NULL,
  `city` varchar(80) DEFAULT NULL,
  `state` varchar(40) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Station`
--

LOCK TABLES `Station` WRITE;
/*!40000 ALTER TABLE `Station` DISABLE KEYS */;
INSERT INTO `Station` VALUES (1,'New York Penn Station','New York','NY','351 W 31st St'),(2,'Washington Union Station','Washington','DC','50 Massachusetts Ave NE'),(3,'Boston South Station','Boston','MA','700 Atlantic Ave'),(4,'Philadelphia 30th Street','Philadelphia','PA','2955 Market St'),(5,'Baltimore Penn Station','Baltimore','MD','1500 N Charles St'),(6,'Providence Station','Providence','RI','100 Gaspee St');
/*!40000 ALTER TABLE `Station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ticket`
--

DROP TABLE IF EXISTS `Ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger_id` int(11) DEFAULT NULL,
  `train_id` int(11) DEFAULT NULL,
  `departure_station` varchar(120) DEFAULT NULL,
  `arrival_station` varchar(120) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `ticket_type` varchar(30) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_ticket_passenger` (`passenger_id`),
  KEY `fk_ticket_train` (`train_id`),
  CONSTRAINT `fk_ticket_passenger` FOREIGN KEY (`passenger_id`) REFERENCES `Passenger` (`passenger_id`),
  CONSTRAINT `fk_ticket_train` FOREIGN KEY (`train_id`) REFERENCES `Train` (`train_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ticket`
--

LOCK TABLES `Ticket` WRITE;
/*!40000 ALTER TABLE `Ticket` DISABLE KEYS */;
INSERT INTO `Ticket` VALUES (1,1,1,'New York Penn Station','Washington Union Station','2026-07-13','2026-07-13','business',40.00),(2,1,3,'New York Penn Station','Philadelphia 30th Street','2026-07-14','2026-07-14','economy',30.00),(3,1,5,'New York Penn Station','Boston South Station','2026-07-17','2026-07-17','first',50.00),(4,2,2,'Boston South Station','Washington Union Station','2026-07-20','2026-07-20','first',50.00),(5,2,8,'New York Penn Station','Boston South Station','2026-07-18','2026-07-18','standard',25.00),(6,3,1,'New York Penn Station','Washington Union Station','2026-07-27','2026-07-27','economy',30.00),(7,4,3,'New York Penn Station','Philadelphia 30th Street','2026-07-21','2026-07-21','standard',25.00),(8,4,7,'Providence Station','New York Penn Station','2026-07-16','2026-07-16','business',40.00),(9,5,7,'Providence Station','New York Penn Station','2026-07-09','2026-07-09','economy',30.00),(10,6,6,'Baltimore Penn Station','Washington Union Station','2026-07-07','2026-07-07','business',40.00),(11,6,4,'New York Penn Station','Washington Union Station','2026-07-15','2026-07-15','first',50.00),(12,6,2,'Boston South Station','Washington Union Station','2026-07-13','2026-07-13','standard',25.00),(13,7,5,'New York Penn Station','Boston South Station','2026-07-10','2026-07-10','business',40.00),(14,7,1,'New York Penn Station','Washington Union Station','2026-07-20','2026-07-20','standard',25.00),(15,8,8,'New York Penn Station','Boston South Station','2026-07-11','2026-07-11','first',50.00),(16,9,4,'New York Penn Station','Washington Union Station','2026-07-22','2026-07-22','economy',30.00);
/*!40000 ALTER TABLE `Ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Train`
--

DROP TABLE IF EXISTS `Train`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Train` (
  `train_id` int(11) NOT NULL AUTO_INCREMENT,
  `train_name` varchar(120) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`train_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Train`
--

LOCK TABLES `Train` WRITE;
/*!40000 ALTER TABLE `Train` DISABLE KEYS */;
INSERT INTO `Train` VALUES (1,'Acela Express 2151',220,'Active'),(2,'Northeast Regional 171',250,'Active'),(3,'Keystone 645',200,'Active'),(4,'Palmetto 89',180,'Active'),(5,'Empire Service 234',240,'Active'),(6,'Silver Star 91',250,'Active'),(7,'Shore Line 490',210,'Active'),(8,'Vermonter 55',190,'Active');
/*!40000 ALTER TABLE `Train` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-09 19:47:00
