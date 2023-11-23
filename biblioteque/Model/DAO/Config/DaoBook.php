<?php

interface DaoBook
{
    // implementation of CRUD methods

    // Fonction pour afficher une table sans contraint
    static public function showAll();

    // Fonction pour afficher avec un contrainte (mot clé)
    static public function showFor($keyWord);

    //Fonction pour filtrer selon des critères prend un tableau en paramètre
    static public function showIf($conditions);

    //Fonction pour mettre a jour
    static public function update($news);

    //Foncrion pour ajouter
    static public function insert($infoUtilisateur);

    //Fonction pour supprimer
    static public function delete($object);

    // recheche livre dans catalogue
    static public function filterBooks($title = null, $owner = null, $keyword = null, $currentHolder = null);
}