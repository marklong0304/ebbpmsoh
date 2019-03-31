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

-- membuang struktur untuk table hrd.eb_categories
CREATE TABLE IF NOT EXISTS `eb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement ID',
  `vCategory` varchar(50) NOT NULL COMMENT 'CategoryName',
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_categories: ~9 rows (lebih kurang)
DELETE FROM `eb_categories`;
/*!40000 ALTER TABLE `eb_categories` DISABLE KEYS */;
INSERT INTO `eb_categories` (`id`, `vCategory`, `ldeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(1, 'Hot News', 0, NULL, NULL, '2015-12-23 09:10:50', ''),
	(2, 'Artikel', 0, NULL, NULL, '2015-06-16 09:08:00', NULL),
	(3, 'Entertainment', 0, NULL, NULL, '2015-06-16 09:08:08', NULL),
	(4, 'Kepo', 0, NULL, NULL, '2015-06-16 09:08:27', NULL),
	(5, 'Redaksi', 0, NULL, NULL, '2015-06-16 09:08:36', NULL),
	(6, 'Tips', 0, '2015-06-17 08:52:47', 'N06081', '2015-06-17 13:52:47', NULL),
	(7, 'Like And Dislike', 0, '2015-10-20 04:37:53', 'N14349', '2015-10-20 09:37:53', NULL),
	(8, 'Komentar', 0, '2015-10-20 04:38:13', 'N14349', '2015-10-20 09:38:13', NULL),
	(9, 'Motivation', 1, '2018-03-01 09:50:35', 'N10893', '2018-03-01 10:00:08', NULL);
/*!40000 ALTER TABLE `eb_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
