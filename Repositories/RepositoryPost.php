<?php
require_once __DIR__. '/database.php';

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

    //test : essayer d'ajouter une image d'apres la furmulaire dans le fichier test.php
    //--------------------------      ADD POST    -----------------------
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


    //test : essayer d'ajouter une image d'apres la furmulaire dans le fichier test.php


    //-------------------------  ADD LIKE   --------------------------------
    public function addLike(Like $like){
        $stmt = $this->db->prepare("
        INSERT INTO `likes`(`user_id`, `post_id`) 
        VALUES (?, ?)
        ");
        
        $stmt->execute([
            $like->getUserID(),
            $like->getPostID()
        ]);   
        return true; 
    }

    //test : N’oubliez pas de commenter les inputs et les lignes inutiles avant d’exécuter le code.
    

}