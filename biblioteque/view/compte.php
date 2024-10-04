<?php if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
include_once "fonctions/components.php";
if (!isset($_SESSION['currentUser'])){
    $redirect_url_connexion = "/PHP/biblioteque/index.php";
    header("Location: " . $redirect_url_connexion);
}

$user  = $_SESSION['currentUser'];
$user_id = $_SESSION['currentUser_id'];


?>
<div class="container compte">
    <div class="d-flex justify-content-between w-50 tite_modal">
        <h2>Ma Bibliotèque</h2>
        <button type="button" class="btn btn-dark w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">Nouveau Livre</button>

        <form action="?action=compte" method="post">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau livre</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="imageTeleverse" class="form-label">Image</label>
                                    <input class="form-control form-control-sm" id="imageTeleverse" type="file" name="url_cover">
                                </div>
                                <div class="mb-3">
                                    <label for="titre" class="col-form-label">Titre</label>
                                    <input type="text" class="form-control" id="titre" placeholder="titre du livre" name="titre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="titre" class="col-form-label">Auteur</label>
                                    <input type="text" class="form-control" id="titre" placeholder="nom de l'auteur" name="auteur" required>
                                </div>
                                <div class="mb-3">
                                    <label for="titre" class="col-form-label">Édition</label>
                                    <input type="text" class="form-control" id="titre" placeholder="édition" name="edition" required>
                                </div>
                                <div class="mb-3">
                                    <label for="motsCles" class="col-form-label">Mots-clés</label>
                                    <textarea class="form-control" id="motsCles" placeholder="mot1,mot2.." name="mot_cle" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="col-form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" name="add_book">Soumettre</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr class="my-4 thicker-separator">

    <div class="container w-100 h-auto">
        <div class="container-fluid w-80 h-auto card_list">
            <!--        Cardes-->
            <?php
if (isset($controleur)) {

        $livreLis = $controleur->getListe();
        $livre = $livreLis->getLivres();
    if ($livre != null) {
        foreach ($livre as $data) {
            $host = $controleur->getUserInfo($data->getHost());
            $holder = $controleur->getUserInfo($data->getCurrentHolder());
            $lastHolder = $controleur->getUserInfo($data->getPreviousHolder());
            cardList($data, $host, $holder, $lastHolder);
        }
        echo "<br>";

    }else{
        echo "<h4 class='text-center'> Pas d'ouvrage dans votre liste actuelement ! </h4>";
    }
}
            ?>
        </div>
    </div>


</div>

<?php
include("include/footer.php");
?>