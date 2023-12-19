<?php

use Model\Livre;

class Experience {
    // Attributs
    private $date_publication;
    private $utilisateur;
    private $contenu;
    private $livre;

    // Constructeur avec valeur par défaut pour la couleur si non spécifiée
    private $id;

    public function __construct($id,$date_publication,$utilisateur,$contenu,$livre) {
        $this->date_publication = $date_publication;
        $this->utilisateur = $utilisateur;
        $this->contenu = $contenu;
        $this->livre = $livre;
        $this->id=$id;
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
    public function set_date_publication($valeurDatePublication): void
    {
        $this->date_publication=$valeurDatePublication;
    }
    public function set_utilisateur($valeurUtilisateur): void
    {
        $this->utilisateur=$valeurUtilisateur;
    }
    public function set_contenu($valeurContenu): void
    {
        $this->contenu=$valeurContenu;
    }
    public function set_livre($valeurLivre): void
    {
        $this->livre=$valeurLivre;
    }

    public function getId(): int
    {
        // Retournez l'identifiant de l'expérience
        return $this->id;
    }

    // Méthodes spécifiques
    

    // Affichage
    public function __toString() {
    return "Experience ".$this->contenu;
    }
}
?>