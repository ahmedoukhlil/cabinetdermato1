-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 26 août 2020 à 18:46
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
-- Base de données :  `cabinet`
--
CREATE DATABASE IF NOT EXISTS `cabinet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cabinet`;

--
-- Déchargement des données de la table `analyse_details`
--

INSERT INTO `appointment_canals` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Physique', '2020-08-06 18:57:06', '2020-08-06 18:57:06', NULL),
(2, 'En ligne', '2020-08-06 18:57:50', '2020-08-06 18:57:50', NULL),
(3, 'Par téléphone', '2020-08-06 18:58:02', '2020-08-06 18:58:02', NULL);

--
-- Déchargement des données de la table `articles`
--
INSERT INTO `cash_registers` (`id`, `name`, `solde`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Caisse principale', '30400.00', '2020-08-06 18:29:01', '2020-08-14 23:47:27', NULL),
(2, 'Caisse Laser', '200000.00', '2020-08-06 18:29:14', '2020-08-14 23:53:05', NULL);


--
-- Déchargement des données de la table `consultations`
--

INSERT INTO `consultation_prices` (`id`, `tarif`, `created_at`, `updated_at`, `deleted_at`, `type_id`, `medecin_id`, `user_id`) VALUES
(1, 8000, '2020-08-06 21:17:44', '2020-08-06 21:17:44', NULL, 1, 1, 1),
(2, 10000, '2020-08-06 21:19:28', '2020-08-06 21:19:28', NULL, 2, 1, 1);

--
-- Déchargement des données de la table `consultation_statuses`
--

INSERT INTO `consultation_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Effectuée', '2020-08-07 19:44:19', '2020-08-07 19:44:19', NULL);

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `facture_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Élaborée', '2020-08-06 19:19:25', '2020-08-06 19:19:25', NULL),
(2, 'Annulée', '2020-08-06 19:19:36', '2020-08-06 19:19:36', NULL);

--
-- Déchargement des données de la table `forme_medicaments`
--

INSERT INTO `forme_medicaments` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comprimés', '2020-08-06 18:05:00', '2020-08-06 18:05:00', NULL),
(2, 'Gélules', '2020-08-06 18:05:08', '2020-08-06 18:05:08', NULL),
(3, 'crème', '2020-08-08 17:49:33', '2020-08-08 17:49:33', NULL),
(4, 'Pommade', '2020-08-08 17:49:48', '2020-08-08 17:49:48', NULL),
(5, 'fluid', '2020-08-08 17:50:06', '2020-08-08 17:50:06', NULL);

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Homme', '2020-08-06 18:23:27', '2020-08-06 18:23:27', NULL),
(2, 'Femme', '2020-08-06 18:23:35', '2020-08-06 18:23:35', NULL);

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Docteur', 'Dr', '2020-08-06 18:01:47', '2020-08-06 18:01:47', NULL),
(2, 'Professeur', 'Pr', '2020-08-06 18:01:59', '2020-08-06 18:01:59', NULL);

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `name`, `phone`, `phone_2`, `email`, `free_days`, `daily_consultation`, `daily_rdv`, `consultation_duration`, `created_at`, `updated_at`, `deleted_at`, `grade_id`, `specialite_id`, `solde_soins`) VALUES
(1, 'Salma YAHYA', 26332042, NULL, 'salma@admin.com', 7, 20, 20, 0, '2020-08-06 18:06:46', '2020-08-14 23:53:05', NULL, 1, 1, 15000);

--
-- Déchargement des données de la table `medecin_user`
--

INSERT INTO `medecin_user` (`user_id`, `medecin_id`) VALUES
(1, 1),
(2, 1),
(3, 1);


INSERT INTO `paiement_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Encaissé', '2020-08-06 19:19:56', '2020-08-08 02:59:47', NULL),
(2, 'Annulé', '2020-08-06 19:20:05', '2020-08-06 19:20:05', NULL);

--
-- Déchargement des données de la table `patients`
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
(183, 'note_delete', '2020-08-13 14:16:11', '2020-08-13 14:16:11', NULL);

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
(1, 183);

--
-- Déchargement des données de la table `rdv_statuses`
--

INSERT INTO `rdv_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Réservation', '2020-06-24 02:22:13', '2020-06-24 02:22:13', NULL),
(2, 'Confirmé', '2020-06-24 02:22:24', '2020-06-24 02:22:24', NULL),
(3, 'Clôturé', '2020-06-24 02:22:32', '2020-06-26 23:20:34', NULL),
(4, 'Annulé', '2020-06-24 02:22:40', '2020-06-26 23:20:45', NULL),
(5, 'Abandonné', '2020-06-26 23:20:54', '2020-06-26 23:20:54', NULL);

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'Secrétariat', NULL, '2020-08-08 18:45:54', NULL);

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 1);


INSERT INTO `specilaltes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dermatologue', '2020-08-06 18:04:44', '2020-08-06 18:04:44', NULL);

--
-- Déchargement des données de la table `type_consultations`
--

INSERT INTO `type_consultations` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ordinaire', '2020-08-06 18:28:08', '2020-08-06 18:28:08', NULL),
(2, 'Urgence', '2020-08-06 18:28:16', '2020-08-06 18:28:16', NULL);

--
-- Déchargement des données de la table `type_soins`
--

INSERT INTO `type_visites` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Consultation', '2020-08-06 20:51:40', '2020-08-06 20:51:40', NULL),
(2, 'Rendez-Vous', '2020-08-06 20:52:15', '2020-08-06 20:52:15', NULL);

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `login`, `is_doctor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$paA5M4Ymqv13pBvnO1ku7OdAwS/22ReOMaEXHCAgtkh/P0iiFxeLG', NULL, 'admin', 1, NULL, '2020-08-07 19:35:49', NULL),
(2, 'Salma YAHYA', 'salma@salma.com', NULL, '$2y$10$5A/mFsv1jULQ.DmraibHnuhc42KZ6P3oT2ow86LjQm0DwqGqNHa46', NULL, 'salma', 1, '2020-08-08 16:38:38', '2020-08-08 16:38:38', NULL),
(3, 'Mariem SECRETAIRE', 'mariem@mariem.com', NULL, '$2y$10$xM40cUmiQAKyBRPqec754uFnTUobQo5dWNwSiYkGIGARggJk1nimC', NULL, 'mariem', 0, '2020-08-08 16:40:36', '2020-08-08 16:40:36', NULL);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
