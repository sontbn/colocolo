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

-- Dumping structure for table kaltara_muda.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '0',
  `foto` varchar(255) DEFAULT '0',
  `kdlevel` varchar(2) DEFAULT NULL,
  `satker_id` int(11) NOT NULL,
  `kdunit_kanwil` varchar(2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `aktif` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_user_level` (`kdlevel`),
  KEY `FK_user_satker` (`satker_id`),
  CONSTRAINT `FK_user_level` FOREIGN KEY (`kdlevel`) REFERENCES `level` (`kdlevel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_satker` FOREIGN KEY (`satker_id`) REFERENCES `satker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kaltara_muda.user: ~3 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nama`, `foto`, `kdlevel`, `satker_id`, `kdunit_kanwil`, `email`, `aktif`) VALUES
	(1, 'admin', '741406c6940752b8ccf1834696338373', 'Admin', '', '00', 1, NULL, NULL, '1'),
	(2, 'operator', '741406c6940752b8ccf1834696338373', 'Operator', '', '01', 4, NULL, NULL, '1'),
	(4, 'opr2', '741406c6940752b8ccf1834696338373', 'Test Lagi', '0', '01', 1, NULL, 'Halo', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
