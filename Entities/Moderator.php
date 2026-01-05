<?php
require_once 'Entities\User.php';

class Moderator extends User 
{
    private $heirarchical_level;

    public function __construct($username,$email, $password, $adresse, $heirarchical_level ,$bio , $role = 'Moderator')
    {
        parent::__construct($username,$email, $password, $adresse, $bio , $role);
        $this->heirarchical_level = $heirarchical_level;

    }


    public function getLevel(){ return $this->heirarchical_level; }
    public function getUploadCount(){ return NULL; }
    public function getIsSuperAdmin(){ return Null;}
    public function getStartSubscription(){ return Null; }
    public function getEndSubscription(){ return Null; }

}