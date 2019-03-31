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

-- membuang struktur untuk table hrd.eb_header
CREATE TABLE IF NOT EXISTS `eb_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vTitle` varchar(100) DEFAULT NULL,
  `vImage` varchar(255) DEFAULT NULL,
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_header: ~11 rows (lebih kurang)
DELETE FROM `eb_header`;
/*!40000 ALTER TABLE `eb_header` DISABLE KEYS */;
INSERT INTO `eb_header` (`id`, `vTitle`, `vImage`, `ldeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(1, 'tes1', 'file/bulletin/images/header/header2.jpg', 1, NULL, NULL, '2015-10-19 11:33:44', NULL),
	(2, 'header dua', 'file/bulletin/images/header/2/header.jpg', 0, '2015-10-20 09:03:03', 'N14349', '2016-01-04 11:10:40', 'n11662'),
	(3, 'header new year', 'file/bulletin/images/header/3/header.jpg', 1, '2016-01-04 11:05:32', 'n11662', '2016-01-04 11:05:32', NULL),
	(4, 'header v2', 'file/bulletin/images/header/4/header.jpg', 1, '2016-01-04 11:11:38', 'n11662', '2016-01-04 11:11:38', NULL),
	(5, 'New Header', 'file/bulletin/images/header/5/header.JPG', 1, '2016-03-01 08:47:57', 'n14308', '2016-03-01 08:47:57', NULL),
	(1, 'tes1', 'file/bulletin/images/header/header2.jpg', 1, NULL, NULL, '2015-10-19 11:33:44', NULL),
	(2, 'header dua', 'file/bulletin/images/header/2/header.jpg', 0, '2015-10-20 09:03:03', 'N14349', '2016-01-04 11:10:40', 'n11662'),
	(3, 'header new year', 'file/bulletin/images/header/3/header.jpg', 1, '2016-01-04 11:05:32', 'n11662', '2016-01-04 11:05:32', NULL),
	(4, 'header v2', 'file/bulletin/images/header/4/header.jpg', 1, '2016-01-04 11:11:38', 'n11662', '2016-01-04 11:11:38', NULL),
	(5, 'New Header', 'file/bulletin/images/header/5/header.JPG', 1, '2016-03-01 08:47:57', 'n14308', '2016-03-01 08:47:57', NULL),
	(6, 'Header atas', NULL, 1, '2018-03-01 13:55:29', 'N18069', '2018-03-01 13:55:29', NULL);
/*!40000 ALTER TABLE `eb_header` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
