-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 12:12 PM
-- Server version: 5.5.32-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `readfiend`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `userid` int(11) NOT NULL,
  `role` varchar(16) NOT NULL,
  `has_access` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`userid`, `role`, `has_access`) VALUES
(2, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedId` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `link` varchar(100) NOT NULL,
  `pubDate` datetime NOT NULL,
  `description` text NOT NULL,
  `contentEncoded` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `providerId` varchar(50) NOT NULL,
  `providerName` varchar(50) NOT NULL,
  `providerUrl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link` (`link`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `articles_category`
--

CREATE TABLE IF NOT EXISTS `articles_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(100) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `article_id` varchar(100) NOT NULL,
  `feed_id` varchar(100) NOT NULL,
  `mapped` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_alias`
--

CREATE TABLE IF NOT EXISTS `category_alias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias_id` varchar(100) NOT NULL,
  `cat_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL,
  `category` varchar(64) NOT NULL,
  `provider` int(11) NOT NULL,
  `url` varchar(64) NOT NULL,
  `schedule` varchar(200) NOT NULL,
  `created_on` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feed_category`
--

CREATE TABLE IF NOT EXISTS `feed_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fbId` varchar(32) NOT NULL,
  `location` varchar(64) NOT NULL,
  `gender` char(8) NOT NULL,
  `locale` varchar(16) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `email`, `password`, `fbId`, `location`, `gender`, `locale`) VALUES
(1, 'abhishek kumar', 'abhishek@inkoniq.com', '202cb962ac59075b964b07152d234b70', '', '', '', ''),
(2, 'admin', 'admin@rf.com', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
