<?php
if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
include_once "fonctions/components.php";

if (!isset($_SESSION['currentUser'])){
    $redirect_url_connexion = "/PHP/biblioteque/index.php";
    header("Location: " . $redirect_url_connexion);
}
$user  = $_SESSION['currentUser'];
$user_id = $_SESSION['currentUser_id'];
//echo $user." User Id : ".$user_id;
if (count($controleur->getMessagesErreur())!=0){
    Warning("Recherche ! ",$controleur->getMessagesErreur()[0]);
}
?>


<div class="container-fluid banner_sh">

    <h2>CATALOGUE</h2>

    <form class="d-flex container-fluid w-50" role="search" method="post" action="?action=catalogue">
        <input class="form-control me-2" type="search" placeholder="[Mots-clés] [Titre] [auteur] " aria-label="Search" name="mot_cle">
        <button class="btn btn-dark" type="submit" name="rechercher">Rechercher</button>
    </form>
</div>

<div class="container w-100 h-auto">
    <div class="container-fluid w-80 h-auto d-flex justify-content-center align-items-center card_list">
<!--        Cardes-->
        <?php
        if ($controleur->getResult()){
            $livre = $controleur->getResult();

            $host = $controleur->getUserInfo($livre->getHost());
            $holder = $controleur->getUserInfo($livre->getCurrentHolder());
            $lastHolder = $controleur->getUserInfo($livre->getPreviousHolder());
//            echo $livre;
//            echo "<br>";
//            echo $host;
//            echo "<br>";
//            echo $holder;
//            echo "<br>";
//            echo $lastHolder;
//            modal("Moi",$lastHolder,"Ok");
            card($livre,$host,$holder,$lastHolder);
//            var_dump($livre,$host,$holder,$lastHolder);
//            card($controleur->getResult());
        }
        ?>

    </div>
</div>
<!-- Exemple-->

<?php
include("include/footer.php");
?>

