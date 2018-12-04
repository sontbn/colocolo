-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table kaltara_muda.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `nourut` tinyint(2) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `is_parent` int(11) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL,
  `nmfile` varchar(255) DEFAULT NULL,
  `new_tab` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table kaltara_muda.menu: ~29 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `title`, `nourut`, `url`, `icon`, `parent_id`, `is_parent`, `aktif`, `nmfile`, `new_tab`) VALUES
	(1, 'Dashboard', 1, 'dashboard', 'mdi mdi-gauge', 0, 0, '1', 'dashboard.html', NULL),
	(2, 'P.A. I', 2, '#', 'mdi mdi-verified', 0, 1, '0', '', NULL),
	(3, 'Upload', 1, 'pa1/upload', NULL, 2, 0, '0', 'pa1-upload.html', NULL),
	(4, 'Monitoring', 2, 'pa1/monitoring', NULL, 2, 0, '0', 'pa1-monitoring.html', NULL),
	(5, 'Cetak', 3, 'pa1/cetak', NULL, 2, 0, '0', 'pa1-cetak.html', NULL),
	(6, 'A.P.K.', 4, '#', 'mdi mdi-verified', 0, 1, '0', NULL, NULL),
	(7, 'Upload', 1, 'apk/upload', NULL, 6, 0, '0', 'apk-upload.html', NULL),
	(8, 'Monitoring', 2, 'apk/monitoring', NULL, 6, 0, '0', 'apk-monitoring.html', NULL),
	(9, 'Cetak', 3, 'apk/cetak', NULL, 6, 0, '0', 'apk-cetak.html', NULL),
	(10, 'Umum', 5, '#', 'mdi mdi-verified', 0, 1, '0', NULL, NULL),
	(11, 'Upload', 1, 'umum/upload', NULL, 10, 0, '0', 'umum-upload.html', NULL),
	(12, 'Monitoring', 2, 'umum/monitoring', NULL, 10, 0, '0', 'umum-monitoring.html', NULL),
	(13, 'Cetak', 3, 'umum/cetak', NULL, 10, 0, '0', 'umum-cetak.html', NULL),
	(14, 'S.K.K.I', 6, '#', 'mdi mdi-verified', 0, 1, '0', NULL, NULL),
	(15, 'Upload', 1, 'skki/upload', NULL, 14, 0, '0', 'skki-upload.html', NULL),
	(16, 'Monitoring', 2, 'skki/monitoring', NULL, 14, 0, '0', 'skki-monitoring.html', NULL),
	(17, 'Cetak', 3, 'skki/cetak', NULL, 14, 0, '0', 'skki-cetak.html', NULL),
	(18, 'P.A. II', 3, '#', 'mdi mdi-verified', 0, 1, '0', NULL, NULL),
	(19, 'Upload', 1, 'pa2/upload', NULL, 18, 0, '0', 'pa2-upload.html', NULL),
	(20, 'Monitoring', 2, 'pa2/monitoring', NULL, 18, 0, '0', 'pa2-monitoring.html', NULL),
	(21, 'PPA 1', 1, 'upload/pa1', '', 28, 0, '1', 'pa1-upload.html', NULL),
	(22, 'PPA 2', 2, 'upload/pa2', '', 28, 0, '1', 'pa2-upload.html', NULL),
	(23, 'PAPK', 3, 'upload/apk', '', 28, 0, '1', 'apk-upload.html', NULL),
	(24, 'Umum', 4, 'upload/umum', '', 28, 0, '1', 'umum-upload.html', NULL),
	(25, 'SKKI', 5, 'upload/skki', '', 28, 0, '1', 'skki-upload.html', NULL),
	(26, 'Referensi', 7, '#', 'mdi mdi-apps', 0, 1, '1', NULL, NULL),
	(27, 'Jenis Dok', 1, 'ref/jenis-dok', NULL, 26, 0, '1', 'ref-jenisdok.html', NULL),
	(28, 'Upload Dok', 2, '#', 'mdi mdi-verified', 0, 1, '1', NULL, NULL),
	(29, 'User', 2, 'ref/user', NULL, 26, 0, '1', 'ref-user.html', NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table kaltara_muda.menu_level
CREATE TABLE IF NOT EXISTS `menu_level` (
  `menu_id` int(10) unsigned NOT NULL,
  `kdlevel` varchar(2) NOT NULL,
  KEY `FK_menu_level_level` (`kdlevel`),
  KEY `FK_menu_level_menu` (`menu_id`),
  CONSTRAINT `FK_menu_level_level` FOREIGN KEY (`kdlevel`) REFERENCES `level` (`kdlevel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_level_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kaltara_muda.menu_level: ~36 rows (approximately)
DELETE FROM `menu_level`;
/*!40000 ALTER TABLE `menu_level` DISABLE KEYS */;
INSERT INTO `menu_level` (`menu_id`, `kdlevel`) VALUES
	(1, '00'),
	(1, '99'),
	(2, '00'),
	(3, '00'),
	(4, '00'),
	(5, '00'),
	(6, '00'),
	(7, '00'),
	(8, '00'),
	(9, '00'),
	(10, '00'),
	(11, '00'),
	(12, '00'),
	(13, '00'),
	(14, '00'),
	(15, '00'),
	(16, '00'),
	(17, '00'),
	(18, '00'),
	(19, '00'),
	(20, '00'),
	(21, '00'),
	(22, '00'),
	(23, '00'),
	(24, '00'),
	(25, '00'),
	(26, '00'),
	(27, '00'),
	(28, '01'),
	(29, '00'),
	(1, '01'),
	(21, '01'),
	(22, '01'),
	(23, '01'),
	(24, '01'),
	(25, '01');
/*!40000 ALTER TABLE `menu_level` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
