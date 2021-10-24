-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 09:25 AM
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
  `users_id` int(50) NOT NULL,
  `name_of_secretary` varchar(20) DEFAULT NULL,
  `patients_id` int(50) NOT NULL,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `appointment_time`, `users_id`, `name_of_secretary`, `patients_id`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(16, '2021-10-28', '9:00am - 9:30am', 73070542, 'fghj fgh', 2147483647, '2021-10-23 03:15:58', '2021-10-23 03:15:58', 'Pending Appointment'),
(17, '2021-10-27', '9:00am - 9:30am', 73070542, 'fghj fgh', 2147483647, '2021-10-23 03:19:15', '2021-10-23 03:19:15', 'Pending Appointment'),
(27, '2021-10-27', '9:00am - 9:30am', 73070542, NULL, 2147483647, '2021-10-23 03:35:45', '2021-10-23 03:35:45', 'Pending Appointment');

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
(1, 73070542, 'Allergy and immunology', 0x7172206b6f2e706e67, '20232', '32', '32', '32', 0x3234363935383834375f3336393532373339313539343038335f343137323230333938313039373131383236325f6e2e706e67, '2021-10-23 02:30:41', '2021-10-23 02:30:41', NULL),
(2, 90385119, 'Allergy and immunology', 0x7172206b6f2e706e67, '32', '13', '21', '321', 0x7172206b6f2e706e67, '2021-10-23 02:31:39', '2021-10-23 02:31:39', NULL);

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
(1, 'sabog@gmail.com', '123', 'asdf', 'dsfasd', 2, 'male', '2020-02-20', '+639176059359', 'asdf', 2147483647, 'fa246d0262c3925617b0', 1, '2021-10-23 02:50:49', '2021-10-23 02:50:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `number_of_patients` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `mobile_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `doctor_or_secretary` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
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
(1, 'doctor', 'mathewdalisay@gmail.com', 73070542, 'mathew', 'dalisay', 2, 'male', '2020-02-20', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 0, '2021-10-23 02:30:18', '2021-10-23 02:30:18', NULL),
(2, 'doctor', 'adfa@gmail.com', 90385119, 'ashley', 'djiafhdjf', 2, 'male', '2020-02-20', '+639156915704', 'b7a782741f667201b54880c925faec4b', 0, '2021-10-23 02:31:24', '2021-10-23 02:31:24', NULL),
(3, 'secretary', 'sad@gmail.com', 123, 'fghj', 'fgh', 2, 'female', '2020-02-20', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-10-23 02:32:06', '2021-10-23 02:32:06', NULL);

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
(1, 123, '2021-10-23 02:32:06', '2021-10-23 02:32:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `patients_id` (`patients_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctors_details`
--
ALTER TABLE `doctors_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `doctors_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
