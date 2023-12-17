<?php

class DemandeDao
{
    static public function createDemande($livre_id, $demandeur_id, $detenteur_actuel_id)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            $query = $con->prepare("INSERT INTO Demande (livre_id, demandeur_id, detenteur_actuel_id, date_demande) VALUES (?, ?, ?, NOW())");
            $query->execute(array($livre_id, $demandeur_id, $detenteur_actuel_id));
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion de demande : " . $e->getMessage();
            return false;
        }
    }

// Methode de mise à jour d'une demande : à décommenter si nécessaire
    /*static public function updateDemande($demande_id, $statut)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            $query = $con->prepare("UPDATE Demande SET statut_demande = ? WHERE id_demande = ?");
            $query->execute(array($statut, $demande_id));
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de mise à jour de demande : " . $e->getMessage();
            return false;
        }
    }*/

//À utiliser pour l'administrateur pour avoir les infos d'une demande
    static public function getDemandeById($demande_id)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            $query = $con->prepare("SELECT * FROM Demande WHERE id_demande = ?");
            $query->execute(array($demande_id));
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();
            ConnexionBD::fermerConnexion();

            if ($data) {
                return new Demande(
                    $data['id_demande'],
                    $data['livre_id'],
                    $data['demandeur_id'],
                    $data['detenteur_actuel_id'],
                    $data['statut_demande'],
                    $data['date_demande']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur de récupération de demande : " . $e->getMessage();
            return null;
        }
    }

    // Ajoutez d'autres méthodes si nécessaire
}