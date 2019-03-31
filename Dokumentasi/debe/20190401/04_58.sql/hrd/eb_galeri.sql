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

-- membuang struktur untuk table hrd.eb_galeri
CREATE TABLE IF NOT EXISTS `eb_galeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vTitle` varchar(100) DEFAULT NULL,
  `vImage` varchar(255) DEFAULT NULL,
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_galeri: ~54 rows (lebih kurang)
DELETE FROM `eb_galeri`;
/*!40000 ALTER TABLE `eb_galeri` DISABLE KEYS */;
INSERT INTO `eb_galeri` (`id`, `vTitle`, `vImage`, `ldeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(1, '1', 'file/bulletin/images/galeri/1/galeri.jpg', 1, '2015-10-21 11:09:37', 'N14349', '2015-10-21 11:09:58', 'N14349'),
	(2, '2', 'file/bulletin/images/galeri/2/galeri.jpg', 1, '2015-10-21 11:13:43', 'N14349', '2015-10-21 11:13:43', NULL),
	(3, 'Novell Day 2016', 'file/bulletin/images/galeri/3/galeri.JPG', 0, '2015-12-28 11:56:29', 'N00406', '2016-12-23 10:37:21', 'N11662'),
	(4, 'novell day 2016_RL', 'file/bulletin/images/galeri/4/galeri.JPG', 0, '2015-12-28 11:57:01', 'N00406', '2016-12-23 10:38:20', 'N11662'),
	(5, 'Novell Warrior', 'file/bulletin/images/galeri/5/galeri.jpg', 0, '2015-12-28 16:52:07', 'N00406', '2016-03-16 17:27:34', 'N11662'),
	(6, 'Novell Award 2016', 'file/bulletin/images/galeri/6/galeri.JPG', 0, '2015-12-28 16:54:20', 'N00406', '2016-12-23 10:38:41', 'N11662'),
	(7, 'door prize sepeda', 'file/bulletin/images/galeri/7/galeri.JPG', 0, '2015-12-28 16:58:06', 'N00406', '2016-12-23 10:39:22', 'N11662'),
	(8, 'Novell day 2016_HS', 'file/bulletin/images/galeri/8/galeri.JPG', 0, '2016-01-04 10:58:55', 'n11662', '2016-12-23 10:40:16', 'N11662'),
	(9, 'A P I K K', 'file/bulletin/images/galeri/9/galeri.png', 0, '2016-01-18 16:06:39', 'N11662', '2016-03-16 17:32:51', 'N11662'),
	(10, 'test', 'file/bulletin/images/galeri/10/galeri.jpg', 1, '2016-02-26 11:03:48', 'N10893', '2016-02-26 11:03:48', NULL),
	(11, 'laptop', 'file/bulletin/images/galeri/11/galeri.JPG', 0, '2016-12-23 10:41:14', 'N11662', '2016-12-23 10:42:39', 'N11662'),
	(12, 'door prize', 'file/bulletin/images/galeri/12/galeri.JPG', 0, '2016-12-23 10:43:45', 'N11662', '2016-12-23 10:43:45', NULL),
	(13, 'krishnamurti', 'file/bulletin/images/galeri/13/galeri.JPG', 0, '2016-12-23 10:44:25', 'N11662', '2016-12-23 10:44:25', NULL),
	(14, 'jansen sinamo', 'file/bulletin/images/galeri/14/galeri.JPG', 1, '2016-12-23 10:44:43', 'N11662', '2016-12-23 10:44:43', NULL),
	(15, 'jansen sinamo', 'file/bulletin/images/galeri/15/galeri.JPG', 1, '2016-12-23 10:45:03', 'N11662', '2016-12-23 10:46:14', 'N11662'),
	(16, 'jansen sinamo', 'file/bulletin/images/galeri/16/galeri.JPG', 0, '2016-12-23 10:47:49', 'N11662', '2016-12-23 10:47:49', NULL),
	(17, 'peserta', 'file/bulletin/images/galeri/17/galeri.JPG', 0, '2016-12-23 10:48:20', 'N11662', '2016-12-23 10:48:20', NULL),
	(18, 'doa', 'file/bulletin/images/galeri/18/galeri.JPG', 0, '2016-12-23 10:48:40', 'N11662', '2016-12-23 10:48:40', NULL),
	(19, 'kue', 'file/bulletin/images/galeri/19/galeri.JPG', 0, '2016-12-23 10:49:10', 'N11662', '2016-12-23 10:49:10', NULL),
	(20, 'ms', 'file/bulletin/images/galeri/20/galeri.JPG', 0, '2016-12-23 10:49:41', 'N11662', '2016-12-23 10:49:41', NULL),
	(21, 'hs', 'file/bulletin/images/galeri/21/galeri.JPG', 0, '2016-12-23 10:50:06', 'N11662', '2016-12-23 10:50:06', NULL),
	(22, 'KH', 'file/bulletin/images/galeri/22/galeri.JPG', 0, '2016-12-23 10:50:25', 'N11662', '2016-12-23 10:50:25', NULL),
	(23, 'cita citata', 'file/bulletin/images/galeri/23/galeri.JPG', 0, '2016-12-23 10:50:47', 'N11662', '2016-12-23 10:50:47', NULL),
	(24, 'door prize motor', 'file/bulletin/images/galeri/24/galeri.JPG', 0, '2016-12-23 10:51:11', 'N11662', '2016-12-23 10:51:11', NULL),
	(25, 'pemenang motor', 'file/bulletin/images/galeri/25/galeri.JPG', 0, '2016-12-23 10:51:51', 'N11662', '2016-12-23 10:51:51', NULL),
	(26, 'kora-kora', 'file/bulletin/images/galeri/26/galeri.JPG', 0, '2016-12-23 10:52:11', 'N11662', '2016-12-23 10:52:11', NULL),
	(27, 'C24FIT', 'file/bulletin/images/galeri/27/galeri.jpg', 1, '2016-12-27 10:16:28', 'n14308', '2016-12-27 10:16:47', 'n14308'),
	(1, '1', 'file/bulletin/images/galeri/1/galeri.jpg', 1, '2015-10-21 11:09:37', 'N14349', '2015-10-21 11:09:58', 'N14349'),
	(2, '2', 'file/bulletin/images/galeri/2/galeri.jpg', 1, '2015-10-21 11:13:43', 'N14349', '2015-10-21 11:13:43', NULL),
	(3, 'Novell Day 2016', 'file/bulletin/images/galeri/3/galeri.JPG', 0, '2015-12-28 11:56:29', 'N00406', '2016-12-23 10:37:21', 'N11662'),
	(4, 'novell day 2016_RL', 'file/bulletin/images/galeri/4/galeri.JPG', 0, '2015-12-28 11:57:01', 'N00406', '2016-12-23 10:38:20', 'N11662'),
	(5, 'Novell Warrior', 'file/bulletin/images/galeri/5/galeri.jpg', 0, '2015-12-28 16:52:07', 'N00406', '2016-03-16 17:27:34', 'N11662'),
	(6, 'Novell Award 2016', 'file/bulletin/images/galeri/6/galeri.JPG', 0, '2015-12-28 16:54:20', 'N00406', '2016-12-23 10:38:41', 'N11662'),
	(7, 'door prize sepeda', 'file/bulletin/images/galeri/7/galeri.JPG', 0, '2015-12-28 16:58:06', 'N00406', '2016-12-23 10:39:22', 'N11662'),
	(8, 'Novell day 2016_HS', 'file/bulletin/images/galeri/8/galeri.JPG', 0, '2016-01-04 10:58:55', 'n11662', '2016-12-23 10:40:16', 'N11662'),
	(9, 'A P I K K', 'file/bulletin/images/galeri/9/galeri.png', 0, '2016-01-18 16:06:39', 'N11662', '2016-03-16 17:32:51', 'N11662'),
	(10, 'test', 'file/bulletin/images/galeri/10/galeri.jpg', 1, '2016-02-26 11:03:48', 'N10893', '2016-02-26 11:03:48', NULL),
	(11, 'laptop', 'file/bulletin/images/galeri/11/galeri.JPG', 0, '2016-12-23 10:41:14', 'N11662', '2016-12-23 10:42:39', 'N11662'),
	(12, 'door prize', 'file/bulletin/images/galeri/12/galeri.JPG', 0, '2016-12-23 10:43:45', 'N11662', '2016-12-23 10:43:45', NULL),
	(13, 'krishnamurti', 'file/bulletin/images/galeri/13/galeri.JPG', 0, '2016-12-23 10:44:25', 'N11662', '2016-12-23 10:44:25', NULL),
	(14, 'jansen sinamo', 'file/bulletin/images/galeri/14/galeri.JPG', 1, '2016-12-23 10:44:43', 'N11662', '2016-12-23 10:44:43', NULL),
	(15, 'jansen sinamo', 'file/bulletin/images/galeri/15/galeri.JPG', 1, '2016-12-23 10:45:03', 'N11662', '2016-12-23 10:46:14', 'N11662'),
	(16, 'jansen sinamo', 'file/bulletin/images/galeri/16/galeri.JPG', 0, '2016-12-23 10:47:49', 'N11662', '2016-12-23 10:47:49', NULL),
	(17, 'peserta', 'file/bulletin/images/galeri/17/galeri.JPG', 0, '2016-12-23 10:48:20', 'N11662', '2016-12-23 10:48:20', NULL),
	(18, 'doa', 'file/bulletin/images/galeri/18/galeri.JPG', 0, '2016-12-23 10:48:40', 'N11662', '2016-12-23 10:48:40', NULL),
	(19, 'kue', 'file/bulletin/images/galeri/19/galeri.JPG', 0, '2016-12-23 10:49:10', 'N11662', '2016-12-23 10:49:10', NULL),
	(20, 'ms', 'file/bulletin/images/galeri/20/galeri.JPG', 0, '2016-12-23 10:49:41', 'N11662', '2016-12-23 10:49:41', NULL),
	(21, 'hs', 'file/bulletin/images/galeri/21/galeri.JPG', 0, '2016-12-23 10:50:06', 'N11662', '2016-12-23 10:50:06', NULL),
	(22, 'KH', 'file/bulletin/images/galeri/22/galeri.JPG', 0, '2016-12-23 10:50:25', 'N11662', '2016-12-23 10:50:25', NULL),
	(23, 'cita citata', 'file/bulletin/images/galeri/23/galeri.JPG', 0, '2016-12-23 10:50:47', 'N11662', '2016-12-23 10:50:47', NULL),
	(24, 'door prize motor', 'file/bulletin/images/galeri/24/galeri.JPG', 0, '2016-12-23 10:51:11', 'N11662', '2016-12-23 10:51:11', NULL),
	(25, 'pemenang motor', 'file/bulletin/images/galeri/25/galeri.JPG', 0, '2016-12-23 10:51:51', 'N11662', '2016-12-23 10:51:51', NULL),
	(26, 'kora-kora', 'file/bulletin/images/galeri/26/galeri.JPG', 0, '2016-12-23 10:52:11', 'N11662', '2016-12-23 10:52:11', NULL),
	(27, 'C24FIT', 'file/bulletin/images/galeri/27/galeri.jpg', 1, '2016-12-27 10:16:28', 'n14308', '2016-12-27 10:16:47', 'n14308');
/*!40000 ALTER TABLE `eb_galeri` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
