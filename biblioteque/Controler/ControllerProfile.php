<?php

class Profile extends Controller
{
    private $listeDemandes;
    private $listeNotifications;

    public function __construct() {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            // Démarrer la session seulement si elle n'est pas déjà active
            session_start();
        }
        $this->messagesErreur = [0];
        $this->listeDemandes = DemandeClassDao::showForDemande( $_SESSION['currentUser']->getId());
        $this->listeNotifications = NotificationClasseDAO::getNotificationById($_SESSION['currentUser']->getId());
    }

    public function coutDemandes(): int
    {
        return count($this->listeDemandes);
    }

    public function coutNonConsultNotifs(): int
    {
        $unconsult = [];
        foreach ($this->listeNotifications as $notification){
            if ($notification->getConsultation() == 0){
                $unconsult[] = $notification;
            }
        }
        return count($unconsult);

    }

    public function countNotifications(): int
    {
        return count($this->listeNotifications);
    }

    public function executerAction()
    {
        return "profile";
    }
}