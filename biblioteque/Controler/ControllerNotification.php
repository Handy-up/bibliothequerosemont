<?php

class NotificationT extends Controller
{
    private $listeDemandes;
    private $listeNotifications;

    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        $this->listeDemandes = DemandeClassDao::showForDemande( $_SESSION['currentUser']->getId());
    }


    public function getDemandes()
    {
        return $this->listeDemandes;
    }

    public function executerAction()
    {
        return "notification";
    }
}