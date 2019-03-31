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

-- membuang struktur untuk table erp_privi.privi_pt_app
CREATE TABLE IF NOT EXISTS `privi_pt_app` (
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company - nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdateBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iCompanyId`,`idprivi_apps`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Daftar aplikasi u/ per perusahaan ';

-- Membuang data untuk tabel erp_privi.privi_pt_app: 11 rows
DELETE FROM `privi_pt_app`;
/*!40000 ALTER TABLE `privi_pt_app` DISABLE KEYS */;
INSERT INTO `privi_pt_app` (`iCompanyId`, `idprivi_apps`, `tCreatedAt`, `cCreatedBy`, `tUpdateAt`, `cUpdateBy`, `isDeleted`) VALUES
	(3, 1, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(3, 2, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(3, 3, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(3, 4, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(5, 2, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(5, 3, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(6, 3, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(6, 5, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(5, 5, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(3, 5, '0000-00-00 00:00:00', '-', '0000-00-00 00:00:00', '-', 0),
	(3, 6, '0000-00-00 00:00:00', '-', '2012-12-28 09:20:56', '-', 0);
/*!40000 ALTER TABLE `privi_pt_app` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
