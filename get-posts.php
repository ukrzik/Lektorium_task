<?php

    require_once 'db_connection.php';


    $sortType = 'ASC';

    if (isset($_GET["sort"])) {
        if ($_GET["sort"]) {
            $sortType = 'ASC';
        } else {
            $sortType = 'DESC';
        }
    }

    $findPosts = $pdoConn->prepare("SELECT title, content, created_at FROM post ORDER BY created_at " . $sortType);
    $findPosts->execute();
    $posts = $findPosts->fetchAll();

?>

<?php if ($posts): ?>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center mt-3">Posts</h1>

        <a class="btn btn-info mt-3 ml-2" href="/?sort=0">sort date | UP</a>
        <a class="btn btn-warning mt-3 ml-2" href="/?sort=1">sort date | Down</a>
    </div>

    <?php foreach ($posts as $post): ?>
        <div class="posts d-flex justify-content-center mt-3 p-3">
            <div class="post">
                <h3 class="post-title">
                    <?= $post['title'] . '  -  ' . date('d.m.Y H:i', $post['created_at']) ?>
                </h3>
                <div class="post-content">
                    <?= $post['content'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h1>Posts not yet added</h1>
<?php endif; ?>
