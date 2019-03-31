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

-- membuang struktur untuk table bbpmsoh.mt04_detail
CREATE TABLE IF NOT EXISTS `mt04_detail` (
  `iMt04_detail` int(11) NOT NULL AUTO_INCREMENT,
  `iMt04` int(11) DEFAULT NULL,
  `vAntiserum` varchar(50) DEFAULT NULL,
  `vKadar` varchar(50) DEFAULT NULL,
  `vAsal` varchar(50) DEFAULT NULL,
  `vBatch` varchar(50) DEFAULT NULL,
  `dTgl_expired` date DEFAULT NULL,
  `vJumlah` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(50) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt04_detail`),
  KEY `iMt05` (`iMt04`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='\r\n';

-- Membuang data untuk tabel bbpmsoh.mt04_detail: ~0 rows (lebih kurang)
DELETE FROM `mt04_detail`;
/*!40000 ALTER TABLE `mt04_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt04_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
