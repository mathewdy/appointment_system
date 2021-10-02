-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 06:39 PM
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
  `id_doctor` varchar(20) NOT NULL,
  `name_of_secretary` varchar(20) DEFAULT NULL,
  `name_of_patient` varchar(20) NOT NULL,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `appointment_time`, `id_doctor`, `name_of_secretary`, `name_of_patient`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, '2021-09-16', '9:00am - 9:30am', '1', 'samplesecretary', 'mathew da', '2021-09-15 10:01:10', '2021-09-29 10:51:55', 'Patient Arrived'),
(6, '0000-00-00', '12:00pm - 12:30pm', '1', NULL, 'mathew dalisay', '2021-09-29 03:53:32', NULL, 'Pending Appointment'),
(7, '2021-09-30', '9:00am - 9:30am', '1', 'sample secretary', 'mathew dalisay', '2021-09-29 03:55:09', NULL, 'Pending Appointment'),
(8, '2021-09-30', '9:00am - 9:30am', '1', NULL, 'mathew dalisay', '2021-09-29 04:02:38', NULL, 'Pending Appointment'),
(9, '2021-10-13', '9:00am - 9:30am', '1', NULL, 'mathew dalisay', '2021-09-29 04:03:05', NULL, 'Pending Appointment'),
(10, '2021-09-30', '9:00am - 9:30am', '3', NULL, 'mathew dalisay', '2021-09-29 04:43:00', NULL, 'Pending Appointment'),
(11, '2021-09-30', '9:00am - 9:30am', '3', NULL, 'mathew dalisay', '2021-09-29 04:43:03', NULL, 'Pending Appointment');

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
  `terms_agreement` varchar(20) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_details`
--

INSERT INTO `doctors_details` (`id`, `user_id`, `specialization`, `prc_id`, `prc_number`, `internship`, `residency`, `hmo`, `doc_picture`, `terms_agreement`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(1, 1, 'Allergy and immunology', 0x3234313439303037365f313435383939363538313134393932325f383737323433383632313730393736353732325f6e2e6a7067, '789945', 'pgh', 'pgh', 'maxicare', 0x436170747572652e504e47, 'agree', '2021-09-10 04:34:12', NULL, NULL),
(2, 3, 'Allergy and immunology', 0x3234313439303037365f313435383939363538313134393932325f383737323433383632313730393736353732325f6e2e6a7067, '123', 'pgh', 'pgh', 'pgh', 0x436170747572652e504e47, 'agree', '2021-09-10 04:41:00', NULL, NULL);

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
(1, 'mathewdalisay@gmail.com', '123', 'mathew', 'dalisay', 19, 'male', '2200-02-20', '+639614507751', 'b7a782741f667201b548', 1, '2021-09-10 04:30:47', NULL, NULL),
(2, 'patient2@gmail.com', '123', 'patient fm', 'patient lm', 18, 'male', '2021-09-08', '09176059359', 'asdfghjk', 1, '2021-09-10 12:02:42', '2021-09-10 12:02:42', NULL);

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
(1, 1, 'maxicare', '2021-09-10 04:30:47', NULL, NULL),
(2, 2, 'maxicare', '2021-09-10 12:03:17', '2021-09-10 12:03:17', NULL);

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

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `number_of_patients`, `appointment_date`, `id_doctor`, `mobile_number`) VALUES
(1, 2, '2021-09-30', 3, '09176059359'),
(2, 2, '2021-09-30', 3, '09176059359'),
(3, 2, '2021-09-30', 1, '09156915704'),
(4, 2, '2021-09-30', 1, '09156915704'),
(5, 1, '2021-10-13', 1, '09156915704');

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
(1, 'doctor', 'leonidafrancisco12@gmail.com', '4805883', 'nida', 'francisco', 28, 'female', '2000-02-20', '09156915704', 'fa246d0262c3925617b0', 1, '2021-09-10 04:33:42', NULL, NULL),
(2, 'secretary', 'samplesec@gmail.com', '2442531', 'sample', 'secretary', 18, 'female', '2020-02-20', '09176059359', 'b7a782741f667201b548', 1, '2021-09-10 04:40:01', NULL, NULL),
(3, 'doctor', 'doctor2@gmail.com', '2024897', 'doctro2', 'doctro2', 18, 'male', '2000-02-20', '09176059359', 'fa246d0262c3925617b0', 1, '2021-09-10 04:40:36', NULL, NULL),
(4, 'doctor', 'ads@gmail.com', '123123', 'mama', 'moto', 18, 'male', '2021-09-08', '09176059359', 'asdfghjkl', 1, '2021-09-15 07:04:24', '2021-09-15 07:04:24', NULL);

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
(1, 2, '2021-09-10 04:40:01', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctors_details`
--
ALTER TABLE `doctors_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
