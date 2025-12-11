-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 27 oct. 2021 à 15:03
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fondation`
--
CREATE DATABASE IF NOT EXISTS `fondation` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fondation`;

-- --------------------------------------------------------

--
-- Structure de la table `analyse_details`
--

CREATE TABLE `analyse_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `analyse_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `analyse_details`
--

INSERT INTO `analyse_details` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `analyse_id`) VALUES
(1, 'NFS', '2020-08-07 19:41:26', '2020-08-07 19:41:26', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `analysis`
--

CREATE TABLE `analysis` (
  `id` int(10) UNSIGNED NOT NULL,
  `analysis_comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `medecin_id` int(10) UNSIGNED DEFAULT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `consultation_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `analysis`
--

INSERT INTO `analysis` (`id`, `analysis_comment`, `reference`, `created_at`, `updated_at`, `deleted_at`, `medecin_id`, `patient_id`, `consultation_id`) VALUES
(1, NULL, 'Analyse/Cons/5/Medecin/1', '2020-08-07 19:41:26', '2020-08-07 19:41:26', NULL, 1, 1, 5),
(2, NULL, 'Ref/15/01/2020', '2020-08-08 18:30:39', '2020-08-08 18:30:39', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `appointment_time` datetime NOT NULL,
  `gratuite` tinyint(1) DEFAULT 0,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `medecin_id` int(10) UNSIGNED NOT NULL,
  `visite_id` int(10) UNSIGNED NOT NULL,
  `consultation_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `gratuit` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `ordre`, `appointment_time`, `gratuite`, `comment`, `created_at`, `updated_at`, `deleted_at`, `patient_id`, `medecin_id`, `visite_id`, `consultation_id`, `status_id`, `user_id`, `gratuit`) VALUES
(1, 1, '2020-08-08 11:10:00', 0, NULL, '2020-08-06 20:54:00', '2020-08-08 17:24:57', NULL, 1, 1, 1, 1, 3, 1, 0),
(2, 2, '2020-08-08 19:04:17', 0, NULL, '2020-08-08 13:07:43', '2020-08-08 17:52:16', NULL, 2, 1, 1, 1, 3, 1, 0),
(3, 3, '2020-08-08 19:37:37', 0, NULL, '2020-08-08 18:38:16', '2020-08-08 18:51:50', NULL, 3, 1, 1, 1, 2, 2, 0),
(4, 4, '2021-01-10 19:48:13', 0, NULL, '2021-01-09 18:48:16', '2021-02-23 23:43:46', NULL, 4, 1, 1, 1, 3, 3, 0),
(5, 1, '2021-02-23 23:50:25', 0, NULL, '2021-02-23 23:44:37', '2021-02-23 23:44:54', NULL, 4, 1, 1, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `appointment_canals`
--

CREATE TABLE `appointment_canals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointment_canals`
--

INSERT INTO `appointment_canals` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Physique', '2020-08-06 18:57:06', '2020-08-06 18:57:06', NULL),
(2, 'En ligne', '2020-08-06 18:57:50', '2020-08-06 18:57:50', NULL),
(3, 'Par téléphone', '2020-08-06 18:58:02', '2020-08-06 18:58:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `prix_aquisition` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `seuil` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `quantity`, `prix_aquisition`, `prix`, `seuil`, `created_at`, `updated_at`, `deleted_at`, `category_id`, `user_id`) VALUES
(1, 'SEBIONEX GEL MOUSSANT 200 ML', 17, 261, 350, 1, '2020-06-24 01:10:44', '2020-06-27 23:48:17', NULL, 1, 1),
(2, 'SEBIONEX K 0 ML', 9, 310, 400, 12, '2020-06-24 01:11:42', '2020-08-29 18:21:21', NULL, 1, 1),
(3, 'TRIACNEAL EXPERT 30ML', 11, 300, 150, 2, '2020-06-24 01:12:46', '2020-08-09 20:53:31', NULL, 2, 1),
(4, 'SEBIUM GOMMANT T/100ml', 8, 290, 120, 1, '2020-06-24 01:13:35', '2020-06-27 22:46:35', NULL, 3, 1),
(5, 'PHOTODERM MAX CR TEITEE CLAIRE SPF 100 T/40ml', 1, 390, 550, 2, '2020-06-24 01:14:39', '2021-09-30 01:41:42', NULL, 3, 1),
(6, 'Last ARTICLE', 1536, 325, 320, 10, '2020-08-06 18:34:08', '2021-09-30 01:30:14', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(1, 'created', 1, 'App\\Medecin', 1, '{\"grade_id\":\"1\",\"specialite_id\":\"1\",\"name\":\"Yahya\",\"last_name\":\"Salma\",\"phone\":\"26332042\",\"phone_2\":null,\"email\":\"salma@admin.com\",\"free_days\":\"7\",\"daily_consultation\":\"20\",\"daily_rdv\":\"20\",\"consultation_duration\":\"0\",\"updated_at\":\"2020-08-06 18:06:46\",\"created_at\":\"2020-08-06 18:06:46\",\"id\":1}', '127.0.0.1', '2020-08-06 18:06:46', '2020-08-06 18:06:46'),
(2, 'updated', 1, 'App\\Medecin', 1, '{\"id\":1,\"name\":\"Salma YAHYA\",\"phone\":\"26332042\",\"phone_2\":null,\"email\":\"salma@admin.com\",\"free_days\":\"7\",\"daily_consultation\":\"20\",\"daily_rdv\":\"20\",\"consultation_duration\":\"0\",\"created_at\":\"2020-08-06 18:06:46\",\"updated_at\":\"2020-08-06 18:19:16\",\"deleted_at\":null,\"grade_id\":\"1\",\"specialite_id\":\"1\"}', '127.0.0.1', '2020-08-06 18:19:16', '2020-08-06 18:19:16'),
(3, 'created', 6, 'App\\Article', 1, '{\"category_id\":\"2\",\"name\":\"Last ARTICLE\",\"quantity\":\"15\",\"prix_aquisition\":\"325\",\"prix\":\"400\",\"seuil\":\"10\",\"updated_at\":\"2020-08-06 18:34:08\",\"created_at\":\"2020-08-06 18:34:08\",\"id\":6}', '127.0.0.1', '2020-08-06 18:34:08', '2020-08-06 18:34:08'),
(4, 'created', 1, 'App\\Commande', 1, '{\"reference\":\"Ref\\/06\\/08\\/2020\\/2049\",\"montant_total\":0,\"user_id\":1,\"updated_at\":\"2020-08-06 20:49:25\",\"created_at\":\"2020-08-06 20:49:25\",\"id\":1}', '127.0.0.1', '2020-08-06 20:49:25', '2020-08-06 20:49:25'),
(5, 'created', 1, 'App\\CommandeDetail', 1, '{\"article_id\":\"6\",\"quantity\":\"12\",\"prix_unitaire\":\"32\",\"montant_total\":384,\"commande_id\":1,\"updated_at\":\"2020-08-06 20:49:25\",\"created_at\":\"2020-08-06 20:49:25\",\"id\":1}', '127.0.0.1', '2020-08-06 20:49:25', '2020-08-06 20:49:25'),
(6, 'updated', 1, 'App\\Commande', 1, '{\"reference\":\"Ref\\/06\\/08\\/2020\\/2049\",\"montant_total\":384,\"user_id\":1,\"updated_at\":\"2020-08-06 20:49:25\",\"created_at\":\"2020-08-06 20:49:25\",\"id\":1}', '127.0.0.1', '2020-08-06 20:49:25', '2020-08-06 20:49:25'),
(7, 'created', 1, 'App\\ConsultationPrice', 1, '{\"type_id\":\"1\",\"medecin_id\":\"1\",\"tarif\":\"8000\",\"user_id\":1,\"updated_at\":\"2020-08-06 21:17:44\",\"created_at\":\"2020-08-06 21:17:44\",\"id\":1}', '127.0.0.1', '2020-08-06 21:17:44', '2020-08-06 21:17:44'),
(8, 'created', 2, 'App\\ConsultationPrice', 1, '{\"type_id\":\"2\",\"medecin_id\":\"1\",\"tarif\":\"10000\",\"user_id\":1,\"updated_at\":\"2020-08-06 21:19:28\",\"created_at\":\"2020-08-06 21:19:28\",\"id\":2}', '127.0.0.1', '2020-08-06 21:19:28', '2020-08-06 21:19:28'),
(10, 'created', 2, 'App\\Facture', 1, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":1,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":1,\"reference\":\"Inv\\/Cons\\/Rdv\\/1\",\"user_id\":1,\"updated_at\":\"2020-08-06 21:28:09\",\"created_at\":\"2020-08-06 21:28:09\",\"id\":2}', '127.0.0.1', '2020-08-06 21:28:09', '2020-08-06 21:28:09'),
(11, 'created', 3, 'App\\Facture', 1, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":1,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":1,\"reference\":\"Inv\\/Cons\\/Rdv\\/1\",\"user_id\":1,\"updated_at\":\"2020-08-07 17:45:52\",\"created_at\":\"2020-08-07 17:45:52\",\"id\":3}', '127.0.0.1', '2020-08-07 17:45:52', '2020-08-07 17:45:52'),
(12, 'created', 2, 'App\\OperationCash', 1, '{\"caisse_id\":\"1\",\"medecin_id\":\"1\",\"montant\":\"5000\",\"user_id\":1,\"updated_at\":\"2020-08-07 19:29:54\",\"created_at\":\"2020-08-07 19:29:54\",\"id\":2}', '127.0.0.1', '2020-08-07 19:29:54', '2020-08-07 19:29:54'),
(19, 'created', 5, 'App\\Consultation', 1, '{\"patient_id\":\"1\",\"appointment_id\":\"1\",\"motif\":\"Motif de la consultation\",\"diagnostic\":\"Diagnostique comment\",\"comment\":\"Commentaire de la first consultation\",\"medecin_id\":1,\"user_id\":1,\"updated_at\":\"2020-08-07 19:41:26\",\"created_at\":\"2020-08-07 19:41:26\",\"id\":5}', '127.0.0.1', '2020-08-07 19:41:26', '2020-08-07 19:41:26'),
(20, 'created', 2, 'App\\Ordonnance', 1, '{\"medecin_id\":1,\"patient_id\":\"1\",\"reference\":\"Ord\\/Cons\\/5\\/Medecin\\/1\",\"ordonnance_comment\":null,\"consultation_id\":5,\"updated_at\":\"2020-08-07 19:41:26\",\"created_at\":\"2020-08-07 19:41:26\",\"id\":2}', '127.0.0.1', '2020-08-07 19:41:26', '2020-08-07 19:41:26'),
(21, 'created', 2, 'App\\OrdonnanceDetail', 1, '{\"medicament\":\"First medicament\",\"forme_id\":\"1\",\"posologie\":\"20 mg\",\"quantity\":\"3\",\"duration\":\"10\",\"ordonnance_id\":2,\"updated_at\":\"2020-08-07 19:41:26\",\"created_at\":\"2020-08-07 19:41:26\",\"id\":2}', '127.0.0.1', '2020-08-07 19:41:26', '2020-08-07 19:41:26'),
(22, 'created', 1, 'App\\Analysi', 1, '{\"medecin_id\":1,\"patient_id\":\"1\",\"reference\":\"Analyse\\/Cons\\/5\\/Medecin\\/1\",\"analysis_comment\":null,\"consultation_id\":5,\"updated_at\":\"2020-08-07 19:41:26\",\"created_at\":\"2020-08-07 19:41:26\",\"id\":1}', '127.0.0.1', '2020-08-07 19:41:26', '2020-08-07 19:41:26'),
(23, 'created', 3, 'App\\Ordonnance', 1, '{\"patient_id\":null,\"ordonnance_comment\":null,\"updated_at\":\"2020-08-08 14:15:22\",\"created_at\":\"2020-08-08 14:15:22\",\"id\":3}', '127.0.0.1', '2020-08-08 14:15:22', '2020-08-08 14:15:22'),
(24, 'created', 3, 'App\\OrdonnanceDetail', 1, '{\"medicament\":\"First medicament\",\"forme_id\":\"2\",\"posologie\":\"5 messages\",\"quantity\":\"1\",\"duration\":\"25\",\"ordonnance_id\":3,\"updated_at\":\"2020-08-08 14:15:22\",\"created_at\":\"2020-08-08 14:15:22\",\"id\":3}', '127.0.0.1', '2020-08-08 14:15:22', '2020-08-08 14:15:22'),
(25, 'deleted', 3, 'App\\Ordonnance', 1, '{\"id\":3,\"ordonnance_comment\":null,\"created_at\":\"2020-08-08 14:15:22\",\"updated_at\":\"2020-08-08 14:15:56\",\"deleted_at\":\"2020-08-08 14:15:56\",\"medecin_id\":null,\"patient_id\":null,\"consultation_id\":null,\"reference\":null}', '127.0.0.1', '2020-08-08 14:15:56', '2020-08-08 14:15:56'),
(26, 'created', 4, 'App\\Ordonnance', 1, '{\"medecin_id\":1,\"patient_id\":\"2\",\"reference\":\"Ord\\/Lib\\/2\\/Medecin\\/1\",\"ordonnance_comment\":null,\"updated_at\":\"2020-08-08 14:16:19\",\"created_at\":\"2020-08-08 14:16:19\",\"id\":4}', '127.0.0.1', '2020-08-08 14:16:19', '2020-08-08 14:16:19'),
(27, 'created', 4, 'App\\OrdonnanceDetail', 1, '{\"medicament\":\"Seconde Medica\",\"forme_id\":\"2\",\"posologie\":\"5 messages\",\"quantity\":\"2\",\"duration\":\"10\",\"ordonnance_id\":4,\"updated_at\":\"2020-08-08 14:16:19\",\"created_at\":\"2020-08-08 14:16:19\",\"id\":4}', '127.0.0.1', '2020-08-08 14:16:19', '2020-08-08 14:16:19'),
(30, 'updated', 4, 'App\\Ordonnance', 1, '{\"id\":4,\"ordonnance_comment\":\"Comment in EDIT\",\"created_at\":\"2020-08-08 14:16:19\",\"updated_at\":\"2020-08-08 15:28:24\",\"deleted_at\":null,\"medecin_id\":1,\"patient_id\":2,\"consultation_id\":null,\"reference\":\"Ord\\/Lib\\/2\\/Medecin\\/1\",\"ordonnance_ordonnance_details\":[{\"id\":4,\"medicament\":\"Seconde Medica\",\"posologie\":\"5 messages\",\"quantity\":2,\"duration\":10,\"created_at\":\"2020-08-08 14:16:19\",\"updated_at\":\"2020-08-08 14:16:19\",\"deleted_at\":null,\"ordonnance_id\":4,\"forme_id\":2}]}', '127.0.0.1', '2020-08-08 15:28:24', '2020-08-08 15:28:24'),
(31, 'created', 7, 'App\\OrdonnanceDetail', 1, '{\"medicament\":\"New in modification\",\"forme_id\":\"1\",\"posologie\":\"20 mg\",\"quantity\":\"2\",\"duration\":\"10\",\"ordonnance_id\":4,\"updated_at\":\"2020-08-08 15:28:24\",\"created_at\":\"2020-08-08 15:28:24\",\"id\":7}', '127.0.0.1', '2020-08-08 15:28:24', '2020-08-08 15:28:24'),
(32, 'updated', 4, 'App\\OrdonnanceDetail', 1, '{\"id\":4,\"medicament\":\"Seconde Medica\",\"posologie\":\"5 messages\",\"quantity\":\"5\",\"duration\":\"5\",\"created_at\":\"2020-08-08 14:16:19\",\"updated_at\":\"2020-08-08 15:28:24\",\"deleted_at\":null,\"ordonnance_id\":4,\"forme_id\":\"2\"}', '127.0.0.1', '2020-08-08 15:28:24', '2020-08-08 15:28:24'),
(33, 'deleted', 7, 'App\\OrdonnanceDetail', 1, '{\"id\":7,\"medicament\":\"New in modification\",\"posologie\":\"20 mg\",\"quantity\":2,\"duration\":10,\"created_at\":\"2020-08-08 15:28:24\",\"updated_at\":\"2020-08-08 15:29:22\",\"deleted_at\":\"2020-08-08 15:29:22\",\"ordonnance_id\":4,\"forme_id\":1}', '127.0.0.1', '2020-08-08 15:29:22', '2020-08-08 15:29:22'),
(40, 'created', 9, 'App\\Soin', 1, '{\"patient_id\":\"2\",\"montant\":0,\"user_id\":1,\"updated_at\":\"2020-08-08 16:11:48\",\"created_at\":\"2020-08-08 16:11:48\",\"id\":9}', '127.0.0.1', '2020-08-08 16:11:48', '2020-08-08 16:11:48'),
(41, 'created', 3, 'App\\SoinDetail', 1, '{\"type_id\":\"1\",\"quantity\":\"1\",\"prix_unitaire\":\"30000\",\"montant\":30000,\"soin_id\":9,\"updated_at\":\"2020-08-08 16:11:48\",\"created_at\":\"2020-08-08 16:11:48\",\"id\":3}', '127.0.0.1', '2020-08-08 16:11:48', '2020-08-08 16:11:48'),
(42, 'updated', 9, 'App\\Soin', 1, '{\"patient_id\":\"2\",\"montant\":30000,\"user_id\":1,\"updated_at\":\"2020-08-08 16:11:48\",\"created_at\":\"2020-08-08 16:11:48\",\"id\":9}', '127.0.0.1', '2020-08-08 16:11:48', '2020-08-08 16:11:48'),
(43, 'created', 4, 'App\\Facture', 1, '{\"montant\":30000,\"factureable_type\":\"App\\\\Soin\",\"factureable_id\":9,\"patient_id\":\"2\",\"reference\":\"Inv\\/Soin\\/Id\\/9\",\"user_id\":1,\"updated_at\":\"2020-08-08 16:11:48\",\"created_at\":\"2020-08-08 16:11:48\",\"id\":4}', '127.0.0.1', '2020-08-08 16:11:48', '2020-08-08 16:11:48'),
(44, 'created', 6, 'App\\Consultation', 2, '{\"patient_id\":\"1\",\"appointment_id\":\"1\",\"motif\":\"Test motif de la consultation\",\"diagnostic\":\"Test diagnostic\",\"comment\":null,\"medecin_id\":1,\"user_id\":2,\"updated_at\":\"2020-08-08 16:59:13\",\"created_at\":\"2020-08-08 16:59:13\",\"id\":6}', '127.0.0.1', '2020-08-08 16:59:13', '2020-08-08 16:59:13'),
(45, 'created', 5, 'App\\Ordonnance', 2, '{\"medecin_id\":1,\"patient_id\":\"1\",\"reference\":\"Ord\\/Cons\\/6\\/Medecin\\/1\",\"ordonnance_comment\":null,\"consultation_id\":6,\"updated_at\":\"2020-08-08 16:59:13\",\"created_at\":\"2020-08-08 16:59:13\",\"id\":5}', '127.0.0.1', '2020-08-08 16:59:13', '2020-08-08 16:59:13'),
(46, 'created', 8, 'App\\OrdonnanceDetail', 2, '{\"medicament\":\"First medicament\",\"forme_id\":\"1\",\"posologie\":\"5\",\"quantity\":\"2\",\"duration\":\"5\",\"ordonnance_id\":5,\"updated_at\":\"2020-08-08 16:59:13\",\"created_at\":\"2020-08-08 16:59:13\",\"id\":8}', '127.0.0.1', '2020-08-08 16:59:13', '2020-08-08 16:59:13'),
(47, 'created', 10, 'App\\Soin', 2, '{\"patient_id\":\"1\",\"montant\":0,\"user_id\":2,\"reference\":\"Soin\\/1\\/20200808171255\",\"updated_at\":\"2020-08-08 17:12:55\",\"created_at\":\"2020-08-08 17:12:55\",\"id\":10}', '127.0.0.1', '2020-08-08 17:12:55', '2020-08-08 17:12:55'),
(48, 'created', 4, 'App\\SoinDetail', 2, '{\"type_id\":\"1\",\"quantity\":\"2\",\"prix_unitaire\":\"30000\",\"montant\":60000,\"soin_id\":10,\"updated_at\":\"2020-08-08 17:12:55\",\"created_at\":\"2020-08-08 17:12:55\",\"id\":4}', '127.0.0.1', '2020-08-08 17:12:55', '2020-08-08 17:12:55'),
(49, 'created', 5, 'App\\SoinDetail', 2, '{\"type_id\":\"1\",\"quantity\":\"1\",\"prix_unitaire\":\"30000\",\"montant\":30000,\"soin_id\":10,\"updated_at\":\"2020-08-08 17:12:55\",\"created_at\":\"2020-08-08 17:12:55\",\"id\":5}', '127.0.0.1', '2020-08-08 17:12:55', '2020-08-08 17:12:55'),
(50, 'updated', 10, 'App\\Soin', 2, '{\"patient_id\":\"1\",\"montant\":90000,\"user_id\":2,\"reference\":\"Soin\\/1\\/20200808171255\",\"updated_at\":\"2020-08-08 17:12:55\",\"created_at\":\"2020-08-08 17:12:55\",\"id\":10}', '127.0.0.1', '2020-08-08 17:12:55', '2020-08-08 17:12:55'),
(51, 'created', 5, 'App\\Facture', 2, '{\"montant\":90000,\"factureable_type\":\"App\\\\Soin\",\"factureable_id\":10,\"patient_id\":\"1\",\"reference\":\"Inv\\/Soin\\/Id\\/10\",\"user_id\":2,\"updated_at\":\"2020-08-08 17:12:55\",\"created_at\":\"2020-08-08 17:12:55\",\"id\":5}', '127.0.0.1', '2020-08-08 17:12:55', '2020-08-08 17:12:55'),
(59, 'created', 14, 'App\\Consultation', 2, '{\"patient_id\":\"1\",\"appointment_id\":\"1\",\"motif\":\"fd fsdfsdf\",\"diagnostic\":\"dsfsdfsdf\",\"comment\":\"fsdfsdf\",\"medecin_id\":1,\"user_id\":2,\"updated_at\":\"2020-08-08 17:24:57\",\"created_at\":\"2020-08-08 17:24:57\",\"id\":14}', '127.0.0.1', '2020-08-08 17:24:57', '2020-08-08 17:24:57'),
(60, 'created', 6, 'App\\Facture', 2, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":2,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":2,\"reference\":\"Inv\\/Cons\\/Rdv\\/2\",\"user_id\":2,\"updated_at\":\"2020-08-08 17:25:32\",\"created_at\":\"2020-08-08 17:25:32\",\"id\":6}', '127.0.0.1', '2020-08-08 17:25:32', '2020-08-08 17:25:32'),
(61, 'created', 3, 'App\\PaiementDetail', 2, '{\"montant\":8000,\"facture_id\":6,\"updated_at\":\"2020-08-08 17:25:32\",\"created_at\":\"2020-08-08 17:25:32\",\"id\":3}', '127.0.0.1', '2020-08-08 17:25:32', '2020-08-08 17:25:32'),
(62, 'created', 15, 'App\\Consultation', 2, '{\"patient_id\":\"2\",\"appointment_id\":\"2\",\"motif\":\"jkgjkh\",\"diagnostic\":\",nbn,b\",\"comment\":\"bn,bn,b\",\"medecin_id\":1,\"user_id\":2,\"updated_at\":\"2020-08-08 17:52:16\",\"created_at\":\"2020-08-08 17:52:16\",\"id\":15}', '127.0.0.1', '2020-08-08 17:52:16', '2020-08-08 17:52:16'),
(63, 'created', 6, 'App\\Ordonnance', 2, '{\"medecin_id\":1,\"patient_id\":\"2\",\"reference\":\"Ord\\/Cons\\/15\\/Medecin\\/1\",\"ordonnance_comment\":null,\"consultation_id\":15,\"updated_at\":\"2020-08-08 17:52:16\",\"created_at\":\"2020-08-08 17:52:16\",\"id\":6}', '127.0.0.1', '2020-08-08 17:52:16', '2020-08-08 17:52:16'),
(64, 'created', 9, 'App\\OrdonnanceDetail', 2, '{\"medicament\":\"Anthelios spf 50+\",\"forme_id\":\"5\",\"posologie\":\"une application avant exposition solaire\",\"quantity\":\"1\",\"duration\":\"25\",\"ordonnance_id\":6,\"updated_at\":\"2020-08-08 17:52:16\",\"created_at\":\"2020-08-08 17:52:16\",\"id\":9}', '127.0.0.1', '2020-08-08 17:52:16', '2020-08-08 17:52:16'),
(65, 'created', 2, 'App\\Analysi', 2, '{\"reference\":\"Ref\\/15\\/01\\/2020\",\"patient_id\":\"1\",\"updated_at\":\"2020-08-08 18:30:39\",\"created_at\":\"2020-08-08 18:30:39\",\"id\":2}', '127.0.0.1', '2020-08-08 18:30:39', '2020-08-08 18:30:39'),
(66, 'created', 7, 'App\\Facture', 3, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":3,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":3,\"reference\":\"Inv\\/Cons\\/Rdv\\/3\",\"user_id\":3,\"updated_at\":\"2020-08-08 18:51:50\",\"created_at\":\"2020-08-08 18:51:50\",\"id\":7}', '127.0.0.1', '2020-08-08 18:51:50', '2020-08-08 18:51:50'),
(67, 'created', 4, 'App\\PaiementDetail', 3, '{\"montant\":8000,\"facture_id\":7,\"updated_at\":\"2020-08-08 18:51:50\",\"created_at\":\"2020-08-08 18:51:50\",\"id\":4}', '127.0.0.1', '2020-08-08 18:51:50', '2020-08-08 18:51:50'),
(68, 'created', 11, 'App\\Soin', 3, '{\"patient_id\":\"2\",\"montant\":0,\"user_id\":3,\"reference\":\"Soin\\/2\\/20200808185926\",\"updated_at\":\"2020-08-08 18:59:26\",\"created_at\":\"2020-08-08 18:59:26\",\"id\":11}', '127.0.0.1', '2020-08-08 18:59:26', '2020-08-08 18:59:26'),
(69, 'created', 6, 'App\\SoinDetail', 3, '{\"type_id\":\"1\",\"quantity\":\"1\",\"prix_unitaire\":\"30000\",\"montant\":30000,\"soin_id\":11,\"updated_at\":\"2020-08-08 18:59:26\",\"created_at\":\"2020-08-08 18:59:26\",\"id\":6}', '127.0.0.1', '2020-08-08 18:59:26', '2020-08-08 18:59:26'),
(70, 'updated', 11, 'App\\Soin', 3, '{\"patient_id\":\"2\",\"montant\":30000,\"user_id\":3,\"reference\":\"Soin\\/2\\/20200808185926\",\"updated_at\":\"2020-08-08 18:59:26\",\"created_at\":\"2020-08-08 18:59:26\",\"id\":11}', '127.0.0.1', '2020-08-08 18:59:26', '2020-08-08 18:59:26'),
(71, 'created', 8, 'App\\Facture', 3, '{\"montant\":30000,\"factureable_type\":\"App\\\\Soin\",\"factureable_id\":11,\"patient_id\":\"2\",\"reference\":\"Inv\\/Soin\\/Id\\/11\",\"user_id\":3,\"updated_at\":\"2020-08-08 18:59:26\",\"created_at\":\"2020-08-08 18:59:26\",\"id\":8}', '127.0.0.1', '2020-08-08 18:59:26', '2020-08-08 18:59:26'),
(72, 'created', 1, 'App\\Fournisseur', 1, '{\"name\":\"Fournitures et services\",\"phone\":\"22327272\",\"solde\":\"0\",\"user_id\":1,\"updated_at\":\"2020-08-09 19:18:10\",\"created_at\":\"2020-08-09 19:18:10\",\"id\":1}', '127.0.0.1', '2020-08-09 19:18:10', '2020-08-09 19:18:10'),
(73, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":\"44350002\",\"solde\":0,\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-09 19:19:28\",\"deleted_at\":null}', '127.0.0.1', '2020-08-09 19:19:28', '2020-08-09 19:19:28'),
(78, 'created', 2, 'App\\Sale', 1, '{\"patient_id\":\"2\",\"reference\":\"Vente\\/Articles\\/2\\/20200809205331\",\"montant\":\"1200\",\"user_id\":1,\"updated_at\":\"2020-08-09 20:53:31\",\"created_at\":\"2020-08-09 20:53:31\",\"id\":2}', '127.0.0.1', '2020-08-09 20:53:31', '2020-08-09 20:53:31'),
(79, 'created', 3, 'App\\SaleDetail', 1, '{\"article_id\":\"3\",\"quantity\":\"02\",\"prix_unitaire\":\"150\",\"montant_total\":\"300\",\"sale_id\":2,\"updated_at\":\"2020-08-09 20:53:31\",\"created_at\":\"2020-08-09 20:53:31\",\"id\":3}', '127.0.0.1', '2020-08-09 20:53:31', '2020-08-09 20:53:31'),
(80, 'created', 4, 'App\\SaleDetail', 1, '{\"article_id\":\"2\",\"quantity\":\"6\",\"prix_unitaire\":\"400\",\"montant_total\":\"900\",\"sale_id\":2,\"updated_at\":\"2020-08-09 20:53:31\",\"created_at\":\"2020-08-09 20:53:31\",\"id\":4}', '127.0.0.1', '2020-08-09 20:53:31', '2020-08-09 20:53:31'),
(81, 'updated', 2, 'App\\Sale', 1, '{\"patient_id\":\"2\",\"reference\":\"Vente\\/Articles\\/2\\/20200809205331\",\"montant\":2700,\"user_id\":1,\"updated_at\":\"2020-08-09 20:53:31\",\"created_at\":\"2020-08-09 20:53:31\",\"id\":2}', '127.0.0.1', '2020-08-09 20:53:31', '2020-08-09 20:53:31'),
(82, 'created', 9, 'App\\Facture', 1, '{\"montant\":2700,\"patient_id\":\"2\",\"factureable_type\":\"App\\\\Sale\",\"factureable_id\":2,\"reference\":\"Inv\\/Vente\\/Id\\/2\",\"user_id\":1,\"updated_at\":\"2020-08-09 20:53:31\",\"created_at\":\"2020-08-09 20:53:31\",\"id\":9}', '127.0.0.1', '2020-08-09 20:53:31', '2020-08-09 20:53:31'),
(83, 'created', 2, 'App\\Commande', 1, '{\"fournisseur_id\":\"1\",\"reference\":\"Ref\\/15\\/01\\/2020\\/1203\",\"montant_paye\":\"5000\",\"montant_total\":0,\"user_id\":1,\"updated_at\":\"2020-08-11 17:17:15\",\"created_at\":\"2020-08-11 17:17:15\",\"id\":2}', '127.0.0.1', '2020-08-11 17:17:15', '2020-08-11 17:17:15'),
(84, 'created', 2, 'App\\CommandeDetail', 1, '{\"article_id\":\"6\",\"quantity\":\"1500\",\"prix_unitaire\":\"200\",\"montant_total\":300000,\"commande_id\":2,\"updated_at\":\"2020-08-11 17:17:15\",\"created_at\":\"2020-08-11 17:17:15\",\"id\":2}', '127.0.0.1', '2020-08-11 17:17:15', '2020-08-11 17:17:15'),
(85, 'updated', 2, 'App\\Commande', 1, '{\"fournisseur_id\":\"1\",\"reference\":\"Ref\\/15\\/01\\/2020\\/1203\",\"montant_paye\":\"5000\",\"montant_total\":300000,\"user_id\":1,\"updated_at\":\"2020-08-11 17:17:15\",\"created_at\":\"2020-08-11 17:17:15\",\"id\":2}', '127.0.0.1', '2020-08-11 17:17:15', '2020-08-11 17:17:15'),
(86, 'created', 1, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"10000\",\"updated_at\":\"2020-08-12 14:56:10\",\"created_at\":\"2020-08-12 14:56:10\",\"id\":1}', '127.0.0.1', '2020-08-12 14:56:10', '2020-08-12 14:56:10'),
(87, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 14:56:10\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 14:56:10', '2020-08-12 14:56:10'),
(88, 'created', 2, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"3500\",\"user_id\":1,\"updated_at\":\"2020-08-12 15:34:35\",\"created_at\":\"2020-08-12 15:34:35\",\"id\":2}', '127.0.0.1', '2020-08-12 15:34:35', '2020-08-12 15:34:35'),
(89, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 15:34:35\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 15:34:35', '2020-08-12 15:34:35'),
(90, 'created', 3, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"1000\",\"user_id\":1,\"updated_at\":\"2020-08-12 15:37:10\",\"created_at\":\"2020-08-12 15:37:10\",\"id\":3}', '127.0.0.1', '2020-08-12 15:37:10', '2020-08-12 15:37:10'),
(91, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 15:37:10\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 15:37:10', '2020-08-12 15:37:10'),
(92, 'created', 4, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"500\",\"user_id\":1,\"updated_at\":\"2020-08-12 15:37:28\",\"created_at\":\"2020-08-12 15:37:28\",\"id\":4}', '127.0.0.1', '2020-08-12 15:37:28', '2020-08-12 15:37:28'),
(93, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 15:37:28\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 15:37:28', '2020-08-12 15:37:28'),
(94, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 15:53:50\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 15:53:50', '2020-08-12 15:53:50'),
(95, 'deleted', 4, 'App\\CommandePaiement', 1, '{\"id\":4,\"montant\":500,\"user_id\":1,\"fournisseur_id\":1,\"created_at\":\"2020-08-12 15:37:28\",\"updated_at\":\"2020-08-12 15:53:50\",\"deleted_at\":\"2020-08-12 15:53:50\"}', '127.0.0.1', '2020-08-12 15:53:50', '2020-08-12 15:53:50'),
(96, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-12 15:53:59\",\"deleted_at\":null}', '127.0.0.1', '2020-08-12 15:53:59', '2020-08-12 15:53:59'),
(97, 'deleted', 3, 'App\\CommandePaiement', 1, '{\"id\":3,\"montant\":1000,\"user_id\":1,\"fournisseur_id\":1,\"created_at\":\"2020-08-12 15:37:10\",\"updated_at\":\"2020-08-12 15:53:59\",\"deleted_at\":\"2020-08-12 15:53:59\"}', '127.0.0.1', '2020-08-12 15:53:59', '2020-08-12 15:53:59'),
(98, 'created', 12, 'App\\Soin', 1, '{\"patient_id\":\"3\",\"medecin_id\":\"1\",\"montant\":0,\"user_id\":1,\"reference\":\"Soin\\/3\\/20200813114520\",\"updated_at\":\"2020-08-13 11:45:20\",\"created_at\":\"2020-08-13 11:45:20\",\"id\":12}', '127.0.0.1', '2020-08-13 11:45:20', '2020-08-13 11:45:20'),
(99, 'created', 7, 'App\\SoinDetail', 1, '{\"type_id\":\"1\",\"quantity\":\"1\",\"prix_unitaire\":\"30000\",\"montant\":30000,\"soin_id\":12,\"updated_at\":\"2020-08-13 11:45:20\",\"created_at\":\"2020-08-13 11:45:20\",\"id\":7}', '127.0.0.1', '2020-08-13 11:45:20', '2020-08-13 11:45:20'),
(100, 'updated', 12, 'App\\Soin', 1, '{\"patient_id\":\"3\",\"medecin_id\":\"1\",\"montant\":30000,\"user_id\":1,\"reference\":\"Soin\\/3\\/20200813114520\",\"updated_at\":\"2020-08-13 11:45:20\",\"created_at\":\"2020-08-13 11:45:20\",\"id\":12}', '127.0.0.1', '2020-08-13 11:45:20', '2020-08-13 11:45:20'),
(101, 'created', 10, 'App\\Facture', 1, '{\"montant\":30000,\"factureable_type\":\"App\\\\Soin\",\"factureable_id\":12,\"patient_id\":\"3\",\"reference\":\"Inv\\/Soin\\/Id\\/12\",\"user_id\":1,\"updated_at\":\"2020-08-13 11:45:20\",\"created_at\":\"2020-08-13 11:45:20\",\"id\":10}', '127.0.0.1', '2020-08-13 11:45:20', '2020-08-13 11:45:20'),
(102, 'created', 1, 'App\\Note', 1, '{\"patient_id\":\"3\",\"objet\":\"Note de test\",\"content\":\"<p>Bonjour,<\\/p>\\r\\n\\r\\n<p>Mahi <strong>Ahmedou <\\/strong>Saghir<\\/p>\",\"updated_at\":\"2020-08-14 13:08:29\",\"created_at\":\"2020-08-14 13:08:29\",\"id\":1}', '127.0.0.1', '2020-08-14 13:08:29', '2020-08-14 13:08:29'),
(103, 'created', 13, 'App\\Soin', 1, '{\"patient_id\":\"4\",\"medecin_id\":\"1\",\"montant\":0,\"user_id\":1,\"reference\":\"Soin\\/4\\/20200814231325\",\"updated_at\":\"2020-08-14 23:13:25\",\"created_at\":\"2020-08-14 23:13:25\",\"id\":13}', '127.0.0.1', '2020-08-14 23:13:25', '2020-08-14 23:13:25'),
(104, 'created', 8, 'App\\SoinDetail', 1, '{\"type_id\":\"1\",\"quantity\":\"1\",\"prix_unitaire\":\"30000\",\"montant\":30000,\"soin_id\":13,\"updated_at\":\"2020-08-14 23:13:25\",\"created_at\":\"2020-08-14 23:13:25\",\"id\":8}', '127.0.0.1', '2020-08-14 23:13:25', '2020-08-14 23:13:25'),
(105, 'updated', 13, 'App\\Soin', 1, '{\"patient_id\":\"4\",\"medecin_id\":\"1\",\"montant\":30000,\"user_id\":1,\"reference\":\"Soin\\/4\\/20200814231325\",\"updated_at\":\"2020-08-14 23:13:25\",\"created_at\":\"2020-08-14 23:13:25\",\"id\":13}', '127.0.0.1', '2020-08-14 23:13:25', '2020-08-14 23:13:25'),
(106, 'created', 11, 'App\\Facture', 1, '{\"montant\":30000,\"factureable_type\":\"App\\\\Soin\",\"factureable_id\":13,\"patient_id\":\"4\",\"reference\":\"Inv\\/Soin\\/Id\\/13\",\"user_id\":1,\"updated_at\":\"2020-08-14 23:13:25\",\"created_at\":\"2020-08-14 23:13:25\",\"id\":11}', '127.0.0.1', '2020-08-14 23:13:25', '2020-08-14 23:13:25'),
(107, 'created', 1, 'App\\Paiement', 1, '{\"montant\":\"1000\",\"comment\":null,\"user_id\":1,\"updated_at\":\"2020-08-14 23:39:04\",\"created_at\":\"2020-08-14 23:39:04\",\"id\":1}', '127.0.0.1', '2020-08-14 23:39:04', '2020-08-14 23:39:04'),
(108, 'created', 5, 'App\\PaiementDetail', 1, '{\"facture_id\":\"11\",\"montant\":\"1000\",\"caisse_id\":2,\"paiement_id\":1,\"updated_at\":\"2020-08-14 23:39:04\",\"created_at\":\"2020-08-14 23:39:04\",\"id\":5}', '127.0.0.1', '2020-08-14 23:39:04', '2020-08-14 23:39:04'),
(109, 'created', 2, 'App\\Paiement', 1, '{\"montant\":\"9000\",\"comment\":null,\"reference\":\"Paiement\\/4\\/20200814234346\",\"user_id\":1,\"updated_at\":\"2020-08-14 23:43:46\",\"created_at\":\"2020-08-14 23:43:46\",\"id\":2}', '127.0.0.1', '2020-08-14 23:43:46', '2020-08-14 23:43:46'),
(110, 'created', 6, 'App\\PaiementDetail', 1, '{\"facture_id\":\"11\",\"montant\":\"9000\",\"caisse_id\":2,\"paiement_id\":2,\"updated_at\":\"2020-08-14 23:43:46\",\"created_at\":\"2020-08-14 23:43:46\",\"id\":6}', '127.0.0.1', '2020-08-14 23:43:46', '2020-08-14 23:43:46'),
(114, 'created', 4, 'App\\Paiement', 1, '{\"montant\":\"15700\",\"comment\":null,\"reference\":\"Paiement\\/2\\/20200814234727\",\"user_id\":1,\"updated_at\":\"2020-08-14 23:47:27\",\"created_at\":\"2020-08-14 23:47:27\",\"id\":4}', '127.0.0.1', '2020-08-14 23:47:27', '2020-08-14 23:47:27'),
(115, 'created', 9, 'App\\PaiementDetail', 1, '{\"facture_id\":\"4\",\"montant\":\"10000\",\"caisse_id\":2,\"paiement_id\":4,\"updated_at\":\"2020-08-14 23:47:27\",\"created_at\":\"2020-08-14 23:47:27\",\"id\":9}', '127.0.0.1', '2020-08-14 23:47:27', '2020-08-14 23:47:27'),
(116, 'created', 10, 'App\\PaiementDetail', 1, '{\"facture_id\":\"8\",\"montant\":\"5000\",\"caisse_id\":2,\"paiement_id\":4,\"updated_at\":\"2020-08-14 23:47:27\",\"created_at\":\"2020-08-14 23:47:27\",\"id\":10}', '127.0.0.1', '2020-08-14 23:47:27', '2020-08-14 23:47:27'),
(117, 'created', 11, 'App\\PaiementDetail', 1, '{\"facture_id\":\"9\",\"montant\":\"700\",\"caisse_id\":1,\"paiement_id\":4,\"updated_at\":\"2020-08-14 23:47:27\",\"created_at\":\"2020-08-14 23:47:27\",\"id\":11}', '127.0.0.1', '2020-08-14 23:47:27', '2020-08-14 23:47:27'),
(118, 'created', 3, 'App\\OperationCash', 1, '{\"caisse_id\":\"2\",\"medecin_id\":\"1\",\"montant\":\"45000\",\"user_id\":1,\"updated_at\":\"2020-08-14 23:53:05\",\"created_at\":\"2020-08-14 23:53:05\",\"id\":3}', '127.0.0.1', '2020-08-14 23:53:05', '2020-08-14 23:53:05'),
(119, 'created', 5, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"500\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:20:33\",\"created_at\":\"2020-08-15 01:20:33\",\"id\":5}', '127.0.0.1', '2020-08-15 01:20:33', '2020-08-15 01:20:33'),
(120, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:20:33\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:20:33', '2020-08-15 01:20:33'),
(121, 'created', 6, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:21:53\",\"created_at\":\"2020-08-15 01:21:53\",\"id\":6}', '127.0.0.1', '2020-08-15 01:21:53', '2020-08-15 01:21:53'),
(122, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:21:53\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:21:53', '2020-08-15 01:21:53'),
(123, 'created', 7, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:22:22\",\"created_at\":\"2020-08-15 01:22:22\",\"id\":7}', '127.0.0.1', '2020-08-15 01:22:22', '2020-08-15 01:22:22'),
(124, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:22:22\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:22:22', '2020-08-15 01:22:22'),
(125, 'created', 8, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:23:46\",\"created_at\":\"2020-08-15 01:23:46\",\"id\":8}', '127.0.0.1', '2020-08-15 01:23:46', '2020-08-15 01:23:46'),
(126, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:23:46\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:23:46', '2020-08-15 01:23:46'),
(127, 'created', 9, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:24:17\",\"created_at\":\"2020-08-15 01:24:17\",\"id\":9}', '127.0.0.1', '2020-08-15 01:24:17', '2020-08-15 01:24:17'),
(128, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:24:17\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:24:17', '2020-08-15 01:24:17'),
(129, 'created', 10, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:24:49\",\"created_at\":\"2020-08-15 01:24:49\",\"id\":10}', '127.0.0.1', '2020-08-15 01:24:49', '2020-08-15 01:24:49'),
(130, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:24:49\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:24:49', '2020-08-15 01:24:49'),
(131, 'created', 11, 'App\\CommandePaiement', 1, '{\"fournisseur_id\":1,\"montant\":\"100\",\"user_id\":1,\"updated_at\":\"2020-08-15 01:26:10\",\"created_at\":\"2020-08-15 01:26:10\",\"id\":11}', '127.0.0.1', '2020-08-15 01:26:10', '2020-08-15 01:26:10'),
(132, 'updated', 1, 'App\\Fournisseur', 1, '{\"id\":1,\"name\":\"Fournitures et services\",\"phone\":44350002,\"solde\":{},\"user_id\":1,\"created_at\":\"2020-08-09 19:18:10\",\"updated_at\":\"2020-08-15 01:26:10\",\"deleted_at\":null}', '127.0.0.1', '2020-08-15 01:26:10', '2020-08-15 01:26:10'),
(133, 'created', 2, 'App\\Medecin', 1, '{\"grade_id\":\"1\",\"specialite_id\":\"1\",\"name\":\"Mohamed Sid\'Ahmed\",\"phone\":\"22327272\",\"phone_2\":null,\"email\":null,\"free_days\":\"1\",\"daily_consultation\":\"0\",\"daily_rdv\":\"0\",\"consultation_duration\":\"0\",\"updated_at\":\"2020-08-20 16:42:11\",\"created_at\":\"2020-08-20 16:42:11\",\"id\":2}', '127.0.0.1', '2020-08-20 16:42:11', '2020-08-20 16:42:11'),
(134, 'created', 3, 'App\\Commande', 1, '{\"fournisseur_id\":\"1\",\"reference\":\"Ba\\/Abou\\/464103630\",\"montant_paye\":\"2000\",\"montant_total\":\"7000\",\"user_id\":1,\"updated_at\":\"2020-08-29 18:21:21\",\"created_at\":\"2020-08-29 18:21:21\",\"id\":3}', '127.0.0.1', '2020-08-29 18:21:21', '2020-08-29 18:21:21'),
(135, 'created', 3, 'App\\CommandeDetail', 1, '{\"article_id\":\"2\",\"quantity\":\"5\",\"prix_unitaire\":\"1000\",\"montant_total\":5000,\"commande_id\":3,\"updated_at\":\"2020-08-29 18:21:21\",\"created_at\":\"2020-08-29 18:21:21\",\"id\":3}', '127.0.0.1', '2020-08-29 18:21:21', '2020-08-29 18:21:21'),
(136, 'created', 4, 'App\\CommandeDetail', 1, '{\"article_id\":\"6\",\"quantity\":\"10\",\"prix_unitaire\":\"200\",\"montant_total\":2000,\"commande_id\":3,\"updated_at\":\"2020-08-29 18:21:21\",\"created_at\":\"2020-08-29 18:21:21\",\"id\":4}', '127.0.0.1', '2020-08-29 18:21:21', '2020-08-29 18:21:21'),
(137, 'created', 12, 'App\\Facture', 1, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":4,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":4,\"reference\":\"Inv\\/Cons\\/Rdv\\/4\",\"user_id\":1,\"updated_at\":\"2021-02-23 23:43:03\",\"created_at\":\"2021-02-23 23:43:03\",\"id\":12}', '127.0.0.1', '2021-02-23 23:43:03', '2021-02-23 23:43:03'),
(138, 'created', 12, 'App\\PaiementDetail', 1, '{\"montant\":8000,\"facture_id\":12,\"updated_at\":\"2021-02-23 23:43:03\",\"created_at\":\"2021-02-23 23:43:03\",\"id\":12}', '127.0.0.1', '2021-02-23 23:43:03', '2021-02-23 23:43:03'),
(139, 'created', 16, 'App\\Consultation', 1, '{\"patient_id\":\"4\",\"appointment_id\":\"4\",\"motif\":\"Test consultation\",\"diagnostic\":\"Diag de test\",\"comment\":\"Comm de test\",\"medecin_id\":1,\"user_id\":1,\"updated_at\":\"2021-02-23 23:43:46\",\"created_at\":\"2021-02-23 23:43:46\",\"id\":16}', '127.0.0.1', '2021-02-23 23:43:46', '2021-02-23 23:43:46'),
(140, 'created', 13, 'App\\Facture', 1, '{\"montant\":8000,\"montant_encaisse\":8000,\"patient_id\":4,\"factureable_type\":\"App\\\\Appointment\",\"factureable_id\":5,\"reference\":\"Inv\\/Cons\\/Rdv\\/5\",\"user_id\":1,\"updated_at\":\"2021-02-23 23:44:54\",\"created_at\":\"2021-02-23 23:44:54\",\"id\":13}', '127.0.0.1', '2021-02-23 23:44:54', '2021-02-23 23:44:54'),
(141, 'created', 13, 'App\\PaiementDetail', 1, '{\"montant\":8000,\"facture_id\":13,\"updated_at\":\"2021-02-23 23:44:54\",\"created_at\":\"2021-02-23 23:44:54\",\"id\":13}', '127.0.0.1', '2021-02-23 23:44:54', '2021-02-23 23:44:54'),
(142, 'updated', 1, 'App\\Medecin', 1, '{\"id\":1,\"name\":\"Docteur NUMBER 1\",\"phone\":\"44444444\",\"phone_2\":null,\"email\":\"docteur@admin.com\",\"free_days\":\"7\",\"daily_consultation\":\"20\",\"daily_rdv\":\"20\",\"consultation_duration\":\"0\",\"created_at\":\"2020-08-06 18:06:46\",\"updated_at\":\"2021-08-12 23:59:04\",\"deleted_at\":null,\"grade_id\":\"1\",\"specialite_id\":\"1\",\"solde_soins\":15000}', '127.0.0.1', '2021-08-12 23:59:04', '2021-08-12 23:59:04'),
(143, 'created', 1, 'App\\OrdonnanceLivraison', 1, '{\"article_id\":\"6\",\"quantity\":\"1\",\"user_id\":1,\"ordonnance_id\":6,\"updated_at\":\"2021-09-30 01:30:14\",\"created_at\":\"2021-09-30 01:30:14\",\"id\":1}', '127.0.0.1', '2021-09-30 01:30:14', '2021-09-30 01:30:14'),
(145, 'created', 3, 'App\\OrdonnanceLivraison', 1, '{\"article_id\":\"5\",\"quantity\":\"2\",\"user_id\":1,\"ordonnance_id\":4,\"updated_at\":\"2021-09-30 01:41:42\",\"created_at\":\"2021-09-30 01:41:42\",\"id\":3}', '127.0.0.1', '2021-09-30 01:41:42', '2021-09-30 01:41:42'),
(146, 'deleted', 2, 'App\\CashRegister', 1, '{\"id\":2,\"name\":\"Caisse Laser\",\"solde\":\"200000.00\",\"created_at\":\"2020-08-06 18:29:14\",\"updated_at\":\"2021-10-27 11:50:55\",\"deleted_at\":\"2021-10-27 11:50:55\"}', '127.0.0.1', '2021-10-27 11:50:55', '2021-10-27 11:50:55'),
(147, 'updated', 1, 'App\\CashRegister', 1, '{\"id\":1,\"name\":\"Caisse principale\",\"solde\":\"0\",\"created_at\":\"2020-08-06 18:29:01\",\"updated_at\":\"2021-10-27 12:14:57\",\"deleted_at\":null}', '127.0.0.1', '2021-10-27 12:14:57', '2021-10-27 12:14:57'),
(148, 'updated', 2, 'App\\Medecin', 1, '{\"id\":2,\"name\":\"Docteur NUMBER 2\",\"phone\":\"88888888\",\"phone_2\":null,\"email\":null,\"free_days\":\"1\",\"daily_consultation\":\"0\",\"daily_rdv\":\"0\",\"consultation_duration\":\"0\",\"created_at\":\"2020-08-20 16:42:11\",\"updated_at\":\"2021-10-27 12:15:32\",\"deleted_at\":null,\"grade_id\":\"1\",\"specialite_id\":\"1\",\"solde_soins\":0}', '127.0.0.1', '2021-10-27 12:15:32', '2021-10-27 12:15:32');

-- --------------------------------------------------------

--
-- Structure de la table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cash_registers`
--

INSERT INTO `cash_registers` (`id`, `name`, `solde`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Caisse principale', '0.00', '2020-08-06 18:29:01', '2021-10-27 12:14:57', NULL),
(2, 'Caisse Laser', '200000.00', '2020-08-06 18:29:14', '2021-10-27 11:50:55', '2021-10-27 11:50:55');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ACM', '2020-06-24 01:09:16', '2020-06-24 01:09:16', NULL),
(2, 'AVE', '2020-06-24 01:09:22', '2020-06-24 23:34:01', NULL),
(3, 'BIOD', '2020-06-24 01:09:30', '2020-06-24 01:09:30', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `dt_charge` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `motif_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant_total` int(11) DEFAULT NULL,
  `montant_paye` int(10) NOT NULL DEFAULT 0,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `fournisseur_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `montant_total`, `montant_paye`, `reference`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `fournisseur_id`) VALUES
(1, 384, 0, 'Ref/06/08/2020/2049', '2020-08-06 20:49:25', '2020-08-06 20:49:25', NULL, 1, 1),
(2, 300000, 5000, 'Ref/15/01/2020/1203', '2020-08-11 17:17:15', '2020-08-11 17:17:15', NULL, 1, 1),
(3, 7000, 2000, 'Ba/Abou/464103630', '2020-08-29 18:21:21', '2020-08-29 18:21:21', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande_details`
--

CREATE TABLE `commande_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `montant_total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `commande_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_details`
--

INSERT INTO `commande_details` (`id`, `quantity`, `prix_unitaire`, `montant_total`, `created_at`, `updated_at`, `deleted_at`, `article_id`, `commande_id`) VALUES
(1, 12, 32, 384, '2020-08-06 20:49:25', '2020-08-06 20:49:25', NULL, 6, 1),
(2, 1500, 200, 300000, '2020-08-11 17:17:15', '2020-08-11 17:17:15', NULL, 6, 2),
(3, 5, 1000, 5000, '2020-08-29 18:21:21', '2020-08-29 18:21:21', NULL, 2, 3),
(4, 10, 200, 2000, '2020-08-29 18:21:21', '2020-08-29 18:21:21', NULL, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `commande_paiements`
--

CREATE TABLE `commande_paiements` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` int(10) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `fournisseur_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande_paiements`
--

INSERT INTO `commande_paiements` (`id`, `montant`, `user_id`, `fournisseur_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10000, 1, 1, '2020-08-12 14:56:10', '2020-08-12 14:56:10', NULL),
(2, 3500, 1, 1, '2020-08-12 15:34:35', '2020-08-12 15:34:35', NULL),
(3, 1000, 1, 1, '2020-08-12 15:37:10', '2020-08-12 15:53:59', '2020-08-12 15:53:59'),
(4, 500, 1, 1, '2020-08-12 15:37:28', '2020-08-12 15:53:50', '2020-08-12 15:53:50'),
(5, 500, 1, 1, '2020-08-15 01:20:33', '2020-08-15 01:20:33', NULL),
(6, 100, 1, 1, '2020-08-15 01:21:53', '2020-08-15 01:21:53', NULL),
(7, 100, 1, 1, '2020-08-15 01:22:22', '2020-08-15 01:22:22', NULL),
(8, 100, 1, 1, '2020-08-15 01:23:46', '2020-08-15 01:23:46', NULL),
(9, 100, 1, 1, '2020-08-15 01:24:17', '2020-08-15 01:24:17', NULL),
(10, 100, 1, 1, '2020-08-15 01:24:49', '2020-08-15 01:24:49', NULL),
(11, 100, 1, 1, '2020-08-15 01:26:10', '2020-08-15 01:26:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `rdv_id` int(10) UNSIGNED DEFAULT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `medecin_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT 1,
  `appointment_id` int(10) NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnostic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdm` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atcd` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `consultations`
--

INSERT INTO `consultations` (`id`, `comment`, `created_at`, `updated_at`, `deleted_at`, `rdv_id`, `patient_id`, `medecin_id`, `user_id`, `status_id`, `appointment_id`, `motif`, `diagnostic`, `hdm`, `atcd`) VALUES
(5, 'Commentaire de la first consultation', '2020-08-07 19:41:26', '2020-08-07 19:41:26', NULL, NULL, 1, 1, 1, 1, 1, 'Motif de la consultation', 'Diagnostique comment', NULL, NULL),
(6, NULL, '2020-08-08 16:59:13', '2020-08-08 16:59:13', NULL, NULL, 1, 1, 2, 1, 1, 'Test motif de la consultation', 'Test diagnostic', NULL, NULL),
(14, 'fsdfsdf', '2020-08-08 17:24:57', '2020-08-08 17:24:57', NULL, NULL, 1, 1, 2, 1, 1, 'fd fsdfsdf', 'dsfsdfsdf', NULL, NULL),
(15, 'bn,bn,b', '2020-08-08 17:52:16', '2020-08-08 17:52:16', NULL, NULL, 2, 1, 2, 1, 2, 'jkgjkh', ',nbn,b', NULL, NULL),
(16, 'Comm de test', '2021-02-23 23:43:46', '2021-02-23 23:43:46', NULL, NULL, 4, 1, 1, 1, 4, 'Test consultation', 'Diag de test', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `consultation_prices`
--

CREATE TABLE `consultation_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `tarif` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `medecin_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `consultation_prices`
--

INSERT INTO `consultation_prices` (`id`, `tarif`, `created_at`, `updated_at`, `deleted_at`, `type_id`, `medecin_id`, `user_id`) VALUES
(1, 8000, '2020-08-06 21:17:44', '2020-08-06 21:17:44', NULL, 1, 1, 1),
(2, 10000, '2020-08-06 21:19:28', '2020-08-06 21:19:28', NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `consultation_statuses`
--

CREATE TABLE `consultation_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `consultation_statuses`
--

INSERT INTO `consultation_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Effectuée', '2020-08-07 19:44:19', '2020-08-07 19:44:19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

CREATE TABLE `emplois` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Médecin', '2021-10-27 12:07:38', '2021-10-27 12:07:38', NULL),
(2, 'Secrétaire', '2021-10-27 12:07:46', '2021-10-27 12:07:46', NULL),
(3, 'Chauffeur', '2021-10-27 12:07:54', '2021-10-27 12:07:54', NULL),
(4, 'Gardien', '2021-10-27 12:08:01', '2021-10-27 12:08:01', NULL),
(5, 'Planton', '2021-10-27 12:08:09', '2021-10-27 12:08:09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` int(11) NOT NULL,
  `nni` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `recruitement_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `emploi_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `montant_encaisse` int(11) NOT NULL DEFAULT 0,
  `patient_id` int(10) NOT NULL,
  `factureable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factureable_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `montant`, `comment`, `reference`, `type_facture`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `status_id`, `montant_encaisse`, `patient_id`, `factureable_type`, `factureable_id`) VALUES
(2, 8000, NULL, 'Inv/Cons/Rdv/1', NULL, '2020-08-06 21:28:09', '2020-08-06 21:28:09', NULL, 1, 1, 8000, 1, 'App\\Appointment', 1),
(3, 8000, NULL, 'Inv/Cons/Rdv/1', NULL, '2020-08-07 17:45:52', '2020-08-07 17:45:52', NULL, 1, 1, 8000, 1, 'App\\Appointment', 1),
(4, 30000, NULL, 'Inv/Soin/Id/9', NULL, '2020-08-08 16:11:48', '2020-08-14 23:47:27', NULL, 3, 1, 10000, 2, 'App\\Soin', 9),
(5, 90000, NULL, 'Inv/Soin/Id/10', NULL, '2020-08-08 17:12:55', '2020-08-08 17:12:55', NULL, 2, 1, 0, 1, 'App\\Soin', 10),
(6, 8000, NULL, 'Inv/Cons/Rdv/2', NULL, '2021-01-09 17:25:32', '2020-08-08 17:25:32', NULL, 2, 1, 8000, 2, 'App\\Appointment', 2),
(7, 8000, NULL, 'Inv/Cons/Rdv/3', NULL, '2021-01-01 18:51:50', '2020-08-08 18:51:50', NULL, 3, 1, 8000, 3, 'App\\Appointment', 3),
(8, 30000, NULL, 'Inv/Soin/Id/11', NULL, '2021-01-09 18:59:26', '2020-08-14 23:47:27', NULL, 3, 1, 5000, 2, 'App\\Soin', 11),
(9, 2700, NULL, 'Inv/Vente/Id/2', NULL, '2021-01-04 20:53:31', '2020-08-14 23:47:27', NULL, 1, 1, 700, 2, 'App\\Sale', 2),
(10, 30000, NULL, 'Inv/Soin/Id/12', NULL, '2021-01-08 11:45:20', '2020-08-13 11:45:20', NULL, 1, 1, 0, 3, 'App\\Soin', 12),
(11, 30000, NULL, 'Inv/Soin/Id/13', NULL, '2021-01-10 23:13:25', '2020-08-14 23:43:46', NULL, 1, 1, 10000, 4, 'App\\Soin', 13),
(12, 8000, NULL, 'Inv/Cons/Rdv/4', NULL, '2021-09-02 23:43:03', '2021-02-23 23:43:03', NULL, 1, 1, 8000, 4, 'App\\Appointment', 4),
(13, 8000, NULL, 'Inv/Cons/Rdv/5', NULL, '2021-02-23 23:44:54', '2021-02-23 23:44:54', NULL, 1, 1, 8000, 4, 'App\\Appointment', 5);

-- --------------------------------------------------------

--
-- Structure de la table `facture_statuses`
--

CREATE TABLE `facture_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture_statuses`
--

INSERT INTO `facture_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Élaborée', '2020-08-06 19:19:25', '2020-08-06 19:19:25', NULL),
(2, 'Annulée', '2020-08-06 19:19:36', '2020-08-06 19:19:36', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `forme_medicaments`
--

CREATE TABLE `forme_medicaments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `forme_medicaments`
--

INSERT INTO `forme_medicaments` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comprimés', '2020-08-06 18:05:00', '2020-08-06 18:05:00', NULL),
(2, 'Gélules', '2020-08-06 18:05:08', '2020-08-06 18:05:08', NULL),
(3, 'crème', '2020-08-08 17:49:33', '2020-08-08 17:49:33', NULL),
(4, 'Pommade', '2020-08-08 17:49:48', '2020-08-08 17:49:48', NULL),
(5, 'fluid', '2020-08-08 17:50:06', '2020-08-08 17:50:06', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `name`, `phone`, `solde`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fournitures et services', 44350002, 5400, 1, '2020-08-09 19:18:10', '2020-08-29 18:21:21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Homme', '2020-08-06 18:23:27', '2020-08-06 18:23:27', NULL),
(2, 'Femme', '2020-08-06 18:23:35', '2020-08-06 18:23:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Docteur', 'Dr', '2020-08-06 18:01:47', '2020-08-06 18:01:47', NULL),
(2, 'Professeur', 'Pr', '2020-08-06 18:01:59', '2020-08-06 18:01:59', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `phone_2` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_days` int(11) NOT NULL,
  `daily_consultation` int(11) DEFAULT NULL,
  `daily_rdv` int(11) DEFAULT NULL,
  `consultation_duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `specialite_id` int(10) UNSIGNED NOT NULL,
  `solde_soins` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `name`, `phone`, `phone_2`, `email`, `free_days`, `daily_consultation`, `daily_rdv`, `consultation_duration`, `created_at`, `updated_at`, `deleted_at`, `grade_id`, `specialite_id`, `solde_soins`) VALUES
(1, 'Docteur NUMBER 1', 44444444, NULL, 'docteur@admin.com', 7, 20, 20, 0, '2020-08-06 18:06:46', '2021-08-12 23:59:04', NULL, 1, 1, 15000),
(2, 'Docteur NUMBER 2', 88888888, NULL, NULL, 1, 0, 0, 0, '2020-08-20 16:42:11', '2021-10-27 12:15:32', NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medecin_user`
--

CREATE TABLE `medecin_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `medecin_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medecin_user`
--

INSERT INTO `medecin_user` (`user_id`, `medecin_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2020_06_28_000001_create_media_table', 1),
(8, '2020_06_28_000002_create_audit_logs_table', 1),
(9, '2020_06_28_000003_create_paiements_table', 1),
(10, '2020_06_28_000004_create_ordonnances_table', 1),
(11, '2020_06_28_000005_create_consultations_table', 1),
(12, '2020_06_28_000006_create_consultation_statuses_table', 1),
(13, '2020_06_28_000007_create_factures_table', 1),
(14, '2020_06_28_000008_create_facture_statuses_table', 1),
(15, '2020_06_28_000009_create_paiement_statuses_table', 1),
(16, '2020_06_28_000010_create_ordonnance_details_table', 1),
(17, '2020_06_28_000011_create_rdv_statuses_table', 1),
(18, '2020_06_28_000012_create_commandes_table', 1),
(19, '2020_06_28_000013_create_commande_details_table', 1),
(20, '2020_06_28_000014_create_soins_table', 1),
(21, '2020_06_28_000015_create_analysis_table', 1),
(22, '2020_06_28_000016_create_analyse_details_table', 1),
(23, '2020_06_28_000017_create_cash_registers_table', 1),
(24, '2020_06_28_000018_create_operation_cashes_table', 1),
(25, '2020_06_28_000019_create_appointments_table', 1),
(26, '2020_06_28_000020_create_appointment_ canals_table', 1),
(27, '2020_06_28_000021_create_forme_medicaments_table', 1),
(28, '2020_06_28_000022_create_type_visites_table', 1),
(29, '2020_06_28_000023_create_genres_table', 1),
(30, '2020_06_28_000024_create_grades_table', 1),
(31, '2020_06_28_000025_create_medecins_table', 1),
(32, '2020_06_28_000026_create_users_table', 1),
(33, '2020_06_28_000027_create_categories_table', 1),
(34, '2020_06_28_000028_create_articles_table', 1),
(35, '2020_06_28_000029_create_specilaltes_table', 1),
(36, '2020_06_28_000030_create_roles_table', 1),
(37, '2020_06_28_000031_create_type_consultations_table', 1),
(38, '2020_06_28_000032_create_consultation_prices_table', 1),
(39, '2020_06_28_000033_create_permissions_table', 1),
(40, '2020_06_28_000034_create_patients_table', 1),
(41, '2020_06_28_000035_create_permission_role_pivot_table', 1),
(42, '2020_06_28_000036_create_medecin_user_pivot_table', 1),
(43, '2020_06_28_000037_create_role_user_pivot_table', 1),
(44, '2020_06_28_000038_add_relationship_fields_to_operation_cashes_table', 1),
(45, '2020_06_28_000039_add_relationship_fields_to_analysis_table', 1),
(46, '2020_06_28_000040_add_relationship_fields_to_soins_table', 1),
(47, '2020_06_28_000041_add_relationship_fields_to_analyse_details_table', 1),
(48, '2020_06_28_000042_add_relationship_fields_to_ordonnance_details_table', 1),
(49, '2020_06_28_000043_add_relationship_fields_to_commande_details_table', 1),
(50, '2020_06_28_000044_add_relationship_fields_to_commandes_table', 1),
(51, '2020_06_28_000045_add_relationship_fields_to_patients_table', 1),
(52, '2020_06_28_000046_add_relationship_fields_to_paiements_table', 1),
(53, '2020_06_28_000047_add_relationship_fields_to_medecins_table', 1),
(54, '2020_06_28_000048_add_relationship_fields_to_factures_table', 1),
(55, '2020_06_28_000049_add_relationship_fields_to_articles_table', 1),
(56, '2020_06_28_000050_add_relationship_fields_to_consultations_table', 1),
(57, '2020_06_28_000051_add_relationship_fields_to_ordonnances_table', 1),
(58, '2020_06_28_000052_add_relationship_fields_to_consultation_prices_table', 1),
(59, '2020_06_28_000053_add_relationship_fields_to_appointments_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `motif_charges`
--

CREATE TABLE `motif_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `motif_charges`
--

INSERT INTO `motif_charges` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Paiement de salaire', '2021-10-27 12:11:40', '2021-10-27 12:11:40', NULL),
(2, 'Fonctionnement', '2021-10-27 12:12:04', '2021-10-27 12:12:04', NULL),
(3, 'Divers', '2021-10-27 12:12:11', '2021-10-27 12:12:11', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `medecin_id` int(10) UNSIGNED DEFAULT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `objet`, `content`, `created_at`, `updated_at`, `deleted_at`, `medecin_id`, `patient_id`) VALUES
(1, 'Note de test', '<p>Bonjour,</p>\r\n\r\n<p>Mahi <strong>Ahmedou </strong>Saghir</p>', '2020-08-14 13:08:29', '2020-08-14 13:08:29', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operation_cashes`
--

CREATE TABLE `operation_cashes` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `caisse_id` int(10) UNSIGNED NOT NULL,
  `medecin_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `operation_cashes`
--

INSERT INTO `operation_cashes` (`id`, `montant`, `created_at`, `updated_at`, `deleted_at`, `caisse_id`, `medecin_id`, `user_id`) VALUES
(1, '8000.00', '2020-08-07 18:39:47', '2020-08-07 19:26:05', '2020-08-07 19:26:05', 2, 1, 1),
(2, '5000.00', '2020-08-07 19:29:54', '2020-08-07 19:29:54', NULL, 1, 1, 1),
(3, '45000.00', '2020-08-14 23:53:05', '2020-08-14 23:53:05', NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ordonnances`
--

CREATE TABLE `ordonnances` (
  `id` int(10) UNSIGNED NOT NULL,
  `ordonnance_comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `medecin_id` int(10) UNSIGNED DEFAULT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `consultation_id` int(10) UNSIGNED DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordonnances`
--

INSERT INTO `ordonnances` (`id`, `ordonnance_comment`, `created_at`, `updated_at`, `deleted_at`, `medecin_id`, `patient_id`, `consultation_id`, `reference`) VALUES
(2, NULL, '2020-08-07 19:41:26', '2020-08-07 19:41:26', NULL, 1, 1, 5, 'Ord/Cons/5/Medecin/1'),
(3, NULL, '2020-08-08 14:15:22', '2020-08-08 14:15:56', '2020-08-08 14:15:56', NULL, NULL, NULL, NULL),
(4, 'Comment in EDIT', '2020-08-08 14:16:19', '2020-08-08 15:28:24', NULL, 1, 2, NULL, 'Ord/Lib/2/Medecin/1'),
(5, NULL, '2020-08-08 16:59:13', '2020-08-08 16:59:13', NULL, 1, 1, 6, 'Ord/Cons/6/Medecin/1'),
(6, NULL, '2020-08-08 17:52:16', '2020-08-08 17:52:16', NULL, 1, 2, 15, 'Ord/Cons/15/Medecin/1');

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance_details`
--

CREATE TABLE `ordonnance_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `medicament` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posologie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ordonnance_id` int(10) UNSIGNED NOT NULL,
  `forme_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordonnance_details`
--

INSERT INTO `ordonnance_details` (`id`, `medicament`, `posologie`, `quantity`, `duration`, `created_at`, `updated_at`, `deleted_at`, `ordonnance_id`, `forme_id`) VALUES
(2, 'First medicament', '20 mg', 3, 10, '2020-08-07 19:41:26', '2020-08-07 19:41:26', NULL, 2, 1),
(3, 'First medicament', '5 messages', 1, 25, '2020-08-08 14:15:22', '2020-08-08 14:15:22', NULL, 2, 2),
(4, 'Seconde Medica', '5 messages', 5, 5, '2020-08-08 14:16:19', '2020-08-08 15:28:24', NULL, 4, 2),
(7, 'New in modification', '20 mg', 2, 10, '2020-08-08 15:28:24', '2020-08-08 15:29:22', '2020-08-08 15:29:22', 4, 1),
(8, 'First medicament', '5', 2, 5, '2020-08-08 16:59:13', '2020-08-08 16:59:13', NULL, 5, 1),
(9, 'Anthelios spf 50+', 'une application avant exposition solaire', 1, 25, '2020-08-08 17:52:16', '2020-08-08 17:52:16', NULL, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance_livraisons`
--

CREATE TABLE `ordonnance_livraisons` (
  `id` int(10) UNSIGNED NOT NULL,
  `ordonnance_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordonnance_livraisons`
--

INSERT INTO `ordonnance_livraisons` (`id`, `ordonnance_id`, `article_id`, `quantity`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 6, 1, 1, '2021-09-30 01:30:14', '2021-09-30 01:30:14', NULL),
(3, 4, 5, 2, 1, '2021-09-30 01:41:42', '2021-09-30 01:41:42', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `facture_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `reference`, `montant`, `created_at`, `updated_at`, `deleted_at`, `facture_id`, `user_id`, `comment`) VALUES
(1, NULL, 1000, '2020-08-14 23:39:04', '2020-08-14 23:39:04', NULL, NULL, 1, NULL),
(2, 'Paiement/4/20200814234346', 9000, '2020-08-14 23:43:46', '2020-08-14 23:43:46', NULL, NULL, 1, NULL),
(4, 'Paiement/2/20200814234727', 15700, '2020-08-14 23:47:27', '2020-08-14 23:47:27', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_details`
--

CREATE TABLE `paiement_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `facture_id` int(10) UNSIGNED DEFAULT NULL,
  `paiement_id` int(10) UNSIGNED DEFAULT NULL,
  `caisse_id` int(10) NOT NULL DEFAULT 1,
  `status_id` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement_details`
--

INSERT INTO `paiement_details` (`id`, `montant`, `created_at`, `updated_at`, `deleted_at`, `facture_id`, `paiement_id`, `caisse_id`, `status_id`) VALUES
(1, 8000, '2020-08-06 21:28:09', '2020-08-06 21:28:09', NULL, 2, NULL, 1, 1),
(2, 8000, '2020-08-07 17:45:52', '2020-08-07 17:45:52', NULL, 3, NULL, 1, 1),
(3, 8000, '2020-08-08 17:25:32', '2020-08-08 17:25:32', NULL, 6, NULL, 1, 1),
(4, 8000, '2020-08-08 18:51:50', '2020-08-08 18:51:50', NULL, 7, NULL, 1, 1),
(5, 1000, '2020-08-14 23:39:04', '2020-08-14 23:39:04', NULL, 11, 1, 2, 1),
(6, 9000, '2020-08-14 23:43:46', '2020-08-14 23:43:46', NULL, 11, 2, 2, 1),
(9, 10000, '2020-08-14 23:47:27', '2020-08-14 23:47:27', NULL, 4, 4, 2, 1),
(10, 5000, '2020-08-14 23:47:27', '2020-08-14 23:47:27', NULL, 8, 4, 2, 1),
(11, 700, '2020-08-14 23:47:27', '2020-08-14 23:47:27', NULL, 9, 4, 1, 1),
(12, 8000, '2021-02-23 23:43:03', '2021-02-23 23:43:03', NULL, 12, NULL, 1, 1),
(13, 8000, '2021-02-23 23:44:54', '2021-02-23 23:44:54', NULL, 13, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_statuses`
--

CREATE TABLE `paiement_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement_statuses`
--

INSERT INTO `paiement_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Encaissé', '2020-08-06 19:19:56', '2020-08-08 02:59:47', NULL),
(2, 'Annulé', '2020-08-06 19:20:05', '2020-08-06 19:20:05', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `phone_2` int(11) DEFAULT NULL,
  `birth_day` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL,
  `ca` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `albinos` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `name`, `phone`, `phone_2`, `birth_day`, `email`, `poids`, `solde`, `ca`, `created_at`, `updated_at`, `deleted_at`, `genre_id`, `albinos`) VALUES
(1, 'Mohamed Mahmoud Ahmedou Saghir', 44350002, 48080808, '1980-01-25', 'mahi.ahmedou@gmail.com', 0, 90000, NULL, '2020-08-06 20:50:22', '2020-08-08 17:12:55', NULL, 1, 0),
(2, 'Mariem ISMAIL', 46464646, NULL, '1990-08-08', NULL, 0, 47000, NULL, '2020-08-08 13:02:59', '2020-08-14 23:47:27', NULL, 2, 0),
(3, 'mina', 22301909, NULL, '2011-03-31', NULL, 0, 30000, NULL, '2020-08-08 18:36:33', '2020-08-13 11:45:20', NULL, 2, 1),
(4, 'Aziza', NULL, NULL, '1990-08-08', NULL, 0, 20000, NULL, '2020-08-08 18:47:41', '2021-02-23 23:44:54', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'specilalte_create', NULL, NULL, NULL),
(18, 'specilalte_edit', NULL, NULL, NULL),
(19, 'specilalte_show', NULL, NULL, NULL),
(20, 'specilalte_delete', NULL, NULL, NULL),
(21, 'specilalte_access', NULL, NULL, NULL),
(22, 'administration_access', NULL, NULL, NULL),
(23, 'grade_create', NULL, NULL, NULL),
(24, 'grade_edit', NULL, NULL, NULL),
(25, 'grade_show', NULL, NULL, NULL),
(26, 'grade_delete', NULL, NULL, NULL),
(27, 'grade_access', NULL, NULL, NULL),
(28, 'medecin_create', NULL, NULL, NULL),
(29, 'medecin_edit', NULL, NULL, NULL),
(30, 'medecin_show', NULL, NULL, NULL),
(31, 'medecin_delete', NULL, NULL, NULL),
(32, 'medecin_access', NULL, NULL, NULL),
(33, 'produit_access', NULL, NULL, NULL),
(34, 'category_create', NULL, NULL, NULL),
(35, 'category_edit', NULL, NULL, NULL),
(36, 'category_show', NULL, NULL, NULL),
(37, 'category_delete', NULL, NULL, NULL),
(38, 'category_access', NULL, NULL, NULL),
(39, 'article_create', NULL, NULL, NULL),
(40, 'article_edit', NULL, NULL, NULL),
(41, 'article_show', NULL, NULL, NULL),
(42, 'article_delete', NULL, NULL, NULL),
(43, 'article_access', NULL, NULL, NULL),
(44, 'genre_create', NULL, NULL, NULL),
(45, 'genre_edit', NULL, NULL, NULL),
(46, 'genre_show', NULL, NULL, NULL),
(47, 'genre_delete', NULL, NULL, NULL),
(48, 'genre_access', NULL, NULL, NULL),
(49, 'type_consultation_create', NULL, NULL, NULL),
(50, 'type_consultation_edit', NULL, NULL, NULL),
(51, 'type_consultation_show', NULL, NULL, NULL),
(52, 'type_consultation_delete', NULL, NULL, NULL),
(53, 'type_consultation_access', NULL, NULL, NULL),
(54, 'consultation_price_create', NULL, NULL, NULL),
(55, 'consultation_price_edit', NULL, NULL, NULL),
(56, 'consultation_price_show', NULL, NULL, NULL),
(57, 'consultation_price_delete', NULL, NULL, NULL),
(58, 'consultation_price_access', NULL, NULL, NULL),
(59, 'patient_create', NULL, NULL, NULL),
(60, 'patient_edit', NULL, NULL, NULL),
(61, 'patient_show', NULL, NULL, NULL),
(62, 'patient_delete', NULL, NULL, NULL),
(63, 'patient_access', NULL, NULL, NULL),
(64, 'type_visite_create', NULL, NULL, NULL),
(65, 'type_visite_edit', NULL, NULL, NULL),
(66, 'type_visite_show', NULL, NULL, NULL),
(67, 'type_visite_delete', NULL, NULL, NULL),
(68, 'type_visite_access', NULL, NULL, NULL),
(69, 'rdv_status_create', NULL, NULL, NULL),
(70, 'rdv_status_edit', NULL, NULL, NULL),
(71, 'rdv_status_show', NULL, NULL, NULL),
(72, 'rdv_status_delete', NULL, NULL, NULL),
(73, 'rdv_status_access', NULL, NULL, NULL),
(74, 'appointment_canal_create', NULL, '2020-08-06 18:26:17', NULL),
(75, 'appointment_canal_edit', NULL, '2020-08-06 18:26:02', NULL),
(76, 'appointment_canal_show', NULL, '2020-08-06 18:25:48', NULL),
(77, 'appointment_canal_delete', NULL, '2020-08-06 18:25:33', NULL),
(78, 'appointment_canal_access', NULL, '2020-08-06 18:25:17', NULL),
(79, 'audit_log_show', NULL, NULL, NULL),
(80, 'audit_log_access', NULL, NULL, NULL),
(81, 'ordonnance_create', NULL, NULL, NULL),
(82, 'ordonnance_edit', NULL, NULL, NULL),
(83, 'ordonnance_show', NULL, NULL, NULL),
(84, 'ordonnance_delete', NULL, NULL, NULL),
(85, 'ordonnance_access', NULL, NULL, NULL),
(86, 'forme_medicament_create', NULL, NULL, NULL),
(87, 'forme_medicament_edit', NULL, NULL, NULL),
(88, 'forme_medicament_show', NULL, NULL, NULL),
(89, 'forme_medicament_delete', NULL, NULL, NULL),
(90, 'forme_medicament_access', NULL, NULL, NULL),
(91, 'consultation_create', NULL, NULL, NULL),
(92, 'consultation_edit', NULL, NULL, NULL),
(93, 'consultation_show', NULL, NULL, NULL),
(94, 'consultation_delete', NULL, NULL, NULL),
(95, 'consultation_access', NULL, NULL, NULL),
(96, 'consultation_status_create', NULL, NULL, NULL),
(97, 'consultation_status_edit', NULL, NULL, NULL),
(98, 'consultation_status_show', NULL, NULL, NULL),
(99, 'consultation_status_delete', NULL, NULL, NULL),
(100, 'consultation_status_access', NULL, NULL, NULL),
(101, 'facture_create', NULL, NULL, NULL),
(102, 'facture_edit', NULL, NULL, NULL),
(103, 'facture_show', NULL, NULL, NULL),
(104, 'facture_delete', NULL, NULL, NULL),
(105, 'facture_access', NULL, NULL, NULL),
(106, 'facture_status_create', NULL, NULL, NULL),
(107, 'facture_status_edit', NULL, NULL, NULL),
(108, 'facture_status_show', NULL, NULL, NULL),
(109, 'facture_status_delete', NULL, NULL, NULL),
(110, 'facture_status_access', NULL, NULL, NULL),
(111, 'paiement_status_create', NULL, NULL, NULL),
(112, 'paiement_status_edit', NULL, NULL, NULL),
(113, 'paiement_status_show', NULL, NULL, NULL),
(114, 'paiement_status_delete', NULL, NULL, NULL),
(115, 'paiement_status_access', NULL, NULL, NULL),
(116, 'paiement_create', NULL, NULL, NULL),
(117, 'paiement_edit', NULL, NULL, NULL),
(118, 'paiement_show', NULL, NULL, NULL),
(119, 'paiement_delete', NULL, NULL, NULL),
(120, 'paiement_access', NULL, NULL, NULL),
(121, 'ordonnance_detail_create', NULL, NULL, NULL),
(122, 'ordonnance_detail_edit', NULL, NULL, NULL),
(123, 'ordonnance_detail_show', NULL, NULL, NULL),
(124, 'ordonnance_detail_delete', NULL, NULL, NULL),
(125, 'ordonnance_detail_access', NULL, NULL, NULL),
(126, 'commande_create', NULL, NULL, NULL),
(127, 'commande_edit', NULL, NULL, NULL),
(128, 'commande_show', NULL, NULL, NULL),
(129, 'commande_delete', NULL, NULL, NULL),
(130, 'commande_access', NULL, NULL, NULL),
(131, 'commande_detail_access', NULL, NULL, NULL),
(132, 'soin_create', NULL, NULL, NULL),
(133, 'soin_edit', NULL, NULL, NULL),
(134, 'soin_show', NULL, NULL, NULL),
(135, 'soin_delete', NULL, NULL, NULL),
(136, 'soin_access', NULL, NULL, NULL),
(137, 'analysi_create', NULL, NULL, NULL),
(138, 'analysi_edit', NULL, NULL, NULL),
(139, 'analysi_show', NULL, NULL, NULL),
(140, 'analysi_delete', NULL, NULL, NULL),
(141, 'analysi_access', NULL, NULL, NULL),
(142, 'referenciel_access', NULL, '2020-08-06 18:23:06', NULL),
(143, 'analyse_detail_access', NULL, NULL, NULL),
(144, 'cash_register_create', NULL, NULL, NULL),
(145, 'cash_register_edit', NULL, NULL, NULL),
(146, 'cash_register_show', NULL, NULL, NULL),
(147, 'cash_register_delete', NULL, NULL, NULL),
(148, 'cash_register_access', NULL, NULL, NULL),
(149, 'operation_cash_create', NULL, NULL, NULL),
(150, 'operation_cash_edit', NULL, NULL, NULL),
(151, 'operation_cash_show', NULL, NULL, NULL),
(152, 'operation_cash_delete', NULL, NULL, NULL),
(153, 'operation_cash_access', NULL, NULL, NULL),
(154, 'appointment_create', NULL, NULL, NULL),
(155, 'appointment_edit', NULL, NULL, NULL),
(156, 'appointment_show', NULL, NULL, NULL),
(157, 'appointment_delete', NULL, NULL, NULL),
(158, 'appointment_access', NULL, NULL, NULL),
(159, 'profile_password_edit', NULL, NULL, NULL),
(160, 'type_soin_access', '2020-08-06 19:23:02', '2020-08-06 19:31:46', '2020-08-06 19:31:46'),
(161, 'type_soin_create', '2020-08-06 19:23:12', '2020-08-06 19:23:12', NULL),
(162, 'type_soin_delete', '2020-08-06 19:23:22', '2020-08-06 19:23:22', NULL),
(163, 'type_soin_edit', '2020-08-06 19:23:28', '2020-08-06 19:23:28', NULL),
(164, 'type_soin_show', '2020-08-06 19:23:36', '2020-08-06 19:23:36', NULL),
(165, 'type_soin_access', '2020-08-06 19:31:33', '2020-08-06 19:31:33', NULL),
(166, 'fournisseur_access', '2020-08-09 19:14:14', '2020-08-09 19:14:14', NULL),
(167, 'fournisseur_create', '2020-08-09 19:14:22', '2020-08-09 19:14:22', NULL),
(168, 'fournisseur_delete', '2020-08-09 19:14:31', '2020-08-09 19:14:31', NULL),
(169, 'fournisseur_edit', '2020-08-09 19:14:39', '2020-08-09 19:14:39', NULL),
(170, 'fournisseur_show', '2020-08-09 19:14:45', '2020-08-09 19:14:45', NULL),
(171, 'sale_access', '2020-08-09 19:21:53', '2020-08-09 19:21:53', NULL),
(172, 'sale_create', '2020-08-09 19:22:00', '2020-08-09 19:22:00', NULL),
(173, 'sale_delete', '2020-08-09 19:22:07', '2020-08-09 19:22:07', NULL),
(174, 'sale_destroy', '2020-08-09 19:22:13', '2020-08-09 19:22:13', NULL),
(175, 'sale_edit', '2020-08-09 19:22:20', '2020-08-09 19:22:20', NULL),
(176, 'sale_show', '2020-08-09 19:22:26', '2020-08-09 19:22:26', NULL),
(177, 'commande_paiement_delete', '2020-08-12 15:47:02', '2020-08-12 15:47:02', NULL),
(178, 'commande_paiement_access', '2020-08-12 15:47:12', '2020-08-12 15:47:12', NULL),
(179, 'note_access', '2020-08-13 14:15:44', '2020-08-13 14:15:44', NULL),
(180, 'note_show', '2020-08-13 14:15:51', '2020-08-13 14:15:51', NULL),
(181, 'note_create', '2020-08-13 14:15:58', '2020-08-13 14:15:58', NULL),
(182, 'note_edit', '2020-08-13 14:16:05', '2020-08-13 14:16:05', NULL),
(183, 'note_delete', '2020-08-13 14:16:11', '2020-08-13 14:16:11', NULL),
(184, 'ordonnance_livraison', '2021-09-30 00:46:16', '2021-09-30 00:46:16', NULL),
(185, 'employee_access', '2021-09-30 02:28:02', '2021-09-30 02:28:02', NULL),
(186, 'employee_create', '2021-09-30 02:28:11', '2021-09-30 02:28:11', NULL),
(187, 'employee_show', '2021-09-30 02:28:25', '2021-09-30 02:28:25', NULL),
(188, 'employee_edit', '2021-09-30 02:28:33', '2021-09-30 02:28:33', NULL),
(189, 'employee_delete', '2021-09-30 02:28:42', '2021-09-30 02:28:42', NULL),
(190, 'emploi_create', NULL, NULL, NULL),
(191, 'emploi_edit', NULL, NULL, NULL),
(192, 'emploi_show', NULL, NULL, NULL),
(193, 'emploi_delete', NULL, NULL, NULL),
(194, 'emploi_access', NULL, NULL, NULL),
(195, 'charge_create', NULL, NULL, NULL),
(196, 'charge_edit', NULL, NULL, NULL),
(197, 'charge_show', NULL, NULL, NULL),
(198, 'charge_delete', NULL, NULL, NULL),
(199, 'charge_access', NULL, NULL, NULL),
(200, 'motif_charge_create', NULL, NULL, NULL),
(201, 'motif_charge_edit', NULL, NULL, NULL),
(202, 'motif_charge_show', NULL, NULL, NULL),
(203, 'motif_charge_delete', NULL, NULL, NULL),
(204, 'motif_charge_access', NULL, NULL, NULL),
(205, 'grh_access', '2021-10-27 12:07:10', '2021-10-27 12:07:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(2, 33),
(2, 43),
(2, 59),
(2, 61),
(2, 63),
(2, 126),
(2, 128),
(2, 130),
(2, 132),
(2, 134),
(2, 136),
(2, 154),
(2, 156),
(2, 158),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(2, 171),
(2, 172),
(2, 176),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 194),
(1, 195),
(1, 196),
(1, 197),
(1, 198),
(1, 199),
(1, 200),
(1, 201),
(1, 202),
(1, 203),
(1, 204),
(1, 205);

-- --------------------------------------------------------

--
-- Structure de la table `rdv_statuses`
--

CREATE TABLE `rdv_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rdv_statuses`
--

INSERT INTO `rdv_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Réservation', '2020-06-24 02:22:13', '2020-06-24 02:22:13', NULL),
(2, 'Confirmé', '2020-06-24 02:22:24', '2020-06-24 02:22:24', NULL),
(3, 'Clôturé', '2020-06-24 02:22:32', '2020-06-26 23:20:34', NULL),
(4, 'Annulé', '2020-06-24 02:22:40', '2020-06-26 23:20:45', NULL),
(5, 'Abandonné', '2020-06-26 23:20:54', '2020-06-26 23:20:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'Secrétariat', NULL, '2020-08-08 18:45:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `montant`, `patient_id`, `reference`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(2, 2700, 2, 'Vente/Articles/2/20200809205331', '2020-08-09 20:53:31', '2020-08-09 20:53:31', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `montant_total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sale_details`
--

INSERT INTO `sale_details` (`id`, `quantity`, `prix_unitaire`, `montant_total`, `created_at`, `updated_at`, `deleted_at`, `article_id`, `sale_id`) VALUES
(3, 2, 150, 300, '2020-08-09 20:53:31', '2020-08-09 20:53:31', NULL, 3, 2),
(4, 6, 400, 900, '2020-08-09 20:53:31', '2020-08-09 20:53:31', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `soins`
--

CREATE TABLE `soins` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `medecin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `soins`
--

INSERT INTO `soins` (`id`, `montant`, `patient_id`, `reference`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `medecin_id`) VALUES
(1, 0, 2, NULL, '2020-07-04 03:52:47', '2020-07-04 03:52:47', NULL, 1, 1),
(6, 30000, 2, NULL, '2020-07-04 04:05:29', '2020-07-04 04:05:29', NULL, 1, 1),
(9, 30000, 2, NULL, '2020-08-08 16:11:48', '2020-08-08 16:11:48', NULL, 1, 1),
(10, 90000, 1, 'Soin/1/20200808171255', '2020-08-08 17:12:55', '2020-08-08 17:12:55', NULL, 2, 1),
(11, 30000, 2, 'Soin/2/20200808185926', '2020-08-08 18:59:26', '2020-08-08 18:59:26', NULL, 3, 1),
(12, 30000, 3, 'Soin/3/20200813114520', '2020-08-13 11:45:20', '2020-08-13 11:45:20', NULL, 1, 1),
(13, 30000, 4, 'Soin/4/20200814231325', '2020-08-14 23:13:25', '2020-08-14 23:13:25', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `soin_details`
--

CREATE TABLE `soin_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `soin_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `soin_details`
--

INSERT INTO `soin_details` (`id`, `quantity`, `prix_unitaire`, `montant`, `created_at`, `updated_at`, `deleted_at`, `type_id`, `soin_id`) VALUES
(3, 1, 30000, 30000, '2020-08-08 16:11:48', '2020-08-08 16:11:48', NULL, 1, 9),
(4, 2, 30000, 60000, '2020-08-08 17:12:55', '2020-08-08 17:12:55', NULL, 1, 10),
(5, 1, 30000, 30000, '2020-08-08 17:12:55', '2020-08-08 17:12:55', NULL, 1, 10),
(6, 1, 30000, 30000, '2020-08-08 18:59:26', '2020-08-08 18:59:26', NULL, 1, 11),
(7, 1, 30000, 30000, '2020-08-13 11:45:20', '2020-08-13 11:45:20', NULL, 1, 12),
(8, 1, 30000, 30000, '2020-08-14 23:13:25', '2020-08-14 23:13:25', NULL, 1, 13);

-- --------------------------------------------------------

--
-- Structure de la table `specilaltes`
--

CREATE TABLE `specilaltes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specilaltes`
--

INSERT INTO `specilaltes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dermatologue', '2020-08-06 18:04:44', '2020-08-06 18:04:44', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_consultations`
--

CREATE TABLE `type_consultations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_consultations`
--

INSERT INTO `type_consultations` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ordinaire', '2020-08-06 18:28:08', '2020-08-06 18:28:08', NULL),
(2, 'Urgence', '2020-08-06 18:28:16', '2020-08-06 18:28:16', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_soins`
--

CREATE TABLE `type_soins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `caisse_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_soins`
--

INSERT INTO `type_soins` (`id`, `name`, `prix`, `created_at`, `updated_at`, `deleted_at`, `caisse_id`) VALUES
(1, 'Laser', '30000.00', '2020-07-04 02:09:34', '2020-07-04 02:18:56', NULL, 2),
(2, 'New Soin', '25000.00', '2021-02-23 23:53:28', '2021-02-23 23:53:28', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_visites`
--

CREATE TABLE `type_visites` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_visites`
--

INSERT INTO `type_visites` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Consultation', '2020-08-06 20:51:40', '2020-08-06 20:51:40', NULL),
(2, 'Rendez-Vous', '2020-08-06 20:52:15', '2020-08-06 20:52:15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_doctor` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `login`, `is_doctor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$B7VSOYHlcN5rbAVoDBZaueRwQQrIIu6l5NWh0.b/RKtTqIdIzlv5C', NULL, 'admin', 1, NULL, '2020-08-07 19:35:49', NULL),
(2, 'Salma YAHYA', 'salma@salma.com', NULL, '$2y$10$5A/mFsv1jULQ.DmraibHnuhc42KZ6P3oT2ow86LjQm0DwqGqNHa46', NULL, 'salma', 1, '2020-08-08 16:38:38', '2020-08-08 16:38:38', NULL),
(3, 'Mariem SECRETAIRE', 'mariem@mariem.com', NULL, '$2y$10$xM40cUmiQAKyBRPqec754uFnTUobQo5dWNwSiYkGIGARggJk1nimC', NULL, 'mariem', 0, '2020-08-08 16:40:36', '2020-08-08 16:40:36', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `analyse_details`
--
ALTER TABLE `analyse_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analyse_fk_1739900` (`analyse_id`);

--
-- Index pour la table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `analysis_reference_unique` (`reference`),
  ADD KEY `medecin_fk_1739805` (`medecin_id`),
  ADD KEY `patient_fk_1739806` (`patient_id`),
  ADD KEY `consultation_fk_1739809` (`consultation_id`);

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_fk_1740157` (`patient_id`),
  ADD KEY `medecin_fk_1740158` (`medecin_id`),
  ADD KEY `visite_fk_1740160` (`visite_id`),
  ADD KEY `consultation_fk_1740161` (`consultation_id`),
  ADD KEY `status_fk_1740163` (`status_id`),
  ADD KEY `user_fk_1740165` (`user_id`);

--
-- Index pour la table `appointment_canals`
--
ALTER TABLE `appointment_canals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_prises_name_unique` (`name`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_fk_1685666` (`category_id`),
  ADD KEY `user_fk_1685990` (`user_id`);

--
-- Index pour la table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cash_registers_name_unique` (`name`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Index pour la table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motif_fk_5209000` (`motif_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_1739438` (`user_id`);

--
-- Index pour la table `commande_details`
--
ALTER TABLE `commande_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_fk_1739329` (`article_id`),
  ADD KEY `commande_fk_1739333` (`commande_id`);

--
-- Index pour la table `commande_paiements`
--
ALTER TABLE `commande_paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_1939438` (`user_id`),
  ADD KEY `fournisseur_fk_2939438` (`user_id`);

--
-- Index pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rdv_fk_1694543` (`rdv_id`),
  ADD KEY `patient_fk_1694544` (`patient_id`),
  ADD KEY `medecin_fk_1694545` (`medecin_id`),
  ADD KEY `user_fk_1694551` (`user_id`),
  ADD KEY `status_fk_1694578` (`status_id`);

--
-- Index pour la table `consultation_prices`
--
ALTER TABLE `consultation_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_fk_1685772` (`type_id`),
  ADD KEY `medecin_fk_1685773` (`medecin_id`),
  ADD KEY `user_fk_1707397` (`user_id`);

--
-- Index pour la table `consultation_statuses`
--
ALTER TABLE `consultation_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consultation_statuses_name_unique` (`name`);

--
-- Index pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emplois_name_unique` (`name`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_matricule_unique` (`matricule`),
  ADD UNIQUE KEY `employees_nni_unique` (`nni`),
  ADD KEY `emploi_fk_5208987` (`emploi_id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_1694582` (`user_id`),
  ADD KEY `status_fk_1694591` (`status_id`);

--
-- Index pour la table `facture_statuses`
--
ALTER TABLE `facture_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facture_statuses_name_unique` (`name`);

--
-- Index pour la table `forme_medicaments`
--
ALTER TABLE `forme_medicaments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forme_medicaments_name_unique` (`name`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_name_unique` (`name`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grades_name_unique` (`name`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_fk_1685650` (`grade_id`),
  ADD KEY `specialite_fk_1685651` (`specialite_id`);

--
-- Index pour la table `medecin_user`
--
ALTER TABLE `medecin_user`
  ADD KEY `user_id_fk_1686168` (`user_id`),
  ADD KEY `medecin_id_fk_1686168` (`medecin_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `motif_charges`
--
ALTER TABLE `motif_charges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `motif_charges_name_unique` (`name`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_fk_4739805` (`medecin_id`),
  ADD KEY `patient_fk_4739806` (`patient_id`);

--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation_cashes`
--
ALTER TABLE `operation_cashes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caisse_fk_1740086` (`caisse_id`),
  ADD KEY `medecin_fk_1740087` (`medecin_id`),
  ADD KEY `user_fk_1740089` (`user_id`);

--
-- Index pour la table `ordonnances`
--
ALTER TABLE `ordonnances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_fk_1686191` (`medecin_id`),
  ADD KEY `patient_fk_1686192` (`patient_id`),
  ADD KEY `consultation_fk_1739746` (`consultation_id`);

--
-- Index pour la table `ordonnance_details`
--
ALTER TABLE `ordonnance_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordonnance_fk_1728110` (`ordonnance_id`),
  ADD KEY `forme_fk_1728141` (`forme_id`);

--
-- Index pour la table `ordonnance_livraisons`
--
ALTER TABLE `ordonnance_livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_article_fk_1728141` (`article_id`),
  ADD KEY `livraison_ordonnance_fk_1728110` (`ordonnance_id`),
  ADD KEY `user_fk_172814123` (`user_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facture_fk_1707389` (`facture_id`),
  ADD KEY `user_fk_1707396` (`user_id`);

--
-- Index pour la table `paiement_details`
--
ALTER TABLE `paiement_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facture_fk_1757389` (`facture_id`),
  ADD KEY `paiement_fk_1707396` (`paiement_id`);

--
-- Index pour la table `paiement_statuses`
--
ALTER TABLE `paiement_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paiement_statuses_name_unique` (`name`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_fk_1685792` (`genre_id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_1685551` (`role_id`),
  ADD KEY `permission_id_fk_1685551` (`permission_id`);

--
-- Index pour la table `rdv_statuses`
--
ALTER TABLE `rdv_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rdv_statuses_name_unique` (`name`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_1685560` (`user_id`),
  ADD KEY `role_id_fk_1685560` (`role_id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_1939438` (`user_id`),
  ADD KEY `patient_fk_1939438` (`patient_id`);

--
-- Index pour la table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_fk_1939329` (`article_id`),
  ADD KEY `sale_fk_1939333` (`sale_id`);

--
-- Index pour la table `soins`
--
ALTER TABLE `soins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_1989438` (`user_id`),
  ADD KEY `patient_fk_1989438` (`patient_id`);

--
-- Index pour la table `soin_details`
--
ALTER TABLE `soin_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_fk_1989329` (`type_id`),
  ADD KEY `soin_fk_1989333` (`soin_id`);

--
-- Index pour la table `specilaltes`
--
ALTER TABLE `specilaltes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specilaltes_name_unique` (`name`);

--
-- Index pour la table `type_consultations`
--
ALTER TABLE `type_consultations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_consultations_name_unique` (`name`);

--
-- Index pour la table `type_soins`
--
ALTER TABLE `type_soins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_soins_name_unique` (`name`),
  ADD KEY `caisse_fk_1739342` (`caisse_id`);

--
-- Index pour la table `type_visites`
--
ALTER TABLE `type_visites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_visites_name_unique` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `analyse_details`
--
ALTER TABLE `analyse_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `appointment_canals`
--
ALTER TABLE `appointment_canals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT pour la table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande_details`
--
ALTER TABLE `commande_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande_paiements`
--
ALTER TABLE `commande_paiements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `consultation_prices`
--
ALTER TABLE `consultation_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `consultation_statuses`
--
ALTER TABLE `consultation_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `facture_statuses`
--
ALTER TABLE `facture_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `forme_medicaments`
--
ALTER TABLE `forme_medicaments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `motif_charges`
--
ALTER TABLE `motif_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operation_cashes`
--
ALTER TABLE `operation_cashes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ordonnances`
--
ALTER TABLE `ordonnances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ordonnance_details`
--
ALTER TABLE `ordonnance_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ordonnance_livraisons`
--
ALTER TABLE `ordonnance_livraisons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `paiement_details`
--
ALTER TABLE `paiement_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `paiement_statuses`
--
ALTER TABLE `paiement_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT pour la table `rdv_statuses`
--
ALTER TABLE `rdv_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `soins`
--
ALTER TABLE `soins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `soin_details`
--
ALTER TABLE `soin_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `specilaltes`
--
ALTER TABLE `specilaltes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `type_consultations`
--
ALTER TABLE `type_consultations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_soins`
--
ALTER TABLE `type_soins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_visites`
--
ALTER TABLE `type_visites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `analyse_details`
--
ALTER TABLE `analyse_details`
  ADD CONSTRAINT `analyse_fk_1739900` FOREIGN KEY (`analyse_id`) REFERENCES `analysis` (`id`);

--
-- Contraintes pour la table `analysis`
--
ALTER TABLE `analysis`
  ADD CONSTRAINT `consultation_fk_1739809` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`),
  ADD CONSTRAINT `medecin_fk_1739805` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `patient_fk_1739806` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Contraintes pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `consultation_fk_1740161` FOREIGN KEY (`consultation_id`) REFERENCES `type_consultations` (`id`),
  ADD CONSTRAINT `medecin_fk_1740158` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `patient_fk_1740157` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `status_fk_1740163` FOREIGN KEY (`status_id`) REFERENCES `rdv_statuses` (`id`),
  ADD CONSTRAINT `user_fk_1740165` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visite_fk_1740160` FOREIGN KEY (`visite_id`) REFERENCES `type_visites` (`id`);

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `category_fk_1685666` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `user_fk_1685990` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `motif_fk_5209000` FOREIGN KEY (`motif_id`) REFERENCES `motif_charges` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `user_fk_1739438` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `commande_details`
--
ALTER TABLE `commande_details`
  ADD CONSTRAINT `article_fk_1739329` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `commande_fk_1739333` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`);

--
-- Contraintes pour la table `commande_paiements`
--
ALTER TABLE `commande_paiements`
  ADD CONSTRAINT `user_fk_1939438` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `medecin_fk_1694545` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `patient_fk_1694544` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `rdv_fk_1694543` FOREIGN KEY (`rdv_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `status_fk_1694578` FOREIGN KEY (`status_id`) REFERENCES `consultation_statuses` (`id`),
  ADD CONSTRAINT `user_fk_1694551` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `consultation_prices`
--
ALTER TABLE `consultation_prices`
  ADD CONSTRAINT `medecin_fk_1685773` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `type_fk_1685772` FOREIGN KEY (`type_id`) REFERENCES `type_consultations` (`id`),
  ADD CONSTRAINT `user_fk_1707397` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `emploi_fk_5208987` FOREIGN KEY (`emploi_id`) REFERENCES `emplois` (`id`);

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `status_fk_1694591` FOREIGN KEY (`status_id`) REFERENCES `facture_statuses` (`id`),
  ADD CONSTRAINT `user_fk_1694582` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD CONSTRAINT `grade_fk_1685650` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`),
  ADD CONSTRAINT `specialite_fk_1685651` FOREIGN KEY (`specialite_id`) REFERENCES `specilaltes` (`id`);

--
-- Contraintes pour la table `medecin_user`
--
ALTER TABLE `medecin_user`
  ADD CONSTRAINT `medecin_id_fk_1686168` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_1686168` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `medecin_fk_4739805` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `patient_fk_4739806` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Contraintes pour la table `operation_cashes`
--
ALTER TABLE `operation_cashes`
  ADD CONSTRAINT `caisse_fk_1740086` FOREIGN KEY (`caisse_id`) REFERENCES `cash_registers` (`id`),
  ADD CONSTRAINT `medecin_fk_1740087` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `user_fk_1740089` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `ordonnances`
--
ALTER TABLE `ordonnances`
  ADD CONSTRAINT `consultation_fk_1739746` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`),
  ADD CONSTRAINT `medecin_fk_1686191` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`),
  ADD CONSTRAINT `patient_fk_1686192` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Contraintes pour la table `ordonnance_details`
--
ALTER TABLE `ordonnance_details`
  ADD CONSTRAINT `forme_fk_1728141` FOREIGN KEY (`forme_id`) REFERENCES `forme_medicaments` (`id`),
  ADD CONSTRAINT `ordonnance_fk_1728110` FOREIGN KEY (`ordonnance_id`) REFERENCES `ordonnances` (`id`);

--
-- Contraintes pour la table `ordonnance_livraisons`
--
ALTER TABLE `ordonnance_livraisons`
  ADD CONSTRAINT `livraison_article_fk_1728141` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `livraison_ordonnance_fk_1728110` FOREIGN KEY (`ordonnance_id`) REFERENCES `ordonnances` (`id`),
  ADD CONSTRAINT `user_fk_172814123` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `facture_fk_1707389` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`),
  ADD CONSTRAINT `user_fk_1707396` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `genre_fk_1685792` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Contraintes pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_1685551` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_1685551` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_1685560` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_1685560` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
