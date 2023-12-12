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

    $modalIdHost = uniqid('modal_host');
    echo "<span><strong>Propriétaire :</strong></span>";
    modal("Utilisateur", $host, ($host->getFirstName() . " " . $host->getLastName()),"modal_2");
    echo "<br>";

    $modalIdHolder = uniqid('modal_holder');
    echo "<span><strong>Détenteur actuel :</strong></span>";
    modal("Utilisateur", $holder, ($holder->getFirstName() . " " . $holder->getLastName()),"modal_1");
    echo "<br>";

    $modalIdLastHolder = uniqid('modal_last_holder');
    echo "<span><strong>Ex-détenteur :</strong></span>";
    modal("Utilisateur", $lastHolder, ($lastHolder->getFirstName() . " " . $lastHolder->getLastName()),"modal_0");
    echo "<br>";

    echo "<div class='action_card'>";
    echo "<form class='float-end' action='?action=reserver' method='post'>";
    $buttonStatus = $unLivre->isStatus() ? '' : 'disabled';
    echo "<button class='btn btn-dark' value='" . $unLivre->getAuthor() . "' type='submit' name='res' $buttonStatus>Reserver</button>";
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

    $modalIdHost = uniqid('modal_host');
    echo "<span><strong>Propriétaire :</strong></span>";
    modal("Utilisateur", $host, ($host->getFirstName() . " " . $host->getLastName()),"modal_2");
    echo "<br>";

    $modalIdHolder = uniqid('modal_holder');
    echo "<span><strong>Détenteur actuel :</strong></span>";
    modal("Utilisateur", $holder, ($holder->getFirstName() . " " . $holder->getLastName()),"modal_1");
    echo "<br>";

    $modalIdLastHolder = uniqid('modal_last_holder');
    echo "<span><strong>Ex-détenteur :</strong></span>";
    modal("Utilisateur", $lastHolder, ($lastHolder->getFirstName() . " " . $lastHolder->getLastName()),"modal_0");
    echo "<br>";

    echo "<div class='action_card'>";
    echo "<form class='float-end' action='?action=reserver' method='post'>";
    $buttonStatus = $unLivre->isStatus() ? '' : 'disabled';
    echo "<button class='btn btn-dark' value='" . $unLivre->getAuthor() . "' type='submit' name='res' $buttonStatus>Modifier</button>";
    echo "</form>";

    echo "</div>";
    echo "</div>";
    echo "</div>";
}


?>
