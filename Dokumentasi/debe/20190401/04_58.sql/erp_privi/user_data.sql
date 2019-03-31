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

-- membuang struktur untuk table erp_privi.user_data
CREATE TABLE IF NOT EXISTS `user_data` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `vNip` varchar(7) NOT NULL,
  `vPassword` varchar(32) NOT NULL,
  `vName` varchar(200) NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nip` (`vNip`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel erp_privi.user_data: 2 rows
DELETE FROM `user_data`;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` (`ID`, `vNip`, `vPassword`, `vName`, `user_create`, `create_date`, `user_update`, `update_date`, `deleted`, `status`, `last_login`) VALUES
	(1, 'N09559', '30cd2f99101cdd52cc5fda1e996ee137', 'Angga Saputra', 1, '2012-09-16 18:29:05', 3, '2012-09-18 15:08:32', 0, 1, '2013-02-25 11:08:09'),
	(2, 'N09817', '30cd2f99101cdd52cc5fda1e996ee137', 'Husnul A', 1, '2013-01-28 21:21:42', NULL, NULL, 0, NULL, '2013-01-29 14:03:58');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
