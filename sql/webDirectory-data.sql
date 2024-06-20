-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql_container_webDirectory
-- Généré le : jeu. 20 juin 2024 à 10:55
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

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `etage`, `description`) VALUES
(1, 'Ressources Humaines', '1', 'Département des ressources humaines'),
(2, 'Informatique', '2', 'Département informatique'),
(3, 'Marketing', '3', 'Département marketing'),
(4, 'Finance', '4', 'Département des finances'),
(5, 'Support Client', '5', 'Département de support client');

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `nom`, `prenom`, `fonction`, `numeroBureau`, `numeroTel1`, `numeroTel2`, `email`, `image`, `statut`, `created_at`, `updated_at`) VALUES
('da8ab5b6-28cd-11ef-af7c-0242ac120002', 'Doe', 'John', 'Développeur', 101, '0123456789', NULL, 'j.doe@example.com', 'john.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab884-28cd-11ef-af7c-0242ac120002', 'Smith', 'Anna', 'RH Manager', 102, '0123456790', NULL, 'a.smith@example.com', 'anna.png', 1, '2024-06-12 15:10:07', '2024-06-20 08:10:32'),
('da8ab93c-28cd-11ef-af7c-0242ac120002', 'Brown', 'James', 'Marketing Specialist', 103, '0123456791', NULL, 'j.brown@example.com', 'james.png', 1, '2024-06-12 15:10:07', '2024-06-17 09:36:38'),
('da8ab981-28cd-11ef-af7c-0242ac120002', 'Johnson', 'Emily', 'Analyste Financier', 201, '0123456792', NULL, 'e.johnson@example.com', 'emily.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab9bb-28cd-11ef-af7c-0242ac120002', 'Williams', 'Robert', 'Support Technique', 301, '0123456793', NULL, 'r.williams@example.com', 'robert.png', 1, '2024-06-12 15:10:07', NULL),
('da8ab9f7-28cd-11ef-af7c-0242ac120002', 'Jones', 'Patricia', 'Chef de Projet', 202, '0123456794', NULL, 'p.jones@example.com', 'patricia.png', 1, '2024-06-12 15:10:07', NULL),
('da8aba2d-28cd-11ef-af7c-0242ac120002', 'Garcia', 'Michael', 'Designer UX/UI', 203, '0123456795', NULL, 'm.garcia@example.com', 'michael.png', 1, '2024-06-12 15:10:07', '2024-06-14 11:19:07'),
('da8abb4f-28cd-11ef-af7c-0242ac120002', 'Martinez', 'Linda', 'Développeuse Frontend', 204, '0123456796', NULL, 'l.martinez@example.com', 'linda.png', 1, '2024-06-12 15:10:07', NULL),
('da8abb94-28cd-11ef-af7c-0242ac120002', 'Rodriguez', 'David', 'Administrateur Système', 205, '0123456797', NULL, 'd.rodriguez@example.com', 'david.png', 1, '2024-06-12 15:10:07', NULL),
('da8abbca-28cd-11ef-af7c-0242ac120002', 'Hernandez', 'Barbara', 'Spécialiste SEO', 302, '0123456798', NULL, 'b.hernandez@example.com', 'barbara.png', 1, '2024-06-12 15:10:07', '2024-06-14 13:46:10');

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

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_id`, `password`, `role`) VALUES
('761f4417-2995-11ef-821b-0242ac120002', 'admin1@example.org', '$2y$10$78df7Sb/qkzC/mTTxQzhHOvEaoDyqMwueKh9IGOffLajSa94CPv4G', 1),
('9c473415-5087-40eb-b047-9fdfe40f814d', 'super_admin@example.org', '$2y$10$grNyI7Z9QIkSPVgbANAqtu5F4906OvkgaYCpW1aqZcGdjF/rqSQ4i', 100),
('9c4735b6-bcaa-41ac-bed0-05e12be09eee', 'admin2@example.org', '$2y$10$Qnz3CS9th1AAKSazM1oaYepYhxcpw4u4jYaWSAAsUWsl7nQcuWYb6', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
