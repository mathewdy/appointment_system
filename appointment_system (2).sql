-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 04:24 PM
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
  `users_id` int(20) NOT NULL,
  `name_of_secretary` varchar(20) DEFAULT NULL,
  `patients_id` int(11) NOT NULL,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `appointment_time`, `users_id`, `name_of_secretary`, `patients_id`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(17, '2021-10-13', '9:00am - 9:30am', 2, NULL, 1, '2021-10-12 06:47:43', '2021-10-12 06:47:43', 'Pending Appointment');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_details`
--

CREATE TABLE `doctors_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
(1, 2, 'Allergy and immunology', 0x36373330313033355f323234313038303930393334373538315f343931313736353236303136303939313233325f6e2e6a7067, '123123', 'up pgh', 'up pgh', 'maxicare', 0x6d61746865772e706e67, '2021-10-12 06:04:39', '2021-10-12 06:04:39', NULL);

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
  `v_code` varchar(20) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_update` datetime DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `email`, `password`, `first_name`, `last_name`, `age`, `gender`, `date_of_birth`, `mobile_number`, `v_code`, `email_status`, `date_time_created`, `date_time_update`, `remarks`) VALUES
(1, 'cmdyzxcvbnm123@gmail.com', '123', 'mathew', 'dy', 18, 'male', '2020-01-10', '+639155334777', 'b7a782741f667201b548', 1, '2021-10-12 06:09:32', '2021-10-12 06:09:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `hmo` varchar(30) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `patient_id`, `hmo`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, 1, 'maxicare', '2021-10-12 06:09:32', '2021-10-12 06:09:32', NULL);

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
  `account_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `v_code` varchar(20) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_time_updated` datetime DEFAULT current_timestamp(),
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_or_secretary`, `email`, `account_id`, `first_name`, `last_name`, `age`, `gender`, `date_of_birth`, `mobile_number`, `v_code`, `email_status`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, 'secretary', 'mathewdalisay@gmail.com', '4325422', 'mathew', 'dalisay', 2, 'male', '2020-02-20', '+639156915704', 'b7a782741f667201b548', 1, '2021-10-12 05:59:25', '2021-10-12 05:59:25', NULL),
(2, 'doctor', 'leonidafrancisco12@gmail.com', '3776492', 'nida', 'francisco', 18, 'female', '2021-10-05', '+639614507751', 'b7a782741f667201b548', 0, '2021-10-12 06:01:30', '2021-10-12 06:01:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_id`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, 1, '2021-10-12 05:59:25', '2021-10-12 05:59:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`users_id`,`patients_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `patients_id` (`patients_id`);

--
-- Indexes for table `doctors_details`
--
ALTER TABLE `doctors_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctors_details`
--
ALTER TABLE `doctors_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors_details`
--
ALTER TABLE `doctors_details`
  ADD CONSTRAINT `doctors_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
