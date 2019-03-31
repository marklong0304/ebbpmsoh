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

-- membuang struktur untuk procedure erp_privi.privi_proc_menu
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `privi_proc_menu`(IN `pilihan` vaRCHAR(255), IN `id_` INT, IN `jenis` vARCHAR(50), IN `nip` vARCHAR(50), IN `compy` VARCHAR(50))
BEGIN
	IF pilihan = "getAppList" THEN
		select 
				a.idprivi_apps as id, 
				(
					select a2.vAppName from privi_apps a2 where a2.idprivi_apps = a.idprivi_apps
				) as `text`
			from 
				privi_authlist a 
			where 
				a.isDeleted = 0
				and
				a.cNIP = nip
				and
				a.iCompanyId = compy
				and 
				0 = ( select a1.isDeleted from privi_apps a1 where a1.idprivi_apps = a.idprivi_apps)
				; 
	ELSEIF pilihan = 'getSubMenu' and jenis ='folder' THEN
		select 
            	p.vNameModule 				as `text`,
            	' ' 							as `iconCls`,
            	p.className 					as `className`,
            	p.idprivi_modules 		as `id`,
            	p.iParent 					as  `parent_id`,
            	( select if(count(*) > 0 , 'false','true') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `leaf`,
            	( select if(count(*) > 1 , 'folder','file') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `cls`,
            	(
            		select 
							m.iCrud
						from
							privi_group_pt_app_mod m 
						where 
							m.idprivi_modules = p.idprivi_modules
							and
							m.idprivi_apps = p.idprivi_apps
							and 
							m.iCompanyId = md.iCompanyId
							and
							m.idprivi_group = md.idprivi_group
					) as `chmod`
            	
            from
            	privi_modules p
					left join
            	privi_group_pt_app_mod md on md.idprivi_modules = p.idprivi_modules
            where
            	p.iParent = id_
               and
               p.isDeleted = 0 
               and
               md.isDeleted = 0 
               and
               md.iCompanyId = compy
               and
               md.idprivi_apps = p.idprivi_apps
               and
               0 !=  (
            		select 
							m.iCrud
						from
							privi_group_pt_app_mod m 
						where 
							m.idprivi_modules = p.idprivi_modules
							and
							m.idprivi_apps = p.idprivi_apps
							and 
							m.iCompanyId = md.iCompanyId
							and
							m.idprivi_group = md.idprivi_group
					)
               and
               md.idprivi_group = (
								select 
									a.idprivi_group 
								from 
									privi_authlist a
								where 
									a.cNIP = nip
									and
									a.iCompanyId = md.iCompanyId
									and
									a.idprivi_apps = p.idprivi_apps
									and 
									a.isDeleted = 0
									
					);
   ELSEIF pilihan = 'getSubMenu' and jenis =' ' THEN
   					select 
            	p.vNameModule 				as `text`,
            	' ' 							as `iconCls`,
            	p.className 				as `className`,
            	p.idprivi_modules 		as `id`,
            	p.iParent 					as  `parent_id`,
            	( select if(count(*) > 0 , 'false','true') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `leaf`,
            	( select if(count(*) > 1 , 'folder','file') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `cls`,
            	(
            		select 
							m.iCrud
						from
							privi_group_pt_app_mod m 
						where 
							m.idprivi_modules = p.idprivi_modules
							and
							m.idprivi_apps = p.idprivi_apps
							and 
							m.iCompanyId = md.iCompanyId
							and
							m.idprivi_group = md.idprivi_group
					) as `chmod`
            	
            from
            	privi_modules p
            	left join
            	privi_group_pt_app_mod md on md.idprivi_modules = p.idprivi_modules
            where
            	p.idprivi_apps = id_
					and 
					p.iParent = 0
            	and
               p.isDeleted = 0 
               and
               md.isDeleted = 0 
               and
               md.iCompanyId = compy
               and
               md.idprivi_apps = p.idprivi_apps
               and
               0 !=  (
            		select 
							m.iCrud
						from
							privi_group_pt_app_mod m 
						where 
							m.idprivi_modules = p.idprivi_modules
							and
							m.idprivi_apps = p.idprivi_apps
							and 
							m.iCompanyId = md.iCompanyId
							and
							m.idprivi_group = md.idprivi_group
					)
               and
               md.idprivi_group = (
								select 
									a.idprivi_group 
								from 
									privi_authlist a
								where 
									a.cNIP = nip
									and
									a.iCompanyId = md.iCompanyId
									and
									a.idprivi_apps = p.idprivi_apps
									and 
									a.isDeleted = 0
									
				);
				/*select 
            	p.vNameModule 				as `text`,
            	' ' 							as `iconCls`,
            	className 					as `className`,
            	p.idprivi_modules 		as `id`,
            	p.iParent 					as  `parent_id`,
            	( select if(count(*) > 0 , 'false','true') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `leaf`,
            	( select if(count(*) > 1 , 'folder','file') from privi_modules p2 where p2.iParent = p.idprivi_modules ) as `cls`
            	
            from
            	privi_modules p
            where
            	p.idprivi_apps = id_ 
					and 
					p.iParent = 0
            	and
               isDeleted = 0 ;
       
      	*/
      	 
   END IF;
   
		
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
