<?php
// Pierre Handy

// inclusions
include_once("DAO.interface.php");

class UtilisateurClassDao implements DaoUser
{

    static public function showAll(){
        $user = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
//        Recupéré les utilisateurs
        $users = [];
        $querry = $con->prepare("select * from bibliotheque_departemental.Utilisateur");
        $querry->execute();
        $data = $querry->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $enr){
            $user = new User(
                $enr['id_utilisateur'],
                $enr['nom'],
                $enr['prenom'],
                $enr['mot_de_passe'],
                $enr['photo_profile'],
                $enr['code_de_partage'],
                $enr['cle_inscription'],
                $enr['date_inscription'],
                $enr['statut'],
                $enr['fonction']
            );
            $users[] = $user;
        }
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
        return $users;
    }

    static public function showFor($keyWord)
    {
        // TODO: Implement showFor() method.
    }

    static public function showIf($conditions)
    {
        // TODO: Implement showIf() method.
    }

    static public function update($news)
    {
        // TODO: Implement update() method.
    }

    static public function insert($object)
    {
        // TODO: Implement insert() method.
    }

    static public function delete($object)
    {
        // TODO: Implement delete() method.
    }
}