<?php
require_once '../../model/Bdd.php';

// verif si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "<p class='alert alert-warning text-center'>Vous devez être connecté pour voir les tarifs.</p>";
    return; // Stopper l'exécution si non connecté
}

$db = Database::getConnection();

// Récupére l'id_carte de l'utilisateur connecté
$query = "SELECT us.id_carte FROM usager us WHERE us.id_users = :id_users";
$stmt = $db->prepare($query);
$stmt->execute([':id_users' => $_SESSION['user_id']]);
$usager = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si l'usager existe et possède une carte
if ($usager && !empty($usager['id_carte'])) {
    $id_carte = $usager['id_carte'];

    // Récupére les tarifs selon la catégorie de l'usager
    $query = "SELECT ta.prix, pr.type_prestation
    FROM tarif AS ta
    INNER JOIN prestation AS pr ON ta.id_prestation = pr.id_prestation
    INNER JOIN categorie AS ca ON ca.id_categorie = ta.id_categorie
    INNER JOIN usager AS us ON us.id_categorie = ca.id_categorie
    WHERE us.id_carte = :id_carte
    ORDER BY pr.id_prestation";

    $stmt = $db->prepare($query);
    $stmt->execute([':id_carte' => $id_carte]);
    $tarifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si l'usager n'a pas de carte ou n'existe pas, récupérer les tarifs par défaut
    $query = "SELECT ta.prix, pr.type_prestation
    FROM tarif AS ta
    INNER JOIN prestation AS pr ON ta.id_prestation = pr.id_prestation
    INNER JOIN categorie AS ca ON ca.id_categorie = ta.id_categorie
    WHERE ta.id_categorie = 4
    ORDER BY pr.id_prestation";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $tarifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body>
    <section class="container my-4 pt-5" id="Tarifs">
        <h2 class="text-center mb-3 pt-5">Tarifs des Prestations</h2>

        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Type de prestation</th>
                    <th>Prix (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tarifs)): ?>
                    <?php foreach ($tarifs as $tarif) : ?>
                        <tr>
                            <td><?= htmlspecialchars($tarif['type_prestation']); ?></td>
                            <td><?= number_format($tarif['prix'], 2, ',', ' '); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-danger fw-bold">Aucun tarif disponible.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
