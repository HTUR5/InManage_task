<?php

/**
 * User
 *
 */
class User
{
    /**
     * Unique identifier
     * @var integer
     */
    public $id;

    /**
     * Unique username
     * @var string
     */
    public $user_name;

    /**
     * email
     * @var string
     */
    public $email;

    /**
     * true if the user is active, otherwise false
     * @var boolean
     */
    public $active;

    /**
     * The birthday date 
     * @var datetime
     */
    public $birthday;

    
    /**
     * Validation errors
     * @var array
     */
    public $errors = [];

    /**
     * Get all the users
     *
     * @param object $conn Connection to the database
     *
     * @return array An associative array of all the users records
     */
    public static function getAll($conn)
    {
        $sql = "SELECT *
                FROM users
                ORDER BY user_name;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the user record based on the ID
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
                FROM users
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        if ($stmt->execute()) {

            return $stmt->fetch();

        }
    }


    /**
     * Update the user with its current property values
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if the update was successful, false otherwise
     */
    public function update($conn)
    {
            $sql = "UPDATE users
                    SET user_name = :user_name,
                        email = :email,
                        active = :active,
                        birthday = :birthday
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':active', $this->active, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
             $stmt->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);

            return $stmt->execute();
    }

    // /**
    //  * Delete the current user
    //  *
    //  * @param object $conn Connection to the database
    //  *
    //  * @return boolean True if the delete was successful, false otherwise
    //  */
    public function delete($conn)
    {
        $sql = "DELETE FROM users
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Insert a new user with its current property values
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if the insert was successful, false otherwise
     */
    public function create($conn)
    {
            $sql = "INSERT INTO users (user_name, email, active, birthday)
                    VALUES (:user_name, :email, :active, :birthday)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':active', $this->active, PDO::PARAM_STR);
            
            if ($this->birthday == '') {
                $stmt->bindValue(':birthday', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }
    }







}
