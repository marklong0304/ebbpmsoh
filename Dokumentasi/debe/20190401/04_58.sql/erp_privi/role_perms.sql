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

-- membuang struktur untuk table erp_privi.role_perms
CREATE TABLE IF NOT EXISTS `role_perms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel erp_privi.role_perms: 18 rows
DELETE FROM `role_perms`;
/*!40000 ALTER TABLE `role_perms` DISABLE KEYS */;
INSERT INTO `role_perms` (`ID`, `roleID`, `permID`, `value`, `addDate`) VALUES
	(15, 1, 1, 14, '2012-09-18 09:15:54'),
	(16, 1, 5, 14, '2012-09-18 09:15:54'),
	(17, 1, 2, 14, '2012-09-18 09:21:41'),
	(18, 1, 3, 15, '2012-09-18 09:21:46'),
	(19, 1, 4, 14, '2012-09-18 09:21:51'),
	(30, 1, 18, 15, '2013-02-01 19:00:48'),
	(29, 1, 17, 15, '2013-02-01 18:36:53'),
	(28, 1, 16, 15, '2013-02-01 16:40:09'),
	(27, 1, 15, 15, '2013-02-01 14:46:00'),
	(26, 1, 14, 15, '2013-01-28 16:17:40'),
	(31, 1, 19, 15, '2013-02-04 13:51:57'),
	(32, 1, 20, 15, '2013-02-04 14:04:35'),
	(33, 1, 22, 15, '2013-02-05 10:06:38'),
	(34, 1, 23, 15, '2013-02-06 11:49:43'),
	(35, 1, 24, 15, '2013-02-06 13:40:36'),
	(36, 1, 25, 15, '2013-02-06 18:50:51'),
	(37, 1, 26, 15, '2013-02-14 13:49:01'),
	(38, 1, 27, 15, '2013-02-14 13:49:08');
/*!40000 ALTER TABLE `role_perms` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
