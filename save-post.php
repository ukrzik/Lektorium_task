<?php

$errors = [];

if(count($_POST) > 0) {
    require_once 'db_connection.php';

    $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $content = filter_var(trim($_POST['content']), FILTER_SANITIZE_STRING);
    $created_at = time();

    if (mb_strlen($title) < 3) {
        $errors['title'] = "Title cannot be blank";
    }

    if (mb_strlen($content) < 10)  {
        $errors['content'] = "Publish not correct (very short)";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO post (`title`, `content`, `created_at`) VALUES (:title, :content, :created_at)";

        $params = [
            ':title' => $title,
            ':content' => $content,
            ':created_at' => $created_at,
        ];

        $stmt = $pdoConn->prepare($query);

        if ($stmt->execute($params)) {
            header('Location: ' . '/');
        }
    }
}
?>