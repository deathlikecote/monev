-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2014 at 05:39 AM
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
-- Table structure for table `edopparameter`
--

CREATE TABLE `edopparameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter` text NOT NULL,
  `aspek` varchar(45) NOT NULL,
  `jenis` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 -> merit,\n2 -> Y/T\n3 -> value',
  `nourut` int(11) NOT NULL,
  `hide` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `edopparameter`
--

INSERT INTO `edopparameter` VALUES(1, 'Menyerahlan silabus terkini mata kuliah yang diampu sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(2, 'Menyerahkan SAP terkini mata kuliah yang diampu sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(3, 'Menyerahkan buku ajar/diktat terkini sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(4, 'Kesesuaian PBM dengan SAP', '2. Pelaksanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(5, 'Kehadiran dosen dalam perkuliahan >= 75%', '2. Pelaksanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(6, 'Persentase kehadiran dosen dalam perkuliahan', '2. Pelaksanaan PBM', 3, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(7, 'Ketepatan waktu penyerahan soal ujian (UTS, UAS & UU)', '2. Pelaksanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(8, 'Kehadiran Dosen untuk mengawas ujian (UTS, UAS, UU)', '2. Pelaksanaan PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(9, 'Ketepatan waktu penyerahan nilai UTS', '3. Evaluasi PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(10, 'Ketepatan waktu penyerahan nilai UAS', '3. Evaluasi PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(11, 'Kehadiran Dosen untuk mengawas UU', '3. Evaluasi PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(12, 'Terjalin komunikasi Dosen dengan Program Studi', '3. Evaluasi PBM', 2, 0, 0, 0);
INSERT INTO `edopparameter` VALUES(13, 'a', 'a', 1, 1, 0, 1);
INSERT INTO `edopparameter` VALUES(14, 'wert', 'a', 1, 1, 0, 1);
INSERT INTO `edopparameter` VALUES(15, 'as', 'a', 1, 1, 0, 1);
INSERT INTO `edopparameter` VALUES(16, 'asda', 'a', 1, 2, 0, 1);
