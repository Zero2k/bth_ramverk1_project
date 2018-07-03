<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <?php if (!$session->get("userId")) : ?>
                <div class="col-lg-7">
                    <h1 class="display-4">Learn, Share and Invest</h1>
                    <p class="lead">
                    Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge about cryptocurrencies.
                    </p>
                    <p class="lead">
                    Join the world’s largest trading community.
                    </p>
                </div>
                <div class="col-lg-5">
                    <form method="post">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" placeholder="J. Doe">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="you@example.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="*******">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light">Sign Up</button>
                        <small style="padding-left: 10px"><?= $content["message"] ?></small>
                    </form>
                </div>
                <?php else : ?>
                <div class="col-lg-7">
                    <h2 class="h2">Welcome to Coin Overflow</h2>
                    <p class="lead">
                    Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge about cryptocurrencies.
                    </p>
                    <p>
                    Start answer questions and you will receive points. Check out some of the recent questions below or view other users profile and their questions.
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
                                <small><cite><?= $content["city"] ?>, <?= $content["country"] ?>
                                </i></cite></small>
                            <?php endif ?>
                            <p>
                            <i class="fas fa-envelope"></i> <?= $content["email"] ?>
                            <br />
                            <?php if ($content["website"]) : ?>
                                <i class="fas fa-globe"></i> <a href="<?= $content["website"] ?>"><?= $content["website"] ?></a>
                            <?php endif ?>
                            <div class="btn-group">
                                <a class="btn btn-outline-light" href="<?= $url->create("profile")?>">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card my-3">
                    <div class="card-header text-white bg-green">
                        Recent Questions
                    </div>
                    <div class="card-body">

                        <?php foreach ($recentQuestions as $post) : ?>
                            <div class="row align-items-center pd-top">
                                <div class="col-md col-sm-6 col-6 text-center">
                                <i class="fa fa-thumbs-up"></i> <small><?php echo $post->upVotes; ?>%<br>upvoted</small>
                                </div>
                                <div class="col-md col-sm-6 col-6 text-center">
                                <i class="fa fa-comments-o"></i> <small><?php echo $comment->getCommentCount($post->id) ?><br>answers</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="media text-muted pt-3">
                                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom text-center-sm border-gray">
                                            <strong class="d-block text-gray-dark size-16"><a href="<?= $url->create("questions/$post->id")?>"><?php echo ucfirst($post->title); ?></a> in <a href="<?= $url->create("coin/$post->slug")?>"><?php echo ucfirst($post->name); ?></a></strong>
                                            <?php echo substr(strip_tags($post->text), 0, 200); ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <small class="d-block text-right mt-3">
                            <a href="<?= $url->create("questions")?>">All questions</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card my-3">
                    <div class="card-header text-white bg-liquid-sunset">
                        Active & New Users
                    </div>
                    <div class="card-body">
                        <?php foreach ($activeUsers as $user) : ?>
                            <div class="media text-muted pt-3">
                                <img src="<?= $gravatar->url($user->email, 32) ?>" class="mr-2 rounded" data-holder-rendered="true">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark"><?= ucfirst($user->username) ?></strong>
                                    <a href="<?= $url->create("profile/$user->id")?>">View Profile</a>
                                </div>
                                <span class="d-block">Joined <?= ucfirst($user->created) ?> | <?= ucfirst($user->posts) ?> posts</span>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <small class="d-block text-right mt-3">
                            <a href="<?= $url->create("users")?>">All users</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card my-3">
                    <div class="card-header text-white bg-heatwave">
                        Top Questions
                    </div>
                    <div class="card-body">

                        <?php foreach ($topQuestions as $post) : ?>
                            <div class="row align-items-center pd-top">
                                <div class="col-md col-sm-6 col-6 text-center">
                                <i class="fa fa-thumbs-up"></i> <small><?php echo $post->upVotes; ?>%<br>upvoted</small>
                                </div>
                                <div class="col-md col-sm-6 col-6 text-center">
                                <i class="fa fa-comments-o"></i> <small><?php echo $comment->getCommentCount($post->id) ?><br>answers</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="media text-muted pt-3">
                                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom text-center-sm border-gray">
                                            <strong class="d-block text-gray-dark size-16"><a href="<?= $url->create("questions/$post->id")?>"><?php echo ucfirst($post->title); ?></a> in <a href="<?= $url->create("coin/$post->slug")?>"><?php echo ucfirst($post->name); ?></a></strong>
                                            <?php echo substr(strip_tags($post->text), 0, 200); ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <small class="d-block text-right mt-3">
                            <a href="<?= $url->create("questions")?>">All questions</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
