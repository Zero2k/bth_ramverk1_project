<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <h1 class="display-4">All Coins</h1>
            <p class="lead">
            Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge, and build their portfolio.
            </p>
        </div>
    </div>
    <div class="container pb-20">
        <div class="card-columns">
            <?php foreach($coins as $coin): ?>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="<?= $url->create("coin/$coin->slug")?>"><?php echo ucfirst($coin->name); ?></a></h5>
                    <p class="card-text"><?php echo $coin->description; ?></p>
                    </div>
                    <div class="card-footer text-muted">
                    <a href="<?= $url->create("coin/$coin->slug")?>" class="card-link">View Posts</a> | 
                    <small style="text-align: right"><?php echo $coin->total_posts; ?> posts</small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
