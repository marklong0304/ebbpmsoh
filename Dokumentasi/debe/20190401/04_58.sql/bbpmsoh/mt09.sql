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

-- membuang struktur untuk table bbpmsoh.mt09
CREATE TABLE IF NOT EXISTS `mt09` (
  `iMt8a` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `dTanggal` date DEFAULT NULL,
  `vreg_deptan` varchar(255) DEFAULT NULL,
  `vPenyimpangan` varchar(255) DEFAULT NULL,
  `tKomposisi` text,
  `dWarnaTglUji` date DEFAULT NULL,
  `dPartikelTglUji` date DEFAULT NULL,
  `dKelarutanTglUji` date DEFAULT NULL,
  `dKeseragamanTglUji` date DEFAULT NULL,
  `dPHTglUji` date DEFAULT NULL,
  `dSterilitas37TglUji` date DEFAULT NULL,
  `dSterilitas22TglUji` date DEFAULT NULL,
  `dUjiKontaminasiTglUji` date DEFAULT NULL,
  `dEcoliTglUji` date DEFAULT NULL,
  `dKelembabanTglUji` date DEFAULT NULL,
  `dToksitasTglUji` date DEFAULT NULL,
  `dPirogenitasTglUji` date DEFAULT NULL,
  `dPotensiTglUji` date DEFAULT NULL,
  `dWarnaMetoda` date DEFAULT NULL,
  `dKelembabanMetoda` date DEFAULT NULL,
  `dToksitasMetoda` date DEFAULT NULL,
  `dPirogenitasMetoda` date DEFAULT NULL,
  `dPotensiMetoda` date DEFAULT NULL,
  `dPartikelMetoda` date DEFAULT NULL,
  `dKelarutanMetoda` date DEFAULT NULL,
  `dKeseragamanMetoda` date DEFAULT NULL,
  `dPHMetoda` date DEFAULT NULL,
  `dSterilitas37Metoda` date DEFAULT NULL,
  `dSterilitas22Metoda` date DEFAULT NULL,
  `dUjiKontaminasiMetoda` date DEFAULT NULL,
  `dEcoliMetoda` date DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_unit_uji` datetime DEFAULT NULL,
  `cApprove_unit_uji` varchar(50) DEFAULT NULL,
  `vRemark_unit_uji` varchar(500) DEFAULT NULL,
  `iApprove_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_uji` datetime DEFAULT NULL,
  `cApprove_uji` varchar(50) DEFAULT NULL,
  `vRemark_uji` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt8a`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel bbpmsoh.mt09: ~0 rows (lebih kurang)
DELETE FROM `mt09`;
/*!40000 ALTER TABLE `mt09` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt09` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
