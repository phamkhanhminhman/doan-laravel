-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 08:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` text NOT NULL,
  `categoryName` text CHARACTER SET utf8 NOT NULL,
  `categoryNote` text NOT NULL,
  `Created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `IMG` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryNote`, `Created`, `Updated`, `IMG`) VALUES
('DC', 'Đồ Chơi', 'okwww', '2019-01-19 09:10:57', '2019-01-19 09:13:11', 'upload/TET.png'),
('DGD', 'Điện Gia Dụng', 'ok', '2019-01-19 09:11:51', NULL, 'upload/meo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `customerUserName` text NOT NULL,
  `customerPass` text NOT NULL,
  `customerName` text,
  `customerAddress` text,
  `customerGender` text,
  `customerTel` text,
  `customerNote` text,
  `customerMail` text,
  `customerProvince` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerUserName`, `customerPass`, `customerName`, `customerAddress`, `customerGender`, `customerTel`, `customerNote`, `customerMail`, `customerProvince`) VALUES
(11, '', '', 'phuong', 'da aaa', '1', '1212', 'eee', 'eee', 'ee'),
(12, '', '', 'man\r\n', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `importID` int(11) NOT NULL,
  `importShipID` int(11) NOT NULL,
  `importStatus` varchar(255) NOT NULL COMMENT 'Waiting-Received-Checked-Done',
  `Created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `importCost` int(11) NOT NULL,
  `importChannel` varchar(255) NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `orderID` text NOT NULL,
  `orderLink` text NOT NULL COMMENT 'https://ban.sendo.vn/shop#salesorder/detail/12345678/orderID',
  `customerID` int(11) NOT NULL,
  `orderStatus` text NOT NULL COMMENT 'Create-Delay-Shipping-Received-Done-Refuse-Return-ReturnOK-Complain',
  `orderCreate` datetime NOT NULL,
  `orderUpdate` datetime NOT NULL,
  `orderAddress` text NOT NULL,
  `orderShip` text NOT NULL COMMENT '1:GHN 2:GHTK 3:Viettel ',
  `orderShipID` text NOT NULL,
  `orderShipLink` text NOT NULL,
  `orderVoucher` text NOT NULL,
  `orderCost` text NOT NULL COMMENT 'Tổng vốn cả đơn',
  `orderSell` text NOT NULL COMMENT 'Tổng bán',
  `orderNote` text NOT NULL,
  `orderChannel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`orderID`, `orderLink`, `customerID`, `orderStatus`, `orderCreate`, `orderUpdate`, `orderAddress`, `orderShip`, `orderShipID`, `orderShipLink`, `orderVoucher`, `orderCost`, `orderSell`, `orderNote`, `orderChannel`) VALUES
('1301', '', 11, 'created', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'da nang', 'GHN', 'GHNXX', '', '0', '', '', 'okk', 'Sendo'),
('1302', '', 11, 'waiting', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ddd', 'dd', 'dd', '', 'dd', '', '', '', 'sendo'),
('14248457552', '', 12, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_tb_product`
--

CREATE TABLE `order_tb_product` (
  `order_detail_ID` int(11) NOT NULL,
  `orderID` text NOT NULL,
  `producttypeID` text NOT NULL,
  `productID` text NOT NULL,
  `Amount` int(11) NOT NULL COMMENT 'số lượng',
  `productCost` int(11) NOT NULL,
  `productSell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tb_product`
--

INSERT INTO `order_tb_product` (`order_detail_ID`, `orderID`, `producttypeID`, `productID`, `Amount`, `productCost`, `productSell`) VALUES
(1, '1301', 'GDPS', 'GDPS01', 5, 0, 0),
(2, '1301', 'GDPS', 'GDPS02', 20, 0, 0),
(3, '1302', 'GDPS', 'GDPS02', 5, 0, 0),
(4, '1303', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` text CHARACTER SET utf8,
  `product_typeID` text,
  `importID` int(11) DEFAULT NULL,
  `productStatus` text,
  `productDes` text,
  `productImage` text,
  `productCost` text COMMENT 'Gía thật khi nhập về, ',
  `productSell` text COMMENT 'Gía bán ra thay đổi thường xuyên',
  `productNote` text,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `product_typeID`, `importID`, `productStatus`, `productDes`, `productImage`, `productCost`, `productSell`, `productNote`, `Created`, `Updated`) VALUES
(1, 'PHUN SUONG MEO XANH', 'GOM', 0, 'InStock', 'no', 'ok', '130', '150', '0', '2019-01-19 12:57:04', '2019-01-19 16:53:11'),
(2, 'phun suong meo xanh', 'GON', 0, 'xanh', 'xanh', 'xanh', '120', '120', '0', '2019-01-19 12:57:04', '2019-01-19 16:53:15'),
(3, NULL, 'GON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-19 12:57:04', '0000-00-00 00:00:00'),
(4, NULL, 'HTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-19 12:57:04', '0000-00-00 00:00:00'),
(5, NULL, 'GOL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-19 12:57:04', '2019-01-19 16:53:25'),
(6, NULL, 'GOC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-19 12:58:37', NULL),
(7, NULL, 'HTL', NULL, NULL, NULL, NULL, '50000', '70000', 'angular', '2019-01-20 05:32:14', NULL),
(8, NULL, 'GOL', NULL, NULL, NULL, NULL, '40000', '70000', 'angular2', '2019-01-20 05:33:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `product_typeID` text NOT NULL,
  `product_typeName` text CHARACTER SET utf8 NOT NULL,
  `categoryID` text NOT NULL,
  `product_typeCost` text NOT NULL COMMENT 'Chi phí mặc đinh nhập về',
  `product_typeSell` text NOT NULL COMMENT 'Chi phí mặc định bán ra',
  `product_typeNote` text NOT NULL,
  `product_typeStock` text NOT NULL,
  `product_typeIMG` text NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`product_typeID`, `product_typeName`, `categoryID`, `product_typeCost`, `product_typeSell`, `product_typeNote`, `product_typeStock`, `product_typeIMG`, `Created`, `Updated`) VALUES
('GOC', 'Gỗ Màu Lớn 25 Cm', 'DC', '60000', '90000', '11', '0', 'upload/HFDGSDS.jpg', '2019-01-19 09:18:48', NULL),
('GOL', 'Gỗ Lớn 25 Cm', 'DC', '40000', '70000', '123', '0', 'upload/sengo1.JPG', '2019-01-19 09:18:15', NULL),
('GOM', 'Gỗ Medium 22 Cm', 'DC', '40000', '60000', '2', '0', 'upload/adsfghj.jpg', '2019-01-19 09:17:39', NULL),
('GON', 'Gỗ Nhỏ', 'DC', '20000', '25000', '0', '0', 'upload/hjf.png', '2019-01-19 09:16:47', NULL),
('HTL', 'Hải Tặc Lớn', 'DC', '50000', '70000', 'First Item Ever', '0', 'upload/sfdg.jpg', '2019-01-19 09:14:57', '2019-01-19 09:15:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`(255));

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`importID`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`orderID`(255));

--
-- Indexes for table `order_tb_product`
--
ALTER TABLE `order_tb_product`
  ADD PRIMARY KEY (`order_detail_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`product_typeID`(255));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `importID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_tb_product`
--
ALTER TABLE `order_tb_product`
  MODIFY `order_detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
