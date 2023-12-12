<?php

class Admin extends Controller
{
    private $listesUtilisateurs;
    private $listesLivres;
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        $this->listesUtilisateurs = UtilisateurClassDao::showAll();
        $this->listesLivres = LivreClassDao::showAll();
    }

    public function getUsers()
    {
        return $this->listesUtilisateurs;
    }

    public function getLivres()
    {
        return $this->listesLivres;
    }

    public function executerAction()
    {

        if (isset($_GET['page'])) {
            if ($_GET['page'] == "out"){
                unset($_SESSION['currentUser']);
                unset($_SESSION['currentUser_id']);
                return "home";
            }
        }
        return "admin";
    }
}