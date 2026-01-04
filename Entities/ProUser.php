<?php
class ProUser extends User 
{
    private $date_start_subscription;
    private $date_end_subscription;


    public function __construct($username,$email, $password, $role, $adresse, $date_start_subscription , $date_end_subscription ,$bio = '')
    {
        parent::__construct($username,$email, $password, $role, $adresse, $bio = '');
        $this->date_start_subscription = date('Y-m-d H:i:s');
        $this->date_end_subscription = $this->date_end_subscription;
    }


    public function getStartSubscription(){ return $this->date_start_subscription; }
    public function getEndSubscription(){ return $this->date_end_subscription; }
}