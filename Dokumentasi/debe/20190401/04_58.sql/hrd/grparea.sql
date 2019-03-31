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

-- membuang struktur untuk table hrd.grparea
CREATE TABLE IF NOT EXISTS `grparea` (
  `iGrpAreaID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id tabel GrpArea',
  `iAreaID` varchar(50) DEFAULT NULL COMMENT 'menyimpan iAreaID dari tabel area',
  `vDescription` varchar(50) DEFAULT NULL COMMENT 'nama group area',
  `tKeterangan` text,
  `cCreateBy` char(50) DEFAULT NULL COMMENT 'nama yang membuat data area',
  `dCreate` datetime DEFAULT NULL COMMENT 'tanggal membuat data area',
  `cUpdateBy` char(50) DEFAULT NULL COMMENT 'pic yang melakukan update data area',
  `dUpdate` datetime DEFAULT NULL COMMENT 'tanggal membuat data area',
  `lDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`iGrpAreaID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='menyimpan grouping Area dari posisi yang dibutuhkan';

-- Membuang data untuk tabel hrd.grparea: ~1 rows (lebih kurang)
DELETE FROM `grparea`;
/*!40000 ALTER TABLE `grparea` DISABLE KEYS */;
INSERT INTO `grparea` (`iGrpAreaID`, `iAreaID`, `vDescription`, `tKeterangan`, `cCreateBy`, `dCreate`, `cUpdateBy`, `dUpdate`, `lDeleted`) VALUES
	(1, '7,26,40,45,66,70', 'JAKARTA', 'HEAD OFFICE - KEBON JERUK - JAKARTA BARAT, Jakarta 1, 2, 3, 4 dan ULUJAMI - - JAKARTA SELATAN', NULL, NULL, 'N12831', '2014-10-01 16:11:06', 0);
/*!40000 ALTER TABLE `grparea` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
