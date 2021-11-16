-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2016 at 10:28 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allenhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `answer_master`
--

CREATE TABLE IF NOT EXISTS `answer_master` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer` varchar(10) DEFAULT NULL,
  `answer_determine` datetime DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE IF NOT EXISTS `category_master` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`category_id`, `category_name`) VALUES
(1, 'b.tech'),
(2, 'b.b.a');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `couponId` bigint(20) NOT NULL AUTO_INCREMENT,
  `couponCode` varchar(16) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createDate` datetime NOT NULL,
  `redeemDate` datetime NOT NULL,
  `redeemUser` int(11) NOT NULL,
  PRIMARY KEY (`couponId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

CREATE TABLE IF NOT EXISTS `question_master` (
  `ques_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned DEFAULT NULL,
  `ques` text,
  `ans1` text,
  `ans2` text,
  `ans3` text,
  `ans4` text,
  `correct` varchar(5) DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `topic_id` int(10) unsigned DEFAULT NULL,
  `sub_topic_id` int(10) DEFAULT NULL,
  `level` varchar(1) DEFAULT NULL,
  `ques_image` varchar(100) DEFAULT NULL,
  `ans1_img` varchar(100) DEFAULT NULL,
  `ans2_img` varchar(100) DEFAULT NULL,
  `ans3_img` varchar(100) DEFAULT NULL,
  `ans4_img` varchar(100) DEFAULT NULL,
  `marks` int(10) unsigned DEFAULT NULL,
  `isVisible` char(1) DEFAULT NULL,
  `solution` text,
  `isTextbox` char(1) DEFAULT NULL,
  PRIMARY KEY (`ques_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(10) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `mail_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `course` varchar(10) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `semester` int(1) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `codestatus` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `roll_no` (`roll_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `roll_no`, `student_name`, `dob`, `mail_id`, `password`, `address`, `gender`, `mobile_number`, `course`, `branch`, `semester`, `parent_id`, `status`, `code`, `codestatus`) VALUES
(4, '1350510020', 'richa', '1996-07-08', 'tripathiricha304@gmail.com', '8604201960', 'vashanv nagar', 'female', '8604201960', 'b-tech', 'c.s', 3, -1, 1, '1', 0),
(10, '1350510022', 'sagarika anand', '1995-12-16', 'sagarikaanand006@gmail.com', '86042019600', 'gorakhpur', 'female', '8604201960', 'b-tech', 'c.s', 4, -1, 1, '1', 0),
(11, '1350510001', 'abhishek', '1995-07-19', 'heartvirus.abhishek@gmail.com', '8604201960', 'hai ki ni', 'Male', '8604201960', '1', 'c.s', 6, -1, 1, '6ES50fb2', 0),
(12, '1350510004', 'ashwini', '1995-07-07', 'ashwini0004@gmail.com', '8604201960', 'ni man h', 'Male', '8604201960', '1', 'c.s', 6, -1, 1, 'fgbD78pF', 0),
(13, '1350510002', 'aditi', '1997-07-06', 'aditikush121@gmail.com', '8604201960', 'chaaki', 'Female', '8090361038', '1', 'c.s', 6, -1, 1, 'OXHZLcfH', 0),
(16, '1350510015', 'pawan kumar gautam', '1997-03-19', 'pawangtm2419@gmail.com', '8604201960', 'raja market', 'Male', '9450026055', '1', 'c.s', 6, -1, 1, 'JTF17c3U', 0);

-- --------------------------------------------------------

--
-- Table structure for table `state_district_list`
--

CREATE TABLE IF NOT EXISTS `state_district_list` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(30) DEFAULT NULL,
  `district_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE IF NOT EXISTS `subject_master` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`subject_id`, `subject_name`) VALUES
(6, 'data structures'),
(8, 'c-programming'),
(9, 'software engineering'),
(11, 'daa'),
(13, 'graphics'),
(18, 'science'),
(20, 'webtech'),
(25, 'data mining');

-- --------------------------------------------------------

--
-- Table structure for table `sub_topic_master`
--

CREATE TABLE IF NOT EXISTS `sub_topic_master` (
  `sub_topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `sub_topic_name` varchar(70) NOT NULL,
  PRIMARY KEY (`sub_topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_master`
--

CREATE TABLE IF NOT EXISTS `test_master` (
  `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(100) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `cutoff_marks` int(4) unsigned NOT NULL,
  `negative_marks` int(2) NOT NULL,
  `test_duration` int(5) NOT NULL,
  `instructions` varchar(200) NOT NULL,
  `isVisible` char(1) DEFAULT NULL,
  `isEvent` varchar(3) DEFAULT NULL,
  `event_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_subject_relation_master`
--

CREATE TABLE IF NOT EXISTS `test_subject_relation_master` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `cutoff_marks` int(4) DEFAULT NULL,
  `negative_marks` int(4) DEFAULT NULL,
  `average_marks` int(4) DEFAULT NULL,
  `below_average_marks` int(4) DEFAULT NULL,
  `above_average_marks` int(4) DEFAULT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `topic_master`
--

CREATE TABLE IF NOT EXISTS `topic_master` (
  `topic_id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) DEFAULT NULL,
  `topic_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_name`, `user_password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
