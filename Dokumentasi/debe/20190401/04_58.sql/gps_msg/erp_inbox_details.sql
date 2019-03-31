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

-- membuang struktur untuk table gps_msg.erp_inbox_details
CREATE TABLE IF NOT EXISTS `erp_inbox_details` (
  `inbox_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(11) NOT NULL DEFAULT '0',
  `cnip` char(50) NOT NULL DEFAULT '0',
  `istatus_received` tinyint(2) NOT NULL DEFAULT '0',
  `istatus_read` int(11) NOT NULL DEFAULT '0' COMMENT '0=>New, 1=>Read',
  `dreceived` datetime DEFAULT NULL,
  `dread` datetime DEFAULT NULL,
  `dcreate` datetime DEFAULT NULL,
  `ccreate` char(50) DEFAULT NULL,
  `dupdate` date DEFAULT NULL,
  `cupdate` char(50) DEFAULT NULL,
  `ldeleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`inbox_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel gps_msg.erp_inbox_details: ~2 rows (lebih kurang)
DELETE FROM `erp_inbox_details`;
/*!40000 ALTER TABLE `erp_inbox_details` DISABLE KEYS */;
INSERT INTO `erp_inbox_details` (`inbox_detail_id`, `inbox_id`, `cnip`, `istatus_received`, `istatus_read`, `dreceived`, `dread`, `dcreate`, `ccreate`, `dupdate`, `cupdate`, `ldeleted`) VALUES
	(32, 17, 'N13986', 1, 1, '2018-08-23 05:50:19', '2018-08-23 05:50:23', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0),
	(33, 17, 'N14615', 1, 1, '2018-07-09 15:00:00', '2018-07-10 10:22:50', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0);
/*!40000 ALTER TABLE `erp_inbox_details` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
