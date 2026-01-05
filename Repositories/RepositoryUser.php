<?php
require_once 'Repositories\database.php';
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
        // if($user instanceof BasicUser){
        //     $stmt = $this->db->prepare("
        //     INSERT INTO `users`(`username`, `email`, `password`, `bio`, `adresse`, `role`, `uploadCount`) 
        //     VALUES (:username, :email, :passowrd, :bio, :adresse, :role, :uploadCount)
        //     ");
        // $stmt->execute([
        //     'username' => $user->getUsername(),
        //     'email' => $user->getEmail(),
        //     'password' => $user->getPassword(),
        //     'bio' => $user->getBio(),
        //     'adresse' => $user->getAdresse(),
        //     'role' => $user->getRole(),
        //     'uploadCount' => $user->getUploadCount(),
        // ]);

        // }
        // if($user instanceof ProUser){
        //     $stmt = $this->db->prepare("
        //     INSERT INTO `users`(`_id`, `username`, `email`, `password`, `bio`, `adresse`, `role`, `date_debut_abonnement`, `date_fin_abonnement`) 
        //     VALUES (:username, :email, :passowrd, :bio, :adresse, :role, :date_debut_abonnement, :date_fin_abonnement)
        //     ");
        // $stmt->execute([
        //     'username' => $user->getUsername(),
        //     'email' => $user->getEmail(),
        //     'password' => $user->getPassword(),
        //     'bio' => $user->getBio(),
        //     'adresse' => $user->getAdresse(),
        //     'role' => $user->getRole(),
        //     'date_debut_abonnement' => $user->getStartSubscription(),
        //     'date_fin_abonnement' => $user->getEndSubscription(),
        // ]);

        // }
        // if($user instanceof Moderator){
        //     $stmt = $this->db->prepare("
        //     INSERT INTO `users`(`_id`, `username`, `email`, `password`, `bio`, `adresse`, `role`, `heirarchical_level`) 
        //     VALUES (:username, :email, :passowrd, :bio, :adresse, :role, :heirarchical_level)
        //     ");
        // $stmt->execute([
        //     'username' => $user->getUsername(),
        //     'email' => $user->getEmail(),
        //     'password' => $user->getPassword(),
        //     'bio' => $user->getBio(),
        //     'adresse' => $user->getAdresse(),
        //     'role' => $user->getRole(),
        //     'heirarchical_level' => $user->getLevel(),
        // ]);

        // }
        // if($user instanceof Admin){
        //     $stmt = $this->db->prepare("
        //     INSERT INTO `users`(`_id`, `username`, `email`, `password`, `bio`, `adresse`, `role`, `isSuperAdmin`) 
        //     VALUES (:username, :email, :passowrd, :bio, :adresse, :role, :isSuperAdmin)
        //     ");

        //     $stmt->execute([
        //         'username' => $user->getUsername(),
        //         'email' => $user->getEmail(),
        //         'password' => $user->getPassword(),
        //         'bio' => $user->getBio(),
        //         'adresse' => $user->getAdresse(),
        //         'role' => $user->getRole(),
        //         'isSuperAdmin' => $user->getIsSuperAdmin()
        //     ]);
            
        // }
        
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