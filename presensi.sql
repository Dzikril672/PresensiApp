-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `kode_departemen` varchar(5) NOT NULL,
  `nama_departemen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`kode_departemen`, `nama_departemen`) VALUES
('HRD', 'Human Resource Developments'),
('IT', 'Information Technology'),
('MKT', 'Marketing Kantor'),
('PBO', 'Proses Bisnis Outsourcing');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kode_departemen` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_lengkap`, `jabatan`, `no_hp`, `foto`, `kode_departemen`, `password`, `remember_token`) VALUES
('112233', 'Muhammad Aldi Irpan', 'Manager HRD', '082218485389', '112233-profile.jpg', 'HRD', '$2y$10$zS2MD01TRt.iBOalnbV.DujtMWf8ePxyDVJ1qQHORnvoFWRCO/Aqy', ''),
('121314', 'Yusleli Siagian', 'Manager Marketing', '0812388647982', NULL, 'IT', '$2y$10$JKnppZiuRBNvZnmhQ2XfK.dw7.1S9wnMAxELjiF/lD/z4ubD9d2um', NULL),
('12345', 'Dzikril Hakim', 'Direktur Utama', '082218485381', '12345-profile.jpg', 'IT', '$2y$10$zXwBRsz8u2e9Tz5rHxtAtOK6Np0JWPeYuKuk3.1I5lKjXq7SaCGuq', ''),
('123456', 'Yusleli Siagian', 'Manager Marketing', '081238864798', '123456-profile.jpg', 'MKT', '$2y$10$Xpx/EUcYQlQzy3jICWviU.SXUNWWiqvr8rsyfqNHXa0TVYHX/pgn6', NULL),
('2121', 'Aldi Irfan', 'Staff IT', '087266288172', NULL, 'IT', '$2y$10$tnPYGtQ1h2naUKWVNaHmU.3BOzy9e.C/pEA8lKSluoX02oYwAAw5y', NULL),
('54321', 'Udin', 'Staff IT', '087266288172', NULL, 'IT', '$2y$10$UFgPQKfCq7s1FUxuohQCDe0FYoh/kanaSrLWMclog7NfdBH1.XAoi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_lokasi`
--

CREATE TABLE `konfigurasi_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi_kantor` varchar(255) NOT NULL,
  `radius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi_lokasi`
--

INSERT INTO `konfigurasi_lokasi` (`id`, `lokasi_kantor`, `radius`) VALUES
(1, '-6.234784858296313,106.8215754013608', 100);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tgl_izin` date NOT NULL,
  `status` char(1) NOT NULL,
  `keterangan` text NOT NULL,
  `status_approved` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`id`, `nik`, `tgl_izin`, `status`, `keterangan`, `status_approved`) VALUES
(3, '12345', '2024-04-05', 'i', 'Ngelem', '1'),
(5, '112233', '2024-04-05', 'i', 'Nonton Film bersama mantan', '1'),
(6, '12345', '2024-04-26', 's', 'Sakit Hati', '2'),
(7, '12345', '2024-04-25', 's', 'Menjenguk DInosaurus Punah', '0');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `foto_masuk` varchar(255) NOT NULL,
  `foto_keluar` varchar(255) DEFAULT NULL,
  `lokasi_masuk` text NOT NULL,
  `Lokasi_keluar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `nik`, `tgl_presensi`, `jam_masuk`, `jam_keluar`, `foto_masuk`, `foto_keluar`, `lokasi_masuk`, `Lokasi_keluar`) VALUES
(16, '12345', '2024-03-28', '08:14:09', '08:14:36', '12345-2024-03-28-in.png', '12345-2024-03-28-out.png', '-6.1801714, 106.7090697', '-6.1801714, 106.7090697'),
(18, '112233', '2024-03-28', '14:56:00', '17:57:00', '112233-2024-03-28-in.png', '112233-2024-03-28-out.png', '-6.2347637, 106.8215013', '-6.2347637, 106.8215013'),
(19, '12345', '2024-04-01', '08:47:48', '16:12:19', '12345-2024-04-01-in.png', '12345-2024-04-01-out.png', '-6.2347815, 106.8214884', '-6.2347766, 106.8215261'),
(20, '112233', '2024-04-01', '09:16:40', '09:16:58', '112233-2024-04-01-in.png', '112233-2024-04-01-out.png', '-6.2347619, 106.8215193', '-6.2347619, 106.8215193'),
(21, '12345', '2024-04-02', '14:36:00', '17:37:02', '12345-2024-04-02-in.png', '12345-2024-04-02-out.png', '-6.2347782, 106.8214879', '-6.234774, 106.8215185'),
(22, '12345', '2024-04-05', '06:07:20', '10:07:46', '12345-2024-04-05-in.png', '12345-2024-04-05-out.png', '-6.2347806, 106.8214813', '-6.2347798, 106.8214815'),
(23, '112233', '2024-04-05', '10:08:43', NULL, '112233-2024-04-05-in.png', '112233-2024-04-05-out.png', '-6.2347791, 106.8214894', '-6.2347791, 106.8214894'),
(24, '12345', '2024-04-18', '16:07:07', '16:10:19', '12345-2024-04-18-in.png', '12345-2024-04-18-out.png', '-6.23486, 106.82117', '-6.234852, 106.821187'),
(25, '12345', '2024-04-19', '22:13:10', NULL, '12345-2024-04-19-in.png', NULL, '-6.1940348, 106.7095843', NULL),
(26, '112233', '2024-04-24', '09:33:05', NULL, '112233-2024-04-24-in.png', NULL, '-6.234225, 106.82179', NULL),
(27, '12345', '2024-04-25', '08:37:03', NULL, '12345-2024-04-25-in.png', NULL, '-6.234225, 106.82179', NULL),
(28, '12345', '2024-05-15', '13:42:02', NULL, '12345-2024-05-15-in.png', NULL, '-6.2347939, 106.8214962', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yusleli', 'Yusleli@gmail.com', NULL, '$2y$10$zS2MD01TRt.iBOalnbV.DujtMWf8ePxyDVJ1qQHORnvoFWRCO/Aqy', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`kode_departemen`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
