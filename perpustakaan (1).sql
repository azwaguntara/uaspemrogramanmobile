-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 05:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(6) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(30) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `penerbit`, `stok`) VALUES
(1, 'Bootstrap CSS Framework', 'Roberto Kaban', 'Andi Publisher', 4),
(2, 'Pemrograman', 'Nesya', 'Nadia Publisher', 3),
(3, 'Rekayasa Perangkat Lunak', 'Nadia', 'Nesya', 3),
(4, 'Sistem Pengambilan Keputusan', 'nazwa', 'Putri', 4),
(5, 'Matematika Diskrit', 'RIKA', 'yahyal', 1),
(6, 'Pemrograman Berorientasi Objek', 'M.Arif', 'Samsinar', 3),
(7, 'Perancangan Basis Data', 'Hamim Tohari', 'Andi', 4),
(8, 'Kriptografi', 'Okta', 'mei', 3),
(9, 'Algoritma Pemrograman', 'Rika', 'gak tau', 6),
(10, 'Kriptografi', '-', 'gaktau', 2),
(11, 'Basis Data', 'anonym', 'anonymm', 3),
(12, 'Metode Numerik', 'anonym', 'anonym', 4);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(6) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `judul_buku` varchar(255) DEFAULT NULL,
  `pengembalian` date DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT NULL,
  `nohp` varchar(13) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `nama`, `nim`, `prodi`, `semester`, `judul_buku`, `pengembalian`, `tanggal_kembali`, `status`, `nohp`, `email`) VALUES
(1, 1, 'Azwa Guntara', '22040078', 'TI', 6, 'Bootstrap CSS Framework', '2025-06-21', '2025-06-24 09:08:42', 'dikembalikan', '', ''),
(2, 2, 'Yahyal', '12345678', 'TI', 6, 'Pemrograman', '2025-06-26', '2025-06-24 10:32:33', 'dikembalikan', '', ''),
(3, 2, 'yahyal bakri', '12345678', 'Teknik Informatika (S1)', 6, 'Pemrograman', '2025-06-28', '2025-07-01 09:14:56', 'dikembalikan', '082354678901', 'yahyal@gmail.com'),
(4, 1, 'Azwa ', '123', 'Teknik Informatika (S1)', 6, 'Bootstrap CSS Framework', '2025-07-25', NULL, 'dipinjam', '12345', 'azwa@gmail.com'),
(5, 5, 'Nesay', '22345678', 'Teknologi Informasi (S1)', 6, 'Matematika Diskrit', '2025-07-18', '2025-07-22 12:58:23', 'dikembalikan', '082345670981', 'nesay@gmail.com'),
(6, 5, 'Putri', '221234', 'Sistem Informasi (S1)', 4, 'Matematika Diskrit', '2025-07-16', '2025-07-08 09:19:30', 'dikembalikan', '087654231312', 'putri@gmail.com'),
(7, 8, 'Ferdi', '22040088', 'Teknik Informatika (S1)', 6, 'Kriptografi', '2025-07-23', '2025-07-23 10:16:40', 'dikembalikan', '082345678901', 'ferdi@gmail.com'),
(8, 9, 'Meilan', '12345678', 'Teknik Informatika (S1)', 6, 'Algoritma Pemrograman', '2025-07-23', '2025-07-23 10:25:47', 'dikembalikan', '08907654321', 'mei@gmail.com'),
(9, 10, 'Agun', '22087654', 'Teknik Industri (S1)', 4, 'Kriptografi', '2025-07-25', NULL, 'dipinjam', '089765432112', 'gun@gmail.com'),
(10, 11, 'yahyal bakri', '12345678', 'Teknik Informatika (S1)', 6, 'Basis Data', '2025-07-26', NULL, 'dipinjam', '081234567890', 'yahyal123@gmail.com'),
(11, 12, 'anonym', '221234875', 'Teknologi Informasi (S1)', 2, 'Metode Numerik', '2025-07-26', '2025-07-23 10:30:27', 'dikembalikan', '123456789012', 'anon@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','pengguna') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
