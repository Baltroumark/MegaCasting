SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS megacasting;
CREATE DATABASE megacasting;
USE megacasting;

CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `username` varchar(100) NOT NULL,
                         `email` varchar(191) NOT NULL,
                         `password_hash` varchar(255) NOT NULL,
                         `role` enum('candidat','auteur') NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projects` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `user_id` int NOT NULL,
                            `title` varchar(255) NOT NULL,
                            `description` text,
                            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`),
                            KEY `user_id` (`user_id`),
                            CONSTRAINT fk_projects_user FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `castings` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `projet_id` int NOT NULL,
                            `user_id` int NOT NULL,
                            `titre` varchar(255) NOT NULL,
                            `description` text NOT NULL,
                            `date_debut` date NOT NULL,
                            `date_fin` date NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `projet_id` (`projet_id`),
                            KEY `user_id` (`user_id`),
                            CONSTRAINT fk_castings_project FOREIGN KEY (`projet_id`) REFERENCES `projects`(`id`),
                            CONSTRAINT fk_castings_user FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `applications` (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `casting_id` int NOT NULL,
                                `user_id` int NOT NULL,
                                `status` enum('en_attente','accepte','refuse') NOT NULL DEFAULT 'en_attente',
                                `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                                PRIMARY KEY (`id`),
                                UNIQUE KEY `unique_application` (`casting_id`,`user_id`),
                                KEY `user_id` (`user_id`),
                                CONSTRAINT fk_applications_casting FOREIGN KEY (`casting_id`) REFERENCES `castings`(`id`),
                                CONSTRAINT fk_applications_user FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exemples d'insertion
INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`) VALUES
                                                                             (1, 'Auteur1', 'auteur1@example.com', '$2y$10$DUMMYHASHFORTEST1', 'auteur'),
                                                                             (2, 'Auteur2', 'auteur2@example.com', '$2y$10$DUMMYHASHFORTEST2', 'auteur'),
                                                                             (3, 'Candidat1', 'candidat1@example.com', '$2y$10$DUMMYHASHFORTEST3', 'candidat'),
                                                                             (4, 'Candidat2', 'candidat2@example.com', '$2y$10$DUMMYHASHFORTEST4', 'candidat'),
                                                                             (5, 'Candidat3', 'candidat3@example.com', '$2y$10$DUMMYHASHFORTEST5', 'candidat');

INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `created_at`) VALUES
                                                                                   (1, 1, 'Projet Film Noir', 'Un long-métrage sombre et mystérieux.', '2025-06-18 11:47:29'),
                                                                                   (2, 2, 'Projet Comédie', 'Une comédie légère pour l’été.', '2025-06-18 11:47:29');

INSERT INTO `castings` (`id`, `projet_id`, `user_id`, `titre`, `description`, `date_debut`, `date_fin`) VALUES
                                                                                                            (1, 1, 1, 'Casting Principal', 'Recherche acteur principal dramatique', '2025-06-01', '2025-07-01'),
                                                                                                            (2, 1, 1, 'Second rôle', 'Recherche acteur secondaire', '2025-06-10', '2025-07-10'),
                                                                                                            (3, 2, 2, 'Rôle Comique', 'Acteur drôle et expressif', '2025-05-01', '2025-06-01');

INSERT INTO `applications` (`id`, `casting_id`, `user_id`, `status`, `applied_at`) VALUES
                                                                                       (1, 1, 3, 'en_attente', '2025-06-18 11:47:29'),
                                                                                       (2, 1, 4, 'accepte', '2025-06-18 11:47:29'),
                                                                                       (3, 2, 3, 'refuse', '2025-06-18 11:47:29'),
                                                                                       (4, 3, 5, 'en_attente', '2025-06-18 11:47:29');

COMMIT;
