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

-- membuang struktur untuk table erp_privi.privi_authlist
CREATE TABLE IF NOT EXISTS `privi_authlist` (
  `iID_Authlist` int(11) NOT NULL AUTO_INCREMENT,
  `cNIP` char(7) NOT NULL DEFAULT '0' COMMENT 'id table hrd.employee - NIP user',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company - nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `idprivi_group` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_group_pt_app',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iID_Authlist`),
  KEY `isDeleted` (`isDeleted`),
  KEY `com` (`cNIP`,`iCompanyId`,`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=20958 DEFAULT CHARSET=latin1 COMMENT='Isi list authorisasi untuk setiap user';

-- Membuang data untuk tabel erp_privi.privi_authlist: 15 rows
DELETE FROM `privi_authlist`;
/*!40000 ALTER TABLE `privi_authlist` DISABLE KEYS */;
INSERT INTO `privi_authlist` (`iID_Authlist`, `cNIP`, `iCompanyId`, `idprivi_apps`, `idprivi_group`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(478, 'N14615', 3, 80, 31, '2015-02-26 17:54:36', 'N13986', '2015-02-26 17:54:36', 'N13986', 0),
	(20955, 'C00002', 3, 130, 286, '0000-00-00 00:00:00', '-', '2019-03-31 16:17:33', '-', 0),
	(10336, 'N14615', 3, 106, 157, '2016-11-16 09:40:19', 'N14615', '2016-11-16 09:40:19', 'N14615', 0),
	(20957, 'A00008', 3, 130, 289, '2019-04-01 02:00:49', 'N14615', '2019-04-01 02:00:49', 'N14615', 0),
	(20956, 'A00007', 3, 130, 288, '2019-04-01 02:00:00', 'N14615', '2019-04-01 02:00:00', 'N14615', 0),
	(20954, 'C00013', 3, 130, 286, '2019-03-31 16:01:19', 'N14615', '2019-03-31 16:01:19', 'N14615', 0),
	(20953, 'C00011', 3, 130, 286, '2019-03-31 15:20:51', 'N14615', '2019-03-31 15:20:51', 'N14615', 0),
	(20952, 'C00001', 3, 130, 286, '2019-02-03 21:29:21', 'N14615', '2019-02-03 21:30:41', 'N14615', 0),
	(20951, 'A00003', 3, 130, 283, '2019-01-27 01:41:30', 'N14615', '2019-01-27 01:41:30', 'N14615', 0),
	(20950, 'A00004', 3, 130, 284, '2019-01-27 01:40:36', 'N14615', '2019-01-27 01:40:36', 'N14615', 0),
	(20949, 'A00002', 3, 130, 282, '2019-01-27 01:40:21', 'N14615', '2019-01-27 01:40:21', 'N14615', 0),
	(20948, 'A00005', 3, 130, 285, '2019-01-27 01:39:21', 'N14615', '2019-01-27 01:39:21', 'N14615', 0),
	(20947, 'A00001', 3, 130, 281, '2019-01-27 01:33:45', 'N14615', '2019-01-27 01:33:45', 'N14615', 0),
	(20945, 'N14615', 3, 130, 280, '2019-01-26 13:20:23', 'N14615', '2019-01-26 13:20:23', 'N14615', 0),
	(20946, 'N14615', 3, 129, 279, '2019-01-26 13:21:22', 'N14615', '2019-01-26 13:21:22', 'N14615', 0);
/*!40000 ALTER TABLE `privi_authlist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
