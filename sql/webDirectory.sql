-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql_container
-- Généré le : mer. 12 juin 2024 à 15:25
-- Version du serveur : 8.0.37
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webDirectory`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int NOT NULL,
  `nom` varchar(128) NOT NULL,
  `etage` varchar(5) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `etage`, `description`) VALUES
(1, 'Ressources Humaines', '1', 'Département des ressources humaines'),
(2, 'Informatique', '2', 'Département informatique'),
(3, 'Marketing', '3', 'Département marketing'),
(4, 'Finance', '4', 'Département des finances'),
(5, 'Support Client', '5', 'Département de support client'),
(6, 'Ressources Humaines', '1', 'Département des ressources humaines'),
(7, 'Informatique', '2', 'Département informatique'),
(8, 'Marketing', '3', 'Département marketing'),
(9, 'Finance', '4', 'Département des finances'),
(10, 'Support Client', '5', 'Département de support client');

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `fonction` varchar(128) NOT NULL,
  `numeroBureau` int NOT NULL,
  `numeroTel1` varchar(10) NOT NULL,
  `numeroTel2` varchar(10) DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image` varchar(128) DEFAULT 'person.png',
  `statut` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `nom`, `prenom`, `fonction`, `numeroBureau`, `numeroTel1`, `numeroTel2`, `email`, `image`, `statut`, `created_at`, `updated_at`) VALUES
('da8ab5b6-28cd-11ef-af7c-0242ac120002', 'Doe', 'John', 'Développeur', 101, '0123456789', NULL, 'j.doe@example.com', 'john.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab884-28cd-11ef-af7c-0242ac120002', 'Smith', 'Anna', 'RH Manager', 102, '0123456790', NULL, 'a.smith@example.com', 'anna.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab93c-28cd-11ef-af7c-0242ac120002', 'Brown', 'James', 'Marketing Specialist', 103, '0123456791', NULL, 'j.brown@example.com', 'james.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab981-28cd-11ef-af7c-0242ac120002', 'Johnson', 'Emily', 'Analyste Financier', 201, '0123456792', NULL, 'e.johnson@example.com', 'emily.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab9bb-28cd-11ef-af7c-0242ac120002', 'Williams', 'Robert', 'Support Technique', 301, '0123456793', NULL, 'r.williams@example.com', 'robert.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab9f7-28cd-11ef-af7c-0242ac120002', 'Jones', 'Patricia', 'Chef de Projet', 202, '0123456794', NULL, 'p.jones@example.com', 'patricia.png', 1, '2024-06-12 15:10:07', NULL),
('da8aba2d-28cd-11ef-af7c-0242ac120002', 'Garcia', 'Michael', 'Designer UX/UI', 203, '0123456795', NULL, 'm.garcia@example.com', 'michael.png', 1, '2024-06-12 15:10:07', NULL),
('da8abb4f-28cd-11ef-af7c-0242ac120002', 'Martinez', 'Linda', 'Développeuse Frontend', 204, '0123456796', NULL, 'l.martinez@example.com', 'linda.png', 1, '2024-06-12 15:10:07', NULL),
('da8abb94-28cd-11ef-af7c-0242ac120002', 'Rodriguez', 'David', 'Administrateur Système', 205, '0123456797', NULL, 'd.rodriguez@example.com', 'david.png', 1, '2024-06-12 15:10:07', NULL),
('da8abbca-28cd-11ef-af7c-0242ac120002', 'Hernandez', 'Barbara', 'Spécialiste SEO', 302, '0123456798', NULL, 'b.hernandez@example.com', 'barbara.png', 1, '2024-06-12 15:10:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entree2Departement`
--

CREATE TABLE `entree2Departement` (
  `entree_id` varchar(128) NOT NULL,
  `departement_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `entree2Departement`
--

INSERT INTO `entree2Departement` (`entree_id`, `departement_id`) VALUES
('da8ab5b6-28cd-11ef-af7c-0242ac120002', '2'),
('da8ab884-28cd-11ef-af7c-0242ac120002', '1'),
('da8ab93c-28cd-11ef-af7c-0242ac120002', '3'),
('da8ab981-28cd-11ef-af7c-0242ac120002', '4'),
('da8ab9bb-28cd-11ef-af7c-0242ac120002', '5'),
('da8ab9f7-28cd-11ef-af7c-0242ac120002', '2'),
('da8aba2d-28cd-11ef-af7c-0242ac120002', '2'),
('da8abb4f-28cd-11ef-af7c-0242ac120002', '2'),
('da8abb94-28cd-11ef-af7c-0242ac120002', '2'),
('da8abbca-28cd-11ef-af7c-0242ac120002', '3');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_pk2` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
