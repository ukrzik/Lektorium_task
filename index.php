<?php

session_start();
if (!isset($_SESSION['hash'])) {
    header('Location: ' . '/login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php' ?>
</head>

<body>

<?php require_once 'menu.php' ?>

<?php require_once 'get-posts.php' ?>

</body>
</html>
