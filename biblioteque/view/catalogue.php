<?php
require("include/header.php");
include_once ("../Model/Livre.php");
include_once ("../Model/User.php");
include_once ("components.php");

?>

<div class="container-fluid banner_sh">

    <h2>CATALOGUE</h2>

    <form class="d-flex container-fluid w-50" role="search">
        <input class="form-control me-2" type="search" placeholder="Mots-clés" aria-label="Search">
        <button class="btn btn-dark" type="submit">Rechercher</button>
    </form>
</div>

<div class="container w-100 h-auto">
    <div class="container-fluid w-80 h-auto d-flex justify-content-center align-items-center card_list">
<!--        Cardes-->
        <?php
//        card($roman);
        ?>
    </div>
</div>
<?php
include("include/footer.php");
?>

