<?php

class Compte extends Controller
{
    private $liste;
    private $livres;

    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        if(ListeClasseDao::showFor($_SESSION['currentUser']->getId())){
            foreach (ListeClasseDao::showFor($_SESSION['currentUser']->getId()) as $id){
                $this->livres[] = LivreClassDao::showFor($id);
        }
        }

    }

    public function getUserInfo($id)
    {
        return UtilisateurClassDao::showFor($id);
    }

    public function getListe(): Liste
    {
        $this->liste = new Liste($_SESSION['currentUser'],$this->livres);
        return $this->liste;
    }

    public function executerAction(): string
    {
        return "compte";
    }
}