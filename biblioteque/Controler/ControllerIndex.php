<?php


include_once "../Model/DAO/ConnexionBD.php";


if (isset($_POST["pp"])) {
    $key =$_POST["pp"];
    $conn = ConnexionBD::getInstanceT();

    $querry = $conn->prepare("select * from bibliotheque_departemental.Livre where auteur=?");
    $querry->execute(array($key));
    $enr = $querry->fetchAll(PDO::FETCH_ASSOC);
    ConnexionBD::fermerConnexion();

    foreach ($enr as $enr) {
        $id_livre = $enr['id_livre'];
        $titre = $enr['titre'];
        $auteur = $enr['auteur'];
        $edition = $enr['edition'];
        $mots_cles = $enr['mots_cles'];
        $description = $enr['description'];
        $evaluations = $enr['evaluations'];
        $disponible = $enr['disponible'];
        $proprietaire = $enr['proprietaire'];
        $detenteur_actuel = $enr['detenteur_actuel'];
        $detenteur_precedent = $enr['detenteur_precedent'];

        // Effectuez ici le traitement nécessaire pour chaque colonne
        echo "ID Livre: $id_livre, Titre: $titre, Auteur: $auteur, Edition: $edition, Mots-clés: $mots_cles, Description: $description, Evaluations: $evaluations, Disponible: $disponible, Propriétaire: $proprietaire, Détenteur actuel: $detenteur_actuel, Détenteur précédent: $detenteur_precedent<br>";
    }


    // Utilisez le chemin relatif à votre serveur local
    //$redirect_url = "/PHP/biblioteque/view/catalogue.php?message=$enr";

    // Redirection vers la nouvelle page
    //header("Location: " . $redirect_url);

    // Affiche la valeur de $_POST["ref"] (facultatif)
    //echo $_POST["ref"];

    // Assurez-vous d'utiliser exit() après la redirection pour arrêter l'exécution du script immédiatement
    //exit();
}