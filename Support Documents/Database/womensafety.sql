-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 04:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` int(11) NOT NULL,
  `harresment` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `name`, `mobile`, `harresment`, `date`, `status`) VALUES
(20, 25, 'Thushigha', 775678832, 'Physical Hazard', '2023-01-04', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `relationship` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `user_id`, `username`, `name`, `mobile`, `email`, `relationship`) VALUES
(18, 0, 'Thushigha', 'Nakarasan', 765705081, 'nakarasan@gmail.com', 'Brother'),
(19, 25, 'Thushigha', 'Nakarasan', 765705081, 'nakarasan@gmail.com', 'Brother');

-- --------------------------------------------------------

--
-- Table structure for table `police_stations`
--

CREATE TABLE `police_stations` (
  `id` int(11) NOT NULL,
  `police_station` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `police_stations`
--

INSERT INTO `police_stations` (`id`, `police_station`, `district`) VALUES
(8, 'Jaffna', 'Jaffna');

-- --------------------------------------------------------

--
-- Table structure for table `police_users`
--

CREATE TABLE `police_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(30) NOT NULL,
  `police_station` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `police_users`
--

INSERT INTO `police_users` (`id`, `username`, `email`, `mobile`, `police_station`, `password`) VALUES
(19, 'Sharmilan', 'sharmilan@gmail.com', '0777448152', 'Jaffna', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `safety_tips`
--

CREATE TABLE `safety_tips` (
  `id` int(11) NOT NULL,
  `tip` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `safety_tips`
--

INSERT INTO `safety_tips` (`id`, `tip`) VALUES
(9, 'Be aware of your surroundings.');

-- --------------------------------------------------------

--
-- Table structure for table `threats`
--

CREATE TABLE `threats` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lat` varchar(250) NOT NULL,
  `lng` varchar(250) NOT NULL,
  `map` varchar(250) NOT NULL,
  `datetime` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threats`
--

INSERT INTO `threats` (`id`, `user_name`, `message`, `ip`, `lat`, `lng`, `map`, `datetime`) VALUES
(22, 'Thushigha', 'I am in danger. Please help me.', '175.157.44.130', '9.6760888', '80.0316755', 'https://www.google.com/maps/search/?api=1&query=9.6760888,80.0316755&query_place_id=175.157.44.130', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `mobile`, `password`) VALUES
(6, 'admin', 'admin', 'admin@gmail.com', 1234567890, '123456'),
(7, 'police', 'police', 'police@gmail.com', 119, '123456'),
(25, 'Thushigha', 'user', 'thushigha@gmail.com', 775678832, '123456'),
(31, 'Sharmilan', 'police', 'sharmilan@gmail.com', 777448152, '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police_stations`
--
ALTER TABLE `police_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police_users`
--
ALTER TABLE `police_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_tips`
--
ALTER TABLE `safety_tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threats`
--
ALTER TABLE `threats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `police_stations`
--
ALTER TABLE `police_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `police_users`
--
ALTER TABLE `police_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `safety_tips`
--
ALTER TABLE `safety_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `threats`
--
ALTER TABLE `threats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
