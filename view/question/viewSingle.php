<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <h2 class="display-4"><?= ucfirst($post->title) ?></h2>
            <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-eye"></i> <?= $post->views ?></li>
                <li class="list-inline-item"><i class="fa fa-thumbs-up"></i> <?= $upvotes ?>%</li>
            </ul>
        </div>
    </div>
    <div class="container pb-20">
        <div class="comment mb-2 row">
            <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                <a href="<?= $url->create("profile/$post->userId")?>"><img class="mx-auto rounded img-fluid" src="<?= $gravatar->url($post->email, 128) ?>" alt="avatar"></a>
            </div>
            <div class="comment-content col-md-11 col-sm-10">
                <h6 class="small comment-meta"><a href="<?= $url->create("profile/$post->userId")?>"><?= $post->username ?></a> <?= $post->published ?></h6>
                <div class="comment-body">
                    <p>
                        <?= $post->html ?>
                        <?php if ($post->updated): ?>
                        <small><i>*Question has been updated / changed on <?= $post->updated ?></i></small>
                        <br>
                        <?php endif ?>
                        <a href="#comment" class="text-right small"><i class="fa fa-comment"></i> Add Comment</a>
                        <?php if ($session->get("userId")): ?>
                        <a href="?like" class="text-right small"><i class="fa fa-thumbs-up"></i> Like</a>
                        <a href="?dislike" class="text-right small"><i class="fa fa-thumbs-down"></i> Dislike</a>
                        <?php endif ?>
                        <?php if ($session->get("userId") == $post->userId): ?>
                        <a href="<?= $url->create("questions/edit/$post->id")?>" class="pull-right small"><i class="fa fa-edit"></i> Edit Question</a>
                        <?php endif ?>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="comments col-md-12 pb-20" id="comments">
                <h4><small class="pull-right"><?= count($comments) ?> comments</small> Comments </h4>
                <?php foreach($comments as $comment): ?>
                    <div class="comment mb-2 row">
                        <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                            <a href="<?= $url->create("profile/$comment->userId")?>"><img class="mx-auto rounded img-fluid" src="<?= $gravatar->url($comment->email, 128) ?>" alt="avatar"></a>
                            </br>
                            <small><i class="fa fa-thumbs-up"></i> 0%</small>
                        </div>
                        <div class="comment-content col-md-11 col-sm-10 pb-20">
                            <h6 class="small comment-meta"><a href="<?= $url->create("profile/$comment->userId")?>"><?= $comment->username ?></a> <?= $comment->published ?></h6>
                            <div class="comment-body">
                                <?= $comment->text ?>
                                <div>
                                    <?php if ($session->get("userId")): ?>
                                    <a class="text-right small" data-toggle="collapse" href="#collapseReplayCommentNr<?= $comment->id ?>" role="button" aria-expanded="false" aria-controls="collapseReplayComment"><i class="fa fa-reply"></i> Reply</a>
                                    <a href="?like&comment=<?= $comment->id ?>" class="text-right small"><i class="fa fa-thumbs-up"></i> Like</a>
                                    <a href="?dislike&comment=<?= $comment->id ?>" class="text-right small"><i class="fa fa-thumbs-down"></i> Dislike</a>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="collapse" id="collapseReplayCommentNr<?= $comment->id ?>">
                                <form style="padding-top: 10px">
                                    <h6>Reply to <?= $comment->username ?></h6>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </form>
                            </div>
                        </div>

                        <!-- <div class="comment-reply col-md-11 offset-md-1 col-sm-10 offset-sm-2">
                            <div class="row">
                                <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                                    <a href=""><img class="mx-auto rounded img-fluid" src="http://demos.themes.guide/bodeo/assets/images/users/m101.jpg" alt="avatar"></a>
                                </div>
                                <div class="comment-content col-md-11 col-sm-10 col-12">
                                    <h6 class="small comment-meta"><a href="#">phildownney</a> Today, 12:31</h6>
                                    <div class="comment-body">
                                        <p>Really?? Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                                            <br>
                                            <a href="" class="text-right small"><i class="fa fa-reply"></i> Reply</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if ($session->get("userId")): ?>
        <div id="comment">
            <div class="card">
                <div class="card-body">
                    <?= $commentForm ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div id="comment">
            <a class="btn btn-outline-primary btn-block" href="<?= $url->create("login?redirect&questions=$post->id")?>" role="button">You must be logged in to post a comment</a>
        </div>
        <?php endif ?>
    </div>
</main>
