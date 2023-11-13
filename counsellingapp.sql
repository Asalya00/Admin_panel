-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2023 at 05:31 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counsellingapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin@example.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `PaitentID` varchar(50) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_email` varchar(100) NOT NULL,
  `DoctorID` varchar(50) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_start_time` time NOT NULL,
  `appointment_end_time` time NOT NULL,
  `appointment_reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `PaitentID`, `patient_name`, `patient_email`, `DoctorID`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `appointment_reason`) VALUES
(1, '0000000001', 'asdf', 'gunarathneasalya95@gmail.com', '0', '2023-10-04', '15:48:00', '16:49:00', 'qqqqqqqqqqqqqqqqqqqqqq'),
(2, '0000000001', 'asdf', 'gunarathneasalya95@gmail.com', '0', '2023-10-19', '04:10:00', '05:10:00', 'jjjjjjjjjjjjjjjjjjjjjjjj'),
(3, '0000000001', 'asdf', 'gunarathneasalya95@gmail.com', '0', '2023-10-25', '04:13:00', '05:13:00', 'nnnnnnnnnnnnnn'),
(4, '0000000001', 'asdf', 'gunarathneasalya95@gmail.com', '0', '2023-10-12', '15:17:00', '17:14:00', 'nnnnnnnnnnnnn'),
(5, '0000000001', 'asdf', 'gunarathneasalya95@gmail.com', '0', '2023-10-20', '18:18:00', '19:18:00', 'hhhhhhhhhhhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `age` int DEFAULT NULL,
  `gender` enum('Male','Female','Other','') DEFAULT NULL,
  `therapy_type` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `experience` text,
  `quote` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `email`, `name`, `password`, `age`, `gender`, `therapy_type`, `whatsapp`, `facebook`, `experience`, `quote`, `profile_photo`, `confirm_password`) VALUES
('0000000002', 'gunarathne@gmail.com', 'asalya', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/0000000002Doctorpng', NULL),
('0000000001', 'gunarathneasalya95@gmail.com', 'PIG', '88e81740471c79f558cbaefae0d36cb2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/0000000001Doctorpng', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `therapistquiz`
--

DROP TABLE IF EXISTS `therapistquiz`;
CREATE TABLE IF NOT EXISTS `therapistquiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('1','2','3') NOT NULL,
  `diplomadegree` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `yearsfordegree` int NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `counsellor` varchar(255) NOT NULL,
  `counsellortrainyears` int NOT NULL,
  `psychiatrist` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `psychiatristtrainyears` int NOT NULL,
  `experience` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483647 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `therapistquiz`
--

INSERT INTO `therapistquiz` (`id`, `name`, `age`, `email`, `role`, `diplomadegree`, `university`, `yearsfordegree`, `speciality`, `qualifications`, `counsellor`, `counsellortrainyears`, `psychiatrist`, `psychiatristtrainyears`, `experience`) VALUES
(34, 'Mksdel ket', 90, 'mahela100@gmail.com', '1', 'rrey', 'tewwt', 5, 'Forensic psychiatry, General psychiatry', 'fdhtyr fdhser', 'Yes', 5, 'Yes', 9, 'fre  reyer'),
(345, 'dafk', 54, 'mahela100@gmail.com', '2', 'kfsgl rtwr', 'ksg rt', 5, 'Liaison psychiatry, Medical psychotherapy', 'ertf r', 'Yes', 9, 'Yes', 9, 'sgnrse '),
(567, 'ABC', 65, 'Kamal@gmail.com', '2', 'hkhkj', 'uiyiy', 5, 'Child and adolescent psychiatry, Liaison psychiatry', 'no', 'Yes', 8, 'Yes', 50, 'no'),
(675, 'mkrmhkfdh', 44, 'mahela100@gmail.com', '2', 'ryett', 'ertrhfh', 5, 'Forensic psychiatry, General psychiatry', 'NO', 'Yes', 5, 'Yes', 5, 'No'),
(678, 'jkgj ajdglr', 33, 'mahela100@gmail.com', '1', 'krtjklr atkl', 'ewkt;le ewtk', 4, 'Liaison psychiatry, Old age psychiatry, Psychiatry of intellectual disability', 'tklrje rketjl', 'Yes', 3, 'No', 5, 'kjtlret ektjq'),
(98527, 'dafk', 22, 'mahela100@gmail.com', '1', 'hkhkj', 'ewkt;le ewtk', 4, 'Forensic psychiatry, Liaison psychiatry', 'fdhtyr fdhser', 'Yes', 4, 'Yes', 4, 'kjtlret ektjq'),
(2147483647, 'ddddddddddddddddd', 22, 'gunarathneasalya95@gmail.com', '2', 'dddddddddddddddd', 'dddddddddddddddd', 4, 'General psychiatry, Liaison psychiatry', 'dddddddddddddd', 'Yes', 4, 'Yes', 4, 'dddddddddddddddddddd');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_start_time` time NOT NULL,
  `appointment_end_time` time NOT NULL,
  `appointment_day` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `user_id`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `appointment_day`, `created_at`) VALUES
(1, '123', '2023-08-08', '11:31:00', '00:00:00', 'Tuesday', '2023-08-09 10:52:52'),
(2, '123', '2023-08-01', '09:59:00', '00:00:00', 'Tuesday', '2023-08-09 10:59:38'),
(3, '123', '2023-08-08', '10:06:00', '00:00:00', 'Tuesday', '2023-08-09 11:06:09'),
(4, '0000000006', '2023-08-09', '21:23:00', '22:23:00', 'Wednesday', '2023-08-10 10:23:44'),
(5, '0000000006', '1998-03-22', '04:10:00', '05:10:00', 'Sunday', '2023-08-20 16:03:46'),
(6, '0000000001', '2023-10-08', '02:31:00', '03:31:00', 'Sunday', '2023-10-18 09:01:26'),
(7, '0000000001', '2023-10-23', '03:13:00', '04:12:00', 'Monday', '2023-10-18 09:42:42'),
(8, '0000000001', '2023-10-30', '03:19:00', '04:18:00', 'Monday', '2023-10-18 09:48:10'),
(9, '0000000001', '2023-10-16', '04:24:00', '05:24:00', 'Monday', '2023-10-18 09:54:14'),
(10, '0000000001', '2023-10-27', '16:36:00', '17:36:00', 'Friday', '2023-10-18 10:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `gender`, `image`) VALUES
(3, 'Asalya', 'Dissanayake', 'gunarathneasalya95@gmail.com', '$2y$10$7kC1FtjAt2m4mjwm8g9m/OdgHlVQ/JA0HPOJ2vveTDS47d1kOSZJi', 'female', 'uploads/Screenshot (127).png'),
(2, 'Mahela', 'Dissanayake', '2021t01206@stu.cmb.ac.lk', '$2y$10$5lxj0eXKm/wbmqvk.OcpcOX30xUmOh.6Ugk5tXnRqnscAcjtWNa1y', 'female', 'uploads/Screenshot (127).png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
