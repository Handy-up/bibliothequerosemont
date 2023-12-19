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
        if (session_status() == PHP_SESSION_NONE) {
            // Démarrer la session seulement si elle n'est pas déjà active
            session_start();
        }
        $this->messagesErreur = [0];
        $this->listeDemandes = DemandeClassDao::showForDemande( $_SESSION['currentUser']->getId());
        $this->listeNotifications = NotificationClasseDAO::getNotificationById($_SESSION['currentUser']->getId());
    }


    public function getDemandes()
    {
        return $this->listeDemandes;
    }

    public function getNotifications()
    {
        return $this->listeNotifications;
    }

    /**
     * @throws Exception
     */
    public function getuserById($idUser): User
    {
        return UtilisateurClassDao::showFor($idUser);
    }

    public function getLivreById($idLivre): ?\Model\Livre
    {
        return LivreClassDao::showFor($idLivre);
    }

    /**
     * @throws Exception
     */
    public function executerAction(): string
    {
        if (isset($_GET['id'])){
            NotificationClasseDAO::setNotificationConst($_GET['id']);
        }

        if (isset($_POST['sharecodeValidation'])){
            if (strcasecmp($_POST['code_departage'], $_SESSION['currentUser']->getShareCode()) === 0) {
                DemandeClassDao::confirmerDemandeEtNotifier(
                    $_POST['id_demande'],
                    $_SESSION['currentUser']->getId()
                );
                $this->messagesErreur = ["L'échange est éfféctuer consulter votre Liste !",1];
            } else {
                $this->messagesErreur = ["Code de partage incorrecte!",0];
            }
        }

        if ($_SESSION['currentUser']->getId()==0){
            header('Location: index.php?action=admin&page=demande_admin');
            exit();
        }
        return "notification";
    }
}