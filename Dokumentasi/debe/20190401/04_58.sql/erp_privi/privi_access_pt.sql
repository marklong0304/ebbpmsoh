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

-- membuang struktur untuk table erp_privi.privi_access_pt
CREATE TABLE IF NOT EXISTS `privi_access_pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cNip` char(7) NOT NULL DEFAULT '0',
  `iPt` tinyint(1) NOT NULL DEFAULT '0',
  `tTime` timestamp NULL DEFAULT NULL,
  `t*as` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel erp_privi.privi_access_pt: ~3 rows (lebih kurang)
DELETE FROM `privi_access_pt`;
/*!40000 ALTER TABLE `privi_access_pt` DISABLE KEYS */;
INSERT INTO `privi_access_pt` (`id`, `cNip`, `iPt`, `tTime`, `t*as`) VALUES
	(1, 'N06081', 3, '0000-00-00 00:00:00', NULL),
	(2, 'N06081', 1, '0000-00-00 00:00:00', NULL),
	(3, 'N0601', 5, NULL, NULL);
/*!40000 ALTER TABLE `privi_access_pt` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
