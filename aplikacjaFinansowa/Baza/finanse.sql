-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 18, 2024 at 12:32 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finanse`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cel_oszczedzania`
--

CREATE TABLE `cel_oszczedzania` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `kwota_celowa` decimal(10,2) NOT NULL,
  `postep` decimal(10,2) NOT NULL DEFAULT 0.00,
  `nazwa_celu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cel_oszczedzania`
--

INSERT INTO `cel_oszczedzania` (`id`, `uzytkownik_id`, `kwota_celowa`, `postep`, `nazwa_celu`) VALUES
(38, 13, 20000.00, 0.00, 'Samochód');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dochody_i_wydatki_miesieczne`
--

CREATE TABLE `dochody_i_wydatki_miesieczne` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `miesiac` int(11) DEFAULT NULL,
  `suma_dochodu` decimal(10,2) DEFAULT NULL,
  `suma_wydatku` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dochody_i_wydatki_miesieczne`
--

INSERT INTO `dochody_i_wydatki_miesieczne` (`id`, `id_uzytkownika`, `miesiac`, `suma_dochodu`, `suma_wydatku`) VALUES
(12, 13, 4, 600.00, 1670.00),
(13, 13, 1, 1000.00, 1570.00),
(14, 13, 2, 1100.00, 1470.00),
(15, 13, 3, 1500.00, 1870.00),
(16, 13, 5, 650.00, 1620.00),
(17, 13, 6, 654.00, 1630.00),
(18, 13, 7, 1154.00, 1330.00),
(19, 13, 8, 1034.00, 1430.00),
(20, 13, 9, 1534.00, 1930.00),
(21, 13, 10, 1131.00, 1833.00),
(22, 13, 11, 1031.00, 1633.00),
(23, 13, 12, 2031.00, 1433.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dodatkowe_dochody`
--

CREATE TABLE `dodatkowe_dochody` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `kategoria` varchar(255) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dodatkowe_dochody_miesieczne`
--

CREATE TABLE `dodatkowe_dochody_miesieczne` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `miesiac` int(11) DEFAULT NULL,
  `suma_dochodu` decimal(10,2) DEFAULT NULL,
  `najwyzszy_dochod_nazwa` varchar(255) DEFAULT NULL,
  `najwyzszy_dochod_kwota` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dodatkowe_dochody_miesieczne`
--

INSERT INTO `dodatkowe_dochody_miesieczne` (`id`, `id_uzytkownika`, `miesiac`, `suma_dochodu`, `najwyzszy_dochod_nazwa`, `najwyzszy_dochod_kwota`) VALUES
(10, 13, 4, 500.00, 'Lotto', 500.00),
(11, 13, 1, 400.00, 'Lotto', 400.00),
(12, 13, 2, 300.00, 'Zakłady sportowe', 200.00),
(13, 13, 3, 50.00, 'Zakłady sportowe', 70.00),
(14, 13, 5, 0.00, NULL, 0.00),
(15, 13, 6, 1000.00, 'Lotto', 800.00),
(16, 13, 7, 100.00, 'Lotto', 60.00),
(17, 13, 8, 0.00, NULL, 0.00),
(18, 13, 9, 0.00, NULL, 0.00),
(19, 13, 10, 241.00, 'Zakłady sportowe', 120.00),
(20, 13, 11, 0.00, NULL, 0.00),
(21, 13, 12, 140.00, 'Lotto', 62.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oszczednosci_miesieczne`
--

CREATE TABLE `oszczednosci_miesieczne` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `oszczednosci_01` decimal(10,2) DEFAULT NULL,
  `oszczednosci_02` decimal(10,2) DEFAULT NULL,
  `oszczednosci_03` decimal(10,2) DEFAULT NULL,
  `oszczednosci_04` decimal(10,2) DEFAULT NULL,
  `oszczednosci_05` decimal(10,2) DEFAULT NULL,
  `oszczednosci_06` decimal(10,2) DEFAULT NULL,
  `oszczednosci_07` decimal(10,2) DEFAULT NULL,
  `oszczednosci_08` decimal(10,2) DEFAULT NULL,
  `oszczednosci_09` decimal(10,2) DEFAULT NULL,
  `oszczednosci_10` decimal(10,2) DEFAULT NULL,
  `oszczednosci_11` decimal(10,2) DEFAULT NULL,
  `oszczednosci_12` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oszczednosci_miesieczne`
--

INSERT INTO `oszczednosci_miesieczne` (`id`, `id_uzytkownika`, `oszczednosci_01`, `oszczednosci_02`, `oszczednosci_03`, `oszczednosci_04`, `oszczednosci_05`, `oszczednosci_06`, `oszczednosci_07`, `oszczednosci_08`, `oszczednosci_09`, `oszczednosci_10`, `oszczednosci_11`, `oszczednosci_12`) VALUES
(35, 13, 2300.00, 1900.00, 1400.00, 2313.87, 2700.00, 2499.00, 2390.00, 2193.00, 2001.00, 2132.00, 1990.00, 1100.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `praca`
--

CREATE TABLE `praca` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL,
  `liczba_godzin` decimal(10,2) NOT NULL,
  `zarobki` decimal(10,2) DEFAULT NULL,
  `ilosc_dni` int(11) DEFAULT NULL,
  `stawka_godzinowa` decimal(10,2) DEFAULT NULL,
  `typ_umowy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `praca`
--

INSERT INTO `praca` (`id`, `uzytkownik_id`, `nazwa`, `liczba_godzin`, `zarobki`, `ilosc_dni`, `stawka_godzinowa`, `typ_umowy`) VALUES
(75, 13, 'Dostawca', 8.00, 4480.00, 20, 28.00, 'umowa_o_prace');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stale_dochody`
--

CREATE TABLE `stale_dochody` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT NULL,
  `kategoria` varchar(255) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stale_dochody`
--

INSERT INTO `stale_dochody` (`id`, `uzytkownik_id`, `kwota`, `kategoria`, `nazwa`) VALUES
(14, 13, 100.00, 'Zwrot', 'Podatek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stale_wydatki`
--

CREATE TABLE `stale_wydatki` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `kategoria` varchar(255) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stale_wydatki`
--

INSERT INTO `stale_wydatki` (`id`, `uzytkownik_id`, `kategoria`, `kwota`, `nazwa`) VALUES
(31, 13, 'Opłaty', 600.00, 'Czynsz'),
(32, 13, 'Abonament', 50.00, 'Telefon'),
(33, 13, 'Abonament', 80.00, 'Internet'),
(34, 13, 'Opłaty', 400.00, 'Media');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `wiek` int(11) NOT NULL,
  `zaoszczedzone` decimal(10,2) DEFAULT 0.00,
  `limit_oszczednosciowy` decimal(10,2) DEFAULT NULL,
  `data_rozliczenia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `haslo`, `wiek`, `zaoszczedzone`, `limit_oszczednosciowy`, `data_rozliczenia`) VALUES
(13, 'Test', '$2y$12$nvjphnCgFEdAshNed0Ks.eafuMRzaoGQmuApMlbCRQkeLS77GmKka', 30, 23103.87, 2000.00, '2024-05-18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydatki`
--

CREATE TABLE `wydatki` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `kategoria` varchar(255) DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydatki_miesieczne`
--

CREATE TABLE `wydatki_miesieczne` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `miesiac` int(11) NOT NULL,
  `suma_wydatkow` decimal(10,2) DEFAULT NULL,
  `najwyzszy_wydatek_nazwa` varchar(255) DEFAULT NULL,
  `najwyzszy_wydatek_kwota` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wydatki_miesieczne`
--

INSERT INTO `wydatki_miesieczne` (`id`, `id_uzytkownika`, `miesiac`, `suma_wydatkow`, `najwyzszy_wydatek_nazwa`, `najwyzszy_wydatek_kwota`) VALUES
(11, 13, 4, 540.00, 'Jedzenie', 300.00),
(12, 13, 1, 800.00, 'Rozrywka', 500.00),
(13, 13, 2, 350.00, 'Jedzenie', 300.00),
(14, 13, 3, 500.00, 'Jedzenie', 400.00),
(15, 13, 5, 1000.00, 'Naprawa samochodu', 500.00),
(16, 13, 6, 840.00, 'Jedzenie', 424.11),
(17, 13, 7, 732.94, 'Rozrywka', 200.00),
(18, 13, 8, 1100.00, 'Naprawa laptopa', 450.00),
(19, 13, 9, 850.00, 'Prezent', 400.00),
(20, 13, 10, 753.00, 'Jedzenie', 421.00),
(21, 13, 11, 632.00, 'Jedzenie', 313.11),
(22, 13, 12, 1300.00, 'Prezenty', 650.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynagrodzenia`
--

CREATE TABLE `wynagrodzenia` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `ubezpieczenie_emerytalne` decimal(7,2) DEFAULT NULL,
  `ubezpieczenie_rentowe` decimal(7,2) DEFAULT NULL,
  `chorobowe` decimal(7,2) DEFAULT NULL,
  `ubezpieczenie_zdrowotne` decimal(7,2) DEFAULT NULL,
  `zaliczka_na_pit` decimal(7,2) DEFAULT NULL,
  `wynagrodzenie_netto` decimal(10,2) DEFAULT NULL,
  `id_pracy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wynagrodzenia`
--

INSERT INTO `wynagrodzenia` (`id`, `uzytkownik_id`, `ubezpieczenie_emerytalne`, `ubezpieczenie_rentowe`, `chorobowe`, `ubezpieczenie_zdrowotne`, `zaliczka_na_pit`, `wynagrodzenie_netto`, `id_pracy`) VALUES
(47, 13, 437.25, 67.20, 109.76, 347.92, 134.00, 3383.87, 75);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cel_oszczedzania`
--
ALTER TABLE `cel_oszczedzania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `dochody_i_wydatki_miesieczne`
--
ALTER TABLE `dochody_i_wydatki_miesieczne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `dodatkowe_dochody`
--
ALTER TABLE `dodatkowe_dochody`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `dodatkowe_dochody_miesieczne`
--
ALTER TABLE `dodatkowe_dochody_miesieczne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `oszczednosci_miesieczne`
--
ALTER TABLE `oszczednosci_miesieczne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `praca`
--
ALTER TABLE `praca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `stale_dochody`
--
ALTER TABLE `stale_dochody`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `stale_wydatki`
--
ALTER TABLE `stale_wydatki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wydatki`
--
ALTER TABLE `wydatki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `wydatki_miesieczne`
--
ALTER TABLE `wydatki_miesieczne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `wynagrodzenia`
--
ALTER TABLE `wynagrodzenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `fk_praca_id` (`id_pracy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cel_oszczedzania`
--
ALTER TABLE `cel_oszczedzania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `dochody_i_wydatki_miesieczne`
--
ALTER TABLE `dochody_i_wydatki_miesieczne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dodatkowe_dochody`
--
ALTER TABLE `dodatkowe_dochody`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `dodatkowe_dochody_miesieczne`
--
ALTER TABLE `dodatkowe_dochody_miesieczne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `oszczednosci_miesieczne`
--
ALTER TABLE `oszczednosci_miesieczne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `praca`
--
ALTER TABLE `praca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `stale_dochody`
--
ALTER TABLE `stale_dochody`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stale_wydatki`
--
ALTER TABLE `stale_wydatki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wydatki`
--
ALTER TABLE `wydatki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `wydatki_miesieczne`
--
ALTER TABLE `wydatki_miesieczne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wynagrodzenia`
--
ALTER TABLE `wynagrodzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cel_oszczedzania`
--
ALTER TABLE `cel_oszczedzania`
  ADD CONSTRAINT `cel_oszczedzania_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `dochody_i_wydatki_miesieczne`
--
ALTER TABLE `dochody_i_wydatki_miesieczne`
  ADD CONSTRAINT `dochody_i_wydatki_miesieczne_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `dodatkowe_dochody`
--
ALTER TABLE `dodatkowe_dochody`
  ADD CONSTRAINT `dodatkowe_dochody_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `dodatkowe_dochody_miesieczne`
--
ALTER TABLE `dodatkowe_dochody_miesieczne`
  ADD CONSTRAINT `dodatkowe_dochody_miesieczne_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `oszczednosci_miesieczne`
--
ALTER TABLE `oszczednosci_miesieczne`
  ADD CONSTRAINT `oszczednosci_miesieczne_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `praca`
--
ALTER TABLE `praca`
  ADD CONSTRAINT `praca_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `stale_dochody`
--
ALTER TABLE `stale_dochody`
  ADD CONSTRAINT `stale_dochody_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `stale_wydatki`
--
ALTER TABLE `stale_wydatki`
  ADD CONSTRAINT `stale_wydatki_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `wydatki`
--
ALTER TABLE `wydatki`
  ADD CONSTRAINT `wydatki_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `wydatki_miesieczne`
--
ALTER TABLE `wydatki_miesieczne`
  ADD CONSTRAINT `wydatki_miesieczne_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `wynagrodzenia`
--
ALTER TABLE `wynagrodzenia`
  ADD CONSTRAINT `fk_praca_id` FOREIGN KEY (`id_pracy`) REFERENCES `praca` (`id`),
  ADD CONSTRAINT `wynagrodzenia_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
