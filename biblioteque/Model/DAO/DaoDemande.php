<?php
include_once("ConnexionBD.php");
interface DAODemande
{

    // Fonction pour afficher une table sans contraint
    static public function showAllRequest();

    // Fonction pour afficher avec une contrainte (mot clé)
    static public function showForDemande($id_detanteur);

    //Fonction pour filtrer selon des critères prend un tableau en paramètre
    static public function showIfDemande($conditions);

    //Fonction pour mettre a jour
    static public function updateDemande($id_demande);


    //Fonction pour supprimer
    static public function deleteDemande($id_demande);

}