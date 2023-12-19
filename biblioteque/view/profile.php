<?php use Model\Livre;

if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
$user  = $_SESSION['currentUser'];
$_SESSION['currentUser_id'] = $user->getId();
?>

    <div class="container-fluid banner_profil">
        <div class="separateur"></div>
        <div class="info">
            <div>
                <span>Nom : </span> <span><?php echo $user->getLastName(); ?></span>
            </div>
            <div>
                <span>Prénom : </span> <span><?php echo $user->getFirstName();?></span>
            </div>
            <div>
                <span>Statut : </span> <span><?php echo $user->isStatus() ? 'Actif' : 'Inactif'; ?></span>
            </div>
            <div>
                <span>Membre depuis : </span> <span><?php
                    try {
                        $date = new DateTime($user->getRegistrationDate());
                        $dateFormatee = $date->format('Y-m-d');
                        echo $dateFormatee;
                    } catch (Exception $e) {
                    }
//                    echo $user->getRegistrationDate();
                    ?></span>
            </div>
            <br>
            <div>
                <span>Code de partage :</span> <span><?php echo $user->getShareCode(); ?></span>
            </div>
        </div>

        <div class="container profile_space">
            <?php
            // Vérifiez si l'utilisateur a une photo de profil définie
            $profilePhoto = $user->getProfilePhoto();
            $profilePhotoUrl = $profilePhoto ? $profilePhoto : 'view/image/defaultProfil.jpg';
            ?>
            <img src="<?php echo $profilePhotoUrl; ?>" class="rounded-circle" alt="...">
        </div>
    </div>

<div class="container main_user_activities">
    <br>
    <h2>Activitées</h2>
    <div class="activities d-flex justify-content-around">
        <div class="card text-bg-primary mb-3" style="width: 18rem;">
            <div class="card-header">Demande</div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                    if (isset($controleur)){
                        echo $controleur->countDemande();
                    }
                    ?>
                    demande</h5>
                <p class="card-text">En attende</p>
            </div>
        </div>
        <div class="card text-bg-secondary mb-3" style="width: 18rem;">
            <div class="card-header">Confirmation</div>
            <div class="card-body">
                <h5 class="card-title"><?php
                    if (isset($controleur)){
                        echo $controleur->countDemandeSend();
                    }
                    ?> demande</h5>
                <p class="card-text">En attende de confirmation</p>
            </div>
        </div>
        <div class="card text-bg-success mb-3" style="width: 18rem;">
            <div class="card-header">Liste</div>
            <div class="card-body">
                <h5 class="card-title"><?php
                    if (isset($controleur)){
                        echo $controleur->coutListe();
                    }
                    ?> Ouvrage</h5>
                <p class="card-text"><?php
                    if (isset($controleur)){
                        echo $controleur->coutLivreHost();
                    }
                    ?> Porpriétaire</p>
            </div>
        </div>
        <div class="card text-bg-danger mb-3" style="width: 18rem;">

            <div class="card-header">Notifications</div>
            <div class="card-body">
                <h5 class="card-title"><?php
                    if (isset($controleur)){
                        echo $controleur->coutNonConsultNotifs();
                    }
                    ?> notification non conculté</h5>
                <p class="card-text"><?php
                    if (isset($controleur)){
                        echo $controleur->countNotifications();
                    }
                    ?> notification</p>
            </div>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                <?php
                if (isset($controleur)){
                    echo $controleur->coutNonConsultNotifs();
                }
                ?>
                <span class="visually-hidden">unread messages</span>
  </span>
        </div>
    </div>

<!--    Expérience-->

    <?php
    // Exemple de données pour les utilisateurs, les livres et les expériences
    $user = $_SESSION['currentUser'];
    $id_livre = 1;
    $title = "Le Seigneur des Anneaux";
    $author = "J.R.R. Tolkien";
    $editor = "HarperCollins";
    $key_words = ["fantasy", "aventure", "anneaux"];
    $description = "Une épopée fantastique dans un monde imaginaire.";
    $cover = "path/to/cover.jpg";  // Remplacez par le chemin réel de l'image
    $evaluation = "90%";  // Remplacez par la valeur réelle
    $host_id = 123;  // Remplacez par l'ID réel de l'hôte
    $current_holder_id = 456;  // Remplacez par l'ID réel du détenteur actuel
    $previous_holder_id = 789;  // Remplacez par l'ID réel du détenteur précédent
    $status = true;  // Remplacez par la valeur réelle

    // Création d'une instance de Livre
    $livre = new Livre(
        $id_livre,
        $title,
        $author,
        $editor,
        $key_words,
        $description,
        $cover,
        $evaluation,
        $host_id,
        $current_holder_id,
        $previous_holder_id,
        $status
    );

    $experiences = array(
        new Experience(1,"12 nov 2023", $user, "Expérience 1", $livre),
        new Experience(2,"19 nov 2023", $user, "Expérience 2", $livre),
        new Experience(3,"7 Dec 2023", $user, "Expérience 3", $livre),
    );

    ?>

    <div class="container">
        <h2>Expérience</h2>
    <div class="accordion accordion-flush" id="accordionFlushExample">

        <?php foreach ($experiences as $key => $experience) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $key; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $key; ?>">
                        <?= "Mon expérience " . $experience->get_date_publication() . " (".$experience->get_livre()->getTitle().")"; ?>
                    </button>
                </h2>
                <div id="flush-collapse<?= $key; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <strong><?= $experience->get_contenu(); ?></strong>
                        <!-- Vous pouvez afficher d'autres détails de l'expérience ici -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
    <div class="float-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Partagé une Expérience</button>
    </div>

<!--    Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Partager mon expérience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                Livre de ma liste
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                <li><button class="dropdown-item" type="button">Action</button></li>
                                <li><button class="dropdown-item" type="button">Another action</button></li>
                                <li><button class="dropdown-item" type="button">Something else here</button></li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Expérience</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <br><br><br>





<?php
include("include/footer.php");
?>