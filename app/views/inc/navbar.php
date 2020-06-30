<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a href="<?= URL_ROOT ?>" class="navbar-brand"><?= SITE_NAME ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<? URL_ROOT ?>pages/about">About</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>users/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>users/login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>