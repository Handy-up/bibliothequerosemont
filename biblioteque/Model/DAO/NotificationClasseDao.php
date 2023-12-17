<?php
//Lleyton
class NotificationClasseDAO {
    
    // Méthode pour sauvegarder une nouvelle notification dans la base de données
    public function saveNotification($contenu, $destinataire) {
       $con= ConnexionBD::getInstanceT();
        $sql = "INSERT INTO notification (contenu, destinataire) VALUES (:contenu, :destinataire)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Méthode pour récupérer toutes les notifications de la base de données
    public function getAllNotifications() {
        $con= ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM notification ORDER BY destinataire DESC";
        $stmt = $con->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Méthode pour mettre à jour une notification dans la base de données
    public function updateNotification($id_notification, $contenu, $destinataire) {
        $con= ConnexionBD::getInstanceT();
        $sql = "UPDATE notification SET contenu = :contenu, destinataire = :destinataire WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_INT);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour supprimer une notification de la base de données par ID
    public function deleteNotification($id_notification) {
        $con= ConnexionBD::getInstanceT();
        $sql = "DELETE FROM notification WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour obtenir une notification par ID
    public function getNotificationById($id) {
        $con= ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM notification WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_notification', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

?>
