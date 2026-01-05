<?php
abstract class User 
{
    protected $_id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $bio;
    protected $adresse;
    protected $created_at;
    protected $last_login;

    public function __construct($username,$email, $password, $role, $adresse, $bio)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);        
        $this->role = $role;
        $this->adresse = $adresse;
        $this->created_at = date('Y-m-d H:i:s');
        $this->last_login = date('Y-m-d H:i:s');
        $this->bio = $bio;
    }

    public function getUserID(){ return $this->_id; }
    public function getUsername(){ return $this->username; }
    public function getEmail(){ return $this->email; }
    public function getPassword(){ return $this->password; }
    public function getRole(){ return $this->role; }
    public function getBio(){ return $this->bio; }
    public function getAdresse(){ return $this->adresse; }
    public function getCreated_at(){ return $this->created_at; }
    public function getLastLogin(){ return $this->last_login; }
}