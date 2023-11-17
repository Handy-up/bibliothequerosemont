<?php
include_once ("../Model/DAO/UtilisateurClassDao.php");
include_once ("../Model/User.php");
//Data
$user = UtilisateurClassDao::showAll();

foreach ($user as $item){
    echo "<br> $item </br>";
}

// Traitement

$redirect_url_connection = "/PHP/biblioteque/view/connection.php";
// Variable attendu
if (isset($_POST["inscription"])){
    echo "form send";
    $register_key = $_POST['cle_inscription'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pass_word = $_POST['mot_depasse'];
    $pass_word_bis = $_POST['mot_depasse_confirm'];
//    verification clè
    $message = "";
    if ($register_key !="PHH" or $pass_word != $pass_word_bis){
        $cle = 0;
        $pas = 0;
        if ($register_key !="PHH"){
            $cle = 1;
        }
        if ($pass_word != $pass_word_bis){
            $pas = 1;
        }
        $redirect_url_inscription = "/PHP/biblioteque/view/inscription.php?cle=$cle&pass=$pas";
//        header("Location: " . $redirect_url_inscription);
    }else{
//        header("Location: " . $redirect_url_connection);
    }
}