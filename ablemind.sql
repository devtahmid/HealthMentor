-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2023 at 09:28 AM
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
(9, 2, '2023-05-08', '{\"1\":{\"totalSymptoms\":6,\"percentage\":50},\"4\":{\"totalSymptoms\":4,\"percentage\":50}}'),
(10, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(11, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(12, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(13, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(14, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(15, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}');

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
(6, 10, 2),
(7, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `dateTime`, `fromId`, `toId`, `message`) VALUES
(1, '2023-05-09 07:42:35', 2, 15, 'hello'),
(2, '2023-05-09 07:43:56', 2, 15, 'who am i speaking to?'),
(3, '2023-05-09 08:30:36', 15, 2, 'hi'),
(4, '2023-05-09 08:30:48', 15, 2, 'i\'m karen clapper'),
(5, '2023-05-09 09:18:06', 2, 15, ':)'),
(6, '2023-05-09 09:26:43', 2, 15, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `specialists-expertise`
--

CREATE TABLE `specialists-expertise` (
  `rowid` int(11) NOT NULL,
  `specialistId` int(11) NOT NULL,
  `expertise` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialists-expertise`
--

INSERT INTO `specialists-expertise` (`rowid`, `specialistId`, `expertise`) VALUES
(1, 14, '2fdfdfdfd'),
(2, 14, '1dfsfsvfdbf'),
(3, 15, 'Autism Spectrum Disorder'),
(4, 15, 'Developmental Language Disorder'),
(5, 15, 'Intellectual Disabilities'),
(6, 15, 'Language/Learning Disabilities'),
(7, 15, 'Parent Coaching'),
(8, 15, 'Speech Sound Disorders'),
(9, 15, 'Literacy: Reading/Dyslexia'),
(10, 15, 'Literacy: Writing/Spelling');

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
(2, 'REACH Behavior and Development Center | ABA Therapy, Speech Therapy, Occupational Therapy, Autism, ADHD, Child Development Center in Bahrain', 'Located in: Nakheel Center\r\nAddress: Nakheel Centre – 2nd Floor, Building 789, Road 1322, Saar\r\nAreas served: Bahrain.\r\nPhone: 3900 6065\r\nAppointments: reachabatherapy.com', 'active'),
(3, 'Bahrain Specialist Hospital', 'Address: Building 2743, Road No 2447, Block 324 Juffair, 324\r\nHours: Open 24 hours\r\nPhone: 1781 2222', 'active');

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
(3, 'aa', 'aaa@aa.com', '7c3d596ed03ab9116c547b0eb678b247', 'member', 'default.jpg', 'inactive'),
(4, 'bb', 'bb@b.com', '7229e3243ac72f445866a4f21f1b3508', 'member', 'default.jpg', 'inactive'),
(5, 'c', 'cc@c.com', 'c1f68ec06b490b3ecb4066b1b13a9ee9', 'member', 'default.jpg', 'inactive'),
(6, 'dd', 'd@d.com', '980ac217c6b51e7dc41040bec1edfec8', 'member', 'default.jpg', 'inactive'),
(14, 'specialis three', 'specialist3@pm.com', 'b4a7495aa0ec7fc2caa321ba632c36ef', 'specialist', 'default.jpg', 'inactive'),
(15, 'Karen Clapper', 'karenclapper@pm.com', 'f0a409766608747e98d81cf932c48ea0', 'specialist', 'default.jpg', 'active');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `toid_userId_fk` (`toId`),
  ADD KEY `fromid_userId_fk` (`fromId`);

--
-- Indexes for table `specialists-expertise`
--
ALTER TABLE `specialists-expertise`
  ADD PRIMARY KEY (`rowid`),
  ADD KEY `specialist_specialist_fk` (`specialistId`);

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
  MODIFY `check_hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `dis_treatcenter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specialists-expertise`
--
ALTER TABLE `specialists-expertise`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `treat_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fromid_userId_fk` FOREIGN KEY (`fromId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `toid_userId_fk` FOREIGN KEY (`toId`) REFERENCES `users` (`id`);

--
-- Constraints for table `specialists-expertise`
--
ALTER TABLE `specialists-expertise`
  ADD CONSTRAINT `specialist_specialist_fk` FOREIGN KEY (`specialistId`) REFERENCES `users` (`id`);

--
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_disease_fk` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
