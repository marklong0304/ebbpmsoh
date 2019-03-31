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

-- membuang struktur untuk table bbpmsoh.m_tujuan_pengujian
CREATE TABLE IF NOT EXISTS `m_tujuan_pengujian` (
  `iM_tujuan_pengujian` int(11) NOT NULL AUTO_INCREMENT,
  `cKode` char(50) NOT NULL,
  `vNama_tujuan` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `iNeed_keterangan` tinyint(4) DEFAULT '0',
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iM_tujuan_pengujian`),
  UNIQUE KEY `cKode` (`cKode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.m_tujuan_pengujian: ~6 rows (lebih kurang)
DELETE FROM `m_tujuan_pengujian`;
/*!40000 ALTER TABLE `m_tujuan_pengujian` DISABLE KEYS */;
INSERT INTO `m_tujuan_pengujian` (`iM_tujuan_pengujian`, `cKode`, `vNama_tujuan`, `vKeterangan`, `iNeed_keterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'DB', 'Daftar Baru', 'Daftar Baru', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:17', 0),
	(2, 'DU', 'Daftar Ulang', 'Daftar Ulang', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:22', 0),
	(3, 'S', 'Sampling Sewaktu-waktu', 'Sampling Sewaktu-waktu', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:28', 0),
	(4, 'P', 'Pengawasan obat hewan dari dinas terkait', 'Pengawasan obat hewan dari dinas terkait', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:38:18', 0),
	(5, 'KD', 'Kiriman Dinas', 'Kiriman Dinas', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:13', 0),
	(6, 'PT', 'Pelayanan Teknis', 'Pelayanan Teknis', 1, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:22', 0);
/*!40000 ALTER TABLE `m_tujuan_pengujian` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
