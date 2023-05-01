-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2023 at 06:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saw_ferdi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id`, `nama`, `created_at`) VALUES
(1, 'Anang R', '0000-00-00 00:00:00'),
(3, 'tes', '2023-04-02 09:45:51'),
(4, 'tes 2', '2023-04-02 14:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id` int NOT NULL,
  `id_alter` int NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id`, `id_alter`, `hasil`) VALUES
(1, 1, 6.8),
(2, 3, 11.45),
(3, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bobot` int NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id`, `nama`, `bobot`, `kategori`, `created_at`) VALUES
(1, 'Nilai Raport', 3, 'benefit', '2023-03-28 22:49:21'),
(2, 'Tes Psikotes', 4, 'benefit', '2023-04-02 09:39:45'),
(3, 'Angket Peminatan', 3, 'benefit', '2023-04-02 09:40:04'),
(4, 'Tes Akademik', 3, 'benefit', '2023-04-02 09:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perangkingan`
--

CREATE TABLE `tb_perangkingan` (
  `id` int NOT NULL,
  `id_alter` int NOT NULL,
  `id_krit` int NOT NULL,
  `id_sub` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_perangkingan`
--

INSERT INTO `tb_perangkingan` (`id`, `id_alter`, `id_krit`, `id_sub`, `created_at`) VALUES
(3, 3, 1, 10, '2023-04-02 09:46:32'),
(4, 3, 2, 16, '2023-04-02 09:46:32'),
(5, 3, 3, 18, '2023-04-02 09:46:32'),
(6, 3, 4, 23, '2023-04-02 09:46:32'),
(7, 1, 1, 9, '2023-04-02 09:47:30'),
(8, 1, 2, 13, '2023-04-02 09:47:30'),
(9, 1, 3, 18, '2023-04-02 09:47:30'),
(10, 1, 4, 21, '2023-04-02 09:47:30'),
(11, 4, 1, 11, '2023-04-02 14:04:26'),
(12, 4, 2, 17, '2023-04-02 14:04:26'),
(13, 4, 3, 19, '2023-04-02 14:04:26'),
(14, 4, 4, 23, '2023-04-02 14:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id` int NOT NULL,
  `kriteria_id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nilai` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id`, `kriteria_id`, `nama`, `kategori`, `nilai`, `created_at`) VALUES
(8, 1, '0 - 50', 'Sangat Kurang(SK)', 1, '2023-04-02 09:41:16'),
(9, 1, '51 - 65', 'Kurang(K)', 2, '2023-04-02 09:41:33'),
(10, 1, '66 - 75', 'Cukup(C)', 3, '2023-04-02 09:41:49'),
(11, 1, '76 - 85', 'Baik(B)', 4, '2023-04-02 09:42:05'),
(12, 1, '86 - 100', 'Sangat Baik(SB)', 5, '2023-04-02 09:42:19'),
(13, 2, '0 - 50', 'Sangat Kurang(SK)', 1, '2023-04-02 09:42:45'),
(14, 2, '51 - 65', 'Kurang(K)', 2, '2023-04-02 09:42:58'),
(15, 2, '66 - 75', 'Cukup(C)', 3, '2023-04-02 09:43:49'),
(16, 2, '76 - 85', 'Baik(B)', 4, '2023-04-02 09:44:01'),
(17, 2, '86 - 100', 'Sangat Baik(SB)', 5, '2023-04-02 09:44:12'),
(18, 3, 'IPA', 'Baik(B)', 4, '2023-04-02 09:44:26'),
(19, 3, 'IPS', 'Baik(B)', 4, '2023-04-02 09:44:36'),
(20, 4, '0 - 50', 'Sangat Kurang(SK)', 1, '2023-04-02 09:44:51'),
(21, 4, '51 - 65', 'Kurang(K)', 2, '2023-04-02 09:45:01'),
(22, 4, '66 - 75', 'Cukup(C)', 3, '2023-04-02 09:45:12'),
(23, 4, '76 - 85', 'Baik(B)', 4, '2023-04-02 09:45:24'),
(24, 4, '86 - 100', 'Sangat Baik(SB)', 5, '2023-04-02 09:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`, `nama`) VALUES
(1, 'anang', 'c4ca4238a0b923820dcc509a6f75849b', 'anang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_perangkingan`
--
ALTER TABLE `tb_perangkingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_perangkingan`
--
ALTER TABLE `tb_perangkingan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
