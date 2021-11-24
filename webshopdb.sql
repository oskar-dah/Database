-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2021 at 01:09 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `boughtproducts`
--

DROP TABLE IF EXISTS `boughtproducts`;
CREATE TABLE IF NOT EXISTS `boughtproducts` (
  `idBoughtProducts` int(11) NOT NULL AUTO_INCREMENT,
  `products_idProduct` int(11) NOT NULL,
  `shipment_idShipment` int(11) NOT NULL,
  `priceAtPurchase` float NOT NULL,
  PRIMARY KEY (`idBoughtProducts`),
  KEY `products_idProduct` (`products_idProduct`),
  KEY `shipment_idShipment` (`shipment_idShipment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `forname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `phoneNr` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCustomer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `username`, `password`, `forname`, `lastname`, `phoneNr`, `address`, `email`) VALUES
(1, 'pi', 'pi', NULL, NULL, NULL, NULL, NULL),
(2, 'bob', 'bob', 'bob', 'Andersson', '070-0872456', 'gatan 34', 'bob@bob.se');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idProduct`, `p_name`, `price`, `stock`, `category`) VALUES
(8, 'tv', 20, 250, 'Screen'),
(9, 'tv', 20, 20, 'Screen'),
(10, 'Pineapple', 20, 5, 'Fruit'),
(11, 'Banana', 25, 5, 'Fruit'),
(13, 'Samsung 24\"', 2495, 16, 'Screen');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `customer_idCustomer` int(11) NOT NULL,
  `product_idProduct` int(11) NOT NULL,
  `comment` tinytext NOT NULL,
  `rating` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`reviewID`),
  KEY `customer_idCustomer` (`customer_idCustomer`),
  KEY `product_idProduct` (`product_idProduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
CREATE TABLE IF NOT EXISTS `shipment` (
  `idShipment` int(11) NOT NULL AUTO_INCREMENT,
  `customer_idCustomer` int(11) NOT NULL,
  `shippingAddr` varchar(45) NOT NULL,
  PRIMARY KEY (`idShipment`),
  KEY `customer_idCustomer` (`customer_idCustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `idCart` int(11) NOT NULL AUTO_INCREMENT,
  `customer_idCustomer` int(11) NOT NULL,
  `product_idProduct` int(11) NOT NULL,
  `shippingAddr` varchar(45) NOT NULL,
  PRIMARY KEY (`idCart`),
  KEY `product_idProduct` (`product_idProduct`),
  KEY `customer_idCustomer` (`customer_idCustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boughtproducts`
--
ALTER TABLE `boughtproducts`
  ADD CONSTRAINT `boughtproducts_ibfk_1` FOREIGN KEY (`products_idProduct`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `boughtproducts_ibfk_2` FOREIGN KEY (`shipment_idShipment`) REFERENCES `shipment` (`idShipment`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_idProduct`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_idCustomer`) REFERENCES `customer` (`idCustomer`);

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`customer_idCustomer`) REFERENCES `customer` (`idCustomer`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`customer_idCustomer`) REFERENCES `customer` (`idCustomer`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_idProduct`) REFERENCES `products` (`idProduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
