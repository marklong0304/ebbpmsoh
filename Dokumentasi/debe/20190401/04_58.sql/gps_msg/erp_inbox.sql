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

-- membuang struktur untuk table gps_msg.erp_inbox
CREATE TABLE IF NOT EXISTS `erp_inbox` (
  `inbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_count` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `modul_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `cnip_sender` char(50) NOT NULL DEFAULT '0',
  `vsubject` varchar(255) NOT NULL DEFAULT '0',
  `tmessage` text NOT NULL COMMENT 'disimpan dalam html',
  `vto` varchar(255) NOT NULL DEFAULT '0',
  `vcc` varchar(255) NOT NULL DEFAULT '0',
  `dcreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `ccreate` char(50) DEFAULT NULL,
  `dupdate` datetime DEFAULT NULL,
  `cupdate` char(50) DEFAULT NULL,
  `ldeleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`inbox_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel gps_msg.erp_inbox: ~0 rows (lebih kurang)
DELETE FROM `erp_inbox`;
/*!40000 ALTER TABLE `erp_inbox` DISABLE KEYS */;
INSERT INTO `erp_inbox` (`inbox_id`, `send_count`, `company_id`, `modul_id`, `group_id`, `cnip_sender`, `vsubject`, `tmessage`, `vto`, `vcc`, `dcreate`, `ccreate`, `dupdate`, `cupdate`, `ldeleted`) VALUES
	(17, 1, 0, 3988, 0, 'N14615', 'Complain - New Complain CP00000055', '\n                Diberitahukan bahwa telah ada Permintaan Complain, dan membutuhkan Approval dari anda sebagai atasan dari requestor.\n                dengan rincian sebagai berikut :<br><br>  \n                    <table border=\'0\' style=\'width: 600px;\'>\n                        <tr>\n                                <td style=\'width: 110px;\'><b>Requestor</b></td><td style=\'width: 20px;\'> : </td>\n                                <td>N14615 || MANSUR</td>\n                        </tr>\n                        <tr>\n                                <td><b>No Request</b></td><td> : </td>\n                                <td>CP00000055</td>\n                        </tr> \n                        <tr>\n                                <td><b>Tanggal Request  </b></td><td> : </td>\n                                <td>2018-07-05</td>\n                        </tr> \n                        <tr>\n                                <td><b>Jenis Complain  </b></td><td> : </td>\n                                <td>Regular</td>\n                        </tr>\n\n                        <tr>\n                                <td><b>Lokasi Modul</b></td><td> : </td>\n                                <td> Complain -> Transaksi -> Request Complain</td>\n                        </tr>\n                        \n                    </table> \n\n                <br/> <br/>\n                Demikian, mohon segera follow up  pada aplikasi ERP Complain. Terimakasih.<br><br><br>\n                Post Master', 'N13986', 'N14615', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0);
/*!40000 ALTER TABLE `erp_inbox` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
