<?php
require_once __DIR__ . '/Bdd.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createUser($nom, $prenom, $email, $hashedPassword, $droits, $avatar = null) {
        try {
            $query = "INSERT INTO users (nom, prenom, mail, password, droits, avatar) 
                      VALUES (:nom, :prenom, :mail, :password, :droits, :avatar)";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':mail' => $email,
                ':password' => $hashedPassword,
                ':droits' => $droits,
                ':avatar' => $avatar  
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage(); 
            return false;
        }
    }

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE mail = :mail";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':mail' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }
    }
}
?>
