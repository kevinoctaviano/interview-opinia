-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2022 pada 09.28
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview_opinia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `postingan`
--

CREATE TABLE `postingan` (
  `id_postingan` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `post_type` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `postingan`
--

INSERT INTO `postingan` (`id_postingan`, `title`, `description`, `post_type`, `user`) VALUES
(4, 'kevini', 'ini testing tiga', 3, 1),
(5, 'kevini', 'ini testing 4', 4, 1),
(6, 'kevini', 'ini testing 6', 2, 1),
(7, 'kevini', 'ini testing 7', 2, 2),
(8, 'ini testing 7', 'ini testing 7', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_type`
--

CREATE TABLE `post_type` (
  `id_type` int(11) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `post_type`
--

INSERT INTO `post_type` (`id_type`, `jenis`, `type`) VALUES
(1, 'Opini', 'Artikel'),
(2, 'Cerpen', 'Artikel'),
(3, 'Idea', 'Idea'),
(4, 'Esai', 'Artikel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `phone`, `email`, `password`) VALUES
(1, 'Kevin Octaviano', '085156896874', 'oktaviano776@gmail.com', '$2y$10$XhcYCCXklcCGO0BiDnmuSulpNuLF/2xx.0A5wFSYZ3O0ccRsGcet.'),
(2, 'vianovinn', '01938498203', 'vianovinn@gmail.com', '$2y$10$rFABTxnVoBKiIOex1Si8tu59ResqquWLYL0MQ/4YR/POcMSJfRnZu'),
(3, 'Galih Wicaksono', '12344564775', 'galih@gmail.com', '$2y$10$Zk4wNaejzZshVZu1FBxAie8O1BLMjZx61ehUDiwTvh5/PYKOc2wVu');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id_postingan`),
  ADD KEY `post_type` (`post_type`),
  ADD KEY `user` (`user`);

--
-- Indeks untuk tabel `post_type`
--
ALTER TABLE `post_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id_postingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `post_type`
--
ALTER TABLE `post_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`post_type`) REFERENCES `post_type` (`id_type`),
  ADD CONSTRAINT `postingan_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
