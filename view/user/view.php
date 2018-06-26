<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">All Users</h1>
                <p class="lead">
                Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge, and build their portfolio.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card-columns pb-20">
            <?php foreach ($users as $user) : ?>
                <div class="card">
                    <img class="card-img-top" src="<?= $gravatar->url($user->email, 260) ?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title"><a href="<?= $url->create("profile/$user->id")?>"><?= ucfirst($user->username) ?></a></h5>
                    <p class="card-text"><small>Joined <?= $user->created ?></small></p>
                    </div>
                    <div class="card-footer text-muted">
                    <a href="<?= $url->create("profile/$user->id")?>" class="card-link">View Profile</a> | 
                    <small style="text-align: right"><?= $user->posts ?> posts</small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
