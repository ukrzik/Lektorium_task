<?php

session_start();
if (isset($_SESSION['hash'])) {
    if ($_SESSION['role']) {
        header('Location: ' . '/');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php' ?>
</head>

<body>

<?php require_once 'menu.php' ?>

<?php require_once 'save-post.php' ?>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a post</div>

                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" id="title" class="form-control" name="title" >
                                    <?php if (isset($errors['title'])): ?>
                                        <p class="text-danger"><?= $errors['title'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>
                                <div class="col-md-6">
                                    <textarea rows="20" cols="64" name="content"></textarea>
                                    <?php if (isset($errors['content'])): ?>
                                        <p class="text-danger"><?= $errors['content'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
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