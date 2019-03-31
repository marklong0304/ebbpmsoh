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

-- membuang struktur untuk table bbpmsoh.mt01
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

-- Membuang data untuk tabel bbpmsoh.mt01: ~5 rows (lebih kurang)
DELETE FROM `mt01`;
/*!40000 ALTER TABLE `mt01` DISABLE KEYS */;
INSERT INTO `mt01` (`iMt01`, `vNo_transaksi`, `vNomor`, `vLampiran`, `vPerihal`, `dTanggal`, `iCustomer`, `iType_pemohon`, `vNama_produsen`, `vAlamat_produsen`, `iM_tujuan_pengujian`, `vTujuan_pengujian_ket`, `vNama_sample`, `iM_jenis_sediaan`, `vJenis_sediaan_ket`, `iSudah_beredar`, `vZat_aktif`, `vBatch_lot`, `dTgl_produksi`, `dTgl_kadaluarsa`, `vNo_registrasi`, `vKemasan`, `iJumlah_diserahkan`, `vSuhu_penyimpanan`, `vPermohonan_lampiran`, `dTgl_ambil_sample`, `dTgl_serah_sample`, `vPimpinan_perusahaan`, `lDeleted`, `iSubmit`, `iApprove`, `dApprove`, `cApprove`, `vRemark`, `iStatus_sertifikat`, `iSubmit_sertifikat`, `iSphu_app`, `dSphu_app`, `cSphu_app`, `vSphu_app`, `iTu_app`, `dTu_app`, `cTu_app`, `vTu_app`, `iFa_app`, `dFa_app`, `cFa_app`, `vFa_app`, `cCreated`, `dCreated`, `cUpdated`, `dUpdated`) VALUES
	(1, 'R00001', 'aa', 'aa', 'aa', '2019-02-03', 'C00011', 1, 'aa', 'aa', 1, 'a', 'aa', 1, NULL, 1, 'aa', 'aa', '2019-02-03', '2019-02-03', 'aaa', 'aaa', 12, '32', 'ss', '2019-02-03', '2019-02-03', 'Hiro Ahza', 0, 1, 2, '2019-02-23 14:31:53', 'N14615', 'reject', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'C00001', '2019-02-03 22:01:52', 'N14615', '2019-03-31 15:55:20'),
	(2, 'R00002', 'Vitamin', 'Lamp Vit', 'Penggemuk Badan', '2019-02-03', 'C00011', 1, 'PT Langsing', 'Di Kontrakan', 2, 'Tujuannya bikin gemuk', 'Susu Ultra', 1, 'Susu', 1, 'Protein', 'BTCH02x', '2019-02-03', '2019-02-03', 'NOREG0123SA', 'Bottle', 10, '10', 'Bagus', '2019-02-03', '2019-02-03', 'Kora', 0, 1, 2, '2019-02-23 14:02:01', 'N14615', 'approve', 2, 1, 2, '2019-04-01 01:46:04', 'A00005', 'ok', 2, '2019-04-01 02:02:27', 'A00007', 'ok', 2, '2019-04-01 02:04:09', 'A00008', 'sudah dikirim ', 'C00001', '2019-02-03 22:01:52', 'A00001', '2019-04-01 04:01:22'),
	(3, 'R00003', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-02-12 22:32:30', NULL, '2019-03-31 15:45:52'),
	(4, 'R00004', 'NOSAMPLE', 'LAMP', 'Uji Sample', '2019-02-12', 'C00011', 1, 'SERBA ADA', 'DESA SEBELAH', 1, '', 'SAMPLE BUAH', 1, NULL, 1, 'TEST', 'BATCH', '2019-02-27', '2019-02-23', 'No Req', 'Tablet', 10, '32', 'ST', '2019-02-28', '2019-02-28', 'OKE', 0, 1, 0, NULL, NULL, NULL, 2, 1, 2, '2019-04-01 01:46:04', 'A00005', 'ok', 2, '2019-04-01 02:02:27', 'A00007', 'ok', 2, '2019-04-01 02:04:09', 'A00008', 'sudah dikirim ', 'N14615', '2019-02-12 22:33:54', 'A00001', '2019-04-01 02:04:09'),
	(5, 'R00005', 'No X201231', 'Lampiran B', 'Sample Bahan', '2019-03-16', 'C00011', 1, 'SUP2', 'Jakarta Barat', 5, 'Keterangan', 'Sample Bahan Baku', 4, NULL, 0, 'Zat Aktif', 'BATCH 1', '2019-03-16', '2019-03-16', 'No Reg 2019/dsa', 'Kemasan 01', 100, '30', 'No Subject', '2019-03-21', '2019-03-29', 'Joko Santosa', 0, 1, 2, '2019-03-16 13:34:18', 'N14615', '', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'N14615', '2019-03-16 13:34:03', 'N14615', '2019-03-31 15:45:53');
/*!40000 ALTER TABLE `mt01` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
