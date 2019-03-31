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

-- membuang struktur untuk table bbpmsoh.mt03
CREATE TABLE IF NOT EXISTS `mt03` (
  `iMt03` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vnomor_03` varchar(255) DEFAULT NULL,
  `dtanggal_03` date DEFAULT NULL,
  `iAda_batch` tinyint(4) DEFAULT NULL,
  `vBatch` varchar(255) DEFAULT NULL,
  `iTgl_expired` tinyint(4) DEFAULT NULL,
  `dTgl_expired` date DEFAULT NULL,
  `iEtiket_brosur` tinyint(4) DEFAULT NULL,
  `vEtiket_brosur` varchar(500) DEFAULT NULL,
  `iM_jenis_brosur` int(11) DEFAULT NULL COMMENT 'relasi ke master jenis brosur',
  `iReq_permohonan` tinyint(4) DEFAULT NULL,
  `iPengantar_direktorat` tinyint(4) DEFAULT NULL,
  `iHasil_ppoh` tinyint(4) DEFAULT NULL,
  `iBahan_standard` tinyint(4) DEFAULT NULL COMMENT '1:perlu,0:tidak perlu',
  `tCatatan` text,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `vCatatan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt03`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.mt03: ~1 rows (lebih kurang)
DELETE FROM `mt03`;
/*!40000 ALTER TABLE `mt03` DISABLE KEYS */;
INSERT INTO `mt03` (`iMt03`, `iMt01`, `vnomor_03`, `dtanggal_03`, `iAda_batch`, `vBatch`, `iTgl_expired`, `dTgl_expired`, `iEtiket_brosur`, `vEtiket_brosur`, `iM_jenis_brosur`, `iReq_permohonan`, `iPengantar_direktorat`, `iHasil_ppoh`, `iBahan_standard`, `tCatatan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `vCatatan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 2, 'xx', '2019-03-31', 0, 'xxx', 0, '2019-03-31', NULL, 'xxxxx', 2, 0, 0, 0, 0, 'xxxxxx', 1, 0, NULL, NULL, NULL, NULL, 'A00001', '2019-03-31 21:51:54', 'A00001', '2019-03-31 21:56:38', 0);
/*!40000 ALTER TABLE `mt03` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
