/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : vridp

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2018-11-29 17:06:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='utf8_unicode_ci';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('2', 'admin', 'E13EFC991A9BF44BBB4DA87CDBB725240184585CCAF270523170E008CF2A3B85F45F86C3DA647F69780FB9E971CAF5437B3D06D418355A68C9760C70A31D05C7', '1');

-- ----------------------------
-- Table structure for admin_notification
-- ----------------------------
DROP TABLE IF EXISTS `admin_notification`;
CREATE TABLE `admin_notification` (
  `admin_notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(10) unsigned NOT NULL,
  `subject` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `is_archived` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_notification_id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  CONSTRAINT `fk_admin_notification_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin_notification
-- ----------------------------

-- ----------------------------
-- Table structure for admin_notification_id
-- ----------------------------
DROP TABLE IF EXISTS `admin_notification_id`;
CREATE TABLE `admin_notification_id` (
  `admin_notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_id` int(10) unsigned NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `is_archived` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_notification_id`),
  KEY `fk_admin_notif` (`admin_id`),
  CONSTRAINT `fk_admin_notif` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_notification_id
-- ----------------------------

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `employee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forename` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `jmbg` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `manager_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `fk_employee` (`manager_id`),
  CONSTRAINT `fk_employee` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('8', 'Petar', 'Mirković', '1203988710044', '2');
INSERT INTO `employee` VALUES ('9', 'Marko', 'Stefanović', '1204987710045', '2');
INSERT INTO `employee` VALUES ('10', 'Stefan', 'Jovanović', '2405976152340', '6');
INSERT INTO `employee` VALUES ('11', 'Anđela', 'Milivojević', '1607989256340', '6');
INSERT INTO `employee` VALUES ('12', 'Ivana', 'Mirković', '3112991456780', '2');
INSERT INTO `employee` VALUES ('13', 'Milan', 'Mirković', '2601994645354', '6');
INSERT INTO `employee` VALUES ('14', 'Miloš', 'Ninković', '1507989346785', '6');
INSERT INTO `employee` VALUES ('15', 'Kristina', 'Jovičić', '0505968480645', '2');
INSERT INTO `employee` VALUES ('16', 'Saša', 'Mojković', '0208976465840', '6');
INSERT INTO `employee` VALUES ('17', 'Dubravka', 'Jovanović', '1506983945786', '2');
INSERT INTO `employee` VALUES ('18', 'Marko', 'Marković', '1402974685134', '2');
INSERT INTO `employee` VALUES ('19', 'Milica', 'Milovanović', '2911986514615', '2');
INSERT INTO `employee` VALUES ('20', 'Marina', 'Stefanović', '2109976648124', '6');
INSERT INTO `employee` VALUES ('21', 'Aleksandra', 'Stanković', '1805998648145', '6');
INSERT INTO `employee` VALUES ('22', 'Jovana', 'Stanojević', '2307990978648', '6');
INSERT INTO `employee` VALUES ('23', 'Tamara', 'Krstić', '0604996461452', '2');
INSERT INTO `employee` VALUES ('24', 'Marijana', 'Bošković', '0210978456941', '2');
INSERT INTO `employee` VALUES ('25', 'David', 'Aleksić', '1204999486914', '2');
INSERT INTO `employee` VALUES ('26', 'Đorđe', 'Ivanović', '1601981643321', '6');
INSERT INTO `employee` VALUES ('27', 'Danilo', 'Jovančević', '1108986754631', '2');
INSERT INTO `employee` VALUES ('28', 'Vuk', 'Dragić', '2810969154678', '6');

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `manager_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `forename` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `admin_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`manager_id`),
  KEY `fk_mng` (`admin_id`),
  CONSTRAINT `fk_mng` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='utf8_unicode_ci';

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('2', 'test1@vridp.com', 'E13EFC991A9BF44BBB4DA87CDBB725240184585CCAF270523170E008CF2A3B85F45F86C3DA647F69780FB9E971CAF5437B3D06D418355A68C9760C70A31D05C7', 'Ivana', 'Milošević', '1', '2');
INSERT INTO `manager` VALUES ('6', 'test2@vridp.com', '6D201BEEEFB589B08EF0672DAC82353D0CBD9AD99E1642C83A1601F3D647BCCA003257B5E8F31BDC1D73FBEC84FB085C79D6E2677B7FF927E823A54E789140D9', 'Miloš', 'Vidaković', '1', '2');
INSERT INTO `manager` VALUES ('7', 'test3@vridp.com', 'CB872DE2B8D2509C54344435CE9CB43B4FAA27F97D486FF4DE35AF03E4919FB4EC53267CAF8DEF06EF177D69FE0ABAB3C12FBDC2F267D895FD07C36A62BFF4BF', 'Vuk', 'Vuković', '1', '2');

-- ----------------------------
-- Table structure for manager_notification
-- ----------------------------
DROP TABLE IF EXISTS `manager_notification`;
CREATE TABLE `manager_notification` (
  `manager_notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `manager_id` int(10) unsigned NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `is_archived` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tag` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`manager_notification_id`),
  KEY `fk_mng_notif` (`manager_id`),
  CONSTRAINT `fk_mng_notif` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manager_notification
-- ----------------------------
INSERT INTO `manager_notification` VALUES ('1', '2018-11-29 16:52:48', '6', 'Neko obavestenje', 'Obavestenje 1', '0', 'marketing');

-- ----------------------------
-- Table structure for month
-- ----------------------------
DROP TABLE IF EXISTS `month`;
CREATE TABLE `month` (
  `month_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(10) unsigned NOT NULL,
  `month` enum('Januar','Februar','Mart','April','Maj','Jun','Jul','Avgust','Septembar','Oktobar','Novembar','Decembar') NOT NULL,
  PRIMARY KEY (`month_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of month
-- ----------------------------

-- ----------------------------
-- Table structure for work_log
-- ----------------------------
DROP TABLE IF EXISTS `work_log`;
CREATE TABLE `work_log` (
  `work_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `manager_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `month` enum('01','02','03','04','05','06','07','08','09','10','11','12') COLLATE utf8_unicode_ci NOT NULL,
  `year` int(4) unsigned NOT NULL,
  `hours_worked` int(10) unsigned NOT NULL,
  `hours_price` decimal(10,2) unsigned NOT NULL,
  `hours_absent_paid` int(10) unsigned NOT NULL,
  `hours_absent_price` decimal(10,2) unsigned NOT NULL,
  `hours_absent_unpaid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`work_log_id`),
  KEY `fk_work_log_1` (`manager_id`),
  KEY `fk_work_log_2` (`employee_id`),
  CONSTRAINT `fk_work_log_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_work_log_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of work_log
-- ----------------------------
INSERT INTO `work_log` VALUES ('8', '2018-11-27 17:48:09', '2', '9', '11', '2018', '170', '500.00', '3', '200.00', '0');
INSERT INTO `work_log` VALUES ('9', '2018-11-29 13:01:51', '6', '11', '11', '2018', '120', '220.00', '21', '160.00', '0');
INSERT INTO `work_log` VALUES ('10', '2018-11-29 13:03:24', '6', '27', '11', '2018', '124', '235.00', '0', '0.00', '12');
INSERT INTO `work_log` VALUES ('11', '2018-11-29 16:57:23', '6', '17', '11', '2018', '120', '250.00', '24', '120.00', '0');
INSERT INTO `work_log` VALUES ('12', '2018-11-29 17:01:24', '6', '12', '11', '2018', '123', '200.00', '20', '150.00', '12');
SET FOREIGN_KEY_CHECKS=1;
