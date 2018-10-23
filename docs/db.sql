DROP TABLE IF EXISTS `biz_categories`;
CREATE TABLE `biz_categories` (
  `business_id` int(11) NOT NULL,
  `category_id` char(10) NOT NULL,
  PRIMARY KEY (`business_id`,`category_id`)
);

DROP TABLE IF EXISTS `businesses`;
CREATE TABLE `businesses` (
  `business_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(128) NOT NULL,
  `telephone` varchar(64) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`business_id`)
);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` varchar(10) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` char(32) DEFAULT NULL,
  PRIMARY KEY (`username`)
);
