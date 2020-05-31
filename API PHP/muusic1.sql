-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2020 at 04:25 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muusic1`
--

-- --------------------------------------------------------

--
-- Table structure for table `musique`
--

CREATE TABLE `musique` (
  `nom_musique` varchar(30) NOT NULL DEFAULT '',
  `nom_artiste` varchar(30) DEFAULT NULL,
  `album` varchar(30) DEFAULT NULL,
  `annee_publication` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `musique`
--

INSERT INTO `musique` (`nom_musique`, `nom_artiste`, `album`, `annee_publication`) VALUES
('another one bite the dust', 'Queen', 'The game', '1980-09-22'),
('crazy frog', 'Daniel Malmedahl', 'Riquita', '2005-07-23'),
('Démo', 'Je suis un Artiste démo', 'Album Démo', '2020-05-20'),
('JCVD', 'Jul', 'Rien 100 rien', '2020-06-14'),
('Parole', 'Dalida', 'Julien...', '1972-04-04'),
('Scarface', 'Booba', 'Autopsie 0', '2017-10-22'),
('Sous la lune', 'Jul', 'Rien 100 rien', '2020-06-14'),
('Test demo', 'Artiste test', 'Album test', '2020-05-20'),
('Tokyo', 'Jul', 'Rien 100 rien', '2020-06-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`nom_musique`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
