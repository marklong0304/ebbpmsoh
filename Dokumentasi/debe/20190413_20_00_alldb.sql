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
DROP DATABASE IF EXISTS `bbpmsoh`;
CREATE DATABASE IF NOT EXISTS `bbpmsoh` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bbpmsoh`;

-- Dumping structure for table bbpmsoh.mt01
DROP TABLE IF EXISTS `mt01`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt01: ~11 rows (approximately)
/*!40000 ALTER TABLE `mt01` DISABLE KEYS */;
REPLACE INTO `mt01` (`iMt01`, `vNo_transaksi`, `vNomor`, `vLampiran`, `vPerihal`, `dTanggal`, `iCustomer`, `iType_pemohon`, `vNama_produsen`, `vAlamat_produsen`, `iM_tujuan_pengujian`, `vTujuan_pengujian_ket`, `vNama_sample`, `iM_jenis_sediaan`, `vJenis_sediaan_ket`, `iSudah_beredar`, `vZat_aktif`, `vBatch_lot`, `dTgl_produksi`, `dTgl_kadaluarsa`, `vNo_registrasi`, `vKemasan`, `iJumlah_diserahkan`, `vSuhu_penyimpanan`, `vPermohonan_lampiran`, `dTgl_ambil_sample`, `dTgl_serah_sample`, `vPimpinan_perusahaan`, `lDeleted`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `iStatus_sertifikat`, `iSubmit_sertifikat`, `iSphu_app`, `dSphu_app`, `cSphu_app`, `vSphu_app`, `iTu_app`, `dTu_app`, `cTu_app`, `vTu_app`, `iFa_app`, `dFa_app`, `cFa_app`, `vFa_app`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`) VALUES
	(1, 'R00001', 'aa', 'aa', 'aa', '2019-02-03', 'C00011', 1, 'aa', 'aa', 1, 'a', 'aa', 1, NULL, 1, 'aa', 'aa', '2019-02-03', '2019-02-03', 'aaa', 'aaa', 12, '32', 'ss', '2019-02-03', '2019-02-03', 'Hiro Ahza', 0, 1, 2, '2019-02-23 14:31:53', 'N14615', 'reject', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'C00001', '2019-02-03 22:01:52', 'N14615', '2019-03-31 15:55:20'),
	(2, 'R00002', 'Vitamin', 'Lamp Vit', 'Penggemuk Badan', '2019-02-03', 'C00011', 1, 'PT Langsing', 'Di Kontrakan', 2, 'Tujuannya bikin gemuk', 'Susu Ultra', 1, 'Susu', 1, 'Protein', 'BTCH02x', '2019-02-03', '2019-02-03', 'NOREG0123SA', 'Bottle', 10, '10', 'Bagus', '2019-02-03', '2019-02-03', 'Kora', 0, 1, 2, '2019-02-23 14:02:01', 'N14615', 'approve', 2, 1, 2, '2019-04-07 01:46:47', 'A00005', 'oke lagi', 2, '2019-04-07 01:48:51', 'A00007', 'oke TU', 2, '2019-04-07 01:50:43', 'A00008', 'oke FA', 'C00001', '2019-02-03 22:01:52', 'A00001', '2019-04-07 01:50:43'),
	(3, 'R00003', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:32:30', NULL, '2019-03-31 15:45:52'),
	(4, 'R00004', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 0, 1, 0, NULL, NULL, NULL, 2, 1, 2, '2019-04-01 01:46:04', 'A00005', 'ok', 2, '2019-04-01 02:02:27', 'A00007', 'ok', 2, '2019-04-01 02:04:09', 'A00008', 'sudah dikirim ', 'N14615', '2019-02-12 22:33:54', 'A00001', '2019-04-01 02:04:09'),
	(5, 'R00005', 'No X201231', 'Lampiran B', 'Sample Bahan', '2019-03-16', 'C00011', 1, 'SUP2', 'Jakarta Barat', 5, 'Keterangan', 'Sample Bahan Baku', 4, NULL, 0, 'Zat Aktif', 'BATCH 1', '2019-03-16', '2019-03-16', 'No Reg 2019/dsa', 'Kemasan 01', 100, '30', 'No Subject', '2019-03-21', '2019-03-29', 'Joko Santosa', 0, 1, 2, '2019-03-16 13:34:18', 'N14615', '', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-03-16 13:34:03', 'N14615', '2019-04-05 02:24:18'),
	(6, 'R00006', 'Nomor 1 Message', 'Nomor 1 Message', 'Nomor 1 Message', '2019-04-05', 'C00011', 1, 'Produses', 'Alamat produsennya', 1, 'Nomor 1 Message', 'Sample Okeh', 1, '', 0, 'Nomor 1 Message', 'Nomor 1 Message', '2019-04-05', '2021-04-22', 'Nomor 1 Message', 'Nomor 1 Message', 100, '100', 'okeh', '2019-04-05', '2019-04-05', 'Okeh aja', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'C00011', '2019-04-05 02:00:56', 'C00011', '2019-04-05 02:30:40'),
	(7, 'R00007', '1001', 'Dokumen permohonan', 'Permohonan pengujian ', '2019-04-07', 'C00047', 2, 'Lambo Indo', 'Alamat perusahaan Lambo', 1, 'Baru ', 'Zuk Tayo', 1, '', 0, 'Sianida', 'ECX112KL', '2019-04-07', '2026-04-30', 'Reg110234', 'Botol', 20, '32', 'Surat Jalan', '2019-04-07', '2019-04-07', 'Takada ', 0, 1, 2, '2019-04-07 23:33:55', 'A00001', 'oke', 2, 1, 2, '2019-04-08 02:35:54', 'A00005', 'oke', 2, '2019-04-08 02:36:47', 'A00007', 'oke  tu', 2, '2019-04-08 02:37:43', 'A00008', 'oke', 'A00001', '2019-04-07 23:31:37', 'A00001', '2019-04-08 02:37:43'),
	(8, 'R00008', 'nomor surat terbaru ', 'lampiran terbaru ', 'perihal terbaru ', '2019-04-13', 'C00011', 1, 'PT. HaHa', 'Jakarta', 6, 'keterangan jika pelayanan teknis', 'nama sample terbaru', 6, 'keterangan jika lain lain ', 0, 'plasebo', 'ECX1145', '2019-04-13', '2026-04-11', 'Reg 001', 'Kapsul', 10, '32', 'surat', '2019-04-13', '2019-04-13', 'Okeh Pimpinan', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-04-13 15:54:32', NULL, '2019-04-13 15:54:32'),
	(9, 'R00009', 'Nomor dengan file', 'lampiran dengan upload', 'ada upload ', '2019-04-13', 'C00011', 1, 'PT. HaHa', 'Jakarta', 1, '', 'dengan upload ', 1, '', 0, 'plasebo juga', 'EDB002', '2019-04-13', '2019-04-13', 'Kementan Registrasi Nomor', 'kotak', 100, '23', 'apa aja', '2019-04-13', '2019-04-13', 'Joni Ande', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-04-13 16:02:25', NULL, '2019-04-13 16:02:25'),
	(10, 'R00010', 'draft dengan file', 'draft dengan file', 'draft dengan file', '2019-04-13', 'C00006', 1, 'PT. WOKE', 'Jakarta', 1, '', 'draft dengan file', 4, '', 0, 'draft dengan file', 'draft dengan file', '2019-04-13', '2019-04-13', 'draft dengan file', 'draft dengan file', 10, '100', 'draft dengan file', '2019-04-13', '2019-04-13', 'draft dengan file', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-04-13 16:11:39', NULL, '2019-04-13 16:11:40'),
	(11, 'R00011', 'coba draft submit', 'coba draft submit', 'coba draft submit', '2019-04-13', 'C00011', 1, 'PT. HaHa', 'Jakarta', 5, '', 'coba draft submit', 1, '', 0, 'coba draft submit', 'coba draft submit', '2019-04-13', '2019-04-13', 'coba draft submit', 'coba draft submit', 11, 'coba draft submit', 'coba draft submit', '2019-04-13', '2019-04-13', 'coba draft submit', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-04-13 16:15:56', NULL, '2019-04-13 16:15:57'),
	(12, 'R00012', 'coba draft lagi ', 'coba draft lagi ', 'coba draft lagi ', '2019-04-13', 'C00013', 2, 'PT. WAW', 'Jakarta', 5, '', 'coba draft lagi ', 4, '', 2, 'coba draft lagi ', 'coba draft lagi ', '2019-04-13', '2025-04-12', 'coba draft lagi ', 'coba draft lagi ', 11, 'coba draft lagi ', 'coba draft lagi ', '2019-04-13', '2019-04-13', 'coba draft lagi ', 0, 1, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'A00001', '2019-04-13 16:18:31', 'A00001', '2019-04-13 16:18:43');
/*!40000 ALTER TABLE `mt01` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt01_file
DROP TABLE IF EXISTS `mt01_file`;
CREATE TABLE IF NOT EXISTS `mt01_file` (
  `ifile_mt01` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vFilename` varchar(255) DEFAULT NULL,
  `vFilename_generate` varchar(255) DEFAULT NULL,
  `vKeterangan` text,
  `cCreate` char(50) DEFAULT NULL,
  `dCreate` datetime DEFAULT NULL,
  `cUpdate` char(50) DEFAULT NULL,
  `dUpdate` datetime DEFAULT NULL,
  `lDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`ifile_mt01`),
  KEY `lDeleted` (`lDeleted`),
  KEY `iMt03` (`iMt01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt01_file: ~4 rows (approximately)
/*!40000 ALTER TABLE `mt01_file` DISABLE KEYS */;
REPLACE INTO `mt01_file` (`ifile_mt01`, `iMt01`, `vFilename`, `vFilename_generate`, `vKeterangan`, `cCreate`, `dCreate`, `cUpdate`, `dUpdate`, `lDeleted`) VALUES
	(1, 9, 'Penguins.jpg', '0__2019_04_13__16_02_30__Penguins.jpg', 'pinguin ', 'A00001', '2019-04-13 16:02:30', NULL, NULL, 0),
	(2, 10, 'Tulips.jpg', '0__2019_04_13__16_11_44__Tulips.jpg', 'tulips', 'A00001', '2019-04-13 16:11:44', NULL, NULL, 0),
	(3, 11, 'Desert.jpg', '0__2019_04_13__16_16_01__Desert.jpg', 'coba draft submit', 'A00001', '2019-04-13 16:16:01', NULL, NULL, 0),
	(4, 12, 'Koala.jpg', '0__2019_04_13__16_18_32__Koala.jpg', 'rerere', 'A00001', '2019-04-13 16:18:32', NULL, NULL, 0);
/*!40000 ALTER TABLE `mt01_file` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt02
DROP TABLE IF EXISTS `mt02`;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt02: ~4 rows (approximately)
/*!40000 ALTER TABLE `mt02` DISABLE KEYS */;
REPLACE INTO `mt02` (`iMt02`, `iMt01`, `dTgl_Kontrak`, `p1_nama`, `p1_jabatan`, `p1_perusahaan`, `p1_alamat`, `p1_an`, `p2_nama`, `p2_jabatan`, `vNama_sample`, `vAcuan_metode_uji`, `vKeterangan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, '2019-02-03', 'Pihak 1', 'Manager', 'Okeh Aja', 'Okeh Lagi', 'Pihak 1', 'Manager Mutu', 'Manager Mutu', 'Okeh', 'Kadar', 'uji kadar', 1, 2, '2019-03-17 10:27:10', 'N14615', 'approve', 'A00001', '2019-02-03 22:16:24', 'N14615', '2019-03-17 10:27:10', 0),
	(2, 2, '2019-03-29', 'Pihak1', 'Manager 1', 'PT Maju 1', 'Jakarta Barat', 'Manager Baru', 'PT Oke', 'Asisten', 'PT Langsing', 'Daftar Ulang', 'OKE', 1, 2, '2019-03-16 23:12:27', 'N14615', '', 'N14615', '2019-03-16 22:32:54', 'N14615', '2019-03-16 23:12:27', 0),
	(3, 5, '2019-03-31', 'Nama dari Dinas', 'Kepala', 'Dinas Oke', 'Okeh', 'An Kepala', 'Nama dari Customer', 'Direksi', 'SUP2', 'Kiriman Dinas', 'Oke', 1, 2, '2019-03-31 16:27:52', 'C00011', 'oke', 'A00001', '2019-03-31 16:10:03', 'C00011', '2019-03-31 16:27:52', 0),
	(4, 7, '2019-04-07', 'Deru Siga', 'Manager Busdev', 'Lambo Indo', 'Alamat perusahaan Lambo', 'Deru Siga', 'Pihak Instansi', 'Ka Pengujian', 'Zuk Tayo', 'Sesuai Standar', 'Oke', 1, 2, '2019-04-07 23:55:08', 'C00047', 'okeh aja', 'A00001', '2019-04-07 23:52:17', 'C00047', '2019-04-07 23:55:08', 0);
/*!40000 ALTER TABLE `mt02` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt02_detail
DROP TABLE IF EXISTS `mt02_detail`;
CREATE TABLE IF NOT EXISTS `mt02_detail` (
  `iMt02_detail` int(11) NOT NULL AUTO_INCREMENT,
  `iMt02` int(11) DEFAULT NULL,
  `vNama_sample` varchar(150) DEFAULT NULL,
  `vAcuan_metode_uji` varchar(100) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt02_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='// still not use, \r\ninfomasi yang diterima adalah , hanya 1 sample di setiap req pengujian\r\n';

-- Dumping data for table bbpmsoh.mt02_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt02_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt02_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt03
DROP TABLE IF EXISTS `mt03`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt03: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt03` DISABLE KEYS */;
REPLACE INTO `mt03` (`iMt03`, `iMt01`, `vnomor_03`, `dtanggal_03`, `iAda_batch`, `vBatch`, `iTgl_expired`, `dTgl_expired`, `iEtiket_brosur`, `vEtiket_brosur`, `iM_jenis_brosur`, `iReq_permohonan`, `iPengantar_direktorat`, `iHasil_ppoh`, `iBahan_standard`, `tCatatan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `vCatatan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 2, 'xx', '2019-03-31', 0, 'xxx', 0, '2019-03-31', NULL, 'xxxxx', 2, 0, 0, 0, 0, 'xxxxxx', 1, 0, NULL, NULL, NULL, NULL, 'A00001', '2019-03-31 21:51:54', 'A00001', '2019-03-31 21:56:38', 0),
	(3, 7, '003-112-789', '2019-04-08', 1, 'ECBB001', 1, '2019-04-08', NULL, 'Oke', 2, 1, 1, 1, 1, 'Catatan dari sana', 1, 2, '2019-04-08 00:03:38', 'A00001', 'oke dari MT01', NULL, 'A00001', '2019-04-08 00:03:25', 'A00001', '2019-04-08 00:03:38', 0);
/*!40000 ALTER TABLE `mt03` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt03_file
DROP TABLE IF EXISTS `mt03_file`;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt03_file: ~4 rows (approximately)
/*!40000 ALTER TABLE `mt03_file` DISABLE KEYS */;
REPLACE INTO `mt03_file` (`ifile_mt03`, `iMt03`, `vFilename`, `vFilename_generate`, `vKeterangan`, `cCreate`, `dCreate`, `cUpdate`, `dUpdate`, `lDeleted`) VALUES
	(5, 2, 'a4.pdf', '0__2019_03_31__21_52_00__a4.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(6, 2, 'A4langsung.pdf', '1__2019_03_31__21_52_00__A4langsung.pdf', 'xxxx', 'A00001', '2019-03-31 21:52:00', NULL, NULL, 0),
	(7, 2, 'Manual Book SiiPLAH untuk Admin ESELON 1.pdf', '0__2019_03_31__21_56_44__Manual Book SiiPLAH untuk Admin ESELON 1.pdf', 'ssss', 'A00001', '2019-03-31 21:56:44', NULL, NULL, 0),
	(8, 3, 'a4.pdf', '0__2019_04_08__00_03_27__a4.pdf', 'oke', 'A00001', '2019-04-08 00:03:27', NULL, NULL, 0);
/*!40000 ALTER TABLE `mt03_file` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt04
DROP TABLE IF EXISTS `mt04`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt04: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt04` DISABLE KEYS */;
REPLACE INTO `mt04` (`iMt04`, `iMt01`, `vNama_sample`, `vNama_perusahaan`, `vAlamat_perusahaan`, `vTelepon_perusahaan`, `dTgl_terima_sample`, `dTgl_terima_serum`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, '5', 'Sample oke', 'Nama Perusah', 'Alamat', 'telepon', '2019-03-31', '2019-03-31', 0, 0, NULL, NULL, NULL, NULL, '2019-03-31 17:32:52', 'A00001', '2019-04-07 00:38:59', 0),
	(3, '7', 'Zuk Tayo', 'Lambo Indo', 'Alamat perusahaan Lambo', '021113456', '2019-04-08', '2019-04-08', 1, 2, '2019-04-08 00:13:32', 'A00001', 'oke aja', 'A00001', '2019-04-08 00:13:03', 'A00001', '2019-04-08 00:13:32', 0);
/*!40000 ALTER TABLE `mt04` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt04_detail
DROP TABLE IF EXISTS `mt04_detail`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='\r\n';

-- Dumping data for table bbpmsoh.mt04_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt04_detail` DISABLE KEYS */;
REPLACE INTO `mt04_detail` (`iMt04_detail`, `iMt04`, `vAntiserum`, `vKadar`, `vAsal`, `vBatch`, `dTgl_expired`, `vJumlah`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 2, 'sasasa', 'sasasa', 'asas', 'sasa', '2019-01-20', 'asasa', 'sasas', 'A00001', '2019-04-07 00:39:00', NULL, '2019-04-07 00:39:33', 0),
	(2, 3, 'Serum Oke', 'Serum Oke', 'Indonesia', 'ECX0001', '2022-01-01', '100', 'Buatan jateng', 'A00001', '2019-04-08 00:13:03', NULL, '2019-04-08 00:13:03', 0);
/*!40000 ALTER TABLE `mt04_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt05
DROP TABLE IF EXISTS `mt05`;
CREATE TABLE IF NOT EXISTS `mt05` (
  `iMt05` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `dTgl_penerimaan` date DEFAULT NULL COMMENT 'tanggal penerimaan',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt05: ~1 rows (approximately)
/*!40000 ALTER TABLE `mt05` DISABLE KEYS */;
REPLACE INTO `mt05` (`iMt05`, `iMt01`, `vKepada_yth`, `vAlamat`, `dTgl_penerimaan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 7, 'Deru Siga', 'Alamat deru', '2019-04-13', 1, 2, '2019-04-13 18:41:42', 'A00001', 'test notif\r\n', 'A00001', '2019-04-13 18:12:12', 'A00001', '2019-04-13 18:41:42', 0);
/*!40000 ALTER TABLE `mt05` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt05_detail
DROP TABLE IF EXISTS `mt05_detail`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='dibuat detail untuk jaga2 karena bisa saja tanda terima sample dari beberapa request.\r\njika tidak jadi dibuat banyak, maka validasi di button add row saja\r\n';

-- Dumping data for table bbpmsoh.mt05_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt05_detail` DISABLE KEYS */;
REPLACE INTO `mt05_detail` (`iMt05_detail`, `iMt05`, `iMt01`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 7, 'A00001', '2019-04-08 01:01:01', NULL, '2019-04-13 18:09:27', 1),
	(2, 2, 7, 'A00001', '2019-04-13 18:12:12', NULL, '2019-04-13 18:12:12', 0);
/*!40000 ALTER TABLE `mt05_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt06
DROP TABLE IF EXISTS `mt06`;
CREATE TABLE IF NOT EXISTS `mt06` (
  `iMt06` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `iDist_virologi` int(11) DEFAULT '0',
  `iDist_bakteri` int(11) DEFAULT '0',
  `iDist_farmastetik` int(11) DEFAULT '0',
  `iDist_patologi` int(11) DEFAULT '0',
  `vKeterangan_06` text,
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
/*!40000 ALTER TABLE `mt06` DISABLE KEYS */;
REPLACE INTO `mt06` (`iMt06`, `iMt01`, `vKepada_yth`, `vAlamat`, `iDist_virologi`, `iDist_bakteri`, `iDist_farmastetik`, `iDist_patologi`, `vKeterangan_06`, `iSubmit`, `iApprove_sphu`, `dApprove_sphu`, `cApprove_sphu`, `vRemark_sphu`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 7, 'Deru Siga', 'Alamat deru', 1, 1, 1, 0, NULL, 1, 2, '2019-04-08 01:35:43', 'A00001', 'oke', 0, NULL, NULL, NULL, 'A00001', '2019-04-08 01:23:07', 'A00001', '2019-04-13 18:49:04', 0);
/*!40000 ALTER TABLE `mt06` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt07
DROP TABLE IF EXISTS `mt07`;
CREATE TABLE IF NOT EXISTS `mt07` (
  `iMt07` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
  `vAlamat` text,
  `vSuhu_penyimpanan` varchar(50) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
  `dTanggal` date DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `vKeterangan_07` text,
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
/*!40000 ALTER TABLE `mt07` DISABLE KEYS */;
REPLACE INTO `mt07` (`iMt07`, `iMt01`, `vKepada_yth`, `vAlamat`, `vSuhu_penyimpanan`, `vKeterangan`, `dTanggal`, `iSubmit`, `vKeterangan_07`, `iApprove_unit_uji`, `dApprove_unit_uji`, `cApprove_unit_uji`, `vRemark_unit_uji`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 7, 'Deru Siga', 'Alamat deru', '32', 'okeh', NULL, 1, NULL, 2, '2019-04-08 01:45:44', 'A00001', 'oke ', 0, NULL, NULL, NULL, 'A00001', '2019-04-08 01:43:01', 'A00001', '2019-04-13 18:51:53', 1);
/*!40000 ALTER TABLE `mt07` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt074_header
DROP TABLE IF EXISTS `mt074_header`;
CREATE TABLE IF NOT EXISTS `mt074_header` (
  `iMt074` int(11) NOT NULL AUTO_INCREMENT,
  `iHeader` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak,1=Iya',
  `iParent` int(11) NOT NULL DEFAULT '0',
  `vUraian` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iMt074`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt074_header: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt074_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt074_header` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08
DROP TABLE IF EXISTS `mt08`;
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
/*!40000 ALTER TABLE `mt08` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt08` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08a
DROP TABLE IF EXISTS `mt08a`;
CREATE TABLE IF NOT EXISTS `mt08a` (
  `iMt8a` int(11) NOT NULL AUTO_INCREMENT,
  `vNama_sample` varchar(500) NOT NULL DEFAULT '0',
  `iMt01` int(11) DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iKesimpulan` char(50) DEFAULT NULL COMMENT '0:new,1:tms, 2:ms',
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `iApprove_qa` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_qa` datetime DEFAULT NULL,
  `cApprove_qa` varchar(50) DEFAULT NULL,
  `vRemark_qa` varchar(500) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt8a`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08a: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt08a` DISABLE KEYS */;
REPLACE INTO `mt08a` (`iMt8a`, `vNama_sample`, `iMt01`, `iSubmit`, `iKesimpulan`, `iApprove_unit_uji`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `iApprove_qa`, `dApprove_qa`, `cApprove_qa`, `vRemark_qa`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(6, '0', 2, 1, '2', 2, '2019-04-02 02:55:24', 'A00003', 'oke approve', 'A00003', 2, '2019-04-07 02:17:14', 'A00032', 'oke QA', '2019-04-02 01:30:46', 'A00032', '2019-04-07 02:17:14', 0),
	(7, '0', 7, 1, '2', 2, '2019-04-08 02:23:19', 'A00001', 'yanji dulu', 'A00002', 2, '2019-04-08 02:29:47', 'A00032', 'oke', '2019-04-08 02:02:19', 'A00032', '2019-04-13 19:32:23', 0);
/*!40000 ALTER TABLE `mt08a` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08a_fisik
DROP TABLE IF EXISTS `mt08a_fisik`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08a_fisik: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt08a_fisik` DISABLE KEYS */;
REPLACE INTO `mt08a_fisik` (`iMt08a_fisik`, `iMt8a`, `vWarna`, `vWarna_metoda`, `vWarna_mutu`, `dWarna_tanggal`, `vAsing`, `vAsing_metoda`, `vAsing_mutu`, `dAsing_tanggal`, `vHomogen`, `vHomogen_metoda`, `vHomogen_mutu`, `dHomogen_tanggal`, `vVakum`, `vVakum_metoda`, `vVakum_mutu`, `dVakum_tanggal`, `vLembab`, `vLembab_metoda`, `vLembab_mutu`, `dLembab_tanggal`, `vMurni_apus`, `vMurni_37`, `vMurni_metoda`, `vMurni_mutu`, `dMurni_tanggal`, `vSteril_37`, `vSteril_22`, `vSteril_metoda`, `vSteril_mutu`, `dSteril_tanggal`, `vDisolasi`, `vDisolasi_metoda`, `vDisolasi_mutu`, `dDisolasi_tanggal`, `vKontaminasi_mico`, `vKontaminasi_salmon`, `vKontaminasi_jamur`, `vKontaminasi_coli`, `vKontaminasi_lain`, `vKontaminasi_metoda`, `vKontaminasi_mutu`, `dKontaminasi_tanggal`, `vLain`, `vLain_metoda`, `vLain_mutu`, `dLain_tanggal`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(2, 6, 'warna uji', 'warna met', 'warna mut', '2019-04-02', 'asing uji', 'asing met', 'asing mut', '2019-04-02', 'homo uji', 'homo met', 'homo mut', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', '2019-04-02', 'Lain', 'Lain', '2019-04-02', '2019-04-02', NULL, '2019-04-02 01:30:46', NULL, '2019-04-02 02:48:07', 0),
	(3, 7, 'b', 'b', 'b', '2019-04-08', 'bb', 'b', 'b', '2019-04-08', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', 'b', 'b', 'b', 'b', '2019-04-08', 'b', 'b', 'b', '2019-04-08', NULL, '2019-04-08 02:02:19', NULL, '2019-04-08 02:02:19', 0);
/*!40000 ALTER TABLE `mt08a_fisik` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08b
DROP TABLE IF EXISTS `mt08b`;
CREATE TABLE IF NOT EXISTS `mt08b` (
  `iMt8b` int(11) NOT NULL AUTO_INCREMENT,
  `vNama_sample` varchar(500) NOT NULL DEFAULT '0',
  `iMt01` int(11) DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `iKesimpulan` char(50) DEFAULT NULL COMMENT '0:new,1:tms, 2:ms',
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `iApprove_qa` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_qa` datetime DEFAULT NULL,
  `cApprove_qa` varchar(50) DEFAULT NULL,
  `vRemark_qa` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt8b`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08b: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt08b` DISABLE KEYS */;
REPLACE INTO `mt08b` (`iMt8b`, `vNama_sample`, `iMt01`, `iSubmit`, `iKesimpulan`, `iApprove_unit_uji`, `dApprove`, `cApprove`, `vRemark`, `iApprove_qa`, `dApprove_qa`, `cApprove_qa`, `vRemark_qa`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(8, '0', 2, 1, '2', 2, '2019-04-02 04:35:04', 'A00002', 'mt8b', 2, '2019-04-07 02:36:59', 'A00032', 'app qa', 'A00002', '2019-04-02 04:34:25', 'A00032', '2019-04-07 02:36:59', 0),
	(9, '0', 7, 1, '2', 2, '2019-04-08 02:26:29', 'A00001', 'ok', 2, '2019-04-08 02:11:56', 'A00032', 'langsung reload', 'A00003', '2019-04-08 02:01:39', 'A00001', '2019-04-13 19:26:53', 0);
/*!40000 ALTER TABLE `mt08b` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08b_fisik
DROP TABLE IF EXISTS `mt08b_fisik`;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08b_fisik: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt08b_fisik` DISABLE KEYS */;
REPLACE INTO `mt08b_fisik` (`iMt08b_fisik`, `iMt8b`, `vKandungan`, `vKandungan_metoda`, `vKandungan_mutu`, `dKandungan_tanggal`, `vIdentitas`, `vIdentitas_metoda`, `vIdentitas_mutu`, `dIdentitas_tanggal`, `vVirus`, `vVirus_metoda`, `vVirus_mutu`, `dVirus_tanggal`, `vInaktivasi_jenis`, `vInaktivasi_perlakuan`, `vInaktivasi_persen`, `vInaktivasi_kontrol`, `vInaktivasi_lain`, `vInaktivasi_metoda`, `vInaktivasi_mutu`, `dInaktivasi_tanggal`, `vPotensi`, `vPotensi_jenis`, `vPotensi_umur`, `vPotensi_bb`, `vPotensi_perlakuan`, `vPotensi_kontrol`, `vPotensi_persen`, `vPotensi_mdl`, `vPotensi_cdl`, `vPotensi_metoda`, `vPotensi_mutu`, `dPotensi_tanggal`, `vPatologi`, `vPatologi_jenis`, `vPatologi_umur`, `vPatologi_bb`, `vPatologi_perlakuan`, `vPatologi_kontrol`, `vPatologi_persen`, `vPatologi_mdl`, `vPatologi_cdl`, `vPatologi_metoda`, `vPatologi_mutu`, `dPatologi_tanggal`, `vLain`, `vLain_metoda`, `vLain_mutu`, `dLain_tanggal`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(4, 8, 'xxxx', 'xxx', 'xxx', '2019-04-09', 'v', 'v', 'v', '2019-04-02', 'v', 'vv', 'v', '2019-04-22', 'v', 'v', 'v', 'v', NULL, 'v', 'v', '2019-04-02', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', '2019-04-02', 'x', 'c', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'vv', 'v', '2019-04-02', 'v', 'v', 'v', '2019-04-15', NULL, '2019-04-02 04:34:25', NULL, '2019-04-02 04:34:25', 0),
	(5, 9, 'c', 'c', 'c', '2019-04-08', 'b', 'b', 'b', '2019-04-08', 'v', 'v', 'v', '2019-04-08', 'v', 'v', 'v', 'v', NULL, 'v', 'v', '2019-04-08', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'bb', 'b', 'b', 'b', '2019-04-08', 'c', 'c', 'c', 'c', 'c', 'v', 'v', 'v', 'v', 'v', 'v', '2019-04-08', 'v', 'v', 'v', '2019-04-08', NULL, '2019-04-08 02:01:39', NULL, '2019-04-08 02:01:39', 0);
/*!40000 ALTER TABLE `mt08b_fisik` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt09
DROP TABLE IF EXISTS `mt09`;
CREATE TABLE IF NOT EXISTS `mt09` (
  `iMt09` int(11) NOT NULL AUTO_INCREMENT,
  `vNama_sample` varchar(500) NOT NULL DEFAULT '0',
  `iMt01` int(11) DEFAULT NULL,
  `iSubmit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status Submit',
  `vKomposisi` text COMMENT 'komposisi zat aktif',
  `iKesimpulan` char(50) DEFAULT NULL COMMENT '0:new,1:tms, 2:ms',
  `iKesimpulan_khusus` char(50) DEFAULT NULL,
  `iApprove_unit_uji` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove` datetime DEFAULT NULL,
  `cApprove` varchar(50) DEFAULT NULL,
  `vRemark` varchar(500) DEFAULT NULL,
  `iApprove_qa` tinyint(1) NOT NULL DEFAULT '0',
  `dApprove_qa` datetime DEFAULT NULL,
  `cApprove_qa` varchar(50) DEFAULT NULL,
  `vRemark_qa` varchar(500) DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt09`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt09: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt09` DISABLE KEYS */;
REPLACE INTO `mt09` (`iMt09`, `vNama_sample`, `iMt01`, `iSubmit`, `vKomposisi`, `iKesimpulan`, `iKesimpulan_khusus`, `iApprove_unit_uji`, `dApprove`, `cApprove`, `vRemark`, `iApprove_qa`, `dApprove_qa`, `cApprove_qa`, `vRemark_qa`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(8, '0', 2, 1, 'xxx', '2', '2', 2, '2019-04-07 01:21:06', 'A0001', 'oke', 0, NULL, NULL, NULL, 'A00004', '2019-04-02 06:43:32', 'A00004', '2019-04-07 02:29:38', 0),
	(9, '0', 7, 1, 'Sianida', '2', '2', 2, '2019-04-08 02:29:16', 'A00001', 'coba lago', 2, '2019-04-08 02:30:52', 'A00032', 'oke', 'A00004', '2019-04-08 01:56:47', 'A00032', '2019-04-13 19:34:06', 0);
/*!40000 ALTER TABLE `mt09` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt09_fisik
DROP TABLE IF EXISTS `mt09_fisik`;
CREATE TABLE IF NOT EXISTS `mt09_fisik` (
  `iMt09_fisik` int(11) NOT NULL AUTO_INCREMENT,
  `iMt09` int(11) DEFAULT NULL,
  `vWarna` varchar(500) DEFAULT NULL,
  `vWarna_metoda` varchar(500) DEFAULT NULL,
  `vWarna_mutu` varchar(500) DEFAULT NULL,
  `dWarna_tanggal` date DEFAULT NULL,
  `vAsing` varchar(500) DEFAULT NULL,
  `vAsing_metoda` varchar(500) DEFAULT NULL,
  `vAsing_mutu` varchar(500) DEFAULT NULL,
  `dAsing_tanggal` date DEFAULT NULL,
  `vKelarutan` varchar(500) DEFAULT NULL,
  `vKelarutan_metoda` varchar(500) DEFAULT NULL,
  `vKelarutan_mutu` varchar(500) DEFAULT NULL,
  `dKelarutan_tanggal` date DEFAULT NULL,
  `vSeragam` varchar(500) DEFAULT NULL,
  `vSeragam_metoda` varchar(500) DEFAULT NULL,
  `vSeragam_mutu` varchar(500) DEFAULT NULL,
  `dSeragam_tanggal` date DEFAULT NULL,
  `vLembab` varchar(500) DEFAULT NULL,
  `vLembab_metoda` varchar(500) DEFAULT NULL,
  `vLembab_mutu` varchar(500) DEFAULT NULL,
  `dLembab_tanggal` date DEFAULT NULL,
  `vIdentitas` varchar(500) DEFAULT NULL,
  `vIdentitas_metoda` varchar(500) DEFAULT NULL,
  `vIdentitas_mutu` varchar(500) DEFAULT NULL,
  `dIdentitas_tanggal` date DEFAULT NULL,
  `vSteril37` varchar(500) DEFAULT NULL,
  `vSteril37_metoda` varchar(500) DEFAULT NULL,
  `vSteril37_mutu` varchar(500) DEFAULT NULL,
  `dSteril37_tanggal` date DEFAULT NULL,
  `vSteril22` varchar(500) DEFAULT NULL,
  `vSteril22_metoda` varchar(500) DEFAULT NULL,
  `vSteril22_mutu` varchar(500) DEFAULT NULL,
  `dSteril22_tanggal` date DEFAULT NULL,
  `vKontaminasi` varchar(500) DEFAULT NULL,
  `vKontaminasi_metoda` varchar(500) DEFAULT NULL,
  `vKontaminasi_mutu` varchar(500) DEFAULT NULL,
  `dKontaminasi_tanggal` date DEFAULT NULL,
  `vColi` varchar(500) DEFAULT NULL,
  `vColi_metoda` varchar(500) DEFAULT NULL,
  `vColi_mutu` varchar(500) DEFAULT NULL,
  `dColi_tanggal` date DEFAULT NULL,
  `vSalmon` varchar(500) DEFAULT NULL,
  `vSalmon_metoda` varchar(500) DEFAULT NULL,
  `vSalmon_mutu` varchar(500) DEFAULT NULL,
  `dSalmon_tanggal` date DEFAULT NULL,
  `vPh` varchar(500) DEFAULT NULL,
  `vPh_metoda` varchar(500) DEFAULT NULL,
  `vPh_mutu` varchar(500) DEFAULT NULL,
  `dPh_tanggal` date DEFAULT NULL,
  `vToksis` varchar(500) DEFAULT NULL,
  `vToksis_metoda` varchar(500) DEFAULT NULL,
  `vToksis_mutu` varchar(500) DEFAULT NULL,
  `dToksis_tanggal` date DEFAULT NULL,
  `vPirogen` varchar(500) DEFAULT NULL,
  `vPirogen_metoda` varchar(500) DEFAULT NULL,
  `vPirogen_mutu` varchar(500) DEFAULT NULL,
  `dPirogen_tanggal` date DEFAULT NULL,
  `vPotensi_object` varchar(500) DEFAULT NULL,
  `vPotensi` varchar(500) DEFAULT NULL,
  `vPotensi_metoda` varchar(500) DEFAULT NULL,
  `vPotensi_mutu` varchar(500) DEFAULT NULL,
  `dPotensi_tanggal` date DEFAULT NULL,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iMt09_fisik`),
  KEY `iMt05` (`iMt09`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt09_fisik: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt09_fisik` DISABLE KEYS */;
REPLACE INTO `mt09_fisik` (`iMt09_fisik`, `iMt09`, `vWarna`, `vWarna_metoda`, `vWarna_mutu`, `dWarna_tanggal`, `vAsing`, `vAsing_metoda`, `vAsing_mutu`, `dAsing_tanggal`, `vKelarutan`, `vKelarutan_metoda`, `vKelarutan_mutu`, `dKelarutan_tanggal`, `vSeragam`, `vSeragam_metoda`, `vSeragam_mutu`, `dSeragam_tanggal`, `vLembab`, `vLembab_metoda`, `vLembab_mutu`, `dLembab_tanggal`, `vIdentitas`, `vIdentitas_metoda`, `vIdentitas_mutu`, `dIdentitas_tanggal`, `vSteril37`, `vSteril37_metoda`, `vSteril37_mutu`, `dSteril37_tanggal`, `vSteril22`, `vSteril22_metoda`, `vSteril22_mutu`, `dSteril22_tanggal`, `vKontaminasi`, `vKontaminasi_metoda`, `vKontaminasi_mutu`, `dKontaminasi_tanggal`, `vColi`, `vColi_metoda`, `vColi_mutu`, `dColi_tanggal`, `vSalmon`, `vSalmon_metoda`, `vSalmon_mutu`, `dSalmon_tanggal`, `vPh`, `vPh_metoda`, `vPh_mutu`, `dPh_tanggal`, `vToksis`, `vToksis_metoda`, `vToksis_mutu`, `dToksis_tanggal`, `vPirogen`, `vPirogen_metoda`, `vPirogen_mutu`, `dPirogen_tanggal`, `vPotensi_object`, `vPotensi`, `vPotensi_metoda`, `vPotensi_mutu`, `dPotensi_tanggal`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(4, 8, 'xxx', 'xxx', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-16', 'x', 'x', 'x', '2019-04-17', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '0000-00-00', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', '2019-04-02', 'x', 'x', 'x', 'x', '2019-04-02', NULL, '2019-04-02 06:43:32', NULL, '2019-04-02 06:43:32', 0),
	(5, 9, 'Sianida', 'Sianida', 'n', '2019-04-08', 'nm', 'm', 'm', '2019-04-08', 'mm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', '2019-04-08', 'm', 'm', 'm', 'm', '2019-04-08', NULL, '2019-04-08 01:56:47', NULL, '2019-04-08 01:56:47', 0);
/*!40000 ALTER TABLE `mt09_fisik` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt09_old
DROP TABLE IF EXISTS `mt09_old`;
CREATE TABLE IF NOT EXISTS `mt09_old` (
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

-- Dumping data for table bbpmsoh.mt09_old: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt09_old` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt09_old` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_jenis_brosur
DROP TABLE IF EXISTS `m_jenis_brosur`;
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
/*!40000 ALTER TABLE `m_jenis_brosur` DISABLE KEYS */;
REPLACE INTO `m_jenis_brosur` (`iM_jenis_brosur`, `vJenis_brosur`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Rancangan', 'Jenis Brosur masih rancangan', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(2, 'Asli', 'Brosur yang dikirim adalah asli', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(3, 'Kurang Lengkap', 'masih kurang lengkap', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:13', 0);
/*!40000 ALTER TABLE `m_jenis_brosur` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_jenis_sediaan
DROP TABLE IF EXISTS `m_jenis_sediaan`;
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
/*!40000 ALTER TABLE `m_jenis_sediaan` DISABLE KEYS */;
REPLACE INTO `m_jenis_sediaan` (`iM_jenis_sediaan`, `vJenis_sediaan`, `vKeterangan`, `iNeed_keterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Biologik', 'Biologik', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:28', 0),
	(2, 'Farmastetik', 'Farmastetik', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:27', 0),
	(3, 'Premiks', 'Premiks', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:25', 0),
	(4, 'Bahan Baku', 'Bahan Baku', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:24', 0),
	(5, 'Obat Alami', 'Obat Alami', 0, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:22', 0),
	(6, 'Lain - Lain', 'Lain - Lain', 1, 'N14615', '2019-02-03 21:59:24', NULL, '2019-02-03 22:00:30', 0);
/*!40000 ALTER TABLE `m_jenis_sediaan` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.m_tujuan_pengujian
DROP TABLE IF EXISTS `m_tujuan_pengujian`;
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
/*!40000 ALTER TABLE `m_tujuan_pengujian` DISABLE KEYS */;
REPLACE INTO `m_tujuan_pengujian` (`iM_tujuan_pengujian`, `cKode`, `vNama_tujuan`, `vKeterangan`, `iNeed_keterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'DB', 'Daftar Baru', 'Daftar Baru', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:17', 0),
	(2, 'DU', 'Daftar Ulang', 'Daftar Ulang', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:22', 0),
	(3, 'S', 'Sampling Sewaktu-waktu', 'Sampling Sewaktu-waktu', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:37:28', 0),
	(4, 'P', 'Pengawasan obat hewan dari dinas terkait', 'Pengawasan obat hewan dari dinas terkait', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:38:18', 0),
	(5, 'KD', 'Kiriman Dinas', 'Kiriman Dinas', 0, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:13', 0),
	(6, 'PT', 'Pelayanan Teknis', 'Pelayanan Teknis', 1, 'N14615', '2019-02-03 21:57:21', NULL, '2019-02-10 16:39:22', 0);
/*!40000 ALTER TABLE `m_tujuan_pengujian` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.sysparam
DROP TABLE IF EXISTS `sysparam`;
CREATE TABLE IF NOT EXISTS `sysparam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vVariable` varchar(50) DEFAULT NULL,
  `vContent` text,
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.sysparam: ~12 rows (approximately)
/*!40000 ALTER TABLE `sysparam` DISABLE KEYS */;
REPLACE INTO `sysparam` (`id`, `vVariable`, `vContent`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'MT01_PENANGGUNG_JAWAB', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:32', 0),
	(2, 'MT02_MANAGER_PUNCAK', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:38', 0),
	(3, 'MT03_TTD', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:07', 0),
	(4, 'MAIL_MT01_NEW', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=2', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-05 01:33:56', 0),
	(5, 'MAIL_BCC', 'N14615', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-05 01:33:34', 0),
	(6, 'MAIL_SERTIFIKAT_APP', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group in (2,6,9,10)', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 03:22:16', 0),
	(7, 'MAIL_SERTIFIKAT_APP_OTHER', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group <> 2', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 01:35:37', 0),
	(8, 'MAIL_NEW_REG', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=2', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 02:44:00', 0),
	(9, 'MAIL_MT07_SUBMIT', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=9', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 03:30:45', 0),
	(10, 'MAIL_MT07_SUBMIT_VIRO', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=4', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 03:34:43', 0),
	(11, 'MAIL_MT07_SUBMIT_BAK', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=3', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 03:34:47', 0),
	(12, 'MAIL_MT07_SUBMIT_FAR', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=5', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-07 03:34:52', 0),
	(13, 'MAIL_MT05_APP', 'select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\nb.idprivi_apps=130\r\nand a.idprivi_group=9', 'N14615', '2019-02-03 14:48:32', NULL, '2019-04-13 18:35:32', 0);
/*!40000 ALTER TABLE `sysparam` ENABLE KEYS */;


-- Dumping database structure for erp_privi
DROP DATABASE IF EXISTS `erp_privi`;
CREATE DATABASE IF NOT EXISTS `erp_privi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `erp_privi`;

-- Dumping structure for procedure erp_privi.cekAuthlist
DROP PROCEDURE IF EXISTS `cekAuthlist`;
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

-- Dumping structure for table erp_privi.ci_erp_sessions
DROP TABLE IF EXISTS `ci_erp_sessions`;
CREATE TABLE IF NOT EXISTS `ci_erp_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.ci_erp_sessions: ~3 rows (approximately)
/*!40000 ALTER TABLE `ci_erp_sessions` DISABLE KEYS */;
REPLACE INTO `ci_erp_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('80e4919bd5ead7954094da5b9455e802', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1362123090, ''),
	('b5e4137b9c424e279474e6a47c14f883', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1362122484, ''),
	('d9b8a44131a35e71f272cc9131e80ea7', '10.1.48.114', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0 FirePHP/0.7.1', 1362122989, '');
/*!40000 ALTER TABLE `ci_erp_sessions` ENABLE KEYS */;

-- Dumping structure for table erp_privi.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `cNip` char(7) NOT NULL COMMENT 'Nomer induk Pegawai',
  `vName` varchar(30) DEFAULT '' COMMENT 'Nama pegawai',
  `vNickName` varchar(15) DEFAULT NULL COMMENT 'Nama panggilan',
  `cUpper` char(7) DEFAULT NULL COMMENT 'NIP Atasan',
  `iCompanyID` int(2) NOT NULL DEFAULT '0' COMMENT 'kode perusahaan',
  `iDeptID` int(2) NOT NULL DEFAULT '0' COMMENT 'kode departemen',
  `iDivID` int(2) DEFAULT '0' COMMENT 'kode divisi',
  `ibagid` int(2) DEFAULT NULL COMMENT 'kode bagian',
  `iPostID` int(3) DEFAULT '0' COMMENT 'kode jabatan',
  `iArea` int(3) DEFAULT '0',
  `iWorkArea` int(2) DEFAULT '0' COMMENT 'kode area kerja relasi ke tbl: worklocation',
  `iAreaFrom` int(3) DEFAULT '0',
  `dIn` date DEFAULT '0000-00-00' COMMENT 'tgl bergabung',
  `dRealIn` date DEFAULT '0000-00-00' COMMENT 'tgl bergabung',
  `dPassProbation` date DEFAULT '0000-00-00' COMMENT 'tgl penentuan masa percobaan',
  `dPermanent` date DEFAULT '0000-00-00' COMMENT 'tgl pengangkatan permanen',
  `cFlag` char(1) DEFAULT NULL COMMENT 'status karyawan C: contract, O:outsource',
  `iWorkID` int(2) DEFAULT NULL,
  `cTaxCode` char(2) DEFAULT NULL COMMENT 'kode pajak',
  `cTaxNumber` char(40) DEFAULT NULL COMMENT 'nomer wajib pajak',
  `dSosSecurity` date DEFAULT '0000-00-00',
  `vSosSecurity` varchar(30) DEFAULT NULL,
  `cPayType` char(2) DEFAULT NULL,
  `cPayCode` char(1) DEFAULT NULL,
  `cPayStatus` char(1) DEFAULT NULL,
  `lOvrTime` bit(1) DEFAULT NULL,
  `iBankID` int(2) DEFAULT NULL COMMENT 'status apakah memiliki no account bank atau tidak',
  `vAccNumber` varchar(20) DEFAULT NULL COMMENT 'no account bank yang dimiliki',
  `vBankBranch` varchar(50) DEFAULT NULL COMMENT 'Cabang rekening bank',
  `vBankCity` varchar(20) DEFAULT NULL COMMENT 'lokasi bank',
  `lSimpapi` bit(1) DEFAULT NULL,
  `lKesgapi` bit(1) DEFAULT NULL,
  `vIdNumber` varchar(50) DEFAULT NULL COMMENT 'no  identitas KTP',
  `DIdExpired` date DEFAULT '0000-00-00' COMMENT 'tgl expired KTP',
  `vBirthPlace` varchar(40) DEFAULT NULL COMMENT 'tempat lahir',
  `dBirthday` date DEFAULT '0000-00-00' COMMENT 'tgl ultah',
  `vCitizen` varchar(3) DEFAULT NULL COMMENT 'warga negara',
  `vMother` varchar(30) DEFAULT NULL COMMENT 'Nama ibu kandung',
  `iReligion` int(2) DEFAULT NULL COMMENT 'agama',
  `vBloodType` varchar(2) DEFAULT NULL COMMENT 'Jenis darah',
  `vEmail` varchar(50) DEFAULT NULL COMMENT 'email',
  `iFoodID` int(2) DEFAULT NULL COMMENT 'kode makanan fav?',
  `iTransID` int(2) DEFAULT NULL COMMENT 'kode transportasi yang digunakan?',
  `cEmpStat` char(1) DEFAULT NULL COMMENT 'status karyawan tetap atau tidak',
  `vIDAddress` varchar(100) DEFAULT NULL COMMENT 'alamat sesuai KTP',
  `vIDBlock` varchar(15) DEFAULT NULL COMMENT 'blok rumah sesuai KTP',
  `vIDLot` varchar(3) DEFAULT NULL COMMENT 'Lot rumah sesuai KTP',
  `viDHomeNo` varchar(4) DEFAULT NULL COMMENT 'No rumah sesuai KTP',
  `vIDKelurahan` varchar(50) DEFAULT NULL COMMENT 'Kelurahan tempat tinggal sesuai KTP',
  `vIDKecamatan` varchar(50) DEFAULT NULL COMMENT 'Kecamatan tempat tinggal sesuai KTP',
  `vIDKotamadya` varchar(30) DEFAULT NULL COMMENT 'Kotamadya tempat tinggal sesuai KTP',
  `cIDPostal` char(5) DEFAULT NULL COMMENT 'kode pos tempat tinggal sesuai KTP',
  `vIDPhoneCode` varchar(4) DEFAULT NULL COMMENT 'Kode area sesuai KTP',
  `vIDPhoneNumber` varchar(20) DEFAULT NULL COMMENT 'No tlp yang bisa dihubungi sesuai KTP',
  `vStAddress` varchar(100) DEFAULT NULL COMMENT 'Alamat  ',
  `vStKelurahan` varchar(50) DEFAULT NULL COMMENT 'Kelurahan tempat tinggal',
  `vStKecamatan` varchar(50) DEFAULT NULL COMMENT 'Kecamatan tempat tinggal ',
  `vStKotamadya` varchar(30) DEFAULT NULL COMMENT 'Kotamadya tempat tinggal',
  `cStPostal` char(5) DEFAULT NULL COMMENT 'Kode pos tempat tinggal',
  `vStPhoneCode` varchar(4) DEFAULT NULL COMMENT 'Kode area ',
  `vStPhoneNumber` varchar(20) DEFAULT NULL COMMENT 'No tlp yang bisa dihubungi ',
  `tCreated` datetime DEFAULT NULL COMMENT 'record tsb dibuat pd tgl',
  `cCreatedBy` char(7) DEFAULT NULL COMMENT 'record tsb dibuat oleh',
  `tUpdated` datetime DEFAULT NULL COMMENT 'record diupdate tgl',
  `cUpdatedBy` char(7) DEFAULT NULL COMMENT 'record diupdate oleh',
  `lDeleted` bit(1) NOT NULL COMMENT 'status delete',
  `dPrintSPK` date DEFAULT '0000-00-00' COMMENT 'tgl print SPK',
  `iBankTransfer` int(2) DEFAULT NULL,
  `dfired` date DEFAULT '0000-00-00' COMMENT 'tgl pemberhentian status karyawan',
  `drsreq` date DEFAULT '0000-00-00',
  `dresign` date DEFAULT '0000-00-00' COMMENT 'tgl pengunduran diri',
  `drightcal` date DEFAULT '0000-00-00',
  `dproses` date DEFAULT '0000-00-00' COMMENT 'tgl proses',
  `mreason` text COMMENT 'keterangan penyebab',
  `mphoto` text,
  `csex` char(1) DEFAULT NULL COMMENT 'jenis kelamin',
  `vhp` varchar(15) DEFAULT NULL COMMENT 'no hp',
  `vidrt` varchar(4) DEFAULT NULL COMMENT 'no RT tempat tinggal sesuai KTP',
  `vidrw` varchar(4) DEFAULT NULL COMMENT 'no RW tempat tinggal sesuai KTP',
  `iidprovid` int(2) DEFAULT NULL COMMENT 'id provinsi sesuai KTP',
  `vstrt` varchar(4) DEFAULT NULL COMMENT 'no RT tempat tinggal',
  `vstrw` varchar(4) DEFAULT NULL COMMENT 'no RW tempat tinggal',
  `vstblock` varchar(15) DEFAULT NULL COMMENT 'block tempat tinggal',
  `vstlot` varchar(3) DEFAULT NULL COMMENT 'lot. tempat tinggal',
  `vsthomeno` varchar(4) DEFAULT NULL COMMENT 'no rumah tempat tinggal',
  `istprovid` int(2) DEFAULT NULL COMMENT 'provinsi tempat tinggal',
  `vaccowner` varchar(30) DEFAULT NULL COMMENT 'account bank miliki',
  `dresignpayroll` date DEFAULT '0000-00-00' COMMENT 'catatan tgl resign disisi payroll',
  `lshift` bit(1) DEFAULT NULL,
  `lfood` bit(1) DEFAULT NULL,
  `cupperprev` char(7) DEFAULT NULL,
  `irefrid` int(1) DEFAULT NULL,
  `lhins` bit(1) DEFAULT NULL,
  `vhinsmemberno` varchar(15) DEFAULT NULL,
  `dhins` date DEFAULT '0000-00-00',
  `ihinsprovid` int(2) DEFAULT NULL,
  `iuppid` int(3) DEFAULT NULL,
  `igshiftid` int(2) DEFAULT NULL,
  `iPostIdPrev` int(3) DEFAULT NULL,
  `cNipold` char(7) DEFAULT NULL,
  `dprodem` date DEFAULT '0000-00-00',
  `cpending` varchar(100) DEFAULT NULL,
  `ipaystatus` int(2) DEFAULT NULL,
  `ctaxpayroll` char(2) DEFAULT NULL,
  `dNPWP` date DEFAULT '0000-00-00',
  `vPassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cNip`),
  UNIQUE KEY `cNip` (`cNip`),
  KEY `FK_employee_Dept` (`iDeptID`),
  KEY `FK_employee_position` (`iPostID`),
  KEY `FK_employee_WorkStat` (`iWorkID`),
  KEY `cUpper` (`cUpper`),
  KEY `vNickName` (`vNickName`),
  KEY `dresign` (`dresign`),
  KEY `vName` (`vName`),
  KEY `IDX1` (`cNip`,`vName`),
  KEY `FK_employee_Company` (`iCompanyID`,`lDeleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='master informasi pegawai';

-- Dumping data for table erp_privi.employee: ~0 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

-- Dumping structure for table erp_privi.erp_notif
DROP TABLE IF EXISTS `erp_notif`;
CREATE TABLE IF NOT EXISTS `erp_notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vName` varchar(255) NOT NULL DEFAULT '0',
  `vAcl` varchar(255) NOT NULL DEFAULT '0',
  `idErpModul` varchar(255) NOT NULL DEFAULT '0',
  `vMainPic` varchar(255) NOT NULL DEFAULT '0',
  `vDesc` varchar(255) NOT NULL DEFAULT '0',
  `isLocalCalc` tinyint(4) NOT NULL DEFAULT '1',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tCreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.erp_notif: ~0 rows (approximately)
/*!40000 ALTER TABLE `erp_notif` DISABLE KEYS */;
/*!40000 ALTER TABLE `erp_notif` ENABLE KEYS */;

-- Dumping structure for table erp_privi.erp_notif_pic
DROP TABLE IF EXISTS `erp_notif_pic`;
CREATE TABLE IF NOT EXISTS `erp_notif_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idNotif` int(11) NOT NULL,
  `cNip` varchar(255) NOT NULL DEFAULT '0',
  `isAlert` varchar(255) NOT NULL DEFAULT '0',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tCreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erp_privi.erp_notif_pic: ~0 rows (approximately)
/*!40000 ALTER TABLE `erp_notif_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `erp_notif_pic` ENABLE KEYS */;

-- Dumping structure for table erp_privi.global_send_to
DROP TABLE IF EXISTS `global_send_to`;
CREATE TABLE IF NOT EXISTS `global_send_to` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vCode` varchar(255) DEFAULT '0' COMMENT 'code ',
  `txtDesc` text COMMENT 'description email reminder',
  `txtSendTo` text COMMENT 'email reminder - To',
  `txtSendCc` text COMMENT 'email reminder - Cc',
  `txtSendBcc` text COMMENT 'email reminder - BCc',
  `txtSendFrom` text COMMENT 'email reminder - From',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Column 2` (`vCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Untuk kebutuhan distribusi email reminder';

-- Dumping data for table erp_privi.global_send_to: 0 rows
/*!40000 ALTER TABLE `global_send_to` DISABLE KEYS */;
/*!40000 ALTER TABLE `global_send_to` ENABLE KEYS */;

-- Dumping structure for procedure erp_privi.log_login
DROP PROCEDURE IF EXISTS `log_login`;
DELIMITER //
CREATE DEFINER=`binto`@`%` PROCEDURE `log_login`(IN `cNip_` vARCHAR(50), IN `vSessionID_` VARCHAR(50), IN `dLoginAt_` vARCHAR(50), IN `dLogoutAt_` vARCHAR(50), IN `vIPSource_` vARCHAR(50))
BEGIN
	INSERT INTO `privi_session_log` 
		( `cNip`, `iCompanyId`, `vSessionID`, `dLoginAt`, `dLogoutAt`, `vIPSource`, `tUpdatedAt`, `cUpdatedBy`) 
	VALUES 
		(cNip_, 3, vSessionID_, dLoginAt_, dLogoutAt_, vIPSource_, NOW(), NULL);

END//
DELIMITER ;

-- Dumping structure for table erp_privi.perm_data
DROP TABLE IF EXISTS `perm_data`;
CREATE TABLE IF NOT EXISTS `perm_data` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permKey` varchar(100) NOT NULL,
  `permName` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `class_icon` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `user_create` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `bobot` int(11) NOT NULL,
  `menu` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.perm_data: 0 rows
/*!40000 ALTER TABLE `perm_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `perm_data` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_access_pt
DROP TABLE IF EXISTS `privi_access_pt`;
CREATE TABLE IF NOT EXISTS `privi_access_pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cNip` char(7) NOT NULL DEFAULT '0',
  `iPt` tinyint(1) NOT NULL DEFAULT '0',
  `tTime` timestamp NULL DEFAULT NULL,
  `t*as` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.privi_access_pt: ~0 rows (approximately)
/*!40000 ALTER TABLE `privi_access_pt` DISABLE KEYS */;
/*!40000 ALTER TABLE `privi_access_pt` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_actilog
DROP TABLE IF EXISTS `privi_actilog`;
CREATE TABLE IF NOT EXISTS `privi_actilog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tStart` datetime DEFAULT NULL,
  `tEnd` datetime DEFAULT NULL,
  `cNip` char(7) DEFAULT NULL,
  `cModule` varchar(255) DEFAULT NULL,
  `iCounter` int(11) DEFAULT NULL,
  `cIp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.privi_actilog: ~105 rows (approximately)
/*!40000 ALTER TABLE `privi_actilog` DISABLE KEYS */;
REPLACE INTO `privi_actilog` (`id`, `tStart`, `tEnd`, `cNip`, `cModule`, `iCounter`, `cIp`) VALUES
	(1, '2019-04-05 02:43:51', '2019-04-05 02:43:52', 'N14615', 'Privilege2/priv2/setup/application', 2, '127.0.0.1'),
	(2, '2019-04-05 01:54:45', '2019-04-05 02:43:51', 'N14615', 'umum/master_employee', 1, '127.0.0.1'),
	(3, '2019-04-05 01:56:33', '2019-04-05 02:43:52', 'N14615', 'umum/master_customer', 1, '127.0.0.1'),
	(4, '2019-04-05 01:57:03', '2019-04-05 01:57:10', 'C00011', 'pengujian/mt01', 1, '127.0.0.1'),
	(5, '2019-04-05 01:57:13', '2019-04-05 01:57:30', 'C00011', 'pengujian/mt01', 1, '127.0.0.1'),
	(6, '2019-04-05 01:57:47', '2019-04-05 01:58:38', 'C00011', 'pengujian/mt01', 1, '127.0.0.1'),
	(7, '2019-04-05 01:58:40', '2019-04-05 01:58:52', 'C00011', 'pengujian/mt01', 1, '127.0.0.1'),
	(8, '2019-04-05 02:21:28', '2019-04-05 02:42:35', 'C00011', 'pengujian/mt01', 3, '127.0.0.1'),
	(9, '2019-04-05 02:43:52', NULL, 'C00011', 'schedulercheck/inbox_erp_core', 3, '127.0.0.1'),
	(10, '2019-04-05 02:44:10', NULL, 'A00001', 'schedulercheck/inbox_erp_core', 6, '::1'),
	(11, '2019-04-05 02:34:08', '2019-04-05 02:34:27', 'A00001', 'pengujian/mt01', 1, '::1'),
	(12, '2019-04-05 02:43:47', NULL, 'C00011', 'pengujian/mt02', 2, '127.0.0.1'),
	(13, '2019-04-07 00:34:14', '2019-04-07 00:36:44', 'A00001', 'pengujian/mt04', 1, '127.0.0.1'),
	(14, '2019-04-07 00:37:22', '2019-04-07 00:37:26', 'A00001', 'pengujian/mt01', 2, '127.0.0.1'),
	(15, '2019-04-07 00:37:15', '2019-04-07 00:37:19', 'A00001', 'pengujian/mt03', 1, '127.0.0.1'),
	(16, '2019-04-07 00:37:17', '2019-04-07 00:37:23', 'A00001', 'pengujian/mt04', 1, '127.0.0.1'),
	(17, '2019-04-07 00:37:27', '2019-04-07 00:38:23', 'A00001', 'pengujian/mt04', 1, '127.0.0.1'),
	(18, '2019-04-07 00:39:48', '2019-04-07 00:39:49', 'A00001', 'pengujian/mt04', 2, '127.0.0.1'),
	(19, '2019-04-07 00:39:43', '2019-04-07 00:39:49', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(20, '2019-04-07 01:22:54', '2019-04-07 01:28:34', 'A00001', 'pengujian/sertifikat', 2, '127.0.0.1'),
	(21, '2019-04-07 00:58:07', NULL, 'N14615', 'umum/master_employee', 1, '127.0.0.1'),
	(22, '2019-04-07 01:46:27', NULL, 'A00005', 'pengujian/sertifikat', 2, '::1'),
	(23, '2019-04-07 01:28:36', '2019-04-07 01:28:48', 'A00001', 'pengujian/mt01', 1, '127.0.0.1'),
	(24, '2019-04-07 01:51:06', NULL, 'A00001', 'pengujian/sertifikat', 3, '127.0.0.1'),
	(25, '2019-04-07 01:41:43', NULL, 'A00005', 'pengujian/sertifikat', 3, '127.0.0.1'),
	(26, '2019-04-07 23:00:21', NULL, 'A00001', 'schedulercheck/inbox_erp_core', 3, '::1'),
	(27, '2019-04-07 01:47:05', NULL, 'A00005', 'schedulercheck/inbox_erp_core', 2, '::1'),
	(28, '2019-04-07 03:44:41', NULL, 'A00001', 'schedulercheck/inbox_erp_core', 10, '127.0.0.1'),
	(29, '2019-04-07 01:48:30', NULL, 'A00007', 'pengujian/sertifikat', 1, '::1'),
	(30, '2019-04-07 01:49:43', NULL, 'A00008', 'pengujian/sertifikat', 1, '::1'),
	(31, '2019-04-07 02:16:57', NULL, 'A00032', 'pengujian/mt8a', 1, '::1'),
	(32, '2019-04-07 02:19:19', NULL, 'A00032', 'schedulercheck/inbox_erp_core', 2, '::1'),
	(33, '2019-04-07 02:18:24', NULL, 'A00032', 'pengujian/mt8b', 1, '::1'),
	(34, '2019-04-07 02:22:13', '2019-04-07 02:22:18', 'A00032', 'pengujian/mt8a', 1, '127.0.0.1'),
	(35, '2019-04-07 02:22:19', '2019-04-07 02:29:49', 'A00032', 'pengujian/mt8b', 1, '127.0.0.1'),
	(36, '2019-04-07 02:26:27', NULL, 'A00032', 'schedulercheck/inbox_erp_core', 1, '127.0.0.1'),
	(37, '2019-04-07 02:29:52', '2019-04-07 02:29:54', 'A00032', 'pengujian/mt09', 2, '127.0.0.1'),
	(38, '2019-04-07 02:30:18', '2019-04-07 02:30:48', 'A00032', 'pengujian/mt09', 2, '127.0.0.1'),
	(39, '2019-04-07 02:30:50', '2019-04-07 02:33:00', 'A00032', 'pengujian/mt09', 1, '127.0.0.1'),
	(40, '2019-04-07 02:33:01', '2019-04-07 02:33:35', 'A00032', 'pengujian/mt09', 1, '127.0.0.1'),
	(41, '2019-04-07 02:34:51', NULL, 'A00032', 'pengujian/mt09', 2, '127.0.0.1'),
	(42, '2019-04-07 02:49:22', '2019-04-07 03:49:12', 'A00001', 'pengujian/verifikasi', 1, '127.0.0.1'),
	(43, '2019-04-07 03:49:13', NULL, 'A00001', 'pengujian/mt07', 4, '127.0.0.1'),
	(44, '2019-04-07 03:36:31', '2019-04-07 03:49:11', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(45, '2019-04-07 23:13:05', NULL, 'A00001', 'pengujian/mt01', 2, '::1'),
	(46, '2019-04-07 23:09:04', '2019-04-07 23:13:06', 'A00001', 'pengujian/verifikasi', 1, '::1'),
	(47, '2019-04-07 23:50:15', '2019-04-07 23:50:18', 'A00001', 'pengujian/mt01', 5, '127.0.0.1'),
	(48, '2019-04-07 23:36:22', '2019-04-07 23:50:17', 'A00001', 'pengujian/mt02', 4, '127.0.0.1'),
	(49, '2019-04-07 23:55:15', NULL, 'A00001', 'pengujian/mt03', 3, '127.0.0.1'),
	(50, '2019-04-07 23:51:14', NULL, 'A00001', 'pengujian/mt02', 2, '127.0.0.1'),
	(51, '2019-04-07 23:54:34', NULL, 'C00047', 'pengujian/mt02', 1, '127.0.0.1'),
	(52, '2019-04-08 00:04:14', '2019-04-08 00:04:15', 'A00001', 'pengujian/mt02', 1, '127.0.0.1'),
	(53, '2019-04-08 00:43:22', '2019-04-08 00:45:27', 'A00001', 'pengujian/mt03', 2, '127.0.0.1'),
	(54, '2019-04-08 00:04:17', '2019-04-08 00:13:54', 'A00001', 'pengujian/mt04', 1, '127.0.0.1'),
	(55, '2019-04-08 00:15:12', '2019-04-08 00:16:05', 'A00001', 'pengujian/mt05', 2, '127.0.0.1'),
	(56, '2019-04-08 00:16:05', '2019-04-08 00:16:06', 'A00001', 'pengujian/mt01', 2, '127.0.0.1'),
	(57, '2019-04-08 00:45:29', '2019-04-08 00:45:31', 'A00001', 'pengujian/mt01', 3, '127.0.0.1'),
	(58, '2019-04-08 00:22:36', '2019-04-08 00:27:33', 'A00001', 'pengujian/mt05', 2, '127.0.0.1'),
	(59, '2019-04-08 00:45:29', '2019-04-08 00:45:30', 'A00001', 'pengujian/mt06', 4, '127.0.0.1'),
	(60, '2019-04-08 00:45:28', '2019-04-08 00:45:28', 'A00001', 'pengujian/mt07', 3, '127.0.0.1'),
	(61, '2019-04-08 00:45:27', '2019-04-08 00:45:28', 'A00001', 'pengujian/mt05', 4, '127.0.0.1'),
	(62, '2019-04-08 00:45:26', '2019-04-08 00:45:27', 'A00001', 'pengujian/mt04', 3, '127.0.0.1'),
	(63, '2019-04-08 00:45:33', '2019-04-08 01:02:00', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(64, '2019-04-08 01:02:01', '2019-04-08 01:03:09', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(65, '2019-04-08 01:03:10', '2019-04-08 01:03:43', 'A00001', 'pengujian/mt04', 1, '127.0.0.1'),
	(66, '2019-04-08 01:03:44', '2019-04-08 01:07:00', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(67, '2019-04-08 01:13:24', '2019-04-08 01:14:26', 'A00001', 'pengujian/mt06', 3, '127.0.0.1'),
	(68, '2019-04-08 01:08:46', '2019-04-08 01:09:26', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(69, '2019-04-08 01:19:35', '2019-04-08 01:20:04', 'A00001', 'pengujian/mt06', 2, '127.0.0.1'),
	(70, '2019-04-08 01:18:06', '2019-04-08 01:19:35', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(71, '2019-04-08 01:20:05', '2019-04-08 01:20:25', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(72, '2019-04-08 01:21:02', '2019-04-08 01:24:07', 'A00001', 'pengujian/mt06', 2, '127.0.0.1'),
	(73, '2019-04-08 01:24:08', '2019-04-08 01:25:18', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(74, '2019-04-08 01:25:21', '2019-04-08 01:25:43', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(75, '2019-04-08 01:25:46', '2019-04-08 01:31:20', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(76, '2019-04-08 01:37:15', '2019-04-08 01:37:16', 'A00001', 'pengujian/mt07', 2, '127.0.0.1'),
	(77, '2019-04-08 01:33:10', '2019-04-08 01:37:16', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(78, '2019-04-08 01:37:18', '2019-04-08 01:43:57', 'A00001', 'pengujian/mt07', 1, '127.0.0.1'),
	(79, '2019-04-08 01:43:59', '2019-04-08 01:44:30', 'A00001', 'pengujian/mt07', 1, '127.0.0.1'),
	(80, '2019-04-08 01:44:32', '2019-04-08 01:46:16', 'A00001', 'pengujian/mt07', 1, '127.0.0.1'),
	(81, '2019-04-08 01:45:58', '2019-04-08 01:49:26', 'N14615', 'Privilege2/priv2/setup/application', 1, '127.0.0.1'),
	(82, '2019-04-08 01:46:16', '2019-04-08 01:49:30', 'A00001', 'pengujian/mt8a', 1, '127.0.0.1'),
	(83, '2019-04-08 02:04:36', '2019-04-08 02:06:54', 'A00001', 'pengujian/mt09', 3, '127.0.0.1'),
	(84, '2019-04-08 01:53:05', NULL, 'N14615', 'umum/master_employee', 1, '127.0.0.1'),
	(85, '2019-04-08 02:30:03', '2019-04-08 02:31:15', 'A00032', 'pengujian/mt09', 5, '127.0.0.1'),
	(86, '2019-04-08 01:55:03', '2019-04-08 01:57:58', 'A00004', 'pengujian/mt09', 1, '127.0.0.1'),
	(87, '2019-04-08 01:59:57', NULL, 'A00003', 'pengujian/mt8b', 1, '127.0.0.1'),
	(88, '2019-04-08 02:00:05', NULL, 'A00002', 'pengujian/mt8a', 1, '127.0.0.1'),
	(89, '2019-04-08 02:06:59', '2019-04-08 02:07:08', 'A00001', 'pengujian/mt8a', 4, '127.0.0.1'),
	(90, '2019-04-08 02:04:35', '2019-04-08 02:06:55', 'A00001', 'pengujian/mt8b', 3, '127.0.0.1'),
	(91, '2019-04-08 02:29:33', '2019-04-08 02:31:14', 'A00032', 'pengujian/mt8a', 3, '127.0.0.1'),
	(92, '2019-04-08 02:31:13', '2019-04-08 02:31:18', 'A00032', 'pengujian/mt8b', 7, '127.0.0.1'),
	(93, '2019-04-08 02:21:09', '2019-04-08 02:22:56', 'A00001', 'pengujian/mt8b', 3, '127.0.0.1'),
	(94, '2019-04-08 02:22:57', '2019-04-08 02:23:39', 'A00001', 'pengujian/mt8a', 2, '127.0.0.1'),
	(95, '2019-04-08 02:23:35', NULL, 'A00001', 'pengujian/mt09', 3, '127.0.0.1'),
	(96, '2019-04-08 02:31:16', NULL, 'A00032', 'pengujian/mt8a', 1, '127.0.0.1'),
	(97, '2019-04-08 02:31:16', NULL, 'A00001', 'pengujian/sertifikat', 1, '127.0.0.1'),
	(98, '2019-04-08 02:34:56', NULL, 'A00005', 'pengujian/sertifikat', 1, '127.0.0.1'),
	(99, '2019-04-08 02:35:29', NULL, 'A00007', 'pengujian/sertifikat', 1, '127.0.0.1'),
	(100, '2019-04-08 02:36:54', NULL, 'A00008', 'pengujian/sertifikat', 1, '127.0.0.1'),
	(101, '2019-04-13 16:21:31', '2019-04-13 16:21:32', 'A00001', 'pengujian/mt01', 3, '127.0.0.1'),
	(102, '2019-04-13 15:55:35', '2019-04-13 16:21:04', 'A00001', 'pengujian/mt03', 1, '127.0.0.1'),
	(103, '2019-04-13 16:21:03', '2019-04-13 16:21:30', 'A00001', 'pengujian/mt02', 1, '127.0.0.1'),
	(104, '2019-04-13 18:14:04', '2019-04-13 18:14:10', 'A00001', 'pengujian/mt03', 5, '127.0.0.1'),
	(105, '2019-04-13 16:35:36', NULL, 'A00001', 'pengujian/mt03', 1, '::1'),
	(106, '2019-04-13 18:08:07', '2019-04-13 18:14:05', 'A00001', 'pengujian/mt05', 5, '127.0.0.1'),
	(107, '2019-04-13 18:07:41', '2019-04-13 18:14:09', 'A00001', 'pengujian/mt01', 2, '127.0.0.1'),
	(108, '2019-04-13 18:14:08', '2019-04-13 18:14:21', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(109, '2019-04-13 18:14:21', '2019-04-13 18:15:40', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(110, '2019-04-13 18:15:43', '2019-04-13 18:50:22', 'A00001', 'pengujian/mt03', 1, '127.0.0.1'),
	(111, '2019-04-13 18:15:55', '2019-04-13 18:50:22', 'A00001', 'pengujian/mt05', 1, '127.0.0.1'),
	(112, '2019-04-13 18:41:56', NULL, 'A00001', 'schedulercheck/inbox_erp_core', 1, '127.0.0.1'),
	(113, '2019-04-13 18:45:31', '2019-04-13 18:50:18', 'A00001', 'pengujian/mt06', 1, '127.0.0.1'),
	(114, '2019-04-13 18:50:15', '2019-04-13 18:50:27', 'A00001', 'pengujian/mt07', 1, '127.0.0.1'),
	(115, '2019-04-13 18:50:28', '2019-04-13 19:02:27', 'A00001', 'pengujian/mt07', 1, '127.0.0.1'),
	(116, '2019-04-13 19:16:56', '2019-04-13 19:16:59', 'A00001', 'pengujian/mt8a', 2, '127.0.0.1'),
	(117, '2019-04-13 19:03:30', '2019-04-13 19:04:18', 'A00003', 'pengujian/mt8b', 1, '127.0.0.1'),
	(118, '2019-04-13 19:04:23', '2019-04-13 19:09:06', 'A00003', 'pengujian/mt8b', 1, '127.0.0.1'),
	(119, '2019-04-13 19:16:55', '2019-04-13 19:16:57', 'A00001', 'pengujian/mt8b', 4, '127.0.0.1'),
	(120, '2019-04-13 19:11:23', '2019-04-13 19:11:57', 'A00001', 'pengujian/mt09', 1, '127.0.0.1'),
	(121, '2019-04-13 19:16:22', '2019-04-13 19:16:54', 'A00001', 'pengujian/mt09', 2, '127.0.0.1'),
	(122, '2019-04-13 19:17:01', '2019-04-13 19:27:58', 'A00001', 'pengujian/mt8b', 1, '127.0.0.1'),
	(123, '2019-04-13 19:24:21', NULL, 'A00003', 'pengujian/mt8b', 1, '127.0.0.1'),
	(124, '2019-04-13 19:27:59', '2019-04-13 19:33:39', 'A00001', 'pengujian/mt8a', 1, '127.0.0.1'),
	(125, '2019-04-13 19:31:49', NULL, 'A00002', 'pengujian/mt8a', 1, '127.0.0.1'),
	(126, '2019-04-13 19:33:28', NULL, 'A00004', 'pengujian/mt09', 1, '127.0.0.1'),
	(127, '2019-04-13 19:33:38', NULL, 'A00001', 'pengujian/mt09', 1, '127.0.0.1');
/*!40000 ALTER TABLE `privi_actilog` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_activity_log
DROP TABLE IF EXISTS `privi_activity_log`;
CREATE TABLE IF NOT EXISTS `privi_activity_log` (
  `idprivi_activity_log` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `cNip` char(7) NOT NULL DEFAULT '0' COMMENT 'NIP username',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'ID table hrd.company daftar perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'ID Aplikasi',
  `idprivi_modules` int(11) NOT NULL DEFAULT '0' COMMENT 'ID table privi_modules',
  `vSessionID` varchar(50) NOT NULL DEFAULT '0' COMMENT 'session ID',
  `txtQuery` text COMMENT 'Catatan detail aktifitas  ',
  `tStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'timestamp log tercatat',
  PRIMARY KEY (`idprivi_activity_log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Contain activity per user recorded by system';

-- Dumping data for table erp_privi.privi_activity_log: 0 rows
/*!40000 ALTER TABLE `privi_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `privi_activity_log` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_apps
DROP TABLE IF EXISTS `privi_apps`;
CREATE TABLE IF NOT EXISTS `privi_apps` (
  `idprivi_apps` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vAppName` varchar(50) NOT NULL COMMENT 'Application Name',
  `txtDesc` text COMMENT 'Description',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 COMMENT='master daftar aplikasi';

-- Dumping data for table erp_privi.privi_apps: 4 rows
/*!40000 ALTER TABLE `privi_apps` DISABLE KEYS */;
REPLACE INTO `privi_apps` (`idprivi_apps`, `vAppName`, `txtDesc`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(130, 'e-Pengujian', 'Aplikasi e-Pengujian BBPMSOH ', '2019-01-26 12:55:27', 'N14615', '2019-02-03 21:27:30', 'N14615', 0),
	(129, 'Umum', 'Aplikasi Untuk Setting Karyawan , Division Dll', '2019-01-26 12:54:38', 'N14615', '2019-01-26 12:54:38', 'N14615', 0),
	(80, 'Privilege', 'Privilege', '0000-00-00 00:00:00', '-', '2013-08-29 08:17:25', 'N06081', 0),
	(106, 'Generator', 'Generator Module', '2016-11-16 09:37:07', 'N14615', '2019-01-27 01:00:15', 'N14615', 0);
/*!40000 ALTER TABLE `privi_apps` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_authlist
DROP TABLE IF EXISTS `privi_authlist`;
CREATE TABLE IF NOT EXISTS `privi_authlist` (
  `iID_Authlist` int(11) NOT NULL AUTO_INCREMENT,
  `cNIP` char(7) NOT NULL DEFAULT '0' COMMENT 'id table hrd.employee - NIP user',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company - nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `idprivi_group` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_group_pt_app',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iID_Authlist`),
  KEY `isDeleted` (`isDeleted`),
  KEY `com` (`cNIP`,`iCompanyId`,`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=20963 DEFAULT CHARSET=latin1 COMMENT='Isi list authorisasi untuk setiap user';

-- Dumping data for table erp_privi.privi_authlist: 17 rows
/*!40000 ALTER TABLE `privi_authlist` DISABLE KEYS */;
REPLACE INTO `privi_authlist` (`iID_Authlist`, `cNIP`, `iCompanyId`, `idprivi_apps`, `idprivi_group`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(478, 'N14615', 3, 80, 31, '2015-02-26 17:54:36', 'N13986', '2015-02-26 17:54:36', 'N13986', 0),
	(20961, 'C00047', 3, 130, 286, '0000-00-00 00:00:00', '-', '2019-04-07 23:10:43', '-', 0),
	(20955, 'C00002', 3, 130, 286, '0000-00-00 00:00:00', '-', '2019-03-31 16:17:33', '-', 0),
	(10336, 'N14615', 3, 106, 157, '2016-11-16 09:40:19', 'N14615', '2016-11-16 09:40:19', 'N14615', 0),
	(20958, 'A00032', 3, 130, 290, '2019-04-02 07:05:33', 'N14615', '2019-04-02 07:05:33', 'N14615', 0),
	(20957, 'A00008', 3, 130, 289, '2019-04-01 02:00:49', 'N14615', '2019-04-01 02:00:49', 'N14615', 0),
	(20956, 'A00007', 3, 130, 288, '2019-04-01 02:00:00', 'N14615', '2019-04-01 02:00:00', 'N14615', 0),
	(20954, 'C00013', 3, 130, 286, '2019-03-31 16:01:19', 'N14615', '2019-03-31 16:01:19', 'N14615', 0),
	(20953, 'C00011', 3, 130, 286, '2019-03-31 15:20:51', 'N14615', '2019-03-31 15:20:51', 'N14615', 0),
	(20952, 'C00001', 3, 130, 286, '2019-02-03 21:29:21', 'N14615', '2019-02-03 21:30:41', 'N14615', 0),
	(20951, 'A00003', 3, 130, 283, '2019-01-27 01:41:30', 'N14615', '2019-01-27 01:41:30', 'N14615', 0),
	(20950, 'A00004', 3, 130, 284, '2019-01-27 01:40:36', 'N14615', '2019-01-27 01:40:36', 'N14615', 0),
	(20949, 'A00002', 3, 130, 282, '2019-01-27 01:40:21', 'N14615', '2019-01-27 01:40:21', 'N14615', 0),
	(20948, 'A00005', 3, 130, 285, '2019-01-27 01:39:21', 'N14615', '2019-01-27 01:39:21', 'N14615', 0),
	(20947, 'A00001', 3, 130, 281, '2019-01-27 01:33:45', 'N14615', '2019-01-27 01:33:45', 'N14615', 0),
	(20945, 'N14615', 3, 130, 280, '2019-01-26 13:20:23', 'N14615', '2019-01-26 13:20:23', 'N14615', 0),
	(20946, 'N14615', 3, 129, 279, '2019-01-26 13:21:22', 'N14615', '2019-01-26 13:21:22', 'N14615', 0);
/*!40000 ALTER TABLE `privi_authlist` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_group_pt_app
DROP TABLE IF EXISTS `privi_group_pt_app`;
CREATE TABLE IF NOT EXISTS `privi_group_pt_app` (
  `iID_GroupApp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company - nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `idprivi_group` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_group_pt_app',
  `vNamaGroup` varchar(50) NOT NULL DEFAULT '-' COMMENT 'nama group akses per aplikasi per PT',
  `className` varchar(50) NOT NULL DEFAULT '-' COMMENT 'nama class atau alias untuk widget di extjs',
  `txtDesc` text COMMENT 'Description',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iID_GroupApp`),
  KEY `isDeleted` (`isDeleted`),
  KEY `company` (`iCompanyId`,`idprivi_apps`,`idprivi_group`)
) ENGINE=MyISAM AUTO_INCREMENT=291 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Group aplikasi per perusahaan';

-- Dumping data for table erp_privi.privi_group_pt_app: 14 rows
/*!40000 ALTER TABLE `privi_group_pt_app` DISABLE KEYS */;
REPLACE INTO `privi_group_pt_app` (`iID_GroupApp`, `iCompanyId`, `idprivi_apps`, `idprivi_group`, `vNamaGroup`, `className`, `txtDesc`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(31, 3, 80, 1, 'Admin_Privilege2', '-', 'Administrator Privilege2', '2013-03-07 14:33:30', 'N06081', '2013-09-03 17:36:49', 'N06081', 0),
	(157, 3, 106, 1, 'Administrator', '-', 'Administrator', '2016-11-16 09:39:48', 'N14615', '2018-12-28 10:42:38', 'N16945', 0),
	(279, 3, 129, 1, 'Administrator', '-', 'Administrator', '2019-01-26 13:19:11', 'N14615', '2019-01-26 15:37:44', 'N14615', 0),
	(280, 3, 130, 1, 'Administrator', '-', '', '2019-01-26 13:19:55', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(281, 3, 130, 2, 'Admini Yanji', '-', 'Group Admin Yanji', '2019-01-26 15:45:30', 'N14615', '2019-04-02 07:04:34', 'N14615', 0),
	(282, 3, 130, 3, 'Admin Biologik', '-', '', '2019-01-26 15:46:23', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(283, 3, 130, 4, 'Admin Virologi', '-', '', '2019-01-26 15:47:01', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(284, 3, 130, 5, 'Admin Farmastetik & Premiks', '-', '', '2019-01-26 15:47:32', 'N14615', '2019-03-31 23:58:19', 'N14615', 0),
	(285, 3, 130, 6, 'Admin SPHU', '-', 'Admin SPHU', '2019-01-26 15:47:59', 'N14615', '2019-04-01 00:24:37', 'N14615', 0),
	(286, 3, 130, 7, 'Customer', '-', 'Group Untuk Customer', '2019-02-03 21:27:55', 'N14615', '2019-03-31 15:57:14', 'N14615', 0),
	(287, 3, 130, 8, 'Kepala Balai', '-', 'Kepala Balai', '2019-04-01 00:08:36', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(288, 3, 130, 9, 'TU', '-', 'group TU', '2019-04-01 00:25:10', 'N14615', '2019-04-01 00:25:46', 'N14615', 0),
	(289, 3, 130, 10, 'Keuangan', '-', 'bagian Keuangan', '2019-04-01 00:26:16', 'N14615', '2019-04-01 00:26:45', 'N14615', 0),
	(290, 3, 130, 11, 'QA', '-', 'Quality Assurance', '2019-04-02 06:59:35', 'N14615', '2019-04-02 07:01:07', 'N14615', 0);
/*!40000 ALTER TABLE `privi_group_pt_app` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_group_pt_app_mod
DROP TABLE IF EXISTS `privi_group_pt_app_mod`;
CREATE TABLE IF NOT EXISTS `privi_group_pt_app_mod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company- nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `idprivi_group` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_group_pt_app',
  `idprivi_modules` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_modules',
  `iCrud` int(2) NOT NULL DEFAULT '0' COMMENT 'Mode hak akses, C / Create = 8, R/Read=4, U/Update=2, D/Delete=1 & None = 0',
  `className` varchar(50) NOT NULL DEFAULT '0',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`id`),
  KEY `idprivi_group` (`idprivi_group`),
  KEY `isDeleted` (`isDeleted`),
  KEY `idprivi_modules` (`idprivi_modules`),
  KEY `idprivi_apps` (`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=10095 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Group module dr per aplikasi per perusahaan';

-- Dumping data for table erp_privi.privi_group_pt_app_mod: 193 rows
/*!40000 ALTER TABLE `privi_group_pt_app_mod` DISABLE KEYS */;
REPLACE INTO `privi_group_pt_app_mod` (`id`, `iCompanyId`, `idprivi_apps`, `idprivi_group`, `idprivi_modules`, `iCrud`, `className`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`) VALUES
	(397, 3, 80, 31, 2350, 15, '0', '2013-09-03 17:36:49', 'N06081', '2013-09-03 17:36:49', '-', 0),
	(396, 3, 80, 31, 2354, 15, '0', '2013-09-03 17:36:49', 'N06081', '2013-09-03 17:36:49', '-', 0),
	(395, 3, 80, 31, 2349, 15, '0', '2013-09-03 17:36:49', 'N06081', '2013-09-03 17:36:49', '-', 0),
	(394, 3, 80, 31, 2353, 11, '0', '2013-09-03 17:36:49', 'N06081', '2013-09-03 17:36:49', '-', 0),
	(393, 3, 80, 31, 2351, 9, '0', '2013-09-03 17:36:49', 'N06081', '2013-09-03 17:36:49', '-', 0),
	(4949, 3, 106, 157, 3415, 13, '0', '2016-11-16 09:40:03', 'N14615', '2018-03-08 14:08:40', 'N17487', 0),
	(4950, 3, 106, 157, 3416, 13, '0', '2016-11-16 09:40:03', 'N14615', '2018-08-15 13:57:23', 'N16945', 0),
	(4951, 3, 106, 157, 3414, 4, '0', '2016-11-16 09:40:03', 'N14615', '2018-08-15 10:04:47', 'N16945', 0),
	(4952, 3, 106, 157, 3418, 4, '0', '2016-11-16 09:40:03', 'N14615', '2018-08-15 10:04:47', 'N16945', 0),
	(4953, 3, 106, 157, 3417, 4, '0', '2016-11-16 09:40:03', 'N14615', '2018-08-15 10:04:47', 'N16945', 0),
	(5198, 3, 106, 157, 3479, 12, '0', '2016-12-06 11:32:20', 'N14615', '2018-03-08 14:08:40', 'N17487', 0),
	(8054, 3, 106, 157, 3715, 13, '0', '2017-08-10 15:27:58', 'N16945', '2018-03-08 14:08:40', 'N17487', 0),
	(8106, 3, 106, 157, 3721, 4, '0', '2017-08-16 08:23:32', 'N14615', '2018-08-15 13:57:23', 'N16945', 0),
	(8119, 3, 106, 157, 3730, 13, '0', '2017-08-21 13:35:38', 'N14615', '2018-03-08 14:08:40', 'N17487', 0),
	(8739, 3, 106, 157, 3891, 13, '0', '2018-01-24 15:33:39', 'N15748', '2018-03-08 14:08:40', 'N17487', 0),
	(8746, 3, 106, 157, 3895, 0, '0', '2018-01-26 11:15:42', 'N15748', '2018-03-08 14:08:40', 'N17487', 0),
	(8874, 3, 106, 157, 3941, 4, '0', '2018-02-23 16:19:27', 'N15748', '2018-08-15 10:04:47', 'N16945', 0),
	(9007, 3, 106, 157, 3981, 12, '0', '2018-04-24 08:35:07', 'N14615', '2018-04-24 08:35:07', '-', 0),
	(9215, 3, 106, 157, 4010, 12, '0', '2018-06-25 10:35:55', 'N14615', '2018-06-25 10:35:55', '-', 0),
	(9434, 3, 106, 157, 4121, 4, '0', '2018-08-15 10:04:47', 'N16945', '2018-08-15 14:04:47', 'N16945', 0),
	(9663, 3, 106, 157, 4174, 13, '0', '2018-10-30 13:01:07', 'N14615', '2018-10-30 13:01:07', '-', 0),
	(9680, 3, 106, 157, 4186, 13, '0', '2018-11-06 15:15:25', 'N14615', '2018-11-06 15:15:25', '-', 0),
	(9765, 3, 106, 157, 4210, 13, '0', '2018-11-29 09:30:10', 'N16945', '2018-11-29 09:30:10', '-', 0),
	(9858, 3, 106, 157, 4219, 12, '0', '2018-12-28 10:42:38', 'N16945', '2018-12-28 10:42:38', '-', 0),
	(9926, 3, 129, 279, 4254, 13, '0', '2019-01-26 14:46:48', 'N14615', '2019-01-26 14:55:08', 'N14615', 0),
	(9927, 3, 129, 279, 4255, 13, '0', '2019-01-26 14:55:08', 'N14615', '2019-01-26 15:37:44', 'N14615', 0),
	(9928, 3, 129, 279, 4256, 13, '0', '2019-01-26 15:37:44', 'N14615', '2019-01-26 15:37:44', '-', 0),
	(9929, 3, 130, 280, 4257, 4, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9930, 3, 130, 280, 4258, 4, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9931, 3, 130, 280, 4260, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9932, 3, 130, 280, 4271, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:29:24', '-', 0),
	(9933, 3, 130, 280, 4261, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9934, 3, 130, 280, 4262, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9935, 3, 130, 280, 4263, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9936, 3, 130, 280, 4264, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9937, 3, 130, 280, 4265, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9938, 3, 130, 280, 4266, 15, '0', '2019-01-27 00:29:24', 'N14615', '2019-01-27 00:34:55', 'N14615', 0),
	(9939, 3, 130, 280, 4270, 15, '0', '2019-01-27 00:29:57', 'N14615', '2019-01-27 00:29:57', '-', 0),
	(9940, 3, 130, 280, 4267, 15, '0', '2019-01-27 00:29:57', 'N14615', '2019-01-27 00:29:57', '-', 0),
	(9941, 3, 130, 280, 4268, 15, '0', '2019-01-27 00:29:57', 'N14615', '2019-01-27 00:29:57', '-', 0),
	(9942, 3, 130, 280, 4269, 15, '0', '2019-01-27 00:29:57', 'N14615', '2019-01-27 00:29:57', '-', 0),
	(9943, 3, 130, 280, 4259, 4, '0', '2019-01-27 00:29:57', 'N14615', '2019-01-27 00:29:57', '-', 0),
	(9944, 3, 130, 280, 4272, 5, '0', '2019-01-27 00:34:55', 'N14615', '2019-01-27 00:34:55', '-', 0),
	(9945, 3, 130, 281, 4257, 0, '0', '2019-01-27 00:51:06', 'N14615', '2019-03-31 16:57:58', 'N14615', 0),
	(9946, 3, 130, 281, 4272, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9947, 3, 130, 281, 4258, 4, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9948, 3, 130, 281, 4260, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9949, 3, 130, 281, 4261, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9950, 3, 130, 281, 4262, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9951, 3, 130, 281, 4263, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9952, 3, 130, 281, 4264, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9953, 3, 130, 281, 4265, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-03-31 22:29:00', 'N14615', 0),
	(9954, 3, 130, 281, 4266, 13, '0', '2019-01-27 00:51:06', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9955, 3, 130, 281, 4270, 13, '0', '2019-01-27 00:51:45', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9956, 3, 130, 281, 4267, 5, '0', '2019-01-27 00:51:45', 'N14615', '2019-04-02 07:04:34', 'N14615', 0),
	(9957, 3, 130, 281, 4268, 5, '0', '2019-01-27 00:51:45', 'N14615', '2019-04-02 07:04:34', 'N14615', 0),
	(9958, 3, 130, 281, 4269, 5, '0', '2019-01-27 00:51:45', 'N14615', '2019-04-02 07:04:34', 'N14615', 0),
	(9959, 3, 130, 281, 4271, 5, '0', '2019-01-27 00:51:45', 'N14615', '2019-04-01 00:24:10', 'N14615', 0),
	(9960, 3, 130, 281, 4259, 0, '0', '2019-01-27 00:51:45', 'N14615', '2019-01-27 00:52:39', 'N14615', 0),
	(9961, 3, 130, 285, 4257, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-03-31 16:59:54', 'N14615', 0),
	(9962, 3, 130, 285, 4272, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9963, 3, 130, 285, 4258, 4, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9964, 3, 130, 285, 4260, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9965, 3, 130, 285, 4261, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9966, 3, 130, 285, 4262, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9967, 3, 130, 285, 4263, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9968, 3, 130, 285, 4264, 13, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9969, 3, 130, 285, 4265, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9970, 3, 130, 285, 4266, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9971, 3, 130, 285, 4270, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9972, 3, 130, 285, 4267, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9973, 3, 130, 285, 4268, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9974, 3, 130, 285, 4269, 0, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:56:12', 'N14615', 0),
	(9975, 3, 130, 285, 4271, 5, '0', '2019-01-27 00:55:57', 'N14615', '2019-04-01 00:24:37', 'N14615', 0),
	(9976, 3, 130, 285, 4259, 4, '0', '2019-01-27 00:55:57', 'N14615', '2019-01-27 00:59:34', 'N14615', 0),
	(10035, 3, 130, 287, 4257, 0, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(9977, 3, 130, 282, 4257, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9978, 3, 130, 282, 4272, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9979, 3, 130, 282, 4258, 4, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9980, 3, 130, 282, 4260, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9981, 3, 130, 282, 4261, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9982, 3, 130, 282, 4262, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9983, 3, 130, 282, 4263, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9984, 3, 130, 282, 4264, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9985, 3, 130, 282, 4265, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 16:58:31', 'N14615', 0),
	(9986, 3, 130, 282, 4266, 4, '0', '2019-01-27 00:57:54', 'N14615', '2019-03-31 23:56:40', 'N14615', 0),
	(9987, 3, 130, 282, 4270, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-01-27 00:57:54', '-', 0),
	(9988, 3, 130, 282, 4267, 13, '0', '2019-01-27 00:57:54', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(9989, 3, 130, 282, 4268, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(9990, 3, 130, 282, 4269, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(9991, 3, 130, 282, 4271, 0, '0', '2019-01-27 00:57:54', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(9992, 3, 130, 282, 4259, 4, '0', '2019-01-27 00:57:54', 'N14615', '2019-04-08 01:48:18', 'N14615', 0),
	(9993, 3, 130, 283, 4257, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9994, 3, 130, 283, 4272, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9995, 3, 130, 283, 4258, 4, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9996, 3, 130, 283, 4260, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9997, 3, 130, 283, 4261, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9998, 3, 130, 283, 4262, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(9999, 3, 130, 283, 4263, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(10000, 3, 130, 283, 4264, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(10001, 3, 130, 283, 4265, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 16:59:00', 'N14615', 0),
	(10002, 3, 130, 283, 4266, 4, '0', '2019-01-27 01:01:30', 'N14615', '2019-03-31 23:57:36', 'N14615', 0),
	(10003, 3, 130, 283, 4270, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-01-27 01:01:30', '-', 0),
	(10004, 3, 130, 283, 4267, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(10005, 3, 130, 283, 4268, 13, '0', '2019-01-27 01:01:30', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(10006, 3, 130, 283, 4269, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(10007, 3, 130, 283, 4271, 0, '0', '2019-01-27 01:01:30', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(10008, 3, 130, 283, 4259, 4, '0', '2019-01-27 01:01:30', 'N14615', '2019-04-08 01:49:02', 'N14615', 0),
	(10009, 3, 130, 284, 4257, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:26', 'N14615', 0),
	(10010, 3, 130, 284, 4272, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:26', 'N14615', 0),
	(10011, 3, 130, 284, 4258, 4, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:26', 'N14615', 0),
	(10012, 3, 130, 284, 4260, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:26', 'N14615', 0),
	(10013, 3, 130, 284, 4261, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:26', 'N14615', 0),
	(10014, 3, 130, 284, 4262, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:27', 'N14615', 0),
	(10015, 3, 130, 284, 4263, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:27', 'N14615', 0),
	(10016, 3, 130, 284, 4264, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:27', 'N14615', 0),
	(10017, 3, 130, 284, 4265, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 16:59:27', 'N14615', 0),
	(10018, 3, 130, 284, 4266, 4, '0', '2019-01-27 01:02:32', 'N14615', '2019-03-31 23:58:19', 'N14615', 0),
	(10019, 3, 130, 284, 4270, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10020, 3, 130, 284, 4267, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10021, 3, 130, 284, 4268, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10022, 3, 130, 284, 4269, 13, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10023, 3, 130, 284, 4271, 0, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10024, 3, 130, 284, 4259, 4, '0', '2019-01-27 01:02:32', 'N14615', '2019-01-27 01:02:32', '-', 0),
	(10025, 3, 130, 286, 4257, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10026, 3, 130, 286, 4272, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10027, 3, 130, 286, 4258, 4, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10028, 3, 130, 286, 4260, 15, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10029, 3, 130, 286, 4261, 5, '0', '2019-02-03 21:28:32', 'N14615', '2019-03-31 15:57:14', 'N14615', 0),
	(10030, 3, 130, 286, 4262, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10031, 3, 130, 286, 4263, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10032, 3, 130, 286, 4264, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10033, 3, 130, 286, 4265, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10034, 3, 130, 286, 4266, 0, '0', '2019-02-03 21:28:32', 'N14615', '2019-02-03 21:30:10', 'N14615', 0),
	(10036, 3, 130, 287, 4272, 0, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10037, 3, 130, 287, 4258, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10038, 3, 130, 287, 4260, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10039, 3, 130, 287, 4261, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10040, 3, 130, 287, 4262, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10041, 3, 130, 287, 4263, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10042, 3, 130, 287, 4264, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10043, 3, 130, 287, 4265, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10044, 3, 130, 287, 4266, 4, '0', '2019-04-01 00:08:57', 'N14615', '2019-04-01 00:08:57', '-', 0),
	(10045, 3, 130, 287, 4267, 4, '0', '2019-04-01 00:09:07', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(10046, 3, 130, 287, 4268, 4, '0', '2019-04-01 00:09:07', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(10047, 3, 130, 287, 4269, 4, '0', '2019-04-01 00:09:07', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(10048, 3, 130, 287, 4271, 4, '0', '2019-04-01 00:09:07', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(10049, 3, 130, 287, 4259, 4, '0', '2019-04-01 00:09:07', 'N14615', '2019-04-01 00:09:15', 'N14615', 0),
	(10050, 3, 130, 288, 4257, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10051, 3, 130, 288, 4272, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10052, 3, 130, 288, 4258, 4, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10053, 3, 130, 288, 4260, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10054, 3, 130, 288, 4261, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10055, 3, 130, 288, 4262, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10056, 3, 130, 288, 4263, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10057, 3, 130, 288, 4264, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10058, 3, 130, 288, 4265, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10059, 3, 130, 288, 4266, 0, '0', '2019-04-01 00:25:29', 'N14615', '2019-04-01 00:25:29', '-', 0),
	(10060, 3, 130, 288, 4267, 0, '0', '2019-04-01 00:25:46', 'N14615', '2019-04-01 00:25:46', '-', 0),
	(10061, 3, 130, 288, 4268, 0, '0', '2019-04-01 00:25:46', 'N14615', '2019-04-01 00:25:46', '-', 0),
	(10062, 3, 130, 288, 4269, 0, '0', '2019-04-01 00:25:46', 'N14615', '2019-04-01 00:25:46', '-', 0),
	(10063, 3, 130, 288, 4271, 5, '0', '2019-04-01 00:25:46', 'N14615', '2019-04-01 00:25:46', '-', 0),
	(10064, 3, 130, 288, 4259, 0, '0', '2019-04-01 00:25:46', 'N14615', '2019-04-01 00:25:46', '-', 0),
	(10065, 3, 130, 289, 4257, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10066, 3, 130, 289, 4272, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10067, 3, 130, 289, 4258, 4, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10068, 3, 130, 289, 4260, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10069, 3, 130, 289, 4261, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10070, 3, 130, 289, 4262, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10071, 3, 130, 289, 4263, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10072, 3, 130, 289, 4264, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10073, 3, 130, 289, 4265, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10074, 3, 130, 289, 4266, 0, '0', '2019-04-01 00:26:33', 'N14615', '2019-04-01 00:26:33', '-', 0),
	(10075, 3, 130, 289, 4267, 0, '0', '2019-04-01 00:26:45', 'N14615', '2019-04-01 00:26:45', '-', 0),
	(10076, 3, 130, 289, 4268, 0, '0', '2019-04-01 00:26:45', 'N14615', '2019-04-01 00:26:45', '-', 0),
	(10077, 3, 130, 289, 4269, 0, '0', '2019-04-01 00:26:45', 'N14615', '2019-04-01 00:26:45', '-', 0),
	(10078, 3, 130, 289, 4271, 5, '0', '2019-04-01 00:26:45', 'N14615', '2019-04-01 00:26:45', '-', 0),
	(10079, 3, 130, 289, 4259, 0, '0', '2019-04-01 00:26:45', 'N14615', '2019-04-01 00:26:45', '-', 0),
	(10080, 3, 130, 290, 4257, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10081, 3, 130, 290, 4272, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10082, 3, 130, 290, 4258, 4, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10083, 3, 130, 290, 4260, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10084, 3, 130, 290, 4261, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10085, 3, 130, 290, 4262, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10086, 3, 130, 290, 4263, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10087, 3, 130, 290, 4264, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10088, 3, 130, 290, 4265, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10089, 3, 130, 290, 4266, 0, '0', '2019-04-02 07:00:38', 'N14615', '2019-04-02 07:00:38', '-', 0),
	(10090, 3, 130, 290, 4267, 5, '0', '2019-04-02 07:01:07', 'N14615', '2019-04-02 07:01:07', '-', 0),
	(10091, 3, 130, 290, 4268, 5, '0', '2019-04-02 07:01:07', 'N14615', '2019-04-02 07:01:07', '-', 0),
	(10092, 3, 130, 290, 4269, 5, '0', '2019-04-02 07:01:07', 'N14615', '2019-04-02 07:01:07', '-', 0),
	(10093, 3, 130, 290, 4271, 0, '0', '2019-04-02 07:01:07', 'N14615', '2019-04-02 07:01:07', '-', 0),
	(10094, 3, 130, 290, 4259, 0, '0', '2019-04-02 07:01:07', 'N14615', '2019-04-02 07:01:07', '-', 0);
/*!40000 ALTER TABLE `privi_group_pt_app_mod` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_modules
DROP TABLE IF EXISTS `privi_modules`;
CREATE TABLE IF NOT EXISTS `privi_modules` (
  `idprivi_modules` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps /application',
  `vCodeModule` varchar(50) DEFAULT NULL,
  `vNameModule` varchar(255) NOT NULL COMMENT 'caption ',
  `vPathModule` varchar(255) NOT NULL COMMENT 'module path',
  `className` varchar(255) NOT NULL,
  `iParent` int(11) NOT NULL DEFAULT '0' COMMENT 'pointing into child',
  `txtDesc` text COMMENT 'Description',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  `iType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Menus, 1 = Modules',
  `iValidation` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= off , 1=on',
  PRIMARY KEY (`idprivi_modules`),
  KEY `iParent` (`iParent`),
  KEY `isDeleted` (`isDeleted`),
  KEY `apps` (`idprivi_apps`)
) ENGINE=MyISAM AUTO_INCREMENT=4273 DEFAULT CHARSET=latin1 COMMENT='Data modules per aplikasi';

-- Dumping data for table erp_privi.privi_modules: 34 rows
/*!40000 ALTER TABLE `privi_modules` DISABLE KEYS */;
REPLACE INTO `privi_modules` (`idprivi_modules`, `idprivi_apps`, `vCodeModule`, `vNameModule`, `vPathModule`, `className`, `iParent`, `txtDesc`, `tCreatedAt`, `cCreatedBy`, `tUpdatedAt`, `cUpdatedBy`, `isDeleted`, `iType`, `iValidation`) VALUES
	(2349, 80, 'Priv2.2_Privilege', 'Privilege', 'priv2/priv2/privilege', '', 0, 'Privilege', '0000-00-00 00:00:00', '-', '2013-03-07 14:22:28', '-', 0, 1, 1),
	(2350, 80, 'Priv2.1_UpdateUserInformation', 'Update User Information', 'priv2/priv2/system/updateuserinformation', '', 2348, 'Update User Information', '0000-00-00 00:00:00', '-', '2013-03-07 14:23:16', '-', 0, 1, 1),
	(2351, 80, 'Priv2.1_Applications', 'Applications', 'Privilege2/priv2/setup/application', '', 2354, 'Applications', '0000-00-00 00:00:00', '-', '2013-08-26 11:00:07', '-', 0, 1, 1),
	(2352, 80, 'Priv2.2_Groups', 'Groups', 'priv2/priv2/privilege/groups', '', 2354, 'Groups', '0000-00-00 00:00:00', '-', '2013-08-29 08:19:20', 'N06081', 1, 1, 1),
	(2353, 80, 'Priv2.2_AuthorizationList', 'Authorization List', 'Privilege2/priv2/authorization_list', '', 2349, 'Authorization List', '0000-00-00 00:00:00', '-', '2013-08-30 08:00:57', 'N06081', 0, 1, 1),
	(2354, 80, 'Priv2.1_Setup', 'Setup', 'priv2/priv2/Setup', '', 2349, 'Setup', '0000-00-00 00:00:00', '-', '2013-03-07 14:38:42', '-', 0, 1, 1),
	(2390, 80, 'Modules', 'Modules', 'Privilege2/priv2/setup/modules', '', 2354, 'MOdules', '0000-00-00 00:00:00', '-', '2013-08-26 11:02:51', '-', 0, 1, 1),
	(3414, 106, '1.Master', 'Master', 'schedulercheck/master', '', 0, NULL, '2016-11-16 09:37:34', 'N14615', '2016-11-16 09:37:34', 'N14615', 0, 0, 1),
	(3715, 106, '0.0.0', 'Generate ERP Standart Master', 'schedulercheck/createCRUD', '', 3414, NULL, '2017-08-10 15:27:47', 'N16945', '2017-08-10 15:27:47', 'N16945', 0, 1, 1),
	(3721, 106, '0.0.1', 'Scheduler Generator', 'schedulercheck/scheduler_generator', '', 3414, NULL, '2017-08-16 08:23:10', 'N14615', '2017-08-16 08:23:10', 'N14615', 0, 1, 1),
	(3891, 106, '1.5.TestSend Mail', 'Send Mail NodeJs', 'schedulercheck/send_mail', '', 3414, NULL, '2018-01-24 15:33:15', 'N15748', '2018-01-24 15:33:15', 'N15748', 0, 1, 1),
	(3895, 106, '1.6.Inbox', 'Inbox ERP', 'schedulercheck/inbox_erp_core', '', 3414, NULL, '2018-01-26 11:14:11', 'N15748', '2018-01-30 14:46:20', 'N15748', 0, 1, 1),
	(4010, 106, '0.0.1', 'Modul Generator', 'schedulercheck/generatemodul', '', 3414, NULL, '2018-06-25 10:35:33', 'N14615', '2018-06-25 10:35:33', 'N14615', 0, 1, 1),
	(4186, 106, '1.9.sample_modul_upload', 'Sample Modul Upload', 'schedulercheck/product', '', 3414, NULL, '2018-11-06 15:15:13', 'N14615', '2018-11-06 15:15:13', 'N14615', 0, 1, 1),
	(4219, 106, '1.1.1.generatemodul_plc', 'Generate Module PLC', 'schedulercheck/generatemodul_plc', '', 3414, NULL, '2018-12-28 10:42:26', 'N16945', '2018-12-28 10:44:30', 'N16945', 0, 1, 1),
	(4254, 129, '1.0.0_master_employee', 'Master Employee', 'umum/master_employee', '', 0, NULL, '2019-01-26 14:45:31', 'N14615', '2019-01-26 14:45:31', 'N14615', 0, 1, 1),
	(4255, 129, '1.1.0', 'Master Divisi', 'umum/master_divisi', '', 0, NULL, '2019-01-26 14:54:45', 'N14615', '2019-01-26 14:54:45', 'N14615', 0, 1, 1),
	(4256, 129, '1.2.0_Master_Customer', 'Master Customer', 'umum/master_customer', '', 0, NULL, '2019-01-26 15:37:14', 'N14615', '2019-01-26 15:37:14', 'N14615', 0, 1, 1),
	(4257, 130, '1.0.0.master', 'Master', 'pengujian/master', '', 0, NULL, '2019-01-26 20:33:27', 'N14615', '2019-01-26 20:33:27', 'N14615', 0, 0, 1),
	(4258, 130, '2.0.0.transaksi', 'Transaksi', 'pengujian/transaksi', '', 0, NULL, '2019-01-26 20:34:19', 'N14615', '2019-01-26 20:35:02', 'N14615', 0, 0, 1),
	(4259, 130, '3.0.0.report', 'Laporan', 'pengujian/report', '', 0, NULL, '2019-01-26 20:35:47', 'N14615', '2019-01-26 20:35:47', 'N14615', 0, 0, 1),
	(4260, 130, '2.1.0.mt01', 'MT 01', 'pengujian/mt01', '', 4258, NULL, '2019-01-26 20:36:32', 'N14615', '2019-01-26 20:37:50', 'N14615', 0, 1, 1),
	(4261, 130, '2.2.0_mt02', 'MT 02', 'pengujian/mt02', '', 4258, NULL, '2019-01-26 20:37:25', 'N14615', '2019-01-26 20:37:25', 'N14615', 0, 1, 1),
	(4262, 130, '2.3.0_mt03', 'MT 03', 'pengujian/mt03', '', 4258, NULL, '2019-01-26 20:40:23', 'N14615', '2019-01-26 20:40:23', 'N14615', 0, 1, 1),
	(4263, 130, '2.4.0_mt04', 'MT 04', 'pengujian/mt04', '', 4258, NULL, '2019-01-27 00:20:51', 'N14615', '2019-01-27 00:20:51', 'N14615', 0, 1, 1),
	(4264, 130, '2.5.0_mt5', 'MT 05', 'pengujian/mt05', '', 4258, NULL, '2019-01-27 00:21:21', 'N14615', '2019-01-27 00:21:21', 'N14615', 0, 1, 1),
	(4265, 130, '2.6.0_mt06', 'MT 06', 'pengujian/mt06', '', 4258, NULL, '2019-01-27 00:21:54', 'N14615', '2019-01-27 00:21:54', 'N14615', 0, 1, 1),
	(4266, 130, '2.7.0_mt07', 'MT 07', 'pengujian/mt07', '', 4258, NULL, '2019-01-27 00:24:51', 'N14615', '2019-01-27 00:24:51', 'N14615', 0, 1, 1),
	(4267, 130, '2.8.1_mt8a', 'MT 8A', 'pengujian/mt8a', '', 4258, NULL, '2019-01-27 00:25:20', 'N14615', '2019-01-27 00:25:20', 'N14615', 0, 1, 1),
	(4268, 130, '2.8.2_mt8b', 'MT 8B', 'pengujian/mt8b', '', 4258, NULL, '2019-01-27 00:25:48', 'N14615', '2019-01-27 00:25:48', 'N14615', 0, 1, 1),
	(4269, 130, '2.9.0_mt09', 'MT 09 ', 'pengujian/mt09', '', 4258, NULL, '2019-01-27 00:26:17', 'N14615', '2019-01-27 00:26:17', 'N14615', 0, 1, 1),
	(4270, 130, '2.7.1_mt74', 'MT 74', 'pengujian/mt74', '', 4258, NULL, '2019-01-27 00:26:49', 'N14615', '2019-03-31 22:29:31', 'N14615', 1, 1, 1),
	(4271, 130, '20.1.0_sertifikat', 'Sertifikat', 'pengujian/sertifikat', '', 4258, NULL, '2019-01-27 00:28:20', 'N14615', '2019-01-27 00:31:16', 'N14615', 0, 1, 1),
	(4272, 130, '1.2.0_approval_registrasi', 'Approval Registrasi', 'pengujian/verifikasi', '', 4258, NULL, '2019-01-27 00:34:32', 'N14615', '2019-02-03 14:28:45', 'N14615', 0, 1, 1);
/*!40000 ALTER TABLE `privi_modules` ENABLE KEYS */;

-- Dumping structure for procedure erp_privi.privi_proc_menu
DROP PROCEDURE IF EXISTS `privi_proc_menu`;
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

-- Dumping structure for table erp_privi.privi_pt_app
DROP TABLE IF EXISTS `privi_pt_app`;
CREATE TABLE IF NOT EXISTS `privi_pt_app` (
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'id table hrd.company - nama perusahaan',
  `idprivi_apps` int(11) NOT NULL DEFAULT '0' COMMENT 'id table privi_apps - aplikasi',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated At',
  `cUpdateBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iCompanyId`,`idprivi_apps`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Daftar aplikasi u/ per perusahaan ';

-- Dumping data for table erp_privi.privi_pt_app: 0 rows
/*!40000 ALTER TABLE `privi_pt_app` DISABLE KEYS */;
/*!40000 ALTER TABLE `privi_pt_app` ENABLE KEYS */;

-- Dumping structure for table erp_privi.privi_session_log
DROP TABLE IF EXISTS `privi_session_log`;
CREATE TABLE IF NOT EXISTS `privi_session_log` (
  `idprivi_session_hist` int(10) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `cNip` char(7) NOT NULL DEFAULT '0' COMMENT 'NIP username',
  `iCompanyId` int(2) NOT NULL DEFAULT '0' COMMENT 'ID table hrd.company/ daftar perusahaan',
  `vSessionID` varchar(255) NOT NULL DEFAULT '0' COMMENT 'session ID',
  `dLoginAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Login At Time',
  `dLogoutAt` datetime DEFAULT NULL COMMENT 'Logout At Time',
  `vIPSource` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Source IP address',
  `tUpdatedAt` timestamp NULL DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`idprivi_session_hist`)
) ENGINE=MyISAM AUTO_INCREMENT=233 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Contain with session historical after login succeed ';

-- Dumping data for table erp_privi.privi_session_log: 16 rows
/*!40000 ALTER TABLE `privi_session_log` DISABLE KEYS */;
REPLACE INTO `privi_session_log` (`idprivi_session_hist`, `cNip`, `iCompanyId`, `vSessionID`, `dLoginAt`, `dLogoutAt`, `vIPSource`, `tUpdatedAt`, `cUpdatedBy`) VALUES
	(217, 'N14615', 3, 'bkcu5vmfg1o9krfttjj0o71j61', '2019-04-08 01:59:11', '2019-04-08 01:59:11', '127.0.0.1', NULL, NULL),
	(218, 'N14616', 3, 'popjijkdeg2mmdn6thghob2qo2', '2019-01-26 13:40:33', '2019-01-26 13:40:33', '127.0.0.1', NULL, NULL),
	(219, 'A00001', 3, 'fv60k95g9lvv6i5mk5840b5mb4', '2019-04-13 17:49:49', '0000-00-00 00:00:00', '::1', NULL, NULL),
	(220, 'C00001', 3, '1fndh8pa61hdqg427lfm7vei95', '2019-02-03 22:10:22', '2019-02-03 22:10:22', '127.0.0.1', NULL, NULL),
	(221, 'A00002', 3, 'rbm4tj7uqmipli09lvbslb5de6', '2019-04-13 19:32:50', '2019-04-13 19:32:50', '127.0.0.1', NULL, NULL),
	(222, 'A00003', 3, 'ufov6b1dapdvd9g4ap4g9qsb67', '2019-04-13 19:27:28', '2019-04-13 19:27:28', '127.0.0.1', NULL, NULL),
	(223, 'A00004', 3, 'jmhcr3ivjjtmppu8mmmgek7jh1', '2019-04-13 19:33:12', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(224, 'A00005', 3, 'q7e244a57rd3i7mi1o4r8mk8n7', '2019-04-08 02:36:20', '2019-04-08 02:36:20', '127.0.0.1', NULL, NULL),
	(225, 'A00006', 3, '8965piljrsvormk4ga31u3pnd7', '2019-02-03 21:26:42', '2019-02-03 21:26:42', '127.0.0.1', NULL, NULL),
	(226, 'C00002', 3, '56ja7c48o2td93f4nuh95r2pf7', '2019-03-31 16:19:33', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(227, 'C00011', 3, 'jbh438o5tpfhvdlpmo4m2aaqc7', '2019-04-05 01:56:49', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(228, 'C00013', 3, 'ji09m3k85fi643l8rdvbelhc45', '2019-04-05 01:46:23', '2019-04-05 01:46:23', '127.0.0.1', NULL, NULL),
	(229, 'A00007', 3, 'mn4o4o31phk0vi2hgac603ohi7', '2019-04-08 02:35:02', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(230, 'A00008', 3, 'f18nl0d4j3l6hvllvjfkk1rj70', '2019-04-08 02:36:40', '0000-00-00 00:00:00', '127.0.0.1', NULL, NULL),
	(231, 'A00032', 3, '94dgul88c0s0b2kp7h01p52166', '2019-04-08 02:31:20', '2019-04-08 02:31:20', '127.0.0.1', NULL, NULL),
	(232, 'C00047', 3, '5iiti105b3sfdo5hdd0mbl66v0', '2019-04-08 00:03:59', '2019-04-08 00:03:59', '127.0.0.1', NULL, NULL);
/*!40000 ALTER TABLE `privi_session_log` ENABLE KEYS */;

-- Dumping structure for table erp_privi.role_data
DROP TABLE IF EXISTS `role_data`;
CREATE TABLE IF NOT EXISTS `role_data` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `user_create` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.role_data: 1 rows
/*!40000 ALTER TABLE `role_data` DISABLE KEYS */;
REPLACE INTO `role_data` (`ID`, `roleName`, `create_date`, `user_create`, `update_date`, `user_update`, `deleted`, `status`) VALUES
	(1, 'Administrator', '2012-05-07 13:53:20', 1, '2012-09-18 09:15:54', 1, 0, 1);
/*!40000 ALTER TABLE `role_data` ENABLE KEYS */;

-- Dumping structure for table erp_privi.role_perms
DROP TABLE IF EXISTS `role_perms`;
CREATE TABLE IF NOT EXISTS `role_perms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.role_perms: 0 rows
/*!40000 ALTER TABLE `role_perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_perms` ENABLE KEYS */;

-- Dumping structure for table erp_privi.user_data
DROP TABLE IF EXISTS `user_data`;
CREATE TABLE IF NOT EXISTS `user_data` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `vNip` varchar(7) NOT NULL,
  `vPassword` varchar(32) NOT NULL,
  `vName` varchar(200) NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nip` (`vNip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.user_data: 0 rows
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;

-- Dumping structure for table erp_privi.user_perms
DROP TABLE IF EXISTS `user_perms`;
CREATE TABLE IF NOT EXISTS `user_perms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.user_perms: 0 rows
/*!40000 ALTER TABLE `user_perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_perms` ENABLE KEYS */;

-- Dumping structure for table erp_privi.user_roles
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` bigint(20) NOT NULL,
  `roleID` bigint(20) NOT NULL,
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table erp_privi.user_roles: 2 rows
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
REPLACE INTO `user_roles` (`ID`, `userID`, `roleID`, `addDate`) VALUES
	(1, 1, 1, '2012-09-18 15:08:32'),
	(2, 2, 1, '2013-02-01 17:23:49');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;


-- Dumping database structure for gps_msg
DROP DATABASE IF EXISTS `gps_msg`;
CREATE DATABASE IF NOT EXISTS `gps_msg` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gps_msg`;

-- Dumping structure for table gps_msg.erp_inbox
DROP TABLE IF EXISTS `erp_inbox`;
CREATE TABLE IF NOT EXISTS `erp_inbox` (
  `inbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_count` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `modul_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `cnip_sender` char(50) NOT NULL DEFAULT '0',
  `vsubject` varchar(255) NOT NULL DEFAULT '0',
  `tmessage` text NOT NULL COMMENT 'disimpan dalam html',
  `vto` varchar(255) NOT NULL DEFAULT '0',
  `vcc` varchar(255) NOT NULL DEFAULT '0',
  `dcreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `ccreate` char(50) DEFAULT NULL,
  `dupdate` datetime DEFAULT NULL,
  `cupdate` char(50) DEFAULT NULL,
  `ldeleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`inbox_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Dumping data for table gps_msg.erp_inbox: ~40 rows (approximately)
/*!40000 ALTER TABLE `erp_inbox` DISABLE KEYS */;
REPLACE INTO `erp_inbox` (`inbox_id`, `send_count`, `company_id`, `modul_id`, `group_id`, `cnip_sender`, `vsubject`, `tmessage`, `vto`, `vcc`, `dcreate`, `ccreate`, `dupdate`, `cupdate`, `ldeleted`) VALUES
	(17, 1, 0, 3988, 0, 'N14615', 'Complain - New Complain CP00000055', '\n                Diberitahukan bahwa telah ada Permintaan Complain, dan membutuhkan Approval dari anda sebagai atasan dari requestor.\n                dengan rincian sebagai berikut :<br><br>  \n                    <table border=\'0\' style=\'width: 600px;\'>\n                        <tr>\n                                <td style=\'width: 110px;\'><b>Requestor</b></td><td style=\'width: 20px;\'> : </td>\n                                <td>N14615 || MANSUR</td>\n                        </tr>\n                        <tr>\n                                <td><b>No Request</b></td><td> : </td>\n                                <td>CP00000055</td>\n                        </tr> \n                        <tr>\n                                <td><b>Tanggal Request  </b></td><td> : </td>\n                                <td>2018-07-05</td>\n                        </tr> \n                        <tr>\n                                <td><b>Jenis Complain  </b></td><td> : </td>\n                                <td>Regular</td>\n                        </tr>\n\n                        <tr>\n                                <td><b>Lokasi Modul</b></td><td> : </td>\n                                <td> Complain -> Transaksi -> Request Complain</td>\n                        </tr>\n                        \n                    </table> \n\n                <br/> <br/>\n                Demikian, mohon segera follow up  pada aplikasi ERP Complain. Terimakasih.<br><br><br>\n                Post Master', 'N13986', 'N14615', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0),
	(18, 1, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td>: R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td>: C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td>: Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td>:Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td>:PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td>: <p>Jakarta</p></td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td>:Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td>: <p>Alamat produsennya</p></td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td>:Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td>:Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,', 'C00011,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(19, 0, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat produsennya</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,', 'C00011,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(20, 1, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat produsennya</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,', 'C00011,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(21, 1, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat produsennya</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,', 'C00011,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(22, 1, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat produsennya</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,', 'C00011,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(23, 1, 0, 4260, 0, 'C00011', 'e-Pengujian -> New MT01 R00006', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00006</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor 1 Message</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Nomor 1 Message</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Produses</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat produsennya</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Sample Okeh</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'C00011,N14615', '2019-04-05 02:30:40', 'C00011', NULL, NULL, 0),
	(24, 0, 0, 4271, 0, 'A00005', 'e-Pengujian -> Approve SPHU Sertifikat R00002', '\r\n                            <p>Diberitahukan bahwa Admin SPHU telah melakukan Approval Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,', 'A00005,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(25, 0, 0, 4271, 0, 'A00005', 'e-Pengujian -> Approve SPHU Sertifikat R00002', '\r\n                            <p>Diberitahukan bahwa Admin SPHU telah melakukan Approval Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00005,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(26, 1, 0, 4271, 0, 'A00008', 'e-Pengujian -> Confirm SPHU Sertifikat R00002', '\r\n                            <p>Diberitahukan bahwa Admin Keuangan telah melakukan Konformasi Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00008,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(27, 1, 0, 4267, 0, 'A00032', 'e-Pengujian -> Approve QA MT8A R00002', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT8A yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> MT8A</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00032,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(28, 0, 0, 4268, 0, 'A00032', 'e-Pengujian -> Approve QA MT8B ', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT8B yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> :  || </td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : </td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : </td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt8B</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00032,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(29, 1, 0, 4268, 0, 'A00032', 'e-Pengujian -> Approve QA MT8B ', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT8B yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> :  || </td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : </td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : </td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt8B</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00032,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(30, 1, 0, 4268, 0, 'A00032', 'e-Pengujian -> Approve QA MT8B R00002', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT8B yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt8B</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00032,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(31, 1, 0, 4269, 0, 'A00032', 'e-Pengujian -> Approve QA MT9 R00002', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT9 yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt9</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'A00032,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(32, 0, 0, 4272, 0, '44', 'e-Pengujian -> Registrasi User  - ', '\r\n                            <p>Diberitahukan bahwa Ada Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> :  || </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : </td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', ',select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\n', '2019-04-07 03:07:14', '44', NULL, NULL, 0),
	(33, 0, 0, 4272, 0, '45', 'e-Pengujian -> Registrasi User C00045 - Hima', '\r\n                            <p>Diberitahukan bahwa Ada Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00045 || Hima</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :hima@gmail.com</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : sasa</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :sasa</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :sasa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : sasa</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :sasa</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', ',select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwhere \r\n', '2019-04-07 03:10:57', '45', NULL, NULL, 0),
	(34, 0, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00002', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007', 'A00001,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(35, 0, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00002', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00011 || Cakra</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Penggemuk Badan</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT. HaHa</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Jakarta</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :PT Langsing</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Di Kontrakan</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Ulang</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007', 'A00001,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(36, 0, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00002', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007', 'A00001,select a.idprivi_group,a.vNamaGroup,c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoin erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps\r\njoin erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp\r\nwh', '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(37, 1, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00002', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007,A00002,A00004', 'A00001,N14615', '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(38, 1, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00002', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00002</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : Vitamin</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Susu Ultra</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007,A00003,A00002,A00004', 'A00001,N14615', '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(39, 0, 0, 4272, 0, 'C00046', 'e-Pengujian -> Registrasi User C00046 - Jaki', '\r\n                            <p>Diberitahukan bahwa Ada Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00046 || Jaki</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :jaki@gmail.com</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat Jaki</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :081324012345</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT Jaki Indonesia</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : Alamat perusahaan jaki</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :081324012345</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'N14615', '2019-04-07 22:43:40', '46', NULL, NULL, 0),
	(40, 0, 0, 4272, 0, 'C00047', 'e-Pengujian -> Registrasi User C00047 - Deru Siga', '\r\n                            <p>Diberitahukan bahwa Ada Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :deru.siga@gmail.com</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat deru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :021114562</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :021114562</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'N14615', '2019-04-07 22:52:06', 'C00047', NULL, NULL, 0),
	(41, 0, 0, 4272, 0, 'C00048', 'e-Pengujian -> Registrasi User C00048 - User Customer Test', '\r\n                            <p>Diberitahukan bahwa Ada Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00048 || User Customer Test</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :testuser@gmail.com</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat USernya</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :021345678</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :PT Suka suka Indonesia</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : Alamat perusahaan suka suka</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :021345678</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'N14615', '2019-04-07 22:59:55', 'C00048', NULL, NULL, 0),
	(42, 0, 0, 4272, 0, 'A00001', 'e-Pengujian -> Approve Registrasi User C00047 - Deru Siga', '\r\n                            <p>Diberitahukan bahwa Telah ada Approval Registrasi User baru  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Email</b></td>\r\n                                        <td> :deru.siga@gmail.com</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat deru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon</b></td>\r\n                                        <td> :021114562</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Perusahaan</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No. Telepon Perusahaan</b></td>\r\n                                        <td> :021114562</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00001', 'N14615', '2019-04-07 23:12:13', 'A00001', NULL, NULL, 0),
	(43, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00007', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00007</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00047 || Deru Siga</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : 1001</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Permohonan pengujian </td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :Lambo Indo</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Alamat perusahaan Lambo</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Lambo Indo</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat perusahaan Lambo</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Zuk Tayo</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-07 23:31:37', 'A00001', NULL, NULL, 0),
	(44, 0, 0, 4266, 0, 'A00001', 'e-Pengujian -> Submit MT7 R00007', '\r\n                            <p>Diberitahukan bahwa Ada Sample Pengujian masuk  yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt7</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00007,A00003,A00002,A00004', 'A00001,N14615', '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(45, 0, 0, 4269, 0, 'A00032', 'e-Pengujian -> Approve QA MT9 R00007', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT9 yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt9</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00008,A00007,A00005,A00001', 'A00032,N14615', '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(46, 0, 0, 4269, 0, 'A00032', 'e-Pengujian -> Approve QA MT9 R00007', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT9 yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt9</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00008,A00007,A00005,A00001', 'A00032,N14615', '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(47, 0, 0, 4267, 0, 'A00032', 'e-Pengujian -> Approve QA MT8A R00007', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT8A yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> MT8A</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00008,A00007,A00005,A00001', 'A00032,N14615', '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(48, 0, 0, 4269, 0, 'A00032', 'e-Pengujian -> Approve QA MT9 R00007', '\r\n                            <p>Diberitahukan bahwa Admin QA telah melakukan Approval Pengujian MT9 yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Mt9</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00008,A00007,A00005,A00001', 'A00032,N14615', '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(49, 0, 0, 4271, 0, 'A00005', 'e-Pengujian -> Approve SPHU Sertifikat R00007', '\r\n                            <p>Diberitahukan bahwa Admin SPHU telah melakukan Approval Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', '0,A00008,A00007,A00005,A00001', 'A00005,N14615', '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(50, 0, 0, 4271, 0, 'A00007', 'e-Pengujian -> Approve TU Sertifikat R00007', '\r\n                            <p>Diberitahukan bahwa Admin TU telah melakukan Approval Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', 'C00047,A00008,A00007,A00005,A00001', 'A00007,N14615', '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(51, 0, 0, 4271, 0, 'A00008', 'e-Pengujian -> Confirm Admin Keuangan Sertifikat R00007', '\r\n                            <p>Diberitahukan bahwa Admin Keuangan telah melakukan Konfirmasi Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                            <br><br>  \r\n                            <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                        <td> : R00007</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                        <td> : C00047 || Deru Siga</td>\r\n                                </tr>\r\n\r\n\r\n                                <tr>\r\n                                        <td><b>No Permintaan</b></td>\r\n                                        <td> : 1001</td>\r\n                                </tr> \r\n                                <tr>\r\n                                        <td><b>Perihal</b></td>\r\n                                        <td> :Permohonan pengujian </td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Nama Perusahaan</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Produsen</b></td>\r\n                                        <td> :Lambo Indo</td>\r\n                                </tr> \r\n\r\n                                <tr>\r\n                                        <td><b>Alamat Produsen</b></td>\r\n                                        <td> : Alamat perusahaan Lambo</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                        <td> : Daftar Baru</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Nama Sample</b></td>\r\n                                        <td> : Zuk Tayo</td>\r\n                                </tr>  \r\n                                <tr>\r\n                                        <td><b>Status</b></td>\r\n                                        <td> : Approve</td>\r\n                                </tr>\r\n\r\n                                <tr>\r\n                                        <td><b>Lokasi Modul</b></td>\r\n                                        <td> e-Pengujian -> Transaksi -> Sertifikat</td>\r\n                                </tr>\r\n                                \r\n                            </table> \r\n\r\n                        <br/> <br/>\r\n                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                        Post Master', 'C00047,A00008,A00007,A00005,A00001', 'A00008,N14615', '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(52, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00008', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00008</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : nomor surat terbaru </td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :perihal terbaru </td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Pelayanan Teknis</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :nama sample terbaru</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-13 15:54:33', 'A00001', NULL, NULL, 0),
	(53, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00009', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00009</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : Nomor dengan file</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :ada upload </td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :dengan upload </td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-13 16:02:26', 'A00001', NULL, NULL, 0),
	(54, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00010', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00010</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00006 || Rama</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : draft dengan file</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :draft dengan file</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. WOKE</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :PT. WOKE</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :draft dengan file</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-13 16:11:40', 'A00001', NULL, NULL, 0),
	(55, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00011', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00011</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00011 || Cakra</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : coba draft submit</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :coba draft submit</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :PT. HaHa</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Kiriman Dinas</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :coba draft submit</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-13 16:15:57', 'A00001', NULL, NULL, 0),
	(56, 1, 0, 4260, 0, 'A00001', 'e-Pengujian -> New MT01 R00012', '\r\n                        <p>Diberitahukan bahwa ada Permintaan Permohonan Kontrak Pengujian Mutu Obat Hewan baru yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00012</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00013 || Gilang</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : coba draft lagi </td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> : coba draft lagi </td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :PT. WAW</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> : PT. WAW</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Jakarta</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> : Kiriman Dinas</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> : coba draft lagi </td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT01</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00001', 'A00001,N14615', '2019-04-13 16:18:44', 'A00001', NULL, NULL, 0),
	(57, 0, 0, 4264, 0, 'A00001', 'e-Pengujian -> New MT05 003-112-789', '\r\n                        <p>Diberitahukan bahwa ada Approval Form MT05 yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>\r\n                        <br><br>  \r\n                        <table border=\'1\' style=\'width: 750px;border-collapse: collapse;\'>\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Pengujian</b></td>\r\n                                    <td> : 003-112-789</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Status</b></td>\r\n                                    <td> : Approve</td>\r\n                            </tr>\r\n\r\n\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nomor Transaksi</b></td>\r\n                                    <td> : R00007</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td style=\'width: 30%;\'><b>Nama Pemohon</b></td>\r\n                                    <td> : C00047 || Deru Siga</td>\r\n                            </tr>\r\n\r\n\r\n                            <tr>\r\n                                    <td><b>No Permintaan</b></td>\r\n                                    <td> : 1001</td>\r\n                            </tr> \r\n                            <tr>\r\n                                    <td><b>Perihal</b></td>\r\n                                    <td> :Permohonan pengujian </td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Nama Perusahaan</b></td>\r\n                                    <td> :Lambo Indo</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat</b></td>\r\n                                    <td> : Alamat perusahaan Lambo</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Produsen</b></td>\r\n                                    <td> :Lambo Indo</td>\r\n                            </tr> \r\n\r\n                            <tr>\r\n                                    <td><b>Alamat Produsen</b></td>\r\n                                    <td> : Alamat perusahaan Lambo</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Tujuan Pengujian Mutu</b></td>\r\n                                    <td> :Daftar Baru</td>\r\n                            </tr>\r\n\r\n                            <tr>\r\n                                    <td><b>Nama Sample</b></td>\r\n                                    <td> :Zuk Tayo</td>\r\n                            </tr>  \r\n\r\n\r\n                            <tr>\r\n                                    <td><b>Lokasi Modul</b></td>\r\n                                    <td> e-Pengujian -> Transaksi -> MT05</td>\r\n                            </tr>\r\n\r\n                            \r\n                            \r\n                        </table> \r\n\r\n                    <br/> <br/>\r\n                    Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>\r\n                    Post Master', '0,A00007,C00047', 'A00001,N14615', '2019-04-13 18:41:42', 'A00001', NULL, NULL, 0);
/*!40000 ALTER TABLE `erp_inbox` ENABLE KEYS */;

-- Dumping structure for table gps_msg.erp_inbox_details
DROP TABLE IF EXISTS `erp_inbox_details`;
CREATE TABLE IF NOT EXISTS `erp_inbox_details` (
  `inbox_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(11) NOT NULL DEFAULT '0',
  `cnip` char(50) NOT NULL DEFAULT '0',
  `istatus_received` tinyint(2) NOT NULL DEFAULT '0',
  `istatus_read` int(11) NOT NULL DEFAULT '0' COMMENT '0=>New, 1=>Read',
  `dreceived` datetime DEFAULT NULL,
  `dread` datetime DEFAULT NULL,
  `dcreate` datetime DEFAULT NULL,
  `ccreate` char(50) DEFAULT NULL,
  `dupdate` date DEFAULT NULL,
  `cupdate` char(50) DEFAULT NULL,
  `ldeleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`inbox_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;

-- Dumping data for table gps_msg.erp_inbox_details: ~212 rows (approximately)
/*!40000 ALTER TABLE `erp_inbox_details` DISABLE KEYS */;
REPLACE INTO `erp_inbox_details` (`inbox_detail_id`, `inbox_id`, `cnip`, `istatus_received`, `istatus_read`, `dreceived`, `dread`, `dcreate`, `ccreate`, `dupdate`, `cupdate`, `ldeleted`) VALUES
	(32, 17, 'N13986', 1, 1, '2018-08-23 05:50:19', '2018-08-23 05:50:23', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0),
	(33, 17, 'N14615', 1, 1, '2018-07-09 15:00:00', '2018-07-10 10:22:50', '2018-07-06 09:18:52', 'N14615', NULL, NULL, 0),
	(34, 18, '0', 0, 0, NULL, NULL, '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(35, 18, '', 0, 0, NULL, NULL, '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(36, 18, 'C00011', 0, 1, NULL, '2019-04-05 02:16:31', '2019-04-05 02:15:53', 'C00011', '0000-00-00', NULL, 0),
	(37, 18, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(38, 18, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(39, 18, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-05 02:15:53', 'C00011', NULL, NULL, 0),
	(40, 19, '0', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(41, 19, '', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(42, 19, 'C00011', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(43, 19, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(44, 19, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(45, 19, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-05 02:21:41', 'C00011', NULL, NULL, 0),
	(46, 20, '0', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(47, 20, '', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(48, 20, 'C00011', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(49, 20, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(50, 20, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(51, 20, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-05 02:24:28', 'C00011', NULL, NULL, 0),
	(52, 21, '0', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(53, 21, '', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(54, 21, 'C00011', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(55, 21, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(56, 21, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(57, 21, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-05 02:26:50', 'C00011', NULL, NULL, 0),
	(58, 22, '0', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(59, 22, '', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(60, 22, 'C00011', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(61, 22, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(62, 22, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(63, 22, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-05 02:28:21', 'C00011', NULL, NULL, 0),
	(64, 23, '0', 0, 0, NULL, NULL, '2019-04-05 02:30:40', 'C00011', NULL, NULL, 0),
	(65, 23, 'A00001', 0, 1, NULL, '2019-04-05 02:34:40', '2019-04-05 02:30:40', 'C00011', '0000-00-00', NULL, 0),
	(66, 23, 'C00011', 0, 1, NULL, '2019-04-05 02:35:06', '2019-04-05 02:30:40', 'C00011', '0000-00-00', NULL, 0),
	(67, 23, 'N14615', 0, 0, NULL, NULL, '2019-04-05 02:30:40', 'C00011', NULL, NULL, 0),
	(68, 24, '0', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(69, 24, '', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(70, 24, 'A00005', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(71, 24, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(72, 24, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(73, 24, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 01:43:17', 'A00005', NULL, NULL, 0),
	(74, 25, '0', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(75, 25, 'A00001', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(76, 25, 'A00005', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(77, 25, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(78, 25, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(79, 25, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 01:46:47', 'A00005', NULL, NULL, 0),
	(80, 26, '0', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(81, 26, 'A00001', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(82, 26, 'A00008', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(83, 26, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(84, 26, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(85, 26, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 01:50:43', 'A00008', NULL, NULL, 0),
	(86, 27, '0', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(87, 27, 'A00001', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(88, 27, 'A00032', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(89, 27, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(90, 27, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(91, 27, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 02:17:14', 'A00032', NULL, NULL, 0),
	(92, 28, '0', 0, 0, NULL, NULL, '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(93, 28, 'A00001', 0, 0, NULL, NULL, '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(94, 28, 'A00032', 0, 1, NULL, '2019-04-07 02:21:03', '2019-04-07 02:18:47', 'A00032', '0000-00-00', NULL, 0),
	(95, 28, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(96, 28, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(97, 28, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 02:18:47', 'A00032', NULL, NULL, 0),
	(98, 29, '0', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(99, 29, 'A00001', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(100, 29, 'A00032', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(101, 29, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(102, 29, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(103, 29, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 02:23:28', 'A00032', NULL, NULL, 0),
	(104, 30, '0', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(105, 30, 'A00001', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(106, 30, 'A00032', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(107, 30, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(108, 30, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(109, 30, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 02:26:17', 'A00032', NULL, NULL, 0),
	(110, 31, '0', 0, 0, NULL, NULL, '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(111, 31, 'A00001', 0, 1, NULL, '2019-04-07 02:37:23', '2019-04-07 02:37:00', 'A00032', '0000-00-00', NULL, 0),
	(112, 31, 'A00032', 0, 0, NULL, NULL, '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(113, 31, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(114, 31, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(115, 31, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 02:37:00', 'A00032', NULL, NULL, 0),
	(116, 32, '0', 0, 0, NULL, NULL, '2019-04-07 03:07:14', NULL, NULL, NULL, 0),
	(117, 32, 'A00001', 0, 1, NULL, '2019-04-07 03:10:13', '2019-04-07 03:07:14', NULL, '0000-00-00', NULL, 0),
	(118, 32, '', 0, 0, NULL, NULL, '2019-04-07 03:07:14', NULL, NULL, NULL, 0),
	(119, 32, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 03:07:14', NULL, NULL, NULL, 0),
	(120, 32, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 03:07:14', NULL, NULL, NULL, 0),
	(121, 32, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 03:07:14', NULL, NULL, NULL, 0),
	(122, 33, '0', 0, 0, NULL, NULL, '2019-04-07 03:10:57', NULL, NULL, NULL, 0),
	(123, 33, 'A00001', 0, 1, NULL, '2019-04-07 03:11:18', '2019-04-07 03:10:57', NULL, '0000-00-00', NULL, 0),
	(124, 33, '', 0, 0, NULL, NULL, '2019-04-07 03:10:57', NULL, NULL, NULL, 0),
	(125, 33, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 03:10:57', NULL, NULL, NULL, 0),
	(126, 33, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 03:10:57', NULL, NULL, NULL, 0),
	(127, 33, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 03:10:57', NULL, NULL, NULL, 0),
	(128, 34, '0', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(129, 34, 'A00007', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(130, 34, 'A00001', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(131, 34, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(132, 34, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(133, 34, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 03:39:14', 'A00001', NULL, NULL, 0),
	(134, 35, '0', 0, 0, NULL, NULL, '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(135, 35, 'A00007', 0, 0, NULL, NULL, '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(136, 35, 'A00001', 0, 1, NULL, '2019-04-07 03:40:38', '2019-04-07 03:40:02', 'A00001', '0000-00-00', NULL, 0),
	(137, 35, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(138, 35, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(139, 35, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 03:40:02', 'A00001', NULL, NULL, 0),
	(140, 36, '0', 0, 0, NULL, NULL, '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(141, 36, 'A00007', 0, 0, NULL, NULL, '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(142, 36, 'A00001', 0, 1, NULL, '2019-04-07 03:44:45', '2019-04-07 03:44:24', 'A00001', '0000-00-00', NULL, 0),
	(143, 36, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(144, 36, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(145, 36, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 03:44:24', 'A00001', NULL, NULL, 0),
	(146, 37, '0', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(147, 37, 'A00007', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(148, 37, 'A00002', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(149, 37, 'A00004', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(150, 37, 'A00001', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(151, 37, 'N14615', 0, 0, NULL, NULL, '2019-04-07 03:50:10', 'A00001', NULL, NULL, 0),
	(152, 38, '0', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(153, 38, 'A00007', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(154, 38, 'A00003', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(155, 38, 'A00002', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(156, 38, 'A00004', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(157, 38, 'A00001', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(158, 38, 'N14615', 0, 0, NULL, NULL, '2019-04-07 03:52:00', 'A00001', NULL, NULL, 0),
	(159, 39, '0', 0, 0, NULL, NULL, '2019-04-07 22:43:40', NULL, NULL, NULL, 0),
	(160, 39, 'A00001', 0, 1, NULL, '2019-04-07 22:44:52', '2019-04-07 22:43:40', NULL, '0000-00-00', NULL, 0),
	(161, 39, 'select a.idprivi_group', 0, 0, NULL, NULL, '2019-04-07 22:43:40', NULL, NULL, NULL, 0),
	(162, 39, 'a.vNamaGroup', 0, 0, NULL, NULL, '2019-04-07 22:43:40', NULL, NULL, NULL, 0),
	(163, 39, 'c.cNIP \r\nfrom erp_privi.privi_group_pt_app a \r\njoi', 0, 0, NULL, NULL, '2019-04-07 22:43:40', NULL, NULL, NULL, 0),
	(164, 40, '0', 0, 0, NULL, NULL, '2019-04-07 22:52:06', NULL, NULL, NULL, 0),
	(165, 40, 'A00001', 0, 1, NULL, '2019-04-07 22:52:41', '2019-04-07 22:52:06', NULL, '0000-00-00', NULL, 0),
	(166, 40, 'N14615', 0, 0, NULL, NULL, '2019-04-07 22:52:06', NULL, NULL, NULL, 0),
	(167, 41, '0', 0, 0, NULL, NULL, '2019-04-07 22:59:55', NULL, NULL, NULL, 0),
	(168, 41, 'A00001', 0, 1, NULL, '2019-04-07 23:00:42', '2019-04-07 22:59:55', NULL, '0000-00-00', NULL, 0),
	(169, 41, 'N14615', 0, 0, NULL, NULL, '2019-04-07 22:59:55', NULL, NULL, NULL, 0),
	(170, 42, '0', 0, 0, NULL, NULL, '2019-04-07 23:12:13', 'A00001', NULL, NULL, 0),
	(171, 42, 'A00001', 0, 0, NULL, NULL, '2019-04-07 23:12:13', 'A00001', NULL, NULL, 0),
	(172, 42, 'N14615', 0, 0, NULL, NULL, '2019-04-07 23:12:13', 'A00001', NULL, NULL, 0),
	(173, 43, '0', 0, 0, NULL, NULL, '2019-04-07 23:31:37', 'A00001', NULL, NULL, 0),
	(174, 43, 'A00001', 0, 0, NULL, NULL, '2019-04-07 23:31:37', 'A00001', NULL, NULL, 0),
	(175, 43, 'N14615', 0, 0, NULL, NULL, '2019-04-07 23:31:37', 'A00001', NULL, NULL, 0),
	(176, 44, '0', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(177, 44, 'A00007', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(178, 44, 'A00003', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(179, 44, 'A00002', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(180, 44, 'A00004', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(181, 44, 'A00001', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(182, 44, 'N14615', 0, 0, NULL, NULL, '2019-04-08 01:45:48', 'A00001', NULL, NULL, 0),
	(183, 45, '0', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(184, 45, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(185, 45, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(186, 45, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(187, 45, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(188, 45, 'A00032', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(189, 45, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:07:59', 'A00032', NULL, NULL, 0),
	(190, 46, '0', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(191, 46, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(192, 46, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(193, 46, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(194, 46, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(195, 46, 'A00032', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(196, 46, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:11:56', 'A00032', NULL, NULL, 0),
	(197, 47, '0', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(198, 47, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(199, 47, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(200, 47, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(201, 47, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(202, 47, 'A00032', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(203, 47, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:29:47', 'A00032', NULL, NULL, 0),
	(204, 48, '0', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(205, 48, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(206, 48, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(207, 48, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(208, 48, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(209, 48, 'A00032', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(210, 48, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:30:52', 'A00032', NULL, NULL, 0),
	(211, 49, '0', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(212, 49, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(213, 49, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(214, 49, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(215, 49, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(216, 49, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:35:54', 'A00005', NULL, NULL, 0),
	(217, 50, 'C00047', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(218, 50, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(219, 50, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(220, 50, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(221, 50, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(222, 50, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:36:47', 'A00007', NULL, NULL, 0),
	(223, 51, 'C00047', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(224, 51, 'A00008', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(225, 51, 'A00007', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(226, 51, 'A00005', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(227, 51, 'A00001', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(228, 51, 'N14615', 0, 0, NULL, NULL, '2019-04-08 02:37:43', 'A00008', NULL, NULL, 0),
	(229, 52, '0', 0, 0, NULL, NULL, '2019-04-13 15:54:33', 'A00001', NULL, NULL, 0),
	(230, 52, 'A00001', 0, 0, NULL, NULL, '2019-04-13 15:54:33', 'A00001', NULL, NULL, 0),
	(231, 52, 'N14615', 0, 0, NULL, NULL, '2019-04-13 15:54:33', 'A00001', NULL, NULL, 0),
	(232, 53, '0', 0, 0, NULL, NULL, '2019-04-13 16:02:26', 'A00001', NULL, NULL, 0),
	(233, 53, 'A00001', 0, 0, NULL, NULL, '2019-04-13 16:02:26', 'A00001', NULL, NULL, 0),
	(234, 53, 'N14615', 0, 0, NULL, NULL, '2019-04-13 16:02:26', 'A00001', NULL, NULL, 0),
	(235, 54, '0', 0, 0, NULL, NULL, '2019-04-13 16:11:40', 'A00001', NULL, NULL, 0),
	(236, 54, 'A00001', 0, 0, NULL, NULL, '2019-04-13 16:11:40', 'A00001', NULL, NULL, 0),
	(237, 54, 'N14615', 0, 0, NULL, NULL, '2019-04-13 16:11:40', 'A00001', NULL, NULL, 0),
	(238, 55, '0', 0, 0, NULL, NULL, '2019-04-13 16:15:57', 'A00001', NULL, NULL, 0),
	(239, 55, 'A00001', 0, 0, NULL, NULL, '2019-04-13 16:15:57', 'A00001', NULL, NULL, 0),
	(240, 55, 'N14615', 0, 0, NULL, NULL, '2019-04-13 16:15:57', 'A00001', NULL, NULL, 0),
	(241, 56, '0', 0, 0, NULL, NULL, '2019-04-13 16:18:44', 'A00001', NULL, NULL, 0),
	(242, 56, 'A00001', 0, 0, NULL, NULL, '2019-04-13 16:18:44', 'A00001', NULL, NULL, 0),
	(243, 56, 'N14615', 0, 0, NULL, NULL, '2019-04-13 16:18:44', 'A00001', NULL, NULL, 0),
	(244, 57, '0', 0, 0, NULL, NULL, '2019-04-13 18:41:42', 'A00001', NULL, NULL, 0),
	(245, 57, 'A00007', 0, 0, NULL, NULL, '2019-04-13 18:41:42', 'A00001', NULL, NULL, 0),
	(246, 57, 'C00047', 0, 0, NULL, NULL, '2019-04-13 18:41:42', 'A00001', NULL, NULL, 0),
	(247, 57, 'A00001', 0, 1, NULL, '2019-04-13 18:42:06', '2019-04-13 18:41:42', 'A00001', '0000-00-00', NULL, 0),
	(248, 57, 'N14615', 0, 0, NULL, NULL, '2019-04-13 18:41:42', 'A00001', NULL, NULL, 0);
/*!40000 ALTER TABLE `erp_inbox_details` ENABLE KEYS */;


-- Dumping database structure for hrd
DROP DATABASE IF EXISTS `hrd`;
CREATE DATABASE IF NOT EXISTS `hrd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hrd`;

-- Dumping structure for table hrd.area
DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `iAreaID` int(3) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vAreaName` varchar(20) DEFAULT NULL COMMENT 'Nama Area',
  `vNickName` varchar(10) DEFAULT NULL COMMENT 'Singkatan nama area',
  `tCreated` datetime NOT NULL COMMENT 'dibuat pada tgl',
  `cAreaCode` char(2) NOT NULL COMMENT 'Kode Area di Foxpro',
  `vAlamat` varchar(255) DEFAULT NULL COMMENT 'nama alamat',
  `cRt` char(4) DEFAULT NULL COMMENT 'RT',
  `cRw` char(4) DEFAULT NULL COMMENT 'RW',
  `vKelurahan` varchar(50) DEFAULT NULL COMMENT 'nama kelurahan',
  `vKecamatan` varchar(50) DEFAULT NULL COMMENT 'nama kecamatan',
  `vKota` varchar(20) DEFAULT NULL COMMENT 'nama kota',
  `iKdPropinsi` int(11) DEFAULT NULL,
  `cKodePos` char(7) DEFAULT NULL,
  `cTelp` char(30) DEFAULT NULL,
  `cFax` char(30) DEFAULT NULL,
  `cNpwp` char(30) DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT '',
  `tUpdated` datetime NOT NULL,
  `cUpdatedBy` char(7) DEFAULT '',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iAreaID`),
  UNIQUE KEY `vAreaName` (`vAreaName`),
  KEY `cAreaCode` (`cAreaCode`,`lDeleted`),
  KEY `lDeleted` (`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master Area';

-- Dumping data for table hrd.area: ~1 rows (approximately)
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
REPLACE INTO `area` (`iAreaID`, `vAreaName`, `vNickName`, `tCreated`, `cAreaCode`, `vAlamat`, `cRt`, `cRw`, `vKelurahan`, `vKecamatan`, `vKota`, `iKdPropinsi`, `cKodePos`, `cTelp`, `cFax`, `cNpwp`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(45, 'HEAD OFFICE', 'HO', '0000-00-00 00:00:00', 'HO', 'JL. POS PANGUMBEN RAYA NO.8                       \n                                                  ', '', '', 'SUKABUMI SELATN', 'KEBON JERUK    ', 'JAKARTA BARAT       ', 8, '11560', '(021 ) 5355888', '53668600', '01.002.680.5.052.000', NULL, '2010-07-29 00:00:00', '', 0);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;

-- Dumping structure for table hrd.bagian
DROP TABLE IF EXISTS `bagian`;
CREATE TABLE IF NOT EXISTS `bagian` (
  `ibagid` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `iDeptId` int(2) unsigned NOT NULL COMMENT 'ID table Departemen (TIDAK DIGUNAKAN - diambil dari division.id)',
  `iDivId` int(2) unsigned NOT NULL COMMENT 'ID tbl ''division'' (TIDAK DIGUNAKAN - diambil dari departement.id)',
  `iDivisionId` int(2) unsigned NOT NULL COMMENT 'Kode Divisi (msdivision.id)',
  `iDepartementId` int(2) unsigned NOT NULL COMMENT 'Kode Departemen (msdepartment.id)',
  `vDescription` varchar(40) NOT NULL COMMENT 'keterangan',
  `tCreated` datetime DEFAULT NULL COMMENT 'dibuat tgl',
  `cCreatedBy` char(7) DEFAULT '' COMMENT 'dibuat oleh',
  `tUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'diupdate tgl',
  `cUpdatedBy` char(7) DEFAULT '' COMMENT 'diupdate oleh',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  PRIMARY KEY (`ibagid`),
  KEY `FK_BAG_DEPT` (`iDeptId`),
  KEY `iDivId` (`iDivId`),
  KEY `iDivisionId` (`iDivisionId`),
  KEY `iDepartemenId` (`iDepartementId`)
) ENGINE=InnoDB AUTO_INCREMENT=2171 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master Bagian';

-- Dumping data for table hrd.bagian: ~1 rows (approximately)
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;
REPLACE INTO `bagian` (`ibagid`, `iDeptId`, `iDivId`, `iDivisionId`, `iDepartementId`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(2170, 0, 0, 6, 17, 'SYSTEM DEVELOPMENT', '2016-12-20 14:22:18', 'N10893', '2016-12-20 14:22:18', 'N10893', 0);
/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;

-- Dumping structure for table hrd.company
DROP TABLE IF EXISTS `company`;
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

-- Dumping data for table hrd.company: ~1 rows (approximately)
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
REPLACE INTO `company` (`iCompanyId`, `vCompName`, `vAcronim`, `cNipCode`, `iLastNip`, `cLKCode`, `vNPWP`, `vCompAddress`, `vCompKel`, `vCompKec`, `vRTRW`, `vCompKota`, `iProvidComp`, `cPostalCode`, `cPhoneCC`, `vPhoneCode`, `vPhoneNumber`, `vFaxCode`, `vFaxNumber`, `vAddressLoc`, `vKelLoc`, `vKecLoc`, `vRTRWloc`, `vKotaLoc`, `iProvidLoc`, `cPostalloc`, `vPhonecodeloc`, `vPhoneNoLoc`, `vFaxCodeLoc`, `vFaxNoLoc`, `vFile`, `vFoxPersoPATH`, `vAccNumber`, `vAccName`, `vBankName`, `lDeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedby`) VALUES
	(3, ' . Balai Besar Pengujian Mutu & Sertifikasi Obat Hewan', 'NPL', 'N', 17296, '06', '01.002.680.5-052.000', 'JL. POS PENGUMBEN RAYA NO. 8', 'SUKABUMI SELATAN', 'KEBON JERUK', '005/05', 'JAKARTA BARAT', 8, '11560', '62', '021', '5355888', '021', '53668600', 'JL. WANAHERANG NO. 35', 'TLAJUNG UDIK', 'GUNUNG PUTRI', '', 'BOGOR', 8, '', '021', '8670350', '021', '8672449', 'files/personalia/image/3/NPL_LOGO.gif', 'G:\\DATA\\PERSO\\NOVELL\\', NULL, NULL, NULL, 0, '2008-03-05 10:26:07', 'N04749', '2018-12-13 13:48:46', 'N10568');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;

-- Dumping structure for table hrd.employee
DROP TABLE IF EXISTS `employee`;
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='master informasi pegawai';

-- Dumping data for table hrd.employee: ~23 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
REPLACE INTO `employee` (`ID`, `cNip`, `vName`, `vEmail`, `vAddress`, `vTelepon`, `vEmail_company`, `vName_company`, `vAddress_company`, `vTelepon_company`, `vFax_company`, `iVerifikasi`, `cVerified`, `dVerified`, `vRemark_verification`, `iCompanyID`, `iDivisionID`, `iDepartementID`, `iPostID`, `vPassword`, `lDeleted`, `cCreated`, `dCreated`, `dResign`, `cUpdated`, `dUpdated`) VALUES
	(1, 'N14615', 'MANSUR', 'mansurfrankeinstein@gmail.com', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 6, 17, 358, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:30'),
	(3, 'N14616', 'Hiro Ahza Alifiandra', 'hiroalifiandra@gmail.com', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 6, 17, 358, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-03-31 16:56:31'),
	(4, 'C00001', 'Customer 1', 'info@echishop.com', 'ini alamat', '081311562431', 'info@echishop.com', 'Echishop', 'alamat', '081311562431', '0213341', 1, NULL, NULL, NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:08:26', '0000-00-00', 'N14615', '2019-02-13 08:05:27'),
	(6, 'C00006', 'Rama', 'Rama@gmail.com', 'Kuningan', '082117890456', 'Rama@gmail.com', 'PT. WOKE', 'Jakarta', '021456789', '021458976', 1, 'N14615', '2019-02-13 08:17:26', 'oke', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:13:15', '0000-00-00', NULL, '2019-03-31 15:19:26'),
	(11, 'C00011', 'Cakra', 'Cakrahaha@gmail.com', 'Cirebon', '087890456789', 'Cakrahaha@gmail.com', 'PT. HaHa', 'Jakarta', '021678987', '021789654', 1, 'N14615', '2019-02-13 08:17:46', 'oke lagi', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-27 01:16:25', '0000-00-00', NULL, '2019-03-31 15:19:25'),
	(12, 'A00001', 'User Admin Yanji', 'admin@bbpmsoh.go.id', 'Alamat', 'telepon', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 8, 19, 360, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-01-26 13:31:26', '0000-00-00', 'N14615', '2019-04-05 00:35:32'),
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
	(31, 'A00008', 'Admin Keuangan', 'adminkeu@bbpmsoh.com', 'Alamat', '0000', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 14, 25, 366, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-04-01 01:36:18', '0000-00-00', NULL, '2019-04-01 01:36:28'),
	(32, 'A00032', 'Admin QA', 'adminqa@bbpmsoh.com', 'Alamat', '0000', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 15, 26, 367, '81dc9bdb52d04dc20036dbd8313ed055', 0, 'N14615', '2019-04-01 01:36:18', '0000-00-00', NULL, '2019-04-02 07:02:37'),
	(44, 'C00044', 'rerere', 'rererere@gmail.com', 'rere', 'rere', 'rererere@gmail.com', 'rere', 'rere', 'rere', 'rere', 0, NULL, NULL, NULL, 3, 7, 18, 359, '2be9bd7a3434f7038ca27d1918de58bd', 0, NULL, '2019-04-07 03:07:14', '0000-00-00', NULL, '2019-04-07 03:07:14'),
	(45, 'C00045', 'Hima', 'hima@gmail.com', 'sasa', 'sasa', 'hima@gmail.com', 'sasa', 'sasa', 'sasa', 'sasa', 0, NULL, NULL, NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-04-07 03:10:57', '0000-00-00', NULL, '2019-04-07 03:10:57'),
	(46, 'C00046', 'Jaki', 'jaki@gmail.com', 'Alamat Jaki', '081324012345', 'jaki@gmail.com', 'PT Jaki Indonesia', 'Alamat perusahaan jaki', '081324012345', '081324012345', 0, NULL, NULL, NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-04-07 22:43:38', '0000-00-00', NULL, '2019-04-07 22:43:39'),
	(47, 'C00047', 'Deru Siga', 'deru.siga@gmail.com', 'Alamat deru', '021114562', 'lambo@gmail.com', 'Lambo Indo', 'Alamat perusahaan Lambo', '021113456', '021113456', 1, 'A00001', '2019-04-07 23:12:13', 'oke', 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-04-07 22:52:06', '0000-00-00', NULL, '2019-04-07 23:12:13'),
	(48, 'C00048', 'User Customer Test', 'testuser@gmail.com', 'Alamat USernya', '021345678', 'sukasuka@gmail.com', 'PT Suka suka Indonesia', 'Alamat perusahaan suka suka', '021123455', '021123455', 0, NULL, NULL, NULL, 3, 7, 18, 359, '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, '2019-04-07 22:59:55', '0000-00-00', NULL, '2019-04-07 22:59:55');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

-- Dumping structure for table hrd.grparea
DROP TABLE IF EXISTS `grparea`;
CREATE TABLE IF NOT EXISTS `grparea` (
  `iGrpAreaID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id tabel GrpArea',
  `iAreaID` varchar(50) DEFAULT NULL COMMENT 'menyimpan iAreaID dari tabel area',
  `vDescription` varchar(50) DEFAULT NULL COMMENT 'nama group area',
  `tKeterangan` text,
  `cCreateBy` char(50) DEFAULT NULL COMMENT 'nama yang membuat data area',
  `dCreate` datetime DEFAULT NULL COMMENT 'tanggal membuat data area',
  `cUpdateBy` char(50) DEFAULT NULL COMMENT 'pic yang melakukan update data area',
  `dUpdate` datetime DEFAULT NULL COMMENT 'tanggal membuat data area',
  `lDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`iGrpAreaID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='menyimpan grouping Area dari posisi yang dibutuhkan';

-- Dumping data for table hrd.grparea: ~1 rows (approximately)
/*!40000 ALTER TABLE `grparea` DISABLE KEYS */;
REPLACE INTO `grparea` (`iGrpAreaID`, `iAreaID`, `vDescription`, `tKeterangan`, `cCreateBy`, `dCreate`, `cUpdateBy`, `dUpdate`, `lDeleted`) VALUES
	(1, '7,26,40,45,66,70', 'JAKARTA', 'HEAD OFFICE - KEBON JERUK - JAKARTA BARAT, Jakarta 1, 2, 3, 4 dan ULUJAMI - - JAKARTA SELATAN', NULL, NULL, 'N12831', '2014-10-01 16:11:06', 0);
/*!40000 ALTER TABLE `grparea` ENABLE KEYS */;

-- Dumping structure for table hrd.grpposition
DROP TABLE IF EXISTS `grpposition`;
CREATE TABLE IF NOT EXISTS `grpposition` (
  `iGrpPostID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id tabel GrpArea',
  `vDescription` varchar(50) DEFAULT NULL COMMENT 'nama group area',
  `tKeterangan` text,
  `cCreateBy` char(50) DEFAULT NULL COMMENT 'nama pic  yang membuat data group posisi',
  `dCreate` datetime DEFAULT NULL COMMENT 'tgl membuat data group posisi',
  `cUpdateBy` char(50) DEFAULT NULL COMMENT 'pic yang mellakukan update data area',
  `dUpdate` datetime DEFAULT NULL COMMENT 'tanggal update',
  `lDeleted` int(11) DEFAULT '0' COMMENT 'penanda hapus data 1=hapus',
  PRIMARY KEY (`iGrpPostID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='menyimpan grouping Area dari posisi yang dibutuhkan';

-- Dumping data for table hrd.grpposition: ~3 rows (approximately)
/*!40000 ALTER TABLE `grpposition` DISABLE KEYS */;
REPLACE INTO `grpposition` (`iGrpPostID`, `vDescription`, `tKeterangan`, `cCreateBy`, `dCreate`, `cUpdateBy`, `dUpdate`, `lDeleted`) VALUES
	(1, 'Supporting', 'Supporting', NULL, NULL, 'n12812', '2014-04-07 13:29:17', 0),
	(2, 'Marketing', 'Marketing', 'n12812', '2014-04-07 00:00:00', 'n12812', '2014-08-07 17:40:58', 0),
	(3, 'Manufacture', 'Manufacture', 'n12812', '0000-00-00 00:00:00', 'n12812', '2014-04-07 13:29:05', 0);
/*!40000 ALTER TABLE `grpposition` ENABLE KEYS */;

-- Dumping structure for table hrd.gshift
DROP TABLE IF EXISTS `gshift`;
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

-- Dumping data for table hrd.gshift: 1 rows
/*!40000 ALTER TABLE `gshift` DISABLE KEYS */;
REPLACE INTO `gshift` (`iGShiftID`, `iShiftID`, `cKodeShift`, `vGShiftName`, `vGShiftNickName`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`, `lGSecurity`) VALUES
	(1, 1, '14', 'GENERAL SHIFT HO', 'OF1', '2008-06-24 14:23:46', 'N04749', '2017-03-16 09:19:43', 'N10893', 1, 0);
/*!40000 ALTER TABLE `gshift` ENABLE KEYS */;

-- Dumping structure for table hrd.lvlemp
DROP TABLE IF EXISTS `lvlemp`;
CREATE TABLE IF NOT EXISTS `lvlemp` (
  `iLvlEmp` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `vDescription` varchar(3) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  `lDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`iLvlEmp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='Employee staff level';

-- Dumping data for table hrd.lvlemp: ~7 rows (approximately)
/*!40000 ALTER TABLE `lvlemp` DISABLE KEYS */;
REPLACE INTO `lvlemp` (`iLvlEmp`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(1, 'L1', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(2, 'L2', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(3, 'L3', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(4, 'L4', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(5, 'L5', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(6, 'L6', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0'),
	(7, 'L7', '2008-06-25 10:46:07', 'N04669', '2008-06-25 10:46:07', '', b'0');
/*!40000 ALTER TABLE `lvlemp` ENABLE KEYS */;

-- Dumping structure for table hrd.lvlmanagerial
DROP TABLE IF EXISTS `lvlmanagerial`;
CREATE TABLE IF NOT EXISTS `lvlmanagerial` (
  `iLvlID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this ID',
  `vLvlName` varchar(30) NOT NULL COMMENT 'Nama untuk level managerial',
  `tCreatedAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'First Created At',
  `cCreatedBy` char(7) NOT NULL DEFAULT '-' COMMENT 'First Created By',
  `tUpdateAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Last Updated At',
  `cUpdateBy` char(7) NOT NULL DEFAULT '-' COMMENT 'Last Updated By',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not , 1=delete',
  PRIMARY KEY (`iLvlID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='untuk menyimpan data master level managerial';

-- Dumping data for table hrd.lvlmanagerial: ~5 rows (approximately)
/*!40000 ALTER TABLE `lvlmanagerial` DISABLE KEYS */;
REPLACE INTO `lvlmanagerial` (`iLvlID`, `vLvlName`, `tCreatedAt`, `cCreatedBy`, `tUpdateAt`, `cUpdateBy`, `lDeleted`) VALUES
	(1, 'PELAKSANA', '2013-01-03 13:06:32', 'N06081', '2013-01-03 13:06:32', '', 0),
	(2, 'STAFF', '2013-01-03 13:06:45', 'N06081', '2013-01-03 13:06:45', '', 0),
	(3, 'SUPERVISOR', '2013-01-03 13:06:53', 'N06081', '2013-01-03 13:06:53', '', 0),
	(4, 'MANAGERIAL', '2013-01-03 13:06:59', 'N06081', '2013-01-03 13:06:59', '', 0),
	(5, 'EXECUTIVE', '2013-01-03 13:11:59', 'N06081', '2013-01-03 13:11:59', '', 0);
/*!40000 ALTER TABLE `lvlmanagerial` ENABLE KEYS */;

-- Dumping structure for table hrd.msdepartement
DROP TABLE IF EXISTS `msdepartement`;
CREATE TABLE IF NOT EXISTS `msdepartement` (
  `iDeptID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID table departemen',
  `iDivID` int(2) unsigned NOT NULL COMMENT 'this ID',
  `vDescription` varchar(100) DEFAULT NULL COMMENT 'Keterangan',
  `tCreated` datetime DEFAULT NULL COMMENT 'created at',
  `cCreatedBy` char(8) DEFAULT NULL COMMENT 'created by',
  `tUpdated` datetime DEFAULT NULL COMMENT 'updated at',
  `cUpdatedBy` char(8) DEFAULT NULL COMMENT 'updated by',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not/1=delete',
  PRIMARY KEY (`iDeptID`),
  KEY `FK_div_dept` (`iDivID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master data divisi';

-- Dumping data for table hrd.msdepartement: ~10 rows (approximately)
/*!40000 ALTER TABLE `msdepartement` DISABLE KEYS */;
REPLACE INTO `msdepartement` (`iDeptID`, `iDivID`, `vDescription`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(17, 6, 'Software Development', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(18, 7, 'Customer', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(19, 7, 'Administration Mutu', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(20, 9, 'VIROLOGI', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(21, 9, 'FARMASTETIK & PREMIKS', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(22, 9, 'BIOLOGIK', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(23, 12, 'Administration SPHU', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(24, 13, 'Administrasi TU', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(25, 14, 'Administrasi Keuangan', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0),
	(26, 15, 'Administrasi QA', '2014-01-13 10:43:04', 'System', '2015-01-27 12:59:42', 'System', 0);
/*!40000 ALTER TABLE `msdepartement` ENABLE KEYS */;

-- Dumping structure for table hrd.msdivision
DROP TABLE IF EXISTS `msdivision`;
CREATE TABLE IF NOT EXISTS `msdivision` (
  `iDivID` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'this department ID',
  `vDescription` varchar(100) DEFAULT NULL COMMENT 'nama department',
  `vAbbreviation` varchar(30) DEFAULT NULL COMMENT 'singkatan untuk department tsb',
  `tCreated` datetime DEFAULT NULL COMMENT 'dibuat tgl',
  `cCreatedBy` char(7) DEFAULT NULL COMMENT 'dibuat oleh  - relasi ke tabel employee',
  `tUpdated` datetime DEFAULT NULL COMMENT 'update terakhir tgl',
  `cUpdatedBy` char(7) DEFAULT NULL COMMENT 'update terakhir oleh  - relasi ke tabel employee',
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'status delete',
  PRIMARY KEY (`iDivID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='master daftar department ';

-- Dumping data for table hrd.msdivision: ~8 rows (approximately)
/*!40000 ALTER TABLE `msdivision` DISABLE KEYS */;
REPLACE INTO `msdivision` (`iDivID`, `vDescription`, `vAbbreviation`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`, `lDeleted`) VALUES
	(6, 'Information Technology', 'IT', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:41', 'N14615', 0),
	(7, 'Customer', 'CST', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(8, 'Bidang Mutu', 'MT', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(9, 'Bidang Pelayanan Pengujian', 'PP', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(12, 'Bidang Pelayanan Sertifikasi dan Pengamanan Hasil Uji', 'SPHU', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(13, 'Tata Usaha', 'TU', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(14, 'Keuangan', 'FA', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0),
	(15, 'Quality Assurance', 'QA', '2019-01-26 13:49:30', 'N14615', '2019-01-26 13:49:43', 'N14615', 0);
/*!40000 ALTER TABLE `msdivision` ENABLE KEYS */;

-- Dumping structure for table hrd.picarea
DROP TABLE IF EXISTS `picarea`;
CREATE TABLE IF NOT EXISTS `picarea` (
  `iAreaId` int(3) NOT NULL,
  `cPAId` char(2) NOT NULL,
  `dEffective` date NOT NULL,
  `cNIP` char(7) DEFAULT '',
  `tupdated` datetime DEFAULT NULL,
  PRIMARY KEY (`iAreaId`,`cPAId`,`dEffective`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='PIC in each area';

-- Dumping data for table hrd.picarea: ~0 rows (approximately)
/*!40000 ALTER TABLE `picarea` DISABLE KEYS */;
/*!40000 ALTER TABLE `picarea` ENABLE KEYS */;

-- Dumping structure for table hrd.position
DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `iPostId` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Position ID',
  `vDescription` varchar(100) DEFAULT '' COMMENT 'Position Name (title)',
  `lDeleted` tinyint(1) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(7) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` char(7) DEFAULT NULL,
  PRIMARY KEY (`iPostId`),
  KEY `iPostId` (`iPostId`)
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='Master for position';

-- Dumping data for table hrd.position: ~10 rows (approximately)
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
REPLACE INTO `position` (`iPostId`, `vDescription`, `lDeleted`, `tCreated`, `cCreatedBy`, `tUpdated`, `cUpdatedBy`) VALUES
	(358, 'MIS PROGRAMMER SUPERVISOR', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(359, 'CUSTOMER', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(360, 'STAFF MUTU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(361, 'MANAGER MUTU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(362, 'MANAGER SPHU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(363, 'MANAGER UJI', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(364, 'STAFF SPHU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(365, 'STAFF TU', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(366, 'STAFF KEUANGAN', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615'),
	(367, 'STAFF QA', 0, '2019-01-27 01:17:08', 'N14615', '2019-01-27 01:17:08', 'N14615');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;

-- Dumping structure for table hrd.worklocation
DROP TABLE IF EXISTS `worklocation`;
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

-- Dumping data for table hrd.worklocation: ~2 rows (approximately)
/*!40000 ALTER TABLE `worklocation` DISABLE KEYS */;
REPLACE INTO `worklocation` (`I_LOCATION_ID`, `V_LOCATION_NAME`, `v_nickname`, `iCityID`, `iAreaId`, `iTypeId`, `cZona`, `iUMK`, `vAddress`, `lDeleted`, `L_DELETED`, `T_CREATED`, `C_CREATED_BY`, `T_UPDATED`, `C_UPDATED_BY`) VALUES
	(1, 'NPL GUNUNG PUTRI (PLANT)', 'GP', 135, 49, 1, '0', 0, NULL, 0, 0, '2009-08-28 11:10:58', 'E00005', '2015-12-11 08:10:49', 'E00005'),
	(2, 'NPL HEAD OFFICE', 'HO', 127, 45, 1, '0', 0, NULL, 0, 0, '2009-08-28 11:10:58', 'E00005', '2015-12-11 08:10:49', 'E00005');
/*!40000 ALTER TABLE `worklocation` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
