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

-- membuang struktur untuk table hrd.worklocation
CREATE TABLE IF NOT EXISTS `worklocation` (
  `I_LOCATION_ID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id lokasi',
  `V_LOCATION_NAME` varchar(35) NOT NULL COMMENT 'nama lokasi',
  `v_nickname` varchar(20) DEFAULT NULL COMMENT 'kode singkatan',
  `iCityID` int(3) DEFAULT NULL COMMENT 'id kota/kabupaten',
  `iAreaId` int(3) NOT NULL DEFAULT '0' COMMENT 'Kode Area (ID)',
  `iTypeId` int(3) NOT NULL DEFAULT '0',
  `cZona` char(1) NOT NULL DEFAULT '0' COMMENT 'Zona (terkait dengan tunjangan Transport)',
  `iUMK` int(11) NOT NULL DEFAULT '0' COMMENT 'Nilai UMK',
  `vAddress` text,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `L_DELETED` tinyint(1) DEFAULT NULL COMMENT 'status delete',
  `T_CREATED` datetime DEFAULT NULL COMMENT 'record dibuat tgl',
  `C_CREATED_BY` char(7) DEFAULT NULL COMMENT 'record dibuat oleh',
  `T_UPDATED` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'diupdate pada tgl',
  `C_UPDATED_BY` char(7) DEFAULT NULL COMMENT 'diupdate oleh',
  PRIMARY KEY (`I_LOCATION_ID`),
  UNIQUE KEY `V_LOCATION_NAME` (`V_LOCATION_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='detail lokasi';

-- Membuang data untuk tabel hrd.worklocation: ~2 rows (lebih kurang)
DELETE FROM `worklocation`;
/*!40000 ALTER TABLE `worklocation` DISABLE KEYS */;
INSERT INTO `worklocation` (`I_LOCATION_ID`, `V_LOCATION_NAME`, `v_nickname`, `iCityID`, `iAreaId`, `iTypeId`, `cZona`, `iUMK`, `vAddress`, `lDeleted`, `L_DELETED`, `T_CREATED`, `C_CREATED_BY`, `T_UPDATED`, `C_UPDATED_BY`) VALUES
	(1, 'NPL GUNUNG PUTRI (PLANT)', 'GP', 135, 49, 1, '0', 0, NULL, 0, 0, '2009-08-28 11:10:58', 'E00005', '2015-12-11 08:10:49', 'E00005'),
	(2, 'NPL HEAD OFFICE', 'HO', 127, 45, 1, '0', 0, NULL, 0, 0, '2009-08-28 11:10:58', 'E00005', '2015-12-11 08:10:49', 'E00005');
/*!40000 ALTER TABLE `worklocation` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
