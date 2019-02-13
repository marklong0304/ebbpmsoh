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
  `cCreated` char(50) DEFAULT NULL,
  `dCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cUpdated` char(50) DEFAULT NULL,
  `dUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`iMt01`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpmsoh.mt01: ~4 rows (approximately)
/*!40000 ALTER TABLE `mt01` DISABLE KEYS */;
REPLACE INTO `mt01` (`iMt01`, `vNo_transaksi`, `vNomor`, `vLampiran`, `vPerihal`, `dTanggal`, `iCustomer`, `iType_pemohon`, `vNama_produsen`, `vAlamat_produsen`, `iM_tujuan_pengujian`, `vTujuan_pengujian_ket`, `vNama_sample`, `iM_jenis_sediaan`, `vJenis_sediaan_ket`, `iSudah_beredar`, `vZat_aktif`, `vBatch_lot`, `dTgl_produksi`, `dTgl_kadaluarsa`, `vNo_registrasi`, `vKemasan`, `iJumlah_diserahkan`, `vSuhu_penyimpanan`, `vPermohonan_lampiran`, `dTgl_ambil_sample`, `dTgl_serah_sample`, `vPimpinan_perusahaan`, `lDeleted`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`) VALUES
	(1, 'R00001', 'aa', 'aa', 'aa', '2019-02-03', '4', NULL, 'aa', 'aa', 1, 'a', 'aa', 1, NULL, 1, 'aa', 'aa', '2019-02-03', '2019-02-03', 'aaa', 'aaa', 12, '32', 'ss', '2019-02-03', '2019-02-03', 'Hiro Ahza', 0, 1, 0, NULL, NULL, NULL, 'C00001', '2019-02-03 22:01:52', NULL, '2019-02-03 22:01:52'),
	(2, 'R00002', 'Vitamin', 'Lamp Vit', 'Penggemuk Badan', '2019-02-03', '2', NULL, 'PT Langsing', 'Di Kontrakan', 2, 'Tujuannya bikin gemuk', 'Susu Ultra', 1, 'Susu', 1, 'Protein', 'BTCH02x', '2019-02-03', '2019-02-03', 'NOREG0123SA', 'Bottle', 10, '10', 'Bagus', '2019-02-03', '2019-02-03', 'Kora', 0, 1, 0, '2019-02-10 15:50:54', NULL, NULL, 'C00001', '2019-02-03 22:01:52', NULL, '2019-02-03 22:01:52'),
	(3, '', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', '3', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 1, 1, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:32:30', NULL, '2019-02-12 22:34:05'),
	(4, 'R00004', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', '3', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 0, 1, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:33:54', NULL, '2019-02-12 22:33:54');
/*!40000 ALTER TABLE `mt01` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt02
CREATE TABLE IF NOT EXISTS `mt02` (
  `iMt02` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `dTgl_Kontrak` date DEFAULT NULL,
  `p1_nama` varchar(150) DEFAULT NULL,
  `p1_jabatan` varchar(100) DEFAULT NULL,
  `p1_perusahaan` varchar(120) DEFAULT NULL,
  `p1_alamat` varchar(500) DEFAULT NULL,
  `p1_an` varchar(500) DEFAULT NULL,
  `p2_nama` varchar(150) DEFAULT NULL,
  `p2_jabatan` varchar(100) DEFAULT NULL,
  `vNama_sample` varchar(150) DEFAULT NULL,
  `vAcuan_metode_uji` varchar(100) DEFAULT NULL,
  `vKeterangan` varchar(500) DEFAULT NULL,
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
  PRIMARY KEY (`iMt02`),
  UNIQUE KEY `iMt01_lDeleted` (`iMt01`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt02: ~1 rows (approximately)
/*!40000 ALTER TABLE `mt02` DISABLE KEYS */;
REPLACE INTO `mt02` (`iMt02`, `iMt01`, `dTgl_Kontrak`, `p1_nama`, `p1_jabatan`, `p1_perusahaan`, `p1_alamat`, `p1_an`, `p2_nama`, `p2_jabatan`, `vNama_sample`, `vAcuan_metode_uji`, `vKeterangan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, '2019-02-03', 'Pihak 1', 'Manager', 'Okeh Aja', 'Okeh Lagi', 'Pihak 1', 'Manager Mutu', 'Manager Mutu', 'Okeh', 'Kadar', 'uji kadar', 1, 0, '0000-00-00 00:00:00', '', '', 'A00001', '2019-02-03 22:16:24', '', '0000-00-00 00:00:00', 0);
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
/*!40000 ALTER TABLE `mt02_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt02_detail` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt03
CREATE TABLE IF NOT EXISTS `mt03` (
  `iMt03` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `iAda_batch` tinyint(4) DEFAULT NULL,
  `iTgl_expired` tinyint(4) DEFAULT NULL,
  `iEtiket_brosur` tinyint(4) DEFAULT NULL,
  `iM_jenis_brosur` int(11) DEFAULT NULL COMMENT 'relasi ke master jenis brosur',
  `iReq_permohonan` tinyint(4) DEFAULT NULL,
  `iPengantar_direktorat` tinyint(4) DEFAULT NULL,
  `iHasil_ppoh` tinyint(4) DEFAULT NULL,
  `iBahan_standard` tinyint(4) DEFAULT NULL COMMENT '1:perlu,0:tidak perlu',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt03: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt03` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt03` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt05: ~3 rows (approximately)
/*!40000 ALTER TABLE `mt05` DISABLE KEYS */;
REPLACE INTO `mt05` (`iMt05`, `vKepada_yth`, `vAlamat`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'as', 'sa', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:04:01', NULL, '2019-02-12 03:04:01', 0),
	(2, 'dsad', 'asdasd', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:04:23', NULL, '2019-02-12 03:04:23', 0),
	(3, 'dsadsad', 'ddasxzxsa', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:13:57', NULL, '2019-02-12 03:13:57', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='dibuat detail untuk jaga2 karena bisa saja tanda terima sample dari beberapa request.\r\njika tidak jadi dibuat banyak, maka validasi di button add row saja\r\n';

-- Dumping data for table bbpmsoh.mt05_detail: ~3 rows (approximately)
/*!40000 ALTER TABLE `mt05_detail` DISABLE KEYS */;
REPLACE INTO `mt05_detail` (`iMt05_detail`, `iMt05`, `iMt01`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 0, 'N14615', '2019-02-12 03:04:01', NULL, '2019-02-12 03:04:01', 0),
	(2, 2, 2, 'N14615', '2019-02-12 03:04:23', NULL, '2019-02-12 03:04:23', 0),
	(3, 3, 2, 'N14615', '2019-02-12 03:13:57', NULL, '2019-02-12 03:13:57', 0);
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

-- Dumping data for table bbpmsoh.mt06: ~1 rows (approximately)
/*!40000 ALTER TABLE `mt06` DISABLE KEYS */;
REPLACE INTO `mt06` (`iMt06`, `iMt01`, `vKepada_yth`, `vAlamat`, `iDist_virologi`, `iDist_bakteri`, `iDist_farmastetik`, `iDist_patologi`, `iSubmit`, `iApprove_sphu`, `dApprove_sphu`, `cApprove_sphu`, `vRemark_sphu`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 'dasd', 'dasdsa', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:15:00', 'N14615', '2019-02-12 03:28:40', 0);
/*!40000 ALTER TABLE `mt06` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt07
CREATE TABLE IF NOT EXISTS `mt07` (
  `iMt07` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt07: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt07` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt07` ENABLE KEYS */;

-- Dumping structure for table bbpmsoh.mt08a
CREATE TABLE IF NOT EXISTS `mt08a` (
  `iMt8a` int(11) NOT NULL AUTO_INCREMENT,
  `iMt01` int(11) DEFAULT NULL,
  `vKepada_yth` varchar(50) DEFAULT NULL,
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
  PRIMARY KEY (`iMt8a`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bbpmsoh.mt08a: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt08a` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt08a` ENABLE KEYS */;

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
/*!40000 ALTER TABLE `m_jenis_brosur` DISABLE KEYS */;
REPLACE INTO `m_jenis_brosur` (`iM_jenis_brosur`, `vJenis_brosur`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
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
/*!40000 ALTER TABLE `sysparam` DISABLE KEYS */;
REPLACE INTO `sysparam` (`id`, `vVariable`, `vContent`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'MT01_PENANGGUNG_JAWAB', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:32', 0),
	(2, 'MT02_MANAGER_PUNCAK', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:38', 0),
	(3, 'MT03_TTD', 'A00006', 'N14615', '2019-02-03 14:48:32', NULL, '2019-02-03 20:52:07', 0);
/*!40000 ALTER TABLE `sysparam` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
