-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2022 at 06:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `womensafety`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE IF NOT EXISTS `complaints` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `mobile` int NOT NULL,
  `harresment` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `mobile`, `harresment`, `date`, `status`) VALUES
(1, 'a', 34534, 'Physical Hazard', '2022-12-14', 'Not Started'),
(2, 'sdfs', 34534, 'Physical Hazard', '2022-12-15', 'Completed'),
(3, 'sdf', 53453, 'Physical Hazard', 'Physical Hazard', 'Physical Hazard'),
(4, 'rwwer', 23423, 'Physical Hazard', '2022-12-20', 'Not Started'),
(5, 'rwwer', 23423, 'Verbal Harressment', '2022-12-30', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

DROP TABLE IF EXISTS `guardians`;
CREATE TABLE IF NOT EXISTS `guardians` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `relationship` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `police_stations`
--

DROP TABLE IF EXISTS `police_stations`;
CREATE TABLE IF NOT EXISTS `police_stations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `police_station` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police_stations`
--

INSERT INTO `police_stations` (`id`, `police_station`, `district`) VALUES
(1, 'asdad', 'jaffna');

-- --------------------------------------------------------

--
-- Table structure for table `police_users`
--

DROP TABLE IF EXISTS `police_users`;
CREATE TABLE IF NOT EXISTS `police_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `police_station` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police_users`
--

INSERT INTO `police_users` (`id`, `username`, `mobile`, `police_station`) VALUES
(1, 'admin', '4334', 'jaffna'),
(2, 'sss', '0778135468', 'jaffna'),
(10, 'p', '23423', 'sdfsf');

-- --------------------------------------------------------

--
-- Table structure for table `safety_tips`
--

DROP TABLE IF EXISTS `safety_tips`;
CREATE TABLE IF NOT EXISTS `safety_tips` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `safety_tips`
--

INSERT INTO `safety_tips` (`id`, `tip`) VALUES
(3, 'sadadasd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` int NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `mobile`, `password`) VALUES
(6, 'admin', 'admin', 'admin@gmail.com', 1234567890, '123456'),
(7, 'police', 'police', 'police@gmail.com', 119, '123456');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
