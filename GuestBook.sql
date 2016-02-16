-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2015 at 08:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `GuestBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `Access`
--

CREATE TABLE IF NOT EXISTS `Access` (
`Id` int(11) NOT NULL,
  `Code` char(10) NOT NULL,
  `Staff` bit(1) NOT NULL DEFAULT b'0',
  `Staff_Id` int(11) DEFAULT NULL,
  `Guest_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Access`
--

INSERT INTO `Access` (`Id`, `Code`, `Staff`, `Staff_Id`, `Guest_Id`) VALUES
(1, 'STAFF', b'1', 1, NULL),
(2, 'ABC1', b'0', NULL, 1),
(3, 'ABC2', b'0', NULL, 2),
(4, 'ABC3', b'0', NULL, 3),
(5, 'ABC4', b'0', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Guest`
--

CREATE TABLE IF NOT EXISTS `Guest` (
`Id` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Suburb_Id` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Guest`
--

INSERT INTO `Guest` (`Id`, `FirstName`, `LastName`, `Gender`, `Email`, `Address`, `Suburb_Id`, `Rating`) VALUES
(1, 'David', 'Jones', 'M', 'davidjoones@bigpond.com', '1 Smith Street', 1, 3),
(2, 'Mark', 'Smith', 'M', 'mark@bigpond.com', '19 Test Lane', 1, 3),
(3, 'Selena', 'Ludley', 'F', 'selena85@hotmail.com', '1-2 Aborio Ct', 3, 4),
(4, 'Susan', 'Michaels', 'F', 'sm19@live.com', '23 Nowhere Lane', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `MenuOption`
--

CREATE TABLE IF NOT EXISTS `MenuOption` (
`Id` int(11) NOT NULL,
  `MenuItem` varchar(45) NOT NULL,
  `MenuItemPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MenuOption`
--

INSERT INTO `MenuOption` (`Id`, `MenuItem`, `MenuItemPrice`) VALUES
(1, 'Pepperoni Pizza', '12.50'),
(2, 'Vegetarian Pizza', '11.50'),
(3, 'Supreme Pizza', '13.00'),
(4, 'Pasta', '11.00'),
(5, 'Nuggets', '9.50'),
(6, 'Garlic Bread', '3.50'),
(7, 'Hawaiin', '11.00');

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE IF NOT EXISTS `Rating` (
`Id` int(11) NOT NULL,
  `Rating` int(1) DEFAULT NULL,
  `Comment` text,
  `Guest_Id` int(11) NOT NULL,
  `MenuOption_Id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rating`
--

INSERT INTO `Rating` (`Id`, `Rating`, `Comment`, `Guest_Id`, `MenuOption_Id`) VALUES
(1, 3, 'Very tasty thank you', 1, 1),
(2, 4, 'Blown away by the flavour!', 2, 2),
(3, 1, 'Disappointed with the speed of the service', 3, 4),
(4, 5, 'Excellent :)', 4, 5),
(5, 2, 'A little cold but not too bad', 4, 6),
(6, 3, 'Quite tasty', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE IF NOT EXISTS `Staff` (
`Id` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`Id`, `FirstName`, `LastName`) VALUES
(1, 'Gordon', 'Ramsay');

-- --------------------------------------------------------

--
-- Table structure for table `Suburb`
--

CREATE TABLE IF NOT EXISTS `Suburb` (
`Id` int(11) NOT NULL,
  `Suburb` varchar(100) NOT NULL,
  `Postcode` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Suburb`
--

INSERT INTO `Suburb` (`Id`, `Suburb`, `Postcode`) VALUES
(1, 'COSGROVE', 3631),
(2, 'MAGILL SOUTH', 5072),
(3, 'ARANA HILLS', 4054),
(4, 'PREMAYDENA', 7185),
(5, 'STEINBROOK', 2372),
(6, 'NORTH RICHMOND', 2754),
(7, 'FAIRY DELL', 3561),
(8, 'HAGLEY', 7292),
(9, 'MITCHELL PARK', 3352),
(10, 'WILLOWMAVIN', 3764),
(11, 'YOGANUP', 6275),
(12, 'NULLA VALE', 3435),
(13, 'BREAKWATER', 3219),
(14, 'PERRYS CROSSING', 2775),
(15, 'OXLEY VALE', 2340),
(16, 'SCHOFIELDS', 2762),
(17, 'YENDON', 3352),
(18, 'EMU POINT', 6330),
(19, 'SADLIERS CROSSING', 4305),
(20, 'PRIMBEE', 2502),
(21, 'CERES', 3221),
(22, 'EAGLE POINT', 3878),
(23, 'WURA', 4714),
(24, 'MURRA WARRA', 3401),
(25, 'CAFFEY', 4343),
(26, 'SALISBURY EAST NORTHBRI AVE', 5109),
(27, 'FISHERMANS POCKET', 4570),
(28, 'MONTACUTE', 5134),
(29, 'SALISBURY HEIGHTS', 5109),
(30, 'JOONDANNA', 6060),
(31, 'MCILWRAITH', 4671),
(32, 'TULKARA', 3478),
(33, 'KOOMBOOLOOMBA', 4872),
(34, 'DARTNALL', 6320),
(35, 'TONGARRA', 2527),
(36, 'RANELAGH', 7109),
(37, 'HAMLYN TERRACE', 2259),
(38, 'TARRAWINGEE', 3678),
(39, 'KILLAWARRA', 2429),
(40, 'PORT BOTANY', 2036),
(41, 'VASEY', 3407),
(42, 'MIDDLE CAMP', 2281),
(43, 'NELLY BAY', 4819),
(44, 'LURNEA', 2170),
(45, 'KEILOR PARK', 3042),
(46, 'MILLWOOD', 4357),
(47, 'JAMBOREE HEIGHTS', 4074),
(48, 'BRANYAN', 4670),
(49, 'ANSTEAD', 4070),
(50, 'BINGIE', 2537);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Access`
--
ALTER TABLE `Access`
 ADD PRIMARY KEY (`Id`), ADD KEY `fk_AccessID_Guest1_idx` (`Guest_Id`), ADD KEY `fk_AccessID_Staff1_idx` (`Staff_Id`);

--
-- Indexes for table `Guest`
--
ALTER TABLE `Guest`
 ADD PRIMARY KEY (`Id`,`Suburb_Id`), ADD KEY `fk_Guest_Suburb1_idx` (`Suburb_Id`);

--
-- Indexes for table `MenuOption`
--
ALTER TABLE `MenuOption`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
 ADD PRIMARY KEY (`Id`,`Guest_Id`,`MenuOption_Id`), ADD KEY `fk_Rating_Guest1_idx` (`Guest_Id`), ADD KEY `fk_Rating_MenuOption1_idx` (`MenuOption_Id`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Suburb`
--
ALTER TABLE `Suburb`
 ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Access`
--
ALTER TABLE `Access`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Guest`
--
ALTER TABLE `Guest`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `MenuOption`
--
ALTER TABLE `MenuOption`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Suburb`
--
ALTER TABLE `Suburb`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Access`
--
ALTER TABLE `Access`
ADD CONSTRAINT `fk_AccessID_Guest1` FOREIGN KEY (`Guest_Id`) REFERENCES `Guest` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_AccessID_Staff1` FOREIGN KEY (`Staff_Id`) REFERENCES `Staff` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Guest`
--
ALTER TABLE `Guest`
ADD CONSTRAINT `fk_Guest_Suburb1` FOREIGN KEY (`Suburb_Id`) REFERENCES `Suburb` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
ADD CONSTRAINT `fk_Rating_Guest1` FOREIGN KEY (`Guest_Id`) REFERENCES `Guest` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_Rating_MenuOption1` FOREIGN KEY (`MenuOption_Id`) REFERENCES `MenuOption` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
