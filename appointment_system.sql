-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 08:22 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `name_of_doctor` varchar(50) NOT NULL,
  `name_of_secretary` varchar(20) DEFAULT NULL,
  `name_of_patient` varchar(50) NOT NULL,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `appointment_time`, `user_id`, `name_of_doctor`, `name_of_secretary`, `name_of_patient`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, '2021-11-10', '9:00am - 9:30am', 738047, 'nida franciso', 'dorothy melendez', 'mathew dalisay', '2021-11-06 08:20:52', '2021-11-06 08:20:52', 'Pending Appointment'),
(2, '2021-11-09', '9:00am - 9:30am', 738047, 'nida franciso', NULL, 'mathew dalisay', '2021-11-06 08:22:40', '2021-11-06 08:22:40', 'Pending Appointment'),
(3, '2021-11-09', '9:00am - 9:30am', 738047, 'nida franciso', NULL, 'mathew dalisay', '2021-11-06 08:23:06', '2021-11-06 08:23:06', 'Pending Appointment'),
(4, '2021-11-06', '9:00am - 9:30am', 738047, 'nida franciso', NULL, 'mathew dalisay', '2021-11-06 08:24:35', '2021-11-06 08:24:35', 'Pending Appointment'),
(7, '2021-11-13', '4:00pm - 4:30pm', 738047, 'nida franciso', NULL, 'mathew dalisay', '2021-11-06 08:30:07', '2021-11-06 08:30:07', 'Pending Appointment'),
(8, '1970-01-01', '9:00am - 9:30am', 738047, 'nida franciso', 'dorothy melendez', 'mathew dalisay', '2021-11-06 09:35:03', '2021-11-06 09:35:03', 'Pending Appointment'),
(9, '2021-11-11', '9:00am - 9:30am', 738047, 'nida franciso', 'dorothy melendez', 'mathew dalisay', '2021-11-06 09:40:19', '2021-11-06 09:40:19', 'Pending Appointment');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_details`
--

CREATE TABLE `doctors_details` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `specialization` varchar(30) NOT NULL,
  `prc_id` blob NOT NULL,
  `prc_number` varchar(10) NOT NULL,
  `internship` varchar(20) NOT NULL,
  `residency` varchar(20) NOT NULL,
  `hmo` varchar(20) NOT NULL,
  `doc_picture` blob NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_details`
--

INSERT INTO `doctors_details` (`id`, `user_id`, `specialization`, `prc_id`, `prc_number`, `internship`, `residency`, `hmo`, `doc_picture`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(5, 738047, 'Allergy and immunology', 0x5048494c2049442e706e67, '5555', 'Pgh', 'Pgh', 'maxicare', 0x43617074757265202839292e6a7067, '2021-11-06 08:10:31', '2021-11-06 08:10:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `hmo` varchar(20) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `v_code` varchar(20) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `email`, `password`, `first_name`, `last_name`, `age`, `gender`, `date_of_birth`, `mobile_number`, `hmo`, `patient_id`, `v_code`, `email_status`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(6, 'mathewdalisay@gmail.com', '123', 'mathew', 'dalisay', 21, 'male', '2000-10-01', '+639156915704', 'maxicare', 999999, 'b7a782741f667201b548', 1, '2021-11-06 07:51:47', '2021-11-06 07:51:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `number_of_patients` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `number_of_patients`, `appointment_date`, `user_id`, `mobile_number`) VALUES
(1, 1, '2021-11-06', 738047, '+63614507751'),
(2, 1, '2021-11-06', 738047, '+63614507751'),
(3, 1, '2021-11-06', 738047, '+63614507751'),
(4, 1, '2021-11-06', 738047, '+63614507751'),
(5, 1, '2021-11-06', 738047, '+639156915704'),
(6, 1, '2021-11-06', 738047, '+639614507751');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `doctor_or_secretary` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `account_id` int(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `v_code` varchar(50) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_time_updated` datetime DEFAULT current_timestamp(),
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_or_secretary`, `email`, `account_id`, `first_name`, `last_name`, `age`, `gender`, `date_of_birth`, `mobile_number`, `v_code`, `email_status`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(7, 'doctor', 'leonidafrancisco12@gmail.com', 738047, 'nida', 'franciso', 63, 'female', '1956-04-06', '+639614507751', 'fa246d0262c3925617b0c72bb20eeb1d', 0, '2021-11-06 08:08:29', '2021-11-06 08:08:29', NULL),
(8, 'secretary', 'mathewmelendez123123123@gmail.com', 123, 'dorothy', 'melendez', 28, 'female', '1992-02-20', '+639176059359', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-11-06 08:18:51', '2021-11-06 08:18:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_id`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(2, 123, '2021-11-06 08:18:51', '2021-11-06 08:18:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_details`
--
ALTER TABLE `doctors_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors_details`
--
ALTER TABLE `doctors_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors_details`
--
ALTER TABLE `doctors_details`
  ADD CONSTRAINT `doctors_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
