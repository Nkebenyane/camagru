<?php

include 'db_conn.php';

$conn = getConnection();

    $sql = "CREATE TABLE IF NOT EXISTS users (
            users_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            pwd VARCHAR(255) NOT NULL,
            confirmed INT(11),
            confirmed_code INT(11),
            notify INT(6),
            reg_date TIMESTAMP)";
    
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS pictures (
            pictures_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pictures VARCHAR(255),
            users_name VARCHAR(50),
            reg_date TIMESTAMP)";
    
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS like_pic (
            like_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pictures_id INT(6) UNSIGNED,
            users_name VARCHAR(50),
            reg_date TIMESTAMP)";
        
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS comments (
            comments_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pictures_id INT(6) UNSIGNED,
            users_name VARCHAR(50),
            comment VARCHAR (225),
            reg_date TIMESTAMP)";

    $conn->exec($sql);
?>