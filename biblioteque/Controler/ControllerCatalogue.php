<?php
include_once ("../Model/DAO/LivreClassDao.php");
include_once ("../Model/Livre.php");

if (isset($_POST["rechercher"])) {
    $mot_cle = $_POST['mot_cle'];
    try {
        $livre = LivreClassDao::showFor($mot_cle);
        echo $livre;
    }catch (Exception $e){
        echo "$e";
    }
}