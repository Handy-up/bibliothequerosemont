<?php
if (isset($controleur))$users = $controleur->getUsers();

// Vérification des résultats de la requête
if ($users) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date d\'inscription</th>
                    <th scope="col">Code de partage</th>
                    <th scope="col">Clé d\'inscription</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';

    // Affichage des données dans le tableau
    foreach ($users as $user) {
        echo '<tr>
                <th scope="row">' . $user->getId() . '</th>
                <td>' . $user->getLastName() . '</td>
                <td>' . $user->getFirstName() . '</td>
                <td>' . $user->getRegistrationDate() . '</td>
                <td>' . $user->getShareCode() . '</td>
                <td>' . $user->getRegistrationKey() . '</td>
                <td>' . ($user->isStatus() ? "Actif" : "Inactif") . '</td>
                <td>' . $user->getFonction() . '</td>
                <td>
                    <button type="button" class="btn btn-primary">Action</button>
                </td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "Liste vide";
}

?>