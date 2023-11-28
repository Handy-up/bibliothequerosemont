<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <title>Bibliothèque</title>
</head>
<body>

<?php
// Gestion des entêtes
$requestUri = $_SERVER["REQUEST_URI"];

// Utiliser parse_url pour diviser l'URL en composants
$urlComponents = parse_url($requestUri);

// Extraire le chemin du fichier
$path = $urlComponents['path'];

// Extraire le nom du fichier à partir du chemin
$page = basename($path);

// Utiliser DIRECTORY_SEPARATOR pour rendre le chemin portable
$separator = DIRECTORY_SEPARATOR;

switch ($page) {
    case "index.php":
    case "connection.php":
    case "inscription.php":
        include "header_offLine.php";
        break;
    case "admin.php":
        include "header_admin.php";
        break;
    default:
        include "header_onLine.php";
}
?>


