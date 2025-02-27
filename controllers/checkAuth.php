<?php

// Vérifie si l'utilisateur est déjà sur la page de connexion pour éviter la boucle
$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['user_id']) && $current_page !== "index.php") {
    header("Location: ../../index.php?action=login");
    exit();
}
?>
