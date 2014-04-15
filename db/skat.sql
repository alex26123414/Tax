-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2014 at 06:23 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skat`
--

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `idincome` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `idincome_type` int(11) DEFAULT NULL,
  `idtax` int(11) DEFAULT NULL,
  PRIMARY KEY (`idincome`),
  KEY `income_income_type_idx` (`idincome_type`),
  KEY `income_tax_idx` (`idtax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`idincome`, `name`, `idincome_type`, `idtax`) VALUES
(1, 'Lønindkomst', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `income_info`
--

CREATE TABLE IF NOT EXISTS `income_info` (
  `idincome_info` int(11) NOT NULL AUTO_INCREMENT,
  `cpr` int(11) DEFAULT NULL,
  `idincome` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idincome_info`),
  KEY `income_info_person_idx` (`cpr`),
  KEY `income_info_income_idx` (`idincome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `income_info`
--

INSERT INTO `income_info` (`idincome_info`, `cpr`, `idincome`, `value`, `date`) VALUES
(1, 1005891234, 1, 67465, '2014-04-11 09:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `income_type`
--

CREATE TABLE IF NOT EXISTS `income_type` (
  `idincome_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idincome_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `income_type`
--

INSERT INTO `income_type` (`idincome_type`, `name`) VALUES
(1, 'Personlig indkomst');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `cpr` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `e-mail` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`cpr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`cpr`, `first_name`, `last_name`, `address`, `e-mail`, `phone`, `password`) VALUES
(1005891234, 'Alex', 'Gheorghiasa', 'Sigvald Gade 6, 2. tv, 2450 Kbh SV', 'alex26123414@gmail.com', '26123414', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `idtax` int(11) NOT NULL AUTO_INCREMENT,
  `value` double DEFAULT NULL,
  PRIMARY KEY (`idtax`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`idtax`, `value`) VALUES
(1, 0.36);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_income_type` FOREIGN KEY (`idincome_type`) REFERENCES `income_type` (`idincome_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `income_tax` FOREIGN KEY (`idtax`) REFERENCES `tax` (`idtax`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income_info`
--
ALTER TABLE `income_info`
  ADD CONSTRAINT `income_info_income` FOREIGN KEY (`idincome`) REFERENCES `income` (`idincome`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `income_info_person` FOREIGN KEY (`cpr`) REFERENCES `person` (`cpr`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
