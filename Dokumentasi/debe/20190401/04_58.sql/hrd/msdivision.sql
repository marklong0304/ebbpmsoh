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

-- membuang struktur untuk table hrd.msdivision
CREATE TABLE IF NOT EXISTS `msdivision` (
  `iDivID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'this department ID',
  `vDescription` varchar(100) DEFAULT NULL COMMENT 'nama department',
  `vAbbreviation` varchar(30) DEFAULT NULL COMMENT 'singkatan untuk department tsb',
  `tCreated` datetime DEFAULT NULL COMMENT 'dibuat tgl',
  `cCreatedBy` char(7) DEFAULT NULL COMMENT 'dibuat oleh  - relasi ke tabel employee',
  `tUpdated` datetime DEFAULT NULL COMMENT 'update terakhir tgl',
  `cUpdatedBy` char(7) DEFAULT NULL COMMENT 'update terakhir oleh  - relasi ke tabel employee',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iDivID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='master daftar department ';

-- Membuang data untuk tabel hrd.msdivision: ~7 rows (lebih kurang)
DELETE FROM `msdivision`;
/*!40000 ALTER TABLE `msdivision` DISABLE KEYS */;
INSERT INTO `msdivision` (`iDivID`, `vDescription`, `vAbbreviation`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(6, 'Information Technology', 'IT', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:41', 'N14615', 0),
	(7, 'Customer', 'CST', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(8, 'Bidang Mutu', 'MT', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(9, 'Bidang Pelayanan Pengujian', 'PP', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(12, 'Bidang Pelayanan Sertifikasi dan Pengamanan Hasil Uji', 'SPHU', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(13, 'Tata Usaha', 'TU', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(14, 'Keuangan', 'FA', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0);
/*!40000 ALTER TABLE `msdivision` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
