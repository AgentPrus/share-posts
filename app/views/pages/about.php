<?php require_once APP_ROOT . '/views/inc/header.php' ?>
    <h1><?= $data['title'] ?></h1>
    <p class="lead"><?= $data['description'] ?></p>
    <p class="lead">Version: <strong><?= APP_VERSION ?></strong></p>
<?php require_once APP_ROOT . '/views/inc/footer.php' ?>