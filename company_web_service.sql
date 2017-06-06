CREATE DATABASE  IF NOT EXISTS `company_web_service`;
USE `company_web_service`;

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
);

DROP TABLE IF EXISTS `company_meeting`;
CREATE TABLE `company_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
);


DROP TABLE IF EXISTS `company_spreadsheet`;
CREATE TABLE `company_spreadsheet` (
  `company_id` int(11) NOT NULL,
  `spreadsheet_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_id_UNIQUE` (`company_id`)
);
