<?php

    $errors = [];

    if(count($_POST) > 0) {
        require_once 'db_connection.php';

        $name = filter_var(trim($_POST['firstname']),FILTER_SANITIZE_STRING);
        $mail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $pass = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

        $role = 1;
        $date = time();

        $checkAvailableUserEmail = $pdoConn->prepare("SELECT * FROM user WHERE email = ?");
        $checkAvailableUserEmail->execute([$mail]);
        $emailValue = $checkAvailableUserEmail->fetch(PDO::FETCH_LAZY);

        if (mb_strlen($mail) < 2) {
            $errors['email'] = "Email very short";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email incorrect";
        } elseif ($emailValue) {
            $errors['email'] = "This email not available";
        }

        if (mb_strlen($name) < 3 || mb_strlen($name) > 15) {
            $errors['name'] = "Invalid name length (3 to 15 characters)";
        }

        if (mb_strlen($pass) < 8) {
            $errors['password'] = "Password very short";
        } elseif (!preg_match('/[A-Z]/', $pass)) {
            $errors['password'] = "The password must contain only latin letters and at least one Capital letter";
        } elseif (!preg_match('/[0-9]/', $pass)) {
            $errors['password'] = "Password must contain at least one digit";
        } elseif (!preg_match('/^[\w\-]+$/', $pass)) {
            $errors['password'] = "Password should contain only Latin and the characters '_', or '-'";
        }

        if (count($errors) === 0) {
            $query = "INSERT INTO user (`firstname`, `email`, `password`, `role`, `created_at`, `auth_hash`) VALUES (:name, :email, :password, :role, :date, :auth_hash)";

            $params = [
                ':name' => $name,
                ':email' => $mail,
                ':password' => md5($pass),
                ':role' => $role,
                ':date' => $date,
                ':auth_hash' => md5($mail . $date)
            ];

            $stmt = $pdoConn->prepare($query);

            if ($stmt->execute($params)) {
                header('Location: ' . '/login.php');
            }
        }
    }
?>