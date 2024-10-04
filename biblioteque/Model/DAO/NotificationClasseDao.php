<?php
include_once "DAONotifications.php";

//Lleyton
class NotificationClasseDAO  implements DAONotifications {
    
    // Méthode pour sauvegarder une nouvelle notification dans la base de données
    static public function saveNotification($contenu, $id_destinataire) {
       $con= ConnexionBD::getInstanceT();
        $sql = "INSERT INTO bibliotheque_departemental.Notification (contenu, destinataire) VALUES (:contenu, :destinataire)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Méthode pour récupérer toutes les notifications de la base de données
    static public function getAllNotifications() {
        $con= ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM bibliotheque_departemental.Notification ORDER BY destinataire DESC";
        $stmt = $con->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Méthode pour mettre à jour une notification dans la base de données
    static public function updateNotification($id_notification, $contenu, $destinataire) {
        $con= ConnexionBD::getInstanceT();
        $sql = "UPDATE bibliotheque_departemental.Notification SET contenu = :contenu, destinataire = :destinataire WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_INT);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour supprimer une notification de la base de données par ID
    static public function deleteNotification($id_notification) {
        $con= ConnexionBD::getInstanceT();
        $sql = "DELETE FROM bibliotheque_departemental.Notification WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour obtenir une notification par ID destinataire
    static public function getNotificationById($id_destinataire) {
        $con = ConnexionBD::getInstanceT();
        $sql = "SELECT * FROM bibliotheque_departemental.Notification WHERE destinataire = :id_destinataire";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
        $stmt->execute();

        $notifications = [];  // Tableau pour stocker les objets Notification

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Création d'un nouvel objet Notification pour chaque ligne
            $notification = new Notification(
                $row['id_notification'],
                $row['date_envoie'],
                $row['destinataire'],
                $row['contenu'],
                $row['consulter']
            );
            $notifications[] = $notification;
        }
        return $notifications;
    }

    static public function setNotificationConst($id_notification): void
    {
        $con = ConnexionBD::getInstanceT();
        $sql = "UPDATE bibliotheque_departemental.Notification SET  consulter = 1 WHERE id_notification = :id_notification";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
