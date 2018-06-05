<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                <h1 class="display-4">Learn, Share and Trade</h1>
                <p class="lead">
                Each month, over 50 million traders come to Coin Overflow to learn, share their knowledge, and build their portfolio.
                </p>
                <p class="lead">
                Join the world’s largest trading community.
                </p>
                </div>
                <div class="col-lg-5">
                <?php if (!$session->get("userId") && !$content): ?>
                    <form>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="J. Doe">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="you@example.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="*******">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light">Sign Up</button>
                    </form>
                <?php else: ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 order-lg-first">
                        <img src="<?= $content["gravatar"] ?>" alt="..." class="img-thumbnail">
                    </div>
                    <div class="col-lg-6 col-sm-6 order-lg-last">
                        <h4><?= $content["username"] ?></h4>
                        <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?= $content["email"] ?>
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a class="btn btn-outline-light" href="<?= $url->create("profile")?>">View Profile</a>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card my-3">
                    <div class="card-header text-white bg-green">
                        Recent questions
                    </div>
                    <div class="card-body">

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Bitcoin</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Ethereum</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Bitcoin</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <small class="d-block text-right mt-3">
                            <a href="#">All questions</a>
                        </small>
                    </div>
                </div>

                <div class="card my-3">
                    <div class="card-header text-white bg-heatwave">
                        Top questions
                    </div>
                    <div class="card-body">

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Ethereum</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Bitcoin Cash</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pd-top">
                            <div class="col-md col-sm-6 col-6 text-center">
                                25<br><small>votes</small>
                            </div>
                            <div class="col-md col-sm-6 col-6 text-center">
                                12<br><small>answers</small>
                            </div>
                            <div class="col-md-9">
                                <div class="media text-muted pt-3">
                                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block text-gray-dark size-16"><a href="">Question</a> in Bitcoin</strong>
                                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <small class="d-block text-right mt-3">
                            <a href="#">All questions</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card my-3">
                    <div class="card-header text-white bg-liquid-sunset">
                        Active users
                    </div>
                    <div class="card-body">
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=6f42c1&amp;fg=6f42c1&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b718043f%20text%20%7B%20fill%3A%236f42c1%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b718043f%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%236f42c1%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Full Name</strong>
                                <a href="#">View Profile</a>
                            </div>
                            <span class="d-block">@username</span>
                            </div>
                        </div>
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b718043b%20text%20%7B%20fill%3A%23e83e8c%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b718043b%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23e83e8c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Full Name</strong>
                                <a href="#">View Profile</a>
                            </div>
                            <span class="d-block">@username</span>
                            </div>
                        </div>
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b7180441%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b7180441%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Full Name</strong>
                                <a href="#">View Profile</a>
                            </div>
                            <span class="d-block">@username</span>
                            </div>
                        </div>
                        <small class="d-block text-right mt-3">
                            <a href="#">All users</a>
                        </small>
                    </div>
                </div>

                <div class="card my-3">
                    <div class="card-header text-white bg-tropical-pink">
                        New users
                    </div>
                    <div class="card-body">
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=6f42c1&amp;fg=6f42c1&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b718043f%20text%20%7B%20fill%3A%236f42c1%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b718043f%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%236f42c1%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Full Name</strong>
                                <a href="#">View Profile</a>
                            </div>
                            <span class="d-block">@username</span>
                            </div>
                        </div>
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_163b718043b%20text%20%7B%20fill%3A%23e83e8c%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_163b718043b%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23e83e8c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.666666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">Full Name</strong>
                                <a href="#">View Profile</a>
                            </div>
                            <span class="d-block">@username</span>
                            </div>
                        </div>
                        <small class="d-block text-right mt-3">
                            <a href="#">All users</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
