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
            $query = $con->prepare("INSERT INTO bibliotheque_departemental.Notification (destinataire, contenu, consulter) VALUES (?, ?, 0)");
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
            $query = $con->prepare("UPDATE bibliotheque_departemental.Notification SET consulter = 1 WHERE id_notification = ?");
            $query->execute(array($notification_id));
            $query->closeCursor();
            ConnexionBD::fermerConnexion();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
            return false;
        }
    }
}