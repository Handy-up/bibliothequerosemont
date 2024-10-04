# Bibliothèque départementale Cégep de Rosemont

## Description

Le département d’informatique du cégep dispose d’un ensemble de livres répartis entre les professeurs. Cette mini-bibliothèque fonctionne d’une manière différente des autres bibliothèques (municipale) : il n’y a pas de notion d’emprunt et donc pas de date de retour. Les professeurs détiennent les livres aussi longtemps qu’ils le jugent nécessaire et les livres passent d’un professeur à un autre sur une simple entente entre les professeurs.

## Contrainte

💡 Testé uniquement avec les environnements ci-dessous :

- Mac/Windows
- PhpMyAdmin
- XAMPP
- Configuration de base avec PhpStorm et outils
- Version de MySQL : 8.0.32

## Modèles

Consultez le fichier "Documentation" pour plus de détails.

## Installation

### Cloner le projet

Sur GitLab :

Sur GitHub :

### Création de la base de données

💡Dans la structure du projet il y a un fichier srcip.sql qui contien l’ensemble de requetes de creation de la base de donné

une mise en place de quelque procedure stoker pour vous permettre de préinsérer des donné dans la BD.

💡 Dans la structure du projet, un fichier `srcip.sql` contient l’ensemble des requêtes pour la création de la base de données ainsi que quelques procédures stockées pour préinsérer des données dans la BD.

- **Procédure d’insertion par défaut** : `inserer_livres_par_defaut()`

NB : La version de MySQL est importante. Sur une version antérieure ou ultérieure, la portabilité du script pourrait être compromise.

### Modifier les paramètres de l’application

Dans le fichier `/bibliotheque/Model/DAO/Config/ConfigBD.interface.php`, modifiez les valeurs comme suit :

```php
<?php
/** 
 * Interface pour la configuration de la base de données
 * Paramètres : hostname, userName, password, dataBaseName
 */
interface ConfigurationBD {
    const BD_HOST = "localhost";
    const BD_USER = "votre_nom_utilisateur";
    const BD_PASS_WORD = "votre_mot_de_passe";
    const BD_NAME = "bibliotheque_departementale";
}
?>
```

### Démarrer le projet

Par défaut, un administrateur de test a été créé automatiquement :

- **Nom d’utilisateur** : admin
- **Mot de passe** : root

## Auteurs et remerciements

- Pierre Handy Charles G
- Habimana Lleyton
- Assiobo Kossi Mawuli Eloge

## License

[Bibliothèque départementale Cégep](https://github.com/Handy-up/bibliothequerosemont.git) © 2023 par Handy, Lleyton, Eloge est sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)