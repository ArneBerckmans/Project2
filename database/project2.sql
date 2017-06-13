-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 jun 2017 om 23:16
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `moods`
--

CREATE TABLE `moods` (
  `moodID` int(11) NOT NULL,
  `moods` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `moods`
--

INSERT INTO `moods` (`moodID`, `moods`, `color`) VALUES
(1, 'Happy', '#6eea8b'),
(2, 'Angry', '#ed4850'),
(3, 'Dissappointed', '#eaa149'),
(4, 'Confused', '#efe265'),
(5, 'Proud', '#ea49ea'),
(6, 'Sad', '#49c4ea');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `postsmoodi`
--

CREATE TABLE `postsmoodi` (
  `id` int(11) NOT NULL,
  `moodID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `postsmoodi`
--

INSERT INTO `postsmoodi` (`id`, `moodID`, `userID`) VALUES
(1, 2, 8),
(2, 3, 8),
(3, 1, 8),
(4, 2, 8),
(5, 1, 8),
(6, 2, 8),
(7, 3, 8),
(8, 2, 8),
(9, 4, 8),
(10, 2, 8),
(11, 2, 8),
(12, 3, 8),
(13, 2, 8),
(14, 5, 8),
(15, 6, 8),
(16, 3, 8),
(17, 1, 8),
(18, 6, 8),
(19, 1, 8),
(20, 5, 8),
(21, 1, 8),
(22, 5, 16),
(23, 5, 16);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `poststwitter`
--

CREATE TABLE `poststwitter` (
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userID` int(255) NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profileImage` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `profileImage`) VALUES
(8, 'test7', '$2y$12$hya3zS9bOFvg6TrVwRYZUesuf8lFTTYUikPZeXURf..vnzqGywBfq', 'test@telenet.be', 'upload/profilePics/8.jpg'),
(9, 'arne', '$2y$12$9IAHGPukE7hB6GoZRzamdeydldIEBk6.S7mEBPtOEtbrEEyjLN/.G', 'arneberckmans@telenet.be', 'https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg'),
(10, 'test', '$2y$12$2blBoziVuIwqinMpN/3jRucRFPCC4QDsA7Fe4zu4wLsynvHtdnonO', 'test@hotmail.com', 'https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg'),
(12, 'test2', '$2y$12$eu2qQDVfsQ4hHNMMJ34wueyo0d1MqoGxsM2qF.KiuntZMA6bQjq86', 'testt@telenet.be', 'https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg'),
(15, 'test9', '$2y$12$IPmdfgt8jgiIPMy9cIcl3.QEoqTji0wComhnVlHSgU76bY7MiFsDK', 'test1@telenet.be', 'https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg'),
(16, 'test10', '$2y$12$gVtAtum5o1bQRr2MCWXMzerELdFs6/p5lZR5SVrIOcu5Xuu/5Y0zK', 'testt1@telenet.be', 'upload/profilePics/16.jpg'),
(17, 'tesst', '$2y$12$omEotB1g2lrnTzrBe22v5OXScKuVa21MLhyP8jcEg2ucDHb502NzW', 'r0449453@student.thomasmore.be', 'upload/profilePics/17.jpg'),
(18, 'Dinges', '$2y$12$WlI3bESiTKvk6AhXKgpqF.kG7rtNYtPMtJ1h4IVHcm34NwF/K/V4e', 'arneberckmans2@telenet.be', 'https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg'),
(21, 'aren', '$2y$12$lh5xr2OwviAds8JgqojCauV.fnLu/bh00DvnHe0zRp7qccOy9w0/.', 'arneberckmanss@telenet.be', './img/PlaceholderImage.png');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`moodID`);

--
-- Indexen voor tabel `postsmoodi`
--
ALTER TABLE `postsmoodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `moods`
--
ALTER TABLE `moods`
  MODIFY `moodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `postsmoodi`
--
ALTER TABLE `postsmoodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
