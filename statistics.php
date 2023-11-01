<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Post.php';
require 'config.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

$sql = "SELECT DATE(posts.creation_date) as date, HOUR(posts.creation_date) as hour, COUNT(posts.id) as count_post
FROM posts
GROUP BY date, hour;";

$results = $conn->query($sql);

$postOfHour = $results->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>
    <title>statistics</title>
    <meta charset="utf-8">
    <style>
        table, th, td {
            border: 1px solid grey;
        }
    </style>
</head>
<body>

<h1 style="color: blue;">Statistics</h1>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Hour</th>
            <th>count posts</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($postOfHour as $row) : ?>
            <tr>
            <td> <?php echo $row['date']; ?></td>
            <td> <?php echo $row['hour']; ?></td>
            <td> <?php echo $row['count_post']; ?></td>

            </tr>

        <?php endforeach; ?>
    </tbody>

</table>

</body>
</html>
