<?php

require_once 'Repositories\RepositoryUser.php';
require_once 'Entities\BasicUser.php';
require_once 'Entities\ProUser.php';
require_once 'Entities\Moderator.php';
require_once 'Entities\Admin.php';

// $pdo = Database::getConnection();
// echo "Connecté à la base de données !<br>";


// $result = $pdo->query("SELECT 'Hello' as test");
// $data = $result->fetch();
// echo $data['test'];
//  `uploadCount`, `isSuperAdmin`, `heirarchical_level`, `date_debut_abonnement`, `date_fin_abonnement`
// $BasicUser = new BasicUser('rihab','rihab@gmail.com', 'rihab20025', 'Agadir', 'i am a basic user', 5);
// $BasicUser = new BasicUser('rihab', 'rihab@gmail.com', 'rihab20025', 'Agadir', 'i am a basic user', 5);
// $ProUser = new ProUser('tariq','tariq@gmail.com', 'rihab20025', 'Agadir', 'i am a pro user', date('2024-05-30'), date('2027-05-30'));
// $Mederator = new Moderator('hajar','hajar@gmail.com', 'rihab20025', 'Agadir','i am a moderator','senior', 'i am a moderator');
// $Admin = new Admin('aicha','aicha@gmail.com', 'rihab20025', 'Agadir', true, 'i am an admin');
// $repo = new UserRepository();
// $repo->add($BasicUser   );
// $repo->add($ProUser);
// $repo->add($Mederator);
// $repo->add($Admin);




// $repo = new UserRepository();
// var_dump($repo->login('rihab@gmail.com', '$2y$12$hprEFIaz89u8iERJqMt4Web47pWbNCxJzPbQV2MyQv/dbvVK.1oLm'));
// print_r($result);
// echo "$result";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="createPost.php" method="POST" enctype="multipart/form-data">
        <!-- image url : <input type="file" name='image' accept="image/jpg,image/png,image/gif">
        title : <input type="text" name="title">
        description : <input type="text" name="description">
        Comment : <input type="text" name="comment">
        Tag : <input type="text" name="tag"> -->
        email : <input type="text" name="email">
        password : <input type="password" name="password"> 
        submit button : <button type='submit'>upload</button>
    </form>
    
</body>
</html>

<?php

?>









