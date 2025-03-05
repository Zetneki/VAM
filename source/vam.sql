-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 11:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vam`
--

-- --------------------------------------------------------

--
-- Table structure for table `allomas`
--

CREATE TABLE `allomas` (
  `aid` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `varos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `allomas`
--

INSERT INTO `allomas` (`aid`, `nev`, `varos`) VALUES
(20, 'Békéscsabai vasútállomás', 'Békéscsaba'),
(5, 'Debreceni vasútállomás', 'Debrecen'),
(3, 'Déli pályaudvar', 'Budapest'),
(17, 'Egeri vasútállomás', 'Eger'),
(11, 'Győri vasútállomás', 'Győr'),
(12, 'Kaposvári vasútállomás', 'Kaposvár'),
(18, 'Kecskeméti vasútállomás', 'Kecskemét'),
(4, 'Kelenföldi vasútállomás', 'Budapest'),
(1, 'Keleti pályaudvar', 'Budapest'),
(8, 'Miskolci vasútállomás', 'Miskolc'),
(7, 'Nyíregyházi vasútállomás', 'Nyíregyháza'),
(2, 'Nyugati pályaudvar', 'Budapest'),
(9, 'Pécsi vasútállomás', 'Pécs'),
(19, 'Soproni vasútállomás', 'Sopron'),
(10, 'Szegedi vasútállomás', 'Szeged'),
(14, 'Székesfehérvári vasútállomás', 'Székesfehérvár'),
(6, 'Szolnoki vasútállomás', 'Szolnok'),
(15, 'Tatabányai vasútállomás', 'Tatabánya'),
(16, 'Veszprémi vasútállomás', 'Veszprém'),
(13, 'Zalaegerszegi vasútállomás', 'Zalaegerszeg');

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `email` varchar(100) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `milyen_szid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`email`, `nev`, `jelszo`, `milyen_szid`) VALUES
('admin@gmail.com', 'Admin Fiok', '$2y$10$DfGQSnVcIp5ULDMRfRZzjuXLDgM8LUG9x7p0TaPbNql/5Yue6u9N.', 2),
('tesztelek@gmail.com', 'Teszt Elek', '$2y$10$r0JrSiv/IMXA42iLTZ.l/uwVFqgEIbNGzIF7dxX0Kei62xtS2T4zy', 1),
('valaki@gmail.com', 'Valaki Valaki', '$2y$10$HR8/i8tWuZeJ1FZmVTNBEOIinZzhEQiIpPuMsmpcCrVir.Ncj7zZC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jarat`
--

CREATE TABLE `jarat` (
  `jaid` int(11) NOT NULL,
  `tipus` enum('busz','vonat','repülő') NOT NULL,
  `indulo_aid` int(11) DEFAULT NULL,
  `cel_aid` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `idopont` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `jarat`
--

INSERT INTO `jarat` (`jaid`, `tipus`, `indulo_aid`, `cel_aid`, `datum`, `idopont`) VALUES
(1, 'busz', 1, 5, '2024-12-01', '08:00:00'),
(2, 'vonat', 2, 6, '2024-12-02', '09:30:00'),
(3, 'repülő', 3, 7, '2024-12-03', '10:15:00'),
(4, 'vonat', 4, 8, '2024-12-04', '11:45:00'),
(5, 'busz', 5, 9, '2024-12-05', '13:00:00'),
(6, 'repülő', 6, 10, '2024-12-06', '14:30:00'),
(7, 'vonat', 7, 11, '2024-12-07', '15:45:00'),
(8, 'busz', 8, 12, '2024-12-08', '17:00:00'),
(9, 'repülő', 9, 13, '2024-12-09', '18:15:00'),
(10, 'vonat', 10, 14, '2024-12-10', '19:30:00'),
(11, 'busz', 11, 15, '2024-12-11', '07:15:00'),
(12, 'repülő', 12, 16, '2024-12-12', '06:00:00'),
(13, 'vonat', 13, 17, '2024-12-13', '08:45:00'),
(14, 'busz', 14, 18, '2024-12-14', '09:30:00'),
(15, 'repülő', 15, 19, '2024-12-15', '10:00:00'),
(16, 'vonat', 16, 20, '2024-12-16', '11:15:00'),
(17, 'busz', 17, 1, '2024-12-17', '12:30:00'),
(18, 'repülő', 18, 2, '2024-12-18', '13:45:00'),
(19, 'vonat', 19, 3, '2024-12-19', '15:00:00'),
(20, 'busz', 20, 4, '2024-12-20', '16:30:00'),
(21, 'repülő', 5, 10, '2024-12-21', '17:45:00'),
(22, 'busz', 6, 11, '2024-12-22', '18:15:00'),
(23, 'vonat', 7, 12, '2024-12-23', '19:30:00'),
(24, 'repülő', 8, 13, '2024-12-24', '20:45:00'),
(25, 'busz', 9, 14, '2024-12-25', '06:00:00'),
(26, 'vonat', 10, 15, '2024-12-26', '07:15:00'),
(27, 'repülő', 11, 16, '2024-12-27', '08:30:00'),
(28, 'busz', 12, 17, '2024-12-28', '09:45:00'),
(29, 'vonat', 13, 18, '2024-12-29', '11:00:00'),
(30, 'repülő', 14, 19, '2024-12-30', '12:15:00'),
(31, 'busz', 15, 20, '2024-12-31', '13:30:00'),
(32, 'vonat', 16, 1, '2025-01-01', '14:45:00'),
(33, 'repülő', 17, 2, '2025-01-02', '16:00:00'),
(34, 'busz', 18, 3, '2025-01-03', '17:15:00'),
(35, 'vonat', 19, 4, '2025-01-04', '18:30:00'),
(36, 'repülő', 20, 5, '2025-01-05', '19:45:00'),
(37, 'busz', 1, 6, '2025-01-06', '06:00:00'),
(38, 'vonat', 2, 7, '2025-01-07', '07:15:00'),
(39, 'repülő', 3, 8, '2025-01-08', '08:30:00'),
(40, 'busz', 4, 9, '2025-01-09', '09:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `jegy`
--

CREATE TABLE `jegy` (
  `jeid` int(11) NOT NULL,
  `melyik_jaid` int(11) DEFAULT NULL,
  `ar` int(11) NOT NULL,
  `elerhetodb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `jegy`
--

INSERT INTO `jegy` (`jeid`, `melyik_jaid`, `ar`, `elerhetodb`) VALUES
(1, 1, 3500, 36),
(2, 2, 4200, 25),
(3, 3, 7500, 20),
(4, 4, 5000, 20),
(5, 5, 3000, 34),
(6, 6, 8900, 15),
(7, 7, 3100, 35),
(8, 8, 2700, 46),
(9, 9, 12000, 10),
(10, 10, 4400, 45),
(11, 11, 5500, 24),
(12, 12, 7200, 25),
(13, 13, 6300, 40),
(14, 14, 3400, 47),
(15, 15, 9800, 10),
(16, 16, 2900, 50),
(17, 17, 4000, 30),
(18, 18, 11000, 13),
(19, 19, 6800, 25),
(20, 20, 4500, 35),
(21, 21, 8900, 20),
(22, 22, 7800, 40),
(23, 23, 3600, 45),
(24, 24, 3100, 50),
(25, 25, 4900, 30),
(26, 26, 9500, 15),
(27, 27, 8700, 20),
(28, 28, 3900, 50),
(29, 29, 4100, 35),
(30, 30, 5300, 40),
(31, 31, 6700, 45),
(32, 32, 3000, 50),
(33, 33, 5600, 29),
(34, 34, 4800, 25),
(35, 35, 6100, 35),
(36, 36, 7900, 20),
(37, 37, 9300, 10),
(38, 38, 5500, 15),
(39, 39, 8100, 25),
(40, 40, 4300, 45);

-- --------------------------------------------------------

--
-- Table structure for table `szerep`
--

CREATE TABLE `szerep` (
  `szid` int(11) NOT NULL,
  `szerep_nev` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `szerep`
--

INSERT INTO `szerep` (`szid`, `szerep_nev`) VALUES
(1, 'felhasznalo'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vasaroltjegyek`
--

CREATE TABLE `vasaroltjegyek` (
  `vid` int(11) NOT NULL,
  `tulajdonos_email` varchar(100) DEFAULT NULL,
  `melyik_jaid` int(11) DEFAULT NULL,
  `darab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `vasaroltjegyek`
--

INSERT INTO `vasaroltjegyek` (`vid`, `tulajdonos_email`, `melyik_jaid`, `darab`) VALUES
(1, 'valaki@gmail.com', 1, 4),
(2, 'valaki@gmail.com', 4, 5),
(3, 'valaki@gmail.com', 8, 4),
(4, 'valaki@gmail.com', 14, 3),
(5, 'tesztelek@gmail.com', 5, 6),
(6, 'tesztelek@gmail.com', 11, 6),
(7, 'tesztelek@gmail.com', 2, 5),
(8, 'tesztelek@gmail.com', 33, 1),
(9, 'valaki@gmail.com', 18, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allomas`
--
ALTER TABLE `allomas`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `nev` (`nev`,`varos`);

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`email`),
  ADD KEY `milyen_szid` (`milyen_szid`);

--
-- Indexes for table `jarat`
--
ALTER TABLE `jarat`
  ADD PRIMARY KEY (`jaid`),
  ADD KEY `indulo_aid` (`indulo_aid`),
  ADD KEY `cel_aid` (`cel_aid`);

--
-- Indexes for table `jegy`
--
ALTER TABLE `jegy`
  ADD PRIMARY KEY (`jeid`),
  ADD KEY `melyik_jaid` (`melyik_jaid`);

--
-- Indexes for table `szerep`
--
ALTER TABLE `szerep`
  ADD PRIMARY KEY (`szid`);

--
-- Indexes for table `vasaroltjegyek`
--
ALTER TABLE `vasaroltjegyek`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `melyik_jaid` (`melyik_jaid`),
  ADD KEY `vasaroltjegyek_ibfk_1` (`tulajdonos_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allomas`
--
ALTER TABLE `allomas`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jarat`
--
ALTER TABLE `jarat`
  MODIFY `jaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jegy`
--
ALTER TABLE `jegy`
  MODIFY `jeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `szerep`
--
ALTER TABLE `szerep`
  MODIFY `szid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vasaroltjegyek`
--
ALTER TABLE `vasaroltjegyek`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD CONSTRAINT `felhasznalo_ibfk_1` FOREIGN KEY (`milyen_szid`) REFERENCES `szerep` (`szid`);

--
-- Constraints for table `jarat`
--
ALTER TABLE `jarat`
  ADD CONSTRAINT `jarat_ibfk_1` FOREIGN KEY (`indulo_aid`) REFERENCES `allomas` (`aid`),
  ADD CONSTRAINT `jarat_ibfk_2` FOREIGN KEY (`cel_aid`) REFERENCES `allomas` (`aid`);

--
-- Constraints for table `jegy`
--
ALTER TABLE `jegy`
  ADD CONSTRAINT `jegy_ibfk_1` FOREIGN KEY (`melyik_jaid`) REFERENCES `jarat` (`jaid`);

--
-- Constraints for table `vasaroltjegyek`
--
ALTER TABLE `vasaroltjegyek`
  ADD CONSTRAINT `vasaroltjegyek_ibfk_1` FOREIGN KEY (`tulajdonos_email`) REFERENCES `felhasznalo` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vasaroltjegyek_ibfk_2` FOREIGN KEY (`melyik_jaid`) REFERENCES `jarat` (`jaid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
