<?php require_once APP_ROOT . '/views/inc/header.php' ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-3"><?= $data['title'] ?></h1>
            <p class="lead"><?=$data['description'] ?></p>
        </div>
    </div>
<?php require_once APP_ROOT . '/views/inc/footer.php' ?>