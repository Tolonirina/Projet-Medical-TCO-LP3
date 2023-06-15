-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Février 2019 à 12:50
-- Version du serveur :  5.6.24
-- Version de PHP :  5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cabinet`
--

-- --------------------------------------------------------

--
-- Structure de la table `analyse`
--

CREATE TABLE IF NOT EXISTS `analyse` (
  `Id_ana` int(11) NOT NULL,
  `Id_Pas` int(11) NOT NULL,
  `Observation` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `FaieLe` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `analyse`
--

INSERT INTO `analyse` (`Id_ana`, `Id_Pas`, `Observation`, `FaieLe`) VALUES
(2, 44, '', '2019-02-18');

-- --------------------------------------------------------

--
-- Structure de la table `analyseparamtre`
--

CREATE TABLE IF NOT EXISTS `analyseparamtre` (
  `id_aP` int(11) NOT NULL,
  `Id_ana` int(11) NOT NULL,
  `Id_Para` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `analyseparamtre`
--

INSERT INTO `analyseparamtre` (`id_aP`, `Id_ana`, `Id_Para`) VALUES
(2, 2, 6),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE IF NOT EXISTS `consultation` (
  `Id_con` int(11) NOT NULL,
  `Id_Pat` int(11) NOT NULL,
  `Date_Cons` date NOT NULL,
  `Type_Cons` int(11) NOT NULL,
  `Heure` time NOT NULL,
  `poids` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` float NOT NULL,
  `Observation` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `consultation`
--

INSERT INTO `consultation` (`Id_con`, `Id_Pat`, `Date_Cons`, `Type_Cons`, `Heure`, `poids`, `Prix`, `Observation`) VALUES
(27, 34, '2019-02-11', 0, '16:47:00', '90', 200, 'iuysdiub SHSD sdis'),
(28, 35, '2019-02-11', 1, '16:53:00', '12', 0, 'ds'),
(29, 34, '2019-02-11', 1, '16:56:00', '98', 0, 'dsd'),
(30, 36, '2019-02-11', 0, '17:30:00', '150 KG', 300, 'fdsf'),
(31, 37, '2019-02-11', 1, '17:32:00', '70', 0, 'ds'),
(32, 0, '1970-01-01', 0, '19:24:00', '', 0, ''),
(33, 37, '1970-01-01', 0, '11:54:00', '', 0, ''),
(34, 38, '2019-02-17', 0, '12:04:00', '45', 300, 'jdd dd sq '),
(44, 44, '2019-02-18', 0, '17:57:00', '60kg', 300, 'votre observation');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE IF NOT EXISTS `medicament` (
  `Id_Med` int(11) NOT NULL,
  `Nom_Med` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `Commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `Date_Ce` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `medicament`
--

INSERT INTO `medicament` (`Id_Med`, `Nom_Med`, `Commentaire`, `Date_Ce`) VALUES
(13, 'HELICOCIN 750/500 , ComprimÃ© enrobÃ© ', '', '2019-02-18'),
(14, 'IRBESAR SUN 150MG, COMPRIMÃ‰ ', '', '2019-02-18'),
(15, 'MEZOR 40 MG, GÃ©lule ', '', '2019-02-18'),
(16, 'TAREG 160 MG, ComprimÃ© pelliculÃ© ', '', '2019-02-18'),
(17, 'DOLIPRANE 1000 MG', '', '2019-02-18');

-- --------------------------------------------------------

--
-- Structure de la table `npaiment`
--

CREATE TABLE IF NOT EXISTS `npaiment` (
  `Id_Np` int(11) NOT NULL,
  `Id_Pats` int(11) NOT NULL,
  `NMonatant` float NOT NULL,
  `Titre` varchar(200) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Date_crea` date NOT NULL,
  `Observation` varchar(600) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `npaiment`
--

INSERT INTO `npaiment` (`Id_Np`, `Id_Pats`, `NMonatant`, `Titre`, `Date_crea`, `Observation`) VALUES
(3, 36, 7000, 'soin des dentes ', '2019-02-16', 'on decidÃ© de deviser le montant sur 6 sÃ©ances '),
(4, 38, 300, 'la grippe', '2019-02-17', 'dsds'),
(5, 39, 5000, 'sds', '2019-02-17', 'dsd'),
(6, 44, 4000, 'soins et traitements dentaires rÃ©guliers', '2019-02-18', '');

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

CREATE TABLE IF NOT EXISTS `ordonnance` (
  `Id_ord` int(11) NOT NULL,
  `Id_pats` int(11) NOT NULL,
  `ListMedicament` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date_Odr` date NOT NULL,
  `heureOr` time NOT NULL,
  `Observation` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Usage1` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ordonnance`
--

INSERT INTO `ordonnance` (`Id_ord`, `Id_pats`, `ListMedicament`, `date_Odr`, `heureOr`, `Observation`, `Usage1`) VALUES
(13, 36, 'paracitamole', '2019-02-16', '14:02:00', 'sdd', 'mesd'),
(14, 38, 'doliprane,paracitamole', '2019-02-17', '13:02:00', '', '3f/j (30j) apres le repat<br />\n4f/j (30j) apres le repat'),
(15, 39, 'doliprane', '2019-02-17', '19:02:00', 'votre observation', '3f/j (2 semaine)'),
(18, 44, 'HELICOCIN 750/500 , ComprimÃ© enrobÃ© ,MEZOR 40 MG, GÃ©lule ', '2019-02-18', '18:02:00', 'votres observation', '2f/j (2semaines)<br />\n3f/j (1semaines)');

-- --------------------------------------------------------

--
-- Structure de la table `paiment`
--

CREATE TABLE IF NOT EXISTS `paiment` (
  `Id_Pai` int(11) NOT NULL,
  `Id_P` int(11) NOT NULL,
  `Date_Pai` date NOT NULL,
  `Heur_P` time NOT NULL,
  `MontantT` float NOT NULL,
  `MAvance` float NOT NULL,
  `Obervation` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `id_NP` int(11) NOT NULL,
  `NouveuOrCnti` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paiment`
--

INSERT INTO `paiment` (`Id_Pai`, `Id_P`, `Date_Pai`, `Heur_P`, `MontantT`, `MAvance`, `Obervation`, `id_NP`, `NouveuOrCnti`) VALUES
(13, 0, '2019-02-16', '20:29:00', 0, 2500, 'premier seance vous avez pai 2500', 3, ''),
(14, 0, '2019-02-16', '23:24:00', 0, 250, 'dsds', 3, ''),
(15, 0, '2019-02-16', '23:24:00', 0, 500, 'dsd', 3, ''),
(16, 0, '2019-02-16', '23:24:00', 0, 700, '', 3, ''),
(17, 0, '2019-02-16', '23:24:00', 0, 1000, '', 3, ''),
(18, 0, '2019-02-17', '13:07:00', 0, 300, 'sdksqm', 4, ''),
(19, 0, '2019-02-17', '19:49:00', 0, 300, 'fsdf', 5, ''),
(20, 0, '2019-02-18', '19:00:00', 0, 500, 'observation ..', 6, ''),
(21, 0, '2019-02-18', '19:01:00', 0, 400, '', 6, ''),
(22, 0, '2019-02-18', '19:01:00', 0, 2000, '', 6, '');

-- --------------------------------------------------------

--
-- Structure de la table `paramanalyse`
--

CREATE TABLE IF NOT EXISTS `paramanalyse` (
  `id_PAR` int(11) NOT NULL,
  `NomPar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Observation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dateCrea` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paramanalyse`
--

INSERT INTO `paramanalyse` (`id_PAR`, `NomPar`, `Type`, `Observation`, `dateCrea`) VALUES
(2, 'Groupage sanguin ABO RH', 'Analyse', '', '2019-02-18'),
(3, 'HÃ©patite A IgM', 'Analyse', '', '2019-02-18'),
(4, 'Cryoglobuline', 'Analyse', '', '2019-02-18'),
(5, 'DÃ©pistage dâ€™une cryoglobuline', 'Analyse', '', '2019-02-18'),
(6, 'HyperglycÃ©mie ProvoquÃ©e per OS', 'Analyse', '', '2019-02-18');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `Id_pat` int(11) NOT NULL,
  `CIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Nom_Pat` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom_Pat` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DateNaissance` date NOT NULL,
  `Telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `DateCreation` date NOT NULL,
  `Sexe` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`Id_pat`, `CIN`, `Nom_Pat`, `Prenom_Pat`, `DateNaissance`, `Telephone`, `Email`, `Adresse`, `DateCreation`, `Sexe`) VALUES
(44, 'AE1000', 'Ahmed', 'Mohamed', '1990-05-10', '06000000', 'ahmedmohamed@gmail.com', 'rabat', '0000-00-00', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE IF NOT EXISTS `rendezvous` (
  `Id_Rend` int(11) NOT NULL,
  `Id_Pat` int(11) NOT NULL,
  `DateRend` date NOT NULL,
  `StartH` time NOT NULL,
  `EndH` time NOT NULL,
  `TitreRe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ObservationRend` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `StartTime` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `EndTime` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `DateIns` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `rendezvous`
--

INSERT INTO `rendezvous` (`Id_Rend`, `Id_Pat`, `DateRend`, `StartH`, `EndH`, `TitreRe`, `ObservationRend`, `StartTime`, `EndTime`, `DateIns`) VALUES
(13, 44, '2019-02-19', '08:00:00', '08:10:00', 'titre de rendez vous', 'votres observation', 'Tue Feb 19 2019 08:00:00 GMT+0000 (Greenwich Mean Time)', 'Tue Feb 19 2019 08:10:00 GMT+0000 (Greenwich Mean Time)', '2019-02-18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id_user` int(11) NOT NULL,
  `UserName` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `Specialite` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `FonctionL` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreation` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`Id_user`, `UserName`, `Password`, `Specialite`, `FonctionL`, `dateCreation`) VALUES
(6, 'usertest', '123', 'MÃ©decin gÃ©nÃ©raliste', 'MÃ©decin', '0000-00-00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `analyse`
--
ALTER TABLE `analyse`
  ADD PRIMARY KEY (`Id_ana`);

--
-- Index pour la table `analyseparamtre`
--
ALTER TABLE `analyseparamtre`
  ADD PRIMARY KEY (`id_aP`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`Id_con`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`Id_Med`);

--
-- Index pour la table `npaiment`
--
ALTER TABLE `npaiment`
  ADD PRIMARY KEY (`Id_Np`);

--
-- Index pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD PRIMARY KEY (`Id_ord`);

--
-- Index pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD PRIMARY KEY (`Id_Pai`);

--
-- Index pour la table `paramanalyse`
--
ALTER TABLE `paramanalyse`
  ADD PRIMARY KEY (`id_PAR`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Id_pat`), ADD UNIQUE KEY `CIN` (`CIN`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`Id_Rend`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `analyse`
--
ALTER TABLE `analyse`
  MODIFY `Id_ana` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `analyseparamtre`
--
ALTER TABLE `analyseparamtre`
  MODIFY `id_aP` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `Id_con` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `Id_Med` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `npaiment`
--
ALTER TABLE `npaiment`
  MODIFY `Id_Np` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  MODIFY `Id_ord` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `paiment`
--
ALTER TABLE `paiment`
  MODIFY `Id_Pai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `paramanalyse`
--
ALTER TABLE `paramanalyse`
  MODIFY `id_PAR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `Id_pat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `Id_Rend` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
