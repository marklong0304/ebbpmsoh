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

-- membuang struktur untuk table hrd.eb_iklan
CREATE TABLE IF NOT EXISTS `eb_iklan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vTitle` varchar(100) DEFAULT NULL,
  `vImage` varchar(255) DEFAULT NULL,
  `iLocation` tinyint(1) NOT NULL DEFAULT '1',
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_iklan: ~17 rows (lebih kurang)
DELETE FROM `eb_iklan`;
/*!40000 ALTER TABLE `eb_iklan` DISABLE KEYS */;
INSERT INTO `eb_iklan` (`id`, `vTitle`, `vImage`, `iLocation`, `ldeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(1, 'test', 'file/bulletin/images/product/1/product.jpg', 8, 1, '2015-08-07 14:16:04', 'N06081', '2015-08-07 15:04:26', 'N06081'),
	(2, 'test2', 'file/bulletin/images/product/2/product.jpg', 1, 1, '2015-08-07 14:40:24', 'N06081', '2015-08-07 14:51:08', 'N06081'),
	(3, 'test3', 'file/bulletin/images/product/3/product.jpg', 2, 1, '2015-08-07 15:05:02', 'N06081', '2015-08-07 15:05:02', NULL),
	(4, 'test4', 'file/bulletin/images/product/4/product.jpg', 3, 1, '2015-08-07 15:05:34', 'N06081', '2015-08-07 15:05:33', NULL),
	(5, 'test5', 'file/bulletin/images/product/5/product.jpg', 4, 1, '2015-08-07 15:05:53', 'N06081', '2015-08-07 15:05:53', NULL),
	(6, 'sip', 'file/bulletin/images/product/6/product.jpg', 5, 1, '2015-08-07 15:06:13', 'N06081', '2015-08-07 15:06:13', NULL),
	(7, 'test6', 'file/bulletin/images/product/7/product.jpg', 6, 1, '2015-08-07 15:06:37', 'N06081', '2015-08-07 15:06:37', NULL),
	(8, 'test7', 'file/bulletin/images/product/8/product.jpg', 7, 1, '2015-08-07 15:06:53', 'N06081', '2015-08-07 15:06:53', NULL),
	(9, 'iklan-1', 'file/bulletin/images/product/9/product.jpg', 1, 0, '2015-12-28 12:00:24', 'N00406', '2016-03-16 16:51:45', 'N11662'),
	(10, 'eao', NULL, 2, 1, '2016-01-04 11:14:09', 'n11662', '2016-01-04 11:14:09', NULL),
	(11, 'cooling 5', 'file/bulletin/images/product/11/product.jpg', 2, 0, '2016-01-04 11:14:49', 'n11662', '2016-03-16 16:52:16', 'N11662'),
	(12, 'mipi BOP', 'file/bulletin/images/product/12/product.jpg', 3, 0, '2016-01-04 11:15:30', 'n11662', '2016-03-16 16:52:34', 'N11662'),
	(13, 'Colling 5', 'file/bulletin/images/product/13/product.jpg', 4, 0, '2016-01-04 11:16:14', 'n11662', '2016-03-16 16:53:02', 'N11662'),
	(14, 'Medica Store', 'file/bulletin/images/product/14/product.jpg', 5, 1, '2016-01-04 11:17:06', 'n11662', '2016-01-27 08:56:19', 'n14308'),
	(15, 'kutilos', 'file/bulletin/images/product/15/product.jpg', 1, 1, '2016-01-18 11:30:11', 'N11662', '2016-01-18 11:31:33', 'N11662'),
	(16, 'Good Morning', 'file/bulletin/images/product/16/product.jpg', 6, 1, '2016-01-19 09:05:01', 'N00406', '2016-01-19 09:06:11', 'N00406'),
	(17, 'test', 'file/bulletin/images/product/17/product.jpg', 6, 1, '2016-01-19 09:08:28', 'N00406', '2016-01-19 09:08:28', NULL);
/*!40000 ALTER TABLE `eb_iklan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
