<?php
require_once 'Repositories\database.php';

class PostRepository
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function addImage(Image $image){
        $stmt = $this->db->prepare("
        INSERT INTO `image`(`name`, `size`, `type`, `dimension`) 
        VALUES (?,?,?,?)
        ");
        
        $stmt->execute([
            $image->getName(),
            $image->getSize(),
            $image->getType(),
            $image->getDimension()
        ]);   
        return true; 
    }

    public function addPost(Post $post){
        $stmt = $this->db->prepare("
        INSERT INTO `post`(`title`, `description`, `status`, `views`, `imgName`) 
        VALUES (?,?,?,?,?)
        ");
        
        $stmt->execute([
            $post->getTitle(),
            $post->getDescription(),
            $post->getStatus(),
            $post->getViews(),
            $post->getimageName()
        ]);   
        return true; 
    }
}