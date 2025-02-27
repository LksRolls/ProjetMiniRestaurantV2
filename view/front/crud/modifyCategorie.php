<?php
require_once '../../../model/Bdd.php';

// Verif de l'id
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php");
    exit();
}

$Id = intval($_GET['Id']); 
$db = Database::getConnection();

// recup des informations de la catégorie
$query = "SELECT * FROM categorie WHERE id_categorie = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$categorie = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
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
            <h3 class="text-center mb-3">Modifier une Catégorie</h3>
            <form action="../../../controllers/controllerModify.php?action=Modify&table=categorie" method="POST">
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" class="form-control" value="<?= htmlspecialchars($Id) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="libelle_categorie" class="form-label">Nom de la Catégorie :</label>
                    <input type="text" id="libelle_categorie" name="libelle_categorie" class="form-control" value="<?= htmlspecialchars($categorie['libelle_categorie']) ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info">Modifier</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
