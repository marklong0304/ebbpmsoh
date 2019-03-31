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

-- membuang struktur untuk table bbpmsoh.sysparam
CREATE TABLE IF NOT EXISTS `sysparam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vVariable` varchar(50) DEFAULT NULL,
  `vContent` varchar(50) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel bbpmsoh.sysparam: ~3 rows (lebih kurang)
DELETE FROM `sysparam`;
/*!40000 ALTER TABLE `sysparam` DISABLE KEYS */;
INSERT INTO `sysparam` (`id`, `vVariable`, `vContent`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'MT01_PENANGGUNG_JAWAB', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:32', 0),
	(2, 'MT02_MANAGER_PUNCAK', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:38', 0),
	(3, 'MT03_TTD', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:07', 0);
/*!40000 ALTER TABLE `sysparam` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
