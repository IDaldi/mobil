-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2020 at 09:40 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `213_konsumen`
--

CREATE TABLE `213_konsumen` (
  `id_konsumen` int(4) NOT NULL,
  `nama_konsumen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_konsumen`
--

INSERT INTO `213_konsumen` (`id_konsumen`, `nama_konsumen`) VALUES
(1, 'Ujang');

-- --------------------------------------------------------

--
-- Table structure for table `213_mekanik`
--

CREATE TABLE `213_mekanik` (
  `id_mekanik` int(5) UNSIGNED NOT NULL,
  `nama_mekanik` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_mekanik`
--

INSERT INTO `213_mekanik` (`id_mekanik`, `nama_mekanik`) VALUES
(1, 'Triwahyudi '),
(2, 'Emon semprani'),
(3, 'Ujang Bolon'),
(6, 'Aldi');

-- --------------------------------------------------------

--
-- Table structure for table `213_pembelian`
--

CREATE TABLE `213_pembelian` (
  `id_pembelian` int(5) NOT NULL,
  `id_mekanik` int(5) DEFAULT NULL,
  `id_sparepart` int(5) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `harga_jasa` varchar(10) DEFAULT NULL,
  `tgl_beli` date DEFAULT NULL,
  `NoPolisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_pembelian`
--

INSERT INTO `213_pembelian` (`id_pembelian`, `id_mekanik`, `id_sparepart`, `qty`, `harga_jasa`, `tgl_beli`, `NoPolisi`) VALUES
(35, 1, 4, 12, '5000', '2019-08-19', 'BM 1234 AN'),
(37, 4, 4, 1, '4000', '2019-08-21', 'BM 2346 DF'),
(38, 5, 14, 1, '5000', '2019-08-21', 'BM 345 AS'),
(39, 5, 4, 2, '5000', '2019-08-21', 'BM 345 AS'),
(40, 2, 10, 2, '10000', '2019-08-21', 'BM 345 AS'),
(41, 1, 7, 3, '5000', '2019-08-21', 'BM 2346 DF'),
(42, 1, 7, 1, '5000', '2019-08-21', 'BM 45 ASD'),
(43, 1, 7, 2, '6000', '2019-08-21', 'BM 7837 AH'),
(44, 6, 7, 1, '9000', '2019-08-21', 'BM 9077 HB'),
(45, 6, 7, 1, '9000', '2019-08-21', 'BM 9077 HB'),
(46, 6, 4, 7, '300', '2019-08-21', 'VB 78 KN'),
(47, 6, 4, 7, '300', '2019-08-21', 'VB 78 KN'),
(48, 6, 4, 7, '300', '2019-08-21', 'VB 78 KN'),
(49, 1, 10, 2, '5000', '2019-08-21', 'H 45 J'),
(50, 1, 10, 2, '5000', '2019-08-21', 'H 45 J'),
(51, 1, 10, 2, '5000', '2019-08-21', 'H 45 J'),
(52, 1, 10, 2, '5000', '2019-08-21', 'H 45 J'),
(53, 7, 7, 2, '4000', '2019-08-21', 'KS 34 J'),
(55, 7, 7, 2, '4000', '2019-08-21', 'KS 34 J'),
(56, 7, 7, 2, '4000', '2019-08-21', 'KS 34 J'),
(58, 6, 11, 1, '4000', '2019-08-21', 'BM 45 ASD'),
(60, 7, 15, 5, '5000', '2019-08-21', 'AL 14 DI'),
(65, 6, 28, 2, '6000', '2019-08-21', 'HK 89 J'),
(68, 6, 7, 2, '5000', '2019-08-21', 'KL890 H'),
(69, 1, 8, 2, '5000', '2019-08-21', 'BM 45 ASD'),
(71, 3, 4, 1, '5000', '2019-08-22', 'BM 2346 DF'),
(72, 1, 4, 2, '4000', '2019-09-24', 'bm 234 a');

--
-- Triggers `213_pembelian`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `213_pembelian` FOR EACH ROW BEGIN
UPDATE 213_sparepart SET stock=stock-NEW.qty
WHERE id_sparepart=NEW.id_sparepart;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `213_pengguna`
--

CREATE TABLE `213_pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama_pengguna` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_pengguna`
--

INSERT INTO `213_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`) VALUES
(1, 'Aldi', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(5, 'PEKANBARU', 'kasir', '59b8f19e2e140a1f7829b116219b6497');

-- --------------------------------------------------------

--
-- Table structure for table `213_sparepart`
--

CREATE TABLE `213_sparepart` (
  `id_sparepart` int(5) NOT NULL,
  `sparepart` varchar(50) DEFAULT NULL,
  `stock` varchar(5) DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_sparepart`
--

INSERT INTO `213_sparepart` (`id_sparepart`, `sparepart`, `stock`, `harga`) VALUES
(1, 'Filter Udara', '0', '32000'),
(2, 'Kampas Rem Depan', '0', '37000'),
(3, 'Kampas Rem Belakang', '0', '26000'),
(4, 'Rantai', '25', '65000'),
(5, 'Gir Depan', '0', '35000'),
(6, 'Gir belakang', '0', '63000'),
(7, 'Bohlam Depan', '5', '25000'),
(8, 'Bohlam Belakang', '16', '7500'),
(9, 'Kabel Gas', '20', '20000'),
(10, 'Kampas Kopling', '7', '148000'),
(11, 'Piston', '0', '38000'),
(12, 'Ring Piston', '5', '60000'),
(13, 'V-belt', '4', '43000'),
(14, 'CDI', '4', '340000'),
(15, 'Relay Starter', '-24', '40000'),
(16, 'Sokbreker Belakang', '6', '180000'),
(17, 'Kem', '5', '115000'),
(18, 'Oli Yamalube', '3', '35000'),
(19, 'Oli Top One', '5', '40000'),
(20, 'Oli Castroll', '5', '65000'),
(21, 'Oli Mesran', '5', '35000'),
(27, 'Spion', '6', '25000'),
(28, 'TALI', '48', '4000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `213_konsumen`
--
ALTER TABLE `213_konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `213_mekanik`
--
ALTER TABLE `213_mekanik`
  ADD PRIMARY KEY (`id_mekanik`);

--
-- Indexes for table `213_pembelian`
--
ALTER TABLE `213_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `213_pengguna`
--
ALTER TABLE `213_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `213_sparepart`
--
ALTER TABLE `213_sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `213_konsumen`
--
ALTER TABLE `213_konsumen`
  MODIFY `id_konsumen` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `213_mekanik`
--
ALTER TABLE `213_mekanik`
  MODIFY `id_mekanik` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `213_pembelian`
--
ALTER TABLE `213_pembelian`
  MODIFY `id_pembelian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `213_pengguna`
--
ALTER TABLE `213_pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `213_sparepart`
--
ALTER TABLE `213_sparepart`
  MODIFY `id_sparepart` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
