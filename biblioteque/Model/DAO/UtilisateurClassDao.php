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

    static public function showFor($id)
    {
        $user = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
//        Recupéré les utilisateurs
        $querry = $con->prepare("select * from bibliotheque_departemental.Utilisateur where id_utilisateur=?");
        $querry->execute(array($id));
        $data = $querry->fetch();

        $user = new User(
            $data['id_utilisateur'],
            $data['nom'],
            $data['prenom'],
            $data['mot_de_passe'],
            $data['photo_profile'],
            $data['code_de_partage'],
            $data['cle_inscription'],
            $data['date_inscription'],
            $data['statut'],
            $data['fonction']
        );

        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
        return $user;
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
        $user = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
        $query = $con->prepare("UPDATE bibliotheque_departemental.Utilisateur SET nom=?, prenom=?, photo_profile=?, code_de_partage=?, mot_de_passe=?  WHERE id_utilisateur=?");
        $query->execute(
            array(
                $news->getLastName(),
                $news->getFirstName(),
                $news->getProfilePhoto(),
                $news->getShareCode(),
                $news->getPassword(),
                $news->getId()
            )
        );
        $query->closeCursor();
        ConnexionBD::fermerConnexion();
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
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            // Retourne vrai si tout s'est bien passé
            return true;

        } catch (PDOException $e) {
            // Gérez les erreurs ici, vous pouvez également renvoyer un message ou une exception personnalisée
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }

    }

    static public function valideKey($key)
    {
        $result = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
        $querry = $con->prepare("select * from bibliotheque_departemental.Cle where cle_inscription=?");
        $querry->execute(array($key));
        $data = $querry->fetch(PDO::FETCH_ASSOC);

         if ($data){
             $result = $data;
         }
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
        return $result;
    }



    static public function delete($object)
    {
        // TODO: Implement delete() method.
    }

    static public function demadeCle($email)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }

        $querry = $con->prepare("INSERT INTO bibliotheque_departemental.Cle (email,date_dexpiration) value (?,NOW())");
        $querry->execute([$email]);
        $querry->closeCursor();
        ConnexionBD::fermerConnexion();
    }

    static public function confirmDemadeCle($id_cle, $cle)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        // Utilisation de la requête UPDATE pour mettre à jour la clé existante
        $query = $con->prepare("UPDATE bibliotheque_departemental.Cle SET cle_inscription = ?, date_dexpiration = NOW() WHERE id_cle = ?");
        $query->execute([$cle, $id_cle]);

        $query->closeCursor();
        ConnexionBD::fermerConnexion();
    }


    static public function ListedemadeCle()
    {
        $result = array(); // Utiliser un tableau pour stocker plusieurs résultats
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("SELECT * FROM bibliotheque_departemental.Cle WHERE cle_inscription IS NULL");
        $query->execute();

        // Utiliser fetchAll pour récupérer toutes les lignes correspondantes
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            $result = $data;
        }

        $query->closeCursor();
        ConnexionBD::fermerConnexion();

        return $result;
    }

    static public function ListeCle()
    {
        $result = array(); // Utiliser un tableau pour stocker plusieurs résultats
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("SELECT * FROM bibliotheque_departemental.Cle where cle_inscription is not null ");
        $query->execute();

        // Utiliser fetchAll pour récupérer toutes les lignes correspondantes
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            $result = $data;
        }

        $query->closeCursor();
        ConnexionBD::fermerConnexion();

        return $result;
    }

    static public function showAllAvalable(){
        $user = null;
        try {
            $con = ConnexionBD::getInstanceT();
        }catch (Exception $e){
            throw new Exception("Connexion Impossible ".$e);
        }
//        Recupéré les utilisateurs
        $users = [];
        $querry = $con->prepare("select * from bibliotheque_departemental.Utilisateur where statut=1");
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

}