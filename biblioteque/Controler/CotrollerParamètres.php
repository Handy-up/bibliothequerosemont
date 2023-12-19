<?php

Class Params extends Controller {
    public function __construct() {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            // Démarrer la session seulement si elle n'est pas déjà active
            session_start();
        }
        $this->messagesErreur = [0];
    }

    public function executerAction(): string
    {
        $currentUser_id =null;

        if (isset($_SESSION['currentUser_id'])) {
            $currentUser_id = $_SESSION['currentUser_id'];
        }else{
            return "home";
        }

        if (isset($_POST["send_params"])) {
            // Récupérer les valeurs postées
            $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
            $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
//    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
            $passe_wrd = isset($_POST['passe_wrd']) ? $_POST['passe_wrd'] : '';
            $code_partage = isset($_POST['code_partage']) ? $_POST['code_partage'] : '';
            $userUpdate = new User(
                $currentUser_id,
                $nom,
                $prenom,
                $passe_wrd,
                null,
                $code_partage,
                '',
                date('Y-m-d H:i:s'),
                true,
                'valeur_de_fonction');

            // Utilisez ces variables comme bon vous semble, par exemple, pour les afficher
            try {
                echo $userUpdate;
                UtilisateurClassDao::update($userUpdate);
            }catch (Exception $e){
                echo "$e";
            }
//            echo "</br> ID  ".$currentUser_id;

            $userUpdate = UtilisateurClassDao::showFor($currentUser_id);
//            echo $userUpdate;
//            echo "</br> ";

            // Vous pouvez également les utiliser pour mettre à jour la base de données, etc.
            $_SESSION['currentUser'] = $userUpdate;
            // Redirection ou autre traitement après la soumission du formulaire
            $redirect_url_param = "/PHP/biblioteque/view/parametre.php";
            return "parametre";
            // exit();
        }

        if (isset($_POST['out'])) {
            unset($_SESSION['currentUser']);
            unset($_SESSION['currentUser_id']);
            // Détruire toutes les variables de session
            if (session_status() == PHP_SESSION_NONE) {
                // Démarrer la session seulement si elle n'est pas déjà active
                session_start();
            }
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


        return "parametre";
    }

}