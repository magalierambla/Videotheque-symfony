-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 mars 2021 à 07:56
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `videotheque_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `label`) VALUES
(1, 'Horreur'),
(2, 'SF'),
(3, 'Documentaire'),
(4, 'Thriller'),
(5, 'Comedie');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resume` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id`, `title`, `resume`, `picture`, `last_update_date`) VALUES
(11, 'Bram Stocker\'s Dracula', 'En 1492, le prince Vlad Dracul, revenant de combattre les armées turques, trouve sa fiancée suicidée. Fou de douleur, il défie Dieu, et devient le comte Dracula, vampire de son état. Quatre cents ans plus tard, désireux de quitter la Transylvanie po', '604b0cad5f45d.jpeg', NULL),
(12, 'Alien', 'D\'anciens militaires, blessés au combat, mettent au point un casque neurobiologique permettant de contrôler les avions de chasse par la pensée. Mais des explosions se produisent pendant leurs tests et des Aliens paralysent le système nerveux des pilot', '604b0d0242873.jpeg', NULL),
(13, 'Les Charlots contre Dracula', 'Qui veut posséder les pouvoirs de Dracula doit s\'emparer de la fiole qui renferme l\'élixir magique. Mais tous les \"candidats\" courent le risque d\'être pétrifiés. La femme de Dracula a jeté ce mauvais sort avant de mourir. Une femme, sosie de Madame ', '604b0d3d17b6e.jpeg', NULL),
(14, 'Dracula vit toujours à Londres', 'Dracula est devenu le leader de messes noires auxquelles adhèrent de riches capitalistes. Aidés de milices, il s\'apprêtent à renverser le pouvoir en Angleterre, en répandant la peste noire. Lorrimer Van Helsing, le descendant d\'Abraham Van Helsing, v', '604b0d70c546f.jpeg', NULL),
(15, 'Frankenstein', 'Le scientifique aux méthodes radicales Victor Frankenstein et son tout aussi brillant protégé Igor Strausman partagent une vision noble : celle d\'aider l\'humanité à travers leurs recherches innovantes sur l\'immortalité. Mais les expériences de Vict', '604b0d9c1abc8.jpeg', NULL),
(16, 'Problemos', 'Jeanne et Victor sont deux jeunes parisiens de retour de vacances. En chemin, ils font une halte pour saluer leur ami Jean-Paul, sur la prairie où sa communauté a élu résidence. Le groupe lutte contre la construction d’un parc aquatique sur la derni', '604b0dc94db75.jpeg', NULL),
(17, 'Shaun of the dead', 'À presque 30 ans, Shaun ne fait pas grand-chose de sa vie. Entre l\'appart qu\'il partage avec ses potes et le temps qu\'il passe avec eux au pub, Liz, sa petite amie, n\'a pas beaucoup de place. Elle qui voudrait que Shaun s\'engage, ne supporte plus de le v', '604b0deeaccdf.jpeg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `film_category`
--

CREATE TABLE `film_category` (
  `film_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `film_category`
--

INSERT INTO `film_category` (`film_id`, `category_id`) VALUES
(11, 1),
(12, 1),
(12, 2),
(13, 1),
(13, 5),
(14, 1),
(15, 1),
(15, 4),
(16, 3),
(16, 5),
(17, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `roles`, `password`) VALUES
(6, 'quicotte@gmail.com', 'quicotte', '[\"ROLE_USER\"]', '$2y$13$83IoBxcxK7TsKFT3iF3QNeEW1760cMrQqa9Zm0kUml7gFUyViv/1u'),
(7, 'admin@gmail.com', 'admin', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$KTO.JMYg24BulMbxrqOA7eaeFg7euENKhm7ujCJIwM83xHHdo4Xu6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_category`
--
ALTER TABLE `film_category`
  ADD PRIMARY KEY (`film_id`,`category_id`),
  ADD KEY `IDX_A4CBD6A8567F5183` (`film_id`),
  ADD KEY `IDX_A4CBD6A812469DE2` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `film_category`
--
ALTER TABLE `film_category`
  ADD CONSTRAINT `FK_A4CBD6A812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A4CBD6A8567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
