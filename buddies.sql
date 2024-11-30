-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 10:29 AM
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
-- Database: `buddies`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_password`, `image`) VALUES
(1, 'Glen', 'devitglen@gmail.com', '123456', ''),
(3, 'admin', 'admin@gmail.com', 'admin123', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `date` datetime NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `lama_sewa` int(11) DEFAULT NULL,
  `total_bayar` decimal(10,2) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = "Sudah Bayar", 1 = "Mobil Diambil", 2 = "Mobil Dikembalikan", 3 = "Dibatalkan", 4 = "Selesai"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `address`, `date`, `tanggal_kembali`, `lama_sewa`, `total_bayar`, `foto_ktp`, `status`) VALUES
(69, 43, 15, 'mlati', '2024-11-16 00:00:00', '2024-12-01', 2, 500000.00, 'admin/uploads/Foto KTPBendera Indonesia.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pengecekan`
--

CREATE TABLE `pengecekan` (
  `id_perawatan` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal_perawatan` date NOT NULL,
  `perawatan_mesin` text DEFAULT NULL,
  `perawatan_ban` text DEFAULT NULL,
  `perawatan_oli` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengecekan`
--

INSERT INTO `pengecekan` (`id_perawatan`, `id_mobil`, `tanggal_perawatan`, `perawatan_mesin`, `perawatan_ban`, `perawatan_oli`) VALUES
(1, 43, '2024-11-19', 'oo', 'ioioi', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = "LCGC", 1 = "MPV"',
  `product_name` varchar(100) NOT NULL,
  `product_details` varchar(300) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `product_name`, `product_details`, `product_price`, `image`) VALUES
(43, 0, 'Toyota Agya', 'LCGC', '250000', 'uploads/1731586756_images-removebg-preview.png'),
(44, 1, 'Toyota Avanza Veloz', 'MPV', '300000', 'uploads/accessories/1731586822_Avanza-removebg-preview.png'),
(45, 1, 'Wuling Confero', 'Wuling', '300000', 'uploads/accessories/1731591124_Wuling-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_user` int(5) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `tanggal_rating` date NOT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_user`, `rating_value`, `tanggal_rating`, `review`) VALUES
(1, 0, 3, '2024-11-08', 'd'),
(2, 0, 1, '2024-11-08', 'jelek'),
(4, 0, 5, '2024-11-08', 'bagus sekali'),
(5, 0, 5, '2024-11-12', 'bagus\r\n'),
(6, 0, 4, '2024-11-13', 'dd'),
(7, 0, 4, '2024-11-13', 'd'),
(8, 0, 1, '2024-11-13', 'kontol banget'),
(9, 0, 3, '2024-11-13', 'jelek'),
(15, 0, 5, '2024-11-16', 'ddd'),
(16, 12, 3, '2024-11-16', 'ok'),
(17, 12, 5, '2024-11-16', 'bagus\r\n'),
(18, 12, 5, '2024-11-16', 'bagus sekali\r\n'),
(19, 15, 5, '2024-11-16', 'waw bagus banget\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `address`, `image`) VALUES
(11, 'fafa', 'fufu', 'ananta@gmail,com', 'fafa123', '082194983517', 'paingan', 'admin/uploads/profiles/1727266569_hq720_2.jpg'),
(12, 'a', 'aa', 'a@gmail.com', 'a1', '1', 'a', 'admin/uploads/profiles/1729859574_s.png'),
(15, 'Ananta', 'Teguh', 'anantateguhprakosa20@gmail.com', 'ananta123', '082194983517', 'Mlati', 'admin/uploads/profiles/1731749063_5c5afe3c0d7296e58b4441d087349e3a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengecekan`
--
ALTER TABLE `pengecekan`
  ADD PRIMARY KEY (`id_perawatan`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pengecekan`
--
ALTER TABLE `pengecekan`
  MODIFY `id_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
