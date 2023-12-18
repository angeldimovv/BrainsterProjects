-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 07:33 PM
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
-- Database: `brainsterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hiringcomapany_app`
--

CREATE TABLE `hiringcomapany_app` (
  `application_id` int(11) NOT NULL,
  `fullName` varchar(25) NOT NULL,
  `companyName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `studentType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hiringcomapany_app`
--

INSERT INTO `hiringcomapany_app` (`application_id`, `fullName`, `companyName`, `email`, `phoneNumber`, `studentType`) VALUES
(1, 'Marko Markovski', 'Kam-Market', 'test@kam.com', '+38975000111', 0),
(2, 'TestName', 'TestCompany', 'test@test.com', '+38975000222', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `type`) VALUES
(1, 'Студент од маркетинг'),
(2, 'Студент од програмирање'),
(3, 'Студент од data science'),
(4, 'Студент од дизајн');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hiringcomapany_app`
--
ALTER TABLE `hiringcomapany_app`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hiringcomapany_app`
--
ALTER TABLE `hiringcomapany_app`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
