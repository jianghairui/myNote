/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.24-0ubuntu0.16.04.1 : Database - chat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chat` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `chat`;

/*Table structure for table `dunling_chat` */

DROP TABLE IF EXISTS `dunling_chat`;

CREATE TABLE `dunling_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nicheng` varchar(55) COLLATE utf8_bin DEFAULT NULL,
  `content` varchar(55) COLLATE utf8_bin DEFAULT NULL,
  `time` varchar(55) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `dunling_chat` */

insert  into `dunling_chat`(`id`,`nicheng`,`content`,`time`) values (1,'Jiang','23124','1557286519'),(2,'Jiang','有点意思啊','1557286528'),(3,'Jiang','你好呀','1557286536'),(4,'荣建','大家好 我是甘荣建','1557286557'),(5,'李德','我是李德,啦啦啦啦','1557286597'),(6,'荣建','李德你个沙雕','1557286610'),(7,'荣建','嫁汉嫁汉\n','1557286673'),(8,'李德','','1557286698');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
