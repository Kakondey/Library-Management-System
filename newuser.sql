-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 07:34 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindb`
--

CREATE TABLE IF NOT EXISTS `admindb` (
  `username` varchar(30) NOT NULL,
  `adminid` varchar(30) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `Cpwd` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admindb`
--

INSERT INTO `admindb` (`username`, `adminid`, `pwd`, `Cpwd`) VALUES
('kakon', 'kd', '12345678', '12345678'),
('Admin2', 'Admin2', '12345678', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE IF NOT EXISTS `borrower` (
  `uid` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `booknm` varchar(200) NOT NULL,
  `bauthor` varchar(100) NOT NULL,
  `category` text NOT NULL,
  `bcode` varchar(100) NOT NULL,
  `bprice` int(255) NOT NULL,
  `bpublisher` varchar(200) NOT NULL,
  `racknum` int(100) NOT NULL,
  `borrowstatus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`uid`, `firstname`, `lastname`, `borrowdate`, `returndate`, `booknm`, `bauthor`, `category`, `bcode`, `bprice`, `bpublisher`, `racknum`, `borrowstatus`) VALUES
('CSE-34/13', 'dorjoy', 'dey', '2017-04-25', '2017-05-02', 'datafilestructure', 'mcrolles', 'Course', 'cs301', 400, 'schand', 2, 'pending'),
('CSE-34/13', 'dorjoy', 'dey', '2017-04-25', '2017-05-02', 'data communication', 'Behromz A. Torozen', 'Course', 'cs402', 300, 'mcrew hills', 9, 'pending'),
('CSE-34/13', 'dorjoy', 'dey', '2017-04-25', '2017-05-02', 'hawas', 'malay', 'Story', 'HW-301/23', 1200, 'malay hazarika', 9, 'pending'),
('kunal', 'kunal', 'dey', '2017-04-25', '2017-05-02', 'datafilestructure', 'mcrolles', 'Course', 'cs301', 400, 'schand', 2, 'pending'),
('kunal', 'kunal', 'dey', '2017-04-25', '2017-05-02', 'data communication', 'Behromz A. Torozen', 'Course', 'cs402', 300, 'mcrew hills', 9, 'pending'),
('kunal', 'kunal', 'dey', '2017-04-25', '2017-05-02', 'hawas', 'malay', 'Story', 'HW-301/23', 1200, 'malay hazarika', 9, 'returned'),
('being_shayan', 'shayan', 'chakraborty', '2017-04-25', '2017-05-02', 'data communication', 'Behromz A. Torozen', 'Course', 'cs402', 300, 'mcrew hills', 9, 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `newbook`
--

CREATE TABLE IF NOT EXISTS `newbook` (
  `booknm` varchar(400) NOT NULL,
  `bauthor` text NOT NULL,
  `category` text NOT NULL,
  `bcode` varchar(100) NOT NULL,
  `bprice` int(20) NOT NULL,
  `bpublisher` text NOT NULL,
  `totbooks` int(255) NOT NULL,
  `racknum` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newbook`
--

INSERT INTO `newbook` (`booknm`, `bauthor`, `category`, `bcode`, `bprice`, `bpublisher`, `totbooks`, `racknum`) VALUES
('datafilestructure', 'mcrolles', 'Course', 'cs301', 400, 'schand', 3, '2'),
('data communication', 'Behromz A. Torozen', 'Course', 'cs402', 300, 'mcrew hills', 10, '9'),
('hawas', 'malay', 'Story', 'HW-301/23', 1200, 'malay hazarika', 5, '9');

-- --------------------------------------------------------

--
-- Table structure for table `newuserdata`
--

CREATE TABLE IF NOT EXISTS `newuserdata` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `uid` varchar(20) NOT NULL,
  `rollno` int(10) NOT NULL,
  `age` int(2) NOT NULL,
  `class` int(2) NOT NULL,
  `section` char(1) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `Cpwd` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newuserdata`
--

INSERT INTO `newuserdata` (`firstname`, `lastname`, `uid`, `rollno`, `age`, `class`, `section`, `pwd`, `Cpwd`) VALUES
('dorjoy', 'dey', 'CSE-34/13', 34, 20, 12, 'S', '6eea9b7ef19179a06954edd0f6c05ceb', 'qwertyuiop'),
('kuna;', 'dey', 'kun', 23, 12, 23, 'q', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty'),
('kunal', 'dey', 'kunal', 23, 12, 23, 'a', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty'),
('bhaskar', 'dutta', 'BD-32/24', 119, 23, 12, 'A', '6eea9b7ef19179a06954edd0f6c05ceb', 'qwertyuiop'),
('shayan', 'chakraborty', 'being_shayan', 15316, 20, 4, 'b', '57e7f266bb0dc62f2cb0f25976c14e93', 'goodboy'),
('a', 'b', 'avb', 1, 40, 5, 'a', '57ba172a6be125cca2f449826f9980ca', '123qweasd'),
('mango', 'pulp', 'mango', 23, 12, 4, 'A', 'b55e1c1c9d17a10bc70753f58efca8c1', 'QAZWSX');

-- --------------------------------------------------------

--
-- Table structure for table `reissue_finelist`
--

CREATE TABLE IF NOT EXISTS `reissue_finelist` (
  `uid` varchar(200) NOT NULL,
  `bcode` varchar(200) NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `borrowstatus` text NOT NULL,
  `reissueStatus` text NOT NULL,
  `reissuedate` date NOT NULL,
  `fine` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reissue_finelist`
--

INSERT INTO `reissue_finelist` (`uid`, `bcode`, `borrowdate`, `returndate`, `borrowstatus`, `reissueStatus`, `reissuedate`, `fine`) VALUES
('CSE-34/13', 'cs1234', '2017-04-25', '2017-05-02', 'pending', 'reissued(DONE)', '2017-04-25', 1),
('CSE-34/13', 'cs301', '2017-04-25', '2017-05-02', 'pending', 'not reissued', '0000-00-00', 1),
('CSE-34/13', 'cs402', '2017-04-25', '2017-05-02', 'pending', 'not reissued', '0000-00-00', 0),
('CSE-34/13', 'HW-301/23', '2017-04-25', '2017-05-02', 'pending', 'not reissued', '0000-00-00', 0),
('kunal', 'cs1234', '2017-04-25', '2017-05-02', 'pending', 'reissued(DONE)', '2017-04-25', 1),
('kunal', 'cs301', '2017-04-25', '2017-05-02', 'pending', 'not reissued', '0000-00-00', 1),
('kunal', 'cs402', '2017-04-25', '2017-05-02', 'pending', 'not reissued', '0000-00-00', 0),
('kunal', 'HW-301/23', '2017-04-25', '2017-05-02', 'returned', 'not reissued', '0000-00-00', 0),
('being_shayan', 'cs1234', '2017-04-25', '2017-05-02', 'pending', 'reissued(DONE)', '2017-04-25', 1),
('being_shayan', 'cs402', '2017-04-25', '2017-05-02', 'returned', 'not reissued', '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newbook`
--
ALTER TABLE `newbook`
  ADD PRIMARY KEY (`bcode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
