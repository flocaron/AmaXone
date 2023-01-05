-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 05 jan. 2023 à 15:54
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
-- Structure de la table `projet_commandeProduit`
--

CREATE TABLE `projet_commandeProduit` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet_commandeProduit`
--

INSERT INTO `projet_commandeProduit` (`idCommande`, `idProduit`, `quantite`) VALUES
(2, 2, 1),
(2, 8, 1),
(2, 14, 1),
(2, 18, 1),
(2, 27, 1),
(3, 13, 1),
(3, 23, 1),
(3, 24, 1),
(4, 13, 1),
(4, 18, 1),
(4, 23, 2),
(4, 24, 1),
(5, 12, 1),
(5, 13, 1),
(6, 1, 4),
(6, 7, 2),
(6, 14, 3),
(6, 19, 1),
(7, 12, 1),
(7, 13, 1),
(7, 14, 1),
(8, 1, 1),
(8, 3, 1),
(8, 4, 1),
(8, 13, 1),
(9, 1, 2),
(9, 2, 1),
(9, 3, 1),
(9, 4, 1),
(9, 5, 1),
(10, 10, 5),
(10, 15, 4),
(10, 21, 4),
(10, 25, 2),
(11, 1, 2),
(11, 10, 1),
(11, 20, 6),
(11, 28, 6),
(12, 10, 2),
(12, 16, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet_commandeProduit`
--
ALTER TABLE `projet_commandeProduit`
  ADD PRIMARY KEY (`idCommande`,`idProduit`),
  ADD KEY `fk_commandeProd_produit` (`idProduit`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projet_commandeProduit`
--
ALTER TABLE `projet_commandeProduit`
  ADD CONSTRAINT `fk_commandeProd_commande` FOREIGN KEY (`idCommande`) REFERENCES `projet_commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commandeProd_produit` FOREIGN KEY (`idProduit`) REFERENCES `projet_produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
