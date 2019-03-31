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

-- membuang struktur untuk table hrd.eb_komentar
CREATE TABLE IF NOT EXISTS `eb_komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iParentId` int(11) NOT NULL,
  `iArticleId` int(11) NOT NULL,
  `iType` tinyint(1) NOT NULL DEFAULT '1',
  `cPengirim` char(7) NOT NULL,
  `vIsi` text,
  `vBalasan` text,
  `dFU` datetime DEFAULT NULL,
  `dSelesai` datetime DEFAULT NULL,
  `iStatus` tinyint(1) NOT NULL DEFAULT '0',
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_komentar: ~21 rows (lebih kurang)
DELETE FROM `eb_komentar`;
/*!40000 ALTER TABLE `eb_komentar` DISABLE KEYS */;
INSERT INTO `eb_komentar` (`id`, `iParentId`, `iArticleId`, `iType`, `cPengirim`, `vIsi`, `vBalasan`, `dFU`, `dSelesai`, `iStatus`, `ldeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(1, 0, 1, 3, 'N14763', 'Kirim Saran.', 'test1', '2015-08-10 00:00:00', NULL, 1, 1, '2015-08-07 17:03:43', 'N14763', '2015-08-10 09:34:27', 'N06081'),
	(2, 0, 1, 2, 'N14784', 'teststststststs', 'test selesai', '2015-08-10 09:59:28', '2015-08-10 09:59:28', 2, 0, '2015-08-07 17:06:00', 'N14784', '2015-08-10 09:59:28', 'N06081'),
	(3, 0, 1, 1, 'N14534', 'Saraaaa', NULL, NULL, NULL, 0, 0, '2015-08-07 17:07:30', 'N14534', '2015-08-07 17:07:30', 'N06081'),
	(5, 0, 1, 1, 'N14282', 'test saran', NULL, NULL, NULL, 0, 0, '2015-08-10 15:03:32', 'N14282', '2015-08-10 15:03:32', 'N06081'),
	(23, 0, 8, 2, 'N14300', 'test   ', NULL, NULL, NULL, 0, 0, '2015-08-11 13:44:36', 'N14300', '2015-08-11 13:44:36', 'N06081'),
	(24, 0, 1, 0, '', 'tes ikhsan', NULL, NULL, NULL, 0, 0, '2015-10-20 11:23:35', '', '2015-10-20 11:23:35', NULL),
	(25, 0, 1, 0, '', 'good news', NULL, NULL, NULL, 0, 0, '2015-10-20 11:30:14', '', '2015-10-20 11:30:14', NULL),
	(26, 0, 32, 1, '', 'Gambare durung ono, kalau ono, wuih tambah informatif', NULL, NULL, NULL, 0, 0, '2015-12-23 17:50:29', '', '2015-12-23 17:50:29', NULL),
	(27, 0, 70, 1, '', 'Akan lebih baik jika ditambahkan gambar yang menarik, terima kasih atas informasinya', NULL, NULL, NULL, 0, 0, '2016-07-01 09:40:31', '', '2016-07-01 09:40:31', NULL),
	(28, 0, 22, 0, 'N10893', 'tidak semua', NULL, NULL, NULL, 0, 0, '2017-01-31 16:51:08', 'N10893', '2017-01-31 16:51:08', NULL),
	(29, 0, 72, 1, 'N10893', 'test', 'aaabb', NULL, NULL, 0, 0, '2017-02-02 11:36:31', 'N10893', '2017-02-02 11:36:31', NULL),
	(30, 0, 72, 0, 'N10893', 'reasa', NULL, NULL, NULL, 0, 0, '2017-02-02 11:39:38', 'N10893', '2017-02-02 11:39:38', NULL),
	(31, 0, 72, 1, 'N10893', 'sds', NULL, NULL, NULL, 0, 0, '2017-02-02 11:40:51', 'N10893', '2017-02-02 11:40:51', NULL),
	(32, 0, 72, 1, 'N10893', 'sds', NULL, NULL, NULL, 0, 0, '2017-02-02 11:44:16', 'N10893', '2017-02-02 11:44:16', NULL),
	(33, 0, 72, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 13:11:53', 'N10893', '2017-02-02 13:11:53', NULL),
	(34, 0, 74, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 13:12:24', 'N10893', '2017-02-02 13:12:24', NULL),
	(35, 0, 74, 2, 'N10893', 'test from dev ', NULL, NULL, NULL, 0, 0, '2017-02-02 13:21:40', 'N10893', '2017-02-02 13:21:40', NULL),
	(36, 0, 72, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 13:46:49', 'N10893', '2017-02-02 13:46:49', NULL),
	(37, 0, 72, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 13:51:21', 'N10893', '2017-02-02 13:51:21', NULL),
	(38, 0, 72, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 13:52:50', 'N10893', '2017-02-02 13:52:50', NULL),
	(39, 0, 72, 2, 'N10893', 'test from dev', NULL, NULL, NULL, 0, 0, '2017-02-02 14:06:51', 'N10893', '2017-02-02 14:06:51', NULL);
/*!40000 ALTER TABLE `eb_komentar` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
