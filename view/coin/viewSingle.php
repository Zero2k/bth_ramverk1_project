<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <h1 class="display-4">Questions for <?= ucfirst($coin->name) ?></h1>
            <p class="lead">
            <?= $coin->description ?>
            </p>
        </div>
    </div>
    <div class="container pb-20">
        <div class="card my-3">
            <table class="table table-hover">
            <div class="card-header text-white bg-heatwave">
                Questions
            </div>
                <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr class="tr-large">
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-thumbs-up"></i> <?php echo $upvotes->getUpvotes($post->id); ?>%<br><small>upvoted</small></td>
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-comments-o"></i> <?php echo $comment->getCommentCount($post->id); ?><br><small>answers</small></td>
                    <td class="align-middle" style="width: 50%"><a href="<?= $url->create("questions/$post->id")?>"><?php echo ucfirst($post->title); ?></a></td>
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-eye"></i> <?php echo $post->views; ?><br><small>views</small></td>
                    <td class="text-center align-middle" style="width: 20%; text-align: center"><?php echo $post->published; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
