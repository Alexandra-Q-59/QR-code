-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 19 oct. 2025 à 19:18
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
  `titre` varchar(100) NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `QR_obtenu`
--

CREATE TABLE `QR_obtenu` (
  `id_user` bigint(20) NOT NULL,
  `date_obtention` date NOT NULL,
  `id_image` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `promo` varchar(100) NOT NULL,
  `admin` bigint(20) NOT NULL,
  `mdp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Index pour la table `QR_obtenu`
--
ALTER TABLE `QR_obtenu`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_image` (`id_image`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `illustration`
--
ALTER TABLE `illustration`
  ADD CONSTRAINT `illustration_ibfk_1` FOREIGN KEY (`id_qr`) REFERENCES `QR` (`id`),
  ADD CONSTRAINT `illustration_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `QR_obtenu`
--
ALTER TABLE `QR_obtenu`
  ADD CONSTRAINT `QR_obtenu_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `QR_obtenu_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `illustration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
