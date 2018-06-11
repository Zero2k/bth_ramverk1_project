<?php
    $url = $this->di->get("url");
?>

<section id="footer">
    <div class="container">
        <div class="row text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Pages</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="<?= $url->create("")?>"><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href="<?= $url->create("questions")?>"><i class="fa fa-angle-double-right"></i>Questions</a></li>
                    <li><a href="<?= $url->create("tags")?>"><i class="fa fa-angle-double-right"></i>Tags</a></li>
                    <li><a href="<?= $url->create("users")?>"><i class="fa fa-angle-double-right"></i>Users</a></li>
                    <li><a href="<?= $url->create("about")?>"><i class="fa fa-angle-double-right"></i>About</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Resources</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="https://github.com/mosbth/anax"><i class="fa fa-angle-double-right"></i>Anax (PHP-framework)</a></li>
                    <li><a href="https://github.com/canax"><i class="fa fa-angle-double-right"></i>Canax (Modules for Anax)</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>CoinMarketCap (API)</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Open Source</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Github (Project)</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Github (Module)</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                </ul>
            </div>
            </hr>
        </div>	
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p>coin<b>overflow</b> is a Registered MSP/ISO of WGTOTW, Inc. Code and Design by Viktor Bengtsson (https://github.com/Zero2k)</p>
                <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">WGTOTW</a></p>
            </div>
            </hr>
        </div>	
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php foreach ($javascript as $js) : ?>
    <script src="<?= $this->asset($js) ?>"></script>
<?php endforeach; ?>
