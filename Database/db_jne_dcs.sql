-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 11:21 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jne_dcs`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `dca_customer`
-- (See below for the actual view)
--
CREATE TABLE `dca_customer` (
`id` int(11)
,`nama_korporat` varchar(255)
,`email` varchar(50)
,`nama_business` varchar(120)
,`time_sign` varchar(10)
,`nip` varchar(15)
,`nama` varchar(255)
,`pic_name` varchar(255)
,`nama_agenda` varchar(255)
,`status_activity` enum('WAIT','ACCEPTED','PROGRESS','DONE','RESCHEDULING','CANCEL')
,`remark` text
,`no_mom` varchar(150)
,`saran_ksrn` text
,`created_date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dca_kuisioner`
-- (See below for the actual view)
--
CREATE TABLE `dca_kuisioner` (
`id_jenis` int(11)
,`jenis_kuisioner` varchar(200)
,`id_pertanyaan` int(11)
,`isi_pertanyaan` text
);

-- --------------------------------------------------------

--
-- Table structure for table `dcs_agenda`
--

CREATE TABLE `dcs_agenda` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text,
  `tanggal_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_agenda`
--

INSERT INTO `dcs_agenda` (`id`, `nama`, `deskripsi`, `tanggal_buat`) VALUES
(1, 'MEETING NEW BUSINESS', 'MEETING NEW BUSINESS', '2019-06-28 13:00:18'),
(2, 'MEETING DEVELOPMENT', 'MEETING DEVELOPMENT', '2019-06-28 13:00:27'),
(3, 'MAINTENENCE', 'MAINTENENCE', '2019-06-28 13:00:33'),
(5, 'INTERNAL COMMUNICATION', 'INTERNAL COMMUNICATION', '2019-06-28 13:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_business_type`
--

CREATE TABLE `dcs_business_type` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `deskripsi` text,
  `tanggal_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_business_type`
--

INSERT INTO `dcs_business_type` (`id`, `nama`, `deskripsi`, `tanggal_buat`) VALUES
(2, 'ECOMMERCE', 'ECOMMERCE', '2019-06-28 13:00:55'),
(3, '3PL', '3PL', '2019-06-28 13:01:01'),
(4, 'AGRICULTURE&POULTRY ', 'AGRICULTURE&POULTRY ', '2019-06-28 13:01:07'),
(5, 'AUTOMOTIVE', 'AUTOMOTIVE', '2019-06-28 13:01:12'),
(6, 'BANK&FINANCE', 'BANK&FINANCE', '2019-06-28 13:01:16'),
(7, 'CHEMICAL', 'CHEMICAL', '2019-06-28 13:01:20'),
(8, 'CONSTRUCTION&HEAVY EQUIPMENT', 'CONSTRUCTION&HEAVY EQUIPMENT', '2019-06-28 13:01:24'),
(9, 'ENERGY&MINNING ', 'ENERGY&MINNING ', '2019-06-28 13:01:30'),
(10, 'FMCG', 'FMCG', '2019-06-28 13:01:34'),
(11, 'GOVERNMENT', 'GOVERNMENT', '2019-06-28 13:01:38'),
(12, 'MANUFACTURING', 'MANUFACTURING', '2019-06-28 13:01:41'),
(13, 'PHARMACY&HEALTHCARE', 'PHARMACY&HEALTHCARE', '2019-06-28 13:01:45'),
(14, 'PROPERTY', 'PROPERTY', '2019-06-28 13:01:49'),
(16, 'SERVICES', 'SERVICES', '2019-06-28 13:01:57'),
(17, 'TELCO TECH & MEDIA', 'TELCO TECH & MEDIA', '2019-06-28 13:02:01'),
(18, 'OTHERS', 'OTHERS', '2019-06-28 13:02:04'),
(19, 'RETAIL', 'RETAIL', '2019-06-28 13:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_customer`
--

CREATE TABLE `dcs_customer` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_korporat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_buat` datetime NOT NULL,
  `login_terakhir` datetime DEFAULT NULL,
  `status_member` enum('NB','M') COLLATE utf8_unicode_ci DEFAULT 'M',
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dcs_customer`
--

INSERT INTO `dcs_customer` (`id`, `nama_lengkap`, `nama_korporat`, `no_tlp`, `email`, `alamat`, `photo`, `tanggal_buat`, `login_terakhir`, `status_member`, `pass`) VALUES
(1, 'Mohamad Iqbal M', 'IqbalDEV', '', 'iqbalm1995@gmail.com', '', NULL, '2019-06-29 00:24:52', '2019-06-29 00:24:44', 'M', ''),
(3, 'Santoso Aji', 'AjiKomputer', '', 'santoso1982@gmail.com', '', NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(4, 'Emil Kurniawan', 'Pencils', '083820509091', 'emil1989@gmail.com', '', NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(6, 'Anjisan', 'Anjisan Shop', '081', 'anjinanshop@gmail.com', '', NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(7, 'Fathia', 'Mukena Fathia', '081', 'fathia.mukena@gmail.com', '', NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(8, 'Maskerans', 'Maskerans', '081', 'maskerans331@gmail.com', '', NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(198, 'Hadjunature', 'Hadjunature', '081', 'hadjunature@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(199, 'Pt. Sinar Continental', 'Sinar Continental', '081', 'sinar.continental@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(200, 'Yny Shop', 'Yny Shop', '081', 'yny_shop@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(201, 'Elizabeth Hanjaya', 'Elizabeth Hanjaya', '081', 'elizabeth.hanjaya@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(202, 'Garini Nagata', 'Garini Nagata', '081', 'garini.nagata@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(203, 'Tasnia Id', 'Tasnia Id', '081', 'tasnia@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(204, 'Warvape Foglan', 'Warvape Foglan', '081', 'warvape.foglan@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(205, 'Salmayra Craft', 'Salmayra Craft', '081', 'salmayra.craft@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(206, 'Salmayra Craft', 'Salmayra Craft', '081', 'salmayra.craft@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(207, 'Cisokan Herbal', 'Cisokan Herbal', '081', 'cisokan.herbal@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(208, 'Rumah Hijab Saraswati', 'Rumah Hijab Saraswati', '081', 'rumah.hijab.saraswati@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(209, 'Bandung Distro Net', 'Bandung Distro Net', '081', 'bandung_distro@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(210, 'Fayad Agency', 'Fayad Agency', '081', 'fayad_agency@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(211, 'Unique Ethnic', 'Unique Ethnic', '081', 'unique.ethnic@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(212, 'Butik Aluna', 'Butik Aluna', '081', 'butik.aluna@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(213, 'Beauty Lugue', 'Beauty Lugue', '081', 'beauty.lugue@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(214, 'Idws', 'Idws', '081', 'idws1123@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(215, 'Eiger Adventure', 'Eiger Adventure', '081', 'eiger_adventure@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(216, 'Pt. Sinergi Mitra Utama', 'Sinergi Mitra Utama', '081', 'sinergi.mitra.utama@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(217, 'Bunda Jaya Herbal', 'Bunda Jaya Herbal', '081', 'bunda.jaya.herbal@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(218, 'Golfer', 'Golfer', '081', 'golfer2017@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(219, 'Kick Muslimah', 'Kick Muslimah', '081', 'kick_muslimah@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(220, 'Ng Ros', 'Ng Ros', '081', 'ng_ros112@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(221, 'Matso Brother', 'Matso Brother', '081', 'matso_brother@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(222, 'Taqwa Creative', 'Taqwa Creative', '081', 'taqwa_creative@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(223, 'Kios Lebah', 'Kios Lebah', '081', 'kios_lebah@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(224, 'Fayad', 'Fayad', '081', 'fayad102@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(225, 'Elena Boutique', 'Elena Boutique', '081', 'elena_boutique@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(226, 'Pt.Smu', 'Pt.Smu', '081', 'pt.smu@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL),
(227, 'Kaos Polos', 'Kaos Polos', '081', 'kaos_polos@gmail.com\r', NULL, NULL, '2019-06-29 00:24:52', NULL, 'M', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dcs_dca`
--

CREATE TABLE `dcs_dca` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `time_sign` varchar(10) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `pic_name` varchar(255) DEFAULT NULL,
  `agenda_id` int(11) NOT NULL,
  `status_activity` enum('WAIT','ACCEPTED','PROGRESS','DONE','RESCHEDULING','CANCEL') NOT NULL DEFAULT 'WAIT',
  `remark` text NOT NULL,
  `no_mom` varchar(150) DEFAULT NULL,
  `saran_ksrn` text,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_dca`
--

INSERT INTO `dcs_dca` (`id`, `customer_id`, `business_id`, `time_sign`, `pic_id`, `pic_name`, `agenda_id`, `status_activity`, `remark`, `no_mom`, `saran_ksrn`, `created_date`) VALUES
(6, 1, 2, '6:30 PM', 1, NULL, 3, 'ACCEPTED', 'Meetup', '', 'Pelayanan harus lebih ditingkatkan', '2019-06-28 13:11:41'),
(11, 6, 2, '2:15 PM', 26, NULL, 3, 'DONE', 'FOLOWUP PENAWARAN', '', NULL, '2019-06-28 19:37:43'),
(12, 7, 2, '6:30 PM', 17, NULL, 3, 'DONE', 'MEMBERIKAN PENAWARAN', '', NULL, '2019-06-28 19:39:13'),
(13, 198, 2, '5:00 PM', 5, NULL, 3, 'DONE', 'SERAH TERIMA AWB', '', NULL, '2019-06-28 19:40:37'),
(14, 199, 2, '2:00 PM', 29, NULL, 3, 'DONE', 'PROBBING KIRIMAN JTR', '', NULL, '2019-06-28 19:41:28'),
(15, 224, 2, '11:45 AM', 22, NULL, 3, 'DONE', 'IMPLEMENTASI CS3', '', NULL, '2019-06-28 19:42:10'),
(16, 219, 2, '5:00 PM', 27, NULL, 3, 'DONE', 'HANDLING CASE KESALAHAN SERVICE', '', 'Pelayanan Bagus', '2019-06-28 19:42:39'),
(17, 1, 2, '2:15 PM', 31, NULL, 3, 'WAIT', 'Daily Visit', NULL, NULL, '2019-08-14 06:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_jawaban_ksrn`
--

CREATE TABLE `dcs_jawaban_ksrn` (
  `id` int(11) NOT NULL,
  `responden` int(11) NOT NULL,
  `persentase` int(11) NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_jawaban_ksrn`
--

INSERT INTO `dcs_jawaban_ksrn` (`id`, `responden`, `persentase`, `created_date`) VALUES
(7, 1, 72, '2019-08-13'),
(8, 2, 54, '2019-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_jenis_ksrn`
--

CREATE TABLE `dcs_jenis_ksrn` (
  `id` int(11) NOT NULL,
  `jenis_kuisioner` varchar(200) NOT NULL,
  `deskripsi` text,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_jenis_ksrn`
--

INSERT INTO `dcs_jenis_ksrn` (`id`, `jenis_kuisioner`, `deskripsi`, `created_date`) VALUES
(1, 'PickUp', 'Penilian Pelayanan Kuisioner PickUP', '2019-05-15 11:16:21'),
(2, 'Sales', 'Penlilaian Pelayanan Untuk Sales', '2019-05-15 11:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_kuisioner`
--

CREATE TABLE `dcs_kuisioner` (
  `id` int(11) NOT NULL,
  `dca_id` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_kuisioner`
--

INSERT INTO `dcs_kuisioner` (`id`, `dca_id`, `pertanyaan_id`, `jawaban`, `created_date`) VALUES
(51, 16, 2, '2', '2019-08-13 14:43:00'),
(52, 16, 3, '3', '2019-08-13 14:43:00'),
(53, 16, 4, '3', '2019-08-13 14:43:01'),
(54, 16, 5, '4', '2019-08-13 14:43:01'),
(55, 16, 6, '4', '2019-08-13 14:43:01'),
(56, 16, 7, '4', '2019-08-13 14:43:01'),
(57, 16, 8, '3', '2019-08-13 14:43:01'),
(58, 16, 9, '2', '2019-08-13 14:43:01'),
(59, 16, 10, '3', '2019-08-13 14:43:01'),
(60, 16, 11, '3', '2019-08-13 14:43:01'),
(61, 16, 12, '2', '2019-08-13 14:43:01'),
(62, 16, 13, '3', '2019-08-13 14:43:02'),
(63, 16, 14, '3', '2019-08-13 14:43:02'),
(64, 16, 15, '3', '2019-08-13 14:43:02'),
(65, 16, 16, '1', '2019-08-13 14:43:02'),
(66, 16, 17, '3', '2019-08-13 14:43:02'),
(67, 16, 18, '3', '2019-08-13 14:43:02'),
(68, 16, 19, '3', '2019-08-13 14:43:02'),
(69, 16, 20, '3', '2019-08-13 14:43:02'),
(70, 6, 2, '1', '2019-08-13 18:47:40'),
(71, 6, 3, '2', '2019-08-13 18:47:40'),
(72, 6, 4, '2', '2019-08-13 18:47:40'),
(73, 6, 5, '1', '2019-08-13 18:47:40'),
(74, 6, 6, '2', '2019-08-13 18:47:40'),
(75, 6, 7, '2', '2019-08-13 18:47:41'),
(76, 6, 8, '2', '2019-08-13 18:47:41'),
(77, 6, 9, '1', '2019-08-13 18:47:41'),
(78, 6, 10, '1', '2019-08-13 18:47:41'),
(79, 6, 11, '1', '2019-08-13 18:47:41'),
(80, 6, 12, '1', '2019-08-13 18:47:41'),
(81, 6, 13, '1', '2019-08-13 18:47:41'),
(82, 6, 14, '1', '2019-08-13 18:47:41'),
(83, 6, 15, '1', '2019-08-13 18:47:42'),
(84, 6, 16, '1', '2019-08-13 18:47:42'),
(85, 6, 17, '2', '2019-08-13 18:47:42'),
(86, 6, 18, '2', '2019-08-13 18:47:42'),
(87, 6, 19, '2', '2019-08-13 18:47:42'),
(88, 6, 20, '1', '2019-08-13 18:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_pertanyaan_ksrn`
--

CREATE TABLE `dcs_pertanyaan_ksrn` (
  `id` int(11) NOT NULL,
  `jenis_ksrn_id` int(11) NOT NULL,
  `isi_pertanyaan` text,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_pertanyaan_ksrn`
--

INSERT INTO `dcs_pertanyaan_ksrn` (`id`, `jenis_ksrn_id`, `isi_pertanyaan`, `created_date`) VALUES
(2, 1, 'Petugas menampilkan rambut rapih berwarna natural dan terawat?', '2019-06-29 02:10:58'),
(3, 1, 'Petugas berwajah bersih (tidak berjenggot, tidak berkumis, tidak berjambang)?', '2019-06-29 02:11:22'),
(4, 1, 'Petugas menggunakan Aksesoris standar (Hanya jamtangan, Cincin pernikahan)?', '2019-06-29 02:12:04'),
(5, 1, 'Petugas berseragam dan ID card secara rapih?', '2019-06-29 02:12:22'),
(6, 1, 'Petugas menggunakan sepatu hitam?', '2019-06-29 02:12:35'),
(7, 1, 'Petugas terlihat segar, wangi/tidak bau badan dan mulut?', '2019-06-29 02:12:55'),
(8, 1, 'Petugas memberikan salam?', '2019-06-29 02:13:17'),
(9, 1, 'Petugas mencatat kiriman di Pickup Order Sheet?', '2019-06-29 02:13:31'),
(10, 1, 'Petugas menyanyakan isi kiriman dan mencatat di pickup order sheet?', '2019-06-29 02:13:45'),
(11, 1, 'Petugas menanyakan jenis layanan kiriman (YES, OKE, Regularm Intracity, dll)', '2019-06-29 02:14:02'),
(12, 1, 'Petugas menghitung jumlah kiriman dihadapi customer?', '2019-06-29 02:27:15'),
(13, 1, 'Petugas meminta tandatangan customer di Pickup Order Sheet?', '2019-06-29 02:27:57'),
(14, 1, 'Petugas meninggalkan pesan ke customer saat petugas datang customer tidak ada di tempat?', '2019-06-29 02:28:19'),
(15, 1, 'Petugas memastikan barang terbawa pada saat loading barang?', '2019-06-29 02:28:32'),
(16, 1, 'Armada petugas terlihat bersih.', '2019-06-29 02:28:54'),
(17, 1, 'Ketepatan waktu dalam Petugas Pickup.', '2019-06-29 02:29:11'),
(18, 1, 'Perilaku Petugas Pickup.', '2019-06-29 02:29:32'),
(19, 1, 'Kemudahan berkomunikasi melalui media elektronik petugas Pickup.', '2019-06-29 02:29:48'),
(20, 1, 'Penaganan barang kiriman oleh petugas pickup.', '2019-06-29 02:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_pic`
--

CREATE TABLE `dcs_pic` (
  `id` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `unit` varchar(120) NOT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `tanggal_buat` datetime NOT NULL,
  `login_terakhir` datetime NOT NULL,
  `pic_status` enum('WAIT','APPROVED','BANNED') NOT NULL DEFAULT 'WAIT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_pic`
--

INSERT INTO `dcs_pic` (`id`, `nip`, `nama`, `unit`, `no_tlp`, `pass`, `photo`, `tanggal_buat`, `login_terakhir`, `pic_status`) VALUES
(1, 'BDO17DDDDDD1', 'Mohamad Iqbal Musyaffa', 'Developer', '08892712873', 'f54ee6fb5b9ee5ea8f085144f601331b', 'file_1561728711.jpg', '2019-08-13 19:31:07', '0000-00-00 00:00:00', 'APPROVED'),
(2, 'BDO17DD002131', 'Denis', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(3, 'BDO17DD002132', 'Poppy', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(4, 'BDO17DD002133', 'Ajeng', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(5, 'BDO17DD002134', 'Aden', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(6, 'BDO17DD002135', 'Agus', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(7, 'BDO17DD002136', 'Rully', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(8, 'BDO17DD002137', 'Teddy', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(9, 'BDO17DD002138', 'Senny', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(10, 'BDO17DD002139', 'Dewi', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(11, 'BDO17DD002140', 'Wawan', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(12, 'BDO17DD002141', 'Okky', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(13, 'BDO17DD002142', 'Denny', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(14, 'BDO17DD002143', 'Eko', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(15, 'BDO17DD002144', 'Wawan', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(16, 'BDO17DD002145', 'Erna', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(17, 'BDO17DD002146', 'Dewi', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(18, 'BDO17DD002147', 'Nurtaufiq', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(19, 'BDO17DD002148', 'Dani', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(20, 'BDO17DD002149', 'Adrian', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(21, 'BDO17DD002150', 'Irwan', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(22, 'BDO17DD002151', 'Wawan', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(23, 'BDO17DD002152', 'Yoga', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(24, 'BDO17DD002153', 'Priyanto', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(25, 'BDO17DD002154', 'Intan', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(26, 'BDO17DD002155', 'Supriadi', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(27, 'BDO17DD002156', 'Darmadi', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(28, 'BDO17DD002157', 'Yoga', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(29, 'BDO17DD002158', 'Alvian', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(30, 'BDO17DD002159', 'Aat', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED'),
(31, 'BDO17DD002160', 'Alvian', 'JNE', '081', '2ee5dc1bd205cfc4d257806c8caa03ef\r', NULL, '2019-06-29 00:32:42', '0000-00-00 00:00:00', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `dcs_user_admin`
--

CREATE TABLE `dcs_user_admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `hak_akses` enum('Administrator','Executive','Section Head') NOT NULL,
  `created` datetime NOT NULL,
  `login_terakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcs_user_admin`
--

INSERT INTO `dcs_user_admin` (`id`, `user`, `pass`, `nama`, `deskripsi`, `hak_akses`, `created`, `login_terakhir`) VALUES
(1, 'admin123', 'b96853dc881c1ad831e20ea9c22c1576', 'ADMIN DCA', 'ADMIN DCA - SUPERUSER', 'Administrator', '2019-04-10 20:45:58', '2019-04-10 20:46:03'),
(2, 'iqbalm1995', 'b96853dc881c1ad831e20ea9c22c1576', 'IQBAL', 'ADMIN DCA - SUPERUSER', 'Administrator', '2019-08-02 07:40:58', '2019-08-02 07:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `dsc_remark`
--

CREATE TABLE `dsc_remark` (
  `id` int(11) NOT NULL,
  `dca_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `start_remark` varchar(10) NOT NULL,
  `end_remark` varchar(10) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dsc_remark`
--

INSERT INTO `dsc_remark` (`id`, `dca_id`, `title`, `desc`, `start_remark`, `end_remark`, `created`) VALUES
(3, 16, 'LAPORAN KENDALA', 'LAPORAN KENDALA SERVICE', '5:15 PM', '5:30 PM', '2019-06-28 19:49:53'),
(4, 16, 'HANDLING SERVICE', 'HANDLING SERVICE', '5:30 PM', '6:00 PM', '2019-06-28 19:50:24'),
(5, 16, 'OBROLAN LAIN', 'OBROLAN LAIN', '6:00 PM', '6:15 PM', '2019-06-28 19:51:00');

-- --------------------------------------------------------

--
-- Structure for view `dca_customer`
--
DROP TABLE IF EXISTS `dca_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dca_customer`  AS  select `dcs_dca`.`id` AS `id`,`dcs_customer`.`nama_korporat` AS `nama_korporat`,`dcs_customer`.`email` AS `email`,`dcs_business_type`.`nama` AS `nama_business`,`dcs_dca`.`time_sign` AS `time_sign`,`dcs_pic`.`nip` AS `nip`,`dcs_pic`.`nama` AS `nama`,`dcs_dca`.`pic_name` AS `pic_name`,`dcs_agenda`.`nama` AS `nama_agenda`,`dcs_dca`.`status_activity` AS `status_activity`,`dcs_dca`.`remark` AS `remark`,`dcs_dca`.`no_mom` AS `no_mom`,`dcs_dca`.`saran_ksrn` AS `saran_ksrn`,`dcs_dca`.`created_date` AS `created_date` from ((((`dcs_dca` join `dcs_customer` on((`dcs_dca`.`customer_id` = `dcs_customer`.`id`))) join `dcs_pic` on((`dcs_dca`.`pic_id` = `dcs_pic`.`id`))) join `dcs_business_type` on((`dcs_dca`.`business_id` = `dcs_business_type`.`id`))) join `dcs_agenda` on((`dcs_dca`.`agenda_id` = `dcs_agenda`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dca_kuisioner`
--
DROP TABLE IF EXISTS `dca_kuisioner`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dca_kuisioner`  AS  select `dcs_jenis_ksrn`.`id` AS `id_jenis`,`dcs_jenis_ksrn`.`jenis_kuisioner` AS `jenis_kuisioner`,`dcs_pertanyaan_ksrn`.`id` AS `id_pertanyaan`,`dcs_pertanyaan_ksrn`.`isi_pertanyaan` AS `isi_pertanyaan` from (`dcs_jenis_ksrn` join `dcs_pertanyaan_ksrn` on((`dcs_jenis_ksrn`.`id` = `dcs_pertanyaan_ksrn`.`jenis_ksrn_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dcs_agenda`
--
ALTER TABLE `dcs_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcs_business_type`
--
ALTER TABLE `dcs_business_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcs_customer`
--
ALTER TABLE `dcs_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcs_dca`
--
ALTER TABLE `dcs_dca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `pic_id` (`pic_id`),
  ADD KEY `business_id` (`business_id`),
  ADD KEY `agenda_id` (`agenda_id`);

--
-- Indexes for table `dcs_jawaban_ksrn`
--
ALTER TABLE `dcs_jawaban_ksrn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_ksrn_id` (`persentase`);

--
-- Indexes for table `dcs_jenis_ksrn`
--
ALTER TABLE `dcs_jenis_ksrn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcs_kuisioner`
--
ALTER TABLE `dcs_kuisioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`),
  ADD KEY `jawaban_id` (`jawaban`),
  ADD KEY `dca_id` (`dca_id`);

--
-- Indexes for table `dcs_pertanyaan_ksrn`
--
ALTER TABLE `dcs_pertanyaan_ksrn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_ksrn_id` (`jenis_ksrn_id`);

--
-- Indexes for table `dcs_pic`
--
ALTER TABLE `dcs_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcs_user_admin`
--
ALTER TABLE `dcs_user_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_USERNAME` (`user`);

--
-- Indexes for table `dsc_remark`
--
ALTER TABLE `dsc_remark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dca_id` (`dca_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dcs_agenda`
--
ALTER TABLE `dcs_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dcs_business_type`
--
ALTER TABLE `dcs_business_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dcs_customer`
--
ALTER TABLE `dcs_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `dcs_dca`
--
ALTER TABLE `dcs_dca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dcs_jawaban_ksrn`
--
ALTER TABLE `dcs_jawaban_ksrn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dcs_jenis_ksrn`
--
ALTER TABLE `dcs_jenis_ksrn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dcs_kuisioner`
--
ALTER TABLE `dcs_kuisioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `dcs_pertanyaan_ksrn`
--
ALTER TABLE `dcs_pertanyaan_ksrn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dcs_pic`
--
ALTER TABLE `dcs_pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `dcs_user_admin`
--
ALTER TABLE `dcs_user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dsc_remark`
--
ALTER TABLE `dsc_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dcs_dca`
--
ALTER TABLE `dcs_dca`
  ADD CONSTRAINT `dcs_dca_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `dcs_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dcs_dca_ibfk_3` FOREIGN KEY (`pic_id`) REFERENCES `dcs_pic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dcs_dca_ibfk_4` FOREIGN KEY (`business_id`) REFERENCES `dcs_business_type` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dcs_dca_ibfk_5` FOREIGN KEY (`agenda_id`) REFERENCES `dcs_agenda` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `dcs_kuisioner`
--
ALTER TABLE `dcs_kuisioner`
  ADD CONSTRAINT `dcs_kuisioner_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `dcs_pertanyaan_ksrn` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dcs_kuisioner_ibfk_4` FOREIGN KEY (`dca_id`) REFERENCES `dcs_dca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dcs_pertanyaan_ksrn`
--
ALTER TABLE `dcs_pertanyaan_ksrn`
  ADD CONSTRAINT `dcs_pertanyaan_ksrn_ibfk_1` FOREIGN KEY (`jenis_ksrn_id`) REFERENCES `dcs_jenis_ksrn` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dsc_remark`
--
ALTER TABLE `dsc_remark`
  ADD CONSTRAINT `dsc_remark_ibfk_1` FOREIGN KEY (`dca_id`) REFERENCES `dcs_dca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
