-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2025 pada 10.22
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
-- Database: `flower_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `nama`, `email`, `password`) VALUES
(3, 'admin', 'Sagita Pra Kosa', 'sagita.prakosa0111@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat_rumah` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no` varchar(30) DEFAULT NULL,
  `produk` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `alamat_rumah`, `email`, `no`, `produk`, `total`, `tanggal`) VALUES
(18, 'LUFTI', 'mm', 'sagita.prakosa0111@gmail.com', '0909', '[{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img\\/Bluegre Soft Holo.jpg\"}]', 690000, '2025-06-06 22:23:01'),
(19, 'M. Zaenal As\'ari, A.Md', 'sidoarjo', 'beakry', '08899', '[{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"}]', 1265000, '2025-06-06 23:46:19'),
(20, 'mcr', 'apa', 'apaW', '0888', '[{\"nama\":\"Flower - Valerine Eidel\",\"harga\":\"Rp. 90.000\",\"gambar\":\"img/Valerine Eidel.jpg\"},{\"nama\":\"Flower - Valerine Eidel\",\"harga\":\"Rp. 90.000\",\"gambar\":\"img/Valerine Eidel.jpg\"},{\"nama\":\"Beausy - Flower Large\",\"harga\":\"Rp. 100.000\",\"gambar\":\"img/Beausy.jpg\"},{\"nama\":\"Beausy - Flower Large\",\"harga\":\"Rp. 100.000\",\"gambar\":\"img/Beausy.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"}]', 610000, '2025-06-06 23:47:20'),
(22, 'jbjb', 'jgug', ' jhbj', 'hgchc', '[{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"},{\"nama\":\"Bluegre Soft Holoo\",\"harga\":\"Rp. 115.000\",\"gambar\":\"img/Bluegre Soft Holo.jpg\"}]', 460000, '2025-06-07 01:13:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `harga_diskon` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `status`, `harga_diskon`, `rating`) VALUES
(9, 'Piwhite - roses', 300000, 'Piwhite - roses.jpg', 'sale', 200000, 4),
(10, 'Peach Roses - Round', 400000, 'Peach Roses - Round.jpg', 'normal', 0, 3),
(11, 'red rose extra size', 250000, 'red rose extra size.jpg', 'normal', 0, 0),
(12, 'Red-peach rose', 150000, 'Red-peach rose.jpg', 'normal', 0, 0),
(15, 'Red Round - 20 Tangkai', 245000, 'Red Round 20 tangkai.jpg', 'normal', 0, 0),
(16, 'Peach Roses - Round', 245000, 'Peach Roses - Round2.jpg', 'normal', 0, 0),
(17, 'Red Rose Round - STD', 175000, 'Red Rose Round2.jpg', 'normal', 0, 0),
(18, 'Garbera-whity', 165000, 'Garbera-whity.jpg', 'normal', 0, 0),
(19, 'Mixyy Med - Fresh Flower Bouquet', 150000, 'Mixyy MedFresh.jpg', 'normal', 0, 0),
(20, 'Piwhite - roses', 150000, 'Piwhite - rosess.jpg', 'normal', 0, 0),
(21, 'Red-peach rose', 95000, 'Redpeach.jpg', 'normal', 0, 0),
(22, 'Rewyna - Rose Bouquet', 250000, 'RewynaRose.jpg', 'normal', 0, 0),
(23, 'Bluray - Flower Bouquet Artificial', 165000, 'BlurayFlower Bouquet.jpg', 'normal', 0, 0),
(24, 'Yeflying - Artificial Bouquet', 160000, 'yeflying.jpg', 'normal', 0, 0),
(25, 'Redyfly', 160000, 'Redyfly.jpg', 'normal', 0, 0),
(26, 'Butterlypy', 160000, 'Butterlypy.jpg', 'normal', 0, 0),
(27, 'Pearl', 150000, 'Pearl.jpg', 'normal', 0, 0),
(28, 'Bluegre Soft Holoo', 115000, 'Bluegre Soft Holo.jpg', 'normal', 0, 0),
(29, 'Beausy - Flower Large', 100000, 'Beausy.jpg', 'normal', 0, 0),
(30, 'Flower - Valerine Eidel', 90000, 'Valerine Eidel.jpg', 'normal', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tombol_teks` varchar(50) DEFAULT NULL,
  `tombol_link` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `gambar`, `judul`, `deskripsi`, `tombol_teks`, `tombol_link`, `urutan`, `aktif`) VALUES
(1, '../img/slider_1749223618_bg1.jpg', 'katalog produk', 'dapatkan momen sepesial anda dengan hadiah terbaik', 'cek produk', '#produk', 1, 1),
(2, '../img/slider_1749223087_bg2.jpg', 'kranjang', 'jjkhkuh', 'ghvjv', '#shoppingCart', 4, 1),
(3, '../img/slider_1749233702_bg3.jpg', 'ido udang', 'kkk', ' jbjhk', '', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
