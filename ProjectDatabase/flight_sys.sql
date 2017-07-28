-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2016 at 09:30 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`id`, `Name`) VALUES
(1, 'Bell P-39'),
(2, 'Northrop P-61');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Country_id` int(11) NOT NULL,
  `Image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `Name`, `City`, `Country_id`, `Image_id`) VALUES
(1, 'EGA', 'Cairo', 1, 1),
(2, 'AUI', 'Alex', 1, 1),
(3, 'FCA', 'Paris', 2, 1),
(4, 'CUI', 'Cairo', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `CountryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `CountryName`) VALUES
(1, 'Egypt'),
(2, 'France'),
(3, 'America');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `Orgin_airport_id` int(11) NOT NULL,
  `Dist_airport_id` int(11) NOT NULL,
  `Depature_date` datetime NOT NULL,
  `Arrive_date` datetime NOT NULL,
  `Aircraft_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `Orgin_airport_id`, `Dist_airport_id`, `Depature_date`, `Arrive_date`, `Aircraft_id`) VALUES
(1, 1, 2, '2016-05-19 06:17:00', '2016-05-01 06:23:00', 1),
(2, 2, 1, '2016-06-30 07:11:00', '2016-05-04 04:06:00', 2),
(3, 2, 1, '2016-05-04 05:00:00', '2016-05-04 15:00:00', 1),
(4, 1, 2, '2016-05-18 00:00:00', '2016-05-24 00:00:00', 1),
(9, 1, 2, '2016-05-18 00:00:00', '2016-05-25 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flight_type`
--

CREATE TABLE `flight_type` (
  `id` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_type`
--

INSERT INTO `flight_type` (`id`, `Type`) VALUES
(1, 'RoundTripe'),
(2, 'OneWay');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `PhLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `PhLink`) VALUES
(1, 'images\\img_avatar4.png'),
(11, 'uploads/thumb_11902374_888497664564926_607722992378629735_n_1021058105.jpg'),
(13, 'uploads/thumb_download (1)_435481626.jpg'),
(16, 'uploads/thumb_11207698_948566821855108_1018856523_o_752539790.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `Role_id` int(11) NOT NULL,
  `Menu_Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `Role_id`, `Menu_Content`) VALUES
(1, 2, '<ul class=" w3-black w3-xlarge">  <li class="w3-green"><a href="Home.php">Home</a></li>  <li class="w3-hover-green"><a href="#">Offers</a></li>  <li class="w3-hover-green"><a href="#">Company</a></li>  <li class="w3-hover-green"><a href="#">Contact</a></li>    <div class="w3-right w3-padding-right " style="width:50%; ">  '),
(2, 1, '<ul class=" w3-black w3-xlarge">  <li class="w3-green"><a href="Home.php">Home</a></li>  <li class="w3-hover-green"><a href="#">Offers</a></li>  <li class="w3-hover-green"><a href="#">Company</a></li>  <li class="w3-hover-green"><a href="#">Contact</a></li>\r\n  <li class="w3-hover-green" style="width:150px;"><a href="AdminPanel.php">Admin Panel</a></li>\r\n    <div class="w3-right w3-padding-right " style="width:50%; ">  '),
(3, 3, '<ul class=" w3-black w3-xlarge">  <li class="w3-green"><a href="Home.php">Home</a></li>  <li class="w3-hover-green"><a href="#">Offers</a></li>  <li class="w3-hover-green"><a href="#">Company</a></li>  <li class="w3-hover-green"><a href="#">Contact</a></li>    <div class="w3-right w3-padding-right " style="width:50%; "> <div class="log w3-right w3-padding-right">      <li class="w3-hover-green"><a href="LoginForm.php">Login</a></li>      <li class="w3-hover-green"><a href="Register.html">Sign up</a></li>  </div></ul></div> ');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `Ticket_id` int(11) NOT NULL,
  `Flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `Flight_id` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `Flight_id`, `Amount`, `Price`, `Class_id`) VALUES
(1, 1, 20, 2000, 1),
(2, 1, 32, 500, 2),
(3, 2, 95, 1000, 1),
(4, 2, 15, 1500, 2),
(5, 3, 100, 2500, 1),
(6, 3, 10, 1900, 2),
(7, 4, 20, 1000, 1),
(8, 4, 10, 1500, 2),
(17, 9, 20, 1000, 1),
(18, 9, 10, 1500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `FLight_Type_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Class_id` int(11) NOT NULL,
  `SeatNum` int(11) NOT NULL,
  `Total_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travelclass`
--

CREATE TABLE `travelclass` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travelclass`
--

INSERT INTO `travelclass` (`id`, `Name`, `Description`) VALUES
(1, 'Economic', 'Economic class'),
(2, 'Business', 'Business class');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Adress` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Role_id` int(11) NOT NULL,
  `Image_id` int(11) NOT NULL,
  `Country_id` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserName`, `Password`, `Age`, `Email`, `Adress`, `Phone`, `Gender`, `Role_id`, `Image_id`, `Country_id`, `Fname`, `Lname`, `active`) VALUES
(2, '2', '2', 21, 'Khalid_legend95@mail.com', '4st nsar shubra', '01151812346', 'Male', 1, 13, 1, 'Khalid', 'Mohamed', 1),
(3, 'helloWorld', '123456789', 20, 'abobakr.sokarno20@gmail.com', '197-s , Remaya plaza', '1145599095', 'Male', 2, 16, 1, 'abobakr', 'sokarno', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Country_id` (`Country_id`),
  ADD KEY `Image_id` (`Image_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Orgin_airport_id` (`Orgin_airport_id`),
  ADD KEY `Dist_airport_id` (`Dist_airport_id`),
  ADD KEY `Aircraft_id` (`Aircraft_id`);

--
-- Indexes for table `flight_type`
--
ALTER TABLE `flight_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Role_id` (`Role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ticket_id` (`Ticket_id`),
  ADD KEY `Flight_id` (`Flight_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Flight_id` (`Flight_id`),
  ADD KEY `Class_id` (`Class_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Class_id` (`Class_id`),
  ADD KEY `FLight_Type_id` (`FLight_Type_id`);

--
-- Indexes for table `travelclass`
--
ALTER TABLE `travelclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Role_id` (`Role_id`),
  ADD KEY `Image_id` (`Image_id`),
  ADD KEY `Country_id` (`Country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `flight_type`
--
ALTER TABLE `flight_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travelclass`
--
ALTER TABLE `travelclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `airport`
--
ALTER TABLE `airport`
  ADD CONSTRAINT `air_contry` FOREIGN KEY (`Country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `air_img` FOREIGN KEY (`Image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `dis_air` FOREIGN KEY (`Dist_airport_id`) REFERENCES `airport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flight_aircraft` FOREIGN KEY (`Aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `or_sir` FOREIGN KEY (`Orgin_airport_id`) REFERENCES `airport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `Menu_role` FOREIGN KEY (`Role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `Route` FOREIGN KEY (`Flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ticket_routes` FOREIGN KEY (`Ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seat_class` FOREIGN KEY (`Class_id`) REFERENCES `travelclass` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_flight` FOREIGN KEY (`Flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `Flight_Class` FOREIGN KEY (`Class_id`) REFERENCES `travelclass` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Flight_user` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ticket_type` FOREIGN KEY (`FLight_Type_id`) REFERENCES `flight_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `CONTRYKEY` FOREIGN KEY (`Country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IMAGEKEY` FOREIGN KEY (`Image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ROLEKEY` FOREIGN KEY (`Role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
