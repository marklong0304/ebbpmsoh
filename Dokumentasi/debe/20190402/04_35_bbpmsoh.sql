-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for bbpmsoh
CREATE DATABASE IF NOT EXISTS `bbpmsoh` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bbpmsoh`;

-- Dumping structure for table bbpmsoh.mt01
CREATE TABLE IF NOT EXISTS `mt01` (
  `iMt01` int(11) NOT NULL AUTO_INCREMENT,
  `vNo_transaksi` varchar(50) DEFAULT NULL COMMENT 'autogenerate number',
  `vNomor` varchar(50) DEFAULT NULL,
  `vLampiran` varchar(50) DEFAULT NULL,
  `vPerihal` varchar(500) DEFAULT NULL,
  `dTanggal` date DEFAULT NULL,
  `iCustomer` varchar(50) DEFAULT NULL COMMENT 'relasi ke hrd.cNip, referensikan Nama Company',
  `iType_pemohon` tinyint(4) DEFAULT NULL COMMENT '1=>Perorangan,2=>Perusahaan,3=>Dinas',
  `vNama_produsen` varchar(50) DEFAULT NULL,
  `vAlamat_produsen` varchar(500) DEFAULT NULL,
  `iM_tujuan_pengujian` tinyint(4) DEFAULT NULL,
  `vTujuan_pengujian_ket` varchar(500) DEFAULT NULL COMMENT 'diisi jika pelayanan teknis',
  `vNama_sample` varchar(150) DEFAULT NULL,
  `iM_jenis_sediaan` tinyint(4) DEFAULT NULL COMMENT 'jenis sediaan',
  `vJenis_sediaan_ket` varchar(500) DEFAULT NULL COMMENT 'diisi jika jenis sediaan lain lain',
  `iSudah_beredar` tinyint(4) DEFAULT NULL COMMENT '1:sudah , 0:belum ;sudah beredar di indonesia ?',
  `vZat_aktif` varchar(100) DEFAULT NULL COMMENT 'zat aktif',
  `vBatch_lot` varchar(100) DEFAULT NULL,
  `dTgl_produksi` date DEFAULT NULL,
  `dTgl_kadaluarsa` date DEFAULT NULL,
  `vNo_registrasi` varchar(50) DEFAULT NULL,
  `vKemasan` varchar(100) DEFAULT NULL,
  `iJumlah_diserahkan` int(11) DEFAULT NULL,
  `vSuhu_penyimpanan` varchar(100) DEFAULT NULL,
  `vPermohonan_lampiran` varchar(100) DEFAULT NULL,
  `dTgl_ambil_sample` date DEFAULT NULL,
  `dTgl_serah_sample` date DEFAULT NULL,
  `vPimpinan_perusahaan` varchar(50) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `iStatus_sertifikat` tinyint(4) DEFAULT '0' COMMENT 'modul sertifikat, 0:new 2:memenuhi syarat , 1 tidak memenuhi syarat',
  `iSubmit_sertifikat` tinyint(4) DEFAULT NULL,
  `iSphu_app` tinyint(1) NOT NULL DEFAULT '0',
  `dSphu_app` datetime DEFAULT NULL,
  `cSphu_app` varchar(50) DEFAULT NULL,
  `vSphu_app` varchar(500) DEFAULT NULL,
  `iTu_app` tinyint(1) NOT NULL DEFAULT '0',
  `dTu_app` datetime DEFAULT NULL,
  `cTu_app` varchar(50) DEFAULT NULL,
  `vTu_app` varchar(500) DEFAULT NULL,
  `iFa_app` tinyint(1) NOT NULL DEFAULT '0',
  `dFa_app` datetime DEFAULT NULL,
  `cFa_app` varchar(50) DEFAULT NULL,
  `vFa_app` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`iMt01`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt01: ~5 rows (approximately)
DELETE FROM `mt01`;
/*!40000 ALTER TABLE `mt01` DISABLE KEYS */;
INSERT INTO `mt01` (`iMt01`, `vNo_transaksi`, `vNomor`, `vLampiran`, `vPerihal`, `dTanggal`, `iCustomer`, `iType_pemohon`, `vNama_produsen`, `vAlamat_produsen`, `iM_tujuan_pengujian`, `vTujuan_pengujian_ket`, `vNama_sample`, `iM_jenis_sediaan`, `vJenis_sediaan_ket`, `iSudah_beredar`, `vZat_aktif`, `vBatch_lot`, `dTgl_produksi`, `dTgl_kadaluarsa`, `vNo_registrasi`, `vKemasan`, `iJumlah_diserahkan`, `vSuhu_penyimpanan`, `vPermohonan_lampiran`, `dTgl_ambil_sample`, `dTgl_serah_sample`, `vPimpinan_perusahaan`, `lDeleted`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `iStatus_sertifikat`, `iSubmit_sertifikat`, `iSphu_app`, `dSphu_app`, `cSphu_app`, `vSphu_app`, `iTu_app`, `dTu_app`, `cTu_app`, `vTu_app`, `iFa_app`, `dFa_app`, `cFa_app`, `vFa_app`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`) VALUES
	(1, 'R00001', 'aa', 'aa', 'aa', '2019-02-03', 'C00011', 1, 'aa', 'aa', 1, 'a', 'aa', 1, NULL, 1, 'aa', 'aa', '2019-02-03', '2019-02-03', 'aaa', 'aaa', 12, '32', 'ss', '2019-02-03', '2019-02-03', 'Hiro Ahza', 0, 1, 2, '2019-02-23 14:31:53', 'N14615', 'reject', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'C00001', '2019-02-03 22:01:52', 'N14615', '2019-03-31 15:55:20'),
	(2, 'R00002', 'Vitamin', 'Lamp Vit', 'Penggemuk Badan', '2019-02-03', 'C00011', 1, 'PT Langsing', 'Di Kontrakan', 2, 'Tujuannya bikin gemuk', 'Susu Ultra', 1, 'Susu', 1, 'Protein', 'BTCH02x', '2019-02-03', '2019-02-03', 'NOREG0123SA', 'Bottle', 10, '10', 'Bagus', '2019-02-03', '2019-02-03', 'Kora', 0, 1, 2, '2019-02-23 14:02:01', 'N14615', 'approve', 2, 1, 2, '2019-04-01 01:46:04', 'A00005', 'ok', 2, '2019-04-01 02:02:27', 'A00007', 'ok', 2, '2019-04-01 02:04:09', 'A00008', 'sudah dikirim ', 'C00001', '2019-02-03 22:01:52', 'A00001', '2019-04-01 04:01:22'),
	(3, 'R00003', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:32:30', NULL, '2019-03-31 15:45:52'),
	(4, 'R00004', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 0, 1, 0, NULL, NULL, NULL, 2, 1, 2, '2019-04-01 01:46:04', 'A00005', 'ok', 2, '2019-04-01 02:02:27', 'A00007', 'ok', 2, '2019-04-01 02:04:09', 'A00008', 'sudah dikirim ', 'N14615', '2019-02-12 22:33:54', 'A00001', '2019-04-01 02:04:09'),
	(5, 'R00005', 'No X201231', 'Lampiran B', 'Sample Bahan', '2019-03-16', 'C00011', 1, 'SUP2', 'Jakarta Barat', 5, 'Keterangan', 'Sample Bahan Baku', 4, NULL, 0, 'Zat Aktif', 'BATCH 1', '2019-03-16', '2019-03-16', 'No Reg 2019/dsa', 'Kemasan 01', 100, '30', 'No Subject', '2019-03-21', '2019-03-29', 'Joko Santosa', 0, 1, 2, '2019-03-16 13:34:18', 'N14615', '', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-03-16 13:34:03', 'N14615', '2019-03-31 15:45:53');
/*!40000 ALTER TABLE `mt01` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt02
CREATE TABLE IF NOT EXISTS `mt02` (
  `iMt02` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `dTgl_Kontrak` date DEFAULT NULL,
  `p1_nama` varchar(150) DEFAULT NULL,
  `p1_jabatan` varchar(100) DEFAULT NULL,
  `p1_perusahaan` varchar(120) DEFAULT NULL,
  `p1_alamat` text,
  `p1_an` varchar(500) DEFAULT NULL,
  `p2_nama` varchar(150) DEFAULT NULL,
  `p2_jabatan` varchar(100) DEFAULT NULL,
  `vNama_sample` varchar(150) DEFAULT NULL,
  `vAcuan_metode_uji` varchar(100) DEFAULT NULL,
  `vKeterangan` text,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` text,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt02`),
  UNIQUE KEY `iMt01_lDeleted` (`iMt01`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt02: ~2 rows (approximately)
DELETE FROM `mt02`;
/*!40000 ALTER TABLE `mt02` DISABLE KEYS */;
INSERT INTO `mt02` (`iMt02`, `iMt01`, `dTgl_Kontrak`, `p1_nama`, `p1_jabatan`, `p1_perusahaan`, `p1_alamat`, `p1_an`, `p2_nama`, `p2_jabatan`, `vNama_sample`, `vAcuan_metode_uji`, `vKeterangan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, '2019-02-03', 'Pihak 1', 'Manager', 'Okeh Aja', 'Okeh Lagi', 'Pihak 1', 'Manager Mutu', 'Manager Mutu', 'Okeh', 'Kadar', 'uji kadar', 1, 2, '2019-03-17 10:27:10', 'N14615', 'approve', 'A00001', '2019-02-03 22:16:24', 'N14615', '2019-03-17 10:27:10', 0),
	(2, 2, '2019-03-29', 'Pihak1', 'Manager 1', 'PT Maju 1', 'Jakarta Barat', 'Manager Baru', 'PT Oke', 'Asisten', 'PT Langsing', 'Daftar Ulang', 'OKE', 1, 2, '2019-03-16 23:12:27', 'N14615', '', 'N14615', '2019-03-16 22:32:54', 'N14615', '2019-03-16 23:12:27', 0),
	(3, 5, '2019-03-31', 'Nama dari Dinas', 'Kepala', 'Dinas Oke', 'Okeh', 'An Kepala', 'Nama dari Customer', 'Direksi', 'SUP2', 'Kiriman Dinas', 'Oke', 1, 2, '2019-03-31 16:27:52', 'C00011', 'oke', 'A00001', '2019-03-31 16:10:03', 'C00011', '2019-03-31 16:27:52', 0);
/*!40000 ALTER TABLE `mt02` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt02_detail
CREATE TABLE IF NOT EXISTS `mt02_detail` (
  `iMt02_detail` int(11) NOT NULL AUTO_INCREMENT,
  `iMt02` int(11) DEFAULT NULL,
  `vNama_sample` varchar(150) DEFAULT NULL,
  `vAcuan_metode-uji` varchar(100) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt02_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='// still not use, \r\ninfomasi yang diterima adalah , hanya 1 sample di setiap req pengujian\r\n';

-- Dumping data for table bbpmsoh.mt02_detail: ~0 rows (approximately)
DELETE FROM `mt02_detail`;
/*!40000 ALTER TABLE `mt02_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt02_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt03
CREATE TABLE IF NOT EXISTS `mt03` (
  `iMt03` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vnomor_03` varchar(255) DEFAULT NULL,
  `dtanggal_03` date DEFAULT NULL,
  `iAda_batch` tinyint(4) DEFAULT NULL,
  `vBatch` varchar(255) DEFAULT NULL,
  `iTgl_expired` tinyint(4) DEFAULT NULL,
  `dTgl_expired` date DEFAULT NULL,
  `iEtiket_brosur` tinyint(4) DEFAULT NULL,
  `vEtiket_brosur` varchar(500) DEFAULT NULL,
  `iM_jenis_brosur` int(11) DEFAULT NULL COMMENT 'relasi ke master jenis brosur',
  `iReq_permohonan` tinyint(4) DEFAULT NULL,
  `iPengantar_direktorat` tinyint(4) DEFAULT NULL,
  `iHasil_ppoh` tinyint(4) DEFAULT NULL,
  `iBahan_standard` tinyint(4) DEFAULT NULL COMMENT '1:perlu,0:tidak perlu',
  `tCatatan` text,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `vCatatan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt03`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt03: ~0 rows (approximately)
DELETE FROM `mt03`;
/*!40000 ALTER TABLE `mt03` DISABLE KEYS */;
INSERT INTO `mt03` (`iMt03`, `iMt01`, `vnomor_03`, `dtanggal_03`, `iAda_batch`, `vBatch`, `iTgl_expired`, `dTgl_expired`, `iEtiket_brosur`, `vEtiket_brosur`, `iM_jenis_brosur`, `iReq_permohonan`, `iPengantar_direktorat`, `iHasil_ppoh`, `iBahan_standard`, `tCatatan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `vCatatan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 2, 'xx', '2019-03-31', 0, 'xxx', 0, '2019-03-31', NULL, 'xxxxx', 2, 0, 0, 0, 0, 'xxxxxx', 1, 0, NULL, NULL, NULL, NULL, 'A00001', '2019-03-31 21:51:54', 'A00001', '2019-03-31 21:56:38', 0);
/*!40000 ALTER TABLE `mt03` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt03_file
CREATE TABLE IF NOT EXISTS `mt03_file` (
  `ifile_mt03` int(11) NOT NULL AUTO_INCREMENT,
  `iMt03` int(11) DEFAULT NULL,
  `vFilename` varchar(255) DEFAULT NULL,
  `vFilename_generate` varchar(255) DEFAULT NULL,
  `vKeterangan` text,
  `cCreate` char(50) DEFAULT NULL,
  `dCreate` datetime DEFAULT NULL,
  `cUpdate` char(50) DEFAULT NULL,
  `dUpdate` datetime DEFAULT NULL,
  `lDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`ifile_mt03`),
  KEY `lDeleted` (`lDeleted`),
  KEY `iMt03` (`iMt03`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt03_file: ~2 rows (approximately)
DELETE FROM `mt03_file`;
/*!40000 ALTER TABLE `mt03_file` DISABLE KEYS */;
INSERT INTO `mt03_file` (`ifile_mt03`, `iMt03`, `vFilename`, `vFilename_generate`, `vKeterangan`, `cCreate`, `dCreate`, `cUpdate`, `dUpdate`, `lDeleted`) VALUES
	(5, 2, 'a4.pdf', '0__2019_03_31__21_52_00__a4.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(6, 2, 'A4langsung.pdf', '1__2019_03_31__21_52_00__A4langsung.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(7, 2, 'Manual Book SiiPLAH untuk Admin ESELON 1.pdf', '0__2019_03_31__21_56_44__Manual Book SiiPLAH untuk Admin ESELON 1.pdf', 'ssss', 'A00001', '2019-03-31 21:56:44', NULL, NULL, 0);
/*!40000 ALTER TABLE `mt03_file` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt04
CREATE TABLE IF NOT EXISTS `mt04` (
  `iMt04` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` varchar(50) DEFAULT NULL,
  `vNama_sample` varchar(500) DEFAULT NULL,
  `vNama_perusahaan` varchar(300) DEFAULT NULL,
  `vAlamat_perusahaan` varchar(500) DEFAULT NULL,
  `vTelepon_perusahaan` varchar(50) DEFAULT NULL,
  `dTgl_terima_sample` date DEFAULT NULL,
  `dTgl_terima_serum` date DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt04`),
  UNIQUE KEY `iMt05` (`iMt04`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt04: ~0 rows (approximately)
DELETE FROM `mt04`;
/*!40000 ALTER TABLE `mt04` DISABLE KEYS */;
INSERT INTO `mt04` (`iMt04`, `iMt01`, `vNama_sample`, `vNama_perusahaan`, `vAlamat_perusahaan`, `vTelepon_perusahaan`, `dTgl_terima_sample`, `dTgl_terima_serum`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, '5', 'Sample oke', 'Nama Perusah', 'Alamat', 'telepon', '2019-03-31', '2019-03-31', 0, 0, NULL, NULL, NULL, NULL, '2019-03-31 17:32:52', NULL, '2019-03-31 18:03:13', 0);
/*!40000 ALTER TABLE `mt04` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt04_detail
CREATE TABLE IF NOT EXISTS `mt04_detail` (
  `iMt04_detail` int(11) NOT NULL AUTO_INCREMENT,
  `iMt04` int(11) DEFAULT NULL,
  `vAntiserum` varchar(50) DEFAULT NULL,
  `vKadar` varchar(50) DEFAULT NULL,
  `vAsal` varchar(50) DEFAULT NULL,
  `vBatch` varchar(50) DEFAULT NULL,
  `dTgl_expired` date DEFAULT NULL,
  `vJumlah` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(50) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt04_detail`),
  KEY `iMt05` (`iMt04`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='\r\n';

-- Dumping data for table bbpmsoh.mt04_detail: ~0 rows (approximately)
DELETE FROM `mt04_detail`;
/*!40000 ALTER TABLE `mt04_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt04_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt05
CREATE TABLE IF NOT EXISTS `mt05` (
  `iMt05` int(11) NOT NULL AUTO_INCREMENT,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt05`),
  UNIQUE KEY `iMt05` (`iMt05`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt05: ~0 rows (approximately)
DELETE FROM `mt05`;
/*!40000 ALTER TABLE `mt05` DISABLE KEYS */;
INSERT INTO `mt05` (`iMt05`, `vKepada_yth`, `vAlamat`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Cv. Maju Kena', 'Mundur Kena', 1, 2, '2019-03-17 13:05:21', 'N14615', 'app', 'N14615', '2019-03-17 12:38:47', 'N14615', '2019-03-17 13:05:21', 0);
/*!40000 ALTER TABLE `mt05` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt05_detail
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

-- Dumping data for table bbpmsoh.mt05_detail: ~0 rows (approximately)
DELETE FROM `mt05_detail`;
/*!40000 ALTER TABLE `mt05_detail` DISABLE KEYS */;
INSERT INTO `mt05_detail` (`iMt05_detail`, `iMt05`, `iMt01`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 2, 'N14615', '2019-03-17 12:38:47', 'N14615', '2019-03-17 12:59:03', 0);
/*!40000 ALTER TABLE `mt05_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt06
CREATE TABLE IF NOT EXISTS `mt06` (
  `iMt06` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `iDist_virologi` int(11) DEFAULT '0',
  `iDist_bakteri` int(11) DEFAULT '0',
  `iDist_farmastetik` int(11) DEFAULT '0',
  `iDist_patologi` int(11) DEFAULT '0',
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iApprove_sphu` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_sphu` datetime DEFAULT NULL,
  `cApprove_sphu` varchar(50) DEFAULT NULL,
  `vRemark_sphu` varchar(500) DEFAULT NULL,
  `iApprove_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_uji` datetime DEFAULT NULL,
  `cApprove_uji` varchar(50) DEFAULT NULL,
  `vRemark_uji` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt06`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt06: ~0 rows (approximately)
DELETE FROM `mt06`;
/*!40000 ALTER TABLE `mt06` DISABLE KEYS */;
INSERT INTO `mt06` (`iMt06`, `iMt01`, `vKepada_yth`, `vAlamat`, `iDist_virologi`, `iDist_bakteri`, `iDist_farmastetik`, `iDist_patologi`, `iSubmit`, `iApprove_sphu`, `dApprove_sphu`, `cApprove_sphu`, `vRemark_sphu`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 2, 'Test', 'oke', 1, 1, 1, 1, 1, 2, '2019-03-31 23:01:13', 'A00001', 'oke', 0, NULL, NULL, NULL, 'A00001', '2019-03-31 22:59:11', 'A00001', '2019-04-01 00:05:58', 0);
/*!40000 ALTER TABLE `mt06` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt07
CREATE TABLE IF NOT EXISTS `mt07` (
  `iMt07` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vSuhu_penyimpanan` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `dTanggal` date DEFAULT NULL,
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
  PRIMARY KEY (`iMt07`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt07: ~0 rows (approximately)
DELETE FROM `mt07`;
/*!40000 ALTER TABLE `mt07` DISABLE KEYS */;
INSERT INTO `mt07` (`iMt07`, `iMt01`, `vKepada_yth`, `vSuhu_penyimpanan`, `vKeterangan`, `dTanggal`, `iSubmit`, `iApprove_unit_uji`, `dApprove_unit_uji`, `cApprove_unit_uji`, `vRemark_unit_uji`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 2, 'From MT06', '99', 'Oke', '2019-03-31', 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-03-31 23:53:50', 'A00001', '2019-04-01 02:18:32', 1);
/*!40000 ALTER TABLE `mt07` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt074_header
CREATE TABLE IF NOT EXISTS `mt074_header` (
  `iMt074` int(11) NOT NULL AUTO_INCREMENT,
  `iHeader` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak,1=Iya',
  `iParent` int(11) NOT NULL DEFAULT '0',
  `vUraian` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iMt074`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt074_header: ~0 rows (approximately)
DELETE FROM `mt074_header`;
/*!40000 ALTER TABLE `mt074_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt074_header` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08
CREATE TABLE IF NOT EXISTS `mt08` (
  `iMt08` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt08`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt08: ~0 rows (approximately)
DELETE FROM `mt08`;
/*!40000 ALTER TABLE `mt08` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt08` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08a
CREATE TABLE IF NOT EXISTS `mt08a` (
  `iMt8a` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iKesimpulan` tinyint(1) DEFAULT NULL COMMENT '0:new,1:tms, 2:ms',
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt8a`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08a: ~1 rows (approximately)
DELETE FROM `mt08a`;
/*!40000 ALTER TABLE `mt08a` DISABLE KEYS */;
INSERT INTO `mt08a` (`iMt8a`, `iMt01`, `iSubmit`, `iKesimpulan`, `iApprove_unit_uji`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(6, 2, 1, 2, 2, '2019-04-02 02:55:24', 'A00003', 'oke approve', 'A00003', '2019-04-02 01:30:46', 'A00003', '2019-04-02 02:55:24', 0);
/*!40000 ALTER TABLE `mt08a` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08a_fisik
CREATE TABLE IF NOT EXISTS `mt08a_fisik` (
  `iMt08a_fisik` int(11) NOT NULL AUTO_INCREMENT,
  `iMt8a` int(11) DEFAULT NULL,
  `vWarna` varchar(500) DEFAULT NULL,
  `vWarna_metoda` varchar(500) DEFAULT NULL,
  `vWarna_mutu` varchar(500) DEFAULT NULL,
  `dWarna_tanggal` date DEFAULT NULL,
  `vAsing` varchar(500) DEFAULT NULL,
  `vAsing_metoda` varchar(500) DEFAULT NULL,
  `vAsing_mutu` varchar(500) DEFAULT NULL,
  `dAsing_tanggal` date DEFAULT NULL,
  `vHomogen` varchar(500) DEFAULT NULL,
  `vHomogen_metoda` varchar(500) DEFAULT NULL,
  `vHomogen_mutu` varchar(500) DEFAULT NULL,
  `dHomogen_tanggal` date DEFAULT NULL,
  `vVakum` varchar(500) DEFAULT NULL,
  `vVakum_metoda` varchar(500) DEFAULT NULL,
  `vVakum_mutu` varchar(500) DEFAULT NULL,
  `dVakum_tanggal` date DEFAULT NULL,
  `vLembab` varchar(500) DEFAULT NULL,
  `vLembab_metoda` varchar(500) DEFAULT NULL,
  `vLembab_mutu` varchar(500) DEFAULT NULL,
  `dLembab_tanggal` date DEFAULT NULL,
  `vMurni_apus` varchar(500) DEFAULT NULL,
  `vMurni_37` varchar(500) DEFAULT NULL,
  `vMurni_metoda` varchar(500) DEFAULT NULL,
  `vMurni_mutu` varchar(500) DEFAULT NULL,
  `dMurni_tanggal` date DEFAULT NULL,
  `vSteril_37` varchar(500) DEFAULT NULL,
  `vSteril_22` varchar(500) DEFAULT NULL,
  `vSteril_metoda` varchar(500) DEFAULT NULL,
  `vSteril_mutu` varchar(500) DEFAULT NULL,
  `dSteril_tanggal` date DEFAULT NULL,
  `vDisolasi` varchar(500) DEFAULT NULL,
  `vDisolasi_metoda` varchar(500) DEFAULT NULL,
  `vDisolasi_mutu` varchar(500) DEFAULT NULL,
  `dDisolasi_tanggal` date DEFAULT NULL,
  `vKontaminasi_mico` varchar(500) DEFAULT NULL,
  `vKontaminasi_salmon` varchar(500) DEFAULT NULL,
  `vKontaminasi_jamur` varchar(500) DEFAULT NULL,
  `vKontaminasi_coli` varchar(500) DEFAULT NULL,
  `vKontaminasi_lain` varchar(500) DEFAULT NULL,
  `vKontaminasi_metoda` varchar(500) DEFAULT NULL,
  `vKontaminasi_mutu` varchar(500) DEFAULT NULL,
  `dKontaminasi_tanggal` date DEFAULT NULL,
  `vLain` varchar(500) DEFAULT NULL,
  `vLain_metoda` varchar(500) DEFAULT NULL,
  `vLain_mutu` varchar(500) DEFAULT NULL,
  `dLain_tanggal` date DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt08a_fisik`),
  KEY `iMt05` (`iMt8a`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08a_fisik: ~1 rows (approximately)
DELETE FROM `mt08a_fisik`;
/*!40000 ALTER TABLE `mt08a_fisik` DISABLE KEYS */;
INSERT INTO `mt08a_fisik` (`iMt08a_fisik`, `iMt8a`, `vWarna`, `vWarna_metoda`, `vWarna_mutu`, `dWarna_tanggal`, `vAsing`, `vAsing_metoda`, `vAsing_mutu`, `dAsing_tanggal`, `vHomogen`, `vHomogen_metoda`, `vHomogen_mutu`, `dHomogen_tanggal`, `vVakum`, `vVakum_metoda`, `vVakum_mutu`, `dVakum_tanggal`, `vLembab`, `vLembab_metoda`, `vLembab_mutu`, `dLembab_tanggal`, `vMurni_apus`, `vMurni_37`, `vMurni_metoda`, `vMurni_mutu`, `dMurni_tanggal`, `vSteril_37`, `vSteril_22`, `vSteril_metoda`, `vSteril_mutu`, `dSteril_tanggal`, `vDisolasi`, `vDisolasi_metoda`, `vDisolasi_mutu`, `dDisolasi_tanggal`, `vKontaminasi_mico`, `vKontaminasi_salmon`, `vKontaminasi_jamur`, `vKontaminasi_coli`, `vKontaminasi_lain`, `vKontaminasi_metoda`, `vKontaminasi_mutu`, `dKontaminasi_tanggal`, `vLain`, `vLain_metoda`, `vLain_mutu`, `dLain_tanggal`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 6, 'warna uji', 'warna met', 'warna mut', '2019-04-02', 'asing uji', 'asing met', 'asing mut', '2019-04-02', 'homo uji', 'homo met', 'homo mut', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', 'Lain', 'Lain', '2019-04-02', '2019-04-02', NULL, '2019-04-02 01:30:46', NULL, '2019-04-02 02:48:07', 0);
/*!40000 ALTER TABLE `mt08a_fisik` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08b
CREATE TABLE IF NOT EXISTS `mt08b` (
  `iMt8b` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iKesimpulan` char(50) DEFAULT NULL COMMENT '0:new,1:tms, 2:ms',
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt8b`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08b: ~0 rows (approximately)
DELETE FROM `mt08b`;
/*!40000 ALTER TABLE `mt08b` DISABLE KEYS */;
INSERT INTO `mt08b` (`iMt8b`, `iMt01`, `iSubmit`, `iKesimpulan`, `iApprove_unit_uji`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(8, 2, 1, '2', 2, '2019-04-02 04:35:04', 'A00002', 'mt8b', 'A00002', '2019-04-02 04:34:25', 'A00002', '2019-04-02 04:35:04', 0);
/*!40000 ALTER TABLE `mt08b` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08b_fisik
CREATE TABLE IF NOT EXISTS `mt08b_fisik` (
  `iMt08b_fisik` int(11) NOT NULL AUTO_INCREMENT,
  `iMt8b` int(11) DEFAULT NULL,
  `vKandungan` varchar(500) DEFAULT NULL,
  `vKandungan_metoda` varchar(500) DEFAULT NULL,
  `vKandungan_mutu` varchar(500) DEFAULT NULL,
  `dKandungan_tanggal` date DEFAULT NULL,
  `vIdentitas` varchar(500) DEFAULT NULL,
  `vIdentitas_metoda` varchar(500) DEFAULT NULL,
  `vIdentitas_mutu` varchar(500) DEFAULT NULL,
  `dIdentitas_tanggal` date DEFAULT NULL,
  `vVirus` varchar(500) DEFAULT NULL,
  `vVirus_metoda` varchar(500) DEFAULT NULL,
  `vVirus_mutu` varchar(500) DEFAULT NULL,
  `dVirus_tanggal` date DEFAULT NULL,
  `vInaktivasi_jenis` varchar(500) DEFAULT NULL,
  `vInaktivasi_perlakuan` varchar(500) DEFAULT NULL,
  `vInaktivasi_persen` varchar(500) DEFAULT NULL,
  `vInaktivasi_kontrol` varchar(500) DEFAULT NULL,
  `vInaktivasi_lain` varchar(500) DEFAULT NULL,
  `vInaktivasi_metoda` varchar(500) DEFAULT NULL,
  `vInaktivasi_mutu` varchar(500) DEFAULT NULL,
  `dInaktivasi_tanggal` date DEFAULT NULL,
  `vPotensi` varchar(500) DEFAULT NULL,
  `vPotensi_jenis` varchar(500) DEFAULT NULL,
  `vPotensi_umur` varchar(500) DEFAULT NULL,
  `vPotensi_bb` varchar(500) DEFAULT NULL,
  `vPotensi_perlakuan` varchar(500) DEFAULT NULL,
  `vPotensi_kontrol` varchar(500) DEFAULT NULL,
  `vPotensi_persen` varchar(500) DEFAULT NULL,
  `vPotensi_mdl` varchar(500) DEFAULT NULL,
  `vPotensi_cdl` varchar(500) DEFAULT NULL,
  `vPotensi_metoda` varchar(500) DEFAULT NULL,
  `vPotensi_mutu` varchar(500) DEFAULT NULL,
  `dPotensi_tanggal` date DEFAULT NULL,
  `vPatologi` varchar(500) DEFAULT NULL,
  `vPatologi_jenis` varchar(500) DEFAULT NULL,
  `vPatologi_umur` varchar(500) DEFAULT NULL,
  `vPatologi_bb` varchar(500) DEFAULT NULL,
  `vPatologi_perlakuan` varchar(500) DEFAULT NULL,
  `vPatologi_kontrol` varchar(500) DEFAULT NULL,
  `vPatologi_persen` varchar(500) DEFAULT NULL,
  `vPatologi_mdl` varchar(500) DEFAULT NULL,
  `vPatologi_cdl` varchar(500) DEFAULT NULL,
  `vPatologi_metoda` varchar(500) DEFAULT NULL,
  `vPatologi_mutu` varchar(500) DEFAULT NULL,
  `dPatologi_tanggal` date DEFAULT NULL,
  `vLain` varchar(500) DEFAULT NULL,
  `vLain_metoda` varchar(500) DEFAULT NULL,
  `vLain_mutu` varchar(500) DEFAULT NULL,
  `dLain_tanggal` date DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt08b_fisik`),
  KEY `iMt05` (`iMt8b`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08b_fisik: ~1 rows (approximately)
DELETE FROM `mt08b_fisik`;
/*!40000 ALTER TABLE `mt08b_fisik` DISABLE KEYS */;
INSERT INTO `mt08b_fisik` (`iMt08b_fisik`, `iMt8b`, `vKandungan`, `vKandungan_metoda`, `vKandungan_mutu`, `dKandungan_tanggal`, `vIdentitas`, `vIdentitas_metoda`, `vIdentitas_mutu`, `dIdentitas_tanggal`, `vVirus`, `vVirus_metoda`, `vVirus_mutu`, `dVirus_tanggal`, `vInaktivasi_jenis`, `vInaktivasi_perlakuan`, `vInaktivasi_persen`, `vInaktivasi_kontrol`, `vInaktivasi_lain`, `vInaktivasi_metoda`, `vInaktivasi_mutu`, `dInaktivasi_tanggal`, `vPotensi`, `vPotensi_jenis`, `vPotensi_umur`, `vPotensi_bb`, `vPotensi_perlakuan`, `vPotensi_kontrol`, `vPotensi_persen`, `vPotensi_mdl`, `vPotensi_cdl`, `vPotensi_metoda`, `vPotensi_mutu`, `dPotensi_tanggal`, `vPatologi`, `vPatologi_jenis`, `vPatologi_umur`, `vPatologi_bb`, `vPatologi_perlakuan`, `vPatologi_kontrol`, `vPatologi_persen`, `vPatologi_mdl`, `vPatologi_cdl`, `vPatologi_metoda`, `vPatologi_mutu`, `dPatologi_tanggal`, `vLain`, `vLain_metoda`, `vLain_mutu`, `dLain_tanggal`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(4, 8, 'xxxx', 'xxx', 'xxx', '2019-04-09', 'v', 'v', 'v', '2019-04-02', 'v', 'vv', 'v', '2019-04-22', 'v', 'v', 'v', 'v', NULL, 'v', 'v', '2019-04-02', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', '2019-04-02', 'x', 'c', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'vv', 'v', '2019-04-02', 'v', 'v', 'v', '2019-04-15', NULL, '2019-04-02 04:34:25', NULL, '2019-04-02 04:34:25', 0);
/*!40000 ALTER TABLE `mt08b_fisik` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt09
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

-- Dumping data for table bbpmsoh.mt09: ~0 rows (approximately)
DELETE FROM `mt09`;
/*!40000 ALTER TABLE `mt09` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt09` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_jenis_brosur
CREATE TABLE IF NOT EXISTS `m_jenis_brosur` (
  `iM_jenis_brosur` int(11) NOT NULL AUTO_INCREMENT,
  `vJenis_brosur` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iM_jenis_brosur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.m_jenis_brosur: ~3 rows (approximately)
DELETE FROM `m_jenis_brosur`;
/*!40000 ALTER TABLE `m_jenis_brosur` DISABLE KEYS */;
INSERT INTO `m_jenis_brosur` (`iM_jenis_brosur`, `vJenis_brosur`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Rancangan', 'Jenis Brosur masih rancangan', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(2, 'Asli', 'Brosur yang dikirim adalah asli', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(3, 'Kurang Lengkap', 'masih kurang lengkap', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:13', 0);
/*!40000 ALTER TABLE `m_jenis_brosur` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_jenis_sediaan
CREATE TABLE IF NOT EXISTS `m_jenis_sediaan` (
  `iM_jenis_sediaan` int(11) NOT NULL AUTO_INCREMENT,
  `vJenis_sediaan` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `iNeed_keterangan` tinyint(4) DEFAULT '0',
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iM_jenis_sediaan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.m_jenis_sediaan: ~6 rows (approximately)
DELETE FROM `m_jenis_sediaan`;
/*!40000 ALTER TABLE `m_jenis_sediaan` DISABLE KEYS */;
INSERT INTO `m_jenis_sediaan` (`iM_jenis_sediaan`, `vJenis_sediaan`, `vKeterangan`, `iNeed_keterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Biologik', 'Biologik', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:28', 0),
	(2, 'Farmastetik', 'Farmastetik', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:27', 0),
	(3, 'Premiks', 'Premiks', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:25', 0),
	(4, 'Bahan Baku', 'Bahan Baku', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:24', 0),
	(5, 'Obat Alami', 'Obat Alami', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:22', 0),
	(6, 'Lain - Lain', 'Lain - Lain', 1, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:30', 0);
/*!40000 ALTER TABLE `m_jenis_sediaan` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_tujuan_pengujian
CREATE TABLE IF NOT EXISTS `m_tujuan_pengujian` (
  `iM_tujuan_pengujian` int(11) NOT NULL AUTO_INCREMENT,
  `cKode` char(50) NOT NULL,
  `vNama_tujuan` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `iNeed_keterangan` tinyint(4) DEFAULT '0',
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iM_tujuan_pengujian`),
  UNIQUE KEY `cKode` (`cKode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.m_tujuan_pengujian: ~6 rows (approximately)
DELETE FROM `m_tujuan_pengujian`;
/*!40000 ALTER TABLE `m_tujuan_pengujian` DISABLE KEYS */;
INSERT INTO `m_tujuan_pengujian` (`iM_tujuan_pengujian`, `cKode`, `vNama_tujuan`, `vKeterangan`, `iNeed_keterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'DB', 'Daftar Baru', 'Daftar Baru', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:17', 0),
	(2, 'DU', 'Daftar Ulang', 'Daftar Ulang', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:22', 0),
	(3, 'S', 'Sampling Sewaktu-waktu', 'Sampling Sewaktu-waktu', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:28', 0),
	(4, 'P', 'Pengawasan obat hewan dari dinas terkait', 'Pengawasan obat hewan dari dinas terkait', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:38:18', 0),
	(5, 'KD', 'Kiriman Dinas', 'Kiriman Dinas', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:13', 0),
	(6, 'PT', 'Pelayanan Teknis', 'Pelayanan Teknis', 1, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:22', 0);
/*!40000 ALTER TABLE `m_tujuan_pengujian` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.sysparam
CREATE TABLE IF NOT EXISTS `sysparam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vVariable` varchar(50) DEFAULT NULL,
  `vContent` varchar(50) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.sysparam: ~3 rows (approximately)
DELETE FROM `sysparam`;
/*!40000 ALTER TABLE `sysparam` DISABLE KEYS */;
INSERT INTO `sysparam` (`id`, `vVariable`, `vContent`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'MT01_PENANGGUNG_JAWAB', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:32', 0),
	(2, 'MT02_MANAGER_PUNCAK', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:38', 0),
	(3, 'MT03_TTD', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:07', 0);
/*!40000 ALTER TABLE `sysparam` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
