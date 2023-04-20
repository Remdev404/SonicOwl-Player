-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 11, 2023 at 01:18 PM
-- Server version: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004-log
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `player`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `user_id`, `track_id`) VALUES
(53, 13, 33),
(58, 13, 30),
(60, 15, 20),
(62, 13, 31),
(63, 13, 26),
(64, 13, 17),
(66, 13, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `album` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `album_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `author`, `album`, `genre`, `album_cover`) VALUES
(10, '2 Of Amerikaz Most Wanted.mp3', '2Pac (feat. Snoop Dogg)', 'All Eyez On Me', '1', 'alleyezonme.jpeg'),
(11, 'Amarillo By Morning.mp3', 'George Strait', 'Strait from the Heart', '4', 'Straitfromtheheart.jpg'),
(12, 'Any Ole Sunday.mp3', 'Mr. X', 'Any Ole Sunday', '3', 'anyolesunday.jpg'),
(13, 'C\'est Si Bon.mp3', 'Conway Twitty', 'It\'s So Good', '4', 'cestsibon.jpg'),
(14, 'Check Yo Self.mp3', 'Ice Cube', 'Check Yo Self', '1', 'checkyoself.jpg'),
(15, 'Coward Of The County.mp3', 'Kenny Rogers', 'Daytime Friends', '4', 'daytimefriends.jpg'),
(16, 'Down In Mexico.mp3', 'The Coasters', 'Down In Mexico', '4', 'downinmexico.jpg'),
(17, 'Flowers On The Wall.mp3', 'The Statler Brothers', 'Flowers On The Wall', '4', 'flowersonthewall.jpg'),
(18, 'Goodbye Horses.mp3', 'Q Lazzarus', 'Goodbye Horses', '3', 'goodbyehorses.jpg'),
(19, 'Hit\'em Up.mp3', '2Pac', 'Greatest Hits', '1', 'greatesthits.jpg'),
(20, 'I Miss You.mp3', 'DMX (feat. Faith Evans)', 'The Great Depression', '1', 'thegreatdepression.jpg'),
(21, 'Ilomilo (Mbnn Remix).mp3', 'Billie Eilish (MBNN Remix)', 'Ilomilo', '2', 'ilomilo.jpg'),
(22, 'It\'s Only Love.mp3', 'Barry White', 'The Ultimate Collection', '3', 'theultimatecollection.jpg'),
(23, 'Miss You.mp3', 'Oliver Tree (feat. Robin Shulz)', 'Miss You', '2', 'missyou.jpg'),
(24, 'Ne Uletaj.mp3', 'Djozzi (DJ Nejtrino Remix)', 'Ne Uletaj', '2', 'neuletaj.jpg'),
(25, 'Players.mp3', 'Coi Leray', 'Players', '2', 'players.jpg'),
(26, 'Push It To The Limit.mp3', 'Paul Engemann', 'Scarface', '3', 'scarfaceOST.jpg'),
(27, 'She\'s Like The Wind.mp3', 'Patrick Swayze', 'Dirty Dancing', '3', 'dirtydancing.jpg'),
(28, 'Snap.mp3', 'Rosa Linn', 'SNAP', '2', 'snap.jpg'),
(29, 'Still Dre.mp3', 'Dr. Dre (feat. Snoop Dogg)', '2001', '1', '2001.jpg'),
(30, 'Stuck In The Middle With You.mp3', 'Stealers Wheel', 'The Hits Collection', '3', 'thehitscollection.jpg'),
(31, 'Sugar.mp3', 'Ya Nina', 'Sugar', '2', 'sugar.jpg'),
(32, 'Take Me Home (Country Roads).mp3', 'John Denver', 'The John Denver Collection', '4', 'thejohndenvercollection.jpg'),
(33, 'The Vapors.mp3', 'Biz Markie', 'Vapors', '1', 'vapors.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`) VALUES
(13, 'gueram', 'geram.hov@gmail.com', '123', '63f7261904e278.78452638.jpeg'),
(14, 'babayaga', 'baba@yaga.com', '123', '63fb8c1bc886f9.17284341.jpeg'),
(16, 'alexendre', 'alex@gmail.com', '123', '63fca2b7c205a1.22015181.jpg'),
(17, 'remy', 'remdev@remdev.com', '123', '63fca3ba3aa4d8.16578698.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
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
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
