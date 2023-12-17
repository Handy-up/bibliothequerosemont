-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 17 déc. 2023 à 13:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque_departemental`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsererNouvelUtilisateur` (IN `p_cle_inscription` VARCHAR(55), IN `p_nom` VARCHAR(25), IN `p_prenom` VARCHAR(25), IN `p_mot_de_passe` VARCHAR(55))   BEGIN
    DECLARE v_code_partage VARCHAR(30);

    -- Vérifier si la clé d'inscription existe dans la table Cle
    IF EXISTS (SELECT 1 FROM Cle WHERE cle_inscription = p_cle_inscription) THEN
        -- Générer le code de partage en concaténant le prénom avec les deux dernières lettres de la clé
        SET v_code_partage = CONCAT(p_prenom, RIGHT(p_cle_inscription, 2));

        -- Insérer le nouvel utilisateur dans la table Utilisateur
        INSERT INTO Utilisateur (nom, prenom, mot_de_passe, code_de_partage, cle_inscription, date_inscription, statut, fonction)
        VALUES (p_nom, p_prenom, p_mot_de_passe, v_code_partage, p_cle_inscription, NOW(), 1, 'user');
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La clé d''inscription n''existe pas dans la table Cle.';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `cle`
--

CREATE TABLE `cle` (
  `id_cle` int(11) NOT NULL,
  `cle_inscription` varchar(55) NOT NULL,
  `date_dexpiration` date DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cle`
--

INSERT INTO `cle` (`id_cle`, `cle_inscription`, `date_dexpiration`, `email`) VALUES
(1, '1234', NULL, NULL),
(2, '0123', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `livre_id` int(11) DEFAULT NULL,
  `demandeur_id` int(11) DEFAULT NULL,
  `detenteur_actuel_id` int(11) DEFAULT NULL,
  `statut_demande` enum('En attente','Acceptée','Refusée') DEFAULT 'En attente',
  `date_demande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `id_experience` int(11) NOT NULL,
  `contenu` varchar(255) DEFAULT NULL,
  `date_publication` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `utilisateur_id` int(11) DEFAULT NULL,
  `livre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `id_liste` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `livre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id_livre` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `mots_cles` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `evaluations` int(11) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `proprietaire` int(11) DEFAULT NULL,
  `detenteur_actuel` int(11) DEFAULT NULL,
  `detenteur_precedent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `dateEnvoi` datetime DEFAULT NULL,
  `destinataire_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `consultation` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `mot_de_passe` varchar(55) DEFAULT NULL,
  `photo_profile` varchar(55) DEFAULT NULL,
  `code_de_partage` varchar(25) DEFAULT 'Valeur_Par_Defaut',
  `cle_inscription` varchar(255) NOT NULL,
  `date_inscription` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `statut` tinyint(1) DEFAULT 1,
  `fonction` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `mot_de_passe`, `photo_profile`, `code_de_partage`, `cle_inscription`, `date_inscription`, `statut`, `fonction`) VALUES
(1, 'Tata', 'Tata', '1234', NULL, 'Tata34', '1234', '2023-12-16 19:26:12', 1, 'admin'),
(2, 'Toto', 'Toto', '0123', NULL, 'Toto23', '0123', '2023-12-16 19:36:23', 1, 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cle`
--
ALTER TABLE `cle`
  ADD PRIMARY KEY (`id_cle`),
  ADD UNIQUE KEY `cle_inscription` (`cle_inscription`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `livre_id` (`livre_id`),
  ADD KEY `demandeur_id` (`demandeur_id`),
  ADD KEY `detenteur_actuel_id` (`detenteur_actuel_id`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id_experience`),
  ADD KEY `livre_id` (`livre_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id_liste`),
  ADD KEY `livre_id` (`livre_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`),
  ADD KEY `detenteur_actuel` (`detenteur_actuel`),
  ADD KEY `detenteur_precedent` (`detenteur_precedent`),
  ADD KEY `proprietaire` (`proprietaire`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `notification_ibfk1` (`destinataire_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `cle_inscription` (`cle_inscription`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cle`
--
ALTER TABLE `cle`
  MODIFY `id_cle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id_liste` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id_livre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id_livre`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`demandeur_id`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `demande_ibfk_3` FOREIGN KEY (`detenteur_actuel_id`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `experience_ibfk_2` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id_livre`);

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `liste_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `liste_ibfk_2` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id_livre`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `livre_ibfk_1` FOREIGN KEY (`proprietaire`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `livre_ibfk_2` FOREIGN KEY (`detenteur_actuel`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `livre_ibfk_3` FOREIGN KEY (`detenteur_precedent`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_ibfk1` FOREIGN KEY (`destinataire_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
