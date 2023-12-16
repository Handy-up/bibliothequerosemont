<?php

class Compte extends Controller
{
    private $liste;
    private $livres;


    /**
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
        if(ListeClasseDao::showFor($_SESSION['currentUser']->getId())){
            foreach (ListeClasseDao::showFor($_SESSION['currentUser']->getId()) as $id){
                if(LivreClassDao::showFor($id) != null){
                    $this->livres[] = LivreClassDao::showFor($id);
                }
        }
        }
    }

    public function genererIdentifiantUnique() {
        // Générer un identifiant unique avec uniqid()
        $uniqid = uniqid();

        // Calculer la valeur de hachage CRC32 de l'identifiant unique
        $crc32 = crc32($uniqid);

        // S'assurer que la valeur est toujours positive (crc32 peut retourner une valeur négative)
        $identifiantUnique = abs($crc32);

        // Limiter l'ID entre 10 et 100 en utilisant l'opérateur modulo (%)
        $identifiantUnique = $identifiantUnique % 91 + 10;

        return $identifiantUnique;
    }

    public function getUserInfo($id)
    {
        return UtilisateurClassDao::showFor($id);
    }

    public function getListe(): Liste
    {
        $this->liste = new Liste($_SESSION['currentUser'],$this->livres);
        return $this->liste;
    }

    public function executerAction(): string
    {
        if (isset($_POST['add_book'])){
            $url_cover = $_POST['url_cover'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $edition = $_POST['edition'];
            $mots_cle = explode(", ", $_POST['mot_cle']);
            $description =$_POST['description'];
            $livre = new \Model\Livre(
                $this->genererIdentifiantUnique(),
                $titre,
                $auteur,
                $edition,
                $mots_cle,
                $description,
                null,
                0,
                $_SESSION['currentUser']->getId(),
                $_SESSION['currentUser']->getId(),
                $_SESSION['currentUser']->getId(),
            false);
            LivreClassDao::insert($livre);
            ListeClasseDao::insert($livre->getIdLivre(),$_SESSION['currentUser']->getId());
        }
        return "compte";
    }
}