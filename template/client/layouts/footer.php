<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataFooter = firstRaw("select opt_value from options where opt_key = 'general_footer'");
$dataFooter = reset($dataFooter);
$dataFooter = json_decode($dataFooter, true);

// echo "<pre>";
// print_r($dataFooter);
// echo "</pre>";


?>

<!-- Footer -->
<footer id="footer" class="footer wow fadeIn">
    <!-- Top Arrow -->
    <div class="top-arrow">
        <a href="#header" class="btn"><i class="fa fa-angle-up"></i></a>
    </div>
    <!--/ End Top Arrow -->
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- About Widget -->
                    <div class="single-widget about">
                        <h2><?php echo $dataFooter['title_1'] ?></h2>
                        <p><?php echo $dataFooter['des_1'] ?></p>
                        <ul class="list">
                            <li><i class="fa fa-map-marker"></i><?php echo getValueOptions("general_address") ?></li>
                            <li><i class="fa fa-headphones"></i>Phone: <?php echo getValueOptions("general_hotline") ?>
                            </li>
                            <li><i class="far fa-envelope"></i>Email: <a
                                    href="mailto:<?php echo getValueOptions("general_email") ?>"><?php echo getValueOptions("general_email") ?></a>
                            </li>
                        </ul>
                    </div>
                    <!--/ End About Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Links Widget -->
                    <div class="single-widget links">
                        <h2><?php echo $dataFooter['title_2'] ?></h2>
                        <ul class="list">
                            <?php 
                            if(!empty($dataFooter['name_quicklink'])){
                                foreach ($dataFooter['name_quicklink'] as $key => $value) {
                                    if(!empty($value)){ 
                                    ?>
                            <li><a href="<?php $dataFooter['link_quicklink'][$key] ?>"><i
                                        class="fa fa-caret-right"></i><?php echo $value ?></a></li>
                            <?php
                                    }
                                }
                            }
                            ?>


                        </ul>
                    </div>
                    <!--/ End Links Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Twitter Widget -->
                    <div class="single-widget twitter">
                        <h2><?php echo $dataFooter['title_3'] ?></h2>
                        <?php 
                            if(!empty($dataFooter['name_account_twitter'])){
                                foreach ($dataFooter['name_account_twitter'] as $key => $value) {
                                    if(!empty($value)){ 
                                    ?>
                        <div class="single-tweet">
                            <i class="fa fa-twitter"></i>
                            <p><a
                                    href="<?php echo $dataFooter['link_account_twitter'][$key] ?>"><?php echo $value ?></a><?php echo $dataFooter['des_account_twitter'][$key]  ?>
                            </p>
                        </div>
                        <?php
                                    }
                                }
                            }
                            ?>

                    </div>
                    <!--/ End Twitter Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Newsletter Widget -->
                    <div class="single-widget newsletter">
                        <h2><?php echo $dataFooter['title_4'] ?></h2>
                        <p><?php echo $dataFooter['des_4'] ?></p>
                        <form>
                            <input placeholder="Your Name" type="text">
                            <input placeholder="your email" type="email">
                            <button type="submit" class="button primary">Subscribe Now!</button>
                        </form>
                    </div>
                    <!--/ End Newsletter Widget -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bottom-top">
                        <!-- Social -->
                        <ul class="social">
                            <li><a target="_blank" href="<?php echo getValueOptions("general_facebook") ?>"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?php echo getValueOptions("general_twitter") ?>"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" href="<?php echo getValueOptions("general_linkedin") ?>"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a target="_blank" href="<?php echo getValueOptions("general_github") ?>"><i
                                        class="fa fa-github"></i></a></li>
                            <li><a target="_blank" href="<?php echo getValueOptions("general_youtube") ?>"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                        <!--/ End Social -->
                        <!-- Copyright -->
                        <div class="copyright">
                            <p><?php echo html_entity_decode($dataFooter['copy_right']) ?></p>
                        </div>
                        <!--/ End Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Bottom -->
</footer>
<!--/ End footer -->

<!-- Jquery -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery-migrate.min.js"></script>
<!-- Popper JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/bootstrap.min.js"></script>
<!-- Colors JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/colors.js"></script>
<!-- Modernizer JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/modernizr.min.js"></script>
<!-- Nice select JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/tilt.jquery.min.js"></script>
<!-- Fancybox  -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.fancybox.min.js"></script>
<!-- Jquery Nav -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.nav.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/owl.carousel.min.js"></script>
<!-- Slick Slider JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/slickslider.min.js"></script>
<!-- Cube Portfolio JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/cubeportfolio.min.js"></script>
<!-- Slicknav JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.slicknav.min.js"></script>
<!-- Jquery Steller JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.stellar.min.js"></script>
<!-- Magnific Popup JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/magnific-popup.min.js"></script>
<!-- Wow JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/wow.min.js"></script>
<!-- CounterUp JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.counterup.min.js"></script>
<!-- Waypoint JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/waypoints.min.js"></script>
<!-- Jquery Easing JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/easing.min.js"></script>
<!-- Google Map JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/gmap.min.js"></script>
<!-- Main JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/main.js"></script>
</body>

</html>