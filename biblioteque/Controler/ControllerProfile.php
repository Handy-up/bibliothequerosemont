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

    /**
     * @throws Exception
     */
    public function countDemandeSend(): int
    {
        return DemandeClassDao::countDemandeSend($_SESSION['currentUser']->getId());
    }

    /**
     * @throws Exception
     */
    public function coutListe(): int
    {
        return  count((array) ListeClasseDao::showFor($_SESSION['currentUser']->getId()));
    }

    /**
     * @throws Exception
     */
    public function coutLivreHost(): int
    {
        return  count((array) LivreClassDao::showOurnBook($_SESSION['currentUser']->getId()));
    }

    /**
     * @throws Exception
     */
    public function countDemande(): int
    {
        return count((array) DemandeClassDao::showForDemande($_SESSION['currentUser']->getId()));
    }



    public function executerAction()
    {
        return "profile";
    }
}