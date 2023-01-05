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
-- Structure de la table `projet_categorie`
--

CREATE TABLE `projet_categorie` (
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `imgPath` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet_categorie`
--

INSERT INTO `projet_categorie` (`nom`, `description`, `imgPath`) VALUES
('Alimentation', 'Obligatoire pour que votre ordinateur démarre', 'alimentation.jpg'),
('Carte Graphique', 'COMPOSANT IMPORTANT POUR L''AFFICHAGE GRAPHIQUE', 'carte_graphique.jpg'),
('Carte Mère', 'Permet de centraliser la gestion de la RAM', 'carte_mere.jpg'),
('RAM', 'TRÈS IMPORTANT POUR DES CALCUL EFFICACE', 'ram.png'),
('SSD', 'TECHNOLOGIE MODERNE POUR LE STOCKAGE DE VOS DONNÉES', 'ssd.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet_categorie`
--
ALTER TABLE `projet_categorie`
  ADD PRIMARY KEY (`nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
