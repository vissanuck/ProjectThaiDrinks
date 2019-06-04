-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2019 at 10:18 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `githubbe_thaidrinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `foodid` int(10) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `foodname` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `restid` int(10) NOT NULL,
  `orderid` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`foodid`, `userid`, `quantity`, `price`, `foodname`, `status`, `restid`, `orderid`) VALUES
(1, '0174504195', 6, '4.50', 'Green Tea ', 'not paid', 1, '04062019-7oAWDun'),
(12, '0174504195', 5, '3.50', 'Ice Cream Mixed', 'not paid', 1, '04062019-7oAWDun');

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `foodid` int(10) NOT NULL,
  `foodname` varchar(20) NOT NULL,
  `foodprice` varchar(5) NOT NULL,
  `quantity` int(10) NOT NULL,
  `restid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`foodid`, `foodname`, `foodprice`, `quantity`, `restid`) VALUES
(1, 'Green Tea ', '4.50', 19, 1),
(2, 'Lemon Tea ', '4.00', 26, 1),
(3, 'Brown Sugar Milk', '8.50', 29, 3),
(4, 'Strawberry Juice', '5.00', 30, 3),
(5, 'Green Tea Milk', '8.50', 32, 3),
(6, 'Jele Mixed Berry', '2.60', 25, 2),
(7, 'Jele Strawberry', '2.60', 20, 2),
(8, 'Jele Blackcurrant', '2.40', 23, 2),
(9, 'Jele Carnitine', '2.30', 25, 2),
(10, 'Lactasoy Black', '2.70', 22, 2),
(11, 'Mixied Fruit', '2.10', 25, 2),
(12, 'Ice Cream Mixed', '3.50', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered`
--

CREATE TABLE `ordered` (
  `orderid` varchar(20) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `total` int(7) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restid`, `name`, `phone`, `address`, `location`) VALUES
(1, 'DREAM DESSERT SHOP', '044567895', 'Inasis Tradewind UUM ', 'Inasis Tradewind '),
(2, '7ELEVEN SHOP', '045682311', 'No 85 Taman Seri Pauh ', 'Changlun'),
(3, 'TEA LIVE SHOP', '0456789578', 'Lot 24 Jalan Perindustrian 101', 'Changlun');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(5) NOT NULL,
  `location` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `phone`, `age`, `location`, `email`, `password`) VALUES
(24, 'Vissanuck Ket Keaw', '0174504195', 24, 'Inasis Petronas', 'vissanuckjoey@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`foodid`);

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`foodid`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `foodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
