-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 01 nov. 2025 à 17:07
-- Version du serveur : 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `QR_Code`
--

-- --------------------------------------------------------

--
-- Structure de la table `illustration`
--

CREATE TABLE `illustration` (
  `id` bigint(20) NOT NULL,
  `logo_url` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `hauteur_image` bigint(20) NOT NULL,
  `largeur_image` bigint(20) NOT NULL,
  `position_QR` bigint(20) NOT NULL,
  `position_texte` bigint(20) NOT NULL,
  `hauteur_qr` bigint(20) NOT NULL,
  `largeur_qr` bigint(20) NOT NULL,
  `id_qr` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `couleur_police` varchar(100) NOT NULL,
  `taille_police` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `illustration`
--

INSERT INTO `illustration` (`id`, `logo_url`, `image_url`, `titre`, `hauteur_image`, `largeur_image`, `position_QR`, `position_texte`, `hauteur_qr`, `largeur_qr`, `id_qr`, `id_user`, `couleur_police`, `taille_police`) VALUES
(3, 'ig2i.png', 'drop-table.jpeg', 'Ne pas faire de drop table sans en être sûr !', 500, 800, 4, 3, 100, 100, 3, 2, '#ff0000', 20),
(4, 'Aucun_logo.png', 'rose.jpeg', 'Entités-association', 800, 600, 3, 2, 120, 120, 4, 2, '#ff00f7', 18),
(5, 'ig2i.png', 'manual.jpeg', 'Read the F****ng manual', 450, 500, 4, 3, 111, 111, 5, 4, '#000000', 18),
(6, 'ig2i.png', 'linux.jpeg', 'Build Done', 500, 500, 2, 3, 100, 100, 6, 4, '#000000', 15);

-- --------------------------------------------------------

--
-- Structure de la table `QR`
--

CREATE TABLE `QR` (
  `id` bigint(20) NOT NULL,
  `data` varchar(100) NOT NULL,
  `version` bigint(20) NOT NULL,
  `errorCorrectLevel` varchar(100) NOT NULL,
  `maskPattern` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `QR`
--

INSERT INTO `QR` (`id`, `data`, `version`, `errorCorrectLevel`, `maskPattern`) VALUES
(3, 'obtenu en mettant un drop table sans condition', 1, '2', '0'),
(4, 'Modèle Entités-association est différent de modèle relationnel', 1, '2', '0'),
(5, 'L&#039;élève a trouvé la bonne option dans une commande à l’occasion du cours d’ISEL', 1, '2', '0'),
(6, 'Recompiler un noyau linux et faire fonctionner le framebuffer ', 1, '2', '0');

-- --------------------------------------------------------

--
-- Structure de la table `QR_obtenu`
--

CREATE TABLE `QR_obtenu` (
  `id_user` bigint(20) NOT NULL,
  `date_obtention` date NOT NULL,
  `id_image` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `QR_obtenu`
--

INSERT INTO `QR_obtenu` (`id_user`, `date_obtention`, `id_image`) VALUES
(3, '2025-10-29', 3),
(5, '2025-10-31', 3),
(6, '2025-10-31', 4),
(5, '2025-10-31', 4),
(3, '2025-10-31', 4),
(1, '2025-10-31', 4),
(6, '2025-10-31', 3),
(1, '2025-11-01', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `promo` varchar(100) NOT NULL,
  `admin` bigint(20) NOT NULL DEFAULT 0,
  `mdp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `promo`, `admin`, `mdp`) VALUES
(1, 'Quettier', 'Alexandra', 'LE2', 0, 'Vanitatum5'),
(2, 'Folschette', 'Maxime', 'Enseignant', 1, 'sia'),
(3, 'Dehiles', 'Lara', 'LE2', 0, 'Couix'),
(4, 'Bourdeaudhuy', 'Thomas', 'Enseignant', 1, 'web'),
(5, 'Laloux', 'Elisabeth', 'LE1', 0, 'Zbab'),
(6, 'Degezelle', 'Eulalie', 'LE2', 0, 'Poulpe'),
(7, 'Feugère', 'Chloé', 'LE2', 0, 'Piscine');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `illustration`
--
ALTER TABLE `illustration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_qr` (`id_qr`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `QR`
--
ALTER TABLE `QR`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `illustration`
--
ALTER TABLE `illustration`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `QR`
--
ALTER TABLE `QR`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `illustration`
--
ALTER TABLE `illustration`
  ADD CONSTRAINT `illustration_ibfk_1` FOREIGN KEY (`id_qr`) REFERENCES `QR` (`id`),
  ADD CONSTRAINT `illustration_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
