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

-- membuang struktur untuk table hrd.area
CREATE TABLE IF NOT EXISTS `area` (
  `iAreaID` int(3) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vAreaName` varchar(20) DEFAULT NULL COMMENT 'Nama Area',
  `vNickName` varchar(10) DEFAULT NULL COMMENT 'Singkatan nama area',
  `tCreated` datetime NOT NULL COMMENT 'dibuat pada tgl',
  `cAreaCode` char(2) NOT NULL COMMENT 'Kode Area di Foxpro',
  `vAlamat` varchar(255) DEFAULT NULL COMMENT 'nama alamat',
  `cRt` char(4) DEFAULT NULL COMMENT 'RT',
  `cRw` char(4) DEFAULT NULL COMMENT 'RW',
  `vKelurahan` varchar(50) DEFAULT NULL COMMENT 'nama kelurahan',
  `vKecamatan` varchar(50) DEFAULT NULL COMMENT 'nama kecamatan',
  `vKota` varchar(20) DEFAULT NULL COMMENT 'nama kota',
  `iKdPropinsi` int(11) DEFAULT NULL,
  `cKodePos` char(7) DEFAULT NULL,
  `cTelp` char(30) DEFAULT NULL,
  `cFax` char(30) DEFAULT NULL,
  `cNpwp` char(30) DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT '',
  `tUpdated` datetime NOT NULL,
  `cUpdatedBy` char(7) DEFAULT '',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iAreaID`),
  UNIQUE KEY `vAreaName` (`vAreaName`),
  KEY `cAreaCode` (`cAreaCode`,`lDeleted`),
  KEY `lDeleted` (`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master Area';

-- Membuang data untuk tabel hrd.area: ~1 rows (lebih kurang)
DELETE FROM `area`;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` (`iAreaID`, `vAreaName`, `vNickName`, `tCreated`, `cAreaCode`, `vAlamat`, `cRt`, `cRw`, `vKelurahan`, `vKecamatan`, `vKota`, `iKdPropinsi`, `cKodePos`, `cTelp`, `cFax`, `cNpwp`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(45, 'HEAD OFFICE', 'HO', '0000-00-00 00:00:00', 'HO', 'JL. POS PANGUMBEN RAYA NO.8                       \n                                                  ', '', '', 'SUKABUMI SELATN', 'KEBON JERUK    ', 'JAKARTA BARAT       ', 8, '11560', '(021 ) 5355888', '53668600', '01.002.680.5.052.000', NULL, '2010-07-29 00:00:00', '', 0);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
