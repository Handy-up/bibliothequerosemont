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
            $result = null;
            try {
                $result = [
                    LivreClassDao::filterBooks($mot_cle,null,null,null),
                    LivreClassDao::filterBooks(null,$mot_cle,null,null),
                    LivreClassDao::filterBooks(null,null,$mot_cle,null),
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
        // AffiCher la home page
        return "catalogue";
    }
}
