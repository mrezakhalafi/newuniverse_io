-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2021 at 06:29 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `ID` int(11) NOT NULL,
  `FORM_ID` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `TITLE` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `STATUS` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `TARGET` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `SQ_NO` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`ID`, `FORM_ID`, `TITLE`, `CREATED_DATE`, `CREATED_BY`, `STATUS`, `TARGET`, `SQ_NO`) VALUES
(9, '123440', 'Pengaduan', '2019-04-16 11:41:27', '10', '0', '1', 3),
(26, '1111115', 'Pendaftaran Baru', '2019-05-10 15:47:26', '01', '0', '1', 1),
(27, '1111116', 'Pendaftaran IndiHub', '2019-07-10 16:35:16', '02', '0', '1', 2),
(28, '1111117', 'Surat Pengantar RT/RW', '2019-05-10 15:47:26', '04', '1', '1', 4),
(29, '1111118', 'SK Pindah Penduduk', '2019-05-10 15:47:26', '05', '1', '1', 5),
(30, '1111119', 'Layanan Pengaduan', '2019-07-10 16:45:35', '03', '1', '1', 3),
(32, '14045', 'Test Form', '2021-07-15 08:52:10', '14045', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_item`
--

CREATE TABLE `form_item` (
  `ID` int(11) NOT NULL,
  `FORM_ID` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `LABEL` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `VALUE` text COLLATE latin1_general_ci DEFAULT NULL,
  `KEY` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `SQ_NO` int(11) NOT NULL DEFAULT 0,
  `TYPE` varchar(10) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `form_item`
--

INSERT INTO `form_item` (`ID`, `FORM_ID`, `LABEL`, `VALUE`, `KEY`, `SQ_NO`, `TYPE`) VALUES
(18, '123437', 'Order*', NULL, 'order', 2, '11'),
(19, '123437', 'Note', NULL, 'note', 3, '11'),
(20, '123437', 'Shop/Cafe Name*', NULL, 'shop', 1, '11'),
(21, '123437', 'Cash*', '0', 'cash', 4, '5'),
(38, '123440', 'Info Pengaduan', '', 'h_1', 1, '0'),
(39, '123440', 'ID Pengaduan*', 'CPL', 'cpl_id', 2, '17'),
(40, '123440', 'Tanggal Pengaduan*', NULL, 'time', 3, '2'),
(42, '123440_0', 'Status', NULL, 'status', 5, '18'),
(44, '123440_0', 'Info Pelapor', NULL, 'h_2', 7, '0'),
(45, '123440_0', 'Nama', NULL, 'contact', 8, '11'),
(48, '123440_0', 'No. Telepon', NULL, 'ref_info', 11, '11'),
(49, '123440', 'Info Lokasi', NULL, 'h_3', 12, '0'),
(50, '123440', 'Lokasi Kejadian', NULL, 'location', 13, '13'),
(51, '123440', 'Detil Pengaduan', NULL, 'h_4', 14, '0'),
(52, '123440', 'Keluhan/Masalah', NULL, 'detail', 15, '11'),
(53, '123440', 'Unggah Foto', NULL, 'photo', 16, '15'),
(54, '123440', 'Unggah Berkas', NULL, 'document', 17, '14'),
(55, '123440', 'Tanggapan', NULL, 'h_5', 18, '_0'),
(56, '123440', 'Sumber Masalah', NULL, 'cause', 19, '_11'),
(57, '123440', 'Solusi', NULL, 'response', 20, '_11'),
(58, '123440', 'Unggah Foto', NULL, 'rsp_photo', 21, '_15'),
(59, '123440', 'Unggah Berkas', NULL, 'rsp_doc', 22, '_14'),
(157, '123001', 'Tanggal*', 'not_backdate', 'date', 1, '1'),
(158, '123001', 'Waktu Mulai*', NULL, 'stime', 2, '3'),
(159, '123001', 'Waktu Berakhir*', NULL, 'etime', 3, '3'),
(160, '123001', 'Tempat*', 'Gedung Serbaguna Selatan,Lapangan Bola,Aula Kantor Kecamatan', 'meetingroom', 5, '4'),
(163, '123001', 'Tujuan*', NULL, 'purpose', 7, '11'),
(164, '123001', 'Fasilitas Tambahan', NULL, 'aditionalacti', 8, '11'),
(181, '1111112', 'Nomor KTP*', NULL, 'ktp', 1, '11'),
(182, '1111112', 'Scan/Foto KTP*', NULL, 'scan_ktp', 2, '15'),
(183, '1111112', 'Scan/Foto KK*', NULL, 'scan_kk', 3, '15'),
(184, '1111112', 'Akte Lahir/Ijazah*', NULL, 'scan_ijazah', 4, '15'),
(185, '1111112', 'Foto Terbaru*', NULL, 'photo', 5, '15'),
(186, '1111112', 'Keterangan*', NULL, 'note', 5, '11'),
(187, '1111113', 'Nama*', NULL, 'name', 1, '6'),
(188, '1111113', 'Nomor KTP*', NULL, 'ktp', 2, '5'),
(189, '1111113', 'Tempat Lahir*', NULL, 'place', 3, '6'),
(190, '1111113', 'Tanggal Lahir*', NULL, 'birdthdate', 4, '1'),
(191, '1111113', 'Pekerjaan*', NULL, 'job', 5, '6'),
(192, '1111113', 'Alamat*', NULL, 'address', 6, '11'),
(193, '1111113', 'Tujuan Pengajuan*', NULL, 'purpose', 7, '11'),
(194, '1111114', 'Nama*', NULL, 'name', 1, '6'),
(195, '1111114', 'Nomor KTP*', NULL, 'ktp', 2, '5'),
(196, '1111114', 'Pindai/Foto KK*', NULL, 'kk', 3, '15'),
(197, '1111114', 'Alamat*', NULL, 'address', 4, '11'),
(198, '1111114', 'Jenis Usaha*', NULL, 'company_type', 5, '6'),
(199, '1111114', 'Alamat Tempat Usaha*', NULL, 'company_address', 7, '11'),
(201, '1111114', 'Ukuran Tempat Usaha*', NULL, 'size', 6, '5'),
(202, '1111115', 'Info Lokasi', NULL, 'h1', 1, '0'),
(203, '1111115', 'Lokasi*', NULL, 'location', 2, '13'),
(204, '1111115', 'Info Paket', NULL, 'h2', 3, '0'),
(205, '1111115', 'Paket*', 'Triple Play,Dual Play,Promo', 'packet', 4, '4'),
(206, '1111115', 'Detail Paket*', 'Deluxe 10 Mbps - Rp 100.000/bln,Premium 20 Mbps - Rp 200.000/bln,Premium 30 Mbps - Rp 300.000/bln,Premium 40 Mbps - Rp 400.000/bln', 'packetdtl', 4, '4'),
(221, '1111116', 'Info Perusahaan', NULL, 'h1', 1, '0'),
(222, '1111116', 'Nama*', NULL, 'name', 2, '11'),
(223, '1111116', 'Alamat Perusahaan*', NULL, 'address', 3, '13'),
(224, '1111116', 'Bidang Usaha*', 'Jasa Umum,Jasa Keuangan, Jasa Perusahaan', 'business_fields', 4, '4'),
(225, '1111116', 'Jumlah Karyawan*', NULL, 'numemployees', 5, '5'),
(226, '1111116', 'Info PIC', NULL, 'h2', 6, '0'),
(227, '1111116', 'Kontak PIC*', NULL, 'contactpic', 7, '11'),
(228, '1111116', 'No HP PIC*', NULL, 'msisdnpic', 8, '5'),
(229, '1111116', 'Alasan Tertarik dengan IndiHub*', NULL, 'interest_reason', 9, '11'),
(240, '1111117', 'Keperluan*', NULL, 'necessary', 1, '11'),
(241, '1111117', 'Foto KTP*', NULL, 'rsp_ktp', 2, '15'),
(242, '1111117', 'Foto Dokumen Pendukung*', NULL, 'rsp_document', 3, '15'),
(260, '1111118', 'Foto Surat Nikah*', NULL, 'rsp_marriage', 8, '15'),
(261, '1111118', 'Foto Anda*', NULL, 'rsp_me', 9, '15'),
(263, '1111118', 'Keterangan Pindah*', NULL, 'info_moved', 1, '11'),
(264, '1111118', 'Foto Surat Pengantar RT/RW*', NULL, 'rsp_cover_letter', 2, '15'),
(265, '1111118', 'Foto Tanda Pelunasan PBB*', NULL, 'rsp_sign_repayment', 3, '15'),
(266, '1111118', 'Foto KTP*', NULL, 'rsp_ktp', 4, '15'),
(267, '1111118', 'Foto KK*', NULL, 'rsp_kk', 5, '15'),
(268, '1111118', 'Foto Akta Kelahiran*', NULL, 'rsp_birth', 6, '15'),
(269, '1111118', 'Foto Ijasah Terakhir*', NULL, 'rsp_diploma', 7, '15'),
(282, '1111119', 'Jenis Pengaduan*', 'Keamanan,Perangkat,Pemerintah,Dll', 'type_complaint', 1, '4'),
(283, '1111119', 'Keluhan/Masalah*', NULL, 'complaint', 2, '11'),
(284, '1111119', 'File Pendukung(Foto, Video, Dokumen)*', NULL, 'rsp_support', 3, '14'),
(285, '14045', 'Nama*', '', 'name', 1, '6'),
(286, '14045', 'Deskripsi', '', 'description', 2, '11'),
(287, '14045', 'Tanggal*', '', 'date', 3, '1'),
(288, '14045', 'Waktu*', '', 'time', 4, '3'),
(289, '14045', 'Opsi 1', 'Opsi 1', 'option1', 5, '12'),
(290, '14045', 'Opsi 2', 'Opsi 2', 'option2', 6, '12'),
(304, '14045', 'Nama Bapak', '', 'father_name', 7, '6'),
(305, '14045', 'Nama Ibu', '', 'mother_name', 8, '6');

-- --------------------------------------------------------

--
-- Table structure for table `form_item_select`
--

CREATE TABLE `form_item_select` (
  `ID` int(11) NOT NULL,
  `FORM_ITEM` int(11) NOT NULL,
  `VALUE` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_submission`
--

CREATE TABLE `form_submission` (
  `ID` int(11) NOT NULL,
  `USER_ID` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `FORM_ID` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `TIMESTAMP` datetime NOT NULL,
  `DATA` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `form_submission`
--

INSERT INTO `form_submission` (`ID`, `USER_ID`, `FORM_ID`, `TIMESTAMP`, `DATA`) VALUES
(2, '63234', '14045', '2021-07-22 05:17:19', '[{\"name\":\"name\",\"value\":\"adfaf\"},{\"name\":\"description\",\"value\":\"adfadfadfad\"},{\"name\":\"date\",\"value\":\"2021-07-22\"},{\"name\":\"time\",\"value\":\"10:09\"},{\"name\":\"option1\",\"value\":\"Opsi 1\"},{\"name\":\"father_name\",\"value\":\"asfasfafs\"},{\"name\":\"mother_name\",\"value\":\"afadfadfadf\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `form_item`
--
ALTER TABLE `form_item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `form_item_select`
--
ALTER TABLE `form_item_select`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `form_submission`
--
ALTER TABLE `form_submission`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `form_item`
--
ALTER TABLE `form_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `form_item_select`
--
ALTER TABLE `form_item_select`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_submission`
--
ALTER TABLE `form_submission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
