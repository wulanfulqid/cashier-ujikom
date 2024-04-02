-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2024 pada 06.37
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `DetailID` int(11) NOT NULL,
  `PenjualanID` date NOT NULL,
  `ProdukID` int(11) NOT NULL,
  `JumlahProduk` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`DetailID`, `PenjualanID`, `ProdukID`, `JumlahProduk`, `Subtotal`) VALUES
(7, '2024-02-01', 72, 1, 1200000.00),
(10, '2024-02-19', 76, 1, 5000000.00),
(11, '2024-02-19', 89, 2, 8000000.00),
(12, '2024-02-19', 78, 1, 14000000.00),
(13, '2024-02-19', 87, 1, 3000000.00),
(15, '2024-02-19', 92, 1, 60000000.00),
(16, '2024-02-19', 95, 1, 500000.00),
(17, '2024-03-19', 94, 1, 600000.00),
(18, '2024-03-20', 73, 1, 560000.00),
(19, '2024-03-26', 78, 1, 1000000.00),
(20, '2024-02-26', 82, 1, 15000000.00),
(21, '2024-02-26', 78, 2, 4000000.00),
(23, '2024-02-27', 78, 1, 1000000.00),
(24, '2024-02-27', 76, 1, 5000000.00),
(26, '2024-02-27', 73, 1, 560000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `KategoriID` int(11) NOT NULL,
  `NamaKategori` varchar(255) NOT NULL,
  `TanggalKategori` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`KategoriID`, `NamaKategori`, `TanggalKategori`) VALUES
(1, 'Ranjang Tempat Tidur', '2024-02-17'),
(3, 'Ranjang Sofa', '2024-02-09'),
(4, 'Lemari Pakaian', '2024-02-11'),
(5, 'Sofa', '2024-02-11'),
(6, 'Lemari Buku', '2024-02-17'),
(7, 'Lemari Sepatu', '2024-02-17'),
(8, 'Sofa Tempat Tidur', '2024-02-17'),
(9, 'Meja Makan', '2024-02-17'),
(10, 'Meja Kerja', '2024-02-17'),
(11, 'Meja Rias', '2024-02-17'),
(12, 'Kasur Spring Bed', '2024-02-20'),
(14, 'Kursi Lipat', '2024-02-20'),
(15, 'Kursi Kayu', '2024-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` int(11) NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`) VALUES
(33, 'Berlinda Asoya', 'Cipaku Haji, Bogor Selatan rt04/rw07', '083818177785'),
(36, 'Namara Maulidia', 'Komplek Perumda, Bogor, Jawa Barat no rumah 103', '085763450097'),
(38, 'Nabila Maharani', 'Komplek Pakuan Hill, Livistona no rumah 24', '087875623445'),
(39, 'Renata De Syifa', 'Ciapus, gang Kosasih, no rumah 9, rt06/rw05', '087873465825'),
(40, 'Devi Aristianti', 'Perumahan Summit Rancamaya, no rumah 32', '087876654921'),
(41, 'Taufik Hidayat', 'Apartemen Mediterania Palace Residence Kemayoran Jakarta Pusat, lantai 21, no F5', '089567423145'),
(42, 'Merry Meryana', 'EL Royale Apartment by Alfarez Home, Bandung,  lantai 8 no G9', '083805614878'),
(43, 'Zayare Admiren', 'Skyland Sentul Tower Apartment, lantai 9, no L23', '089523456781'),
(45, 'Navita Gorgeyas', 'Green Bali Resort, Cibinong, Pondok Lajeng, no rumah 32', '08786543456'),
(49, 'Ihsan Priyatna', 'Jl. Tapos, no rumah 2', '089765423145'),
(50, 'Bu Wanda Novita', 'Ciawi Hills, no rumah 12', '08976732514'),
(51, 'Pa Mujib', 'Buntar', '098728253'),
(52, 'Wulan', 'Cipaku', '0856545478'),
(53, 'Rina Haerani', 'Kp Cipaku Haji rt04/rw07 no rumah 08', '08978765342'),
(60, 'Wulans', 'kp Cipaku Haji', '12345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `PenjualanID` int(11) NOT NULL,
  `TanggalPenjualan` date DEFAULT NULL,
  `Harga` decimal(10,0) DEFAULT NULL,
  `PelangganID` int(11) DEFAULT NULL,
  `ProdukID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'belum selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `ProdukID` int(11) NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,0) NOT NULL,
  `Stok` int(11) NOT NULL,
  `KategoriID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`ProdukID`, `NamaProduk`, `Harga`, `Stok`, `KategoriID`) VALUES
(71, 'Elegante Wardrobe', 900000, 8, 1),
(72, 'Classic Oak Cabinet', 4000000, 9, 6),
(73, 'Modern Storage Shoes', 560000, 13, 7),
(74, 'Vintage Maple Armoire', 1500400, 0, 6),
(76, 'EleganceDine Table', 5000000, 1, 9),
(77, 'ModernHarmony Dining Table', 905000, 8, 9),
(78, 'ErgoCraft Workspace', 1000000, 5, 10),
(79, 'MinimalistFocus Desk', 600000, 20, 10),
(80, 'ClassicCharm Vanity', 12000000, 0, 11),
(81, 'FoldMirror Beauty Desk', 6000000, 6, 11),
(82, 'ComfortHaven Lounge', 15000000, 7, 5),
(83, 'ModernBlend Sectional', 11000000, 8, 5),
(84, 'CozyDream Sleeper Sofa', 5000000, 7, 8),
(85, 'FoldNap Sofa Bed', 1400000, 4, 8),
(86, 'MinimalBookcase Hub', 5000000, 10, 6),
(87, 'WoodenLibrary Shelf', 3000000, 14, 6),
(88, 'HangFit Shoe Organizer', 4000000, 20, 7),
(89, 'FoldStep Shoe Cabinet', 2000000, 38, 7),
(90, 'ModernSole Rack', 950000, 32, 7),
(91, 'VintageVogue Armoire', 50000000, 4, 4),
(92, 'FoldCozy Sleeping Nest', 60000000, 4, 1),
(93, 'SolidWood Dream Bed', 5000000, 5, 1),
(94, 'MinimalSofa Bed', 600000, 15, 3),
(95, 'LoungeChic Sofa Sleeper', 500000, 7, 3),
(97, 'Sofa Bed', 3000000, 3, 8),
(98, 'Focus Corner', 3000000, 6, 10),
(100, 'Sofa kursi', 5000, 6, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'petugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`) VALUES
(1, 'admin', 'admin@mail.com', NULL, '$2y$10$EW8rDWy9ucfYZLx0sL0VXulsNu788PccX5Q9vVNL8MxGQtILLzq1u', 'admin'),
(2, 'petugas', 'petugas@mail.com', NULL, '$2y$10$rJx/ckwdPB1Fa6QZIJ82J.NMswZF5XQa0IxIOCf0g8izGNrCHpR46', 'petugas'),
(23, 'Renata', 'renatadesyifa@gmail.com', NULL, '$2y$10$I0oEtARLdMiRJG.bbdiMleb5AaEXxFhRTpNQ9zn9FToJdP5i72YvS', 'petugas'),
(25, 'wulan', 'wulan2018garden@gmail.com', NULL, '$2y$10$XZdwxLN6S6IkHAFZxwRY..siyUWmZ2Ug2dE/IJhSdIFyKN7ELyZ16', 'petugas'),
(26, 'Nuri', 'iyaakuwulanke2@gmail.com', NULL, '$2y$10$Ti3r49VAytW0T6rqDM5eHuMekzvDrcJ7Drx1/kquewy9/JQ0OnyOO', 'petugas'),
(28, 'admin1', 'admin*@gmail.com', NULL, '$2y$10$XyeIiVY/G6WLTL.mn/psuOeLv.Jh9qW7/MVK6j6IK7wp6ryBHCQ1m', 'admin'),
(29, 'petugas1', 'petugas6@mail.com', NULL, '$2y$10$K81emt21T7z9Qq59atovo.5gHKzTxxAY9jLJPraCEht8m9D1ppeCG', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `PenjualanID` (`PenjualanID`),
  ADD KEY `ProdukID` (`ProdukID`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`PenjualanID`),
  ADD KEY `PelangganID` (`PelangganID`),
  ADD KEY `ProdukID` (`ProdukID`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `PelangganID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `PenjualanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_ibfk_2` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`),
  ADD CONSTRAINT `fk_ProdukID` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`PelangganID`) REFERENCES `pelanggan` (`PelangganID`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `kategori` (`KategoriID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
