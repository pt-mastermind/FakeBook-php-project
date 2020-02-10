-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: נובמבר 17, 2019 בזמן 05:59 PM
-- גרסת שרת: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `blogp`
--

CREATE TABLE `blogp` (
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_data` varchar(10000) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tdate` varchar(50) NOT NULL,
  `heading` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `blogp`
--

INSERT INTO `blogp` (`blog_id`, `user_id`, `blog_data`, `username`, `tdate`, `heading`) VALUES
(49, 5, 'The basic principle behind ARP spoofing is to exploit the lack of authentication in the ARP protocol by sending spoofed ARP messages onto the LAN. ARP spoofing attacks can be run from a compromised host on the LAN, or from an attacker\'s machine that is connected directly to the target LAN.  Generally, the goal of the attack is to associate the attacker\'s host MAC address with the IP address of a target host, so that any traffic meant for the target host will be sent to the attacker\'s host. The attacker may choose to inspect the packets (spying), while forwarding the traffic to the actual default destination to avoid discovery, modify the data before forwarding it (man-in-the-middle attack), or launch a denial-of-service attack by causing some or all of the packets on the network to be dropped', 'liav', 'Nuv 15 2019', 'Arp Spoofing '),
(51, 5, 'Cross-Site Scripting is a vulnerability that allows an attacker to execute his own code on your website. The interesting part of this attack is that most of the attack happens from the clientâ€™s browser.', 'liav', 'Nuv 16 2019', 'XSS'),
(52, 5, 'CSRF is a vulnerability where the attacker attempt to do a request on behave of an authenticated user. This attack might be even more serious than XSS and is harder to prevent.', 'liav', 'nuv 17 2019', 'CSRF');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `post_data` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_data`, `username`) VALUES
(31, 5, 'hi everyone i\'m using fakebook!', 'liav'),
(32, 6, 'hi liav, how are you? can u please tell me the difference between CSRF and XSS?', 'lior'),
(34, 5, 'sure, CSRF vs XSS XSS - you can insert your code into the website, and in CSRF - you can make legitimate requests from an already authenticated user to the website on his behalf.', 'liav');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'liav', '1234'),
(2, 'lior', '1234');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `blogp`
--
ALTER TABLE `blogp`
  ADD PRIMARY KEY (`blog_id`);

--
-- אינדקסים לטבלה `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogp`
--
ALTER TABLE `blogp`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
