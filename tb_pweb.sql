-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 05:54 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb_pweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `absensi_id` int(11) NOT NULL,
  `krs_id` int(11) NOT NULL,
  `pertemuan_id` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `durasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(50) NOT NULL,
  `kode_matkul` varchar(50) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kode_kelas`, `kode_matkul`, `nama_matkul`, `tahun`, `semester`, `sks`) VALUES
(1, 'TSI02 A', 'TSI02', 'Kesenian', 2018, 1, 2),
(2, 'KLS02', 'TSI02', 'PWEB', 2021, 2, 3),
(3, 'KLS03', 'TSI07', 'Arsitektur dan Organisasi Komputer', 2019, 2, 3),
(4, 'TSI02 B', 'TSI0B', 'Matematika Diskrit', 2019, 1, 3),
(5, 'MPK1001 B', 'MPK1001', 'Kalkulus', 2020, 2, 4),
(6, 'KLS04A', 'KLS04', 'Bahasa Inggris', 2023, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `krs_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`krs_id`, `kelas_id`, `mahasiswa_id`) VALUES
(3, 6, 16),
(4, 6, 18),
(5, 3, 16),
(6, 3, 19),
(7, 3, 17),
(8, 3, 18),
(9, 4, 18),
(10, 4, 17),
(11, 1, 19),
(12, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipe` int(100) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `email`, `tipe`, `password`) VALUES
(15, 'Annisha', '123456789', 'annisha@gmail.com', 1, 123),
(16, 'Fadhilla Islamita Putri', '1911523016', 'fadhilla@gmail.com', 2, 123),
(17, 'Lisca Angriani', '1911521012', 'lisca@gmail.com', 2, 123),
(18, 'Dewi Kartika', '1911522016', 'dewi@gmail.com', 2, 123),
(19, 'Ufa Aurora Guciano', '1911522018', 'ufa@gmail.com', 2, 123);

-- --------------------------------------------------------
