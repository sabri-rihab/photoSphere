<?php
class Tag 
{
    private $name;
    private $postCount;
    
    public function __construct($name, $postCount = 0){
        $this->name = $name;
        $this->postCount = $postCount;
    }

    public function getName(){ return $this->name ;}
    public function getpostCount(){ return $this->postCount ;}

    public function read(){
        echo "name : $this->name | postCpount : $this->postCount";
    }
}
