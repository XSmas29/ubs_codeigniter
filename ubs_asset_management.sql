-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 11:19 AM
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
  `KODE_FASILITAS` varchar(50) NOT NULL,
  `KODE_KATEGORI` varchar(50) NOT NULL,
  `NAMA_ASSET` varchar(50) NOT NULL,
  `LOKASI_1` varchar(50) DEFAULT NULL,
  `LOKASI_2` varchar(50) DEFAULT NULL,
  `LOKASI_3` varchar(50) DEFAULT NULL,
  `LOKASI_4` varchar(50) DEFAULT NULL,
  `UKURAN` varchar(50) DEFAULT NULL,
  `TGL_BELI` date NOT NULL,
  `NO_DOC` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `KODE_FASILITAS` varchar(50) NOT NULL,
  `KODE_ASSET` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `JUMLAH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar` (
  `KODE_GAMBAR` varchar(50) NOT NULL,
  `KODE_ASSET` varchar(50) NOT NULL,
  `GAMBAR` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `KODE_KATEGORI` varchar(50) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `NIK` varchar(50) NOT NULL,
  `KODE_ASSET` varchar(50) DEFAULT NULL,
  `NAMA` varchar(50) NOT NULL,
  `DEPARTEMEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`KODE_ASSET`),
  ADD KEY `TERDIRI_FK` (`KODE_KATEGORI`),
  ADD KEY `MEMILIKI_FK` (`KODE_FASILITAS`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`KODE_FASILITAS`),
  ADD KEY `KODE_ASSET` (`KODE_ASSET`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`KODE_GAMBAR`),
  ADD KEY `DIMILIKI_FK` (`KODE_ASSET`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KODE_KATEGORI`);

--
-- Indexes for table `meminjam`
--
ALTER TABLE `meminjam`
  ADD PRIMARY KEY (`KODE_ASSET`,`NIK`),
  ADD KEY `MEMINJAM_FK` (`KODE_ASSET`),
  ADD KEY `MEMINJAM2_FK` (`NIK`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIK`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `FK_ASSET_MEMILIKI_FASILITA` FOREIGN KEY (`KODE_FASILITAS`) REFERENCES `fasilitas` (`KODE_FASILITAS`),
  ADD CONSTRAINT `FK_ASSET_TERDIRI_KATEGORI` FOREIGN KEY (`KODE_KATEGORI`) REFERENCES `kategori` (`KODE_KATEGORI`);

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`KODE_ASSET`) REFERENCES `asset` (`KODE_ASSET`);

--
-- Constraints for table `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `FK_GAMBAR_DIMILIKI_ASSET` FOREIGN KEY (`KODE_ASSET`) REFERENCES `asset` (`KODE_ASSET`);

--
-- Constraints for table `meminjam`
--
ALTER TABLE `meminjam`
  ADD CONSTRAINT `FK_MEMINJAM_MEMINJAM_ASSET` FOREIGN KEY (`KODE_ASSET`) REFERENCES `asset` (`KODE_ASSET`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
