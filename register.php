<?php

session_start();
if (isset($_SESSION['hash'])) header('Location: ' . '/');
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php' ?>
</head>

<body>

<?php require_once 'menu.php' ?>

<?php require_once 'chek.php' ?>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration</div>

                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="firstname" class="form-control" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                                    <?php if (isset($errors['name'])): ?>
                                        <p class="text-danger"><?= $errors['name'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    <?php if (isset($errors['email'])): ?>
                                        <p class="text-danger"><?= $errors['email'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="text" id="password" class="form-control" name="password">
                                    <?php if (isset($errors['password'])): ?>
                                        <p class="text-danger"><?= $errors['password'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>