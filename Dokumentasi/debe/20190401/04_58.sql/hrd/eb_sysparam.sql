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

-- membuang struktur untuk table hrd.eb_sysparam
CREATE TABLE IF NOT EXISTS `eb_sysparam` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id rs_sysparam',
  `cVariable` char(20) DEFAULT NULL,
  `vContent` text,
  `vDesc` varchar(120) DEFAULT NULL,
  `dCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `dUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel hrd.eb_sysparam: ~5 rows (lebih kurang)
DELETE FROM `eb_sysparam`;
/*!40000 ALTER TABLE `eb_sysparam` DISABLE KEYS */;
INSERT INTO `eb_sysparam` (`id`, `cVariable`, `vContent`, `vDesc`, `dCreated`, `cCreatedBy`, `dUpdated`, `cUpdatedBy`) VALUES
	(1, 'EB_CC', 'Febriyani.Noor@novellpharm.com', 'CC Bulletin', '2015-08-10 14:38:38', 'N14349', '2015-08-10 14:38:27', NULL),
	(2, 'EB_TO', 'sucianto@novellpharm.com', 'TO Bulletin', '2015-08-10 15:59:08', 'N14349', '2015-08-10 14:59:01', NULL),
	(3, 'LINKTEXT', 'Bulletin Novell Terbaru Periode 2017 klik disini', NULL, NULL, NULL, '2017-02-02 10:03:29', NULL),
	(4, 'TMPSHARE', '<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Tahoma,Geneva,sans-serif"><img alt="hd" height="193" src="file/images/6/hd.png" title="hd" width="477" /></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:Tahoma,Geneva,sans-serif">Yuk, Buruan Klik <a href="http://www.npl-net.com/ebulletin" target="_blank">E-Bulletin</a></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:Tahoma,Geneva,sans-serif">Regards,</span></span></p>\r\n\r\n<p><span style="font-size:20px"><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#2980b9"><strong>Human Development Department</strong></span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:Tahoma,Geneva,sans-serif">PT. Novell Pharmaceutical Laboratories</span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:Tahoma,Geneva,sans-serif">Telp. (021) 5355888 - ext. 6202, 6501, 6502</span></span></p>\r\n\r\n', 'Template Share Artikel', NULL, NULL, '2018-02-20 15:35:34', NULL),
	(5, 'SHARETO', 'Krisna.Cipta@novellpharm.com', 'Email Share Artikel', NULL, NULL, '2018-02-20 15:36:18', NULL);
/*!40000 ALTER TABLE `eb_sysparam` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
