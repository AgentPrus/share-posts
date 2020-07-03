<?php require_once APP_ROOT . '/views/inc/header.php' ?>
<a href="<?= URL_ROOT ?>posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<h1><?= $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?= $data['user']->name ?> on <?= date('Y-m-d', strtotime($data['post']->created_at)) ?>
</div>
<p><?= $data['post']->body ?></p>

<?php if ($data['post']->user_id == $_SESSION['user_id']): ?>
    <hr>
    <a href="<?= URL_ROOT ?>posts/edit/<?= $data['post']->id ?>" class="btn btn-dark"><i class="fa fa-pencil"></i> Edit</a>

    <form class="pull-right" action="<?= URL_ROOT ?>posts/delete/<?= $data['post']->id ?>" method="post">
        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
    </form>
<?php endif; ?>

<?php require_once APP_ROOT . '/views/inc/footer.php' ?>
