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

-- membuang struktur untuk table hrd.lvlmanagerial
CREATE TABLE IF NOT EXISTS `lvlmanagerial` (
  `iLvlID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vLvlName` varchar(30) NOT NULL COMMENT 'Nama untuk level managerial',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdateAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Last Updated At',
  `cUpdateBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iLvlID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='untuk menyimpan data master level managerial';

-- Membuang data untuk tabel hrd.lvlmanagerial: ~5 rows (lebih kurang)
DELETE FROM `lvlmanagerial`;
/*!40000 ALTER TABLE `lvlmanagerial` DISABLE KEYS */;
INSERT INTO `lvlmanagerial` (`iLvlID`, `vLvlName`, `tCreatedAt`, `cCreatedBy`, `tUpdateAt`, `cUpdateBy`, `lDeleted`) VALUES
	(1, 'PELAKSANA', '2013-01-03 13:06:32', 'N06081', '2013-01-03 13:06:32', '', 0),
	(2, 'STAFF', '2013-01-03 13:06:45', 'N06081', '2013-01-03 13:06:45', '', 0),
	(3, 'SUPERVISOR', '2013-01-03 13:06:53', 'N06081', '2013-01-03 13:06:53', '', 0),
	(4, 'MANAGERIAL', '2013-01-03 13:06:59', 'N06081', '2013-01-03 13:06:59', '', 0),
	(5, 'EXECUTIVE', '2013-01-03 13:11:59', 'N06081', '2013-01-03 13:11:59', '', 0);
/*!40000 ALTER TABLE `lvlmanagerial` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
