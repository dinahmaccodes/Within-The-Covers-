-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:22 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(21, 6, 'Clever Girl Finance by Bola Sokunbi', 18000, 1, 'Clever Girl Finance_ Ditch Debt, Save Money And Build Real ___.jpeg'),
(22, 7, 'Atomic Habits by James Clear', 13000, 1, 'Atomic Habits_ An Easy & Proven Way to Build Good Habits & Break Bad Ones.jpeg'),
(23, 7, 'Clever Girl Finance by Bola Sokunbi', 18000, 1, 'Clever Girl Finance_ Ditch Debt, Save Money And Build Real ___.jpeg'),
(24, 7, 'Americanah by Chimamanda Ngozi Adichie', 7800, 1, 'Americanah.jpeg'),
(27, 1, 'Atomic Habits by James Clear', 13000, 1, 'Atomic Habits_ An Easy & Proven Way to Build Good Habits & Break Bad Ones.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'Katherine', 'theeloiserosewood@gmail.com', '09021865748', 'Hello! Please can you add books about music and programing?\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 1, 'Katherine ', '09021865748', 'theeloiserosewood@gmail.com', 'debit card', '10 Ahmadu Bello Way, Sabon Gari 800283, Kaduna, Nigeria', 'The Wicked King (1), Americanah(1), Atomic Habits(2)', 35800, '22 April 2024', 'pending '),
(2, 1, 'Katherine', '09021865748', 'theeloiserosewood@gmail.com', 'bank transfer', 'flat no. 10, Ahmadu Bello Way, Sabon Gari 800283, Kaduna, Nigeria, Kaduna, Nigeria - 800283', ', Clever Girl Finance by Bola Sokunbi (1) , Creativity, Inc by Ed Catmull (1) ', 30000, '27-Apr-2024', 'pending ');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(3, 'The Wicked King by Holly Black ', 15000, 'The Wicked King (The Folk of the Air, 2).jpeg'),
(4, 'The Cruel Prince by Holly Black ', 16000, '11 Young Adult Fantasy Books Like Throne of Glass.jpeg'),
(5, 'Atomic Habits by James Clear', 13000, 'Atomic Habits_ An Easy & Proven Way to Build Good Habits & Break Bad Ones.jpeg'),
(6, 'Americanah by Chimamanda Ngozi Adichie', 7800, 'Americanah.jpeg'),
(7, 'Clever Girl Finance by Bola Sokunbi', 18000, 'Clever Girl Finance_ Ditch Debt, Save Money And Build Real ___.jpeg'),
(8, 'The Queen of Nothing by Holly Black', 18000, 'The Queen of Nothing~A Book Review ~ Author Arabella K_ Federico.jpeg'),
(9, 'The Game of Life and How to Play it by Florence ', 1300, 'Game of Life and How to Play It (Simple Success Guides).jpeg'),
(10, 'Creativity, Inc by Ed Catmull', 12000, '12 Books to Improve Your Business Skills _ business_com.jpeg'),
(11, 'Belladonna by Adalyn Grace', 17000, 'Belladonna (Belladonna, 1).jpeg'),
(12, 'The Mountain is You by Brianna ', 17000, 'The Mountain Is You_ Transforming Self-Sabotage Into Self-Mastery (English Edition).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `book_name` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `page_id`, `name`, `content`, `book_name`, `rating`, `submit_date`) VALUES
(1, 1, 'David Ogoh ', 'This Book is literally my new favorite! The words made me feel so sad yet happy at the same time! I can\'t recommend it enough ', 'Americanah', 5, '2024-01-24 18:46:04'),
(2, 1, 'Priscilla Ojo', 'This book is a life saver when it comes to Money and finance. His advice is amazing for beginners who want to learn the concept of saving and growing their money.', 'Rich Dad Poor Dad', 5, '2024-02-06 19:04:03'),
(3, 1, 'Jay Ibrahim', 'This book isn\'t what i would normally read but i enjoyed the political aspect of it. it\'s definitely a must-read. ', 'The Cruel Prince', 5, '2024-02-29 19:04:03'),
(4, 0, 'Katherine', 'I loved the book The Cruel Prince! It was so fascinating. The politics involved had me hooked from beginning to end. The Female Character is literally so interesting. I definitely recommend this to anyone interested to fantasy with a mix of politics. ', 'Cruel Prince', 4, '2024-05-04 19:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Katherine', 'theeloiserosewood@gmail.com', '1234', 'user'),
(2, 'Khloe', 'dee96914@gmail.com', 'n6789', 'admin'),
(3, 'Cameron', 'h65dee@gmail.com', '45678', 'admin'),
(6, 'Malik', 'h65dee@gmail.com', '3210', 'user'),
(7, 'Raphael', 'dinahmacaulay02@gmail.com', '3210', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `review`
--
ALTER TABLE `review`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
