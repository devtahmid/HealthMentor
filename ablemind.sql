-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2023 at 09:08 PM
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
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `disease_id` int(11) NOT NULL,
  `disease` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`disease_id`, `disease`) VALUES
(1, 'ADHD (attention deficit hyperactivity disorder)'),
(4, 'Autism'),
(5, 'Alzheimer\'s disorder'),
(6, 'Anxiety disorders'),
(7, 'Bipolar Affective Disorder'),
(8, 'Behavior disorder');

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
(26, 8, 30),
(27, 8, 31);

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `symptom_id` int(11) NOT NULL,
  `symptom` varchar(50) NOT NULL
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
(31, 'Persistent destruction of property');

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
(6, 'Behavioral therapy, family therapy, and medication for co-occurring conditions', 8);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `disease_symptoms`
--
ALTER TABLE `disease_symptoms`
  MODIFY `dis_symp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symptom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_disease_fk` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
