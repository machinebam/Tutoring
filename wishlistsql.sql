-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2012 at 06:28 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wishlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `wishers`
--

CREATE TABLE IF NOT EXISTS `wishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) CHARACTER SET utf8 NOT NULL,
  `password` char(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wishers`
--

INSERT INTO `wishers` (`id`, `name`, `password`) VALUES
(1, 'Tom', 'tomcat'),
(2, 'Jerry', 'jerrymouse'),
(3, 'Bob', 'bob');

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE IF NOT EXISTS `wishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wisher_id` int(11) NOT NULL,
  `description` char(255) CHARACTER SET utf8 NOT NULL,
  `due_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wisher_id` (`wisher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`id`, `wisher_id`, `description`, `due_date`) VALUES
(5, 1, 'Sausage', '2008-04-01'),
(6, 1, 'Icecream', NULL),
(7, 2, 'Cheese', '2008-05-01'),
(8, 2, 'Candle', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`wisher_id`) REFERENCES `wishers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;