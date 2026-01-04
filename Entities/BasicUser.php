<?php
class BasicUser extends User 
{
    private $uploadCount;


    public function __construct($username,$email, $password, $role, $adresse, $bio = '', $uploadCount = 0)
    {
        parent::__construct($username,$email, $password, $role, $adresse, $bio = '');
        $this->uploadCount = $uploadCount;
    }


    public function getUploadCount(){ return $this->uploadCount; }
}