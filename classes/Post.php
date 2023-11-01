<?php

/**
 * Post
 *
 * A piece of writing for publication
 */
class Post
{

    /**
     * Unique identifier
     * @var integer
     */
    public $id;

    /**
     * Unique identifier
     * FOREIGN KEY (user_id) REFERENCES Users(id)
     * @var integer
     */
    public $user_id;

    /**
     * The post title
     * @var string
     */
    public $title;

    /**
     * The article content
     * @var string
     */
    public $content;

    /**
     * The publication date and time
     * @var datetime
     */
    public $creation_date;

    /**
     * true if the user is active, otherwise false
     * @var boolean
     */
    public $active;

    /**
     * Get a page of post of active users
     *
     * @param object $conn Connection to the database
     *
     * @return array An associative array of the page of posts records
     */
    public static function getByActiveUser($conn)
    {
        $sql = "SELECT posts.*, users.user_name
        FROM posts
        JOIN users
        ON posts.user_id = users.id
        WHERE users.active = 'yes';";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the last post of a user who have birthday this month
     *
     * @param object $conn Connection to the database
     *
     * @return mixed An object of this class, or null if not found
     */
    public static function getByBirthday($conn)
    {
        $sql = "SELECT posts.*
        FROM posts
        JOIN users
        ON posts.user_id = users.id
        WHERE MONTH(users.birthday) = MONTH(CURDATE())
        ORDER BY posts.creation_date DESC
        LIMIT 1;";

        $post = $conn->query($sql);

        return $post->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get all the posts
     *
     * @param object $conn Connection to the database
     *
     * @return array An associative array of all the posts records
     */
    public static function getAll($conn)
    {
        $sql = "SELECT *
                FROM posts
                ORDER BY creation_date;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the post record based on the ID
     *
     * @param object $conn Connection to the database
     * @param integer $id the post ID
     * @param string $columns Optional list of columns for the select, defaults to *
     *
     * @return mixed An object of this class, or null if not found
     */
    public static function getByID($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns
                FROM posts
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');

        if ($stmt->execute()) {

            return $stmt->fetch();

        }
    }


    /**
     * Update the post with its current property values
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if the update was successful, false otherwise
     */
    public function update($conn)
    {
            $sql = "UPDATE posts
                    SET title = :title,
                        user_id = :user_id,
                        creation_date = :creation_date,
                        content = :content,
                        active = :active
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':active', $this->active, PDO::PARAM_STR);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
            $stmt->bindValue(':creation_date', $this->creation_date, PDO::PARAM_STR);

            return $stmt->execute();

    }

    // /**
    //  * Delete the current post
    //  *
    //  * @param object $conn Connection to the database
    //  *
    //  * @return boolean True if the delete was successful, false otherwise
    //  */
    public function delete($conn)
    {
        $sql = "DELETE FROM posts
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Insert a new post with its current property values
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if the insert was successful, false otherwise
     */
    public function create($conn)
    {
            $sql = "INSERT INTO posts (user_id, title, content, creation_date, active)
                    VALUES (:user_id, :title, :content, :creation_date, :active)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':active', $this->active, PDO::PARAM_STR);

            if ($this->creation_date == '') {
                $stmt->bindValue(':creation_date', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':creation_date', $this->creation_date, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }

    }

 
}
