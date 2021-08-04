<?php

$errors = [];

if(count($_POST) > 0) {
    require_once 'db_connection.php';

    $mail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $pass = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $pass = md5($pass);

    $findUserAccount = $pdoConn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $findUserAccount->execute([$mail, $pass]);
    $userAccount = $findUserAccount->fetch(PDO::FETCH_LAZY);

    if ($userAccount) {
        session_start();
        $_SESSION['firstname'] = $userAccount['firstname'];
        $_SESSION['email'] = $userAccount['email'];
        $_SESSION['role'] = $userAccount['role'];
        $_SESSION['hash'] = $userAccount['auth_hash'];
        $_SESSION['auth_date'] = time();

        header('Location: ' . '/');
    } else {
        $errors['error'] = "Невірний email або password";
    }
}
?>