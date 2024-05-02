-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.52 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for logbin
CREATE DATABASE IF NOT EXISTS `logbin` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `logbin`;

-- Dumping structure for table logbin.log
CREATE TABLE IF NOT EXISTS `log` (
  `user_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `log_date` date NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table logbin.log: ~3 rows (approximately)
INSERT INTO `log` (`user_id`, `log_id`, `title`, `log_date`, `log`) VALUES
	(1, 15, 'Tes Saja', '2024-03-30', 'AA'),
	(2, 17, 'UAS 100', '2024-05-01', 'Amin'),
	(1, 18, 'UAS 100', '2024-05-02', 'semoga bisa, amin');

-- Dumping structure for table logbin.login
CREATE TABLE IF NOT EXISTS `login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table logbin.login: ~3 rows (approximately)
INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
	(1, 'admin', '123'),
	(2, 'guest', '123'),
	(3, 'halo', '123');

-- Dumping structure for table logbin.mood
CREATE TABLE IF NOT EXISTS `mood` (
  `id_mood` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mood` int(1) NOT NULL,
  `mood_date` date NOT NULL,
  PRIMARY KEY (`id_mood`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `mood_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table logbin.mood: ~4 rows (approximately)
INSERT INTO `mood` (`id_mood`, `user_id`, `mood`, `mood_date`) VALUES
	(1, 1, 1, '2023-02-02'),
	(2, 1, 5, '2024-09-03'),
	(3, 1, 3, '2024-05-02'),
	(4, 1, 3, '2024-05-03');

-- Dumping structure for table logbin.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table logbin.user: ~3 rows (approximately)
INSERT INTO `user` (`user_id`, `name`, `birth_date`) VALUES
	(1, 'Stephanie', '2012-02-08'),
	(2, 'Stephanie', '2024-02-29'),
	(3, 'Stephanie', '2024-02-26');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
