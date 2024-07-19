/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.11-MariaDB : Database - skillwork
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`skillwork` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `skillwork`;

/*Table structure for table `booking_request` */

DROP TABLE IF EXISTS `booking_request`;

CREATE TABLE `booking_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `need_for` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `booking_request` */

insert  into `booking_request`(`request_id`,`worker_id`,`user_id`,`username`,`contact_number`,`address`,`need_for`,`status`,`worker_name`,`worker_contact`,`worker_address`,`skills`) values (12,7,3,'dummy','384764382','dumy address','text dummy','rejected','rahman khan','876543456','mingora swat','machine '),(13,7,5,'user boy','45634245','namalom','machince kharab de','approved','rahman khan','876543456','mingora swat','machine ');

/*Table structure for table `skilledworkers` */

DROP TABLE IF EXISTS `skilledworkers`;

CREATE TABLE `skilledworkers` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` decimal(10,0) DEFAULT NULL,
  `skills` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certification` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_history` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('worker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('approved','rejected') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `skilledworkers` */

insert  into `skilledworkers`(`worker_id`,`username`,`email`,`address`,`contact`,`skills`,`certification`,`work_history`,`role`,`password`,`pro_image`,`status`) values (3,'skill boy','skillwork1@gmail.com','maira','9865456798','computer repairing','machine','working in techno company since 2020','worker','123','istockphoto-1309328823-1024x1024.jpg','approved'),(6,'skiller man','saidrahman@gmail.com','maira','9876545634','mobile repair','Technical ','nothing','worker','1212','istockphoto-1309328823-1024x1024.jpg','approved'),(7,'rahman khan','zamasite2@gmail.com','mingora swat','876543456','machine ','technician','big technical worker','worker','123','pexels-photo-1148998.jpeg','approved');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` decimal(10,0) DEFAULT NULL,
  `profile_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('user','admin','worker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`email`,`address`,`contact`,`profile_image`,`role`,`password`) values (3,'skill worker','skillwork1@gmail.com','pekhawar','9999999999','istockphoto-1309328823-1024x1024.jpg','user','1122'),(4,'Admin Khan','admin1@gmail.com','swat','393','pexels-photo-1043471.jpeg','admin','321'),(5,'user boy','user1@gmail.com','namalom','7564535675','pexels-photo-1043471.jpeg','user','1212');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
