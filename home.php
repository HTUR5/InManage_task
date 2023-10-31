<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';
require 'config.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

$postOfActiveUser = Post::getByActiveUser($conn);

?>
<!DOCTYPE html>
<html>
<head>
    <title>home</title>
    <meta charset="utf-8">
    <style>
        ul {
            list-style: none; /* Remove bullet points */
            padding: 0; /* Remove default padding */
        }

        li {
            width: 100%; /* Set the width to 100% of the container */
            margin: 5px 0; /* Add spacing between list items */
            background-color: #f0f0f0; /* Background color for list items */
            padding: 10px; /* Add padding inside list items */
            border: 1px solid #ccc; /* Add a border to separate list items */
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
        <h1>home</h1>
    </header>

    <nav>
        <ul>                
            <li><a href="/index.php/">Admin</a></li>
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
                    <strong><?= htmlspecialchars($post['title']); ?></strong>
                    <p><?= htmlspecialchars($post['content']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

</main>
</body>
</html>
