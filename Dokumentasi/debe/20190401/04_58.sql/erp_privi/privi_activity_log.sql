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

-- membuang struktur untuk table erp_privi.privi_activity_log
CREATE TABLE IF NOT EXISTS `privi_activity_log` (
  `idprivi_activity_log` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `cNip` char(7) NOT NULL DEFAULT '0' COMMENT 'NIP username',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'ID table hrd.company daftar perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'ID Aplikasi',
  `idprivi_modules` int(11) NOT NULL DEFAULT '0' COMMENT 'ID table privi_modules',
  `vSessionID` varchar(50) NOT NULL DEFAULT '0' COMMENT 'session ID',
  `txtQuery` text COMMENT 'Catatan detail aktifitas  ',
  `tStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'timestamp log tercatat',
  PRIMARY KEY (`idprivi_activity_log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Contain activity per user recorded by system';

-- Membuang data untuk tabel erp_privi.privi_activity_log: 0 rows
DELETE FROM `privi_activity_log`;
/*!40000 ALTER TABLE `privi_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `privi_activity_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
