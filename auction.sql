-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 12 Ιαν 2021 στις 17:17:01
-- Έκδοση διακομιστή: 10.4.17-MariaDB
-- Έκδοση PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `auction`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `BuyerUsr` varchar(30) NOT NULL,
  `SellerUsr` varchar(30) NOT NULL,
  `Amount` float NOT NULL,
  `Address` varchar(100) NOT NULL,
  `productId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`OrderId`, `BuyerUsr`, `SellerUsr`, `Amount`, `Address`, `productId`, `Quantity`, `status`) VALUES
(1, 'bill', 'danis', 810, 'Komninon 44,Serres', 1, 3, 1),
(2, 'bill', 'danis', 940, 'Komninon 44,Serres', 3, 2, 1),
(3, 'bill', 'danis', 1020, 'Komninon 44,Serres', 4, 1, 1),
(4, 'bill', 'danis', 930, 'komninon 44,serres', 3, 5, 1),
(5, 'bill', 'danis', 820, 'komninon 44,serres', 1, 20, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `maxbid` float NOT NULL,
  `minbid` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `sellerUsr` varchar(30) NOT NULL,
  `descp` varchar(150) NOT NULL,
  `currBid` float NOT NULL,
  `expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `product`
--

INSERT INTO `product` (`productId`, `productName`, `maxbid`, `minbid`, `quantity`, `sellerUsr`, `descp`, `currBid`, `expiry`) VALUES
(1, 'Apple iPhone 11 (64GB) Black', 2530, 1670, 78, 'danis', 'https://www.skroutz.gr/s/20060269/Apple-iPhone-11-64GB-Black.html#specs', 0, '2021-04-01'),
(2, 'Apple iPhone 11 Pro (64GB) Spa', 1200, 920, 150, 'danis', 'https://www.skroutz.gr/s/23117232/Apple-iPhone-11-Pro-64GB-Space-Gray.html', 0, '2021-12-31'),
(3, 'Apple iPhone SE 2020 (64GB) Bl', 1930, 1000, 120, 'danis', 'https://www.skroutz.gr/s/22815459/Apple-iPhone-SE-2020-64GB-Black.html', 0, '2021-05-12'),
(4, 'Apple iPhone 12 Mini (64GB) Bl', 2520, 1500, 200, 'danis', 'https://www.skroutz.gr/s/25223353/Apple-iPhone-12-Mini-64GB-Black.html', 0, '2021-01-30'),
(5, 'Xiaomi Poco F2 Pro (128GB) Cyb', 1580, 1110, 46, 'danis', 'https://www.skroutz.gr/s/23316298/Xiaomi-Poco-F2-Pro-128GB-Cyber-Gray.html?from=catspan', 0, '2021-02-08');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `status` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `id` int(5) NOT NULL,
  `pass` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `role` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dob` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`status`, `approval_date`, `username`, `id`, `pass`, `first_name`, `last_name`, `role`, `dob`, `address`, `email`) VALUES
('active', '2021-01-02', 'bill', 10001, '3', 'Βασίλης', 'Γεωργιάδης', 'Buyer', '17/5/93', 'Κομνηνών 44, Σέρρες', 'bilgeorgiadis@gmail.com'),
('active', '2021-01-03', 'danis', 10002, '4', 'Ιορδάνης', 'Κεσούλης', 'Seller', '15/8/93', 'Κανάκη 3,Σέρρες', 'iordanis@gmail.com'),
('active', '2021-01-12', 'dion', 10003, '5', 'Dionisis', 'Fanariotis', 'svp', '14/8/92', 'Κων/πολεως 12,Περιστέρι', 'dionfan10@gmail.com'),
('active', '2021-01-12', 'Gio', 10004, '2', 'Giorgos', 'Ntertzis', 'Moderator', '29/02/90', 'Αρκαδίας 23,Καισαριανή', 'gntertzis@gmail.com'),
('active', '2021-01-12', 'ritis', 10005, '1', 'Margaritis', 'Tsirikas', 'Moderator', '23/4/94', 'Κομνηνών 30,Σέρρες', 'tsirikasm@gmail.com');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- Ευρετήρια για πίνακα `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productId` (`productId`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
