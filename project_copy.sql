-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 09:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`) VALUES
(1, 'Nirmalya', '1234', 'tubaisg@gmail.com'),
(2, 'Sampriti', '12345', 'sampriti9051@gmail.com'),
(3, 'Maity', '123456', 'abhishekmaity279@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pprice` varchar(255) NOT NULL,
  `ppic` varchar(255) NOT NULL,
  `pqty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `cname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`) VALUES
(1, 'Mobiles'),
(2, 'Laptops'),
(3, 'Tablet'),
(4, 'Television'),
(7, 'Home Appliances'),
(11, 'Air Conditioner');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `cust_name` text NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `bill_time` varchar(50) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `Order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `cust_name`, `cust_email`, `prod_id`, `product_name`, `quantity`, `bill_time`, `total_price`, `Order_status`) VALUES
(124, 'ORD30412384', 'Nirmalya Ganguly', 'tubaisg@gmail.com', 31, 'Vivo Y97', 1, '2020-05-14 00:07:57', 15999, ''),
(125, 'ORD992968898', 'tubai Ganguly', 'tubaisg@gmail.com', 20, 'Oppo F11 pro', 10, '2020-05-14 11:38:25', 25000, ''),
(126, 'ORD958425961', 'tubai Ganguly', 'tubaisg@gmail.com', 18, 'Samsung Galaxy J7', 1, '2020-05-14 11:38:25', 18000, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pcategory` varchar(150) NOT NULL,
  `pdesc` text NOT NULL,
  `pprice` float NOT NULL,
  `pqty` int(11) NOT NULL,
  `pstatus` int(11) NOT NULL,
  `pimage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcategory`, `pdesc`, `pprice`, `pqty`, `pstatus`, `pimage`) VALUES
(18, 'Samsung Galaxy J7', '1', 'This is a Mobile    ', 18000, 9, 1, 'mobile10.jpg'),
(19, 'Vivo V7 Max', '1', 'This is a mobile', 2000, 9, 1, 'mobile3.jpg'),
(20, 'Oppo F11 pro', '1', 'This is a mobile    ', 2500, 20, 1, 'mobile4.jpg'),
(21, 'Lenovo ', '2', 'This is a laptop', 50000, 10, 1, 'laptop1.jpg'),
(22, 'Dell', '2', 'This is a laptop', 45000, 10, 1, 'laptop2.jpg'),
(24, 'HP', '2', 'This is a laptop', 50000, 10, 1, 'laptop3.jpg'),
(25, 'Samsung', '2', 'This is a laptop.', 78000, 10, 1, 'laptop4.jpg'),
(26, 'Lenovo V Mx Pro', '1', 'This is Leno P Max Pro', 10000, 10, 1, 'mobile5.jpg'),
(27, 'HP', '2', 'This is a lenovo laptop', 50000, 10, 1, 'laptop5.jpg'),
(30, 'Redmi Note 8', '1', 'This is a Redmi Note 8 Pro', 14999, 10, 1, 'mobile8.jpg'),
(31, 'Vivo Y97', '1', 'Vivo Y97', 15999, 9, 1, 'mobile9.jpg'),
(32, 'Samsung Galaxy A50', '1', 'A50    ', 21000, 10, 1, 'mobile11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ppic` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `ppic`) VALUES
(1, 'tubai Ganguly', 'tubaisg@gmail.com', '1234', 91024587669, 'Purba Sinthee Road ,DumDum,Kolkata-700030', 'profile.png'),
(9, 'samp', 's@gmail.com', '1111', 1452, 'aca', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
