<?php

use Model\Livre;

include_once ("DaoBook.php");

class LivreClassDao implements DaoBook
{

    static public function showAll(): array
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $livres = null;

        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Livre");
        $querry->execute();
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $enr){
            $livre = new Livre(
                $enr['id_livre'],
                $enr['titre'],
                $enr['auteur'],
                $enr['evaluations'],
                explode(',', $enr['mots_cles']),  // Supposant que les mots-clés sont stockés sous forme de chaîne séparée par des virgules dans la base de données
                $enr['description'],
                $enr['url_cover'],
                $enr['evaluations'],
                $enr['proprietaire'],
                $enr['detenteur_actuel'],
                $enr['detenteur_precedent'],
                $enr['disponible']
            );
            $livres[] = $livre;
        }

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return $livres;
    }

    static public function showFor($keyWord) {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $livre = null;

        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Livre WHERE id_livre = ?");
        $querry->execute(array($keyWord));
        $data = $querry->fetch();
        if ($data){
            $livre = new Livre(
                $data['id_livre'],
                $data['titre'],
                $data['auteur'],
                $data['evaluations'],
                explode(',', $data['mots_cles']),  // Supposant que les mots-clés sont stockés sous forme de chaîne séparée par des virgules dans la base de données
                $data['description'],
                $data['url_cover'],
                $data['evaluations'],
                $data['proprietaire'],
                $data['detenteur_actuel'],
                $data['detenteur_precedent'],
                $data['disponible']
            );
        }

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return $livre;
    }


    static public function showIf($conditions)
    {
        // TODO: Implement showIf() method.
    }

    static public function showOurnBook($idHost): array
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $livres = null;

        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Livre where proprietaire=?");
        $querry->execute([$idHost]);
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $enr){
            $livre = new Livre(
                $enr['id_livre'],
                $enr['titre'],
                $enr['auteur'],
                $enr['evaluations'],
                explode(',', $enr['mots_cles']),  // Supposant que les mots-clés sont stockés sous forme de chaîne séparée par des virgules dans la base de données
                $enr['description'],
                $enr['url_cover'],
                $enr['evaluations'],
                $enr['proprietaire'],
                $enr['detenteur_actuel'],
                $enr['detenteur_precedent'],
                $enr['disponible']
            );
            $livres[] = $livre;
        }

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return (array) $livres;
    }

    static public function update($news)
    {
        // TODO: Implement update() method.
    }

    static public function updateStatus($id_livre, $new_status)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        // Préparez et exécutez la requête SQL pour mettre à jour le statut du livre
        $query = $con->prepare("UPDATE Livre SET disponible = ? WHERE id_livre = ?");
        $query->execute([$new_status, $id_livre]);

        // Fermez la connexion
        ConnexionBD::fermerConnexion();
    }


    static public function insert($book) {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("INSERT INTO bibliotheque_departemental.Livre (id_livre,titre, auteur, edition, mots_cles, description, evaluations, proprietaire, detenteur_actuel, detenteur_precedent,disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $query->execute([
            $book->getIdLivre(),
            $book->getTitle(),
            $book->getAuthor(),
            $book->getEditor(),
            implode(',', $book->getKeyWords()),
            $book->getDescription(),
            $book->getEvaluation(),
            $book->getHostId(),
            $book->getCurrentHolderId(),
            $book->getPreviousHolderId(),
            0
        ]);

        $query->closeCursor();
        ConnexionBD::fermerConnexion();
    }

    static public function delete($bookId)
    {
    try {
        $con = ConnexionBD::getInstanceT();
    } catch (Exception $e) {
        throw new Exception("Connexion Impossible " . $e);
    }

    $query = $con->prepare("DELETE FROM bibliotheque_departemental.Livre WHERE id_livre = ?");
    $query->execute([$bookId]);

    $query->closeCursor();
    ConnexionBD::fermerConnexion();
}

    static public function filterBooks($title = null, $owner = null, $keyword = null, $currentHolder = null) {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = "SELECT * FROM bibliotheque_departemental.Livre WHERE "; // enlerver ?
        $params = [];

        if ($title !== null) {
            $query .= "titre LIKE ? AND ";
            $params[] = "%$title%";
        }

        if ($owner !== null) {
            $query .= "proprietaire = ? AND ";
            $params[] = $owner;
        }

        if ($keyword !== null) {
            $query .= "mots_cles LIKE ? AND ";
            $params[] = "%$keyword%";
        }

        if ($currentHolder !== null) {
            $query .= "detenteur_actuel = ? AND ";
            $params[] = $currentHolder;
        }

        // Supprimer la dernière partie inutile (AND) de la requête
        $query = rtrim($query, " AND ");

        $querry = $con->prepare($query);
        $querry->execute($params);

        $books = [];
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $row) {
            $book = new Livre(
                $row['id_livre'],
                $row['titre'],
                $row['auteur'],
                $row['evaluations'],
                explode(',', $row['mots_cles']),  // Supposant que les mots-clés sont stockés sous forme de chaîne séparée par des virgules dans la base de données
                $row['description'],
                $row['url_cover'],
                $row['evaluations'],
                $row['proprietaire'],
                $row['detenteur_actuel'],
                $row['detenteur_precedent'],
                $row['disponible']
            );

            $books[] = $book;
        }

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return $books;
    }

    static public function creerDemandeEtNotifier($demandeur, $destinataire, $livreId)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("CALL CreerDemandeEtNotifier(:p_demandeur, :p_destinataire, :p_livre_id)");
        $query->bindParam(':p_demandeur', $demandeur, PDO::PARAM_INT);
        $query->bindParam(':p_destinataire', $destinataire, PDO::PARAM_INT);
        $query->bindParam(':p_livre_id', $livreId, PDO::PARAM_INT);
        $query->execute();

        $query->closeCursor();
        ConnexionBD::fermerConnexion();
    }

    static public function showAllAvalable()
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $livres = null;

        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Livre where disponible = 1");
        $querry->execute();
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $enr){
            $livre = new Livre(
                $enr['id_livre'],
                $enr['titre'],
                $enr['auteur'],
                $enr['evaluations'],
                explode(',', $enr['mots_cles']),  // Supposant que les mots-clés sont stockés sous forme de chaîne séparée par des virgules dans la base de données
                $enr['description'],
                $enr['url_cover'],
                $enr['evaluations'],
                $enr['proprietaire'],
                $enr['detenteur_actuel'],
                $enr['detenteur_precedent'],
                $enr['disponible']
            );
            $livres[] = $livre;
        }

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return $livres;
    }



}