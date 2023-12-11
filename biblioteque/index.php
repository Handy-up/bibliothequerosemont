<?php
include_once "Controler/MainController.php";
include_once "Controler/Home.php";
include_once "Controler/ControllerInscription.php";
include_once "Controler/ControllerLogin.php";
include_once "Controler/ControllerCatalogue.php";
include_once "Controler/CotrollerParamètres.php";
include_once "Controler/ControllerAdmin.php";
include_once "Controler/ControllerCompte.php";
include_once "Controler/ControllerNotification.php";
include_once "Controler/ControllerProfile.php";
include_once "Model/DAO/UtilisateurClassDao.php";
include_once "Model/DAO/LivreClassDao.php";
include_once "Model/User.php";
include_once "Model/Livre.php";
include_once "Model/Departement.php";
include_once "Model/Experience.php";
include_once "Model/Liste.php";
include_once "Model/Notification.php";
include_once "view/fonctions/message.php";
//Obtenir le bon controleur
if (!ISSET($_GET['action'])) {
    $action = "";
} else {
    $action = $_GET['action'];
}


$controleur = MainController::creerControleur($action);

// Executer l'action et obtener le nom de la vue
$nomVue=$controleur->executerAction();

//Header
require("view/fonctions/header_fonct.php");
showHeader($nomVue);
$allert = 0;

// inclure la bonne vue
echo "[Page "."view/".$nomVue.".php]";
//echo "Page :".$nomVue;
include_once("view/".$nomVue.".php");
?>
