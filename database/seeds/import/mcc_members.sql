# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42-log)
# Database: blog
# Generation Time: 2015-10-15 19:22:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table mcc_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mcc_members`;

CREATE TABLE `mcc_members` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `uscf_id` varchar(20) DEFAULT NULL,
  `uscf_rating` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mcc_members` WRITE;
/*!40000 ALTER TABLE `mcc_members` DISABLE KEYS */;

INSERT INTO `mcc_members` (`id`, `username`, `password`, `name`, `zip`, `uscf_id`, `uscf_rating`, `created_at`, `updated_at`)
VALUES
	(48,'gpylant','pawnt0b4','Pylant, Gary','38134','10245451',1852,'2015-10-15 11:13:06','2015-10-15 16:13:06'),
	(2,'kenn','ec2385','Thompson, Kenn E.','72396','11184413',1703,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(57,'jwade','colts18','Wade, Jonathan','38139','12662511',1891,'2015-10-15 11:15:04','2015-10-15 16:15:04'),
	(58,'dkmago','emseesee','Magouyrk, Keith','38018','14421374',1281,'2015-10-15 11:22:47','2015-10-15 16:22:47'),
	(59,'cknowles','cknowles','Knowles, Chase','38108','13441952',1938,'2015-10-15 11:21:08','2015-10-15 16:21:08'),
	(60,'oranquintrell','shazam','Quintrell, Oran','38117','12652743',1038,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(50,'twf','store72','Freeman, Tyler','38654','14460540',1570,'2015-10-15 11:23:03','2015-10-15 16:23:03'),
	(49,'mcc','J0nesb0r0','Weaver, Dwight','38671','10246857',1653,'2015-10-15 11:14:25','2015-10-15 16:14:25'),
	(52,'edmemphis','frommose','Davison, Edgar','38101','12659000',1829,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(54,'whosyodaddy','jesuss','Coleman, Patrick','38101','13482266:',1701,'2015-10-15 11:21:57','2015-10-15 16:21:57'),
	(56,'allan','giants','Bogle, Allan','38101','12641161',1854,'2015-10-15 11:21:45','2015-10-15 16:21:45'),
	(53,'ghorobetz','memphis','Horobetz, Graham','38139','12800231',2272,'2015-10-15 11:12:07','2015-10-15 16:12:07'),
	(61,'thgibbs','whiteknight','Gibbs, Tanton','98052','12681750',1769,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(63,'greatermemphischess','mrb112572','Beatty, Mark','38134','12773460',1494,'2015-10-15 11:22:17','2015-10-15 16:22:17'),
	(62,'gadmiralthrawn','chessstuff','Beatty, Jonathan','38134','12748652',1953,'2015-10-15 11:21:30','2015-10-15 16:21:30'),
	(51,'kingofmemphis','just4me','Sims, Carlos','38105','20005559',2004,'2015-10-15 11:21:11','2015-10-15 16:21:11'),
	(67,'jeffk','jeffk','Kovalic, Jeff','38305','12467445',1909,'2015-10-15 11:21:21','2015-10-15 16:21:20'),
	(68,'ben','levine','Levine, Benjamin','38120','13544181',1817,'2015-10-15 11:21:48','2015-10-15 16:21:48'),
	(69,'tmaneclang','dingo1972','Maneclang, Tony ','','12486714',1698,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(70,'sourav','12345','Bhattacharjee, Sourav','','14466451',1968,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(71,'srobar','qqntboz17','O`bar, Sam','','12694772',1822,'2015-10-15 11:13:25','2015-10-15 16:13:25'),
	(72,'jeuxdeau','HHPXMXAJ','Cathey, Jason','','13307523',1228,'2015-10-15 11:22:44','2015-10-15 16:22:44'),
	(73,'olechesster','Thetalone','Bulington, Carter','','12798365',1942,'2015-10-15 11:21:33','2015-10-15 16:21:33'),
	(74,'guythompson','0mn1v13w','Thompson, Guy','','12353910',1714,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(77,'msalzge','12345','Salzgeber, Michael','','13721183',1613,'2015-10-15 11:22:14','2015-10-15 16:22:14'),
	(78,'jayford','mcc2011','Ford, Jay','','12627061',1530,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(76,'omar','omar1234','Jamil, Omar','','14419718',975,'2015-10-15 11:23:06','2015-10-15 16:23:06'),
	(80,'olmssrbl5','chess','Hilliard, Christopher','','12765352',1615,'2015-10-15 11:22:12','2015-10-15 16:22:12'),
	(81,'jamesculhane','memphischess','Culhane, James','','14610322',1283,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(84,'hamthekiller','ponyate','Ellis, Hamilton ','','14280161',1429,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(75,'shaxmatist','jjiangi','Mcdade, Chris','','10473365',1991,'2015-10-15 07:59:24','2015-10-15 12:59:24'),
	(85,'zdrakec','zachary','Turnbow, Chris','','12262700',1881,'2015-10-15 11:21:26','2015-10-15 16:21:26'),
	(88,'maclinp','37mvoide','Maclin, Philip','','10245931',1419,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(90,'cdurham1','pepsi3713','Durham, Charlie','','20019228',1935,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(91,'iluv2play','bob','Crockett, Michael ','','12492681',1332,'2015-10-15 11:22:38','2015-10-15 16:22:38'),
	(92,'simplemiddle','climbgym','Dolz, Chrys','','12906003',224,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(108,'rcbarnes','chess23857','Barnes, Ronnie C.','','10246369',1624,'2015-10-15 11:17:16','2015-10-15 16:17:16'),
	(109,'purfessor','Weaver','Sansom, John','','12585872',1200,'2015-10-15 11:22:23','2015-10-15 16:22:23'),
	(86,'deepakbhat','Dipak7983','Bhat, Deepak','','14882410',1182,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(110,'lford','sanduckstr','Ford, Leonard','','',3,'2015-10-15 11:22:49','2015-10-15 16:22:49'),
	(111,'kartybomb','ktk2005','Bomb, Kartikeya','','15228064',946,'2015-10-15 11:23:09','2015-10-15 16:23:09'),
	(87,'lhm1948','hashem01','Martin, Lance','','12533064',1223,'2015-10-14 19:08:06','0000-00-00 00:00:00'),
	(112,'kdasari2002','10qpalzm','Dasari, Krishna','','13746836',1442,'2015-10-15 11:22:26','2015-10-15 16:22:26'),
	(114,'soaranson','flapy-hipo','Dolz, Stephan','','12806412',998,'2015-10-15 11:22:36','2015-10-15 16:22:36'),
	(113,'rvargas','guntown','Vargas, Robert','38849','14566422',944,'2015-10-15 11:23:01','2015-10-15 16:23:01');

/*!40000 ALTER TABLE `mcc_members` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
