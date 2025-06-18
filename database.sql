SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS megacasting;
CREATE DATEBASE megacasting;
USE megacasting;

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `casting_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('en_attente','accepte','refuse') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
    `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_application` (`casting_id`,`user_id`),
    KEY `user_id` (`user_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `candidatures` (
    `id` int NOT NULL AUTO_INCREMENT,
    `casting_id` int NOT NULL,
    `user_id` int NOT NULL,
    `statut` enum('en attente','acceptée','refusée') COLLATE utf8mb4_unicode_ci DEFAULT 'en attente',
    `date_postulation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `casting_id` (`casting_id`),
    KEY `user_id` (`user_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `candidatures` (`id`, `casting_id`, `user_id`, `statut`, `date_postulation`) VALUES
 (1, 1, 3, 'en attente', '2025-06-18 11:47:29'),
 (2, 1, 4, 'acceptée', '2025-06-18 11:47:29'),
 (3, 2, 3, 'refusée', '2025-06-18 11:47:29'),
 (4, 3, 5, 'en attente', '2025-06-18 11:47:29');


CREATE TABLE IF NOT EXISTS `castings` (
    `id` int NOT NULL AUTO_INCREMENT,
    `projet_id` int NOT NULL,
    `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `date_debut` date NOT NULL,
    `date_fin` date NOT NULL,
    PRIMARY KEY (`id`),
    KEY `projet_id` (`projet_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `castings` (`id`, `projet_id`, `titre`, `description`, `date_debut`, `date_fin`) VALUES
(1, 1, 'Casting Principal', 'Recherche acteur principal dramatique', '2025-06-01', '2025-07-01'),
(2, 1, 'Second rôle', 'Recherche acteur secondaire', '2025-06-10', '2025-07-10'),
(3, 2, 'Rôle Comique', 'Acteur drôle et expressif', '2025-05-01', '2025-06-01');


CREATE TABLE IF NOT EXISTS `projects` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` text COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `created_at`) VALUES
(1, 1, 'Projet Film Noir', 'Un long-métrage sombre et mystérieux.', '2025-06-18 11:47:29'),
(2, 2, 'Projet Comédie', 'Une comédie légère pour l’été.', '2025-06-18 11:47:29');


CREATE TABLE IF NOT EXISTS `users` (
   `id` int NOT NULL AUTO_INCREMENT,
   `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `role` enum('candidat','auteur') COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
    ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Auteur1', 'auteur1@example.com', '$2y$10$DUMMYHASHFORTEST1', 'auteur'),
(2, 'Auteur2', 'auteur2@example.com', '$2y$10$DUMMYHASHFORTEST2', 'auteur'),
(3, 'Candidat1', 'candidat1@example.com', '$2y$10$DUMMYHASHFORTEST3', 'candidat'),
(4, 'Candidat2', 'candidat2@example.com', '$2y$10$DUMMYHASHFORTEST4', 'candidat'),
(5, 'Candidat3', 'candidat3@example.com', '$2y$10$DUMMYHASHFORTEST5', 'candidat');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
