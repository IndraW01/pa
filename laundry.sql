-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 04:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_laundry`
--

CREATE TABLE `tb_laundry` (
  `id_laundry` int(11) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jumlah_kiloan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_laundry`
--

INSERT INTO `tb_laundry` (`id_laundry`, `id_pelanggan`, `id_user`, `id_paket`, `tanggal_terima`, `tanggal_selesai`, `jumlah_kiloan`, `nominal`, `status`, `catatan`) VALUES
(24, 'PLG-0001', 1, 1, '2021-05-21', '2021-05-22', 1, 7000, 'Lunas', 'Baju'),
(27, 'PLG-0002', 1, 2, '2021-05-21', '2021-05-22', 2, 10000, 'Lunas', 'Baju, Celana'),
(28, 'PLG-0003', 1, 3, '2021-05-21', '2021-05-23', 2, 8000, 'Lunas', 'Celana Tartan'),
(29, 'PLG-0004', 1, 1, '2021-05-21', '2021-05-22', 1, 7000, 'Lunas', 'Baju Flanel'),
(30, 'PLG-0005', 1, 1, '2021-05-22', '2021-05-23', 3, 21000, 'Lunas', 'Baju Flanel. Celana Tartan'),
(31, 'PLG-0006', 1, 2, '2021-05-22', '2021-05-24', 2, 10000, 'Lunas', 'Celana Jeans');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` enum('Express','Medium','Low') NOT NULL,
  `harga_paket` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `harga_paket`) VALUES
(1, 'Express', 7000),
(2, 'Medium', 5000),
(3, 'Low', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `alamat`, `telpon`) VALUES
('PLG-0001', 'Indra Wijaya', 'Samboja Keren', '085246739265'),
('PLG-0002', 'Alpit', 'Bontang Jaya', '087245368632'),
('PLG-0003', 'Asrofi', 'Muara Jawa', '08524673837'),
('PLG-0004', 'Fadli', 'Paser', '085246739265'),
('PLG-0005', 'Azza', 'Tenggarong', '08724536863'),
('PLG-0006', 'Maulidani', 'Balikpapan Baru', '085246738378');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `tanggal_transaksi`, `pemasukan`, `pengeluaran`, `catatan`, `keterangan`) VALUES
(13, 1, '2021-05-21', 7000, 0, 'Baju', 'pemasukan'),
(16, 1, '2021-05-21', 10000, 0, 'Baju, Celana', 'pemasukan'),
(17, 1, '2021-05-21', 8000, 0, 'Celana Tartan', 'pemasukan'),
(18, 1, '2021-05-21', 7000, 0, 'Baju Flanel', 'pemasukan'),
(19, 1, '2021-05-22', 0, 10000, 'Sabun dan Rinso', 'Pengeluaran'),
(20, 1, '2021-05-22', 21000, 0, 'Baju Flanel. Celana Tartan', 'pemasukan'),
(21, 1, '2021-05-22', 10000, 0, 'Celana Jeans', 'pemasukan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('Admin','Kasir') NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_user`, `password`, `level`, `foto`) VALUES
(1, 'admin', 'IndraW', 'admin', 'Admin', '60a479c28fb3e.jpg'),
(2, 'kasir', 'Alpit', 'kasir', 'Kasir', 'avatar2.png'),
(8, 'admin1', 'Yupan Ramadhani', 'admin1', 'Admin', '60a47e3417b3d.jpg'),
(9, 'kasir1', 'Iksan', 'kasir1', 'Kasir', '60a47ef00fd27.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  ADD PRIMARY KEY (`id_laundry`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  MODIFY `id_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
