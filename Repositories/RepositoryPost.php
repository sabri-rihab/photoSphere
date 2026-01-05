<?php
require_once __DIR__. 'Repositories\database.php';

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

        public function addComment(Comment $comment){
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

        public function addLike(Like $like){
        $stmt = $this->db->prepare("
        INSERT INTO `likes`(`user_id`, `post_id`) 
        VALUES (?, ?)
        ");
        
        $stmt->execute([
            $like->getPostID(),
            $like->getUserID()
        ]);   
        return true; 
    }

        public function addTag(Tag $tag){
        $stmt = $this->db->prepare("
        INSERT INTO `tag`(`name`, `postCount`) 
        VALUES (?,?)
        ");
        
        $stmt->execute([
            $tag->getName(),
            $tag->getpostCount()
        ]);   
        return true; 
    }

    public function AddTagToPost($tag_id, $post_id){
        $stmt = $this->db->prepare("
        INSERT INTO `post_tag`(`tag_id`, `post_id`)
        VALUES (:tag_id, :post_id)
        ");
        
        $stmt->execute([
            'tag_id' => $tag_id,
            'post_id' => $post_id
        ]);   
        return true; 
    }
    public function incrementTagCount($tag_id){
        $stmt = $this->db->prepare("
        UPDATE tag
        SET tag.postCount = tag.postCount + 1
        WHERE tag._id = :tag_id
        ");
        
        $stmt->execute([
            'tag_id' => $tag_id
        ]);   
        return true; 
      
    }

}