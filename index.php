<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';


require 'config.php';

var_dump($_POST);
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST["create_user"])) {
        $user = new User();
        $user->user_name = $_POST['user_name'];
        $user->email = $_POST['email'];
        $user->active = $_POST['active'];

        $user->create($conn);
   }

   if (isset($_POST["update_user"])) {
    $user = User::getByID($conn, $_POST["update_user_id"]);
    $user->user_name = $_POST['update_user_name'];
    $user->email = $_POST['update_email'];
    $user->active = $_POST['update_active'];

    $user->update($conn);
    }   

    if (isset($_POST["delete_user"])) {
        $user = User::getByID($conn, $_POST["delete_user_id"]);
    
        $user->delete($conn);
    }
    
    if (isset($_POST["create_post"])) {
        $post = new Post();
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->active = $_POST['active'];
        $post->user_id = $_POST['post_user_id'];
        $post->creation_date = $_POST['creation_date'];

        $post->create($conn);
        echo "hi";
   }

   if (isset($_POST["update_post"])) {
    $post = Post::getByID($conn, $_POST["post_id"]);
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->active = $_POST['active'];

    $post->update($conn);
    }   

    if (isset($_POST["delete_post"])) {
        $post = Post::getByID($conn, $_POST["delete_post_id"]);
    
        $post->delete($conn);
    }  

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>My app: admin control</title>
    <meta charset="utf-8">
</head>

<body>

    <header>
        <h1>My app: admin control</h1>
    </header>

    <main>

    <?php require 'index_form.php'; ?>

    </main>

</body>
</html>
