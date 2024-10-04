<?php
function showHeader($page): void
{
    switch ($page) {
        case "home":
        case "connection":
        case "inscription":
            include "view/include/header_offLine.php";
            break;
        case "admin":
            include "view/include/header_admin.php";
            break;
        default:
            include "view/include/header_onLine.php";
    }
}
