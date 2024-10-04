<?php
if (isset($controleur)) {
    $cles = $controleur->listeCle();
}
?>
<table class="table caption-top">
    <caption>Liste des clés</caption>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Clé d'Inscription</th>
        <th scope="col">Date d'Expiration</th>
        <th scope="col">Email</th>
        <th scope="col">Décision</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Boucle à travers les résultats de la requête
    foreach ($cles as $cle) {
        echo "<tr>";
        echo "<td>" . $cle['id_cle'] . "</td>";
        echo "<td>" . $cle['cle_inscription'] . "</td>";
        echo "<td>" . $cle['date_dexpiration'] . "</td>";
        echo '<td><a href="mailto:' . $cle['email'] . '">' . $cle['email'] . '</a></td>';
        echo "<td>";

        // Formulaire pour envoyer l'ID de la clé
        echo '<form action="?action=admin&page=cle" method="post">';
        echo '<input type="hidden" name="id_cle" value="' . $cle['id_cle'] . '">';
        echo '<input type="hidden" name="email_cle" value="' . $cle['email'] . '">';
        echo '<button type="submit" name="accept_cle" class="btn btn-primary">Action</button>';
        echo '</form>';

        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
