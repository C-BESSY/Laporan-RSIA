-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 02:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `laporan_bulanan`
--

-- --------------------------------------------------------
--
-- Table structure for table `lap_tindakan_ok`
--

CREATE TABLE `tindakan_ok` (
  `ID_LTO` INT NOT NULL AUTO_INCREMENT,
  `Tanggal` DATE NOT NULL,
  `RM_Pasien` varchar(255) DEFAULT NULL,
  `TindakanUtama` ENUM(
    'SC',
    'KISTEKTOMI',
    'MIOMEKTOMI',
    'RECLOSING',
    'HISTERECTOMI',
    'LAPAROTOMI',
    'SALPINGO'
  ) NOT NULL,
  `TindakanSekunder` VARCHAR(255) NOT NULL,
  `JenisBayarUtama` ENUM('BPJS', 'Umum') NOT NULL,
  `JenisBayarSekunder` ENUM('BPJS', 'Umum') NOT NULL,
  `Dehisensi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ID_LTO`)
) ENGINE = InnoDB;
--
-- Dumping data for table `lap_tindakan_ok`
--

-- Table structure for table `bangsal`
--

CREATE TABLE `bangsal` (
  `ID_LB` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `RM_Pasien` varchar(255) DEFAULT NULL,
  `RanapBPJS` int(11) NOT NULL,
  `RanapUmum` int(11) NOT NULL,
  `RawatBPJS` int(11) NOT NULL,
  `RawatUmum` int(11) NOT NULL,
  `Meninggal` int(11) NOT NULL,
  `Rujuk` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `bangsal`
--

-- INSERT INTO `bangsal` (`ID_LB`, `Tanggal`, `RanapBPJS`, `RanapUmum`, `RawatBPJS`, `RawatUmum`, `Meninggal`, `Rujuk`) VALUES
-- (12132, '2024-03-04', 20, 10, 10, 5, 2, 8),
-- (12314, '2024-03-04', 5, 5, 5, 5, 1, 2),
-- (12315, '2024-01-18', 12, 5, 8, 5, 0, 5),
-- (12318, '2024-02-13', 0, 1, 0, 0, 0, 1),
-- (12319, '2024-02-07', 1, 0, 0, 0, 0, 1),
-- (12320, '2024-02-12', 1, 0, 0, 0, 0, 0),
-- (12321, '2024-02-10', 0, 0, 1, 0, 0, 0);
-- --------------------------------------------------------
--
-- Table structure for table `perina`
--

CREATE TABLE `perina` (
  `ID_LP` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `RM_Pasien` varchar(255) DEFAULT NULL,
  `Kelahiran` enum('Lahir', 'Meninggal') NOT NULL,
  `Nama_Tindakan` enum(
    'IUFD',
    'Rujuk',
    'BBLR',
    'Ranap_Anak',
    'Ranap_Perina'
  ) NOT NULL,
  `Jenis_Bayar` enum('BPJS', 'Umum') NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `perina`
--

-- INSERT INTO `perina` (`ID_LP`, `Tanggal`, `Kelahiran`, `Nama_Tindakan`, `Jenis_Bayar`) VALUES
-- (1111, '2024-01-11', 'Meninggal', 'BBLR', 'BPJS'),
-- (1212, '2024-03-06', 'Lahir', 'IUFD', 'Umum'),
-- (2222, '2024-02-07', 'Lahir', 'Ranap_Anak', 'Umum'),
-- (3232, '2024-02-06', 'Lahir', 'Ranap_Perina', 'Umum'),
-- (23232, '2024-01-05', 'Lahir', 'BBLR', 'Umum'),
-- (23233, '2024-01-14', 'Lahir', 'Ranap_Anak', 'BPJS'),
-- (23234, '2024-03-05', 'Lahir', 'Ranap_Perina', 'BPJS'),
-- (23235, '2023-12-14', 'Lahir', 'Ranap_Perina', 'BPJS'),
-- (23236, '2024-01-15', 'Lahir', 'IUFD', 'Umum'),
-- (23237, '2024-03-02', 'Meninggal', 'BBLR', 'BPJS'),
-- (23238, '2024-02-01', 'Lahir', 'Ranap_Anak', 'Umum');
-- --------------------------------------------------------
--
-- Table structure for table `vk`
--

CREATE TABLE `vk` (
  `ID_VK` int(11) NOT NULL,
  `Tanggal` date DEFAULT NULL,
  `Nama_Tindakan` enum('Operasi', 'Lab', 'RInap', 'Konsultasi') DEFAULT NULL,
  `RM_Pasien` varchar(255) DEFAULT NULL,
  `Jenis_Bayar` enum('BPJS', 'Umum') DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `vk`
--

-- INSERT INTO `vk` (`ID_VK`, `Tanggal`, `Nama_Tindakan`, `RM_Pasien`, `Jenis_Bayar`) VALUES
-- (1111, '2024-01-08', 'Lab', 'ps1', 'BPJS'),
-- (2222, '2024-02-21', 'Operasi', 'op1', 'BPJS'),
-- (3333, '2024-03-11', 'RInap', 'pl1', 'Umum'),
-- (4444, '2023-12-25', 'Konsultasi', 'pri1', 'Umum'),
-- (5555, '2023-12-08', 'Operasi', 'rgvds', 'Umum'),
-- (6666, '2024-01-10', 'Lab', 'gred', 'BPJS'),
-- (7777, '2024-03-02', 'Konsultasi', 'fgdf', 'Umum'),
-- (7786, '2023-09-01', 'Lab', 'eede', 'BPJS'),
-- (7788, '2024-01-10', 'Konsultasi', '2wew', 'BPJS'),
-- (7789, '2024-03-06', 'Konsultasi', 'sdas3', 'BPJS'),
-- (7790, '2024-01-03', 'RInap', 'asa3', 'BPJS');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangsal`
--
ALTER TABLE `bangsal`
ADD PRIMARY KEY (`ID_LB`);
--
-- Indexes for table `perina`
--
ALTER TABLE `perina`
ADD PRIMARY KEY (`ID_LP`);
--
-- Indexes for table `vk`
--
ALTER TABLE `vk`
ADD PRIMARY KEY (`ID_VK`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangsal`
--
ALTER TABLE `bangsal`
MODIFY `ID_LB` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12322;
--
-- AUTO_INCREMENT for table `perina`
--
ALTER TABLE `perina`
MODIFY `ID_LP` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 23239;
--
-- AUTO_INCREMENT for table `vk`
--
ALTER TABLE `vk`
MODIFY `ID_VK` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7791;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;