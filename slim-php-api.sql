-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2021. Jún 13. 11:21
-- Kiszolgáló verziója: 10.5.10-MariaDB
-- PHP verzió: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `plain-php-api`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `price` mediumint(9) NOT NULL,
  `stock` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `picture`, `price`, `stock`) VALUES
(1, 'Bogyós', 'Málna', 'Kézzel termelt egészség', 'https://hur.webmania.cc/img/malna.jpg', 3800, 500),
(2, 'Bogyós', 'Áfonya', 'Az erdő kincse az otthonodba', 'https://hur.webmania.cc/img/afonya.jpg', 3250, 120),
(3, 'Bogyós', 'Szeder', 'A hagyományos csemege', 'https://hur.webmania.cc/img/szeder.jpg', 1700, 40),
(4, 'Bogyós', 'Eper', 'Egy tavaszi harapás', 'https://hur.webmania.cc/img/eper.jpg', 1440, 0),
(5, 'Bogyós', 'Homoktövis', 'Mezei csemege', 'https://hur.webmania.cc/img/homoktovis.jpg', 3200, 100),
(6, 'Bogyós', 'Som', 'A fanyar gyönyör', 'https://hur.webmania.cc/img/som.jpg', 900, 10),
(7, 'Bogyós', 'Fanyarka', 'Édes mint a méz', 'https://hur.webmania.cc/img/fanyarka.jpg', 990, 25),
(8, 'Bogyós', 'Piszke', 'Egres', 'https://hur.webmania.cc/img/piszke.jpg', 750, 100),
(9, 'Bogyós', 'Ribizli', 'Fanyar, vasban gazdag', 'https://hur.webmania.cc/img/ribizli.jpg', 1300, 170),
(10, 'Magyaros', 'Meggy', 'A falusi kincs', 'https://hur.webmania.cc/img/meggy.jpg', 600, 300),
(11, 'Magyaros', 'Cseresznye', 'A falusi kincs', 'https://hur.webmania.cc/img/cseresznye.jpg', 900, 300),
(12, 'Magyaros', 'Szilva', 'A falusi kincs', 'https://hur.webmania.cc/img/szilva.jpg', 770, 200);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`) VALUES
(1, 'rrd@webmania.cc', 'bd0f17042ff2f6733b4ebb30dfa68f5a', '270fsdg04%rt2f6$)b4eblok0dfgaurannga');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
