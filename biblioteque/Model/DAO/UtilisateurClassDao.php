<?php
// Pierre Handy

// inclusions
include_once("DAO.interface.php");

class UtilisateurClassDao implements DaoUser
{

    static public function showAll(): array
    {
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
        $user = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
//        Recupéré les utilisateurs
        $users = [];
        $querry = $con->prepare("select * from bibliotheque_departemental.Utilisateur where Utilisateur.id_utilisateur=? and Utilisateur.mot_de_passe=?");
        $querry->execute(array($conditions[0],$conditions[1]));
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

    static public function update($news)
    {
        // TODO: Implement update() method.
    }

    static public function insert($infoUtilisateur): bool
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            // Utilisez la procédure stockée InsererNouvelUtilisateur
            $query = $con->prepare("CALL InsererNouvelUtilisateur(:cle_inscription, :nom, :prenom, :mot_de_passe)");

            $query->bindParam(":cle_inscription", $infoUtilisateur[0]);
            $query->bindParam(":nom", $infoUtilisateur[1]);
            $query->bindParam(":prenom", $infoUtilisateur[2]);
            $query->bindParam(":mot_de_passe", $infoUtilisateur[3]);
            // Exécutez la requête
            $query->execute();
            // Retourne vrai si tout s'est bien passé
            return true;

        } catch (PDOException $e) {
            // Gérez les erreurs ici, vous pouvez également renvoyer un message ou une exception personnalisée
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }



    static public function delete($object)
    {
        // TODO: Implement delete() method.
    }
}