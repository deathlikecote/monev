-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2014 at 05:40 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spm`
--

-- --------------------------------------------------------

--
-- Table structure for table `edopuser`
--

CREATE TABLE `edopuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idprogstudi` varchar(45) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `edopuser`
--

INSERT INTO `edopuser` VALUES(1, 'SAK', 'Studi Akomodasi & Katering', '196012021982032001', 'f7a770f2c00a91afefdb6f9f831a80f9');
INSERT INTO `edopuser` VALUES(2, 'ADH', 'Administrasi Hotel', '197606282005021001', 'bdb7678517048ff18c73ec4eec792a74');
INSERT INTO `edopuser` VALUES(3, 'MDK', 'Divisi Kamar', '197307231995032001', '5efb382e872e40d8ff51023143799b71');
INSERT INTO `edopuser` VALUES(4, 'MTH', 'Tata Hidang', '197809082011011008', 'eeb1052a52c55dbc85de48b2b2a6316e');
INSERT INTO `edopuser` VALUES(5, 'MTB', 'Tata Boga', '196303021995031001', '610e24312266f2ae198fabc5712c9406');
INSERT INTO `edopuser` VALUES(6, 'MPI', 'Patiseri', '196208251990031001', 'f4f2b2b03a5be448e314b9da79f05a56');
INSERT INTO `edopuser` VALUES(7, 'SDP', 'Studi Destinasi Pariwisata', '197201192002122001', '1feb22d7ffb0a96c502ccbd63fa75171');
INSERT INTO `edopuser` VALUES(8, 'MDP', 'Destinasi Pariwisata', '195804261992032001', 'd018a2ea014a267f2ac18e803c232c8f');
INSERT INTO `edopuser` VALUES(9, 'MBW', 'Bisnis Pariwisata', '197208072003121001', '620a38831ee802efc292199c5f3fd8a1');
INSERT INTO `edopuser` VALUES(10, 'SIP', 'Studi Industri Perjalanan', '198005152006052001', 'a75f50ebc22c898a55a6fc077c8e9bd0');
INSERT INTO `edopuser` VALUES(11, 'MBP', 'Bisnis Perjalanan', '197510242009021001', '0ae73536aae3573c4f6bd23a206fa6aa');
INSERT INTO `edopuser` VALUES(12, 'MBK', 'Bisnis Konvensi', '198001212005022001', '2943ac38635768c60ad9669e075207d9');
INSERT INTO `edopuser` VALUES(13, 'MPP', 'Pengaturan Perjalanan', '197303152006051002', '48f5a326e9ea389be9810b5196939ba0');
INSERT INTO `edopuser` VALUES(14, 'MDKJ', 'MDK Berjenjang', '197307231995032001', '5efb382e872e40d8ff51023143799b71');
INSERT INTO `edopuser` VALUES(15, 'MTHJ', 'MTH Berjenjang', '197809082011011008', 'eeb1052a52c55dbc85de48b2b2a6316e');
INSERT INTO `edopuser` VALUES(16, 'MTBJ', 'MTB Berjenjang', '196303021995031001', '610e24312266f2ae198fabc5712c9406');
INSERT INTO `edopuser` VALUES(17, 'MPIJ', 'MPI Berjenjang', '196208251990031001', 'f4f2b2b03a5be448e314b9da79f05a56');
