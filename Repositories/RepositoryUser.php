<?php
require_once 'Repositories\database.php';
class UserRepository
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    // --------------------------   ADD User   --------------------------
    public function add(User $user)
    {
        $stmt = $this->db->prepare("
        INSERT INTO `users`(`username`, `email`, `password`, `bio`, `adresse`, `role`) 
        VALUES (:username, :email, :password, :bio, :adresse, :role)
        ");
        
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'bio' => $user->getBio(),
            'adresse' => $user->getAdresse(),
            'role' => $user->getRole()
        ]);
        
        return true; 
    }

    // --------------------------   ADD User   --------------------------
    public function Login($email, $password)
    {
        $stmt = $this->db->prepare("
        SELECT *
        FROM users
        WHERE email  = :email
        and password = :password
        ");
        
        $stmt->execute([
            'email' => $email,
            'password' => $password,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user; 
        }

        return false;
            
    }


}