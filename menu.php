<?php

$userIsGuest = true;

session_start();
if (isset($_SESSION['hash'])) {
    $userIsGuest = false;
}
?>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="/">Lektorium</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php if ($userIsGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php else: ?>
                    <?php if ($_SESSION['role']): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create-post.php">Create post</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-info" title="Date of last login">
                            <?= $_SESSION['firstname'] ?>
                            <?= date('d.m.Y H:i', $_SESSION['auth_date']) ?>
                            <?= $_SESSION['role'] ? 'Користувач' : 'Адміністратор' ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
