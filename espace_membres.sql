-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 02 Juin 2017 à 07:48
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membres`
--

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE `connectes` (
  `connectes_id` int(11) NOT NULL,
  `connectes_ip` varchar(16) NOT NULL,
  `connectes_membre` varchar(16) NOT NULL,
  `connectes_actualisation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`connectes_id`, `connectes_ip`, `connectes_membre`, `connectes_actualisation`) VALUES
(-1, '::1', '::1', 1496382448);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `membre_id` int(11) NOT NULL,
  `membre_pseudo` varchar(32) NOT NULL,
  `membre_mdp` varchar(40) NOT NULL,
  `membre_mail` varchar(100) NOT NULL,
  `membre_inscription` bigint(20) NOT NULL,
  `membre_naissance` varchar(11) NOT NULL,
  `membre_msn` varchar(255) NOT NULL,
  `membre_yahoo` varchar(255) NOT NULL,
  `membre_aim` varchar(255) NOT NULL,
  `membre_localisation` varchar(255) NOT NULL,
  `membre_profession` varchar(255) NOT NULL,
  `membre_avatar` varchar(255) NOT NULL,
  `membre_biographie` text NOT NULL,
  `membre_signature` text NOT NULL,
  `membre_derniere_visite` bigint(20) NOT NULL,
  `membre_banni` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`membre_id`, `membre_pseudo`, `membre_mdp`, `membre_mail`, `membre_inscription`, `membre_naissance`, `membre_msn`, `membre_yahoo`, `membre_aim`, `membre_localisation`, `membre_profession`, `membre_avatar`, `membre_biographie`, `membre_signature`, `membre_derniere_visite`, `membre_banni`) VALUES
(1, 'Yves967', '8aadd07e14efcbd86f2d092366408466', 'ykaercher@gmail.com', 1495736049, '13/12/1961', '', '', '', '', '', '', '', '', 1496326933, 0),
(3, 'julien', '42ba22d358b344ad22745084079f097c', 'jkaercher@gmail.com', 1496007408, '09/02/1991', '', '', '', '', '', '', '', '', 1496007408, 0),
(5, 'patrick', '32c042157b2ea9a234c0daea875e58f4', 'p.tonussi@gmail.com', 1496049540, '05/04/1959', '', '', '', '', '', '', '', '', 1496049540, 0),
(7, 'pascal', '9c5f9b967f7521d025fdd4b78b6e043a', 'p.fleschhut@bbox.fr', 1496049778, '12/06/1962', '', '', '', '', '', '', '', '', 1496049778, 0),
(9, 'thierry', '3aff314713125175cabefd6d29f9393f', 'thierry.geist@gmail.com', 1496062926, '23/05/1955', '', '', '', '', '', '', '', '', 1496062926, 0),
(11, 'florent', 'e6b1a92c16262992262bbae76926022d', 'f.wernert@gmail.com', 1496064058, '23/05/1990', '', '', '', '', '', '', '', '', 1496064058, 0),
(13, 'stephane', 'f4942a86c3df719ccbb4fb91627b2f43', 'steph@gmail.com', 1496064342, '10/11/1994', '', '', '', '', '', '', '', '', 1496064342, 0),
(15, 'liliane', '0a16323729e82887b28e8a1cef277085', 'lkaercher@numericable.fr', 1496085039, '23/05/1961', '', '', '', '', '', '', '', '', 1496085039, 0),
(16, 'steve', 'f4942a86c3df719ccbb4fb91627b2f43', 'steve@gmail.com', 1496094374, '01/01/2000', '', '', '', '', '', '', '', '', 1496094374, 0),
(18, 'louis', 'ece8f68bf947e2816e7cc0da19ce80be', 'louis@yahoo.fr', 1496151167, '06/02/1992', '', '', '', '', '', '', '', '', 1496157323, 0),
(19, 'JEAN', '02e08ddf24fe2bfea931da16d7592a67', 'jean@yahoo.fr', 1496353819, '5/07/1999', '', '', '', '', '', '', '', '', 1496354245, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `connectes`
--
ALTER TABLE `connectes`
  ADD UNIQUE KEY `membre_id` (`connectes_id`,`connectes_membre`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`membre_id`),
  ADD UNIQUE KEY `membre_pseudo` (`membre_pseudo`),
  ADD UNIQUE KEY `membre_mail` (`membre_mail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
