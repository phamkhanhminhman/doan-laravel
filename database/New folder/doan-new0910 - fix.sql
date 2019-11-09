-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2019 lúc 05:44 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variation`
--

CREATE TABLE `product_variation` (
  `productVariationID` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `productShopeeID` varchar(50) DEFAULT NULL,
  `productName` text CHARACTER SET utf8 DEFAULT NULL,
  `categoryName` text CHARACTER SET utf8 DEFAULT NULL,
  `productLink` text DEFAULT NULL,
  `productPrice` text DEFAULT NULL,
  `productPriceShopee` int(11) DEFAULT NULL,
  `productStatusName` text CHARACTER SET utf8 DEFAULT NULL,
  `promotionPrice` text DEFAULT NULL,
  `promotionPriceShopee` int(11) DEFAULT NULL,
  `stockQuantity` text DEFAULT NULL,
  `productSKU` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `urlPath` text DEFAULT NULL,
  `finalPriceMin` text DEFAULT NULL,
  `finalPriceMax` text DEFAULT NULL,
  `product_typeID` text DEFAULT NULL,
  `importID` int(11) DEFAULT NULL,
  `productStatus` text DEFAULT NULL COMMENT 'instock,shipping,done',
  `productDes` text DEFAULT NULL,
  `productImage` text DEFAULT NULL,
  `productCost` text DEFAULT NULL COMMENT 'Gía thật khi nhập về, ',
  `productSell` text DEFAULT NULL COMMENT 'Gía bán ra thay đổi thường xuyên',
  `productNote` text DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
