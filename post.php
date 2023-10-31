<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';


require 'config.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $post = Post::getByID($conn, $_GET['id']);
} else {
    $post = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My app</title>
    <meta charset="utf-8">
</head>
<body>

    <header>
        <h1>My app</h1>
    </header>

    <main>

<?php if ($post) : ?>

    <article>
        <h2><?= htmlspecialchars($post->title); ?></h2>

        <p><?= htmlspecialchars($post->content); ?></p>
    </article>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

</main>
</body>
</html>
