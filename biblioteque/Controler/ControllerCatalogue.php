<?php
include_once "MainController.php";
include_once "Controller.abstract.php";

class Catalogue extends Controller
{
    private $top_new;
    private $listresult;

    private $message;

    public function __construct() {
        parent::__construct();
        $this->message = [0];
    }

    public function getTop()
    {
        return $this->top_new;
    }

    public function getUserInfo($id)
    {
        return UtilisateurClassDao::showFor($id);
    }

    public function getResult()
    {
        return $this->listresult;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function executerAction(): string
    {
        if (isset($_POST["rechercher"])) {
            $mot_cle = $_POST['mot_cle'];
            $result = null;
            try {
                $result = [
                    LivreClassDao::filterBooks($mot_cle),
                    LivreClassDao::filterBooks(null,$mot_cle),
                    LivreClassDao::filterBooks(null,null,$mot_cle),
                    LivreClassDao::filterBooks(null,null,null,$mot_cle)
                ];
            }catch (Exception $e){
                echo $e;
            }
            $cmpt = 0;
            foreach ($result as $livre){
                if ($livre){
                    $cmpt++;
                    $this->listresult = $livre;
                }
            }
            if ($cmpt==0){
                $this->messagesErreur= ["Aucun résultat pour $mot_cle"];
            }
        }

        if (isset($_POST['reservation'])){
            $id_detenteur = intval($_POST['id_detenteur']);
            $id_livre = intval($_POST['id_livre']);
            $id_demandeur = $_SESSION['currentUser']->getId();
            $this->message = [
                $id_detenteur,
                $id_livre,
                $id_livre
            ];
            LivreClassDao::creerDemandeEtNotifier($id_demandeur,$id_detenteur,$id_livre);
        }

        // AffiCher la home page
        return "catalogue";
    }
}
