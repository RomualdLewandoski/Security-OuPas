<?php

//CETTE PAGE DOIT ETRE UNIQUEMENT ACCESSIBLE
// PAR LES ADMINISTRATEURS
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
} else {
    if ($_SESSION['permission'] != 'admin') {
        header('Location: index.php');
    } else {
        echo "Affichage de la page admin";
    }
}