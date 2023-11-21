<!--Pierre Handy page de connexion Je travaile sur cette page-->
<?php
require("include/header.php");
?>

<div class="container-fluid main_form">
    <div class="form_container">
        <h1>Se connecter</h1>
        <br>
        <form method="POST" action="../Controler/ControllerInscription.php">
            <div class="mb-3">
                <?php
                // Récupération des données depuis l'URL
                $encodedCle = isset($_GET['cle']) ? $_GET['cle'] : '';
                // Décodage des données
                $cle = base64_decode(urldecode($encodedCle));

                // Vérifier si les conditions d'erreur sont remplies
                if ($cle == 1) {
                    // Afficher un message d'erreur à côté du champ pour la clé
                    echo '<span class="error-message text-danger">Clé d\'inscription incorrecte</span>';
                }else{
                    echo '<span class="text-white">Clé d\'inscription</span>';
                }

                ?>

                <input type="password" class="form-control" id="cle_inscription" name="cle_inscription" placeholder="PH22098" required>
            </div>
            <div class="row g-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Votre nom" aria-label="Nom" name="nom" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Votre prénom" aria-label="Prénom" name="prenom" required>
                </div>
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password1" name="mot_depasse" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirmer password</label>
                <input type="password" class="form-control" id="password2" name="mot_depasse_confirm" required>

                <?php
                // Récupération des données depuis l'URL
                $encodedPas = isset($_GET['pass']) ? $_GET['pass'] : '';
                // Décodage des données
                $pas = base64_decode(urldecode($encodedPas));

                // Vérifier si la condition d'erreur est remplie
                if ($pas == 1) {
                    // Afficher un message d'erreur à côté du champ
                    echo '<span class="error-message text-danger">Les mots de passe ne correspondent pas</span>';
                }
                ?>
            </div>

            <br>
            <a href="" class="link-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                Demander une clé d'inscription?
            </a>

            <button type="submit" class="btn btn-primary float-end" name="inscription">Se connecter</button>
        </form>
<!--        Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Demander une nouvelle Clé</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../Controler/ControllerIndex.php">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label text-dark">Courriel</label>
                                <input type="email" class="form-control border-black" id="recipient-name" name="demande_mail">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="demande_de_cle">Faire la demande</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="banner_form">
    </div>

</div>

<?php

require("include/footer.php");
?>

