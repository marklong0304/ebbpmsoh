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

-- membuang struktur untuk table hrd.gshift
CREATE TABLE IF NOT EXISTS `gshift` (
  `iGShiftID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Group shiftâ€™s id',
  `iShiftID` int(4) unsigned NOT NULL,
  `cKodeShift` char(2) DEFAULT NULL,
  `vGShiftName` varchar(50) DEFAULT NULL COMMENT 'Group shiftâ€™s name',
  `vGShiftNickName` varchar(5) DEFAULT NULL COMMENT 'Group shiftâ€™s short name',
  `tCreated` datetime DEFAULT NULL COMMENT 'Date and time the record was created',
  `cCreatedBy` char(7) DEFAULT NULL COMMENT 'Employeeâ€™s nip who created the record',
  `tUpdated` datetime DEFAULT NULL COMMENT 'Date and time the record was updated',
  `cUpdatedBy` char(7) DEFAULT NULL COMMENT 'Employeeâ€™snip who updated the record',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  `lGSecurity` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`iGShiftID`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Group of working shift';

-- Membuang data untuk tabel hrd.gshift: 1 rows
DELETE FROM `gshift`;
/*!40000 ALTER TABLE `gshift` DISABLE KEYS */;
INSERT INTO `gshift` (`iGShiftID`, `iShiftID`, `cKodeShift`, `vGShiftName`, `vGShiftNickName`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`, `lGSecurity`) VALUES
	(1, 1, '14', 'GENERAL SHIFT HO', 'OF1', '2008-06-24 14:23:46', 'N04749', '2017-03-16 09:19:43', 'N10893', 1, 0);
/*!40000 ALTER TABLE `gshift` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
