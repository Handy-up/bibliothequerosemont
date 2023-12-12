<?php
if (!isset($controleur)) header("Location: ..\index.php");
require("include/header.php");
$page = "stat";
if (isset($_GET['page'])){
    $page = $_GET['page'];
}

?>

<div class="main-container">

    <div class="navcontainer">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?action=admin&page=stat">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?action=admin&page=utilisateur">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?action=admin&page=notification_admin">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?action=admin&page=out" >Quitter</a>
            </li>
        </ul>
    </div>



<!--    Main-->
    <div class="main">

        <div class="box-container">

                <div class="card text-bg-dark mb-3 box" style="max-width: 18rem;">
                    <div class="card-header">Utilisateurs</div>
                    <div class="card-body">
                        <h6 class="d-flex justify-content-end"><?php
                            date_default_timezone_set('UTC');
                            echo date("M-Y");
                            ?></h6>
                        <h5 class="card-title">Nombre d'utilisateurs</h5>
                        <h2 class="card-text "> <?php if (isset($controleur))echo count($controleur->getUsers()); ?></h2>
                    </div>
                </div>

            <div class="card text-bg-primary mb-3 box" style="max-width: 18rem;">
                <div class="card-header">Ouvrages</div>
                <div class="card-body">
                    <h6 class="d-flex justify-content-end"><?php
                        date_default_timezone_set('UTC');
                        echo date("M-Y");
                        ?></h6>
                    <h5 class="card-title">Livres du système</h5>
                    <h2 class="card-text "> <?php if (isset($controleur))echo count($controleur->getLivres()); ?></h2>
                </div>
            </div>

            <div class="card text-bg-success mb-3 box" style="max-width: 18rem;">
                <div class="card-header">Clé</div>
                <div class="card-body">
                    <h6 class="d-flex justify-content-end"><?php
                        date_default_timezone_set('UTC');
                        echo date("M-Y");
                        ?></h6>
                    <h5 class="card-title">Demandes de clé </h5>
                    <h2 class="card-text "> <?php if (isset($controleur))echo 12 ?></h2>
                </div>
            </div>

            <div class="card text-bg-warning mb-3 box" style="max-width: 18rem;">
                <div class="card-header">Comptes</div>
                <div class="card-body">

                    <div>
                        <span class="card-title">Utilisateurs actif</span>
                        <span class="card-text"> <strong><h4>12</h4></strong> </span>
                    </div>
                    <div>
                        <span class="card-title">Ouvrages disponible</span>
                        <span class="card-text"> <strong><h4>52</h4></strong> </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="report-container">
            <?php
            echo "Page : $page";
            include_once "view/include/".$page.".php";
            ?>
        </div>
<!--        end of main-->
    </div>
</div>

<?php
$dataPoints = array(
    array("y" => 12, "label" => "Janvier" ),
    array("y" => 5, "label" => "Février" ),
    array("y" => 5, "label" => "Mars" ),
    array("y" => 3, "label" => "Avril" ),
    array("y" => 34, "label" => "Mai" ),
    array("y" => 34, "label" => "Juin" ),
    array("y" => 63, "label" => "Juillet" ),
    array("y" => 63, "label" => "Aout" ),
    array("y" => 3, "label" => "Septembre" ),
    array("y" => 3, "label" => "Novembre" ),
    array("y" => 3, "label" => "Décembre" )
);
?>

<!-- Srcipt -->
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Échange enregistrer par mois"
            },
            axisY: {
                title: ""
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## livres échangers",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<?php
include("include/footer.php");
?>