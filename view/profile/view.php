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
                            <!-- <small>Reputation: Good</small> -->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
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
            <div class="col-sm-4">
                <div class="card my-3">
                    <div class="card-header text-white bg-liquid-sunset">
                        Coins
                    </div>
                    <div class="card-body">
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=6f42c1&amp;fg=6f42c1&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b718043f%20text%20%7B%20fill%3A%236f42c1%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b718043f%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%236f42c1%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Bitcoin</strong>
                                <a href="#">View Coin</a>
                            </div>
                            <span class="d-block">1000+ posts</span>
                            </div>
                        </div>
                        <small class="d-block text-right mt-3">
                            <a href="#">All coins</a>
                        </small>
                    </div>
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
                        <div class="media pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <?php echo substr($comment->html, 0, 150); ?> <small>in <?php echo $comment->name ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
