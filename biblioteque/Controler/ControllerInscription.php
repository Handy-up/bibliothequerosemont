<?php
include_once ("../Model/DAO/UtilisateurClassDao.php");
include_once ("../Model/User.php");
//Data

// Traitement

$redirect_url_connection = "../view/connection.php";
// Variable attendu
if (isset($_POST["inscription"])){
    $register_key = $_POST['cle_inscription'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pass_word = $_POST['mot_depasse'];
    $pass_word_bis = $_POST['mot_depasse_confirm'];
    $info = array($register_key,$nom,$prenom,$pass_word);
    //Data
    $user = UtilisateurClassDao::insert($info);
//    echo $user;

//    verification clè
    if (!$user or $pass_word != $pass_word_bis){
        $cle = 0;
        $pas = 0;

        if (!$user) {
            $cle = 1;
        }

        if ($pass_word != $pass_word_bis) {
            $pas = 1;
        }

// Encodage des données avant de les envoyer dans l'URL
        $encodedCle = urlencode(base64_encode($cle));
        $encodedPas = urlencode(base64_encode($pas));

// Construire l'URL avec les données encodées
        $redirect_url_inscription = "../view/inscription.php?cle=$encodedCle&pass=$encodedPas";
       header("Location: " . $redirect_url_inscription);
    }else{
        header("Location: " . $redirect_url_connection);
    }
}