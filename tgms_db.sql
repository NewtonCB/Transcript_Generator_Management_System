-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 08:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tgms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `c_id` bigint(20) NOT NULL,
  `c_name` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`c_id`, `c_name`, `course_id`, `dept_id`) VALUES
(1, 'BENG 21 COE', 21, 1),
(2, 'OD 21 MFT', 22, 6);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `dept_id`) VALUES
(21, 'Bachelor Engineering In Computer Engineering', 1),
(22, 'Ordinary Diploma In Multimedia And Firm Technology Engineering', 6),
(23, 'Bachelor Engineering In Electronics and Telecommunication Engineering', 2),
(24, 'Bachelor Engineering In Civil Engineering', 3),
(25, 'Bachelor Engineering In Electrical Engineering', 4),
(26, 'Bachelor Engineering In Civil Engineering', 7),
(27, 'Bachelor Engineering In Mining Engineering', 5),
(28, 'Ordinary Diploma In Computer Engineering', 1),
(29, 'Ordinary Diploma In Information Technology Engineering', 1),
(30, 'Ordinary Diploma In Civil Engineering', 3),
(31, 'Ordinary Diploma In Electrical Engineering', 4),
(32, 'Ordinary Diploma In Electronics And Telecommunication Engineering', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'Computer Studies'),
(2, 'Electronics And Telecomunication'),
(3, 'Civil'),
(4, 'Electrical'),
(5, 'Mining'),
(6, 'Multimedia'),
(7, 'Mechanics'),
(8, 'Medical Laboratory');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `modCode` text NOT NULL,
  `modName` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`modCode`, `modName`, `credit`, `sess_id`, `sem_id`, `level_id`, `course_id`, `dept_id`) VALUES
('63278', 'CyberSecurity', 6, 0, 1, 0, 1, 903),
('77', 'Web Application Development', 9, 10, 2, 8303, 19, 993),
('COU 07501', 'Database Programing Administration ', 9, 3, 1, 7, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nta_level`
--

CREATE TABLE `nta_level` (
  `level_id` int(11) NOT NULL,
  `Level_status` varchar(255) NOT NULL,
  `category(BENG/OD)` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nta_level`
--

INSERT INTO `nta_level` (`level_id`, `Level_status`, `category(BENG/OD)`) VALUES
(4, 'NTA_Level 4', 'ORDINARY DIPLOMA'),
(5, 'NTA_Level 5', 'ORDINARY DIPLOMA'),
(6, 'NTA_Level 6', 'ORDINARY DIPLOMA'),
(7, 'NTA_Level 7', 'BACHELOR ENGINEERING'),
(8, 'NTA_Level 8', 'BACHELOR ENGINEERING'),
(9, 'NTA_Level 9', 'BACHELOR ENGINEERING'),
(10, 'NTA_Level 10', 'MASTERS DEGREE'),
(11, 'NTA_Level 11', 'MASTERS DEGREE');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `res_id` bigint(20) NOT NULL,
  `regNo` bigint(20) NOT NULL,
  `modCode` varchar(255) NOT NULL,
  `modName` varchar(255) NOT NULL,
  `CA` int(11) NOT NULL,
  `FE` int(11) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `grade_point` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`res_id`, `regNo`, `modCode`, `modName`, `CA`, `FE`, `grade`, `grade_point`, `credit`, `level_id`, `sess_id`, `sem_id`, `dept_id`) VALUES
(1, 200230225910, '63278', '', 27, 27, '', 0, 0, 0, 0, 0, 0),
(2, 200230225526, '63278', '', 46, 32, '', 0, 0, 0, 0, 0, 0),
(3, 210240224944, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(4, 200230226058, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(5, 2002302210228, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(6, 2102302230166, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(7, 200230225928, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(8, 200230226702, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(9, 200230225829, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(10, 200230226892, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(11, 200230225860, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(12, 210240226378, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(13, 210240225412, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(14, 200230226769, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(15, 2002302211382, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(16, 2002302210020, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(17, 200230226744, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(18, 200230225915, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(19, 200230225510, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(20, 200230225530, '63278', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(21, 200230225910, '77', '', 20, 40, '', 0, 0, 0, 0, 0, 0),
(22, 200230225526, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(23, 210240224944, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(24, 200230226058, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(25, 2002302210228, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(26, 2102302230166, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(27, 200230225928, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(28, 200230226702, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(29, 200230225829, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(30, 200230226892, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(31, 200230225860, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(32, 210240226378, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(33, 210240225412, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(34, 200230226769, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(35, 2002302211382, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(36, 2002302210020, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(37, 200230226744, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(38, 200230225915, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(39, 200230225510, '77', '', 0, 0, '', 0, 0, 0, 0, 0, 0),
(40, 200230225530, '77', '', 20, 40, '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sem_id` int(11) NOT NULL,
  `semName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sem_id`, `semName`) VALUES
(1, 'SEMESTER 1'),
(2, 'SEMESTER 2'),
(3, 'SEMESTER 3'),
(4, 'SEMESTER 4'),
(5, 'SEMESTER 5'),
(6, 'SEMESTER 6'),
(7, 'SEMESTER 7'),
(8, 'SEMESTER 8');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sess_id` bigint(20) NOT NULL,
  `start_Date` date DEFAULT NULL,
  `end_Date` date DEFAULT NULL,
  `sess_status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sess_id`, `start_Date`, `end_Date`, `sess_status`) VALUES
(1, '2020-11-24', '2021-08-16', '2020/2021'),
(2, '2021-10-24', '2022-07-05', '2021/2022'),
(3, '2022-11-05', '2023-07-11', '2022/2023');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `regNo` bigint(20) NOT NULL,
  `NHIF_Number` bigint(20) DEFAULT NULL,
  `CSSE_Index` text DEFAULT NULL,
  `Phone_No` int(20) DEFAULT NULL,
  `Picture` blob DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `givenNames` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `admDate` datetime DEFAULT NULL,
  `grdDate` date DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `c_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`regNo`, `NHIF_Number`, `CSSE_Index`, `Phone_No`, `Picture`, `Nationality`, `surname`, `givenNames`, `gender`, `birthDate`, `admDate`, `grdDate`, `dept_id`, `level_id`, `course_id`, `c_id`) VALUES
(2102302217601, NULL, NULL, NULL, NULL, 'Tanzania', 'ABEID', 'KABIR ALI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302228228, NULL, NULL, NULL, NULL, 'Tanzania', 'ALOYCE', 'THOMAS JAMES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302233988, NULL, NULL, NULL, NULL, 'Tanzania', 'AMINI', 'AMINI A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242407831, NULL, NULL, NULL, NULL, 'Tanzania', 'BAPTISTER', 'ERNEST STANLEY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216868, NULL, NULL, NULL, NULL, 'Tanzania', 'BLASIUS', 'RAYMOND LEMIJIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217981, NULL, NULL, NULL, NULL, 'Tanzania', 'CHACHA', 'PAUL SIMON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242476497, NULL, NULL, NULL, NULL, 'Tanzania', 'CHAMWI', 'MIKE FRANCIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302226222, NULL, NULL, NULL, NULL, 'Tanzania', 'CHENGULA', 'BENJAMIN L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222254, NULL, NULL, NULL, NULL, 'Tanzania', 'CHOVE', 'DENNIS FRANCIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302121464, NULL, NULL, NULL, NULL, 'Tanzania', 'CRISPIN', 'BEATRICE BARNABAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221215, NULL, NULL, NULL, NULL, 'Tanzania', 'DEOGRATIAS', 'SOSTHENES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220654, NULL, NULL, NULL, NULL, 'Tanzania', 'EMMANUEL', 'BARAKA MARWA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217502, NULL, NULL, NULL, NULL, 'Tanzania', 'GALLAMULA', 'WILLIAM GEOFFREY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242443877, NULL, NULL, NULL, NULL, 'Tanzania', 'GERSHON', 'SANGA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242476380, NULL, NULL, NULL, NULL, 'Tanzania', 'HARUBU', 'NASRA SALIMU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302219987, NULL, NULL, NULL, NULL, 'Tanzania', 'IDD', 'BASHIRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302118627, NULL, NULL, NULL, NULL, 'Tanzania', 'ISSA', 'JAZILA MUHAMMED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222833, NULL, NULL, NULL, NULL, 'Tanzania', 'JACOB', 'FRANK ELIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302121423, NULL, NULL, NULL, NULL, 'Tanzania', 'JOHN', 'MIRIAM ROBERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220050, NULL, NULL, NULL, NULL, 'Tanzania', 'JOHN', 'SYLVESTER LUSEKELO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216603, NULL, NULL, NULL, NULL, 'Tanzania', 'JOSEPH', 'AUGUSTINO V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302130093, NULL, NULL, NULL, NULL, 'Tanzania', 'JUMA', 'LETICIA RICHARD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302226735, NULL, NULL, NULL, NULL, 'Tanzania', 'JUMA', 'SADICK ALLY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242447316, NULL, NULL, NULL, NULL, 'Tanzania', 'JUMA', 'THUMAIYA J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218542, NULL, NULL, NULL, NULL, 'Tanzania', 'KABIGUMILA', 'NELSON M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220407, NULL, NULL, NULL, NULL, 'Tanzania', 'KAGERO', 'RAYMOND L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220647403467, NULL, NULL, NULL, NULL, 'Tanzania', 'KAIJANANGOMA', 'DICKSON D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222494, NULL, NULL, NULL, NULL, 'Tanzania', 'KAKULWA', 'GODSON G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242439271, NULL, NULL, NULL, NULL, 'Tanzania', 'KALASA', 'THOMAS JOSEPH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210240225586, NULL, NULL, NULL, NULL, 'Tanzania', 'KANAFUNZI', 'EFATHA JOHN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302122892, NULL, NULL, NULL, NULL, 'Tanzania', 'KANZA', 'GIFT KAINI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302118866, NULL, NULL, NULL, NULL, 'Tanzania', 'KIBONDE', 'IRENE D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117520, NULL, NULL, NULL, NULL, 'Tanzania', 'KIDESU', 'NASRAH ADAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216637, NULL, NULL, NULL, NULL, 'Tanzania', 'KIKOTA', 'ELIUD S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242478733, NULL, NULL, NULL, NULL, 'Tanzania', 'KILEO', 'RAYMOND E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222759, NULL, NULL, NULL, NULL, 'Tanzania', 'KILIMALENGA', 'ELTON PATSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217262, NULL, NULL, NULL, NULL, 'Tanzania', 'KIRSCHSTEIN', 'DAVID ALFRED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220183, NULL, NULL, NULL, NULL, 'Tanzania', 'KULANGA', 'CHRISPIN V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216553, NULL, NULL, NULL, NULL, 'Tanzania', 'KUSAYA', 'DANIEL BENARD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221926, NULL, NULL, NULL, NULL, 'Tanzania', 'KUSAYA', 'EDSON E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216942, NULL, NULL, NULL, NULL, 'Tanzania', 'LAZARO', 'INNOCENT D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242442317, NULL, NULL, NULL, NULL, 'Tanzania', 'LIMBU', 'MOSES YUSUPH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302231834, NULL, NULL, NULL, NULL, 'Tanzania', 'LOMAYANI', 'EMANUEL J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117561, NULL, NULL, NULL, NULL, 'Tanzania', 'LOZZY', 'NATASHA HALIM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216892, NULL, NULL, NULL, NULL, 'Tanzania', 'LUBUVA', 'KELVIN MARIO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2002302214758, NULL, NULL, NULL, NULL, 'Tanzania', 'LWENA', 'Deogratius D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216405, NULL, NULL, NULL, NULL, 'Tanzania', 'MACHA', 'OSCAR W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117074, NULL, NULL, NULL, NULL, 'Tanzania', 'MACHA', 'PENINA E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302229465, NULL, NULL, NULL, NULL, 'Tanzania', 'MADUKA', 'GEORGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210141628466, NULL, NULL, NULL, NULL, 'Tanzania', 'MAFIE', 'Jimmy Godlove', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216959, NULL, NULL, NULL, NULL, 'Tanzania', 'MAFWENGA', 'STEVEN ELMON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218591, NULL, NULL, NULL, NULL, 'Tanzania', 'MAHIKIMBA', 'LUCAS GUSINGA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220647411874, NULL, NULL, NULL, NULL, 'Tanzania', 'MANGA', 'ISDORA WENDELIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302116589, NULL, NULL, NULL, NULL, 'Tanzania', 'MANYAMA', 'GLADY C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200230227635, NULL, NULL, NULL, NULL, 'Tanzania', 'MAPUNDA', 'Davis Folkward', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302119849, NULL, NULL, NULL, NULL, 'Tanzania', 'MAPUNDA', 'HERIETH SAIMON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180230220543, NULL, NULL, NULL, NULL, 'Tanzania', 'MARIDADI', 'Ally Salum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117462, NULL, NULL, NULL, NULL, 'Tanzania', 'MARSHA', 'LATIFA F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200230225936, NULL, NULL, NULL, NULL, 'Tanzania', 'MASANJA', 'Francisco P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302225133, NULL, NULL, NULL, NULL, 'Tanzania', 'MASEGELA', 'DENIS R', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242431211, NULL, NULL, NULL, NULL, 'Tanzania', 'MASUDI', 'RIAN NDALU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216496, NULL, NULL, NULL, NULL, 'Tanzania', 'MATIKO', 'MUSA J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242469815, NULL, NULL, NULL, NULL, 'Tanzania', 'MAWOLE', 'ELISIFA FREDSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217767, NULL, NULL, NULL, NULL, 'Tanzania', 'MAYILA', 'GODFREY ABEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220076, NULL, NULL, NULL, NULL, 'Tanzania', 'MAZINDE', 'RICHARD ISRAEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302225174, NULL, NULL, NULL, NULL, 'Tanzania', 'MBWAGHA', 'SHADRACK SYLVESTER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220415, NULL, NULL, NULL, NULL, 'Tanzania', 'MCHAU', 'VALLERIAN PETER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302219060, NULL, NULL, NULL, NULL, 'Tanzania', 'MIANGWA', 'HENDRICK EMMANUEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216835, NULL, NULL, NULL, NULL, 'Tanzania', 'MKENDA', 'YONAZ G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242424638, NULL, NULL, NULL, NULL, 'Tanzania', 'MKIRAMWENI', 'KESIA KEBA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220357, NULL, NULL, NULL, NULL, 'Tanzania', 'MMARY', 'JOSEPH PROCHES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302126596, NULL, NULL, NULL, NULL, 'Tanzania', 'MOHAMED', 'FATUMA JARUFU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216520, NULL, NULL, NULL, NULL, 'Tanzania', 'MOHAMED', 'SALEH KHAMIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218179, NULL, NULL, NULL, NULL, 'Tanzania', 'MOHAMMED', 'MOHAMMED H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302224292, NULL, NULL, NULL, NULL, 'Tanzania', 'MOLLEL', 'KENNEDY ROBINSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221538, NULL, NULL, NULL, NULL, 'Tanzania', 'MOSHA', 'DENNIS AKWILINI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222221, NULL, NULL, NULL, NULL, 'Tanzania', 'MPANGALA', 'ISSACK EMMANUEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222270, NULL, NULL, NULL, NULL, 'Tanzania', 'MPONDA', 'AMAN GAUFRID', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220092, NULL, NULL, NULL, NULL, 'Tanzania', 'MPWINIZA', 'ENDRY RICHARD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302228616, NULL, NULL, NULL, NULL, 'Tanzania', 'MSEMAKWELI', 'DANIEL MASANJA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242413391, NULL, NULL, NULL, NULL, 'Tanzania', 'MSHANA', 'RASUL MOHAMMED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222080, NULL, NULL, NULL, NULL, 'Tanzania', 'MSIGWA', 'SAMWEL E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117140, NULL, NULL, NULL, NULL, 'Tanzania', 'MSOKE', 'FAUDHIA IBRAHIMU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242464527, NULL, NULL, NULL, NULL, 'Tanzania', 'MSUYA', 'ENOCK JOHNSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302118791, NULL, NULL, NULL, NULL, 'Tanzania', 'MSUYA', 'SABRINA A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221678, NULL, NULL, NULL, NULL, 'Tanzania', 'MTOI', 'MICHAEL P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302117751, NULL, NULL, NULL, NULL, 'Tanzania', 'MULLO', 'DORCAS HERMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217387, NULL, NULL, NULL, NULL, 'Tanzania', 'MUTABUZI', 'BLESSILIUS GEORGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218427, NULL, NULL, NULL, NULL, 'Tanzania', 'MWAIPOPO', 'NATHANIEL A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222684, NULL, NULL, NULL, NULL, 'Tanzania', 'MWAKYUSA', 'BARNABAS L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222700, NULL, NULL, NULL, NULL, 'Tanzania', 'MWASIKALANGA', 'RICHARD C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242407393, NULL, NULL, NULL, NULL, 'Tanzania', 'MWEBESA', 'MICHAEL M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302229374, NULL, NULL, NULL, NULL, 'Tanzania', 'MWIJAGE', 'NICASIUS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218781, NULL, NULL, NULL, NULL, 'Tanzania', 'MWIRU', 'BRIAN AARON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302231560, NULL, NULL, NULL, NULL, 'Tanzania', 'MWITA', 'DAVID BENJAMIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242491629, NULL, NULL, NULL, NULL, 'Tanzania', 'NDANZI', 'AGGREY S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302223104, NULL, NULL, NULL, NULL, 'Tanzania', 'NDYETABURA', 'PAUL P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220936, NULL, NULL, NULL, NULL, 'Tanzania', 'NGAILO', 'JOSEPH CHARLES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302230364, NULL, NULL, NULL, NULL, 'Tanzania', 'NGESSU', 'JIBRILE JAFARI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302222353, NULL, NULL, NULL, NULL, 'Tanzania', 'NIKOMBOLWE', 'NOBERTH B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221488, NULL, NULL, NULL, NULL, 'Tanzania', 'NTAMBALA', 'DANIEL ARONI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221710, NULL, NULL, NULL, NULL, 'Tanzania', 'NYANDINDI', 'OWEN EMMANUEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302226933, NULL, NULL, NULL, NULL, 'Tanzania', 'PAULO', 'BULABO LAZARO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2101401224625, NULL, NULL, NULL, NULL, 'Tanzania', 'PETER', 'CHARLES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302217411, NULL, NULL, NULL, NULL, 'Tanzania', 'RINGO', 'BRIAN ROWLAND', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302230695, NULL, NULL, NULL, NULL, 'Tanzania', 'RUDONYA', 'SAMSON HERMAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302121134, NULL, NULL, NULL, NULL, 'Tanzania', 'RUNIGANGWE', 'BIKOLIMANA DIAMOND', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242423630, NULL, NULL, NULL, NULL, 'Tanzania', 'SEHEMU', 'BASILISA KORNEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302118502, NULL, NULL, NULL, NULL, 'Tanzania', 'SEMBOSE', 'HERIETH D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302226701, NULL, NULL, NULL, NULL, 'Tanzania', 'SEMWANZA', 'MIRAJI TUMAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220910, NULL, NULL, NULL, NULL, 'Tanzania', 'SHESHA', 'JOSEPH ALOYCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302216413, NULL, NULL, NULL, NULL, 'Tanzania', 'SIMBA', 'NASRI MOHAMED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302220779, NULL, NULL, NULL, NULL, 'Tanzania', 'SIMBA', 'RADON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302221363, NULL, NULL, NULL, NULL, 'Tanzania', 'SULLE', 'ELIBARIKI BASSO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302116423, NULL, NULL, NULL, NULL, 'Tanzania', 'TARIMO', 'ANGELLA INVOCAVITY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242425213, NULL, NULL, NULL, NULL, 'Tanzania', 'ULOTU', 'HAROLD GODSON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218633, NULL, NULL, NULL, NULL, 'Tanzania', 'URASSA', 'FRANK JUDICATE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2102302218302, NULL, NULL, NULL, NULL, 'Tanzania', 'VENANCE', 'DAUDI JOSEPH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220242418242, NULL, NULL, NULL, NULL, 'Tanzania', 'YUSSUF', 'RAHMA M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'zablonnashon@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `course_id` (`course_id`,`dept_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`modCode`(16)),
  ADD KEY `dept_id` (`dept_id`,`sem_id`,`level_id`),
  ADD KEY `sess_id` (`sess_id`);

--
-- Indexes for table `nta_level`
--
ALTER TABLE `nta_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `regNo_index` (`regNo`),
  ADD KEY `level_id_index` (`level_id`,`sem_id`),
  ADD KEY `dept_id_index` (`dept_id`),
  ADD KEY `modCode_index` (`modCode`(191));

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sess_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`regNo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `c_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `res_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sess_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
