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

-- membuang struktur untuk procedure erp_privi.cekAuthlist
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `cekAuthlist`(IN `opt` VARCHAR(50), IN `nipUser` VARCHAR(50), IN `ptID` VARCHAR(50), IN `appID` VARCHAR(50), IN `parentID` VARCHAR(50))
    COMMENT 'three in one for authorization: check app. list per PT, module l'
BEGIN
	IF opt = 'app' THEN
		SELECT
			t1.cNIP AS NIP,
			t1.iCompanyId AS 'PT',
			t1.idprivi_apps AS 'App_ID',
			t1.idprivi_group AS 'group',
			(
				SELECT tx1.vAppName FROM privi_apps tx1 WHERE tx1.idprivi_apps = t1.idprivi_apps
			) AS 'App_Name'
			
		FROM
			privi_authlist t1
		WHERE 
			t1.cNIP = nipUser
			AND
			t1.iCompanyId = ptID;
	
	ELSEIF opt = 'mod' THEN
			SELECT
			t1.cNIP AS NIP,
			t1.iCompanyId AS 'PT',
			t1.idprivi_apps AS 'App_ID',
			t1.idprivi_group AS 'group',
			(
				SELECT tx1.vAppName FROM privi_apps tx1 WHERE tx1.idprivi_apps = t1.idprivi_apps
			) AS 'App_Name',
			(
				SELECT 
					tx2.idprivi_modules
				FROM
					privi_modules tx2
				WHERE 
					tx2.idprivi_modules = t2.idprivi_modules
					AND
					tx2.idprivi_apps = t2.idprivi_apps
			) AS 'id',
			(
				SELECT 
					tx3.vCodeModule
				FROM
					privi_modules tx3
				WHERE 
					tx3.idprivi_modules = t2.idprivi_modules
					AND
					tx3.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Code',
			(
				SELECT 
					tx4.vNameModule
				FROM
					privi_modules tx4
				WHERE 
					tx4.idprivi_modules = t2.idprivi_modules
					AND
					tx4.idprivi_apps = t2.idprivi_apps
			) AS 'text',
			(
				SELECT 
					tx5.vPathModule
				FROM
					privi_modules tx5
				WHERE 
					tx5.idprivi_modules = t2.idprivi_modules
					AND
					tx5.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Path',
			(
				SELECT 
					tx6.iParent
				FROM
					privi_modules tx6
				WHERE 
					tx6.idprivi_modules = t2.idprivi_modules
					AND
					tx6.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Parent',
			t2.iCrud AS 	'Hak_Akses'
		FROM
			privi_authlist t1
		LEFT JOIN
			privi_group_pt_app_mod t2 
			ON t2.iCompanyId = t1.iCompanyId AND t2.idprivi_apps = t1.idprivi_apps AND t2.idprivi_group = t1.idprivi_group
		WHERE 
			t1.cNIP = nipUser
			AND
			t1.iCompanyId = ptID
			AND
			t1.idprivi_apps = appID;
	ELSEIF opt = 'sub' THEN
			SELECT
			t1.cNIP AS NIP,
			t1.iCompanyId AS 'PT',
			t1.idprivi_apps AS 'App_ID',
			t1.idprivi_group AS 'group',
			(
				SELECT tx1.vAppName FROM privi_apps tx1 WHERE tx1.idprivi_apps = t1.idprivi_apps
			) AS 'App_Name',
			(
				SELECT 
					tx2.idprivi_modules
				FROM
					privi_modules tx2
				WHERE 
					tx2.idprivi_modules = t2.idprivi_modules
					AND
					tx2.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_ID',
			(
				SELECT 
					tx3.vCodeModule
				FROM
					privi_modules tx3
				WHERE 
					tx3.idprivi_modules = t2.idprivi_modules
					AND
					tx3.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Code',
			(
				SELECT 
					tx4.vNameModule
				FROM
					privi_modules tx4
				WHERE 
					tx4.idprivi_modules = t2.idprivi_modules
					AND
					tx4.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Name',
			(
				SELECT 
					tx5.vPathModule
				FROM
					privi_modules tx5
				WHERE 
					tx5.idprivi_modules = t2.idprivi_modules
					AND
					tx5.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Path',
			(
				SELECT 
					tx6.iParent
				FROM
					privi_modules tx6
				WHERE 
					tx6.idprivi_modules = t2.idprivi_modules
					AND
					tx6.idprivi_apps = t2.idprivi_apps
			) AS 'Mod_Parent',
			t2.iCrud AS 	'Hak_Akses'
		FROM
			privi_authlist t1
		LEFT JOIN
			privi_group_pt_app_mod t2 
			ON t2.iCompanyId = t1.iCompanyId AND t2.idprivi_apps = t1.idprivi_apps AND t2.idprivi_group = t1.idprivi_group
		LEFT JOIN
			privi_modules t3
			ON t3.idprivi_apps = t1.idprivi_apps AND t3.idprivi_modules = t2.idprivi_modules
		WHERE 
			t1.cNIP = nipUser
			AND
			t1.iCompanyId = ptID
			AND
			t1.idprivi_apps = appID
			AND 
			t3.iParent = parentID;
	END IF;
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
