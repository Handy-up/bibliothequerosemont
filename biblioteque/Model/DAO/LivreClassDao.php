<?php

use Model\Livre;

include_once ("DaoBook.php");

class LivreClassDao implements DaoBook
{

    static public function showAll()
    {
        // TODO: Implement showAll() method.
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

    static public function update($news)
    {
        // TODO: Implement update() method.
    }

    static public function insert($book) {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("INSERT INTO bibliotheque_departemental.Livre (titre, auteur, edition, mots_cles, description, evaluations, disponible, proprietaire, detenteur_actuel, detenteur_precedent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $query->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getEditor(),
            implode(',', $book->getKeyWords()),
            $book->getDescription(),
            $book->getEvaluation(),
            $book->isStatus(),
            $book->getHost()->getId(),  // Supposant que getId() retourne l'ID de l'utilisateur
            $book->getCurrentHolder()->getId(),
            $book->getPreviousHolder() ? $book->getPreviousHolder()->getId() : null,
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

}