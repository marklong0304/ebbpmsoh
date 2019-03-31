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

-- membuang struktur untuk table bbpmsoh.mt02
CREATE TABLE IF NOT EXISTS `mt02` (
  `iMt02` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `dTgl_Kontrak` date DEFAULT NULL,
  `p1_nama` varchar(150) DEFAULT NULL,
  `p1_jabatan` varchar(100) DEFAULT NULL,
  `p1_perusahaan` varchar(120) DEFAULT NULL,
  `p1_alamat` text,
  `p1_an` varchar(500) DEFAULT NULL,
  `p2_nama` varchar(150) DEFAULT NULL,
  `p2_jabatan` varchar(100) DEFAULT NULL,
  `vNama_sample` varchar(150) DEFAULT NULL,
  `vAcuan_metode_uji` varchar(100) DEFAULT NULL,
  `vKeterangan` text,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` text,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt02`),
  UNIQUE KEY `iMt01_lDeleted` (`iMt01`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.mt02: ~2 rows (lebih kurang)
DELETE FROM `mt02`;
/*!40000 ALTER TABLE `mt02` DISABLE KEYS */;
INSERT INTO `mt02` (`iMt02`, `iMt01`, `dTgl_Kontrak`, `p1_nama`, `p1_jabatan`, `p1_perusahaan`, `p1_alamat`, `p1_an`, `p2_nama`, `p2_jabatan`, `vNama_sample`, `vAcuan_metode_uji`, `vKeterangan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, '2019-02-03', 'Pihak 1', 'Manager', 'Okeh Aja', 'Okeh Lagi', 'Pihak 1', 'Manager Mutu', 'Manager Mutu', 'Okeh', 'Kadar', 'uji kadar', 1, 2, '2019-03-17 10:27:10', 'N14615', 'approve', 'A00001', '2019-02-03 22:16:24', 'N14615', '2019-03-17 10:27:10', 0),
	(2, 2, '2019-03-29', 'Pihak1', 'Manager 1', 'PT Maju 1', 'Jakarta Barat', 'Manager Baru', 'PT Oke', 'Asisten', 'PT Langsing', 'Daftar Ulang', 'OKE', 1, 2, '2019-03-16 23:12:27', 'N14615', '', 'N14615', '2019-03-16 22:32:54', 'N14615', '2019-03-16 23:12:27', 0),
	(3, 5, '2019-03-31', 'Nama dari Dinas', 'Kepala', 'Dinas Oke', 'Okeh', 'An Kepala', 'Nama dari Customer', 'Direksi', 'SUP2', 'Kiriman Dinas', 'Oke', 1, 2, '2019-03-31 16:27:52', 'C00011', 'oke', 'A00001', '2019-03-31 16:10:03', 'C00011', '2019-03-31 16:27:52', 0);
/*!40000 ALTER TABLE `mt02` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
