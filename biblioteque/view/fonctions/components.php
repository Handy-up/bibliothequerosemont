<?php

function modal($titre, $content, $btn): void
{
    echo <<<HTML
    <!-- Button trigger modal -->
    <a type="button" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        $btn
    </a>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">$titre</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    $content
                </div>
                <div class="modal-footer">
                    <!-- Modal footer buttons go here -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
         
                </div>
            </div>
        </div>
    </div>
HTML;
}

function card(\Model\Livre $unLivre, $host, $hosder, $lastHolder): void
{
    $urlCover = $unLivre->getUrlCover() ?: 'CoverNotAvailable.jpg';
    $availability = $unLivre->isStatus() ? 'Disponible' : 'Non Disponible';

    echo "Image URL: image/book_cover/$urlCover\n";
    echo "Title: {$unLivre->getTitle()}\n";

    echo "Keywords: ";
    foreach ($unLivre->getKeyWords() as $key) {
        echo "$key ";
    }
    echo "\n";

    echo "Description: {$unLivre->getDescription()}\n";
    echo "Availability: $availability\n";

    echo "Propriétaire: {$host->getLastName()} {$host->getFirstName()}\n";
    echo "Détenteur actuel: {$hosder->getLastName()} {$hosder->getFirstName()}\n";
    echo "Détenteur précédent: {$lastHolder->getLastName()} {$lastHolder->getFirstName()}\n";

    $buttonStatus = $unLivre->isStatus() ? '' : 'disabled';
    echo "Button Value: {$unLivre->getAuthor()}\n";
    echo "Button Status: $buttonStatus\n";

}



?>
