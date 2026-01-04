<?php
class Post {
    private $imageName;
    private $title;
    private $description;
    private $status;
    private $views;

    public function __construct($imageName, $title, $description, $status = 'published', $views = 0){
        $this->imageName = $imageName;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->views = $views;
    }

    public function getimageName(){return $this->imageName;}
    public function getTitle(){return $this->title;}
    public function getDescription(){return $this->description;}
    public function getStatus(){return $this->status;}
    public function getViews(){return $this->views;}

}