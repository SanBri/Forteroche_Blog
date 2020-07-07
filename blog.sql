-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 02 juil. 2020 à 12:01
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id`, `pseudo`, `pass`) VALUES
(1, 'SanB', '$2y$10$1tUzseTk7g0UTrOrtDF8YeBEhLHzLmed/JCUMtG7V0JVhrnvETFSO'),
(2, 'Forteroche', '$2y$10$IDMVZGm23CF6rYaXaFnB4e.xyRljZvMuwPp8Xr6aX81DQwbNS5odO');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `creation_date`) VALUES
(2, 'Mon titre 2', 'Ceci est le contenu de mon 2ème article !', '0000-00-00 00:00:00'),
(1, 'Mon titre 1', 'Ceci est le contenu de mon 1er article ! Bienvenue !', '0000-00-00 00:00:00'),
(3, 'Le 3ème !', 'Ceci est le troisième article !', '0000-00-00 00:00:00'),
(6, 'New Post', 'Cet article a été rédigé directement depuis l\'interface d\'administration du blog !\r\nFélicitations !', '2020-05-31 21:44:04'),
(24, 'Article 5', 'C\'est l\'article 5 !', '2020-06-08 20:19:44'),
(26, '7', '<p>Nana Seven Siete Sette Sept</p>', '2020-06-08 21:03:36'),
(29, 'TinyMCE', '<p style=\"color: #000000; font-family: \'Times New Roman\'; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">Ce post a &eacute;t&eacute; cr&eacute;&eacute; et &eacute;dit&eacute; depuis le <em>WYSIWYG&nbsp;</em>\"<strong>TinyMCE</strong>\"</p>', '2020-06-12 21:56:50');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posts` int(11) NOT NULL,
  `author` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `reported` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_posts`, `author`, `comment`, `creation_date`, `reported`) VALUES
(1, 1, 'Mark', 'Je suis le premier commentaire du 1er article !', '2020-05-13 17:15:25', 0),
(5, 2, 'SanB', 'Je suis le commentaire du 2ème article', '2020-05-23 17:27:30', 0),
(2, 1, 'SanB', 'Je suis le premier commentaire rédigé directement depuis le blog !', '2020-05-22 21:44:16', 0),
(6, 1, 'SanB', 'Je (re)teste la redirection !', '2020-05-25 12:54:03', 0),
(7, 1, 'SanB', 'Permettez-moi de tester les <strong>balises HTML</strong>', '2020-05-25 12:55:15', 0),
(45, 29, 'Hater', 'Je suis un méchant commentaire !', '2020-06-25 15:17:42', 0),
(28, 6, 'Test Heure', 'Ce commentaire a été posté à 23:54', '2020-05-31 23:54:59', 0),
(27, 3, 'SanB', 'Je suis le troisième du troisième', '2020-05-28 21:59:48', 0),
(26, 3, 'Sandro', 'EST-CE QUE TOUT MARCHE CORRECTEMENT ?', '2020-05-28 13:15:15', 0),
(25, 3, 'SanB', 'First comment on the third post ', '2020-05-28 13:14:28', 0),
(44, 26, 'FanDuSept', 'C\'est mon chiffre préféré !', '2020-06-16 10:50:18', 0),
(23, 2, 'SanB', 'Est-ce que ça marche toujours ?', '2020-05-27 07:52:55', 0),
(43, 6, 'Gentil', 'Gentil commentaire', '2020-06-08 15:06:44', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
