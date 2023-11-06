<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Bibliothèque</title>
</head>
<body>

<?php
// Gestion des entetes
switch ($_SERVER["SCRIPT_NAME"]){
    case "/PHP/biblioteque/index.php":
    case "/PHP/biblioteque/connection.php":
    case "/PHP/biblioteque/inscription.php": include "header_offLine.php";
        break;
    case "/PHP/bibliothèque/admin.php":include "ok.php";
        break;
    default: include "header_onLine.php";
}
//echo $_SERVER["SCRIPT_NAME"]; biblioteque/index.php
?>
