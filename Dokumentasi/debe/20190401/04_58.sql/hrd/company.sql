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

-- membuang struktur untuk table hrd.company
CREATE TABLE IF NOT EXISTS `company` (
  `iCompanyId` int(2) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vCompName` varchar(60) DEFAULT '' COMMENT 'nama perusahaan',
  `vAcronim` varchar(4) DEFAULT '',
  `cNipCode` char(1) NOT NULL DEFAULT '' COMMENT 'Kode NIP',
  `iLastNip` int(6) NOT NULL DEFAULT '0' COMMENT 'Nomor Terakhir NIP',
  `cLKCode` char(2) DEFAULT NULL COMMENT 'Kode Perusahaan pada aplikasi Foxpro',
  `vNPWP` varchar(20) DEFAULT '' COMMENT 'NPWP',
  `vCompAddress` varchar(80) DEFAULT '' COMMENT 'alamat',
  `vCompKel` varchar(25) DEFAULT '' COMMENT 'kelurahan',
  `vCompKec` varchar(25) DEFAULT '' COMMENT 'kecamatan',
  `vRTRW` varchar(10) DEFAULT '' COMMENT 'RT/RW',
  `vCompKota` varchar(25) DEFAULT '' COMMENT 'Kota',
  `iProvidComp` int(3) DEFAULT '0' COMMENT 'Propinsi',
  `cPostalCode` char(5) DEFAULT '' COMMENT 'Kode pos',
  `cPhoneCC` char(5) DEFAULT '0' COMMENT 'Kode Negara Untuk No. HP',
  `vPhoneCode` varchar(4) DEFAULT '' COMMENT 'Kode tlp',
  `vPhoneNumber` varchar(20) DEFAULT '' COMMENT 'Nomer Tlp',
  `vFaxCode` varchar(4) DEFAULT '' COMMENT 'Kode Fax',
  `vFaxNumber` varchar(20) DEFAULT '' COMMENT 'No Fax',
  `vAddressLoc` varchar(80) DEFAULT '' COMMENT 'ALamat Lokasi',
  `vKelLoc` varchar(25) DEFAULT '' COMMENT 'Kelurahan Lokasi',
  `vKecLoc` varchar(25) DEFAULT '' COMMENT 'Kecamatan  Lokasi',
  `vRTRWloc` varchar(10) DEFAULT '' COMMENT 'RT/RW  Lokasi',
  `vKotaLoc` varchar(25) DEFAULT '' COMMENT 'Kota  Lokasi',
  `iProvidLoc` int(3) DEFAULT '0' COMMENT 'Provinsi  Lokasi',
  `cPostalloc` char(5) DEFAULT '' COMMENT 'Kode Post  Lokasi',
  `vPhonecodeloc` varchar(4) DEFAULT '' COMMENT 'Kode TLp  Lokasi',
  `vPhoneNoLoc` varchar(20) DEFAULT '' COMMENT 'Nomer Tlp  Lokasi',
  `vFaxCodeLoc` varchar(4) DEFAULT '' COMMENT 'Kode Fax  Lokasi',
  `vFaxNoLoc` varchar(20) DEFAULT '' COMMENT 'Nomer Fax  Lokasi',
  `vFile` varchar(100) DEFAULT '' COMMENT 'File Image',
  `vFoxPersoPATH` varchar(150) DEFAULT NULL COMMENT 'Lokasi data Perso Fpd26',
  `vAccNumber` varchar(25) DEFAULT NULL COMMENT 'Nomor Rekening',
  `vAccName` varchar(50) DEFAULT NULL COMMENT 'Atas Nama',
  `vBankName` varchar(50) DEFAULT NULL COMMENT 'Nama Bank',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  `tCreated` datetime DEFAULT NULL COMMENT 'created at',
  `cCreatedBy` char(7) DEFAULT NULL COMMENT 'created by',
  `tUpdated` datetime DEFAULT NULL COMMENT 'updated at',
  `cUpdatedby` char(7) DEFAULT NULL COMMENT 'updates by',
  PRIMARY KEY (`iCompanyId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='daftar profile per group perusahaan ';

-- Membuang data untuk tabel hrd.company: ~1 rows (lebih kurang)
DELETE FROM `company`;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`iCompanyId`, `vCompName`, `vAcronim`, `cNipCode`, `iLastNip`, `cLKCode`, `vNPWP`, `vCompAddress`, `vCompKel`, `vCompKec`, `vRTRW`, `vCompKota`, `iProvidComp`, `cPostalCode`, `cPhoneCC`, `vPhoneCode`, `vPhoneNumber`, `vFaxCode`, `vFaxNumber`, `vAddressLoc`, `vKelLoc`, `vKecLoc`, `vRTRWloc`, `vKotaLoc`, `iProvidLoc`, `cPostalloc`, `vPhonecodeloc`, `vPhoneNoLoc`, `vFaxCodeLoc`, `vFaxNoLoc`, `vFile`, `vFoxPersoPATH`, `vAccNumber`, `vAccName`, `vBankName`, `lDeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedby`) VALUES
	(3, ' . Balai Besar Pengujian Mutu & Sertifikasi Obat Hewan', 'NPL', 'N', 17296, '06', '01.002.680.5-052.000', 'JL. POS PENGUMBEN RAYA NO. 8', 'SUKABUMI SELATAN', 'KEBON JERUK', '005/05', 'JAKARTA BARAT', 8, '11560', '62', '021', '5355888', '021', '53668600', 'JL. WANAHERANG NO. 35', 'TLAJUNG UDIK', 'GUNUNG PUTRI', '', 'BOGOR', 8, '', '021', '8670350', '021', '8672449', 'files/personalia/image/3/NPL_LOGO.gif', 'G:\\DATA\\PERSO\\NOVELL\\', NULL, NULL, NULL, 0, '2008-03-05 10:26:07', 'N04749', '2018-12-13 13:48:46', 'N10568');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
