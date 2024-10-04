<?php
if (isset($controleur)) {
    $livres = $controleur->getListeLivreadmin();
}
?>

<div class="container">
    <div class="row">
        <?php foreach ($livres as $livre) : ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src='view/image/book_cover/<?php echo ($livre->getUrlCover() ? $livre->getUrlCover() : 'CoverNotAvailable.jpg'); ?>' class='img-fluid rounded-start' alt='<?php echo $livre->getDescription(); ?>'>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $livre->getTitle(); ?></h5>
                        <p class="card-text"><?php echo $livre->getDescription(); ?></p>
                        <p class="card-text"><small class="text-muted">Dernière mise à jour : <?php echo $livre->getEvaluation(); ?></small></p>

                        <!-- Formulaire avec un champ caché pour l'ID du livre -->
                        <form action="?action=admin&page=listeLivreAdmin" method="post">
                            <input type="hidden" name="id_livre" value="<?php echo $livre->getIdLivre(); ?>">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
