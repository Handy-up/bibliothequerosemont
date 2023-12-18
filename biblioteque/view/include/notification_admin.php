<?php
global $controleur;
include_once "view/fonctions/components.php";

$notification = $controleur->coutNonConsultNotifs();
// As a link
echo '<nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <button type="button" class="btn btn-primary position-relative">
                Inbox
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    '.$notification.'
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </div>
    </nav>';

afficherNotifications((array)$controleur->getAdminNotif());
?>


