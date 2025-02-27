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

// Verif que c'est bien creer pour etre sur qu'aucune erreur de redirection 
if ($action !== "Created") {
    header("Location: ../view/front/administration.php");
    exit();
}

// verif table OK
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    header("Location: ../view/front/administration.php");
    exit();
}

// creer en fonction de la table
function insertEntry($db, $table) {
    switch ($table) {
        case "categorie":
            if (!isset($_POST['libelle_categorie'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "INSERT INTO categorie (libelle_categorie) VALUES (:libelle)";
            $params = [":libelle" => $_POST['libelle_categorie']];
            break;

        case "droits":
            if (!isset($_POST['libelle_droits'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "INSERT INTO droits (libelle_droits) VALUES (:libelle)";
            $params = [":libelle" => $_POST['libelle_droits']];
            break;

        case "prestation":
            if (!isset($_POST['type_prestation'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "INSERT INTO prestation (type_prestation) VALUES (:type)";
            $params = [":type" => $_POST['type_prestation']];
            break;

        case "tarif":
            if (!isset($_POST['id_prestation'], $_POST['id_categorie'], $_POST['prix'])) {
                header("Location: ../view/front/administration.php");
                exit();
            }

            $query = "INSERT INTO tarif (id_prestation, id_categorie, prix) VALUES (:id_prestation, :id_categorie, :prix)";
            $params = [
                ":id_prestation" => $_POST['id_prestation'],
                ":id_categorie" => $_POST['id_categorie'],
                ":prix" => $_POST['prix']
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

// amj
insertEntry($db, $table);
?>
