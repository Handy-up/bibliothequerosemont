<?php
//Commencé par Lleyton
class Departement {
    private $utilisateurs = [];
    private $administrateur;
    private $livres = [];
    private $listes = [];
    private $demande = [];
    private $notifications = [];

    public function __construct($utilisateurs, $administrateur, $livres, $listes, $demande, $notifications) {
        $this->utilisateurs = $utilisateurs;
        $this->administrateur = $administrateur;
        $this->livres = $livres;
        $this->listes = $listes;
        $this->demande = $demande;
        $this->notifications = $notifications;
    }

    public function getUtilisateurs() {
        return $this->utilisateurs;
    }

    public function setUtilisateur($utilisateur) {
        $this->utilisateurs[] = $utilisateur;
    }

    public function getAdministrateur() {
        return $this->administrateur;
    }

    public function envoyerNotification($notification, $destinataire) {
        $this->notifications[] = ["destinataire" => $destinataire, "notification" => $notification];
    }

    public function getLivres() {
        return $this->livres;
    }

    public function ajouterUnLivre($unLivre) {
        $this->livres[] = $unLivre;
    }

   

    public function setLivres($livres) {
        $this->livres = $livres;
    }

   

    public function rechercherUnLivre($criteres) {
        $resultats = [];

        foreach ($this->livres as $livre) {
            $correspondAuxCritères = true;
    
            foreach ($criteres as $critere => $valeur) {
                
                if (!isset($livre[$critere]) || $livre[$critere] !== $valeur) {
                    $correspondAuxCritères = false;
                    break; 
                }
            }
    
           
            if ($correspondAuxCritères) {
                $resultats[] = $livre;
            }
        }
    
        return $resultats;
    }

    public function getDemande() {
        return $this->demande;
    }

    public function setDemande($demande) {
        $this->demande = $demande;
    }

    public function getNotifications() {
        return $this->notifications;
    }

    public function setNotifications($notifications) {
        $this->notifications = $notifications;
    }
}
?>