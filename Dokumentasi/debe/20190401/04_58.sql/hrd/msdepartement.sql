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

-- membuang struktur untuk table hrd.msdepartement
CREATE TABLE IF NOT EXISTS `msdepartement` (
  `iDeptID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID table departemen',
  `iDivID` int(2) unsigned NOT NULL COMMENT 'this ID',
  `vDescription` varchar(100) DEFAULT NULL COMMENT 'Keterangan',
  `tCreated` datetime DEFAULT NULL COMMENT 'created at',
  `cCreatedBy` char(8) DEFAULT NULL COMMENT 'created by',
  `tUpdated` datetime DEFAULT NULL COMMENT 'updated at',
  `cUpdatedBy` char(8) DEFAULT NULL COMMENT 'updated by',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  PRIMARY KEY (`iDeptID`),
  KEY `FK_div_dept` (`iDivID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master data divisi';

-- Membuang data untuk tabel hrd.msdepartement: ~9 rows (lebih kurang)
DELETE FROM `msdepartement`;
/*!40000 ALTER TABLE `msdepartement` DISABLE KEYS */;
INSERT INTO `msdepartement` (`iDeptID`, `iDivID`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(17, 6, 'Software Development', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(18, 7, 'Customer', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(19, 7, 'Administration Mutu', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(20, 9, 'VIROLOGI', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(21, 9, 'FARMASTETIK & PREMIKS', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(22, 9, 'BIOLOGIK', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(23, 12, 'Administration SPHU', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(24, 13, 'Administrasi TU', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(25, 14, 'Administrasi Keuangan', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0);
/*!40000 ALTER TABLE `msdepartement` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
