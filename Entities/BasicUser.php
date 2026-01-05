<?php
require_once 'Entities\User.php';
class BasicUser extends User 
{
    private $uploadCount;


    public function __construct($username,$email, $password, $adresse, $bio, $role='BasicUser', $uploadCount = 0)
    {
        parent::__construct($username,$email, $password, $adresse, $bio , $role);
        $this->uploadCount = $uploadCount;
    }


    public function getUploadCount(){ return $this->uploadCount; }
    public function getIsSuperAdmin(){ return Null;}
    public function getStartSubscription(){ return Null; }
    public function getEndSubscription(){ return Null; }
    public function getLevel(){ return NULL; }


}