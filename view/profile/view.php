<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4">About <?= $content["username"] ?></h1>
                    <p class="lead">
                    Description
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 order-lg-first">
                            <img src="<?= $content["gravatar"] ?>" alt="..." class="img-thumbnail">
                        </div>
                        <div class="col-lg-6 col-sm-6 order-lg-last">
                            <h4><?= $content["username"] ?></h4>
                            <?php if ($content["city"] && $content["country"]): ?>
                                <small><cite><?= $content["city"] ?>, <?= $content["country"] ?> <i class="fas fa-map-marker">
                                </i></cite></small>
                            <?php endif ?>
                            <p>
                            <i class="fas fa-envelope"></i> <?= $content["email"] ?>
                            <br />
                            <?php if ($content["website"]): ?>
                                <i class="fas fa-globe"></i> <a href="<?= $content["website"] ?>"><?= $content["website"] ?></a>
                            <?php endif ?>
                            <?php if ($session->get("userId")): ?>
                                <div class="btn-group">
                                    <a class="btn btn-outline-light" href="<?= $url->create("profile/settings")?>">Change Settings</a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

    </div>
</main>
