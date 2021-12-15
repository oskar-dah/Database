-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 10:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

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

CREATE TABLE `boughtproducts` (
  `idBoughtProducts` int(11) NOT NULL,
  `products_idProduct` int(11) NOT NULL,
  `shipment_idShipment` int(11) NOT NULL,
  `priceAtPurchase` float NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boughtproducts`
--

INSERT INTO `boughtproducts` (`idBoughtProducts`, `products_idProduct`, `shipment_idShipment`, `priceAtPurchase`, `amount`) VALUES
(1, 13, 2, 222, 22),
(2, 14, 3, 250, 1),
(3, 14, 4, 250, 1),
(4, 15, 4, 5555, 1),
(5, 16, 5, 245242, 1),
(6, 14, 6, 250, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `forname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phoneNr` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idCustomer`, `username`, `password`, `forname`, `lastname`, `phoneNr`, `address`, `email`, `user_type`) VALUES
(2, 'tonytonfisk2', 'hejsan123', 'Tony', 'Tonytonfisk', '0733591437', 'Laboratorievägen 25', 'tonzha-9@student.ltu.se', 'U'),
(4, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `p_name` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idProduct`, `p_name`, `price`, `stock`, `category`) VALUES
(13, 'tv', 222, 0, 'screen'),
(14, 'Chips', 250, 246, 'food'),
(15, 'banan', 5555, 554, 'ffff'),
(16, '3334afa', 245242, 26261, 'asfsfa');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `customer_idCustomer` int(11) NOT NULL,
  `product_idProduct` int(11) NOT NULL,
  `comment` tinytext NOT NULL,
  `rating` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`customer_idCustomer`, `product_idProduct`, `comment`, `rating`, `reviewID`) VALUES
(2, 14, 'fafaf', 5, 145),
(2, 15, 'fgafafafafa', 5, 146);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `idShipment` int(11) NOT NULL,
  `customer_idCustomer` int(11) NOT NULL,
  `shippingAddr` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`idShipment`, `customer_idCustomer`, `shippingAddr`) VALUES
(2, 2, 'sss'),
(3, 2, 'rr'),
(4, 2, 'asda'),
(5, 2, '222'),
(6, 4, 'k');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `idCart` int(11) NOT NULL,
  `customer_idCustomer` int(11) NOT NULL,
  `product_idProduct` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boughtproducts`
--
ALTER TABLE `boughtproducts`
  ADD PRIMARY KEY (`idBoughtProducts`),
  ADD KEY `products_idProduct` (`products_idProduct`),
  ADD KEY `shipment_idShipment` (`shipment_idShipment`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `customer_idCustomer` (`customer_idCustomer`),
  ADD KEY `product_idProduct` (`product_idProduct`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`idShipment`),
  ADD KEY `customer_idCustomer` (`customer_idCustomer`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `product_idProduct` (`product_idProduct`),
  ADD KEY `customer_idCustomer` (`customer_idCustomer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boughtproducts`
--
ALTER TABLE `boughtproducts`
  MODIFY `idBoughtProducts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `idShipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
