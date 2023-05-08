-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2023 at 04:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ablemind`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkup_history`
--

CREATE TABLE `checkup_history` (
  `check_hist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL,
  `result_in_json` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkup_history`
--

INSERT INTO `checkup_history` (`check_hist_id`, `user_id`, `date`, `result_in_json`) VALUES
(8, 2, '2023-05-07', '{\"1\":{\"totalSymptoms\":6,\"percentage\":50},\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":40},\"6\":{\"totalSymptoms\":6,\"percentage\":50},\"10\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"9\":{\"totalSymptoms\":1,\"percentage\":100}}'),
(9, 2, '2023-05-08', '{\"1\":{\"totalSymptoms\":6,\"percentage\":50},\"4\":{\"totalSymptoms\":4,\"percentage\":50}}');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `disease_id` int(11) NOT NULL,
  `disease` varchar(80) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`disease_id`, `disease`, `status`) VALUES
(1, 'ADHD (attention deficit hyperactivity disorder)', 'active'),
(4, 'Autism', 'active'),
(5, 'Alzheimer\'s disorder', 'active'),
(6, 'Anxiety disorders', 'active'),
(7, 'Bipolar Affective Disorder', 'active'),
(9, 'Developmental Expressive Language Disorder (DELD)', 'active'),
(10, 'Behavior disorder', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `disease_symptoms`
--

CREATE TABLE `disease_symptoms` (
  `dis_symp_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease_symptoms`
--

INSERT INTO `disease_symptoms` (`dis_symp_id`, `disease_id`, `symptom_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(11, 4, 15),
(12, 4, 16),
(13, 4, 17),
(14, 4, 18),
(15, 5, 19),
(16, 5, 20),
(17, 5, 21),
(18, 5, 22),
(19, 5, 23),
(20, 6, 24),
(21, 6, 25),
(22, 6, 26),
(23, 6, 27),
(24, 6, 28),
(25, 6, 29),
(28, 10, 30),
(29, 10, 31),
(30, 10, 32),
(31, 9, 33);

-- --------------------------------------------------------

--
-- Table structure for table `disease__treatmentcenter`
--

CREATE TABLE `disease__treatmentcenter` (
  `dis_treatcenter_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `treat_center_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease__treatmentcenter`
--

INSERT INTO `disease__treatmentcenter` (`dis_treatcenter_id`, `disease_id`, `treat_center_id`) VALUES
(3, 1, 2),
(4, 4, 2),
(5, 9, 2),
(6, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `symptom_id` int(11) NOT NULL,
  `symptom` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`symptom_id`, `symptom`) VALUES
(1, 'Inattention'),
(2, 'hyperactivity'),
(3, 'impulsivity'),
(4, 'difficulty focusing'),
(5, 'forgetfulness'),
(6, 'restlessness'),
(15, 'Difficulty with social interactions'),
(16, 'communication'),
(17, 'repetitive behaviors'),
(18, 'sensitivity to sensory input'),
(19, 'Memory loss'),
(20, 'difficulty with language'),
(21, 'disorientation'),
(22, 'mood swings'),
(23, 'behavioral changes'),
(24, 'Excessive worry'),
(25, 'fear'),
(26, 'nervousness'),
(27, 'sweating'),
(28, 'trembling'),
(29, 'rapid heartbeat'),
(30, 'Persistent aggression'),
(31, 'Persistent destruction of property'),
(32, 'Persistent deceitfulness'),
(33, 'Difficulty with language production or expression, such as word retrieval or putting words together to form sentences');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `treatment_id` int(11) NOT NULL,
  `treatment` varchar(250) NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`treatment_id`, `treatment`, `disease_id`) VALUES
(1, 'Medication, behavioral therapy, parent-teacher training, and accommodations in school or work.', 1),
(2, 'Applied Behavior Analysis (ABA), speech therapy, occupational therapy, and medication for co-occurring conditions', 4),
(3, 'Medications to slow the progression of the disease, cognitive therapy, and support for caregivers', 5),
(4, 'Cognitive Behavioral Therapy (CBT), medication, mindfulness techniques, and lifestyle changes', 6),
(5, 'Medication, psychotherapy, and lifestyle changes', 7),
(7, 'Speech therapy, language intervention, and accommodations in school or work', 9),
(8, 'Behavioral therapy, family therapy, and medication for co-occurring conditions', 10);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_center`
--

CREATE TABLE `treatment_center` (
  `treat_center_id` int(11) NOT NULL,
  `center_name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment_center`
--

INSERT INTO `treatment_center` (`treat_center_id`, `center_name`, `description`, `status`) VALUES
(2, 'REACH Behavior and Development Center | ABA Therapy, Speech Therapy, Occupational Therapy, Autism, ADHD, Child Development Center in Bahrain', 'Located in: Nakheel Center\r\nAddress: Nakheel Centre – 2nd Floor, Building 789, Road 1322, Saar\r\nAreas served: Bahrain.\r\nPhone: 3900 6065\r\nAppointments: reachabatherapy.com', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'member',
  `profile_pic` varchar(250) NOT NULL DEFAULT 'default.jpg',
  `userStatus` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_pic`, `userStatus`) VALUES
(1, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'default.jpg', 'active'),
(2, 'member one', 'member1@gmail.com', 'c7764cfed23c5ca3bb393308a0da2306', 'member', 'default.jpg', 'active'),
(3, 'aa', 'aaa@aa.com', '7c3d596ed03ab9116c547b0eb678b247', 'member', 'default.jpg', 'active'),
(4, 'bb', 'bb@b.com', '7229e3243ac72f445866a4f21f1b3508', 'member', 'default.jpg', 'active'),
(5, 'c', 'cc@c.com', 'c1f68ec06b490b3ecb4066b1b13a9ee9', 'member', 'default.jpg', 'active'),
(6, 'dd', 'd@d.com', '980ac217c6b51e7dc41040bec1edfec8', 'member', 'default.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkup_history`
--
ALTER TABLE `checkup_history`
  ADD PRIMARY KEY (`check_hist_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `disease_symptoms`
--
ALTER TABLE `disease_symptoms`
  ADD PRIMARY KEY (`dis_symp_id`),
  ADD KEY `disease_fk` (`disease_id`),
  ADD KEY `symptom_fk` (`symptom_id`);

--
-- Indexes for table `disease__treatmentcenter`
--
ALTER TABLE `disease__treatmentcenter`
  ADD PRIMARY KEY (`dis_treatcenter_id`),
  ADD KEY `disease_treatcenter_fk` (`disease_id`),
  ADD KEY `treatcenter_fk` (`treat_center_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`symptom_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `treatments_disease_fk` (`disease_id`);

--
-- Indexes for table `treatment_center`
--
ALTER TABLE `treatment_center`
  ADD PRIMARY KEY (`treat_center_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkup_history`
--
ALTER TABLE `checkup_history`
  MODIFY `check_hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `disease_symptoms`
--
ALTER TABLE `disease_symptoms`
  MODIFY `dis_symp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `disease__treatmentcenter`
--
ALTER TABLE `disease__treatmentcenter`
  MODIFY `dis_treatcenter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symptom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `treatment_center`
--
ALTER TABLE `treatment_center`
  MODIFY `treat_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disease_symptoms`
--
ALTER TABLE `disease_symptoms`
  ADD CONSTRAINT `disease_fk` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`),
  ADD CONSTRAINT `symptom_fk` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`symptom_id`);

--
-- Constraints for table `disease__treatmentcenter`
--
ALTER TABLE `disease__treatmentcenter`
  ADD CONSTRAINT `disease_treatcenter_fk` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`),
  ADD CONSTRAINT `treatcenter_fk` FOREIGN KEY (`treat_center_id`) REFERENCES `treatments` (`treatment_id`);

--
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_disease_fk` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
