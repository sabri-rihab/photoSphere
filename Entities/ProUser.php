<?php
require_once 'Entities\User.php';

class ProUser extends User 
{
    private $date_start_subscription;
    private $date_end_subscription;


    public function __construct($username,$email, $password, $adresse ,$bio = 'hello', $date_start_subscription , $date_end_subscription)
    {
        parent::__construct($username,$email, $password, $adresse, $bio);
        $this->date_start_subscription = $date_start_subscription;//date('Y-m-d H:i:s');
        $this->date_end_subscription = $date_end_subscription ;//date('Y-m-d H:i:s');
    }

    public function getRole(){ return 'ProUser';}

    public function getStartSubscription(){ return $this->date_start_subscription; }
    public function getEndSubscription(){ return $this->date_end_subscription; }
    public function getLevel(){ return NULL; }
    public function getUploadCount(){ return NULL; }
    public function getIsSuperAdmin(){ return Null;}

}