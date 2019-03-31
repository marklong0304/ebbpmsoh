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

-- membuang struktur untuk table bbpmsoh.mt04
CREATE TABLE IF NOT EXISTS `mt04` (
  `iMt04` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` varchar(50) DEFAULT NULL,
  `vNama_sample` varchar(500) DEFAULT NULL,
  `vNama_perusahaan` varchar(300) DEFAULT NULL,
  `vAlamat_perusahaan` varchar(500) DEFAULT NULL,
  `vTelepon_perusahaan` varchar(50) DEFAULT NULL,
  `dTgl_terima_sample` date DEFAULT NULL,
  `dTgl_terima_serum` date DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt04`),
  UNIQUE KEY `iMt05` (`iMt04`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.mt04: ~0 rows (lebih kurang)
DELETE FROM `mt04`;
/*!40000 ALTER TABLE `mt04` DISABLE KEYS */;
INSERT INTO `mt04` (`iMt04`, `iMt01`, `vNama_sample`, `vNama_perusahaan`, `vAlamat_perusahaan`, `vTelepon_perusahaan`, `dTgl_terima_sample`, `dTgl_terima_serum`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, '5', 'Sample oke', 'Nama Perusah', 'Alamat', 'telepon', '2019-03-31', '2019-03-31', 0, 0, NULL, NULL, NULL, NULL, '2019-03-31 17:32:52', NULL, '2019-03-31 18:03:13', 0);
/*!40000 ALTER TABLE `mt04` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
