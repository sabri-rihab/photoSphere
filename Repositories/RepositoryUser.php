<?php
require_once 'database.php';
require_once 'Interfaces\userInterface.php';
require_once 'Factory\userFactoryTrait.php';
// require_once '/database.php';
require_once 'Entities\BasicUser.php';
require_once 'Entities\ProUser.php';
require_once 'Entities\Moderator.php';
require_once 'Entities\Admin.php';

class UserRepository implements UserInterface
{
    use UserFactoryTrait;
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
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

        // $this->createUserObject($user);
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
    //-------------------------     Find All Users      ----------------------------------
    public Function findAll():array
    {
        $stmt = $this->db->prepare("SELECT * FROM `users`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //-------------------------     Find User BY ID      ----------------------------------
    public Function findByID($_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `users` u WHERE u._id = :_id");
        $stmt->execute(['_id' => $_id]);
        $user = $stmt->fetch();
        // $this->createUserObject($user);
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
                return "No user was found" ;
        }

    }

    //-------------------------     Find User BY Role      ----------------------------------

    public Function findByRole($role)
    {
        $stmt = $this->db->prepare("SELECT * FROM `users` u WHERE u.role = 'BasicUser'");
        // $stmt->execute(['role' => $role]);
        $stmt->execute();
        $users = $stmt->fetchAll();
        // return $users;
        foreach($users as $user){
        switch ($user['role']) {
            case 'Admin':
                $users_array =  new Admin(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['isSuperAdmin']
                );
                break;
            case 'Moderator':
                $users_array =  new Moderator(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['heirarchical_level']
                );
                break;
            case 'ProUser':
                $users_array =  new ProUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['date_debut_abonnement'],
                    $user['date_fin_abonnement']
                );
                break;
            case 'BasicUser':
                $users_array =  new BasicUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['uploadCount']
                );
            default:
                return "No user was found!!!!!!!!!!!!" ;
                break;
        }
        }
        return $users_array;
    }

    public Function findByName($name)
    {
        return true;
    }

    public Function suspendUser()
    {
        return true;
    }
    public Function softDeletUser()
    {
        return true;
    }

}