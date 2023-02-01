-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 01, 2023 at 11:59 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fr24`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `passport` varchar(32) NOT NULL,
  `departure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(3) NOT NULL,
  `destination` varchar(3) NOT NULL,
  `seat` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `passport`, `departure`, `source`, `destination`, `seat`, `status`) VALUES
(6, 'A01', '2023-02-02 09:00:00', 'LHR', 'LAX', 1, 1),
(7, 'A02', '2023-02-02 09:00:00', 'LHR', 'LAX', 2, 1),
(8, 'A03', '2023-02-02 09:00:00', 'LHR', 'LAX', 3, 1),
(9, 'A04', '2023-02-02 09:00:00', 'LHR', 'LAX', 4, 1),
(10, 'A05', '2023-02-02 09:00:00', 'LHR', 'LAX', 5, 1),
(11, 'A06', '2023-02-02 09:00:00', 'LHR', 'LAX', 6, 1),
(12, 'A07', '2023-02-02 09:00:00', 'LHR', 'LAX', 7, 1),
(13, 'A08', '2023-02-02 09:00:00', 'LHR', 'LAX', 8, 1),
(14, 'A09', '2023-02-02 09:00:00', 'LHR', 'LAX', 9, 1),
(15, 'A10', '2023-02-02 09:00:00', 'LHR', 'LAX', 10, 1),
(16, 'A11', '2023-02-02 09:00:00', 'LHR', 'LAX', 11, 1),
(17, 'A12', '2023-02-02 09:00:00', 'LHR', 'LAX', 12, 1),
(18, 'A13', '2023-02-02 09:00:00', 'LHR', 'LAX', 13, 1),
(19, 'A14', '2023-02-02 09:00:00', 'LHR', 'LAX', 14, 1),
(20, 'A15', '2023-02-02 09:00:00', 'LHR', 'LAX', 15, 1),
(21, 'A16', '2023-02-02 09:00:00', 'LHR', 'LAX', 16, 1),
(22, 'A17', '2023-02-02 09:00:00', 'LHR', 'LAX', 17, 1),
(23, 'A18', '2023-02-02 09:00:00', 'LHR', 'LAX', 18, 1),
(24, 'A19', '2023-02-02 09:00:00', 'LHR', 'LAX', 19, 1),
(25, 'A20', '2023-02-02 09:00:00', 'LHR', 'LAX', 20, 1),
(26, 'A21', '2023-02-02 09:00:00', 'LHR', 'LAX', 21, 1),
(27, 'A22', '2023-02-02 09:00:00', 'LHR', 'LAX', 22, 1),
(28, 'A23', '2023-02-02 09:00:00', 'LHR', 'LAX', 23, 1),
(29, 'A24', '2023-02-02 09:00:00', 'LHR', 'LAX', 24, 1),
(30, 'A25', '2023-02-02 09:00:00', 'LHR', 'LAX', 25, 1),
(31, 'A26', '2023-02-02 09:00:00', 'LHR', 'LAX', 26, 1),
(32, 'A27', '2023-02-02 09:00:00', 'LHR', 'LAX', 27, 1),
(33, 'A28', '2023-02-02 09:00:00', 'LHR', 'LAX', 28, 1),
(34, 'A29', '2023-02-02 09:00:00', 'LHR', 'LAX', 29, 1),
(35, 'A30', '2023-02-02 09:00:00', 'LHR', 'LAX', 30, 1),
(36, 'A31', '2023-02-02 09:00:00', 'LHR', 'LAX', 31, 1),
(37, 'A32', '2023-02-02 09:00:00', 'LHR', 'LAX', 32, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
