<?php
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
                <h5 class="card-title">5 demande</h5>
                <p class="card-text">En attende</p>
            </div>
        </div>
        <div class="card text-bg-secondary mb-3" style="width: 18rem;">
            <div class="card-header">Confirmation</div>
            <div class="card-body">
                <h5 class="card-title">5 demande</h5>
                <p class="card-text">En attende de confirmation</p>
            </div>
        </div>
        <div class="card text-bg-success mb-3" style="width: 18rem;">
            <div class="card-header">Liste</div>
            <div class="card-body">
                <h5 class="card-title">8 Ouvrage</h5>
                <p class="card-text">3 Porpriétaire</p>
            </div>
        </div>
        <div class="card text-bg-danger mb-3" style="width: 18rem;">
            <div class="card-header">Favoris</div>
            <div class="card-body">
                <h5 class="card-title">2 Ouvrage</h5>
                <p class="card-text">1 dans espace 1 vacant</p>
            </div>
        </div>
    </div>

    <br><h2>Expérience</h2><br>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Mon expérience 12 nov 2023 (ouvrage)
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Mon expérience 19 nov 2023 (ouvrage)
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Mon expérience 7 Dec 2023 (ouvrage)
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>
        <br>
        <button type="button" class="btn btn-primary float-end">Nouveau expérience</button>
        <br><br>
    </div>
<!--    End exp-->
    <br>
</div>



<?php
include("include/footer.php");
?>