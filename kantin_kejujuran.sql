-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 05:30 AM
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
-- Database: `kantin_kejujuran`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `dibuat_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `email`, `role`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$z0A/rhHSF835MRUWy0VMFOT9jSKh7VF3/OOEHEvQg8OkcEbCMCfye', 'admin@admin.com', 'admin', NULL),
(2, 'user1', '$2y$10$B1lZmKTmzG2oeTWDRCHt2O53LjpbBKKH6Xg7/ccOaKvn7tia0Y3Y2', 'user1@user.com', 'user', NULL),
(3, 'user2', '$2y$10$AomDsZ5jOWGHl.4j7VWtQ.yTdD6RhUqJPWeQmUcRzRumky4VXDn7u', 'user2@user.com', 'user', '2025-06-07 08:41:04'),
(4, 'user3', '$2y$10$Q7A3cFO20DoQIlVu8VJMtu5OIxDy14mujHYpKUnO06vfWsh7N1x0q', 'user3@user.com', 'user', NULL),
(5, 'user4', '$2y$10$rm.XJ2tG58tODtM2U.1Mv.kzVwC8Fv8XXJeFJuacNjhsgRipQpSru', 'user4@user.com', 'user', NULL),
(6, 'user5', '$2y$10$R082xsvmQvCur7Ux15JUq.SAZn5AdMhoQ.MKlzlDzESnSEqrn4e6S', 'user5@user.com', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_akun`, `id_produk`, `jumlah`, `tanggal`) VALUES
(32, 4, 1, 1, '2025-06-17 05:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah_satuan_besar` int(11) NOT NULL,
  `isi` int(11) NOT NULL,
  `harga_satuan_besar` int(11) NOT NULL,
  `harga_eceran` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jumlah_satuan_besar`, `isi`, `harga_satuan_besar`, `harga_eceran`, `harga_jual`, `stok`, `gambar`) VALUES
(1, 'Mie Gelas BBQ', 2, 10, 10000, 1000, 1500, 18, 'migelas-baso-sapi.png'),
(4, 'Sukro Original', 5, 10, 10000, 1000, 1000, 4, 'sukro_original.png'),
(5, 'Mikako Rasa Bawang', 2, 10, 10000, 1000, 1000, 15, 'mikako_rasa_bawang.png'),
(14, 'Beng-beng', 2, 20, 45000, 2250, 2500, 25, 'beng-beng.png'),
(15, 'Susu Frisan Flag Kental Manis', 2, 10, 20000, 2000, 2500, 18, 'frisian flag kental manis.png'),
(16, 'Good Day Cappuccino', 2, 10, 20000, 2000, 2500, 20, 'good day cappuccino.png'),
(18, 'Milo', 1, 50, 200000, 4000, 5000, 27, 'Milo.png'),
(19, 'Aqua', 1, 25, 100000, 4000, 5000, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` enum('pending','selesai') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total`, `tanggal`, `status`) VALUES
(21, 2, 19500.00, '2025-06-14 16:37:25', 'selesai'),
(22, 2, 10000.00, '2025-06-15 09:49:19', 'selesai'),
(23, 2, 35000.00, '2025-06-15 10:34:50', 'selesai'),
(24, 2, 9000.00, '2025-06-15 10:35:30', 'selesai'),
(25, 2, 2500.00, '2025-06-15 10:35:45', 'selesai'),
(26, 2, 5000.00, '2025-06-15 10:36:01', 'selesai'),
(27, 2, 15000.00, '2025-06-16 10:04:12', 'selesai'),
(28, 2, 6000.00, '2025-06-16 10:04:28', 'selesai'),
(29, 4, 1500.00, '2025-06-17 03:15:07', 'selesai'),
(30, 4, 2500.00, '2025-06-17 03:15:28', 'selesai'),
(31, 4, 16000.00, '2025-06-17 03:16:05', 'selesai'),
(32, 4, 2500.00, '2025-06-17 03:17:43', 'selesai'),
(33, 4, 10000.00, '2025-06-17 03:17:55', 'selesai'),
(34, 4, 11000.00, '2025-06-17 05:29:13', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga`, `subtotal`) VALUES
(20, 21, 14, 1, 2500.00, 2500.00),
(21, 21, 18, 3, 5000.00, 15000.00),
(22, 21, 5, 2, 1000.00, 2000.00),
(23, 22, 14, 4, 2500.00, 10000.00),
(24, 23, 18, 7, 5000.00, 35000.00),
(25, 24, 1, 1, 1500.00, 1500.00),
(26, 24, 14, 1, 2500.00, 2500.00),
(27, 24, 18, 1, 5000.00, 5000.00),
(28, 25, 14, 1, 2500.00, 2500.00),
(29, 26, 14, 2, 2500.00, 5000.00),
(30, 27, 18, 3, 5000.00, 15000.00),
(31, 28, 14, 1, 2500.00, 2500.00),
(32, 28, 5, 1, 1000.00, 1000.00),
(33, 28, 15, 1, 2500.00, 2500.00),
(34, 29, 1, 1, 1500.00, 1500.00),
(35, 30, 14, 1, 2500.00, 2500.00),
(36, 31, 14, 2, 2500.00, 5000.00),
(37, 31, 18, 2, 5000.00, 10000.00),
(38, 31, 5, 1, 1000.00, 1000.00),
(39, 32, 14, 1, 2500.00, 2500.00),
(40, 33, 18, 2, 5000.00, 10000.00),
(41, 34, 5, 1, 1000.00, 1000.00),
(42, 34, 18, 1, 5000.00, 5000.00),
(43, 34, 14, 1, 2500.00, 2500.00),
(44, 34, 15, 1, 2500.00, 2500.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id_akun`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_4` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
