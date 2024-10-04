<?php
if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
include_once "fonctions/components.php";
if (count($controleur->getMessagesErreur())>=2){
    if ($controleur->getMessagesErreur()[1]==0){
        Warning($controleur->getMessagesErreur()[0]," Essayer encore.");
    }else{
        alert($controleur->getMessagesErreur()[0]," Merci pour votre partage.");
    }
}
?>
    <br>
    <div class="container d-flex justify-content-between">
        <h2 id="titre">Notifications</h2>
        <div class="form-check form-switch align-self-end ">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault" id="labelNotif">Afficher les demandes</label>
        </div>
    </div>

<?php



afficherNotificationsModals((array)$controleur->getDemandes(), $controleur);

afficherNotifications((array)$controleur->getNotifications());

include("include/footer.php");
?>