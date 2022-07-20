-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2022 at 01:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_rajawali`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_penjualan`
--

CREATE TABLE `cart_penjualan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_penjualan`
--

INSERT INTO `cart_penjualan` (`id`, `id_produk`, `id_pelanggan`, `jumlah`) VALUES
(26, 2, 1, 2),
(27, 6, 1, 1),
(28, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`) VALUES
(1, 'Sparepart Motor'),
(2, 'Oli');

-- --------------------------------------------------------

--
-- Table structure for table `mekanik`
--

CREATE TABLE `mekanik` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nomor` varchar(11) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `persentase_ongkos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mekanik`
--

INSERT INTO `mekanik` (`id`, `nama`, `nomor`, `alamat`, `persentase_ongkos`) VALUES
(2, 'Petra', '0812345679', 'Jalan Bandulan 1347', 30);

-- --------------------------------------------------------

--
-- Table structure for table `motor_pelanggan`
--

CREATE TABLE `motor_pelanggan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jenis` varchar(128) NOT NULL,
  `plat_nomor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motor_pelanggan`
--

INSERT INTO `motor_pelanggan` (`id`, `id_pelanggan`, `jenis`, `plat_nomor`) VALUES
(1, 1, 'Jupiter MX', 'N12345'),
(2, 3, 'Kharisma', 'N2456'),
(3, 1, 'Beat Matic', 'N12345');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nomor` varchar(128) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `nomor`, `updated_at`) VALUES
(1, 'Steven', '01234567890', '2022-07-05 11:35:40'),
(3, 'Sugito', '081272387742', '2022-07-04 11:16:58'),
(4, 'Sunarto', '0822345678901', '2022-07-04 21:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `no_penjualan` varchar(128) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `kasir` varchar(128) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `diskon` int(11) NOT NULL,
  `id_mekanik` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_motor` int(11) DEFAULT NULL,
  `ongkos` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_penjualan`, `tanggal_penjualan`, `kasir`, `keterangan`, `diskon`, `id_mekanik`, `id_pelanggan`, `id_motor`, `ongkos`, `sub_total`, `grand_total`, `created_at`) VALUES
(1, 'ORD2007220003', '2022-07-20', 'Rajawali Owner', 'gak ada diskon buat ayang', 0, 2, 3, 2, 25000, 105000, 130000, '2022-07-20'),
(2, 'ORD2007220002', '2022-07-20', 'Rajawali Owner', '-', 0, 2, 1, 1, 25000, 105000, 130000, '2022-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_produk`
--

CREATE TABLE `penjualan_produk` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_produk`
--

INSERT INTO `penjualan_produk` (`id`, `id_penjualan`, `id_produk`, `id_pelanggan`, `jumlah`) VALUES
(1, 1, 6, 3, 1),
(2, 1, 6, 3, 2),
(3, 2, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `batas_bawah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_kategori`, `kode`, `nama`, `jumlah`, `harga_jual`, `harga_beli`, `batas_bawah`) VALUES
(1, 2, 'FX', 'Jumbo Veloz 0,8L Matic', 25, 35000, 30000, 10),
(2, 2, 'KJ.I', 'Jumbo Veloz 1L', 10, 50000, 45000, 5),
(4, 1, 'asdas', 'Sparepart FU', 10, 30000, 21000, 10),
(5, 1, 'O.X', 'Sparepart Test', 8, 30000, 20000, 10),
(6, 1, 'OX.L', 'Oli Yamalube 0.8L', 20, 35000, 20000, 10),
(7, 2, 'OX.C', 'Oli Yamalube 1L', 10, 30000, 20000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id` int(11) NOT NULL,
  `no_keluar` varchar(128) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `catatan_keluar` varchar(256) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id`, `no_keluar`, `tanggal_keluar`, `catatan_keluar`, `created_at`) VALUES
(1, '#SORWJ0807220001', '2022-07-08', '-', '2022-07-08'),
(2, '#SORWJ0807220002', '2022-07-01', 'Test', '2022-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar_produk`
--

CREATE TABLE `stok_keluar_produk` (
  `id` int(11) NOT NULL,
  `id_stok_keluar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `alasan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_keluar_produk`
--

INSERT INTO `stok_keluar_produk` (`id`, `id_stok_keluar`, `id_produk`, `jumlah_produk`, `alasan`) VALUES
(1, 1, 2, 2, 'Rusak dan dikembalikan'),
(2, 1, 6, 3, 'Rusak dan dikembalikan'),
(6, 2, 6, 3, 'Rusak dan dikembalikan'),
(7, 2, 1, 2, 'Dan lain lain');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL,
  `no_pembelian` varchar(128) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `id_supplier` int(11) NOT NULL,
  `status` varchar(128) NOT NULL,
  `catatan_pembelian` varchar(256) NOT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `no_pembelian`, `tanggal_pembelian`, `created_at`, `id_supplier`, `status`, `catatan_pembelian`, `grand_total`) VALUES
(1, '#PORWJ0707220001', '2022-07-07', '2022-07-07', 1, 'Lunas', 'Test', 122000);

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk_produk`
--

CREATE TABLE `stok_masuk_produk` (
  `id` int(11) NOT NULL,
  `id_stok_masuk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `total_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_masuk_produk`
--

INSERT INTO `stok_masuk_produk` (`id`, `id_stok_masuk`, `id_produk`, `jumlah_produk`, `harga_produk`, `total_produk`) VALUES
(11, 1, 6, 2, 25000, 50000),
(12, 1, 5, 3, 24000, 72000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nomor` varchar(128) NOT NULL,
  `deskripsi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `nomor`, `deskripsi`) VALUES
(1, 'Febri Suma Malang ', '08978639441123', 'Sparepart Motor AHM, ban FDR'),
(2, 'SBM (Sumber baru Motor)', '081359126694123', 'Sparepart Motor'),
(3, 'Hadi SUMA Batu', '081554033272123', 'Sparepart AHM, ban FDR'),
(4, 'BJM', '082131540680123', 'Variasi Motor Malang');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `foto`, `role_id`, `created_at`) VALUES
(1, 'Rajawali Owner', 'rajawalimotor2218@gmail.com', '$2y$10$TQW75VUTK9f/vtyRJfgMTOumxSc6KY6BR489aEjRVU7cf/kZH3g5m', 'logo-rajawali.png', 1, 1655778394),
(2, 'Steven Leonard', 'stevenleonard271@gmail.com', '$2y$10$81rCaVHMB69i2IxLNRx8aOFOc7Wzd2GWBmVgUhbr.G/6WBfTTar9G', 'steven.jpg', 2, 1655778838);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(8, 1, 2),
(16, 2, 5),
(22, 1, 5),
(25, 2, 6),
(26, 1, 6),
(30, 1, 3),
(32, 2, 7),
(33, 1, 7),
(34, 1, 8),
(35, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `urutan`) VALUES
(1, 'Admin', 1),
(2, 'User', 4),
(3, 'Menu', 6),
(5, 'Produk', 3),
(6, 'Inventori', 5),
(7, 'Others', 7),
(8, 'Penjualan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin / Owner'),
(2, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `judul`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user-alt', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'Manajemen User', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Ubah Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 5, 'Kategori Produk', 'produk/kategori', 'fas fa-fw fa-stream', 1),
(10, 5, 'Daftar Produk', 'produk', 'fas fa-fw fa-archive', 1),
(11, 6, 'Stok Masuk', 'inventori/stokmasuk', 'fas fa-fw fa-arrow-alt-circle-down', 1),
(12, 6, 'Stok Keluar', 'inventori/stokkeluar', 'fas fa-fw fa-arrow-alt-circle-up', 1),
(13, 6, 'Supplier', 'inventori/supplier', 'fas fa-fw fa-truck', 1),
(17, 7, 'Pelanggan', 'others/pelanggan', 'fas fa-fw fa-user-friends', 1),
(18, 7, 'Mekanik', 'others/mekanik', 'fas fa-fw fa-wrench', 1),
(19, 8, 'Kasir', 'penjualan/kasir', 'fas fa-fw fa-calculator', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_cart`
-- (See below for the actual view)
--
CREATE TABLE `view_cart` (
`id_cart` int(11)
,`id_pelanggan` int(11)
,`id_produk` int(11)
,`nama` varchar(128)
,`jumlah` int(11)
,`harga_jual` int(11)
,`harga_total` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `view_cart`
--
DROP TABLE IF EXISTS `view_cart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cart`  AS SELECT `cart`.`id` AS `id_cart`, `cart`.`id_pelanggan` AS `id_pelanggan`, `cart`.`id_produk` AS `id_produk`, `prd`.`nama` AS `nama`, `cart`.`jumlah` AS `jumlah`, `prd`.`harga_jual` AS `harga_jual`, `cart`.`jumlah`* `prd`.`harga_jual` AS `harga_total` FROM (`cart_penjualan` `cart` join `produk` `prd` on(`prd`.`id` = `cart`.`id_produk`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_penjualan`
--
ALTER TABLE `cart_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekanik`
--
ALTER TABLE `mekanik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor_pelanggan`
--
ALTER TABLE `motor_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_keluar_produk`
--
ALTER TABLE `stok_keluar_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_masuk_produk`
--
ALTER TABLE `stok_masuk_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_penjualan`
--
ALTER TABLE `cart_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mekanik`
--
ALTER TABLE `mekanik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `motor_pelanggan`
--
ALTER TABLE `motor_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stok_keluar_produk`
--
ALTER TABLE `stok_keluar_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_masuk_produk`
--
ALTER TABLE `stok_masuk_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
