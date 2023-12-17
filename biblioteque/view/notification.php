<?php
if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
include_once "fonctions/components.php";
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
// Exemple d'utilisation avec un tableau de notifications
$notifications = array(
    new Notification('2023-01-01 10:00:00', 'Utilisateur1', 'Contenu de la notification 1', false),
    new Notification('2023-01-02 12:30:00', 'Utilisateur2', 'Contenu de la notification 2', true),
    new Notification('2023-01-03 15:45:00', 'Utilisateur3', 'Contenu de la notification 3', false)
);

// Exemple d'utilisation avec une liste d'objets Demande
$listeDemandes = array(
    new Demande(1, 101, 201, 0, "2023-01-01 12:00:00"),
    new Demande(2, 102, 202, 1, "2023-01-02 14:30:00"),
    new Demande(3, 103, 203, 0, "2023-01-03 10:45:00")
);

afficherNotificationsModals((array)$controleur->getDemandes());

afficherNotifications($notifications);

include("include/footer.php");
?>