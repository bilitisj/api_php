-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 05 juil. 2022 à 14:25
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ingrwf10_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'test', 'test@ss.com', 'test message'),
(2, 'Jambon Bilitis', 'jambon_bilitis@hotmail.com', 'test 4'),
(3, 'Jambon Bilitis', 'jambon_bilitis@hotmail.com', 'test 4'),
(4, 'Jambon Bilitis', 'jambon_bilitis@hotmail.com', 'test 4'),
(5, 'Jambon Bilitis', 'jambon_bilitis@hotmail.com', 'test 6');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(200) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `contenu`) VALUES
(2, 'News du mois', 'ipsum ipsum tatata'),
(3, 'News de l\'année', 'ipsum ipsum blablabla'),
(5, 'titre news', 'contenu news'),
(6, 'titre changé pour l\'id 6', 'contenu changé pour l\'id 6!!!!!!!'),
(7, 'titre changé', ' il s\'agit d\'un contenu changé !!!!!!!');

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE `personnes` (
  `id_personnes` int(10) UNSIGNED NOT NULL,
  `nom` varchar(120) DEFAULT NULL,
  `prenom` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnes`
--

INSERT INTO `personnes` (`id_personnes`, `nom`, `prenom`) VALUES
(2, 'Proust2', 'Marcel2'),
(6, 'charlier', 'benoit'),
(19, 'devos', 'françoise'),
(21, 'brol', 'machin'),
(22, 'Proust', 'Marcel'),
(23, 'Proust2', 'Marcel2'),
(24, 'Proust2', 'Marcel2'),
(25, 'Proust2', 'Marcel2'),
(26, 'Proust2', 'Marcel2'),
(27, 'NULL', 'Bastien'),
(28, 'Henry', 'Philippe'),
(29, 'Jambon', 'Bili'),
(30, '', ''),
(31, 'Dupont', 'Julie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_users` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `login`, `password`) VALUES
(1, 'pierre', 'pass');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`id_personnes`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `id_personnes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
