<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4">Settings</h1>
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
                                <small><cite><?= $content["city"] ?>, <?= $content["country"] ?>
                                </i></cite></small>
                            <?php endif ?>
                            <p>
                            <?php if ($content["website"]) : ?>
                                <i class="fas fa-globe"></i> <a href="<?= $content["website"] ?>"><?= $content["website"] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Password</a>
                </li>
            </ul>
                <div class="tab-content margin-tb" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $content["username"] ?>" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $content["email"] ?>" placeholder="test@test.com">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputCity">Country</label>
                                <input type="text" class="form-control" name="country" value="<?= $content["country"] ?>" placeholder="Sweden">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" name="city" value="<?= $content["city"] ?>" placeholder="Lund">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Description</label>
                                <textarea class="form-control" name="description" rows="3"><?= $content["description"] ?></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Website</label>
                                <input type="text" class="form-control" name="website" value="<?= $content["website"] ?>" placeholder="Website">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade margin-tb" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="post">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                <input type="password" class="form-control" name="newPassword" placeholder="********">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                <input type="password" class="form-control" name="confirmPassword" placeholder="********">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                        <p><?= $session->getOnce("password-match") ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</main>
