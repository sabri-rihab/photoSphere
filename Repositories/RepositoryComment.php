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

    //------------------------    REMOVE COMMENT    -------------------------
    public function removeComment(int $_id){
        $stmt = $this->db->prepare("
        DELETE FROM `comments` 
        WHERE _id = :_id
        ");
        $stmt->execute([':_id'=>$_id]);
        return $stmt->rowCount() === 1;
    }
    
    
    //------------------------    get  COMMENTs count    -------------------------
    public function getComments(): array{
        $stmt = $this->db->prepare("SELECT * FROM `comments`");
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $comments_arr = [];
        foreach($comments as $com){
            $comments_arr[] = new Comment(
                $com['content'], 
                $com['post_id'], 
                $com['user_id'], 
                $com['status']
            ); 
        }

        return $comments_arr;
    }

    // test : 
    // $repo = new RepositoryComment();
    // $comments = $repo->getComments();
    // foreach($comments as $comment){
    //     $comment->read();
    // }



    //------------------- get comments by post _id => show user name, content and created_at    -----------------------------
        public function getCommentsByPostID($_id): array{
        $stmt = $this->db->prepare("
            SELECT u.username , c.content, c.created_at FROM `comments` c
            JOIN users u on  c.user_id = u._id
            WHERE c.post_id = :_id"
        );
        $stmt->execute([':_id'=>$_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //test:
    // $repo = new RepositoryComment();
    // $comments = $repo->getCommentsByPostID(5);
    // foreach($comments as $comment){
    //     echo "user : " . $comment['username'] . "\tcontent : " . $comment['content'] . "\twrote at : " . $comment['created_at'] ."\n";
    //     echo "<br>";
    // }


    
    //----------------------    get comments count  --------------------
    public function getCommentCount(): int{
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `comments`");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result[0];
    }


    //test : 
    // $repo = new RepositoryComment();
    // $count = $repo->getCommentCount();
    // echo 'total comments count is : '. $count ;

}