<?php
    session_start();
    // je verifie que l'utilisateur est connecté avec le pseudo & l'email
    if(!isset($_SESSION['pseudo']) && !isset($_SESSION['email'])){
        header('Location: login.php');
    }

    // je vais afficher le pseudo de l'utilisateur
    echo "Bienvenue ".$_SESSION['pseudo'];