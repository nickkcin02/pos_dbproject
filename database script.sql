-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 11:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyhistory`
--

CREATE TABLE `buyhistory` (
  `purchaseID` int(11) NOT NULL,
  `timeOfPurchase` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staffID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `isArrived` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyhistory`
--

INSERT INTO `buyhistory` (`purchaseID`, `timeOfPurchase`, `staffID`, `supplierID`, `isArrived`) VALUES
(1, '2020-04-22 13:07:43', 1, 2, 1),
(2, '2020-05-04 04:17:48', 1, 5, 1),
(3, '2020-05-04 04:17:56', 1, 1, 1),
(4, '2020-05-08 14:14:01', 1, 1, 1),
(5, '2020-05-08 17:42:40', 1, 1, 1),
(6, '2020-05-08 18:01:33', 1, 6, 1),
(7, '2020-05-15 08:42:44', 1, 6, 1),
(8, '2020-05-08 14:14:07', 1, 6, 1),
(9, '2020-05-15 08:42:47', 1, 1, 1),
(10, '2020-04-22 13:25:06', 1, 1, 1),
(11, '2020-04-22 13:27:34', 1, 1, 1),
(12, '2020-04-22 13:28:10', 1, 1, 1),
(13, '2020-05-04 04:17:52', 1, 5, 1),
(14, '2020-05-04 06:53:05', 1, 6, 1),
(15, '2020-05-08 13:55:02', 1, 1, 1),
(16, '2020-05-09 12:53:36', 1, 1, 1),
(17, '2020-05-09 12:53:32', 1, 1, 1),
(18, '2020-05-15 08:42:49', 1, 5, 1),
(19, '2020-05-16 08:26:22', 1, 1, 1),
(21, '2020-05-16 09:22:09', 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buyingredient`
--

CREATE TABLE `buyingredient` (
  `purchaseID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyingredient`
--

INSERT INTO `buyingredient` (`purchaseID`, `ingredientID`, `amount`) VALUES
(1, 7, 2),
(1, 13, 2),
(2, 8, 7),
(2, 9, 3),
(2, 14, 2),
(2, 16, 1),
(3, 15, 7),
(4, 15, 10),
(5, 15, 6),
(6, 4, 4),
(6, 5, 1),
(6, 20, 2),
(6, 21, 3),
(6, 22, 3),
(7, 1, 10),
(8, 2, 6),
(9, 15, 5),
(10, 17, 5),
(11, 17, 2),
(12, 17, 4),
(13, 9, 26),
(13, 16, 25),
(14, 20, 28),
(15, 15, 5),
(16, 17, 6),
(17, 17, 10),
(18, 16, 3),
(19, 15, 10),
(20, 36, 10),
(21, 37, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cost_per_menu`
-- (See below for the actual view)
--
CREATE TABLE `cost_per_menu` (
`menuID` int(11)
,`size` varchar(2)
,`cost` double
);

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE `customertype` (
  `customerTypeID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customertype`
--

INSERT INTO `customertype` (`customerTypeID`, `Name`) VALUES
(1, 'Family'),
(2, 'Friends'),
(3, 'Colleagues');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discountID` int(11) NOT NULL,
  `discountName` varchar(20) NOT NULL,
  `totalPrice` float NOT NULL,
  `method` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discountID`, `discountName`, `totalPrice`, `method`, `amount`, `startTime`, `endTime`) VALUES
(9, '10 % ', 500, '%', 10, '2020-05-15', '2020-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `foodorder`
--

CREATE TABLE `foodorder` (
  `orderID` int(11) NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `paidTime` timestamp NULL DEFAULT NULL,
  `orderSeats` int(11) NOT NULL,
  `discountID` int(11) DEFAULT NULL,
  `staffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodorder`
--

INSERT INTO `foodorder` (`orderID`, `orderTime`, `paidTime`, `orderSeats`, `discountID`, `staffID`) VALUES
(33, '2020-05-15 08:46:51', '2020-05-15 08:46:51', 3, NULL, 1),
(34, '2020-05-16 08:24:43', '2020-05-16 08:24:43', 1, 9, 1),
(35, '2020-05-16 08:40:12', '2020-05-16 08:40:12', 2, NULL, 4),
(36, '2020-05-16 09:20:12', '2020-05-16 09:20:12', 2, 9, 1),
(37, '2020-05-16 09:19:02', NULL, 3, NULL, 1),
(38, '2020-05-16 09:53:13', '2020-05-16 09:53:13', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredientID` int(11) NOT NULL,
  `ingredientName` varchar(20) NOT NULL,
  `ingredientStock` int(11) NOT NULL,
  `ingredientCostPerUnit` float NOT NULL,
  `supplierID` int(11) NOT NULL DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `ingredientName`, `ingredientStock`, `ingredientCostPerUnit`, `supplierID`) VALUES
(1, 'Coffee Powder', 214, 10, 6),
(2, 'Frappe Sauce', 100, 10, 6),
(3, 'Chocolate Sauce', 100, 10, 6),
(4, 'Soda', 50, 12, 6),
(5, 'Super Berries Syrup', 100, 5, 6),
(6, 'Ice Cream', 95, 35, 6),
(7, 'Sliced Bacon', 24, 20, 2),
(8, 'Cheese', 22, 30, 5),
(9, 'Vegetables', 265, 20, 5),
(10, 'Argentine Ribeye', 4, 400, 2),
(11, 'Capellini', 30, 70, 6),
(12, 'Eggs', 50, 5, 5),
(13, 'Smoked Loin', 20, 350, 2),
(14, 'Rice', 100, 100, 5),
(15, 'Stingray Fin', 115, 200, 1),
(16, 'Mayonnaise', 53, 150, 5),
(17, 'Smoked Halibut', 10, 300, 1),
(18, 'Milk', 100, 18, 5),
(19, 'Butter Croissant', 98, 40, 6),
(20, 'Berry Crumble ChCake', 20, 100, 6),
(21, 'RaspberryDonut', 50, 30, 6),
(22, 'Red Velvet Cake', 20, 100, 6),
(23, 'Opera Layer Cake', 20, 100, 6),
(37, 'A', 10, 10, 12);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ingredient_time`
-- (See below for the actual view)
--
CREATE TABLE `ingredient_time` (
`ingredientName` varchar(20)
,`ingredientStock` int(11)
,`ingredientCostPerUnit` float
,`time` timestamp
,`isArrived` int(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(30) NOT NULL,
  `typeName` varchar(30) NOT NULL,
  `menuPicture` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuName`, `typeName`, `menuPicture`) VALUES
(1, 'Hot Americano', 'Coffee', 0x2e2e2f696d672f6d3879575672304d48322e6a7067),
(2, 'Affogato', 'Coffee', 0x2e2e2f696d672f63613934316430343161336430626365636232326534373035653539646333312e6a7067),
(3, 'Iced Mocha Latte', 'Coffee', 0x2e2e2f696d672f646f776e6c6f61642e6a7067),
(4, 'Iced Chocolate', 'Tea & Chocolate', 0x2e2e2f696d672f696365642d63686f636f6c6174652e6a7067),
(5, 'Super Berries Soda', 'Refreshing Drinks', 0x2e2e2f696d672f6d697865642d62657272792d736f64612e6a7067),
(6, 'Butter Croissant', 'Cakes', 0x2e2e2f696d672f646f776e6c6f6164202831292e6a7067),
(7, 'Berry Crumble Cheesecake', 'Cakes', 0x2e2e2f696d672f426c756562657272792d43686565736563616b652d4372756d622d43616b652d312e6a7067),
(8, 'Raspberry Filled Mini Donut', 'Cakes', 0x2e2e2f696d672f38353635653766373338353636393439316638313962646666613833346561382e6a7067),
(9, 'Opera Layer Cake', 'Cakes', 0x2e2e2f696d672f6d617872657364656661756c742e6a7067),
(10, 'Red Velvet Cake', 'Cakes', 0x2e2e2f696d672f5265642d56656c7665742d43616b652d494d4147452d34332e6a7067),
(11, 'Koffie House Caesar Salad', 'Salads', 0x2e2e2f696d672f646f776e6c6f6164202832292e6a7067),
(12, 'Argentine Ribeye Steak', 'From the Grill', 0x2e2e2f696d672f7269626579652d737465616b2d776974682d7265642d77696e652d73617563652d332d313230302e6a7067),
(13, 'Classic Capellini Carbonara', 'Pastas', 0x2e2e2f696d672f70617374612d636172626f6e6172612d766572746963616c2d612d313230302e6a7067),
(14, 'Koffie House Fried Rice', 'Rice', 0x2e2e2f696d672f46726965642d526963652d4669667465656e2d53706174756c61732d382e6a7067),
(15, 'Eihire (Stingray Fin)', 'Appetizers', 0x2e2e2f696d672f36313069535657692b4f4c2e5f534c313030305f2e6a7067),
(36, 'AAAA', 'Cakes', 0x2e2e2f696d672f39363734393633335f333834323037323335323530303637325f333932333530323536323438303735303539325f6e2e6a7067);

-- --------------------------------------------------------

--
-- Stand-in structure for view `menucost`
-- (See below for the actual view)
--
CREATE TABLE `menucost` (
`menuID` int(11)
,`menu` varchar(30)
,`costS` double
,`costM` double
,`costL` double
);

-- --------------------------------------------------------

--
-- Table structure for table `menuorder`
--

CREATE TABLE `menuorder` (
  `menuOrderID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `size` varchar(2) NOT NULL,
  `amount` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menuorder`
--

INSERT INTO `menuorder` (`menuOrderID`, `orderID`, `menuID`, `size`, `amount`, `isDone`) VALUES
(1, 33, 1, 'NA', 1, 1),
(1, 33, 2, 'NA', 1, 1),
(1, 34, 11, 'M', 2, 1),
(1, 35, 1, 'NA', 2, 1),
(1, 36, 1, 'NA', 2, 1),
(1, 36, 2, 'NA', 2, 1),
(1, 37, 1, 'NA', 3, 1),
(1, 38, 1, 'NA', 2, 1),
(3, 36, 12, 'L', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menustock`
--

CREATE TABLE `menustock` (
  `menuID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menustock`
--

INSERT INTO `menustock` (`menuID`, `ingredientID`, `amount`) VALUES
(1, 1, 2),
(2, 1, 2),
(2, 6, 1),
(3, 1, 2),
(3, 2, 2),
(3, 3, 1),
(3, 18, 1),
(4, 3, 1),
(4, 18, 2),
(5, 4, 1),
(5, 5, 2),
(6, 19, 1),
(7, 20, 1),
(8, 21, 1),
(9, 23, 1),
(10, 22, 1),
(11, 7, 1),
(11, 8, 1),
(11, 9, 1),
(12, 8, 1),
(12, 9, 1),
(12, 10, 1),
(13, 8, 2),
(13, 11, 1),
(13, 12, 1),
(14, 9, 0.01),
(14, 12, 1),
(14, 13, 1),
(14, 14, 1),
(15, 15, 1),
(15, 16, 2),
(36, 37, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu_promotion`
-- (See below for the actual view)
--
CREATE TABLE `menu_promotion` (
`ID` int(11)
,`size` varchar(2)
,`price` float
,`name` varchar(30)
,`type` varchar(30)
,`pic` longblob
,`promotion` varchar(20)
,`method` varchar(20)
,`amount` float
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_paid`
-- (See below for the actual view)
--
CREATE TABLE `order_paid` (
`orderID` int(11)
,`menuOrderID` int(11)
,`menuID` int(11)
,`menuName` varchar(30)
,`size` varchar(2)
,`price` float
,`amount` int(11)
,`promotionName` varchar(20)
,`price_dis` double
);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `menuID` int(11) NOT NULL,
  `size` varchar(2) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`menuID`, `size`, `price`) VALUES
(1, 'NA', 70),
(2, 'NA', 110),
(3, 'NA', 100),
(4, 'NA', 85),
(5, 'NA', 75),
(6, 'NA', 60),
(7, 'NA', 135),
(8, 'NA', 40),
(9, 'NA', 120),
(10, 'NA', 130),
(11, 'L', 420),
(11, 'M', 290),
(12, 'L', 1200),
(12, 'M', 850),
(13, 'L', 350),
(13, 'M', 290),
(14, 'L', 400),
(14, 'S', 190),
(15, 'M', 380),
(15, 'S', 170),
(36, 'L', 40),
(36, 'M', 30),
(36, 'S', 20);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotionID` int(11) NOT NULL,
  `promotionName` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotionID`, `promotionName`, `method`, `amount`) VALUES
(1, '5 Baht Discount', 'Baht', 5),
(2, '10 Baht Discount', 'Baht', 10),
(3, 'Buy 1 Get 1 Free', '%', 50),
(4, 'Buy 2 Get 1 Free', '%', 33.3),
(5, '10% Discount', '%', 10),
(6, '15 Baht 4 U', 'Baht', 15),
(7, '10 Baht', 'Baht', 10),
(8, 'aaa discount 10 % ', '%', 10);

-- --------------------------------------------------------

--
-- Table structure for table `promotionhistory`
--

CREATE TABLE `promotionhistory` (
  `menuID` int(11) NOT NULL,
  `size` varchar(2) NOT NULL,
  `promotionID` int(11) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotionhistory`
--

INSERT INTO `promotionhistory` (`menuID`, `size`, `promotionID`, `startTime`, `endTime`) VALUES
(1, 'NA', 7, '2020-05-16', '2020-05-23'),
(36, 'L', 8, '2020-05-16', '2020-05-23');

-- --------------------------------------------------------

--
-- Stand-in structure for view `promo_price`
-- (See below for the actual view)
--
CREATE TABLE `promo_price` (
`menuID` int(11)
,`size` varchar(2)
,`baseprice` float
,`price` double
,`promotionName` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `reservationName` varchar(30) NOT NULL,
  `reservationSeats` int(11) NOT NULL,
  `customerTypeID` int(11) NOT NULL,
  `isWalkin` int(1) NOT NULL,
  `tableID` int(11) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `orderID` int(11) DEFAULT NULL,
  `staffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `reservationName`, `reservationSeats`, `customerTypeID`, `isWalkin`, `tableID`, `time`, `orderID`, `staffID`) VALUES
(21, 'test', 3, 1, 1, 2, '2020-05-15 15:40:24', 33, 1),
(22, 'test2', 1, 1, 1, 1, '2020-05-15 15:43:14', 34, 1),
(23, 'test', 2, 1, 1, 1, '2020-05-16 15:33:46', 35, 4),
(24, 'test5', 2, 1, 0, 12, '2020-05-22 04:25:00', 36, 1),
(25, 'AAA', 3, 2, 1, 5, '2020-05-16 16:14:40', 38, 1),
(26, 'test', 3, 1, 0, 2, '2020-05-16 16:17:00', 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `staffAddress` text NOT NULL,
  `subdistrict` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `staffPhone` varchar(10) NOT NULL,
  `staffEmail` varchar(30) NOT NULL,
  `staffPosition` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `lName`, `gender`, `staffAddress`, `subdistrict`, `district`, `province`, `zip`, `staffPhone`, `staffEmail`, `staffPosition`, `user_id`) VALUES
(1, 'Buris', 'Punnahitananda', 'M', '123', 'Apple', 'orange', 'Bangkok', '10140', '0811111111', 'Manager@koffiehouse.com', 'Manager', 1),
(2, 'Poomphob', ' Suwannapichat', 'M', '812', 'Bangna', 'Bangna', 'Bangkok', '10111', '082222222', 'Cashier@koffiehouse.com', 'Cashier', 2),
(3, 'Punnawich', 'Silpkitcharoen', 'M', '', '', '', '', '', '083333333', 'Waiter@koffiehouse.com', 'Waiter', 3),
(4, 'Yodsakorn', 'Nunpan', 'M', '', '', '', '', '', '084444444', 'Smanager@koffiehouse.com', 'Storage Manager', 4),
(11, 'test', 'test', 'M', 'test', 'test', 'test', 'test', '55555', '2222', 'test@test.com', 'Cashier', 8),
(12, 'aa', 'aa', 'M', 'aa', 'aa', 'aa', 'aa', '88888', '56644', 'aa@aa.com', 'Manager', 9);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(50) NOT NULL,
  `supplierAddress` text NOT NULL,
  `subdistrict` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `supplierEmail` varchar(30) NOT NULL,
  `contactSale` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `supplierAddress`, `subdistrict`, `district`, `province`, `zip`, `phoneNumber`, `supplierEmail`, `contactSale`) VALUES
(1, 'Asian Seafood Co., Ltd.', '123', 'Bangna', '111', 'Bangkok', '10140', '027777777', 'contact@asianseafood.com', 'Somchai Seafood'),
(2, 'Bangkok Sausage and Ham Co,. Ltd.', '442 Charoen Krung Road', 'Charoen Krung', 'Sathon', 'Bangkok', '10111', '057473848', 'contact@bkksandm.com', 'Sam Smith'),
(5, 'Oh Veggies Co,.Ltd.', '1555 Wonder Road', 'Bangmod', 'Orange County', 'NY', '8888', '0841384646', 'contact@ohveggies.com', 'John Wick'),
(6, 'Everything Edible Co,. Ltd.', '145/99 ', 'Orange', 'Apple', 'Bangkok', '44112', '084132415', 'contact@everythingtoeat.com', 'Reinhart Schmidt'),
(12, 'get A ', 'sss', 'aa', 'aa', 'aa', '5555', '11111', 'aaa@aaa.com', 'aaa');

-- --------------------------------------------------------

--
-- Stand-in structure for view `supply_request_status`
-- (See below for the actual view)
--
CREATE TABLE `supply_request_status` (
`time` timestamp
,`staff` varchar(50)
,`purchaseID` int(11)
,`supplier` varchar(50)
,`isArrived` int(1)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `tabledetail`
--

CREATE TABLE `tabledetail` (
  `tableID` int(11) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabledetail`
--

INSERT INTO `tabledetail` (`tableID`, `seats`) VALUES
(1, 2),
(2, 4),
(3, 4),
(4, 4),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 2),
(13, 4),
(14, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `table_available`
-- (See below for the actual view)
--
CREATE TABLE `table_available` (
`tableID` int(11)
,`seats` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'test2', '098f6bcd4621d373cade4e832627b4f6'),
(3, 'test3', '098f6bcd4621d373cade4e832627b4f6'),
(4, 'test4', '098f6bcd4621d373cade4e832627b4f6'),
(8, 'ntest', '098f6bcd4621d373cade4e832627b4f6'),
(9, 'aa', '4124bc0a9335c27f086f24ba207a4912');

-- --------------------------------------------------------

--
-- Structure for view `cost_per_menu`
--
DROP TABLE IF EXISTS `cost_per_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cost_per_menu`  AS  (select `p`.`menuID` AS `menuID`,`p`.`size` AS `size`,sum(if(`p`.`size` = 'M',2 * `ms`.`amount` * `i`.`ingredientCostPerUnit`,if(`p`.`size` = 'L',3 * `ms`.`amount` * `i`.`ingredientCostPerUnit`,`ms`.`amount` * `i`.`ingredientCostPerUnit`))) AS `cost` from (((`price` `p` join `ingredient` `i`) join `menu` `m`) join `menustock` `ms`) where `p`.`menuID` = `m`.`menuID` and `ms`.`menuID` = `p`.`menuID` and `ms`.`ingredientID` = `i`.`ingredientID` group by `p`.`menuID`,`p`.`size`) ;

-- --------------------------------------------------------

--
-- Structure for view `ingredient_time`
--
DROP TABLE IF EXISTS `ingredient_time`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ingredient_time`  AS  (select `i`.`ingredientName` AS `ingredientName`,`i`.`ingredientStock` AS `ingredientStock`,`i`.`ingredientCostPerUnit` AS `ingredientCostPerUnit`,`tb`.`time` AS `time`,`tb`.`isArrived` AS `isArrived` from (`ingredient` `i` left join (select `bi`.`ingredientID` AS `id`,min(`bh`.`isArrived`) AS `isArrived`,max(`bh`.`timeOfPurchase`) AS `time` from (`buyingredient` `bi` join `buyhistory` `bh`) where `bi`.`purchaseID` = `bh`.`purchaseID` group by `bi`.`ingredientID`) `tb` on(`i`.`ingredientID` = `tb`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `menucost`
--
DROP TABLE IF EXISTS `menucost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menucost`  AS  select `m`.`menuID` AS `menuID`,`m`.`menuName` AS `menu`,sum(`i`.`ingredientCostPerUnit` * `ms`.`amount`) AS `costS`,sum(`i`.`ingredientCostPerUnit` * `ms`.`amount`) * 2 AS `costM`,sum(`i`.`ingredientCostPerUnit` * `ms`.`amount`) * 3 AS `costL` from ((`menu` `m` join `menustock` `ms`) join `ingredient` `i`) where `m`.`menuID` = `ms`.`menuID` and `ms`.`ingredientID` = `i`.`ingredientID` group by `m`.`menuName` order by `m`.`menuID` ;

-- --------------------------------------------------------

--
-- Structure for view `menu_promotion`
--
DROP TABLE IF EXISTS `menu_promotion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_promotion`  AS  select `price`.`menuID` AS `ID`,`price`.`size` AS `size`,`price`.`price` AS `price`,`price`.`name` AS `name`,`price`.`type` AS `type`,`price`.`pic` AS `pic`,`promo`.`promotionName` AS `promotion`,`promo`.`method` AS `method`,`promo`.`amount` AS `amount` from ((select `m`.`menuPicture` AS `pic`,`m`.`menuID` AS `menuID`,`m`.`menuName` AS `name`,`m`.`typeName` AS `type`,`p`.`size` AS `size`,`p`.`price` AS `price` from (`menu` `m` join `price` `p`) where `m`.`menuID` = `p`.`menuID`) `price` left join (select `ph`.`menuID` AS `menuID`,`ph`.`size` AS `size`,`p`.`promotionName` AS `promotionName`,`p`.`method` AS `method`,`p`.`amount` AS `amount` from (`promotionhistory` `ph` join `promotion` `p`) where `ph`.`startTime` <= curdate() and `ph`.`endTime` >= curdate() and `ph`.`promotionID` = `p`.`promotionID`) `promo` on(`price`.`menuID` = `promo`.`menuID` and `price`.`size` = `promo`.`size`)) ;

-- --------------------------------------------------------

--
-- Structure for view `order_paid`
--
DROP TABLE IF EXISTS `order_paid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_paid`  AS  (select `food`.`orderID` AS `orderID`,`food`.`menuOrderID` AS `menuOrderID`,`food`.`menuID` AS `menuID`,`food`.`menuName` AS `menuName`,`food`.`size` AS `size`,`food`.`price` AS `price`,`food`.`amount` AS `amount`,`promo`.`promotionName` AS `promotionName`,if(`promo`.`promotionName` is not null,if(`promo`.`method` = '%',`food`.`price` * (100 - `promo`.`amount`) / 100,`food`.`price` - `promo`.`amount`),`food`.`price`) AS `price_dis` from ((select `mo`.`orderID` AS `orderID`,`mo`.`menuID` AS `menuID`,`mo`.`size` AS `size`,`mo`.`amount` AS `amount`,`mo`.`menuOrderID` AS `menuOrderID`,`p`.`price` AS `price`,`fo`.`orderTime` AS `orderTime`,`m`.`menuName` AS `menuName` from (((`price` `p` join `menuorder` `mo`) join `foodorder` `fo`) join `menu` `m`) where `p`.`menuID` = `mo`.`menuID` and `p`.`size` = `mo`.`size` and `fo`.`orderID` = `mo`.`orderID` and `m`.`menuID` = `mo`.`menuID`) `food` left join (select `ph`.`menuID` AS `menuID`,`ph`.`size` AS `size`,`ph`.`startTime` AS `startTime`,`ph`.`endTime` AS `endTime`,`p`.`method` AS `method`,`p`.`amount` AS `amount`,`p`.`promotionName` AS `promotionName` from (`promotionhistory` `ph` join `promotion` `p`) where `p`.`promotionID` = `ph`.`promotionID`) `promo` on(`promo`.`menuID` = `food`.`menuID` and `promo`.`size` = `food`.`size` and `food`.`orderTime` > `promo`.`startTime` and `food`.`orderTime` < `promo`.`endTime`))) ;

-- --------------------------------------------------------

--
-- Structure for view `promo_price`
--
DROP TABLE IF EXISTS `promo_price`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `promo_price`  AS  select `pr`.`menuID` AS `menuID`,`pr`.`size` AS `size`,`pr`.`price` AS `baseprice`,case when (`ph`.`promotionID` is not null and curdate() between `ph`.`startTime` and `ph`.`endTime`) then case when `p`.`method` = 'Baht' then `pr`.`price` - `p`.`amount` when `p`.`method` = '%' then `pr`.`price` * (100 - `p`.`amount`) / 100 end else `pr`.`price` end AS `price`,`p`.`promotionName` AS `promotionName` from (((`price` `pr` left join `promotionhistory` `ph` on(`pr`.`menuID` = `ph`.`menuID` and `pr`.`size` = `ph`.`size`)) left join `promotion` `p` on(`p`.`promotionID` = `ph`.`promotionID` and curdate() between `ph`.`startTime` and `ph`.`endTime`)) join `menu` `m`) where `m`.`menuID` = `pr`.`menuID` ;

-- --------------------------------------------------------

--
-- Structure for view `supply_request_status`
--
DROP TABLE IF EXISTS `supply_request_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supply_request_status`  AS  select `b`.`timeOfPurchase` AS `time`,`st`.`staffName` AS `staff`,`bi`.`purchaseID` AS `purchaseID`,`sp`.`supplierName` AS `supplier`,`b`.`isArrived` AS `isArrived`,sum(`bi`.`amount` * `i`.`ingredientCostPerUnit`) AS `total` from ((((`buyhistory` `b` join `staff` `st`) join `supplier` `sp`) join `buyingredient` `bi`) join `ingredient` `i`) where `sp`.`supplierID` = `b`.`supplierID` and `b`.`staffID` = `st`.`staffID` and `bi`.`purchaseID` = `b`.`purchaseID` and `i`.`ingredientID` = `bi`.`ingredientID` group by `bi`.`purchaseID` ;

-- --------------------------------------------------------

--
-- Structure for view `table_available`
--
DROP TABLE IF EXISTS `table_available`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_available`  AS  (select `tabledetail`.`tableID` AS `tableID`,`tabledetail`.`seats` AS `seats` from `tabledetail` where !(`tabledetail`.`tableID` in (select `r`.`tableID` from (`reservation` `r` left join (select `foodorder`.`orderID` AS `orderID`,`foodorder`.`paidTime` AS `paidTime` from `foodorder`) `fo` on(`fo`.`orderID` = `r`.`orderID`)) where (`fo`.`paidTime` is null or `r`.`orderID` is null) and `r`.`tableID` is not null))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyhistory`
--
ALTER TABLE `buyhistory`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `staff_buyHis` (`staffID`),
  ADD KEY `supplier_buyHis` (`supplierID`);

--
-- Indexes for table `buyingredient`
--
ALTER TABLE `buyingredient`
  ADD PRIMARY KEY (`purchaseID`,`ingredientID`),
  ADD KEY `ingredient_buyIng` (`ingredientID`);

--
-- Indexes for table `customertype`
--
ALTER TABLE `customertype`
  ADD PRIMARY KEY (`customerTypeID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discountID`);

--
-- Indexes for table `foodorder`
--
ALTER TABLE `foodorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `discount_order` (`discountID`),
  ADD KEY `staff_order` (`staffID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`),
  ADD KEY `supplierID_ingredient` (`supplierID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `menuorder`
--
ALTER TABLE `menuorder`
  ADD PRIMARY KEY (`menuOrderID`,`orderID`,`menuID`,`size`),
  ADD KEY `menu_price` (`menuID`,`size`),
  ADD KEY `menuOrder_ibfk_1` (`orderID`);

--
-- Indexes for table `menustock`
--
ALTER TABLE `menustock`
  ADD PRIMARY KEY (`menuID`,`ingredientID`),
  ADD KEY `ingredient_menuStock` (`ingredientID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`menuID`,`size`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotionID`);

--
-- Indexes for table `promotionhistory`
--
ALTER TABLE `promotionhistory`
  ADD PRIMARY KEY (`menuID`,`size`,`promotionID`,`startTime`),
  ADD KEY `promotion_Hist` (`promotionID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `reservation_table` (`tableID`),
  ADD KEY `reservetion_order` (`orderID`),
  ADD KEY `reservetion_staff` (`staffID`),
  ADD KEY `customerTypeID` (`customerTypeID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `tabledetail`
--
ALTER TABLE `tabledetail`
  ADD PRIMARY KEY (`tableID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyhistory`
--
ALTER TABLE `buyhistory`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
  MODIFY `customerTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `foodorder`
--
ALTER TABLE `foodorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyhistory`
--
ALTER TABLE `buyhistory`
  ADD CONSTRAINT `staff_buyHis` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supplier_buyHis` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buyingredient`
--
ALTER TABLE `buyingredient`
  ADD CONSTRAINT `ingredient_buyIng` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase_buyIng` FOREIGN KEY (`purchaseID`) REFERENCES `buyhistory` (`purchaseID`);

--
-- Constraints for table `foodorder`
--
ALTER TABLE `foodorder`
  ADD CONSTRAINT `discount_order` FOREIGN KEY (`discountID`) REFERENCES `discount` (`discountID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `staff_order` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `supplierID_ingredient` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `menuorder`
--
ALTER TABLE `menuorder`
  ADD CONSTRAINT `menuOrder_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `foodorder` (`orderID`),
  ADD CONSTRAINT `menu_price` FOREIGN KEY (`menuID`,`size`) REFERENCES `price` (`menuID`, `size`) ON DELETE NO ACTION;

--
-- Constraints for table `menustock`
--
ALTER TABLE `menustock`
  ADD CONSTRAINT `ingredient_menuStock` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_menuStock` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`) ON DELETE CASCADE;

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotionhistory`
--
ALTER TABLE `promotionhistory`
  ADD CONSTRAINT `promotion_Hist` FOREIGN KEY (`promotionID`) REFERENCES `promotion` (`promotionID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `promotion_size` FOREIGN KEY (`menuID`,`size`) REFERENCES `price` (`menuID`, `size`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customerTypeID`) REFERENCES `customertype` (`customerTypeID`),
  ADD CONSTRAINT `reservation_table` FOREIGN KEY (`tableID`) REFERENCES `tabledetail` (`tableID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservetion_order` FOREIGN KEY (`orderID`) REFERENCES `foodorder` (`orderID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservetion_staff` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
