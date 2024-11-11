-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 04:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosk`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `AdminId` varchar(20) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `adminName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`AdminId`, `UserId`, `adminName`) VALUES
('AD0001', 'U0001', 'Ng Cheng Ye');

-- --------------------------------------------------------

--
-- Table structure for table `dailymenu`
--

CREATE TABLE `dailymenu` (
  `DailyMenuId` varchar(20) NOT NULL,
  `MenuId` varchar(20) NOT NULL,
  `FoodVendorId` varchar(20) NOT NULL,
  `availabilityStatus` varchar(10) NOT NULL,
  `remainingQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foodvendor`
--

CREATE TABLE `foodvendor` (
  `FoodVendorId` varchar(20) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `foodVendorName` varchar(50) NOT NULL,
  `BusinessName` varchar(50) NOT NULL,
  `RegisterNo` varchar(50) NOT NULL,
  `foodVendorCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodvendor`
--

INSERT INTO `foodvendor` (`FoodVendorId`, `UserId`, `foodVendorName`, `BusinessName`, `RegisterNo`, `foodVendorCode`) VALUES
('FV0001', 'U0004', 'Alif Hakimi', 'Alif Nasi Lemak', '202201453257', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=FV001\">'),
('FV0002', 'U0006', 'Razak bin Osman', '', '', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=razak\">');

-- --------------------------------------------------------

--
-- Table structure for table `generaluser`
--

CREATE TABLE `generaluser` (
  `generalUserId` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generaluser`
--

INSERT INTO `generaluser` (`generalUserId`, `Email`) VALUES
('GU0001', 'josan@hotmail.com'),
('GU0002', 'meiling23@gmail.com'),
('GU0003', 'surlianyi@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kiosk`
--

CREATE TABLE `kiosk` (
  `KioskId` varchar(5) NOT NULL,
  `FoodVendorId` varchar(20) NOT NULL,
  `OperationStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membershipcard`
--

CREATE TABLE `membershipcard` (
  `MemberShipCardId` varchar(11) NOT NULL,
  `MemberPoint` int(11) NOT NULL,
  `Balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membershipcard`
--

INSERT INTO `membershipcard` (`MemberShipCardId`, `MemberPoint`, `Balance`) VALUES
('MP0001', 19, 30.5),
('MP0002', 0, 0),
('MP0003', 70, 15),
('MP0004', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MenuId` varchar(20) NOT NULL,
  `KioskId` int(5) NOT NULL,
  `DailyMenuId` varchar(20) NOT NULL,
  `MenuName` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderId` int(11) NOT NULL,
  `rUserId` varchar(255) NOT NULL,
  `generalUserId` varchar(255) NOT NULL,
  `MenuId` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Amount` double NOT NULL,
  `OrderStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `OrderLineId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `StoreOrderId` varchar(22) NOT NULL,
  `MenuId` varchar(11) NOT NULL,
  `quantityOrder` int(11) NOT NULL,
  `totalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `StoreOrderId` varchar(22) NOT NULL,
  `rUserId` varchar(20) NOT NULL,
  `generalUserId` varchar(20) NOT NULL,
  `PaymentMethod` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registereduser`
--

CREATE TABLE `registereduser` (
  `rUserId` varchar(20) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `MemberShipCardId` varchar(11) NOT NULL,
  `registeredName` varchar(50) NOT NULL,
  `registeredCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registereduser`
--

INSERT INTO `registereduser` (`rUserId`, `UserId`, `MemberShipCardId`, `registeredName`, `registeredCode`) VALUES
('RU0001', 'U0002', 'MP0001', 'Hamima Madona Binti Hussain', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=mima01\">'),
('RU0002', 'U0003', 'MP0002', 'Lim Chong Jie', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=chongjie\">'),
('RU0003', 'U0005', 'MP0003', 'Sanisvara', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Sanisvara\">'),
('RU0004', 'U0007', 'MP0004', 'Ahmad bin Hamidi', '<img src=\" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Hamidi22\">');

-- --------------------------------------------------------

--
-- Table structure for table `storeorder`
--

CREATE TABLE `storeorder` (
  `StoreOrderId` varchar(22) NOT NULL,
  `rUserId` varchar(255) NOT NULL,
  `generalUserId` varchar(255) NOT NULL,
  `FoodVendorId` varchar(20) NOT NULL,
  `MenuId` varchar(20) NOT NULL,
  `OrderDate` date NOT NULL,
  `TotalAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` varchar(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` varchar(15) NOT NULL,
  `status` varchar(50) NOT NULL,
  `profilePicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Username`, `Email`, `Password`, `UserType`, `status`, `profilePicture`) VALUES
('U0001', 'Admin1', 'Chengye12@gmail.com ', 'Admin001', 'Administrator', '', '../Picture/Admin1_profile1.jpeg'),
('U0002', 'mima01', 'Mima467@hotmail.com', 'Mima53302', 'Staff', '', '../Image/profile.jpg'),
('U0003', 'chongjie', 'CD20013@student.edu.umpsa.my', 'chongjie', 'Student', '', '../Picture/chongjie_profile picture.jpeg'),
('U0004', 'FV001', 'hakimi@gmail.com ', 'Alif7543', 'FoodVendor', 'Approve', '../Picture/U0004_profile1.jpeg'),
('U0005', 'Sanisvara', 'CA22005@student.umpsa.edu.my', 'Sanisvara1234', 'Student', '', '../Picture/U0005_profile picture.jpeg'),
('U0006', 'razak', 'razak13@gmail.com', 'razak123', 'FoodVendor', 'Pending', '../Picture/razak_images.png'),
('U0007', 'Hamidi22', 'hamidi123@hotmail.com', 'Ahmad3456', 'Staff', '', '../Picture/U0007_profile3.jpeg'),
('U0010', '3', '3', '3333333333', '', '', '../Image/profile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`AdminId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `dailymenu`
--
ALTER TABLE `dailymenu`
  ADD PRIMARY KEY (`DailyMenuId`),
  ADD KEY `MenuId` (`MenuId`),
  ADD KEY `FoodVendorId` (`FoodVendorId`);

--
-- Indexes for table `foodvendor`
--
ALTER TABLE `foodvendor`
  ADD PRIMARY KEY (`FoodVendorId`),
  ADD KEY `foodvendor_ibfk_1` (`UserId`);

--
-- Indexes for table `generaluser`
--
ALTER TABLE `generaluser`
  ADD PRIMARY KEY (`generalUserId`);

--
-- Indexes for table `kiosk`
--
ALTER TABLE `kiosk`
  ADD PRIMARY KEY (`KioskId`),
  ADD KEY `FoodVendorId` (`FoodVendorId`);

--
-- Indexes for table `membershipcard`
--
ALTER TABLE `membershipcard`
  ADD PRIMARY KEY (`MemberShipCardId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuId`),
  ADD KEY `KiosId` (`KioskId`),
  ADD KEY `DailyMenuId` (`DailyMenuId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `generalUserId` (`generalUserId`),
  ADD KEY `MenuId` (`MenuId`),
  ADD KEY `order_ibfk_3` (`rUserId`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`OrderLineId`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `MenuId` (`MenuId`),
  ADD KEY `StoreOrderId` (`StoreOrderId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentId`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `StoreOrderId` (`StoreOrderId`),
  ADD KEY `rUserId` (`rUserId`),
  ADD KEY `generalUserId` (`generalUserId`);

--
-- Indexes for table `registereduser`
--
ALTER TABLE `registereduser`
  ADD PRIMARY KEY (`rUserId`),
  ADD KEY `registereduser_ibfk_1` (`UserId`),
  ADD KEY `registereduser_ibfk_2` (`MemberShipCardId`);

--
-- Indexes for table `storeorder`
--
ALTER TABLE `storeorder`
  ADD PRIMARY KEY (`StoreOrderId`),
  ADD KEY `generalUserId` (`generalUserId`),
  ADD KEY `MenuId` (`MenuId`),
  ADD KEY `storeorder_ibfk_3` (`rUserId`),
  ADD KEY `FoodVendorId` (`FoodVendorId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `OrderLineId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `dailymenu`
--
ALTER TABLE `dailymenu`
  ADD CONSTRAINT `dailymenu_ibfk_1` FOREIGN KEY (`MenuId`) REFERENCES `menu` (`MenuId`),
  ADD CONSTRAINT `dailymenu_ibfk_2` FOREIGN KEY (`FoodVendorId`) REFERENCES `foodvendor` (`FoodVendorId`);

--
-- Constraints for table `foodvendor`
--
ALTER TABLE `foodvendor`
  ADD CONSTRAINT `foodvendor_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `kiosk`
--
ALTER TABLE `kiosk`
  ADD CONSTRAINT `kiosk_ibfk_1` FOREIGN KEY (`FoodVendorId`) REFERENCES `foodvendor` (`FoodVendorId`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`DailyMenuId`) REFERENCES `dailymenu` (`DailyMenuId`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`generalUserId`) REFERENCES `generaluser` (`generalUserId`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`MenuId`) REFERENCES `menu` (`MenuId`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`rUserId`) REFERENCES `registereduser` (`rUserId`);

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `order` (`OrderId`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`MenuId`) REFERENCES `menu` (`MenuId`),
  ADD CONSTRAINT `orderline_ibfk_3` FOREIGN KEY (`StoreOrderId`) REFERENCES `storeorder` (`StoreOrderId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `order` (`OrderId`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`StoreOrderId`) REFERENCES `storeorder` (`StoreOrderId`),
  ADD CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`generalUserId`) REFERENCES `generaluser` (`generalUserId`),
  ADD CONSTRAINT `payment_ibfk_5` FOREIGN KEY (`rUserId`) REFERENCES `registereduser` (`rUserId`);

--
-- Constraints for table `registereduser`
--
ALTER TABLE `registereduser`
  ADD CONSTRAINT `registereduser_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`),
  ADD CONSTRAINT `registereduser_ibfk_2` FOREIGN KEY (`MemberShipCardId`) REFERENCES `membershipcard` (`MemberShipCardId`);

--
-- Constraints for table `storeorder`
--
ALTER TABLE `storeorder`
  ADD CONSTRAINT `storeorder_ibfk_1` FOREIGN KEY (`generalUserId`) REFERENCES `generaluser` (`generalUserId`),
  ADD CONSTRAINT `storeorder_ibfk_2` FOREIGN KEY (`MenuId`) REFERENCES `menu` (`MenuId`),
  ADD CONSTRAINT `storeorder_ibfk_3` FOREIGN KEY (`rUserId`) REFERENCES `registereduser` (`rUserId`),
  ADD CONSTRAINT `storeorder_ibfk_4` FOREIGN KEY (`FoodVendorId`) REFERENCES `foodvendor` (`FoodVendorId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
