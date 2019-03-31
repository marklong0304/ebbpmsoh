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

-- membuang struktur untuk procedure erp_privi.log_login
DELIMITER //
CREATE DEFINER=`binto`@`%` PROCEDURE `log_login`(IN `cNip_` vARCHAR(50), IN `vSessionID_` VARCHAR(50), IN `dLoginAt_` vARCHAR(50), IN `dLogoutAt_` vARCHAR(50), IN `vIPSource_` vARCHAR(50))
BEGIN
	INSERT INTO `privi_session_log` 
		( `cNip`, `iCompanyId`, `vSessionID`, `dLoginAt`, `dLogoutAt`, `vIPSource`, `tUpdatedAt`, `cUpdatedBy`) 
	VALUES 
		(cNip_, 3, vSessionID_, dLoginAt_, dLogoutAt_, vIPSource_, NOW(), NULL);

END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
