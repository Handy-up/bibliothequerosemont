<?php
  require ("include/header.php");
?>
<div class="container-fluid banner">
    <div class="container">
        <h1 class="title">BIBLIOTHÈQUE <br>DU DÉPARTEMENT</h1>
        <p class="context">
            Le service de la Bibliothèque du département de l’informatique
            a pourmission de permettre aux membres l’accès et l’utilisation
            de l’information et de la documentation dont il ont besoin
            pour les aider à réaliser certains des grands objectifs du Collège
            de Rosemont, cette espace d’échange a de nombreux fonctionalitéscomme : l’emprunt de document et l’analyse de ces documets.
        </p>

<!--        Modal test -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            En savoir plus
        </button>

<!--        Modal-->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog bg-dark">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Devloppeurs</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>PréNom</th>
                                <th>Profil</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> Pierre</td>
                                <td class="table-active">Handy Charles G</td>
                                <td>Full-Starck</td>
                            </tr>

                            <tr>
                                <td>Assiobo</td>
                                <td class="table-active">Kossi Mawuli Eloge</td>
                                <td>Full-Starck</td>
                            </tr>

                            <tr>
                                <td>Habimana</td>
                                <td class="table-active">Lleyton</td>
                                <td>Full-Starck</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
<!--        Fin Test-->

        <div class="illustration">
            <div class="circle_2"></div>
            <div class="circle_1"></div>
        </div>
    </div>
</div>
<?php
include ("include/footer.php");
?>
