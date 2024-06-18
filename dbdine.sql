-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 08:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdine`
--

-- --------------------------------------------------------

--
-- Table structure for table `canceled`
--

CREATE TABLE `canceled` (
  `Order_ID` int(10) NOT NULL,
  `Date_Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Restaurant_ID` int(10) NOT NULL,
  `Customer_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(10) NOT NULL,
  `First Name` varchar(30) DEFAULT NULL,
  `Last Name` varchar(30) DEFAULT NULL,
  `user name` varchar(50) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `First Name`, `Last Name`, `user name`, `password`, `Phone`, `Email`, `Address`, `Gender`, `Restaurant_ID`) VALUES
(25, 'Nafis', 'Alam', 'nak', 'abc', 123, 'nak@gmail.com', 'Mohammadpur', 'Male', 1),
(26, 'Aciea', 'Begum', 'acb', 'abc', 1234, 'acb@gmail.com', 'Basundhara', 'Female', 1),
(27, 'Shamim', 'Hasan', 'shamim', 'abc', 1232134, 'afscs@sgv', 'sbhrtfg', 'female', 16),
(29, 'Abir', 'Hasan', 'aht', '123', 1234567890, 'aht@gmail.com', 'Khilkhet', 'male', 1),
(30, 'Asif ', 'Iqbal', 'asif', 'abc', 123456789, 'asif@mail.com', 'Block A, Basundhara, Dhaka', 'Male', 1),
(31, 'Nazmul', 'Sakib', 'nirob', 'abc', 1247894123, 'nirob@mail.com', 'Nadda, Dhaka', 'Male', 1),
(32, 'Sadia', 'Sultana', 'sadia', 'abc', 511516161, 'sadia@mail.com', 'Banani', 'Female', 1),
(33, 'Fariha', 'Salsabil', 'fariha', 'abc', 51911991, 'fariha@mail.com', 'Uttara', 'Female', 1),
(34, 'Sayma', 'Selim', 'sayma', '123', 516519819, 'sayma@mail.com', 'Dhanmondi', 'Female', 16),
(268, 'Ibna', 'Sabid', 'ibna', '123', 49899494, 'sabid@mial.com', 'Demra', 'Male', 16),
(269, 'Siam ', 'Siddique', 'siam', '789', 414549464, 'siam@mail.com', 'Lalbag', 'Male', 17),
(270, 'Farha', 'Priya', 'priya', '789', 49494949, 'priya@mail.com', 'Vatara', 'Female', 17);

-- --------------------------------------------------------

--
-- Table structure for table `delivers`
--

CREATE TABLE `delivers` (
  `Order_ID` int(10) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Delivery_Date` timestamp NULL DEFAULT NULL,
  `sub_total` int(6) NOT NULL,
  `Customer_ID` int(10) NOT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivers`
--

INSERT INTO `delivers` (`Order_ID`, `Quantity`, `Delivery_Date`, `sub_total`, `Customer_ID`, `Restaurant_ID`) VALUES
(64, 1, '2024-05-27 03:13:23', 250, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(10) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `Position` varchar(15) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Name`, `Address`, `Phone`, `Email`, `Position`, `salary`, `Restaurant_ID`) VALUES
(6, 'Redwan', 'Mirpur', 12421, 'redwan12@mail.com', 'manager', 30000, 1),
(7, 'Jashim', 'Cumilla', 43735, 'jashim@mail.com', 'Chef', 50000, 1),
(8, 'Niloy', 'Chittagong', 6519, 'niloy@mail.com', 'Chef', 45000, 1),
(9, 'Rafsan Chowdhury', 'Dhaka', 45634254, 'rafsanc@mail.com', 'Head Chef', 70000, 1),
(11, 'Sayeed', 'Dohar', 846511, 'sayeed@mail.com', 'Staff', 15000, 1),
(14, 'Tarik', 'Uttara', 414515, 'tarik@mail.com', 'Manager', 25000, 16),
(15, 'Riyad', 'Basundhara', 123445, 'riyad@mail.com', 'Manager', 20000, 17),
(16, 'Noorul Islam', 'Mirpur', 569151616, 'noor@mail.com', 'Head Chef', 35000, 16),
(17, 'Sayem ', 'Rajshahi', 2147483647, 'sayem@mail.com', 'Cashier', 20000, 16),
(18, 'Nirob', 'Barisal', 51651651, 'nirob@mail.com', 'Staff', 15000, 16),
(19, 'Faysal', 'Rampura', 65616161, 'faysal@mail.com', 'Cleaner', 10000, 16),
(20, 'Kamrul', 'Basila', 2147483647, 'kamrul@mail.com', 'Cashier', 15000, 17),
(21, 'Khairul', 'Mohammadpur', 65161651, 'kahirul@mial.com', 'Staff', 15000, 17),
(22, 'Monirul Islam', 'Khulna', 6516516, 'monir@mail.com', 'Chef', 30000, 17),
(23, 'asdas', 'sdfsdf', 343, 'a@kl', 'lfhklq', 656, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventss`
--

CREATE TABLE `eventss` (
  `Event_ID` int(11) NOT NULL,
  `Event_Type` varchar(30) DEFAULT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Total_Guests` int(3) DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventss`
--

INSERT INTO `eventss` (`Event_ID`, `Event_Type`, `Date`, `Time`, `Total_Guests`, `Restaurant_ID`) VALUES
(4, 'Party', '2024-05-06', '17:45:00', 56, 1),
(5, 'Birthday', '2024-05-21', '10:52:00', 14, 1),
(7, 'haldi', '2024-05-15', '21:58:11', 80, 16),
(8, 'Engagement', '2024-05-02', '16:07:00', 50, 1),
(9, 'Birthday', '2024-05-29', '19:00:00', 40, 17),
(10, 'Reciption', '2024-11-09', '18:00:00', 200, 17);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Product_ID` int(10) NOT NULL,
  `Product_Name` varchar(30) DEFAULT NULL,
  `Catagory` varchar(30) DEFAULT NULL,
  `Quantity` int(3) DEFAULT NULL,
  `Expiration_Date` date DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Product_ID`, `Product_Name`, `Catagory`, `Quantity`, `Expiration_Date`, `Restaurant_ID`) VALUES
(7, 'Tomato', 'Vegetable', 50, '2024-05-21', 1),
(8, 'Potato', 'vegetable', 32, '2024-05-24', 1),
(13, 'Chilli', 'spice', 23, '2024-05-29', 1),
(15, 'Garlic', 'Spice', 15, '2024-08-30', 1),
(16, 'Onion', 'Spice', 60, '2024-11-01', 1),
(17, 'Egg', 'Protein', 10000, '2024-06-30', 1),
(18, 'Olive oil', 'Oil', 60, '2025-02-18', 1),
(19, 'Tomato', 'Vegetable', 32, '2024-09-17', 16),
(20, 'Egg', 'Protein', 1005, '2024-06-30', 16),
(21, 'Palm Oil', 'Oil', 40, '2024-11-29', 16),
(22, 'Chicken', 'Meat', 20, '2024-08-01', 17),
(23, 'Beef', 'Meat', 56, '2024-12-29', 17),
(24, 'Rice', 'Grain', 92, '2025-06-19', 17),
(25, 'Chicken', 'Meat', 88, '2024-09-15', 1),
(26, 'Beef', 'Meat', 78, '2025-01-07', 1),
(27, 'Rice', 'Grain', 49, '2025-02-11', 1),
(28, 'Water', 'Drink', 50, '2024-07-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `Item_Number` int(2) NOT NULL,
  `Item_Name` varchar(20) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Restaurant_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Item_Number`, `Item_Name`, `price`, `Description`, `Restaurant_ID`) VALUES
(15, 'Pizza', 350, 'cheezzzyy melty ', 1),
(16, 'Pasta', 250, 'White Sauce Pasta', 1),
(17, 'Rice Bowl', 180, 'BBQ Chicken Rice Bowl', 1),
(18, 'Chicken Fry', 340, '2 piece crispy fries', 1),
(20, 'Pizza', 250, 'Italian pizza', 16),
(21, 'Cake', 175, 'Chocolate cake', 16),
(22, 'Pasta', 150, 'Oven Baked Pasta', 16),
(23, 'French Fry', 190, 'Handcut fries', 16),
(24, 'Ramen', 561, 'Tantanmen Ramen', 16),
(25, 'Rice', 60, 'Steamed Rice', 17),
(26, 'Dal', 20, 'Tarka', 17),
(27, 'Fish Curry', 130, 'Rui Fish', 17),
(28, 'Vorta', 10, 'Alu, Begun, Shim, Shutki', 17),
(29, 'Mineral Water', 20, 'Bottle', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(10) NOT NULL,
  `Quantity` int(2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `sub_total` int(6) DEFAULT NULL,
  `Customer_ID` int(10) NOT NULL,
  `Item_Number` int(2) NOT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Quantity`, `order_date`, `sub_total`, `Customer_ID`, `Item_Number`, `Restaurant_ID`) VALUES
(32, 1, '2024-05-26 14:07:33', 50, 29, 20, 16),
(35, 1, '2024-05-26 14:10:20', 234, 26, 18, 1),
(36, 1, '2024-05-26 14:10:28', 50, 26, 20, 16),
(37, 3, '2024-05-26 14:21:21', 1050, 26, 15, 1),
(39, 1, '2024-05-26 17:51:41', 350, 25, 15, 1),
(40, 2, '2024-05-26 17:51:41', 360, 25, 17, 1),
(41, 1, '2024-05-26 17:51:41', 340, 25, 18, 1),
(42, 3, '2024-05-26 17:51:41', 750, 25, 16, 1),
(43, 1, '2024-05-26 17:51:55', 350, 25, 15, 1),
(44, 1, '2024-05-26 17:51:55', 250, 25, 16, 1),
(45, 1, '2024-05-26 17:51:55', 180, 25, 17, 1),
(46, 1, '2024-05-26 17:51:55', 340, 25, 18, 1),
(47, 1, '2024-05-26 17:52:24', 250, 25, 20, 16),
(48, 1, '2024-05-26 17:52:24', 561, 25, 24, 16),
(49, 1, '2024-05-26 17:52:24', 150, 25, 22, 16),
(50, 2, '2024-05-26 17:52:36', 40, 25, 29, 17),
(51, 3, '2024-05-26 17:52:36', 30, 25, 28, 17),
(52, 2, '2024-05-26 17:52:36', 120, 25, 25, 17),
(53, 2, '2024-05-26 17:52:36', 260, 25, 27, 17),
(54, 1, '2024-05-26 17:53:37', 175, 26, 21, 16),
(55, 1, '2024-05-26 17:53:37', 250, 26, 20, 16),
(56, 1, '2024-05-26 17:53:37', 561, 26, 24, 16),
(57, 1, '2024-05-26 17:53:40', 250, 26, 16, 1),
(58, 1, '2024-05-26 17:53:40', 180, 26, 17, 1),
(59, 1, '2024-05-26 17:53:40', 340, 26, 18, 1),
(60, 1, '2024-05-26 17:53:44', 60, 26, 25, 17),
(61, 1, '2024-05-26 17:53:44', 20, 26, 29, 17),
(62, 1, '2024-05-26 17:53:44', 10, 26, 28, 17),
(63, 2, '2024-05-27 03:13:23', 360, 25, 17, 1),
(64, 1, '2024-05-27 03:13:23', 250, 25, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_ID` int(10) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Total_Guests` int(2) DEFAULT NULL,
  `Reservation_Date` date NOT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_ID`, `Name`, `Total_Guests`, `Reservation_Date`, `Restaurant_ID`) VALUES
(1, 'Aciea Begum', 99, '2024-05-29', 1),
(2, 'Nafis Alam', 2, '2024-05-28', 1),
(4, 'Fida Ullah', 43, '2024-05-31', 16),
(5, 'Raheem Khan', 9, '2024-05-24', 1),
(6, 'Asif Iqbal', 32, '2024-05-31', 17);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `Restaurant_ID` int(10) NOT NULL,
  `Name` varchar(32) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `Cuisine_Type` varchar(20) DEFAULT NULL,
  `Opening_Hour` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Restaurant_ID`, `Name`, `Address`, `Phone`, `Email`, `password`, `Cuisine_Type`, `Opening_Hour`) VALUES
(1, 'DBdine', 'Basundhara', 123, 'dbd@gmail.com', 'dd', 'Thai', '10 AM - 09 PM'),
(16, 'Rust', 'Banani', 12345, 'rust@mail.com', 'rr', 'Mexican', '12 PM- 09 PM'),
(17, 'Banjon', 'Basundhara', 123, 'banjon@mail.com', 'bb', 'Bangla', '08 PM - 10 PM'),
(18, 'nila', 'bagsj', 254, 'bff@hg', 'nila', 'gn', '4-8');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Rating` int(1) DEFAULT NULL,
  `Comments` varchar(300) DEFAULT NULL,
  `Review_Date` date DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL,
  `Customer_ID` int(10) NOT NULL,
  `Order_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Rating`, `Comments`, `Review_Date`, `Restaurant_ID`, `Customer_ID`, `Order_ID`) VALUES
(5, 'wow', '2024-05-26', 16, 29, 32),
(4, 'wewe', '2024-05-26', 1, 26, 35),
(3, 'trtr', '2024-05-26', 16, 26, 36),
(5, 'cyka', '2024-05-26', 16, 26, 36),
(4, 'It was very spicy', '2024-05-27', 17, 25, 51),
(1, 'qjf', '2024-05-27', 1, 25, 39);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `Shift_ID` int(10) NOT NULL,
  `Shift_Date` date DEFAULT NULL,
  `Start_Time` time DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Employee_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`Shift_ID`, `Shift_Date`, `Start_Time`, `End_Time`, `Employee_ID`) VALUES
(1, '2024-05-12', '08:00:00', '18:00:00', 6),
(2, '2024-05-12', '10:00:00', '12:00:00', 8),
(4, '2024-06-01', '10:00:00', '17:00:00', 7),
(10, '2024-05-07', '14:19:00', '14:18:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Marchent_ID` int(10) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Restaurant_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Marchent_ID`, `Name`, `Address`, `Phone`, `Email`, `Restaurant_ID`) VALUES
(1, 'Evaly', 'Dhaka', 123, 'totocompany@evaly.com', 1),
(4, 'Daraz', 'Uttara', 3165161, 'daraz@mail.com', 1),
(5, 'mart', 'banani', 123424, 'adw@seg', 16),
(7, 'pandamart', 'mohammadpur', 2345435, 'ads@wefd', 17);

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `Restaurant_ID` int(10) NOT NULL,
  `Marchent_ID` int(10) NOT NULL,
  `Supply_Date` date DEFAULT NULL,
  `Supply_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tablee`
--

CREATE TABLE `tablee` (
  `Table_No` int(10) NOT NULL,
  `Capacity` int(2) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Employee_ID` int(10) NOT NULL,
  `Resetvation_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waits`
--

CREATE TABLE `waits` (
  `Employee_ID` int(10) NOT NULL,
  `Table_No` int(10) NOT NULL,
  `Serve_Date` date DEFAULT NULL,
  `Serve_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canceled`
--
ALTER TABLE `canceled`
  ADD KEY `Order_ID` (`Order_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `delivers`
--
ALTER TABLE `delivers`
  ADD KEY `Restaurant_ID` (`Restaurant_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `eventss`
--
ALTER TABLE `eventss`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Item_Number`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Item_Number` (`Item_Number`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`Restaurant_ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `Restaurant_ID` (`Restaurant_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `review_ibfk_3` (`Order_ID`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`Shift_ID`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Marchent_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD KEY `Restaurant_ID` (`Restaurant_ID`),
  ADD KEY `Marchent_ID` (`Marchent_ID`);

--
-- Indexes for table `tablee`
--
ALTER TABLE `tablee`
  ADD PRIMARY KEY (`Table_No`),
  ADD KEY `Employee_ID` (`Employee_ID`),
  ADD KEY `Resetvation_ID` (`Resetvation_ID`);

--
-- Indexes for table `waits`
--
ALTER TABLE `waits`
  ADD KEY `Employee_ID` (`Employee_ID`),
  ADD KEY `Table_No` (`Table_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Employee_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `eventss`
--
ALTER TABLE `eventss`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Product_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Item_Number` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `Restaurant_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `Shift_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Marchent_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tablee`
--
ALTER TABLE `tablee`
  MODIFY `Table_No` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canceled`
--
ALTER TABLE `canceled`
  ADD CONSTRAINT `canceled_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canceled_ibfk_2` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canceled_ibfk_3` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivers`
--
ALTER TABLE `delivers`
  ADD CONSTRAINT `delivers_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivers_ibfk_2` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivers_ibfk_3` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventss`
--
ALTER TABLE `eventss`
  ADD CONSTRAINT `eventss_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Item_Number`) REFERENCES `menu` (`Item_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurant` (`Restaurant_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supply_ibfk_2` FOREIGN KEY (`Marchent_ID`) REFERENCES `supplier` (`Marchent_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tablee`
--
ALTER TABLE `tablee`
  ADD CONSTRAINT `tablee_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tablee_ibfk_2` FOREIGN KEY (`Resetvation_ID`) REFERENCES `reservation` (`Reservation_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waits`
--
ALTER TABLE `waits`
  ADD CONSTRAINT `waits_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waits_ibfk_2` FOREIGN KEY (`Table_No`) REFERENCES `tablee` (`Table_No`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
