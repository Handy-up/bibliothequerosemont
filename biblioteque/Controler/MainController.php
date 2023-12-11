<?php
class MainController
{
    public static function creerControleur($action) {
        $controleur = null;
        if ($action=="home") {
            $controleur = new Home();
        } elseif ($action == "connection"){
            $controleur = new Login();
        } elseif ($action == "inscription"){
            $controleur = new Inscription();
        }
        elseif ($action == "catalogue"){
            $controleur = new Catalogue();
        }
        else {
            $controleur = new Home();
        }
        return $controleur;
    }
}