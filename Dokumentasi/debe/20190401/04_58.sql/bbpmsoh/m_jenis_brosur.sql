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

-- membuang struktur untuk table bbpmsoh.m_jenis_brosur
CREATE TABLE IF NOT EXISTS `m_jenis_brosur` (
  `iM_jenis_brosur` int(11) NOT NULL AUTO_INCREMENT,
  `vJenis_brosur` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iM_jenis_brosur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.m_jenis_brosur: ~3 rows (lebih kurang)
DELETE FROM `m_jenis_brosur`;
/*!40000 ALTER TABLE `m_jenis_brosur` DISABLE KEYS */;
INSERT INTO `m_jenis_brosur` (`iM_jenis_brosur`, `vJenis_brosur`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Rancangan', 'Jenis Brosur masih rancangan', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(2, 'Asli', 'Brosur yang dikirim adalah asli', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(3, 'Kurang Lengkap', 'masih kurang lengkap', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:13', 0);
/*!40000 ALTER TABLE `m_jenis_brosur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
