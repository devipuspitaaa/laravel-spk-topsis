-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 02:49 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtopsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2018_02_24_191610_createTblDtlNil', 1),
(36, '2018_02_14_065727_createTblMotor', 2),
(37, '2018_02_14_065810_createTblKriteria', 2),
(38, '2018_02_15_035713_createTblLogin', 2),
(39, '2018_02_24_124324_createTblPenilaian', 2),
(40, '2018_02_24_194937_createTblnilkon', 2),
(45, '2018_02_25_061732_createTbBantu', 3),
(46, '2018_02_26_171622_createTblUserPilih', 4),
(47, '2018_05_01_103552_tblsaran', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblbantu`
--

CREATE TABLE `tblbantu` (
  `id` int(10) UNSIGNED NOT NULL,
  `penilaianId` int(11) DEFAULT NULL,
  `bnMesin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bnBody` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bnTahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bnHarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `positif` double NOT NULL DEFAULT '0',
  `negatif` double NOT NULL DEFAULT '0',
  `topsis` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblbantu`
--

INSERT INTO `tblbantu` (`id`, `penilaianId`, `bnMesin`, `bnBody`, `bnTahun`, `bnHarga`, `status`, `positif`, `negatif`, `topsis`) VALUES
(1, 31, '0.5773502691896258', '0.5773502691896258', '0.5773502691896257', '0.6225430174794672', 1, 0, 0, 0),
(2, 67, '0.5773502691896258', '0.5773502691896258', '0.5773502691896257', '0.5533715710928597', 1, 0, 0, 0),
(3, 70, '0.5773502691896258', '0.5773502691896258', '0.5773502691896257', '0.5533715710928597', 1, 0, 0, 0),
(4, 31, '0.23094010767585035', '0.17320508075688776', '0.057735026918962574', '0.12450860349589343', 2, 0, 0.013834289277321485, 1),
(5, 67, '0.23094010767585035', '0.17320508075688776', '0.057735026918962574', '0.11067431421857195', 2, 0.013834289277321485, 0, 0),
(6, 70, '0.23094010767585035', '0.17320508075688776', '0.057735026918962574', '0.11067431421857195', 2, 0.013834289277321485, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblkriteria`
--

CREATE TABLE `tblkriteria` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdKriteria` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmKriteria` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblkriteria`
--

INSERT INTO `tblkriteria` (`id`, `kdKriteria`, `nmKriteria`, `ket`, `bobot`) VALUES
(1, 'KR-001', 'Kondisi Mesin', 'Kondisi Mesin', 35),
(2, 'KR-002', 'Kondisi Body', 'Kondisi Body', 30),
(3, 'KR-003', 'Harga', 'Harga', 20),
(4, 'KR-004', 'Tahun Pemakain', 'Tahun pemakaian', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sandi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`id`, `nama`, `pengguna`, `sandi`, `akses`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblmotor`
--

CREATE TABLE `tblmotor` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdMotor` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jnsMotor` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merkMotor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thnMotor` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noMesin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblmotor`
--

INSERT INTO `tblmotor` (`id`, `kdMotor`, `jnsMotor`, `merkMotor`, `thnMotor`, `noMesin`, `foto`, `status`) VALUES
(12, 'MTR-0001', 'Manual', 'Honda Mega Pro Fi', '2017', NULL, 'MTR-0001Honda Mega Pro Fi.jpg', 2),
(13, 'MTR-0002', 'Manual', 'Kawasaki Ninja RR', '2016', NULL, 'MTR-0002Kawasaki Ninja RR.jpg', 2),
(14, 'MTR-0003', 'Matic', 'Yamaha NMAX ABS', '2017', NULL, 'MTR-0003Yamaha NMAX ABS.jpg', 2),
(15, 'MTR-0004', 'Manual', 'Yamaha Vixion Old', '2013', NULL, 'MTR-0004Yamaha Vixion Old.jpg', 2),
(16, 'MTR-0005', 'Matic', 'Yamaha Aerox', '2017', NULL, 'MTR-0005Yamaha Aerox.jpg', 2),
(17, 'MTR-0006', 'Manual', 'Honda CB150R Racing Red', '2017', NULL, 'MTR-0006Honda CBR 150 R Racing Red.jpg', 2),
(18, 'MTR-0007', 'Manual', 'Honda CBR150R MotoGP Edition', '2017', NULL, 'MTR-0007Honda CBR 150 R Moto GP Edition.jpg', 2),
(19, 'MTR-0008', 'Manual', 'Yamaha New Vixion Advance MotoGP', '2016', NULL, 'MTR-0008Yamaha Vixion Advance MotoGP.jpg', 2),
(20, 'MTR-0009', 'Manual', 'Honda Sonic 150 R', '2016', NULL, 'MTR-0009Honda Sonic 150 R.jpg', 2),
(21, 'MTR-0010', 'Matic', 'Honda PCX 150', '2016', NULL, 'MTR-0010Honda PCX 150.jpg', 2),
(22, 'MTR-0011', 'Manual', 'Honda Verza 150 CW', '2014', NULL, 'MTR-0011Honda Verza 150 CW.jpg', 2),
(23, 'MTR-0012', 'Manual', 'Honda Verza 150 SW', '2014', NULL, 'MTR-0012Honda Verza 150 SW.jpg', 2),
(24, 'MTR-0013', 'Manual', 'Yamaha Xabre', '2017', NULL, 'MTR-0013Yamaha Xabre.jpg', 2),
(25, 'MTR-0014', 'Manual', 'Yamaha New Vixion Advance', '2016', NULL, 'MTR-0014Yamaha New Vixion Advance.jpg', 2),
(26, 'MTR-0015', 'Manual', 'Yamaha All New Byson Fi', '2016', NULL, 'MTR-0015Yamaha All New Byson Fi.jpg', 2),
(27, 'MTR-0016', 'Manual', 'Yamaha R-15', '2014', NULL, 'MTR-0016Yamaha R-15.jpg', 2),
(28, 'MTR-0017', 'Manual', 'Kawasaki Ninja SS', '2016', NULL, 'MTR-0017Kawasaki Ninja SS.jpg', 2),
(29, 'MTR-0018', 'Manual', 'Kawasaki Ninja R SE', '2016', NULL, 'MTR-0018Kawasaki Ninja R SE.jpg', 2),
(30, 'MTR-0019', 'Manual', 'Suzuki Satria F 150 S', '2016', NULL, 'MTR-0019Suzuki Satria F150 S.jpg', 2),
(31, 'MTR-0020', 'Manual', 'Suzuki Satria F 150 R', '2016', NULL, 'MTR-0020Suzuki Satria F 150 R.jpg', 2),
(32, 'MTR-0021', 'Manual', 'Honda CB150R Streetfire Special Edition', '2017', NULL, 'MTR-0021steert fire special edition.jpg', 2),
(33, 'MTR-0022', 'Manual', 'Honda Sonic 150 R Repsol', '2016', NULL, 'MTR-0022Honda Sonic 150 R Repsol.jpg', 2),
(34, 'MTR-0023', 'Manual', 'Yamaha R-15 MotoGP', '2016', NULL, 'MTR-0023Yamaha R-15 MotoGP.jpg', 2),
(35, 'MTR-0024', 'Manual', 'Yamaha R-15 MotoGP Monster Tech 3', '2017', NULL, 'MTR-0024r-15  moster tech.jpg', 2),
(36, 'MTR-0025', 'Manual', 'Yamaha MX 150', '2016', NULL, 'MTR-0025mx 150.jpg', 2),
(37, 'MTR-0026', 'Manual', 'Yamaha MX King 150', '2017', NULL, 'MTR-0026mx king.jpg', 2),
(38, 'MTR-0027', 'Manual', 'Kawasaki Ninja RR Special Edition', '2015', NULL, 'MTR-0027kawaski rr special edition.jpg', 2),
(39, 'MTR-0028', 'Manual', 'Kawasaki Ninja R', '2013', NULL, 'MTR-0028ninja r.jpg', 2),
(40, 'MTR-0029', 'Manual', 'Suzuki Satria FU 150 Injeksi', '2017', NULL, 'MTR-0029satria Fu ijeksi.jpg', 2),
(41, 'MTR-0030', 'Matic', 'Yamaha NMAX Non ABS', '2017', NULL, 'MTR-0030n max non abs.jpg', 2),
(42, 'MTR-0031', 'Manual', 'Suzuki Satria F 150 SE', '2016', NULL, 'MTR-0031satria f se.jpg', 2),
(43, 'MTR-0032', 'Manual', 'Suzuki GSX S 150', '2016', NULL, 'MTR-0032gsx s.jpg', 2),
(44, 'MTR-0033', 'Manual', 'Honda CBR 150 R', '2016', NULL, 'MTR-0033Cbr R.jpg', 2),
(45, 'MTR-0034', 'Manual', 'Honda New Mega Pro', '2013', NULL, 'MTR-0034honda new mega pro.jpg', 2),
(46, 'MTR-0035', 'Manual', 'Honda Mega Pro CW', '2012', NULL, 'MTR-0035mega pro cw.jpg', 2),
(47, 'MTR-0036', 'Manual', 'Suzuki GSX R 150', '2016', NULL, 'MTR-0036gsx r.jpg', 2),
(49, 'MTR-0037', 'Manual', 'Honda CB150R Streetfire', '2016', NULL, 'MTR-0037Honda CB150R Streetfire Special Edition.jpg', 2),
(50, 'MTR-0038', 'Matic', 'Yamaha Aerox Movistar', '2017', NULL, 'MTR-0038movistar aerox.jpg', 2),
(51, 'MTR-0039', 'Manual', 'Yamaha MX King 150 Movistar Moto GP', '2016', NULL, 'MTR-0039mxking 150 movistar moto. gp.jpg', 2),
(52, 'MTR-0040', 'Matic', 'Honda PCX 150 ABS', '2016', NULL, 'MTR-0040pcx abs.jpg', 2),
(53, 'MTR-0041', 'Matic', 'Honda PCX 150 CBS', '2016', NULL, 'MTR-0041pcx cbs.jpg', 2),
(54, 'MTR-0042', 'Matic', 'Honda SH150 i', '2017', NULL, 'MTR-0042Sh150i honda.jpg', 2),
(55, 'MTR-0043', 'Matic', 'Honda Vario ESP Biasa', '2016', NULL, 'MTR-0043vario esp biasa.jpg', 2),
(56, 'MTR-0044', 'Matic', 'Honda Vario ESP', '2016', NULL, 'MTR-0044vario 150,esp.jpg', 2),
(57, 'MTR-0045', 'Matic', 'Honda Vario Sporty', '2016', NULL, 'MTR-0045vario sporty.jpg', 2),
(58, 'MTR-0046', 'Manual', 'Honda Supra GTR 150', '2017', NULL, 'MTR-0046supra 150 gtr exlusive.jpg', 2),
(59, 'MTR-0047', 'Manual', 'Suzuki GSX S150 Touring Edition', '2018', NULL, 'MTR-0047Spesifikasi-dan-Harga-Suzuki-GSX-S150-Touring-Edition-1-e1500118523119.jpg', 2),
(60, 'MTR-0048', 'Matic', 'Yamaha Aerox 150 R', '2017', NULL, 'MTR-0048aerox R.jpg', 2),
(61, 'MTR-0049', 'Matic', 'Yamaha Aerox 150 S', '2017', NULL, 'MTR-0049aerox s.jpg', 2),
(62, 'MTR-0050', 'Manual', 'kawasaki 2', '2000', NULL, 'MTR-0050Cbr R.jpg', 2),
(63, 'MTR-0051', 'Manual', 'kawasaki3', '2014', NULL, 'MTR-0051honda new mega pro.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblnilaikon`
--

CREATE TABLE `tblnilaikon` (
  `id` int(10) UNSIGNED NOT NULL,
  `penilaianId` int(10) UNSIGNED NOT NULL,
  `konMesinKon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konBodyKon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thnPakaiKon` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hargaKon` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblnilaikon`
--

INSERT INTO `tblnilaikon` (`id`, `penilaianId`, `konMesinKon`, `konBodyKon`, `thnPakaiKon`, `hargaKon`) VALUES
(12, 14, '90', '80', '85', 80),
(14, 16, '70', '70', '90', 80),
(16, 18, '70', '70', '90', 70),
(18, 20, '70', '70', '80', 85),
(19, 21, '80', '70', '80', 85),
(21, 23, '70', '70', '75', 85),
(22, 24, '70', '70', '85', 75),
(23, 25, '70', '70', '80', 80),
(24, 26, '80', '70', '80', 85),
(25, 27, '70', '80', '75', 80),
(27, 29, '70', '70', '85', 75),
(28, 30, '70', '70', '85', 85),
(29, 31, '70', '70', '85', 90),
(31, 33, '90', '80', '80', 85),
(32, 34, '80', '80', '85', 75),
(33, 35, '80', '90', '85', 75),
(34, 36, '80', '80', '85', 85),
(35, 37, '80', '80', '85', 90),
(36, 38, '80', '90', '80', 70),
(38, 40, '80', '90', '85', 85),
(40, 42, '80', '80', '80', 85),
(41, 43, '80', '80', '85', 85),
(42, 44, '80', '70', '85', 75),
(43, 45, '80', '80', '70', 90),
(44, 46, '80', '70', '70', 80),
(45, 47, '80', '80', '90', 80),
(46, 48, '70', '70', '65', 90),
(47, 49, '70', '90', '65', 90),
(48, 50, '80', '90', '85', 80),
(49, 51, '80', '80', '90', 80),
(50, 50, '90', '80', '85', 80),
(52, 54, '90', '80', '85', 80),
(53, 55, '90', '80', '90', 75),
(54, 56, '80', '70', '80', 85),
(55, 57, '80', '80', '80', 80),
(56, 58, '80', '70', '85', 80),
(57, 59, '70', '70', '90', 70),
(58, 60, '80', '80', '85', 90),
(59, 61, '80', '80', '85', 85),
(60, 62, '80', '80', '85', 80),
(61, 63, '90', '70', '90', 85),
(62, 64, '80', '90', '90', 75),
(64, 66, '80', '80', '90', 75),
(65, 67, '70', '70', '85', 80),
(66, 68, '80', '70', '90', 90),
(68, 70, '70', '70', '85', 80),
(69, 71, '80', '70', '80', 70),
(70, 72, '70', '80', '85', 70),
(71, 73, '70', '80', '80', 85),
(72, 74, '80', '70', '75', 85),
(73, 75, '70', '80', '85', 75),
(74, 76, '90', '80', '90', 80);

-- --------------------------------------------------------

--
-- Table structure for table `tblpenilaian`
--

CREATE TABLE `tblpenilaian` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdPenilaian` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motorId` int(10) UNSIGNED NOT NULL,
  `konMesin` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konBody` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thnPakai` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `nilTopsis` double NOT NULL DEFAULT '0',
  `nilTopsisUser` double NOT NULL DEFAULT '0',
  `hasilTopsis` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblpenilaian`
--

INSERT INTO `tblpenilaian` (`id`, `kdPenilaian`, `motorId`, `konMesin`, `konBody`, `thnPakai`, `harga`, `nilTopsis`, `nilTopsisUser`, `hasilTopsis`) VALUES
(14, 'PNL-00003', 14, 'Cukup Baik', 'Cukup Baik', '16', 20400000, 0.9077466462402565, 0, 0.09225335375974353),
(16, 'PNL-00005', 16, 'Cukup Baik', 'Cukup Baik', '9', 21600000, 0.8810223618599391, 0, 0.1189776381400609),
(18, 'PNL-00007', 18, 'Cukup Baik', 'Cukup Baik', '9', 27100000, 0.8191660505469401, 0, 0.18083394945305986),
(20, 'PNL-00009', 20, 'Cukup Baik', 'Cukup Baik', '24', 16350000, 0.8859093434401597, 0, 0.1140906565598403),
(21, 'PNL-00010', 21, 'Cukup Baik', 'Cukup Baik', '24', 17950000, 0.8990591080632715, 0, 0.1009408919367285),
(23, 'PNL-00012', 23, 'Cukup Baik', 'Cukup Baik', '37', 14550000, 0.8686667523731005, 0, 0.13133324762689946),
(24, 'PNL-00013', 24, 'Cukup Baik', 'Cukup Baik', '13', 23800000, 0.846495513100221, 0, 0.15350448689977902),
(25, 'PNL-00014', 25, 'Cukup Baik', 'Cukup Baik', '29', 18250000, 0.8648631692978133, 0, 0.13513683070218674),
(26, 'PNL-00015', 26, 'Baik', 'Cukup Baik', '24', 17650000, 0.8990591080632715, 0, 0.1009408919367285),
(27, 'PNL-00016', 27, 'Cukup Baik', 'Cukup Baik', '37', 19800000, 0.8597864512182624, 0, 0.14021354878173764),
(29, 'PNL-00018', 29, 'Cukup Baik', 'Cukup Baik', '13', 23400000, 0.846495513100221, 0, 0.15350448689977902),
(30, 'PNL-00019', 30, 'Cukup Baik', 'Cukup Baik', '16', 14950000, 0.8982778029195574, 0, 0.10172219708044261),
(31, 'PNL-00020', 31, 'Cukup Baik', 'Cukup Baik', '15', 13450000, 0.9085390007270983, 1, 0.09146099927290174),
(33, 'PNL-00022', 33, 'Sangat Baik', 'Baik', '24', 17950000, 0.9212585201679453, 0, 0.0787414798320547),
(34, 'PNL-00023', 34, 'Baik', 'Baik', '15', 22400000, 0.8670869962320779, 0, 0.13291300376792214),
(35, 'PNL-00024', 35, 'Baik', 'Sangat Baik', '13', 23400000, 0.8717800953215925, 0, 0.1282199046784075),
(36, 'PNL-00025', 36, 'Baik', 'Baik', '16', 14950000, 0.9321629748639783, 0, 0.06783702513602174),
(37, 'PNL-00026', 37, 'Baik', 'Baik', '15', 13450000, 0.9467099832015363, 0, 0.05329001679846368),
(38, 'PNL-00027', 38, 'Baik', 'Sangat Baik', '27', 26900000, 0.825962044417173, 0, 0.17403795558282698),
(40, 'PNL-00029', 40, 'Baik', 'Sangat Baik', '15', 17650000, 0.9403909037646851, 0, 0.05960909623531485),
(42, 'PNL-00031', 42, 'Baik', 'Baik', '24', 15325000, 0.9148771944529762, 0, 0.08512280554702378),
(43, 'PNL-00032', 43, 'Baik', 'Baik', '16', 17900000, 0.9321629748639783, 0, 0.06783702513602174),
(44, 'PNL-00033', 44, 'Baik', 'Cukup Baik', '17', 24500000, 0.8562972616304884, 0, 0.14370273836951164),
(45, 'PNL-00034', 45, 'Baik', 'Baik', '53', 11400000, 0.8781158678154443, 0, 0.12188413218455574),
(46, 'PNL-00035', 39, 'Baik', 'Cukup Baik', '49', 18600000, 0.8398018259433989, 0, 0.16019817405660108),
(47, 'PNL-00036', 41, 'Baik', 'Baik', '9', 19400000, 0.9078594221101134, 0, 0.09214057788988661),
(48, 'PNL-00037', 15, 'Cukup Baik', 'Cukup Baik', '64', 10800000, 0.8359477280741087, 0, 0.16405227192589134),
(49, 'PNL-00038', 46, 'Cukup Baik', 'Sangat Baik', '65', 10000000, 0.8484515913268617, 0, 0.15154840867313835),
(50, 'PNL-00039', 47, 'Baik', 'Sangat Baik', '16', 20900000, 0.9077466462402565, 0, 0.09225335375974353),
(51, 'PNL-00040', 32, 'Baik', 'Baik', '9', 21600000, 0.9078594221101134, 0, 0.09214057788988661),
(52, 'PNL-00041', 47, 'Sangat Baik', 'Baik', '16', 20600000, 0, 0, 1),
(54, 'PNL-00042', 49, 'Sangat Baik', 'Baik', '17', 20600000, 0.9077466462402565, 0, 0.09225335375974353),
(55, 'PNL-00043', 50, 'Sangat Baik', 'Baik', '10', 22700000, 0.8767644586812575, 0, 0.12323554131874248),
(56, 'PNL-00044', 51, 'Baik', 'Cukup Baik', '27', 14500000, 0.8990591080632715, 0, 0.1009408919367285),
(57, 'PNL-00045', 52, 'Baik', 'Baik', '28', 21300000, 0.888888888888889, 0, 0.11111111111111105),
(58, 'PNL-00046', 53, 'Baik', 'Cukup Baik', '22', 20500000, 0.8879546300056779, 0, 0.11204536999432213),
(59, 'PNL-00047', 54, 'Cukup Baik', 'Cukup Baik', '8', 26000000, 0.8191660505469401, 0, 0.18083394945305986),
(60, 'PNL-00048', 55, 'Baik', 'Baik', '19', 13300000, 0.9467099832015363, 0, 0.05329001679846368),
(61, 'PNL-00049', 56, 'Baik', 'Baik', '18', 17000000, 0.9321629748639783, 0, 0.06783702513602174),
(62, 'PNL-00050', 57, 'Baik', 'Baik', '19', 18500000, 0.9020675758921599, 0, 0.09793242410784009),
(63, 'PNL-00051', 58, 'Sangat Baik', 'Cukup Baik', '10', 15000000, 0.9256182717329446, 0, 0.07438172826705536),
(64, 'PNL-00052', 59, 'Baik', 'Sangat Baik', '2', 24500000, 0.8769001193879942, 0, 0.12309988061200583),
(66, 'PNL-00054', 61, 'Baik', 'Baik', '10', 23000000, 0.8722370717017355, 0, 0.12776292829826452),
(67, 'PNL-00055', 12, 'Cukup Baik', 'Cukup Baik', '13', 18700000, 0.8758399253162873, 0, 0.1241600746837127),
(68, 'PNL-00056', 62, 'Baik', 'Cukup Baik', '10', 10800000, 0.9310655628937035, 0, 0.06893443710629654),
(70, 'PNL-00057', 63, 'Cukup Baik', 'Cukup Baik', '15', 18700000, 0.8758399253162873, 0, 0.1241600746837127),
(71, 'PNL-00058', 13, 'Baik', 'Cukup Baik', '25', 26000000, 0.8131254957979617, 0, 0.18687450420203833),
(72, 'PNL-00059', 17, 'Cukup Baik', 'Baik', '13', 26500000, 0.8224182660042781, 0, 0.17758173399572186),
(73, 'PNL-00060', 19, 'Cukup Baik', 'Baik', '25', 17650000, 0.8994794265842869, 0, 0.10052057341571308),
(74, 'PNL-00061', 22, 'Baik', 'Cukup Baik', '38', 14200000, 0.8799248794791301, 0, 0.12007512052086988),
(75, 'PNL-00062', 28, 'Cukup Baik', 'Baik', '15', 22400000, 0.8565989215573149, 0, 0.14340107844268513),
(76, 'PNL-00063', 60, 'Sangat Baik', 'Baik', '11', 20300000, 0.9136822807425345, 0, 0.08631771925746545);

-- --------------------------------------------------------

--
-- Table structure for table `tblpiluser`
--

CREATE TABLE `tblpiluser` (
  `id` int(10) UNSIGNED NOT NULL,
  `nmUser` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `pilUser` text COLLATE utf8mb4_unicode_ci,
  `penilaianId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblpiluser`
--

INSERT INTO `tblpiluser` (`id`, `nmUser`, `tgl`, `pilUser`, `penilaianId`) VALUES
(1, 'adadad', '2018-05-12', 'Manual. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. 12 Bulan. 15000000', 14),
(2, 'sdsdsd', '2018-05-12', 'Manual. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. 12 Bulan. 15000000', 14),
(3, 'adada', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 15000000', 14),
(4, 'Khairul Fajeri anwar', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 14),
(5, 'ijul', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 14),
(6, 'Muhammad', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 14),
(7, 'cxcc', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(8, 'cxcc', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 32),
(9, 'cxcc', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 14),
(10, 'dss', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Baik\',\'Cukup Baik\'. 10 Bulan. 10000000', 14),
(11, 'dss', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Baik\',\'Cukup Baik\'. 20 Bulan. 10000000', 24),
(12, 'dss', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Baik\',\'Cukup Baik\'. 20 Bulan. 10000000', 24),
(13, 'adada', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(14, 'adada', '2018-05-12', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 20 Bulan. 10000000', 15),
(15, 'ssdd', '2018-05-12', 'Matic. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. 1 Bulan. 10000000', 14),
(16, 'Khairul Fajeri anwar', '2018-05-15', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(17, 'Khairul Fajeri anwar', '2018-05-15', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(18, 'Khairul Fajeri anwar', '2018-05-15', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 11000000', 24),
(19, 'Khairul Fajeri anwar', '2018-05-15', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 10000000', 24),
(20, 'Khairul Fajeri anwar', '2018-05-20', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(21, 'Khairul Fajeri anwar', '2018-05-24', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 10000000', 24),
(22, 'Khairul Fajeri anwar', '2018-05-24', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 15000000', 24),
(23, 'Khairul Fajeri anwar', '2018-05-24', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 13 Bulan. 15000000', 24),
(24, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Baik\'. \'Baik\'. 9 Bulan. 11000000', 37),
(25, 'iwan', '2018-05-25', 'Manual. \'Baik\'. \'Baik\'. 12 Bulan. 12000000', 37),
(26, 'khairul', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 13),
(27, 'khairul', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18700000', 13),
(28, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Baik\'. \'Cukup Baik\'. 9 Bulan. 15000000', 44),
(29, 'fajri', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 13),
(30, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(31, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(32, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(33, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(34, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(35, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 70),
(36, 'Khairul Fajeri anwar', '2018-05-25', 'Manual. \'Baik\'. \'Cukup Baik\'. 9 Bulan. 18000000', 44),
(37, 'Khairul Fajeri anwar', '2018-05-26', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 13),
(38, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 13),
(39, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 15 Bulan. 18500000', 27),
(40, 'Khairul Fajeri anwar', '2018-05-27', 'Matic. \'Baik\'. \'Baik\'. 9 Bulan. 20000000', 65),
(41, 'Khairul Fajeri anwar', '2018-05-27', 'Matic. \'Baik\'. \'Baik\'. 9 Bulan. 20000000', 65),
(42, 'fajri', '2018-05-27', 'Matic. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 17500000', 14),
(43, 'Khairul Fajeri anwar', '2018-05-27', 'Matic. \'Baik\'. \'Baik\'. 9 Bulan. 13000000', 60),
(44, 'Khairul Fajeri anwar', '2018-05-27', 'Matic. \'Baik\'. \'Baik\'. 9 Bulan. 13000000', 60),
(45, 'Khairul Fajeri anwar', '2018-05-27', 'Matic. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. \'Sangat Baik\',\'Baik\',\'Cukup Baik\'. 9 Bulan. 13000000', 76),
(46, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(47, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(48, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(49, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(50, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(51, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(52, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(53, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 10000000', 24),
(54, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 26),
(55, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 26),
(56, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 26),
(57, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 20),
(58, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 24),
(59, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 24),
(60, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 15000000', 24),
(61, 'z', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 8 Bulan. 10000000', 24),
(62, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 8 Bulan. 20000000', 24),
(63, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 8 Bulan. 20000000', 24),
(64, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 8 Bulan. 20000000', 24),
(65, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(66, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(67, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(68, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(69, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(70, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 9 Bulan. 20000000', 24),
(71, 'fajri', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 10000000', 31),
(72, 'fajri', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 10000000', 31),
(73, 'fajri', '2018-05-27', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 10000000', 31),
(74, 'Khairul Fajeri anwar', '2018-05-27', 'Manual. \'Baik\'. \'Baik\'. 11 Bulan. 11000000', 37),
(75, 'fajri', '2018-05-27', 'Manual. \'Baik\'. \'Baik\'. 15 Bulan. 15000000', 43),
(76, 'raji anwar', '2018-05-27', 'Manual. \'Baik\'. \'Baik\'. 13 Bulan. 11000000', 37),
(77, 'raji anwar', '2018-05-27', 'Manual. \'Baik\'. \'Sangat Baik\'. 15 Bulan. 20000000', 50),
(78, 'Khairul Fajeri anwar', '2018-05-29', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 15000000', 31),
(79, 'Khairul Fajeri anwar', '2018-05-29', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 17 Bulan. 15000000', 31),
(80, 'fajri', '2018-05-29', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 15000000', 31),
(81, 'fajri', '2018-05-29', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 15000000', 31),
(82, 'Khairul Fajeri anwar', '2018-06-02', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 12 Bulan. 10000000', 31),
(83, 'alimudin', '2018-06-25', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 13 Bulan. 11000000', 31),
(84, 'pa udin', '2018-06-26', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 11000000', 31),
(85, 'Khairul Fajeri anwar', '2018-06-26', 'Manual. \'Cukup Baik\'. \'Cukup Baik\'. 10 Bulan. 11000000', 31);

-- --------------------------------------------------------

--
-- Table structure for table `tblsaran`
--

CREATE TABLE `tblsaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbantu`
--
ALTER TABLE `tblbantu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblkriteria`
--
ALTER TABLE `tblkriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllogin`
--
ALTER TABLE `tbllogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmotor`
--
ALTER TABLE `tblmotor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnilaikon`
--
ALTER TABLE `tblnilaikon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblnilaikon_penilaianid_foreign` (`penilaianId`);

--
-- Indexes for table `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpenilaian_motorid_foreign` (`motorId`);

--
-- Indexes for table `tblpiluser`
--
ALTER TABLE `tblpiluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsaran`
--
ALTER TABLE `tblsaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tblbantu`
--
ALTER TABLE `tblbantu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblkriteria`
--
ALTER TABLE `tblkriteria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbllogin`
--
ALTER TABLE `tbllogin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblmotor`
--
ALTER TABLE `tblmotor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tblnilaikon`
--
ALTER TABLE `tblnilaikon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tblpiluser`
--
ALTER TABLE `tblpiluser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tblsaran`
--
ALTER TABLE `tblsaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblnilaikon`
--
ALTER TABLE `tblnilaikon`
  ADD CONSTRAINT `tblnilaikon_penilaianid_foreign` FOREIGN KEY (`penilaianId`) REFERENCES `tblpenilaian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpenilaian`
--
ALTER TABLE `tblpenilaian`
  ADD CONSTRAINT `tblpenilaian_motorid_foreign` FOREIGN KEY (`motorId`) REFERENCES `tblmotor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
