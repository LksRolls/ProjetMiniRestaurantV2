<?php
require_once '../model/Bdd.php';

session_start();

// Verif si donnee min bien envoye
if (!isset($_GET['action']) || !isset($_GET['table'])) {
    header("Location: ../view/front/administration.php");
    exit();
}

$action = $_GET['action'];
$table = $_GET['table'];
$db = Database::getConnection();

// Verif que c'est bien modifeir pour etre sur qu'aucune erreur de redirection 
if ($action !== "Modify") {
    header("Location: ../view/front/administration.php");
    exit();
}

// verif table OK
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    header("Location: ../view/front/administration.php");
    exit();
}

// Modi en fonction de la table
function updateEntry($db, $table) {
    if (!isset($_POST['id'])) { 
        header("Location: ../view/front/administration.php");
        exit();
    }

    $Id = intval($_POST['id']); // secur logiqueent l'id

    switch ($table) {
        case "categorie":
            if (!isset($_POST['libelle_categorie'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "UPDATE categorie SET libelle_categorie = :libelle WHERE id_categorie = :id";
            $params = [":libelle" => $_POST['libelle_categorie'], ":id" => $Id];
            break;

        case "droits":
            if (!isset($_POST['libelle_droits'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }
            $query = "UPDATE droits SET libelle_droits = :libelle WHERE id_droits = :id";
            $params = [":libelle" => $_POST['libelle_droits'], ":id" => $Id];
            break;

        case "prestation":
            if (!isset($_POST['type_prestation'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }
            $query = "UPDATE prestation SET type_prestation = :type WHERE id_prestation = :id";
            $params = [":type" => $_POST['type_prestation'], ":id" => $Id];
            break;

        case "tarif":
            if (!isset($_POST['id_prestation'], $_POST['id_categorie'], $_POST['prix'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }
            $query = "UPDATE tarif SET prix = :prix WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
            $params = [
                ":id_prestation" => intval($_POST['id_prestation']),
                ":id_categorie" => intval($_POST['id_categorie']),
                ":prix" => floatval($_POST['prix'])
            ];
            break;

        case "users":
            if (!isset($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['droits'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail, droits = :droits WHERE id_users = :id";
            $params = [
                ":nom" => $_POST['nom'],
                ":prenom" => $_POST['prenom'],
                ":mail" => $_POST['mail'],
                ":droits" => $_POST['droits'],
                ":id" => $Id
            ];
            break;

        default:
        header("Location: ../view/front/administration.php");
        exit();
    }

    executeQuery($db, $query, $params);
}

// execute
function executeQuery($db, $query, $params) {
    try {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        header("Location: ../view/front/administration.php");
        exit();
    } catch (PDOException $e) {
        header("Location: ../view/front/administration.php");
        exit();
    }
}

// maj
updateEntry($db, $table);
