-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 05:03 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mds`
--

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `idStok` int(11) NOT NULL,
  `idStokMasuk` int(11) NOT NULL,
  `tglMasuk` date NOT NULL,
  `tglKeluar` date NOT NULL,
  `kodeObat` varchar(100) NOT NULL,
  `namaObat` varchar(100) NOT NULL,
  `jenisObat` varchar(100) NOT NULL,
  `stokKeluar` int(11) NOT NULL,
  `tglKadaluwarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`idStok`, `idStokMasuk`, `tglMasuk`, `tglKeluar`, `kodeObat`, `namaObat`, `jenisObat`, `stokKeluar`, `tglKadaluwarsa`) VALUES
(1, 62, '2023-11-15', '2023-11-15', 'PCL001', 'Paracetamol', 'Obat Bebas', 20, '2026-11-11'),
(2, 65, '2023-11-15', '2023-11-15', 'NPZ810', 'Naphazoline', 'Obat Bebas Terbatas', 20, '2025-06-19'),
(3, 62, '2023-11-15', '2023-11-15', 'PCL001', 'Paracetamol', 'Obat Bebas', 50, '2023-11-15'),
(4, 64, '2023-11-15', '2023-11-15', 'ACT821', 'Acetylcysteine', 'Obat Bebas Terbatas', 5, '2023-11-16'),
(6, 63, '2023-11-20', '2023-11-16', 'BCT023', 'Bacitracin', 'Obat Bebas Terbatas', 17, '2023-11-21'),
(9, 68, '2023-11-16', '2023-11-16', 'BCT023', 'Bacitracin', 'Obat Bebas Terbatas', 7, '2023-11-21'),
(10, 71, '2023-11-16', '2023-11-16', 'PCL002', 'Paracetamol', 'Obat Bebas', 29, '2023-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `idStok` int(11) NOT NULL,
  `kodeObat` varchar(100) NOT NULL,
  `namaObat` varchar(100) NOT NULL,
  `tanggalMasuk` date NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggalKadaluwarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`idStok`, `kodeObat`, `namaObat`, `tanggalMasuk`, `jenis`, `stok`, `tanggalKadaluwarsa`) VALUES
(62, 'PCL001', 'Paracetamol', '2021-06-15', 'Obat Bebas', 50, '2023-11-15'),
(63, 'BCT023', 'Bacitracin', '2023-11-20', 'Obat Bebas Terbatas', 50, '2023-11-21'),
(64, 'ACT821', 'Acetylcysteine', '2023-11-15', 'Obat Bebas Terbatas', 30, '2023-11-16'),
(67, 'TMD812', 'Tramadol', '2023-11-16', 'Obat Bebas Terbatas', 32, '2024-05-19'),
(69, 'PCL001', 'Paracetamol', '2023-11-16', 'Obat Bebas', 35, '2025-06-16'),
(70, 'PCL001', 'Paracetamol', '2023-11-16', 'Obat Bebas', 20, '2023-11-15');

--
-- Triggers `stok_masuk`
--
DELIMITER $$
CREATE TRIGGER `pindah_stok_keluar` AFTER DELETE ON `stok_masuk` FOR EACH ROW INSERT INTO stok_keluar (idStokMasuk, tglMasuk, tglKeluar, kodeObat, namaObat, jenisObat, stokKeluar, tglKadaluwarsa) VALUES (OLD.idStok, OLD.tanggalMasuk, CURRENT_DATE(), OLD.kodeObat, OLD.namaObat, OLD.jenis, OLD.stok, OLD.tanggalKadaluwarsa)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `level`) VALUES
(14, 'apoteker', 'apoteker', 1),
(15, 'kepala', 'kepala', 2),
(16, 'superadmin', 'superadmin', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`idStok`),
  ADD KEY `idStokMasuk` (`idStokMasuk`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`idStok`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `idStok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `idStok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
