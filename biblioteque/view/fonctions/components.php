<?php

function modal($title, $content, $btn, $modalId): void
{
    echo <<<PHP
    <a type="button" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-toggle="modal" data-bs-target="#$modalId">
        $btn
    </a>

    <div class="modal fade" id="$modalId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{$modalId}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{$modalId}Label">$title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    $content
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
PHP;
}

function inputModal($buttonText, $modalTitle, $modalId,$id_demade) {
    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '" data-bs-whatever="@mdo">' . $buttonText . '</button>';

    echo '
        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="' . $modalId . 'Label">' . $modalTitle . '</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="?action=notification">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Code de partage:</label>
                                <input type="text" class="form-control" id="recipient-name" name="code_departage" required>
                            </div>
                    </div>
                    <input type="hidden" name="id_demande" value="' . $id_demade . '">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="sharecodeValidation">Confirmer l\'échange</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>';
}




function card(\Model\Livre $unLivre, $host, $holder, $lastHolder): void
{
    echo "<div class='container cart_body'>";
    echo "<div class='col-md-3 image'>";
    echo "<img src='view/image/book_cover/" . ($unLivre->getUrlCover() == null ? 'CoverNotAvailable.jpg' : $unLivre->getUrlCover()) . "' class='img-fluid rounded-start' alt='" . $unLivre->getDescription() . "'>";
    echo "</div>";

    echo "<div class='col-md-9'>";
    echo "<div class='card-body'>";
    echo "<h3 class='card-title'>" . $unLivre->getTitle() . "</h3>";

    echo "<p class='card-text float-right'>";
    echo "Mots-clés :";
    foreach ($unLivre->getKeyWords() as $key) {
        echo "<small class='text-body-dark'>[" . $key . "]</small>";
    }
    echo "</p>";

    echo "<p class='card-text h-25'><strong>Description : </strong>" . $unLivre->getDescription() . "</p>";
    echo "<span><strong>Évaluation</strong></span>";
    echo "<div class='progress w-25' role='progressbar' aria-label='Info example' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>";
    echo "<div class='progress-bar bg-info text-dark' style='width: ".$unLivre->getEvaluation()."%'>".$unLivre->getEvaluation()."%</div>";
    echo "</div>";
    echo "<p class='card-text'><small class='text-body-secondary'><strong> Disponibilité :</strong> " . ($unLivre->isStatus() ? 'Disponible' : 'Non Disponible') . "</small></p>";
    echo "</div>";

    $modalIdHost = uniqid('modal_host'.$host->getId());
    echo "<span><strong>Propriétaire :</strong></span>";
    modal("Utilisateur", $host, ($host->getFirstName() . " " . $host->getLastName()),$modalIdHost);
    echo "<br>";

    $modalIdHolder = uniqid('modal_holder'.$holder->getId());
    echo "<span><strong>Détenteur actuel :</strong></span>";
    modal("Utilisateur", $holder, ($holder->getFirstName() . " " . $holder->getLastName()),$modalIdHolder);
    echo "<br>";

    $modalIdLastHolder = uniqid('modal_last_holder'.$lastHolder->getId());
    echo "<span><strong>Ex-détenteur :</strong></span>";
        modal("Utilisateur", $lastHolder, ($lastHolder->getFirstName() . " " . $lastHolder->getLastName()), $modalIdLastHolder);
        echo "<br>";

    echo "<form class='float-end' action='?action=catalogue' method='post'>";

    // Champs cachés pour stocker les informations nécessaires
    echo "<input type='hidden' name='id_detenteur' value='" . $holder->getId() . "'>";
    echo "<input type='hidden' name='id_livre' value='" . $unLivre->getIdLivre() . "'>";

    $buttonStatus = $unLivre->isStatus() ? '' : 'disabled';
    echo "<button class='btn btn-dark' value='" . $unLivre->getAuthor() . "' type='submit' name='reservation' $buttonStatus>Reserver</button>";
    echo "</form>";

    echo "</div>";
    echo "</div>";
    echo "</div>";
}

function cardList(\Model\Livre $unLivre, $host, $holder, $lastHolder): void
{
    echo "<div class='container cart_body'>";
    echo "<div class='col-md-3 image'>";
    echo "<img src='view/image/book_cover/" . ($unLivre->getUrlCover() == null ? 'CoverNotAvailable.jpg' : $unLivre->getUrlCover()) . "' class='img-fluid rounded-start' alt='" . $unLivre->getDescription() . "'>";
    echo "</div>";

    echo "<div class='col-md-9'>";
    echo "<div class='card-body'>";
    echo "<h3 class='card-title'>" . $unLivre->getTitle() . "</h3>";

    echo "<p class='card-text float-right'>";
    echo "Mots-clés :";
    foreach ($unLivre->getKeyWords() as $key) {
        echo "<small class='text-body-dark'>[" . $key . "]</small>";
    }
    echo "</p>";

    echo "<p class='card-text h-25'><strong>Description : </strong>" . $unLivre->getDescription() . "</p>";
    echo "<span><strong>Évaluation</strong></span>";
    echo "<div class='progress w-25' role='progressbar' aria-label='Info example' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>";
    echo "<div class='progress-bar bg-info text-dark' style='width: ".$unLivre->getEvaluation()."%'>".$unLivre->getEvaluation()."%</div>";
    echo "</div>";
    echo "<p class='card-text'><small class='text-body-secondary'><strong> Disponibilité :</strong> " . ($unLivre->isStatus() ? 'Disponible' : 'Non Disponible') . "</small></p>";
    echo "</div>";

    $modalIdHost = uniqid('modal_host_list'.$host->getId());
    echo "<span><strong>Propriétaire :</strong></span>";
    modal("Utilisateur", $host, ($host->getFirstName() . " " . $host->getLastName()),$modalIdHost);
    echo "<br>";

    $modalIdHolder = uniqid('modal_holder_list'.$holder->getId());
    echo "<span><strong>Détenteur actuel :</strong></span>";
    modal("Utilisateur", $holder, ($holder->getFirstName() . " " . $holder->getLastName()),$modalIdHolder);
    echo "<br>";

    $modalIdLastHolder = uniqid('modal_last_holder_list'.$lastHolder->getId());
    echo "<span><strong>Ex-détenteur :</strong></span>";
    if(!($lastHolder == $holder && $holder == $host && $lastHolder == $host)) {
        modal("Utilisateur", $lastHolder, ($lastHolder->getFirstName() . " " . $lastHolder->getLastName()), $modalIdLastHolder);
        echo "<br>";
    }else{
        echo " Pas encore été échanger.";
    }
    echo "<div class='action_card'>";
    echo "<form class='float-end' action='?action=reserver' method='post'>";
    $buttonStatus = $unLivre->isStatus() ? '' : 'disabled';
    echo "<button class='btn btn-dark' value='" . $unLivre->getAuthor() . "' type='submit' name='res' $buttonStatus>Modifier</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}


function afficherNotifications($notifications): void
{
    echo '<div class="container" id="my_notifs"> ';
    echo '    <hr class="my-4 thicker-separator">';
    echo '    <div class="list-group ">';

    foreach ($notifications as $notification) {
        echo '        <a href="?action=notification&id='.$notification->getIdNotif().'" class="list-group-item list-group-item-action ' . ($notification->getConsultation() ? '' : 'active') . '" aria-current="true">';
        echo '            <div class="d-flex w-100 justify-content-between">';
        echo '                <h5 class="mb-1">' . $_SESSION['currentUser']->getLastName() . '</h5>';
        echo '                <small>' . date('Y-m-d', strtotime($notification->getDateEnvoi())) . '</small>';
        echo '            </div>';
        echo '            <p class="mb-1">' . $notification->getContenu() . '</p>';
        echo '            <small>' . ($notification->getConsultation() ? 'Consulté' : 'Non consulté') . '</small>';
        echo '        </a>';
    }
    echo '    </div>';
    echo '</div>';
    echo '<br>';
}

function afficherNotificationsModals(array $listeDemandes, $controller): void
{
    if ($_SESSION['currentUser']->getId() == 0) {
        echo '<div class="container" id="my_demande" tabindex="-1">';
    } else {
        echo '<div class="container d-none" id="my_demande" tabindex="-1">';
    }
    echo '    <hr class="my-4 thicker-separator">';
    foreach ($listeDemandes as $demande) {

        echo '    <div class="modal-dialog demande">';
        echo '        <div class="modal-content">';
        echo '            <div class="modal-header">';
        echo '                <h5 class="modal-title"> '.
            $controller->getuserById(
                $demande->getIdDemandeur()
            )->getFirstName().' veut te faire un emprunt</h5>';
        echo '            </div>';
        echo '            <div class="modal-body">';
        echo '                <p>Informations de la demande : </p>';
        echo '                <span> <strong> Hey, salut ' . $controller->getuserById($demande->getIdDetenteur())->getFirstName() . '</span>';
        echo '                <span> voudrais tu emprunter le livre :  </strong>' . $controller->getLivreById($demande->getIdLivreDemande())  . '</span>';
        echo '                <span> <br>Demande envoyer le : ' . $demande->getDateEnvoie() . '</span>';
        echo '            </div>';
        echo '            <div class="modal-footer">';
        inputModal("Accepter", "Confirmation de l'échange ","modal".$demande->getIdDemande(),$demande->getIdDemande());
        echo '                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Refusé</button>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
    }
    echo '</div>';
    echo '<br>';
}


?>
