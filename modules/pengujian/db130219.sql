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

-- Dumping data for table bbpmsoh.mt01: ~2 rows (approximately)
/*!40000 ALTER TABLE `mt01` DISABLE KEYS */;
REPLACE INTO `mt01` (`iMt01`, `vNo_transaksi`, `vNomor`, `vLampiran`, `vPerihal`, `dTanggal`, `iCustomer`, `iType_pemohon`, `vNama_produsen`, `vAlamat_produsen`, `iM_tujuan_pengujian`, `vTujuan_pengujian_ket`, `vNama_sample`, `iM_jenis_sediaan`, `vJenis_sediaan_ket`, `iSudah_beredar`, `vZat_aktif`, `vBatch_lot`, `dTgl_produksi`, `dTgl_kadaluarsa`, `vNo_registrasi`, `vKemasan`, `iJumlah_diserahkan`, `vSuhu_penyimpanan`, `vPermohonan_lampiran`, `dTgl_ambil_sample`, `dTgl_serah_sample`, `vPimpinan_perusahaan`, `lDeleted`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`) VALUES
	(1, 'R00001', 'aa', 'aa', 'aa', '2019-02-03', '4', NULL, 'aa', 'aa', 1, 'a', 'aa', 1, NULL, 1, 'aa', 'aa', '2019-02-03', '2019-02-03', 'aaa', 'aaa', 12, '32', 'ss', '2019-02-03', '2019-02-03', 'Hiro Ahza', 0, 1, 0, NULL, NULL, NULL, 'C00001', '2019-02-03 22:01:52', NULL, '2019-02-03 22:01:52'),
	(2, 'R00002', 'Vitamin', 'Lamp Vit', 'Penggemuk Badan', '2019-02-03', '2', NULL, 'PT Langsing', 'Di Kontrakan', 2, 'Tujuannya bikin gemuk', 'Susu Ultra', 1, 'Susu', 1, 'Protein', 'BTCH02x', '2019-02-03', '2019-02-03', 'NOREG0123SA', 'Bottle', 10, '10', 'Bagus', '2019-02-03', '2019-02-03', 'Kora', 0, 1, 0, '2019-02-10 15:50:54', NULL, NULL, 'C00001', '2019-02-03 22:01:52', NULL, '2019-02-03 22:01:52'),
	(3, '', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', '3', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 1, 1, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:32:30', NULL, '2019-02-12 22:34:05'),
	(4, 'R00004', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', '3', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 0, 1, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:33:54', NULL, '2019-02-12 22:33:54');
/*!40000 ALTER TABLE `mt01` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt02: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt02` DISABLE KEYS */;
REPLACE INTO `mt02` (`iMt02`, `iMt01`, `dTgl_Kontrak`, `p1_nama`, `p1_jabatan`, `p1_perusahaan`, `p1_alamat`, `p1_an`, `p2_nama`, `p2_jabatan`, `vNama_sample`, `vAcuan_metode_uji`, `vKeterangan`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, '2019-02-03', 'Pihak 1', 'Manager', 'Okeh Aja', 'Okeh Lagi', 'Pihak 1', 'Manager Mutu', 'Manager Mutu', 'Okeh', 'Kadar', 'uji kadar', 1, 0, '0000-00-00 00:00:00', '', '', 'A00001', '2019-02-03 22:16:24', '', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `mt02` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt02_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt02_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt02_detail` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt03: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt03` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt03` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt05: ~3 rows (approximately)
/*!40000 ALTER TABLE `mt05` DISABLE KEYS */;
REPLACE INTO `mt05` (`iMt05`, `vKepada_yth`, `vAlamat`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'as', 'sa', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:04:01', NULL, '2019-02-12 03:04:01', 0),
	(2, 'dsad', 'asdasd', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:04:23', NULL, '2019-02-12 03:04:23', 0),
	(3, 'dsadsad', 'ddasxzxsa', 0, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:13:57', NULL, '2019-02-12 03:13:57', 0);
/*!40000 ALTER TABLE `mt05` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt05_detail: ~3 rows (approximately)
/*!40000 ALTER TABLE `mt05_detail` DISABLE KEYS */;
REPLACE INTO `mt05_detail` (`iMt05_detail`, `iMt05`, `iMt01`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 0, 'N14615', '2019-02-12 03:04:01', NULL, '2019-02-12 03:04:01', 0),
	(2, 2, 2, 'N14615', '2019-02-12 03:04:23', NULL, '2019-02-12 03:04:23', 0),
	(3, 3, 2, 'N14615', '2019-02-12 03:13:57', NULL, '2019-02-12 03:13:57', 0);
/*!40000 ALTER TABLE `mt05_detail` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt06: ~1 rows (approximately)
/*!40000 ALTER TABLE `mt06` DISABLE KEYS */;
REPLACE INTO `mt06` (`iMt06`, `iMt01`, `vKepada_yth`, `vAlamat`, `iDist_virologi`, `iDist_bakteri`, `iDist_farmastetik`, `iDist_patologi`, `iSubmit`, `iApprove_sphu`, `dApprove_sphu`, `cApprove_sphu`, `vRemark_sphu`, `iApprove_uji`, `dApprove_uji`, `cApprove_uji`, `vRemark_uji`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 1, 'dasd', 'dasdsa', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 03:15:00', 'N14615', '2019-02-12 03:28:40', 0);
/*!40000 ALTER TABLE `mt06` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt07: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt07` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt07` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.mt08a: ~0 rows (approximately)
/*!40000 ALTER TABLE `mt08a` DISABLE KEYS */;
/*!40000 ALTER TABLE `mt08a` ENABLE KEYS */;

-- Dumping data for table bbpmsoh.m_jenis_brosur: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_jenis_brosur` DISABLE KEYS */;
REPLACE INTO `m_jenis_brosur` (`iM_jenis_brosur`, `vJenis_brosur`, `vKeterangan`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`, `lDeleted`) VALUES
	(1, 'Rancangan', 'Jenis Brosur masih rancangan', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(2, 'Asli', 'Brosur yang dikirim adalah asli', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:12', 0),
	(3, 'Kurang Lengkap', 'masih kurang lengkap', 'N14615', '2019-02-03 20:32:31', NULL, '2019-02-03 20:33:13', 0);
/*!40000 ALTER TABLE `m_jenis_brosur` ENABLE KEYS */;

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
