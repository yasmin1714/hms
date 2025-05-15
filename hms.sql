-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 04:47 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'yasmin@14', '2025-05-09 08:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `doctorSpecialization` varchar(100) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` date DEFAULT NULL,
  `appointmentTime` time DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `userId`, `doctorId`, `doctorSpecialization`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 6, 1, 'ENT', 500, '2024-03-15', '10:30:00', '2024-03-10 03:30:00', 1, 1, '2024-03-11 04:30:00'),
(2, 7, 2, 'Dental Care', 400, '2024-03-16', '11:00:00', '2024-03-11 03:45:00', 1, 1, '2024-03-12 03:15:00'),
(3, 8, 3, 'Neurologist', 700, '2024-03-17', '09:45:00', '2024-03-12 04:50:00', 1, 1, '2024-03-13 04:20:00'),
(4, 1, 4, 'Nephrologists', 350, '2024-03-18', '12:15:00', '2024-03-13 03:00:00', 1, 1, '2024-03-14 02:10:00'),
(5, 2, 5, 'Family Physicians', 600, '2024-03-19', '13:00:00', '2024-03-14 05:30:00', 1, 1, '2024-03-15 04:30:00'),
(6, 3, 6, 'Endocrinologists', 300, '2024-03-20', '14:45:00', '2024-03-15 08:00:00', 1, 1, '2024-03-16 05:30:00'),
(7, 4, 7, 'Dermatologists', 450, '2024-03-21', '15:30:00', '2024-03-16 09:15:00', 1, 1, '2024-03-17 07:00:00'),
(8, 5, 8, 'Critical Care Medicine Specialists', 550, '2024-03-22', '10:00:00', '2024-03-17 09:30:00', 1, 1, '2024-03-18 05:00:00'),
(9, 61, 9, 'Cardiologists', 500, '2024-03-23', '11:30:00', '2024-03-18 03:40:00', 1, 1, '2024-03-19 03:20:00'),
(10, 62, 10, 'Anesthesiologist', 650, '2024-03-24', '09:15:00', '2024-03-19 04:40:00', 1, 1, '2024-03-20 03:30:00'),
(11, 68, 1, '0', 350, '0000-00-00', '03:15:00', '2025-05-11 09:32:01', 0, 1, '2025-05-11 09:33:57'),
(12, 68, 11, '0', 1000, '0000-00-00', '03:15:00', '2025-05-11 09:34:10', 1, 1, '2025-05-11 09:34:10'),
(13, 1, 3, '0', 700, '0000-00-00', '09:45:00', '2025-05-11 16:15:52', 1, 1, '2025-05-11 16:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `appointmentId` int(11) DEFAULT NULL,
  `surgeryId` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `billing_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `appointmentId`, `surgeryId`, `total_amount`, `paid_amount`, `payment_status`, `billing_date`) VALUES
(11, 1, 2, 1500.00, 1500.00, 'Paid', '2024-11-01 05:00:00'),
(12, 2, 3, 2500.00, 1000.00, 'Partially Paid', '2024-11-02 05:30:00'),
(13, 3, 1, 3200.00, 200.00, 'Partial', '2024-11-03 04:15:00'),
(14, 4, 4, 5000.00, 5000.00, 'Paid', '2024-11-04 08:50:00'),
(15, 5, 5, 2200.00, 2000.00, 'Partially Paid', '2024-11-05 09:30:00'),
(16, 6, 2, 1500.00, 1500.00, 'Paid', '2024-11-06 11:00:00'),
(17, 7, 6, 4400.00, 0.00, 'Unpaid', '2024-11-07 07:30:00'),
(18, 8, 3, 2500.00, 2500.00, 'Paid', '2024-11-08 06:45:00'),
(19, 9, 7, 3000.00, 1500.00, 'Partially Paid', '2024-11-09 04:30:00'),
(20, 10, 1, 3200.00, 3200.00, 'Paid', '2024-11-10 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `doctorName` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `docFees` varchar(50) DEFAULT NULL,
  `contactno` bigint(20) DEFAULT NULL,
  `docEmail` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specialization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'Anesthesiologists', 'Dr. Sumanth Shetty', 'Koramangala 1st Block', '350', 7452103689, 'murali@gmail.com', '7a9f886e7fd608a790fe4e88b738c6f1', '2024-01-01 04:30:00', '0000-00-00 00:00:00'),
(2, 'Dental Care', 'Dr. Karthik', 'Kamakshipalya', '1000', 7483968541, 'karthik@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 04:40:00', '2025-05-09 10:36:21'),
(3, 'Neurologists', 'Dr. Chaitra Nayak', '110/4, Neeladri Main Road, Doddathoguru', '700', 8769412503, 'chaitra@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 04:50:00', '2025-05-09 10:36:21'),
(4, 'Nephrologists', 'Dr. Santosh B S', 'Gaurav Building, Manipal County Road', '450', 8574960213, 'santosh@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:00:00', '2025-05-09 10:36:21'),
(5, 'Family Physicians', 'Dr. Archana S', 'Vishal Tower, HSR Layout', '350', 9988774455, 'archana@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:10:00', '2025-05-09 10:36:21'),
(6, 'Endocrinologists', 'Dr. Aditi Garg', 'HSR Layout', '500', 8574960213, 'aditi@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:20:00', '2025-05-09 10:36:21'),
(7, 'Dermatologists', 'Dr. Shilpa', 'Gaurav Building, Manipal County Road', '400', 7475210369, 'shilpa@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:30:00', '2025-05-09 10:36:21'),
(8, 'Critical Care Medicine Specialists', 'Dr. Baswaraj Biradar', '60 Feet Road, D Block', '400', 9847521603, 'baswaraj@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:40:00', '2025-05-09 10:36:21'),
(9, 'Cardiologists', 'Dr. Mohan', 'Kalki Dhyana Mandir, Bangalore', '500', 8769412503, 'mohan@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 05:50:00', '2025-05-09 10:36:21'),
(10, 'Anesthesiologists', 'Dr. Sumanth Shetty', 'Koramangala 1st Block', '300', 7452103689, 'sumanth@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2024-01-01 06:00:00', '2025-05-09 10:36:21'),
(11, 'Physiatrists', 'D.yasmin', '3-226,pantula colony,ap', '1000', 8688432864, 'yasminddg@gmail.com', '598d1a2b310dfc7b0264a4d7c4efe3f2', '2025-05-10 11:39:59', '2025-05-10 11:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(33, 5, 'archana@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 02:45:22', '2024-03-02 08:45:00', 1),
(34, 6, 'aditi@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 03:30:00', NULL, 1),
(35, 6, 'aditi@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 04:00:45', '2024-03-02 10:00:00', 1),
(36, 7, 'shilpa@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 04:45:10', NULL, 1),
(37, 8, 'baswaraj@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 05:15:00', '2024-03-02 11:10:00', 1),
(38, 9, 'mohan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 05:50:00', NULL, 1),
(39, 10, 'sumanth@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 06:05:00', '2024-03-02 12:00:00', 1),
(40, 1, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 06:40:00', NULL, 1),
(41, 2, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-02 07:15:00', '2024-03-02 01:10:00', 1),
(42, 3, 'chaitra@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-01 19:50:00', NULL, 1),
(43, 1, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-09 11:32:50', '09-05-2025 05:03:37 PM', 1),
(44, 6, 'aditi@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-10 09:23:10', '10-05-2025 02:54:19 PM', 1),
(45, 9, 'mohan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-10 13:43:06', '10-05-2025 09:59:56 PM', 1),
(46, 10, 'sumanth@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-10 14:02:52', NULL, 1),
(47, 5, 'archana@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-10 16:30:29', '10-05-2025 10:00:56 PM', 1),
(48, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 15:35:12', '11-05-2025 09:05:48 PM', 1),
(49, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 16:54:04', NULL, 1),
(50, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:03:07', '11-05-2025 10:33:10 PM', 1),
(51, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:04:36', '11-05-2025 10:34:38 PM', 1),
(52, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:05:19', '11-05-2025 10:35:22 PM', 1),
(53, 2, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:06:47', '11-05-2025 10:37:06 PM', 1),
(54, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:12:13', NULL, 0),
(55, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:12:36', NULL, 0),
(56, 8, 'baswaraj@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:13:05', '11-05-2025 10:52:53 PM', 1),
(57, 8, 'baswaraj@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:23:52', '11-05-2025 10:53:54 PM', 1),
(58, 8, 'baswaraj@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:26:01', '11-05-2025 10:56:19 PM', 1),
(59, 2, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:26:40', '11-05-2025 10:56:45 PM', 1),
(60, 2, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 17:46:58', '12-05-2025 12:40:50 AM', 1),
(61, 3, 'chaitra@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:11:58', '12-05-2025 12:42:01 AM', 1),
(62, NULL, 'chaitra@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:12:53', NULL, 0),
(63, NULL, 'chaitra@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:13:06', NULL, 0),
(64, 3, 'chaitra@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:13:17', '12-05-2025 12:45:12 AM', 1),
(65, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:15:50', NULL, 0),
(66, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:15:58', NULL, 0),
(67, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:16:16', NULL, 0),
(68, 2, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:17:01', '12-05-2025 12:47:04 AM', 1),
(69, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:32:59', NULL, 0),
(70, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:33:08', NULL, 0),
(71, NULL, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:33:29', NULL, 0),
(72, NULL, 'karthik@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:33:49', NULL, 0),
(73, 1, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:35:49', '12-05-2025 01:05:51 AM', 1),
(74, 1, 'murali@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:36:37', '12-05-2025 01:17:42 AM', 1),
(75, NULL, 'yasminddg@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:47:54', NULL, 0),
(76, 4, 'santosh@gmail.com', 0x3a3a3100000000000000000000000000, '2025-05-11 19:49:16', '12-05-2025 01:47:18 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specialization`, `creationDate`, `updationDate`) VALUES
(1, 'Gastroenterologists', '2024-01-25 20:34:00', '2025-05-10 10:39:54'),
(30, 'Geriatric Medicine Specialists', '2024-01-25 20:34:10', '2025-05-09 10:38:33'),
(31, 'Hematologists', '2024-01-25 20:34:20', '2025-05-09 10:38:33'),
(32, 'Infectious Disease Specialists', '2024-01-25 20:34:30', '2025-05-09 10:38:33'),
(33, 'Internal Medicine Specialists', '2024-01-25 20:34:40', '2025-05-09 10:38:33'),
(34, 'Medical Geneticists', '2024-01-25 20:34:50', '2025-05-09 10:38:33'),
(35, 'Nuclear Medicine Specialists', '2024-01-25 20:35:00', '2025-05-09 10:38:33'),
(36, 'Obstetricians and Gynecologists (OB/GYNs)', '2024-01-25 20:35:10', '2025-05-09 10:38:33'),
(37, 'Oncologists', '2024-01-25 20:35:20', '2025-05-09 10:38:33'),
(38, 'Ophthalmologists', '2024-01-25 20:35:30', '2025-05-09 10:38:33'),
(39, 'Orthopedic Surgeons', '2024-01-25 20:35:40', '2025-05-09 10:38:33'),
(40, 'Otolaryngologists (ENTs)', '2024-01-25 20:35:50', '2025-05-09 10:38:33'),
(41, 'Pathologists', '2024-01-25 20:36:00', '2025-05-09 10:38:33'),
(42, 'Pediatricians', '2024-01-25 20:36:10', '2025-05-09 10:38:33'),
(43, 'Physiatrists', '2024-01-25 20:36:20', '2025-05-09 10:38:33'),
(44, 'Plastic Surgeons', '2024-01-25 20:36:30', '2025-05-09 10:38:33'),
(45, 'Psychiatrists', '2024-01-25 20:36:40', '2025-05-09 10:38:33'),
(46, 'Pulmonologists', '2024-01-25 20:36:50', '2025-05-09 10:38:33'),
(47, 'Radiologists', '2024-01-25 20:37:00', '2025-05-09 10:38:33'),
(48, 'Rheumatologists', '2024-01-25 20:37:10', '2025-05-09 10:38:33'),
(50, 'Cardiologist', '2025-05-10 10:59:40', '2025-05-10 11:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `provider_name` varchar(100) DEFAULT NULL,
  `policy_number` varchar(100) DEFAULT NULL,
  `coverage_details` text DEFAULT NULL,
  `valid_till` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`id`, `userId`, `provider_name`, `policy_number`, `coverage_details`, `valid_till`) VALUES
(1, 1, 'Max Bupa', 'MBP123456', 'Covers hospitalization up to ₹5,00,000 and critical illnesses.', '2026-12-31'),
(2, 2, 'HDFC ERGO', 'HE789456', 'Includes outpatient and emergency services. ₹3,00,000 coverage.', '2025-11-30'),
(3, 3, 'Star Health', 'SH202304', '₹4,00,000 coverage. Covers maternity and surgery.', '2026-08-15'),
(4, 4, 'ICICI Lombard', 'ICL998877', 'Full coverage for accidental injuries and surgeries.', '2025-05-20'),
(5, 5, 'New India Assurance', 'NIA556677', '₹2,50,000 coverage with 24/7 claim support.', '2027-01-10'),
(6, 6, 'Religare Health', 'RH334455', 'Covers chronic diseases and room rent up to ₹5,000/day.', '2026-09-01'),
(7, 7, 'Bajaj Allianz', 'BA776655', 'Covers up to ₹6,00,000 including day care procedures.', '2025-03-31'),
(8, 8, 'Tata AIG', 'TAIG112233', 'Health and wellness benefits included. ₹4,50,000 limit.', '2026-07-25'),
(9, 9, 'Oriental Insurance', 'OI889900', 'Covers family members. Cashless at network hospitals.', '2025-12-15'),
(10, 10, 'Aditya Birla Health', 'ABH223344', '₹3,00,000 coverage with free health check-ups.', '2026-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `lab_reports`
--

CREATE TABLE `lab_reports` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `report_type` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `created_by_lab` varchar(255) DEFAULT NULL,
  `created_by_admin` int(11) DEFAULT NULL,
  `updated_by_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_reports`
--

INSERT INTO `lab_reports` (`id`, `patient_id`, `report_type`, `result`, `report_date`, `created_by_lab`, `created_by_admin`, `updated_by_admin`) VALUES
(1, 1, 'Blood Test', 'Normal', '2024-11-01', 'SRL Labs', 1, 2),
(2, 2, 'X-Ray', 'Fracture Detected', '2024-11-02', 'Apollo Diagnostics', 2, 2),
(3, 3, 'MRI', 'Clear', '2024-11-03', 'Thyrocare', 1, 3),
(4, 4, 'ECG', 'Irregular', '2024-11-04', 'SRL Labs', 3, 4),
(5, 5, 'Blood Sugar', 'High', '2024-11-05', 'Dr. Lal PathLabs', 1, 1),
(6, 6, 'Urine Test', 'Normal', '2024-11-06', 'Apollo Diagnostics', 2, 2),
(7, 7, 'CT Scan', 'Normal', '2024-11-07', 'Thyrocare', 3, 3),
(8, 8, 'Liver Function Test', 'Slightly Abnormal', '2024-11-08', 'SRL Labs', 2, 1),
(9, 9, 'CBC', 'Normal', '2024-11-09', 'Metropolis Labs', 2, 2),
(10, 10, 'COVID-19 RT-PCR', 'Negative', '2024-11-10', 'Dr. Lal PathLabs', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` bigint(20) DEFAULT NULL,
  `shift_time` varchar(255) DEFAULT NULL,
  `assigned_doctor_id` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`id`, `name`, `email`, `contact_no`, `shift_time`, `assigned_doctor_id`, `creation_date`) VALUES
(1, 'Asha Kumari', 'asha.kumari@nurse.com', 9876543210, 'Morning', 1, '2025-05-10 07:32:33'),
(2, 'Sunita Verma', 'sunita.verma@nurse.com', 9876543211, 'Night', 2, '2025-05-10 07:32:33'),
(3, 'Meena Sharma', 'meena.sharma@nurse.com', 9876543212, 'Evening', 3, '2025-05-10 07:32:33'),
(4, 'Rajni Gupta', 'rajni.gupta@nurse.com', 9876543213, 'Morning', 4, '2025-05-10 07:32:33'),
(5, 'Anita Das', 'anita.das@nurse.com', 9876543214, 'Night', 5, '2025-05-10 07:32:33'),
(6, 'Kavita Singh', 'kavita.singh@nurse.com', 9876543215, 'Morning', 1, '2025-05-10 07:32:33'),
(7, 'Lalita Nair', 'lalita.nair@nurse.com', 9876543216, 'Evening', 2, '2025-05-10 07:32:33'),
(8, 'Deepa Rani', 'deepa.rani@nurse.com', 9876543217, 'Night', 3, '2025-05-10 07:32:33'),
(9, 'Nandini Paul', 'nandini.paul@nurse.com', 9876543218, 'Morning', 4, '2025-05-10 07:32:33'),
(10, 'Geeta Yadav', 'geeta.yadav@nurse.com', 9876543219, 'Evening', 5, '2025-05-10 07:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_per_unit` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `medicine_name`, `quantity`, `price_per_unit`, `expiry_date`, `update_date`) VALUES
(1, 'Paracetamol 500mg', 200, 1.55, '2026-03-15', '2025-05-10 16:05:23'),
(2, 'Amoxicillin 250mg', 150, 3.25, '2025-12-01', '2025-05-10 07:17:59'),
(3, 'Cetirizine 10mg', 300, 0.75, '2026-07-20', '2025-05-10 07:17:59'),
(4, 'Metformin 500mg', 100, 2.50, '2025-10-10', '2025-05-10 07:17:59'),
(5, 'Ibuprofen 400mg', 250, 1.80, '2026-01-05', '2025-05-10 07:17:59'),
(6, 'Pantoprazole 40mg', 180, 2.00, '2026-06-30', '2025-05-10 07:17:59'),
(7, 'Azithromycin 500mg', 120, 5.00, '2025-08-15', '2025-05-10 07:17:59'),
(8, 'Atorvastatin 10mg', 160, 3.00, '2026-09-25', '2025-05-10 07:17:59'),
(9, 'Losartan 50mg', 140, 14.00, '2025-11-30', '2025-05-10 16:05:55'),
(10, 'Dolo 650mg', 220, 1.60, '2026-02-10', '2025-05-10 07:17:59'),
(11, 'Ranitidine 150mg', 180, 1.90, '2026-05-10', '2025-05-10 07:18:21'),
(12, 'Montelukast 10mg', 130, 2.20, '2025-09-18', '2025-05-10 07:18:21'),
(13, 'Clopidogrel 75mg', 170, 3.10, '2026-04-22', '2025-05-10 07:18:21'),
(14, 'Levocetirizine 5mg', 200, 0.85, '2026-11-12', '2025-05-10 07:18:21'),
(15, 'Diclofenac Sodium 50mg', 150, 1.70, '2026-03-28', '2025-05-10 07:18:21'),
(16, 'Salbutamol Inhaler', 90, 6.50, '2025-12-31', '2025-05-10 07:18:21'),
(17, 'Calcium Carbonate 500mg', 250, 1.40, '2026-08-08', '2025-05-10 07:18:21'),
(18, 'Omeprazole 20mg', 300, 2.00, '2025-07-15', '2025-05-10 07:18:21'),
(19, 'Thyroxine 100mcg', 220, 1.60, '2026-10-01', '2025-05-10 07:18:21'),
(20, 'Insulin 30/70 Vial', 100, 12.00, '2025-11-20', '2025-05-10 07:18:21'),
(21, 'Atorvastatin 10mg', 160, 4.30, '2026-11-11', '2025-05-10 16:16:05'),
(22, 'Losartan 50mg', 190, 3.75, '2027-01-22', '2025-05-10 16:16:05'),
(23, 'Levocetirizine 5mg', 210, 2.10, '2026-06-19', '2025-05-10 16:16:05'),
(24, 'Omeprazole 20mg', 220, 2.90, '2026-08-14', '2025-05-10 16:16:05'),
(25, 'Clopidogrel 75mg', 130, 5.60, '2025-12-05', '2025-05-10 16:16:05'),
(26, 'Dexamethasone 4mg', 70, 6.50, '2026-03-08', '2025-05-10 16:16:05'),
(27, 'Loratadine 10mg', 155, 2.00, '2026-09-01', '2025-05-10 16:16:05'),
(28, 'Salbutamol Inhaler', 50, 15.00, '2025-11-29', '2025-05-10 16:16:05'),
(29, 'Hydroxychloroquine 200mg', 60, 7.80, '2026-04-21', '2025-05-10 16:16:05'),
(30, 'Insulin Glargine 100IU', 40, 22.50, '2026-07-15', '2025-05-10 16:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `notes` text DEFAULT NULL,
  `prescription_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `patientId`, `doctorId`, `medicine_name`, `quantity`, `dosage`, `notes`, `prescription_date`) VALUES
(1, 8, 1, 'Thyroxine 100mcg', 6, '2gm', 'use it ', '2025-05-10 14:57:55'),
(2, 8, 1, 'Thyroxine 100mcg', 6, '2gm', 'use it ', '2025-05-10 15:09:48'),
(3, 1, 2, 'Amoxicillin', 10, '500mg twice a day', 'Take after food', '2025-04-30 18:30:00'),
(4, 2, 1, 'Ibuprofen', 15, '400mg thrice a day', 'Take with meals', '2025-05-01 18:30:00'),
(5, 3, 4, 'Paracetamol', 20, '500mg as needed', 'Do not exceed 4/day', '2025-05-02 18:30:00'),
(6, 4, 5, 'Cetirizine', 10, '10mg at night', 'Avoid alcohol', '2025-05-03 18:30:00'),
(7, 5, 2, 'Metformin', 30, '500mg twice a day', 'Monitor blood sugar', '2025-05-03 18:30:00'),
(8, 1, 2, 'Omeprazole', 14, '20mg before breakfast', 'Avoid spicy food', '2025-05-04 18:30:00'),
(9, 2, 1, 'Azithromycin', 5, '500mg once daily', 'Complete full course', '2025-05-05 18:30:00'),
(10, 3, 4, 'Loratadine', 10, '10mg once daily', 'For seasonal allergies', '2025-05-05 18:30:00'),
(11, 6, 2, 'Losartan', 30, '50mg once daily', 'Monitor BP regularly', '2025-05-06 18:30:00'),
(12, 7, 1, 'Amlodipine', 30, '5mg once daily', 'Take at the same time', '2025-05-07 18:30:00'),
(13, 8, 3, 'Simvastatin', 30, '10mg at bedtime', 'Avoid grapefruit', '2025-05-07 18:30:00'),
(14, 4, 5, 'Atorvastatin', 30, '20mg at bedtime', 'Lipid profile in 6 weeks', '2025-05-08 18:30:00'),
(15, 5, 2, 'Levothyroxine', 30, '75mcg before breakfast', 'Empty stomach', '2025-05-08 18:30:00'),
(16, 9, 1, 'Doxycycline', 10, '100mg twice daily', 'With plenty of water', '2025-05-08 18:30:00'),
(17, 10, 4, 'Hydrochlorothiazide', 30, '25mg once daily', 'Take in the morning', '2025-05-09 18:30:00'),
(18, 3, 2, 'Alprazolam', 7, '0.25mg at bedtime', 'Short-term use only', '2025-05-09 18:30:00'),
(19, 11, 5, 'Salbutamol Inhaler', 1, 'As needed', 'Shake well before use', '2025-05-09 18:30:00'),
(20, 12, 1, 'Vitamin D3', 4, '60,000 IU weekly', 'With milk or meal', '2025-05-09 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `assigned_area` varchar(255) DEFAULT NULL,
  `managed_by_admin` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `role`, `contact_no`, `assigned_area`, `managed_by_admin`, `creation_date`) VALUES
(1, 'Ramesh Kumar', 'Cleaner', 2147483647, 'Ward A', 1, '2025-05-10 07:34:17'),
(2, 'Suresh Patel', 'Maintenance', 2147483647, 'Generator Room', 2, '2025-05-10 07:34:17'),
(3, 'Naresh Rao', 'Security', 2147483647, 'Main Gate', 3, '2025-05-10 07:34:17'),
(4, 'Vikas Das', 'Cleaner', 2147483647, 'Ward B', 1, '2025-05-10 07:34:17'),
(5, 'Anil Singh', 'Ward Assistant', 2147483647, 'ICU', 2, '2025-05-10 07:34:17'),
(6, 'Manoj Yadav', 'Electrician', 2147483647, 'Facility Wing', 1, '2025-05-10 07:34:17'),
(7, 'Pawan Thakur', 'Gardener', 2147483647, 'Hospital Garden', 2, '2025-05-10 07:34:17'),
(8, 'Arjun Sharma', 'Security', 2147483647, 'Emergency Wing', 3, '2025-05-10 07:34:17'),
(9, 'Kishore Kumar', 'Reception Support', 2147483647, 'Front Desk', 2, '2025-05-10 07:34:17'),
(10, 'Tarun Bedi', 'Cleaner', 2147483647, 'Operation Theatre', 1, '2025-05-10 07:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `id` int(11) NOT NULL,
  `patientId` int(11) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `surgery_type` varchar(100) DEFAULT NULL,
  `surgery_date` date DEFAULT NULL,
  `surgery_notes` text DEFAULT NULL,
  `recovery_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`id`, `patientId`, `doctorId`, `surgery_type`, `surgery_date`, `surgery_notes`, `recovery_status`) VALUES
(1, 1, 2, 'Appendectomy', '2024-10-10', 'Appendix removed successfully. No complications.', 'Recovering'),
(2, 2, 3, 'Cataract Surgery', '2024-10-15', 'Cataract lens replaced. Patient advised rest.', 'Fully Recovered'),
(3, 3, 4, 'Gallbladder Removal', '2024-10-20', 'Minimal bleeding. Discharged next day.', 'Recovering'),
(4, 4, 5, 'Heart Bypass', '2024-10-22', 'Triple bypass performed. ICU for 3 days.', 'Under Observation'),
(5, 5, 6, 'Knee Replacement', '2024-10-25', 'Left knee joint replaced. Physio ongoing.', 'Recovering'),
(6, 6, 1, 'Tonsillectomy', '2024-10-28', 'Tonsils removed without issue.', 'Fully Recovered'),
(7, 7, 2, 'Hernia Repair', '2024-11-01', 'Inguinal hernia corrected. No recurrence.', 'Recovering'),
(8, 8, 3, 'Spinal Surgery', '2024-11-03', 'Laminectomy done for back pain relief.', 'Under Observation'),
(9, 9, 4, 'Hip Replacement', '2024-11-05', 'Right hip replaced. Needs physiotherapy.', 'Recovering'),
(10, 10, 5, 'Gallbladder Removal', '2024-11-06', 'Standard laparoscopic removal.', 'Fully Recovered'),
(11, 2, 2, 'transfusion', '2025-05-12', 'bp was high', 'long time'),
(12, 2, 10, 'heart transplant', '2025-06-07', 'high bp ', 'recovering');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactno` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `adminRemark` text DEFAULT NULL,
  `lastupdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `postingDate`, `adminRemark`, `lastupdationDate`, `isRead`) VALUES
(4, 'Ravi Shankar', 'ravi.shankar@example.com', 9876543210, 'I would like to know more about the health packages.', '2024-03-05 04:52:45', 'ok', '2025-05-10 09:52:01', 1),
(5, 'Pooja Mehra', 'pooja.mehra@gmail.com', 9823456712, 'Having issues booking an appointment.', '2024-03-05 05:30:30', 'Issue resolved via call', '2024-03-05 08:00:12', 1),
(6, 'Amit Verma', 'amitv@testmail.com', 9911223344, 'Need a cardiologist appointment next week.', '2024-03-06 04:10:10', 'Scheduled appointment', '2024-03-06 04:30:00', 1),
(7, 'Neha Patil', 'neha.patil@domain.com', 9845123678, 'Website is not responsive on mobile.', '2024-03-06 09:52:08', NULL, '2025-05-09 10:38:33', NULL),
(8, 'Manish Rao', 'manish.rao@gmail.com', 9988776655, 'Do you offer home sample collection?', '2024-03-07 02:40:45', 'Yes, available in select areas.', '2024-03-07 03:15:00', 1),
(9, 'Simran Kaur', 'simran.k@example.org', 9123456789, 'I need a prescription copy from last visit.', '2024-03-07 09:00:00', 'Sent to registered email.', '2024-03-07 09:30:00', 1),
(10, 'Rahul Dev', 'rahul.dev@test.com', 9765432109, 'Doctor did not join the video call.', '2024-03-08 04:35:22', 'Apologized, rescheduled', '2024-03-08 05:40:00', 1),
(11, 'Alisha Singh', 'alisha.singh@mail.com', 9900112233, 'How to upload previous medical reports?', '2024-03-08 06:42:12', NULL, '2025-05-09 10:38:33', NULL),
(12, 'Arun Prasad', 'arunprasad@inbox.com', 9654321098, 'Payment failed but amount deducted.', '2024-03-09 03:30:00', 'Refund initiated', '2024-03-09 04:15:00', 1),
(13, 'Sneha Roy', 'sneha.roy@demo.com', 9856231478, 'Kindly confirm my appointment time.', '2024-03-09 06:00:45', 'Confirmed for 12:00 PM', '2024-03-09 06:15:00', 1),
(14, 'Yasmin devaragattu', 'yasminddg@gmail.com', 8688432864, 'i want to know more abt insurance ', '2025-05-09 11:43:54', NULL, '2025-05-09 11:43:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `bloodPressure` varchar(20) DEFAULT NULL,
  `bloodSugar` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `medicalPres` text DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`id`, `userId`, `bloodPressure`, `bloodSugar`, `weight`, `temperature`, `medicalPres`, `creationDate`) VALUES
(1, 1, '120/80', 90, 55, 98.6, 'Routine checkup, no issues', '2025-05-11 10:52:21'),
(4, 6, '120/80', 110, 70, 98.6, 'Patient is in good health.', '2024-03-05 04:40:00'),
(5, 7, '140/90', 160, 80, 99.1, 'Prescribed BP medication.', '2024-03-06 05:45:32'),
(6, 8, '130/85', 130, 75, 98.4, 'Suggested dietary changes.', '2024-03-07 04:15:10'),
(7, 9, '110/70', 90, 60, 97.9, 'No medication needed.', '2024-03-08 08:52:19'),
(8, 1, '150/100', 180, 90, 100.2, 'Prescribed insulin & BP control.', '2024-03-08 11:00:45'),
(9, 2, '125/80', 100, 72, 98.0, 'Advised regular monitoring.', '2024-03-09 03:25:00'),
(10, 3, '135/88', 140, 85, 98.9, 'Given multivitamins and fluids.', '2024-03-09 07:30:00'),
(11, 4, '115/75', 105, 68, 97.5, 'Hydration therapy suggested.', '2024-03-10 04:40:10'),
(12, 5, '145/95', 170, 88, 99.5, 'Prescribed ACE inhibitors.', '0000-00-00 00:00:00'),
(13, 68, '118/78', 98, 73, 98.2, 'Healthy, advised to maintain routine.', '2024-03-11 03:30:00'),
(14, 2, '120/80', 90, 60, 98.4, 'No major issues, advised healthy diet and regular checkup.', '2025-05-11 12:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', '<p style=\"font-size:14px; text-align:justify;\">\r\nThe Hospital Management System (HMS) is a comprehensive, integrated software solution designed to streamline and automate hospital operations. Our system helps manage patient records, appointments, billing, staff schedules, ward allocation, and medical histories with precision and security. By minimizing manual processes and enhancing data accuracy, HMS ensures improved efficiency, faster workflows, and better patient care. It supports informed decision-making and enables hospitals to deliver services in a timely, cost-effective manner while maintaining the highest standards of healthcare.\r\n</p>', NULL, NULL, '2020-05-20 01:51:52', NULL),
(2, 'contactus', 'Contact Details', 'Door No. 10-2-45, 1st Floor, Sai Nagar, Opposite RTC Bus Stand, Anantapur, Andhra Pradesh - 515001', 'HMSinfo@gmail.com', 9841253067, '2020-05-20 01:54:07', '9 AM to 8 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Ravi Sharma', 9876543210, 'ravi.sharma@example.com', 'Male', '45, MG Road, Delhi', 34, 'Diabetes, mild hypertension', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(2, 2, 'Anjali Verma', 9123456780, 'anjali.verma@example.com', 'Female', '22, Lake View, Bhopal', 28, 'Asthma since childhood', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(3, 3, 'Mohit Singh', 9988776655, 'mohit.singh@example.com', 'Male', '13, Civil Lines, Jaipur', 41, 'Allergic rhinitis', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(4, 4, 'Pooja Nair', 9876501234, 'pooja.nair@example.com', 'Female', '88, Marine Drive, Mumbai', 36, 'Hypothyroidism', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(5, 5, 'Karan Mehta', 9090909090, 'karan.mehta@example.com', 'Male', '7A, Park Street, Kolkata', 50, 'High blood pressure, pre-diabetic', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(6, 2, 'Nisha Dubey', 9123001234, 'nisha.dubey@example.com', 'Female', '101, Sector 12, Noida', 29, 'Migraines', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(7, 3, 'Rahul Desai', 9876123456, 'rahul.desai@example.com', 'Male', '66, Anand Nagar, Ahmedabad', 37, 'Chronic back pain', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(8, 1, 'Meera Joshi', 9812345678, 'meera.joshi@example.com', 'Female', '12B, Indira Nagar, Lucknow', 32, 'PCOD, iron deficiency', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(9, 4, 'Amitabh Roy', 9765432109, 'amitabh.roy@example.com', 'Male', 'Flat 9, Elgin Road, Kolkata', 45, 'Previous fracture, cholesterol issues', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(10, 5, 'Sneha Iyer', 9876000000, 'sneha.iyer@example.com', 'Female', '35, Besant Nagar, Chennai', 27, 'Seasonal allergies, minor anxiety', '2025-05-10 07:23:00', '2025-05-10 07:23:00'),
(11, 6, 'yasmin', 1236448941, 'yasminddg@gmail.com', 'female', '3-226\r\nPANTULA COLONY,near water tank', 25, 'sinus', '2025-05-10 09:23:51', '2025-05-10 09:23:51'),
(12, 10, 'yasmin', 1236448941, 'yasmwweeeinddg@gmail.com', 'Female', '3-226\r\nPANTULA COLONY,near water tank', 25, 'numbness', '2025-05-10 14:03:51', '2025-05-10 14:04:30'),
(13, 1, 'Divya Nair', 9876543210, 'divya.nair@example.com', 'Female', 'House 21, Vyttila, Kochi', 29, 'No major medical history.', '2025-05-11 10:46:54', '2025-05-11 10:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `userip` varbinary(16) DEFAULT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, NULL, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-09 11:29:56', NULL, 0),
(2, NULL, 'arjun.mehta@example.com', 0x3a3a31, '2025-05-09 11:30:54', NULL, 0),
(3, NULL, 'ammit.verma@example.com', 0x3a3a31, '2025-05-09 11:34:14', NULL, 0),
(4, NULL, 'amit.verma@example.com', 0x3a3a31, '2025-05-10 07:48:58', NULL, 0),
(5, NULL, 'amit.verma@example.com', 0x3a3a31, '2025-05-10 07:53:10', NULL, 0),
(6, NULL, 'raul.singh@example.com', 0x3a3a31, '2025-05-10 08:01:09', NULL, 0),
(7, NULL, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-10 08:01:47', NULL, 0),
(8, NULL, 'sneha.reddy@example.com', 0x3a3a31, '2025-05-10 08:02:15', NULL, 0),
(9, NULL, 'rahul.singh@example.com', 0x3a3a31, '2025-05-10 08:05:53', NULL, 0),
(10, 1, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-10 09:22:05', '10-05-2025 02:52:05 PM', 1),
(11, NULL, 'SHAHEERA105@GMAIL.COM', 0x3a3a31, '2025-05-10 10:08:32', NULL, 0),
(12, NULL, 'shaheera', 0x3a3a31, '2025-05-10 10:09:44', NULL, 0),
(13, NULL, 'SHAHEERA105@GMAIL.COM', 0x3a3a31, '2025-05-10 10:09:51', NULL, 0),
(14, 9, 'karthik.iyer@example.com', 0x3a3a31, '2025-05-10 16:24:50', NULL, 1),
(15, 68, 'divyya.nair@example.com', 0x3a3a31, '2025-05-11 10:54:46', '11-05-2025 04:24:46 PM', 1),
(16, 1, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-11 11:13:15', '11-05-2025 04:43:15 PM', 1),
(17, 2, 'priya.sharma@example.com', 0x3a3a31, '2025-05-11 12:32:45', NULL, 1),
(18, 1, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-11 13:37:38', NULL, 1),
(19, 1, 'ravi.kumar@example.com', 0x3a3a31, '2025-05-11 16:53:18', '11-05-2025 10:23:18 PM', 1),
(20, NULL, 'arya@gmail.com', 0x3a3a31, '2025-05-11 19:22:47', NULL, 0),
(21, 195, 'aarya@gmail.com', 0x3a3a31, '2025-05-11 19:32:38', '12-05-2025 01:02:38 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(1, 'Ravi Kumar', '123 MG Road', 'Anantapur', 'Male', 'ravi.kumar@example.com', 'pass123', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(2, 'Priya Sharma', '466 JP Nagar', 'Bangalore', 'Female', 'priya.sharma@example.com', 'pass456', '2025-05-09 10:14:25', '2025-05-11 12:52:36'),
(3, 'Amit Verma', '789 Ring Road', 'Delhi', 'Male', 'amit.verma@example.com', 'pass789', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(4, 'Sneha Reddy', 'Plot 12, KPHB', 'Hyderabad', 'Female', 'sneha.reddy@example.com', 'sneha123', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(5, 'Rahul Singh', 'Sector 5, Dwarka', 'Delhi', 'Male', 'rahul.singh@example.com', 'rahulpass', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(6, 'Neha Joshi', 'B/23 Green Park', 'Mumbai', 'Female', 'neha.joshi@example.com', 'neha456', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(7, 'Arjun Mehta', '12 Civil Lines', 'Lucknow', 'Male', 'arjun.mehta@example.com', 'arjun789', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(8, 'Divya Nair', 'House 21, Vyttila', 'Kochi', 'Female', 'divya.nair@example.com', 'divya123', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(9, 'Karthik Iyer', '4th Floor, ITPL', 'Bangalore', 'Male', 'karthik.iyer@example.com', 'karthik456', '2025-05-09 10:14:25', '2025-05-10 16:26:31'),
(10, 'Meera Das', 'Flat 9, Park Street', 'Kolkata', 'Female', 'meera.das@example.com', 'meera789', '2025-05-09 10:14:25', '2025-05-09 10:14:25'),
(61, 'Ravi Kumar', '123 MG Road', 'Anantapur', 'Male', 'raaavi.kumar@example.com', 'pass123', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(62, 'Priya Sharma', '456 JP Nagar', 'Bangalore', 'Female', 'priiiya.sharma@example.com', 'pass456', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(63, 'Amit Verma', '789 Ring Road', 'Delhi', 'Male', 'ammit.verma@example.com', 'pass789', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(64, 'Sneha Reddy', 'Plot 12, KPHB', 'Hyderabad', 'Female', 'snneha.reddy@example.com', 'sneha123', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(65, 'Rahul Singh', 'Sector 5, Dwarka', 'Delhi', 'Male', 'rahuul.singh@example.com', 'rahulpass', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(66, 'Neha Joshi', 'B/23 Green Park', 'Mumbai', 'Female', 'neeha.joshi@example.com', 'neha456', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(67, 'Arjun Mehta', '12 Civil Lines', 'Lucknow', 'Male', 'arjjun.mehta@example.com', 'arjun789', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(68, 'Divya Nair', 'House 21, Vyttila', 'Kochi', 'Female', 'divyya.nair@example.com', 'divya123', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(69, 'Karthik Iyer', '3rd Floor, ITPL', 'Bangalore', 'Male', 'karthhik.iyer@example.com', 'karthik456', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(70, 'Meera Das', 'Flat 9, Park Street', 'Kolkata', 'Female', 'meeraa.das@example.com', 'meera789', '2025-05-09 10:19:43', '2025-05-09 10:19:43'),
(171, 'Ravi Kumar', '123 MG Road', 'Anantapur', 'Male', 'rai.kumar@example.com', 'pass123', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(172, 'Priya Sharma', '456 JP Nagar', 'Bangalore', 'Female', 'piiiya.sharma@example.com', 'pass456', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(173, 'Amit Verma', '789 Ring Road', 'Delhi', 'Male', 'ammt.verma@example.com', 'pass789', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(174, 'Sneha Reddy', 'Plot 12, KPHB', 'Hyderabad', 'Female', 'snnea.reddy@example.com', 'sneha123', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(175, 'Rahul Singh', 'Sector 5, Dwarka', 'Delhi', 'Male', 'raul.singh@example.com', 'rahulpass', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(176, 'Neha Joshi', 'B/23 Green Park', 'Mumbai', 'Female', 'nha.joshi@example.com', 'neha456', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(177, 'Arjun Mehta', '12 Civil Lines', 'Lucknow', 'Male', 'aun.mehta@example.com', 'arjun789', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(178, 'Divya Nair', 'House 21, Vyttila', 'Kochi', 'Female', 'dia.nair@example.com', 'divya123', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(179, 'Karthik Iyer', '3rd Floor, ITPL', 'Bangalore', 'Male', 'kahik.iyer@example.com', 'karthik456', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(180, 'Meera Das', 'Flat 9, Park Street', 'Kolkata', 'Female', 'ma.das@example.com', 'meera789', '2025-05-09 10:25:21', '2025-05-09 10:25:21'),
(193, 'SHAHEERA BEGAM', '3-226', 'Ananthapur', 'female', 'SHAHEERA105@GMAIL.COM', '26bb44578968cbf9a76fee84192f1cf1', '2025-05-10 10:08:20', '2025-05-10 10:08:20'),
(194, 'Arya vergese', 'kerala', 'kottayam', 'female', 'arya@gmail.com', '611dd931040ba2284d0adc26a5e3f056', '2025-05-11 15:52:25', '2025-05-11 15:52:25'),
(195, 'arya vergese', 'kerala', 'kottayam', 'female', 'aarya@gmail.com', '$2y$10$vK0YXQpZF/jIYC5KELdWOOxEa03W8Lsd4/IUNQ48ZA8twrHWX0vOC', '2025-05-11 15:59:15', '2025-05-11 15:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`),
  ADD KEY `appointment_ibfk_1` (`userId`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointmentId` (`appointmentId`),
  ADD KEY `surgeryId` (`surgeryId`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `docEmail` (`docEmail`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_doctor_id` (`assigned_doctor_id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lab_reports`
--
ALTER TABLE `lab_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`appointmentId`) REFERENCES `appointment` (`id`),
  ADD CONSTRAINT `billing_ibfk_2` FOREIGN KEY (`surgeryId`) REFERENCES `surgery` (`id`);

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD CONSTRAINT `lab_reports_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tblpatient` (`ID`);

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_ibfk_1` FOREIGN KEY (`assigned_doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `tblpatient` (`ID`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `surgery`
--
ALTER TABLE `surgery`
  ADD CONSTRAINT `surgery_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `surgery_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD CONSTRAINT `tblmedicalhistory_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userlog`
--
ALTER TABLE `userlog`
  ADD CONSTRAINT `userlog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
