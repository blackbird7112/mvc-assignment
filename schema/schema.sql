CREATE TABLE IF NOT EXISTS `book` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `publisher` varchar(256) DEFAULT NULL,
  `maxqty` int NOT NULL,
  `avail` int NOT NULL,
  `users` varchar(256) DEFAULT NULL,
  `author` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`bid`)
);

CREATE TABLE IF NOT EXISTS `users` (
  `usr` varchar(256) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `pass` varchar(256) NOT NULL,
  PRIMARY KEY (`usr`)
);

CREATE TABLE IF NOT EXISTS `admin` (
  `usr` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  PRIMARY KEY (`usr`)
);

CREATE TABLE IF NOT EXISTS `request` (
  `reqid` int NOT NULL AUTO_INCREMENT,
  `usr` varchar(256) NOT NULL,
  `bid` varchar(256) NOT NULL,
  `reqtype` varchar(20) NOT NULL,
  `dt` varchar(256) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`reqid`)
);