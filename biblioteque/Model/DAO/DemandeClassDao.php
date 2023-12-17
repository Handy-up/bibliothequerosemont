<?php
//Lleyton
class DemandeClasseDAO {
    
    // Méthode pour ajouter une nouvelle demande  dans la base de données
    public function ajouterDemande($id_demande,$statut,$detenteur_actuel, $demendeur,$livre_id) {
       $con= ConnexionBD::getInstanceT();
        $sql = "INSERT INTO Demande (id_demande, date_demande, statut, detenteur_actuel, demandeur, livre_id) VALUES (:id_demande,NOW(),:statu, :detenteur_actuel, :demandeur:livre_id)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_demande', $id_demande, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_INT);
        $stmt->bindParam(':livre_id', $livre_id, PDO::PARAM_INT);
        $stmt->bindParam(':detenteur_actuel', $detenteur_actuel, PDO::PARAM_INT);
        $stmt->bindParam(':demandeur', $demendeur, PDO::PARAM_INT);
        
        
        
        return $stmt->execute();
    }

    // Méthode pour récupérer toutes les demandes de la base de données
    public function getDemande() {
        $con= ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM Demande ORDER BY statut DESC";
        $stmt = $con->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Méthode pour mettre à jour une demande dans la base de données
    public function updateDemande($id_demande, $statut, $detenteur_actuel) {
        $con= ConnexionBD::getInstanceT();
        $sql = "UPDATE Demande SET statut = :statut, detenteur_actuel = :detenteur_actuel WHERE id_demande = :id_demande";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_INT);
        $stmt->bindParam(':detenteur_actuel', $detenteur_actuel, PDO::PARAM_INT);
        $stmt->bindParam(':id_demande', $id_demande, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour supprimer une demande de la base de données par ID
    public function deleteDemande($id_demande) {
        $con= ConnexionBD::getInstanceT();
        $sql = "DELETE FROM Demande WHERE id_demande = :id_demande";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_demande', $id_demande, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour obtenir une demande par ID
    public function getDemandeById($id_demande) {
        $con= ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM Demande WHERE id_demande = :id_demande";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_demande', $id_demande, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

?>
