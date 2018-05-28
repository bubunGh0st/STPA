-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 12:27 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stp`
--
CREATE DATABASE IF NOT EXISTS `db_stp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_stp`;

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `LogID` int(11) NOT NULL,
  `RefID` varchar(50) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `EntryTime` datetime NOT NULL,
  `EntryEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_session`
--

CREATE TABLE `log_session` (
  `SessionID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `EntryTime` datetime NOT NULL,
  `SessionType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_achievement`
--

CREATE TABLE `ms_achievement` (
  `AchievementID` varchar(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Threshold` decimal(20,4) NOT NULL,
  `Experience` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_achievement`
--

INSERT INTO `ms_achievement` (`AchievementID`, `Title`, `Description`, `Action`, `Threshold`, `Experience`) VALUES
('AC0001', 'Sign Up', 'Sign Up for the first time.', 'SIGN_UP', '1.0000', '1250.0000'),
('AC0002', 'Sign In 5 Times', 'Sign In 5 Times', 'SIGN_IN', '5.0000', '2000.0000'),
('AC0003', 'Finish a Task', 'Finish 1 Task', 'TASK', '1.0000', '1000.0000');

-- --------------------------------------------------------

--
-- Table structure for table `ms_course`
--

CREATE TABLE `ms_course` (
  `CourseID` varchar(50) NOT NULL,
  `CourseCode` varchar(50) NOT NULL,
  `CourseName` varchar(50) NOT NULL,
  `SiteID` varchar(50) NOT NULL,
  `CourseCredit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_module`
--

CREATE TABLE `ms_module` (
  `ModuleID` varchar(50) NOT NULL,
  `ModuleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_module`
--

INSERT INTO `ms_module` (`ModuleID`, `ModuleName`) VALUES
('M0001', 'Profile'),
('M0002', 'Modules'),
('M0003', 'Roles'),
('M0004', 'Users'),
('M0005', 'Site Admin Approval'),
('M0006', 'Courses'),
('M0007', 'Staffs'),
('M0008', 'Staff Dashboard'),
('M0009', 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `ms_role`
--

CREATE TABLE `ms_role` (
  `RoleID` varchar(50) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_role`
--

INSERT INTO `ms_role` (`RoleID`, `RoleName`) VALUES
('SITE-ADMIN', 'Site Administrator'),
('STAFF', 'Staff'),
('SYS-ADMIN', 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `ms_role_module`
--

CREATE TABLE `ms_role_module` (
  `RoleID` varchar(50) NOT NULL,
  `ModuleID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_role_module`
--

INSERT INTO `ms_role_module` (`RoleID`, `ModuleID`) VALUES
('SITE-ADMIN', 'M0001'),
('SITE-ADMIN', 'M0006'),
('SITE-ADMIN', 'M0007'),
('STAFF', 'M0001'),
('STAFF', 'M0008'),
('SYS-ADMIN', 'M0001'),
('SYS-ADMIN', 'M0002'),
('SYS-ADMIN', 'M0003'),
('SYS-ADMIN', 'M0004'),
('SYS-ADMIN', 'M0005'),
('SYS-ADMIN', 'M0009');

-- --------------------------------------------------------

--
-- Table structure for table `ms_site`
--

CREATE TABLE `ms_site` (
  `SiteID` int(50) NOT NULL,
  `SiteName` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_student`
--

CREATE TABLE `ms_student` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Tutorial` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_student_achievement`
--

CREATE TABLE `ms_student_achievement` (
  `AchievementID` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_student_course`
--

CREATE TABLE `ms_student_course` (
  `Email` varchar(50) NOT NULL,
  `TrimesterID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `RoleID` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `SiteSuggestion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_user_site`
--

CREATE TABLE `ms_user_site` (
  `Email` varchar(50) NOT NULL,
  `SiteID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_assignment_student`
--

CREATE TABLE `tr_assignment_student` (
  `AssignmentID` int(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL,
  `ProgressHours` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_course_trimester`
--

CREATE TABLE `tr_course_trimester` (
  `TrimesterID` int(50) NOT NULL,
  `CourseID` varchar(50) NOT NULL,
  `TrimesterName` varchar(50) NOT NULL,
  `StartDate` datetime NOT NULL,
  `FinishDate` datetime NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL,
  `CompletionWeeks` decimal(20,4) NOT NULL,
  `ReadingHours` decimal(20,4) NOT NULL,
  `RevisionHours` decimal(20,4) NOT NULL,
  `ContactHours` decimal(20,4) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_course_trimester_assignment`
--

CREATE TABLE `tr_course_trimester_assignment` (
  `AssignmentID` int(11) NOT NULL,
  `TrimesterID` varchar(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `FinishTime` datetime NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_course_trimester_staff`
--

CREATE TABLE `tr_course_trimester_staff` (
  `TrimesterID` varchar(50) NOT NULL,
  `StaffEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_reading`
--

CREATE TABLE `tr_reading` (
  `ReadingID` int(11) NOT NULL,
  `FinishTime` datetime NOT NULL,
  `TrimesterID` varchar(50) NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL,
  `ProgressHours` decimal(20,4) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_revision`
--

CREATE TABLE `tr_revision` (
  `RevisionID` int(50) NOT NULL,
  `FinishTime` datetime NOT NULL,
  `TrimesterID` varchar(50) NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL,
  `ProgressHours` decimal(20,4) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_task`
--

CREATE TABLE `tr_task` (
  `TaskID` int(11) NOT NULL,
  `TaskName` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `FinishTime` datetime NOT NULL,
  `CompletionHours` decimal(20,4) NOT NULL,
  `ProgressHours` decimal(20,4) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`LogID`);

--
-- Indexes for table `log_session`
--
ALTER TABLE `log_session`
  ADD PRIMARY KEY (`SessionID`);

--
-- Indexes for table `ms_achievement`
--
ALTER TABLE `ms_achievement`
  ADD PRIMARY KEY (`AchievementID`);

--
-- Indexes for table `ms_course`
--
ALTER TABLE `ms_course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `ms_module`
--
ALTER TABLE `ms_module`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Indexes for table `ms_role`
--
ALTER TABLE `ms_role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `ms_role_module`
--
ALTER TABLE `ms_role_module`
  ADD PRIMARY KEY (`RoleID`,`ModuleID`);

--
-- Indexes for table `ms_site`
--
ALTER TABLE `ms_site`
  ADD PRIMARY KEY (`SiteID`);

--
-- Indexes for table `ms_student`
--
ALTER TABLE `ms_student`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `ms_student_achievement`
--
ALTER TABLE `ms_student_achievement`
  ADD PRIMARY KEY (`AchievementID`,`Email`);

--
-- Indexes for table `ms_student_course`
--
ALTER TABLE `ms_student_course`
  ADD PRIMARY KEY (`Email`,`TrimesterID`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `ms_user_site`
--
ALTER TABLE `ms_user_site`
  ADD PRIMARY KEY (`Email`,`SiteID`);

--
-- Indexes for table `tr_assignment_student`
--
ALTER TABLE `tr_assignment_student`
  ADD PRIMARY KEY (`AssignmentID`,`Email`);

--
-- Indexes for table `tr_course_trimester`
--
ALTER TABLE `tr_course_trimester`
  ADD PRIMARY KEY (`TrimesterID`);

--
-- Indexes for table `tr_course_trimester_assignment`
--
ALTER TABLE `tr_course_trimester_assignment`
  ADD PRIMARY KEY (`AssignmentID`);

--
-- Indexes for table `tr_course_trimester_staff`
--
ALTER TABLE `tr_course_trimester_staff`
  ADD PRIMARY KEY (`TrimesterID`,`StaffEmail`);

--
-- Indexes for table `tr_reading`
--
ALTER TABLE `tr_reading`
  ADD PRIMARY KEY (`ReadingID`);

--
-- Indexes for table `tr_revision`
--
ALTER TABLE `tr_revision`
  ADD PRIMARY KEY (`RevisionID`);

--
-- Indexes for table `tr_task`
--
ALTER TABLE `tr_task`
  ADD PRIMARY KEY (`TaskID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_session`
--
ALTER TABLE `log_session`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_site`
--
ALTER TABLE `ms_site`
  MODIFY `SiteID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_course_trimester`
--
ALTER TABLE `tr_course_trimester`
  MODIFY `TrimesterID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_course_trimester_assignment`
--
ALTER TABLE `tr_course_trimester_assignment`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_reading`
--
ALTER TABLE `tr_reading`
  MODIFY `ReadingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_revision`
--
ALTER TABLE `tr_revision`
  MODIFY `RevisionID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_task`
--
ALTER TABLE `tr_task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
