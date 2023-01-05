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
-- Structure de la table `projet_produit`
--

CREATE TABLE `projet_produit` (
  `id` int(11) NOT NULL,
  `libelle` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `imgPath` varchar(32) NOT NULL,
  `categorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet_produit`
--

INSERT INTO `projet_produit` (`id`, `libelle`, `description`, `prix`, `imgPath`, `categorie`) VALUES
(1, 'SSD 980 M.2 NVMe 1 To', 'Le disque SSD 980 1 To de Samsung permet de transcender les performances et la réactivité de votre machine. Bénéficiant de vitesses de transfert élevées et d''une excellente endurance, le Samsung 980 au format M.2 2280 s''appuie sur l''interface PCI-E 3.0 x4 ainsi que sur la technologie NVMe.', 99, 'ssd2.jpg', 'SSD'),
(2, 'Crucial BX500 1 To', 'Le SSD Crucial BX500 1 To dispose d''une bonne  capacité de stockage et une technologie mémoire NAND 3D Micron pour un coût abordable. Il est conçu pour les particuliers qui recherchent à mettre à niveau leur PC, pour leur permettre de gagner en vitesse et en réactivité.', 199, 'ssd1.jpg', 'SSD'),
(3, 'Corsair CX750F ', 'Les blocs d''alimentation entièrement modulaires Corsair CX-F RGB Series fournissent une alimentation 80 PLUS Bronze efficace et durable à votre système. Vous profitez également d''un éclairage personnalisable dynamique grâce à un ventilateur RGB de 120 mm.', 109, '1.jpg', 'Alimentation'),
(4, 'Fox Spirit ', 'L''alimentation Fox Spirit GT-850P V2 80PLUS Platinum est idéale pour la conception d''une configuration de dernière génération. Fiabilité, haute efficacité énergétique et modularité totale sont ses principaux atouts. Connectique complète et dimensions standards permettent de l''intégrer facilement', 130, '2.jpg', 'Alimentation'),
(5, 'LDLC FP-350 ', 'La LDLC FP-350 Quality Select est une alimentation performante, efficace et éco-énergétique, idéale pour votre configuration de dernière génération. Certifiée 80PLUS Bronze, l''alimentation LDLC FP-350 Quality Select délivre la puissance dont vous avez besoin avec un minimum de perte.', 40, '3.jpg', 'Alimentation'),
(6, 'Textorm TX500+', 'Idéale pour l''intégration, l''alimentation PC Textorm TX500+ a été développée avec comme principal objectif un fonctionnement fiable, stable et silencieux avec un minimum de perte. Pour cela, Textorm a fait appel à des circuits et des composants triés sur le volet, gages de fiabilité et de qualité.', 57, '4.jpg', 'Alimentation'),
(7, 'Crucial MX500 1 To', 'Le SSD Crucial MX500 1 To propose une grande capacité de stockage et une technologie mémoire NAND TLC agrémentée de la fonctionnalité RAIN. Conçu pour le grand public, il vise à équiper les PC de dernière génération, pour leur permettre de tout faire plus rapidement.', 109, 'ssd3.jpg', 'SSD'),
(8, 'Pure Power', 'La Pure Power 11 FM 850W signée Be Quiet ! propose une certification 80+ Gold, une modularité complète, un fonctionnement silencieux et la fiabilité avec son convertisseur DC/DC. Que vous souhaitiez assembler un système hautement silencieux, mettre à niveau votre PC ou construire un système gaming', 139, '5.jpg', 'Alimentation'),
(10, 'Crucial P3 2 To', 'Le SSD Crucial P3 grâce à son interface PCIe 3.0 offre des performances près de 6 fois supérieures à celles des disques SSD SATA et 22 fois supérieures à celles des disques durs classiques. Le P3 optimise le matériel existant et est une solution plus économique que l''achat de nouveaux systèmes', 184, 'ssd4.jpg', 'SSD'),
(12, 'RTX 3060 8GB', 'La carte graphique KFA2 GeForce RTX 3060 8 GB (1-Click OC) LHR embarque 8 Go de mémoire vidéo de nouvelle génération GDDR6. Ce modèle bénéficie de fréquences de fonctionnement élevées et d''un système de refroidissement amélioré, gage de fiabilité et de performances à long terme.', 380, '11.jpg', 'Carte Graphique'),
(13, 'Sapphire PULSE', 'La carte graphique Sapphire PULSE Radeon RX 6700 10GB est une carte graphique gaming qui est animée par l''architecture RDNA 2 destinée aux gamers exigeants. Elle est la carte graphique idéale pour une utilisation en 1440p avec des fréquences d''images élevées.', 480, '12.jpg', 'Carte Graphique'),
(14, 'RTX 4090 Phantom', 'La carte graphique NVIDIA GeForce RTX 4090 offre une rapidité extrême pour les joueurs comme pour les créateurs. Avec des performances hors norme et des capacités graphiques améliorées par Intelligence Artificielle, ce nouveau monstre de puissance vous permettra de plonger au coeur de l''action.', 1970, '13.jpg', 'Carte Graphique'),
(15, 'MSI VENTUS RTX 3060 ', 'La carte graphique MSI GeForce RTX 3060 VENTUS 2X 12G OC LHR embarque 12 Go de mémoire vidéo de nouvelle génération GDDR6. Ce modèle bénéficie de fréquences de fonctionnement élevées et d''un système de refroidissement amélioré gage de fiabilité et de performances à long terme.', 470, '14.jpg', 'Carte Graphique'),
(16, 'GeForce RTX 3060', 'La carte graphique ASUS GeForce RTX Dual 3060 O12G LHR embarque 12 Go de mémoire vidéo de nouvelle génération GDDR6. Ce modèle bénéficie de fréquences de fonctionnement élevées et d''un système de refroidissement amélioré gage de fiabilité et de performances à long terme.', 430, '15.jpg', 'Carte Graphique'),
(17, 'ASUS TUF GAMING ', 'Prête à accueillir les processeurs AMD Ryzen de 3ème génération (nom de Core Matisse), la carte mère ASUS TUF GAMING B550-PLUS est idéale pour concevoir un PC Gaming performant et équilibré. Le support du PCI-Express 4.0 vous emmène vers de nouveaux sommets.', 160, '21.jpg', 'Carte Mère'),
(18, 'ASUS ROG STRIX ', 'Prête à accueillir les processeurs AMD Ryzen de 3ème génération (nom de Core Matisse), la carte mère ASUS ROG STRIX B550-F GAMING est idéale pour concevoir un PC Gaming performant et équilibré. Le support du PCI-Express 4.0 vous emmène vers de nouveaux sommets.', 196, '23.jpg', 'Carte Mère'),
(19, 'Gigabyte B550', 'La carte mère Gigabyte B550 GAMING X V2 sera parfaite pour une configuration Gaming de pointe. Conçue pour les processeurs AMD Ryzen à partir de la 3ème génération sur socket AMD AM4, elle propose le PCI-Express 4.0 et la gestion de 128 Go de RAM DDR4.', 152, '22.jpg', 'Carte Mère'),
(20, 'ASUS PRIME H510M-K', 'La carte mère ASUS PRIME H510M-K est conçue pour accueillir les processeurs Intel de 10ème & 11ème génération sur socket LGA 1200. Elle permettra l''assemblage d''une configuration bureautique et multimédia à coût abordable.', 86, '26.jpg', 'Carte Mère'),
(21, 'ASRock H310CM', 'La carte mère ASRock H310CM-HDV/M.2 est faite pour accueillir les processeurs Intel Core de 8ème génération (Intel Coffee Lake). Basée sur le chipset Intel H310 Express, elle servira de base à votre PC bureautique ou multimédia équipé d''un processeur performant et polyvalent.', 60, '25.jpg', 'Carte Mère'),
(22, 'MSI MAG B660M ', 'La carte mère MSI MAG B660M MORTAR WIFI DDR4 a été conçue pour vous permettre de prendre le dessus sur vos adversaires. Pensée pour les joueurs, elle intègre des fonctionnalités et des composants optimisés pour le jeu, la performance et l''efficacité.', 179, '24.jpg', 'Carte Mère'),
(23, 'Corsair Vengeance 16go', 'Avec la nouvelle gamme de mémoires PC haut de gamme Vengeance LPX Series, Corsair propose des solutions stables et performantes pour les plateformes nouvelle génération avec en prime un fort potentiel d''overclocking.', 76, '31.jpg', 'RAM'),
(24, 'Kingston Beast 16 Go', 'La mémoire PC Kingston FURY Beast DDR4 apporte une puissante augmentation des performances pour les jeux, l''édition vidéo et le rendu avec des vitesses allant jusqu''à 3733 MHz. Cette mise à niveau rentable est disponible à des vitesses de 2666 MHz à 3733 MHz avec des latences CL15 à 19.', 73, '32.jpg', 'RAM'),
(25, 'G.Skill Aegis 16 Go', 'La mémoire Aegis a été conçue pour s''adapter à merveille sur des plateformes Intel de dernier cri dotées de processeurs Intel Core comme la sixième génération. L''objectif ? Offrir le plus de souplesse possible aux joueurs chevronnés.', 64, '33.jpg', 'RAM'),
(27, 'Corsair Vengeance 16 Go', 'La mémoire RAM DDR4 Corsair Vengeance RGB RS renforce l''esthétique de votre PC tout en offrant des performances exceptionnelles. Un PCB personnalisé offre une qualité de signal élevée pour des performances et une stabilité exceptionnelles sur les dernières cartes mères Intel et AMD DDR4.', 91, '34.jpg', 'RAM'),
(28, 'G.Skill RipJaws S5 16 Go', 'La nouvelle gamme G.Skill RipJaws 5 propose des solutions aux performances incroyables. Ces kits optimiseront les performances des plateformes de nouvelle génération, avec en prime, un fort potentiel d''overclocking.', 72, '35.jpg', 'RAM');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet_produit`
--
ALTER TABLE `projet_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit_categorie` (`categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet_produit`
--
ALTER TABLE `projet_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projet_produit`
--
ALTER TABLE `projet_produit`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`categorie`) REFERENCES `projet_categorie` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
