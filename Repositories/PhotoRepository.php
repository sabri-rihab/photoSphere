<?php
require_once __DIR__. '/database.php';

final class PhotoRepository
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = Database::getConnection();
            $this->db->beginTransaction();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    // ADD POST
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

    //chack if tag exist
    public function ChackIfTagExist($tag){
        $stmt = $this->db->prepare("
            SELECT * FROM `tag` t
            WHERE t.name = :tag
        ");
        $tag = strtolower($tag);
        $stmt->execute([
            ':tag' => $tag
        ]);

        return $stmt->fetch();
    }

    // ADD TAG
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

    // update the tag postCount
    public function updateTagCount($name){
        $stmt = $this->db->prepare("
        UPDATE tag
        SET postCount = postCount + 1
        WHERE name = :name
        ");
      
        $stmt->execute([
            ':name' => $name
        ]);   
        return true; 
    }

    // GET TAG ID WITH NAME
    public function getTagID($name){
        $stmt = $this->db->prepare("SELECT `_id`FROM `tag` WHERE name = :name;");
        $stmt->execute([':name' => $name]);   
        $result = $stmt->fetch();
        return $result['_id'];
    }

    //get tag to post
    public function add_tag_to_post($post_id, $tag_id){
        $stmt = $this->db->prepare("
            INSERT INTO `post_tag`(`tag_id`, `post_id`) 
            VALUES (:post_id, :tag_id)
            ");

        $stmt->execute([
            ':post_id' => $post_id,
            ':tag_id' => $tag_id
        ]);
    }    

    public function AddTagToPost(Post $post, $tag_arr){
        $this->addPost($post);
        $tag_arr = array_unique($tag_arr);
        $tagCount = count($tag_arr);
        if($tagCount > 10){
            return false;
        }
        
        foreach($tag_arr as $tag){
            $result = $this->ChackIfTagExist($tag);
            if(empty($result)){
                $newTag = new Tag($tag);
                $this->addTag($newTag);
                $tag_id = $this->getTagID($name);
                // add_tag_to_post(, $tag_id);
            }
        }
    }
}
