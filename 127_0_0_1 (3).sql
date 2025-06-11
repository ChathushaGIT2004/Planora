-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 10:05 PM
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
-- Database: `planora_db`
--
CREATE DATABASE IF NOT EXISTS `planora_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `planora_db`;

-- --------------------------------------------------------

--
-- Table structure for table `client-preferences`
--

CREATE TABLE `client-preferences` (
  `userid` int(11) DEFAULT NULL,
  `BrideName` varchar(1000) NOT NULL,
  `GroomName` varchar(1000) NOT NULL,
  `BrideTpNo` varchar(10) NOT NULL,
  `GroomTpNo` int(10) NOT NULL,
  `IsGroomLoggedIn` tinyint(1) NOT NULL DEFAULT 0,
  `IsBrideLoggedIn` tinyint(1) NOT NULL DEFAULT 0,
  `Prefered_Date` date NOT NULL,
  `Budget_Range` int(11) NOT NULL,
  `Guest_count` int(11) NOT NULL,
  `Preferred_District` varchar(1000) NOT NULL,
  `Preferred_City` varchar(1000) NOT NULL,
  `Venue_Type` enum('Indoor','Outdoor','Both') NOT NULL,
  `ceremony_type` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This Table holds the Clients preferences.';

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `HotelID` int(11) NOT NULL,
  `HotelName` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `AddressNo` varchar(50) DEFAULT NULL,
  `RoadName` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `District` varchar(100) DEFAULT NULL,
  `Latitude` decimal(10,6) DEFAULT NULL,
  `Longitude` decimal(10,6) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `WebsiteURL` varchar(255) DEFAULT NULL,
  `StarRating` decimal(2,1) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `UpdatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_availability`
--

CREATE TABLE `hotel_availability` (
  `AvailabilityID` int(11) NOT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `AvailableDate` date DEFAULT NULL,
  `BookingPolicy` text DEFAULT NULL,
  `TimePeriod` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `ImageID` int(11) NOT NULL,
  `HotelID` int(11) DEFAULT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `IsMain` tinyint(1) DEFAULT 0,
  `MediaType` enum('Image','Video','360View') DEFAULT 'Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_venues`
--

CREATE TABLE `hotel_venues` (
  `VenueID` int(11) NOT NULL,
  `HotelID` int(11) DEFAULT NULL,
  `VenueType` enum('Indoor','Outdoor','Garden','Beachside','Ballroom') DEFAULT NULL,
  `VenuePrice` int(11) DEFAULT NULL,
  `MaxGuestCapacity` int(11) DEFAULT NULL,
  `MinGuestCapacity` int(11) DEFAULT NULL,
  `NumberOfHalls` int(11) DEFAULT NULL,
  `HasBridalSuite` tinyint(1) DEFAULT NULL,
  `IsPetFriendly` tinyint(1) DEFAULT NULL,
  `ParkingCapacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `Email` varchar(1000) NOT NULL,
  `phone` varchar(1000) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `phone`, `Password`, `role`) VALUES
(9, '', 'chathushadewmin@gmail.com', '', 'Dewmith@2004', 'Client'),
(10, '', 'Clyrics2004@gmail.com', '', 'Dewmin@2004', 'Client'),
(11, '', 'Dewmin@2004gmail.com', '', 'Dewmin@2004', 'Client'),
(12, '', 'ABC@Gmail.com', '', 'Dewmin@2004', 'Client'),
(13, '', 'PQRD@gmail.com', '', 'Dewmith@2004', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `UserID` int(11) NOT NULL,
  `VendorName` varchar(255) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `AddressNo` varchar(50) DEFAULT NULL,
  `RoadName` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `District` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Rating` decimal(2,1) DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active',
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `UpdatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_availability`
--

CREATE TABLE `vendor_availability` (
  `AvailabilityID` int(11) NOT NULL,
  `VendorID` int(11) NOT NULL,
  `AvailableDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bookings`
--

CREATE TABLE `vendor_bookings` (
  `BookingID` int(11) NOT NULL,
  `VendorID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `MeetingDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `Status` enum('Pending','Approved','Cancelled','Completed') DEFAULT 'Pending',
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_feedback`
--

CREATE TABLE `vendor_feedback` (
  `FeedbackID` int(11) NOT NULL,
  `VendorID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RatingValue` int(11) DEFAULT NULL CHECK (`RatingValue` between 1 and 5),
  `ReviewText` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_packages`
--

CREATE TABLE `vendor_packages` (
  `PackageID` int(11) NOT NULL,
  `VendorID` int(11) DEFAULT NULL,
  `PackageName` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Duration` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_photos`
--

CREATE TABLE `vendor_photos` (
  `PhotoID` int(11) NOT NULL,
  `VendorID` int(11) DEFAULT NULL,
  `PhotoURL` varchar(255) DEFAULT NULL,
  `Caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`HotelID`);

--
-- Indexes for table `hotel_availability`
--
ALTER TABLE `hotel_availability`
  ADD PRIMARY KEY (`AvailabilityID`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `HotelID` (`HotelID`);

--
-- Indexes for table `hotel_venues`
--
ALTER TABLE `hotel_venues`
  ADD PRIMARY KEY (`VenueID`),
  ADD KEY `HotelID` (`HotelID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendor_availability`
--
ALTER TABLE `vendor_availability`
  ADD PRIMARY KEY (`AvailabilityID`);

--
-- Indexes for table `vendor_bookings`
--
ALTER TABLE `vendor_bookings`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `vendor_feedback`
--
ALTER TABLE `vendor_feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `vendor_packages`
--
ALTER TABLE `vendor_packages`
  ADD PRIMARY KEY (`PackageID`);

--
-- Indexes for table `vendor_photos`
--
ALTER TABLE `vendor_photos`
  ADD PRIMARY KEY (`PhotoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `HotelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_availability`
--
ALTER TABLE `hotel_availability`
  MODIFY `AvailabilityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_venues`
--
ALTER TABLE `hotel_venues`
  MODIFY `VenueID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor_availability`
--
ALTER TABLE `vendor_availability`
  MODIFY `AvailabilityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_bookings`
--
ALTER TABLE `vendor_bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_feedback`
--
ALTER TABLE `vendor_feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_packages`
--
ALTER TABLE `vendor_packages`
  MODIFY `PackageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_photos`
--
ALTER TABLE `vendor_photos`
  MODIFY `PhotoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`HotelID`) REFERENCES `hotels` (`HotelID`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_venues`
--
ALTER TABLE `hotel_venues`
  ADD CONSTRAINT `hotel_venues_ibfk_1` FOREIGN KEY (`HotelID`) REFERENCES `hotels` (`HotelID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
