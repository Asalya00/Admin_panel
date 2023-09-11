-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2023 at 03:27 PM
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
  `appointment_time` time NOT NULL,
  `appointment_reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=98528 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `therapistquiz`
--

INSERT INTO `therapistquiz` (`id`, `name`, `age`, `email`, `role`, `diplomadegree`, `university`, `yearsfordegree`, `speciality`, `qualifications`, `counsellor`, `counsellortrainyears`, `psychiatrist`, `psychiatristtrainyears`, `experience`) VALUES
(34, 'Mksdel ket', 90, 'mahela100@gmail.com', '1', 'rrey', 'tewwt', 5, 'Forensic psychiatry, General psychiatry', 'fdhtyr fdhser', 'Yes', 5, 'Yes', 9, 'fre  reyer'),
(345, 'dafk', 54, 'mahela100@gmail.com', '2', 'kfsgl rtwr', 'ksg rt', 5, 'Liaison psychiatry, Medical psychotherapy', 'ertf r', 'Yes', 9, 'Yes', 9, 'sgnrse '),
(567, 'ABC', 65, 'Kamal@gmail.com', '2', 'hkhkj', 'uiyiy', 5, 'Child and adolescent psychiatry, Liaison psychiatry', 'no', 'Yes', 8, 'Yes', 50, 'no'),
(675, 'mkrmhkfdh', 44, 'mahela100@gmail.com', '2', 'ryett', 'ertrhfh', 5, 'Forensic psychiatry, General psychiatry', 'NO', 'Yes', 5, 'Yes', 5, 'No'),
(678, 'jkgj ajdglr', 33, 'mahela100@gmail.com', '1', 'krtjklr atkl', 'ewkt;le ewtk', 4, 'Liaison psychiatry, Old age psychiatry, Psychiatry of intellectual disability', 'tklrje rketjl', 'Yes', 3, 'No', 5, 'kjtlret ektjq'),
(98527, 'dafk', 22, 'mahela100@gmail.com', '1', 'hkhkj', 'ewkt;le ewtk', 4, 'Forensic psychiatry, Liaison psychiatry', 'fdhtyr fdhser', 'Yes', 4, 'Yes', 4, 'kjtlret ektjq');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `user_id`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `appointment_day`, `created_at`) VALUES
(1, '123', '2023-08-08', '11:31:00', '00:00:00', 'Tuesday', '2023-08-09 10:52:52'),
(2, '123', '2023-08-01', '09:59:00', '00:00:00', 'Tuesday', '2023-08-09 10:59:38'),
(3, '123', '2023-08-08', '10:06:00', '00:00:00', 'Tuesday', '2023-08-09 11:06:09'),
(4, '0000000006', '2023-08-09', '21:23:00', '22:23:00', 'Wednesday', '2023-08-10 10:23:44'),
(5, '0000000006', '1998-03-22', '04:10:00', '05:10:00', 'Sunday', '2023-08-20 16:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `age`, `gender`, `therapy_type`, `whatsapp`, `facebook`, `experience`, `quote`, `profile_photo`, `confirm_password`) VALUES
('0000000001', 'abcd@abcd', 'abcd', 'e2fc714c4727ee9395f324cd2e7f331f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0000000002', 'asdf@asdf', 'asdf', '912ec803b2ce49e4a541068d495ab570', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0000000003', 'lkjh@lkjh', 'lkjh', 'd41d8cd98f00b204e9800998ecf8427e', 22, 'Male', 'dsklg wtlk', 'ewtk wetk;w', 'ewtk wetk;wet', 'ewkt wltkw ewkt kw tkwe tew twektlwe ', 'ettlekl; wwel', NULL, 'lkjh'),
('0000000006', 'mahela100@gmail.com', 'Mahela Dissanayake', 'e1aa512c96b6eb0678c5483c481e463f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/0000000006.jpg', NULL),
('0000000005', 'tyr@rter', 'MMM', '8e293ae27f2c8c8663f868e9facc14d4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/0000000005.jpg', NULL);
COMMIT;


-- Create a table to store admin credentials
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

-- Insert an example admin account (replace with your actual values)
INSERT INTO `admins` (`email`, `username`, `password`) VALUES
    ('admin@example.com', 'admin', 'admin'); -- Hashed password
