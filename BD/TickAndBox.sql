-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 29 juil. 2022 à 13:34
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `TickAndBox`
--

-- --------------------------------------------------------

--
-- Structure de la table `CallTracking`
--

CREATE TABLE `CallTracking` (
  `numero` varchar(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CallTracking`
--

INSERT INTO `CallTracking` (`numero`, `libelle`, `idClient`) VALUES
('0634476943', '#1', 2),
('0634230312', 'bruh', 1),
('0670707070', 'bgfdggdfg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `idClient` int(11) NOT NULL,
  `nomComplet` varchar(100) NOT NULL,
  `nomEntreprise` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `localisation` varchar(100) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `dateSignature` date NOT NULL,
  `dureeEngagement` int(11) NOT NULL,
  `compteGMB` varchar(200) DEFAULT NULL,
  `compteInsta` varchar(200) DEFAULT NULL,
  `compteAnalytics` varchar(200) DEFAULT NULL,
  `MandatSEPA` varchar(200) NOT NULL,
  `CNI` varchar(200) NOT NULL,
  `RIB` varchar(200) NOT NULL,
  `contrat` varchar(200) NOT NULL,
  `siret` varchar(14) NOT NULL,
  `idForfait` int(11) NOT NULL,
  `idSecteur` int(11) NOT NULL,
  `idTB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`idClient`, `nomComplet`, `nomEntreprise`, `mail`, `telephone`, `photo`, `localisation`, `adresse`, `dateSignature`, `dureeEngagement`, `compteGMB`, `compteInsta`, `compteAnalytics`, `MandatSEPA`, `CNI`, `RIB`, `contrat`, `siret`, `idForfait`, `idSecteur`, `idTB`) VALUES
(1, 'Jean-Michel LECLIENT', 'JM ENTERPRISE', 'jean@michel.com', '0634230312', '', 'Paris', '1 avenue Champs-Elisée', '2022-02-05', 12, '', '', '', '', '', '', '', '12345678909876', 1, 1, 1),
(2, 'Juliette Course', 'Super place par exemple', 'JulietteCourse@armyspy.com', '0634476947', '', 'Normandie', '92, Boulevard de Normandie57600 FORBACH', '2022-03-08', 24, '', '', 'UA-188566766-34', '', '', '', '', '5463708412322', 2, 3, 4),
(3, 'CEDRIC BERNARD', 'MTB13', 'cb@mtb13.com', '0232301010', ' non', 'Gemenos', '23 Rue paul cezanne  ', '2022-03-11', 12, ' non', ' non', ' non', ' non', ' non', ' non', ' non', 'A434242343424', 1, 1, 1),
(4, 'tony stark', 'industys', 'ts@ave.fr', '0634476999', '', 'losangeles', 'malibu point', '2022-03-15', 24, '', '', '', '', '', '', '', '2131231232332', 2, 3, 4),
(5, 'Maurice Bérubé', '83, Place Napoléon 53000 LAVAL', 'MauriceBerube@rhyta.com', '0269351234', '', 'Heilig-Meyers', '83, Place Napoléon 53000', '2022-03-17', 24, '', '', '', '', '', '', '', '3042402402304', 2, 3, 1),
(6, 'Test ajout', 'ajout and co', 'ajout@test.com', '0650501234', ' non', 'Aix les milles', '4 rue jean moulin', '2022-07-26', 12, ' non', ' non', 'UA-188566766-70', ' non', ' non', ' non', ' non', '', 1, 1, 1),
(7, 'Octave Dupuy', 'le fish', 'o.dupuy@gmail.Com', '0638432823', ' non', 'Paris ', '8 avenue champs elisée', '2022-07-28', 12, ' non', ' non', '', ' non', ' non', ' non', ' non', '3204304502340', 1, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `connexionClient`
--

CREATE TABLE `connexionClient` (
  `mailConnexion` varchar(100) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexionClient`
--

INSERT INTO `connexionClient` (`mailConnexion`, `motDePasse`, `idClient`) VALUES
('ajout@test.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 6),
('bb@bb.fr', '662af1cd1976f09a9f8cecc868ccc0a2', 5),
('cb@mtb13.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 3),
('jean@michel.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1),
('julietteC@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 2),
('o.dupuy@gmail.Com', '6b9418c1aeec9dbbfa2cd97d2d04961c', 7),
('test@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 4);

-- --------------------------------------------------------

--
-- Structure de la table `connexionTB`
--

CREATE TABLE `connexionTB` (
  `mailConnexion` varchar(100) NOT NULL,
  `motDePasse` varchar(200) NOT NULL,
  `idTB` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexionTB`
--

INSERT INTO `connexionTB` (`mailConnexion`, `motDePasse`, `idTB`) VALUES
('aissa.ouazine@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 2),
('alise.berutti@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 4),
('chloe.jacob@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 9),
('naomy.berthely@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 3),
('nawel.tamaste@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 8),
('test.prod@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 10),
('zinedine.megnouche@tickandbox.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Constitue`
--

CREATE TABLE `Constitue` (
  `idForfait` int(11) NOT NULL,
  `idOption` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Forfait`
--

CREATE TABLE `Forfait` (
  `idForfait` int(11) NOT NULL,
  `nomForfait` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Forfait`
--

INSERT INTO `Forfait` (`idForfait`, `nomForfait`, `tarif`, `description`) VALUES
(1, 'Visibilité', 250, 'Ofrre de base avec creation du site, image de marque, gestion des Réseaux sociaux'),
(2, 'Visiblité +', 350, 'Offre visibilité avec referencement amelioré'),
(3, 'Visibilité + pro', 500, 'Visibilé + avec un site web dynamique (e-commerce)');

-- --------------------------------------------------------

--
-- Structure de la table `HistoriqueConnexionClient`
--

CREATE TABLE `HistoriqueConnexionClient` (
  `idClient` int(11) NOT NULL,
  `DateHeure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `HistoriqueConnexionTB`
--

CREATE TABLE `HistoriqueConnexionTB` (
  `idTB` int(11) NOT NULL,
  `DateHeure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Modification`
--

CREATE TABLE `Modification` (
  `idClient` int(11) NOT NULL,
  `idTB` int(11) NOT NULL,
  `dateModif` datetime DEFAULT NULL,
  `ancienneValeur` varchar(100) DEFAULT NULL,
  `nouvelleValeur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Options`
--

CREATE TABLE `Options` (
  `idOption` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Poste`
--

CREATE TABLE `Poste` (
  `idPoste` int(11) NOT NULL,
  `poste` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Poste`
--

INSERT INTO `Poste` (`idPoste`, `poste`) VALUES
(1, 'Commercial'),
(2, 'Producteur'),
(3, 'Chef de projet'),
(4, 'Ressource Humaines'),
(5, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `SecteurActivite`
--

CREATE TABLE `SecteurActivite` (
  `idSecteur` int(11) NOT NULL,
  `secteurActivite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `SecteurActivite`
--

INSERT INTO `SecteurActivite` (`idSecteur`, `secteurActivite`) VALUES
(1, 'Bar/Restaurant'),
(2, 'Numérique'),
(3, 'Automobile'),
(4, 'Agriculteur'),
(5, 'Bien-être'),
(6, 'Loisir'),
(7, 'Transport'),
(8, 'Santé');

-- --------------------------------------------------------

--
-- Structure de la table `TandB`
--

CREATE TABLE `TandB` (
  `idTB` int(11) NOT NULL,
  `nomComplet` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) NOT NULL,
  `typeContrat` varchar(100) NOT NULL,
  `DateSignature` date NOT NULL,
  `modeRestraint` tinyint(1) NOT NULL DEFAULT '0',
  `idPoste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TandB`
--

INSERT INTO `TandB` (`idTB`, `nomComplet`, `mail`, `telephone`, `photo`, `adresse`, `typeContrat`, `DateSignature`, `modeRestraint`, `idPoste`) VALUES
(1, 'Zinedine MEGNOUCHE', 'zinedine.megnouche@tickandbox.com', '0634486943', NULL, 'Avenue edouard vaillant 13003', 'Alternance', '2021-12-03', 0, 5),
(2, 'Aissa Ouazine', 'aissa.ouazine@tickandbox.com', '0766064694', NULL, 'rue Valenton', 'Alternance', '2021-01-01', 0, 5),
(3, 'naomy berthely', 'naomy.berthely@tickandbox.com', '0601020304', 'non', '3 rue quelque part Gardanne 13120', 'Alternance', '2022-01-03', 0, 2),
(4, 'Alisée berutti', 'alise.berutti@tickandbox.com', '070341876', 'non', '42 rue somewhere in Salon', 'CDI', '2022-02-01', 0, 1),
(6, 'adam meunier', 'adam.meunier@tickandbox.com', '0632854402', 'non', '32 rue jesais pas Paysanne', 'Alternance', '2022-03-09', 0, 2),
(7, 'Roy KHUN', 'roy.khun@tickandbox.com', '0634214557', '', '4 rue du club hyppique aix', 'CDI', '2022-01-01', 0, 5),
(8, 'Nawel Tamaste', 'nawel.tamaste@tickandbox.com', '0651186512', '', 'Gardanne', 'CDI', '2020-07-27', 0, 4),
(9, 'Chloe Jacob', 'chloe.jacob@tickandbox.com', '0679105120', 'non', 'la valentine', 'CDI', '2022-07-28', 0, 3),
(10, 'Test prod', 'test.prod@tickandbox.com', '0520432301', '', 'Marseille', 'Alternant', '2022-07-28', 0, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CallTracking`
--
ALTER TABLE `CallTracking`
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`idClient`),
  ADD KEY `idSecteur` (`idSecteur`),
  ADD KEY `idForfait` (`idForfait`),
  ADD KEY `idTB` (`idTB`);

--
-- Index pour la table `connexionClient`
--
ALTER TABLE `connexionClient`
  ADD PRIMARY KEY (`mailConnexion`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `connexionTB`
--
ALTER TABLE `connexionTB`
  ADD PRIMARY KEY (`mailConnexion`),
  ADD KEY `idTB` (`idTB`);

--
-- Index pour la table `Constitue`
--
ALTER TABLE `Constitue`
  ADD KEY `idForfait` (`idForfait`),
  ADD KEY `idOption` (`idOption`);

--
-- Index pour la table `Forfait`
--
ALTER TABLE `Forfait`
  ADD PRIMARY KEY (`idForfait`);

--
-- Index pour la table `HistoriqueConnexionClient`
--
ALTER TABLE `HistoriqueConnexionClient`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `HistoriqueConnexionTB`
--
ALTER TABLE `HistoriqueConnexionTB`
  ADD PRIMARY KEY (`idTB`);

--
-- Index pour la table `Modification`
--
ALTER TABLE `Modification`
  ADD KEY `idTB` (`idTB`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `Options`
--
ALTER TABLE `Options`
  ADD PRIMARY KEY (`idOption`);

--
-- Index pour la table `Poste`
--
ALTER TABLE `Poste`
  ADD PRIMARY KEY (`idPoste`);

--
-- Index pour la table `SecteurActivite`
--
ALTER TABLE `SecteurActivite`
  ADD PRIMARY KEY (`idSecteur`);

--
-- Index pour la table `TandB`
--
ALTER TABLE `TandB`
  ADD PRIMARY KEY (`idTB`),
  ADD KEY `idPoste` (`idPoste`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Forfait`
--
ALTER TABLE `Forfait`
  MODIFY `idForfait` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Options`
--
ALTER TABLE `Options`
  MODIFY `idOption` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Poste`
--
ALTER TABLE `Poste`
  MODIFY `idPoste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `SecteurActivite`
--
ALTER TABLE `SecteurActivite`
  MODIFY `idSecteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `TandB`
--
ALTER TABLE `TandB`
  MODIFY `idTB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CallTracking`
--
ALTER TABLE `CallTracking`
  ADD CONSTRAINT `calltracking_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`);

--
-- Contraintes pour la table `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `client_ibfk_3` FOREIGN KEY (`idSecteur`) REFERENCES `SecteurActivite` (`idSecteur`),
  ADD CONSTRAINT `client_ibfk_4` FOREIGN KEY (`idForfait`) REFERENCES `Forfait` (`idForfait`),
  ADD CONSTRAINT `client_ibfk_5` FOREIGN KEY (`idTB`) REFERENCES `TandB` (`idTB`);

--
-- Contraintes pour la table `connexionClient`
--
ALTER TABLE `connexionClient`
  ADD CONSTRAINT `connexionclient_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`);

--
-- Contraintes pour la table `connexionTB`
--
ALTER TABLE `connexionTB`
  ADD CONSTRAINT `connexiontb_ibfk_1` FOREIGN KEY (`idTB`) REFERENCES `TandB` (`idTB`);

--
-- Contraintes pour la table `Constitue`
--
ALTER TABLE `Constitue`
  ADD CONSTRAINT `constitue_ibfk_3` FOREIGN KEY (`idForfait`) REFERENCES `Forfait` (`idForfait`),
  ADD CONSTRAINT `constitue_ibfk_4` FOREIGN KEY (`idOption`) REFERENCES `Options` (`idOption`);

--
-- Contraintes pour la table `HistoriqueConnexionClient`
--
ALTER TABLE `HistoriqueConnexionClient`
  ADD CONSTRAINT `historiqueconnexionclient_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`);

--
-- Contraintes pour la table `HistoriqueConnexionTB`
--
ALTER TABLE `HistoriqueConnexionTB`
  ADD CONSTRAINT `historiqueconnexiontb_ibfk_1` FOREIGN KEY (`idTB`) REFERENCES `TandB` (`idTB`);

--
-- Contraintes pour la table `Modification`
--
ALTER TABLE `Modification`
  ADD CONSTRAINT `modification_ibfk_2` FOREIGN KEY (`idTB`) REFERENCES `TandB` (`idTB`),
  ADD CONSTRAINT `modification_ibfk_3` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`);

--
-- Contraintes pour la table `TandB`
--
ALTER TABLE `TandB`
  ADD CONSTRAINT `tandb_ibfk_1` FOREIGN KEY (`idPoste`) REFERENCES `Poste` (`idPoste`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
