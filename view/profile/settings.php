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
                    Description
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 order-lg-first">
                            <img src="<?= $content["gravatar"] ?>" alt="..." class="img-thumbnail">
                        </div>
                        <div class="col-lg-6 col-sm-6 order-lg-last">
                            <h4><?= $content["username"] ?></h4>
                            <?php if ($content["city"] && $content["country"]): ?>
                                <small><cite><?= $content["city"] ?>, <?= $content["country"] ?> <i class="fas fa-map-marker">
                                </i></cite></small>
                            <?php endif ?>
                            <p>
                            <i class="fas fa-envelope"></i> <?= $content["email"] ?>
                            <br />
                            <?php if ($content["website"]): ?>
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
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Username" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Email</label>
                                <input type="email" class="form-control" id="inputAddress" placeholder="test@test.com">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputCity">Country</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Sweden">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Lund">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Website</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Website">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade margin-tb" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="********">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="********">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</main>
