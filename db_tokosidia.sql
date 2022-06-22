-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2021 at 01:05 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokosidia`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jumlah`, `harga`) VALUES
(10, 'Yuupy', 300, 4000),
(11, 'Gulali', 200, 5000),
(12, 'Lolipop Beruang', 330, 5500),
(13, 'Sirup madu', 2000, 6000),
(14, 'Keramik 212', 1000, 100000),
(15, 'Cat NoDrop', 1500, 200000),
(16, 'Semen Enam Roda', 3000, 80000),
(17, 'Pancake Tap', 100, 15000),
(18, 'Rolling Cake', 150, 22000),
(19, 'Kue Cucur', 90, 1000),
(20, 'Nike Top', 3, 250000),
(21, 'Puma 125n', 1, 330000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_toko`
--

CREATE TABLE `barang_toko` (
  `id_barang` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_toko`
--

INSERT INTO `barang_toko` (`id_barang`, `id_toko`) VALUES
(10, 7),
(11, 7),
(12, 7),
(13, 7),
(14, 8),
(15, 8),
(16, 8),
(17, 9),
(18, 9),
(19, 9),
(20, 10),
(21, 10);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_toko` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `id_user`, `nama_toko`, `deskripsi`) VALUES
(7, 11, 'Yummy', 'Menjual berbagai macam manisan'),
(8, 12, 'Jaya Abadi', 'Menjual berbagai macam kebutuhan bangunan'),
(9, 13, 'Bakery Kue', 'Kue kering, kue basah kue barat dan lain-lain ada disini'),
(10, 15, 'Smr.Shoes', 'Lapak sepatu bekas yang ori.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(10, 'juli', '$2y$10$716pmu2SkQDvn8GSX8CuC.5R9kDmZ24UFO163rNzDRE0lT80uBlwC', 'admin'),
(11, 'jennie', '$2y$10$UaY70X8wHyXvLqntzLcKbuwwQMidYNyL.v96YBGyXNzlWJFrVOg/6', 'seller'),
(12, 'tinnie', '$2y$10$hpvF6xTyn1uiOXUQhKVXJOjkwzC0lncIS9rZEtv22KWsKzPf.HJOa', 'seller'),
(13, 'jacki', '$2y$10$BerZO0yNgmRQwABTsXULd.4/j.psXGCkUjIOw/XkTpwn98gl8n.tK', 'seller'),
(14, 'jennierubyjane', '$2y$10$BKIuTo43AChGrshXvcf5qO6ZZsli2LR41XSg6mXIc3kXLOaww3TXG', 'user'),
(15, 'sepatushoes', '$2y$10$9nr1FbKtW6IRBjJlPBFTU.HrlBlikoCBJgBTuSaBAmxmbNB8jk9Q6', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_toko`
--
ALTER TABLE `barang_toko`
  ADD KEY `barang_toko_ibfk_1` (`id_barang`),
  ADD KEY `barang_toko_ibfk_2` (`id_toko`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_toko`
--
ALTER TABLE `barang_toko`
  ADD CONSTRAINT `barang_toko_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_toko_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
