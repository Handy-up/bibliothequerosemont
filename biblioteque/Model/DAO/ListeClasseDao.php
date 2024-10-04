<?php

// inclusions
include_once ("DAOListe.php");

class ListeClasseDao implements DAOListe
{


    static public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    static public function showFor($id_user)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $id_livres = null;
        $querry = $con->prepare("SELECT * FROM bibliotheque_departemental.Liste WHERE utilisateur_id = ?");
        $querry->execute(array($id_user));
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

    static public function insert($id_livre, $id_utilisateur)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $querry = $con->prepare("INSERT INTO bibliotheque_departemental.Liste (livre_id, utilisateur_id) VALUES (?, ?)");
        $querry->execute([$id_livre,$id_utilisateur]);
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
    }

    static public function delete($id_livre, $id_utilisateur)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }
        $querry = $con->prepare("DELETE FROM bibliotheque_departemental.Liste WHERE livre_id = ? AND utilisateur_id = ?");
        $querry->execute([$id_livre, $id_utilisateur]);
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
    }
}