-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2018 at 02:45 AM
-- Server version: 5.5.61-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alert_disaster_smsengine`
--

-- --------------------------------------------------------

--
-- Table structure for table `bencana`
--

CREATE TABLE `bencana` (
  `id_bencana` int(11) NOT NULL,
  `nama_bencana` varchar(50) NOT NULL,
  `jenis_bencana` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `penyebab` varchar(50) NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bencana`
--

INSERT INTO `bencana` (`id_bencana`, `nama_bencana`, `jenis_bencana`, `lokasi`, `penyebab`, `jam`, `tanggal`, `latitude`, `longitude`, `status`) VALUES
(1, 'Gunung Merapi', 'Gunung Berapi', 'Perbatasan Jawa Tengah dan Yogyakarta', 'Aktivitas Seismik', '10:00:00', '2006-05-15', -7.5408, 110.445, 1),
(2, 'Gunung Merapi', 'Gunung Berapi', 'Perbatasan Jawa Tengah dan Yogyakarta', 'Aktivitas Seismik', '09:03:00', '2006-06-08', -7.5408, 110.445, 1),
(3, 'Gempa Yogyakarta', 'Gempa Bumi', 'Bantul, Daerah Istimewa Yogyakarta', 'Aktivitas Seismik', '05:55:00', '2006-05-27', -7.7344, 110.209, 1),
(18, 'Tsunami Aceh', 'Tsunami', 'Aceh', 'Gempa bumi', '07:58:53', '2004-12-26', 5.55, 95.3167, 1),
(20, 'Gunung Merapi', 'Gunung Berapi', 'Perbatasan Jawa Tengah dan Yogyakarta', 'Aktivitas Seismik', '15:00:00', '2010-10-04', -7.5408, 110.445, 1),
(21, 'Gunung Kelud', 'Gunung Berapi', 'Kabupaten Kediri, Jawa Timur', '-', '22:50:00', '2014-02-13', -7.93, 112.308, 1),
(22, 'Tsunami Mentawai', 'Tsunami', 'Pulau Pagai Selatan, Kepulauan Mentawai, Sumatera ', 'Gempa Bumi', '09:42:22', '2010-10-25', -2.1833, 2.1833, 1),
(23, 'Banjir Bandang Manado', 'Banjir', 'Manado, Sulawesi Utara', '-', '10:00:00', '2014-01-15', 1.4931, 124.841, 1),
(24, 'Gunung Sangeang Bima ', 'Gunung Berapi', 'Pulau Sangeang, Kecamatan Wera, Kabupaten Bima, Nu', '-', '11:00:00', '2014-05-30', -8.2, 119.067, 1),
(25, 'Longsor Bogor', 'Tanah Longsor', 'Kampung Neglasari RT 11/4, Desa Mekarwangi, Kecama', 'Hujan deras', '02:00:00', '2014-06-17', -6.6, 106.8, 1),
(26, 'Lava Pijar Gunung Slamet', 'Gunung Berapi', 'Jawa Tengah', 'gempa tremor harmonik', '19:00:00', '2014-08-07', -7.2392, 109.22, 1),
(27, 'Longsor Tambang emas', 'Tanah Longsor', 'Gua Boma, Kecamatan Monterado, Kabupaten Bengkayan', '-', '15:00:00', '2014-10-04', 0, 110.5, 1),
(28, 'Banjir Aceh', 'Banjir', 'Kecamatan Manggeng, Kabupaten Aceh Barat Daya', '-', '10:00:00', '2014-11-01', 3.7911, 95.9167, 1),
(29, 'Longsor Banjarnegara', 'Tanah Longsor', 'Dusun Jemblung, Desa Sampang, Kecamatan Karangkoba', '-', '17:30:00', '2014-12-12', -7.35472, 109.662, 1),
(30, 'Kebakaran Hutan dan Lahan', 'Kebakaran Hutan', 'Desa Tawangsari, Gempol, Jawa Timur', 'Dalam penyelidikan', '10:00:00', '2014-10-31', -7.56491, 112.696, 1),
(31, 'Kebakaran Hutan dan Lahan', 'Kebakaran Hutan', 'Prov. Sumatera Selatan', 'Masih dalam penyelidikan', '18:25:00', '2014-10-01', -3.31944, 103.914, 1),
(32, 'Kebakaran Hutan dan Lahan', 'Kebakaran Hutan', 'Riau', '103.914', '11:55:00', '2014-08-27', 0.29335, 101.707, 1),
(33, 'Kekeringan', 'Kekeringan', 'Kab. Malaka Prov. NTT', 'akibat musim kemarau yang berkepanjangan', '11:00:00', '2014-10-28', -10.1788, 123.598, 1),
(34, 'Kekeringan', 'Kekeringan', 'Kab. Ciamis, Provinsi Jawa Barat', 'musim kemarau', '00:00:00', '2014-09-12', -7.33333, 108.35, 1),
(35, 'Kekeringan', 'Kekeringan', 'Kab. Probolinggo, Prov. Jawa Timur', 'Musim kemarau yang panjang', '00:00:00', '2014-08-01', -7.80896, 113.722, 1),
(36, 'Tanah Longosr', 'Tanah Longsor', 'Ds Cipanas,Dukupuntang Kab. Cirebon, Jawa', 'Hujan dengan intensitas tinggi', '02:15:00', '2015-04-27', -0.404635, 117.203, 1),
(37, 'Puting Beliung', 'Angin Puting Beliung', 'Kab. Sukabumi Prov. Jawa Barat', 'Akibat hujan deras disertai angin kencang', '15:30:00', '2015-04-20', -7.00549, 106.924, 1),
(38, 'Puting Beliung', 'Angin Puting Beliung', 'Kab. Bolaang Prov. Sulawesi Utara', 'Hujan deras disertai angin kencang', '02:30:00', '2015-04-14', 0.670793, 124.131, 1),
(39, 'Kebakaran Permukiman', 'Kebakaran', 'Jl. Bangka 8 Kel. Pela Mampang Kec. Mampang', 'korsleting listrik', '00:00:00', '2015-04-27', -6.25081, 106.815, 1),
(40, 'Abrasi dan Gelombang Pasang', 'Abrasi', 'Kec. Koto Tengah Kota Padang Prov. Sumatera Barat', 'Akibat gelombang pasang air laut', '06:00:00', '2014-07-12', -0.858353, 100.329, 1),
(44, '', '', '', '', '00:00:00', '0000-00-00', 0, 0, 0),
(45, '', '', '', '', '00:00:00', '0000-00-00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_bencana` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `jam_laporan` time NOT NULL,
  `meninggal` int(11) NOT NULL,
  `luka_berat` int(11) NOT NULL,
  `luka_ringan` int(11) NOT NULL,
  `hilang` int(11) NOT NULL,
  `mengungsi_jiwa` int(11) NOT NULL,
  `mengungsi_kk` int(11) NOT NULL,
  `rumah` int(11) NOT NULL,
  `kantor` int(11) NOT NULL,
  `fasilitas_kesehatan` int(11) NOT NULL,
  `fasilitas_pendidikan` int(11) NOT NULL,
  `fasilitas_umum` int(11) NOT NULL,
  `sarana_ibadah` int(11) NOT NULL,
  `jembatan` int(11) NOT NULL,
  `jalan` int(11) NOT NULL,
  `tanggul` int(11) NOT NULL,
  `sawah` int(11) NOT NULL,
  `lahan_pertanian` int(11) NOT NULL,
  `lain_lain` int(11) NOT NULL,
  `bupati_tgl` date NOT NULL,
  `bupati_jam` time NOT NULL,
  `posko` tinyint(1) NOT NULL,
  `koordinasi` tinyint(1) NOT NULL,
  `evakuasi` tinyint(1) NOT NULL,
  `kesehatan` tinyint(1) NOT NULL,
  `dapur` tinyint(1) NOT NULL,
  `distribusi` tinyint(1) NOT NULL,
  `pengerahan` tinyint(1) NOT NULL,
  `sumber_daya` varchar(500) NOT NULL,
  `kendala` varchar(500) NOT NULL,
  `kebutuhan_mendesak` varchar(500) NOT NULL,
  `rencana_tindaklanjut` varchar(500) NOT NULL,
  `tim_bpbd` int(11) NOT NULL,
  `tim_dinsos` int(11) NOT NULL,
  `tim_dinkes` int(11) NOT NULL,
  `tim_pu` int(11) NOT NULL,
  `sub_tim` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rencana_aksi` varchar(500) NOT NULL,
  `kesimpulan` varchar(500) NOT NULL,
  `penutup` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_bencana`, `id_user`, `tanggal_laporan`, `jam_laporan`, `meninggal`, `luka_berat`, `luka_ringan`, `hilang`, `mengungsi_jiwa`, `mengungsi_kk`, `rumah`, `kantor`, `fasilitas_kesehatan`, `fasilitas_pendidikan`, `fasilitas_umum`, `sarana_ibadah`, `jembatan`, `jalan`, `tanggul`, `sawah`, `lahan_pertanian`, `lain_lain`, `bupati_tgl`, `bupati_jam`, `posko`, `koordinasi`, `evakuasi`, `kesehatan`, `dapur`, `distribusi`, `pengerahan`, `sumber_daya`, `kendala`, `kebutuhan_mendesak`, `rencana_tindaklanjut`, `tim_bpbd`, `tim_dinsos`, `tim_dinkes`, `tim_pu`, `sub_tim`, `status`, `rencana_aksi`, `kesimpulan`, `penutup`) VALUES
(1, 2, 1, '2015-02-01', '11:11:11', 208, 16, 282, 23, 183, 14, 25, 10, 29, 21, 11, 21, 24, 23, 15, 18, 15, 10, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(2, 2, 2, '2015-01-01', '02:22:02', 150, 15, 208, 29, 103, 16, 18, 14, 25, 11, 12, 19, 27, 26, 17, 21, 24, 26, '2015-03-01', '02:02:02', 0, 0, 0, 0, 0, 0, 0, 'ui', 'ui', 'ui', 'ui', 0, 0, 0, 0, 0, 1, '', '', ''),
(3, 2, 2, '2015-02-03', '01:00:00', 286, 14, 171, 11, 177, 23, 12, 24, 10, 11, 17, 19, 14, 23, 23, 17, 28, 17, '2015-03-01', '03:03:03', 1, 0, 1, 0, 1, 0, 1, '3', '3', '3', '3', 0, 0, 0, 0, 0, 1, '', '', ''),
(23, 3, 1, '2015-01-01', '11:11:11', 101, 10, 111, 14, 299, 15, 18, 12, 20, 12, 12, 15, 30, 30, 10, 14, 28, 28, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(24, 2, 1, '2015-01-01', '11:11:11', 233, 24, 216, 26, 115, 11, 14, 26, 14, 27, 21, 12, 29, 16, 25, 25, 22, 25, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(25, 20, 2, '2015-01-01', '11:11:12', 287, 18, 159, 14, 147, 20, 27, 21, 18, 14, 29, 29, 28, 22, 16, 26, 30, 20, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, 'q', 'a', 'z'),
(26, 20, 1, '2015-01-01', '11:11:11', 214, 18, 139, 27, 217, 18, 17, 19, 16, 14, 11, 25, 21, 20, 26, 21, 15, 25, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '1', '1', '1'),
(27, 3, 1, '2015-01-04', '11:11:11', 296, 22, 118, 23, 289, 26, 12, 13, 21, 14, 17, 13, 24, 10, 30, 29, 25, 28, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(28, 3, 1, '2015-01-05', '11:11:11', 122, 30, 195, 20, 108, 25, 20, 17, 16, 21, 25, 30, 26, 29, 14, 19, 19, 30, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(29, 3, 1, '2015-01-06', '11:11:11', 216, 29, 280, 25, 275, 14, 20, 28, 28, 25, 11, 12, 18, 24, 14, 10, 17, 27, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, 'q', '1', '4'),
(30, 2, 1, '2015-01-07', '11:11:11', 119, 30, 199, 22, 201, 25, 13, 21, 15, 26, 10, 27, 11, 29, 19, 20, 12, 12, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '1', '2', '3'),
(31, 3, 1, '2015-01-05', '11:11:11', 156, 30, 124, 23, 257, 10, 26, 28, 10, 17, 28, 16, 26, 11, 30, 26, 27, 29, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(32, 3, 1, '2015-01-09', '11:11:11', 128, 28, 115, 24, 137, 28, 26, 18, 23, 28, 23, 20, 22, 21, 28, 28, 23, 22, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(33, 20, 1, '2015-01-20', '11:11:11', 292, 11, 187, 30, 228, 14, 15, 21, 29, 11, 22, 23, 19, 19, 25, 19, 10, 23, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, 'qw', 'we', 'rt'),
(34, 18, 1, '2007-01-01', '11:11:11', 161, 21, 265, 19, 271, 28, 27, 20, 11, 26, 25, 16, 18, 11, 11, 15, 29, 10, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(35, 18, 1, '2008-01-01', '11:11:11', 134, 28, 263, 19, 271, 28, 28, 25, 12, 18, 22, 24, 26, 27, 25, 14, 29, 29, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(36, 18, 1, '2008-01-02', '11:11:11', 273, 21, 124, 30, 212, 27, 21, 12, 29, 18, 13, 24, 30, 24, 21, 22, 18, 13, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(37, 18, 2, '2008-01-03', '11:11:11', 249, 13, 212, 16, 283, 23, 17, 30, 26, 10, 23, 16, 20, 23, 23, 15, 19, 20, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(38, 18, 1, '2008-01-04', '11:11:11', 137, 17, 164, 20, 190, 26, 24, 10, 30, 26, 10, 24, 18, 10, 29, 19, 19, 29, '2015-03-01', '01:01:01', 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', '1', 0, 0, 0, 0, 0, 1, '', '', ''),
(39, 20, 2, '2015-03-05', '11:11:00', 153, 21, 107, 20, 167, 14, 11, 23, 30, 11, 18, 26, 23, 27, 15, 27, 16, 10, '0001-01-01', '01:01:00', 0, 1, 0, 0, 0, 0, 0, '1', '1', '1', '1', 0, 0, 0, 0, 1, 1, 'cepat', '125', '23'),
(40, 29, 2, '2015-04-01', '01:01:00', 141, 30, 165, 23, 169, 25, 22, 25, 30, 21, 28, 27, 20, 29, 15, 20, 22, 21, '0001-01-01', '01:01:00', 0, 0, 0, 0, 0, 0, 0, '1', '1', '1', '1', 1, 1, 1, 1, 0, 1, '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_posko`
--

CREATE TABLE `laporan_posko` (
  `id_posko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `tgl_lap_posko` date NOT NULL,
  `jam_lap_posko` time NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `fasilitas_dapur` int(11) NOT NULL,
  `fasilitas_kesehatan` int(11) NOT NULL,
  `fasilitas_mck` int(11) NOT NULL,
  `jumlah_kk` int(11) NOT NULL,
  `jumlah_pria` int(11) NOT NULL,
  `jumlah_wanita` int(11) NOT NULL,
  `jumlah_balita` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_posko`
--

INSERT INTO `laporan_posko` (`id_posko`, `id_user`, `id_laporan`, `tgl_lap_posko`, `jam_lap_posko`, `kapasitas`, `fasilitas_dapur`, `fasilitas_kesehatan`, `fasilitas_mck`, `jumlah_kk`, `jumlah_pria`, `jumlah_wanita`, `jumlah_balita`, `status`) VALUES
(3, 1, 1, '2010-11-22', '10:00:00', 111, 1, 9, 2, 168, 112, 128, 104, 1),
(4, 1, 2, '2010-11-22', '10:00:00', 274, 3, 9, 6, 192, 171, 139, 118, 1),
(5, 1, 3, '2010-11-22', '10:00:00', 338, 3, 9, 8, 185, 203, 130, 119, 1),
(6, 1, 4, '2010-11-22', '10:00:00', 166, 8, 4, 5, 200, 266, 165, 115, 1),
(7, 1, 5, '2010-11-22', '10:00:00', 317, 8, 0, 4, 139, 232, 172, 112, 1),
(8, 1, 6, '2010-11-22', '10:00:00', 386, 8, 3, 3, 210, 251, 113, 108, 1),
(12, 1, 7, '2010-11-22', '10:00:00', 278, 5, 5, 9, 137, 123, 101, 115, 0),
(1, 1, 8, '2010-11-22', '10:00:00', 133, 6, 9, 7, 107, 280, 136, 102, 1),
(10, 1, 9, '2010-11-22', '10:00:00', 331, 5, 4, 5, 205, 275, 181, 108, 1),
(13, 1, 10, '2010-11-19', '10:00:00', 557, 6, 0, 2, 144, 157, 177, 120, 1),
(9, 1, 11, '2010-11-24', '12:00:00', 489, 5, 8, 6, 246, 228, 101, 103, 1),
(3, 1, 12, '2012-01-01', '11:00:00', 676, 6, 0, 9, 257, 109, 189, 105, 1),
(3, 1, 13, '2011-12-21', '12:00:00', 611, 7, 9, 3, 280, 200, 181, 111, 1),
(6, 2, 14, '2010-12-01', '12:00:00', 325, 2, 5, 2, 210, 288, 105, 109, 1),
(2, 2, 15, '2010-12-02', '12:00:00', 293, 1, 2, 7, 146, 260, 129, 101, 1),
(2, 2, 16, '2010-12-03', '12:00:00', 391, 5, 3, 2, 139, 141, 144, 112, 1),
(3, 2, 17, '2010-12-08', '12:00:00', 377, 5, 2, 3, 119, 181, 174, 110, 1),
(5, 2, 18, '2010-12-09', '12:00:00', 611, 2, 7, 0, 286, 203, 180, 109, 1),
(2, 2, 19, '2010-12-11', '12:00:00', 625, 8, 9, 0, 163, 209, 177, 104, 1),
(4, 2, 20, '2010-12-21', '12:00:00', 591, 8, 4, 6, 122, 203, 125, 114, 1),
(8, 2, 21, '2010-12-01', '12:00:00', 377, 7, 6, 1, 197, 122, 111, 105, 1),
(4, 2, 22, '2010-12-02', '12:00:00', 615, 8, 5, 3, 274, 174, 126, 103, 1),
(5, 2, 23, '2010-12-03', '12:00:00', 642, 1, 1, 4, 285, 123, 183, 116, 1),
(11, 2, 24, '2015-12-04', '12:00:00', 666, 4, 7, 5, 216, 131, 105, 116, 1),
(7, 2, 25, '2010-12-05', '12:00:00', 100, 7, 4, 9, 167, 277, 142, 109, 1),
(6, 2, 26, '2010-12-06', '12:00:00', 205, 9, 2, 5, 102, 179, 194, 110, 1),
(17, 2, 27, '2010-12-07', '12:00:00', 629, 7, 0, 3, 156, 192, 146, 119, 1),
(2, 2, 28, '2010-12-08', '12:00:00', 624, 1, 0, 8, 106, 227, 106, 109, 1),
(8, 2, 29, '2010-12-09', '12:00:00', 535, 9, 4, 6, 217, 114, 161, 117, 1),
(2, 2, 30, '2015-01-01', '12:00:00', 100, 3, 2, 3, 104, 295, 180, 101, 1),
(13, 2, 31, '2015-12-02', '12:00:00', 602, 0, 7, 9, 153, 210, 195, 101, 1),
(12, 2, 32, '2010-12-03', '12:00:00', 204, 5, 4, 8, 246, 124, 142, 115, 1),
(11, 2, 33, '2015-12-03', '12:33:00', 317, 4, 0, 0, 298, 258, 197, 109, 1),
(2, 2, 34, '2015-12-03', '12:00:00', 271, 4, 9, 3, 255, 279, 113, 100, 1),
(7, 2, 35, '2015-12-03', '12:00:00', 305, 6, 0, 2, 136, 136, 136, 105, 1),
(2, 2, 36, '2015-12-03', '12:00:00', 611, 2, 5, 0, 180, 286, 145, 109, 1),
(9, 2, 37, '2015-12-03', '12:00:00', 241, 9, 5, 6, 199, 231, 180, 100, 1),
(17, 2, 38, '2010-12-01', '12:00:00', 472, 6, 3, 7, 269, 271, 174, 102, 1),
(13, 2, 39, '2010-12-03', '12:00:00', 337, 4, 9, 3, 242, 223, 195, 118, 1),
(17, 2, 40, '2010-12-05', '12:00:00', 168, 5, 0, 8, 275, 277, 179, 106, 1),
(17, 2, 41, '2010-12-06', '12:00:00', 330, 1, 8, 9, 128, 266, 171, 100, 1),
(18, 2, 42, '2010-11-03', '12:00:00', 446, 0, 2, 2, 131, 135, 140, 110, 1),
(18, 2, 43, '2010-11-05', '12:00:00', 541, 2, 7, 9, 229, 158, 154, 116, 1),
(15, 2, 44, '2010-11-06', '12:00:00', 668, 4, 6, 9, 103, 124, 155, 107, 1),
(19, 2, 45, '2010-10-03', '12:00:00', 412, 2, 0, 7, 155, 151, 146, 110, 1),
(16, 2, 46, '2010-10-05', '12:00:00', 560, 2, 4, 7, 187, 270, 194, 102, 0),
(19, 2, 47, '2010-10-06', '12:00:00', 262, 8, 8, 9, 269, 199, 195, 105, 1),
(20, 2, 48, '2015-03-02', '03:33:00', 132, 3, 1, 4, 255, 222, 174, 118, 1),
(20, 2, 49, '2005-05-05', '05:05:00', 374, 0, 9, 2, 187, 196, 110, 101, 0),
(20, 2, 50, '2015-03-11', '00:34:00', 175, 1, 4, 6, 135, 263, 154, 105, 0),
(20, 2, 51, '0222-02-22', '14:22:00', 253, 7, 8, 2, 192, 225, 174, 117, 1),
(11, 2, 53, '2010-11-06', '01:11:00', 641, 8, 7, 3, 214, 241, 181, 119, 1),
(11, 2, 54, '2015-12-03', '12:30:00', 542, 1, 2, 5, 288, 126, 185, 117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posko`
--

CREATE TABLE `posko` (
  `id_posko` int(11) NOT NULL,
  `id_bencana` int(11) NOT NULL,
  `nama_posko` varchar(50) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `lokasi_posko_dusun` varchar(50) NOT NULL,
  `lokasi_posko_kecamatan` varchar(50) NOT NULL,
  `lokasi_posko_kota` varchar(50) NOT NULL,
  `lokasi_posko_provinsi` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posko`
--

INSERT INTO `posko` (`id_posko`, `id_bencana`, `nama_posko`, `latitude`, `longitude`, `lokasi_posko_dusun`, `lokasi_posko_kecamatan`, `lokasi_posko_kota`, `lokasi_posko_provinsi`, `status`) VALUES
(1, 1, 'Barak Lumbungrejo', -7.80836, 110.271, 'Lumbungrejo', 'Tempel', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(2, 1, 'Balai Desa Glagaharjo', -7.8129, 110.251, 'Glagaharjo', 'Cangkringan', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(3, 2, 'Stadion Maguwoharjo', -7.74951, 110.419, 'Kembang', 'Depok', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(4, 2, 'Auditorium UPN', -7.76155, 110.409, 'Caturtunggal', 'Depok', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(5, 2, 'GOR UNY', -7.77692, 110.384, 'Caturtunggal', 'Depok', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(6, 2, 'SD Tlogoadi', -7.73403, 110.34, 'Tlogoadi', 'Mlati', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(7, 2, 'SD Pogungrejo', -7.75928, 110.372, 'Plambongan', 'Mlati', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(8, 2, 'Gelanggang Mahasiswa UGM', -7.77461, 110.377, 'Plambongan', 'Mlati', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(9, 2, 'Gereja Banteng', -7.74334, 110.39, 'Plambongan', 'Ngaglik', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(11, 20, 'Balai Desa Sumberrejo', -7.6749, 110.305, 'Sumberrejo', 'Tempel', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(12, 20, 'Balai Desa Banyurejo', -7.70334, 110.279, 'Banyurejo', 'Tempel', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(13, 20, 'SD IP Melangi', -7.77161, 110.324, 'Melangi', 'Gampling', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(14, 20, 'Balai Desa Pendowoharjo', -7.70078, 110.365, 'Pendowoharjo', 'Sleman', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(15, 20, 'Balai Desa Caturharjo', -7.68537, 110.327, 'Caturharjo', 'Sleman', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(16, 20, 'SMPN 1 Kalasan', -7.76663, 110.471, 'Kalasan', 'Sleman', 'Sleman', 'Daerah Istimewa Yogyakarta', 1),
(17, 18, 'Posko Harapan 1', 5.55941, 95.6311, 'aceh', '1', '1', '1', 1),
(18, 18, 'Posko Harapan 2', 5.19544, 95.6316, '-', '-', '-', '-', 1),
(19, 18, 'Posko Harapan 3', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(20, 18, 'Posko Harapan 4', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(21, 18, 'Posko Harapan 5', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(22, 18, 'Posko Harapan 6', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(23, 18, 'Posko Harapan 7', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(24, 18, 'Posko Harapan 8', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(25, 18, 'Posko Harapan 9', 5.2569, 95.3631, '-', '-', '-', '-', 1),
(27, 31, '1231', 9, 9, '9', '9', '9', '9', 1),
(29, 44, '', 0, 0, '', '', '', '', 0),
(30, 45, '', 0, 0, '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `keterangan`) VALUES
(1, 'petugas'),
(2, 'relawan'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `username`, `password`, `no_hp`, `nama_lengkap`, `status`) VALUES
(1, 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', '+-', 'Admin', 1),
(2, 1, 'ledo', '04d36dcb24f257bc084aee366e3d1df6', '+-', 'Doni Salim', 1),
(3, 2, 'wit', '26f6bd393df766642c4e6215573c6059', '+-', 'Wiratno', 0),
(4, 2, 'irvanerizal', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Irvan Erwan Rizal', 1),
(5, 1, 'tiara', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Tiara Laras', 1),
(6, 2, 'nanat', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Nana Tambayong', 1),
(7, 2, 'ulina', 'ccef8f5a62705f14f67cef66902e559c', '+-', 'Pricillia Ulina', 1),
(8, 2, 'aditbud', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Aditya Budiman', 1),
(9, 2, 'yudoo', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Euodia Yudo', 1),
(10, 2, 'tyomarius', '827ccb0eea8a706c4c34a16891f84e7b', '+-', 'Yohanes Marius', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bencana`
--
ALTER TABLE `bencana`
  ADD PRIMARY KEY (`id_bencana`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `laporan_posko`
--
ALTER TABLE `laporan_posko`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `posko`
--
ALTER TABLE `posko`
  ADD PRIMARY KEY (`id_posko`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bencana`
--
ALTER TABLE `bencana`
  MODIFY `id_bencana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `laporan_posko`
--
ALTER TABLE `laporan_posko`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `posko`
--
ALTER TABLE `posko`
  MODIFY `id_posko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
