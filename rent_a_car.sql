-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2022 at 06:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_a_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `drzave`
--

CREATE TABLE `drzave` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drzave`
--

INSERT INTO `drzave` (`ID`, `naziv`) VALUES
(1, 'Crna Gora'),
(2, 'Srbija'),
(3, 'Hrvatska'),
(4, 'BiH'),
(5, 'Belgija'),
(6, 'Portugal');

-- --------------------------------------------------------

--
-- Table structure for table `klasa`
--

CREATE TABLE `klasa` (
  `ID` int(11) NOT NULL,
  `klasa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klasa`
--

INSERT INTO `klasa` (`ID`, `klasa`) VALUES
(1, 'economy'),
(2, 'business'),
(4, 'luxury');

-- --------------------------------------------------------

--
-- Table structure for table `klijent`
--

CREATE TABLE `klijent` (
  `ID` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `drzava_id` int(11) NOT NULL,
  `broj_pasosa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klijent`
--

INSERT INTO `klijent` (`ID`, `ime`, `prezime`, `drzava_id`, `broj_pasosa`) VALUES
(1, 'Luka', 'Radulovic', 1, 'R9DC123'),
(3, 'Petar', 'Petrovic', 2, 'SR123D'),
(119, 'Marko', 'Markoviic', 3, 'PC123D9'),
(123, 'Luka', 'Lukic', 4, 'RD123DC0');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `ID` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `proizvodjac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`ID`, `model`, `proizvodjac_id`) VALUES
(1, 'Golf 2', 1),
(2, 'AMG GT 63', 2),
(5, 'Golf 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjac`
--

CREATE TABLE `proizvodjac` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodjac`
--

INSERT INTO `proizvodjac` (`ID`, `naziv`) VALUES
(1, 'Volkswagen'),
(2, 'Mercedes'),
(8, 'BMW');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `ID` int(11) NOT NULL,
  `vozilo_id` int(11) NOT NULL,
  `klijent_id` int(11) NOT NULL,
  `rezervisano_od` date NOT NULL,
  `rezervisano_do` date NOT NULL,
  `ukupna_cijena` float NOT NULL,
  `otkazano` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`ID`, `vozilo_id`, `klijent_id`, `rezervisano_od`, `rezervisano_do`, `ukupna_cijena`, `otkazano`) VALUES
(3, 26, 1, '2022-07-18', '2022-07-23', 150, 'true'),
(4, 26, 3, '2022-08-24', '2022-08-31', 210, 'false'),
(5, 25, 3, '2022-07-19', '2022-07-29', 150, 'false'),
(7, 26, 1, '2022-07-22', '2022-07-25', 90, 'false'),
(8, 26, 3, '2022-07-26', '2022-09-01', 1110, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `ID` int(11) NOT NULL,
  `vozilo_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`ID`, `vozilo_id`, `path`) VALUES
(23, 25, 'slike/62d2ec9e5a48d.jpg'),
(24, 25, 'slike/62d2ec9e7521a.jpg'),
(30, 26, 'slike/62d8755015570.jpeg'),
(31, 26, 'slike/62d87550248bc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vozila`
--

CREATE TABLE `vozila` (
  `ID` int(11) NOT NULL,
  `registarski_broj` varchar(255) NOT NULL,
  `proizvodjac_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `godina` int(11) NOT NULL,
  `klasa_id` int(11) NOT NULL,
  `cijena` double NOT NULL,
  `profilna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vozila`
--

INSERT INTO `vozila` (`ID`, `registarski_broj`, `proizvodjac_id`, `model_id`, `godina`, `klasa_id`, `cijena`, `profilna`) VALUES
(25, 'PGAF123', 1, 1, 1995, 1, 15, 'slike/62d87383e7f06.jpg'),
(26, 'DGAF123', 2, 2, 2005, 4, 30, 'slike/62d2ecd651ae5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drzave`
--
ALTER TABLE `drzave`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `klijent`
--
ALTER TABLE `klijent`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_klijent_drzava` (`drzava_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_model_proizvodjac` (`proizvodjac_id`);

--
-- Indexes for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_klijent_vozilo` (`klijent_id`),
  ADD KEY `fk_vozilo_klijent` (`vozilo_id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_slike_vozilo` (`vozilo_id`);

--
-- Indexes for table `vozila`
--
ALTER TABLE `vozila`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_vozila_proizvodjac` (`proizvodjac_id`),
  ADD KEY `fk_vozila_model` (`model_id`),
  ADD KEY `fk_vozila_klasa` (`klasa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drzave`
--
ALTER TABLE `drzave`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klijent`
--
ALTER TABLE `klijent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `vozila`
--
ALTER TABLE `vozila`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klijent`
--
ALTER TABLE `klijent`
  ADD CONSTRAINT `fk_klijent_drzava` FOREIGN KEY (`drzava_id`) REFERENCES `drzave` (`ID`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `fk_model_proizvodjac` FOREIGN KEY (`proizvodjac_id`) REFERENCES `proizvodjac` (`ID`);

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `fk_klijent_vozilo` FOREIGN KEY (`klijent_id`) REFERENCES `klijent` (`ID`),
  ADD CONSTRAINT `fk_vozilo_klijent` FOREIGN KEY (`vozilo_id`) REFERENCES `vozila` (`ID`);

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `fk_slike_vozilo` FOREIGN KEY (`vozilo_id`) REFERENCES `vozila` (`ID`);

--
-- Constraints for table `vozila`
--
ALTER TABLE `vozila`
  ADD CONSTRAINT `fk_vozila_klasa` FOREIGN KEY (`klasa_id`) REFERENCES `klasa` (`ID`),
  ADD CONSTRAINT `fk_vozila_model` FOREIGN KEY (`model_id`) REFERENCES `model` (`ID`),
  ADD CONSTRAINT `fk_vozila_proizvodjac` FOREIGN KEY (`proizvodjac_id`) REFERENCES `proizvodjac` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
