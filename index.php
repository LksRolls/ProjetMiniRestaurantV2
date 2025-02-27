<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/styles/style.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Connexion</h2>
                <form method="POST" action="index.php?action=login">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" name="mail" id="email" class="form-control" placeholder="Votre email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info">Se connecter</button>
                    </div>
                </form>
                <p class="text-center mt-3">
                    Vous n'avez pas de compte? <a href="View/Front/register.php" class="text-decoration-none">Inscrivez-vous</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
require_once 'Router/FrontRouter.php'; 
if (isset($_SESSION['user_id'])) {
    header("Location: view/front/home.php");
    exit();
}
$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new AuthController();

if ($action === 'register') {
    $controller->register(); // inscription
} elseif ($action === 'login') {
    $controller->login(); // connexion
}
?>

