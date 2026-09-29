-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2016 at 07:10 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `telp`, `password`) VALUES
('12345', 'Ibu Pelanggan cantik', 'Jl. Sore-Sore Ds. Suka Senang Kec. Pada suka Kab. Karawang', '081200000', '794c04970e1c65d82f695ac08a8a1cbd');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE IF NOT EXISTS `pesanan_detail` (
  `kodepesan` varchar(8) NOT NULL,
  `idbarang` varchar(8) NOT NULL,
  `hrgbeli` double NOT NULL,
  `hrgjual` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`kodepesan`, `idbarang`, `hrgbeli`, `hrgjual`, `qty`) VALUES
('4IED1', 'B0000006', 1450000, 1500000, 1),
('4IED1', 'B0000005', 50000, 75000, 3),
('4IED1', 'B0000008', 150000, 185000, 1),
('G1HFA', 'B0000007', 175000, 215000, 1),
('G1HFA', 'B0000005', 50000, 75000, 1),
('I6PHX', 'B0000008', 150000, 185000, 1),
('I6PHX', 'B0000007', 175000, 215000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_header`
--

CREATE TABLE IF NOT EXISTS `pesanan_header` (
  `kodepesan` varchar(8) NOT NULL,
  `tglpesan` date NOT NULL,
  `jampesan` time NOT NULL,
  `id_member` varchar(10) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_header`
--

INSERT INTO `pesanan_header` (`kodepesan`, `tglpesan`, `jampesan`, `id_member`, `status`) VALUES
('4IED1', '2016-03-29', '01:40:42', '12345', 'Final Check');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pesanan_header`
--
ALTER TABLE `pesanan_header`
  ADD PRIMARY KEY (`kodepesan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
