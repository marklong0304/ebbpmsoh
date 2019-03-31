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

-- membuang struktur untuk table erp_privi.erp_notif
CREATE TABLE IF NOT EXISTS `erp_notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vName` varchar(255) NOT NULL DEFAULT '0',
  `vAcl` varchar(255) NOT NULL DEFAULT '0',
  `idErpModul` varchar(255) NOT NULL DEFAULT '0',
  `vMainPic` varchar(255) NOT NULL DEFAULT '0',
  `vDesc` varchar(255) NOT NULL DEFAULT '0',
  `isLocalCalc` tinyint(4) NOT NULL DEFAULT '1',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tCreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel erp_privi.erp_notif: ~1 rows (lebih kurang)
DELETE FROM `erp_notif`;
/*!40000 ALTER TABLE `erp_notif` DISABLE KEYS */;
INSERT INTO `erp_notif` (`id`, `vName`, `vAcl`, `idErpModul`, `vMainPic`, `vDesc`, `isLocalCalc`, `tUpdateAt`, `tCreatedAt`) VALUES
	(1, 'DB-NPL-SPACE', '10.1.49.6, 10.1.48.105', '4034', 'N09486', 'alert monitor space MySQL NPL', 1, '2018-06-29 10:36:12', '2018-06-29 08:57:12');
/*!40000 ALTER TABLE `erp_notif` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
