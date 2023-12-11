<?php


Class Inscription extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function executerAction(): string
    {
//        $redirect_url_connection = "../view/connection.php";
// Variable attendu
        if (isset($_POST["inscription"])) {
            $register_key = $_POST['cle_inscription'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pass_word = $_POST['mot_depasse'];
            $pass_word_bis = $_POST['mot_depasse_confirm'];
            $info = array($register_key, $nom, $prenom, $pass_word);
            $valide = UtilisateurClassDao::valideKey($register_key);
            //Data
            $this->messagesErreur = [0,0];

//    verification clè
            if (!$valide or $pass_word != $pass_word_bis) {
                if ($pass_word != $pass_word_bis){
                    $this->messagesErreur[1] = 1;
                }else{
                    $this->messagesErreur[1] = 0;
                }

                if (!$valide){
                    $this->messagesErreur[0] = 1;
                }else{
                    $this->messagesErreur[0] = 0;
                }

            }
            else {
                try {
                    UtilisateurClassDao::insert($info);
                }catch (Exception $e){
                    $this->messagesErreur[0] = 1;
                }
            }
            if($this->getMessagesErreur()[0] == 0 and $this->getMessagesErreur()[1] == 0){
                $this->messagesErreur[] = "$nom Votre compte a été crée avec sucess";
                return "inscription";
            }
            return "inscription";
        }

        return "inscription";
    }

}