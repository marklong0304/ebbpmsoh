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

-- membuang struktur untuk table erp_privi.erp_notif_pic
CREATE TABLE IF NOT EXISTS `erp_notif_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idNotif` int(11) NOT NULL,
  `cNip` varchar(255) NOT NULL DEFAULT '0',
  `isAlert` varchar(255) NOT NULL DEFAULT '0',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tCreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel erp_privi.erp_notif_pic: ~2 rows (lebih kurang)
DELETE FROM `erp_notif_pic`;
/*!40000 ALTER TABLE `erp_notif_pic` DISABLE KEYS */;
INSERT INTO `erp_notif_pic` (`id`, `idNotif`, `cNip`, `isAlert`, `tUpdateAt`, `tCreatedAt`) VALUES
	(1, 1, 'N09486', '0', '2018-06-29 09:42:57', '2018-06-29 09:42:57'),
	(2, 1, 'N15748', '0', '2018-06-29 10:18:57', '2018-06-29 09:42:57');
/*!40000 ALTER TABLE `erp_notif_pic` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
