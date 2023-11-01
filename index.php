<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';
require 'config.php';

function truncateText($text, $length) {
    if (strlen($text) > $length) {
        $text = substr($text, 0, $length);
        $text = rtrim($text, " \t\n\r\0\x0B") . '...'; 
    }
    return $text;
}

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

$postOfActiveUser = Post::getByActiveUser($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <style>
        ul {
            list-style: none; 
            padding: 0; 
        }

        li {
            width: 100%; 
            margin: 5px 0;
            background-color: #ffcccc; 
            padding: 10px; 
            border: 1px solid #ccc; 
        }
        .user-profile {
            display: inline-block;
            text-align: center;
            margin: 20px;
        }

        .user-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .username {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <header>
        <h1 style="color: blue;">My app <br></h1>
        <h1 style="color: blue;">Home</h1>
    </header>

    <nav>
        <ul>                
            <li><a href="/admin_func.php/">Admin</a></li>
            <?php
            $post = Post::getByBirthday($conn);
            if(empty($post)){
                $post = null;
            }
            else {
                $post =  $post[0]['id'];
            }
            ?>
            <li><a href="post.php?id=<?= $post; ?>">Get the last post of a user who have birthay this month</a></h2>
            <li><a href="statistics.php">Get statistics</a></h2>

        </ul>
    </nav>

    <main>

<?php if (empty($postOfActiveUser)) : ?>
    <p>No articles found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($postOfActiveUser as $post) : ?>
            <li>
                <div class="user-profile">
                    <img class="user-image" src="<?php echo htmlspecialchars('icon.jpg'); ?>" alt="<?php echo htmlspecialchars($post['user_name']); ?>">
                </div>
                <p class="username"><?php echo "user name:" . htmlspecialchars($post['user_name']); ?></p>
                <strong><a href="post.php?id=<?= $post['id']; ?>">title: <?= htmlspecialchars($post['title']); ?></a></strong>
                <p>content: <?= truncateText($post['content'], 100); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

</main>
</body>
</html>
