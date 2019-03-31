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

-- membuang struktur untuk table erp_privi.global_send_to
CREATE TABLE IF NOT EXISTS `global_send_to` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vCode` varchar(255) DEFAULT '0' COMMENT 'code ',
  `txtDesc` text COMMENT 'description email reminder',
  `txtSendTo` text COMMENT 'email reminder - To',
  `txtSendCc` text COMMENT 'email reminder - Cc',
  `txtSendBcc` text COMMENT 'email reminder - BCc',
  `txtSendFrom` text COMMENT 'email reminder - From',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Column 2` (`vCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Untuk kebutuhan distribusi email reminder';

-- Membuang data untuk tabel erp_privi.global_send_to: 0 rows
DELETE FROM `global_send_to`;
/*!40000 ALTER TABLE `global_send_to` DISABLE KEYS */;
/*!40000 ALTER TABLE `global_send_to` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
