<?php
require_once 'database.php';
// require_once '/database.php';
require_once 'Entities\BasicUser.php';
require_once 'Entities\ProUser.php';
require_once 'Entities\Moderator.php';
require_once 'Entities\Admin.php';

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
        INSERT INTO `users`(`username`, `email`, `password`, `bio`, `adresse`, `role`, `uploadCount`, `isSuperAdmin`, `heirarchical_level`, `date_debut_abonnement`, `date_fin_abonnement`) 
        VALUES (:username, :email, :password, :bio, :adresse, :role, :uploadCount, :isSuperAdmin, :heirarchical_level, :date_debut_abonnement, :date_fin_abonnement)
        ");

        
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'bio' => $user->getBio(),
            'adresse' => $user->getAdresse(),
            'role' => $user->getRole(),
            'uploadCount' => $user->getUploadCount(),
            'isSuperAdmin' => $user->getIsSuperAdmin(),
            'heirarchical_level' => $user->getLevel(),
            'date_debut_abonnement' => $user->getStartSubscription(),
            'date_fin_abonnement' => $user->getEndSubscription()
        ]);
        
        return true; 
    }

    // --------------------------   Login   --------------------------
    public function Login($email, $password)
    {
        $stmt = $this->db->prepare("
        SELECT *
        FROM users
        WHERE email  = :email
        ");
        
        $stmt->execute([
            'email' => $email,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return "user not found or incorrect password";
        }


        switch ($user['role']) {
            case 'Admin':
                return new Admin(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['isSuperAdmin']
                );

            case 'Moderator':
                return new Moderator(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['heirarchical_level']
                );

            case 'ProUser':
                return new ProUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['date_debut_abonnement'],
                    $user['date_fin_abonnement']
                );

            case 'BasicUser':
                return new BasicUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['uploadCount']
                );
            default:
                return "user exist but i don't know what's the problem";
        }
                    
    }


}