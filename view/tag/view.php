<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">All Tags</h1>
                <p class="lead">
                Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge, and build their portfolio.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="pb-20">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?= $url->create("tags/$tag->tag")?>" type="button" class="btn btn-primary">
                    <?php echo $tag->tag; ?> <span class="badge badge-light"><?php echo $tag->total; ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</main>
