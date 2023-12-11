# création de la table clé
create table Cle
(
    id_cle           int auto_increment
        primary key,
    cle_inscription  varchar(55) not null,
    date_dexpiration date        null,
    email            varchar(55) null,
    constraint cle_inscription
        unique (cle_inscription)
);
# création de la table Utilisateur

create table Utilisateur
(
    id_utilisateur   int auto_increment
        primary key,
    nom              varchar(25)                             null,
    prenom           varchar(25)                             null,
    mot_de_passe     varchar(55)                             null,
    photo_profile    varchar(55)                             null,
    code_de_partage  varchar(25) default 'Valeur_Par_Defaut' null,
    cle_inscription  varchar(255)                            not null,
    date_inscription timestamp   default CURRENT_TIMESTAMP   null on update CURRENT_TIMESTAMP,
    statut           tinyint(1)  default 1                   null,
    fonction         varchar(25)                             null,
    constraint cle_inscription
        unique (cle_inscription)
);
# création de la table Livre

create table Livre
(
    id_livre            int auto_increment
        primary key,
    titre               varchar(255) null,
    auteur              varchar(255) null,
    edition             varchar(255) null,
    mots_cles           varchar(255) null,
    description         text         null,
    evaluations         int          null,
    disponible          tinyint(1)   null,
    proprietaire        int          null,
    detenteur_actuel    int          null,
    detenteur_precedent int          null,
    constraint livre_ibfk_1
        foreign key (proprietaire) references Utilisateur (id_utilisateur),
    constraint livre_ibfk_2
        foreign key (detenteur_actuel) references Utilisateur (id_utilisateur),
    constraint livre_ibfk_3
        foreign key (detenteur_precedent) references Utilisateur (id_utilisateur)
);

# création de la table Demande
create table Demande
(
    id_demande       int auto_increment
        primary key,
    date_demande     timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    statut           tinyint(1)                          null,
    detenteur_actuel int                                 null,
    demandeur        int                                 null,
    livre_id         int                                 null,
    constraint demande_ibfk_1
        foreign key (detenteur_actuel) references Utilisateur (id_utilisateur),
    constraint demande_ibfk_2
        foreign key (demandeur) references Utilisateur (id_utilisateur),
    constraint demande_ibfk_3
        foreign key (livre_id) references Livre (id_livre)
);

create index demandeur
    on Demande (demandeur);

create index detenteur_actuel
    on Demande (detenteur_actuel);

create index livre_id
    on Demande (livre_id);

create table Experience
(
    id_experience    int auto_increment
        primary key,
    contenu          varchar(255)                        null,
    date_publication timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    utilisateur_id   int                                 null,
    livre_id         int                                 null,
    constraint experience_ibfk_1
        foreign key (utilisateur_id) references Utilisateur (id_utilisateur),
    constraint experience_ibfk_2
        foreign key (livre_id) references Livre (id_livre)
);

# création de la des indexes Livre

create index livre_id
    on Experience (livre_id);

create index utilisateur_id
    on Experience (utilisateur_id);

# création de la table Liste

create table Liste
(
    id_liste       int auto_increment
        primary key,
    utilisateur_id int null,
    livre_id       int null,
    constraint liste_ibfk_1
        foreign key (utilisateur_id) references Utilisateur (id_utilisateur),
    constraint liste_ibfk_2
        foreign key (livre_id) references Livre (id_livre)
);

create index livre_id
    on Liste (livre_id);

create index utilisateur_id
    on Liste (utilisateur_id);

create index detenteur_actuel
    on Livre (detenteur_actuel);

create index detenteur_precedent
    on Livre (detenteur_precedent);

create index proprietaire
    on Livre (proprietaire);

# création de la table notification

create table Notification
(
    id_notification int auto_increment
        primary key,
    contenu         varchar(255)         not null,
    destinataire    int                  null,
    consulter       tinyint(1) default 0 null,
    constraint fk_destinataire
        foreign key (destinataire) references Utilisateur (id_utilisateur)
);

# création de la procedure stocker pour faire une demande de livre et notifier

DELIMITER //

CREATE DEFINER = root@localhost PROCEDURE CreerDemandeEtNotifier(IN p_demandeur INT, IN p_destinataire INT, IN p_livre_id INT)
BEGIN
    DECLARE nouvelle_demande_id INT;

    -- Insérer la nouvelle demande
    INSERT INTO Demande (date_demande, statut, detenteur_actuel, demandeur, livre_id)
    VALUES (NOW(), 1, p_demandeur, p_destinataire, p_livre_id);

    -- Récupérer l'ID de la nouvelle demande
    SET nouvelle_demande_id = LAST_INSERT_ID();

    -- Envoyer une notification au demandeur
    INSERT INTO Notification (contenu, destinataire)
    VALUES (CONCAT('Votre demande pour le livre ',
                   (SELECT titre FROM Livre WHERE id_livre = p_livre_id)
                , ' a été envoyée.'), p_demandeur);

    -- Envoyer une notification à la personne adressée par la demande
    INSERT INTO Notification (contenu, destinataire)
    VALUES (CONCAT('Vous avez reçu une nouvelle demande de la part de ',
                   (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_destinataire),
                   ' pour le livre ', (SELECT titre FROM Livre WHERE id_livre = p_livre_id) )
           , p_destinataire);

    -- Envoyer une notification à l'administrateur (remplacez "id_administrateur" par l'ID réel de votre administrateur)
    INSERT INTO Notification (contenu, destinataire)
    VALUES (
               CONCAT('Une nouvelle demande pour le livre ', (SELECT titre FROM Livre WHERE id_livre = p_livre_id),
                      ' de la part de ', (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_demandeur),
                      ' a ', (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_destinataire),' a été créée.'), 0);
END;
//

DELIMITER ;

# création de la procedure stocker pour un nouvelle utilisateur

DELIMITER //

CREATE DEFINER = root@localhost PROCEDURE InsererNouvelUtilisateur(IN p_cle_inscription VARCHAR(55), IN p_nom VARCHAR(25),
                                                                   IN p_prenom VARCHAR(25), IN p_mot_de_passe VARCHAR(55))
BEGIN
    DECLARE v_code_partage VARCHAR(30);

    -- Vérifier si la clé d'inscription existe dans la table Cle
    IF EXISTS (SELECT 1 FROM Cle WHERE cle_inscription = p_cle_inscription) THEN
        -- Générer le code de partage en concaténant le prénom avec les deux dernières lettres de la clé
        SET v_code_partage = CONCAT(p_prenom, RIGHT(p_cle_inscription, 2));

        -- Insérer le nouvel utilisateur dans la table Utilisateur
        INSERT INTO Utilisateur (nom, prenom, mot_de_passe, code_de_partage, cle_inscription, date_inscription, statut, fonction)
        VALUES (p_nom, p_prenom, p_mot_de_passe, v_code_partage, p_cle_inscription, NOW(), 1, 'user'); -- MD5 est utilisé pour stocker un mot de passe haché, vous pouvez ajuster selon vos besoins
    ELSE
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La clé d''inscription n''existe pas dans la table Cle.';
    END IF;
END;
//

DELIMITER ;


#creation de déclancheur pour suprimer tout les demandes qui ont été accepter ou refuser

DELIMITER //
create
    definer = root@localhost procedure SupprimerDemandesStatutZero()
BEGIN
    DELETE FROM Demande WHERE statut = 0;
END;
//
DELIMITER ;

#creation de déclancheur pour suprimer tout les demandes qui ont été accepter ou refuser version tout les 5 secondes

DELIMITER //
create definer = root@localhost event EventSupprimerDemandesStatutZero on schedule
    every '5' SECOND
        starts '2023-11-11 20:58:49'
    enable
    do
    CALL SupprimerDemandesStatutZero();
//
DELIMITER ;

