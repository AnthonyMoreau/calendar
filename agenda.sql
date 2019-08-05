-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 05 Août 2019 à 23:19
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agenda`
--

-- --------------------------------------------------------

--
-- Structure de la table `base`
--

CREATE TABLE `base` (
  `id` int(11) NOT NULL,
  `yday` int(3) NOT NULL,
  `years` int(4) NOT NULL,
  `descriptions` longtext NOT NULL,
  `types` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `base`
--

INSERT INTO `base` (`id`, `yday`, `years`, `descriptions`, `types`) VALUES
(1, 217, 2019, 'aurevoir', 'afternoon'),
(4, 217, 2019, 'aurevoir', 'afternoon');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `base`
--
ALTER TABLE `base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
