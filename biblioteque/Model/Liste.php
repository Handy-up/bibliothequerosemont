
<?php
//Commencé par Lleyton
include_once("User.php");
class Liste {

    private User $utilisateur;
    private array $livres;

    public function __construct($utilisateur, $livres)
    {
        $this->utilisateur=$utilisateur;
        $this->livres = $livres;

    }
    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    public function getLivres() {
        return $this->livres;
    }

    public function setOuvrages($livres) {
        $this->livres = $livres;
    }

    public function ajouterOuvrage($livre) {
        $this->livres[] = $livre;
    }

    public function rendreDisponible($livre) {
         foreach ($this->livres as $key => $item) {
            if ($item === $livre) {
                // Marquer le livre comme disponible
                $this->livres[$key]['disponible'] = true;
                echo "Le livre est maintenant disponible.";
                return;
            }
        }
        echo "Livre non trouvé dans la liste.";
    }

    public function rendreIndisponible($livre) {
        foreach ($this->livres as $key => $item) {
            if ($item === $livre) {
                // Marquer le livre comme indisponible
                $this->livres[$key]['disponible'] = false;
                echo "Le livre est maintenant indisponible.";
                return;
            }
        }
        echo "Livre non trouvé dans la liste.";
    }

    public function supprimerLivre($livre) {
         foreach ($this->ouvrages as $key => $item) {
            if ($item === $livre) {
                unset($this->livres[$key]);
                echo "Le livre a été supprimé de la liste.";
                return;
            }
        }
        echo "Livre non trouvé dans la liste.";
    }

    public function rechercherDansLaListe($livre) {
        foreach ($this->livres as $item) {
            if ($item === $livre) {
                echo "Livre trouvé dans la liste.";
                return;
            }
        }
        echo "Livre non trouvé dans la liste.";
    }


    public function __toString(): string
    {
        $affichage = "";
        foreach ($this->livres as $livre) {
            $affichage .= $livre . " <br>";
        }
        return $affichage;
    }
}
?>