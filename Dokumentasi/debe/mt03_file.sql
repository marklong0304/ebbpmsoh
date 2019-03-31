-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table bbpmsoh.mt03_file
CREATE TABLE IF NOT EXISTS `mt03_file` (
  `ifile_mt03` int(11) NOT NULL AUTO_INCREMENT,
  `iMt03` int(11) DEFAULT NULL,
  `vFilename` varchar(255) DEFAULT NULL,
  `vFilename_generate` varchar(255) DEFAULT NULL,
  `vKeterangan` text,
  `cCreate` char(50) DEFAULT NULL,
  `dCreate` datetime DEFAULT NULL,
  `cUpdate` char(50) DEFAULT NULL,
  `dUpdate` datetime DEFAULT NULL,
  `lDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`ifile_mt03`),
  KEY `lDeleted` (`lDeleted`),
  KEY `iMt03` (`iMt03`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
