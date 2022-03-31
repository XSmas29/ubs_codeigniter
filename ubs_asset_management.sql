-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 05:31 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubs_asset_management`
--
CREATE DATABASE IF NOT EXISTS `ubs_asset_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ubs_asset_management`;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `KODE_ASSET` varchar(50) NOT NULL,
  `FK_KATEGORI` int(11) NOT NULL,
  `NAMA_ASSET` varchar(50) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0 COMMENT '0 = tersedia, 1 = sedang dipinjam',
  `INFO_1` varchar(50) DEFAULT NULL,
  `INFO_2` varchar(50) DEFAULT NULL,
  `INFO_3` varchar(50) DEFAULT NULL,
  `INFO_4` varchar(50) DEFAULT NULL,
  `INFO_5` varchar(50) DEFAULT NULL,
  `INFO_6` varchar(50) DEFAULT NULL,
  `INFO_7` varchar(50) DEFAULT NULL,
  `TGL_PENGADAAN` date NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0 COMMENT '0 = not deleted, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`KODE_ASSET`, `FK_KATEGORI`, `NAMA_ASSET`, `STATUS`, `INFO_1`, `INFO_2`, `INFO_3`, `INFO_4`, `INFO_5`, `INFO_6`, `INFO_7`, `TGL_PENGADAAN`, `IS_DELETED`) VALUES
('01/03/2022/A/UBS/001/1/15', 4, 'Glory Lama', 0, '1', '15', '6', '0', NULL, NULL, NULL, '2019-03-01', 0),
('01/03/2022/K/UBS/002', 3, 'Honda Vario 125', 0, 'F 3089 QK', 'Motor', NULL, NULL, NULL, NULL, NULL, '2019-03-01', 0),
('02/03/2022/A/UBS/002/1/16', 4, 'Glory Lama', 0, '1', '16', '5', '0', NULL, NULL, NULL, '2019-03-02', 0),
('08/09/2022/F/UBS/001', 5, 'LCD Proyektor LG', 0, 'R.Meeting Anggrek', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-08', 0),
('10/09/2022/F/UBS/002', 5, 'Epson Scanner', 0, 'Office HRD', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-10', 0),
('19/03/2022/R/UBS/001', 1, 'Rumah Dinas 8 x 12', 0, 'Lebak Jaya 2 No 20', 'tetap', 'baik', '4', '2', 'ada', NULL, '2022-02-03', 0),
('19/03/2022/R/UBS/002', 1, 'Rumah Dinas 8 x 15', 0, 'Lebak Timur No 20', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-22', 0),
('19/03/2022/R/UBS/003', 1, 'Rumah Dinas 6 x 10', 0, 'Anggur no 1A', 'tetap', 'baik', '1', '2', 'ada', NULL, '2022-02-03', 0),
('19/03/2022/R/UBS/004', 1, 'Rumah Dinas 6 x 12', 0, 'Belimbing no 2B', 'tetap', 'baik', '2', '2', 'ada', NULL, '2022-03-03', 0),
('19/03/2022/R/UBS/005', 1, 'Rumah Dinas 8 x 10', 0, 'Ceri no 3C', 'tetap', 'baik', '3', '2', 'ada', NULL, '2022-01-03', 0),
('19/03/2022/R/UBS/006', 1, 'Rumah Dinas 12 x 8', 0, 'Delima no 4D', 'tetap', 'baik', '4', '3', 'ada', NULL, '2022-02-04', 0),
('19/03/2022/R/UBS/007', 1, 'Rumah Dinas 9 x 10', 0, 'Edamame no 5E', 'tetap', 'baik', '3', '2', 'ada', NULL, '2022-02-03', 0),
('21/02/2022/K/UBS/001', 3, 'Toyota Alphard', 0, 'L 1054 BA', 'Mobil', NULL, NULL, NULL, NULL, NULL, '2022-02-21', 0),
('5385/IMB/e/2019', 2, 'Gedung C Lt. 1', 1, 'Material', 'Bahan', NULL, NULL, NULL, NULL, NULL, '2020-04-09', 0),
('6640/IMB/e/2021', 2, 'Gedung A Lt. 1', 1, 'Office', 'Marketing Lokal', NULL, NULL, NULL, NULL, NULL, '2021-08-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `KODE_FASILITAS` int(11) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `JUMLAH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`KODE_FASILITAS`, `FK_ASSET`, `NAMA`, `JUMLAH`) VALUES
(1, '19/03/2022/R/UBS/001', 'pompa air', 1),
(2, '01/03/2022/A/UBS/001/1/15', 'Ranjang Susun', 3);

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar` (
  `KODE_GAMBAR` varchar(50) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`KODE_GAMBAR`, `FK_ASSET`) VALUES
('RUMAH001_001.jpg', '19/03/2022/R/UBS/001'),
('RUMAH001_002.jpg', '19/03/2022/R/UBS/001'),
('RUMAH001_003.jpg', '19/03/2022/R/UBS/001');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `KODE_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`KODE_KATEGORI`, `NAMA_KATEGORI`) VALUES
(1, 'Rumah Dinas'),
(2, 'Gedung'),
(3, 'Kendaraan'),
(4, 'Asrama'),
(5, 'Fasilitas');

-- --------------------------------------------------------

--
-- Table structure for table `meminjam`
--

DROP TABLE IF EXISTS `meminjam`;
CREATE TABLE `meminjam` (
  `KODE_ASSET` varchar(50) NOT NULL,
  `NIK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL,
  `TGL_TRANSAKSI` date NOT NULL,
  `USER_TRANSAKSI` varchar(50) NOT NULL,
  `AKTIVITAS_TRANSAKSI` varchar(50) NOT NULL,
  `KETERANGAN_TRANSAKSI` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`KODE_TRANSAKSI`, `FK_ASSET`, `TGL_TRANSAKSI`, `USER_TRANSAKSI`, `AKTIVITAS_TRANSAKSI`, `KETERANGAN_TRANSAKSI`) VALUES
(1, '19/03/2022/R/UBS/001', '2022-03-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan rumah dinas 001'),
(4, '6640/IMB/e/2021', '2022-02-16', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan gedung A lt. 1'),
(5, '01/03/2022/A/UBS/001/1/15', '2022-03-08', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama glory lama lantai 1 nomor 15'),
(6, '21/02/2022/K/UBS/001', '2022-03-29', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan mobil toyota alphard'),
(7, '10/09/2022/F/UBS/002', '2022-03-28', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan epson scanner');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `NIK` varchar(50) NOT NULL,
  `FK_ASSET` varchar(50) DEFAULT NULL,
  `NAMA` varchar(50) NOT NULL,
  `DEPARTEMEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NIK`, `FK_ASSET`, `NAMA`, `DEPARTEMEN`) VALUES
('000001', '01/03/2022/A/UBS/001/1/15', 'Surya Bumantara', 'FC'),
('000002', '01/03/2022/A/UBS/001/1/15', 'Edsel Hans Wijaya', 'Hollow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`KODE_ASSET`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`KODE_FASILITAS`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`KODE_GAMBAR`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KODE_KATEGORI`);

--
-- Indexes for table `meminjam`
--
ALTER TABLE `meminjam`
  ADD PRIMARY KEY (`KODE_ASSET`,`NIK`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `KODE_FASILITAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KODE_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `KODE_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
