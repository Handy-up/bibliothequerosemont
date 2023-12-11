<?php
include_once "Controller.abstract.php";

Class Login extends Controller {
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
    }

    public function executerAction()
    {
        if (isset($_POST["connect"])) {
//    echo "form send";
            $identifient = $_POST['id_user'];
            $pass_word = $_POST['pass_user'];
            $id_pass = array($identifient, $pass_word);
            // Data
            $user = UtilisateurClassDao::showIf($id_pass);
//            var_dump($user);
            //    verification de la connexion
            if (!$user) {

                $this->messagesErreur[0] = "Identifiant ou password incorrecte.";
                return "connection";
            } else {
                $this->messagesErreur[0] = 0;
//                session_start();
                $_SESSION['currentUser'] = $user[0];
                return "profile";
            }
        }
        return "connection";
    }

}