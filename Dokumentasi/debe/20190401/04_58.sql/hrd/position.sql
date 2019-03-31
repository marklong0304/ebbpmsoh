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

-- membuang struktur untuk table hrd.position
CREATE TABLE IF NOT EXISTS `position` (
  `iPostId` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Position ID',
  `vDescription` varchar(100) DEFAULT '' COMMENT 'Position Name (title)',
  `lDeleted` tinyint(1) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`iPostId`),
  KEY `iPostId` (`iPostId`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master for position';

-- Membuang data untuk tabel hrd.position: ~9 rows (lebih kurang)
DELETE FROM `position`;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` (`iPostId`, `vDescription`, `lDeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(358, 'MIS PROGRAMMER SUPERVISOR', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(359, 'CUSTOMER', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(360, 'STAFF MUTU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(361, 'MANAGER MUTU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(362, 'MANAGER SPHU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(363, 'MANAGER UJI', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(364, 'STAFF SPHU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(365, 'STAFF TU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(366, 'STAFF KEUANGAN', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
