# docolme-emberjs
playing with ember1.10 + slimframework 3

# Requirements
* PHP 7.x
* MySQL 5.x

## DB Schema
```
CREATE DATABASE `docs` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `docs`;
CREATE TABLE `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contentText` text COLLATE utf8_bin,
  `created` timestamp NULL DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
CREATE TABLE `doc_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) DEFAULT NULL,
  `fileName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contentText` text COLLATE utf8_bin,
  `userId` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```
## Instruction
1. Open your MySQL client and execute the SQL script above
2. Navigate to directoy where you have clone this repo. e.g.  c:\docolme-emberjs\
3. Run the PHP Server => 
```
php -S localhost:8080 -t public public/index.php
```
5. Change database connection credentials in c:\docolme-emberjs\src\dependencies.php
```
    /** THIS SHOULD BE SET SOMEWHERE IN THE SERVER ENV VARIABLES - START */
    $_ENV['DB_HOST'] = '127.0.0.1';
    $_ENV['DB_NAME'] = 'docs';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = 'PASSWORD-HERE-IF-ANY';
    /** THIS SHOULD BE SET SOMEWHERE IN THE SERVER ENV VARIABLES - START */
```
4. Open browser - http://localhost:8080/docs/index.html#/users/login 

## Rest APIs
* To import in Postman
https://www.getpostman.com/collections/1ba0d0de13c417a743c6
