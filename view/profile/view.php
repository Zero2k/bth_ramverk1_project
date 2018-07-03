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
                        <?php if ($content["description"]) : ?>
                            <?= $content["description"] ?>
                        <?php endif ?>
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 order-lg-first">
                            <img src="<?= $content["gravatar"] ?>" alt="..." class="img-thumbnail">
                        </div>
                        <div class="col-lg-6 col-sm-6 order-lg-last">
                            <h4><?= $content["username"] ?></h4>
                            <?php if ($content["city"] && $content["country"]) : ?>
                                <small><cite><?= $content["city"] ?>, <?= $content["country"] ?></cite></small>
                            <?php endif ?>
                            <br>
                            <p>
                                <?php if ($content["website"]) : ?>
                                <i class="fas fa-globe"></i> <a href="<?= $content["website"] ?>"><?= $content["website"] ?></a>
                                <?php endif ?>
                                <?php if ($session->get("userId") && $session->get("userId") == $content["id"]) : ?>
                                <div class="btn-group">
                                    <a class="btn btn-outline-light" href="<?= $url->create("profile/settings")?>">Change Settings</a>
                                </div>
                                <?php endif ?>
                            </p>
                            <p><b>Karma: </b><?= isset($karma->karma) ? $karma->karma : 0 ?><p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card my-3">
                    <div class="card-header text-white bg-heatwave">
                        Top Questions
                    </div>
                    <div class="card-body">
                    <?php foreach ($posts as $post) : ?>
                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                            <i class="fa fa-thumbs-up"></i> <small><?php echo $upvotes->getUpvotes($post->id); ?>%</small><br><small>upvoted</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                            <i class="fa fa-comments-o"></i> <small><?php echo $comment->getCommentCount($post->id); ?></small><br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="<?= $url->create("questions/$post->id")?>"><?= ucfirst($post->title) ?></a> in <a href="<?= $url->create("coin/$post->slug")?>"><?php echo ucfirst($post->name); ?></a></strong>
                                        <?php echo substr(strip_tags($post->text), 0, 150); ?>...
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm justify-content-center">
                            <?php echo $pagination ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card my-3">
                    <div class="card-header text-white bg-tropical-pink">
                        Latest Answers
                    </div>
                    <div class="card-body">
                        <?php foreach ($recentComments as $comment) : ?>
                        <div class="media text-muted pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <?php echo substr($comment->text, 0, 150); ?> in <a href="<?= $url->create("questions/$comment->id")?>"><?php echo ucfirst($comment->title) ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
