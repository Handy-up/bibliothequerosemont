<?php


include_once "../Model/DAO/ConnexionBD.php";


if (isset($_POST["pp"])) {
    $key =$_POST["pp"];
    $conn = ConnexionBD::getInstanceT();

    $querry = $conn->prepare("select * from bibliotheque_departemental.Livre where auteur=?");
    $querry->execute(array($key));
    $enr = $querry->fetchAll(PDO::FETCH_ASSOC);
    ConnexionBD::fermerConnexion();

    foreach ($enr as $enrT) {
        $id_livre = $enrT['id_livre'];
        $titre = $enrT['titre'];
        $auteur = $enrT['auteur'];
        $edition = $enrT['edition'];
        $mots_cles = $enrT['mots_cles'];
        $description = $enrT['description'];
        $evaluations = $enrT['evaluations'];
        $disponible = $enrT['disponible'];
        $proprietaire = $enrT['proprietaire'];
        $detenteur_actuel = $enrT['detenteur_actuel'];
        $detenteur_precedent = $enrT['detenteur_precedent'];

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