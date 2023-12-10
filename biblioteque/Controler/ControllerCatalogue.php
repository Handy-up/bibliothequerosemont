<?php
include_once "MainController.php";
include_once "Controller.abstract.php";

class Catalogue extends Controller
{
    private $top_new;
    private $listresult;

    public function __construct() {
        parent::__construct();
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

    public function executerAction(): string
    {
        if (isset($_POST["rechercher"])) {
            $mot_cle = $_POST['mot_cle'];
            $livre = LivreClassDao::showFor($mot_cle);
            if ($livre){
                $this->listresult = $livre;
            }else{
                $this->messagesErreur= ["Aucun résultat pour $mot_cle"];
            }
        }
        // AffiCher la home page
        return "catalogue";
    }
}
