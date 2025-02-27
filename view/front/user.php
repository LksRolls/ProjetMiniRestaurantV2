<?php
session_start();
require_once __DIR__ . '/../../model/Bdd.php';

$avatarPath = "../../default-avatar.png"; 
$nom = "Non renseigné";
$prenom = "Non renseigné";
$mail = "Non renseigné";
$libelle_droit = "Non défini"; 

if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) {
    $avatarPath = "../../" . $_SESSION['avatar'];
}

if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
}

if (isset($_SESSION['prenom'])) {
    $prenom = $_SESSION['prenom'];
}

if (isset($_SESSION['mail'])) {
    $mail = $_SESSION['mail'];
}

if (isset($_SESSION['droits'])) {
    $droits = $_SESSION['droits'];

    $db = Database::getConnection();
    $query = "SELECT libelle_droits FROM droits WHERE id_droits = :id_droits";
    
    try {
        $stmt = $db->prepare($query);
        $stmt->execute([':id_droits' => $droits]);
        $result = $stmt->fetch();

        if ($result) {
            $libelle_droit = $result['libelle_droits']; //maj que si resultat trouve
        }
    } catch (PDOException $e) {
        die("ERREUR LORS DE LA CONNEXION A LA BDD : " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body class="bg-light">
    <?php 
        require_once __DIR__ . '/../../controllers/checkAuth.php'; 

        if (isset($droits) && $droits == 1) {
            include '../template/headerAdmin.php'; 
        } else {
            include '../template/header.php'; 
        }
    ?>

    <div class="container py-5">
        <div class="row justify-content-center pt-5">
            <div class="col-md-6 pt-5">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <img src="<?= htmlspecialchars($avatarPath) ?>" alt="Photo de Profil" class="rounded-circle img-fluid border p-1" width="300" height="300">

                        <h2 class="mt-3 fs-1"><?= htmlspecialchars($nom) . " " . htmlspecialchars($prenom) ?></h2>
                        <p class="text-black mb-1 pt-2 fs-4"><?= htmlspecialchars($mail) ?></p>
                        <p class="text-black mb-1 pt-2 fs-4">Votre droit : <?= htmlspecialchars($libelle_droit) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
