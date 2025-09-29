-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2025 at 04:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin1', '215e4389c893376272f25ca047a982a2259c0fc7');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `pid` int(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 3, 6, 'Bakso Urat Jumbo', 25000, 2, 'bakso_urat.png'),
(2, 5, 4, 'Bakso Urat Telor', 25000, 1, 'Urat_Telor.png'),
(3, 5, 5, 'Bakso Urat Biasa', 18000, 5, 'bakso.png'),
(4, 6, 5, 'Mie Ayam', 12000, 1, 'Mie Ayam.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `order_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `order_type`) VALUES
(13, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Cash On Delivery', 'KOTA JAKARTA TIMUR, Jl.Harapan', 'Gado-gado (10000 x 1) - Rendang (13000 x 1) - ', 23000, '2025-07-08', 'pending', ''),
(14, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Dana/Ovo', 'KOTA JAKARTA TIMUR, Jl.Harapan', 'Bakso Urat Jumbo (25000 x 1) - ', 25000, '2025-07-09', 'Berhasil', ''),
(15, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Cash On Delivery', '', 'Bakso Urat Telor (25000 x 1) - ', 25000, '2025-07-14', 'pending', ''),
(16, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Cash On Delivery', 'KOTA JAKARTA TIMUR, Jl.Harapan', 'Mie Ayam Bakso Urat Biasa (20000 x 1) - ', 20000, '2025-07-14', 'pending', ''),
(17, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Cash On Delivery', '', 'Bakso Urat Telor (25000 x 1) - ', 25000, '2025-07-14', 'pending', ''),
(18, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Dana/Ovo', '', 'Mie Ayam Bakso Urat Jumbo (30000 x 1) - ', 30000, '2025-07-14', 'pending', 'dine-in'),
(19, 7, 'Rayhan Achmad ', '0896330923', 'varray28@gmail.com', 'Cash On Delivery', '', 'Oasis (3000 x 1) - ', 3000, '2025-07-14', 'Berhasil', 'dine-in');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Bakso Urat Jumbo', 'Makanan Pokok', 25000, 'bakso_urat.png'),
(2, 'Bakso Urat Telor', 'Makanan Pokok', 25000, 'Urat_Telor.png'),
(3, 'Bakso Urat Biasa', 'Makanan Pokok', 18000, 'bakso.png'),
(4, 'Bakso Telor', 'Makanan Pokok', 18000, 'Bakso_Telor.png'),
(5, 'Mie Ayam Bakso Urat Jumbo', 'Makanan Pokok', 30000, 'Mie Ayam Bakso Urat Jumbo.png'),
(6, 'Mie Ayam Bakso Kecil', 'Makanan Pokok', 18000, 'Mie Ayam Bakso Kecil.png'),
(7, 'Mie Ayam Bakso Urat Biasa', 'Makanan Pokok', 20000, 'Mie ayam Bakso Urat Biasa.png'),
(8, 'Mie Ayam', 'Makanan Pokok', 12000, 'Mie Ayam.png'),
(9, 'Nasi', 'Makanan Pokok', 3000, 'Nasi.png'),
(10, 'Oasis', 'Minuman', 3000, 'Oasis.png'),
(11, 'AQUA', 'Minuman', 4000, 'Aqua.png'),
(12, 'Teh Botol', 'Minuman', 5000, 'Teh Botol.png'),
(13, 'Es Teh Tawar', 'Minuman', 1000, 'Teh Tawar.png'),
(14, 'Es teh Manis', 'Minuman', 3000, '—Pngtree—hand drawn ice tea_8523459.png'),
(15, 'Es Jeruk', 'Minuman', 5000, 'Es Jeruk.png'),
(23, 'Kerupuk', 'Hidangan Penutup', 2000, 'Kerupuk.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(8, 'joon', 'varray28@gmail.com', '0896330923', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
