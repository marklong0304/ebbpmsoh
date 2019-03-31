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

-- membuang struktur untuk table bbpmsoh.mt06
CREATE TABLE IF NOT EXISTS `mt06` (
  `iMt06` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `iDist_virologi` int(11) DEFAULT '0',
  `iDist_bakteri` int(11) DEFAULT '0',
  `iDist_farmastetik` int(11) DEFAULT '0',
  `iDist_patologi` int(11) DEFAULT '0',
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove_sphu` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_sphu` datetime DEFAULT NULL,
  `cApprove_sphu` varchar(50) DEFAULT NULL,
  `vRemark_sphu` varchar(500) DEFAULT NULL,
  `iApprove_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_uji` datetime DEFAULT NULL,
  `cApprove_uji` varchar(50) DEFAULT NULL,
  `vRemark_uji` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt06`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.mt06: ~0 rows (lebih kurang)
DELETE FROM `mt06`;
/*!40000 ALTER TABLE `mt06` DISABLE KEYS */;
INSERT INTO `mt06` (`iMt06`, `iMt01`, `vKepada_yth`, `vAlamat`, `iDist_virologi`, `iDist_bakteri`, `iDist_farmastetik`, `iDist_patologi`, `iSubmit`, `iApprove_sphu`, `dApprove_sphu`, `cApprove_sphu`, `vRemark_sphu`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 2, 'Kepada Aza', 'Jalan Love', 0, 1, 0, 1, 1, 2, '2019-03-17 15:43:41', 'N14615', '', 0, NULL, NULL, NULL, 'N14615', '2019-03-17 15:06:26', 'N14615', '2019-03-17 15:43:41', 0);
/*!40000 ALTER TABLE `mt06` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
