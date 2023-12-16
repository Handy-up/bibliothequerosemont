<?php

class NotificationDao
{
    static public function createNotification($destinataire_id, $contenu)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            $query = $con->prepare("INSERT INTO notifications (destinataire_id, contenu, consultation, dateEnvoi) VALUES (?, ?, 0, NOW())");
            $query->execute(array($destinataire_id, $contenu));
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }

    static public function updateNotification($notification_id)
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        try {
            $query = $con->prepare("UPDATE notifications SET consultation = 1 WHERE id_notification = ?");
            $query->execute(array($notification_id));
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
            return false;
        }
    }

    // Ajoutez d'autres méthodes pour la gestion des notifications si nécessaire
}