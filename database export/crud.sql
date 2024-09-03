-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 07:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblrecord`
--

CREATE TABLE `tblrecord` (
  `id` int(5) NOT NULL,
  `_id` varchar(18) NOT NULL,
  `name` text NOT NULL,
  `mobile` bigint(12) NOT NULL,
  `email` varchar(25) NOT NULL,
  `profilePicture` varchar(100) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrecord`
--

INSERT INTO `tblrecord` (`id`, `_id`, `name`, `mobile`, `email`, `profilePicture`, `designation`, `date`) VALUES
(1, '2a549f1ee', 'John Doe', 1234567890, 'john.doe@example.com', 'uploads/2a549f1eeprofile_imag8219.jpg', 'Software Engineer', '2024-09-02 21:48:05'),
(2, '8950ce4d3', 'Jane Smith', 2345678901, 'jane.smith@example.com', 'uploads/8950ce4d3profile_imag8219.jpg', 'Project Manager', '2024-09-02 21:48:05'),
(3, 'd37874627', 'Alice Johnson', 3456789012, 'alice.johnson@example.com', 'uploads/d37874627profile_imag8219.jpg', 'UX Designer', '2024-09-02 21:48:05'),
(4, 'b601517a2', 'Bob Brown', 4567890123, 'bob.brown@example.com', 'uploads/b601517a2profile_imag8219.jpg', 'Data Analyst', '2024-09-02 21:48:05'),
(5, '3d351236f', 'Charlie Davis', 5678901234, 'charlie.davis@example.com', 'uploads/3d351236fprofile_imag8219.jpg', 'System Administrator', '2024-09-02 21:48:05'),
(6, 'eb5795d2a', 'David Wilson', 6789012345, 'david.wilson@example.com', 'uploads/eb5795d2aprofile_imag8219.jpg', 'Database Administrat', '2024-09-02 21:48:06'),
(7, 'fc2d1dfbf', 'Eva Miller', 7890123456, 'eva.miller@example.com', 'uploads/fc2d1dfbfprofile_imag8219.jpg', 'Front-End Developer', '2024-09-02 21:48:06'),
(8, '0e523e22d', 'Frank Moore', 8901234567, 'frank.moore@example.com', 'uploads/0e523e22dprofile_imag8219.jpg', 'Back-End Developer', '2024-09-02 21:48:06'),
(9, 'e90ca1ab3', 'Grace Taylor', 9012345678, 'grace.taylor@example.com', 'uploads/e90ca1ab3profile_imag8219.jpg', 'Full Stack Developer', '2024-09-02 21:48:06'),
(10, 'd93b9204c', 'Henry Anderson', 123456789, 'henry.anderson@example.co', 'uploads/d93b9204cprofile_imag8219.jpg', 'DevOps Engineer', '2024-09-02 21:48:06'),
(11, 'd150b27dc', 'Isabella Thomas', 1234567891, 'isabella.thomas@example.c', 'uploads/d150b27dcprofile_imag8219.jpg', 'Network Engineer', '2024-09-02 21:48:06'),
(12, 'e7306d3d9', 'Jack Harris', 2345678902, 'jack.harris@example.com', 'uploads/e7306d3d9profile_imag8219.jpg', 'IT Support Specialis', '2024-09-02 21:48:07'),
(13, '0ccc6137c', 'Katherine Clark', 3456789013, 'katherine.clark@example.c', 'uploads/0ccc6137cprofile_imag8219.jpg', 'Business Analyst', '2024-09-02 21:48:07'),
(14, '51ad5cb37', 'Liam Lewis', 4567890124, 'liam.lewis@example.com', 'uploads/51ad5cb37profile_imag8219.jpg', 'Quality Assurance', '2024-09-02 21:48:07'),
(15, '0528c7e9a', 'Mia Walker', 5678901235, 'mia.walker@example.com', 'uploads/0528c7e9aprofile_imag8219.jpg', 'Product Manager', '2024-09-02 21:48:07'),
(16, 'fa4f3e6ff', 'Noah Hall', 6789012346, 'noah.hall@example.com', 'uploads/fa4f3e6ffprofile_imag8219.jpg', 'Sales Engineer', '2024-09-02 21:48:08'),
(17, '49ea600ad', 'Olivia Allen', 7890123457, 'olivia.allen@example.com', 'uploads/49ea600adprofile_imag8219.jpg', 'Customer Success Man', '2024-09-02 21:48:08'),
(18, '65e461889', 'Paul Young', 8901234568, 'paul.young@example.com', 'uploads/65e461889profile_imag8219.jpg', 'Marketing Specialist', '2024-09-02 21:48:08'),
(19, 'e5562be00', 'Quinn King', 9012345679, 'quinn.king@example.com', 'uploads/e5562be00profile_imag8219.jpg', 'Content Creator', '2024-09-02 21:48:08'),
(20, 'f05224373', 'Rachel Scott', 123456790, 'rachel.scott@example.com', 'uploads/f05224373profile_imag8219.jpg', 'Graphic Designer', '2024-09-02 21:48:08'),
(21, '63ff8aa0f', 'Samuel Wright', 1234567892, 'samuel.wright@example.com', 'uploads/63ff8aa0fprofile_imag8219.jpg', 'SEO Specialist', '2024-09-02 21:48:09'),
(22, 'e8dc20ecd', 'Taylor Green', 2345678903, 'taylor.green@example.com', 'uploads/e8dc20ecdprofile_imag8219.jpg', 'Social Media Manager', '2024-09-02 21:48:09'),
(23, 'f51ad2248', 'Uma Adams', 3456789014, 'uma.adams@example.com', 'uploads/f51ad2248profile_imag8219.jpg', 'Video Editor', '2024-09-02 21:48:09'),
(24, '5e7788385', 'Victor Baker', 4567890125, 'victor.baker@example.com', 'uploads/5e7788385profile_imag8219.jpg', 'Web Designer', '2024-09-02 21:48:09'),
(25, '4d8fe6f7e', 'Wendy Carter', 5678901236, 'wendy.carter@example.com', 'uploads/4d8fe6f7eprofile_imag8219.jpg', 'Product Designer', '2024-09-02 21:48:09'),
(26, '63b0eafc0', 'Xander Evans', 6789012347, 'xander.evans@example.com', 'uploads/63b0eafc0profile_imag8219.jpg', 'Cloud Engineer', '2024-09-02 21:48:10'),
(27, '181ae3bb6', 'Yara Mitchell', 7890123458, 'yara.mitchell@example.com', 'uploads/181ae3bb6profile_imag8219.jpg', 'IT Consultant', '2024-09-02 21:48:10'),
(28, '29222a3b7', 'Zachary Roberts', 8901234569, 'zachary.roberts@example.c', 'uploads/29222a3b7profile_imag8219.jpg', 'Technical Writer', '2024-09-02 21:48:10'),
(29, '8f016f22f', 'Alice Morgan', 9012345680, 'alice.morgan@example.com', 'uploads/8f016f22fprofile_imag8219.jpg', 'HR Manager', '2024-09-02 21:48:10'),
(30, '58bdc9d90', 'Bob Martinez', 123456791, 'bob.martinez@example.com', 'uploads/58bdc9d90profile_imag8219.jpg', 'Recruiter', '2024-09-02 21:48:10'),
(31, '0dd17e4d4', 'Charlie Lee', 1234567893, 'charlie.lee@example.com', 'uploads/0dd17e4d4profile_imag8219.jpg', 'Operations Manager', '2024-09-02 21:48:11'),
(32, '76c014b2a', 'Diana Murphy', 2345678904, 'diana.murphy@example.com', 'uploads/76c014b2aprofile_imag8219.jpg', 'Account Manager', '2024-09-02 21:48:11'),
(33, '157da2cc0', 'Edward Perry', 3456789015, 'edward.perry@example.com', 'uploads/157da2cc0profile_imag8219.jpg', 'Financial Analyst', '2024-09-02 21:48:11'),
(34, 'cf1273a2a', 'Fiona Reed', 4567890126, 'fiona.reed@example.com', 'uploads/cf1273a2aprofile_imag8219.jpg', 'Business Development', '2024-09-02 21:48:11'),
(35, '72df78b6c', 'George Bennett', 5678901237, 'george.bennett@example.co', 'uploads/72df78b6cprofile_imag8219.jpg', 'Systems Analyst', '2024-09-02 21:48:11'),
(36, '8d34b4605', 'Hannah Barnes', 6789012348, 'hannah.barnes@example.com', 'uploads/8d34b4605profile_imag8219.jpg', 'Customer Support Spe', '2024-09-02 21:48:11'),
(37, 'd4f55888e', 'Ian Hughes', 7890123459, 'ian.hughes@example.com', 'uploads/d4f55888eprofile_imag8219.jpg', 'Event Coordinator', '2024-09-02 21:48:11'),
(38, '2f7931aad', 'Jessica Collins', 8901234570, 'jessica.collins@example.c', 'uploads/2f7931aadprofile_imag8219.jpg', 'Administrative Assis', '2024-09-02 21:48:12'),
(39, 'ac72bcad3', 'Kyle Foster', 9012345681, 'kyle.foster@example.com', 'uploads/ac72bcad3profile_imag8219.jpg', 'Legal Advisor', '2024-09-02 21:48:12'),
(40, '323df21d2', 'Laura Gonzalez', 123456792, 'laura.gonzalez@example.co', 'uploads/323df21d2profile_imag8219.jpg', 'Compliance Officer', '2024-09-02 21:48:12'),
(41, '99dfedaf0', 'Michael Ward', 1234567894, 'michael.ward@example.com', 'uploads/99dfedaf0profile_imag8219.jpg', 'IT Manager', '2024-09-02 21:48:12'),
(42, 'd6722443a', 'Nina Griffin', 2345678905, 'nina.griffin@example.com', 'uploads/d6722443aprofile_imag8219.jpg', 'Design Lead', '2024-09-02 21:48:12'),
(43, 'ab41573bc', 'Oliver Wells', 3456789016, 'oliver.wells@example.com', 'uploads/ab41573bcprofile_imag8219.jpg', 'SEO Manager', '2024-09-02 21:48:12'),
(44, '412e06316', 'Paula Diaz', 4567890127, 'paula.diaz@example.com', 'uploads/412e06316profile_imag8219.jpg', 'Content Strategist', '2024-09-02 21:48:12'),
(45, 'a505783c0', 'Quincy Wood', 5678901238, 'quincy.wood@example.com', 'uploads/a505783c0profile_imag8219.jpg', 'Sales Manager', '2024-09-02 21:48:12'),
(46, 'fa3a44c0e', 'Riley Cook', 6789012349, 'riley.cook@example.com', 'uploads/fa3a44c0eprofile_imag8219.jpg', 'Technical Support Sp', '2024-09-02 21:48:13'),
(47, '71dcb7f39', 'Samantha Price', 7890123460, 'samantha.price@example.co', 'uploads/71dcb7f39profile_imag8219.jpg', 'Product Marketing Ma', '2024-09-02 21:48:13'),
(48, 'ceffbf923', 'Thomas Hughes', 8901234571, 'thomas.hughes@example.com', 'uploads/ceffbf923profile_imag8219.jpg', 'Chief Technology Off', '2024-09-02 21:48:13'),
(49, '308ae606f', 'Ursula Rivera', 9012345682, 'ursula.rivera@example.com', 'uploads/308ae606fprofile_imag8219.jpg', 'Operations Director', '2024-09-02 21:48:13'),
(50, 'bad3637c7', 'Victor Hughes', 123456793, 'victor.hughes@example.com', 'uploads/bad3637c7profile_imag8219.jpg', 'Chief Financial Offi', '2024-09-02 21:48:13'),
(51, '83c5e29fc', 'Wendy Sanders', 1234567895, 'wendy.sanders@example.com', 'uploads/83c5e29fcprofile_imag8219.jpg', 'Chief Executive Offi', '2024-09-02 21:48:13'),
(52, '82048e450', 'John Doe', 1234567890, 'john.doe@example.com', 'uploads/82048e450profile_imag8219.jpg', 'Software Engineer', '2024-09-03 11:05:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblrecord`
--
ALTER TABLE `tblrecord`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblrecord`
--
ALTER TABLE `tblrecord`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
