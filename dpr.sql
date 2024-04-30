-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2024 pada 01.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_anggota`
--

CREATE TABLE `nama_anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `fraksi` varchar(255) NOT NULL,
  `dapil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nama_anggota`
--

INSERT INTO `nama_anggota` (`id`, `nama`, `fraksi`, `dapil`) VALUES
(2, 'Dr. H. SUHARDI DUKA, M.M.', 'Partai Demokrat', 'SULAWESI BARAT'),
(4, 'H. IRMAWAN, S.Sos., M.M.', 'PKB', 'ACEH I'),
(6, 'MITRA FAKHRUDDIN MB, SP.', 'Partai Amanat Nasional', 'SULAWESI SELATAN III');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `nama_anggota`
--
ALTER TABLE `nama_anggota`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `nama_anggota`
--
ALTER TABLE `nama_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
