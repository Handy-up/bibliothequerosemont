<?php
require("include/header.php");
include_once ("../Model/Livre.php");
include_once ("../Model/User.php");
include_once ("components.php");
$user = new User("Jean","Pierre","1234","pierre.jpg","98kkf","9843kd",date("H:i:s"),true);
$roman= new \Model\Livre("La mere","Pierre","2 eme",array("Architecture ","Plage"), "Très belle ouvrage","book2.jpg","23",$user,$user,$user,123,true);
if (isset($_GET["message"])){
    $err = $_GET["message"];
    foreach ($err as $item){
        echo $item;
    }

}
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
        card($roman);
        ?>
    </div>
</div>
<?php
include("include/footer.php");
?>

