-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2013 at 10:47 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytab`
--
CREATE DATABASE IF NOT EXISTS `mytab` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mytab`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `acc_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE IF NOT EXISTS `authentication` (
  `login_id` varchar(100) NOT NULL,
  `access_token` varchar(1000) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `login_user_id` varchar(50) NOT NULL,
  `acc_id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `account_added_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `account_last_modified` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`login_user_id`,`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `login_user_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `authenticated` bit(1) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`login_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--
-- Seed Data for Accounts
--
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(0, 'cms', 'CMS');
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(1, 'ccnet', 'CCNet');
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(2, 'piazza', 'Piazza');
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(3, 'gannett', 'Gannett');
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(4, 'studentcenter', 'Student Center');
INSERT IGNORE INTO accounts(id, acc_id, name) VALUES(5, 'blackboard', 'Blackboard');

