<?php
class ProUser extends User 
{
    private $isSuperAdmin;

    public function __construct($username,$email, $password, $role, $adresse, $isSuperAdmin = true ,$bio = '')
    {
        parent::__construct($username,$email, $password, $role, $adresse, $bio = '');
        $this->isSuperAdmin = $isSuperAdmin;

    }


    public function getIsSuperAdmin(){ return $this->isSuperAdmin; }
}