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
            $errors['email'] = "Email закороткий";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email некоректний";
        } elseif ($emailValue) {
            $errors['email'] = "Така електронна адреса уже присутня та закріплена за користувачем";
        }

        if (mb_strlen($name) < 3 || mb_strlen($name) > 15) {
            $errors['name'] = "Недопустима довжина імені (від 3 до 15 символів)";
        }

        if (mb_strlen($pass) < 8) {
            $errors['password'] = "Пароль закороткий";
        } elseif (!preg_match('/[A-Z]/', $pass)) {
            $errors['password'] = "Пароль має містити тільки латиницю та хоча б одну велику літеру";
        } elseif (!preg_match('/[0-9]/', $pass)) {
            $errors['password'] = "Пароль має містити хоча б одну цифру";
        } elseif (!preg_match('/^[\w\-]+$/', $pass)) {
            $errors['password'] = "Пароль має містити тільки латиницю та символи '_', або '-' та ";
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