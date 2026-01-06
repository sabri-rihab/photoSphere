<?php
require_once 'Interfaces\CommentInterface.php';
require_once 'Entities\Comment.php';
require_once __DIR__. '/database.php';

class RepositoryComment implements CommentInterface
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    //-------------------------    ADD Comment     ----------------------
    public function addComment(Comment $comment)
    {
        $stmt = $this->db->prepare("
        INSERT INTO `comments`(`content`, `status`, `user_id`, `post_id`) 
        VALUES (?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $comment->getContent(),
            $comment->getStatus(),
            $comment->getUserID(),
            $comment->getPostID(),
        ]);   
        return true; 
    }
    public function removeComment(int $_id){
        $stmt = $this->db->prepare("
            DELETE FROM `comments` 
            WHERE _id = :_id
        ");
        $stmt->execute([':_id'=>$_id]);
        return $stmt->rowCount() === 1;
    }


    public function getComments(): array{
        $stmt = $this->db->prepare("SELECT * FROM `comments`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentCount(): int{}
}