-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 09 Jul 2018 pada 13.55
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
-- Database: `db_maintenance_report`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_log_trail`
--

CREATE TABLE `setting_log_trail` (
  `id` int(10) UNSIGNED NOT NULL,
  `model` varchar(100) NOT NULL,
  `event` varchar(100) NOT NULL,
  `event_detail` text,
  `row` int(10) UNSIGNED DEFAULT NULL,
  `description` text,
  `user_id` int(10) UNSIGNED NOT NULL,
  `modul_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id modul / id menu / id submenu',
  `modul_type` varchar(15) DEFAULT NULL COMMENT 'is modul / is menu / is submenu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `setting_log_trail`
--
ALTER TABLE `setting_log_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `modul_id` (`modul_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `setting_log_trail`
--
ALTER TABLE `setting_log_trail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
