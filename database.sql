-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dbnilai
CREATE DATABASE IF NOT EXISTS `dbnilai` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbnilai`;

-- Dumping structure for table dbnilai.tbladmin
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tbladmin: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbladmin` DISABLE KEYS */;
INSERT INTO `tbladmin` (`username`, `password`, `Nama`) VALUES
	('admin', 'admin', 'Admin');
/*!40000 ALTER TABLE `tbladmin` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblguru
CREATE TABLE IF NOT EXISTS `tblguru` (
  `NIP` char(18) NOT NULL,
  `NamaGuru` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`NIP`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblguru: ~2 rows (approximately)
/*!40000 ALTER TABLE `tblguru` DISABLE KEYS */;
INSERT INTO `tblguru` (`NIP`, `NamaGuru`, `username`, `password`) VALUES
	('123456789123212321', 'Achmad Sanusi, S.Pd.', 'achmad', 'achmad'),
	('201656789123211978', 'Maryanto Achmad, S.pd', 'ma', 'maryanto');
/*!40000 ALTER TABLE `tblguru` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblkehadiran
CREATE TABLE IF NOT EXISTS `tblkehadiran` (
  `idKehadiran` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` char(18) NOT NULL DEFAULT '0',
  `idMutasi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` char(1) DEFAULT NULL,
  PRIMARY KEY (`idKehadiran`),
  KEY `idMutasi` (`idMutasi`),
  KEY `NIP` (`NIP`),
  CONSTRAINT `FK_tblkehadiran_tblmutasi` FOREIGN KEY (`idMutasi`) REFERENCES `tblmutasi` (`idMutasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblkehadiran: ~123 rows (approximately)
/*!40000 ALTER TABLE `tblkehadiran` DISABLE KEYS */;
INSERT INTO `tblkehadiran` (`idKehadiran`, `NIP`, `idMutasi`, `tanggal`, `keterangan`) VALUES
	(70, '123456789123212321', 1, '2016-05-23', 'h'),
	(72, '123456789123212321', 3, '2016-05-23', 's'),
	(73, '123456789123212321', 4, '2016-05-23', 'h'),
	(74, '123456789123212321', 5, '2016-05-23', 'a'),
	(75, '123456789123212321', 12, '2016-05-23', 's'),
	(76, '123456789123212321', 6, '2016-05-23', 'h'),
	(77, '123456789123212321', 7, '2016-05-23', 'i'),
	(79, '123456789123212321', 9, '2016-05-23', 'a'),
	(80, '123456789123212321', 10, '2016-05-23', 'i'),
	(81, '123456789123212321', 11, '2016-05-23', 'h'),
	(82, '123456789123212321', 13, '2016-05-23', 'a'),
	(83, '123456789123212321', 14, '2016-05-23', 'h'),
	(84, '123456789123212321', 15, '2016-05-23', 'h'),
	(85, '123456789123212321', 16, '2016-05-23', 'a'),
	(86, '123456789123212321', 17, '2016-05-23', 'h'),
	(87, '123456789123212321', 18, '2016-05-23', 'i'),
	(88, '123456789123212321', 19, '2016-05-23', 'h'),
	(89, '123456789123212321', 1, '2016-05-24', 'h'),
	(91, '123456789123212321', 3, '2016-05-24', 'h'),
	(92, '123456789123212321', 4, '2016-05-24', 'h'),
	(93, '123456789123212321', 5, '2016-05-24', 'a'),
	(94, '123456789123212321', 12, '2016-05-24', 'h'),
	(95, '123456789123212321', 6, '2016-05-24', 'h'),
	(96, '123456789123212321', 7, '2016-05-24', 'i'),
	(98, '123456789123212321', 9, '2016-05-24', 'i'),
	(99, '123456789123212321', 10, '2016-05-24', 'h'),
	(100, '123456789123212321', 11, '2016-05-24', 's'),
	(101, '123456789123212321', 13, '2016-05-24', 'h'),
	(102, '123456789123212321', 14, '2016-05-24', 'i'),
	(103, '123456789123212321', 15, '2016-05-24', 'h'),
	(104, '123456789123212321', 16, '2016-05-24', 'a'),
	(105, '123456789123212321', 17, '2016-05-24', 'h'),
	(106, '123456789123212321', 18, '2016-05-24', 'h'),
	(107, '123456789123212321', 19, '2016-05-24', 's'),
	(108, '123456789123212321', 1, '2016-05-25', 'h'),
	(110, '123456789123212321', 3, '2016-05-25', 'h'),
	(111, '123456789123212321', 4, '2016-05-25', 'h'),
	(112, '123456789123212321', 5, '2016-05-25', 'h'),
	(113, '123456789123212321', 12, '2016-05-25', 'a'),
	(114, '123456789123212321', 6, '2016-05-25', 'a'),
	(115, '123456789123212321', 7, '2016-05-25', 'h'),
	(117, '123456789123212321', 9, '2016-05-25', 'h'),
	(118, '123456789123212321', 10, '2016-05-25', 'a'),
	(119, '123456789123212321', 11, '2016-05-25', 'h'),
	(120, '123456789123212321', 13, '2016-05-25', 'h'),
	(121, '123456789123212321', 14, '2016-05-25', 'h'),
	(122, '123456789123212321', 15, '2016-05-25', 'i'),
	(123, '123456789123212321', 16, '2016-05-25', 'h'),
	(124, '123456789123212321', 17, '2016-05-25', 's'),
	(125, '123456789123212321', 18, '2016-05-25', 'h'),
	(126, '123456789123212321', 19, '2016-05-25', 'h'),
	(127, '123456789123212321', 1, '2016-05-26', 's'),
	(129, '123456789123212321', 3, '2016-05-26', 'h'),
	(130, '123456789123212321', 4, '2016-05-26', 's'),
	(131, '123456789123212321', 5, '2016-05-26', 'h'),
	(132, '123456789123212321', 12, '2016-05-26', 'a'),
	(133, '123456789123212321', 13, '2016-05-26', 'i'),
	(134, '123456789123212321', 14, '2016-05-26', 'h'),
	(135, '123456789123212321', 15, '2016-05-26', 'h'),
	(136, '123456789123212321', 16, '2016-05-26', 'h'),
	(137, '123456789123212321', 17, '2016-05-26', 's'),
	(138, '123456789123212321', 18, '2016-05-26', 'h'),
	(139, '123456789123212321', 19, '2016-05-26', 'h'),
	(140, '123456789123212321', 1, '2016-05-27', 'i'),
	(142, '123456789123212321', 3, '2016-05-27', 'h'),
	(143, '123456789123212321', 4, '2016-05-27', 'h'),
	(144, '123456789123212321', 5, '2016-05-27', 'h'),
	(145, '123456789123212321', 12, '2016-05-27', 'a'),
	(146, '123456789123212321', 6, '2016-05-27', 'h'),
	(147, '123456789123212321', 7, '2016-05-27', 'h'),
	(149, '123456789123212321', 9, '2016-05-27', 'h'),
	(150, '123456789123212321', 10, '2016-05-27', 'a'),
	(151, '123456789123212321', 11, '2016-05-27', 'h'),
	(152, '123456789123212321', 13, '2016-05-27', 'h'),
	(153, '123456789123212321', 14, '2016-05-27', 'h'),
	(154, '123456789123212321', 15, '2016-05-27', 's'),
	(155, '123456789123212321', 16, '2016-05-27', 's'),
	(156, '123456789123212321', 17, '2016-05-27', 's'),
	(157, '123456789123212321', 18, '2016-05-27', 'h'),
	(158, '123456789123212321', 19, '2016-05-27', 'h'),
	(159, '123456789123212321', 1, '2016-05-28', 'h'),
	(161, '123456789123212321', 3, '2016-05-28', 'h'),
	(162, '123456789123212321', 4, '2016-05-28', 'h'),
	(163, '123456789123212321', 5, '2016-05-28', 'h'),
	(164, '123456789123212321', 12, '2016-05-28', 'h'),
	(165, '123456789123212321', 6, '2016-05-28', 'h'),
	(166, '123456789123212321', 7, '2016-05-28', 'i'),
	(168, '123456789123212321', 9, '2016-05-28', 'h'),
	(169, '123456789123212321', 10, '2016-05-28', 's'),
	(170, '123456789123212321', 11, '2016-05-28', 'a'),
	(171, '123456789123212321', 13, '2016-05-28', 'h'),
	(172, '123456789123212321', 14, '2016-05-28', 'h'),
	(173, '123456789123212321', 15, '2016-05-28', 'h'),
	(174, '123456789123212321', 16, '2016-05-28', 'h'),
	(175, '123456789123212321', 17, '2016-05-28', 's'),
	(176, '123456789123212321', 18, '2016-05-28', 'a'),
	(177, '123456789123212321', 19, '2016-05-28', 'h'),
	(178, '123456789123212321', 1, '2016-06-19', 'h'),
	(179, '123456789123212321', 3, '2016-06-19', 'h'),
	(180, '123456789123212321', 4, '2016-06-19', 'h'),
	(181, '123456789123212321', 5, '2016-06-19', 'h'),
	(182, '123456789123212321', 12, '2016-06-19', 'h'),
	(183, '123456789123212321', 20, '2016-06-19', 'h'),
	(184, '123456789123212321', 21, '2016-06-19', 'h'),
	(185, '123456789123212321', 1, '2016-07-02', 't'),
	(186, '123456789123212321', 3, '2016-07-02', 't'),
	(187, '123456789123212321', 4, '2016-07-02', 't'),
	(188, '123456789123212321', 5, '2016-07-02', 't'),
	(189, '123456789123212321', 12, '2016-07-02', 't'),
	(190, '123456789123212321', 20, '2016-07-02', 'h'),
	(191, '123456789123212321', 21, '2016-07-02', 'h'),
	(192, '123456789123212321', 6, '2016-07-02', 'i'),
	(193, '123456789123212321', 7, '2016-07-02', 's'),
	(194, '123456789123212321', 9, '2016-07-02', 'h'),
	(195, '123456789123212321', 10, '2016-07-02', 'a'),
	(196, '123456789123212321', 11, '2016-07-02', 'h'),
	(197, '123456789123212321', 13, '2016-07-02', 'a'),
	(198, '123456789123212321', 14, '2016-07-02', 'a'),
	(199, '123456789123212321', 15, '2016-07-02', 's'),
	(200, '123456789123212321', 16, '2016-07-02', 's'),
	(201, '123456789123212321', 17, '2016-07-02', 'i'),
	(202, '123456789123212321', 18, '2016-07-02', 'h'),
	(203, '123456789123212321', 19, '2016-07-02', 'a');
/*!40000 ALTER TABLE `tblkehadiran` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblkelas
CREATE TABLE IF NOT EXISTS `tblkelas` (
  `idKelas` int(11) NOT NULL AUTO_INCREMENT,
  `Kelas` varchar(20) NOT NULL,
  PRIMARY KEY (`idKelas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblkelas: ~6 rows (approximately)
/*!40000 ALTER TABLE `tblkelas` DISABLE KEYS */;
INSERT INTO `tblkelas` (`idKelas`, `Kelas`) VALUES
	(1, '1 IPA A'),
	(3, '1 IPA B'),
	(4, '1 IPS A'),
	(5, '2 IPA A'),
	(6, '2 IPA B'),
	(7, '2 IPS A');
/*!40000 ALTER TABLE `tblkelas` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblkurikulum
CREATE TABLE IF NOT EXISTS `tblkurikulum` (
  `idKurikulum` int(11) NOT NULL AUTO_INCREMENT,
  `idTahunAjar` int(11) NOT NULL DEFAULT '0',
  `idKelas` int(11) DEFAULT NULL,
  `idMatapelajaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKurikulum`),
  KEY `idKelas` (`idKelas`),
  KEY `id_matapelajaran` (`idMatapelajaran`),
  KEY `idTahunAjar` (`idTahunAjar`),
  CONSTRAINT `FK_tblkurikulum_tblkelas` FOREIGN KEY (`idKelas`) REFERENCES `tblkelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblkurikulum_tblmatapelajaran` FOREIGN KEY (`idMatapelajaran`) REFERENCES `tblmatapelajaran` (`idMatapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblkurikulum_tbltahunajar` FOREIGN KEY (`idTahunAjar`) REFERENCES `tbltahunajar` (`idTahunAjar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblkurikulum: ~24 rows (approximately)
/*!40000 ALTER TABLE `tblkurikulum` DISABLE KEYS */;
INSERT INTO `tblkurikulum` (`idKurikulum`, `idTahunAjar`, `idKelas`, `idMatapelajaran`) VALUES
	(8, 1, 3, 2),
	(9, 1, 3, 3),
	(10, 1, 3, 4),
	(11, 1, 3, 5),
	(12, 1, 3, 7),
	(13, 1, 4, 1),
	(14, 1, 4, 2),
	(15, 1, 4, 3),
	(16, 1, 4, 4),
	(17, 1, 4, 5),
	(18, 1, 4, 8),
	(43, 1, 7, 1),
	(44, 1, 7, 2),
	(45, 1, 7, 3),
	(46, 1, 7, 4),
	(47, 1, 7, 5),
	(48, 1, 7, 8),
	(49, 1, 1, 1),
	(50, 1, 1, 2),
	(51, 1, 1, 3),
	(52, 1, 1, 4),
	(53, 1, 1, 5),
	(54, 1, 1, 7);
/*!40000 ALTER TABLE `tblkurikulum` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblmatapelajaran
CREATE TABLE IF NOT EXISTS `tblmatapelajaran` (
  `idMatapelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `mata_pelajaran` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idMatapelajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblmatapelajaran: ~6 rows (approximately)
/*!40000 ALTER TABLE `tblmatapelajaran` DISABLE KEYS */;
INSERT INTO `tblmatapelajaran` (`idMatapelajaran`, `mata_pelajaran`, `keterangan`) VALUES
	(1, 'Bahasa Indonesia', 'Wajib'),
	(2, 'Matematika', 'Wajib'),
	(3, 'Pendidikan Agama Islam', 'Wajib'),
	(4, 'Pendidikan Kewarganegaraan', 'Wajib'),
	(5, 'Olah Raga', 'Wajib'),
	(7, 'Ilmu Pengetahuan Alam', 'Wajib'),
	(8, 'Ilmu Pengetahuan Sosial', 'Wajib');
/*!40000 ALTER TABLE `tblmatapelajaran` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblmutasi
CREATE TABLE IF NOT EXISTS `tblmutasi` (
  `idMutasi` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) DEFAULT NULL,
  `idKelas` int(11) DEFAULT NULL,
  `idTahunAjar` int(11) DEFAULT NULL,
  `tglMutasi` date DEFAULT NULL,
  PRIMARY KEY (`idMutasi`),
  KEY `nis` (`nis`),
  KEY `idKelas` (`idKelas`),
  KEY `idTahunAjar` (`idTahunAjar`),
  CONSTRAINT `FK_tblmutasi_tblkelas` FOREIGN KEY (`idKelas`) REFERENCES `tblkelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblmutasi_tblsiswa` FOREIGN KEY (`nis`) REFERENCES `tblsiswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblmutasi_tbltahunajar` FOREIGN KEY (`idTahunAjar`) REFERENCES `tbltahunajar` (`idTahunAjar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblmutasi: ~19 rows (approximately)
/*!40000 ALTER TABLE `tblmutasi` DISABLE KEYS */;
INSERT INTO `tblmutasi` (`idMutasi`, `nis`, `idKelas`, `idTahunAjar`, `tglMutasi`) VALUES
	(1, '1112', 1, 1, '2016-05-17'),
	(3, '1114', 1, 1, '2016-05-20'),
	(4, '1115', 1, 1, '2016-05-20'),
	(5, '1116', 1, 1, '2016-05-20'),
	(6, '1117', 3, 1, '2016-05-25'),
	(7, '1118', 3, 1, '2016-05-25'),
	(9, '1120', 3, 1, '2016-05-25'),
	(10, '1121', 3, 1, '2016-05-25'),
	(11, '1122', 3, 1, '2016-05-25'),
	(12, '1123', 1, 1, '2016-05-20'),
	(13, '1124', 7, 1, '2016-06-08'),
	(14, '1125', 7, 1, '2016-06-08'),
	(15, '1126', 7, 1, '2016-06-08'),
	(16, '1127', 7, 1, '2016-06-08'),
	(17, '1128', 7, 1, '2016-06-08'),
	(18, '1129', 7, 1, '2016-06-08'),
	(19, '1130', 7, 1, '2016-06-08'),
	(20, '1119', 1, 1, '2016-06-08'),
	(21, '1131', 1, 1, '2016-06-10');
/*!40000 ALTER TABLE `tblmutasi` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblnilai
CREATE TABLE IF NOT EXISTS `tblnilai` (
  `idNilai` int(11) NOT NULL AUTO_INCREMENT,
  `idMutasi` int(11) DEFAULT NULL,
  `idKurikulum` int(11) DEFAULT NULL,
  `tugas` double DEFAULT NULL,
  `uts` double DEFAULT NULL,
  `uas` double DEFAULT NULL,
  PRIMARY KEY (`idNilai`),
  KEY `idMutasi` (`idMutasi`),
  KEY `idKurikulum` (`idKurikulum`),
  CONSTRAINT `FK_tblnilai_tblkurikulum` FOREIGN KEY (`idKurikulum`) REFERENCES `tblkurikulum` (`idKurikulum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblnilai_tblmutasi` FOREIGN KEY (`idMutasi`) REFERENCES `tblmutasi` (`idMutasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblnilai: ~85 rows (approximately)
/*!40000 ALTER TABLE `tblnilai` DISABLE KEYS */;
INSERT INTO `tblnilai` (`idNilai`, `idMutasi`, `idKurikulum`, `tugas`, `uts`, `uas`) VALUES
	(148, 6, 8, 67, 78, 89),
	(149, 6, 9, 78, 67, 78),
	(150, 6, 10, 67, 78, 67),
	(151, 6, 11, 34, 67, 78),
	(152, 6, 12, 67, 78, 67),
	(153, 1, 49, 90, 89, 78),
	(154, 1, 50, 67, 87, 67),
	(155, 1, 51, 78, 89, 78),
	(156, 1, 52, 89, 78, 98),
	(157, 1, 53, 78, 67, 78),
	(159, 1, 54, 67, 78, 56),
	(160, 3, 49, 89, 78, 89),
	(161, 3, 50, 78, 89, 78),
	(162, 3, 51, 89, 78, 89),
	(163, 3, 52, 78, 89, 56),
	(164, 3, 53, 45, 56, 78),
	(166, 3, 54, 78, 89, 89),
	(167, 4, 49, 23, 34, 23),
	(168, 4, 50, 34, 45, 34),
	(169, 4, 51, 23, 34, 45),
	(170, 4, 52, 34, 45, 34),
	(171, 4, 53, 23, 34, 45),
	(173, 4, 54, 45, 54, 54),
	(174, 5, 49, 45, 67, 67),
	(175, 5, 50, 56, 67, 78),
	(176, 5, 51, 67, 78, 67),
	(177, 5, 52, 87, 56, 67),
	(178, 5, 53, 56, 67, 56),
	(180, 5, 54, 78, 67, 89),
	(181, 10, 8, 45, 56, 45),
	(182, 10, 9, 11, 45, 34),
	(183, 10, 10, 56, 43, 48),
	(184, 10, 11, 65, 47, 39),
	(185, 10, 12, 65, 78, 63),
	(186, 18, 43, 89, 78, 67),
	(187, 18, 44, 56, 77, 78),
	(188, 18, 45, 67, 78, 67),
	(189, 18, 46, 78, 67, 78),
	(190, 18, 47, 67, 78, 67),
	(191, 18, 48, 89, 90, 98),
	(192, 13, 43, 90, 90, 90),
	(193, 13, 44, 90, 90, 90),
	(194, 13, 45, 90, 90, 90),
	(195, 13, 46, 90, 90, 90),
	(196, 13, 47, 90, 90, 90),
	(197, 13, 48, 90, 90, 90),
	(198, 7, 8, 78, 89, 67),
	(199, 7, 9, 89, 78, 67),
	(200, 7, 10, 78, 89, 87),
	(201, 7, 11, 67, 89, 67),
	(202, 7, 12, 91, 78, 78),
	(203, 12, 49, 56, 45, 67),
	(204, 12, 50, 56, 67, 56),
	(205, 12, 51, 78, 56, 78),
	(206, 12, 52, 56, 85, 92),
	(207, 12, 53, 32, 73, 56),
	(209, 12, 54, 20, 15, 10),
	(210, 20, 49, 89, 78, 78),
	(211, 20, 50, 67, 87, 67),
	(212, 20, 51, 56, 67, 78),
	(213, 20, 52, 56, 67, 56),
	(214, 20, 53, 78, 89, 67),
	(216, 20, 54, 20, 16, 17),
	(217, 9, 8, 90, 89, 67),
	(218, 11, 8, 78, 89, 90),
	(219, 9, 9, 89, 90, 89),
	(220, 11, 9, 90, 89, 78),
	(221, 9, 10, 89, 78, 78),
	(222, 11, 10, 45, 32, 78),
	(223, 9, 11, 89, 78, 98),
	(224, 11, 11, 89, 78, 89),
	(225, 9, 12, 89, 90, 89),
	(226, 11, 12, 78, 89, 89),
	(227, 14, 43, 34, 45, 34),
	(228, 14, 44, 45, 34, 45),
	(229, 14, 45, 34, 45, 27),
	(230, 14, 46, 82, 72, 26),
	(231, 14, 47, 27, 26, 72),
	(232, 14, 48, 12, 45, 17),
	(233, 21, 49, 100, 100, 100),
	(234, 21, 50, 100, 100, 100),
	(235, 21, 51, 100, 100, 100),
	(236, 21, 52, 100, 100, 100),
	(237, 21, 53, 100, 100, 100),
	(239, 21, 54, 100, 100, 100);
/*!40000 ALTER TABLE `tblnilai` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblsiswa
CREATE TABLE IF NOT EXISTS `tblsiswa` (
  `nis` varchar(10) NOT NULL,
  `NISN` varchar(10) DEFAULT NULL,
  `NamaSiswa` varchar(50) DEFAULT NULL,
  `JenisKelamin` char(1) NOT NULL,
  `Agama` varchar(15) NOT NULL,
  `TglLahir` date NOT NULL,
  `TempatLahir` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `NamaAyah` varchar(50) DEFAULT NULL,
  `PendidikanAyah` varchar(50) DEFAULT NULL,
  `PenghasilanAyah` float DEFAULT '0',
  `AlamatRumahAyah` text,
  `NomorHpAyah` varchar(15) DEFAULT NULL,
  `NamaIbu` varchar(50) DEFAULT NULL,
  `PendidikanIbu` varchar(50) DEFAULT NULL,
  `PenghasilanIbu` float DEFAULT '0',
  `AlamatRumahIbu` text,
  `NomorHpIbu` varchar(15) DEFAULT NULL,
  `foto` varchar(20) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblsiswa: ~19 rows (approximately)
/*!40000 ALTER TABLE `tblsiswa` DISABLE KEYS */;
INSERT INTO `tblsiswa` (`nis`, `NISN`, `NamaSiswa`, `JenisKelamin`, `Agama`, `TglLahir`, `TempatLahir`, `Alamat`, `NamaAyah`, `PendidikanAyah`, `PenghasilanAyah`, `AlamatRumahAyah`, `NomorHpAyah`, `NamaIbu`, `PendidikanIbu`, `PenghasilanIbu`, `AlamatRumahIbu`, `NomorHpIbu`, `foto`) VALUES
	('1112', '123123123', 'Achmad Rifai', 'L', 'Islam', '1996-07-24', 'Sidoarjo', 'Jalan Raya Baru no 12', 'Joko Rifai', 'S1', 3000000, 'Jalan Raya Baru no 12', '088988988988', 'Sumiyati', 'SMA', 1000000, 'Jalan Raya Baru no 12', '088889887871', ''),
	('1114', '1287987912', 'Budi Junaedi', 'L', 'Islam', '1998-11-18', 'Surabaya', 'Jalan Jend Sudirman no 11', 'Jarwo', 'SD', 90000000, 'Jalan raya', '0789123123131', 'Siti Sumiati', 'S3', 0, 'Jalan raya', '081119878725', ''),
	('1115', '1284567912', 'Candra Birawan Kertanegara', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 12', 'Budi', 'S3', 2000000, 'Jalan Jalan Jalan', '088887876756', 'Ayu', 'SMA', 1000000, 'Jalan Jalan Jalan', '081119878725', ''),
	('1116', '1289874267', 'Danang Khusuma Dewangga', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1117', '1988912391', 'Eko Rachmad', 'L', 'Kristen', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1118', '1312312891', 'Fanny Anantasya', 'P', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1119', '1230989129', 'Alban Ismail', 'L', 'Islam', '1990-03-12', 'Surabaya', 'Jalan Jend Sudirman no 16', 'Ismail', 'S2', 5000000, 'Jalan Jend Sudirman no 12', '099989878767', 'Siti', 'S1', 0, 'Jalan Jend Sudirman no 12', '081234443290', ''),
	('1120', '1453234123', 'Hanny Larasati', 'P', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1121', '1412387991', 'Indah Purnama Hannafi', 'P', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1122', '1673467141', 'Junifar Rizky Dharmawan', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1123', '1091023311', 'Kiki Rizky Zaelani', 'P', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1124', '1012389097', 'Lamani Luna Lintang Laraswara', 'P', 'Kristen', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1125', '1567657234', 'Meidito Sri Langkasapura', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1126', '1512319876', 'Nandra Birama', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1127', '1818726382', 'Opik Sendu Melani', 'P', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1128', '1809538712', 'Putranto Pradhana Perkasa', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1129', '1716292831', 'Rizky Setya Braseri', 'L', 'Islam', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1130', '1779871642', 'Seruni Mawardani Ciptani', 'P', 'Kristen', '1996-11-14', 'Surabaya', 'Jalan Jend Sudirman no 27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	('1131', '1723871111', 'I Dewa Agun Ayu Tri Laksmi', 'P', 'Hindu', '1996-01-08', 'Denpasar', 'Jalan Achmad Yani no 12', 'I Ketut Putra', 'S2', 10000000, 'Jalan Achmad Yani no 12', '088887876756', 'Nengah Dwi Angkara', 'S1', 3000000, 'Jalan Achmad Yani no 12', '081119878725', '');
/*!40000 ALTER TABLE `tblsiswa` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tbltahunajar
CREATE TABLE IF NOT EXISTS `tbltahunajar` (
  `idTahunAjar` int(11) NOT NULL AUTO_INCREMENT,
  `TahunAjar` varchar(50) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`idTahunAjar`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tbltahunajar: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbltahunajar` DISABLE KEYS */;
INSERT INTO `tbltahunajar` (`idTahunAjar`, `TahunAjar`, `status`) VALUES
	(1, '2015/2016 Ganjil', 1),
	(2, '2015/2016 Genap', 0);
/*!40000 ALTER TABLE `tbltahunajar` ENABLE KEYS */;

-- Dumping structure for table dbnilai.tblwalikelas
CREATE TABLE IF NOT EXISTS `tblwalikelas` (
  `idWaliKelas` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` char(18) DEFAULT NULL,
  `idKelas` int(11) DEFAULT NULL,
  `idTahunAjar` int(11) DEFAULT NULL,
  `tglMutasi` date DEFAULT NULL,
  PRIMARY KEY (`idWaliKelas`),
  KEY `NIP` (`NIP`),
  KEY `idKelas` (`idKelas`),
  KEY `idTahunAjar` (`idTahunAjar`),
  CONSTRAINT `FK_tblwalikelas_tblguru` FOREIGN KEY (`NIP`) REFERENCES `tblguru` (`NIP`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tblwalikelas_tblkelas` FOREIGN KEY (`idKelas`) REFERENCES `tblkelas` (`idKelas`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tblwalikelas_tbltahunajar` FOREIGN KEY (`idTahunAjar`) REFERENCES `tbltahunajar` (`idTahunAjar`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table dbnilai.tblwalikelas: ~2 rows (approximately)
/*!40000 ALTER TABLE `tblwalikelas` DISABLE KEYS */;
INSERT INTO `tblwalikelas` (`idWaliKelas`, `NIP`, `idKelas`, `idTahunAjar`, `tglMutasi`) VALUES
	(4, '201656789123211978', 3, 1, '2016-05-17'),
	(7, '123456789123212321', 1, 1, '2018-01-22');
/*!40000 ALTER TABLE `tblwalikelas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
