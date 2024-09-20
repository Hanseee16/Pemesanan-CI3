-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Sep 2024 pada 15.15
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_pemesanan` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail_pemesanan`, `id_pemesanan`, `id_menu`, `jumlah`) VALUES
(36, 1, 1, 10),
(37, 2, 3, 10),
(38, 3, 1, 10),
(39, 4, 1, 10),
(40, 4, 2, 10),
(41, 4, 3, 10),
(42, 5, 1, 10),
(43, 5, 2, 10),
(44, 5, 3, 10),
(45, 6, 1, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `jenis_kategori` enum('instan','non-instan') NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `jenis_kategori`, `nama_kategori`) VALUES
(1, 'instan', 'siap saji'),
(2, 'non-instan', 'frozen food'),
(3, 'instan', 'instan food'),
(4, 'non-instan', 'mentah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_menu`, `jumlah`) VALUES
(57, 14, 1, 10),
(58, 14, 3, 10),
(59, 14, 2, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `isi` text NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `harga`, `stok`, `isi`, `keterangan`, `foto`) VALUES
(1, 1, 'Pempek', 20000, 50, 'Pempek (17 pcs)\r\ncuko\r\nsambel\r\ntimun', 'Sasasa', 'Ayam-Goreng-Asam-Manis.jpg'),
(2, 3, 'Paket 2', 20000, 10, '', 'Hehehe', 'Ayam-Bumbu-Kecap.jpg'),
(3, 2, 'Dimsum', 50000, 145, '', 'Yayaya', 'Ayam-Goreng-Sambal-Ijo.jpg'),
(4, 1, 'Menu 1', 20000, 50, 'Pempem (17 Pcs)\r\nCuko\r\nTimun', 'Sasa', 'menu-ayam-goreng-lengkuas.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `kode_pemesanan` bigint(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `sub_total` int(11) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `status_pengiriman` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `keterangan_ditolak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kode_pemesanan`, `id_user`, `no_telp`, `alamat`, `sub_total`, `tanggal_pemesanan`, `status_pengiriman`, `status_pembayaran`, `keterangan_ditolak`) VALUES
(1, 170820241952001, 14, '08912345678', 'depok', 200000, '2024-08-17 19:52:35', 'Dikirim', 'Diterima', 'Yeeee'),
(2, 170820242008002, 14, '089555666777', 'bogor', 500000, '2024-08-17 20:08:09', 'Menunggu', 'Ditolak', 'aa'),
(3, 210820241833003, 16, '089555333222', 'm', 200000, '2024-08-21 18:33:29', 'Proses', 'Diterima', 'L'),
(4, 10920241202004, 13, '0895351385111', 'depok', 900000, '2024-09-01 12:02:34', 'Menunggu', 'Belum Diterima', NULL),
(5, 20920241712005, 14, '089123123123', 'aaa', 900000, '2024-09-02 17:12:58', 'Menunggu', 'Belum Diterima', NULL),
(6, 200920242013006, 13, '089555666777', 'h', 200000, '2024-09-20 20:13:29', 'Menunggu', 'Belum Diterima', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` enum('Admin','Reseller') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Reseller');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `bukti_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pemesanan`, `tanggal_transaksi`, `bukti_transaksi`) VALUES
(1, 1, '2024-08-17', 'Bukti_Pembayaran3.png'),
(2, 2, '2024-08-17', 'Bukti_Pembayaran4.png'),
(3, 3, '2024-08-21', 'Untitled.jpg'),
(4, 5, '2024-09-02', 'duit.jpg'),
(5, 6, '2024-09-20', 'Ayam-Bumbu-Kecap.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pendaftaran`
--

CREATE TABLE `transaksi_pendaftaran` (
  `id_transaksi_pendaftaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `bukti_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi_pendaftaran`
--

INSERT INTO `transaksi_pendaftaran` (`id_transaksi_pendaftaran`, `id_user`, `tanggal_transaksi`, `bukti_transaksi`) VALUES
(3, 13, '2024-08-10', 'duit.png'),
(4, 14, '2024-08-14', 'Untitled.jpg'),
(5, 15, '2024-08-17', 'Bukti_Pembayaran.png'),
(6, 16, '2024-08-21', 'Untitled1.jpg'),
(7, 17, '2024-08-22', 'Pendaftaran.png'),
(8, 18, '2024-08-22', 'Bukti_Pembayaran1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_lengkap`, `email`, `password`, `no_hp`, `status`) VALUES
(1, 1, 'Admin Ganteng bangettt', 'admin@gmail.com', '$2y$10$33DzlQurC1DBHUO.9b5Vh.3L4pWlSZk5pooptOELtIqxbrQLqn1Qe', '089123234345', 'Aktif'),
(13, 2, 'Cihuyyy', 'user@gmail.com', '$2y$10$bh1fK6PxHenCPtsU.11MK.tIrv8SewLEYgar40Rb5wDeD6qAkcy6S', '089765876876', 'Aktif'),
(14, 2, 'cihuyy', 'farhan@gmail.com', '$2y$10$pLq9Fuptk0PlB0lfl5w0aeF/bhTIVdt4g8PbmczB7qDC.gqgWdn4u', '089567987098', 'Aktif'),
(15, 2, 'Rizqy Perdana', 'rizqy@gmail.com', '$2y$10$jqh3sKhUI2p6n2HDag8.K.lVsGDIRMuFDxiKr/zV6Ng.k5EeR3KU.', '089535138511', 'Aktif'),
(16, 2, 'Mi', 'm@gmail.com', '$2y$10$.iEzM4s.cq64C3cOVA6Ycu2zOndDdIFSwO6dqCW.R5o1X.uH40uM6', '088888888888', 'Aktif'),
(17, 2, 'Farhan Kamil', 'kamilfarhan223@gmail.com', '$2y$10$3ASj7jIT.ozVtxD6KycywutCtMDKjf4c4CiY/QzyvmqC71kjiizwa', '088888888867', 'Aktif'),
(18, 2, 'Muhammad Rizqy Perdana', 'kikiperdana28@gmail.com', '$2y$10$H2OzxKAlnxNVwXxBDig97.0mjl8uEUMJBuASs1opRFU9jx0jjijDG', '089665658630', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_pemesanan`),
  ADD KEY `fk_m` (`id_menu`),
  ADD KEY `fk_p` (`id_pemesanan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_user` (`id_user`),
  ADD KEY `fk_menu` (`id_menu`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `fk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `fk_u` (`id_user`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_pm` (`id_pemesanan`);

--
-- Indeks untuk tabel `transaksi_pendaftaran`
--
ALTER TABLE `transaksi_pendaftaran`
  ADD PRIMARY KEY (`id_transaksi_pendaftaran`),
  ADD KEY `fk_userr` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pendaftaran`
--
ALTER TABLE `transaksi_pendaftaran`
  MODIFY `id_transaksi_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `fk_m` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `fk_p` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_u` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_pm` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Ketidakleluasaan untuk tabel `transaksi_pendaftaran`
--
ALTER TABLE `transaksi_pendaftaran`
  ADD CONSTRAINT `fk_userr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
