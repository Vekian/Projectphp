-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 24, 2023 at 08:12 AM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Spotisma`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `nameAlbum` varchar(50) NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `nameAlbum`, `cover`) VALUES
(1, 'Queen Hits', '/images/1601928_1_l.jpg'),
(2, 'JuL Hits', '/images/jul-ses-fans-choisissent-la-cover-de-c-est-quand-qu-il-s-eteint_64563340cce77.jpg'),
(3, 'Michael Jackson Hits', '/images/MJThriller25PRESSresize.jpg'),
(4, 'The Night Flight Orchestra Hits', '/images/1750.jpg'),
(5, 'Tubes Variété française ', '/images/chanson-française-500x321.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` varchar(300) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `id_user`, `id_song`) VALUES
(1, 'Tarpin un son de barje !\n', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `id_user`) VALUES
(1, 'Rap', 1),
(2, 'Rock', 1),
(3, 'Pop', 1),
(4, 'Variété Française', 1),
(5, 'Disney', 2);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `id` int(11) NOT NULL,
  `id_song` int(11) NOT NULL,
  `id_album` int(11) DEFAULT NULL,
  `id_playlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_songs`
--

INSERT INTO `playlist_songs` (`id`, `id_song`, `id_album`, `id_playlist`) VALUES
(1, 6, 2, 1),
(2, 7, 2, 1),
(3, 8, 2, 1),
(4, 9, 2, 1),
(5, 1, 1, 2),
(6, 2, 1, 2),
(7, 3, 1, 2),
(8, 4, 1, 2),
(9, 14, 4, 2),
(10, 15, 4, 2),
(11, 12, 3, 3),
(13, 13, 3, 3),
(14, 11, 3, 3),
(15, 10, 3, 3),
(16, 18, 5, 4),
(17, 17, 5, 4),
(18, 16, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `nameSong` varchar(60) NOT NULL,
  `file` varchar(255) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `artist` varchar(30) NOT NULL,
  `id_album` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `nameSong`, `file`, `cover`, `artist`, `id_album`) VALUES
(1, 'We Are The Champions', '/musics/Queen - We Are The Champions (Live Aid 1985).mp3', '/images/1601928_1_l.jpg', 'Queen', 1),
(2, 'Radio Ga-Ga', '/musics/Queen - Radio Ga Ga (Live Aid 1985).mp3', '/images/1601928_1_l.jpg', 'Queen', 1),
(3, 'I Want to Break Free', '/musics/Queen - I want to Break Free - Wembley 1986.mp3', '/images/1601928_1_l.jpg', 'Queen', 1),
(4, 'Bohemian Rhapsody', '/musics/Queen – Bohemian Rhapsody (Official Video Remastered).mp3', '/images/1601928_1_l.jpg', 'Queen', 1),
(5, 'Another One Bites The Dust', '/musics/Queen - Another One Bites the Dust (Official Video).mp3', '/images/1601928_1_l.jpg', 'Queen', 1),
(6, 'Alors la zone', '/musics/JuL - Alors la zone _ Clip Officiel _ 2021.mp3', '/images/jul-ses-fans-choisissent-la-cover-de-c-est-quand-qu-il-s-eteint_64563340cce77.jpg', 'JuL', 2),
(7, 'Entrainement', '/musics/JuL - Entrainement Clip officiel 2023.mp3', '/images/jul-ses-fans-choisissent-la-cover-de-c-est-quand-qu-il-s-eteint_64563340cce77.jpg', 'JuL', 2),
(8, 'JCVD', '/musics/Jul - JCVD Clip Officiel 2019.mp3', '/images/jul-ses-fans-choisissent-la-cover-de-c-est-quand-qu-il-s-eteint_64563340cce77.jpg', 'JuL', 2),
(9, 'On m\'appelle l\'OVNI', '/musics/Jul - On Mappelle Lovni Clip Officiel 2016.mp3', '/images/jul-ses-fans-choisissent-la-cover-de-c-est-quand-qu-il-s-eteint_64563340cce77.jpg', 'JuL', 2),
(10, 'We Are The World', '/musics/Michael Jackson - We Are The World (HQ).mp3', '/images/MJThriller25PRESSresize.jpg', 'Michael Jackson', 3),
(11, 'Billie Jean', '/musics/Billie Jean.mp3', '/images/MJThriller25PRESSresize.jpg', 'Michael Jackson', 3),
(12, 'Thriller', '/musics/Michael Jackson - Thriller (Official 4K Video).mp3', '/images/MJThriller25PRESSresize.jpg', 'Michael Jackson', 3),
(13, 'Beat It', '/musics/Michael Jackson - Beat It (Official 4K Video).mp3', '/images/MJThriller25PRESSresize.jpg', 'Michael Jackson', 3),
(14, 'Midnight Flyer', '/musics/THE NIGHT FLIGHT ORCHESTRA - Midnight Flyer (OFFICIAL LYRIC VIDEO).mp3', '/images/1750.jpg', 'THE NIGHT FLIGHT ORCHESTRA', 4),
(15, 'This Time', '/musics/THE NIGHT FLIGHT ORCHESTRA - This Time (OFFICIAL MUSIC VIDEO).mp3', '/images/1750.jpg', 'THE NIGHT FLIGHT ORCHESTRA', 4),
(16, 'Mistral Gagnant', '/musics/Renaud - Mistral gagnant (Clip officiel).mp3', '/images/chanson-française-500x321.jpg', 'Renaud', 5),
(17, 'L\'envie', '/musics/Johnny Hallyday - L’envie (Audio Officiel).mp3', '/images/chanson-française-500x321.jpg', 'Johnny Hallyday', 5),
(18, 'Vivre pour le meilleur', '/musics/Johnny Hallyday - Vivre Pour Le Meilleur (Clip Officiel Remasterisé)(1).mp3', '/images/chanson-française-500x321.jpg', 'Johnny Hallyday', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `admin`) VALUES
(1, 'Isma', 1),
(2, 'Mathieu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_song` (`id_song`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_song` (`id_song`),
  ADD KEY `playlist_to_album` (`id_album`),
  ADD KEY `id_playlist` (`id_playlist`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_album` (`id_album`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_to_song` FOREIGN KEY (`id_song`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_to_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `user_to_playlist` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `playlist_to_album` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_to_playlist` FOREIGN KEY (`id_playlist`) REFERENCES `playlists` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_to_song` FOREIGN KEY (`id_song`) REFERENCES `songs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `album_to_song` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;