<?php
//Lleyton
class NotificationDAO {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Méthode pour sauvegarder une nouvelle notification dans la base de données
    public function saveNotification($message) {
        $sql = "INSERT INTO notification (contenu, destinataire) VALUES (:contenu, :destinataire)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':contenu', $message, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Méthode pour récupérer toutes les notifications de la base de données
    public function getAllNotifications() {
        $sql = "SELECT * FROM notification ORDER BY destinataire DESC";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Méthode pour mettre à jour une notification dans la base de données
    public function updateNotification($id_notification, $message, $destinataire) {
        $sql = "UPDATE notification SET contenu = :contenu, destinataire = :destinataire WHERE id_notification = :id_notification";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':contenu', $message, PDO::PARAM_STR);
        $stmt->bindParam(':destinataire', $destinataire, PDO::PARAM_STR);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour supprimer une notification de la base de données par ID
    public function deleteNotification($id_notification) {
        $sql = "DELETE FROM notification WHERE id_notification = :id_notification";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Méthode pour obtenir une notification par ID
    public function getNotificationById($id) {
        $sql = "SELECT * FROM notification WHERE id_notification = :id_notification";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_notification', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

?>
