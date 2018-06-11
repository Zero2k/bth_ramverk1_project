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
        <table class="table table-hover">
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
            <?php foreach($content["posts"] as $post): ?>
                <tr class="tr-large">
                <td class="text-center align-middle"><?php echo $post->votes; ?></td>
                <td class="text-center align-middle"><?php echo $post->answers; ?></td>
                <td class="align-middle"><a href="#"><?php echo $post->title; ?></a></td>
                <td class="text-center align-middle">200+</td>
                <td class="text-center align-middle"><?php echo $post->published; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
