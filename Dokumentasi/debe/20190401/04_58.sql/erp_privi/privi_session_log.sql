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

-- membuang struktur untuk table erp_privi.privi_session_log
CREATE TABLE IF NOT EXISTS `privi_session_log` (
  `idprivi_session_hist` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `cNip` char(7) NOT NULL DEFAULT '0' COMMENT 'NIP username',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'ID table hrd.company/ daftar perusahaan',
  `vSessionID` varchar(255) NOT NULL DEFAULT '0' COMMENT 'session ID',
  `dLoginAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Login At Time',
  `dLogoutAt` datetime DEFAULT NULL COMMENT 'Logout At Time',
  `vIPSource` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Source IP address',
  `tUpdatedAt` timestamp NULL DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`idprivi_session_hist`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Contain with session historical after login succeed ';

-- Membuang data untuk tabel erp_privi.privi_session_log: 14 rows
DELETE FROM `privi_session_log`;
/*!40000 ALTER TABLE `privi_session_log` DISABLE KEYS */;
INSERT INTO `privi_session_log` (`idprivi_session_hist`, `cNip`, `iCompanyId`, `vSessionID`, `dLoginAt`, `dLogoutAt`, `vIPSource`, `tUpdatedAt`, `cUpdatedBy`) VALUES
	(217, 'N14615', 3, 'gikb82du4gknamrfoc7955ifn1', '2019-03-31 22:46:38', '0000-00-00 00:00:00', '::1', NULL, NULL),
	(218, 'N14616', 3, 'popjijkdeg2mmdn6thghob2qo2', '2019-01-26 13:40:33', '2019-01-26 13:40:33', '127.0.0.1', NULL, NULL),
	(219, 'A00001', 3, 'olrv4tg6ahen7j0pnbcknsv444', '2019-04-01 03:25:38', '2019-04-01 03:25:38', '127.0.0.1', NULL, NULL),
	(220, 'C00001', 3, '1fndh8pa61hdqg427lfm7vei95', '2019-02-03 22:10:22', '2019-02-03 22:10:22', '127.0.0.1', NULL, NULL),
	(221, 'A00002', 3, '18ul6iumaocvs6katgmg31srf1', '2019-01-27 01:43:45', '2019-01-27 01:43:45', '192.168.43.142', NULL, NULL),
	(222, 'A00003', 3, '6fjme1hd4v6p655qvp31v5oqu0', '2019-01-27 01:44:39', '2019-01-27 01:44:39', '192.168.43.142', NULL, NULL),
	(223, 'A00004', 3, 'rkb8shqs21lh6r534q2icen680', '2019-04-01 00:07:55', '2019-04-01 00:07:55', '127.0.0.1', NULL, NULL),
	(224, 'A00005', 3, 'f0qbiaol0k6de3smf043b30v15', '2019-04-01 02:00:58', '2019-04-01 02:00:58', '127.0.0.1', NULL, NULL),
	(225, 'A00006', 3, '8965piljrsvormk4ga31u3pnd7', '2019-02-03 21:26:42', '2019-02-03 21:26:42', '127.0.0.1', NULL, NULL),
	(226, 'C00002', 3, '56ja7c48o2td93f4nuh95r2pf7', '2019-03-31 16:19:33', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(227, 'C00011', 3, 'hvudet80kpnilm6p64mcvhmhg5', '2019-03-31 15:19:31', '0000-00-00 00:00:00', '::1', NULL, NULL),
	(228, 'C00013', 3, 'v2qc28eq783hh6fpq5oaqq6837', '2019-03-31 16:17:54', '2019-03-31 16:17:54', '127.0.0.1', NULL, NULL),
	(229, 'A00007', 3, '18qd2u3mlpufa20otgqusf0l40', '2019-04-01 02:02:46', '2019-04-01 02:02:46', '127.0.0.1', NULL, NULL),
	(230, 'A00008', 3, 'nbh3qs5gqe77uloktfjc6vrop6', '2019-04-01 02:07:06', '2019-04-01 02:07:06', '127.0.0.1', NULL, NULL);
/*!40000 ALTER TABLE `privi_session_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
