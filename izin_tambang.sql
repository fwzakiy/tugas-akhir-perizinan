-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2018 at 01:44 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `izin_tambang`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `permohonan_id` int(11) NOT NULL,
  `jenis_file` varchar(50) NOT NULL,
  `status_file` tinyint(1) NOT NULL DEFAULT '0',
  `extension` varchar(5) NOT NULL DEFAULT 'pdf'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`permohonan_id`, `jenis_file`, `status_file`, `extension`) VALUES
(3, 'pemegang_saham', 0, 'pdf'),
(4, 'pemegang_saham', 0, 'pdf'),
(4, 'peta_coordinat', 0, 'pdf'),
(4, 'surat_permohonan', 0, 'pdf'),
(10, 'pemegang_saham', 0, 'pdf'),
(10, 'peta_coordinat', 0, 'pdf'),
(10, 'surat_permohonan', 0, 'pdf'),
(16, 'pemegang_saham', 0, 'pdf'),
(16, 'peta_coordinat', 0, 'pdf'),
(16, 'surat_permohonan', 0, 'pdf'),
(17, 'pemegang_saham', 0, 'pdf'),
(17, 'peta_coordinat', 0, 'pdf'),
(17, 'surat_permohonan', 0, 'pdf'),
(18, 'pemegang_saham', 0, 'pdf'),
(18, 'peta_coordinat', 0, 'pdf'),
(18, 'surat_permohonan', 0, 'pdf'),
(28, 'pemegang_saham', 0, 'pdf'),
(28, 'peta_coordinat', 0, 'pdf'),
(28, 'surat_permohonan', 0, 'docx'),
(30, 'pemegang_saham', 0, 'docx'),
(30, 'peta_coordinat', 0, 'docx'),
(30, 'surat_permohonan', 0, 'docx'),
(31, 'pemegang_saham', 0, 'doc'),
(31, 'peta_coordinat', 0, 'docx'),
(31, 'surat_permohonan', 0, 'docx'),
(32, 'pemegang_saham', 0, 'pdf'),
(32, 'peta_coordinat', 0, 'pdf'),
(32, 'surat_permohonan', 0, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_file`
--

CREATE TABLE `jenis_file` (
  `jenis_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_file`
--

INSERT INTO `jenis_file` (`jenis_file`) VALUES
('pemegang_saham'),
('peta_coordinat'),
('surat_permohonan');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `permohonan_id` int(11) NOT NULL,
  `nama_permohonan` varchar(75) NOT NULL,
  `username` varchar(25) NOT NULL,
  `status_permohonan` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_terbit` date DEFAULT NULL,
  `jenis_permohonan` enum('eksplorasi','produksi') NOT NULL,
  `alasan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`permohonan_id`, `nama_permohonan`, `username`, `status_permohonan`, `tanggal_terbit`, `jenis_permohonan`, `alasan`) VALUES
(1, 'Izin tambang tempat A', 'tegar', 0, NULL, 'eksplorasi', NULL),
(2, 'Izin tambang B', 'tegar', 0, NULL, 'eksplorasi', NULL),
(3, 'asdas', 'tegar', 0, NULL, 'eksplorasi', NULL),
(4, 'asdas', 'tegar', 0, NULL, 'eksplorasi', NULL),
(10, 'asdasdas', 'tegar', 0, NULL, 'eksplorasi', NULL),
(12, 'qwdwad', 'tegar', 0, NULL, 'eksplorasi', NULL),
(13, 'y4euy', 'tegar', 0, NULL, 'eksplorasi', NULL),
(14, '13123', 'tegar', 0, NULL, 'eksplorasi', NULL),
(15, '13123', 'tegar', 0, NULL, 'eksplorasi', NULL),
(16, '13123asdas', 'tegar', 0, NULL, 'eksplorasi', NULL),
(17, 'tegarerea', 'tegar', 0, NULL, 'eksplorasi', NULL),
(18, 'asdas', '1110962009', 2, NULL, 'eksplorasi', 'Fuck you that is awhy..'),
(28, 'knjn', '1110962009', 1, NULL, 'eksplorasi', NULL),
(30, 'asdas', '1110962009', 2, NULL, 'eksplorasi', 'nhjkj'),
(31, '1234556', '1110962009', 1, NULL, 'eksplorasi', NULL),
(32, 'lalalal', 'tegar', 2, NULL, 'produksi', 'Karna kamu cantik');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(16) NOT NULL,
  `nama_perusahaan` varchar(250) NOT NULL,
  `npwp_perusahaan` varchar(15) NOT NULL,
  `nama_direktur` varchar(50) NOT NULL,
  `alamat_perusahaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_perusahaan`, `npwp_perusahaan`, `nama_direktur`, `alamat_perusahaan`) VALUES
('1110962009', 'qwerty', '', '', '', ''),
('tegar', '1234', 'perusahaan tegar', '111111111111111', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`permohonan_id`,`jenis_file`);

--
-- Indexes for table `jenis_file`
--
ALTER TABLE `jenis_file`
  ADD PRIMARY KEY (`jenis_file`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`permohonan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `permohonan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
