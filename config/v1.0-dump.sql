-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 17. čen 2022, 08:42
-- Verze serveru: 10.4.21-MariaDB
-- Verze PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `crafts`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `city_description` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `crafts`
--

CREATE TABLE `crafts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `specialization` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `skills` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `web` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `protocol` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `protocols`
--

CREATE TABLE `protocols` (
  `id` int(11) NOT NULL,
  `url_prefix` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `protocol_name` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `specialization_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `specialization_description` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `crafts`
--
ALTER TABLE `crafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `protocols`
--
ALTER TABLE `protocols`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `crafts`
--
ALTER TABLE `crafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `protocols`
--
ALTER TABLE `protocols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
