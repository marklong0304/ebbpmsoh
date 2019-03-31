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

-- membuang struktur untuk table hrd.grpposition
CREATE TABLE IF NOT EXISTS `grpposition` (
  `iGrpPostID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id tabel GrpArea',
  `vDescription` varchar(50) DEFAULT NULL COMMENT 'nama group area',
  `tKeterangan` text,
  `cCreateBy` char(50) DEFAULT NULL COMMENT 'nama pic  yang membuat data group posisi',
  `dCreate` datetime DEFAULT NULL COMMENT 'tgl membuat data group posisi',
  `cUpdateBy` char(50) DEFAULT NULL COMMENT 'pic yang mellakukan update data area',
  `dUpdate` datetime DEFAULT NULL COMMENT 'tanggal update',
  `lDeleted` int(11) DEFAULT '0' COMMENT 'penanda hapus data 1=hapus',
  PRIMARY KEY (`iGrpPostID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='menyimpan grouping Area dari posisi yang dibutuhkan';

-- Membuang data untuk tabel hrd.grpposition: ~3 rows (lebih kurang)
DELETE FROM `grpposition`;
/*!40000 ALTER TABLE `grpposition` DISABLE KEYS */;
INSERT INTO `grpposition` (`iGrpPostID`, `vDescription`, `tKeterangan`, `cCreateBy`, `dCreate`, `cUpdateBy`, `dUpdate`, `lDeleted`) VALUES
	(1, 'Supporting', 'Supporting', NULL, NULL, 'n12812', '2014-04-07 13:29:17', 0),
	(2, 'Marketing', 'Marketing', 'n12812', '2014-04-07 00:00:00', 'n12812', '2014-08-07 17:40:58', 0),
	(3, 'Manufacture', 'Manufacture', 'n12812', '0000-00-00 00:00:00', 'n12812', '2014-04-07 13:29:05', 0);
/*!40000 ALTER TABLE `grpposition` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
