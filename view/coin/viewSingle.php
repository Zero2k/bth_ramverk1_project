<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <h1 class="display-4">Questions for <?= $content["coin"]["name"] ?></h1>
            <p class="lead">
            <?= $content["coin"]["description"] ?>
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
                <?php foreach($content["posts"] as $post): ?>
                    <tr class="tr-large">
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-star"></i> <?php echo $post->votes; ?><br><small>votes</small></td>
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-comments-o"></i> <?php echo $post->answers; ?><br><small>answers</small></td>
                    <td class="align-middle" style="width: 50%"><a href="<?= $url->create("questions/$post->id")?>"><?php echo $post->title; ?></a></td>
                    <td class="text-center align-middle" style="width: 10%; text-align: center"><i class="fa fa-eye"></i> <?php echo $post->views; ?><br><small>views</small></td>
                    <td class="text-center align-middle" style="width: 20%; text-align: center"><?php echo $post->published; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-block mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>
