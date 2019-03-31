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

-- membuang struktur untuk table hrd.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `cNip` char(7) NOT NULL COMMENT 'Nomer induk Pegawai / Customer',
  `vName` varchar(50) DEFAULT '' COMMENT 'Nama pegawai',
  `vEmail` varchar(150) DEFAULT NULL COMMENT 'email pribadi',
  `vAddress` varchar(150) DEFAULT NULL COMMENT 'alamat pribadi',
  `vTelepon` varchar(150) DEFAULT NULL COMMENT 'no telepon pribadi',
  `vEmail_company` varchar(150) DEFAULT NULL COMMENT 'email perusahaan',
  `vName_company` varchar(150) DEFAULT NULL COMMENT 'nama perusahaan ',
  `vAddress_company` varchar(150) DEFAULT NULL COMMENT 'alamat perusahaan',
  `vTelepon_company` varchar(150) DEFAULT NULL COMMENT 'no telepon perusahaan',
  `vFax_company` varchar(150) DEFAULT NULL COMMENT 'no fax perusahaan',
  `iVerifikasi` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status verifikasi registrasi 0:belum,1:verrifikasi,2:reject',
  `cVerified` char(50) DEFAULT NULL COMMENT 'diverfikasi oleh',
  `dVerified` datetime DEFAULT NULL COMMENT 'tanggal diverifikasi',
  `vRemark_verification` varchar(50) DEFAULT NULL COMMENT 'remark verifikasi',
  `iCompanyID` int(2) NOT NULL DEFAULT '3' COMMENT 'kode perusahaan',
  `iDivisionID` int(2) DEFAULT '7' COMMENT 'Kode Divisi = MsDivision.iDivId default Customer',
  `iDepartementID` int(2) DEFAULT '18' COMMENT 'Kode Departemen = MsDepartemen.iDeptID default customer',
  `iPostID` int(3) DEFAULT '359' COMMENT 'kode jabatan, default customer',
  `vPassword` varchar(100) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dResign` date NOT NULL DEFAULT '0000-00-00',
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_employee_Company` (`iCompanyID`),
  KEY `FK_employee_position` (`iPostID`),
  KEY `vName` (`vName`),
  KEY `cNipx` (`cNip`),
  KEY `iDivisionID` (`iDivisionID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='master informasi pegawai';

-- Membuang data untuk tabel hrd.employee: ~17 rows (lebih kurang)
DELETE FROM `employee`;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`ID`, `cNip`, `vName`, `vEmail`, `vAddress`, `vTelepon`, `vEmail_company`, `vName_company`, `vAddress_company`, `vTelepon_company`, `vFax_company`, `iVerifikasi`, `cVerified`, `dVerified`, `vRemark_verification`, `iCompanyID`, `iDivisionID`, `iDepartementID`, `iPostID`, `vPassword`, `lDeleted`, `cCreated`, `dCreated`, `dResign`, `cUpdated`, `dUpdated`) VALUES
	(1, 'N14615', 'MANSUR', 'mansurfrankeinstein@gmail.com', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 6, 17, 358, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:30'),
	(3, 'N14616', 'Hiro Ahza Alifiandra', 'hiroalifiandra@gmail.com', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 6, 17, 358, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:31'),
	(4, 'C00001', 'Customer 1', 'info@echishop.com', 'ini alamat', '081311562431', 'info@echishop.com', 'Echishop', 'alamat', '081311562431', '0213341', 1, NULL, NULL, NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:08:26', '0000-00-00', 'N14615', '2019-02-13 08:05:27'),
	(6, 'C00006', 'Rama', 'Rama@gmail.com', 'Kuningan', '082117890456', 'Rama@gmail.com', 'PT. WOKE', 'Jakarta', '021456789', '021458976', 1, 'N14615', '2019-02-13 08:17:26', 'oke', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:13:15', '0000-00-00', NULL, '2019-03-31 15:19:26'),
	(11, 'C00011', 'Cakra', 'Cakrahaha@gmail.com', 'Cirebon', '087890456789', 'Cakrahaha@gmail.com', 'PT. HaHa', 'Jakarta', '021678987', '021789654', 1, 'N14615', '2019-02-13 08:17:46', 'oke lagi', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:16:25', '0000-00-00', NULL, '2019-03-31 15:19:25'),
	(12, 'A00001', 'User Mutu', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 8, 19, 360, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:32'),
	(13, 'C00013', 'Gilang', 'Gilang@gmail.com', 'Cirebon', '085320789456', 'Gilang@gmail.com', 'PT. WAW', 'Jakarta', '021567897', '021345786', 1, 'N14615', '2019-02-13 08:16:01', NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:18:13', '0000-00-00', NULL, '2019-03-31 15:19:27'),
	(14, 'C00014', 'Wildan', 'Wildan@gmail.com', 'Kuningan', '085320600065', 'Wildan@gmail.com', 'PT. WILI', 'Jakarta', '021678954', '021456896', 1, 'N14615', '2019-02-13 08:14:13', NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:20:14', '0000-00-00', NULL, '2019-03-31 15:19:28'),
	(15, 'A00002', 'User Biologik', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 9, 22, 360, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:42'),
	(16, 'A00003', 'User Virologi', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 9, 20, 360, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:50'),
	(17, 'A00004', 'User Farmastetik & Premiks', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 9, 21, 360, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:51'),
	(18, 'A00005', 'User SPHU', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 12, 23, 364, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:52'),
	(19, 'A00006', 'Manager Mutu', 'managermutu@bbpmsoh.go.id', 'Jakarta', '021', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 8, 19, 362, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-02-03 20:50:02', '0000-00-00', NULL, '2019-03-31 16:56:53'),
	(20, 'C00002', 'Jojo', 'jojo@gmail.com', 'jojo@gmail.com', '08123', 'jojo@gmail.com', 'jojo@gmail.com', 'jojo@gmail.com', '021', '012', 1, 'A00001', '2019-03-31 16:17:33', 'approve sekaligus kasih akses', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-02-13 07:57:41', '0000-00-00', NULL, '2019-03-31 16:17:33'),
	(29, 'C00029', 'saya', 'saya@gmail.com', 'alamat', '000', 'saya@gmail.com', 'usaha', 'alamat usaha', '000', '000', 2, 'A00001', '2019-03-31 14:57:44', 'reject', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-02-13 09:39:33', '0000-00-00', NULL, '2019-03-31 14:58:33'),
	(30, 'A00007', 'Admin TU', 'admintu@bbpmsoh', 'Alamat', '0811', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 13, 24, 365, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-04-01 01:35:18', '0000-00-00', NULL, '2019-04-01 01:36:27'),
	(31, 'A00008', 'Admin Keuangan', 'adminkeu@bbpmsoh.com', 'Alamat', '0000', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 14, 25, 366, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-04-01 01:36:18', '0000-00-00', NULL, '2019-04-01 01:36:28');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
