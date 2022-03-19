-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 19 mars 2022 à 08:33
-- Version du serveur : 8.0.27
-- Version de PHP : 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `idA` int NOT NULL AUTO_INCREMENT,
  `auteur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`idA`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`idA`, `auteur`) VALUES
(18, 'Jean-Yves Ferri'),
(19, 'Scotch Arleston');

-- --------------------------------------------------------

--
-- Structure de la table `biblio`
--

DROP TABLE IF EXISTS `biblio`;
CREATE TABLE IF NOT EXISTS `biblio` (
  `idLivre` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `isbn` varchar(200) NOT NULL,
  `numero` int DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `edition` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `annee` year DEFAULT NULL,
  `serie` varchar(100) NOT NULL,
  PRIMARY KEY (`idLivre`),
  KEY `serie` (`serie`),
  KEY `edition` (`edition`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `biblio`
--

INSERT INTO `biblio` (`idLivre`, `isbn`, `numero`, `titre`, `auteur`, `edition`, `annee`, `serie`) VALUES
(15, '2205000969', 1, 'Astérix le Gaulois', 'Goscinny', 'Dargaud', 1961, 'Asterix et Obelix'),
(16, '9782205008968', 22, 'La grande traversée', 'Goscinny', 'Dargaud', 1975, 'Asterix et Obelix'),
(18, '2012100023', 2, 'La serpe d\'or', 'Goscinny', 'Dargaud', 1984, 'Asterix et Obelix'),
(19, '2205001213', 3, 'Asterix chez les Goths', 'Goscinny', 'Dargaud', 1963, 'Asterix et Obelix'),
(21, '9782864973270', 37, 'Astérix et la transitalique', 'Jean-Yves Ferri', 'Albert René', 2017, 'Asterix et Obelix'),
(22, '9782864972662', 35, 'Asterix chez les Pictes', 'Jean-Yves Ferri', 'Albert René', 2013, 'Asterix et Obelix'),
(23, '9782864970200', 28, 'Asterix chez Rahazade', 'Goscinny', 'Albert René', 1987, 'Asterix et Obelix'),
(25, '9782877649025', 1, 'Le bracelet de Cohars', 'Scotch Arleston', 'Soleil', 2000, 'Les Forets d\'Opale'),
(27, '9782302048577', 9, 'Un flot de lumière', 'Scotch Arleston', 'Soleil', 2015, 'Les Forets d\'Opale'),
(56, '2800125950', 2, 'On mange qui, ce soir?', 'Fournier', 'Dupuis', 1999, 'Les Crannibales');

-- --------------------------------------------------------

--
-- Structure de la table `edition`
--

DROP TABLE IF EXISTS `edition`;
CREATE TABLE IF NOT EXISTS `edition` (
  `idEdition` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `edition` varchar(100) NOT NULL,
  PRIMARY KEY (`idEdition`),
  KEY `edition` (`edition`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `edition`
--

INSERT INTO `edition` (`idEdition`, `edition`) VALUES
(8, 'Albert René'),
(6, 'Casterman'),
(5, 'Dargaud'),
(13, 'Dupuis'),
(9, 'poket'),
(7, 'Soleil');

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `idSerie` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `serie` varchar(100) NOT NULL,
  PRIMARY KEY (`idSerie`),
  KEY `idSerie` (`idSerie`),
  KEY `serie` (`serie`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`idSerie`, `serie`) VALUES
(5, 'Asterix et Obelix'),
(11, 'Dune'),
(7, 'Le petit spirou'),
(13, 'Les Crannibales'),
(10, 'Les Forets d\'Opale');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD CONSTRAINT `auteur_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `biblio` (`auteur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `biblio`
--
ALTER TABLE `biblio`
  ADD CONSTRAINT `biblio_ibfk_1` FOREIGN KEY (`serie`) REFERENCES `serie` (`serie`),
  ADD CONSTRAINT `biblio_ibfk_2` FOREIGN KEY (`edition`) REFERENCES `edition` (`edition`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
