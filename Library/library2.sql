-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 10:38 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(17) NOT NULL,
  `BookTitle` varchar(50) NOT NULL,
  `Author` varchar(30) NOT NULL,
  `Edition` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Reserved` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `BookTitle`, `Author`, `Edition`, `Year`, `CategoryID`, `Reserved`) VALUES
('978-0-112-23344-5', 'Mystery of the Lost Key', 'William Gray', 2, '2017', 7, 'N'),
('978-0-123-45678-8', 'Better Yourself', 'Ava Silver', 3, '2020', 10, 'N'),
('978-0-312-86789-1', 'Stellar Horizons', 'Michael S. Hartman', 2, '2021', 2, 'N'),
('978-0-345-52936-8', 'Echoes of Autumn', 'Amelia Ford', 2, '2022', 1, 'Y'),
('978-0-452-28423-4', 'The Silent Whisper', 'Evelyn Hart', 1, '2020', 1, 'N'),
('978-0-553-21274-8', 'Shadows of Time', 'Maggie Rhodes', 3, '2021', 1, 'Y'),
('978-0-553-58756-7', 'Galactic Outlaws', 'Ben Carter', 4, '2022', 2, 'N'),
('978-0-7432-7356-0', 'Beneath the Willow', 'Carter Nolan', 2, '2018', 1, 'N'),
('978-0-7653-9850-3', 'Nebula Genesis', 'Elliot Travers', 3, '2018', 2, 'N'),
('978-1-223-34455-6', 'Imaginary Worlds', 'Charlotte Green', 1, '2018', 6, 'N'),
('978-1-234-56789-7', 'The Great Fiction', 'John Smith', 1, '2015', 1, 'N'),
('978-1-250-11097-1', 'The Eternity Circuit', 'Lila Carrington', 1, '2020', 2, 'N'),
('978-1-4165-9068-9', 'The Forgotten Path', 'Gregory Lorne', 1, '2019', 1, 'N'),
('978-1-667-78855-2', 'Love Beyond Borders', 'Emma Purple', 1, '2018', 8, 'N'),
('978-1-891830-77-8', 'The Quantum Paradox', 'Diana Vaughn', 1, '2019', 2, 'N'),
('978-2-334-45566-7', 'Criminal Minds', 'James Gold', 2, '2022', 7, 'N'),
('978-2-345-67890-6', 'Non-Fiction Wonders', 'Jane Doe', 2, '2020', 2, 'N'),
('978-2-778-89933-4', 'Spooky Stories', 'James Red', 3, '2016', 9, 'N'),
('978-3-445-56677-8', 'Romantic Getaways', 'Amelia Brown', 1, '2019', 8, 'N'),
('978-3-456-78901-5', 'Galactic Adventures', 'Liam White', 3, '2018', 3, 'N'),
('978-3-889-90044-5', 'Habits of Success', 'Isabella Cyan', 1, '2023', 10, 'N'),
('978-4-556-67788-9', 'Zombie Invasion', 'Ethan Orange', 3, '2014', 9, 'N'),
('978-4-567-89012-4', 'Life of a Genius', 'Sophia Brown', 1, '2016', 4, 'N'),
('978-4-990-01177-8', 'Galactic Wars', 'Oliver Orange', 2, '2019', 3, 'N'),
('978-5-101-11288-9', 'The History of Us', 'Sophia Lime', 1, '2015', 5, 'Y'),
('978-5-667-78899-0', 'Master Your Mind', 'Mia Violet', 1, '2021', 10, 'N'),
('978-5-678-90123-3', 'World Wars: A History', 'Michael Green', 4, '2012', 5, 'N'),
('978-6-778-89900-1', 'Future Fables', 'Lucas Yellow', 2, '2020', 3, 'N'),
('978-6-789-01234-2', 'Magical Realms', 'Emma Blue', 1, '2019', 6, 'N'),
('978-7-889-90011-2', 'Biographies of the Brave', 'Ella Indigo', 3, '2015', 4, 'N'),
('978-7-890-12345-1', 'Detective Chronicles', 'Oliver Gray', 2, '2021', 7, 'N'),
('978-8-901-23456-0', 'Love in the Times', 'Isabella White', 1, '2017', 8, 'N'),
('978-8-990-01122-3', 'Historic Empires', 'Jack Blue', 4, '2011', 5, 'N'),
('978-9-012-34567-9', 'Haunted Places', 'Mason Black', 5, '2013', 9, 'N'),
('978-9-101-11233-4', 'Journey Through Fantasy', 'Lily Black', 1, '2022', 6, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryDescription` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryDescription`) VALUES
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Science Fiction'),
(4, 'Biography'),
(5, 'History'),
(6, 'Fantasy'),
(7, 'Mystery'),
(8, 'Romance'),
(9, 'Horror'),
(10, 'Self-Help');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ISBN` varchar(17) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `ReservedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ISBN`, `Username`, `ReservedDate`) VALUES
('978-0-345-52936-8', 'zhiyuan', '2024-12-05'),
('978-0-553-21274-8', 'zhiyuan', '2024-12-05'),
('978-5-101-11288-9', 'zhiyuan', '2024-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `Surname` varchar(15) NOT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) DEFAULT NULL,
  `City` varchar(20) NOT NULL,
  `Telephone` int(8) NOT NULL,
  `Mobile` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `FirstName`, `Surname`, `AddressLine1`, `AddressLine2`, `City`, `Telephone`, `Mobile`) VALUES
('zhiyuan', '123123', 'Zhi Yuan', 'Cheong', '10 Glenbourne Green', 'Leopardstown Valley', 'Dublin', 0, 851554655);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `CategoryID_FK` (`CategoryID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD KEY `Username_FK` (`Username`),
  ADD KEY `ISBN_FK` (`ISBN`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Username_2` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `CategoryID_FK` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `ISBN_FK` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `Username_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
