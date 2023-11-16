<?php
include_once("User.php");
class Liste {

    private User $utilisateur;
    private array $livres;

    public function __construct($utilisateur, $livres)
    {
        $this->utilisateur=$utilisateur;
        $this->livres = $livres;

    }

    
    




}
?>