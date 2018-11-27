-- Database Manager 4.2.5 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_admin` (`admin_id`, `name`, `email`, `password`) VALUES
(2,	'Bhumi Borad',	'bhumiborad@gmail.com',	'$2y$10$QqvXNeZaAVd70rWBcrCY2.4BpoFVmIaQl9yvGeUdbvNxYX1LtEEQS'),
(3,	'Chetana Sangani',	'chetanasangani@gmail.com',	'$2y$10$80AIbekTrr0S4YYWtDMPzOd8vsOHh55L1ET.Bleqb9AFVg6nT8rae'),
(4,	'Arshita Gangani',	'arshitagangani@gmail.com',	'$2y$10$uWdM8PzRMquZGDo/7LcygeU0TDDKJYbui09YeX/byAtYR4r5ZBX0O'),
(5,	'Karishma Babi',	'karishmababi@gmail.com',	'$2y$10$pA.NH0riYD2xaagAoW9gUewkPpzqWB69MqOqLLMkIMLVOH8xw2OmG'),
(6,	'Pinal Chovatiya',	'pinalchovatiya@gmail.com',	'$2y$10$MGLU8b69lkrEXKDOMLyyouCt2b6mlstmmIsT/3nmCqF/7SsQCxcPS'),
(7,	'Ruta Vaghani',	'rutavaghani@gmail.com',	'$2y$10$Lk9527wiw/uqoo2njwlpWuHayiSeAshNeJWgJGKARUITjFCETPR.y'),
(8,	'Jalpa Borad',	'jalpaborad@gmail.com',	'$2y$10$8w3CNjG53PYq0AiQ2CUIZeSYotWmhXP64kiEIAfn0QD1du4tgAj5.'),
(9,	'Nensi Vekariya',	'nensivekariya@gmail.com',	'$2y$10$UFkLmgO5MnjbjXOhAPpZ3OD5GCBLQVnH0cbc.4WNKrh0hUIJ3MOr2'),
(10,	'Kreena Gangani',	'kreenagangani@gmail.com',	'$2y$10$RF3m.odGpetZVMrCh4kOl.qo5uAfU9bdzru5V6SQbYY7Yim1KD8VK'),
(11,	'Manshi Savaliya',	'manshisavaliya@gmail.com',	'$2y$10$uK2bIkrD.u6xowJttR46muucbzccQTSerdjl1l6O1VGRDiONDUJZm'),
(12,	'Nisha ramani',	'nisharamani@gmail.com',	'$2y$10$NkWWbK7MfkdsewpBL2Yp.OsTum.IXjaQVbv03WFEcub9opG0DJKQS'),
(13,	'Payal Gosai',	'payalgosai@gmail.com',	'$2y$10$OXDwMmDQYNOzs0FevnrPmeRBIjSnWUt1ddWlR2F/PgD0wCGq3DoqW'),
(14,	'Zarna Savaliya',	'zarnasavaliya@gmail.com',	'$2y$10$97iiGGujT0/BOEUJki9jh.tNP9JPAjkrwAa8t5ooNa1.JJDoBmWdK'),
(15,	'Heena Dalal',	'heenadalal@gmail.com',	'$2y$10$avQ3vRsZ5nmFHtPerKZQOu2.kkPqgL0XsFVv2YtVcA27hnPFQgXI.'),
(16,	'Jignesh Avaiya',	'jigneshavaiya@gmail.com',	'$2y$10$Ys.DbNR3I/xpY15/4XT4OO6J4ybAokzQNj9gdwxg60LBzDsrmqyw2'),
(17,	'Adil Saiyad',	'adilsaiyad@gmail.com',	'$2y$10$devzSyarjryOCUXdPgOKxeuwfkBm/YCaxGDIesyQFdd8sMu6BimDq'),
(18,	'Gautam Gondaliya',	'gautamgondaliya@gmail.com',	'$2y$10$pvATcIEf/zbeuJfuv6vtZe6o/Zlslkdx0KXAWsUJKu6Bb8b/JisuO'),
(19,	'Keval Koria',	'kevalkoria@gmail.com',	'$2y$10$cRD3n2TUmFbniTCxdDPs8eN5aksrES6JPucLHe8CAh0M9/MIX7K4q'),
(20,	'Paras Dudhat',	'parasdudhat@gmail.com',	'$2y$10$NqhmpoqXVIwQS3n4XHbYceuIr8a4zezzJ5FXv5VEI55HMgSCftIs2'),
(21,	'Krishna Sahani',	'krishnasahani@gmail.com',	'$2y$10$dlp6WuuzWpREfrYFHcX7beUaAHn82cpiAmZpAXpCslxPG3Sw/yeuG'),
(22,	'Sandip Kukadiya',	'sandipkukadiya@gmail.com',	'$2y$10$VphdocFH5F7Uj21D0GMfxuyZsRSJ6sw0daZQ9mPuYCanOlHh2rFPO'),
(23,	'Bhavin Baldha',	'bhavinbaldha@gmail.com',	'$2y$10$C01oQqErxZlrAMa3B1Qo.egSlHKDszSM5BSUevKR6P0kgnPb.OHTy'),
(24,	'Vishva Nasit',	'vishvanasit@gmail.com',	'$2y$10$iSZnNxER70N95nMrbGhAbONWv5HC3zgK89w7kbUEl7kSuhQk899.S'),
(25,	'Sanjana Patel',	'sanjanapatel@gmail.com',	'$2y$10$BKqqShw3gILdhrzF8Hwry.Lzl8AWt4oxxAquYsIDVPuZDFdsKKG6K'),
(26,	'SHASHIKANT GUPTA',	'shashikantgupta@gmail.com',	'$2y$10$qUDxyAL8njZNNSY8K/ogtuxR7MZHn1M5V7etp8bVyLLyTQqPaObsC'),
(27,	'Sachin Patel',	'sachinepatel@7star.com',	'$2y$10$XPLHObP3Mm19qYNZmxBoyeRrDAEI8x2KBA7ICLNawFoqRQ1u5EDsm'),
(28,	'Milan Patel',	'milanpatel@gmail.com',	'$2y$10$s0OgoBw1YdeYeQdfJ430o.G1hnbUmaXnb/cgiQb1MFyuqyjWe/dBG');

DROP TABLE IF EXISTS `tbl_application`;
CREATE TABLE `tbl_application` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_name` varchar(255) NOT NULL,
  `application_link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_comm`;
CREATE TABLE `tbl_comm` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `user` varchar(100) NOT NULL DEFAULT '0',
  `admin` varchar(100) NOT NULL DEFAULT '0',
  `status` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `create_time` time NOT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_contacts`;
CREATE TABLE `tbl_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `number` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_level`;
CREATE TABLE `tbl_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_level` (`level_id`, `price`) VALUES
(1,	4),
(2,	3),
(3,	2),
(4,	1),
(5,	0),
(6,	0),
(7,	0),
(8,	0),
(9,	0),
(10,	0);

DROP TABLE IF EXISTS `tbl_notification`;
CREATE TABLE `tbl_notification` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sound` varchar(255) NOT NULL,
  `is_sound` varchar(100) NOT NULL,
  `noti_date` datetime NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_payreq`;
CREATE TABLE `tbl_payreq` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `payment_by` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `payStatus` int(11) NOT NULL DEFAULT '2',
  `notify_msg` varchar(255) NOT NULL DEFAULT 'Pending for your paytm request',
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `pay_datetime` datetime NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_recharge`;
CREATE TABLE `tbl_recharge` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `payment_by` varchar(255) NOT NULL,
  `barcode` text NOT NULL,
  `payStatus` int(11) NOT NULL DEFAULT '2',
  `notify_msg` varchar(255) NOT NULL DEFAULT 'Pending for your Recharge request',
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `pay_datetime` datetime NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_setting`;
CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_referral` float NOT NULL,
  `accept_msg` varchar(500) NOT NULL,
  `decline_msg` varchar(500) NOT NULL,
  `paytm_limit` float NOT NULL,
  `paytm_limit_msg` varchar(500) NOT NULL,
  `paytm_min` float NOT NULL,
  `paytm_max` float NOT NULL,
  `paytm_per` varchar(100) NOT NULL,
  `transfer_limit` float NOT NULL,
  `transfer_limit_msg` varchar(500) NOT NULL,
  `transfer_min` float NOT NULL,
  `transfer_max` float NOT NULL,
  `imp_earn` float NOT NULL,
  `click_earn` float NOT NULL,
  `install_earn` varchar(100) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `banner2` varchar(255) NOT NULL,
  `banner3` varchar(255) NOT NULL,
  `interstrial` varchar(255) NOT NULL,
  `reward_video` varchar(255) NOT NULL,
  `startapp_video` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL,
  `timer` int(11) NOT NULL,
  `timer1` int(11) NOT NULL,
  `spin` varchar(100) NOT NULL,
  `ticket_request` varchar(100) NOT NULL,
  `today_click` varchar(100) NOT NULL,
  `install_click` varchar(100) NOT NULL,
  `money_per_click` varchar(100) NOT NULL,
  `money_per_install` varchar(100) NOT NULL,
  `version` varchar(255) NOT NULL,
  `ad_status` varchar(100) NOT NULL,
  `app_status` varchar(100) NOT NULL,
  `today_earn` varchar(100) NOT NULL,
  `today_earn1` varchar(100) NOT NULL,
  `coin_click` varchar(100) NOT NULL,
  `money_per_coin` varchar(100) NOT NULL,
  `fb_bannerid` varchar(255) NOT NULL,
  `fb_fullscreenid` varchar(255) NOT NULL,
  `fb_native` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_setting` (`id`, `join_referral`, `accept_msg`, `decline_msg`, `paytm_limit`, `paytm_limit_msg`, `paytm_min`, `paytm_max`, `paytm_per`, `transfer_limit`, `transfer_limit_msg`, `transfer_min`, `transfer_max`, `imp_earn`, `click_earn`, `install_earn`, `banner`, `banner2`, `banner3`, `interstrial`, `reward_video`, `startapp_video`, `task`, `timer`, `timer1`, `spin`, `ticket_request`, `today_click`, `install_click`, `money_per_click`, `money_per_install`, `version`, `ad_status`, `app_status`, `today_earn`, `today_earn1`, `coin_click`, `money_per_coin`, `fb_bannerid`, `fb_fullscreenid`, `fb_native`) VALUES
(1,	0.5,	' with 28% Paytm charges Fastest Paytm Giving App',	'Please enter valid paytm QR code',	1,	'You Can Do Only 1 request per day !',	5,	10,	'100',	1,	'You can do more request  will tomorrow !',	10,	10,	0.05,	1,	'1',	'ca-app-pub-7669854705985741/9849268510',	'ca-app-pub-7669854705985741/9849268510',	'ca-app-pub-7669854705985741/9849268510',	'ca-app-pub-7669854705985741/7674531316',	'dftrgt',	'',	'1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,3',	60,	10,	'50',	'1',	'0',	'5',	'0',	'1',	'1.3',	'false',	'',	'0.05',	'1',	'10',	'0.25',	'',	'',	'');

DROP TABLE IF EXISTS `tbl_today_click`;
CREATE TABLE `tbl_today_click` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `click` varchar(100) NOT NULL DEFAULT '0',
  `installed` varchar(100) NOT NULL DEFAULT '0',
  `installed1` varchar(100) NOT NULL,
  `today` date NOT NULL,
  `datetime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_today_coin`;
CREATE TABLE `tbl_today_coin` (
  `coin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `coin` int(11) NOT NULL,
  `earn` float NOT NULL,
  `today` date NOT NULL,
  PRIMARY KEY (`coin_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_transfer`;
CREATE TABLE `tbl_transfer` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `account_holder` varchar(50) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `transStatus` int(11) NOT NULL DEFAULT '2',
  `notify_msg` varchar(500) NOT NULL DEFAULT 'Pending for your bank request',
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `pay_datetime` datetime NOT NULL,
  PRIMARY KEY (`transfer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `refferal_key` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `referral` varchar(50) NOT NULL,
  `referral_count` int(11) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `imei` varchar(100) NOT NULL,
  `token` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `balance` float NOT NULL,
  `referral_balance` float NOT NULL,
  `profile` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `user_ips` varchar(50) NOT NULL,
  `today_date` datetime NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `imei1` varchar(255) NOT NULL,
  `fbid` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `imei` (`imei`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_user_token`;
CREATE TABLE `tbl_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `capcha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_work`;
CREATE TABLE `tbl_work` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `impression` int(11) NOT NULL,
  `impression_earn` float NOT NULL,
  `click` int(11) NOT NULL,
  `click_earn` float NOT NULL,
  `installed` int(11) NOT NULL,
  `install_earn` float NOT NULL,
  `today` date NOT NULL,
  PRIMARY KEY (`work_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2018-11-27 05:28:26
