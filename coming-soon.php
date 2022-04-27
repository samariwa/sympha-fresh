<?php
 require_once 'core/init.php';
 require('config.php');
 require('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Config::get('organization_details/name'); ?> - <?php echo Config::get('organization_details/slogan'); ?></title>
    <link rel="shortcut icon" type="image/png" sizes="196x196" href="assets/images/sympha_fresh_white.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <link rel="stylesheet" href="assets/css/custom-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo Config::get('google_recaptcha/public_key'); ?>"></script>
</head>
<body>


    <div class="comming-soon-page" style="background-image:url('assets/images/coming-soon/bg<?php echo shuffleImage(1,8) ?>.jpeg');background-repeat: no-repeat;background-size: 1300px 800px;">
        <div class="comming-soon-content text-center" >
            <a href="index.html" class="logo"><img src="assets/images/logo-footer.png" width="150px" alt="logo"></a>
           <br>
            <h1>Coming Soon!</h1>
            <br>
            <p>Our e-commerce site will launch very soon</p>
            <br>
            <div class="countdown-container countdown show d-flex justify-content-center" data-Date='2022/07/06 09:21:53'>
                <div class="running">
                    <timer class="d-flex flex-wrap justify-content-center">
                        <div class="count-item">
                            <div class="count-number days"></div>
                            <div class="count-text">Days</div>
                        </div>

                        <div class="count-item">
                            <div class="count-number hours"></div>
                            <div class="count-text">hours</div>
                        </div>

                        <div class="count-item">
                            <div class="count-number minutes"></div>
                            <div class="count-text">minutes</div>
                        </div>

                        <div class="count-item">
                            <div class="count-number seconds"></div>
                            <div class="count-text">seconds</div>
                        </div>
                    </timer>
                </div>
            </div>

           <!-- <div class="notify-area text-center">
                <h4>Notify Me When its Ready</h4>
                <form class="notify-form">
                    <input type="text" name="email" placeholder="E-mail Address">
                    <button class="submit-btn">
                        Notify Me
                    </button>
                </form>
            </div>
        </div>
        <div class="comming-soon-footer">
            <ul class="social-media-list d-flex flex-wrap">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>-->
    </div>
    
    


    <script src='assets/js/jquery.min.js'></script>
    <script src='assets/js/bootstrap.bundle.min.js'></script>
    <script src='assets/js/swiper.min.js'></script>
    <script src="assets/js/slick.js"></script>
    <script src='assets/js/jquery-easeing.min.js'></script>
    <script src='assets/js/scroll-nav.js'></script>
    <script src="assets/js/jquery.elevatezoom.js"></script>
    <script src='assets/js/price-range.js'></script>
    <script src='assets/js/custom-select.js'></script>
    <script src='assets/js/multi-countdown.js'></script>
    <script src='assets/js/fly-cart.js'></script>
    <script src='assets/js/theia-sticky-sidebar.js'></script>
    <script src='assets/js/functions.js'></script>

    
</body>
</html>