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
                <?php foreach($questions as $post): ?>
                <div class="row align-items-center pd-top">
                    <div class="col-md col-sm-6 col-6 text-center">
                    <i class="fa fa-star"></i> <?php echo $post->votes; ?><br><small>votes</small>
                    </div>
                    <div class="col-md col-sm-6 col-6 text-center">
                    <i class="fa fa-comments-o"></i> <?php echo $post->answers; ?><br><small>answers</small>
                    </div>
                    <div class="col-md-9">
                        <div class="media text-muted pt-3">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <strong class="d-block text-gray-dark size-16"><a href="<?= $url->create("questions/$post->id")?>"><?php echo $post->title; ?></a> in <a href="<?= $url->create("coin/$post->slug")?>"><?php echo ucfirst($post->name); ?></a></strong>
                                <?php echo substr($post->text, 0, 200); ?>...
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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
        <!-- <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col" style="width: 10%; text-align: center">Votes</th>
                <th scope="col" style="width: 10%; text-align: center">Answers</th>
                <th scope="col" style="width: 50%">Question</th>
                <th scope="col" style="width: 10%; text-align: center">Views</th>
                <th scope="col" style="width: 20%; text-align: center">Freshness</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($questions as $post): ?>
                <tr class="tr-large">
                <td class="text-center align-middle"><?php echo $post->votes; ?></td>
                <td class="text-center align-middle"><?php echo $post->answers; ?></td>
                <td class="align-middle"><a href="<?= $url->create("questions/$post->id")?>"><?php echo $post->title; ?></a></td>
                <td class="text-center align-middle">200+</td>
                <td class="text-center align-middle"><?php echo $post->published; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table> -->
    </div>
</main>
