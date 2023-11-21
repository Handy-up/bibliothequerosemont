<?php
include_once ("../Model/DAO/UtilisateurClassDao.php");
include_once ("../Model/User.php");

//foreach ($user as $item){
//    echo "<br> $item </br>";
//}

// Traitement

$redirect_url_connection = "/PHP/biblioteque/view/profile.php";
// Variable attendu
if (isset($_POST["connect"])){

//    echo "form send";
    $identifient = $_POST['id_user'];
    $pass_word = $_POST['pass_user'];
    $id_pass = array($identifient,$pass_word);
    // Data
    $user = UtilisateurClassDao::showIf($id_pass);
    //    verification clè
    if (!isset($user)){
        $info = 1;

// Encodage des données avant de les envoyer dans l'URL
        $encodedCle = urlencode(base64_encode($info));
// Construire l'URL avec les données encodées
        $redirect_url_inscription = "/PHP/biblioteque/view/connection.php?cle=$encodedCle";
//        header("Location: " . $redirect_url_inscription);
    }else{
        session_start();
        $_SESSION['currentUser'] = $user[0];
        $redirect_url_profil = "/PHP/biblioteque/view/profile.php";
       header("Location: " . $redirect_url_profil);
    }
}