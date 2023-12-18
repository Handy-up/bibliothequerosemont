<?php

class Admin extends Controller
{
    private array $listesUtilisateurs;
    private array $listesLivres;
    private array $listeDemandeCle;
    private $listeDemandes;
    private $listeNotifications;

    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        $this->listesUtilisateurs = UtilisateurClassDao::showAll();
        $this->listesLivres = LivreClassDao::showAll();
        $this->listeDemandeCle = UtilisateurClassDao::ListedemadeCle();
        $this->listeDemandes = DemandeClassDao::showForDemande( $_SESSION['currentUser']->getId());
        $this->listeNotifications = NotificationClasseDAO::getNotificationById($_SESSION['currentUser']->getId());
    }

    public function getUsers()
    {
        return $this->listesUtilisateurs;
    }

    function genererCleUnique(): int
    {
        return mt_rand(100, 999);
    }

    public function getLivres(): array
    {
        return $this->listesLivres;
    }

    public function demandeCle(): array
    {
        return $this->listeDemandeCle;
    }

    public function getuserById($idUser): User
    {
        return UtilisateurClassDao::showFor($idUser);
    }

    public function getAdminNotif()
    {
        return $this->listeNotifications;
    }

    public function getLivreById($idLivre): ?\Model\Livre
    {
        return LivreClassDao::showFor($idLivre);
    }

    public function getAdminDemandes()
    {
        return $this->listeDemandes;
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


    /**
     * @throws Exception
     */
    public function executerAction()
    {

        if (isset($_GET['page'])) {
            if ($_GET['page'] == "out"){
                // Détruire toutes les variables de session
                session_start();
                session_unset();
                session_destroy();

                // Facultatif : Supprimer le cookie de session côté client
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(
                        session_name(),
                        '',
                        time() - 42000,
                        $params["path"],
                        $params["domain"],
                        $params["secure"],
                        $params["httponly"]
                    );
                }

                return "home";
            }

            if (isset($_POST['accept_cle'])){
                $id_cle = $_POST['id_cle'];
                list($mail_cle) = explode('@', $_POST['email_cle']);
                $cle = $mail_cle .$this->genererCleUnique();
                UtilisateurClassDao::confirmDemadeCle($id_cle,$cle);
                header('Location: index.php?action=admin&page=cle');
                exit();
            }
        }
        return "admin";
    }
}