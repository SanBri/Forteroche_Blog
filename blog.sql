-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : lun. 20 juil. 2020 à 14:34
-- Version du serveur :  8.0.18
-- Version de PHP : 7.4.0

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `chapter` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `chapter`, `title`, `content`, `creation_date`, `img`) VALUES
(2, 1, 'Mon titre 2', '<p>Ceci est le contenu de mon 2&egrave;me article !</p>', '0000-00-00 00:00:00', '1594927626the-rock.jpeg'),
(3, 2, 'Le 3ème !', '<p>Ceci est le troisi&egrave;me article !</p>', '0000-00-00 00:00:00', ''),
(6, 3, 'New Post', 'Cet article a été rédigé directement depuis l\'interface d\'administration du blog !\r\nFélicitations !', '2020-05-31 21:44:04', ''),
(24, 4, 'Article 5', 'C\'est l\'article 5 !', '2020-06-08 20:19:44', ''),
(26, 5, '7', '<p>Nana Seven Siete Sette Sept</p>', '2020-06-08 21:03:36', '1594798944raw.png'),
(38, 6, 'TinyMCE', '<p>Cet article a &eacute;t&eacute; cr&eacute;&eacute; et &eacute;dit&eacute; directement depuis&nbsp;<strong>TinyMCE</strong>.</p>', '2020-07-08 18:46:08', '1594226768ty-ly-chargement.jpg'),
(42, 7, 'test edit img', '<p>Je teste l\'&eacute;dition de l\'image blabla</p>', '2020-07-08 22:40:53', '1594289611parche-logo-stark-xogo-de-tronos.jpg'),
(46, 8, 'TEST', '<p>TEST 2</p>', '2020-07-09 14:24:15', '1594798668e05d4cedd80fdebc83051444e25801c1.jpg'),
(61, 9, 'NOUVEAU CHAPITRE', '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"mso-ansi-language: EN-GB;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. </span>Alias mollitia quae beatae ex minus, quod eos quaerat magnam nam voluptatibus itaque laboriosam a sunt iure at optio? Voluptas, animi nostrum!</p>\r\n<p class=\"MsoNormal\">Eligendi fuga doloremque laudantium iste ratione mollitia eos voluptatibus, libero illum quaerat et aspernatur quam explicabo maxime nisi ipsum maiores, necessitatibus est, totam deleniti ut delectus? Expedita doloribus error molestiae. A, minus optio nihil amet, itaque aliquam explicabo id eius molestias in, voluptatibus dolorum nulla quos enim illo porro quo placeat odio dolores. Numquam facilis possimus amet tempore. Modi, fuga. Dolorem mollitia dolore, voluptates, et facilis consequuntur reprehenderit fuga officia ratione ipsam provident aliquid saepe, dicta laborum ad corrupti animi! Sed quasi ducimus ipsum vel asperiores quam tenetur, in totam!</p>\r\n<p class=\"MsoNormal\">Eius, voluptate sint? Quia ad voluptatum dolores, soluta aliquid ipsam rem asperiores, unde voluptatibus, tempore nobis magnam perferendis molestias quod. Doloribus molestiae, ipsa quod assumenda accusantium fuga repudiandae aliquam impedit. Quis ipsam dolorem deserunt optio fugiat a? Reiciendis, ullam quibusdam. Quae quis, aspernatur dolorum minus odit vitae eius, nesciunt ratione perferendis exercitationem, velit nobis officia accusamus. Natus quo cumque facere? Facilis mollitia beatae officiis dicta quis doloribus voluptatem saepe incidunt alias commodi qui non sapiente quasi, eius dolore ipsa voluptate quos. Hic minima iste, doloribus quod optio sed labore omnis! Vitae, tempora possimus omnis cumque quis commodi temporibus tenetur non. Enim quod unde quae sapiente dignissimos delectus quis maiores dolorum distinctio omnis repudiandae, fuga exercitationem error eos at, beatae iure. Cumque eaque incidunt voluptatum, excepturi sequi veniam molestiae officia consectetur! Animi eveniet dolores sunt aspernatur laudantium soluta minus quaerat maiores. Inventore corrupti placeat tempore est qui doloremque voluptas alias numquam!</p>\r\n<p class=\"MsoNormal\">Facilis iusto itaque saepe eius, odit, voluptatibus alias blanditiis voluptates hic quasi totam ex! Sunt rerum vel consequuntur labore minus vitae quam ipsum porro, aspernatur, atque corporis cupiditate ad nisi! Nostrum at suscipit facere hic, perspiciatis velit molestias repudiandae voluptas minima dolorum qui. Tempore cum dolore, inventore facere unde officiis necessitatibus ab sapiente corporis, at pariatur iure commodi quae doloremque.</p>', '2020-07-16 16:51:39', '15951105321594932695spider-man.png'),
(72, 10, 'd', '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"mso-ansi-language: EN-GB;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span>Quisque vitae facilisis ante. Duis vitae ultricies erat. Morbi ultrices massa quis mauris iaculis consequat. Aliquam non nibh finibus, semper ligula at, aliquam lectus. Nam interdum, massa a imperdiet vulputate, mauris purus ullamcorper eros, sed faucibus massa sapien vel quam. Suspendisse porta diam id est ullamcorper volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer risus elit, mollis sit amet rutrum eu, aliquam nec odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus nisi ex, commodo et magna non, ullamcorper dictum dui.</p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"mso-ansi-language: EN-GB;\">Maecenas pulvinar semper mauris, id varius risus consequat nec. Nulla vitae vehicula enim, at ultricies tortor. </span>Nulla facilisi. Nullam ligula ipsum, eleifend vitae sapien nec, iaculis cursus est. Phasellus blandit justo at erat pharetra, et porttitor mauris interdum. <span lang=\"EN-GB\" style=\"mso-ansi-language: EN-GB;\">Nullam sed libero feugiat erat condimentum efficitur nec at nulla. Sed placerat ornare porttitor.</span></p>\r\n<p class=\"MsoNormal\">Vestibulum leo neque, facilisis a orci vel, facilisis congue nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent scelerisque id ligula et pulvinar. Donec consectetur turpis nisi, quis pretium eros molestie eu. Sed non auctor neque, et ullamcorper ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer egestas, urna eu malesuada tristique, mi eros finibus ligula, ut sodales metus sapien in dui. Proin auctor leo hendrerit turpis porta, a vestibulum sem efficitur. In luctus ultricies mollis. Pellentesque non sem id mauris rhoncus dignissim. Morbi facilisis scelerisque nisl eu elementum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras sit amet tincidunt erat, vel consequat diam.</p>\r\n<p class=\"MsoNormal\">Aenean lectus sapien, convallis ac sapien sed, euismod sollicitudin tellus. Proin vel pharetra felis. Ut nec dui aliquam, eleifend metus at, maximus mauris. Quisque convallis at sapien a molestie. Donec quis consequat sapien. Curabitur in diam vitae neque sodales lobortis ac et magna. Pellentesque posuere, nunc a condimentum suscipit, diam tortor ultrices enim, a lobortis nunc ex ac ex. Nam posuere eget nisl sed semper.</p>\r\n<p class=\"MsoNormal\">Nunc eu feugiat mi. Phasellus eros purus, laoreet ut condimentum nec, vulputate id dolor. Vivamus vel eros nec lectus volutpat volutpat at id diam. Cras tempus nibh nulla, sit amet porta neque rhoncus vel. Nullam justo dui, interdum at auctor scelerisque, aliquam sed quam. Cras id elementum mauris. Nunc tellus augue, egestas eu ultricies ultricies, tempus vitae nulla.</p>', '2020-07-16 23:07:38', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_posts`, `author`, `comment`, `creation_date`, `reported`) VALUES
(5, 2, 'SanB', 'Je suis le commentaire du 2ème article', '2020-05-23 17:27:30', 0),
(28, 6, 'Test Heure', 'Ce commentaire a été posté à 23:54', '2020-05-31 23:54:59', 0),
(27, 3, 'SanB', 'Je suis le troisième du troisième', '2020-05-28 21:59:48', 0),
(26, 3, 'Sandro', 'EST-CE QUE TOUT MARCHE CORRECTEMENT ?', '2020-05-28 13:15:15', 0),
(25, 3, 'SanB', 'First comment on the third post ', '2020-05-28 13:14:28', 0),
(44, 26, 'FanDuSept', 'C\'est mon chiffre préféré !', '2020-06-16 10:50:18', 0),
(23, 2, 'SanB', 'Est-ce que ça marche toujours ?', '2020-05-27 07:52:55', 0),
(43, 6, 'Gentil', 'Gentil commentaire', '2020-06-08 15:06:44', 0),
(50, 3, 'SanB', 'Ce commentaire est posté sur \"Mon Titre 2\"', '2020-07-15 00:33:18', 0),
(51, 42, 'Ned Stark', 'Winter is coming', '2020-07-15 01:31:18', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
