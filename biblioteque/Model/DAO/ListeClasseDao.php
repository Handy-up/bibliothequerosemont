<?php

// inclusions
include_once ("DaoBook.php");

class ListeClasseDao implements DaoBook
{


    static public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    static public function showFor($keyWord)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $id_livres = null;
        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Liste WHERE utilisateur_id = ?");
        $querry->execute(array($keyWord));
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $enr){
            $id_livres[] = $enr['livre_id'];
        }
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();

        return $id_livres;
    }

    static public function showIf($conditions)
    {
        // TODO: Implement showIf() method.
    }

    static public function update($news)
    {
        // TODO: Implement update() method.
    }

    static public function insert($infoUtilisateur)
    {
        // TODO: Implement insert() method.
    }

    static public function delete($object)
    {
        // TODO: Implement delete() method.
    }

    static public function filterBooks($title = null, $owner = null, $keyword = null, $currentHolder = null)
    {
        // TODO: Implement filterBooks() method.
    }
}