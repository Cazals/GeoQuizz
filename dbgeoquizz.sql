-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 16 Décembre 2017 à 15:01
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbgeoquizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `gqplace`
--

CREATE TABLE `gqplace` (
  `PlaceId` int(11) NOT NULL,
  `PlaceAddress` varchar(255) DEFAULT NULL,
  `PlaceLat` int(11) DEFAULT NULL,
  `PlaceLon` int(11) DEFAULT NULL,
  `PlacePrice` decimal(15,3) DEFAULT NULL,
  `UsrId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gqrent`
--

CREATE TABLE `gqrent` (
  `RenPlaceId` int(11) NOT NULL,
  `RenDateWalk` datetime DEFAULT NULL,
  `RenPointsAdded` int(11) DEFAULT NULL,
  `UsrId` int(11) DEFAULT NULL,
  `UsrId_gqUser` int(11) DEFAULT NULL,
  `PlaceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gqstatus`
--

CREATE TABLE `gqstatus` (
  `StatusId` int(11) NOT NULL,
  `StatusLabel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqstatus`
--

INSERT INTO `gqstatus` (`StatusId`, `StatusLabel`) VALUES
(1, 'Valid');

-- --------------------------------------------------------

--
-- Structure de la table `gqtransaction`
--

CREATE TABLE `gqtransaction` (
  `TransId` int(11) NOT NULL,
  `TransDate` datetime DEFAULT NULL,
  `TransType` varchar(30) DEFAULT NULL,
  `TransPoints` int(11) DEFAULT NULL,
  `UsrId` int(11) DEFAULT NULL,
  `UsrId_gqUser` int(11) DEFAULT NULL,
  `PlaceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gquser`
--

CREATE TABLE `gquser` (
  `UsrId` int(11) NOT NULL,
  `UsrLogin` varchar(50) DEFAULT NULL,
  `UsrEmail` varchar(150) NOT NULL,
  `UsrFirstName` varchar(50) DEFAULT NULL,
  `UsrLastName` varchar(50) DEFAULT NULL,
  `UsrAddress` varchar(255) DEFAULT NULL,
  `UsrPassword` varchar(20) DEFAULT NULL,
  `UsrPointsBalance` int(11) DEFAULT NULL,
  `UsrRegisterDate` date DEFAULT NULL,
  `UsrLastConnexionDate` date DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gquser`
--

INSERT INTO `gquser` (`UsrId`, `UsrLogin`, `UsrEmail`, `UsrFirstName`, `UsrLastName`, `UsrAddress`, `UsrPassword`, `UsrPointsBalance`, `UsrRegisterDate`, `UsrLastConnexionDate`, `StatusId`) VALUES
(1, 'ThomZeBoss', 'tom@tom.tom', 'Groot', 'Groot', 'Groot', 'azerty', 500, '2017-10-29', '2017-10-29', 1),
(2, 'MathLeCaïd', 'mamt@bob', 'Matthieu', 'Balondrade', '25 rue des fraises', '1234', 30, '2017-12-13', '2017-12-13', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `gqplace`
--
ALTER TABLE `gqplace`
  ADD PRIMARY KEY (`PlaceId`),
  ADD KEY `FK_gqPlace_UsrId` (`UsrId`);

--
-- Index pour la table `gqrent`
--
ALTER TABLE `gqrent`
  ADD PRIMARY KEY (`RenPlaceId`),
  ADD KEY `FK_gqRent_UsrId` (`UsrId`),
  ADD KEY `FK_gqRent_UsrId_gqUser` (`UsrId_gqUser`),
  ADD KEY `FK_gqRent_PlaceId` (`PlaceId`);

--
-- Index pour la table `gqstatus`
--
ALTER TABLE `gqstatus`
  ADD PRIMARY KEY (`StatusId`);

--
-- Index pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  ADD PRIMARY KEY (`TransId`),
  ADD KEY `FK_gqTransaction_UsrId` (`UsrId`),
  ADD KEY `FK_gqTransaction_UsrId_gqUser` (`UsrId_gqUser`),
  ADD KEY `FK_gqTransaction_PlaceId` (`PlaceId`);

--
-- Index pour la table `gquser`
--
ALTER TABLE `gquser`
  ADD PRIMARY KEY (`UsrId`),
  ADD KEY `FK_gqUser_StatusId` (`StatusId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `gqplace`
--
ALTER TABLE `gqplace`
  MODIFY `PlaceId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `gqstatus`
--
ALTER TABLE `gqstatus`
  MODIFY `StatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  MODIFY `TransId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `gquser`
--
ALTER TABLE `gquser`
  MODIFY `UsrId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gqplace`
--
ALTER TABLE `gqplace`
  ADD CONSTRAINT `FK_gqPlace_UsrId` FOREIGN KEY (`UsrId`) REFERENCES `gquser` (`UsrId`);

--
-- Contraintes pour la table `gqrent`
--
ALTER TABLE `gqrent`
  ADD CONSTRAINT `FK_gqRent_PlaceId` FOREIGN KEY (`PlaceId`) REFERENCES `gqplace` (`PlaceId`),
  ADD CONSTRAINT `FK_gqRent_UsrId` FOREIGN KEY (`UsrId`) REFERENCES `gquser` (`UsrId`),
  ADD CONSTRAINT `FK_gqRent_UsrId_gqUser` FOREIGN KEY (`UsrId_gqUser`) REFERENCES `gquser` (`UsrId`);

--
-- Contraintes pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  ADD CONSTRAINT `FK_gqTransaction_PlaceId` FOREIGN KEY (`PlaceId`) REFERENCES `gqplace` (`PlaceId`),
  ADD CONSTRAINT `FK_gqTransaction_UsrId` FOREIGN KEY (`UsrId`) REFERENCES `gquser` (`UsrId`),
  ADD CONSTRAINT `FK_gqTransaction_UsrId_gqUser` FOREIGN KEY (`UsrId_gqUser`) REFERENCES `gquser` (`UsrId`);

--
-- Contraintes pour la table `gquser`
--
ALTER TABLE `gquser`
  ADD CONSTRAINT `FK_gqUser_StatusId` FOREIGN KEY (`StatusId`) REFERENCES `gqstatus` (`StatusId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
