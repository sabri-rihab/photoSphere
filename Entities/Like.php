<?php
class Like {
    private $postID;
    private $userID;

    public function __construct($postID, $userID){
        $this->postID = $postID;
        $this->userID = $userID;
    }

    public function getPostID(){return $this->postID;}
    public function getUserID(){return $this->userID;}

}