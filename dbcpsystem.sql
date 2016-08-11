-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2016 at 10:59 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbcpsystem`
--
CREATE DATABASE IF NOT EXISTS `dbcpsystem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbcpsystem`;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranches`
--

DROP TABLE IF EXISTS `tblbranches`;
CREATE TABLE IF NOT EXISTS `tblbranches` (
  `strBranchCode` char(8) NOT NULL,
  `strBranchName` varchar(45) NOT NULL,
  `strBranchAddress` varchar(200) NOT NULL,
  `strBranchContNum` varchar(45) DEFAULT NULL,
  `strBranchFaxNum` varchar(45) DEFAULT NULL,
  `dtmLastUpdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strBranchCode`),
  UNIQUE KEY `strBranchCode_UNIQUE` (`strBranchCode`),
  UNIQUE KEY `strBranchName_UNIQUE` (`strBranchName`),
  UNIQUE KEY `strBranchAddress_UNIQUE` (`strBranchAddress`),
  UNIQUE KEY `strBranctContNum_UNIQUE` (`strBranchContNum`),
  UNIQUE KEY `strBranchFaxNum_UNIQUE` (`strBranchFaxNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbranches`
--

INSERT INTO `tblbranches` (`strBranchCode`, `strBranchName`, `strBranchAddress`, `strBranchContNum`, `strBranchFaxNum`, `dtmLastUpdate`, `intStatus`) VALUES
('BRA00001', 'Pureza Branch', 'Pureza St., Sta. Mesa, Manila City', '1234567', '1231231312313', '2016-03-01 08:56:08', 1),
('BRA00002', 'Joke lhunqs', 'Hehe lordexxx', '', '', '2016-03-01 08:59:58', 0),
('BRA00003', 'Teresa Branch', 'QC', '120-4462', '4636-8474', '2016-03-16 14:34:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldiscounts`
--

DROP TABLE IF EXISTS `tbldiscounts`;
CREATE TABLE IF NOT EXISTS `tbldiscounts` (
  `strDiscCode` char(8) NOT NULL,
  `strDiscName` varchar(45) NOT NULL,
  `dblDiscPerc` double NOT NULL DEFAULT '0',
  `decDiscAmt` decimal(10,0) NOT NULL DEFAULT '0',
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  `strDiscDesc` text,
  PRIMARY KEY (`strDiscCode`),
  UNIQUE KEY `strDiscCode_UNIQUE` (`strDiscCode`),
  UNIQUE KEY `strDiscName_UNIQUE` (`strDiscName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldiscounts`
--

INSERT INTO `tbldiscounts` (`strDiscCode`, `strDiscName`, `dblDiscPerc`, `decDiscAmt`, `dtmLastUpdate`, `intStatus`, `strDiscDesc`) VALUES
('DSC00001', 'Senior Citizen''s', 0.12, '0', '2016-03-12 10:48:01', 1, NULL),
('DSC00002', 'Loyal Members', 0.4, '0', '2016-03-12 15:35:35', 1, 'for loyalists'),
('DSC00003', 'Card Holders Disc', 0.2, '0', '2016-03-12 15:37:42', 0, NULL),
('DSC00004', 'Officials Discount', 0.3, '0', '2016-03-12 15:38:04', 1, NULL),
('DSC00005', 'Discount Kay Mare', 0, '100', '2016-07-21 12:57:33', 1, ''),
('DSC00006', 's', 0, '0', '2016-07-21 14:51:08', 0, ''),
('DSC00007', 'Bes', 0, '150', '2016-07-21 23:53:53', 1, 'best part 2'),
('DSC00008', 'PWD', 0, '50', '2016-07-26 15:00:55', 1, 'Person with Disability');

-- --------------------------------------------------------

--
-- Table structure for table `tblegc`
--

DROP TABLE IF EXISTS `tblegc`;
CREATE TABLE IF NOT EXISTS `tblegc` (
  `strEGCCode` char(8) CHARACTER SET utf8 NOT NULL,
  `intEGCType` int(1) NOT NULL,
  `intCustType` int(1) NOT NULL,
  `decAmount` decimal(10,0) DEFAULT '0',
  `strEGCPinCode` char(4) CHARACTER SET utf8 NOT NULL,
  `strEGCBeneficiary` varchar(100) CHARACTER SET utf8 NOT NULL,
  `strEGCContNum` char(10) CHARACTER SET utf8 NOT NULL,
  `dtmDateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`strEGCCode`),
  UNIQUE KEY `strEGCCode_UNIQUE` (`strEGCCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblegc`
--

INSERT INTO `tblegc` (`strEGCCode`, `intEGCType`, `intCustType`, `decAmount`, `strEGCPinCode`, `strEGCBeneficiary`, `strEGCContNum`, `dtmDateAdded`) VALUES
('EGC00001', 0, 1, '1000', '5194', 'Koch Lols', '9755128084', '2016-07-22 21:49:12'),
('EGC00002', 0, 1, '2000', '3929', 'Koch Lols', '9069225963', '2016-07-22 21:52:15'),
('EGC00003', 1, 1, '0', '3035', 'Koch Lols', '9755128084', '2016-07-22 23:16:09'),
('EGC00004', 1, 1, '0', '4226', 'Koch Lols', '9755128084', '2016-07-22 23:40:23'),
('EGC00005', 1, 1, '0', '0978', 'Koch Lols', '9755128084', '2016-07-22 23:42:36'),
('EGC00006', 1, 1, '0', '1620', 'Koch Lols', '9755128084', '2016-07-22 23:43:43'),
('EGC00007', 1, 1, '0', '7274', 'Koch Lols', '9755128084', '2016-07-22 23:49:27'),
('EGC00008', 0, 1, '400', '1348', 'Matata', '9755128084', '2016-07-23 00:01:11'),
('EGC00009', 1, 1, '0', '1143', 'Matata', '9755128084', '2016-07-23 00:36:46'),
('EGC00010', 1, 1, '0', '2872', 'Koch Lols', '9755128084', '2016-07-23 00:38:28'),
('EGC00011', 0, 1, '1000', '3416', 'Mother Austria', '9211978000', '2016-07-26 15:24:58'),
('EGC00012', 0, 1, '2000', '2497', 'Tetsi', '9755128084', '2016-07-27 14:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblegccust`
--

DROP TABLE IF EXISTS `tblegccust`;
CREATE TABLE IF NOT EXISTS `tblegccust` (
  `strEGCCCode` char(8) NOT NULL,
  `strEGCMemCode` char(8) DEFAULT NULL,
  `strEGCCustName` varchar(100) NOT NULL,
  `strEGCContNum` char(10) NOT NULL,
  PRIMARY KEY (`strEGCCCode`),
  KEY `strEGCMemCode` (`strEGCMemCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblegccust`
--

INSERT INTO `tblegccust` (`strEGCCCode`, `strEGCMemCode`, `strEGCCustName`, `strEGCContNum`) VALUES
('EGC00001', NULL, 'Luis Guballo', '9069225963'),
('EGC00002', NULL, 'MysteryGuitarMan', '9755128084'),
('EGC00003', NULL, 'Luis Guballo', '9069225963'),
('EGC00004', NULL, 'Hankuna', '9069225963'),
('EGC00005', NULL, 'Hankuna', '9069225963'),
('EGC00006', NULL, 'Hankuna', '9069225963'),
('EGC00007', NULL, 'Hankuna', '9069225963'),
('EGC00008', NULL, 'KoerekekBes!', '9069225963'),
('EGC00009', NULL, 'KoerekekBes!', '9069225963'),
('EGC00010', NULL, 'Hankuna', '9069225963'),
('EGC00011', NULL, 'Ely Austria', '9171122233'),
('EGC00012', NULL, 'Kepsie', '9755128084');

-- --------------------------------------------------------

--
-- Table structure for table `tblegcprods`
--

DROP TABLE IF EXISTS `tblegcprods`;
CREATE TABLE IF NOT EXISTS `tblegcprods` (
  `strEPEGCCode` char(8) NOT NULL,
  `strEPProdCode` char(8) NOT NULL,
  `intQty` int(11) NOT NULL,
  PRIMARY KEY (`strEPEGCCode`,`strEPProdCode`),
  KEY `EP_ProdCode` (`strEPProdCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblegcprods`
--

INSERT INTO `tblegcprods` (`strEPEGCCode`, `strEPProdCode`, `intQty`) VALUES
('EGC00003', 'PRD00031', 2),
('EGC00003', 'PRD00032', 4),
('EGC00003', 'PRD00043', 3),
('EGC00004', 'PRD00031', 5),
('EGC00004', 'PRD00034', 4),
('EGC00005', 'PRD00031', 4),
('EGC00006', 'PRD00031', 5),
('EGC00006', 'PRD00032', 2),
('EGC00007', 'PRD00032', 5),
('EGC00007', 'PRD00043', 4),
('EGC00009', 'PRD00030', 5),
('EGC00009', 'PRD00031', 5),
('EGC00009', 'PRD00032', 10),
('EGC00010', 'PRD00034', 6),
('EGC00010', 'PRD00035', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblempbranch`
--

DROP TABLE IF EXISTS `tblempbranch`;
CREATE TABLE IF NOT EXISTS `tblempbranch` (
  `strEBEmpCode` char(8) NOT NULL,
  `strEBBranchCode` char(8) NOT NULL,
  `dtmDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`strEBEmpCode`),
  UNIQUE KEY `strEBEmpCode_UNIQUE` (`strEBEmpCode`),
  KEY `Branch_Code_idx` (`strEBBranchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblempbranch`
--

INSERT INTO `tblempbranch` (`strEBEmpCode`, `strEBBranchCode`, `dtmDate`) VALUES
('EMP00001', 'BRA00001', '2016-03-01 10:25:54'),
('EMP00002', 'BRA00001', '2016-03-01 10:26:38'),
('EMP00003', 'BRA00001', '2016-03-05 10:12:42'),
('EMP00004', 'BRA00003', '2016-03-16 14:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblempjobdesc`
--

DROP TABLE IF EXISTS `tblempjobdesc`;
CREATE TABLE IF NOT EXISTS `tblempjobdesc` (
  `strEJCode` char(8) NOT NULL,
  `strEJName` varchar(45) NOT NULL,
  `strEJDescription` text,
  `intUserLevel` tinyint(4) NOT NULL,
  `dtmLastUpdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strEJCode`),
  UNIQUE KEY `strEJDescCode_UNIQUE` (`strEJCode`),
  UNIQUE KEY `strEJDName_UNIQUE` (`strEJName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblempjobdesc`
--

INSERT INTO `tblempjobdesc` (`strEJCode`, `strEJName`, `strEJDescription`, `intUserLevel`, `dtmLastUpdate`, `intStatus`) VALUES
('JOB00001', 'Branch Manager', 'Taga-tingin ng gamot', 1, '2016-03-01 09:38:10', 1),
('JOB00002', 'Pharmacist', 'Taga-bigay ng gamot', 3, '2016-03-12 13:47:57', 1),
('JOB00003', 'Assistant Pharmacist', 'Taga-abot ng gamotxxx', 3, '2016-03-01 09:38:14', 0),
('JOB00004', 'Janitor', 'taga linis', 3, '2016-03-05 10:11:17', 1),
('JOB00005', 'Sales Clerk', 'Taga benta', 3, '2016-03-16 14:35:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

DROP TABLE IF EXISTS `tblemployee`;
CREATE TABLE IF NOT EXISTS `tblemployee` (
  `strEmpCode` char(8) NOT NULL,
  `strEmpFName` varchar(100) NOT NULL,
  `strEmpMName` varchar(100) DEFAULT NULL,
  `strEmpLName` varchar(100) NOT NULL,
  `strEmpAddress` varchar(200) NOT NULL,
  `strEmpContNum` varchar(45) NOT NULL,
  `strEmpJobCode` char(8) NOT NULL,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strEmpCode`),
  UNIQUE KEY `strEmpCode_UNIQUE` (`strEmpCode`),
  UNIQUE KEY `strAddress_UNIQUE` (`strEmpAddress`),
  UNIQUE KEY `strEmpContNum_UNIQUE` (`strEmpContNum`),
  KEY `strEmpJobCode` (`strEmpJobCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`strEmpCode`, `strEmpFName`, `strEmpMName`, `strEmpLName`, `strEmpAddress`, `strEmpContNum`, `strEmpJobCode`, `dtmLastUpdate`, `intStatus`) VALUES
('EMP00001', 'Luis', 'Logrosa', 'Guballo', 'Valenzuela Hehe City', '9755128084', 'JOB00001', '2016-03-01 10:29:07', 1),
('EMP00002', 'Erik Jon', 'hehe', 'Del Castillo', 'Marikina City', '9123123123', 'JOB00002', '2016-03-01 10:29:11', 0),
('EMP00003', 'as', 'h', 'dgd', '789 sadfjhk', '9465657654', 'JOB00001', '2016-03-05 10:12:42', 1),
('EMP00004', '1', '', '3', '', '9054298513', 'JOB00005', '2016-03-16 14:37:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblformpack`
--

DROP TABLE IF EXISTS `tblformpack`;
CREATE TABLE IF NOT EXISTS `tblformpack` (
  `strFPFormCode` char(8) NOT NULL,
  `strFPPackCode` char(8) NOT NULL,
  PRIMARY KEY (`strFPFormCode`,`strFPPackCode`),
  KEY `FP_PackCode_idx` (`strFPPackCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblgensize`
--

DROP TABLE IF EXISTS `tblgensize`;
CREATE TABLE IF NOT EXISTS `tblgensize` (
  `strGenSizeCode` char(8) NOT NULL,
  `strGenSizeName` varchar(45) NOT NULL,
  `intGenSizeValue` int(11) NOT NULL,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strGenSizeCode`),
  UNIQUE KEY `strGenSizeCode_UNIQUE` (`strGenSizeCode`),
  UNIQUE KEY `strGenSizeName_UNIQUE` (`strGenSizeName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgensize`
--

INSERT INTO `tblgensize` (`strGenSizeCode`, `strGenSizeName`, `intGenSizeValue`, `intStatus`) VALUES
('GSZ00001', 'S', 0, 1),
('GSZ00002', 'REG', 1, 1),
('GSZ00003', 'L', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedgennames`
--

DROP TABLE IF EXISTS `tblmedgennames`;
CREATE TABLE IF NOT EXISTS `tblmedgennames` (
  `strMedGenMedCode` char(8) NOT NULL,
  `strMedGenGenCode` char(8) NOT NULL,
  PRIMARY KEY (`strMedGenMedCode`,`strMedGenGenCode`),
  KEY `MedGen_GenCode` (`strMedGenGenCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmedgennames`
--

INSERT INTO `tblmedgennames` (`strMedGenMedCode`, `strMedGenGenCode`) VALUES
('PRD00031', 'MGN00001'),
('PRD00034', 'MGN00001'),
('PRD00043', 'MGN00001'),
('PRD00012', 'MGN00003'),
('PRD00033', 'MGN00003'),
('PRD00012', 'MGN00004'),
('PRD00013', 'MGN00004'),
('PRD00031', 'MGN00004'),
('PRD00033', 'MGN00004'),
('PRD00033', 'MGN00007'),
('PRD00042', 'MGN00007'),
('PRD00013', 'MGN00009'),
('PRD00030', 'MGN00009'),
('PRD00031', 'MGN00009'),
('PRD00032', 'MGN00009'),
('PRD00043', 'MGN00009'),
('PRD00047', 'MGN00009'),
('PRD00032', 'MGN00010'),
('PRD00042', 'MGN00010'),
('PRD00043', 'MGN00010'),
('PRD00032', 'MGN00011'),
('PRD00044', 'MGN00012'),
('PRD00048', 'MGN00012');

-- --------------------------------------------------------

--
-- Table structure for table `tblmemaccount`
--

DROP TABLE IF EXISTS `tblmemaccount`;
CREATE TABLE IF NOT EXISTS `tblmemaccount` (
  `strMemAcctCode` char(8) NOT NULL,
  `strMemAcctPinCode` char(4) NOT NULL,
  PRIMARY KEY (`strMemAcctCode`),
  UNIQUE KEY `strMemAcctCode_UNIQUE` (`strMemAcctCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmemaccount`
--

INSERT INTO `tblmemaccount` (`strMemAcctCode`, `strMemAcctPinCode`) VALUES
('MEM00001', '1234'),
('MEM00002', '4321'),
('MEM00003', '0531'),
('MEM00004', '8888');

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

DROP TABLE IF EXISTS `tblmember`;
CREATE TABLE IF NOT EXISTS `tblmember` (
  `strMemCode` char(8) NOT NULL,
  `strMemFName` varchar(100) NOT NULL,
  `strMemMName` varchar(100) DEFAULT NULL,
  `strMemLName` varchar(100) NOT NULL,
  `datMemBirthday` date NOT NULL,
  `strMemOSCAID` varchar(45) DEFAULT NULL,
  `strMemAddress` varchar(200) DEFAULT NULL,
  `strMemHomeNum` varchar(45) DEFAULT NULL,
  `strMemContNum` varchar(45) DEFAULT NULL,
  `strMemEmail` varchar(45) DEFAULT NULL,
  `imgMemPhoto` varchar(100) NOT NULL,
  `dtmLastUpdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strMemCode`),
  UNIQUE KEY `strMemCode_UNIQUE` (`strMemCode`),
  UNIQUE KEY `strMemIdentifier` (`strMemFName`,`strMemMName`,`strMemLName`,`datMemBirthday`,`strMemAddress`,`strMemEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`strMemCode`, `strMemFName`, `strMemMName`, `strMemLName`, `datMemBirthday`, `strMemOSCAID`, `strMemAddress`, `strMemHomeNum`, `strMemContNum`, `strMemEmail`, `imgMemPhoto`, `dtmLastUpdate`, `intStatus`) VALUES
('MEM00001', 'Angel', '', 'O''hara', '1991-02-17', NULL, 'Valenzuela City', '7311219', '', '', 'storage/member_photos/MEM00001.jpg', '2016-07-21 05:12:41', 1),
('MEM00002', 'Luis', '', 'Guballo', '1990-12-02', NULL, 'Somewhere, Caloocan City', '', '', '', 'storage/member_photos/MEM00002.jpg', '2016-07-22 15:46:39', 1),
('MEM00003', 'Michael', '', 'Go', '1997-05-22', NULL, 'Karuhatan, Valenzuela City', '', '', 'gomichael@gmail.com', 'storage/member_photos/MEM00003.jpg', '2016-07-23 03:04:41', 1),
('MEM00004', 'Jay-jay', '', 'Imorta', '1990-06-15', NULL, 'Q.C.', '1234567', '', '', 'storage/member_photos/MEM00004.jpg', '2016-07-26 15:03:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmemcard`
--

DROP TABLE IF EXISTS `tblmemcard`;
CREATE TABLE IF NOT EXISTS `tblmemcard` (
  `strMCardCode` char(8) NOT NULL,
  `strMCardID` char(5) NOT NULL,
  `intIsActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strMCardCode`,`strMCardID`),
  UNIQUE KEY `strMCardID_UNIQUE` (`strMCardID`),
  UNIQUE KEY `strMCard_Identifier` (`strMCardID`,`strMCardCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmemcredit`
--

DROP TABLE IF EXISTS `tblmemcredit`;
CREATE TABLE IF NOT EXISTS `tblmemcredit` (
  `strMCreditCode` char(8) NOT NULL,
  `decMCreditValue` decimal(10,2) NOT NULL,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`strMCreditCode`),
  UNIQUE KEY `strMCreditCode_UNIQUE` (`strMCreditCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmemcredit`
--

INSERT INTO `tblmemcredit` (`strMCreditCode`, `decMCreditValue`, `dtmLastUpdate`) VALUES
('MEM00001', '1000.00', '0000-00-00 00:00:00'),
('MEM00002', '1000.00', '2016-05-18 05:44:05'),
('MEM00003', '1035.00', '2016-07-23 10:58:54'),
('MEM00004', '1491.00', '2016-07-26 15:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblmempoints`
--

DROP TABLE IF EXISTS `tblmempoints`;
CREATE TABLE IF NOT EXISTS `tblmempoints` (
  `strPointTransCode` char(8) NOT NULL,
  `strPointMemCode` char(8) NOT NULL,
  `decPointValue` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strPointTransCode`,`strPointMemCode`),
  UNIQUE KEY `strMPointCode_UNIQUE` (`strPointTransCode`),
  KEY `Point_MemCode` (`strPointMemCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmempoints`
--

INSERT INTO `tblmempoints` (`strPointTransCode`, `strPointMemCode`, `decPointValue`) VALUES
('TRN00005', 'MEM00003', '4.48'),
('TRN00008', 'MEM00003', '5.60'),
('TRN00010', 'MEM00004', '117.60');

-- --------------------------------------------------------

--
-- Table structure for table `tblnmedcategory`
--

DROP TABLE IF EXISTS `tblnmedcategory`;
CREATE TABLE IF NOT EXISTS `tblnmedcategory` (
  `strNMedCatCode` char(8) NOT NULL,
  `strNMedCatName` varchar(100) NOT NULL,
  `strNMedDesc` text,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strNMedCatCode`),
  UNIQUE KEY `strNMedCarCode_UNIQUE` (`strNMedCatCode`),
  UNIQUE KEY `strNMedCatName_UNIQUE` (`strNMedCatName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnmedcategory`
--

INSERT INTO `tblnmedcategory` (`strNMedCatCode`, `strNMedCatName`, `strNMedDesc`, `dtmLastUpdate`, `intStatus`) VALUES
('NMC00001', 'Medical Supply', 'Products that used as supply for medical purposes', '2016-03-02 15:36:31', 1),
('NMC00002', 'Consumer Goods', 'Products that are usually in grocery', '2016-03-02 15:36:31', 1),
('NMC00003', 'Galenicals', 'Usually herbal medicines that are applied externally', '2016-07-19 17:23:48', 1),
('NMC00004', 'Random', 'Wala pa po', '2016-03-11 21:42:50', 0),
('NMC00005', 'sad', 'sdd', '2016-03-11 21:42:55', 0),
('NMC00006', 'Cosmetics', 'For beauty care.', '2016-07-20 19:35:28', 1),
('NMC00007', 'Other products', 'Other products sold in the pharmacy', '2016-07-19 17:23:00', 0),
('NMC00008', 'Hair Care', 'Care for hair.', '2016-07-26 14:42:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblnmedgeneral`
--

DROP TABLE IF EXISTS `tblnmedgeneral`;
CREATE TABLE IF NOT EXISTS `tblnmedgeneral` (
  `strNMGenCode` char(8) NOT NULL,
  `strNMGenSizeCode` char(8) NOT NULL,
  PRIMARY KEY (`strNMGenCode`),
  UNIQUE KEY `strNMGenCode_UNIQUE` (`strNMGenCode`),
  KEY `Gene_SizeCode_idx` (`strNMGenSizeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnmedgeneral`
--

INSERT INTO `tblnmedgeneral` (`strNMGenCode`, `strNMGenSizeCode`) VALUES
('PRD00037', 'GSZ00002'),
('PRD00041', 'GSZ00002'),
('PRD00035', 'GSZ00003');

-- --------------------------------------------------------

--
-- Table structure for table `tblnmedstandard`
--

DROP TABLE IF EXISTS `tblnmedstandard`;
CREATE TABLE IF NOT EXISTS `tblnmedstandard` (
  `strNMStanCode` char(8) NOT NULL,
  `decNMStanSize` decimal(10,0) NOT NULL,
  `strNMStanUOMCode` char(8) NOT NULL,
  PRIMARY KEY (`strNMStanCode`),
  UNIQUE KEY `strNMStanCode_UNIQUE` (`strNMStanCode`),
  KEY `Stan_UOMCode_idx` (`strNMStanUOMCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnmedstandard`
--

INSERT INTO `tblnmedstandard` (`strNMStanCode`, `decNMStanSize`, `strNMStanUOMCode`) VALUES
('PRD00038', '120', 'UOM00001'),
('PRD00040', '150', 'UOM00002'),
('PRD00045', '740', 'UOM00001'),
('PRD00046', '740', 'UOM00001');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

DROP TABLE IF EXISTS `tblpackages`;
CREATE TABLE IF NOT EXISTS `tblpackages` (
  `strPackCode` char(8) NOT NULL,
  `strPackName` varchar(45) NOT NULL,
  `datPackFrom` date NOT NULL,
  `datPackTo` date NOT NULL,
  `decPackPrice` decimal(10,2) NOT NULL,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strPackCode`),
  UNIQUE KEY `strPackCode_UNIQUE` (`strPackCode`),
  UNIQUE KEY `strPackName_UNIQUE` (`strPackName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`strPackCode`, `strPackName`, `datPackFrom`, `datPackTo`, `decPackPrice`, `dtmLastUpdate`, `intStatus`) VALUES
('PKG00001', 'MaderPacker', '2000-01-01', '2020-01-01', '5000.00', '2016-08-03 15:25:16', 1),
('PKG00002', 'PackGanern', '1995-01-01', '2020-01-01', '200.00', '2016-08-04 14:59:26', 1),
('PKG00003', 'PackPackNiRegina', '2000-01-01', '2016-09-18', '4000.00', '2016-08-04 15:02:05', 1),
('PKG00004', 'PackPackNiNitche', '2000-01-01', '2018-01-01', '2000.00', '2016-08-04 15:03:49', 1),
('PKG00005', 'PackPackNiJeje', '2000-01-01', '2018-01-01', '500.00', '2016-08-04 15:07:00', 1),
('PKG00006', 'ManyPackagwe', '2000-01-01', '2017-02-03', '100.00', '2016-08-05 16:46:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpackproducts`
--

DROP TABLE IF EXISTS `tblpackproducts`;
CREATE TABLE IF NOT EXISTS `tblpackproducts` (
  `strPackProdCode` char(8) NOT NULL,
  `strPackProdProdCode` char(8) NOT NULL,
  `intPackProdQuantity` int(11) NOT NULL,
  PRIMARY KEY (`strPackProdCode`,`strPackProdProdCode`),
  KEY `Prod_Code_idx` (`strPackProdProdCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpackproducts`
--

INSERT INTO `tblpackproducts` (`strPackProdCode`, `strPackProdProdCode`, `intPackProdQuantity`) VALUES
('PKG00002', 'PRD00031', 5),
('PKG00002', 'PRD00043', 5),
('PKG00004', 'PRD00031', 5),
('PKG00004', 'PRD00043', 2),
('PKG00005', 'PRD00031', 4),
('PKG00006', 'PRD00043', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblpmform`
--

DROP TABLE IF EXISTS `tblpmform`;
CREATE TABLE IF NOT EXISTS `tblpmform` (
  `strPMFormCode` char(8) NOT NULL,
  `strPMFormName` varchar(100) NOT NULL,
  `strPMFormDesc` text,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strPMFormCode`),
  UNIQUE KEY `strPMFormCode_UNIQUE` (`strPMFormCode`),
  UNIQUE KEY `strPMFormName_UNIQUE` (`strPMFormName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpmform`
--

INSERT INTO `tblpmform` (`strPMFormCode`, `strPMFormName`, `strPMFormDesc`, `intStatus`) VALUES
('FRM00001', 'Capsules', '', 1),
('FRM00002', 'Tablet', NULL, 1),
('FRM00003', 'Syrup', NULL, 1),
('FRM00004', 'Caplet', '', 1),
('FRM00008', 'Suspension', 'Powder to liquid.', 1),
('FRM00009', 'Supository', 'Solid to liquid.', 1),
('FRM00010', 'Form1', 'update added', 0),
('FRM00011', 'Form2', '', 0),
('FRM00012', 'Form3', '', 0),
('FRM00013', 'FOrm4', '', 0),
('FRM00014', 'Form''s', '', 0),
('FRM00015', 'Nebule', 'Nebule.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpmmanufacturer`
--

DROP TABLE IF EXISTS `tblpmmanufacturer`;
CREATE TABLE IF NOT EXISTS `tblpmmanufacturer` (
  `strPMManuCode` char(8) NOT NULL,
  `strPMManuName` varchar(100) NOT NULL,
  `strPMManuDesc` text,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strPMManuCode`),
  UNIQUE KEY `strPMManuCode_UNIQUE` (`strPMManuCode`),
  UNIQUE KEY `strPMManuName_UNIQUE` (`strPMManuName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpmmanufacturer`
--

INSERT INTO `tblpmmanufacturer` (`strPMManuCode`, `strPMManuName`, `strPMManuDesc`, `dtmLastUpdate`, `intStatus`) VALUES
('MNF00001', 'RiteMed', 'Ritemed is great', '2016-07-16 00:30:09', 1),
('MNF00002', 'Novartis Healthcare', NULL, '2016-03-01 02:00:29', 1),
('MNF00003', 'Pfizer', NULL, '2016-03-01 02:00:29', 1),
('MNF00004', 'Pascual Laboratories', 'The number 1 health care alliance', '2016-03-01 02:21:53', 1),
('MNF00005', 'Pediatrica', 'Number one manufacturer of pediatric medicines', '2016-07-16 00:38:13', 1),
('MNF00006', 'Azarias Pharmaceutical Laboratories', '', '2016-03-12 16:22:09', 1),
('MNF00007', 'BioFemme', '', '2016-07-16 00:38:24', 0),
('MNF00008', 'Rightmed', '', '2016-03-12 16:22:22', 1),
('MNF00009', 'Abott', '', '2016-03-16 14:27:01', 1),
('MNF00010', 'Generika and Generics', '', '2016-07-22 12:58:46', 0),
('MNF00011', 'ManuA', '', '2016-07-22 12:58:53', 0),
('MNF00012', 'Luis Manufacturings', 'HAHAHA kaloka', '2016-07-21 12:49:01', 0),
('MNF00013', 'Unilab', 'Unilab', '2016-07-26 14:37:34', 1),
('MNF00014', 'Sanofi', 'Sanofi', '2016-07-26 14:38:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpmpackaging`
--

DROP TABLE IF EXISTS `tblpmpackaging`;
CREATE TABLE IF NOT EXISTS `tblpmpackaging` (
  `strPMPackCode` char(8) NOT NULL,
  `strPMPackName` varchar(100) NOT NULL,
  `strPMPackDesc` text,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strPMPackCode`),
  UNIQUE KEY `strPMPackCode_UNIQUE` (`strPMPackCode`),
  UNIQUE KEY `strPMPackName_UNIQUE` (`strPMPackName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpmpackaging`
--

INSERT INTO `tblpmpackaging` (`strPMPackCode`, `strPMPackName`, `strPMPackDesc`, `intStatus`) VALUES
('PCK00001', 'Bottle''s', 'HAHAH123', 1),
('PCK00002', 'Foil Pack', NULL, 1),
('PCK00008', 'Blister Pack', '', 1),
('PCK00011', 'Tube', 'Big with cream inside.', 1),
('PCK00012', 'Bottles', '', 1),
('PCK00013', 'Foil Packs', '', 1),
('PCK00014', 's', '', 0),
('PCK00015', 'LuisGuballoPackaging', 'extra large', 0),
('PCK00016', 'HUHUHU', 'iyakbes', 0),
('PCK00017', 'Vial', 'Vial.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpmtheraclass`
--

DROP TABLE IF EXISTS `tblpmtheraclass`;
CREATE TABLE IF NOT EXISTS `tblpmtheraclass` (
  `strPMTheraClassCode` char(8) NOT NULL,
  `strPMTheraClassName` varchar(100) NOT NULL,
  `strPMTheraClassDesc` text,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strPMTheraClassCode`),
  UNIQUE KEY `strPMTheraClassCode_UNIQUE` (`strPMTheraClassCode`),
  UNIQUE KEY `strPMTheraClassName_UNIQUE` (`strPMTheraClassName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpmtheraclass`
--

INSERT INTO `tblpmtheraclass` (`strPMTheraClassCode`, `strPMTheraClassName`, `strPMTheraClassDesc`, `dtmLastUpdate`, `intStatus`) VALUES
('THR00001', 'Analgesics', 'Central nervous system analgesics are drugs that alleviate pain without causing anesthesia. These analgesics are usually used to relieve severe pain.', '2016-07-15 18:19:24', 1),
('THR00002', 'Antibiotics', 'Antibiotic are agents that have microbial origin, that is they are derived from microorganisms. The different antibiotic agents affect DNA replication by various cytotoxic actions. They are used as chemotherapy agents to treat many types of cancers.', '2016-07-15 18:56:45', 1),
('THR00003', 'Antidepressants', 'Antidepressants are drugs that treat depression and improve the symptoms.', '2016-07-15 18:20:58', 1),
('THR00004', 'Antipsoriatics', 'Antipsoriatics are agents that are either taken orally or applied locally on the skin to treat psoriasis.', '2016-07-15 19:29:42', 1),
('THR00005', 'Decongestants', '', '2016-07-15 20:13:20', 1),
('THR00006', 'Thrombolytics', 'Classes of medicines for thrombones', '2016-07-16 16:08:37', 1),
('THR00007', 'Anti-infectives', '', '2016-07-15 20:19:38', 1),
('THR00008', 'Antidiarrheals', '', '2016-07-15 20:14:29', 1),
('THR00009', 'Antioxidants', '', '2016-07-15 20:18:18', 1),
('THR00010', 'Luis021', 'assss', '2016-07-15 21:31:24', 0),
('THR00011', 'Antipyretic', 'For lower fever.', '2016-07-26 14:34:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpointloadsetting`
--

DROP TABLE IF EXISTS `tblpointloadsetting`;
CREATE TABLE IF NOT EXISTS `tblpointloadsetting` (
  `id` int(11) NOT NULL,
  `LoadDefault` int(11) NOT NULL,
  `LoadMinimum` int(11) NOT NULL,
  `PointMinimum` int(11) NOT NULL,
  `PointPercent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpointloadsetting`
--

INSERT INTO `tblpointloadsetting` (`id`, `LoadDefault`, `LoadMinimum`, `PointMinimum`, `PointPercent`) VALUES
(1, 50, 20, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblprodmed`
--

DROP TABLE IF EXISTS `tblprodmed`;
CREATE TABLE IF NOT EXISTS `tblprodmed` (
  `strProdMedCode` char(8) NOT NULL,
  `intProdMedType` tinyint(4) NOT NULL,
  `strProdMedTheraCode` char(8) NOT NULL,
  `strProdMedBranCode` char(8) DEFAULT NULL,
  `strProdMedManuCode` char(8) NOT NULL,
  `strProdMedFormCode` char(8) NOT NULL,
  `decProdMedSize` decimal(10,0) NOT NULL,
  `strProdMedUOMCode` char(8) NOT NULL,
  `decProdMedDosSize` decimal(10,2) NOT NULL,
  `strProdMedDosUOMCode` char(8) NOT NULL,
  `decProdMedDosPerSize` decimal(10,2) NOT NULL,
  `strProdMedDosPerUOMCode` char(8) NOT NULL,
  `strProdMedPackCode` char(8) NOT NULL,
  `strProdMedDesc` text NOT NULL,
  PRIMARY KEY (`strProdMedCode`),
  UNIQUE KEY `strProdMedCode_UNIQUE` (`strProdMedCode`,`intProdMedType`,`decProdMedSize`,`strProdMedUOMCode`,`strProdMedBranCode`),
  KEY `ProdMed_ManuCode_idx` (`strProdMedManuCode`),
  KEY `ProdMed_FormCode_idx` (`strProdMedFormCode`),
  KEY `ProdMed_UOMCode_idx` (`strProdMedUOMCode`),
  KEY `ProdMed_PackCode_idx` (`strProdMedPackCode`),
  KEY `strProdMedBranCode` (`strProdMedBranCode`),
  KEY `ProdMed_TheraCode_idx` (`strProdMedTheraCode`),
  KEY `strProdMedDosUOMCode` (`strProdMedDosUOMCode`),
  KEY `strProdMedDosPerUOMCode` (`strProdMedDosPerUOMCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodmed`
--

INSERT INTO `tblprodmed` (`strProdMedCode`, `intProdMedType`, `strProdMedTheraCode`, `strProdMedBranCode`, `strProdMedManuCode`, `strProdMedFormCode`, `decProdMedSize`, `strProdMedUOMCode`, `decProdMedDosSize`, `strProdMedDosUOMCode`, `decProdMedDosPerSize`, `strProdMedDosPerUOMCode`, `strProdMedPackCode`, `strProdMedDesc`) VALUES
('PRD00012', 0, 'THR00004', 'MBR00003', 'MNF00004', 'FRM00004', '120', 'UOM00003', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00008', ''),
('PRD00013', 1, 'THR00001', NULL, 'MNF00001', 'FRM00002', '250', 'UOM00002', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00002', 'Gamot itech'),
('PRD00030', 0, 'THR00008', 'MBR00005', 'MNF00003', 'FRM00003', '120', 'UOM00002', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00008', 'Maganda ''to'),
('PRD00031', 1, 'THR00004', NULL, 'MNF00010', 'FRM00001', '500', 'UOM00003', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00002', ''),
('PRD00032', 1, 'THR00006', NULL, 'MNF00009', 'FRM00009', '150', 'UOM00002', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00011', 'Some medicine'),
('PRD00033', 0, 'THR00008', 'MBR00002', 'MNF00004', 'FRM00003', '250', 'UOM00001', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00001', ''),
('PRD00034', 0, 'THR00001', 'MBR00001', 'MNF00001', 'FRM00001', '100', 'UOM00001', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00001', 'The best medicine by Amoxil!'),
('PRD00042', 0, 'THR00004', 'MBR00003', 'MNF00004', 'FRM00004', '120', 'UOM00001', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00001', 'Medicine'),
('PRD00043', 1, 'THR00004', NULL, 'MNF00003', 'FRM00003', '250', 'UOM00005', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00002', ''),
('PRD00044', 1, 'THR00011', NULL, 'MNF00013', 'FRM00002', '500', 'UOM00002', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00002', 'Anti-sweetness.'),
('PRD00047', 0, 'THR00001', 'MBR00011', 'MNF00003', 'FRM00003', '120', 'UOM00001', '0.00', 'UOM00003', '0.00', 'UOM00002', 'PCK00001', '125mg/5ml'),
('PRD00048', 0, 'THR00011', 'MBR00002', 'MNF00006', 'FRM00004', '250', 'UOM00001', '20.00', 'UOM00001', '500.00', 'UOM00003', 'PCK00008', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblprodmedbranded`
--

DROP TABLE IF EXISTS `tblprodmedbranded`;
CREATE TABLE IF NOT EXISTS `tblprodmedbranded` (
  `strPMBranCode` char(8) NOT NULL,
  `strPMBranName` varchar(100) NOT NULL,
  `strPMBranDesc` text,
  `dtmLastUpdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strPMBranCode`),
  UNIQUE KEY `strPMBranCode_UNIQUE` (`strPMBranCode`),
  UNIQUE KEY `strPMBranName_UNIQUE` (`strPMBranName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodmedbranded`
--

INSERT INTO `tblprodmedbranded` (`strPMBranCode`, `strPMBranName`, `strPMBranDesc`, `dtmLastUpdate`, `intStatus`) VALUES
('MBR00001', 'Amoxil', '', '2016-03-01 01:44:41', 1),
('MBR00002', 'Diamox', NULL, '2016-02-29 22:37:13', 1),
('MBR00003', 'Ascobex', '', '2016-07-15 23:47:03', 1),
('MBR00004', 'Lotrimin Ultra Athletes Foot Cream', NULL, '2016-02-29 22:37:13', 1),
('MBR00005', 'Mentax', NULL, '2016-02-29 22:37:13', 1),
('MBR00008', 'Biogesic', '', '2016-03-12 16:21:59', 1),
('MBR00009', 'Zambon', '', '2016-03-16 14:26:46', 1),
('MBR00010', 'Luis & Friends', '', '2016-07-22 12:58:21', 0),
('MBR00011', 'Maximullin', '', '2016-07-15 23:58:29', 1),
('MBR00012', 'RandomBrand123', 'HAHAHAH kalurkiii', '2016-07-22 12:58:15', 0),
('MBR00013', 'Fernid', 'Ritemed', '2016-07-26 14:37:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblprodmedgeneric`
--

DROP TABLE IF EXISTS `tblprodmedgeneric`;
CREATE TABLE IF NOT EXISTS `tblprodmedgeneric` (
  `strPMGenCode` char(8) NOT NULL,
  `strPMGenName` varchar(100) NOT NULL,
  `strPMGenDesc` text,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`strPMGenCode`),
  UNIQUE KEY `strPMGenCode_UNIQUE` (`strPMGenCode`),
  UNIQUE KEY `strPMGenName_UNIQUE` (`strPMGenName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodmedgeneric`
--

INSERT INTO `tblprodmedgeneric` (`strPMGenCode`, `strPMGenName`, `strPMGenDesc`, `dtmLastUpdate`, `intStatus`) VALUES
('MGN00001', 'Amoxicillin', '', '2016-07-15 21:53:58', 1),
('MGN00002', 'Oxacillin', '', '2016-07-15 21:53:18', 1),
('MGN00003', 'Hydroxyzine', '', '2016-03-12 16:21:39', 1),
('MGN00004', 'Doxylamine', '', '2016-02-29 06:45:10', 1),
('MGN00005', 'Ascorbic Acid', '', '2016-02-29 06:45:10', 1),
('MGN00006', 'Acetazolamide', 'for glaucoma', '2016-02-29 14:42:56', 1),
('MGN00007', 'Moclobemide', '', '2016-07-15 22:10:11', 1),
('MGN00008', 'Amoxiciiicicicix', '', '2016-03-12 16:21:34', 1),
('MGN00009', 'Paracetamol', '', '2016-03-12 16:21:27', 1),
('MGN00010', 'Ibuprofen', '', '2016-03-16 14:26:31', 1),
('MGN00011', 'Mebendazole', 'Mebendazole is used to treat infections caused by worms such as whipworm, pinworm, roundworm, and hookworm.', '2016-07-15 22:07:49', 1),
('MGN00012', 'Metformin HCl', 'Hypoglycemic', '2016-07-26 14:36:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblprodmedtype`
--

DROP TABLE IF EXISTS `tblprodmedtype`;
CREATE TABLE IF NOT EXISTS `tblprodmedtype` (
  `strPMTypeCode` char(8) NOT NULL,
  `strPMTypeBranCode` char(8) DEFAULT NULL,
  `strPMTypeGenCode` char(8) NOT NULL,
  PRIMARY KEY (`strPMTypeCode`),
  UNIQUE KEY `strProdMedTypeCode_UNIQUE` (`strPMTypeCode`),
  UNIQUE KEY `TypeCodeName_UNIQUE` (`strPMTypeBranCode`,`strPMTypeGenCode`),
  KEY `strPMTypeGenCode` (`strPMTypeGenCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblprodnonmed`
--

DROP TABLE IF EXISTS `tblprodnonmed`;
CREATE TABLE IF NOT EXISTS `tblprodnonmed` (
  `strProdNMedCode` char(8) NOT NULL,
  `strProdNMedName` varchar(100) NOT NULL,
  `strProdNMedCatCode` char(8) NOT NULL,
  `intProdNMedMeasType` tinyint(4) NOT NULL,
  `strProdNMedDesc` text,
  PRIMARY KEY (`strProdNMedCode`),
  UNIQUE KEY `strProdNMedCode_UNIQUE` (`strProdNMedCode`),
  KEY `ProdNonMed_CatCode_idx` (`strProdNMedCatCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodnonmed`
--

INSERT INTO `tblprodnonmed` (`strProdNMedCode`, `strProdNMedName`, `strProdNMedCatCode`, `intProdNMedMeasType`, `strProdNMedDesc`) VALUES
('PRD00035', 'EQ Diaper', 'NMC00006', 0, 'Diaper'),
('PRD00036', 'Generika''s Random UnSizeable Product', 'NMC00001', 2, 'This is a description'),
('PRD00037', 'GeneralMeas', 'NMC00002', 0, ''),
('PRD00038', 'StanMeas', 'NMC00006', 1, ''),
('PRD00039', 'Generika''s Random UnSizeable Product', 'NMC00002', 2, 'haha'),
('PRD00040', 'RandomObject', 'NMC00001', 1, ''),
('PRD00041', 'RandomObject', 'NMC00001', 0, 'HAHAHAHHA BES!!!'),
('PRD00045', 'Pantene Shampoo', 'NMC00008', 1, 'Shampoo.'),
('PRD00046', 'Pantene Conditioner', 'NMC00008', 1, 'Conditioner.');

-- --------------------------------------------------------

--
-- Table structure for table `tblprodprice`
--

DROP TABLE IF EXISTS `tblprodprice`;
CREATE TABLE IF NOT EXISTS `tblprodprice` (
  `strProdPriceCode` char(8) NOT NULL,
  `decProdPricePerPiece` decimal(10,2) NOT NULL,
  `decPricePerPackage` decimal(10,2) DEFAULT '0.00',
  `intQtyPerPackage` int(11) DEFAULT '0',
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`strProdPriceCode`,`decProdPricePerPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodprice`
--

INSERT INTO `tblprodprice` (`strProdPriceCode`, `decProdPricePerPiece`, `decPricePerPackage`, `intQtyPerPackage`, `dtmLastUpdate`) VALUES
('PRD00012', '15.00', '0.00', 0, '2016-08-03 16:41:00'),
('PRD00013', '25.00', '0.00', 0, '2016-07-19 00:17:35'),
('PRD00030', '10.00', '25.00', 5, '2016-07-19 00:19:26'),
('PRD00031', '120.00', '200.00', 5, '2016-07-19 00:10:08'),
('PRD00032', '10.00', '80.00', 10, '2016-08-03 16:43:35'),
('PRD00033', '150.00', '150.00', 1, '2016-07-19 05:44:20'),
('PRD00034', '10.00', '130.00', 15, '2016-07-19 07:12:47'),
('PRD00035', '120.00', '0.00', 0, '2016-07-19 16:34:58'),
('PRD00036', '145.00', '0.00', 0, '2016-07-19 16:36:05'),
('PRD00037', '200.00', '0.00', 0, '2016-07-19 16:44:16'),
('PRD00038', '20.00', '0.00', 0, '2016-07-19 16:44:49'),
('PRD00039', '124.00', '0.00', 0, '2016-07-20 07:12:57'),
('PRD00040', '100.00', '0.00', 0, '2016-07-20 07:24:52'),
('PRD00041', '333.00', '0.00', 0, '2016-07-20 07:29:00'),
('PRD00042', '12.00', '100.00', 10, '2016-08-03 16:39:44'),
('PRD00043', '20.00', '200.00', 10, '2016-08-03 16:41:10'),
('PRD00044', '7.90', '79.00', 10, '2016-07-26 14:40:14'),
('PRD00045', '374.00', '0.00', 0, '2016-07-26 14:44:02'),
('PRD00046', '374.00', '0.00', 0, '2016-07-26 14:44:42'),
('PRD00047', '160.00', '160.00', 1, '2016-07-26 14:58:46'),
('PRD00048', '10.00', '100.00', 10, '2016-08-05 16:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

DROP TABLE IF EXISTS `tblproducts`;
CREATE TABLE IF NOT EXISTS `tblproducts` (
  `strProdCode` char(8) NOT NULL,
  `strProdType` tinyint(4) NOT NULL,
  `intStocks` int(11) NOT NULL,
  `dtmLastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strProdCode`),
  UNIQUE KEY `strProdCode_UNIQUE` (`strProdCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`strProdCode`, `strProdType`, `intStocks`, `dtmLastUpdate`, `intStatus`) VALUES
('PRD00012', 0, 500, '2016-08-03 16:40:59', 1),
('PRD00013', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00030', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00031', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00032', 0, 450, '2016-08-03 16:43:35', 1),
('PRD00033', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00034', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00035', 1, 400, '2016-08-03 16:39:44', 1),
('PRD00036', 1, 400, '2016-08-03 16:39:44', 1),
('PRD00037', 1, 400, '2016-08-03 16:39:44', 0),
('PRD00038', 1, 400, '2016-08-03 16:39:44', 0),
('PRD00039', 1, 400, '2016-08-03 16:39:44', 1),
('PRD00040', 1, 400, '2016-08-03 16:39:44', 0),
('PRD00041', 1, 400, '2016-08-03 16:39:44', 0),
('PRD00042', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00043', 0, 10, '2016-08-03 16:41:09', 1),
('PRD00044', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00045', 1, 400, '2016-08-03 16:39:44', 1),
('PRD00046', 1, 400, '2016-08-03 16:39:44', 1),
('PRD00047', 0, 400, '2016-08-03 16:39:44', 1),
('PRD00048', 0, 0, '2016-08-05 16:36:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo`
--

DROP TABLE IF EXISTS `tblpromo`;
CREATE TABLE IF NOT EXISTS `tblpromo` (
  `strPromoCode` char(8) NOT NULL,
  `strPromoName` varchar(45) NOT NULL,
  `strPromoDesc` text,
  `dblPromoPerc` double NOT NULL DEFAULT '0',
  `decPromoAmt` decimal(10,0) NOT NULL DEFAULT '0',
  `datPromoFrom` date NOT NULL,
  `datPromoTo` date NOT NULL,
  PRIMARY KEY (`strPromoCode`),
  UNIQUE KEY `strPromoCode_UNIQUE` (`strPromoCode`),
  UNIQUE KEY `strPromoName_UNIQUE` (`strPromoName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblpromprod`
--

DROP TABLE IF EXISTS `tblpromprod`;
CREATE TABLE IF NOT EXISTS `tblpromprod` (
  `StrPPPromCode` char(8) NOT NULL,
  `strPPProdCode` char(8) NOT NULL,
  PRIMARY KEY (`StrPPPromCode`,`strPPProdCode`),
  KEY `Prod_Code_idx` (`strPPProdCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblreturns`
--

DROP TABLE IF EXISTS `tblreturns`;
CREATE TABLE IF NOT EXISTS `tblreturns` (
  `strReturnCode` char(8) NOT NULL,
  `strReturnTransCode` char(8) CHARACTER SET utf16 NOT NULL,
  `strCustName` varchar(200) NOT NULL,
  `decTotalAmount` decimal(10,2) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  `isUsed` int(11) NOT NULL,
  PRIMARY KEY (`strReturnCode`),
  UNIQUE KEY `strReturnTransCode` (`strReturnTransCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblreturns`
--

INSERT INTO `tblreturns` (`strReturnCode`, `strReturnTransCode`, `strCustName`, `decTotalAmount`, `dtmDateAdded`, `isUsed`) VALUES
('RET00001', 'TRN00009', 'Anna Florece', '392.00', '2016-07-23 12:17:45', 0),
('RET00002', 'TRN00011', 'HAHAHAHABES', '120.00', '2016-07-27 14:39:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

DROP TABLE IF EXISTS `tbltransaction`;
CREATE TABLE IF NOT EXISTS `tbltransaction` (
  `strTransId` char(8) NOT NULL,
  `dtmTransDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `strTransEmpCode` char(8) NOT NULL,
  `strTransCustCode` char(8) DEFAULT NULL,
  `strTransDiscCode` char(8) DEFAULT NULL,
  PRIMARY KEY (`strTransId`),
  UNIQUE KEY `strTransId_UNIQUE` (`strTransId`),
  KEY `strTransEmpCode` (`strTransEmpCode`,`strTransCustCode`),
  KEY `strTransCustCode` (`strTransCustCode`),
  KEY `strTransDiscCode` (`strTransDiscCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbltransaction`
--

INSERT INTO `tbltransaction` (`strTransId`, `dtmTransDate`, `strTransEmpCode`, `strTransCustCode`, `strTransDiscCode`) VALUES
('TRN00001', '2016-07-23 09:22:45', 'EMP00001', 'MEM00003', NULL),
('TRN00002', '2016-07-23 09:29:08', 'EMP00001', NULL, NULL),
('TRN00003', '2016-07-23 09:47:26', 'EMP00001', 'MEM00003', NULL),
('TRN00004', '2016-07-23 09:49:59', 'EMP00001', 'MEM00003', NULL),
('TRN00005', '2016-07-23 10:15:01', 'EMP00001', 'MEM00003', NULL),
('TRN00006', '2016-07-23 10:16:41', 'EMP00001', NULL, NULL),
('TRN00007', '2016-07-23 10:19:32', 'EMP00001', NULL, NULL),
('TRN00008', '2016-07-23 10:58:54', 'EMP00001', 'MEM00003', NULL),
('TRN00009', '2016-07-23 11:07:49', 'EMP00001', NULL, 'DSC00001'),
('TRN00010', '2016-07-26 15:13:37', 'EMP00001', 'MEM00004', NULL),
('TRN00011', '2016-07-26 15:16:27', 'EMP00001', NULL, NULL),
('TRN00012', '2016-07-26 15:18:38', 'EMP00001', NULL, 'DSC00001');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransdetails`
--

DROP TABLE IF EXISTS `tbltransdetails`;
CREATE TABLE IF NOT EXISTS `tbltransdetails` (
  `strTDTransCode` char(8) NOT NULL,
  `strTDProdCode` char(8) NOT NULL,
  `intQuantity` int(11) NOT NULL,
  PRIMARY KEY (`strTDTransCode`,`strTDProdCode`),
  KEY `TD_ProdCode` (`strTDProdCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbltransdetails`
--

INSERT INTO `tbltransdetails` (`strTDTransCode`, `strTDProdCode`, `intQuantity`) VALUES
('TRN00001', 'PRD00034', 5),
('TRN00002', 'PRD00043', 10),
('TRN00003', 'PRD00032', 1),
('TRN00004', 'PRD00034', 1),
('TRN00005', 'PRD00043', 2),
('TRN00006', 'PRD00013', 10),
('TRN00007', 'PRD00031', 1),
('TRN00008', 'PRD00030', 5),
('TRN00009', 'PRD00034', 5),
('TRN00009', 'PRD00035', 5),
('TRN00009', 'PRD00042', 4),
('TRN00010', 'PRD00044', 20),
('TRN00010', 'PRD00045', 1),
('TRN00010', 'PRD00046', 1),
('TRN00010', 'PRD00047', 2),
('TRN00011', 'PRD00034', 3),
('TRN00011', 'PRD00035', 2),
('TRN00011', 'PRD00043', 5),
('TRN00012', 'PRD00034', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluom`
--

DROP TABLE IF EXISTS `tbluom`;
CREATE TABLE IF NOT EXISTS `tbluom` (
  `strUOMCode` char(8) CHARACTER SET utf8 NOT NULL,
  `strUOMName` varchar(100) COLLATE utf8_bin NOT NULL,
  `strUOMDesc` text CHARACTER SET utf8,
  `intStatus` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`strUOMCode`),
  UNIQUE KEY `strUOMCode_UNIQUE` (`strUOMCode`),
  UNIQUE KEY `strUOMName_UNIQUE` (`strUOMName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbluom`
--

INSERT INTO `tbluom` (`strUOMCode`, `strUOMName`, `strUOMDesc`, `intStatus`) VALUES
('UOM00001', 'ml', 'milliliters', 1),
('UOM00002', 'mg', 'milligrams', 1),
('UOM00003', 'kg', 'kilograms', 1),
('UOM00004', 'lbs', 'pounds', 0),
('UOM00005', 'g', 'Grams.', 1),
('UOM00006', 'G', '', 1),
('UOM00007', 'mL', '123', 0),
('UOM00008', 'km', 'kilometer', 0),
('UOM00009', 'Km', 'KILOmeter', 0),
('UOM00010', 'Oz', 'Ounce', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblegccust`
--
ALTER TABLE `tblegccust`
  ADD CONSTRAINT `EGC_Code` FOREIGN KEY (`strEGCCCode`) REFERENCES `tblegc` (`strEGCCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Mem_Code` FOREIGN KEY (`strEGCMemCode`) REFERENCES `tblmember` (`strMemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblegcprods`
--
ALTER TABLE `tblegcprods`
  ADD CONSTRAINT `EP_EGCCode` FOREIGN KEY (`strEPEGCCode`) REFERENCES `tblegc` (`strEGCCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EP_ProdCode` FOREIGN KEY (`strEPProdCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblempbranch`
--
ALTER TABLE `tblempbranch`
  ADD CONSTRAINT `BBranch_Code` FOREIGN KEY (`strEBBranchCode`) REFERENCES `tblbranches` (`strBranchCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `BEmp_Code` FOREIGN KEY (`strEBEmpCode`) REFERENCES `tblemployee` (`strEmpCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD CONSTRAINT `Emp_JobCode` FOREIGN KEY (`strEmpJobCode`) REFERENCES `tblempjobdesc` (`strEJCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblformpack`
--
ALTER TABLE `tblformpack`
  ADD CONSTRAINT `FP_FormCode` FOREIGN KEY (`strFPFormCode`) REFERENCES `tblpmform` (`strPMFormCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FP_PackCode` FOREIGN KEY (`strFPPackCode`) REFERENCES `tblpmpackaging` (`strPMPackCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmedgennames`
--
ALTER TABLE `tblmedgennames`
  ADD CONSTRAINT `MedGen_GenCode` FOREIGN KEY (`strMedGenGenCode`) REFERENCES `tblprodmedgeneric` (`strPMGenCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MedGen_MedCode` FOREIGN KEY (`strMedGenMedCode`) REFERENCES `tblprodmed` (`strProdMedCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmemaccount`
--
ALTER TABLE `tblmemaccount`
  ADD CONSTRAINT `AMem_Code` FOREIGN KEY (`strMemAcctCode`) REFERENCES `tblmember` (`strMemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmemcard`
--
ALTER TABLE `tblmemcard`
  ADD CONSTRAINT `CaMem_Code` FOREIGN KEY (`strMCardCode`) REFERENCES `tblmember` (`strMemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmemcredit`
--
ALTER TABLE `tblmemcredit`
  ADD CONSTRAINT `CMem_Code` FOREIGN KEY (`strMCreditCode`) REFERENCES `tblmemaccount` (`strMemAcctCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmempoints`
--
ALTER TABLE `tblmempoints`
  ADD CONSTRAINT `Point_MemCode` FOREIGN KEY (`strPointMemCode`) REFERENCES `tblmemaccount` (`strMemAcctCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Point_TransCode` FOREIGN KEY (`strPointTransCode`) REFERENCES `tbltransaction` (`strTransId`) ON UPDATE CASCADE;

--
-- Constraints for table `tblnmedgeneral`
--
ALTER TABLE `tblnmedgeneral`
  ADD CONSTRAINT `Gene_ProdNonMedCode` FOREIGN KEY (`strNMGenCode`) REFERENCES `tblprodnonmed` (`strProdNMedCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Gene_SizeCode` FOREIGN KEY (`strNMGenSizeCode`) REFERENCES `tblgensize` (`strGenSizeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblnmedstandard`
--
ALTER TABLE `tblnmedstandard`
  ADD CONSTRAINT `Stan_ProdNonMed` FOREIGN KEY (`strNMStanCode`) REFERENCES `tblprodnonmed` (`strProdNMedCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Stan_UOMCode` FOREIGN KEY (`strNMStanUOMCode`) REFERENCES `tbluom` (`strUOMCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpackproducts`
--
ALTER TABLE `tblpackproducts`
  ADD CONSTRAINT `Pack_Code` FOREIGN KEY (`strPackProdCode`) REFERENCES `tblpackages` (`strPackCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `PaProd_Code` FOREIGN KEY (`strPackProdProdCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblprodmed`
--
ALTER TABLE `tblprodmed`
  ADD CONSTRAINT `ProdMed_BranCode` FOREIGN KEY (`strProdMedBranCode`) REFERENCES `tblprodmedbranded` (`strPMBranCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_DosPerUOMCode` FOREIGN KEY (`strProdMedDosPerUOMCode`) REFERENCES `tbluom` (`strUOMCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_DosUOMCode` FOREIGN KEY (`strProdMedDosUOMCode`) REFERENCES `tbluom` (`strUOMCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_FormCode` FOREIGN KEY (`strProdMedFormCode`) REFERENCES `tblpmform` (`strPMFormCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_ManuCode` FOREIGN KEY (`strProdMedManuCode`) REFERENCES `tblpmmanufacturer` (`strPMManuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_PackCode` FOREIGN KEY (`strProdMedPackCode`) REFERENCES `tblpmpackaging` (`strPMPackCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_ProdCode` FOREIGN KEY (`strProdMedCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdMed_UOMCode` FOREIGN KEY (`strProdMedUOMCode`) REFERENCES `tbluom` (`strUOMCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdNed_TheraClassCode` FOREIGN KEY (`strProdMedTheraCode`) REFERENCES `tblpmtheraclass` (`strPMTheraClassCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblprodmedtype`
--
ALTER TABLE `tblprodmedtype`
  ADD CONSTRAINT `Type_BranCode` FOREIGN KEY (`strPMTypeBranCode`) REFERENCES `tblprodmedbranded` (`strPMBranCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Type_GenCode` FOREIGN KEY (`strPMTypeGenCode`) REFERENCES `tblprodmedgeneric` (`strPMGenCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblprodnonmed`
--
ALTER TABLE `tblprodnonmed`
  ADD CONSTRAINT `ProdNonMed_CatCode` FOREIGN KEY (`strProdNMedCatCode`) REFERENCES `tblnmedcategory` (`strNMedCatCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblprodprice`
--
ALTER TABLE `tblprodprice`
  ADD CONSTRAINT `ProdPrice_ProdCode` FOREIGN KEY (`strProdPriceCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpromprod`
--
ALTER TABLE `tblpromprod`
  ADD CONSTRAINT `Promo_Code` FOREIGN KEY (`StrPPPromCode`) REFERENCES `tblpromo` (`strPromoCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `PrProd_Code` FOREIGN KEY (`strPPProdCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD CONSTRAINT `Trans_DiscCode` FOREIGN KEY (`strTransDiscCode`) REFERENCES `tbldiscounts` (`strDiscCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Trans_EmpCode` FOREIGN KEY (`strTransEmpCode`) REFERENCES `tblemployee` (`strEmpCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Trans_MemCode` FOREIGN KEY (`strTransCustCode`) REFERENCES `tblmember` (`strMemCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbltransdetails`
--
ALTER TABLE `tbltransdetails`
  ADD CONSTRAINT `TD_ProdCode` FOREIGN KEY (`strTDProdCode`) REFERENCES `tblproducts` (`strProdCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TD_TransCode` FOREIGN KEY (`strTDTransCode`) REFERENCES `tbltransaction` (`strTransId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
