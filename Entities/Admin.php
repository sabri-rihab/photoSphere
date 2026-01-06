<?php
require_once 'Entities\User.php';
class Admin extends User 
{
    private $isSuperAdmin;

    public function __construct($username,$email, $password, $adresse, $isSuperAdmin = true ,$bio)
    {
        parent::__construct($username,$email, $password, $adresse, $bio );
        $this->isSuperAdmin = $isSuperAdmin;

    }

    
    
    public function getRole(){ return 'Admin';}
    public function getIsSuperAdmin(){ return $this->isSuperAdmin; }
    public function getStartSubscription(){ return Null; }
    public function getEndSubscription(){ return Null; }
    public function getLevel(){ return NULL; }
    public function getUploadCount(){ return NULL; }


}