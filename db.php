<?php

try {
    require_once 'db_connection.php';

    $pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tableUsers = "CREATE TABLE user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    role INT(2),
    created_at INT(25),
    auth_hash VARCHAR(256)
    )";

    $tablePosts = "CREATE TABLE post (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL,
    content VARCHAR(256) NOT NULL,
    created_at INT(25) 
    )";

    $pdoConn->exec($tableUsers);
    $pdoConn->exec($tablePosts);
    echo "Tables created successfully";
}
catch(PDOException $e)
{
    echo $tableUsers . "<br>" . $e->getMessage();
    echo $tablePosts . "<br>" . $e->getMessage();
}

$pdoConn = null;
?>