<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <h1 class="display-4">All Questions</h1>
            <p class="lead">
            Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge, and build their portfolio.
            </p>
        </div>
    </div>
    <div class="container pb-20">
        <div class="card my-3">
            <div class="card-header text-white bg-heatwave">
                Recent Questions 
            </div>
            <div class="card-body">
                <?php foreach ($questions as $post) : ?>
                <div class="row align-items-center pd-top">
                    <div class="col-md col-sm-6 col-6 text-center">
                    <i class="fa fa-thumbs-up"></i> <?php echo $post->upVotes; ?>%<br><small>upvoted</small>
                    </div>
                    <div class="col-md col-sm-6 col-6 text-center">
                    <i class="fa fa-comments-o"></i> <?php echo $comment->getCommentCount($post->id); ?><br><small>answers</small>
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
            </div>
        </div>
        <div class="d-block mt-3">
            <nav>
                <ul class="pagination pagination-sm justify-content-center">
                    <?php echo $pagination ?>
                </ul>
            </nav>
        </div>
    </div>
</main>
