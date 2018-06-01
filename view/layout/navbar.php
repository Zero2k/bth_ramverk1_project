<?php
    $url = $this->di->get("url");
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
    <a class="btn btn-outline-light" href="<?= $url->create("login")?>">Login In</a>
    <a class="btn btn-outline-light btn-margin-left" href="<?= $url->create("sign-up")?>">Sign Up</a>
    </div>
</nav>

