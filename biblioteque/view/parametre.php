<?php
require("include/header.php");
?>
<div class="container">
    <h2>Paramètres</h2>
    <hr class="my-4 thicker-separator">

    <div class="forme_params">
        <form action="">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" aria-describedby="basic-addon1" value="Assiobo" id="nom">
            </div>

            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" aria-describedby="basic-addon1" value="Eloge" id="prenom">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" aria-describedby="basic-addon1" value="0123456@qweerty.com" id="email">
            </div>

            <div class="form-group">
                <label for="mdp">Password</label>
                <input type="password" class="form-control" aria-describedby="basic-addon1" value="*******" id="mdp">
            </div>

            <div class="form-group">
                <label for="code">Code de partage</label>
                <input type="text" class="form-control" aria-describedby="basic-addon1" value="01234" id="code">
            </div>
            <br>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
            <br>
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary">Suspendre mon compte</button>
                <label for="">|</label>
                <button type="button" class="btn btn-outline-danger">Supprimer mon compte</button>
            </div>
        </form>
    </div>
</div>
<?php
include("include/footer.php");
?>