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

-- membuang struktur untuk table erp_privi.privi_apps
CREATE TABLE IF NOT EXISTS `privi_apps` (
  `idprivi_apps` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vAppName` varchar(50) NOT NULL COMMENT 'Application Name',
  `txtDesc` text COMMENT 'Description',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 COMMENT='master daftar aplikasi';

-- Membuang data untuk tabel erp_privi.privi_apps: 50 rows
DELETE FROM `privi_apps`;
/*!40000 ALTER TABLE `privi_apps` DISABLE KEYS */;
INSERT INTO `privi_apps` (`idprivi_apps`, `vAppName`, `txtDesc`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(2, 'Personalia', 'Personalia', '0000-00-00 00:00:00', '-', '2019-01-26 12:37:59', 'N16049', 1),
	(3, 'Support System', 'Support system MIS', '2012-12-05 14:33:12', '-', '2019-01-26 12:37:59', '-', 1),
	(5, 'Product Life Cycle', 'Product Life Cycle', '2012-12-07 14:33:18', '-', '2019-01-26 12:37:59', 'N06081', 1),
	(79, 'New Framework', 'Developing New Framework.', '2013-02-04 10:56:13', 'N06081', '2019-01-26 12:37:59', 'N06081', 1),
	(130, 'e-Pengujian', 'Aplikasi e-Pengujian BBPMSOH ', '2019-01-26 12:55:27', 'N14615', '2019-02-03 21:27:30', 'N14615', 0),
	(129, 'Umum', 'Aplikasi Untuk Setting Karyawan , Division Dll', '2019-01-26 12:54:38', 'N14615', '2019-01-26 12:54:38', 'N14615', 0),
	(4, 'Recruitment & Selection', 'Recruitment & Selection', '0000-00-00 00:00:00', '-', '2019-01-26 12:37:59', 'N16049', 1),
	(80, 'Privilege', 'Privilege', '0000-00-00 00:00:00', '-', '2013-08-29 08:17:25', 'N06081', 0),
	(81, 'General Affair', 'GA Bengkel', '0000-00-00 00:00:00', '-', '2019-01-26 12:37:59', 'N09486', 1),
	(82, 'Project Management', 'Project Management', '0000-00-00 00:00:00', '-', '2019-01-26 12:37:59', '', 1),
	(83, 'Vital Sign', 'Vital Sign Team Supportin', '2014-01-23 09:23:24', 'N08249', '2019-01-26 12:37:59', 'N08249', 1),
	(84, 'Purchasing', 'Purchasing', '2014-12-19 17:22:06', 'N12831', '2019-01-26 12:37:59', 'N06081', 1),
	(85, 'NPL-Service', 'NPL-Service', '2014-12-19 17:43:05', 'N12831', '2019-01-26 12:37:59', 'N14225', 1),
	(86, 'Customer Care', 'Customer Care', '2014-12-30 09:32:17', 'N06081', '2019-01-26 12:37:59', 'N06081', 1),
	(87, 'IC Project', 'Kunjungan IC', '2014-12-30 11:10:01', 'N06081', '2019-01-26 12:37:59', 'N06081', 1),
	(88, 'Design (ArtWork) ', 'Aplikasi Design/Artwork untuk mengontrol proses design Promotion Material, Packaging Development & others.', '2014-12-30 13:31:38', 'N06081', '2019-01-26 12:37:59', 'N06081', 1),
	(89, 'e-Katalog', 'aplikasi ini untuk menyimpan katalog/brosur/penawaran dari supplier', '2015-02-18 16:22:28', 'N13986', '2019-01-26 12:37:59', 'N09486', 1),
	(90, 'Koperasi', 'Koperasi', '2016-01-05 07:56:00', 'N13986', '2019-01-26 12:37:59', 'N13986', 1),
	(91, 'Gantt Chart', 'Gantt chart', '2016-01-08 15:15:06', 'N13986', '2019-01-26 12:37:59', 'N14615', 1),
	(92, 'Warehouse', 'Aplikasi Warehouse ', '2016-01-13 09:23:05', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(99, 'HPP', 'HPP', '2016-04-12 16:52:36', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(100, 'Human Development', 'Human Development System', '2016-04-22 08:50:30', 'N16047', '2019-01-26 12:37:59', 'N16047', 1),
	(101, 'Movell', 'Movell Web Services based on Enterprise Resources Planning ', '2016-04-27 14:48:21', 'N14763', '2019-01-26 12:37:59', 'N14763', 1),
	(102, 'GPS Messenger', 'GPS Messenger', '2016-08-01 11:37:34', 'N13986', '2019-01-26 12:37:59', 'N13986', 1),
	(103, 'PK', 'Penilaian Kerja', '2016-08-24 16:03:59', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(104, 'ETC Service', 'Aplikasi Etercon Service', '2016-09-08 17:39:52', 'N15748', '2019-01-26 12:37:59', 'N15748', 1),
	(105, 'Misell', 'Marketing Information System Novell', '2016-09-21 15:13:12', 'N10893', '2019-01-26 12:37:59', 'N10893', 1),
	(106, 'Generator', 'Generator Module', '2016-11-16 09:37:07', 'N14615', '2019-01-27 01:00:15', 'N14615', 0),
	(107, 'COST', 'Aplikasi Request Application Convert dari Novelcst/Biaya', '2016-12-29 13:54:13', 'N14763', '2019-01-26 12:37:59', 'N14763', 1),
	(108, 'Inventory MIS', 'Inventory MIS', '2016-12-30 09:45:18', 'N16945', '2019-01-26 12:37:59', 'N16945', 1),
	(109, 'PD Detail', 'Aplikasi PD Detail', '2017-02-14 15:20:17', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(110, 'Exit Notice', 'KKnot/Exit Notice', '2017-04-10 14:29:27', 'N10893', '2019-01-26 12:37:59', 'N10893', 1),
	(111, 'Rework', 'Rework (Kanban - ERP)', '2017-04-12 10:43:55', 'N16945', '2019-01-26 12:37:59', 'N16945', 1),
	(112, 'NPL Infra Monitoring', 'Monitoring, Early Warning Sys. & PK calc for TS', '2017-05-30 09:09:01', 'N09486', '2019-01-26 12:37:59', 'N09486', 1),
	(113, 'Kartu Call', 'Aplikasi Kartu Call', '2017-06-05 12:59:23', 'N15748', '2019-01-26 12:37:59', 'N15748', 1),
	(114, 'Production Trial', 'PRODUCTION TRIAL', '2017-08-05 12:59:26', 'N15748', '2019-01-26 12:37:59', 'N15352', 1),
	(115, 'Novell Production System', 'Novell Production System', '2017-08-24 11:18:55', 'N15352', '2019-01-26 12:37:59', 'N15352', 1),
	(116, 'Flexell', 'Back Office untuk Flexell App', '2017-09-18 09:23:13', 'N14763', '2019-01-26 12:37:59', 'N14763', 1),
	(117, 'Medical Scientific Training', 'Aplikasi Medical Scientific Training', '2017-10-16 16:30:53', 'N17487', '2019-01-26 12:37:59', 'N17487', 1),
	(118, 'RND Core', 'RND Core bersifat pengembangan', '2017-10-17 08:38:15', 'N09486', '2019-01-26 12:37:59', 'N09486', 1),
	(119, 'Reformulasi', 'Aplikasi Reformulasi ', '2017-10-19 09:01:51', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(120, 'Marketing Analyst', 'Aplikasi Marketing Analyst Information System', '2017-12-05 16:16:29', 'N17487', '2019-01-26 12:37:59', 'N17487', 1),
	(121, 'Wisma Axcelor', 'Aplikasi Wisma Axcelor', '2018-01-26 11:21:49', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(122, 'Merek', 'Aplikasi Data Merek', '2018-03-21 08:36:52', 'N17487', '2019-01-26 12:37:59', 'N17487', 1),
	(123, 'Complaint', 'Aplikasi Complain ', '2018-05-04 14:37:59', 'N14615', '2019-01-26 12:37:59', 'N18714', 1),
	(124, 'Foxpro', 'Foxpro', '2018-05-30 11:02:51', 'N13986', '2019-01-26 12:37:59', 'N13986', 1),
	(125, 'Deviasi', 'Aplikasi Deviasi', '2018-07-02 14:24:48', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(126, 'KANBAN System', 'Production Monitoring System', '2018-07-10 10:04:33', 'N16945', '2019-01-26 12:37:59', 'N16945', 1),
	(127, 'Kalibrasi', 'Aplikasi Kalibrasi', '2018-08-16 08:07:10', 'N14615', '2019-01-26 12:37:59', 'N14615', 1),
	(128, 'PD Sourcing', 'PD Sourcing on ERP , next process that required after Request Sample on PLC Submitted', '2019-01-18 10:18:29', 'N14763', '2019-01-26 12:37:59', 'N14763', 1);
/*!40000 ALTER TABLE `privi_apps` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
