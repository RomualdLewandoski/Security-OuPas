<?php

//CETTE PAGE DOIT ETER ACCESSIBLE POUR TOUT LES UTILISATEURS CONNECTES !
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
} else {
    echo "Affichage de la page profile";
}