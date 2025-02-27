<?php
require_once '../../../model/Bdd.php';

// Connexion bdd
$db = Database::getConnection();

// Récupération des prestations
$queryPrestations = "SELECT id_prestation, type_prestation FROM prestation";
$stmtPrestations = $db->query($queryPrestations);
$prestations = $stmtPrestations->fetchAll(PDO::FETCH_ASSOC);

// Récupération des catégories
$queryCategories = "SELECT id_categorie, libelle_categorie FROM categorie";
$stmtCategories = $db->query($queryCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Tarif</title>
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
            <h3 class="text-center mb-3">Ajouter un Tarif</h3>
            <form action="../../../controllers/controllerCreated.php?action=Created&table=tarif" method="POST">
            
                <div class="mb-3">
                    <label for="id_prestation" class="form-label">Prestation :</label>
                    <select id="id_prestation" name="id_prestation" class="form-select" required>
                        <option value="">-- Sélectionner une prestation --</option>
                        <?php foreach ($prestations as $prestation) : ?>
                            <option value="<?= htmlspecialchars($prestation['id_prestation']) ?>">
                                <?= htmlspecialchars($prestation['id_prestation'] . ' - ' . $prestation['type_prestation']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_categorie" class="form-label">Catégorie :</label>
                    <select id="id_categorie" name="id_categorie" class="form-select" required>
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>">
                                <?= htmlspecialchars($categorie['id_categorie'] . ' - ' . $categorie['libelle_categorie']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix :</label>
                    <input type="text" id="prix" name="prix" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
