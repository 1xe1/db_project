-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 10:22 AM
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
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` varchar(4) NOT NULL,
  `cus_firstname` varchar(50) NOT NULL,
  `cus_lastname` varchar(50) NOT NULL,
  `cus_address` varchar(20) NOT NULL,
  `cus_subdis` varchar(50) NOT NULL,
  `cus_district` varchar(50) NOT NULL,
  `cus_province` varchar(50) NOT NULL,
  `cus_postcode` varchar(5) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_firstname`, `cus_lastname`, `cus_address`, `cus_subdis`, `cus_district`, `cus_province`, `cus_postcode`, `cus_phone`, `cus_email`, `void`) VALUES
('1', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', '57100', '0644042022', 'ss@ss.com', 0),
('2', 'oo', 'oj', 'oo', 'oo', '99999999999', 'oo', '57100', '0644042022', 'oo@oo.com', 0),
('3', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', '57100', '0644042022', 'xx@xx.com', 0),
('4', 'z', 'm', 'n', 'g', 'j', 'k', '31000', '0841712542', 'zmj@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(4) NOT NULL,
  `emp_firstname` varchar(50) NOT NULL,
  `emp_lastname` varchar(50) NOT NULL,
  `emp_address` varchar(50) NOT NULL,
  `emp_subdis` varchar(100) NOT NULL,
  `emp_district` varchar(50) NOT NULL,
  `emp_province` varchar(50) NOT NULL,
  `emp_postcode` varchar(5) NOT NULL,
  `emp_phone` varchar(10) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_startworking` date NOT NULL,
  `emp_password` varchar(50) NOT NULL,
  `emp_department` varchar(100) NOT NULL,
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_firstname`, `emp_lastname`, `emp_address`, `emp_subdis`, `emp_district`, `emp_province`, `emp_postcode`, `emp_phone`, `emp_email`, `emp_startworking`, `emp_password`, `emp_department`, `void`) VALUES
('1', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', '0644042022', 'aa@gmail.com', '2023-11-10', 'asd123', 'aa', 0),
('2', 'tt', 'tt', 'tt', 'tt', 'tt', 'tt', '58200', '0644042022', 'tt@gmail.com', '2023-10-27', 'asd123', 'tt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` varchar(3) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_valueprice` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL COMMENT 'ผู้ดูแลโครงการ',
  `project_status` int(1) NOT NULL COMMENT '0 = ยกเลิก, 1 = อยู่ระหว่างดำเนินการ, 2 = ปิดโครงการ',
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `cus_id`, `project_start`, `project_end`, `project_valueprice`, `emp_id`, `project_status`, `void`) VALUES
('1', 'Mj', 1, '2023-10-13', '2023-12-28', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_close`
--

CREATE TABLE `project_close` (
  `headcode` varchar(20) NOT NULL,
  `dateclose` date NOT NULL,
  `project_id` varchar(3) NOT NULL,
  `cost` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `emp_id` varchar(3) NOT NULL,
  `comment` varchar(150) NOT NULL,
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_close`
--

INSERT INTO `project_close` (`headcode`, `dateclose`, `project_id`, `cost`, `pay`, `emp_id`, `comment`, `void`) VALUES
('1', '2023-10-18', '001', 5000, 500, 'asd', 'aaa', 0),
('2', '2023-10-18', '002', 1, 1, '003', 'a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_desc`
--

CREATE TABLE `project_desc` (
  `headcode` varchar(20) NOT NULL,
  `s_id` varchar(3) NOT NULL,
  `qty` int(11) NOT NULL,
  `s_price` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_desc`
--

INSERT INTO `project_desc` (`headcode`, `s_id`, `qty`, `s_price`, `totalprice`) VALUES
('2', '001', 3, 50, 150),
('2', '003', 5, 20, 100);

-- --------------------------------------------------------

--
-- Table structure for table `project_hd`
--

CREATE TABLE `project_hd` (
  `headcode` varchar(20) NOT NULL,
  `datesave` date NOT NULL,
  `receiptcode` varchar(3) NOT NULL,
  `datereceipt` date NOT NULL,
  `project_id` varchar(3) NOT NULL,
  `totalprice` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=ยกเลิก, 1=ปกติ',
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_hd`
--

INSERT INTO `project_hd` (`headcode`, `datesave`, `receiptcode`, `datereceipt`, `project_id`, `totalprice`, `status`, `void`) VALUES
('1', '2023-10-25', '001', '2023-11-03', '1', 0, 1, 0),
('2', '2023-10-21', '001', '2023-10-19', '1', 150, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `s_id` varchar(3) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_unit` varchar(50) NOT NULL,
  `s_price` int(10) NOT NULL,
  `void` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`s_id`, `s_name`, `s_unit`, `s_price`, `void`) VALUES
('1', 'a', '123', 55885, 0),
('2', 'กระดาษ', '5', 20, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_close`
--
ALTER TABLE `project_close`
  ADD PRIMARY KEY (`headcode`);

--
-- Indexes for table `project_desc`
--
ALTER TABLE `project_desc`
  ADD PRIMARY KEY (`headcode`,`s_id`);

--
-- Indexes for table `project_hd`
--
ALTER TABLE `project_hd`
  ADD PRIMARY KEY (`headcode`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
