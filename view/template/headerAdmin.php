<?php

// avatar par defaut au cas ou probleme
$avatarPath = "../../Upload/default.jpg";

// verif utilisateurs connecte
if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) {
    $avatarPath = "../../" . $_SESSION['avatar'];
}
?>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom fixed-top">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="<?= htmlspecialchars($avatarPath) ?>" class="bi me-2 rounded-circle" alt="Bootstrap" width="75" height="75">
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="./home.php" class="nav-link px-2 link-dark">Acceuil</a></li>
        <li><a href="./home.php#Tarifs" class="nav-link px-2 link-dark">Tarifs</a></li>
        <li><a href="./administration.php" class="nav-link px-2 link-dark">Admin</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a class="btn btn-info m-3" href="user.php" type="button" id="Button">Profil</a>
        <a class="btn btn-info m-3" href="../../router/frontRouter.php?action=logout" type="button" id="Button">Déconnexion</a>

      </div>
    </header>
