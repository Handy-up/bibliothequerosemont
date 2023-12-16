<?php
include_once("ConnexionBD.php");
interface DAOListe
{
    // implementation of CRUD methods

    // Fonction pour afficher une table sans contraint
    static public function showAll();

    // Fonction pour afficher avec un contrainte (mot clé)
    static public function showFor($id_user);

    //Fonction pour filtrer selon des critères prend un tableau en paramètre
    static public function showIf($conditions);

    //Fonction pour mettre a jour
    static public function update($news);

    //Foncrion pour ajouter
    static public function insert($id_livre,$id_utilisateur);

    //Fonction pour supprimer
    static public function delete($id_livre,$id_utilisateur);


}