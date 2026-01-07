<?php
require_once 'Interfaces\TagInterface.php';
require_once __DIR__. '/database.php';

final class RepositoryTag implements TagInterface
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    //-------------------------  ADD TAG   --------------------------------
    public function addTag(Tag $tag):void{
        $stmt = $this->db->prepare("
        INSERT INTO `tag`(`name`, `postCount`) 
        VALUES (?,?)
        ");
        
        $stmt->execute([
            $tag->getName(),
            $tag->getpostCount()
        ]);   
        return; 
    }

    //test : 
    // $repo = new RepositoryTag();
    // $tag = new Tag('winter');
    // $repo->addTag($tag);





    //-------------------------  REMOVE TAG   --------------------------------
    public function removeTag(string $tag):void
    {
        $stmt = $this->db->prepare("DELETE FROM `tag` WHERE name = :tag");
        $stmt->execute([':tag'=>$tag]);
        return;
    }

    //test
    // $repo = new RepositoryTag();
    // $repo->removeTag('winter')




    //-------------------------  GET TAGS (public -> non supprimer)  --------------------------------
    public function getTags(): array
    {
        $stmt = $this->db->prepare("SELECT * from tag where status = 'public'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // test
    // $repo = new RepositoryTag();
    // $tags = $repo->getTags();
    // foreach($tags as $t){
    //     $tag = new Tag($t['name'], $t['postCount']);
    //     $tag->read();
    //     echo "<br>";
    // }


    //-------------------------  get tag by id   --------------------------------
    public function getTagByID($_id){
        $stmt = $this->db->prepare("SELECT * from tag where _id = :_id");
        $stmt->execute([':_id' => $_id]);
        return $stmt->fetch();
    }



    //-------------------------  ADD TAG to post   --------------------------------
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

    //-------------------------     INCREMENT TAG COUNT     ----------------------
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

    // ---------------------    chack if TAG  exist   --------------------
    public function checkIfTagExist(string $tag): bool{
        $stmt = $this->db->prepare("
            SELECT * FROM `tag` t
            WHERE t.name = :tag
        ");
        $tag = strtolower($tag);
        $stmt->execute([
            ':tag' => $tag
        ]);
        return $stmt->rowCount() >= 1;
    }




    // ---------------------    Has TAG     --------------------
     public function hasTag(string $tag): bool
     {
        return true;
     }

    // ---------------------    clear TAG     --------------------
    public function clearTags(): void
    {
        $stmt = $this->$db->prepare;
        return ;
    }

}
