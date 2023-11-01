<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';


require 'config.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST["create_user"])) {
        $user = new User();
        $user->user_name = $_POST['user_name'];
        $user->email = $_POST['email'];
        $user->active = $_POST['active'];
        $user->birthday = $_POST['birthday'];

        $user->create($conn);
   }

   if (isset($_POST["update_user"])) {
    $user = User::getByID($conn, $_POST["user_id"]);
    if($_POST['update_user_name'] != NULL) {
        $user->user_name = $_POST['update_user_name'];
    }
    if($_POST['update_email'] != NULL) {
        $user->email = $_POST['update_email'];
    }
    if($_POST['update_active'] != NULL) {
        $user->active = $_POST['update_active'];
    }
    if($_POST['update_birthday'] != NULL) {
        $user->birthday = $_POST['update_birthday'];
    }

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
   }

   if (isset($_POST["update_post"])) {
    $post = Post::getByID($conn, $_POST["post_id"]);
    if($_POST['user_id'] != NULL) {
        $post->user_id = $_POST['user_id'];
    }
    if($_POST['title'] != NULL) {
        $post->title = $_POST['title'];
    }
    if($_POST['content'] != NULL) {
        $post->content = $_POST['content'];
    }

    if($_POST['active'] != NULL) {
        $post->active = $_POST['active'];
        echo $post->active;
    }
    if($_POST['creation_date'] != NULL) {
        $post->creation_date = $_POST['creation_date'];
    }

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
        <h1 style="color: blue;">My app: admin control</h1>
    </header>

    <main>

    <?php require 'admin_func_form.php'; ?>

    </main>

</body>
</html>
