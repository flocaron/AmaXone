-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 05 jan. 2023 à 15:55
-- Version du serveur : 10.5.15-MariaDB-0+deb11u1
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `caronf`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet_commande`
--

CREATE TABLE `projet_commande` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `statut` varchar(32) NOT NULL,
  `userLogin` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet_commande`
--

INSERT INTO `projet_commande` (`id`, `date`, `statut`, `userLogin`) VALUES
(2, '2023-01-05', 'en cours', 'jack'),
(3, '2023-01-05', 'en cours', 'admin'),
(4, '2023-01-05', 'en cours', 'admin'),
(5, '2023-01-05', 'en cours', 'jackson'),
(6, '2023-01-05', 'en cours', 'admin'),
(7, '2023-01-05', 'en cours', 'john77'),
(8, '2023-01-05', 'en cours', 'jack'),
(9, '2023-01-05', 'en cours', 'john77'),
(10, '2023-01-05', 'en cours', 'jackson'),
(11, '2022-12-28', 'en cours', 'alex'),
(12, '2022-12-30', 'en cours', 'alex');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet_commande`
--
ALTER TABLE `projet_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_user` (`userLogin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet_commande`
--
ALTER TABLE `projet_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projet_commande`
--
ALTER TABLE `projet_commande`
  ADD CONSTRAINT `fk_commande_user` FOREIGN KEY (`userLogin`) REFERENCES `projet_user` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
