<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataSlide = firstRaw("select opt_value from options where opt_key = 'general_slide'");
$dataSlide = reset($dataSlide);
$dataSlide = json_decode($dataSlide, true);
// echo "<pre>";
// print_r($dataSlide);
// echo "</pre>";

?>
<!-- Hero Area -->

<section id="hero-area" class="hero-area">
    <!-- Slider -->
    <div class="slider-area">
        <!-- Single Slider -->
        <?php
        if (!empty($dataSlide)) :
            foreach ($dataSlide as $value) {
                $backgroud_image = $value['backgroud_image'];
                $positon_image = $value['positon_image'];
        ?>

        <div class="single-slider" style="background-image:url('<?php echo $backgroud_image ?>')">
            <div class="container">
                <div class="row">

                    <?php
                            if ($positon_image == 'left') {
                            ?>
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="slider-text text-left">
                            <h1><?php echo html_entity_decode($value['name']) ?></h1>
                            <p><?php echo html_entity_decode($value['content']) ?></p>
                            <div class="button">
                                <a href="<?php echo html_entity_decode($value['link_btn']) ?>"
                                    class="btn"><?php echo html_entity_decode($value['btn_name']) ?></a>
                                <a href="<?php echo html_entity_decode($value['link_video']) ?>"
                                    class="btn video video-popup mfp-fade"><i class="fa fa-play"></i>Play Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12">
                        <div class="image-gallery">
                            <div class="single-image">
                                <img src="<?php echo html_entity_decode($value['image_1']) ?>" alt="#">
                            </div>
                            <div class="single-image two">
                                <img src="<?php echo html_entity_decode($value['image_2']) ?>" alt="#">
                            </div>
                        </div>
                    </div>
                    <?php
                            } elseif ($positon_image == 'right') {
                            ?>
                    <div class="col-lg-5 col-md-6 col-12">
                        <div class="image-gallery">
                            <div class="single-image">
                                <img src="<?php echo html_entity_decode($value['image_1']) ?>" alt="#">
                            </div>
                            <div class="single-image two">
                                <img src="<?php echo html_entity_decode($value['image_2']) ?>" alt="#">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="slider-text text-right">
                            <h1><?php echo html_entity_decode($value['name']) ?></h1>
                            <p><?php echo html_entity_decode($value['content']) ?></p>
                            <div class="button">
                                <a href="<?php echo html_entity_decode($value['link_btn']) ?>"
                                    class="btn"><?php echo html_entity_decode($value['btn_name']) ?></a>
                                <a href="<?php echo html_entity_decode($value['link_video']) ?>"
                                    class="btn video video-popup mfp-fade"><i class="fa fa-play"></i>Play Now</a>
                            </div>
                        </div>
                    </div>


                    <?php

                            } else {
                            ?>
                    <div class="col-lg-10 offset-lg-1 col-12">
                        <div class="slider-text text-center">
                            <h1><?php echo html_entity_decode($value['name']) ?></h1>
                            <p><?php echo html_entity_decode($value['content']) ?></p>
                            <div class="button">
                                <a href="<?php echo html_entity_decode($value['link_btn']) ?>"
                                    class="btn"><?php echo html_entity_decode($value['btn_name']) ?></a>
                                <a href="<?php echo html_entity_decode($value['link_video']) ?>"
                                    class="btn video video-popup mfp-fade"><i class="fa fa-play"></i>Play Now</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            ?>
                </div>
            </div>
        </div>
        <?php
            }
        endif;
        ?>

    </div>
</section>
<!--/ End Slider -->