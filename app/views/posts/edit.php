<?php require_once APP_ROOT . '/views/inc/header.php' ?>
<a href="<?= URL_ROOT?>posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <p>Edit a post by using this form</p>
    <form action="<?= URL_ROOT ?>posts/edit/<?=$data['id'] ?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                   class="form-control form-control-lg <?= !empty($data['title_err']) ? 'is-invalid' : ''; ?> "
                   value="<?= $data['title'] ?? '' ?>">
            <span class="invalid-feedback <?= $data['title_err']; ?>"><?=$data['title_err'] ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body" class="form-control <?= !empty($data['body_err']) ? 'is-invalid' : ''; ?>" cols="30"
                      rows="5"> <?= $data['body'] ?? '' ?> </textarea>
            <span class="invalid-feedback <?= $data['body_err']; ?>"><?=$data['body_err'] ?></span>
        </div>
        <input type="submit" value="Edit" class="btn btn-success">
    </form>
</div>
<?php require_once APP_ROOT . '/views/inc/footer.php' ?>
