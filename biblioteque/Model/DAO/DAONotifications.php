<?php
include_once("ConnexionBD.php");
interface DAONotifications
{

    static public function saveNotification($contenu, $id_destinataire);
    static public function getAllNotifications();

    static public function updateNotification($id_notification, $contenu, $destinataire);

    static public function deleteNotification($id_notification);

    static public function getNotificationById($id_destinataire);



}