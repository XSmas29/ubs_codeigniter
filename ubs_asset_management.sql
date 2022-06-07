-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2022 pada 15.59
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

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
-- Struktur dari tabel `asset`
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `KODE_ASSET` varchar(50) NOT NULL,
  `FK_KATEGORI` int(11) NOT NULL,
  `NAMA_ASSET` varchar(50) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0 COMMENT '0 = tersedia, 1 = sedang dipinjam',
  `FK_USER` varchar(50) DEFAULT NULL,
  `INFO_1` varchar(50) DEFAULT NULL,
  `INFO_2` varchar(50) DEFAULT NULL,
  `INFO_3` varchar(50) DEFAULT NULL,
  `INFO_4` varchar(50) DEFAULT NULL,
  `INFO_5` varchar(50) DEFAULT NULL,
  `INFO_6` varchar(50) DEFAULT NULL,
  `INFO_7` varchar(50) DEFAULT NULL,
  `INFO_8` varchar(50) DEFAULT NULL,
  `INFO_9` varchar(50) DEFAULT NULL,
  `TGL_PENGADAAN` date NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0 COMMENT '0 = not deleted, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asset`
--

INSERT INTO `asset` (`KODE_ASSET`, `FK_KATEGORI`, `NAMA_ASSET`, `STATUS`, `FK_USER`, `INFO_1`, `INFO_2`, `INFO_3`, `INFO_4`, `INFO_5`, `INFO_6`, `INFO_7`, `INFO_8`, `INFO_9`, `TGL_PENGADAAN`, `IS_DELETED`) VALUES
('01/03/2019/A/UBS/001/1/15', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 15', '15', '6', '5', NULL, NULL, NULL, NULL, NULL, '2019-03-01', 0),
('01/03/2022/K/UBS/002', 3, 'Honda Vario 125', 0, NULL, 'Material', 'bergerak', 'bekas', 'Motor', 'L 3845 GD', 'MH21896433', NULL, NULL, NULL, '2019-03-01', 0),
('02/03/2022/A/UBS/001/1/16', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 16', '16', '5', '0', NULL, NULL, NULL, NULL, NULL, '2019-03-02', 0),
('02/04/2022/R/UBS/008', 1, 'rumah dinas 10 X 20', 0, NULL, 'jalan baru no 2', 'tetap', 'masih baru', '10', '20', 'ada', NULL, NULL, NULL, '2022-04-02', 0),
('03/04/2022/A/UBS/001/1/12', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 12', '12', '2', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/2', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 2', '2', '3', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/3', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 3', '3', '4', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/4', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 4', '4', '4', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/5', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 5', '5', '2', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/6', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 6', '6', '1', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/7', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 7', '7', '2', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/1/8', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 8', '8', '7', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('03/04/2022/A/UBS/001/2/1', 4, 'Glory Lama', 0, NULL, 'Lt. 2 No. 1', '1', '6', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-03', 0),
('04/04/2022/F/UBS/003', 5, 'Kipas Angin', 0, NULL, 'jalan coba update', 'bergerak', 'masih baru', 'sampai tahun 2035', NULL, NULL, NULL, NULL, NULL, '2022-04-04', 0),
('04/04/2022/R/UBS/009', 1, 'rumah baru', 0, NULL, 'jalan baru', 'tetap', 'masih baru', '3', '2', 'ada', NULL, NULL, NULL, '2022-04-04', 1),
('06/04/2022/G/UBS/003', 2, 'Gedung A Lt. 2', 0, NULL, 'Office', 'tetap', 'Marketing Lokal', 'Gedung A', '6640/IMB/E/2021', NULL, NULL, NULL, NULL, '2022-04-06', 0),
('06/04/2022/K/UBS/003', 3, 'Mobil baru', 0, NULL, 'office baru', 'bergerak', 'masih baru', 'Mobil', 'L 1000 FK', '0981237', '2026-10-06', '2027-10-16', 'ini BPKB', '2022-04-06', 0),
('08/09/2022/F/UBS/001', 5, 'LCD Proyektor LG', 1, '000002', 'R.Meeting Anggrek', 'tetap', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-08', 0),
('10/09/2022/F/UBS/002', 5, 'Epson Scanner', 0, NULL, 'Office HRD', 'tetap', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-10', 1),
('13/04/2022/R/UBS/010', 1, 'coba update', 0, NULL, 'jalan coba update', 'tetap', 'masih baru', '3', '3', 'ada', NULL, NULL, NULL, '2022-04-13', 1),
('15/04/2022/A/UBS/002/1/1', 4, 'Glory Baru', 0, NULL, 'Lt. 1 No. 4', '1', '3', '0', NULL, NULL, NULL, NULL, NULL, '2022-04-15', 0),
('19/03/2022/G/UBS/001', 2, 'Gedung C Lt. 1', 0, NULL, 'Material', 'tetap', 'Bahan', 'Gedung C', '5385/IMB/E/2019', NULL, NULL, NULL, NULL, '2020-04-09', 0),
('19/03/2022/R/UBS/001', 1, 'Rumah Dinas 8 x 12', 1, '000001', 'Lebak Jaya 2 No 20', 'tetap', 'baik', '4', '2', 'ada', NULL, NULL, NULL, '2022-02-03', 0),
('19/03/2022/R/UBS/002', 1, 'Rumah Dinas 8 x 15', 0, NULL, 'Lebak Timur No 20', 'tetap', 'baik', '5', '3', 'tidak ada', NULL, NULL, NULL, '2022-01-22', 0),
('19/03/2022/R/UBS/003', 1, 'Rumah Dinas 6 x 10', 0, NULL, 'Anggur no 1A', 'tetap', 'baik', '3', '2', 'ada', NULL, NULL, NULL, '2022-02-03', 0),
('19/03/2022/R/UBS/004', 1, 'Rumah Dinas 6 x 12', 0, NULL, 'Belimbing no 2B', 'tetap', 'baik', '2', '2', 'tidak ada', NULL, NULL, NULL, '2022-03-03', 0),
('19/03/2022/R/UBS/005', 1, 'Rumah Dinas 8 x 10', 0, NULL, 'Ceri no 3C', 'tetap', 'baik', '3', '2', 'ada', NULL, NULL, NULL, '2022-01-03', 0),
('19/03/2022/R/UBS/006', 1, 'Rumah Dinas 12 x 10', 1, '000001', 'Delima no 4D', 'tetap', 'baik', '5', '4', 'ada', NULL, NULL, NULL, '2022-02-04', 0),
('19/03/2022/R/UBS/007', 1, 'Rumah Dinas 9 x 10 update', 0, NULL, 'Edamame no 5E update', 'tetap', 'baik update', '3 update', '2 update', 'tidak ada', NULL, NULL, NULL, '2022-02-03', 1),
('20/05/2022/R/UBS/012', 1, 'rumah demo update', 0, NULL, 'jalan update', 'tetap', 'baru', '3', '3', 'ada', NULL, NULL, NULL, '2022-05-20', 1),
('20/05/2022/R/UBS/013', 1, 'abc', 0, NULL, 'abc', 'tetap', 'masih baru', '1', '1', 'ada', NULL, NULL, NULL, '2022-05-20', 0),
('21/02/2022/K/UBS/001', 3, 'Toyota Alphard', 1, '000004', 'Office HRD', 'bergerak', 'baru', 'Mobil', 'L 1504 NC', 'MH12347813', NULL, NULL, NULL, '2022-02-21', 0),
('21/05/2022/G/UBS/005', 2, 'a', 0, NULL, 'a', 'tetap', 'a', 'A', 'a', NULL, NULL, NULL, NULL, '2022-05-21', 0),
('22/01/2022/G/UBS/002', 2, 'Gedung A Lt. 1', 0, NULL, 'Office', 'tetap', 'Marketing Lokal', 'Gedung A', '6640/IMB/E/2021', NULL, NULL, NULL, NULL, '2021-08-17', 0),
('28/04/2022/A/UBS/003/1/1', 4, 'A', 0, NULL, 'Lt. 1 No. 1', '1', '6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-28', 0),
('28/04/2022/F/UBS/004', 5, 'Kamera Nikon', 0, NULL, 'Office', 'bergerak', 'bekas', 'sampai 2023', NULL, NULL, NULL, NULL, NULL, '2022-04-28', 0),
('28/04/2022/G/UBS/004', 2, 'Gedung A Lt. 3', 0, NULL, 'Office', 'tetap', 'Kantor', 'Gedung A', '9572/IMB/E/2017', NULL, NULL, NULL, NULL, '2022-04-28', 0),
('28/04/2022/K/UBS/004', 3, 'Yamaha Fazzio', 1, '000001', 'Office HRD', 'bergerak', 'Baru', 'Motor', 'L 2424 BD', '2HXK4USHF', '2023-06-28', '2024-06-08', '123123', '2022-04-28', 0),
('28/04/2022/R/UBS/011', 1, 'Rumah Dinas 20 x 20', 0, NULL, 'jalan semangka no 20', 'tetap', 'baru', '5', '5', 'ada', NULL, NULL, NULL, '2022-04-28', 0),
('28/05/2022/A/UBS/001/1/20', 4, 'Glory Lama', 0, NULL, 'Lt. 1 No. 20', '20', '10', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-28', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `KODE_FASILITAS` int(11) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `JUMLAH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`KODE_FASILITAS`, `FK_ASSET`, `NAMA`, `JUMLAH`) VALUES
(22, '19/03/2022/R/UBS/007', 'fasilitas 5', 5),
(23, '19/03/2022/R/UBS/007', 'fasilitas 3', 3),
(24, '19/03/2022/R/UBS/007', 'fasilitas 1', 1),
(51, '19/03/2022/R/UBS/001', 'mesin cuci', 1),
(52, '19/03/2022/R/UBS/001', 'pompa air', 2),
(53, '19/03/2022/R/UBS/004', 'air conditioner', 3),
(54, '19/03/2022/R/UBS/004', 'bath tub', 2),
(57, '02/04/2022/R/UBS/008', 'air conditioner', 10),
(58, '02/04/2022/R/UBS/008', 'water heater', 20),
(59, '03/04/2022/A/UBS/001/1/3', 'kasur', 4),
(60, '03/04/2022/A/UBS/001/2/1', 'kasur', 6),
(61, '03/04/2022/A/UBS/001/1/4', 'kipas angin', 1),
(69, '01/03/2019/A/UBS/001/1/15', 'Ranjang Susun', 3),
(70, '01/03/2019/A/UBS/001/1/15', 'Ranjang Susun', 3),
(77, '13/04/2022/R/UBS/010', 'fasilitas 1', 1),
(78, '13/04/2022/R/UBS/010', 'fasilitas 2', 2),
(79, '04/04/2022/R/UBS/009', 'fasilitas 2', 2),
(80, '04/04/2022/R/UBS/009', 'fasilitas 1', 2),
(83, '28/04/2022/R/UBS/011', 'Kolam Renang', 1),
(84, '28/04/2022/R/UBS/011', 'AC', 5),
(85, '28/04/2022/R/UBS/011', 'Bath Tub', 5),
(88, '28/04/2022/G/UBS/004', 'AC', 3),
(89, '28/04/2022/G/UBS/004', 'Projector', 2),
(92, '20/05/2022/R/UBS/012', 'demo 1', 1),
(93, '20/05/2022/R/UBS/012', 'demo 2', 2),
(95, '20/05/2022/R/UBS/013', 'a', 1),
(106, '21/05/2022/G/UBS/005', 'a', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar` (
  `KODE_GAMBAR` varchar(50) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`KODE_GAMBAR`, `FK_ASSET`) VALUES
('FASILITAS003_004.jpg', '04/04/2022/F/UBS/003'),
('FASILITAS004_001.jpg', '28/04/2022/F/UBS/004'),
('KENDARAAN003_001.jpg', '06/04/2022/K/UBS/003'),
('KENDARAAN003_002.jpeg', '06/04/2022/K/UBS/003'),
('KENDARAAN004_001.jpg', '28/04/2022/K/UBS/004'),
('RUMAH006_001.png', '19/03/2022/R/UBS/006'),
('RUMAH006_002.png', '19/03/2022/R/UBS/006'),
('RUMAH006_003.png', '19/03/2022/R/UBS/006'),
('RUMAH008_001.jpg', '02/04/2022/R/UBS/008'),
('RUMAH008_002.jpg', '02/04/2022/R/UBS/008'),
('RUMAH009_001.jpg', '04/04/2022/R/UBS/009'),
('RUMAH009_002.PNG', '04/04/2022/R/UBS/009'),
('RUMAH009_003.jpg', '04/04/2022/R/UBS/009'),
('RUMAH010_002.png', '13/04/2022/R/UBS/010'),
('RUMAH010_003.png', '13/04/2022/R/UBS/010'),
('RUMAH011_001.jpg', '28/04/2022/R/UBS/011'),
('RUMAH011_002.jpg', '28/04/2022/R/UBS/011'),
('RUMAH012_001.jpg', '20/05/2022/R/UBS/012'),
('RUMAH013_001.jpg', '20/05/2022/R/UBS/013'),
('TRANS_0000009.png', 'TRANS_0000009'),
('TRANS_0000023.PNG', 'TRANS_0000023'),
('TRANS_0000026.PNG', 'TRANS_0000026'),
('TRANS_0000028.PNG', 'TRANS_0000028'),
('TRANS_0000034.png', 'TRANS_0000034'),
('TRANS_0000035.jpg', 'TRANS_0000035'),
('TRANS_0000044.PNG', 'TRANS_0000044'),
('TRANS_0000047.png', 'TRANS_0000047'),
('TRANS_0000049.pdf', 'TRANS_0000049'),
('TRANS_0000050.jpg', 'TRANS_0000050'),
('TRANS_0000052.', 'TRANS_0000052'),
('TRANS_0000066.pdf', 'TRANS_0000066'),
('TRANS_0000080.pdf', 'TRANS_0000080'),
('TRANS_0000087.pdf', 'TRANS_0000087');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `KODE_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`KODE_KATEGORI`, `NAMA_KATEGORI`) VALUES
(1, 'Rumah Dinas'),
(2, 'Gedung'),
(3, 'Kendaraan'),
(4, 'Asrama'),
(5, 'Fasilitas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `KODE_TRANSAKSI` varchar(15) NOT NULL,
  `FK_ASSET` varchar(50) NOT NULL,
  `TGL_TRANSAKSI` date NOT NULL,
  `USER_TRANSAKSI` varchar(50) NOT NULL,
  `AKTIVITAS_TRANSAKSI` varchar(50) NOT NULL,
  `KETERANGAN_1` varchar(1000) DEFAULT NULL,
  `KETERANGAN_2` varchar(255) DEFAULT NULL,
  `KETERANGAN_3` varchar(255) DEFAULT NULL,
  `KETERANGAN_4` varchar(255) DEFAULT NULL,
  `TGL_PINJAM` date DEFAULT NULL,
  `TGL_KEMBALI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`KODE_TRANSAKSI`, `FK_ASSET`, `TGL_TRANSAKSI`, `USER_TRANSAKSI`, `AKTIVITAS_TRANSAKSI`, `KETERANGAN_1`, `KETERANGAN_2`, `KETERANGAN_3`, `KETERANGAN_4`, `TGL_PINJAM`, `TGL_KEMBALI`) VALUES
('TRANS_0000001', '19/03/2022/R/UBS/001', '2022-03-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan rumah dinas 001', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000002', '19/03/2022/R/UBS/006', '2022-02-04', 'SYSTEM ADMIN', 'perubahan', 'perubahan data rumah dinas 006', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000003', '6640/IMB/e/2021', '2022-02-16', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan gedung A lt. 1', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000004', '01/03/2022/A/UBS/001/1/15', '2022-03-08', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama glory lama lantai 1 nomor 15', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000005', '21/02/2022/K/UBS/001', '2022-03-29', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan mobil toyota alphard', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000006', '10/09/2022/F/UBS/002', '2022-03-28', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan epson scanner', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000007', '02/04/2022/R/UBS/008', '2022-04-02', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan rumah dinas 008', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000008', '19/03/2022/R/UBS/006', '2022-04-02', 'SYSTEM ADMIN', 'perubahan', 'perubahan data rumah dinas 006', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000009', '02/04/2022/R/UBS/008', '2022-04-02', 'SYSTEM ADMIN', 'perbaikan', 'rumah barunya rusak', 'rusak total', 'memperbaiki kerusakan', 'ini RAB', NULL, NULL),
('TRANS_0000010', '19/03/2022/R/UBS/007', '2022-04-02', 'SYSTEM ADMIN', 'penghapusan', 'rumah ini dijual', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000011', '03/04/2022/A/UBS/001/1/15', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 15', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000012', '03/04/2022/A/UBS/001/1/12', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 12', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000013', '03/04/2022/A/UBS/001/1/2', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 2', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000014', '03/04/2022/A/UBS/001/1/3', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 3', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000015', '03/04/2022/A/UBS/001/2/1', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 2 kamar no 1', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000016', '03/04/2022/A/UBS/001/1/4', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 4', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000017', '03/04/2022/A/UBS/001/1/5', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 5', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000018', '03/04/2022/A/UBS/001/1/6', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 6', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000019', '03/04/2022/A/UBS/001/1/7', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 7', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000020', '03/04/2022/A/UBS/001/1/8', '2022-04-03', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 8', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000021', '01/03/2019/A/UBS/001/1/15', '2019-03-01', 'SYSTEM ADMIN', 'pengadaan', 'perubahan asrama Glory Lama lantai 1 kamar no 15', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000022', '01/03/2019/A/UBS/001/1/15', '2019-03-01', 'SYSTEM ADMIN', 'pengadaan', 'perubahan asrama Glory Lama lantai 1 kamar no 15', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000023', '01/03/2019/A/UBS/001/1/15', '2022-04-04', 'SYSTEM ADMIN', 'perbaikan', 'a', 'a', 'a', 'a', NULL, NULL),
('TRANS_0000024', '04/04/2022/R/UBS/009', '2022-04-04', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan rumah dinas 009', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000025', '04/04/2022/R/UBS/009', '2022-04-04', 'SYSTEM ADMIN', 'perubahan', 'perubahan data rumah dinas 009', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000026', '01/03/2019/A/UBS/001/1/15', '2022-04-04', 'SYSTEM ADMIN', 'perbaikan', 'kasur nya rusak', 'rusak', 'membeli kasur baru', 'ini RAB', NULL, NULL),
('TRANS_0000027', '10/09/2022/F/UBS/002', '2022-04-04', 'SYSTEM ADMIN', 'penghapusan', 'rusak', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000028', '08/09/2022/F/UBS/001', '2022-04-04', 'SYSTEM ADMIN', 'perbaikan', 'tidak sengaja jatuh', 'rusak', 'di service tukang', 'ini RAB', NULL, NULL),
('TRANS_0000029', '04/04/2022/F/UBS/003', '2022-04-04', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000030', '04/04/2022/F/UBS/003', '2022-04-04', 'SYSTEM ADMIN', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000031', '04/04/2022/F/UBS/003', '2022-04-04', 'SYSTEM ADMIN', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000032', '06/04/2022/G/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan gedung 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000033', '06/04/2022/G/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan gedung 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000034', '06/04/2022/G/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perbaikan', 'bangunannya kena tsunami', 'hancur', 'membangun ulang', '1000000', NULL, NULL),
('TRANS_0000035', '01/03/2022/K/UBS/002', '2022-04-06', 'SYSTEM ADMIN', 'perbaikan', 'spionnya disenggol orang', 'spion nya bengkok', 'membetulkan spion di bengkel', '100000', NULL, NULL),
('TRANS_0000036', '06/04/2022/K/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan kendaraan 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000037', '06/04/2022/K/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data kendaraan 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000038', '06/04/2022/K/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data kendaraan 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000039', '06/04/2022/K/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data kendaraan 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000040', '06/04/2022/K/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data kendaraan 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000041', '04/04/2022/F/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000042', '04/04/2022/F/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000043', '04/04/2022/F/UBS/003', '2022-04-06', 'SYSTEM ADMIN', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000044', '06/04/2022/G/UBS/003', '2022-04-07', 'SYSTEM ADMIN', 'perbaikan', 'gedung terkena tornado', 'rubuh', 'membangun ulang', 'EK0001', NULL, NULL),
('TRANS_0000045', '13/04/2022/R/UBS/010', '2022-04-13', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan rumah dinas 010', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000046', '13/04/2022/R/UBS/010', '2022-04-13', 'SYSTEM ADMIN', 'perubahan', 'perubahan data rumah dinas 010', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000047', '13/04/2022/R/UBS/010', '2022-04-13', 'SYSTEM ADMIN', 'perbaikan', 'terkena banjir', 'rusak', 'memperbaiki kerusakan', '10000', NULL, NULL),
('TRANS_0000048', '13/04/2022/R/UBS/010', '2022-04-13', 'SYSTEM ADMIN', 'penghapusan', 'rumahnya dijual', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000049', '01/03/2019/A/UBS/001/1/15', '2022-04-14', 'SYSTEM ADMIN', 'perbaikan', 'c', 'c', 'c', 'c', NULL, NULL),
('TRANS_0000050', '01/03/2019/A/UBS/001/1/15', '2022-04-14', 'SYSTEM ADMIN', 'perbaikan', 'a', 'a', 'a', 'a', NULL, NULL),
('TRANS_0000051', '15/04/2022/A/UBS/002/1/1', '2022-04-15', 'SYSTEM ADMIN', 'pengadaan', 'pengadaan asrama Glory Baru lantai 1 kamar no 1', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000052', '04/04/2022/R/UBS/009', '2022-04-28', 'SYSTEM ADMIN', 'perubahan', 'perubahan data rumah dinas 009', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000053', '19/03/2022/R/UBS/006', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000053.pdf', NULL, '2022-04-07', '2022-04-28'),
('TRANS_0000054', '06/04/2022/G/UBS/003', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000054.pdf', NULL, '2022-04-06', '2022-04-28'),
('TRANS_0000055', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000055.pdf', NULL, '2022-04-14', '2022-05-12'),
('TRANS_0000056', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000002', '000002', 'PINJAM_0000056.pdf', NULL, '2022-04-06', NULL),
('TRANS_0000057', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000003', '000003', 'PINJAM_0000057.pdf', NULL, '2022-03-31', '2022-04-28'),
('TRANS_0000058', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000004', '000004', 'PINJAM_0000058.pdf', NULL, '2022-04-02', NULL),
('TRANS_0000059', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000005', '000005', 'PINJAM_0000059.pdf', NULL, '2022-04-07', NULL),
('TRANS_0000060', '01/03/2019/A/UBS/001/1/15', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000006', '000006', 'PINJAM_0000060.pdf', NULL, '2022-04-08', NULL),
('TRANS_0000061', '19/03/2022/R/UBS/006', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000002', '000002', 'PINJAM_0000061.pdf', NULL, '2022-04-06', '2022-04-28'),
('TRANS_0000062', '21/02/2022/K/UBS/001', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000004', '000004', 'PINJAM_0000062.pdf', NULL, '2022-04-16', NULL),
('TRANS_0000063', '08/09/2022/F/UBS/001', '2022-04-28', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000002', '000002', 'PINJAM_0000063.pdf', NULL, '2022-03-31', NULL),
('TRANS_0000064', '28/04/2022/R/UBS/011', '2022-04-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan rumah dinas 011', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000065', '28/04/2022/R/UBS/011', '2022-04-28', 'Surya Bumantara2', 'perubahan', 'perubahan data rumah dinas 011', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000066', '28/04/2022/R/UBS/011', '2022-04-28', 'Surya Bumantara2', 'perbaikan', 'AC nya tidak dingin', 'masih berfungsi, tapi tidak dingin', 'memperbaiki', '1111', NULL, NULL),
('TRANS_0000067', '04/04/2022/R/UBS/009', '2022-04-28', 'Surya Bumantara2', 'penghapusan', 'dijual', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000068', '28/04/2022/A/UBS/003/1/1', '2022-04-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan asrama A lantai 1 kamar no 1', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000069', '28/04/2022/A/UBS/003/1/1', '2022-04-28', 'Surya Bumantara2', 'perubahan', 'perubahan asrama A lantai 1 kamar no 1', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000070', '28/04/2022/F/UBS/004', '2022-04-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan fasilitas 004', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000071', '04/04/2022/F/UBS/003', '2022-04-28', 'Surya Bumantara2', 'perubahan', 'perubahan data fasilitas 003', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000072', '28/04/2022/G/UBS/004', '2022-04-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan gedung 004', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000073', '28/04/2022/G/UBS/004', '2022-04-28', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 004', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000074', '28/04/2022/K/UBS/004', '2022-04-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan kendaraan 004', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000075', '28/04/2022/K/UBS/004', '2022-04-28', 'Surya Bumantara2', 'perubahan', 'perubahan data kendaraan 004', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000076', '28/04/2022/K/UBS/004', '2022-05-12', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000076.pdf', NULL, '2022-05-05', NULL),
('TRANS_0000077', '03/04/2022/A/UBS/001/1/2', '2022-05-12', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000077.pdf', NULL, '2022-05-11', '2022-05-20'),
('TRANS_0000078', '20/05/2022/R/UBS/012', '2022-05-20', 'Surya Bumantara2', 'pengadaan', 'pengadaan rumah dinas 012', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000079', '20/05/2022/R/UBS/012', '2022-05-20', 'Surya Bumantara2', 'perubahan', 'perubahan data rumah dinas 012', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000080', '20/05/2022/R/UBS/012', '2022-05-20', 'Surya Bumantara2', 'perbaikan', 'rumah nya terkena tornado', 'rusak total', 'pembangunan ulang', '0001', NULL, NULL),
('TRANS_0000081', '20/05/2022/R/UBS/012', '2022-05-20', 'Surya Bumantara2', 'penghapusan', 'rumahnya dijual', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000082', '19/03/2022/R/UBS/006', '2022-05-20', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000082.pdf', NULL, '2022-05-12', NULL),
('TRANS_0000083', '01/03/2019/A/UBS/001/1/15', '2022-05-20', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000083.pdf', NULL, '2022-05-06', NULL),
('TRANS_0000084', '19/03/2022/R/UBS/001', '2022-05-20', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000084.pdf', NULL, '2022-05-11', '2022-05-20'),
('TRANS_0000085', '20/05/2022/R/UBS/013', '2022-05-20', 'Surya Bumantara2', 'pengadaan', 'pengadaan rumah dinas 013', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000086', '20/05/2022/R/UBS/013', '2022-05-20', 'Surya Bumantara2', 'perubahan', 'perubahan data rumah dinas 013', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000087', '20/05/2022/R/UBS/013', '2022-05-20', 'Surya Bumantara2', 'perbaikan', 'rusak', 'rusak', 'memperbaiki kerusakan', '0001', NULL, NULL),
('TRANS_0000088', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'pengadaan', 'pengadaan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000089', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000090', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000091', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000092', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000093', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000094', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000095', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000096', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000097', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000098', '21/05/2022/G/UBS/005', '2022-05-21', 'Surya Bumantara2', 'perubahan', 'perubahan gedung 005', NULL, NULL, NULL, NULL, NULL),
('TRANS_0000099', '19/03/2022/R/UBS/001', '2022-05-23', 'Surya Bumantara2', 'peminjaman', 'serah terima aset ke user 000001', '000001', 'PINJAM_0000099.pdf', NULL, '2022-05-19', NULL),
('TRANS_0000100', '28/05/2022/A/UBS/001/1/20', '2022-05-28', 'Surya Bumantara2', 'pengadaan', 'pengadaan asrama Glory Lama lantai 1 kamar no 20', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `NIK` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `FK_ASSET` varchar(50) DEFAULT NULL,
  `NAMA` varchar(50) NOT NULL,
  `DEPARTEMEN` varchar(50) NOT NULL,
  `AKSES_RUMAH` int(1) NOT NULL,
  `AKSES_GEDUNG` int(1) NOT NULL,
  `AKSES_KENDARAAN` int(1) NOT NULL,
  `AKSES_ASRAMA` int(1) NOT NULL,
  `AKSES_FASILITAS` int(1) NOT NULL,
  `AKSES_USER` int(1) NOT NULL,
  `AKSES_LAPORAN` int(1) NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`NIK`, `PASSWORD`, `FK_ASSET`, `NAMA`, `DEPARTEMEN`, `AKSES_RUMAH`, `AKSES_GEDUNG`, `AKSES_KENDARAAN`, `AKSES_ASRAMA`, `AKSES_FASILITAS`, `AKSES_USER`, `AKSES_LAPORAN`, `IS_DELETED`) VALUES
('000001', 'suryasurya', '01/03/2019/A/UBS/001/1/15', 'Surya Bumantara2', 'FCK', 3, 3, 3, 3, 3, 1, 1, 0),
('000002', 'edseledsel', '01/03/2019/A/UBS/001/1/15', 'Edsel Hans Wijaya', 'Hollow', 3, 3, 0, 3, 0, 0, 0, 0),
('000003', 'budibudi', NULL, 'Budi', 'HRD', 0, 2, 0, 0, 0, 0, 0, 0),
('000004', 'antonanton', '01/03/2019/A/UBS/001/1/15', 'Anton', 'HRD', 1, 0, 3, 2, 1, 0, 1, 0),
('000005', 'michaelmichael', '01/03/2019/A/UBS/001/1/15', 'Michael', 'Media', 1, 1, 1, 1, 1, 1, 1, 0),
('000006', 'hanshans', '01/03/2019/A/UBS/001/1/15', 'Hans', 'Marketing', 3, 0, 3, 0, 3, 0, 0, 0),
('000007', 'firmanfirman', NULL, 'Firman', 'Marketing', 0, 0, 0, 0, 0, 0, 0, 0),
('000008', 'userbaru', NULL, 'userbaruupdate', 'BARU', 3, 3, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`KODE_ASSET`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`KODE_FASILITAS`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`KODE_GAMBAR`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KODE_KATEGORI`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `KODE_FASILITAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KODE_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
