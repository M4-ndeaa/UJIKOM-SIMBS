-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 01:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `stok_buku` int(20) NOT NULL,
  `harga` int(30) NOT NULL,
  `tahun_terbit` int(20) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar_cover` varchar(20) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama`, `stok_buku`, `harga`, `tahun_terbit`, `penulis`, `tanggal_input`, `gambar_cover`, `kategori`) VALUES
(1, 'Aku Kalah Aku Merindukanmu!', 3, 79000, 2024, 'Coretan Lena', '2025-11-28 15:27:33', 'buku1.jpg', 'Roman'),
(2, 'Laskar Pelangi', 5, 99000, 2020, 'Andrea Hirata', '2025-11-28 15:53:46', 'buku2.jpg', 'Fiksi'),
(3, 'LAUT BERCERITA', 6, 150000, 2017, 'Leila S.Chudori', '2025-11-28 16:01:57', 'buku3.jpg', 'Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `katagori`
--

CREATE TABLE `katagori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `katagori`
--

INSERT INTO `katagori` (`id_kategori`, `nama_kategori`, `tanggal_input`) VALUES
(1, 'Fiksi', '2025-11-29 02:12:39'),
(2, 'Roman', '2025-11-29 02:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'manda', 'madaaja@gmail.com', '$2y$10$uJy7qQgGidAfl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `katagori`
--
ALTER TABLE `katagori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `katagori`
--
ALTER TABLE `katagori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
