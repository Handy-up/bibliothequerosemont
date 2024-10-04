<?php
global $controleur;
include_once "view/fonctions/components.php";

afficherNotificationsModals((array)$controleur->getAdminDemandes(), $controleur);
?>
