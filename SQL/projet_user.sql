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
-- Structure de la table `projet_user`
--

CREATE TABLE `projet_user` (
  `login` varchar(64) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `mdpHache` varchar(256) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL,
  `email` varchar(256) NOT NULL,
  `emailAValider` varchar(256) NOT NULL,
  `nonce` varchar(32) NOT NULL,
  `dernierPanier` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet_user`
--

INSERT INTO `projet_user` (`login`, `nom`, `prenom`, `mdpHache`, `estAdmin`, `email`, `emailAValider`, `nonce`, `dernierPanier`) VALUES
('admin', 'super', 'user', '$2y$10$UbXdrMzDKcN8/tPjXORLou5KOyzKOEAsbmSRdGhaBvUmCE6i1Bf9G', 1, 'superuser@yopmail.com', '', '', 'a:4:{i:14;i:1;i:19;i:1;i:1;i:1;i:7;i:1;}'),
('alex', 'Camps', 'Alexis', '$2y$10$dUSQI6es1akhngKNXfdqIOWjPpmPBTAhwMXPT5Vndm2SBNXYZDQzC', 0, 'jackson@yopmail.com', '', '', NULL),
('jack', 'test', 'admin', '$2y$10$jFAtZflUIXfTkWMQgQp4qO30PbKWe.XHqHldBDO3j7HPeL1cSacK.', 1, 'jackcar@zz.zz', '', '', 'a:2:{i:3;i:1;i:4;i:1;}'),
('jackson', 'jackson', 'richardson', '$2y$10$dxxY3ERk7xsxvfLhaW5G3esjr4oRmExosXkARIq8sSl4wAToLW3Ta', 0, 'jackson@yopmail.com', '', '', 'a:0:{}'),
('john77', 'dooooo', 'john', '$2y$10$hdr65rrLs7qW/MVdM87Z0OHzTXqUNf8z8H6MKIuHYNFli7qHIoGOy', 0, 'jackson@yopmail.com', '', '', 'a:3:{i:22;i:1;i:17;i:1;i:19;i:1;}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet_user`
--
ALTER TABLE `projet_user`
  ADD PRIMARY KEY (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
