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

-- membuang struktur untuk table hrd.picarea
CREATE TABLE IF NOT EXISTS `picarea` (
  `iAreaId` int(3) NOT NULL,
  `cPAId` char(2) NOT NULL,
  `dEffective` date NOT NULL,
  `cNIP` char(7) DEFAULT '',
  `tupdated` datetime DEFAULT NULL,
  PRIMARY KEY (`iAreaId`,`cPAId`,`dEffective`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='PIC in each area';

-- Membuang data untuk tabel hrd.picarea: ~0 rows (lebih kurang)
DELETE FROM `picarea`;
/*!40000 ALTER TABLE `picarea` DISABLE KEYS */;
/*!40000 ALTER TABLE `picarea` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
