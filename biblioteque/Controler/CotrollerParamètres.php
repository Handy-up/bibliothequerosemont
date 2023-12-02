<?php
include_once ("../Model/DAO/UtilisateurClassDao.php");
// Lien de redirection
$redirect_url_connection = "/PHP/biblioteque/view/parametre.php";

// Données récuperé
// Assurez-vous que la session est démarrée dans le fichier
session_start();
$currentUser_id =null;
// Vérifiez si l'utilisateur est connecté (vérifiez également les autres mesures de sécurité)
if (isset($_SESSION['currentUser_id'])) {
    $currentUser_id = $_SESSION['currentUser_id'];
}


// CotrollerParamètres.php

if (isset($_POST["send_params"])) {
    include_once ("../Model/User.php");
    // Récupérer les valeurs postées
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
//    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $passe_wrd = isset($_POST['passe_wrd']) ? $_POST['passe_wrd'] : '';
    $code_partage = isset($_POST['code_partage']) ? $_POST['code_partage'] : '';
    $userUpdate = new User(
        $currentUser_id,
        $nom,
        $prenom,
        $passe_wrd,
        null,
        $code_partage,
        '',
        date('Y-m-d H:i:s'),
        true,
        'valeur_de_fonction');

    // Utilisez ces variables comme bon vous semble, par exemple, pour les afficher
    try {
        echo $userUpdate;
        UtilisateurClassDao::update($userUpdate);
    }catch (Exception $e){
        echo "$e";
    }
    echo "</br> ID  ".$currentUser_id;

    $userUpdate = UtilisateurClassDao::showFor($currentUser_id);
    echo $userUpdate;
    echo "</br> ";

    // Vous pouvez également les utiliser pour mettre à jour la base de données, etc.
    $_SESSION['currentUser'] = $userUpdate;
    // Redirection ou autre traitement après la soumission du formulaire
    $redirect_url_param = "/PHP/biblioteque/view/parametre.php";
    header("Location: ".$redirect_url_param);
    // exit();
}

//log-out currentUser_id
$redirect_url_index = "/PHP/biblioteque/view/home.php";
if (isset($_POST['log-out'])) {
    echo "Yes";
    unset($_SESSION['currentUser']);
    unset($_SESSION['currentUser_id']);
    header("Location: ".$redirect_url_index);
}

