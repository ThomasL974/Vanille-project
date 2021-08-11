-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 24 Novembre 2019 à 13:43
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `vanille`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `ADM_1` int(2) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`ADM_1`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`ADM_1`, `login`, `mdp`) VALUES
(1, 'admin1', 'A1'),
(2, 'admin2', 'B2');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `CAT_id` char(3) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CAT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`CAT_id`, `libelle`) VALUES
('bon', 'Bonbons'),
('car', 'Caramels'),
('cho', 'Chocolats');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `CDE_id` int(3) NOT NULL,
  `datecommande` date DEFAULT NULL,
  `nomPrenomClient` varchar(50) DEFAULT NULL,
  `adresseRueClient` varchar(50) DEFAULT NULL,
  `cpClient` char(5) DEFAULT NULL,
  `villeClient` varchar(40) DEFAULT NULL,
  `mailClient` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CDE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`CDE_id`, `datecommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
(1, '2019-11-24', 'Thomas LAMOLY', '4 Rue valentina terechkova', '31400', 'TOULOUSE', 'thomas.lamoly29@gmail.com'),
(2, '2019-11-24', 'Thomas LAMOLY', '4 Rue valentina terechkova', '31400', 'TOULOUSE', 'thomas.lamoly29@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `idcommande` int(3) NOT NULL,
  `idProduit` char(5) NOT NULL,
  PRIMARY KEY (`idcommande`,`idProduit`),
  KEY `I_FK_CONTENIR_Commande` (`idcommande`),
  KEY `I_FK_CONTENIR_Produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`idcommande`, `idProduit`) VALUES
(1, 'CA06'),
(2, 'CA04'),
(2, 'CA05'),
(2, 'CA06');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `PDT_id` char(5) NOT NULL,
  `descrip` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `idCategorie` char(3) NOT NULL,
  `Qte` int(2) NOT NULL,
  PRIMARY KEY (`PDT_id`),
  KEY `FK_Produit_CATEGORIE` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`PDT_id`, `descrip`, `prix`, `image`, `idCategorie`, `Qte`) VALUES
('BO07', 'Nounours colorés Lot 2Kg', '50.00', 'images/bonbons/bonbon7.png', 'bon', 3),
('BO08', '4 kg de bonbon', '40.00', 'images/bonbons/bonbon8.png', 'bon', 10),
('CA04', 'Caramels parfumés Lot 2Kg', '30.00', 'images/caramels/caramel4.png', 'car', 10),
('CA05', 'Caramels croquants Lot 1Kg', '18.00', 'images/caramels/caramel5.png', 'car', -1),
('CA06', '4 kilos de caramels ', '40.00', 'images/caramels/caramel7.png', 'car', 8),
('CH02', 'Oeufs en chocolat Lot 2Kg', '26.00', 'images/chocolats/choco2.png', 'cho', 0),
('CH03', 'Fagots au chocolat lot 1Kg', '17.00', 'images/chocolats/choco3.png', 'cho', 0),
('CH04', 'Chocolats amande Lot 2Kg', '45.00', 'images/chocolats/choco4.png', 'cho', 0),
('CH05', 'chocho', '40.00', 'images/chocolats/choco5.png', 'cho', 10);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_fk_1` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`CDE_id`),
  ADD CONSTRAINT `contenir_fk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`PDT_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`CAT_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
