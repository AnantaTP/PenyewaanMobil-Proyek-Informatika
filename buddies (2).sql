-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2024 pada 08.15
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_password`, `image`) VALUES
(1, 'Glen', 'devitglen@gmail.com', '123456', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = "placed", 1 = "accepted", 2 = "dispatched", 3 = "cancelled", 4 = "received"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `address`, `date`, `status`) VALUES
(35, 11, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-05-31 06:52:29', 1),
(36, 17, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-05-31 06:55:28', 0),
(37, 17, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-05-31 06:59:38', 0),
(38, 11, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-05-31 01:41:58', 1),
(39, 24, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-05-31 02:51:34', 1),
(40, 11, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-06-01 04:23:40', 1),
(41, 11, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-06-06 04:26:49', 1),
(42, 12, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-06-06 04:26:49', 1),
(44, 11, 8, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-06-07 02:17:45', 0),
(45, 11, 8, NULL, '2024-06-07 19:17:56', NULL),
(46, 21, 10, 'JL Badak XVII, Kota Palangka Raya, Indonesia, 73112', '2024-06-07 03:21:31', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = "Produk", 1 = "Aksesoris"',
  `product_name` varchar(100) NOT NULL,
  `product_details` varchar(300) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `type`, `product_name`, `product_details`, `product_price`, `image`) VALUES
(11, 0, 'Shih Tzu  ', 'Shih Tzu DEWASA membantu mendukung ', 'Rp.500.000', 'uploads/1717126258_96da32805de4588208aa689730be860e.jpg'),
(12, 0, 'Makanan kucing', 'Whsikas adult 80gr kemasan pouch Kucing dengan usia 1-6 tahun membutuhkan banyak latihan dan bermain serta makanan yang seimbang untuk menjaganya tetap aktif dan sehat. Kucing adalah karnivora, sedangkan manusia , omnivora, jadi kucing membutuhkan 2 kali lebih banyak protein daripada manusia. ', 'Rp 120.000', 'uploads/1717126324_4db2f2aa0850cec70a1266caf2bb89fe.jpg'),
(18, 0, 'Taste of the wild', 'Beri anjing Anda sensasi rasa alami dengan Taste of the Wild High Prairie Grain-Free Dry Dog Food. Daging bison dan rusa panggang dicampur dengan buah dan sayuran pilihan untuk meniru pola makan yang dinikmati anjing Anda di alam liar. Formula bebas gandum ini memberikan energi yang mudah dicerna, a', 'Rp.999.900', 'uploads/1717132067_WhatsApp Image 2024-05-31 at 11.53.37.jpeg'),
(19, 0, 'Wellnes', 'Complete Health Grain Free Puppy menampilkan bahan-bahan alami plus nutrisi untuk anak anjing. Diformulasikan dengan campuran seimbang protein, karbohidrat bebas gandum, dan lemak pilihan, produk ini menyediakan energi yang dibutuhkan anak anjing Anda untuk berkembang.', 'Rp.46.000', 'uploads/1717132123_WhatsApp Image 2024-05-31 at 11.54.44.jpeg'),
(21, 0, 'Wellnes Core', 'makanan anjing', 'Rp.78.500', 'uploads/1717132199_WhatsApp Image 2024-05-31 at 11.55.35.jpeg'),
(23, 0, 'Doggyman', 'Doggyman 200 Ml Japanese Susu Anjing Low Fat Brand: DOGGYMAN', 'Rp34.900', 'uploads/1717132333_WhatsApp Image 2024-05-31 at 12.01.14.jpeg'),
(24, 0, 'Royal Canin', 'Royal Canin 2 Kg Susu Bubuk Anjing Pro Baby', 'Rp1.299.900', 'uploads/1717132376_WhatsApp Image 2024-05-31 at 12.01.50.jpeg'),
(25, 0, 'Papillon', 'Papillon 500 Ml Minuman Anjing Raw Goat Milk', 'Rp45.000', 'uploads/1717132453_WhatsApp Image 2024-05-31 at 12.03.00.jpeg'),
(26, 0, 'Zeal', 'Zeal 1 Ltr Susu Hewan Bebas Laktosa Ukuran Brand: ZEAL', 'Rp165.000', 'uploads/1717132496_WhatsApp Image 2024-05-31 at 12.03.08.jpeg'),
(28, 1, 'Tempat Makan', 'Mpets Tempat Makan Hewan Double Berdiri 800MI', 'Rp 159.920', 'uploads/accessories/1717158236_WhatsApp Image 2024-05-31 at 12.03.37.jpeg'),
(29, 1, 'Kalung Rantai Anjing', 'Pet Kingdom Kalung Rantai Anjing Adj Prcolor 2.5mm', 'Rp 55.200', 'uploads/accessories/1717158301_WhatsApp Image 2024-05-31 at 12.06.41.jpeg'),
(30, 1, 'Mainan Anjing Alpaca', 'Pawise Mainan Anjing Alpaca', 'Rp 87.120', 'uploads/accessories/1717158336_WhatsApp Image 2024-05-31 at 12.07.28.jpeg'),
(31, 1, 'Tas Hewan Peliharaan', 'Pet Kingdom Tas Hewan Peliharaan Square Space - Biru/kuning', 'Rp 500.000', 'uploads/accessories/1717158375_WhatsApp Image 2024-05-31 at 12.14.03.jpeg'),
(36, 0, 'Makanan kucing', 'ini adalah makanan kesayangan anda', 'Rp.8.900', 'uploads/1717765730_WhatsApp Image 2024-05-31 at 11.55.19.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_details`
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
-- Dumping data untuk tabel `user_details`
--

INSERT INTO `user_details` (`id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `address`, `image`) VALUES
(8, 'Glen', 'Devit', 'devitglen@gmail.com', '123456', '081346036894', 'JL Badak XVII', 'admin/uploads/profiles/1717126412_depositphotos_147439097-stock-photo-group-of-cute-dogs.jpg'),
(10, 'Glen', 'Devit Renaldi', 'devitglen@gmail.com', '123456', '081346036894', 'JL Badak XVII', 'admin/uploads/profiles/1717766380_com.mysql.jdbc.Blob@6b3f6298.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
