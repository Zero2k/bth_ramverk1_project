<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-green">
    <a class="navbar-brand navbar-font" href="#">coin<b>overflow</b></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <?= $app->navbar->renderNav() ?>
    </ul>
    <?php if ($session->get("userId")): ?>
        <span class="navbar-text">
            You're sign in as
        </span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= ucfirst($session->get("username")) ?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="<?= $url->create("profile")?>">View Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= $url->create("logout")?>">Logout</a>
                </div>
            </li>
        </ul>
        <!-- <a class="btn btn-outline-light btn-margin-left" href="<?= $url->create("logout")?>">Logout</a> -->
    <?php else: ?>
        <a class="btn btn-outline-light" href="<?= $url->create("login")?>">Login In</a>
        <a class="btn btn-outline-light btn-margin-left" href="<?= $url->create("sign-up")?>">Sign Up</a>
    <?php endif ?>
    </div>
</nav>

