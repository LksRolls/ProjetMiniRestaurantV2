<?php
require_once '../../../model/Bdd.php';

// Verif de l'id
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$Id = intval($_GET['Id']); 
$db = Database::getConnection();

// recup des informations de la prestation
$query = "SELECT * FROM prestation WHERE id_prestation = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$prestation = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Prestation</title>
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
            <h3 class="text-center mb-3">Modifier une Prestation</h3>
            <form action="../../../controllers/controllerModify.php?action=Modify&table=prestation" method="POST">
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" class="form-control" value="<?= htmlspecialchars($Id) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="type_prestation" class="form-label">Type de Prestation :</label>
                    <input type="text" id="type_prestation" name="type_prestation" class="form-control" value="<?= htmlspecialchars($prestation['type_prestation']) ?>" required>
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
