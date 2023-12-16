<?php

function alert($titre,  $content): void
{
    echo "<div class='container alert alert-success alert-dismissible fade show' role='alert'>";
    echo "<strong>".$titre."</strong> $content";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div> ";
}

function Warning($titre, $content): void
{
    echo "<div class='container alert alert-warning alert-dismissible fade show' role='alert'>";
    echo "<strong>".$titre."</strong> $content";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div> ";
}
