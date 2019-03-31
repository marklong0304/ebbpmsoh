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

-- membuang struktur untuk table erp_privi.perm_data
CREATE TABLE IF NOT EXISTS `perm_data` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permKey` varchar(100) NOT NULL,
  `permName` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `class_icon` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `user_create` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `bobot` int(11) NOT NULL,
  `menu` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel erp_privi.perm_data: 19 rows
DELETE FROM `perm_data`;
/*!40000 ALTER TABLE `perm_data` DISABLE KEYS */;
INSERT INTO `perm_data` (`ID`, `permKey`, `permName`, `image`, `class_icon`, `parent`, `create_date`, `user_create`, `update_date`, `user_update`, `deleted`, `status`, `bobot`, `menu`) VALUES
	(1, 'master', 'Admin Tools', '', '', 0, '2012-05-07 13:44:26', 1, '2013-01-21 09:24:04', 1, 0, 1, 2, 1),
	(3, 'privilege_user', 'User', '', '', 2, '2012-05-07 13:44:50', 1, '2012-06-28 17:25:38', 1, 0, 1, 1, 1),
	(4, 'privilege_group', 'User Right', '', '', 2, '2012-05-07 13:47:02', 1, '2012-05-18 22:17:28', 1, 0, 1, 2, 1),
	(5, 'privilege_module', 'Menu', '', '', 2, '2012-05-07 13:47:23', 1, '2012-06-28 17:32:38', 1, 0, 1, 3, 1),
	(2, 'privilege', 'Privileges', '', '', 0, '2012-05-09 10:29:01', 1, '2012-07-02 14:46:37', 1, 0, 1, 2, 1),
	(16, 'master_divisi_struktur', 'Stakeholder Structure', '', '', 1, '2013-02-01 16:41:19', 0, '0000-00-00 00:00:00', 0, 0, 1, 2, 1),
	(15, 'master_divisi', 'Stakeholder', '', '', 1, '2013-02-01 14:42:39', 1, '0000-00-00 00:00:00', 0, 0, 1, 1, 1),
	(14, 'privilege_company', 'Company', '', '', 2, '2013-01-25 14:16:33', 1, '0000-00-00 00:00:00', 0, 0, 1, 0, 1),
	(12, 'transaction', 'Transaction', '', '', 0, '2013-01-23 14:28:56', 1, '0000-00-00 00:00:00', 0, 0, 1, 3, 1),
	(17, 'master_bisnis_step', 'Bussiness Steps', '', '', 1, '2013-02-01 18:36:21', 1, '0000-00-00 00:00:00', 0, 0, 1, 6, 1),
	(18, 'master_activity', 'Activity', '', '', 1, '2013-02-01 19:00:30', 1, '0000-00-00 00:00:00', 0, 0, 1, 9, 1),
	(19, 'master_divisi_team', 'Stakeholder Team', '', '', 1, '2013-02-04 13:51:47', 1, '0000-00-00 00:00:00', 0, 0, 1, 3, 1),
	(20, 'master_divisi_team_struktur', 'Stakeholder Team Structure', '', '', 1, '2013-02-04 14:04:26', 1, '0000-00-00 00:00:00', 0, 0, 1, 4, 1),
	(23, 'master_bisnis_proses_type', 'Bussiness Process Type', '', '', 1, '2013-02-06 11:49:19', 1, '0000-00-00 00:00:00', 0, 0, 1, 7, 1),
	(22, 'master_divisi_team_member', 'Stakeholder Team Member', '', '', 1, '2013-02-04 14:04:26', 1, '0000-00-00 00:00:00', 0, 0, 0, 5, 1),
	(24, 'master_status', 'Status', '', '', 1, '2013-02-06 13:29:52', 1, '0000-00-00 00:00:00', 0, 0, 1, 10, 1),
	(25, 'master_bisnis_proses_sub', 'Bussiness Process Sub', '', '', 1, '2013-02-06 18:49:07', 1, '0000-00-00 00:00:00', 0, 0, 1, 8, 1),
	(26, 'upb', 'UPB', '', '', 0, '2013-02-14 13:48:16', 1, '0000-00-00 00:00:00', 0, 0, 1, 4, 1),
	(27, 'daftar_upb', 'Daftar UPB', '', '', 26, '2013-02-14 13:48:38', 1, '2013-02-14 13:48:40', 0, 0, 1, 1, 1);
/*!40000 ALTER TABLE `perm_data` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
