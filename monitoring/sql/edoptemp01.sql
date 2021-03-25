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
-- Table structure for table `edoptemp01`
--

CREATE TABLE `edoptemp01` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `id_parameter` int(4) NOT NULL,
  `parameter` text NOT NULL,
  `aspek` varchar(45) NOT NULL,
  `jenis` tinyint(4) NOT NULL,
  `v1` tinyint(4) NOT NULL,
  `countv1` int(4) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `scorepar` float NOT NULL,
  `scoreas` float NOT NULL,
  `scoredos` float NOT NULL,
  `jmlmhs` int(4) NOT NULL,
  `kodeidpar` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `edoptemp01`
--

INSERT INTO `edoptemp01` VALUES(1, 'adm/iraBAAMBW', 1, 'Menyerahlan silabus terkini mata kuliah yang diampu sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 1, 1, 1, 2, 0, '');
INSERT INTO `edoptemp01` VALUES(2, 'adm/iraBAAMBW', 2, 'Menyerahkan SAP terkini mata kuliah yang diampu sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 1, 1, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(3, 'adm/iraBAAMBW', 3, 'Menyerahkan buku ajar/diktat terkini sebelum perkuliahan dimulai', '1. Perencanaan PBM', 2, 0, 0, 1, 1, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(4, 'adm/iraBAAMBW', 4, 'Kesesuaian PBM dengan SAP', '2. Pelaksanaan PBM', 2, 0, 0, 1, 1, 3, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(5, 'adm/iraBAAMBW', 5, 'Kehadiran dosen dalam perkuliahan >= 75%', '2. Pelaksanaan PBM', 2, 0, 0, 1, 1, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(6, 'adm/iraBAAMBW', 6, 'Persentase kehadiran dosen dalam perkuliahan', '2. Pelaksanaan PBM', 3, 0, 0, 74, 74, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(7, 'adm/iraBAAMBW', 7, 'Ketepatan waktu penyerahan soal ujian (UTS, UAS & UU)', '2. Pelaksanaan PBM', 2, 0, 0, 5, 5, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(8, 'adm/iraBAAMBW', 8, 'Kehadiran Dosen untuk mengawas ujian (UTS, UAS, UU)', '2. Pelaksanaan PBM', 2, 0, 0, 5, 5, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(9, 'adm/iraBAAMBW', 9, 'Ketepatan waktu penyerahan nilai UTS', '3. Evaluasi PBM', 2, 0, 0, 1, 1, 2, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(10, 'adm/iraBAAMBW', 10, 'Ketepatan waktu penyerahan nilai UAS', '3. Evaluasi PBM', 2, 0, 0, 1, 1, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(11, 'adm/iraBAAMBW', 11, 'Kehadiran Dosen untuk mengawas UU', '3. Evaluasi PBM', 2, 0, 0, 1, 1, 0, 0, 0, '');
INSERT INTO `edoptemp01` VALUES(12, 'adm/iraBAAMBW', 12, 'Terjalin komunikasi Dosen dengan Program Studi', '3. Evaluasi PBM', 2, 0, 0, 5, 5, 0, 0, 0, '');
