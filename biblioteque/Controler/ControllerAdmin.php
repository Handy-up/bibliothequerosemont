<?php

class Admin extends Controller
{
    private array $listesUtilisateurs;
    private array $listesLivres;

    private array $listeDemandeCle;

    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        $this->listesUtilisateurs = UtilisateurClassDao::showAll();
        $this->listesLivres = LivreClassDao::showAll();
        $this->listeDemandeCle = UtilisateurClassDao::ListedemadeCle();
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


    /**
     * @throws Exception
     */
    public function executerAction()
    {

        if (isset($_GET['page'])) {
            if ($_GET['page'] == "out"){
                unset($_SESSION['currentUser']);
                unset($_SESSION['currentUser_id']);
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