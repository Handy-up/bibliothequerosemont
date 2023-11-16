<?php

use Model\Livre;

class Experience {
    // Attributs
    private $date_publication;
    private $utilisateur;
    private $contenu;
    private $livre;

    // Constructeur avec valeur par défaut pour la couleur si non spécifiée
    public function __construct($date_publication,$utilisateur,$contenu,$livre) {
        $this->date_publication = $date_publication;
        $this->utilisateur = $utilisateur;
        $this->contenu = $contenu;
        $this->livre = $livre;
    }
    // Accesseurs
    public function get_date_publication() {
        return $this->date_publication;
    }
    public function get_utilisateur() {
        return $this->utilisateur;
    }
    public function get_contenu() {
        return $this->contenu;
    }
    public function get_livre() {
        return $this->livre;
    }
    
    // Mutateurs
    public function set_date_publication($valeurDatePublication) {
        $this->date_publication=$valeurDatePublication;
    }
    public function set_utilisateur($valeurUtilisateur) {
        $this->utilisateur=$valeurUtilisateur;
    }
    public function set_contenu($valeurContenu) {
        $this->contenu=$valeurContenu;
    }
    public function set_livre($valeurLivre) {
        $this->livre=$valeurLivre;
    }

    // Méthodes spécifiques
    

    // Affichage
    public function __toString() {
    return "Experience ".$this->contenu;
    }
}
?>