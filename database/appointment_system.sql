-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 12:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
  `account_id` int(50) NOT NULL,
  `name_of_doctor` varchar(50) NOT NULL,
  `name_of_secretary` varchar(20) DEFAULT NULL,
  `patient_id` int(20) NOT NULL,
  `name_of_patient` varchar(50) NOT NULL,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `appointment_time`, `account_id`, `name_of_doctor`, `name_of_secretary`, `patient_id`, `name_of_patient`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(40, '2021-12-14', '10:00:00 AM', 202169979, 'dorothy jean', NULL, 2020663606, 'mathew dy', '2021-11-30 03:35:48', '2021-11-30 03:35:48', 'Pending Appointment');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_history`
--

CREATE TABLE `appointment_history` (
  `id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(50) NOT NULL,
  `account_id` int(50) NOT NULL,
  `name_of_doctor` varchar(50) NOT NULL,
  `name_of_secretary` varchar(50) DEFAULT NULL,
  `patient_id` int(20) NOT NULL,
  `name_of_patient` varchar(50) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 202169979, 'Allergy and immunology', 0x436170747572652e504e47, '', 'Pgh2', 'Pgh2', 'sample', 0x436170747572652e6a7067, '2021-11-30 03:27:48', '2021-11-30 03:27:48', NULL),
(14, 202172042, 'Anesthesiology', 0x436170747572652e504e47, '', 'Pgh2', 'pgh22', 'sample2', 0x436170747572652e504e47, '2021-12-01 06:52:39', '2021-12-01 06:52:39', NULL),
(15, 202130335, 'Allergy and immunology', 0x3236313738343530385f3931393238373632353635303039385f353939343335393731383836333237313637325f6e2e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x3236313738343530385f3931393238373632353635303039385f353939343335393731383836333237313637325f6e2e6a7067, '2021-12-01 06:53:38', '2021-12-01 06:53:38', NULL),
(16, 202153265, 'Dermatology', 0x3236313738343530385f3931393238373632353635303039385f353939343335393731383836333237313637325f6e2e6a7067, '', 'Pgh2', 'Pgh2', 'sample2', 0x436170747572652e6a7067, '2021-12-01 06:54:22', '2021-12-01 06:54:22', NULL),
(17, 202176252, 'Diagnostic radiology', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'pgh22', 'PhilHealth', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:56:14', '2021-12-01 06:56:14', NULL),
(18, 20218324, 'Emergency medicine', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'PhilHealth', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:56:55', '2021-12-01 06:56:55', NULL),
(19, 202190221, 'Emergency medicine', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'PhilHealth', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:57:28', '2021-12-01 06:57:28', NULL),
(20, 202131476, 'Family medicine', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:58:06', '2021-12-01 06:58:06', NULL),
(21, 202127466, 'Medical genetics', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'PhilHealth', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:58:44', '2021-12-01 06:58:44', NULL),
(22, 202134444, 'Nuclear medicine', 0x3236313738343530385f3931393238373632353635303039385f353939343335393731383836333237313637325f6e2e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:59:14', '2021-12-01 06:59:14', NULL),
(23, 202136533, 'Surgery', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 06:59:49', '2021-12-01 06:59:49', NULL),
(24, 202176604, 'Ophthalmology', 0x436170747572652e504e47, '', 'Pgh2', 'Pgh2', 'sampl6', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 07:03:58', '2021-12-01 07:03:58', NULL),
(25, 202136878, 'Pediatrics', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 07:04:31', '2021-12-01 07:04:31', NULL),
(26, 202122812, 'Radiation oncology', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '', 'Pgh2', 'Pgh2', 'sample', 0x616c742d356165383932363131626631612d353136382d31343732383332303136663235303966333838393236363332333033396133334031782e6a7067, '2021-12-01 07:05:03', '2021-12-01 07:05:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `hmo` varchar(20) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `v_code` varchar(255) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `email`, `password`, `first_name`, `last_name`, `age`, `gender`, `date_of_birth`, `mobile_number`, `hmo`, `patient_id`, `v_code`, `email_status`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(88, 'mathewdalisay@gmail.com', '123456', 'mathew', 'dy', 222, 'Male', '2021-11-17', '+639156915704', 'PhilHealth', 2020663606, 'b7a782741f667201b548', 1, '2021-11-30 02:32:35', '2021-11-30 02:32:35', NULL),
(89, 'patient1@gmail.com', '12345', 'patient1', 'patient1', 22, 'Male', '2022-01-04', '+639156915704', 'sample', 2020978765, 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 07:10:06', '2021-12-01 07:10:06', NULL);

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
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `v_code` varchar(255) NOT NULL,
  `email_status` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_time_updated` datetime DEFAULT current_timestamp(),
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_or_secretary`, `email`, `account_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `mobile_number`, `v_code`, `email_status`, `date_time_created`, `date_time_updated`, `remarks`) VALUES
(18, 'doctor', 'melendez@gmail.com', 202169979, 'dorothy', 'jean', 'Female', '2021-11-11', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-11-30 15:27:48', '2021-11-30 15:27:48', NULL),
(19, 'secretary', 'melendezdj@gmail.com', 2021689226, 'melendez', 'dj', 'Male', '2021-12-01', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-11-30 03:40:03', '2021-11-30 03:40:03', NULL),
(20, 'doctor', 'doctor1@gmail.com', 202172042, 'doctor1', 'doctor2', 'Female', '2021-12-06', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:52:39', '2021-12-01 18:52:39', NULL),
(21, 'doctor', 'doctor2@gmail.com', 202130335, 'doctor2', 'doctor2', 'Male', '2021-12-15', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 18:53:38', '2021-12-01 18:53:38', NULL),
(22, 'doctor', 'doctor3@gmail.com', 202153265, 'doctor3', 'doctor3', 'Female', '2021-12-06', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:54:22', '2021-12-01 18:54:22', NULL),
(23, 'doctor', 'doctor4@gmail.com', 202176252, 'doctor4', 'doctor4', 'Female', '2021-12-13', '+639176059359', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:56:14', '2021-12-01 18:56:14', NULL),
(24, 'doctor', 'doctor5@gmail.com', 20218324, 'doctor5', 'doctor5', 'Female', '2021-12-07', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 18:56:55', '2021-12-01 18:56:55', NULL),
(25, 'doctor', 'doctor6@gmail.com', 202190221, 'doctor6', 'doctor6', 'Male', '2021-12-06', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:57:28', '2021-12-01 18:57:28', NULL),
(26, 'doctor', 'doctor7@gmail.com', 202131476, 'doctor7', 'doctor7', 'Male', '2021-12-01', '+639176059359', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:58:06', '2021-12-01 18:58:06', NULL),
(27, 'doctor', 'doctor8@gmail.com', 202127466, 'doctor8', 'doctor8', 'Male', '2021-12-07', '+639176059359', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:58:44', '2021-12-01 18:58:44', NULL),
(28, 'doctor', 'doctor9@gmail.com', 202134444, 'doctor9', 'doctor9', 'Female', '2021-12-06', '+639176059359', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 18:59:14', '2021-12-01 18:59:14', NULL),
(29, 'doctor', 'doctor10@gmail.com', 202136533, 'doctor10', 'doctor10', 'Female', '2021-12-07', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 18:59:49', '2021-12-01 18:59:49', NULL),
(30, 'doctor', 'doctor11@gmail.com', 202176604, 'doctor11', 'doctor11', 'Female', '2021-12-15', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 19:03:58', '2021-12-01 19:03:58', NULL),
(31, 'doctor', 'doctor12@gmail.com', 202136878, 'doctor12', 'doctor12', 'Male', '2021-12-07', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 19:04:31', '2021-12-01 19:04:31', NULL),
(32, 'doctor', 'doctor13@gmail.com', 202122812, 'doctor13', 'doctor13', 'Female', '2021-12-06', '+639156915704', 'fa246d0262c3925617b0c72bb20eeb1d', 1, '2021-12-01 19:05:03', '2021-12-01 19:05:03', NULL),
(33, 'secretary', 'secretary1@gmail.com', 2021349732, 'secretary1', 'secretary1', 'Male', '2021-12-09', '+639156915704', 'b7a782741f667201b54880c925faec4b', 1, '2021-12-01 07:06:49', '2021-12-01 07:06:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_history`
--
ALTER TABLE `appointment_history`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `appointment_history`
--
ALTER TABLE `appointment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors_details`
--
ALTER TABLE `doctors_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors_details`
--
ALTER TABLE `doctors_details`
  ADD CONSTRAINT `doctors_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
