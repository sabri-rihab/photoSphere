<?php
class Comment {
    private $content;
    private $postID;
    private $userID;
    private $status;


    public function __construct($content, $postID, $userID, $status = 'published',){
        $this->content = $content;
        $this->postID = $postID;
        $this->userID = $userID;
        $this->status = $status;
    }

    public function getContent(){return $this->content;}
    public function getPostID(){return $this->postID;}
    public function getUserID(){return $this->userID;}
    public function getStatus(){return $this->status;}

    public function read(){
        echo "content : $this->content, postID : $this->postID, userID : $this->userID, status : $this->status\n";
        echo "<br>";
    }

}