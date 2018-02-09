# docolme-emberjs
playing with ember + slimframework

# Requirements
* PHP 7.x

## DB Schema
CREATE DATABASE `docs` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
CREATE TABLE `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contentText` text COLLATE utf8_bin,
  `created` timestamp NULL DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

## Instruction
** Execute the SQL script above
** Navigate to directoy where you have clone this repo. e.g.  c:\docolme-emberjs\
** Issue this command to run the php server => php -S localhost:8080 -t public public/index.php
** Open browser - http://localhost:8080/docs/index.html# 
