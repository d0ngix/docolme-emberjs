# docolme-emberjs
playing with ember + slimframework

# Requirements
* PHP 7.x

# DB Schema
CREATE TABLE `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contentText` text COLLATE utf8_bin,
  `created` timestamp NULL DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
