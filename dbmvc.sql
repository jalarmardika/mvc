-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2024 pada 16.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmvc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`) VALUES
(2, 'Le Minerale Tanggung', 12000, 'Air putih terbaik'),
(3, 'Teh Pucuk Harum', 4000, 'Rasa teh terbaik ada dipucuknya'),
(4, 'Pepsodent Habatus sauda', 12000, '-'),
(5, 'Rinso', 15000, 'Deterjen terbaik sepanjang masa'),
(7, 'Sprite 1,5 L', 12500, 'Minuman bersoda'),
(8, 'Aqua Besar', 20000, 'Air mineral terbaik dari pegunungan'),
(10, 'Coca Cola', 18000, 'Minuman bersoda penyegar badan'),
(11, 'Sprite 1,5 L', 20000, '-'),
(14, 'Livebuoy', 4500, 'Sabun mandi pembunuh kuman'),
(26, 'Dettol Original', 5500, 'Sabun antibakteri'),
(27, 'Ades', 4000, 'Air mineral dari sumber pegunungan alami'),
(28, 'Lenovo ideapad', 7000000, '&#60;h5&#62;brand laptop ternama di dunia&#60;/h5&#62;'),
(29, 'Fanta', 12000, 'Minuman bersoda'),
(30, 'Vit', 10000, '&#60;p&#62;air putih&#60;/p&#62;'),
(32, 'Bimoli', 32000, 'Minyak goreng'),
(36, 'Tropical', 33000, 'Minyak goreng dengan 2 kali penyaringan'),
(37, 'Frisian flag', 12000, 'minuman susu kental manis'),
(38, 'Sunco', 32000, 'Minyak goreng bermutu, aman untuk kesehatan'),
(39, 'Dancow Fortigrow', 24000, 'Susu terbaik untuk balita'),
(43, 'Indo Milk', 22000, '&#60;h5&#62;Susu kental manis&#60;/h5&#62;');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
