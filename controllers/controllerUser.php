<?php
require_once __DIR__ . '/../model/users.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new AuthController();

if ($action === 'register') {
    $controller->register();
} elseif ($action === 'login') {
    $controller->login();
}

class AuthController {
    public function showLoginForm() {
        require 'View/Front/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['password'], $_POST['droits'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['mail'];
                $password = $_POST['password'];
                $droits = $_POST['droits'];
                $imagePath = 'Upload/default.jpg'; // Image defaut au cas ou probleme
    
                if (isset($_FILES['avatar'])) {
                    $avatar = $_FILES['avatar'];
                    $imageNom = uniqid() . "_" . basename($avatar['name']);
                    $uploadDir = __DIR__ . '/../Upload/';
                    $uploadFilePath = $uploadDir . $imageNom;
                    move_uploaded_file($avatar['tmp_name'], $uploadFilePath);
                    $imagePath = 'Upload/' . $imageNom;
                }
    
                // Hash du mdp
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                // Creation de l'user avec model/users.php 
                $userModel = new User();
                if ($userModel->createUser($nom, $prenom, $email, $hashedPassword, $droits, $imagePath)) {
                    // redirection direct pour pas creer plusieurs fois
                    header("Location: ./index.php");
                    exit();
                } else {
                    echo "Erreur lors de l'inscription.";
                }
            } else {
                echo "Tous les champs sont requis.";
            }
        }
    }
    

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['mail']); 
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                echo "Tous les champs sont requis.";
                return;
            }

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id_users'];
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['avatar'] = !empty($user['avatar']) ? $user['avatar'] : "Upload/default.jpg";
                $_SESSION['droits'] = $user['droits'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];

                header("Location: ./view/front/home.php"); // Redirection après connexion
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    public function VerifAdmin() {
        session_start();
        if ($_SESSION['droits'] != 'admin') {
            header('Location: ./view/front/home.php');
            exit();
        }
    }
}
?>
