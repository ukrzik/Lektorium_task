<?php

    session_start();
    unset($_SESSION["hash"]);
    unset($_SESSION["firstname"]);
    unset($_SESSION["email"]);
    unset($_SESSION["role"]);
    unset($_SESSION["auth_date"]);

    header('Location: ' . '/login.php');