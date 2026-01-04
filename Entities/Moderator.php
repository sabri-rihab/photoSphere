<?php
class ProUser extends User 
{
    private $heirarchical_level;

    public function __construct($username,$email, $password, $role, $adresse, $heirarchical_level ,$bio = '')
    {
        parent::__construct($username,$email, $password, $role, $adresse, $bio = '');
        $this->heirarchical_level = $heirarchical_level;

    }


    public function getLevel(){ return $this->heirarchical_level; }
}