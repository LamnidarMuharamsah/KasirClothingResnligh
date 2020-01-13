-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 04:36 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resnlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(5) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` varchar(100) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_kategori`, `stok`, `harga_beli`, `harga_jual`, `date_added`) VALUES
('B0001', 'galaxy t-shirt', 3, 16, '50000', '80000', '2018-08-08 10:01:20'),
('B0002', 'Celana Jeans RS', 15, 16, '50000', '90000', '2018-08-08 10:34:56'),
('B0003', 'jaket dilan', 16, 17, '100000', '200000', '2018-08-08 10:01:29'),
('B0004', 'topi dilan', 17, 12, '50000', '60000', '2018-08-09 10:14:56'),
('B0005', 'baju tetew', 3, 12, '50000', '60000', '2018-08-09 10:15:29'),
('B0006', 'celana tetew', 15, 15, '70000', '85000', '2018-08-09 10:15:56'),
('B0007', 'jam galaxy', 4, 14, '90000', '100000', '2018-08-09 10:16:24'),
('B0008', 'Sepatu Resnlight', 2, 5, '120000', '150000', '2018-08-09 10:16:58'),
('B0009', 'Sepatu Tetew', 2, 15, '100000', '150000', '2018-08-09 10:17:27'),
('B0010', 'jaket gratis', 16, 14, '100000', '140000', '2018-08-09 10:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Sepatu'),
(3, 'Pakaian'),
(4, 'Jam Tangan'),
(11, 'Tas'),
(15, 'Celana'),
(16, 'Jaket'),
(17, 'Topi');

-- --------------------------------------------------------

--
-- Table structure for table `sub_transaksi`
--

CREATE TABLE `sub_transaksi` (
  `id_subtransaksi` int(11) NOT NULL,
  `id_barang` char(6) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `bayar` double NOT NULL,
  `diskon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_transaksi`
--

INSERT INTO `sub_transaksi` (`id_subtransaksi`, `id_barang`, `id_transaksi`, `jumlah_beli`, `total_harga`, `no_invoice`, `bayar`, `diskon`) VALUES
(77, 'B0003', 53, 1, '200000', '08/AF/2/18/11/58/34', 350000, 10),
(78, 'B0002', 53, 1, '90000', '08/AF/2/18/11/58/34', 350000, 10),
(79, 'B0001', 53, 1, '80000', '08/AF/2/18/11/58/34', 350000, 10),
(80, 'B0002', 54, 1, '90000', '08/AF/2/18/11/59/09', 65000, 30),
(81, 'B0001', 55, 1, '80000', '08/AF/2/18/11/59/46', 80000, 0),
(82, 'B0003', 56, 1, '200000', '08/AF/2/18/12/00/58', 150000, 30),
(83, 'B0001', 57, 2, '160000', '08/AF/2/18/12/02/09', 400000, 0),
(84, 'B0003', 57, 1, '200000', '08/AF/2/18/12/02/09', 400000, 0),
(85, 'B0002', 58, 1, '90000', '08/AF/2/18/12/04/34', 85000, 10),
(86, 'B0002', 59, 1, '90000', '08/AF/2/18/12/35/27', 82000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tempo`
--

CREATE TABLE `tempo` (
  `id_subtransaksi` int(11) NOT NULL,
  `id_barang` char(6) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `trx` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kode_kasir` int(11) NOT NULL,
  `total_bayar` varchar(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `nama_pembeli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `kode_kasir`, `total_bayar`, `no_invoice`, `nama_pembeli`) VALUES
(53, '2018-07-08 09:58:34', 2, '333000', '08/AF/2/18/11/58/34', 'NIDAR'),
(54, '2018-07-08 09:59:09', 2, '63000', '08/AF/2/18/11/59/09', 'DONI'),
(55, '2018-08-08 09:59:46', 2, '80000', '08/AF/2/18/11/59/46', 'TIO'),
(56, '2018-08-08 10:00:58', 2, '140000', '08/AF/2/18/12/00/58', 'JOKO'),
(57, '2018-08-08 10:02:09', 2, '360000', '08/AF/2/18/12/02/09', 'AULIA'),
(58, '2018-08-08 10:04:34', 2, '81000', '08/AF/2/18/12/04/34', 'NARUTO'),
(59, '2018-08-08 10:35:27', 2, '81000', '08/AF/2/18/12/35/27', 'SASUKE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `date_created`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-12-12 00:44:45'),
(2, 'kasir_nidar', '8691e4fc53b99da544ce86e22acba62d13352eff', 2, '2017-12-17 09:52:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  ADD PRIMARY KEY (`id_subtransaksi`);

--
-- Indexes for table `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`id_subtransaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  MODIFY `id_subtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `tempo`
--
ALTER TABLE `tempo`
  MODIFY `id_subtransaksi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
