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

-- membuang struktur untuk table bbpmsoh.mt074_header
CREATE TABLE IF NOT EXISTS `mt074_header` (
  `iMt074` int(11) NOT NULL AUTO_INCREMENT,
  `iHeader` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak,1=Iya',
  `iParent` int(11) NOT NULL DEFAULT '0',
  `vUraian` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iMt074`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel bbpmsoh.mt074_header: ~0 rows (lebih kurang)
DELETE FROM `mt074_header`;
/*!40000 ALTER TABLE `mt074_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt074_header` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
