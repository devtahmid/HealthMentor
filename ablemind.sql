-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2023 at 09:17 PM
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
(12, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(13, 2, '2023-05-09', '{\"1\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(17, 1, '2023-05-16', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(18, 1, '2023-05-16', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(19, 1, '2023-05-16', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(20, 1, '2023-05-16', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(21, 1, '2023-05-16', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(22, 2, '2023-05-23', '{\"4\":{\"totalSymptoms\":4,\"percentage\":75},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(23, 2, '2023-06-01', '{\"4\":{\"totalSymptoms\":4,\"percentage\":50},\"6\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"10\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"12\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"11\":{\"totalSymptoms\":3,\"percentage\":66.6700000000000017053025658242404460906982421875},\"5\":{\"totalSymptoms\":5,\"percentage\":20}}'),
(24, 2, '2023-06-01', '{\"4\":{\"totalSymptoms\":4,\"percentage\":75},\"6\":{\"totalSymptoms\":6,\"percentage\":33.3299999999999982946974341757595539093017578125},\"10\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"11\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"12\":{\"totalSymptoms\":3,\"percentage\":33.3299999999999982946974341757595539093017578125},\"16\":{\"totalSymptoms\":4,\"percentage\":25}}');

-- --------------------------------------------------------

--
-- Table structure for table `customer_support_messages`
--

CREATE TABLE `customer_support_messages` (
  `c_id` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_support_messages`
--

INSERT INTO `customer_support_messages` (`c_id`, `dateTime`, `name`, `email`, `phone`, `message`, `status`) VALUES
(3, '2023-05-09 21:41:26', 'Hamza', 'hamza@pm.com', '32323434', 'Hi, I would like to have a meeting. Please mail me or call me anytime', 'unread'),
(4, '2023-05-09 21:55:00', 'Zahra', 'zahra@pm.com', '33455678', 'Really like what you have going on in here!\r\nCould you please let me know how I can contact you personally?', 'read'),
(5, '2023-05-09 21:57:31', 'Muhammad', 'muhammad@pm.com', '17890987', 'Hi , I would like to book an appointment and I am feeling lost. Could you please help me?', 'read'),
(6, '2023-05-15 21:12:54', 'Sherlock Holmes', 'notsosimplecase@221bmail.com', '39876543', 'I have a mystery ailment wit strange symptoms. get in touch asap!', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `disease_id` int(11) NOT NULL,
  `disease` varchar(80) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `riskType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`disease_id`, `disease`, `status`, `riskType`) VALUES
(1, 'ADHD (attention deficit hyperactivity disorder)', 'active', 'Medium risk'),
(4, 'Autism', 'active', 'High risk'),
(5, 'Alzheimer\'s disorder', 'active', 'High risk'),
(6, 'Anxiety disorders', 'active', 'Medium risk'),
(7, 'Bipolar Affective Disorder', 'active', 'High risk'),
(9, 'Developmental Expressive Language Disorder (DELD)', 'active', 'Low risk'),
(10, 'Behavior disorder', 'active', 'Medium risk'),
(11, 'Oppositional Defiant Disorder (ODD)', 'active', 'Medium risk'),
(12, 'Conduct Disorder (CD)', 'active', 'High risk'),
(13, 'Dyslexia', 'active', 'Medium risk'),
(14, 'Depression', 'active', 'Medium risk'),
(15, 'Eating disorders', 'active', 'Medium risk'),
(16, 'Schizophrenia', 'active', 'High risk'),
(17, 'OCD (Obsessive-Compulsive Disorder)', 'active', 'High risk'),
(18, 'Phobias', 'active', 'Medium risk'),
(19, 'Dyscalculia', 'active', 'Low risk'),
(20, 'Paranoia', 'active', 'High risk'),
(21, 'Intellectual Disability', 'active', 'High risk'),
(26, 'Psychotic Disorder', 'active', 'High risk');

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
(31, 9, 33),
(32, 11, 37),
(33, 11, 38),
(34, 11, 39),
(35, 12, 40),
(36, 12, 41),
(37, 12, 42),
(38, 13, 43),
(39, 13, 44),
(40, 14, 45),
(41, 15, 46),
(42, 15, 47),
(43, 16, 48),
(44, 16, 49),
(45, 16, 50),
(46, 16, 51),
(47, 17, 52),
(48, 17, 53),
(49, 18, 54),
(50, 19, 55),
(51, 20, 56),
(52, 20, 57),
(53, 21, 58),
(54, 21, 59),
(60, 26, 48),
(61, 26, 49),
(62, 26, 50),
(63, 26, 51);

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
(8, 5, 4),
(9, 6, 5),
(10, 14, 5),
(11, 15, 5),
(12, 18, 5),
(14, 21, 7),
(15, 19, 8),
(16, 17, 6),
(17, 11, 6),
(18, 13, 6),
(19, 4, 9),
(20, 21, 9),
(21, 16, 10),
(22, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_answers`
--

CREATE TABLE `forgot_password_answers` (
  `row_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` varchar(25) NOT NULL,
  `answer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgot_password_answers`
--

INSERT INTO `forgot_password_answers` (`row_id`, `user_id`, `question`, `answer`) VALUES
(3, 22, 'Where were you born?', 'Mars'),
(4, 2, 'What\'s your pet\'s name?', 'Tom'),
(5, 15, 'What\'s your nickname?', 'Kay'),
(6, 16, 'Where were you born?', 'hospital'),
(7, 17, 'What\'s your pet\'s name?', 'kfc');

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
(6, '2023-05-09 09:26:43', 2, 15, 'test'),
(21, '2023-05-11 04:49:30', 15, 2, 'test'),
(22, '2023-05-11 04:49:32', 15, 2, 'test'),
(23, '2023-05-11 04:49:34', 15, 2, 'test'),
(24, '2023-05-11 04:49:35', 15, 2, 'test'),
(25, '2023-05-11 04:49:37', 15, 2, 'test'),
(26, '2023-05-11 04:49:38', 15, 2, 'test'),
(27, '2023-05-11 04:49:39', 15, 2, 'test'),
(28, '2023-05-11 04:49:41', 15, 2, 'test'),
(29, '2023-05-11 04:49:42', 15, 2, 'test'),
(30, '2023-05-11 04:49:43', 15, 2, 'test'),
(31, '2023-05-11 04:49:45', 15, 2, 'test'),
(32, '2023-05-11 04:49:47', 15, 2, 'test'),
(33, '2023-05-11 04:49:49', 15, 2, '2222'),
(34, '2023-05-13 22:09:13', 2, 16, 'hello miss lori'),
(35, '2023-05-16 20:19:24', 2, 24, 'hi');

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
(10, 15, 'Literacy: Writing/Spelling'),
(11, 16, 'Autism Spectrum Disorder'),
(12, 16, 'Developmental Language Disorder'),
(13, 16, 'Intellectual Disabilities'),
(14, 16, 'Language/Learning Disabilities'),
(15, 16, 'Parent Coaching'),
(16, 16, 'Speech Sound Disorders'),
(17, 16, 'Literacy: Reading/Dyslexia'),
(18, 16, 'Literacy: Writing/Spelling'),
(19, 17, 'Autism Spectrum Disorder'),
(20, 17, 'Cultural and Linguistic Diversity/Bilingual Speakers/English as a Second Language'),
(21, 17, 'Developmental Language Disorder'),
(22, 17, 'Language/Learning Disabilities'),
(23, 17, 'Speech Sound Disorders'),
(24, 17, 'Literacy: Reading/Dyslexia'),
(26, 24, 'ttesting'),
(27, 24, 'testing2'),
(28, 25, 'test two'),
(29, 26, 'test test three'),
(30, 27, 'Autism Spectrum Disorder'),
(31, 27, 'Cultural and Linguistic Diversity/Bilingual Speakers/English as a Second Language'),
(32, 27, 'Developmental Language Disorder'),
(33, 27, 'Language/Learning Disabilities'),
(34, 27, 'Parent Coaching'),
(35, 27, 'Speech Sound Disorders'),
(36, 27, 'Literacy: Reading/Dyslexia'),
(37, 27, 'Literacy: Writing/Spelling');

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
(33, 'Difficulty with language production or expression, such as word retrieval or putting words together to form sentences'),
(37, 'Defiance towards authority figures'),
(38, 'argumentative behavior'),
(39, 'vindictiveness'),
(40, 'Aggressive behavior towards people or animals'),
(41, 'destruction of property'),
(42, 'deceitfulness or theft'),
(43, 'Difficulty with reading, spelling, and writing'),
(44, 'trouble with phonological processing'),
(45, 'Persistent feelings of sadness, hopelessness, and loss of interest in activities'),
(46, 'Abnormal eating habits, including restriction of food intake or binge eating'),
(47, 'body dysmorphia'),
(48, 'Delusions'),
(49, 'hallucinations'),
(50, 'disorganized speech and behavior'),
(51, 'flattened emotions'),
(52, 'Recurrent and intrusive thoughts or images (obsessions) that cause anxiety'),
(53, 'repetitive behaviors or mental acts (compulsions), to alleviate anxiety'),
(54, 'Medication, cognitive behavioral therapy, and exposure and response prevention therapy'),
(55, 'Difficulty with mathematical concepts, such as numbers, arithmetic, and mathematical reasoning'),
(56, 'Unfounded and persistent suspicion or mistrust of others'),
(57, 'hypersensitivity to criticism or negative feedback'),
(58, 'Intellectual and adaptive limitations in communication'),
(59, 'Intellectual and adaptive limitations in self care and social skills');

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
(8, 'Behavioral therapy, family therapy, and medication for co-occurring conditions', 10),
(9, 'Behavioral therapy, parent training, and medication for co-occurring conditions', 11),
(10, 'Behavioral therapy, family therapy, and medication for co-occurring conditions', 12),
(11, 'Educational therapy, accommodations in school or work, and assistive technology', 13),
(12, 'Medication, psychotherapy, and lifestyle changes', 14),
(13, 'Nutritional counseling, psychotherapy, and medication for co-occurring conditions', 15),
(14, 'Medication, psychotherapy, and support for caregivers', 16),
(15, 'Medication, cognitive behavioral therapy, and exposure and response prevention therapy', 17),
(16, 'Exposure therapy, cognitive behavioral therapy, and medication for co-occurring conditions', 18),
(17, 'Educational therapy, accommodations in school or work, and assistive technology', 19),
(18, 'Medication, psychotherapy, and lifestyle changes', 20),
(19, 'Education and training, behavioral therapy, and medication for co-occurring conditions', 21),
(24, 'Medication, psychotherapy, and support for caregivers', 26);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_center`
--

CREATE TABLE `treatment_center` (
  `treat_center_id` int(11) NOT NULL,
  `center_name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `picture` varchar(250) NOT NULL DEFAULT 'defaultTreatmentCenter.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment_center`
--

INSERT INTO `treatment_center` (`treat_center_id`, `center_name`, `description`, `status`, `picture`) VALUES
(2, 'REACH Behavior and Development Center | ABA Therapy, Speech Therapy, Occupational Therapy, Autism, ADHD, Child Development Center in Bahrain', 'Located in: Nakheel Center\r\nAddress: Nakheel Centre – 2nd Floor, Building 789, Road 1322, Saar\r\nAreas served: Bahrain.\r\nPhone: 3900 6065\r\nAppointments: reachabatherapy.com', 'active', 'nakheel.jpg'),
(4, 'Bahrain Specialist Hospital', 'Address: Building 2743, Road No 2447, Block 324 Juffair, 324\r\nHours: Open 24 hours\r\nPhone: 1781 2222', 'active', 'bahrainspecialist.jpg'),
(5, 'Royal Bahrain Hospital', '\r\nPrivate hospital in Manama\r\nAddress: Building 119, Block 329 King Abdul Aziz Avenue, Salmaniya\r\nHours: Open 24 hours\r\nPhone: 1724 6800', 'active', 'royalbahrain.jpeg'),
(6, 'Britus International School - Special Education', 'Special education school in Bu Quwah\r\nAddress: Bldg 2312, Road 5755, Block 457, Bu Quwah\r\nPhone: 1656 8120', 'active', 'britus.jpeg'),
(7, 'The RIA Institute', 'Education center in Manama\r\nAddress: villa 2749 Rd No 2771, Manama\r\nPhone: 1771 6871', 'active', 'ria.jpg'),
(8, 'Bahrain Institute for Special Education', 'Learning center in Manama\r\nAddress: 6HG4+R7H, Manama\r\nPhone: 1755 6613', 'active', 'bahraininstitutespecial.jpg'),
(9, 'test treatment center', 'more details 1 ', 'inactive', 'picscenary116842606025586997326463c6faba17f.jpg'),
(10, 'American Mission Hospital', 'Hospital in Manama\r\nAddress: Manama\r\nHours: open 24 hours\r\nPhone: 17171717', 'active', 'picamerican16856526941577501263647904d649f0d.png');

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
(1, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'picscenary116856527571550036025647905159fd49.jpg', 'active'),
(2, 'Max', 'maximus1@gmail.com', '390c97e1249a58cf0b510d81f35f771b', 'member', 'pic21685733106786563711647a3ef2e2624.png', 'active'),
(3, 'aa', 'aaa@aa.com', '7c3d596ed03ab9116c547b0eb678b247', 'member', 'default.jpg', 'inactive'),
(14, 'specialis three', 'specialist3@pm.com', 'b4a7495aa0ec7fc2caa321ba632c36ef', 'specialist', 'default.jpg', 'inactive'),
(15, 'Karen Clapper', 'karenclapper@pm.com', 'f0a409766608747e98d81cf932c48ea0', 'specialist', 'pickaren16837770081131057335645c65f07b323.jpg', 'active'),
(16, 'Lori M. Allen', 'lori.allen@bmcjax.com', 'cd4a3709f9397a0b0e4d25057c18d9c4', 'specialist', 'piclori16837772911067615529645c670b27aec.jpg', 'active'),
(17, 'Alejandro E. Brice', 'aebrice@usf.edu', '3ae70dc637b30bd7729ed1c87ec2a762', 'specialist', 'picalejandro1683777761791651385645c68e15d785.jpg', 'active'),
(18, 'ali', 'ali123@gmail.com', '984d8144fa08bfc637d2825463e184fa', 'member', 'default.jpg', 'active'),
(22, 'member four', 'member4@gmail.com', 'a998123003066ac9fa7de4b100e7c4bc', 'member', 'default.jpg', 'active'),
(24, 'test specialist ', 'testspecialist@mail.com', '14a6da108721595b5da527b32a2d0f65', 'specialist', 'default.jpg', 'inactive'),
(25, 'test two specialist', 'testtwo@specialist.com', '3be0005a2ce3d8cd56de93c6ee3cdf22', 'specialist', 'default.jpg', 'inactive'),
(26, 'test three', 'testtest3@gmail.com', 'bb86c291743c3edcf6c76e4ff69f974f', 'specialist', 'piccat16842634862862332786463d23e8370f.jpg', 'inactive'),
(27, 'Asabe Lars', 'asabelars@onlinemed.org', '77f8302c8fad1cecc3bc6f903002c85a', 'specialist', 'picdoc16857287401667025693647a2de424af1.png', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkup_history`
--
ALTER TABLE `checkup_history`
  ADD PRIMARY KEY (`check_hist_id`);

--
-- Indexes for table `customer_support_messages`
--
ALTER TABLE `customer_support_messages`
  ADD PRIMARY KEY (`c_id`);

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
-- Indexes for table `forgot_password_answers`
--
ALTER TABLE `forgot_password_answers`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `userid_userid_fk` (`user_id`);

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
  MODIFY `check_hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customer_support_messages`
--
ALTER TABLE `customer_support_messages`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `disease_symptoms`
--
ALTER TABLE `disease_symptoms`
  MODIFY `dis_symp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `disease__treatmentcenter`
--
ALTER TABLE `disease__treatmentcenter`
  MODIFY `dis_treatcenter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `forgot_password_answers`
--
ALTER TABLE `forgot_password_answers`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `specialists-expertise`
--
ALTER TABLE `specialists-expertise`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symptom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `treatment_center`
--
ALTER TABLE `treatment_center`
  MODIFY `treat_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `treatcenter_fk` FOREIGN KEY (`treat_center_id`) REFERENCES `treatment_center` (`treat_center_id`);

--
-- Constraints for table `forgot_password_answers`
--
ALTER TABLE `forgot_password_answers`
  ADD CONSTRAINT `userid_userid_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
