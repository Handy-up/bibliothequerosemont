<?php if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");

$user  = $_SESSION['currentUser'];
$_SESSION['currentUser_id'] = $user->getId();
?>
<div class="container">
    <h2>Paramètres</h2>
    <hr class="my-4 thicker-separator">

    <div class="forme_params">
        <form method="post" action="?action=parametre">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control " aria-describedby="basic-addon1" value="<?php echo $user->getLastName(); ?>" name="nom">
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $user->getFirstName();?>" name="prenom">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" aria-describedby="basic-addon1" name="mail" value="0123456@qweerty.com" id="email">
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Password</label>
                <input type="password" class="form-control" aria-describedby="basic-addon1" name="passe_wrd" value="<?php echo $user->getPassword(); ?>" id="mdp">
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Code de partage</label>
                <input type="text" class="form-control" aria-describedby="basic-addon1" name="code_partage" value="<?php echo $user->getShareCode(); ?>" id="code">
            </div>
            <br>
            <div class="col-12">
                <button type="submit" name="send_params" class="btn btn-primary">Sauvegarder</button>
            </div>
            <br>
        </form>
    </div>
    <div class="col-12 d-flex justify-content-end w-auto">
        <button type="button" class="btn btn-outline-primary">Suspendre mon compte</button>
        <label style="margin: 5px">|</label>
        <form method="post" action="?action=parametre">
            <button type="submit" class="btn btn-outline-danger" name="out">Deconnection</button>
        </form>
    </div>
    <br>
</div>
<?php

include("include/footer.php");
?>