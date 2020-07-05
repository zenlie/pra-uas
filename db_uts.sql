-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2020 pada 20.29
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `stok_barang` int(100) NOT NULL,
  `harga_barang` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nm_barang`, `stok_barang`, `harga_barang`) VALUES
('BR-0001', 'Baju Panjang', 100, 100000),
('BR-0002', 'Baju Pendek', 100, 90000),
('BR-0003', 'Celana Pendek', 100, 200000),
('BR-0004', 'Celana Pendek', 100, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `id_detail_transaksi` varchar(100) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `qty_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` varchar(100) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `notelp_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--
-- Kesalahan membaca struktur untuk tabel db_uts.tbl_transaksi: #1033 - Incorrect information in file: '.\db_uts\tbl_transaksi.frm'
-- Kesalahan membaca data untuk tabel db_uts.tbl_transaksi: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `db_uts`.`tbl_transaksi`' at line 1

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(100) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `level_user` varchar(100) NOT NULL,
  `sk_user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
