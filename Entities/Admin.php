<?php
require_once 'Entities\User.php';
class Admin extends User 
{
    private $isSuperAdmin;

    public function __construct($username,$email, $password, $adresse, $isSuperAdmin = true ,$bio, $role = 'Admin')
    {
        parent::__construct($username,$email, $password, $adresse, $bio , $role);
        $this->isSuperAdmin = $isSuperAdmin;

    }


    public function getIsSuperAdmin(){ return $this->isSuperAdmin; }
    public function getStartSubscription(){ return Null; }
    public function getEndSubscription(){ return Null; }
    public function getLevel(){ return NULL; }
    public function getUploadCount(){ return NULL; }


}