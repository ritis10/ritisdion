-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 21 Ιαν 2021 στις 20:59:00
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
CREATE DATABASE IF NOT EXISTS `auction` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `auction`;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) UNSIGNED NOT NULL COMMENT '(Bid) Id της προσφορας',
  `WhoDoes` int(5) UNSIGNED NOT NULL COMMENT 'Ποιο ID χρηστη εκανε την προσφορα',
  `SellerUsr` varchar(30) NOT NULL,
  `Amount` float NOT NULL COMMENT 'Ποσο προσφορας',
  `Address` varchar(100) NOT NULL,
  `productId` int(11) NOT NULL COMMENT 'Το id της δημοπρασιας που εγινε το χτυπημα',
  `status` tinyint(2) UNSIGNED NOT NULL COMMENT 'Status του χτυπηματος (πχ εκτος χρονου)',
  `when_` datetime DEFAULT NULL COMMENT 'Ημερομηνία Δημιουργίας Bid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`OrderId`, `WhoDoes`, `SellerUsr`, `Amount`, `Address`, `productId`, `status`, `when_`) VALUES
(1, 10002, 'danis', 810, 'Komninon 44,Serres', 1, 1, '2021-01-12 00:00:00'),
(2, 10002, 'danis', 940, 'Komninon 44,Serres', 1, 1, '2021-01-11 00:00:00'),
(3, 10002, 'danis', 1020, 'Komninon 44,Serres', 2, 1, '2021-01-04 00:00:00'),
(4, 10002, 'danis', 930, 'komninon 44,serres', 2, 1, '2021-01-06 00:00:00'),
(5, 10002, 'danis', 820, 'komninon 44,serres', 5, 1, '2021-01-14 00:00:00'),
(6, 10002, 'dionisis', 1000, 'dfbfhnhg', 2, 1, '2021-01-06 00:00:00'),
(7, 10002, 'dionisis', 1001, 'dhfgnghf', 2, 1, '2021-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `product`
--

CREATE TABLE `product` (
  `auctionId` int(11) NOT NULL COMMENT 'Id δημοπρασιας',
  `productName` varchar(255) NOT NULL COMMENT 'Ονομα του προιοντος',
  `minbid` int(11) NOT NULL COMMENT '(start price)  Τιμη εκκινησης του προιοντος',
  `owner` int(5) UNSIGNED NOT NULL COMMENT 'Σε ποιον ανηκει το αντικειμενο που δημοπρατειται',
  `descp` varchar(150) NOT NULL COMMENT 'Περιγραφη προιοντος',
  `currBid` float NOT NULL,
  `price_step` int(4) DEFAULT NULL COMMENT 'Το βήμα της τιμής για την προσφορα',
  `expiry` datetime DEFAULT NULL COMMENT '(start daytime) Ποτε ξεκινησε η δημοπρασια',
  `extensions` tinyint(1) NOT NULL COMMENT '(Allow etensions) Αν στην συγκεκριμενη δημοπρασια επιτρεπονται οι επεκτασεις χρονου',
  `Num_of_Extensions` int(255) NOT NULL COMMENT 'Ποσες επεκτασεις συνολικα',
  `Time_of_Extensions` int(255) NOT NULL COMMENT '(Extension duration) Χρονος της επεκτασης',
  `crucial_time` int(2) NOT NULL COMMENT 'Το τελευταίο διάστημα του χρόνου στο οποιο αν γίνει προσφορά δίνεται παράταση',
  `type` tinyint(1) NOT NULL COMMENT 'πλειοδοτικές ή μειοδοτικές',
  `last_extension` int(15) NOT NULL COMMENT 'η τελευταία παράταση που δόθηκε',
  `finished` tinyint(1) NOT NULL COMMENT 'μας δείχνει αν τελείωσε η δημοπρασία ή όχι'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `product`
--

INSERT INTO `product` (`auctionId`, `productName`, `minbid`, `owner`, `descp`, `currBid`, `price_step`, `expiry`, `extensions`, `Num_of_Extensions`, `Time_of_Extensions`, `crucial_time`, `type`, `last_extension`, `finished`) VALUES
(1, 'Apple iPhone 11 (64GB) Black', 1670, 10001, 'https://www.skroutz.gr/s/20060269/Apple-iPhone-11-64GB-Black.html#specs', 0, 5, '2021-04-01 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(2, 'Apple iPhone 11 Pro (64GB) Spa', 920, 10001, 'https://www.skroutz.gr/s/23117232/Apple-iPhone-11-Pro-64GB-Space-Gray.html', 0, 5, '2021-12-31 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(3, 'Apple iPhone SE 2020 (64GB) Bl', 1000, 10001, 'https://www.skroutz.gr/s/22815459/Apple-iPhone-SE-2020-64GB-Black.html', 0, 5, '2021-05-12 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(4, 'Apple iPhone 12 Mini (64GB) Bl', 1500, 10001, 'https://www.skroutz.gr/s/25223353/Apple-iPhone-12-Mini-64GB-Black.html', 0, 5, '2021-01-30 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(5, 'Xiaomi Poco F2 Pro (128GB) Cyb', 1110, 10001, 'https://www.skroutz.gr/s/23316298/Xiaomi-Poco-F2-Pro-128GB-Cyber-Gray.html?from=catspan', 0, 5, '2021-02-08 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(6, 'Huawei P20', 200, 10001, 'Mobile', 1001, 5, '2021-01-20 00:00:00', 1, 4, 3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT 'Status του λογαρισμου χρηστη',
  `approval_pom` int(10) UNSIGNED NOT NULL COMMENT 'O moderator η provider που έδωσε έγγριση',
  `approval_date` date DEFAULT NULL COMMENT 'Ημερομηνια Εγκρισης λογαριασμου',
  `username` varchar(15) DEFAULT NULL COMMENT 'Username χρηστη',
  `id` int(5) UNSIGNED NOT NULL COMMENT 'Μοναδικο id του χρηστη',
  `pass` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Κωδικος χρηστη',
  `first_name` varchar(12) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Βαπτιστικο ονομα χρηστη',
  `last_name` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Επιθετο χρηστη',
  `role` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL COMMENT 'Ημερομηνια γεννησης χρηστη',
  `address` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Διεθυνση κατοικιας',
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Διευθυνση ηλεκτρονικου ταχυδρομιου'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`status`, `approval_pom`, `approval_date`, `username`, `id`, `pass`, `first_name`, `last_name`, `role`, `dob`, `address`, `email`) VALUES
(3, 100, '2021-01-19', 'bill', 10001, '1', 'Βασίλης', 'Γεωργιάδης', 'buyer', '1993-12-05', 'Κομνηνών 44, Σέρρες', 'bilgeorgiadis@gmail.com'),
(3, 101, '2021-01-18', 'danis', 10002, '1', 'Ιορδάνης', 'Κεσούλης', 'seller', '1992-01-15', 'Κανάκη 3,Σέρρες', 'iordanis@gmail.com'),
(3, 101, '2021-01-18', 'dion', 10003, '1', 'Dionisis', 'Fanariotis', 'buyer', '1992-05-13', 'Κων/πολεως 12,Περιστέρι', 'dionfan10@gmail.com'),
(3, 102, '2021-01-18', 'Gio', 10004, '1', 'Giorgos', 'Ntertzis', 'seller', '1990-03-12', 'Αρκαδίας 23,Καισαριανή', 'gntertzis@gmail.com'),
(3, 100, '2021-01-18', 'ritis', 10005, '1', 'Margaritis', 'Tsirikas', 'buyer', '1994-04-23', 'Κομνηνών 30,Σέρρες', 'tsirikasm@gmail.com'),
(3, 100, '2021-01-18', 'dionisis', 10006, '1', 'Dionisis', 'Fanariotis', 'seller', '2021-01-13', 'Arkadiou 74', 'dionisis@hotmail.com'),
(3, 102, '2021-01-14', 'Efi', 10007, '1', 'Efi', 'Zerva', 'buyer', '2021-01-13', 'Arkadiou 74', 'efi@hotmail.com');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `WhoDoes` (`WhoDoes`),
  ADD KEY `productId` (`productId`),
  ADD KEY `status` (`status`);

--
-- Ευρετήρια για πίνακα `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`auctionId`),
  ADD KEY `owner` (`owner`),
  ADD KEY `type` (`type`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `approval_pom` (`approval_pom`),
  ADD KEY `id` (`id`);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`WhoDoes`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`auctionId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status`) REFERENCES `bid_status` (`b_status_id`);

--
-- Περιορισμοί για πίνακα `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`type`) REFERENCES `auction_types` (`a_type_id`);

--
-- Περιορισμοί για πίνακα `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `user_status` (`u_status_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`approval_pom`) REFERENCES `providerormoderator` (`pom_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
