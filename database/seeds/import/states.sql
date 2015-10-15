# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42-log)
# Database: blog
# Generation Time: 2015-10-11 13:07:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table states
# ------------------------------------------------------------

DROP TABLE IF EXISTS `states`;

CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_abr` varchar(2) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;

INSERT INTO `states` (`id`, `state_abr`, `state`, `created_at`, `updated_at`)
VALUES
	(1,'al','Alabama','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'ak','Alaska','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'az','Arizona','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'ar','Arkansas','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'ca','California','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,'co','Colorado','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,'ct','Connecticut','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,'de','Delaware','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,'dc','District of Columbia','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,'fl','Florida','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11,'ga','Georgia','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(12,'hi','Hawaii','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(13,'id','Idaho','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14,'il','Illinois','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(15,'in','Indiana','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(16,'ia','Iowa','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(17,'ks','Kansas','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(18,'ky','Kentucky','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(19,'la','Louisiana','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(20,'me','Maine','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(21,'md','Maryland','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22,'ma','Massachusetts','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(23,'mi','Michigan','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(24,'mn','Minnesota','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(25,'ms','Mississippi','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(26,'mo','Missouri','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(27,'mt','Montana','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(28,'ne','Nebraska','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(29,'nv','Nevada','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(30,'nh','New Hampshire','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(31,'nj','New Jersey','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(32,'nm','New Mexico','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(33,'ny','New York','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(34,'nc','North Carolina','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(35,'nd','North Dakota','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(36,'oh','Ohio','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(37,'ok','Oklahoma','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(38,'or','Oregon','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(39,'pa','Pennsylvania','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(40,'ri','Rhode Island','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(41,'sc','South Carolina','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(42,'sd','South Dakota','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(43,'tn','Tennessee','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(44,'tx','Texas','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(45,'ut','Utah','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(46,'vt','Vermont','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(47,'va','Virginia','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(48,'wa','Washington','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(49,'wv','West Virginia','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(50,'wi','Wisconsin','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(51,'wy','Wyoming','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
