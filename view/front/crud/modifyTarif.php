<?php
require_once '../../../model/Bdd.php';

// Verif de l'id
if (!isset($_GET['id_prestation']) || !isset($_GET['id_categorie'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$id_prestation = intval($_GET['id_prestation']); 
$id_categorie = intval($_GET['id_categorie']);   

$db = Database::getConnection();

// recup des informations du tarif
$query = "SELECT * FROM tarif WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
$stmt = $db->prepare($query);
$stmt->execute([
    ':id_prestation' => $id_prestation,
    ':id_categorie' => $id_categorie
]);

$tarif = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarif) {
    header("Location: ../../index.php?error=not_found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Tarif</title>
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
            <h3 class="text-center mb-3">Modifier un Tarif</h3>
            <form action="../../../controllers/controllerModify.php?action=Modify&table=tarif" method="POST">
                <div class="mb-3">
                    <input type="hidden" id="id_prestation" name="id_prestation" class="form-control" value="<?= htmlspecialchars($id_prestation) ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="id_categorie" name="id_categorie" class="form-control" value="<?= htmlspecialchars($id_categorie) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix :</label>
                    <input type="text" id="prix" name="prix" class="form-control" value="<?= htmlspecialchars($tarif['prix']) ?>" required>
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
