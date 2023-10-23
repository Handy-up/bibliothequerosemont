<?php
require ("include/header.php");
?>

<div class="container-fluid main_form">
    <div class="form_container">
        <h1>Se connecter</h1>
        <br>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Clé d'inscrition</label>
                <input type="password" class="form-control" id="exampleInputEmail1" placeholder="PH22098">
            </div>
            <div class="row g-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Votre nom" aria-label="Nom">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Votre prénom" aria-label="Prénom">
                </div>
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirmer password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Demander une nouvelle Clé</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="get" action="inscription.php">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label text-dark">Courriel</label>
                                    <input type="email" class="form-control border-black" id="recipient-name" name="message">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Faire la demande</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="" class="link-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                Demander une clé d'inscription?
            </a>

            <button type="submit" class="btn btn-primary float-end" name="go">Se connecter</button>
        </form>
    </div>
    <div class="banner_form">
        <?php
        if(isset($_GET["message"])){
            echo "<a>". $_GET["message"] ."</a>";
        }
        ?>
    </div>

</div>

<?php

require ("include/footer.php");
?>

