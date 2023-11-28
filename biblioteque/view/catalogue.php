<?php
require("include/header.php");
include_once ("../Model/Livre.php");
include_once ("../Model/User.php");
include_once ("components.php");

session_start();
if (!isset($_SESSION['currentUser'])){
    $redirect_url_connexion = "/PHP/biblioteque/view/connection.php";
    header("Location: " . $redirect_url_connexion);
}
$user  = $_SESSION['currentUser'];
$user_id = $_SESSION['currentUser_id'];
echo $user." User Id : ".$user_id;
?>


<div class="container-fluid banner_sh">

    <h2>CATALOGUE</h2>

    <form class="d-flex container-fluid w-50" role="search" method="post" action="../Controler/ControllerCatalogue.php">
        <input class="form-control me-2" type="search" placeholder="[Mots-clés] [Titre] [auteur] " aria-label="Search" name="mot_cle">
        <button class="btn btn-dark" type="submit" name="rechercher">Rechercher</button>
    </form>
</div>

<div class="container w-100 h-auto">
    <div class="container-fluid w-80 h-auto d-flex justify-content-center align-items-center card_list">
<!--        Cardes-->
        <?php
//        card($roman);
        ?>

    </div>
</div>
<!-- Exemple-->

<?php
include("include/footer.php");
?>

