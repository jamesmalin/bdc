-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2014 at 04:21 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `localca4_bdctest`
--

-- --------------------------------------------------------

--
-- Table structure for table `bdc`
--

CREATE TABLE IF NOT EXISTS `bdc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(55) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(55) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `source` varchar(8) NOT NULL,
  `alert` varchar(15) NOT NULL,
  `transfer` varchar(55) NOT NULL,
  `appt` varchar(12) NOT NULL,
  `appttime` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `date` varchar(15) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bdc_client`
--

CREATE TABLE IF NOT EXISTS `bdc_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealership` varchar(55) NOT NULL,
  `emails` varchar(155) NOT NULL,
  `best_contact` varchar(55) NOT NULL,
  `best_contact_number` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bdc_user`
--

CREATE TABLE IF NOT EXISTS `bdc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bdc_user`
--

INSERT INTO `bdc_user` (`id`, `email`, `password`, `name`) VALUES
(1, 'kimc@tkmkt.com', 'kimc1', 'Kim Checchia');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
