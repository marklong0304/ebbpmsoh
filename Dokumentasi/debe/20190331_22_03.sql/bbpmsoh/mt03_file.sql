-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.37-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table bbpmsoh.mt03_file
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel bbpmsoh.mt03_file: ~0 rows (lebih kurang)
DELETE FROM `mt03_file`;
/*!40000 ALTER TABLE `mt03_file` DISABLE KEYS */;
INSERT INTO `mt03_file` (`ifile_mt03`, `iMt03`, `vFilename`, `vFilename_generate`, `vKeterangan`, `cCreate`, `dCreate`, `cUpdate`, `dUpdate`, `lDeleted`) VALUES
	(5, 2, 'a4.pdf', '0__2019_03_31__21_52_00__a4.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(6, 2, 'A4langsung.pdf', '1__2019_03_31__21_52_00__A4langsung.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(7, 2, 'Manual Book SiiPLAH untuk Admin ESELON 1.pdf', '0__2019_03_31__21_56_44__Manual Book SiiPLAH untuk Admin ESELON 1.pdf', 'ssss', 'A00001', '2019-03-31 21:56:44', NULL, NULL, 0);
/*!40000 ALTER TABLE `mt03_file` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
