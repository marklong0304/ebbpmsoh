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

-- membuang struktur untuk table hrd.lvlemp
CREATE TABLE IF NOT EXISTS `lvlemp` (
  `iLvlEmp` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `vDescription` varchar(3) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  `lDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`iLvlEmp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='Employee staff level';

-- Membuang data untuk tabel hrd.lvlemp: ~7 rows (lebih kurang)
DELETE FROM `lvlemp`;
/*!40000 ALTER TABLE `lvlemp` DISABLE KEYS */;
INSERT INTO `lvlemp` (`iLvlEmp`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(1, 'L1', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(2, 'L2', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(3, 'L3', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(4, 'L4', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(5, 'L5', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(6, 'L6', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(7, 'L7', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0');
/*!40000 ALTER TABLE `lvlemp` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
