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
        } elseif ($action == "catalogue"){
            $controleur = new Catalogue();
        } elseif ($action == "parametre") {
            $controleur = new Params();
        } elseif ($action == "admin") {
            $controleur = new Admin();
        } elseif ($action == "compte") {
            $controleur = new Compte();
        } elseif ($action == "profile") {
            $controleur = new Profile();
        } elseif ($action == "notification"){
            $controleur = new NotificationT();
        }
        else {
            $controleur = new Home();
        }
        return $controleur;
    }
}