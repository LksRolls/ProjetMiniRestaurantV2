<?php 

$nom = "Cher utilisateur"; 

if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
    $nom = htmlspecialchars($_SESSION['nom'] . " " . $_SESSION['prenom']);
}
?>

<section class="hero-section d-flex align-items-center justify-content-center text-center text-white pt-5 vh-100">
    <div class="container pt-5">
        <h1 class="text-black display-4 fw-bold pt-5">Bienvenue <?php echo $nom; ?> </h1>
        <p class="lead text-black"><i class="fa-sharp fa-solid fa-arrow-down"></i> Découvrez nos tarifs ci-dessous. <i class="fa-sharp fa-solid fa-arrow-down"></i></p>
    </div>
</section>
