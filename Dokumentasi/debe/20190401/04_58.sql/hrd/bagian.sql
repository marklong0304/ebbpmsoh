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

-- membuang struktur untuk table hrd.bagian
CREATE TABLE IF NOT EXISTS `bagian` (
  `ibagid` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `iDeptId` int(2) unsigned NOT NULL COMMENT 'ID table Departemen (TIDAK DIGUNAKAN - diambil dari division.id)',
  `iDivId` int(2) unsigned NOT NULL COMMENT 'ID tbl ''division'' (TIDAK DIGUNAKAN - diambil dari departement.id)',
  `iDivisionId` int(2) unsigned NOT NULL COMMENT 'Kode Divisi (msdivision.id)',
  `iDepartementId` int(2) unsigned NOT NULL COMMENT 'Kode Departemen (msdepartment.id)',
  `vDescription` varchar(40) NOT NULL COMMENT 'keterangan',
  `tCreated` datetime DEFAULT NULL COMMENT 'dibuat tgl',
  `cCreatedBy` char(7) DEFAULT '' COMMENT 'dibuat oleh',
  `tUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'diupdate tgl',
  `cUpdatedBy` char(7) DEFAULT '' COMMENT 'diupdate oleh',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  PRIMARY KEY (`ibagid`),
  KEY `FK_BAG_DEPT` (`iDeptId`),
  KEY `iDivId` (`iDivId`),
  KEY `iDivisionId` (`iDivisionId`),
  KEY `iDepartemenId` (`iDepartementId`)
) ENGINE=InnoDB AUTO_INCREMENT=2171 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master Bagian';

-- Membuang data untuk tabel hrd.bagian: ~1 rows (lebih kurang)
DELETE FROM `bagian`;
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;
INSERT INTO `bagian` (`ibagid`, `iDeptId`, `iDivId`, `iDivisionId`, `iDepartementId`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(2170, 0, 0, 6, 17, 'SYSTEM DEVELOPMENT', '2016-12-20 14:22:18', 'N10893', '2016-12-20 14:22:18', 'N10893', 0);
/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
