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

-- membuang struktur untuk table bbpmsoh.mt05_detail
CREATE TABLE IF NOT EXISTS `mt05_detail` (
  `iMt05_detail` int(11) NOT NULL AUTO_INCREMENT,
  `iMt05` int(11) DEFAULT NULL,
  `iMt01` int(11) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt05_detail`),
  KEY `iMt05` (`iMt05`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='dibuat detail untuk jaga2 karena bisa saja tanda terima sample dari beberapa request.\r\njika tidak jadi dibuat banyak, maka validasi di button add row saja\r\n';

-- Membuang data untuk tabel bbpmsoh.mt05_detail: ~1 rows (lebih kurang)
DELETE FROM `mt05_detail`;
/*!40000 ALTER TABLE `mt05_detail` DISABLE KEYS */;
INSERT INTO `mt05_detail` (`iMt05_detail`, `iMt05`, `iMt01`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 2, 'N14615', '2019-03-17 12:38:47', 'N14615', '2019-03-17 12:59:03', 0);
/*!40000 ALTER TABLE `mt05_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
