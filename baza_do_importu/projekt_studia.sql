-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Cze 2021, 20:10
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_studia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `id_nick` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`id`, `id_nick`) VALUES
(3, 5),
(4, 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_category` int(11) NOT NULL,
  `cash` int(11) DEFAULT 0,
  `img` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `cars`
--

INSERT INTO `cars` (`id`, `name`, `id_category`, `cash`, `img`) VALUES
(7, 'test', 2, 142, 'https://vignette.wikia.nocookie.net/gtawiki/images/8/8f/Jugular-GTAO-FrontQuarter.png/revision/latest?cb=20190725181421'),
(8, '190Z', 3, 200, 'https://images-ext-1.discordapp.net/external/rQFpWslYDI5otQYy66sOL_dYe47iaVAyYVwqNwjjy-8/%3Fcb%3D20190210173515/https/vignette.wikia.nocookie.net/gtawiki/images/5/54/190z-GTAO-FrontQuarter.png/revision/latest?width=400&height=225'),
(9, '8F Drafter', 1, 420, 'https://vignette.wikia.nocookie.net/gtawiki/images/d/d5/8FDrafter-GTAO-FrontQuarter.png/revision/latest?cb=20190724092114'),
(10, '9F', 1, 500, 'https://vignette.wikia.nocookie.net/gtawiki/images/0/06/9F-GTAV-FrontQuarter.png/revision/latest?cb=20180421101812'),
(11, 'Adder', 10, 666, 'https://vignette.wikia.nocookie.net/gtawiki/images/0/02/Adder-GTAV-FrontQuarter.png/revision/latest?cb=20180527095249'),
(12, 'Akuma', 6, 333, 'https://vignette.wikia.nocookie.net/gtawiki/images/d/d7/Akuma-GTAV-FrontQuarter.png/revision/latest?cb=20190309193603'),
(13, 'Albany V-STR', 8, 444, 'https://vignette.wikia.nocookie.net/gtawiki/images/8/86/VSTR-GTAO-FrontQuarter.png/revision/latest?cb=20191214103055'),
(14, 'Alpha', 9, 500, 'https://cs3.gtaall.com/attachments/2015-06/original/d6f4849d87fcc648af8630257a5d2c89e0374031/4421-gta5-alpha-front.jpg'),
(15, 'Asbo', 4, 266, 'https://vignette.wikia.nocookie.net/gtawiki/images/6/69/Asbo-GTAO-FrontQuarter.png/revision/latest?cb=20191214082356'),
(16, 'Asea', 8, 307, 'https://vignette.wikia.nocookie.net/gtawiki/images/5/58/Asea-GTAV-front.png/revision/latest/scale-to-width-down/1000?cb=20160406180243'),
(17, 'Asterope', 8, 245, 'https://vignette.wikia.nocookie.net/gtawiki/images/4/43/Asterope-GTAV-FrontQuarter.png/revision/latest?cb=20180408160242'),
(18, 'Avarus', 6, 777, 'https://vignette.wikia.nocookie.net/gtawiki/images/f/f2/Avarus-GTAO-FrontQuarter.png/revision/latest?cb=20161007174507'),
(19, 'Bagger', 6, 645, 'https://vignette.wikia.nocookie.net/gtawiki/images/1/10/Bagger-GTAV-front.png/revision/latest?cb=20160121202520'),
(21, 'Jugular', 9, 150, 'https://vignette.wikia.nocookie.net/gtawiki/images/8/8f/Jugular-GTAO-FrontQuarter.png/revision/latest?cb=20190725181421');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Coupe'),
(2, 'Furgonetki'),
(3, 'Klasyki sportowe'),
(4, 'Kompakty'),
(5, 'Limuzyna'),
(6, 'Motocykle'),
(7, 'Muscle'),
(8, 'Sedany'),
(9, 'Sportowe'),
(10, 'Supersamochody'),
(11, 'SUV-y'),
(12, 'Terenowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_nick` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `id_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `id_nick`, `comment`, `id_name`) VALUES
(18, 4, ':D', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `engine`
--

CREATE TABLE `engine` (
  `id` int(11) NOT NULL,
  `id_name` int(11) NOT NULL,
  `engine` varchar(50) NOT NULL,
  `v_max` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `engine`
--

INSERT INTO `engine` (`id`, `id_name`, `engine`, `v_max`) VALUES
(334, 21, '2.0', 180),
(335, 21, '3.0 v8', 220),
(336, 7, '1.9 v8', 220),
(337, 8, '2.4', 170),
(338, 9, '1.5', 142),
(339, 9, '1.5', 142),
(340, 10, '1.8', 155),
(341, 11, '2.4', 200),
(342, 12, '1000cc', 182),
(343, 13, '2.0', 177),
(344, 14, '2.4', 222),
(345, 15, '2.2', 222),
(346, 16, '1.4', 144),
(347, 17, '1.8', 100),
(348, 18, '1000cc', 72),
(349, 19, '1000cc', 232);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `package` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `packages`
--

INSERT INTO `packages` (`id`, `package`, `cost`) VALUES
(4, 'standardowy', 0),
(5, 'premium', 500),
(6, 'premium +', 1000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rents`
--

CREATE TABLE `rents` (
  `id` int(11) NOT NULL,
  `id_nick` int(11) NOT NULL,
  `days` int(11) NOT NULL DEFAULT 1,
  `id_package` int(11) NOT NULL DEFAULT 1,
  `id_cars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rents`
--

INSERT INTO `rents` (`id`, `id_nick`, `days`, `id_package`, `id_cars`) VALUES
(13, 13, 1, 4, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `cash` int(11) DEFAULT 5000,
  `email` varchar(100) NOT NULL,
  `email_key` varchar(100) DEFAULT NULL,
  `validation` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nick`, `pass`, `cash`, `email`, `email_key`, `validation`) VALUES
(4, 'Anzelm13', '0708eb9cb282e6724248c2409439befc', 4800, 'adammen201300@gmail.com', 'af6a4e37e27d7891d7b2172cf8b3b4e4', b'1'),
(5, 'Jonasz', '201231099f9b2b31ff1ad3cd36764820', 4800, 'joni3077@gmail.com', '7207650479fd963895f0f904ebec6eb0', b'1'),
(10, 'test', '418d89a45edadb8ce4da17e07f72536c', 4800, 'springbok@megalia.org', '4403d2276a3e66503a13e63cfb162ea9', b'1'),
(13, 'warzywko13', '0708eb9cb282e6724248c2409439befc', 4800, 'warzywko13@yahoo.com', '40efa39505739cd3ac9568e76c278513', b'1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_nick` (`id_nick`);

--
-- Indeksy dla tabeli `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoria` (`category`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nick` (`id_nick`),
  ADD KEY `id_name` (`id_name`);

--
-- Indeksy dla tabeli `engine`
--
ALTER TABLE `engine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_name` (`id_name`);

--
-- Indeksy dla tabeli `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nick` (`id_nick`),
  ADD KEY `id_cars` (`id_cars`),
  ADD KEY `id_package` (`id_package`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `engine`
--
ALTER TABLE `engine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT dla tabeli `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_nick`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_nick`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_name`) REFERENCES `cars` (`id`);

--
-- Ograniczenia dla tabeli `engine`
--
ALTER TABLE `engine`
  ADD CONSTRAINT `engine_ibfk_1` FOREIGN KEY (`id_name`) REFERENCES `cars` (`id`);

--
-- Ograniczenia dla tabeli `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`id_nick`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rents_ibfk_3` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `rents_ibfk_4` FOREIGN KEY (`id_package`) REFERENCES `packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
