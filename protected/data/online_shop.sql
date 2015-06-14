-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2015 at 07:36 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Bid.*', '4', NULL, 'N;'),
('Bid.Create', '4', NULL, 'N;'),
('Bidder User', '4', NULL, 'N;'),
('Item.*', '2', NULL, 'N;'),
('Item.Admin', '2', NULL, 'N;'),
('Item.Create', '2', NULL, 'N;'),
('Item.Delete', '2', NULL, 'N;'),
('Item.Index', '2', NULL, 'N;'),
('Item.Update', '2', NULL, 'N;'),
('Item.View', '2', NULL, 'N;'),
('ItemBids', '2', NULL, 'N;'),
('Items Manager', '2', NULL, 'N;'),
('Site.*', '2', NULL, 'N;'),
('Site.*', '4', NULL, 'N;'),
('User.Profile.*', '2', NULL, 'N;'),
('User.Profile.*', '4', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('add', 0, 'add data', NULL, 'N;'),
('Admin', 2, 'have all authorties', NULL, 'N;'),
('Bid.*', 1, NULL, NULL, 'N;'),
('Bid.Create', 0, NULL, NULL, 'N;'),
('Bidder User', 2, 'user can only bid', NULL, 'N;'),
('Item.*', 1, NULL, NULL, 'N;'),
('Item.Admin', 0, NULL, NULL, 'N;'),
('Item.Create', 0, NULL, NULL, 'N;'),
('Item.Delete', 0, NULL, NULL, 'N;'),
('Item.Index', 0, NULL, NULL, 'N;'),
('Item.Update', 0, NULL, NULL, 'N;'),
('Item.View', 0, NULL, NULL, 'N;'),
('ItemBids', 1, 'user can see bids on item', NULL, 'N;'),
('Items Manager', 2, 'user can only manage items', NULL, 'N;'),
('Site.*', 1, NULL, NULL, 'N;'),
('Site.Contact', 0, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Site.Login', 0, NULL, NULL, 'N;'),
('Site.Logout', 0, NULL, NULL, 'N;'),
('User.Activation.*', 1, NULL, NULL, 'N;'),
('User.Activation.Activation', 0, NULL, NULL, 'N;'),
('User.Admin.*', 1, NULL, NULL, 'N;'),
('User.Admin.Admin', 0, NULL, NULL, 'N;'),
('User.Admin.Create', 0, NULL, NULL, 'N;'),
('User.Admin.Delete', 0, NULL, NULL, 'N;'),
('User.Admin.Update', 0, NULL, NULL, 'N;'),
('User.Admin.View', 0, NULL, NULL, 'N;'),
('User.Default.*', 1, NULL, NULL, 'N;'),
('User.Default.Index', 0, NULL, NULL, 'N;'),
('User.Login.*', 1, NULL, NULL, 'N;'),
('User.Login.Login', 0, NULL, NULL, 'N;'),
('User.Logout.*', 1, NULL, NULL, 'N;'),
('User.Logout.Logout', 0, NULL, NULL, 'N;'),
('User.Profile.*', 1, NULL, NULL, 'N;'),
('User.Profile.Changepassword', 0, NULL, NULL, 'N;'),
('User.Profile.Edit', 0, NULL, NULL, 'N;'),
('User.Profile.Profile', 0, NULL, NULL, 'N;'),
('User.ProfileField.*', 1, NULL, NULL, 'N;'),
('User.ProfileField.Admin', 0, NULL, NULL, 'N;'),
('User.ProfileField.Create', 0, NULL, NULL, 'N;'),
('User.ProfileField.Delete', 0, NULL, NULL, 'N;'),
('User.ProfileField.Update', 0, NULL, NULL, 'N;'),
('User.ProfileField.View', 0, NULL, NULL, 'N;'),
('User.Recovery.*', 1, NULL, NULL, 'N;'),
('User.Recovery.Recovery', 0, NULL, NULL, 'N;'),
('User.Registration.*', 1, NULL, NULL, 'N;'),
('User.Registration.Registration', 0, NULL, NULL, 'N;'),
('User.User.*', 1, NULL, NULL, 'N;'),
('User.User.Index', 0, NULL, NULL, 'N;'),
('User.User.View', 0, NULL, NULL, 'N;'),
('userBids', 1, 'User can view his bids on items', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Bidder User', 'Bid.*'),
('Bidder User', 'Bid.Create'),
('Items Manager', 'Item.*'),
('Bidder User', 'Item.Admin'),
('Items Manager', 'Item.Admin'),
('Items Manager', 'Item.Create'),
('Items Manager', 'Item.Delete'),
('Bidder User', 'Item.Index'),
('Items Manager', 'Item.Index'),
('Items Manager', 'Item.Update'),
('Bidder User', 'Item.View'),
('Items Manager', 'Item.View'),
('Bidder User', 'ItemBids'),
('Items Manager', 'ItemBids'),
('Items Manager', 'Site.Error'),
('Items Manager', 'Site.Login'),
('Bidder User', 'User.Admin.View'),
('Items Manager', 'User.Admin.View'),
('Items Manager', 'User.Login.*'),
('Bidder User', 'User.Login.Login'),
('Items Manager', 'User.Login.Login'),
('Items Manager', 'User.Logout.*'),
('Bidder User', 'User.Logout.Logout'),
('Items Manager', 'User.Logout.Logout'),
('Items Manager', 'User.Profile.*'),
('Bidder User', 'User.Profile.Changepassword'),
('Items Manager', 'User.Profile.Changepassword'),
('Bidder User', 'User.Profile.Edit'),
('Items Manager', 'User.Profile.Edit'),
('Bidder User', 'User.Profile.Profile'),
('Items Manager', 'User.Profile.Profile'),
('Items Manager', 'User.ProfileField.*'),
('Bidder User', 'User.ProfileField.Update'),
('Bidder User', 'User.ProfileField.View'),
('Items Manager', 'userBids');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `itemid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `value` float DEFAULT NULL,
  `itemtitle` varchar(128) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`itemid`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`itemid`, `userid`, `value`, `itemtitle`, `username`) VALUES
(1, 1, 3, 'car', 'admin'),
(1, 2, 500, 'car', 'itemsmanager'),
(2, 1, 1, 'glass', 'admin'),
(2, 2, 3, 'Table', 'itemsmanager'),
(3, 1, 1231, 'Dog', 'admin'),
(4, 1, 3, 'Flowers', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` varchar(550) NOT NULL,
  `status` int(11) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_by` smallint(6) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_edited_by` smallint(6) DEFAULT NULL,
  `last_edited_date` datetime DEFAULT NULL,
  `last_bid_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `status`, `picture`, `price`, `created_by`, `created_date`, `last_edited_by`, `last_edited_date`, `last_bid_by`) VALUES
(1, 'vas', 'very good', 1, 'C:\\wamp\\www\\onlineShop\\protected\\config/../../images/items/1.jpg', 100, NULL, NULL, NULL, NULL, 1),
(2, 'glass', 'glass lemo', 0, 'C:\\wamp\\www\\onlineShop\\protected\\config/../../images/items/2.jpg', 100, NULL, NULL, NULL, NULL, 1),
(3, 'Dog', 'cute dog', 0, 'C:\\wamp\\www\\onlineShop\\protected\\config/../../images/items/3.jpg', 324, NULL, NULL, NULL, NULL, 1),
(4, 'Flowers', 'orange flower', 0, 'C:\\wamp\\www\\onlineShop\\protected\\config/../../images/items/4.jpg', 300, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`) VALUES
(1, 'Admin', 'Administrator'),
(2, 'items Manager', 'items Manager'),
(4, 'AlNabulsi', 'Safaa');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2015-06-11 13:16:14', '2015-06-13 23:11:48', 1, 1),
(2, 'itemsmanager', 'ac3b5aab2b954cd44e609340f435f432', 'itemsManager@example.com', '3b7769f8bcc988c88402a7782562e92e', '2015-06-11 13:16:14', '2015-06-13 22:57:52', 0, 1),
(4, 'bidder', '92e4a0364e2670a621aaf4bf5765aa77', 'bidder@example.com', '6ed7e600e157cc7f4cf128b891edd2b2', '2015-06-13 09:26:35', '2015-06-13 22:46:33', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
