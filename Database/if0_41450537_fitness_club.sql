-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.infinityfree.com
-- Generation Time: Jun 16, 2026 at 04:08 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41450537_fitness_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Present',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `member_id`, `attendance_date`, `status`, `created_at`) VALUES
(7, 5, '2026-03-02', 'Present', '2026-03-29 09:21:58'),
(6, 5, '2026-03-01', 'Present', '2026-03-29 09:21:58'),
(3, 6, '2026-03-29', 'Present', '2026-03-29 08:08:14'),
(4, 8, '2026-03-29', 'Present', '2026-03-29 08:08:14'),
(5, 9, '2026-03-29', 'Present', '2026-03-29 08:08:14'),
(8, 5, '2026-03-03', 'Absent', '2026-03-29 09:21:58'),
(9, 5, '2026-03-04', 'Present', '2026-03-29 09:21:58'),
(10, 5, '2026-03-05', 'Present', '2026-03-29 09:21:58'),
(11, 5, '2026-03-06', 'Absent', '2026-03-29 09:21:58'),
(12, 5, '2026-03-07', 'Present', '2026-03-29 09:21:58'),
(13, 5, '2026-03-08', 'Present', '2026-03-29 09:21:58'),
(14, 5, '2026-03-09', 'Present', '2026-03-29 09:21:58'),
(15, 5, '2026-03-10', 'Absent', '2026-03-29 09:21:58'),
(16, 5, '2026-03-11', 'Present', '2026-03-29 09:21:58'),
(17, 5, '2026-03-12', 'Present', '2026-03-29 09:21:58'),
(18, 5, '2026-03-13', 'Present', '2026-03-29 09:21:58'),
(19, 5, '2026-03-14', 'Present', '2026-03-29 09:21:58'),
(20, 5, '2026-03-15', 'Absent', '2026-03-29 09:21:58'),
(21, 5, '2026-03-16', 'Present', '2026-03-29 09:21:58'),
(22, 5, '2026-03-17', 'Present', '2026-03-29 09:21:58'),
(23, 5, '2026-03-18', 'Present', '2026-03-29 09:21:58'),
(24, 5, '2026-03-19', 'Present', '2026-03-29 09:21:58'),
(25, 5, '2026-03-20', 'Absent', '2026-03-29 09:21:58'),
(26, 5, '2026-03-21', 'Present', '2026-03-29 09:21:58'),
(27, 5, '2026-03-22', 'Present', '2026-03-29 09:21:58'),
(28, 5, '2026-03-23', 'Present', '2026-03-29 09:21:58'),
(29, 5, '2026-03-24', 'Present', '2026-03-29 09:21:58'),
(30, 5, '2026-03-25', 'Present', '2026-03-29 09:21:58'),
(31, 5, '2026-03-26', 'Absent', '2026-03-29 09:21:58'),
(32, 5, '2026-03-27', 'Present', '2026-03-29 09:21:58'),
(33, 5, '2026-03-28', 'Present', '2026-03-29 09:21:58'),
(34, 5, '2026-03-29', 'Present', '2026-03-29 09:21:58'),
(35, 5, '2026-03-30', 'Present', '2026-03-29 09:21:58'),
(36, 5, '2026-03-31', 'Absent', '2026-03-29 09:21:58'),
(37, 5, '2026-04-02', 'Present', '2026-04-02 05:39:41'),
(38, 9, '2026-04-02', 'Absent', '2026-04-02 05:50:11'),
(39, 5, '2026-02-02', 'Present', '2026-04-02 05:50:39'),
(40, 5, '2026-04-01', 'Absent', '2026-04-02 06:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `plan` varchar(50) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `workout_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `age`, `gender`, `phone`, `email`, `plan`, `join_date`, `expiry_date`, `trainer_id`, `workout_id`) VALUES
(5, 'Aarav Sharma', 23, 'Male', '9876543210', 'aarav.sharma24@gmail.com', 'Standard', '2026-03-26', '2026-06-26', 1, 10),
(8, 'Sneha Patil', 23, 'Female', '9876543213', 'sneha@test.com', 'Basic', '2026-03-02', '2026-03-30', NULL, NULL),
(9, 'John Doe', 30, 'Male', '9876543210', 'johndoe@test.com', 'Basic', '2026-03-27', '2026-03-30', NULL, NULL),
(10, 'Ajay Singh', 24, 'Male', '9000000001', 'ajay@test.com', 'Basic', '2026-03-27', '2026-03-29', NULL, NULL),
(11, 'Neha Verma', 26, 'Female', '9000000002', 'neha@test.com', 'Standard', '2026-03-27', '2026-04-01', NULL, NULL),
(12, 'Rohit Patil', 29, 'Male', '9000000003', 'rohit@test.com', 'Premium', '2026-03-27', '2026-04-02', NULL, NULL),
(13, 'Amit Shah', 30, 'Male', '9000000004', 'amit@test.com', 'Basic', '2026-01-27', '2026-03-17', NULL, NULL),
(14, 'Pooja Nair', 28, 'Female', '9000000005', 'pooja@test.com', 'Standard', '2025-12-27', '2026-03-12', NULL, NULL),
(15, 'Vikas Rao', 35, 'Male', '9000000006', 'vikas@test.com', 'Premium', '2025-11-27', '2026-03-07', NULL, NULL),
(16, 'Snehal Joshi', 27, 'Female', '9000000007', 'snehal@test.com', 'Basic', '2026-01-27', '2026-03-15', NULL, NULL),
(17, 'Rahul Das', 25, 'Male', '9000000008', 'rahul@test.com', 'Basic', '2026-03-27', '2026-04-27', NULL, NULL),
(18, 'Anjali Mehta', 23, 'Female', '9000000009', 'anjali@test.com', 'Standard', '2026-03-27', '2026-05-27', NULL, NULL),
(19, 'Karan Malhotra', 31, 'Male', '9000000010', 'karan@test.com', 'Premium', '2026-03-27', '2026-09-27', NULL, NULL),
(20, 'Simran Kaur', 22, 'Female', '9000000011', 'simran@test.com', 'Basic', '2026-03-27', '2026-04-27', NULL, NULL),
(21, 'Deepak Yadav', 28, 'Male', '9000000012', 'deepak@test.com', 'Standard', '2026-03-27', '2026-06-27', NULL, NULL),
(22, 'Nikita Sharma', 24, 'Female', '9000000013', 'nikita@test.com', 'Premium', '2026-03-27', '2027-03-27', NULL, NULL),
(23, 'Arjun Reddy', 29, 'Male', '9000000014', 'arjun@test.com', 'Basic', '2026-03-27', '2026-04-27', NULL, NULL),
(24, 'Priya Kulkarni', 27, 'Female', '9000000015', 'priya@test.com', 'Standard', '2026-03-27', '2026-05-27', NULL, NULL),
(25, 'Manish Gupta', 33, 'Male', '9000000016', 'manish@test.com', 'Premium', '2026-03-27', '2026-09-27', NULL, NULL),
(26, 'Riya Kapoor', 21, 'Female', '9000000017', 'riya@test.com', 'Basic', '2026-03-27', '2026-04-27', NULL, NULL),
(28, 'Meera Iyer', 32, 'Female', '9000000019', 'meera@test.com', 'Premium', '2026-03-27', '2027-03-27', NULL, NULL),
(29, 'Yash Thakur', 28, 'Male', '9000000020', 'yash@test.com', 'Basic', '2026-03-27', '2026-04-27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `member_id`, `amount`, `payment_date`, `method`) VALUES
(39, 21, 2500, '2026-03-27', 'Cash'),
(38, 20, 1000, '2026-03-27', 'Cash'),
(37, 19, 8000, '2026-03-27', 'Cash'),
(36, 18, 2500, '2026-03-27', 'Cash'),
(35, 17, 1000, '2026-03-27', 'Cash'),
(34, 16, 1000, '2026-01-27', 'Cash'),
(33, 15, 8000, '2025-11-27', 'Cash'),
(32, 14, 2500, '2025-12-27', 'Cash'),
(31, 13, 1000, '2026-01-27', 'Cash'),
(30, 12, 8000, '2026-03-27', 'Cash'),
(29, 11, 2500, '2026-03-27', 'Cash'),
(28, 10, 1000, '2026-03-27', 'Cash'),
(25, 9, 1000, '2026-03-27', 'UPI'),
(24, 8, 1000, '2026-03-02', 'Card'),
(48, 13, 200, '2026-03-28', 'Cash'),
(21, 5, 2500, '2026-03-26', 'Cash'),
(40, 22, 8000, '2026-03-27', 'Cash'),
(41, 23, 1000, '2026-03-27', 'Cash'),
(43, 25, 8000, '2026-03-27', 'Cash'),
(44, 26, 1000, '2026-03-27', 'Cash'),
(46, 28, 8000, '2026-03-27', 'Cash'),
(47, 29, 1000, '2026-03-27', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `name`, `specialty`, `phone`, `specialization`) VALUES
(1, 'Rahul Sharma', NULL, '9876543210', 'Weight Loss'),
(2, 'Amit Verma', NULL, '9876543211', 'Strength Training'),
(3, 'Suresh Yadav', NULL, '9876543212', 'Bodybuilding'),
(4, 'Vikram Singh', NULL, '9876543213', 'Cardio Training'),
(5, 'Rohit Mehta', NULL, '9876543214', 'CrossFit'),
(6, 'Ankit Patel', NULL, '9876543215', 'Functional Training'),
(7, 'Deepak Kumar', NULL, '9876543216', 'Muscle Gain'),
(8, 'Manish Gupta', NULL, '9876543217', 'HIIT Training'),
(9, 'Karan Shah', NULL, '9876543218', 'Powerlifting'),
(10, 'Ajay Joshi', NULL, '9876543219', 'Yoga & Flexibility'),
(11, 'Nitin Agarwal', NULL, '9876543220', 'Core Strength'),
(12, 'Prakash Mishra', NULL, '9876543221', 'Rehabilitation'),
(13, 'Sanjay Roy', NULL, '9876543222', 'Athletic Training'),
(14, 'Rakesh Pandey', NULL, '9876543223', 'Endurance Training'),
(15, 'Vivek Desai', NULL, '9876543224', 'General Fitness'),
(16, 'Aarav Sharma', NULL, '9988776655', 'cardio'),
(17, 'anup kumar', NULL, '3456788654', 'mma');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_members`
--

CREATE TABLE `trainer_members` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trainer_members`
--

INSERT INTO `trainer_members` (`id`, `trainer_id`, `member_id`) VALUES
(22, 2, 10),
(21, 2, 5),
(20, 1, 8),
(19, 7, 9),
(18, 7, 21),
(17, 5, 18),
(16, 5, 13),
(15, 1, 10),
(14, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `plan_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`plan_id`, `title`, `description`, `duration`) VALUES
(1, 'Upper Lower Split', 'Workout split targeting upper and lower body on different days.', 0),
(2, 'Muscle Gain Program', 'Hypertrophy based program for muscle growth.', 0),
(3, 'Full Body Beginner', 'Simple full body workout for beginners focusing on basic strength.', 0),
(4, 'Weight Loss Starter', 'Light cardio and fat burning exercises for beginners.', 0),
(5, 'Basic Strength Training', 'Intro to strength training with compound movements.', 0),
(6, 'Upper Lower Split', 'Workout split targeting upper and lower body on different days.', 0),
(7, 'Push Pull Legs', 'Structured workout dividing push, pull and leg exercises.', 0),
(8, 'Muscle Gain Program', 'Hypertrophy based program for muscle growth.', 0),
(9, 'Bodybuilding Split', 'Advanced training targeting individual muscle groups.', 0),
(10, 'Bodybuilding Split', 'Advanced training targeting individual muscle groups.', 0),
(11, 'Fat Loss + HIIT', 'High intensity workouts combined with fat loss training.', 0),
(12, 'Fat Loss + HIIT', 'High intensity workouts combined with fat loss training.', 0),
(13, 'Strength & Conditioning', 'Focus on strength, endurance and athletic performance.', 0),
(14, 'Cardio Blast', 'High calorie burning cardio workout.', 0),
(15, 'Core Strength Program', 'Exercises focused on abs and core muscles.', 0),
(16, 'Functional Training', 'Real-life movement based exercises for overall fitness.', 0),
(17, 'cardio (Advanced level)', 'this is cardio plan desighned specifically for athlets', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `trainer_members`
--
ALTER TABLE `trainer_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trainer_members`
--
ALTER TABLE `trainer_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
