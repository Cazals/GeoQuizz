-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 09 Janvier 2018 à 11:06
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `geoquizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `gqparameters`
--

CREATE TABLE `gqparameters` (
  `parId` int(11) NOT NULL,
  `parLabel` varchar(150) DEFAULT NULL,
  `parValue` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqparameters`
--

INSERT INTO `gqparameters` (`parId`, `parLabel`, `parValue`) VALUES
(1, 'BasePoint', '20');

-- --------------------------------------------------------

--
-- Structure de la table `gqplace`
--

CREATE TABLE `gqplace` (
  `plcId` int(11) NOT NULL,
  `plcName` varchar(100) DEFAULT NULL,
  `plcAddress` varchar(255) DEFAULT NULL,
  `plcLat` float(10,6) DEFAULT NULL,
  `plcLon` float(10,6) DEFAULT NULL,
  `plcPrice` decimal(15,3) DEFAULT NULL,
  `plcWkPrice` int(11) DEFAULT NULL,
  `plcUsrIdOwner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqplace`
--

INSERT INTO `gqplace` (`plcId`, `plcName`, `plcAddress`, `plcLat`, `plcLon`, `plcPrice`, `plcWkPrice`, `plcUsrIdOwner`) VALUES
(1, 'Capitole', '13 Place du Capitole, 31000 Toulouse, France', 43.604389, 1.443372, '15.000', 3, 2),
(2, 'Gare Matabiau', '64 Boulevard Pierre Semard, 31079 Toulouse, France', 43.611237, 1.453747, '10.000', 2, 1),
(3, 'Appartement Thomas', '230 Avenue de Castres, 31500 Toulouse, France', 43.594231, 1.489365, '5.000', 1, 1),
(4, 'CESI', '6 Rue Magellan, 31670 Labège, France', 43.548317, 1.502877, '10.000', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `gqstatus`
--

CREATE TABLE `gqstatus` (
  `stsId` int(11) NOT NULL,
  `stsLabel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqstatus`
--

INSERT INTO `gqstatus` (`stsId`, `stsLabel`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Banned');

-- --------------------------------------------------------

--
-- Structure de la table `gqtransaction`
--

CREATE TABLE `gqtransaction` (
  `transId` int(11) NOT NULL,
  `transDate` datetime DEFAULT NULL,
  `transType` int(11) DEFAULT NULL,
  `transPoints` int(11) DEFAULT NULL,
  `transUsrIdBuyer` int(11) DEFAULT NULL,
  `transUsrIdSeller` int(11) DEFAULT NULL,
  `transPlaceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqtransaction`
--

INSERT INTO `gqtransaction` (`transId`, `transDate`, `transType`, `transPoints`, `transUsrIdBuyer`, `transUsrIdSeller`, `transPlaceId`) VALUES
(2, '2017-12-11 00:00:00', 1, 5, 1, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `gqtranstype`
--

CREATE TABLE `gqtranstype` (
  `trtypId` int(11) NOT NULL,
  `trtypLabel` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqtranstype`
--

INSERT INTO `gqtranstype` (`trtypId`, `trtypLabel`) VALUES
(1, 'BuyEmpty'),
(2, 'BuyOwned'),
(3, 'Sell');

-- --------------------------------------------------------

--
-- Structure de la table `gquser`
--

CREATE TABLE `gquser` (
  `usrId` int(11) NOT NULL,
  `usrLogin` varchar(50) DEFAULT NULL,
  `usrEmail` varchar(150) NOT NULL,
  `usrFirstName` varchar(50) DEFAULT NULL,
  `usrLastName` varchar(50) DEFAULT NULL,
  `usrAddress` varchar(255) DEFAULT NULL,
  `usrPassword` varchar(20) DEFAULT NULL,
  `usrPointsBalance` int(11) DEFAULT NULL,
  `usrRegisterDate` datetime DEFAULT NULL,
  `usrLastConnectionDate` datetime DEFAULT NULL,
  `usrStsId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gquser`
--

INSERT INTO `gquser` (`usrId`, `usrLogin`, `usrEmail`, `usrFirstName`, `usrLastName`, `usrAddress`, `usrPassword`, `usrPointsBalance`, `usrRegisterDate`, `usrLastConnectionDate`, `usrStsId`) VALUES
(1, 'Thomas', 'tom@tom', 'Thomas', 'Cazals', '230 avenue de Castres 31500 Toulouse', 'azerty', 506, '2017-10-29 00:00:00', '2017-10-29 00:00:00', 1),
(2, 'Matthieu', 'mamt@bob', 'Matthieu', 'Balondrade', '25 rue des fraises 69 001 Lyon', '1234', 36, '2017-12-13 00:00:00', '2017-12-13 00:00:00', 2),
(3, 'Boulbi', 'thofsm', 'tgtgtg', 'gtgtg', '25 rue des marguerites', 'tom', 33, '2018-01-09 11:57:29', '2018-01-09 11:57:29', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gqwalk`
--

CREATE TABLE `gqwalk` (
  `wkDateWalk` datetime DEFAULT NULL,
  `wkUsrIdOwner` int(11) DEFAULT NULL,
  `wkUsrIdWalker` int(11) DEFAULT NULL,
  `wkPlaceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gqwalk`
--

INSERT INTO `gqwalk` (`wkDateWalk`, `wkUsrIdOwner`, `wkUsrIdWalker`, `wkPlaceId`) VALUES
('2017-12-18 00:00:00', 1, 2, 3),
('2018-01-09 09:33:00', 2, 1, 1),
('2018-01-09 10:39:19', 2, 1, 1),
('2018-01-09 12:04:13', 2, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `gqparameters`
--
ALTER TABLE `gqparameters`
  ADD PRIMARY KEY (`parId`);

--
-- Index pour la table `gqplace`
--
ALTER TABLE `gqplace`
  ADD PRIMARY KEY (`plcId`),
  ADD KEY `FK_gqPlace_UsrId` (`plcUsrIdOwner`);

--
-- Index pour la table `gqstatus`
--
ALTER TABLE `gqstatus`
  ADD PRIMARY KEY (`stsId`);

--
-- Index pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  ADD PRIMARY KEY (`transId`),
  ADD KEY `FK_gqTransaction_UsrId` (`transUsrIdBuyer`),
  ADD KEY `FK_gqTransaction_UsrId_gqUser` (`transUsrIdSeller`),
  ADD KEY `FK_gqTransaction_PlaceId` (`transPlaceId`),
  ADD KEY `FK_gqTransaction_trtypId` (`transType`);

--
-- Index pour la table `gqtranstype`
--
ALTER TABLE `gqtranstype`
  ADD PRIMARY KEY (`trtypId`);

--
-- Index pour la table `gquser`
--
ALTER TABLE `gquser`
  ADD PRIMARY KEY (`usrId`),
  ADD KEY `FK_gqUser_StatusId` (`usrStsId`);

--
-- Index pour la table `gqwalk`
--
ALTER TABLE `gqwalk`
  ADD KEY `FK_gqRent_UsrId` (`wkUsrIdOwner`),
  ADD KEY `FK_gqRent_UsrId_gqUser` (`wkUsrIdWalker`),
  ADD KEY `FK_gqRent_PlaceId` (`wkPlaceId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `gqparameters`
--
ALTER TABLE `gqparameters`
  MODIFY `parId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `gqplace`
--
ALTER TABLE `gqplace`
  MODIFY `plcId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `gqstatus`
--
ALTER TABLE `gqstatus`
  MODIFY `stsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  MODIFY `transId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `gqtranstype`
--
ALTER TABLE `gqtranstype`
  MODIFY `trtypId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `gquser`
--
ALTER TABLE `gquser`
  MODIFY `usrId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gqplace`
--
ALTER TABLE `gqplace`
  ADD CONSTRAINT `FK_gqPlace_UsrId` FOREIGN KEY (`plcUsrIdOwner`) REFERENCES `gquser` (`usrId`);

--
-- Contraintes pour la table `gqtransaction`
--
ALTER TABLE `gqtransaction`
  ADD CONSTRAINT `FK_gqTransaction_PlaceId` FOREIGN KEY (`transPlaceId`) REFERENCES `gqplace` (`plcId`),
  ADD CONSTRAINT `FK_gqTransaction_UsrId` FOREIGN KEY (`transUsrIdBuyer`) REFERENCES `gquser` (`usrId`),
  ADD CONSTRAINT `FK_gqTransaction_UsrId_gqUser` FOREIGN KEY (`transUsrIdSeller`) REFERENCES `gquser` (`usrId`),
  ADD CONSTRAINT `FK_gqTransaction_trtypId` FOREIGN KEY (`transType`) REFERENCES `gqtranstype` (`trtypId`);

--
-- Contraintes pour la table `gquser`
--
ALTER TABLE `gquser`
  ADD CONSTRAINT `FK_gqUser_StatusId` FOREIGN KEY (`usrStsId`) REFERENCES `gqstatus` (`stsId`);

--
-- Contraintes pour la table `gqwalk`
--
ALTER TABLE `gqwalk`
  ADD CONSTRAINT `FK_gqRent_PlaceId` FOREIGN KEY (`wkPlaceId`) REFERENCES `gqplace` (`plcId`),
  ADD CONSTRAINT `FK_gqRent_UsrId` FOREIGN KEY (`wkUsrIdOwner`) REFERENCES `gquser` (`usrId`),
  ADD CONSTRAINT `FK_gqRent_UsrId_gqUser` FOREIGN KEY (`wkUsrIdWalker`) REFERENCES `gquser` (`usrId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
