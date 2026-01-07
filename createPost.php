<?php
require_once 'Repositories\RepositoryPost.php';
require_once 'Repositories\RepositoryUser.php';
require_once 'Entities\image.php';
require_once 'Entities\Post.php';
require_once 'Entities\Comment.php';
require_once 'Entities\Tag.php';
require_once 'Entities\Like.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) 
{
$theImage = $_FILES['image'];
$title = $_POST['title'];
$description = $_POST['description'];
$comment = $_POST['comment'];
$tagName = $_POST['tag'];

if(!isset($theImage) || $theImage['error'] !== 0){
    die("no image uploaded!");
}

$imgType = strtolower(pathinfo($theImage['name'], PATHINFO_EXTENSION));
$imgName = uniqid('img_', true) . '.' . $imgType;
$imgSize = $theImage['size'];
$imgSizeInMO = round($theImage['size'] /(1024 * 1024), 2);
$dimension = getimagesize($theImage['tmp_name']);
$imgDimension = '1024';

$validTypes = ['jpg', 'png', 'gif'];

if($dimension !== false){
    $imgDimension = $dimension[0] . 'x' . $dimension[1];
}else{
    die('invalid img!!!');
}
if(!in_array($imgType, $validTypes)){
    die ('the image type is invalide!\n');
}
if($imgSizeInMO > 10){
    die('the image should be less than 10MO!');
}

$imagesFolder = 'images/';
if (!is_dir($imagesFolder)) {
    mkdir($uploadDir, 0755, true); 
}
$destinationPath = $imagesFolder . $imgName;
copy($_FILES['image']['tmp_name'], $destinationPath);


$image = new Image($imgName, $imgSize, $imgType, $imgDimension);
$post = new Post($imgName, $title, $description);
$comment1 = new Comment($comment,3,2);
$tag = new Tag($tagName);
$repo = new PostRepository;
$repo->addImage($image);
$repo->addPost($post);
$like = new Like(7,50);
$repo->addLike($like);


}