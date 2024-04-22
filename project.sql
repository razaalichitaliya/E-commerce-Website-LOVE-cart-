-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(6) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `description`, `price`, `image`) VALUES
(1, 'hhh', '', 1000, '5378689-star-dark-night-sky-as'),
(2, 'Lenovo Laptop H23', 'Intel i3, 4GB, 500GB SSD', 30000, 'photo2.jpg'),
(3, 'Dell Laptop Z50', 'Intel i5, 16GB, 250GB SSD', 45000, 'photo3.jpg'),
(4, 'Asus Tuf', 'Intel i5, 8GB, 250GB SSD', 42000, 'photo4.jpg'),
(10, 'hhh', '', 1000, '5378689-star-dark-night-sky-as');

-- --------------------------------------------------------

--
-- Table structure for table `productr`
--

CREATE TABLE `productr` (
  `productid` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productr`
--

INSERT INTO `productr` (`productid`, `productname`, `price`, `image`) VALUES
(4, 'Casio Classic', 2500, 'p11.jpg'),
(6, 'Shoes', 1200, 'p12.jpg'),
(7, 'Pandora Nova', 6999, '352883C02_RGB.jpg'),
(8, 'Crokery', 3999, 'p9.jpg'),
(9, 'Heels', 3299, 'heels.jpg'),
(11, 'titan ', 3000, 'p1.jpg'),
(13, 'Bella vita Honey', 799, 'p10.jpg'),
(15, 'Puff sleeve Corset', 989, 'kk.jpg'),
(16, 'diamond ring', 79877, 'rr.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productname`, `price`, `image`) VALUES
(2, 'Pandora', 2500.00, 'p2.jpg'),
(3, 'Shoes', 1800.00, 'p3.jpg'),
(4, 'Hoodie', 1500.00, 'p4.jpg'),
(5, 'Wallet', 500.00, 'p5.jpg'),
(6, 'Glasses', 700.00, 'p6.jpg'),
(7, 'iphone', 80000.00, 'p7.jpg'),
(8, 'Vision', 4000.00, 'p8.jpg'),
(9, 'bag', 400.00, 'p9.jpg'),
(11, 'Play Station 5', 500.00, 'p11.jpg'),
(22, 'Couch', 3599.00, 'p12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `emailid` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gander` int(1) NOT NULL,
  `city` varchar(20) NOT NULL,
  `class` varchar(5) NOT NULL,
  `stream` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`emailid`, `name`, `password`, `gander`, `city`, `class`, `stream`) VALUES
('raza@gmail.com', 'raza', 'raza', 0, 'Rajkot ', 'DC3', 'CE-DIPLOMA'),
('Razaali', 'Chitaliya', 'Razaali7', 0, 'Rajkot', 'dc3', 'ce'),
('riya321@gmail.com', 'riya', 'riya', 1, 'Rajkot ', 'DC3', 'CE-DIPLOMA'),
('viv@gmail.com', 'viv', '12345678', 0, 'rajkot', 'dc3', 'CE-DIPLOMA'),
('xyz@gmail.com', 'xyz', 'xyz', 0, 'xyz', 'xyz', 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `emailid` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`emailid`, `password`) VALUES
('seller', 'abcd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `productr`
--
ALTER TABLE `productr`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`emailid`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`emailid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productr`
--
ALTER TABLE `productr`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
