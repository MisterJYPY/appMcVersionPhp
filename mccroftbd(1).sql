-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 22 Janvier 2017 à 14:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mccroftbd`
--
CREATE DATABASE IF NOT EXISTS `mccroftbd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mccroftbd`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `famille` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `unite` varchar(40) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `famille` (`famille`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `code`, `famille`, `designation`, `unite`, `derniere_modif`) VALUES
(1, 'art1123', 10, 'Tabac Scaferlati\r\n', '', '2017-01-05 15:51:20'),
(2, 'mtAZ122fgd', 10, 'Carton Emballage\r\n', '', '2017-01-05 15:51:20'),
(3, 'bonFDD12', 9, 'Bon de recu de caisse', '', '2017-01-05 15:51:20'),
(4, 'bon156F', 9, 'Bon de sortie de caisse\r\n', '', '2017-01-05 15:51:20'),
(5, 'Artfdg135', 8, 'T-short blanc Instant free\r\n', '', '2017-01-05 15:51:20'),
(6, 'Article1244', 8, 'T-short blanc MC\r\n', '', '2017-01-05 15:51:20'),
(7, 'cs344545', 7, 'Corps chauffant pour barillet (220/600W)\r\n', '', '2017-01-05 15:51:20'),
(8, 'cs786FE3', 7, 'Ballastre BTA 18L31\r\n', '', '2017-01-05 15:51:20'),
(9, 'ab5667kf', 6, 'Tuyau orange No 11\r\n', '', '2017-01-05 15:51:20'),
(10, 'pm455', 6, 'Pelle a manche', '', '2017-01-05 15:51:20'),
(11, 'cr4556FEEE', 1, 'Courroie A864\r\n', '', '2017-01-05 15:51:20'),
(12, 'cr78944jjj', 1, 'Courroie A864\r\n', '', '2017-01-05 15:51:20'),
(13, 'Pac56TYF', 2, 'Packer 1\r\n', '', '2017-01-05 15:51:20'),
(14, 'Pac677FFR\r\n', 2, 'Packer 2\r\n', '', '2017-01-05 15:51:20'),
(15, 'rg', 3, 'Rouleau gommeur\r\n', '', '2017-01-05 15:51:20'),
(16, 'ctl', 3, 'Couteau circulaire lisse\r\n', '', '2017-01-05 15:51:20'),
(17, 'balyfrf', 4, 'EAU DE JAVEL \r\n', '', '2017-01-05 15:51:20'),
(18, 'bl34455FFDF', 4, 'BALAIS  INTERIEUR\r\n', '', '2017-01-05 15:51:20'),
(19, 'fdtttss', 5, 'CARTOUCHE ENCRE 85A N\r\n', '', '2017-01-05 15:51:20'),
(20, 'ce12378FG', 5, 'CARTOUCHE ENCRE 901 N\r\n', '', '2017-01-05 15:51:20'),
(27, 'bon217A3Mc', 9, 'moux', '', '2017-01-05 15:59:38');

-- --------------------------------------------------------

--
-- Structure de la table `articlesdemandeachat`
--

CREATE TABLE IF NOT EXISTS `articlesdemandeachat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `demandeAchat` int(11) NOT NULL,
  `justificatif` varchar(255) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `quantiter` int(11) NOT NULL,
  `dateInsertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article` (`article`,`demandeAchat`),
  KEY `article_2` (`article`),
  KEY `demandeAchat` (`demandeAchat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Contenu de la table `articlesdemandeachat`
--

INSERT INTO `articlesdemandeachat` (`id`, `article`, `demandeAchat`, `justificatif`, `observation`, `quantiter`, `dateInsertion`) VALUES
(98, 6, 112, '', '', 26, '2016-12-29 23:09:50'),
(99, 13, 112, '', '', 37, '2016-12-29 23:09:50'),
(100, 15, 112, '', '', 7, '2016-12-29 23:11:31'),
(101, 15, 113, 'manque', 'pas gde chose', 10, '2016-12-29 23:34:05'),
(102, 10, 114, '', 'tttt', 104, '2017-01-05 08:16:15'),
(103, 16, 115, '', '', 3, '2016-12-30 09:47:57'),
(104, 10, 116, '', '', 2, '2016-12-30 09:53:48'),
(105, 6, 117, 'ffff', 'eee', 4, '2017-01-04 09:03:37'),
(106, 11, 118, '', '', 2, '2017-01-05 11:52:22'),
(107, 5, 119, '', '', 5000, '2017-01-06 10:32:18'),
(108, 6, 119, '', '', 2000, '2017-01-06 10:32:18'),
(109, 18, 119, '', '', 5, '2017-01-06 10:32:18'),
(110, 4, 119, '', '', 5, '2017-01-06 10:32:18'),
(111, 6, 120, '', 'hfhhf', 3, '2017-01-22 13:26:20'),
(112, 2, 121, '', '', 3, '2017-01-22 13:32:44'),
(113, 1, 121, '', '', 26, '2017-01-22 13:32:44'),
(114, 6, 122, '', '', 4, '2017-01-22 13:57:51'),
(115, 1, 122, '', '', 2, '2017-01-22 13:57:52'),
(116, 9, 123, '', '', 100, '2017-01-22 13:59:17'),
(117, 6, 123, '', '', 1000, '2017-01-22 13:59:17'),
(118, 4, 123, '', '', 2000, '2017-01-22 13:59:18'),
(119, 6, 124, '', '', 23, '2017-01-22 14:01:34'),
(120, 1, 124, '', '', 10, '2017-01-22 14:01:34'),
(121, 2, 124, '', '', 13, '2017-01-22 14:01:34');

-- --------------------------------------------------------

--
-- Structure de la table `comptes_personnel`
--

CREATE TABLE IF NOT EXISTS `comptes_personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `personnel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personnel` (`personnel`),
  KEY `personnel_2` (`personnel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `comptes_personnel`
--

INSERT INTO `comptes_personnel` (`id`, `login`, `password`, `personnel`) VALUES
(1, 'hijazi', 'aaffb2c5540e713e57892c77ead90120', 5),
(2, 'nadir', '6ea797883aeadd79107381659847c650', 6),
(4, 'anass', 'c76f271092a1518d79500f2eb10e0dca', 9),
(5, 'kassi', '4ddf69372c3d7379a4b625571eaaacaf', 10),
(6, 'nate', 'b396645fffbeb1379510ab1fccadea5d', 12),
(7, 'ambroise', 'b38dcfa27849ada388393c2d6cb8e361', 11),
(9, 'egny', 'd382e42cbf44341ee6cdd78f61649503', 13),
(10, 'oudaga', '29734f1f963e84cedded4ac695f36edd', 14),
(11, 'mariam', '13c6cf272b6dc642b9712d5dfccc2e42', 16),
(12, 'valery', 'ab007565b4a137ce4a1f93dcdf481f2c', 15),
(13, 'awa', '1b5f31288e7d4e053c4c73ec03c3a6b6', 17),
(14, 'seka', 'd3988db93f9ce3a4f8e66ea3bc98895f', 22);

-- --------------------------------------------------------

--
-- Structure de la table `cotation`
--

CREATE TABLE IF NOT EXISTS `cotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_cotation` varchar(255) NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delai_reponse` int(11) NOT NULL,
  `demandeAchat` int(11) NOT NULL,
  `expediteur` int(11) NOT NULL,
  `statut` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demandeAchat` (`demandeAchat`),
  KEY `expediteur` (`expediteur`),
  KEY `expediteur_2` (`expediteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `cotation`
--

INSERT INTO `cotation` (`id`, `code_cotation`, `date_envoi`, `delai_reponse`, `demandeAchat`, `expediteur`, `statut`) VALUES
(3, 'MCFin2751229P1', '2016-12-29 23:11:31', 2, 112, 9, 'EC'),
(4, 'MCCOM7981229P1', '2016-12-29 23:34:05', 2, 113, 9, 'EC'),
(5, 'MCLog4391230P2', '2016-12-30 09:50:01', 2, 115, 10, 'EC'),
(6, 'MCLog6751230P1', '2017-01-05 08:16:15', 2, 114, 10, 'EC'),
(7, 'MCLog1421230P3', '2017-01-05 10:43:58', 2, 116, 10, 'EC'),
(8, 'MCCOM2020105P2', '2017-01-05 11:54:34', 2, 118, 10, 'EC'),
(9, 'MCCOM3590106P3', '2017-01-06 10:34:15', 2, 119, 10, 'EC'),
(10, 'MCA.Prod5330122P1', '2017-01-22 13:26:56', 2, 120, 10, 'EC'),
(11, 'MCA.Prod2550122P2', '2017-01-22 13:33:14', 2, 121, 10, 'EC'),
(12, 'MCA.Prod5350122P3', '2017-01-22 13:57:52', 2, 122, 10, 'EC'),
(13, 'MCA.Prod1470122P4', '2017-01-22 13:59:18', 2, 123, 10, 'EC'),
(14, 'MCA.Prod4410122P5', '2017-01-22 14:01:35', 2, 124, 10, 'EC');

-- --------------------------------------------------------

--
-- Structure de la table `demandeachat`
--

CREATE TABLE IF NOT EXISTS `demandeachat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bordereaux` varchar(255) NOT NULL,
  `dateInsertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service` int(11) NOT NULL,
  `date` date NOT NULL,
  `demandeur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service` (`service`),
  KEY `demandeur` (`demandeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Contenu de la table `demandeachat`
--

INSERT INTO `demandeachat` (`id`, `bordereaux`, `dateInsertion`, `service`, `date`, `demandeur`) VALUES
(112, 'Fin2751229P1', '2016-12-29 23:09:50', 4, '2016-12-29', 12),
(113, 'COM7981229P1', '2016-12-29 23:32:18', 2, '2016-12-29', 13),
(114, 'Log6751230P1', '2016-12-30 07:59:59', 3, '2016-12-30', 5),
(115, 'Log4391230P2', '2016-12-30 09:47:57', 3, '2016-12-30', 5),
(116, 'Log1421230P3', '2016-12-30 09:53:48', 3, '2016-12-30', 5),
(117, 'Fin480104P2', '2017-01-04 09:03:37', 4, '2017-01-04', 12),
(118, 'COM2020105P2', '2017-01-05 11:52:22', 2, '2017-01-05', 6),
(119, 'COM3590106P3', '2017-01-06 10:32:17', 2, '2017-01-06', 13),
(120, 'A.Prod5330122P1', '2017-01-22 13:26:20', 1, '2017-01-22', 10),
(121, 'A.Prod2550122P2', '2017-01-22 13:32:44', 1, '2017-01-22', 10),
(122, 'A.Prod5350122P3', '2017-01-22 13:57:51', 1, '2017-01-22', 9),
(123, 'A.Prod1470122P4', '2017-01-22 13:59:17', 1, '2017-01-22', 9),
(124, 'A.Prod4410122P5', '2017-01-22 14:01:34', 1, '2017-01-22', 9);

-- --------------------------------------------------------

--
-- Structure de la table `demandesatisfaite`
--

CREATE TABLE IF NOT EXISTS `demandesatisfaite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demandeAchat` int(11) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `demandeAchat` (`demandeAchat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `demandesatisfaite`
--

INSERT INTO `demandesatisfaite` (`id`, `demandeAchat`, `derniere_modif`) VALUES
(1, 121, '2017-01-22 13:45:03');

-- --------------------------------------------------------

--
-- Structure de la table `entree_produit`
--

CREATE TABLE IF NOT EXISTS `entree_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` date NOT NULL,
  `magasin` int(11) NOT NULL,
  `dateString` varchar(150) NOT NULL,
  `stocks_avant` int(11) NOT NULL,
  `stocks_apres` int(11) NOT NULL,
  `demandeAchat` int(11) NOT NULL,
  `numeroVehicule` varchar(150) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article` (`article`,`magasin`,`demandeAchat`,`fournisseur`),
  KEY `magasin` (`magasin`),
  KEY `demandeAchat` (`demandeAchat`),
  KEY `fournisseur` (`fournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `entree_produit`
--

INSERT INTO `entree_produit` (`id`, `article`, `libelle`, `quantite`, `date`, `magasin`, `dateString`, `stocks_avant`, `stocks_apres`, `demandeAchat`, `numeroVehicule`, `fournisseur`, `derniere_modif`) VALUES
(3, 2, 'eddd', 3, '2017-01-28', 1, '28 janvier 2017', 4, 7, 121, 'jjjdtts', 3, '2017-01-22 13:44:04'),
(4, 1, 'sjssgs', 26, '2017-01-29', 3, '29 janvier 2017', 64, 90, 121, 'gdgggd', 3, '2017-01-22 13:45:03');

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE IF NOT EXISTS `famille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `code` varchar(78) NOT NULL,
  `abreviation` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`id`, `designation`, `code`, `abreviation`) VALUES
(1, 'courroie', 'CR319Mc', 'cr'),
(2, 'PDR Machine pqts', 'PDR131Mc', 'pdr'),
(3, 'Machine Cigarette', 'MCI328Mc', 'Mci'),
(4, 'produit d entretien', 'PDTE785Mc', 'pdte'),
(5, 'fourniture de bureau', 'FRB318Mc', 'frb'),
(6, 'Article batiment', 'ARTB158Mc', 'artb'),
(7, 'Piece electrique', 'PIEL630Mc', 'piel'),
(8, 'Articles pub', 'APB114Mc', 'apb'),
(9, 'Bons', 'BON41Mc', 'bon'),
(10, 'Matiere premiere', 'MP892Mc', 'mp');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL,
  `telecopie` varchar(125) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `mail`, `contacts`, `telecopie`, `derniere_modif`) VALUES
(1, 'LAMBERT', 'kklamber@gmail.com', '08 56 45 67', 'hhdhhhd', '2017-01-04 15:45:43'),
(2, 'ARNAURD', 'yves@mail.com', '09 54 54 62', 'NGGFD5663', '2017-01-04 15:45:43'),
(3, 'MALAN', 'malanpkess@gmil.com', '47 45 54 19', 'ret3452jkd', '2017-01-04 15:45:43'),
(10, 'NANOU', 'mhhhdh@hdhhd', 'KAKOU', 'gdggd677888', '2017-01-04 16:34:29'),
(12, 'kouame', 'kaksolechic@gmail.com', '34566789', '5678gdgd', '2017-01-04 16:41:16'),
(13, 'MELE', 'meletheo@gmail.com', 'THEO', '1234PPPCFGG', '2017-01-05 08:18:45'),
(14, 'LKbusiness', 'moulard@gmail.com', '09 19 78 19', '789455PPGH', '2017-01-05 08:26:23');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseursurcotation`
--

CREATE TABLE IF NOT EXISTS `fournisseursurcotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `validite` varchar(125) NOT NULL,
  `delai_livraison` text NOT NULL,
  `receptioniste` varchar(125) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `cotation` int(11) NOT NULL,
  `reglement` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fournisseur` (`fournisseur`),
  KEY `cotation` (`cotation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `fournisseursurcotation`
--

INSERT INTO `fournisseursurcotation` (`id`, `date`, `validite`, `delai_livraison`, `receptioniste`, `fournisseur`, `cotation`, `reglement`) VALUES
(1, '2016-12-30', '2 JOURS', '5 MOIS', 'ISABELLLE KOUADIO', 1, 4, 'Cheque'),
(2, '2017-01-04', '5 JOURS', 'LE 7 OUT 2018', 'PASCALE FERDINAND', 2, 4, 'comptant'),
(3, '2017-01-04', 'le 27 out 2016', 'LE 5 MARS', 'PACOME', 3, 3, 'CHEQUE'),
(4, '2017-01-04', 'des le 04 Janvier 2017', 'le 15 septembre', 'KOUAMAN EMMANUEL', 2, 3, 'cheque'),
(14, '2017-01-04', '67 jours', '45 JOURS', 'KOUAKOU FRANCOIS', 12, 5, 'cheque'),
(15, '2017-01-05', 'LE 20 JANVIER 2016', '5 JOURS APRES', 'MELE THEO', 13, 6, 'CHEQUE'),
(16, '2017-01-05', '05 JANVIER 2017', '89 JOURS', 'MOUSSA DOUMBIA', 14, 6, 'Cheque'),
(17, '2017-01-05', 'Today', 'LE 4 FEVRIER', 'KOUAME BROU', 14, 3, 'Cheque au numero 125 K323'),
(18, '2017-01-05', '30jours', 'Le 26 OUT 2015', 'KOUAME MICHEL', 2, 5, 'cheque au numero 12344'),
(19, '2017-01-05', 'Janvier ', 'le 3 fevrier 2016', 'LE TECHNO', 12, 7, 'chap chap ('''' - ")'),
(20, '2017-01-05', 'Today', 'Mars 2015', 'PAUL JYPY', 10, 7, 'chap chap'),
(21, '2017-01-22', 'LE 15 MARS Ã©Ã ', '20 MARS 2017', 'KOUAKOU', 2, 10, 'CHEQUE'),
(22, '2017-01-22', 'TODAY', '7 OUT 1985', 'LkBusiness', 14, 10, 'CHEQUE'),
(23, '2017-01-22', 'DDD', 'LE 15 MARS', 'LOJ', 3, 11, 'CHEQUE'),
(24, '2017-01-22', 'hhhf', 'Le 15 mars 2015', 'KOUAKOU LAMBERT', 3, 12, 'Cheque'),
(25, '2017-01-22', 'LE 18 JUILLET 2017', 'LE 14 MARS 2016', 'LAMBERT OUEDRAOGO', 14, 13, 'COMPTANT'),
(26, '2017-01-22', 'HDHHD', 'LE 17 JUILLET 2017', 'MIKAEL KOUADIO', 13, 14, 'CHEQUE');

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

CREATE TABLE IF NOT EXISTS `magasin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(150) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `magasin`
--

INSERT INTO `magasin` (`id`, `designation`, `derniere_modif`) VALUES
(1, 'magasin1', '2017-01-22 13:12:41'),
(2, 'magasin2', '2017-01-22 13:13:08'),
(3, 'magasin3', '2017-01-22 13:13:08');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) NOT NULL,
  `prenom` varchar(120) NOT NULL,
  `adresse` varchar(120) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `contacts` varchar(150) NOT NULL,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service` (`service`),
  KEY `service_2` (`service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`id`, `nom`, `prenom`, `adresse`, `fonction`, `service`, `contacts`, `mail`) VALUES
(5, 'MOHAMED', 'HIJAZI', 'Inconnu', 'ASSISTANT', 3, 'Inconnu', 'Inconn'),
(6, 'NADIR', 'YASSIR', 'Inconnu', 'RESPONSABLE', 2, 'Inconnu', 'Inconnu'),
(9, 'ANASS', 'BENARAFA', 'Inconnu', 'RESPONSABLE', 1, 'Inconnu', 'Inconnu'),
(10, 'KASSI', 'JULIEN', 'Inconnu', 'ASSISTANT', 1, 'Inconnu', 'kassijulien@gmail.com'),
(11, 'KOUAME', 'AMBROISE', 'Inconnu', 'RESPONSABLE', 4, 'Inconnu', 'Inconnu'),
(12, 'NATE', 'REGIS', 'Inconnu', 'COMPTABLE', 4, 'Inconnu', 'Inconnu'),
(13, 'EGNY', 'HERMANN', 'Inconnu', 'Superviseur', 2, 'Inconnu', 'Inconnu'),
(14, 'MOHAMED', 'OUDRHIRI OUDABA', 'Inconnu', 'RESPONSABLE', 3, 'Inconnu', 'Inconnu'),
(15, 'GOHOGBEU', 'TIA VALERY', 'Inconnu', 'RESPONSABLE', 5, 'Inconnu', 'Inconnu'),
(16, 'BARRY', 'MARIAM SINA', 'Inconnu', 'ASSISTANTE', 5, 'Inconnu', 'Inconnu'),
(17, 'SAWADOGO', 'AWA', 'Inconnu', 'CAISSIERE', 4, 'Inconnu', 'Inconnu'),
(18, 'N''GORAN ', 'JULES', 'Inconnu', 'SUPERVISEUR', 2, 'Inconnu', 'Inconnu'),
(19, 'CHONOU', 'GEORGES', 'Inconnu', 'Agent Commercial', 2, 'Inconnu', 'Inconnu'),
(20, 'NIAMIEN', 'YVES ARNAUD', 'Inconnu', 'Agent Commercial', 2, 'Inconnu', 'Inconnu'),
(21, 'N''KPO', 'ACHIEPO ERIC', 'Inconnu', 'Agent Commercial', 2, 'Inconnu', 'Inconnu'),
(22, 'SEKA', 'SEKA JEAN THIERRY', 'Inconnu', 'MAGASINIER', 1, 'Inconnu', 'Inconu');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(120) NOT NULL,
  `abreviation` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `services`
--

INSERT INTO `services` (`id`, `designation`, `abreviation`) VALUES
(1, 'ACHAT ET PRODUCTION', 'A.Prod'),
(2, 'COMMERCIAL', 'COM'),
(3, 'LOGISTIQUE', 'Log'),
(4, 'FINANCE ET COMPTABILITE', 'Fin'),
(5, 'JURIDIQUE ET RESSOURCES HUMAINES', 'RH');

-- --------------------------------------------------------

--
-- Structure de la table `signataire_approber`
--

CREATE TABLE IF NOT EXISTS `signataire_approber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signataire` int(11) NOT NULL,
  `heure_signature` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `demandeAchat` int(11) NOT NULL,
  PRIMARY KEY (`id`,`signataire`),
  KEY `demandeAchat` (`demandeAchat`),
  KEY `siganataire` (`signataire`),
  KEY `demandeAchat_2` (`demandeAchat`),
  KEY `siganataire_2` (`signataire`),
  KEY `demandeAchat_3` (`demandeAchat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Contenu de la table `signataire_approber`
--

INSERT INTO `signataire_approber` (`id`, `signataire`, `heure_signature`, `demandeAchat`) VALUES
(94, 12, '2016-12-29 23:09:50', 112),
(95, 11, '2016-12-29 23:10:23', 112),
(96, 10, '2016-12-29 23:10:56', 112),
(97, 9, '2016-12-29 23:11:31', 112),
(98, 13, '2016-12-29 23:32:19', 113),
(99, 6, '2016-12-29 23:33:02', 113),
(100, 10, '2016-12-29 23:33:27', 113),
(101, 9, '2016-12-29 23:34:05', 113),
(102, 5, '2016-12-30 07:59:59', 114),
(103, 14, '2016-12-30 08:03:10', 114),
(104, 10, '2016-12-30 08:04:05', 114),
(105, 5, '2016-12-30 09:47:57', 115),
(106, 14, '2016-12-30 09:48:30', 115),
(107, 10, '2016-12-30 09:48:52', 115),
(108, 9, '2016-12-30 09:50:01', 115),
(109, 5, '2016-12-30 09:53:49', 116),
(110, 14, '2016-12-30 09:54:19', 116),
(111, 10, '2016-12-30 09:54:46', 116),
(112, 12, '2017-01-04 09:03:37', 117),
(113, 11, '2017-01-04 09:04:12', 117),
(114, 9, '2017-01-05 08:16:15', 114),
(115, 9, '2017-01-05 10:43:58', 116),
(116, 6, '2017-01-05 11:52:23', 118),
(117, 10, '2017-01-05 11:53:04', 118),
(118, 9, '2017-01-05 11:54:33', 118),
(119, 13, '2017-01-06 10:32:20', 119),
(120, 6, '2017-01-06 10:33:05', 119),
(121, 10, '2017-01-06 10:33:42', 119),
(122, 9, '2017-01-06 10:34:13', 119),
(123, 10, '2017-01-22 13:26:20', 120),
(124, 9, '2017-01-22 13:26:56', 120),
(125, 10, '2017-01-22 13:32:45', 121),
(126, 9, '2017-01-22 13:33:13', 121),
(127, 9, '2017-01-22 13:57:52', 122),
(128, 9, '2017-01-22 13:59:18', 123),
(129, 9, '2017-01-22 14:01:35', 124);

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `articles` int(11) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `articles` (`articles`),
  KEY `articles_2` (`articles`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `stocks`
--

INSERT INTO `stocks` (`id`, `quantite`, `articles`, `derniere_modif`) VALUES
(1, 90, 1, '2017-01-22 13:45:03'),
(2, 56, 13, '2016-12-18 00:44:10'),
(3, 23, 6, '2016-12-23 09:24:23'),
(4, 7, 2, '2017-01-22 13:44:04'),
(5, 3, 15, '2016-12-23 10:01:09'),
(6, 3, 19, '2016-12-25 22:03:23'),
(7, 3, 3, '2016-12-30 07:49:18'),
(8, 4, 4, '2016-12-30 07:49:18'),
(14, 0, 10, '2016-12-30 07:51:31'),
(15, 6, 5, '2016-12-30 07:51:31'),
(16, 8, 7, '2016-12-30 07:51:31'),
(17, 78, 8, '2016-12-30 07:51:31'),
(18, 9, 9, '2016-12-30 07:51:31'),
(19, 6, 11, '2016-12-30 07:52:23'),
(20, 9, 12, '2016-12-30 07:52:23'),
(21, 567, 14, '2016-12-30 07:53:01'),
(22, 56, 16, '2016-12-30 07:53:01'),
(23, 9, 17, '2016-12-30 07:53:21'),
(24, 67, 18, '2016-12-30 07:53:21'),
(25, 20, 20, '2016-12-30 07:53:32'),
(32, 0, 27, '2017-01-05 15:59:38');

-- --------------------------------------------------------

--
-- Structure de la table `stocks_magasin`
--

CREATE TABLE IF NOT EXISTS `stocks_magasin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `produit` (`produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `stocks_magasin`
--

INSERT INTO `stocks_magasin` (`id`, `produit`, `quantite`, `derniere_modif`) VALUES
(1, 1, 4, '2017-01-22 13:18:39'),
(2, 1, 4, '2017-01-22 13:18:39'),
(3, 1, 4, '2017-01-22 13:18:39'),
(4, 13, 18, '2017-01-22 13:18:40'),
(5, 13, 18, '2017-01-22 13:18:40'),
(6, 13, 20, '2017-01-22 13:18:40'),
(7, 6, 7, '2017-01-22 13:18:40'),
(8, 6, 7, '2017-01-22 13:18:40'),
(9, 6, 9, '2017-01-22 13:18:40'),
(10, 2, 1, '2017-01-22 13:18:40'),
(11, 2, 1, '2017-01-22 13:18:40'),
(12, 2, 2, '2017-01-22 13:18:40'),
(13, 15, 1, '2017-01-22 13:18:41'),
(14, 15, 1, '2017-01-22 13:18:41'),
(15, 15, 1, '2017-01-22 13:18:41'),
(16, 19, 1, '2017-01-22 13:18:41'),
(17, 19, 1, '2017-01-22 13:18:41'),
(18, 19, 1, '2017-01-22 13:18:41'),
(19, 3, 1, '2017-01-22 13:18:41'),
(20, 3, 1, '2017-01-22 13:18:41'),
(21, 3, 1, '2017-01-22 13:18:41'),
(22, 4, 1, '2017-01-22 13:18:41'),
(23, 4, 1, '2017-01-22 13:18:41'),
(24, 4, 2, '2017-01-22 13:18:41'),
(25, 10, 0, '2017-01-22 13:18:41'),
(26, 10, 0, '2017-01-22 13:18:42'),
(27, 10, 0, '2017-01-22 13:18:42'),
(28, 5, 2, '2017-01-22 13:18:42'),
(29, 5, 2, '2017-01-22 13:18:42'),
(30, 5, 2, '2017-01-22 13:18:42'),
(31, 7, 2, '2017-01-22 13:18:42'),
(32, 7, 2, '2017-01-22 13:18:42'),
(33, 7, 4, '2017-01-22 13:18:42'),
(34, 8, 26, '2017-01-22 13:18:42'),
(35, 8, 26, '2017-01-22 13:18:42'),
(36, 8, 26, '2017-01-22 13:18:42'),
(37, 9, 3, '2017-01-22 13:18:42'),
(38, 9, 3, '2017-01-22 13:18:42'),
(39, 9, 3, '2017-01-22 13:18:42'),
(40, 11, 2, '2017-01-22 13:18:42'),
(41, 11, 2, '2017-01-22 13:18:43'),
(42, 11, 2, '2017-01-22 13:18:43'),
(43, 12, 3, '2017-01-22 13:18:43'),
(44, 12, 3, '2017-01-22 13:18:43'),
(45, 12, 3, '2017-01-22 13:18:43'),
(46, 14, 189, '2017-01-22 13:18:43'),
(47, 14, 189, '2017-01-22 13:18:43'),
(48, 14, 189, '2017-01-22 13:18:43'),
(49, 16, 18, '2017-01-22 13:18:43'),
(50, 16, 18, '2017-01-22 13:18:43'),
(51, 16, 20, '2017-01-22 13:18:43'),
(52, 17, 3, '2017-01-22 13:18:43'),
(53, 17, 3, '2017-01-22 13:18:43'),
(54, 17, 3, '2017-01-22 13:18:43'),
(55, 18, 22, '2017-01-22 13:18:43'),
(56, 18, 22, '2017-01-22 13:18:43'),
(57, 18, 23, '2017-01-22 13:18:43'),
(58, 20, 6, '2017-01-22 13:18:43'),
(59, 20, 6, '2017-01-22 13:18:44'),
(60, 20, 8, '2017-01-22 13:18:44'),
(61, 27, 0, '2017-01-22 13:18:44'),
(62, 27, 0, '2017-01-22 13:18:44'),
(63, 27, 0, '2017-01-22 13:18:44');

-- --------------------------------------------------------

--
-- Structure de la table `suivi_validation`
--

CREATE TABLE IF NOT EXISTS `suivi_validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demandeAchat` int(11) NOT NULL,
  `signataire` int(11) NOT NULL,
  `date_envoi` date NOT NULL,
  `derniere_modif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estSigne` varchar(3) NOT NULL,
  `type` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demandeAchat` (`demandeAchat`,`signataire`),
  KEY `signataire` (`signataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

--
-- Contenu de la table `suivi_validation`
--

INSERT INTO `suivi_validation` (`id`, `demandeAchat`, `signataire`, `date_envoi`, `derniere_modif`, `estSigne`, `type`) VALUES
(205, 112, 12, '2016-12-29', '2016-12-29 23:09:50', 'OUI', 'OK'),
(206, 112, 11, '2016-12-29', '2016-12-29 23:10:23', 'OUI', 'OK'),
(207, 112, 10, '2016-12-29', '2016-12-29 23:10:56', 'OUI', 'OK'),
(208, 112, 9, '2016-12-29', '2016-12-29 23:11:31', 'OUI', 'OK'),
(209, 113, 13, '2016-12-29', '2016-12-29 23:32:18', 'OUI', 'OK'),
(210, 113, 6, '2016-12-29', '2016-12-29 23:33:02', 'OUI', 'OK'),
(211, 113, 10, '2016-12-29', '2016-12-29 23:33:27', 'OUI', 'OK'),
(212, 113, 9, '2016-12-29', '2016-12-29 23:34:05', 'OUI', 'OK'),
(213, 114, 5, '2016-12-30', '2016-12-30 07:59:59', 'OUI', 'OK'),
(214, 114, 14, '2016-12-30', '2016-12-30 08:03:10', 'OUI', 'OK'),
(215, 114, 10, '2016-12-30', '2016-12-30 08:04:05', 'OUI', 'OK'),
(216, 114, 9, '2016-12-30', '2017-01-05 08:16:15', 'OUI', 'OK'),
(217, 115, 5, '2016-12-30', '2016-12-30 09:47:57', 'OUI', 'OK'),
(218, 115, 14, '2016-12-30', '2016-12-30 09:48:30', 'OUI', 'OK'),
(219, 115, 10, '2016-12-30', '2016-12-30 09:48:52', 'OUI', 'OK'),
(220, 115, 9, '2016-12-30', '2016-12-30 09:50:01', 'OUI', 'OK'),
(221, 116, 5, '2016-12-30', '2016-12-30 09:53:48', 'OUI', 'OK'),
(222, 116, 14, '2016-12-30', '2016-12-30 09:54:18', 'OUI', 'OK'),
(223, 116, 10, '2016-12-30', '2016-12-30 09:54:46', 'OUI', 'OK'),
(224, 116, 9, '2016-12-30', '2017-01-05 10:43:58', 'OUI', 'OK'),
(225, 117, 12, '2017-01-04', '2017-01-04 09:03:37', 'OUI', 'OK'),
(226, 117, 11, '2017-01-04', '2017-01-04 09:04:12', 'OUI', 'OK'),
(227, 117, 10, '2017-01-04', '2017-01-05 09:50:21', 'NON', 'EC'),
(228, 118, 6, '2017-01-05', '2017-01-05 11:52:22', 'OUI', 'OK'),
(229, 118, 10, '2017-01-05', '2017-01-05 11:53:04', 'OUI', 'OK'),
(230, 118, 9, '2017-01-05', '2017-01-05 11:54:33', 'OUI', 'OK'),
(231, 119, 13, '2017-01-06', '2017-01-06 10:32:20', 'OUI', 'OK'),
(232, 119, 6, '2017-01-06', '2017-01-06 10:33:04', 'OUI', 'OK'),
(233, 119, 10, '2017-01-06', '2017-01-06 10:33:42', 'OUI', 'OK'),
(234, 119, 9, '2017-01-06', '2017-01-06 10:34:13', 'OUI', 'OK'),
(235, 120, 10, '2017-01-22', '2017-01-22 13:26:20', 'OUI', 'OK'),
(236, 120, 9, '2017-01-22', '2017-01-22 13:26:56', 'OUI', 'OK'),
(237, 121, 10, '2017-01-22', '2017-01-22 13:32:44', 'OUI', 'OK'),
(238, 121, 9, '2017-01-22', '2017-01-22 13:33:13', 'OUI', 'OK'),
(239, 122, 9, '2017-01-22', '2017-01-22 13:57:52', 'OUI', 'OK'),
(240, 123, 9, '2017-01-22', '2017-01-22 13:59:18', 'OUI', 'OK'),
(241, 124, 9, '2017-01-22', '2017-01-22 14:01:35', 'OUI', 'OK');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`famille`) REFERENCES `famille` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articlesdemandeachat`
--
ALTER TABLE `articlesdemandeachat`
  ADD CONSTRAINT `articlesdemandeachat_ibfk_1` FOREIGN KEY (`article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articlesdemandeachat_ibfk_2` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes_personnel`
--
ALTER TABLE `comptes_personnel`
  ADD CONSTRAINT `comptes_personnel_ibfk_1` FOREIGN KEY (`personnel`) REFERENCES `personnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cotation`
--
ALTER TABLE `cotation`
  ADD CONSTRAINT `cotation_ibfk_1` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotation_ibfk_2` FOREIGN KEY (`expediteur`) REFERENCES `personnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandeachat`
--
ALTER TABLE `demandeachat`
  ADD CONSTRAINT `demandeachat_ibfk_1` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demandeachat_ibfk_3` FOREIGN KEY (`demandeur`) REFERENCES `personnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandesatisfaite`
--
ALTER TABLE `demandesatisfaite`
  ADD CONSTRAINT `demandesatisfaite_ibfk_1` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entree_produit`
--
ALTER TABLE `entree_produit`
  ADD CONSTRAINT `entree_produit_ibfk_4` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entree_produit_ibfk_1` FOREIGN KEY (`article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entree_produit_ibfk_2` FOREIGN KEY (`magasin`) REFERENCES `magasin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entree_produit_ibfk_3` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fournisseursurcotation`
--
ALTER TABLE `fournisseursurcotation`
  ADD CONSTRAINT `fournisseursurcotation_ibfk_1` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fournisseursurcotation_ibfk_2` FOREIGN KEY (`cotation`) REFERENCES `cotation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signataire_approber`
--
ALTER TABLE `signataire_approber`
  ADD CONSTRAINT `signataire_approber_ibfk_1` FOREIGN KEY (`signataire`) REFERENCES `personnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signataire_approber_ibfk_2` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`articles`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stocks_magasin`
--
ALTER TABLE `stocks_magasin`
  ADD CONSTRAINT `stocks_magasin_ibfk_1` FOREIGN KEY (`produit`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivi_validation`
--
ALTER TABLE `suivi_validation`
  ADD CONSTRAINT `suivi_validation_ibfk_1` FOREIGN KEY (`demandeAchat`) REFERENCES `demandeachat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivi_validation_ibfk_2` FOREIGN KEY (`signataire`) REFERENCES `personnel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
