-- création de la table clé
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
-- création de la table Utilisateur

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
-- création de la table Livre

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

-- création de la table Demande
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

-- création de la des indexes Livre

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

-- création de la table notification

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

-- création table échange

CREATE TABLE Echanges
(
    date_echange TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    informations VARCHAR(100) NOT NULL,
    id INT AUTO_INCREMENT,
    CONSTRAINT Echanges_pk PRIMARY KEY (id),
    CONSTRAINT Echanges_pk_2 UNIQUE (id)
);

-- création de la procedure stocker pour faire une demande de livre et notifier

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
END //

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
END //

DELIMITER ;


-- creation de déclancheur pour suprimer tout les demandes qui ont été accepter ou refuser

DELIMITER //
create
    definer = root@localhost procedure SupprimerDemandesStatutZero()
BEGIN
    DELETE FROM Demande WHERE statut = 0;
END //
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

#confirmer la demdende et notifier
DELIMITER //

CREATE DEFINER = root@localhost PROCEDURE ConfirmerDemandeEtNotifier(IN p_demande_id INT,IN p_echangeur INT)
BEGIN
    DECLARE p_livre_id INT;
    DECLARE p_demandeur_id INT;

    -- Récupérer l'ID du livre et du demandeur associés à la demande
    SELECT livre_id, demandeur INTO p_livre_id, p_demandeur_id
    FROM Demande
    WHERE id_demande = p_demande_id;

    -- Mettre à jour le statut de la demande à 0 (confirmé)
    UPDATE Demande
    SET statut = 0
    WHERE id_demande = p_demande_id;

    -- Insérer l'ID du livre et du demandeur dans la table Liste
    INSERT INTO Liste (utilisateur_id, livre_id)
    VALUES (p_demandeur_id, p_livre_id);

    -- Changer le détenteur actuele et précédent du livre
    UPDATE Livre
    SET detenteur_actuel = p_demandeur_id, disponible = 0, detenteur_precedent = p_echangeur
    WHERE id_livre = p_livre_id;


    -- Notifier le demandeur
    INSERT INTO Notification (contenu, destinataire)
    VALUES (CONCAT('Votre demande pour le livre ',
                   (SELECT titre FROM Livre WHERE id_livre = p_livre_id),
                   ' a été confirmée.'), p_demandeur_id);

    -- Notifier la personne à qui la demande était adressée
    INSERT INTO Notification (contenu, destinataire)
    VALUES (CONCAT('La demande de ',
                   (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_echangeur),
                   ' pour le livre ',
                   (SELECT titre FROM Livre WHERE id_livre = p_livre_id),
                   ' a été confirmée.'), (SELECT detenteur_actuel FROM Livre WHERE id_livre = p_livre_id));

    -- Notifier l'administrateur (remplacez "id_administrateur" par l'ID réel de votre administrateur)
    INSERT INTO Notification (contenu, destinataire)
    VALUES (CONCAT('La demande pour le livre ',
                   (SELECT titre FROM Livre WHERE id_livre = p_livre_id),
                   ' de ',
                   (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_demandeur_id),
                   ' à ',
                   (SELECT prenom FROM Utilisateur WHERE id_utilisateur = p_echangeur),
                   ' a été confirmée.'), 0);
END //
DELIMITER ;

-- insérer livre dans liste option pour administrateur recupérer un livre
DELIMITER //

create
    definer = root@localhost procedure InsereLivreDansListe(IN detenteur_id int, IN livre_id int)
BEGIN
    -- Insérer le livre dans la liste
    INSERT INTO Liste (utilisateur_id, livre_id) VALUES (detenteur_id, livre_id);
END //
DELIMITER ;

-- inserer ouvrage par défault
DELIMITER //

create
    definer = root@localhost procedure inserer_livres_par_defaut()
BEGIN
    -- Livre 1
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('1984', 'George Orwell', 'Vintage Edition', 'Dystopian, Political Fiction', 'A classic portrayal of a totalitarian future society', 5, 1, 0, 0, 0, 'book1.webp');

    -- Livre 2
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('To Kill a Mockingbird', 'Harper Lee', '50th Anniversary Edition', 'Fiction, Southern Gothic', 'A poignant story of racial injustice in the American South', 4, 1, 0, 0, 0, 'book2.jpg');

    -- Livre 3
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Great Gatsby', 'F. Scott Fitzgerald', 'Deluxe Edition', 'Fiction, Jazz Age', 'A tale of decadence and the American Dream', 4, 1, 0, 0, 0, 'book3.jpg');

    -- Livre 4
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('One Hundred Years of Solitude', 'Gabriel Garcia Marquez', 'Modern Classics', 'Magical Realism, Family Saga', 'A multi-generational tale of the Buendía family in Macondo', 5, 1, 0, 0, 0, 'book4.jpg');

    -- Livre 5
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Hobbit', 'J.R.R. Tolkien', 'Illustrated Edition', 'Fantasy, Adventure', 'The classic tale of Bilbo Baggins and his epic journey', 5, 1, 0, 0, 0, 'book5.jpg');

    -- Livre 6
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('Brave New World', 'Aldous Huxley', 'Centennial Edition', 'Dystopian, Science Fiction', 'A cautionary vision of a technologically advanced future', 4, 1, 0, 0, 0, 'book6.jpg');

    -- Livre 7
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('Pride and Prejudice', 'Jane Austen', 'Collector\'s Edition', 'Classic, Romance', 'A timeless tale of love and social expectations', 5, 1, 0, 0, 0, 'book7.jpg');

    -- Livre 8
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Alchemist', 'Paulo Coelho', '25th Anniversary Edition', 'Fiction, Inspirational', 'A philosophical novel about a young Andalusian shepherd', 4, 1, 0, 0, 0, 'book8.jpg');

    -- Livre 9
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book9.jpg');

    -- Livre 10
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('Lord of the Flies', 'William Golding', 'Anniversary Edition', 'Fiction, Survival', 'A compelling story about the descent into savagery', 3, 1, 0, 0, 0, 'book10.jpg');

    -- Livre 11
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Shining', 'Stephen King', 'Special Edition', 'Horror, Psychological Thriller', 'A chilling tale of a haunted hotel and a family\'s descent into madness', 4, 1, 0, 0, 0, 'book11.jpg');

    -- Livre 12
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Da Vinci Code', 'Dan Brown', 'Illustrated Edition', 'Mystery, Thriller', 'A gripping story of secret societies and hidden codes', 3, 1, 0, 0, 0, 'book12.jpg');

    -- Livre 13
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Road', 'Cormac McCarthy', 'Modern Classics', 'Post-apocalyptic, Survival', 'A father and son\'s journey in a world destroyed by an unspecified catastrophe', 5, 1, 0, 0, 0, 'book13.jpg');

    -- Livre 14
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('Moby-Dick', 'Herman Melville', 'Deluxe Edition', 'Adventure, Sea Story', 'The epic tale of Captain Ahab\'s quest for the white whale', 4, 1, 0, 0, 0, 'book14.jpg');

    -- Livre 15
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Hunger Games', 'Suzanne Collins', 'Collector\'s Edition', 'Dystopian, Science Fiction', 'A thrilling story of survival in a dystopian world', 4, 1, 0, 0, 0, 'book15.jpg');

    -- Livre 16
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Handmaid\'s Tale', 'Margaret Atwood', 'Special Edition', 'Dystopian, Feminist Fiction', 'A powerful narrative set in a dystopian theocratic society', 5, 1, 0, 0, 0, 'book16.jpg');

    -- Livre 17
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Millennium Trilogy', 'Mystery, Thriller', 'A gripping mystery involving murder, intrigue, and corporate corruption', 4, 1, 0, 0, 0, 'book17.jpg');

    -- Livre 18
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('A Game of Thrones', 'George R.R. Martin', 'A Song of Ice and Fire Series', 'Fantasy, Epic', 'The first book in the epic fantasy series that inspired "Game of Thrones"', 5, 1, 0, 0, 0, 'book18.webp');

    -- Livre 19
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Fault in Our Stars', 'John Green', 'Special Edition', 'Young Adult, Romance', 'A heartwarming and heartbreaking story of two teenagers with cancer', 4, 1, 0, 0, 0, 'book19.jpg');

    -- Livre 20
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Chronicles of Narnia', 'C.S. Lewis', 'Complete Box Set', 'Fantasy, Adventure', 'A timeless series of seven high fantasy novels for children', 5, 1, 0, 0, 0, 'book20.jpg');

    -- Livre 21
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book21.jpg');

    -- Livre 22
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book22.jpg');

    -- Livre 23
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book23.jpg');

    -- Livre 24
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book24.jpg');

    -- Livre 25
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book25.jpg');

    -- Livre 26
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book26.jpg');

    -- Livre 27
    INSERT INTO Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent, url_cover)
    VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Classic Edition', 'Fiction, Coming-of-Age', 'A classic novel about teenage angst', 4, 1, 0, 0, 0, 'book27.jpg');
END //
DELIMITER ;

