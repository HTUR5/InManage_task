<?php
require 'classes/Database.php';
require 'config.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$conn = $db->getConn();

//make users table
$queryUsers = "CREATE TABLE IF NOT EXISTS Users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  active ENUM('yes', 'no') DEFAULT 'yes'
);";

if ($conn->exec($queryUsers) !== false) {
    echo "Users table created (or already exists).";
} else {
    echo "Failed to create Users table.";
}

//make posts table
$queryPosts = "CREATE TABLE IF NOT EXISTS Posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255) NOT NULL,
  content TEXT,
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  active ENUM('yes', 'no') DEFAULT 'yes',
  FOREIGN KEY (user_id) REFERENCES Users(id)
);";

if ($conn->exec($queryPosts) !== false) {
    echo "Posts table created (or already exists).";
} else {
    echo "Failed to create Posts table.";
}
