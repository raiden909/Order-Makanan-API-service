-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09 Agu 2024 pada 16.35
-- Versi Server: 5.7.30-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ZKteco`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `station_printer`
--

CREATE TABLE `station_printer` (
  `id` char(1) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `station_printer`
--

INSERT INTO `station_printer` (`id`, `description`) VALUES
('A', 'Printer Kasir'),
('B', 'Printer Dapur (Makanan)'),
('C', 'Printer Bar (Minuman)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `station_printer`
--
ALTER TABLE `station_printer`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
