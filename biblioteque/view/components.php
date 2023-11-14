<?php
function card(\Model\Livre $unLivre) : void {
    ?>
            <div class="col-md-3 image">
                <?php
                echo "<img src='image/book_cover/" . ($unLivre->getUrlCover() == null ? 'CoverNotAvailable.jpg' : $unLivre->getUrlCover()) . "' class='img-fluid rounded-start' alt='" . $unLivre->getDescription()."'>";
                ?>
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <?php
                    echo "<h5 class='card-title'>".$unLivre->getTitle()."</h5>";
                    echo "<p class='card-text float-right'>";
                    foreach ($unLivre->getKeyWords() as $key){
                        echo "<small class='text-body-dark'>". $key."</small>";
                    }
                    echo "</p>";
                    echo "<p class='card-text'>Description : ".$unLivre->getDescription()."</p>";
                    echo "<p class='card-text'><small class='text-body-secondary'> Disponibilité : " . ($unLivre->isStatus() ? 'Disponible' : 'Non Disponible') . "</small></p>";
                    ?>
                </div>
                <div class="d-flex justify-content-between action_card">
                    <span><?php echo "Propriétaire : ".$unLivre->getHost()->getFirstName()." ".$unLivre->getHost()->getLastName(); ?></span>
                    <form class="float-end" action="../Controler/ControllerIndex.php" method="post">
                        <button class="btn btn-dark" value="<?php echo $unLivre->getAuthor() ?>" type="submit" name="pp" <?php echo ($unLivre->isStatus()) ? '' : 'disabled'; ?>>Reserver</button>
                    </form>
                </div>
            </div>
    <?php
}


?>


