<?php
require_once '../../../model/Bdd.php';

// Verif de l'id
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$Id = intval($_GET['Id']); 
$db = Database::getConnection();

// recup des informations de l'utilisateur
$query = "SELECT * FROM users WHERE id_users = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="btn btn-info mt-2 ms-5" href="../administration.php">Retour</a>
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-3">Modifier un Utilisateur</h3>
            <form action="../../../controllers/controllerModify.php?action=Modify&table=users" method="POST" enctype="multipart/form-data">               
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" class="form-control" value="<?= htmlspecialchars($Id) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Email :</label>
                    <input type="email" id="mail" name="mail" class="form-control" value="<?= htmlspecialchars($user['mail']) ?>" required>
                </div> 
                <div class="mb-3">
                    <label for="avatar" class="form-label">Photo de profil :</label>
                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*" onchange="previewAvatar(event)">
                    <img id="avatarPreview" src="#" class="mt-2 rounded-circle d-none" width="100" height="100" alt="Aperçu de l'avatar">
                </div>
                <div class="mb-3">
                    <label for="droits" class="form-label">Droits :</label>
                    <select id="droits" name="droits" class="form-select">
                        <option value="1" <?= ($user['droits'] == 1) ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= ($user['droits'] == 2) ? 'selected' : '' ?>>Utilisateur</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info">Modifier</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("avatarPreview");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add("d-none");
            }
        }
    </script>
</body>
</html>
