<?php

require_once 'Repositories\RepositoryUser.php';
require_once 'Entities\user.php';

// $pdo = Database::getConnection();
// echo "Connecté à la base de données !<br>";


// $result = $pdo->query("SELECT 'Hello' as test");
// $data = $result->fetch();
// echo $data['test'];

// $user = new User('rihab','rihab@gmail.com', 'rihab20025', 'BasicUser', 'Agadir');
// $repo = new UserRepository();
// $repo->add($user);




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
        image url : <input type="file" name='image' accept="image/jpg,image/png,image/gif">
        title : <input type="text" name="title">
        description : <input type="text" name="description">
        submit button : <button type='sybmit'>upload</button>
    </form>
</body>
</html>

<?php

?>









